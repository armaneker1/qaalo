<?php

require_once __ROOT__ . 'models/User.class.php';
require_once __ROOT__ . 'models/Topic.class.php';
require_once __ROOT__ . 'models/Category.class.php';
require_once __ROOT__ . 'models/UserCategoryLink.class.php';
require_once __ROOT__ . 'vendors/Tool.php';
require_once __ROOT__ . 'vendors/DB.php';

class SettingsController extends BaseController {

    public $user;
    public $weeklyMail;
    public $listUpdateMail;
    public $fullname;
    public $url;
    public $email;
    public $bio;
    public $password;
    public $passwordConfirm;
    public $categories;

    public function __construct($action, $urlValues) {
        parent::__construct("main", $action, $urlValues, false, true);

        $this->user = User::findById(DB::getConnection(), $this->_userID);
    }

    protected function index() {
        $db = DB::getConnection();
        $this->categories = Category::findBySql($db, "select * from category where id in (select categoryID from usercategorylink where userID=" . $this->getUserID() . ")");

        usort($this->categories, function($a, $b) {

                    return $a->getName() < $b->getName() ? -1 : 1;
                });
    }

    protected function profile() {
        
    }

    protected function mail() {
        
    }

    protected function password() {
        
    }

    protected function updatePassword() {
        if ($this->password != $this->passwordConfirm) {
            $this->addError("Passwords doesn't match");
        } else if (!preg_match('/^[a-z0-9]{6,18}$/ ', $this->password)) {
            $this->addError("Password is not valid");
        }

        if (!$this->hasError()) {
            $db = DB::getConnection();
            $this->user->setPassword($this->password);
            $this->user->updateToDatabase($db);
            $this->addInfo("your password updated");
            $this->redirect("base.settings");
        }
    }

    protected function addCategory() {
        $db = DB::getConnection();
        $added = false;
        $categories = explode(",", $this->categories);
        foreach ($categories as $category) {
            $categoryID = 0;
            if (is_numeric($category)) {
                $categoryID = $category;
                if ( count( UserCategoryLink::findByExample($db, UserCategoryLink::create()->setCategoryId($categoryID)->setUserId($this->getUserID())) )>0 ) {
                    continue;
                }
            } else {
                $newCategory = new Category();
                $newCategory->setLinkCount(1);
                $newCategory->setName($category);
                $newCategory->setUserID($this->getUserID());
                $newCategory->setUrl(Tool::getURL($category));
                $newCategory->insertIntoDatabase($db);
                $categoryID = $newCategory->getId();
            }
            
            $added = true;

            $link = new UserCategoryLink();
            $link->setCategoryId($categoryID);
            $link->setUserId($this->getUserID());
            $link->insertIntoDatabase($db);
        }
        if ($added) {
            $this->addInfo("you are following new categories now");
        }
        $this->redirect("base.settings");
    }

    protected function update() {


        $db = DB::getConnection();
        if (!preg_match('/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/', $this->email)) {
            $this->addError("Email is not valid");
        } else {

            $users = User::findByExample($db, User::create()->setEmail(strtolower(trim($this->email))));
            if (count($users) > 0) {
                $user = $users[0];
                if ($user->getId() != $this->_userID) {
                    $this->addError("Email is in use by another user. Do you have another account?");
                }
            }
        }
        if (strlen($this->fullname) < 3) {
            $this->addError("Your name is not valid");
        }



        if (!$this->hasError()) {


            $validationCode = Tool::randomString(16);

            $this->user = User::findById(DB::getConnection(), $this->_userID);
            $this->user->setBio(trim($this->bio));
            $this->user->setUrl(trim($this->url));
            $this->user->setFullname(trim($this->fullname));
            $this->user->setValidationCode($validationCode);
            $this->user->setEmail(strtolower(trim($this->email)));
            $this->user->updateToDatabase($db);



            if ($this->user->getEmail() != $this->email) {
                $params = array(array('name', $this->user->getFirstname()), array('email_address', $this->user->getEmail(), array('validationCode', $validationCode)));
                Tool::sendEmail("mailChanged", $params, $this->user->getEmail(), "You have changed your email");
            }

            $this->addInfo("your profile updated");

            $this->redirect("base.settings");
        }
    }

}

?>
