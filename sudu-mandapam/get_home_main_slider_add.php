<?php
ob_start();
include "include/function.php";
isNotLogin();
$conn = dbconnection();

$mainselect  = mysqli_real_escape_string($conn,$_POST['mainselect']);
$description = mysqli_real_escape_string($conn,$_POST['description']);
$status      = mysqli_real_escape_string($conn,$_POST['status']);
$editsid     = mysqli_real_escape_string($conn,$_POST['editid']);
$description = str_replace("\r\n",'', $description);

$title     = mysqli_real_escape_string($conn,$_POST['slider_title']);
$blog_link     = mysqli_real_escape_string($conn,$_POST['blog_link']);
$enable_read_more     = mysqli_real_escape_string($conn,$_POST['enable_read_more']);

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
$sql= "insert into main_Home_slider (`cat_type_id`, `img`, `descr`, `title`, `blog_link`, `active_read_more`, `status`) values ($mainselect,'$dbimglink', '$description', '$title', '$blog_link', '$enable_read_more', $status)";
    /*$stmt = $conn->prepare("INSERT INTO main_Home_slider (`cat_type_id`, `img`, `descr`, `title`, `blog_link`, `active_read_more`, `status`) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("issi", $mainselect, $dbimglink, $description, $title, $blog_link, '$enable_read_more', $status);
$stmt->execute();*/
    $conn->set_charset("utf8");
    $conn->query($sql);
    $conn->close();
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
/*$stmt = $conn->prepare("UPDATE main_Home_slider SET cat_type_id=?, img=?,descr=?,status=?,title=?,blog_link=?,active_read_more=? WHERE id=?");
$stmt->bind_param('issii', $mainselect, $dbimglink,$description,$status,$title,$blog_link,$enable_read_more,$editsid);
    $stmt->execute();*/
    $stmt = "UPDATE main_Home_slider 
                    SET cat_type_id=$mainselect, 
                    img='$dbimglink',descr='$description',
                    status=$status,title='$title',blog_link='$blog_link',active_read_more=$enable_read_more WHERE id=$editsid";
    $conn->query($stmt);
//echo "1";
$conn->close();
} else {
/*$stmt = $conn->prepare("UPDATE main_Home_slider SET cat_type_id=?, descr=?,status=?,descr=?,status=?,title=?,blog_link=? WHERE id=?");
$stmt->bind_param('isii',  $mainselect,$description,$status,$title,$blog_link,$enable_read_more,$editsid);
$stmt->execute();	*/
    $stmtq = "UPDATE main_Home_slider 
                    SET cat_type_id=$mainselect, 
                    descr='$description',
                    status=$status,title='$title',blog_link='$blog_link',active_read_more=$enable_read_more WHERE id=$editsid";
   $conn->query($stmtq);
}

}
$redirecturl="location:".$siteAdminUrl."all-second-main-slider-list.php";
header($redirecturl);


?>