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
                                  All Products List

								  <a href="add_products.php"><button type="button" class="btn btn-danger" style="float: right; margin-right: 10px;">Add Products</button></a>
								<select class="form-control m-b-10 product_sel" id="producattype1" name="producattype1" style="" onchange="fefine_search();">
									<option value="">select category name</option>
									<?php 
									$categoryList = categoryParentChildTreeAddProd(); 
									foreach($categoryList as $key => $value){ 
									if($editVal['cat_id']==$value['category_id']){
									$selected= "selected=''";
									}else{
									$selected ="";
									}
									?>

									<option value="<?php  echo $value['category_id']; ?>" <?php echo $selected; ?>><?php echo $value['name']; ?></option>
									<?php }?>
								</select>
								<select class="form-control m-b-10 product_sel" id="selectmainselect" name="selectmainselect" style="" onchange="fefine_search1();">
								<option value="">select category type</option>

								<?php 
								$conn=dbconnection();
								$stmt ="SELECT `id`, `main_cat_names`, `main_cat_status` FROM `tbl_category_type` WHERE 1";
								$vid_comment =  mysqli_query($conn,$stmt);
								while ($row = mysqli_fetch_assoc($vid_comment)){
								                                        
								?>
								<?php 

								if($row['id']==$editVal['cat_type_id']){
								$statusActivate ="selected=selected";
								}else{
								$statusActivate ="";
								}
								?>
								<option value="<?php echo $row['id'];?>" <?php echo $statusActivate; ?>><?php echo $row['main_cat_names'];?></option>
								<?php  } //} ?>
								</select>
                                 <input type="text" class="form-control m-b-10 product_sel" placeholder="Search by product name..." id="productSearch" name="productSearch" onKeyUp="fefine_search();">

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script src="js/jquery.min.js" type="text/javascript"></script>
<!-- jQuery UI 1.10.3 -->
<script src="js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
<!-- Bootstrap -->
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/pagenation_all_product_list.js" type="text/javascript"></script>
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