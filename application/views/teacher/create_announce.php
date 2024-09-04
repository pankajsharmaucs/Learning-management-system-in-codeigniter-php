<?php 


@$allCourse=$this->Admin->get_course_by_tid($_SESSION['teacher_id']); 
@$AllAnnounce=$this->Admin->get_all_anounce_tid($_SESSION['teacher_id']); 




// var_dump($AllAnnounce); die();


 ?>

     <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-6 mx-auto mt-md-5">
              <div class="create_course_content">
                <form>

                  <div class="col-md-12 text-center">
                     <h2 class="font-weight-bold mb-lg-5 mb-2  ">Create Course Annoncment !</h2>
                  </div>
                                 
                  <div class="form-group mb-2">
                    <label for="category" class="fw_700">Course List</label>
                    <select class="form-control rounded-0 form-control-sm" id="course_id" >
                    <?php foreach ($allCourse as $key ) { ?> 
                      <option value="<?= $key['course_id'] ?>"><?= $key['course_name'] ?></option>
                    <?php } ?>
                    </select>
                  </div>

                  <div class="form-group mb-2">
                    <label for="coursetitle" class="fw_700">Content</label>
                    <textarea class="form-control " id="content" rows="5"></textarea>
                  </div>

                    <div class="form-group mb-2">
                    <label for="coursetitle" class="fw_700">Post Image</label>
                    <input type="file" class="form-control rounded-0 form-control-sm" id="post_image">
                  </div>

                   <h4 class="font-weight-bold my-4 text-danger announceError"></h4>


                 </form>
                 
                   <div class="col-md-12 text-center">
                     <button onclick="addAnnounc()" type="submit" class="button_1 px-3 py-2">Save & Continue</button>
                   </div>


              </div>
            </div>
          </div>


          <div class="col-lg-12 px-1 px-md-2  mt-lg-4 grid-margin stretch-card">
              <div class="card bor_2">
                <div class="card-body">
                  <h4 class="card-title"> Course Announcements</h4>
                <!--   <p class="card-description">
                    Add class <code>.table-hover</code>
                  </p> -->
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>S.No</th>
                          <th>Course </th>
                          <th>Content</th>
                          <th>Post Image</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
    
    <?php if($AllAnnounce){ $id=1; foreach ($AllAnnounce as $key ) {

    $cid=$key['course_id'];
    $data=$this->Admin->get_course_data_by_id($cid,'course_data','course_name');
    $cname=$data[0]['course_name'];
     ?>
        <tr id="postedBox<?= $key['id'] ?>" >
          <td class="py-1" style="border-top:1px solid #eee;"><?= $id ?></td>
          <td class="py-1" style="border-top:1px solid #eee;" ><?= $cname?></td>
          
           <input type="hidden" id="posted_course_id<?= $id ?>" value="<?= $cid ?>" >
           <input type="hidden" id="posted_id<?= $id ?>" value="<?= $id ?>" >

          <td class="py-1" style="border-top:1px solid #eee;">
            <textarea class="form-control " id="posted_content<?= $id ?>"  rows="7"><?= $key['content']?></textarea>
          </td>

          <td class="py-1" >
            <img style="border-radius:0px!important; width:200px!important; height:100px!important;"
             src="<?=base_url('assets/course_data/')?><?= $cid ?>/announcement/<?= $key['post_image'] ?>">
            <div class="my-2"> <input type="file" id="posted_image<?= $id ?>" ></div>
          </td>

          <td class="py-1" style="border-top:1px solid #eee;">
            <div class="border px-3 py-3 border-0 btn btn-primary f_14 rt_12 cp"
            onclick="updateAnnounc(<?= $id ?>)">Update</div>
            <div class="border px-3 py-3 border-0  btn btn-danger f_14 rt_12 cp"
            onclick="deleteAnnounc(<?= $key['id'] ?>)">Delete</div>
          </td>

        </tr>
  <?php $id++; } }else{ ?>
        <tr>
          <td colspan="4" class=" text-center py-2 py-1" style="border-top:1px solid #eee;">No Announcement Found</td>
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


    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->



 