<?php

require_once __ROOT__ . 'models/User.class.php';
require_once __ROOT__ . 'models/Topic.class.php';
require_once __ROOT__ . 'vendors/DB.php';
require_once __ROOT__ . 'vendors/SimpleEmailService.php';
define("SECOND", 1);
define("MINUTE", 60 * SECOND);
define("HOUR", 60 * MINUTE);
define("DAY", 24 * HOUR);
define("MONTH", 30 * DAY);

class Tool {

    private static $allowedExts = array("jpg", "jpeg", "gif", "png");
    private static $urlRegex = '/(([a-z0-9A-Z:\/\/]{0,20}[-a-zA-Z0-9:_\\\+.]{1,256}\.[a-z]{2,4})[a-zA-Z\(\)0-9@:%_+.~#?\\\&\/=-]{0,255})/i';
    private static $twitterRegex = '/(?<![a-zA-Z0-9_"\'<>])@([a-z0-9_]{1,20})\b/i';
    private static $twitterHashtag = '/(?<![^\s#])#([^\s#]+)(?=(\s|$))/i';

    public static function inviteIsValid($inviteCode) {
        if (trim($inviteCode) == "")
            return false;
        $tickets = Topic::findByExample(DB::getConnection(), Topic::create()->setInviteCode($inviteCode));
        if (count($tickets) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function rememberMe($email, $password) {
        setcookie("auth", 'usr=' . $email . '&hash=' . md5($password), time() + 3600 * 24 * 365, "/");
    }

    public static function forgetMe() {
        setcookie("auth", '', time() - 1000, "/");
    }

    public static function getLink($url) {
        if ($url != "") {
            return "<a href='" . (substr(strtolower($url), 0, 7) != "http://" ? "http://" : "" ) . $url . "' target='_blank'>" . $url . "</a>";
        }
    }

    public static function randomString($length) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

        $size = strlen($chars);
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= $chars[rand(0, $size - 1)];
        }

        return $str;
    }

    public static function trimDomainInItem($item) {
        $item =preg_replace(self::$urlRegex, "$2",$item);
        $item = preg_replace('/http(s)?:\/\/|www.|ftp:\/\//i', "", $item);
        return $item;
    }
    
    public static function renderItem($item) {
        $position = 0;
        $res = "";
        $link = "";
        
        $item = preg_replace(self::$twitterRegex, "http://www.twitter.com/$1", $item);
        $item = preg_replace(self::$twitterHashtag, "http://twitter.com/#$1", $item);
        
        while (preg_match(self::$urlRegex, $item, $match, PREG_OFFSET_CAPTURE, $position)) {
            list($url, $urlPosition) = $match[0];
            $res .= htmlspecialchars(substr($item, $position, $urlPosition - $position));

            $link = $url;
            if (strtolower(substr($link, 0, 7)) != "http://" && strtolower(substr($link, 0, 8)) != "https://") {
                $link = "http://" . $link;
            }

            $hostComponent = parse_url($link);
            $host = $hostComponent["host"];
            if (strtolower(substr($host, 0, 4)) == "www.") {
                $host = substr($host, 4);
            }

            if (strtolower($host) == "twitter.com") {
                $hostIndex = strpos($link, "twitter.com");
                $slashIndex = strpos($link, "/", $hostIndex);
                if ($slashIndex>0 && $slashIndex+1 < strlen($link)) {
                    $newHost = substr($link,$slashIndex+1);
                    
                    if (substr($newHost, 0,1)=="#") {
                        $host = $newHost;
                    } else if (preg_match('/^[a-zA-Z0-9_]{1,255}$/', $newHost)) {
                        $host = "@" . $newHost;
                    }
                }
            } else if (strlen($host)>20) {
                $host = "..." . substr($host, strlen($host)-20 );
            }
            
            $img = 'http://www.google.com/s2/u/0/favicons?domain=' . $hostComponent["host"];
            if (substr($host,0,1)=="@") {
                $img ='https://api.twitter.com/1/users/profile_image?screen_name='. substr($host,1) .'&size=mini';
            }
            $res .= '<a class="externalLink" target="_blank" href="' . $link . '"><img src="'.$img .'"> ' . $host . '</a>';
            $position = $urlPosition + strlen($url);
        }
        
        
        $res .= htmlspecialchars(substr($item, $position));
        return $res;
    }

    public static function sendEmail($fileName, $params, $to, $subject, $from = 'Qaalo') {
        $file = __ROOT__ . "inc/emailTemplates/" . $fileName . ".html";
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
                $m->setFrom($from . " <from@qaalo.com>");
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

    public static function isValidImage($type, $name) {
        $extension = strtolower(end(explode(".", $name)));
        if ((($type == "image/gif") || ($type == "image/jpeg") || ($type == "image/png") || ($type == "image/pjpeg")) && in_array($extension, Tool::$allowedExts)) {
            return true;
        } else {
            return false;
        }
    }

    public static function getCategories($categories) {
        $str = "";
        $a = count($categories);
        foreach ($categories as $category) {
            $str .= "<a href='/c/" . self::getURL($category) . "'>" . $category . "</a>";
            $a--;
            if ($a > 1) {
                $str .= ", ";
            } else if ($a > 0) {
                $str .=" and ";
            }
        }
        return $str;
    }

    public static function getFriendlyDate($date) {
        $delta = time() - $date;

        if ($delta < 1 * MINUTE) {
            return $delta == 1 ? "just now" : $delta . " seconds ago";
        }
        if ($delta < 10 * MINUTE) {
            return "a few minutes ago";
        }
        if ($delta < 45 * MINUTE) {
            return floor($delta / MINUTE) . " minutes ago";
        }
        if ($delta < 90 * MINUTE) {
            return "an hour ago";
        }
        if ($delta < 24 * HOUR) {
            return floor($delta / HOUR) . " hours ago";
        }
        if ($delta < 48 * HOUR) {
            return "yesterday";
        }
        if ($delta < 10 * DAY) {
            return " last week";
        }
        if ($delta < 30 * DAY) {
            return floor($delta / DAY) . " days ago";
        }
        if ($delta < 12 * MONTH) {
            $months = floor($delta / DAY / 30);
            return $months <= 1 ? "one month ago" : $months . " months ago";
        } else {
            $years = floor($delta / DAY / 365);
            return $years <= 1 ? "one year ago" : $years . " years ago";
        }
    }

}

?>
