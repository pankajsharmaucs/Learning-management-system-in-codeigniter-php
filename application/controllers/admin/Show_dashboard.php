<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Show_dashboard extends CI_Controller
{
    public function __construct()

    {
        parent::__construct();
        Utils::no_cache();
        if (!$this->session->userdata('admin_in')) {
            redirect(base_url('admin/auth/login'));
            exit;
        }
         $this->load->model('Common_model');
          $this->load->model('Crud_model');
    }

    public function enquiry()
    {
         $data['session_user']=$this->session->userdata('admin_in');
        if (!($data['session_user']['usergroup']=="ADMIN")) {
            redirect(base_url('admin/dashboard'));
        }
        $data['title'] = 'Admin Dashboard';
        $data['menu'] = 'enquiry';
        $data['enquiry']=$this->Common_model->GetData('contact',"","","","id DESC");
        $this->load->view('admin/inc/header', $data, false);
        $this->load->view('admin/show_dashboard/enquiry', $data, false);
        $this->load->view('admin/inc/footer', $data, false);
    }
    public function wallet_user($flag='')
    {
        $cond="1=1";
         if(!empty($_POST)){

        $from_date=date('Y-m-d',strtotime($_POST['from_date']));

        $end_date=date('Y-m-d',strtotime($_POST['end_date']));
         $cond .=" and LEFT(e.datetime,10)>='".$from_date."' and LEFT(e.datetime,10)<='".$end_date."'";
    }
    if($flag=='wallet')
    {
        $cond.=" and e.user_id GROUP BY e.user_id";
    }
        $data['session_user']=$this->session->userdata('admin_in');
        if (!($data['session_user']['usergroup']=="ADMIN")) {
            redirect(base_url('admin/dashboard'));
        }
        $data['title'] = 'Admin Dashboard';
        $data['menu'] = 'wallet_user';
       $data['flag']=$flag;
        $data['wallet']=$this->Crud_model->wallet_user($cond);
        $this->load->view('admin/inc/header', $data, false);
        $this->load->view('admin/show_dashboard/wallet_user', $data, false);
        $this->load->view('admin/inc/footer', $data, false);
    }

    function wallet_filter_date()
    {
        $cond= "1=1";
        if(!empty($_POST)){
            $flag=$_POST['flag'];

        if(!empty($_POST['from_date']) and empty($_POST['end_date']))
        {
            $from_date=date('Y-m-d',strtotime($_POST['from_date']));
          $cond .=" and LEFT(e.datetime,10)>='".$from_date."'";
        }
         if(!empty($_POST['end_date']) and empty($_POST['from_date']))
        {
            $end_date=date('Y-m-d',strtotime($_POST['end_date']));
          $cond .=" and LEFT(e.datetime,10)<='".$end_date."'";
        }
        if(!empty($_POST['from_date']) and !empty($_POST['end_date']))
        {
             $from_date=date('Y-m-d',strtotime($_POST['from_date']));
            $end_date=date('Y-m-d',strtotime($_POST['end_date']));

         $cond .=" and LEFT(e.datetime,10)>='".$from_date."' and LEFT(e.datetime,10)<='".$end_date."'";
        }

    }
     if($flag=='wallet')
    {
        $cond.=" and e.user_id GROUP BY e.user_id";
    }

     $data['table']=$this->Crud_model->wallet_user($cond);

      $this->load->view('admin/show_dashboard/wallet_user_data', $data, false);
    }

    public function certi_and_doc()
    {
         $data['session_user']=$this->session->userdata('admin_in');
        if (!($data['session_user']['usergroup']=="ADMIN")) {
            redirect(base_url('admin/dashboard'));
        }
        $data['title'] = 'Admin Dashboard';
        $data['menu'] = 'certi_and_doc';
        $data['certi_and_doc']=$this->Common_model->GetData('report_certificate',"","","","id DESC");
        $this->load->view('admin/inc/header', $data, false);
        $this->load->view('admin/show_dashboard/certificate_doc', $data, false);
        $this->load->view('admin/inc/footer', $data, false);
    }
    public function orders_detail($flag='')
    {
         $cond= "1=1";
        if(!empty($_POST)){

        $from_date=date('Y-m-d',strtotime($_POST['from_date']));

        $end_date=date('Y-m-d',strtotime($_POST['end_date']));
         $cond .=" and LEFT(or.date,10)>='".$from_date."' and LEFT(or.date,10)<='".$end_date."'";
    }
         $data['session_user']=$this->session->userdata('admin_in');
        if (!($data['session_user']['usergroup']=="ADMIN")) {
            redirect(base_url('admin/dashboard'));
        }
        $data['title'] = 'Admin Dashboard';
      //  $data['menu'] = 'orders';
        if($flag=='detail_report')
        {
            $cond .=" and or.category='Full Company Report'";
        }
        else if($flag=='sales')
        {
            $cond .=" and or.product_status='complete'";
        }
        else if($flag=='recent_incor')
        {
            $cond .=" and or.category='recent incorporation'";
        }
        else if($flag=='new_incor')
        {
            $cond .=" and or.category='new incorporation'";
        }
        else if($flag=='track_company')
        {
            $cond .=" and or.category='Track a Company'";
        }
        else if($flag=='today_order')
        {
            $cond .=" and LEFT(or.date,10)='".date('Y-m-d')."'";
        }
        else {
        $cond .=" and or.status='paid'";

    }
     $data['order_detail']=$this->Crud_model->orders_detail($cond);
        $this->load->view('admin/inc/header', $data, false);
        $this->load->view('admin/show_dashboard/orders', $data, false);
        $this->load->view('admin/inc/footer', $data, false);
    }

    public function filter_date()
    {
         $cond= "1=1";
        if(!empty($_POST)){
            $flag=$_POST['flag'];

        if(!empty($_POST['from_date']) and empty($_POST['end_date']))
        {
            $from_date=date('Y-m-d',strtotime($_POST['from_date']));
          $cond .=" and LEFT(or.date,10)>='".$from_date."'";
        }
         if(!empty($_POST['end_date']) and empty($_POST['from_date']))
        {
            $end_date=date('Y-m-d',strtotime($_POST['end_date']));
          $cond .=" and LEFT(or.date,10)<='".$end_date."'";
        }
        if(!empty($_POST['from_date']) and !empty($_POST['end_date']))
        {
             $from_date=date('Y-m-d',strtotime($_POST['from_date']));
            $end_date=date('Y-m-d',strtotime($_POST['end_date']));

         $cond .=" and LEFT(or.date,10)>='".$from_date."' and LEFT(or.date,10)<='".$end_date."'";
        }

    }
     if($flag=='detail_report')
        {
            $cond .=" and or.category='Full Company Report'";
        }
        else if($flag=='recent_incor')
        {
            $cond .=" and or.category='recent incorporation'";
        }
        else if($flag=='new_incor')
        {
            $cond .=" and or.category='new incorporation'";
        }
        else if($flag=='track_company')
        {
            $cond .=" and or.category='Track a Company'";
        }
        else if($flag=='today_order')
        {
            $cond .=" and LEFT(or.date,10)='".date('Y-m-d')."'";
        }
        else{
        $cond .=" and or.status='paid'";

    }
     $data['order_detail']=$this->Crud_model->orders_detail($cond);

      $this->load->view('admin/show_dashboard/orderdata', $data, false);

    }
    public function payment_gateway()
   {
        $data['session_user']=$this->session->userdata('admin_in');
       if (!($data['session_user']['usergroup']=="ADMIN")) {
           redirect(base_url('admin/dashboard'));
       }
       $data['title'] = 'Admin Dashboard';
       $data['menu'] = 'payment_gateway';
      $data['payment_gateway']=$this->Crud_model->payment_detail();
       $this->load->view('admin/inc/header', $data, false);
       $this->load->view('admin/show_dashboard/payment', $data, false);
       $this->load->view('admin/inc/footer', $data, false);
   }

   public function scraper_company_data()
   {
     //$get_company=$this->Common_model->GetData('company','name,cin');
     $json = file_get_contents('http://35.232.233.137:34/company?cin=L00000CH1983PLC031318');
    $obj = json_decode($json);
      print_r($obj); exit;
 }
}
