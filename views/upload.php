<?php

define("__ROOT__", $_SERVER['DOCUMENT_ROOT'] . "/");

require_once __ROOT__ . 'vendors/Tool.php';
require_once __ROOT__ . 'vendors/DB.php';
require_once __ROOT__ . 'vendors/Image.php';
require_once __ROOT__ . 'models/User.class.php';



if (!isset($_FILES) || !isset($_FILES["file"]) || $_FILES["file"]["error"][0] > 0 || !Tool::isValidImage($_FILES["file"]["type"][0], $_FILES["file"]["name"][0])) {
    echo json_encode(array("error" => "error0"));
    die();
}



session_start();
if (!isset($_SESSION["userID"]) && !Tool::autoLogin()) {
    echo json_encode(array("error" => "error1"));
    die();
}

$db = DB::getConnection();

$userID = $_SESSION["userID"];
$user = User::findById($db, $userID);

if ($user) {
    $filePrefix = $userID . Tool::randomString(6);
    $fileName = $filePrefix . "." . end(explode(".", $_FILES["file"]["name"][0]));
    $filePath = __ROOT__ . "inc/img/user/";

    move_uploaded_file($_FILES["file"]["tmp_name"][0], $filePath . $fileName);
    $resizeObj = new Image($filePath . $fileName);
    $resizeObj->resizeImage(60, 60, 'crop');
    $resizeObj->saveImage($filePath . "t" . $fileName, 90);

    $resizeObj = new Image($filePath . $fileName);
    $resizeObj->resizeImage(95, 95, 'crop');
    $resizeObj->saveImage($filePath . $fileName, 90);

    $user->setPhoto($filePrefix);
    $user->updateToDatabase($db);
    
    echo json_encode(array("filename" => $fileName));
} else {
    echo json_encode(array("error" => "error2"));
    die();
}
?>