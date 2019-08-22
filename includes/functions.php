<?php
function getCurrentPageUrl(){
    $protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https')
                    === FALSE ? 'http' : 'https';
    $host     = $_SERVER['HTTP_HOST'];
    $script   = $_SERVER['SCRIPT_NAME'];
    $params   = $_SERVER['QUERY_STRING'];
    $currentUrl = $protocol . '://www.' . $host . $script . '?' . $params;
    
     return $currentUrl;
}

function homedefalutlist(){
	
	$conn=dbconnection();
	 $stmt ="SELECT * FROM `home_categories_top_banner_list` where img_status='0' order by orderby asc";
	 $result=mysqli_query($conn,$stmt);
	
	 $emparray = array();
	while($obj=mysqli_fetch_object($result))
	{
	$emparray[] = $obj;
	}
	$data['allresult'] = $emparray;
	return $data;
	
	
}


/*function sendGridEmail($email_from,$email_to,$cc,$bcc,$subject,$message){
    $url = 'https://api.sendgrid.com/';
    $user = '';
    $pass = '';
    if($cc!='' && $bcc!=''){
        $params = array(
        'api_user'  => $user,
        'api_key'   => $pass,
        'to'        => $email_to,
        'cc'        => $cc,
        'bcc'        => $bcc,
        'subject'   => $subject,
        'html'      => $message,
        'text'      => $message,
        'from'      => $email_from,
      );
    }
    else if($bcc!=''){
        $params = array(
        'api_user'  => $user,
        'api_key'   => $pass,
        'to'        => $email_to,
        'bcc'        => $bcc,
        'subject'   => $subject,
        'html'      => $message,
        'text'      => $message,
        'from'      => $email_from,
      );
    }
    else if($cc!=''){
        $params = array(
        'api_user'  => $user,
        'api_key'   => $pass,
        'to'        => $email_to,
        'cc'        => $cc,
        'subject'   => $subject,
        'html'      => $message,
        'text'      => $message,
        'from'      => $email_from,
      );
    }
    else{
        $params = array(
        'api_user'  => $user,
        'api_key'   => $pass,
        'to'        => $email_to,
        'subject'   => $subject,
        'html'      => $message,
        'text'      => $message,
        'from'      => $email_from,
      );
    }
    $request =  $url.'api/mail.send.json';
    //echo "<pre>";print_r($params); echo "</pre>";
    // Generate curl request
    $session = curl_init($request);
    // Tell curl to use HTTP POST
    curl_setopt ($session, CURLOPT_POST, true);
    // Tell curl that this is the body of the POST
    curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
    // Tell curl not to return headers, but do return the response
    curl_setopt($session, CURLOPT_HEADER, false);
    // Tell PHP not to use SSLv3 (instead opting for TLS)
    curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

    // obtain response
    $response = curl_exec($session);
    curl_close($session);
    //echo "<pre>";print_r($response);echo "</pre>";
    $decode_response=json_decode($response);
    //echo "<pre>";print_r($decode_response);echo "</pre>";
    $messageResponse=$decode_response->message;
    if($messageResponse=="success"){
            //echo "Email Sent"."<br/>";
            return "1";
    }
    else{
        return "0";
    }
}*/


function sendGridEmail($email_from,$email_to,$cc,$bcc,$subject,$message,$headers1){
    $messageResponse = mail($email_to, $subject, $message, $headers1, "-f $email_from");
    if($messageResponse){
            //echo "Email Sent"."<br/>";
            return "1";
    }
    else{
        return "0";
    }
}

function sanitize_parse($string){
   $string = str_replace(array("\r"), ' ', $string);
   $string = str_replace(array("\n"), '', $string);
	$string = stripcslashes($string);
	//$string = preg_replace( "/\r|\n/", " ", $string );
    //$string = strip_tags($string,'<br><br/><br /><a><img><p>');
    return $string;

}

function curPageURL() {
 $pageURL = 'http';
 if (@$_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}
function zoneDateTime($timestamp,$format) {
    $time_zone = 5.5; //for india  5.5
    return $date=gmdate("$format", "$timestamp" + (3600*+($time_zone)));
}
function check_seo_product($seo1){
    ///check in db products table for alias...
//    /if yes return 1 else return 0;
//$seo1 = urldecode($seo1);
		$conn=dbconnection();
	$seo1 = mysqli_real_escape_string($conn,$seo1);
	$seo1 = utf8_urldecode($seo1);

 if ($stmt = $conn->prepare("SELECT `ProductID`, `product_alis_link` FROM `tbl_products`  WHERE product_alis_link = ? ")) {
	// Bind the variables to the parameter as strings.
	$conn->set_charset("utf8");
	$seo1     = mysqli_real_escape_string($conn,$seo1);
    $stmt->bind_param("s", $seo1);
	// Execute the statement.
	$stmt->execute();
	$stmt->store_result();
	$numRows = $stmt->num_rows;
	if($numRows>0){
	$stmt->bind_result($ProductID,$product_alis_link);
		 return 1;
	} else {
		 return 0;
	}
 }

}


function new_product($seo1){
	$conn=dbconnection();
	$seo1 = mysqli_real_escape_string($conn,$seo1);
	$seo1 = utf8_urldecode($seo1);
	$stmt ="SELECT `ProductID`, `Title`, `product_alis_link`,`overalldiscount`,`product_status` FROM `tbl_products`  WHERE Color='$seo1' ";
	$result=mysqli_query($conn,$stmt);
   
	$emparray = array();
   while($obj=mysqli_fetch_object($result))
   {
   $emparray[] = $obj;
   }
   $data['allresult'] = $emparray;
   return $data;
}

function getrecommentedproduct($seo1){
	$conn=dbconnection();
	$seo1 = mysqli_real_escape_string($conn,$seo1);
	$seo1 = utf8_urldecode($seo1);
	$stmt ="SELECT `ProductID`, `Title`, `product_alis_link`,`overalldiscount`,`product_status` FROM `tbl_products`  WHERE cat_id='$seo1' ";
	$result=mysqli_query($conn,$stmt);
   
	$emparray = array();
   while($obj=mysqli_fetch_object($result))
   {
   $emparray[] = $obj;
   }
   $data['allresult'] = $emparray;
   return $data;
}

 function utf8_urldecode($str) {
    $str = preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",urldecode($str));
    return html_entity_decode($str,null,'UTF-8');;
  }
function check_seo_category($seo1){
    ///check in db category table for alias...
    ///if yes return 1 else return 0;

$conn=dbconnection();

 if ($stmt = $conn->prepare("SELECT `category_id`, `category_name`, `cat_alias` FROM `tbl_category`   WHERE cat_alias = ? ")) {
	// Bind the variables to the parameter as strings.
	$seo1     = mysqli_real_escape_string($conn,$seo1);
    $stmt->bind_param("s", $seo1);
	// Execute the statement.
	$stmt->execute();
	$stmt->store_result();
	$numRows = $stmt->num_rows;
	if($numRows>0){
	$stmt->bind_result($category_id,$category_name,$cat_alias);
		 return 1;
	} else {
		 return 0;
	}
 }
}

function check_seo_brands($seo1){
    ///check in db brands table for alias...
    ///if yes return 1 else return 0;
$conn=dbconnection();
 if ($stmt = $conn->prepare("SELECT `id` FROM `tbl_brands`   WHERE brand_alis_name = ? ")) {
	// Bind the variables to the parameter as strings.
	$seo1     = mysqli_real_escape_string($conn,$seo1);
    $stmt->bind_param("s", $seo1);
	// Execute the statement.
	$stmt->execute();
	$stmt->store_result();
	$numRows = $stmt->num_rows;
	if($numRows>0){
	$stmt->bind_result($id);
		 return 1;
	} else {
		 return 0;
	}
 }
}

function getCatId($seo1){

    $conn=dbconnection();

 if ($stmt = $conn->prepare("SELECT `category_id`, `category_name`, `cat_alias` FROM `tbl_category`   WHERE cat_alias = ? order by category_id ASC LIMIT 1 ")) {
	// Bind the variables to the parameter as strings.
	$seo1     = mysqli_real_escape_string($conn,$seo1);
    $stmt->bind_param("s", $seo1);
	// Execute the statement.
	$stmt->execute();
	$stmt->store_result();
	$numRows = $stmt->num_rows;
	if($numRows>0){
	$stmt->bind_result($category_id,$category_name,$cat_alias);
	$rows=[];
	while ($row = $stmt->fetch()) {

		 return $category_id;

	}
	} else {
		 return 0;
	}
 }

}

function getbrandsId($seo1){
    $conn=dbconnection();
 if ($stmt = $conn->prepare("SELECT `id` FROM `tbl_brands`   WHERE brand_alis_name = ? order by id ASC LIMIT 1 ")) {
	// Bind the variables to the parameter as strings.
	$seo1     = mysqli_real_escape_string($conn,$seo1);
    $stmt->bind_param("s", $seo1);
	// Execute the statement.
	$stmt->execute();
	$stmt->store_result();
	$numRows = $stmt->num_rows;
	if($numRows>0){
	$stmt->bind_result($id);
	$rows[''];
	while ($row = $stmt->fetch()) {
		 return $id;
	}
	} else {
		 return 0;	
	}
 }
}

function homeSlider(){
	 $conn=dbconnection();
	 $stmt ="SELECT id,`brand_img`, `brand_img_over`, `brand_alis_name` FROM `tbl_brands` where status=0 ";
	 $result=mysqli_query($conn,$stmt);
	
	 $emparray = array();
	while($obj=mysqli_fetch_object($result))
	{
	$emparray[] = $obj;
	}
	$data['allresult'] = $emparray;
	return $data;
}

function categoryParent($parent, $category_tree_array) {
    $conn=dbconnection();
	$parent = $parent;
    $sqlCategory = "SELECT 	category_id,category_name,parent_id,cat_alias FROM tbl_category WHERE parent_id ='$parent' AND status!='1'  ORDER BY category_id ASC";
	$resCategory=$conn->query($sqlCategory);
	$category_tree_array=array();
    if ($resCategory->num_rows > 0) {
        while($rowCategories = $resCategory->fetch_assoc()) {
            $category_tree_array[] = array("category_id" => $rowCategories['category_id'], "name" =>$rowCategories['category_name'], "cat_alias" =>$rowCategories['cat_alias']);
        }
	}
    return $category_tree_array;
}

function subcategory($parent) {
    $conn=dbconnection();
    $parent = $parent;
    $sqlCategory = "SELECT 	category_id,category_name,parent_id,cat_alias FROM tbl_category WHERE parent_id = $parent  ORDER BY category_id ASC";
    $resCategory=$conn->query($sqlCategory);
    if ($resCategory->num_rows > 0) {
        while($rowCategories = $resCategory->fetch_assoc()) {
            $category_tree_array[] = array("category_id" => $rowCategories['category_id'], "name" =>$rowCategories['category_name'], "cat_alias" =>$rowCategories['cat_alias']);
        }
    }
    return $category_tree_array;
}

function homeMainSlider($catTypesValue){
	 $conn=dbconnection();
	 $stmt ="SELECT `id`, `cat_type_id`, `img`, `descr`, `order_by`, `status`,`title`,`blog_link`,`active_read_more` FROM `main_Home_slider` WHERE status='0'";
	 $result=mysqli_query($conn,$stmt);
	
	 $emparray = array();
	while($obj=mysqli_fetch_object($result))
	{
	$emparray[] = $obj;
	}
	$data['allresult'] = $emparray;
	return $data;
}

function homecarsslider($cat_id){
	$conn=dbconnection();
/*    $catTypesValue="1";
    $parentzero = zeroParentCatId($cat_id);

   if($parentzero=="0"){
		$cat_id = getMainsubcat($cat_id,$catTypesValue);
		foreach($cat_id['subcatids'] as $subs_listingRrows){ 
		$subarray[] = $subs_listingRrows->category_id;
		}
		$cat_id = implode(",",$subarray);
		}else{
		$cat_id = $cat_id;
	}
	
	if(isset($cat_id) && $cat_id!=""){*/
		$cattovalueWhere =" and p.cat_id IN($cat_id)";
	/*}else{
		$cattovalueWhere ="";	
	}*/
    $allBandValsWhere="";
    $allcolorValsWhere="";
    $priceWhere="";
    $query = "SELECT SQL_NO_CACHE p.ProductID,p.Title,p.Description,b.Brand as Brands, jp.Color as Color_val,c.category_id,p.product_alis_link FROM tbl_products p 
	LEFT JOIN ( SELECT id,color FROM tbl_colors WHERE id!='') jp ON p.Color=jp.id 
	LEFT JOIN ( SELECT id,brand FROM tbl_brands WHERE id!='') b ON p.Brand=b.id 
	LEFT JOIN ( SELECT category_id,category_name FROM tbl_category WHERE category_id!='') c ON p.cat_id=c.category_id
	LEFT JOIN ( SELECT productId,price FROM tbl_product_price WHERE id!='') pr ON p.ProductID=pr.productId 
	where p.ProductID!=''  ".$cattovalueWhere." ".$allcolorValsWhere."  ".$allBandValsWhere."  ".$priceWhere." AND `product_status`=0  group by p.ProductID";

	$result=mysqli_query($conn,$query);
    $emparray = array();
	while($obj=mysqli_fetch_object($result))
	{
	$emparray[] = $obj;
	}
	$data['allresult'] = $emparray;
	return $data;
}

function homecarssliderall($cat_id,$parentid){
	$conn=dbconnection();
   
   if($parentid=="0"){
		$cat_id = getMainsubcat($cat_id,$catTypesValue);
		foreach($cat_id['subcatids'] as $subs_listingRrows){ 
		$subarray[] = $subs_listingRrows->category_id;
		}
		$cat_id = implode(",",$subarray);
		}else{
		$cat_id = $cat_id;
	}
	
	if(isset($cat_id) && $cat_id!=""){
		$cattovalueWhere =" and p.cat_id IN($cat_id)";
	}else{
		$cattovalueWhere ="";	
	}
    $allBandValsWhere="";
    $allcolorValsWhere="";
    $priceWhere="";
    $query = "SELECT SQL_NO_CACHE p.ProductID,p.Title,p.Description,b.Brand as Brands, jp.Color as Color_val,c.category_id,p.product_alis_link FROM tbl_products p 
	LEFT JOIN ( SELECT id,color FROM tbl_colors WHERE id!='') jp ON p.Color=jp.id 
	LEFT JOIN ( SELECT id,brand FROM tbl_brands WHERE id!='') b ON p.Brand=b.id 
	LEFT JOIN ( SELECT category_id,category_name FROM tbl_category WHERE category_id!='') c ON p.cat_id=c.category_id
	LEFT JOIN ( SELECT productId,price FROM tbl_product_price WHERE id!='') pr ON p.ProductID=pr.productId 
	where p.ProductID!=''  ".$cattovalueWhere." ".$allcolorValsWhere."  ".$allBandValsWhere."  ".$priceWhere." AND `product_status`=0  group by p.ProductID";

	$result=mysqli_query($conn,$query);
    $emparray = array();
	while($obj=mysqli_fetch_object($result))
	{
	$emparray[] = $obj;
	}
	$data['allresult'] = $emparray;
	return $data;
}


function signglemainCatAlis($catIdas){
	$conn=dbconnection();
	 $stmt ="SELECT cat_alias FROM `tbl_category` WHERE category_id='$catIdas' and status='0'";
	 $result=mysqli_query($conn,$stmt);
	 $obj=mysqli_fetch_array($result);
	 $cat_alias = $obj['cat_alias'];
	 return $cat_alias;
}

function homeDisplayCategories($catType){
	 $conn=dbconnection();
	 $stmt ="SELECT `id`, `categories_id`, `cat_type_id`, `categories_name`,  `cats_status` FROM `home_categories_list` WHERE cat_type_id='$catType' and cats_status='0' order by order_by_id ";
	 $result=mysqli_query($conn,$stmt);
	
	 $emparray = array();
	while($obj=mysqli_fetch_object($result))
	{
	$emparray[] = $obj;
	}
	$data['allresult'] = $emparray;
	return $data;
}

function singleCategoryAlisName($catIds){
	$conn=dbconnection();
	  $stmt ="SELECT cat_alias FROM `tbl_category` where category_id=$catIds";
	 $result=mysqli_query($conn,$stmt);
	 $singleCatRows = mysqli_fetch_array($result);
	 return $singleCatRows['cat_alias'];
}


function sigleProductImageDisplays($productid){
	 $conn=dbconnection();
	 $stmt ="SELECT  `img_link` FROM `tbl_productImg` where img_iden='thumbIMG' AND product_Id='$productid' ";
	 $result=mysqli_query($conn,$stmt);
	 $emparray = array();
	while($obj=mysqli_fetch_object($result))
	{
	$emparray[] = $obj;
	}
	$data['productImg'] = $emparray;
	return $data;
}

function sigleProductPriceDisplays($productid){
	
	$conn=dbconnection();

	$stmt ="SELECT  * FROM `tbl_product_price` where  productId='$productid'  ";
	$result=mysqli_query($conn,$stmt);
	$singleCatRows = mysqli_fetch_array($result);
	return $singleCatRows;

}

function homeCategoriesBannerDisplay($catType,$catIds){
	 $conn=dbconnection();
	 $stmt ="SELECT `id`, `categories_id`, `cat_type_id`, `img_name`, `img_status` FROM `home_categories_top_banner_list` WHERE cat_type_id='$catType' and categories_id='$catIds' and img_status='0' ";
	 $result=mysqli_query($conn,$stmt);
	
	 $emparray = array();
	while($obj=mysqli_fetch_object($result))
	{
	$emparray[] = $obj;
	}
	$data['allresult'] = $emparray;
	return $data;
}

function home_categories_slider_list($categories_id,$catTypesValue){
	 $conn=dbconnection();
	 $stmt ="SELECT `id`, `categories_id`, `cat_type_id`, `img_name`, `img_status` FROM `home_categories_slider_list` WHERE categories_id='$categories_id' and cat_type_id='$catTypesValue' and img_status='0'";
	 $result=mysqli_query($conn,$stmt);
	
	 $emparray = array();
	while($obj=mysqli_fetch_object($result))
	{
	$emparray[] = $obj;
	}
	$data['allresult'] = $emparray;
	return $data;
}

function home_categories_brand_list($catTypesValue,$homeCategoriesId){
	 $conn=dbconnection();
	 
	 $home_page_brand_cat_id = "and (home_page_brand_cat_id like '$homeCategoriesId' or home_page_brand_cat_id like '$homeCategoriesId,%' or home_page_brand_cat_id like '%,$homeCategoriesId' or home_page_brand_cat_id like '%,$homeCategoriesId,%')";
	 if($catTypesValue=="1"){
	  $stmt =" SELECT `id`, `brand_img`, `brand_img_over`, `brand_alis_name`,`home_page_brand_cat_id`, `home_page_brand_cat_id_1`,`status` FROM `tbl_brands` WHERE  cat_type_1='$catTypesValue' and status='0' $home_page_brand_cat_id";
	 }else if($catTypesValue=="2"){
	  $stmt =" SELECT `id`, `brand_img`, `brand_img_over`, `brand_alis_name`,`home_page_brand_cat_id`, `home_page_brand_cat_id_1`,`status`FROM `tbl_brands` WHERE  cat_type_2='$catTypesValue' and status='0' $home_page_brand_cat_id";	
	 }else{
	  $stmt ="SELECT  `id`, `brand_img`, `brand_img_over`, `brand_alis_name`,`home_page_brand_cat_id`, `home_page_brand_cat_id_1`,`status` FROM `tbl_brands` WHERE  cat_type_1='1' and status='0' $home_page_brand_cat_id";
	 }
	 
	 $result=mysqli_query($conn,$stmt);
	 $emparray = array();
	while($obj=mysqli_fetch_object($result))
	{
	$emparray[] = $obj;
	}
	return $emparray;
	
}

function home_categories_blog_list($categories_id,$catTypesValue){
	 $conn=dbconnection();
	 $stmt ="SELECT `img_name`, `blog_name`, `blog_link` FROM `home_categories_blog_list` WHERE categories_id='$categories_id' and cat_type_id='$catTypesValue' and img_status='0'";
	 $result=mysqli_query($conn,$stmt);
	
	 $emparray = array();
	while($obj=mysqli_fetch_object($result))
	{
	$emparray[] = $obj;
	}
	$data['allresult'] = $emparray;
	return $data;
}


function paginateAllCategoryList($reload, $page, $tpages, $adjacents,$search_val,$chek_box_val,$let_search,$type_val,$ids_indst) {
	$prevlabel = "&#60;";
	$nextlabel = "&#62;";
	$out = '<div class="pagin green">';
    $nu_vals="1";
	// previous label
	if($page==1) {
		$out.= "<span>$prevlabel</span>";
	} else if($page==2) {
		//$out.= "<a href='javascript:void(0);' onclick='load(1)'>$prevlabel</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.$nu_vals.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$prevlabel.'</a>';
	}else {
		//$out.= "<a href='javascript:void(0);' onclick='load(".($page-1).")'>$prevlabel</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.($page-1).',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$prevlabel.'</a>';
	}
// first label

	if($page>($adjacents+1)) {
		//$out.= "<a href='javascript:void(0);' onclick='load(1)'>1</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.$nu_vals.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">1</a>';
	}
	// interval
	if($page>($adjacents+2)) {
		$out.= "...\n";
	}
	// pages
	$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
	$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
	for($i=$pmin; $i<=$pmax; $i++) {
		if($i==$page) {
			$out.= "<span class='current'>$i</span>";
		}else if($i==1) {
			//$out.= "<a href='javascript:void(0);' onclick='load(1)'>$i</a>";
			$out.='<a href="javascript:void(0);" onclick='."'".'load('.$nu_vals.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$i.'</a>';
		}else {
			//$out.= "<a href='javascript:void(0);' onclick='load(".$i.")'>$i</a>";
			$out.='<a href="javascript:void(0);" onclick='."'".'load('.$i.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$i.'</a>';
		}
	}

	// interval

if($page<($tpages-$adjacents-1)) {
		$out.= "...\n";
	}
	// last
	if($page<($tpages-$adjacents)) {
		//$out.= "<a href='javascript:void(0);' onclick='load($tpages)'>$tpages</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.$tpages.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$tpages.'</a>';
	}
	// next
	if($page<$tpages) {
		//$out.= "<a href='javascript:void(0);' onclick='load(".($page+1).")'>$nextlabel</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.($page+1).',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$nextlabel.'</a>';
	}else {
		$out.= "<span>$nextlabel</span>";
	}
	$out.= "</div>";
	return $out;
}

function sigleprice($productId){
	$conn=dbconnection();
	if ($stmt = $conn->prepare("SELECT 	id,price FROM tbl_product_price WHERE productId=? ORDER BY id ASC")) {
		// Bind the variables to the parameter as strings. 
		$stmt->bind_param("i", $productId);
		// Execute the statement.
		$stmt->execute();
		$stmt->store_result();
		$numRows = $stmt->num_rows;
		if($numRows>0){
		$stmt->bind_result($id,$price);
		  while ($row = $stmt->fetch()) {
				return $price;
			}
		} else {
		return FALSE;	
	}
}
}

function multiprice($productId,$priceid){
	$conn=dbconnection();
	// $productId="3";
	if($priceid!=""){
		$pricecodi= "and id='$priceid' ";
	}else{
		$pricecodi="";
	}
	$quy = "SELECT id,price,weight,discount_percentage,discount_amount FROM tbl_product_price WHERE productId='$productId' ".$pricecodi." ORDER BY id ASC";
	$result=mysqli_query($conn,$quy);
	
	 $emparray = array();
	while($obj=mysqli_fetch_object($result))
	{
	$emparray[] = $obj;
	}
	$data['pricelist'] = $emparray;
//	print_r($data);
	return $data;

}




function getDiscounts($productId){
	$conn=dbconnection();
	if ($stmt = $conn->prepare("SELECT id,discount_amount,discount_percentage FROM tbl_product_price WHERE productId=? ORDER BY id ASC")) {
		// Bind the variables to the parameter as strings.
		$stmt->bind_param("i", $productId);
		// Execute the statement.
		$stmt->execute();
		$stmt->store_result();
		$numRows = $stmt->num_rows;
		$discount_details=array();
		if($numRows>0){
			$stmt->bind_result($id,$discount_amount,$discount_percentage);
			while ($row = $stmt->fetch()) {
				$discount_details['discount_amount']=$discount_amount;
				$discount_details['discount_percentage']=$discount_percentage;
				return $discount_details;
			}
		} else {
			return $discount_details;
		}
	}
}

function sigleImg($productId){
	$conn=dbconnection();
	if ($stmt = $conn->prepare("SELECT  `img_link` FROM `tbl_productImg` WHERE  product_Id=? ORDER BY id ASC LIMIT 1")) {
		// Bind the variables to the parameter as strings. 
		$stmt->bind_param("i", $productId);
		// Execute the statement.
		$stmt->execute();
		$stmt->store_result();
		$numRows = $stmt->num_rows;
		if($numRows>0){
		$stmt->bind_result($img_link);
		  while ($row = $stmt->fetch()) {
				return $img_link;
			}
		} else {
		return FALSE;	
	}
}
}
/* single image thunmbnail */
function sigleImgThumb($productId){
		$conn=dbconnection();
		$stmt = $conn->prepare("SELECT  `img_link` FROM `tbl_productImg` WHERE img_iden=? AND product_Id=? ORDER BY id ASC LIMIT 1");
		$img_iden="MainIMG";
		// Bind the variables to the parameter as strings. 
		$stmt->bind_param("si",$img_iden,$productId);
		// Execute the statement.
		$stmt->execute();
		$stmt->store_result();
		$numRows = $stmt->num_rows;
		if($numRows>0){
		$stmt->bind_result($img_link);
		  while ($row = $stmt->fetch()) {
				return $img_link;
			}
		}
		else
		{
			$stmt = $conn->prepare("SELECT  `img_link` FROM `tbl_productImg` WHERE img_iden=? AND product_Id=? ORDER BY id ASC LIMIT 1");
			// Bind the variables to the parameter as strings. 
			$img_iden="thumbIMG";
			$stmt->bind_param("si",$img_iden,$productId);
			// Execute the statement.
			$stmt->execute();
			$stmt->store_result();
			$numRows = $stmt->num_rows;
				if($numRows>0){
			$stmt->bind_result($img_link);
			  while ($row = $stmt->fetch()) {
					return $img_link;
				}
			}
			else {
					return FALSE;	
				}
		}
		
}
/* single image thumbnail ends here */
function productname($productId){
	$conn=dbconnection();
	if ($stmt = $conn->prepare("SELECT  `Title`,`product_alis_link` FROM `tbl_products` WHERE  ProductID=? ORDER BY ProductID ASC LIMIT 1")) {
		// Bind the variables to the parameter as strings. 
        mysqli_set_charset($conn,"utf8");
        $stmt->bind_param("i", $productId);
		// Execute the statement.
		$stmt->execute();
		$stmt->store_result();
		$numRows = $stmt->num_rows;
		if($numRows>0){
		$stmt->bind_result($Title,$product_alis_link);
		$emparray = array();
		  while ($row = $stmt->fetch()) {
		  	$emparray['Title'] = $Title;
		  	$emparray['product_alis_link'] = $product_alis_link;
			}
			return $emparray;
		} else {
		return FALSE;	
	}
}
}


function filterBrandList($cat_id,$leftsideSearchwhereCase){
	
	 $conn=dbconnection();
	// $stmt ="SELECT b.brand as bra,b.id as brandid, count(p.ProductID) as cnt FROM tbl_brands b left outer join tbl_products p on b.id = p.Brand where  p.cat_id='$cat_id' ".$leftsideSearchwhereCase." GROUP BY b.id ORDER BY b.brand ASC";
	 $stmt ="SELECT b.brand as bra,b.id as brandid, count(p.ProductID) as cnt FROM tbl_brands b left outer join tbl_products p on b.id = p.Brand where  p.cat_id IN($cat_id) GROUP BY b.id ORDER BY b.brand ASC";
	 $result=mysqli_query($conn,$stmt);
	
	 $emparray = array();
	while($obj=mysqli_fetch_object($result))
	{
	$emparray[] = $obj;
	}
	$data['allresult'] = $emparray;
	return $data;
	
}

function filterColorList($cat_id,$leftsideSearchwhereCase){
	
	 $conn=dbconnection();
	// $stmt ="SELECT c.color as clr,c.id as colorid, count(p.ProductID) as cnt FROM tbl_colors c left outer join tbl_products p on c.id = p.Color where  p.cat_id='$cat_id' ".$leftsideSearchwhereCase." GROUP BY c.id ORDER BY c.color ASC";
	  $stmt ="SELECT c.color as clr,c.id as colorid, count(p.ProductID) as cnt FROM tbl_colors c left outer join tbl_products p on c.id = p.Color where  p.cat_id IN($cat_id)  GROUP BY c.id ORDER BY c.color ASC";
	 $result=mysqli_query($conn,$stmt);
	
	 $emparray = array();
	while($obj=mysqli_fetch_object($result))
	{
	$emparray[] = $obj;
	}
	$data['allresult'] = $emparray;
	return $data;
	
}

function filterbrandColorList($brand_id,$parentzero,$cat_id){
	
	if($parentzero=="0"){
		$wherebandsvalues = "";
	 	$wherebandsvalues = "p.Brand IN($brand_id)";
	 	$wherecatvalues = "and p.cat_id IN($cat_id)";
	 }else{
	 	$wherebandsvalues = "p.Brand IN($brand_id)";
	 	$wherecatvalues = "";
	 }
	 $conn=dbconnection();
	// $stmt ="SELECT c.color as clr,c.id as colorid, count(p.ProductID) as cnt FROM tbl_colors c left outer join tbl_products p on c.id = p.Color where  p.cat_id='$cat_id' ".$leftsideSearchwhereCase." GROUP BY c.id ORDER BY c.color ASC";
	  $stmt ="SELECT c.color as clr,c.id as colorid, count(p.ProductID) as cnt FROM tbl_colors c left outer join tbl_products p on c.id = p.Color where ".$wherebandsvalues." ".$wherecatvalues."  GROUP BY c.id ORDER BY c.color ASC";
	 $result=mysqli_query($conn,$stmt);
	
	 $emparray = array();
	while($obj=mysqli_fetch_object($result))
	{
	$emparray[] = $obj;
	}
	$data['allresult'] = $emparray;
	return $data;
	
}

function zeroParentCatId($catId){
	 $conn=dbconnection();
	 $stmt ="SELECT  `parent_id` FROM `tbl_category` WHERE   category_id='$catId'";
	 $result=mysqli_query($conn,$stmt);
	 $obj=mysqli_fetch_object($result);
	 $parent_id = $obj->parent_id;
	 return $parent_id;
}


function getMainsubcat($cat_id,$catTypesValue){
	 $conn=dbconnection();
	 $stmt ="SELECT  `category_id` FROM `tbl_category` WHERE   parent_id='$cat_id'";
	 $result=mysqli_query($conn,$stmt);
	 $emparray = array();
	while($obj=mysqli_fetch_object($result))
	{
	$emparray[] = $obj;
	}
	$data['subcatids'] = $emparray;
	return $data;
}

function filterCategoryList($cat_id,$parentzero){
	 $conn=dbconnection();
	// $stmt ="SELECT c.category_name as ctname,c.category_id as category_id, count(p.ProductID) as cnt FROM tbl_category c left outer join tbl_products p on c.category_id = p.cat_id where  p.cat_id='$cat_id' GROUP BY c.category_name ORDER BY c.category_name ASC";
	if($parentzero=="0"){
		$wherecatvalues = "p.cat_id IN($cat_id)";
	}else{
		$wherecatvalues = "p.cat_id!=''";
	}
	 
	 $stmt ="SELECT c.category_name as ctname,c.cat_alias as catalias,c.category_id as category_id, count(p.ProductID) as cnt FROM tbl_category c left outer join tbl_products p on c.category_id = p.cat_id where  ".$wherecatvalues." GROUP BY c.category_name,c.cat_alias,c.category_id ORDER BY c.category_name ASC";
	 
	 $result=mysqli_query($conn,$stmt);
	
	 $emparray = array();
	while($obj=mysqli_fetch_object($result))
	{
	$emparray[] = $obj;
	}
	$data['allresult'] = $emparray;
	return $data;
}

function filtergiftCategoryList($cat_id,$parentzero){
	 $conn=dbconnection();
	// $stmt ="SELECT c.category_name as ctname,c.category_id as category_id, count(p.ProductID) as cnt FROM tbl_category c left outer join tbl_products p on c.category_id = p.cat_id where  p.cat_id='$cat_id' GROUP BY c.category_name ORDER BY c.category_name ASC";
	if($parentzero=="0"){
		$wherecatvalues = "p.cat_id IN($cat_id)";
	}else{
		$wherecatvalues = "p.cat_id!=''";
	}
	 
	 $stmt ="SELECT c.category_name as ctname,c.cat_alias as catalias,c.category_id as category_id, count(p.ProductID) as cnt FROM tbl_category c left outer join tbl_products p on c.category_id = p.cat_id where  ".$wherecatvalues." GROUP BY c.category_name ORDER BY c.category_name ASC";
	 
	 $result=mysqli_query($conn,$stmt);
	
	 $emparray = array();
	while($obj=mysqli_fetch_object($result))
	{
	$emparray[] = $obj;
	}
	$data['allresult'] = $emparray;
	return $data;
}

function filterBrandcatsList($brand_id,$parentzero,$cat_id){
	 $conn=dbconnection();
	 if($parentzero=="0"){
	 	$wherebandsvalues = "p.Brand IN($brand_id)";
	 	$wherecatvalues = "and p.cat_id IN($cat_id)";
	 }else{
	 	$wherebandsvalues = "p.Brand IN($brand_id)";
	 	$wherecatvalues="";
	 }
	  
	 $stmt ="SELECT c.category_name as ctname,c.cat_alias as catalias,c.category_id as category_id, count(p.ProductID) as cnt FROM tbl_category c left outer join tbl_products p on c.category_id = p.cat_id where ".$wherebandsvalues." ".$wherecatvalues." GROUP BY c.category_name,c.cat_alias,c.category_id ORDER BY c.category_name ASC";
	 
	 $result=mysqli_query($conn,$stmt);
	
	 $emparray = array();
	while($obj=mysqli_fetch_object($result))
	{
	$emparray[] = $obj;
	}
	$data['allresult'] = $emparray;
	return $data;
	
}

function filterbrandtopList($brand_id,$parentzero,$cat_id){
	 $conn=dbconnection();
	// $stmt ="SELECT c.category_name as ctname,c.category_id as category_id, count(p.ProductID) as cnt FROM tbl_category c left outer join tbl_products p on c.category_id = p.cat_id where  p.cat_id='$cat_id' GROUP BY c.category_name ORDER BY c.category_name ASC";
	if($parentzero=="0"){
	 	$wherebandsvalues = "";
	 	$wherecatvalues = "p.cat_id IN($cat_id)";
	 }else{
	 	$wherebandsvalues = "p.Brand IN($brand_id)";
	 	$wherecatvalues ="";
	 }
	 
	 $stmt ="SELECT c.brand as bdname,c.brand_alis_name as brandalias,c.id as brandid, count(p.ProductID) as cnt FROM tbl_brands c left outer join tbl_products p on c.id = p.Brand where  ".$wherecatvalues." ".$wherebandsvalues." GROUP BY c.brand,c.brand_alis_name,c.id ORDER BY c.brand ASC";
	 
	 $result=mysqli_query($conn,$stmt);
	
	 $emparray = array();
	while($obj=mysqli_fetch_object($result))
	{
	$emparray[] = $obj;
	}
	$data['allresult'] = $emparray;
	return $data;
}

function productInsertbrand($catTypesValue,$homeCategoriesId){
	$parentzero = zeroParentCatId($homeCategoriesId);
	if($parentzero=="0"){
	    $cat_id = getMainsubcat($homeCategoriesId,$catTypesValue);
		foreach($cat_id['subcatids'] as $subs_listingRrows){ 
			$subarray[] = $subs_listingRrows->category_id;
			$cat_id = implode(",",$subarray);
		}
	}
	 $conn=dbconnection();
	$wherecatvalues = "p.cat_id IN($cat_id)";
	  $stmt ="SELECT  c.brand_img as img,c.brand_alis_name as brandalias,c.id as brandid, count(p.ProductID) as cnt FROM tbl_brands c left outer join tbl_products p on c.id = p.Brand where  ".$wherecatvalues." GROUP BY c.brand_img,c.brand_alis_name,c.id ORDER BY c.brand ASC";
	 $result=mysqli_query($conn,$stmt);
	 $emparray = array();
	while($obj=mysqli_fetch_object($result))
	{
	$emparray[] = $obj;
	}
	return $emparray;
}



function loginAndRegisterDesign(){
	
echo '<!--<div class="container">

<h1 class="text-center">Modal Login with jQuery Effects</h1>
<p class="text-center"><a href="#" class="btn btn-primary btn-lg" role="button" data-toggle="modal" data-target="#login-modal">Open Login Modal</a></p>
</div>
</div>-->
<!-- END # BOOTSNIP INFO -->

<!-- BEGIN # MODAL LOGIN -->
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header" align="center">
		<!--<img class="img-circle" id="img_logo" src="http://bootsnipp.com/img/logo.jpg">-->
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
		</button>
	</div>
    
    <!-- Begin # DIV Form -->
    <div id="div-forms">
    
        <!-- Begin # Login Form -->
        <form id="login-form">
            <div class="modal-body">
	    		<div id="div-login-msg">
                    <span id="text-login-msg"></span>
                </div>
	    		<input id="login_username" name="login_username" class="form-control" type="text" placeholder="Username" >
	    		<input id="login_password" name="login_password" class="form-control" type="password" placeholder="Password" >
                <div class="checkbox">
                    <label>
                        <input type="checkbox"> Remember me
                    </label>
                </div>
    	</div>
	        <div class="modal-footer">
                <div>
                    <button type="button" class="btn btn-primary btn-lg btn-block" id="Logins" name="Logins">Login</button>
                </div>
	    	    <div>
                    <button id="login_lost_btn"  type="button" class="btn btn-link" onclick="lostFun()";>Lost Password?</button>
                    <button id="login_register_btn" type="button" class="btn btn-link" onclick="RegisterFun()";>New to fdsf? Sign-up now!</button>
                </div>
	        </div>
        </form>
        <!-- End # Login Form -->
        
        <!-- Begin | Lost Password Form -->
        <form id="lost-form" style="display:none;">
    <div class="modal-body">
			<div id="div-lost-msg">
                    
                    <span id="text-lost-msg"></span>
                </div>
			<input id="lost_email" class="form-control" type="text" required>
		</div>
	    <div class="modal-footer">
                <div>
                    <button type="button" class="btn btn-primary btn-lg btn-block" onclick="forgetPassword();">Send</button>
                </div>
                <div>
                    <button id="lost_login_btn" type="button" class="btn btn-link"  onclick="loginFun()";>Sign In</button>
                    <button id="lost_register_btn" type="button" class="btn btn-link" onclick="RegisterFun()";>New to fdfds? Sign-up now!</button>
                </div>
	    </div>
        </form>
        <!-- End | Lost Password Form -->
        
        <!-- Begin | Register Form -->
        <form id="register-form" style="display:none;">
	    <div class="modal-body">
			<!--<div id="div-register-msg">
                    <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
                      <span id="text-register-msg"></span>
                </div> -->
                <input id="r_email" class="form-control" type="text" placeholder="E-mail" required type="text" name="r_email" onBlur="r_checkseekeremail();" >
                <span id="r_err_mail" class="error" style="font-color:#E10707;margin-top:15px; float:left; "></span>
                <input id="r_ph_no"  class="form-control" type="text" placeholder="Mobile"  style="float:left;" maxlength="10" name="r_ph_no">
                 <span id="r_err_ph_no" class="error" style="font-color:#E10707;  margin-top:20px; float:left; "></span>
                <input id="r_password" class="form-control" type="password" name="r_password" placeholder="Password"  style="font-color:#E10707;margin-bottom: 15px;
    margin-top: 15px; float:left; ">
                 <span id="r_err_password" class="error" style="font-color:#E10707; font-size:10px; margin-top:20px; float:left; "></span>
                 <input id="r_con_password"  class="form-control" type="password" name="r_con_password" placeholder="Cofirm Password" >
                 <span id="r_err_Confirm" class="error" style="font-color:#E10707; margin-top:20px; float:left; "></span>
                <!--<input id="mobile" name="mobile" class="form-control" type="text" placeholder="Mobile" required>-->
                <!--<input id="register_password" name="register_password" class="form-control" type="password" placeholder="Password" required>-->
		</div>
	    <div class="modal-footer">
                <div>
                    <button type="button" class="btn btn-primary btn-lg btn-block" onclick="pageregister();">New to sudu mandapam? Sign-up now!</button>
                </div>
                <div>
                    <button id="register_login_btn" type="button" class="btn btn-link"  onclick="loginFun()"; >Sign In</button>
                    <button id="register_lost_btn" type="button" class="btn btn-link"  onclick="lostFun()";>Lost Password?</button>
                </div>
	    </div>
        </form>
        <!-- End | Register Form -->
        
    
    <!-- End # DIV Form -->';
}
function forgetPasswordDesign(){
	echo '
    <div class="col-md-6 col-md-offset-3">
     <div class="login_register_class">Forget Password : </div>
     <form style="display: block;" id="lost-form">
    <div class="modal-body">
			<div id="div-lost-msg" style="border:0px solid #fff;">
                    
                    <span id="text-lost-msg"></span>
                </div>
			<input type="text" required="" placeholder="Enter your E-mail" class="form-control" id="lost_email">
		</div>
	    <div class="modal-footer">
                <div>
                    <button onclick="forgetPassword();" class="btn btn-primary btn-lg btn-block" type="button">Send</button>
                </div>
                <div>
                    <a href='.SITE_URL.'login/> <button class="btn btn-link" type="button" >Sign In</button></a>
                   <a href='.SITE_URL.'registration/> <button class="btn btn-link" type="button" >New to sudu mandapam? Sign-up now!</button></a>
                </div>
	    </div>
        </form></div>';
}
function registerationdesign(){
	echo '
    <div class="col-md-6 col-md-offset-3">
     <div class="login_register_class register_class">Registration : </div>
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
  				<label for="checkterms" style="font-color:#E10707;" > I agree<a href='.SITE_URL.'terms-and-conditions/> Terms &amp; Conditions </a></label>
  				<br/>
  				<span style="font-color:#E10707; margin-top:0px; float:left; " class="error" id="r_err_terms"></span>
		</div>
	    <div class="modal-footer">
                <div>
                    <button onclick="pageregister();" class="btn btn-primary btn-lg btn-block" type="button">Register</button>
                </div>
                <div>
                     <a href='.SITE_URL.'login/><button class="btn btn-link" type="button" >Sign In</button></a>
                    <a href='.SITE_URL.'forgetpassword/><button  class="btn btn-link" type="button">Lost Password?</button></a>
                </div>
	    </div>
        </form></div>';
}

function logindesign(){
    if(isset($_REQUEST['isFromReview']))
	    $is_review= $_REQUEST['isFromReview'];
    else
        $is_review= "0";
	/*if(isset($_REQUEST['product_id']))
	    $product_id= $_REQUEST['product_id'];
    else
        $product_id= "0";*/
	if(isset($_REQUEST['pro_alis_link']))
	    $pro_alis_link= $_REQUEST['pro_alis_link'];
    else
        $pro_alis_link= "";
	$twitter_url=SITE_URL."login-with-twitter/?type=twitter";
    $text="window.open('".$twitter_url."','windowname1', 'width = 600, height = 500')";
	
 echo '
    <div class="col-md-6 col-md-offset-3">
     <div class="login_register_class">Login : </div>
     <form id="login-form">
            <div class="modal-body">
	    		<div id="div-login-msg"  style="border:0px solid #fff;">
                    <span id="text-login-msg"></span>
                </div>
                <input type="hidden"  value='.$is_review.' class="form-control" name="hdn_isReview" id="hdn_isReview">
                <input type="hidden"  value="'.$pro_alis_link.'" class="form-control" name="hdn_product_id" id="hdn_product_id">

	    		<input type="text" placeholder="E-mail" class="form-control" name="login_username" id="login_username">
	    		<input type="password" placeholder="Password" class="form-control" name="login_password" id="login_password">
               <!-- <div class="checkbox">
                    <label>
                        <input type="checkbox"> Remember me
                    </label>
                </div> -->
    	</div>
	        <div class="modal-footer">
                <div>
                    <button name="Logins" id="Logins" class="btn btn-primary btn-lg btn-block" type="button">Login</button>
                </div>
	    	    <div>
                    <a href='.SITE_URL.'forgetpassword/><button class="btn btn-link" type="button">Lost Password?</button></a>
                      <a href='.SITE_URL.'registration/><button class="btn btn-link" type="button" id="login_register_btn">New to sudu mandapam? Sign-up now!</button></a>
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
}

function login(){
	$conn=dbconnection();
	if ($stmt = $conn->prepare("SELECT id,user_name,email FROM  hm_users WHERE email = ? and password = ?")) {
		// Bind the variables to the parameter as strings. 
		 $name     = mysqli_real_escape_string($conn,$_POST['username']);
	     $password = mysqli_real_escape_string($conn,$_POST['password']);
	    $password = md5($password);
		$stmt->bind_param("ss", $name, $password);
		// Execute the statement.
		$stmt->execute();
		$stmt->store_result();
		$numRows = $stmt->num_rows;
		if($numRows>0){
		$stmt->bind_result($id,$userName,$resultEmail);
		  $rows=[];
			while ($row = $stmt->fetch()) {
				$_SESSION['userid'] 	    = $id;
				 $_SESSION['userName']    	= $userName;
				$_SESSION['resultEmail'] 	= $resultEmail;
				return "1";	
			}	
		} else {
		return "0";	
		}
	} 
$stmt->close();
$conn->close();
}

function emailExist(){
	$conn=dbconnection();
	if ($stmt = $conn->prepare("SELECT id FROM  hm_users WHERE email = ?")) {
		// Bind the variables to the parameter as strings. 
		$st_email     = mysqli_real_escape_string($conn,$_POST['email']);
	   
		$stmt->bind_param("s", $st_email);
		// Execute the statement.
		$stmt->execute();
		$stmt->store_result();
		$numRows = $stmt->num_rows;
		if($numRows>0){
		$stmt->bind_result($id);
		  $rows[''];
			while ($row = $stmt->fetch()) {
				$_SESSION['userid'] 	    = $id;
				echo  "1";	
			}	
		} else {
		return "0";	
		}
	} 
$stmt->close();
$conn->close();
}

/*function register(){
	$conn=dbconnection();
	$userType="2";
	$current_date =  date("Y-m-d h:i:s");
	$userName              = mysqli_real_escape_string($conn,$_POST['userName']);
	$register_email        = mysqli_real_escape_string($conn,$_POST['register_email']);
	$register_password     = md5(mysqli_real_escape_string($conn,$_POST['register_password']));
	$Con_password          = md5(mysqli_real_escape_string($conn,$_POST['Con_password']));
	$Ph_no                 = mysqli_real_escape_string($conn,$_POST['Ph_no']);
	if ($stmt = $conn->prepare("SELECT id FROM  hm_users WHERE email = ?")) {
		// Bind the variables to the parameter as strings. 
		$stmt->bind_param("s", $register_email);
		// Execute the statement.
		$stmt->execute();
		$stmt->store_result();
		$numRows = $stmt->num_rows;
		if($numRows>0){
		$stmt->bind_result($id);
		  $rows[''];
			while ($row = $stmt->fetch()) {
				$_SESSION['userid'] 	    = $id;
				return "3";	
				exit;
			}	
		} 
	}
	 $stmtQaf = "INSERT INTO hm_users (`user_name`, `email`,`password`, confirmpassword,phone_number,mobile) VALUES ('$userName', '$register_email', '$register_password','$register_password','$Ph_no','$Ph_no')";
	  $result=mysqli_query($conn,$stmtQaf);
	 $id = mysqli_insert_id($conn); 
	  if($result=="1"){
		$_SESSION['userid'] 	    = $id;
		$_SESSION['userName']    	= $userName;
		$_SESSION['resultEmail'] 	= $register_email;
			echo "1";
	  }else{
	  	echo "0";
	  }

	$conn->close();
	
}*/

function register(){
    $conn=dbconnection();
    $userType="2";
    $current_date =  date("Y-m-d h:i:s");
    $userName              = mysqli_real_escape_string($conn,$_POST['userName']);
    $register_email        = mysqli_real_escape_string($conn,$_POST['register_email']);
    $register_password     = md5(mysqli_real_escape_string($conn,$_POST['register_password']));
    $Con_password          = md5(mysqli_real_escape_string($conn,$_POST['Con_password']));
    $Ph_no                 = mysqli_real_escape_string($conn,$_POST['Ph_no']);
    $terms                    = mysqli_real_escape_string($conn,$_POST['terms']);
	if ($stmt = $conn->prepare("SELECT id FROM  hm_users WHERE email = ?")) {
        // Bind the variables to the parameter as strings. 
        $stmt->bind_param("s", $register_email);
        // Execute the statement.
        $stmt->execute();
        $stmt->store_result();
        $numRows = $stmt->num_rows;
        if($numRows>0){
        $stmt->bind_result($id);
          $rows[''];
            while ($row = $stmt->fetch()) {
                $_SESSION['userid']         = $id;
                return "3";    
                exit;
            }    
        } 
    }
     $stmtQaf = "INSERT INTO hm_users (`user_name`, `email`,`password`, confirmpassword,accepted_terms,phone_number,mobile,created_on) VALUES ('$userName', '$register_email', '$register_password','$register_password','$terms','$Ph_no','$Ph_no','$current_date')";
      $result=mysqli_query($conn,$stmtQaf);
     $id = mysqli_insert_id($conn); 
      if($result=="1"){
        $_SESSION['userid']         = $id;
        $_SESSION['userName']        = $userName;
        $_SESSION['resultEmail']     = $register_email;
		  $subject = "Welcome to spsbrands.com";
		  $message = "
		<html>
		<head>
			<title>Registration successful with spsbrands.com</title>
				</head>
				<body>
				<table>
				<tr><td>Dear ".$userName .", </td></tr>
				<br><br>
				<tr>
				<tr><td>Welcome to spsbrands.com </td></tr>
				<br><br>
				<tr>
				<td>You have been successfully registered with spsbrands.com To access further please login with below user name.</td>
				</tr>
				<br><br>
				<tr>
				<td>User Name : ".$register_email."</td>
				</tr>
				<br><br>
				
				</table>
				</body>
				</html>
				";

		  
		  $to = $register_email;
		  $from = 'spsbrands.com@gmail.com';
		  $headers1 = "From: spsbrands.com Newsletter <$from>\n";
		  $headers1 .= "Content-type: text/html;charset=iso-8859-1\r\n";
		  $headers1 .= "X-Priority: 1\r\n";
		  $headers1 .= "X-MSMail-Priority: High\r\n";
		  $headers1 .= "X-Mailer: Contact request\r\n";
		  sendGridEmail($from,$to,$cc,$bcc,$subject,$message,$headers1);
		
		 // if ($sentmail)
		  echo "1";
		  /*else
			  echo "2";*/
      }else{
          echo "0";
      }

    $conn->close();
    
}

function loginStatus(){
	
	if (isset($_SESSION['userid']) && $_SESSION['userid'] !="" && isset($_SESSION['resultEmail']) &&  $_SESSION['resultEmail']!=""  ) {
		    $emparray = array();
			$emparray['id']          = $_SESSION['userid'];
			$emparray['userName']    = $_SESSION['userName'];
			$emparray['resultEmail'] = $_SESSION['resultEmail'];
			return $_SESSION;
			
		}else{
		    return "EmptySession";
		}
		
}

function logout(){

// Unset all of the session variables.
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_unset();
// Finally, destroy the session.
session_destroy();
$redirecturl="location:".SITE_URL."";
header($redirecturl);

}
function cart(){
	echo "cart content";
}

function sigleProduct($productId){
	$conn=dbconnection();
	if ($stmt = $conn->prepare("SELECT `ProductID`, `product_alis_link`, `Title`, `Description`, `Brand`, `Color`, `cat_id`, `cat_type_id` FROM `tbl_products` where ProductID=? limit 1")) {
		// Bind the variables to the parameter as strings. 
		 $productId = mysqli_real_escape_string($conn,$productId);

		$stmt->bind_param("i", $productId);
		// Execute the statement.
		$stmt->execute();
		$stmt->store_result();
		$numRows = $stmt->num_rows;
		
		if($numRows>0){
			
	$stmt->bind_result($ProductID,$product_alis_link,$Title,$Description,$Brand,$Color,$cat_type_id);
	$row = $stmt->fetch();
	$singleProducts = array();
	$singleProducts['ProductID'] = $ProductID;
	$singleProducts['product_alis_link'] = $product_alis_link;
	$singleProducts['Title'] = $Title;
	$singleProducts['Description'] = $Description;
	$singleProducts['Brand'] = $Brand;
	$singleProducts['Color'] = $Color;
	$singleProducts['cat_type_id'] = $cat_type_id;
	return $singleProducts;
	
		}
   }
}

function productCartIdentification($productId,$cartSessionId){
	$conn=dbconnection();
	if ($stmt = $conn->prepare("SELECT `ProductID` FROM `tbl_cart` where productId=? and cartsessid=? limit 1")) {
		// Bind the variables to the parameter as strings. 
		 $productId = mysqli_real_escape_string($conn,$productId);
		$stmt->bind_param("is", $productId,$cartSessionId);
		// Execute the statement.
		$stmt->execute();
		$stmt->store_result();
		$numRows = $stmt->num_rows;
		if($numRows>0){
		$stmt->bind_result($ProductID);
		$row = $stmt->fetch();
		$ProductID;
		return $numRows;
		}else{
		echo "0";
		}
   }
}

function productCartIdentificationAllPages($cartSessionId){
	return totalQuty($cartSessionId);
}

function Quty($productId,$cartSessionId){
	$conn=dbconnection();
	if ($stmt = $conn->prepare("SELECT  `quantity` FROM `tbl_cart` WHERE productId=? and cartsessid=? limit 1")) {
		// Bind the variables to the parameter as strings. 
		$stmt->bind_param("is", $productId,$cartSessionId);
		// Execute the statement.
		$stmt->execute();
		$stmt->store_result();
		$numRows = $stmt->num_rows;
		if($numRows>0){
		$stmt->bind_result($quantity);
		  while ($row = $stmt->fetch()) {
				return $quantity;
			}
		} else {
		return FALSE;	
	}
}
}

function viewCart(){
	$conn=dbconnection();
	$cartSessionId = $_SESSION['cartSessionId'];
	$stmt = "SELECT `id`, `productId`, `ProductPrice`,weight, `productImg`, `quantity`,`userid` FROM `tbl_cart` where cartsessid='$cartSessionId' ";
		// Bind the variables to the parameter as strings. 
	$result=mysqli_query($conn,$stmt);
	$row_cnt = mysqli_num_rows($result);
	
	if($row_cnt>0){
	 $emparray = array();
	while($obj=mysqli_fetch_object($result))
	{
	$emparray[] = $obj;
	}
	$data['allresult'] = $emparray;
	return $data;
	}else{
		return "0";
	}
}

function totalQuty($cartSessionId){
	$conn=dbconnection();
	if ($stmt = $conn->prepare("SELECT  `quantity` FROM `tbl_cart` WHERE cartsessid=?")) {
		// Bind the variables to the parameter as strings. 
		$stmt->bind_param("s", $cartSessionId);
		// Execute the statement.
		$stmt->execute();
		$stmt->store_result();
		$numRows = $stmt->num_rows;
		if($numRows>0){
		$stmt->bind_result($quantity);
		$total = 0; //set initial total value
		  while ($row = $stmt->fetch()) {
		  	$total = $total + $quantity; //add subtotal to total var 
			}
			return $numRows;
		} else {
		return FALSE;	
	}
}
}

function addToCart(){
	    $conn=dbconnection();
		$productId   = $_POST['productId'];
		$Quts        = $_POST['qut'];
		$priceid     = $_POST['priceid'];
	    $multiprice  = multiprice($productId,$priceid);
	    $priceobj    = $multiprice['pricelist'];
	    $price       = $priceobj['0']->price;
	    $weight      = $priceobj['0']->weight;
	    $sigleImg    = sigleImg($productId);
	    $status="1";
		if(!isset($_SESSION['cartSessionId'])&& $_SESSION['cartSessionId']==""){
			$oldid = session_id();
			$cartSessionId = uniqid(date('YmdHis')).$oldid; 
			// Cart Session Set.
			$_SESSION['cartSessionId']=$cartSessionId;
		}else{
			$cartSessionId = $_SESSION['cartSessionId'];
		}	
		$orderId ="";
		$current_date =  date("Y-m-d");
		if(!empty($_POST['qut'])){
			$qut=$Quts;	
		}else{
			$qut = Quty($productId,$cartSessionId);
			if(isset($qut) && $qut!=""){
				$qut=$qut+1;
			}else{
				$qut="1";
			}
		}
		
		
		$numRowsProducts = productCartIdentification($productId,$cartSessionId);
		if($numRowsProducts>0){
		$stmt = $conn->prepare("UPDATE tbl_cart SET quantity=? WHERE productId=? and cartsessid=? ");
		//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
		$stmt->bind_param('iis',$qut,$productId,$cartSessionId);
		}else{
		$stmt = $conn->prepare("INSERT INTO tbl_cart ( `productId`,`weight`, `ProductPrice`, `productImg`, `quantity`, `productStatus`, `orderId`,`cartsessid`,`insertDate`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("isisiisss", $productId,$weight,$price, $sigleImg,$qut,$status,$orderId,$cartSessionId,$current_date);	
		}
		$results = $stmt->execute();
		if($results){
			echo totalQuty($cartSessionId);
			}else { 
			//echo "0"; 
			}
		$conn->close();
}

function DeleteCartProduct(){
	if(isset($_POST['cartId'])&& isset($_SESSION['cartSessionId'])){
		$conn=dbconnection();
		$cartId = $_POST['cartId'];
		$cartSessionId = $_SESSION['cartSessionId'];
		$stmt = $conn->prepare("delete from tbl_cart WHERE productId=? and cartsessid=? ");
		//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
		$stmt->bind_param('is',$cartId,$cartSessionId);
		$results = $stmt->execute();
		if($results){ echo "1";} else {echo "0";}
	}
}


function checkout(){
	echo "checkout content";
}
function forgetPassword(){
	
	$lost_email = $_POST['username'];
	$conn=dbconnection();
	if ($stmt = $conn->prepare("SELECT id FROM  hm_users WHERE email = ?")) {
		// Bind the variables to the parameter as strings. 
		 $st_email     = mysqli_real_escape_string($conn,$lost_email);

		$stmt->bind_param("s", $st_email);
		// Execute the statement.
		$stmt->execute();
		$stmt->store_result();
		$numRows = $stmt->num_rows;
		if($numRows>0){
			$stmt->bind_result($id);
				$row = $stmt->fetch();
				$id;
			$token = bin2hex(md5(uniqid($id, true)));
			$currentDate = date("Y-m-d H:s");
			$status = "1";
			
			$link =SITE_URL."reset-password/?Acesstoken=".$token."";
			
			$statement = $conn->prepare("UPDATE hm_users SET forget_password_value=?, forget_password_status=?,forget_password_entry_date=? WHERE id=?");

			//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
			$statement->bind_param('sisi', $token, $status, $currentDate,$id);
			$results =  $statement->execute();
			if($results){
				$subject = "Reset your test.com password link";

				$message = "
				<html>
				<head>
				<title>This is an automated email, so please do not reply.</title>
				</head>
				<body>
				<table>
				<tr><td>This is an automated email, so please do not reply.</td></tr>
				<br><br>
				<tr>
				<td>To reset your test.com password, just click this link:</td></tr>
				<tr>
				<td>Reset link : <a href=".$link.">Reset password</a></td> 
				</tr>
				<br><br>
				<tr>
				<td>If you didn't request a password reset, you can safely ignore this email. <br>
				Another user may have entered your email address by mistake when trying <br>
				to reset their own password.</td></tr>
				<br><br>
				<tr>
				<td>Thank you!</td></tr><tr>
				<td>The dfff Team</td>
				</tr>
				</table>
				</body>
				</html>
				";

				$from = "test@test.com";
				$headers1 = "From:Reset password <$from>\n";
				$headers1 .= "Content-type: text/html;charset=iso-8859-1\r\n";
				$headers1 .= "X-Priority: 1\r\n";
				$headers1 .= "X-MSMail-Priority: High\r\n";
				$headers1 .= "X-Mailer: Reset password link\r\n";
				$sentmail = mail ( $lost_email, $subject, $message, $headers1,"-f $from" );
				echo "1";
			}else{
			 	print '0';
			}
		} else {
			return "0";	
		}
	} 
}
function resetPasswordconternt(){
	 $accessToken = $_GET['Acesstoken'];
	echo '
    <div class="col-md-6 col-md-offset-3">
     <div class="login_register_class">Reset Password : </div>
    <form style="display: block;" id="resetpassword">
	    <div class="modal-body">
                <span style="font-color:#E10707; font-size:13px; margin-bottom:10px; float:left; " class="error" id="accessTokenError"></span>
                <input type="password" style="font-color:#E10707;margin-bottom: 15px;
    margin-top: 15px; float:left; " placeholder="Password" name="r_password" class="form-control" id="r_password">
                 <span style="font-color:#E10707; font-size:13px; margin-bottom:10px; float:left; " class="error" id="r_err_password"></span>
                 <input type="password" placeholder="Cofirm Password" name="r_con_password" class="form-control" id="r_con_password">
                 <span style="font-color:#E10707; margin-top:0px; float:left; " class="error" id="r_err_Confirm"></span>
                 <input type="hidden" id="accesstoken" name="accesstoken" value="'.$accessToken.'" />
                <!--<input id="mobile" name="mobile" class="form-control" type="text" placeholder="Mobile" required>-->
                <!--<input id="register_password" name="register_password" class="form-control" type="password" placeholder="Password" required>-->
		</div>
	    <div class="modal-footer">
                <div>
                    <button onclick="resetpasswords();" class="btn btn-primary btn-lg btn-block" type="button">submit</button>
                </div>
                <div>
                <a href='.SITE_URL.'login/> 
                    <button ;="" onclick="loginFun()" class="btn btn-link" type="button" id="register_login_btn">Sign In</button>
                    </a> 
                    <a href='.SITE_URL.'registration/> 
                    <button ;="" onclick="lostFun()" class="btn btn-link" type="button" id="register_lost_btn">Lost Password?</button>
                    </a>
                </div>
	    </div>
        </form>
        </div>
';
}
function resetPassword(){
	
	 $conn=dbconnection();
	 $accessToken =mysqli_real_escape_string($conn,$_POST['accesstoken']);
	 $Pass = md5(mysqli_real_escape_string($conn,$_POST['register_password']));
	 $Con_password =  md5(mysqli_real_escape_string($conn,$_POST['Con_password']));
	
	if(!isset($accessToken) && $accessToken==""){
		echo "0";
		exit;
	}
	
	if ($stmt = $conn->prepare("SELECT id FROM  hm_users WHERE forget_password_value = ?")) {
		// Bind the variables to the parameter as strings. 
		 $accessToken = mysqli_real_escape_string($conn,$accessToken);

		$stmt->bind_param("s", $accessToken);
		// Execute the statement.
		$stmt->execute();
		$stmt->store_result();
		$numRows = $stmt->num_rows;
		if($numRows>0){
			$stmt->bind_result($id);
				$row = $stmt->fetch();
				$id;
		$statement = $conn->prepare("UPDATE hm_users SET password=?, confirmpassword=? WHERE id=?");
		//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
		$statement->bind_param('ssi', $Pass, $Pass,$id);
		$results =  $statement->execute();
		if($results){
				echo "1";
			}else {
				echo "0";	
			}
				
	} else {
		echo "0";
	}
	
	}
	
}

function checkoutedits($userid){
	$conn=dbconnection();
	if ($stmt = $conn->prepare("SELECT `name`,`email`,`phone_number`, `shipping_email`, `shipping_mobile`, `shipping_address`, `country`, `city`, `districk`, `zip`, `spical_notes` FROM `hm_users` WHERE id=? limit 1 ")) {
		// Bind the variables to the parameter as strings. 
		$stmt->bind_param("i", $userid);
		// Execute the statement.
		$stmt->execute();
		$stmt->store_result();
		 $numRows = $stmt->num_rows;
		if($numRows>0){
		$stmt->bind_result($name,$email,$phone_number,$shipping_email,$shipping_mobile,$shipping_address,$country,$city,$districk,$zip,$spical_notes);
			$row = $stmt->fetch();
			
			$emparray = array();
		  	$emparray['name'] = $name;
		  	$emparray['shipping_email'] = $shipping_email;
		  	$emparray['shipping_mobile'] = $shipping_mobile;
		  	$emparray['shipping_address'] = $shipping_address;
		  	$emparray['country'] = $country;
		  	$emparray['city'] = $city;
		  	$emparray['districk'] = $districk;
		  	$emparray['zip'] = $zip;
		  	$emparray['email'] = $email;
		  	$emparray['phone_number'] = $phone_number;
		  	$emparray['spical_notes'] = $spical_notes;
			return $emparray;
		} else {
		return FALSE;	
	}
}
}

function updateUserIdtoCart($cartSession,$userid,$orderId){
	 $conn=dbconnection();
	 $cartSession = mysqli_real_escape_string($conn,$cartSession);
	 $userid	  = mysqli_real_escape_string($conn,$userid);
	 $orderId     = mysqli_real_escape_string($conn,$orderId);         
	 $statement = $conn->prepare("UPDATE tbl_cart SET orderId=?, userid=? WHERE cartsessid=?");
	//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
	$statement->bind_param('sis', $orderId, $userid,$cartSession);        
	 $results =  $statement->execute();         
}

function updateUserIdtoOrderDetails($cartSession,$userid,$orderId,$country,$couponID,$optionsRadios){
	 $conn=dbconnection();
	 $cartSession = mysqli_real_escape_string($conn,$cartSession);
	 $userid	  = mysqli_real_escape_string($conn,$userid);
	 $orderId     = mysqli_real_escape_string($conn,$orderId);
	 
    $couponID = mysqli_real_escape_string($conn,$_POST['couponID']);
	$voucherID = mysqli_real_escape_string($conn,$_POST['voucherID']);
    $discountType = mysqli_real_escape_string($conn,$_POST['discountType']);
    if($voucherID!=""){
        $discountprice=get_gift_voucher_discount($voucherID);
    }else{
        $stmtff ="SELECT  `expiry_date`,discount from tbl_coupon WHERE coupon_code='".$couponID."'";
        $resultsd  = mysqli_query($conn,$stmtff);
        $row_cnt = mysqli_num_rows($resultsd);
        $resultrow  = mysqli_fetch_array($resultsd);
        if($row_cnt>0){
            $current_date =  date("Y-m-d h:i:s");
            $expiry_date = $resultrow['expiry_date'];
            if(strtotime($current_date) > strtotime($expiry_date)){
                $discountprice	= "";
            }else{
                $discountprice	= $resultrow['discount'];
            }
        }
    }

	 
	 $stmt ="SELECT `productId`, `ProductPrice`,`quantity`,weight FROM `tbl_cart` WHERE cartsessid='$cartSession'";
	 $result=mysqli_query($conn,$stmt);
	 $emparray = array();
	 $total = 0; //set initial total value
	 while($obj=mysqli_fetch_array($result))
	{
		
		$productId = $obj['productId'];
		$price     = $obj['ProductPrice'];
		$quantity  = $obj['quantity'];
		$weight    = $obj['weight'];
		$productname = productname($productId);
		$productnames = $productname['Title'];
		$subtotal = ($price * $quantity); //calculate Price x Q
	$stmtinsert = $conn->prepare("INSERT INTO tbl_orders_cofirm (  `productId`, `productName`, `price`, `qut`, `weight`, `user_id`, `order_id`) VALUES (?, ?, ?, ?, ?, ?, ?)");
	$stmtinsert->bind_param("isiisis", $productId, $productnames, $price,$quantity,$weight,$userid,$orderId);		 
	$stmtinsert->execute();
	
	$total = ($total + $subtotal);
		$productContent .= '<tr>
		<td style="text-align:left;vertical-align:middle;border:1px solid #eee;word-wrap:break-word;color:#737373;padding:12px">'.$productnames.'<br><small></small>
		</td>
		<td style="text-align:left;vertical-align:middle;border:1px solid #eee;color:#737373;padding:12px">'.$quantity.'</td>
		<td style="text-align:left;vertical-align:middle;border:1px solid #eee;color:#737373;padding:12px">Rs '.$price.'</td>
		<td style="text-align:left;vertical-align:middle;border:1px solid #eee;color:#737373;padding:12px"><span>Rs '.$subtotal.'</span></td>
		</tr>';
	}
	
	 $shipping_cost = shippmentCost($country);
	 
	 if($total>=300){
	 	$shipping_cost=0;
	 }else{
	 	$shipping_cost = 40;
	 }
	 
	$grand_total = $total + $shipping_cost; //grand total including shipping cost 

	if($discountprice!="") {
        if($voucherID!="") {
            if($discountprice >= $grand_total){
                $discout_total=$grand_total;
                $remaining_amount=$discountprice-$grand_total;
            }
            else{
                $discout_total=$discountprice;
                $remaining_amount=0;
            }
            $grand_total = $grand_total - $discout_total;
             updateRemainingAmount($voucherID,$remaining_amount);
        }else{
            $discout_total = ($discountprice / 100) * $grand_total;
            $grand_total=$grand_total-$discout_total;
        }

	} 
	 $grand_total = $grand_total;


	
	$stmtinsertS = "INSERT INTO order_confirm_shipping_details_discount_amt (`shipping_cost`, `disout_amt`, `discount_type`,`total`, `grand_total`, `user_id`, `order_id`) VALUES ('$shipping_cost','$discout_total','$discountType', '$total','$grand_total', '$userid','$orderId')";
	
	 $result=mysqli_query($conn,$stmtinsertS);
	 
	 $checkoutedits = checkoutedits($userid);
		$name = $checkoutedits['name'];
		$shipping_email = $checkoutedits['shipping_email'];
		$shipping_mobile = $checkoutedits['shipping_mobile'];
		$shipping_address = $checkoutedits['shipping_address'];
		$country = $checkoutedits['country'];
		$city = $checkoutedits['city'];
		$districk = $checkoutedits['districk'];
		$zip  = $checkoutedits['zip'];
		$spical_notes = $checkoutedits['spical_notes'];
		if($spical_notes!=""){
			$spical_notess = '<p> <strong> Note :</strong>'.$spical_notes.'</p>';
			//$spical_notess = $spical_notes;
		}else{
			$spical_notess ="";
		}
	 
	  if($optionsRadios=="COD"){
	  	$paymentmetodconts = '<p>Pay with cash home delivery.</p>';
	  	$shippingMethod  ='Cash On Delivery';
	  }else if($optionsRadios=="BankDeposit"){
	  	$paymentmetodconts = "";

     $stmt = "SELECT `id`,`country_name` FROM `tbl_countries` where id='$country' ";
		// Bind the variables to the parameter as strings. 
	$resultscont=mysqli_query($conn,$stmt);
	$row_cnts = mysqli_num_rows($resultscont);
	$row_cntcont = mysqli_fetch_array($resultscont);
        $country_name = $row_cntcont['country_name'];
	$shippingMethod  ='Direct Bank Transfer';
	
	$statementorderupdate = "UPDATE order_confirm_shipping_details_discount_amt SET order_status='Processing' WHERE order_id=$orderId";
		//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
		$resultscont=mysqli_query($conn,$statementorderupdate);
	
	  }
	 
	 $subject = 'spsbrands.com : order confirmation - '.$orderId;
	  
	$message = '<!DOCTYPE html>
	<html><head>
	<meta http-equiv="Content-Type"  content="text/html charset=UTF-8" />
	<title> Email  template 1 </title>
	</head>
	<body style="background-color: rgb(245, 245, 245); font-family: &quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;">
	<div class="top_section" style="padding: 5% 13%;">
	<p style="text-align:center">'.$subject.'</p>
	<h1 style="background-color: rgb(255, 0, 0); padding: 4% 10%; color: rgb(255, 255, 255); border-top-left-radius: 4px; border-top-right-radius: 4px;margin: 0px;"> Thank you for choosing spsbrands.com</h1>
	<div style="padding: 5% 10%; background-color: rgb(255, 255, 255); border: 1px solid rgb(221, 221, 221);">
	<p>Your order has been received and is now being processed. Your order details are shown below for your reference:</p>
	'.$paymentmetodconts.'
	<h3 style="color: rgb(255, 0, 0);">Order #'.$orderId.'</h3 style="color: rgb(255, 0, 0);">
	<table style="width:100%;color:#737373;border:1px solid #e4e4e4" border="1" cellpadding="6" cellspacing="0">
	<thead><tr>
	<th scope="col" style="text-align:left;color:#737373;border:1px solid #e4e4e4;padding:12px">Product</th>
	<th scope="col" style="text-align:left;color:#737373;border:1px solid #e4e4e4;padding:12px">Quantity</th>
	<th scope="col" style="text-align:left;color:#737373;border:1px solid #e4e4e4;padding:12px">price</th>
	<th scope="col" style="text-align:left;color:#737373;border:1px solid #e4e4e4;padding:12px">total</th>
	</tr></thead>
	<tbody>
	'.$productContent.'
	</tbody>
	<tfoot>
	<tr>
	<th scope="row" colspan="3" style="text-align:left;border-top-width:4px;color:#737373;border:1px solid #e4e4e4;padding:12px">Subtotal:</th>
			<td style="text-align:left;border-top-width:4px;color:#737373;border:1px solid #e4e4e4;padding:12px"><span>Rs '.$total.'</span></td>
		</tr>
	<tr>
	<th scope="row" colspan="3" style="text-align:left;color:#737373;border:1px solid #e4e4e4;padding:12px">Shipping:</th>
			<td style="text-align:left;color:#737373;border:1px solid #e4e4e4;padding:12px">Local Pickup</td>
		</tr>
	<tr>
	<th scope="row" colspan="3" style="text-align:left;color:#737373;border:1px solid #e4e4e4;padding:12px">Payment Method:</th>
			<td style="text-align:left;color:#737373;border:1px solid #e4e4e4;padding:12px">'.$shippingMethod.'</td>
		</tr>
	<tr>
	<th scope="row" colspan="3" style="text-align:left;color:#737373;border:1px solid #e4e4e4;padding:12px">Grand Total:</th>
			<td style="text-align:left;color:#737373;border:1px solid #e4e4e4;padding:12px"><span>Rs '.$grand_total.'</span></td>
		</tr>
	</tfoot>
	</table>
	
	'.$spical_notess.'
	
	<h3 style="color: rgb(255, 0, 0);">Your details</h3 style="color: rgb(255, 0, 0);">
	<p> <strong>Email:</strong> <a href="mailto:'.$shipping_email.'">'.$shipping_email.'</a> </p>
	<p> <strong>Tel:</strong>'.$shipping_mobile.'</p>
	<h3 style="color: rgb(255, 0, 0);">Billing address</h3 style="color: rgb(255, 0, 0);">
	<p>'.$shipping_mobile.'</p>
	<p>'.$name.'</p>
	<p>'.$shipping_address.'</p>
	
	<p>'.$city .' - '.$zip.'</p>
	<p>'.$districk.' , '.$country_name.'</p>

	</div>
	</div>

	</body></html>';
	
	$email_new=$shipping_email;
	$admin_email = 'spsbrands.com@gmail.com';

	 $to  = $admin_email; // note the comma
	 $to1 = $email_new; // note the comma

	// $to = 'gopi.m@omkarsoft.com';
	
	$from = $to1;
	$from1 = 'spsbrands.com@gmail.com';
	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	// Create email headers
	$headers .= 'From:'.$from."\r\n".
	'Reply-To: '.$from."\r\n" .
	'X-Mailer: PHP/' . phpversion();
	
	
	// To send HTML mail, the Content-type header must be set
	$headers1  = 'MIME-Version: 1.0' . "\r\n";
	$headers1 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	// Create email headers
	$headers1 .= 'From:'.$from1."\r\n".
	'Reply-To: '.$from1."\r\n" .
	'X-Mailer: PHP/' . phpversion();
	
	
	// Compose a simple HTML email message
	
	  sendGridEmail($from,$to,$cc,$bcc,$subject,$message,$headers);
	 
	  sendGridEmail($from1,$to1,$cc,$bcc,$subject,$message,$headers1);

    

	return  $orderId;
}


function checkoutsummry($cartSession){
	$conn=dbconnection();
	 $stmt ="SELECT `productId`,weight,`ProductPrice`,`quantity` FROM `tbl_cart` WHERE cartsessid='$cartSession'";
	 $result=mysqli_query($conn,$stmt);
	 $emparray = array();
	while($obj=mysqli_fetch_object($result))
	{
	$emparray[] = $obj;
	}
	$data['allresult'] = $emparray;
	return $data;
}

function headerCarts(){
	 $cartSessionId = $_SESSION['cartSessionId'];
	 $conn=dbconnection();
	 $stmt ="SELECT `productId`, `ProductPrice`,`quantity`,`productImg`,`weight` FROM `tbl_cart` WHERE cartsessid='$cartSessionId'";
    //mysqli_set_charset($conn,"utf8");
	$result=mysqli_query($conn,$stmt);
	$row_cnt = mysqli_num_rows($result);
	 if($row_cnt>0){
	?>
	<div class="cart-sidebar-header">
            <h5>
               My Cart <span class="text-success">(<?php echo $row_cnt; ?> item)</span> <a data-toggle="offcanvas" class="float-right" href="#"><i class="mdi mdi-close"></i>
               </a>
            </h5>
         </div>
	<div class="cart-sidebar-body">	 
	<?php
	$total = 0; //set initial total value
	while($obj=mysqli_fetch_array($result))
	{
	$productId = $obj['productId'];
	$ProductPrice = $obj['ProductPrice'];
	$productImg = $obj['productImg'];
	$quantity = $obj['quantity'];
	$productname = productname($productId);
	$productnames = $productname['Title'];
	$weight       = $obj['weight'];
	$product_link = $productname['product_alis_link'];
	$subtotal = ($ProductPrice * $quantity); //calculate Price x Qty 
	$total = ($total + $subtotal);
	?>
 
         
            <div class="cart-list-product">
               <a class="float-right remove-cart" href="#"><i class="mdi mdi-close"></i></a>
               <img class="img-fluid" src="<?php echo SITE_URL;?><?php echo $productImg; ?>" alt="">
               <span class="badge badge-success">50% OFF</span>
               <h5><a href="<?php echo $product_link; ?>"><?php echo $productnames; ?></a></h5>
               <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - <?php echo $weight; ?></h6>
               <p class="offer-price mb-0">Rs. <?php echo $ProductPrice; ?> X <?php echo $quantity; ?> <!--<i class="mdi mdi-tag-outline"></i> <span class="regular-price"></span>--></p>
            </div>
         
       
	<?php
	} 
	$grand_total = $total + $shipping_cost; //grand total including shipping cost
	?>
	</div>
	<div class="cart-sidebar-footer">
	<!-- <div class="cart-store-details">
		<p>Sub Total <strong class="float-right">$900.69</strong></p>
		<p>Delivery Charges <strong class="float-right text-danger">+ $29.69</strong></p>
		<h6>Your total savings <strong class="float-right text-danger">$55 (42.31%)</strong></h6>
	</div> -->
	<a href="<?php echo SITE_URL;?>checkout"><button class="btn btn-secondary btn-lg btn-block text-left" type="button"><span class="float-left"><i class="mdi mdi-cart-outline"></i> Proceed to Checkout </span><span class="float-right"><strong>Rs. <?php echo $grand_total; ?>.69</strong> <span class="mdi mdi-chevron-right"></span></span></button></a>
	</div>
	<?php }else{
		echo "<div style='color:#000;'>no products added in cart.</div>";
	}
}


function amountformat($price){
	return number_format($price);
}
function subscribeEmail(){
	 $conn=dbconnection();
	 $subemais = mysqli_real_escape_string($conn,$_POST['subemais']);
	 $stmt ="SELECT `id` FROM `tbl_subscribe_email` WHERE email='$subemais'";
	 $result=mysqli_query($conn,$stmt);
	 $row_cnt = mysqli_num_rows($result);
	
	if($row_cnt>0){
     echo "0";
     exit;
	}else {

        $stmt = $conn->prepare("INSERT INTO tbl_subscribe_email (`email`) VALUES (?)");
        $stmt->bind_param("s", $subemais);
        $results = $stmt->execute();
        if ($results) {
            //echo "1";
            $subject = "spsbrands.com newsletter subscription confirmation";
            $message = "
		<html>
		<head>
			<title>Newsletter request from .</title>
				</head>
				<body>
				<table>
				<tr><td>Thank you for subscribing to our newsletter</td></tr>
				<br><br>
				<tr>
				<td>You have been successfully added to our mailing list, keeping you up-to-date with our latest news.</td>
				</tr>
				<br><br>
				
				</table>
				</body>
				</html>
				";

            $to = $subemais;
            $from = 'spsbrands.com@gmail.com';
            $headers1 = "From: spsbrands.com Newsletter <$from>\n";
            $headers1 .= "Content-type: text/html;charset=iso-8859-1\r\n";
            $headers1 .= "X-Priority: 1\r\n";
            $headers1 .= "X-MSMail-Priority: High\r\n";
            $headers1 .= "X-Mailer: Contact request\r\n";
            sendGridEmail($from,$to,$cc,$bcc,$subject,$message,$headers1);
            /*$sentmail = mail($to, $subject, $message, $headers1, "-f $from");*/
            /*if ($sentmail)*/
                echo "1";
            /*else
                echo "3";*/
        } else {
            //echo "2";
        }
		//echo "1";
    }
	$conn->close();
}

function couponCodevalid(){
	
	$conn=dbconnection();
	$couponID = mysqli_real_escape_string($conn,$_POST['couponID']);
	$stmt ="SELECT  `expiry_date` from tbl_coupon WHERE coupon_code='".$couponID."'";
	$result  = mysqli_query($conn,$stmt);
	$row_cnt = mysqli_num_rows($result);
	$resultrow  = mysqli_fetch_array($result);
	if($row_cnt>0){
	 $current_date =  date("Y-m-d h:i:s");
	   $expiry_date = $resultrow['expiry_date'];
	 if(strtotime($current_date) > strtotime($expiry_date)){
	 	echo "2";
	 }
	}else{
	  echo "1";	
	}
	
}

function shippmentCost($shipingcountry){
	 $conn=dbconnection();
	if(empty($shipingcountry)){
	 	$whereshipment = "order by id ASC limit 1";
	 }else if($shipingcountry=="113"){
	 	$whereshipment = "order by id ASC limit 1";
	 }
	 else if($shipingcountry!="113"){
	 	$whereshipment = "order by id DESC limit 1";
	 }
	 
	 $stmt ="SELECT `cost` FROM `tbl_shipment` ".$whereshipment." ";
	 $result=mysqli_query($conn,$stmt);
	 $row_cnt = mysqli_num_rows($result);
	 while($obj=mysqli_fetch_object($result))
	{
	//$emparray[] = $obj;
	return $obj->cost;
	}
	 
}
function checkoutDisplayContet(){
	 $conn=dbconnection();
	$shipingcountry = mysqli_real_escape_string($conn,$_POST['country']);
	$cartSession =  $_SESSION['cartSessionId'];
	$shipping_cost = shippmentCost($shipingcountry);
	
	$couponID = mysqli_real_escape_string($conn,$_POST['couponID']);
	$isGiftVoucher = mysqli_real_escape_string($conn,$_POST['isGiftVoucher']);
	$discountType = mysqli_real_escape_string($conn,$_POST['discountType']);

    if($isGiftVoucher=="true"){
        $discountprice=get_gift_voucher_discount($couponID);
    }else if($couponID!=""){
        $stmt ="SELECT  `expiry_date`,discount from tbl_coupon WHERE coupon_code='".$couponID."'";
        $result  = mysqli_query($conn,$stmt);
        $row_cnt = mysqli_num_rows($result);
        $resultrow  = mysqli_fetch_array($result);
        if($row_cnt>0){
            $current_date =  date("Y-m-d h:i:s");
            $expiry_date = $resultrow['expiry_date'];
            if(strtotime($current_date) > strtotime($expiry_date)){
                $discountprice	= "";
            }else{
                $discountprice	= $resultrow['discount'];
            }
        }
    }else{
		$discountprice="";
	}

	 ?>
	  <div class="">
    <div class="checkout-right">
      <h4>Order Summary</h4>
      <div class="aa-order-summary-area">
          <input type="hidden" value="<?php echo $discountType;?>" name="discountType" id="discountType">
        <table class="table table-responsive">
          <thead>
            <tr>
              <th>Product</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
          <?php 
          
		//$shipping_cost="0";
		$total = 0; //set initial total value
		$viewCarts = checkoutsummry($cartSession);
		
foreach($viewCarts['allresult'] as $viewCartsRow){
$subtotal = ($viewCartsRow->ProductPrice * $viewCartsRow->quantity); //calculate Price x Q
		?>
            <tr>
              <td><?php $productname = productname($viewCartsRow->productId); echo $productname['Title']; ?><strong> <?php $dash=" - "; $weight = $viewCartsRow->weight; if($weight!=""){ echo $dash.$weight.$dash;} ?>  x  <?php echo $viewCartsRow->quantity; ?></strong></td>
              <td>Rs <?php echo amountformat($subtotal); ?>.00</td>
            </tr>
           <?php  $total = ($total + $subtotal); //add subtotal to total var  
           }
           
           if($total>=300){ 
              $shipping_cost =0;
              }else{
			  	$shipping_cost = $shipping_cost;
			  }
           
           $grand_total = $total + $shipping_cost; //grand total including shipping cost
          $grand_total_store=$grand_total;
            ?> 
        </tbody>
          <tfoot>
            <tr>
              <th>Sub Total</th>
              <td>Rs <?php echo amountformat($total); ?>.00</td>
            </tr>
             <tr>
              <th>shipping cost</th>
              
              <td>Rs <?php echo amountformat($shipping_cost); ?>.00</td>
            </tr>
            <?php  if($discountprice!="") {
                if($isGiftVoucher=="true") {
                    if($discountprice >= $grand_total){
                        $discount_amount=$grand_total;
                        $remaining_amount=$discountprice-$grand_total;
                    }
                    else{
                        $discount_amount=$discountprice;
                        $remaining_amount=0;
                    }
                    $grand_total = $grand_total - $discount_amount;
                   // updateRemainingAmount($couponID,$remaining_amount);
                }
                else {
                    $discout_total = ($discountprice / 100) * $grand_total;
                }
                $grand_total=$grand_total-$discout_total;
                if($couponID=="")
                    $grand_total=$grand_total_store;
            }?>
            <tr>
                <th>Coupon Code Discount</th>
                <td>Rs <?php echo amountformat($discout_total); ?>.00</td>
            </tr>
            <!--<tr>
                <th>Gift Voucher Discount</th>
                <td>Rs <?php echo amountformat($discount_amount); ?>.00</td>
            </tr>-->
             <tr>
              <th>Total</th>
              <td>Rs  <?php echo amountformat($grand_total); ?>.00</td>
            </tr>
          </tfoot>
        </table>
	  </div>
      <h4>Payment Method</h4>
      <div class="aa-payment-method">                    
        <!--<label for="cashdelivery"><input id="paymentgateway" name="optionsRadios" checked="" value="COD" type="radio">Lipa na M-Pesa(Paybill:222196)</label> <br>-->
                <!--<label for="paypal"><input id="wallets" name="optionsRadios" value="paymentGateway" type="radio">Payment Gateway</label> <br>-->

        <label for="paypal"><input id="wallets" name="optionsRadios" value="BankDeposit" type="radio">COD</label> <br>
        <label id="optionsRadios-error" class="error" for="optionsRadios"></label>
        <!--<img src="https://www.paypalobjects.com/webstatic/mktg/logo/AM_mc_vs_dc_ae.jpg" alt="PayPal Acceptance Mark" border="0"> -->   
        <input value="Place Order" class="aa-browse-btn" type="submit">                
      </div>
    </div>
  </div>

   
<?php } 

function countrylist(){
	$conn=dbconnection();
	$stmt = "SELECT `id`,`country_name` FROM `tbl_countries` ";
		// Bind the variables to the parameter as strings. 
	$result=mysqli_query($conn,$stmt);
	$row_cnt = mysqli_num_rows($result);
	
	if($row_cnt>0){
	 $emparray = array();
	while($obj=mysqli_fetch_object($result))
	{
	$emparray[] = $obj;
	}
	$data['contryresult'] = $emparray;
	return $data;
	}else{
		return "0";
	}
}

function mainSearchFuncNew(){
	        $conn=dbconnection();
	        $keyword  =  mysqli_real_escape_string($conn,$_POST['search']);;
	        $catList  =  mysqli_real_escape_string($conn,$_POST['catList']);
			if($keyword==""){
				echo "0";
				exit;
			}
			$limit="50";
            $keyword = trim($keyword);
            $search_condition = '';
            $orderCondition = "";
            $keywordArray = @explode(' ',$keyword);
            $keywordArraySize = sizeof($keywordArray);
            
            if($keywordArraySize<2 && strlen($keyword)<=3){
            $orderConditionAdditional = " WHEN Title like '$keyword%' THEN 10000";
            }
            else{
                $orderConditionAdditional = '';
            }
            
            if($keywordArraySize>0){
                $search_condition .= " (";
                $m = 0;
                $whencases = ' WHEN ';
                $whencases99 = ' WHEN ';
                foreach ($keywordArray as $keywordvalue) {
                    $keywordvalue = trim($keywordvalue);
                    if($keywordvalue!=''){
                        
                    if($m==0){$orcond ='';}else{$orcond ='OR';}
                    $search_condition .= " $orcond Title like '%$keywordvalue%'";
                    if($orderCondition==''){$conditionComma = '';}else{$conditionComma = ', ';}
                    
                        $newkeyword = $keywordArray[$m];
                        if($m==0){$ANDcond ='';}else{$ANDcond ='AND';}
                        
                        if($m == 0){
                            $special_thencount = 98;
                            if($keywordArraySize<2){
                               $special_thencount = 500; 
                            }
                            $whencases .= " $ANDcond Title like '$newkeyword%' ";
                            $finalWhencases = "$whencases  THEN $special_thencount ";
                            
                            $finalWhencases .= " WHEN Title like '% $newkeyword %'  THEN 501 ";

                            $finalWhencases .= " WHEN Title like '%-$newkeyword-%'  THEN 503 ";
                            $finalWhencases .= " WHEN Title like '%($newkeyword)%'  THEN 504 ";
                            $finalWhencases .= " WHEN Title like '%-$newkeyword %'  THEN 505 ";
                            $finalWhencases .= " WHEN Title like '% $newkeyword-%'  THEN 506 ";
                            }


                        else if($m == ($keywordArraySize - 1)){
                            $whencases .= " $ANDcond Title like '%$newkeyword' ";
                            $finalWhencases = "$whencases  THEN 1000 ";
                        }
                        else{
                            $whencases .= " $ANDcond Title like '%$newkeyword%' ";
                            $finalWhencases = "$whencases  THEN $m ";
                        }



                        if($m==0){
                            $whencases99.= "  Title like '$newkeyword' ";
                            $finalWhencases99 = "$whencases99  THEN 99 ";

                        }else{
                            $whencases99.= " AND Title like '$newkeyword' ";
                            $finalWhencases99 = "$whencases99  THEN 99 ";
                        }


                    $orderCondition .= "$conditionComma CASE $orderConditionAdditional  $finalWhencases $finalWhencases99 WHEN Title like '$keywordvalue' THEN 100 WHEN Title like '%$keywordvalue%' THEN 98 ELSE -100 END DESC ";
                    }


                $m++;
                }
                $search_condition .= ") ";
            }
            else{
                $search_condition = " (Title like '$keyword' OR Title like '$keyword%' OR Title like '%$keyword%' or Title like '%$keyword') ";
                $orderCondition = " CASE $orderConditionAdditional WHEN Title like '$keyword' THEN 5 WHEN Title like '$keyword%' THEN 4 WHEN Title like '%$keyword%' THEN 3 WHEN Title like '%$keyword' THEN 3 ELSE 1 END DESC ";
            }

            $myWhere = 'product_status = 0 ';
            if($catList==""){
				$catWhere = "";
			}else{
				$catWhere = "and cat_id ='$catList'";
			}


            //
            $query="SELECT product_alis_link,Title FROM tbl_products ";
            $query .=" where $myWhere $catWhere AND $search_condition";
            $query .="ORDER BY $orderCondition  ";
            $query .=" limit $limit";
            //$echo .=  $query;
             $query;
            mysqli_set_charset($conn,"utf8");
			$result=mysqli_query($conn,$query);
			$row_cnt = mysqli_num_rows($result);
			if($row_cnt>0){
				while($resultRow = mysqli_fetch_array($result)){
					$productAlis = $resultRow['product_alis_link'];
					$tittle = $resultRow['Title'];
				echo "<a href='".SITE_URL."$productAlis'><li>$tittle</li></a>";
				}
			}else {
					echo "No records found...";
				}

}


function mainSearchFuncNewIds($keyword,$catList){
	        $conn=dbconnection();
	        $keyword  =  $keyword;
	        $catList  =  $catList;
			if($keyword==""){

			}
			$limit="50";
            $keyword = trim($keyword);
            $search_condition = '';
            $orderCondition = "";
            $keywordArray = @explode(' ',$keyword);
            $keywordArraySize = sizeof($keywordArray);

            if($keywordArraySize<2 && strlen($keyword)<=3){
            $orderConditionAdditional = " WHEN Title like '$keyword%' THEN 10000";
            }
            else{
                $orderConditionAdditional = '';
            }

            if($keywordArraySize>0){
                $search_condition .= " (";
                $m = 0;
                $whencases = ' WHEN ';
                $whencases99 = ' WHEN ';
                foreach ($keywordArray as $keywordvalue) {
                    $keywordvalue = trim($keywordvalue);
                    if($keywordvalue!=''){

                    if($m==0){$orcond ='';}else{$orcond ='OR';}
                    $search_condition .= " $orcond Title like '%$keywordvalue%'";
                    if($orderCondition==''){$conditionComma = '';}else{$conditionComma = ', ';}

                        $newkeyword = $keywordArray[$m];
                        if($m==0){$ANDcond ='';}else{$ANDcond ='AND';}

                        if($m == 0){
                            $special_thencount = 98;
                            if($keywordArraySize<2){
                               $special_thencount = 500;
                            }
                            $whencases .= " $ANDcond Title like '$newkeyword%' ";
                            $finalWhencases = "$whencases  THEN $special_thencount ";

                            $finalWhencases .= " WHEN Title like '% $newkeyword %'  THEN 501 ";

                            $finalWhencases .= " WHEN Title like '%-$newkeyword-%'  THEN 503 ";
                            $finalWhencases .= " WHEN Title like '%($newkeyword)%'  THEN 504 ";
                            $finalWhencases .= " WHEN Title like '%-$newkeyword %'  THEN 505 ";
                            $finalWhencases .= " WHEN Title like '% $newkeyword-%'  THEN 506 ";
                            }


                        else if($m == ($keywordArraySize - 1)){
                            $whencases .= " $ANDcond Title like '%$newkeyword' ";
                            $finalWhencases = "$whencases  THEN 1000 ";
                        }
                        else{
                            $whencases .= " $ANDcond Title like '%$newkeyword%' ";
                            $finalWhencases = "$whencases  THEN $m ";
                        }



                        if($m==0){
                            $whencases99.= "  Title like '$newkeyword' ";
                            $finalWhencases99 = "$whencases99  THEN 99 ";

                        }else{
                            $whencases99.= " AND Title like '$newkeyword' ";
                            $finalWhencases99 = "$whencases99  THEN 99 ";
                        }


                    $orderCondition .= "$conditionComma CASE $orderConditionAdditional  $finalWhencases $finalWhencases99 WHEN Title like '$keywordvalue' THEN 100 WHEN Title like '%$keywordvalue%' THEN 98 ELSE -100 END DESC ";
                    }


                $m++;
                }
                $search_condition .= ") ";
            }
            else{
                $search_condition = " (Title like '$keyword' OR Title like '$keyword%' OR Title like '%$keyword%' or Title like '%$keyword') ";
                $orderCondition = " CASE $orderConditionAdditional WHEN Title like '$keyword' THEN 5 WHEN Title like '$keyword%' THEN 4 WHEN Title like '%$keyword%' THEN 3 WHEN Title like '%$keyword' THEN 3 ELSE 1 END DESC ";
            }

            $myWhere = 'product_status = 0 ';
            if($catList==""){
				$catWhere = "";
			}else{
				$catWhere = "and cat_id ='$catList'";
			}


            //
            $query="SELECT ProductID FROM tbl_products ";
            $query .=" where $myWhere $catWhere AND $search_condition";
            $query .="ORDER BY $orderCondition  ";
            $query .=" limit $limit";
            //$echo .=  $query;
             $query;
            mysqli_set_charset($conn,"utf8");
			$result=mysqli_query($conn,$query);
			$row_cnt = mysqli_num_rows($result);
			if($row_cnt>0){
			$emparray = array();
			while($obj=mysqli_fetch_object($result))
			{
			$emparray[] = $obj;
			}
			$data['searchIds'] = $emparray;
			return $data;
			}else{
			return "0";
			}

}




function staticPageContets($seovals){
	$conn=dbconnection();
	$seovals;
	if ($stmt = $conn->prepare("SELECT `name`, `page_alias`, `meta_title`, `meta_keyword`, `meta_description`, `content` FROM `tbl_static_pages` WHERE page_alias=? limit 1 ")) {
		// Bind the variables to the parameter as strings.
		$stmt->bind_param("s", $seovals);
		// Execute the statement.
		$conn->set_charset("utf8");
		$stmt->execute();
		$stmt->store_result();
		$numRows = $stmt->num_rows;
		if($numRows>0){
		$stmt->bind_result($name,$page_alias,$meta_title,$meta_keyword,$meta_description,$content);
			$row = $stmt->fetch();

			$emparray = array();
		  	$emparray['name'] = $name;
		  	$emparray['page_alias'] = $page_alias;
		  	$emparray['meta_title'] = $meta_title;
		  	$emparray['meta_keyword'] = $meta_keyword;
		  	$emparray['meta_description'] = $meta_description;
		  	$emparray['content'] = $content;
			return $emparray;
		} else {
		return FALSE;
	}
}
}

function random_products_to_home($parent) {
	$conn=dbconnection();
	$parent = $parent;
	$sqlCategory = "SELECT * FROM tbl_products p
					LEFT OUTER JOIN tbl_productImg pi
					ON p.ProductID=pi.product_Id
					WHERE p.cat_id IN($parent)  AND p.is_added_to_home=1 order by rand() limit 2";
	$resCategory=$conn->query($sqlCategory);
	if ($resCategory->num_rows > 0) {
		while($rowCategories = $resCategory->fetch_assoc()) {
			$category_tree_array[] = array("product_id" => $rowCategories['ProductID'],
										"title" =>$rowCategories['Title'],
										"img_link" =>$rowCategories['img_link'],
										"product_alis_link" =>$rowCategories['product_alis_link']);
		}
	}
	return $category_tree_array;
}

/* for storing contact us information */
function contactrequest(){
	$name = $_POST['name'];
	$email = $_POST['email'];
	$msg = $_POST['msg'];
	$user_type="USER";
	$conn=dbconnection();
    $captcha_val = $_POST['captcha_val'];
    if(!captcha_validation($captcha_val)){
        echo "2";
    }else {
        $sql = "INSERT INTO tbl_contact_requests (`name`, `email`, `message`,`user_type`) VALUES ('$name','$email','$msg','$user_type')";
        $results = $conn->query($sql);

        if ($results) {
            $subject = " Contact request";
            $message = "
            <html>
            <head>
                <title>Contact request from .</title>
                    </head>
                    <body>
                    <table>
                    <tr><td>Person with following details tried to contact you.</td></tr>
                    <br><br>
                    <tr>
                    <td>Name :" . $name . "</td></tr>
                    <tr>
                    <td>Email: " . $email . "</td>
                    </tr>
                    <br><br>
                    <tr>
                    <td> Message " . $msg . "</td></tr>
                    <br><br>
    
                    </table>
                    </body>
                    </html>
                    ";

            $to = "testing@gmail.com";
            $from = $email;
            $headers1 = "From: Contact request<$from>\n";
            $headers1 .= "Content-type: text/html;charset=iso-8859-1\r\n";
            $headers1 .= "X-Priority: 1\r\n";
            $headers1 .= "X-MSMail-Priority: High\r\n";
            $headers1 .= "X-Mailer: Contact request\r\n";
            $sentmail = mail($to, $subject, $message, $headers1, "-f $from");
            echo "1";
        } else {
            echo '0';
        }
    }
}

function SellerEnquiry(){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $msg = $_POST['msg'];
    $enquiry = $_POST['enquiry'];
	$title = $_POST['title'];
	$company = $_POST['company'];
	$telephone = $_POST['telephone'];
	$captcha_val = $_POST['captcha_val'];
    $user_type="SELLER";
    $conn=dbconnection();
	if(!captcha_validation($captcha_val)){
        echo "2";
    }else {
        $sql = "INSERT INTO tbl_contact_requests (`name`, `email`, `message`,`user_type`,`enquire_about`, `enquire_title`, `company`, `telephone`)
            VALUES ('$name','$email','$msg','$user_type','$enquiry','$title','$company','$telephone')";

        $results = $conn->query($sql);
        if ($results) {
            $subject = "Seller Enquiry";
            $message = "
		<html>
		<head>
			<title>Contact request from .</title>
				</head>
				<body>
				<table>
				<tr><td>Person with following details tried to contact you.</td></tr>
				<br><br>
				<tr>
				<td>Name :" . $name . "</td></tr>
				<tr>
				<td>Email: " . $email . "</td>
				</tr>
				<tr>
				<td> Enquired About : " . $enquiry . " </td>
				</tr>
				<tr>
				<td> Enquiry Title :  " . $title . " </td>
				</tr>
				<tr>
				<td> Enquire Company :" . $company . " </td>
				</tr>
				<tr>
				<td> Enquire Telephone : " . $telephone . "  </td>
				</tr>
				<br><br>
				<tr>
				<td> Message " . $msg . "</td></tr>
				<br><br>

				</table>
				</body>
				</html>
				";

            $to = "spsbrands.com@gmail.com";
            $from = $email;
            $headers1 = "From: Seller Enquiry<$from>\n";
            $headers1 .= "Content-type: text/html;charset=iso-8859-1\r\n";
            $headers1 .= "X-Priority: 1\r\n";
            $headers1 .= "X-MSMail-Priority: High\r\n";
            $headers1 .= "X-Mailer: Contact request\r\n";
            // Report all errors except E_NOTICE
            sendGridEmail($from, $to, $cc, $bcc, $subject, $message,$headers1);

            //$sentmail = mail ( $to, $subject, $message, $headers1,"-f $from" );
            echo "1";
        } else {
            echo '0';
        }
    }
}

function captcha_validation($captcha){
    $secretKey = "6LdvSwoUAAAAAFATfKdwQ0s-yEDbCDTs_I3r61Ft";
    $ip = $_SERVER['REMOTE_ADDR'];
    $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
    $responseKeys = json_decode($response,true);
    if(intval($responseKeys["success"]) !== 1) {
        $is_valid_captcha=0;
    } else {
        $is_valid_captcha=1;
    }
    return $is_valid_captcha;
}

function AddReview()
{
	$user_id = $_POST['user_id'];
	$product_id = $_POST['product_id'];
	$review_subject = $_POST['review_subject'];
	$review = $_POST['review'];
	$rating = $_POST['rating'];
	$date=date('Y-m-d H:i:s');
	$conn = dbconnection();
	$sql = "INSERT INTO  tbl_product_ratings (`user_id`, `product_id`, `ratings`,`review_subject`,`review`,`rating_date`)
            VALUES ($user_id,$product_id,$rating,'$review_subject','$review','$date')";
	$results = $conn->query($sql);
    echo $results;
}
function get_all_reviews_order(){
    $selectedRatings = $_POST['selectedRatings'];
    $product_id = $_POST['product_id'];
	$order_by_string="";
    $conn=dbconnection();
    if($selectedRatings=="1"){
    	$order_by_string= "ORDER BY pr.rating_date DESC";
    }
    else if($selectedRatings=="0"){
    	$order_by_string= "";
    }
    else if($selectedRatings=="2"){
    	$order_by_string= "ORDER BY  pr.ratings DESC";
    }
    else if($selectedRatings=="3"){
    	$order_by_string= "ORDER BY pr.ratings ASC";
    }

	$query = "SELECT * FROM tbl_product_ratings pr
              INNER JOIN hm_users u
              ON u.id=pr.user_id
              where pr.product_id=$product_id ".$order_by_string;
    $conn->set_charset("utf8");
	$resCategory=$conn->query($query);
	$review_data=[];
	if ($resCategory->num_rows > 0) {
		while($rowCategories = $resCategory->fetch_assoc()) {
			$review_data[]=$rowCategories;
		}
	}
	echo json_encode($review_data);
}

function paginateAlleviews($reload, $page, $tpages, $adjacents,$search_val,$chek_box_val,$let_search,$type_val,$ids_indst) {
	$prevlabel = "&#60;";
	$nextlabel = "&#62;";
	$out = '<div class="pagin green">';
	$nu_vals="1";
	// previous label
	if($page==1) {
		$out.= "<span>$prevlabel</span>";
	} else if($page==2) {
		//$out.= "<a href='javascript:void(0);' onclick='load(1)'>$prevlabel</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.$nu_vals.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$prevlabel.'</a>';
	}else {
		//$out.= "<a href='javascript:void(0);' onclick='load(".($page-1).")'>$prevlabel</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.($page-1).',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$prevlabel.'</a>';
	}
// first label

	if($page>($adjacents+1)) {
		//$out.= "<a href='javascript:void(0);' onclick='load(1)'>1</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.$nu_vals.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">1</a>';
	}
	// interval
	if($page>($adjacents+2)) {
		$out.= "...\n";
	}
	// pages
	$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
	$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
	for($i=$pmin; $i<=$pmax; $i++) {
		if($i==$page) {
			$out.= "<span class='current'>$i</span>";
		}else if($i==1) {
			//$out.= "<a href='javascript:void(0);' onclick='load(1)'>$i</a>";
			$out.='<a href="javascript:void(0);" onclick='."'".'load('.$nu_vals.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$i.'</a>';
		}else {
			//$out.= "<a href='javascript:void(0);' onclick='load(".$i.")'>$i</a>";
			$out.='<a href="javascript:void(0);" onclick='."'".'load('.$i.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$i.'</a>';
		}
	}

	// interval

	if($page<($tpages-$adjacents-1)) {
		$out.= "...\n";
	}
	// last
	if($page<($tpages-$adjacents)) {
		//$out.= "<a href='javascript:void(0);' onclick='load($tpages)'>$tpages</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.$tpages.',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$tpages.'</a>';
	}
	// next
	if($page<$tpages) {
		//$out.= "<a href='javascript:void(0);' onclick='load(".($page+1).")'>$nextlabel</a>";
		$out.='<a href="javascript:void(0);" onclick='."'".'load('.($page+1).',"'.$search_val.'","'.$chek_box_val.'","'.$let_search.'","'.$type_val.'","'.$ids_indst.'");'."'".'">'.$nextlabel.'</a>';
	}else {
		$out.= "<span>$nextlabel</span>";
	}
	$out.= "</div>";
	return $out;
}
function get_meta_details($seo1,$seo2){
	$conn=dbconnection();
    $sub_cat_id = getCatId($seo2);
	if($seo1=="gift" && $sub_cat_id!="" ) {
		return meta_query($sub_cat_id,'tbl_category','category_id');
	}
    if($seo1=='login' || $seo1=='privacy-policy' || $seo1=='terms-and-conditions' || $seo1=='registration' || $seo1=='logout' || $seo1=='cart' ||  $seo1=='checkout' || $seo1=='seller-enquiry' || $seo1=='forget-password' || $seo1=='search' || $seo1=='reset-password'|| $seo1=='forgetpassword'||  $seo1=='about-us'|| $seo1=='gift' || $seo1=='order-histroy' || $seo1=='order-success' || $seo1==$page_alias && $page_alias!="" || $seo1=='write-review'){
        switch($seo1){
            case 'login':
                $meta_details['meta_title']="spsbrands.com | online shopping store  | login";
                $meta_details['meta_keyword']="buy dry fruits and spices online";
                $meta_details['meta_description']="You can buy dry fruits and spices online - Pistachios, Dried Figs Anjeer, Walnuts, Dried Black Dates, Pumpkin Seeds, Cashew, almonds ( Badam )";
                return $meta_details;
                break;
            case 'registration':
                $meta_details['meta_title']="spsbrands.com  | online shopping store | registration";
                $meta_details['meta_keyword']="Buy Herbs online";
                $meta_details['meta_description']="You can regiter with onces from spsbrands.com. you can login any where any time.";
                return $meta_details;
                break;
            case 'cart':
                $meta_details['meta_title']="spsbrands.com  | online shopping store | cart";
                $meta_details['meta_keyword']="buy Pistachios, Dried Figs Anjeer, Walnuts, Dried Black Dates, Pumpkin Seeds, Cashew, almonds ( Badam ) and buy woman sarees and emposh pattu browm,Drak pink,green,pink ";
                $meta_details['meta_description']="cart link all the products - Pistachios, Dried Figs Anjeer, Walnuts, Dried Black Dates, Pumpkin Seeds, Cashew, almonds ( Badam ),woman sarees and emposh pattu browm,Drak pink,green,pink";
                return $meta_details;
                break;
            case 'checkout':
                $meta_details['meta_title']="spsbrands.com  | online shopping store | checkout";
                $meta_details['meta_keyword']="buy Pistachios, Dried Figs Anjeer, Walnuts, Dried Black Dates, Pumpkin Seeds, Cashew, almonds ( Badam ) and buy woman sarees and emposh pattu browm,Drak pink,green,pink";
                $meta_details['meta_description']="checkout link all the products - Pistachios, Dried Figs Anjeer, Walnuts, Dried Black Dates, Pumpkin Seeds, Cashew, almonds ( Badam ),woman sarees and emposh pattu browm,Drak pink,green,pink";
                return $meta_details;
                break;
            case 'seller-enquiry':
                $meta_details['meta_title']="spsbrands.com  | buy wholesale price dry fruits, spices,  herbs  | seller-enquiry";
                $meta_details['meta_keyword']="buy wholesale price dry fruits, spices,  herbs";
                $meta_details['meta_description']="buy wholesale price dry fruits, spices,  herbs";
                return $meta_details;
                break;
            case 'forget-password':
                $meta_details['meta_title']="spsbrands.com  | forget password  | forget-password";
                $meta_details['meta_keyword']="spsbrands.com - forget password";
                $meta_details['meta_description']="spsbrands.com -forget password";
                return $meta_details;
                break;
            case 'privacy-policy':
                $static_id=get_static_page_id($seo1);
                return meta_query($static_id,'tbl_static_pages','id');
                break;
            case 'terms-and-conditions':
                $static_id=get_static_page_id($seo1);
                return meta_query($static_id,'tbl_static_pages','id');
                break;
		}
    }
	$bands_found  = check_seo_brands($seo1);
	$bands_found2 = check_seo_brands($seo2);
	if($bands_found){
		$brand_id1= get_seo_brand_id($seo1);
		return meta_query($brand_id1,'tbl_brands','id');
	}
	else if ($bands_found2){
		$brand_id2= get_seo_brand_id($seo2);
		return meta_query($brand_id2,'tbl_brands','id');
	}
	else if($seo1=='' || $seo1==''){
		$meta_details['meta_title']="spsbrands.com: Online Grocery Shopping Bangalore,Buy Organic Products Online";
		$meta_details['meta_keyword']="spsbrands.com: Online Grocery Shopping Bangalore,Buy Organic Products Online";
		$meta_details['meta_description']="spsbrands.com: Online Grocery Shopping Bangalore,Buy Organic Products Online";
		return $meta_details;
	}
	else if($seo1!=''){
		$product_found = check_seo_product($seo1);
		$category_found = check_seo_category($seo1);

		if($product_found){
			$seo=urldecode($seo1);
			$product_id=get_product_id($seo);
			return meta_query($product_id,'tbl_products','ProductID');
		}
		else if($category_found){
			if($seo1!="")
			{
				$cat_id = getCatId($seo1);
				return meta_query($cat_id,'tbl_category','category_id');
			}
			if($seo2!=''){
				$sub_cat_id = getCatId($seo2);
				return meta_query($sub_cat_id,'tbl_category','category_id');
			}

		} else {
			$meta_details['meta_title']="spsbrands.com: Online Grocery Shopping Bangalore,Buy Organic Products Online";
			$meta_details['meta_keyword']="buy Pistachios, Dried Figs Anjeer, Walnuts, Dried Black Dates, Pumpkin Seeds, Cashew, almonds ( Badam ) and buy woman sarees and emposh pattu browm,Drak pink,green,pink";
			$meta_details['meta_description']="buy Pistachios, Dried Figs Anjeer, Walnuts, Dried Black Dates, Pumpkin Seeds, Cashew, almonds ( Badam ) and buy woman sarees and emposh pattu browm,Drak pink,green,pink";
			return $meta_details;
		}
	}

}
function meta_query($id,$table_name,$column_name){
	$conn=dbconnection();
	$query="SELECT meta_title,meta_keyword,meta_description FROM ".$table_name."
 			WHERE ".$column_name." = '$id'";
	$conn->set_charset("utf8");
	$query_vals    = mysqli_query($conn,$query);
	$numrows = mysqli_num_rows($query_vals);
	$result_final = mysqli_query($conn,$query);
	$meta_details=[];
	if($numrows>0){
		while($result = mysqli_fetch_array($result_final)){
			$meta_details['meta_title']=$result['meta_title'];
			$meta_details['meta_keyword']=$result['meta_keyword'];
			$meta_details['meta_description']=$result['meta_description'];

		}
		return $meta_details;
	} else {
		return FALSE;
	}
}

function get_seo_brand_id($seo1){
	$conn=dbconnection();
	if ($stmt = $conn->prepare("SELECT `id` FROM `tbl_brands` WHERE brand_alis_name = ? ")) {
		$seo1     = mysqli_real_escape_string($conn,$seo1);
		$stmt->bind_param("s", $seo1);
		$stmt->execute();
		$stmt->store_result();
		$numRows = $stmt->num_rows;
		if($numRows>0){
			$stmt->bind_result($id);
			$row = $stmt->fetch();
			return $id;
		} else {
			return FALSE;
		}
	}
}
function get_product_id($seo1){
	$conn=dbconnection();
	if ($stmt = $conn->prepare("SELECT `ProductID` FROM `tbl_products` WHERE product_alis_link = ? ")) {
		$seo1     = mysqli_real_escape_string($conn,$seo1);
		$stmt->bind_param("s", $seo1);
		$stmt->execute();
		$stmt->store_result();
		$numRows = $stmt->num_rows;
		if($numRows>0){
			$stmt->bind_result($ProductID);
			$row = $stmt->fetch();
			return $ProductID;
		} else {
			return FALSE;
		}
	}
}

function get_static_page_id($seo1){
    $conn=dbconnection();
    if ($stmt = $conn->prepare("SELECT `id` FROM `tbl_static_pages` WHERE page_alias = ? ")) {
        $seo1     = mysqli_real_escape_string($conn,$seo1);
        $stmt->bind_param("s", $seo1);
        $stmt->execute();
        $stmt->store_result();
        $numRows = $stmt->num_rows;
        if($numRows>0){
            $stmt->bind_result($page_id);
            $row = $stmt->fetch();
            return $page_id;
        } else {
            return FALSE;
        }
    }
}

function get_google_user($email_id,$loginType){
	$conn=dbconnection();
	if ($stmt = $conn->prepare("select id,email,user_name from users where email=? AND login_type=?")) {
		$stmt->bind_param("s", $email_id,$loginType);
		$stmt->execute();
		$stmt->store_result();
		$numRows = $stmt->num_rows;
		$user_data = array();
		if($numRows>0){
			$stmt->bind_result($id,$email,$user_name);
			$user_data['id'] = $id;
			$user_data['email'] = $email;
			$user_data['user_name'] = $user_name;

			return $user_data;
		} else {
			return $user_data;
		}
	}
}
function saveGiftVoucher(){
    $voucher_amount = $_POST['voucher_amount'];
    $sender_name = $_POST['sender_name'];
    $sender_email = $_POST['sender_email'];
    $sender_phone = $_POST['sender_phone'];
    $special_message = $_POST['special_message'];
    $receiver_name = $_POST['receiver_name'];
    $receiver_email = $_POST['receiver_email'];
    $receiver_phone = $_POST['receiver_phone'];
    $date=date('Y-m-d H:i:s');
    $conn = dbconnection();
    $sql = "INSERT INTO  tbl_gift_voucher 
            (`voucher_amount`, `remaining_amount`,`sender_name`, `sender_email`,`sender_phone`,`special_message`,`reci_name`,`reci_email`,`reci_phone`,`created_date`) 
            VALUES ($voucher_amount,$voucher_amount,'$sender_name','$sender_email','$sender_phone','$special_message','$receiver_name','$receiver_email','$receiver_phone','$date')";
    $results = $conn->query($sql);
    if($results){
        $last_id = $conn->insert_id;
        $data['last_id']= $last_id;
        $data['recipient_email']=$receiver_email;
        $data['recipient_name']=$receiver_name;
        $data['sender_email']=$sender_email;
        $data['sender_name']=$sender_name;
        $data['amount']=$voucher_amount;
        echo json_encode($data);
    }
    else{
        echo "0";
    }
}
function check_txnid($tnxid){
    $conn = dbconnection();
    $valid_txnid = true;
	$sql = "SELECT * FROM `tbl_gift_voucher` WHERE transaction_id = '$tnxid'";
    $conn->set_charset("utf8");
    $result=$conn->query($sql);
    if ($result->num_rows==0) {
        $valid_txnid=false;
    }
    else{
        $valid_txnid=true;
    }
	return $valid_txnid;
}

function updatePayments($data){
    $conn = dbconnection();
    $status=0;
    if (is_array($data)) {
        $transaction_id=$data['txn_id'];
        $payment_status=$data['payment_status'];
        $payment_currency=$data['payment_currency'];
        $payment_amount=$data['payment_amount'];

        $payment_id=$data['payment_id'];
        /*$recipient_email=$data['recipient_email'];
        $recipient_name=$data['recipient_name'];
        $sender_email=$data['sender_email'];
        $sender_name=$data['sender_name'];*/

        $updated_date=date('Y-m-d H:i:s');
        $voucher_code=generate_voucher_code();
        $stmt = "UPDATE tbl_gift_voucher 
                    SET transaction_id='$transaction_id',voucher_code='$voucher_code',payment_status='$payment_status',
                    payment_amount='$payment_amount',payment_currency='$payment_currency',
                    payment_date='$updated_date'
                    WHERE id = $payment_id";
        if($conn->query($stmt)){
            $users_data=get_sender_recipient_details($payment_id, $transaction_id);
			$subject = "www.spsbrands.com Gift Voucher";
			$message = '<html>
                    <head>
                        <title> www.spsbrands.com</title>
                        <style type="text/css">
						.left {
						float: left;
						display: inline;
						width: 36%;
					}
					
					.right {
						width: 64%;
						float: left;
						display: inline-block;
					}
					
					.content p {
						color: #be282a;
						font-weight: 600;
						font-size: 1.0em;
						margin: 4px;
					}
					img {
						max-width: 100%;
					}
					
						</style>
                    </head>
                    <body style="background-color:#fff;">
                    <div class="left" >
                        <div class="content" >
                            <p>To: </p>
                            <p>Amount: '.$payment_amount.'</p>
                            <p>Voucher Code: '.$voucher_code.'</p>
                            <p>Name: '.$users_data["reci_name"].'</p>
                            <p>Address: '.$users_data["reci_email"].'</p>
                            <p> &nbsp;</p>
                            <p>From:</p>
                            <p>Name: '.$users_data["sender_name"].'</p>
                            <p>Address: '.$users_data["sender_email"].'</p>
                            <p> &nbsp;</p>
                            <p>Email: <a href="mailto:testing@gmail.com">testing@gmail.com</a> </p>
                            <p>Telephone: 07233 700 093</p>
                            <img  src="http://139.59.8.35/assets/img/email_temp/bottom.jpg"/>
                        </div>
                    </div>
                    <div class="right" >
                        <img  src="http://139.59.8.35/assets/img/email_temp/right.jpg"/>
                    </div>
                    </body>
                    </html>';
			;
			$to = $users_data["reci_email"];
            $from = 'spsbrands.com@gmail.com';
			$headers1 = "From: xzccxxc Gift Voucher <$from>\n";
			$headers1 .= "Content-type: text/html;charset=iso-8859-1\r\n";
			$headers1 .= "X-Priority: 1\r\n";
			$headers1 .= "X-MSMail-Priority: High\r\n";
			$headers1 .= "X-Mailer: Contact request\r\n";
			sendGridEmail($from,$to,$cc,$bcc,$subject,$message,$headers1);
            $status=1;
        }
        else {
            $status = 0;
        }
    }
    return $status;
}

function generate_voucher_code()
{
    $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $res = "";
    for ($i = 0; $i < 5; $i++) {
        $res .= $chars[mt_rand(0, strlen($chars)-1)];
    }
    return "VOUCHER_".$res;
}

function get_sender_recipient_details($payment_id, $transaction_id){
    $conn = dbconnection();
    $query="SELECT sender_name,sender_email,reci_name,reci_email FROM tbl_gift_voucher
 			WHERE id=$payment_id AND transaction_id='$transaction_id'";
    $conn->set_charset("utf8");
    $query_vals    = mysqli_query($conn,$query);
    $numrows = mysqli_num_rows($query_vals);
    $result_final = mysqli_query($conn,$query);
    $user_details=[];
    if($numrows>0){
        while($result = mysqli_fetch_array($result_final)){
            $user_details['sender_name']=$result['sender_name'];
            $user_details['sender_email']=$result['sender_email'];
            $user_details['reci_name']=$result['reci_name'];
            $user_details['reci_email']=$result['reci_email'];
        }
        return $user_details;
    } else {
        return FALSE;
    }
}

function giftVoucherValid(){
    $conn=dbconnection();
    $voucherID = mysqli_real_escape_string($conn,$_POST['voucherID']);
    $stmt ="SELECT  `voucher_amount`,`remaining_amount`,`reci_email` from tbl_gift_voucher WHERE voucher_code='".$voucherID."'";
    $result  = mysqli_query($conn,$stmt);
    $row_count = mysqli_num_rows($result);
    $result_row  = mysqli_fetch_array($result);
    if($row_count>0){
        $voucher_amount = $result_row['voucher_amount'];
        $remaining_amount = $result_row['remaining_amount'];
        $recipient_email = $result_row['reci_email'];
        if($remaining_amount==0){
            echo "2";
        }else if($_SESSION['resultEmail']!=$recipient_email){
            echo "1";
		}
    }else{
        echo "1";
    }

}

function get_gift_voucher_discount($voucherID){
    $conn=dbconnection();
    $stmt ="SELECT  `voucher_amount`,`remaining_amount` from tbl_gift_voucher WHERE voucher_code='".$voucherID."'";
    $result  = mysqli_query($conn,$stmt);
    $row_count = mysqli_num_rows($result);
    $result_row  = mysqli_fetch_array($result);
    if($row_count>0){
        $voucher_amount = $result_row['voucher_amount'];
        $remaining_amount = $result_row['remaining_amount'];

    }else{
        $remaining_amount="";
    }
    return $remaining_amount;
}

function updateRemainingAmount($voucher_id,$remaining_amount)
{
    $conn = dbconnection();
    $stmt = "UPDATE tbl_gift_voucher 
                        SET remaining_amount=$remaining_amount
                        WHERE voucher_code = '$voucher_id'";
    $conn->query($stmt);
}

?>
