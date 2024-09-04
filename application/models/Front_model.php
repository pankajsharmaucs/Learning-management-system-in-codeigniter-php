<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model Front_model

 * @package        UCS
 * @category    Model
 * @param     ...
 * @return    ...
 *
 */
class Front_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    //  search company results
    public function search()
    {

        $this->db->select('id,name,cin');
        $this->db->order_by('name');
        $query = $this->db->get('company');
        return $query->result_array();

    }
    public function getCompanyList($i)
    {
        $this->db->select('id,name,activity,cin');
        $this->db->limit(15, $i);
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get('company');
        return $query->result_array();
    }

    public function get_num_rows($table)
    {
        $this->db->select('id');
        $query = $this->db->get($table);
        return $query->num_rows();
    }

    public function searchData()
    {
        $data['type'] = $this->input->post('type');
        if ($data['type'] == 'Company_name') {
            $this->db->select('id,name');
        }
        if ($data['type'] == 'CIN/DIN') {
            $this->db->select('id,name,cin');
        }
        if ($data['type'] == 'Director_name') {
            $this->db->select('id,name,director');
        }
        if ($data['type'] == 'Address') {
            $this->db->select('id,name,address');
        }
        $query = $this->db->get('company');

        return $query->result_array();
    }

    // get Company data using id

    public function getCompanyByid($id)
    {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('company');
        return $query->row_array();
    }
    public function getCompanyByCin($id)
    {
        $this->db->select('*');
        $this->db->where('cin', $id);
        $query = $this->db->get('company');
        return $query->row_array();
    }


    public function getDirectorById($id)
    {
        $this->db->select('*,company.name as company_name, scrap_dir.name as dirname');
        $this->db->join('company', 'company.cin = scrap_dir.cin');
        $this->db->where('din', $id);
        $query = $this->db->get('scrap_dir');
        $data['directors'] = $query->result_array();        return $data;
    }
    public function getDirectorById_new($id)
    {
        $this->db->select("director.*,director.name as dirname ,company.name as company_name");
        $this->db->from('scrap_dir as director');
        $this->db->join('company', 'company.cin = director.cin');
        $this->db->where('director.cin', $id);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    public function getMCA_DirectorsByCompanyId($id)
    {
        $this->db->select('*');
        $this->db->where('cin', $id);
        $query = $this->db->get('scrap_dir');
        $data = $query->result_array();

        return $data;
    }
    public function getMCA_ChargesByCompanyId($id)
    {
        $this->db->select('*');
        $this->db->where('cin', $id);
        $query = $this->db->get('mca_charges');
        $data = $query->result_array();
        return $data;
    }
    public function getMCA_DirectorsByCompanytrackingid($id)
    {
        $this->db->select('*');
        $this->db->where('tracking_id', $id);
        $query = $this->db->get('orders');
        if($query->num_rows()){
          $row=$query->row_array();
          $this->db->select('*');
          $this->db->where('cin', $row['items']);
          $query = $this->db->get('mca_directors');
          $data = $query->result_array();
          return $data;
        }


    }


    public function getDirectorsByCompanyId($id)
    {
        $this->db->select('*');
        $this->db->where('cid', $id);
        $query = $this->db->get('comp_director');
        $data = $query->result_array();
        // $array = array_unique($data, SORT_REGULAR);
        $i=0;
        foreach ($data as $item) {
          $this->db->select('*');
          $this->db->where('id', $item['did']);
          $dquery = $this->db->get('directors');
          $data[$i]['dir_info'] = $dquery->row_array();
          $i++;
        }
        return $data;
    }
    public function getDirectorsByCompanyId2($id)
    {
        $this->db->select('*');
        $this->db->where('cin', $id);
        $query = $this->db->get('scrap_dir');
        $data = $query->result_array();
        // $array = array_unique($data, SORT_REGULAR);
        return $data;
    }


    public function getSimilarCompany($id)
    {
        $this->db->select('cin,name,roc,status,class');
        $this->db->like('activity', $id);
        $this->db->limit(12);
        $query = $this->db->get('company');
        $data = $query->result_array();
        return $data;
    }

    // get Company data using id

    public function getCompanyByInput($id)
    {

        $search = explode(" ", $id);
        $search_string = "";
        foreach ($search as $word) {
            $search_string .= metaphone($word) . " ";
        }
        $this->db->select('id,name,category');
        $this->db->like('name', $id);
        $this->db->limit(20);
        $query = $this->db->get('company');
        return $query->result_array();

    }

    public function getCompanyByInputData()
    {
        $data['search'] = $this->input->post('search');
        $data['type'] = $this->input->post('type');
        if ($data['search'] != '') {
            $this->db->select('id,cin,name,activity');
            if ($data['type'] == 'Company_name') {
                $this->db->like('name', $data['search']);
                $this->db->limit(15);
                $query = $this->db->get('company');
            }
            if ($data['type'] == '') {
                $this->db->like('name', $data['search']);
                $this->db->limit(15);
                $query = $this->db->get('company');
            }
            if ($data['type'] == 'CIN/DIN') {
                $this->db->like('cin', $data['search']);
                $this->db->limit(15);
                $query = $this->db->get('company');
            }
            if ($data['type'] == 'Director_name') {
                $this->db->like('name', $data['search']);
                $this->db->limit(15);
                $query = $this->db->get('director');
            }
            if ($data['type'] == 'Address') {
                $this->db->like('address', $data['search']);
                $this->db->limit(15);
                $query = $this->db->get('company');
            }
            return $query->result_array();
        }
    }

    public function getCompanyFiltered()
    {
        $data = array();
        $data['search'] = $this->input->post('search');
        $data['industryType'] = $this->input->post('industryType');
        $data['companyType'] = $this->input->post('companyType');
        $data['city'] = $this->input->post('city');
        $data['status'] = $this->input->post('status');
        $data['paidUpCapital'] = $this->input->post('paidUpCapital');
        $data['listedOrUnlisted'] = $this->input->post('listedOrUnlisted');

        if ($data['companyType'] == "Private Limited") {
            $data['companyType'] = "Private";
        } else if ($data['companyType'] == "Public Limited") {
            $data['companyType'] = "Public";
        } else if ($data['companyType'] == "One Person Company") {
            $data['companyType'] = "Private(One Person Company)";
        }

        // echo $data['roc'];
        $search = explode(" ", $data['search']);
        $search_string = "";
        foreach ($search as $word) {
            $search_string .= metaphone($word) . " ";
        }

        if ($data['search'] != null) {
            $this->db->select('*');
            $this->db->like('name', $data['search']);
            if (($data['city'] !== 'Select City') && ($data['city'] != null)) {
                $this->db->where('roc', $data['city']);
            }
            if (($data['status'] !== 'Select Status') && ($data['status'] != null)) {
                $this->db->where('status', $data['status']);
            }
            if (($data['companyType'] !== 'Select Company Type') && $data['companyType'] != null) {
                $this->db->where('class', $data['companyType']);
            }
            if (($data['industryType'] !== 'Select Industry Type') && ($data['industryType'] != null)) {
                $this->db->like('activity', $data['industryType']);
            }
            if (($data['listedOrUnlisted'] !== 'Select Listed or Unlisted') && ($data['listedOrUnlisted'] != null)) {
                $this->db->where('listedOrUnlisted', $data['listedOrUnlisted']);
            }
            if (($data['paidUpCapital'] !== 'Select Paidup Capital') && ($data['paidUpCapital'] != null)) {
                $this->db->where('paidUpCaiptal', $data['paidUpCapital']);
            }
            $query = $this->db->get('company');
            return $query->result_array();
        } else {
            return null;
        }

    }


    public function getCompanyListFiltered($page)
    {

        $data = array();
        $data['search'] = $this->input->post('search');
        if($data['search']){
          $symbol = '+';
          $data['search']= preg_replace('/(\w+)/i', '+$1', $data['search']);
        }




        $data['industryType'] = json_decode($this->input->post('industryType'), true);
        $data['companyType'] = json_decode($this->input->post('companyType'), true);
        $data['city'] = json_decode($this->input->post('city'), true);
        $data['status'] = json_decode($this->input->post('status'), true);
        // $data['paidUpCapital'] = json_decode($this->input->post('paidUpCapital'), true);
        $data['paidUpCapital'] = $this->input->post('paidUpCapital');
        $data['listedOrUnlisted'] = json_decode($this->input->post('listedOrUnlisted'), true);

        if ($data['paidUpCapital']) {
            $data['minmax'] = (explode("-",$data['paidUpCapital']));
            $minvalue=$data['minmax'][0];
            $maxvalue=$data['minmax'][1];
        }


        if($data['search']){
          $symbol = '+';
          // $data['search']= preg_replace('/(\w+)/i', '+$1', $data['search']);
          $this->db->select('cin,name,activity,status');
          $SQLMATCH = "MATCH (`name`, `cin`) AGAINST ('".$data['search']."*' IN BOOLEAN MODE)";
          $this->db->where($SQLMATCH);
        }else {
          $this->db->select('cin,name,activity,status');
        }
        if (@$data['city']) {
            $this->db->where_in('roc', $data['city']);
        }
        if (@$data['status']) {
            $this->db->where_in('status', $data['status']);
        }
        if (@$data['companyType']) {
            $this->db->where_in('class', $data['companyType']);
        }
        if (@$data['industryType']) {
          // $this->db->like('activity', $data['industryType']);
            foreach($data['industryType'] as $key => $value) {
              if($key == 0) {
                  $this->db->like('activity', $value,'both',false);
                  } else {
                $this->db->or_like('activity', $value);
              }
            }
        }
        if (@$data['listedOrUnlisted']) {
            $this->db->where_in('listedOrUnlisted', $data['listedOrUnlisted']);
        }
        if (@(int)$minvalue) {
            $this->db->where('paidUpCaiptal >=', (int)$minvalue);
        }
        if (@(int)$maxvalue) {
            $this->db->where('paidUpCaiptal <=', (int)$maxvalue);
        }
        $this->db->limit(15, $page);
        // $this->db->order_by("name REGEXP '^[a-z]*'", 'DESC');
        $query = $this->db->get('company');
        $data['SQL_QUERY2']=$this->db->last_query();
        $data['table']= $query->result_array();


        if($data['search']){
          $this->db->select('cin');
          $SQLMATCH = "MATCH (`name`, `cin`) AGAINST ('".$data['search']."*' IN BOOLEAN MODE)";
          $this->db->where($SQLMATCH);

          if (@$data['city']) {
              $this->db->where_in('roc', $data['city']);
          }
          if (@$data['status']) {
              $this->db->where_in('status', $data['status']);
          }
          if (@$data['companyType']) {
              $this->db->where_in('class', $data['companyType']);
          }
          if (@$data['industryType']) {
            // $this->db->like('activity', $data['industryType']);
            foreach($data['industryType'] as $key => $value) {
              if($key == 0) {
                  $this->db->like('activity', $value,'both',false);
                  } else {
                $this->db->or_like('activity', $value);
              }
            }
          }
          if (@$data['listedOrUnlisted']) {
              $this->db->where_in('listedOrUnlisted', $data['listedOrUnlisted']);
          }
          if (@(int)$minvalue) {
              $this->db->where('paidUpCaiptal >=', (int)$minvalue);
          }
          if (@(int)$maxvalue) {
              $this->db->where('paidUpCaiptal <=', (int)$maxvalue);
          }
          $this->db->order_by("name", 'DESC');
          $query = $this->db->get('company');
          $data['SQL_QUERY1']=$this->db->last_query();
          $data['rows']= $query->num_rows();
        }else{
          $this->db->select('cin');

          if (@$data['city']) {
              $this->db->where_in('roc', $data['city']);
          }
          if (@$data['status']) {
              $this->db->where_in('status', $data['status']);
          }
          if (@$data['companyType']) {
              $this->db->where_in('class', $data['companyType']);
          }
          if (@$data['industryType']) {
            // $this->db->like('activity', $data['industryType']);
              foreach($data['industryType'] as $key => $value) {
                if($key == 0) {
                    $this->db->like('activity', $value,'both',false);
                    } else {
                  $this->db->like('activity', $value);
                }
              }
          }
          if (@$data['listedOrUnlisted']) {
              $this->db->where_in('listedOrUnlisted', $data['listedOrUnlisted']);
          }
          if (@(int)$minvalue) {
              $this->db->where('paidUpCaiptal >=', (int)$minvalue);
          }
          if (@(int)$maxvalue) {
              $this->db->where('paidUpCaiptal <=', (int)$maxvalue);
          }
          $this->db->order_by("name REGEXP '^[a-z]*'", 'DESC');
          $query = $this->db->get('company');
          $data['SQL_QUERY1']=$this->db->last_query();
          $data['rows']= $query->num_rows();
        }
        return $data;

    }



    public function getcharges_search_Filtered($page)
    {

        $data = array();
        $data['search'] = $this->input->post('search');
        $data['minimum'] = $this->input->post('minimum');
        $data['maximum'] = $this->input->post('maximum');
        $data['city'] = json_decode($this->input->post('city'), true);
        $data['status'] = json_decode($this->input->post('status'), true);
        $data['chargeAsst'] = $this->input->post('asset');
        $data['chargeholder'] = $this->input->post('bname');


        $this->db->select('*');
        $this->db->from('charges');
        $this->db->join('company', 'charges.cid = company.id');
        if($data['search']){
          $this->db->like('name', $data['search']);
        }
        if($data['chargeAsst']){
          // $this->db->where('name', $data['chargeAsst']);
        }
        if($data['chargeholder']){
          $this->db->like('bname', $data['chargeholder']);
        }
        if (($data['city'] !== 'Select City') && ($data['city'] != null)) {
            $i = 0;
            foreach ($data['city'] as $roc) {
                if ($i == 0) {
                    $this->db->where('roc', $roc);
                } else {
                    $this->db->or_where('roc', $roc);
                }
                $i++;
            }
        }
        if (($data['status'] !== 'Select Status') && ($data['status'] != null)) {
          $i = 0;
            foreach ($data['status'] as $status) {
              if ($i == 0) {
                  $this->db->where('status', $status);
              } else {
                  $this->db->or_where('status', $status);
              }
              $i++;
            }
        }
        if($data['minimum']){
          $this->db->where('amount >=', $data['minimum']);
        }
        if($data['maximum']){
          $this->db->where('amount <=', $data['maximum']);
        }



        $this->db->limit(15, $page);
        $query = $this->db->get();
        $data['table']= $query->result_array();


        $this->db->select('*');
        $this->db->from('charges');
        $this->db->join('company', 'charges.cid = company.id');
        if($data['search']){
          $this->db->like('name', $data['search']);
        }
        if($data['chargeAsst']){
          // $this->db->where('name', $data['chargeAsst']);
        }
        if($data['chargeholder']){
          $this->db->like('bname', $data['chargeholder']);
        }
        if (($data['city'] !== 'Select City') && ($data['city'] != null)) {
            $i = 0;
            foreach ($data['city'] as $roc) {
                if ($i == 0) {
                    $this->db->where('roc', $roc);
                } else {
                    $this->db->or_where('roc', $roc);
                }
                $i++;
            }
        }
        if (($data['status'] !== 'Select Status') && ($data['status'] != null)) {
          $i = 0;
            foreach ($data['status'] as $status) {
              if ($i == 0) {
                  $this->db->where('status', $status);
              } else {
                  $this->db->or_where('status', $status);
              }
              $i++;
            }
        }
        if($data['minimum']){
          $this->db->where('amount >=', $data['minimum']);
        }
        if($data['maximum']){
          $this->db->where('amount <=', $data['maximum']);
        }

        $rows= $this->db->get();
        $data['rows']= $rows->num_rows();
        $data['pageNo']= $page;
        return $data;

    }

    public function checkCIN($id){
      $this->db->select('cin');
      $this->db->where('cin',$id);
      $query = $this->db->get('company');
      return $query->num_rows();
    }
    public function checkDIN($id){
      $this->db->select('din');
      $this->db->where('din',$id);
      $query = $this->db->get('directors');
      return $query->num_rows();
    }
    public function getNetwork($id){
      $this->db->select('*');
      $this->db->where('cin',$id);
      $query = $this->db->get('company');
      return $query->result_array();
    }
    // public function getCompanyByDin($id){
    //
    //   $final = array();
    //   $this->db->select('id');
    //   $this->db->where('din',$id);
    //   $this->db->limit(1);
    //   $query = $this->db->get('directors');
    //   $director= $query->row_array();
    //
    //
    //   $this->db->select('cid');
    //   $this->db->where('did',$director['id']);
    //   $query = $this->db->get('comp_director');
    //   $company=$query->result_array();
    //   $i=0;
    //
    //   foreach ($company as $item) {
    //     $this->db->select('*');
    //     $this->db->where('id',$item['cid']);
    //     $query = $this->db->get('company');
    //     if($query->num_rows()>0){
    //       $com=$query->row_array();
    //       $final[$i]['company_name']=$com['name'];
    //       $final[$i]['company_id']=$com['id'];
    //       $final[$i]['company_cin']=$com['cin'];
    //       $i++;
    //     }
    //   }
    //   return $final;
    // }

    public function getCompanyByDin($id){
      $this->db->select('company.id,company.name,company.cin')
               ->from('company')
               ->join('scrap_dir', 'scrap_dir.cin = company.cin')
               ->WHERE('scrap_dir.din',$id);
      $query = $this->db->get();
      $company=$query->result_array();
      return $company;
    }

    public function getDirectorBydin($id){
      $this->db->select('name');
      $this->db->where('name',$id);
      $query = $this->db->get('directors');
      return $query->row_array();
    }




}
