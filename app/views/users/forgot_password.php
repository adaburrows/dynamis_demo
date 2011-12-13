<div>
  <h1>Password Reset</h1>

  <a name="#flash"></a>
  <?php echo $flash!=null ? "<div id=\"flash\">$flash</div>" : ''; ?>
  <br/>

  <p>Forgot your password? Enter your email here and we'll send you a new password and link to change it.</p>
  <div>
    <form action="<?php echo app::site_url(array('users', 'forgot_password')); ?>" method="post">
      <ul class="form">
        <li><label class="textfield">E-mail</label><input name="username" type="text" class="textfield" value="" /></li>
      </ul>
      <input class="submit" type="submit" value="Get your temporary password" alt="Login"/>
    </form>
  </div>
</div>
