<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Model Authentication

 * @package		UCS
 * @category	Model
 * @param     ...
 * @return    ...
 *
 */

class User_dashboard_e extends CI_Model {

  public function __construct()
  {
    parent::__construct();
  }
  
// ==============Update==profile============================

          public function update($data)
          {
             // echo $data['country']; die();

              if(isset($_SESSION['auth_user']))
              { 
                   $table='users_e';

                    extract($data);
                    $this->db->where('email', $_SESSION['auth_user']);
                    $this->db->update($table, 
                    array('name' => $data['name'],
                          'country' => $data['country'],
                          'gender' => $data['gender']
                          ));
                    return true;

                }

            }
    
  //========================chnage password=============================== 
 public function changePassword($oldPassword,$newPassword)
 {
   $this->db->select('password');
   $this->db->where('email',$_SESSION['auth_user']);
   $query = $this->db->get('users_e');
   $row = $query->result_array();
   if($row[0]['password']==$oldPassword)
   {
    $data = ['password'=>$newPassword];
    $this->db->where('email',$_SESSION['auth_user']);
    $result = $this->db->update('users_e',$data);
    if($result)
    {
      return "Password Changed SuccessFully";
    }
    else
    {
      return "Password Not Change";
    }
  }
  else
  {
    // return $row;
    return "Old Password Is Wrong";
  }


 }

  // ========================================Walllet request Money===================
 public function checkrequeststatus()
 {
    
             $email = $_SESSION['auth_user'];
             $this->db->select('amount');
             $this->db->where('user_id', $email);
             $this->db->where('status', 0);
             $query = $this->db->get('user_recharge_req');
             $data = $query->num_rows();
             return $data; die();
 }


  // ========================================Walllet request Money===================
 public function requestMoney($requestMoneyAmount,$requestMoneyComment)
 {
    $Comment= '';
    if(isset($requestMoneyComment))
    {
      $Comment = $requestMoneyComment;
    } 
    if(isset($requestMoneyAmount))
    { 
      $ctype=$_SESSION['ctype'];

      $email = $_SESSION['auth_user'];
      $data = ['user_id'=>$email,'amount'=>$requestMoneyAmount,'amount_type'=>$ctype,'message'=>$Comment];
      $res = $this->db->insert('user_recharge_req',$data);
      if($res)
      {
        return "Request For Add Money In Wallet Is Submited";
      }
      else
      {
        return "Request For Add Money Is Not Submited";
      }
    }   
 }


 
  //  ===============================remove item ====================================
  public function removeItem($removeItem)
  {
    $this->db->where('id',$removeItem);
    $this->db->where('user_id',$_SESSION['auth_user']);
    $res = $this->db->delete('orders');
    // return $res;
    if($res)
    {
      // $this->load->model('admin');
      // $row = $this->admin->getAllCartData($_SESSION['auth_user'],'orders','cart');
      // $data = [$row,'item deleted'];
      // return $data;
       return "Removed";
    }
    else
    {
      return "Item not deleted";
    }
  }

  //=================================buy Now Item=====================
  public function buyNowItem($buyNow)
  { 
    $id=filter_var($buyNow,FILTER_SANITIZE_NUMBER_INT);
    //fetch data for report cost

        if($uemail=$_SESSION['auth_user'])
              {   

                 $cost=$this->admin->getCartById($uemail,$id);

                  if($_SESSION['country'] == 'India' ) {
                    $sumofcart=$cost[0]['cost'];
                    $currency='INR';
                  } 
                    else{
                     $sumofcart=$cost[0]['usd_cost'];
                     $currency='INR';
                   }
                   
                 $walletData=$this->admin->getUserWallet($uemail,'user_wallet');
                 $wallBal=$walletData[0]['amount'];

             if($wallBal >= $sumofcart){

                   $this->db->where('user_id', $_SESSION['auth_user']);
                   $this->db->where('id', $id);
                   $this->db->where('status', 'cart');
                   
                   if($this->db->update('orders',array('status' => 'paid')))
                   {
                       date_default_timezone_set("Asia/Kolkata");
                        $cdate=date('d-m-Y H:i');

                        $data = ['user_id'=>$_SESSION['auth_user'],'amount'=>$sumofcart,'ctype'=>$currency
                        ,'type'=>'paid','item'=>'Report','t_date'=>$cdate ];
                        $res = $this->db->insert('user_wallet_track',$data);

                        if($res){
                           $bal=$wallBal-$sumofcart;
                           $this->db->where('user_id', $_SESSION['auth_user']);
                           $this->db->update('user_wallet',array('amount' => $bal));

                            return 'paid'; die();
                      }else
                      {
                        return 'Invalid Input'; die();
                      }

                   


                    }
                    
                }
          }
    

  }

  //===========================buy all ==========================
    public function buyAllItemFromCart()
     { 
           if($uemail=$_SESSION['auth_user'])
              {   


                  if($_SESSION['country'] == 'India' ) {
                    $SumofCart=$this->admin->getTotalCartInrCost($uemail);
                    $sumofcart=$SumofCart[0]['cost'];
                    $currency='INR';
                  } 
                    else{
                     $SumofCart=$this->admin->getTotalCartUsdCost($uemail);
                     $sumofcart=$SumofCart[0]['usd_cost'];
                     $currency='INR';
                   }
                   
                 $walletData=$this->admin->getUserWallet($uemail,'user_wallet');
                 $wallBal=$walletData[0]['amount'];


             if($wallBal >= $sumofcart){

                   $this->db->where('user_id', $_SESSION['auth_user']);
                   $this->db->where('status', 'cart');
                   if($this->db->update('orders',array('status' => 'paid')))
                   {

                      date_default_timezone_set("Asia/Kolkata");
                      $cdate=date('d-m-Y H:i');

                      $data = ['user_id'=>$_SESSION['auth_user'],'amount'=>$sumofcart,'ctype'=>$currency
                      ,'type'=>'paid','item'=>'Report','t_date'=>$cdate ];
                      $res = $this->db->insert('user_wallet_track',$data);

                      if($res){
                       $bal=$wallBal-$sumofcart;
                       $this->db->where('user_id', $_SESSION['auth_user']);
                       $this->db->update('user_wallet',array('amount' => $bal));
                        return 'paid'; die(); }
                        else{
                          echo "invalid Input"; die();
                        }

                    }
                    
                }
          }
        
    } 



// ===================get===suport==ticket==last==id====
       public function getLastSupportId()
        {  
             $this->db->select('id');
             $this->db->limit(1);
             $this->db->order_by('id',"DESC");
             $query = $this->db->get('users_support');
             $data = $query->result_array();

             return $data; die();
       }


// =========================Create==ticket===================
 public function checkUserTicketCount()
 {
    
             $email = $_SESSION['auth_user'];
             $this->db->select('id');
             $this->db->where('user_id', $email);
             $this->db->where('ticket_status',0);
             $query = $this->db->get('users_support');
             $data = $query->num_rows();

             return $data; die();
     
    
      
 }


                  public function createTicket($data1)
                     { 
                            $data = ['user_id'=>$_SESSION['auth_user'],
                                     'tid'=>$data1['tid'],
                                     'name'=>$_SESSION['user_name'],
                                     'subject'=>$data1['subject'],
                                     'message'=>$data1['msg'],
                                     'priority'=>$data1['priority'],
                                     'attachment'=>$data1['filename'],
                                    ];
                             $res = $this->db->insert('users_support',$data);

                            if($res){ return  "insert"; die(); }
                               else{return "Failed"; die();} 
                     }

// =================Close==ticket==by==tid====
            public function closeTicketByTid($tid)
                     { 

                            $this ->db -> where('user_id', $_SESSION['auth_user']);
                            $this ->db -> where('tid', $tid);
                            $this->db->update('users_support', array('ticket_status' =>1 ));
                            if($res){ return  "Closed"; die(); }
                               else{return "Failed"; die();} 
                     }

// =================Reopen==ticket==by==tid====
            public function ReopenTicketByTid($tid)
                     { 

                            $this ->db -> where('user_id', $_SESSION['auth_user']);
                            $this ->db -> where('tid', $tid);
                            $this->db->update('users_support', array('ticket_status' =>0 ));
                            if($res){ return  "Reopen"; die(); }
                               else{return "Failed"; die();} 
                     }

}