<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="utf-8" />
        <title><?php echo $this->_title ?></title>
        <link href="<?php echo __WEBROOT__ ?>inc/qaloo.css" rel='stylesheet' type="text/css" media="screen">
        <link href="<?php echo __WEBROOT__ ?>inc/barometer.css" rel='stylesheet' type="text/css" media="screen">
        <script type="text/javascript" src="<?php echo __WEBROOT__ ?>inc/jquery-1.8.3.js" ></script>
        <script type="text/javascript" src="<?php echo __WEBROOT__ ?>inc/jquery.autocomplete.min.js" ></script>
        <script type="text/javascript" src="<?php echo __WEBROOT__ ?>inc/jquery.ambiance.js" ></script>
        <script type="text/javascript" src="<?php echo __WEBROOT__ ?>inc/qaloo.js" ></script>
    </head>
    <body>

        <div class="bar">
            <div class="menu clearfix">
                <a class="logo" href="/"></a>
                <div id="search">
                    <form method="post" action="<?php echo $this->getControllerAction("topic", "search"); ?>">
                        <input class="default" spellcheck="false" autocomplete="off" autofocus="on" type="text" placeholder="Search anything..." id="searchBox" name="searchKeyword">
                    </form>
                </div>
                <div class="profile">
                    <?php if ($this->isLoggedIn()) { ?>
                        <a class="profileLink" >Hello, <?= $_SESSION["firstname"] ?> ▾</a>
                        <div id="profileMenu" class="popup profileMenu">
                            <ul class="menu">
                                <li><a href="/base.settings">Settings</a></li>
                                <li><a href="/base.logout">Logout</a></li>
                            </ul>
                        </div>
                    <?php } else { ?> 
                        <div class="anonymous">
                            <a href='/base.login'>login</a> | <a href='/base.register'>register</a>
                        </div>
                    <?php } ?> 
                </div>
            </div>

        </div>
        <div class="main" id="main">
            <?php $this->dumpErrors(); ?>
            <?php require "views/" . $this->urlValues["controller"] . ".php"; ?>
        </div>

        <?php if (isset($_SESSION["messages"])) { ?>
            <script type="text/javascript" charset="utf-8">
                $(document).ready(function() {
    <?php foreach ($_SESSION["messages"] as $message) { ?>
                $.ambiance({message: "<?= $message ?>", type: "success"}); 
    <?php } ?>
        });
            </script>
            <?php $_SESSION["messages"] = null;
        } ?>

        <script src='http://getbarometer.s3.amazonaws.com/assets/barometer/javascripts/barometer.js' type='text/javascript'></script>
        <script type="text/javascript" charset="utf-8">
            BAROMETER.load('RTCN9DZSyYXF51RO69QsN');
        </script>

    </body>
</html>