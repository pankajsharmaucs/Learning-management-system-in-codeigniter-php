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

class Account extends CI_Model {

          public function __construct()
          {
            parent::__construct();
          }
  
// ==============Create==Account============================

  public function checkExistingUser()
  {

     $email = $_SESSION['temp_email'];
     $table = $_SESSION['temp_type'];

      $this->db->select('email');
      $this->db->where('email', $email);
      $query = $this->db->get($table);
      $data = $query->num_rows();
      return $data; die();
  }




 public function getLastId()
{

   $table = $_SESSION['temp_type'];

   $this->db->select('id');
   $this->db->limit(1);
   $this->db->order_by('id',"DESC");
   $query = $this->db->get($table);
   $data = $query->result_array();

   return $data; die();
}






        public function CreateAccount($data)
        {

            $table = $_SESSION['temp_type'];
            extract($data);

            date_default_timezone_set('Asia/Kolkata');
            $reg_date =  date('d-M-Y');

            $login_token=$data['password'].rand(9879,999999);
            $_SESSION['login_token']=$login_token;

           if($table=='student'){
             $this->db->set(['student_id'=>$data['id'], 'name'=>$data['name'],'email'=>$data['email']
                ,'mobile'=>$data['mobile'],'password'=>$data['password'],'login_token'=>$login_token,
                'reg_date'=>$reg_date]);
           }else{
                $this->db->set(['teacher_id'=>$data['id'], 'name'=>$data['name'],'email'=>$data['email']
                ,'mobile'=>$data['mobile'],'password'=>$data['password'],'login_token'=>$login_token,
                'reg_date'=>$reg_date]);
           }

            $this->db->insert($table);

            $res =  $this->db->insert_id();

            if($res > 0){ return "inserted"; die(); }else{ return "failed"; die(); }

        }


// ====================Student/Teacher========

      public function userLogin($data)
            {
                extract($data);
                $table=$data['type'];

                $this->db->select('email');
                $this->db->where('email', $data['email']);
                // $this->db->where('password', $data['password']);
                $query = $this->db->get($table);
                $data = $query->num_rows();
                return $data; die();

            }

// ===============Update==login==token======

            public function updateLoginToken($data)
            {
                  extract($data);    
                  $table=$data['type'];

                  if(isset($_SESSION['login_token']))
                  { 

                    $this->db->where('email', $data['email']);
                    $this->db->update($table,array('login_token' => $_SESSION['login_token'] ));
                    return true;
                  
                  }

            }
    




}