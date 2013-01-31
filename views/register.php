<div class="mainSub">
    <form action="<?php echo $this->getAction("register") ?>" method="post">
        <input type="hidden" name="inviteCode" value="<?= $this->inviteCode ?>">
        <input type="hidden" name="ticket" value="<?= $this->ticket ?>">
        <table>
            <tbody>
                <tr>
                    <td class="mw-label"><label>First Name</label></td>
                    <td class="mw-input">
                        <input class="loginText capitalize" tabindex="1" value="<?php echo $this->firstname; ?>" type="text" size="20" autofocus="" name="firstname">			
                    </td>
                </tr>
                <tr>
                    <td class="mw-label"><label >Last Name</label></td>
                    <td class="mw-input">
                        <input class="loginText capitalize" tabindex="2" value="<?php echo $this->lastname; ?>"type="text" size="20" name="lastname">			
                    </td>
                </tr>
                <tr>
                    <td class="mw-label"><label>E-mail</label></td>
                    <td class="mw-input">
                        <input class="loginText" value="<?php echo $this->email; ?>" tabindex="3" size="20" type="email" name="email">					
                    </td>
                </tr>
                <tr>
                    <td class="mw-label"><label>Password:</label></td>
                    <td class="mw-input">
                        <input class="loginPassword" value="" tabindex="4" size="20" type="password" name="password">			
                    </td>
                </tr>
                <tr>
                    <td class="mw-label"><label>Confirm password</label></td>
                    <td class="mw-input">
                        <input class="loginPassword" value="" tabindex="5" size="20" type="password" name="passwordConfirm">			
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td class="mw-input">
                        <input name="rememberPassword" type="checkbox" value="1" checked="checked" tabindex="6">&nbsp;<label>Remember password</label>			
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