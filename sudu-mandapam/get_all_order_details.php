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
        if($search_val!=""){
            $wherecaseselect = " and fpc.doctor_id='".$search_val."' ";
        }
        //pagination variables
        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
        /* pagenation lime based on table start */
        $per_page = 10;
        /* pagenation lime based on table end */
        //$per_page = 1; //how much records you want to show
        $adjacents  = 4; //gap between pages after number of adjacents
        $offset = ($page - 1) * $per_page;
        // relavent search  null or not condication .



        if(!empty($_REQUEST['search_val'])){
            $search_val=$_REQUEST['search_val'];
            $order_query = " and o.order_id like '$search_val%' ";
        }else {
            $search_val="";
            $order_query = "";
        }
        if(!empty($_REQUEST['str_check'])){
            $chek_box_val = $_REQUEST['str_check'];
            $cat_type_idvalue = " and cat_type_id='$chek_box_val' ";


        }else {
            $chek_box_val="";
            $cat_type_idvalue ="";
        }

        $query = "SELECT  o.order_id,o.created_date
                  FROM tbl_orders_cofirm o 
                  INNER JOIN hm_users u 
                  ON o.user_id=u.id 
                  where o.id!='' ".$order_query."GROUP BY o.order_id,o.created_date order by o.created_date DESC";
        
        $conn->set_charset("utf8");
        $query_vals    = mysqli_query($conn,$query);
        $numrows = mysqli_num_rows($query_vals);
        $total_pages = ceil($numrows/$per_page);
        $result_final = mysqli_query($conn,$query. " LIMIT ".$offset.",".$per_page."");
        //loop through fetched data
        if($numrows>0){
            $bgcolor="#EEEEEE"; ?>

            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#d</th>
                    <th>User Email</th>
                    <th>Shipping Name</th>
                    <th>Phone</th>
                    <th>Order Id</th>
                    <th>Order Date Time</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i=1;
                while($result = mysqli_fetch_array($result_final)){
                	$orderids = $result['order_id'];
                	
        $query1 = "SELECT   u.name,u.email, o.qut, o.user_id,o.created_date,u.shipping_mobile,o.order_id,o.id as order_confirm_id, u.id as user_id 
                  FROM tbl_orders_cofirm o 
                  INNER JOIN hm_users u 
                  ON o.user_id=u.id 
                  where o.id!=''  and order_id='$orderids' ";
                	        $query_vals1    = mysqli_query($conn,$query1);
                  $result1 = mysqli_fetch_array($query_vals1);
                	
                     $result1['status']=get_order_status($result1['order_id']);
                    if($bgcolor=='#EEEEEE'){
                        $bgcolor='#fff';
                    }else {
                        $bgcolor='#EEEEEE';
                    }
                    $user_name        = $result1['name'];
                    $email     = $result1['email'];
                    $order_id         = $result1['order_id'];
                    $mobile           = $result1['shipping_mobile'];
                    $quantity         = $result1['qut'];
					$created_date         = $result1['created_date'];

                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo htmlentities($email); ?></td>
                        <td><?php echo htmlentities($user_name); ?></td>
                        <td><?php echo htmlentities($mobile); ?></td>
                        <td><?php echo $order_id; ?></td>
                        <td><?php echo date('d-m-Y h:i:s a', strtotime($created_date)); ?></td>
                        <td> <a href="order_details.php?orderId=<?php echo $order_id; ?>">View</a> |
                            <?php
                                $pro_selected="";$ship_selected="";$del_selected="";$can_selected="";
                            if($result['status']=='Processing')
                                $pro_selected ="selected=selected";
                            else if($result['status']=='Shipped')
                                $ship_selected ="selected=selected";
                            else if($result['status']=='Delivered')
                                $del_selected ="selected=selected";
                            else if($result['status']=='Cancelled')
                                $can_selected ="selected=selected";
                            ?>
                            <select id="order_status_<?php echo $i;?>" name="order_status">
                                <option value="0">Select Status</option>
                                <option value="Processing" <?php echo $pro_selected; ?>>Processing</option>
                                <option value="Shipped" <?php echo $ship_selected; ?>>Shipped</option>
                                <option value="Delivered" <?php echo $del_selected; ?>>Delivered</option>
                                <option value="Cancelled" <?php echo $can_selected; ?>>Cancelled</option>
                            </select>
                            <script>
                                $(document).ready(function () {
                                    var select_id="order_status_<?php echo $i;?>";
                                    var order_id='<?php echo $order_id;?>';
                                    $("#"+select_id).change(function () {
                                        var r = confirm("Are you sure you want to update this status?");
                                        if (r == true) {
                                            updateOrderStatus($(this).val(),order_id);
                                        } else {
                                            $("#"+select_id).val($(this).val());
                                            return false;
                                        }

                                    });
                                });
                            </script>
                            <!--| <a href="javascript:void(0);" onclick="deleteColor(<?php /*echo $id; */?>);">Delete</a>--></td>
                    </tr>

                    <?php $i++;
                } ?>
                </tbody>
            </table>
            </div>
            <?php
            echo paginateAllOrderList($reload, $page, $total_pages, $adjacents,$search_val,$chek_box_val,$let_search,$type_val,$ids_indst);
        } else {
            echo "Sorry, no results matched your search criteria.";
        }
        ?>

        <?php
    }
}

?>
<script>
    function updateOrderStatus(status,order_id) {
            var site_url = jQuery("meta[name='siteurl']").attr("content");
            $.post("ajax_all_add_edits.php" , {command:'UpdateOrderStatus',status:status,order_id:order_id} , function(data,status)	{
                /*if(jQuery.trim(data) == "1"){
                    window.location=site_url+"all-home-categories.php";
                }*///alert("updated");alert(data);
            });
    }
</script>