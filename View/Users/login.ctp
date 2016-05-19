<div class="login">
    <h1>Login to Helpdesk</h1>

    <form method="post" action="<?php echo $this->Html->url('/users/login'); ?>">
        <?php echo $this->Session->flash(); ?>
        
        <p><input type="text" name="data[User][username]" placeholder="Username"></p>
        <p><input type="password" name="data[User][userpassword]" placeholder="Password"></p>

        <p class="remember_me">
            <label>
                <input type="checkbox" name="remember_me" id="remember_me">
                Remember me on this computer
            </label>
        </p>
        
        <p class="submit"><input type="submit" name="commit" value="Login"></p>
    </form>
</div>

<!--
<div class="login-help">
    <p>Forgot your password? <a href="#">Click here to reset it</a>.</p>
</div>
-->