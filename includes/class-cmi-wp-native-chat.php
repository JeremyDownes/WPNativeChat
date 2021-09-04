<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       jeremydownes.com
 * @since      1.0.0
 *
 * @package    Cmi_Wp_Native_Chat
 * @subpackage Cmi_Wp_Native_Chat/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Cmi_Wp_Native_Chat
 * @subpackage Cmi_Wp_Native_Chat/includes
 * @author     Jeremy Downes <jeremydownes@hotmail.com>
 */
class Cmi_Wp_Native_Chat {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Cmi_Wp_Native_Chat_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'CMI_WP_NATIVE_CHAT_VERSION' ) ) {
			$this->version = CMI_WP_NATIVE_CHAT_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'cmi-wp-native-chat';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Cmi_Wp_Native_Chat_Loader. Orchestrates the hooks of the plugin.
	 * - Cmi_Wp_Native_Chat_i18n. Defines internationalization functionality.
	 * - Cmi_Wp_Native_Chat_Admin. Defines all hooks for the admin area.
	 * - Cmi_Wp_Native_Chat_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-cmi-wp-native-chat-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-cmi-wp-native-chat-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-cmi-wp-native-chat-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-cmi-wp-native-chat-public.php';


    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-cmi-wp-native-chat-post_types.php';


		$this->loader = new Cmi_Wp_Native_Chat_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Cmi_Wp_Native_Chat_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Cmi_Wp_Native_Chat_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Cmi_Wp_Native_Chat_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		$plugin_post_types = new CMI_WP_Native_Chat_Post_Types();
		$this->loader->add_action( 'init', $plugin_post_types, 'create_custom_post_type', 999 );
		//$this->loader->add_action( 'admin_init', $plugin_admin, 'rerender_meta_options' );
    //$this->loader->add_action( 'save_post', $plugin_admin, 'save_meta_options' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Cmi_Wp_Native_Chat_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Cmi_Wp_Native_Chat_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}


add_action( 'rest_api_init', 'cmi_chat_rest_init' );

function cmi_chat_rest_init() {
	  // Public endpoint used to delete app password. Client GETs w/ UUID on unload
		register_rest_route( 'cmiwpnativechat/v1', '/chat/terminate/', array(
			array(
	    'methods' => 'GET',
	    'callback' => 'cmi_chat_terminate',
    	'permission_callback' => '__return_true'
			),
			array(
	    'methods' => 'POST',
	    'callback' => 'cmi_chat_terminate',
    	'permission_callback' => '__return_true'				
			)
	  ) );
	  // Public endpoint used to generate app password. 
		register_rest_route( 'cmiwpnativechat/v1', '/chat/generate/', array(
	    'methods' => 'GET',
	    'callback' => 'cmi_chat_generate',
	    'permission_callback' => '__return_true'
	  ) );
    // Meta Fields to add to the API
    $meta_fields = array(
       // 'enc_key',
    );
    // Loop all fields and register each of them to the API
    foreach ($meta_fields as $field) {
        register_rest_field( 'conversation',
            $field,
            array(
                'get_callback'    => function ($params) use ($field) {
                    return get_post_meta($params['id'], $field);
                },
                'update_callback' => function ($value, $object, $fieldName){
                    return add_post_meta($object->ID, $fieldName, $value);
                },
                'schema' => null
            )
        );
    }
}

// Deletes application password after 10 min if never used
// Deletes application password after 24hr inactivity
// This function is intended to handle edge case unloads. Most password are deleted via API
 add_action('init','cmi_chat_delete_expired_chat');

 function cmi_chat_delete_expired_chat() {

 	$user_id = get_user_by('login', 'CMI_WP_Native_Chat')->ID;
 	$passwords = WP_Application_Passwords::get_user_application_passwords($user_id);

 	foreach ($passwords as $key => $password) {
 		if($password['last_used'] && $password['last_used']<current_time('timestamp', true) - 86400)	{ // 86400 = 24hr since a message was posted
 			WP_Application_Passwords::delete_application_password( $user_id, $password['uuid'] );
 		}
 		if($password['last_used']==NULL) { 
 			if ($password['created']<current_time('timestamp', true)-600)	{
 				WP_Application_Passwords::delete_application_password( $user_id, $password['uuid'] );
 			}	
 		}
 	}
 }

// Removes the app password if it exists for the plugin user. Triggered on client unload
function cmi_chat_terminate() {
	if (isset($_GET['uuid'])) {
		$uuid = $_GET['uuid'];
	}
	if (isset($_POST['uuid'])) {
		$uuid = $_POST['uuid'];
	}
	if (isset($_GET['id'])) {
		$id = intval ($_GET['id']);
	}
	if (isset($_POST['id'])) {
		$id = intval ($_POST['id']);
	}	
 	$user_id = get_user_by('login', 'CMI_WP_Native_Chat')->ID;
 	if(get_post_type($id)=='conversation') {
 		add_post_meta($id, 'chat_closed', 'Chat closed by user. '.current_time('mysql'));
 		wp_update_post( array('ID'=>$id,'post_status'=> 'private') );
 	}
 	$passwords = WP_Application_Passwords::get_user_application_passwords($user_id);
	foreach ($passwords as $key => $password) {
		if($password['uuid'] == $uuid)	{
			WP_Application_Passwords::delete_application_password( $user_id, $password['uuid'] );
		}
	}
	wp_die();
}

function cmi_chat_generate() {

	if (isset($_GET['key'])) {
 		$user_id = get_user_by('login', 'CMI_WP_Native_Chat')->ID;
 		$name = time();
		$app_pass = WP_Application_Passwords::create_new_application_password( $user_id, array( 'name' => $name ) );
		$return = array(
		    'app_pass'  => $app_pass[0],
		    'uuid' => $app_pass[1]['uuid']
		);

		wp_send_json($return);
	}
	wp_die();
}

// add_filter( 'post_row_actions', 'cmi_chat_remove_row_actions', 10, 2 );
// function cmi_chat_remove_row_actions( $actions, $post )
// {
//   global $current_screen;
//     if( $current_screen->post_type != 'conversation' ) return $actions;
//     unset( $actions['inline hide-if-no-js'] );
//     //$actions['inline hide-if-no-js'] .= __( 'Quick&nbsp;Edit' );

//     return $actions;
// }


add_action('publish_conversation', 'cmi_chat_mail_primary'); 

function cmi_chat_mail_primary ($post_id) {
	$post = get_post($post_id);
	if ( $post->post_date == $post->post_modified )  {  //POST JUST GOT PUBLISHED

		$content = get_the_content($post_id);
		$split = explode('CMICHATKEY', $content);
		if(isset($_POST['key'])) { update_post_meta($post_id, 'key', $_POST['key']); }
		if(isset($_POST['email'])) { update_post_meta($post_id, 'email', $_POST['email']); }
	  $headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: cmi.chat@'.preg_replace('#^https?://#i', '', get_home_url()) . "\r\n";
		$link = get_permalink($post_id);
		$message = '
			<html>
				<a href="'.$link.'">Click here to respond</a>
			</html>
		';
	  $options = get_option( 'cmi_wp_native_chat_plugin_options' );
	  $primary_phone = array_key_exists('primary_phone', $options) ? esc_attr( $options['primary_phone'] ) : '';

	  $primary_email = array_key_exists('primary_email', $options) ? esc_attr( $options['primary_email'] ) : '';
		mail($primary_email, 'New Chat Request', $message, $headers);
		mail($primary_phone, 'New Chat Request', $link);

  }
}

add_action( 'wp_ajax_cmi_chat_primary_verification', 'cmi_chat_verify_primary' );
 
function cmi_chat_verify_primary() {
 	
		//if ( empty($_POST['chat_settings']) || ! wp_verify_nonce( $_POST['chat_settings'], 'a21091[4zd1m2[S#~s9=w' ) ) return;  


    if (isset($_POST['phone'])) {
         $phone = $_POST['phone'];
         
      mail($phone.'@txt.att.net', '', $_SERVER['SERVER_NAME'].'/wp-admin/options-general.php?page=cmi-wp-native-chat&network='.$phone.'%40txt.att.net');
      mail($phone.'@tmomail.net', '', $_SERVER['SERVER_NAME'].'/wp-admin/options-general.php?page=cmi-wp-native-chat&network='.$phone.'%40tmomail.net');
      mail($phone.'@messaging.sprintpcs.com', '', $_SERVER['SERVER_NAME'].'/wp-admin/options-general.php?page=cmi-wp-native-chat&network='.$phone.'%40messaging.sprintpcs.com');
      mail($phone.'@vtext.com', '', $_SERVER['SERVER_NAME'].'/wp-admin/options-general.php?page=cmi-wp-native-chat&network='.$phone.'%40vtext.com');
      mail($phone.'@vzwpix.com', '', $_SERVER['SERVER_NAME'].'/wp-admin/options-general.php?page=cmi-wp-native-chat&network='.$phone.'%40vzwpix.com');
      mail($phone.'@vmobl.com', '', $_SERVER['SERVER_NAME'].'/wp-admin/options-general.php?page=cmi-wp-native-chat&network='.$phone.'%40vmobl.com');
    }


    if (isset($_POST['email'])) {
      $email = $_POST['email'];
      $headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$link = $_SERVER['SERVER_NAME'].'/wp-admin/options-general.php?page=cmi-wp-native-chat&email='.$email;
			$message = '
				<html>
					<a href="'.$link.'">Click here to verify</a>

				</html>
			';
	    mail($email, '', $message, $headers );
		}
    // Don't forget to stop execution afterward.
    wp_die();
}


