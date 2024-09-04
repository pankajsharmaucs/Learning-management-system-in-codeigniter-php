<?php 


$table1=$_SESSION['c_table'];

$email=$_SESSION['auth_login_unboxskills_teacher'];

$data1=$this->admin->getWhere($table1,['email'=>$email]);
$name=$data1[0]->name;

@$purchasedCourse = $this->Admin->get_purchased_course(); 



// var_dump($purchasedCourse); die();


?>

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
            <div class="col-lg-12 px-1 px-md-2 grid-margin stretch-card">
              <div class="card bor_2">
                <div class="card-body">
                  <h4 class="card-title"> My Earning </h4>
                <!--   <p class="card-description">
                    Add class <code>.table-hover</code>
                  </p> -->
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>S.No</th>
                          <th>Course Title</th>
                          <th>Student Email</th>
                          <th>Amount</th>
                          <th>Date</th>
                        </tr>
                      </thead>
                      <tbody>
    
    <?php if($purchasedCourse){ $id=1; foreach ($purchasedCourse as $key ) { ?>
        <tr>
          <td class="py-1" style="border-top:1px solid #eee;"><?= $id ?></td>
          <td class="py-1" style="border-top:1px solid #eee;"><?= $key['course_id'] ?></td>
          <td class="py-1" style="border-top:1px solid #eee;"><?= $key['student_email'] ?></td>
          <td class="py-1" style="border-top:1px solid #eee;"><?= $key['amount'] ?></td>
          <td class="py-1" style="border-top:1px solid #eee;"><?= $key['pay_date'] ?></td>
          
          
        </tr>
  <?php $id++; } } ?>




                       <!--  <tr>
                          <td class="py-1" style="border-top:1px solid #eee;">2</td>
                          <td class="py-1" style="border-top:1px solid #eee;">Flash</td>
                          <td class="py-1" style="border-top:1px solid #eee;"><label class="text-warning">In progress</label></td>
                          <td class="py-1" style="border-top:1px solid #eee;"><a href="#"><label class="border px-3 py-1 border-0 button_1 f_14 rt_12 cp">View</label></a></td>
                        </tr>
                        <tr>
                          <td class="py-1" style="border-top:1px solid #eee;">3</td>
                          <td class="py-1" style="border-top:1px solid #eee;">Premier</td>
                          <td class="py-1" style="border-top:1px solid #eee;"><label class="text-success">Completed</label></td>
                          <td class="py-1" style="border-top:1px solid #eee;"><a href="#"><label class="border px-3 py-1 border-0 button_1 f_14 rt_12 cp">View</label></a></td>
                        </tr>
                        <tr>
                          <td class="py-1" style="border-top:1px solid #eee;">4</td>
                          <td class="py-1" style="border-top:1px solid #eee;">After effects</td>
                          <td class="py-1" style="border-top:1px solid #eee;"><label class="text-success">Completed</label></td>
                          <td class="py-1" style="border-top:1px solid #eee;"><a href="#"><label class="border px-3 py-1 border-0 button_1 f_14 rt_12 cp">View</label></a></td>
                        </tr>
                        <tr>
                          <td class="py-1" style="border-top:1px solid #eee;">5</td>
                          <td class="py-1" style="border-top:1px solid #eee;">Premier</td>
                          <td class="py-1" style="border-top:1px solid #eee;"><label class="text-warning">In progress</label></td>
                          <td class="py-1" style="border-top:1px solid #eee;"><a href="#"><label class="border px-3 py-1 border-0 button_1 f_14 rt_12 cp">View</label></a></td>
                        </tr> -->


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



