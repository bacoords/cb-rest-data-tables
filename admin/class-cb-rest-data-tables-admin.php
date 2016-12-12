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
	public function enqueue_styles($hook) {

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
    
    global $post;
    
    if($hook == 'post.php' || $hook == 'post-new.php') {
      if('rest_table' === $post->post_type){
        wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cb-rest-data-tables-admin.css', array(), $this->version, 'all' );
      }
    }    
		

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts($hook) {

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
    
    global $post;
    
    if($hook == 'post.php' || $hook == 'post-new.php') {
      if('rest_table' === $post->post_type){
        
        wp_enqueue_script( 'vuejs', plugin_dir_url( __FILE__ ) . 'js/vue.min.js', array(), $this->version, true );
        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cb-rest-data-tables-admin.js', array( 'vuejs' ), $this->version, true );     
        
      }
    }

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
   * Register a custom post type called "tables".
   *
   * @see get_post_type_labels() for label keys.
   */
  public function register_tables_post_type() {
    $labels = array(
        'name'                  => _x( 'Tables', 'Post type general name', 'textdomain' ),
        'singular_name'         => _x( 'Table', 'Post type singular name', 'textdomain' ),
        'menu_name'             => _x( 'Tables', 'Admin Menu text', 'textdomain' ),
        'name_admin_bar'        => _x( 'Table', 'Add New on Toolbar', 'textdomain' ),
        'add_new'               => __( 'Add New', 'textdomain' ),
        'add_new_item'          => __( 'Add New Table', 'textdomain' ),
        'new_item'              => __( 'New Table', 'textdomain' ),
        'edit_item'             => __( 'Edit Table', 'textdomain' ),
        'view_item'             => __( 'View Table', 'textdomain' ),
        'all_items'             => __( 'All Tables', 'textdomain' ),
        'search_items'          => __( 'Search Tables', 'textdomain' ),
        'parent_item_colon'     => __( 'Parent Tables:', 'textdomain' ),
        'not_found'             => __( 'No Tables found.', 'textdomain' ),
        'not_found_in_trash'    => __( 'No Tables found in Trash.', 'textdomain' ),
        'featured_image'        => _x( 'Table Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'archives'              => _x( 'Table archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
        'insert_into_item'      => _x( 'Insert into Table', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this Table', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
        'filter_items_list'     => _x( 'Filter Tables list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
        'items_list_navigation' => _x( 'Tables list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
        'items_list'            => _x( 'Tables list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
    );
 
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'table' ),
        'capability_type'    => 'post',
        'capabilities'       => array(     
          'edit_post'          => 'update_core',
          'read_post'          => 'update_core',
          'delete_post'        => 'update_core',
          'edit_posts'         => 'update_core',
          'edit_others_posts'  => 'update_core',
          'delete_posts'       => 'update_core',
          'publish_posts'      => 'update_core',
          'read_private_posts' => 'update_core'),
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'show_in_rest'       => true,
        'rest_base'          => 'tables',
        'supports'           => array( 'title' ),
    );
 
    register_post_type( 'rest_table', $args );
  }
 
  
  /**
   * DeRegister Autosave script (for now)
   *
   * @param $pagehook
   */
  public function remove_autosave_script( $pagehook ) {
    
    global $post_type, $current_screen;
    
    if( $post_type == 'rest_table' )
    wp_deregister_script( 'autosave' );  
    
  } 
  
  /**
   * Set Default Meta Value for new posts
   *
   * @param $post_ID
   */
  public function set_default_meta_new_post($post_ID){
    
    $current_field_value = get_post_meta($post_ID, '_cb_rest_table', true); //change YOUMETAKEY to a default 
    
    $default_meta = '[{"headers":[{"name":"Sample Header"}],"rows":[{"Sample Header":"sample content"}]}]'; 

    if ($current_field_value == '' && !wp_is_post_revision($post_ID)){
        add_post_meta($post_ID,'_cb_rest_table',$default_meta,true);
    }
    
    return $post_ID;
  }
  
  
  /**
   * Add Meta Box
   */
  public function add_tables_meta_box() {
    
    add_meta_box('cb_rest_table', 'Table', array($this, 'display_tables_meta_box'), 'rest_table' );


  }
  
  
  /**
   * Display Meta Box
   *
   * @param $post 
   */
  public function display_tables_meta_box($post) {
    
    include_once( 'partials/cb-rest-data-tables-meta-display.php' );
    
  }
  
  /**
   * Save Metabox 
   *
   * @param $post_id
   */
  public function save_tables_meta_box( $post_id ) {
    
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
      return;
    }
    
    if( !isset( $_POST['cb_rest_tables_nonce'] ) || !wp_verify_nonce( $_POST['cb_rest_tables_nonce'], 'cb_rest_tables_nonce' ) ) {
      return;
    }
    
    update_post_meta( $post_id, '_cb_rest_table', $_POST['_cb_rest_tables_hidden'] );
    
  }
  
  
  /**
   * Get Meta for REST API
   */
  public function register_meta_helper( $object, $field_name, $request ) {
  
    $meta = get_post_meta( $object[ 'id' ], $field_name );
    
    return json_decode( $meta[0] );
    
  } 
  
  
  /**
   * Get Alternate Meta for REST API
   */
//  public function register_meta_alt_helper( $object, $field_name, $request ) {
//  
//    $meta = get_post_meta( $object[ 'id' ], '_cb_rest_table' );
//    
//    $return = [];
//    
//    foreach($meta[0]['rows'] as $row){
//      
//      foreach($meta[0]['headers'] as $header){
//        
//        //$return[];
//        
//      }
//      
//    }
//    
//    
//    return json_decode( $return );
//    
//  } 
  
  
  /**
   * Get Meta for REST API
   */
  public function register_meta_api() {

    register_api_field( 'rest_table',
      '_cb_rest_table',
      array(
         'get_callback'    => array( $this, 'register_meta_helper'),
         'update_callback' => null,
         'schema'          => null,
      )
    ); 

//    register_api_field( 'rest_table',
//      '_cb_rest_table_alt',
//      array(
//         'get_callback'    => array( $this, 'register_meta_alt_helper'),
//         'update_callback' => null,
//         'schema'          => null,
//      )
//    ); 
    
  } 

}
