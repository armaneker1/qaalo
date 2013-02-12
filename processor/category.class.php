<?php

require_once __ROOT__ . 'vendors/DB.php';
require_once __ROOT__ . 'models/User.class.php';
require_once __ROOT__ . 'models/Category.class.php';

class CategoryProcessor {

    public $userID;
    public $categoryID;

    public function follow() {
        $db = DB::getConnection();
        $redis = new Predis\Client('tcp://127.0.0.1:6379');
    }
    
    public function unfollow() {
        
    }

    

}

?>
