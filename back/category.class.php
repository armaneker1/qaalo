<?php

require_once __ROOT__ . 'models/Category.class.php';
require_once __ROOT__ . 'models/UserCategoryLink.class.php';
require_once __ROOT__ . 'vendors/DB.php';
require_once __ROOT__ . 'vendors/Queue.php';

/**
 * Description of Vote
 *
 * @author mehmet
 */
class CategoryController extends BaseController {

    public $query;
    public $categoryID;

    public function __construct($action, $urlValues) {
        parent::__construct("main", $action, $urlValues, true);
    }

    public function search() {
        $db = DB::getConnection();
        $items = Category::findBySql($db, "select * from category where name like '%" . $this->query . "%'");
        $res = array();
        foreach ($items as $item) {
            $res[] = array("name" => $item->getName(), "id" => $item->getId());
        }

        echo json_encode($res);
    }

    public function follow() {
        if ($this->isLoggedIn()) {
            $db = DB::getConnection();
            
            $categories = UserCategoryLink::findByExample($db, UserCategoryLink::create()->setCategoryId($this->categoryID)->setUserId($this->getUserID()));
            if (count($categories)>0) {
                $category = $categories[0];
                $category->deleteFromDatabase($db);
                Queue::unfollowCategory($this->getUserID(), $this->categoryID);
                echo "unfollowed";
            } else {
                $link = new UserCategoryLink();
                $link->setCategoryId($this->categoryID);
                $link->setUserId($this->getUserID());
                $link->insertIntoDatabase($db);
                Queue::followCategory($this->getUserID(), $this->categoryID);
                echo "followed";
            }
        } else {
            echo "error";
        }
    }

}

?>
