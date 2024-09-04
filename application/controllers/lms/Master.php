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

class Master extends CI_Controller
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

          $data['title'] = ' Master Dashboard   | Unboxskills';
          $this->load->view('Master/header', $data, false);
          $this->load->view('Master/sidebar', $data, false);
          $this->load->view('Master/index' );
          $this->load->view('Master/footer', $data, false);
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


}

