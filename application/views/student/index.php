<?php

$table1=$_SESSION['c_table'];
$sid=$_SESSION['auth_unboxskills_student_email'];
$data1=$this->admin->getWhere($table1,['email'=>$sid]);
$name=$data1[0]->name;


?>
<div class="container-fluid page-body-wrapper">
  
  
  <!-- SideBar  -->
  <?php include('sidebar.php'); ?>
  <!-- End of SideBar -->
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-12 grid-margin">
          <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
              <h3 class="font-weight-bold">Welcome <?= $name; ?></h3>
              <!-- <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span class="text-primary">3 unread alerts!</span></h6> -->
            </div>
           
          </div>
        </div>
      </div>
      <div class="row d-non">
        
        <div class="col-md-12 grid-margin transparent">
          <div class="row">
            <div class="col-md-3 col-6 px-1 px-md-2 mb-2 stretch-card transparent" >
              <div class="card bs_1 mb-0">
                <div class="card-body text-center">
                  <i class="fas fa-book-open f_40 rt_20 tc_2"></i>
                  <p class="mt-2 f_18 rt_15">Total Your Course</p>
                  <p class="f_15 rt_15 mb-2">12</p>
                  <!-- <p>10.00% (30 days)</p> -->
                </div>
                
              </div>
            </div>
            <div class="col-md-3 col-6 px-1 px-md-2 mb-2 stretch-card transparent">
              <div class="card bs_1">
                <div class="card-body text-center">
                  <i class="fas fa-clock f_40 rt_20 tc_2"></i>
                  <p class="mt-2 f_18 rt_15">Total Learning</p>
                  <p class="f_15 rt_15">4 Hrs</p>
                  <!-- <p>22.00% (30 days)</p> -->
                </div>
              </div>
            </div>
            
            <div class="col-md-3 col-6 px-1 px-md-2 mb-2 stretch-card transparent">
              <div class="card bs_1">
                <div class="card-body text-center">
                  <i class="fas fa-check-circle f_40 rt_20 tc_2"></i>
                  <p class="mt-2 f_18 rt_15">Verified User</p>
                  <p class="f_15 rt_15">Done</p>
                  <!-- <p class="fs-30 mb-2">34040</p> -->
                  <!-- <p>2.00% (30 days)</p> -->
                </div>
              </div>
            </div>
            <div class="col-md-3 col-6 px-1 px-md-2 mb-2 stretch-card transparent">
              <div class="card bs_1">
                <div class="card-body text-center">
                  <i class="fas fa-info-circle f_40 rt_20 tc_2"></i>
                  <p class="mt-2 f_18 rt_15">Help</p>
                  
                  <!-- <p>0.22% (30 days)</p> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <h4 class="f_20 mb-3 fw_600">Recents</h4>
        </div>

<?php

  // $myCourse=$_SESSION['purchased_coures'];

$sid=$_SESSION['auth_login_unboxskills_'.$table];

$myCourse=$this->admin->get_student_course($sid);


 if($myCourse){ foreach ($myCourse as $key ) { 

    $cid=$key['course_id'];
    $sid=$key['student_email'];

    $track=$this->admin->get_course_track($sid,$cid);

  ?>



<?php if(!$track){  ?>
            <div class="col-md-3 col-sm-6 mb-md-3 mb-2  grid-margin stretch-card">
              <div class="course_right bg-white">
                      <a href="<?= $_SESSION['dash_url'].'player'; ?>">
                        <div class="img">
                          <img src="<?=base_url('assets/student/')?>images/course/5e71accf0cf207a30786c3d5_scaled_cover.jpg" alt="" width="100%">
                        </div>
                        <div class="conten_wrapper p-3">
                          <div class="conten_wrapper_box">
                          <div class="subtitle f_13 rt_12 tc_3">
                            Google
                          </div>
                          <div class="title f_20 fw_500 tc_0 pt-1 rt_18">
                            Google Ads Certification
                          </div>

                        </div>
                           <a href="<?= $_SESSION['dash_url'].'player'; ?>" class="btn btn-info text-white p-2 mt-3 bg_9 border-0 p-3">Start Course</a>
                          <p class="mt-3 mb-1 fw_500">Course Progress</p>
                          <div class="progress my-2" style="height: 19px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                          </div>
                        </div>
                      </a>
                    </div>
            </div>
<?php }else { ?>
            <div class="col-md-3 col-sm-6 mb-md-3 mb-2  grid-margin stretch-card">
              <div class="course_right bg-white">
                      <a href="<?= $_SESSION['dash_url'].'player'; ?>">
                        <div class="img">
                          <img src="<?=base_url('assets/student/')?>images/course/5efe18cd0cf2f8f537be1141_scaled_cover.jpg" alt="" width="100%">
                        </div>
                        <div class="conten_wrapper p-3">
                         <div class="conten_wrapper_box"> 
                          <div class="subtitle f_13 rt_12 tc_3">
                            Programming
                          </div>
                          <div class="title f_20 fw_500 tc_0 pt-1 rt_18">
                            Ai with R programming

                          </div>
                         </div>
                           <a href="<?= $_SESSION['dash_url'].'player'; ?>" class="btn  btn-info text-white p-2 mt-3 bg_8 border-0 p-3">Resume Course</a>
                          <p class="mt-3 mb-1 fw_500">Course Progress</p>
                          <div class="progress my-2" style="height: 19px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                          </div>
                        </div>
                      </a>
                    </div>
            </div>
<?php } ?>

<?php } }?>

      </div>

    </div>
  </div>
</div>
<!-- content-wrapper ends -->