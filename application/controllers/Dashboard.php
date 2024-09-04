<?php
error_reporting(0);
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        Utils::no_cache();
         $this->load->model('Common_model');
           $this->load->library(array('session','form_validation','image_lib','upload'));
           $this->load->model('Cart_model');
            $this->load->model('Crud_model');
           $this->load->model('Send_mail');
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url('login'));
            exit;
        }
    }

    public function index()
    {
        $data['title'] = 'User | Dashboard';
        $data['menu'] = 'dashboard';
        $data['session_user']=$this->session->userdata('logged_in');
        $this->load->model('Cart_model');
        $id=$data['session_user']['id'];
      //   $data['full_company']=$this->Common_model->GetData('orders',"","status='paid' and (fa='completed' or fa='') and (product_status='In Progress' or product_status='completed') and user_id='".$id."' and (category='Existing Report' or category='Full Company Report')");
        $data['full_company']=$this->admin->getVal('SELECT COUNT(*) FROM orders WHERE user_id =   "'.$_SESSION['logged_in']['id'].'"  AND `category` LIKE "Full Company Report" AND `product_status` LIKE "completed"');
          $data['tota_order']=$this->admin->getVal('SELECT COUNT(*) FROM orders WHERE user_id =   "'.$_SESSION['logged_in']['id'].'"  ');
        $data['get_user']=$this->Common_model->GetData('users',"","id='".$id."' and is_active='1'",'','','','1');
        $data['buyamount']=$this->admin->getVal('SELECT sum(coin) FROM e_wallet where status =1 and user_id ="'.$_SESSION['logged_in']['id'].'"');
        $data['creditamount']=$this->admin->getVal('SELECT sum(coin) FROM e_wallet where status =2 and user_id = "'.$_SESSION['logged_in']['id'].'"');
        $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$id."' and status='0'");
        $data['count']=count($data['notify']);
        $data['Cart']=0;
        $data['Items'] = $this->Cart_model->getUserCart($id);
        $i=0;
        foreach ($data['Items'] as $item) {
            $data['Items'][$i]['items']= json_decode($item['items']);
            $i++;
        }
        if ($this->Cart_model->getUserCartCount($id)) {
            $data['Cart'] =$this->Cart_model->getUserCartCount($id);
        }

$year = date("Y");


echo $year;

     $data['Jan2']=$this->admin->getVal("SELECT COUNT(*) FROM orders WHERE user_id =   '".$_SESSION['logged_in']['id']."'  AND YEAR(date) = '".$year."' AND MONTH(date) = '1'  AND `category` LIKE 'Full Company Report' AND `product_status` LIKE 'completed'");
  $data['Feb2']=$this->admin->getVal('SELECT COUNT(*) FROM orders WHERE user_id =   "'.$_SESSION['logged_in']['id'].'" AND YEAR(date) = "'.$year.'" AND MONTH(date) = "2"  AND `category` LIKE "Full Company Report" AND `product_status` LIKE "completed"');
    $data['Mar2']=$this->admin->getVal('SELECT COUNT(*) FROM orders WHERE user_id =  "'.$_SESSION['logged_in']['id'].'" AND YEAR(date) = "'.$year.'" AND MONTH(date) = "3" AND `category` LIKE "Full Company Report" AND `product_status` LIKE "completed"');
   $data['Apr2']=$this->admin->getVal('SELECT COUNT(*) FROM orders WHERE user_id =   "'.$_SESSION['logged_in']['id'].'" AND YEAR(date) = "'.$year.'" AND MONTH(date) ="4" AND `category` LIKE "Full Company Report" AND `product_status` LIKE "completed"');
    $data['May2']=$this->admin->getVal('SELECT COUNT(*) FROM orders WHERE user_id =   "'.$_SESSION['logged_in']['id'].'" AND YEAR(date) = "'.$year.'" AND MONTH(date) = "5" AND `category` LIKE "Full Company Report" AND `product_status` LIKE "completed"');
    $data['June2']=$this->admin->getVal('SELECT COUNT(*) FROM orders WHERE user_id =  "'.$_SESSION['logged_in']['id'].'" AND YEAR(date) = "'.$year.'" AND MONTH(date) = "6" AND `category` LIKE "Full Company Report" AND `product_status` LIKE "completed"');
    $data['July2']=$this->admin->getVal('SELECT COUNT(*) FROM orders WHERE user_id = "'.$_SESSION['logged_in']['id'].'" AND YEAR(date) = "'.$year.'" AND MONTH(date) = "7" AND `category` LIKE "Full Company Report" ');
    $data['Aug2']=$this->admin->getVal('SELECT COUNT(*) FROM orders WHERE user_id =  "'.$_SESSION['logged_in']['id'].'" AND YEAR(date) = "'.$year.'" AND MONTH(date) = "8" AND `category` LIKE "Full Company Report" AND `product_status` LIKE "completed"');
   $data['Sep2']=$this->admin->getVal('SELECT COUNT(*) FROM orders WHERE user_id = "'.$_SESSION['logged_in']['id'].'" AND YEAR(date) = "'.$year.'" AND MONTH(date) = "9"  AND `category` LIKE "Full Company Report" AND `product_status` LIKE "completed"');
    $data['Oct2']=$this->admin->getVal('SELECT COUNT(*) FROM orders WHERE user_id =  "'.$_SESSION['logged_in']['id'].'" AND YEAR(date) = "'.$year.'" AND MONTH(date) = "10"  AND `category` LIKE "Full Company Report" AND `product_status` LIKE "completed"');
    $data['Nov2']=$this->admin->getVal('SELECT COUNT(*) FROM orders WHERE user_id =  "'.$_SESSION['logged_in']['id'].'" AND YEAR(date) = "'.$year.'" AND MONTH(date) = "11" AND `category` LIKE "Full Company Report" AND `product_status` LIKE "completed"');
    $data['Dec2']=$this->admin->getVal('SELECT COUNT(*) FROM orders WHERE user_id =  "'.$_SESSION['logged_in']['id'].'" AND YEAR(date) = "'.$year.'" AND MONTH(date) = "12" AND `category` LIKE "Full Company Report" AND `product_status` LIKE "completed"');

     $data['slab']=$this->admin->getRows("SELECT * FROM `orders` WHERE `category` LIKE 'Full Company Report' AND `product_status` LIKE 'completed' and user_id =   '".$_SESSION['logged_in']['id']."' ORDER BY `orders`.`id` DESC limit 5
 ");
$data['slab1']=$this->admin->getRows("SELECT * FROM `orders` WHERE `category` LIKE 'Track a Company' AND `product_status` LIKE 'completed' and user_id =   '".$_SESSION['logged_in']['id']."' ORDER BY `orders`.`id` DESC limit 5");

   $userid=$_SESSION['logged_in']['id'];

   $data['user']=$this->admin->getRow("SELECT * FROM users where id='".$userid."'");
   $data['postpaid_invoice']=$this->admin->getRow("SELECT * FROM postpaid_invoice where user_id='".$userid."' ");
      //  redirect(base_url('dashboard/orders'));
        $this->load->view('inc/header', $data, false);
        $this->load->view('inc/left_menu', $data, false);
        $this->load->view('Dashboard/dashboard', $data, false);
        $this->load->view('inc/footer', $data, false);
    }

    public function cart()
    {

        $data['title'] = 'Dashboard | Cart';
        $data['menu'] = 'cart';
        $data['session_user']=$this->session->userdata('logged_in');
        $this->load->model('Cart_model');
        $id=$data['session_user']['id'];
        $data['get_user']=$this->Common_model->GetData('users',"","id='".$id."' and is_active='1'",'','','','1');
       //   $sql1= $this->db->last_query();
        $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$id."' and status='0'");
       //   $sql2= $this->db->last_query();
     $data['count']=count($data['notify']);
        $data['Cart']=0;
      $con=" o.user_id='".$id."' and o.status='cart'";
       $data['Items'] = $this->Cart_model->getUserCart($con);
        //$data['Items']=$this->admin->getRows('SELECT * FROM orders where user_id = "'.$_SESSION['logged_in']['id'].'" and status="cart"');
      // $sql3= $this->db->last_query();

       // $con1=" o.user_id='".$id."' and o.status='savelatter'";
      //$data['Item'] = $this->Cart_model->getUserCart($con1);
      //  $sql4= $this->db->last_query();
        if($data['get_user']->country_id=='101'){
         $data['order_amt']=$this->Common_model->GetData('orders',"sum(cost) as amount","status='cart' and user_id='".$id."'","","","","1");
       //   $sql5= $this->db->last_query();
       }
       else{
         $data['order_amt']=$this->Common_model->GetData('orders',"sum(usd_cost) as amount","status='cart' and user_id='".$id."'","","","","1");
       //   $sql6= $this->db->last_query();
       }
       $data['total_amount']= $data['order_amt']->amount;

        $i=0;
        foreach ($data['Items'] as $item) {
            $data['Items'][$i]['items']= json_decode($item['items']);

            $i++;
        }
        if ($this->Cart_model->getUserCartCount($id)) {
            $data['Cart'] =$this->Cart_model->getUserCartCount($id);
        }
        // echo json_encode($data['Items']);
    $data['creditvalue']=$this->admin->getVal('select creditsvalue from creditsvalue where id=1');
 //   $sql7= $this->db->last_query();
    $data['usdcreditvalue']=$this->admin->getVal('select usdcreditsvalue from creditsvalue where id=1');
  //  $sql8= $this->db->last_query();
    $data['buyamount']=$this->admin->getVal('SELECT sum(coin) FROM e_wallet where status =1 and user_id =   "'.$_SESSION['logged_in']['id'].'"');
  //  $sql9= $this->db->last_query();
    $data['creditamount']=$this->admin->getVal('SELECT sum(coin) FROM e_wallet where status =2 and user_id =   "'.$_SESSION['logged_in']['id'].'"');
  //  $sql10= $this->db->last_query();
   //  $data['creditamount']=$this->admin->getVal('SELECT sum(coin) FROM e_wallet where status =2 and user_id =   "'.$_SESSION['logged_in']['id'].'"');
    $data['session_user']=$this->session->userdata('logged_in');
    $userid=$_SESSION['logged_in']['id'];
    $cond="u.id='".$userid."'";
    $data['country_data']=$this->Crud_model->country_detail($cond);
        // print_r($data['country_data']);exit;
         if($data['country_data']['country_id']=='101'){
          $data['total_cost']=$this->admin->getVal('SELECT sum(cost) FROM orders where status ="cart" and user_id =   "'.$_SESSION['logged_in']['id'].'"');
         //  $sql11= $this->db->last_query();
        }
        else{
                    $data['total_cost']=$this->admin->getVal('SELECT sum(usd_cost) FROM orders where status ="cart" and user_id =   "'.$_SESSION['logged_in']['id'].'"');
                //     $sql4= $this->db->last_query();

     //     $data['total_cost']=$this->admin->getVal('orders',"sum(usd_cost) as amount","status='cart' and user_id='".$userid."'","","","","1");
        }
//$data['total_cost']=225;
       //echo $sql3;

        $this->load->view('inc/header', $data, false);
        $this->load->view('inc/left_menu', $data, false);
        $this->load->view('Dashboard/cart', $data, false);
        $this->load->view('inc/footer', $data, false);
    }
    public function company_list()
    {
        $data['title'] = 'User Dashboard | Company List';
        $data['menu'] = 'company-list';
        $data['session_user']=$this->session->userdata('logged_in');
        $this->load->model('Cart_model');
        $id=$data['session_user']['id'];
          $data['get_user']=$this->Common_model->GetData('users',"","id='".$id."' and is_active='1'",'','','','1');
        $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$id."' and status='0'");
        $data['count']=count($data['notify']);
        $data['full_company']=$this->Common_model->GetData('orders',"","status='paid' and (fa='completed' or fa='') and (product_status='In Progress' or product_status='completed') and user_id='".$id."' and (category='Existing Report' or category='Full Company Report')");
        $data['track_company']=$this->Common_model->GetData('orders',"","status='paid' and category='Track a Company' and user_id='".$id."'");
        $data['Documents']=$this->Common_model->GetData('orders',"","status='paid' and product_status='completed' and user_id='".$id."' and (category='Documents' or category='All Documents')");
        $data['new_company']=$this->Common_model->GetData('orders',"","status='paid' and category='new incorporation' and fa='completed' and user_id='".$id."'");
        $data['recent_company']=$this->Common_model->GetData('orders',"","status='paid' and category='recent incorporation' and user_id='".$id."'");
        // print_r($data['category_count']); exit;
        $data['Items'] = $this->Cart_model->getUserOrders($id);
        $i=0;
        foreach ($data['Items'] as $item) {
            $data['Items'][$i]['items']= json_decode($item['items']);
            $i++;
        }
        $data['Cart']=0;
        if ($this->Cart_model->getUserCartCount($id)) {
            $data['Cart'] =$this->Cart_model->getUserCartCount($id);
        }
        $data['total_cost'] =225;
        $this->load->view('inc/header', $data, false);
        $this->load->view('inc/left_menu', $data, false);
        $this->load->view('Dashboard/company_list', $data, false);
        $this->load->view('inc/footer', $data, false);
    }
    public function support_list()
    {
        $data['title'] = 'Dashboard | Support List';
        $data['menu'] = 'support_list';
        $data['session_user']=$this->session->userdata('logged_in');
        $id=$data['session_user']['id'];
        $this->load->model('Crud_model');
        $cond="user_id='".$id."'";
        $data['users_support']=$this->Crud_model->users_support($cond);
      $data['get_user']=$this->Common_model->GetData('users',"","id='".$id."' and is_active='1'",'','','','1');
      $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$id."' and status='0'");
     $data['count']=count($data['notify']);
     $this->load->model('Cart_model');
         $data['Cart']=0;
         if ($this->Cart_model->getUserCartCount($id)) {
             $data['Cart'] =$this->Cart_model->getUserCartCount($id);
         }
        $data['get_product']=$this->Common_model->GetData('product');
        $this->load->view('inc/header', $data, false);
        $this->load->view('inc/left_menu', $data, false);
        $this->load->view('Dashboard/support_list', $data, false);
        $this->load->view('inc/footer', $data, false);
    }
    public function support()
    {
        $data['title'] = 'Dashboard | Support';
        $data['menu'] = 'support';
        $data['session_user']=$this->session->userdata('logged_in');
        $id=$data['session_user']['id'];
      $data['get_user']=$this->Common_model->GetData('users',"","id='".$id."' and is_active='1'",'','','','1');
      $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$id."' and status='0'");
     $data['count']=count($data['notify']);
     $this->load->model('Cart_model');
         $data['Cart']=0;
         if ($this->Cart_model->getUserCartCount($id)) {
             $data['Cart'] =$this->Cart_model->getUserCartCount($id);
         }
       $data['get_product']=$this->Common_model->GetData('product','',"id='1' or id='2'");
        $this->load->view('inc/header', $data, false);
        $this->load->view('inc/left_menu', $data, false);
        $this->load->view('Dashboard/user_support', $data, false);
        $this->load->view('inc/footer', $data, false);
    }
    public function save_support()
    {
      $data=array();
      $this->load->model('Custom_model');
      $this->load->model('Crud_model');
      $data['message'] = $this->Custom_model->insert_support();
    // $this->session->set_flashdata('message', 'Message Sent Successfully!!');
        $last_id=$this->db->insert_id();
      $cond="s.id='".$last_id."'";
      $data['users_support']=$this->Crud_model->users_support_mail($cond);
      //print_r($data['users_support']['email']); exit;
      $subject=" Support Details for Support Information";
      $to='info@ucs-mail.com';
      $id="1";
      $view='emails/support_info';
      $this->Send_mail->send($id, $to, $view, $subject, $data);
      $subject1="Support Form";
      $to1=$data['users_support']['email'];
      $id1="2";
      $view1='emails/contact_form';
      $this->Send_mail->send($id1, $to1, $view1, $subject1, $data);
      echo json_encode($data);
    }
    public function view_support($sid)
    {
      $data['title'] = 'Dashboard |View Support';
      $data['menu'] = 'View_support';
      $data['session_user']=$this->session->userdata('logged_in');
      $id=$data['session_user']['id'];
    $data['get_user']=$this->Common_model->GetData('users',"","id='".$id."' and is_active='1'",'','','','1');
    $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$id."' and status='0'");
   $data['count']=count($data['notify']);
   $this->load->model('Cart_model');
       $data['Cart']=0;
       if ($this->Cart_model->getUserCartCount($id)) {
           $data['Cart'] =$this->Cart_model->getUserCartCount($id);
       }
       $data['view_support']=$this->Common_model->get_single('users_support',"id='".$sid."' and user_id='".$id."'");
      // print_r($data['view_support']); exit;
      $this->load->view('inc/header', $data, false);
      $this->load->view('inc/left_menu', $data, false);
      $this->load->view('Dashboard/view_support', $data, false);
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
    public function update_profile()
    {

      $id=$_POST['id'];
      // if($_FILES['image']['name']!='' )
      //          {
      //            $data['file_name']= rand(0000,9999)."_".$_FILES['image']['name'];
      //
      //            $target_path = "./upload/blog/";
      //            $target_path = $target_path.basename($data['file_name']);
      //            if(move_uploaded_file($_FILES['image']['tmp_name'], $target_path))
      //            {
      //
      //               $image  = $data['file_name'];
      //                 @unlink("upload/blog/".$_POST['old_image']);
      //
      //            }
      //            else{
      //              $data['message']['file']="system_error";
      //              echo json_encode($data['message']);
      //            }
      //
      //          }
      //          else
      //          {
      //            $image  = $_POST['old_image'];
      //          }

          $data = array(
                      'name' =>ucfirst($this->input->post('name',TRUE)),
                      'email' =>$this->input->post('email',TRUE),
                      'country_id' =>$this->input->post('country_id',TRUE),
                       //'image' =>$image,
                          );

          $this->Common_model->SaveData('users',$data,"id='".$id."'");
          echo "1"; exit;
    }
    public function orders()
    {

        $data['title'] = 'Dashboard | Orders';
        $data['menu'] = 'orders';
        $data['session_user']=$this->session->userdata('logged_in');
        $this->load->model('Cart_model');
        $id=$data['session_user']['id'];
        $data['Items'] = $this->Cart_model->getUserOrders($id);
          $data['get_user']=$this->Common_model->GetData('users',"","id='".$id."' and is_active='1'",'','','','1');
        $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$id."' and status='0'");
        $data['count']=count($data['notify']);
        $i=0;
        foreach ($data['Items'] as $item) {
            $data['Items'][$i]['items']= json_decode($item['items']);
            $i++;
        }
        $data['Cart']=0;
        if ($this->Cart_model->getUserCartCount($id)) {
            $data['Cart'] =$this->Cart_model->getUserCartCount($id);
        }
          $data['buyamount']=$this->admin->getVal('SELECT sum(coin) FROM e_wallet where status =1 and user_id =   "'.$_SESSION['logged_in']['id'].'"');
     $data['creditamount']=$this->admin->getVal('SELECT sum(coin) FROM e_wallet where status =2 and user_id =   "'.$_SESSION['logged_in']['id'].'"');
     $data['purchaseamount']=$this->admin->getVal('SELECT sum(cost) FROM orders where status ="paid" and user_id =   "'.$_SESSION['logged_in']['id'].'"');

        $this->load->view('inc/header', $data, false);
        $this->load->view('inc/left_menu', $data, false);
        $this->load->view('Dashboard/orders.php', $data, false);
        $this->load->view('inc/footer', $data, false);

    }
    public function invoice_download($id)
   {

       $userid=$_SESSION['logged_in']['id'];
       $data['get_order']=$this->Common_model->GetData('orders',"","user_id='".$userid."'","","","","1");
       $data['get_billing']=$this->Common_model->GetData('billing_address',"","user_id='".$userid."'and id='".$id."'","","","","1");
       $data['product']=$this->Common_model->GetData('orders',"","user_id='".$userid."' and billing_id='".$id."' and billing_id!='0'","","","","");

        //print_r( $data['product']); exit;
    return $this->load->view('Dashboard/invoice',$data,true);
   }
    public function download_form($id)
   {
      //$pdf="pdf";
       $body_pdf = $this->invoice_download($id);
       $pnlname = date('d-m-Y');
       $rand=rand(0000,9999);
       $pnlname1 = date('d-m-Y').'_'.time();
       $fileName = '/uploads/pdf/'.$pnlname.'_orderid_'.$rand.'.pdf';

       $file = getcwd().$fileName;
       $pdfFilePath = $file;

       $this->load->library('m_pdf');

       ///////////////////////////WATERMARK CODE//////////////////////////////////////////////////
       $mpdf=new mPDF('c');

         $mpdf->SetDisplayMode('fullpage');
         $mpdf->SetWatermarkText('Kredit Aid');
         $mpdf->watermark_font = 'DejaVuSansCondensed';
         $mpdf->watermarkTextAlpha = 0.1;
         $mpdf->showWatermarkText = true;
       ///////////////////////WATERMARK CODE//////////////////////////////////////////////////////
       ///////////////////////PAGE NUMBER///////////////////////////////////////////////////
             $mpdf->mirrorMargins = 1;

             $mpdf->defaultPageNumStyle = '1';

             $mpdf->SetDisplayMode('fullpage','two');
           ///////////////////////PAGE NUMBER///////////////////////////////////////////////////

           $mpdf->defaultfooterfontsize = 12;  /* in pts */
           $mpdf->defaultfooterfontstyle = B;  /* blank, B, I, or BI */
           $mpdf->defaultfooterline = 0;   /* 1 to include line below header/above footer */
           $mpdf->SetHTMLFooter('<div style="text-align: center;">{PAGENO}</div>','O');    /* defines footer for Odd and Even Pages - placed at Outer margin */
           $mpdf->SetHTMLFooter('<div style="text-align: center;">{PAGENO}</div>','E');    /* defines footer for Odd and Even Pages - placed at Outer margin */
           $body =  $mpdf->WriteHTML($body_pdf);
           $mpdf->SetDisplayMode('fullpage');
           //download it D save F.
           fopen($pdfFilePath,'wb');

           // $mpdf->Output('/document/'.$fileName.'.pdf', "F");
           $mpdf->Output($pdfFilePath, "D");
           $mpdf->Output($pdfFilePath, "F");

           //$attachment = base_url().$fileName;
   }
    public function order_details($id)
    {

        $data['title'] = 'Dashboard | Orders';
        $data['menu'] = 'orders';
        $data['session_user']=$this->session->userdata('logged_in');
        $this->load->model('Cart_model');
        $uid=$data['session_user']['id'];
        $data['Cart']=0;
        if ($this->Cart_model->getUserCartCount($uid)) {
            $data['Cart'] =$this->Cart_model->getUserCartCount($uid);
        }
          $cond="or.id='".$id."' and or.user_id='".$uid."'";
          $data['Item'] = $this->Cart_model->get_invoice($cond);
       $bill_id=$data['Item']['billing_id'];
        $con="o.billing_id='".$bill_id."' and o.user_id='".$uid."' and o.billing_id!='0'";
        $data['order_list'] = $this->Cart_model->get_orderdetails($con);
    $data['total_qty']=count($data['order_list']);
      //  $data['Item'] = $this->Cart_model->getOrderById($id);
      $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$uid."' and status='0'");
   $data['count']=count($data['notify']);
        $data['List'] = $this->Cart_model->getListByOrderId($id);
        // echo json_encode($data);
        // exit;
        $this->load->view('inc/header', $data, false);
        $this->load->view('Dashboard/orders_details', $data, false);
        $this->load->view('inc/footer', $data, false);
    }
    public function notification()
    {
        $data['title'] = 'Dashboard | Notification';
        $data['menu'] = 'notification';
        $data['session_user']=$this->session->userdata('logged_in');
         $userid=$_SESSION['logged_in']['id'];
         $data['get_user']=$this->Common_model->GetData('users',"","id='".$userid."' and is_active='1'",'','','','1');
         $data['notification']=$this->Common_model->GetData('notification',"","user_id='".$userid."' and status='1' and type='user '","","id DESC","");
       $data1=array(
            'user_id'=>$userid,
            'status'=>1,
        );
       // $this->Common_model->SaveData('notification',$data1,"user_id='".$userid."'");
       $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$userid."' and status='0' and type='user '");
      $data['count']=count($data['notify']);
      $this->load->model('Cart_model');
        $data['Cart']=0;
        if ($this->Cart_model->getUserCartCount($userid)) {
            $data['Cart'] =$this->Cart_model->getUserCartCount($userid);
        }
         $this->load->view('inc/header', $data, false);
           $this->load->view('inc/left_menu', $data, false);
        $this->load->view('Dashboard/notification', $data, false);
        $this->load->view('inc/footer', $data, false);
    }
    public function postpaid()
    {
        $data['title'] = 'Dashboard | Postpaid';
        $data['menu'] = 'postpaid';
        $data['session_user']=$this->session->userdata('logged_in');
         $userid=$_SESSION['logged_in']['id'];
  $data['get_user']=$this->Common_model->GetData('users',"","id='".$userid."' and is_active='1'",'','','','1');
$this->load->model('Custom_model');
  $cond=" user_id='".$userid."'and u.type='postpaid'";
  $data['get_postpaid']=$this->Custom_model->postpaiduserslist($cond);
  //print_r($data['get_biling'][0]->user_id); exit;
  $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$userid."' and status='0'");
      $data['count']=count($data['notify']);
      $this->load->model('Cart_model');

        $data['Cart']=0;
        if ($this->Cart_model->getUserCartCount($userid)) {
            $data['Cart'] =$this->Cart_model->getUserCartCount($userid);
        }
         $this->load->view('inc/header', $data, false);
           $this->load->view('inc/left_menu', $data, false);
        $this->load->view('Dashboard/postpaid_list', $data, false);
        $this->load->view('inc/footer', $data, false);
    }
    public function delete($control, $id)
    {
        $data = array();
        $this->load->model('Crud_model');
        $data['message'] = $this->Crud_model->delete($control, $id);
        echo json_encode($data);
    }

     public function savelatter($id)
    {

        $array = array(
                    'status'=>'savelatter',

                 );
        if ($id>0) {
            $update = $this->admin->update('orders', array('id'=>$id), $array);

        }
    }
      public function movetocart($id)
    {

        $array = array(
                    'status'=>'cart',

                 );
        if ($id>0) {
            $update = $this->admin->update('orders', array('id'=>$id), $array);

        }
    }
    public function delete_all()
   {
     $userid=$_SESSION['logged_in']['id'];
       $data['message'] = $this->Common_model->DeleteData('orders',"user_id='".$userid."'");
       echo json_encode($data);
   }
    public function checkout()
    {
      $trck_id=explode(',', $_POST['tracking_id']);
       $count=count($trck_id);
        $data = array();
        $data['session_user']=$this->session->userdata('logged_in');
        $user=$data['session_user']['id'];
        $this->load->model('Cart_model');
        for($i=0;$i<$count;$i++)
         {
             $data['message'] = $this->Cart_model->checkout($user, $trck_id[$i]);
         }
        echo json_encode($data);
    }
    public function logout()
	{
		$this->session->unset_userdata('logged_in');
		$this->session->sess_destroy();
		Utils::no_cache();
		redirect(base_url());
    }

      public function wallet()
    {
        $data['title'] = 'Dashboard | Wallet';
        $data['menu'] = 'wallet';
        $data['session_user']=$this->session->userdata('logged_in');
          $user= $_SESSION['logged_in']['id'];
          $data['get_user']=$this->Common_model->GetData('users',"","id='".$user."' and is_active='1'",'','','','1');
          $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$user."' and status='0'");
       $data['count']=count($data['notify']);
        $data['datalist']=$this->admin->getRows('SELECT * FROM e_wallet where  user_id =   "'.$_SESSION['logged_in']['id'].'"');
        $this->load->model('Cart_model');
            $data['Cart']=0;
            if ($this->Cart_model->getUserCartCount($user)) {
                $data['Cart'] =$this->Cart_model->getUserCartCount($user);
            }

        $data['buyamount']=$this->admin->getVal('SELECT sum(coin) FROM e_wallet where status =1 and user_id ="'.$_SESSION['logged_in']['id'].'"');
        $data['creditamount']=$this->admin->getVal('SELECT sum(coin) FROM e_wallet where status =2 and user_id = "'.$_SESSION['logged_in']['id'].'"');
        $this->load->view('inc/header', $data, false);
        $this->load->view('inc/left_menu', $data, false);
        $this->load->view('Dashboard/wallet.php', $data, false);
        $this->load->view('inc/footer', $data, false);
    }

       public function recharge()
    {
        $data['title'] = 'Dashboard | Recharge';
        $data['menu'] = 'recharge';
        $data['session_user']=$this->session->userdata('logged_in');
          $user= $_SESSION['logged_in']['id'];
          $this->load->model('Cart_model');
              $data['Cart']=0;
              if ($this->Cart_model->getUserCartCount($user)) {
                  $data['Cart'] =$this->Cart_model->getUserCartCount($user);
              }
              $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$user."' and status='0'");
           $data['count']=count($data['notify']);
        $data['get_user']=$this->Common_model->GetData('users',"","id='".$user."' and is_active='1'",'','','','1');
        $date = date('Y-m-d');
        $data['datalist']=$this->admin->getRows("SELECT * FROM prepaidcoin WHERE '".$date."' BETWEEN prepaidcoin .startdate AND prepaidcoin .enddate and status = 1");
       $data['buyamount']=$this->admin->getVal('SELECT sum(coin) FROM e_wallet where status =1 and user_id =   "'.$_SESSION['logged_in']['id'].'"');
                       $data['creditamount']=$this->admin->getVal('SELECT sum(coin) FROM e_wallet where status =2 and user_id =   "'.$_SESSION['logged_in']['id'].'"');
        $this->load->view('inc/header', $data, false);
        $this->load->view('inc/left_menu', $data);
        $this->load->view('Dashboard/recharge', $data, false);
        $this->load->view('inc/footer', $data, false);
    }

    public function recharge45()
    {
        $data['title'] = 'Dashboard | Wallet';
        $data['menu'] = 'wallet';
        $data['session_user']=$this->session->userdata('logged_in');
       $date = date('Y-m-d');
      // $date = '25-05-2020';

        $data['slab1']=$this->admin->getRows('SELECT * FROM prepaidcoin WHERE status = 1 and startdate >= "'.$date.'" and enddate <= "'.$date.'"');


  //$data['datalist']=$this->admin->getRows('SELECT * FROM e_wallet ');and '.$date.' BETWEEN startdate AND enddate and startdate >= "'.$date.'" and enddate <= "'.$date.'"
        $this->load->view('inc/header', $data, false);
        $this->load->view('Dashboard/recharge.php', $data, false);
        $this->load->view('inc/footer', $data, false);
    }
public function recharge1()
    {
        $data['title'] = 'Dashboard | Wallet';
        $data['menu'] = 'wallet';
        $data['session_user']=$this->session->userdata('logged_in');
       $date = date('Y-m-d');
      // $date = '25-05-2020';

        $data['slab1']=$this->admin->getRows('SELECT * FROM prepaidcoin WHERE status = 1 and startdate >= "'.$date.'" AND enddate <= "'.$date.'"');

         //echo $this->db->last_query();
  //$data['datalist']=$this->admin->getRows('SELECT * FROM e_wallet ');and '.$date.' BETWEEN startdate AND enddate and startdate >= "'.$date.'" and enddate <= "'.$date.'"
        $this->load->view('inc/header', $data, false);
        $this->load->view('Dashboard/cardpage.php', $data, false);
        $this->load->view('inc/footer', $data, false);
    }
    public function rechargedetail($id=0)
    {
        $data['title'] = 'Dashboard | Wallet';
        $data['menu'] = 'wallet';
        $data['session_user']=$this->session->userdata('logged_in');
        if($id)
        {
            $data['selectall']=$this->admin->getRow('select * from e_wallet where id='.$id.'');
        }
        $this->load->view('inc/header', $data, false);
        $this->load->view('Dashboard/rechargedetail', $data, false);
        $this->load->view('inc/footer', $data, false);
    }
  public function add_recharge()
{

$amount =$this->input->post('amount');


$this->form_validation->set_rules('slab_id', 'Slab ', 'trim|required');


  if ($this->form_validation->run() == FALSE)
  {
      if(form_error('slab_id'))
      {
          $this->messages->add(form_error('slab_id'), "alert-danger");
          redirect(base_url().'Dashboard/recharge');
      }
  }
  else
  {
        $user=$data['session_user']['id'];
        $this->load->model('Cart_model');
       // $data['message'] = $this->Cart_model->checkout($user, $id);

    $array = array(
               'slab_id'        => $this->input->post('slab_id'),
               'user_id'        => $user,
               'amount'         => $this->input->post('amount'),
               'coin'           => $this->input->post('coin'),
               'remark'         => $this->input->post('remark'),
                );

          $insert = $this->admin->insert('e_wallet', $array);

          if($insert)
          {

      $message='Success';

          }else{
      $message='Error';
    } echo json_encode($message);

  }
}
  public function companylist()
      {
    $getdata=$this->admin->getRows("SELECT * FROM `company` LIMIT 0 ,10");
    $json = file_get_contents('http://104.154.206.30:35/chkcompany?cin=U74999MH2006PLC218261&stack=2');
    //$json = file_get_contents('http://104.154.206.30:35/chkcompany?cin="'.$getdatai->cin.'"&stack=2');
    $obj = json_decode($json,true);
    print_r($obj); exit;
     // print_r($getdata); exit;
      foreach($getdata as $getdatai){
        //http://104.154.206.30:35/chkcompany?cin=U74999MH2006PLC218261&stack=2
    //$courselist=$this->admin->getRow("SELECT * FROM company WHERE technology = '".$getdatai->cin."'");
   // $json = file_get_contents('http://104.154.206.30:35/chkcompany?cin=U74999MH2006PLC218261&stack=2');
    $json = file_get_contents('http://104.154.206.30:35/chkcompany?cin="'.$getdatai->cin.'"&stack=2');
    $obj = json_decode($json,true);
   // print_r($obj); exit;

     $array = array(
           'cin' =>$getdatai->cin,
           'name' =>$getdatai->name,
           'status' =>'yes',
            );

        $insert = $this->admin->insert('company_jun', $array);
    }
   echo 'Success'; exit;

      }

}
