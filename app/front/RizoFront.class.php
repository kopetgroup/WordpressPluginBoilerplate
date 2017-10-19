<?php
if(!defined('WPINC')){die;}

class RizoFront {

  public function status(){
    echo json_encode([
      'status' => 'good'
    ]);
    exit;
  }



}

?>
