<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
// include a library
require_once($_SERVER['DOCUMENT_ROOT'] . "/vendors/Stomp/Stomp.php");
// make a connection
$con = new Stomp("tcp://127.0.0.1:61613");
// connect
$con->connect();
// send a message to the queue
$con->send("qaalo", json_encode(array(
                "method"=>"topic",
                "action"=>"create",
                "topicID"=>111
                )));

$con->disconnect();

?>
