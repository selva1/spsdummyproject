<?php
include "include/function.php";
isNotLogin();
$conn = dbconnection();
$edit_id = mysqli_real_escape_string($conn,$_GET['editId']);
$editVal = editCatSpecificationValue($edit_id);
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
                            Add Category Specifications
                        </header>
                        <div class="panel-body">
                            <div class="col-lg-8">
                                <form class="form-horizontal" role="form" id="addcates" name="addcates">
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">category type</label>
                                        <div class="col-lg-8">
                                            <select class="form-control m-b-10" id="produ_cat_type" name="produ_cat_type">
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
                                        <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">category name</label>
                                        <div class="col-lg-8">
                                            <select class="form-control m-b-10" id="main_select" name="main_select">
                                                <option value="">select category name</option>
                                                <?php
                                                $categoryList = categoryParentChildTreeAddProd();
                                                foreach($categoryList as $key => $value){
                                                    if($editVal['cat_id']==$value['category_id']){
                                                        $selected= "selected=''";
                                                    }else{
                                                        $selected ="";
                                                    }
                                                    ?>

                                                    <option value="<?php  echo $value['category_id']; ?>" <?php echo $selected; ?>><?php echo $value['name']; ?></option>
                                                <?php }?>
                                            </select>
                                            <p class="help-block"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label">specification name</label>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="specification" name="specification" placeholder="Specification name" value="<?php echo $editVal['feature_property']; ?>">
                                            <p class="help-block"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-6 col-lg-8">
                                            <input  type="hidden" id="editid" name="editid" value="<?php echo $edit_id; ?>"/>
                                            <input  type="hidden" id="maincatids" name="maincatids" value="<?php echo $editVal['parent_id']; ?>"/>
                                            <button type="button"  onclick="addCategorySpecification();" value="Submit" id="button_add_specification" name="button_save" class="btn btn-danger">submit</button>
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
<!-- Director App -->
<script type="text/javascript" src="js/jquery.validate.js" language="javascript"></script>
<script src="js/common-scripts.js" type="text/javascript"></script>
<script src="js/add_cat_specifications.js" type="text/javascript"></script>
<script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.js"></script>
<script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
 <script src="js/Director/app.js" type="text/javascript"></script>

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
</style>
</body>
</html>
