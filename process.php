<?php
define("__ROOT__", $_SERVER['DOCUMENT_ROOT'] . "/");

require_once __ROOT__ . 'vendors/Predis/Autoloader.php';
require_once __ROOT__ . 'vendors/KLogger.php';
$log = KLogger::instance('/home/ubuntu/log/',KLogger::DEBUG);

Predis\Autoloader::register();

$data = $_POST["data"];
//$data = $_GET["data"];
$obj = json_decode($data);

$log->logInfo("process > " . $data);

$method = $obj->method;
$action = $obj->action;
unset($obj->method);
unset($obj->action);

$processorClass = ucfirst(strtolower($method)) . "Processor";


if (!file_exists(__ROOT__ . "processor/" . $method . ".class.php")) {
    $log->logError("process > method ". $method." not found!");
    header('HTTP/1.0 404 Not Found');
    exit;
}

require("processor/" . $method . ".class.php");
if (class_exists($processorClass)) {
    $processor = new $processorClass();
    if (method_exists($processor, $action)) {
        $vars = array_keys(get_object_vars($processor));
        
        foreach ($obj as $key => $value) {
            if (in_array($key, $vars)) {
                $processor->$key = $value;
            }
        }
        
        $processor->$action();
        $log->logInfo("process > action called");
    } else {
        $log->logError("process > action ". $action." not found!");
        header('HTTP/1.0 404 Not Found');
    }
} else {
    $log->logError("process > ". $method.".class.php not found!");
    header('HTTP/1.0 404 Not Found');
}


?>
