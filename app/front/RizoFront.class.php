<?php
if(!defined('WPINC')){die;}

class RizoFront {

  public function status(){
    echo json_encode([
      'status' => 'good'
    ]);
    exit;
  }

  public function newpost() {
		$permalinks_enabled = get_option('permalink_structure') ? true : false;
    print_r($permalinks_enabled);
		$latest_blog_posts = new WP_Query( array( 'posts_per_page' => 3 ) );
		echo '<pre>';
		print_r($latest_blog_posts->posts);
		echo '</pre>';
    exit;
	}

  public function cekpost() {
		$permalinks_enabled = get_option('permalink_structure') ? true : false;
    print_r($permalinks_enabled);
		$latest_blog_posts = new WP_Query( array( 'posts_per_page' => 3 ) );
		echo '<pre>';
		print_r($latest_blog_posts->posts);
		echo '</pre>';
    exit;
	}


}

?>
