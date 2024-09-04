<?php 

$_SESSION['c_table']='student';
$table=$_SESSION['c_table'];
if(isset($_SESSION['auth_login_unboxskills_'.$table])){}else{ header('location:'.base_url('/login')); die();}


$_SESSION['dash_url']=base_url('/').$table.'/';


$sid=$_SESSION['auth_login_unboxskills_'.$table];

$_SESSION['auth_unboxskills_student_email']=$_SESSION['auth_login_unboxskills_'.$table];
$myCourse=$this->admin->get_student_course($sid);

$_SESSION['purchased_coures']=$myCourse;

$ratingStatus=$this->admin->ratingStatus($myCourse[0]['course_id'],$sid);

$totalLec=$this->admin->getTotalLecture($myCourse[0]['course_id']);

$CompleteLec=$this->admin->CompleteLec();


$totalComplPer=$CompleteLec/$totalLec*100;

$CourseData=$this->admin->get_course_data_by_id($myCourse[0]['course_id'],'course_data','slug');

$slug= str_replace(' ', '-', $CourseData[0]['slug']);
// var_dump($CourseData);die();

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

  <link rel="stylesheet" href="<?=base_url('assets/student/')?>vendors/feather/feather.css">
  <link rel="stylesheet" href="<?=base_url('assets/student/')?>vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?=base_url('assets/student/')?>vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?=base_url('assets/student/')?>vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="<?=base_url('assets/student/')?>vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="<?=base_url('assets/student/')?>js/select.dataTables.min.css">
  <link rel="stylesheet" href="<?=base_url('assets/student/')?>css/vertical-layout-light/style.css">

<!-- ==============Course link=== -->

  <link rel="stylesheet" href="<?=base_url('assets/student/')?>css/course.css">
  <link rel="stylesheet" href="<?=base_url('assets/student/')?>css/global.css">
  <link rel="stylesheet" href="<?=base_url('assets/student/')?>css/media.css">



</head>
</body>



  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper pt-1 d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="<?=base_url()?>"><img src="<?=base_url('assets/student/')?>images/Logo -unboxskills.png" alt="Logo unboxskills" style="height: 60px;"></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="<?=base_url('assets/student/')?>images/Logo -unboxskills.png" alt="Logo unboxskills" style="height: 40px;width:40px;" alt="Logo unboxskills"></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end pr-md-4 pr-3">
       
        <?php if($pagename=='player')    { ?>
          <!-- <a href="<?= base_url('/student-dashboard')?>" class="f_14 text-dark"><button class="navbar-toggler navbar-toggler align-self-center" type="button">
         <i class="fas fa-chevron-left f_12 mr-2"></i> <sapn class="f_14">Dashboard</sapn>
        </button></a> -->
        
         <?php } else{    ?>
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
         <?php }  ?>

       
    <ul class="navbar-nav navbar-nav-right">

    <?php if($pagename=='player'){ ?>
          <li class="nav-item nav-profile ml-md-1 ml-0">
            <i class="fas fa-home f_12 rt_14 mr-md-2" data-toggle="modal" data-target="#leaveArating"></i>
            <a class="text-dark text-nowrap d-md-block d-none cp" href="<?= base_url()?>"> Home</a>
          </li>
          <li class="nav-item nav-profile ml-md-1 ml-0">
            <i class="fas fa-th-large f_12 rt_14 mr-md-2" data-toggle="modal" data-target="#leaveArating"></i>
            <a class="text-dark text-nowrap d-md-block d-none cp" href="<?= base_url('/student-dashboard')?>" > Dashboard</a>
          </li>

    <?php if($ratingStatus <= 0 ){ ?>
              <li class="nav-item nav-profile ml-md-1 ml-0 " id="ratingOption">
                <i class="far fa-star f_12 rt_14 mr-md-2" data-toggle="modal" data-target="#leaveArating"></i>
                <span class="text-dark text-nowrap d-md-block d-none cp" class="btn btn-primary" data-toggle="modal" data-target="#leaveArating"> Leave a rating</span>
              </li>
    <?php } ?>

          <li class="nav-item nav-profile ml-md-1 ml-0 dropdown mr-md-2 mr-0">
           <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" data-toggle="dropdown" id="profileDropdown">
          
            <div class="d-flex align-items-center pt-2 pr-2 ">
                <div class="box" style="position:relative;">
                  <div class="chart" data-percent="<?= $totalComplPer ?>" ></div>
                  <h6 style="position: absolute; top:50%; left:50%; transform: translate(-50%,-100%); font-size:10px ">
                    <?= $totalComplPer ?>%</h6>
               </div>
            </div>
            
            <span class="d-md-block d-none f_14 text-dark ">Your Progress <i class="fas fa-chevron-down ml-1 f_12"></i> </span>
           
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <p class="px-3 pt-2">
                <!-- <i class="ti-settings text-primary"></i> --> 
                <?= $CompleteLec ?> of <?= $totalLec ?> Complete.
              </p>
             </div>
            </a>
          </li>

          <li class="nav-item nav-profile dropdown mx-md-2 mr-0">
            <div class="text-dark cp d-flex align-items-center" data-toggle="modal" data-target="#share"> <span class="d-md-block d-none mr-2">Share</span> <i class="fas fa-share cp text-dark"></i></div>
          </li>

<?php } ?>

          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="<?=base_url('assets/student/')?>images/faces/face28.jpg" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="ti-settings text-primary"></i>  
                Settings
              </a>
              <a class="dropdown-item" href="<?=base_url('/student/logout')?>">
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


    <!-- ================popup==rating====================== -->


<!-- Modal -->
<div class="modal fade" id="leaveArating" tabindex="-1" aria-labelledby="leaveArating" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header py-3 border-0">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body py-5">
        <div class="text-center f_25 rt_16 fw_600 tc_5 ratingTxt1">
          How would you rate this course?
        </div>

        <div class="col-md-12 text-center ratingTxt2">
          <img src="<?= base_url('assets/student/')?>/images/checkRight.gif "  width="104px" >
        </div>
        <div class="d-flex align-items-center justify-content-center my-3">
          <i class="far fa-star mr-2 f_30 rt_16 cp courseRateIcon courseRateIcon1 " onmouseover="hoverStar(1)" onmouseout="hoverStar2(1)" onclick="courseRating(1)" ></i>
          <i class="far fa-star mr-2 f_30 rt_16 cp courseRateIcon courseRateIcon2 " onmouseover="hoverStar(2)" onmouseout="hoverStar2(2)" onclick="courseRating(2)" ></i>
          <i class="far fa-star mr-2 f_30 rt_16 cp courseRateIcon courseRateIcon3 " onmouseover="hoverStar(3)" onmouseout="hoverStar2(3)" onclick="courseRating(3)" ></i>
          <i class="far fa-star mr-2 f_30 rt_16 cp courseRateIcon courseRateIcon4 " onmouseover="hoverStar(4)" onmouseout="hoverStar2(4)" onclick="courseRating(4)" ></i>
          <i class="far fa-star mr-2 f_30 rt_16 cp courseRateIcon courseRateIcon5 " onmouseover="hoverStar(5)" onmouseout="hoverStar2(5)" onclick="courseRating(5)" ></i>
        </div>

        <div class="text-center f_25 rt_16 fw_600 tc_5 ratingTxt3"> </div>

      </div>
    </div>
  </div>
</div>


    <!-- =============end============ -->


    <!-- ================popup==share====================== -->


<!-- Modal -->
<div class="modal fade" id="share" tabindex="-1" aria-labelledby="share" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header py-3 border-0 d-flex justify-content-between">
        <div class="f_17 rt_15 fw_700 text-dark">
          Share this course
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body py-5">
        

        <div class="d-flex align-items-center justify-content-center">
          <div class="bor_3 d-flex">
           <input type="text" id="shareLink" name="" class="py-2 px-2 border-0" value="<?=base_url('/')?>course/<?= $slug  ?> " >
           <button class="btn btn-dark px-2 text-white bg_9 rounded-0 border-0 ml-0 copyBtn" 
           onclick="copyShareLink()">Copy</button>
          </div>
        </div>
        
        <div class="d-flex align-items-center justify-content-center my-3">
            <a target="_blank"  href="https://twitter.com/intent/tweet?url=<?=base_url('/')?>course/<?= $slug  ?>
               &text=<?=base_url('/')?>course/ <?= $slug  ?>&hashtags=css,html">  
               <i class="fab fa-twitter mr-2 f_25 bs_1 bor_1 p-2 tc_5 cp rt_16"></i>
            </a>

            <a  target="_blank" href="https://www.facebook.com/login.php?share/share.php?u=<?=base_url('/')?>course/<?= $slug  ?>">
              <i class="fab fa-facebook mr-2 f_25 bs_1 bor_1 p-2 tc_5 cp rt_16"></i>
            </a>

             <a target="_blank"  href="https://www.linkedin.com/shareArticle?mini=true&url=<?=base_url('/')?>course/<?= $slug  ?>&title=<?=base_url('/')?>course/<?= $slug  ?>&source=<?=base_url('/')?>course/<?= $slug  ?>">
              <i class="fas fa-instagram mr-2 f_25 bs_1 bor_1 p-2 tc_5 cp rt_16"></i>
             </a>
        
        </div>
      </div>
    </div>
  </div>
</div>



    <!-- =============end============ -->