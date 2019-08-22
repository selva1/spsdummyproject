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
		if(typeof(serch_box_val)=="undefined"){
			var serch_box_val ="";
		} else {
			var serch_box_val = "";
		}
		if(typeof(str_check)=="undefined"){
			var str_check ="";
		} else {
			var str_check = "";
		}
	 $("#loader").fadeIn('slow');
		$.ajax({
			url:'get_all_color_list.php?action=ajax&page='+page+'&search_val='+serch_box_val+'&str_check_box='+str_check+'&searchd='+let_search+'&type_val='+type_val+'&ids_indst='+indst_val,
			success:function(data){
				$("#outer_div").html(data).fadeIn('slow');
				$("#loader").fadeOut('slow');
			}
		})
	}
	
function fefine_search(){
	
var refinesearch = "";
var check = "";
	$("#loader").fadeIn('slow');
		$.ajax({
			url:'get_all_color_list.php?action=ajax&search_val='+refinesearch+'&str_check='+check,
			success:function(data){
				$("#outer_div").html(data).fadeIn('slow');
				$("#loader").fadeOut('slow');
			}
		})

}

function fefine_search1(){
	
var refinesearch = "";
var producattype1 ="";
	$("#loader").fadeIn('slow');
		$.ajax({
			url:'get_all_color_list.php?action=ajax&str_check='+refinesearch+'&search_val='+producattype1,
			success:function(data){
				$("#outer_div").html(data).fadeIn('slow');
				$("#loader").fadeOut('slow');
			}
		})

}

function deleteColor(Ids){
	var site_url              = jQuery("meta[name='siteurl']").attr("content");
		$.post("ajax_all_add_edits.php" , {command:'DeleteColorlist',Ids:Ids} , function(data,status)	{
		if(jQuery.trim(data) == "1"){
			 window.location=site_url+"all-color-list.php";
		}
	});	

}



