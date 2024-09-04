<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        Utils::no_cache();
        $this->load->model('Common_model');
    }

    public function login()
    {
        $data['title'] = 'Home';
        $this->load->view('admin/login', $data, false);
        $this->load->view('admin/inc/footer', $data, false);
    }

    public function login_Control()
    {
        $data = array();
        $this->load->model('Auth_model');
        $data['message'] = $this->Auth_model->admin_login();
        echo json_encode($data);
    }
    public function register()
    {
      $data = array();
      $this->load->model('Auth_model');
      $data['message'] = $this->Auth_model->admin_register();
      echo json_encode($data);

    }
    function admin_update_profile()
    {
    //  print_r($_FILES); exit;
        $this->load->model('Common_model');
      $id=$_POST['id'];
      if(isset($_FILES['profile']['name'])!='' )
               {
                 $data['file_name']= rand(0000,9999)."_".$_FILES['profile']['name'];

                 $target_path = "./upload/blog/";
                 $target_path = $target_path.basename($data['file_name']);
                 if(move_uploaded_file($_FILES['profile']['tmp_name'], $target_path))
                 {
                  // $data['message']['file']="Uploaded";
                    $image  = $data['file_name'];
                      @unlink("upload/blog/".$_POST['old_image']);
                   //echo json_encode($data['message']);
                 }
                 else{
                   $data['message']['file']="system_error";
                   echo json_encode($data['message']);
                 }

               }
               else
               {
                 $image  = $_POST['old_image'];
               }

                 if(isset($_FILES['stamp']['name'])!='')
               {
                 $data['file_name']= rand(0000,9999)."_".$_FILES['stamp']['name'];

                 $target_path1 = "./upload/blog/";
                 $target_path1 = $target_path1.basename($data['file_name']);
                 if(move_uploaded_file($_FILES['stamp']['tmp_name'], $target_path1))
                 {
                  // $data['message']['file']="Uploaded";
                    $stamp  = $data['file_name'];
                      @unlink("upload/blog/".$_POST['old_stamp']);
                   //echo json_encode($data['message']);
                 }
                 else{
                   $data['message']['file']="system_error";
                   echo json_encode($data['message']);
                 }

               }
               else
               {
                 $stamp  = $_POST['old_stamp'];
               }

          $data = array(
                      'username' =>ucfirst($this->input->post('username',TRUE)),
                       'day' =>$this->input->post('day'),
                        'reportdays' =>$this->input->post('reportdays'),
                       'profile' =>$image,
                        'stamp' =>$stamp,
                      );
          $this->Common_model->SaveData('admin',$data,"id='".$id."'");
          echo "1"; exit;
    }


 public function changePassword()
    {
        $this->load->model('Auth_model');
        $data = array();
        $data['session_user']=$this->session->userdata('logged_in');
        $get_user=$this->Common_model->get_single('admin',"id='".$data['session_user']['id']."'");
        $password=Utils::hash('sha1',$this->input->post('password'), AUTH_SALT);
        if($get_user->password==$password)
        {
          $data['message'] = $this->Auth_model->adminchangePassword($data['session_user']['id']);
        }
        else{
          $data['message']='correct_pass';
        }

        echo json_encode($data);
    }
    function production_update_profile()
    {
        $this->load->model('Common_model');
      $id=$_POST['id'];
      if(isset($_FILES['profile']['name'])!='' )
               {
                 $data['file_name']= rand(0000,9999)."_".$_FILES['profile']['name'];

                 $target_path = "./upload/blog/";
                 $target_path = $target_path.basename($data['file_name']);
                 if(move_uploaded_file($_FILES['profile']['tmp_name'], $target_path))
                 {
                  // $data['message']['file']="Uploaded";
                    $image  = $data['file_name'];
                      @unlink("upload/blog/".$_POST['old_image']);
                   //echo json_encode($data['message']);
                 }
                 else{
                   $data['message']['file']="system_error";
                   echo json_encode($data['message']);
                 }

               }
               else
               {
                 $image  = $_POST['old_image'];
               }
          $data = array(
                      'username' =>ucfirst($this->input->post('username',TRUE)),
                       'profile' =>$image,
                      );
          $this->Common_model->SaveData('admin',$data,"id='".$id."'");
          echo "1"; exit;
    }
   function save_super_admin()
    {
      $password = Utils::hash('sha1', $this->input->post('password'), AUTH_SALT);
      $super_admin = array(
                  'username' =>ucfirst($_POST['username']),
                  'email' =>$_POST['email'],
                  'password' =>$password,
                  'assign_to' =>json_encode('Admin'),
                 'usergroup' =>'ADMIN',
                  );
      $this->Common_model->SaveData('admin',$super_admin);
      echo "1"; exit;
    }
    function filter_production_user()
    {
      $username1=$_POST['username1'];
      $con="1=1";
      $con.= " and username LIKE '%".$username1."%'";
      $data['Admins']=$this->Common_model->GetData('admin','',$con);
      $this->load->view('admin/components/admindata', $data);
    }
}
