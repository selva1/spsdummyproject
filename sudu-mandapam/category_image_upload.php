<?php 
include "include/function.php";
isNotLogin();
$conn = dbconnection();
$edit_id = mysqli_real_escape_string($conn,$_GET['editId']);
$editVal = editCateValue($edit_id);
$rootpath = dirname(__DIR__);
/*$thumbIMG = Imgdisplay($edit_id,'thumbIMG');
print_r($thumbIMG);
$MainIMG  = Imgdisplay($edit_id,'MainIMG');*/
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
                                  Add product image
                              </header>
                               <div class="panel-body">
                                
                             
                               
                              <div class="col-lg-8">
                              
                                product Main Image ( dimension 500 X 500 )
                                
								    <input id="file" name="file[]" type="file" multiple=true class="file-loading">
    
                              </div>
                              
                             
                              <div class="col-lg-12" style="margin-top: 20px;">
                              	
  	<div class="file-preview">
							
							<div class="file-preview-thumbnails">
							<div class="file-live-thumbs">
							
							<?php    
							 $conn=dbconnection();
							 $stmt ="SELECT `category_id`, `img_link` FROM `tbl_category` WHERE category_id=$edit_id and img_link!=''";
							$vid_comment =  mysqli_query($conn,$stmt);
							@$rowcount=mysqli_num_rows($vid_comment);
							if($rowcount>0){
								
							
							while ($row = mysqli_fetch_assoc($vid_comment)){ ?>
<div data-template="image" data-fileindex="-1" id="" class="file-preview-frame file-preview-success">
							<div class="kv-file-content">
							<img style="width:auto;height:160px;"   class="kv-preview-data file-preview-image" src="<?php echo $siteUrl."".$row['img_link'];?>" />
							</div><div class="file-thumbnail-footer">
							<!--<div title="add.png" class="file-footer-caption">add.png <br><samp>(4.16 KB)</samp></div>-->
							 <div class="file-actions">
							<div class="file-footer-buttons">
						 <button title="Remove file" class="kv-file-remove btn btn-xs btn-default" type="button" onclick="deleteImgs('<?php echo $row['id']; ?>','<?php echo $row['img_link']; ?>');"><i class="glyphicon glyphicon-trash text-danger"></i></button>
							</div>

							
							<div class="clearfix"></div>
							</div>
							</div>
							</div>
						   <?php } } else{ echo "No Big images found..."; } ?>
							</div></div>
							<div class="clearfix"></div>    <div class="file-preview-status text-center text-success"></div>
							<div class="kv-fileinput-error file-error-message" style="display: none;"></div>
							
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
        <link rel="stylesheet" href="css/file-input.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="js/jquery.min.js" type="text/javascript"></script>

        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Director App -->
        <script type="text/javascript" src="js/jquery.validate.js" language="javascript"></script>
        <script src="js/common-scripts.js" type="text/javascript"></script>
       <script src="js/file-input.js" type="text/javascript"></script>
     <script>
    $("#file").fileinput({
        uploadUrl: "get_category_image_upload.php?editId=<?php echo $edit_id; ?>&idef=thumbIMG", // server upload action
        uploadAsync: true,
        maxFileCount: 100
    });
    $("#file2").fileinput({
        uploadUrl: "get_category_image_upload.php?editId=<?php echo $edit_id; ?>&idef=MainIMG", // server upload action
        uploadAsync: true,
        maxFileCount: 100
    });
    
    function deleteImgs(delId,imgUrls){
        var r = confirm("Are sure to delete image.");
		if (r == true) {
		x = "1";
		} else {
		x = "2";
		} 
	if(x=="1"){
		var delIdsdds =delId;
	//alert(actionProcess);
	var site_url              = jQuery("meta[name='siteurl']").attr("content");
	$.post("get_delete_product_img.php" , {command:'deleteProductImg',delId:delId,imgUrls:imgUrls} , function(data,status)	{
		if(jQuery.trim(data) == "true"){
			 window.location=site_url+"category_image_upload.php?editId=<?php echo $edit_id; ?>";
		}
	});	
  
	}
		
	}
    </script>
    <style>.btn.btn-file {
    height: 54px;
    overflow: hidden;
    position: relative;
    width: 120px;
}</style>

    </body>
</html>
