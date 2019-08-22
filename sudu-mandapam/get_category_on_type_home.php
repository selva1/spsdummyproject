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
        $existing_list=implode(", ",get_existing_home_cat_id());
        $stmt ="SELECT * FROM `tbl_category` WHERE `cat_type_id`=$category_type_id 
                AND `parent_id`=0 AND category_id NOT IN ($existing_list)";
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

function get_existing_home_cat_id(){
    $conn=dbconnection();
    $stmt ="SELECT categories_id FROM `home_categories_list`";
    $vid_comment =  mysqli_query($conn,$stmt);
    $results=[];
    while ($row = mysqli_fetch_assoc($vid_comment)){
        $results[]=$row['categories_id'];
    }
    return $results;

    }
?>
