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

class Dashboard_e extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

         $this->load->model('User_dashboard_e');
         $this->load->helper(array('form', 'url'));

    }

    // ===================Auto==search=======
    public function index()
    { 

        if(isset($_SESSION['auth_user']))
        {
            //  session_destroy();exit('checking user sesion');
            if(isset($_SESSION['logType'])){unset($_SESSION['logType']);}    
            $data['title'] = ' User Dashboard  | KreditAid';
            
            $this->load->view('user_dashboard_e/user_header_b', $data, false);
            $this->load->view('user_dashboard_e/dashboard');
            unset($_SESSION['redirectUrl']);   
            $this->load->view('user_dashboard_e/user_footer_links', $data, false);
        }
        else 
        { 
            // var_dump($_SESSION);exit("session check in else");           
            redirect(base_url('/'));    
        }
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

