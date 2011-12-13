<?php if ($num_pages > 0): ?>
<ul class="inline_nav pagination"> 
  <?php if ($page > 0): ?>
  <li class="inline_nav">
    <a href="<?php echo app::site_url(array($request_controller, $request_method, $prev.$params)); ?>" style="clear:both;">Previous&nbsp;&lt;&lt;</a>
  </li>
  <?php endif; ?>
  <?php for ($page_num = 0; $page_num <= $num_pages; $page_num++): ?>
    <?php if ($page_num == $page): ?>
    <li class="inline_nav curr_page">
      <span><?php echo $page_num+1; ?></span>
    </li>
    <?php else: ?>
    <li class="inline_nav">
      <a href="<?php echo app::site_url(array($request_controller, $request_method, $page_num.$params)); ?>"><?php echo $page_num+1; ?></a>
    </li>
    <?php endif; ?>
  <?php endfor; ?>
  <?php if ($page < $num_pages): ?>
  <li class="inline_nav">
    <a href="<?php echo app::site_url(array($request_controller, $request_method, $next.$params)); ?>" style="clear:both;">&gt;&gt;&nbsp;Next</a>
  </li>
  <?php endif; ?>
</ul>
<?php endif; ?>
