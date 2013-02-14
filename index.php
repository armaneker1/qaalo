<?php

define("__ROOT__", $_SERVER['DOCUMENT_ROOT'] . "/");
define("__WEBROOT__", "/");

require_once __ROOT__ . 'vendors/Predis/Autoloader.php';
require_once __ROOT__ . '_core/loader.php';
require_once __ROOT__ . '_core/basecontroller.php';


Predis\Autoloader::register();

$loader = new Loader();
$controller = $loader->createController();
if (isset($controller)) {
    $controller->executeAction();
}
?>