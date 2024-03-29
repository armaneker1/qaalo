<?php

require_once __ROOT__ . 'models/User.class.php';
require_once __ROOT__ . 'vendors/DB.php';
require_once __ROOT__ . 'vendors/Tool.php';

class ForgotController extends BaseController {

    public $email;
    public $sent = false;

    public function __construct($action, $urlValues) {
        parent::__construct("main", $action, $urlValues);
    }

    protected function index() {
        if ($this->isLoggedIn()) {
            $this->redirect("base.home");
        }
    }

    protected function remember() {
        if (!preg_match('/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/', $this->email)) {
            $this->addError("Email is not valid");
        }
        $db = DB::getConnection();
        if (!$this->hasError()) {
            $users = User::findByExample($db, User::create()->setEmail($this->email));
            if (count($users)>0) {
                $user = $users[0];
                
                $params=array(array('name',$user->getFirstname()),array('password',$user->getPassword()),array('email_address',$this->email));
                Tool::sendEmail("remember", $params, $this->email, "Here is your password");
                
                $this->redirect("/");
                
            } else {
                $this->addError("We don't have a user with that email!");
            }
        }
    }

}

?>
