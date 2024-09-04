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

class Search extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function autoCompleteSearch()
    {
        $this->load->model('Search_model');
        $data['search'] = $this->input->get_post('id');
        $type=$this->input->get_post('type');
        
        $skillData = array();
        if ($data['search'] != '') {
            $row = $this->Search_model->autoCompleteSearch();

            foreach ($row as $item) {

                if ($type == 'Company_name'){
                  $data['id'] = @$item['cin'];
                  // $data['value'] = $item['name'].' : '.@$item['cin'];
                  $data['value'] = $item['name'];
                }
                if ($type== 'CIN'){
                  $data['id'] = @$item['cin'];
                  // $data['value'] = $item['cin'].' : '.$item['name'];
                  $data['value'] = $item['cin'];
                }
                if ($type == 'DIN'){
                  $data['id'] = @$item['din'];
                  $data['value']=$item['din'].' : '.$item['name'];
                }
                if ($type == 'Address'){
                  $data['id'] = @$item['cin'];
                  // $data['value']=$item['address'].' : '.$item['name'];
                  $data['value']=$item['address'];
                }
                if ($type == 'Director_name'){
                  $data['id'] = @$item['din'];
                  $data['value']=$item['name'].' : '.$item['din'];
                  // $data['value']=$item['name'].;
                }
                array_push($skillData, $data);
            }
        }
        echo json_encode($skillData);
    }


    public function companyList()
    {
        $this->load->model('Search_model');
        $data['table'] = $this->Search_model->getCompanyList();
        $this->load->view('table/list', $data);
    }


    public function directors($i=0)
     {
        $data['search1'] = $this->input->get_post('search');
        $data['pageNo']=$i;
        $this->load->model('Search_model');
        $data['table'] = $this->Search_model->getDirectorsList($i);
        // echo json_encode($data['table']);
        $this->load->view('table/directors_list', $data);
        // echo $i;
    }

    public function listUsers($i=0)
     {
        $data['pageNo']=$i;
        $this->load->model('Search_model');
        $data['table'] = $this->Search_model->getUsersList($i);
        $this->load->view('table/users', $data);
    }
    public function downloaderData($i=0)
     {
        $data['pageNo']=$i;
        $this->load->model('Search_model');
        $data['table'] = $this->Search_model->getdownloaderData($i);
        $this->load->view('admin/components/downloader', $data);
    }

    public function documentData($i=0)
     {
        $data['pageNo']=$i;
        $this->load->model('Search_model');
        $data['table'] = $this->Search_model->getdocumentsData($i);
        // echo json_encode($data);
        // exit;
        $this->load->view('admin/components/documents', $data);
    }

    public function FaData($i=0)
     {
        $data['pageNo']=$i;
        $this->load->model('Search_model');
        $data['table'] = $this->Search_model->getFaData($i);
        $this->load->view('admin/components/fa', $data);
    }
    public function data_analystData($i=0)
     {
        $data['pageNo']=$i;
        $this->load->model('Search_model');
        $data['table'] = $this->Search_model->getdata_analystData($i);
        $this->load->view('admin/components/da', $data);
    }
    public function UserList($i=0)
    {
        $data['pageNo']=$i;
        $this->load->model('Search_model');
        $data['session_user']=$this->session->userdata('logged_in');
        $user_id=$data['session_user']['id'];
        $data['table'] = $this->Search_model->userlist($user_id,$i);
        $this->load->view('Dashboard/full_list', $data);
    }

    public function UserOrders($i=0)
    {
        $data['pageNo']=$i;
        $this->load->model('Search_model');
        $data['session_user']=$this->session->userdata('logged_in');
        $user_id=$data['session_user']['id'];
        $data['table'] = $this->Search_model->UserOrders($user_id,$i);
      //  print_r($data['table']); exit;
        $this->load->view('components/orders', $data);
    }
    public function User_wallet_data($i=0)
    {
        $data['pageNo']=$i;
        $this->load->model('Search_model');
        $data['session_user']=$this->session->userdata('logged_in');
        $user_id=$data['session_user']['id'];
        // echo $user_id;
        $data['table'] = $this->Search_model->User_walletdata($user_id,$i);
        $this->load->view('components/wallet_data', $data);
    }
    public function User_notification_data($i=0)
    {
        $data['pageNo']=$i;
        $this->load->model('Search_model');
        $data['session_user']=$this->session->userdata('logged_in');
        $user_id=$data['session_user']['id'];
        // echo $user_id;
        $data['table'] = $this->Search_model->User_notificationdata($user_id,$i);
        //print_r($data['table']); exit;
        $this->load->view('components/notification_data', $data);
    }

    public function user_list_Data($i=0)
        {
           $data['pageNo']=$i;
           $this->load->model('Search_model');
           $data['table'] = $this->Search_model->getUserData($i);
           $this->load->view('admin/components/userdata', $data);
       }
       // public function admin_list_Data($i=0)
       //     {
       //        $data['pageNo']=$i;
       //        $this->load->model('Search_model');
       //        $data['table'] = $this->Search_model->getadminData($i);
       //        $this->load->view('admin/components/admindata', $data);
       //    }
    public function ordersData($i=0)
     {
        $data['pageNo']=$i;
        $this->load->model('Search_model');
        $data['table'] = $this->Search_model->getOrderData($i);
        $this->load->view('admin/components/orders', $data);
    }

    public function reportsData($i=0)
     {
        $data['pageNo']=$i;
        $this->load->model('Search_model');
        $data['table'] = $this->Search_model->getReportsData($i);

        $this->load->view('admin/components/reports', $data);
    }


    public function wallet_list_data($i=0)
     {
        $data['pageNo']=$i;
        $this->load->model('Search_model');
        $data['table'] = $this->Search_model->get_walletData($i);
        //print_r($data['table']); exit;
        $this->load->view('admin/components/walletdata', $data);
    }
     public function wallet_user_data($i=0)
     {
        $data['pageNo']=$i;
        $this->load->model('Search_model');
        $data['table'] = $this->Search_model->get_walletuserData($i);
        //print_r($data['table']); exit;
        $this->load->view('admin/components/walletuserdata', $data);
    }
    public function notifyData($i=0)
    {
       $data['pageNo']=$i;
       $this->load->model('Search_model');
      $data['table'] = $this->Search_model->get_notificationData($i);

       $this->load->view('admin/components/notificationdata', $data);
   }

   // production users notification
   public function downloader_notification($i=0)
   {
      $data['pageNo']=$i;
      $this->load->model('Search_model');
     $data['table'] = $this->Search_model->get_downloader_notification($i);

      $this->load->view('admin/Downloader/downloader_notifydata', $data);
  }
  public function da_notification($i=0)
  {
     $data['pageNo']=$i;
     $this->load->model('Search_model');
    $data['table'] = $this->Search_model->get_da_notification($i);

     $this->load->view('admin/DA/da_notifydata', $data);
 }
 public function fa_notification($i=0)
 {
    $data['pageNo']=$i;
    $this->load->model('Search_model');
   $data['table'] = $this->Search_model->get_fa_notification($i);

    $this->load->view('admin/FA/fa_notifydata', $data);
}

   // end production users notification
   public function payment_data_list($i=0)
        {
           $data['pageNo']=$i;
           $this->load->model('Search_model');
           $data['table'] = $this->Search_model->get_paymentData($i);
           $this->load->view('admin/components/paymentdata', $data);
       }
       public function blog_list($i=0)
           {
              $data['pageNo']=$i;
              $this->load->model('Search_model');
              $data['table'] = $this->Search_model->getblogData($i);
              $this->load->view('admin/components/blogdata', $data);
          }
      // front side Support pagination
      public function User_support_data($i=0)
      {
          $data['pageNo']=$i;
          $this->load->model('Search_model');
          $data['session_user']=$this->session->userdata('logged_in');
          $user_id=$data['session_user']['id'];
          // echo $user_id;
          $data['table'] = $this->Search_model->get_support($user_id,$i);
          $this->load->view('components/support_data', $data);
      }
      //End  front side Support pagination

      //admin show pagination support, product
      public function admin_User_support_list($i=0)
      {
        $data['pageNo']=$i;
        $this->load->model('Search_model');
        $this->load->model('Common_model');
         $data['get_product']=$this->Common_model->GetData('product');
        $data['table'] = $this->Search_model->admin_getsupport($i);
        $this->load->view('admin/components/usersupport_data', $data);
      }
       public function admin_User_support_list1($i=0)
      {
        $data['pageNo']=$i;
        $this->load->model('Search_model');
        $this->load->model('Common_model');
         $data['get_product']=$this->Common_model->GetData('product');
          //$data['table']=$this->admin->getRows('SELECT * FROM users_support where assign =1');
        $data['table'] = $this->Search_model->admin_getsupport1($i);
        $this->load->view('admin/components/usersupport_data1', $data);
      }
       public function admin_User_support_list2($i=0)
      {
        $data['pageNo']=$i;
        $this->load->model('Search_model');
        $this->load->model('Common_model');
        $data['get_product']=$this->Common_model->GetData('product');
         // $data['table']=$this->admin->getRows('SELECT * FROM users_support where assign =2');
        $data['table'] = $this->Search_model->admin_getsupport2($i);
        $this->load->view('admin/components/usersupport_data2', $data);
      }
       public function admin_User_support_list3($i=0)
      {
        $data['pageNo']=$i;
        $this->load->model('Search_model');
        $this->load->model('Common_model');
         $data['get_product']=$this->Common_model->GetData('product');
        //  $data['table']=$this->admin->getRows('SELECT * FROM users_support where assign =3');
        $data['table'] = $this->Search_model->admin_getsupport3($i);
        $this->load->view('admin/components/usersupport_data3', $data);
      }
      public function filter_support()
      {
        $product=$_POST['product_name'];
        $ticket_status=$_POST['ticket_status'];
        $con='1=1';
        if(!empty($product))
        {
        $con.=" and us.product_id='".$product."'";
      }
      if($ticket_status!='')
      {
      $con.=" and us.ticket_status='".$ticket_status."'";
    }
      $this->load->model('Crud_model');
      $data['table']=$this->Crud_model->support_list($con);
      $this->load->view('admin/manage_website/filter_supportdata', $data);

      }

       public function filter_support1()
      {
        $product=$_POST['product_name'];
        $ticket_status=$_POST['ticket_status'];
        $con='1=1';
        if(!empty($product))
        {
        $con.=" and us.product_id='".$product."'";
      }
      if($ticket_status!='')
      {
      $con.=" and us.ticket_status='".$ticket_status."'";
    }
      $this->load->model('Crud_model');
      $data['table']=$this->Crud_model->support_list1($con);
      $this->load->view('admin/manage_website/filter_supportdata1', $data);

      }

        public function filter_support2()
      {
        $product=$_POST['product_name'];
        $ticket_status=$_POST['ticket_status'];
        $con='1=1';
        if(!empty($product))
        {
        $con.=" and us.product_id='".$product."'";
      }
      if($ticket_status!='')
      {
      $con.=" and us.ticket_status='".$ticket_status."'";
    }
      $this->load->model('Crud_model');
      $data['table']=$this->Crud_model->support_list2($con);
      $this->load->view('admin/manage_website/filter_supportdata2', $data);

      }

        public function filter_support3()
      {
        $product=$_POST['product_name'];
        $ticket_status=$_POST['ticket_status'];
        $con='1=1';
        if(!empty($product))
        {
        $con.=" and us.product_id='".$product."'";
      }
      if($ticket_status!='')
      {
      $con.=" and us.ticket_status='".$ticket_status."'";
    }
      $this->load->model('Crud_model');
      $data['table']=$this->Crud_model->support_list3($con);
      $this->load->view('admin/manage_website/filter_supportdata3', $data);

      }

      function user_filter_date()
   {
       $cond= "1=1";
       if(!empty($_POST)){
       if(!empty($_POST['from_date']) and empty($_POST['end_date']))
       {
           $from_date=date('Y-m-d',strtotime($_POST['from_date']));
         $cond .=" and LEFT(lastlogin,10)>='".$from_date."'";
       }
        if(!empty($_POST['end_date']) and empty($_POST['from_date']))
       {
           $end_date=date('Y-m-d',strtotime($_POST['end_date']));
         $cond .=" and LEFT(lastlogin,10)<='".$end_date."'";
       }
       if(!empty($_POST['from_date']) and !empty($_POST['end_date']))
       {
            $from_date=date('Y-m-d',strtotime($_POST['from_date']));
           $end_date=date('Y-m-d',strtotime($_POST['end_date']));

        $cond .=" and LEFT(lastlogin,10)>='".$from_date."' and LEFT(lastlogin,10)<='".$end_date."'";
       }

   }
     $this->load->model('Common_model');
    $data['user']=$this->Common_model->GetData('users','',$cond);
     $this->load->view('admin/components/user_filter_date',$data);
   }
   function order_datefilter()
{
    $cond= "1=1";
    if(!empty($_POST)){
    if(!empty($_POST['from_date']) and empty($_POST['end_date']))
    {
        $from_date=date('Y-m-d',strtotime($_POST['from_date']));
      $cond .=" and LEFT(date,10) >='".$from_date."'";
    }
     if(!empty($_POST['end_date']) and empty($_POST['from_date']))
    {
        $end_date=date('Y-m-d',strtotime($_POST['end_date']));
      $cond .=" and LEFT(date,10)<='".$end_date."'";
    }
    if(!empty($_POST['from_date']) and !empty($_POST['end_date']))
    {
         $from_date=date('Y-m-d',strtotime($_POST['from_date']));
        $end_date=date('Y-m-d',strtotime($_POST['end_date']));

     $cond .=" and LEFT(date,10)>='".$from_date."' and LEFT(date,10)<='".$end_date."'";
    }

}
  $this->load->model('Custom_model');
 $data['order_data']=$this->Custom_model->orders_datefilter($cond);
 //print_r($this->db->last_query()); exit;
  $this->load->view('components/order_datefilter',$data);
}

    // full company date filter
    function fullcompany_datefilter()
 {
     $cond= "1=1";
     if(!empty($_POST)){
     if(!empty($_POST['from_date']) and empty($_POST['end_date']))
     {
         $from_date=date('Y-m-d',strtotime($_POST['from_date']));
       $cond .=" and LEFT(date,10) >='".$from_date."'";
     }
      if(!empty($_POST['end_date']) and empty($_POST['from_date']))
     {
         $end_date=date('Y-m-d',strtotime($_POST['end_date']));
       $cond .=" and LEFT(date,10)<='".$end_date."'";
     }
     if(!empty($_POST['from_date']) and !empty($_POST['end_date']))
     {
          $from_date=date('Y-m-d',strtotime($_POST['from_date']));
         $end_date=date('Y-m-d',strtotime($_POST['end_date']));

      $cond .=" and LEFT(date,10)>='".$from_date."' and LEFT(date,10)<='".$end_date."'";
     }

 }
   $this->load->model('Common_model');
  $data['fullList_data']=$this->Common_model->GetData('orders','',$cond);
   $this->load->view('components/fullList_datefilter',$data);
 }

    // end date filter
      public function admin_product_support_list($i=0)
      {
        $data['pageNo']=$i;
        $this->load->model('Search_model');
        $data['table'] = $this->Search_model->admin_getproductsupport($i);
        $this->load->view('admin/components/productsupport_data', $data);
      }
      public function admin_contactuslist($i=0)
      {
        $data['pageNo']=$i;
        $this->load->model('Search_model');
        $data['table'] = $this->Search_model->admin_get_contactus($i);
        $this->load->view('admin/components/contactus_data', $data);
      }
      public function admin_offlinerequest_list($i=0)
      {
        $data['pageNo']=$i;
        $this->load->model('Search_model');
        $data['table'] = $this->Search_model->admin_get_offlinerequest($i);
        $this->load->view('admin/components/offline_requestdata', $data);
      }
      public function admin_walletuser_list($i=0)
      {
        $data['pageNo']=$i;
        $this->load->model('Search_model');
        $data['table'] = $this->Search_model->admin_walletData($i);
        //print_r($data['table']); exit;
        $this->load->view('admin/dashboard_components/admin_walletdata', $data);
      }
      //end admin show pagination support, product
}
