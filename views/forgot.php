<div class="mainSub">
    <h2>Forgot your password?</h2>
    Give us your email address you have used for registration and we will send you your password.
    <br/><br/>
    <form action="<?php echo $this->getAction("remember") ?>" method="post">
        <table>
            <tbody>
                <tr>
                    <td class="mw-input">
                        <input class="loginText" value="<?= $this->email ?>" placeholder="input your email" type="text" tabindex="1" size="30" autofocus="" name="email">
                        <button id="wpLoginAttempt" tabindex="9" type="submit" name="wpLoginAttempt">remember</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>