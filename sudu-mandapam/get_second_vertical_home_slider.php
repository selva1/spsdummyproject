<?php 
session_start();
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
$action = (isset($_REQUEST['command'])&& $_REQUEST['command'] !=NULL)?$_REQUEST['command']:'';
if($action == 'catVals'){
		include_once ("include/function.php");
		$catsd       = $_REQUEST['catsd'];
		$idsz        = $_REQUEST['idsz'];
		$brandIds    = $_REQUEST['brandIds'];

		//$resultEmail = $_SESSION['resultEmail'];
		isNotLogin();

		$conn=dbconnection();
		//$ids = $_REQUEST['ids'];

		if($catsd=="1"){
		$stmt = $conn->prepare("UPDATE tbl_brands SET home_page_brand_cat_id=?,	cat_type_1=? WHERE id=?");
		$stmt->bind_param('sii', $idsz, $catsd,$brandIds);
		$results =  $stmt->execute();
			echo "1";
		}else if($catsd=="2"){

		$stmt = $conn->prepare("UPDATE tbl_brands SET home_page_brand_cat_id_1=?,	cat_type_2=? WHERE id=?");
		$stmt->bind_param('sii', $idsz, $catsd,$brandIds);
		$results =  $stmt->execute();
		echo "1";
	}
	
	
}
}
?>
