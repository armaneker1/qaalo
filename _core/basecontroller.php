<?php
require_once __ROOT__ . 'vendors/Tool.php';

/*
 * Project: Nathan MVC
 * File: /classes/basecontroller.php
 * Purpose: abstract class from which controllers extend
 * Author: Nathan Davison
 */

abstract class BaseController {

    protected $urlValues;
    protected $action;
    protected $model;
    protected $view;
    protected $template;
    private $errors;
    public $_title = "Qaalo";
    public $_userID;
    public $_standalone;

    public function __construct($template, $action, $urlValues, $standalone = false, $signinRequired = false) {
        $this->action = $action;
        $this->urlValues = $urlValues;
        $this->template = $template;
        $this->_standalone = $standalone;

        session_start();
        if (isset($_SESSION['userID']) || Tool::autoLogin()) {
            $this->_userID = $_SESSION['userID'];
        } else if ($signinRequired) {
            $this->redirect("/");
        }
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
        $this->_title = $title ." - Qaalo";
    }

    public function addError($errorMsg) {
        $this->errors[] = $errorMsg;
        $this->hasError = true;
    }

    public function hasError() {
        return isset($this->errors);
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
    }

    public function getAction($action) {
        return __WEBROOT__ . "base." . $this->urlValues["controller"] . "/" . $action;
    }

    public function getControllerAction($controller, $action) {
        return __WEBROOT__ . "base." . $controller . "/" . $action;
    }

}

?>
