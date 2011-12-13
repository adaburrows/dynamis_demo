<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="keywords" content="<?php util::e($keywords); ?>" />
  <meta name="description" content="<?php util::e($description); ?>" />
  <title><?php util::e($title); ?></title>
  <?php util::e($css); ?>
  <?php util::e($scripts) ?>
  <link rel="profile" href="http://microformats.org/profile/hcard" />
  <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
</head>
<body>
  <div id="outer_wrap">
    <?php util::e($admin_nav); ?>
    <div id="header">
      <div class="wrap">
        <?php util::e($login_form); ?>
        <h2 id="site_name"></h2>
        <div id="heading">
          <a class="logo" href="<?php echo app::site_url(''); ?>"></a>
          <h3 id="motto"></h3>
        </div>
      </div>
    </div>
    <div id="navigation">
      <div class="wrap">
        <?php util::e($header_nav); ?>
      </div>
    </div>
    <div id="main">
      <div class="wrap">
        <div class="content_wrap">
          <?php util::e($content); ?>
        </div>
      </div>
    </div>
    <div id="push"></div>
  </div>
  <div id="footer">
    <div class="wrap">
      <?php util::e($footer_nav); ?>
    </div>
  </div>
</body>
</html>
