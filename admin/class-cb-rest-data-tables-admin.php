<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://briancoords.com
 * @since      1.0.0
 *
 * @package    Cb_Rest_Data_Tables
 * @subpackage Cb_Rest_Data_Tables/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Cb_Rest_Data_Tables
 * @subpackage Cb_Rest_Data_Tables/admin
 * @author     Brian Coords <hello@briancoords.com>
 */
class Cb_Rest_Data_Tables_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Cb_Rest_Data_Tables_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cb_Rest_Data_Tables_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cb-rest-data-tables-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Cb_Rest_Data_Tables_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cb_Rest_Data_Tables_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( 'vuejs', 'https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.4/vue.min.js', array(), $this->version, true );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cb-rest-data-tables-admin.js', array( 'vuejs' ), $this->version, true );
    wp_localize_script( $this->plugin_name, 'cb_rest_tables', array(
			'tables' => get_option('cb-rest-tables')
		)
	);

	}
  
  
  /**
   * Register the administration menu for this plugin into the WordPress Dashboard menu.
   *
   * @since    1.0.0
   */
  public function add_plugin_admin_menu() {

      /*
       * Add a settings page for this plugin to the Settings menu.
       *
       * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
       *
       *        Administration Menus: http://codex.wordpress.org/Administration_Menus
       *
       */
      add_menu_page( 'REST Data Tables', 'REST Data Tables', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page')
      );
  }

  /**
   * Add settings action link to the plugins page.
   *
   * @since    1.0.0
   */
  public function add_action_links( $links ) {
      /*
      *  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
      */
     $settings_link = array(
      '<a href="' . admin_url( 'admin.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
     );
     return array_merge(  $settings_link, $links );

  }

  /**
   * Render the settings page for this plugin.
   *
   * @since    1.0.0
   */
  public function display_plugin_setup_page() {
      include_once( 'partials/cb-rest-data-tables-admin-display.php' );
  }
  
  
  /**
   * Testing Rest API
   *
   * @param array $data Options for the function.
   * @return string|null Post title for the latest, * or null if none.
   */
  function display_in_rest( $data ) {
    $op = json_decode(get_option('cb-rest-tables'));
    if ( empty( $op[$data['id']] ) ) {
      return null;
    }
    return $op[$data['id']];
  }
  
  
  function add_rest_action() {
    register_rest_route( 'cbtables/v1', '/table/(?P<id>\d+)', array(
      'methods' => 'GET',
      'callback' => array($this, 'display_in_rest'),
    ) );
  }
  
}
