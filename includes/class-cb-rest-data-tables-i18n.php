<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://briancoords.com
 * @since      1.0.0
 *
 * @package    Cb_Rest_Data_Tables
 * @subpackage Cb_Rest_Data_Tables/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Cb_Rest_Data_Tables
 * @subpackage Cb_Rest_Data_Tables/includes
 * @author     Brian Coords <hello@briancoords.com>
 */
class Cb_Rest_Data_Tables_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'cb-rest-data-tables',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
