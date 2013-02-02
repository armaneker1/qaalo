<script type="text/javascript" src="<?php echo __WEBROOT__ ?>inc/jquery.ajaxupload.js" ></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#userPic").ajaxUploadPrompt({
            url: '/upload.php',
            success: function (data, status, xhr) {
                var response = jQuery.parseJSON( data );
                if (response.error) {
                    $.ambiance({message: "invalid picture, try again!", type: "error"}); 
                } else {
                    $("#userPic").empty();
                    $("#userPic").append($("<img>").attr("src", "<?php echo __WEBROOT__ ?>inc/img/user/t" + response.filename));
                    $.ambiance({message: "voow, you look good :)", type: "success"}); 
                }
            },
            error: function (e) {
                console.log(e);
            }
        });
    });
</script>

<div class="settings">

    <div class="right">
        <div class="clearfix">
            <div id="userPic" class="userPic">
                <img src="<?= $this->user->getThumbPhotoUrl(); ?>">
            </div>
            <h3><?= $this->user->getFullname(); ?></h3>
            <?= $this->user->getBio() ?><br/>
            <?= Tool::getLink($this->user->getUrl()) ?>
        </div>
        <hr/>
        <ul style="padding-left: 10px;font-size:16px;">
            <li>
                <a href="/base.settings">Check your categories</a>
            </li>
            <hr/>
            <li>
                <a href="/base.settings/mail">Update notifications</a>
            </li>
            <li>
                <a href="/base.settings/profile">Update your profile</a>
            </li>
            <li>
                <a href="/base.settings/password">Update your password</a>
            </li>
        </ul>
    </div>

    <div class="left">
        <?php if ($this->getCurrentAction() == "profile" || $this->getCurrentAction() == "update") { ?>
            <form action="<?php echo $this->getAction("update") ?>" method="post">
                <div class="fields"> 
                    <input type="text" maxlength="100" size="20" placeholder="Your name" value="<?= $this->user->getFullname() ?>" name="fullname"/><br/>
                    <div class="fieldDescription">Please enter your real name and surname</div>
                    <input type="text" maxlength="255" size="40" placeholder="Something about yourself" value="<?= $this->user->getBio() ?>" name="bio"/><br/>
                    <input type="text" maxlength="255" size="40" placeholder="Your website" value="<?= $this->user->getUrl() ?>" name="url"/><br/>
                    <div class="fieldDescription">Your short bio and website is displayed next to your name on lists</div>
                    <input type="text" maxlength="255" size="40" placeholder="Your email" value="<?= $this->user->getEmail() ?>" name="email"/><br>
                    <div class="fieldDescription">Please enter a valid mail</div>
                    <button style="float:left !important;">Update now</button>
                </div>
            </form>
        <?php } ?>

        <?php if ($this->getCurrentAction() == "password" || $this->getCurrentAction() == "updatePassword") { ?>
            <form action="<?php echo $this->getAction("updatePassword") ?>" method="post">
                <div class="fields"> 
                    <label>New Password:</label>
                    <input class="loginPassword" value="" tabindex="1" size="20" type="password" name="password"><br/>
                    <label>New password again</label>
                    <input class="loginPassword" value="" tabindex="2" size="20" type="password" name="passwordConfirm"><br/>
                    <button style="float:left !important;">Update now</button>
                </div>
            </form>
        <?php } ?>

        <?php if ($this->getCurrentAction() == "index") { ?>
            <h2>Categories</h2>
            You can watch categories and can track the lists about that category on your timeline.
            <ul class="categoryList">
                <li>
                    <div class="clearfix">
                        <div class="categoryText">
                            <h3>Math</h3>
                            What is your love to numbers
                        </div>
                        <button class="small">remove</button>
                    </div>
                </li>
                <li>
                    <div class="clearfix">
                        <div class="categoryText">
                            <h3>Math</h3>
                            What is your love to numbers
                        </div>
                        <button class="small">remove</button>
                    </div>
                </li>
            </ul>
        <?php } ?>


        <?php if ($this->getCurrentAction() == "mail") { ?>
            <h2>Notification Settings</h2>
            <ul>
                <li>
                    <input ajaxAction="back.user/notify" type="checkbox" name="updateMail" <?= $this->user->receivesUpdateMail() ? "checked" : ""; ?> id="listUpdateMail">
                    <label for="listUpdateMail">Send me a mail when my lists updated</label>
                </li>
                <li>
                    <input ajaxAction="back.user/notify" type="checkbox" name="weeklyMail" <?= $this->user->receivesWeeklyMail() ? "checked" : ""; ?> id="weeklyMail">
                    <label for="weeklyMail">Send me a weekly mail about the topics i watch</label>
                </li>
            </ul>
        </div>
    <?php } ?>
</div>
</div>