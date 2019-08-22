
<?php
// Turn off all error reporting
error_reporting(0);
require('config.php');
require('razorpay-php/Razorpay.php');
//session_start();
use Razorpay\Api\Api;
$api = new Api($keyId, $keySecret);

include_once $_SERVER['DOCUMENT_ROOT'].'/includes/config.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/includes/db.php';
error_reporting(0);
include_once $_SERVER['DOCUMENT_ROOT'].'/includes/functions.php';
?>
<?php
$catTypesValue ='1';
$seo1="";
$seo2="";
if(isset($seo1)){
$meta_details=get_meta_details($seo1,$seo2);
	
}else{
$meta_details="";	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta name="keywords" content="<?php echo $meta_details['meta_keyword'];?>" />
	<meta name="description" content="<?php echo $meta_details['meta_description'];?>" />
	<title><?php echo $meta_details['meta_title'];?></title>

	<!-- Google Fonts -->
    <link href='<?php echo SITE_URL; ?>assets/css/googleapiscss_Titillium.css' rel='stylesheet' type='text/css'>
    <link href='<?php echo SITE_URL; ?>assets/css/googleapiscss_Roboto_Condensed.css' rel='stylesheet' type='text/css'>
    <link href='<?php echo SITE_URL; ?>assets/css/googleapiscss_Releway.css' rel='stylesheet' type='text/css'>

    <!-- Bootstrap -->
	<link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/css/font-awesome.min.css">
	<!-- Custom CSS -->
	<link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/second-home/home-2-main-slider.css">
	<link rel="stylesheet" href="<?php  echo  SITE_URL; ?>assets/css/style.css">
	<link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/css/responsive.css">
	<link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/css/header-mega-menu.css">
	<link rel="shortcut icon" href="<?php echo SITE_URL; ?>assets/img/favicon.ico">
	<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
	<!-- mainslider CSS -->
	<link href="<?php echo SITE_URL; ?>assets/css/responsive-carousel.css" media="screen, projection" rel="stylesheet" type="text/css" />
      <style>
      	.mixedSlider {
  position: relative;
}
.mixedSlider .MS-content {
  white-space: nowrap;
  overflow: hidden;
  margin: 0 0%;
}
.mixedSlider .MS-content .item {
  display: inline-block;
  width: 25.3333%;
  position: relative;
  vertical-align: top;
  overflow: hidden;
  height: 100%;
  white-space: normal;
  padding: 0 10px;
}
@media (max-width: 991px) {
  .mixedSlider .MS-content .item {
    width: 50%;
  }
}
@media (max-width: 767px) {
  .mixedSlider .MS-content .item {
    width: 100%;
  }
}
.mixedSlider .MS-content .item .imgTitle {
  position: relative;
}
.mixedSlider .MS-content .item .imgTitle .blogTitle {
  margin: 0;
  text-align: left;
  letter-spacing: 2px;
  color: #252525;
  font-style: italic;
  position: absolute;
  background-color: rgba(255, 255, 255, 0.5);
  width: 100%;
  bottom: 0;
  font-weight: bold;
  padding: 0 0 2px 10px;
}
.mixedSlider .MS-content .item .imgTitle img {
  height: 300px;
  width: 100%;
}
.mixedSlider .MS-content .item p {
  font-size: 16px;
  margin: 2px 10px 0 5px;
  text-indent: 15px;
}
.mixedSlider .MS-content .item a {
  color:#000;
}
.mixedSlider .MS-content .item a:hover {
  color:#FF6632;
  text-decoration: none;
}
.mixedSlider .MS-controls button {
  position: absolute;
  border: none;
  background-color: transparent;
  outline: 0;
  font-size: 50px;
  top: 200px;
  color: rgba(0, 0, 0, 0.4);
  transition: 0.15s linear;
}

.producttitle {
	width: 100% !important;
	font-size: 15px !important;
	text-align: center;
	font-weight: bold;
	margin: 10px 0px;
}
.org-price {
	width: 100%;
	float: left;
	font-size: 15px;
	margin-top: 20px;
}
.org-price span {
	float: left;
}
.priceleft {
	width: 50%;
	margin-left: 15px;
}
.symbolofmony {
	font-size: 20px;
font-weight: bold;
margin-top: -8px;
color: #FF6632;
}
.org-price span {
	float: left;
}
.amts {
	font-size: 20px;
	margin-top: -6px;
	color: #FF6632;
	margin-left: 10px;
}
.priceright {
	float: right !important;
	width: 35%;
	border: 1px solid #ccc;
	text-align: center;
	padding: 3px;
	margin-top: -10px;
	margin-right: 5px;
}
.mixedSlider .MS-controls button:hover {
  color: rgba(0, 0, 0, 0.8);
}
@media (max-width: 992px) {
  .mixedSlider .MS-controls button {
    font-size: 30px;
  }
}
@media (max-width: 767px) {
  .mixedSlider .MS-controls button {
    font-size: 20px;
  }
}
.mixedSlider .MS-controls .MS-left {
  left: 0px;
}
@media (max-width: 767px) {
  .mixedSlider .MS-controls .MS-left {
    left: -10px;
  }
}
.mixedSlider .MS-controls .MS-right {
  right: 0px;
}
@media (max-width: 767px) {
  .mixedSlider .MS-controls .MS-right {
    right: -10px;
  }
}
#basicSlider { position: relative; }

#basicSlider .MS-content {
  white-space: nowrap;
  overflow: hidden;
  margin: 0 2%;
  height: 50px;
}

#basicSlider .MS-content .item {
  display: inline-block;
  width: 20%;
  position: relative;
  vertical-align: top;
  overflow: hidden;
  height: 100%;
  white-space: normal;
  line-height: 50px;
  vertical-align: middle;
}
@media (max-width: 991px) {

#basicSlider .MS-content .item { width: 25%; }
}
@media (max-width: 767px) {

#basicSlider .MS-content .item { width: 35%; }
}
@media (max-width: 500px) {

#basicSlider .MS-content .item { width: 50%; }
}

#basicSlider .MS-content .item a {
  line-height: 50px;
  vertical-align: middle;
}

#basicSlider .MS-controls button { position: absolute; }

#basicSlider .MS-controls .MS-left {
  top: 35px;
  left: 10px;
}

#basicSlider .MS-controls .MS-right {
  top: 35px;
  right: 10px;
}
#banner-section {margin-top: 180px;}
      </style>
<!-- Add the slick-theme.css if you want default styling -->
	<!-- for carousel  -->
<!--	<link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/css/owl.carousel.css">
	<link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/css/home-Carousel-slider.css">
-->	<!--  for carousel ends here -->

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<style type="text/css">

	.mega-menu
	{
		display: none;
	}
	#firstcats1:hover .mega-menu{
		display : block;
	}
	
	
	
	nav {
	background-color: #fff;
	/* border: 1px solid #dedede; */
	/* border-radius: 4px; */
	/* box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.055); */
	color: #888;
	display: block;
	margin: 0px 1px 8px 0px;
	overflow: hidden;
	width: 745px;
	float: right;
    }

  nav ul {
    margin: 0;
    padding: 0;
  }

    nav ul li {
      display: inline-block;
      list-style-type: none;
      
      -webkit-transition: all 0.2s;
        -moz-transition: all 0.2s;
        -ms-transition: all 0.2s;
        -o-transition: all 0.2s;
        transition: all 0.2s; 
    }
      
      nav > ul > li > a > .caret {
        border-top: 4px solid #aaa;
        border-right: 4px solid transparent;
        border-left: 4px solid transparent;
        content: "";
        display: inline-block;
        height: 0;
        width: 0;
        vertical-align: middle;
  
        -webkit-transition: color 0.1s linear;
          -moz-transition: color 0.1s linear;
        -o-transition: color 0.1s linear;
          transition: color 0.1s linear; 
      }

      nav > ul > li > a {
        color: #aaa;
        display: block;
        line-height: 10px;
        padding: 0 18px;
        text-decoration: none;
      }

        nav > ul > li:hover {
/*          background-color: rgb( 40, 44, 47 );
*/        }

        nav > ul > li:hover > a {
          color: #00ab95;
        }

        nav > ul > li:hover > a > .caret {
          border-top-color: #00ab95;
        }
      
      nav > ul > li > div {
        background-color: rgb( 40, 44, 47 );
        border-top: 0;
        border-radius: 0 0 4px 4px;
        box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.055);
        display: none;
        margin: 0;
        opacity: 0;
        position: absolute;
        width: 165px;
        visibility: hidden;
  
        -webkit-transiton: opacity 0.2s;
        -moz-transition: opacity 0.2s;
        -ms-transition: opacity 0.2s;
        -o-transition: opacity 0.2s;
        -transition: opacity 0.2s;
      }

        nav > ul > li:hover > div {
          display: block;
          opacity: 1;
          visibility: visible;
        }

          nav > ul > li > div ul > li {
            display: block;
          }

            nav > ul > li > div ul > li > a {
              color: #fff;
              display: block;
              padding: 12px 24px;
              text-decoration: none;
            }

              nav > ul > li > div ul > li:hover > a {
/*                background-color: rgba( 255, 255, 255, 0.1);
*/              }
#firstcats1 {
	width: 100%;
	border: 0px solid #ccc;
	border-radius: 5px;
	margin-top: 0px;
	margin-left: 50px;
	text-transform: uppercase;
}
</style>
<!--  google analytics script -->
<body>
<div class="container-fullwidth HeaderTopBackground">
	<div class="mobile-info" onclick="show_mobileinfo()">
		<img src="<?php echo SITE_URL; ?>assets/img/ham.png" alt="ham" >
	</div>
	<div class="container">

		<div class="row header-info">
			<div class="col-md-6 col-sm-1 col-xs-12">
				<span class=""></span>
			</div>
			<!--<div class="col-md-3 col-sm-4 col-xs-12">
				<span class=""><i class="fa fa-envelope-o"></i> testing@gmail.com</span>
			</div>-->
			<!--<div class="col-md-2 col-sm-2 col-xs-12">
				<span class=""><i class="fa fa-gift"></i> Gift Products</span>
			</div>-->
			<div class="col-md-2 col-sm-2 col-xs-12">
				<a href="<?php echo SITE_URL; ?>order-histroy" role="button"><span class=""><i class="fa fa-gift"></i> Order histroy</span></a>
			</div>
			<div class="col-md-2 col-sm-2 col-xs-12">
				<span class="">Call Us: 080 25457173</span>
			</div>
			<div class="col-md-2 col-sm-3 col-xs-12">
				<?php
				$login_status = loginStatus();
				if($login_status=="EmptySession"){
					?>
					<!--<a href="#" style="color:#fff;" role="button" data-toggle="modal" data-target="#login-modal"><span class=" "><i class="fa fa-lock"></i> Login or Register</span></a> -->
					<a href="<?php echo SITE_URL; ?>login" role="button"><span class=" "><i class="fa fa-lock"></i> Login or Register</span></a>
				<?php } else { ?>
					<a href="<?php echo SITE_URL; ?>logout"><span class=" "><i class="fa fa-lock"></i> Logout</span></a>
				<?php } ?>
			</div>
			
			<!--<div class="col-md-2 col-sm-2 col-xs-12">
				<span class=" "><i class="fa fa-shopping-cart"></i></span>
			</div>-->
			<!--<div class="col-md-2 col-sm-2 col-xs-12 blog_link">
				<span class=" "><a href="<?php echo SITE_URL; ?>blog/">HOT BLOG</a></span>
			</div>-->
		</div>
	</div>
</div>
<div class="site-branding-area-new">

<!--	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<div class="logo">
					<h1><a href="<?php echo SITE_URL; ?>brand-new"><img src="<?php echo SITE_URL; ?>assets/img/HOT-MALL-LOGO.png" width="112" alt="HOT-MALL-LOGO"></a></h1>
				</div>
			</div>

			<div class="col-sm-6">

			</div>
		</div>
	</div>-->
	<div class="container">
	<div class="row">
	<div class="col-sm-3">
	<div class="logo">
					<h1><a href="<?php echo SITE_URL; ?>"><img src="<?php echo SITE_URL; ?>assets/img/logo-new.png"  alt=""></a></h1>
				</div>
				</div>
				
			<div class="col-sm-9">
		<form action="<?php echo SITE_URL; ?>search/" method="get">
			<div class="row" id="menushovers">
				<ul class="navNew" role="menubar">

					<i class="fa fa-search" id="headerfasarch"></i><input type="search" placeholder="Search products..." id="headersearch" name="headersearch" onkeyup="searchFilterFunctionsHome();">        <ul id="filterSearchList"></ul>
					<div class="header_categories">
						<select id="catList" name="catList" onchange="searchFilterFunctionsHome();">
							<option value="">Categories</option>
							<?php
							$categoryList = categoryParent();
							foreach($categoryList as $key => $value){
								$category_id = $value['category_id'];
								$subCategoryList = subcategory($category_id);
								foreach($subCategoryList as $key => $subvalue){
									?>
									<!--<ul class="middleUllist">
				<li role="menuitem" class="subCategorys"><a href="/<?php echo $subvalue['category_id'] ?>"><?php echo $subvalue['name'] ?></a></li>
			</ul>-->
									<option value="<?php echo $subvalue['category_id'] ?>"><?php echo $subvalue['name'] ?></option>
								<?php }   }  ?>
						</select>
						<a href="javascript:void(0);" id="mobile_search"><img  src="<?php echo SITE_URL; ?>assets/img/serch-icon.png" alt="cart" /></a>
					</div>

					<?PHP /* <li role="menuitem" id="firstcats1">
						<a href="javascript:void(0);" class="desktop">Shop &#x25BC;</a>
						<div class="mega-menu" >
						<div id="noti-box">
							<?php
							$categoryList = categoryParent();
							foreach($categoryList as $key => $value){
								?>
								<div class="nav-column" id="nav-column-<?php echo $category_id = $value['category_id']; ?>">
<!--									<a href="<?php echo SITE_URL; ?><?php echo $value['cat_alias'] ?>"><h3><?php  echo $value['name']; ?></h3></a>
-->									<?php
									$category_id = $value['category_id'];
									$subCategoryList = subcategory($category_id);
									foreach($subCategoryList as $key => $subvalue){
										?>
										<ul class="middleUllist">
											<li role="menuitem" class="subCategorys"><a href="<?php echo SITE_URL; ?><?php echo $subvalue['cat_alias'] ?>"><?php echo $subvalue['name'] ?></a></li>
										</ul>
									<?php }  ?>
								</div>
							<?php }  ?>
							</div>
						</div>
					</li> */ ?>

				</ul>
				<div role="menuitem" id="firstcats2">
					<a href="javascript:void(0);" class="mobile" onclick="openNav()"><img  src="<?php echo SITE_URL; ?>assets/img/ham.png" alt="ham"/></a>
				</div>
				<?php
				//$login_status = loginStatus();
				//if($login_status=="EmptySession"){
					?>
					
					<?php /*<a href="" id="hotblog-3" class="" role="button" data-toggle="modal" data-target="#login-modal"> <a href="<?php echo SITE_URL; ?>login/" id="hotblog-3" class="" role="button">

						<img  src="<?php echo SITE_URL; ?>assets/img/add.png" alt="add" />
						Login
					</a>
				<?php } else{ ?>
					<a href="<?php echo SITE_URL; ?>logout/" id="hotblog-3" class="" >
						<img  src="<?php echo SITE_URL; ?>assets/img/logout.png" alt="logout"/>
						Logout
					</a>  */?>
				<?php //} ?>
				<div  id="hotblog-2">
					<a href="<?php echo SITE_URL; ?>cart" class="white_box" >
						<?php
						if(isset($_SESSION['cartSessionId'])){
						$cartSessionId = $_SESSION['cartSessionId'];
						$valuescartCounts =  productCartIdentificationAllPages($cartSessionId);
						}else{
							$valuescartCounts="";
						}
						?>
						<?php if($valuescartCounts!=""){?>
							<span class="cartcoutview"><?php echo $valuescartCounts; ?></span>
						<?php }else{ ?>
							<span class="cartcoutview" style="display: none">0</span>
						<?php } ?>

						<img  src="<?php echo SITE_URL; ?>assets/img/cart-icon.png" alt="cart" />
					</a>
					<span class="Cart-text">Cart</span>
				</div>
				
				<!--<a href="<?php echo SITE_URL; ?>blog/" id="hotblog">HOT BLOG</a>-->
				<a href="javascript:void(0);" id="hotblog1"><img  src="<?php echo SITE_URL; ?>assets/img/serch-icon.png" alt="cart" /></a>


			</div>
		</form>
		</div>
		</div>
	
	</div>

    <div class="row hidingheader" style="border-top: 1px solid #ccc;padding-top: 18px;">
    	<div class="container">

	<div class="col-sm-12">
	<nav id="firstcats1">
    <ul>
    	<li><a href="<?php echo SITE_URL; ?>grocery">Grocery</a></li>
        <li><a href="<?php echo SITE_URL; ?>organic-products">Organic</a></li>
        <li><a href="<?php echo SITE_URL; ?>sweets-snacks">sweet and snacks</a></li>
        <li><a href="<?php echo SITE_URL; ?>wood-pressed-oil">Wood Pressed oil</a></li>
        <li><a href="<?php echo SITE_URL; ?>imported-products">Imported & Gourmet</a></li>
        <li><a href="<?php echo SITE_URL; ?>Gifts/">Gifts</a></li>
        <li><a href="<?php echo SITE_URL; ?>Gifts/">Home Appliances</a></li>
    </ul>
	</nav>
    </div>
    </div>
    </div>
	<!--  mobile menu contents starts here -->
	<div id="mySidenav" class="sidenav">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		<ul class="mobile-menu" >
			<?php
			$categoryList = categoryParent();
			foreach($categoryList as $key => $value){
				?>
				<li>
				<span><?php  echo $value['name']; ?></span>

				<?php
				$category_id = $value['category_id'];
				$subCategoryList = subcategory($category_id);
				if(count($subCategoryList)>=1):
					echo '<ul class="sub-menu">';
				endif;
				foreach($subCategoryList as $key => $subvalue){
					?>
					<li role="menuitem" ><a href="<?php echo SITE_URL; ?><?php echo $subvalue['cat_alias'] ?>"><?php echo $subvalue['name'] ?></a></li>

				<?php }
				if(count($subCategoryList)>=1):
					echo '</ul>';
				endif;
				?>
				</li>
				<?php
			} /* ending main category foreach */
			?>
		</ul>
	</div>
	<!-- mobile menu contents ends here  -->
</div> <!-- End site branding area -->
<style>
	#rzp-button1{
	margin-top: 50px;
    display: block;
    margin: 300px auto !important;
    background-color: #00ab95;
    padding: 12px;
    color: #fff;
	}
</style>


<!-- End mainmenu area -->
<?php

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

$usersql = "Select user_name,name,email,phone_number,mobile,shipping_address from hm_users where id='".$userid."' ";
$userresult = mysqli_query($conn,$usersql);
$userdata = mysqli_fetch_assoc($userresult);

$orderData = [
    'receipt'         => 3456,
    'amount'          => $grand_total * 100, // 2000 rupees in paise
    'currency'        => 'INR',
    'payment_capture' => 1 // auto capture
];
$razorpayOrder = $api->order->create($orderData);
$razorpayOrderId = $razorpayOrder['id'];
$_SESSION['razorpay_order_id'] = $razorpayOrderId;
$displayAmount = $amount = $orderData['amount'];
if ($displayCurrency !== 'INR'){
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);
    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}
$checkout = 'manual';
if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true)){
    $checkout = $_GET['checkout'];
}
$data = [
    "key"               => $keyId,
    "amount"            => $amount,
    "name"              => "spsbrands.com",
    "description"       => "spsbrands.com",
    "image"             => "https://www.spsbrands.com/assets/img/logo-new.png",
    "prefill"           => [
    "name"              => $userdata['name'],
    "email"             => $userdata['email'],
    "contact"           => $userdata['mobile'],
    ],
    "notes"             => [
    "address"           => $userdata['shipping_address'],
    "merchant_order_id" => $orderids,
    ],
    "theme"             => [
    "color"             => "#F37254"
    ],
    "order_id"          => $razorpayOrderId,    
];
if ($displayCurrency !== 'INR'){
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}
$json = json_encode($data);
require("checkout/{$checkout}.php");

?>
<div class="clearfix"></div>
<div class="footer-bottom-area">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <h1 class="titleOffootermain">spsbrands</h1>
                <ul class="FooterUlLi">
                    <li><a href="/about-us">About Us</a></li>
                    <li><a href="/privacy-policy">Privacy Policy</a></li>
                    <li><a href="/terms-conditions">Terms and Conditions</a></li>
                    <li><a href="/cancellation-policy">Refund/Cancellation Policy</a></li>
                    <li><a href="/contact-us">Contact Us</a></li>
                </ul>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <h1 class="titleOffootermain">Categories</h1>
                <ul class="FooterUlLi">
                    <li><a href="<?php echo SITE_URL; ?>grocery">Grocery</a></li>
                    <li><a href="<?php echo SITE_URL; ?>organic-products">Organic & Ayurvedic</a></li>
                    <li><a href="<?php echo SITE_URL; ?>sweets-snacks">Sweet & Snacks</a></li>
                    <li><a href="<?php echo SITE_URL; ?>wood-pressed-oil">Wood Pressed oil</a></li>
                    <li><a href="<?php echo SITE_URL; ?>Gifts/">Gifts</a></li>
                    <li><a href="<?php echo SITE_URL; ?>dry/">Dry Fruits</a></li>
                    <li><a>Home Appliances</a></li>
                </ul>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <h1 class="titleOffootermain">follow us </h1>
                <a href="https://www.facebook.com/spsbrands.com" target="_blank"><img src="<?php echo SITE_URL; ?>assets/img/fb.png" alt="view"/></a>
                <a href="https://plus.google.com/u/1/111465334928906845295" target="_blank"><img src="<?php echo SITE_URL; ?>assets/img/g+.png" alt="view"/></a>
                <a href="https://twitter.com/spsbrandsin" target="_blank"><img src="<?php echo SITE_URL; ?>assets/img/tw.png" alt="view"/></a>
                <a href="https://www.linkedin.com/in/spsbrands/" target="_blank"><img src="<?php echo SITE_URL; ?>assets/img/in.png" alt="view"/></a>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="footer-newsletter">
                    <h1 class="titleOffootermain">sign up newsletter</h1>
                    <h6 class="sign_reg">register your email to get exclusive offers!</h6>
                    <div class="newsletter-form">
                        <form action="#">
                            <div class="col-md-10">
                                <input type="email" placeholder="ENTER EMAIL ID" id="subemais" name="subemais">
                                <span id="Submsg"></span>
                            </div>
                            <div class="col-md-2 subsrib_sec">
                                <input type="button"  value="Subscribe" onclick="subscribe();">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
       </div>
    </div>
</div> <!-- End footer bottom area -->
<div id="footerpayments">
    <div class="container">
        <div class="row">
            <div class="col-md-2"><p>Payment Options:</p></div>
            <div class="col-md-1"><p>Cash on Delivery</p></div>
            <div class="col-md-3"><img src="<?php echo SITE_URL;?>assets/img/footer_payment.png" alt="VISA/MATER CARD" /></div>
        </div>    
    </div>
</div>
<div id="footerdelivery">
    <div class="container">
        <div class="row">
            <div class="col-md-12"><p>Online Grocery shopping in India:</p></div>
        </div>    
        <div class="row">
            <div class="col-md-12"><span>Order Online. All your favourite products from the low price online supermarket for grocery home delivery
                    in Delhi,Gurgaon,Bengalure,Chennai,Mumbai and other cities in India.</span></div>
        </div>
        <div class="row">
            <div class="col-md-12"><p>Cities we deliver</p></div>
        </div>    
        <div class="row">
            <div class="col-md-12">
                <span>
                    Bangalore,Hydrabad,Mumbai,Pune,Chennai,Madurai,Delhi,Mysore,Coimbatore,Vijayawada-Guntur,Kolkata,Ahmedabad-Gandhinagar,Lucknow-Kanpur
                    Gurgaon,Vadodara,Vishakhapatnam,Surat,Nagpur,Patna,Indore,Chandigarh Tricity,Jaipur,Noida.
                </span>
            </div>
        </div>
    </div>
</div>
<div class="footer-copyright-area">
    <div class="container">
        <div class="copyright_top"></div>
       <div class="row">
           <div class="col-lg-12">
               <div class="copyright">
                   Copyrights &copy <?php echo date("Y"); ?> spsbrands.com All rights reserved
               </div>
           </div>
       </div>
    </div>
</div>
    <!-- Latest jQuery form server -->
     <?php //loginAndRegisterDesign(); ?>
	 <script  type="text/javascript" src="<?php echo SITE_URL; ?>assets/js/jquery.min.js"></script>
	 <!-- Bootstrap JS form CDN -->
    <script type="text/javascript" src="<?php echo SITE_URL;?>assets/js/bootstrap.min.js" defer></script>
	<script src="<?php echo SITE_URL;?>assets/js/jquery.validate.js"></script>
	<script src="<?php echo SITE_URL;?>assets/js/jquery.sticky.js"></script>
	<script src="<?php echo SITE_URL;?>assets/js/main.js"></script>
	<link rel="stylesheet" href="<?php echo SITE_URL;?>assets/css/etalage.css" />
	<script src="<?php echo SITE_URL;?>assets/js/jquery.etalage.min.js"></script>
	<script src="<?php echo SITE_URL;?>assets/js/multislider.js"></script> 
 	<script src="<?php echo SITE_URL;?>assets/js/responsive-carousel.js"></script>
<link rel="stylesheet" href="<?php echo SITE_URL;?>assets/css/etalage.css" />
<script src="<?php echo SITE_URL;?>assets/js/jquery.etalage.min.js"></script>
<script>
function signlepriceslider(){
	jQuery('#etalage_1').etalage({
		thumb_image_width: 300,
		thumb_image_height: 400,
		source_image_width: 900,
		source_image_height: 1200,
		show_hint: true,
		click_callback: function(image_anchor, instance_id){
			alert('Callback example:\nYou clicked on an image with the anchor: "'+image_anchor+'"\n(in Etalage instance: "'+instance_id+'")');
		}
	});
}
signlepriceslider();
</script>

	 <script type="text/javascript">
    	/*$('.mixedSlider').multislider({
			duration: 750,
			interval: false
			
		});*/
		$('#mixedSlider').multislider({
			duration: 750,
			interval: false
		});
		$('#mixedSlider1').multislider({
			duration: 750,
			interval: false
		});
		$('#mixedSlider2').multislider({
			duration: 750,
			interval: false
		});
		$('#mixedSlider3').multislider({
			duration: 750,
			interval: false
		});
		$('#mixedSlider4').multislider({
			duration: 750,
			interval: false
		});
		$('#mixedSlider5').multislider({
			duration: 750,
			interval: false
		});
		$('#mixedSlider6').multislider({
			duration: 750,
			interval: false
		});
		$('#mixedSlider7').multislider({
			duration: 750,
			interval: false
		});
		function addToCart(productId){
			
			var priceid = $("#multiselect_"+productId).val();
			var product_qty = $("#product_qty"+productId).val();
			
	$.ajax({
			type: "POST",
			url:'common_ajax.php',
			data:'ajax=1&ajax_task=addTocart&productId='+productId+'&qut='+product_qty+'&priceid='+priceid,
			success:function(data){
				if(data !="0"){
					/*document.getElementById('SavaCartval_'+productId).style.display="block";	
					setTimeout(function(){
					document.getElementById('SavaCartval_'+productId).style.display="none";
					}, 3000);*/
					$('.cartcoutview').show();
					 
					$('.cartcoutview').html( parseInt(data));
					//$('#dgg1').html('10');
					cartheaderList();
				}
			}
		})
}


function cartheaderList(){
	var url = $("#ajaxSiteUrl").val();
	$.ajax({
	type: "POST",
	url:'common_ajax.php',
	data:'ajax=1&ajax_task=headerCartDesign',
	success:function(data){
		if(data=="0"){
			$('#filterSearchList').hide();
			return false;
		}
		if(data ==""){
		$('.aa-cartbox-summary').html('');
		//$('.aa-cartbox-summary').hide();
		}else if(data !=""){
			//$('.aa-cartbox-summary').show();
			$('.aa-cartbox-summary').html(data);
		}
	}
	})
}
cartheaderList();


$(".product_qty_desi").keyup(function () {
		var qty = $(this).val();
		if (qty >= 1) {
		// nothing
		} else {
		qty = 1
		}
		qty = parseInt(qty);
		$(this).val(qty);
		});
		$(".product_qty_desi").blur(function () {
		var qty = $(this).val();
		if (qty >= 1) {
		// nothing
		} else {
		qty = 1
		}
		qty = parseInt(qty);
		$(this).val(qty);
		});
		$(".clean_qty").keyup(function () {
		var qty = $(this).val();
		if (qty >= 1) {
		// nothing
		} else {
		qty = 1
		}
		qty = parseInt(qty);
		$(this).val(qty);
		});
		$(".clean_qty").blur(function () {
		var qty = $(this).val();
		if (qty >= 1) {
		// nothing
		} else {
		qty = 1
		}
		qty = parseInt(qty);
		$(this).val(qty);
		});
		
		
		function  updateCartAjax(tsk,product_price_code){
	var qty  = $("#product_qty"+product_price_code).val().trim();
	
 	if(tsk=='plus'){
 		
		var product_qty = parseInt(qty) + parseInt(1);
		
	}
	else{
		var product_qty = parseInt(qty) - parseInt(1);
	}
	if(product_qty<=0){
		product_qty = 1;
	}
	
	$("#product_qty"+product_price_code).val(product_qty);
	
	}
	
  </script>
  <script>

	// Custom options for the carousel
	var args = {
		arrowRight : '.arrow-right',
		arrowLeft : '.arrow-left',
		speed : 700,
		slideDuration : 4000
	};
	// start BannerSlide
	$('.carousel').BannerSlide(args);

	</script>
    </body>
</html>