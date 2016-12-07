<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://briancoords.com
 * @since             1.0.0
 * @package           Cb_Rest_Data_Tables
 *
 * @wordpress-plugin
 * Plugin Name:       CB REST API Data Tables
 * Plugin URI:        http://briancoords.com
 * Description:       Create little tables to output data into the WP REST API
 * Version:           1.0.0
 * Author:            Brian Coords
 * Author URI:        http://briancoords.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cb-rest-data-tables
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-cb-rest-data-tables-activator.php
 */
function activate_cb_rest_data_tables() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cb-rest-data-tables-activator.php';
	Cb_Rest_Data_Tables_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-cb-rest-data-tables-deactivator.php
 */
function deactivate_cb_rest_data_tables() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cb-rest-data-tables-deactivator.php';
	Cb_Rest_Data_Tables_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_cb_rest_data_tables' );
register_deactivation_hook( __FILE__, 'deactivate_cb_rest_data_tables' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-cb-rest-data-tables.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_cb_rest_data_tables() {

	$plugin = new Cb_Rest_Data_Tables();
	$plugin->run();

}
run_cb_rest_data_tables();
