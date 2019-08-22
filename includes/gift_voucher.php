<div class="panel-body">
    <div class="col-lg-8 col-lg-offset-2">
        <form class="form-horizontal" role="form" id="gift_voucher"  method="post" name="gift_voucher" >
            <div style="" class="voucher_image">
                <img style="height: 100px;" src="<?php echo SITE_URL.'assets/img/gift_voucher_logo.jpg';?>" alt="gift_voucher_logo">
            </div>

            <div class="form-group">
                <label for="inputEmail1" class="col-lg-3 col-sm-6 col-xs-4 label-style">Enter Voucher Amount</label>
                <div class="col-lg-8 col-sm-6 col-xs-8">
                    <input type="text" class="text-style" id="voucher_amount" name="voucher_amount" placeholder="" value="">

                    <!--<select class="form-control text-style" id="voucher_amount" name="voucher_amount">
                        <option value="">select voucher amount</option>

                        <?php
/*                        $conn=dbconnection();
                        $stmt ="SELECT `id`, `voucher_amount`, `voucher_name` FROM `tbl_gift_list` WHERE expires_on > CURDATE();";
                        $vid_comment =  mysqli_query($conn,$stmt);
                        while ($row = mysqli_fetch_assoc($vid_comment)){
                            */?>

                            <option value="<?php /*echo $row['voucher_amount'];*/?>" ><?php /*echo $row['voucher_amount'];*/?></option>
                        <?php /* } //} */?>
                    </select>-->
                    <p class="help-block"></p>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail1" class="col-lg-3 col-sm-6 col-xs-4 label-style">Name</label>
                <div class="col-lg-8 col-sm-6 col-xs-8">
                    <input type="text" class="text-style" id="gv_name" name="gv_name" placeholder="" value="">
                    <p class="help-block"></p>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail1" class="col-lg-3 col-sm-6 col-xs-4 label-style">Email Address</label>
                <div class="col-lg-8 col-sm-6 col-xs-8">
                    <input type="text" class="text-style" id="gv_email" name="gv_email" placeholder="" value="">
                    <p class="help-block"></p>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail1" class="col-lg-3 col-sm-6 col-xs-4 label-style">Phone No.</label>
                <div class="col-lg-8 col-sm-6 col-xs-8">
                    <input type="text" class="text-style" id="gv_phone" name="gv_phone" placeholder="" value="">
                    <p class="help-block"></p>
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail1" class="col-lg-3 col-sm-6 col-xs-4 label-style">Special Message</label>
                <div class="col-lg-8 col-sm-6 col-xs-8">

                    <textarea class="textarea text-style" placeholder="" id="gv_spl_msg" name="gv_spl_msg" style="height: 100px; font-size: 14px; line-height: 10px;"></textarea>

                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail1" class="col-lg-3 col-sm-6 col-xs-4 label-style">Recipient's Name</label>
                <div class="col-lg-8 col-sm-6 col-xs-8">
                    <input type="text" class="text-style" id="gv_rname" name="gv_rname" placeholder="" value="">
                    <p class="help-block"></p>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail1" class="col-lg-3 col-sm-6 col-xs-4 label-style">Recipient's Email</label>
                <div class="col-lg-8 col-sm-6 col-xs-8">
                    <input type="text" class="text-style" id="gv_remail" name="gv_remail" placeholder="" value="">
                    <p class="help-block"></p>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail1" class="col-lg-3 col-sm-6 col-xs-4 label-style">Phone No.</label>
                <div class="col-lg-8 col-sm-6 col-xs-8">
                    <input type="text" class="text-style" id="gv_rphone" name="gv_rphone" placeholder="" value="">
                    <p class="help-block"></p>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <label class="pay_via">PAY VIA</label>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <input type="radio" name="payment_method" value="mpese"> <img style="height: 50px;" src="<?php echo SITE_URL. "assets/img/mpesa_logo.jpg"?>" alt="mpesa_logo">
                    <input type="radio" name="payment_method" value="paypal"> <img style="height: 50px;" src="<?php echo SITE_URL. "assets/img/paypal_logo.jpg"?>" alt="paypal_logo">
                    <img style="margin-left: -5px;height: 50px;" src="<?php echo SITE_URL. "assets/img/mastercard-logo.jpg"?>" alt="mastercard-logo">
                    <img style="margin-left: -5px;height: 50px;" src="<?php echo SITE_URL. "assets/img/visa_logo.jpg"?>" alt="visa_logo">

                </div>
                <p class="help-block"></p>
            </div>
            <div class="form-group" style="float:right">
                <div class="">
                    <button type="submit" class="pay_via" id="gift_voucher_checkout"  value="CONTINUE TO CHECKOUT >>">CONTINUE TO CHECKOUT >></button>
                </div>
            </div>
            <?php
                $paypal_id = 'testing@gmail.com';
            ?>
            <input type="hidden" name="business" value="<?php echo $paypal_id; ?>">
            <input type="hidden" name="cmd" value="_xclick">
            <!--<input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="hosted_button_id" value="GN3KFCRCQYQUU">-->
            <input type="hidden" name="item_number" value="">

           <!-- <input type="hidden" name="recipient_email" value="">
            <input type="hidden" name="recipient_name" value="">
            <input type="hidden" name="sender_email" value="">
            <input type="hidden" name="sender_name" value="">-->
            
            <input type="hidden" name="amount" value="">
            <input type="hidden" name="currency_code" value="USD">
            <!-- Specify URLs -->
            <input type='hidden' name='cancel_return' value='<?php echo SITE_URL;?>'>
            <input type='hidden' name='return' value='<?php echo SITE_URL."payment-success/";?>'>


        </form>
    </div>
</div>
