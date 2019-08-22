<?php 
include "include/function.php";
isNotLogin();
$conn = dbconnection();
$edit_id = mysqli_real_escape_string($conn,$_GET['editId']);
/*if(isset($edit_id)){
	
}else {
	
}*/
$editVal = editProductValue($edit_id);
$prices = sigleprice($edit_id);
$discounts = getDiscounts($edit_id);
?>
<!DOCTYPE html>
<html>
    <!-- header style start-->
<?php include "header_style.php"; ?>
<!-- header style start-->
    <body class="skin-black">
		<!-- header menu start-->
		<?php include "header_menu.php"; ?>
		<!-- header menu  end-->
        <div class="wrapper row-offcanvas row-offcanvas-left">
			<!-- header left start-->
			 <?php include "header_left.php"; ?>
			 <!-- header left end-->

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                      <div class="col-lg-12">
                          <section class="panel">
                              <header class="panel-heading">
                                  Product Full Details
                                  <a href="add-product-specification.php?edit_id=<?php echo $edit_id?>"><button type="button" class="btn btn-danger" style="float: right; margin-right: 10px;">Add Product Specification</button></a>

                              </header>
                               <div class="panel-body">
                               <div class="col-lg-8">
                                  <form class="form-horizontal" role="form" id="addcates" name="addcates">
                                  <div class="form-group">
                                          <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">category type : </label>
                                          <div class="col-lg-8">
                                                  
                                                 <?php 
                                                 $conn=dbconnection();
                                                 $typID = $editVal['cat_type_id'];
                                                $stmt ="SELECT `id`, `main_cat_names`, `main_cat_status` FROM `tbl_category_type` WHERE id='$typID' ";
                                                 $vid_comment =  mysqli_query($conn,$stmt);
                                                 while ($row = mysqli_fetch_assoc($vid_comment)){
												                                                
                                                  ?>
                                                   <?php 
                                                  
                                                   ?>
                                                 <?php echo $row['main_cat_names'];?>
                                                  <?php  } //} ?>
                                          </div>
                                      </div>
                                    <div class="form-group">
                                          <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">category name : </label>
                                          <div class="col-lg-8">
                                             
													<?php 
													$categoryList = categoryParentChildTreeAddProd(); 
													foreach($categoryList as $key => $value){ 
													if($editVal['cat_id']==$value['category_id']){
													echo $value['name']; 
													}else{
													$selected ="";
													}
													?>

													
													<?php }?>
                                              
                                              <p class="help-block"></p>
                                          </div>
                                      </div>
                                       <div class="form-group">
                                          <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">product name : </label>
                                          <div class="col-lg-8">
                                              <?php echo $editVal['Title']; ?>
                                              <p class="help-block"></p>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">product alias name : </label>
                                          <div class="col-lg-8">
                                             <?php echo $editVal['product_alis_link']; ?>
                                              <p class="help-block"></p>
                                          </div>
                                      </div>
                                       <div class="form-group">
                                          <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">product price :</label>
                                          <div class="col-lg-8">
                                             Rs <?php echo $prices; ?>.00
                                             <p class="help-block"></p>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">discount amount:</label>
                                          <div class="col-lg-8">
                                              Rs <?php echo $discounts['discount_amount']; ?>.00
                                              <p class="help-block"></p>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">discount percentage :</label>
                                          <div class="col-lg-8">
                                              <?php echo $discounts['discount_percentage']; ?>%
                                              <p class="help-block"></p>
                                          </div>
                                      </div>
                                      
                                     
                                      <div class="form-group">
                                          <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">product brand : </label>
                                          <div class="col-lg-8">
                                                 <?php 
                                                 $conn=dbconnection();
                                                $stmtbrand = $conn->prepare("SELECT `id`, `brand` FROM `tbl_brands` WHERE 1");
												$stmtbrand->execute();
												$stmtbrand->store_result();
												$stmtbrand->bind_result($id,$brand);
                                                 while ($rowbrand = $stmtbrand->fetch()){
												   if($id==$editVal['Brand']){
												   	echo $brand;
												   } else{
												   	$selected="";
												   }                                            
                                                  ?>
                                                  
                                              
                                                  <?php  } //} ?>
                                              
                                              
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">product color : </label>
                                          <div class="col-lg-8">

                                                 <?php 
                                                 $conn=dbconnection();
                                                $stmtColor = $conn->prepare("SELECT `id`, `color` FROM `tbl_colors` WHERE 1");
												$stmtColor->execute();
												$stmtColor->store_result();
												$stmtColor->bind_result($id,$color);
                                                 while ($rowcolor = $stmtColor->fetch()){
												if($id==$editVal['Color']){
												echo $color;
												} else{
												$selected="";
												}                                            
                                                  ?>
                                                  
                                               
                                                  <?php  } //} ?>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="inputPassword1" class="col-lg-4 col-sm-4 control-label">	product meta title : </label>
                                          <div class="col-lg-8">
                                              <?php echo $editVal['meta_title']; ?>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="inputPassword1" class="col-lg-4 col-sm-4 control-label">	product meta keyword : </label>
                                          <div class="col-lg-8">
                                             <?php echo $editVal['meta_keyword']; ?>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="inputPassword1" class="col-lg-4 col-sm-4 control-label">product	meta description : </label>
                                          <div class="col-lg-8">
                                            <?php echo $editVal['meta_description']; ?>
                                          </div>
                                      </div>
                                    <!--  <div class="form-group">
                                           <label for="inputPassword1" class="col-lg-4 col-sm-4 control-label">Product main image</label>
                                          <div class="col-lg-8">
                                          	<input type="file" id="exampleInputFile">
                                          </div>
                                       </div>-->
                                       <div class="form-group">
                                          <label for="inputPassword1" class="col-lg-4 col-sm-4 control-label">	stock status :</label>
                                          <div class="col-lg-8">
                                            
                                                  <?php 
                                                   if($editVal['product_status']=="0"){
												   	$statusActivate ="selected=selected";
												   	echo "In stock";
												   }else if($editVal['product_status']=="1") {
												   	$statusDeactivate ="selected=selected";
												   	echo "no stock";
												   }else{
												   	$statusActivate ="";
												   	$statusDeactivate ="";
												   }
                                                   ?>
                                          </div>
                                      </div>
                                      
                                      <div class="form-group">
                                          <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">product description :</label>
                                          <div class="col-lg-8">
											
    <?php echo $editVal['Description']; ?>
                                              <!--<input type="text" class="form-control" id="prodescription" name="prodescription" placeholder="product price" value="<?php echo $editVal['cat_alias']; ?>">
                                              <p class="help-block"></p>-->
                                          </div>
                                      </div>
                                  </form>
                              </div>
                              </div>
                          </section>
                         
                      </div>
                    </div><!--row1-->
                   

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
               <!-- header left start-->
                     <?php include "footer.php"; ?>
                     <!-- header left end-->
        </div><!-- ./wrapper -->
        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="css/wysiediercss.css"></link>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Director App -->

        <script src="js/Director/app.js" type="text/javascript"></script>
        <script type="text/javascript" src="js/jquery.validate.js" language="javascript"></script>
        <script src="js/add_products.js" type="text/javascript"></script>
        <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.js"></script>
        <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<script>
  $('.textarea').wysihtml5({
    toolbar: {
      fa: true
    }
  });
</script>
<style>
	#button_save .btn {
	  padding: 10px 27px !important;
	  font-size: 18px !important;
	}
	.form-group .col-lg-8 {
  margin-top: 7px;
}
</style>
    </body>
</html>
