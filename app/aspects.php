<?php
$aspects = array();
$aliases = array();

$aspects['posts'] = array (
  'post_id',
  'post_slug',
  'title',
  'description',
  'keywords',
  'content',
  'category_id'
);
$aspects['categories'] = array (
  'cat_id',
  'cat_name',
  'cat_slug',
  'cat_desc'
);
$aspects['pages'] = array(
  'id',
  'name',
  'title',
  'description',
  'keywords',
  'content'
);
$aspects['users'] = array(
  'id',
  'email',
  'password'
);
$aspects['admins'] = array(
  'id'
);
