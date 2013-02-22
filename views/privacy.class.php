<?php

require_once __ROOT__ . 'models/Category.class.php';
require_once __ROOT__ . 'models/Topic.class.php';
require_once __ROOT__ . 'vendors/DB.php';

class PrivacyController extends BaseController {

    

    public function __construct($action, $urlValues) {
        parent::__construct("main", $action, $urlValues);
    }

    protected function index() {
    }

}

?>
