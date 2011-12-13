<div>
  <h1>Login</h1>
  <a name="#flash"></a>
  <?php echo $flash!=null ? "<div id=\"flash\">$flash</div>" : ''; ?>
  <br/>
  <div id="login_page">
    <form action="<?php echo app::site_url(array('users', 'login')); ?>" method="post"><br/>
      <input type="hidden" name="login" value="1" />
      <ul class="login_fields">
        <li><label class="textfield">Username</label><input name="username" type="text" class="textfield" value="" /></li>
        <li><label class="textfield">Password</label><input name="password" type="password" class="textfield" value="" /></li>
        <li><input class="submit" type="submit" name="login" value="Login" alt="Login"/>
        <a href="<?php echo app::site_url(array('users', 'forgot_password')); ?>">Forgot your password?</a></li>
      </ul>
    </form>
  </div>
</div>
