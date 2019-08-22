<?php 
include "include/function.php";
isNotLogin();
$conn = dbconnection();
$edit_id = mysqli_real_escape_string($conn,$_GET['editid']);
$editVal = editbandsValue($edit_id);
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

                                  Add Brands

                              </header>

                               <div class="panel-body">

                               <div class="col-lg-8">

                                  <form class="form-horizontal" method="post" action="get_brand_add.php" role="form" id="addcates" name="addcates" onsubmit="SaveInfo();"  enctype="multipart/form-data">

                                    <div class="form-group">

                                          <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">brand name</label>

                                          <div class="col-lg-8">

                                             <input type="text" class="form-control" id="brand" name="brand" placeholder="brand name" value="<?php echo $editVal['brand']; ?>">

                                              <p class="help-block"></p>

                                          </div>

                                      </div>

                                      <div class="form-group">

                                          <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">brand image</label>

                                          <div class="col-lg-8">

                                           
											<?php if($editVal!=""){ ?>
											<input type="file" id="image_edit" name="image_edit" placeholder="brand image" >
											<p class="help-block"><img  src="<?php echo $siteUrl."".$editVal['brand_img'];  ?>" width="270" height="120"/></p>
											<?php } else {?>
											<input type="file" id="image" name="image" placeholder="brand image" >
											<?php } ?>

                                          </div>

                                      </div>
                                      <div class="form-group">

                                          <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">brand over Image</label>

                                          <div class="col-lg-8">

                                           
                                              <?php if($editVal!=""){ ?>
                                              <input type="file" id="image_over_edit" name="image_over_edit" placeholder="brand over image" >
                                              <p class="help-block"><img  src="<?php echo $siteUrl."".$editVal['brand_img_over'];  ?>" width="270" height="120"/></p>
                                              <?php } else {?>
                                              <input type="file" id="image_over" name="image_over" placeholder="brand over image" >
                                              <?php } ?>

                                          </div>

                                      </div>

                                      <div class="form-group">

                                          <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">brand link</label>

                                          <div class="col-lg-8">

                                              <input type="text" class="form-control" id="links" name="links" placeholder="brand link" value="<?php echo $editVal['brand_alis_name']; ?>">

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

                                              <button type="submit"  value="Submit" id="button_save" name="button_save" class="btn btn-danger">submit</button>

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
        <script type="text/javascript" src="js/jquery.validate.js" ></script>
        <script src="js/add_brand_list.js" type="text/javascript"></script>
        <script src="js/Director/app.js" type="text/javascript"></script>

    </body>

</html>

