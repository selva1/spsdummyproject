<?php 
$login_status = loginStatus();
if($login_status=="EmptySession"){
$redirecturl="location:".SITE_URL."index/";
header($redirecturl);
}

$conn=dbconnection();
$userid = $_SESSION['userid'];
$currentDate = date("Ymd");
$orderId = $currentDate.time().$userid;
$cartSession =  $_SESSION['cartSessionId'];
?>
<?php
	function get_user_order_history_head($ordderid)
	{
		$conn = dbconnection();
		/*$query = "SELECT ocs.order_id,ocs.grand_total,ocs.status_change_date,oc.order_id,ocs.order_status FROM `tbl_orders_cofirm` oc 
					INNER JOIN `order_confirm_shipping_details_discount_amt` ocs 
					ON oc.order_id=ocs.order_id
					WHERE oc.user_id = $userid GROUP BY ocs.order_id,ocs.grand_total,ocs.status_change_date,oc.order_id,ocs.order_status";*/
					$query = "SELECT ocs.order_id,ocs.grand_total,ocs.status_change_date,oc.order_id,ocs.order_status,oc.productId,oc.created_date FROM `tbl_orders_cofirm` oc 
					INNER JOIN `order_confirm_shipping_details_discount_amt` ocs 
					ON oc.order_id=ocs.order_id
					WHERE oc.order_id = '$ordderid' ";
		$conn->set_charset("utf8");
		$query_vals = mysqli_query($conn, $query);
		$numrows = mysqli_num_rows($query_vals);
		$result_final = mysqli_query($conn, $query);
		if ($numrows > 0) {
			return $result_final;
		} else {
			return FALSE;
		}
	}
function get_user_order_history_pdetails($order_id)
{
	$conn = dbconnection();
	 $query = "SELECT * FROM `tbl_orders_cofirm` oc
			INNER JOIN `tbl_products` p 
			ON p.ProductID=oc.productId
			INNER JOIN `tbl_colors` col
			ON p.Color=col.id
			WHERE oc.order_id = '$order_id'  ";
	$conn->set_charset("utf8");
	$query_vals = mysqli_query($conn, $query);
	$numrows = mysqli_num_rows($query_vals);
	$result_final = mysqli_query($conn, $query);
	if ($numrows > 0) {
		return $result_final;
	} else {
		return FALSE;
	}
}
function get_user_contact_details($order_id){
	$conn=dbconnection();
	/*$query="SELECT oc.order_id,oc.user_id,u.shipping_address,u.city,u.districk,u.zip FROM `tbl_orders_cofirm` oc
 			LEFT OUTER JOIN `hm_users` u 
 			ON oc.user_id=u.id
 			WHERE oc.order_id = '$order_id' GROUP BY oc.order_id,oc.user_id,u.shipping_address,u.city,u.districk,u.zip";*/
 			$query="SELECT oc.order_id,oc.user_id,u.shipping_address,u.city,u.districk,u.zip FROM `tbl_orders_cofirm` oc
 			LEFT OUTER JOIN `hm_users` u 
 			ON oc.user_id=u.id
 			WHERE oc.order_id = '$order_id' ";
	$conn->set_charset("utf8");
	$query_vals    = mysqli_query($conn,$query);
	$numrows = mysqli_num_rows($query_vals);
	$result_final = mysqli_query($conn,$query);
	$address_details=[];
	if($numrows>0){
		while($result = mysqli_fetch_array($result_final)){
			$address_details['address']=$result['shipping_address'];
			$address_details['city']=$result['city'];
			$address_details['districk']=$result['districk'];
			$address_details['zip']=$result['zip'];
		}
		return $address_details;
	} else {
		return FALSE;
	}

}

?>
<div class="col-md-12">
<h1 style="font-size:18px; margin:10px;"> Order History </h1>
<?php 
$queryorders = "SELECT oc.order_id,oc.created_date FROM `tbl_orders_cofirm` oc WHERE oc.user_id = $userid GROUP BY oc.order_id,oc.created_date order by oc.created_date DESC ";
		$conn->set_charset("utf8");
		$query_vals1 = mysqli_query($conn, $queryorders);

while($result = mysqli_fetch_array($query_vals1)){
	$order_id = $result['order_id'];
	$order_history_details=get_user_order_history_head($order_id);

	$result = mysqli_fetch_array($order_history_details);
	
	$contact_details=get_user_contact_details($result['order_id']);?>
	<table class="table history_table">
		<thead class="order_history_head">
			<th> Order ID/No : #<?php echo $result['order_id'];?> </th>
			<th> Placed on : <?php echo $result['created_date']; ?>  </th>
			<th> Total: Rs <?php echo amountformat($result['grand_total']); ?></th>
			<th> Status : <?php echo $result['order_status'];?> on <?php echo date("d-m-Y", strtotime($result['status_change_date']));?> </th>
		</thead>
		<tbody>
		<?php $order_history_Product_details=get_user_order_history_pdetails($result['order_id']);
		$count=0;
		while($pdetails = mysqli_fetch_array($order_history_Product_details)){
				$productids = $pdetails['productId'];

			$total = ($pdetails['price'] * $pdetails['qut']);
			?>
			<tr>
			 <td>
				 <div class="product_image">
				 <?php
				 $conn=dbconnection();
				  $stmt = "SELECT `id`,`img_link` FROM `tbl_productImg` where img_iden='thumbIMG' and product_Id='$productids' ";
		// Bind the variables to the parameter as strings. 
	$resultscont=mysqli_query($conn,$stmt);
	$row_cnts = mysqli_num_rows($resultscont);
	$row_cntcont = mysqli_fetch_array($resultscont); ?>
					 <?php if($row_cntcont['img_link']=="")
						 $img_url=SITE_URL."assets/img/No-Image.jpg";
						 else
						 $img_url=SITE_URL.$row_cntcont['img_link'];?>
					 <img class="img-fluid" style="height:100px;" src="<?php echo $img_url?>" alt="img" height="60">
				 </div>
				 <div class="product_desc">
					 <a class="aa-cart-title" href="<?php echo SITE_URL;?><?php echo $pdetails['product_alis_link']; ?>"><?php echo $pdetails['Title']; ?></a>
					 <p> Color : <?php echo $pdetails['color']; ?> </p>
					 <p> Quantity : <?php echo $pdetails['qut']; ?></p>
					 <p> </p>
				 </div>
			 </td>

			 <td>Price : Rs <?php echo amountformat($pdetails['price']); ?>.00</td>

			 <td>Rs <?php echo amountformat($total); ?>.00</td>
				<?php $count++;
				if($count==1) { ?>
				<td rowspan="<?php echo $count; ?>"> 
				<p><?php echo $result['order_status'];?> on <?php echo date("d-m-Y", strtotime($result['status_change_date']));?></p>
				<strong> Shipping Address : </strong>
				        
						<p> <?php echo $contact_details['address'];?></p>
						<p><?php echo $contact_details['city'];?></p>
						<p> <?php echo $contact_details['districk'].' - '.$contact_details['zip'];?></p>
					</td>
				<?php }else {?>
				<td><?php echo $result['order_status'];?> on <?php echo date("d-m-Y", strtotime($result['status_change_date']));?></td>
				<?php } ?>
			</tr>
		<?php }?>

		</tbody>
	</table>
<?php }?>
