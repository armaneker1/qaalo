<?php
require_once __ROOT__ .'models/Topic.class.php';
require_once __ROOT__ . 'vendors/DB.php';

/**
 * Description of Vote
 *
 * @author mehmet
 */
class TopicController extends BaseController {
    
    public $query;
    
    public function __construct($action, $urlValues) {
        parent::__construct("main", $action, $urlValues,true);
    }
    
    public function search() {
        $db = DB::getConnection();
        $topics = Topic::findBySql($db, "select * from topic where title like '%". $this->query ."%'");
        $res = array();
        foreach($topics as $topic) {
            $res[] = array("value"=> $topic->getTitle(), "data"=>$topic->getUrl());
        }
        
        $obj = array("query"=> $this->query, "suggestions"=> $res);
        
        echo json_encode($obj);
    }
    
}

?>
