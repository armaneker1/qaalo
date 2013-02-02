<?php
require_once __ROOT__ .'models/User.class.php';
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
    
    public function __construct($action, $urlValues) {
        parent::__construct("main", $action, $urlValues,true,true);
    }
    
    public function notify() {
        $db = DB::getConnection();
        $user = User::findById($db, $id);
        echo json_encode($obj);
    }
    
}

?>
