<?php
require_once __ROOT__ .'models/Category.class.php';
require_once __ROOT__ . 'vendors/DB.php';

/**
 * Description of Vote
 *
 * @author mehmet
 */
class CategoryController extends BaseController {
    
    public $query;
    
    public function __construct($action, $urlValues) {
        parent::__construct("main", $action, $urlValues,true);
    }
    
    public function search() {
        $db = DB::getConnection();
        $items = Category::findBySql($db, "select * from category where name like '%". $this->query ."%'");
        $res = array();
        foreach($items as $item) {
            $res[] = array("name"=> $item->getName(), "id"=>$item->getId());
        }
        
        echo json_encode($res);
    }
    
}

?>
