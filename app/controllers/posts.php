<?php
class posts extends controller {
  private $Blog;
  
/**
 * 
 * ==========================================================================
 */
  public function initialize() {
    parent::initialize();
    $this->Blog = self::getModel('blog');
  }

/**
 * Displays the index of posts for user to page through
 * ==========================================================================
 */
  public function index($page = 0) {
    $data = array();
    if (array_key_exists('page', self::$named_params))
      $page = self::$named_params['page'];
    $limit = 10;
    $offset = $page * $limit;

    if (array_key_exists('category', self::$named_params)){
      $category = self::$named_params['category'];
      $data['posts'] = $this->Blog->get_posts_by_category($category, $limit, $offset);
      $cat_info = $this->Blog->get_category_by_slug($category);
      $data['title'] = 'Posts in category '. $cat_info['name'];
    } else {
      $data['posts'] = $this->Blog->get_posts($limit, $offset);
      $data['title'] = $this->Blog->get_blog_name();
    }
    $data['results'] = DB::num_results();
    if($data['results'] > 0) {
      
    } else {
      $data['flash'] = "No posts found.";
    }
    foreach($data['posts'] as $index => $post) {
      $data['posts'][$index]['created'] = date("l, F j, Y", strtotime($post['created']));
      $data['posts'][$index]['modified'] = date("l, F j, Y", strtotime($post['modified']));
    }
    return $data;
  }

/**
 * Displays all blog posts to manage them.
 * ==========================================================================
 */
  public function manage() {
    $data = array();
    $data['posts'] = $this->Blog->get_posts();
    $data['title'] = $this->Blog->get_blog_name();

    foreach($data['posts'] as $index => $post) {
      $data['posts'][$index]['created'] = date("l, F j, Y", strtotime($post['created']));
      $data['posts'][$index]['modified'] = date("l, F j, Y", strtotime($post['modified']));
    }
    return $data;
  }

/**
 * Views a particular post byt id or slug
 * ==========================================================================
 */
  public function view($id) {
    $data = $this->Blog->get_post_by_id($id);
    if (!$data) {
      $data = $this->Blog->get_post_by_slug($id);
    }
    if (!$data) {
      throw new Exception("Entry $id not found.");
    }
    return($data);
  }

/**
 * Adds a post
 * ==========================================================================
 */
  public function add() {
    // verify user has priviledges
    if($this->User->isLoggedIn() && $this->User->isAdmin()) {
      if (isset($_POST['add_post'])) {
        print_r($_POST);
        $success = $this->Blog->set_post($_POST);
        if ($success) {
          $id = db::insertId();
          header("Location: /posts/edit/$id");
          exit(0);
        } else {
          // add code to handle failure adding a post.
        }
      }
      layout::addScript('tiny_mce', app::site_url('tiny_mce/tiny_mce.js'));
      layout::addScript('load_tiny_mce', app::site_url('scripts/tiny_mce.js'));
      $data = array(
        'categories' => $this->Blog->get_categories()
      );
    } else {
      header("Location: ".app::site_url(array('users','login')));
      exit(0);
    }
    return($data);
  }

/**
 * Edits a post
 * ==========================================================================
 */
  public function edit($id) {
    $data = array('flash' => NULL);
    // verify user has priviledges
    if($this->User->isLoggedIn() && $this->User->isAdmin()) {
      if (isset($_POST['post_id'])) {
        $_POST['post_id'] = $id;
        $success = $this->Blog->set_post($_POST);
        if ($success) {
          $data['flash'] = "Blog saved.";
        } else {
          $data['flash'] = "I'm sorry, but that failed.";
        }
      }
      layout::addScript('tiny_mce', app::site_url('tiny_mce/tiny_mce.js'));
      layout::addScript('load_tiny_mce', app::site_url('scripts/tiny_mce.js'));
      $data = array_merge($data, $this->Blog->get_post_by_id($id));
      $data['categories'] = $this->Blog->get_categories();
    } else {
      header("Location: ".app::site_url(array('users','login')));
      exit(0);
    }
    return $data;
  }

/**
 * Deletes a post
 * ==========================================================================
 */
  public function delete($id) {
    // verify user has priviledges
    if($this->User->isLoggedIn() && $this->User->isAdmin()) {
      $this->Blog->delete_post($id);
      header("Location: ".app::site_url(array('posts', 'index')));
      exit(0);
    } else {
      header("Location: ".app::site_url(array('users','login')));
      exit(0);
    }
  }
  
}
