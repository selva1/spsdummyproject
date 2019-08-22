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

$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$tranx_ids    =$_GET["tranx"];
$dis_random   =$_GET["offrand"];
$email=$_POST["email"];
$salt="Lzrgeq5bat";
if($status=="success"){
	
	If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        
                  }
 else {   
 
        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
 
         }
 $hash = hash("sha512", $retHashSeq);
 
       if ($hash != $posted_hash) {
        echo "Invalid Transaction. Please try again";
    }
    else {
              
          echo "<h3>Thank You. Your order status is ". $status .".</h3>";
          echo "<h4>Your Transaction ID for this transaction is ".$txnid.".</h4>";
          echo "<h4>Your Order ID for this Order is ".$productinfo.".</h4>";
          echo "<h4>We have received a payment of Rs. " . $amount . ". Your order will soon be shipped.</h4>";
           
			$Payment_type="PAYMENT GATEWAY";
			$orderstatus = "success";
			$statement = $conn->prepare("UPDATE order_confirm_shipping_details_discount_amt SET trx_id=?, payment_type=?, order_status=? WHERE order_id=?");
			//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
			$statement->bind_param('ssss', $txnid, $Payment_type, $orderstatus,$productinfo);
			$results =  $statement->execute();
			unset($_SESSION['cartSessionId']);
			unset($_SESSION['orderids']);
			unset($_GET);
    } 

}

if($status=="failure"){
	
	If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        
                  }
	else {	  

        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;

         }
		 $hash = hash("sha512", $retHashSeq);
  
       if ($hash != $posted_hash) {
	       echo "Invalid Transaction. Please try again";
		   }
	   else {

         echo "<h3>Your order status is ". $status .".</h3>";
         echo "<h4>Your transaction id for this transaction is ".$txnid.". You may try making the payment by clicking the link below.</h4>";
          
			$Payment_type="PAYMENT GATEWAY";
			$orderstatus = "failed";
			$statement = $conn->prepare("UPDATE order_confirm_shipping_details_discount_amt SET trx_id=?, payment_type=?, order_status=? WHERE order_id=?");
			//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
			$statement->bind_param('ssss', $txnid, $Payment_type, $orderstatus,$productinfo);
			$results =  $statement->execute();
          
		 } 
		 
		 
}
unset($_POST);
?>