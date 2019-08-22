<?php
include "include/function.php";
isNotLogin();
$conn = dbconnection();
$edit_id = mysqli_real_escape_string($conn,$_GET['editId']);
$editVal = editProductValue($edit_id);
$prices = sigleprice($edit_id);
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
                            Add Product To Home
                        </header>
                        <div class="panel-body">
                            <div class="col-lg-8">
                                <form class="form-horizontal" role="form" id="addcatesHome" name="addcates">
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">category type</label>
                                        <div class="col-lg-8">
                                            <select class="form-control m-b-10" id="producattype" name="producattype">
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
                                            <p class="help-block"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">main category</label>
                                        <div class="col-lg-8">
                                            <select class="form-control m-b-10" id="mainselect" name="mainselect">
                                                <option value="">select main category</option>
                                            </select>
                                            <p class="help-block"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">category name</label>
                                        <div class="col-lg-8">
                                            <select class="form-control m-b-10" id="cat_select" name="cat_select">
                                                <option value="">select category name</option>
                                            </select>
                                            <p class="help-block"></p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">product name</label>
                                        <div class="col-lg-8">
                                            <select multiple="multiple" class="form-control m-b-10" id="products" name="products">
                                            </select>
                                            <p class="help-block" id="pro_error"></p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-offset-6 col-lg-8">
                                            <input  type="hidden" id="editid" name="editid" value="<?php echo $edit_id; ?>"/>
                                            <input  type="hidden" id="maincatids" name="maincatids" value="<?php echo $editVal['parent_id']; ?>"/>
                                            <button type="button"  onclick="addProductToHomeUpdateDB();" value="Submit" id="button_save_to_home" name="button_save_to_home" class="btn btn-danger">submit</button>
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
<script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.js"></script>
<script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
 <script src="js/Director/app.js" type="text/javascript"></script>

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
        $('#producattype').change(function () {
            var cat_type_id=this.value;
            $.ajax({
                url:'get_category_on_type.php?action=ajax&cat_type_id='+cat_type_id,
                success:function(data) {
                    var obj = $.parseJSON(data);
                    $("#mainselect").empty();
                    $("#mainselect").append("<option value=''>select main category name</option>");
                    for (var i = 0; i < obj.length; i++) {
                        $("#mainselect").append("<option value="+obj[i].categories_id+">"+obj[i].categories_name+"</option>");
                    }
                }
            });
        });
        $('#mainselect').change(function () {
            var main_cat_id=this.value;
            $.ajax({
                url:'get_category_on_main_cat.php?action=ajax&main_cat_id='+main_cat_id,
                success:function(data) {
                    var obj = $.parseJSON(data);
                    $("#cat_select").empty();
                    $("#cat_select").append("<option value=''>select category name</option>");
                    for (var i = 0; i < obj.length; i++) {
                        $("#cat_select").append("<option value="+obj[i].category_id+">"+obj[i].category_name+"</option>");
                    }
                }
            });
        });

        $('#cat_select').change(function () {
            var cat_id=this.value;
            $.ajax({
                url:'get_product_on_category.php?action=ajax&cat_id='+cat_id,
                success:function(data) {
                    var obj = $.parseJSON(data);
                    for (var i = 0; i < obj.length; i++) {
                        $("#products").append("<option value="+obj[i].ProductID+">"+obj[i].Title+"</option>");
                    }
                    $('#products').multiselect('rebuild');
                }
            });

        });


        $("#products").multiselect({
            maxHeight: 128,
            numberDisplayed: 1,
            nonSelectedText:'please select products',
            buttonClass: 'form-control'
        });
        $("#products").change(function(){
            var selected_items = [];
            $.each($("#products option:selected"), function(){
                selected_items.push($(this).val());
            });
            if(selected_items.length >= 2){
                $('#pro_error').show();
                //$('#pro_error').text('Cannot select more than 2 items').css('color','red');
                $('input[type="checkbox"]:not(:checked)').attr("disabled", true);
            }
            else{
                $('#pro_error').hide();
                $('input[type="checkbox"]:not(:checked)').attr("disabled", false);
            }


        });
       $("#addcatesHome").validate({
           rules:
           {
               producattype		 : { required : true } ,
               mainselect		 : { required : true } ,
               cat_select        : { required : true } ,
               products   		 : { required : true } ,
           },
           messages:
           {
               producattype		 : { required : 'please select category type .' } ,
               mainselect		 : { required : 'please select main category.' } ,
               cat_select        : { required : 'please select category.' } ,
               products		     : { required : 'please select product.' } ,
           },
           submitHandler: function(form)
           {
               $(form).find(":button_save_to_home").attr("disabled", true).attr("value","Submitting...");
               form.submit();
           }
       });

    });
    function addProductToHomeUpdateDB() {
        if($("#addcatesHome").valid()) {
            $.each($("#products option:selected"), function(){
                var pro_id=$(this).val();
                $.ajax({
                    url:'ajax_choose_product_to_home.php?action=ajax&pro_id='+pro_id,
                    success:function(data) {
                        if(data=="1"){
                            $('#update_success').text('Added successfully');
                        }
                        else{
                            $('#update_success').text('Error! please try again');
                        }
                    }
                });
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
