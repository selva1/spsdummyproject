<?php
$main_sliders = homeMainSlider($catTypesValue);
//print_r($main_sliders);
$homeproductlists = homedefalutlist();
$dryfurits = new_product('1');
$newproductlist = new_product('2');
$Millets = new_product('3');
$Herbs = new_product('4');
$Wood = new_product('5');
$Masala = new_product('6');
$Hand = new_product('7');
$Seeds = new_product('8');
$Offers = new_product('9');
?>

<section class="carousel-slider-main text-center border-top border-bottom bg-white">
   <div class="owl-carousel owl-carousel-slider">
      <?php     foreach($main_sliders['allresult'] as $mainSlidersRow){ ?>
      <div class="item">
         <a href="<?php echo $mainSlidersRow->blog_link; ?>"><img class="img-fluid" src="<?php echo $mainSlidersRow->img; ?>" alt="<?php echo $mainSlidersRow->title; ?>"></a>
      </div>
      <?php } ?>
   </div>
</section>
<section class="top-category section-padding">
         <div class="container">
            <div class="owl-carousel owl-carousel-category">
            <?php 
            $conn=dbconnection();
            $parent = 0;
            $sqlCategory = "SELECT 	category_id,category_name,parent_id,cat_alias,img_link FROM tbl_category WHERE parent_id = $parent  ORDER BY category_id ASC";
            $resCategory=$conn->query($sqlCategory);
            if ($resCategory->num_rows > 0) {
                while($rowCategories = $resCategory->fetch_assoc()) {?>
                  <div class="item">
                  <div class="category-item">
                     <a href="<?php echo $rowCategories['cat_alias']; ?>">
                        <?php if($rowCategories['img_link']!=""){
                           $img_link =$rowCategories['img_link'];
                         }else{
                           $img_link ="img/small/1.jpg";
                         } ?>
                        <img class="img-fluid" src="<?php echo $img_link; ?>" alt="">
                        <h6><?php echo $rowCategories['category_name']; ?></h6>
                        <!-- <p>150 Items</p> -->
                     </a>
                  </div>
               </div>
                    <!-- $category_tree_array[] = array("category_id" => $rowCategories['category_id'], "name" =>$rowCategories['category_name'], "cat_alias" =>$rowCategories['cat_alias']); -->
                <?php }
            } ?>
               <!-- <div class="item">
                  <div class="category-item">
                     <a href="shop.html">
                        <img class="img-fluid" src="img/small/1.jpg" alt="">
                        <h6>Fruits & Vegetables</h6>
                        <p>150 Items</p>
                     </a>
                  </div>
               </div>
               <div class="item">
                  <div class="category-item">
                     <a href="shop.html">
                        <img class="img-fluid" src="img/small/2.jpg" alt="">
                        <h6>Grocery & Staples</h6>
                        <p>95 Items</p>
                     </a>
                  </div>
               </div>
               <div class="item">
                  <div class="category-item">
                     <a href="shop.html">
                        <img class="img-fluid" src="img/small/3.jpg" alt="">
                        <h6>Beverages</h6>
                        <p>65 Items</p>
                     </a>
                  </div>
               </div>
               <div class="item">
                  <div class="category-item">
                     <a href="shop.html">
                        <img class="img-fluid" src="img/small/4.jpg" alt="">
                        <h6>Home & Kitchen</h6>
                        <p>965 Items</p>
                     </a>
                  </div>
               </div>
               <div class="item">
                  <div class="category-item">
                     <a href="shop.html">
                        <img class="img-fluid" src="img/small/5.jpg" alt="">
                        <h6>Furnishing & Home Needs</h6>
                        <p>125 Items</p>
                     </a>
                  </div>
               </div>
               <div class="item">
                  <div class="category-item">
                     <a href="shop.html">
                        <img class="img-fluid" src="img/small/6.jpg" alt="">
                        <h6>Household Needs</h6>
                        <p>325 Items</p>
                     </a>
                  </div>
               </div>
               <div class="item">
                  <div class="category-item">
                     <a href="shop.html">
                        <img class="img-fluid" src="img/small/7.jpg" alt="">
                        <h6>Personal Care</h6>
                        <p>156 Items</p>
                     </a>
                  </div>
               </div>
               <div class="item">
                  <div class="category-item">
                     <a href="shop.html">
                        <img class="img-fluid" src="img/small/8.jpg" alt="">
                        <h6>Breakfast & Dairy</h6>
                        <p>857 Items</p>
                     </a>
                  </div>
               </div>
               <div class="item">
                  <div class="category-item">
                     <a href="shop.html">
                        <img class="img-fluid" src="img/small/9.jpg" alt="">
                        <h6>Biscuits, Snacks & Chocolates</h6>
                        <p>48 Items</p>
                     </a>
                  </div>
               </div>
               <div class="item">
                  <div class="category-item">
                     <a href="shop.html">
                        <img class="img-fluid" src="img/small/10.jpg" alt="">
                        <h6>Noodles, Sauces & Instant Food</h6>
                        <p>156 Items</p>
                     </a>
                  </div>
               </div>
               <div class="item">
                  <div class="category-item">
                     <a href="shop.html">
                        <img class="img-fluid" src="img/small/11.jpg" alt="">
                        <h6>Pet Care</h6>
                        <p>568 Items</p>
                     </a>
                  </div>
               </div>
               <div class="item">
                  <div class="category-item">
                     <a href="shop.html">
                        <img class="img-fluid" src="img/small/12.jpg" alt="">
                        <h6>Meats, Frozen & Seafood</h6>
                        <p>156 Items</p>
                     </a>
                  </div>
               </div> -->
            </div>
         </div>
      </section>
      <section class="product-items-slider section-padding">
         <div class="container">
            <div class="section-header">
               <h5 class="heading-design-h5">Dry Fruits   <!--<span class="badge badge-primary">20% OFF</span>-->
                  <!-- <a class="float-right text-secondary" href="shop.html">View All</a> -->
               </h5>
            </div>
            <div class="owl-carousel owl-carousel-featured">

            <?php     
            
            foreach($dryfurits['allresult'] as $bestofferRow){
               $ProductID = $bestofferRow->ProductID;
               $discounts=getDiscounts($ProductID);
               $imgLink = sigleImgThumb($ProductID);
               $pricelist = sigleProductPriceDisplays($ProductID);
               $isstatus = $bestofferRow->product_status;
               ?>
               <div class="item">
                  <div class="product">
                  <div class="product-header">
                          <?php if($bestofferRow->overalldiscount){?> <span class="badge badge-success"><?php echo $bestofferRow->overalldiscount; ?>% OFF</span> <?php } ?>
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
                           <?php } else{ ?>
                           <button type="button" disabled class="btn btn-secondary btn-sm float-right"><i class="mdi mdi-cart-outline"></i> No Stock</button>
                         <?php } ?>
                           <p class="offer-price mb-0"><a href="<?php echo $bestofferRow->product_alis_link; ?>">View Info</a><br><span class="regular-price"><a href="cart">View Cart</a></span></p>
                        </div>
                     <!-- </a> -->
                  </div>
               </div>

            <?php } ?>
            </div>
         </div>
      </section>
      
      <!-- <section class="offer-product">
         <div class="container">
            <div class="row no-gutters">
               <div class="col-md-6">
                  <a href="#"><img class="img-fluid" src="img/ad/1.jpg" alt=""></a>
               </div>
               <div class="col-md-6">
                  <a href="#"><img class="img-fluid" src="img/ad/2.jpg" alt=""></a>
               </div>
            </div>
         </div>
      </section> -->
      <section class="product-items-slider section-padding">
         <div class="container">
            <div class="section-header">
               <h5 class="heading-design-h5">Buy Dry Spices   <!--<span class="badge badge-primary">20% OFF</span>-->
                  <!-- <a class="float-right text-secondary" href="shop.html">View All</a> -->
               </h5>
            </div>
            <div class="owl-carousel owl-carousel-featured">

            <?php     
            
            foreach($newproductlist['allresult'] as $bestofferRow){
               $ProductID = $bestofferRow->ProductID;
               $discounts=getDiscounts($ProductID);
               $imgLink = sigleImgThumb($ProductID);
               $pricelist = sigleProductPriceDisplays($ProductID);
               $isstatus = $bestofferRow->product_status;
               ?>
               <div class="item">
                  <div class="product">
                  <div class="product-header">
                          <?php if($bestofferRow->overalldiscount){?> <span class="badge badge-success"><?php echo $bestofferRow->overalldiscount; ?>% OFF</span> <?php } ?>
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
                           <?php } else{ ?>
                           <button type="button" disabled class="btn btn-secondary btn-sm float-right"><i class="mdi mdi-cart-outline"></i> No Stock</button>
                         <?php } ?>
                           <p class="offer-price mb-0"><a href="<?php echo $bestofferRow->product_alis_link; ?>">View Info</a><br><span class="regular-price"><a href="cart">View Cart</a></span></p>
                        </div>
                     <!-- </a> -->
                  </div>
               </div>

            <?php } ?>
            </div>
         </div>
      </section>

      <section class="product-items-slider section-padding">
         <div class="container">
            <div class="section-header">
               <h5 class="heading-design-h5">Herbs and Spices   <!--<span class="badge badge-primary">20% OFF</span>-->
                  <!-- <a class="float-right text-secondary" href="shop.html">View All</a> -->
               </h5>
            </div>
            <div class="owl-carousel owl-carousel-featured">

            <?php     
            
            foreach($Herbs['allresult'] as $bestofferRow){
               $ProductID = $bestofferRow->ProductID;
               $discounts=getDiscounts($ProductID);
               $imgLink = sigleImgThumb($ProductID);
               $pricelist = sigleProductPriceDisplays($ProductID);
               $isstatus = $bestofferRow->product_status;
               ?>
               <div class="item">
                  <div class="product">
                  <div class="product-header">
                          <?php if($bestofferRow->overalldiscount){?> <span class="badge badge-success"><?php echo $bestofferRow->overalldiscount; ?>% OFF</span> <?php } ?>
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
                           <?php } else{ ?>
                           <button type="button" disabled class="btn btn-secondary btn-sm float-right"><i class="mdi mdi-cart-outline"></i> No Stock</button>
                         <?php } ?>
                           <p class="offer-price mb-0"><a href="<?php echo $bestofferRow->product_alis_link; ?>">View Info</a><br><span class="regular-price"><a href="cart">View Cart</a></span></p>
                        </div>
                     <!-- </a> -->
                  </div>
               </div>

            <?php } ?>
            </div>
         </div>
      </section>
      
      <section class="product-items-slider section-padding">
         <div class="container">
            <div class="section-header">
               <h5 class="heading-design-h5">Millets product ( sirudhaniyam )   <!--<span class="badge badge-primary">20% OFF</span>-->
                  <!-- <a class="float-right text-secondary" href="shop.html">View All</a> -->
               </h5>
            </div>
            <div class="owl-carousel owl-carousel-featured">

            <?php     
            
            foreach($Millets['allresult'] as $bestofferRow){
               $ProductID = $bestofferRow->ProductID;
               $discounts=getDiscounts($ProductID);
               $imgLink = sigleImgThumb($ProductID);
               $pricelist = sigleProductPriceDisplays($ProductID);
               $isstatus = $bestofferRow->product_status;
               ?>
               <div class="item">
                  <div class="product">
                  <div class="product-header">
                          <?php if($bestofferRow->overalldiscount){?> <span class="badge badge-success"><?php echo $bestofferRow->overalldiscount; ?>% OFF</span> <?php } ?>
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
                           <?php } else{ ?>
                           <button type="button" disabled class="btn btn-secondary btn-sm float-right"><i class="mdi mdi-cart-outline"></i> No Stock</button>
                         <?php } ?>
                           <p class="offer-price mb-0"><a href="<?php echo $bestofferRow->product_alis_link; ?>">View Info</a><br><span class="regular-price"><a href="cart">View Cart</a></span></p>
                        </div>
                     <!-- </a> -->
                  </div>
               </div>

            <?php } ?>
            </div>
         </div>
      </section>

      <section class="product-items-slider section-padding">
         <div class="container">
            <div class="section-header">
               <h5 class="heading-design-h5">Wood Pressed Oil   <!--<span class="badge badge-primary">20% OFF</span>-->
                  <!-- <a class="float-right text-secondary" href="shop.html">View All</a> -->
               </h5>
            </div>
            <div class="owl-carousel owl-carousel-featured">

            <?php     
            
            foreach($Wood['allresult'] as $bestofferRow){
               $ProductID = $bestofferRow->ProductID;
               $discounts=getDiscounts($ProductID);
               $imgLink = sigleImgThumb($ProductID);
               $pricelist = sigleProductPriceDisplays($ProductID);
               $isstatus = $bestofferRow->product_status;
               ?>
               <div class="item">
                  <div class="product">
                  <div class="product-header">
                          <?php if($bestofferRow->overalldiscount){?> <span class="badge badge-success"><?php echo $bestofferRow->overalldiscount; ?>% OFF</span> <?php } ?>
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
                           <?php } else{ ?>
                           <button type="button" disabled class="btn btn-secondary btn-sm float-right"><i class="mdi mdi-cart-outline"></i> No Stock</button>
                         <?php } ?>
                           <p class="offer-price mb-0"><a href="<?php echo $bestofferRow->product_alis_link; ?>">View Info</a><br><span class="regular-price"><a href="cart">View Cart</a></span></p>
                        </div>
                     <!-- </a> -->
                  </div>
               </div>

            <?php } ?>
            </div>
         </div>
      </section>
      
      <section class="product-items-slider section-padding">
         <div class="container">
            <div class="section-header">
               <h5 class="heading-design-h5">Masala Powder   <!--<span class="badge badge-primary">20% OFF</span>-->
                  <!-- <a class="float-right text-secondary" href="shop.html">View All</a> -->
               </h5>
            </div>
            <div class="owl-carousel owl-carousel-featured">

            <?php     
            
            foreach($Masala['allresult'] as $bestofferRow){
               $ProductID = $bestofferRow->ProductID;
               $discounts=getDiscounts($ProductID);
               $imgLink = sigleImgThumb($ProductID);
               $pricelist = sigleProductPriceDisplays($ProductID);
               $isstatus = $bestofferRow->product_status;
               ?>
               <div class="item">
                  <div class="product">
                  <div class="product-header">
                          <?php if($bestofferRow->overalldiscount){?> <span class="badge badge-success"><?php echo $bestofferRow->overalldiscount; ?>% OFF</span> <?php } ?>
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
                           <?php } else{ ?>
                           <button type="button" disabled class="btn btn-secondary btn-sm float-right"><i class="mdi mdi-cart-outline"></i> No Stock</button>
                         <?php } ?>
                           <p class="offer-price mb-0"><a href="<?php echo $bestofferRow->product_alis_link; ?>">View Info</a><br><span class="regular-price"><a href="cart">View Cart</a></span></p>
                        </div>
                     <!-- </a> -->
                  </div>
               </div>

            <?php } ?>
            </div>
         </div>
      </section>

      <section class="product-items-slider section-padding">
         <div class="container">
            <div class="section-header">
               <h5 class="heading-design-h5">Seeds   <!--<span class="badge badge-primary">20% OFF</span>-->
                  <!-- <a class="float-right text-secondary" href="shop.html">View All</a> -->
               </h5>
            </div>
            <div class="owl-carousel owl-carousel-featured">

            <?php     
            
            foreach($Seeds['allresult'] as $bestofferRow){
               $ProductID = $bestofferRow->ProductID;
               $discounts=getDiscounts($ProductID);
               $imgLink = sigleImgThumb($ProductID);
               $pricelist = sigleProductPriceDisplays($ProductID);
               $isstatus = $bestofferRow->product_status;
               ?>
               <div class="item">
                  <div class="product">
                  <div class="product-header">
                          <?php if($bestofferRow->overalldiscount){?> <span class="badge badge-success"><?php echo $bestofferRow->overalldiscount; ?>% OFF</span> <?php } ?>
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
                           <?php } else{ ?>
                           <button type="button" disabled class="btn btn-secondary btn-sm float-right"><i class="mdi mdi-cart-outline"></i> No Stock</button>
                         <?php } ?>
                           <p class="offer-price mb-0"><a href="<?php echo $bestofferRow->product_alis_link; ?>">View Info</a><br><span class="regular-price"><a href="cart">View Cart</a></span></p>
                        </div>
                     <!-- </a> -->
                  </div>
               </div>

            <?php } ?>
            </div>
         </div>
      </section>

      <section class="product-items-slider section-padding">
         <div class="container">
            <div class="section-header">
               <h5 class="heading-design-h5">Offers   <!--<span class="badge badge-primary">20% OFF</span>-->
                  <!-- <a class="float-right text-secondary" href="shop.html">View All</a> -->
               </h5>
            </div>
            <div class="owl-carousel owl-carousel-featured">

            <?php     
            
            foreach($Offers['allresult'] as $bestofferRow){
               $ProductID = $bestofferRow->ProductID;
               $discounts=getDiscounts($ProductID);
               $imgLink = sigleImgThumb($ProductID);
               $pricelist = sigleProductPriceDisplays($ProductID);
               $isstatus = $bestofferRow->product_status;
               ?>
               <div class="item">
                  <div class="product">
                  <div class="product-header">
                          <?php if($bestofferRow->overalldiscount){?> <span class="badge badge-success"><?php echo $bestofferRow->overalldiscount; ?>% OFF</span> <?php } ?>
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
                           <?php } else{ ?>
                           <button type="button" disabled class="btn btn-secondary btn-sm float-right"><i class="mdi mdi-cart-outline"></i> No Stock</button>
                         <?php } ?>
                           <p class="offer-price mb-0"><a href="<?php echo $bestofferRow->product_alis_link; ?>">View Info</a><br><span class="regular-price"><a href="cart">View Cart</a></span></p>
                        </div>
                     <!-- </a> -->
                  </div>
               </div>

            <?php } ?>
            </div>
            <p></p>
            <p></p>

            <h1>Online Grocery Shopping</h1>
<p><a href="<?php echo SITE_URL;?>">Spsbrands</a> is The best online grocery store in all over india. Online supermarket for all buy your daily needs of 
<a href="/buy-dry-fruits-online">dry fruits and nuts  </a>, 
<a href="/spices-herbs">spices</a> and 
<a href="/Herbs">herbs</a>, <a href="/buy-sirudhaniyam-Millets-products-online">millets</a>,
 <a href="/WOOD-PRESSED-OIL">wood pressed oil</a>. Online shopping now made easy with a wide range of groceries and home needs.</p>
<h1>Online grocery store in India</h1>
<p>Order online all your favourite products from the low price online supermarket for grocery home delivery all over india.
<a href="<?php echo SITE_URL;?>">spsbrands </a> is a low-price online supermarket that allows you to order products across categories like grocery, dry fruits and nuts, spices and herbs, millets, wood pressed oil  delivered to your doorstep. We offer you the best quality grocery products which you can buy online and have them delivered to you conveniently.
</p>

<p>grocery in delivery below cities and rest of India, Ahmedabad, Bangalore, Chennai, Delhi, Hyderabad, Kolkata, Mumbai, Pune, Agra, Ajmer, Aligarh, Allahabad, Amravati, Amritsar, Asansol, Aurangabad, Bareilly, Belgaum, Bhavnagar, Bhiwandi, Bhopal, Bhubaneswar, Bikaner, Bokaro Steel City, Chandigarh, Coimbatore, Cuttack, Dehradun, Dhanbad, Durg-Bhilai Nagar, Durgapur, Erode, Faridabad, Firozabad, Ghaziabad, Gorakhpur, Gulbarga, Guntur, Gurgaon, Guwahati, Gwalior, Hubli-Dharwad, Indore, Jabalpur, Jaipur, Jalandhar, Jammu, Jamnagar, Jamshedpur, Jhansi, Jodhpur, Kannur, Kanpur,Kakinada Kochi, Kolhapur, Kollam, Kota, Kozhikode, Lucknow, Ludhiana, Madurai, Malappuram, Malegaon, Mangalore, Meerut, Moradabad, Mysore, Nagpur, Nanded-Waghala, Nashik, Nellore, Noida, Patna, Pondicherry, Raipur, Rajkot,Rajahmundry, Ranchi, Rourkela, Salem, Sangli, Siliguri, Solapur, Srinagar, Surat, thiruvananthapuram, Thrissur, Tiruchirappalli, Tiruppur, Tirupati,Ujjain, Vadodara, Varanasi, Vasai-Virar City, Vijayawada, Visakhapatnam, Warangal and then we ship grocery other city also we are providing home delivery all over india through india post.</p>
         </div>
      <style>
      h1{
         font-size:20px;
      }
      </style>  
      </section>