<?php

require_once __ROOT__ . 'models/User.class.php';
require_once __ROOT__ . 'models/Topic.class.php';
require_once __ROOT__ . 'models/Item.class.php';
require_once __ROOT__ . 'models/Category.class.php';
require_once __ROOT__ . 'models/UserCategoryLink.class.php';
require_once __ROOT__ . 'vendors/DB.php';
require_once __ROOT__ . 'vendors/Queue.php';

class HomeController extends BaseController {

    public $timeline;
    public $trendingCategories;
    public $categories;

    public function __construct($action, $urlValues) {
        parent::__construct("main", $action, $urlValues);
    }
    
    protected function addCategory() {
        $db = DB::getConnection();
        $added = false;
        $categories = explode(",", $this->categories);
        foreach ($categories as $category) {
            $categoryID = 0;
            if (is_numeric($category)) {
                $categoryID = $category;
                if ( count( UserCategoryLink::findByExample($db, UserCategoryLink::create()->setCategoryId($categoryID)->setUserId($this->getUserID())) )>0 ) {
                    continue;
                }
            } else {
                $newCategory = new Category();
                $newCategory->setLinkCount(1);
                $newCategory->setName($category);
                $newCategory->setUserID($this->getUserID());
                $newCategory->setUrl(Tool::getURL($category));
                $newCategory->insertIntoDatabase($db);
                $categoryID = $newCategory->getId();
            }
            
            $added = true;

            Queue::followCategory($this->getUserID(), $categoryID);
            
            $link = new UserCategoryLink();
            $link->setCategoryId($categoryID);
            $link->setUserId($this->getUserID());
            $link->insertIntoDatabase($db);
        }
        if ($added) {
            $this->addInfo("you are following new categories now");
        }
        $this->redirect("base.home");
    }

    protected function index() {
        $db = DB::getConnection();
        if (isset($_SESSION) && isset($_SESSION["categories"])) {
            foreach ($_SESSION["categories"] as $cat) {
                if (count(UserCategoryLink::findByExample($db, UserCategoryLink::create()->setUserId($this->getUserID())->setCategoryId($cat))) == 0) {
                    $category = Category::findById($db, $cat);
                    if ($category) {
                    $this->categories[] = array("name"=>$category->getId(),"value"=>$category->getName());
                    }
                }
            }
        }
        
        $redis = new Predis\Client();
        

        if ($this->isLoggedIn()) {
            $this->timeline = $redis->zrevrange("user:" . $this->getUserID() . ":timeline", 0, 20, array(
                'withscores' => true)
            );
            
        } else {
            $this->timeline = $redis->zrevrange("main:timeline", 0, -1, array('withscores' => true)
            );
        }

        $categories = $redis->zrevrange("trendingCategories:current", 0, 10);
        if (count($categories) > 0) {
            $this->trendingCategories = Category::findBySql($db, "select * from category where id in (" . implode(",", $categories) . ")");
            foreach ($this->trendingCategories as $category) {
                if (count(UserCategoryLink::findByExample($db, UserCategoryLink::create()->setUserId($this->getUserID())->setCategoryId($category->getId()))) > 0) {
                    $category->isFollowed = true;
                    
                }
            }
        }
    }

}

?>
