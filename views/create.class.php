<?php

require_once __ROOT__ . 'models/Writer.class.php';
require_once __ROOT__ . 'models/User.class.php';
require_once __ROOT__ . 'models/Topic.class.php';
require_once __ROOT__ . 'models/Item.class.php';
require_once __ROOT__ . 'models/Category.class.php';
require_once __ROOT__ . 'models/TopicCategoryLink.class.php';
require_once __ROOT__ . 'models/UserCategoryLink.class.php';
require_once __ROOT__ . 'vendors/DB.php';
require_once __ROOT__ . 'vendors/Tool.php';
require_once __ROOT__ . 'vendors/Queue.php';

class CreateController extends BaseController {

    public $title;
    public $itemText;
    public $categories;

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
        if ($count == 0) {
            $this->addError("Enter at least 1 item");
        }

        if (trim($this->categories) == "") {
            $this->addError("Select a category");
        }

        if (!$this->hasError()) {
            $this->setPageTitle($_GET["id"]);
            //TODO check for existing url
            //Save topic
            $topic = new Topic();
            $topic->setCreatedOn(time());
            $topic->setTitle($this->title);
            $topic->setUserID($this->_userID);
            $topic->setUrl(Tool::getURL($this->title));
            $topic->setInviteCode(Tool::randomString(16));
            $topic->setRate(0);
            $topic->insertIntoDatabase($db);

            //Insert items
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

            //Insert categories
            $categories = explode(",", $this->categories);
            foreach ($categories as $category) {
                $categoryID = 0;
                if (is_numeric($category)) {
                    $categoryID = $category;
                } else {
                    $newCategory = new Category();
                    $newCategory->setLinkCount(1);
                    $newCategory->setName($category);
                    $newCategory->setUserID($this->getUserID());
                    $newCategory->setUrl(Tool::getURL($category));
                    $newCategory->insertIntoDatabase($db);
                    $categoryID = $newCategory->getId();

                    $link = new UserCategoryLink();
                    $link->setCategoryId($categoryID);
                    $link->setUserId($this->getUserID());
                    $link->insertIntoDatabase($db);
                }

                $link = new TopicCategoryLink();
                $link->setCategoryId($categoryID);
                $link->setTopicId($topic->getId());
                $link->insertIntoDatabase($db);
            }

            $writer = new Writer();
            $writer->setTopicID($topic->getId());
            $writer->setUserID($this->getUserID());
            $writer->setCreatedOn(time());
            $writer->insertIntoDatabase($db);


            Queue::createList($topic->getId());



            $this->addInfo("Yay, we have a new list now :)");
            $this->redirect("l", Tool::getURL($this->title));
        }
    }

}

?>
