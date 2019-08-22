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

$surl="location:".SITE_URL."checkout/";
$furl="location:".SITE_URL."order-faild/";	
$conn=dbconnection();
$userid = $_SESSION['userid'];
$currentDate = date("Ymd");
$cartSession =  $_SESSION['cartSessionId'];
$name    = mysqli_real_escape_string($conn,$_POST['name']);
$email = mysqli_real_escape_string($conn,$_POST['email']);
$phonenum = mysqli_real_escape_string($conn,$_POST['phonenum']);
$address = $_POST['address']; //mysqli_real_escape_string($conn,$_POST['address']);
$country = mysqli_real_escape_string($conn,$_POST['country']);
$city = mysqli_real_escape_string($conn,$_POST['city']);
$District = mysqli_real_escape_string($conn,$_POST['District']);
$Postcode = mysqli_real_escape_string($conn,$_POST['Postcode']);
$Notes = mysqli_real_escape_string($conn,$_POST['Notes']);
$optionsRadios = mysqli_real_escape_string($conn,$_POST['optionsRadios']);
$couponID = mysqli_real_escape_string($conn,$_POST['couponID']);
$voucherID = mysqli_real_escape_string($conn,$_POST['voucherID']);

if(!empty($name)&&!empty($email)&&!empty($phonenum)&&!empty($address)&&!empty($country)&&!empty($city)&&!empty($District)&&!empty($Postcode)&&!empty($Notes)&&!empty($optionsRadios)){
	$statement = $conn->prepare("UPDATE hm_users SET name=?, shipping_email=?, shipping_mobile=?,shipping_address=?,country=?,city=?,districk=?,zip=?,spical_notes=? WHERE id=?");
	//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
	$statement->bind_param('sssssssssi', $name, $email,$phonenum,$address,$country,$city,$District,$Postcode,$Notes,$userid);
	$results =  $statement->execute();
        
	if(empty($_SESSION['orderids'])){
            $orderId = $currentDate.$userid.time();           
            updateUserIdtoCart($cartSession,$userid,$orderId);            
            $orderVals = updateUserIdtoOrderDetails($cartSession,$userid,$orderId,$country,$couponID,$optionsRadios);
            $_SESSION['orderids']=$orderVals;
	}else{
		$orderidupdate = $_SESSION['orderids'];
		updateUserIdtoCart($cartSession,$userid,$orderidupdate);
	}	
        //  echo "Here".$orderVals;
        //exit;
	$order_optionval = mysqli_real_escape_string($conn,$_POST['optionsRadios']);
	
	if($orderVals!=="" && $order_optionval=="paymentGateway"){
            //$redirectUrl = "Location: ".SITE_URL."order-processing/metod=".$optionsRadios;
            $redirectUrl = "Location: ".SITE_URL."razorpay/pay.php";
            
            header($redirectUrl);	
        }
	if($orderVals!=="" && $order_optionval=="BankDeposit"){
		// $redirectUrl = "Location: ".SITE_URL."order-success/?oderId=".$orderVals."&metod=".$optionsRadios;
      
      $redirectUrl = "Location: ".SITE_URL."order-histroy/";
      header($redirectUrl);
		unset($_SESSION['cartSessionId']);
	}
	unset($_POST);
}

$summary = checkoutsummry($cartSession);
$checkoutedits = checkoutedits($userid);

if($checkoutedits['shipping_email']=="")
    $email_txt_val=$checkoutedits['email'];
else
    $email_txt_val=$checkoutedits['shipping_email'];
if($checkoutedits['shipping_mobile']=="")
    $phone_txt_val=$checkoutedits['phone_number'];
else
    $phone_txt_val=$checkoutedits['shipping_mobile'];

?>
 <section class="checkout-page section-padding">
 <form id="checkout_validate_form" name="checkout_validate_form" action=""  method="post">
         <div class="container">
            <div class="row">
               <div class="col-md-8">
                  <div class="checkout-step">
                     <div class="accordion" id="accordionExample">
                        <div class="card checkout-step-one">
                           <div class="card-header" id="headingOne">
                              <h5 class="mb-0">
                                 <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                  Checkout <!-- <span class="number">1</span> Phone Number Verification -->
                                 </button>
                              </h5>
                           </div>
                           <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                              <div class="card-body">
                                 <!-- <p>We need your phone number so that we can update you about your order.</p> -->
                                    <div class="form-row align-items-center">
                                       <div class="col-auto">
                                          <label class="sr-only">phone number</label>
                                          <div class="input-group mb-2">
                                             <div class="input-group-prepend">
                                                <div class="input-group-text"><span class="mdi mdi-cellphone-iphone"></span></div>
                                             </div>
                                             <input type="text" class="form-control" id="couponID" name="couponID" onblur="couponCodeExsits();onPageLoadCheckout('applyCoupon');" placeholder="Enter The Coupon">
                                            </div>
                                           
                                       </div>
                                       <div class="col-auto">
                                          <button type="button" onclick="onPageLoadCheckout('applyCoupon');" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="btn btn-secondary mb-2 btn-lg">Apply Coupon</button>
                                       </div>
                                       <span id="coponerror" style="color: red;width: 100%;float: left;"></span>
                                    </div>
                              </div>
                              <div class="card-body">
                                    <div class="row">
                                       <div class="col-sm-12">
                                          <div class="form-group">
                                             <label class="control-label">Name <span class="required">*</span></label>
                                             <input class="form-control border-form-control"  id="name" name="name" value="<?php echo $checkoutedits['name']; ?>" placeholder="Name" type="text">
                                          </div>
                                       </div>
                                       <!-- <div class="col-sm-6">
                                          <div class="form-group">
                                             <label class="control-label">Last Name <span class="required">*</span></label>
                                             <input class="form-control border-form-control" value="" placeholder="Osahan" type="text">
                                          </div>
                                       </div> -->
                                    </div>
                                    <div class="row">
                                       <div class="col-sm-6">
                                          <div class="form-group">
                                             <label class="control-label">Phone <span class="required">*</span></label>
                                             <input class="form-control border-form-control" id="phonenum" name="phonenum" value="<?php echo $phone_txt_val; ?>"  placeholder="Mobile Number" type="number">
                                          </div>
                                       </div>
                                       <div class="col-sm-6">
                                          <div class="form-group">
                                             <label class="control-label">Email Address <span class="required">*</span></label>
                                             <input class="form-control border-form-control " id="email" name="email" value="<?php echo $email_txt_val; ?>" placeholder="E-mail" type="email">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-sm-12">
                                          <div class="form-group">
                                             <label class="control-label">Shipping Address <span class="required">*</span></label>
                                             <textarea class="form-control border-form-control" id="address" name="address" placeholder="Address*"><?php echo $checkoutedits['shipping_address']; ?></textarea>
                                             <small class="text-danger">Please provide the number and street.</small>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-sm-6">
                                          <div class="form-group">
                                             <label class="control-label">Country <span class="required">*</span></label>
                                             <select  id="country" name="country" onchange="onPageLoadCheckout('changecountry')" class="select2 form-control border-form-control">
                                                <option value="">Select Your Country</option>
                                                <?php 
                                                $viewCarts= countrylist();
                                                foreach($viewCarts['contryresult'] as $viewCartsRow){

                                                $editcountry = $checkoutedits['country'];
                                                /*if($viewCartsRow->id==$editcountry){
                                                //$countselect ="selected = selected";
                                                $countselect ="113";
                                                }else {
                                                $countselect ="113";
                                                }*/
                                                $countselect ="";
                                                if($viewCartsRow->id=="99"){
                                                $countselect ="selected = selected";?>
                                                <option value="<?php echo $viewCartsRow->id;  ?>" <?php echo $countselect; ?>><?php echo $viewCartsRow->country_name;  ?></option>

                                                <?php
                                                }?>

                                                <?php } ?>   
                                            </select>
                                          </div>
                                       </div>
                                       <div class="col-sm-6">
                                          <div class="form-group">
                                             <label class="control-label">City <span class="required">*</span></label>
                                             <input class="form-control border-form-control "  type="text" placeholder="City / Town*" type="text" id="city" name="city"  value="<?php echo $checkoutedits['city']; ?>" />
                                             <!-- <select class="select2 form-control border-form-control">
                                                <option value="">Select City</option>
                                                <option value="AF">Alaska</option>
                                                <option value="AX">New Hampshire</option>
                                                <option value="AL">Oregon</option>
                                                <option value="DZ">Toronto</option>
                                             </select> -->
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-sm-6">
                                          <div class="form-group">
                                             <label class="control-label">Zip Code <span class="required">*</span></label>
                                             <input class="form-control border-form-control"placeholder="Postcode / ZIP*" type="text" id="Postcode" name="Postcode" value="<?php echo $checkoutedits['zip']; ?>" type="text">
                                          </div>
                                       </div>
                                       <div class="col-sm-6">
                                          <div class="form-group">
                                             <label class="control-label">State <span class="required">*</span></label>
                                             <input class="form-control border-form-control "  type="text" placeholder="state*" type="text" id="District" name="District" value="<?php echo $checkoutedits['districk']; ?>"/>

                                             <!-- <select class="select2 form-control border-form-control">
                                                <option value="">Select State</option>
                                                <option value="AF">California</option>
                                                <option value="AX">Florida</option>
                                                <option value="AL">Georgia</option>
                                                <option value="DZ">Idaho</option>
                                             </select> -->
                                          </div>
                                       </div>
                                       
                                    </div>
                                    <div class="row">
                                       <div class="col-sm-12">
                                          <div class="form-group">
                                             <label class="control-label">Special Notes<span class="required">*</span></label>
                                             <textarea class="form-control border-form-control" id="Notes" name="Notes" placeholder="Special Notes"><?php echo $checkoutedits['spical_notes']; ?></textarea>
                                             <!-- <small class="text-danger">Please provide the number and street.</small> -->
                                          </div>
                                       </div>
                                    </div>
                                   
                              </div>

                           </div>
                        </div>
                       
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="card" id="showCheckout">
                     <!-- <h5 class="card-header">My Cart <span class="text-secondary float-right">(5 item)</span></h5>
                     <div class="card-body pt-0 pr-0 pl-0 pb-0">
                        <div class="cart-list-product">
                           <a class="float-right remove-cart" href="#"><i class="mdi mdi-close"></i></a>
                           <img class="img-fluid" src="img/item/11.jpg" alt="">
                           <span class="badge badge-success">50% OFF</span>
                           <h5><a href="#">Product Title Here</a></h5>
                           <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
                           <p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$800.99</span></p>
                        </div>
                        <div class="cart-list-product">
                           <a class="float-right remove-cart" href="#"><i class="mdi mdi-close"></i></a>
                           <img class="img-fluid" src="img/item/1.jpg" alt="">
                           <span class="badge badge-success">50% OFF</span>
                           <h5><a href="#">Product Title Here</a></h5>
                           <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
                           <p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$800.99</span></p>
                        </div>
                        <div class="cart-list-product">
                           <a class="float-right remove-cart" href="#"><i class="mdi mdi-close"></i></a>
                           <img class="img-fluid" src="img/item/2.jpg" alt="">
                           <span class="badge badge-success">50% OFF</span>
                           <h5><a href="#">Product Title Here</a></h5>
                           <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
                           <p class="offer-price mb-0">$450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$800.99</span></p>
                        </div> -->
                     </div>
                  </div>
               </div>
            </div>
         </div>
</form>       
      </section>
<style>
  .table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
    width: 40%;
}
</style>      
