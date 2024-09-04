<?php
// session_start();
defined('BASEPATH') or exit('No direct script access allowed');

class LoginAndSignUp extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('LoginAndSignUp_model');
    }

    public function signUp()
    {  
        $fname = '';
        $country = '';
        $email = '';
        $password = '';
        $redirectUrl = '';
        // array(4) {
        //     ["fname"]=>
        //     string(3) "sas"
        //     ["lname"]=>
        //     string(9) "wqw eferf"
        //     ["email"]=>
        //     string(11) "a@gmail.com"
        //     ["password"]=>
        //     string(8) "232A1sfd"
        //   }; 
        if(isset($_POST['fname']))
        {
            $fname = filter_var($_POST['fname'],FILTER_SANITIZE_STRING);
        }
        if(isset($_POST['country']))
        {
            $country = filter_var($_POST['country'],FILTER_SANITIZE_STRING);
        }
        if(isset($_POST['email']))
        {
            $email = filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);
        }
        if(isset($_POST['password']))
        {
            $password = Utils::hash('sha1', trim($_POST['password']), AUTH_SALT);              
        }
        if(isset($_POST['redirectUrl']))
        {
            $redirectUrl = filter_var($_POST['redirectUrl'],FILTER_VALIDATE_INT);
        }

        // echo $country; die();
        if(!empty($fname) && !empty($country) && !empty($email) && !empty($password))
        {
            // otp code here
            $accountCheck = $this->LoginAndSignUp_model->existAccountCheck($email);
            if($accountCheck=="account_not_exist")
            {
                $crntTime = time();
                $_SESSION['current_time1'] = $crntTime;
                $_SESSION['otp'] =  rand(100000,999999);
                $_SESSION['to'] = $email;
                $_SESSION['otp_times'] = 2;
                $_SESSION['sign_up_data'] = $fname.','.$country.','.$email.','.$password.','.$redirectUrl;

                $this->send_otp();
            }
            else
            {

                echo "Account Already Exist";exit;
            }
            
            // $fromUser = $this->Send_mail->send($id,$to,$view,$subject,$data);
            // $msg="Your verification code for Kreditaid application registration is ".$otp;
            // send_sms($to,$msg,$otp);
            
        }
        else
        {
            echo "Please Fill All Fields";exit;
        }
        
    }

    public function send_otp()
    {
        
        // $this->load->library('email');

        // $from_email = "KreditAid.com";
        
        // $to_email = $_SESSION['to'];
            
        // //Load email library
        // $this->load->library('email');
        // $this->email->from($from_email, 'Identification');
        // $this->email->to($to_email);
        // $this->email->subject('OTP Related');
        // $this->email->message('OTP :'.$_SESSION['otp']);
            
        // //Send mail
        // if($this->email->send())
        // {
        //     echo "for OTP Notice";exit;
        // }    
        // else
        // {
        //     echo "mail Not Found Enter Correct Email";exit;
        // }    
        // $this->load->view('contact_email_form');
        
        
        // ==============================for otp resend time greater then 1 and less then 5=start========================
        if(isset($_POST['resendOTP']) && ((time()-$_SESSION['current_time1'])/60)>1 && ((time()-$_SESSION['current_time1'])/60)<5)
        {
            unset($_SESSION['otp']);

            $_SESSION['otp'] =  rand(100000,999999);        
        } 
        // ==============================for otp resend time greater then 1 and less then 5=end===========================

        //============================================================otp resend time out then otp not generate=========== 
        if(((time()-$_SESSION['current_time1'])/60)>5)
        {
            unset($_SESSION['otp']);
        }  
        //=============================================================end======================================= 
        
        // =====================================for otp generate=====================
        if(isset($_SESSION['to']) && $_SESSION['otp_times']>0 && $_SESSION['otp']!='')
        {
            
            $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => 'aquib.debox@gmail.com',
                'smtp_pass' => '786shavez',
                'mailtype'  => 'html',
                'charset'   => 'utf-8'
            );

            $this->email->initialize($config);
            $this->email->set_newline("\r\n");
            $this->email->from('aquib.debox@gmail.com', 'KreditAid');
            $this->email->to($_SESSION['to']);
            $this->email->subject('OTP Related');
            $this->email->message("OTP IS :".$_SESSION['otp']);
            if($this->email->send())
            {
                $_SESSION['otp_times'] = $_SESSION['otp_times']-1;

                echo "OTP-Send";exit;
            }
            else
            {
                // var_dump($this->email);
                unset($_SESSION['current_time1']);
                unset($_SESSION['otp']);
                unset($_SESSION['to']);
                unset($_SESSION['otp_times']);
                unset($_SESSION['sign_up_data']);


                echo "OTP not send";exit;
            }
        }
        else if($_SESSION['otp_times']<1)
        {
            session_unset();
            session_destroy();
            // $_SESSION['ip_block'] = $_SERVER['REMOTE_ADDR']; //for ip block to don't signUp for one day
            echo "OTP_LimitCross";exit;
        }
        else if(empty($_SESSION['otp']))
        {
            echo "otp_time_out";exit;
        }    
        else
        {
            echo "Email_ADDR_Wrong";exit;
            // var_dump($_SESSION.' ,  '.(time()-$_SESSION['current_time1'])."  Email_ADDR_Wrong");exit;
        }

    }

      
    public function checkOTP()
    {
        //=========================for otp time out start========
        if(((time()-$_SESSION['current_time1'])/60)>5)// for one menute
        {
            unset($_SESSION['otp']);        
        }
        //=========================for otp time out end==========


        $userOtp = $this->input->get_post('byUserOtp');
        // $userOtp = $this->input->get_post('cin');

        // echo $_SESSION['userOtp']; die();

        if($userOtp == $_SESSION['otp'] && $_SESSION['otp']!='')
        {
            $userData = explode(',',$_SESSION['sign_up_data']);
            
            $res = $this->LoginAndSignUp_model->signUp($userData[0],$userData[1],$userData[2],$userData[3]);
            // echo $res; die();
            if($res[1]=='registred')
            { 


                
                $id = $res[0][0]['id'];
                $email = $res[0][0]['email'];
                $name = $res[0][0]['name'];
                $_SESSION['auth_user'] = $email;
                $_SESSION['logType']='signUp';
                $_SESSION['redirectUrl'] = $userData[4];
                
                unset($_SESSION['current_time1']);
                unset($_SESSION['otp']);
                unset($_SESSION['to']);
                unset($_SESSION['otp_times']);
                unset($_SESSION['sign_up_data']);

                echo "Successfully";exit;
            }
            if($res=='exist')
            {
                echo "Already Exist";exit();    
            }
        }
        else if(empty($_SESSION['otp']))
        {
            session_unset();
            session_destroy();
            echo "OTP_Time_Out";exit;
        }
        else
        {
          echo "Wrong-OTP";exit;   
        }
    }
     
    //=========================================Login start==========================================
    public function signIn()
    {
        // echo "def feefer fger ferege";exit;
        $email = $this->input->get_post('email');

        $password = $this->input->get_post('password');
        $email = trim($email);
        $email = filter_var($email,FILTER_VALIDATE_EMAIL);
        $password = trim($password);    
        $password = filter_var($password,FILTER_SANITIZE_STRING);
        $password = Utils::hash('sha1', $password, AUTH_SALT); 
        $row = $this->LoginAndSignUp_model->signIn($email,$password);
        // var_dump($_SESSION['wrong_pass_attempt']);exit;
        // var_dump($row);exit;
        
        if($row[0]=='you_are_block')
        {
            if(isset($row[1]))
            {
                echo $row[0].','.$row[1];exit;
            }
            else
            {
                echo $row[0].',24';exit;
            }   
        }
        
        if($row == 'wrong Password')
        {
            // unset($_SESSION['wrong_pass_attempt']);
            $_SESSION['wrong_pass_attempt'] = $_SESSION['wrong_pass_attempt']?($_SESSION['wrong_pass_attempt']+1):1;
            
            //=============================for blocking user==Start================= 
            if($_SESSION['wrong_pass_attempt']>5)
            {
                // $_SESSION['wrong_pass_attempt']=1;
                $row = $this->LoginAndSignUp_model->blockingUser($email);
                // echo $_SESSION['wrong_pass_attempt'];exit;
                if($row=='you_are_block')
                {
                    unset($_SESSION['wrong_pass_attempt']);
                    echo $row.',24';exit;
                }
                
            }
            //=============================for blocking user==End================= 
            
            echo "wrong Password".','.$_SESSION['wrong_pass_attempt'];exit;
            
        }
        if($row=='email not exist')
        {
            return 'email not exist';exit;
        }
        if($row[0]['email']==$email) 
        {
            unset($_SESSION['wrong_pass_attempt']);
            // $sess_data = ['id'=>$row[0]['id'],'name'=>$row[0]['name'],'email'=>$row[0]['email']];
            // session_destroy();
            $_SESSION['auth_user']=$row[0]['email'];
            $_SESSION['logType'] = 'signIn';
            $_SESSION['redirectUrl'] = 3;
            // $_SESSION['uid'] =   $row[0]['id']; 
            // var_dump($_SESSION['logged_in']); 
            echo "loggedIn";exit;
        }
        // echo $email.' , '.$password;exit;
    }

    /*===============================forget Password Start===================================*/  
    public function forgetPassOTP()
    {
        $email = $this->input->get_post('email');
        $email = trim($email);
        $email = filter_var($email,FILTER_VALIDATE_EMAIL);
        $result = $this->LoginAndSignUp_model->checkEmailExist($email);
        
        if($result)
        {
            $_SESSION['to'] = $email;
            $_SESSION['crntTime']= time();
            $_SESSION['otp'] = rand(100000,999999);
            $_SESSION['otp_times'] = 2;
            $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => 'aquib.debox@gmail.com',
                'smtp_pass' => '786shavez',
                'mailtype'  => 'html',
                'charset'   => 'utf-8'
            );

            $this->email->initialize($config);
            $this->email->set_newline("\r\n");
            $this->email->from('aquib.debox@gmail.com', 'KreditAid');
            $this->email->to($_SESSION['to']);
            $this->email->subject('OTP Related');
            $this->email->message("OTP IS :".$_SESSION['otp']);
            if($this->email->send())
            {
                $_SESSION['otp_times'] = $_SESSION['otp_times']-1;

                echo "OTP-Send";exit;
            }
            else
            {
                // var_dump($this->email);
                echo "OTP not send";exit;
            } 
        //    echo "account Exist";exit; 
        }
        else
        {
            echo "account not exist";exit;
        }
        // return $result;exit;
        // echo $email;exit;
    }
    public function forgetPassOTPCheck()
    {
        $byUserData = $this->input->get_post('otp');
        $byUserData = trim($byUserData);
        if((time()-$_SESSION['crntTime'])/60<5 && isset($_SESSION['to']))
        {
            if($_SESSION['otp']==$byUserData)
            {
                $_SESSION['otpCorrect'] = 1;
                echo "OTP-Correct";exit;
                
            }
            else
            {
                echo "OTP-incorrect";exit;
            }
        }
        else
        {
            unset($_SESSION['crntTime']);
            echo "OTP-Expire";exit;
        }
    }
    
    public function setNewPassword()
    {
        $newPassword = $this->input->get_post('newPassword');
        $newPassword = trim($newPassword);
        $newPassword = filter_var($newPassword,FILTER_SANITIZE_STRING);
        $newPassword = Utils::hash('sha1', $newPassword, AUTH_SALT); 
        if(isset($_SESSION['to']) &&  $_SESSION['otpCorrect']==1)
        {
            $result = $this->LoginAndSignUp_model->reset_password($_SESSION['to'],$newPassword);
            if($result==1)
            {
                echo "setPassword";exit;
            }
        }
        else
        {
            echo "something went wrong";exit;
        }
    }
    /*===============================forget Password Start===================================*/  
    
    /*===============================Reset PAssword Start====================================*/ 
    // public function resetPassword()
    // {
    //     var_dump($_POST);
    // }
    /*===============================Reset PAssword End====================================*/ 
 
}    