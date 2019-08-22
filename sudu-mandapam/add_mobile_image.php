<?php
include "include/function.php";
isNotLogin();
$conn = dbconnection();
$edit_id = mysqli_real_escape_string($conn,$_GET['editid']);
$editVal = editMobileImageValue($edit_id);

$cat_array=getCatgoryTypeName($editVal['category_id']);
$cat_name=$cat_array['cat_name'];
$cat_type_name=$cat_array['cat_type'];
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
                            Add Mobile Images
                        </header>
                        <div class="panel-body">
                            <div class="col-lg-8">
                                <form class="form-horizontal" method="post" action="get_mobile_image_add.php" role="form" id="addMobileImage" name="addMobileImage" onsubmit="SaveInfo();"  enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">category type</label>
                                        <div class="col-lg-8">
                                            <?php if($cat_type_name!=""){?>
                                                <label><?php echo $cat_type_name;?></label>
                                            <?php } else {?>
                                                <select class="form-control m-b-10" id="home_cat_type"
                                                        name="home_cat_type">
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
                                                        <option value="<?php echo $row['id'];?>" <?php echo $statusActivate; ?>><?php
                                                            echo $row['main_cat_names'];?></option>
                                                    <?php  } //} ?>
                                                </select>
                                            <?php }?>
                                            <p class="help-block"></p>
                                        </div>
                                    </div>
                                    <div class="form-group" >
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

                                        <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">mobile image</label>

                                        <div class="col-lg-8">


                                            <?php if($editVal!=""){ ?>
                                                <input type="file" id="image_edit" name="image_edit" placeholder="mobile image" >
                                                <p class="help-block"><img  src="<?php echo $siteUrl."".$editVal['image_link'];  ?>" width="270" height="120"/></p>
                                            <?php } else {?>
                                                <input type="file" id="image" name="image" placeholder="mobile image" >
                                            <?php } ?>

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
                                            <button type="submit"  value="Submit" id="btnMobileImage" name="btnMobileImage" class="btn btn-danger">submit</button>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script src="js/jquery.min.js" type="text/javascript"></script>
<!-- Bootstrap -->
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<!-- Director App -->
<script type="text/javascript" src="js/jquery.validate.js" ></script>
<script src="js/add_mobile_images.js" type="text/javascript"></script>
<script src="js/Director/app.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $('#home_cat_type').change(function () {
            var cat_type_id=this.value;
            $.ajax({
                url:'get_category_on_type.php?action=ajax&cat_type_id='+cat_type_id,
                success:function(data) {
                    var obj = $.parseJSON(data);
                    $("#home_cat_select").empty();
                    $("#home_cat_select").append("<option value=''>select category name</option>");
                    for (var i = 0; i < obj.length; i++) {
                        $("#home_cat_select").append("<option value="+obj[i].categories_id+">"+obj[i].categories_name
                            +"</option>");
                    }
                }
            });
        });
    });
</script>
</body>

</html>

