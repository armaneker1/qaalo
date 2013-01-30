<?php

require_once __ROOT__ . 'models/User.class.php';
require_once __ROOT__ . 'models/Topic.class.php';
require_once __ROOT__ . 'models/Item.class.php';
require_once __ROOT__ . 'vendors/DB.php';
require_once __ROOT__ . 'vendors/Tool.php';

class CreateController extends BaseController {

    public $title;
    public $itemText;

    public function __construct($action, $urlValues) {
        parent::__construct("main", $action, $urlValues);
    }

    protected function index() {
        if (!isset($this->_userID)) {
            $this->redirect("base.register");
        }
    }

    protected function create() {
        $db = DB::getConnection();

        if (trim($this->title) == "Enter title here" || trim($this->title) == "") {
            $this->addError("Please enter a valid title");
        }

        $count = 0;
        foreach ($this->itemText as $str) {
            if (strlen($str) > 0 && $str != "Yes, what's next?" && $str != "Enter first item here") {
                $count++;
            }
        }
        if ($count==0) {
            $this->addError("Enter at least 1 item");
        }

        if (!$this->hasError()) {
            $this->setPageTitle($_GET["id"]);

            //Save topic
            $topic = new Topic();
            $topic->setCreatedOn(time());
            $topic->setTitle($this->title);
            $topic->setUserID($this->_userID);
            $topic->setUrl(Tool::getURL($this->title));
            $topic->setInviteCode(Tool::randomString(16));
            $topic->setRate(0);
            $topic->insertIntoDatabase($db);

            //Insert categories
            foreach ($this->itemText as $str) {
                if (strlen($str) > 0 && $str != "Yes, what's next?" && $str != "Enter first item here") {
                    $item = new Item();
                    $item->setText($str);
                    $item->setUserID($this->_userID);
                    $item->setTopicID($topic->getId());
                    $item->setCreatedOn(time());
                    $item->setCommentCount(0);
                    $item->insertIntoDatabase($db);
                }
            }

            $this->redirect("l", Tool::getURL($this->title));
        }
    }

}

?>
