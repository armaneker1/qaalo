<?php

define("__ROOT__", $_SERVER['DOCUMENT_ROOT'] . "/");
define("__WEBROOT__", "/");

require_once __ROOT__ . 'vendors/DB.php';
require_once __ROOT__ . 'vendors/Tool.php';
require_once __ROOT__ . 'models/User.class.php';
require_once __ROOT__ . 'models/Topic.class.php';

class QaaloTester extends WebTestCase {
    
    function testRegisterMailError() {
        $this->get('http://qaalo.com/base.register');
        $this->setField('fullname', 'Tester Tester');
        $this->setField('email', 'mecevit@gmail.com');
        $this->setField('password', 'hotmailer');
        $this->setField('passwordConfirm', 'hotmailer');
        $this->assertSubmit('Create account');
        $this->click('Create account');
        $this->assertTitle("Register");
    }

    function testRegister() {
        $this->get('http://qaalo.com/base.register');
        $this->setFieldByName('fullname', 'Tester mcTester');
        $this->setFieldByName('password', '1345678');
        $this->setFieldByName('passwordConfirm', '1345678');
        $this->setFieldByName('email', 'mehmet@gram.gs');
        $this->assertSubmit('Create account');
        $this->click('Create account');
        $this->assertTitle("Qaalo - Everything listed.", "User registration failed!");
    }
    
    function testLoginFail() {
        $this->get('http://qaalo.com/base.login');
        $this->setField('email', 'mehmet@gram.gs');
        $this->setField('password', 'birikiuc');
        $this->assertSubmit('Login');
        $this->click('Login');
        $this->assertTitle("Login");
    }
    
    function testLogin() {
        $this->get('http://qaalo.com/base.login');
        $this->setField('email', 'mehmet@gram.gs');
        $this->setField('password', '1345678');
        $this->assertSubmit('Login');
        $this->click('Login');
        $this->assertTitle("Qaalo - Everything listed.");
    }
    
    function testDeleteUser() {
        $db = DB::getConnection();
        $users = User::findByExample($db, User::create()->setEmail('mehmet@gram.gs'));
        $this->assertEqual(count($users), 1, "User not exists in DB!");
        if (count($users) > 0) {
            $user = $users[0];
            $user->deleteFromDatabase($db);
        }
    }

}

?>
