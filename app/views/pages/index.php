<div>
  <h1>Manage Pages</h1>
  <a name="#flash"></a>
  <?php echo $flash!=null ? "<div id=\"flash\">$flash</div>" : ''; ?>
  <ul id="page_list" class="entity_list">
    <?php $count = 0; ?>
    <?php foreach($pages as $page) :?>
    <li class="edit_block page<?php if (($count%2)==1) {echo ' odd';}?>" id="page_<?php echo $page['id']; ?>">
      <ul class="inline_nav">
        <li class="inline_nav"><a class="edit" href="<?php echo app::site_url(array('pages', 'edit', $page['id'])); ?>">Edit</a></li>
        <li class="inline_nav"><a class="delete" href="<?php echo app::site_url(array('pages', 'delete', $page['id'])); ?>">Delete</a></li>
      </ul>
      <h6><a href="<?php echo app::site_url(array('pages', 'view', $page['name'])); ?>"><span class="page_id"><?php echo $page['id']; ?></span> &mdash; <?php echo $page['title']; ?></a></h6>
      <div class="page_info">
        <span>Created on: <span class="date created"><?php echo $page['created']; ?></span></span>
        <span>Last modified: <span class="date modified"><?php echo $page['modified']; ?></span></span>
      </div>
    </li>
    <?php $count++; ?>
    <?php endforeach; ?>
  </ul>
</div>