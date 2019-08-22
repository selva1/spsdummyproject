<?php 
include "include/function.php";
isNotLogin();
$conn = dbconnection();
$edit_id = mysqli_real_escape_string($conn,$_GET['editId']);
$editVal = editColorValue($edit_id);
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
                                  Add color
                              </header>
                               <div class="panel-body">
                               <div class="col-lg-8">
                                  <form class="form-horizontal" role="form" id="addcates" name="addcates">
                                 
                                    
                                       <div class="form-group">
                                          <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">color name</label>
                                          <div class="col-lg-8">
                                              <input type="text" class="form-control" id="subcategory" name="subcategory" placeholder="product name" value="<?php echo $editVal['Title']; ?>">
                                              <p class="help-block"></p>
                                          </div>
                                      </div>
                                       <div class="form-group">
                                          <label for="inputPassword1" class="col-lg-4 col-sm-4 control-label">status</label>
                                          <div class="col-lg-8">
                                             <select class="form-control m-b-10" id="status" name="status">
                                                  <option value="">select status</option>
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
                                                  <option value="0" <?php echo $statusActivate; ?> >Active</option>
                                                  <option value="1" <?php echo $statusDeactivate; ?>>Deactive</option>
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
        <script src="js/add_color.js" type="text/javascript"></script>
        <script src="js/Director/app.js" type="text/javascript"></script>
<style>
	#button_save .btn {
	  padding: 10px 27px !important;
	  font-size: 18px !important;
	}
</style>
    </body>
</html>
