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
    $stmt = $conn->prepare("UPDATE tbl_category SET img_link=? WHERE category_id=?");
			//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
			$stmt->bind_param('si', $dbimglink, $edit_id);
			$results =  $stmt->execute();
//   echo $uploadimg = 'UPDATE tbl_category SET img_link='$dbimglink'  WHERE category_id=$edit_id';
//    mysqli_query($conn,$uploadimg);
// 	$stmt = $conn->prepare("INSERT INTO tbl_category (`img_link`) VALUES (?)");
// 	$stmt->bind_param("s", $dbimglink);
// 	$stmt->execute();
	}
$output = ['error'=>'upload process done...'];
} else {
	$output = ['error'=>'upload process done...'];
}


echo json_encode($output);
?>