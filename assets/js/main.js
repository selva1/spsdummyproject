var siteUrl="http://www.spsbrands.com/";jQuery(document).ready(function($){$(".mainmenu-area").sticky({topSpacing:0});$('.product-carousel').owlCarousel({loop:true,nav:true,margin:20,responsiveClass:true,responsive:{0:{items:1,},600:{items:3,},1000:{items:5,}}});$('.related-products-carousel').owlCarousel({loop:true,nav:true,margin:20,responsiveClass:true,responsive:{0:{items:1,},600:{items:2,},1000:{items:2,},1200:{items:3,}}});$('.brand-list').owlCarousel({loop:true,nav:true,margin:20,responsiveClass:true,responsive:{0:{items:1,},600:{items:3,},1000:{items:4,}}});$(".navbar-nav li a").click(function(){$(".navbar-collapse").removeClass('in');});$('.navbar-nav li a, .scroll-to-up').bind('click',function(event){var $anchor=$(this);var headerH=$('.header-area').outerHeight();$('html, body').stop().animate({scrollTop:$($anchor.attr('href')).offset().top-headerH+"px"},1200,'easeInOutExpo');event.preventDefault();});$('body').scrollspy({target:'.navbar-collapse',offset:95})});function RegisterFun(){document.getElementById('register-form').style.display='block';document.getElementById('login-form').style.display='none';document.getElementById('lost-form').style.display='none';}function loginFun(){document.getElementById('register-form').style.display='none';document.getElementById('login-form').style.display='block';document.getElementById('lost-form').style.display='none';}function lostFun(){document.getElementById('register-form').style.display='none';document.getElementById('login-form').style.display='none';document.getElementById('lost-form').style.display='block';}$('#username').focus();$('#Logins').click(function(){var username=$('#login_username');var password=$('#login_password');var login_result=$('#text-login-msg');login_result.html('loading..');if(username.val()==''){username.focus();login_result.html('<span class="error">Enter the username</span>');return false;}if(password.val()==''){password.focus();login_result.html('<span class="error">Enter the password</span>');return false;}if(username.val()!=''&&password.val()!=''){var search_sess=jQuery.trim($("input[name='search_sess']").val());var fav_id=jQuery.trim($("input[name='fav_id']").val());var isReview=$('#hdn_isReview').val();var product_id=$('#hdn_product_id').val();$.ajax({type:"POST",url:'common_ajax.php',data:'ajax=1&ajax_task=LoginValid&username='+username.val()+'&password='+password.val(),success:function(data){if(data==0){login_result.html('<span class="error">Username or Password Incorrect!</span>');}else if(data==1){if(isReview==1){window.location.href=siteUrl+product_id;}else{window.location.href=siteUrl+"checkout";}}}})}return false;});function emailvalidation(email){var reg=/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;if(reg.test(email)==false){return false;}return true;}function pageregister(){var email=document.getElementById('r_email').value;var ph_no=document.getElementById('r_ph_no').value;var password=document.getElementById('r_password').value;var con_password=document.getElementById('r_con_password').value;var terms_accepted=document.getElementById('checkterms').checked;var terms_value=0;if(!terms_accepted){document.getElementById('r_err_terms').innerHTML=" Please check Terms & Conditions ";document.getElementById('r_err_terms').focus();terms_value=1;return false;}else{document.getElementById('r_err_terms').innerHTML="";}if(email==""){document.getElementById('r_err_mail').innerHTML=" Email is Required";document.getElementById('r_email').focus();return false;}else{if(!emailvalidation(document.getElementById('r_email').value)){document.getElementById('r_err_mail').innerHTML="Enter a valid Email id";document.getElementById('r_email').focus();return false;}else{document.getElementById('r_err_mail').innerHTML="";r_checkseekeremail();}}if(ph_no==""){document.getElementById('r_err_ph_no').innerHTML="please enter the mobile number";return false;}else{var strArr=ph_no.split(" ");var mobileno=ph_no.indexOf('.');if(strArr[0]==''){document.getElementById('r_err_ph_no').innerHTML="Invalid Mobile number";document.getElementById('r_ph_no').focus();return false;}else if((isNaN(ph_no))||(ph_no.length<10)){document.getElementById('r_err_ph_no').innerHTML="Invalid Mobile number";document.getElementById('r_ph_no').focus();return false;}else if(mobileno!=-1){document.getElementById('r_err_ph_no').innerHTML="Invalid Mobile number";document.getElementById('r_ph_no').focus();return false;}else{document.getElementById('r_err_ph_no').innerHTML="";}}if(password==""){document.getElementById('r_err_password').innerHTML="please enter the password";return false;}else{document.getElementById('r_err_password').innerHTML="";}if(con_password==""){document.getElementById('r_err_Confirm').innerHTML="please enter the password";return false;}else if(password!=con_password){document.getElementById('r_err_Confirm').innerHTML="password is mismatch";return false;}else{document.getElementById('r_err_Confirm').innerHTML="";}userName="";var parameters="register_email="+email+"&Ph_no="+ph_no+"&ajax_task=Registrations&ajax=1"+"&register_password="+password+"&Con_password="+con_password+"&userName="+userName+"&terms="+terms_value;MakePostRequest("common_ajax.php",parameters,'test_list');}function test_list(){if(ajobj.readyState==4){if(ajobj.responseText=="1"){window.location.href=siteUrl+"checkout";}if(ajobj.responseText=="2"){window.location.href=siteUrl+"checkout";}if(ajobj.responseText=="3"){document.getElementById('r_err_mail').innerHTML="E-Mail already exist";return false;}}}function r_checkseekeremail(){if(!emailvalidation(document.getElementById('r_email').value)){document.getElementById('r_err_mail').innerHTML="Enter a valid Email id";return false;}else{document.getElementById('r_err_mail').innerHTML="";mailerror='r_err_mail';var email=document.getElementById('r_email').value;var parameters="email="+email+"&ajax=1&ajax_task=emailcheckexist";MakePostRequest("common_ajax.php",parameters,'r_checkname');}}function r_checkname(){if(ajobj.readyState==4){if(ajobj.responseText=="1"){document.getElementById(mailerror).innerHTML="E-Mail already exist";return false;}}else{document.getElementById('r_err_mail').innerHTML="";}}var ajobj;function createajax(){if(window.XMLHttpRequest){ajobj=new XMLHttpRequest();}else if(window.ActiveXObject){try{ajobj=new ActiveXObject("Msxml2.XMLHTTP");}catch(e){try{ajobj=new ActiveXObject("Microsoft.XMLHTTP");}catch(e){}}}else{return false;}return ajobj;}function MakePostRequest(url,parameters,functionname){ajobj=createajax();eval("ajobj.onreadystatechange = "+functionname+";");ajobj.open('POST',url,true);ajobj.setRequestHeader("Content-type","application/x-www-form-urlencoded");ajobj.setRequestHeader("Content-length",parameters.length);ajobj.setRequestHeader("Connection","close");ajobj.send(parameters);return ajobj;}function MakeGetRequest(url,functionname){ajobj=createajax();if(functionname!=null&&functionname!=""){eval("ajobj.onreadystatechange = "+functionname+";");}ajobj.open('GET',url,true);ajobj.send(null);return ajobj;}function forgetPassword(){var username=$('#lost_email');var login_result=$('#text-lost-msg');login_result.html('loading..');if(username.val()==''){username.focus();login_result.html('<span class="error">Enter the email</span>');return false;}if(username.val()!=''){$.ajax({type:"POST",url:'common_ajax.php',data:'ajax=1&ajax_task=forgetPassword&username='+username.val(),success:function(data){if(data==0){login_result.html('<span class="error">E-Mail already not exist</span>');}else if(data==1){login_result.html('<span class="error">Reset password link send your mail...</span>');}}})}}function resetpasswords(){var password=document.getElementById('r_password').value;var con_password=document.getElementById('r_con_password').value;var accesstoken=document.getElementById('accesstoken').value;if(password==""){document.getElementById('r_err_password').innerHTML="please enter the password";return false;}else{document.getElementById('r_err_password').innerHTML="";}if(con_password==""){document.getElementById('r_err_Confirm').innerHTML="please enter the password";return false;}else if(password!=con_password){document.getElementById('r_err_Confirm').innerHTML="password is mismatch";return false;}else{document.getElementById('r_err_Confirm').innerHTML="";}userName="";var parameters="ajax_task=resetpasswordresponse&ajax=1"+"&register_password="+password+"&Con_password="+con_password+"&accesstoken="+accesstoken;MakePostRequest("common_ajax.php",parameters,'resetpasswordresponse');}function resetpasswordresponse(){if(ajobj.readyState==4){if(ajobj.responseText=="1"){window.location.href="login";}if(ajobj.responseText=="0"){document.getElementById('accessTokenError').innerHTML="Acess token Invalid..";return false;}}}function DeleteCartProduct(cartId){$.ajax({type:"POST",url:'common_ajax.php',data:'ajax=1&ajax_task=DeleteCartProduct&cartId='+cartId,success:function(data){if(data=="1"){window.location.href="cart";}}})}$("#checkout_validate_form").validate({rules:{name:"required",email:{required:true,email:true},phonenum:{required:true,minlength:9,maxlength:10,number:true},address:{required:true,minlength:10},country:"required",city:{required:true,minlength:5},District:{required:true,minlength:5},Postcode:{required:true,minlength:5},Notes:{required:true,minlength:5},optionsRadios:"required",password:{required:true,minlength:6}},messages:{name:"Name field cannot be blank!",email:"E-mail cannot be blank!",phonenum:"mobile number cannot be blank!",address:"address field cannot be blank!",country:"country field cannot be blank!",city:"city field cannot be blank!",District:"District field cannot be blank!",Postcode:"Postcode field cannot be blank!",Notes:"Notes field cannot be blank!",optionsRadios:"please select payment method!",password:{required:"Password field cannot be blank!",minlength:"Your password must be at least 6 characters long"},email:"Please enter a valid email address"},submitHandler:function(form){form.submit();}});function openNav(){document.getElementById("mySidenav").style.width="250px";}function closeNav(){document.getElementById("mySidenav").style.width="0";}$('.sub-menu').hide();$(".mobile-menu li:has(ul)").click(function(){$("ul",this).toggle('slow');});function singleProductAddtoCart(productId){var qut=document.getElementById('Qut1').value;var url=$("#ajaxSiteUrl").val();$.ajax({type:"POST",url:'common_ajax.php',data:'ajax=1&ajax_task=addTocart&productId='+productId+'&qut='+qut,success:function(data){if(data!="0"){document.getElementById('SavaCartval_'+productId).style.display="block";setTimeout(function(){document.getElementById('SavaCartval_'+productId).style.display="none";},3000);window.location=url+"cart/";}}})}function subscribe(){var subemais=document.getElementById('subemais').value;if(subemais==""){$('#Submsg').html('please enter email address');return false;}$.ajax({type:"POST",url:'common_ajax.php',data:'ajax=1&ajax_task=subscribeEmail&subemais='+subemais,success:function(data){if(data=="1"){$('#Submsg').html('Thank you! You have successfully subscribed to our newsletter...');document.getElementById('').style.display="block";setTimeout(function(){$('#Submsg').html('');},3000);}else if(data=="0"){$('#Submsg').html(' Your email already subscribed with us...');setTimeout(function(){$('#Submsg').html('');},3000);}}})}function onPageLoadCheckout(ident){couponID="";country="";var discountType="";var isGiftVoucher="false";if(ident=="changecountry"){var couponID=$('#couponID').val();var country=$('#country').val();discountType="changecountry";if(country==""){$('#coponerror').html('Please select the country...');return false;}else{$('#coponerror').html('');}}else if(ident=="applyCoupon"){var couponID=$('#couponID').val();var country=$('#country').val();discountType="applyCoupon";}else if(ident=="Onload"){var couponID=$('#couponID').val();var country=$('#country').val();discountType="Onload";}else if("applyGiftVoucher"){var couponID=$('#voucherID').val();var country=$('#country').val();discountType="applyGiftVoucher";isGiftVoucher="true";}var url=$("#ajaxSiteUrl").val();$.ajax({type:"POST",url:'common_ajax.php',data:'ajax=1&ajax_task=checkoutOnload&country='+country+'&couponID='+couponID+'&isGiftVoucher='+isGiftVoucher+'&discountType='+discountType,success:function(data){if(data!=""){$('#showCheckout').html(data);}}})}function couponCodeExsits(){var couponID=$('#couponID').val();if(couponID==""){$('#coponerror').html('Please enter coupon code...');setTimeout(function(){$('#coponerror').html('');},4000);return false;}else{$('#coponerror').html('');}var url=$("#ajaxSiteUrl").val();$.ajax({type:"POST",url:'common_ajax.php',data:'ajax=1&ajax_task=couponCodevalid&couponID='+couponID,success:function(data){if(data=="1"){$('#coponerror').html('Invalid coupon code.');}else if(data=="2"){$('#coponerror').html('expired coupon code.');}else{$('#coponerror').html('');}setTimeout(function(){$('#coponerror').html('');},4000);}})}$("#couponID").focus(function(){$('#coponerror').html('');});function searchFilterFunctions(){var headersearch=$('#headersearch').val();var catList=$('#catList').val();if(headersearch==""){$('#coponerror').html('Please enter coupon code...');setTimeout(function(){$('#coponerror').html('');},4000);return false;}else{$('#coponerror').html('');}var url=$("#ajaxSiteUrl").val();$.ajax({type:"POST",url:'common_ajax.php',data:'ajax=1&ajax_task=searchHeaderFilter&catList='+catList+'&search='+headersearch,success:function(data){console.log(data);if(data==""){$('#filterSearchList').html('');}else if(data!=""){$('#filterSearchList').show();$('#filterSearchList').html(data);}}})}function searchFilterFunctionsHome(){var headersearch=$('#headersearch').val();var catList=$('#catList').val();var url=$("#ajaxSiteUrl").val();$.ajax({type:"POST",url:'common_ajax.php',data:'ajax=1&ajax_task=searchHeaderFilter&catList='+catList+'&search='+headersearch,success:function(data){if(data=="0"){$('#filterSearchList').hide();return false;}if(data==""){$('#filterSearchList').html('');}else if(data!=""){$('#filterSearchList').show();$('#filterSearchList').html(data);}}})}function cartheaderList(){var url=$("#ajaxSiteUrl").val();$.ajax({type:"POST",url:'common_ajax.php',data:'ajax=1&ajax_task=headerCartDesign',success:function(data){if(data=="0"){$('#filterSearchList').hide();return false;}if(data==""){$('.aa-cartbox-summary').html('');}else if(data!=""){$('.aa-cartbox-summary').html(data);}}})}cartheaderList();function contact_form_submit(){var username=$('#clientname');var clientemail=$('#clientemail');var clientmsg=$('#message');var name_error=$('#name_error');var email_error=$('#email_error');var contact_request=$('#status');var captcha_error=$('#captcha_error');var valid_name=0;var valid_email=0;valid_captcha=0;if(username.val()==''){username.focus();name_error.html('<span class="error">Please entrer your name </span>');return false;}else{name_error.html('');valid_name=1;}if(clientemail.val()==''){clientemail.focus();email_error.html('<span class="error">Please entrer your Email id </span>')
return false;}else{email_error.html('');valid_email=1;}if(!emailvalidation(clientemail.val())){email_error.html('<span class="error">Please entrer valid Email id </span>')
return false;}else{email_error.html('');valid_email=1;}if(grecaptcha.getResponse()==""){captcha_error.html('<span class="error">Please verify yourself </span>');return false;}else{captcha_error.html('');valid_captcha=1;}if((valid_email==1)&&(valid_name==1)&&(valid_captcha==1)){var captcha_val=$("textarea[name='g-recaptcha-response']").val();$.post("common_ajax.php",{ajax:1,ajax_task:'ContactRequest',name:username.val(),email:clientemail.val(),msg:clientmsg.val(),captcha_val:captcha_val},function(data,status){if(data==1){contact_request.html('<span class="error" >E-Mail Sent successfully</span>');document.getElementById("contact-form").reset();}else if(data==0){contact_request.html('<span class="error" >Email is not Sent,Please Try to Contact Us in other ways..</span>');}});}}function seller_enquiry_submit(){var username=$('#name');var sellermail=$('#email');var sellermsg=$('#message');var enquiry=$('#enquiry');var enquiry_error=$('#enquiry_error');var title=$('#title');var company=$('#company');var telephone=$('#telephone');var name_error=$('#name_error');var email_error=$('#email_error');var captcha_error=$('#captcha_error');var request_status=$('#status');var valid_name=0;var valid_email=0;valid_enquiry=0;valid_captcha=0;if(username.val()==''){username.focus();name_error.html('<span class="error">Please entrer your name </span>');return false;}else{name_error.html('');valid_name=1;}if(enquiry.val()==''){enquiry.focus();enquiry_error.html('<span class="error">What you want to enquire about. </span>');return false;}else{enquiry_error.html('');valid_enquiry=1;}if(sellermail.val()==''){sellermail.focus();email_error.html('<span class="error">Please entrer your Email id </span>')
return false;}else{email_error.html('');valid_email=1;}if(!emailvalidation(sellermail.val())){email_error.html('<span class="error">Please entrer valid Email id </span>')
return false;}else{email_error.html('');valid_email=1;}if(grecaptcha.getResponse()==""){captcha_error.html('<span class="error">Please verify yourself </span>');return false;}else{captcha_error.html('');valid_captcha=1;}if((valid_email==1)&&(valid_name==1)&&(valid_enquiry==1)&&(valid_captcha==1)){var captcha_val=$("textarea[name='g-recaptcha-response']").val();$.post("common_ajax.php",{ajax:1,ajax_task:'SellerEnquiry',name:username.val(),email:sellermail.val(),msg:sellermsg.val(),enquiry:enquiry.val(),title:title.val(),company:company.val(),telephone:telephone.val(),captcha_val:captcha_val},function(data,status){if(data==1){request_status.html('<span class="error" >E-Mail Sent successfully</span>');document.getElementById("seller-form").reset();}else if(data==0){request_status.html('<span class="error">Email is not Sent,Please Try to Contact Us in other ways..</span>');}else if(data==2){request_status.html('<span class="error" >Captcha is not matching please try again</span>');}});}}function voucherCodeExists(){var voucherID=$('#voucherID').val();if(voucherID==""){$('#voucher_error').html('Please Enter Voucher Code...');setTimeout(function(){$('#voucher_error').html('');},4000);return false;}else{$('#voucher_error').html('');$.ajax({type:"POST",url:'common_ajax.php',data:'ajax=1&ajax_task=giftVoucherValid&voucherID='+voucherID,success:function(data){if(data=="1"){$('#voucher_error').html('Invalid Voucher Code.');}else if(data=="2"){$('#voucher_error').html('No balance remaining in gift voucher.');}else{$('#voucher_error').html('');}setTimeout(function(){$('#voucher_error').html('');},4000);}});}}
