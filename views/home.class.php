<?php
require_once __ROOT__ .'models/User.class.php';
require_once __ROOT__ .'models/Topic.class.php';
require_once __ROOT__ .'models/Item.class.php';
require_once __ROOT__ .'vendors/DB.php';


class HomeController extends BaseController {

    public $topics;

    public function __construct($action, $urlValues) {
        parent::__construct("main", $action, $urlValues);
    }

    protected function index() {
        $this->topics = Topic::findBySql(DB::getConnection(), "select * from topic where editorsPick=1 order by id desc");
    }
    
    
    

    
}

?>
