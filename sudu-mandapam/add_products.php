<?php 
include "include/function.php";
isNotLogin();
$conn = dbconnection();
$edit_id = mysqli_real_escape_string($conn,$_GET['editId']);
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
                                  Add Product
                                  <?php
                                        if(!empty($editVal)){?>
                                        <a href="add-product-specification.php?edit_id=<?php echo $edit_id?>"><button type="button" class="btn btn-danger" style="float: right; margin-right: 10px;">Add Product Specification</button></a>
                                        <?php }?>
                              </header>
                               <div class="panel-body">
                               <div class="col-lg-8">
                                  <form class="form-horizontal" role="form" id="addcates" name="addcates">
                                  <div class="form-group" style="display:none;">
                                          <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">category type</label>
                                          <div class="col-lg-8">
                                              <select class="form-control m-b-10" id="producattype" name="producattype">
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
												   	$statusActivate ="selected=selected";
												   }
                                                   ?>
                                                  <option value="<?php echo $row['id'];?>" <?php echo $statusActivate; ?>><?php echo $row['main_cat_names'];?></option>
                                                  <?php  } //} ?>
                                              </select>
                                              <p class="help-block"></p>
                                          </div>
                                      </div>
                                    <div class="form-group">
                                          <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">category name</label>
                                          <div class="col-lg-8">
                                              <select class="form-control m-b-10" id="mainselect" name="mainselect">
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
                                              <p class="help-block"></p>
                                          </div>
                                      </div>
                                       <div class="form-group">
                                          <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">product name</label>
                                          <div class="col-lg-8">
                                              <input type="text" class="form-control" id="subcategory" name="subcategory" placeholder="product name" value="<?php echo $editVal['Title']; ?>">
                                              <p class="help-block"></p>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">product alias name</label>
                                          <div class="col-lg-8">
                                              <input type="text" class="form-control" id="links" name="links" placeholder="product alias name" value="<?php echo $editVal['product_alis_link']; ?>">
                                              <p class="help-block"></p>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">Product overall Discount</label>
                                          <div class="col-lg-8">
                                              <input type="text" class="form-control" id="overalldiscount" name="overalldiscount" placeholder="over all discount percentage" value="<?php echo $editVal['overalldiscount']; ?>">
                                              <p class="help-block"></p>
                                          </div>
                                      </div>
                                       <div class="form-group">
                                          <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">product price</label>
                                          <div class="col-lg-2">
                                              <input type="text" class="form-control" id="price" name="price" placeholder="price" value="<?php echo $prices; ?>">
                                              <p class="help-block"></p>
                                          </div>
                                          <div class="col-lg-2">
                                              <input type="text" class="form-control" id="discount" name="discount" placeholder="discount" value="<?php echo $discounts['discount_amount']; ?>">
                                              <p class="help-block"></p>
                                          </div>
                                           <div class="col-lg-2" style="display:none;">
                                              <input type="text" class="form-control" id="discount_percentage" name="discount_percentage" placeholder="percentage" value="<?php echo  $discounts['discount_percentage']; ?>">
                                              <p class="help-block"></p>
                                          </div>
                                          <div class="col-lg-2">
                                              <input type="text" class="form-control" id="grmorKg" name="grmorKg" placeholder="grm or Kg" value="<?php echo  $discounts['weight']; ?>">
                                              <p class="help-block"></p>
                                          </div>
                                      </div>
                                      <!--<div class="form-group">
                                          <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">discount amount</label>
                                          
                                      </div>-->
                                      <!--<div class="form-group">
                                          <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">discount percentage</label>
                                         
                                      </div>-->
                                      
                                      <?php $i="1"; 
                                      for( $i = 1; $i<5; $i++ ) {
                                      	$prices1    = sigleprice1($edit_id,$i);
										$discounts1 = getDiscounts1($edit_id,$i);
                                      ?>
                                      
                                      <div class="form-group">
                                          <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">product price <?php echo $i; ?></label>
                                          <div class="col-lg-2">
                                              <input type="text" class="form-control" id="price<?php echo $i; ?>" name="price<?php echo $i; ?>" placeholder="price" value="<?php echo $prices1; ?>">
                                              <p class="help-block"></p>
                                          </div>
                                           <div class="col-lg-2">
                                              <input type="text" class="form-control" id="discount<?php echo $i; ?>" name="discount<?php echo $i; ?>" placeholder="discount" value="<?php echo $discounts1['discount_amount']; ?>">
                                              <p class="help-block"></p>
                                          </div>
                                           <div class="col-lg-2" style="display:none;">
                                              <input type="text" class="form-control" id="percentages<?php echo $i; ?>" name="percentages<?php echo $i; ?>" placeholder="percentage" value="<?php echo  $discounts1['discount_percentage']; ?>">
                                              <p class="help-block"></p>
                                          </div>
                                          <div class="col-lg-2">
                                              <input type="text" class="form-control" id="grmorKg<?php echo $i; ?>" name="grmorKg<?php echo $i; ?>" placeholder="grm or Kg" value="<?php echo  $discounts1['weight']; ?>">
                                              <p class="help-block"></p>
                                          </div>
                                      </div>
                                      <?php } ?>
                                     <!-- <div class="form-group">
                                          <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">product price 2</label>
                                          <div class="col-lg-2">
                                              <input type="text" class="form-control" id="price2" name="price2" placeholder="price" value="<?php echo $prices; ?>">
                                              <p class="help-block"></p>
                                          </div>
                                           <div class="col-lg-2">
                                              <input type="text" class="form-control" id="discount2" name="discount2" placeholder="discount" value="<?php echo $prices; ?>">
                                              <p class="help-block"></p>
                                          </div>
                                           <div class="col-lg-2">
                                              <input type="text" class="form-control" id="percentages2" name="percentages2" placeholder="percentage" value="<?php echo $prices; ?>">
                                              <p class="help-block"></p>
                                          </div>
                                          <div class="col-lg-2">
                                              <input type="text" class="form-control" id="grmorKg2" name="grmorKg2" placeholder="grm or Kg" value="<?php echo $prices; ?>">
                                              <p class="help-block"></p>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">product price 3</label>
                                          <div class="col-lg-2">
                                              <input type="text" class="form-control" id="price3" name="price3" placeholder="price" value="<?php echo $prices; ?>">
                                              <p class="help-block"></p>
                                          </div>
                                           <div class="col-lg-2">
                                              <input type="text" class="form-control" id="discount3" name="discount3" placeholder="discount" value="<?php echo $prices; ?>">
                                              <p class="help-block"></p>
                                          </div>
                                           <div class="col-lg-2">
                                              <input type="text" class="form-control" id="percentages3" name="percentages3" placeholder="percentage" value="<?php echo $prices; ?>">
                                              <p class="help-block"></p>
                                          </div>
                                          <div class="col-lg-2">
                                              <input type="text" class="form-control" id="grmorKg3" name="grmorKg3" placeholder="grm or Kg" value="<?php echo $prices; ?>">
                                              <p class="help-block"></p>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">product price 4</label>
                                          <div class="col-lg-2">
                                              <input type="text" class="form-control" id="price4" name="price4" placeholder="price" value="<?php echo $prices; ?>">
                                              <p class="help-block"></p>
                                          </div>
                                           <div class="col-lg-2">
                                              <input type="text" class="form-control" id="discount4" name="discount4" placeholder="discount" value="<?php echo $prices; ?>">
                                              <p class="help-block"></p>
                                          </div>
                                           <div class="col-lg-2">
                                              <input type="text" class="form-control" id="percentages4" name="percentages4" placeholder="percentage" value="<?php echo $prices; ?>">
                                              <p class="help-block"></p>
                                          </div>
                                          <div class="col-lg-2">
                                              <input type="text" class="form-control" id="grmorKg4" name="grmorKg4" placeholder="grm or Kg" value="<?php echo $prices; ?>">
                                              <p class="help-block"></p>
                                          </div>
                                      </div>-->


                                      <div class="form-group">
                                          <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">product description</label>
                                          <div class="col-lg-8">
											
    <textarea class="textarea form-control" placeholder="Enter text ..." id="productdescs" name="productdescs" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px;"><?php echo $editVal['Description']; ?></textarea>
                                              <!--<input type="text" class="form-control" id="prodescription" name="prodescription" placeholder="product price" value="<?php echo $editVal['cat_alias']; ?>">
                                              <p class="help-block"></p>-->
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">product brand</label>
                                          <div class="col-lg-8">
                                              <select class="form-control m-b-10" id="brand" name="brand">
                                                  <option value="">select product brand</option>
                                                  
                                                 <?php 
                                                 $conn=dbconnection();
                                                $stmtbrand = $conn->prepare("SELECT `id`, `brand` FROM `tbl_brands` WHERE 1");
												$stmtbrand->execute();
												$stmtbrand->store_result();
												$stmtbrand->bind_result($id,$brand);
                                                 while ($rowbrand = $stmtbrand->fetch()){
												   if($id==$editVal['Brand']){
												   	 $selected="selected";
												   } else{
												   	$selected="";
												   }                                            
                                                  ?>
                                                  
                                                  <option value="<?php echo $id;?>" <?php echo $selected; ?>><?php echo $brand;?></option>
                                                  <?php  } //} ?>
                                              </select>
                                              
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">product color</label>
                                          <div class="col-lg-8">
                                              <select class="form-control m-b-10" id="color" name="color">
                                                  <option value="">select product color</option>
                                                  
                                                 <?php 
                                                 $conn=dbconnection();
                                                $stmtColor = $conn->prepare("SELECT `id`, `color` FROM `tbl_colors` WHERE 1");
												$stmtColor->execute();
												$stmtColor->store_result();
												$stmtColor->bind_result($id,$color);
                                                 while ($rowcolor = $stmtColor->fetch()){
												if($id==$editVal['Color']){
												$selected="selected";
												} else{
												$selected="";
												}                                            
                                                  ?>
                                                  
                                                  <option value="<?php echo $id;?>" <?php echo $selected; ?>><?php echo $color;?></option>
                                                  <?php  } //} ?>
                                              </select>
                                              
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="inputPassword1" class="col-lg-4 col-sm-4 control-label">	product meta title</label>
                                          <div class="col-lg-8">
                                              <textarea  class="form-control" id="title"  name="title" placeholder="meta title"><?php echo $editVal['meta_title']; ?></textarea>
                                              <span id="txtbox_count"></span>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="inputPassword1" class="col-lg-4 col-sm-4 control-label">	product meta keyword</label>
                                          <div class="col-lg-8">
                                              <textarea  class="form-control" id="keyword" name="keyword" placeholder="meta keyword" ><?php echo $editVal['meta_keyword']; ?></textarea>
                                              <span id="txtbox_count1"></span>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="inputPassword1" class="col-lg-4 col-sm-4 control-label">product	meta description</label>
                                          <div class="col-lg-8">
                                              <textarea  class="form-control" id="description" name="description" placeholder="meta description"><?php echo $editVal['meta_description']; ?></textarea>
                                              <span id="txtbox_count2"></span>
                                          </div>
                                      </div>
                                    <!--  <div class="form-group">
                                           <label for="inputPassword1" class="col-lg-4 col-sm-4 control-label">Product main image</label>
                                          <div class="col-lg-8">
                                          	<input type="file" id="exampleInputFile">
                                          </div>
                                       </div>-->
                                       <div class="form-group">
                                          <label for="inputPassword1" class="col-lg-4 col-sm-4 control-label">	stock status</label>
                                          <div class="col-lg-8">
                                             <select class="form-control m-b-10" id="status" name="status">
                                                  <option value="">select stock status</option>
                                                  <?php 
                                                   if($editVal['product_status']=="0"){
												   	$statusActivate ="selected=selected";
												   }else if($editVal['product_status']=="1") {
												   	$statusDeactivate ="selected=selected";
												   }else{
												   	$statusActivate ="";
												   	$statusDeactivate ="";
												   }
                                                   ?>
                                                  <option value="0" <?php echo $statusActivate; ?> >In stock</option>
                                                  <option value="1" <?php echo $statusDeactivate; ?>>no stock</option>
                                              </select>
                                          </div>
                                      </div>
                                      
                                      <div class="form-group">
                                          <div class="col-lg-offset-6 col-lg-8">
                                          <input  type="hidden" id="editid" name="editid" value="<?php echo $edit_id; ?>"/>
                                          <input  type="hidden" id="maincatids" name="maincatids" value="<?php echo $editVal['parent_id']; ?>"/>
                                              <button type="button"  onclick="SaveAddproduct();" value="Submit" id="button_save" name="button_save" class="btn btn-danger">submit</button>
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
        <script type="text/javascript" src="js/jquery.validate.js" language="javascript"></script>
        <script src="js/common-scripts.js" type="text/javascript"></script>
        <script src="js/add_products.js" type="text/javascript"></script>
         <script src="js/Director/app.js" type="text/javascript"></script>
        <script src=js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.js"></script>
        <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<script>
  $('.textarea').wysihtml5({
    toolbar: {
      fa: true
    }
  });
  
   $(function () {
                //lets use the jQuery Keyboard Event to catch the text typed in the textbox 
                $('#title').keyup(function () {
                    //.val() will give the text from the textbox and .length will give the number of characters
                    var txtlen = $(this).val().length;
                    //.replace used here to replace the space in the string and .length is to count the characters
                    var txtlennospace = $(this).val().replace(/\s+/g, '').length;
                    //the below lines will display the results 
                    $('#txtbox_count').text("characters  count : "+txtlen);
                    $('#txtbox_count_no_space').text(txtlennospace);
 
                });
                
                $('#title').keyup(function () {
                    //.val() will give the text from the textbox and .length will give the number of characters
                    var txtlen = $(this).val().length;
                    //.replace used here to replace the space in the string and .length is to count the characters
                    var txtlennospace = $(this).val().replace(/\s+/g, '').length;
                    //the below lines will display the results 
                    $('#txtbox_count').text("characters  count : "+txtlen);
                    $('#txtbox_count_no_space').text(txtlennospace);
 
                });
                
                $('#keyword').keyup(function () {
                    //.val() will give the text from the textbox and .length will give the number of characters
                    var txtlen = $(this).val().length;
                    //.replace used here to replace the space in the string and .length is to count the characters
                    var txtlennospace = $(this).val().replace(/\s+/g, '').length;
                    //the below lines will display the results 
                    $('#txtbox_count1').text("characters  count : "+txtlen);
                    $('#txtbox_count_no_space').text(txtlennospace);
 
                });
                
                  $('#description').keyup(function () {
                    //.val() will give the text from the textbox and .length will give the number of characters
                    var txtlen = $(this).val().length;
                    //.replace used here to replace the space in the string and .length is to count the characters
                    var txtlennospace = $(this).val().replace(/\s+/g, '').length;
                    //the below lines will display the results 
                    $('#txtbox_count2').text("characters  count : "+txtlen);
                    $('#txtbox_count_no_space').text(txtlennospace);
 
                });
                
            });
  
</script>
<style>
	#button_save .btn {
	  padding: 10px 27px !important;
	  font-size: 18px !important;
	}
</style>
    </body>
</html>
