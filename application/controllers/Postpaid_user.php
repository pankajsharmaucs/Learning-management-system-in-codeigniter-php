<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once APPPATH.'libraries/rozopay/Razorpay.php';
use Razorpay\Api\Api as RazorpayApi;
error_reporting(0);
class Postpaid_user extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
         Utils::no_cache();
         $this->load->model('Common_model');
           $this->load->model('Cart_model');
           $this->load->model('Send_mail');
              $this->load->model('Crud_model');
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url('login'));
            exit;
        }
    }


      public function postpaid()
    {
        $data['title'] = 'Dashboard | Postpaid';
        $data['menu'] = 'postpaid';
        $data['session_user']=$this->session->userdata('logged_in');
         $userid=$_SESSION['logged_in']['id'];
  $data['get_user']=$this->Common_model->GetData('users',"","id='".$userid."' and is_active='1'",'','','','1');
$this->load->model('Custom_model');
  //$cond=" user_id='".$userid."'and u.type='postpaid'";
  //$data['get_postpaid']=$this->Custom_model->postpaiduserslist($cond);
  //print_r($data['get_biling'][0]->user_id); exit;
                $year = date('Y');

$month = date('m');

 // $getdata=$this->admin->getRows("SELECT o.* FROM orders o,users u where u.id=o.user_id and u.id='".$userid."' and Month(date)='".$month."' && YEAR(date)='".$year."'  order by  Month(date)='".$month."'");
 //echo  $this->db->last_query();exit;


    //$getdata=$this->admin->getRows('SELECT * FROM postpaid_invoice where user_id="'.$userid.'"');
   // print_r($getdata);

//echo  $this->db->last_query();exit;

  $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$userid."' and status='0'");
      $data['count']=count($data['notify']);
      $this->load->model('Cart_model');

        $data['Cart']=0;
        if ($this->Cart_model->getUserCartCount($userid)) {
            $data['Cart'] =$this->Cart_model->getUserCartCount($userid);
        }
         $this->load->view('inc/header', $data, false);
           $this->load->view('inc/left_menu', $data, false);
        $this->load->view('postpaid_user/postpaid_list', $data, false);
        $this->load->view('inc/footer', $data, false);
    }
    public function postpaid_details($id)
    {
      //print_r($id);
        $data['title'] = 'Dashboard |Postpaid Details';
        $data['menu'] = 'orders';
        $data['session_user']=$this->session->userdata('logged_in');
        $this->load->model('Cart_model');
        $uid=$data['session_user']['id'];
        $data['Cart']=0;

          $data['postpaid_invoice']=$this->admin->getRow("SELECT * FROM postpaid_invoice where user_id='".$uid."' and id = '".$id."'");

        if ($this->Cart_model->getUserCartCount($uid)) {
            $data['Cart'] =$this->Cart_model->getUserCartCount($uid);
        }
          $cond="or.id='".$id."' and or.user_id='".$uid."'";
          $data['Item'] = $this->Cart_model->get_invoice($cond);
       $bill_id=$data['Item']['billing_id'];
       $data['order_list']=$this->Common_model->GetData('orders',"","user_id='".$uid."'  and Month(date)='".$data['postpaid_invoice']->month."' and YEAR(date)='".$data['postpaid_invoice']->year."'");
    // print_r($this->db->last_query()); exit;
    $data['total_qty']=count($data['order_list']);
     //   $data['getdata']=$this->admin->getRow("SELECT count(o.id) as total,sum(o.cost) as totalamount FROM orders o,users u where u.id=o.user_id and u.id='".$userid."' and Month(date)='".$id."' and YEAR(date)='".$year."'  group by  Month(date)='".$id."'");
   $data['month']=$data['postpaid_invoice']->month;
   $data['year']=$data['postpaid_invoice']->year;
   $data['userid']=$uid;
   $data['id']=$id;
      //  $data['Item'] = $this->Cart_model->getOrderById($id);
        $data['List'] = $this->Cart_model->getListByOrderId($id);
        $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$uid."' and status='0'");
        $data['count']=count($data['notify']);
        $this->load->view('inc/header', $data, false);
        $this->load->view('postpaid_user/postpaid_details', $data, false);
        $this->load->view('inc/footer', $data, false);
    }

        public function checkout1()
        {
           $data['title'] = 'Dashboard | Checkout';
           $data['session_user']=$this->session->userdata('logged_in');
           $userid=$_SESSION['logged_in']['id'];
           $cond="u.id='".$userid."'";
        // $data['country_data']=$this->Crud_model->country_detail($cond);
        // print_r($data['country_data']);exit;
       //  if($data['country_data']['country_id']=='101'){
      //    $data['order_data']=$this->Common_model->GetData('orders',"sum(cost) as amount","status='cart' and user_id='".$userid."'","","","","1");
     //   }
       //   $data['order_data']=$this->Common_model->GetData('orders',"sum(usd_cost) as amount","status='cart' and /user_id='".$userid."'","","","","1");
     //   }
         //   $data['get_order']=$this->Common_model->GetData('orders',"","status='cart' and user_id='".$userid."'","","","","");
        //  if($data['country_data']['country_id']=='101'){
       //   $price= (($data['order_data']->amount)*(18/100))+($data['order_data']->amount);
      //  }

   // $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$userid."' and status='0'");
 //$data['count']=count($data['notify']);
  // $data['get_addr']=$this->Common_model->get_single('billing_address',"user_id='".$userid."'");

              $this->load->view('inc/header',$data);
           $this->load->view('postpaid_user/checkout',$data);
              $this->load->view('inc/footer');
        }

          public function checkout($id)
    {
       $country_id=$this->admin->getVal('SELECT country_id FROM users where id =  "'.$_SESSION['logged_in']['id'].'"');
      $data['session_user']=$this->session->userdata('logged_in');
       $userid=$_SESSION['logged_in']['id'];

        $data['postpaid_invoice']=$this->admin->getRow("SELECT * FROM postpaid_invoice where user_id='".$userid."' and id = '".$id."'");
       $cond="u.id='".$userid."'";
      $data['country_data']=$this->Crud_model->country_detail($cond);
        $data['order_data']=$this->Common_model->GetData('prepaidcoin',"","id='".$id."'","","","","1");
         $data['country']=$this->Common_model->GetData('countries',"","");

     $data['total_cost']=round($data['postpaid_invoice']->totalamount);
     if($data['total_cost']==0)
     {
       redirect('Dashboard/cart');
     }
     $api_key="rzp_test_qnLMiJ2WCSPk1C";
        $api_secret="FT5mOHoLd7hVhi7VKKePpH89";
       $api = new RazorpayApi($api_key, $api_secret);
          $data['order']  = $api->order->create([
  'receipt'         => 'order_rcptid_11',
 'amount'          =>$data['total_cost']*100,
  'currency'        => 'INR',
  'payment_capture' =>  '0'
]);
          //print_r($order->id); exit;
       $data['title'] = 'Dashboard | Checkout';

       $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$userid."' and status='0'");
    $data['count']=count($data['notify']);
       $data['get_addr']=$this->Common_model->get_single('billing_address',"user_id='".$userid."'");
          $this->load->view('inc/header',$data);
       $this->load->view('postpaid_user/checkout',$data);
          $this->load->view('inc/footer');
    }

     public function invoice_download($id,$year,$pid)
   {

       $userid=$_SESSION['logged_in']['id'];



   $data['postpaid_invoice']=$this->admin->getRow("SELECT * FROM postpaid_invoice where user_id='".$userid."' and id = '".$pid."'");

      $data['month']=$data['postpaid_invoice']->month;
   $data['year']=$data['postpaid_invoice']->year;
   $data['userid']=$userid;
   $data['id']=$pid;
       $data['get_order']=$this->Common_model->GetData('orders',"","user_id='".$userid."'","","","","1");
       $data['get_billing']=$this->Common_model->GetData('billing_address',"","user_id='".$userid."'and id='".$id."'","","","","1");
       //$data['product']=$this->Common_model->GetData('orders',"","user_id='".$userid."' and billing_id='".$id."' and billing_id!='0' and date='".date('m')."'","");
          $data['product']=$this->Common_model->GetData('orders',"","user_id='".$userid."'  and Month(date)='".$id."' and YEAR(date)='".$year."'");
    return $this->load->view('postpaid_user/invoice',$data,true);
   }
    public function download_form($id,$year,$pid)
   {


      //$pdf="pdf";
       $body_pdf = $this->invoice_download($id,$year,$pid);
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

     public function save_billing()
    {
      $user_id=$_SESSION['logged_in']['id'];
            $data['get_user']=$this->Common_model->GetData('users',"","id='".$user_id."' and is_active='1'",'','','','1');

           if($data['get_user']->country_id=='101'){
             $gst=$_POST['gst'];
             $total_amount=$_POST['total_amount'];
           }
           else{
             $gst=0;
             $total_amount=0;
           }
          // echo $_POST['country']; exit;
      $data=array(
        'user_id'=>$user_id,
        'billing_id'=>$_POST['slab_id'],
        'country'=>$_POST['country'],
        'city'=>$_POST['city'],
        'mobile'=>$_POST['mobile'],
        'postal_code'=>$_POST['postal_code'],
        'permanent_adddr'=>$_POST['permanent_adddr'],
        'amount'=>$_POST['amount'],
        'gst'=>$gst,
      );

      $this->Common_model->SaveData('billing_address',$data);

      // $pid=$this->input->post('slab_id');

     /*   $array = array(
                    'status'            =>1 ,

                 );


            $update = $this->admin->update('postpaid_invoice', array('id'=>$pid), $array);
*/


     // echo $this->db->last_query(); exit;
      $last_id=$this->db->insert_id();
      if($last_id)
      {
        echo "1"; exit;
      }
      else {
        echo "0"; exit;
      }

    }

    function get_curl_handle($payment_id, $data)
    {
    $url = 'https://api.razorpay.com/v1/payments/' . $payment_id . '/capture';
    $key_id = "rzp_test_qnLMiJ2WCSPk1C";
    $key_secret = 'FT5mOHoLd7hVhi7VKKePpH89';
    $params = http_build_query($data);
    //cURL Request
    $ch = curl_init();
    //set the url, number of POST vars, POST data
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERPWD, $key_id . ':' . $key_secret);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    return $ch;
}

public function call_back()
{

$json = array();
$razorpay_payment_id = $_POST['razorpay_payment_id'];
$merchant_order_id = $_POST['merchant_order_id'];
$currency_code = $_POST['currency'];
// store temprary data
$dataFlesh = array(
    //'card_holder_name' => $_POST['card_holder_name_id'],
    'merchant_amount' => $_POST['merchant_amount'],
    //'merchant_total' => $_POST['merchant_total'],
    'surl' => $_POST['merchant_surl_id'],
    'furl' => $_POST['merchant_furl_id'],
    'currency_code' => $currency_code,
    'order_id' => $_POST['merchant_order_id'],
    'razorpay_payment_id' => $_POST['razorpay_payment_id'],
   // 'razorpay_signature' => $_POST['razorpay_signature'],
);

$paymentInfo = $dataFlesh;
$order_info = array('order_status_id' => $_POST['merchant_order_id']);
$amount = $_POST['merchant_amount'];
$currency_code = $_POST['currency'];

$data = array(
    'amount' => $amount,
    'currency' => $currency_code,
    //'razorpay_signature' => $_POST['razorpay_signature'],
);
//print_r($data); exit;
$success = false;
$error = '';
try {
    $ch = $this->get_curl_handle($razorpay_payment_id, $data);
    //execute post
    $result = curl_exec($ch);
    $data = json_decode($result);

    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($result === false) {

        $success = false;
        $error = 'Curl error: ' . curl_error($ch);
    } else {
        $response_array = json_decode($result, true);
        //Check success response
        if ($http_status === 200 and isset($response_array['error']) === false) {
            $success = true;
        } else {
            $success = false;
            if (!empty($response_array['error']['code'])) {
                $error = $response_array['error']['code'] . ':' . $response_array['error']['description'];
            } else {
                $error = 'Invalid Response <br/>' . $result;
            }
        }
    }
    //close connection
    curl_close($ch);
} catch (Exception $e) {
    $success = false;
    $error = 'Request to Razorpay Failed';
}
if ($success === true) {
//echo "success"; exit;
    $pid=$this->input->post('slab_id');
    $payment_data=array(
    'order_id' => $pid,

    'payment_id' => $_POST['razorpay_payment_id'],
    'razorpay_order_id' => $_POST['razorpay_order_id'],
   'razorpay_signature'=>$_POST['razorpay_signature'],
    'amount' => $amount/100,
    'currency' => $currency_code,
    'payment_status'=>'Success',
  );
    $this->Common_model->SaveData('payment_gateway',$payment_data);
      // $slab1=$this->admin->getRow('SELECT * FROM prepaidcoin WHERE id = "'.$_P;OST['slab_id'].'" ');
       $user= $_SESSION['logged_in']['id'];

$array2 = array(
                    'status'            =>1 ,

                 );


            $update = $this->admin->update('postpaid_invoice', array('id'=>$pid), $array2);


    if (!$order_info['order_status_id']) {
        $json['redirectURL'] = $_POST['merchant_surl_id'];
    } else {
        $json['redirectURL'] = $_POST['merchant_surl_id'];
    }
} else {
    $json['redirectURL'] =$_POST['merchant_furl_id'];
}
$json['msg'] = '';

header('Content-Type: application/json');
echo json_encode($json); exit;

}
  }
