<?php
include "include/function.php";
isNotLogin();
$conn = dbconnection();
$product_id = mysqli_real_escape_string($conn,$_GET['edit_id']);
$category_id=get_cat_id_product($product_id);
$cat_spec_list=get_category_specific_list($category_id,$product_id);

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
                            Add Product Specification
                        </header>
                        <div class="panel-body">
                            <div class="col-lg-8">
                                <form class="form-horizontal" role="form" id="addcates" name="addcates">
                                   <?php $results=[];
                                   //while ($row=mysqli_fetch_array($cat_spec_list))
                                   if(!empty($cat_spec_list)){
                                    foreach ($cat_spec_list as $row)
                                    {
                                       $results[]=$row;
                                        if($row['feature']=="")
                                            $feature="";
                                        else
                                            $feature=$row['feature'];
                                        ?>
                                        <div class="form-group">
                                            <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label"><?php echo $row['feature_property'];?></label>
                                            <div class="col-lg-8">
                                                <!--<input type="text" class="form-control" value="<?php /*echo trim($feature);*/?>" id="spec_<?php /*echo $row['cat_spec_id'];*/?>" name="spec_<?php /*echo $row['cat_spec_id'];*/?>">-->
                                                 <textarea  class="textarea form-control" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px;" id="spec_<?php echo $row['cat_spec_id'];?>" name="spec_<?php echo $row['feature_property'];?>"><?php echo trim($row['feature']);?></textarea>
                                                <p class="help-block"></p>
                                            </div>
                                        </div>
                                    <?php } }else{?>
                                       <div> No specifications available for this product category. </div>
                                  <?php }?>


                                    <?php if(!empty($cat_spec_list)){?>
                                    <div class="form-group">
                                        <div class="col-lg-offset-6 col-lg-8">
                                            <button type="button"  value="Submit" id="button_product_feature" name="button_save" class="btn btn-danger">submit</button>
                                            <p id="spec_message"></p>
                                        </div>
                                    </div>
                                    <?php }?>
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
<!-- Director App -->
<script type="text/javascript" src="js/jquery.validate.js" language="javascript"></script>

<script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.js"></script>
<script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
 <script src="js/Director/app.js" type="text/javascript"></script>

<script>
    $('.textarea').wysihtml5({
        toolbar: {
            fa: true
        }
    });

    $(document).ready(function () {
        $('#button_product_feature').click(function () {
            var spec_list1 = '<?php echo json_encode($results)?>';
            var product_id = '<?php echo $product_id;?>';
            var array = $.parseJSON(spec_list1);
            var spec_name = "";
            var spec_list = [];
            for (var i = 0; i < array.length; i++) {
                spec_name = array[i]["cat_spec_id"];
                $('#spec_' + spec_name).val()
                spec_list.push([spec_name, $('#spec_' + spec_name).val()]);
            }
            $.post("ajax_all_add_edits.php", {
                command: 'addProductSpecifications',
                product_id: product_id,
                spec_list: spec_list
            }, function (data, status) {
                if(data==1)
                    $('#spec_message').text('Specification Added Successfully').css('color','green')
                else
                    $('#spec_message').text('Error! Please try again').css('color','red')

            });

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
