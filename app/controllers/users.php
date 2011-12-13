<?php

class users extends controller {
  
/**
 * Initialize the class.
 * ==========================================================================
 */
  public function initialize() {
    parent::initialize();
  }

/**
 * Log a user in.
 * ==========================================================================
 */
  public function login() {
    $flash = null;
    // if the user has tried logging in
    if(isset($_POST['login'])){
      // try verifying the user
      if($this->User->login($_POST['username'], $_POST['password'])) {
        session_write_close();
        header("Location: ".app::site_url(array(config::get('default_controller'), 'index')));
        exit(0);
      } else {
        $flash = "That username and/or password is not valid.";
      }
    }
    return array(
      'flash' => $flash,
      'title' => 'Login'
      );
  }

/**
 * Logout a user.
 * ==========================================================================
 */
 public function logout() {
    $this->User->logout();
      header("Location: ".app::site_url(array('users','login')));
    exit(0);

    return array();
  }
  
/**
 * Show the list of users.
 * ==========================================================================
 */
 public function index() {
    if ($this->User->isLoggedIn() && $this->User->isAdmin()) {
      // get all users
      $users = $this->User->getAll();
      // set the title and user data
      $data = array(
        'users' => $users,
        'title'=>'Manage Users'
        );
      foreach($data['users'] as $index => $user) {
        $data['users'][$index]['added'] = date("l, F j, Y", strtotime($user['added']));
      }
      // return the data
      return $data;
    } else {
      header("Location: ".app::site_url(array('users','login')));
      exit(0);      
    }
  }

/**
 * Add a user.
 * ==========================================================================
 */
  public function add() {
    if ($this->User->isLoggedIn() && $this->User->isAdmin()) {
      $flash = null;
      if (isset($_POST['email'])&&isset($_POST['password'])) {
        if ($this->User->insert(
            $_POST['email'],
            $_POST['password']
        )) {
          $flash = "User {$_POST['email']} added.";
        }
      }
      return array(
        'flash'     => $flash,
        'title'     => 'Add user'
      );
    } else {
      header("Location: ".app::site_url(array('users','login')));
      exit(0);
    }
  }

  public function add_default() {
    self::setReqType('text');
    $email = 'user@example.com';
    $password = 'bl4h';
    $this->User->insert($email, $password, NULL);
    echo "User {$email} added.";
    $user_id = $this->User->getByEmail($email);
    if(isset($user_id['id'])) {
      if($this->User->bestowAdminRights($user_id['id'])) {
        $this->User->addAssociate($user_id['id']);
        echo "{$email} added as an admin.";
      }
    }
    return array();
  }

/**
 * Edit a user.
 * ==========================================================================
 */
  public function edit($id) {
    $data = array();
    // verify user has priviledges
    if($this->User->isLoggedIn() && $this->User->isAdmin()) {
      $flash = null;
      
      $user_id = $id;
      $email = $this->User->getEmail($user_id);
      $email = $email['email'];
      
      //if either email or password have been set update them
      if (isset($_POST['email'])||isset($_POST['password'])) {
        if($this->User->update(	$user_id,
          isset($_POST['email']) ? $_POST['email'] : "",
          isset($_POST['password']) ? $_POST['password'] : ""
          ) ) {
        $flash = "User {$_POST['email']} modified.";
          }
      }
      
      // set the view data
      $data = array(
        'user_id'   => $user_id,
        'email'     => $email,
        'flash'     => $flash,
        'title'     => 'Edit User'
        );
    } else {
      header("Location: ".app::site_url(array('users','login')));
      exit(0);
    }
    return $data;
  }

/**
 * Delete a user.
 * ==========================================================================
 */
  public function delete($id) {
    if ($this->User->isLoggedIn() && $this->User->isAdmin()) {
      if ($this->User->delete($id)) {
        $flash = "User deleted.";
      }
    }
    return array('deleted' => true);
  }

/**
 * View a user.
 * ==========================================================================
 */
  public function view($id) {
  }

/**
 * Change a user's password.
 * ==========================================================================
 */
  public function change_password() {
    $flash = null;
    // if the user has tried logging in
    if(isset($_POST['login'])){
      // try verifying the user
      if($this->User->login($_POST['username'], $_POST['old_pass'])) {
        if($_POST['new_pass']==$_POST['new_pass_verify']){
          $this->User->setPassword($User->getId(), $_POST['new_pass']);
          session_write_close();
          header("Location: ".app::site_url(''));
          exit(0);
        } else {
          $flash = "I'm sorry, but the new passwords did not match.";
        }
      } else {
        $flash = "That username and/or password is not valid.";
      }
    }
    return array('flash' => $flash);
  }

/**
 * Reset user's assword and send them a notice.
 * ==========================================================================
 */
  public function forgot_password() {
    $flash = null;
    // if the user has tried logging in
    if(isset($_POST['username'])){
      $email = $_POST['username'];
      $user = $this->User->getByEmail($email);
      $pass = rand(111111, 999999);
      if($this->User->setPassword($user['id'], $pass)) {
        $text = <<<END
Because of a request on our site, your password has been reset.  To change your password, go to /users/change_password
Your username is: {$email}
Your password is: {$pass}
END;
        $email = self::getLib('email');
        $html = $email->text2html($text, email);
        $email->setSender('support');
        $email->setReplyTo('support');
        $email->setRecipients( array($recipient) );
        $email->setSubject("Your password has been reset");
        $email->addMessagePart($text);
        $email->addMessagePart($html, "html");
        $email->send();
        $flash = "An email with your new password has been sent to you. You should receive it shortly.";
      } else {
        $flash = "An error occured.";
      }
    } else {
      $flash = "Please enter a user name.";
    }
    return array('flash'  => $flash);
  }

/**
 * View the Admins.
 * ==========================================================================
 */
  public function admins() {
    $data = array();
    // verify user has priviledges
    if($this->User->isLoggedIn() && $this->User->isAdmin()) {
      $flash = null;
      
      if (isset($_POST['delete_admin'])) {
        if ($this->User->removeAdminRights($_POST['user_id'])) {
          $flash = "Admin user removed";
        }
      }
      
      if (isset($_POST['email'])) {
        $user_id = $this->User->getByEmail($_POST['email']);
        if(isset($user_id['id'])) {
          if($this->User->bestowAdminRights($user_id['id'])) {
            $flash = "{$_POST['email']} added as an admin.";
          }
        }
      }
      
      // fetch admin users
      $users = $this->User->getAdmins();
      
      //set the title
      $data = array(
        'users' => $users,
        'flash' => $flash,
        'title' => 'Manage Admin Users'
        );
      
    } else {
      header("Location: ".app::site_url(array('users','login')));
      exit(0);
    }
    return $data;
  }

}
