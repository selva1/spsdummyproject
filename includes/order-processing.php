<?php 
$login_status = loginStatus();
if($login_status=="EmptySession"){
$redirecturl="location:".SITE_URL."login/";
header($redirecturl);
}
if(empty($_SESSION['cartSessionId'])){
	$redirectUrl = "Location: ".SITE_URL;
	header($redirectUrl);
}
$conn=dbconnection();
$userid = $_SESSION['userid'];
$cartSession =  $_SESSION['cartSessionId'];
$orderids = $_SESSION['orderids'];	
$stmt = "SELECT `shipping_cost`,`disout_amt`,total,grand_total FROM `order_confirm_shipping_details_discount_amt` where user_id='$userid' and order_id='$orderids' ";
// Bind the variables to the parameter as strings. 
$resultscont=mysqli_query($conn,$stmt);
$row_cnts = mysqli_num_rows($resultscont);
$row_cntcont = mysqli_fetch_array($resultscont);
$shipping_cost = $row_cntcont['shipping_cost'];
$disout_amt    = $row_cntcont['disout_amt'];
$grand_total   = $row_cntcont['grand_total'];




$checkoutedits = checkoutedits($userid);
$surl=SITE_URL."payment-success/";
$furl=SITE_URL."payment-success/";	
$MERCHANT_KEY = "64ca76nM";
$SALT = "Lzrgeq5bat";
$PAYU_BASE_URL = "https://secure.payu.in";
$action = '';

$posted = array();
if(!empty($_POST)) {
foreach($_POST as $key => $value) {    
$posted[$key] = $value; 
}
}
$formError = 0;
if(empty($posted['txnid'])) {
$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
$txnid = $posted['txnid'];
}
$hash = '';
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) {
if(
empty($posted['key'])
|| empty($posted['txnid'])
|| empty($posted['amount'])
|| empty($posted['firstname'])
|| empty($posted['email'])
|| empty($posted['phone'])
|| empty($posted['productinfo'])
|| empty($posted['surl'])
|| empty($posted['furl'])
|| empty($posted['service_provider'])
  
) {
$formError = 1;

} else {
$hashVarsSeq = explode('|', $hashSequence);
$hash_string = '';	
foreach($hashVarsSeq as $hash_var) {
$hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
$hash_string .= '|';
}
$hash_string .= $SALT;
$hash = strtolower(hash('sha512', $hash_string));
$action = $PAYU_BASE_URL . '/_payment';
}
} elseif(!empty($posted['hash'])) {
$hash = $posted['hash'];
$action = $PAYU_BASE_URL . '/_payment';
}
$Payment_type="PAYMENT GATEWAY";
$orderstatus = "failed";
$statement = $conn->prepare("UPDATE order_confirm_shipping_details_discount_amt SET trx_id=?, order_status=? WHERE order_id=?");
//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
$statement->bind_param('ssss', $txnid,  $orderstatus,$orderids);
$results =  $statement->execute();

?>
      <form action="<?php echo $action; ?>" method="post" name="payuForm" id="payuForm">
      <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
      <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
      <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
      <input type="hidden" name="surl" value="<?php echo $surl ?>" />
      <input type="hidden" name="furl" value="<?php echo $furl ?>" />
      <input type="hidden" name="amount" value="<?php echo $grand_total; ?>" />
	  <input type="hidden" name="productinfo" value="<?php echo $orderids; ?>" />
	  <input type="hidden"  name="firstname" id="firstname" value="<?php echo $checkoutedits['name']; ?>" />
	  <input type="hidden"  name="email" id="email" value="<?php echo $checkoutedits['shipping_email']; ?>" />
	  <input type="hidden" name="phone" value="<?php echo $checkoutedits['shipping_mobile']; ?>" />
	  <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
      <table>
        <tr>
<!--            <td colspan="4"><input type="submit" value="Submit" /></td>
-->        </tr>
      </table>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script>
      	$("body").ready(function(){
    	$('#payuForm').submit();
    	});
      </script>
