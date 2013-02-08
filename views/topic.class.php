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

    public function __construct($action, $urlValues) {
        parent::__construct("main", $action, $urlValues);
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
                //$item->setText($item);
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
                    $this->writers[] = array($user->getFullname(), $user->getThumbPhotoUrl());
                }
            }


            $this->categories = Category::findBySql($db, "select * from category where id in (select categoryID from topiccategorylink where topicID=" . $this->topic->getId() . ")");
            foreach ($this->categories as $category) {
                if (count(UserCategoryLink::findByExample($db, UserCategoryLink::create()->setUserId($this->getUserID())->setCategoryId($category->getId()))) > 0) {
                    $category->isFollowed = true;
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
            if ($this->isLoggedIn()) {
                if ($this->topic->getUserID() == $this->_userID) {
                    $this->isWriter = true;
                } else {
                    $writers = Writer::findByExample($db, Writer::create()->setTopicID($this->topic->getId())->setUserID($this->_userID));
                    $this->isWriter = count($writers) > 0;
                }
            }




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

}

?>
