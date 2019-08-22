<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
$action = (isset($_REQUEST['ajax_task'])&& $_REQUEST['ajax_task'] !=NULL)?$_REQUEST['ajax_task']:'';

if($action == 'get_gift_list'){
	$seo1 = $_POST['seo_1'];
	$seo2 = $_POST['seo_2'];
	$seo3 = $_POST['seo_3'];
    $cat_id = getCatId($seo2);
    $parentzero = zeroParentCatId($cat_id);

	$fromPrice=$_POST['fromPrice'];
	$toPrice=$_POST['toPrice'];
    $catTypesValue;
    if($parentzero=="dsd"){
		$cat_id = getMainsubcat($cat_id,$catTypesValue);
		foreach($cat_id['subcatids'] as $subs_listingRrows){ 
		$subarray[] = $subs_listingRrows->category_id;
		}
		$cat_id = implode(",",$subarray);
		}else{
		$cat_id = $cat_id;
	}


$conn=dbconnection();	
if($search_val!=""){
 $wherecaseselect = " and fpc.doctor_id='".$search_val."' "; 
}	
     $act = $_POST['search_val'];
  
      if($act=="list-catg"){
	  	$listClass="list";
	  	$fistClass="Actives";
	  }
	  if($act=="grid-catg"){
	  	$listClass="";
	  	$scondClass="Actives";
	  }
  
	//pagination variables
	$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	/* pagenation lime based on table start */
	

	if(isset($_POST['allcolorVals']) && $_POST['allcolorVals']!=""){
		$allcolorVals = $_POST['allcolorVals'];
		$allcolorValsWhere ="and p.Color IN ($allcolorVals)";
		 $allColorArray  = explode(",",$allcolorVals);
		
	}else{
		$allcolorValsWhere ="";
		
	}
	if(isset($_POST['allBandVals']) && $_POST['allBandVals']!=""){
		$allBandVals = $_POST['allBandVals'];
		$allBandValsWhere ="and p.Brand IN ($allBandVals)";
		$allBandValsArray  = explode(",",$allBandVals);
		
	}else{
		
		$allBandValsWhere ="";
	}

    if(isset($cat_id) && $cat_id!=""){
		$cattovalueWhere =" and p.cat_id IN($cat_id)";
	}else{
		$cattovalueWhere ="";	
	}
	
	 if(isset($_POST['orderNumbers']) && $_POST['orderNumbers']!=""){
		$per_page = $_POST['orderNumbers'];
	}else{
		$per_page = 24;
	}
	 /*if(isset($_POST['sortBy']) && $_POST['sortBy']!=""){
		
		if($_POST['sortBy']=="Price"){
			$sortbytovalueWhere =" order by p.ProductID";	
		}else if($_POST['sortBy']=="Date"){
			$sortbytovalueWhere =" order by p.ProductID";	
		}
		
	}else{
		
		$sortbytovalueWhere ="order by p.ProductID";	
		
	}*/
	if(isset($fromPrice) && $fromPrice!="" && isset($toPrice) && $toPrice!=""){
		$priceWhere =" AND (pr.price BETWEEN ".$fromPrice." AND ".$toPrice.")";
	}else{
		$priceWhere="";
	}
	
	/* pagenation lime based on table end */
	//$per_page = 1; //how much records you want to show
	$adjacents  = 4; //gap between pages after number of adjacents
	$offset = ($page - 1) * $per_page;
	

    $leftsideSearchwhereCase = $allBandValsWhere." ".$allcolorValsWhere ;

    $query = "SELECT SQL_NO_CACHE p.ProductID,p.Title,p.Description,b.Brand as Brands, jp.Color as Color_val,c.category_id,p.product_alis_link FROM tbl_products p 
	LEFT JOIN ( SELECT id,color FROM tbl_colors WHERE id!='') jp ON p.Color=jp.id 
	LEFT JOIN ( SELECT id,brand FROM tbl_brands WHERE id!='') b ON p.Brand=b.id 
	LEFT JOIN ( SELECT category_id,category_name FROM tbl_category WHERE category_id!='') c ON p.cat_id=c.category_id
	LEFT JOIN ( SELECT productId,price FROM tbl_product_price WHERE id!='') pr ON p.ProductID=pr.productId 
	where p.ProductID!=''  ".$cattovalueWhere." ".$allcolorValsWhere."  ".$allBandValsWhere."  ".$priceWhere." AND `product_status`=0  order by p.ProductID DESC";
	 $conn->set_charset("utf8");
	$query_vals    = mysqli_query($conn,$query);
    $numrows = mysqli_num_rows($query_vals);
    $total_pages = ceil($numrows/$per_page);
	$result_final = mysqli_query($conn,$query. " LIMIT ".$offset.",".$per_page."");
	//loop through fetched data
	if($numrows>0){
	$bgcolor="#EEEEEE"; ?>

     <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
          <div class="aa-product-catg-content">
            <div class="aa-product-catg-head">
              <div class="aa-product-catg-head-left">
               <!-- <form action="" class="aa-sort-form">
                  <label for="">Sort by</label>
                  <select name="sortBy" id="sortBy" onchange="FilterCheckbox();">
                    <option value="" >Please select sort by</option>
                   
                    	<?php $arrayOfnames = array( "Price", "Date"); 
					$arralength = count($arrayOfnames);
					for($x = 0; $x < $arralength; $x++) {
						if($arrayOfnames[$x]==$_POST['sortBy']){
							$sortbyselect="selected=selected";
						}else {
							$sortbyselect="";
						}
						
						 ?>
					<option value="<?php  echo $arrayOfnames[$x]; ?>" <?php echo $sortbyselect; ?> ><?php  echo $arrayOfnames[$x]; ?></option>
					<?php }  ?>
                  </select>
                </form>-->
                <form action="" class="aa-show-form">
                  <label for="">Show</label>
                  <select name="" name="orderNumbers" id="orderNumbers" onchange="FilterCheckbox();">
					<?php $arrayOfNumber = array("24", "12", "36", "48");
					$arrlength = count($arrayOfNumber);
					for($x = 0; $x < $arrlength; $x++) {
						if($arrayOfNumber[$x]==$_POST['orderNumbers']){
							$sortbyselect="selected=selected";
						}else {
							$sortbyselect="";
						}
						
						 ?>
					<option value="<?php  echo $arrayOfNumber[$x]; ?>" <?php echo $sortbyselect; ?> ><?php  echo $arrayOfNumber[$x]; ?></option>
					<?php }  ?>
                   
                    <!--<option value="24">24</option>
                    <option value="36">36</option>-->
                  </select>
                </form>
              </div>
              <div class="aa-product-catg-head-right">
                <a id="grid-catg" href="#" class="<?php echo $scondClass; ?>" ><span class="fa fa-th"></span></a>
                <a id="list-catg" href="#" class="<?php echo $fistClass; ?>" ><span class="fa fa-list"></span></a>
              </div>
            </div>
            <div class="aa-product-catg-body">
              <ul class="aa-product-catg <?php echo $listClass; ?>">
	<?php
	$i=1;
while($result = mysqli_fetch_array($result_final)){
			if($bgcolor=='#EEEEEE'){
			 $bgcolor='#fff';
		}else {
			 $bgcolor='#EEEEEE';
		  }
		$ProductID        = $result['ProductID'];
		$Title            = $result['Title'];
	    $Description      =$result['Description'];
		$Brands  	      = $result['Brands'];
		$product_alis_link  = $result['product_alis_link'];
		
		$Description = str_replace("<div>","",$Description);
		$Description = str_replace("</div>","",$Description);
	    $discounts=getDiscounts($ProductID);
		?>
		<li>
			<figure>
			<a class="aa-product-img" href="<?php echo SITE_URL;?><?php echo $product_alis_link; ?>">
			<?php $imgLink = sigleImgThumb($ProductID); if($imgLink=="0") {?>
			<img src="<?php echo SITE_URL;?>assets/img/No-Image.jpg"  width="250" height="250" alt="<?php echo $Title; ?>">
			<?php } else { ?>
			<img src="<?php echo SITE_URL;?><?php echo $imgLink; ?>"  width="250" height="250" alt="<?php echo $Title; ?>">
			<?php } ?>
			</a>
			 <a class="aa-add-card-btn" href="javascript:void(0);" onclick="addToCart('<?php echo $ProductID; ?>');"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
			<figcaption>
			<h4 class="aa-product-title"><a href="<?php echo SITE_URL;?><?php echo $product_alis_link; ?>"><?php echo $Title; ?></a></h4>
            <?php if(empty($discounts) || ($discounts['discount_amount']==NULl && $discounts['discount_percentage']==NULL)){ ?>
                <span class="aa-product-price">KES <?php echo amountformat(sigleprice($ProductID)); ?>.00</span><!--<span class="aa-product-price"><del>$65.50</del></span>-->
            <?php } else{ ?>
                <span class="aa-product-price" style="margin-left: -20px;">KES <?php echo amountformat(sigleprice($ProductID)-$discounts['discount_amount']); ?>.00</span>
                <br><span class="" style="text-decoration: line-through">KES <?php echo amountformat(sigleprice($ProductID)); ?>.00</span>
                <span style="font-size:16px;color: green;margin-left: 10px;"><?php echo $discounts['discount_percentage']."%";?></span>
            <?php }?>
                                                                                                                <!--<a class="aa-add-card-btn" href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>-->
			<div class="aa-product-descrip">
			<div class="productDescrTittle">Description : </div>
			<?php echo  sanitize_parse($Description); ?>
				
			</div>
			</figcaption>
			</figure>                         
			<div class="aa-product-hvr-content">
			<a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
			<!--<a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>-->
			<!--<a href="<?php echo SITE_URL;?><?php echo $product_alis_link; ?>" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-eye" aria-hidden="true"></span></a> -->  
				<a href="<?php echo SITE_URL;?><?php echo $product_alis_link; ?>" ><span class="fa fa-eye" aria-hidden="true"></span></a>                         
			</div>
			<!-- product badge -->
			<span id="SavaCartval_<?php echo $ProductID;  ?>" class="cartsuccess">successfully added</span>
			<span class="aa-badge aa-sale" href="#">SALE!</span>
			</li>
                     
		
<?php $i++;
} ?>
</ul>
</div>
</div>
<?php 
$search_val =$act;
echo paginateAllCategoryList($reload, $page, $total_pages, $adjacents,$search_val,$per_page,$let_search,$allcolorVals,$allBandVals); ?>

</div>

<?php
} else {
  echo "Sorry, no results matched your search criteria.";
}
?>

<?php 
}
}
?>
<script>
	jQuery("#list-catg").click(function(e){
   // e.preventDefault(e);
    jQuery(".aa-product-catg").addClass("list");
    jQuery("#list-catg").addClass("Actives");
    jQuery("#grid-catg").removeClass("Actives");
  });
  jQuery("#grid-catg").click(function(e){
    //e.preventDefault(e);
    jQuery(".aa-product-catg").removeClass("list");
     jQuery("#grid-catg").addClass("Actives");
     jQuery("#list-catg").removeClass("Actives");
  });
  
</script>
<style>.Actives .fa-list {
  color: red;
}
.cartsuccess {
  color: red;
  float: left;
  margin-top: 34px;
  text-align: center;
  width: 100%;
  display: none;
}</style>
