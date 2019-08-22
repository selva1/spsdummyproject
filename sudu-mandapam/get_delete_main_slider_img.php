<?php
include "include/function.php";
isNotLogin();
$conn = dbconnection();
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {	
$command      = mysqli_real_escape_string($conn,$_POST['command']);
$delId        = mysqli_real_escape_string($conn,$_POST['delId']);
$imgUrls      = mysqli_real_escape_string($conn,$_POST['imgUrls']);

// delete record from database
if ($stmt = $conn->prepare("DELETE FROM main_Home_slider WHERE id = ? LIMIT 1"))
{
$stmt->bind_param("i",$delId);
$stmt->execute();
$stmt->close();
/*$rootpath = dirname(__DIR__);
$filename=$rootpath."".$imgUrls;
unlink($filename);*/

echo "true";
}
else
{
echo "false";
}
$conn->close();
}
?>