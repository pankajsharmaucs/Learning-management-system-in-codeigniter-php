<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model Company_model

 * @package        UCS
 * @category    Model
 * @param     ...
 * @return    ...
 *
 */

class Company_model extends CI_Model
{

    public function getCompanyByid($id)
    {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('company');
        return $query->row_array();

    }
    public function count_company(){
      $this->db->select('id');
      $query = $this->db->get('company');
      return $query->num_rows();
    }

    public function getCompanyByCin($id)
    {
        $this->db->select('*');
        $this->db->where('cin', $id);
        $query = $this->db->get('company');
        return $query->row_array();

    }

    public function addAlert(){
        $message="";
        $data = array(
            'companyType' => $this->input->post('companyType'),
            'industry' => $this->input->post('industry'),
            'country' => $this->input->post('country'),
            'state' => $this->input->post('state'),
            'city' => $this->input->post('city'),
            'minPaidUpCapital' => $this->input->post('minPaidUpCapital'),
            'maxPaidUpCapital' => $this->input->post('maxPaidUpCapital'),
            'status'=>'pending'
        );
        $this->db->insert('alerts', $data);
        if ($this->db->affected_rows() > 0) {
            $message = 'Success';
        } else {
            $message = 'Error';
        }
        return $message;
    }

}
