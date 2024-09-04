<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Footer extends CI_Controller
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
    $data['get_footer']=$this->Common_model->GetData('footer','','','',"");
         $data['session_user']=$this->session->userdata('admin_in');
        if (!($data['session_user']['usergroup']=="ADMIN")) {
            redirect(base_url('admin/dashboard'));
        }
        $data['title'] = 'Admin Setting';
        $data['menu'] = 'footer';
          $data['submenu'] = 'manage_web';
       $this->load->view('admin/inc/header', $data, false);
        $this->load->view('admin/footer/form', $data, false);
        $this->load->view('admin/inc/footer', $data, false);
   }

    public function update_footer()
    {
        $id=$_POST['id'];
        if($_FILES['logo']['name']!='' )
                 {
                   $data['file_name']= rand(0000,9999)."_".$_FILES['logo']['name'];

                   $target_path = "./upload/blog/";
                   $target_path = $target_path.basename($data['file_name']);
                   if(move_uploaded_file($_FILES['logo']['tmp_name'], $target_path))
                   {
                     $data['message']['file']="Uploaded";
                      $logo  = $data['file_name'];
                        @unlink("upload/blog/".$_POST['old_logo']);
                     echo json_encode($data['message']);
                   }
                   else{
                     $data['message']['file']="system_error";
                     echo json_encode($data['message']);
                   }

                 }
                 else
                 {
                   $logo  = $_POST['old_logo'];
                 }
            $data = array(

                        'copyright' =>$this->input->post('copyright',TRUE),
                         'logo' =>$logo,
                        'description' =>$this->input->post('description',TRUE),

                            );

            $this->Common_model->SaveData('footer',$data,"id='".$id."'");
             $this->session->set_flashdata('message', 'Category created successfully');
            redirect(base_url('admin/Footer'));

    }

     public function social_list()
   {
    $data['get_social']=$this->Common_model->GetData('social_network','','','',"");
         $data['session_user']=$this->session->userdata('admin_in');
        if (!($data['session_user']['usergroup']=="ADMIN")) {
            redirect(base_url('admin/dashboard'));
        }
        $data['title'] = 'Admin Social Media';
        $data['menu'] = 'social_media';
          $data['submenu'] = 'manage_web';
       $this->load->view('admin/inc/header', $data, false);
        $this->load->view('admin/social_media/list', $data, false);
        $this->load->view('admin/inc/footer', $data, false);
   }
   public function add_social_media()
   {
     $data = array();
        $this->load->model('Crud_model');
        $data['message'] = $this->Crud_model->add('social_network');
        echo json_encode($data);
   }
 public function get_value()
  {
    $get_data=$this->Common_model->get_single('social_network',"id='".$_POST['id']."'");
    $data=array(
      'id'=>$get_data->id,
      'icon'=>$get_data->icon,
      'link'=>$get_data->link,
    );
    echo json_encode($data);exit;
  }
   public function update_social_media()
  {
    $id=$_POST['id'];
       $data = array();
        $this->load->model('Crud_model');
        $data['message'] = $this->Crud_model->update('social_network',$id);
        echo json_encode($data);
  }
  public function delete($id)
    {
           $this->Common_model->DeleteData('social_network',"id='".$id."'");
           redirect(base_url('admin/Footer/social_list'));
    }

}
