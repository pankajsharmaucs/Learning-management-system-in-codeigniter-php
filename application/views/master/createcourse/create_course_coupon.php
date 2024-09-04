<?php 
  
  $cid=$_SESSION['current_course_id'];

  $courseContent=$this->Admin->get_course_content($cid,'course_data','section_id','section_name'); 


include('validation.php');

  // var_dump($courseContent); die();

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
            Create  and Edit Coupon  
          </div>
          
        </div>
        <div class="p-md-3 p-2">
          <!-- <p class="f_14"></p> -->
          <div class="">
              <div class="mt-2">
                <div class="create_course_content_desc py-md-3 py-2 f_17 rt_15 fw_700">
                  Add Coupon
                </div>
                <div class="row whatwillyoulear_content px-0">
                 
                  <div class="form-group mb-2 col-md-4">
                    <label>Coupon code (eg. USNEW001)</label>
                    <div class="d-flex align-items-center justify-content-start">
                    <input type="text" class="form-control w-100 rounded-0 form-control-sm" id="couponTitle" placeholder="Enter Coupon Code" onfocus="$('#focusPoint').val('addSection');">
                    </div>
                  </div>

                  <div class="form-group mb-2 col-md-4">
                      <label>Start Date</label>
                    <div class="d-flex align-items-center justify-content-start">
                    <input type="date" class="form-control w-100 rounded-0 form-control-sm" id="start_date" onfocus="$('#focusPoint').val('addSection');">
                    </div>
                  </div>

                  <div class="form-group mb-2 col-md-4">
                      <label>Expiry Date</label>
                    <div class="d-flex align-items-center justify-content-start">
                    <input type="date" class="form-control w-100 rounded-0 form-control-sm" id="exp_date"  onfocus="$('#focusPoint').val('addSection');">
                    </div>
                  </div>

                  <div class="form-group mb-2 col-md-4">
                    <div class="d-flex align-items-center justify-content-start">
                    <input type="text" class="form-control w-100 rounded-0 form-control-sm" id="discount" placeholder="Discount %" onfocus="$('#focusPoint').val('addSection');">
                    </div>
                  </div>

                  <div class="col-md-12">
                    <span class="plusicon btn-outline-dark btn px-3 addSectionBtn  rounded-0 fw_700 ml-2"
                     onclick="addCoupon()"> Submit Now </span>
                  </div>

                </div>
            </div>

                      <div class="my-3">
                        <span class="text-danger font-weight-bold CreateErrorBox "></span>
                      </div>

          </div>
          <div class="create_course_content  mt-4">

<div class="py-3 f_22 fw_700 col-md-12  d-flex justify-content-between shadow">
          <h3> List of Coupons</h3>
          <button class="btn btn-danger mr-md-2 mr-1 rt_14 " onclick="getAllCoupon()"> Show All</button>
</div>

<ul class="accordion1" type="none" id="allCouponCodeListBox"></ul>


    <a href="sendCourseToAdmin">
          <button type="submit" class="button_1 px-3 py-2 mt-3">Submit Course for Publish</button>
    </a>
          <p class="mt-2">Submit this course to admin verification. In 48 hrs you will Publish or give revert on it.</p>
            
          </div>
        </div>
        
        
      </div>
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->