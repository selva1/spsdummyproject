<?php
require('config.php');
session_start();
require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
$success = true;
$error = "Payment Failed";
print_r($_REQUEST);
print_r($_SESSION);
if (empty($_POST['razorpay_payment_id']) === false){
    $api = new Api($keyId, $keySecret);
    try{
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}
if ($success === true){
    include_once $_SERVER['DOCUMENT_ROOT'].'/includes/config.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/includes/db.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/includes/functions.php';
    
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

    $Payment_type="Razorpay";
    $orderstatus = "success";
    $statement = $conn->prepare("UPDATE order_confirm_shipping_details_discount_amt SET payment_id=?,payment_signature=?,payment_type=?,order_status=? WHERE order_id=?");
    //bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
    $statement->bind_param('sssss', $_POST['razorpay_payment_id'],$_POST['razorpay_signature'],$Payment_type,$orderstatus,$orderids);
    $results =  $statement->execute();
    $redirectUrl = "Location: ".SITE_URL."order-success/?oderId=".$orderids."&metod=razorpay";
    header($redirectUrl);    
//    $html = "<p>Your payment was successful</p>
//             <p>Payment ID: {$_POST['razorpay_payment_id']}</p>";
}else{
    $redirectUrl = "Location: ".SITE_URL."order-fail/?oderId=".$orderids."&metod=razorpay";
    header($redirectUrl);  
//    $html = "<p>Your payment failed</p>
//             <p>{$error}</p>";
}
//echo $html;