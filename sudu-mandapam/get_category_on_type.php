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
        if(isset($_REQUEST['cat_type_id'])){
            $category_type_id=$_REQUEST['cat_type_id'];
        }
        else{
            $category_type_id="";
        }
        $stmt ="SELECT * FROM `home_categories_list` WHERE `cat_type_id`=$category_type_id";
        $vid_comment =  mysqli_query($conn,$stmt);
        $results=[];
        while ($row = mysqli_fetch_assoc($vid_comment)){
            $result['categories_id']=$row['categories_id'];
            $result['categories_name']=$row['categories_name'];
            $results[]=$result;
        }
        echo json_encode($results);
        ?>
        <?php
    }
}
?>
