<style>
    .product_img{
        .display: inline;
        height: 400px;
        left: -92px;
        margin: 0;
        padding: 0;
        top: -127px;
        width: 300px;
    }
    .starrr {
        display: inline-block; }
    .starrr a {
        font-size: 16px;
        padding: 0 1px;
        cursor: pointer;
        color: #FFD119;
        text-decoration: none; }

    .rating {
        border: none;
        float: left;
    }

    .rating > input { display: none; }
    .rating > label:before {
        margin: 5px;
        font-size: 1.25em;
        font-family: FontAwesome;
        display: inline-block;
        content: "\f005";
    }

    .rating > .half:before {
        content: "\f089";
        position: absolute;
    }

    .rating > label {
        color: #ddd;
        float: right;
    }

    .rating > input:checked ~ label,
    .rating:not(:checked) > label:hover,
    .rating:not(:checked) > label:hover ~ label { color: #ffdc2e;  }

    .rating > input:checked + label:hover,
    .rating > input:checked ~ label:hover,
    .rating > label:hover ~ input:checked ~ label,
    .rating > input:checked ~ label:hover ~ label { color: #FFED85;  }

</style>
<script src="https://code.jquery.com/jquery.min.js"></script>
<script src="<?php echo SITE_URL;?>assets/js/starr.js"></script>
<?php
$conn=dbconnection();
$seo1 = utf8_urldecode($seo1);
$product_id=$_REQUEST['product_id'];
$query = "SELECT SQL_NO_CACHE p.ProductID,p.Title,p.Description,p.product_alis_link,
          p.product_status FROM tbl_products p 
          where p.ProductID='$product_id' order by p.ProductID ASC";
$conn->set_charset("utf8");
$query_vals    = mysqli_query($conn,$query);
$numrows = mysqli_num_rows($query_vals);
$result = mysqli_fetch_array($query_vals);
$ProductID        = $result['ProductID'];
$Title            = $result['Title'];
$Description      = $result['Description'];
$product_status      = $result['product_status'];
$product_alis_link  = $result['product_alis_link'];
$Description = str_replace("<div>","",$Description);
$Description = str_replace("</div>","",$Description);
$Description = sanitize_parse($Description);
$user_id=$_SESSION['userid'];


if(!isset($_SESSION['userid']))
    $write_review_url= SITE_URL."login";
else
    $write_review_url= SITE_URL."write-review";
?>
<!-- <div class="clearfix"></div>-->
<div class="container-fluid">
    <div class="content-wrapper">
        <div class="item-container1">
            <div class="container">
                <div class="row">
                    <a href="<?php echo SITE_URL;?><?php echo $product_alis_link; ?>" >>> GO BACK TO PRODUCT</a>
                    <hr/>
                    <div class="col-md-3">

                        <h4>Your review of this product</h4>
                         <?php $Prod_img = sigleProductImageDisplays($ProductID);
                            foreach($Prod_img['productImg'] as $Prod_imgRrows){
                                ?>
                                    <img class="product_img img-responsive" src="<?php echo SITE_URL;?><?php echo $Prod_imgRrows->img_link;?>"  />
                            <?php } ?>
                    </div>
                    <div class="col-md-6" >
                        <div class="product-title" style="margin-top: 50px;font-size: 14px;"><?php echo $Title; ?></div>
                       <div id="review_container">
                            <div>
                                <span style="font-size: 16px;"><b>Rate It:</b></span><br>
                                <fieldset id="ratings" class="rating">
                                    <input class="stars" type="radio" id="star5" name="rating" value="5">
                                    <label class="full" for="star5" title="Awesome - 5 stars"></label>
                                    <input class="stars" type="radio" id="star4half" name="rating" value="4.5">
                                    <label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                    <input class="stars" type="radio" id="star4" name="rating" value="4">
                                    <label class="full" for="star4" title="Pretty good - 4 stars"></label>
                                    <input class="stars" type="radio" id="star3half" name="rating" value="3.5">
                                    <label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                    <input class="stars" type="radio" id="star3" name="rating" value="3">
                                    <label class="full" for="star3" title="Meh - 3 stars"></label>
                                    <input class="stars" type="radio" id="star2half" name="rating" value="2.5">
                                    <label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                    <input class="stars" type="radio" id="star2" name="rating" value="2">
                                    <label class="full" for="star2" title="Kinda bad - 2 stars"></label>
                                    <input class="stars" type="radio" id="star1half" name="rating" value="1.5">
                                    <label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                    <input class="stars" type="radio" id="star1" name="rating" value="1">
                                    <label class="full" for="star1" title="Sucks big time - 1 star"></label>
                                    <input class="stars" type="radio" id="starhalf" name="rating" value="0.5">
                                    <label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                                </fieldset><br/><br/>
                                <div id="rating_err"></div>
                            </div><br/>
                            <div>
                                <span style="font-size: 16px;"><b>Review It:</b></span><br>
                                <span><label>Subject<sup>*</sup></sup></label></span><br>
                                <span><input class="form-control" type="text" placeholder="subject" id="review_subject" name="review_subject"> </span>
                                <div id="subject_err"></div>
                            </div>
                            <div>
                                <span><label>Review*<sup>*</sup></sup></label></span><br>
                                <span><textarea class="form-control" id="review"></textarea></span>
                                <div id="review_err"></div>
                            </div>
                            <div>
                                <br>
                                <input class="btn btn-primary btn-lg btn-block" type="button" value="Send my review" id="send_my_review">
                            </div>
                       </div>
                        <div id="review_message_container" style="font-size: 16px">
                            Thank you for review
                        </div>
                     </div>
                </div>
            </div>
         </div>
    </div>
</div>

<script>
    $("#review_message_container").hide();
    $('.starrr').starrr();
    var rating="";
   /* $('.starrr').on('starrr:change', function(e, value){
        rating =value;
    });*/
   // var rate="";
    $("#ratings .stars").click(function () {
        rating=$(this).val();
        $(this).attr("checked");
    });
    $('#send_my_review').click(function () {
        var user_id='<?php echo $user_id;?>';
        var product_id='<?php echo $product_id;?>';
        var review_subject=$('#review_subject').val();
        var review=$('#review').val();

        if(rating!="" && review!="" && review_subject!="") {
            $.ajax({
                type: "POST",
                url: 'common_ajax.php',
                data: 'ajax=1&ajax_task=AddReview&user_id=' + user_id + '&product_id=' + product_id + '&review_subject=' + review_subject + '&review=' + review + '&rating=' + rating,
                success: function (data) {
                    if (data == 1) {
                        $("#review_container").hide();
                        $("#review_message_container").show().css('color','green');
                    }
                }
            });
        }
        else{
           if(rating=="" && review_subject!="" && review!="" ){
               $('#rating_err').show();
               $('#rating_err').text("Please give your ratings").css("color","red");
               $('#subject_err,#review_err').hide();
               return false;
           }
            else if(review_subject=="" && rating!="" && review!="" ){
               $('#subject_err').show();
               $('#subject_err').text("Please enter rating subject").css("color","red");
               $('#rating_err,#review_err').hide();
               return false;
           }
           else if(review_subject!="" && rating!="" && review=="" ){
               $('#review_err').show();
               $('#review_err').text("Please enter review").css("color","red");
               $('#subject_err,#rating_err').hide();
               return false;
           }
           else if(review_subject=="" && rating!="" && review=="" ){
               $('#review_err,#subject_err').show();
               $('#review_err').text("Please enter review").css("color","red");
               $('#subject_err').text("Please enter rating subject").css("color","red");
               $('#rating_err').hide();
               return false;
           }
           else if(review_subject=="" && rating=="" && review!="" ){
               $('#subject_err,#rating_err').show();
               $('#rating_err').text("Please give your ratings").css("color","red");
               $('#subject_err').text("Please enter rating subject").css("color","red");
               $('#review_err').hide();
               return false;
           }
           else if(review_subject!="" && rating=="" && review=="" ){
               $('#review_err,#rating_err').show();
               $('#rating_err').text("Please give your ratings").css("color","red");
               $('#review_err').text("Please enter review").css("color","red");
               $('#subject_err').hide();
               return false;
           }
           else if(review_subject=="" && rating=="" && review=="" ){
               $('#review_err,#rating_err,#subject_err').show();
               $('#rating_err').text("Please give your ratings").css("color","red");
               $('#review_err').text("Please enter review").css("color","red");
               $('#subject_err').text("Please enter rating subject").css("color","red");
               return false;
           }
        }
    });

</script>
