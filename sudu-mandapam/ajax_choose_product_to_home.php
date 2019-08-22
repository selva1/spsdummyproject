<?php
session_start();
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if($action == 'ajax'){
        include_once ("include/function.php");

        $userId      = $_SESSION['userid'];
        $userName    = $_SESSION['userName'];
        $resultEmail = $_SESSION['resultEmail'];

        isNotLogin();
        $conn=dbconnection();
        if(isset($_REQUEST['pro_id'])){
            $product=$_REQUEST['pro_id'];
        }
        else{
            $product="";
        }
        $stmt = $conn->prepare("UPDATE tbl_products SET is_added_to_home=1 WHERE ProductID=$product");
        $results =  $stmt->execute();
        if($results){
            echo "1";
        }else{
            echo "0";
        }
    }
}
?>
