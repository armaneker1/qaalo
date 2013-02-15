<?php

define("__ROOT__", $_SERVER['DOCUMENT_ROOT'] . "/");

require_once __ROOT__ . 'vendors/DB.php';
require_once __ROOT__ . 'models/User.class.php';


$users = User::findBySql(DB::getConnection(),"select * from user");

echo "<h1>". count($users) ."</h1>";


?>