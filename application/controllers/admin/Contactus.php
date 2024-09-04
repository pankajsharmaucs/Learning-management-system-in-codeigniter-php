<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contactus extends CI_Controller
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
    $data['get_contactaddr']=$this->Common_model->GetData('contact_setting','','','',"");
         $data['session_user']=$this->session->userdata('admin_in');
        if (!($data['session_user']['usergroup']=="ADMIN")) {
            redirect(base_url('admin/dashboard'));
        }
        $data['title'] = 'Admin|Contact US';
        $data['menu'] = 'contactus';
       $this->load->view('admin/inc/header', $data, false);
        $this->load->view('admin/manage_website/contact_address', $data, false);
      //  $this->load->view('admin/DA/ocr_detail');
        $this->load->view('admin/inc/footer', $data, false);
   }
    public function add_contactaddr()
   {
     $data = array();
        $this->load->model('Crud_model');
        $data['message'] = $this->Crud_model->add('contact_setting');
        echo json_encode($data);
   }
   public function get_value()
  {
    $get_data=$this->Common_model->get_single('contact_setting',"id='".$_POST['id']."'");
    $data=array(
      'id'=>$get_data->id,
      'company_name'=>$get_data->company_name,
      'phone'=>$get_data->phone,
      'email'=>$get_data->email,
      'address'=>$get_data->address,
    );
    echo json_encode($data);exit;
  }

 public function update_contactaddr()
  {
    $id=$_POST['id'];
       $data = array();
        $this->load->model('Crud_model');
        $data['message'] = $this->Crud_model->update('contact_setting',$id);
        echo json_encode($data);
  }

   public function delete($id)
    {
           $this->Common_model->DeleteData('contact_setting',"id='".$id."'");
           redirect(base_url('admin/Contactus'));
    }
}
