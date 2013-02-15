<?php

require_once __ROOT__ . 'models/User.class.php';
require_once __ROOT__ . 'vendors/Tool.php';
require_once __ROOT__ . 'vendors/DB.php';

class ValidateController extends BaseController {

    public function __construct($action, $urlValues) {
        parent::__construct("main", $action, $urlValues);
    }

    protected function index() {
        
    }
    
    protected function validate() {
        $validationCode = $_GET["id"];
        $db = DB::getConnection();
        $users = User::findByExample($db, User::create()->setValidationCode($validationCode));
        
        if (count($users) > 0) {
            $user = $users[0];
            if ($user->getEmailValidatedOn() != null) {
                $this->addInfo("You have already validated!");
                echo "validated";
            } else {
                $user->setEmailValidatedOn(time());
                $user->updateToDatabase($db);
                $this->addInfo("Thank you for validating your account :)");
            }
            $this->redirect("base.home");
        }
    }

}

?>
