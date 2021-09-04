<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              jeremydownes.com
 * @since             1.0.0
 * @package           Cmi_Wp_Native_Chat
 *
 * @wordpress-plugin
 * Plugin Name:       CMI WP Native Chat
 * Plugin URI:        celsiusmarketing.com
 * Description:       Wordpress Native Chat Solution by Celsius Marketing | Interactive
 * Version:           1.0.0
 * Author:            Jeremy Downes
 * Author URI:        jeremydownes.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cmi-wp-native-chat
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'CMI_WP_NATIVE_CHAT_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-cmi-wp-native-chat-activator.php
 */
function activate_cmi_wp_native_chat() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cmi-wp-native-chat-activator.php';
	Cmi_Wp_Native_Chat_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-cmi-wp-native-chat-deactivator.php
 */
function deactivate_cmi_wp_native_chat() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cmi-wp-native-chat-deactivator.php';
	Cmi_Wp_Native_Chat_Deactivator::deactivate();
}

function uninstall_cmi_wp_native_chat() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cmi-wp-native-chat-uninstaller.php';
	Cmi_Wp_Native_Chat_Uninstaller::uninstall();
}

register_activation_hook( __FILE__, 'activate_cmi_wp_native_chat' );
register_deactivation_hook( __FILE__, 'deactivate_cmi_wp_native_chat' );
register_uninstall_hook(__FILE__, 'uninstall_cmi_wp_native_chat');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-cmi-wp-native-chat.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_cmi_wp_native_chat() {

	$plugin = new Cmi_Wp_Native_Chat();
	$plugin->run();

}
run_cmi_wp_native_chat();
