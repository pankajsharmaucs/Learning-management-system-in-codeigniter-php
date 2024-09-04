<?php 
// session_start();
	
// var_dump($_SESSION);die;
	// $_SESSION['cinl00000'] = ['cin'=>'l00000','name'=>'testst' ];
// session_unset();	
// session_destroy();	
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

// if(isset($_SESSION['redirectUrl']) && $_SESSION['redirectUrl']==3)
// {
// 	// var_dump($_SESSION);die('condition 3');
// 	redirect(base_url('/').'User_Dashboard?a='.$_SESSION['redirectUrl']);
// }

if(isset($_SESSION['redirectUrl']))
{
	// var_dump($_SESSION);die("no condation");
	redirect(base_url('/').'User_Dashboard?a='.$_SESSION['redirectUrl']);
}
// session_destroy();

// session_start();
$actual_link = "$_SERVER[HTTP_HOST]";

if($actual_link=='localhost'){ $siteUrl="http://localhost/kreditaid3"; }
else{ $siteUrl="http://kreditaid.com/dev3/"; }


 $link = $_SERVER['REQUEST_URI'];  $link_array = explode('/',$link); 
 $page = end($link_array);

?>

<!-- kreditaid_search_loader -->



<div class="searchLoader" id="searchLoader" style="width:100%;height:100%;background:#FAFBFC;display:none;justify-content: center;align-items: center;position: fixed;top:0;z-index:181881; background-position: center;">
 <div class="text-center">
   <img src="<?=base_url('assets/')?>home_e/images/loader/kreditaid_search_loader.gif"style="transition:2s" width="500px" class="ucs_it_logo">
   <h4 class="animate__animated animate__fadeInUp mt-lg-4 mt-2 "><span class="text-danger">KreditAit </span>  Fetching data and creating Report..</h4>
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
                   <img src="<?=base_url('assets/')?>home_e/images/logo.png" alt="" class="img-fluid" width="130px">
				  </a>
				  <button class="navbar-toggler bg-white pr-4 pb-3 pl-4 py-4" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="border:none;">
				    <div class="mobile_menu">
				    	<div></div>
				    	<div></div>
				    	<div></div>
				    </div>
				  </button>

				  <div class="collapse navbar-collapse bg-white header_dropodown" id="navbarSupportedContent" style="">
				    <ul class="navbar-nav mr-auto text-center py-3">
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

				    <div class="form-inline my-2 my-lg-0 ml-auto text-center mb-4">
				      

				      <?php if($page == 'Register'){ ?>

 					   <a class="nav-link f_15 tc_2 tch_2" href="<?= $siteUrl ?>">Home</a>

<!-- =================================Pankaj===================== -->
				      <?php } else{

				       if( $_SESSION['auth_user']){ ?>

 					   <a class="nav-link f_15 tc_2 tch_2" href="<?=base_url('/')?>User_Dashboard?a=3">


					  	<div class=" mr-3 MyCartBtn" >

					  	<img src="<?=base_url('assets/')?>home_e/images/carts.png " style="width:40px">
					  	<h6 class="cartCount">
							 <?= $_SESSION['cart_item']??0 ?>
							 <!-- $cart_count -->
					  	</h6>
					  	
					  	</div></a>

<!-- ==================================================================== -->
				       
					   <button class="btn1 my-2 my-sm-0 tc_15 text-white bg_2" onclick="window.open('<?=base_url('/')?>User_Dashboard?a=1','_self')" >Dashboard</button>
					  <?php } else{ ?>


					  	

					  	<div class=" mr-3 MyCartBtn" 
					  	onclick="$('.cartBox').toggle().addClass('animate__animated animate__fadeIn');" >

					  	<img src="<?=base_url('assets/')?>home_e/images/carts.png " style="width:40px">
					  	<h6 class="cartCount">
							  <?php
							   
							  if(isset($_SESSION) ){ 
					  	 		$id=0;
					  	 		$c=0;
					  	 		foreach ($_SESSION as $key) {
									if($key[0]['cin'] != null)
									{ 
										$c++;
										
									} 
								}
								$id++; 
								echo $c;
									
										  
								} 
							?>
					  	</h6>
<!-- ==================================================================== -->

					  	 <?php if($c >= 1 ){ ?>

       					   <div  class="cartBox animate__animated  animate__shakeX ">	
					  	 <?php if($c > 0 ){ ?>
                           <div class="col-12 text-center font-weight-bold"><h5>My Cart </h5></div>
                           <?php } else{ ?>
                           <div class="col-12 text-center font-weight-bold" ><h5>Cart is Empty</h5></div>
					  	 	<?php } $id=0; $cart_status=0;
										
					  	 	foreach ($_SESSION as $key) {
					  	 	// foreach ($key as $k) {

					  	 		// var_dump($key[0]['cin']);
								   	
					  	 		if($key[0]['cin'] != null){
				  	 		
               					$cin=$key[0]['cin'];
								$name=$key[0]['name'];
								   
               					if($cin > 0 ){ $cart_status=1;}

               					?>

		               			  	<div class=" cartItems "  >
							  	  		<div class="cname"><?= $name ?></div>
							  	  		<div class="checkoutBtn bg_1 p-1" onclick="login_to_cart1('<?= $cin ?>')">
											Checkout
										</div>

			                        	<a href="<?=base_url('/')?>removeCart/<?= $cin ?>">
								  	  		<div class="checkoutBtn bg-danger px-2 py-1"><i class="fa fa-times"></i></div>
								  		</a>
						  	    	</div>

						  	    	<div class="col-12 text-center font-weight-bold mb-3">
						  	     		<a href="<?=base_url('/')?>removeCart/<?= $cin ?>">
								  	  		<div class="checkoutBtn bg-danger px-2 py-1">Checkout All Reports</div>
								  		</a>
									</div>

					  			</div>

               				<?php } }$id++;  }else{ ?>
               					<div  class="cartBox animate__animated  animate__shakeX ">	
		                           <div class="col-12 text-center font-weight-bold"><h5>Cart is Empty</h5></div>
		                       </div>
               				<?php } ?>

					  	  
					  	  
					  		

					  	</div>


					    <!-- <a class="nav-link f_15 tc_2 tch_2" href="<?=base_url('/')?>Register">Sign In</a> -->



<!-- 
						<button class="btn1 my-2 my-sm-0 tc_15 text-white bg_2" type="submit" data-toggle="modal" 
					   data-target="<?= $_SESSION['auth_user']?'dashboard':'#PopUp' ?>"><?= $_SESSION['auth_user']?'
					   <a href="'.base_url('/').'User_Dashboard" >Dashboard</a>':'Get Started Free' ?></button> -->


						<a href="<?=base_url('/')?>Register">
							<button class="btn1 my-2 my-sm-0 tc_15 text-white bg_2"  >Sign In</button></a>

					  <?php } 
					} ?>
<!-- ====================================pankaj========================= -->
				    </div>
				  </div>
				</nav>
            </div>
		</div>
	</div>
</div>
</section>




<?php include('signup_popup.php'); ?>


