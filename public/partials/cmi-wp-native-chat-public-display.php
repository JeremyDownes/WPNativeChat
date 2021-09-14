<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <?php wp_head(); ?>
  
</head>
<body id="chat-administration">
<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       jeremydownes.com
 * @since      1.0.0
 *
 * @package    Cmi_Wp_Native_Chat
 * @subpackage Cmi_Wp_Native_Chat/public/partials
 */


if ( ! current_user_can( 'manage_options' ) ) {
    die;
}
//var_dump(get_post_meta(get_the_ID()));

$admin_name = isset( get_post_meta( get_the_ID() )['admin_name']['0'] ) ? get_post_meta( get_the_ID() )['admin_name']['0'] : false  ; //get_option
 while ( have_posts() ) : the_post();
 	$id = get_the_ID();
?>
<div id="chat-content">
  <?php
  $key = get_post_meta(get_the_ID())['key']['0'];
  $chat_closed = isset(get_post_meta(get_the_ID())['chat_closed']) ? get_post_meta(get_the_ID())['chat_closed'] : false;
  ?>
</div>
<?php


if (isset($_POST['admin_name'])) {
  if(!isset(get_post_meta(get_the_ID())['admin_name'])) {
    update_post_meta(get_the_ID(), 'admin_name', sanitize_user($_POST['admin_name'])); 
  }
}

if (isset($_POST['message'])) {

	$updated_content = array(
      'ID'           => $id,
      'post_content' => $_POST['message'],
  	);
  wp_update_post( $updated_content );
  if (isset($_POST['admin_name'])) {
    echo "<script>window.location = window.location.href</script>";
  }
}


  $user_id = get_user_by('login', 'CMI_WP_Native_Chat')->ID;

  $passwords = WP_Application_Passwords::get_user_application_passwords($user_id);
if (!$chat_closed[0]) :
 	?>
  <div id="cmi-chat-form-div">
   	<form id="cmi_chat_admin_input" method="post" action="">
    <h2 id='cmi-chat-replyto'></h2>
      <?php if (!$admin_name) echo '<div id="cmi-chat-fields"><input id="admin-name" type="text" placeholder="Enter Your Name" name="admin_name">'; ?>
      <input type="text" id='decoded-input' placeholder="Enter Your Reply">
      <?php if (!$admin_name) echo '</div>'; ?>
   		<input id="admin-input" type="hidden" name="message">
   		<input type="submit" name="submit" value="Send">
   	</form>

    <!-- <button>Close Chat</button> -->
  </div>
<?php 
endif; 
if ($chat_closed[0] ) :
?>

<p id='cmi_chat_admin_review'>
 	<?php echo $chat_closed[0]; 
    if ( isset(get_post_meta(get_the_ID())['email']) ) {
      $email = get_post_meta(get_the_ID())['email'][0];
      if ( strlen($email) > 1 ) {
        echo "<br><a href='mailto:".$email."'><button>Email User</button></a>";
      }
    }
   ?>
</p>
        
<?php 
endif;
endwhile;
if (!$chat_closed[0]) : ?>
  <script type="text/javascript">
    
    let content = ''
    let key= '\<?php echo $key; ?>'
    let adminName = '\<?php echo $admin_name? $admin_name : "false"; ?>'

    jQuery(document).ready(($)=>{

      $('#admin-name').keyup((e)=>{ adminName=e.target.value })

      $('#decoded-input').keyup((e)=>{
          let change = CryptoJS.AES.decrypt( content, key  ).toString(CryptoJS.enc.Utf8)
          change += '<div class="cmi-chat-admin-messages"><p class="cmi-chat-admin-name">'+adminName+'</p><p class="cmi-chat-msg-time">'+new Date().toLocaleTimeString('en-US')+'</p><p class="cmi-chat-admin-message">'+e.target.value+'</p></div>'
          $('#admin-input').val( CryptoJS.AES.encrypt(change, key) )
        })
      })

      setTimeout(()=>{ fetchConversation()},10)
      const fetchConversation = ()=>{
        fetch(location.protocol+'//'+location.hostname+'/wp-json/wp/v2/conversation/'+<?php echo $id;?>)
        .then(response => response.json())
        .then(data => {
          let updatedContent = data.content.rendered.slice(3,-5)
          if (updatedContent !== content) {
            content=updatedContent
            document.getElementById('chat-content').innerHTML = CryptoJS.AES.decrypt( updatedContent, key  ).toString(CryptoJS.enc.Utf8).replace(/<script/,'script').replace(/<\/script/,'/script')
            jQuery('#cmi-chat-replyto').text('Reply To '+jQuery('.cmi-chat-user-name')[0].textContent)
            jQuery('body').scrollTop(jQuery(document).height());
          }
          setTimeout(()=>{ fetchConversation()},3000)
        })
        .catch((error)=>{
//          setTimeout(()=>{ fetchConversation()},3000)
          window.location = window.location.href
        })
      }       

  </script>
<?php 
endif;
if ($chat_closed): ?>
    <script type="text/javascript">
    
    let content = '\<?php echo get_the_content(); ?>'
    let key= '\<?php echo $key; ?>'

      jQuery(document).ready(($)=>{
        document.getElementById('chat-content').innerHTML = CryptoJS.AES.decrypt( content, key  ).toString(CryptoJS.enc.Utf8).replace(/<script/,'script').replace(/<\/script/,'/script')
      })

</script>

<?php endif;
