<?php
require_once __ROOT__ . 'vendors/DB.php';

/**
 * Description of task
 *
 * @author mehmet
 */
class TaskController extends BaseController {
    
    public function __construct($action, $urlValues) {
        parent::__construct("main", $action, $urlValues, true,false);
    }
    
    public function execute() {
        //Calculate trending categories
        $yesterdayTrends = "trendingCategories:" .date("Ymd", strtotime('-1 days'));
        $todayTrends = "trendingCategories:" .date("Ymd");
        $redis = new Predis\Client("tcp://qaalo.com:6379");
        $redis->zunionstore("trendingCategories:current", array($yesterdayTrends, $todayTrends));
        
    }
}

?>
