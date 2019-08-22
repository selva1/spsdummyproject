<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	
	include "include/function.php";
	isNotLogin();
	
	$command = $_REQUEST['command'];
	
	if(empty($command)){
		exit;
	} else {
		
		switch ($command) {
		case "addMainCategory":
		$addmainCategory = addmaincategory();
		break;
		case "addSubCategory":
		$addmainCategory = addsubcategory();
		break;
		case "addProduct":
		$addmainCategory = addproduct();
		break;
		case "addColor":
		$addmainCategory = addcolors();
		break;
		case "DeleteColorlist":
		$addmainCategory = deletecolors();
		break;
		case "DeleteHomeCategory":
			$addmainCategory = deleteHomeCategory();
			break;
            case "UpdateOrderStatus":
			$addmainCategory = updateOrderStatus();
			break;
		case "addShippment":
		$addmainCategory = addshippments();

		break;
		case "addCoupon":
		$addmainCategory = addcoupon();
		break;
		case "deleteShippment":
		$addmainCategory = deleteshippment();
		break;
		case "addStaticPage":
			$addmainCategory = addstaticpage();
		break;
        case "addSpecification":
            $addmainCategory = addSpecification();
            break;
        case "deleteCatSpecification":
            $addmainCategory = deleteCatSpecification();
            break;
        case "addProductSpecifications":
            $addmainCategory = addProductSpecifications();
            break;
        case "DeleteCategoryList":
            $addmainCategory = deleteCategory();
            break;
        case "addGiftVoucher":
            $addmainCategory = addGiftVoucher();
            break;
        case "DeleteGiftVoucher":
            $addmainCategory = DeleteGiftVoucher();
            break;
        case "deleteTopBanner":
            $addmainCategory = deleteTopBanner();
            break;
        case "DeleteProductList":
            $addmainCategory = DeleteProductList();
            break;
		case "deleteStaticPage":
			$addmaincategory = deletestaticpage();
			# code...
		break;
		/*case "blue":
		echo "Your favorite color is blue!";
		break;
		case "green":
		echo "Your favorite color is green!";
		break;*/
		default:
		return FALSE;
		}
		
	}
	
	
}
?>