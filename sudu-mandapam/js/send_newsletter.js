// JavaScript Document
$(document).ready(function() {
	$("#addcates").validate(
		{ 
			rules: 
			{ 	
			    email_subject		 : { required : true } ,
				content		 		 : { required : true } ,
				recievers    		 : { required : true } 
			},
			messages:
			{
				email_subject		 : { required : 'Email Subject cannot be blank .' } ,
				content		 		 : { required : 'Email content is required.' } ,
				recievers            : { required : 'Please select atleast one receiver' } 			
			},
			 submitHandler: function(form) 
			 { 
				$(form).find(":button_save").attr("disabled", true).attr("value","Submitting..."); 
				form.submit(); 
			 }	
      	}); 

});

function SaveAddproduct() {	
  if($("#addcates").valid()) {
  	
	var email_subject			  =   jQuery.trim($("#email_subject").val());
	var content  		  		  =	  jQuery.trim($("#content").val());
	var values = new Array();
	$.each($("input[name='content[]']:checked"), function() {
	  values.push($(this).val());
	});
	var send_to= values.join();
	/* merging arr*/
	$.post("ajax_all_add_edits.php" , {command:'saveNewsletter',email_subject:email_subject,content:content,send_to:send_to} , function(data,status)	{
		if(jQuery.trim(data) == "1"){
			 window.location=site_url+"newsletter.php";
		}
	});	
  }
}
