// JavaScript Document
$(document).ready(function() {
	$("#addcates").validate(
		{ 
			rules: 
			{ 	
				subcategory		 : { required : true } ,
				status        	 : { required : true  } 
			},
			messages:
			{
				subcategory		 : { required : 'color name is required.' } ,
			    status  	     : { required : 'color status  is required.' } 				
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
  	
	var colorname			  =   jQuery.trim($("input[name='subcategory']").val());
	var status   		      =	  jQuery.trim($("#status").val());
    var editid  		      =	  jQuery.trim($("input[name='editid']").val());
	var site_url              = jQuery("meta[name='siteurl']").attr("content");
	
	$.post("ajax_all_add_edits.php" , {command:'addColor',colorname:colorname,status:status,editid:editid} , function(data,status)	{
		if(jQuery.trim(data) == "1"){
			 window.location=site_url+"all-color-list.php";
		}
	});	
  }
}
