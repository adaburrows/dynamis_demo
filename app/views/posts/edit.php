<div>
  <h1>Edit Post</h1>
  <a name="flash"></a>
  <?php if(isset($flash)): ?>
    <div class="flash"><?php echo $flash; ?></div>
  <?php endif; ?>
  <form id="post_edit" action="<?php echo app::site_url(array('posts', 'edit', $post_id)); ?>" enctype="multipart/form-data" method="post">
    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>" />
    <label for="title">Title</label>
    <input type="text" id="title" name="title" value="<?php echo $title; ?>" />
    <label for="post_slug">Name (seo-friendly)</label>
    <input type="text" id="post_slug" name="post_slug" value="<?php echo $post_slug; ?>" />
    <label for="description">Description</label>
    <input type="text" id="description" name="description" value="<?php echo $description; ?>" />
    <label for="keywords">Keywords</label>
    <input type="text" id="keywords" name="keywords" value="<?php echo $keywords; ?>" />
    <label for="keywords">Category</label>
    <select name="category_id">
    <?php foreach($categories as $c) : ?>
      <option value="<?php echo $c['cat_id']; ?>"<?php echo $category_id == $c['cat_id'] ? ' selected="selected"' : ''; ?>><?php echo $c['cat_name']; ?></option>
    <?php endforeach; ?>
    </select>
    <label for="content">Content</label>
    <textarea id="content" name="content"><?php echo $content; ?></textarea>
    <input type="submit" value="Save" name="save" class="inline_nav" />
  </form>
</div>
