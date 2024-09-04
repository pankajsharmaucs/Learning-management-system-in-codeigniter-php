<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        Utils::no_cache();
         $this->load->model('Common_model');
          $this->load->library(array('session','form_validation','image_lib','upload'));
    }

   public function index()
   {
    $data['get_blog']=$this->Common_model->GetData('blog','','','',"id DESC");
         $data['session_user']=$this->session->userdata('admin_in');
        if (!($data['session_user']['usergroup']=="ADMIN")) {
            redirect(base_url('admin/dashboard'));
        }
        $data['title'] = 'Admin Dashboard';
        $data['menu'] = 'blog';
        $notify=$this->Common_model->GetData('notification', "", "admin_status='0'");
        $data['count']=count($notify);
       $this->load->view('admin/inc/header', $data, false);
        $this->load->view('admin/blog/list', $data, false);
        $this->load->view('admin/inc/footer', $data, false);
   }
    public function create()
        {

             $data['session_user']=$this->session->userdata('admin_in');
        if (!($data['session_user']['usergroup']=="ADMIN")) {
            redirect(base_url('admin/dashboard'));
        }
        $data['title'] = 'Admin Blog';
          $data['data'] = array('sub_heading'=>'Add Blog',
                'button'=>'Save',
                    'action'=>base_url('admin/Blog/create_action'),
                    'name' =>set_value('name'),
                    'heading' =>set_value('heading'),
                    'image' =>set_value('image'),
                    'description1' =>set_value('description1'),
                    'description' =>set_value('description'),
                    'id' =>set_value('id'),
          );

         $this->load->view('admin/inc/header',$data);
        $this->load->view('admin/blog/form', $data);
        $this->load->view('admin/inc/footer');
    }


    public function create_action()
    {
      if($_FILES['image']['name']!='' )
               {
                 $data['file_name']= rand(0000,9999)."_".$_FILES['image']['name'];

                 $target_path = "./upload/blog/";
                 $target_path = $target_path.basename($data['file_name']);
                 if(move_uploaded_file($_FILES['image']['tmp_name'], $target_path))
                 {
                   $data['message']['file']="Uploaded";
                    $image  = $data['file_name'];
                   echo json_encode($data['message']);
                 }
                 else{
                   $data['message']['file']="system_error";
                   echo json_encode($data['message']);
                 }

               }
               else{
                 $image='';
               }

               $data = array(

                       'name' =>ucfirst($this->input->post('name',TRUE)),
                       'heading' =>$this->input->post('heading',TRUE),
                        'image' =>$image,
                       'description1' =>$this->input->post('description1',TRUE),
                       'description' =>$this->input->post('description',TRUE),
                       'created'=> date('Y-m-d H:i:s'),
                           );
                           //print_r($data); exit;
           $this->Common_model->SaveData('blog',$data);

           //$this->session->set_flashdata('message', 'Employee created successfully');
           redirect(base_url('admin/Blog'));

    }

    public function update($id)
    {
       $data['update_blog']=$this->Common_model->GetData('blog','',"id='".$id."'",'',"",'','1');
       //print_r($update_blog->name); exit;
      $data['session_user']=$this->session->userdata('admin_in');
        if (!($data['session_user']['usergroup']=="ADMIN")) {
            redirect(base_url('admin/dashboard'));
        }
        $data['title'] = 'Admin Blog';
          $data['data'] = array('sub_heading'=>'Update Blog',
                'button'=>'Update',
                    'action'=>base_url('admin/Blog/update_action'),
                    'name' =>$data['update_blog']->name,
                    'heading' =>$data['update_blog']->heading,
                    'image' =>$data['update_blog']->image,
                    'description1' =>$data['update_blog']->description1,
                    'description' =>$data['update_blog']->description,
                    'id' =>$id,
          );

         $this->load->view('admin/inc/header',$data);
        $this->load->view('admin/blog/form', $data);
        $this->load->view('admin/inc/footer');
    }
    public function update_action()
    {
        $id=$_POST['id'];
        if($_FILES['image']['name']!='' )
                 {
                   $data['file_name']= rand(0000,9999)."_".$_FILES['image']['name'];

                   $target_path = "./upload/blog/";
                   $target_path = $target_path.basename($data['file_name']);
                   if(move_uploaded_file($_FILES['image']['tmp_name'], $target_path))
                   {
                     $data['message']['file']="Uploaded";
                      $image  = $data['file_name'];
                        @unlink("upload/blog/".$_POST['old_image']);
                     echo json_encode($data['message']);
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

                        'name' =>ucfirst($this->input->post('name',TRUE)),
                        'heading' =>$this->input->post('heading',TRUE),
                         'image' =>$image,
                        'description1' =>$this->input->post('description1',TRUE),
                        'description' =>$this->input->post('description',TRUE),
                        'modified'=> date('Y-m-d H:i:s'),
                            );

            $this->Common_model->SaveData('blog',$data,"id='".$id."'");

            //$this->session->set_flashdata('message', 'Employee created successfully');
            redirect(base_url('admin/Blog'));

    }
    public function view($id)
    {
     $data['view_blog']=$this->Common_model->GetData('blog','',"id='".$id."'",'',"",'','1');
     $data['session_user']=$this->session->userdata('admin_in');
       if (!($data['session_user']['usergroup']=="ADMIN")) {
           redirect(base_url('admin/dashboard'));
       }
       $data['title'] = 'Admin Blog';
         $data['data'] = array('sub_heading'=>'View Blog',
                   'name' =>$data['view_blog']->name,
                   'heading' =>$data['view_blog']->heading,
                   'image' =>$data['view_blog']->image,
                   'description1' =>$data['view_blog']->description1,
                   'description' =>$data['view_blog']->description,
         );

        $this->load->view('admin/inc/header',$data);
       $this->load->view('admin/blog/view', $data);
       $this->load->view('admin/inc/footer');
    }
    public function delete($id)
    {
           $this->Common_model->DeleteData('blog',"id='".$id."'");
           redirect(base_url('admin/Blog'));
    }

}
