<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_data extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        Utils::no_cache();
         $this->load->model('Common_model');
         $this->load->model('Crud_model');
          $this->load->library(array('session','form_validation','image_lib','upload'));
    }

   public function index()
   {
         $data['session_user']=$this->session->userdata('admin_in');
        if (!($data['session_user']['usergroup']=="ADMIN")) {
            redirect(base_url('admin/dashboard'));
        }
        $data['title'] = 'Admin Dashboard';
        $data['menu'] = 'product_support';
        $notify=$this->Common_model->GetData('notification', "", "admin_status='0'");
        $data['count']=count($notify);
       $this->load->view('admin/inc/header', $data, false);
        $this->load->view('admin/manage_website/productsupport_list', $data, false);
        $this->load->view('admin/inc/footer', $data, false);
   }
   public function view_productsupport($id)
   {
     $data['view_product']=$this->Common_model->GetData('product_support_form','',"id='".$id."'",'',"",'','1');
     $data['get_product']=$this->Common_model->GetData('product','',"id='".$data['view_product']->product_id."'",'',"",'','1');
     $data['session_user']=$this->session->userdata('admin_in');
       if (!($data['session_user']['usergroup']=="ADMIN")) {
           redirect(base_url('admin/dashboard'));
       }
       $data['title'] = 'Admin | Product View';
         $data['data'] = array('sub_heading'=>'View ProductSupport',
                   'name' =>$data['view_product']->name,
                   'email' =>$data['view_product']->email,
                   'phone' =>$data['view_product']->phone,
                   'product_name' =>$data['get_product']->product_name,
                   'message' =>$data['view_product']->message,
                   'attachment' =>$data['view_product']->attachment,
         );

        $this->load->view('admin/inc/header',$data);
       $this->load->view('admin/manage_website/productsupport_view', $data);
       $this->load->view('admin/inc/footer');

   }
    public function delete_productsupport($id)
    {
           $this->Common_model->DeleteData('product_support_form',"id='".$id."'");
           redirect(base_url('admin/Product_data'));
    }

    public function usersupport_list()
    {
         $data['session_user']=$this->session->userdata('admin_in');
        if (!($data['session_user']['usergroup']=="ADMIN")) {
            redirect(base_url('admin/dashboard'));
        }
        $data['title'] = 'Admin Dashboard';
        $data['menu'] = 'users_support';
        $notify=$this->Common_model->GetData('notification', "", "admin_status='0'");
        $data['count']=count($notify);
       $this->load->view('admin/inc/header', $data, false);
        $this->load->view('admin/manage_website/support_list', $data, false);
        $this->load->view('admin/inc/footer', $data, false);
    }
     public function usersupport_detail($id)
    {
       //$data['get_usersupport']=$this->Crud_model->support_list();
         $data['session_user']=$this->session->userdata('admin_in');
        if (!($data['session_user']['usergroup']=="ADMIN") ) {
            redirect(base_url('admin/dashboard'));
        }
         if (!($data['session_user']['usergroup']=="ADMIN") ) {
            redirect(base_url('admin/dashboard'));
        }
            if ($id) {
            $data['selectall']=$this->admin->getRow('select us.*,u.name,u.email from users_support us,users u where us.user_id= u.id and  us.id='.$id.'');
        }
        $data['title'] = 'Admin|Users Support';
        $data['menu'] = 'users_support';

          $data['rolls']= json_decode($data['session_user']['roll']);

        if (in_array("Downloader", $data['rolls'])) {
          $this->load->view('admin/inc/header', $data, false);
        $this->load->view('admin/manage_website/support_detail', $data, false);
        $this->load->view('admin/inc/footer', $data, false);
        }else{
             $this->load->view('admin/inc/header', $data, false);
        $this->load->view('admin/manage_website/support_detail', $data, false);
        $this->load->view('admin/inc/footer', $data, false);

        }
    }

        public function updatesupport()
    {
        $id=$this->input->post('id');

        $array = array(
                    'admin_note'            =>$this->input->post('admin_note') ,
                    'assign'         =>$this->input->post('assign') ,
                     'admin_status'         =>1 ,
                 );

        if ($id>0) {
            $update = $this->admin->update('users_support', array('id'=>$id), $array);


                // $this->messages->add('Updated successfully', "alert-success");
                redirect('admin/Product_data/usersupport_list');

        }
    }
    public function delete_usersupport($id)
    {
           $this->Common_model->DeleteData('users_support',"id='".$id."'");
           redirect(base_url('admin/Product_data/usersupport_list'));
    }
     public function contactus_list()
    {
      $data['get_contactus']=$this->Common_model->GetData('contact','','','',"id DESC");
         $data['session_user']=$this->session->userdata('admin_in');
        if (!($data['session_user']['usergroup']=="ADMIN")) {
            redirect(base_url('admin/dashboard'));
        }
        $data['title'] = 'Admin Dashboard';
        $data['menu'] = 'contactus_list';
        $notify=$this->Common_model->GetData('notification', "", "admin_status='0'");
        $data['count']=count($notify);
       $this->load->view('admin/inc/header', $data, false);
        $this->load->view('admin/manage_website/contactus_list', $data, false);
        $this->load->view('admin/inc/footer', $data, false);
    }
    public function view_contactlist($id)
    {
      $data['view_contact']=$this->Common_model->GetData('contact','',"id='".$id."'",'',"",'','1');
      $data['session_user']=$this->session->userdata('admin_in');
        if (!($data['session_user']['usergroup']=="ADMIN")) {
            redirect(base_url('admin/dashboard'));
        }
        $data['title'] = 'Admin Dashboard';
          $data['menu'] = 'contactus_view';
          $data['data'] = array('sub_heading'=>'View ConatctUs',
                    'name' =>$data['view_contact']->name,
                    'email' =>$data['view_contact']->email,
                    'telephone' =>$data['view_contact']->telephone,
                    'company' =>$data['view_contact']->company,
                    'country' =>$data['view_contact']->country,
                    'city' =>$data['view_contact']->city,
                    'note' =>$data['view_contact']->note,
          );

         $this->load->view('admin/inc/header',$data);
        $this->load->view('admin/manage_website/contactus_view', $data);
        $this->load->view('admin/inc/footer');

    }
    public function delete_contactlist($id)
    {
           $this->Common_model->DeleteData('contact',"id='".$id."'");
           redirect(base_url('admin/Product_data/contactus_list'));
    }
    public function offlinerequest_list()
   {
     $data['get_request']=$this->Common_model->GetData('offline_request','','','',"id DESC");
        $data['session_user']=$this->session->userdata('admin_in');
       if (!($data['session_user']['usergroup']=="ADMIN")) {
           redirect(base_url('admin/dashboard'));
       }
       $data['title'] = 'Admin Dashboard';
       $data['menu'] = 'offline_requestlist';
       $notify=$this->Common_model->GetData('notification', "", "admin_status='0'");
       $data['count']=count($notify);
      $this->load->view('admin/inc/header', $data, false);
       $this->load->view('admin/manage_website/offline_request_list', $data, false);
       $this->load->view('admin/inc/footer', $data, false);
   }
   public function delete_offfline_requestlist($id)
   {
          $this->Common_model->DeleteData('offline_request',"id='".$id."'");
          redirect(base_url('admin/Product_data/offlinerequest_list'));
   }
  }
