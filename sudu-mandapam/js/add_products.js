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
				producattype  	 : { required : true  } ,
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
			    producattype  	         : { required : 'please select the producat type.' },
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
	var overalldiscount    =	  jQuery.trim($("input[name='overalldiscount']").val());
	// alert(overalldiscount);
	var price  		          =	  jQuery.trim($("input[name='price']").val());
	var discount  		      =	  jQuery.trim($("input[name='discount']").val());
	var discount_percentage   =	  jQuery.trim($("input[name='discount_percentage']").val());
	var grmorKg               =	  jQuery.trim($("input[name='grmorKg']").val());
	var brand   		      =	  jQuery.trim($("#brand").val());
	var color   		      =	  jQuery.trim($("#color").val());
	var status   		      =	  jQuery.trim($("#status").val());
	var productdescs   	      =	  jQuery.trim($("#productdescs").val());
    var editid  		      =	  jQuery.trim($("input[name='editid']").val());
    var producattype          =	  jQuery.trim($("#producattype").val());
	var site_url              = jQuery("meta[name='siteurl']").attr("content");
	
	var price1  		          =	  jQuery.trim($("input[name='price1']").val());
	var discount1  		          =	  jQuery.trim($("input[name='discount1']").val());
	var discount_percentage1      =	  jQuery.trim($("input[name='percentages1']").val());
	var grmorKg1                  =	  jQuery.trim($("input[name='grmorKg1']").val());

	var price2  		          =	  jQuery.trim($("input[name='price2").val());
	var discount2  		          =	  jQuery.trim($("input[name='discount2']").val());
	var discount_percentage2      =	  jQuery.trim($("input[name='percentages2']").val());
	var grmorKg2                  =	  jQuery.trim($("input[name='grmorKg2']").val());
	
	var price3  		          =	  jQuery.trim($("input[name='price3']").val());
	var discount3  		          =	  jQuery.trim($("input[name='discount3']").val());
	var discount_percentage3      =	  jQuery.trim($("input[name='percentages3']").val());
	var grmorKg3                  =	  jQuery.trim($("input[name='grmorKg3']").val());
	
	var price4  		          =	  jQuery.trim($("input[name='price4']").val());
	var discount4  		          =	  jQuery.trim($("input[name='discount4']").val());
	var discount_percentage4      =	  jQuery.trim($("input[name='percentages4']").val());
	var grmorKg4                  =	  jQuery.trim($("input[name='grmorKg4']").val());
	
	
	$.post("ajax_all_add_edits.php" , {command:'addProduct',category:category,title:title,keyword:keyword,
						description:description,links:links,overalldiscount:overalldiscount,price:price,discount:discount,discount_percentage:discount_percentage,
                        brand:brand,color:color,status:status,editid:editid,productname:productname,
                        productdescs:productdescs,producattype:producattype,price1:price1,discount1:discount1,discount_percentage1:discount_percentage1,price2:price2,discount2:discount2,discount_percentage2:discount_percentage2,price3:price3,discount3:discount3,discount_percentage3:discount_percentage3,price4:price4,discount4:discount4,discount_percentage4:discount_percentage4,grmorKg:grmorKg,grmorKg1:grmorKg1,grmorKg2:grmorKg2,grmorKg3:grmorKg3,grmorKg4:grmorKg4} , function(data,status)	{
		if(jQuery.trim(data) == "1"){
			 window.location=site_url+"all-product-list.php";
		}
	});	
  }
}
