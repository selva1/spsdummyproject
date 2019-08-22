// JavaScript Document
$(document).ready(function() {
	$("#addcates").validate(
		{ 
			rules: 
			{ 	
			    brand		     : { required : true } ,
				image    		 : { required : true } ,
				image_over       : { required : true },
     			title   		 : { required : true } ,
				keyword   	     : { required : true  } ,
				description   	 : { required : true  } ,
				links        	 : { required : true  } ,
				status        	 : { required : true  } 
				
				
			},
			messages:
			{
				brand		     : { required : 'brand name required .' } ,
				image_over		 : { required : 'brand over image is required.'},
				image    		 : { required : 'image  is required.' } ,
				title		     : { required : 'meta title is required.' } ,
				keyword      	 : { required : 'meta keyword is required.' } ,
			    description  	 : { required : 'meta description  is required.' },
			    links  	         : { required : 'brand alis link  is required.' }, 
			    status  	     : { required : 'brand status  is required.' } 				
			},
			 submitHandler: function(form) 
			 { 
				$(form).find(":button_save").attr("disabled", true).attr("value","Submitting..."); 
				form.submit(); 
			 }	
      	}); 

});
jQuery.validator.addMethod('emailcheckexist', function(st_email) {
	var postURL = "checkemailexist.php";
	var result='';
	$.ajax({
		cache:false,
		async:false,
		type: "POST",
		data: {"mail":st_email},
		url: postURL,
		success: function(msg) {
			msg=jQuery.trim(msg);
			if(msg=='true') { result=false;	} else { result=true; }	
		}
	});
	return result;
}, 'This email already has an account.' );

function SaveInfo() {	
  if($("#addcates").valid()) {
  	
	/*var brand   			  =   jQuery.trim($("input[name='brand']").val());
	var title	    	  	  =	  jQuery.trim($("#title").val());
	var keyword		    	  =   jQuery.trim($("#keyword").val());
	var description  		  =	  jQuery.trim($("#description").val());
	var links  		          =	  jQuery.trim($("input[name='links']").val());
	var image 		          =	  jQuery.trim($("#image").val());
	var status   		      =	  jQuery.trim($("#status").val());
    var editid  		      =	  jQuery.trim($("input[name='editid']").val());
	var site_url              = jQuery("meta[name='siteurl']").attr("content");*/

	
  }
}
