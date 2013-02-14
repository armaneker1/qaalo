<?php

require_once __ROOT__ . 'vendors/DB.php';
require_once __ROOT__ . 'models/User.class.php';
require_once __ROOT__ . 'models/Category.class.php';
require_once __ROOT__ . 'processor/scriptedcommands/Unfollow.class.php';

class CategoryProcessor {

    public $userID;
    public $categoryID;

    public function follow() {
        $log = KLogger::instance('/home/ubuntu/log/', KLogger::DEBUG);
        $db = DB::getConnection();
        $db = DB::getConnection();
        $category = Category::findById($db, $this->categoryID);
        if ($category) {
            $redis = new Predis\Client();
            $log->logInfo("category.follow > " . $category->getName() . " for user " . $this->userID);
            $redis->zunionstore("user:" . $this->userID . ":timeline", 2, "category:" . $this->categoryID . ":timeline", "user:" . $this->userID . ":timeline","AGGREGATE","max");
        }
    }

    public function unfollow() {
        $log = KLogger::instance('/home/ubuntu/log/', KLogger::DEBUG);

        $db = DB::getConnection();
        $category = Category::findById($db, $this->categoryID);
        if ($category) {
            $log->logInfo("category.unfollow > " . $category->getName() . " for user " . $this->userID);

            $categories = Category::findBySql($db, "select * from category where id in (select categoryID from usercategorylink where userID=" . $this->userID . ")");
            $categoryArray = array();
            foreach ($categories as $tmpCategory) {
                if ($category->getName() != $tmpCategory->getName()) {
                    $categoryArray[] = $tmpCategory->getName();
                }
            }
            $log->logInfo("category.unfollow > my categories:" . json_encode($categoryArray));

            $redis = new Predis\Client();
            $redis->getProfile()->defineCommand('unfollow', 'Unfollow');
            $redis->unfollow('user:' . $this->userID . ':timeline', $category->getName(), json_encode($categoryArray));
        } else {
            $log->logInfo("category.unfollow > " . $category->getName() . " not found");
        }
    }

}

?>
