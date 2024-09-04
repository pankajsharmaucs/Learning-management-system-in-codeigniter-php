<?php 


$table1=$_SESSION['c_table'];

$email=$_SESSION['auth_login_unboxskills_teacher'];

$data1=$this->admin->getWhere($table1,['email'=>$email]);
$name=$data1[0]->name;

@$IncompleteCourseData = $this->Admin->get_teacher_course_data(0,$_SESSION['auth_teacher_id']); 
@$approvalCourseData = $this->Admin->get_teacher_course_data(1,$_SESSION['auth_teacher_id']); 

$_SESSION['auth_teacher_email']=$email;

$t_data = $this->Admin->get_teacher_data($_SESSION['auth_teacher_email']); 


@$totalPurchased = $this->Admin->get_total_sum_purchased_course(); 


@$totalpublised_course = $this->Admin->get_total_sum_publised_course(); 

$_SESSION['teacher_id']=$t_data[0]['teacher_id'];


?>

 <?php if($t_data[0]['first_login'] <= 0){ ?>
<!-- =========Welcome==popup==== -->

<div class="welcomePopUp popup-1" >
    <div class="">
        <div class="text-center animate__animated   animate__zoomIn" style="width:100%; padding:15px 20px; background: #fff; border-radius:4px; ">

           <div class="my-2">
              <img src="<?=base_url('assets/teacher/')?>images/Logo -unboxskills.png" alt="Logo unboxskills" style="height: 60px;">
           </div>

            <h2 class="my-3">Welcome to UnboxSkills Family</h2>

             <a href="<?= $_SESSION['dash_url'].'createFirstCourse'; ?>"><button class="btn btn-success rounded-0" >Let's Create Course</button></a>

        </div>
    </div>
</div>

<?php } ?>



      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Welcome <?= $name; ?></h3>
                  
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            
            <div class="col-md-12 grid-margin transparent">
              <div class="row">
                <div class="col-md-3 col-6 px-1 px-md-2 mb-2 stretch-card transparent" >
                  <div class="card card-dark-blue mb-0">
                    <div class="card-body text-center">
                      <i class="fas fa-book-open f_40 rt_20"></i>
                      <p class="mt-2 f_18 rt_15">All Course</p>
                      <p class="f_18 rt_15 mb-2"><?= $totalpublised_course; ?></p>

                      <!-- <p>10.00% (30 days)</p> -->
                    </div>
                   
                  </div>
                </div>
                <div class="col-md-3 col-6 px-1 px-md-2 mb-2 stretch-card transparent">
                  <div class="card card-dark-blue ">
                    <a class="text-dark" href="<?= $_SESSION['dash_url'].'My-Earning'; ?>">
                      <div class="card-body text-center">
                      <i class="fas fa-rupee-sign f_40 rt_20"></i>
                      <p class="mt-2 f_18 rt_15">Total Earnings</p>
                      <p class="f_18 rt_15"><?= $totalPurchased[0]['amount'] ?></p>
                      <!-- <p>22.00% (30 days)</p> -->
                      </div>
                    </a>
                  </div>
                </div>
             
                <!-- <div class="col-md-3 col-6 px-1 px-md-2 mb-2 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body text-center">
                      <i class="fas fa-check-circle f_40 rt_20"></i>
                      <p class="mt-2 f_18 rt_15">KYC</p>
                      <p class="f_18 rt_15">Done</p>
                    </div>
                  </div>
                </div> -->

                <div class="col-md-3 col-6 px-1 px-md-2 mb-2 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body text-center">
                      <i class="fas fa-info-circle f_40 rt_20"></i>
                      <p class="mt-2 f_18 rt_15">Help</p>
                      
                      <!-- <p>0.22% (30 days)</p> -->
                    </div>
                  </div>
                </div>


              </div>
            </div>
            <div class="col-lg-12 px-1 px-md-2 grid-margin stretch-card">
              <div class="card bor_2">
                <div class="card-body">
                  <h4 class="card-title"> Course in Draft</h4>
                <!--   <p class="card-description">
                    Add class <code>.table-hover</code>
                  </p> -->
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>S.No</th>
                          <th>Course Title</th>
                          <th>Status</th>
                          <th>View</th>
                        </tr>
                      </thead>
                      <tbody>
    
    <?php if($IncompleteCourseData){ $id=1; foreach ($IncompleteCourseData as $key ) { ?>
        <tr>
          <td class="py-1" style="border-top:1px solid #eee;"><?= $id ?></td>
          <td class="py-1" style="border-top:1px solid #eee;"><?= $key['course_name'] ?></td>
          <td class="py-1" style="border-top:1px solid #eee;"><label class="text-danger">Incomplete</label></td>
          <td class="py-1" style="border-top:1px solid #eee;">
            <a href="<?= $_SESSION['dash_url'].'openPendingCourse/'; ?><?= $key['course_id'] ?>"><label class="border px-3 py-1 border-0 button_1 f_14 rt_12 cp">View</label></a>
          </td>
        </tr>
  <?php $id++; } }else if($approvalCourseData){ $id=1; foreach ($approvalCourseData as $key ) { ?>
        <tr>
          <td class="py-1" style="border-top:1px solid #eee;"><?= $id ?></td>
          <td class="py-1" style="border-top:1px solid #eee;"><?= $key['course_name'] ?></td>
          <td class="py-1" style="border-top:1px solid #eee;"><label class="text-danger"> Pending for admin Approval</label></td>
          <td class="py-1" style="border-top:1px solid #eee;">
            <label class="border px-3 py-1 border-0 btn btn-danger f_14 rt_12 cp">Locked</label>
          </td>
        </tr>
  <?php $id++; } }else{ ?>
        <tr>
          <td colspan="4" class=" text-center py-2 py-1" style="border-top:1px solid #eee;">No Course Found</td>
        </tr>

  <?php } ?>


                
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>



    </div>
        <!-- content-wrapper ends -->



