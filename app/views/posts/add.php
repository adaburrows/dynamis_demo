<div>
  <h1>Add Post</h1>
  <form id="post_edit" action="<?php echo app::site_url(array('posts', 'add')); ?>" enctype="multipart/form-data" method="post">
    <input type="hidden" name="add_post" value="1" />
    <label for="title">Title</label>
    <input type="text" id="title" name="title" />
    <label for="post_slug">Slug (used in user friendly URLs)</label>
    <input type="text" id="post_slug" name="post_slug" />
    <label for="description">Description</label>
    <input type="text" id="description" name="description" />
    <label for="keywords">Keywords</label>
    <input type="text" id="keywords" name="keywords" />
    <label for="keywords">Category</label>
    <select name="category_id">
    <?php foreach($categories as $c) : ?>
      <option value="<?php echo $c['cat_id']; ?>"><?php echo $c['cat_name']; ?></option>
    <?php endforeach; ?>
    </select>
    <label for="content">Content</label>
    <textarea id="content" name="content"></textarea>
    <label for="category_id">Category</label>
    <input type="submit" value="Save" name="save" class="inline_nav" />
  </form>
</div>
