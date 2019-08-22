<?php 
include "include/function.php";
isNotLogin();
$conn = dbconnection();
$edit_id = mysqli_real_escape_string($conn,$_GET['editid']);
$editVal = editHomeSliderValue($edit_id);
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
                                   Main Slider add /edit
                              </header>
                               <div class="panel-body">
                               <div class="col-lg-8">
                                  <form class="form-horizontal" method="post" action="get_home_main_slider_add.php" role="form" id="addcates" name="addcates" onsubmit="SaveInfo();"  enctype="multipart/form-data">
                                  <div class="form-group">
                                          <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">category type</label>
                                          <div class="col-lg-8">
                                              <select class="form-control m-b-10" id="mainselect" name="mainselect">
                                                  <option value="">please category type</option>
                                                  
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
                                              <p class="help-block"></p>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">home slider image</label>
                                          <div class="col-lg-8">                                      
											<?php if($editVal!=""){ ?>
											<input type="file" id="image_edit" name="image_edit" placeholder="brand image" >
											<p class="help-block"><img  src="<?php echo $siteUrl."".$editVal['img'];  ?>" width="270" height="120"/></p>
											<?php } else {?>
											<input type="file" id="image" name="image" placeholder="brand image"  >
											<?php } ?>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="inputtitle" class="col-lg-4 col-sm-4 control-label">title</label>
                                          <div class="col-lg-8">
                                              <input class="form-control" type="text" value="<?php  echo $editVal['title'];?>" name="slider_title" id="slider_title">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="inputPassword1" class="col-lg-4 col-sm-4 control-label">blog link</label>
                                          <div class="col-lg-8">
                                              <input class="form-control" type="text" value="<?php  echo $editVal['blog_link'];?>" name="blog_link" id="blog_link">
                                          </div>
                                      </div>

                                      <div class="form-group">
                                          <label for="inputPassword1" class="col-lg-4 col-sm-4 control-label">description</label>
                                          <div class="col-lg-8">
                                              <textarea  class="textarea form-control" id="description"  name="description" placeholder="description" required="" style="height: 200px;"><?php echo $editVal['descr']; ?></textarea>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="inputPassword1" class="col-lg-4 col-sm-4 control-label">enable read more</label>
                                          <div class="col-lg-8">
                                              <input type="radio" name="enable_read_more" value="1"  <?php echo ($editVal['active_read_more']=='1')?'checked':'' ?> > Yes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                              <input type="radio" name="enable_read_more" value="0" <?php echo ($editVal['active_read_more']=='0')?'checked':'' ?>> No
                                          </div>
                                      </div>

                                       <div class="form-group">
                                          <label for="inputPassword1" class="col-lg-4 col-sm-4 control-label">slider status</label>
                                          <div class="col-lg-8">
                                             <select class="form-control m-b-10" id="status" name="status" required="">
                                                  <option value="">please category status</option>
                                                  <?php $statusDeactivate="";
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
         <link rel="stylesheet" type="text/css" href="css/wysiediercss.css"></link>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Director App -->
        <script type="text/javascript" src="js/jquery.validate.js" ></script>
        <script src="js/add_brand_list.js" type="text/javascript"></script>
         <script src="js/Director/app.js" type="text/javascript"></script>
        <script src=js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.js"></script>
        <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
		<script>
			$('.textarea').wysihtml5({
			toolbar: {
			fa: true
			}
			});
		</script>
    </body>
</html>

