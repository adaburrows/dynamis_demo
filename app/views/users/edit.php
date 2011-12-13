<div>
  <h1>Edit user</h1>
  <a name="#flash"></a>
  <?php echo $flash!=null ? "<div id=\"flash\">$flash</div>" : ''; ?>
  <br/>
  <div>
    <form id="add_user" action="<?php echo app::site_url(array('users', 'edit', $user_id)); ?>" enctype="multipart/form-data" method="post">
      <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
      <fieldset>
        <label class="textfield">E-Mail</label>
        <input name="email" type="text" value="<?php echo $email; ?>" />
      </fieldset>
      <fieldset>
        <label class="textfield">Password</label>
        <input name="password" type="password" />
      </fieldset>
      <fieldset>
        <input class="submit" type="submit" value="Edit User" alt="Edit User"/>
      </fieldset>
    </form>
  </div>
</div>
