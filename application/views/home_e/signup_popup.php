<?php 	$getAllCountry=$this->admin->getAllCountry(); ?>
<div class="" id="login_loader_1" style="width:100%;height:100%;background-color: rgba(255,255,255,1);display:none;justify-content: center;align-items: center;position: fixed;top:0;z-index:6666666; background-position: center;">
   <div class="text-center">
   <img src="<?=base_url('assets/')?>home_e/images/loader/login_loader.gif"style="transition:2s" width="100px" class="">
   
   <!-- <div class="animate__animated animate__fadeInUp mt-lg-4 mt-2  d-flex col-12 justify-content-center align-items-center">
    <div class="text-danger">KreditAit &nbsp;</div> 
   </div> -->
   
   </div>
</div>

<!-- modal -->

<div class="modal fade" id="PopUp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
    	
      <div class="modal-body">
        <div class="container">
		   <div class="row">
			<div class="col-12">
			<div class="d-flex justify-content-end text-right">
		       <div type="button" class="close w-100" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </div></div></div>
			    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-0">
				
				<div class="login_right signUpForm px-xl-4 px-lg-5 px-md-3 py-1 px-3">
					<div class="logo text-center">
						<img src="<?=base_url('assets/')?>home_e/images/logo.png"  width="100px">
					</div>
					
					<div class="form_content_heading py-2 text-center">
						<h3 class="f_18 fw_300 tc_4 rt_16">Get started with a free  account</h3>
						<h4 class="f_13 rt_12 fw_300 ">Already have KreditAid account?<span class="tc_2 cp " id="LoginHere"> Log in here </span></h4>
					</div>
                    
                    <div class="" id="forSignInNotation" style="display:none"></div>
					<div class="form_content pt-1 ">
						<div class="" id="existAccount" style="display:none"></div>
                        <div class="d-flex justify-content-center">
						<form action="" id='otpFormPopUp' class="text-center">
							<input type="text" id="otp-inputPopUp" name="otp" autofocus placeholder="Enter Your OTP" class="form-controll f_15 pl-2"/>
							<br>
							<button class="mt-1 text-center mt-2 bg_2 text-white px-2 py-1 rounded border-0 f_14" id="otpButtonPopUp">Submit</button>
                            <div class="showTime mt-1"><span class="otpTimer"></span> Time For Resend Password</div>
                            <button class="mt-1 text-center mt-2 bg_4 text-white px-2 py-1 rounded border-0 f_14" id="resendOtpButtonPopUp"  style="display: none">Resend OTP</button>
                            <!--  -->
						</form>
                        
                      </div>
						<form id='signUpFormId'>
					  <div class="form-row">
					    <div class="form-group field input-field col-md-12 col-sm-12 col-12 pb-2">
					      <!-- <input type="text" class="col-12 p-0 f_14 pb-2" id="" placeholder="First Name">
					      <label>Last Name</label> -->
					       <input type="text" name="" required id="firstNameForSignUp">
					       <label class="f_14 tc_1 fw_300">First Name</label>
					       <div class="form_tooltip f_11 p-1 pl-2 rounded firstNameForSignUpTip">
					        <i class="fas fa-caret-up"></i>
					        Please enter first name
					       </div>
					      <!-- <input type="text" id="name" required class="col-12" />
                          <label for="name">Your name:</label> -->
					    </div>
					    <!-- <div class="form-group col-md-6 pb-4">
					      <input type="text" class="col-12 p-0 f_14 pb-2" id="" placeholder="Last Name">
					    </div> -->
                        
						<input type="hidden" name="redirectUrlPopUp" id='redirectUrlPopUp' value='1'>
						<input type="hidden"  class='cart_cin' value='1'>

					    <!-- <div class="form-group field  col-md-6 col-sm-6 col-12 pb-2">
					      <input type="text" name=""  required id="lastNameForSignUp" />
                          <label class="f_14 tc_1 fw_300">Last Name</label>
                          <div class="form_tooltip f_11 p-1 pl-2 rounded lastNameForSignUpTip">
					        <i class="fas fa-caret-up"></i>
					        Please enter Last name
					       </div>
					    </div> -->
					  </div>

					  <div class="form-row">
					    <div class="form-group field col-md-12 pb-2">
					      <input type="email" name=""  required id="emailForSignUp"/>
                          <label class="f_14 tc_1 fw_300">Email</label>
                          <div class="form_tooltip f_11 p-1 pl-2 rounded emailForSignUpTip">
					        <i class="fas fa-caret-up"></i>
					        Please enter Email
					       </div>
					    </div>
					    <div class="form-group field col-md-12 pb-2">
					      <img id="showpPopUp" src="<?=base_url('assets/')?>home_e/images/showp.png" width="19px" style="position: absolute;right:15px;bottom:30px" class="cp showpPopUp" >
                          <img id="hidepPopUp" src="<?=base_url('assets/')?>home_e/images/hidep.png" width="19px" style="position: absolute;right:15px;bottom:30px" class="cp hidepPopUp">
                          <input type="password" name=""  required id="passwordForSignUp" class="passwordType" />
                          <label class="f_14 tc_1 fw_300">Password</label>
                          <div class="form_tooltip f_11 p-1 pl-2 rounded passwordForSignUpTip">
					        <i class="fas fa-caret-up"></i>
					        Please enter Password
					       </div>
					    </div>
					    <div class="form-group field  col-md-12 col-sm-12 col-12 pb-4">
        			       <label >Select Your Country</label>
  					       <select class="form-control" id="countryForSignUp">
					       	<?php foreach($getAllCountry as $key ){ ?>
					       			<option value="<?= $key['name'] ?>"><?= $key['name'] ?></option>
					       	 <?php } ?>
					       </select>
					    </div>


					  </div>

					  <div class="form_validation_circle d-flex justify-content-between pb-3 flex-wrap">
					  	<div>
						  	<div class="d-flex justify-content-start align-items-center py-1">
							  	<div id="lengthErrPopUp"></div>
							  	<div class="f_11 tc_1 fw_500 ml-2">8 characters minimum</div>
						  	</div>
						  	<div class="d-flex justify-content-start align-items-center">
							  	<div id="upperCaseErrPopUp"></div>
							  	<div class="f_11 tc_1 fw_500 ml-2">One uppercase character</div>
						  	</div>
					    </div>
					  	<div>
						  	<div class="d-flex justify-content-start align-items-center py-1">
							  	<div id="lowerCaseErrPopUp"></div>
							  	<div class="f_11 tc_1 fw_500 ml-2">One lowercase character</div>
						  	</div>
						  	<div class="d-flex justify-content-start align-items-center">
							  	<div id="numberOrSymbolErrPopUp"></div>
							  	<div class="f_11 tc_1 fw_500 ml-2">One number or symbol</div>
						  	</div>
					    </div>
					  </div>
					
					  
					  <button type="submit" class="bg_2 p-2 rounded text-white border-0 w-100 submitSignUp">Sign Up</button>
					</form>

					<div class="terms_condition py-3">
						<span class="f_13 tc_1 rt_12">By clicking "Sign Up" you confirm that you accept the <a href="" class="tc_2">Terms and Conditions</a> and <a href="<?= $siteUrl ?>Privacy" class="tc_2"> Privacy Policy </a></span>
					</div>
                   <!--  
                    <div class="social_media_login text-center py-2">
                    	<div>
                    	 <span class="f_14 fw_500">or</span>
                    	 <h5 class="f_13 pt-3 tc_3 fw_300">Sign Up with</h5>
                        </div>

                        <div class="d-flex justify-content-around align-items-center pt-2">
                        	<div class="border py-1 rounded f_14 px-4"> <a href="" class="tc_0 fw_300"><img src="assets/images/google.png" alt="" height="15px" width="15px" class="mr-1">Google</a></div>
                        	<div class="border py-1 rounded f_14 px-4 tc_0"> <a href="" class="tc_0 fw_300"><img src="assets/images/google.png" alt="" height="15px" width="15px" class="mr-1">Google</a></div>
                        	<div class="border py-1 rounded f_14 px-4 tc_0"> <a href="" class="tc_0 fw_300"><img src="assets/images/google.png" alt="" height="15px" width="15px" class="mr-1">Google</a></div>
                    	
                        </div>

                    </div> -->

					</div>
				</div>

                <!-- -----------login---------------- -->

                <div class="login_right loginForm  px-xl-5 px-lg-5 px-md-3 py-5 px-3">
					<div class="logo text-center">
						<img src="<?=base_url('assets/')?>home_e/images/logo.png"  width="100px">
					</div>
					<div class="form_content_heading py-2 text-center">
						<h4 class="f_14 fw_300 login_forget_title">Sign in to your account</h4>
					</div>
                    <div id="loginValidator"></div>
					<div class="form_content pt-3">
						<form  id="signInFormId">
					  

					  <div class="form-row">
					    <div class="form-group field col-md-12 pb-4">
					      <input type="email" name=""  required  id='emailForSignIn' />
                          <label class="f_14 tc_1 fw_300">Email</label>
                          <div class="form_tooltip f_11 p-1 pl-2 rounded emailForSignInTip">
					        <i class="fas fa-caret-up"></i>
					        Please enter Email
					       </div>
					    </div>
                        <input type="hidden" name="redirectUrlPopUp" id='redirectUrlPopUp' value='1'>
                        <input type="hidden"  class='cart_cin' name="cart_cin" value='1'>
					    <div class="form-group field col-md-12 pb-4">
						  <img  src="<?=base_url('assets/')?>home_e/images/showp.png" width="19px" style="position: absolute;right:15px;bottom:30px" class="cp showpPopUp" >
                          <img  src="<?=base_url('assets/')?>home_e/images/hidep.png" width="19px" style="position: absolute;right:15px;bottom:30px" class="cp hidepPopUp">		
					      <input type="password" name=""  required  id='passwordForSignIn' class="passwordType" />
                          <label class="f_14 tc_1 fw_300">Password</label>
                          <div class="form_tooltip f_11 p-1 pl-2 rounded  passwordForSignInTip">
					        <i class="fas fa-caret-up"></i>
					        Please enter Password
					       </div>
					    </div>
					  </div>

					  <div class="form_validation_circle d-flex justify-content-between pb-3 flex-wrap forgetPassPointer">
					  	<span class="f_13 tc_2" style="cursor:pointer">Forgot Password ?</span>
					  </div>
					 <?php if(0){ ?>
					  <div class="form_validation_circle d-flex justify-content-between pb-3 flex-wrap resetPassPointer">
					  	<span class="f_13 tc_2">Reset Password ?</span>
					  </div> 
					 <?php } ?>
					  <button type="submit" class="bg_2 p-2 rounded text-white border-0 w-100 submitSignInPopUp">Sign In</button>
					</form>
                    <!-- -----------forget Password---------------- -->
                    <form  id="forgetPassword" style="display:none">
					  <div class="form-row">
					    <div class="form-group field col-md-12 pb-4">
					      <input type="email" name=""  required  id='emailForForgetPass' />
                          <label class="f_14 tc_1 fw_300">Email</label>
                          <div class="form_tooltip f_11 p-1 pl-2 rounded emailForForgetPassTip">
					        <i class="fas fa-caret-up"></i>
					        Please enter Email
					       </div>
					    </div>
                        
					    <!-- <div class="form-group field col-md-12 pb-4">
					      <input type="password" name=""  required  id='passwordForSignIn' />
                          <label class="f_14 tc_1 fw_300">Password</label>
                          <div class="form_tooltip f_11 p-1 pl-2 rounded  passwordForSignInTip">
					        <i class="fas fa-caret-up"></i>
					        Please enter Password
					       </div>
					    </div> -->
					  </div>

					  <div class="form_validation_circle d-flex justify-content-between pb-3 flex-wrap showLogin">
					  	<span class="f_13 tc_2" style="cursor:pointer" >Go To Login Form</span>
					  </div>
                      					  
					  <button type="submit" class="bg_2 p-2 rounded text-white border-0 w-100 submitForForgetPasswordOTP">Submit</button>
				    </form>
                    
                    <form  id="forgetPasswordOTPForm" style="display:none">
					  <div class="form-row">
					    
                        <div class="form-group field col-md-12 pb-4">
					      <input type="text" name=""  required  id='ForgetPassOTPInput' />
                          <label class="f_14 tc_1 fw_300">OTP</label>
                          <div class="form_tooltip f_11 p-1 pl-2 rounded ForgetPassOTPTip">
					        <i class="fas fa-caret-up"></i>
					            Please enter OTP
					       </div>
					    </div>
					    <!-- <div class="form-group field col-md-12 pb-4">
					      <input type="password" name=""  required  id='passwordForSignIn' />
                          <label class="f_14 tc_1 fw_300">Password</label>
                          <div class="form_tooltip f_11 p-1 pl-2 rounded  passwordForSignInTip">
					        <i class="fas fa-caret-up"></i>
					        Please enter Password
					       </div>
					    </div> -->
					  </div>

					  <!-- <div class="form_validation_circle d-flex justify-content-between pb-3 flex-wrap showLogin">
					  	<span class="f_13 tc_2">Go To Login Form</span>
					  </div> -->
                      <button type="submit" class="bg_2 p-2 rounded text-white border-0 w-100 submitForgetPasswordOTP">Submit OTP</button>					  
				    </form>
                    <form  id="newPasswordForm" style="display:none">
					  <div class="form-row">
					    
                        <div class="form-group field col-md-12 pb-4">
						  <img  src="<?=base_url('assets/')?>home_e/images/showp.png" width="19px" style="position: absolute;right:15px;bottom:30px" class="cp showpPopUp" >
                          <img  src="<?=base_url('assets/')?>home_e/images/hidep.png" width="19px" style="position: absolute;right:15px;bottom:30px" class="cp hidepPopUp">		
					      <input type="password" name=""  required  id='newPassword' type="passwordType" />
                          <label class="f_14 tc_1 fw_300">Set New Password</label>
                          <div class="form_tooltip f_11 p-1 pl-2 rounded newPasswordTip">
					        <i class="fas fa-caret-up"></i>
					            Please Enter New Password
					       </div>
					    </div>
					  </div>

					  <!-- <div class="form_validation_circle d-flex justify-content-between pb-3 flex-wrap showLogin">
					  	<span class="f_13 tc_2">Go To Login Form</span>
					  </div> -->
                      <button type="submit" class="bg_2 p-2 rounded text-white border-0 w-100 newPasswordSubmit">Set New Password</button>					  
				    </form>   
                <!-- -----------forget Password End---------------- -->  
				<?php if(0){ ?>
					<!--======================= reset Password Start ======================-->
					
                    <form  id="resetPassword" style="display:none">
					  <div class="form-row">
					    <div class="form-group field col-md-12 pb-4">
						  <img  src="<?=base_url('assets/')?>home_e/images/showp.png" width="19px" style="position: absolute;right:15px;bottom:30px" class="cp showPopUpPrevPass" >
                          <img  src="<?=base_url('assets/')?>home_e/images/hidep.png" width="19px" style="position: absolute;right:15px;bottom:30px" class="cp hidePopUpPrevPass">		
					      <input type="Password" name=""  required  id='prevPasswordForReset' class="popUpPrevPassType"/>
                          <label class="f_14 tc_1 fw_300">Previous Password</label>
                          <div class="form_tooltip f_11 p-1 pl-2 rounded prevPasswordForResetTip">
					        <i class="fas fa-caret-up"></i>
					        Please enter Previous Password
					       </div>
					    </div>
                        
					    <div class="form-group field col-md-12 pb-4">
						  <img  src="<?=base_url('assets/')?>home_e/images/showp.png" width="19px" style="position: absolute;right:15px;bottom:30px" class="cp showPopUpNewPass" >
                          <img  src="<?=base_url('assets/')?>home_e/images/hidep.png" width="19px" style="position: absolute;right:15px;bottom:30px" class="cp hidePopUpNewPass">			
					      <input type="password" name=""  required  id='newPasswordForReset' class="popUpNewPassType"/>
                          <label class="f_14 tc_1 fw_300">New Password</label>
                          <div class="form_tooltip f_11 p-1 pl-2 rounded  newPasswordForResetTip">
					        <i class="fas fa-caret-up"></i>
					        Please enter New Password
					       </div>
					    </div>
					  </div>

					  <div class="form_validation_circle d-flex justify-content-between pb-3 flex-wrap showLogin">
					  	<span class="f_13 tc_2">Go To Login Form</span>
					  </div>
                      					  
					  <button type="submit" class="bg_2 p-2 rounded text-white border-0 w-100 submitForResetPassword">Reset Password</button>
				      <div class="form_validation_circle d-flex justify-content-between pb-3 flex-wrap">
					  	<div>
						  	<div class="d-flex justify-content-start align-items-center py-1">
							  	<div id="lengthErrPopUpResetPass"></div>
							  	<div class="f_11 tc_1 fw_500 ml-2">8 characters minimum</div>
						  	</div>
						  	<div class="d-flex justify-content-start align-items-center">
							  	<div id="upperCaseErrPopUpResetPass"></div>
							  	<div class="f_11 tc_1 fw_500 ml-2">One uppercase character</div>
						  	</div>
					    </div>
					  	<div>
						  	<div class="d-flex justify-content-start align-items-center py-1">
							  	<div id="lowerCaseErrPopUpResetPass"></div>
							  	<div class="f_11 tc_1 fw_500 ml-2">One lowercase character</div>
						  	</div>
						  	<div class="d-flex justify-content-start align-items-center">
							  	<div id="numberOrSymbolErrPopUpResetPass"></div>
							  	<div class="f_11 tc_1 fw_500 ml-2">One number or symbol</div>
						  	</div>
					    </div>
					  </div>	
					</form>
					<!--========================== Reset Password End =========================== -->
					<?php } ?>	
					<!-- 
                    <div class="social_media_login text-center py-2">
                    	<div>
                    	 <span class="f_14 fw_500">or</span>
                    	 <h5 class="f_13 pt-3 tc_3 fw_300">Sign Up with</h5>
                        </div>

                       <div class="d-flex justify-content-around align-items-center pt-2">
                        	<div class="border py-1 rounded f_14 px-4"> <a href="" class="tc_0 fw_300"><img src="assets/images/google.png" alt="" height="15px" width="15px" class="mr-1">Google</a></div>
                        	<div class="border py-1 rounded f_14 px-4 tc_0"> <a href="" class="tc_0 fw_300"><img src="assets/images/google.png" alt="" height="15px" width="15px" class="mr-1">Google</a></div>
                        	<div class="border py-1 rounded f_14 px-4 tc_0"> <a href="" class="tc_0 fw_300"><img src="assets/images/google.png" alt="" height="15px" width="15px" class="mr-1">Google</a></div>
                    	
                        </div>

                    </div> -->

					</div>

					<hr>
                    <div class="text-center">
                    	<h5 class="f_13 fw_300">Don't have an account?<span class="tc_2 cp " id="CreateAccount"> Create Account</span> </h5>
                    </div>

				</div>
                <!-- login end  -->
                
			</div>
							
        </div>
        </div>
      </div>
     
    </div>
  </div>
</div>

