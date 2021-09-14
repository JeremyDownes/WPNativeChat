<?php

//logo busted
function cmi_wp_native_chat_start_image() {
  $image = get_custom_logo();
  $options = get_option( 'cmi_wp_native_chat_plugin_options' );

  if ( isset($options['start_image']) ) {
    if ( $options['start_image'] != "" ) { 
      $start_image =   esc_attr( $options['start_image'] ); 
    // Change with the image size you want to use
      $image = wp_get_attachment_image( $options['start_image'] , 'medium', false, array( 'id' => $options['start_image'] ) );
    } else {
    // Some default image
    }
  } else {
    $start_image =   esc_attr( get_theme_mod( 'custom_logo' ) ); 
    $image =  get_custom_logo();
  }


  //echo "<input id='cmi_wp_native_chat_start_image' name='cmi_wp_native_chat_plugin_options[start_image]' type='text' value='" . $start_image . "' />";
  ?>
      <input type="hidden"  name='cmi_wp_native_chat_plugin_options[start_image]' id="cmi_wp_native_chat_image_id" value="<?php echo esc_attr( $start_image ); ?>" class="regular-text" />
      <?php echo wp_kses_post($image); ?><input type='button' value="<?php esc_attr_e( 'Select an image', 'mytextdomain' ); ?>" id="cmi_wp_native_chat_media_manager"/><br><br>
<?php
}

// function cmi_wp_native_chat_add_css() {
// 	$add_css = '';
//   $options = get_option( 'cmi_wp_native_chat_plugin_options' );

//   if ( isset($options['add_css']) ) {
//   	if ( $options['add_css'] != '' ) { $add_css = 	esc_attr( $options['add_css'] ); }


//   } 
//   echo "<input id='cmi_wp_native_chat_add_css' name='cmi_wp_native_chat_plugin_options[add_css]' type='text' value='" . esc_attr($add_css) . "' />";
// }

function cmi_wp_native_chat_bg_color() {

  $bg_color = '#009FEE';
  $options = get_option( 'cmi_wp_native_chat_plugin_options' );

  if ( isset($options['bg_color']) ) {
    if ( $options['bg_color'] != '' ) { $bg_color =   esc_attr( $options['bg_color'] ); }
  } 

  echo "<input id='cmi_wp_native_chat_bg_color' name='cmi_wp_native_chat_plugin_options[bg_color]' type='color' value='" . esc_attr($bg_color) . "' />";
}

function cmi_wp_native_chat_border_radius() {

  $border_radius = '.5rem';
  $options = get_option( 'cmi_wp_native_chat_plugin_options' );

  if ( isset($options['border_radius']) ) {
    if ( $options['border_radius'] != '' ) { $border_radius =   esc_attr( $options['border_radius'] ); }
  } 
  echo "<input id='cmi_wp_native_chat_border_radius' name='cmi_wp_native_chat_plugin_options[border_radius]' type='text' value='" . esc_attr($border_radius) . "' />";
}

function cmi_wp_native_chat_disable_chat() {
  $disable_chat = '';
  $options = get_option( 'cmi_wp_native_chat_plugin_options' );

  if ( isset($options['disable_chat']) ) {
    if ( $options['disable_chat'] == 'checked' ) { $disable_chat =   'checked'; }
  } 
  echo "<input id='cmi_wp_native_disable_chat' name='cmi_wp_native_chat_plugin_options[disable_chat]' type='checkbox' value='checked' ".esc_attr($disable_chat)."/>";
}

function cmi_wp_native_chat_end_time() {
	$end_time = '';
  $options = get_option( 'cmi_wp_native_chat_plugin_options' );

  if ( isset($options['end_time']) ) {
  	if ( $options['end_time'] != '' ) { $end_time = 	esc_attr( $options['end_time'] ); }
  } 
  echo "<input id='cmi_wp_native_chat_end_time' name='cmi_wp_native_chat_plugin_options[end_time]' type='time' value='" . esc_attr($end_time) . "' />";
}


function cmi_wp_native_chat_size() {
  $size = 100;
  $options = get_option( 'cmi_wp_native_chat_plugin_options' );

  if ( isset($options['size']) ) {
    if ( $options['size'] != '' ) { $size =   esc_attr( $options['size'] ); }
  } 
  echo "<input id='cmi_wp_native_chat_size' name='cmi_wp_native_chat_plugin_options[size]' type='range' min='50' max='100' value='" . esc_attr($size) . "' />";
}

function cmi_wp_native_chat_size_mobile() {
  $size_mobile = 100;
  $options = get_option( 'cmi_wp_native_chat_plugin_options' );

  if ( isset($options['size_mobile']) ) {
    if ( $options['size_mobile'] != '' ) { $size_mobile =   esc_attr( $options['size_mobile'] ); }
  } 
  echo "<input id='cmi_wp_native_chat_size_mobile' name='cmi_wp_native_chat_plugin_options[size_mobile]' type='range' min='50' max='100' value='" . esc_attr($size_mobile) . "' />";
}


function cmi_wp_native_chat_start_image_size() {
  $start_image_size = 100;
  $options = get_option( 'cmi_wp_native_chat_plugin_options' );

  if ( isset($options['start_image_size']) ) {
    if ( $options['start_image_size'] != '' ) { $start_image_size =   esc_attr( $options['start_image_size'] ); }
  } 
  echo "<input id='cmi_wp_native_chat_start_image_size' name='cmi_wp_native_chat_plugin_options[start_image_size]' type='range' min='1' max='100' value='" . esc_attr($start_image_size) . "' />";
}

function cmi_wp_native_chat_start_time() {
	$start_time = '';
  $options = get_option( 'cmi_wp_native_chat_plugin_options' );

  if ( isset($options['start_time']) ) {
  	if ( $options['start_time'] != '' ) { $start_time = 	esc_attr( $options['start_time'] ); }
  } 
  echo "<input id='cmi_wp_native_chat_start_time' name='cmi_wp_native_chat_plugin_options[start_time]' type='time' value='" . esc_attr($start_time) . "' />";
}


function cmi_wp_native_chat_timeout() {
  $timeout = '5';
  $options = get_option( 'cmi_wp_native_chat_plugin_options' );

  if ( isset($options['timeout']) ) {
    if ( $options['timeout'] != '' ) { $timeout =   esc_attr( $options['timeout'] ); }
  } 
  echo "<input id='cmi_wp_native_chat_timeout' name='cmi_wp_native_chat_plugin_options[chat_timeout]' type='number' value='" . esc_attr($timeout) . "' />";
}


function cmi_wp_native_chat_position() {
  $position = 'Bottom Right';
  $options = get_option( 'cmi_wp_native_chat_plugin_options' );
  $tl=$tc=$tr=$bl=$bc=$br=$cl=$cr=0;

  if ( isset($options['position']) ) {
    if ( $options['position'] != '' ) { $position =   esc_attr( $options['position'] ); }
  }
  switch ($position) {
    case 'Top Left':
      $tl = 'checked';
      break;
    case 'Top Center':
      $tc = 'checked';
      break;
    case 'Top Right':
      $tr = 'checked';
      break;
    case 'Bottom Left':
      $bl = 'checked';
      break;
    case 'Bottom Center':
      $bc = 'checked';
      break;
    case 'Bottom Right':
      $br = 'checked';
      break;
    case 'Center Left':
      $cl = 'checked';
      break;
    case 'Center Right':
      $cr = 'checked';
      break;
    default:
      $br = 'checked';
      break;

  } 
  ?>
  <div id='cmi-wp-native-chat-position-container'>
    <div>
      <input type="radio" id="cmi-wp-native-chat-position" name="cmi_wp_native_chat_plugin_options[position]" <?php echo $tl; ?> value="Top Left">
      <label for="cmi-wp-native-chat-position">Top Left</label>
    </div><div>
      <input type="radio" id="cmi-wp-native-chat-position" name="cmi_wp_native_chat_plugin_options[position]" <?php echo $tc; ?> value="Top Center">
      <label for="cmi-wp-native-chat-position">Top Center</label>
    </div><div>
      <input type="radio" id="cmi-wp-native-chat-position" name="cmi_wp_native_chat_plugin_options[position]" <?php echo $tr; ?> value="Top Right">
      <label for="cmi-wp-native-chat-position">Top Right</label>
    </div><div>
      <input type="radio" id="cmi-wp-native-chat-position" name="cmi_wp_native_chat_plugin_options[position]" <?php echo $cl; ?> value="Center Left">
      <label for="cmi-wp-native-chat-position">Center Left</label>
    </div><div></div><div>
      <input type="radio" id="cmi-wp-native-chat-position" name="cmi_wp_native_chat_plugin_options[position]" <?php echo $cr; ?> value="Center Right">
      <label for="cmi-wp-native-chat-position">Center Right</label>
    </div><div>
      <input type="radio" id="cmi-wp-native-chat-position" name="cmi_wp_native_chat_plugin_options[position]" <?php echo $bl; ?> value="Bottom Left">
      <label for="cmi-wp-native-chat-position">Bottom Left</label>
    </div><div>
      <input type="radio" id="cmi-wp-native-chat-position" name="cmi_wp_native_chat_plugin_options[position]" <?php echo $bc; ?> value="Bottom Center">
      <label for="cmi-wp-native-chat-position">Bottom Center</label>
    </div><div>
      <input type="radio" id="cmi-wp-native-chat-position" name="cmi_wp_native_chat_plugin_options[position]" <?php echo $br; ?> value="Bottom Right">
      <label for="cmi-wp-native-chat-position">Botton Right</label>
    </div>
  </div>
  
<?php
}


function cmi_wp_native_chat_open_msg() {
  $open_msg = 'Chat with us!';
  $options = get_option( 'cmi_wp_native_chat_plugin_options' );

  if ( isset($options['open_msg']) ) {
    if ( $options['open_msg'] != '' ) { $open_msg =   esc_attr( $options['open_msg'] ); }


  } 
  echo "<input id='cmi_wp_native_chat_open_msg' name='cmi_wp_native_chat_plugin_options[open_msg]' type='text' value='" . esc_attr($open_msg) . "' />";
}



function cmi_wp_native_chat_init_msg() {

  $init_msg = 'Start a Chat';
  $options = get_option( 'cmi_wp_native_chat_plugin_options' );

  if ( isset($options['init_msg']) ) {
  	if ( $options['init_msg'] != '' ) { $init_msg = 	esc_attr( $options['init_msg'] ); }


  } 
  echo "<input id='cmi_wp_native_chat_init_msg' name='cmi_wp_native_chat_plugin_options[init_msg]' type='text' value='" . esc_attr($init_msg) . "' />";
}


function cmi_wp_native_chat_active_msg() {
  $active_msg = 'Chat Log';
  $options = get_option( 'cmi_wp_native_chat_plugin_options' );

  if ( isset($options['active_msg']) ) {
    if ( $options['active_msg'] != '' ) { $active_msg =   esc_attr( $options['active_msg'] ); }


  } 
  echo "<input id='cmi_wp_native_chat_active_msg' name='cmi_wp_native_chat_plugin_options[active_msg]' type='text' value='" . esc_attr($active_msg) . "' />";
}

function cmi_wp_native_chat_timeout_msg() {
  $timeout_msg = 'Sorry we are not able to respond to this chat at this time.<br> Please try again later';
  $options = get_option( 'cmi_wp_native_chat_plugin_options' );

  if ( isset($options['timeout_msg']) ) {
    if ( $options['timeout_msg'] != '' ) { $timeout_msg =   esc_attr( $options['timeout_msg'] ); }


  } 
  echo "<textarea id='cmi_wp_native_chat_timeout_msg' rows='4' cols='50' name='cmi_wp_native_chat_plugin_options[timeout_msg]' type='text'>". esc_attr($timeout_msg) . "</textarea>";
}

function cmi_wp_native_chat_ask_email() {
  $ask_email = '';
  $options = get_option( 'cmi_wp_native_chat_plugin_options' );

  if ( isset($options['ask_email']) ) {
    if ( $options['ask_email'] != '' ) { $ask_email =  'checked'; }
  } 
  echo "<input id='cmi_wp_native_chat_ask_email' name='cmi_wp_native_chat_plugin_options[ask_email]' type='checkbox' " . esc_attr($ask_email) . " />";
}

function cmi_wp_native_chat_heading_color() {

  $heading_color = '#FFFFFF';
  $options = get_option( 'cmi_wp_native_chat_plugin_options' );

  if ( isset($options['heading_color']) ) {
    if ( $options['heading_color'] != '' ) { $heading_color =   esc_attr( $options['heading_color'] ); }


  } 
  echo "<input id='cmi_wp_native_chat_heading_color' name='cmi_wp_native_chat_plugin_options[heading_color]' type='color' value='" . esc_attr($heading_color) . "' />";
}


function cmi_wp_native_chat_heading_font() {

  $heading_font = 'inherit';
  $options = get_option( 'cmi_wp_native_chat_plugin_options' );

  if ( isset($options['heading_font']) ) {
    if ( $options['heading_font'] != '' ) { $heading_font =   esc_attr( $options['heading_font'] ); }


  } 
  echo "<input id='cmi_wp_native_chat_heading_font' name='cmi_wp_native_chat_plugin_options[heading_font]' type='text' value='" . esc_attr($heading_font) . "' />";
}



function cmi_wp_native_chat_heading_size() {

  $heading_size = '2rem';
  $options = get_option( 'cmi_wp_native_chat_plugin_options' );

  if ( isset($options['heading_size']) ) {
    if ( $options['heading_size'] != '' ) { $heading_size =   esc_attr( $options['heading_size'] ); }


  } 
  echo "<input id='cmi_wp_native_chat_heading_size' name='cmi_wp_native_chat_plugin_options[heading_size]' type='text' value='" . esc_attr($heading_size) . "' />";
}




function cmi_wp_native_chat_msg_font() {
  $msg_font = 'inherit';
  $options = get_option( 'cmi_wp_native_chat_plugin_options' );

  if ( isset($options['msg_font']) ) {
    if ( $options['msg_font'] != '' ) { $msg_font =   esc_attr( $options['msg_font'] ); }


  } 
  echo "<input id='cmi_wp_native_chat_msg_font' name='cmi_wp_native_chat_plugin_options[msg_font]' type='text' value='" . esc_attr($msg_font) . "' />";
}



function cmi_wp_native_chat_admin_msg_bg() {
  $admin_msg_bg = '#003A52';
  $options = get_option( 'cmi_wp_native_chat_plugin_options' );

  if ( isset($options['admin_msg_bg']) ) {
    if ( $options['admin_msg_bg'] != '' ) { $admin_msg_bg =   esc_attr( $options['admin_msg_bg'] ); }


  } 
  echo "<input id='cmi_wp_native_chat_admin_msg_bg' name='cmi_wp_native_chat_plugin_options[admin_msg_bg]' type='color' value='" . esc_attr($admin_msg_bg) . "' />";
}


function cmi_wp_native_chat_admin_msg_color() {
  $admin_msg_color = '#FFFFFF';
  $options = get_option( 'cmi_wp_native_chat_plugin_options' );

  if ( isset($options['admin_msg_color']) ) {
    if ( $options['admin_msg_color'] != '' ) { $admin_msg_color =   esc_attr( $options['admin_msg_color'] ); }


  } 
  echo "<input id='cmi_wp_native_chat_admin_msg_color' name='cmi_wp_native_chat_plugin_options[admin_msg_color]' type='color' value='" . esc_attr($admin_msg_color) . "' />";
}


function cmi_wp_native_chat_user_msg_bg() {
  $user_msg_bg = '#FFFFFF';
  $options = get_option( 'cmi_wp_native_chat_plugin_options' );

  if ( isset($options['user_msg_bg']) ) {
    if ( $options['user_msg_bg'] != '' ) { $user_msg_bg =   esc_attr( $options['user_msg_bg'] ); }


  } 
  echo "<input id='cmi_wp_native_chat_user_msg_bg' name='cmi_wp_native_chat_plugin_options[user_msg_bg]' type='color' value='" . esc_attr($user_msg_bg) . "' />";
}


function cmi_wp_native_chat_user_msg_color() {
  $user_msg_color = '#003A52';
  $options = get_option( 'cmi_wp_native_chat_plugin_options' );

  if ( isset($options['user_msg_color']) ) {
    if ( $options['user_msg_color'] != '' ) { $user_msg_color =   esc_attr( $options['user_msg_color'] ); }


  } 
  echo "<input id='cmi_wp_native_chat_user_msg_color' name='cmi_wp_native_chat_plugin_options[user_msg_color]' type='color' value='" . esc_attr($user_msg_color) . "' />";
}



function cmi_wp_native_chat_button_bg() {
  $button_bg = '#009FEE';
  $options = get_option( 'cmi_wp_native_chat_plugin_options' );

  if ( isset($options['button_bg']) ) {
    if ( $options['button_bg'] != '' ) { $button_bg =   esc_attr( $options['button_bg'] ); }


  } 
  echo "<input id='cmi_wp_native_chat_button_bg' name='cmi_wp_native_chat_plugin_options[button_bg]' type='color' value='" . esc_attr($button_bg) . "' />";
}


function cmi_wp_native_chat_button_font() {
  $button_font = 'inherit';
  $options = get_option( 'cmi_wp_native_chat_plugin_options' );

  if ( isset($options['button_font']) ) {
    if ( $options['button_font'] != '' ) { $button_font =   esc_attr( $options['button_font'] ); }


  } 
  echo "<input id='cmi_wp_native_chat_button_font' name='cmi_wp_native_chat_plugin_options[button_font]' type='text' value='" . esc_attr($button_font) . "' />";
}

function cmi_wp_native_chat_button_border() {
  $button_border = '1px solid';
  $options = get_option( 'cmi_wp_native_chat_plugin_options' );

  if ( isset($options['button_border']) ) {
    if ( $options['button_border'] != '' ) { $button_border =   esc_attr( $options['button_border'] ); }


  } 
  echo "<input id='cmi_wp_native_chat_button_border' name='cmi_wp_native_chat_plugin_options[button_border]' type='text' value='" . esc_attr($button_border) . "' />";
}



function cmi_wp_native_chat_button_border_radius() {
  $button_border_radius = '.5rem';
  $options = get_option( 'cmi_wp_native_chat_plugin_options' );

  if ( isset($options['button_border_radius']) ) {
    if ( $options['button_border_radius'] != '' ) { $button_border_radius =   esc_attr( $options['button_border_radius'] ); }


  } 
  echo "<input id='cmi_wp_native_chat_button_border_radius' name='cmi_wp_native_chat_plugin_options[button_border_radius]' type='text' value='" . esc_attr($button_border_radius) . "' />";
}


function cmi_wp_native_chat_button_border_color() {
  $button_border_color = '#FFFFFF';
  $options = get_option( 'cmi_wp_native_chat_plugin_options' );

  if ( isset($options['button_border_color']) ) {
    if ( $options['button_border_color'] != '' ) { $button_border_color =   esc_attr( $options['button_border_color'] ); }


  } 
  echo "<input id='cmi_wp_native_chat_button_border_color' name='cmi_wp_native_chat_plugin_options[button_border_color]' type='color' value='" . esc_attr($button_border_color) . "' />";
}


function cmi_wp_native_chat_button_transition() {
  $button_transition = 'all 1s';
  $options = get_option( 'cmi_wp_native_chat_plugin_options' );

  if ( isset($options['button_transition']) ) {
    if ( $options['button_transition'] != '' ) { $button_transition =   esc_attr( $options['button_transition'] ); }


  } 
  echo "<input id='cmi_wp_native_chat_button_transition' name='cmi_wp_native_chat_plugin_options[button_transition]' type='text' value='" . esc_attr($button_transition) . "' />";
}


function cmi_wp_native_chat_button_transform() {
  $button_transform = 'translateY(5px)';
  $options = get_option( 'cmi_wp_native_chat_plugin_options' );

  if ( isset($options['button_transform']) ) {
    if ( $options['button_transform'] != '' ) { $button_transform =   esc_attr( $options['button_transform'] ); }


  } 
  echo "<input id='cmi_wp_native_chat_button_transform' name='cmi_wp_native_chat_plugin_options[button_transform]' type='text' value='" . esc_attr($button_transform) . "' />";
}


function cmi_wp_native_chat_button_txt_color() {
  $button_txt_color = '#FFFFFF';
  $options = get_option( 'cmi_wp_native_chat_plugin_options' );

  if ( isset($options['button_txt_color']) ) {
    if ( $options['button_txt_color'] != '' ) { $button_txt_color =   esc_attr( $options['button_txt_color'] ); }


  } 
  echo "<input id='cmi_wp_native_chat_button_txt_color' name='cmi_wp_native_chat_plugin_options[button_txt_color]' type='color' value='" . esc_attr($button_txt_color) . "' />";
}


function cmi_wp_native_chat_button_txt_color_hover() {
  $button_txt_color_hover = '#FFFFFF';
  $options = get_option( 'cmi_wp_native_chat_plugin_options' );

  if ( isset($options['button_txt_color_hover']) ) {
    if ( $options['button_txt_color_hover'] != '' ) { $button_txt_color_hover =   esc_attr( $options['button_txt_color_hover'] ); }


  } 
  echo "<input id='cmi_wp_native_chat_button_txt_color_hover' name='cmi_wp_native_chat_plugin_options[button_txt_color_hover]' type='color' value='" . esc_attr($button_txt_color_hover) . "' />";
}


function cmi_wp_native_chat_button_border_color_hover() {
  $button_border_color_hover = '#003A52';
  $options = get_option( 'cmi_wp_native_chat_plugin_options' );

  if ( isset($options['button_border_color_hover']) ) {
    if ( $options['button_border_color_hover'] != '' ) { $button_border_color_hover =   esc_attr( $options['button_border_color_hover'] ); }


  } 
  echo "<input id='cmi_wp_native_chat_button_border_color_hover' name='cmi_wp_native_chat_plugin_options[button_border_color_hover]' type='color' value='" . esc_attr($button_border_color_hover) . "' />";
}


function cmi_wp_native_chat_button_bg_color_hover() {
  $button_bg_color_hover = '#003A52';
  $options = get_option( 'cmi_wp_native_chat_plugin_options' );

  if ( isset($options['button_bg_color_hover']) ) {
    if ( $options['button_bg_color_hover'] != '' ) { $button_bg_color_hover =   esc_attr( $options['button_bg_color_hover'] ); }


  } 
  echo "<input id='cmi_wp_native_chat_button_bg_color_hover' name='cmi_wp_native_chat_plugin_options[button_bg_color_hover]' type='color' value='" . esc_attr($button_bg_color_hover) . "' />";
}

function cmi_wp_native_chat_validate_network_input($net)
{
  $networks = array (
    'txt.att.net',
    'tmomail.net',
    'messaging.sprintpcs.com',
    'vtext.com',
    'vzwpix.com',
    'vmobl.com'
  );
  return in_array($net, $networks);
}


function cmi_wp_native_chat_primary_phone() {
	$readonly = '';
	$primary_phone = '';
	$primary_phone_button = "<button id='cmi-wp-native-chat-verify-phone-button'>Verify</button>";
  $options = get_option( 'cmi_wp_native_chat_plugin_options' );

  if (isset($_GET['network'])) {
  	$preformatted = sanitize_text_field($_GET['network']);
    $preformatted = explode('@', $preformatted);
    if(!cmi_wp_native_chat_validate_network_input($preformatted['1'])) { return; }
  	$readonly = 'readonly'; 
  	$primary_phone_button = "<button id='cmi-wp-native-chat-change-phone-button'>Verified Please Save</button>";
	}

  if ( isset($options['primary_phone']) ) {
  	if ( $options['primary_phone'] != '' ) { $primary_phone = 	esc_attr( $options['primary_phone'] ); }

  	if ( isset($options['phone_verified']) && $options['phone_verified'] == 'verified'  ) { 
  		$readonly = 'readonly'; 
			$primary_phone_button = "<button id='cmi-wp-native-chat-change-phone-button'>Change</button>";
  	}

  } 
  echo "<input ".$readonly." id='cmi_wp_native_chat_primary_phone' name='cmi_wp_native_chat_plugin_options[primary_phone]' type='tel' value='" . esc_attr($primary_phone) . "' />".wp_kses_post($primary_phone_button);
}


function cmi_wp_native_chat_primary_email() {

	$readonly = '';
  $primary_email = '';
	$primary_email_button = "<button id='cmi-wp-native-chat-verify-email-button'>Verify</button>";
  $options = get_option( 'cmi_wp_native_chat_plugin_options' );

   if (isset($_GET['email']) ) {
   	$primary_email = sanitize_email($_GET['email']);
		$readonly = 'readonly'; 
		$primary_email_button = "<button disabled id='cmi-wp-native-chat-change-email-button'>Verified Please Save</button>";
   }
    
  if ( isset($options['primary_email']) ) {    
  	if ( $options['primary_email'] != '' ) { $primary_email = 	esc_attr( $options['primary_email'] ); }

  	if ( isset($options['email_verified']) && $options['email_verified'] == 'verified' ) { 
  		$readonly = 'readonly'; 
			$primary_email_button = "<button id='cmi-wp-native-chat-change-email-button'>Change</button>";
  	}

  }
  echo "<input ".$readonly." id='cmi_wp_native_chat_primary_email' name='cmi_wp_native_chat_plugin_options[primary_email]' type='text' value='" . esc_attr($primary_email) . "' />".wp_kses_post($primary_email_button);
}


function cmi_wp_native_chat_verified_email () {
	$options = get_option( 'cmi_wp_native_chat_plugin_options' );
	$verified = '';
   if (isset($_GET['email']) ) {
   	$verified = 'verified';
	}
	if ( isset($options['email_verified'])) {
		if ($options['email_verified'] == 'verified') { $verified = 'verified'; }
	}

	echo "<input id='cmi_wp_native_chat_primary_email_verification' name='cmi_wp_native_chat_plugin_options[email_verified]' type='hidden' value='".esc_attr($verified)."' />";
}



function cmi_wp_native_chat_verified_phone () {
	$options = get_option( 'cmi_wp_native_chat_plugin_options' );
	$verified = '';
   if (isset($_GET['network']) ) {
   	$verified = 'verified';
	}
	if ( isset($options['phone_verified'])) {
		if ($options['phone_verified'] == 'verified') { $verified = 'verified'; }
	}

	echo "<input id='cmi_wp_native_chat_primary_phone_verification' name='cmi_wp_native_chat_plugin_options[phone_verified]' type='hidden' value='".esc_attr($verified)."' />";
}





// function cmi_wp_native_chat_plugin_setting_verify() {
//   $options = get_option( 'cmi_wp_native_chat_plugin_options' );
//   $options['verify']=false;
//   // var_dump($options);
//   // update_option( 'cmi_wp_native_chat_plugin_options']);
//   //$verify = isset($options['verify']) ? esc_attr( $options['verify'] ) : ''; 
//   //echo "<input id='cmi_wp_native_chat_plugin_setting_verifyd' name='cmi_wp_native_chat_plugin_options[verifyd]' type='hidden' value='" . $verifyd . "' />";
// }