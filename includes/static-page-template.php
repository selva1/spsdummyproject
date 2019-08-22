<?php 
 $cat_id;
 $sub_cat_id;
$staticRows = staticPageContets($seo1);
$name = $staticRows['name'];
$page_alias =  $staticRows['page_alias'];
$content = $staticRows['content'];
?>
	<?php
	if($seo1=='login'){
		$login_status = loginStatus();
		if($login_status=="EmptySession"){
		 //echo   logindesign();
		 
		 	echo "<p class='myaccount'>My Account</p>";
		echo '
    <div class="col-md-6 col-sm-12 boxcolorchange">
     <div class="login_register_class">Existing Customer ? Login here : </div>
     <form id="login-form">
            <div class="modal-body">
	    		<div id="div-login-msg"  style="border:0px solid #fff;">
                    <span id="text-login-msg"></span>
                </div>
                <input type="hidden"  value='.$is_review.' class="form-control" name="hdn_isReview" id="hdn_isReview">
                <input type="hidden"  value="'.$pro_alis_link.'" class="form-control" name="hdn_product_id" id="hdn_product_id">

	    		<input type="text" placeholder="E-mail" class="form-control" name="login_username" id="login_username">
	    		<input type="password" placeholder="Password" class="form-control" name="login_password" id="login_password">
                <div class="checkbox">
                    <label>
                     <a class="losspossword" href='.SITE_URL.'forgetpassword/><button class="btn btn-link" type="button">Lost Password?</button></a>
                </label>
                </div>     	
                </div>
	        <div class="modal-footer">
                <div>
                    <button name="Logins" id="Logins" class="btn btn-primary btn-lg btn-block" type="button">Login</button>
                </div>
	    	    <div>
                </div>
	        </div>

        </form>
        <div class="col-md-4">
          <!-- <a style="cursor: pointer" onclick="googleSignIn()" class="btn google">Login with Google </a> 
          <a class="btn btn-default google" href="javascript:void(0);" onclick="googleSignIn()"> <i class="fa fa-google-plus modal-icons"></i> Login with Google </a>-->
        </div>
        <div class="col-md-4">
          <!-- <a style="cursor: pointer" onclick="return fblogin()" class="btn google">Login with Facebook </a> 
          <a class="btn btn-default facebook" href="javascript:void(0);" onclick="return fblogin()"> <i class="fa fa-facebook modal-icons"></i> Login with Facebook </a>-->
        </div>
        <div class="col-md-4">
          <!-- <a style="cursor: pointer" onclick="return twitterLogin()" class="btn google">Login with Twitter </a>
          <a class="btn btn-default twitter"  href="javascript: void(0)" onclick="'.$text.'; return false;"> <i class="fa fa-twitter modal-icons"></i> Login with Twitter </a> -->
        </div>
        </div>';
		
		echo '
    <div class="col-md-6 boxcolorchange">
     <div class="login_register_class register_class">Create New Account : </div>
     <form style="display: block;" id="register-form">
	    <div class="modal-body">
			<!--<div id="div-register-msg">
                    <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
                      <span id="text-register-msg"></span>
                </div> -->
                <input type="text" onblur="r_checkseekeremail();" name="r_email" required="" placeholder="E-mail" class="form-control" id="r_email" style="float:left;margin-bottom:10px;">
                <span style="font-color:#E10707;float:left; " class="error" id="r_err_mail"></span>
                <input type="text" name="r_ph_no" maxlength="10" style="float:left;" placeholder="Mobile" class="form-control" id="r_ph_no">
                 <span style="font-color:#E10707;  margin-top:20px; float:left; " class="error" id="r_err_ph_no"></span>
                <input type="password" style="font-color:#E10707;margin-bottom: 15px;
    margin-top: 15px; float:left; " placeholder="Password" name="r_password" class="form-control" id="r_password">
                 <span style="font-color:#E10707; font-size:10px; margin-top:20px; float:left; " class="error" id="r_err_password"></span>
                 <input type="password" placeholder="Cofirm Password" name="r_con_password" class="form-control" id="r_con_password">
                 <span style="font-color:#E10707; margin-top:20px; float:left; " class="error" id="r_err_Confirm"></span>
                <!--<input id="mobile" name="mobile" class="form-control" type="text" placeholder="Mobile" required>-->
                <!--<input id="register_password" name="register_password" class="form-control" type="password" placeholder="Password" required>-->
                <input type="checkbox" name="checkterms" id="checkterms" />
  				<label for="checkterms" style="font-color:#E10707;" > I would like to receive product update and specials via email</label>
  				<br/>
  				<span style="font-color:#E10707; margin-top:0px; float:left; " class="error" id="r_err_terms"></span>
		</div>
	    <div class="modal-footer">
                <div>
                    <button onclick="pageregister();" class="btn btn-primary btn-lg btn-block" type="button">Register</button>
                </div>
                <div>
                </div>
	    </div>
        </form></div>';
		 
		 }else{
			$redirecturl="location:".SITE_URL."checkout/";
			header($redirecturl);
		 }
	}elseif($seo1=='registration'){
		//registerationdesign();
		echo "<p class='myaccount'>My Account</p>";
		echo '
    <div class="col-md-6 boxcolorchange">
     <div class="login_register_class">Existing Customer ? Login here : </div>
     <form id="login-form">
            <div class="modal-body">
	    		<div id="div-login-msg"  style="border:0px solid #fff;">
                    <span id="text-login-msg"></span>
                </div>
                <input type="hidden"  value='.$is_review.' class="form-control" name="hdn_isReview" id="hdn_isReview">
                <input type="hidden"  value="'.$pro_alis_link.'" class="form-control" name="hdn_product_id" id="hdn_product_id">

	    		<input type="text" placeholder="E-mail" class="form-control" name="login_username" id="login_username">
	    		<input type="password" placeholder="Password" class="form-control" name="login_password" id="login_password">
                <div class="checkbox">
                    <label>
                     <a class="losspossword" href='.SITE_URL.'forgetpassword/><button class="btn btn-link" type="button">Lost Password?</button></a>
                </label>
                </div>     	
                </div>
	        <div class="modal-footer">
                <div>
                    <button name="Logins" id="Logins" class="btn btn-primary btn-lg btn-block" type="button">Login</button>
                </div>
	    	    <div>
                </div>
	        </div>

        </form>
        <div class="col-md-4">
          <!-- <a style="cursor: pointer" onclick="googleSignIn()" class="btn google">Login with Google </a> 
          <a class="btn btn-default google" href="javascript:void(0);" onclick="googleSignIn()"> <i class="fa fa-google-plus modal-icons"></i> Login with Google </a>-->
        </div>
        <div class="col-md-4">
          <!-- <a style="cursor: pointer" onclick="return fblogin()" class="btn google">Login with Facebook </a> 
          <a class="btn btn-default facebook" href="javascript:void(0);" onclick="return fblogin()"> <i class="fa fa-facebook modal-icons"></i> Login with Facebook </a>-->
        </div>
        <div class="col-md-4">
          <!-- <a style="cursor: pointer" onclick="return twitterLogin()" class="btn google">Login with Twitter </a>
          <a class="btn btn-default twitter"  href="javascript: void(0)" onclick="'.$text.'; return false;"> <i class="fa fa-twitter modal-icons"></i> Login with Twitter </a> -->
        </div>
        </div>';
		
		echo '
    <div class="col-md-6 boxcolorchange">
     <div class="login_register_class register_class">Create New Account : </div>
     <form style="display: block;" id="register-form">
	    <div class="modal-body">
			<!--<div id="div-register-msg">
                    <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
                      <span id="text-register-msg"></span>
                </div> -->
                <input type="text" onblur="r_checkseekeremail();" name="r_email" required="" placeholder="E-mail" class="form-control" id="r_email" style="float:left;margin-bottom:10px;">
                <span style="font-color:#E10707;float:left; " class="error" id="r_err_mail"></span>
                <input type="text" name="r_ph_no" maxlength="10" style="float:left;" placeholder="Mobile" class="form-control" id="r_ph_no">
                 <span style="font-color:#E10707;  margin-top:20px; float:left; " class="error" id="r_err_ph_no"></span>
                <input type="password" style="font-color:#E10707;margin-bottom: 15px;
    margin-top: 15px; float:left; " placeholder="Password" name="r_password" class="form-control" id="r_password">
                 <span style="font-color:#E10707; font-size:10px; margin-top:20px; float:left; " class="error" id="r_err_password"></span>
                 <input type="password" placeholder="Cofirm Password" name="r_con_password" class="form-control" id="r_con_password">
                 <span style="font-color:#E10707; margin-top:20px; float:left; " class="error" id="r_err_Confirm"></span>
                <!--<input id="mobile" name="mobile" class="form-control" type="text" placeholder="Mobile" required>-->
                <!--<input id="register_password" name="register_password" class="form-control" type="password" placeholder="Password" required>-->
                <input type="checkbox" name="checkterms" id="checkterms" />
  				<label for="checkterms" style="font-color:#E10707;" > I would like to receive product update and specials via email.</label>
  				<br/>
  				<span style="font-color:#E10707; margin-top:0px; float:left; " class="error" id="r_err_terms"></span>
		</div>
	    <div class="modal-footer">
                <div>
                    <button onclick="pageregister();" class="btn btn-primary btn-lg btn-block" type="button">Register</button>
                </div>
                <div>
                </div>
	    </div>
        </form></div>';
        
		
	}elseif($seo1=='logout'){
		logout();
	}elseif($seo1=='cart'){
		include_once("cart.php");
	}elseif($seo1=='checkout'){
		include_once("checkout.php");
	}elseif($seo1=='order-histroy'){
		include_once("order-history.php");
	}elseif($seo1=='order-success'){
		include_once("order-success.php");
	}elseif($seo1=='about-us'){
		include_once("about-us.php");
	}elseif($seo1=='seller-enquiry'){
		include_once("seller-enquiry.php");
	}elseif($seo1=='search'){
		include_once("search.php");
	}elseif($seo1=='forget-password'){
		forgetPassword();
	}elseif($seo1=='reset-password'){
		resetPasswordconternt();
	}elseif($seo1=='forgetpassword'){
		forgetPasswordDesign();
	}elseif($seo1=='gift'){
		include_once("gift.php");
	}elseif($seo1=='write-review'){
		include_once("write_review.php");
	}elseif($seo1=='gift-voucher'){
		include_once("gift_voucher.php");
	}
	elseif($seo1=='payment-success'){
		include_once("payment_success.php");
	}
	elseif($seo1=='gift-payment'){
		include_once("payments.php");
	}
    elseif($seo1=='payment-cancelled'){
        include_once("payment-cancelled.php");
    }
    elseif($seo1=='order-processing'){
        include_once("order-processing.php");
    }
   /* elseif($seo1=='payment-success'){
        include_once("payment_success.php");
    }*/
    
    elseif($seo1==$page_alias){ ?>
    <div class="container">
            <div class="row">
    <?php 
		$content = str_replace("<div>","",$content);
		$content = str_replace("</div>","",$content);
		 echo $content;?>
     </div>
     </div>
     <?php
	}
   ?>
	