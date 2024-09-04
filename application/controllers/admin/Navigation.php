<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Navigation extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        Utils::no_cache();
         $this->load->model('Common_model');
          $this->load->library(array('session','form_validation','image_lib'));
    }

   public function index()
   {
    $data['get_header']=$this->Common_model->GetData('header_menu','','','',"");
         $data['session_user']=$this->session->userdata('admin_in');
        if (!($data['session_user']['usergroup']=="ADMIN")) {
            redirect(base_url('admin/dashboard'));
        }
        $data['title'] = 'Admin Navigation';
        $data['menu'] = 'header_menu';
        $data['submenu'] = 'manage_web';

       $this->load->view('admin/inc/header', $data, false);
        $this->load->view('admin/navigation/header_menu', $data, false);
        $this->load->view('admin/inc/footer', $data, false); 
   }
    
   public function add_header_menu()
   {
     $data = array();
        $this->load->model('Crud_model');
        $data['message'] = $this->Crud_model->add('header_menu');
        echo json_encode($data);
   }
 public function get_value()
  {
    $get_data=$this->Common_model->get_single('header_menu',"id='".$_POST['id']."'");
    $data=array(
      'id'=>$get_data->id,
      'menu'=>$get_data->menu,
      'sub_menu'=>$get_data->sub_menu,
      'url'=>$get_data->url,
    );
    echo json_encode($data);exit;
  }
   public function update_header_menu()
  {
    $id=$_POST['id'];
       $data = array();
        $this->load->model('Crud_model');
        $data['message'] = $this->Crud_model->update('header_menu',$id);
        echo json_encode($data);
  }
  public function delete($id)
    {   
           $this->Common_model->DeleteData('header_menu',"id='".$id."'");
           redirect(base_url('admin/Navigation'));
    }

     public function footer_left_menu()
   {
    $data['get_left_menu']=$this->Common_model->GetData('footer_left_menu','','','',"");
         $data['session_user']=$this->session->userdata('admin_in');
        if (!($data['session_user']['usergroup']=="ADMIN")) {
            redirect(base_url('admin/dashboard'));
        }
        $data['title'] = 'Admin Navigation';
        $data['menu'] = 'footer_left_menu';
          $data['submenu'] = 'manage_web';
       $this->load->view('admin/inc/header', $data, false);
        $this->load->view('admin/navigation/footer_left_menu', $data, false);
        $this->load->view('admin/inc/footer', $data, false); 
   }
   public function add_footer_left_menu()
   {
     $data = array();
        $this->load->model('Crud_model');
        $data['message'] = $this->Crud_model->add('footer_left_menu');
        echo json_encode($data);
   }
   public function get_footer_left_menu()
  {
    $get_data=$this->Common_model->get_single('footer_left_menu',"id='".$_POST['id']."'");
    $data=array(
      'id'=>$get_data->id,
      'menu'=>$get_data->menu,
      'url'=>$get_data->url,
    );
    echo json_encode($data);exit;
  }
   public function update_left_menu()
  {
       $id=$_POST['id'];
       $data = array();
        $this->load->model('Crud_model');
        $data['message'] = $this->Crud_model->update('footer_left_menu',$id);
        echo json_encode($data);
  }
  public function delete_left_menu($id)
    {   
           $this->Common_model->DeleteData('footer_left_menu',"id='".$id."'");
           redirect(base_url('admin/Navigation/footer_left_menu'));
    }
    public function footer_right_menu()
   {
    $data['get_right_menu']=$this->Common_model->GetData('footer_right_menu','','','',"");
         $data['session_user']=$this->session->userdata('admin_in');
        if (!($data['session_user']['usergroup']=="ADMIN")) {
            redirect(base_url('admin/dashboard'));  
        }
        $data['title'] = 'Admin Navigation';
        $data['menu'] = 'footer_right_menu';
          $data['submenu'] = 'manage_web';
       $this->load->view('admin/inc/header', $data, false);
        $this->load->view('admin/navigation/footer_right_menu', $data, false);
        $this->load->view('admin/inc/footer', $data, false); 
   }
   public function add_footer_right_menu()
   {
     $data = array();
        $this->load->model('Crud_model');
        $data['message'] = $this->Crud_model->add('footer_right_menu');
        echo json_encode($data);
   }
   public function get_footer_right_menu()
  {
    $get_data=$this->Common_model->get_single('footer_right_menu',"id='".$_POST['id']."'");
    $data=array(
      'id'=>$get_data->id,
      'menu'=>$get_data->menu,
      'url'=>$get_data->url,
    );
    echo json_encode($data);exit;
  }
   public function update_right_menu()
  {
       $id=$_POST['id'];
       $data = array();
        $this->load->model('Crud_model');
        $data['message'] = $this->Crud_model->update('footer_right_menu',$id);
        echo json_encode($data);
  }
  public function delete_right_menu($id)
    {   
           $this->Common_model->DeleteData('footer_right_menu',"id='".$id."'");
           redirect(base_url('admin/Navigation/footer_right_menu'));
    }
}
