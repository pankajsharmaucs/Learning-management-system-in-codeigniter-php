<?php 


$table1=$_SESSION['c_table'];

$email=$_SESSION['auth_login_unboxskills_teacher'];

$data1=$this->admin->getWhere($table1,['email'=>$email]);
$name=$data1[0]->name;

@$AllCourseData = $this->Admin->get_teacher_course_data(2,$_SESSION['auth_teacher_id']); 


// var_dump($AllCourseData); die();


?>


      <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">

<?php if($AllCourseData){ foreach ($AllCourseData as $key ) {
$slug=str_replace(' ', '-', $key['slug']); ?>
            <div class="col-md-3 col-sm-6 mb-md-3 mb-2  grid-margin stretch-card">
              <div class="course_right bg-white">
                      <a href="#">
                        <div class="img">
<img src="<?=base_url('assets/course_data/')?><?= $key['course_id']?>/<?= $key['course_img']?>" alt="<?= $key['slug']?>" width="100%">
                        </div>
                        <div class="conten_wrapper p-3">

                          <div class="subtitle f_13 rt_12 tc_3">
                              <?= $key['course_name'] ?>
                          </div>

                          <div class="title f_20 fw_500 tc_0 pt-1 rt_18">
                              <?= $key['course_name'] ?>
                          </div>
                         
                          <a target="_blank" href="<?=base_url('course/')?><?= $slug ?>"
                           class="btn btn-outline-dark rounded-0  mt-3  p-3 col-md-12">View Course</a>
                        </div>
                      </a>
                    </div>
            </div>
<?php } } ?>
            
          </div>
        </div>
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->



 