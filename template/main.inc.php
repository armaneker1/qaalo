<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="utf-8" />
        <?php $this->dumpMetaTags(); ?>
        <title><?php echo $this->_title ?></title>
        <?php if (isset($this->metaDescription)) { ?>
        <meta name="description" content="<?= $this->metaDescription?>">
        <?php } ?>
        <link href="<?php echo __WEBROOT__ ?>inc/qaloo.css?d=021920131115" rel='stylesheet' type="text/css" media="screen">
        <link href="<?php echo __WEBROOT__ ?>inc/tooltipster.css" rel='stylesheet' type="text/css" media="screen">
        <script type="text/javascript" src="<?php echo __WEBROOT__ ?>inc/jquery-1.8.3.js" ></script>
        <script type="text/javascript" src="<?php echo __WEBROOT__ ?>inc/jquery.autocomplete.min.js" ></script>
        <script type="text/javascript" src="<?php echo __WEBROOT__ ?>inc/jquery.ambiance.js" ></script>
        <script type="text/javascript" src="<?php echo __WEBROOT__ ?>inc/jquery.lightbox_me.js" ></script>
        <script type="text/javascript" src="<?php echo __WEBROOT__ ?>inc/jquery.maxlength.min.js?d=021520132254" ></script>
        <script type="text/javascript" src="<?php echo __WEBROOT__ ?>inc/jquery.autosize-min.js" ></script>
        <script type="text/javascript" src="<?php echo __WEBROOT__ ?>inc/jquery.tokeninput.js" ></script>
        <script type="text/javascript" src="<?php echo __WEBROOT__ ?>inc/jquery.tooltipster.min.js" ></script>
        <script type="text/javascript" src="<?php echo __WEBROOT__ ?>inc/qaloo.js?d=021920131115" ></script>
    </head>
    <body>
        <div id="help" class="overlay">
            <img id="helpImage" src=""/>
        </div>
        <div id="loginRegister" class="overlay loginRegister">
            <div class="overlayLeft">
                <form action="/base.register/register" method="post">
                    <div id="registerItems">
                    </div>
                    <input type="hidden" id="registerTopicID" name="topicID" />
                    <input type="hidden" id="registerInviteCode" name="inviteCode" />
                    <input type="hidden" id="registerVoteDir" name="voteDir" />
                    <input type="hidden" id="registerItemID" name="itemID" />
                    <table>
                        <tbody>
                            <tr>
                                <td class="mw-label"><label>Full Name</label></td>
                                <td class="mw-input">
                                    <input class="loginText" tabindex="1" type="text" size="20" autofocus="" name="fullname">			
                                </td>
                            </tr>
                            <tr>
                                <td class="mw-label"><label>E-mail</label></td>
                                <td class="mw-input">
                                    <input class="loginText" tabindex="2" size="20" type="email" name="email">					
                                </td>
                            </tr>
                            <tr>
                                <td class="mw-label"><label>Password:</label></td>
                                <td class="mw-input">
                                    <input class="loginPassword" value="" tabindex="3" size="20" type="password" name="password">			
                                </td>
                            </tr>
                            <tr>
                                <td class="mw-label"><label>Confirm password</label></td>
                                <td class="mw-input">
                                    <input class="loginPassword" value="" tabindex="4" size="20" type="password" name="passwordConfirm">			
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="mw-input">
                                    <input name="rememberPassword" type="checkbox" value="1" checked="checked" tabindex="5">&nbsp;<label>Remember password</label>			
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="mw-submit">
                                    <button type="submit" name="wpCreateaccount" id="wpCreateaccount" tabindex="6">Continue ➜</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="overlayRight" style="height: 287px;">
                <h2>New to Qaalo? Register to:</h2>
                <ul>
                    <li>Create lists about anything</li>
                    <li>Ask your close network to collaborate</li>
                    <li>Follow categories about your interests</li>
                    <li>Rate items to define top 10</li>
                    <li>Contribute to other lists</li>
                </ul>
                <h2 style="margin-top:10px;margin-bottom:7px;">Already registered?</h2>
                <form action="/base.login" method="post">
                    <div id="loginItems">
                    </div>
                    <input type="hidden" id="loginTopicID" name="topicID" />
                    <input type="hidden" id="loginInviteCode" name="inviteCode" />
                    <input type="hidden" id="loginVoteDir" name="voteDir" />
                    <input type="hidden" id="loginItemID" name="itemID" />
                    <button type="submit">Login now ➜</button>
                </form>
            </div>
            <div class="clearfix"></div>
        </div>
        <div id="userCard" class="overlay userCard">
            <div class="profile">
                <div class="userPic">
                    <img id="cardProfilePicture">
                </div>
                <h3 id="cardFullName"></h3>
                <div id="cardBio"></div>
                <div id="cardLink"></div>
            </div>
            <div id="talkingAbout" class="talkingAbout">
                <div class="description">listing about</div>
                <ul id="cardCategoryList" class="categoryList clearfix">
                </ul>
            </div>
            <div id="latest" class="latest">
                <div class="description">latest lists</div>
                <ul id="cardTopicList"  class="topicList clearfix">
                </ul>
            </div>
        </div>

        <div class="bar">
            <div class="menu clearfix">
                <a class="logo" href="/"></a>
                <div class="helpLink">
                    <a href="#help" onclick="showHelp();">HOW TO?</a>
                </div>
                <div id="search">
                    <input class="default" spellcheck="false" autocomplete="off" autofocus="on" type="text" placeholder="Search a list..." id="searchBox" name="searchKeyword">
                </div>

                <?php if ($this->isLoggedIn()) { ?>
                    <div class="create"><a href="/base.create">or Create a List ➜</a>                </div>
                <?php } else { ?>
                    <div class="create"><a href="/base.register" onclick="showRegisterForm();return false;">or Create a List ➜</a>                </div>
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
                            <a href='/base.login'>login</a> | <a onclick="showRegisterForm();return false;" href='/base.register'>register</a>
                        </div>
                    <?php } ?> 
                </div>
            </div>

        </div>
        <div class="main" id="main">
            <?php $this->dumpErrors(); ?>
            <?php require "views/" . $this->urlValues["controller"] . ".php"; ?>
            <div class="clearfix"></div>
        </div>
        <div class="footer">
            <ul>
                <li>All lists available under the terms of the Creative Commons Attribution 3.0 Unported License</li>
                <li><a href="/base.directory">directory</a></li>
                <li>Qaalo Inc © 2013</li>
            </ul>
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