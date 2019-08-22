<?php
if(isset($_POST['ajax'])&&isset($_POST['ajax_task'])){
	switch($_POST['ajax_task']){
		case 'LoginValid':
		 echo  login();
		break;
		case 'Registrations':
		  echo register();
		break;
		case 'emailcheckexist':
		   emailExist();
		break;
		case 'forgetPassword':
		    forgetPassword();
		break;
		case 'resetpasswordresponse':
		    resetPassword();
		break;
		case 'addTocart':
		    addToCart();
		break;
		case 'DeleteCartProduct':
		    DeleteCartProduct();
		break;
		case 'subscribeEmail':
		    subscribeEmail();
		break;
		case 'checkoutOnload':
		    checkoutDisplayContet();
		break;
		case 'couponCodevalid':
		    couponCodevalid();
		break;
		case 'searchHeaderFilter':
		    mainSearchFuncNew();
		break;
		case 'headerCartDesign':
		    headerCarts();
		break;
        case 'SellerEnquiry':
            SellerEnquiry();
            break;
        case 'AddReview':
            AddReview();
            break;
		case 'ReviewOrder':
            get_all_reviews_order();
            break;
		case 'LoginWithGoogle':
            google_login();
			break;
		case 'saveGiftVoucher':
            saveGiftVoucher();
			break;
		case 'giftVoucherValid':
            giftVoucherValid();
			break;
        case 'ContactRequest':
            contactrequest();
		
		default:
		break;
	}
exit;	
}
?>