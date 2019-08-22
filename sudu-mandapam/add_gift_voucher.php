<?php
include "include/function.php";
isNotLogin();
$conn = dbconnection();
$edit_id = mysqli_real_escape_string($conn,$_GET['editId']);
$editVal = editGiftVoucherValue($edit_id);
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
                            Add Gift Voucher
                        </header>
                        <div class="panel-body">
                            <div class="col-lg-8">
                                <form class="form-horizontal" role="form" id="addgift" name="addgift">


                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">gift voucher name</label>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="gift_voucher_name" name="gift_voucher_name" placeholder="voucher name" value="<?php echo $editVal['name']; ?>">
                                            <p class="help-block"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword1" class="col-lg-4 col-sm-4 control-label">gift voucher amount</label>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="gift_voucher_amount" name="gift_voucher_amount" placeholder="voucher name" value="<?php echo $editVal['amount']; ?>">
                                            <p class="help-block"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword1" class="col-lg-4 col-sm-4 control-label">expiry date</label>
                                        <div class="col-lg-8">
                                            <?php if($editVal['expiry_date']!="")
                                                $date=date('d-m-Y ', strtotime($editVal['expiry_date']));
                                            else
                                                $date="";
                                            ?>
                                            <input type="text" class="form-control" id="expiry_date" name="expiry_date" placeholder="Expiry date" value="<?php echo $date; ?>">
                                            <p class="help-block"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-6 col-lg-8">
                                            <input  type="hidden" id="editid" name="editid" value="<?php echo $edit_id; ?>"/>
                                            <button type="button"  onclick="SaveGiftVoucher();" value="Submit" id="button_save" name="button_save" class="btn btn-danger">submit</button>
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
<link rel="stylesheet" type="text/css" href="css/wysiediercss.css">
<!-- Bootstrap -->
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- Director App -->
<script type="text/javascript" src="js/jquery.validate.js" language="javascript"></script>
<script src="js/add_gift_voucher.js" type="text/javascript"></script>
<script src="js/Director/app.js" type="text/javascript"></script>
<style>
    #button_save .btn {
        padding: 10px 27px !important;
        font-size: 18px !important;
    }
</style>
<script>
    $( "#expiry_date" ).datepicker({ dateFormat: 'dd-mm-yy' });
</script>
</body>
</html>
