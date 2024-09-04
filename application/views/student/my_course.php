

    <div class="container-fluid page-body-wrapper">
      
    
       <!-- SideBar  -->
      <?php include('sidebar.php'); ?>
      <!-- End of SideBar -->

      <!-- partial -->
      <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            
<?php

 @$myCourse=$_SESSION['purchased_coures'];

 if($myCourse){ foreach ($myCourse as $key ) { 

    $cid=$key['course_id'];
    $sid=$key['student_email'];

    $track=$this->admin->get_course_track($sid,$cid);

    $data=$this->admin->get_course_data_by_id($cid,'course_data','course_id','course_img','course_name');

  if(!$track){  ?>

            <div class="col-md-3 col-sm-6 mb-md-3 mb-2  grid-margin stretch-card">
              <div class="course_right bg-white">
                      <a href="<?=base_url('/')?>student/player/<?= $cid  ?>">
                        <div class="img">
                          <img src="<?=base_url('assets/course_data/')?><?= $cid ?>/<?= $data[0]['course_img'] ?>" alt="" width="100%">
                        </div>
                        <div class="conten_wrapper p-3">
                            <div class="conten_wrapper_box">
                            <!-- <div class="subtitle f_13 rt_12 tc_3">
                            Google
                            </div> -->
                                <div class="title f_20 fw_500 tc_0 pt-1 rt_18">
                                <?php $n=$data[0]['course_name']; echo substr($n,0,30).'...'; ?>
                                </div>

                            </div>
                              <a href="<?=base_url('/')?>student/player/<?= $cid  ?>" class="btn btn-info text-white p-2 mt-3 bg_9 border-0 p-3"> Start Learning </a>
                                <p class="mt-3 mb-1 fw_500">Course Progress</p>
                              <div class="progress my-2" style="height: 19px;">
                                 <div class="progress-bar bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                              </div>
                        </div>
                      </a>
                    </div>
            </div>
<?php }else { 

      $ratingStatus=$this->admin->ratingStatus($cid,$sid);
      $totalLec=$this->admin->getTotalLecture($cid);
      $CompleteLec=$this->admin->CompleteLec();
      $totalComplPer=$CompleteLec/$totalLec*100;

  ?>


            <div class="col-md-3 col-sm-6 mb-md-3 mb-2  grid-margin stretch-card">
              <div class="course_right bg-white">
                      <a href="<?= $_SESSION['dash_url'].'player/'.$cid  ?>">
                        <div class="img">
                          <img src="<?=base_url('assets/course_data/')?><?= $cid ?>/<?= $data[0]['course_img'] ?>" alt="" width="100%">
                        </div>
                        <div class="conten_wrapper p-3">
                         <div class="conten_wrapper_box"> 
                          <!-- <div class="subtitle f_13 rt_12 tc_3">
                            Programming
                          </div> -->
                          <div class="title f_20 fw_500 tc_0 pt-1 rt_18">
                             <?php $n=$data[0]['course_name']; echo substr($n,0,30).'...'; ?>
                          </div>
                         </div>
                           <a href="<?= $_SESSION['dash_url'].'player/'.$cid  ?>" class="btn  btn-info text-white p-2 mt-3 bg_8 border-0 p-3">Start Learning </a>
                          <p class="mt-3 mb-1 fw_500">Course Progress</p>
                          <div class="progress my-2" style="height: 19px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: <?= $totalComplPer ?>%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?= $totalComplPer ?>%</div>
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
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->



 