<?php 
include "include/function.php";
isNotLogin();
$conn = dbconnection();
$edit_id = mysqli_real_escape_string($conn,$_GET['editId']);
$editVal = editCateValue($edit_id);
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
                                  Add Main Categories
                              </header>
                               <div class="panel-body">
                               <div class="col-lg-8">
                                  <form class="form-horizontal" role="form" id="addcates" name="addcates">
                                    <div class="form-group" style="display:none;">
                                          <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">category type</label>
                                          <div class="col-lg-8">
                                              <select class="form-control m-b-10" id="mainselect" name="mainselect">
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
                                          <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">main category name</label>
                                          <div class="col-lg-8">
                                              <input type="text" class="form-control" id="category" name="category" placeholder="main category name" value="<?php echo $editVal['category_name']; ?>">
                                              <p class="help-block"></p>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">category link</label>
                                          <div class="col-lg-8">
                                              <input type="text" class="form-control" id="links" name="links" placeholder="category link" value="<?php echo $editVal['cat_alias']; ?>">
                                              <p class="help-block"></p>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="inputPassword1" class="col-lg-4 col-sm-4 control-label">	meta title</label>
                                          <div class="col-lg-8">
                                              <textarea  class="form-control" id="title"  name="title" placeholder="meta title"><?php echo $editVal['meta_title']; ?></textarea>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="inputPassword1" class="col-lg-4 col-sm-4 control-label">	meta keyword</label>
                                          <div class="col-lg-8">
                                              <textarea  class="form-control" id="keyword" name="keyword" placeholder="meta keyword" ><?php echo $editVal['meta_keyword']; ?></textarea>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="inputPassword1" class="col-lg-4 col-sm-4 control-label">	meta description</label>
                                          <div class="col-lg-8">
                                              <textarea  class="form-control" id="description" name="description" placeholder="meta description"> <?php echo $editVal['meta_description']; ?> </textarea>
                                          </div>
                                      </div>
                                       <div class="form-group">
                                          <label for="inputPassword1" class="col-lg-4 col-sm-4 control-label">Description</label>
                                          <div class="col-lg-8">
                                              <textarea  class="form-control" id="maindescription" name="maindescription" placeholder="forntend description"> <?php echo $editVal['main_description']; ?> </textarea>
                                          </div>
                                      </div>
                                       <div class="form-group">
                                          <label for="inputPassword1" class="col-lg-4 col-sm-4 control-label">	category status</label>
                                          <div class="col-lg-8">
                                             <select class="form-control m-b-10" id="status" name="status">
                                                  <option value="">select category status</option>
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
                                                  <option value="1" <?php echo $statusDeactivate; ?>>Deactive</option>
                                              </select>
                                          </div>
                                      </div>
                                      
                                      <div class="form-group">
                                          <div class="col-lg-offset-6 col-lg-8">
                                          <input  type="hidden" id="editid" name="editid" value="<?php echo $edit_id; ?>"/>
                                              <button type="button"  onclick="SaveInfo();" value="Submit" id="button_save" name="button_save" class="btn btn-danger">submit</button>
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

        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Director App -->
        <script type="text/javascript" src="js/jquery.validate.js" language="javascript"></script>
        <script src="js/add_main_categories.js" type="text/javascript"></script>
         <script src="js/Director/app.js" type="text/javascript"></script>
    </body>
</html>
