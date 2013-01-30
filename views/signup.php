<div class="mainSub">
    <?php if ($this->ticket != "") { ?>
        <h2>Aghhh! We are sorry</h2>
        Unfortunately, ticket code <b>'<?= $this->ticket ?>'</b> has expired.<br/>
        Follow us to for more ticket codes.
    <?php } else { ?>
        Unfortunately, registration is invite-only right now.<br/>However, you can follow us for registration tickets giveaways!
    <?php } ?>
    <br/><br/>
    <a href="https://twitter.com/theqaalo" class="twitter-follow-button" data-show-count="false" data-size="large" data-show-screen-name="false" data-dnt="true">Follow @theqaalo</a>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
    <br/><br/>
    If you have a ticket code:
    <form action="<?php echo $this->getAction("register") ?>" method="post">
        <table>
            <tbody>
                <tr>
                    <td class="mw-input">
                        <input class="loginText" id="wpName1" placeholder="paste your ticket here" type="text" tabindex="1" size="20" autofocus="" name="ticket">
                        <button id="wpLoginAttempt" tabindex="9" type="submit" name="wpLoginAttempt">Register</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>