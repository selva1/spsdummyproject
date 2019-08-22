<div class="col-md-12">
	<div class="row">
		<div class="col-md-6 col-sm-12 col-xs-12">
			<div class="table-responsive curved_border">                 
                <table class="table">
                	<tbody>
                		<tr>
                			<th> Telephone:</th>
                			<td> (800) 0123 4567 890 </td>
                		</tr>
                		<tr>
                			<th> Mobile:</th>
                			<td> 0733700093 </td>
                		</tr>
                		<tr>
                			<th> Email: </th>
                			<td>  <a href="mailto:testing@gmail.com">testing@gmail.com</a> </td>
                		</tr>
                		<tr>
                			<th> Office Location: </th>
                			<td> Kindaruma Road,Off RingrRing Road,Kilimani,Nairobi Kenya </td>
                		</tr>
                		
                	</tbody>
				</table>
			</div>
		</div>
		<div class="col-md-6 col-sm-12 col-xs-12">
			<h1></h1>
			<h1 style="color:rgb(255,0,0);">Enquiry Form</h1>
			<div class="row">
				<form  id="seller-form">
			    	<div class="modal-body">						
                        <div class="col-md-12">
                            <input type="text" placeholder="Enter your Name *" class="form-control" id="name" name="name" required>
                            <span id="name_error"></span>
                        </div>
							
                        <div class="col-md-12">
                            <input type="email" placeholder="Enter your E-mail *" class="form-control" id="email" name="email" required>
                            <span id="email_error"></span>
                        </div>
							
						<div class="col-md-12">
                            <input type="text" placeholder="Enquire About * " class="form-control" id="enquiry" name="enquiry" required>
                            <span id="enquiry_error"></span>
                        </div>

                        <div class="col-md-12">
                            <input type="text" placeholder="Enquire Title" class="form-control" id="title" name="title">
                        </div>
							
						<div class="col-md-12">
                            <input type="text" placeholder="Company" class="form-control" id="company" name="company" >
                        </div>
							
                        <div class="col-md-12">
                            <input type="text" placeholder="Telephone" class="form-control" id="telephone" name="telephone">
                        </div>
							
						<div class="col-md-12">
                            <textarea id="message" name="message" rows="10" > </textarea>
                        </div>
                        <div class="col-md-12">
							<div class="g-recaptcha" data-sitekey="6LdvSwoUAAAAAMEAX0KfDvXRqP1r3BOPU3oj0_iQ" ></div>
							<span id="captcha_error"></span>
						</div>
					</div>

					
				    <div class="modal-footer">
			                <div>
								<div id="status"></div>
			                    <button onclick="seller_enquiry_submit();" class="btn btn-primary seller_form" type="button">Send</button>
			                </div>

				    </div>
			        </form>
            </div>
			</div>
		</div>
	</div>
	