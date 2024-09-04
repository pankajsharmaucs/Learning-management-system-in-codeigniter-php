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

class LoginAndSignUp_model extends CI_Model {

  public function __construct()
  {
    parent::__construct();
   
    
  }
  
  public function signUp($fname,$country,$email,$password)
  {

    // return $
    $this->db->select('email');
    $this->db->where('email',$email);
    $query = $this->db->get('users_e');
    $data = $query->result_array();
    
    // return $this->db->last_query();exit;
    if($data[0]['email']=='')
    {
        
        $createAt = date('d-M-Y');
        // $name = $fname.' '.$lname;
        $this->db->set(['name'=>$fname,'country'=>$country,'email'=>$email,'password'=>$password,'createdAt'=>$createAt]);
        $this->db->insert('users_e');
        
        // return $this->db->last_query();
        $res =  $this->db->insert_id();
        if($res)
        {
          
          $this->db->select('*');
          $this->db->from('users_e');
          $this->db->where('id', $res);
          // $this->db->where('password', $password);
          $this->db->limit(1);
          $query = $this->db->get();
          $row = $query->result_array();
          $return_array = [$row,'registred',$res];
          return $return_array;
        }

    }
    else
    {
        return "exist";
    }
    
  }
  public function existAccountCheck($email)
  {
    $this->db->select('email');
    $this->db->where('email',$email);
    
    $query = $this->db->get('users_e');
    $data = $query->result_array();
    
    // return $this->db->last_query();exit;
    if($data[0]['email']=='')
    {
      return "account_not_exist";
    }
    else
    {
      return "account_exist";
    }
  }

  // ===============================signIn start==================================
  public function signIn($email,$password)
  {
    
    $this->db->select('*');
    
    $this->db->where('email',$email);
     
    // $this->db->where('is_active',1);
    
    // $this->db->where('password', $password);
    
    $this->db->limit(1);
    
    $query = $this->db->get('users_e');
    
    $row = $query->result_array();
    
    // return $row[0]['is_active'];exit;
      
    if($row)
    {
      if($row[0]['is_active']==0)
      {
        // return $row[0]['is_active'];exit;
        $not_block_checking = $this->checkBlockTime($email,$row[0]['block_time']);
        if($not_block_checking==1)
        {
          goto passwordCheck;
        }
        else
        return [$not_block_checking,ceil(((24*60*60)-(time()-$row[0]['block_time']))/(60*60))];
      }
      passwordCheck:
      if($row[0]['password']===$password)
      {
        // return $row[0]['password'].' , '.$password;exit;
        return $row;
      }
      else
      {
         return "wrong Password";
      }
    }
    else
    {
      echo "email not exist";exit;
    }
    
  }
  // ===============================signIn end==================================

  function blockingUser($email)
  {
    $data = array('is_active'=>'0','block_time'=>time());

    $this->db->where('email', $email);
    
    $result = $this->db->update('users_e', $data); 

    if($result)
    {
      return 'you_are_block'; 
    }
    // else
    // {
    //   return 'Account Not Exist';
    // }
    
  }

  function checkBlockTime($email,$blockTime)
  {
    // return (time()-$row[0]['block_time']);
    // return (time()-$row[0]['block_time'])/(24*60*60);
  
    if((time()-$blockTime)/(24*60*60)>=1)
    {
      $data = array('is_active'=>'1');

      $this->db->where('email', $email);
        
      $result = $this->db->update('users_e', $data);
      if($result)
      return 1;
    }
    else
    {
      return "you_are_block";
    }
  }
  
  public function checkEmailExist($email)
  {
    $this->db->select('email');
    $this->db->where('email',$email);
    $query = $this->db->get('users_e');
    $row = $query->result_array();
    $rowCount = $query->num_rows();
    return $rowCount;exit;
    
  }

  public function reset_password($email,$newPassword)
  {
    $data = ['password'=>$newPassword];
    $this->db->where('email',$email);
    $result = $this->db->update('users_e',$data);
    if($result)
    {
      return 1;
    }
    else
    {
      return 0;
    }
  }
}
