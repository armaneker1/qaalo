<?php

require_once __ROOT__ . 'models/User.class.php';
require_once __ROOT__ . 'models/Topic.class.php';
require_once __ROOT__ . 'models/Registerticket.class.php';
require_once __ROOT__ . 'vendors/Tool.php';
require_once __ROOT__ . 'vendors/DB.php';

class RegisterController extends BaseController {

    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $passwordConfirm;
    public $rememberPassword;
    public $inviteCode;
    public $ticket;

    public function __construct($action, $urlValues) {
        parent::__construct("main", $action, $urlValues);
    }

    protected function index() {
        if ($this->isLoggedIn()) {
            $this->redirect("base.home");
            return;
        }
        
        if (isset($this->urlValues["id"])) {
            $this->inviteCode = $this->urlValues["id"];
            if (!$this->inviteIsValid($this->inviteCode)) {
                $this->redirect("base.signup");
                return;
            }
        } else {
            $this->redirect("base.signup");
            return;
        }
    }

    public function ticket() {
        if (isset($this->urlValues["id"])) {
            $this->ticket = $this->urlValues["id"];
            if (!$this->ticketIsValid($this->ticket)) {
                $this->redirect("base.signup/ticket/" . $this->ticket);
            }
        }
    }

    protected function register() {
        if (strlen($this->firstname) < 3) {
            $this->addError("Your first name is not valid");
        }
        if (strlen($this->lastname) < 3) {
            $this->addError("Your last name is not valid");
        }

        if (!preg_match('/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/', $this->email)) {
            $this->addError("Email is not valid");
        }

        if ($this->password != $this->passwordConfirm) {
            $this->addError("Passwords doesn't match");
        } else if (!preg_match('/^[a-z0-9]{6,18}$/ ', $this->password)) {
            $this->addError("Password is not valid");
        }

        $db = DB::getConnection();

        if (count(User::findByExample($db, User::create()->setEmail($this->email))) > 0) {
            $this->addError("Email is in use. Did you register before?");
        }


        if (!$this->hasError()) {

            if (!$this->ticketIsValid($this->ticket, true)) {
                $this->redirect("base.signup");
                return;
            }

            $user = new User();
            $user->setFirstname($this->firstname);
            $user->setLastname($this->lastname);
            $user->setEmail($this->email);
            $user->setPassword($this->password);
            $user->setLastLogin(time());
            $user->insertIntoDatabase($db);

            if ($this->rememberPassword != '') {
                Tool::rememberMe($this->email, $this->password);
            } else {
                Tool::forgetMe();
            }
            
            $params=array(array('name',$user->getFirstname()),array('email_address',$user->getEmail()));
            Tool::sendEmail("welcome", $params, $user->getEmail(), "Welcome to Qaalo");

            $this->redirect("base.login/index/" . $this->inviteCode);
        }
    }

    public function ticketIsValid($ticketCode, $use = false) {
        if ( trim($ticketCode) == "") return false;
        $db = DB::getConnection();
        $tickets = Registerticket::findByExample($db, Registerticket::create()->setCode($ticketCode));
        if (count($tickets) > 0) {
            $ticket = $tickets[0];
            if ($ticket->getQty() > 0) {
                if ($use) {
                    $ticket->setQty($ticket->getQty() - 1);
                    $ticket->setLastUsedOn(time());
                    
                    var_dump($ticket);
                    $ticket->updateToDatabase($db);
                }
                return true;
            } else {
                return false;
            }
        }
    }
    
    public function inviteIsValid($inviteCode) {
        if ( trim($inviteCode) == "") return false;
        $db = DB::getConnection();
        $tickets = Topic::findByExample($db, Topic::create()->setInviteCode($inviteCode));
        if (count($tickets) > 0) {
            return true;
        } else {
            return false;
        }
    }

}

?>
