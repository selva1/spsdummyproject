// JavaScript Document
$(document).ready(function() {
	$("#addcates").validate(
		{ 
			rules: 
			{ 	
				coup_code		 : { required : true } ,
				discount		 : { required :true  },
				start_date		 : { required : true } ,	
				expiry_date		 : { required : true } ,
				status        	 : { required : true  } 
			},
			messages:
			{
				coup_code		 : { required : 'coupon Code is required.' } ,
				start_date		 : { required : 'Start Date is required.'  } ,	
				expiry_date		 : { required : 'Expiry Date is required.'  } ,
			    status  	     : { required : 'status  is required.' } 				
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
  	
  	var coup_code			=	 jQuery.trim($("#coup_code").val());
  	var discount			=jQuery.trim($("#discount").val());
	var start_date			  =   jQuery.trim($("#start_date").val());
	var expiry_date			=jQuery.trim($("#expiry_date").val())
	var status   		      =	  jQuery.trim($("#status").val());
    var editid  		      =	  jQuery.trim($("input[name='editid']").val());
	var site_url              = jQuery("meta[name='siteurl']").attr("content");
	
	$.post("ajax_all_add_edits.php" , {command:'addCoupon',coup_code:coup_code,discount:discount,start_date:start_date,expiry_date:expiry_date,status:status,editid:editid} , function(data,status)	{
		if(jQuery.trim(data) == "1"){
			 window.location=site_url+"coupon-list.php";
		}
	});	
  }
}
