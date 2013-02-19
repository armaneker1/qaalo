<?php

require_once __ROOT__ . 'models/User.class.php';
require_once __ROOT__ . 'models/Topic.class.php';
require_once __ROOT__ . 'models/Item.class.php';
require_once __ROOT__ . 'models/Vote.class.php';
require_once __ROOT__ . 'models/Registerticket.class.php';
require_once __ROOT__ . 'vendors/Tool.php';
require_once __ROOT__ . 'vendors/Queue.php';
require_once __ROOT__ . 'vendors/DB.php';

class RegisterController extends BaseController {

    public $fullname;
    public $email;
    public $password;
    public $passwordConfirm;
    public $rememberPassword;
    public $inviteCode;
    public $ticket;
    public $itemText;
    public $topicID;
    public $itemID;
    public $voteDir;

    public function __construct($action, $urlValues) {
        parent::__construct("main", $action, $urlValues);

        $this->setPageTitle("Register");
    }

    protected function index() {
        if ($this->isLoggedIn()) {
            $this->redirect("base.home");
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
        if ($this->isLoggedIn()) {
            $this->redirect("base.home");
        }

        if (strlen($this->fullname) < 3) {
            $this->addError("Your name seems to be invalid");
        }

        $db = DB::getConnection();
        if (!preg_match('/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/', $this->email)) {
            $this->addError("Email is not valid");
        } else {
            if (count(User::findByExample($db, User::create()->setEmail(strtolower(trim($this->email))))) > 0) {
                $this->addError("Email is in use. Did you register before?");
            }
        }

        if ($this->password != $this->passwordConfirm) {
            $this->addError("Passwords doesn't match");
        } else if (!preg_match('/^[a-zA-Z0-9]{6,18}$/ ', $this->password)) {
            $this->addError("Password is not valid. Only a-z,A-Z and 0-9!");
        }

        if (!$this->hasError()) {

            $validationCode = Tool::randomString(16);

            $user = new User();
            $user->setFullname($this->fullname);
            $user->setEmail(strtolower(trim($this->email)));
            $user->setPassword($this->password);
            $user->setLastLogin(time());
            $user->setValidationCode($validationCode);
            $user->insertIntoDatabase($db);

            if ($this->rememberPassword != '') {
                Tool::rememberMe($this->email, $this->password);
                $this->addInfo("Welcome to Qaalo!");
            } else {
                Tool::forgetMe();
            }

            $params = array(array('name', $user->getFirstname()), array('validationCode', $validationCode), array('email_address', $user->getEmail()));
            Tool::sendEmail("welcome", $params, $user->getEmail(), "Welcome to Qaalo");

            if (Tool::inviteIsValid($this->inviteCode)) {

                if ($this->itemText != "" && count($this->itemText) > 0) {
                    $topic = Topic::findById($db, $this->topicID);
                    if (isset($topic)) {
                        $lastItemId = -1;
                        foreach ($this->itemText as $str) {
                            if (strlen($str) > 0 && $str != "Yes, what's next?" && $str != "Enter first item here" && $str != "You have something to add?") {
                                $item = new Item();
                                $item->setText(trim($str));
                                $item->setUserID($user->getId());
                                $item->setTopicID($this->topicID);
                                $item->setCreatedOn(time());
                                $item->setCommentCount(0);
                                $item->insertIntoDatabase($db);
                                $lastItemId = $item->getId();
                            }
                        }
                        if ($lastItemId != -1) {
                            Queue::addItem($lastItemId);
                        }
                    }
                }
            }

            if ($this->itemID != "") {
                $item = Item::findById($db, $this->itemID);
                if ($item) {
                    $vote = new Vote();
                    $vote->setUserID($user->getId());
                    $vote->setItemID($this->itemID);
                    $vote->setRate($this->voteDir);
                    $vote->setCreatedOn(time());
                    $vote->insertIntoDatabase($db);

                    if ($this->voteDir == 1) {
                        $item->setVoteUp($item->getVoteUp() + 1);
                    } else {
                        $item->setVoteDown($item->getVoteDown() + 1);
                    }
                    $item->updateToDatabase($db);

                    $topic = Topic::findById($db, $this->topicID);
                    if (isset($topic)) {
                        if ($this->rememberPassword != '') {
                            $this->redirect("l/" . $topic->getUrl());
                        }
                    }
                }
            }

            $this->redirect("base.login/index/" . $this->inviteCode);
        }
    }

    public function ticketIsValid($ticketCode, $use = false) {
        if (trim($ticketCode) == "") {
            return false;
        }
        $db = DB::getConnection();
        $tickets = Registerticket::findByExample($db, Registerticket::create()->setCode($ticketCode));
        if (count($tickets) > 0) {
            $ticket = $tickets[0];
            if ($ticket->getQty() > 0) {
                if ($use) {
                    $ticket->setQty($ticket->getQty() - 1);
                    $ticket->setLastUsedOn(time());

                    $ticket->updateToDatabase($db);
                }
                return true;
            } else {
                return false;
            }
        }
    }

}

?>
