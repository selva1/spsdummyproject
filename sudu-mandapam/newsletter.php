<?php 
include "include/function.php";
isNotLogin();
$conn = dbconnection();
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
                                  Newsletter
                              </header>
                               <div class="panel-body">
                               <div class="col-lg-8">
                                  <form class="form-horizontal" role="form" id="addcates" name="addcates">
                                    <div class="form-group">
                                          <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">Subject</label>
                                          <div class="col-lg-8">
                                            <input type="text" class="form-control" id="email_subject" name="email_subject" placeholder="Email Subject" value="">
                                              <p class="help-block"></p>
                                          </div>
                                      </div>

                                      <div class="form-group">
                                          <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">Newsletter Content</label>
                                          <div class="col-lg-8">
                      
                                             <textarea class="textarea form-control" placeholder="Enter text ..." id="content" name="content" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px;"></textarea>
                                              <!--<input type="text" class="form-control" id="prodescription" name="prodescription" placeholder="product price" value="<?php echo $editVal['cat_alias']; ?>">
                                              <p class="help-block"></p>-->
                                          </div>
                                      </div>
                                     
                                      
                                      <div class="form-group">
                                          <div class="col-lg-offset-6 col-lg-8">
                                              <button type="button"  onclick="SaveAddproduct();" value="Submit" id="button_save" name="button_save" class="btn btn-danger">Send</button>
                                          </div>
                                      </div>
                                  </form>
                              </div>
                              <div class="col-md-4">
                               <label class="panel-heading"> Subscriber's List</label>
                             
                                <div id="wrapper">
                                      <input type="checkbox" name="all" id="all" /> <label for='all'> Select All</label>
                                    <ul class="subscriber_list">
                                         <!--  getting users list  -->
                                         <?php
                                         $query = "SELECT `email` FROM `tbl_subscribe_email` WHERE status=0";
                                         $conn->set_charset("utf8");
                                        $query_vals    = mysqli_query($conn,$query);
                                          $numrows = mysqli_num_rows($query_vals);
                                          $id=0;
                                         while($result = mysqli_fetch_array($query_vals)):
                                                      $email_id= $result['email'];
                                          $id++;
                                         ?>
                                           <li><input type="checkbox" name="recievers[]" id="user<?php echo $id;?>" value="<?php echo $email_id; ?>" /> 
                                            <label for="user<?php echo $id;?>"><?php echo $email_id; ?></label>
                                          </li>
                                         <?php endwhile; ?>
                                         </ul>
                                     </li>
                                    </div>
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
        <script src="js/send_newsletter.js" type="text/javascript"></script>
        <script src="js/Director/app.js" type="text/javascript"></script>
        <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.js"></script>
        <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
        
<script>
  $('.textarea').wysihtml5({
    toolbar: {
      fa: true
    }
  });
  /* for checkbox*/
  $('input[name="all"],input[name="title"]').bind('click', function(){
var status = $(this).is(':checked');
$('input[type="checkbox"]').attr('checked', status);
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
