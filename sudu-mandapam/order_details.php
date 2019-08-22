<style>
    .pre_tag{
        display: block;
        font-family: Helvetica Neue,Helvetica,Arial,sans-serif;
        margin: 0 0 10px;
        font-size: 14px;
        color: black;
        white-space: pre-wrap;
        word-break: normal;
        word-wrap: break-word;
        background-color: #fff;
        border: none;
        border-radius: 0px;
       padding: 0px;
    }

</style>
<?php
include "include/function.php";
isNotLogin();
$conn = dbconnection();
$order_id = mysqli_real_escape_string($conn,$_GET['orderId']);
/*if(isset($edit_id)){

}else {

}*/
$order_details = getOrderConfirmDetails($order_id);
$shipping_details = getShippingDetails($order_id);
$shipping_cost_details = getShippingCostDetails($order_id);
?>
<!DOCTYPE html>
<html>
<!-- header style start-->
<?php include "header_style.php"; ?>
<!-- header style start-->
<body class="skin-black">
<!-- header menu start-->
<?php include "header_menu.php"; ?>
<!-- header menu  end-->
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- header left start-->
    <?php include "header_left.php"; ?>
    <!-- header left end-->

    <!-- Right side column. Contains the navbar and content of the page -->
    <aside class="right-side">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Product Full Details
                        </header>
                        <div class="panel-body">
                            <div class="col-lg-12" id="dvContents">
                             <input type="button" onclick="PrintDiv();" value="Print" style="float: right;" />
                                <form class="form-horizontal" role="form" id="addcates" name="addcates">
                                    <div id="products_details">
                                        <table class="table"  >
                                            <thead>
                                            <tr>
                                                <th>Product Name</th>
                                                <th>Image</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php  $total = 0;
                                                        $shipping_cost=0;
                                                    while($result = mysqli_fetch_array($order_details)){
                                                        $Prod_img = get_product_img($result['ProductID']);
                                                        $subtotal = ($result['price'] * $result['qut']);
                                                        if($Prod_img=="")
                                                            $img_url=SITE_URL."assets/img/No-Image.jpg";
                                                        else
                                                            $img_url=SITE_URL.$Prod_img;
                                                    ?>
                                                    <tr>
                                                         <td><?php echo $result['Title'];?></td>
                                                         <td><img style="height: 100px;width: 80px;" class="lazy -loaded" src="<?php echo $img_url;?>" >
                                                         </td>
                                                         <td><?php echo $result['price'];?></td>
                                                         <td><?php echo $result['qut'];?> - <?php echo $result['weight'] ?></td>
                                                         <td>Rs. <?php echo adminAmountFormat($subtotal); ?>.00</td>
                                                     </tr>

                                               <?php $total = ($total + $subtotal);
                                                    }
                                                $grand_total = $total + $shipping_cost;
                                                ?>

                                            </tbody>
                                        </table>
                                    </div>
                                    
                                    <div id="amount_details" style="float:left; width: 100%;">
                                        <h4>Cart Totals</h4>
                                        <table class="aa-totals-table">
                                            <tbody>
                                            <tr>
                                                <th>Shipping Cost: </th>
                                                <td>Rs. <?php echo adminAmountFormat($shipping_cost_details['shipping_cost']); ?>.00</td>
                                            </tr>
                                            <tr>
                                                <th>Discount Amount: </th>
                                                <td>Rs. <?php echo adminAmountFormat($shipping_cost_details['disout_amt']); ?>.00</td>
                                            </tr>
                                            <tr>
                                                <th>Total: </th>
                                                <td>Rs. <?php echo adminAmountFormat($shipping_cost_details['total']); ?>.00</td>
                                            </tr>
                                            <tr>
                                                <th>Grand Total: </th>
                                                <td>Rs. <?php echo adminAmountFormat($shipping_cost_details['grand_total']); ?>.00</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    
                                    <div id="shipping_add_details" style="float: left; width: 300px;">
                                        <div><h4>From</h4>
                                            <p><pre class="pre_tag">spsbrands.com, 95FIII,</pre></p>
                                            <p>Pudur west street, singaravel eye hospital (near),</p>
                                            <p>poolampatti road, </p>
                                            <p>idappadi TK, Salem DT.</p>
                                            <p>Pincode : 637101</p>
                                            <p>tamilnadu</p>
                                            <p>Contact Number : +91 9524065549</p>
                                        </div>
                                    </div>
                                    <div id="shipping_add_details" style="float: left">
                                        <div><h4>To</h4>
                                            <p><?php echo $shipping_details['name'];?> </p>
                                            <p><pre class="pre_tag"><?php echo $shipping_details['address'];?></pre></p>
                                            <p><?php echo $shipping_details['city'].", ".$shipping_details['districk'].", "." - ".$shipping_details['zip'];?></p>
                                            <p>Email : <?php echo $shipping_details['shipping_email'];?></p>
                                            <p>Contact Number : <?php echo $shipping_details['shipping_mobile'];?></p>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </section>

                </div>
            </div><!--row1-->


        </section><!-- /.content -->
    </aside><!-- /.right-side -->
    <!-- header left start-->
    <?php include "footer.php"; ?>
    <!-- header left end-->
</div><!-- ./wrapper -->
<!-- jQuery 2.0.2 -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script src="js/jquery.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="css/wysiediercss.css"></link>
<!-- Bootstrap -->
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<!-- Director App -->
<script type="text/javascript" src="js/jquery.validate.js" language="javascript"></script>
<script src="js/common-scripts.js" type="text/javascript"></script>
<script src="js/add_products.js" type="text/javascript"></script>
<script src=js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.js"></script>
<script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<script>
    $('.textarea').wysihtml5({
        toolbar: {
            fa: true
        }
    });
    function PrintDiv() {
            var divContents = document.getElementById("dvContents").innerHTML;
            var printWindow = window.open('', '', 'height=200,width=400');
            printWindow.document.write('<html><head><title>DIV Contents</title>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }
</script>
<style>
    #button_save .btn {
        padding: 10px 27px !important;
        font-size: 18px !important;
    }
    .form-group .col-lg-8 {
        margin-top: 7px;
    }
</style>
</body>
</html>
