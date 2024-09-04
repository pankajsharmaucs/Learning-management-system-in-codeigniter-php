<?php 
  
  $cid=$_SESSION['current_course_id'];

  $courseData=$this->Admin->get_course_data_by_id($cid,'course_data','description'); 

  $course_highlight=$this->Admin->get_course_data_by_id($cid,'course_highlight','*'); 

include('validation.php');

  // var_dump($course_highlight); die();

?>

<input type="hidden" id="total_highlights" value="<?= count($course_highlight); ?>">

<div class="container-fluid page-body-wrapper pt-1 pt-3 create_course">
  
  <div class="container">
    <div class="row">
      <div class="col-lg-3">
        <?php include ('create_course_dashboard_sidebar.php'); ?>
      </div>
      <div class="col-lg-9 mt-4 px-md-0 bor_1 bg-white">
        <div class="border-bottom">
          <div class="p-md-3 p-2 f_22 fw_700">
           Description
          </div>
          
        </div>
        <div class="p-md-3 p-2">
          <p class="f_14">
            The following descriptions will be publicly visible on your Course Landing Page and will have a direct impact on your course performance. These descriptions will help learners decide if your  course is right for them.
          </p>
          <div class="create_course_content_desc mt-4">
            <div class="form-group">
             <textarea class="content p-2 form-control" rows="6" placeholder="Maximum 260 Words" 
             id="description"><?= $courseData[0]['description'] ?></textarea>
            </div>
          </div>
          <div class="mt-2">
          <div class="create_course_content_desc py-md-3 py-2 f_18 rt_16 fw_700">
           What will you learn ?
          </div>
          <div class="col-md-12 whatwillyoulear_content px-0">

<?php if($course_highlight){ $id=1; foreach ($course_highlight as $key) { ?>
            <div class="form-group col-md-12 mb-2" id="highlightBox1">
              <label for="coursetitle" class="fw_700">Content <?= $id; ?>  </label>
              <div class="d-flex align-items-center justify-content-start">
              <input type="text" class="form-control w-100 rounded-0 form-control-sm hightlight" id="coursetitle" placeholder="Enter Content..." value="<?= $key['description'] ?>">
              </div>
            </div>
<?php $id++; } } ?>

           
          
          </div>

          <div class="col-md-12">
             <span class="plusicon btn-outline-dark btn p-1 f_18 px-4 rounded-0 fw_700 py-2 " id="addwhatwill"
               onclick="addMoreInput1()"> + </span>
          </div>
          
        </div>
          <div>
              <button type="submit" onclick="CreateCourse3();" class="button_1 px-3 py-2 mt-3">Save & Continue</button>
          </div>
        </div>
        
        
      </div>
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->