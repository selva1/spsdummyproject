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
        if(isset($_REQUEST['cat_id'])){
            $category_id=$_REQUEST['cat_id'];
        }
        else{
            $category_id="";
        }
        $stmt ="SELECT * FROM `tbl_products` WHERE `cat_id`=$category_id order by ProductID desc";
        mysqli_set_charset($conn,"utf8");
        $vid_comment =  mysqli_query($conn,$stmt);
        $results=[];
        while ($row = mysqli_fetch_assoc($vid_comment)){
            $result['ProductID']=$row['ProductID'];
            $result['Title']=$row['Title'];
            $results[]=$result;
        }
        echo json_encode($results);
        ?>
        <?php
    }
}
?>
