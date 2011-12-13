<ul id="header_nav" class="nav sf-menu">
  <?php foreach($header_nav as $item): ?>
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
