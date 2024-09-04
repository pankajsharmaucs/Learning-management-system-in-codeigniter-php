<?php
defined('BASEPATH') or exit('No direct script access allowed');



 include_once APPPATH.'libraries/rozopay/Razorpay.php';
class Payment extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        Utils::no_cache();
         $this->load->model('Common_model');
         $this->load->database();
        $this->load->library(array('form_validation','session',));
        $this->load->helper(array('url','html','form'));
    }

    public function index()
    {
    	 $api_key="rzp_test_qnLMiJ2WCSPk1C";
        $api_secret="FT5mOHoLd7hVhi7VKKePpH89";
        $api = new RazorpayApi($api_key, $api_secret);
        $order  = $api->order->create([
            'receipt'         => 'order_rcptid_11',
            'amount'          => 100,
            'currency'        => 'INR',
            'payment_capture' =>  '0'
          ]);

         $data=array(
            'order'=>$order,
         );
    	 $this->load->view('payment/index',$data);
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

public function call_back(){
if (!empty($_POST['razorpay_payment_id']) && !empty($_POST['merchant_order_id'])) {
$json = array();
$razorpay_payment_id = $_POST['razorpay_payment_id'];
$merchant_order_id = $_POST['merchant_order_id'];
$currency_code = $_POST['currency_code_id'];
// store temprary data
$dataFlesh = array(
    'card_holder_name' => $_POST['card_holder_name_id'],
    'merchant_amount' => $_POST['merchant_amount'],
    'merchant_total' => $_POST['merchant_total'],
    'surl' => $_POST['merchant_surl_id'],
    'furl' => $_POST['merchant_furl_id'],
    'currency_code' => $currency_code,
    'order_id' => $_POST['merchant_order_id'],
    'razorpay_payment_id' => $_POST['razorpay_payment_id'],
   // 'razorpay_order_id' => $_POST['razorpay_order_id'],
);

$paymentInfo = $dataFlesh;
$order_info = array('order_status_id' => $_POST['merchant_order_id']);
$amount = $_POST['merchant_total'];
$currency_code = $_POST['currency_code_id'];

$data = array(
    'amount' => $amount,
    'currency' => $currency_code,
   // 'razorpay_order_id' => $_POST['razorpay_order_id'],
);
$success = false;
$error = '';
try {
    $ch = $this->get_curl_handle($razorpay_payment_id, $data);
   // print_r($ch);exit;
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

	$payment_data=array(
		  'order_id' => $_POST['merchant_order_id'],
    'payment_id' => $_POST['razorpay_payment_id'],
    'amount' => $amount,
    'currency' => $currency_code,
    'payment_status'=>'Success',
	);
    $this->Common_model->SaveData('payment_gateway',$payment_data);

    if (!$order_info['order_status_id']) {
        $json['redirectURL'] = $_POST['merchant_surl_id'];
    } else {
        $json['redirectURL'] = $_POST['merchant_surl_id'];
    }
} else {
    $json['redirectURL'] = $_POST['merchant_furl_id'];
}
$json['msg'] = '';
} else {
$json['msg'] = 'An error occured. Contact site administrator, please!';
}
header('Content-Type: application/json');
echo json_encode($json); exit;

}

public function success()
{
	//print_r($_REQUEST)
	 $this->load->view('payment/success');
}

  }
