<?php

require_once __ROOT__ . 'models/User.class.php';
require_once __ROOT__ . 'models/Topic.class.php';
require_once __ROOT__ . 'vendors/Tool.php';
require_once __ROOT__ . 'vendors/DB.php';

class SignupController extends BaseController {

    public $ticket;

    public function __construct($action, $urlValues) {
        parent::__construct("main", $action, $urlValues);
    }

    protected function index() {
        if ($this->isLoggedIn()) {
            $this->redirect("base.home");
        }
    }

    protected function ticket() {
        if (isset($this->urlValues["id"])) {
            $this->ticket = $this->urlValues["id"];
        }
    }
    
    protected function register() {
        $this->redirect("base.register/ticket/" . $this->ticket);
    }

}

?>
