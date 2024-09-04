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

class Login extends CI_Controller
{

     public function __construct()
    {
           parent::__construct();

           $this->load->model('Account');
           $this->load->helper(array('form', 'url'));
    }



// =============================Sign Up=======
    public function index()
    { 

        // var_dump($_POST); die();

        $token = filter_var($_POST['token'],FILTER_SANITIZE_STRING);
        if (!$token and   !$_SESSION['loginToken']) {
        echo 'Invalid Method';exit;
        } else {


        // Process the form 
        $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
        $password = filter_var($_POST['password'],FILTER_SANITIZE_STRING);
        $type = filter_var($_POST['type'],FILTER_SANITIZE_STRING);
        $password = Utils::hash('sha1', $password, AUTH_SALT);
        
         $data = array('email'=>$email,'type'=>$type,'password'=>$password);  

         $validUser = $this->Account->userLogin($data);     

          // var_dump($validUser);die();

            if($validUser  >= 1) {

                $_SESSION['auth_login_unboxskills_'.$type]=$email;

                if($_SESSION['auth_login_unboxskills_'.$type])
                {
                    $login_token= md5(uniqid(mt_rand(), true));
                    $_SESSION['login_token']=$login_token;
                    $updateLoginToken = $this->Account->updateLoginToken($data);
                      if($updateLoginToken == true ){ 

                          if($_SESSION['temp_course_id']){ echo "payment"; die(); }
                           echo 'auth_user'; die(); 
                           
                    }else{ echo 'invalid_user'; die(); }                  
                }else{ echo "invalid User"; die(); }
                   

            }else{ echo "Invalid Email or Password"; die(); }

          }
}








}

