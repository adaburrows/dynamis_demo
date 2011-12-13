<?php
class pages extends controller {
  private $Page;
  
/**
 * 
 * ==========================================================================
 */
  public function initialize() {
    parent::initialize();
    $this->Page = self::getModel('page');
  }

/**
 * 
 * ==========================================================================
 */
  public function view($id) {
    $data = $this->Page->get_by_id($id);
    if (!$data) {
      $data = $this->Page->get_by_name($id);
    }
    if (!$data) {
      throw new Exception("Page $id not found.");
    }
    return($data);
  }

/**
 * 
 * ==========================================================================
 */
  public function add() {
    $data = array();
    // verify user has priviledges
    if($this->User->isLoggedIn() && $this->User->isAdmin()) {
      layout::addScript('tiny_mce', app::site_url('tiny_mce/tiny_mce.js'));
      layout::addScript('load_tiny_mce', app::site_url('scripts/tiny_mce.js'));
      if (isset($_POST['add_page'])) {
        $success = $this->Page->set($_POST);
        if ($success) {
          $id = db::insertId();
          header("Location: ".app::site_url(array('pages', 'edit', $id)));
          exit(0);
        } else {
          // add code to handle failure adding a page.
        }
      }
    } else {
      header("Location: ".app::site_url(array('users','login')));
      exit(0);
    }
    return $data;
  }

/**
 * 
 * ==========================================================================
 */
  public function edit($id) {
    $data = array('flash' => NULL);
    // verify user has priviledges
    if($this->User->isLoggedIn() && $this->User->isAdmin()) {
      layout::addScript('tiny_mce', app::site_url('tiny_mce/tiny_mce.js'));
      layout::addScript('load_tiny_mce', app::site_url('scripts/tiny_mce.js'));
      if (isset($_POST['id']) && ($id == $_POST['id'])) {
        $_POST['id'] = $id;
        $success = $this->Page->set($_POST);
        if ($success) {
          $data['flash'] = "Page saved.";
        } else {
          $data['flash'] = "I'm sorry, but that failed.";
        }
      }
      $data = array_merge($data, $this->Page->get_by_id($id));
    } else {
      header("Location: ".app::site_url(array('users','login')));
      exit(0);
    }
    return $data;
  }

/**
 * 
 * ==========================================================================
 */
  public function delete($id) {
    // verify user has priviledges
    if($this->User->isLoggedIn() && $this->User->isAdmin()) {
      $this->Page->delete($id);
      header("Location: ".app::site_url(array('pages', 'index')));
      exit(0);
    } else {
      header("Location: ".app::site_url(array('users','login')));
      exit(0);
    }
  }

/**
 * 
 * ==========================================================================
 */
  public function index() {
    // verify user has priviledges
    if($this->User->isLoggedIn() && $this->User->isAdmin()) {
      $data['pages'] = $this->Page->get_all();
      $data['title'] = "Pages in uLynk";
    } else {
      header("Location: ".app::site_url(array('users','login')));
      exit(0);
    }
    foreach($data['pages'] as $index => $page) {
      $data['pages'][$index]['created'] = date("l, F j, Y", strtotime($page['created']));
      $data['pages'][$index]['modified'] = date("l, F j, Y", strtotime($page['modified']));
    }
    return $data;
  }
  
}
