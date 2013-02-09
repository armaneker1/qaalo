<?php
define("__ROOT__", $_SERVER['DOCUMENT_ROOT'] . "/");
define("__WEBROOT__", "/");

//if (!isset($_POST["name"])) {die();}
$data = $_GET["data"];
$obj = json_decode($data);

$method = $obj->method;
$action = $obj->action;
unset($obj->method);
unset($obj->action);

$processorClass = ucfirst(strtolower($method)) . "Processor";

if (!file_exists(__ROOT__ . "processor/" . $method . ".class.php")) {
    header('HTTP/1.0 404 Not Found');
    die();
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
    } else {
        header('HTTP/1.0 404 Not Found');
    }
} else {
    header('HTTP/1.0 404 Not Found');
}


?>
