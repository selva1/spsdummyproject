<?php 
   $seo1;
   $seo2;
   $catTypesValue;
   if($seo1!=""  && $seo2!=""){
   $brand_id = getbrandsId($seo2);
   $cat_id = getCatId($seo1);
    $parentzero = zeroParentCatId($cat_id);
	if($parentzero=="0"){
	    $cat_id = getMainsubcat($cat_id,$catTypesValue);
		foreach($cat_id['subcatids'] as $subs_listingRrows){ 
			$subarray[] = $subs_listingRrows->category_id;
			$cat_id = implode(",",$subarray);
		}
	}
   }else{
   $brand_id = getbrandsId($seo1);
   }
?>
  <section id="aa-product-category">
    <div class="container">
      <div class="row">
      <div id="loadCategorys"></div>
       <div class="col-lg-3 col-md-3 col-sm-4 col-md-pull-9">
          <aside class="aa-sidebar">
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Brand List</h3>
              <ul class="aa-catg-nav scroll-cat">
               <?php 
              
              $category_listing = filterbrandtopList($brand_id,$parentzero,$cat_id);
             foreach($category_listing['allresult'] as $category_listingRrows){ 
             if($brand_id==$category_listingRrows->brandid){
			 	$activescat = "catActives";
			 }else{
			 	$activescat = "";
			 }
			  if($seo1!=""  && $seo2!=""){
			 	$linsa = SITE_URL.$seo1."/".$category_listingRrows->brandalias."/";
			 }else{
			 	$linsa = SITE_URL.$category_listingRrows->brandalias;
			 }
			  	echo '<li class="'.$activescat.'"><a href="'.$linsa.'" >'.$category_listingRrows->bdname.'('.$category_listingRrows->cnt.')</a></li>';
			  }catalias
              
              ?>
              </ul>
            </div>
            <div class="aa-sidebar-widget">
              <h3>category List</h3>
              <ul class="aa-catg-nav">
              <?php 
              
              $band_listing = filterBrandcatsList($brand_id,$parentzero,$cat_id);
             foreach($band_listing['allresult'] as $band_listingRrows){ 
				if(@in_array($band_listingRrows->category_id,$allBandValsArray)) {
				$Selected='checked=checked';
				} else {
				$Selected="";
				}
			  	echo '<li><input type="checkbox" id="brandIds" name="brandIds[]" value="'.$band_listingRrows->category_id.'" onclick="FilterCheckbox();" class="brandvalues" '.$Selected.' /><a href="javascript:void(0);" >'.$band_listingRrows->ctname.'('.$band_listingRrows->cnt.')</a></li>';
			  	
			  }
              
              ?>
              </ul>
            </div>
            
            <div class="aa-sidebar-widget">
              <h3>Color List</h3>
              <ul class="aa-catg-nav">
              <?php 
              $band_listing = filterbrandColorList($brand_id,$parentzero,$cat_id);
             foreach($band_listing['allresult'] as $band_listingRrows){ 
             //print_r($allColorArray);
             if(@in_array($band_listingRrows->colorid,$allColorArray)) {
				$Selected='checked=checked';
				} else {
				$Selected="";
				}
			   		echo '<li ><input type="checkbox" id="colorIds" name="colorIds[]" value="'.$band_listingRrows->colorid.'" onclick="FilterCheckbox();" class="colorvalues" '.$Selected.' /> <a href="javascript:void(0);" >'.$band_listingRrows->clr.'('.$band_listingRrows->cnt.')</a></li>';
			  }
              ?>
              
              </ul>
            </div>
           
            <!-- single sidebar -->
            <!--<div class="aa-sidebar-widget">
              <h3>Shop By Price</h3>              
              <div class="aa-sidebar-price-range">
               <form action="">
                  <div id="skipstep" class="noUi-target noUi-ltr noUi-horizontal noUi-background">
                  </div>
                  <span id="skip-value-lower" class="example-val">30.00</span>
                 <span id="skip-value-upper" class="example-val">100.00</span>
                 <button class="aa-filter-btn" type="submit">Filter</button>
               </form>
              </div>              
            </div>-->
              <div class="aa-sidebar-widget">
                  <h3>Shop By Price</h3>
                  <p class="price_slider">
                      <label id="price" class="price_label"></label>
                      <input type="hidden" id="hdnFromPrice">
                      <input type="hidden" id="hdnToPrice">
                  </p>
                  <div id="brand_slider"></div>
              </div>
           
          </aside>
        </div>

       
      </div>
    </div>
  </section>
<style>
    .aa-catg-nav input {
            float: left;
            margin-left: 10px;
            margin-right: 7px;
        margin-top: 15px;
    }
    .price_label{
        border:0;
        color: #ff0000;
        font-weight:bold;
    }
    .price_slider{
        margin-top: 20px;
    }
    .ui-widget-header {
        background: #000000 !important;
    }
    .aa-sidebar-widget{
        margin-bottom: 10px;
    }
</style>