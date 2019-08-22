  /*jQuery("#list-catg").click(function(e){
    e.preventDefault(e);
    jQuery(".aa-product-catg").addClass("list");
  });
  jQuery("#grid-catg").click(function(e){
    e.preventDefault(e);
    jQuery(".aa-product-catg").removeClass("list");
  });*/

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
	   var seo_1 = $("#seo_1").val();
	   var seo_2 = $("#seo_2").val();
	   var seo_3 = $("#seo_3").val();
	   
	var act = $('.Actives').attr('id');
	   
		$.ajax({
			type: "POST",
			url:'get_category_lists.php',
			data:'ajax=1&seo_1='+seo_1+'&seo_2='+seo_2+'&seo_3='+seo_3+'&ajax_task=get_category_list&page='+page+'&search_val='+act+'&orderNumbers='+str_check+'&searchd='+let_search+'&allcolorVals='+type_val+'&allBandVals='+indst_val,
			success:function(data){
				document.body.scrollTop = document.documentElement.scrollTop = 0;
				$("#loadCategorys").html(data).fadeIn('slow');
				
				$("#loader").fadeOut('slow');
			}
		})
	}
	
function fefine_search(){
var refinesearch = document.getElementById("refinesearch").value;
	$("#loader").fadeIn('slow');
		$.ajax({
			url:'get_category_lists.php?action=ajax&search_val='+refinesearch,
			success:function(data){
                document.body.scrollTop = document.documentElement.scrollTop = 0;
				$("#loadCategorys").html(data).fadeIn('slow');
				$("#loader").fadeOut('slow');
			}
		})

}

/*function fliterColorList(colorId){
	var seo_1 = $("#seo_1").val();
	var seo_2 = $("#seo_2").val();
	var seo_3 = $("#seo_3").val();
	$.ajax({
			type: "POST",
			url:'get_category_lists.php',
			data:'ajax=1&seo_1='+seo_1+'&seo_2='+seo_2+'&seo_3='+seo_3+'&ajax_task=get_category_list&colorId='+colorId,
			success:function(data){
				$("#loadCategorys").html(data).fadeIn('slow');
				$("#loader").fadeOut('slow');
			}
		})
	
}
*/
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

var seo_1 = $("#seo_1").val();
var seo_2 = $("#seo_2").val();
var seo_3 = $("#seo_3").val();

    var fromPrice=$("#hdnFromPrice").val();
    var toPrice=$("#hdnToPrice").val();

$.ajax({
		type: "POST",
		url:'get_category_lists.php',
		data:'ajax=1&seo_1='+seo_1+'&seo_2='+seo_2+'&seo_3='+seo_3+'&ajax_task=get_category_list&allBandVals='+allBandVals+'&allcolorVals='+allcolorVals+'&sortBy='+sortBy+'&orderNumbers='+orderNumbers+'&fromPrice='+fromPrice+'&toPrice='+toPrice,
		success:function(data){
            /*$('html, body').animate({
                scrollTop: $("#loadCategorys").offset().top
            });*/
            document.body.scrollTop = document.documentElement.scrollTop = 0;
            $("#loadCategorys").html(data).fadeIn('slow');
			$("#loader").fadeOut('slow');
		}
	})
           
}

/*function addToCart(productId){
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
					 
					$('.cartcoutview').html( parseInt(data));
					//$('#dgg1').html('10');
					cartheaderList();
				}
			}
		})
}
*/

		function addToCart(productId){
			
			var priceid = $("#multiselect_"+productId).val();
			var product_qty = $("#product_qty"+productId).val();
			
	$.ajax({
			type: "POST",
			url:'common_ajax.php',
			data:'ajax=1&ajax_task=addTocart&productId='+productId+'&qut='+product_qty+'&priceid='+priceid,
			success:function(data){
				if(data !="0"){
					// document.getElementById('SavaCartval_'+productId).style.display="block";	
					// setTimeout(function(){
					// document.getElementById('SavaCartval_'+productId).style.display="none";
					// }, 3000);
					$('.cartcoutview').show();
					 
					$('.cartcoutview').html( parseInt(data));
					//$('#dgg1').html('10');
					cartheaderList();
				}
			}
		})
}


function cartheaderList(){
	var url = $("#ajaxSiteUrl").val();
	$.ajax({
	type: "POST",
	url:'common_ajax.php',
	data:'ajax=1&ajax_task=headerCartDesign',
	success:function(data){
		if(data=="0"){
			$('#filterSearchList').hide();
			return false;
		}
		if(data ==""){
		$('.aa-cartbox-summary').html('');
		//$('.aa-cartbox-summary').hide();
		}else if(data !=""){
			//$('.aa-cartbox-summary').show();
			$('.aa-cartbox-summary').html(data);
		}
	}
	})
}
cartheaderList();

function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
/* for hiding sub menus */
$('.sub-menu').hide();
$(".mobile-menu li:has(ul)").click(function(){
$("ul",this).toggle('slow');
});

function subscribe(){
	
	var subemais = document.getElementById('subemais').value;
	if(subemais==""){
		$('#Submsg').html('please enter email address');
		return false;
	}
	//var url = $("#ajaxSiteUrl").val();
	$.ajax({
			type: "POST",
			url:'common_ajax.php',
			data:'ajax=1&ajax_task=subscribeEmail&subemais='+subemais,
			success:function(data){
				if(data =="1"){
					$('#Submsg').html('Thank you! You have successfully subscribed to our newsletter...');
					setTimeout(function(){
					$('#Submsg').html('');
					}, 3000);
				}else{
					$('#Submsg').html(' Your email already subscribed with us...');
					setTimeout(function(){
					$('#Submsg').html('');
					}, 3000);
				}
			}
		})
		
}