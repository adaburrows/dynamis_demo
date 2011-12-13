<div>
  <form id="page_edit" action="<?php echo app::site_url(array('pages', 'add')); ?>" enctype="multipart/form-data" method="post">
    <input type="hidden" name="add_page" value="1" />
    <label for="title">Title</label>
    <input type="text" id="title" name="title" />
    <label for="name">Name (seo-friendly)</label>
    <input type="text" id="name" name="name" />
    <label for="description">Description</label>
    <input type="text" id="description" name="description" />
    <label for="keywords">Keywords</label>
    <input type="text" id="keywords" name="keywords" />
    <label for="content">Content</label>
    <textarea id="content" name="content"></textarea>
    <input type="submit" value="Save" name="save" class="inline_nav" />
  </form>
</div>
