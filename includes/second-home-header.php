<?php
$catTypesValue ='1';
$meta_details=get_meta_details($seo1,$seo2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<title><?php echo $meta_details['meta_title'];?></title>
   <meta name="description" content="<?php echo $meta_details['meta_description'];?>" />

	<meta name="keywords" content="<?php echo $meta_details['meta_keyword'];?>" />
<?php
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
	<link rel="canonical" href="<?php echo $actual_link; ?>" />
	<meta name="copyright" content=""/>
	<meta name="Robots" content="index,follow"/>
	<meta name="GOOGLEBOT" content="index,follow"/>
	<meta name="author" content="spsbrands.com"/>
	<meta name="revisit-after" content="7 days"/> 
	<meta name="search engines" content="ALL"/> 
	<meta name="expires" content="Never"/>
	<meta name="Display" content="World-wide"/>
	<meta name="distribution" content="global" />
	<meta http-equiv="Content-Language" content="en-US"/>
	<meta name="allow-search" content="Yes"/>
	<!--facebook-->
	<meta name="og_url" property="og:url" content="<?php echo $actual_link; ?>"/>
	<meta name="og:title" property="og:title" content="<?php echo $meta_details['meta_title'];?>">
  <meta name="description" property="og:description" content="<?php echo $meta_details['meta_description'];?>" />
	<!-- Favicon Icon -->
	<link rel="icon" type="image/png" href="<?php echo SITE_URL;?>img/favicon.png">
	<!-- Bootstrap core CSS -->
	<link href="<?php echo SITE_URL;?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- Material Design Icons -->
	<link href="<?php echo SITE_URL;?>vendor/icons/css/materialdesignicons.min.css" media="all" rel="stylesheet" type="text/css" />
	<!-- Select2 CSS -->
	<link href="<?php echo SITE_URL;?>vendor/select2/css/select2-bootstrap.css" />
	<link href="<?php echo SITE_URL;?>vendor/select2/css/select2.min.css" rel="stylesheet" />
	<!-- Custom styles for this template -->
	<link href="<?php echo SITE_URL;?>css/osahan.min.css" rel="stylesheet">
   <link href="<?php echo SITE_URL;?>css/demo.css" rel="stylesheet">
   <link href="<?php echo SITE_URL;?>css/mega_menu.min.css" rel="stylesheet">

	<!-- Owl Carousel -->
	<link rel="stylesheet" href="<?php echo SITE_URL;?>vendor/owl-carousel/owl.carousel.css">
	<link rel="stylesheet" href="<?php echo SITE_URL;?>vendor/owl-carousel/owl.theme.css">
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-117119317-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-117119317-1');
</script>
</head>
<body>
<div class="modal fade login-modal-main" id="bd-example-modal">
         <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-body">
                  <div class="login-modal">
                     <div class="row">
                        <div class="col-lg-6 pad-right-0">
                           <div class="login-modal-left">
                           </div>
                        </div>
                        <div class="col-lg-6 pad-left-0">
                           <button type="button" class="close close-top-right" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true"><i class="mdi mdi-close"></i></span>
                           <span class="sr-only">Close</span>
                           </button>
                           <form>
                              <div class="login-modal-right" id="login-form">
                                 <!-- Tab panes -->
                                 
                                 <div class="tab-content">

                                    <div class="tab-pane active" id="login" role="tabpanel">
                                       <h5 class="heading-design-h5">Login to your account</h5>
                                       <div id="div-login-msg"  style="color:red;">
                                          <span id="text-login-msg"></span>
                                       </div>
                                       <input type="hidden"  value="" class="form-control" name="hdn_isReview" id="hdn_isReview">
                                       <input type="hidden"  value="" class="form-control" name="hdn_product_id" id="hdn_product_id">
                                       <fieldset class="form-group">
                                          <label>Enter Email</label>
                                          <input type="text" id="login_username" class="form-control" placeholder="sample@gmail.com">
                                       </fieldset>
                                       <fieldset class="form-group">
                                          <label>Enter Password</label>
                                          <input type="password" id="login_password" class="form-control" placeholder="********">
                                       </fieldset>
                                       <fieldset class="form-group">
                                          <button type="button" name="Logins" id="Logins" class="btn btn-lg btn-secondary btn-block">Enter to your account</button>
                                       </fieldset>
                                       <!-- <div class="login-with-sites text-center">
                                          <p>or Login with your social profile:</p>
                                          <button class="btn-facebook login-icons btn-lg"><i class="mdi mdi-facebook"></i> Facebook</button>
                                          <button class="btn-google login-icons btn-lg"><i class="mdi mdi-google"></i> Google</button>
                                          <button class="btn-twitter login-icons btn-lg"><i class="mdi mdi-twitter"></i> Twitter</button>
                                       </div> -->
                                       <!-- <div class="custom-control custom-checkbox">
                                          <input type="checkbox" class="custom-control-input" id="customCheck1">
                                          <label class="custom-control-label" for="customCheck1">Remember me</label>
                                       </div> -->
                                    </div>
                                    
                                    <div class="tab-pane" id="register" role="tabpanel">
                                    <div id="register-form">
                                    
                                       <h5 class="heading-design-h5">Register Now!</h5>
                                       <fieldset class="form-group">
                                          <label>Enter Email</label>
                                          <input type="text"  onblur="r_checkseekeremail();" name="r_email" id="r_email" class="form-control" placeholder="sample@gmail.com">
                                          <span style="font-color:#E10707;float:left; " class="error" id="r_err_mail"></span>
                                       </fieldset>
                                       <fieldset class="form-group">
                                          <label>Mobile number</label>
                                          <input type="text" name="r_ph_no" id="r_ph_no" class="form-control" placeholder="+911234567890">
                                          <span style="font-color:#E10707;  margin-top:20px; float:left; " class="error" id="r_err_ph_no"></span>
                                       </fieldset>
                                       <fieldset class="form-group">
                                          <label>Enter Password</label>
                                          <input type="password" name="r_password" id="r_password" class="form-control" placeholder="********">
                                          <span style="font-color:#E10707; font-size:10px; margin-top:20px; float:left; " class="error" id="r_err_password"></span>
                                       </fieldset>
                                       <fieldset class="form-group">
                                          <label>Enter Confirm Password </label>
                                          <input type="password" name="r_con_password" id="r_con_password" class="form-control" placeholder="********">
                                          <span style="font-color:#E10707; margin-top:20px; float:left; " class="error" id="r_err_Confirm"></span>
                                       </fieldset>
                                        <div class="custom-control custom-checkbox" style="display:none;">
                                          <input type="checkbox" class="custom-control-input" name="checkterms" id="checkterms" checked="checked">
                                          <label class="custom-control-label" for="customCheck2">I Agree with <a href="#">Term and Conditions</a></label>
                                          <span style="font-color:#E10707; margin-top:0px; float:left; " class="error" id="r_err_terms"></span>
                                       </div>
                                       <fieldset class="form-group">
                                          <button type="button" onclick="pageregister();" class="btn btn-lg btn-secondary btn-block">Create Your Account</button>
                                       </fieldset>
                                      </div>
                                    </div>
                                    
                                 </div>
                                 <div class="clearfix"></div>
                                 <div class="text-center login-footer-tab">
                                    <ul class="nav nav-tabs" role="tablist">
                                       <li class="nav-item">
                                          <a class="nav-link active" data-toggle="tab" href="#login" role="tab"><i class="mdi mdi-lock"></i> LOGIN</a>
                                       </li>
                                       <li class="nav-item">
                                          <a class="nav-link" data-toggle="tab" href="#register" role="tab"><i class="mdi mdi-pencil"></i> REGISTER</a>
                                       </li>
                                    </ul>
                                 </div>
                                 <div class="clearfix"></div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="navbar-top bg-success pt-2 pb-2">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-12 text-center">
                  <a href="shop.html" class="mb-0 text-white">
                  2% cashback for new users | Code: <strong><span class="text-light">OGOFERS13 <span class="mdi mdi-tag-faces"></span></span> </strong>  
                  </a>
               </div>
            </div>
         </div>
      </div>
      <nav class="navbar navbar-light navbar-expand-lg bg-dark bg-faded osahan-menu">
         <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo SITE_URL;?>"> <img src="<?php echo SITE_URL;?>img/logo-new.png.jpeg" alt="logo"> </a>
			<!-- <a class="location-top" href="#"><i class="mdi mdi-map-marker-circle" aria-hidden="true"></i> New York</a> -->
            <!-- <button class="navbar-toggler navbar-toggler-white" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span> -->
            </button>
            <div class="navbar-collapse" id="navbarNavDropdown">
               <div class="navbar-nav mr-auto mt-2 mt-lg-0 margin-auto top-categories-search-main">
                  <div class="top-categories-search">
                     <div class="input-group">
                        <!-- <span class="input-group-btn categories-dropdown">
                           <select class="form-control-select">
                              <option selected="selected">Your City</option>
                              <option value="0">New Delhi</option>
                              <option value="2">Bengaluru</option>
                              <option value="3">Hyderabad</option>
                              <option value="4">Kolkata</option>
                           </select>
                        </span> -->
                        <!-- <input class="form-control" placeholder="Search products in Your City" aria-label="Search products in Your City" type="text">
                        <span class="input-group-btn">
                        <button class="btn btn-secondary" type="button"><i class="mdi mdi-file-find"></i> Search</button>
                        </span> -->
                     </div>
                  </div>
               </div>
               <div class="my-2 my-lg-0">
                  <ul class="list-inline main-nav-right">
                     <li class="list-inline-item">
                     <?php
                     $login_status = loginStatus();
                     if($login_status=="EmptySession"){
                     ?>
                        <!-- <a href="#" data-target="#bd-example-modal" data-toggle="modal" class="btn btn-link"><i class="mdi mdi-account-circle"></i> Login/Sign Up</a> -->
                     <?php }else{ ?>
                        <a href="<?php echo SITE_URL; ?>logout"  class="btn btn-link"><i class="mdi mdi-account-circle"></i>Logout</a>

                     <?php } ?>
                     </li>
                     <li class="list-inline-item cart-btn">
                     <?php 
                     $cartSessionId    = $_SESSION['cartSessionId'];
                     $valuescartCounts =  productCartIdentificationAllPages($cartSessionId);
                     if($valuescartCounts){$valuescartCountsData = $valuescartCounts;}else{ $valuescartCountsData = "0";}
                     ?>
                        <a href="cart" class="btn btn-link border-none"><i class="mdi mdi-cart"></i> My Cart <small class="cart-value cartcoutview"><?php echo $valuescartCountsData; ?></small></a>
                        <!-- <a href="#" data-toggle="offcanvas" class="btn btn-link border-none"><i class="mdi mdi-cart"></i> My Cart <small class="cart-value"><?php echo $valuescartCountsData; ?></small></a> -->
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </nav>
      
      <!-- <nav class="navbar navbar-expand-lg navbar-light osahan-menu-2 pad-none-mobile">
         <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarText">
               <ul class="navbar-nav mr-auto mt-2 mt-lg-0 margin-auto">
                  <li class="nav-item">
                     <a class="nav-link shop" href="index.html"><span class="mdi mdi-store"></span> Super Store</a>
                  </li>
				  <li class="nav-item">
                     <a href="index.html" class="nav-link">Home</a>
                  </li>
				  <li class="nav-item">
                     <a href="about.html" class="nav-link">About Us</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="shop.html">Fruits & Vegetables</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="shop.html">Grocery & Staples</a>
                  </li>
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     Pages
                     </a>
                     <div class="dropdown-menu">
                        <a class="dropdown-item" href="shop.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> Shop Grid</a>
                        <a class="dropdown-item" href="single.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> Single Product</a>
                        <a class="dropdown-item" href="cart.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> Shopping Cart</a>
                        <a class="dropdown-item" href="checkout.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> Checkout</a> 
                     </div>
                  </li>
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     My Account
                     </a>
                     <div class="dropdown-menu">
                        <a class="dropdown-item" href="my-profile.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i>  My Profile</a>
                        <a class="dropdown-item" href="my-address.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i>  My Address</a>
                        <a class="dropdown-item" href="wishlist.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i>  Wish List </a>
                        <a class="dropdown-item" href="orderlist.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i>  Order List</a> 
                     </div>
                  </li>
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     Blog Page
                     </a>
                     <div class="dropdown-menu">
                        <a class="dropdown-item" href="blog.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> Blog</a>
                        <a class="dropdown-item" href="blog-detail.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> Blog Detail</a>
                     </div>
                  </li>
				  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     More Pages
                     </a>
                     <div class="dropdown-menu">
                        <a class="dropdown-item" href="about.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i>  About Us</a>
                        <a class="dropdown-item" href="contact.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i>  Contact Us</a>
                        <a class="dropdown-item" href="faq.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i>  FAQ </a>
                        <a class="dropdown-item" href="not-found.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i>  404 Error</a> 
                     </div>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="contact.html">Contact</a>
                  </li>
               </ul>
            </div>
         </div>
      </nav> -->
      <!-- <div class="xs-menu-cont">
			<a id="menutoggle"><i class="fa fa-align-justify"></i> </a>
				<nav class="xs-menu displaynone">
					<ul>
						<li class="active">
							<a href="#">Home</a>
						</li>
						<li>
							<a href="#">About</a>
						</li>
						<li>
							<a href="#">Services</a>
						</li>
						<li>
							<a href="#">Team</a>
						</li>
						<li>
							<a href="#">Portfolio</a>
						</li>
						<li>
							<a href="#">Blog</a>
						</li>
						<li>
							<a href="#">Contact</a>
						</li>

					</ul>
				</nav>
			</div>
			<nav class="menu">
				<ul>
					<li class="active">
						<a href="#">Home</a>
					</li>
					<li class="drop-down">
						<a href="#">Products</a>
					 
						<div class="mega-menu fadeIn animated">
							<div class="mm-6column">
								<span class="left-images">
								<img  src="https://4.bp.blogspot.com/-faF-AemPFUM/U4ryP7pQRsI/AAAAAAAAEvA/fZ-hskCSln4/s1600/Magento%2Bthemes.jpg">
								<p>Most Popular Styles </p>
				</span>
								<span class="categories-list">
							<ul>
							<span>Computer</span>
								<li>Desktops</li>
								<li>Laptops</li>
								<li>Tablets</li>
								<li>Monitors</li>
								<li>Networking Printers</li>
								<li>Scanners</li>
								<li>Jumpers & Cardigans</li>
								<li><a class="mm-view-more" href="#">View more →</a></li>
							</ul>
						</span>
							
							</div>
							<div class="mm-3column">
						<span class="categories-list">
						<ul>
							 <span>TV & Video</span>
								<li>LED TVs
								<li>Plasma TVs
								<li>3D TVs
								<li>DVD & Blu-ray Players
								<li>Home Theater Systems
								<li>Cell Phones
								<li>Apple iPhone
								<li><a class="mm-view-more" href="#">View more →</a></li>
							</ul>
						</span>							
							</div>
							<div class="mm-3column">
								<span class="categories-list">
						<ul>
							<span>Car Electronics</span>
							<li>GPS & Navigation</li>
							<li>In-Dash Stereos</li>
							<li>Speakers</li>
							<li>Subwoofers</li>
							<li>Amplifiers</li>
						    <li>MP3 Players</li>
							<li>iPods</li>
						   	<li><a class="mm-view-more" href="#">View more →</a></li>
						</ul>
					</span>
						</div>
					</div>
			 
					</li>
					<li>
						<a href="#">Services</a>
					</li>
					<li>
						<a href="#">Team</a>
					</li>
					<li>
						<a href="#">Portfolio</a>
					</li>
					<li>
						<a href="#">Blog</a>

					</li>
					<li>
						<a target="_blank" href="https://twitter.com/MD_MahediNishad">Contact</a>
					</li>
         <li style="float:right;">
           <a href="https://twitter.com/MD_MahediNishad">Follow Me</a>
          </li>

				</ul>
			</nav>
		</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<style>
nav.menu {
	background: coral;
	position: relative;
	min-height: 45px;
	height: 100%;
}

.menu > ul > li {
	list-style: none;
	display: inline-block;
	color: #fff;
	line-height: 45px;
	
}
.menu > ul li a, .xs-menu li a {
	text-decoration: none;
	color: #fff;
	 display:block;
	 padding: 0px 24px;
}
.menu > ul li a:hover {
	background:#101010;
	color: #fff;
	transition-duration: 0.3s;
	-moz-transition-duration: 0.3s;
	-webkit-transition-duration: 0.3s;
}
.active{
	background:#090909 !important;
	
}
.displaynone{
	display: none;
}
.xs-menu-cont{
display:none;
}
.xs-menu-cont > a {
    background: none repeat scroll 0 0 #ff7f50;
    border-radius: 3px;
    padding: 3px 6px;
	display: block;
	border-bottom:1px solid #E67248;
	    box-shadow: 0 1px 2px #e67248;
		-webkit-box-shadow: 0 1px 2px #e67248;
		-moz-box-shadow: 0 1px 2px #e67248;
}
.xs-menu-cont > a:hover{
 cursor: pointer;
}
  
.xs-menu li {
color: #fff;
padding: 14px 30px;
border-bottom: 1px solid #ccc;
background: #FF7F50;

}
.xs-menu  a{
text-decoration:none;
}

.mega-menu {
   background: none repeat scroll 0 0 #888;
    left: 0;
    margin-top: 3px;
    position: absolute;
    width: 100%;
	padding:15px;
	display:none;
   z-index: 1;
	 transition-duration: 0.9s;
    
}
#menutoggle i {
    color: #fff;
    font-size: 33px;
    margin: 0;
    padding: 0;
}


/*--column--*/
.mm-6column:after, .mm-6column:before, .mm-3column:after, .mm-3column:before{
content:"";
display:table;
clear:both;


}
.mm-6column, .mm-3column {
 float: left;
 position: relative;
 }
.mm-6column {
    width: 50%;
}
.mm-3column {
        width: 25%;
}
.responsive-img {
    display: block;
    max-width: 100%;

}
.left-images{
margin-right:25px;
}
 .left-images, .left-categories-list {
   float: left;
}
.categories-list li {
    display: block;
    line-height: normal;
    margin: 0;
    padding: 5px 0;
}
.categories-list li :hover{
		background:inherit !important;
}
.left-images > p {
    background: none repeat scroll 0 0 #ff7f50;
    display: block;
    font-size: 18px;
    line-height: normal;
    margin: 0;
    padding: 5px 14px;
}
.categories-list span {
    font-size: 18px;
    padding-bottom: 5px;
    text-transform: uppercase;
}
.mm-view-more{
	background: none repeat scroll 0 0 #ff7f50;
    color: #fff;
    display: inline !important;
    line-height: normal;
    padding: 5px 8px !important;
	margin-top:10px;
}
.display-on{
display:block;
 transition-duration: 0.9s;
}
.drop-down > a:after{
content:"\f103";
color:#fff;
font-family: FontAwesome;
font-style: normal;
margin-left: 5px;
 

}
 /*MediaQuerys*/
 @media (max-width: 600px) {
.menu {
 display:none;
 }
 .xs-menu li a {

	 padding:0px;
}
 .xs-menu-cont{
 display:block ;
 }
 }


/*Animation--*/

.animated {
  -webkit-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
}
@-webkit-keyframes fadeIn {
  0% {
    opacity: 0;
  }

  100% {
    opacity: 1;
  }
}

@keyframes fadeIn {
  0% {
    opacity: 0;
  }

  100% {
    opacity: 1;
  }
}

.fadeIn {
  -webkit-animation-name: fadeIn;
  animation-name: fadeIn;
}

</style>

<script>
 
 $(document).ready(function() {
				//responsive menu toggle
				$("#menutoggle").click(function() {
					$('.xs-menu').toggleClass('displaynone');

					});
				//add active class on menu
				$('ul li').click(function(e) {
					e.preventDefault();
					$('li').removeClass('active');
					$(this).addClass('active');
				});
			//drop down menu	
					$(".drop-down").hover(function() {
						$('.mega-menu').addClass('display-on');
					});
					$(".drop-down").mouseleave(function() {
						$('.mega-menu').removeClass('display-on');
					});
			
			});

	 
</script> -->

<!-- menu start -->
<nav id="menu-1" class="mega-menu" data-color="">
    <!-- menu list items container -->
    <section class="menu-list-items">
    <div class="container-fluid">
            <div class="row">
        <!-- menu logo -->
        <ul class="menu-logo">
            <li>
                <a href="#"> <!--<i class="fa fa-circle-o-notch"></i>-->  </a>
            </li>
        </ul>
        <!-- menu links -->
        <ul class="menu-links">
            <!-- active class -->
            <?php $maincategory =	categoryParent(0,'');
									foreach($maincategory as $mainCateteory){ ?>
                              <li><a href="<?php echo  $mainCateteory['cat_alias']; ?>"> <i class="fa fa-home"></i> <?php echo  $mainCateteory['name']; ?></a>
                        
                          <!-- drop down full width -->
                </li>
                              <?php } ?>
                              <!-- <li><a href="/about-us">About Us</a></li>
                              <li><a href="/faq">FAQ</a></li>
                              <li><a href="/contact-us">Contact Us</a></li> -->

    
                 </ul>
                     </div>
                     </div>
    </section>
</nav>
<!-- menu end -->

   