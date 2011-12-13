<div>
  <h1><?php echo $title; ?></h1>
  <a name="#flash"></a>
  <?php echo isset($flash) ? "<div id=\"flash\">$flash</div>" : ''; ?>
<?php if($results > 0): ?>
  <?php $count = 0; ?>
  <?php foreach($posts as $post) :?>
  <div class="clear post<?php if (($count%2)==1) {echo ' odd';}?>" id="post_<?php echo $post['post_id']; ?>">
    <h2 id="post_title" class="listing_title"><a href="<?php echo app::site_url(array('posts', 'view', $post['post_slug']));?>"><?php echo $post['title']; ?></a></h2>
    <div id="post_content"><?php echo $post['content']; ?></div>
    <div id="post_meta">
      <span class="category"><span class="italo_disco">Categorized in: </span><?php echo $post['cat_name']; ?></span>
      <span class="date"><span class="italo_disco">Published: </span><?php echo $post['created']; ?></span>
    </div>
  </div>
  <?php $count++; ?>
  <?php endforeach; ?>
<?php endif; ?>
</div>
