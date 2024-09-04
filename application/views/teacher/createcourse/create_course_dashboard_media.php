
<?php 
  $cid=$_SESSION['current_course_id'];

  $courseCat=$this->Admin->get_course_data_by_id($cid,'course_data','course_img','course_bg_img','demo_cert_img'); 
include('validation.php');

  // var_dump($courseCat); die();

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
           Image/Demo Video
          </div>
          
        </div>
        <div class="p-md-3 p-2">
          <p class="f_14">
            Upload course  image, thumbnail, cover image and demo video.
          </p>
          <div class="create_course_content mt-4">
            <form>
              
              <div class="form-row">
                
                <div class="form-group col-md-12 mb-4">
                  <div class="row shadow p-lg-3">
                    <div class="col-md-7">
                        <label class="fw_700 ">Course Main Image</label>                       
                        <div class="input-group col-xs-12">
                          <span class="input-group-append">
                            <button class="file-upload-browse button_2 f_14 rt_12 px-2" 
                            onclick="$('#mainImage1').trigger('click');" type="button">Upload</button>
                          </span>
                          <input type="file" hidden id="mainImage1" onchange="selectImage(1); readURL(this,1);">
                          <input type="text" class="form-control form-control-sm rounded-0 file-upload-info"  placeholder="Upload Image" id="mainImageTxt1" disabled>
                        </div>
                        <div class="Notifiy1 pt-2 font-weight-bold text-success"></div>

                    </div>

                      <div class="col-md-5">
                          <div class=" mb-2 p-2" style="background-color: #eee;">
                           <img src="<?=base_url('assets/course_data/')?><?= $cid ?>/<?= $courseCat[0]['course_img'] ?>" id="output1" width="100%" >
                          </div>
                      </div>
                    </div>
                </div>

                <div class="form-group col-md-12 mb-4">
                  <div class="row shadow p-lg-3">
                    <div class="col-md-7">
                        <label class="fw_700">Course Cover Image</label>                       
                        <div class="input-group col-xs-12">
                          <span class="input-group-append">
                            <button class="file-upload-browse button_2 f_14 rt_12 px-2" 
                            onclick="$('#mainImage2').trigger('click');" type="button">Upload</button>
                          </span>
                          <input type="file" hidden id="mainImage2" onchange="selectImage(2); readURL(this,2);">
                          <input type="text" class="form-control form-control-sm rounded-0 file-upload-info"  placeholder="Upload Image" id="mainImageTxt2" disabled>
                        </div>
                        <div class="Notifiy2 pt-2 font-weight-bold text-success"></div>

                    </div>

                    <div class="col-md-5">
                          <div class=" mb-2 p-2" style="background-color: #eee;">
                           <img src="<?=base_url('assets/course_data/')?><?= $cid ?>/<?= $courseCat[0]['course_bg_img'] ?>" id="output2"  width="100%" >
                          </div>
                      </div>
                    </div>
                </div>

                <div class="form-group col-md-12 mb-4">
                  <div class="row shadow p-lg-3">
                    <div class="col-md-7">
                        <label class="fw_700">Course Demo Certificate</label>                       
                        <div class="input-group col-xs-12">
                          <span class="input-group-append">
                            <button class="file-upload-browse button_2 f_14 rt_12 px-2" 
                            onclick="$('#mainImage3').trigger('click');" type="button">Upload</button>
                          </span>
                          <input type="file" hidden id="mainImage3" onchange="selectImage(3); readURL(this,3);">
                          <input type="text" class="form-control form-control-sm rounded-0 file-upload-info"  placeholder="Upload Image" id="mainImageTxt3" disabled>
                        </div>
                        <div class="Notifiy3 pt-2 font-weight-bold text-success"></div>
                    </div>

                    <div class="col-md-5">
                          <div class=" mb-2 p-2" style="background-color: #eee;">
                            <img src="<?=base_url('assets/course_data/')?><?= $cid ?>/<?= $courseCat[0]['demo_cert_img'] ?>" id="output3"  width="100%" >
                          </div>
                      </div>
                    </div>
                </div>

<!-- 

              <div class="form-group col-md-12 mb-4">
                  <div class="row shadow p-lg-3">
                    <div class="col-md-7">
                        <label class="fw_700">Course Demo Video</label>                       
                        <div class="input-group col-xs-12">
                          <span class="input-group-append">
                            <button class="file-upload-browse button_2 f_14 rt_12 px-2" 
                            onclick="$('#mainImage4').trigger('click');" type="button">Upload</button>
                          </span>
                          <input type="file" hidden id="demoVideo" onchange="selectVideo();">
                          <input type="text" class="form-control form-control-sm rounded-0 file-upload-info"  placeholder="Upload Image" id="mainImageTxt4" disabled>
                        </div>
                        <div class="Notifiy3 pt-2 font-weight-bold text-success"></div>
                    </div>

                    <div class="col-md-5">
                          <div class=" mb-2 p-2" style="background-color: #eee;">
                             <iframe width="100%" height="565px" src="<?=base_url('assets/course_data/')?><?= $cid ?>/<?= $courseCat[0]['course_demo_video'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                          </div>
                      </div>
                    </div>
                </div> -->
                           

                
              </div>
            
            </form>
            <a href="create_course_dashboard_desc">
              <button type="submit" class="button_1 px-3 py-2 mt-3">Save & Continue</button>
            </a>
            
          </div>
        </div>
        
        
      </div>
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->