<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model Authentication

 * @package        UCS
 * @category    Model
 * @param     ...
 * @return    ...
 *
 */

class Extras_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getStates()
    {
        $this->db->select('DISTINCT(city_state)');
        $query = $this->db->get('cities');
        $data = $query->result_array();
        $data= array_unique($data, SORT_REGULAR);
        return $data;
    }

    public function getCities($state)
    {
        $this->db->select('city_name');
        $this->db->where('city_state', $state);
        $query = $this->db->get('cities');
        $data = $query->result_array();
        $data= array_unique($data, SORT_REGULAR);
        // echo json_encode($data);
        return $data;
    }

    public function getDistictCity()
    {
        $this->db->select('DISTINCT(roc)');
        $query = $this->db->get('company');
        // $this->db->limit(20);
        $data = $query->result_array();
        return $data;
    }
    public function getDistictStatus()
    {
        $this->db->select('DISTINCT(status)');
        $query = $this->db->get('company');
        $this->db->limit(20);
        $data = $query->result_array();
        return $data;
    }

    public function getindustry()
    {
        $this->db->select('DISTINCT(activity)');
        $this->db->where('activity is NOT NULL', NULL, FALSE);
        $this->db->order_by('activity',"ASC");
      //  $this->db->limit(20);
        $query = $this->db->get('company');
        $data = $query->result_array();
        return $data;
    }

    public function getClass()
    {
        $this->db->select('DISTINCT(class)');
        $this->db->where('class is NOT NULL', NULL, FALSE);
        $this->db->where_not_in('class', '');
        $this->db->order_by('class',"ASC");
        $this->db->limit(20);
        $query = $this->db->get('company');
        $data = $query->result_array();
        return $data;
    }

    public function subscribe($email)
    {
      $message = "";
      $data['insert']['email'] = $email;

      $this->db->select('email');
      $this->db->where('email',$email);
      $query = $this->db->get('subscribe');
      $query->result_array();
      if($query->num_rows()){
        $message = 'Subscribed';
      }else{
        $this->db->insert('subscribe', $data['insert']);
        if ($this->db->affected_rows() > 0) {
            $message = 'Success';
            unset($_POST);
        } else {
            $message = 'Error';
        }
      }
      return $message;

    }

}
