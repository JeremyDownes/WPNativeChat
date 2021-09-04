<?php

/**
 * Fired during plugin deactivation
 *
 * @link       jeremydownes.com
 * @since      1.0.0
 *
 * @package    Cmi_Wp_Native_Chat
 * @subpackage Cmi_Wp_Native_Chat/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Cmi_Wp_Native_Chat
 * @subpackage Cmi_Wp_Native_Chat/includes
 * @author     Jeremy Downes <jeremydownes@hotmail.com>
 */
class Cmi_Wp_Native_Chat_Uninstaller {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function uninstall() {
		$user = get_user_by('login', "CMI_WP_Native_Chat");
		wp_delete_user( $user->ID );

		// need to remove options added to wp_options table
	}

}
