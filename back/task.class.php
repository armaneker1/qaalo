<?php

require_once __ROOT__ . 'vendors/DB.php';

/**
 * Description of task
 *
 * @author mehmet
 */
class TaskController extends BaseController {

    public function __construct($action, $urlValues) {
        parent::__construct("main", $action, $urlValues, true, false);
    }

    public function execute() {
        //Calculate trending categories
        $yesterdayTrends = "trendingCategories:" . date("Ymd", strtotime('-1 days'));
        $todayTrends = "trendingCategories:" . date("Ymd");
        $redis = new Predis\Client();
        $redis->zunionstore("trendingCategories:current", array($yesterdayTrends, $todayTrends));

        $redis->zunionstore(
                "main:timeline", 6,"category:69:timeline", "category:26:timeline", "category:28:timeline", "category:44:timeline", "category:45:timeline", "category:46:timeline", "AGGREGATE", "max"
        );
    }

}

?>
