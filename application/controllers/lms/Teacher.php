<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Controller Search
 *
 * @package   UCS
 * @category  Search
 *
 */

class Teacher extends CI_Controller
{

      public function __construct()
      {
            parent::__construct();

           $this->load->model('Admin');
           $this->load->helper(array('form', 'url'));

      }

// ===================Auto==search=======
      public function index()
       { 
        // echo "All Course"; die();

          $data['title'] = ' Teacher Dashboard   | Unboxskills';
          $this->load->view('teacher/header', $data, false);
          $this->load->view('teacher/sidebar', $data, false);
          $this->load->view('teacher/index' );
          $this->load->view('teacher/footer', $data, false);
       }



// ===================Create First  Course=======
      public function createFirstCourse()
       { 
          $response = $this->Admin->createFirstCourse(); 
          // var_dump($response); die();

          if($response == true){ 
              $data['title'] = ' Create Course   | Unboxskills';
              redirect(base_url('/teacher/create_course')); die();
          }else{
            echo $response; die();
          }
       }



// ===================Create First  Course=======
      public function openPendingCourse($cid)
       { 
              $_SESSION['current_course_id']=$cid;
              redirect(base_url('/teacher/create_course_dashboard')); die();
       }





// ===================My earning=======
      public function myearning()
       { 
          $data['title'] = ' My Earning  | Teacer Dashboard   | Unboxskills';
          $this->load->view('teacher/header', $data, false);
          $this->load->view('teacher/sidebar', $data, false);
          $this->load->view('teacher/earning' );
          $this->load->view('teacher/footer', $data, false);
       }



// ===================Get==my Course=======
      public function createMyCourse()
       { 

          $data['title'] = ' Step 1 | Create Course | Teacer Dashboard   | Unboxskills';
          $this->load->view('teacher/header', $data, false);
          $this->load->view('teacher/sidebar', $data, false);
          $this->load->view('teacher/createcourse/create_course' );
          $this->load->view('teacher/footer', $data, false);
       }



// ===================create_announce=======
      public function create_announce()
       { 

          $data['title'] = ' Create Announce | Teacer Dashboard   | Unboxskills';
          $this->load->view('teacher/header', $data, false);
          $this->load->view('teacher/sidebar', $data, false);
          $this->load->view('teacher/create_announce' );
          $this->load->view('teacher/footer', $data, false);
       }



// ===================Get==my Course dashboard=======
      public function createMyCourseDashboard()
       { 
              // echo "All Course"; die();

              $data['title'] = '  Step 2 | Create Course | Teacer Dashboard   | Unboxskills';
              $data['pagename'] = 'createcourse';
              $data['createstep']=1;
              $this->load->view('teacher/header', $data, false);
              $this->load->view('teacher/createcourse/create_course_dashboard' );
              $this->load->view('teacher/footer', $data, false);
       }



// ===================Get==my Course dashboard media=======
      public function createMyCourseDashboardMedia()
       { 
          // echo "All Course"; die();

          $data['title'] = ' Step 3 | Create Course | Teacer Dashboard   | Unboxskills';
          $data['pagename'] = 'createcourse';
          $data['createstep']=2;
          $this->load->view('teacher/header', $data, false);
          $this->load->view('teacher/createcourse/create_course_dashboard_media' );
          $this->load->view('teacher/footer', $data, false);
       }

// ===================Get==my Course dashboard description=======
      public function createMyCourseDashboardDesc()
       { 
          // echo "All Course"; die();

          $data['title'] = ' Step 4 | Create Course | Teacer Dashboard   | Unboxskills';
          $data['pagename'] = 'createcourse';
          $data['createstep']=3;
          $this->load->view('teacher/header', $data, false);

          $this->load->view('teacher/createcourse/create_course_dashboard_desc' );
          $this->load->view('teacher/footer', $data, false);
       }
// ===================Get==my Course dashboard description=======
      public function createMyCourseDashboardCont()
       { 
          // echo "All Course"; die();

          $data['title'] = ' teacher Dashboard   | Unboxskills';
          $data['pagename'] = 'createcourse';
          $data['createstep']=4;
          $this->load->view('teacher/header', $data, false);

          $this->load->view('teacher/createcourse/create_course_dashboard_cont' );
          $this->load->view('teacher/footer', $data, false);
       }


// ===================Get==my Course Coupon=======
      public function create_course_coupon()
       { 
          // echo "All Course"; die();

          $data['title'] = ' teacher Dashboard   | Unboxskills';
          $data['pagename'] = 'createcourse';
          $data['createstep']=5;
          $this->load->view('teacher/header', $data, false);

          $this->load->view('teacher/createcourse/create_course_coupon' );
          $this->load->view('teacher/footer', $data, false);
       }





// ===================Get==my Course=======
      public function createTab()
       { 
          // echo "All Course"; die();

          $data['title'] = ' teacher Dashboard   | Unboxskills';
          $this->load->view('teacher/header', $data, false);
          $this->load->view('teacher/create' );
          $this->load->view('teacher/footer', $data, false);
       }

       // ===================Get==my Course=======
      public function getMyCourse()
       { 
          // echo "All Course"; die();

          $data['title'] = ' teacher Dashboard   | Unboxskills';
          $this->load->view('teacher/header', $data, false);
          $this->load->view('teacher/sidebar', $data, false);
          $this->load->view('teacher/my_course' );
          $this->load->view('teacher/footer', $data, false);
       }



// ===================Get== get_purchased_course =======
      public function get_purchased_course()
       { 

          $response = $this->Admin->get_purchased_course(); 

           echo  $response; die();
       }


// ===================get_total_sum_purchased_course =======
      public function get_total_sum_purchased_course()
       { 

          $response = $this->Admin->get_total_sum_purchased_course(); 

           echo  $response; die();
       }


// ===================get_total_sum_publised_course =======
      public function get_total_sum_publised_course()
       { 

          $response = $this->Admin->get_total_sum_publised_course(); 

           echo  $response; die();
       }





// ===================Get== Sub Cat =======
      public function getSubCat()
       { 
          $getSubCat=filter_var($_POST['courseCat'], FILTER_SANITIZE_STRING);

          $response = $this->Admin->getSubCat($getSubCat); 

           echo  $response; die();
       }




// ================Create===Course=======


public function CreateCourse1()
      { 
       if(!empty($_POST['coursetitle']) and !empty($_POST['courseCat']) and !empty($_POST['courseSubCat']) 
           and $_SESSION['auth_teacher_id'] ){
              $data = array(
                    'coursetitle' => trim(filter_var($_POST['coursetitle'],FILTER_SANITIZE_STRING)),
                    'courseCat' => trim(filter_var($_POST['courseCat'],FILTER_SANITIZE_STRING)),
                    'courseSubCat' => trim(filter_var($_POST['courseSubCat'],FILTER_SANITIZE_STRING)),
                );
              $response = $this->Admin->CreateCourse1($data); 
          if($response){  echo $response; die(); }
        }else{ echo "Invalid Access"; die(); }
          
      }


public function CreateCourse2()
      { 
       if(!empty($_POST['coursePrice']) and !empty($_POST['offerPrice']) and !empty($_POST['slug']) 
        and !empty($_POST['courseOverview']) and $_SESSION['auth_teacher_id'] ){

            if(is_numeric($_POST['coursePrice'])){}else{ echo "Invalid Course price"; die();}
            if(is_numeric($_POST['offerPrice'])){}else{ echo "Invalid Offer price"; die();}

              $data = array(
                    'coursePrice' => trim(filter_var($_POST['coursePrice'],FILTER_SANITIZE_NUMBER_INT)),
                    'offerPrice' => trim(filter_var($_POST['offerPrice'],FILTER_SANITIZE_NUMBER_INT)),
                    'slug' => trim(filter_var($_POST['slug'],FILTER_SANITIZE_STRING)),
                    'courseOverview' => trim(filter_var($_POST['courseOverview'],FILTER_SANITIZE_STRING)),
                );
              $response = $this->Admin->CreateCourse2($data); 

              var_dump($response); die();

          if($response){  echo $response; die(); }
        }else{ echo "Invalid Access"; die(); }
          
      }




// ===============End==of==create==function===



public function uploadCourseImage()
      { 
        $image_tmp=$_FILES['mainImage']['tmp_name'];
        $image_type=$_FILES['mainImage']['type'];

        $type=filter_var($_POST['type'],FILTER_SANITIZE_NUMBER_INT);

        $exp=explode('/', $image_type);

        
        if($exp[1] != 'png' and  $exp[1] != 'jpg' and $exp[1] != 'jpeg' ){ 
          echo "Only Png, jpg and Jpeg allowed"; die();}

           $data = array(
                    'type' => $type,
                    'ext' => $exp[1],
                    'image_tmp' => $image_tmp,
                );

          $response = $this->Admin->uploadCourseImage($data); 

          echo $response; die();          
}




public function CreateCourse3()
      { 
       if(!empty($_POST['description']) and !empty($_POST['hightlight']) and $_SESSION['auth_teacher_id'] ){


              $data = array(
                    'description' => trim(filter_var($_POST['description'],FILTER_SANITIZE_STRING)),
                    'hightlight' => $_POST['hightlight'],
                    'inputLen' => $_POST['inputLen'],
                );
              $response = $this->Admin->CreateCourse3($data); 

              var_dump($response); die();

          if($response){  echo $response; die(); }
        }else{ echo "Invalid Access"; die(); }
          
      }




// =====================Create Course 4==============

  public function addSection()
      { 
       if(!empty($_POST['sectionTitle']) and $_SESSION['auth_teacher_id'] ){

              $data = array(
                    'sectionTitle' => trim(filter_var($_POST['sectionTitle'],FILTER_SANITIZE_STRING)),
                );
              $response = $this->Admin->addSection($data); 
              
              var_dump($response); die();

          if($response){  echo $response; die(); }
        }else{ echo "Invalid Access"; die(); }
          
}


public function allSectionData(){

  $cid=$_SESSION['current_course_id'];

  $courseContent=$this->Admin->get_course_content($cid,'course_data','section_id','id','section_name'); 

$output='';

if($courseContent){ foreach ($courseContent as $key ) { 
  $id=$key['id'];
  $sec_name=$key['section_name'];
  $sec_id=$key['section_id'];
  $sid=explode('_', $sec_id);
  $sid=$sid[1];

$output.='
           <li id="secListBox'.$id.'" >
             <div class="toggle1 d-flex align-items-center justify-content-between flex-wrap" >
              <div class="col-md-6 col-12 f_15 rt_13 fw_600 sec_name" onclick="openSec('.$id.')"
               id="sec_name'.$id.'" > '.$sec_name.' </div>
              <div class="f_13 rt_13 col-md-6 col-12 text-md-right">
              <i class="fa fa-chevron-down mr-md-5 mr-3 rt_14  p-2 sectionIcon plusicon" onclick="openSec('.$id.')" id="sectionIcon'.$id.'"></i>
              <i class="fa fa-trash mr-md-2 mr-1 rt_14 cp p-2 " onclick="deleteSecListBox('.$sid.')"></i> 
              </div>
              </div>

          <div class="inner px-2 py-2 sectionBox" id="sectionBox'.$id.'"  >

              <div class="p-md-3 p-2 f_17 fw_700 col-md-12 d-flex justify-content-between" >
                List of Lecture
                
              </div>



      <div class="col-md-12 text-center p-2" id="AllLectureDataBox'.$id.'"> 
';

$getLec=$this->Admin->get_section_lec($cid,'course_content_lecture',$sec_id); 

// var_dump($getLec);

if($getLec){ foreach ($getLec as $lec ) { $lname=$lec['lecture_name'];
          $lname=$lec['lecture_name'];
          $lid=$lec['id'];
          $sec_id=$lec['section_id'];
          $content_type=$lec['content_type'];
          $access_type=$lec['access_type'];
          $v_link=$lec['v_link'];
          $duration=$lec['duration'];
          $lecid=$lec['lec_id'];

          $secFolder=md5($sec_id);


$output.='
              <div class="d-flex align-items-center mb-1  justify-content-between  p-2"
                style="background: #7063C6;" id="lectureTab'.$lid.'">
               
                <div class="col-md-6 col-12 f_15 rt_13 fw_600 text-left">
                  <i class="fa fa-book mr-md-2 mr-1 rt_14 plusicon text-white">  </i>
                  <span class="text-white">&nbsp;'.$lname.' </span>
                </div>

                <div class="f_13 rt_13 col-md-6 col-12 text-md-right ">
                    <i class="fa fa-pen mr-md-2 mr-1 rt_14 plusicon text-white cp" 
                      onclick="editLec('.$lid.')"></i>
                    <i class="fa fa-trash mr-md-2 mr-1 rt_14 plusicon text-white cp" 
                      onclick="deleteLec('.$lid.')"></i>
                </div>
              </div>



<div class="inner px-2 py-2 lecturEditBox" id="lecturEditBox'.$lid.'" style="background: #7063C6;" >
  <div class="col-md-12 text-center " > 

              <div class="p-3  my-2 " >
              <div class="form-row">
              <div class="p-md-3 p-2 f_22 fw_700 col-md-12 text-center text-white">
              <i class="fa fa-pen mr-md-2 mr-1 rt_14 plusicon ">  </i> 
              Edit  '.$lname.' Lecture
              </div>

              <div class="form-group col-md-4 mb-2">
              <label for="category" class="fw_700  text-white">Lecture Title</label>
              <input type="text" class="form-control rounded-0 form-control-sm lecTitle2" value="'.$lname.'" >
              </div>

              <div class="form-group col-md-4 mb-2">
              <label for="category" class="fw_700 text-white">Access Type</label>
              <select class="form-control rounded-0 form-control-sm accessType2">
              <option value="'.$access_type.'">'.$access_type.'</option>
              <option value="paid">Paid</option>
              <option value="free">Free</option>
              </select>
              </div>

              <div class="form-group col-md-4 mb-2">
              <label for="category" class="fw_700 text-white">Content</label>
              <select class="form-control rounded-0 form-control-sm fileType2" onchange="fileTypeOpt2('.$lid.')">
              <option value="'.$content_type.'">'.$content_type.'</option>
              <option value="youtube">Youtube Link</option>
              <option value="vimeo">Vimeo Link</option>
              <option value="video">Video</option>
              <option value="pdf">Pdf</option>
              </select>
              </div>

              <div class="form-group col-md-4 mb-2 fileUploadeBox2 youtubeLinkBox2">
              <label for="youtubeLink" class="fw_700 text-white">Youtube Link</label>
              <input type="text" name="youtubeLink"   value="https://www.youtube.com/watch?v='.$v_link.'" class="form-control youtubeLink2">
              </div>

              <div class="form-group col-md-4 mb-2 fileUploadeBox2 vimeoLinkBox2">
                <label for="vimeoLink" class="fw_700 text-white">Vimeo Link</label>
                <input type="text" name="vimeoLink"  value="https://vimeo.com/'.$v_link.'/98989889"  class="form-control vimeoLink2">
              </div>

              <div class="form-group col-md-4 mb-2 fileUploadeBox2 videoFileBox2">
                  <label for="category" class="fw_700 text-white">Upload Video</label>
                  <div class=" col-xs-12">
                    
              ';

if($content_type=='video'){
$output.='
                     <iframe src="'.base_url('/').'assets/course_data/'.$cid.'/'.$secFolder.'/'.$lecid.'/main.mp4" height="200" width="100%" title="Main Video"></iframe> ';
}

$output.='   <span class="">
                       <button class="file-upload-browse btn btn-danger f_14 rt_12 px-2 py-2 " type="button"
                       onclick="triggerVideo2('.$lid.');">Upload Video</button>
                      </span>
                      <input type="file" name="videoFile" class="file-upload-default videoFile2">

                  </div> 
              </div>

              <div class="form-group col-md-4 mb-2 fileUploadeBox2 pdfFileBox2">
                  <label for="category" class="fw_700 text-white">Upload Video</label>
                  <div class=" col-xs-12">
                  ';

if($content_type=='pdf'){
$output.='
                     <iframe src="'.base_url('/').'assets/course_data/'.$cid.'/'.$secFolder.'/'.$lecid.'/main.mp4" height="200" width="100%" title="Main Video"></iframe> 
';
}

$output.='

                     <span class="">
                     <button class="file-upload-browse btn btn-danger f_14 rt_12 px-2" type="button"
                     onclick="triggerVideo2('.$lid.');">Upload Pdf</button>
                     </span>
                     <input type="file" name="pdfFile" class="file-upload-default pdfFile2">

                  </div> 
              </div>

              


                <input type="hidden" value="'.$lid.'" class="form-control lec_id">

              <div class="form-group col-md-4 mb-2">
              <label for="category" class="fw_700 text-white">Duration(minutes)</label>
              <input type="text" class="form-control rounded-0 form-control-sm duration2" 
              value="'.$duration.'" placeholder="Duration">
              </div>

              <div class="text-center col-md-12">
              <button onclick="updateSecLecture('.$lid.')" class="border-0 button_1 mt-3 ml-1 px-2 py-1">
              Update Lecture</button>
              </div>

                <div class="mb-3 col-md-12 my-3 text-center">
                    <span class="text-white  h4 font-weight-bold lecBoxError "></span>
                    <span class="text-white  h4 font-weight-bold lecBoxSuccess "></span>
                </div>

</div>
</div>
</div>

            


              </div>';

  } }                
   
$output.='
          </div>

          <div class="p-3 border my-2 " style="background: #f2f2f2;">
              <div class="form-row">
              <div class="p-md-3 p-2 f_22 fw_700 col-md-12 text-center">
              <i class="fa fa-plus mr-md-2 mr-1 rt_14 plusicon text-dark">  </i> Add More Lecture
              </div>

              <div class="form-group col-md-4 mb-2">
              <label for="category" class="fw_700">Lecture Title</label>
              <input type="text" class="form-control rounded-0 form-control-sm lecTitle">
              </div>

              <div class="form-group col-md-4 mb-2">
              <label for="category" class="fw_700">Access Type</label>
              <select class="form-control rounded-0 form-control-sm accessType">
              <option value="paid">Paid</option>
              <option value="free">Free</option>
              </select>
              </div>

              <div class="form-group col-md-4 mb-2">
              <label for="category" class="fw_700">Content</label>
              <select class="form-control rounded-0 form-control-sm fileType" onchange="fileTypeOpt('.$id.')">
              <option value="youtube">Youtube Link</option>
              <option value="vimeo">Vimeo Link</option>
              <option value="video">Video</option>
              <option value="pdf">Pdf</option>
              </select>
              </div>
             


              <div class="form-group col-md-4 mb-2 fileUploadeBox youtubeLinkBox">
              <label for="youtubeLink" class="fw_700">Youtube Link</label>
              <input type="text" name="youtubeLink" class="form-control youtubeLink">
              </div>


              <div class="form-group col-md-4 mb-2 fileUploadeBox vimeoLinkBox">
                <label for="vimeoLink" class="fw_700">Vimeo Link</label>
                <input type="text" name="vimeoLink" class="form-control vimeoLink">
              </div>


               <div class="form-group col-md-4 mb-2 fileUploadeBox videoFileBox">
                  <label for="category" class="fw_700">Upload Video</label>
                  <input type="file" name="videoFile" class="file-upload-default videoFile">
                  <div class="input-group col-xs-12">
                  <span class="input-group-append">
                  <button class="file-upload-browse button_2 f_14 rt_12 px-2" type="button"
                   onclick="triggerVideo('.$id.');">Upload</button>
                  </span>
                  <input type="text" class="form-control form-control-sm rounded-0 file-upload-info" disabled placeholder="Upload Image">
                  </div> 
              </div>

               <div class="form-group col-md-4 mb-2 fileUploadeBox pdfFileBox">
                <label for="category" class="fw_700">Choose PDF Files</label>
                <input type="file" name="pdfFile" class="file-upload-default pdfFile">
                <div class="input-group col-xs-12">
                <span class="input-group-append">
                <button class="file-upload-browse button_2 f_14 rt_12 px-2" type="button"
                onclick="triggerVideo('.$id.');">Upload</button>
                </span>
                <input type="text" class="form-control form-control-sm rounded-0 file-upload-info" disabled placeholder="Upload Image">
                </div> 
              </div>

                <input type="hidden" value="'.$sec_id.'" class="form-control section_id">


              <div class="form-group col-md-4 mb-2">
              <label for="category" class="fw_700">Duration(minutes)</label>
              <input type="text" class="form-control rounded-0 form-control-sm duration" placeholder="Duration">
              </div>

              <div class="text-center col-md-12">
              <button onclick="addSecLecture('.$id.')" class="border-0 button_1 mt-3 ml-1 px-2 py-1">Add Lecture</button>
              </div>

                <div class="mb-3 col-md-12 text-center my-3">
                    <span class="text-danger  h4 font-weight-bold lecBoxError "></span>
                    <span class="text-success  h4 font-weight-bold lecBoxSuccess "></span>
                </div>

              </div>

              </div>
        </div>
              
  </li>';

} }


  echo $output; die();


}



function addSectionLec(){

        if($_SESSION['auth_teacher_id'] ){

          $image=$_FILES['file']['name'];
          $image_tmp=$_FILES['file']['tmp_name'];
          $image_type=$_FILES['file']['type'];
          $exp=explode('/', $image_type);

        
// var_dump($_POST); die();

        if(!$image){

               $data = array(
                    'section_id' => trim(filter_var($_POST['section_id'],FILTER_SANITIZE_STRING)),
                    'lecTitle' => trim(filter_var($_POST['lecTitle'],FILTER_SANITIZE_STRING)),
                    'accessType' => trim(filter_var($_POST['accessType'],FILTER_SANITIZE_STRING)),
                    'fileType' => trim(filter_var($_POST['fileType'],FILTER_SANITIZE_STRING)),
                    'duration' => trim(filter_var($_POST['duration'],FILTER_SANITIZE_STRING)),
                    'link' => trim(filter_var($_POST['link'],FILTER_SANITIZE_STRING)),
                );

             }else{


            if($exp[1] != 'mp4' and  $exp[1] != 'pdf'  ){ echo "Only Mp4 or Pdf is allowed"; die();}


               $data = array(
                    'section_id' => trim(filter_var($_POST['section_id'],FILTER_SANITIZE_STRING)),
                    'lecTitle' => trim(filter_var($_POST['lecTitle'],FILTER_SANITIZE_STRING)),
                    'accessType' => trim(filter_var($_POST['accessType'],FILTER_SANITIZE_STRING)),
                    'fileType' => trim(filter_var($_POST['fileType'],FILTER_SANITIZE_STRING)),
                    'duration' => trim(filter_var($_POST['duration'],FILTER_SANITIZE_STRING)),
                    'link' => trim(filter_var($_POST['link'],FILTER_SANITIZE_STRING)),
                    'image' => $image,
                    'image_tmp' => $image_tmp,
                );

              }

              // var_dump($data); die();

              $response = $this->Admin->addSectionLec($data); 
              
              var_dump($response); die();

        }else{ echo "Invalid Access"; die(); }

}


function updateSecLecture(){

        if($_SESSION['auth_teacher_id'] ){

          $image=$_FILES['file']['name'];
          $image_tmp=$_FILES['file']['tmp_name'];
          $image_type=$_FILES['file']['type'];
          $exp=explode('/', $image_type);

        
        // var_dump($_POST); die();

        if(!$image){

               $data = array(
                    'lec_id' => trim(filter_var($_POST['lec_id'],FILTER_SANITIZE_STRING)),
                    'lecTitle' => trim(filter_var($_POST['lecTitle'],FILTER_SANITIZE_STRING)),
                    'accessType' => trim(filter_var($_POST['accessType'],FILTER_SANITIZE_STRING)),
                    'fileType' => trim(filter_var($_POST['fileType'],FILTER_SANITIZE_STRING)),
                    'duration' => trim(filter_var($_POST['duration'],FILTER_SANITIZE_STRING)),
                    'link' => trim(filter_var($_POST['link'],FILTER_SANITIZE_STRING)),
                );

             }else{


            if($exp[1] != 'mp4' and  $exp[1] != 'pdf'  ){ echo "Only Mp4 or Pdf is allowed"; die();}


               $data = array(
                    'lec_id' => trim(filter_var($_POST['lec_id'],FILTER_SANITIZE_STRING)),
                    'lecTitle' => trim(filter_var($_POST['lecTitle'],FILTER_SANITIZE_STRING)),
                    'accessType' => trim(filter_var($_POST['accessType'],FILTER_SANITIZE_STRING)),
                    'fileType' => trim(filter_var($_POST['fileType'],FILTER_SANITIZE_STRING)),
                    'duration' => trim(filter_var($_POST['duration'],FILTER_SANITIZE_STRING)),
                    'link' => trim(filter_var($_POST['link'],FILTER_SANITIZE_STRING)),
                    'image' => $image,
                    'image_tmp' => $image_tmp,
                );

              }

              // var_dump($data); die();

              $response = $this->Admin->updateSecLecture($data); 
              
              var_dump($response); die();

        }else{ echo "Invalid Access"; die(); }

}





// =========All==Lecture==Data====

function getAllLectureList(){

      $section_id=$_POST['section_id'];

      $cid=$_SESSION['current_course_id'];

      $output='';

      $getLec=$this->Admin->get_section_lec($cid,'course_content_lecture',$section_id); 

// var_dump($getLec);

if($getLec){ foreach ($getLec as $lec ) { $lname=$lec['lecture_name'];
          $lname=$lec['lecture_name'];
          $lid=$lec['id'];
          $sec_id=$lec['section_id'];
          $content_type=$lec['content_type'];
          $access_type=$lec['access_type'];
          $v_link=$lec['v_link'];
          $duration=$lec['duration'];
          $lecid=$lec['lec_id'];

          $secFolder=md5($sec_id);


$output.='
              <div class="d-flex align-items-center mb-1  justify-content-between  p-2"
                style="background: #7063C6;" id="lectureTab'.$lid.'">
               
                <div class="col-md-6 col-12 f_15 rt_13 fw_600 text-left">
                  <i class="fa fa-book mr-md-2 mr-1 rt_14 plusicon text-white">  </i>
                  <span class="text-white">&nbsp;'.$lname.' </span>
                </div>

                <div class="f_13 rt_13 col-md-6 col-12 text-md-right ">
                    <i class="fa fa-pen mr-md-2 mr-1 rt_14 plusicon text-white cp" 
                      onclick="editLec('.$lid.')"></i>
                    <i class="fa fa-trash mr-md-2 mr-1 rt_14 plusicon text-white cp" 
                      onclick="deleteLec('.$lid.')"></i>
                </div>
              </div>



<div class="inner px-2 py-2 lecturEditBox" id="lecturEditBox'.$lid.'" style="background: #7063C6;" >
  <div class="col-md-12 text-center " > 

              <div class="p-3  my-2 " >
              <div class="form-row">
              <div class="p-md-3 p-2 f_22 fw_700 col-md-12 text-center text-white">
              <i class="fa fa-pen mr-md-2 mr-1 rt_14 plusicon ">  </i> 
              Edit  '.$lname.' Lecture
              </div>

              <div class="form-group col-md-4 mb-2">
              <label for="category" class="fw_700  text-white">Lecture Title</label>
              <input type="text" class="form-control rounded-0 form-control-sm lecTitle2" value="'.$lname.'" >
              </div>

              <div class="form-group col-md-4 mb-2">
              <label for="category" class="fw_700 text-white">Access Type</label>
              <select class="form-control rounded-0 form-control-sm accessType2">
              <option value="'.$access_type.'">'.$access_type.'</option>
              <option value="paid">Paid</option>
              <option value="free">Free</option>
              </select>
              </div>

              <div class="form-group col-md-4 mb-2">
              <label for="category" class="fw_700 text-white">Content</label>
              <select class="form-control rounded-0 form-control-sm fileType2" onchange="fileTypeOpt2('.$lid.')">
              <option value="'.$content_type.'">'.$content_type.'</option>
              <option value="youtube">Youtube Link</option>
              <option value="vimeo">Vimeo Link</option>
              <option value="video">Video</option>
              <option value="pdf">Pdf</option>
              </select>
              </div>

              <div class="form-group col-md-4 mb-2 fileUploadeBox2 youtubeLinkBox2">
              <label for="youtubeLink" class="fw_700 text-white">Youtube Link</label>
              <input type="text" name="youtubeLink"   value="https://www.youtube.com/watch?v='.$v_link.'" class="form-control youtubeLink2">
              </div>

              <div class="form-group col-md-4 mb-2 fileUploadeBox2 vimeoLinkBox2">
                <label for="vimeoLink" class="fw_700 text-white">Vimeo Link</label>
                <input type="text" name="vimeoLink"  value="https://vimeo.com/'.$v_link.'/98989889"  class="form-control vimeoLink2">
              </div>

              <div class="form-group col-md-4 mb-2 fileUploadeBox2 videoFileBox2">
                  <label for="category" class="fw_700 text-white">Upload Video</label>
                  <div class=" col-xs-12">
                    
              ';

if($content_type=='video'){
$output.='
                     <iframe src="'.base_url('/').'assets/course_data/'.$cid.'/'.$secFolder.'/'.$lecid.'/main.mp4" height="200" width="100%" title="Main Video"></iframe> ';
}

$output.='   <span class="">
                       <button class="file-upload-browse btn btn-danger f_14 rt_12 px-2 py-2 " type="button"
                       onclick="triggerVideo2('.$lid.');">Upload Video</button>
                      </span>
                      <input type="file" name="videoFile" class="file-upload-default videoFile2">

                  </div> 
              </div>

              <div class="form-group col-md-4 mb-2 fileUploadeBox2 pdfFileBox2">
                  <label for="category" class="fw_700 text-white">Upload Video</label>
                  <div class=" col-xs-12">
                  ';

if($content_type=='pdf'){
$output.='
                     <iframe src="'.base_url('/').'assets/course_data/'.$cid.'/'.$secFolder.'/'.$lecid.'/main.mp4" height="200" width="100%" title="Main Video"></iframe> 
';
}

$output.='

                     <span class="">
                     <button class="file-upload-browse btn btn-danger f_14 rt_12 px-2" type="button"
                     onclick="triggerVideo2('.$lid.');">Upload Pdf</button>
                     </span>
                     <input type="file" name="pdfFile" class="file-upload-default pdfFile2">

                  </div> 
              </div>

              


                <input type="hidden" value="'.$lid.'" class="form-control lec_id">

              <div class="form-group col-md-4 mb-2">
              <label for="category" class="fw_700 text-white">Duration(minutes)</label>
              <input type="text" class="form-control rounded-0 form-control-sm duration2" 
              value="'.$duration.'" placeholder="Duration">
              </div>

              <div class="text-center col-md-12">
              <button onclick="updateSecLecture('.$lid.')" class="border-0 button_1 mt-3 ml-1 px-2 py-1">
              Update Lecture</button>
              </div>

                <div class="mb-3 col-md-12 my-3 text-center">
                    <span class="text-danger  h4 font-weight-bold lecBoxError "></span>
                    <span class="text-white  h4 font-weight-bold lecBoxSuccess "></span>
                </div>

</div>
</div>
</div>

            


              </div>';

  } }   

  echo $output; die();

}





// =================== Coupons =======


  public function addCoupon()
      { 
       if(!empty($_POST['couponTitle']) and $_SESSION['auth_teacher_id'] ){

              $data = array(
                    'couponTitle' => strtoupper(trim(filter_var($_POST['couponTitle'],FILTER_SANITIZE_STRING))),
                    'start_date' => trim(filter_var($_POST['start_date'],FILTER_SANITIZE_STRING)),
                    'exp_date' => trim(filter_var($_POST['exp_date'],FILTER_SANITIZE_STRING)),
                    'discount' => trim(filter_var($_POST['discount'],FILTER_SANITIZE_NUMBER_INT)),
                );
              $response = $this->Admin->addCoupon($data); 
              
              var_dump($response); die();

          if($response){  echo $response; die(); }
        }else{ echo "Invalid Access"; die(); }
          
}


public function getAllCoupon()
       { 
          $response = $this->Admin->getAllCoupon();
          $output='';

foreach ($response as $key ) {
  $coupon_code=$key['coupon_code'];
  $start_date=$key['start_date'];
  $exp_date=$key['exp_date'];
  $discount=$key['discount'];

  $coupon_id=$key['coupon_id'];
  $couponid=$key['id'];


      
      $output.='
              <div class="d-flex align-items-center mb-1  justify-content-between  p-2"
                style="background: #5D605F;" id="couponCodeTab'.$couponid.'">
               
                <div class="col-md-6 col-12 f_15 rt_13 fw_600 text-left">
                  <i class="fa fa-gift mr-md-2 mr-1 rt_14 plusicon text-white">  </i>
                  <span class="text-white">&nbsp;'.$coupon_code.' </span>
                </div>

                <div class="f_13 rt_13 col-md-6 col-12 text-md-right ">
                    <i class="fa fa-pen mr-md-2 mr-1 rt_14 plusicon text-white cp" 
                      onclick="editCouponCode('.$couponid.')"></i>
                    <i class="fa fa-trash mr-md-2 mr-1 rt_14 plusicon text-white cp" 
                      onclick="deleteCouponCode('.$couponid.')"></i>
                </div>
              </div>



<div class="inner px-2 py-2 CouponCodeEditBox" id="CouponCodeEditBox'.$couponid.'" 
style="background:#f7f7f7;" >
  <div class="col-md-12 text-center " > 

              <div class="p-3  my-2 " >
              <div class="form-row">
              <div class="p-md-3 p-2 f_22 fw_700 col-md-12 text-center text-dark">
              <i class="fa fa-pen mr-md-2 mr-1 rt_14 plusicon ">  </i> 
              Edit  Coupon : '.$coupon_code.' 
              </div>

              <div class="form-group col-md-4 mb-2">
              <label for="category" class="fw_700  text-dark">Coupon Code</label>
              <input type="text" class="form-control rounded-0 form-control-sm coupon_code" value="'.$coupon_code.'" >
              </div>

              <div class="form-group col-md-4 mb-2">
              <label for="category" class="fw_700  text-dark">Start Date</label>
              <input type="text" class="form-control rounded-0 form-control-sm start_date" value="'.$start_date.'" >
              </div>

              <div class="form-group col-md-4 mb-2">
              <label for="category" class="fw_700  text-dark">Expiry Date</label>
              <input type="text" class="form-control rounded-0 form-control-sm exp_date" value="'.$exp_date.'" >
              </div>

              <div class="form-group col-md-4 mb-2">
              <label for="category" class="fw_700  text-dark">Discount %</label>
              <input type="text" class="form-control rounded-0 form-control-sm discount" value="'.$discount.'" >
              </div>

               

              <input type="hidden" value="'.$lid.'" class="form-control lec_id">

              
              <div class="text-center col-md-12">
              <button onclick="updateCouponCode('.$couponid.')" class="border-0 button_1 mt-3 ml-1 px-2 py-1">
              Update Coupon</button>
              </div>

                <div class="mb-3 col-md-12 my-3 text-center">
                    <span class="text-danger  h4 font-weight-bold couponError "></span>
                    <span class="text-success  h4 font-weight-bold couponSuccess "></span>
                </div>

</div>
</div>
</div>

            


              </div>';

  } 

      echo $output; die();

}





function updateCouponCode(){

        if($_SESSION['auth_teacher_id'] ){

               $data = array(
                    'coupon_code' => trim(filter_var($_POST['coupon_code'],FILTER_SANITIZE_STRING)),
                    'start_date' => trim(filter_var($_POST['start_date'],FILTER_SANITIZE_STRING)),
                    'exp_date' => trim(filter_var($_POST['exp_date'],FILTER_SANITIZE_STRING)),
                    'discount' => trim(filter_var($_POST['discount'],FILTER_SANITIZE_STRING)),
                    'coupon_id' => trim(filter_var($_POST['coupon_id'],FILTER_SANITIZE_STRING)),
                );

              $response = $this->Admin->updateCouponCode($data); 
              
              var_dump($response); die();

        }else{ echo "Invalid Access"; die(); }

}



// ===============Send Course to admin============

public function sendCourseToAdmin()
       { 

        if($_SESSION['auth_teacher_id']  and $_SESSION['current_course_id'] ){

              $response = $this->Admin->sentCoursetoAdmin(); 
              
        }else{ echo "Invalid Access"; die(); }

  }





public function addAnnounc()
      { 
        $image_tmp=$_FILES['post_image']['tmp_name'];
        $image_type=$_FILES['post_image']['type'];

        $course_id=filter_var($_POST['course_id'],FILTER_SANITIZE_STRING);
        $content=filter_var($_POST['content'],FILTER_SANITIZE_STRING);

        $exp=explode('/', $image_type);


        
        if($exp[1] != 'png' and  $exp[1] != 'jpg' and $exp[1] != 'jpeg' ){ 
          echo "Only Png, jpg and Jpeg allowed"; die();}


           $data = array(
                    'course_id' => $course_id,
                    'content' => $content,
                    'type' => $type,
                    'ext' => $exp[1],
                    'image_tmp' => $image_tmp,
                );

          $response = $this->Admin->addAnnounc($data); 

          echo $response; die();          
}



public function updateAnnounc()
      { 
        $image_tmp=$_FILES['posted_image']['tmp_name'];
        $image_type=$_FILES['posted_image']['type'];

        $course_id=filter_var($_POST['course_id'],FILTER_SANITIZE_STRING);
        $content=filter_var($_POST['content'],FILTER_SANITIZE_STRING);

        $exp=explode('/', $image_type);

        if($image_tmp)
        {
        if($exp[1] != 'png' and  $exp[1] != 'jpg' and $exp[1] != 'jpeg' ){ 
          echo "Only Png, jpg and Jpeg allowed"; die();}


           $data = array(
                    'course_id' => $course_id,
                    'content' => $content,
                    'type' => $type,
                    'ext' => $exp[1],
                    'image_tmp' => $image_tmp,
                );

         }else{

                 $data = array(
                    'course_id' => $course_id,
                    'content' => $content,
                );

         }

          $response = $this->Admin->updateAnnounc($data); 

          echo $response; die();          
}







// =================Delete  Functions=============





function deleteSecBox(){

      $sid=filter_var($_POST['sid'], FILTER_SANITIZE_NUMBER_INT);

      $response=$this->Admin->deleteSecBox($sid,'course_content'); 

      if($response=='deleted'){ echo "deleted"; die(); }else{ echo "invalid"; die(); }

}




function deleteSecLec(){

      $id=filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

      $response=$this->Admin->deleteSecLec($id,'course_content_lecture'); 

      if($response=='deleted'){ echo "deleted"; die(); }else{ echo "invalid"; die(); }

}



function deleteCouponCode(){

      $coupon_id=filter_var($_POST['coupon_id'], FILTER_SANITIZE_NUMBER_INT);

      $response=$this->Admin->deleteCouponCode($coupon_id,'course_coupon'); 

      if($response=='deleted'){ echo "deleted"; die(); }else{ echo "invalid"; die(); }

}


function deleteAnnounc(){

      $id=filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

      $response=$this->Admin->deleteAnnounc($id); 

      if($response=='deleted'){ echo "deleted"; die(); }else{ echo "invalid"; die(); }

}














       public function logout()
       { 
          unset($_SESSION['teacherToken']);
          unset($_SESSION['otpToken']);
          unset($_SESSION['temp_type']);
          unset($_SESSION['auth_login_unboxskills_teacher']);
          unset($_SESSION['login_token']);

          Utils::no_cache();
          redirect(base_url());
       }



}

