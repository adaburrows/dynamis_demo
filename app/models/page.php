<?php
class page extends model {

  public function __construct() {
    $this->aspects = array(
      'pages'
    );
    parent::__construct();
  }

  public function get_by_id($id) {
    $data = array('id' => $id);
    return $this->get_by_($data);
  }

  public function get_by_name($name) {
    $data = array('name'=> $name);
    return $this->get_by_($data);
  }

}
