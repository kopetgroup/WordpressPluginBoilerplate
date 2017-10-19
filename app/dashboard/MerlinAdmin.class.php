<?php
class Merlin_Admin {
  protected static $instance = null;
  protected $ngehook = null;

  private function __construct() {
    $plugin = Merlin::get_instance();
    $this->plugin_slug = $plugin->get_plugin_slug();
    add_action('admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ));
    add_action('admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ));
    add_action('admin_menu', array( $this, 'add_plugin_admin_menu' ));
  }

  public static function get_instance() {
    if ( null === self::$instance ) {
      self::$instance = new self;
    }
    return self::$instance;
  }

  public function enqueue_admin_styles() {
    $screen = get_current_screen();
    if ( $this->ngehook == $screen->id ) {
      wp_enqueue_style(
        $this->plugin_slug . '-admin-styles',
        plugins_url($this->plugin_slug . '/assets/css/init.css'),
        array(),
        ''
      );
    }
  }

  public function enqueue_admin_scripts() {
    $screen = get_current_screen();
    if ( $this->ngehook == $screen->id ) {
      wp_enqueue_script($this->plugin_slug . '-admin-script', plugins_url($this->plugin_slug.'/assets/js/init.js'), array( 'jquery' ),'');
    }
  }

  public function add_plugin_admin_menu() {
    $this->ngehook = add_menu_page(
      __('Merlin Rabbits', $this->plugin_slug),
      __('Merlin Rabbits', $this->plugin_slug),
      'edit_plugins',
      $this->plugin_slug,
      array( $this, 'display_plugin_admin_page' ),
      'dashicons-shield',
      1
    );
  }

  public function display_plugin_admin_page(){
    echo '<h1 class="dashicons-before dashicons-smiley">MerlinRabbits v1.0</h1>';
    echo '<img src="'.plugins_url($this->plugin_slug.'/assets/img/logo.png').'" width="200">';
  }
}
?>
