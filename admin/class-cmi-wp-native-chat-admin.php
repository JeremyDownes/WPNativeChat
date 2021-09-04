<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       jeremydownes.com
 * @since      1.0.0
 *
 * @package    Cmi_Wp_Native_Chat
 * @subpackage Cmi_Wp_Native_Chat/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Cmi_Wp_Native_Chat
 * @subpackage Cmi_Wp_Native_Chat/admin
 * @author     Jeremy Downes <jeremydownes@hotmail.com>
 */
class Cmi_Wp_Native_Chat_Admin {

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
		 * defined in Cmi_Wp_Native_Chat_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cmi_Wp_Native_Chat_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cmi-wp-native-chat-admin.css', array(), $this->version, 'all' );

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
		 * defined in Cmi_Wp_Native_Chat_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cmi_Wp_Native_Chat_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cmi-wp-native-chat-admin.js', array( 'jquery' ), $this->version, false );

	}

}

// rework this
add_action( 'admin_enqueue_scripts', 'load_wp_media_files' );

function load_wp_media_files( $page ) {
  if( $page == 'settings_page_cmi-wp-native-chat' ) {
    // Enqueue WordPress media scripts
    wp_enqueue_media();
    // Enqueue custom script that will interact with wp.media
    wp_enqueue_script( 'cmi_wp_native_chat_script', plugin_dir_url(__FILE__). 'js/handleMediaLibrary.js' , array('jquery')  );
  }
}

add_action( 'wp_ajax_cmi_wp_native_chat_get_image', 'cmi_wp_native_chat_get_image'   );
function cmi_wp_native_chat_get_image() {
    if(isset($_GET['id']) ){
        $image = wp_get_attachment_image( filter_input( INPUT_GET, 'id', FILTER_VALIDATE_INT ), 'medium', false, array( 'id' => 'cmi_wp_native_chat-preview-image' ) );
        $data = array(
            'image'    => $image,
        );
        wp_send_json_success( $data );
    } else {
        wp_send_json_error();
    }
}

// end reworks



if (file_exists(dirname(__FILE__).'/partials/cmi-wp-native-chat-settings-fields.php')) {
	require_once( dirname(__FILE__).'/partials/cmi-wp-native-chat-settings-fields.php' );
}

function cmi_wp_native_chat_add_settings_page() {
    add_options_page( 'WP Native Chat Settings', 'WP Native Chat', 'manage_options', 'cmi-wp-native-chat', 'cmi_wp_native_chat_render_plugin_settings_page' );

}
add_action( 'admin_menu', 'cmi_wp_native_chat_add_settings_page' );


function cmi_wp_native_chat_render_plugin_settings_page() {
	


  ?>
  <h2>WP Native Chat</h2>
  <form action="options.php" method="post">
      <?php 
      settings_fields( 'cmi_wp_native_chat_plugin_options' );
      do_settings_sections( 'cmi_wp_native_chat_plugin' ); 
      wp_nonce_field( 'a21091[4zd1m2[S#~s9=w', 'chat_settings' );
      ?> 
      <input name="submit" class="button button-primary" type="submit" value="<?php esc_attr_e( 'Save' ); ?>" />

  </form>
  <?php
}


function cmi_wp_native_chat_register_settings() {

    register_setting( 'cmi_wp_native_chat_plugin_options', 'cmi_wp_native_chat_plugin_options', 'cmi_wp_native_chat_plugin_options_validate' );
    add_settings_section( 'cmi_wp_native_chat_settings', 'Plugin Settings', 'cmi_wp_native_chat_plugin_section_text', 'cmi_wp_native_chat_plugin' );

    add_settings_field( 'cmi_wp_native_chat_primary_phone', 'Primary Phone', 'cmi_wp_native_chat_primary_phone', 'cmi_wp_native_chat_plugin', 'cmi_wp_native_chat_settings' );
    add_settings_field( 'cmi_wp_native_chat_primary_email', 'Primary Email', 'cmi_wp_native_chat_primary_email', 'cmi_wp_native_chat_plugin', 'cmi_wp_native_chat_settings' );
    add_settings_field( 'cmi_wp_native_chat_disable_chat', 'Disable Chat', 'cmi_wp_native_chat_disable_chat', 'cmi_wp_native_chat_plugin', 'cmi_wp_native_chat_settings' );

    add_settings_field( 'cmi_wp_native_chat_start_time', 'Time Chat Opens', 'cmi_wp_native_chat_start_time', 'cmi_wp_native_chat_plugin', 'cmi_wp_native_chat_settings' );
    add_settings_field( 'cmi_wp_native_chat_end_time', 'Time Chat Closes', 'cmi_wp_native_chat_end_time', 'cmi_wp_native_chat_plugin', 'cmi_wp_native_chat_settings' );
    add_settings_field( 'cmi_wp_native_chat_timeout', 'Chat Timeout in Minutes', 'cmi_wp_native_chat_timeout', 'cmi_wp_native_chat_plugin', 'cmi_wp_native_chat_settings' );

    add_settings_field( 'cmi_wp_native_chat_position', 'Chat Position', 'cmi_wp_native_chat_position', 'cmi_wp_native_chat_plugin', 'cmi_wp_native_chat_settings' );
    add_settings_field( 'cmi_wp_native_chat_start_image', 'Chat Start Image', 'cmi_wp_native_chat_start_image', 'cmi_wp_native_chat_plugin', 'cmi_wp_native_chat_settings' );
    add_settings_field( 'cmi_wp_native_chat_size', 'Chat Size', 'cmi_wp_native_chat_size', 'cmi_wp_native_chat_plugin', 'cmi_wp_native_chat_settings' );
    add_settings_field( 'cmi_wp_native_chat_start_image_size', 'Chat Start Image Size', 'cmi_wp_native_chat_start_image_size', 'cmi_wp_native_chat_plugin', 'cmi_wp_native_chat_settings' );
    add_settings_field( 'cmi_wp_native_chat_size_mobile', 'Chat Start Mobile Size', 'cmi_wp_native_chat_size_mobile', 'cmi_wp_native_chat_plugin', 'cmi_wp_native_chat_settings' );
    add_settings_field( 'cmi_wp_native_chat_open_msg', 'Open Chat Button Message', 'cmi_wp_native_chat_open_msg', 'cmi_wp_native_chat_plugin', 'cmi_wp_native_chat_settings' );
    add_settings_field( 'cmi_wp_native_chat_init_msg', 'Start Chat Message', 'cmi_wp_native_chat_init_msg', 'cmi_wp_native_chat_plugin', 'cmi_wp_native_chat_settings' );
    add_settings_field( 'cmi_wp_native_chat_active_msg', 'Active Chat Message', 'cmi_wp_native_chat_active_msg', 'cmi_wp_native_chat_plugin', 'cmi_wp_native_chat_settings' );
    add_settings_field( 'cmi_wp_native_chat_timeout_msg', 'Chat Timeout Message', 'cmi_wp_native_chat_timeout_msg', 'cmi_wp_native_chat_plugin', 'cmi_wp_native_chat_settings' );
    add_settings_field( 'cmi_wp_native_chat_ask_email', 'Ask for User Email', 'cmi_wp_native_chat_ask_email', 'cmi_wp_native_chat_plugin', 'cmi_wp_native_chat_settings' );

    add_settings_field( 'cmi_wp_native_chat_bg_color', 'Chat Background Color', 'cmi_wp_native_chat_bg_color', 'cmi_wp_native_chat_plugin', 'cmi_wp_native_chat_settings' );
    add_settings_field( 'cmi_wp_native_chat_border_radius', 'Chat Border Radius', 'cmi_wp_native_chat_border_radius', 'cmi_wp_native_chat_plugin', 'cmi_wp_native_chat_settings' );
    add_settings_field( 'cmi_wp_native_chat_heading_color', 'Headings Color', 'cmi_wp_native_chat_heading_color', 'cmi_wp_native_chat_plugin', 'cmi_wp_native_chat_settings' );
    add_settings_field( 'cmi_wp_native_chat_heading_font', 'Headings Font', 'cmi_wp_native_chat_heading_font', 'cmi_wp_native_chat_plugin', 'cmi_wp_native_chat_settings' );
    add_settings_field( 'cmi_wp_native_chat_heading_size', 'Headings Size', 'cmi_wp_native_chat_heading_size', 'cmi_wp_native_chat_plugin', 'cmi_wp_native_chat_settings' );


    add_settings_field( 'cmi_wp_native_chat_button_bg', 'Button Background Color', 'cmi_wp_native_chat_button_bg', 'cmi_wp_native_chat_plugin', 'cmi_wp_native_chat_settings' );
    add_settings_field( 'cmi_wp_native_chat_button_border', 'Button Border', 'cmi_wp_native_chat_button_border', 'cmi_wp_native_chat_plugin', 'cmi_wp_native_chat_settings' );
    add_settings_field( 'cmi_wp_native_chat_button_border_color', 'Button Border Color', 'cmi_wp_native_chat_button_border_color', 'cmi_wp_native_chat_plugin', 'cmi_wp_native_chat_settings' );
    add_settings_field( 'cmi_wp_native_chat_button_border_radius', 'Button Border Radius', 'cmi_wp_native_chat_button_border_radius', 'cmi_wp_native_chat_plugin', 'cmi_wp_native_chat_settings' );
    add_settings_field( 'cmi_wp_native_chat_button_transition', 'Button Transition', 'cmi_wp_native_chat_button_transition', 'cmi_wp_native_chat_plugin', 'cmi_wp_native_chat_settings' );
    add_settings_field( 'cmi_wp_native_chat_button_transform', 'Button Transform', 'cmi_wp_native_chat_button_transform', 'cmi_wp_native_chat_plugin', 'cmi_wp_native_chat_settings' );
    add_settings_field( 'cmi_wp_native_chat_button_txt_color', 'Button Text Color', 'cmi_wp_native_chat_button_txt_color', 'cmi_wp_native_chat_plugin', 'cmi_wp_native_chat_settings' );
    add_settings_field( 'cmi_wp_native_chat_button_font', 'Button Font', 'cmi_wp_native_chat_button_font', 'cmi_wp_native_chat_plugin', 'cmi_wp_native_chat_settings' );
    add_settings_field( 'cmi_wp_native_chat_button_txt_color_hover', 'Button Text Color on Hover', 'cmi_wp_native_chat_button_txt_color_hover', 'cmi_wp_native_chat_plugin', 'cmi_wp_native_chat_settings' );

add_settings_field( 'cmi_wp_native_chat_button_txt_color', 'Button Text Color', 'cmi_wp_native_chat_button_txt_color', 'cmi_wp_native_chat_plugin', 'cmi_wp_native_chat_settings' );    add_settings_field( 'cmi_wp_native_chat_button_bg_color_hover', 'Button Background Color on Hover', 'cmi_wp_native_chat_button_bg_color_hover', 'cmi_wp_native_chat_plugin', 'cmi_wp_native_chat_settings' );
    add_settings_field( 'cmi_wp_native_chat_button_border_color_hover', 'Button Background Color on Hover', 'cmi_wp_native_chat_button_border_color_hover', 'cmi_wp_native_chat_plugin', 'cmi_wp_native_chat_settings' );

    add_settings_field( 'cmi_wp_native_chat_msg_font', 'Messages Font', 'cmi_wp_native_chat_msg_font', 'cmi_wp_native_chat_plugin', 'cmi_wp_native_chat_settings' );
    add_settings_field( 'cmi_wp_native_chat_admin_msg_bg', 'Admin Message Text Color', 'cmi_wp_native_chat_admin_msg_bg', 'cmi_wp_native_chat_plugin', 'cmi_wp_native_chat_settings' );
    add_settings_field( 'cmi_wp_native_chat_admin_msg_color', 'Admin Message Background Color', 'cmi_wp_native_chat_admin_msg_color', 'cmi_wp_native_chat_plugin', 'cmi_wp_native_chat_settings' );
    add_settings_field( 'cmi_wp_native_chat_user_msg_bg', 'User Message Text Color', 'cmi_wp_native_chat_user_msg_bg', 'cmi_wp_native_chat_plugin', 'cmi_wp_native_chat_settings' );
    add_settings_field( 'cmi_wp_native_chat_user_msg_color', 'User Message Background Color', 'cmi_wp_native_chat_user_msg_color', 'cmi_wp_native_chat_plugin', 'cmi_wp_native_chat_settings' );    

    //add_settings_field( 'cmi_wp_native_chat_add_css', 'Additional CSS', 'cmi_wp_native_chat_add_css', 'cmi_wp_native_chat_plugin', 'cmi_wp_native_chat_settings' );
    
    //hidden fields
    add_settings_field( 'cmi_wp_native_chat_verified_phone', '', 'cmi_wp_native_chat_verified_phone', 'cmi_wp_native_chat_plugin', 'cmi_wp_native_chat_settings' );
    add_settings_field( 'cmi_wp_native_chat_verified_email', '', 'cmi_wp_native_chat_verified_email', 'cmi_wp_native_chat_plugin', 'cmi_wp_native_chat_settings' );
}
add_action( 'admin_init', 'cmi_wp_native_chat_register_settings' );

function cmi_wp_native_chat_plugin_options_validate( $input ) {

	return $input;
    // $newinput['api_key'] = trim( $input['api_key'] );
    // if ( ! preg_match( '/^[a-z0-9]{32}$/i', $newinput['api_key'] ) ) {
    //     $newinput['api_key'] = '';
    // }

    // return $newinput;
}

function cmi_wp_native_chat_plugin_section_text() {
    //echo '<p>Please save after each verification step</p>';
    //var_dump(get_option('cmi_wp_native_chat_plugin_options'));
}

//  update_option( 'cmi_wp_native_chat_plugin_options', []);  // TESTING LINE PLEASE DELETE
