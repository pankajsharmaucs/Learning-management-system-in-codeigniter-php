<?php 

$popular_course=$this->admin->get_popular_course();


// var_dump($popular_course); die();
 ?>

<!-- ==========hero============ -->
<section class="hero_section">

 <div class="container-fluid hero_content">
   <div class="container px-md-4 mt-xl-0 mt-lg-0 mt-md-0 mt-4">
  <div class="row">
    <div class="col-md-6 d-flex align-items-center order-md-1 order-2">
      <div class="hero_left animate__animated animate__fadeInLeft animate__delay-0.5s">
        <div class="f_15 tc_2 font_type">Learn With</div>
        <div><h1 class="font-weight-bold rt_24 text-capitalize">India's most trusted education platform</h1></div>
        <div><p class="f_16 text-secondary rt_15">Power ahead in your career with certified online courses and degrees from world-class universities. </p></div>
        <div class="f_25 pb-3 tc_1 font-weight-bold rt_16">1200+ Hiring Partners</div>
        <div class="button46 py-2 rt_15">
          Start Now
        </div>
      </div>
    </div>
    <div class="col-md-6 order-md-2 order-1">
      <div class="hero_right d-flex  align-items-center  animate__animated  animate__fadeInRight">
        <img src="<?=base_url('assets/')?>lms/img/heroimage/hero_image1.png" alt="landing" class="w-100  heroImg heroImg1">
      </div>

       <script>

          var id=2;
          var src1='<?=base_url('assets/')?>lms/img/heroimage/';

                setInterval(function(){ 
                   
                     $('.hero_right').addClass('animate__fadeOut');
                     $('.hero_right').removeClass('animate__fadeInRight');

                     setTimeout(function(){
                           $('.hero_right').removeClass('animate__fadeOut');
                           $('.hero_right').addClass('animate__fadeInRight');

                            $('.hero_right img').attr('src',src1+'hero_image'+id+'.png');
                            $('.hero_right img').attr('alt','hero_image');
                            id++;

                    }, 1000);
                  
                     if(id >= 5){ id=1; }              

               }, 4000);




        </script>


    </div>
  </div>
</div>
 </div>
<div class="inner_video d-none">
   <video class="d-none d-lg-block header-video" muted autoplay poster="/themes/custom/finra_bootstrap_sass/images/finra-header-logo.png">
          <source src="<?=base_url('assets/')?>lms/img/video/header-video-large.mp4" type="video/mp4">
        </video>

        <video class="d-lg-none header-video" muted autoplay poster="/themes/custom/finra_bootstrap_sass/images/finra-header-logo.png">
          <source src="<?=base_url('assets/')?>lms/img/video/header-video-small.mp4" type="video/mp4">
        </video>
 </div>
</section>
<!-- ==========end============= -->

<!-- ================Cards=========== -->
<section class="cards_section">
  <div class="container px-md-4 mt-xl-1 mt-lg-1 mt-md-1 mt-4">
  <div class="row">
    <div class="col-12 text-center">
      <h2 class="section_title f_30 fw_500 rt_24 py-4"> Popular Courses </h2>
    </div>


    <?php 

if($popular_course){
foreach ($popular_course as $key ) {
    $table='course_data';
    $cid=$key['course_id'];    
    $data=$this->admin->get_data_by_id($table,['cid'=>$cid]);

    $slug=$data[0]['slug'];
    $slug=str_replace(' ','-', $slug);



?>
    <div class="col-lg-3 col-md-4 col-6 px-xl-3 px-1 mb-3">
      
                 <div class="course_right border">
                      <a href="course/<?= $slug ?>">
                        <div class="img">
                          <img src="<?=base_url('assets/course_data/')?><?= $cid ?>/<?= $data[0]['course_img'] ?>" alt="" width="100%">
                        </div>
                        <div class="conten_wrapper p-3">
                          <!-- <div class="subtitle f_13 rt_12 tc_3">
                            Microsoft Office
                          </div> -->
                          <div class="title f_20 fw_500 tc_0 pt-1 rt_18">
                            <?php $n=$data[0]['course_name']; 
                            if( strlen($n) > 30 ){$n2=substr($n,0,35); echo $n2.'...';}
                            else { $n2=substr($n,0,35); echo $n2;}

                            ?>

                          </div>
                          <div>
                             <span class="">
                          <?php  
                              $star=$n=$data[0]['total_star'];
                              $star=explode('.', $star);
                              $star1=$star[0];
                              $star2=$star[1];
                              for($sr=0; $sr < $star1; $sr++ ){ ?>
                                <i class="fa fa-star f_10 tc_4"></i>
                              <?php } ?>

                              <?php if($star2){ ?>
                                <i class="fas fa-star-half-alt f_10 tc_4"></i>
                              <?php } ?>


                              <span class="f_10 px-1 text-secondary"><?= $data[0]['total_rating'] ?> Ratings</span>
                            </span>
                          </div>
                          <div class="duration pt-1 pb-2 text-secondary f_14 rt_14">
                                 <?= $data[0]['total_downloads'] ?>  Downloads
                          </div>
                          <div class="location f_14">
                            <strike class="ml-1 f_12 text-secondary">&#8377; <?= $data[0]['course_price'] ?> </strike>
                            <button class="button_1">&#8377; <?= $data[0]['offer_price'] ?> </button>
                          </div>
                        </div>
                      </a>
                  </div>

    </div>

<?php } }?>



  </div>
</div> 
</section>
<!-- ============end======== -->





<!-- ================our traning course=========== -->
<section class="our_traning_section bg_4 ">
  <div class="container px-md-4 mt-xl-1 mt-lg-1 mt-md-1 mt-4">
  <div class="row">
    <div class="col-12 text-center">
      <h2 class="section_title f_30 fw_500 rt_24 py-4 text-white">Category Courses</h2>
    </div>
    <div class="col-md-3 col-6 px-xl-3 px-1">
      <a href="">
      <div class="our_traning_content bgColorBlue mb-xl-4 mb-2 d-flex align-items-center justify-content-center">
        <div class="">
        <div class="img d-flex align-items-center justify-content-center">
        <img src="<?=base_url('assets/')?>lms/img/PHPDevelopment.png" alt="ourtraning" class="img-fluid course_img_1">
        <img src="<?=base_url('assets/')?>lms/img/PHPWebDevelopment01.png" alt="ourtraning" class="img-fluid course_img_2">
        </div>
        <div class="title text-center mt-2 f_16 rt_14">
         PHP Web Development
        </div>
        </div>
      </div>
      </a>
    </div>
    <div class="col-md-3 col-6 px-xl-3 px-1">
      <a href="">
      <div class="our_traning_content bgColorGreen mb-xl-4 mb-2 d-flex align-items-center justify-content-center">
        <div class="">
        <div class="img d-flex align-items-center justify-content-center">
        <img src="<?=base_url('assets/')?>lms/img/AndroidDevelopment.png" alt="android" class="img-fluid course_img_1">
        <img src="<?=base_url('assets/')?>lms/img/AndroidDevelopment01.png" alt="android" class="img-fluid course_img_2">
        </div>
        <div class="title text-center mt-2 f_16 rt_14">
        Android Development
        </div>
        </div>
      </div>
      </a>
    </div>
     <div class="col-md-3 col-6 px-xl-3 px-1">
      <a href="">
      <div class="our_traning_content bgColorBlack mb-xl-4 mb-2 d-flex align-items-center justify-content-center">
        <div class="">
        <div class="img d-flex align-items-center justify-content-center">
        <img src="<?=base_url('assets/')?>lms/img/iPhoneDevelopment.png" alt="iPhone" class="img-fluid course_img_1">
        <img src="<?=base_url('assets/')?>lms/img/iPhoneDevelopment01.png" alt="iPhone" class="img-fluid course_img_2">
        </div>
        <div class="title text-center mt-2 f_16 rt_14">
         iPhone Development
        </div>
        </div>
      </div>
      </a>
    </div>
   <div class="col-md-3 col-6 px-xl-3 px-1">
      <a href="">
      <div class="our_traning_content bgColorYellow mb-xl-4 mb-2 d-flex align-items-center justify-content-center">
        <div class="">
        <div class="img d-flex align-items-center justify-content-center">
        <img src="<?=base_url('assets/')?>lms/img/PythonTraining.png" alt="PythonTraining" class="img-fluid course_img_1">
        <img src="<?=base_url('assets/')?>lms/img/PythonTraining01.png" alt="PythonTraining" class="img-fluid course_img_2">
        </div>
        <div class="title text-center mt-2 f_16 rt_14">
         Python Training
        </div>
        </div>
      </div>
      </a>
    </div>
    <div class="col-md-3 col-6 px-xl-3 px-1">
      <a href="">
      <div class="our_traning_content bgColorOrange mb-xl-4 mb-2 d-flex align-items-center justify-content-center">
        <div class="">
        <div class="img d-flex align-items-center justify-content-center">
        <img src="<?=base_url('assets/')?>lms/img/JavaTraining.png" alt="JavaTraining" class="img-fluid course_img_1">
        <img src="<?=base_url('assets/')?>lms/img/JavaTraining01.png" alt="JavaTraining" class="img-fluid course_img_2">
        </div>
        <div class="title text-center mt-2 f_16 rt_14">
         Java Training
        </div>
        </div>
      </div>
      </a>
    </div>
     <div class="col-md-3 col-6 px-xl-3 px-1">
      <a href="">
      <div class="our_traning_content bgColorPink mb-xl-4 mb-2 d-flex align-items-center justify-content-center">
        <div class="">
        <div class="img d-flex align-items-center justify-content-center">
        <img src="<?=base_url('assets/')?>lms/img/SoftwareTesting.png" alt="SoftwareTesting" class="img-fluid course_img_1">
        <img src="<?=base_url('assets/')?>lms/img/SoftwareTesting01.png" alt="SoftwareTesting" class="img-fluid course_img_2">
        </div>
        <div class="title text-center mt-2 f_16 rt_14">
         Software testing
        </div>
        </div>
      </div>
      </a>
    </div>
     <div class="col-md-3 col-6 px-xl-3 px-1">
      <a href="">
      <div class="our_traning_content bgColorBrown mb-xl-4 mb-2 d-flex align-items-center justify-content-center">
        <div class="">
        <div class="img d-flex align-items-center justify-content-center">
        <img src="<?=base_url('assets/')?>lms/img/DigitalMarketing.png" alt="DigitalMarketing" class="img-fluid course_img_1">
        <img src="<?=base_url('assets/')?>lms/img/DigitalMarketing01.png" alt="DigitalMarketing" class="img-fluid course_img_2">
        </div>
        <div class="title text-center mt-2 f_16 rt_14">
         Digital marketing
        </div>
        </div>
      </div>
      </a>
    </div>
    
    <div class="col-md-3 col-6 px-xl-3 px-1">
      <a href="">
      <div class="our_traning_content bgColorSky mb-xl-4 mb-2 d-flex align-items-center justify-content-center">
        <div class="">
        <div class="img d-flex align-items-center justify-content-center">
        <img src="<?=base_url('assets/')?>lms/img/WebsiteDesigning.png" alt="WebsiteDesigning" class="img-fluid course_img_1">
        <img src="<?=base_url('assets/')?>lms/img/WebsiteDesigning01.png" alt="WebsiteDesigning" class="img-fluid course_img_2">
        </div>
        <div class="title text-center mt-2 f_16 rt_14">
         Website Designing
        </div>
        </div>
      </div>
      </a>
    </div>

  </div>
</div> 
</section>
<!-- ============end======== -->




<!-- =====================offer banner=================== -->
<section class="offer_banner_section mt-3 mb-4">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="offer_banner_content">
          <div class="para d-flex align-items-center
          justify-content-center">
           <div>
           <h2 class="rt_16 font-weight-bold text-white">Lorem ipsum dolor sit amet, consectetur adipis</h2>
           <p class=" rt_10 text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
           </div>
          </div>
          <div class="background_design">
            <div></div>
            <div></div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===================end==================== -->


<!-- =================testimonials============== -->
<section>
<div class="container">
  <div class="row">
    <div class="col-md-12">
  <div class="testimonials">
  <h2 class="title">Some words from our costumers</h2>
  <p class="description">We've been helping businesses to do their best since 2003.</p>

  <div class="slider-container">
    <div class="slider">
      <div class="slide-box">
        <!-- Testi One -->
        <p class="comment">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
          aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
        </p>
        <img src="https://images.unsplash.com/photo-1595152452543-e5fc28ebc2b8?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=80" />
        <h3 class="name">Albert Sinelly</h3>
        <h4 class="job">Founder Of Devoker Company</h4>
      </div>
      <div class="slide-box">
        <!-- Testi Two -->
        <p class="comment">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
          magna
          aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
          consequat.
        </p>
        <img src="https://images.unsplash.com/photo-1627541718143-1adc1b582e62?ixid=MnwxMjA3fDB8MHxzZWFyY2h8N3x8bXVzbGltfGVufDB8MnwwfHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" />
        <h3 class="name">Hirok Meryam</h3>
        <h4 class="job">Full stack Developer, Speaker</h4>
      </div>
      <div class="slide-box">
        <!-- Testi Three -->
        <p class="comment">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
          magna
          aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
          consequat.
        </p>
        <img src="https://images.unsplash.com/photo-1610216705422-caa3fcb6d158?ixid=MnwxMjA3fDB8MHxzZWFyY2h8MzJ8fGZhY2V8ZW58MHwyfDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" />
        <h3 class="name">Sebastian Sert</h3>
        <h4 class="job">UX/UI Designer, Phtographer</h4>
      </div>
    </div>

    <a href="#!" class="control-slider btn-left">
      <i class="fas fa-chevron-left"></i>
    </a>
    <a href="#!" class="control-slider btn-right">
      <i class="fas fa-chevron-right"></i>
    </a>
  </div>
</div>
</div>
</div>
</div>
</section>


