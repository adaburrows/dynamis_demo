<?php if($admin_nav != NULL): ?>
<div id="admin_menu">
  <div class="wrap">
    <ul id="admin_nav" class="nav sf-menu">
      <?php foreach($admin_nav as $item): ?>
      <li>
        <a href="<?php echo $item['url']; ?>" title="<?php echo $item['title'] ?>"><?php echo $item['text']; ?></a>
        <?php if(isset($item['submenu'])): ?>
        <ul>
          <?php foreach($item['submenu'] as $subitem): ?>
          <li><a href="<?php echo $subitem['url']; ?>" title="<?php echo $subitem['title'] ?>"><?php echo $subitem['text']; ?></a></li>
          <?php endforeach; ?>
        </ul>
        <?php endif; ?>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>
<div id="admin_padding"></div>
<?php endif; ?>