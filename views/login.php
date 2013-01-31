<div class="mainSub">
    <form action="<?php echo $this->getAction("login") ?>" method="post">
        <input type="hidden" name="inviteCode" value="<?= $this->inviteCode ?>">
        <table>
            <tbody><tr>
                    <td class="mw-label"><label>Email:</label></td>
                    <td class="mw-input">
                        <input class="loginText" type="text" tabindex="1" autofocus="" size="20" autofocus="" name="email">
                    </td>
                </tr>
                <tr>
                    <td class="mw-label"><label>Password:</label></td>
                    <td class="mw-input">
                        <input class="loginPassword" tabindex="2" size="20" type="password" name="password">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td class="mw-input">
                        <input name="rememberPassword" type="checkbox" checked="1" tabindex="4">&nbsp;<label>Remember me</label>			
                        | <a href="/base.forgot">Forgot?</a>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td class="mw-submit">
                        <button id="wpLoginAttempt" tabindex="3" type="submit">Login</button>
                    </td>
                </tr>
            </tbody></table>
    </form>
</div>