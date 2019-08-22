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
		if(typeof(str_check)=="undefined"){
			var str_check ="";
		} else {
			 var str_check = $("#orderNumbers").val();
		}
		
	 $("#loader").fadeIn('slow');
	   var search = $("#searchValue").val();
	   var cattype = $("#cattype").val();
	   var seo_3 = $("#seo_3").val();
	   
	var act = $('.Actives').attr('id');
	   
		$.ajax({
			type: "POST",
			url:'get_search_filter_design.php',
			data:'ajax=1&search='+search+'&catList='+cattype+'&seo_3='+seo_3+'&ajax_task=search_filter_design&page='+page+'&search_val='+act+'&orderNumbers='+str_check+'&searchd='+let_search+'&allcolorVals='+type_val+'&allBandVals='+indst_val,
			success:function(data){
				document.body.scrollTop = document.documentElement.scrollTop = 0;
				$("#searchfilterDesingesign").html(data).fadeIn('slow');
				
				$("#loader").fadeOut('slow');
			}
		})
	}
	
function fefine_search(){
var refinesearch = document.getElementById("refinesearch").value;
	$("#loader").fadeIn('slow');
		$.ajax({
			url:'get_search_filter_design.php?action=ajax&search_val='+refinesearch,
			success:function(data){
				document.body.scrollTop = document.documentElement.scrollTop = 0;
				$("#loadCategorys").html(data).fadeIn('slow');
				$("#loader").fadeOut('slow');
			}
		})

}


function FilterCheckbox(){
var allBandVals = [];
$('.brandvalues:checked').each(function () {
    allBandVals.push($(this).val());
});
//alert(allBandVals);

var allcolorVals = [];
$('.colorvalues:checked').each(function () {
    allcolorVals.push($(this).val());
});
//alert(allcolorVals);

var sortBy = $("#sortBy").val();
var orderNumbers = $("#orderNumbers").val();
//alert(orderNumbers);

var search = $("#searchValue").val();
var cattype = $("#cattype").val();
var seo_3 = $("#seo_3").val();
	var fromPrice=$("#hdnFromPrice").val();
	var toPrice=$("#hdnToPrice").val();
$.ajax({
		type: "POST",
		url:'get_search_filter_design.php',
		data:'ajax=1&search='+search+'&catList='+cattype+'&seo_3='+seo_3+'&ajax_task=search_filter_design&allBandVals='+allBandVals+'&allcolorVals='+allcolorVals+'&sortBy='+sortBy+'&orderNumbers='+orderNumbers+'&fromPrice='+fromPrice+'&toPrice='+toPrice,
		success:function(data){
            document.body.scrollTop = document.documentElement.scrollTop = 0;
			$("#searchfilterDesingesign").html(data).fadeIn('slow');
			$("#loader").fadeOut('slow');
		}
	})
           
}

function addToCart(productId){
	$.ajax({
			type: "POST",
			url:'common_ajax.php',
			data:'ajax=1&ajax_task=addTocart&productId='+productId,
			success:function(data){
				if(data !="0"){
					document.getElementById('SavaCartval_'+productId).style.display="block";	
					setTimeout(function(){
					document.getElementById('SavaCartval_'+productId).style.display="none";
					}, 3000);
					$('.cartcoutview').show();
					$('.cartcoutview').html(data);
					//$('#dgg1').html('10');
					cartheaderList();
				}
			}
		})
}




/*function searchFilterscontents(){
	var qut = "";
	var url = "";
	var productId = "";
	var ajaxSiteUrl = $("#ajaxSiteUrl").val();
	var searchs  = $("#ajaxSiteUrl").val();
	var catList = $("#ajaxSiteUrl").val();
	$.ajax({
		type: "POST",
		url:'get_search_filter_design.php',
		data:'ajax=1&ajax_task=search_filter_design&search='+searchs+'&catList='+catList,
		
		success:function(data){
			
			$("#searchfilterDesingesign").html(data).fadeIn('slow');
			
			$("#loader").fadeOut('slow');
		}
	})
	}
	searchFilterscontents();*/