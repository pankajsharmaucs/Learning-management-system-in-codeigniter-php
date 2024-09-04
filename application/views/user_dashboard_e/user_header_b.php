<?php 


$uemail=$_SESSION['auth_user'];

$tbl1='users_e';

$c_data=$this->admin->getWhere($tbl1,['email'=>$uemail]);
$fullname=$c_data[0]->name;
$country=$c_data[0]->country;

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
	 <!-- <link rel="stylesheet" href="<?=base_url('assets/')?>home_e/css/style_b.css"> -->
	 <!-- <link rel="stylesheet" href="<?=base_url('assets/')?>home_e/css/home_desktop_view.css"> -->
	 <!-- <link rel="stylesheet" href="<?=base_url('assets/')?>home_e/css/home_mobile_media.css"> -->
	 <!-- <link rel="stylesheet" href="<?=base_url('assets/')?>home_e/css/popup.css"> -->
	 <!-- ==================aquib====css===advance==search=== -->
	 <!-- <link rel="stylesheet" href="<?=base_url('assets/')?>home_e/css/advance_search_dropDown.css"> -->
	 <!-- <link rel="stylesheet" href="<?=base_url('assets/')?>home_e/css/adv_search_b.css"> -->
	 
<!-- ==============Company===info===== -->
	 <!-- <link rel="stylesheet" href="<?=base_url('assets/')?>home_e/css2/media_b.css"> -->
	 <!-- <link rel="stylesheet" href="<?=base_url('assets/')?>home_e/css2/global_b.css"> -->
	 <!-- <link rel="stylesheet" href="<?=base_url('assets/')?>home_e/css2/adv_search_b.css"> -->
	 <!-- <link rel="stylesheet" href="<?=base_url('assets/')?>home_e/css2/company_info_b.css"> -->
	 <!-- <link rel="stylesheet" href="<?=base_url('assets/')?>home_e/css2/form.css"> -->
	 <!-- <link rel="stylesheet" href="<?=base_url('assets/')?>home_e/css2/footer.css"> -->
	 <!-- <link rel="stylesheet" href="<?=base_url('assets/')?>home_e/css2/style_b.css"> -->
	 <link rel="stylesheet" href="<?=base_url('assets/')?>home_e/css2/global_update.css">
	 <!-- <link rel="stylesheet" href="<?=base_url('assets/')?>home_e/css2/login_b.css"> -->
	 <!-- <link rel="stylesheet" href="<?=base_url('assets/')?>home_e/css2/contact_b.css"> -->
	 <!-- <link rel="stylesheet" href="<?=base_url('assets/')?>home_e/css2/dashboard_b.css"> -->
	 <!-- <link rel="stylesheet" href="<?=base_url('assets/')?>home_e/css2/privacy_b.css"> -->
	 <!-- <link rel="stylesheet" href="<?=base_url('assets/')?>home_e/css2/faq_b.css"> -->
	 

	 <!-- =========================User-====dashboard===== -->
	 <link rel="stylesheet" href="<?=base_url('assets/user_dashboard_e/css/dashboard_b.css')?>">
	 <link rel="stylesheet" href="<?=base_url('assets/user_dashboard_e/css/media.css')?>">

	 
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

<?php 

$actual_link = "$_SERVER[HTTP_HOST]";

// echo $actual_link;

if($actual_link == 'localhost'){$siteUrl="http://localhost/kreditaid/"; }
else{ $siteUrl="https://www.ucs-its.com/kreditaid"; }

?>

<!-- kreditaid_search_loader -->



<div class="searchLoader" id="searchLoader" style="width:100%;height:100%;background:#FAFBFC;display:none;justify-content: center;align-items: center;position: fixed;top:0;z-index:181881; background-position: center;">
 <div class="text-center">
   <img src="<?=base_url('assets/')?>home_e/images/loader/kreditaid_search_loader.gif"style="transition:2s" width="500px" class="ucs_it_logo">
   <h4 class="animate__animated animate__fadeInUp mt-lg-4 mt-2 "><span class="text-danger">KreditAit </span>  Fetching data and creating Report..</h4>
 </div>
</div>


<!-- ================Supprort ticket==loader=== -->
<div class="supportloader" id="supportloader" style="width:100%;height:100%;background:#f9f9f9;display:none;justify-content: center;align-items: center;position: fixed;top:0;z-index:181881; background-position: center;">
 <div class="text-center">
   <img src="<?=base_url('assets/')?>home_e/images/loader/supportLoader.gif"style="transition:2s" width="200px" class="supportloaderImg">
   <h5>Uploading...</h5>
 </div>
</div>





<!-- ----------------end--------------- -->


 <section>

	<div class="container-fluid user_header" style="position: fixed;top: 0;z-index:5;background-color: #fff;">
	<div class="px-xl-5 px-lg-5  header_container p-0">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-0">
				<nav class="navbar navbar-expand-lg navbar-light  py-xl-2 py-lg-1 p-0">
				  <a class="navbar-brand pl-4 py-3" href="<?= $siteUrl ?>">
                   <img src="<?=base_url('assets/')?>home_e/images/logo.png" alt="" class="img-fluid" width="130px">
				  </a>

				  <button class=" dashboard_right navbar-toggler pr-4  pl-4 py-4" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="border:none;">
				  	
				    <div class="dashboard_menu_icon">
				    	<div></div>
	                    <div></div>
	                    <div class="d-flex justify-content-end">
                          <div></div>
	                   </div>
					    </div>
				  </button>

				  <!-- <div class="usersearchBox">
				  	<input type="text" name="" placeholder="Search Company" id="usersearchinput">
				  	  <button onclick="SearchCompany()" >Search</button>
				  </div> -->




				  <div class="d-none d-xl-block d-lg-block collapse navbar-collapse bg-white header_dropodown" id="navbarSupportedContent" style="">
				    <ul class="navbar-nav mr-auto text-center py-3">
				      
				    
				      
				    </ul>

<!-- ======================Search==company==by userdashboard====== -->
<div class="usersearchBox">
<input type="text" name="" placeholder="Search Company" id="usersearchinput">
<button onclick="SearchCompany()" >Search</button>
</div>

				    <div class="form-inline dashboard_right border-0 my-2 my-lg-0 ml-auto text-center mb-4">
				      <div class="dropdown circle_dropdown">
					   <div class="d-flex justify-content-between align-items-center circle_dropdown pr-3" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <div class="img dashboard_user_img pr-2">
                        <img src="<?=base_url('assets/')?>user_dashboard_e/image/user.png" alt="" class="img-fluid">
                      </div>
                      <div class="title pr-2 f_15"><?= $fullname ?></div>
                      <div class="icon"><i class="fas fa-angle-down tc_1"></i></div>
                    </div>
                    <div class="dropdown-menu dashboard_dropdown_menu w-100 py-0 shadow border-0" aria-labelledby="dropdownMenuButton">
                      
                      <div class="dropdown-item py-2 fw_300 f_15 " style="cursor: pointer;" onclick="desktopSideBarBtn(8)">Profile Setting</div>
                      <a class="dropdown-item py-2 fw_300 f_15" href="Logout">Log out</a>
                    </div>
					</div>
				    </div>
				  </div>
				</nav>
            </div>
		</div>
	</div>
</div>
</section>




