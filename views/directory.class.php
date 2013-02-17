<?php

require_once __ROOT__ . 'models/Topic.class.php';
require_once __ROOT__ . 'models/Category.class.php';
require_once __ROOT__ . 'vendors/Tool.php';
require_once __ROOT__ . 'vendors/DB.php';

class DirectoryController extends BaseController {

    public $topics;
    public $categories;
    private $validTitles = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "A");

    public function __construct($action, $urlValues) {
        parent::__construct("main", $action, $urlValues);
    }

    protected function index() {
    }

    protected function lists() {
        if (isset($_GET["id"])) {
            $query = $_GET["id"];
            if (in_array( $query,$this->validTitles)) {
                $db = DB::getConnection();
                $this->topics = Topic::findBySql($db, "select * from topic where title ". $this->getQuery($query));
                return;
            }
        }
        $this->redirect("base.directory");
    }

    protected function category() {
        if (isset($_GET["id"])) {
            $query = $_GET["id"];
            if (in_array( $query,$this->validTitles)) {
                $db = DB::getConnection();
                $this->categories = Category::findBySql($db, "select * from category where name ". $this->getQuery($query));
                return;
            }
        }
        $this->redirect("base.directory");
    }

    private function getQuery($query) {
        if ($query == "A") {
            return "REGEXP '^[#0-9]'";
        } else {
            return "LIKE '".$query ."%'";
        }
        
    }
    
}

?>
