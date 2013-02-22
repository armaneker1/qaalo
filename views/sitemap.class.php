<?php

require_once __ROOT__ . 'models/Category.class.php';
require_once __ROOT__ . 'models/Topic.class.php';
require_once __ROOT__ . 'vendors/DB.php';

class SitemapController extends BaseController {

    public $topics;
    public $categories;

    public function __construct($action, $urlValues) {
        parent::__construct(null, $action, $urlValues);
    }

    protected function index() {
        header('Content-type: text/xml');
        $db = DB::getConnection();
        $this->topics = Topic::findBySql($db, "select * from topic");
        $this->categories = Category::findBySql($db, "select * from category");
        
    }

}

?>
