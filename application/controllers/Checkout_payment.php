<?php
defined('BASEPATH') or exit('No direct script access allowed');

include_once APPPATH.'libraries/rozopay/Razorpay.php';

use Razorpay\Api\Api as RazorpayApi;
class Checkout_payment extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        Utils::no_cache();
         $this->load->model('Common_model');
          $this->load->model('Crud_model');
          $this->load->model('Send_mail');
        $this->load->library(array('form_validation','session',));
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url('login'));
            exit;
        }
    }

    public function checkout()
        {
          //print_r($_SESSION); exit;
           $data['title'] = 'Dashboard | Checkout';
           $data['session_user']=$this->session->userdata('logged_in');
           $userid=$_SESSION['logged_in']['id'];
           $cond="u.id='".$userid."'";
         $data['country_data']=$this->Crud_model->country_detail($cond);
        // print_r($data['country_data']);exit;
         if($data['country_data']['country_id']=='101'){
          $data['order_data']=$this->Common_model->GetData('orders',"sum(cost) as amount","status='cart' and user_id='".$userid."'","","","","1");
        }
        else{
          $data['order_data']=$this->Common_model->GetData('orders',"sum(usd_cost) as amount","status='cart' and user_id='".$userid."'","","","","1");
        }
            $data['get_order']=$this->Common_model->GetData('orders',"","status='cart' and user_id='".$userid."'","","","","");
          if($data['country_data']['country_id']=='101'){
          $price= (($data['order_data']->amount)*(18/100))+($data['order_data']->amount);
        }
        else {
            $price=$data['order_data']->amount;
        }
        $data['total_cost']=round($price);
         $api_key="rzp_test_qnLMiJ2WCSPk1C";
            $api_secret="FT5mOHoLd7hVhi7VKKePpH89";
            $api = new RazorpayApi($api_key, $api_secret);
            if($data['total_cost']==0)
            {
              redirect('Dashboard/cart');
            }
              $data['order']  = $api->order->create([
      'receipt'         => 'order_rcptid_11',
     'amount'          => $data['total_cost']*100,
      'currency'        => 'INR',
      'payment_capture' =>  '0'
    ]);
    $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$userid."' and status='0'");
 $data['count']=count($data['notify']);
   $data['get_addr']=$this->Common_model->get_single('billing_address',"user_id='".$userid."'");

      $data['country_id']=$this->admin->getVal('SELECT country_id FROM users where id =  "'.$_SESSION['logged_in']['id'].'"');

    $data['creditvalue']=$this->admin->getVal('select creditsvalue from creditsvalue where id=1');
 $data['usdcreditvalue']=$this->admin->getVal('select usdcreditsvalue from creditsvalue where id=1');
     $data['buyamount']=$this->admin->getVal('SELECT sum(coin) FROM e_wallet where status =1 and user_id =   "'.$_SESSION['logged_in']['id'].'"');
     $data['creditamount']=$this->admin->getVal('SELECT sum(coin) FROM e_wallet where status =2 and user_id =   "'.$_SESSION['logged_in']['id'].'"');


              $this->load->view('inc/header',$data);
        	 $this->load->view('Dashboard/checkout',$data);
              $this->load->view('inc/footer');
        }

        // public function get_phonecode()
        //      {
        //       $get_code=$this->Common_model->GetData('countries','',"id='".$_POST['id']."'","","","","1");
        //
        //   $code=$get_code->phonecode;
        //
        //  echo $code; exit();
        //      }
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

          $rand=rand(0000,9999);
          $data=array(
            'user_id'=>$user_id,
            'billing_no'=>'bill_id_'.$rand,
            'country'=>$_POST['country'],
            'city'=>$_POST['city'],
            'mobile'=>$_POST['mobile'],
            'postal_code'=>$_POST['postal_code'],
            'permanent_adddr'=>$_POST['permanent_adddr'],
            'gst_no'=>$_POST['gst_no'],
            'amount'=>$_POST['amount'],
            'gst'=>$gst,
            'total_amount'=>$total_amount,
            'payment_type'=>2,
            'merchant_order_id'=>$_POST['merchant_id'],


          );

          $this->Common_model->SaveData('billing_address',$data);
          $last_id=$this->db->insert_id();
          if($last_id)
          {

            $purchase_order_id=explode(',', $_POST['order_id']);

             $count = count($purchase_order_id);
           for ($i=0; $i < $count; $i++)
               {

                    $log = array(
                        'billing_id'=>$last_id,
                    );
                     $usertype=$_SESSION['logged_in']['type'];
       if($usertype =='postpaid'){
       $log['status']='paid';


       }

           $this->Common_model->SaveData('orders',$log,"id='".$purchase_order_id[$i]."'");

               }
            echo "1";
          }
          else {
            echo "0";
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

    public function call_back(){
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
      $api_key="rzp_test_qnLMiJ2WCSPk1C";
        $api_secret="FT5mOHoLd7hVhi7VKKePpH89";
        $api = new RazorpayApi($api_key, $api_secret);

  $params = array(
    'count' =>1,
    'skip'  => 1,
    'from'  => 1400826740,
);

$payments= $api->payment->all($params);
$email=$payments['items'][0]->email;
$method=$payments['items'][0]->method;
$status=$payments['items'][0]->status;
        $data=array(
        'order_id' => $_POST['merchant_order_id'],
        'tracking_id' => $_POST['tracking_id'],
        'payment_id' => $_POST['razorpay_payment_id'],
        'razorpay_order_id' => $_POST['razorpay_order_id'],
       'razorpay_signature'=>$_POST['razorpay_signature'],
        'amount' => $amount/100,
        'currency' => $currency_code,
        'payment_status'=>$status,
        'method'=>$method,
        'email'=>$email,
        );
        $this->Common_model->SaveData('payment_gateway',$data);
        $last_id=$this->db->insert_id();
        $get_paymentdata=$this->Common_model->get_single('payment_gateway',"id='".$last_id."'");
        $track=explode(',',$get_paymentdata->tracking_id);
        foreach($track as $key){
            $get_order=$this->Common_model->get_single('orders',"status='cart' and tracking_id='".$key."'");
   // if(!empty($get_order)){
          if(!empty($get_order->category=='Track a Company'))
          {
              $data['track_company'][]=$get_order;

          }
          if(!empty($get_order->category=='Full Company Report'))
     {
        $data['full_company'][]=$get_order;

      }
      if(!empty($get_order->category=='Documents'))
 {
    $data['Documents'][]=$get_order;

  }
  if(!empty($get_order->category=='new incorporation'))
{
$data['new'][]=$get_order;

 }
if(!empty($get_order->category=='recent incorporation'))
{
$data['recent'][]=$get_order;

}
// }
        }
        if(!empty($data['full_company']))
        {
        if(sizeof($data['full_company']))
        {
          $id=2;
          $to=$_SESSION['logged_in']['email'];
            $subject='You have successfully purchased the company report';
           $view='emails/final_report';    //emails/new_company_alert
          $this->Send_mail->send($id,$to,$view,$subject,$data);

          $data_array=array(
            'type'=>'downloader',
            'url'=>'admin/dashboard/downloader',
            'production_user'=>0,
            'name'=>'Full Company Report for Downloader',
          );
          $this->Common_model->SaveData('notification',$data_array);
        }

      }
        if(!empty($data['track_company']))
        {
        if(sizeof($data['track_company']))
        {
          $id=3;
          $to=$_SESSION['logged_in']['email'];
            $subject='You have successfully purchased the Track a company';
           $view='emails/track_company';    //emails/new_company_alert
          $this->Send_mail->send($id,$to,$view,$subject,$data);
        }
      }
        if(!empty($data['Documents']))
        {
        if(sizeof($data['Documents']))
        {
          $id=4;
          $to=$_SESSION['logged_in']['email'];
            $subject='You have successfully purchased the document';
           $view='emails/doc_purchase';    //emails/new_company_alert
          $this->Send_mail->send($id,$to,$view,$subject,$data);
        }
      }

        if(!empty($data['new']))
        {
        if(sizeof($data['new']))
      {
        $id=5;
        $to=$_SESSION['logged_in']['email'];
          $subject='You have successfully purchased new company';
         $view='emails/new_company_alert';    //emails/new_company_alert
        $this->Send_mail->send($id,$to,$view,$subject,$data);
      }
    }
      if(!empty($data['recent']))
      {
        if(sizeof($data['recent']))
        {
        $id=6;
        $to=$_SESSION['logged_in']['email'];
          $subject='You have successfully purchased recent company';
         $view='emails/recent_company';    //emails/new_company_alert
        $this->Send_mail->send($id,$to,$view,$subject,$data);
      }
      }

         // end email
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

// wallet purchased
 public function checkout_wallet($id)
        {
           $data['title'] = 'Dashboard | Checkout';

           $data['session_user']=$this->session->userdata('logged_in');
           $userid=$_SESSION['logged_in']['id'];
            $data['$order_data']=$this->Common_model->GetData('prepaidcoin',"","id='".$id."'","","","","1");
      $price= (($data['$order_data']->amount)*(18/100))+($data['$order_data']->amount);
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
     'amount'          => $data['total_cost']*100,
      'currency'        => 'INR',
      'payment_capture' =>  '0'
    ]);
           /*$title = 'Dashboard | Checkout';
             $data=array(
                'order_data'=>$order_data,
                'get_order'=>$get_order,
                'title'=>$title,
                'total_cost'=>$total_cost,
                'order'=>$order,
             );*/
              $this->load->view('inc/header',$data);
           $this->load->view('Dashboard/checkout_wallet');
              $this->load->view('inc/footer');
        }

        public function save_billing_wallet()
        {

          $user_id=$_SESSION['logged_in']['id'];
          $rand=rand(0000,9999);
          $data=array(
            'user_id'=>$user_id,
           'billing_no'=>'bill_id_'.$rand,
            'country'=>$_POST['country'],
            'city'=>$_POST['city'],
            'mobile'=>$_POST['mobile'],
            'postal_code'=>$_POST['postal_code'],
            'permanent_adddr'=>$_POST['permanent_adddr'],
            'gst_no'=>$_POST['gst_no'],
            'amount'=>$_POST['amount'],
            'gst'=>$_POST['gst'],
            'total_amount'=>$_POST['total_amount'],
            'payment_type'=>1,
            //'merchant_order_id'=>$_POST['merchant_order_id'],

          );

          $this->Common_model->SaveData('billing_address',$data);
         // echo "1";
          $last_id=$this->db->insert_id();

          if($last_id)
          {

          /*  $purchase_order_id=explode(',', $_POST['order_id']);

             $count = count($purchase_order_id);
           for ($i=0; $i < $count; $i++)
               {

                    $log = array(
                        'billing_id'=>$last_id,
                    );

           $this->Common_model->SaveData('orders',$log,"id='".$purchase_order_id[$i]."'");

         } */
            echo "1";
          }
          else {
            echo "0";
          }


        }

        function get_curl_handle_wallet($payment_id, $data)
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

    public function call_back_wallet(){
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
    $success = false;
    $error = '';
    try {
        $ch = $this->get_curl_handle_wallet($razorpay_payment_id, $data);
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

      //$trackings_id=implode(',', $_POST['tracking_id']);
        $payment_data=array(
        'order_id' => $_POST['merchant_order_id'],
        'tracking_id' => $_POST['tracking_id'],
        'payment_id' => $_POST['razorpay_payment_id'],
        'razorpay_order_id' => $_POST['razorpay_order_id'],
       'razorpay_signature'=>$_POST['razorpay_signature'],
        'amount' => $amount/100,
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
