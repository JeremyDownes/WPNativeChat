(function( $ ) {
	'use strict';
	 $( window ).load(function() {


		$('#cmi-wp-native-chat-verify-phone-button').click(function(e) {
			e.preventDefault();
      var phoneValue = $('#cmi_wp_native_chat_primary_phone').val();
      
      let data =  {'phone': phoneValue, action: 'cmi_chat_primary_verification'}
      $.post(ajaxurl, data, function (response) {
          // Response div goes here.
          alert("action performed successfully");
      });
		});


		$('#cmi-wp-native-chat-verify-email-button').click(function(e) {
			e.preventDefault();
      var emailValue = $('#cmi_wp_native_chat_primary_email').val();
     
      let data =  {'email': emailValue, action: 'cmi_chat_primary_verification'}
      $.post(ajaxurl, data, function (response) {
          // Response div goes here.
          alert("action performed successfully");
          window.location.reload()
      });
		});


		$('#cmi-wp-native-chat-change-phone-button').click(function(e) {
			e.preventDefault();
			$('#cmi_wp_native_chat_primary_phone').attr({readonly: false})
			$('#cmi_wp_native_chat_primary_phone_verification').val('')
			$('#cmi-wp-native-chat-change-phone-button').attr({id: 'cmi-wp-native-chat-verify-phone-button'}).text('Verify')

			$('#cmi-wp-native-chat-verify-phone-button').click(function(e) {
				e.preventDefault();
	      var phoneValue = $('#cmi_wp_native_chat_primary_phone').val();
	     
	      let data =  {'phone': phoneValue, action: 'cmi_chat_primary_verification'}
	      $.post(ajaxurl, data, function (response) {
	          // Response div goes here.
	          alert("action performed successfully");
	      });
			});			

		});


		$('#cmi-wp-native-chat-change-email-button').click(function(e) {
			e.preventDefault();
			$('#cmi_wp_native_chat_primary_email').attr({readonly: false}) 
			$('#cmi_wp_native_chat_primary_email_verification').val('')
			$('#cmi-wp-native-chat-change-email-button').attr({id: 'cmi-wp-native-chat-verify-email-button'}).text('Verify')

			$('#cmi-wp-native-chat-verify-email-button').click(function(e) {
				e.preventDefault();
	      var emailValue = $('#cmi_wp_native_chat_primary_email').val();
	    
	      let data =  {'email': emailValue, action: 'cmi_chat_primary_verification'}
	      $.post(ajaxurl, data, function (response) {
	          // Response div goes here.
	          alert("action performed successfully");
	      });
			});			

		});

	});

})( jQuery );

