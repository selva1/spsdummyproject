<div class="col-md-12">
<?php 
$orderid=$_GET['oderId'];
$metod = $_GET['metod'];
 if($orderid!=''){ ?>
     <?php if($metod=="BankDeposit"){ ?>
	<h1 class="succ_head" style="margin-top: 50px;"> your order is sucessfully placed!  	Thank you for choosing www.spsbrands.com</h1>
		<h3 class="red_text"> Order # : <?php echo $orderid; ?></h3>
	<h1 class="succ_head">But Paymenst has been failed please try making payment again, so we can process your request.</h1>
	<?php }	else if($metod=="COD"){ ?>
		<h1 class="succ_head"> your order is sucessfully placed!  	Thank you for choosing spsbrands</h1>
		<h3 class="red_text"> Order # : <?php echo $orderid; ?></h3>
	  	<p>Your order has been received and is now being processed. </p>

<!--		<p>Pay with cash upon delivery or via Mpesa PayBill No:222196</p>
-->		<?php
	}else if($metod=="razorpay"){ ?>
        <h1 class="succ_head" style="margin-top: 50px;">your order is sucessfully placed! Thank you for choosing www.spsbrands.com</h1>
        <h1 class="succ_head">But Paymenst has been failed please try making payment again, so we can process your request.</h1>
        <h3 class="red_text"> Order # : <?php echo $orderid; ?></h3>	  	
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
</div>

