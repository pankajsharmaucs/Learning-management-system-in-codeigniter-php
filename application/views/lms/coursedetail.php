<?php 

    $slug=trim(str_replace('-',' ', $slug));
    $table1='course_data'; 
    $data=$this->admin->get_data_by_slug($table1,$slug );


    $cid=$data[0]['course_id'];
    $join1=$this->admin->get_all_course_data($cid);

    $content=$this->admin->get_course_content($cid);

$total_downloads=$this->admin->get_total_purchased_course_by_cid($cid);

$teacher_id=$data[0]['instructor_id'];



$teacher_data=$this->admin->get_teacher_data_course_id($teacher_id);


$total_course=$this->admin->get_course_by_teacher($teacher_id);

$course_coupon_data=$this->admin->get_course_coupon($cid,$teacher_id);


// session_destroy();

 // var_dump($_SESSION); die();


?>

<main class="">
  <!-- ==========course detail hero============ -->
  <section class="course_hero_section">
    <div class="container-fluid course_hero_content bgi_1 "
     style="background:url('<?=base_url('assets/course_data/')?><?=
         $data[0]['course_id'] ?>/<?= $data[0]['course_bg_img'] ?>');">
      <div class="container px-md-4 mt-xl-0 mt-lg-0 mt-md-0">
        <div class="row">
          <div class="col-md-6 order-md-1 order-2 bg-white my-md-5 mb-3 mt-5  rounded animate__animated animate__fadeInLeft animate__delay-0.5s">
            <div class="d-flex align-items-end h-100">
              <div class="course_hero_left px-md-3 py-2 px-1  py-md-5">
                <div>
                  <h1 class="fw_500 rt_20 text-capitalize f_30 text-dark"><?= $data[0]['course_name'] ?></h1>
                </div>
                
                <div>
                  <p class="f_14 text-secondary rt_15 fw_500 mb-0"><?= $data[0]['overview'] ?> </p>
                </div>

                <div class="my-2">
                   <div>
                      <span class="f_25 rt_16 fw_600 text-success"> &#8377;  <?= $data[0]['offer_price'] ?></span> 
                      <span class="f_15 rt_14 text-dark mx-2"><strike>&#8377; <?= $data[0]['course_price'] ?></strike></span>
                      <span class="text-danger">85% off</span> 
                    </div>
                </div>
                
                <div class="d-xl-flex align-items-center mt-md-3 mb_30 ">
                  <div>
                    <div>
                      <?php 
                            $rating_count=$this->admin->get_course_rating_count($cid);
                            $sum_of_rating=$this->admin->get_course_rating_sum($cid);

                            $ratingSum=$sum_of_rating[0]['rating'];

                            $mode=$ratingSum/2;

                            $modeExpo=explode('.',$mode);

                            $mode1=$modeExpo[0];
                            $mode2=$modeExpo[1];

                           ?>
                      <span class="f_14 px-1"><u><?= $mode ?> Ratings</u></span>
                    </div>
                  </div>
                  <div class="f_14 ml-lg-3 d-flex align-items-center">
                    <i class="fas fa-circle f_5 pr-1"></i> <?= $data[0]['hour'] ?> hours on-demand video 
                  </div>
                  <div class="f_14 ml-lg-3 d-flex align-items-center">
                    <i class="fas fa-circle f_5 pr-1"></i> Online Mentorship
                  </div>
                </div>
                
                <div class="">
                  <div class="button46 py-md-2 py-1 rt_14 cp" data-toggle="modal" data-target="#downloadbrochure">Download Brochure</div>
                  <a href="<?=base_url()?>buyCourse/<?= $cid ?>"><div class="button47 py-md-2 py-1 rt_14">Buy Now</div></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 order-md-2 order-1 pt-5 pt-md-0">
            <div class="course_hero_right d-flex align-items-center d-flex align-items-center
              h-100 justify-content-center">
              <div class="play cp">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="inner_video d-none">
      <video class="d-none d-lg-block header-video" muted autoplay poster="/themes/custom/finra_bootstrap_sass/images/finra-header-logo.png">
        <source src="<?=base_url('assets/lms/')?>img/video/header-video-large.mp4" type="video/mp4">
      </video>
      <video class="d-lg-none header-video" muted autoplay poster="/themes/custom/finra_bootstrap_sass/images/finra-header-logo.png">
        <source src="<?=base_url('assets/lms/')?>img/video/header-video-small.mp4" type="video/mp4">
      </video>
    </div>
  </section>
  <!-- ==========end============= -->
  <!-- ===============cards=============== -->
  <section class="course_card_section my-md-4 my-2">
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-sm-6 mb-2">
          <div class="course_card d-flex justify-content-start align-items-center h-100">
            <div class="media p-3">
              <div class="img bg_6 d-flex align-items-center justify-content-center">
                <i class="far fa-thumbs-up f_25"></i>
              </div>
              <div class="media-body  ml-2">
                <h5 class="my-0 rt_15 f_25"><?=  $total_downloads ?>+</h5>
                <p class="f_15 rt_14">Student Enrolled </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-6 mb-2">
          <div class="course_card d-flex justify-content-start align-items-center h-100">
            <div class="media p-3">
              <div class="img bg_7 d-flex align-items-center justify-content-center">
                <i class="fa fa-star f_25"></i>
              </div>
              <div class="media-body  ml-2">
                <h5 class="my-0 rt_15 f_25"><?=  $mode ?></h5>
                <p class="f_15 rt_14">Ratting </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-6 mb-2">
          <div class="course_card d-flex justify-content-start align-items-center h-100">
            <div class="media p-3">
              <div class="img bg_8 d-flex align-items-center justify-content-center">
                <i class="fas fa-chart-line f_25"></i>
              </div>
              <div class="media-body  ml-2">
                <h5 class="my-0 rt_15 f_25">100%</h5>
                <p class="f_15 rt_14">Skill Growth</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- =================end=========== -->

  <div class="container">
    <div class="row">
      <div class="col-lg-8 order-lg-1 order-2">


<!-- ===============Description=============== -->
        <section class="description_card_section my-md-4 my-2">
          <div class="container bg-white">
            <div class="row  bor_2 rounded">
              <div class="col-12 pb-md-1 pb-1 px-lg-3 px-md-3">
                <h2 class="section_title text-dark f_25 fw_600 pt-2 rt_20 ls_1">What you'll learn</h2>
              </div>
              <div class="row p-3">
                
                 <?php if($join1){ foreach ($join1 as $key) { ?>
                  <div class="description_content col-md-6    ">
                    <h4 class="fw_300 text-dark f_13 rt_12"><?= $key['description'] ?></h4>
                  </div>
                  <?php } }?>

              </div>
            
             
            </div>
          </div>
        </section>
<!-- =================end=========== -->




        <!-- ===============Overview=============== -->
        <section class="description_card_section my-md-4 my-2">
          <div class="container bg-white">
            <div class="row bor_2 rounded">
              <div class="col-md-12 p-md-2 py-2">
                <div class="col-12 pb-md-1 pb-1 px-lg-3 px-md-3 px-0">
                <h2 class="section_title text-dark f_25 fw_600 pt-2 rt_20 ls_1">Course Overview</h2>
              </div>
                <div class="description_content px-md-3 px-2">
                  <p class="fw_300 text-dark f_15 rt_14"><?= $data[0]['description'] ?></p>
                </div>
              </div>
              
            </div>
          </div>
        </section>
        <!-- =================end=========== -->




<!-- ===============Course Content=============== -->
        <section class="lecture_card_section my-md-4 my-2">
          <div class="container bg-white">
            <div class="row">
              
              <div class=" bor_2 col-12 p-3 rounded">
                <div class="row">
                  <div class="col-12 pb-md-1 pb-1">
                    <h2 class="section_title text-dark f_25 fw_600 pt-2 rt_20 ls_1">Course Curriculum</h2>
                  </div>
                  <div class="col-12 col-lg-12 col-md-12">
                   
                    <ul class="accordion1">
                     
                      <?php if($content){ foreach ($content as $key ) { 
                      $course_id=$key['course_id'];
                      $section_id=$key['section_id'];
                      $lecture=$this->admin->get_section_lecture($course_id,$section_id);

                      // var_dump($section_id);


                      //   $min=0;
                      //   $sec=0;
                      // foreach ($lecture as $t ) {
                      //   $time=$t['duration'];
                      //   $time=explode(':', $time);
                      //   $m=$time[0];                     
                      //   $s=$time[1];
                      //   $min=$min+$m;
                      //   $sec=$sec+$s;

                      //   if($sec >= 60){
                      //           $sec1=$sec-60; $min1=$min+1;
                      //           $total=$min1.':'.$sec1;  
                      //         }else{
                      //           $total=$min.':'.$sec;   
                      //         }                                      
                      //    }
                       
 

                       ?>
                       <li>
                        <div class="toggle1 d-flex align-items-center justify-content-between flex-wrap">
                          <div class="col-md-8 col-12 f_13 rt_13 fw_600">
                            <i class="fa fa-plus mr-md-2 mr-1 rt_14"></i>
                            <?= $key['section_name'] ?>
                          </div>
                          <div class="f_13 rt_13 col-md-4 col-12 text-md-right">
                           
                          </div>
                        </div>
                        <div class="inner  pl-md-2 pl-0">
                          
                         <?php  
                   
// ================================================================
                      if($lecture){foreach ($lecture as $lec ) { ?>
  
                      <?php if($lec['content_type'] == 'video' or $lec['content_type'] == 'youtube' 
                        or  $lec['content_type'] == 'vimeo'){  $lec_id=$lec['v_link'];                            
                         ?>
                            <div class="col-md-12 m-1 p-0 d-flex flex-md-nowrap flex-wrap">
                                 <div class="d-flex col-md-10 col-12 align-items-center justify-content-between">
                                      <i class="fas fa-play-circle mr-2 rt_12"></i>
                                      <div  class=" tc_5 f_12 rt_12 col-md-12 d-flex justify-content-between"><?= $lec['lecture_name']; ?>
                                        <?php if($lec['access_type'] == 'free'){ 

                                          $lname=$lec['lecture_name'];
                                        
                                          if( $lec['content_type'] == 'vimeo' ){ ?>
                                              <span class="ml-5 previewBtn"
                                               onclick="var lec_id='<?= $lec_id ?>'; var lname='<?= $lname ?>'; 
                                                      previewLecture(1,lname,lec_id);">Preview</span>
                                         <?php }  else if( $lec['content_type'] == 'youtube' ){ ?>
                                              <span class="ml-5 previewBtn"
                                               onclick="var lec_id='<?= $lec_id ?>'; var lname='<?= $lname ?>'; 
                                                      previewLecture(2,lname,lec_id);">Preview</span>
                                         <?php }  else if( $lec['content_type'] == 'video' ){ ?>
                                              <span class="ml-5 previewBtn"
                                               onclick="var lec_id='<?= $lec_id ?>'; var lname='<?= $lname ?>'; 
                                                      previewLecture(3,lname,lec_id);">Preview</span>
                                         <?php } ?>
                                        
                                        <?php  } ?>
                                      </div>
                                 </div>

                                 <div class="f_14 m-md-2 m-1 rt_12 col-md-2 col-12">
                                  <?= $lec['duration']; ?> min
                                 </div>

                            </div>
                        <?php }  else{ ?>

                            <div class="col-md-12 m-1 p-0 d-flex ">
                                 <div class="d-flex col-md-10 align-items-center justify-content-between">
                                      <i class="far fa-sticky-note mr-2 rt_12"></i>
                                      <div  class=" tc_5 f_12 rt_12 col-md-12 d-flex justify-content-between"><?= $lec['lecture_name']; ?>
                                      <?php if($lec['access_type'] == 'free'){ ?>
                                      <span class="ml-5 previewBtn">Preview</span>
                                      <?php  } ?>
                                      </div>
                                 </div>

                                 <div class="f_14 m-md-2 m-1 rt_12 col-md-2">
                                  <?= $lec['duration']; ?> min
                                 </div>
                            </div>

                        <?php } ?>                          
                            

                         <?php  } } ?>
<!-- ======================================================= -->
                          </div>

                      </li>

                    <?php } } ?>
                    </ul>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </section>
<!-- =================Course end=========== -->


        <!-- ===============description=============== -->
        <section class="description_card_section my-md-4 my-2 d-none">
          <div class="container bg-white">
            <div class="row bor_2 rounded">
              <div class="col-12 pb-md-1 pb-1">
                <h2 class="section_title text-dark f_25 fw_600 pt-2 rt_20 ls_1">Course Feature</h2>
              </div>
             <!--  <div class="col-12 text-center pb-md-1 pb-2">
                <h2 class="section_title f_30 fw_500 pt-2 rt_20 ls_1">Course Feature</h2>
              </div> -->
              <div class="col-md-12 p-md-3 px-lg-2 px-4 py-2 ">
                
                <div class="description_content px-3">
                  <h4 class="fw_300 text-dark f_14 rt_14">Personalised weekly online mentorship sessions</h4>
                  <h4 class="fw_300 text-dark f_14 rt_14">11-month Program</h4>
                  <h4 class="fw_300 text-dark f_14 rt_14">225+ hours of online learning content</h4>
                  <h4 class="fw_300 text-dark f_14 rt_14">Dedicated career support through interview workshops</h4>
                  <h4 class="fw_300 text-dark f_14 rt_14">Access to GL eXcelerate - curated jobs portal with Job opportunities shared by 350+ companies</h4>
                  <h4 class="fw_300 text-dark f_14 rt_14">Individual doubt-solving with expert mentors</h4>
                  <h4 class="fw_300 text-dark f_14 rt_14">17 real-world projects guided by industry experts</h4>
                  <h4 class="fw_300 text-dark f_14 rt_14">Access to GL Confluence - Industry and Peer Networking Events</h4>
                </div>
              </div>            
            </div>
          </div>
        </section>
        <!-- =================end=========== -->

<!-- ===============Training Highlights=============== -->
  <section class="traning_card_section my-md-4 my-2 d-none" >
    <div class="container">
      <div class="row">
        
        <div class="col-md-12">
          <div class="row">
            <div class="col-12 text-center pb-mb-4 pb-1 ">
              <h2 class="section_title text-dark f_25 fw_600 pt-2 rt_20 ls_1">Training Highlights</h2>
            </div>
            <div class="col-md-4 col-6  ">
              <div class="traning_card  d-flex justify-content-center align-items-md-center h-100">
                <div class="p-1 p-md-3 text-center">
                  
                  <img src="<?=base_url('assets/lms/')?>img/course/home.png" alt="">
                  <h5 class="my-0 rt_14 f_16 fw_400 mt-2 text-center fw_600">Learn from home</h5>
                  <p class="f_13 rt_12 fw_300 text-center text-dark">Stay safe and learn Web Development </p>
                  
                </div>
              </div>
            </div>
            <div class="col-md-4 col-6  ">
              <div class="traning_card  d-flex justify-content-center align-items-md-center h-100">
                <div class="p-1 p-md-3 text-center">
                  
                  <img src="<?=base_url('assets/lms/')?>img/course/beginner.png" alt="">
                  <h5 class="my-0 rt_14 f_16 fw_400 mt-2 text-center fw_600">Beginner friendly</h5>
                  <p class="f_13 rt_12 fw_300 text-center text-dark">Anybody can learn here </p>
                  
                </div>
              </div>
            </div>
            <div class="col-md-4 col-6  ">
              <div class="traning_card  d-flex justify-content-center align-items-md-center h-100">
                <div class="p-1 p-md-3 text-center">
                  
                  <img src="<?=base_url('assets/lms/')?>img/course/video.png" alt="">
                  <h5 class="my-0 rt_14 f_16 fw_400 mt-2 text-center fw_600">Video Tutorials</h5>
                  <p class="f_13 rt_12 fw_300 text-center text-dark">Learn complete Web Development </p>
                  
                </div>
              </div>
            </div>
            <div class="col-md-4 col-6  ">
              <div class="traning_card  d-flex justify-content-center align-items-md-center h-100">
                <div class="p-1 p-md-3 text-center">
                  
                  <img src="<?=base_url('assets/lms/')?>img/course/downloadable_contents.png" alt="">
                  <h5 class="my-0 rt_14 f_16 fw_400 mt-2 text-center fw_600">Downloadable content</h5>
                  <p class="f_13 rt_12 fw_300 text-center text-dark">Get lifetime access </p>
                  
                </div>
              </div>
            </div>
            <div class="col-md-4 col-6  ">
              <div class="traning_card  d-flex justify-content-center align-items-md-center h-100">
                <div class="p-1 p-md-3 text-center">
                  
                  <img src="<?=base_url('assets/lms/')?>img/course/placement.png" alt="">
                  <h5 class="my-0 rt_14 f_16 fw_400 mt-2 text-center fw_600">Placement assistance</h5>
                  <p class="f_13 rt_12 fw_300 text-center text-dark">For brighter future </p>
                  
                </div>
              </div>
            </div>
            <div class="col-md-4 col-6  ">
              <div class="traning_card  d-flex justify-content-center align-items-md-center h-100">
                <div class="p-1 p-md-3 text-center">
                  
                  <img src="<?=base_url('assets/lms/')?>img/course/certificate.png" alt="">
                  <h5 class="my-0 rt_14 f_16 fw_400 mt-2 text-center fw_600">Training Certificate</h5>
                  <p class="f_13 rt_12 fw_300 text-center text-dark">of practical training </p>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </section>
  <!-- =================end=========== -->

<!-- ===============certificate=============== -->
  <section class="certificate_card_section my-md-4 my-2 bor_2 ">
    <div class="container">
      <div class="row">
        <div class="col-12 text-left pb-mb-4 pb-1">
          <h2 class="section_title text-dark  f_25 fw_600 pt-2 rt_20 ls_1">Demo Certificate</h2>
        </div>

        <div class="col-md-8 mx-auto col-12">
          <div class="certificate_card  d-flex justify-content-center align-items-center h-100">
            <div class="p-md-3 p-1 text-center">
              
              
              <!-- <h5 class="my-0 rt_16 f_18 fw_600 mb-2 text-center text-dark">Web Development Certificate</h5> -->
              <img src="<?=base_url('assets/course_data/')?><?=
         $data[0]['course_id'] ?>/<?= $data[0]['demo_cert_img'] ?>" class="certi" alt="">
              
            </div>
          </div>
        </div>
        
        <div class="col-md-4 col-12  ">
          <div class="certificate_card  d-flex justify-content-center align-items-center h-100">
            <div class="p-3 text-center">
              
              <img src="<?=base_url('assets/lms/')?>img/course/certificate.png" class="icon" alt="">
              <h5 class="my-0 rt_14 f_18 fw_500 mt-2 text-center">Download Your Certificates</h5>
              <p class="f_14 rt_12 fw_300 text-center">After completing course you will get an training certificate  </p>
              <button class="button46 border-0" onclick="alert2();">Preview</button>
              
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </section>
  <!-- =================end=========== -->



<?php  ?>



        <!-- ===============mentor=============== -->
        <section class="mentor_card_section my-md-4 my-2">
          <div class="container">
            <div class="row bor_2">
              <div class="col-12 pb-md-1 pb-1">
                <h2 class="section_title text-dark f_25 fw_600 pt-2 rt_20 ls_1">Who will be your Mentor?</h2>
              </div>
              <div class=" col-12 px-3 rounded">
                <div class="row">
                  <div class="col-md-12 col-12 p-3 mb-md-1 mb-2">
                    <div class="mentor_content">
                      <div class="">
                        <h5 class="mt-0 f_17 tc_5 fw_700"> <u><?= $teacher_data[0]['name'] ?></u></h5>
                        <h5 class="mt-0 f_15 fw_300 text-secondary"><?= $teacher_data[0]['profile'] ?></h5>
                      </div>
                      <div class="media">
                        <div class="img">
                          <img src="<?=base_url('assets/lms/')?>img/course/inst.jpg" alt="" class="mr-3">
                        </div>
                        <div class="media-body ml-3">
                          <!-- <h6 class="f_13 fw_300"><i class="fa fa-star mr-1"></i> 4.7 Instructor Ratings</h6> -->
                          <!-- <h6 class="f_13 fw_300"><i class="fas fa-award mr-2"></i> <?=  $total_downloads ?> Rating</h6> -->
                          <h6 class="f_13 fw_300"><i class="fas fa-user-friends mr-1"></i> 
                            <?=  $total_downloads ?> Students</h6>
                          <h6 class="f_13 fw_300"><i class="fas fa-play-circle mr-1"></i> 
                            <?= $total_course ?> Courses</h6>
                        </div>
                        
                      </div>
                      
                      <div>
                        <p class="f_14 fw_300 mt-1"><?= $teacher_data[0]['detail'] ?></p>
                      </div>
                    </div>
                    
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- =================end=========== -->
        <!-- ===============faq=============== -->
        <section class="faq_card_section my-md-4 my-2 d-none">
          <div class="container">
            <div class="row">
              
              <div class="bor_2 col-12 p-md-3 p-2 rounded">
                <div class="col-12 pb-md-1 pb-1">
                  <h2 class="section_title text-dark f_25 fw_600 pt-2 rt_20 ls_1">Course FAQs</h2>
                </div>
                <div class="faq_content px-2 px-2">
                  <h4 class="fw_400 text-dark f_15 rt_14">What is the validity of the course?</h4>
                  <h5 class="fw_300 f_15 rt_14">This course comes with lifetime validity.</h5>
                  <h4 class="fw_400 text-dark f_15 rt_14">11-month Program</h4>
                  <h5 class="fw_300 f_15 rt_14">This course comes with lifetime validity.</h5>
                  <h4 class="fw_400 text-dark f_15 rt_14">225+ hours of online learning content</h4>
                  <h5 class="fw_300 f_15 rt_14">This course comes with lifetime validity.</h5>
                  <h4 class="fw_400 text-dark f_15 rt_14">Dedicated career support through interview workshops</h4>
                  <h5 class="fw_300 f_15 rt_14">This course comes with lifetime validity.</h5>
                  <h4 class="fw_400 text-dark f_15 rt_14">Access to GL eXcelerate - curated jobs portal with Job opportunities shared by 350+ companies</h4>
                  <h5 class="fw_300 f_15 rt_14">This course comes with lifetime validity.</h5>
                  <h4 class="fw_400 text-dark f_15 rt_14">Individual doubt-solving with expert mentors</h4>
                  <h5 class="fw_300 f_15 rt_14">This course comes with lifetime validity.</h5>
                  <h4 class="fw_400 text-dark f_15 rt_14">17 real-world projects guided by industry experts</h4>
                  <h5 class="fw_300 f_15 rt_14">This course comes with lifetime validity.</h5>
                  <h4 class="fw_400 text-dark f_15 rt_14">Access to GL Confluence - Industry and Peer Networking Events</h4>
                  <h5 class="fw_300 f_15 rt_14">This course comes with lifetime validity.</h5>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- =================end=========== -->
      </div>


      <div class="col-lg-4 mt-4 order-lg-2 order-1 sidebarcoursedetailsmain">
        <div class="sidebarcoursedetails bg-white bs_1 p-3 f_15">
         <?php if( $_SESSION['coupon_course_price'] ) { ?>
          <div>
          <span class="f_25 rt_16 fw_600 discount_price"> &#8377;  <?= $_SESSION['coupon_course_price'] ?></span> 
          <span class="f_15 rt_14 text-dark mx-2"><strike>&#8377; <?= $data[0]['course_price'] ?></strike></span>
          </div>
        <?php } else{ ?>
          <div>
          <span class="f_25 rt_16 fw_600 discount_price"> &#8377;  <?= $data[0]['offer_price'] ?></span> 
          <span class="f_15 rt_14 text-dark mx-2"><strike>&#8377; <?= $data[0]['course_price'] ?></strike></span>
          </div>
        <?php } ?>

          <div class="f_15 text-danger">
           <i class="far fa-clock"></i> 10 day left at this price!
          </div>
          <div class="my-2">
            <a href="<?=base_url()?>buyCourse/<?= $cid ?>"><button class="button46 border-0 w-100">Buy Now</button></a>
          </div>
          <div class="f_16 fw_700 rt_15 py-2">This course includes:</div>
          <div class="d-flex align-items-start justify-content-start">
            <div class="icons">
              <div class="my-1"><img src="<?=base_url('assets/lms/')?>img/play-button.png" width="15px"></div>
              <div class="my-1"><img src="<?=base_url('assets/lms/')?>img/blank-page.png" width="15px"></div>
              <div class="my-1"><img src="<?=base_url('assets/lms/')?>img/down-arrow.png" width="15px"></div>
              <div class="my-1"><img src="<?=base_url('assets/lms/')?>img/infinity.png" width="15px"></div>
              <div class="my-1"><img src="<?=base_url('assets/lms/')?>img/smartphone.png" width="15px"></div>
              <div class="my-1"><img src="<?=base_url('assets/lms/')?>img/trophy.png" width="15px"></div>
            </div>
            <div class="iconscontent">
              <div class="f_14 my-1"><?= $data[0]['hour'] ?> hours on-demand video</div>
              <div class="f_14 my-1"><?= $data[0]['total_article'] ?> articles</div>
              <div class="f_14 my-1"><?= $data[0]['down_resource'] ?>  downloadable resources</div>
              <div class="f_14 my-1">Full lifetime access</div>
              <div class="f_14 my-1">Access on mobile and TV</div>
              <div class="f_14 my-1">Certificate of completion</div>
            </div>
          </div>

          <div class="coupon f_14 fw_700 pl-md-4 mt-2 cp">
              <u>Apply Coupon</u>
          </div>

          <div class="mt-2 couponinput">
              <div class="d-flex align-items-center justify-content-center">
                <input type="text" id="couponCode" class="p-2 w-100">
                <input type="hidden" id="coupon_course_id" value="<?= $cid ?>">
                <input type="hidden" id="coupon_teacher_id" value="<?= $teacher_id ?>">
                <input type="hidden" id="coupon_offer_price" value="<?= $data[0]['offer_price'] ?>">
                <input type="hidden" id="coupon_discount" value="<?= $course_coupon_data[0]['discount'] ?>">
                <button class="p-2 bg_9 text-white " onclick="applyCoupon();" > Apply </button>
              </div>
              <p class="font-weight-bold my-2 text-danger couponErrorBox"></p>
          </div>
          
        </div>
    </div>
  </main>


  <!-- ==================download brochure=popup= =============== -->

<!-- Modal -->
<div class="modal fade" id="downloadbrochure" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw_600 f_18 rt_15" id="exampleModalLabel">Download Brochure</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-8">
            <!-- <div class="f_18 rt_16">
              Please Enter Your Email Address
            </div> -->
            <div class="popupleft d-flex align-items-center h-100">
              <div class="mt-2">
              <div class="d-flex align-items-center justify-content-center" style="height: 35px;overflow: hidden;">
                <input type="text" name="" class="p-1 f_14 w-100" placeholder="Please Enter Your Email Address" style="height: 35px;overflow: hidden;">
                <button class="p-1 bg_9 text-white border-0 px-3" style="height: 35px;">Send</button>
              </div>
              </div>
            </div>
            <div></div>
            <div></div>
          </div>
          <div class="col-md-4">
            <img src="<?=base_url('assets/lms/img/')?>emailpoup.png" class="w-100" alt="emai-popup">
          </div>
        </div>
      </div>
     <!--  <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>





<div class="videoBox" >
  <div class="in1" style=" ">
    <div class="abs1" onclick="$('.videoBox').hide(); $('#vidoePlayer1').attr('src','');" ></div>
      <div class="col-md-6 col-12 abs2 "    >
         <div class="col-md-12 vid2 animate__animated animate__bounceInUp" >
            <h4 class="lectName font-weight-bold text-center col-md-12 text-white">Course Introduction</h4>
            <iframe  id="vidoePlayer1" class="vidoePlayer1 vidoePlayer" src="" width="100%" height="300px"
            webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
        </div>
    </div>
  </div>
</div>




<div class="videoBox2" >
  <div class="in1" style=" ">
    <div class="abs1" onclick="$('.videoBox').hide(); $('#vidoePlayer1').attr('src','');" ></div>
      <div class="col-md-6 col-12 abs2 "    >
         <div class="col-md-12 vid2 animate__animated animate__bounceInUp" >
            <h4 class="lectName font-weight-bold text-center col-md-12 text-white">Course Introduction</h4>
            <iframe  id="vidoePlayer1" class="vidoePlayer1 vidoePlayer" src="" width="100%" height="300px"
            webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
        </div>
    </div>
  </div>
</div>




<script>
  


function previewLecture(type,lname,vid_id){
      
          $('iframe').attr('src','');
          $('.lectName').html(lname);

          if(type == 1 )
          {
              $('.videoBox').show();
              $('.videoBox2').hide();

              $('#vidoePlayer1').show();
              var src='https://player.vimeo.com/video/'+vid_id;
              $('#vidoePlayer1').attr('src',src);
              return;
          }
          else if(type == 2 )
          {
              $('.videoBox').show();
              $('.videoBox2').hide();

              $('#vidoePlayer1').show();
              var src='https://www.youtube.com/embed/'+vid_id;
              $('#vidoePlayer1').attr('src',src);
              return;
          }
          else if(type == 3 )
          {
              $('.videoBox').show();
              $('.videoBox2').hide();

              $('#vidoePlayer1').show();
              $('#vidoePlayer1').attr('src',vid_id);
              return;
          }


}




</script>

  <!-- ================end================== -->