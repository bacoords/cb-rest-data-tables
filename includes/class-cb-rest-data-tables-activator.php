<?php

/**
 * Fired during plugin activation
 *
 * @link       http://briancoords.com
 * @since      1.0.0
 *
 * @package    Cb_Rest_Data_Tables
 * @subpackage Cb_Rest_Data_Tables/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Cb_Rest_Data_Tables
 * @subpackage Cb_Rest_Data_Tables/includes
 * @author     Brian Coords <hello@briancoords.com>
 */
class Cb_Rest_Data_Tables_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
    
    add_option('cb-rest-tables', '[{"name":"Table This","headers":[{"name":"title"},{"name":"content"},{"name":"meta_key"}],"rows":[{"0":"test","1":"sample"},{"0":"this","2":"sample"}]},{"name":"Table That","headers":[{"name":"title"},{"name":"content"},{"name":"meta_key"}],"rows":[{"0":"test","2":"sample"},{"1":"this","2":"sample"}]}]');

	}

}
