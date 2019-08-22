<?php 
include "include/function.php";
isNotLogin();
$conn = dbconnection();
$edit_id = mysqli_real_escape_string($conn,$_GET['editId']);
/*if(isset($edit_id)){
  
}else {
  
}*/
$editVal = editUserDetails($edit_id);
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
                                  User Full Details
                              </header>
                               <div class="panel-body">
                               <div class="col-lg-8">
                                  <form class="form-horizontal" role="form" id="addcates" name="addcates">
                                  <div class="form-group">
                                          <label for=" " class="col-lg-4 col-sm-4 control-label">name : </label>
                                          <div class="col-lg-8">
                                                <?php echo $editVal['name'];?>
                                          </div>
                                      </div>
                                    <div class="form-group">
                                          <label for=" " class="col-lg-4 col-sm-4 control-label"> email: </label>
                                          <div class="col-lg-8">
                                                <?php echo $editVal['email'];?> 
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for=" " class="col-lg-4 col-sm-4 control-label"> phone: </label>
                                          <div class="col-lg-8">
                                                 <?php echo $editVal['phone_number'];?>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for=" " class="col-lg-4 col-sm-4 control-label"> mobile: </label>
                                          <div class="col-lg-8">
                                                 <?php echo $editVal['mobile'];?>
                                          </div>
                                      </div>
                                     
                                      <div class="form-group">
                                          <label for=" " class="col-lg-4 col-sm-4 control-label"> shipping email: </label>
                                          <div class="col-lg-8">
                                                 <?php echo $editVal['shipping_email'];?>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for=" " class="col-lg-4 col-sm-4 control-label"> shipping mobile: </label>
                                          <div class="col-lg-8">
                                                 <?php echo $editVal['shipping_mobile'];?>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for=" " class="col-lg-4 col-sm-4 control-label"> shipping address: </label>
                                          <div class="col-lg-8">
                                                <?php echo $editVal['shipping_address'];?> 
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for=" " class="col-lg-4 col-sm-4 control-label"> country: </label>
                                          <div class="col-lg-8">
                                                 <?php echo $editVal['country'];?>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for=" " class="col-lg-4 col-sm-4 control-label"> city: </label>
                                          <div class="col-lg-8">
                                                 <?php echo $editVal['city'];?>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for=" " class="col-lg-4 col-sm-4 control-label"> district: </label>
                                          <div class="col-lg-8">
                                                 <?php echo $editVal['districk'];?>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for=" " class="col-lg-4 col-sm-4 control-label"> zip: </label>
                                          <div class="col-lg-8">
                                                 <?php echo $editVal['zip'];?>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for=" " class="col-lg-4 col-sm-4 control-label"> special notes: </label>
                                          <div class="col-lg-8">
                                                 <?php echo $editVal['spical_notes'];?>
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
        <script src="js/add_products.js" type="text/javascript"></script>
        <script src="js/Director/app.js" type="text/javascript"></script>
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
