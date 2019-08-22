<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
$action = (isset($_REQUEST['ajax_task'])&& $_REQUEST['ajax_task'] !=NULL)?$_REQUEST['ajax_task']:'';
if($action == 'search_filter_design'){
	$seo1 = $_POST['seo_1'];
	$seo2 = $_POST['seo_2'];
	$seo3 = $_POST['seo_3'];
    $conn=dbconnection();
    
    if(isset($_POST['orderNumbers']) && $_POST['orderNumbers']!=""){
		$per_page = $_POST['orderNumbers'];
	}else{
		$per_page = 24;
	}
	$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	$adjacents  = 4; //gap between pages after number of adjacents
	$offset = ($page - 1) * $per_page;
	
   $keyword  =  mysqli_real_escape_string($conn,$_POST['search']);;
	        $catList  =  mysqli_real_escape_string($conn,$_POST['catList']);
            $keyword = trim($keyword);
            $search_condition = '';
            $orderCondition = "";
            $keywordArray = @explode(' ',$keyword);
            $keywordArraySize = sizeof($keywordArray);
            $fromPrice=$_POST['fromPrice'];
            $toPrice=$_POST['toPrice'];

            if($keywordArraySize<2 && strlen($keyword)<=3){
            $orderConditionAdditional = " WHEN Title like '$keyword%' THEN 10000";
            }
            else{
                $orderConditionAdditional = '';
            }
             if($keyword !=""){   
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
            }else{
                $search_condition = " (Title like '$keyword' OR Title like '$keyword%' OR Title like '%$keyword%' or Title like '%$keyword') ";
                $orderCondition = " CASE $orderConditionAdditional WHEN Title like '$keyword' THEN 5 WHEN Title like '$keyword%' THEN 4 WHEN Title like '%$keyword%' THEN 3 WHEN Title like '%$keyword' THEN 3 ELSE 1 END DESC ";
            }

            $orderby = 'ORDER BY '. $orderCondition;
             $searchcond ='AND '. $search_condition;
          } else{
           $search_condition ="";
            $orderby = "";

            $searchcond ="";
          }


            
            $myWhere = 'product_status = 0 ';
            if($catList==""){
				$catWhere = "";
			}else{
				$catWhere = "and cat_id ='$catList'";
			}

            if(isset($fromPrice) && $fromPrice!="" && isset($toPrice) && $toPrice!=""){
                $priceJOIN=" LEFT JOIN ( SELECT productId,price FROM tbl_product_price WHERE id!='') pr ON p.ProductID=pr.productId ";
                $priceWhere =" AND (pr.price BETWEEN ".$fromPrice." AND ".$toPrice.")";
            }else{
                $priceWhere="";
                $priceJOIN="";
            }

            $query="SELECT p.ProductID,product_alis_link,Title,Description FROM tbl_products p";
            $query .=" $priceJOIN where $myWhere $catWhere $searchcond $priceWhere";
            $query .=" $orderby ";
          mysqli_set_charset($conn,"utf8");
      $result=mysqli_query($conn,$query);
       $numrows = mysqli_num_rows($result);

       /*$ip = getenv('HTTP_CLIENT_IP')?:
getenv('HTTP_X_FORWARDED_FOR')?:
getenv('HTTP_X_FORWARDED')?:
getenv('HTTP_FORWARDED_FOR')?:
getenv('HTTP_FORWARDED')?:
getenv('REMOTE_ADDR');
 if($ip=="103.227.97.51"){
  
 }*/
	//loop through fetched data
	if($numrows>0){
		$total_pages = ceil($numrows/$per_page);
		$query. " LIMIT ".$offset.",".$per_page."";
	$result_final = mysqli_query($conn,$query. " LIMIT ".$offset.",".$per_page."");
	$bgcolor="#EEEEEE"; ?>

     <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
          <div class="aa-product-catg-content">
            <div class="aa-product-catg-head">
              <div class="aa-product-catg-head-left">
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
                <span class="aa-product-price">KES <?php echo amountformat(sigleprice($ProductID)); ?>.00</span>
            <?php } else{ ?>
                <span class="aa-product-price" style="margin-left: -20px;">KES <?php echo amountformat(sigleprice($ProductID)-$discounts['discount_amount']); ?>.00</span>
                <br><span class="" style="text-decoration: line-through">KES <?php echo amountformat(sigleprice($ProductID)); ?>.00</span>
                <span style="font-size:16px;color: green;margin-left: 10px;"><?php echo $discounts['discount_percentage']."%";?></span>
            <?php }?>
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
