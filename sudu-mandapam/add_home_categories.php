<?php
include "include/function.php";
isNotLogin();
$conn = dbconnection();
$edit_id = mysqli_real_escape_string($conn,$_GET['editId']);
$cat_name = mysqli_real_escape_string($conn,$_GET['cat_name']);
$cat_type_name = mysqli_real_escape_string($conn,$_GET['cat_type_name']);
$order_id = mysqli_real_escape_string($conn,$_GET['order_id']);
$status = mysqli_real_escape_string($conn,$_GET['status']);

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
                            Add Home category
                        </header>
                        <div class="panel-body">
                            <div class="col-lg-8">
                                <form class="form-horizontal" role="form" id="addHomeCategories" name="addcates">
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">category type</label>
                                        <div class="col-lg-8">
                                            <?php if($cat_type_name!=""){?>
                                                <label><?php echo $cat_type_name;?></label>
                                           <?php } else {?>
                                            <select class="form-control m-b-10" id="home_cat_type" name="home_cat_type">
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
                                                        $statusActivate ="";
                                                    }
                                                    ?>
                                                    <option value="<?php echo $row['id'];?>" <?php echo $statusActivate; ?>><?php echo $row['main_cat_names'];?></option>
                                                <?php  } //} ?>
                                            </select>
                                            <?php }?>
                                            <p class="help-block"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">category name</label>
                                        <div class="col-lg-8">
                                            <?php if($cat_name!=""){?>
                                                <label><?php echo $cat_name;?></label>
                                            <?php } else {?>
                                            <select class="form-control m-b-10" id="home_cat_select" name="home_cat_select">
                                                <option value="">select category name</option>
                                            </select>
                                            <?php }?>
                                            <p class="help-block"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">select order</label>
                                        <div class="col-lg-8">
                                           <input type="text" id="order_by" class="form-control" name="order_by" value="<?php echo $order_id;?>">
                                            <p class="help-block"></p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputPassword1" class="col-lg-4 col-sm-4 control-label">status</label>
                                        <div class="col-lg-8">
                                            <select class="form-control m-b-10" id="status" name="status">
                                                <option value="">select status</option>
                                                <?php
                                                if($status=="0"){
                                                    $statusActivate ="selected=selected";
                                                }else if($status=="1") {
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
                                            <button type="button"  onclick="addCategoryHomeDB();" value="Submit" id="btnSaveHomeCat" name="btnSaveHomeCat" class="btn btn-danger">submit</button>
                                        </div>
                                    </div>
                                    <p class="help-block" id="update_success"></p>
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<!--<script src="js/jquery.min.js" type="text/javascript"></script>-->
<link rel="stylesheet" type="text/css" href="css/wysiediercss.css">
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"/>
<!-- Bootstrap -->
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<!-- Director App -->
<script type="text/javascript" src="js/jquery.validate.js" language="javascript"></script>
<script src="js/common-scripts.js" type="text/javascript"></script>
<script src="js/add_products.js" type="text/javascript"></script>
 <script src="js/Director/app.js" type="text/javascript"></script>
<script src=js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.js"></script>
<script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<!-- Include the plugin's CSS and JS: -->
<script type="text/javascript" src="js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="css/bootstrap-multiselect.css" type="text/css"/>

<script>
    $('.textarea').wysihtml5({
        toolbar: {
            fa: true
        }
    });
    $(document).ready(function() {
        $('#home_cat_type').change(function () {
            var cat_type_id=this.value;
            $.ajax({
                url:'get_category_on_type_home.php?action=ajax&cat_type_id='+cat_type_id,
                success:function(data) {
                    var obj = $.parseJSON(data);
                    $("#home_cat_select").empty();
                    $("#home_cat_select").append("<option value=''>select category name</option>");
                    for (var i = 0; i < obj.length; i++) {
                        $("#home_cat_select").append("<option value="+obj[i].category_id+">"+obj[i].category_name+"</option>");
                    }
                }
            });
        });

        $("#addHomeCategories").validate({
            rules:
            {
                home_cat_type		 : { required : true } ,
                home_cat_select		 : { required : true } ,
                order_by		 : { required : true } ,
                status        : { required : true } ,
            },
            messages:
            {
                home_cat_type		 : { required : 'please select category type .' } ,
                home_cat_select		 : { required : 'please select main category.' } ,
                order_by		 : { required : 'please chose order.' } ,
                status        : { required : 'please select status.' } ,
            },
            submitHandler: function(form)
            {
                $(form).find(":btnSaveHomeCat").attr("disabled", true).attr("value","Submitting...");
                form.submit();
            }
        });

    });
    function addCategoryHomeDB() {
        if($("#addHomeCategories").valid()) {

            var cat_type=$('#home_cat_type').val();
            var cat_id=$('#home_cat_select').val();
            var order_by=$('#order_by').val();
            var status=$('#status').val();
            var edit_id='<?php echo $edit_id;?>';
            //var cat_name=$("#home_cat_select option:selected").text();
            $.ajax({
                url:'ajax_choose_category_to_home.php?action=ajax&cat_type='+cat_type+'&status='+status+'&cat_id='+cat_id+'&order_by='+order_by+'&edit_id='+edit_id,
                success:function(data) {
                    if(data=="1") {
                        $('#update_success').text('Added successfully');
                    }
                    else if(data=="2") {
                        var site_url = jQuery("meta[name='siteurl']").attr("content");
                        $('#update_success').text('Updated successfully');
                        setTimeout(function () {
                            window.location = site_url + "all-home-categories.php";
                        }, 3000);
                    }
                    else{
                        $('#update_success').text('Error! please try again');
                    }

                }
            });
        }
    }
</script>
<style>
    #button_save_to_home .btn {
        padding: 10px 27px !important;
        font-size: 18px !important;
    }
    .form-control {
        text-align: left;
    }
    .btn-group{
        width:100%;
    }
    .caret_dropdown{
        margin-left: 264px;
    }
    .dropdown-menu{
        width:445px;
    }
</style>
</body>
</html>
