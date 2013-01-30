<?php

require_once __ROOT__ . 'vendors/DB.php';
require_once __ROOT__ . 'vendors/Tool.php';

class LogoutController extends BaseController {


    public function __construct($action, $urlValues) {
        parent::__construct("main", $action, $urlValues);
        
        
        
    }
    
    protected function index() {
        Tool::forgetMe();
        session_destroy();
        
        $this->redirect("base.home");
    }

}

?>
