// JavaScript Document
$(document).ready(function() {
	$("#addcates").validate(
		{ 
			rules: 
			{ 	
			    pagename		 : { required : true } ,
				page_alias		 : { required : true } ,
				title    		 : { required : true } ,
     			keyword   		 : { required : true } ,
				description   	     : { required : true  } ,
				content   	 : { required : true  } ,
				status        	 : { required : true  } 
			},
			messages:
			{
				pagename		 : { required : 'Page Name cannot be blank .' } ,
				page_alias		 : { required : 'Page alias name is required.' } ,
				title            : { required : 'Meta title is required.' } ,
				keyword		     : { required : 'meta keyword is required.' } ,
				description      	 : { required : 'meta description is required.' } ,
			    content  	 : { required : 'Page content cannot be blank.' },
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
  	
	var pagename			  =   jQuery.trim($("#pagename").val());
	var page_alias			  =   jQuery.trim($("input[name='page_alias']").val());
	var title	    	  	  =	  jQuery.trim($("#title").val());
	var keyword		    	  =   jQuery.trim($("#keyword").val());
	var description  		  =	  jQuery.trim($("#description").val());
	var status   		      =	  jQuery.trim($("#status").val());
	var content   	      =	  jQuery.trim($("#content").val());
    var editid  		      =	  jQuery.trim($("input[name='editid']").val());
	var site_url              = jQuery("meta[name='siteurl']").attr("content");
	
	$.post("ajax_all_add_edits.php" , {command:'addStaticPage',pagename:pagename,page_alias:page_alias,title:title,keyword:keyword,
	description:description,status:status,editid:editid,content:content} , function(data,status)	{
		if(jQuery.trim(data) == "1"){
			 window.location=site_url+"all-static-page-list.php";
		}
	});	
  }
}
