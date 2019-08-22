// JavaScript Document
$(document).ready(function() {
    $("#addMobileImage").validate(
        {
            rules:
            {
                home_cat_type		     : { required : true } ,
                home_cat_select    		 : { required : true } ,
                image       : { required : true },
                status        	 : { required : true  }


            },
            messages:
            {
                home_cat_type		     : { required : 'select category type.' } ,
                home_cat_select		 : { required : 'select category.'},
                image    		 : { required : 'image  is required.' } ,
                status  	     : { required : 'brand status  is required.' }
            },
            submitHandler: function(form)
            {
                $(form).find(":btnMobileImage").attr("disabled", true).attr("value","Submitting...");
                form.submit();
            }
        });

});

function SaveInfo() {
    if($("#addMobileImage").valid()) {

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
