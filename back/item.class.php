<?php

require_once __ROOT__ . 'models/Item.class.php';
require_once __ROOT__ . 'models/Vote.class.php';
require_once __ROOT__ . 'vendors/DB.php';

/**
 * Description of Vote
 *
 * @author mehmet
 */
class ItemController extends BaseController {

    public $id;
    public $dir;

    public function __construct($action, $urlValues) {
        parent::__construct("main", $action, $urlValues, true,true);
    }

    public function vote() {
        $db = DB::getConnection();

        //Check for an existing vote
        $votes = Vote::findByExample($db, Vote::create()->setItemID($this->id)->setUserID($this->_userID));
        $item = Item::findById($db, $this->id);

        if (count($votes) > 0) {
            $vote = $votes[0];
            if ($vote->getRate() == $this->dir) { //Delete vote
                $vote->deleteFromDatabase($db);

                if ($this->dir == 1) {
                    $item->setVoteUp($item->getVoteUp() - 1);
                } else {
                    $item->setVoteDown($item->getVoteDown() - 1);
                }
                $item->updateToDatabase($db);
            } else { //Update vote
                $vote->setRate($this->dir);
                $vote->updateToDatabase($db);

                if ($this->dir == -1) {
                    $item->setVoteUp($item->getVoteUp() - 1);
                    $item->setVoteDown($item->getVoteDown() + 1);
                } else {
                    $item->setVoteUp($item->getVoteUp() + 1);
                    $item->setVoteDown($item->getVoteDown() - 1);
                }
                $item->updateToDatabase($db);
            }
        } else { //Create new vote
            $vote = new Vote();
            $vote->setUserID($this->_userID);
            $vote->setItemID($this->id);
            $vote->setRate($this->dir);
            $vote->setCreatedOn(time());
            $vote->insertIntoDatabase($db);

            if ($this->dir == 1) {
                $item->setVoteUp($item->getVoteUp() + 1);
            } else {
                $item->setVoteDown($item->getVoteDown() + 1);
            }
            $item->updateToDatabase($db);
        }

        echo "{}";
    }

}

?>
