<?php

require_once __ROOT__ . 'vendors/DB.php';
require_once __ROOT__ . 'models/Topic.class.php';
require_once __ROOT__ . 'models/Item.class.php';
require_once __ROOT__ . 'models/Category.class.php';
require_once __ROOT__ . 'models/TopicCategoryLink.class.php';
require_once __ROOT__ . 'models/UserCategoryLink.class.php';
require_once __ROOT__ . 'vendors/KLogger.php';

class TopicProcessor {

    public $topicID;

    public function create() {
        $log = KLogger::instance('/home/ubuntu/log/', KLogger::DEBUG);

        $log->logInfo("topic.create > creating");

        $db = DB::getConnection();
        $redis = new Predis\Client('tcp://127.0.0.1:6379');
        $topic = Topic::findById($db, $this->topicID);
        $categoryLinks = TopicCategoryLink::findByExample($db, TopicCategoryLink::create()->setTopicId($this->topicID));





        $categories = Category::findBySql($db, "select * from category where id in (select categoryID from topiccategorylink where topicID=" . $this->topicID . ")");
        $categoryList = array();
        foreach ($categories as $category) {
            $categoryList[] = $category->getName();
        }

        $obj = json_encode(array(
            "type" => "topic.create",
            "title" => $topic->getTitle(),
            "url" => $topic->getUrl(),
            "categories" => $categoryList,
                )
        );

        //Notify users
        $log->logInfo("topic.create > ready to notify");
        $notifiedUsers = array();
        foreach ($categoryLinks as $link) {
            $userLinks = UserCategoryLink::findByExample($db, UserCategoryLink::create()->setCategoryId($link->getCategoryId()));
            foreach ($userLinks as $userLink) {
                if (!in_array($userLink->getUserId(), $notifiedUsers)) {
                    $log->logInfo("topic.create > notifying " . $userLink->getUserId());
                    //Notify user
                    $list = "user:" . $userLink->getUserId() . ":timeline";
                    $redis->zadd($list, $topic->getCreatedOn(), $obj);
                    $notifiedUsers[] = $userLink->getUserId();
                }
            }
        }

        $obj = json_encode(array(
            "title" => $topic->getTitle(),
            "url" => $topic->getUrl(),
            "categories" => $categoryList,
                )
        );

        foreach ($categories as $category) {
            //Increment by 5 for trending topics
            $redis->zincrby("trendingCategories:" . date("Ymd"), 5, $category->getId());

            //Add topic to the related topic's timeline
            $redis->zadd("category:" . $category->getId() . ":timeline", $topic->getCreatedOn(), $obj);
        }



        unset($notifiedUsers);
    }

    public function rate() {
        
    }

    public function add() {
        
    }

}

?>
