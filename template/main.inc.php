<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="utf-8" />
<?php $this->dumpMetaTags(); ?>
        <title><?php echo $this->_title ?></title>
        <link href="<?php echo __WEBROOT__ ?>inc/qaloo.css" rel='stylesheet' type="text/css" media="screen">
        <link href="<?php echo __WEBROOT__ ?>inc/barometer.css" rel='stylesheet' type="text/css" media="screen">
        <script type="text/javascript" src="<?php echo __WEBROOT__ ?>inc/jquery-1.8.3.js" ></script>
        <script type="text/javascript" src="<?php echo __WEBROOT__ ?>inc/jquery.autocomplete.min.js" ></script>
        <script type="text/javascript" src="<?php echo __WEBROOT__ ?>inc/jquery.ambiance.js" ></script>
        <script type="text/javascript" src="<?php echo __WEBROOT__ ?>inc/jquery.maxlength.min.js" ></script>
        <script type="text/javascript" src="<?php echo __WEBROOT__ ?>inc/jquery.qtip-1.0.0-rc3.min.js" ></script>
        <script type="text/javascript" src="<?php echo __WEBROOT__ ?>inc/qaloo.js" ></script>
    </head>
    <body>

        <div class="bar">
            <div class="menu clearfix">
                <a class="logo" href="/"></a>
                <div id="search">
                    <form method="post" action="<?php echo $this->getControllerAction("topic", "search"); ?>">
                        <input class="default" spellcheck="false" autocomplete="off" autofocus="on" type="text" placeholder="Search a list..." id="searchBox" name="searchKeyword">
                    </form>
                </div>

                <?php if ($this->isLoggedIn()) { ?>
                    <div class="create"><a href="/base.create">or Create a List ➜</a>                </div>
                <?php } ?>

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
            <?php
            $_SESSION["messages"] = null;
        }
        ?>

        <script src='http://getbarometer.s3.amazonaws.com/assets/barometer/javascripts/barometer.js' type='text/javascript'></script>
        <script type="text/javascript" charset="utf-8">
            BAROMETER.load('RTCN9DZSyYXF51RO69QsN');
        </script>

        <script type="text/javascript">

            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-38235310-1']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();

        </script>

    </body>
</html>