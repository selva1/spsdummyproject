<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
$action = (isset($_REQUEST['ajax_task'])&& $_REQUEST['ajax_task'] !=NULL)?$_REQUEST['ajax_task']:'';
if($action == 'get_category_list'){
	$seo1 = $_POST['seo_1'];
	$seo2 = $_POST['seo_2'];
	$seo3 = $_POST['seo_3'];
    $cat_id = getCatId($seo1);
    $parentzero = zeroParentCatId($cat_id);
    $fromPrice=$_POST['fromPrice'];
    $toPrice=$_POST['toPrice'];

    $catTypesValue;
    if($parentzero=="0"){
		$cat_id = getMainsubcat($cat_id,$catTypesValue);
		foreach($cat_id['subcatids'] as $subs_listingRrows){ 
		$subarray[] = $subs_listingRrows->category_id;
		}
		$cat_id = implode(",",$subarray);
		}else{
		$cat_id = $cat_id;
	}
$sub_cat_id = '';
if($seo2!=''){
 	$sub_cat_id = getCatId($seo2);
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
	 if(isset($_POST['sortBy']) && $_POST['sortBy']!=""){
		
		if($_POST['sortBy']=="Price"){
			$sortbytovalueWhere =" order by p.ProductID";	
		}else if($_POST['sortBy']=="Date"){
			$sortbytovalueWhere =" order by p.ProductID";	
		}
		
	}else{
		
		$sortbytovalueWhere ="order by p.ProductID";	
		
	}
    if(isset($fromPrice) && $fromPrice!="" && isset($toPrice) && $toPrice!="" && $toPrice!="undefined" && $fromPrice!="undefined"){
       $priceWhere =" AND (pr.price BETWEEN ".$fromPrice." AND ".$toPrice.")";
    }else{
        $priceWhere="";
    }
    
	/* pagenation lime based on table end */
	//$per_page = 1; //how much records you want to show
	$adjacents  = 4; //gap between pages after number of adjacents
	$offset = ($page - 1) * $per_page;
	

    $leftsideSearchwhereCase = $allBandValsWhere." ".$allcolorValsWhere ;

    $query = "SELECT SQL_NO_CACHE p.ProductID,p.Title,p.product_status,p.Description,b.Brand as Brands, jp.Color as Color_val,c.category_id,p.product_alis_link FROM tbl_products p 
	LEFT JOIN ( SELECT id,color FROM tbl_colors WHERE id!='') jp ON p.Color=jp.id 
	LEFT JOIN ( SELECT id,brand FROM tbl_brands WHERE id!='') b ON p.Brand=b.id 
	LEFT JOIN ( SELECT category_id,category_name FROM tbl_category WHERE category_id!='') c ON p.cat_id=c.category_id
	LEFT JOIN ( SELECT productId,price FROM tbl_product_price WHERE id!='') pr ON p.ProductID=pr.productId 
	where p.ProductID!=''  ".$cattovalueWhere." ".$allcolorValsWhere."  ".$allBandValsWhere."  ".$priceWhere." AND `product_status`=0 group by p.ProductID order by p.ProductID DESC";

	$conn->set_charset("utf8");
	$query_vals    = mysqli_query($conn,$query);
    $numrows = mysqli_num_rows($query_vals);
    $total_pages = ceil($numrows/$per_page);
	$result_final = mysqli_query($conn,$query. " LIMIT ".$offset.",".$per_page."");
	//loop through fetched data
	if($numrows>0){ ?>

  
	<?php
	$i=1;
while($result = mysqli_fetch_array($result_final)){
	
		$ProductID        = $result['ProductID'];
		$Title            = $result['Title'];
	    $Description      =$result['Description'];
		$Brands  	      = $result['Brands'];
		$product_alis_link  = $result['product_alis_link'];
		$isstatus = $result['product_status'];

		
		$Description = str_replace("<div>","",$Description);
		$Description = str_replace("</div>","",$Description);
		$discounts=getDiscounts($ProductID);
        $imgLink = sigleImgThumb($ProductID);
        $pricelist = sigleProductPriceDisplays($ProductID);
		?>
		
		<div class="col-md-4">
		<div class="product">
			<div class="product-header">
                          <?php if($result['overalldiscount']){?> <span class="badge badge-success"><?php echo $bestofferRow->overalldiscount; ?>% OFF</span> <?php } ?>
                           <a href="<?php echo $product_alis_link; ?>"> <img class="img-fluid" src="<?php echo SITE_URL;?><?php echo $imgLink; ?>" alt="<?php echo $bestofferRow->Title; ?>"> </a>
                           <span class="veg text-success mdi mdi-circle"></span>
                        </div>
                        <div class="product-body">
                        <?php // $pricelistdata = multiprice($ProductID,'');
                          //  print_r($pricelistdata);
                       ?>
                 <a href="<?php echo $product_alis_link; ?>">  <h5><?php echo $Title; ?></h5></a>
				  <select id="multiselect_<?php echo $ProductID; ?>" style="width: 64%;margin-bottom: 10px;float: left;font-size: 11px;">
                  <?php $multiprice = multiprice($ProductID,''); 
                  foreach($multiprice['pricelist'] as $multipricerow){ ?>
                  <option value="<?php echo $multipricerow->id; ?>"><strike><?php $dash=" - "; $weight = $multipricerow->weight; if($weight!=""){ echo $weight.$dash; } ?> Rs. <?php echo $multipricerow->price; ?> <strike></option>
                  <?php } ?>
                  </select>
                     <span class="input-group-btn" style="float: left;margin-top: 2px;margin-right: 2px;margin-left: 3px;"><button class="btn btn-theme-round btn-number qty_minus" onclick="updateCartAjax('minus',<?php echo $ProductID; ?>);"  type="button" style="float:left;padding: 0px 7px;">-</button></span>
                     <input type="text" style="width: 24px;text-align: center;height: 24px;padding:0px;float:left;" value="1" id="product_qty<?php echo $ProductID; ?>" name="product_qty" class="product_qty_desi">
                     <!-- <input type="text" max="10" min="1" value="1" class="form-control border-form-control form-control-sm input-number" name="quant[1]"> -->
                     <span class="input-group-btn" style="float:left;margin-top: 2px; margin-left:2px;"><button class="btn btn-theme-round btn-number qty_plus" type="button" onclick="updateCartAjax('plus',<?php echo $ProductID; ?>);" style="float:left;padding: 0px 7px;">+</button>
                     </span>
					 
                           <!-- <h5><?php
                           // echo $bestofferRow->Title; ?></h5>
                           <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - <?php // echo $pricelist['weight']; ?></h6> -->
                        </div>
                        <div class="product-footer">
							<?php if($isstatus==0){ ?>
								<button type="button" class="btn btn-secondary btn-sm float-right" onclick="addToCart('<?php echo $ProductID; ?>');"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>

							<?php }else{ ?> 
								<button type="button" disabled class="btn btn-secondary btn-sm float-right"><i class="mdi mdi-cart-outline"></i>No Stock</button>

								<?php } ?>
                           <p class="offer-price mb-0"><a href="<?php echo $bestofferRow->product_alis_link; ?>">View Info</a><br><span class="regular-price"><a href="cart">View Cart</a></span></p>
                        </div>
		</div>
		</div>
                     
		
<?php $i++;
} ?>
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
