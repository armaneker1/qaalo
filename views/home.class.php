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

    public function __construct($action, $urlValues) {
        parent::__construct("main", $action, $urlValues);
    }

    protected function index() {
        
        $redis = new Predis\Client();
        $db = DB::getConnection();

        $script = <<<LUA
    local hash = redis.call('hgetall', KEYS[1]);
    if #hash == 0 then
        return { err = 'The key "'..KEYS[1]..'" does not exist' }
    end
    return redis.call('hmset', KEYS[2], unpack(hash));
LUA;

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
