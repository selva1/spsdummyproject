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
        if(isset($_REQUEST['main_cat_id'])){
            $category_type_id=$_REQUEST['main_cat_id'];
        }
        else{
            $category_type_id="";
        }
        $stmt ="SELECT * FROM `tbl_category` WHERE `parent_id`=$category_type_id";
        $vid_comment =  mysqli_query($conn,$stmt);
        $results=[];
        while ($row = mysqli_fetch_assoc($vid_comment)){
            $result['category_id']=$row['category_id'];
            $result['category_name']=$row['category_name'];
            $results[]=$result;
        }
        echo json_encode($results);
        ?>
        <?php
    }
}
?>
