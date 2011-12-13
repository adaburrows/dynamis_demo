<div>
  <h1>Manage Admin Users</h1>
  <a name="#flash"></a>
  <?php echo $flash!=null ? "<div id=\"flash\">$flash</div>" : ''; ?>
  <br/>
  <div>
  <form style="display: block; width: 100%;" action="<?php echo app::site_url(array('users', 'admins')); ?>" enctype="multipart/form-data" method="post">
    <input type="text" name="email" />
    <input class="submit" type="submit" value="Add user (by email)" />
  </form>
  </div>
  <table>
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Email</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php $count = 0; ?>
      <?php foreach($users as $user) :?>
      <tr<?php if (($count%2)==1) {echo ' class="odd"';}?>>
        <th scope="row"><?php echo $user['id']; ?></th>
        <td><?php echo $user['email']; ?></td>
        <td>
          <form style="display:inline;" action="<?php echo app::site_url(array('users', 'admins')); ?>#flash" enctype="multipart/form-data" method="post">
            <input type="hidden" name="delete_admin" value="1" />
            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>" />
            <input class="button" type="submit" value="Delete user" />
          </form>
        </td>
      </tr>
      <?php $count++; ?>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
