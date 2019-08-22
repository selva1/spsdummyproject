<?php
$conn=dbconnection();
$seo1 = utf8_urldecode($seo1);
$query = "SELECT SQL_NO_CACHE p.ProductID,p.Title,p.Description,p.product_alis_link,p.product_status,p.cat_id FROM tbl_products p where p.ProductID!='' and product_alis_link='".$seo1."' order by p.ProductID ASC";
$conn->set_charset("utf8");
$query_vals    = mysqli_query($conn,$query);
$numrows = mysqli_num_rows($query_vals);
$result = mysqli_fetch_array($query_vals);
$ProductID        = $result['ProductID'];
$Title            = $result['Title'];
$Description      = $result['Description'];
$category          = $result['cat_id'];
$product_status      = $result['product_status'];
$product_alis_link  = $result['product_alis_link'];
$overalldiscount  = $result['overalldiscount'];
$Description = str_replace("<div>","",$Description);
$Description = str_replace("</div>","",$Description);
$Description = sanitize_parse($Description);

if(isset($_SESSION['userid'])){
    $user_id=$_SESSION['userid'];
}
else{
    $user_id="";
}

$avg_ratings=get_average_rating($ProductID);
$all_reviews=get_all_reviews($ProductID);
$all_specifications=get_specifications($ProductID);
$discounts=getDiscounts($ProductID);

if(!isset($_SESSION['userid'])) {
    $write_review_url = SITE_URL . "login/?isFromReview=1&product_id=$ProductID";
    $is_ratings_done=0;
}
else {
    $write_review_url = SITE_URL . "write-review";
    $is_ratings_done=get_ratings_for_user($user_id,$ProductID);
}

function get_average_rating($product_id){
    $conn=dbconnection();
    $query = "SELECT AVG(ratings) as avg_ratings FROM tbl_product_ratings where product_id=$product_id";
    $conn->set_charset("utf8");
    $query_vals    = mysqli_query($conn,$query);
    $result = mysqli_fetch_row($query_vals);
    return $result[0];
}
function get_all_reviews($product_id){
    $conn=dbconnection();
    if($order=1)
        $query = "SELECT * FROM tbl_product_ratings pr
              INNER JOIN hm_users u 
              ON u.id=pr.user_id
              where pr.product_id=$product_id ";

    $conn->set_charset("utf8");
    $resCategory=$conn->query($query);
    $review_data=[];
    if ($resCategory->num_rows > 0) {
        while($rowCategories = $resCategory->fetch_assoc()) {
            $review_data[]=$rowCategories;
        }
    }
    return $review_data;
}
function get_specifications($product_id){
    $conn=dbconnection();
    $query = "SELECT *,ps.id as pro_spec_id,cs.id as cat_spec_id 
              FROM `tbl_category_specification_list` cs 
		      INNER JOIN tbl_product_specifications ps
		      ON ps.feature_property_id=cs.id
		      WHERE ps.product_id=$product_id";
    $conn->set_charset("utf8");
    $resCategory=$conn->query($query);
    $specification_data=[];
    if ($resCategory->num_rows > 0) {
        while($rowCategories = $resCategory->fetch_assoc()) {
            $specification_data[]=$rowCategories;
        }
    }
    return $specification_data;
}

function get_recomonded_products_new($product_id,$category_id){
    $conn=dbconnection();
    $query = "SELECT  SQL_NO_CACHE p.ProductID,p.Title,p.product_alis_link,p.product_status,p.cat_id FROM tbl_products p
		      WHERE p.ProductID!=$product_id AND p.cat_id=$category_id AND product_status=0 ORDER BY rand() ";
    $conn->set_charset("utf8");
    $resCategory=$conn->query($query);
    $recommendation_data=[];
    if ($resCategory->num_rows > 0) {
        while($rowCategories = $resCategory->fetch_assoc()) {
            $recommendation_data[]=$rowCategories;
        }
    }

    return $recommendation_data;
}

function get_ratings_for_user($user_id,$product_id){
    $conn=dbconnection();
    $query="SELECT * FROM `tbl_product_ratings` 
 			WHERE user_id = $user_id AND product_id=$product_id";
    $conn->set_charset("utf8");
    $result=$conn->query($query);
    if ($result->num_rows==0) {
            return false;
        }
        else{
            return true;
        }
}

$pricelist = sigleProductPriceDisplays($ProductID);
$bestoffer = getrecommentedproduct($category);

?>
      <section class="pt-3 pb-3 page-info section-padding border-bottom bg-white">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <a href="#"><strong><span class="mdi mdi-home"></span> Home</strong></a> <span class="mdi mdi-chevron-right"></span> <a href="#">Fruits & Vegetables</a> <span class="mdi mdi-chevron-right"></span> <a href="#">Fruits</a>
               </div>
            </div>
         </div>
      </section>
      <section class="shop-single section-padding pt-3">
         <div class="container">
            <div class="row">
               <div class="col-md-6">
                  <div class="shop-detail-left">
                     <div class="shop-detail-slider">
                        <div class="favourite-icon">
                           <a class="fav-btn" title="" data-placement="bottom" data-toggle="tooltip" href="#" data-original-title="<?php echo $pricelist['discount_percentage']; ?>% OFF"><i class="mdi mdi-tag-outline"></i></a>
                        </div>
                        <!-- <div id="sync1" class="owl-carousel"> -->
                        <?php $Prod_img = sigleProductImageDisplays($ProductID); 
						         foreach($Prod_img['productImg'] as $Prod_imgRrows){
						      ?>
                           <div class="item"><img alt="<?php echo $Title; ?>" src="<?php echo SITE_URL;?><?php echo $Prod_imgRrows->img_link;?>" class="img-fluid img-center"></div>
                        <?php } ?>
                           <!-- <div class="item"><img alt="" src="img/item/2.jpg" class="img-fluid img-center"></div>
                           <div class="item"><img alt="" src="img/item/3.jpg" class="img-fluid img-center"></div>
                           <div class="item"><img alt="" src="img/item/4.jpg" class="img-fluid img-center"></div>
                           <div class="item"><img alt="" src="img/item/5.jpg" class="img-fluid img-center"></div>
                           <div class="item"><img alt="" src="img/item/6.jpg" class="img-fluid img-center"></div> -->
                        <!-- </div> -->
                        <!-- <div id="sync2" class="owl-carousel">
                           <div class="item"><img alt="" src="img/item/1.jpg" class="img-fluid img-center"></div>
                           <div class="item"><img alt="" src="img/item/2.jpg" class="img-fluid img-center"></div>
                           <div class="item"><img alt="" src="img/item/3.jpg" class="img-fluid img-center"></div>
                           <div class="item"><img alt="" src="img/item/4.jpg" class="img-fluid img-center"></div>
                           <div class="item"><img alt="" src="img/item/5.jpg" class="img-fluid img-center"></div>
                           <div class="item"><img alt="" src="img/item/6.jpg" class="img-fluid img-center"></div>
                        </div> -->
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="shop-detail-right">
                           <?php if($overalldiscount){ ?><span class="badge badge-success"><?php echo $pricelist['overalldiscount'];?>% OFF</span> <?php } ?>
                     <h2><?php echo $Title; ?></h2>
                     <!-- <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - <?php //echo $pricelist['weight']; ?></h6> -->
                   
                   <?php $multiprice = multiprice($ProductID,''); 
                     // print_r($multiprice['pricelist']);
                  foreach($multiprice['pricelist'] as $multipricerow){?>
                    <div style="float:left; margin:0px;width:100%">
                  <div style="float: left;width: 44%;margin: 14px 0px 0px 10px;font-size: 18px;">
                  <?php $dash=" - "; $weight = $multipricerow->weight; if($weight!=""){ echo $weight.$dash; } ?>Rs. <?php if($multipricerow->discount_amount==0){ echo $multipricerow->price;}else{echo $multipricerow->discount_amount; ?>  (<span style="text-decoration: line-through;"> Rs. <?php echo $multipricerow->price;  ?> </span> ) <?php } ?>
                  </div>
                  <div style="float: left;width: 26%;margin: 0px 0px;">
                     <span class="input-group-btn" style="float: left;margin-top: -11px;margin-right: 3px;margin-left: 3px;"><button class="btn btn-theme-round btn-number qty_minus" onclick="updateCartAjax('minus',<?php echo $multipricerow->id; ?>);"  type="button" style="float:left;padding: 0px 7px;">-</button></span>
                     <input type="text" style="width: 24px;text-align: center;height: 24px;padding: 0px;float: left;margin-top: 15px;" value="1" id="product_qty<?php echo $multipricerow->id; ?>" name="product_qty" class="product_qty_desi">
                     <!-- <input type="text" max="10" min="1" value="1" class="form-control border-form-control form-control-sm input-number" name="quant[1]"> -->
                     <span class="input-group-btn" style="float:left;margin-top: -11px; margin-left:2px;"><button class="btn btn-theme-round btn-number qty_plus" type="button" onclick="updateCartAjax('plus',<?php echo $multipricerow->id; ?>);" style="float:left;padding: 0px 7px;">+</button>
                     </span>
                  </div>
                  <div style="float:left;">
                  <button type="button" style="margin: 4px 0px 0px 0px;padding: 10px;" class="btn btn-secondary btn-sm float-right" onclick="addToCart1('<?php echo $multipricerow->id; ?>','<?php echo $ProductID; ?>');"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
                  </div>
                  </div>
                  <?php } ?>
                
                     <!-- <p class="regular-price"><i class="mdi mdi-tag-outline"></i> MRP : Rs <?php echo $pricelist['price']; ?></p>
                     <p class="offer-price mb-0">Discounted price : <span class="text-success">Rs <?php echo $pricelist['discount_amount']; ?></span></p>
                     <a href="checkout.html"><button type="button" class="btn btn-secondary btn-lg"><i class="mdi mdi-cart-outline"></i> Add To Cart</button> </a> -->
                     <div class="short-description" style="float:left;">
                        <h5>
                           Quick Overview  
                           <p class="float-right">Availability: <span class="badge badge-success">In Stock</span></p>
                        </h5>
                      <?php  echo $str=html_entity_decode(stripslashes($Description)); ?>
                        <!-- <p><b>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</b> Nam fringilla augue nec est tristique auctor. Donec non est at libero vulputate rutrum.
                        </p>
                        <p class="mb-0"> Vivamus adipiscing nisl ut dolor dignissim semper. Nulla luctus malesuada tincidunt. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hiMenaeos. Integer enim purus, posuere at ultricies eu, placerat a felis. Suspendisse aliquet urna pretium eros convallis interdum.</p> -->
                     </div>
                     <h6 class="mb-3 mt-4">Why shop <?php echo $Title; ?> from spsbrands.com ?</h6>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="feature-box">
                              <i class="mdi mdi-truck-fast"></i>
                              <h6 class="text-info">Free Delivery</h6>
                              <p>All Over India</p>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="feature-box">
                              <i class="mdi mdi-basket"></i>
                              <h6 class="text-info">100% Satisfaction </h6>
                              <p>Guarantee</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <section class="product-items-slider section-padding bg-white border-top">
         <div class="container">
            <div class="section-header">
               <h5 class="heading-design-h5">Best Offers View <!-- <span class="badge badge-primary">20% OFF</span> -->
                  <!-- <a class="float-right text-secondary" href="shop.html">View All</a> -->
               </h5>
            </div>
            <div class="owl-carousel owl-carousel-featured">
            <?php     foreach($bestoffer['allresult'] as $bestofferRow){
               $ProductID = $bestofferRow->ProductID;
               $discounts=getDiscounts($ProductID);
               $imgLink = sigleImgThumb($ProductID);
               $pricelist = sigleProductPriceDisplays($ProductID);
               ?>
               <div class="item">
                  <div class="product">
                  <div class="product-header">
                          <?php if($pricelist['overalldiscount']){?> <span class="badge badge-success"><?php echo $pricelist['overalldiscount']; ?>% OFF</span> <?php } ?>
                           <a href="<?php echo $bestofferRow->product_alis_link; ?>"> <img class="img-fluid" src="<?php echo SITE_URL;?><?php echo $imgLink; ?>" alt="<?php echo $bestofferRow->Title; ?>"> </a>
                           <span class="veg text-success mdi mdi-circle"></span>
                        </div>
                        <div class="product-body">
                        <h5><?php echo $bestofferRow->Title; ?></h5>
                        <?php // $pricelistdata = multiprice($ProductID,'');
                          //  print_r($pricelistdata);
                       ?>

                  <select id="multiselect_<?php echo $ProductID; ?>" style="width: 64%;margin-bottom: 10px;float: left;font-size: 11px;">
                  <?php $multiprice = multiprice($ProductID,''); 
                  foreach($multiprice['pricelist'] as $multipricerow){ ?>
                  <option value="<?php echo $multipricerow->id; ?>"><?php $dash=" - "; $weight = $multipricerow->weight; if($weight!=""){ echo $weight.$dash; } ?> Rs. <?php echo $multipricerow->price; ?> </option>
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
                           <button type="button" class="btn btn-secondary btn-sm float-right" onclick="addToCart('<?php echo $ProductID; ?>');"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
                           <p class="offer-price mb-0"><a href="<?php echo $bestofferRow->product_alis_link; ?>">View Info</a><br><span class="regular-price"><a href="cart">View Cart</a></span></p>
                        </div>
                     <!-- </a> -->
                  </div>
               </div>


            <?php } ?>
       
            </div>
         </div>
      </section>
