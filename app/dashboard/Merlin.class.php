<?php
class Merlin {

  const VERSION = '0.0.3';
  protected $plugin_slug = 'MerlinRabbits';
  protected static $instance = null;
  protected $cache_timeout = 60;

  private function __construct() {
    add_action('wp_enqueue_scripts', array( $this, 'enqueue_styles' ));
    add_action('wp_enqueue_scripts', array( $this, 'enqueue_scripts' ));
  }

  public function get_plugin_slug() {
    return $this->plugin_slug;
  }

  public static function get_instance() {
    if ( null == self::$instance ) {
      self::$instance = new self;
    }
    return self::$instance;
  }

}


?>
