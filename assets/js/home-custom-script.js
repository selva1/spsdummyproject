function autoRedirectHome(){
	setTimeout(
  function() 
  {
    //do something special
    window.location="http://www.spsbrands.com/";
  }, 15000);
}

function searchFilterFunctionsHome(){
	
	var headersearch = $('#headersearch').val();
	var catList = $('#catList').val();
	
	var url = $("#ajaxSiteUrl").val();
	$.ajax({
			type: "POST",
			url:'common_ajax.php',
			data:'ajax=1&ajax_task=searchHeaderFilter&catList='+catList+'&search='+headersearch,
			success:function(data){
				if(data=="0"){
					$('#filterSearchList_home').hide();
					return false;
				}
				if(data ==""){
				$('#filterSearchList_home').html('');
				}else if(data !=""){
					$('#filterSearchList_home').show();
					$('#filterSearchList_home').html(data);
				}
			}
		})
		
}