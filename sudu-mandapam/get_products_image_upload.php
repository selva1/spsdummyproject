<?php 
include "include/function.php";
isNotLogin();
$conn     = dbconnection();
$edit_id  = mysqli_real_escape_string($conn,$_GET['editId']);
$rootpath = dirname(__DIR__);
$idef     = mysqli_real_escape_string($conn,$_GET['idef']);
$output =[];
if(isset($_FILES['file'])){
foreach ($_FILES['file']['name']  as $key=> $tmp_name) {
	
	$file1= time() . $_FILES['file']['name'][$key];
	$file=clean($file1);
	//$target= UPLOADPATH . $file;
	 $destination_directory = $rootpath."/productimgage/". $file;
	 $dbimglink ="/productimgage/". $file;
	move_uploaded_file($_FILES['file']['tmp_name'][$key], $destination_directory)
	or die('error with query 2');

	$stmt = $conn->prepare("INSERT INTO tbl_productImg (`product_Id`, `img_link`, `img_iden`) VALUES (?, ?, ?)");
	$stmt->bind_param("iss", $edit_id, $dbimglink, $idef);
	$stmt->execute();
	}
$output = ['error'=>'upload process done...'];
} else {
	$output = ['error'=>'upload process done...'];
}


if(isset($_FILES['file2'])){
	
foreach ($_FILES['file2']['name']  as $key=> $tmp_name) {
	
	$file2= time() . $_FILES['file2']['name'][$key];
    $file=clean($file2);
   //$target= UPLOADPATH . $file;
	$destination_directory = $rootpath."/productimgage/". $file;
	$dbimglink ="/productimgage/". $file;
	move_uploaded_file($_FILES['file2']['tmp_name'][$key], $destination_directory);
	//or die('error with query 2');

	$stmt = $conn->prepare("INSERT INTO tbl_productImg (`product_Id`, `img_link`, `img_iden`) VALUES (?, ?, ?)");
	$stmt->bind_param("iss", $edit_id, $dbimglink, $idef);
	$stmt->execute();
	}
$output = ['error'=>'upload process done...'];
} else {
	$output = ['error'=>'upload process done...'];
}
echo json_encode($output);
?>