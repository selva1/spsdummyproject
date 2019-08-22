<?php 
$keyword = $_GET['headersearch'];
$catList = $_GET['catList'];
if($keyword=="" && $catList==""){
	
	$url="Location".SITE_URL;
	header($url);
}
$saerchvasd = mainSearchFuncNewIds($keyword,$catList);
 
 //echo $comma_separated = implode(",", $saerchvasd);
 
?>
<div class="col-md-12">
  <section id="aa-product-category1" >
    <div class="container">
      <div class="row">
      <div id="searchfilterDesingesign"></div>
       <div class="col-lg-3 col-md-3 col-sm-4 col-md-pull-9">
        <aside class="aa-sidebar">
         <input  type="hidden" value="<?php echo $_GET['headersearch']; ?>" id="searchValue" name="searchValue" />
		<input  type="hidden" value="<?php echo $_GET['catList']; ?>" id="cattype" name="cattype"/>
            <div class="aa-sidebar-widget">
              <h3>Category List</h3>
              <ul class="aa-catg-nav scroll-cat">
               <?php 
              $category_listing = filterCategoryList($cat_id,$parentzero);
             foreach($category_listing['allresult'] as $category_listingRrows){ 
             if($cat_id==$category_listingRrows->category_id){
			 	$activescat = "catActives";
			 }else{
			 	$activescat = "";
			 }
			  	echo '<li class="'.$activescat.'"><a href="'.$category_listingRrows->catalias.'" >'.$category_listingRrows->ctname.'('.$category_listingRrows->cnt.')</a></li>';
			  }catalias
              
              ?>
              </ul>
            </div>
            <!--<div class="aa-sidebar-widget">
              <h3>Brand List</h3>
              <ul class="aa-catg-nav">
              <?php 
              
              $band_listing = filterBrandList($cat_id,$leftsideSearchwhereCase);
             foreach($band_listing['allresult'] as $band_listingRrows){ 
				if(@in_array($band_listingRrows->brandid,$allBandValsArray)) {
				$Selected='checked=checked';
				} else {
				$Selected="";
				}
			  	echo '<li><input type="checkbox" id="brandIds" name="brandIds[]" value="'.$band_listingRrows->brandid.'" onclick="FilterCheckbox();" class="brandvalues" '.$Selected.' /><a href="javascript:void(0);" >'.$band_listingRrows->bra.'('.$band_listingRrows->cnt.')</a></li>';
			  	
			  }
              
              ?>
              </ul>
            </div>-->
            
            <!--<div class="aa-sidebar-widget">
              <h3>Color List</h3>
              <ul class="aa-catg-nav">
              <?php 
              
              $band_listing = filterColorList($cat_id,$leftsideSearchwhereCase);
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
            </div>-->

            <div class="aa-sidebar-widget">
                <h3>Shop By Price</h3>
                <p class="price_slider">
                    <label id="price" class="price_label"></label>
                    <input type="hidden" id="hdnFromPrice">
                    <input type="hidden" id="hdnToPrice">
                </p>
                <div id="category_slider"></div>
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