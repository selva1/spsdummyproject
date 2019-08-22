// JavaScript Document
$(document).ready(function() {
	$("#addcates").validate(
		{ 
			rules: 
			{ 	
				ship_cost		 : { required : true } ,
				status        	 : { required : true  } 
			},
			messages:
			{
				ship_cost		 : { required : 'shipping cost is required.' } ,
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
  	
  	var ship_type			=	 jQuery.trim($("#ship_type").val());
	var ship_cost			  =   jQuery.trim($("input[name='ship_cost']").val());
	var status   		      =	  jQuery.trim($("#status").val());
    var editid  		      =	  jQuery.trim($("input[name='editid']").val());
	var site_url              = jQuery("meta[name='siteurl']").attr("content");
	
	$.post("ajax_all_add_edits.php" , {command:'addShippment',ship_type:ship_type,ship_cost:ship_cost,status:status,editid:editid} , function(data,status)	{
		if(jQuery.trim(data) == "1"){
			 window.location=site_url+"all-shippment-list.php";
		}
	});	
  }
}
