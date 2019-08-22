<section id="aa-product-category" class="static_content">
    <div class="container">
        <div class="row">
<?php include_once 'includes/config.php'; ?>
<div class="col-md-12">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <form  id="contact-form">
                <div class="modal-body">
                    <div class="row">
                        <p>Whether you have any questions, comments or you would like to keep in touch, just drop us a line using the form below. We’d love to connect with you. Your email address will not be published. Required fields are marked.</p>
                        <div class="col-md-12 col-sm-12">
                            <input type="text" placeholder="Enter your Name" class="form-control" id="clientname" name="clientname" required>
                            <div id="name_error"></div>

                        </div>
                        <div class="col-md-12 col-sm-12">
                            <br/>
                            <input type="email" placeholder="Enter your E-mail" class="form-control" id="clientemail" name="clientemail" required> 
                            <div id="email_error"></div>
                            <br/>
                        </div>
                        <div class="col-md-12">
                            <textarea id="message" name="message" rows="4" style="width: 100%;"> </textarea>
                        </div>
                       <!-- <div class="col-md-12">
                            <div class="g-recaptcha" data-sitekey="6LdvSwoUAAAAAMEAX0KfDvXRqP1r3BOPU3oj0_iQ" ></div>
                            <span id="captcha_error"></span>
                        </div>-->
                    </div>
                </div>
                <div class="modal-footer">
                    <div>
                        <div id="status"></div>
                        <button onclick="contact_form_submit();" class="btn btn-primary btn-lg btn-block" type="button">Send</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="address">
                <p>
                <br/><br/>spsbrands.com, 95FIII, Pudur west street, singaravel eye hospital (near), poolampatti road, idappadi,tamilnadu.</span>
                </p>                
                <p>
                95240 65549 
                </p>
                <p>	
                      <a href="mailto:spsbrands.com@gmail.com"> spsbrands.com@gmail.com</a> 
                </p>
                <p>
                96885 95276 
                </p>
<!--                <p>
                    <img src="<?php //echo $imgsrc; ?>/skype.png" /> :ccczx
                </p>-->
            </div>
            <!--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3887.1930839298316!2d77.64436031525534!3d13.023372990821896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae17321c6fb95f%3A0x5741b98287cc8709!2sPhoto+Printing!5e0!3m2!1sen!2sin!4v1515910604839" 
                    width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>-->
        </div>
    </div>
</div>
        </div>
    </div>
</section>