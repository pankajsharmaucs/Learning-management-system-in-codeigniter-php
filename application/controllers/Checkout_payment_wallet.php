<?php
defined('BASEPATH') or exit('No direct script access allowed');

include_once APPPATH.'libraries/rozopay/Razorpay.php';

use Razorpay\Api\Api as RazorpayApi;
class Checkout_payment_wallet extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        Utils::no_cache();
         $this->load->model('Common_model');
          $this->load->model('Crud_model');
         $this->load->database();
        $this->load->library(array('form_validation','session',));
        $this->load->helper(array('url','html','form'));
    }

    public function checkout_wallet($id)
    {
       $country_id=$this->admin->getVal('SELECT country_id FROM users where id =  "'.$_SESSION['logged_in']['id'].'"');
      $data['session_user']=$this->session->userdata('logged_in');
       $userid=$_SESSION['logged_in']['id'];
           $cond="u.id='".$userid."'";
      $data['country_data']=$this->Crud_model->country_detail($cond);
        $data['order_data']=$this->Common_model->GetData('prepaidcoin',"","id='".$id."'","","","","1");
         $data['country']=$this->Common_model->GetData('countries',"","");
         if($country_id == 101){
      $price= (($data['order_data']->amount)*(18/100))+($data['order_data']->amount);
      $currency='INR';
    }else{
       $price= $data['order_data']->usdamount;
        $currency='USD';
    }
     $data['total_cost']=round($price);
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
 $data['creditvalue']=$this->admin->getVal('select creditsvalue from creditsvalue where id=1');

  $data['country_id']=$this->admin->getVal('SELECT country_id FROM users where id =  "'.$_SESSION['logged_in']['id'].'"');
  $data['buyamount']=$this->admin->getVal('SELECT sum(coin) FROM e_wallet where status =1 and user_id =   "'.$_SESSION['logged_in']['id'].'"');
     $data['$creditamount']=$this->admin->getVal('SELECT sum(coin) FROM e_wallet where status =2 and user_id =   "'.$_SESSION['logged_in']['id'].'"');
       $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$userid."' and status='0'");
    $data['count']=count($data['notify']);
          $this->load->view('inc/header',$data);
    	 $this->load->view('Dashboard/checkout_wallet',$data);
          $this->load->view('inc/footer');
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
        //'order_id'=>$_POST['order_id'],
        'country'=>$_POST['country'],
        'city'=>$_POST['city'],
        'mobile'=>$_POST['mobile'],
        'postal_code'=>$_POST['postal_code'],
        'permanent_adddr'=>$_POST['permanent_adddr'],
        'amount'=>$_POST['amount'],
        'gst'=>$gst,

      );

      $this->Common_model->SaveData('billing_address',$data);

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
if (!empty($_POST['razorpay_payment_id']) && !empty($_POST['merchant_order_id'])) {
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
    $payment_data=array(
    'order_id' => $_POST['merchant_order_id'],

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
  $data2 = array(
              'slab_id'=> $_POST['slab_id'],
               'user_id'=> $user,
               'amount' =>$amount/100,
               'coin' => $_POST['coin'],
                  'status' => 1,
            //   'discount' => $_POST['discount'],
               'transaction_id'=>$_POST['razorpay_payment_id'],
                );
             $this->Common_model->SaveData('e_wallet',$data2);


    if (!$order_info['order_status_id']) {
        $json['redirectURL'] = $_POST['merchant_surl_id'];
    } else {
        $json['redirectURL'] = $_POST['merchant_surl_id'];
    }
} else {
    $json['redirectURL'] =$_POST['merchant_furl_id'];
}
$json['msg'] = '';
} else {
$json['msg'] = 'An error occured. Contact site administrator, please!';
}
header('Content-Type: application/json');
echo json_encode($json); exit;

}

  }
