<?php

require_once __ROOT__ . 'models/User.class.php';
require_once __ROOT__ . 'models/Topic.class.php';
require_once __ROOT__ . 'models/Item.class.php';
require_once __ROOT__ . 'models/Vote.class.php';
require_once __ROOT__ . 'vendors/Tool.php';
require_once __ROOT__ . 'vendors/DB.php';
require_once __ROOT__ . 'vendors/Queue.php';

class LoginController extends BaseController {

    public $email;
    public $password;
    public $rememberPassword;
    public $inviteCode;
    public $itemText;
    public $topicID;
    public $itemID;
    public $voteDir;

    public function __construct($action, $urlValues) {
        parent::__construct("main", $action, $urlValues);

        $this->setPageTitle("Login");
    }

    protected function index() {
        
        if (!$this->inviteCode && isset($this->urlValues["id"])) {
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

            $users = User::findByExample($db, User::create()
                                    ->setEmail($this->email)
                                    ->setPassword($this->password)
            );

            if (count($users) > 0) {
                $user = $users[0];
                $_SESSION["firstname"] = $user->getFirstname();
                $_SESSION["userID"] = $user->getId();

                if ($this->rememberPassword != '') {
                    Tool::rememberMe($this->email, $this->password);
                } else {
                    Tool::forgetMe();
                }

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
                    $votes = Vote::findByExample($db, Vote::create()->setItemID($this->itemID)->setUserID($user->getId()));
                    $item = Item::findById($db, $this->itemID);
                    
                    if (count($votes) > 0) {
                        $vote = $votes[0];
                        if ($vote->getRate() == $this->voteDir) { //Delete vote
                            $vote->deleteFromDatabase($db);
                            if ($this->voteDir == 1) {
                                $item->setVoteUp($item->getVoteUp() - 1);
                            } else {
                                $item->setVoteDown($item->getVoteDown() - 1);
                            }
                            $item->updateToDatabase($db);
                        } else { //Update vote
                            $vote->setRate($this->voteDir);
                            $vote->updateToDatabase($db);

                            if ($this->voteDir == -1) {
                                $item->setVoteUp($item->getVoteUp() - 1);
                                $item->setVoteDown($item->getVoteDown() + 1);
                            } else {
                                $item->setVoteUp($item->getVoteUp() + 1);
                                $item->setVoteDown($item->getVoteDown() - 1);
                            }
                            $item->updateToDatabase($db);
                        }
                    } else { //Create new vote
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
                    }


                    $topic = Topic::findById($db, $this->topicID);
                    if ($topic) {
                        $this->redirect("l/" . $topic->getUrl());
                    }
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
