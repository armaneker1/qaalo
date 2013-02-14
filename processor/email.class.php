<?php

require_once __ROOT__ . 'vendors/DB.php';
require_once __ROOT__ . 'models/User.class.php';
require_once __ROOT__ . 'models/Topic.class.php';
require_once __ROOT__ . 'models/Item.class.php';
require_once __ROOT__ . 'vendors/Tool.php';

class EmailProcessor {

    public $emails;
    public $topicID;
    public $userID;

    public function inviteToTopic() {
        $db = DB::getConnection();
        $topic = Topic::findById($db, $this->topicID);
        $user = User::findById($db, $this->userID);
        if ($topic && $user) {

            $items = Item::findByExample($db, Item::create()->setTopicID($this->topicID));
            usort($items, function($a, $b) {
                        $voteA = $a->getVoteUp() - $a->getVoteDown();
                        $voteB = $b->getVoteUp() - $b->getVoteDown();
                        if ($voteA == $voteB) {
                            return $a->getID() > $b->getID();
                        } else {
                            return $voteA > $voteB ? -1 : 1;
                        }
                    });
            $item1 = count($items) >= 1 ? $items[0]->getText() : "...";
            $item2 = count($items) >= 2 ? $items[1]->getText() : "...";


            $emails = explode(",", $this->emails);
            foreach ($emails as $email) {
                $params = array(
                    array('sender', $user->getFullname()),
                    array('listName', $topic->getTitle()),
                    array('item1', $item1),
                    array('item2', $item2),
                    array('link',"http://qaalo.com/l/". $topic->getUrl() ."/invitecode/". $topic->getInviteCode()),
                    array('email_address', $email)
                );

                Tool::sendEmail("inviteToTopic", $params, $email, $topic->getTitle() , $user->getFullname() . " via Qaalo");
            }
        }
    }

}

?>
