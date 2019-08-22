<?php
include_once "include/function.php";
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	if(isset($_POST['action']) && $_POST['action'] == 'login'){ // Check the action `login`
		 $loginVals = login();
        echo json_encode($loginVals);
	}
}
?>