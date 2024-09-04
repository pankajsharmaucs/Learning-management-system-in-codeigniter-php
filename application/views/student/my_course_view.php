<?php 

$cid=$course_id;
$sid=$_SESSION['auth_unboxskills_student_email'];

$data=$this->admin->course_purchased_status($cid,$sid);

if($data){}else{ header('location:'.base_url('/')); }

$content=$this->admin->get_course_content($cid);

$course_id=$content[0]['course_id'];
$section_id=$content[0]['section_id'];
$lecture=$this->admin->get_section_lecture($course_id,$section_id);

if($lecture[0]['content_type']=='youtube'){ $src='https://www.youtube.com/embed/'.$lecture[0]['v_link'];}


$_SESSION['c_course_id']=$course_id;
$join1=$this->admin->get_all_course_data2($cid,$tid);


$allNotes=$this->admin->get_all_notes_course($cid,$sid);

$tid=$join1[0]['instructor_id'];
$_SESSION['c_instructor_id']=$tid;

$allAnounce=$this->admin->get_all_anounce($cid,$tid);



// var_dump($data); die();

?>

<input type="hidden" id="currentTopic" value="<?= $lecture[0]['lecture_name']; ?>">
<input type="hidden" id="cid" value="<?= $cid?>">
<input type="hidden" id="sid" value="<?= $sid ?>">

<div class="container-fluid page-body-wrapper">
  
  
  <!-- partial -->
  <div class="col-12 px-3 py-1">
    <div class="container-fluid ">
      
      <div class="row">
        <!-- <div class="col-12">
          <h1 class="pb-2 f_25 rt_18 fw_600">Google Ads Certification</h1>
        </div> -->

          <div class="col-lg-12 col-12 py-2 mb-2 " style="margin-top:15px">
                <h2 class="f_20 rt_15 fw_400 text-dark font-weight-bold">
                 Lecture:  <span class="text-primary currentTopic"><?= $lecture[0]['lecture_name']; ?></span> 
                </h2>
          </div>
        
        <div class="col-lg-9 mycourseplayer">

          <div class="row">
                       
            <div class="col-lg-12 col-12 mb-0 px-2 grid-margin stretch-card" style="overflow: hidden;position: relative;">
              
              <div class="video w-100 py-2 bg-dark  videoPlayerBox">
                <iframe width="100%" height="500px" id="video_1" src="<?= $src ?>" title=" video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                   <div class="videoPlayerLoader" style="">
                    <img src="<?= base_url('assets/student/')?>images/videoPlayerLoader.gif">
                   </div>
              </div>

              <div class="video_payer_box d-none">
                
                <div class="course_hero_right d-flex align-items-center d-flex align-items-center
                  h-100 justify-content-center">
                  <div class="play bg-white cp" id="PlayButton">
                  </div>
                </div>
                
              </div>

              <div class="studentSidebarOpen m-2 ">
                <div class="d-md-block d-none">
                 <div class="d-flex studentSidebarOpenbtn cp">
                   <img src="<?=base_url('assets/student/')?>images/left-arrow.png" alt="" class="" style="width: 25px">
                  <span class="ml-2 font-weight-bold">Course Content</span>
                 </div>
                </div>
                </div>
            </div>

            
            <div class="col-lg-12 col-sm-12 mb-md-3 mb-2 pl-3  grid-margin order-2 d-none">
              <div class="rt_15 f_20 mb-1 fw_600">Related Course</div>
              <div class="course_right bg-white mb-2 bor_1 ">
                <a href="#" class="d-flex justify-content-start align-items-start">
                  <div class="img">
                    <img src="<?=base_url('assets/student/')?>images/course/5e71accf0cf207a30786c3d5_scaled_cover.jpg" alt="" width="120px">
                  </div>
                  <div class=" p-2">
                    <div class="">
                      <div class="subtitle f_12 rt_12 tc_3">
                        Google
                      </div>
                      <div class="title f_15 text-dark fw_500 tc_0 pt-1 rt_15">
                        Google Ads Certification
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              <div class="course_right bg-white mb-2 bor_1 ">
                <a href="#" class="d-flex justify-content-start align-items-start">
                  <div class="img">
                    <img src="<?=base_url('assets/student/')?>images/course/5efe18cd0cf2f8f537be1141_scaled_cover.jpg" alt="" width="120px">
                  </div>
                  <div class=" p-2">
                    <div class="">
                      <div class="subtitle f_12 rt_12 tc_3">
                        Programming
                      </div>
                      <div class="title f_15 text-dark fw_500 tc_0 pt-1 rt_15">
                        Ai with R programming
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              <div class="course_right bg-white mb-2 bor_1 ">
                <a href="#" class="d-flex justify-content-start align-items-start">
                  <div class="img">
                    <img src="<?=base_url('assets/student/')?>images/course/5ffed1eb0cf263d2689e513f_scaled_cover.jpg" alt="" width="120px">
                  </div>
                  <div class=" p-2">
                    <div class="">
                      <div class="subtitle f_12 rt_12 tc_3">
                        Android
                      </div>
                      <div class="title f_15 text-dark fw_500 tc_0 pt-1 rt_15">
                        Devloper
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              
            </div>
            
            <div class="col-lg-12 col-12 py-2 order-1 mb-2 border-bottom d-none">
              <h2 class="f_20 rt_15 fw_400 text-dark">Introduction to e-mail marketing part-1 (in hindi)</h2>
            </div>

            <div class="col-lg-12 col-12 py-2 px-0 px-md-2 order-1 mb-2 student_video_overview">
              <ul class="nav nav-pills border-0 mb-2" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link active rt_14 px-2" id="pills-Overview-tab" data-toggle="pill" href="#pills-Overview" role="tab" aria-controls="pills-Overview" aria-selected="true">Overview</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link rt_14 px-2" id="pills-Notes-tab" data-toggle="pill" href="#pills-Notes" role="tab" aria-controls="pills-Notes" aria-selected="false">Notes</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link rt_14 px-2" id="pills-Announcements-tab" data-toggle="pill" href="#pills-Announcements" role="tab" aria-controls="pills-Announcements" aria-selected="false">Announcements</a>
                </li>
              </ul>
              <div class="tab-content pt-1 border-0" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-Overview" role="tabpanel" aria-labelledby="pills-Overview-tab">
                  <div class="border-bottom">
                    <h4 class="fw_700 f_20">About this course</h4>
                    <p class="f_14 py-1"><?=  $join1[0]['overview']; ?></p>
                  </div>
                 <!--  <div class="row p-md-3 py-2  d-flex justify-content-start align-items-center f_14">
                    <div class="col-md-4 my-md-0 my-2 align-self-start">By the numbers</div>
                    <div class="col-md-4 my-md-0 my-2">
                      Skill level: All Levels
                      Students: 18695
                      Languages: English
                      Captions: Yes
                    </div>
                    <div class="col-md-4 my-md-0 my-2">
                      Lectures: 11
                      Video: 2.5 total hours
                    </div>
                  </div> -->
                  <div class=" description">
                    
                    <div class="row p-md-3 py-2  d-flex justify-content-start align-items-center f_14">
                      <div class="col-md-4 my-md-0 my-2 align-self-start">Description</div>
                      <div class="col-md-8 my-md-0 my-2">
                        <?=  $join1[0]['description']; ?>
                      </div>
                      
                    </div>
                    <div class="border-top">
                      <div class="row p-md-3 py-2  d-flex justify-content-start align-items-center f_14">
                        <div class="col-md-4 my-md-0 my-2 align-self-start">Instructor</div>
                        <div class="col-md-8 my-md-0 my-2">
                          <div>
                            <div class="media">
                              <img src="<?=base_url('assets/student/')?>images/course/inst.jpg" width="60px" height="60px" class="mr-3 rounded-circle" alt="...">
                              <div class="media-body">
                                <h5 class="mt-0 fw_700 f_18 my-1"><?= $join1[0]['name']; ?></h5>
                                <p><?php 
                                  $pro=$join1[0]['profile']; 
                                  $pro=explode(',', $pro);
                                    $i=1;
                                       foreach ($pro as $key ) {
                                          if($i == 1){ echo $key; }
                                          else{ echo " | ".$key;}
                                       $i++;}
                                   ?></p>
                              </div>
                            </div>
                            <p class="mt-3" style="text-align:justify;text-justify:none;">
                              <?= $join1[0]['profile_detail']; ?>
                            </p>
                          </div>
                          <div class="desctiption_social d-flex mt-3">
                            <div class="mr-3 bg-secondary text-white p-1 cp">
                              <a href="<?= $join1[0]['fb_link']; ?>"><i class="fab fa-facebook f_18 p-1"></i></a>
                              </div>
                            <div class="mr-3 bg-secondary text-white p-1 cp">
                               <a href="<?= $join1[0]['linkedin_link']; ?>">
                                <i class="fab fa-linkedin f_18 p-1"></i></a>
                              </div>
                            <div class="mr-3 bg-secondary text-white p-1 cp">
                               <a href="<?= $join1[0]['yt_link']; ?>">
                                <i class="fab fa-youtube f_18 p-1" ></i>
                              </a>
                              </div>
                          </div>
                          
                        </div>
                        
                      </div>
                    </div>
                    <!-- <div class="border-bottom"></div> -->
                  </div>
                  <!-- -hide show btn== -->
              <div class="show_more cp pl-md-3 f_14 tc_5 fw_700" id="studentShowmore">Show <span class="showmore">more</span> 
                <i class="fas fa-chevron-down ml-1 f_12"></i></div>
              </div>

                <div class="tab-pane fade" id="pills-Notes" role="tabpanel" aria-labelledby="pills-Notes-tab">
                 <h4 class="fw_700 f_20 my-4">Create Notes</h4>
                  <textarea cols="" class="w-100 p-3" id="MyNotes" placeholder="Write Notes here..." rows="4"></textarea>

                  <div class="mt-2">
                    <button class="btn btn-dark rounded-0 px-3 py-2" onclick="createNotes();">Save note</button>
                     <span  class="text-danger ml-3 noteErrorBox"></span> 
                  </div>
                  <div class="">
                    <h4 class="fw_700 f_20 my-4">My Notes List </h4>
                     <div class="">      
                      <?php if($allNotes){ foreach ($allNotes as $key ) { ?>
                        <div class="border p-2 my-2">
                         <div class="d-flex justify-content-between">
                          <div>
                            <div class="rounded btn btn-primary p-1 px-2">Topic: <span><?= $key['topic'] ?></span></div>
                            <div class="rounded btn btn-light p-1 px-2"><?= $key['create_date'] ?></div>
                            </div>
                           </div>
                            <p class="f_14 py-1"><?= $key['note'] ?></p>
                          </div>
                        <?php } } ?>
                      <div class="noteBox"></div>
                   </div>
                </div>
            </div>

      <div class="tab-pane fade" id="pills-Announcements" role="tabpanel" aria-labelledby="pills-Announcements-tab">
                  
                <div class=" mb-3">
                  <div class="media">
                    <img src="<?=base_url('assets/teacher/')?>profile/<?= $join1[0]['profile_img'] ?>" width="60px" height="60px" class="mr-3 rounded-circle" alt="...">
                    <div class="media-body">
                      <h5 class="mt-0 fw_700 f_18 my-1"><?= $join1[0]['name']; ?></h5>
                      <p>posted an announcement ·  <?= $allAnounce[0]['post_date']; ?></p>
                    </div>
                  </div>
                  <div class="my-2">
                    <img src="<?=base_url('assets/course_data/')?><?= $allAnounce[0]['course_id']; ?>/announcement/<?= $allAnounce[0]['post_image']; ?> ?>" class="w-100">
                  </div>
                  <p class="mt-3" style="text-align:justify;text-justify:none;">
                    <?= $allAnounce[0]['content']; ?>
                  </p>
              </div>


<div class="announcementsdescription">
<?php if($allAnounce){   $sno=1; foreach ($allAnounce as $key ) { ?>
  <?php    if($sno > 1){   ?>
                   <div class=" mb-3">
                      <div class="media">
                    <img src="<?=base_url('assets/teacher/')?>profile/<?= $join1[0]['profile_img'] ?>" width="60px" height="60px" class="mr-3 rounded-circle" alt="...">
                    <div class="media-body">
                      <h5 class="mt-0 fw_700 f_18 my-1"><?= $join1[0]['name']; ?></h5>
                      <p>posted an announcement ·  <?= $key['post_date']; ?></p>
                    </div>
                  </div>
                      <div class="my-2">
                        <img src="<?=base_url('assets/course_data/')?><?= $key['course_id'] ?>/announcement/<?= $key['post_image'] ?> ?>" class="w-100">
                      </div>
                      <p class="mt-3" style="text-align:justify;text-justify:none;">
                        <?= $key['content'] ?>
                      </p>
                    </div>              
<?php } ?>
<?php $sno++; } } ?>

</div>


                  <div class="show_more cp pl-md-3 f_14 tc_5 fw_700" id="studentAnnouncShowmore">Show <span class="showmore">more</span> <i class="fas fa-chevron-down ml-1 f_12"></i></div>
                </div>
              </div>
            </div>
          </div>
        </div>

<!-- ============sidebar=========== -->
<div class="col-3 scroller pl-md-0 playsidebarbox " style="">
  <?php include('playersidebar.php'); ?>
</div>
        
        
        
        
      </div>
    </div>
  </div>
</div>
</div>
<!-- main-panel ends -->
<!-- SideBar  -->
<!-- End of SideBar -->
</div>
<!-- page-body-wrapper ends -->
<!-- container-scroller -->


