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

class ADashboard_e extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    // ===================Auto==search=======
    public function index()
    {    
        $data['title'] = ' Admin Dashboard  | KreditAid';
        $this->load->view('admin_dashboard_e/user_header_b', $data, false);
        $this->load->view('admin_dashboard_e/dashboard');
        // $this->load->view('admin_dashboard_e/admin_footer', $data, false);
    }

    // =================Create-=====Pro==user=====
     public function CreateProUser()
    {
        if(isset($_SESSION['auth_admin']))
        {

            $name = trim(filter_var($this->input->get_post('name'),FILTER_SANITIZE_STRING));
            $email = trim(filter_var($this->input->get_post('email'),FILTER_SANITIZE_EMAIL));
            $pass = trim(filter_var($this->input->get_post('pass'),FILTER_SANITIZE_STRING));
            $empRole = trim(filter_var($this->input->get_post('empRole'),FILTER_SANITIZE_STRING));

            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {}else{ echo "Invalid Email"; die(); }
            
             $password = Utils::hash('sha1', $pass, AUTH_SALT); 
            $res = $this->Admin_dashboard->getExistProductionUsers($email);

            if($res){ echo "already"; die(); }else{

                        date_default_timezone_set("Asia/Kolkata");
                        $cdate=date('d-m-Y H:i');

                        $data = ['username'=>$name,'assign_to'=>$empRole,'password'=>$password
                        ,'email'=>$email,'usergroup'=>'PU','reg_date'=>$cdate ];
                        $res = $this->db->insert('admin',$data);

                        if($res){ echo "Inserted"; die();}else{ echo "no"; die(); }

            }
               
        }    
    }
   


}

