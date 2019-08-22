<?php 
$seo1;
$seo2;
$seo3;
$cat_id = getCatId($seo1);
$parentzero = zeroParentCatId($cat_id);
$catTypesValue;
if($parentzero=="0"){
	$cat_ids = getMainsubcat($cat_id,$catTypesValue);
	foreach($cat_ids['subcatids'] as $subs_listingRrows){ 
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
?>
<section class="pt-3 pb-3 page-info section-padding border-bottom bg-white">
      <div class="container">
        <div class="row">
            <div class="col-md-12">
              <a href="<?php echo SITE_URL;?>"><strong><span class="mdi mdi-home"></span> Home</strong></a> <span class="mdi mdi-chevron-right"></span> <a href="/<?php echo $seo1; ?>"><?php echo $seo1; ?></a>
            </div>
        </div>
      </div>
  </section>
  <section class="shop-list section-padding">
         <div class="container">
            <div class="row">
               <div class="col-md-3">
				   <div class="shop-filters">
					  <div id="accordion">
						 <div class="card">
							<div class="card-header" id="headingOne">
							   <h5 class="mb-0">
								  <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								  Category <span class="mdi mdi-chevron-down float-right"></span>
								  </button>
							   </h5>
							</div>
							<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
							   <div class="card-body card-shop-filters">

								<style>
								.card-shop-filters {
	padding: 5px !important;
}
								ul#menu-v, #menu-v ul
{
    width:100%; /* Main Menu width */
    border:1px solid rgba(190,190,190,0.3);
    list-style:none; margin:0; padding:0;
    z-index:9;
}     

#menu-v li
{
    margin:0;padding:0;
    position:relative;    
    background-color:#DDDDDD; /*fallback color*/
	background-color:rgba(0,0,0,0.5);
    transition:background 0.5s;
}
#menu-v li:hover
{
    background-color:rgba(0,0,0,0.9);
}

#menu-v a
{
    font:normal 12px Arial;
    border-top:1px solid rgba(190,190,190,0.3);
    display:block;
    color:#EEEEEE;
    text-decoration:none;
    line-height:30px;
    padding-left:22px; 
    position:relative;           
}

#menu-v li:first-child a
{
    border-top:0;
}

#menu-v a.arrow::after{
    content:'';
    position:absolute;
    display:inline;
    top:50%;
    margin-top:-4px;
    right:8px;
    border-width:4px;
    border-style:solid;
    border-color:transparent transparent transparent white;
    transition:border-color 0.5s;  
}
                
#menu-v li a.arrow:hover::after
{
    border-color:transparent transparent transparent #CCCCCC;
}
        
/*Sub level menu items
---------------------------------------*/
#menu-v li ul
{
    min-width:180px; /* Sub level menu min width */
    position:absolute;
    display:none;
    left:100%;
	 top:50%; transform:translateY(-50%);
	 z-index: 99999;
background-color: beige;
}

#menu-v li:hover > ul
{
    display:block;
}
h1{
	margin: 10px 0px 10px 0px;
	font-size:25px;
}
								</style>
								
									<ul id="menu-v">
									
									<?php 
									 $maincategory =	categoryParent(0,'');
									foreach($maincategory as $mainCateteory){
									 ?>
									<li>
									<a href="<?php echo  $mainCateteory['cat_alias']; ?>" class="arrow"><?php echo  $mainCateteory['name']; ?></a>
									<!-- <ul>
									<?php 
									 $subcategory =	categoryParent($mainCateteory['category_id'],'');
									foreach($subcategory as $subCateteory){
									 ?>
										<li>
										<a href="<?php echo  $subCateteory['cat_alias']; ?>" class="arrow"><?php echo  $subCateteory['name']; ?></a>
											<ul>
											<?php 
									 $subsubcategory =	categoryParent($subCateteory['category_id'],'');
									foreach($subsubcategory as $subsubCateteory){
									 ?>
												<li><a href="<?php echo  $subsubCateteory['cat_alias']; ?>"><?php echo  $subsubCateteory['name']; ?></a></li>
									<?php } ?>
											</ul>
										</li>
									<?php } ?>
										</ul> -->
									</li>

									<?php }  ?>

									<!-- <li>
									<a href="#" class="arrow">Condimentum</a>
									<ul>
									<li><a href="#">Condimentum</a></li>
									<li>
									<a href="#" class="arrow">Erat nec ante</a>
									<ul>
									<li><a href="#">Sit amet lectus</a></li>
									<li><a href="#">Dignissim pulvinar</a></li>
									<li><a href="#">Fusce ut enim</a></li>
									<li><a href="#">Elit dignissim</a></li>
									<li><a href="#">Finibus quis eget</a></li>
									</ul>
									</li>
									<li>
									<a href="#" class="arrow">Morbi eget</a>
									<ul>
									<li><a href="#">Maecenas sed</a></li>
									<li><a href="#">Nunc eget</a></li>
									<li><a href="#">Velit tristique</a></li>
									<li><a href="#">Luctus varius</a></li>
									<li><a href="#">Integer sodales</a></li>
									</ul>
									</li>
									<li><a href="#">At eros</a></li>
									<li><a href="#">Efficitur viverra</a></li>
									</ul>
									</li>
									<li>
									<a href="#" class="arrow">Arcu eu</a>
									<ul>
									<li><a href="#">Lacus iaculis</a></li>
									<li>
									<a href="#" class="arrow">Praesent</a>
									<ul>
									<li><a href="#">Nunc eget</a></li>
									<li><a href="#">Pellentesque </a></li>
									<li><a href="#">Elementum</a></li>
									<li><a href="#">Eu tortor</a></li>
									</ul>
									</li>
									<li><a href="#">Ultricies</a></li>
									<li><a href="#">Fermentum nunc</a></li>
									</ul>
									</li> -->
									</ul>
							   </div>
							</div>
						 </div>
						 <!-- <div class="card">
							<div class="card-header" id="headingTwo">
							   <h5 class="mb-0">
								  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
								  Price <span class="mdi mdi-chevron-down float-right"></span>
								  </button>
							   </h5>
							</div>
							<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
							   <div class="card-body card-shop-filters">
								  <div class="custom-control custom-checkbox">
									 <input type="checkbox" class="custom-control-input" id="1">
									 <label class="custom-control-label" for="1">$68 to $659 <span class="badge badge-warning">50% OFF</span></label>
								  </div>
								  <div class="custom-control custom-checkbox">
									 <input type="checkbox" class="custom-control-input" id="2">
									 <label class="custom-control-label" for="2">$660 to $1014</label>
								  </div>
								  <div class="custom-control custom-checkbox">
									 <input type="checkbox" class="custom-control-input" id="3">
									 <label class="custom-control-label" for="3">$1015 to $1679</label>
								  </div>
								  <div class="custom-control custom-checkbox">
									 <input type="checkbox" class="custom-control-input" id="4">
									 <label class="custom-control-label" for="4">$1680 to $1856</label>
								  </div>
							   </div>
							</div>
						 </div>
						 <div class="card">
							<div class="card-header" id="headingThree">
							   <h5 class="mb-0">
								  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
								  Brand <span class="mdi mdi-chevron-down float-right"></span>
								  </button>
							   </h5>
							</div>
							<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
							   <div class="card-body card-shop-filters">
								  <form class="form-inline mb-3">
									 <div class="form-group">
										<input type="text" class="form-control" placeholder="Search By Brand">
									 </div>
									 <button type="submit" class="btn btn-secondary ml-2">GO</button>
								  </form>
								  <div class="custom-control custom-checkbox">
									 <input type="checkbox" class="custom-control-input" id="b1">
									 <label class="custom-control-label" for="b1">Imported Fruits <span class="badge badge-warning">50% OFF</span></label>
								  </div>
								  <div class="custom-control custom-checkbox">
									 <input type="checkbox" class="custom-control-input" id="b2">
									 <label class="custom-control-label" for="b2">Seasonal Fruits <span class="badge badge-secondary">NEW</span></label>
								  </div>
								  <div class="custom-control custom-checkbox">
									 <input type="checkbox" class="custom-control-input" id="b3">
									 <label class="custom-control-label" for="b3">Imported Fruits <span class="badge badge-danger">10% OFF</span></label>
								  </div>
								  <div class="custom-control custom-checkbox">
									 <input type="checkbox" class="custom-control-input" id="b4">
									 <label class="custom-control-label" for="b4">Citrus</label>
								  </div>
							   </div>
							</div>
						 </div>
						 <div class="card">
							<div class="card-header" id="headingThree">
							   <h5 class="mb-0">
								  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
								  Imported Fruits <span class="mdi mdi-chevron-down float-right"></span>
								  </button>
							   </h5>
							</div>
							<div id="collapsefour" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
							   <div class="card-body">
								  <div class="list-group">
									 <a href="#" class="list-group-item list-group-item-action">All Fruits</a>
									 <a href="#" class="list-group-item list-group-item-action">Imported Fruits</a>
									 <a href="#" class="list-group-item list-group-item-action">Seasonal Fruits</a>
									 <a href="#" class="list-group-item list-group-item-action">Citrus</a>
									 <a href="#" class="list-group-item list-group-item-action disabled">Cut Fresh & Herbs</a>
								  </div>
							   </div>
							</div>
						 </div> -->
					  </div>
				   </div>
				   <!-- <div class="left-ad mt-4">
					  <img class="img-fluid" src="http://via.placeholder.com/254x557" alt="">
				   </div> -->
				</div>
               <div class="col-md-9">
					<input type="hidden" id="orderNumbers" value="24" />
                  <!-- <a href="#"><img class="img-fluid mb-3" src="img/shop.jpg" alt=""></a> -->
                  <div class="shop-head">
                     <!-- <a href="#"><span class="mdi mdi-home"></span> Home</a> <span class="mdi mdi-chevron-right"></span> <a href="#">Fruits & Vegetables</a> <span class="mdi mdi-chevron-right"></span> <a href="#">Fruits</a> -->
                     <!-- <div class="btn-group float-right mt-2">
                        <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Sort by Products &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                           <a class="dropdown-item" href="#">Relevance</a>
                           <a class="dropdown-item" href="#">Price (Low to High)</a>
                           <a class="dropdown-item" href="#">Price (High to Low)</a>
                           <a class="dropdown-item" href="#">Discount (High to Low)</a>
                           <a class="dropdown-item" href="#">Name (A to Z)</a>
                        </div>
                     </div> -->
                     <!-- <h5 class="mb-3">Fruits</h5> -->
                  </div>
                  
                  <div class="row no-gutters" id="loadCategorys">
                  
                  </div>
                  
                  <!-- <nav>
                     <ul class="pagination justify-content-center mt-4">
                        <li class="page-item disabled">
                           <span class="page-link">Previous</span>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item active">
                           <span class="page-link">
                           2
                           <span class="sr-only">(current)</span>
                           </span>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                           <a class="page-link" href="#">Next</a>
                        </li>
                     </ul>
                  </nav> -->
               </div>
            </div>
         </div>
      </section>
		<section class="pt-3 pb-3 page-info section-padding border-bottom bg-white">
      <div class="container">
        <div class="row">
            <div class="col-md-12">
		<?php
	$conn=dbconnection();
	$sqlCategory = "SELECT 	main_description FROM tbl_category WHERE category_id = $cat_id";
	$conn->set_charset("utf8");
	$query_vals    = mysqli_query($conn,$sqlCategory);
	$numrows = mysqli_num_rows($query_vals);
	$result = mysqli_fetch_array($query_vals);
	$Description      = $result['main_description'];
	$Description = str_replace("<div>","",$Description);
	$Description = str_replace("</div>","",$Description);
	$Description = sanitize_parse($Description);
   echo $str=stripslashes($Description); 
       ?>
		 </div>
		 </div>
		 </div>
		 </section>