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
        parent::__construct("main", $action, $urlValues, false, true);
    }

    protected function index() {
        
        $this->setPageTitle("Create your list");
    }

    protected function create() {
        $db = DB::getConnection();


        $this->title = trim($this->title);
        if ($this->title == "Enter title here" || $this->title == "") {
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
                    $item->setText(trim($str));
                    $item->setUserID($this->_userID);
                    $item->setTopicID($topic->getId());
                    $item->setCreatedOn(time());
                    $item->setCommentCount(0);
                    $item->insertIntoDatabase($db);
                }
            }

            /*
             * $text = "Merhaba t.co http://www.test.com/dsasda/mil http://www.test.net/tes";
              $pattern = "/\b[-a-zA-Z0-9@:%_\+.~#?&\/\/=]{1,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&\/\/=]*)?\b/i";

              $offset = 0;
              while (true) {
              preg_match($pattern, $text, $matches, PREG_OFFSET_CAPTURE, $offset);
              if (count($matches) > 0) {
              $offset = $matches[0][1] + strlen($matches[0][0]);
              echo $matches[0][0]."<br>";
              } else {
              break;
              }
              }
             */


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
