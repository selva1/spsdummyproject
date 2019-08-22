<?php
session_start();
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';
    if ($action == 'ajax') {
        include_once("include/function.php");

        $userId = $_SESSION['userid'];
        $userName = $_SESSION['userName'];
        $resultEmail = $_SESSION['resultEmail'];

        isNotLogin();
        $conn = dbconnection();
        if (isset($_REQUEST['cat_type'])) {
            $cat_type = $_REQUEST['cat_type'];
        } else {
            $cat_type = "";
        }
        if (isset($_REQUEST['cat_id'])) {
            $cat_id = $_REQUEST['cat_id'];
        } else {
            $cat_id = "";
        }
        if (isset($_REQUEST['status'])) {
            $status = $_REQUEST['status'];
        } else {
            $status = "";
        }
        if (isset($_REQUEST['order_by'])) {
            $order_by = $_REQUEST['order_by'];
        } else {
            $order_by = "";
        }
        if (isset($_REQUEST['edit_id'])) {
            $editid = $_REQUEST['edit_id'];
        } else {
            $editid = "";
        }
        if ($editid != "") {
            $stmt = $conn->prepare("UPDATE home_categories_list SET order_by_id=?, cats_status=? WHERE id=?");
             //bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
             $stmt->bind_param('sii', $order_by,$status,$editid);
             $conn->set_charset("utf8");
             $stmt->execute();
             echo "2";
        } else {
            $cat_name=get_category_name_on_id($cat_id);
            $stmt = "INSERT INTO home_categories_list ( `categories_id`, `cat_type_id`,`categories_name`,`order_by_id`,`cats_status`)
                      VALUES ($cat_id,$cat_type,'$cat_name',$order_by,$status)";
            $conn->set_charset("utf8");
            $conn->query($stmt);
            echo "1";
        }

    }
}

    function get_category_name_on_id($cat_id){
        $conn=dbconnection();
        $stmt ="SELECT category_name FROM `tbl_category` WHERE `category_id`=$cat_id";
        $conn->set_charset("utf8");
        if ($result=mysqli_query($conn,$stmt))
        {
            while ($row=mysqli_fetch_row($result))
            {
                return $row[0];
            }
        }

    }



?>
