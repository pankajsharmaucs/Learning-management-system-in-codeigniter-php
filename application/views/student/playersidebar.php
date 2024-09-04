<nav class="sidebar sidebar2 sidebar-offcanvas"  id="sidebar" style="transition:.5s!important"  >
  
  <ul class="nav w-100 m-1">
    <div class="d-flex  align-items-center justify-content-between  py-2 "  style="background:#959393;">
     <h5 class="fw_600 ml-md-3 f_18 pt-2 text-white">Course Content</h5>
     <img src="<?=base_url('assets/student/')?>images/right-arrow.png" width="30px" alt="" class="studentSidebarClosed cp mr-3">
    </div>
    
   

<?php if(!$content){ $id=1; foreach ($content as $key ) {  

    $course_id=$key['course_id'];
    $section_id=$key['section_id'];
    $lecture=$this->admin->get_section_lecture($course_id,$section_id);

    $min=0;
    $sec=0;

  foreach ($lecture as $t ) {
    $time=$t['duration'];
    $time=explode(':', $time);
    $m=$time[0];                     
    $s=$time[1];
    $min=$min+$m;
    $sec=$sec+$s;

  if($sec >= 60){
    $sec1=$sec-60; $min1=$min+1;
    $total=$min1.':'.$sec1;  
  }else{
    $total=$min.':'.$sec;   
  }                                      
}

 ?>

    <li class="nav-item">      
      <a class="nav-link  text-dark rounded-0" data-toggle="collapse" href="#formData<?= $id ?>" aria-expanded="false" 
          aria-controls="formData<?= $id ?>" style="background:#dbd9d9">
          <div class="d-flex justify-content-between align-items-center p-0 row">
              <div class="col-md-8">
                <i class="icon-book menu-icon text-dark"></i>
                <span class="menu-title text-dark">
                  <?php $n=$key['section_name'];  $n2=substr($n,0,20); if(strlen($n) > 20 ){ $n2=$n2.'..';}  echo $n2;  ?> </span>
              </div>
              <div class="d-flex col-md-3  align-items-center justify-content-start">
                <span class="f_10 mr-1"> <?= count($lecture) ?> Lec  | <?= $total ?> min</span>
                <i class="menu-arrow text-dark"></i>
              </div>
          </div>
      </a>


<?php  
// ================================================================
if($lecture){foreach ($lecture as $lec ) { ?>
  
<?php if($lec['content_type'] == 'video' or $lec['content_type'] == 'youtube' 
  or  $lec['content_type'] == 'vimeo'){  $lec_link=$lec['v_link']; $lec_id=$lec['lec_id'];                            
?>

      <div class="collapse border-bottom " id="formData<?= $id ?>">
        <ul class="nav flex-column sub-menu px-1" style="background-color: #fff;">
        
          <li class="px-2 my-0 active d-flex justify-content-between align-items-center">
            <div class=" pb-0 mb-0 col-md-8 d-flex align-items-center">
              
              <div class=" mb-0 pb-0 d-flex align-items-center col-md-1">
                <label class="form-check-label fw_400 d-flex align-items-center mb-0 pb-0 cp">
                  <input type="checkbox" width="10px" class="form-check-input">
                </label>
              </div>

             
        <?php $lname= substr($lec['lecture_name'],0,30); if(strlen($lname) > 29 ){ $lname=$lname.'..';}  $lname2=$lec['lecture_name'];

                 if( $lec['content_type'] == 'vimeo' ){ ?>
                   <div class="col-md-11  text-left"
                      onclick="var lec_link='<?= $lec_link ?>'; 
                               var lec_id='<?= $lec_id ?>'; 
                               var lname='<?= $lname2 ?>';
                               var sec_id='<?= $section_id ?>'; 
                               playLecture(1,lname,lec_link,sec_id,lec_id);">
                     <span class=" previewBtn"><?= $lname ?></span>
                   </div>

              <?php }  else if( $lec['content_type'] == 'youtube' ){ ?>
                  <div class="col-md-11  text-left"
                      onclick="var lec_link='<?= $lec_link ?>'; 
                               var lec_id='<?= $lec_id ?>'; 
                               var lname='<?= $lname2 ?>';
                               var sec_id='<?= $section_id ?>'; 
                               playLecture(2,lname,lec_link,sec_id,lec_id);">
                    <span class=" previewBtn"><?= $lname ?></span>
                  </div>
                
              <?php }  else if( $lec['content_type'] == 'video' ){ ?>
                  <div class="col-md-11  text-left"
                     onclick="var lec_link='<?= $lec_link ?>'; 
                              var lec_id='<?= $lec_id ?>';
                              var lname='<?= $lname2 ?>';
                              var sec_id='<?= $section_id ?>'; 
                              playLecture(3,lname,lec_link,sec_id,lec_id);">
                      <span class=" previewBtn"><?= $lname ?></span>
                    </div>
              
              <?php } else if( $lec['content_type'] == 'pdf' ){ ?>
                <div class="col-md-11  text-left"
                     onclick="var lec_link='<?= $lec_link  ?>'; 
                              var lec_id='<?= $lec_id ?>';
                              var lname='<?= $lname2 ?>';
                              var sec_id='<?= $section_id ?>'; 
                              playLecture(4,lname,lec_link,sec_id,lec_id);">
                    <span class=" previewBtn"><?= $lname ?></span>
                </div>

              <?php } ?>              
              

            </div>

            <div class="col-md-4">
              <span class="f_12 text-dark mr-2" > <?= $lec['duration']; ?> min </span>
            </div>
          </li>
        </ul>
      </div>
<?php } }  }?>

    </li>

<?php $id++;  } } ?>





    
  </ul>
</nav>

