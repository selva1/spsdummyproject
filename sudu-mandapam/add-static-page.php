<?php 
include "include/function.php";
isNotLogin();
$conn = dbconnection();
$edit_id = mysqli_real_escape_string($conn,$_GET['editId']);
$editVal = editPageContent($edit_id);
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
                              </header>
                               <div class="panel-body">
                               <div class="col-lg-8">
                                  <form class="form-horizontal" role="form" id="addcates" name="addcates">
                                  <div class="form-group">
                                          <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">page name</label>
                                          <div class="col-lg-8">
                                              <input type="text" class="form-control" id="pagename" name="pagename" placeholder="page name" value="<?php echo $editVal['name']; ?>">
                                              <p class="help-block"></p>
                                          </div>
                                      </div>
                                    <div class="form-group">
                                          <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">alias name</label>
                                          <div class="col-lg-8">
                                            <input type="text" class="form-control" id="page_alias" name="page_alias" placeholder="alias name" value="<?php echo $editVal['page_alias']; ?>">
                                              <p class="help-block"></p>
                                          </div>
                                      </div>
                                                                                      
                                     
                                      <div class="form-group">
                                          <label for="inputPassword1" class="col-lg-4 col-sm-4 control-label">	page meta title</label>
                                          <div class="col-lg-8">
                                              <textarea  class="form-control" id="title"  name="title" placeholder="meta title"><?php echo $editVal['meta_title']; ?></textarea>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="inputPassword1" class="col-lg-4 col-sm-4 control-label">	page meta keyword</label>
                                          <div class="col-lg-8">
                                              <textarea  class="form-control" id="keyword" name="keyword" placeholder="meta keyword" ><?php echo $editVal['meta_keyword']; ?></textarea>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="inputPassword1" class="col-lg-4 col-sm-4 control-label">page	meta description</label>
                                          <div class="col-lg-8">
                                              <textarea  class="form-control" id="description" name="description" placeholder="meta description"><?php echo $editVal['meta_description']; ?></textarea>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">page content</label>
                                          <div class="col-lg-8">
                      
                                             <textarea class="textarea form-control" placeholder="Enter text ..." id="content" name="content" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px;"><?php echo $editVal['content']; ?></textarea>
                                              <!--<input type="text" class="form-control" id="prodescription" name="prodescription" placeholder="product price" value="<?php echo $editVal['cat_alias']; ?>">
                                              <p class="help-block"></p>-->
                                          </div>
                                      </div>
                                       <div class="form-group">
                                          <label for="inputPassword1" class="col-lg-4 col-sm-4 control-label">status</label>
                                          <div class="col-lg-8">
                                             <select class="form-control m-b-10" id="status" name="status">
                                                  <?php 
                                                   if($editVal['status']=="0"){
                          												   	$statusActivate ="selected=selected";
                          												   }else if($editVal['status']=="1") {
                          												   	$statusDeactivate ="selected=selected";
                          												   }else{
                          												   	$statusActivate ="";
                          												   	$statusDeactivate ="";
                          												   }
                                                   ?>
                                                  <option value="0" <?php echo $statusActivate; ?> >Active</option>
                                                  <option value="1" <?php echo $statusDeactivate; ?>>De-active</option>
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
        <script src="js/add_static_page.js" type="text/javascript"></script>
        <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.js"></script>
        <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
         <script src="js/Director/app.js" type="text/javascript"></script>
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
</style>
    </body>
</html>
