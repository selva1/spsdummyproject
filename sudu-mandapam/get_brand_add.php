<?php
ob_start();
include "include/function.php";
isNotLogin();
$conn = dbconnection();
$brand   = mysqli_real_escape_string($conn,$_POST['brand']);
$links   = mysqli_real_escape_string($conn,$_POST['links']);
$title   = mysqli_real_escape_string($conn,$_POST['title']);
$keyword = mysqli_real_escape_string($conn,$_POST['keyword']);
$description = mysqli_real_escape_string($conn,$_POST['description']);
$status      = mysqli_real_escape_string($conn,$_POST['status']);
$editsid     = mysqli_real_escape_string($conn,$_POST['editid']);


// prepare and bind
if($editsid==""){
	
	$rootpath = dirname(__DIR__);
$target_dir = $rootpath."/img/brands/";
$dbimglink = "/img/brands/".basename($_FILES["image"]["name"]);
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

 if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
         "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
    } else {
         "Sorry, there was an error uploading your file.";
    }
	$dboverimglink = "/img/brands/".basename($_FILES["image_over"]["name"]);
$target_file_over = $target_dir . basename($_FILES["image_over"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file_over,PATHINFO_EXTENSION);

 if (move_uploaded_file($_FILES["image_over"]["tmp_name"], $target_file_over)) {
          "The file ". basename( $_FILES["image_over"]["name"]). " has been uploaded.";
    } else {
          "Sorry, there was an error uploading your file.";
    }
    
    $query = "INSERT INTO tbl_brands (`brand`, `brand_img`,`brand_img_over`, `brand_alis_name`, `meta_title`, `meta_keyword`, `meta_description`, `status`) VALUES ('$brand', '$dbimglink','$dboverimglink','$links','$title','$keyword','$description','$status')";
mysqli_query($conn,$query);
	/*$stmt = $conn->prepare("INSERT INTO tbl_brands (`brand`, `brand_img`,`brand_img_over`, `brand_alis_name`, `meta_title`, `meta_keyword`, `meta_description`, `status`) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssi", $brand, $dbimglink,$dboverimglink, $links,$title,$keyword,$description,$status);
 $stmt->execute();
$conn->close();*/
}else{

if(!empty($_FILES["image_edit"]["tmp_name"])){
$rootpath = dirname(__DIR__);
$target_dir = $rootpath."/img/brands/";
$dbimglink = "/img/brands/".basename($_FILES["image_edit"]["name"]);
$target_file = $target_dir . basename($_FILES["image_edit"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

 if (move_uploaded_file($_FILES["image_edit"]["tmp_name"], $target_file)) {
         "The file ". basename( $_FILES["image_edit"]["name"]). " has been uploaded.";
    } else {
         "Sorry, there was an error uploading your file.";
    }
    /* for loading over image */
$stmt = $conn->prepare("UPDATE tbl_brands SET brand_img=? WHERE id=?");
$stmt->bind_param('si',$dbimglink,$editsid);
$stmt->execute();
//echo "1";
}
if(!empty($_FILES["image_over_edit"]["tmp_name"])){
$rootpath = dirname(__DIR__);
$target_dir = $rootpath."/img/brands/";
$dbimglink = "/img/brands/".basename($_FILES["image_over_edit"]["name"]);
$target_file = $target_dir . basename($_FILES["image_over_edit"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

 if (move_uploaded_file($_FILES["image_over_edit"]["tmp_name"], $target_file)) {
         "The file ". basename( $_FILES["image_over_edit"]["name"]). " has been uploaded.";
    } else {
         "Sorry, there was an error uploading your file.";
    }
    /* for loading over image */
$stmt = $conn->prepare("UPDATE tbl_brands SET brand_img_over=? WHERE id=?");
$stmt->bind_param('si',$dbimglink,$editsid);
$stmt->execute();
//echo "1";

}
$stmt_new = $conn->prepare("UPDATE tbl_brands SET brand=?, brand_alis_name=?,meta_title=?,meta_keyword=?,meta_description=?,status=? WHERE id=?");
$stmt_new->bind_param('sssssii', $brand, $links,$title,$keyword,$description,$status,$editsid);
$stmt_new->execute();   
$conn->close();
}

echo $redirecturl="location:".$siteAdminUrl."all-brand-list.php";
header($redirecturl);
?>