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
                                  Home Category Top Banner 
						     <a href="add_home_categories_top_banner.php"><button type="button" class="btn btn-danger" style="float: right;">Add home categories top banner</button></a> 
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
<script src="js/pagenation_categories_top_banner_list.js" type="text/javascript"></script>
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
        function deletecategorysliderImgs(delId){
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
			$.post("get_delete_categories_slider_img.php" , {command:'deletebrandImg',delId:delId} , function(data,status)	{
			if(jQuery.trim(data) == "true"){
			 window.location=site_url+"all-categories-slider-img-list.php";
			}
			});	
	 }
		
	} 	
        	
 </script>
<style>.file-preview-frame {
    border: 1px solid #ddd;
    box-shadow: 1px 1px 5px 0 #a2958a;
    display: table;
    float: left;
    height: 160px;
    margin: 8px 8px 8px 32px;
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
.kv-file-content {
    height: auto;
    margin-bottom: 9px;
    width: 100%;
}
</style>

</body>
</html>