<?php
class User {

  /*
   * Function logs in user
   */
  public function login($email, $password) {
    $pass = sha1($password);
    //user has attempted to login check for account and account type. 
    $user=db::query_item("SELECT * FROM `users` WHERE `email`='$email' AND `password`='$pass';");
    //if there is an entry in the database then load the info
    if($user){
      $_SESSION['user_id'] = $user['id'];
      if($q = $this->hasAdmin()) {
        if(db::num_results() > 0) {
          $_SESSION['admin'] = true;
        }
      }
      return true;
    } else {
      return false;
    }
  }
  /*
   * Function logs in user by id
   */
  public function login_by_($id) {
    $pass = sha1($password);
    //user has attempted to login check for account and account type.
    $user=db::query_item("SELECT * FROM `users` WHERE `id`='$id';");
    //if there is an entry in the database then load the info
    if($user){
      $_SESSION['user_id'] = $user['id'];
      if($q = $this->hasAdmin()) {
        if(db::num_results() > 0) {
          $_SESSION['admin'] = true;
        }
      }
      return true;
    } else {
      return false;
    }
  }

  /*
   * Checks if a user is logged in, when the session expires they are logged out
   */
  public function isLoggedIn() {
    return isset($_SESSION['user_id']);
  }

  public function getId() {
    $ret = false;
    if ($this->isLoggedIn()){
      $ret = $_SESSION['user_id'];
    }
    return $ret;
  }

  public function getById($id) {
      $user = db::query_item("SELECT * FROM `users` WHERE `id`=$id;");
      return $user;
  }

  public function existsByEmail($email) {
      $user = db::query_item("SELECT * FROM `users` WHERE `email`='$email';");
      if($user) { $user = true; }
      return $user;
  }

  /*
   * Function logs a user out by clearing out the session
   * It redirects to login.php after logout.
   */
  public function logout() {
    if (isset($_SESSION['user_id'])) {
      unset($_SESSION['user_id']);
    }
    if (isset($_SESSION['admin'])) {
      unset($_SESSION['admin']);
    }
    session_unset();
    session_destroy();
  }

  /*
   * Adds a user to the database
   */
  public function insert($email, $password) {
    $pass = sha1($password);
    $status = db::query_ins("INSERT INTO `users` (`email`, `password`, `added`) VALUES ('$email', '$pass', NOW());");
    if($status) {
      $user_id = db::insertId();
      if($user_id != 0) {
      } else {
        $status = false;
      }
    }
    return $status;
  }

  /*
   * Changes a users password
   */
  public function setPassword($user_id, $password) {
    $pass = sha1($password);
    return db::query_ins("UPDATE `users` SET `password` = '$pass' WHERE `id`='$user_id';");
  }

  /*
   * Gets a users email
   */
  public function getEmail($user_id) {
    return db::query_item("SELECT email FROM users WHERE id = '$user_id';");
  }

  /*
   * Changes a users email 
   */
  public function setEmail($user_id, $email) {
    return db::query_ins("UPDATE `users` SET `email` = '$email' WHERE `id`='$user_id';");
  }

  /*
   * Updates a users info
   */
  public function update($user_id, $email="", $password="") {
    $status = false;
    if ($email != "") {
      $status = $this->setEmail($user_id, $email);
    }
    if ($password != "") {
      $status == $this->setPassword($user_id, $password);
    }
    return $status;
  }

  /*
   * Deletes a user from the database
   */
  public function delete($user_id) {
     return db::query_ins("DELETE FROM `users` WHERE `id`='$user_id';");
  }

  /*
   * Returns a user id based on an email address
   */
  public function getByEmail($email) {
    return db::query_item("SELECT `id` FROM `users` WHERE `email`='$email';");
  }

  /*
   * Returns all of the users in the database
   */
  public function getAll() {
    return db::query_array("SELECT id, email, added FROM users ORDER BY id DESC;");
  }

  /*
   * Checks if a user is admin
   */
  public function isAdmin() {
    $ret = false;
    if (isset($_SESSION['admin'])) {
      if($_SESSION['admin']==true) {
        $ret = true;
      }
    }
    return $ret;
  }

  /*
   * Checks if a user is admin
   */
  public function hasAdmin() {
    $q = db::query_item("SELECT `id` FROM `admins` WHERE `id` = {$_SESSION['user_id']};");
    return $q;
  }

  /*
   * Removes admin rights from a user
   */
  public function removeAdminRights($user_id) {
    return db::query_ins("DELETE FROM `admins` WHERE `id`='$user_id';");
  }

  /*
   * Adds admin rights to a user
   */
  public function bestowAdminRights($user_id) {
    return db::query_ins("INSERT INTO `admins` (`id`) VALUES ($user_id);");
  }

  /*
   * Retrieves the list of admins
   */
  public function getAdmins() {
    return db::query_array("SELECT `admins`.`id` AS `id`, `users`.`email` AS `email` FROM `admins` JOIN `users` WHERE `admins`.`id`=`users`.`id`;");
  }

}
