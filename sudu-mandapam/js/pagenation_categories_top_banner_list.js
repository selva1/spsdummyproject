function load(page,serch_box_val,str_check,let_search,type_vals,ids_indst){
		if(typeof(type_vals)=="undefined"){
			var type_val ="";
		} else {
			var type_val =type_vals;
		}
		if(typeof(ids_indst)=="undefined"){
			var indst_val ="";
		} else {
			var indst_val =ids_indst;
		}
	 $("#loader").fadeIn('slow');
		$.ajax({
			url:'get_home_categories_top_banner_list.php?action=ajax&page='+page+'&search_val='+serch_box_val+'&str_check_box='+str_check+'&searchd='+let_search+'&type_val='+type_val+'&ids_indst='+indst_val,
			success:function(data){
				$("#outer_div").html(data).fadeIn('slow');
				$("#loader").fadeOut('slow');
			}
		})
	}
	
function fefine_search(){
var refinesearch = document.getElementById("refinesearch").value;
	$("#loader").fadeIn('slow');
		$.ajax({
			url:'get_home_categories_top_banner_list.php?action=ajax&search_val='+refinesearch,
			success:function(data){
				$("#outer_div").html(data).fadeIn('slow');
				$("#loader").fadeOut('slow');
			}
		})

}

function homeSliders(ids){
	
		var ischecked= $("#homeBrandsSlider_"+ids).is(':checked');
		//alert(ischecked);
		/*if(!ischecked)
		alert('uncheckd ' + $("#homeBrandsSlider_"+ids).val());*/
	
		$.ajax({
			url:'get_home_categories_top_banner_list.php?action=homeSlider&ids='+ids+'&ischecked='+ischecked,
			success:function(data){
				//$("#outer_div").html(data).fadeIn('slow');
				//$("#loader").fadeOut('slow');
			}
		})
}
function deletecategorytopbanner(delId){
	var r = confirm("Are sure to delete image.");
	if (r == true) {
		x = "1";
	} else {
		x = "2";
	}
	if(x=="1"){
       var site_url              = jQuery("meta[name='siteurl']").attr("content");
		$.post("ajax_all_add_edits.php" , {command:'deleteTopBanner',Ids:delId} , function(data,status)	{
			if(jQuery.trim(data) == "1"){
				window.location=site_url+"all-categories-top-banner-list.php";
            }
		});
	}

}
