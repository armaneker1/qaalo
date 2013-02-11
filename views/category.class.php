<?php

require_once __ROOT__ . 'models/Category.class.php';
require_once __ROOT__ . 'models/Topic.class.php';
require_once __ROOT__ . 'vendors/DB.php';
require_once __ROOT__ . 'vendors/Tool.php';

class CategoryController extends BaseController {

    public $topics;
    public $category;
    
    public function __construct($action, $urlValues) {
        parent::__construct("main", $action, $urlValues);
    }

    protected function index() {
        $categoryName = $_GET["id"];
        $db = DB::getConnection();
        $categories = Category::findByExample($db, Category::create()->setName($categoryName));
        if (count($categories) == 0) {
            $this->redirect("/");
        }
        $this->category = $categories[0];
        
        $this->topics = Topic::findBySql($db,"select * from topic where id in (select topicID from topiccategorylink where categoryID=". $this->category->getId() .") order by id desc" );
    }

    

}

?>
