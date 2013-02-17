<?php

require_once __ROOT__ . 'models/User.class.php';
require_once __ROOT__ . 'vendors/DB.php';

/**
 * Description of Vote
 *
 * @author mehmet
 */
class UserController extends BaseController {

    public $query;
    public $weeklyMail;
    public $updateMail;
    public $userID;

    public function __construct($action, $urlValues) {
        parent::__construct("main", $action, $urlValues, true, false);
    }

    public function notify() {
        if ($this->isLoggedIn())
            return;
        $db = DB::getConnection();
        $user = User::findById($db, $this->getUserID());
        if ($user) {
            list($weeklyMail, $updateMail) = explode(",", $user->getMailSettings() == "" ? "," : $user->getMailSettings());

            if (isset($this->weeklyMail)) {
                $weeklyMail = $this->weeklyMail == "1" ? "1" : "";
            } else if (isset($this->updateMail)) {
                $updateMail = $this->updateMail == "1" ? "1" : "";
            }

            $user->setMailSettings($weeklyMail . "," . $updateMail);
            $user->updateToDatabase($db);
        }
    }

    public function card() {
        $userID = $this->userID;
        $db = DB::getConnection();
        $user = User::findById($db, $userID);

        if ($user) {
            $res["name"] = $user->getFullname();
            $res["bio"] = $user->getBio() == null ? "" : $user->getBio();
            $res["url"] = $user->getUrl() == null ? "" : $user->getUrl();
            $res["pic"] = $user->getPhoto() == null ? "" : $user->getPhoto();
            
            if ($res["url"]!="" && substr($res["url"],0,7) != "http://" ) {
                $res["url"] = "http://" . $res["url"];
            }

            $redis = new Predis\Client();
            $categories = $redis->zrevrange("user:" . $userID . ":talkingAbout", "0", "9");
            if (count($categories) > 0) {
                $categoryList;
                foreach ($categories as $category) {
                    $cat = json_decode($category);
                    $categoryList[$cat[0]] = $cat[1];
                }
                $res["categories"] = $categoryList;
            }

            $lists = $redis->zrevrange("user:" . $userID . ":latestLists", "0", "2");
            if (count($lists) > 0) {
                $topicList;
                foreach ($lists as $list) {
                    $lst = json_decode($list);
                    $topicList[$lst[0]] = $lst[1];
                }
                $res["list"] = $topicList;
            }

            echo json_encode($res);
        } else {
            echo '{"type":"error"}';
        }
    }

}

?>
