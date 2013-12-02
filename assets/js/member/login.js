/** member/login.js **/
$(document).ready(function(e) {
    $("#member_login").validate({
		rules: {			        	        		
			password :  {
				minlength: 8,
				maxlength: 20,
				required: true
			},
			
		},
		
		messages: {
    		password :" Enter password 8-20 characters"
		}
	});
});