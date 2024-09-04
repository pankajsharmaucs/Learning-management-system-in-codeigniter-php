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

class Courses extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

         $this->load->model('Admin');
         $this->load->helper(array('form', 'url'));

    }

    // ===================Auto==search=======
    public function index()
    { 

        // echo "All Course"; die();

        $data['title'] = ' All Courses   | Unboxskills';
        $this->load->view('lms/header', $data, false);
        $this->load->view('lms/all_courses');
        $this->load->view('lms/footer', $data, false);
    }


     // ===================category=======
    public function category()
    { 

        // echo "All Course"; die();

        $data['title'] = ' All Courses   | Unboxskills';
        $this->load->view('lms/header', $data, false);
        $this->load->view('lms/category');
        $this->load->view('lms/footer', $data, false);
    }


       // ===================categorydetail=======
    public function categorydetail()
    { 
        // echo "All Course"; die();
        $data['title'] = ' All Courses   | Unboxskills';
        $this->load->view('lms/header', $data, false);
        $this->load->view('lms/categorydetail');
        $this->load->view('lms/footer', $data, false);
    }





// ===============Get ===course==details=======

    public function getCourseDetail($slug)
    { 
        $data['title'] = 'Course Details | Unboxskills';
        $data['slug'] = $slug;

        $this->load->view('lms/header', $data, false);
        $this->load->view('lms/coursedetail');
        $this->load->view('lms/footer', $data, false);
    }




// ===============Get ===course==details=======

public function buyCourse($cid)
    { 

            if(isset($_SESSION['auth_login_unboxskills_student']))
            {
                $_SESSION['temp_course_id']=$cid;
                redirect(base_url('/payment')); die();

            }else{
                redirect(base_url('/login')); die();
            }

    }


// =====================Payment=======


public function payment()
    { 
         $data['title'] = 'Course Payment  | Unboxskills';
         $this->load->view('lms/payment', $data, false);
    }



public function applyCoupon()
    { 

      if(!empty($_POST['couponCode'])  and !empty($_POST['course_id'])  and !empty($_POST['teacher_id']) )
        {


        $data = array(
        'couponCode' => strtoupper(trim(filter_var($_POST['couponCode'],FILTER_SANITIZE_STRING))),
        'course_id' => trim(filter_var($_POST['course_id'],FILTER_SANITIZE_STRING)),
        'teacher_id' => trim(filter_var($_POST['teacher_id'],FILTER_SANITIZE_STRING)),
        );

        $response = $this->Admin->verify_coupon_code($data);     

        if($response){ 
            $start=$response[0]['start_date'];
            $exp=$response[0]['exp_date'];
            $discount=$response[0]['discount'];

            date_default_timezone_set('Asia/Kolkata');
            $reg_date =  date('Y-m-d');

            if($reg_date < $start ){ echo "Coupon Code will Apply from ". $start; die(); }
            else if($reg_date >= $start and $reg_date <= $exp){ 
                $_SESSION['Coupon_discount']=$discount; 
                $_SESSION['Coupon_course_id']=$data['course_id']; 
                $_SESSION['Coupon_teacher_id']=$data['teacher_id']; 

                $price=filter_var($_POST['price'],FILTER_SANITIZE_NUMBER_INT);

                $price1=($price*$discount)/100;
                $price2= $price-$price1;
                $_SESSION['coupon_course_price']= round($price2);

                echo 'Valid'; die(); 
            }else{ echo "Invalid Coupon Code"; die(); }

            var_dump($response); die();
        }else{ echo "Invalid Coupon Code"; die(); }

        }else{ echo "Fill Coupon Code"; die(); }
        
        
    }





public function paymentControll()
    { 

        if($_POST['razorpay_payment_id'] and $_SESSION['studentToken'] ){

        $sid=$_SESSION['auth_login_unboxskills_student'];
        $cid=$_SESSION['temp_course_id'];

        $data = array(
        'price' => $_POST['price']/100,
        'mode' => $_POST['payment_Mode'],
        'pay_id' => $_POST['razorpay_payment_id'],
        'sid' => $sid,
        'cid' => $cid
        );

        $response = $this->Admin->purchase_course($data);     

        if($response=='inserted'){ 
            unset($_SESSION['temp_course_id']);
            unset($_SESSION['temp_instructor_id']);
            unset($_SESSION['temp_offer_price']);
            redirect(base_url('/student/my_course')); die(); 
         }
        else if($response=='failed'){  redirect(base_url('/')); die(); }
        else{  redirect(base_url('/')); die(); }



        }else{

        redirect(base_url('/payment')); die();
        }
        
    }

// ================End==of==payment==========






  // ===================Login Page=======
    public function login()
    { 

        $data['title'] = ' Login | Unboxskills';
        $this->load->view('lms/header', $data, false);
        $this->load->view('lms/login');
        $this->load->view('lms/footer', $data, false);
    }

     // ===================register Page=======
    public function register()
    { 

        $data['title'] = ' Register | Unboxskills';
        $this->load->view('lms/header', $data, false);
        $this->load->view('lms/register');
        $this->load->view('lms/footer', $data, false);
    }

     // ===================reset password Page=======
    public function resetAccount()
    { 

        $data['title'] = ' Register | Unboxskills';
        $this->load->view('lms/header', $data, false);
        $this->load->view('lms/resetAccount');
        $this->load->view('lms/footer', $data, false);
    }










// ==================Update=====profile==pankaj=====
          
          public function UpdateProfile(){

                    $name = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
                    $country = filter_var($_POST['country'],FILTER_SANITIZE_STRING);
                    $gender = filter_var($_POST['gender'],FILTER_SANITIZE_STRING);               

                    if(!empty($name) && !empty($country) && !empty($gender) )
                    { 
                       $data = array(
                                'name' => $name,
                                'country' => $country,
                                'gender'  => $gender
                        );
                        

                        $row = $this->User_dashboard_e->update($data);
                        
                        if($row==1){  redirect(base_url('/User_Dashboard?a=8'));}                      

                        
                    }
                    else
                    {
                        echo "Please Fill All Field With Valid Data";exit;
                    }
          }
   
// =========================pankaj==============================

    
		   public function logout()
		   {
		        // var_dump($_SESSION);die;
		        unset($_SESSION['auth_user']);
		        unset($_SESSION['logType']);
		        if(isset($_SESSION['redirectUrl']))
		        unset($_SESSION['redirectUrl']);
		          
		        // session_unset();
		         
		        session_destroy();

		        redirect(base_url('/')); die();
            }
            
    public function changePassword()
    {
        if(isset($_SESSION['auth_user']))
        {
            // var_dump($_POST);exit;
            $oldPassword = trim($this->input->get_post('oldPassword'));
            $oldPassword = filter_var($oldPassword,FILTER_SANITIZE_STRING);
            $newPassword = trim($this->input->get_post('newPassword'));
            $newPassword = filter_var($newPassword,FILTER_SANITIZE_STRING);
            $oldPassword = Utils::hash('sha1', $oldPassword, AUTH_SALT);
            $newPassword = Utils::hash('sha1', $newPassword, AUTH_SALT);
            // echo $oldPassword.",".$newPassword;exit; 
            if(isset($newPassword) && isset($oldPassword))
            {
                $res = $this->User_dashboard_e->changePassword($oldPassword,$newPassword);
                // var_dump($res);
                echo $res;exit;
            }
            else
            {
                echo "please Enter Valid Data";exit;
            }
        }


    } 
    
    public function requestMoney()
    {
        if(isset($_SESSION['auth_user']))
        {
            // var_dump($_REQUEST);exit;
            // $requestMoneyAmount = $this->input->get_post('requestMoneyAmount');
            // $requestMoneyComment = $this->input->get_post('requestMoneyComment');
            $requestMoneyAmount = trim(filter_var($this->input->get_post('requestMoneyAmount'),FILTER_SANITIZE_STRING));
            $requestMoneyComment = trim(filter_var($this->input->get_post('requestMoneyComment'),FILTER_SANITIZE_STRING));

            $res = $this->User_dashboard_e->checkrequeststatus();

            if($res > 0 )
            {
                 echo 'Your Wallet Recharge request already in progress, Our Executive  will contact  you within 4hrs.<br>Thank You!';
            }    
            else{

                $res = $this->User_dashboard_e->requestMoney($requestMoneyAmount,$requestMoneyComment);
    
               echo $res;exit;

            }


                
        }    
    }

    public function removeFromOrders()
    {
        if(isset($_SESSION['auth_user']))
        {
            // var_dump($_REQUEST);exit;
            $removeItem = filter_var($this->input->get_post('id'),FILTER_SANITIZE_STRING);
            $res = $this->User_dashboard_e->removeItem($removeItem);

            echo $res;exit;
        }        
    }


    public function buyNowFromCart()
    {
        if(isset($_SESSION['auth_user']))
        {
            // var_dump($_REQUEST);exit;
            $buyNow = filter_var($this->input->get_post('id'),FILTER_SANITIZE_STRING);
            $res = $this->User_dashboard_e->buyNowItem($buyNow);
            echo $res;exit;        
            // echo json_encode($res);exit;
        }
        
    }
    
    public function buyAllItemFromCart()
    {  
        if(isset($_SESSION['auth_user']))
        {

            $res = $this->User_dashboard_e->buyAllItemFromCart();
            echo $res;exit;
            // echo json_encode($res);exit;
        }
    }

// =================Create====ticket=======


public function createTicket()
{   
     

            $filename=$_FILES['doc']['name'];
// =============file==validation============
            if($filename){

                $file_temp=$_FILES['doc']['tmp_name'];
                $file_type=$_FILES['doc']['type'];
                $file_size=$_FILES['doc']['size'];

                // var_dump($file_type); die();
                        
                 if($file_type=='image/jpeg' or $file_type=='image/png' or $file_type=='image/jpg' 
                 or $file_type =='application/pdf' )
                 { }else{echo "* You can upload only jpg, png, jpeg, Doc, & pdf. "; die(); }       

                if($file_size > 5652416){echo "  You can upload  max 5mb file. ";die();}

            }else{ echo "Please attach any Screenshot, Image or pdf of issue related"; die(); }
// ===========End of==file==validation============ 

                        if($_SESSION['auth_user'])
                         {
                            $ticketCount = $this->User_dashboard_e->checkUserTicketCount();
                                     // var_dump($ticketCount);die();
                            if($ticketCount < 3)
                               {
                                     $ticketId = $this->User_dashboard_e->getLastSupportId();

                                     $t=$ticketId[0]['id'];

                                     $r=rand(1,999);
                                     $t2=$t+1;
                                     $nid='ST'.$r.$t2;

                                     $subject=filter_var($this->input->post('subject'), FILTER_SANITIZE_STRING);
                                     $priority=filter_var($this->input->post('priority'), FILTER_SANITIZE_STRING);
                                     $msg=filter_var($this->input->post('msg'), FILTER_SANITIZE_STRING);

if($filename){
 $data1 = array(
 'tid' => $nid,'subject' => $subject,'priority' => $priority,'msg' => $msg, 'filename' => $_FILES['doc']['name'] );  
}else{$data1 = array(
  'tid' => $nid,'subject' => $subject,'priority' => $priority,'msg' => $msg );  
}

                        $result= $this->User_dashboard_e->createTicket($data1);

                                        if($result == 'insert') {
                                              
                                              if($filename){

                                                $path='user_tickets/'.$nid.'/';
                                                  if(!is_dir($path)) 
                                                    {mkdir($path,0755,TRUE);} 

                                                  if(move_uploaded_file($file_temp, "$path/$filename"))

                                                    {echo "uploaded"; die();}
                                                }else{ echo "no"; die(); }

                                        }else{ echo $result; die(); }

                            }else{ echo "You have already have 3 tickets";die(); }

                    }else{echo "Athorized User";die();}

                    

            
                
}


// ============Close===ticket===by==id====
    public function closeTicket($tid)
    { 
        if(isset($_SESSION['auth_user']))
          {
               $tid = filter_var($tid,FILTER_SANITIZE_STRING);

              $res = $this->User_dashboard_e->closeTicketByTid($tid);              
              if($res =='Closed'){ redirect(base_url('/User_Dashboard?a=7'));  }
              else{ redirect(base_url('/User_Dashboard?a=7'));  }

          }
    }


// ============Reopen===ticket===by==id====
    public function OpenTicket($tid)
    { 
        if(isset($_SESSION['auth_user']))
          {
               $tid = filter_var($tid,FILTER_SANITIZE_STRING);

              $res = $this->User_dashboard_e->ReopenTicketByTid($tid);              
              if($res =='Reopen'){ redirect(base_url('/User_Dashboard?a=7'));  }
              else{ redirect(base_url('/User_Dashboard?a=7'));  }

          }
    }



}

