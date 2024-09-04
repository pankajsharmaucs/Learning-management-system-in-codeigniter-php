<?php 


@$courseCat= $this->Admin->get_course_category(); 


 ?>

       <!-- SideBar  -->
     
      <!-- End of SideBar -->

      <!-- partial -->
     <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-6 mx-auto mt-md-5">
              <div class="create_course_content">
                <form>

                  <div class="col-md-12 text-center">
                     <h2 class="font-weight-bold mb-lg-5 mb-2  ">Create New Course !</h2>
                  </div>
                  
                  <div class="form-group mb-2">
                    <label for="coursetitle" class="fw_700">Course Title</label>
                    <input type="text" class="form-control rounded-0 form-control-sm" id="coursetitle">
                  </div>
                  
                  <div class="form-group mb-2">
                    <label for="category" class="fw_700">Category</label>
                    <select class="form-control rounded-0 form-control-sm" id="courseCat" onchange="getSubCat()">
                      <option value="">Select Category</option>
                    <?php foreach ($courseCat as $key ) { ?> 
                      <option value="<?= $key['cat_id'] ?>"><?= $key['name'] ?></option>
                    <?php } ?>
                    </select>
                  </div>

                   <div class="form-group">
                    <label for="subcategory" class="fw_700">Sub Category</label>
                      <select class="form-control rounded-0 form-control-sm" id="courseSubCat">
                      
                    </select>
                  </div>

                    <span class="text-danger CreateErrorBox"></span>

                 </form>
                 
                   <div class="col-md-12 text-center">
                     <button onclick="CreateCourse1()" type="submit" class="button_1 px-3 py-2">Save & Continue</button>
                   </div>
                
              </div>
            </div>
          </div>
        </div>

      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->



 