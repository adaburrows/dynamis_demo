<div>
  <h1>Manage Posts</h1>
  <a name="#flash"></a>
  <?php echo $flash!=null ? "<div id=\"flash\">$flash</div>" : ''; ?>
  <ul id="post_list" class="entity_list">
    <?php $count = 0; ?>
    <?php foreach($posts as $post) :?>
    <li class="edit_block post<?php if (($count%2)==1) {echo ' odd';}?>" id="post_<?php echo $post['post_id']; ?>">
      <ul class="inline_nav">
        <li class="inline_nav"><a class="edit" href="<?php echo app::site_url(array('posts', 'edit', $post['post_id'])); ?>">Edit</a></li>
        <li class="inline_nav"><a class="delete" href="<?php echo app::site_url(array('posts', 'delete', $post['post_id'])); ?>">Delete</a></li>
      </ul>
      <h6><a href="<?php echo app::site_url(array('posts', 'view', $post['post_slug'])); ?>"><span class="post_id"><?php echo $post['post_id']; ?></span> &mdash; <?php echo $post['title']; ?></a></h6>
      <div class="post_info">
        <span>Categorized as: <span class="category"><?php echo $post['cat_name']; ?></span></span>
        <span>Created on: <span class="date"><?php echo $post['created']; ?></span></span>
        <span>Last modified: <span class="date"><?php echo $post['modified']; ?></span></span>
      </div>
    </li>
    <?php $count++; ?>
    <?php endforeach; ?>
  </ul>
</div>