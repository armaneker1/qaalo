<?php

require_once __ROOT__ . 'vendors/Tool.php';
require_once __ROOT__ . 'vendors/KLogger.php';

abstract class BaseController {

    protected $urlValues;
    protected $action;
    protected $model;
    protected $view;
    protected $template;
    private $errors;
    public $_title = "Qaalo - Everything listed.";
    public $_userID;
    public $_standalone;
    public $log;
    private $metaTags;
    private $metaDescription = "Qaalo is a collaborative social tool where you can create lists with your close network and follow lists matching your interests";

    public function __construct($template, $action, $urlValues, $standalone = false, $signinRequired = false) {
        $this->action = $action;
        $this->urlValues = $urlValues;
        $this->template = $template;
        $this->_standalone = $standalone;
        $this->log = KLogger::instance('/home/ubuntu/log/', KLogger::DEBUG);
        
        echo $this->model;

        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION['userID']) || Tool::autoLogin()) {
            $this->_userID = $_SESSION['userID'];
        } else if ($signinRequired) {
            $this->redirect("/");
        }
    }

    public function getCurrentAction() {
        return $this->action;
    }

    public function getUserID() {
        return $this->_userID;
    }

    public function isLoggedIn() {
        return isset($this->_userID);
    }

    public function executeAction() {
        $vars = array_keys(get_object_vars($this));

        foreach ($_POST as $key => $value) {
            if (in_array($key, $vars)) {
                $this->$key = $value;
            }
        }

        $this->{$this->action}();

        if (!$this->_standalone) {
            require "template/" . $this->template . ".inc.php";
        }
    }

    public function setPageTitle($title) {
        $this->_title = $title;
    }
    
    public function setPageDescription($desc) {
        $this->metaDescription = $desc;
    }

    public function addError($errorMsg) {
        $this->errors[] = $errorMsg;
        $this->hasError = true;
    }

    public function addInfo($str) {
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION["messages"][] = $str;
    }

    public function addMetaTag($tag, $value) {
        $this->metaTags[] = array("name" => $tag, "value" => $value);
    }

    public function hasError() {
        return isset($this->errors);
    }

    public function dumpMetaTags() {
        if (isset($this->metaTags)) {
            $tags = "";
            foreach ($this->metaTags as $metaTag) {
                $tags .="\t<meta property=\"" . $metaTag["name"] . "\" content=\"" . $metaTag["value"] . "\"/>\n";
            }
            echo $tags;
        }
    }
    
    

    public function dumpErrors() {
        if (isset($this->errors)) {
            $msg = "<div class='error'><ul>";
            foreach ($this->errors as $errorMsg) {
                $msg .= "<li>" . $errorMsg . "</li>";
            }
            $msg .= "</ul></div>";
            echo $msg;
        }
    }

    public function redirect($controller, $action = '') {
        header('Location: ' . __WEBROOT__ . $controller . ($action != "" ? "/" . $action : ""));
        die();
    }

    public function getAction($action) {
        return __WEBROOT__ . "base." . $this->urlValues["controller"] . "/" . $action;
    }

    public function getControllerAction($controller, $action) {
        return __WEBROOT__ . "base." . $controller . "/" . $action;
    }

}

?>
