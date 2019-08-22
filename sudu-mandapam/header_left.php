<!-- Left side column. contains the logo and sidebar -->
<aside class="left-side sidebar-offcanvas">
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="img/user_staff_person.png" class="img-circle" alt="User Image" />
        </div>
        <div class="pull-left info">
            <p><?php echo $_SESSION['userName'];?></p>

            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>
    <!-- search form -->
    <!--<form action="#" method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search..."/>
            <span class="input-group-btn">
                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
            </span>
        </div>
    </form>-->
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <?php if($_SESSION['user_type']==1){?>
    <ul class="sidebar-menu">
        <li class="active">
            <a href="index.php">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
        </li>
         <li>
            <a href="all-category.php">
                <i class="fa fa-gavel"></i> <span>All Category List</span>
            </a>
        </li>
         <li>
            <a href="all-color-list.php">
                <i class="fa fa-gavel"></i> <span>All Offers Category</span>
            </a>
        </li>
        <li>
            <a href="all-product-list.php">
                <i class="fa fa-gavel"></i> <span>All products List</span>
            </a>
        </li>
          <li>
            <a href="all-brand-list.php">
                <i class="fa fa-gavel"></i> <span>All Brands List</span>
            </a>
        </li>
       <!-- <li>
            <a href="all-home-categories.php">
                <i class="fa fa-gavel"></i> <span>All Home Categories</span>
            </a>
        </li>-->
        <!--<li>
            <a href="add-products-to-home.php">
                <i class="fa fa-gavel"></i> <span>Add Products To Home</span>
            </a>
        </li>-->
        <li>
            <a href="all-category-specification-list.php">
                <i class="fa fa-gavel"></i> <span>All Category Specifications</span>
            </a>
        </li>
         
        
        <li>
            <a href="javascript:void(0);">
                <i class="fa fa-gavel"></i> <span>Home page Edits</span>
            </a>
            <ul id="subMenus">
	            <li>
	            <a href="all-second-main-slider-list.php">
	                <i class="fa fa-gavel"></i> <span>Home Main Slider</span>
	            </a>
	            </li>
	             <!--<li>
	            <a href="all-categories-slider-img-list.php">
	                <i class="fa fa-gavel"></i> <span>Home categories Slider</span>
	            </a>
	            </li>-->
	             <li>
	            <a href="all-categories-top-banner-list.php">
	                <i class="fa fa-gavel"></i> <span>Home  categories top banner</span>
	            </a>
	            </li>
	            <!-- <li>
	            <a href="home-categories-blog-list.php">
	                <i class="fa fa-gavel"></i> <span>Home  categories Blog list</span>
	            </a>
	            </li>-->
            </ul>
        </li>
      <!--<li>
            <a href="all-mobile-images.php">
                <i class="fa fa-gavel"></i> <span>All Mobile Images</span>
            </a>
        </li>-->
        <li>
            <a href="all-shippment-list.php">
                <i class="fa fa-gavel"></i> <span>Shippment Type List</span>
            </a>
        </li>
        <li>
            <a href="all-user-list.php">
                <i class="fa fa-gavel"></i> <span>All User List</span>
            </a>
        </li>
       <!-- <li>
            <a href="all-gift-voucher.php">
                <i class="fa fa-gavel"></i> <span>All Gift Vouchers</span>
            </a>
        </li>-->
        <li>
            <a href="coupon-list.php">
                <i class="fa fa-gavel"></i> <span>Coupon List</span>
            </a>
        </li>
        <li>
            <a href="all-static-page-list.php">
                <i class="fa fa-gavel"></i> <span>Static Pages</span>
            </a>
        </li>
        <li>
            <a href="newsletter.php">
                <i class="fa fa-gavel"></i> <span>Newsletter</span>
            </a>
        </li>
      <!--  <li>
            <a href="basic_form.html">
                <i class="fa fa-globe"></i> <span>Basic Elements</span>
            </a>
        </li>

        <li>
            <a href="simple.html">
                <i class="fa fa-glass"></i> <span>Simple tables</span>
            </a>
        </li>-->

    </ul>
    <?php } elseif($_SESSION['user_type']==2){?>
    <ul class="sidebar-menu">
        <li>
            <a href="all-product-list.php">
                <i class="fa fa-gavel"></i> <span>All products List</span>
            </a>
        </li>
    </ul>
    <?php }?>
</section>
<style>#subMenus > li {
    list-style: outside none none;
    padding: 10px 0 0;
}</style>
<!-- /.sidebar -->
</aside>
