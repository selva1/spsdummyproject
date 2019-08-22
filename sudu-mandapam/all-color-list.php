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
                                  All color  List 
                                   <a href="add_color.php"><button type="button" class="btn btn-danger" style="float: right; margin-right: 10px;">Add color</button></a> 
						    
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
<script src="js/pagenation_all_color_list.js" type="text/javascript"></script>
 <script src="js/Director/app.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
var let_search="";
var search_val="";
var str_check="";
load(1,search_val,str_check,let_search);
});
</script>

</body>
</html>