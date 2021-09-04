<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       jeremydownes.com
 * @since      1.0.0
 *
 * @package    Cmi_Wp_Native_Chat
 * @subpackage Cmi_Wp_Native_Chat/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Cmi_Wp_Native_Chat
 * @subpackage Cmi_Wp_Native_Chat/includes
 * @author     Jeremy Downes <jeremydownes@hotmail.com>
 */
class Cmi_Wp_Native_Chat_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'cmi-wp-native-chat',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
