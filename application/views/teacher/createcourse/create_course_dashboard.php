<?php 


$cid=$_SESSION['current_course_id'];
$courseCat=$this->Admin->get_course_data_by_id($cid,'course_data','slug','overview','offer_price','course_price','course_status'); 

include('validation.php');

// var_dump(); die();


?>
    <div class="container-fluid page-body-wrapper pt-1 pt-3 create_course">
      
     <div class="container">
       <div class="row">

         <div class="col-lg-3">
           <?php include ('create_course_dashboard_sidebar.php'); ?>
         </div>
         <div class="col-lg-9 mt-4 px-md-0 bor_1 bg-white">
          <div class="border-bottom">
           <div class="p-md-3 p-2 f_22 fw_700">
             Basic Details
           </div>
         
          </div>
          <div class="p-md-3 p-2">
             <p class="f_14">
              The following descriptions will be publicly visible on your Course Landing Page and will have a direct impact on your course performance. These descriptions will help learners decide if your  course is right for them.
              </p>

              <div class="create_course_content mt-4">
                <form>
                  
                  <div class="form-row">
                  <div class="form-group col-md-4 mb-2">
                    <label class="fw_700">Course Price</label>
                    <input type="text" class="form-control rounded-0 form-control-sm" 
                     value="<?= $courseCat[0]['course_price']?>"
                     id="coursePrice">
                  </div>
                  
                  <div class="form-group col-md-4 mb-2">
                    <label for="category" class="fw_700">Offer Price</label>
                    <input type="text" class="form-control rounded-0 form-control-sm"
                      value="<?= $courseCat[0]['offer_price']?>"
                      id="offerPrice">
                  </div>

                  <div class="form-group col-md-4 mb-2">
                    <label for="category" class="fw_700">Slug / Permalink</label>
                    <input type="text" class="form-control rounded-0 form-control-sm"
                      value="<?= $courseCat[0]['slug']?>"
                       id="slug">
                  </div>
                  </div>

                  <div class="form-group">
                    <label for="subcategory" class="fw_700">Overview</label>
                    <textarea class="form-control rounded-0 px-3" placeholder="Maximum 260 Words" style="resize: vertical;" rows="5" id="courseOverview"><?= $courseCat[0]['overview']?></textarea>
                  </div>
              
                      <div class="mb-3">
                        <span class="text-danger font-weight-bold CreateErrorBox "></span>
                      </div>
                 </form>
                 
                   <button onclick="CreateCourse2()"  class="button_1 px-3 py-2">Save & Continue</button>
                
              </div>
          </div>         

       </div>
     </div>

    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->



