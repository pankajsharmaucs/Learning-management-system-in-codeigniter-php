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



class Student extends CI_Controller
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
          $data['title'] = ' Student Dashboard   | Unboxskills';
          $data['pagename'] = 'dashboard';
          $this->load->view('student/header'    , $data, false);
          $this->load->view('student/index', $data, false);
          $this->load->view('student/footer'    , $data, false);
       }


// ===================Get==my Course=======
    public function getMyCourse()
       { 
          // echo "All Course"; die();
          $data['title'] = ' My Course   | Unboxskills';
          $data['pagename'] = 'mycourse';
          $this->load->view('student/header', $data, false);
          $this->load->view('student/my_course');
          $this->load->view('student/footer', $data, false);
       }

// ===================player=========
    public function player($cid)
       { 

          $data['title'] = ' Student Course Player   | Unboxskills';
          $data['pagename'] = 'player';
          $data['course_id'] = $cid;

          $this->load->view('student/header_player', $data, false);
          $this->load->view('student/my_course_view' );
          $this->load->view('student/footer', $data, false);
       }


   public function createNotes()
      { 

       if(!empty($_POST['MyNotes']) and !empty($_POST['currentTopic']) and $_SESSION['auth_unboxskills_student_email'] ){
 
           $MyNotes = preg_replace('/[^A-Za-z0-9\-]/', ' ', $_POST['MyNotes']);
            $currentTopic = preg_replace('/[^A-Za-z0-9\-]/', ' ', $_POST['currentTopic']);

              $data = array(
                    'MyNotes' => trim(filter_var($MyNotes,FILTER_SANITIZE_STRING)),
                    'currentTopic' => trim(filter_var($currentTopic,FILTER_SANITIZE_STRING)),
                );

              $response = $this->Admin->createNotes($data); 

          if($response){  echo $response; die(); }

        }else{ echo "Invalid Access"; die(); }
          
   }




public function courseRating()
  { 

       if(!empty($_POST['rating']) and $_SESSION['auth_unboxskills_student_email'] ){
              $rating = filter_var($_POST['rating'], FILTER_SANITIZE_NUMBER_INT);
              
              $data = array(
                    'rating' => trim(filter_var($rating,FILTER_SANITIZE_STRING)),
              );

              $response = $this->Admin->createRating($data); 

          if($response){  echo $response; die(); }
        }else{ echo "Invalid Access"; die(); }
          
  }







public function courseTracking()
  { 

       if(!empty($_POST['sec_id']) and !empty($_POST['lec_id']) and $_SESSION['auth_unboxskills_student_email'] ){
              $sec_id = filter_var($_POST['sec_id'], FILTER_SANITIZE_STRING);
              $lec_id = filter_var($_POST['lec_id'], FILTER_SANITIZE_STRING);
              
              $data = array( 'sec_id' => $sec_id,'lec_id' => $lec_id );


              $response = $this->Admin->courseTracking($data); 

              // var_dump($response); die();

          if($response){  echo $response; die(); }
        }else{ echo "Invalid Access"; die(); }
          
  }






  public function logout()
    { 
          session_destroy();
          redirect(base_url());
    }



}

