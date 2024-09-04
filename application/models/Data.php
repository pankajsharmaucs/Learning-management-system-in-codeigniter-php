<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Data extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function checkuser($id){
      $this->db->select('*');
      $this->db->where('email',$id);
      $this->db->limit(1);
      $query = $this->db->get('users');
      return $query->num_rows();
    }


    function getItem($item)
    {
        $this->db->select('*');
        $this->db->where('meta_name',$item);
        $this->db->limit(1);
        $query = $this->db->get('data');
        return $query->row_array();
    }

    function getItems($item)
    {
        $this->db->select('*');
        $this->db->where('meta_name',$item);
        $query = $this->db->get('data');
        return $query->result_array();
    }
}
