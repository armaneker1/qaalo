<div class="mainSub">
    <form action="<?php echo $this->getAction("register") ?>" method="post">
        <input type="hidden" name="inviteCode" value="<?= $this->inviteCode ?>">
        <input type="hidden" name="ticket" value="<?= $this->ticket ?>">
        <table>
            <tbody>
                <tr>
                    <td class="mw-label"><label for="wpName2">First Name</label></td>
                    <td class="mw-input">
                        <input class="loginText" id="wpName2" tabindex="1" value="<?php echo $this->firstname; ?>" type="text" size="20" autofocus="" name="firstname">			
                    </td>
                </tr>
                <tr>
                    <td class="mw-label"><label for="wpName2">Last Name</label></td>
                    <td class="mw-input">
                        <input class="loginText" id="wpName2" tabindex="2" value="<?php echo $this->lastname; ?>"type="text" size="20" name="lastname">			
                    </td>
                </tr>
                <tr>
                    <td class="mw-label"><label for="wpEmail">E-mail</label></td>
                    <td class="mw-input">
                        <input class="loginText" id="wpEmail"  value="<?php echo $this->email; ?>" tabindex="3" size="20" type="email" name="email">					
                    </td>
                </tr>
                <tr>
                    <td class="mw-label"><label for="wpPassword2">Password:</label></td>
                    <td class="mw-input">
                        <input class="loginPassword" id="wpPassword2" value="" tabindex="4" size="20" type="password" name="password">			
                    </td>
                </tr>
                <tr>
                    <td class="mw-label"><label for="wpRetype">Confirm password</label></td>
                    <td class="mw-input">
                        <input class="loginPassword" id="wpRetype" value="" tabindex="5" size="20" type="password" name="passwordConfirm">			
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td class="mw-input">
                        <input name="rememberPassword" type="checkbox" value="1" checked="checked" id="wpRemember" tabindex="6">&nbsp;<label for="wpRemember">Remember password</label>			
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td class="mw-submit">
                        <button type="submit" name="wpCreateaccount" id="wpCreateaccount" tabindex="7">Create account</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>