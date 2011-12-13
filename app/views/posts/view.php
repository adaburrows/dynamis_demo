<div id="post" class="post clear">
  <a name="#flash"></a>
  <?php if ($flash!=null): ?>
  <div id="flash"><?php echo $flash; ?></div>
  <?php endif; ?>
  <span class="blog_nav"><a href="<?php echo app::site_url(array('posts', 'index'));?>">&lt;&lt; Back to blog</a></span>
  <h2 id="post_title" class="listing_title"><a href="<?php echo app::site_url(array('posts', 'view', $post_slug));?>"><?php echo $title; ?></a></h2>
  <div id="post_content"><?php echo $content; ?></div>
  <div id="post_meta">
    <span class="category"><span class="italo_disco">Categorized in: </span><?php echo $cat_name; ?></span>
    <span class="date"><span class="italo_disco">Published: </span><?php echo $created; ?></span>
  </div>
</div>
