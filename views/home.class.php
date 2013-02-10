<?php

require_once __ROOT__ . 'models/User.class.php';
require_once __ROOT__ . 'models/Topic.class.php';
require_once __ROOT__ . 'models/Item.class.php';
require_once __ROOT__ . 'vendors/DB.php';
require_once __ROOT__ . 'vendors/Queue.php';
require_once __ROOT__ . 'vendors/Predis/Autoloader.php';

class HomeController extends BaseController {

    public $topics;
    public $timeline;

    public function __construct($action, $urlValues) {
        parent::__construct("main", $action, $urlValues);
    }

    protected function index() {
        Predis\Autoloader::register();
        $redis = new Predis\Client('tcp://qaalo.com:6379');

        $this->timeline = $redis->zrevrange("user:" . $this->getUserID() . ":timeline", 0, 10, array(
            'withscores' => true)
        );
        
    }

}

?>
