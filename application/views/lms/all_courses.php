<?php 

$course_category=$this->admin->get_course_category();

// var_dump($course_category); die();
 ?>

  <section class="course_section">
      <div class="container course_content">
        <div class="px-md-4 mt-xl-0 mt-lg-0 mt-md-0 mt-4 accordion" id="accordionExample">
          <div class="row">
            <div class="col-12 text-center py-4 ">
              <p class="tc_3 fw_600">Build your career with</p>
              <h2 class="section_title fw_500 f_30 rt_24">30+ Professional Programs</h2>
            </div>
            <div class="col-md-3 order-md-1 rounded order-1 bs_1 pt-3 d-none">
              <div class="course_left">
                
                <div>

<?php if($course_category){ $catid=1; foreach ($course_category as $key ) { ?>
<?php if($catid==1){ ?>
    <button class="btn btn-link btn-block text-left d-flex justify-content-between align-items-center collapsed rounded " type="button" onclick="courseList(<?= $catid ?>);" id="btn1">
<?php }else{?>
    
    <button class="btn btn-link btn-block text-left d-flex justify-content-between align-items-center  rounded " type="button" onclick="courseList(<?= $catid ?>);" id="btn1">

<?php } ?>
      <span class="rt_11 d-flex justify-content-start align-items-center">
        <!-- <i class="fas fa-fire mr-sm-2 mr-1"></i> -->
        <?= $key['name'] ?></span>
      <span> <i class="fas fa-chevron-right rt_10 f_11 d-sm-block d-none"></i></span>
    </button>
<?php  $catid++; } } ?>

</div>
                
                
              </div>
            </div>
            <div class="col-md-12 order-md-2 order-2 mt-2">
             
              <!-- ====first cards==== -->
              <div id="collapse1" class="c_content show ">
                <div class="row d-flex justify-content-start">

<?php
 $cdata=$this->admin->get_all_course(); 

foreach ($cdata as $ckey ) {
  $name=$ckey['course_name']; 
  $total_article=$ckey['total_article']; 
  $course_img=$ckey['course_img']; 
  $course_id=$ckey['course_id']; 
  $slug=$ckey['slug']; 
  $slug= str_replace(' ', '-', $slug); 


  ?>
                  <div class="col-lg-3  col-md-4 col-sm-6 px-2 mb-sm-4 mb-2">
                    <div class="course_right border">
                      <a target="_blank" href="<?=base_url('course/')?><?= $slug ?>">
                        <div class="img">
                          <img src="<?=base_url('assets/course_data/')?><?= $course_id ?>/<?= $course_img ?>" alt="<?= $name ?>" width="100%"  >
                        </div>
                        <div class="conten_wrapper p-3">
                          
                          <div class="title f_20 fw_500 tc_0 pt-1 rt_18">
                            <?=  $name ?>

                          </div>
                          <?php 
                            $rating_count=$this->admin->get_course_rating_count($course_id);
                            $sum_of_rating=$this->admin->get_course_rating_sum($course_id);

                            $ratingSum=$sum_of_rating[0]['rating'];

                            $mode=$ratingSum/2;

                            $modeExpo=explode('.',$mode);

                            $mode1=$modeExpo[0];
                            $mode2=$modeExpo[1];

                           ?>
                          <div>
                             <span class="">
                            <?php for($i=0;$i< $mode1; $i++){ ?>
                              <i class="fa fa-star f_10 tc_4"></i>
                            <?php } ?>
                            
                            <?php if ($mode2): ?>
                              <i class="fas fa-star-half-alt f_10 tc_4"></i>
                            <?php endif ?>

                              <span class="f_10 px-1 text-secondary"><?= $rating_count ?> Ratings</span>
                            </span>
                          </div>
                          <div class="duration pt-1 pb-2 text-secondary f_14 rt_14">
                                 <?= $total_article ?> Lessons
                          </div>
                          <div class="location f_14">
                    <strike class="ml-1 f_12 text-secondary">&#8377;<?= $ckey['course_price'] ?>  </strike>
                    <a href="coursedetail.php"><button class="button_1">&#8377; <?= $ckey['offer_price'] ?></button></a>
                          </div>
                        </div>
                      </a>
                    </div>
                  </div>
<?php } ?>


                </div>
              </div>




                </div>
    </section>