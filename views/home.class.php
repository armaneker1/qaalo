<?php

require_once __ROOT__ . 'models/User.class.php';
require_once __ROOT__ . 'models/Topic.class.php';
require_once __ROOT__ . 'models/Item.class.php';
require_once __ROOT__ . 'vendors/DB.php';
require_once __ROOT__ . 'vendors/Queue.php';
require_once __ROOT__ . 'vendors/Predis/Autoloader.php';


class HomeController extends BaseController {

    public $topics;

    public function __construct($action, $urlValues) {
        parent::__construct("main", $action, $urlValues);
    }

    protected function index() {
        /*
          Predis\Autoloader::register();
          $redis = new Predis\Client();
          $redis->set('foo', 'bar');
          $value = $redis->get('foo');

          echo $value; */
        
        Queue::createList(12, 25);



        $this->topics = Topic::findBySql(DB::getConnection(), "select * from topic where editorsPick=1 order by id desc");
    }

}

?>
