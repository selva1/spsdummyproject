$(document).ready(function(){
	$('#username').focus(); // Focus to the username field on body loads
	$('#login').click(function(){ // Create `click` event function for login
		var username = $('#username'); // Get the username field
		var password = $('#password'); // Get the password field
		var login_result = $('.login_result'); // Get the login result div
		login_result.html('loading..'); // Set the pre-loader can be an animation
		if(username.val() == ''){ // Check the username values is empty or not
			username.focus(); // focus to the filed
			login_result.html('<span class="error">Enter the username</span>');
			return false;
		}
		if(password.val() == ''){ // Check the password values is empty or not
			password.focus();
			login_result.html('<span class="error">Enter the password</span>');
			return false;
		}
		if(username.val() != '' && password.val() != ''){ // Check the username and password values is not empty and make the ajax request
		var search_sess		  	  =	  jQuery.trim($("input[name='search_sess']").val());
		var fav_id			  	  =	  jQuery.trim($("input[name='fav_id']").val());
			//var UrlToPass = 'action=login&username='+username.val()+'&password='+password.val()+'&fav_id='+fav_id;
			var UrlToPass = 'action=login&username='+username.val()+'&password='+password.val();
			$.ajax({ // Send the credential values to another checker.php using Ajax in POST menthod
			type : 'POST',
			data : UrlToPass,
			url  : 'get_login.php',
			success: function(responseText){ // Get the result and asign to each cases
                //console.log(responseText);
                var objResult=$.parseJSON(responseText);
				console.log(responseText);
                if(objResult.is_logged_in == 0){
					login_result.html('<span class="error">Username or Password Incorrect!</span>');
				}
				else if(objResult.is_logged_in == 1){
					if(objResult.user_type==1)
					    window.location = 'index.php';
                    else if(objResult.user_type==2)
                        window.location='all-product-list.php';
					else if(objResult.user_type==0)
                        login_result.html('<span class="error">Username or Password Incorrect!</span>');
                }
				else{

					alert('Problem with sql query123');
				}
			}
			});
		}
		return false;
	});
});