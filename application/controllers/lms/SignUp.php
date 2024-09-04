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

class SignUp extends CI_Controller
{

     public function __construct()
    {
           parent::__construct();

           $this->load->model('Account');
           $this->load->helper(array('form', 'url'));
    }



// =============================Sign Up=======
    public function create()
    { 


        $token = filter_var($_POST['token'],FILTER_SANITIZE_STRING);

// var_dump($token.' = '. $_SESSION['otpToken']);die();

        if (!$token and $_SESSION['otpToken']) { echo 'Invalid Method';exit;} 
          else {

                $temp_otp=$_SESSION['temp_otp'];
                $userOtp = trim(filter_var($_POST['userOtp'],FILTER_SANITIZE_NUMBER_INT));
  

    if($temp_otp !== $userOtp){
      if($_SESSION['temp_type'] == 'student' || $_SESSION['temp_type'] == 'teacher'){ 
        if( $_SESSION['temp_email'] and $_SESSION['temp_type'] and $token ){
  
         $existingStudent = $this->Account->checkExistingUser();     




         if($existingStudent <= 0 )
          {

            $lastId = $this->Account->getLastId();

            $lastId=$lastId[0]['id'];

            $rid=rand(1,999);
            $id=$lastId+1;
           
           if($_SESSION['temp_type'] == 'student' ){
                 $sid='us_student_'.$id.$rid;
            }else{  
              $sid='us_teacher_'.$id.$rid; 
            }

            $password=$_SESSION['temp_password'];
            $password = Utils::hash('sha1', $password, AUTH_SALT);

            $type=$_SESSION['temp_type']; 



            $data = array('id' => $sid,'name' => $_SESSION['temp_name'],'email' => $_SESSION['temp_email']
                        ,'mobile' => $_SESSION['temp_mobile'],'password' => $password,'type' => $type );  

            $result= $this->Account->CreateAccount($data);


            if($result == 'inserted') {

              $_SESSION['auth_login_unboxskills_'.$type]=$_SESSION['temp_email'];

                   unset($_SESSION['temp_name']);
                   unset($_SESSION['temp_email']);
                   unset($_SESSION['temp_password']);
                   unset($_SESSION['temp_mobile']);

                  if($_SESSION['temp_course_id']){ echo "payment"; die(); }
                  
                  echo $result;         

                }else{ echo "failed"; die(); }

             }else{ echo "You have already registered";die(); }
        }else{ echo "Unauthorised"; die(); }
    }else { echo "Invalid Type"; die(); }                       



              }else{ echo "Wrong Otp"; die(); }
        }
    }








}

