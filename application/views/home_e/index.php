<?php 
//  $pass="123"; $hash=password_hash($pass,PASSWORD_BCRYPT); echo $hash;

 ?>

<!-- ---------hero section------------ -->
 <section class="hero_section">
	<div class="container-fluid px-xl-5 px-lg-4 px-md-2">
		<div class="d-flex justify-content-center flex-wrap-reverse ">

		<!-- ==================hero==video================================= -->
		    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 bg_5 hero_back mt-lg-5 mt-xl-0 mt-5">
            	<div class="hero_video py-xl-2 py-2">
            		 <video  loop autoplay ="mu" width="100%">
					  <source src="<?=base_url('assets/')?>/home_e/video/KreditAid Intro - Hero.mp4" type="video/mp4">
					</video> 
            	</div>
            </div>
<!-- ======================end of hero==video=== -->


<!-- ====================================Hero-===search======= -->

			<div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12  d-flex justify-content-center  align-items-start " >
				<div class="hero_content  mt-xl-4 mt-lg-1">
					<h1 class="f_48 tc_0 rt_25 ka_text1" style="color:#161C6D">Analyzing with precision</h1>
					<p class=" mt-lg-1 mt-0  ka_text2 text-dark">Access detailed Business Information Reports of companies across the globe.</p>

					<form id="searchForm" class="pt-xl-2 pt-lg-2 p-1" autocomplete="off">
<!-- ===========================Select type================================================= -->
					<div class="form-row" id="filtermyDIV" >
					 	<div class="rbutton_box d-flex justify-content-start flex-wrap   mb-2 ml-2">
					   
						    <label class="rbutton mr-xl-3 mr-2 rt_14">Company Name
						      <input type="radio" checked="checked" class="stype_btn" value="Company_name" name="h_search" onchange="cn();">
						      <span class="checkmark"></span>
						    </label> 

						    <label class="rbutton mr-xl-3 mr-2 rt_14">Director Name
						      <input type="radio"  name="h_search" class="stype_btn" value="Director_name" onchange="dn();">
						      <span class="checkmark"></span>
						    </label> 

						    <label class="rbutton rbutton3 mr-xl-3 mr-2 rt_14">CIN
						      <input type="radio"  name="h_search" class="stype_btn" value="CIN" onchange="cin();">
						      <span class="checkmark"></span>
						    </label>

							<input type="hidden" id="searchtype" value="Company_name"  >

					    </div>
					 </div>
<!-- ==================================country===name=== -->
					  <div class="form-row">
					    <!-- <div class="form-group col-xl-3 col-lg-3 col-md-3" style="position: relative;" id="autocomplete">
					     <i class="fas fa-map" style="position: absolute; right: 20px;top:20px"></i>
						 <input type="text" name="search" class="search w-100 mb-2" value="India" id="search1" placeholder="Country " class="form-control" />
					     
					     <ul class="list-group"  id="result"></ul>
					    </div> -->

			<div   class="form-group col-xl-4 col-lg-4 col-md-4 searchInputBox" id="country_autocomplete">
		        
			        <input type="text" class="search w-100 country_Search"   id="country_Search" value="India" name="search"   
			        required onfocus="this.value=''; $('.countryFlag').attr('src','');  $('#keywordType').val(0);   "  placeholder="Select Country" >
			        
			        <input type="hidden"  id="country_Search_hidden" value="India">

                     <div class="countryDownIcon " onclick="openAllContry()">
						 <img class="countryFlag " src='<?=base_url('assets/')?>/home_e/flags/in.png'>
						 <i class="fas fa-chevron-down "  ></i>
					</div>


				    <div class="countryResultBox"></div>

				 	<div class="allcountryBox"></div>
			 </div>

						 <input type="hidden" id="dropdownType" value="0">
						 <input type="hidden" id="droplistCount" value="0">
						 <input type="hidden" id="droplistCount2" value="0">
						 <input type="hidden" id="droplistCount3" value="0">
						 <input type="hidden" id="countrySearchCount" value="0">
						 <input type="hidden" id="keywordType" value="0">

<!-- =======================type===keyword==== -->

					    <div   class="form-group col-xl-6 col-lg-6 col-md-6 searchInputBox">
					        <input type="text" class="search w-100 heroRadio" autofocus  name="" placeholder="Company Name" id="search" 
					        onfocus=" $('#keywordType').val(1);   " required>
						    <div class="searchResultBox" >
<!-- 							<div class='resultRow' onclick="window.open('company/L00000PB1986PLC006798','_self');">ARIHANT CORPORATION LIMITED</div>
 -->						 	</div>
						 </div>
<!-- =========================================Submit==button================= -->
					    <div class="form-group col-xl-2 col-lg-2 col-md-2 hero_search d-flex justify-content-start">
					     <div class="bg_4  searchBtn " onclick="submitSearchForm()">
					     	<img src="<?=base_url('assets/')?>home_e/images/svg/search.svg" height="20px" width="20px" class="">
					     </div>
					    </div>

					  </div>

					  <div class="col-md-12 searchErrorBox1 "> <div class="errorDot"></div> <div class="errorTxt1">Please type any search keyword.</div></div>
					</form>
					
<!-- ==============================Company==hero===video===== -->

					<div class="hero_search_para mt-xl-0 mt-0 col-12 w-100 d-flex justify-content-center align-items-start">
<!-- 						<span class="f_14 tc_1">Free forever version with Unlimited Users. Free 14-days trial to test Premium. </span>
 -->						<div class="blink text-center mb-4">
							<span id="Blink " class="">
								<h6 class="f_20 fw_400 tc_1 blinkData animate__animated animate__slower" id="bl1">
									<!-- <i class="fa fa-user h3 mr-2 text-primary justify-content-around align-items-center"></i> -->#Company Profiles </h6>
								<h6 class="f_20 fw_400  text-info tc_2 blinkData animate__animated animate__slower" id="bl2">#Financial Reports</h6>
								<h6 class="f_20 fw_400  text-warning blinkData animate__animated animate__slower" id="bl3">#Company Status</h6>
								<h6 class="f_20 fw_400  text-danger blinkData animate__animated animate__slower" id="bl4">#Directors Information</h6>
								<h6 class="f_20 fw_400 text-success blinkData animate__animated animate__slower" id="bl5">#Company Tracking</h6>
							</span>
							
						</div>
					</div>
					

					<!-- <div class="hero_comment mt-5 bg_3 p-3 mt-lg-3 ">
						<span class="f_14 font-weight-bold tc_1">"The look & feel of the KreditAid interface makes <span>creating & closing tasks simple and satisfying!"</span></span>
						<div>
							<div class="media mt-2">
							  <img class="mr-3" src="<?=base_url('assets/')?>home_e/images/comment.jpg" alt="Generic placeholder image">
							  <div class="media-body">
							    <h5 class="mt-0 f_15 tc_3 font-weight-bold">Brandon Roche</h5>
							     <h6 class="f_14 tc_3">Strategic Account Manager at Webflow</h6>
							  </div>
							</div>
						</div>
					</div> -->
				</div>
            </div>
<!-- ============================end==of hero===search==== -->

		</div>
	</div>
</section>

<!-- ---------end------------ -->








<?php include('home_content.php'); ?>


