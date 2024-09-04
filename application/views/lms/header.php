<!DOCTYPE html>
<html>
<body>
<head>
  <title><?= $title ?></title>
<script> var siteUrl = '<?=base_url('/')?>'; </script>
 
 <?php 


// var_dump($_SESSION); die();


    $_SESSION['loginToken'] = md5(uniqid(mt_rand(), true));
    $_SESSION['studentToken'] = md5(uniqid(mt_rand(), true));
    $_SESSION['otpToken'] = md5(uniqid(mt_rand(), true));

  ?>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

 <link rel="icon" href="<?=base_url('assets/lms/')?>img/Logo -unboxskills.png" type="image/gif" > 

     <!-- customize css -->
      
     <link rel="stylesheet" type="text/css" href="<?=base_url('assets/lms/')?>css/style.css">
     <link rel="stylesheet" type="text/css" href="<?=base_url('assets/lms/')?>css/media.css">
     <link rel="stylesheet" type="text/css" href="<?=base_url('assets/lms/')?>css/global.css">
     <link rel="stylesheet" type="text/css" href="<?=base_url('assets/lms/')?>css/font.css">
     <link rel="stylesheet" type="text/css" href="<?=base_url('assets/lms/')?>css/account.css">


<!-- =============Student====Links=== -->

  <link rel="stylesheet" href="<?=base_url('assets/student/')?>vendors/feather/feather.css">
  <link rel="stylesheet" href="<?=base_url('assets/student/')?>vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?=base_url('assets/student/')?>vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?=base_url('assets/student/')?>vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="<?=base_url('assets/student/')?>vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="<?=base_url('assets/student/')?>js/select.dataTables.min.css">
  <!-- <link rel="stylesheet" href="<?=base_url('assets/student/')?>css/vertical-layout-light/style.css"> -->

<!-- cdn -->

     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

     <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

     <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.5.7/swiper-bundle.min.js" integrity="sha512-EY0DoR2OkwOeyNfnJeA6x1oMLZnHLWLmPKYuwIn+7HIqeejx7w9DpUm3lhpfz8iz7K4AvKC4w8Kh8EDgKDYjWA==" crossorigin="anonymous"></script>

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.5.7/swiper-bundle.css" integrity="sha512-JHb2JMOVqJKk0A56YvzOabc7okoyZ4Jc9vE5v/Q6L5WF+x1zru3C2nZqs5skiZoHRqDsqTnWzdpM2SqNkjrPKw==" crossorigin="anonymous" />
     
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

     <script src="https://code.jquery.com/jquery-3.6.0.js" ></script>

     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



</head>
</body>

<div class="Loginloader popup-2" >
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


   <!-- =======header=========== -->
<header class="desktop_header sticky-top animate__animated animate__fadeInDown ">
  <div class="header_main bg-transparent px-4">
   <div class="header_contentmain">
    <div class="logo mr-2 my-1">
      <a href="<?=base_url()?>" class="f_15"><img src="<?=base_url('assets/lms/')?>img/Logo -unboxskills.png" alt="Logo unboxskills" width="70px"></a>
    </div>
    <div class="header_right d-flex align-items-center ml-3">
      <!-- <div class="search">
        <form action="search.php">
          <div class="d-flex align-items-center">
            <input type="search" name="" placeholder="Search...">
            <button class="d-flex justify-content-center align-items-center px-2 bg-white"><img src="img/svg/loupe.svg" width="18px"></button>
          </div>
        </form>
      </div> -->
    </div>
    <div class="d-flex justify-content-end w-100">
      <div class="header_left d-flex align-items-center">
        
        <div class="header_menu d-flex align-items-center">
          
          <div class="Dropdown active"><a href="<?=base_url()?>">Home</a></div>
          <div class="Dropdown"><a href="#">About</a></div>
          
          <div class="Dropdown">
            <span class="f_15 py-0"><a href="<?= base_url()?>category">Category</a></span>
          </div>
          <div class="Dropdown"><a href="#">Support</a></div>
          <?php if($_SESSION['auth_login_unboxskills_student'] and $_SESSION['studentToken']  ) { ?>
            <div class="Dropdown"><a href="<?=base_url('/')?>student-dashboard">Dashboard</a></div>
          <?php  } else if($_SESSION['auth_login_unboxskills_teacher'] and $_SESSION['login_token']  ) {?>
            <div class="Dropdown"><a href="<?=base_url('/')?>teacher-dashboard">Dashboard</a></div>
          <?php } else{?>
            <div class="Dropdown"><a href="<?=base_url('/')?>login">Login</a></div>
          <?php } ?>
          
          
        </div>
        
      </div>
      <div class="header_right d-flex align-items-center">
        <div class="menu_right d-flex align-items-center text-center ml-3 mr-2">
          <div class="Dropdown-2 ml-3">
            <a href="<?=base_url('/courses'); ?>" class=" text-dark">
              <div class="button46 f_15 text-nowrap">
                Explore Courses
              </div>
            </a>
          </div>
        </div>
      </div>

    </div>
   </div>
   
  </div>
</header>
<!-- ================mobile header============== -->
<header class="mobile_header sticky-top bg-white shadow">
  <div class="header_main2 d-flex px-3 py-2   align-items-center justify-content-between flex-wrap">
    <div class="header_left d-flex align-items-center ">
      
     <!--  <div class="bar">
        <div></div>
        <div></div>
        <div></div>
      </div> -->
      <div class="ml-3">
        <a href="<?=base_url()?>" class="text-dark font-weight-bold">
          <img src="<?=base_url('assets/lms/')?>img/Logo -unboxskills.png" alt="Logo unboxskills" width="70px">
        </a>
      </div>
    </div>
    <div class="header_right d-flex align-items-center">
      <div class="menu_right d-flex align-items-center text-center ml-3">
        <div class="ml-3">
          <div class="">
            <!-- <a href="login.php"> -->
              <!-- <i class="fas fa-bell"></i> -->
              <!-- <i class="fas fa-user-circle text-dark f_18"></i> -->
              <div class="bar">
                <div></div>
                <div></div>
                <div></div>
              </div>
            <!-- </a> -->
          </div>
        </div>
        <div class="ml-3" style="position: relative;">
          <!-- <a href="cart.php">
            <div style="position: absolute;left: 15px;top:-8px;height: 14px;width: 14px;font-size: 12px" class="  rounded-circle text-dark bg-white">1</div>
            <div class=" d-flex justify-content-start"><i class="fas fa-shopping-cart text-dark"></i>
            </a> -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- search -->
  <!-- <div class="mobile_search  d-flex justify-content-center py-2">
    <form action="search.php">
      <div class="d-flex align-items-center">
        <input type="search" name="" placeholder="Search..." style="border-radius:30px 0 0 30px;">
        <button class="d-flex justify-content-center align-items-center px-2 bg-white" style="border-radius:0px 30px 30px 0px;"><img src="img/svg/loupe.svg" width="18px"></button>
      </div>
    </form>
  </div> -->
  <!-- ===mobile- sidebar=== -->
  <div class="mobile_sidebar_layer d-flex">
    <div class="mobile_sidebar bg-white">
      <div class="banner bgg_6">
        <div class="closesidebar">
          <i class="fa fa-times tc_0 cp text-white"></i>
        </div>
        <div class="m_menu p-2 rounded  ">
          <div class="media">
            <img src="<?=base_url('assets/lms/')?>img/profile.jpg" class="mr-3" alt="...">
            <div class="media-body align-self-center">
              <h5 class="mt-0 f_16 font-weight-bold text-white">Xyz</h5>
              <p class="f_13  text-white">Will you do it</p>
            </div>
          </div>
        </div>
      </div>
      
      <div class="m_menu m-1 rounded">
        <ul class="mb-0">
          <li>
            
            <div class="m_menu">
              <div class=""><!-- <img src="images/header3/home.svg" alt="" class="mr-2" width="15px"> --> <a href="<?=base_url()?>" class="text-dark">Home</a></div>
            </div>
            
            
            
          </li>
        </ul>
      </div>
      <div class="m_menu m-1 rounded">
        <ul class="mb-0">
          <li>
            
            <div class="m_menu_link_1">
              <div class=""><!-- <img src="images/header3/fruit-box.svg" alt="" class="mr-2" width="15px"> --> <a href="<?=base_url()?>courses" class="text-dark">Course</a> </div>
              <div><i class="fas fa-chevron-right fa-sm "></i></div>
            </div>
            
            <ul class="m_submenu_1">
              <li>
                <div>
                  <div class=""><!-- <img src="images/header3/fruit-box.svg" alt="" class="mr-2" width="15px"> --> Course</div>
                  <div><!-- <i class="fas fa-chevron-right fa-sm "></i> --></div>
                </div>
              </li>
              <li>
                <div>
                  <div class=""><!-- <img src="images/header3/fruit-box.svg" alt="" class="mr-2" width="15px"> --> Course</div>
                  <div><!-- <i class="fas fa-chevron-right fa-sm "></i> --></div>
                </div>
              </li>
              <li>
                <div>
                  <div class=""><!-- <img src="images/header3/fruit-box.svg" alt="" class="mr-2" width="15px"> --> Course</div>
                  <div><!-- <i class="fas fa-chevron-right fa-sm "></i> --></div>
                </div>
              </li>
              <li>
                <div>
                  <div class=""><!-- <img src="images/header3/fruit-box.svg" alt="" class="mr-2" width="15px"> --> Course</div>
                  <div><!-- <i class="fas fa-chevron-right fa-sm "></i> --></div>
                </div>
              </li>
              <li>
                <div>
                  <div class=""><!-- <img src="images/header3/fruit-box.svg" alt="" class="mr-2" width="15px"> --> Course</div>
                  <div><!-- <i class="fas fa-chevron-right fa-sm "></i> --></div>
                </div>
              </li>
            </ul>
            
          </li>
          <li>
            
            <div class="m_menu_link_2">
              <div class=""><!-- <img src="images/header3/product.svg" alt="" class="mr-2" width="15px"> --> New Course</div>
              <div><i class="fas fa-chevron-right fa-sm "></i></div>
            </div>
            
            <ul class="m_submenu_2">
              <li>
                <div>
                  <div class=""><!-- <img src="images/header3/product.svg" alt="" class="mr-2" width="15px"> --> Course</div>
                  <div><!-- <i class="fas fa-chevron-right fa-sm "></i> --></div>
                </div>
              </li>
              <li>
                <div>
                  <div class=""><!-- <img src="images/header3/product.svg" alt="" class="mr-2" width="15px"> --> Course</div>
                  <div><!-- <i class="fas fa-chevron-right fa-sm "></i> --></div>
                </div>
              </li>
              <li>
                <div>
                  <div class=""><!-- <img src="images/header3/product.svg" alt="" class="mr-2" width="15px"> --> Course</div>
                  <div><!-- <i class="fas fa-chevron-right fa-sm "></i> --></div>
                </div>
              </li>
              <li>
                <div>
                  <div class=""><!-- <img src="images/header3/product.svg" alt="" class="mr-2" width="15px"> --> Course</div>
                  <div><!-- <i class="fas fa-chevron-right fa-sm "></i> --></div>
                </div>
              </li>
              <li>
                <div>
                  <div class=""><!-- <img src="images/header3/product.svg" alt="" class="mr-2" width="15px"> --> Course</div>
                  <div><!-- <i class="fas fa-chevron-right fa-sm "></i> --></div>
                </div>
              </li>
            </ul>
            
          </li>
        </ul>
      </div>
      
      
      <div class="m_content  rounded m-1">
        <ul>
          <li class=""><!-- <img src="images/header3/wallet-2.svg" alt="" class="mr-2" width="15px"> --> About</li>
          <li class=""><!-- <img src="images/header3/sent.svg" alt="" class="mr-2" width="15px"> --><a href="<?=base_url()?>login" class="text-dark">Login</a></li>
          <li class=""><!-- <img src="images/header3/contact.svg" alt="" class="mr-2" width="15px"> -->Contact us</li>
          <li class=""><!-- <img src="images/header3/faq.svg" alt="" class="mr-2" width="15px"> -->Faq</li>
        </ul>
      </div>
      
    </div>
    <div class="sidebar_layer" style=""></div>
  </div>
</header>