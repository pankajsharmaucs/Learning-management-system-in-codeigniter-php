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

class SendOtp extends CI_Controller
{

     public function __construct()
    {
           parent::__construct();

           // $this->load->model('Account');
           // $this->load->helper(array('form', 'url'));
    }





  public function send_otp()
    {

        $token = filter_var($_POST['token'],FILTER_SANITIZE_STRING);
        if (!$token and $_SESSION['studentToken']) {
        echo 'Invalid Method';exit;
        } else {

        // Process the form 
        $name = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
        $password = filter_var($_POST['password'],FILTER_SANITIZE_STRING);
        $mobile = filter_var($_POST['mobile'],FILTER_SANITIZE_NUMBER_INT);
        $type = filter_var($_POST['type'],FILTER_SANITIZE_STRING);
        $mobile = preg_replace( '/[^0-9]/', '', $mobile );

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { echo  "Invalid Email Type"; die(); }
        if (strlen($mobile) > 10 or strlen($mobile) < 10  ) { echo  "Invalid Mobile Length"; die(); }
        if ($mobile >= 6000000000 and $mobile <= 9999999999  ) {}else{ echo  "Only Number Allowed in  Mobile "; die(); }

    
    // echo $type; die();

    if($type == 'student' || $type == 'teacher')
      {    

        $temp_otp=rand(11111,99999);

        $_SESSION['temp_name']=$name;
        $_SESSION['temp_email']=$email;
        $_SESSION['temp_password']=$password;
        $_SESSION['temp_mobile']=$mobile;
        $_SESSION['temp_type']=$type;
        $_SESSION['temp_otp']=$temp_otp;

        // echo $_SESSION['temp_otp']; die();

        // $config = Array(
        //     'protocol' => 'smtp',
        //     'smtp_host' => 'ssl://smtp.googlemail.com',
        //     'smtp_port' => 465,
        //     'smtp_user' => 'aquib.debox@gmail.com',
        //     'smtp_pass' => '786shavez',
        //     'mailtype'  => 'html',
        //     'charset'   => 'utf-8'
        // );

        //         $this->email->initialize($config);
        //         $this->email->set_newline("\r\n");
        //         $this->email->from('account.unboxskills@gmail.com', 'Unboxskills');
        //         $this->email->to($_SESSION['temp_email']);
        //         $this->email->subject($type.' Registration verification  OTP ');
        //         $this->email->message("Your Registration OTP IS :".$_SESSION['temp_otp']);
            if($_SESSION['temp_otp'] and $_SESSION['temp_email'] )
                 {
                    echo "OtpSent"; exit;
                 }
            else
                 {
                    echo "Failed to send OTP"; exit;
                 }

       }
        //End of student type 
   }
    //End of process     
}








}

