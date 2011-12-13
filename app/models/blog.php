<?php
class blog extends model {

  public function __construct() {
    $this->aspects = array (
      'posts',
      'categories'
    );
    $this->join_on = array (
      array('posts' => 'category_id', 'categories' => 'cat_id')
    );
    parent::__construct();
  }

  public function get_blog_name() {
    return "Blog";
  }

  public function get_categories() {
    $select = $this->build_select('categories').';';
    return db::query_array($select);
  }

  public function get_category_by_id($id) {
    $data = array('cat_id' => $id);
    $select = $this->build_select('categories', NULL, $data);
    return db::query_item($select, $data);
  }

  public function get_category_by_slug($slug) {
    $data = array('cat_slug' => $slug);
    $select = $this->build_select('categories', NULL, $data);
    return db::query_item($select, $data);
  }

  public function get_posts($limit = '', $offset = '') {
    $select = $this->build_select();
    if ($limit != '')
      $select .= " LIMIT $limit";
    if ($offset != '')
      $select .= " OFFSET $offset";
    $select .= ';';
    $result = db::query_array($select);
    return $result;
  }

  public function get_posts_by_category($category, $limit = '', $offset = '') {
    $data = array('cat_slug' => $category);
    $select = $this->build_select(NULL, NULL, $data);
    if ($limit != '')
      $select .= " LIMIT $limit";
    if ($offset != '')
      $select .= " OFFSET $offset";
    $select .= ';';
    return db::query_array($select, $data);
  }

  public function get_post_by_id($id) {
    return $this->get_by_id($id);
  }

  public function get_post_by_slug($slug) {
    $data = array('post_slug' => $slug);
    $select = $this->build_select(NULL, NULL, $data);
    $post = db::query_item($select, $data);
    return $post;
  }

  public function set_post($data) {
    $result = $this->set($data, 'posts');
    return $result;
  }

  public function set_category($data) {
    $result = $this->set($data, 'categories');
    return $result;
  }

  public function delete_post($id) {
    return db::query_ins(
      "DELETE FROM `posts` WHERE `post_id` = :id;",
      array('id' => $id)
    );
  }

  public function delete_category($id) {
    return db::query_ins(
      "DELETE FROM `categories` WHERE `cat_id` = :id;",
      array('id' => $id)
    );
  }

}
