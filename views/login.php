<div class="mainSub">
    <form action="<?php echo $this->getAction("login") ?>" method="post">
        <input type="hidden" name="inviteCode" value="<?= $this->inviteCode ?>">
        <table>
            <tbody><tr>
                    <td class="mw-label"><label for="wpName1">Email:</label></td>
                    <td class="mw-input">
                        <input class="loginText" id="wpName1" type="text" tabindex="1" size="20" autofocus="" name="email">
                    </td>
                </tr>
                <tr>
                    <td class="mw-label"><label for="wpPassword1">Password:</label></td>
                    <td class="mw-input">
                        <input class="loginPassword" id="wpPassword1" tabindex="2" size="20" type="password" name="password">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td class="mw-input">
                        <input name="rememberPassword" type="checkbox" checked="1" id="wpRemember" tabindex="8">&nbsp;<label for="wpRemember">Remember me</label>			</td>
                </tr>
                <tr>
                    <td></td>
                    <td class="mw-submit">
                        <button id="wpLoginAttempt" tabindex="9" type="submit" name="wpLoginAttempt">Login</button>
                    </td>
                </tr>
            </tbody></table>
    </form>
</div>