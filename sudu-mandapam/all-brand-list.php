<?php 
include "include/function.php";
isNotLogin();
?>
<!DOCTYPE html>
<html>
<!-- header style start-->
<?php include "header_style.php"; ?>
<link rel="stylesheet" type="text/css" href="css/search-page-style.css" />
<!-- header style start-->
      <body class="skin-black">
                <!-- header menu start-->
                <?php include "header_menu.php"; ?>
                <!-- header menu  end-->
                <div class="wrapper row-offcanvas row-offcanvas-left">
                     <!-- header left start-->
                     <?php include "header_left.php"; ?>
                     <!-- header left end-->
                    <aside class="right-side">
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                    
                        <div class="col-md-12">
                            <section class="panel">
                              <header class="panel-heading">
                                  All Brands List 
						     <a href="add_brands_list.php"><button type="button" class="btn btn-danger" style="float: right;">Add brands</button></a> 
                            </header>
                            <div class="col-md-12" id="loader"  >
								<div class="col-md-12">
								<div class="stat">
								<div style="color:#fa8564" class="stat-icon">
								<i class="fa fa-refresh fa-spin fa-3x stat-elem"></i>
								</div>
								<h5 class="stat-info">Procesing....</h5>
								</div>
								</div>
                            </div>
                             <div class="panel-body table-responsive" id="outer_div">
                             </div>	
		              </section>


          </div>
        </div>
                    
        </section><!-- /.content -->
        <?php include_once "footer.php";?>
    </aside><!-- /.right-side -->

</div><!-- ./wrapper -->
<!-- jQuery 2.0.2 -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script src="js/jquery.min.js" type="text/javascript"></script>
<!-- jQuery UI 1.10.3 -->
<script src="js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
<!-- Bootstrap -->
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/pagenation_all_brand_list.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/file-input.css">
 <script src="js/Director/app.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
var let_search="";
var search_val="";
var str_check="";
load(1,search_val,str_check,let_search);
});
</script>
 <script>
        function deleteImgs(delId){
			var r = confirm("Are sure to delete image.");
			if (r == true) {
			x = "1";
			} else {
			x = "2";
			} 
			if(x=="1"){
			var delIdsdds =delId;
			//alert(actionProcess);
			var site_url              = jQuery("meta[name='siteurl']").attr("content");
			$.post("get_delete_brand_img.php" , {command:'deletebrandImg',delId:delId} , function(data,status)	{
			if(jQuery.trim(data) == "true"){
			 window.location=site_url+"all-brand-list.php";
			}
			});	
	 }
		
	}
 
 function CatLised_values(brandIds){
 	  var catsd = [];
        $.each($('#selcatcat'+brandIds+' :selected'), function(){            
            catsd.push($(this).val());
        });
       var catsd =  catsd.join(", ");
       var idsz = [];
        $.each($('#selcat'+brandIds+' :selected'), function(){            
            idsz.push($(this).val());
        });
       var idsz =  idsz.join(", ");
   
	$.post("get_second_vertical_home_slider.php" , {command:'catVals',catsd:catsd,idsz:idsz,brandIds:brandIds} , function(data,status)	{
	if(jQuery.trim(data) == "1"){
		document.getElementById("errorMSG"+brandIds).innerHTML="successfully updated...";
		
		setTimeout(
		function() 
		{
			document.getElementById("errorMSG"+brandIds).style.display="none";
		}, 5000);
	}
	});	
 }       	
        	
 </script>
<style>.file-preview-frame {
    border: 1px solid #ddd;
    box-shadow: 1px 1px 5px 0 #a2958a;
    display: table;
    float: left;
    height: 160px;
    margin: 8px 8px 8px 38px;
    padding: 13px;
    position: relative;
    text-align: center;
    vertical-align: middle;
}

.kv-file-content {
     height: 120px;
    margin-bottom: 9px;
    width: 270px;
}
.file-footer-caption {
	width: 184px;
	}
	.errorMSG{
		color:red;
	}
</style>

</body>
</html>