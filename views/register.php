<div class="mainSub">
    <h2>Welcome to Qaalo!</h2>
    <form action="<?php echo $this->getAction("register") ?>" method="post">
        <input type="hidden" name="inviteCode" value="<?= $this->inviteCode ?>">
        <input type="hidden" name="ticket" value="<?= $this->ticket ?>">
        <input type="hidden" name="topicID" value="<?= $this->topicID ?>">
        <?php if ($this->itemText!="") {foreach($this->itemText as $itemStr) { ?>
        <input type="hidden" name="itemText[]" value="<?= $itemStr ?>">
        <?php }}?>
        <input type="hidden" name="itemID" value="<?= $this->itemID ?>">
        <input type="hidden" name="voteDir" value="<?= $this->voteDir ?>">
        <table>
            <tbody>
                <tr>
                    <td class="mw-label"><label>Full Name</label></td>
                    <td class="mw-input">
                        <input class="loginText" tabindex="1" value="<?php echo $this->fullname; ?>" type="text" size="25" autofocus="" name="fullname">			
                    </td>
                </tr>
                <tr>
                    <td class="mw-label"><label>E-mail</label></td>
                    <td class="mw-input">
                        <input class="loginText" value="<?php echo $this->email; ?>" tabindex="2" size="25" type="email" name="email">					
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
                        <button type="submit" name="wpCreateaccount" id="wpCreateaccount" tabindex="6">Create account</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>