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

    public static function createList($userID, $topicID) {
        self::send(array(
            "type"=>"createList",
            "userID"=>$userID,
            "topicID"=>$topicID,
        ));
    }

    public static function followCategory($userID, $categoryID) {
        self::send(array(
            "type"=>"followCategory",
            "userID"=>$userID,
            "categoryID"=>$categoryID,
        ));
    }

    private static function send($obj) {
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
