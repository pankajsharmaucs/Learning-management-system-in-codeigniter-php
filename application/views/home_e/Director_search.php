
<?php

echo $keyword;

die();
// get_all_company_data($cin);

?>



<!DOCTYPE html>
<html>
<head>
	<title>Company Info</title>
	 <meta charset="UTF-8">
	 <meta name="description" content="">
	 <meta name="keywords" content="">
	 <meta name="author" content="">
	 <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <style type="text/css">
     	html{
     		scroll-behavior: smooth;
     	}
     	
     </style>
 <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css" />


     <meta name="google-signin-client_id" content="402207381935-clf34srklmigap89520e2r1efler61bk.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
     <!-- ---link----- -->
	 <?php include 'link_b.php'; ?>
	 <!-- ----end------ -->

</head>
<body>

	

<!-- ===========================company info============================= -->

<section class="com_info">
	<div class="container-fluid">
		<div class="row ">
			<div class=" text-right company_info_mobile_sub_menu p-3">
				<i class="fas fa-chevron-down"></i>
                 					
				</div>
			<div class="col-xl-3 col-lg-4 col-md-4 col-sm-12 col-12 bg_5 d-xl-flex d-lg-flex d-md-flex justify-content-xl-center justify-content-lg-center justify-content-md-center pt-xl-5 pt-lg-5 pt-md-5 com_info_toggle_content" style="display: none;">
				
				<div class="com_info_left f_15 py-3 ">
					<div><span><a class=" basic_info active rt_12"  href="#CompanyInformation">Basic Information</a></span></div>
					<div><span><a class="basic_info rt_12" href="#DirectorDetail">Directors</a></span></div>
					<div><span><a class=" rt_12" href="#ChargeDetails">Charges Details</a></span></div>
					<div><span><a class="basic_info rt_12" href="#FinancialReport">Financial Report</a></span></div>
					<div><span><a class=" rt_12" href="#ContactDetails">Contact Details</a></span></div>
					<div class="mt-1 add_report_to_cartbtn " data-toggle="modal" data-target="#addReportToCart"><span class="bg_2 p-2 rounded text-white f_14 rt_12 ">Add Report to Cart</span></div>
					<div class="mt-1 track_this_companybtn" data-toggle="modal" data-target="#addReportToCart"><span class="bg_4 p-2 rounded text-white f_14 rt_12 ">Track this company</span></div>
				</div>

                  <!-- Modal -->
							<div class="modal  fade" id="addReportToCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
								<!-- <button type="button" class="close text-white p-4" style="position: absolute; right: 5px;" data-dismiss="modal" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							    </button> -->
							  <div class="modal-dialog modal-dialog-centered d-flex justify-content-center align-items-center" role="document">
							    <div class="modal-content bg-transparent border-0 ">
							      
							      <div class="modal-body bg-white pb-3 rounded">
							      	<div class="container-fluid" >



									<div class="row">
										<div class="col-md-12 leftDiv" style="">

										</div>
										<div class="col-md-12 right-form-div leftDiv">
											<button type="button" class="close" style="position: absolute; right: 8px;top:5px;" data-dismiss="modal" aria-label="Close">
									    <span aria-hidden="true">&times;</span>
									    </button>
											<form action="" method="post" id="registration-form" class="bg-white mt-3 p-3 mb-3">
												<div class="text-center ">
													<img src="formWithValidation/image/favicon.png" alt="log-image">
													<!-- <h4 class="text-info trial-info" style="">Get started with a free 30-days trial account</h4>	 -->
													<p class="text-secondary">
														Already have Apptivo account? <a href="#" class="login-link" style="">Login here</a>
													</p>
												</div>
												<div class="form-row frm-row"  style="">
													<div class="form-group col-md-6">
														<label for="name" class="text-secondary validationLabel" id='FNameLabel'>First Name</label>
														<input type="text" name="" id="FNameInput" class="form-control input">
														<div style="" class="tooltip1" id="FNameTip">
								  							<i class="fa fa-caret-up ml-3 tip-arrow" style=""></i>
								  							<div class="tooltip-inner1" style=""><p class="text-center tip-text" style="">Please Enter Fast Name</p></div>	
														</div>
													</div>
													<div class="form-group col-md-6">
														<label for="name" class="text-secondary validationLabel" id="LNameLabel">Last Name</label>
														<input type="text" name="" id="LNameInput" class="form-control input" style="">
														<div  class="tooltip1" id="LNameTip" style="">
															<i class="fa fa-caret-up ml-3 tip-arrow" style=""></i>
								  							<div class="tooltip-inner1" style=""><p class="text-center tip-text" style="">Please Enter Last Name</p></div>	
														</div>
													</div>
													<div class="form-group col-md-12">
														<label for="name" class="text-secondary  validationLabel" id="EmailLabel">Email</label>
														<input type="email" name="" class="form-control input" id="EmailInput" style="">
														<div  class="tooltip1 email" style="" id="EmailTip">
															<i class="fa fa-caret-up ml-3 tip-arrow" style="color:#dd3333"></i>
								  							<div class="tooltip-inner1" style=""><p class="text-center tip-text" style="">Please Enter Your Email</p></div>	
														</div>
													</div>
													<div class="form-group col-md-12" style="">
														<label for="name" class="text-secondary  validationLabel" id="PasswordLabel">Password</label>
														<input type="password" name="" class="form-control input" id="PasswordInput" style="">
														<div  class="tooltip1 password" style="" id="PasswordTip">
															<i class="fa fa-caret-up ml-3 tip-arrow" style="color:#dd3333;"></i>
								  							<div class="tooltip-inner1" style=""><p class="text-center tip-text" style="">Please Enter Password</p></div>	
														</div>		
													</div>
													<!-- <div class="row"> -->
                                                 
                                                  

													<div class="col-xl-6 col-lg-6 col-md-12 col-12 mt-3">
														<div class="form_bul d-flex justify-content-start align-items-center">
															<div id="lengthErr">
																
															</div>
															<div class="ml-2 f_13">
																8 characters minimum
															</div>
														</div>
													</div>
													<div class="col-xl-6 col-lg-6 col-md-12 col-12 mt-3">
														<div class="form_bul d-flex justify-content-start align-items-center">
															<div id="lowerCaseErr">
																
															</div>
															<div class="ml-2 f_13">
																One lowercase character
															</div>
														</div>
													</div>

													<div class="col-xl-6 col-lg-6 col-md-12 col-12 mt-3">
														<div class="form_bul d-flex justify-content-start align-items-center">
															<div id="upperCaseErr">
																
															</div>
															<div class="ml-2 f_13">
																One uppercase character
															</div>
														</div>
													</div>
													<div class="col-xl-6 col-lg-6 col-md-12 col-12 mt-3">
														<div class="form_bul d-flex justify-content-start align-items-center">
															<div id="numberOrSymbolErr">
																
															</div>
															<div class="ml-2 f_13">
																One number or symbol
															</div>
														</div>
													</div>


													
													<div class="col-md-12 p-1 mt-3 text-center">
														<input type="submit" value="Sign Up" style="width:50%" class="btn btn-info">
													</div>
													<div class="col-md-12 p-1 text-secondary text-center terms-condition-text" style="">
														By clicking "Sign Up" you confirm that you accept the 
														<a tabindex="7" href="#" target="_blank">Terms and Conditions</a> and 
														<a tabindex="8" href="#" target="_blank">Privacy Policy </a>
													</div>
													<div class="col-md-12">
														<div class="text-center">
															<h6 class="">or</h6>
															<p class="text-muted">Sign Up with</p>
														</div>								
													</div>
													<div class="col-md-12 pb-lg-4 p-2">
														<div class="row">
															<div class="col-md-4 col-sm-12 mt-1" style="">
																<div class="text-center g-signin2" data-onsuccess="onSignIn" style="">
																	<img src="https://cdns.apptivo.com/res/cdn/app/login_signup/gicon.png" width="16" class="mr-2">Google
																</div>
															</div>
															<div class="col-md-4 col-sm-6 mt-1" style="">
																<div class="fb-login-button"  data-width="200" data-size="small"  data-button-type="login_with"  onlogin="checkLoginState();" data-layout="default" data-auto-logout-link="true" data-use-continue-as="true"></div>
																<!-- <div class="fb-login-button" data-width="70" data-size="small" data-button-type="login_with" data-layout="default" data-auto-logout-link="true" data-use-continue-as="false"></div> -->
																<!-- <div class="text-center social-media-links" style="">
																	<img src="https://cdns.apptivo.com/res/cdn/app/login_signup/gicon.png" width="16" class="mr-2">Google<div id="fb-root"></div>
																</div> -->
															</div>
															<!-- <div class="col-md-4 col-sm-6 mt-1" style="">
																<div class="text-center social-media-links" style="">
																	<img src="https://cdns.apptivo.com/res/cdn/app/login_signup/paypal.png" width="16" class="mr-2">Google
																</div>
															</div> -->
														</div>
													</div>
												</div>
											</form>
											<!-- =========================login form start================================= -->
											<form action="" method="post" id="login-form" class="bg-white mt-3 p-3 mb-3">
												<div class="text-center ">
													<img src="formWithValidation/image/favicon.png" alt="log-image">
													<!-- <h4 class="text-info trial-info" style="">Get started with a free 30-days trial account</h4>	 -->
													<p class="text-secondary">
														Login To Your Account
													</p>
												</div>
												<div class="form-row frm-row"  style="">
													<div class="form-group col-md-12">
														<label for="name" class="text-secondary validationLabel" id="loginEmailLabel">Email</label>
														<input type="email" name="" class="form-control input" id="loginEmailInput" style="">
														<div  class="tooltip1 email" style="" id="loginEmailTip">
															<i class="fa fa-caret-up ml-3 tip-arrow" style="color:#dd3333"></i>
								  							<div class="tooltip-inner1" style=""><p class="text-center tip-text" style="">Please Enter Your Email</p></div>	
														</div>
													</div>
													<div class="form-group col-md-12" style="">
														<label for="name" class="text-secondary  validationLabel" id="loginPasswordLabel">Password</label>
														<input type="password" name="" class="form-control input" id="loginPasswordInput" style="">
														<div  class="tooltip1 password" style="" id="loginPasswordTip">
															<i class="fa fa-caret-up ml-3 tip-arrow" style="color:#dd3333;"></i>
								  							<div class="tooltip-inner1" style=""><p class="text-center tip-text" style="">Please Enter Password</p></div>	
														</div>		
													</div>
													
													<div class="col-md-12 p-1 text-center">
														<input type="submit" value="Sign In" style="width:50%" class="btn btn-info">
													</div>
													<div class="col-md-12">
														<div class="text-center">
															<h6 class="">or</h6>
															<p class="text-muted">Sign Up with</p>
														</div>								
													</div>
													<div class="col-md-12 pb-lg-4 p-2">
														<div class="row">
															<div class="col-md-4 col-sm-12 mt-1" style="">
																<div class="text-center g-signin2" data-onsuccess="onSignIn" style="">
																	<img src="https://cdns.apptivo.com/res/cdn/app/login_signup/gicon.png" width="16" class="mr-2">Google
																</div>
															</div>
															<div class="col-md-4 col-sm-6 mt-1" style="">
																<div class="fb-login-button"  data-width="200" data-size="small"  data-button-type="login_with"  onlogin="checkLoginState();" data-layout="default" data-auto-logout-link="true" data-use-continue-as="true"></div>
																<!-- <div class="fb-login-button" data-width="70" data-size="small" data-button-type="login_with" data-layout="default" data-auto-logout-link="true" data-use-continue-as="false"></div> -->
																<!-- <div class="text-center social-media-links" style="">
																	<img src="https://cdns.apptivo.com/res/cdn/app/login_signup/gicon.png" width="16" class="mr-2">Google<div id="fb-root"></div>
																</div> -->
															</div>
															<!-- <div class="col-md-4 col-sm-6 mt-1" style="">
																<div class="text-center social-media-links" style="">
																	<img src="https://cdns.apptivo.com/res/cdn/app/login_signup/paypal.png" width="16" class="mr-2">Google
																</div>
															</div> -->
														</div>
														<hr>
														<p class="text-center text-secondary rgtd">Don't have an account? <a href="#" id="rgtd">Create Account</a></p>
													</div>
												</div>
											</form>
										</div>
										</div>
										<div class="col-md-4 leftDiv" style="">
											<!-- <div class="left-inner-div-image">
												<img class="" src="./image/apptivoleaf.svg" alt="image" style="">
											</div>
											<div class="">
											  <h1 class="text-light text-center left-h1">SOFTWARE THAT GROWS WITH YOUR BUSINESS</h1>
											</div> -->
										</div>
										<div class="col-md-4 leftDiv" style="">
											<!-- <div class="left-inner-div-image">
												<img class="" src="./image/apptivoleaf.svg" alt="image" style="">
											</div>
											<div class="">
											  <h1 class="text-light text-center left-h1">SOFTWARE THAT GROWS WITH YOUR BUSINESS</h1>
											</div> -->
										</div>
										<!-- ==========================login form end=================================== -->
									</div>
							

							      
							    </div>
							  </div>
							</div>
						</div>

						


			</div>




			<div class="col-xl-8 col-lg-8 col-md-7 col-sm-12 col-12 ">
				<div class="com_info_right f_15 py-3" id="CompanyInformation">
					<h2 class="f_25 rt_20 text-center text-xl-left text-lg-left text-md-center pb-2">Overview</h2>
					<p class="fw_300 f_15 rt_12"> DUM DUM DUM WEDDING PLANNERS PRIVATE LIMITED is a Private incorporated on . It is classified as Company limited by Shares and is registered at Registrar of Companies, Chennai. Its authorized share capital is Rs. 100000 and its paid up capital is Rs. 100000. It is involved in Business Services.

					DUM DUM DUM WEDDING PLANNERS PRIVATE LIMITED's Annual General Meeting (AGM) was last held on and as per records from Ministry of Corporate Affairs (MCA)

					Directors of DUM DUM DUM WEDDING PLANNERS PRIVATE LIMITED are .

					DUM DUM DUM WEDDING PLANNERS PRIVATE LIMITED's Corporate Identification Number is (CIN) U74900TN2011PTC082046.Its Email address is melb0205@gmail.com and its registered address is Old No. 29, New No. 12, Iyyah Pillai Street, Triplicane Chennai Chennai TN 600005 IN </p>
				</div>
				<div class="com_detail shadow-sm col-lg-10 col-lg-10 col-md-12 col-12">
					
				<table class="w-100 mt-2">
					<tr class="table_heading">
						<th class="rt_15">Company Information</th>
					</tr>
						
					    <tr>
							<td class="fw_900 font-weight-bold rt_11">CIN</td>
							<td class=" cin_number rt_11">U74140MH2000PLC990747</td>
							
							
						</tr>

						<tr class="">
				      <td class="rt_11">Company Name</td>
				      <td class="rt_11">DFM FOODS LIMITED</td>
				      
				    </tr>
				    <tr>
				      <td class="rt_11">Company Sub Category</td>
				      <td class="rt_11">Non-govt company</td>
				     
				    </tr>
				    <tr>
				      <td class="rt_11">Class of Company</td>
				      <td class="rt_11">Public</td>
				     
				    </tr>
				    <tr>
				      <td class="rt_11">Company Status</td>
				      <td class="status">Active</td>
				     
				    </tr>
				    <tr>
				      <td class="rt_11">Date of Incorporation</td>
				      <td class="rt_11">17 March 1993</td>
				     
				    </tr>
				    <tr>
				      <td class="rt_11">Registrar of Companies</td>
				      <td class="rt_11">Delhi</td>
				     
				    </tr>

				    <tr>
				      <td class="rt_11">Age of Company </td>
				      <td class="rt_11">28 years, 0 montds, 5 days</td>
				     
				    </tr>

				    <tr>
				      <td class="rt_11">Company Category</td>
				      <td class="rt_11">Company limited by Shares</td>
				     
				    </tr>
				    <tr>
				      <td class="rt_11">Activity</td>
				      <td class="rt_11">Manufacturing (Food stuffs)</td>
				     
				    </tr>
					
				</table>
				</div>






				<div class="free_update bgg_1 my-2 col-lg-10 col-lg-10 col-md-12 col-12  p-3">
					<div class="free_update_content">
						<span class="f_13 text-white rt_11">Follow and GET UPDATES for</span>
						<h4 class="f_18 text-white rt_15">Tata Dilworth</h4>
						<button class="bg-white border-0 px-3 py-1 rounded rt_15">Get Free Update</button>
					</div>
					<div class=" mt-3 d-flex flex-wrap">
						<div class="" style="width: 150px;"><i class="fas fa-check-circle text-white"></i> <a href="" class="tc_0 mr-3 text-white f_15 rt_12">Name of Change</a></div>
						<div style="width: 150px;"><i class="fas fa-check-circle text-white"></i> <a href="" class="tc_0 mr-3 text-white f_15 rt_12">Address Change</a></div>
						<div style="width: 150px;"><i class="fas fa-check-circle text-white"></i> <a href="" class="tc_0 mr-3 text-white f_15 rt_12">Director Change</a></div>
						<div style="width: 150px;"><i class="fas fa-check-circle text-white"></i> <a href="" class="tc_0 mr-3 text-white f_15 rt_12">Board Meetings</a></div>
					</div>
				</div>


              
                <div class="dir_report com_detail shadow-sm col-lg-10 col-lg-10 col-md-12 col-12" id="DirectorDetail">
					
				<table class="w-100 mt-2 mb-2">
					<tr class="table_heading">
						<th class="rt_15">Director Details</th>
					</tr>
						
					    <tr>
							<td class="fw_900 font-weight-bold rt_11">DIN</td>
							<td class="fw_900 font-weight-bold rt_11">Director Name</td>
							<td class="fw_900 font-weight-bold rt_11">Designation</td>
							<td class="fw_900 font-weight-bold rt_11">Date of Appointment</td>
							
						</tr>

					<tr class="">
				      <td><a href="" class="rt_11 tc_2">00027995</a></td>
				      <td><a href="" class="rt_11 tc_2">PRADEEP DINODIA</a></td>
				      <td class="rt_11">Directors</td>
				      <td class="rt_11">8 Mar, 1994</td>
				      
				    </tr>
				    <tr class="">
				      <td><a href="" class="rt_11 tc_2">00027995</a></td>
				      <td><a href="" class="rt_11 tc_2">PRADEEP DINODIA</a></td>
				      <td class="rt_11">Directors</td>
				      <td class="rt_11">8 Mar, 1994</td>
				      
				    </tr>
				    <tr class="">
				      <td><a href="" class="rt_11 tc_2">00027995</a></td>
				      <td><a href="" class="rt_11 tc_2">PRADEEP DINODIA</a></td>
				      <td class="rt_11">Directors</td>
				      <td class="rt_11">8 Mar, 1994</td>
				      
				    </tr>
				    <tr class="">
				      <td><a href="" class="rt_11 tc_2">00027995</a></td>
				      <td><a href="" class="rt_11 tc_2">PRADEEP DINODIA</a></td>
				      <td class="rt_11">Directors</td>
				      <td class="rt_11">8 Mar, 1994</td>
				      
				    </tr>
				    <tr class="">
				      <td><a href="" class="rt_11 tc_2">00027995</a></td>
				      <td><a href="" class="rt_11 tc_2">PRADEEP DINODIA</a></td>
				      <td class="rt_11">Directors</td>
				      <td class="rt_11">8 Mar, 1994</td>
				      
				    </tr>
				    <tr class="">
				      <td><a href="" class="rt_11 tc_2">00027995</a></td>
				      <td><a href="" class="rt_11 tc_2">PRADEEP DINODIA</a></td>
				      <td class="rt_11">Directors</td>
				      <td class="rt_11">8 Mar, 1994</td>
				      
				    </tr>
					
				</table>
				</div>


				<div class="dir_report com_detail shadow-sm col-lg-10 col-lg-10 col-md-12 col-12 mt-2" id="ChargeDetails">
					
				<table class="w-100 mt-2">
					<tr class="table_heading text-nowrap">
						<th class="rt_15">Charge Details</th>
					</tr>
						
					    <tr>
							<td class="fw_900 font-weight-bold rt_11">Charge Id</td>
							<td class="fw_900 font-weight-bold rt_11">Creation Date</td>
							<td class="fw_900 font-weight-bold rt_11">Modification Date</td>
							<td class="fw_900 font-weight-bold rt_11">Closure Date</td>
							<td class="fw_900 font-weight-bold rt_11">Assets Under Charge</td>
							<td class="fw_900 font-weight-bold rt_11">Amount</td>
							<td class="fw_900 font-weight-bold rt_11">Charge Holder</td>
							
						</tr>
                        <tr>
                        	<td>No Data Found</td>
                        </tr>
						
					
				</table>
				</div>




				<div class="fin_report com_detail shadow-sm col-lg-10 col-lg-10 col-md-12 col-12 mt-2 d-flex" id="FinancialReport">
					<table class="w-100 mt-2">
					<tr class="table_heading">
						<th class="rt_15">Financial Report</th>
						<!-- <th><a href="" class="text-white f_16 "><button class="px-3 bg_2 border-0 text-white"><i class="fas fa-shopping-cart"></i> Purchase</a></th> --->
					</tr>
						
					    <!-- <tr>
							<td class="fw_900 font-weight-bold">Email</td>
							<td class="fw_900 font-weight-bold">Address</td>
							
							
						</tr> -->

						<tr class="" >
				      <td class="rt_11">Paid-up Capital</td>
				      <td class=""><a href=""><img src="<?=base_url('assets/')?>home_e/images/svg/down-arrow.svg" alt="" height="18px" width="18px"></a> </td>
				       <td class="text-nowrap rt_11">Paid-up Capital</td>
				      <td class=""><a href=""><img src="<?=base_url('assets/')?>home_e/images/svg/down-arrow.svg" alt="" height="18px" width="18px"></a> </td>
				     
				      
				    </tr>
				    <tr class="">
				      <td class="rt_11">Paid-up Capital</td>
				      <td class=""><a href=""><img src="<?=base_url('assets/')?>home_e/images/svg/down-arrow.svg" alt="" height="18px" width="18px"></a> </td>
				       <td class="rt_11">Paid-up Capital</td>
				      <td class=""><a href=""><img src="<?=base_url('assets/')?>home_e/images/svg/down-arrow.svg" alt="" height="18px" width="18px"></a> </td>
				     
				      
				    </tr>
				   <tr class="">
				      <td class="rt_11">Paid-up Capital</td>
				      <td class=""><a href=""><img src="<?=base_url('assets/')?>home_e/images/svg/down-arrow.svg" alt="" height="18px" width="18px"></a> </td>
				       <td class="rt_11">Paid-up Capital</td>
				      <td class=""><a href=""><img src="<?=base_url('assets/')?>home_e/images/svg/down-arrow.svg" alt="" height="18px" width="18px"></a> </td>
				     
				      
				    </tr>
				    <tr class="">
				      <td class="rt_11">Paid-up Capital</td>
				      <td class=""><a href=""><img src="<?=base_url('assets/')?>home_e/images/svg/down-arrow.svg" alt="" height="18px" width="18px"></a> </td>
				       <td class="rt_11">Paid-up Capital</td>
				      <td class=""><a href=""><img src="<?=base_url('assets/')?>home_e/images/svg/down-arrow.svg" alt="" height="18px" width="18px"></a> </td>
				     
				      
				    </tr>
				    <tr class="">
				      <td class="rt_11">Paid-up Capital</td>
				      <td class=""><a href=""><img src="<?=base_url('assets/')?>home_e/images/svg/down-arrow.svg" alt="" height="18px" width="18px"></a> </td>
				       <td  class="rt_11">Paid-up Capital</td>
				      <td class=""><a href=""><img src="<?=base_url('assets/')?>home_e/images/svg/down-arrow.svg" alt="" height="18px" width="18px"></a> </td>
				     
				      
				    </tr>
				    <tr class="">
				      <td class="rt_11">Paid-up Capital</td>
				      <td class=""><a href=""><img src="<?=base_url('assets/')?>home_e/images/svg/down-arrow.svg" alt="" height="18px" width="18px"></a> </td>
				       <td class="rt_11">Paid-up Capital</td>
				      <td class=""><a href=""><img src="<?=base_url('assets/')?>home_e/images/svg/down-arrow.svg" alt="" height="18px" width="18px"></a> </td>
				     
				      
				    </tr>
				    <tr class="">
				      <td class="rt_11">Paid-up Capital</td>
				      <td class=""><a href=""><img src="<?=base_url('assets/')?>home_e/images/svg/down-arrow.svg" alt="" height="18px" width="18px"></a> </td>
				       <td class="rt_11">Paid-up Capital</td>
				      <td class=""><a href=""><img src="<?=base_url('assets/')?>home_e/images/svg/down-arrow.svg" alt="" height="18px" width="18px"></a> </td>
				     
				      
				    </tr>
				    <tr class="">
				      <td class="rt_11">Paid-up Capital</td>
				      <td class=""><a href=""><img src="<?=base_url('assets/')?>home_e/images/svg/down-arrow.svg" alt="" height="18px" width="18px"></a> </td>
				       <td class="rt_11">Paid-up Capital</td>
				      <td class=""><a href=""><img src="<?=base_url('assets/')?>home_e/images/svg/down-arrow.svg" alt="" height="18px" width="18px"></a> </td>
				     
				      
				    </tr>

				    <tr class="bg-white">
				    	<td class="">
				    		<button class="btn btn-primary rt_13 purchasebtn1"><img src="<?=base_url('assets/')?>home_e/images/svg/shopping-cart.svg" class="text-white f" alt="" height="18px" width="18px">&nbsp; Purchase</button>
				    	</td>
				    	<td class="">
				    		<!-- <button class="btn btn-primary">Purchase</button> -->
				    	</td>
				    	<td class="">
				    		<!-- <button class="btn btn-primary">Purchase</button> -->
				    	</td>
				    	<div class="">
				    	<!-- <td class="">
				    		<button class="btn btn-primary rt_13"><img src="<?=base_url('assets/')?>home_e/images/svg/shopping-cart.svg" class="text-white f" alt="" height="18px" width="18px">&nbsp; Purchase</button>
				    	</td> -->
				    	
				    </div>
				    </tr>

					<tr >
					    <td colspan="4"  >
				    		<button class="bt_1 rt_13 purchasebtn2" style="position: relative;left: 80px;"><img src="<?=base_url('assets/')?>home_e/images/svg/shopping-cart.svg" class="text-white f" alt="" height="18px" width="18px">&nbsp; Purchase</button>
				    	</td>
					</tr>

				   
				</table>
				
				</div>

                


				<div class="con_detail com_detail shadow-sm col-lg-10 col-lg-10 col-md-12 col-12 mt-2" id="ContactDetails">
					<!-- <div class="mt-2">dsfasf</div> -->
					
                  
                  <div class="row">
                  	<div class="col-xl-6 col-lg-6 col-md-12 col-12">
					<table class="w-100 mt-2">
					<tr class="table_heading">
						<th class="rt_15 text-nowrap">Contact  Details</th>
					</tr>
						
					    <tr>
							<td class="fw_900 font-weight-bold bg-white rt_11">Email</td>
							<td class="fw_900 font-weight-bold bg-white rt_11">Address</td>
							
							
						</tr>

						<tr class="">
				      <td class="rt_11">dfm@dfmgroup.in</td>
				      <td class="rt_11">8377, ROSHANARA ROAD DELHI DL 110007 IN </td>
				     
				      
				    </tr>
				    <!-- <div>dsfaf</div> -->
				   
				   
				</table>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-12 col-12 pt-xl-5 pt-lg-5  pt-2">
				
                    <iframe src="https://maps.google.it/maps?q=POLLIBETTA,KODAGU KARNATAKA KARNATAKA KA 571215 IN&output=embed" class="border-0 w-100"></iframe>
               
				</div>



				



				<!-- <div class="faq  col-lg-10 col-lg-10 col-md-12 col-12 mt-2" id="Faq">
					<div class="faq_content py-3">
						<div>
							<h2 class="f_20 p-2 table_heading">FAQ</h2>
							<div class="ml-2 py-2">
								<h3 class="f_17 fw_400 rt_15">What is the incorporation date of the Tata dilworth?</h3>
								<h4 class="f_15 fw_300 rt_14">Incorporation date of the company is 01 January 2000  </h4>
							</div>
							<div class="ml-2 py-2">
								<h3 class="f_17 fw_400 rt_15">What is the incorporation date of the Tata dilworth?</h3>
								<h4 class="f_15 fw_300 rt_14">Incorporation date of the company is 01 January 2000  </h4>
							</div>
							<div class="ml-2 py-2">
								<h3 class="f_17 fw_400 rt_15">What is the incorporation date of the Tata dilworth?</h3>
								<h4 class="f_15 fw_300 rt_14">Incorporation date of the company is 01 January 2000  </h4>
							</div>
							<div class="ml-2 py-2">
								<h3 class="f_17 fw_400 rt_15">What is the incorporation date of the Tata dilworth?</h3>
								<h4 class="f_15 fw_300 rt_14">Incorporation date of the company is 01 January 2000  </h4>
							</div>
						</div>
					</div>
				</div> -->






			</div>

		</div>
   

      <div class="con_detail com_detail shadow-sm col-lg-10 col-lg-10 col-md-12 col-12 mt-2">
        
         <!-- <div class="pl-3 pt-3 table_heading f_20 rt_15 fw_500">
         	<div class="swiper-container">
		    <div class="swiper-wrapper">
		      <div class="swiper-slide">Slide 1</div>
		      <div class="swiper-slide">Slide 2</div>
		      <div class="swiper-slide">Slide 3</div>
		      <div class="swiper-slide">Slide 4</div>
		      <div class="swiper-slide">Slide 5</div>
		      <div class="swiper-slide">Slide 6</div>
		      <div class="swiper-slide">Slide 7</div>
		      <div class="swiper-slide">Slide 8</div>
		      <div class="swiper-slide">Slide 9</div>
		      <div class="swiper-slide">Slide 10</div>
		    </div>
		    
		    <div class="swiper-pagination"></div>
		  </div>
         </div> -->
          <div class="swiper-container">
		    <div class="swiper-wrapper">
		      <div class="swiper-slide">Slide 1</div>
		      <div class="swiper-slide">Slide 2</div>
		      <div class="swiper-slide">Slide 3</div>
		      <div class="swiper-slide">Slide 4</div>
		      <div class="swiper-slide">Slide 5</div>
		      <div class="swiper-slide">Slide 6</div>
		      <div class="swiper-slide">Slide 7</div>
		      <div class="swiper-slide">Slide 8</div>
		      <div class="swiper-slide">Slide 9</div>
		      <div class="swiper-slide">Slide 10</div>
		    </div>
		    <!-- Add Pagination -->
		    <div class="swiper-pagination"></div>
		  </div>
        
      </div>
      <!-- Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
      quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
      consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
      cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
      proident, sunt in culpa qui officia deserunt mollit anim id est laborum. -->
  


	</div>
</section>

<!-- Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
 -->



<!-- =======================end================== -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<script>
    var swiper = new Swiper('.swiper-container', {
      slidesPerView: 1,
      spaceBetween: 10,
      // init: false,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      breakpoints: {
        640: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        768: {
          slidesPerView: 4,
          spaceBetween: 40,
        },
        1024: {
          slidesPerView: 5,
          spaceBetween: 50,
        },
      }
    });
  </script>
  
<!-- -----------link-2 js---------- -->
<?php include 'link-2_b.php'; ?>





<!-- akib js popup -->

 <!-- ====================================gmail login/logout start============================================== -->
 <!--login code start -->
 <script>
    function onSignIn(googleUser) 
    {
        var profile = googleUser.getBasicProfile();
        userName = profile.getName();
        userImageUrl = profile.getImageUrl();
        userEmail = profile.getEmail();
        userIdByG = profile.getId();
        // console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
        // console.log('Name: ' + profile.getName());
        // console.log('Image URL: ' + profile.getImageUrl());
        // console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
        console.log('name:'+userName+', '+' userEmail:'+userEmail+' userId,'+userIdByG+' ,userImageLink:'+userImageUrl);
        if(userName && userEmail && userIdByG)
        {
            $.ajax(
            {
                type:'post',
                url:'loginByGmailAccount/afterLogin.php',
                data:{name:userName,userImage:userImageUrl,email:userEmail,userId:userIdByG},
                beforeSend:function()
                {

                },
                success:function(res)
                {
                    console.log(res);
                    if(res=="addInDB")
                    {
                        alert("user Added In DB");
                        console.log("user Added In DB");
                    }
                    else if(res=="notAdd")
                    {
                        alert("user Did Not Add In DB");
                        console.log("user  Did Not Add In DB");
                    }    
                }
            });
        }    
    }
</script>
<!--login code end -->

<!-- <a href="#" class="btn btn-danger m-3" onclick="signOut();">Sign out</a> -->

<!-- logout code start -->
<script>
    function signOut() 
    {   
        var auth2 = gapi.auth2.getAuthInstance();
            // var revokeAllScopes = function() {
            //     gapi.auth2.getAuthInstance().disconnect();
            // }
            auth2.signOut().then(function () {
            //console.log('User signed out.');
            
            $.ajax(
            {
              type:'POST',
              url:'loginByGmailAccount/logout.php',
              data:{logout:'logout'},
              success:function(res)
              {

                alert(res); 
                console.log(res);
                //window.location.href = "";
                auth2.disconnect();
                // location.reload();
              }  
            });
        });
    }
 </script>
 <!-- logout code end -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>   
<!-- ==============================================gmail login/logut end============================================================= -->

<!-- ==============================================fb login/logout start============================================================== -->
<!-- <div class="fb-login-button" data-width="" data-size="medium" data-button-type="login_with"  onlogin="checkLoginState();" data-layout="default" data-auto-logout-link="true" data-use-continue-as="true"></div> -->

<script>

function statusChangeCallback(response) {  // Called with the results from FB.getLoginStatus().
    console.log('statusChangeCallback');
    console.log(response);                   // The current login status of the person.
    if (response.status === 'connected') {   // Logged into your webpage and Facebook.
      testAPI();  
    } else {                                 // Not logged into your webpage or we are unable to tell.
    //   document.getElementById('status').innerHTML = 'Please log ' + 'into this webpage.';
      $(
      {
        type:'post',
        url:'facebookLogin/logout.php',
        data:{logout:'logout'},
        beforeSend:function()
        {
          
        },
        success:function(res)
        {
          console.log(res);
          console.log('you Are logged-Out');
          
          alert('you Are logged-Out');
        },
      });
    }
  }
  function checkLoginState() {               // Called when a person is finished with the Login Button.
    FB.getLoginStatus(function(response) {   // See the onlogin handler
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
    FB.init({
      appId      : '147457133911749',      //App Id in curli braces
      cookie     : true,                     // Enable cookies to allow the server to access the session.
      xfbml      : true,                     // Parse social plugins on this webpage.
      version    : 'v10.0'           // Use this Graph API version for this call.
    });


    FB.getLoginStatus(function(response) {   // Called after the JS SDK has been initialized.
      statusChangeCallback(response);        // Returns the login status.
    });
  };
 
  function testAPI() 
  {                      
    // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
    
    console.log('Welcome!  Fetching your information.... ');
    
    FB.api('/me', {locale: 'en_US', fields: 'id,first_name,birthday,age_range,hometown,location,last_name,email,link,gender,locale,picture'}, function(response) 
    {

      // console.log('Successful login for: ' + response.name);
      
      document.getElementById('status').innerHTML ='<p>Thanks for logging in, ' + response.first_name + '!</p>';
      // isset($_POST['name']) && isset($_POST['userImage']) && isset($_POST['email']) && isset($_POST['userId']
      $.ajax(
      {
        type:'post',
        
        url:'facebookLogin/afterLogin.php',
        
        data:{
          'userId':response.id,
          
          'fName':response.first_name,

          'lName':response.last_name,

          'email':response.email,

          // 'hometown':response.hometown,

          // 'localtion':response.location,

          // 'age_range':response.age_range,

          // 'birthday':response.birthday,
          
          // 'link':response.link,

          // 'gender':response.gender,

          // 'locale':response.locale,

          // 'picture':response.picture,
        },
        beforeSend:function()
        {

        },
        success:function(res)
        {
          console.log(res);
          if('addInDB')
          {
            console.log(res);
            if(res=="addInDB")
            {
              alert("user Added In DB");
              console.log("user Added In DB");
            }
            else if(res=="notAdd")
            {
              alert("user Did Not Add In DB");
              console.log("user  Did Not Add In DB");
            }
          }
        }        
      });  

    //   document.getElementById('userData').innerHTML = '<h2>Facebook Profile Details</h2><p><b>FB ID:</b> '+response.id+'</p><p><b>Name:</b> '+response.first_name+' '+response.last_name+'</p><p><b>Email:</b> '+response.email+'</p><p><b>Gender:</b> '+response.gender+'</p><p><b>FB Profile:</b> <a target="_blank" href="'+response.link+'">click to view profile</a></p>';


    //   document.getElementById('userData').innerHTML = '<h2>Facebook Profile Details</h2><p><img src="'+response.picture.data.url+'"/></p><p><b>FB ID:</b> '+response.id+'</p><p><b>Name:</b> '+response.first_name+' '+response.last_name+'</p><p><b>Email:</b> '+response.email+'</p><p><b>Gender:</b> '+response.gender+'</p><p><b>FB Profile:</b> <a target="_blank" href="'+response.link+'">click to view profile</a></p>';
      //document.getElementById('userData').innerHTML = 'Thanks for logging in, ' + response.name + '!';
    });
  }



</script>
<!-- <div id="status"></div>
<div id="userData"></div> -->
<!-- Load the JS SDK asynchronously -->
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
<!-- ==============================================fb login/logout end=================================================================== -->

</body>
</html>