<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
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
        $this->load->model('Send_mail');
        $this->load->model('Crud_model');
        $GLOBALS['a'] = $this->session->userdata('ocr_id');
    }


    public function index()
    {
        $data['title'] = 'Admin Dashboard';
        $data['session_user']=$this->session->userdata('admin_in');
        $this->load->model('Cart_model');
        $data['Orders'] = $this->Cart_model->getDetailedReportOrders();

        if ($data['session_user']['usergroup']=="ADMIN") {
            $data['menu'] = 'Orders';
            $data['message']=$this->session->flashdata('msg');
            $this->load->view('admin/inc/header', $data, false);
            $this->load->view('admin/master/dashboard', $data, false);
            $this->load->view('admin/inc/footer', $data, false);
        } else {
            $data['rolls']= json_decode($data['session_user']['roll']);
            if (in_array("Downloader", $data['rolls'])) {
                redirect(base_url('admin/dashboard/downloader'));
            } elseif (in_array("Data Analyst", $data['rolls'])) {
                redirect(base_url('admin/dashboard/data_analyst'));
            } elseif (in_array("Financial Analyst", $data['rolls'])) {
                redirect(base_url('admin/dashboard/financial_analyst'));
            }
        }
    }
    public function selectfile($id)
    {
        $data['title'] = 'Admin Dashboard';
        $data['session_user']=$this->session->userdata('admin_in');
        $this->load->model('Cart_model');
        $data['Orders'] = $this->Cart_model->getDetailedReportOrders();

        if ($data['session_user']['usergroup']=="ADMIN") {
            $data['menu'] = 'Orders';
            $data['message']=$this->session->flashdata('msg');
            $this->load->view('admin/inc/header', $data, false);
            $this->load->view('admin/master/dashboard', $data, false);
            $this->load->view('admin/inc/footer', $data, false);
        }else{
            $data['rolls']= json_decode($data['session_user']['roll']);
            if (in_array("Downloader", $data['rolls'])) {
                redirect(base_url('admin/dashboard/selectfile'));
            } elseif (in_array("Data Analyst", $data['rolls'])) {
                redirect(base_url('admin/dashboard/data_analyst'));
            } elseif (in_array("Financial Analyst", $data['rolls'])) {
                redirect(base_url('admin/dashboard/financial_analyst'));
            }
        }
    }

    public function reports()
    {
        $data['title'] = 'Admin Dashboard';
        $data['session_user']=$this->session->userdata('admin_in');


        if ($data['session_user']['usergroup']=="ADMIN") {
            $data['menu'] = 'Reports';
            $data['message']=$this->session->flashdata('msg');
            $this->load->view('admin/inc/header', $data, false);
            $this->load->view('admin/master/reports', $data, false);
            $this->load->view('admin/inc/footer', $data, false);
        }else {
            redirect(base_url('admin/dashboard'));
        }
    }

    public function downloader()
    {
        $data['title'] = 'Downloader';
        $data['menu'] = 'DL_logs';

        $data['session_user']=$this->session->userdata('admin_in');
          $user_id=$data['session_user']['id'];
        $this->load->model('Cart_model');
        $data['Orders'] = $this->Cart_model->getDetailedReportOrders();
        // $data['Orders'] = $this->Cart_model->getDetailedReportOrdersForPU($data['session_user']['id']);
        $data['rolls']= json_decode($data['session_user']['roll']);
        $notify=$this->Common_model->GetData('notification',"","production_user='0' and type='downloader'");
        $data['count']=count($notify);

          $data['get_admin']=$this->Common_model->get_single('admin', "id='".$user_id."' and usergroup='PU'");
        if (in_array("Downloader", $data['rolls'])) {
            $this->load->view('admin/inc/header', $data, false);
            $this->load->view('admin/Downloader/dashboard', $data, false);
            $this->load->view('admin/inc/footer', $data, false);
        }
    }
    public function production_setting()
    {
        $data['title'] = 'Setting';
        $data['menu'] = 'setting';

        $data['session_user']=$this->session->userdata('admin_in');
        $user_id=$data['session_user']['id'];

        $this->load->model('Cart_model');
        $data['Orders'] = $this->Cart_model->getDetailedReportOrders();
        // $data['Orders'] = $this->Cart_model->getDetailedReportOrdersForPU($data['session_user']['id']);
        $data['rolls']= json_decode($data['session_user']['roll']);
        $notify=$this->Common_model->GetData('notification',"","production_user='0' and type='downloader'");
        $data['count']=count($notify);
      $data['get_admin']=$this->Common_model->get_single('admin', "id='".$user_id."' and usergroup='PU'");
        if (in_array("Downloader", $data['rolls'])) {
            $this->load->view('admin/inc/header', $data, false);
            $this->load->view('admin/Downloader/setting', $data, false);
            $this->load->view('admin/inc/footer', $data, false);
        }
    }
    public function documents()
    {
        $data['title'] = 'Downloader Documents';
        $data['menu'] = 'DOC_logs';

        $data['session_user']=$this->session->userdata('admin_in');
          $user_id=$data['session_user']['id'];
        $this->load->model('Cart_model');
        $data['Orders'] = $this->Cart_model->getDetailedReportOrders();
        $data['rolls']= json_decode($data['session_user']['roll']);
        $notify=$this->Common_model->GetData('notification', "", "production_user='0' and type='downloader'");
        $data['count']=count($notify);
        $data['get_admin']=$this->Common_model->get_single('admin', "id='".$user_id."' and usergroup='PU'");
        if (in_array("Downloader", $data['rolls'])) {
            $this->load->view('admin/inc/header', $data, false);
            $this->load->view('admin/Downloader/documents', $data, false);
            $this->load->view('admin/inc/footer', $data, false);
        }
    }
    public function newcompany()
    {
        $data['title'] = 'New Company';
        $data['menu'] = 'DOC_logs';

        $data['session_user']=$this->session->userdata('admin_in');
          $user_id=$data['session_user']['id'];
        $this->load->model('Cart_model');
        $data['Orders'] = $this->Cart_model->getDetailedReportOrders();
        $data['rolls']= json_decode($data['session_user']['roll']);
        $notify=$this->Common_model->GetData('notification', "", "production_user='0' and type='downloader'");
        $data['count']=count($notify);
        $data['get_admin']=$this->Common_model->get_single('admin', "id='".$user_id."' and usergroup='PU'");
        if (in_array("Downloader", $data['rolls'])) {
            $this->load->view('admin/inc/header', $data, false);
            $this->load->view('admin/Downloader/newcompany', $data, false);
            $this->load->view('admin/inc/footer', $data, false);
        }
    }
    // amit notification da
    public function notification_doc()
    {
        $data['title'] = 'Admin Notifications';
        $data['menu'] = 'notification_doc';

        $data['session_user']=$this->session->userdata('admin_in');
          $user_id=$data['session_user']['id'];
        $this->load->model('Cart_model');
        $data['Orders'] = $this->Cart_model->getDetailedReportOrders();
        $data['rolls']= json_decode($data['session_user']['roll']);
        $con="production_user='1'";
        $data['notification']=$this->Common_model->GetData('notification',"","production_user='1' and type='downloader'",'',"id desc");
        $data1=array(
                'production_user'=>1,
                 'user_id'=>$user_id
            );
        $this->Common_model->SaveData('notification', $data1, "production_user='0'");
        $notify=$this->Common_model->GetData('notification', "", "production_user='0' and type='downloader'");
        $data['count']=count($notify);
          $data['get_admin']=$this->Common_model->get_single('admin', "id='".$user_id."' and usergroup='PU'");
        if (in_array("Downloader", $data['rolls'])) {
            $this->load->view('admin/inc/header', $data, false);
            $this->load->view('admin/Downloader/product_notify', $data, false);
            $this->load->view('admin/inc/footer', $data, false);
        }
    }
    public function da_notify()
    {
        $data['title'] = 'Data Notification';
        $data['menu'] = 'DOC_logs';
        $data['session_user']=$this->session->userdata('admin_in');
          $user_id=$data['session_user']['id'];
        $this->load->model('Cart_model');
        $data['Orders'] = $this->Cart_model->getDetailedReportOrders();
        $data['rolls']= json_decode($data['session_user']['roll']);
        $con="production_user='1'";
        $data['notification']=$this->Common_model->GetData('notification',"","production_user='1' and type='da'");
        /*$data1=array(
                'production_user'=>1,
                 'user_id'=>$user_id
            );
        $this->Common_model->SaveData('notification', $data1, "production_user='0'"); */
        $notify=$this->Common_model->GetData('notification', "", "production_user='0' and type='da'");
        $data['count']=count($notify);
          $data['get_admin']=$this->Common_model->get_single('admin', "id='".$user_id."' and usergroup='PU'");
        if (in_array("Downloader", $data['rolls'])) {
            $this->load->view('admin/inc/header', $data, false);
            $this->load->view('admin/DA/da_notify', $data, false);
            $this->load->view('admin/inc/footer', $data, false);
        }
    }
    public function fa_notify()
    {
        $data['title'] = 'Fa Notification';
        $data['menu'] = 'DOC_logs';
        $data['session_user']=$this->session->userdata('admin_in');
          $user_id=$data['session_user']['id'];
        $this->load->model('Cart_model');
        $data['Orders'] = $this->Cart_model->getDetailedReportOrders();
        $data['rolls']= json_decode($data['session_user']['roll']);
        $con="production_user='1'";
        $data['notification']=$this->Common_model->GetData('notification',"","production_user='1' and type='fa'");
       /* $data1=array(
                'production_user'=>1,
                 'user_id'=>$user_id
            );
        $this->Common_model->SaveData('notification', $data1, "production_user='0'");*/
        $notify=$this->Common_model->GetData('notification', "", "production_user='0' and type='fa'");
        $data['count']=count($notify);
          $data['get_admin']=$this->Common_model->get_single('admin', "id='".$user_id."' and usergroup='PU'");
        if (in_array("Financial Analyst", $data['rolls'])) {
            $this->load->view('admin/inc/header', $data, false);
            $this->load->view('admin/FA/fa_notify', $data, false);
            $this->load->view('admin/inc/footer', $data, false);
        }
    }

    public function usersupport_list()
    {
      $data['title'] = 'Downloader | User Support';
      $data['menu'] = 'usersupport_list';

      $data['session_user']=$this->session->userdata('admin_in');
        $user_id=$data['session_user']['id'];
      $this->load->model('Cart_model');
      $data['Orders'] = $this->Cart_model->getDetailedReportOrders();
      $data['rolls']= json_decode($data['session_user']['roll']);
      $notify=$this->Common_model->GetData('notification', "", "production_user='0' and type='downloader'");
      $data['count']=count($notify);
        $data['get_admin']=$this->Common_model->get_single('admin', "id='".$user_id."' and usergroup='PU'");
      $this->load->view('admin/inc/header', $data, false);
      $this->load->view('admin/Downloader/support_list', $data, false);
      $this->load->view('admin/inc/footer', $data, false);
    }


      public function usersupport_detail($id)
      {
        $data['title'] = 'Admin | User Support';
$data['menu'] = 'usersupport_list';
        $data['session_user']=$this->session->userdata('admin_in');
          $user_id=$data['session_user']['id'];
        $this->load->model('Cart_model');

        $data['Orders'] = $this->Cart_model->getDetailedReportOrders();
        $data['rolls']= json_decode($data['session_user']['roll']);

       $notify=$this->Common_model->GetData('notification', "", "production_user='0' and type='downloader'");
        $data['count']=count($notify);
          $data['get_admin']=$this->Common_model->get_single('admin', "id='".$user_id."' and usergroup='PU'");
        if ($id) {
          $data['selectall']=$this->admin->getRow('select us.*,u.name,u.email from users_support us,users u where us.user_id= u.id and  us.id='.$id.'');
        }

        //echo $this->db->last_query();exit;

        $this->load->view('admin/inc/header', $data, false);
        $this->load->view('admin/Downloader/support_detail', $data, false);
        $this->load->view('admin/inc/footer', $data, false);


      }

       public function usersupport_details($id)
    {
         $data['title'] = 'Admin | User Support';
        $data['menu'] = 'DOC_logs';

        $data['session_user']=$this->session->userdata('admin_in');
          $user_id=$data['session_user']['id'];
        $this->load->model('Cart_model');
          $data['Orders'] = $this->Cart_model->getDetailedReportOrders();
        $data['rolls']= json_decode($data['session_user']['roll']);
           $notify=$this->Common_model->GetData('notification', "", "admin_status='0'");
        $data['count']=count($notify);
            if ($id) {
            $data['selectall']=$this->admin->getRow('select us.*,u.name,u.email from users_support us,users u where us.user_id= u.id and  us.id='.$id.'');
        }
      }


  public function updatesupport()
    {
      $this->load->model('Send_mail');
        $id=$this->input->post('id');
        $user_id=$this->input->post('user_id');
        $array = array(
                    'ticket_status'=>$this->input->post('status') ,
                    'production_note'=>$this->input->post('production_note') ,
                 );
        if ($id>0) {
            $update = $this->admin->update('users_support', array('id'=>$id), $array);
        $get_user=$this->Common_model->get_single('users',"id='".$user_id."'");
        //  print_r($get_user->email); exit;
            $subject="Your querry has been resolved";
            $to=$get_user->email;
            $view='emails/enquiry_reply';
            $this->Send_mail->send($id1, $to, $view, $subject, $data);
                redirect('admin/dashboard/usersupport_list');
        }
    }


     public function dausersupport_list()
    {
      $data['title'] = 'Da|User Support';
      $data['menu'] = 'usersupport_list';

      $data['session_user']=$this->session->userdata('admin_in');
        $user_id=$data['session_user']['id'];
      $this->load->model('Cart_model');
      $data['Orders'] = $this->Cart_model->getDetailedReportOrders();
      $data['rolls']= json_decode($data['session_user']['roll']);
      $notify=$this->Common_model->GetData('notification', "", "production_user='0' and type='da'");
      $data['count']=count($notify);
        $data['get_admin']=$this->Common_model->get_single('admin', "id='".$user_id."' and usergroup='PU'");
      $this->load->view('admin/inc/header', $data, false);
      $this->load->view('admin/DA/support_list', $data, false);
      $this->load->view('admin/inc/footer', $data, false);
    }


      public function dausersupport_detail($id)
      {
        $data['title'] = 'Admin | User Support';
$data['menu'] = 'usersupport_list';
        $data['session_user']=$this->session->userdata('admin_in');
          $user_id=$data['session_user']['id'];
        $this->load->model('Cart_model');

        $data['Orders'] = $this->Cart_model->getDetailedReportOrders();
        $data['rolls']= json_decode($data['session_user']['roll']);

       $notify=$this->Common_model->GetData('notification', "", "production_user='0' and type='da'");
        $data['count']=count($notify);
  $data['get_admin']=$this->Common_model->get_single('admin', "id='".$user_id."' and usergroup='PU'");
        if ($id) {
          $data['selectall']=$this->admin->getRow('select us.*,u.name,u.email from users_support us,users u where us.user_id= u.id and  us.id='.$id.'');
        }

        //echo $this->db->last_query();exit;

        $this->load->view('admin/inc/header', $data, false);
        $this->load->view('admin/DA/support_detail', $data, false);
        $this->load->view('admin/inc/footer', $data, false);


      }



  public function daupdatesupport()
    {
      $this->load->model('Send_mail');
        $id=$this->input->post('id');
        $user_id=$this->input->post('user_id');
        $array = array(
                    'ticket_status'=>$this->input->post('status') ,
                    'production_note'=>$this->input->post('production_note') ,
                 );
        if ($id>0) {
            $update = $this->admin->update('users_support', array('id'=>$id), $array);
        $get_user=$this->Common_model->get_single('users',"id='".$user_id."'");
        //  print_r($get_user->email); exit;
            $subject="Your querry has been resolved";
            $to=$get_user->email;
            $view='emails/enquiry_reply';
            $this->Send_mail->send($id1, $to, $view, $subject, $data);
                redirect('admin/dashboard/dausersupport_list');
        }
    }
 public function fausersupport_list()
    {
      $data['title'] = 'Fa Usersupport';
      $data['menu'] = 'usersupport_list';

      $data['session_user']=$this->session->userdata('admin_in');
        $user_id=$data['session_user']['id'];
      $this->load->model('Cart_model');
      $data['Orders'] = $this->Cart_model->getDetailedReportOrders();
      $data['rolls']= json_decode($data['session_user']['roll']);
      $notify=$this->Common_model->GetData('notification', "", "production_user='0' and type='fa'");
      $data['count']=count($notify);
        $data['get_admin']=$this->Common_model->get_single('admin', "id='".$user_id."' and usergroup='PU'");
      $this->load->view('admin/inc/header', $data, false);
      $this->load->view('admin/FA/support_list', $data, false);
      $this->load->view('admin/inc/footer', $data, false);
    }


      public function fausersupport_detail($id)
      {
        $data['title'] = 'Admin | User Support';
$data['menu'] = 'usersupport_list';
        $data['session_user']=$this->session->userdata('admin_in');
          $user_id=$data['session_user']['id'];
        $this->load->model('Cart_model');

        $data['Orders'] = $this->Cart_model->getDetailedReportOrders();
        $data['rolls']= json_decode($data['session_user']['roll']);

       $notify=$this->Common_model->GetData('notification', "", "production_user='0' and type='fa'");
        $data['count']=count($notify);
  $data['get_admin']=$this->Common_model->get_single('admin', "id='".$user_id."' and usergroup='PU'");
        if ($id) {
          $data['selectall']=$this->admin->getRow('select us.*,u.name,u.email from users_support us,users u where us.user_id= u.id and  us.id='.$id.'');
        }

        $this->load->view('admin/inc/header', $data, false);
        $this->load->view('admin/FA/support_detail', $data, false);
        $this->load->view('admin/inc/footer', $data, false);

      }

  public function faupdatesupport()
    {
      $this->load->model('Send_mail');
        $id=$this->input->post('id');
        $user_id=$this->input->post('user_id');
        $array = array(
                    'ticket_status'=>$this->input->post('status') ,
                    'production_note'=>$this->input->post('production_note') ,
                 );
        if ($id>0) {
            $update = $this->admin->update('users_support', array('id'=>$id), $array);
        $get_user=$this->Common_model->get_single('users',"id='".$user_id."'");
        //  print_r($get_user->email); exit;
            $subject="Your querry has been resolved";
            $to=$get_user->email;
            $view='emails/enquiry_reply';
            $this->Send_mail->send($id1, $to, $view, $subject, $data);
                redirect('admin/dashboard/dausersupport_list');
        }
    }


    // end notification da
    public function data_analyst()
    {
        $data['title'] = 'Data Analyst';
        $data['menu'] = 'DA_logs';

        $data['session_user']=$this->session->userdata('admin_in');
          $user_id=$data['session_user']['id'];
        $this->load->model('Cart_model');
        $data['Orders'] = $this->Cart_model->getDetailedReportOrders();
        $data['rolls']= json_decode($data['session_user']['roll']);
        $notify=$this->Common_model->GetData('notification', "", "production_user='0' and type='da'");
        $data['count']=count($notify);
          $data['get_admin']=$this->Common_model->get_single('admin', "id='".$user_id."' and usergroup='PU'");
        if (in_array("Data Analyst", $data['rolls'])) {
            $this->load->view('admin/inc/header', $data, false);
            $this->load->view('admin/DA/dashboard', $data, false);
            $this->load->view('admin/inc/footer', $data, false);
        }
    }

    public function ocr($id)
    {
        $data['title'] = 'Data Analyst';
        $data['menu'] = 'DA_logs';

        $data['session_user']=$this->session->userdata('admin_in');
        $this->load->model('Cart_model');
        $data['Orders'] = $this->Cart_model->getDetailedReportOrders();
        $data['rolls']= json_decode($data['session_user']['roll']);
        $notify=$this->Common_model->GetData('notification', "", "production_user='0' and type='da'");
        $data['count']=count($notify);
        $session = array(
                                 'ocr_id'=>$id,


                                );
                $this->session->set_userdata($session);
        if (in_array("Data Analyst", $data['rolls'])) {
         //   $this->load->view('admin/inc/header', $data, false);
            //$this->load->view('admin/DA/dashboard', $data, false);
            $this->load->view('admin/DA/ocr_detail1', $data, false);
          //  $this->load->view('admin/inc/footer', $data, false);
        }
    }

      public function ocr1($id)
    {
        $data['title'] = 'Data Analyst';
        $data['menu'] = 'DA_logs';

        $data['session_user']=$this->session->userdata('admin_in');
        $this->load->model('Cart_model');
        $data['Orders'] = $this->Cart_model->getDetailedReportOrders();
        $data['rolls']= json_decode($data['session_user']['roll']);
        $notify=$this->Common_model->GetData('notification', "", "production_user='0' and type='da'");
        $data['count']=count($notify);
        $session = array(
                                 'ocr_id'=>$id,


                                );
                $this->session->set_userdata($session);
        if (in_array("Data Analyst", $data['rolls'])) {
         //   $this->load->view('admin/inc/header', $data, false);
            //$this->load->view('admin/DA/dashboard', $data, false);
            $this->load->view('admin/DA/ocr_detail', $data, false);
          //  $this->load->view('admin/inc/footer', $data, false);
        }
    }

     public function ocr2($id)
    {
        $data['title'] = 'Data Analyst';
        $data['menu'] = 'DA_logs';

        $data['session_user']=$this->session->userdata('admin_in');
        $this->load->model('Cart_model');
        $data['Orders'] = $this->Cart_model->getDetailedReportOrders();
        $data['rolls']= json_decode($data['session_user']['roll']);
        $notify=$this->Common_model->GetData('notification', "", "production_user='0' and type='da'");
        $data['count']=count($notify);
        $session = array(
                                 'ocr_id'=>$id,


                                );
                $this->session->set_userdata($session);
        if (in_array("Data Analyst", $data['rolls'])) {
         //   $this->load->view('admin/inc/header', $data, false);
            //$this->load->view('admin/DA/dashboard', $data, false);
            $this->load->view('admin/DA/ocr_detail1', $data, false);
          //  $this->load->view('admin/inc/footer', $data, false);
        }
    }
       public function aoc($id)
    {
        $data['title'] = 'Data Analyst';
        $data['menu'] = 'DA_logs';

        $data['session_user']=$this->session->userdata('admin_in');
        $this->load->model('Cart_model');
        $data['Orders'] = $this->Cart_model->getDetailedReportOrders();
        $data['rolls']= json_decode($data['session_user']['roll']);
        $notify=$this->Common_model->GetData('notification', "", "production_user='0' and type='da'");
        $data['count']=count($notify);
        $session = array(
                                 'ocr_id'=>$id,


                                );
                $this->session->set_userdata($session);



        if (in_array("Data Analyst", $data['rolls'])) {
         //   $this->load->view('admin/inc/header', $data, false);
            //$this->load->view('admin/DA/dashboard', $data, false);
            $this->load->view('admin/DA/aoc_detail', $data, false);
          //  $this->load->view('admin/inc/footer', $data, false);
        }
    }

     public function llp8($id)
    {
        $data['title'] = 'Data Analyst';
        $data['menu'] = 'DA_logs';

        $data['session_user']=$this->session->userdata('admin_in');
        $this->load->model('Cart_model');
        $data['Orders'] = $this->Cart_model->getDetailedReportOrders();
        $data['rolls']= json_decode($data['session_user']['roll']);
        $notify=$this->Common_model->GetData('notification', "", "production_user='0' and type='da'");
        $data['count']=count($notify);
        $session = array(
                                 'ocr_id'=>$id,


                                );
                $this->session->set_userdata($session);



        if (in_array("Data Analyst", $data['rolls'])) {
         //   $this->load->view('admin/inc/header', $data, false);
            //$this->load->view('admin/DA/dashboard', $data, false);
            $this->load->view('admin/DA/aoc_detail', $data, false);
          //  $this->load->view('admin/inc/footer', $data, false);
        }
    }

     public function llp11($id)
    {
        $data['title'] = 'Data Analyst';
        $data['menu'] = 'DA_logs';

        $data['session_user']=$this->session->userdata('admin_in');
        $this->load->model('Cart_model');
        $data['Orders'] = $this->Cart_model->getDetailedReportOrders();
        $data['rolls']= json_decode($data['session_user']['roll']);
        $notify=$this->Common_model->GetData('notification', "", "production_user='0' and type='da'");
        $data['count']=count($notify);
        $session = array(
                                 'ocr_id'=>$id,


                                );
                $this->session->set_userdata($session);



        if (in_array("Data Analyst", $data['rolls'])) {
         //   $this->load->view('admin/inc/header', $data, false);
            //$this->load->view('admin/DA/dashboard', $data, false);
            $this->load->view('admin/DA/aoc_detail', $data, false);
          //  $this->load->view('admin/inc/footer', $data, false);
        }
    }


  public function add_aoc()
    {   ini_set('max_execution_time', 0);
    $cin=$this->input->post('cinno');
    $id=$this->input->post('id');
    $b_MainHead=$this->input->post('b_MainHead');
    $b_Head=$this->input->post('b_Head');
    $b_SubHead=$this->input->post('b_SubHead');
    $b_FinancialYear1=$this->input->post('b_FinancialYear1');
    $b_FinancialYear2=$this->input->post('b_FinancialYear2');
    $p_Head=$this->input->post('p_Head');
    $p_SubHead=$this->input->post('p_SubHead');
    $p_FinancialYear1=$this->input->post('p_FinancialYear1');
    $p_FinancialYear2=$this->input->post('p_FinancialYear2');
    $value1=$this->input->post('value1');
    $value2=$this->input->post('value2');
    $value3=$this->input->post('value3');
    $value4=$this->input->post('value4');
    $temp = count($b_FinancialYear1);
    $temp1 = count($b_FinancialYear2);
    $temp2 = count($p_FinancialYear1);
    $temp3 = count($p_FinancialYear2);
    $BalanceSheet= array();

        $head=$this->input->post('head');
    $year=$this->input->post('year');
 $head1=$this->input->post('head1');
    $year1=$this->input->post('year1');
     $head2=$this->input->post('head2');
    $year2=$this->input->post('year2');

    $Mapping=$head.'-'.$year.','.$head1.'-'.$year1.','.$head2.'-'.$year2;

//print_r($value3);
//print_r($value4);
//print_r($p_FinancialYear1);
//print_r($p_FinancialYear2);
 for($i=0;$i<$temp;$i++){
   $BalanceSheet[] = array(
    'MainHead' =>  $b_MainHead[$i],
    'Head' => $b_Head[$i],
    'SubHead' => $b_SubHead[$i],
    'Value'=>str_replace(" ","",$value1[$i]),
      'FinancialYear'=>$b_FinancialYear1[$i],
    );
  }

   for($j=0;$j<$temp1;$j++){
   $BalanceSheet[] = array(
    'MainHead' =>  $b_MainHead[$j],
    'Head' => $b_Head[$j],
    'SubHead' => $b_SubHead[$j],
     'Value'=>str_replace(" ","",$value2[$j]),
     'FinancialYear'=>$b_FinancialYear2[$j],
    );
  }
//print_r($BalanceSheet);

$ProfitAndLoss= array();

 for($k=0;$k<$temp2;$k++){
   $ProfitAndLoss[] = array(
    'Head' => $p_Head[$k],
    'SubHead' => $p_SubHead[$k],
     'Value'=>$value3[$k],
   // 'FinancialYear'=>$p_FinancialYear2[$k],
     'FinancialYear'=>$p_FinancialYear1[$k],


    );
  }
  for($l=0;$l<$temp3;$l++){
   $ProfitAndLoss[] = array(
    'Head' => $p_Head[$l],
    'SubHead' => $p_SubHead[$l],
     'Value'=>$value4[$l],
  'FinancialYear'=>$p_FinancialYear2[$l],

    );
  }


//print_r($ProfitAndLoss);exit;
$Auditors[] = array(
          'AuditorName' =>$this->input->post('AuditorName'),
          'MembershipNo' => $this->input->post('MembershipNo'),
          'NameOfAuditFirm' =>$this->input->post('NameOfAuditFirm'),
          'AddressOfAuditors' => $this->input->post('AddressOfAuditors'),
          'PANNo' => $this->input->post('PANNo'),
          'SRNOfADT' =>''
        );
$company=$this->admin->getRow("SELECT * FROM company WHERE cin = '".$cin."'");

   $BasicDetails[] = array(
          'IncorporationNumber' => $company->cin,
          'NameOfCompany' => $company->name,
          'RegisteredAddress' => $company->address,
          'EmailID' => $company->email,
          "BusinessType" => $company->category,
          "Country" => "India",
          "PANNo" =>  $company->pan,
          "Activity" =>  $company->activity,
          "Mapping" =>$Mapping,
          "AuthorisedCapital" => $company->authourisedCapital,
          "DateOfIncorporation" => $company->dateofincorporation,
          "PaidupCapital" => $company->paidUpCaiptal,
          "Phone" =>  '',
          "Website" => '',
        );

//$getdatadirectors=$this->admin->getRows("SELECT * FROM comp_director cd, directors d WHERE cd.cid = '".$company->id."' and cd.did=d.id");
$getdatadirectors=$this->admin->getRows("SELECT * FROM mca_directors WHERE cin = '".$cin."'");
$Directors= array();

   foreach($getdatadirectors as $getdatadirectorsi){
 $Directors[] = array(
          "DirectorName" => $getdatadirectorsi->name,
          "DDesignation" => $getdatadirectorsi->designation,
          "OrderNo" => "",
          "DOB" => '',
          "DOJ" => $getdatadirectorsi->DOA,
          "Qualification" => "",
          "Experience" => "",
          "Mobile" => "",
          "Nationality" => "",
          "EMail" => "",
          "Comments" => "",
          "NationalityNew" => "",
          "BirthPlace" => "",
          "LanguageKnown" => "",
          "ActivelyInvolved" => "",
          "NoofVehicles" =>"",
          "NationalityID" => "",
          "GenderType" => "",
          "IdentificationNumber" => $getdatadirectorsi->din,
        );
}
//$getdatacharge=$this->admin->getRows("SELECT * FROM `charges` WHERE `cin` LIKE 'L00305MH1973PLC174201'");

$getdatacharge=$this->admin->getRows("SELECT * FROM mca_charges WHERE cin = '".$cin."'");

$HypothecationDetails= array();

   foreach($getdatacharge as $getdatachargei){
 $HypothecationDetails[] = array(
          "Banker" => $getdatachargei->Charge_Holder,
          "DateOfAgreement" => $getdatachargei->Closure_Date,
          "HypothecationOf" => $getdatachargei->charge_holder_name,
          "Amount" => $getdatachargei->amount,
          "OrderNo" => "",
          "Modification_Date" => $getdatachargei->date_of_modification,
          "Creation_Date" => $getdatachargei->date_of_creation,
          "ChargeID" => $getdatachargei->chargeid,
          "ChargeStatus" => "",
          "Comment" => ""
);
}


 $dataaaray[] = array(
    'BasicDetails' => $BasicDetails,
    'Directors' => $Directors,
    'HypothecationDetails' => $HypothecationDetails,
    'Auditors' => $Auditors,
    'BalanceSheet' => $BalanceSheet,
    'ProfitAndLoss'=>$ProfitAndLoss,
);

$dataaar= array(
   "json"=>$dataaaray
);
    $payload = json_encode($dataaar);

    //print_r($payload);  exit;



$url ="http://ec2-15-206-122-169.ap-south-1.compute.amazonaws.com:8080/CentralWebService/ConsumeAOC.asmx/InsertAOCDataINCWS";

                     $ch = curl_init( $url );
# Setup request to send json via POST.
//$payload = json_encode( array( "customer"=> $data ) );
curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
# Return response instead of printing.
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
# Send request.
$result = curl_exec($ch);
curl_close($ch);
print_r($payload);  exit;
 //redirect(base_url().'admin/dashboard/aoc/'.$id);
    }
    function shareholding_file($id)
    {
      $data['title'] = 'Data Analyst';
      $data['menu'] = 'DA_logs';

      $data['session_user']=$this->session->userdata('admin_in');
        $user_id=$data['session_user']['id'];
      $this->load->model('Cart_model');
      $data['Orders'] = $this->Cart_model->getDetailedReportOrders();
      $data['rolls']= json_decode($data['session_user']['roll']);
      $notify=$this->Common_model->GetData('notification', "", "production_user='0' and type='da'");
      $data['count']=count($notify);

          $this->load->view('admin/inc/header', $data, false);
         $this->load->view('admin/DA/shareholding_file', $data, false);
          $this->load->view('admin/inc/footer', $data, false);

    }
     public function ocrpdf($id)
    {
        $data['title'] = 'Data Analyst';
        $data['menu'] = 'DA_logs';

        $data['session_user']=$this->session->userdata('admin_in');
        $this->load->model('Cart_model');
        $data['Orders'] = $this->Cart_model->getDetailedReportOrders();
        $data['rolls']= json_decode($data['session_user']['roll']);
        $notify=$this->Common_model->GetData('notification', "", "production_user='0' and type='da'");
        $data['count']=count($notify);
        if (in_array("Data Analyst", $data['rolls'])) {
         //   $this->load->view('admin/inc/header', $data, false);
            //$this->load->view('admin/DA/dashboard', $data, false);
            $this->load->view('admin/DA/ocr_detail', $data, false);
          //  $this->load->view('admin/inc/footer', $data, false);
        }
    }

       public function aocpdfupload($id)
    {

   ini_set('max_execution_time', 0);
  //  $id=$id;


          $delete1=$this->admin->deleteAll('aoc4data',array('order_id'=>$id));
          $image = '';
            if($_FILES['attachment']['name'])
             {
                $ext = end((explode(".", $_FILES['attachment']['name'])));
                $imgname = $ext[0].substr(md5(microtime()),0,8).'.'.$ext;
                if(move_uploaded_file($_FILES["attachment"]["tmp_name"],"upload/mgt/".$imgname))
                {
                   copy("uploads/mgt/".$imgname,"upload/mgt/resize/".$imgname);
                   $image = $imgname;
                }
            }




 $pdfurl=base_url().'upload/mgt/'.$image;



$finaldatapdf=$this->admin->getRow("SELECT pdf,mgt FROM shareholding WHERE status = 'pdf' AND o_id = ".$id."");

 $array = array(
                        'aoc4file'=>$pdfurl

                    );





   $update = $this->admin->update('orders',array('id'=>$id), $array);


//print_r($array);

// $pdfurl='https://uat.kreditaid.com/upload/mgt/'.$image1;
 $json = @file_get_contents('https://api.ocr.space/parse/imageurl?apikey=5a64d478-9c89-43d8-88e3-c65de9999580&url='.$pdfurl.'&language=eng&isOverlayRequired=true');
   //     $json = @file_get_contents('https://api.ocr.space/parse/imageurl?apikey=5a64d478-9c89-43d8-88e3-c65de9999580&url=http://test.kreditaid.com/test/aocpdf/4.pdf&language=eng&isOverlayRequired=true');
 $obj = json_decode($json,true);
 $temp = count($obj['ParsedResults']);

 //print_r($obj['ParsedResults'][3]['TextOverlay']['Lines']); exit;
 $array1=array();

    for ($i=0; $i<$temp; $i++) {
$temp1 = count($obj['ParsedResults'][$i]['TextOverlay']['Lines']);

if($i == 0){$var= 'a';}
if($i == 1){$var= 'b';}
if($i == 2){$var= 'c';}
if($i == 3){$var= 'd';}
if($i == 4){$var= 'e';}
if($i == 5){$var= 'f';}
if($i == 6){$var= 'g';}
if($i == 7){$var= 'h';}
if($i == 8){$var= 'i';}
if($i == 9){$var= 'j';}
if($i == 10){$var= 'k';}
if($i == 11){$var= 'l';}
if($i == 12){$var= 'm';}
if($i == 13){$var= 'n';}
if($i == 14){$var= 'o';}
if($i == 15){$var= 'p';}


    for ($j=0; $j<$temp1; $j++) {


 $array1[] = array(
            'LineText' =>$obj['ParsedResults'][$i]['TextOverlay']['Lines'][$j]['LineText'],
           'MaxHeight'=>$obj['ParsedResults'][$i]['TextOverlay']['Lines'][$j]['MaxHeight'],
           'MinTop'=> $obj['ParsedResults'][$i]['TextOverlay']['Lines'][$j]['MinTop'],
            'Left'=> $obj['ParsedResults'][$i]['TextOverlay']['Lines'][$j]['Words'][0]['Left'],
           'Page'=>$var,
           'order_id'=>$id,
            );

/*
 $array = array(
           'LineText' =>$obj['ParsedResults'][$i]['TextOverlay']['Lines'][$j]['LineText'],
           'MaxHeight'=>$obj['ParsedResults'][$i]['TextOverlay']['Lines'][$j]['MaxHeight'],
           'MinTop'=> $var.'_'.$obj['ParsedResults'][$i]['TextOverlay']['Lines'][$j]['MinTop'],
           'Page'=>$i+1,
           'order_id'=>1,
            );
 $insert = $this->admin->insert('aoc4data', $array);*/
}

    }
function cmp2($a1, $b1)
{
  if ($a1["MinTop"] == $b1["MinTop"]) {
        return 0;
    }
  return ($a1["MinTop"] < $b1["MinTop"]) ? -1 : 1;
}

usort($array1,"cmp2");
     foreach($array1 as $arrayi){

 $array = array(
            'LineText' =>$arrayi['LineText'],
            'MaxHeight'=>$arrayi['MaxHeight'],
            'MinTop'=>$arrayi['MinTop'],
             'Left'=>$arrayi['Left'],
            'Page'=>$arrayi['Page'],
           'order_id'=>$arrayi['order_id'],
            );
 $insert = $this->admin->insert('aoc4data', $array);
}


    }


   public function pdfupload($id)
    {

   ini_set('max_execution_time', 0);
  //  $id=$id;
           $delete=$this->admin->deleteAll('shareholding',array('o_id'=>$id,'status' => 'mgt'));

           $delete1=$this->admin->deleteAll('ocrdata',array('order_id'=>$id));

                $image = '';
            if($_FILES['attachment']['name'])
             {
                $ext = end((explode(".", $_FILES['attachment']['name'])));
                $imgname = $ext[0].substr(md5(microtime()),0,8).'.'.$ext;
                if(move_uploaded_file($_FILES["attachment"]["tmp_name"],"upload/mgt/".$imgname))
                {
                   copy("uploads/mgt/".$imgname,"upload/mgt/resize/".$imgname);
                   $image = $imgname;
                }
            }

                $image1 = '';
            if($_FILES['mgt']['name'])
             {
                $ext1 = end((explode(".", $_FILES['mgt']['name'])));
                $imgname1 = $ext1[0].substr(md5(microtime()),0,8).'.'.$ext1;
                if(move_uploaded_file($_FILES["mgt"]["tmp_name"],"upload/mgt/".$imgname1))
                {
                   copy("uploads/mgt/".$imgname1,"upload/mgt/resize/".$imgname1);
                   $image1 = $imgname1;
                }
            }



 $pdfurl=base_url().'upload/mgt/'.$image;
 $mgturl=base_url().'upload/mgt/'.$image1;


$finaldatapdf=$this->admin->getRow("SELECT pdf,mgt FROM shareholding WHERE status = 'pdf' AND o_id = ".$id."");

 $array = array(
                        'linetext'=>'pdf',
                        'o_id' =>$id,
                        'status'=>'pdf',
                    );

 if(!empty($image))
            {
                $array['pdf']=$pdfurl;
            }
            if(!empty($image1))
            {
                $array['mgt']=$mgturl;
            }
   if($finaldatapdf->pdf != '' || $finaldatapdf->mgt != '')
   {

   $update = $this->admin->update('shareholding',array('o_id'=>$id,'status'=>'pdf'), $array);
   }else{
   $insert = $this->admin->insert('shareholding', $array);
   }

print_r($array);

// $pdfurl='https://uat.kreditaid.com/upload/mgt/'.$image1;
 $json = @file_get_contents('https://api.ocr.space/parse/imageurl?apikey=5a64d478-9c89-43d8-88e3-c65de9999580&url='.$mgturl.'&language=eng&isOverlayRequired=true');
 $obj = json_decode($json,true);
 $temp = count($obj['ParsedResults'][0]['TextOverlay']['Lines']);
 $array1=array();
    for ($i=0; $i<$temp; $i++) {
  $array1[] = array(
           'LineText' =>$obj['ParsedResults'][0]['TextOverlay']['Lines'][$i]['LineText'],
          // 'MaxHeight'=>$obj['ParsedResults'][0]['TextOverlay']['Lines'][$i]['MaxHeight'],
           'MinTop'=>$obj['ParsedResults'][0]['TextOverlay']['Lines'][$i]['MinTop'],
          // 'Words'=>$obj['ParsedResults'][0]['TextOverlay']['Lines'][$i]['Words'],
           //  'cin'=>$obj['ParsedResults'][0]['TextOverlay']['Lines'][23]['LineText'],
            // 'order_id'=>1,

            );


    }
     //echo $obj['ParsedResults'][0]['Overlay']['Lines'][23]['LineText'];

      // $insert = $this->admin->insert_multi('ocrdata', $array1);


         function cmp2($a1, $b1)
{
  if ($a1["MinTop"] == $b1["MinTop"]) {
        return 0;
    }
  return ($a1["MinTop"] < $b1["MinTop"]) ? -1 : 1;
}

usort($array1,"cmp2");

$key = array_search('(d) •Telephone number with STD code', array_column($array1, 'LineText'));
$key1 = $key + 1;
$key2 = array_search('Pre-fill', array_column($array1, 'LineText'));
$key3 = $key2 + 1;

 $cinmgt=$this->admin->getVal("SELECT items FROM orders WHERE id = ".$id."");


 $finaldatamgt=$this->admin->getRow("SELECT contact,cin FROM shareholding WHERE status = 'mgt' AND o_id = ".$id."");

 $array2 = array(
            'contact' =>$array1[$key1]['LineText'],
            'cin'=>$cinmgt,
            'o_id'=>$id,
             'status'=>'mgt',
            );
   if($finaldatamgt->contact != '' || $finaldatamgt->cin != '')
   {

   $update = $this->admin->update('shareholding',array('o_id'=>$id,'status'=>'mgt'), $array2);
   }else{
   $insert = $this->admin->insert('shareholding', $array2);
   }


    }


     public function save(){


      //  sqlQuery('delete from shareholding');

// accept parameters (p is array)
         // $data['search'] = $this->input->get('p');
$arr =$this->input->get('p');
$id =$this->input->post('id');
$totalamount =$this->input->post('totalamount');
$totalpersent =$this->input->post('totalpersent');
$arr1 =$this->input->post('array');

//print_r($arr1); exit;
  $delete=$this->admin->deleteAll('shareholding',array('order_id'=>$id));
           $delete=$this->admin->deleteAll('shareholding',array('o_id'=>$id,'status' => 'total'));

$i=0;
foreach ($arr as $p) {

  list($sub_id, $tbl, $row, $col) = explode('_', $p);

  // discard clone id part from the sub_id
  $sub_id = substr($sub_id, 0, 2);

  // insert to the database
 // sqlQuery("insert into shareholding (sub_id, tbl_row, tbl_col) values ('$sub_id', $row, $col)");
  $array = array(
           'sub_id' =>$sub_id,
          'linetext' => $arr1[$i]['value'],
           'tbl_row' =>$row,
           'tbl_col' =>$col,
           'order_id'=>$id,

            );

   $insert = $this->admin->insert('shareholding', $array);
    $i++;
}

  //$data = json_decode($this->input->post('array'), true);
//var_dump($data);

  $array1 = array(

          'linetext' => 'Total',
          'amount' => $totalamount,
          'persent' => $totalpersent,
          'o_id'=>$id,
          'status' => 'total'
            );

   $insert = $this->admin->insert('shareholding', $array1);
 $mgt=$this->admin->getRow("SELECT contact,cin FROM shareholding WHERE status = 'mgt' AND o_id = ".$id."");

 $data=$this->admin->getRows("SELECT * FROM shareholding WHERE order_id = ".$id." ORDER BY tbl_row,tbl_col ASC");

                   // echo $data[0]->linetext; exit;
                  //  print_r($data);

                    $dataaaray= array();
$j=0;
                    for($i=0;$i<sizeof($data);$i+=3){
                      $j++;

                       $dataaaray[] = array(
    'SNo' => $j,
    'Name' => $data[$i+0]->linetext,
    'NoOfShare'=>$data[$i+1]->linetext,
 'PercentageHolding'=>$data[$i+2]->linetext,
  'IncorporationNo'=>$mgt->cin,
  'ContactNo'=>$mgt->contact

);


                    }


$dataaar= array(
   "json"=>$dataaaray

);



//array( "json" : $dataaaray);
                     $payload = json_encode($dataaar);



$url ="http://ec2-15-206-122-169.ap-south-1.compute.amazonaws.com:8080/CentralWebService/ConsumeSHData.asmx/InsertSHDataINCWS";

                     $ch = curl_init( $url );
# Setup request to send json via POST.
//$payload = json_encode( array( "customer"=> $data ) );
curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
# Return response instead of printing.
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
# Send request.
$result = curl_exec($ch);
curl_close($ch);

print_r($payload);exit;
 // redirect('zuba');
      }

         public function savepersent(){


      //  sqlQuery('delete from shareholding');

// accept parameters (p is array)
         // $data['search'] = $this->input->get('p');
$arr =$this->input->get('p');
$id =$this->input->post('id');
$totalamount =$this->input->post('totalamount');
$totalpersent =$this->input->post('totalpersent');
$arr1 =$this->input->post('array');


//  $delete=$this->admin->deleteAll('shareholding',array('order_id'=>$id));
$amount = 0;
$persent = 0;
$i=0;
foreach ($arr as $p) {

  list($sub_id, $tbl, $row, $col) = explode('_', $p);

  $sub_id = substr($sub_id, 0, 2);



  if($col == 2){
$amount+=$arr1[$i]['value'];
 //$arr1[$i]['value']
  }
    if($col == 3){
$persent+= $arr1[$i]['value'];

  }


 //  $insert = $this->admin->insert('shareholding', $array);
    $i++;
}


  echo $amount.'_'.$persent; exit;

      }

         public function clear(){
   $id =$this->input->post('id');

  $delete=$this->admin->deleteAll('shareholding',array('order_id'=>$id));

      }

             public function removedata(){
   $id =$this->input->post('id');
   $rowid =$this->input->post('rowid');
  $delete=$this->admin->deleteAll('shareholding',array('order_id'=>$id,'tbl_row'=>$rowid));

      }

    public    function timetable($hour, $row) {


     $CI =& get_instance();
    $query =  $CI->db->query("select concat(t.tbl_row,'_',t.tbl_col) as pos, t.tbl_id, t.sub_id, t.LineText  from shareholding t where t.order_id ='".$GLOBALS['a']."'");

   // $query =  $CI->db->query("select concat(t.tbl_row,'_',t.tbl_col) as pos, t.tbl_id, t.sub_id, t.LineText  from shareholding t where t.order_id ='".$this->session->userdata('ocr_id')."'");

    $result =  $query->result_array();

 // print '<tr class="table-primary">';
 // print '<td class="mark dark">' . $hour . '</td>';

    print '<tr class="table-primary" id="r'. $hour .'" >';
print '<td class="mark dark">' . $hour . '</td>';
  // column loop starts from 1 because column 0 is for hours
  for ($col=1; $col <= 3; $col++) {


    // create table cell
    print '<td>';
    // prepare position key in the same way as the array key looks
    $pos = $row . '_' . $col;
    // if content for the current position exists





       foreach ($result as $elements) {
  //  $id   = $subject->id;
   // $name = $subject->LineText;
         if ($elements['pos']==$pos) {
    $id = $elements['sub_id'];
        $name = $elements['LineText'];
        print "<div id=\"$id\" class=\"drag green\"><input type=\"text\" name=\"array[]\" style=\"width: 300px\"  value=\"$name\"/></div>";
      }
  }
    // close table cell

    print '</td>';
  }
  print '<td class="mark dark">   <button type="button" onclick="deleterow(tabletbody,' . $hour .')" name="button" class="btn btn-danger pull-right" style="border-radius:20px;margin-right: 20px;">
     <i class="fa fa-minus"></i></button></td>';
  // print_r(' <input type=\"button\" value=\"Clear\" class=\"button\" onclick=\"cleardata()\" title="Save timetable"/>');
  print "</tr>\n";
}
    public function financial_analyst()
    {
        $data['title'] = 'Financial Analyst';
        $data['menu'] = 'FA_logs';

        $data['session_user']=$this->session->userdata('admin_in');
          $user_id=$data['session_user']['id'];
        $this->load->model('Cart_model');
        $data['Orders'] = $this->Cart_model->getDetailedReportOrders();
        $notify=$this->Common_model->GetData('notification', "", "production_user='0' and type='fa'");
        $data['count']=count($notify);
          $data['get_admin']=$this->Common_model->get_single('admin', "id='".$user_id."' and usergroup='PU'");
        $data['rolls']= json_decode($data['session_user']['roll']);
        if (in_array("Financial Analyst", $data['rolls'])) {
            $this->load->view('admin/inc/header', $data, false);
            $this->load->view('admin/FA/dashboard', $data, false);
            $this->load->view('admin/inc/footer', $data, false);
        }
    }
    public function dashboard()
    {
        $data['session_user']=$this->session->userdata('admin_in');
        if (!($data['session_user']['usergroup']=="ADMIN")) {
            redirect(base_url('admin/dashboard'));
        }
        $data['title'] = 'Admin Dashboard';
        $data['menu'] = 'dashboard';
      //  $get_company=$this->Common_model->GetData('company', "count(name) as total", "",'','','','1');
        //print_r($get_company->total); exit;
      //  $data['total_company']=$this->admin->getVal('SELECT count(id) FROM company');
 $data['total_company']=2042533;
        //$data['total_company']=$get_company->total;
    //   $sales=$this->Common_model->GetData('orders', "", "product_status='complete'");
//        $data['total_sales']=count($sales);
         $data['total_sales']=$this->admin->getVal('SELECT count(id) FROM orders WHERE product_status="complete"');

        /*$product=$this->Common_model->GetData('product',"");
        $data['total_product']=count($product);*/
        $data['total_orders']=$this->admin->getVal('SELECT count(id) FROM orders WHERE status="paid"');
//        $orders=$this->Common_model->GetData('orders', "", "status='paid'");
//        $data['total_orders']=count($orders);
//       $users=$this->Common_model->GetData('users', "");
//        $data['total_user']=count($users);
        $data['total_user']=$this->admin->getVal('SELECT count(id) FROM users');
         $data['total_prod']=$this->admin->getVal('SELECT count(id) FROM admin');
//        $production_users=$this->Common_model->GetData('admin', "");
 //       $data['total_prod']=count($production_users);
        $data['total_amount']=$this->admin->getVal('SELECT SUM(total_amount) FROM billing_address');
//        $amount=$this->Common_model->GetData('billing_address', "SUM(total_amount) as total_amt", "");
//        $data['total_amount']= number_format($amount[0]->total_amt);
     //   $data['total_cert']=$this->admin->getVal('SELECT count(id) FROM report_certificate');
        //  $cert_doc=$this->Common_model->GetData('report_certificate', "");
        //  $data['total_cert']=count($cert_doc);
 //       $enquiry=$this->Common_model->GetData('contact', "");
 //       $data['total_enquiry']=count($enquiry);
        $data['total_enquiry']=$this->admin->getVal('SELECT count(id) FROM contact');
 //       $charges=$this->Common_model->GetData('charges', "Charge_Holder", "");
 //       $data['total_charges']=count($charges);
        $data['total_charges']=$this->admin->getVal('SELECT count(Charge_Holder) FROM charges');
         $data['total_full_comp']=$this->admin->getVal('SELECT count(id) FROM orders where category="Full Company Report"');
 //       $detail_report=$this->Common_model->GetData('orders', "", "category='Full Company Report'");
 //       $data['total_full_comp']=count($detail_report);
          $data['total_recent_corp']=$this->admin->getVal('SELECT count(id) FROM orders where category="recent incorporation"');
 //       $recent_incor=$this->Common_model->GetData('orders', "", "category='recent incorporation'");
 //       $data['total_recent_corp']=count($recent_incor);
          $data['total_new_corp']=$this->admin->getVal('SELECT count(id) FROM orders where category="new incorporation"');
 //       $new_incor=$this->Common_model->GetData('orders', "", "category='new incorporation'");
 //       $data['total_new_corp']=count($new_incor);
            $data['total_track_comp']=$this->admin->getVal('SELECT count(id) FROM orders where category="Track a Company"');
 //       $track_comp=$this->Common_model->GetData('orders', "", "category='Track a Company'");
 //       $data['total_track_comp']=count($track_comp);
              $data['total_today_orer']=$this->admin->getVal('SELECT count(id) FROM orders where LEFT(date,10)="'.date('Y-m-d').'"');
 //       $today_order=$this->Common_model->GetData('orders', "", "LEFT(date,10)='".date('Y-m-d')."'");
  //      $data['total_today_orer']=count($today_order);
                $data['total_wallet_user']=$this->admin->getVal('SELECT count(DISTINCT(user_id)) FROM e_wallet ');
  //      $wallet_user=$this->Common_model->GetData('e_wallet', "", "", "user_id");
 //       $data['total_wallet_user']=count($wallet_user);
 //       $use_wallet_user=$this->Common_model->GetData('e_wallet', "", "", "", "id DESC");
   //     echo $this->db->last_query();
//  $data['use_wallet_user']=$this->admin->getVal('SELECT count(id) FROM e_wallet where category="Track a Company"');
//  $data['count']=$this->admin->getVal('SELECT count(id) FROM notification where admin_status=0');
  //      $data['use_wallet_user']=count($use_wallet_user);
  //      $notify=$this->Common_model->GetData('notification', "", "admin_status='0'");
  //      echo $this->db->last_query();
  //      $data['count']=count($notify);

        $this->load->view('admin/inc/header', $data, false);
        $this->load->view('admin/master/admin_dashboard', $data, false);
        $this->load->view('admin/inc/footer', $data, false);
    }
    public function users()
    {
        $data['get_country']=$this->Common_model->GetData('countries');
        $data['session_user']=$this->session->userdata('admin_in');
        if (!($data['session_user']['usergroup']=="ADMIN")) {
            redirect(base_url('admin/dashboard'));
        }
        $data['title'] = 'Admin Dashboard';
        $data['menu'] = 'users';
        $this->load->model('Crud_model');
        $data['Users'] = $this->Crud_model->getItems('users');
        $data['Admins'] = $this->Crud_model->getItems('admin');
        $notify=$this->Common_model->GetData('notification', "", "admin_status='0'");
        $data['count']=count($notify);
        $this->load->view('admin/inc/header', $data, false);
        $this->load->view('admin/master/users', $data, false);
        $this->load->view('admin/inc/footer', $data, false);
    }
 public function activeuser($id)
    {
        $array = array(
                'password'=>0,
                 );
        if ($id>0) {
            $update = $this->admin->update('users', array('id'=>$id), $array);
        }

    }

    public function password_reset($id)
    {
         $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
// Output: 54esmdr0qf
$pass = substr(str_shuffle($permitted_chars), 0, 8);
        $password = Utils::hash('sha1', $pass, AUTH_SALT);
        $array = array(
                'password'=>$password,
                 );
        if ($id>0) {
            $update = $this->admin->update('users', array('id'=>$id), $array);
            // $email = $_POST['email'];
             $this->load->model('Common_model');
    $get_email = $this->Common_model->GetData('users','',"id='".$id."'",'','','','1');
      
        $email=$get_email->email;
        $array1=array(
                    'name' =>'Reset Password',
                    'url' =>'reset_password',
                    'status' =>'0',
                    'user_id' =>$id,
                    );
        $this->Common_model->SaveData('notification',$array1);

   $to='bhupendra@agomic.com';
   $subject='Reset Password';
   $data['get_email']=$get_email;
   $view='emails/forgot_password';

$error_data=  $this->Send_mail->send($id,$to,$view,$subject,$data);
  echo $error_data;
  exit();
        }

       
  

    }
     public function inactiveuser($id)
    {
      //  $data['get_users']=$this->Common_model->get_single('users',"id='".$id."'");
        //print_r($data['get_users']); exit;
        $data = array(
                    'is_active'=>1,
                 );
        if ($id>0) {
            $update = $this->admin->update('users', array('id'=>$id), $data);
        }
        $subject="Active Registration User";
        $to='maskareamit@gmail.com';
        $id="1";
        $view='emails/contact_form';
        $this->Send_mail->send($id, $to, $view, $subject, $data);
    }

     public function adminactiveuser($id)
    {
        $array = array(
                'is_active'=>1,
                 );
        if ($id>0) {
            $update = $this->admin->update('admin', array('id'=>$id), $array);
        }

    }
      public function adminpassword_reset($id)
    {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
// Output: 54esmdr0qf
$pass = substr(str_shuffle($permitted_chars), 0, 8);
        $password = Utils::hash('sha1', $pass, AUTH_SALT);
        $array = array(
                'password'=>$password,
                 );
        if ($id>0) {
            $update = $this->admin->update('admin', array('id'=>$id), $array);
        }

    }
     public function admininactiveuser($id)
    {
      //  $data['get_users']=$this->Common_model->get_single('users',"id='".$id."'");
        //print_r($data['get_users']); exit;
        $data = array(
                    'is_active'=>0,
                 );
        if ($id>0) {
            $update = $this->admin->update('admin', array('id'=>$id), $data);
        }
        $subject="Active Registration User";
        $to='maskareamit@gmail.com';
        $id="1";
        $view='emails/contact_form';
        $this->Send_mail->send($id, $to, $view, $subject, $data);
    }
       public function convert($id)
   {
      $data['update_user']=$this->Common_model->GetData('users','',"id='".$id."'",'',"",'','1');
      //print_r($update_blog->name); exit;
      $data['get_country']=$this->Common_model->GetData('countries');
     $data['session_user']=$this->session->userdata('admin_in');
       if (!($data['session_user']['usergroup']=="ADMIN")) {
           redirect(base_url('admin/dashboard'));
       }
       $data['title'] = 'Admin| Postpaid Users';
         $data['data'] = array('sub_heading'=>'Update Postpaid Users',
               'button'=>'Update Postpaid Users',
                   //'action'=>base_url('admin/Blog/update_action'),
                   'name' =>$data['update_user']->name,
                   'email' =>$data['update_user']->email,
                   'start_date' =>date('d-m-Y',strtotime($data['update_user']->start_date)),
                   'end_date' =>date('d-m-Y',strtotime($data['update_user']->end_date)),
                   'no_of_report' =>$data['update_user']->no_of_report,
                   'invoice' =>$data['update_user']->invoice,
                   'purchase_status'=>$data['update_user']->purchase_status,
                     'max_status'=>$data['update_user']->max_status,
                   'company' =>$data['update_user']->company,
                   'country_id' =>$data['update_user']->country_id,
                   'password' =>$data['update_user']->password,
                   'confirm_password' =>$data['update_user']->password,
                   'id' =>$id,
         );

        $this->load->view('admin/inc/header',$data);
       $this->load->view('admin/manage_website/convert_postpaid_form', $data);
       $this->load->view('admin/inc/footer');
   }


    public function notification()
    {
        $data['session_user']=$this->session->userdata('admin_in');
        if (!($data['session_user']['usergroup']=="ADMIN")) {
            redirect(base_url('admin/dashboard'));
        }
        $data['title'] = 'Admin Notification';
        $data['menu'] = 'notification';
        $con="no.admin_status='1'";
        $data['notification']=$this->Crud_model->list_notification($con);
        $data1=array(
                'admin_status'=>1,
            );
        $this->Common_model->SaveData('notification', $data1, "admin_status='0'");
        $notify=$this->Common_model->GetData('notification', "", "admin_status='0'");
        $data['count']=count($notify);
        $this->load->view('admin/inc/header', $data, false);
        $this->load->view('admin/master/admin_notification', $data);
        $this->load->view('admin/inc/footer', $data, false);
    }
    public function setting()
    {
        $data['session_user']=$this->session->userdata('admin_in');
      $user_id=$data['session_user']['id'];
        if (!($data['session_user']['usergroup']=="ADMIN")) {
            redirect(base_url('admin/dashboard'));
        }
        $data['title'] = 'Admin|Setting';
        $data['menu'] = 'setting';
        $notify=$this->Common_model->GetData('notification', "", "admin_status='0'");
        $data['count']=count($notify);
        $data['get_admin']=$this->Common_model->get_single('admin', "id='".$user_id."'");
        //print_r($data['get_admin']->id); exit;
        $this->load->view('admin/inc/header', $data, false);
        $this->load->view('admin/master/setting', $data);
        $this->load->view('admin/inc/footer', $data, false);
    }

    public function change_password()
    {
        $data['session_user']=$this->session->userdata('admin_in');
      $user_id=$data['session_user']['id'];
        if (!($data['session_user']['usergroup']=="ADMIN")) {
            redirect(base_url('admin/dashboard'));
        }
        $data['title'] = 'Admin|Setting';
        $data['menu'] = 'change_password';
        $notify=$this->Common_model->GetData('notification', "", "admin_status='0'");
        $data['count']=count($notify);
        $data['get_admin']=$this->Common_model->get_single('admin', "id='".$user_id."'");
        //print_r($data['get_admin']->id); exit;
        $this->load->view('admin/inc/header', $data, false);
        $this->load->view('admin/master/change_password', $data);
        $this->load->view('admin/inc/footer', $data, false);
    }

    public function orders()
    {
        $data['session_user']=$this->session->userdata('admin_in');
        if (!($data['session_user']['usergroup']=="ADMIN")) {
            redirect(base_url('admin/dashboard'));
        }
        $data['title'] = 'Admin Dashboard';
        $data['menu'] = 'Orders';
        $this->load->model('Cart_model');
        $data['Orders'] = $this->Cart_model->getOrders();
        $notify=$this->Common_model->GetData('notification', "", "admin_status='0'");
        $data['count']=count($notify);
        $this->load->view('admin/inc/header', $data, false);
        $this->load->view('admin/master/dashboard', $data, false);
        $this->load->view('admin/inc/footer', $data, false);
    }
    public function view_details($id)
    {
        $data['title'] = 'Dashboard | Orders';
        $data['menu'] = 'orders';
        $data['session_user']=$this->session->userdata('admin_in');
        $this->load->model('Cart_model');
        $data['Item']=$this->Cart_model->getOrderById($id);

        $this->load->view('admin/inc/header', $data, false);
        $this->load->view('admin/master/view_order', $data, false);
        $this->load->view('admin/inc/footer', $data, false);
    }



    public function order_details($id)
    {
        $data['title'] = 'Dashboard | Orders';
        $data['menu'] = 'orders';
        $data['css'] = 'upload';
        $data['libs']="dropzone";
        $data['session_user']=$this->session->userdata('admin_in');
        $this->load->model('Cart_model');
        $data['Item']=$this->Cart_model->getOrderById($id);
        $data['Files']=$this->Cart_model->mydocuments($data['Item']['tracking_id']);
        $this->load->view('admin/inc/header', $data, false);
        $this->load->view('admin/Downloader/details', $data, false);
        $this->load->view('admin/inc/footer', $data, false);
    }

    public function review_report($id)
    {
        $data['title'] = 'Dashboard | Orders';
        $data['menu'] = 'orders';
        $data['session_user']=$this->session->userdata('admin_in');
        $this->load->model('Cart_model');
        $data['Item']=$this->Cart_model->getReportByTrackingId($id);

        $this->load->view('admin/inc/header', $data, false);
        $this->load->view('admin/report', $data, false);
        $this->load->view('admin/inc/footer', $data, false);
    }

    public function sendToDa()
    {
        $this->load->model('Cart_model');
        $data['message']=$this->Cart_model->sendToDa();
        echo json_encode($data['message']);
        // redirect(base_url('admin/dashboard'));
    }
    public function sendToFA($id)
    {
        $this->load->model('Cart_model');
        $data['message']=$this->Cart_model->sendToFA($id);
        $this->session->set_flashdata('msg', $data['message']);
        echo json_encode($data);
    }


    public function sendToUser($id)
    {

        $this->load->model('Cart_model');
        $this->load->model('Common_model');
        $data['message']=$this->Cart_model->sendToUser($id);
        // notification
          $data['get_orders']=$this->Common_model->get_single('orders',"tracking_id='".$id."' and da='completed'");
          $get_users=$this->Common_model->get_single('users',"id='".$data['get_orders']->user_id."'");
        $array1=array(
                  'name' =>'Completed Report',
                  'status' =>'0',
                  'url' =>'dashboard',
                  "admin_status" => 1,
                  'type'=>'user',
                  'order_id'=>$id,
                  'user_id' =>$data['get_orders']->user_id,
                  );
              $this->db->insert('notification', $array1);
              // end notification
              $subject="Completed Report";
              $to=$get_users->email;
              $id="1";
              $view='emails/production_user_fullreport';
             $this->Send_mail->send($id,$to,$view,$subject,$data);
        $this->session->set_flashdata('msg', $data['message']);
        echo json_encode($data);
    }
    public function returnToDL($id)
    {
        $this->load->model('Cart_model');
        $data['message']=$this->Cart_model->returnToDL($id);
        $this->session->set_flashdata('msg', $data['message']);
        echo json_encode($data);
    }
    public function returnToDA($id)
    {
        $this->load->model('Cart_model');
        $data['message']=$this->Cart_model->returnToDA($id);
        $array1=array(
                  'name' =>'Report Return From Financial Analyst',
                  'production_user' =>'0',
                  'type' =>'da',
                  );
              $this->Common_model->SaveData('notification',$array1);
        $this->session->set_flashdata('msg', $data['message']);
        echo json_encode($data);
    }


    public function save_user_data()
    {
        $form_data=$_POST['form_data'];
        $dta=json_encode($this->input->post('myarray'));

        $d= explode('&', $form_data);
        $q=explode('=', $d[1]);

        $id= $q[1];
        $this->db->where('id', $id);
        $this->db->update('admin', array('assign_to'=>$dta));
    }
    public function get_assign_role()
    {
        $id=$_POST['id'];
        $get_assign=$this->Common_model->GetData('admin', "", "id='".$id."'", "", "", "", "1");

        $assign=json_decode($get_assign->assign_to);

        if (!empty($assign)) {
            $a=array();
            $b=array();
            $c=array();

            foreach ($assign as $row) {
                if ($row=='Downloader') {
                    $a = "selected";
                }

                if ($row=='Data Analyst') {
                    $b = "selected";
                }

                if ($row=='Financial Analyst') {
                    $c = "selected";
                }
            }
        } else {
            $a="";
            $b="";
            $c="";
        }
        $data=array(
        'downloader'=>$a,
        'da'=>$b,
        'fa'=>$c,
     );

        echo  json_encode($data);
    }

    public function logout()
    {
        $this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();
        Utils::no_cache();
        redirect(base_url('admin/dashboard'));
    }

    public function wallet_user()
    {
      $data['session_user']=$this->session->userdata('admin_in');
        if (!($data['session_user']['usergroup']=="ADMIN")) {
            redirect(base_url('admin/dashboard'));
        }
        $data['title'] = 'Admin Dashboard';
        $data['menu'] = 'wallet_user';
        // $this->load->model('Crud_model');id
       // $data['datalist']=$this->admin->getRows('SELECT u.*,c.name as cname FROM e_wallet e,users u,countries c where e.user_id=u.id and e.status =1 and c.id=u.country_id group by u.id');
        $notify=$this->Common_model->GetData('notification', "", "admin_status='0'");
        $data['count']=count($notify);
         $data['slab']=$this->admin->getRows('SELECT u.* FROM users u,e_wallet e where e.user_id =u.id group by u.id ');

        $this->load->view('admin/inc/header', $data, false);
        $this->load->view('admin/wallet/walletuser', $data, false);
        $this->load->view('admin/inc/footer', $data, false);
    }

      public function wallet_request()
    {
      $data['session_user']=$this->session->userdata('admin_in');
        if (!($data['session_user']['usergroup']=="ADMIN")) {
            redirect(base_url('admin/dashboard'));
        }
        $data['title'] = 'Admin Dashboard';
        $data['menu'] = 'wallet_request';
        // $this->load->model('Crud_model');id
       // $data['datalist']=$this->admin->getRows('SELECT u.*,c.name as cname FROM e_wallet e,users u,countries c where e.user_id=u.id and e.status =1 and c.id=u.country_id group by u.id');
        $notify=$this->Common_model->GetData('notification', "", "admin_status='0'");
        $data['count']=count($notify);
         $data['slab']=$this->admin->getRows('SELECT u.*,r.amount,r.approve_amount,r.message,r.created,r.id as rid FROM users u,recharge_request r where r.user_id =u.id order by r.id desc');

        $this->load->view('admin/inc/header', $data, false);
        $this->load->view('admin/wallet/walletrequest', $data, false);
        $this->load->view('admin/inc/footer', $data, false);
    }

 public function wallet_request_detail($id)
    {
      $data['session_user']=$this->session->userdata('admin_in');
        if (!($data['session_user']['usergroup']=="ADMIN")) {
            redirect(base_url('admin/dashboard'));
        }
        $data['title'] = 'Admin Dashboard';
        $data['menu'] = 'wallet_request';
    // $this->load->model('Crud_model');id
       //$data['datalist']=$this->admin->getRows('SELECT u.*,c.name as cname FROM e_wallet e,users u,countries c where e.user_id=u.id and e.status =1 and c.id=u.country_id group by u.id');
        $notify=$this->Common_model->GetData('notification', "", "admin_status='0'");
        $data['count']=count($notify);

        $data['selectall']=$this->admin->getRow('SELECT u.*,r.amount,r.message,r.created,r.approve_amount,r.id as rid,r.status FROM users u,recharge_request r where r.user_id =u.id and r.id ="'.$id.'" order by r.id desc');
     //   $data['slab1']=$this->admin->getRows('SELECT u.name,e.* FROM users u,e_wallet e where e.user_id =u.id and e.user_id ="'.$id.'" ');
       //  $data['slab']=$this->admin->getRows('SELECT u.* FROM users u,e_wallet e where e.user_id =u.id group by u.id ');
//print_r($data['selectall']);exit;
        $data['id'] = $id;

        $this->load->view('admin/inc/header', $data, false);
        $this->load->view('admin/wallet/walletrequestdetail', $data, false);
        $this->load->view('admin/inc/footer', $data, false);
    }

     public function wallet_user_detail($id)
    {
      $data['session_user']=$this->session->userdata('admin_in');
        if (!($data['session_user']['usergroup']=="ADMIN")) {
            redirect(base_url('admin/dashboard'));
        }
        $data['title'] = 'Admin Dashboard';
        $data['menu'] = 'wallet_user';
        // $this->load->model('Crud_model');id
       // $data['datalist']=$this->admin->getRows('SELECT u.*,c.name as cname FROM e_wallet e,users u,countries c where e.user_id=u.id and e.status =1 and c.id=u.country_id group by u.id');
        $notify=$this->Common_model->GetData('notification', "", "admin_status='0'");
        $data['count']=count($notify);
        $data['slab1']=$this->admin->getRows('SELECT u.name,e.* FROM users u,e_wallet e where e.user_id =u.id and e.user_id ="'.$id.'" ');
       //  $data['slab']=$this->admin->getRows('SELECT u.* FROM users u,e_wallet e where e.user_id =u.id group by u.id ');

        $data['id'] = $id;

        $this->load->view('admin/inc/header', $data, false);
        $this->load->view('admin/wallet/walletuserdetail', $data, false);
        $this->load->view('admin/inc/footer', $data, false);
    }


      public function postpaid_invoice()
    {
      $data['session_user']=$this->session->userdata('admin_in');
        if (!($data['session_user']['usergroup']=="ADMIN")) {
            redirect(base_url('admin/dashboard'));
        }
        $data['title'] = 'Admin Dashboard';
        $data['menu'] = 'postpaid_invoice';
        // $this->load->model('Crud_model');id
       // $data['datalist']=$this->admin->getRows('SELECT u.*,c.name as cname FROM e_wallet e,users u,countries c where e.user_id=u.id and e.status =1 and c.id=u.country_id group by u.id');
        $notify=$this->Common_model->GetData('notification', "", "admin_status='0'");
        $data['count']=count($notify);

        $this->load->view('admin/inc/header', $data, false);
        $this->load->view('admin/wallet/postpaid_invoice', $data, false);
        $this->load->view('admin/inc/footer', $data, false);
    }

     public function postpaid_detail($id=0)
    {
        $data['session_user']=$this->session->userdata('admin_in');
        if (!($data['session_user']['usergroup']=="ADMIN")) {
            redirect(base_url('admin/dashboard'));
        }
        $data['title'] = 'Admin Dashboard';
        $data['menu'] = 'postpaid_invoice';


        if ($id) {
            $data['selectall']=$this->admin->getRow('select * from postpaid_invoice where id='.$id.'');
        }

        $this->load->view('admin/inc/header', $data, false);
        $this->load->view('admin/wallet/postpaid_detail', $data, false);
        $this->load->view('admin/inc/footer', $data, false);
    }
    public function update_invoice()
    {
        $id=$this->input->post('id');

        $array = array(
                    'status'            =>$this->input->post('status') ,

                 );

        if ($id>0) {
            $update = $this->admin->update('postpaid_invoice', array('id'=>$id), $array);

            if ($update) {
                // $this->messages->add('Updated successfully', "alert-success");
                redirect('admin/dashboard/postpaid_invoice');
            }
        } else {

                //$this->messages->add('Added successfully', "alert-success");
                redirect('admin/dashboard/postpaid_invoice');
            }

    }
    public function website_control()
    {
        $data['session_user']=$this->session->userdata('admin_in');
        if (!($data['session_user']['usergroup']=="ADMIN")) {
            redirect(base_url('admin/dashboard'));
        }
        $data['title'] = 'Admin Dashboard';
        $data['menu'] = 'Website_control';
        $data['datalist']=$this->admin->getRows('SELECT e.* FROM e_wallet e,users u where e.user_id=u.id and e.status =1');
        $notify=$this->Common_model->GetData('notification', "", "admin_status='0'");
        $data['count']=count($notify);

        $this->load->view('admin/inc/header', $data, false);
        $this->load->view('admin/wallet/wallet', $data, false);
        $this->load->view('admin/inc/footer', $data, false);
    }

 public function wallet_control($id=0)
    {
        $data['session_user']=$this->session->userdata('admin_in');
        if (!($data['session_user']['usergroup']=="ADMIN")) {
            redirect(base_url('admin/dashboard'));
        }
        $data['title'] = 'Admin Dashboard';
        $data['menu'] = 'Website_control';
        $data['datalist']=$this->admin->getRows('SELECT e.* FROM e_wallet e,users u where e.user_id=u.id and e.status =1 and id='.$id.'');
        $notify=$this->Common_model->GetData('notification', "", "admin_status='0'");
        $data['count']=count($notify);
        $data['id'] = $id;
        $this->load->view('admin/inc/header', $data, false);
        $this->load->view('admin/wallet/wallet', $data, false);
        $this->load->view('admin/inc/footer', $data, false);
    }
    public function rechargedetail($id=0)
    {
        $data['title'] = 'Admin Dashboard';
        $data['menu'] = 'Website_control';
        if ($id) {
            $data['selectall']=$this->admin->getRow('select * from e_wallet where id='.$id.'');
        }
        $this->load->view('admin/inc/header', $data, false);
        $this->load->view('admin/wallet/rechargedetail', $data, false);
        $this->load->view('admin/inc/footer', $data, false);
    }
    public function rechargedetail22()
    {
        $data['session_user']=$this->session->userdata('admin_in');
        if (!($data['session_user']['usergroup']=="ADMIN")) {
            redirect(base_url('admin/dashboard'));
        }
        $data['title'] = 'Admin Dashboard';
        $data['menu'] = 'Website_control';
        $this->load->model('Crud_model');
        $data['datalist']=$this->admin->getRows('SELECT * FROM e_wallet ');



        $this->load->view('admin/inc/header', $data, false);
        $this->load->view('admin/wallet/rechargedetail', $data, false);
        $this->load->view('admin/inc/footer', $data, false);
    }

    public function slabs()
    {
        $data['session_user']=$this->session->userdata('admin_in');
        if (!($data['session_user']['usergroup']=="ADMIN")) {
            redirect(base_url('admin/dashboard'));
        }
        $data['title'] = 'Admin Dashboard';
        $data['menu'] = 'Website_slabs';
        // $this->load->model('Crud_model');
        $data['creditsvalue']=$this->admin->getRow('SELECT * FROM creditsvalue where id =1');

        $data['slab']=$this->admin->getRows('SELECT * FROM prepaidcoin ');

        $this->load->view('admin/inc/header', $data, false);
        $this->load->view('admin/wallet/slabs', $data, false);
        $this->load->view('admin/inc/footer', $data, false);
    }
    public function addslabs($id=0)
    {
        $data['session_user']=$this->session->userdata('admin_in');
        if (!($data['session_user']['usergroup']=="ADMIN")) {
            redirect(base_url('admin/dashboard'));
        }
        $data['title'] = 'Admin Dashboard';
        $data['menu'] = 'Website_slabs';


        if ($id) {
            $data['selectall']=$this->admin->getRow('select * from prepaidcoin where id='.$id.'');
        }
         $data['creditvalue']=$this->admin->getVal('select creditsvalue from creditsvalue where id=1');

        $this->load->view('admin/inc/header', $data, false);
        $this->load->view('admin/wallet/slabsadd', $data, false);
        $this->load->view('admin/inc/footer', $data, false);
    }

    public function creditsvalue($id=0)
    {
        $data['session_user']=$this->session->userdata('admin_in');
        if (!($data['session_user']['usergroup']=="ADMIN")) {
            redirect(base_url('admin/dashboard'));
        }
        $data['title'] = 'Admin Dashboard';
        $data['menu'] = 'Website_slabs';


        if ($id) {
            $data['selectall']=$this->admin->getRow('select * from creditsvalue where id='.$id.'');
        }

        $this->load->view('admin/inc/header', $data, false);
        $this->load->view('admin/wallet/creditsvalue', $data, false);
        $this->load->view('admin/inc/footer', $data, false);
    }

    public function add_slab()
    {
        $id=$this->input->post('id');
        $array = array(
                    'slab'              =>$this->input->post('slab') ,
                    'amount'          =>$this->input->post('amount') ,
                    'usdamount'          =>$this->input->post('usdamount') ,
                    'credits'          =>$this->input->post('credits') ,
                    'discount'          =>$this->input->post('discount') ,
                    'startdate'          =>$this->input->post('startdate') ,
                    'enddate'          =>$this->input->post('enddate') ,
                    'status'            =>$this->input->post('status')
                   );

        if ($id>0) {
            $update = $this->admin->update('prepaidcoin', array('id'=>$id), $array);
            if ($update) {
                // $this->messages->add('Updated successfully', "alert-success");
                redirect('admin/dashboard/slabs');
            }
        } else {
            $insert = $this->admin->insert('prepaidcoin', $array);
            if ($insert) {
                //$this->messages->add('Added successfully', "alert-success");
                redirect('admin/dashboard/slabs');
            }
        }
    }

     public function add_wallet_request()
    {
        $id=$this->input->post('rid');
           $uid=$this->input->post('id');
        $array = array(
                    'approve_amount'    =>$this->input->post('approve_amount'),
                    'status'    =>1,
                   );


            $update = $this->admin->update('recharge_request', array('id'=>$id), $array);
            //echo $this->db->last_query(); exit;
            if($update){
                 $this->load->model('Common_model');
$data['creditvalue']=$this->admin->getVal('select creditsvalue from creditsvalue where id=1');
 $data['usdcreditvalue']=$this->admin->getVal('select usdcreditsvalue from creditsvalue where id=1');
 if($_POST['country_id']=='101')
 {
   $amount=$this->input->post('approve_amount')*$data['creditvalue'];
 }
 else{
   $amount=$this->input->post('approve_amount')*$data['usdcreditvalue'];
 }
    $credit_data=array(
      'user_id'=>$uid,
      'transaction_id'=>'admin',
      'amount'=>$amount,
      'coin'=>$this->input->post('approve_amount'),
      'status'=>1,
    );
      $this->Common_model->SaveData('e_wallet',$credit_data);
                // $this->messages->add('Updated successfully', "alert-success");
                redirect('admin/dashboard/wallet_request');
            }

    }


    public function add_creditsvalue()
    {
        $id=$this->input->post('id');

        $array = array(
                    'creditsvalue'            =>$this->input->post('creditsvalue') ,
                    'usdcreditsvalue'         =>$this->input->post('usdcreditsvalue') ,
                 );

        if ($id>0) {
            $update = $this->admin->update('creditsvalue', array('id'=>$id), $array);
            $slablist=$this->admin->getRows("SELECT * FROM prepaidcoin");
            $tower = $slablist;
            $temp = count($tower);
            for ($i=0; $i<$temp; $i++) {
                $amount = $slablist[$i]->credits * $this->input->post('creditsvalue');
                $discount  =   $amount * $slablist[$i]->discount /100;
                $taotalamount = $amount - $discount;
                $array1 = array(
                     'amount' =>$taotalamount,
                      );


                $where1 = array('id'=>$slablist[$i]->id);
                $update1 = $this->admin->update('prepaidcoin', $where1, $array1);
            }
            if ($update) {
                // $this->messages->add('Updated successfully', "alert-success");
                redirect('admin/dashboard/slabs');
            }
        } else {
            $insert = $this->admin->insert('creditsvalue', $array);
            if ($insert) {
                //$this->messages->add('Added successfully', "alert-success");
                redirect('admin/dashboard/slabs');
            }
        }
    }
    public function deleteslab($id=0)
    {
        if ($id) {
            $delete=$this->admin->delete('prepaidcoin', array('id'=>$id));
            if ($delete) {
                redirect('admin/dashboard/slabs');
            }
        }
    }


    public function scrappers()
    {
        $data['session_user']=$this->session->userdata('admin_in');
        if (!($data['session_user']['usergroup']=="ADMIN")) {
            redirect(base_url('admin/dashboard'));
        }
        $data['title'] = 'Scrappers and Crawlers';
        $data['menu'] = 'data_mining';
        $notify=$this->Common_model->GetData('notification', "", "admin_status='0'");
        $data['count']=count($notify);

        $data['total_company']=2042533;

        $data['active_company']=$this->admin->getVal('SELECT count(id) FROM scrappers_log');
        $data['remian_scrap']=$this->admin->getVal('SELECT count(DISTINCT(cin)) FROM scrappers_log where company_status="pending"');
        $data['total_charges']=$this->admin->getVal('SELECT count(DISTINCT(cin)) FROM mca_scrapper where  type ="charges"');
        $data['total_com']=$this->admin->getVal('SELECT count(DISTINCT(cin)) FROM mca_scrapper where type ="master"');
        //$data['total_fail']=$this->admin->getVal('SELECT count(DISTINCT(cin)) FROM mca_scrapper where type ="master"');
        $data['total_fail']=$this->admin->getVal('SELECT count(DISTINCT(cin)) FROM scrappers_log where company_status="pending" and company_counter =1');
        $this->load->view('admin/inc/header', $data, false);
        $this->load->view('admin/master/scrappers', $data);
        $this->load->view('admin/inc/footer', $data, false);
    }

    public function get_delivery_date()
   {
     $get_data=$this->Common_model->get_single('orders',"id='".$_POST['id']."'");
     $data=array(
       'id'=>$get_data->id,
       'delivery_date'=>$get_data->delivery_date,
     );
     echo json_encode($data);exit;
   }

    public function adminsetting()
    {
        $data['title'] = 'Dashboard | Settings';
        $data['menu'] = 'settings';
        $data['session_user']=$this->session->userdata('logged_in');
        $id=$data['session_user']['id'];
      $data['get_user']=$this->Common_model->GetData('users',"","id='".$id."' and is_active='1'",'','','','1');
      $data['country']=$this->Common_model->GetData('countries');
      $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$id."' and status='0'");
     $data['count']=count($data['notify']);
     $this->load->model('Cart_model');
         $data['Cart']=0;
         if ($this->Cart_model->getUserCartCount($id)) {
             $data['Cart'] =$this->Cart_model->getUserCartCount($id);
         }
        $this->load->view('inc/header', $data, false);
        $this->load->view('inc/left_menu', $data, false);
        $this->load->view('Dashboard/settings', $data, false);
        $this->load->view('inc/footer', $data, false);
    }
     public function settings()
    {
        $data['title'] = 'Dashboard | Settings';
        $data['menu'] = 'settings';
        $data['session_user']=$this->session->userdata('logged_in');
        $id=$data['session_user']['id'];
      $data['get_user']=$this->Common_model->GetData('users',"","id='".$id."' and is_active='1'",'','','','1');
      $data['country']=$this->Common_model->GetData('countries');
      $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$id."' and status='0'");
     $data['count']=count($data['notify']);
     $this->load->model('Cart_model');
         $data['Cart']=0;
         if ($this->Cart_model->getUserCartCount($id)) {
             $data['Cart'] =$this->Cart_model->getUserCartCount($id);
         }
        $this->load->view('inc/header', $data, false);
        $this->load->view('inc/left_menu', $data, false);
        $this->load->view('Dashboard/settings', $data, false);
        $this->load->view('inc/footer', $data, false);
    }
}


// https://centralwebservice.azurewebsites.net/ConsumeAPIData.asmx/GetReportRequestStatus?URN=KREGGB20080700016
