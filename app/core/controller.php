<?php
class controller extends app {
  protected $User;

/**
 * Initialize class
 * ==========================================================================
 */
  public function initialize() {
    $this->User = self::getModel('user');

    // If the request is the default type, prepare to render everything.
    if(self::getReqType() === 'html'){
      // Add Scripts
      layout::addScript('jquery', app::site_url('scripts/jquery-1.5.1.min.js'));
      layout::addScript('jquery-ui', app::site_url('scripts/jquery-ui-1.8.11.custom.min.js'));
      layout::addScript('hoverIntent', app::site_url('scripts/jquery.hoverIntent.js'));
      layout::addScript('superfish', app::site_url('scripts/superfish.js'));
      layout::addScript('easing', app::site_url('fancybox/jquery.easing-1.3.pack.js'));
      layout::addScript('mousewheel', app::site_url('fancybox/jquery.mousewheel-3.0.4.pack.js'));
      layout::addScript('fancybox', app::site_url('fancybox/jquery.fancybox-1.3.4.pack.js'));

      layout::addScriptBlock('superfish_init', <<<SCRIPT
$(function(){
  $('#header_nav').superfish();;
});
SCRIPT
      );

      // Add Css
      layout::addCss('default', app::site_url('css/stylesheet.css'));
      layout::addCss('jquery-ui', app::site_url('css/smoothness/jquery-ui-1.8.11.custom.css'));
      layout::addCss('fancybox', app::site_url('fancybox/jquery.fancybox-1.3.4.css'));

      // Put the default views into their proper layout slot
      $slots = array(
        'admin_nav'  => 'admin_nav',
        'login_form' => 'login_form',
        'header_nav' => 'header_nav',
        'footer_nav' => 'footer_nav'
      );
      layout::setSlots($slots);

      /*
       * Build the menu data
       */

      //Init the login/logout form
      $login_form = $this->User->isLoggedIn();

      // Add default menu options
      $header_nav = array(
      );
      $header_nav[] = array('url' => app::site_url('posts'), 'text' => 'Blog', 'title' => 'Visit our blog.');

      // Init the admin menu
      $admin_nav = NULL;
      // If the user is an admin, let them see the admin options
      if ($this->User->isLoggedIn() && $this->User->isAdmin()) {
        // Init the admin menu
        $admin_nav = array();
        $admin_nav[] = array(
        'url' => app::site_url('pages'), 'text' => 'Pages', 'title' => 'See page administration options.', 'submenu' => array(
          array('url' => app::site_url(array('pages', 'index')), 'text' => 'Manage Pages', 'title' => 'View + edit pages.'),
          array('url' => app::site_url(array('pages', 'add')), 'text' => 'New Page', 'title' => 'Add a new page.'),
        ));
        $admin_nav[] = array(
        'url' => app::site_url(array('posts', 'manage')), 'text' => 'Blog', 'title' => 'See blog administration options.', 'submenu' => array(
          array('url' => app::site_url(array('posts', 'manage')), 'text' => 'Manage Posts', 'title' => 'View + edit posts.'),
          array('url' => app::site_url(array('posts', 'index')), 'text' => 'Visit Blog', 'title' => 'Visit blog as visitor.'),
          array('url' => app::site_url(array('posts', 'add')), 'text' => 'New Post', 'title' => 'Add a new post.')
        ));
        $admin_nav[] = array(
        'url' => app::site_url('users'), 'text' => 'Users', 'title' => 'View + Edit Users.', 'submenu' => array(
          array('url' => app::site_url(array('users', 'index')), 'text' => 'Manage Users', 'title' => 'View + edit users.'),
          array('url' => app::site_url(array('users', 'admins')), 'text' => 'View Administrators', 'title' => 'View + edit administrators.'),
          array('url' => app::site_url(array('users', 'add')), 'text' => 'Add User', 'title' => 'Add a user to our system.')
        ));
      }

      self::setData(array('admin_nav' => $admin_nav, 'login_form' => $login_form, 'header_nav' => $header_nav, 'flash' => ''));
    }
    
  }

}
