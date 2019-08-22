<div class="col-md-12">
<?php 
$orderid=$_GET['oderId'];
$metod = $_GET['metod'];


 if($orderid!='')
 {
	  ?>
	  <?php if($metod=="BankDeposit"){ ?>
	<h1 class="succ_head" style="margin-top: 50px;"> your order is sucessfully placed!  	Thank you for choosing www.srikumaransupermarket.com.com</h1>
		<h3 class="red_text"> Order # : <?php echo $orderid; ?></h3>
	  	<p>Your order has been received and is now being processed. Your order details are shown below for your reference:</p>
	
	<?php }	else if($metod=="COD"){ ?>
		<h1 class="succ_head" style="font-size"> your order is sucessfully placed!  	Thank you for choosing HotMall</h1>
		<h3 class="red_text"> Order # : <?php echo $orderid; ?></h3>
	  	<p>Your order has been received and is now being processed. Your order details are shown below for your reference:</p>

		<p>Pay with cash upon delivery or via Mpesa PayBill No:222196</p>
		<?php
	}else if($metod=="razorpay"){ ?>
        <h1 class="succ_head" style="margin-top: 50px;"> your order is sucessfully placed!  	Thank you for choosing www.srikumaransupermarket.com.com</h1>
		<h3 class="red_text"> Order # : <?php echo $orderid; ?></h3>
	  	<p>Your order has been received and is now being processed. Your order details are shown below for your reference:</p>    
       <?php  }
       unset($_SESSION['cartSessionId']);
       unset($_SESSION['orderids']);
       unset($_SESSION['razorpay_order_id']);
}
else
{
	// redirect 
	$redirecturl="location:".SITE_URL."order-histroy/";
	header($redirecturl);
} ?>

