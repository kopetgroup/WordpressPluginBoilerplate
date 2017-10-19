<?php if(!defined('WPINC')){die;}
/**
 * Dapur Ngebul Present[c]
 *
 *
 * @package   MerlinRabbits
 * @author    Riza Masykur <hanirizo@gmail.com>
 * @license   GPL-2.0+
 * @link      http://ikamai.com
 *
 * @wordpress-plugin
 * Plugin Name:       MerlinRabbits
 * Plugin URI:        http://draft.ikamai.com
 * Description:       wordpress remote poster
 * Version:           1.0
 * Author:            Riza
 * Author URI:        http://ikamai.com
 * Text Domain:       ikamai
 * License:           private
 */



/*
	Do action here
*/
if(isset($_REQUEST['ngapi'])){

	//require_once plugin_dir_path(__FILE__) . 'app/front/RizoPosts.class.php';
	//require_once plugin_dir_path(__FILE__) . 'app/front/RizoFront.class.php';

	//if newpost triggered
	if(isset($_REQUEST['newpost'])){
		//add_action('init', array( 'RizoPosts', 'newpost' ));
	}elseif(isset($_REQUEST['status'])){
		//add_action('init', array( 'RizoFront', 'status' ));
	}
}

/*
	AdminDashboard
*/
if ( is_admin() && ( ! defined('DOING_AJAX') || ! DOING_AJAX) ) {
	include_once plugin_dir_path(__FILE__) . 'app/dashboard/Merlin.class.php';
	include_once plugin_dir_path(__FILE__) . 'app/dashboard/MerlinAdmin.class.php';
	add_action('plugins_loaded', array( 'Merlin_Admin', 'get_instance' ));
}
