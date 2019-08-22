// JavaScript Document
$(document).ready(function() {
    $("#addgift").validate(
        {
            rules:
            {
                gift_voucher_name		 : { required : true } ,
                gift_voucher_amount        	 : { required : true  },
                expiry_date        	 : { required : true  }
            },
            messages:
            {
                gift_voucher_name		 : { required : 'name is required.' } ,
                gift_voucher_amount  	     : { required : 'voucher amount  is required.' },
                expiry_date  	     : { required : 'expiry date  is required.' }
            },
            submitHandler: function(form)
            {
                $(form).find(":button_save").attr("disabled", true).attr("value","Submitting...");
                form.submit();
            }
        });

});

function SaveGiftVoucher() {
    if($("#addgift").valid()) {

        var gift_voucher_name			  =   jQuery.trim($("input[name='gift_voucher_name']").val());
        var gift_voucher_amount			  =   jQuery.trim($("input[name='gift_voucher_amount']").val());
        var expiry_date			  =   jQuery.trim($("input[name='expiry_date']").val());
        var editid  		      =	  jQuery.trim($("input[name='editid']").val());
        var site_url              = jQuery("meta[name='siteurl']").attr("content");

        $.post("ajax_all_add_edits.php" , {command:'addGiftVoucher',gift_voucher_name:gift_voucher_name,
            gift_voucher_amount:gift_voucher_amount,expiry_date:expiry_date,
            status:status,editid:editid} , function(data,status)	{
            if(jQuery.trim(data) == "1"){
                window.location=site_url+"all-gift-voucher.php";
            }
        });
    }
}
