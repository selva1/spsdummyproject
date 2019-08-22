$(document).ready(function()
{
	$("#loding1").hide();
	$("#loding2").hide();
	
	$("#loding2").show();
		var id=$('#mainselect').val();
		var maincatids = document.getElementById('maincatids').value;
		var dataString = 'id='+ id+'&maincatid='+ maincatids;
	
		$.ajax
		({
			type: "POST",
			url: "get_main_category_dropdown_name.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
				$("#loding2").hide();
				$("#category").html(html);
			} 
		});
	
	
	/*$(".country").change(function()
	{
		$("#loding1").show();
		var id=$(this).val();
		var dataString = 'id='+ id;
		$(".state").find('option').remove();
		$(".city").find('option').remove();
		$.ajax
		({
			type: "POST",
			url: "get_state.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
				$("#loding1").hide();
				$(".state").html(html);
			} 
		});
	});*/
	
	
	$("#mainselect").change(function()
	{
		$("#loding2").show();
		var id=$(this).val();
		var maincatids = document.getElementById('maincatids').value;
		var dataString = 'id='+ id+'&maincatid='+ maincatids;
	
		$.ajax
		({
			type: "POST",
			url: "get_main_category_dropdown_name.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
				$("#loding2").hide();
				$("#category").html(html);
			} 
		});
	});
	
});