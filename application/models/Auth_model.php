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

class Auth_model extends CI_Model {

  public function __construct()
  {
    parent::__construct();
  }


    public function login() {
        $message="";
        $username = $this->input->post('email');
        $password = Utils::hash('sha1', $this->input->post('password'), AUTH_SALT);

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $username);
        $this->db->where('password', $password);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            $row = $query->row();
            if ($row->is_active != 1) {
                $message = 'disabled';
            } else {
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
                $message = 'Success';
                $this->session->set_userdata('logged_in', $sess_data);
                // $this->update_last_login($row->id);
            }
        }else {
            $message = 'Invalid';
        }
        return $message;
    }

  public function glogin() {

        $message="";
        $username = $this->input->post('email');
        //return $username; exit;
        $name = $this->input->post('name');
        $getId = $this->input->post('getId');

        //$password = Utils::hash('sha1', $this->input->post('password'), AUTH_SALT);

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $username);
       // $this->db->where('password', $password);
        $this->db->limit(1);
         $query = $this->db->get();
        if ($query->num_rows() == 1) {
            $row = $query->row();
            if ($row->is_active != 1) {
                $message = 'disabled';
            }else if ($row->country_id != 0) {
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
                $message = 'Success';
                 $message1 ='login';
                $this->session->set_userdata('logged_in', $sess_data);

            } else { $sess_data = array(
                'id'=>$row->id,
                'username'=>$row->username,
                'email' => $row->email,
                'name' => $row->name,
                'country_id' => $row->country_id,
                'type' => $row->type,
                'purchase_status' => $row->purchase_status,
                'max_status' => $row->max_status,

                );
 $this->session->set_userdata('logged_in', $sess_data);

                  $message = 'Success';
                $message1 =$row->country_id;
            }
        }else {
             $data = array(
            'email' => $username,
            'name' => $name,
            'is_active' => 1

          //  'getId' => $getId,

        );

       $insert = $this->db->insert('users', $data);
        if ($insert != '') {
           $message1 ='glogin';
          $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $username);
       // $this->db->where('password', $password);
        $this->db->limit(1);
         $query = $this->db->get();
        if ($query->num_rows() == 1) {
            $row = $query->row();
           if ($row->is_active != 1) {
                $message = 'disabled';
            }else if ($row->country_id != 0) {
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
                $message = 'Success';
                $message1 ='login';
                $this->session->set_userdata('logged_in', $sess_data);

            }else {
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
 $this->session->set_userdata('logged_in', $sess_data);
              $message = 'Success';
                $message1 =$row->country_id;
            }
        }
    }else {
            $message = 'Invalid';
        }
        }
        return $message.'_'.$message1.'_'.$username;
    }


   /* public function register()
    {
        $controll="users";
        $message = "";
        $password=$this->input->post('password');

        $data['insert'] = array();
        $data['fields'] = $this->db->list_fields('users');
        for ($i = 1; $i < sizeof($data['fields']); $i++) {
            $field = $data['fields'][$i];
            $data['insert'][$field] = $this->input->post($field);
        }
        $data['insert']['password'] = Utils::hash('sha1', $password, AUTH_SALT);
        $data['insert']['is_active'] = 0;
        $data['insert']['lastlogin'] = date('Y-m-d');
       $this->db->insert($controll, $data['insert']);
       $message = 'Success';
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $this->input->post('email'));
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            $message = 'Error_Email';
        }else{
            $this->db->insert($controll, $data['insert']);
            $insert_id = $this->db->insert_id();
            $message = 'Success';
            $sess_data = array(
            'id'=>$insert_id,
            'email' => $this->input->post('email'),
            'name' => $this->input->post('name'),
            );
            $this->session->set_userdata('logged_in', $sess_data);
        }

        return $message;
    }
    */
    public function register($otp)
    {
        $controll="users";
        $message = "";
        $password=$this->input->post('password');
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $this->input->post('email'));
        $this->db->limit(1);
        $query = $this->db->get();
      /*  if($query->num_rows() == 1){
            $message = 'Error_Email';
        }*/
        $rand =  $otp;
        $data['insert'] = array();
        $data['fields'] = $this->db->list_fields('users');
        for ($i = 1; $i < sizeof($data['fields']); $i++) {
            $field = $data['fields'][$i];
            $data['insert'][$field] = $this->input->post($field);
        }
        $data['insert']['password'] = Utils::hash('sha1', $password, AUTH_SALT);
        $data['insert']['is_active'] = 0;
         $data['insert']['otp'] = $rand;
        $data['insert']['lastlogin'] = date('Y-m-d');
      // $this->db->insert($controll, $data['insert']);
      // $message = 'Success';
        
        if($query->num_rows() == 1){
            $message = 'Error_Email';
        }else{
            $this->db->insert($controll, $data['insert']);
            $insert_id = $this->db->insert_id();
            $message = 'Success';
          /*  $sess_data = array(
            'id'=>$insert_id,
            'email' => $this->input->post('email'),
            'name' => $this->input->post('name'),
            );
            $this->session->set_userdata('logged_in', $sess_data);*/
        }

        return $message.'_'.$insert_id;
    }

    public function admin_login() {
        $message="";
        $username = $this->input->post('email');
        $password = Utils::hash('sha1', $this->input->post('password'), AUTH_SALT);

        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('email', $username);
        $this->db->where('password', $password);
        $this->db->limit(1);
         $query = $this->db->get();
        if ($query->num_rows() == 1) {
            $row = $query->row();
             if ($row->is_active != 0) {
                $message = 'disabled';
            } else {
            $sess_data = array(
				          'id'=>$row->id,
                'username'=>$row->username,
                'email' => $row->email,
                'usergroup' => $row->usergroup,
                'roll' => $row->assign_to,
                );
                $message = 'Success';
                $this->session->set_userdata('admin_in', $sess_data);
            }
        }else {
            $message = 'Invalid';
        }
        return $message;
    }
    public function admin_register() {
        $message="";
        $data['insert']['password'] = Utils::hash('sha1', $this->input->post('password'), AUTH_SALT);
        $data['insert']['username']=$this->input->post('username');
        $data['insert']['email']=$this->input->post('email');
        $data['insert']['usergroup']="PU";
        $DL=$this->input->post('DL_roll');
        $DA=$this->input->post('DA_roll');
        $FA=$this->input->post('FA_roll');
        $ROLLS = array();
        if($DL=="1"){
          array_push($ROLLS, 'Downloader');
        }
        if($DA=="1"){
          array_push($ROLLS, 'Data Analyst');
        }
        if($FA=="1"){
          array_push($ROLLS, 'Financial Analyst');
        }
        $data['insert']['assign_to'] =json_encode($ROLLS);
        // return $data['insert'];


        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('email', $this->input->post('email'));
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            $message = 'exist';
        }else{
            $this->db->insert('admin', $data['insert']);
            $message = 'Success';
        }
        return $message;
    }
    public function changePassword($id)
    {

        $message = "";
        $password= Utils::hash('sha1', $this->input->post('password'), AUTH_SALT);
        $newPassword=Utils::hash('sha1', $this->input->post('newPassword'), AUTH_SALT);
        $data['insert']['password']=$newPassword;
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('password', $password);
        $this->db->where('id', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            $message = 'Wrong Creds';
        }else{
            $this->db->where('id', $id);
            $this->db->update('users', $data['insert']);
            if ($this->db->affected_rows()) {
                $message = 'Success';
            } else {
                $message='Error';
            }


        }

        return $message;
    }
      public function adminchangePassword($id)
    {

        $message = "";
        $password= Utils::hash('sha1', $this->input->post('password'), AUTH_SALT);
        $newPassword=Utils::hash('sha1', $this->input->post('newPassword'), AUTH_SALT);
        $data['insert']['password']=$newPassword;
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('password', $password);
        $this->db->where('id', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            $message = 'Wrong Creds';
        }else{
            $this->db->where('id', $id);
            $this->db->update('admin', $data['insert']);
            if ($this->db->affected_rows()) {
                $message = 'Success';
            } else {
                $message='Error';
            }


        }

        return $message;
    }
}
