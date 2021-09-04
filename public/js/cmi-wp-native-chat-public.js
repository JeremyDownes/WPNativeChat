(function( $ ) {
	'use strict';

    var app_pass, app_pass_uuid, key='', base_uri = location.protocol+'//'+location.hostname
    const buildKey = ()=>{
      const chars = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','~','\!','@','#','$','%','^','&','*','{','}','[',']',':',';','<','>','?']
      key += chars[Math.floor(Math.random()*chars.length)]
    }
    
    while(key.length < 16) {
        buildKey()
    }
    

	$( window ).load(function() {	 
		
		let name = ''
        let email = ''
		let message=''
		let id = 0
		let content = ''
        let timeout = null
		let rest_uri = cmi_wp_native_chat_ajax_object.rest_uri
		let username = 'CMI_WP_Native_Chat'
        let poll
        let chatTimeout
        let ask_email = cmi_wp_native_chat_ajax_object.ask_email ? cmi_wp_native_chat_ajax_object.ask_email : false
        let justify = cmi_wp_native_chat_ajax_object.justify ? cmi_wp_native_chat_ajax_object.align : 'flex-end'
        let align = cmi_wp_native_chat_ajax_object.align ? cmi_wp_native_chat_ajax_object.justify : 'flex-end'
        let chat_timeout = cmi_wp_native_chat_ajax_object.chat_timeout ? cmi_wp_native_chat_ajax_object.chat_timeout*60 : 300
        let expire_time = (chat_timeout*60)+60 > 300 ? ((chat_timeout*60)+60)*1000 : 300000
        let chat_timeout_msg = cmi_wp_native_chat_ajax_object.timeout_msg ? cmi_wp_native_chat_ajax_object.timeout_msg : false
        let size = cmi_wp_native_chat_ajax_object.size ? cmi_wp_native_chat_ajax_object.size : 1
        let size_mobile = cmi_wp_native_chat_ajax_object.size_mobile ? cmi_wp_native_chat_ajax_object.size_mobile : 1
        let start_image_size = cmi_wp_native_chat_ajax_object.start_image_size ? cmi_wp_native_chat_ajax_object.start_image_size : 1
        let start_img = cmi_wp_native_chat_ajax_object.start_img ? cmi_wp_native_chat_ajax_object.start_img : ''
        let open_msg = cmi_wp_native_chat_ajax_object.open_msg? cmi_wp_native_chat_ajax_object.open_msg : 'Chat with us!'
        let init_msg = cmi_wp_native_chat_ajax_object.init_msg? cmi_wp_native_chat_ajax_object.init_msg : 'Start a Chat'
        let active_msg = cmi_wp_native_chat_ajax_object.active_msg? cmi_wp_native_chat_ajax_object.active_msg : 'Chat Log'
        let bg_color = cmi_wp_native_chat_ajax_object.bg_color ? cmi_wp_native_chat_ajax_object.bg_color : null
        let border_radius = cmi_wp_native_chat_ajax_object.border_radius ? cmi_wp_native_chat_ajax_object.border_radius : null
        let heading_color = cmi_wp_native_chat_ajax_object.heading_color ? cmi_wp_native_chat_ajax_object.heading_color : null
        let heading_font = cmi_wp_native_chat_ajax_object.heading_font ? cmi_wp_native_chat_ajax_object.heading_font : null
        let heading_size = cmi_wp_native_chat_ajax_object.heading_size ? cmi_wp_native_chat_ajax_object.heading_size : null
        let button_bg = cmi_wp_native_chat_ajax_object.button_bg ? cmi_wp_native_chat_ajax_object.button_bg : null
        let button_font = cmi_wp_native_chat_ajax_object.button_font ? cmi_wp_native_chat_ajax_object.button_font : null
        let button_border = cmi_wp_native_chat_ajax_object.button_border ? cmi_wp_native_chat_ajax_object.button_border : null
        let button_border_color = cmi_wp_native_chat_ajax_object.button_border_color ? cmi_wp_native_chat_ajax_object.button_border_color : null
        let button_border_radius = cmi_wp_native_chat_ajax_object.button_border_radius ? cmi_wp_native_chat_ajax_object.button_border_radius : null
        let button_transition = cmi_wp_native_chat_ajax_object.button_transition ? cmi_wp_native_chat_ajax_object.button_transition : null
        let button_transform = cmi_wp_native_chat_ajax_object.button_transform ? cmi_wp_native_chat_ajax_object.button_transform : null
        let button_txt_color = cmi_wp_native_chat_ajax_object.button_txt_color ? cmi_wp_native_chat_ajax_object.button_txt_color : null
        let button_txt_color_hover = cmi_wp_native_chat_ajax_object.button_txt_color_hover ? cmi_wp_native_chat_ajax_object.button_txt_color_hover : null
        let button_bg_color_hover = cmi_wp_native_chat_ajax_object.button_bg_color_hover ? cmi_wp_native_chat_ajax_object.button_bg_color_hover : null
        let button_border_color_hover = cmi_wp_native_chat_ajax_object.button_border_color_hover ? cmi_wp_native_chat_ajax_object.button_border_color_hover : null
        let msg_font = cmi_wp_native_chat_ajax_object.msg_font ? cmi_wp_native_chat_ajax_object.msg_font : null
        let admin_msg_bg = cmi_wp_native_chat_ajax_object.admin_msg_bg ? cmi_wp_native_chat_ajax_object.admin_msg_bg : null
        let admin_msg_color = cmi_wp_native_chat_ajax_object.admin_msg_color ? cmi_wp_native_chat_ajax_object.admin_msg_color : null
        let user_msg_bg = cmi_wp_native_chat_ajax_object.user_msg_bg ? cmi_wp_native_chat_ajax_object.user_msg_bg : null
        let user_msg_color = cmi_wp_native_chat_ajax_object.user_msg_color ? cmi_wp_native_chat_ajax_object.user_msg_color : null

        ask_email = ask_email ? '<input type="text" id="cmi-chat-user-email" placeholder="Your Email"/><br>' : ''


    let styleUpdates = [
        [ bg_color, '--background' ],
        [ border_radius, '--border-radius' ],
        [ heading_color, '--headings-color' ],
        [ heading_font, '--headings-font' ],
        [ heading_size, '--headings-size' ],
        [ button_bg, '--button-bg-color' ],
        [ button_font, '--button-font' ],
        [ button_border, '--button-border' ],
        [ button_border_color, '--button-border-color' ],
        [ button_border_radius, '--button-border-radius' ],
        [ button_transition, '--button-transition' ],
        [ button_transform, '--button-transform' ],
        [ button_txt_color, '--button-txt-color' ],
        [ button_txt_color_hover, '--button-txt-color-hover' ],
        [ button_bg_color_hover, '--button-bg-color-hover' ],
        [ button_border_color_hover, '--button-border-color-hover' ],
        [ msg_font, '--messages-font' ],
        [ admin_msg_bg, '--admin-msg-bg' ],
        [ admin_msg_color, '--admin-msg-txt' ],
        [ user_msg_bg, '--user-msg-bg' ],
        [ user_msg_color, '--user-msg-txt' ],
        [ justify, '--justify'],
        [ align, '--align'],
        [ size, '--size'],
        [ size_mobile, '--size-mobile'],
        [ start_image_size, '--start-image-size'],
    ]

    styleUpdates.forEach((style)=>{
        if( style[0] ) {
            document.documentElement.style.setProperty(style[1], style[0]);
        }
    })

    if( $('body').attr('class') ) {
            $('body').append('<div id="CMIWPNativeChat-container" ><div id="CMIWPNativeChat" class="CMIWPNativeChat-closed">'+start_img+'<button id="cmi-chat-init">'+open_msg+'</button></div></div>')
    }

        $('#cmi-chat-init').click(()=>{ initiateChat() })



const initiateChat = () => {
    fetch(base_uri+'/wp-json/cmiwpnativechat/v1/chat/generate/?key='+key).then(response=> response.json()).then((data)=>{
        app_pass = data.app_pass
        app_pass_uuid = data.uuid
    })
    $('#CMIWPNativeChat *').remove()
    $('#CMIWPNativeChat').append('<p id="cmi-chat-start-message">'+init_msg+'</p><input type="text" id="cmi-chat-user-name" placeholder="Your Name"/><br>'+ask_email+'<input type="text" id="cmi-chat-user-message" placeholder="Your Message" /><br><div id="cmi-chat-button-container"><button id="cmi-chat-start">Send</button></div>')
	$('#cmi-chat-start').click(()=>{ if ( validationRoutine() ) {startChat()}})
	
	$('#cmi-chat-user-name').keyup((e)=>{
		name = e.target.value
        name.match(/<script/)? window.location = '/' : null
	})
    $('#cmi-chat-user-email').keyup((e)=>{
        email = e.target.value
        email.match(/<script/)? window.location = '/' : null
    })
    
    $('#cmi-chat-user-message').keyup((e)=>{
		if(e.keyCode===13  && validationRoutine() ) { startChat() }
		else { 
            message = e.target.value 
            message.match(/<script/)? window.location = '/' : null
        }
	})

}        

const validationRoutine = () => {
    if ( name.length < 3 || message.length < 3) {return false}
    if ( ask_email && email.length < 6 ) {return false}
    return true
}

const startChat = () => {
    $.ajax({
        type: 'POST',
        url: rest_uri,
        beforeSend: function(xhr) {
            var token = btoa(username + ':' + app_pass)
            xhr.setRequestHeader('Authorization', 'Basic ' + token)
        },
        data: {
            'title': name+' - '+ new Date(),
            'status': 'publish',  
            'key': key,
            'uuid': app_pass_uuid,
            'email': email,
            'content': CryptoJS.AES.encrypt('<div class="cmi-chat-user-messages"><p class="cmi-chat-user-name">'+name+'</p><p class="cmi-chat-msg-time">'+new Date().toLocaleTimeString('en-US')+'</p><p class="cmi-chat-user-message">'+message+'</p></div>', key).toString(),
        },
        success:function(response) { //change view
            id = response.id
						localStorage.setItem('cmi-chat-key', 'active');
					  $('#CMIWPNativeChat *').remove()
					  $('#CMIWPNativeChat').append('<p id=cmi-chat-open-heading>'+active_msg+'</p><div id="cmi-chat-messages"><p id="cmi-chat-wait-message">Typical response time is<br>less than '+cmi_wp_native_chat_ajax_object.chat_timeout+' minutes</p></div><br><input type="text" id="cmi-chat-user-message" placeholder="Your Message" /><br><button id="cmi-chat-submit">Send</button>').removeClass('CMIWPNativeChat-closed').addClass('CMIWPNativeChat-open')
					  $('#cmi-chat-user-message').keyup((e)=>{
					  	if(e.keyCode===13) { postMessage(message) }
							message = e.target.value
                            message.match(/<script/)? window.location = '/' : null
						})
						$('#cmi-chat-submit').click(()=>{		
							postMessage(message)
						})
						poll = setInterval(()=>{ fetchConversation()},3000)
                        chatTimeout = setTimeout(()=>{noAdmin()},chat_timeout*1000)
                        timeout = setTimeout(()=>{expire()},expire_time)
        },
        error:function(response) { //error message
        	console.log(response)
        }
    })
}

const postMessage = (msg)=> {
    $('#cmi-chat-user-message').val('')
	$.ajax({
        type: 'PUT',
        url: rest_uri+id,
        beforeSend: function(xhr) {
            var token = btoa(username + ':' + app_pass)
            xhr.setRequestHeader('Authorization', 'Basic ' + token)
        },
        data: {
            'status': 'publish',
            'content': CryptoJS.AES.encrypt(content+'<div class="cmi-chat-user-messages"><p class="cmi-chat-user-name">'+name+'</p><p class="cmi-chat-msg-time">'+new Date().toLocaleTimeString('en-US')+'</p><p class="cmi-chat-user-message">'+message+'</p></div>', key).toString(),
        },
        success:function(response) { //change view
            id = response.id
        },
        error:function(response) { //error message
        	console.log(response)
        }
    })
}

const fetchConversation = ()=>{
	fetch(rest_uri+id)
	.then(response => response.json())
	.then(data => {
		let updatedContent = data.content.rendered.slice(3,-5)
		updatedContent = CryptoJS.AES.decrypt(updatedContent, key).toString(CryptoJS.enc.Utf8)
			
		if (updatedContent !== content) {
            clearTimeout(timeout)
            timeout = setTimeout(()=>{expire()},expire_time)
			content=updatedContent
			$('#cmi-chat-messages').html(content).scrollTop($('#cmi-chat-messages')[0].scrollHeight)

		}
	})
    .catch((error) => {
        closeChat()
    });

    }	
const noAdmin = () => {
  if($('#cmi-chat-admin-message').length < 1 ) {
    $('#CMIWPNativeChat *').remove()
    if(timeout) { clearTimeout(timeout) }
    if( !chat_timeout_msg || chat_timeout_msg === '' ) { chat_timeout_msg = 'Sorry we are not able to respond to this chat at this time.<br> Please try again later' }
    $('#CMIWPNativeChat').append('<div id="cmi-chat-no-admin">'+chat_timeout_msg.replace(/\n/g,'<br>')+'<button id="cmi-chat-close">Close</button></div>').removeClass('CMIWPNativeChat-open').addClass('CMIWPNativeChat-closed')
    $('#cmi-chat-close').click(()=>{closeChat()})
    chatTimeout=setTimeout(()=>{closeChat()},20000)
  }
}

const expire = () => {
    $('body').append('<div id="cmi-chat-expire-container"><div id="cmi-chat-expire-dialog"><p id="cmi-chat-confirm-message">Are you still there?</p><button id="cmi-chat-continue">CONTINUE CHAT</button></div></div>')
    let autoClose = setTimeout(()=>{closeChat()},10000)
    $('#cmi-chat-continue').click(()=>{continueChat(autoClose)})
}


const continueChat = (autoClose)=>{
    $('#cmi-chat-expire-container').remove()        
    clearTimeout(timeout)
    clearTimeout(autoClose)
    timeout = setTimeout(()=>{expire()},expire_time)
}


const closeChat = () => {
    navigator.sendBeacon(base_uri+'/wp-json/cmiwpnativechat/v1/chat/terminate/?uuid='+app_pass_uuid+'&id='+id,);
    app_pass_uuid = null
    app_pass = null
    if(poll){clearInterval(poll)}
    if(chatTimeout){clearTimeout(chatTimeout)}
    $('#CMIWPNativeChat *').remove()
    $('#CMIWPNativeChat').append(start_img+'<button id="cmi-chat-init">'+open_msg+'</button>').removeClass('CMIWPNativeChat-open').addClass('CMIWPNativeChat-closed')
    $('#cmi-chat-expire-container').remove()
    $('#cmi-chat-init').click(()=>{ initiateChat() })
}

document.addEventListener('unload', function () {
    navigator.sendBeacon(base_uri+'/wp-json/cmiwpnativechat/v1/chat/terminate/?uuid='+app_pass_uuid+'&id='+id,);
    closeChat()
});


document.addEventListener('visibilitychange', function endChat() {
  if (document.visibilityState === 'hidden' && app_pass_uuid) {
		expire()
  }
});

window.addEventListener("pagehide", event => {
    if (app_pass_uuid) {
        navigator.sendBeacon(base_uri+'/wp-json/cmiwpnativechat/v1/chat/terminate/?uuid='+app_pass_uuid+'&id='+id,);
        closeChat()
    }
  if (event.persisted) {
  }
}, false);

})

})( jQuery ) ;

