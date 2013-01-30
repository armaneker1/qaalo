<?php

define("__ROOT__", $_SERVER['DOCUMENT_ROOT'] . "/");
define("__WEBROOT__", "/");


require_once("_core/loader.php");
require_once __ROOT__ . '_core/basecontroller.php';

$loader = new Loader(); //create the loader object
$controller = $loader->createController(); //creates the requested controller object based on the 'controller' URL value
if (isset($controller)) {
    $controller->executeAction(); //execute the requested controller's requested method based on the 'action' URL value. Controller methods output a View.
}
?>