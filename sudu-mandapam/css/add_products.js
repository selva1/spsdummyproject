// JavaScript Document
$(document).ready(function() {
	$("#addcates").validate(
		{ 
			rules: 
			{ 	
			    mainselect		 : { required : true } ,
				subcategory		 : { required : true } ,
				price    		 : { required : true } ,
     			title   		 : { required : true } ,
				keyword   	     : { required : true  } ,
				description   	 : { required : true  } ,
				links        	 : { required : true  } ,
				brand        	 : { required : true  } ,
				color        	 : { required : true  } ,
				productdescs  	 : { required : true  } ,
				status        	 : { required : true  } 
			},
			messages:
			{
				mainselect		 : { required : 'please select category type .' } ,
				subcategory		 : { required : 'product name is required.' } ,
				price            : { required : 'price is required.' } ,
				title		     : { required : 'meta title is required.' } ,
				keyword      	 : { required : 'meta keyword is required.' } ,
			    description  	 : { required : 'meta description  is required.' },
			    links  	         : { required : 'product link  is required.' }, 
			    brand  	         : { required : 'please select the brand.' },
			    color  	         : { required : 'please select the color.' },
			    productdescs     : { required : 'please enter product description.' },
			    status  	     : { required : 'category status  is required.' } 				
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
  	
	var category			  =   jQuery.trim($("#mainselect").val());
	var productname			  =   jQuery.trim($("input[name='subcategory']").val());
	var title	    	  	  =	  jQuery.trim($("#title").val());
	var keyword		    	  =   jQuery.trim($("#keyword").val());
	var description  		  =	  jQuery.trim($("#description").val());
	var links  		          =	  jQuery.trim($("input[name='links']").val());
	var price  		          =	  jQuery.trim($("input[name='price']").val());
	var brand   		      =	  jQuery.trim($("#brand").val());
	var color   		      =	  jQuery.trim($("#color").val());
	var status   		      =	  jQuery.trim($("#status").val());
    var editid  		      =	  jQuery.trim($("input[name='editid']").val());
	var site_url              = jQuery("meta[name='siteurl']").attr("content");
	var checkboxes			  =	  "";
	$.post("ajax_all_add_edits.php" , {command:'addProduct',category:category,title:title,keyword:keyword,
	description:description,links:links,price:price,brand:brand,color:color,status:status,editid:editid,productname:productname} , function(data,status)	{
		if(jQuery.trim(data) == "1"){
			 window.location=site_url+"all-product-list.php";
		}
	});	
  }
}
