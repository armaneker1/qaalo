<?php

require_once __ROOT__ . 'models/User.class.php';
require_once __ROOT__ . 'models/Topic.class.php';
require_once __ROOT__ . 'vendors/Tool.php';
require_once __ROOT__ . 'vendors/DB.php';

class SettingsController extends BaseController {
    public $user;

    public function __construct($action, $urlValues) {
        parent::__construct("main", $action, $urlValues,false, true);
    }

    protected function index() {
        $this->user = User::findById(DB::getConnection(), $this->_userID);        
    }

   

}

?>
