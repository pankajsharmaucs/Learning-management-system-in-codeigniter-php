<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        Utils::no_cache();
        $this->load->model('Send_mail');
        $this->load->model('Common_model');
    }

    public function login()
    {
        $data = array();
        $this->load->model('Auth_model');
        $data['message'] = $this->Auth_model->login();
        echo json_encode($data);
    }
     public function otp()
    {
        $array = array(
                    'is_active'=>1,
                      );
         $update = $this->admin->update('users', array('id'=>$this->input->post('id') ), $array);
         $row=$this->admin->getRow('select * from users where id ="'.$this->input->post('id').'"');
          $sess_data = array(
                'id'=>$row->id,
                'username'=>$row->username,
                'email' => $row->email,
                'name' => $row->name,
                'country_id' => $row->country_id,
                'type' => $row->type,
                'purchase_status' => $row->purchase_status,
                               'max_status' => $row->max_status,

                );
$data['message']='Success';
      echo json_encode($data);  
    }
    public function glogin()
    {
      //  echo 'bhu'.$this->input->post('email'); exit;
       // $data = array();
        $this->load->model('Auth_model');
        $data = $this->Auth_model->glogin();
        echo  $data;
    }

      public function glogincountry()
    {

        $array = array(
                    'country_id'=>$this->input->post('country') ,
                 );
         $update = $this->admin->update('users', array('email'=>$this->input->post('email') ), $array);

      //echo   $this->db->last_query();

    }
    public function checkLogin()
    {
        $data = array();
        if ($this->session->userdata('logged_in')) {
            $data['message'] = 'Logged';
        }else {
          $data['message'] = 'Logged Out';
        }
        echo json_encode($data);
    }

    public function login_comp()
    {
      $this->load->view('components/login_comp', true);
    }

    public function register_comp()
    {
      $this->load->view('components/register_comp', true);
    }
    public function login_comp2()
    {
      $this->load->view('components/login_comp2', true);
    }


    public function register_comp2()
    {
      $this->load->view('components/register_comp2', true);
    }

    public function register()
    {
        $data = array();
        $email=$this->input->post('email');
         $mobile=$this->input->post('mobile');
         $validation_email=$this->Common_model->get_single('users',"email='".$email."'");
        $this->load->model('Auth_model');
          $rand =  rand (1000, 9999);
 $to=$mobile;
    $otp=$rand;
            
        if(empty($validation_email))
        {
         /* if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
              $secret = '6LfN68sZAAAAAGb2-_Oq9bg0jIXnUTGM5VGrQFSI';
              $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
              $responseData = json_decode($verifyResponse);
              if ($responseData->success) {
                  $succMsg = 'Your contact request have submitted successfully.';
              } else {
                  $errMsg = 'Robot verification failed, please try again.';
              }
          }*/
        $datavar = $this->Auth_model->register($otp);
        $data['message'] =$datavar;
        $subject="Registration Confirmed";
        $to=$email;
        $id="1";
        $view='emails/registration_confirm';
        $this->Send_mail->send($id,$to,$view,$subject,$data);
              $msg="Your verification code for Kreditaid application registration is ".$otp;
              send_sms($to,$msg,$otp);

              echo $datavar;
        //echo json_encode($datavar);
      }
       else{
        $datavar = "Email_invalid_0";
        echo $datavar;
         // echo json_encode($datavar);
       }
    }
    public function changePassword()
    {
        $this->load->model('Auth_model');
        $data = array();
        $data['session_user']=$this->session->userdata('logged_in');
        $get_user=$this->Common_model->get_single('users',"id='".$data['session_user']['id']."'");
        $password=Utils::hash('sha1',$this->input->post('password'), AUTH_SALT);
        if($get_user->password==$password)
        {
          $data['message'] = $this->Auth_model->changePassword($data['session_user']['id']);
        }
        else{
          $data['message']='correct_pass';
        }

        echo json_encode($data);
    }

    function save_request_recharge()
    {
      $data['session_user']=$this->session->userdata('logged_in');
        $user_id=$data['session_user']['id'];
      $data=array(
        'user_id'=>$user_id,
        'amount'=>$_POST['amount'],
        'message'=>$_POST['message'],
      );
      $this->Common_model->SaveData('recharge_request',$data);
      echo "1"; exit;
    }


}
