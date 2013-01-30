<?php

class Loader {
    
    private $controllerName;
    private $controllerClass;
    private $action;
    private $urlValues;
    private $backRequest;
    
    public function __construct() {
        $this->urlValues = $_GET;
        $this->backRequest = isset($_GET["t"]) ? true : false;
        
        if (!isset($this->urlValues['controller']) || $this->urlValues['controller'] == "") {
            $this->controllerName = "home";
            $this->controllerClass = "HomeController";
            $this->urlValues["controller"] = "home";
            $this->urlValues["action"] = "";
            $this->urlValues["id"] = "";
        } else {
            $this->controllerName = strtolower($this->urlValues['controller']);
            $this->controllerClass = ucfirst(strtolower($this->urlValues['controller'])) . "Controller";
        }
        
        if (!isset($this->urlValues['action']) || $this->urlValues['action'] == "") {
            $this->action = "index";
        } else {
            $this->action = $this->urlValues['action'];
        }
        
    }
                  
    public function createController() {
        if ($this->backRequest == true && file_exists("back/" . $this->controllerName . ".class.php")) {
            require("back/" . $this->controllerName . ".class.php");
        } else if (file_exists("views/" . $this->controllerName . ".class.php")) {
            require("views/" . $this->controllerName . ".class.php");
        } else {
            require("views/error.php");
            return;
        }
                
        if (class_exists($this->controllerClass)) {
            $parents = class_parents($this->controllerClass);
            
            if (in_array("BaseController",$parents)) {   
                if (method_exists($this->controllerClass,$this->action))
                {
                    return new $this->controllerClass($this->action,$this->urlValues);
                } else {
                    require("controllers/error.php");
                    return new ErrorController("badurl",$this->urlValues);
                }
            } else {
                require("controllers/error.php");
                return new ErrorController("badurl",$this->urlValues);
            }
        } else {
            require("views/error.php");
            return;
        }
    }
}

?>
