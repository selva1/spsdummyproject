// JavaScript Document
$(document).ready(function() {
    $("#addcates").validate(
        {
            rules:
            {
                produ_cat_type		 : { required : true } ,
                main_select		 : { required : true } ,
                specification    		 : { required : true }
            },
            messages:
            {
                produ_cat_type		 : { required : 'please select category type .' } ,
                main_select		 : { required : 'Category is required.' } ,
                specification            : { required : 'specification is required.' }
            },
            submitHandler: function(form)
            {
                $(form).find(":button_add_specification").attr("disabled", true).attr("value","Submitting...");
                form.submit();
            }
        });

});

function addCategorySpecification() {
    if($("#addcates").valid()) {

        var category_type			  =   jQuery.trim($("#produ_cat_type").val());
        var category			  =   jQuery.trim($("#main_select").val());
        var specification	    	  	  =	  jQuery.trim($("#specification").val());
        var editid  		      =	  jQuery.trim($("input[name='editid']").val());
        var site_url              = jQuery("meta[name='siteurl']").attr("content");

        $.post("ajax_all_add_edits.php" ,
            {command:'addSpecification',category:category,specification:specification,editid:editid} , function(data,status)	{
            console.log(data);
                if(jQuery.trim(data) == "1"){
                window.location=site_url+"all-category-specification-list.php";
            }
        });
    }
}
