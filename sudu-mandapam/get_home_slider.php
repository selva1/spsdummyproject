<?php 
session_start();
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'homeSlider'){
include_once ("include/function.php");
$userId      = $_SESSION['userid'];
$userName    = $_SESSION['userName'];
$resultEmail = $_SESSION['resultEmail'];
isNotLogin();

$conn=dbconnection();
$ids = $_REQUEST['ids'];

$stmt = $conn->prepare("UPDATE main_Home_bottom_slider SET brand_id=? WHERE id=?");
//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
$stmt->bind_param('sssssiii', $category, $links, $title,$keyword,$description,$status,$mainselect,$editid);
$results =  $stmt->execute();
	
}
}
?>
