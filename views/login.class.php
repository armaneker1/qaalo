<?php

require_once __ROOT__ . 'models/User.class.php';
require_once __ROOT__ . 'models/Topic.class.php';
require_once __ROOT__ . 'vendors/Tool.php';
require_once __ROOT__ . 'vendors/DB.php';

class LoginController extends BaseController {

    public $email;
    public $password;
    public $rememberPassword;
    public $inviteCode;

    public function __construct($action, $urlValues) {
        parent::__construct("main", $action, $urlValues);
    }

    protected function index() {
        if (isset($this->urlValues["id"])) {
            $this->inviteCode = $this->urlValues["id"];
        }
        

        if ($this->isLoggedIn()) {
            if (strlen($this->inviteCode) > 0) {
                $this->redirectToTopic();
                return;
            }
            
            $this->redirect("base.home");
        }
    }

    protected function login() {
        if (!preg_match('/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/', $this->email)) {
            $this->addError("Email is not valid");
        }
        if (!$this->hasError()) {
            $db = DB::getConnection();

            $user = User::findByExample($db, User::create()
                                    ->setEmail($this->email)
                                    ->setPassword($this->password)
            );

            if (count($user) > 0) {

                $_SESSION["firstname"] = $user[0]->getFirstname();
                $_SESSION["userID"] = $user[0]->getId();

                if ($this->rememberPassword != '') {
                    Tool::rememberMe($this->email, $this->password);
                } else {
                    Tool::forgetMe();
                }

                if (strlen($this->inviteCode) > 0) {
                    $this->redirectToTopic();
                    return;
                }

                $this->redirect("base.home");
            } else {
                $this->addError("Wrong username/password");
            }
        }
    }

    public function redirectToTopic() {
        $topics = Topic::findByExample(DB::getConnection(), Topic::create()->setInviteCode($this->inviteCode));
        if (count($topics) > 0) {
            $topic = $topics[0];
            $this->redirect("l/" . $topic->getUrl() . "/invitecode/" . $this->inviteCode);
        }
    }

}

?>
