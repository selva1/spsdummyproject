<?php
ob_start();
include "include/function.php";
isNotLogin();
$conn = dbconnection();

$mainselect  = mysqli_real_escape_string($conn,$_POST['mainselect']);
$categories  = mysqli_real_escape_string($conn,$_POST['categories']);
$image_edit  = mysqli_real_escape_string($conn,$_POST['image_edit']);
$status      = mysqli_real_escape_string($conn,$_POST['status']);
$editsid     = mysqli_real_escape_string($conn,$_POST['editid']);
//$description = str_replace("\r\n",'', $description);
// prepare and bind
if($editsid==""){
	
	$rootpath = dirname(__DIR__);
$target_dir = $rootpath."/assets/second-home/";
$dbimglink = "/assets/second-home/".basename($_FILES["image"]["name"]);
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

 if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
         "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
    } else {
         "Sorry, there was an error uploading your file.";
    }
	
	$stmt = $conn->prepare("INSERT INTO home_categories_slider_list (`categories_id`, `cat_type_id`, `img_name`, `img_status`) VALUES (?, ?, ?, ?)");
$stmt->bind_param("iisi", $categories, $mainselect, $dbimglink,$status);
$stmt->execute();
$conn->close();
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
$stmt = $conn->prepare("UPDATE home_categories_slider_list SET categories_id=?, cat_type_id=?,img_name=?,img_status=? WHERE id=?");
$stmt->bind_param('iisii', $categories, $mainselect, $dbimglink,$status,$editsid);
$stmt->execute();
//echo "1";
$conn->close();
} else {
$stmt = $conn->prepare("UPDATE home_categories_slider_list SET categories_id=?, cat_type_id=?, img_status=? WHERE id=?");
$stmt->bind_param('iisi',  $categories, $mainselect,$status,$editsid);
$stmt->execute();	
}

}
$redirecturl="location:".$siteAdminUrl."all-categories-slider-img-list.php";
header($redirecturl);


?>