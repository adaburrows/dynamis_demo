<div>
  <h1>Add user</h1>
  <a name="#flash"></a>
  <?php echo $flash!=null ? "<div id=\"flash\">$flash</div>" : ''; ?>
  <br/>
  <div>
  <form id="add_user" action="<?php echo app::site_url(array('users', 'add')); ?>" enctype="multipart/form-data" method="post">
    <fieldset>
      <label class="textfield">E-Mail</label>
      <input name="email" type="text" />
    </fieldset>
    <fieldset>
      <label class="textfield">Password</label>
      <input name="password" type="password" />
    </fieldset>
    <fieldset>
      <input class="submit" type="submit" value="Add user" alt="Add user"/>
    </fieldset>
  </form>
  </div>
</div>
