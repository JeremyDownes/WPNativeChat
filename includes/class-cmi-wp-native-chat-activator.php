<?php

/**
 * Fired during plugin activation
 *
 * @link       jeremydownes.com
 * @since      1.0.0
 *
 * @package    Cmi_Wp_Native_Chat
 * @subpackage Cmi_Wp_Native_Chat/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Cmi_Wp_Native_Chat
 * @subpackage Cmi_Wp_Native_Chat/includes
 * @author     Jeremy Downes <jeremydownes@hotmail.com>
 */
class Cmi_Wp_Native_Chat_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
    
    add_role( 'cmi-chat-app', 'CMI WP Native Chat User', array(
      'read' => true,
      'edit_conversation' => true,
      'publish_conversation' => true,
    ) );

    wp_insert_user( 
      array(
        'user_pass'    =>  wp_generate_password(),
        'user_login'   => 'CMI_WP_Native_Chat',
        'user_email'   => 'cmi.chat@'.preg_replace('#^https?://#i', '', get_home_url()),
        'role'         => 'cmi-chat-app'
      ) 
    );

	}

}
