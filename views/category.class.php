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

        $redis = new Predis\Client('tcp://qaalo.com:6379');
        $this->topics = $redis->zrevrange("category:". $this->category->getId() .":timeline", 0, -1, array(
            'withscores' => true));
    }

}

?>
