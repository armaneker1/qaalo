<?php

require_once __ROOT__ . 'models/User.class.php';
require_once __ROOT__ . 'models/Topic.class.php';
require_once __ROOT__ . 'models/Item.class.php';
require_once __ROOT__ . 'models/Category.class.php';
require_once __ROOT__ . 'models/UserCategoryLink.class.php';
require_once __ROOT__ . 'vendors/DB.php';
require_once __ROOT__ . 'vendors/Queue.php';
require_once __ROOT__ . 'vendors/Predis/Autoloader.php';

class HomeController extends BaseController {

    public $timeline;
    public $trendingCategories;

    public function __construct($action, $urlValues) {
        parent::__construct("main", $action, $urlValues);
    }

    protected function index() {
        Predis\Autoloader::register();
        $redis = new Predis\Client('tcp://qaalo.com:6379');
        $db = DB::getConnection();

        $this->timeline = $redis->zrevrange("user:" . $this->getUserID() . ":timeline", 0, 10, array(
            'withscores' => true)
        );

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
