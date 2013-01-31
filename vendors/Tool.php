<?php

require_once __ROOT__ . 'models/User.class.php';
require_once __ROOT__ . 'vendors/DB.php';
require_once __ROOT__ . 'vendors/SimpleEmailService.php';

class Tool {

    public static function rememberMe($email, $password) {
        setcookie("auth", 'usr=' . $email . '&hash=' . md5($password), time() + 3600 * 24 * 365, "/");
    }

    public static function forgetMe() {
        setcookie("auth", '', time() - 1000, "/");
    }

    public static function randomString($length) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

        $size = strlen($chars);
        for ($i = 0; $i < $length; $i++) {
            $str .= $chars[rand(0, $size - 1)];
        }

        return $str;
    }

    public static function sendEmail($fileName, $params, $to, $subject) {
        $file = __ROOT__ . "inc/emailTemplates/". $fileName.".html";
        if (file_exists($file)) {
            $template = file_get_contents($file);
            if (!empty($params) && sizeof($params) > 0) {
                foreach ($params as $par) {
                    if (!empty($par) && sizeof($par) == 2 && !empty($par[0])) {
                        $template = str_replace("\${" . $par[0] . "}", $par[1], $template);
                    }
                }
            }
            $tos = array();
            if (!empty($to)) {
                $array = explode(";", $to);
                if (!empty($array) && sizeof($array) > 0) {
                    foreach ($array as $mail) {
                        array_push($tos, $mail);
                    }
                }
            }

            if (!empty($tos) && sizeof($tos) > 0) {
                $ses = new SimpleEmailService("AKIAJTSBTE2CABSZTGFQ", "Au4bcWD9zl3brAYSbE9UqLnaf2SsALorQcqIt45h");
                $ses->enableVerifyPeer(false);
                $m = new SimpleEmailServiceMessage();
                $m->setSubjectCharset("UTF-8");
                $m->setMessageCharset("UTF-8");
                foreach ($tos as $mail) {
                    $m->addTo($mail);
                }
                $m->setFrom("Qaalo <from@qaalo.com>");
                $m->setSubject($subject);
                $m->setMessageFromString(null, $template);
                return $ses->sendEmail($m);
            } else {
                throw new Exception("Email address not found");
            }
        } else {
            throw new Exception("File not found");
        }
        return false;
    }

    public static function getURL($title) {
        $title = mb_strtolower($title, 'UTF-8');
        $title = str_replace("ı", "i", $title);
        $title = str_replace("ğ", "g", $title);
        $title = str_replace("ü", "u", $title);
        $title = str_replace("ş", "s", $title);
        $title = str_replace("ç", "c", $title);
        $title = str_replace("ö", "o", $title);
        $title = preg_replace("/[^\p{L}+ 0123456789]/u", "", $title);
        $title = str_replace(" ", "-", $title);
        return $title;
    }

    public static function autoLogin() {
        if (isset($_COOKIE["auth"])) {
            $cookie = $_COOKIE["auth"];
            $arr = explode('&', $cookie);
            $email = substr($arr[0], 4);
            $hash = substr($arr[1], 5);


            $users = User::findByExample(DB::getConnection(), User::create()->setEmail($email));

            if (count($users) > 0) {
                $user = $users[0];
                if ($hash == md5($user->getPassword())) {
                    $_SESSION["firstname"] = $user->getFirstname();
                    $_SESSION["userID"] = $user->getId();
                    return true;
                } else {
                    Tool::forgetMe();
                }
            }
        }
        return false;
    }

}

?>
