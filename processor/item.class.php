<?php

require_once __ROOT__ . 'vendors/DB.php';
require_once __ROOT__ . 'models/Topic.class.php';
require_once __ROOT__ . 'models/Item.class.php';
require_once __ROOT__ . 'models/User.class.php';
require_once __ROOT__ . 'models/Writer.class.php';

class ItemProcessor {

    public $itemID;

    public function add() {
        $db = DB::getConnection();
        $redis = new Predis\Client('tcp://127.0.0.1:6379');
        $item = Item::findById($db, $this->itemID);
        $topic = Topic::findById($db, $item->getTopicID());
        $user = User::findById($db, $item->getUserID());

        $obj = array(
            "type" => "item.add",
            "title" => $topic->getTitle(),
            "url" => $topic->getUrl(),
            "item" => $item->getText(),
            "username" => $user->getFullname(),
            "userID" => $user->getId(),
        );

        $writers = $this->getWriters($item->getTopicID());
        foreach ($writers as $writer) {
            if ($writer->getUserID() != $user->getId()) {
                $redis->zadd("user:" . $writer->getUserID() . ":timeline", $item->getCreatedOn(), json_encode($obj));
            }
        }
    }

    public function vote() {
        $item = Item::findById($db, $this->itemID);
        $topic = Topic::findById($db, $item->getTopicID());
        $user = User::findById($db, $item->getUserID());
    }

    private function getWriters($topicID) {
        return Writer::findByExample(DB::getConnection(), Writer::create()->setTopicID($topicID));
    }

}

?>
