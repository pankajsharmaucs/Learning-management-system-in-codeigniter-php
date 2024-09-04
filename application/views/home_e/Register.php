<?php 


	$getAllCountry=$this->admin->getAllCountry();

// var_dump($getAllCountry);die();

 ?>
<div class="" id="login_loaderPage_1" style="width:100%;height:100%;background-color: rgba(255,255,255,1);display:none;justify-content: center;align-items: center;position: fixed;top:0;z-index:6666666; background-position: center;">
   <div class="text-center">
   <img src="<?=base_url('assets/')?>home_e/images/loader/login_loader.gif"style="transition:2s" width="100px" class="">
   
   <!-- <div class="animate__animated animate__fadeInUp mt-lg-4 mt-2  d-flex col-12 justify-content-center align-items-center">
    <div class="text-danger">KreditAit &nbsp;</div> 
   </div> -->
   
   </div>
</div>
<?php
if(isset($_SESSION['auth_user'])){ 

	// var_dump($_SESSION);

	if($_SESSION['logType']=='signIn')
	{
		header('location:'.base_url('/').'User_Dashboard?a=3');die;
	}
	if($_SESSION['logType']=='signUp')
	{
		header('location:'.base_url('/').'User_Dashboard?a=1');die;
	}
	 
	// echo $_SESSION['logged_in']['id'];
}
// var_dump($_SESSION['logged_in']['email']);
?>
<section >
	<div class="container-fluid">
		<div class="row loginFormBox" style="position: relative; height:100vh">
			
			<div class="col-xl-12 p-0" >
				<div class="login_left bgi_2 d-lg-block d-xl-block d-md-block  d-none">
					<div class="login_from_overlay d-flex justify-content-around align-items-center pt-0">
						
						<div class="text-left ">
							<img src="<?=base_url('assets/')?>home_e/images/home/logo.png"  alt="">
							<div class="form_content">
							 <h2 class="">Business Report <br> Complete company profile </h2>
						    </div>
						</div>
						<div></div>

					</div>
				</div>
			</div>
			<div class="loginFormFixed" style="width: 450px; position:absolute; right:0; top:0; background:#fefefe; height: 100%;">
				
				<div class="login_right signUpFormPage  px-xl-4 px-lg-5 px-md-3 py-5 px-3" style="display: none;">
					<div id="existAccountPage"></div>
					<div class="logo text-center">
						<img src="<?=base_url('assets/')?>home_e/images/logo.png" width="100px">
					</div>
					
					<div class="form_content_heading py-2 text-center">
						<h3 class="f_18 fw_300 tc_4 rt_16">Get started with a free account</h3>
						<h4 class="f_13 rt_12 fw_300 ">Don't have KreditAid account?<span class="tc_2 cp " 
							onclick='$(".loginFormPage").show();$(".signUpFormPage").hide();'> Login Now! </span></h4>
					</div>
					<div class="form_content pt-3 forLoader">
					<img src="<?=base_url('assets/')?>home_e/images/loader/signUpLoginLoader.gif" alt=""  id="signUpLoginLoader" style="display:none;">
					<!-- <form action="" id='otpForm'>
						<input type="text" id="otp-input" name="otp" placeholder="Enter Your OTP" class="form-controll"/>
						<br>
						<button class="mt-2" id="otpButton">Submit</button>
					</form> -->
					 <div class="d-flex justify-content-center">
						<form action="" id='otpForm' class="text-center">
							<input type="text" id="otp-input" name="otp" placeholder="Enter Your OTP" class="form-controll f_15 pl-2"/>
							<br>
							<button class="mt-1 text-center mt-2 bg_2 text-white px-2 py-1 rounded border-0 f_14" id="otpButton">Submit</button>
						</form>
                      </div>
					<form id="signUpFormPageId">
					  <div class="form-row">
					    <div class="form-group field input-field col-md-12 col-sm-12 col-12 pb-4">
					      <!-- <input type="text" class="col-12 p-0 f_14 pb-2" id="" placeholder="First Name">
					      <label>Last Name</label> -->
					       <input type="text" name="" required id="firstNameForSignUpPage">
					       <label class="f_14 tc_1 fw_300">Full Name</label>
					       <div class="form_tooltip f_11 p-1 pl-2 rounded firstNameForSignUpPageTip">
					        <i class="fas fa-caret-up"></i>
					        Please enter Full name
					       </div>
					      <!-- <input type="text" id="name" required class="col-12" />
                          <label for="name">Your name:</label> -->
					    </div>
					    <!-- <div class="form-group col-md-6 pb-4">
					      <input type="text" class="col-12 p-0 f_14 pb-2" id="" placeholder="Last Name">
					    </div> -->
					    
					  </div>

					  <div class="form-row">
					    <div class="form-group field col-md-12 pb-4">
					      <input type="email" name=""  required id="emailForSignUpPage" />
                          <label class="f_14 tc_1 fw_300">Email</label>
                          <div class="form_tooltip f_11 p-1 pl-2 rounded emailForSignUpPageTip">
					        <i class="fas fa-caret-up"></i>
					        Please enter Email
					       </div>
					    </div>
					    <div class="form-group field col-md-12 pb-4">
					      <img id="showp" src="<?=base_url('assets/')?>home_e/images/showp.png" width="19px" style="position: absolute;right:15px;bottom:30px" class="cp" >
					      <img id="hidep" src="<?=base_url('assets/')?>home_e/images/hidep.png" width="19px" style="position: absolute;right:15px;bottom:30px" class="cp">
					      <input type="password" name=""  required  id="passwordForSignUpPage" />
                          <label class="f_14 tc_1 fw_300">Password</label>
                          <div class="form_tooltip f_11 p-1 pl-2 rounded passwordForSignUpPageTip">
					        <i class="fas fa-caret-up"></i>
					        Please enter Password
					       </div>
					    </div>
					    
					    <div class="form-group field  col-md-12 col-sm-12 col-12 pb-4">
					      <!-- <input type="text" name=""  required id="lastNameForSignUpPage" /> -->
                          <!-- <label class="f_14 tc_1 fw_300">Country</label> -->
                          <!-- <div class="form_tooltip f_11 p-1 pl-2 rounded lastNameForSignUpPageTip">
					        <i class="fas fa-caret-up"></i>
					        Please enter Last name
					       </div> -->
					       <select class="form-control" id="countryForSignUp">
					       	<option value="">Select Your Country</option>
					       	<?php foreach($getAllCountry as $key ){ ?>
					       			<option value="<?= $key['name'] ?>"><?= $key['name'] ?></option>
					       	 <?php } ?>
					       </select>
					    </div>

					  </div>

					  <div class="form_validation_circle d-flex justify-content-between pb-3 flex-wrap">
					  	<div>
						  	<div class="d-flex justify-content-start align-items-center py-1">
							  	<div id="lengthErr"></div>
							  	<div class="f_11 tc_1 fw_500 ml-2">8 characters minimum</div>
						  	</div>
						  	<div class="d-flex justify-content-start align-items-center">
							  	<div id="upperCaseErr"></div>
							  	<div class="f_11 tc_1 fw_500 ml-2">One uppercase character</div>
						  	</div>
					    </div>
					  	<div>
						  	<div class="d-flex justify-content-start align-items-center py-1">
							  	<div id="lowerCaseErr"></div>
							  	<div class="f_11 tc_1 fw_500 ml-2">One lowercase character</div>
						  	</div>
						  	<div class="d-flex justify-content-start align-items-center">
							  	<div id="numberOrSymbolErr"></div>
							  	<div class="f_11 tc_1 fw_500 ml-2">One number or symbol</div>
						  	</div>
					    </div>
					  </div>
					
					  
					  <button type="submit" class="bg_2 p-2 rounded text-white border-0 w-100 submitSignUpPage">Sign Up</button>
					</form>

					<div class="terms_condition py-3">
						<span class="f_13 tc_1 rt_12">By clicking "Sign Up" you confirm that you accept the <a href="" class="tc_2">Terms and Conditions</a> and <a href="<?= $siteUrl ?>Privacy" class="tc_2"> Privacy Policy </a></span>
					</div>
                    
                    <!-- <div class="social_media_login text-center py-2">
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

                <div class="login_right loginFormPage shadow px-xl-5 px-lg-5 px-md-3 py-5 px-3" >
					<div class="logo text-center">
						<img src="<?=base_url('assets/')?>home_e/images/logo.png" width="100px">
					</div>
					<div class="form_content_heading py-2 text-center">
						<h4 class="f_14 fw_300 ">Sign in to your account</h4>
					</div>
					<div id="loginValidatorPage"></div>
					<div class="form_content pt-3">
						<form id="signInFormPageId">
					  

					  <div class="form-row">
					    <div class="form-group field col-md-12 pb-4">
					      <input type="email" name="email"  required  id='emailForSignInPage' />
                          <label class="f_14 tc_1 fw_300">Email</label>
                          <div class="form_tooltip f_11 p-1 pl-2 rounded emailForSignInPageTip">
					        <i class="fas fa-caret-up"></i>
					        Please enter Email
					       </div>
					    </div>
					    <div class="form-group field col-md-12 pb-4">
					      <input type="password" name="password"  required  id='passwordForSignInPage'/>
                          <label class="f_14 tc_1 fw_300">Password</label>
                          <div class="form_tooltip f_11 p-1 pl-2 rounded passwordForSignInPageTip">
					        <i class="fas fa-caret-up"></i>
					        Please enter Password
					       </div>
					    </div>
					  </div>

					<!--   <div class="form_validation_circle d-flex justify-content-between pb-3 flex-wrap">
					  	<span class="f_13 tc_2">Forgot Password ?</span>
					  </div>
					 -->
					  
					  <button type="submit" class="bg_2 p-2 rounded text-white border-0 w-100 submitSignInPage">Sign In</button>
					</form>

					
                    <!-- <div class="social_media_login text-center py-2">
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
                    	<h5 class="f_13 fw_300">Don't have an account?<span class="tc_2 cp" id="CreateAccountPage"> Create Account</span> </h5>
                    </div>

				</div>

			</div>
		</div>
	</div>
</section>


<!-- =====================end===================== -->

<!-- -----------link-2 js---------- -->
<?php include 'link-2_b.php'; ?>

<script type="text/javascript">
	// login from

  $(document).ready(function() {

  	$(".signUpForm").hide();
     $(".loginForm").show();


    $("#LoginHere").click(function(){
     $(".signUpForm").hide();
     $(".loginForm").show();
    });

    $("#CreateAccount").click(function(){
     $(".signUpForm").show();
     $(".loginForm").hide();
    });

});
</script>
<script src="<?=base_url()?>assets/home_e/js/registerAndLogin.js"></script>