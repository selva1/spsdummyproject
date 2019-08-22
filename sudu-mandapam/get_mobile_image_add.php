<?php
ob_start();
include "include/function.php";
isNotLogin();
$conn = dbconnection();
$cat_type   = mysqli_real_escape_string($conn,$_POST['home_cat_type']);
$category   = mysqli_real_escape_string($conn,$_POST['home_cat_select']);
$status      = mysqli_real_escape_string($conn,$_POST['status']);
$editsid     = mysqli_real_escape_string($conn,$_POST['editid']);

// prepare and bind
if($editsid==""){
    $rootpath = dirname(__DIR__);
    $target_dir = $rootpath."/assets/img/mobile/";
    $dbimglink = "/assets/img/mobile/".basename($_FILES["image"]["name"]);
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
    } else {
        "Sorry, there was an error uploading your file.";
    }

    $query = "INSERT INTO  tbl_mobile_images (`category_id`, `image_link`,`status`) VALUES ($category, '$dbimglink','$status')";
    mysqli_query($conn,$query);
    /*$stmt = $conn->prepare("INSERT INTO tbl_brands (`brand`, `brand_img`,`brand_img_over`, `brand_alis_name`, `meta_title`, `meta_keyword`, `meta_description`, `status`) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssi", $brand, $dbimglink,$dboverimglink, $links,$title,$keyword,$description,$status);
 $stmt->execute();
$conn->close();*/
}else{
    if(!empty($_FILES["image_edit"]["tmp_name"])){
        $rootpath = dirname(__DIR__);
        $target_dir = $rootpath."/assets/img/mobile/";
        $dbimglink = "/assets/img/mobile/".basename($_FILES["image_edit"]["name"]);
        $target_file = $target_dir . basename($_FILES["image_edit"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

        if (move_uploaded_file($_FILES["image_edit"]["tmp_name"], $target_file)) {
            "The file ". basename( $_FILES["image_edit"]["name"]). " has been uploaded.";
        } else {
            "Sorry, there was an error uploading your file.";
        }
        /* for loading over image */
        $stmt = $conn->prepare("UPDATE tbl_mobile_images SET image_link=? WHERE id=?");
        $stmt->bind_param('si',$dbimglink,$editsid);
        $stmt->execute();
//echo "1";
    }
    $stmt = $conn->prepare("UPDATE tbl_mobile_images SET status=? WHERE id=?");
    $stmt->bind_param('si',$status,$editsid);
    $stmt->execute();
    $conn->close();
}

echo $redirecturl="location:".$siteAdminUrl."all-mobile-images.php";
header($redirecturl);
?>