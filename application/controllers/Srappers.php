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

class Scrappers extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

      public function fn_check_company($id)
      {
        echo json_encode($id);
        exit;
        $this->db->select('*');
        $this->db->where('cin',$id);
        $query_company=$this->db->get('company');
        $data['row']=$query_company->row_array();
        if($data['row']['mca_status']!=='Done'){
          $api_url=base_url().'api/basic/'.$id;
          $cmd='curl  -s "'.$api_url.'" > /dev/null &';
          shell_exec($cmd);
        }
      }
      //end admin show pagination support, product
}
