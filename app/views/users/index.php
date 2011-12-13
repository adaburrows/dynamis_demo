<div>
  <h1>Manage Users</h1>
  <a name="#flash"></a>
  <?php echo $flash!=null ? "<div id=\"flash\">$flash</div>" : ''; ?>
  <ul id="user_list" class="entity_list">
    <?php $count = 0; ?>
    <?php foreach($users as $user) :?>
    <li class="edit_block user<?php if (($count%2)==1) {echo ' odd';}?>" id="user_<?php echo $user['id']; ?>">
      <ul class="inline_nav">
        <form style="display:inline;" action="<?php echo app::site_url(array('users', 'edit', $user['id'])); ?>" enctype="multipart/form-data" method="post">
          <input class="inline_nav" type="submit" value="Edit" />
        </form>
        <form style="display:inline;" action="<?php echo app::site_url(array('users','delete', $user['id'])); ?>" enctype="multipart/form-data" method="post">
          <input type="hidden" name="delete_user" value="1" />
          <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>" />
        <input class="inline_nav" type="submit" value="Delete" alt="Delete User" />
        </form>
      </ul>
      <h6><a href="<?php echo app::site_url(array('users', 'view', $user['id'])); ?>"><span class="user_id"><?php echo $user['id']; ?></span> &mdash; <?php echo $user['email']; ?></a></h6>
      <div class="user_info">
        <span>User since: <span class="date"><?php echo $user['added']; ?></span></span>
      </div>
    </li>
    <?php $count++; ?>
    <?php endforeach; ?>
  </ul>
</div>
