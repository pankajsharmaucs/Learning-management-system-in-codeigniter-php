<?php 
$_SESSION['c_table']='teacher';
$table=$_SESSION['c_table'];
if(isset($_SESSION['auth_login_unboxskills_'.$table])){}else{ header('location:register'); die();}


$_SESSION['dash_url']=base_url('/').$table.'/';

$_SESSION['auth_teacher_email']=$_SESSION['auth_login_unboxskills_'.$table];

$t_data = $this->Admin->get_teacher_data($_SESSION['auth_teacher_email']); 

$_SESSION['auth_teacher_id']=$t_data[0]['teacher_id'];

// var_dump($_SESSION['auth_teacher_id']); die();

?>


<!DOCTYPE html>
<html>
<body>
<head>
  <title><?= $title ?></title>
 <script> var siteUrl = '<?=base_url('/')?>'; </script>
 


 <link rel="icon" href="<?=base_url('assets/lms/')?>img/Logo -unboxskills.png" type="image/gif" > 

   <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />


  <link rel="stylesheet" href="<?=base_url('assets/teacher/')?>vendors/feather/feather.css">
  <link rel="stylesheet" href="<?=base_url('assets/teacher/')?>vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?=base_url('assets/teacher/')?>vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?=base_url('assets/teacher/')?>vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="<?=base_url('assets/teacher/')?>vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="<?=base_url('assets/teacher/')?>js/select.dataTables.min.css">
  <link rel="stylesheet" href="<?=base_url('assets/teacher/')?>css/vertical-layout-light/style.css">
  <link rel="stylesheet" href="<?=base_url('assets/teacher/')?>css/richtext.min.css">


<!-- ==============Course link=== -->

  <link rel="stylesheet" href="<?=base_url('assets/teacher/')?>css/course.css">
  <link rel="stylesheet" href="<?=base_url('assets/teacher/')?>css/global.css">
  <link rel="stylesheet" href="<?=base_url('assets/teacher/')?>css/media.css">

<link rel="stylesheet"    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"  />



</head>
</body>

<input type="hidden" id="focusPoint">
<!-- =========Welcome==popup==== -->

<div class="preLoader1 popup-2" >
    <div class="">
        <div class="text-center " style="width:100%; padding:15px 20px; 
        background: #fff; border-radius:4px; ">

           <div class="my-2">
              <img src="<?=base_url('assets/teacher/')?>images/teacherLoader.gif" alt="Logo unboxskills" 
              style="height: 360px;">
           </div>
        </div>
    </div>
</div>



    
<!-- ============End==of===Welcome==popup==== -->

  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row bg-white">
      <?php if($pagename=='createcourse'){ ?>

        <div class="col-md-6 col-6 text-center navbar-brand-wrapper d-flex align-items-center justify-content-start pt-1">
        <a class=" text-dark  mr-lg-5 f_15 rt_14" href="<?=base_url('/teacher-dashboard')?>"><i class="fas fa-chevron-left"></i>&nbsp; &nbsp; Back to Dashboard</a>
        <!-- <a class="navbar-brand brand-logo-mini" href="index.html"></a> -->
      <?php if($_SESSION['current_course_id'] and $_SESSION['current_course_name']) {?>
        <span class="fw_700 rt_14 f_15 d-md-block d-none"><?= $_SESSION['current_course_name'] ?></span>
      <?php } ?>
      
      </div>
          
    <?php  } else{  ?>

      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center pt-1">
        <a class="navbar-brand brand-logo mr-5" href="<?=base_url()?>"><img src="<?=base_url('assets/teacher/')?>images/Logo -unboxskills.png" alt="Logo unboxskills" style="height: 60px;"></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="<?=base_url('assets/teacher/')?>images/Logo -unboxskills.png" alt="Logo unboxskills" style="height: 60px;width:60px;" alt="Logo unboxskills"></a>
       
      </div>


      <?php } ?>
      <div class="col-md-6 col-6 navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <!-- <?php if($pagename !='createcourse'){ ?>
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <?php } ?> -->
        <ul class="navbar-nav navbar-nav-right">
         
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="<?=base_url('assets/teacher/')?>images/faces/face28.jpg" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="ti-settings text-primary"></i>  
                Settings
              </a>
              <a class="dropdown-item" href="<?=base_url('teacher/logout')?>">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
         <!--  <li class="nav-item nav-settings d-none d-lg-flex">
            <a class="nav-link" href="#">
              <i class="icon-ellipsis"></i>
            </a>
          </li> -->
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>



    <div class="container-fluid page-body-wrapper create_course">
      
      <!-- <span class="fw_700 rt_14 f_15 d-block d-md-none">Course Introducation</span> -->
    