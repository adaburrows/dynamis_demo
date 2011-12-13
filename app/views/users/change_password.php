<div>
  <h1>Change your password</h1>
  <a name="#flash"></a>
  <?php echo $flash!=null ? "<div id=\"flash\">$flash</div>" : ''; ?>
  <br/>
  <div>
    <form action="<?php echo app::site_url(array('users', 'change_password')); ?>" method="post"><br/>
      <input type="hidden" name="login" value="1" />
      <ul class="form">
        <li><label class="textfield">Username</label><input name="username" type="text" class="textfield" value="" /></li>
        <li><label class="textfield">Password we sent</label><input name="old_pass" type="password" class="textfield" value="" /></li>
        <li><label class="textfield">New Password</label><input name="new_pass" type="password" class="textfield" value="" /></li>
        <li><label class="textfield">Verify New Password</label><input name="new_pass_verify" type="password" class="textfield" value="" /></li>
      </ul>
      <input class="submit" type="submit" value="Change Password" alt="Change Password" />
    </form>
    <br/>
  </div>
</div>
