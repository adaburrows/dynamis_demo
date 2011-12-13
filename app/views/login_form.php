<div id="login_form">
  <?php if(!$login_form): ?>
  <form action="<?php echo app::site_url(array('users', 'login')); ?>" method="post">
    <input type="hidden" name="login" value="1" />
    <ul class="login_fields inline_nav">
      <li>
        <label class="textfield">Username</label><input name="username" type="text" class="textfield" value="" />
        <label class="textfield">Password</label><input name="password" type="password" class="textfield" value="" />
        <input class="inline_nav" type="submit" name="login" value="Login" alt="Login"/>
        <span><a href="<?php echo app::site_url(array('users', 'forgot_password')); ?>">Forgot your password?</a></span>
      </li>
    </ul>
  </form>
  <?php else: ?>
    <ul class="inline_nav">
      <li class="inline_nav"><a href="<?php echo app::site_url(array('users', 'logout')); ?>">Logout</a></li>
    </ul>
  <?php endif; ?>
</div>
