// JavaScript Document
$(document).ready(function() {
	$("#addcates").validate(
		{ 
			rules: 
			{ 	
			    mainselect		 : { required : true } ,
				category		 : { required : true } ,
     			title   		 : { required : true } ,
				keyword   	     : { required : true  } ,
				description   	 : { required : true  } ,
				links        	 : { required : true  } ,
				status        	 : { required : true  } 
				
				
			},
			messages:
			{
				mainselect		 : { required : 'please select category type .' } ,
				category		 : { required : 'category name is required.' } ,
				title		     : { required : 'meta title is required.' } ,
				keyword      	 : { required : 'meta keyword is required.' } ,
			    description  	 : { required : 'meta description  is required.' },
			    links  	         : { required : 'category link  is required.' }, 
			    status  	     : { required : 'category status  is required.' } 				
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
  	
	var category			  =   jQuery.trim($("input[name='category']").val());
	var title	    	  	  =	  jQuery.trim($("#title").val());
	var keyword		    	  =   jQuery.trim($("#keyword").val());
	var description  		  =	  jQuery.trim($("#description").val());
	var maindescription  	  =	  jQuery.trim($("#maindescription").val());
	var links  		          =	  jQuery.trim($("input[name='links']").val());
	var mainselect 		      =	  jQuery.trim($("#mainselect").val());
	var status   		      =	  jQuery.trim($("#status").val());
    var editid  		      =	  jQuery.trim($("input[name='editid']").val());
	var site_url              = jQuery("meta[name='siteurl']").attr("content");
	var checkboxes			  =	  "";
	$.post("ajax_all_add_edits.php" , {command:'addMainCategory',category:category,title:title,keyword:keyword,
	description:description,links:links,mainselect:mainselect,status:status,editid:editid,maindescription:maindescription} , function(data,status)	{
		if(jQuery.trim(data) == "1"){
			 window.location=site_url+"all-category.php";
		}
	});	
  }
}
