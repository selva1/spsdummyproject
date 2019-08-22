<?php 
/*function redirectTohttps() {
if($_SERVER['HTTPS']!="on") {
	if($_SERVER['HTTP_HOST']=="www.snapmall.in"){
	$redirect= "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	}else{
		$redirect= "https://www.".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	}
	//$redirect= "https://www".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	header("Location:$redirect");
 } 
 }
 redirectTohttps();*/


include_once 'includes/config.php';
include_once 'includes/db.php';
include_once 'includes/functions.php';


$curPageURL =  curPageURL();
//$seo_url = str_ireplace(SITE_URL,"","$curPageURL");
$seo_url = str_ireplace(SITE_URL,"","$curPageURL");
$seo_url = str_ireplace(SITE_URL,"","$seo_url");
$seo_url = str_ireplace(SITE_URL,"","$seo_url");
$seo_url = str_ireplace(SITE_URL,"","$seo_url");
$seo_url_splited = @explode("/",trim(strtolower($seo_url)));
$seo_url_total = sizeof($seo_url_splited);
$seo1 = '';
$seo2 = '';
$seo3 = '';

foreach ($seo_url_splited as $key  =>$seo_value) {
    if($key==0){
        $seo1 = $seo_value;
    }
    if($key==1){
        $seo2 = $seo_value;
    }
    if($key==2){
        $seo3 = $seo_value;
    }
}
$catTypesValue ='1';
/*if($seo1=="brand-new"){
	$catTypesValue ='1';
}else if($seo1=='factory-refurbs'){
	$catTypesValue ='2';
}else{
	$catTypesValue ='1';
}*/

if(isset($_POST['ajax'])&&isset($_POST['ajax_task'])){
	
	switch($_POST['ajax_task']){
	case 'get_category_list':
	   include_once 'includes/get_category_lists.php';
	break;
	case 'get_brand_list':
	   include_once 'includes/get_brands_list.php';
	break;
	case 'get_gift_list':
	   include_once 'includes/get_gift_filter_list.php';
	break;
	case 'search_filter_design':
	   include_once 'includes/get_search_filter_design.php';
	break;
	default:
	break;
	}

	include_once 'includes/common_ajax.php';
	exit;	
}

if($seo1=='login-with-twitter'){
    include_once("includes/login_with_twitter.php");
    exit;
}
/*if($seo1=='payment-success'){
    include_once("includes/payment_success.php");
    exit;
}*/
if($seo1=='gift-payment'){
    include_once("includes/payments.php");
    exit;
}
if($seo1=='payment-cancelled'){
    include_once("includes/payment-cancelled.php");
    exit;
}
$sub_cat_id = getCatId($seo2);
if($seo1=="gift" && $sub_cat_id!="" ){
	include_once 'includes/second-home-header.php';
	include_once 'includes/gift_filter_template.php';
	include_once 'includes/gift-filter-footer.php';	
	echo '<input type="hidden" id="seo_1" name="seo_1" value="'.$seo1.'"/>
	<input type="hidden" id="seo_2" name="seo_2" value="'.$seo2.'"/>
	<input type="hidden" id="seo_3" name="seo_3" value="'.$seo3.'"/>
	<input type="hidden" id="ajaxSiteUrl" name="ajaxSiteUrl" value="'.SITE_URL.'"/>';
	exit;
}

$staticRows = staticPageContets($seo1);
$page_alias =  $staticRows['page_alias'];
//echo $seo1;
if($seo1=='login' || $seo1=='registration' || $seo1=='logout' || $seo1=='cart' ||  $seo1=='checkout' ||  $seo1=='order-processing' ||  $seo1=='order-processing' || $seo1=='seller-enquiry' || $seo1=='forget-password' || $seo1=='search' || $seo1=='reset-password'|| $seo1=='forgetpassword'||  $seo1=='about-us'|| $seo1=='gift' || $seo1=='order-histroy' || $seo1=='order-success' || $seo1=='payment-success' || $seo1==$page_alias && $page_alias!="" || $seo1=='write-review'|| $seo1=='gift-voucher'){
    
	include_once 'includes/static-common-header.php';
	include_once 'includes/static-page-template.php';
	include_once 'includes/static-footer.php';
    exit;
}
if ( $seo1=='test') {
        include_once 'includes/test.php';
        include_once 'includes/static-page-template.php';
        include_once 'includes/static-footer.php';
        exit;
}
$bands_found  = check_seo_brands($seo1);
$bands_found2 = check_seo_brands($seo2);


/*if($seo1==''){
	include_once 'includes/home-header.php';
    include_once 'includes/home_template.php';
    include_once 'includes/home-footer.php';
    
}else */
if($bands_found || $bands_found2 ){
	include_once 'includes/second-home-header.php';
	include_once 'includes/brand_template.php';
	include_once 'includes/brands-filter-footer.php';
   /* if($seo1=='brand' &&  $seo2==''){
    	include_once 'includes/header.php';
        include_once 'includes/brands_template.php';
        include_once 'includes/footer.php';
    }
    else if($seo1=='brand' &&  $seo2!=''){
    	include_once 'includes/second-home-header.php';
        include_once 'includes/brand_template.php';
        include_once 'includes/second-home-footer.php';
    }*/
}else if($seo1=='' || $seo1==''){
	    $cat_id = getCatId($seo1);
        $sub_cat_id = '';
        if($seo2!=''){
		 $sub_cat_id = getCatId($seo2);
		}
    include_once 'includes/second-home-header.php';
    include_once 'includes/second-home-template.php';
    include_once 'includes/second-home-footer.php';
    
}else if($seo1=='contact-us'){
    include_once 'includes/second-home-header.php';
    include_once 'includes/contact-us.php';
    include_once 'includes/static-footer.php';
}else if($seo1!=''){
	
    $product_found = check_seo_product($seo1);
    $category_found = check_seo_category($seo1);
    
    if($product_found){
    	include_once 'includes/second-home-header.php';
        include_once 'includes/product_template.php';
        include_once 'includes/second-home-footer.php';
    }
    else if($category_found){
         $cat_id = getCatId($seo1);
        $sub_cat_id = '';
        if($seo2!=''){
		 $sub_cat_id = getCatId($seo2);
		}
		include_once 'includes/second-home-header.php';
        include_once 'includes/category_template.php';
        include_once 'includes/category-filter-footer.php';
    } else {
    	
        include_once 'includes/second-home-header.php';
        include_once 'includes/page_template.php';
        include_once 'includes/second-home-footer.php';
    }
}

?>
<input type="hidden" id="seo_1" name="seo_1" value="<?php echo $seo1; ?>"/>
<input type="hidden" id="seo_2" name="seo_2" value="<?php echo $seo2; ?>"/>
<input type="hidden" id="seo_3" name="seo_3" value="<?php echo $seo3; ?>"/>
<input type="hidden" id="ajaxSiteUrl" name="ajaxSiteUrl" value="<?php echo SITE_URL; ?>"/>