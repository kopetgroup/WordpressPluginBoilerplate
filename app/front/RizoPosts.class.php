<?php
if(!defined('WPINC')){die;}

class RizoPosts {

  public function newpost() {

    $rs = shell_exec('curl -sS -XGET "http://munyuk-kejepit.herokuapp.com/?run=1&q='.$_GET['q'].'&cat=decor&apicolor=color&apitype=photo"');
    $rs = json_decode($rs);

    $title = $rs->title;
    $description = '';
    $cat = 'interior,decor';
    $tags = 'modern,faucet,decor,ideas';
    $date = date('Y-m-d H:i:s');

    /*
      Create new post
    */
    $post = array(
      'post_title'	      => $title,
      'post_content'      => $description,
      'post_category'	    => $cat,
      'post_date'         => $date,
      'post_date_gmt'     => $date,
      'post_modified'     => $date,
      'post_modified_gmt' => $date,
      'tags_input'	      => $tags,
      'post_status'	      => 'publish',
      'post_type'		      => 'post'
    );
    $r = wp_insert_post($post);

    $arr = $rs->attachment;
    $i = 0;
    foreach($arr as $a){
      echo $i.' -- '.$a->src.'<br/>';
      //$src = str_replace('http://','http://i0.wp.com/',$a->src);
      //$src = str_replace('https://','https://i0.wp.com/',$src);
      $src = $a->src;
      $t = RizoPosts::ngattachment(
        $src,
        $r,
        $a->title,
        date('Y-m-d H:i:s')
      );
      //print_r($t);
    $i++;}

    //must exit after
    exit;
	}

  public function ngattachment($url,$parent,$title='',$date){

    //cek image eror pora
  	$http = new WP_Http();
    $response = $http->request( $url );
    if( $response['response']['code'] != 200 ) {
      $e = 'gambar raiso didonlot';
  	}
    //upload ning wp
  	$upload = wp_upload_bits( basename($url), null, $response['body'] );
    	if( !empty( $upload['error'] ) ) {
        $e .= 'gambar raiso diaplod';
    }

    //gilingan image
  	$file_path = $upload['file'];
  	$file_name = basename( $file_path );
  	$file_type = wp_check_filetype( $file_name, null );
  	$attachment_title = sanitize_file_name( pathinfo( $file_name, PATHINFO_FILENAME ) );
  	$wp_upload_dir = wp_upload_dir();
    if($title==''){
      $title = $attachment_title;
    }
  	$post_info = array(
      'post_title'        => $title,
      'post_date'         => $date,
      'post_date_gmt'     => $date,
      'post_modified'     => $date,
      'post_modified_gmt' => $date,
      'tags_input'	      => $tags,
  		'guid'				      => $wp_upload_dir['url'] . '/' . $file_name,
  		'post_mime_type'	  => $file_type['type'],
  		'post_content'		  => '',
  		'post_status'		    => 'inherit',
  	);

  	// Create the attachment
  	$attach_id = wp_insert_attachment( $post_info, $file_path, $parent );

  	// Include image.php
  	require_once( ABSPATH . 'wp-admin/includes/image.php' );

  	// Define attachment metadata
  	$attach_data = wp_generate_attachment_metadata( $attach_id, $file_path );

  	// Assign metadata to attachment
    return wp_update_attachment_metadata( $attach_id, $attach_data );

  }
}

?>
