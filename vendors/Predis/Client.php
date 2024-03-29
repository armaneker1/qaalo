<?php

/*
 * This file is part of the Predis package.
 *
 * (c) Daniele Alessandri <suppakilla@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Predis;

use Predis\Command\CommandInterface;
use Predis\Command\ScriptedCommand;
use Predis\Connection\AggregatedConnectionInterface;
use Predis\Connection\ConnectionInterface;
use Predis\Connection\ConnectionFactory;
use Predis\Connection\ConnectionFactoryInterface;
use Predis\Monitor\MonitorContext;
use Predis\Option\ClientOptions;
use Predis\Option\ClientOptionsInterface;
use Predis\Pipeline\PipelineContext;
use Predis\Profile\ServerProfile;
use Predis\Profile\ServerProfileInterface;
use Predis\PubSub\PubSubContext;
use Predis\Transaction\MultiExecContext;

/**
 * Main class that exposes the most high-level interface to interact with Redis.
 *
 * @author Daniele Alessandri <suppakilla@gmail.com>
 */
class Client implements ClientInterface
{
    const VERSION = '0.8.2';

    private $options;
    private $profile;
    private $connection;
    private $connections;

    /**
     * Initializes a new client with optional connection parameters and client options.
     *
     * @param mixed $parameters Connection parameters for one or multiple servers.
     * @param mixed $options Options that specify certain behaviours for the client.
     */
    public function __construct($parameters = 'tcp://qaalo.com:6379', $options = null)
    {
        
        $this->options = $this->filterOptions($options);
        $this->profile = $this->options->profile;
        $this->connections = $this->options->connections;
        $this->connection = $this->initializeConnection($parameters);
    }

    /**
     * Creates an instance of Predis\Option\ClientOptions from various types of
     * arguments (string, array, Predis\Profile\ServerProfile) or returns the
     * passed object if it is an instance of Predis\Option\ClientOptions.
     *
     * @param mixed $options Client options.
     * @return ClientOptions
     */
    protected function filterOptions($options)
    {
        if ($options === null) {
            return new ClientOptions();
        }

        if (is_array($options)) {
            return new ClientOptions($options);
        }

        if ($options instanceof ClientOptionsInterface) {
            return $options;
        }

        throw new \InvalidArgumentException("Invalid type for client options");
    }

    /**
     * Initializes one or multiple connection (cluster) objects from various
     * types of arguments (string, array) or returns the passed object if it
     * implements Predis\Connection\ConnectionInterface.
     *
     * @param mixed $parameters Connection parameters or instance.
     * @return ConnectionInterface
     */
    protected function initializeConnection($parameters)
    {
        if ($parameters instanceof ConnectionInterface) {
            return $parameters;
        }

        if (is_array($parameters) && isset($parameters[0])) {
            $replication = isset($this->options->replication) && $this->options->replication;
            $connection = $this->options->{$replication ? 'replication' : 'cluster'};

            return $this->connections->createAggregated($connection, $parameters);
        }

        return $this->connections->create($parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * {@inheritdoc}
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Returns the connection factory object used by the client.
     *
     * @return ConnectionFactoryInterface
     */
    public function getConnectionFactory()
    {
        return $this->connections;
    }

    /**
     * Returns a new instance of a client for the specified connection when the
     * client is connected to a cluster. The new instance will use the same
     * options of the original client.
     *
     * @return Client
     */
    public function getClientFor($connectionID)
    {
        if (($connection = $this->getConnectionById($connectionID)) === null) {
            throw new \InvalidArgumentException("Invalid connection ID: '$connectionID'");
        }

        return new static($connection, $this->options);
    }

    /**
     * Opens the connection to the server.
     */
    public function connect()
    {
        $this->connection->connect();
    }

    /**
     * Disconnects from the server.
     */
    public function disconnect()
    {
        $this->connection->disconnect();
    }

    /**
     * Disconnects from the server.
     *
     * This method is an alias of disconnect().
     */
    public function quit()
    {
        $this->disconnect();
    }

    /**
     * Checks if the underlying connection is connected to Redis.
     *
     * @return Boolean True means that the connection is open.
     *                 False means that the connection is closed.
     */
    public function isConnected()
    {
        return $this->connection->isConnected();
    }

    /**
     * {@inheritdoc}
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * Retrieves a single connection out of an aggregated connections instance.
     *
     * @param string $connectionId Index or alias of the connection.
     * @return SingleConnectionInterface
     */
    public function getConnectionById($connectionId)
    {
        if (!$this->connection instanceof AggregatedConnectionInterface) {
            throw new NotSupportedException('Retrieving connections by ID is supported only when using aggregated connections');
        }

        return $this->connection->getConnectionById($connectionId);
    }

    /**
     * Dynamically invokes a Redis command with the specified arguments.
     *
     * @param string $method The name of a Redis command.
     * @param array $arguments The arguments for the command.
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        $command = $this->profile->createCommand($method, $arguments);
        $response = $this->connection->executeCommand($command);

        if ($response instanceof ResponseObjectInterface) {
            if ($response instanceof ResponseErrorInterface) {
                $response = $this->onResponseError($command, $response);
            }

            return $response;
        }

        return $command->parseResponse($response);
    }

    /**
     * {@inheritdoc}
     */
    public function createCommand($method, $arguments = array())
    {
        return $this->profile->createCommand($method, $arguments);
    }

    /**
     * {@inheritdoc}
     */
    public function executeCommand(CommandInterface $command)
    {
        $response = $this->connection->executeCommand($command);

        if ($response instanceof ResponseObjectInterface) {
            if ($response instanceof ResponseErrorInterface) {
                $response = $this->onResponseError($command, $response);
            }

            return $response;
        }

        return $command->parseResponse($response);
    }

    /**
     * Handles -ERR responses returned by Redis.
     *
     * @param CommandInterface $command The command that generated the error.
     * @param ResponseErrorInterface $response The error response instance.
     * @return mixed
     */
    protected function onResponseError(CommandInterface $command, ResponseErrorInterface $response)
    {
        if ($command instanceof ScriptedCommand && $response->getErrorType() === 'NOSCRIPT') {
            $eval = $this->createCommand('eval');
            $eval->setRawArguments($command->getEvalArguments());

            $response = $this->executeCommand($eval);

            if (false === $response instanceof ResponseObjectInterface) {
                $response = $command->parseResponse($response);
            }

            return $response;
        }

        if ($this->options->exceptions === true) {
            throw new ServerException($response->getMessage());
        }

        return $response;
    }

    /**
     * Calls the specified initializer method on $this with 0, 1 or 2 arguments.
     *
     * TODO: Invert $argv and $initializer.
     *
     * @param array $argv Arguments for the initializer.
     * @param string $initializer The initializer method.
     * @return mixed
     */
    private function sharedInitializer($argv, $initializer)
    {
        switch (count($argv)) {
            case 0:
                return $this->$initializer();

            case 1:
                list($arg0) = $argv;
                return is_array($arg0) ? $this->$initializer($arg0) : $this->$initializer(null, $arg0);

            case 2:
                list($arg0, $arg1) = $argv;
                return $this->$initializer($arg0, $arg1);

            default:
                return $this->$initializer($this, $argv);
        }
    }

    /**
     * Creates a new pipeline context and returns it, or returns the results of
     * a pipeline executed inside the optionally provided callable object.
     *
     * @param mixed $arg,... Options for the context, a callable object, or both.
     * @return PipelineContext|array
     */
    public function pipeline(/* arguments */)
    {
        return $this->sharedInitializer(func_get_args(), 'initPipeline');
    }

    /**
     * Pipeline context initializer.
     *
     * @param array $options Options for the context.
     * @param mixed $callable Optional callable object used to execute the context.
     * @return PipelineContext|array
     */
    protected function initPipeline(Array $options = null, $callable = null)
    {
        $executor = isset($options['executor']) ? $options['executor'] : null;

        if (is_callable($executor)) {
            $executor = call_user_func($executor, $this, $options);
        }

        $pipeline = new PipelineContext($this, $executor);
        $replies  = $this->pipelineExecute($pipeline, $callable);

        return $replies;
    }

    /**
     * Executes a pipeline context when a callable object is passed.
     *
     * @param array $options Options of the context initialization.
     * @param mixed $callable Optional callable object used to execute the context.
     * @return PipelineContext|array
     */
    private function pipelineExecute(PipelineContext $pipeline, $callable)
    {
        return isset($callable) ? $pipeline->execute($callable) : $pipeline;
    }

    /**
     * Creates a new transaction context and returns it, or returns the results of
     * a transaction executed inside the optionally provided callable object.
     *
     * @param mixed $arg,... Options for the context, a callable object, or both.
     * @return MultiExecContext|array
     */
    public function multiExec(/* arguments */)
    {
        return $this->sharedInitializer(func_get_args(), 'initMultiExec');
    }

    /**
     * Transaction context initializer.
     *
     * @param array $options Options for the context.
     * @param mixed $callable Optional callable object used to execute the context.
     * @return MultiExecContext|array
     */
    protected function initMultiExec(Array $options = null, $callable = null)
    {
        $transaction = new MultiExecContext($this, $options ?: array());
        return isset($callable) ? $transaction->execute($callable) : $transaction;
    }

    /**
     * Creates a new Publish / Subscribe context and returns it, or executes it
     * inside the optionally provided callable object.
     *
     * @param mixed $arg,... Options for the context, a callable object, or both.
     * @return MultiExecContext|array
     */
    public function pubSub(/* arguments */)
    {
        return $this->sharedInitializer(func_get_args(), 'initPubSub');
    }

    /**
     * Publish / Subscribe context initializer.
     *
     * @param array $options Options for the context.
     * @param mixed $callable Optional callable object used to execute the context.
     * @return PubSubContext
     */
    protected function initPubSub(Array $options = null, $callable = null)
    {
        $pubsub = new PubSubContext($this, $options);

        if (!isset($callable)) {
            return $pubsub;
        }

        foreach ($pubsub as $message) {
            if (call_user_func($callable, $pubsub, $message) === false) {
                $pubsub->closeContext();
            }
        }
    }

    /**
     * Returns a new monitor context.
     *
     * @return MonitorContext
     */
    public function monitor()
    {
        return new MonitorContext($this);
    }
}
