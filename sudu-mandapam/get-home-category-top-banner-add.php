<?php
ob_start();
include "include/function.php";
isNotLogin();
$conn = dbconnection();

$mainselect  = mysqli_real_escape_string($conn,$_POST['mainselect']);
$categories  = mysqli_real_escape_string($conn,$_POST['categories']);
$image_edit  = mysqli_real_escape_string($conn,$_POST['image_edit']);
$status      = mysqli_real_escape_string($conn,$_POST['status']);
$title       = mysqli_real_escape_string($conn,$_POST['title']);
$orderby     = mysqli_real_escape_string($conn,$_POST['orderby']);
$editsid     = mysqli_real_escape_string($conn,$_POST['editid']);
//$description = str_replace("\r\n",'', $description);

$getcatoryparentid = getCategoryparentId($categories);


// prepare and bind
if($editsid==""){
	
	$rootpath = dirname(__DIR__);
$target_dir = $rootpath."/assets/second-home/";
echo $dbimglink = "/assets/second-home/".basename($_FILES["image"]["name"]);
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

 if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo  "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
    } else {
       echo   "Sorry, there was an error uploading your file.";
    }
	
	$stmt = "INSERT INTO home_categories_top_banner_list (`categories_id`, `cat_type_id`, `img_name`, `img_status`,title,orderby,cat_parent_id) VALUES ('$categories', '$mainselect', '$dbimglink','$status','$title','$orderby','$getcatoryparentid')";
	mysqli_query($conn,$stmt);
	
}else{

if(!empty($_FILES["image_edit"]["tmp_name"])){
$rootpath = dirname(__DIR__);
$target_dir = $rootpath."/assets/second-home/";
$dbimglink = "/assets/second-home/".basename($_FILES["image_edit"]["name"]);
$target_file = $target_dir . basename($_FILES["image_edit"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

 if (move_uploaded_file($_FILES["image_edit"]["tmp_name"], $target_file)) {
         "The file ". basename( $_FILES["image_edit"]["name"]). " has been uploaded.";
    } else {
         "Sorry, there was an error uploading your file.";
    }
/*$stmt = $conn->prepare("UPDATE home_categories_top_banner_list SET categories_id=?, cat_type_id=?,img_name=?,img_status=?,title=?,orderby=?,cat_parent_id=? WHERE id=?");
$stmt->bind_param('iisisiii', $categories, $mainselect, $dbimglink,$status,$title,$orderby,$getcatoryparentid,$editsid);
$stmt->execute();
//echo "1";
$conn->close();*/
mysqli_query($conn,"UPDATE home_categories_top_banner_list SET categories_id='$categories',img_name='$dbimglink', cat_type_id='$mainselect', img_status='$status', title='$title', orderby='$orderby',cat_parent_id='$getcatoryparentid' WHERE id=$editsid");

} else {
mysqli_query($conn,"UPDATE home_categories_top_banner_list SET categories_id='$categories', cat_type_id='$mainselect', img_status='$status', title='$title', orderby='$orderby',cat_parent_id='$getcatoryparentid' WHERE id=$editsid");

}

}
$redirecturl="location:".$siteAdminUrl."all-categories-top-banner-list.php";
header($redirecturl);


?>