<?php  

// session_destroy();

// unset($_SESSION['sign_up_data']);
// var_dump($_SESSION); die(); 

// if(!$_SESSION['auth_user']){ session_destroy(); }

 if(!$_SESSION['auth_user']){

         unset($_SESSION['otp']);
         unset($_SESSION['to']);
         unset($_SESSION['otp_times']);
         unset($_SESSION['sign_up_data']);
         unset($_SESSION['current_time1']);
}

?>

<!DOCTYPE html>
<html>
<head>
	<title><?= $title ?></title>
	 <meta charset="UTF-8">
	 <meta name="description" content="">
	 <meta name="keywords" content="">
	 <meta name="author" content="">
	 <meta name="viewport" content="width=device-width, initial-scale=1.0">

	 <link rel="shortcut icon" href="<?=base_url('assets/')?>home_e/images/favicon.png') ?>">
     <!-- ---link---home-- -->
	 <link rel="stylesheet" href="<?=base_url('assets/')?>front/css/bootstrap.min.css">

     
	 <link rel="stylesheet" href="<?=base_url('assets/')?>home_e/css/animate.css">
	 <link rel="stylesheet" href="<?=base_url('assets/')?>home_e/css/font.css">
	 <link rel="stylesheet" href="<?=base_url('assets/')?>home_e/css/style_b.css">
	 <link rel="stylesheet" href="<?=base_url('assets/')?>home_e/css/home_desktop_view.css">
	 <link rel="stylesheet" href="<?=base_url('assets/')?>home_e/css/home_mobile_media.css">
	 <link rel="stylesheet" href="<?=base_url('assets/')?>home_e/css/popup.css">
	 <link rel="stylesheet" href="<?=base_url('assets/')?>home_e/css/style_b.css">
	 
	 
	 <!-- ==================aquib====css===advance==search=== -->
	 <!-- <link rel="stylesheet" href="<?=base_url('assets/')?>home_e/css/advance_search_dropDown.css"> -->
	 <link rel="stylesheet" href="<?=base_url('assets/')?>home_e/css/adv_search_b.css">
	 <link rel="stylesheet" href="<?=base_url('assets/')?>home_e/css/adv_search_bNew.css">
	 
<!-- ==============Company===info===== -->
	 <link rel="stylesheet" href="<?=base_url('assets/')?>home_e/css2/media_b.css">
	 <link rel="stylesheet" href="<?=base_url('assets/')?>home_e/css2/contact_b.css">
	 <link rel="stylesheet" href="<?=base_url('assets/')?>home_e/css2/adv_search_b.css">
	 <link rel="stylesheet" href="<?=base_url('assets/')?>home_e/css2/company_info_b.css">
	 <link rel="stylesheet" href="<?=base_url('assets/')?>home_e/css2/form.css">
	 <link rel="stylesheet" href="<?=base_url('assets/')?>home_e/css2/footer.css">
	 <!-- <link rel="stylesheet" href="<?=base_url('assets/')?>home_e/css2/style_b.css"> -->
	 <link rel="stylesheet" href="<?=base_url('assets/')?>home_e/css2/global_update.css">
	 <link rel="stylesheet" href="<?=base_url('assets/')?>home_e/css2/login_b.css">
	 <link rel="stylesheet" href="<?=base_url('assets/')?>home_e/css2/media_b.css">
	 <link rel="stylesheet" href="<?=base_url('assets/')?>home_e/css2/policy_b.css">
	 
<!-- home_mobile_media -->

 <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css" />

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>


	 <!-- ----------bootstrap css------------- -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
 integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<!-- ------------end------------------- -->

<!-- --------font awesome--------- -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
<!-- ---------end------ -->


	 
	 <!-- <link rel="stylesheet" href="<?=base_url('assets/')?>front/css/utility.css"> -->
	<!-- <link rel="stylesheet" href="<?=base_url('assets/')?>front/css/new_ui.css"> -->
  <!-- <link rel="stylesheet" href="<?=base_url('assets/')?>front/css/responsive.css"> -->
  <!-- <link rel="stylesheet" href="<?=base_url('assets/')?>front/css/typography.css"> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">

	<script src="<?=base_url('assets/')?>front/js/jquery.js"></script>
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha256-ENFZrbVzylNbgnXx0n3I1g//2WeO47XxoPe0vkp3NC8=" crossorigin="anonymous" />
	
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha256-3blsJd4Hli/7wCQ+bmgXfOdK7p/ZUMtPXY08jmxSSgk=" crossorigin="anonymous"></script>
	<!-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />  -->
	 <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<!--<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" /> -->

	<link href="https://unpkg.com/placeholder-loading/dist/css/placeholder-loading.min.css" rel="stylesheet">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
	<script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>
	<script src="https://unpkg.com/jquery-aniview/dist/jquery.aniview.js"></script>
	 <!-- ----end------ -->


<style >
   
   html{ scroll-behavior:smooth!important; }
	
</style>
</head>
<body >
<script>
var siteUrl = '<?=base_url('/')?>';
console.log(siteUrl);
</script>

<?php

if(isset($_SESSION['redirectUrl']) && $_SESSION['redirectUrl']==3)
{
	// var_dump($_SESSION);die('condition 3');
	redirect(base_url('/').'User_Dashboard?a='.$_SESSION['redirectUrl']);
}

if(isset($_SESSION['redirectUrl']))
{
	// var_dump($_SESSION);die("no condation");
	// redirect(base_url('/').'User_Dashboard?a='.$_SESSION['redirectUrl']);
}
// session_destroy();

// session_start();
$actual_link = "$_SERVER[HTTP_HOST]";

if($actual_link=='localhost'){ $siteUrl="http://localhost/lms"; }
else{ $siteUrl="https://www.ucs-its.com/kreditaid"; }


 $link = $_SERVER['REQUEST_URI'];  $link_array = explode('/',$link); 
 $page = end($link_array);
 
?>

<!-- kreditaid_search_loader -->



<div class="searchLoader" id="searchLoader" style="width:100%;height:100%;background:#FAFBFC;display:none;justify-content: center;align-items: center;position: fixed;top:0;z-index:181881; background-position: center;">
 <div class="text-center">
   <img src="<?=base_url('assets/')?>home_e/images/loader/kreditaid_search_loader.gif"style="transition:2s" width="400px" class="ucs_it_logo">
   
   <div class="animate__animated animate__fadeInUp mt-lg-4 mt-2  col-12 ">
   	<div class="text-danger">KreditAid &nbsp;</div> <div class="loaderTxt">Fetching data & Analysing...</div> 
   </div>
   
   </div>
</div>





<!-- -------------top section ------------->

<section class="d-xl-block d-none">
	<div class="container-fluid bg_1">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center"> 
				<div class="home_top_advertisment py-2">
                 <span class="text-white f_15"><b>Business Report, Complete company profile </b> Get all Data in seconds!</span>
                </div>
            </div>
		</div>
	</div>
</section>


<!-- ----------------end--------------- -->


 <section>
	<div class="container-fluid">
	<div class="px-xl-5 px-lg-5  header_container p-0">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-0">
				<nav class="navbar navbar-expand-lg navbar-light  py-xl-2 py-lg-1 p-0">
				  <a class="navbar-brand pl-4 py-3" href="<?= $siteUrl ?>">
                   <img src="<?=base_url('assets/')?>home_e/images/logo.png" alt="KreditAid Logo" class="img-fluid mainLogo" width="130px">
				  </a>
				  <!--<button class="navbar-toggler bg-white pr-4 pb-3 pl-4 py-4" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="border:none;">-->
				  <!--  <div class="mobile_menu">-->
				  <!--  	<div></div>-->
				  <!--  	<div></div>-->
				  <!--  	<div></div>-->
				  <!--  </div>-->
				  <!--</button>-->

				  <!--<div class="collapse  bg-white header_dropodown" id="navbarSupportedContent" style="">-->
				    <ul class="navbar-nav mr-auto text-center py-4 mr-2">
				      <!-- <li class="nav-item active ml-xl-3">
				        <a class="nav-link" href="#">Product <span class="sr-only">(current)</span></a>
				      </li> -->
				     <!--  <li class="nav-item ml-xl-3">
				        <a class="nav-link" href="#">Pricing</a>
				      </li> -->
				      <!-- <li class="nav-item dropdown ml-xl-3">
				        <a class="nav-link dropdown-toggle d-flex justify-content-center align-items-center" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				          <span class="">Compare</span>
				          <i class="fas fa-angle-down"></i>
				        </a>
				        <div class="dropdown-menu nav_dropdown" aria-labelledby="navbarDropdown">
				          <a class="dropdown-item" href="#">Action</a>
				          <a class="dropdown-item" href="#">Another action</a>
				          
				        </div>
				      </li> -->

				      <!-- <li class="nav-item dropdown ml-xl-3">
				        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				          <span class="">Solution</span>
				          <i class="fas fa-angle-down"></i>
				        </a>
				        <div class="dropdown-menu nav_dropdown" aria-labelledby="navbarDropdown">
				          <a class="dropdown-item" href="#">Action</a>
				          <a class="dropdown-item" href="#">Another action</a>
				          
				        </div>
				      </li> -->
				       
				       <!-- <li class="nav-item ml-xl-3">
				        <a class="nav-link" href="<?= $siteUrl ?>Support">Support</a>
				      </li> -->
				    </ul>

				    <div class="form-inline my-1 my-lg-0 ml-auto text-center mb-xl-4 mb-lg-4  mr-xl-0 mr-lg-0 mr-3">
				       
				       
				       <!--cart dropdown-->
				       
				      
				       
				       <!-end--->
				      
				      <?php if($page == 'Register'){ ?>
				      
        				      <?php if(!$_SESSION['auth_user']){ ?>

 		            			  <button class="btn1 my-2 ml-2 my-sm-0 tc_15 text-white bg_2" 
					               onclick="window.open('<?=base_url('/')?>','_self')" >Home</button>
					               
					           <?php }else{ ?>
					           
					            <a class="nav-link f_15 tc_2 tch_2" href="<?=base_url('/')?>User_Dashboard?a=3">
                                    <div class=" MyCartBtn" >
                                        
            					  	<img src="<?=base_url('assets/')?>home_e/images/carts.png " style="width:35px">
			            		  	<?php if(@$_SESSION['cart_item'] > 0){ ?>
										 
										 <h6 class="cartCount">
							        	  <?= $_SESSION['cart_item']; ?>
						  	            </h6>
					  	            <?php } ?>	
					  	        </div></a>
					  	        
					  	       
					  	
					                    <button class="btn1 my-2 my-sm-0 tc_15 text-white bg_2" 
					                     onclick="window.open('<?=base_url('/')?>User_Dashboard?a=1','_self')" >Dashboard</button>
					           
					           <?php }?>
					           
					           
					           

<!-- =================================Pankaj===================== -->
	      <?php } else{

				       if( $_SESSION['auth_user']){ ?>

						   <a class="nav-link f_15 tc_2 tch_2" href="<?=base_url('/')?>User_Dashboard?a=3">


					  	<div class=" mr-3 MyCartBtn" >

					  	<img src="<?=base_url('assets/')?>home_e/images/carts.png " style="width:35px">
					  	<?php if(@$_SESSION['cart_item'] > 0){ ?>
										 <h6 class="cartCount">
							        	  <?= $_SESSION['cart_item']; ?>
								        <!-- $cart_count -->
						  	            </h6>
					  	            <?php } ?>	
					  	            
					  	
					  	
					  	</div></a>

			<!-- ==================================================================== -->
				       
					   <button class="btn1 my-2 my-sm-0 tc_15 text-white bg_2" 
					   onclick="window.open('<?=base_url('/')?>User_Dashboard?a=1','_self')" >Dashboard</button>
					  <?php }

					   else{  ?>		  	

					  	<div class=" mr-3 MyCartBtn MyCartBtnLocal" 
					  	onclick="$('.cartBox').toggle().addClass('animate__animated animate__fadeIn');" >

					  	<img src="<?=base_url('assets/')?>home_e/images/carts.png " style="width:35px">
					  	 <h6 class="cartCount cartCountLocale">
							 
					  	</h6>
			<!-- ==================================================================== -->

			<!--========================= Aquib localeStorage Cart= Start========================== -->
						<div  class="cartBox animate__animated  animate__shakeX not-empty-cart" style="display:none">	

							<div class="col-12 text-center font-weight-bold" style="display:none"><h5>My Cart</h5></div>

							<div class=" cart-product ">
								<div class=" cartItems d-block p-1">
			                         
									</div>

									<!-- <div class="col-12 text-center font-weight-bold mb-3 checkoutAllButton" style="display:none">
										<div class="w-50 text-white bg-danger px-2 py-1 bordered ">Checkout All </div>
									</div> -->

							</div>
						</div>	
						<div  class="cartBox animate__animated  animate__shakeX empty-cart" id="empty-cart">
							<div class="col-12 text-center font-weight-bold"><h5 class="text-danger ">Cart is Empty</h5></div>
						</div>
						
						  <!--<div class="dropdown_3">-->
        <!--                              <img src="<?=base_url('assets/')?>home_e/images/carts.png " style="width:35px">-->
                                      
        <!--                              <div class="dropdown-content_3">-->
        <!--                           <div>-->
        <!--                             <div class="f_14">Marnia-farma-limited</div>-->
        <!--                             <div class=""><i class="fa fa-times text-white bg-danger p-1 f_15"></i></div>-->
        <!--                           </div>-->
                                
        <!--                           <div>-->
        <!--                             <div class="f_14">Report-1</div>-->
        <!--                             <div class=""><i class="fa fa-times text-white bg-danger p-1 f_15"></i></div>-->
        <!--                           </div>-->
                                
        <!--                           <div>-->
        <!--                             <div class="f_14">Report-1</div>-->
        <!--                             <div class=""><i class="fa fa-times text-white bg-danger p-1 f_15"></i></div>-->
        <!--                           </div>-->
                                
                                   <!--<button class="bg_4 p-1">Checkout</button>-->
        <!--                          </div>-->
        <!--                    </div>-->
			<!--===================Aquib localeStorage Cart=End======================  -->

					  	</div> 

						<a href="<?=base_url('/')?>Register">
							<button class="btn1 my-2 my-sm-0 tc_15 text-white bg_2"  >Sign In</button></a>

					  <?php } } ?>
<!-- ====================================pankaj========================= -->
				    </div>
				  <!--</div>-->
				</nav>
            </div>
		</div>
	</div>
</div>
</section>

<input type="hidden" id='cart_statusHeader' value='' >
<input type="hidden" id="comp_nameHeader" value="">
<input type="hidden" id="cinHeader" value="">
<input type="hidden" name="" data-toggle="modal" data-target="#PopUp" id='triggerShowPopUp'>




<?php  include('signup_popup.php'); ?>


