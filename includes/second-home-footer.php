<!-- Footer -->
<div class="dsad">
<?php 
$cartSessionId    = $_SESSION['cartSessionId'];
$valuescartCounts =  productCartIdentificationAllPages($cartSessionId);
if($valuescartCounts){$valuescartCountsData = $valuescartCounts;}else{ $valuescartCountsData = "0";}
?>
<a href="cart" class="btn btn-link border-none"><i class="mdi mdi-cart"></i> Cart <small class="cart-value cartcoutview"><?php echo $valuescartCountsData; ?></small></a>
</div>
<section class="section-padding bg-white border-top">
         <div class="container">
            <div class="row">
               <div class="col-lg-4 col-sm-6">
                  <div class="feature-box">
                     <i class="mdi mdi-truck-fast"></i>
                     <h6>Free Delivery & All Over India </h6>
                     <!-- <p>Lorem ipsum dolor sit amet, cons...</p> -->
                  </div>
               </div>
               <div class="col-lg-4 col-sm-6">
                  <div class="feature-box">
                     <i class="mdi mdi-basket"></i>
                     <h6>100% Satisfaction Guarantee</h6>
                     <!-- <p>Rorem Ipsum Dolor sit amet, cons...</p> -->
                  </div>
               </div>
               <div class="col-lg-4 col-sm-6">
                  <div class="feature-box">
                     <i class="mdi mdi-tag-heart"></i>
                     <h6>Great Daily Deals Discount</h6>
                     <!-- <p>Sorem Ipsum Dolor sit amet, Cons...</p> -->
                  </div>
               </div>
            </div>
         </div>
      </section>

<section class="section-padding footer bg-white border-top">
         <div class="container">
            <div class="row">
               <div class="col-lg-3 col-md-3">
               <h6 class="mb-4" style='color: #fff;'>Contact Info </h6>
                  <!-- <h4 class="mb-5 mt-0"><a class="logo" href="index.html"><img src="img/logo-footer.png" alt="Groci"></a></h4> -->
                  <!-- <p class="mb-0"><a class="text-dark" href="#"><i class="mdi mdi-phone"></i> +04259-232323, 235455</a></p> -->
                  <p class="mb-0"><a class="text-dark" href="#" style="color:#888 !important;"><i class="mdi mdi-cellphone-iphone"></i> +91-9524065549</a></p>
                  <p class="mb-0"><a class="text-success" href="#" style="color:#888 !important;"><i class="mdi mdi-email"></i> spsbrands@gmail.com </a></p>
                  <p class="mb-0"><a class="text-primary" href="http://www.spsbrands.com" style="color:#888 !important;"><i class="mdi mdi-web"></i> www.spsbrands.com</a></p>
               </div>
               <div class="col-lg-2 col-md-2">
                  <h6 class="mb-4" style='color: #fff;'>Online Grocery shopping in India</h6>
                  <p>

Order Online. All your favourite products from the low price online supermarket for 
grocery and dry fruits, spices, herbs, millets, woodpressed oil delivery all over India.

                  </p>
                  <ul>
                  <!-- <li><a href="#">Coimbatore</a></li> -->
                  <!-- <li><a href="#">Bengaluru</a></li>
                  <li><a href="#">Hyderabad</a></li>
                  <li><a href="#">Kolkata</a></li>
                  <li><a href="#">Gurugram</a></li> -->
                  <ul>
               </div>
               <div class="col-lg-2 col-md-2">
                  <h6 class="mb-4" style='color: #fff;'>CATEGORIES</h6>
                  <ul>
                  <li><a href="<?php echo SITE_URL;?>buy-dry-fruits-online">Buy Dry Fruits</a></li>
                  <li><a href="<?php echo SITE_URL;?>spices-herbs">Buy Spices</a></li>
                  <li><a href="<?php echo SITE_URL;?>buy-sirudhaniyam-Millets-products-online">Buy Millets</a></li>
                  <li><a href="<?php echo SITE_URL;?>Herbs">Herbs And Spices</a></li>
                  <li><a href="<?php echo SITE_URL;?>WOOD-PRESSED-OIL">Wood Pressed Oil</a></li>
                  <li><a href="<?php echo SITE_URL;?>masala-powder">Buy Masala Powder</a></li>
                  <li><a href="<?php echo SITE_URL;?>buy-seeds">Buy Seeds</a></li>
                  
                  <ul>
               </div>
               <div class="col-lg-2 col-md-2">
                  <h6 class="mb-4" style='color: #fff;'>ABOUT Company</h6>
                  <ul>
                  <li><a href="/about-us">About Us</a></li>
                  <li><a href="/contact-us">Contact Us</a></li>
                  <li><a href="/faq">FAQ</a></li>
                  <ul>
               </div>
               <div class="col-lg-3 col-md-3">
                  <h6 class="mb-4" style="color:#fff;">GET IN TOUCH</h6>
                   <!--<div class="app">
                     <a href="#"><img src="img/google.png" alt=""></a>
                     <a href="#"><img src="img/apple.png" alt=""></a>
                  </div> -->
                  <!-- <h6 class="mb-3 mt-4" style='color: #fff;'>GET IN TOUCH</h6> -->
                  <div class="footer-social">
                     <a class="btn-facebook" href="#"><i class="mdi mdi-facebook"></i></a>
                     <!-- <a class="btn-twitter" href="#"><i class="mdi mdi-twitter"></i></a>
                     <a class="btn-instagram" href="#"><i class="mdi mdi-instagram"></i></a>
                     <a class="btn-whatsapp" href="#"><i class="mdi mdi-whatsapp"></i></a>
                     <a class="btn-messenger" href="#"><i class="mdi mdi-facebook-messenger"></i></a>
                     <a class="btn-google" href="#"><i class="mdi mdi-google"></i></a> -->
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- End Footer -->
      <!-- Copyright -->
      <section class="pt-4 pb-4 footer-bottom">
         <div class="container">
            <div class="row no-gutters">
               <div class="col-lg-6 col-sm-6">
                  <p class="mt-1 mb-0">&copy; Copyright 2019 <strong class="text-dark"> spsbrands.com </strong>. All Rights Reserved<br>
				  <!-- <small class="mt-0 mb-0">Made with <i class="mdi mdi-heart text-danger"></i> by <a href="https://askbootstrap.com/" target="_blank" class="text-primary">Ask Bootstrap</a>
                  </small> -->
				  </p>
               </div>
               <div class="col-lg-6 col-sm-6 text-right">
                  <img alt="osahan logo" src="img/payment_methods.png">
               </div>
            </div>
         </div>
      </section> 
     
      <!-- End Copyright -->
      <div class="cart-sidebar" id="headercartview">
         
      </div>
      <!-- Bootstrap core JavaScript -->
      <style>
         .dsad{
            position: fixed;
right: 0px;
width: 74px;
top: 300px;
background-color: #e96125;
         }
         .dsad .cartcoutview {
	background-color: #fff;
	border-radius: 5px;
	width: 0px;
	height: 0px;
	padding: 6px 5px 3px 3px;
	color: #000;
	font-weight: bold;
}

.dsad a{
   color:#fff;
}

         .product {
         background: #fff;
         border: 1px solid #eee;
         border-radius: 2px;
         margin: 0 -1px 0 0;
         padding: 10px;
         position: relative;
         }
         .regular-price {
         color: #666 !important;
         font-size: 11px;
         font-weight: 500;
         line-height: 15px;
         text-decoration: none;
         }
         .error {
         color: RED;
         font-size: 13px;
         }
        #register-form .form-group {
	         margin-bottom: 0rem;
         }
         .product-body h5 {
	font-size: 14px;
	font-weight: 500;
	margin: 10px;
}
.product-body {
	height: 79px;
}

      </style>
      <script src="<?php echo SITE_URL;?>vendor/jquery/jquery.min.js"></script>
      <script src="<?php echo SITE_URL;?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="http://code.jquery.com/jquery-migrate-1.0.0.js"></script>
      <!-- select2 Js -->
      <!-- <script src="vendor/select2/js/select2.min.js"></script> -->
      <!-- Owl Carousel -->
      <script src="<?php echo SITE_URL;?>vendor/owl-carousel/owl.carousel.js"></script>
      <script src="<?php echo SITE_URL;?>js/mega_menu.min.js"></script>

      <!-- Custom -->
      <script src="<?php echo SITE_URL;?>js/custom.min.js"></script>
      <script src="<?php echo SITE_URL;?>js/jquery.validate.js"></script>
      <script src="<?php echo SITE_URL;?>js/main.js"></script>
      <!-- <input type="hidden" id="ajaxSiteUrl" name="ajaxSiteUrl" value="<?php echo SITE_URL; ?>"/> -->
      <script>

function  updateCartAjax(tsk,product_price_code){
	var qty  = $("#product_qty"+product_price_code).val().trim();
	
 	if(tsk=='plus'){
 		
		var product_qty = parseInt(qty) + parseInt(1);
		
	}
	else{
		var product_qty = parseInt(qty) - parseInt(1);
	}
	if(product_qty<=0){
		product_qty = 1;
	}
	
	$("#product_qty"+product_price_code).val(product_qty);
	
	}

         function addToCart1(priceid,productId){

         var priceid = priceid;


         var product_qty = $("#product_qty"+priceid).val();

         $.ajax({
         type: "POST",
         url:'common_ajax.php',
         data:'ajax=1&ajax_task=addTocart&productId='+productId+'&qut='+product_qty+'&priceid='+priceid,
         success:function(data){
         if(data !="0"){
         // document.getElementById('SavaCartval_'+productId).style.display="block";	
         // setTimeout(function(){
         // document.getElementById('SavaCartval_'+productId).style.display="none";
         // }, 3000);

         // $('.cartcoutview').show();
            
         $('.cartcoutview').html( parseInt(data));
         //$('#dgg1').html('10');
        // cartheaderList();
         window.location.href="/cart";
         }
         }
         })
         }

         

      </script>
       <!-- demo script -->
    <script type="text/javascript">
        jQuery(document).ready(function ($) {

            // variables
            var Options, get_options;

            // object
            Options = (function () {

                // constructor
                function Options(a, b, c, d, e, f, g, h, i, j, k, l, m, n, o, p, q, r, s, t, u, v, w, x, y, z) {
                    this.links_align = b;
                    this.socialBar_align = c;
                    this.searchBar_align = d;
                    this.trigger = e;
                    this.effect = f;
                    this.effect_speed = g;
                    this.sibling = h;
                    this.outside_click_close = i;
                    this.top_fixed = j;
                    this.sticky_header = k;
                    this.sticky_header_height = l;
                    this.menu_position = m;
                    this.full_width = n;
                    this.color_change = o;
                    this.color_button = p;
                }

                // object classes
                Options.prototype.optionsChange = function () {
                    // menu initialize
                    $('#menu-1').megaMenu({
                        // DESKTOP MODE SETTINGS
                        // links_align         : this.links_align,
                        // socialBar_align     : this.socialBar_align,
                        // searchBar_align     : this.searchBar_align,
                        trigger             : this.trigger,
                        effect              : this.effect,
                        effect_speed        : 400,
                        sibling             : true,
                        outside_click_close : true,
                        top_fixed           : this.top_fixed,
                        sticky_header       : this.sticky_header,
                        sticky_header_height: 200,
                        menu_position       : this.menu_position,
                        full_width          : false,
                        // MOBILE MODE SETTINGS
                        mobile_settings     : {
                            collapse            : true,
                            sibling             : true,
                            scrollBar           : true,
                            scrollBar_height    : 400,
                            top_fixed           : false,
                            sticky_header       : false,
                            sticky_header_height: 200
                        }
                    });
                };

                // color change function
                Options.prototype.colorChange = function (selector, color) {
                    $(selector).click(function () {
                        $('#menu-1').attr('data-color', color);
                    })
                };

                // return options
                return Options;
            })();

            // call object
            get_options = new Options();
            // call options change
            get_options.optionsChange();
            // call color change function
            get_options.colorChange();
            // data colors
            // get_options.colorChange('#color-1', 'blue-grey');
            // get_options.colorChange('#color-2', 'blue-grey-invert');
            // get_options.colorChange('#color-3', 'brown');
            // get_options.colorChange('#color-4', 'brown-invert');
            // get_options.colorChange('#color-5', 'cyan');
            // get_options.colorChange('#color-6', 'cyan-invert');
            // get_options.colorChange('#color-7', 'deep-orange');
            // get_options.colorChange('#color-8', 'deep-orange-invert');
            // get_options.colorChange('#color-9', 'deep-purple');
            // get_options.colorChange('#color-10', 'deep-purple-invert');
            // get_options.colorChange('#color-11', 'grey');
            // get_options.colorChange('#color-12', 'grey-invert');
            // get_options.colorChange('#color-13', 'indigo');
            // get_options.colorChange('#color-14', 'indigo-invert');
            // get_options.colorChange('#color-15', 'light-blue');
            // get_options.colorChange('#color-16', 'light-blue-invert');
            // get_options.colorChange('#color-17', 'light-green');
            // get_options.colorChange('#color-18', 'light-green-invert');
            // get_options.colorChange('#color-19', 'lime');
            // get_options.colorChange('#color-20', 'lime-invert');
            // get_options.colorChange('#color-21', 'orange');
            // get_options.colorChange('#color-22', 'orange-invert');
            // get_options.colorChange('#color-23', 'pink');
            // get_options.colorChange('#color-24', 'pink-invert');
            // get_options.colorChange('#color-25', 'purple');
            // get_options.colorChange('#color-26', 'purple-invert');
            // get_options.colorChange('#color-27', 'red');
            // get_options.colorChange('#color-28', 'red-invert');
            // get_options.colorChange('#color-29', 'teal');
            // get_options.colorChange('#color-30', 'teal-invert');

            // logo align left or right
            // var bt1 = true;
            // $('#btn1').prop('checked', false).click(function () {
            //     if (bt1 === true) {
            //         get_options.logo_align = 'right';
            //         get_options.optionsChange();
            //         bt1 = false;
            //     } else {
            //         get_options.logo_align = 'left';
            //         get_options.optionsChange();
            //         bt1 = true;
            //     }
            // });

            // // links align left or right
            // var bt2 = true;
            // $('#btn2').prop('checked', false).click(function () {
            //     if (bt2 === true) {
            //         get_options.links_align = 'right';
            //         get_options.optionsChange();
            //         $('#align-1').addClass('margin-fix');
            //         $('#align-2').addClass('margin-fix-1');
            //         bt2 = false;
            //     } else {
            //         get_options.links_align = 'left';
            //         get_options.optionsChange();
            //         $('#align-1').removeClass('margin-fix');
            //         $('#align-2').removeClass('margin-fix-1');
            //         bt2 = true;
            //     }
            // });

            // // social icons left or right
            // var bt3 = true;
            // $('#btn3').prop('checked', false).click(function () {
            //     if (bt3 === true) {
            //         get_options.socialBar_align = 'right';
            //         get_options.optionsChange();
            //         bt3 = false;
            //     } else {
            //         get_options.socialBar_align = 'left';
            //         get_options.optionsChange();
            //         bt3 = true;
            //     }
            // });

            // // search bar left or right
            // var bt4 = true;
            // $('#btn4').prop('checked', false).click(function () {
            //     if (bt4 === true) {
            //         get_options.searchBar_align = 'left';
            //         get_options.optionsChange();
            //         bt4 = false;
            //     } else {
            //         get_options.searchBar_align = 'right';
            //         get_options.optionsChange();
            //         bt4 = true;
            //     }
            // });

            // // fixed on top
            // var bt5 = true;
            // $('#btn5').prop('checked', false).click(function () {
            //     if (bt5 === true) {
            //         get_options.top_fixed = true;
            //         get_options.optionsChange();
            //         $('#hide-label-1').css('visibility', 'hidden');
            //         bt5 = false;
            //     } else {
            //         get_options.top_fixed = false;
            //         get_options.optionsChange();
            //         $('#hide-label-1').css('visibility', 'visible');
            //         bt5 = true;
            //     }
            // });

            // // sticky header
            // var bt6 = true;
            // $('#btn6').prop('checked', false).click(function () {
            //     if (bt6 === true) {
            //         get_options.sticky_header = true;
            //         get_options.optionsChange();
            //         $('body').css('height', '2000px');
            //         $('#hide-label').css('visibility', 'hidden');
            //         bt6 = false;
            //     } else {
            //         get_options.sticky_header = false;
            //         get_options.optionsChange();
            //         $('body').css('height', '');
            //         $('#hide-label').css('visibility', 'visible');
            //         bt6 = true;
            //     }
            // });

            // // position change
            // $('#btn7').val('horizontal').on('change keydown keyup', function () {
            //     get_options.menu_position = $(this).val();
            //     get_options.optionsChange();
            //     var get_value = $(this).val();
            //     if (get_value === 'vertical-left' || get_value === 'vertical-right') {
            //         $('.abc').hide(0);
            //     } else {
            //         $('.abc').show(0);
            //     }
            // });

            // // drop down effects
            // $('#btn8').val('fade').on('change keydown keyup', function () {
            //     get_options.effect = $(this).val();
            //     get_options.optionsChange();
            // });

            // // trigger change
            // $('#btn9').val('hover').on('change keydown keyup', function () {
            //     get_options.trigger = $(this).val();
            //     get_options.optionsChange();
            //     console.log($(this).val())
            // });


        });
    </script>

   </body>
</html>