<?php

require_once __ROOT__ . 'models/User.class.php';
require_once __ROOT__ . 'models/Topic.class.php';
require_once __ROOT__ . 'models/Item.class.php';
require_once __ROOT__ . 'models/Vote.class.php';
require_once __ROOT__ . 'models/Writer.class.php';
require_once __ROOT__ . 'models/Category.class.php';
require_once __ROOT__ . 'models/UserCategoryLink.class.php';
require_once __ROOT__ . 'vendors/DB.php';
require_once __ROOT__ . 'vendors/Tool.php';
require_once __ROOT__ . 'vendors/Queue.php';

class TopicController extends BaseController {

    public $topicText;
    public $title;
    public $topic;
    public $searchKeyword;
    public $items;
    public $user;
    public $totalVotes = 0;
    public $itemText;
    public $topicID;
    public $writers;
    public $isWriter = false;
    public $isInvited = false;
    public $inviteCode;
    public $categories;
    public $emails;

    public function __construct($action, $urlValues) {
        parent::__construct("main", $action, $urlValues);

        $this->setPageDescription(null);
    }

    protected function add() {
        $db = DB::getConnection();

        $this->setPageTitle($_GET["id"]);

        $topic = Topic::findById($db, $this->topicID);
        if (isset($topic)) {

            $lastItemId = -1;
            //Insert categories
            foreach ($this->itemText as $str) {
                if (strlen($str) > 0 && $str != "Yes, what's next?" && $str != "Enter first item here" && $str != "You have something to add?") {
                    $item = new Item();
                    $item->setText($str);
                    $item->setUserID($this->_userID);
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

            $this->redirect("l", $topic->getUrl());
        } else {
            $this->redirect("error");
        }
    }

    protected function invite() {
        $db = DB::getConnection();
        $topic = Topic::findById($db, $this->topicID);
        if (isset($topic) && $this->checkWriter($this->topicID)) {

            $emailArray = explode(",", $this->emails);
            $emailStr = "";
            foreach ($emailArray as $email) {
                $email = trim($email);
                if (preg_match('/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/', $email)) {
                    $emailStr .= $email . ",";
                }
            }

            if (strlen($emailStr) > 0) {
                $emailStr = substr($emailStr, 0, strlen($emailStr) - 1);
                Queue::inviteToTopic($this->getUserID(), $this->topicID, $emailStr);
            }

            $this->addInfo("Invitations sent");
            $this->redirect("l", $topic->getUrl());
        } else {
            $this->redirect("/");
        }
    }

    protected function search() {
        $this->redirect("topic", $this->searchKeyword);
    }

    protected function index() {
        $this->setPageTitle($_GET["id"]);
        $this->title = $_GET["id"];
    }

    protected function view() {
        $this->title = $_GET["id"];
        $db = DB::getConnection();
        $topics = Topic::findByExample($db, Topic::create()->setUrl($this->title));
        if (count($topics) > 0) {
            $this->topic = $topics[0];
            $this->items = Item::findByExample($db, Item::create()->setTopicID($this->topic->getId()));

            $writersID = array();
            foreach ($this->items as $item) {
                $votes = Vote::findByExample($db, Vote::create()->setItemID($item->getId())->setUserID($this->_userID));
                if (count($votes) > 0) {
                    $vote = $votes[0];
                    $item->vote = $vote->getRate();
                }
                $this->totalVotes += $item->getVoteUp() + $item->getVoteDown();

                if (!in_array($item->getUserID(), $writersID)) {
                    $writersID[] = $item->getUserID();
                }
            }

            foreach ($writersID as $userID) {
                $user = User::findById($db, $userID);
                if (isset($user)) {
                    $this->writers[] = array($user->getFullname(), $user->getThumbPhotoUrl(), $user->getId());
                }
            }


            $this->categories = Category::findBySql($db, "select * from category where id in (select categoryID from topiccategorylink where topicID=" . $this->topic->getId() . ")");
            foreach ($this->categories as $category) {
                if (count(UserCategoryLink::findByExample($db, UserCategoryLink::create()->setUserId($this->getUserID())->setCategoryId($category->getId()))) > 0) {
                    $category->isFollowed = true;
                }

                if (!isset($_SESSION["categories"]) || !in_array($category->getId(), $_SESSION["categories"])) {
                    $_SESSION["categories"][] = $category->getId();
                }
            }

            usort($this->items, function($a, $b) {
                        $voteA = $a->getVoteUp() - $a->getVoteDown();
                        $voteB = $b->getVoteUp() - $b->getVoteDown();
                        if ($voteA == $voteB) {
                            return $a->getID() > $b->getID();
                        } else {
                            return $voteA > $voteB ? -1 : 1;
                        }
                    });


            //Check if user is writer
            $this->isWriter = $this->checkWriter($this->topic->getId());




            if (!$this->isWriter && isset($this->urlValues["inviteCode"])) {
                if ($this->inviteIsValid($this->urlValues["inviteCode"])) {
                    if ($this->isLoggedIn()) {

                        $writer = new Writer();
                        $writer->setTopicID($this->topic->getId());
                        $writer->setUserID($this->_userID);
                        $writer->setCreatedOn(time());
                        $writer->insertIntoDatabase($db);

                        $this->isWriter = true;
                    } else {
                        $this->inviteCode = $this->urlValues["inviteCode"];
                        $this->isInvited = true;
                    }
                }
            }

            $this->topic->setViewCount($this->topic->getViewCount() + 1);
            $this->topic->updateToDatabase($db);

            $this->user = User::findById($db, $this->topic->getUserID());
            $this->setPageTitle($this->topic->getTitle());

            $itemsStr = "";
            $a = 1;
            foreach ($this->items as $item) {
                $itemsStr .= $a . ") " . Tool::trimDomainInItem($item->getText()) . ", ";
                $a++;
                if ($a > 4) {
                    break;
                }
            }

            $itemsStr = substr($itemsStr, 0, strlen($itemsStr) - 2) . " ...";

            $this->addMetaTag("og:title", $this->topic->getTitle());
            $this->addMetaTag("og:description", $itemsStr);
            $this->addMetaTag("og:image", "http://qaalo.com/inc/qaaloSquare.png");
            $this->addMetaTag("og:type", "article");
            $this->addMetaTag("og:site_name", "Qaalo");
        } else {
            $this->redirect("404");
        }
    }

    public function inviteIsValid($inviteCode) {
        if (trim($inviteCode) == "")
            return false;
        $db = DB::getConnection();
        $tickets = Topic::findByExample($db, Topic::create()->setInviteCode($inviteCode));
        if (count($tickets) > 0) {
            return true;
        } else {
            return false;
        }
    }

    private function checkWriter($topicID) {
        if ($this->isLoggedIn()) {
            $writers = Writer::findByExample(DB::getConnection(), Writer::create()->setTopicID($topicID)->setUserID($this->getUserID()));
            return count($writers) > 0;
        }
    }

}

?>
