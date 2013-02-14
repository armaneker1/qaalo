<?php

require_once __ROOT__ . 'vendors/Stomp/Stomp.php';

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Queue
 *
 * @author mehmet
 */
class Queue {

    public static function createList($topicID) {
        self::send("topic", "create", array(
            "topicID" => $topicID,
        ));
    }

    public static function followCategory($userID, $categoryID) {
        self::send("category", "follow", array(
            "userID" => $userID,
            "categoryID" => $categoryID,
        ));
    }
    public static function unfollowCategory($userID, $categoryID) {
        self::send("category", "unfollow", array(
            "userID" => $userID,
            "categoryID" => $categoryID,
        ));
    }
    
    public static function addItem($itemID) {
        self::send("item", "add", array(
            "itemID" => $itemID,
        ));
    }
    
    public static function inviteToTopic($userID,$topicID,$emails) {
        self::send("email", "inviteToTopic", array(
            "userID" => $userID,
            "topicID" => $topicID,
            "emails" => $emails,
        ));
    }
    
    
    //--------------------------------------------------------------------------

    private static function send($method, $action, $obj) {
        $obj["method"] = $method;
        $obj["action"] = $action;
        $conn = self::getConnection();
        self::getConnection()->send("qaalo", json_encode($obj), array('persistent' => 'true'));
        $conn->disconnect();
    }

    private static function getConnection() {
        try {
            $conn = new Stomp("tcp://127.0.0.1:61613");
            $conn->connect();
            return $conn;
        } catch (StompException $e) {
            echo "Connection Error: " . $e->getDetails();
        }
        return null;
    }

    

}

?>
