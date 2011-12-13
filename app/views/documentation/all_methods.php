<h1>uLynk</h1>
<?php foreach ($reflections as $type => $data): ?>
<div class="documentation_class_type">
  <h2><?php echo $type; ?></h2>
  <?php foreach ($data as $class => $scopes): ?>
    <div class="documentation_class_scopes">
      <h3><?php echo $class; ?></h3>
      <div class="documentation_class_methods">
      <?php foreach ($scopes as $scope => $methods): ?>
        <h4><?php echo $scope;?></h4>
        <ul class="documentation_class_methods">
        <?php foreach ($methods as $method): ?>
          <li class="documentation_class_method"><?php echo $method; ?></li>
        <?php endforeach; ?>
        </ul>
      <?php endforeach;?>
      </div>
    </div>
  <?php endforeach; ?>
</div>
<?php endforeach; ?>