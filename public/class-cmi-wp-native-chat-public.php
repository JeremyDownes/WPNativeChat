<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       jeremydownes.com
 * @since      1.0.0
 *
 * @package    Cmi_Wp_Native_Chat
 * @subpackage Cmi_Wp_Native_Chat/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Cmi_Wp_Native_Chat
 * @subpackage Cmi_Wp_Native_Chat/public
 * @author     Jeremy Downes <jeremydownes@hotmail.com>
 */
class Cmi_Wp_Native_Chat_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->app_pass = '';

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cmi-wp-native-chat-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

  	$options = get_option( 'cmi_wp_native_chat_plugin_options' );
  	$start_time = isset($options['start_time']) && $options['start_time'] != '' ? $options['start_time'] : NULL ;
  	$end_time = isset($options['start_time']) && $options['end_time'] != '' ? $options['end_time'] : NULL ;
  	if( isset($options['phone_verified']) && isset($options['email_verified']) && $options['phone_verified'] == 'verified' && $options['email_verified'] == 'verified' ) {
  		if( $start_time && strtotime(current_time('mysql')) < strtotime($start_time) ) { return; }
  		if( $end_time && strtotime(current_time('mysql')) > strtotime($end_time) ) { return;  }
			$ajax_url = admin_url( 'admin-ajax.php' );
 			$user_id = get_user_by('login', 'CMI_WP_Native_Chat')->ID;
 			wp_register_script( 'cryptography', plugin_dir_url( __FILE__ ) . 'js/crypto.js', array(), $this->version, false );
 			wp_register_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cmi-wp-native-chat-public.js', array( 'jquery' ), $this->version, false );
			wp_enqueue_script( $this->plugin_name);
			wp_enqueue_script( 'cryptography');
			wp_localize_script( $this->plugin_name, 'cmi_wp_native_chat_ajax_object', 
		  	array( 
		  	'rest_uri' => site_url('wp-json/wp/v2/conversation/'),
				'ajax_url' => $ajax_url,
				'chat_timeout' => isset($options['chat_timeout']) ? $options['chat_timeout'] : NULL,
				'start_img' => isset($options['start_image']) ? wp_get_attachment_image( $options['start_image'] , 'medium', false, array( 'id' => $options['start_image'] ) ) : '' ,
				'open_msg' => isset($options['open_msg']) ? $options['open_msg'] : NULL,
				'init_msg' => isset($options['init_msg']) ? $options['init_msg'] : NULL,
				'active_msg' => isset($options['active_msg']) ? $options['active_msg'] : NULL,
				'bg_color' => isset($options['bg_color']) ? $options['bg_color'] : NULL,
				'border_radius' => isset($options['border_radius']) ? $options['border_radius'] : NULL,
				'heading_color' => isset($options['heading_color']) ? $options['heading_color'] : NULL,
				'heading_font' => isset($options['heading_font']) ? $options['heading_font'] : NULL,
				'heading_size' => isset($options['heading_size']) ? $options['heading_size'] : NULL,
				'button_bg' => isset($options['button_bg']) ? $options['button_bg'] : NULL,
				'button_font' => isset($options['button_font']) ? $options['button_font'] : NULL,
				'button_border' => isset($options['button_border']) ? $options['button_border'] : NULL,
				'button_border_color' => isset($options['button_border_color']) ? $options['button_border_color'] : NULL,
				'button_border_radius' => isset($options['button_border_radius']) ? $options['button_border_radius'] : NULL,
				'button_transition' => isset($options['button_transition']) ? $options['button_transition'] : NULL,
				'button_transform' => isset($options['button_transform']) ? $options['button_transform'] : NULL,
				'button_txt_color' => isset($options['button_txt_color']) ? $options['button_txt_color'] : NULL,
				'button_txt_color_hover' => isset($options['button_txt_color_hover']) ? $options['button_txt_color_hover'] : NULL,
				'button_bg_color_hover' => isset($options['button_bg_color_hover']) ? $options['button_bg_color_hover'] : NULL,
				'button_border_color_hover' => isset($options['button_border_color_hover']) ? $options['button_border_color_hover'] : NULL,
				'msg_font' => isset($options['msg_font']) ? $options['msg_font'] : NULL,
				'admin_msg_bg' => isset($options['admin_msg_bg']) ? $options['admin_msg_bg'] : NULL,
				'admin_msg_color' => isset($options['admin_msg_color']) ? $options['admin_msg_color'] : NULL,
				'user_msg_bg' => isset($options['user_msg_bg']) ? $options['user_msg_bg'] : NULL,
				'user_msg_color' => isset($options['user_msg_color']) ? $options['user_msg_color'] : NULL,
				'size' => isset($options['size']) ? $options['size']/100 : NULL,
				'size_mobile' => isset($options['size_mobile']) ? $options['size_mobile']/100 : NULL,
				'start_image_size' => isset($options['start_image_size']) ? $options['start_image_size']/100 : NULL,
				'ask_email' => isset($options['ask_email']) ? true : false,			
			) 
		  );
  	}

	}

}

add_filter( 'template_include', 'cmi_wp_native_chat_template' );

function cmi_wp_native_chat_template( $template ) {
    $post_types = array( 'conversation' );

    if ( is_singular( $post_types ) && file_exists( plugin_dir_path(__FILE__) . 'partials/cmi-wp-native-chat-public-display.php' ) ){
        $template = plugin_dir_path(__FILE__) . 'partials/cmi-wp-native-chat-public-display.php';
    }

    return $template;
}