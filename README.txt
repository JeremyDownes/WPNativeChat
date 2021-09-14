=== Plugin Name ===
Contributors: @jeremydownes
Donate link: jeremydownes.com
Tags: chat
Requires at least: 5.6
Tested up to: 5.8   
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

End to end encrypted chat using no external service

== Description ==

This plugin will install a chat interface on a Wordpress website. Once configured it will send a notification to the email address
and sms destination (if provided) that have been configured within the plugin settings. The chat representative who recieves this 
notification would then click on the link provided to access the chat administration interface and respond directly to the user.

All communications that happen within the chats are encrypted before transmission, stored within the database in their encrypted state,
and decrypted with a single use key that is generated for each chat session. This plugin will create a CMI_WP_Native_Chat user on 
activation, and makes use of the applications passwords api to generate a key for each chat to allow for interaction with the chat post
and related endpoints. As such this plugin requires at least Wordpress v5.6 to function. Application passwords are self-destructive 
and garbage collected for security.

There are a number of additional configuration options provided within the settings that allow for customization of appearance and 
behavior of the chat feature. The text message feature is configured to work with most devices on the major USA carriers. Additional
carriers may be added by adding the necessary values to /includes/class-cmi-wp-native-chat.php:392 and 
/admin/partials/cmi-wp-native-chat-settings-fields.php:528

This product is intended to be used by relatively small organizations where light usage is expected. It is possible to administer two
or more chat converstions simultaneously, but this plugin was not designed for and has not been tested to handle larger volumes of use.

This product is offered as freeware, as such the author(s) provide no guarantees expressed or implied of it's usefullness, stabiliy,
or effectiveness, and will accept no liability for loss of data or revenue through it's use. Usa at your own risk.

This project is seeking contributers. If you feel that you have a feature or fix that you'd like to implement submit your PRs to
https://github.com/JeremyDownes/WPNativeChat or contact jeremydownes@hotmail.com

== Installation ==


1. Upload `cmi-wp-native-chat.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Click WP Native Chat in the settings section
4. Enter the email address that will receive chat notifications in the Primary Email field and click Verify
5. Check your email. Clicking the link within the email will take you back to the settings page and verify your email address
6. Save your settings. This is all that is required for the chat to appear on the site, but setting up a couple other things is recommended
7. Verify a phone number using the same method as email. It helps to be logged into the website on your mobile device before validation
    Save your settings before continuing.
8. Set a chat start and end time. This will cause the chat to display only during these hours.
9. Customize the colors and messaging to suit your needs. Remember to save your settings.


== Frequently Asked Questions ==
= Why doesn't the chat work =

The chat will not initiate from a logged in browser. Open a different browser or private tab to test functionality

= Why do I see a blank screen when responding to chats =

You likely are not logged in to the site on your device. It's probably a good idea to check Keep Me Signed In when you log into Wordpress
from the device you intend to use to administer chat requests.

== Screenshots ==


== Changelog ==

= 1.0 =
* Intial offering

== Upgrade Notice ==

= 1.0 =