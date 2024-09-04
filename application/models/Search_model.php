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
class Search_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function autoCompleteSearch()
    {
        $data['searchtype'] = $this->input->get_post('searchtype');
        $data['country'] = $this->input->get_post('country');
        $data['name'] = $this->input->get_post('name');


        // $data['search'] = str_replace(' ', '', $data['search']);
        if ($data['type'] == 'Company_name') {
            $this->db->select('id,cin,name');
            // $this->db->like('name', $data['search']);
            if($data['search']){
              $symbol = '+';
              $data['search']= preg_replace('/(\w+)/i', '+$1', $data['search']);
            }
            $SQLMATCH = "MATCH (`name`, `cin`) AGAINST ('".$data['search']."*"."' IN BOOLEAN MODE)";
            $this->db->where($SQLMATCH);
            $this->db->limit(50);
            // $this->db->order_by("name");
            $query = $this->db->get('company');
            return $query->result_array();
        }
        
        if ($data['type'] == 'CIN') {
            $this->db->select('id,cin,name');
            $SQLMATCH = "MATCH (`name`, `cin`) AGAINST ('".$data['search']."' IN BOOLEAN MODE)";
            $this->db->where($SQLMATCH);
            // $this->db->like('cin', $data['search']);
            $this->db->limit(50);
            $this->db->order_by("name", 'ASC');
            $query = $this->db->get('company');
            return $query->result_array();
        }
        if ($data['type'] == 'DIN') {
            $this->db->select('id,din,name,');
            $SQLMATCH = "MATCH (`din`, `name`) AGAINST ('".$data['search']."' IN BOOLEAN MODE)";
            $this->db->where($SQLMATCH);
            $this->db->where('IsActive',1);
            $this->db->limit(50);
            $query = $this->db->get('directors');
            return $query->result_array();
        }

        if ($data['type'] == 'Director_name') {
          // echo "string";
            $this->db->select('id,din,name');
            $SQLMATCH = "MATCH (`din`, `name`) AGAINST ('".$data['search']."' IN BOOLEAN MODE)";
            $this->db->where($SQLMATCH);
            // $this->db->where('IsActive',1);
            // $this->db->like('name', $data['search'], 'after');
            $this->db->limit(50);
            $query = $this->db->get('scrap_dir');
            return $query->result_array();
        }

        if ($data['type'] == 'Address') {
            $this->db->select('id,cin,name,address');
            $this->db->like('address', $data['search']);
            $this->db->limit(50);
            $query = $this->db->get('company');
            return $query->result_array();
        }


    }

    public function getDirectorsList($page)
    {

        $data = array();
        // exit;
        $data['search'] = $this->input->get_post('search');
        // $data['search']='pankaj sachdeva';
        if($data['search']){
          $symbol = '+';
          $data['search']= preg_replace('/(\w+)/i', '+$1', $data['search']);
        }
        $j=0;

        if($data['search']){
          $this->db->select('*');
          // $this->db->join('company', 'company.cin = scrap_dir.cin');
          $SQLMATCH = "MATCH (`name`, `din`) AGAINST ('".$data['search']."*' IN BOOLEAN MODE)";
          $this->db->where($SQLMATCH);
          $this->db->limit(15, $page);
          $query = $this->db->get('scrap_dir');
          $data['table']= $query->result_array();
          if($data['table']){
            foreach ($data['table'] as $item) {
              $this->db->select('id,cin,name');
              $SQLMATCH = "MATCH (`name`, `cin`) AGAINST ('".$item['cin']."*"."' IN BOOLEAN MODE)";
              $this->db->where($SQLMATCH);
              $this->db->limit(1);
              $query = $this->db->get('company');
              $company= $query->row_array();
              $data['table'][$j]['company_name']=$company['name'];
            }
          }


          // echo json_encode($data['table']);

          // echo json_encode($data['table']);



          $this->db->select('id');
          $SQLMATCH = "MATCH (`name`, `din`) AGAINST ('".$data['search']."*' IN BOOLEAN MODE)";
          $this->db->where($SQLMATCH);
          $query = $this->db->get('scrap_dir');
          $data['rows']= $query->num_rows();
        }


        return $data;

    }

    public function getCompanyList()
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
        } elseif ($data['companyType'] == "Public Limited") {
            $data['companyType'] = "Public";
        } elseif ($data['companyType'] == "One Person Company") {
            $data['companyType'] = "Private(One Person Company)";
        }

        if ($data['paidUpCapital'] == "Upto 1 Lakh") {
            $minvalue=0;
            $maxvalue=100000;
            $data['paidUpCapital'] = 100000;
        } elseif ($data['paidUpCapital'] == "From 1 Lakh to 5 Lakh") {
            $data['paidUpCapital'] = 500000;
            $minvalue=100000;
            $maxvalue=500000;
        } elseif ($data['paidUpCapital'] == "From 5 Lakh to 10 Lakh") {
            $minvalue=500000;
            $maxvalue=1000000;
            $data['paidUpCapital'] = 1000000;
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
                $this->db->where('paidUpCaiptal >=', $minvalue);
                $this->db->where('paidUpCaiptal <=', $maxvalue);
            }
            $query = $this->db->get('company');
            return $query->result_array();
        } else {
            $this->db->select('*');
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
                $this->db->where('paidUpCaiptal >=', $minvalue);
                $this->db->where('paidUpCaiptal <=', $maxvalue);
            }
            $this->db->limit(15);
            $query = $this->db->get('company');
            return $query->result_array();
        }
    }

    public function getUsersList($page)
    {
        $data = array();
        $this->db->select('*');
        $this->db->limit(10, $page);
        $query = $this->db->get('users');
        $data['table']= $query->result_array();

        //count rows
        $this->db->select('id');
        $query = $this->db->get('users');
        $data['rows']= $query->num_rows();
        return $data;
    }

    public function getdownloaderData($page)
    {
        $data = array();
        $data['session_user']=$this->session->userdata('admin_in');
        $admin=$data['session_user']['id'];
        $filter=$this->input->post('filter');
        $id=$this->input->post('id');
        if ($id) {
            $this->db->select('*');
            $this->db->where('task.user_id', $admin);
            $this->db->from('task');
            $this->db->join('orders','task.task_id = orders.tracking_id');
            $this->db->where('orders.tracking_id', $id);
            $this->db->group_by('task.task_id');
            $query = $this->db->get();
            $data= $query->result_array();
        } else {
            $this->db->select('*');
            $this->db->where('task.user_id', $admin);
            $this->db->where('task.roll', 'Downloader');
            $this->db->from('task');
            $this->db->join('orders','task.task_id = orders.tracking_id');
            $this->db->where('orders.category', 'Full Company Report');
            $this->db->where('orders.status', 'paid');
            if (($filter)&&($filter!='all')) {
                $this->db->where('orders.downloader', $filter);
            }
            $this->db->group_by('task.task_id');
            // $this->db->limit(10, $page);
            $this->db->order_by('orders.id', 'DESC');
            $query = $this->db->get();


            $data= $query->result_array();
            if ($data) {
                $data=array_slice($data, (int)$page, 10);
            }
        }

        $i=0;
        $orders = array();
        foreach ($data as $item) {
            if ($item['items']!=='') {
                $this->db->select('name,cin');
                $this->db->where('cin', $item['items']);
                $cquery = $this->db->get('company');
                $company=$cquery->row_array();
                $data[$i]['company_name']=$company['name'];
                $data[$i]['cin']=$company['cin'];
                $i++;
            }
        }
        $orders['table']= $data;

        //count rows
        $this->db->select('orders.id');
        $this->db->where('task.user_id', $admin);
        $this->db->from('task');
        $this->db->join('orders','task.task_id = orders.tracking_id');
        if (($filter)&&($filter!='all')) {
            $this->db->where('orders.downloader', $filter);
        }
        $this->db->where('orders.category', 'Full Company Report');
        $this->db->where('orders.status', 'paid');
        $query = $this->db->get();
        $orders['rows']= $query->num_rows();
        return $orders;
    }

    public function getdocumentsData($page)
    {
        $data = array();
        $filter=$this->input->post('filter');
        $id=$this->input->post('id');
        if ($id) {
            $this->db->select('*');
            $this->db->where('tracking_id', $id);
            $query = $this->db->get('orders');
            $data= $query->result_array();
        }else {
            $this->db->select('*');
            if (($filter)&&($filter!='all')) {
                $this->db->where('downloader', $filter);
            }
            $this->db->where_in('category', ['Documents','All Documents']);
            $this->db->where('status', 'paid');
            $this->db->order_by('id', 'DESC');
            $query = $this->db->get('orders');
            $data= $query->result_array();
            if ($data) {
                $data=array_slice($data, (int)$page, 10);
            }
        }

        $i=0;

        $orders = array();
        foreach ($data as $item) {
            if ($item['items']!=='') {
                $this->db->select('name,cin');
                $this->db->where('cin', $item['items']);
                $cquery = $this->db->get('company');
                $company=$cquery->row_array();
                $data[$i]['company_name']=$company['name'];
                $data[$i]['cin']=$company['cin'];
                $i++;
            }
        }
        $orders['table']= $data;

        //count rows
        $this->db->select('id');
        if (($filter)&&($filter!='all')) {
            $this->db->where('downloader', $filter);
        }
        $this->db->where_in('category', ['Documents','All Documents']);
        $this->db->where('status', 'paid');
        $query = $this->db->get('orders');
        $orders['rows']= $query->num_rows();
        return $orders;
    }

    public function getdata_analystData($page)
    {
        $data = array();
        $data['session_user']=$this->session->userdata('admin_in');
        $admin=$data['session_user']['id'];
        $filter=$this->input->post('filter');
        $id=$this->input->post('id');
        if ($id) {
          $this->db->select('*');
          $this->db->where('task.user_id', $admin);
          $this->db->from('task');
          $this->db->join('orders','task.task_id = orders.tracking_id');
          $this->db->where('orders.tracking_id', $id);
          $this->db->group_by('task.task_id');
          $query = $this->db->get();
          $data= $query->result_array();
        } else {
            $this->db->select('*');
            $this->db->from('task');
            $this->db->join('orders','task.task_id = orders.tracking_id');
            if (($filter=='all')||$filter=='') {
                $filterBY = array('new','returned','completed');
                $this->db->where_in('orders.da', $filterBY);
            }
            if ($filter=='new') {
                $this->db->where('orders.da', 'new');
            }
            if ($filter=='returned') {
                $this->db->where('orders.da', 'returned');
            }
            if ($filter=='completed') {
                $this->db->where('orders.da', 'completed');
            }
            $this->db->where('orders.category', 'Full Company Report');
            $this->db->where('orders.status', 'paid');
            $this->db->where('task.user_id', $admin);
            $this->db->where('task.roll', 'DA');
            // $this->db->limit(10, $page);
            $this->db->group_by('task.task_id');
            $this->db->order_by('orders.id', 'DESC');
            $query = $this->db->get();
            $data= $query->result_array();
            if ($data) {
                $data=array_slice($data, (int)$page, 10);
            }
        }

        $i=0;
        $orders = array();
        foreach ($data as $item) {
            if ($item['items']!=='') {
                $this->db->select('name');
                $this->db->where('cin', $item['items']);
                $cquery = $this->db->get('company');
                $company=$cquery->row_array();
                $data[$i]['company_name']=$company['name'];
                $i++;
            }
        }
        $orders['table']= $data;

        //count rows
        $this->db->select('orders.id');
        $this->db->from('task');
        $this->db->join('orders','task.task_id = orders.tracking_id');
        if (($filter=='all')||$filter=='') {
            $filterBY = array('new','returned','completed');
            $this->db->where_in('orders.da', $filterBY);
        }
        if ($filter=='new') {
            $this->db->where('orders.da', 'new');
        }
        if ($filter=='returned') {
            $this->db->where('orders.da', 'returned');
        }
        if ($filter=='completed') {
            $this->db->where('orders.da', 'completed');
        }
        $this->db->where('orders.category', 'Full Company Report');
        $this->db->where('orders.status', 'paid');
        $this->db->where('task.user_id', $admin);
        $this->db->where('task.roll', 'DA');
        // $this->db->limit(10, $page);
        $this->db->group_by('task.task_id');

        $this->db->order_by('orders.id', 'DESC');
        $query = $this->db->get();
        $orders['rows']= $query->num_rows();
        return $orders;
    }


    public function getFaData($page)
    {
        $data = array();
        $data['session_user']=$this->session->userdata('admin_in');
        $admin=$data['session_user']['id'];
        $filter=$this->input->post('filter');
        $id=$this->input->post('id');
        if ($id) {
            $this->db->select('*');
            $this->db->from('task');
            $this->db->join('orders','task.task_id = orders.tracking_id');
            $this->db->where('orders.tracking_id', $id);
            $query = $this->db->get('orders');
            $data= $query->result_array();
        } else {
            $this->db->select('*');
            $this->db->from('task');
            $this->db->join('orders','task.task_id = orders.tracking_id');
            if (($filter=='all')||$filter=='') {
                $filterBY = array('new','returned','completed');
                $this->db->where_in('orders.fa', $filterBY);
            }
            if ($filter=='new') {
                $this->db->where('orders.fa', 'new');
            }
            if ($filter=='returned') {
                $this->db->where('orders.fa', 'returned');
            }
            if ($filter=='completed') {
                $this->db->where('orders.fa', 'completed');
            }
            $this->db->where('orders.category', 'Full Company Report');
            $this->db->where('orders.status', 'paid');
            $this->db->where('task.user_id', $admin);
            $this->db->where('task.roll', 'FA');
            $this->db->group_by('task.task_id');
            $this->db->order_by('orders.id', 'DESC');
            $query = $this->db->get();
            $data= $query->result_array();
            if ($data) {
                $data=array_slice($data, (int)$page, 10);
            }
        }

        $i=0;
        $orders = array();
        foreach ($data as $item) {
            if ($item['items']!=='') {
                $this->db->select('name');
                $this->db->where('cin', $item['items']);
                $cquery = $this->db->get('company');
                $company=$cquery->row_array();
                $data[$i]['company_name']=$company['name'];
                $i++;
            }
        }
        $orders['table']= $data;

        //count rows
        $this->db->select('orders.id');
        $this->db->from('task');
        $this->db->join('orders','task.task_id = orders.tracking_id');
        if (($filter=='all')||$filter=='') {
            $filterBY = array('new','returned','completed');
            $this->db->where_in('orders.fa', $filterBY);
        }
        if ($filter=='new') {
            $this->db->where('orders.fa', 'new');
        }
        if ($filter=='returned') {
            $this->db->where('orders.da', 'returned');
        }
        if ($filter=='completed') {
            $this->db->where('orders.fa', 'completed');
        }
        $this->db->where('orders.category', 'Full Company Report');
        $this->db->where('orders.status', 'paid');
        $this->db->where('task.user_id', $admin);
        $this->db->where('task.roll', 'FA');
        $this->db->group_by('task.task_id');
        $this->db->order_by('orders.id', 'DESC');
        $query = $this->db->get();
        $orders['rows']= $query->num_rows();
        return $orders;
    }

    public function userlist($user_id, $page)
    {

        $data = array();
        $filter=$this->input->post('filter');
        $id=$this->input->post('id');
        // all data
        if ($filter=='all') {
            if ($id) {
                $this->db->select('*');
                $this->db->where('tracking_id', $id);
                $this->db->where('status', 'paid');
                $this->db->where_in('product_status', ['In Progress','completed']);
                $this->db->where_in('fa', ['completed','']);
                $this->db->where_in('category', ['Existing Report','Full Company Report']);
                $this->db->where('user_id',$user_id);
                $query = $this->db->get('orders');
                $data= $query->result_array();
            } else {
                $this->db->select('*');
                $this->db->where('user_id', $user_id); //amit
                $this->db->where_in('fa', ['completed','']);
                $this->db->where('status', 'paid');
                $this->db->where_in('product_status', ['In Progress','completed']);
                $this->db->where_in('category', ['Documents','All Documents','Existing Report','Full Company Report','Track a Company','recent incorporation']);
                $this->db->order_by('id', 'DESC');
                $query = $this->db->get('orders');
                $data= $query->result_array();
                // echo json_encode($data);
                if ($data) {
                    $data=array_slice($data, (int)$page, 10);
                }
            }

            $i=0;
            $orders = array();
            foreach ($data as $item) {
                if ($item['items']!=='') {
                    $this->db->select('name');
                    $this->db->where('cin', $item['items']);
                    $cquery = $this->db->get('company');
                    $company=$cquery->row_array();
                    $data[$i]['company_name']=$company['name'];
                    $i++;
                }
            }
            $orders['table']= $data;

            $this->db->select('*');
            $this->db->where('status', 'paid');
            $this->db->where_in('fa', ['completed','']);
            $this->db->where('user_id',$user_id);
            $this->db->where_in('product_status', ['In Progress','completed']);
            $this->db->where_in('category', ['Documents','All Documents','Existing Report','Full Company Report','Track a Company','recent incorporation']);

            $this->db->order_by('id', 'DESC');
            $queryr = $this->db->get('orders');
            $orders['rows']= $queryr->num_rows();
            // echo json_encode($orders);
            return $orders;
       }
        // end all data
        if ($filter=='full') {
            if ($id) {
                $this->db->select('*');
                $this->db->where('tracking_id', $id);
                $this->db->where('status', 'paid');
                $this->db->where('fa', 'completed');
                $this->db->where_in('category', ['Existing Report','Full Company Report']);
                $this->db->where('user_id',$user_id);
                $query = $this->db->get('orders');
                $data= $query->result_array();
            } else {
                $this->db->select('*');

                $this->db->where('status', 'paid');
                $this->db->where('user_id', $user_id); //amit
                $this->db->where_in('fa', ['completed','']);
                $this->db->where_in('product_status', ['In Progress','completed']);
                $this->db->where_in('category', ['Existing Report','Full Company Report']);
                $this->db->order_by('id', 'DESC');
                $query = $this->db->get('orders');
                $data= $query->result_array();
                // echo json_encode($data);
                if ($data) {
                    $data=array_slice($data, (int)$page, 10);
                }
            }

            $i=0;
            $orders = array();
            foreach ($data as $item) {
                if ($item['items']!=='') {
                    $this->db->select('name');
                    $this->db->where('cin', $item['items']);
                    $cquery = $this->db->get('company');
                    $company=$cquery->row_array();
                    $data[$i]['company_name']=$company['name'];
                    $i++;
                }
            }
            $orders['table']= $data;

            $this->db->select('*');
            $this->db->where('status', 'paid');
           $this->db->where_in('fa', ['completed','']);
           $this->db->where_in('product_status', ['In Progress','completed']);
            $this->db->where('user_id',$user_id);
            $this->db->where_in('category', ['Existing Report','Full Company Report']);
            $this->db->order_by('id', 'DESC');
            $queryr = $this->db->get('orders');
            $orders['rows']= $queryr->num_rows();
            // echo json_encode($orders);
            return $orders;
       }

       if ($filter=='track') {
           if ($id) {
               $this->db->select('*');
               $this->db->where('tracking_id', $id);
             //  $this->db->where('assigned', 'fa');
              $this->db->where('status', 'paid');
               $this->db->where('product_status', 'In Progress');
               $this->db->where('category', 'Track a Company');
               $this->db->where('user_id',$user_id);
               $query = $this->db->get('orders');
               $data= $query->result_array();
           } else {
               $this->db->select('*');

               $this->db->where('status', 'paid');
                $this->db->where('user_id', $user_id); //amit
               $this->db->where('status', 'paid');
                 $this->db->where('product_status', 'In Progress');
               $this->db->where('category', 'Track a Company');
               $this->db->order_by('id', 'DESC');
               $query = $this->db->get('orders');
               $data= $query->result_array();
               // echo json_encode($data);
               if ($data) {
                   $data=array_slice($data, (int)$page, 10);
               }
           }

           $i=0;
           $orders = array();
           foreach ($data as $item) {
               if ($item['items']!=='') {
                   $this->db->select('name');
                   $this->db->where('cin', $item['items']);
                   $cquery = $this->db->get('company');
                   $company=$cquery->row_array();
                   $data[$i]['company_name']=$company['name'];
                   $i++;
               }
           }
           $orders['table']= $data;

           $this->db->select('*');
           $this->db->where('status', 'paid');
           $this->db->where('user_id',$user_id);
           $this->db->where('category', 'Track a Company');
             $this->db->where('product_status', 'In Progress');
           $this->db->order_by('id', 'DESC');
           $queryr = $this->db->get('orders');
           $orders['rows']= $queryr->num_rows();
           // echo json_encode($orders);
           return $orders;
      }
      if ($filter=='recent') {
          if ($id) {
              $this->db->select('*');
              $this->db->where('tracking_id', $id);
            //  $this->db->where('assigned', 'fa');
             $this->db->where('status', 'paid');
              $this->db->where('category', 'recent incorporation');
              $this->db->where('user_id',$user_id);
              $query = $this->db->get('orders');
              $data= $query->result_array();
          } else {
              $this->db->select('*');

              $this->db->where('status', 'paid');
               $this->db->where('user_id', $user_id); //amit
              $this->db->where('status', 'paid');
              $this->db->where('category', 'recent incorporation');
              $this->db->order_by('id', 'DESC');
              $query = $this->db->get('orders');
              $data= $query->result_array();
              // echo json_encode($data);
              if ($data) {
                  $data=array_slice($data, (int)$page, 10);
              }
          }

          $i=0;
          $orders = array();
          foreach ($data as $item) {
              if ($item['items']!=='') {
                  $this->db->select('name');
                  $this->db->where('cin', $item['items']);
                  $cquery = $this->db->get('company');
                  $company=$cquery->row_array();
                  $data[$i]['company_name']=$company['name'];
                  $i++;
              }
          }
          $orders['table']= $data;

          $this->db->select('*');
          $this->db->where('status', 'paid');
          $this->db->where('user_id',$user_id);
          $this->db->where('category', 'recent incorporation');
          $this->db->order_by('id', 'DESC');
          $queryr = $this->db->get('orders');
          $orders['rows']= $queryr->num_rows();
          // echo json_encode($orders);
          return $orders;
     }
     if ($filter=='document') {
         if ($id) {
             $this->db->select('*');
             $this->db->where('tracking_id', $id);
           //  $this->db->where('assigned', 'fa');
            $this->db->where('status', 'paid');
            $this->db->where('product_status', 'completed');
             $this->db->where_in('category', ['Documents','All Documents']);
             $this->db->where('user_id',$user_id);
             $query = $this->db->get('orders');
             $data= $query->result_array();
         } else {
             $this->db->select('*');

             $this->db->where('status', 'paid');
              $this->db->where('user_id', $user_id); //amit
             $this->db->where('product_status', 'completed');
             $this->db->where_in('category', ['Documents','All Documents']);
             $this->db->order_by('id', 'DESC');
             $query = $this->db->get('orders');
             $data= $query->result_array();
             // echo json_encode($data);
             if ($data) {
                 $data=array_slice($data, (int)$page, 10);
             }
         }

         $i=0;
         $orders = array();
         foreach ($data as $item) {
             if ($item['items']!=='') {
                 $this->db->select('name');
                 $this->db->where('cin', $item['items']);
                 $cquery = $this->db->get('company');
                 $company=$cquery->row_array();
                 $data[$i]['company_name']=$company['name'];
                 $i++;
             }
         }
         $orders['table']= $data;

         $this->db->select('*');
         $this->db->where('status', 'paid');
         $this->db->where('user_id',$user_id);
         $this->db->where('product_status', 'completed');
         $this->db->where_in('category', ['Documents','All Documents']);
         $this->db->order_by('id', 'DESC');
         $queryr = $this->db->get('orders');
         $orders['rows']= $queryr->num_rows();
         // echo json_encode($orders);
         return $orders;
    }
    }

    public function UserOrders($user_id, $page)
    {
        $data = array();
         $filter=$this->input->post('filter');
        $this->db->select('*');
        if (($filter)&&($filter!='all')) {
               $this->db->where('product_status', $filter);
           }
        $this->db->where('status', 'paid');
        $this->db->where('user_id', $user_id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('orders');
        $data= $query->result_array();
        // echo json_encode($data);
        if ($data) {
            $data=array_slice($data, (int)$page, 10);
        }

        $i=0;
        $orders = array();
        foreach ($data as $item) {
            if ($item['items']!=='') {
                $this->db->select('*');
                $this->db->where('id', $item['billing_id']);
                $cquery = $this->db->get('billing_address');
                $company=$cquery->row_array();
                $data[$i]['merchant_order_id']=$company['merchant_order_id'];
                $i++;
            }
        }
        $i=0;
        $orders = array();
        foreach ($data as $item) {
            if ($item['user_id']!=='') {
                $this->db->select('*');
                $this->db->where('id', $item['user_id']);
                $cquery = $this->db->get('users');
                $product=$cquery->row_array();
                $data[$i]['country_id']=$product['country_id'];
                $i++;
            }
        }
        $i=0;
        $orders = array();
        foreach ($data as $item) {
            if ($item['items']!=='') {
                $this->db->select('*');
                $this->db->where('cin', $item['items']);
                $cquery = $this->db->get('company');
                $product=$cquery->row_array();
                $data[$i]['company_name']=$product['name'];
                $i++;
            }
        }
        $i=0;
        $orders = array();
        foreach ($data as $item) {
            if ($item['country_code']!=='') {
                $this->db->select('*');
                $this->db->where('sortname', $item['country_code']);
                $cquery = $this->db->get('countries');
                $country=$cquery->row_array();
                $data[$i]['country_name']=$country['name'];
                $i++;
            }
        }
        $orders['table']= $data;

        $this->db->select('id');
        if (($filter)&&($filter!='all')) {
           $this->db->where('product_status', $filter);
       }
        $this->db->where('status', 'paid');
        $this->db->where('user_id', $user_id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('orders');
        $orders['rows']= $query->num_rows();
        // echo json_encode($orders);
        return $orders;
    }
    public function User_walletdata($user_id, $page)
    {
        $data = array();

        $this->db->select('*');

        $this->db->where('status', '1');
        $this->db->where('user_id', $user_id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('e_wallet');
        $data= $query->result_array();
        // echo json_encode($data);
        if ($data) {
            $data=array_slice($data, (int)$page, 10);
        }
        $orders['table']= $data;

        $this->db->select('id');
        $this->db->where('status', '1');
        $this->db->where('user_id', $user_id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('e_wallet');
        $orders['rows']= $query->num_rows();
        // echo json_encode($orders);
        return $orders;
    }
    public function User_notificationdata($user_id, $page)
    {
        $data = array();

        $this->db->select('*');

        // $this->db->where('status', '1');
        $this->db->where('user_id', $user_id);
        $this->db->where('type', 'user');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('notification');
        $data= $query->result_array();
        // echo json_encode($data);
        if ($data) {
            $data=array_slice($data, (int)$page, 10);
        }
        $i=0;
        $orders = array();
        foreach ($data as $item) {
            if ($item['user_id']!=='') {
                $this->db->select('*');
                $this->db->where('user_id', $item['user_id']);
                $cquery = $this->db->get('orders');
                $company=$cquery->row_array();
                $data[$i]['company_name']=$company['name'];
                $data[$i]['category']=$company['category'];
                $data[$i]['tracking_id']=$company['tracking_id'];
                $i++;
            }
        }

        $orders['table']= $data;

        $this->db->select('id');
        $this->db->where('status', '1');
        $this->db->where('user_id', $user_id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('notification');
        $orders['rows']= $query->num_rows();
        // echo json_encode($orders);
        return $orders;
    }
    public function getOrderData($page)
    {
        $data = array();
        $filter=$this->input->post('filter');
        $id=$this->input->post('id');
        if ($id) {
            $this->db->select('*');
            $this->db->where('tracking_id', $id);
            $query = $this->db->get('orders');
            $data= $query->result_array();
        } else {
            $this->db->select('*');
            if (($filter)&&($filter!='all')) {
                $this->db->where('product_status', $filter);
            }
            $this->db->where('status', 'paid');
            $this->db->order_by('id', 'DESC');
            $query = $this->db->get('orders');
            $data= $query->result_array();
            if ($data) {
                $data=array_slice($data, (int)$page, 10);
            }


        }

        $i=0;
        $orders = array();
        foreach ($data as $item) {
            if ($item['items']!=='') {
                $this->db->select('name,cin');
                $this->db->where('cin', $item['items']);
                $cquery = $this->db->get('company');
                $company=$cquery->row_array();
                $data[$i]['company_name']=$company['name'];
                $data[$i]['cin']=$company['cin'];
                $i++;
            }
        }
        $orders['table']= $data;

        //count rows
        $this->db->select('id');
        if (($filter)&&($filter!='all')) {
            $this->db->where('product_status', $filter);
        }
        $this->db->where('status', 'paid');
        $query = $this->db->get('orders');
        $orders['rows']= $query->num_rows();
        return $orders;
    }

    public function getReportsData($page)
    {
        $data = array();
        $filter=$this->input->post('filter');
        $id=$this->input->post('id');
        if ($id) {
            $this->db->select('*');
            $this->db->where('tracking_id', $id);
            $query = $this->db->get('orders');
            $data= $query->result_array();
        } else {
            $this->db->select('*');
            if (($filter)&&($filter!='all')) {
                $this->db->where('product_status', $filter);
            }
            $this->db->where('status', 'paid');
            $this->db->where_in('category', ['Existing Report','Full Company Report']);
            $this->db->order_by('id', 'DESC');
            $query = $this->db->get('orders');
            $data= $query->result_array();
            if ($data) {
                $data=array_slice($data, (int)$page, 10);
            }
        }

        $i=0;
        $orders = array();
        foreach ($data as $item) {
            if ($item['items']!=='') {
                $this->db->select('name,cin');
                $this->db->where('cin', $item['items']);
                $cquery = $this->db->get('company');
                $company=$cquery->row_array();
                $data[$i]['company_name']=$company['name'];
                $data[$i]['cin']=$company['cin'];

                $this->db->select('*');
                $this->db->where('task_id', $item['tracking_id']);
                $this->db->where('roll', $item['assigned']);
                $tquery = $this->db->get('task');
                $task=$tquery->row_array();

                $this->db->select('*');
                $this->db->where('id', $task['user_id']);
                $pquery = $this->db->get('admin');
                $pros=$pquery->row_array();

                $data[$i]['Pro']=$pros['email'];


                $i++;
            }
        }
        $orders['table']= $data;

        //count rows
        $this->db->select('id');
        if (($filter)&&($filter!='all')) {
            $this->db->where('product_status', $filter);
        }
        $this->db->where('status', 'paid');
        $this->db->where_in('category', ['Existing Report','Full Company Report']);
        $query = $this->db->get('orders');
        $orders['rows']= $query->num_rows();
        return $orders;
    }

    public function getUserData($page)
    {
        $data = array();
        $filter=$this->input->post('filter');
        $id=$this->input->post('id');
        if ($id) {
            $this->db->select('*');
            $this->db->like('name',$id);
            $query = $this->db->get('users');
            $data= $query->result_array();
        } else {
            $this->db->select('*');
            $this->db->where('type !=','postpaid');
             $this->db->or_where('type',NULL);
            $this->db->order_by('id', 'DESC');
            $query = $this->db->get('users');
            $data= $query->result_array();
            if ($data) {
                $data=array_slice($data, (int)$page, 10);
            }
        }
        $orders['table']= $data;
        //count rows
        $this->db->select('*');
       $this->db->where('type !=','postpaid');
          $this->db->or_where('type',NULL);
         $this->db->order_by('id', 'DESC');
        $query = $this->db->get('users');
        $orders['rows']= $query->num_rows();
        return $orders;
    }
    // public function getadminData($page)
    // {
    //     $data = array();
    //     $filter=$this->input->post('filter');
    //     $id=$this->input->post('id');
    //     if ($id) {
    //         $this->db->select('*');
    //         $this->db->where('username', $id);
    //         $query = $this->db->get('admin');
    //         $data= $query->result_array();
    //     } else {
    //         $this->db->select('*');
    //         $this->db->order_by('id', 'DESC');
    //         $query = $this->db->get('admin');
    //         $data= $query->result_array();
    //         if ($data) {
    //             $data=array_slice($data, (int)$page, 10);
    //         }
    //     }
    //     $orders['table']= $data;
    //     //count rows
    //     $this->db->select('id');
    //     $query = $this->db->get('admin');
    //     $orders['rows']= $query->num_rows();
    //     return $orders;
    // }
    public function get_walletData($page)
        {
            $data = array();
            $filter=$this->input->post('filter');
            $id=$this->input->post('id');
            if ($id) {
                $this->db->select('*');
                $this->db->where('id', $id);
                $query = $this->db->get('e_wallet');
                $data= $query->result_array();
            } else {
                $this->db->select('*');
                $this->db->where('status', '1');
                $this->db->order_by('id', 'DESC');
                $query = $this->db->get('e_wallet');
                $data= $query->result_array();
                if ($data) {
                    $data=array_slice($data, (int)$page, 10);
                }


            }

            $i=0;
            $orders = array();
            foreach ($data as $item) {
                if ($item['user_id']!=='') {
                    $this->db->select('name');
                    $this->db->where('id', $item['user_id']);
                    $cquery = $this->db->get('users');
                    $company=$cquery->row_array();
                    $data[$i]['name']=$company['name'];
                    $i++;
                }
            }
            $orders['table']= $data;

            //count rows
            $this->db->select('id');
            $this->db->where('status', '1');
            $query = $this->db->get('e_wallet');
            $orders['rows']= $query->num_rows();
            return $orders;
        }
          public function get_walletuserData($page)
        {
            $data = array();
            $filter=$this->input->post('filter');
            $id=$this->input->post('id');
            if ($id) {
                $this->db->select('*');
                $this->db->where('id', $id);
                $query = $this->db->get('users');
                $data= $query->result_array();
            } else {
                $this->db->select('*');
                $this->db->where('status', '1');
                $this->db->order_by('id', 'DESC');
                $query = $this->db->get('users');
                $data= $query->result_array();
                if ($data) {
                    $data=array_slice($data, (int)$page, 10);
                }


            }

            $i=0;
            $orders = array();
            foreach ($data as $item) {
                if ($item['user_id']!=='') {
                    $this->db->select('name');
                    $this->db->where('id', $item['user_id']);
                    $cquery = $this->db->get('users');
                    $company=$cquery->row_array();
                    $data[$i]['name']=$company['name'];
                    $i++;
                }
            }
            $orders['table']= $data;

            //count rows
            $this->db->select('id');
            $this->db->where('status', '1');
            $query = $this->db->get('e_wallet');
            $orders['rows']= $query->num_rows();
            return $orders;
        }
    public function get_notificationData($page)
        {
            $data = array();
            $filter=$this->input->post('filter');
            $id=$this->input->post('id');
            if ($id) {
                $this->db->select('*');
                $this->db->where('name', $id);
                $query = $this->db->get('notification');
                $data= $query->result_array();
            } else {
                $this->db->select('*');
                $this->db->where('admin_status', '1');
                $this->db->order_by('id', 'DESC');
                $query = $this->db->get('notification');
                $data= $query->result_array();
                if ($data) {
                    $data=array_slice($data, (int)$page, 10);
                }
            }

            $i=0;
            $orders = array();
            foreach ($data as $item) {
                if ($item['user_id']!=='') {
                    $this->db->select('name');
                    $this->db->where('id', $item['user_id']);
                    $cquery = $this->db->get('users');
                    $company=$cquery->row_array();
                    $data[$i]['full_name']=$company['name'];
                    $i++;
                }
            }
            $orders['table']= $data;

            //count rows
            $this->db->select('id');
            $this->db->where('admin_status', '1');
            $query = $this->db->get('notification');
            $orders['rows']= $query->num_rows();
            return $orders;
        }

        // start production users notification
        public function get_downloader_notification($page)
            {
                $data = array();
                $filter=$this->input->post('filter');
                $id=$this->input->post('id');
                if ($id) {
                    $this->db->select('*');
                    $this->db->like('name', $id);
                    $query = $this->db->get('notification');
                    $data= $query->result_array();
                } else {
                    $this->db->select('*');
                    $this->db->where('production_user', '1');
                    $this->db->where('type', 'downloader');
                    $this->db->order_by('id', 'DESC');
                    $query = $this->db->get('notification');
                    $data= $query->result_array();
                    if ($data) {
                        $data=array_slice($data, (int)$page, 10);
                    }
                }

                $i=0;
                $orders = array();
                // foreach ($data as $item) {
                //     if ($item['user_id']!=='') {
                //         $this->db->select('name');
                //         $this->db->where('id', $item['user_id']);
                //         $cquery = $this->db->get('users');
                //         $company=$cquery->row_array();
                //         $data[$i]['full_name']=$company['name'];
                //         $i++;
                //     }
                // }
                $orders['table']= $data;

                //count rows
                $this->db->select('id');
                $this->db->where('production_user', '1');
                $this->db->where('type', 'downloader');
                $query = $this->db->get('notification');
                $orders['rows']= $query->num_rows();
                return $orders;
            }

            public function get_da_notification($page)
                {
                    $data = array();
                    $filter=$this->input->post('filter');
                    $id=$this->input->post('id');
                    if ($id) {
                        $this->db->select('*');
                        $this->db->like('name', $id);
                        $query = $this->db->get('notification');
                        $data= $query->result_array();
                    } else {
                        $this->db->select('*');
                        $this->db->where('production_user', '1');
                        $this->db->where('type', 'da');
                        $this->db->order_by('id', 'DESC');
                        $query = $this->db->get('notification');
                        $data= $query->result_array();
                        if ($data) {
                            $data=array_slice($data, (int)$page, 10);
                        }
                    }

                    $i=0;
                    $orders = array();

                    $orders['table']= $data;

                    //count rows
                    $this->db->select('id');
                    $this->db->where('production_user', '1');
                    $this->db->where('type', 'da');
                    $query = $this->db->get('notification');
                    $orders['rows']= $query->num_rows();
                    return $orders;
                }

                public function get_fa_notification($page)
                    {
                        $data = array();
                        $filter=$this->input->post('filter');
                        $id=$this->input->post('id');
                        if ($id) {
                            $this->db->select('*');
                            $this->db->like('name', $id);
                            $query = $this->db->get('notification');
                            $data= $query->result_array();
                        } else {
                            $this->db->select('*');
                            $this->db->where('production_user', '1');
                            $this->db->where('type', 'fa');
                            $this->db->order_by('id', 'DESC');
                            $query = $this->db->get('notification');
                            $data= $query->result_array();
                            if ($data) {
                                $data=array_slice($data, (int)$page, 10);
                            }
                        }

                        $i=0;
                        $orders = array();

                        $orders['table']= $data;

                        //count rows
                        $this->db->select('id');
                        $this->db->where('production_user', '1');
                        $this->db->where('type', 'fa');
                        $query = $this->db->get('notification');
                        $orders['rows']= $query->num_rows();
                        return $orders;
                    }
        // end production notificaation
        public function get_paymentData($page)
   {
       $data = array();
       $filter=$this->input->post('filter');
       $id=$this->input->post('id');
       if ($id) {
           $this->db->select('*');
           $this->db->where('city', $id);
           $query = $this->db->get('billing_address');
           $data= $query->result_array();
       } else {
           $this->db->select('*');
         /*  $this->db->where('admin_status', '1');*/
           $this->db->order_by('id', 'DESC');
           $query = $this->db->get('billing_address');
           $data= $query->result_array();
           if ($data) {
               $data=array_slice($data, (int)$page, 10);
           }


       }

       $i=0;
       $orders = array();
       foreach ($data as $item) {
           if ($item['user_id']!=='') {
               $this->db->select('name');
               $this->db->where('id', $item['user_id']);
               $cquery = $this->db->get('users');
               $company=$cquery->row_array();
               $data[$i]['name']=$company['name'];
               $i++;
           }
       }
       $orders['table']= $data;

       //count rows
       $this->db->select('id');
      // $this->db->where('admin_status', '1');
       $query = $this->db->get('billing_address');
       $orders['rows']= $query->num_rows();
       return $orders;
   }
   public function getblogData($page)
   {
       $data = array();
       $filter=$this->input->post('filter');
       $id=$this->input->post('id');
       if ($id) {
           $this->db->select('*');
           $this->db->where('id', $id);
           $query = $this->db->get('blog');
           $data= $query->result_array();
       } else {
           $this->db->select('*');
           $this->db->order_by('id', 'DESC');
           $query = $this->db->get('blog');
           $data= $query->result_array();
           if ($data) {
               $data=array_slice($data, (int)$page, 10);
           }
       }

       $orders['table']= $data;

       //count rows
       $this->db->select('id');
       $query = $this->db->get('blog');
       $orders['rows']= $query->num_rows();
       return $orders;
   }
  // support pagination
  public function get_support($user_id,$page)
      {
          $data = array();
          $filter=$this->input->post('filter');

          $id=$this->input->post('id');
          if ($id) {
              $this->db->select('*');

              $this->db->where('ticket_status', $id);
              $query = $this->db->get('users_support');
              $data= $query->result_array();
          } else {
              $this->db->select('*');
              if (($filter)&&($filter!='all')) {
                if($filter=='open')
                {
                    $this->db->where('ticket_status', '0');
                }
                else{
                  $this->db->where('ticket_status', '1');
                }
          }
              $this->db->where('user_id', $user_id);
              $this->db->order_by('id', 'DESC');
              $query = $this->db->get('users_support');
              $data= $query->result_array();
              if ($data) {
                  $data=array_slice($data, (int)$page, 10);
              }


          }

          $i=0;
          $orders = array();
          foreach ($data as $item) {
              if ($item['product_id']!=='') {
                  $this->db->select('product_name');
                  $this->db->where('id', $item['product_id']);
                  $cquery = $this->db->get('product');
                  $product=$cquery->row_array();
                  $data[$i]['product_name']=$product['product_name'];
                  $i++;
              }
          }

          $orders['table']= $data;

          //count rows
          $this->db->select('*');
          if (($filter)&&($filter!='all')) {
            if($filter=='open')
            {
                $this->db->where('ticket_status', '0');
            }
            else{
              $this->db->where('ticket_status', '1');
            }
        //  $this->db->where('ticket_status', $filter);
      }
          $this->db->where('user_id', $user_id);
          $query = $this->db->get('users_support');
          $orders['rows']= $query->num_rows();
          return $orders;
      }
  //end support pagination

  //admin side pagination support, product_support, contact
  public function admin_getsupport($page)
      {
          $data = array();
          $filter=$this->input->post('filter');
          $id=$this->input->post('id');
          if ($id) {
              $this->db->select('*');
              $this->db->like('name', $id);
              $query = $this->db->get('users_support');
              $data= $query->result_array();
          } else {

              $this->db->select('*');
              //$this->db->where($con);
              $this->db->order_by('id', 'DESC');
              $query = $this->db->get('users_support');
              $data= $query->result_array();
              if ($data) {
                  $data=array_slice($data, (int)$page, 10);
              }


          }

          $i=0;
          $orders = array();
          foreach ($data as $item) {
              if ($item['product_id']!=='') {
                  $this->db->select('product_name');
                  $this->db->where('id', $item['product_id']);
                  $cquery = $this->db->get('product');
                  $product=$cquery->row_array();
                  $data[$i]['product_name']=$product['product_name'];
                  $i++;
              }
          }
          $i=0;
          $orders = array();
          foreach ($data as $item) {
              if ($item['user_id']!=='') {
                  $this->db->select('*');
                  $this->db->where('id', $item['user_id']);
                  $cquery = $this->db->get('users');
                  $product=$cquery->row_array();
                //  $data[$i]['name']=$product['name'];
                  $data[$i]['email']=$product['email'];
                  $i++;
              }
          }
          $orders['table']= $data;
          $this->db->select('*');

        //  $this->db->where($con);
          $query = $this->db->get('users_support');
          $orders['rows']= $query->num_rows();
          return $orders;
      }

       public function admin_getsupport1($page)
      {
          $data = array();
          $filter=$this->input->post('filter');
          $id=$this->input->post('id');
          if ($id) {
              $this->db->select('*');
              $this->db->like('name', $id);
              $query = $this->db->get('users_support');
              $data= $query->result_array();
          } else {

              $this->db->select('*');
              $this->db->where('assign', 1);
              $this->db->order_by('id', 'DESC');
              $query = $this->db->get('users_support');
              $data= $query->result_array();
              if ($data) {
                  $data=array_slice($data, (int)$page, 10);
              }


          }

          $i=0;
          $orders = array();
          foreach ($data as $item) {
              if ($item['product_id']!=='') {
                  $this->db->select('product_name');
                  $this->db->where('id', $item['product_id']);
                  $cquery = $this->db->get('product');
                  $product=$cquery->row_array();
                  $data[$i]['product_name']=$product['product_name'];
                  $i++;
              }
          }
          $i=0;
          $orders = array();
          foreach ($data as $item) {
              if ($item['user_id']!=='') {
                  $this->db->select('*');
                  $this->db->where('id', $item['user_id']);
                  $cquery = $this->db->get('users');
                  $product=$cquery->row_array();
                //  $data[$i]['name']=$product['name'];
                  $data[$i]['email']=$product['email'];
                  $i++;
              }
          }
          $orders['table']= $data;
          $this->db->select('*');

        //  $this->db->where($con);
          $query = $this->db->get('users_support');
          $orders['rows']= $query->num_rows();
          return $orders;
      }
       public function admin_getsupport2($page)
      {
          $data = array();
          $filter=$this->input->post('filter');
          $id=$this->input->post('id');
          if ($id) {
              $this->db->select('*');
              $this->db->like('name', $id);
              $query = $this->db->get('users_support');
              $data= $query->result_array();
          } else {

              $this->db->select('*');
             $this->db->where('assign', 2);
              $this->db->order_by('id', 'DESC');
              $query = $this->db->get('users_support');
              $data= $query->result_array();
              if ($data) {
                  $data=array_slice($data, (int)$page, 10);
              }


          }

          $i=0;
          $orders = array();
          foreach ($data as $item) {
              if ($item['product_id']!=='') {
                  $this->db->select('product_name');
                  $this->db->where('id', $item['product_id']);
                  $cquery = $this->db->get('product');
                  $product=$cquery->row_array();
                  $data[$i]['product_name']=$product['product_name'];
                  $i++;
              }
          }
          $i=0;
          $orders = array();
          foreach ($data as $item) {
              if ($item['user_id']!=='') {
                  $this->db->select('*');
                  $this->db->where('id', $item['user_id']);
                  $cquery = $this->db->get('users');
                  $product=$cquery->row_array();
                //  $data[$i]['name']=$product['name'];
                  $data[$i]['email']=$product['email'];
                  $i++;
              }
          }
          $orders['table']= $data;
          $this->db->select('*');

        //  $this->db->where($con);
          $query = $this->db->get('users_support');
          $orders['rows']= $query->num_rows();
          return $orders;
      }
       public function admin_getsupport3($page)
      {
          $data = array();
          $filter=$this->input->post('filter');
          $id=$this->input->post('id');
          if ($id) {
              $this->db->select('*');
              $this->db->like('name', $id);
              $query = $this->db->get('users_support');
              $data= $query->result_array();
          } else {

              $this->db->select('*');
              $this->db->where('assign', 3);
              $this->db->order_by('id', 'DESC');
              $query = $this->db->get('users_support');
              $data= $query->result_array();
              if ($data) {
                  $data=array_slice($data, (int)$page, 10);
              }


          }

          $i=0;
          $orders = array();
          foreach ($data as $item) {
              if ($item['product_id']!=='') {
                  $this->db->select('product_name');
                  $this->db->where('id', $item['product_id']);
                  $cquery = $this->db->get('product');
                  $product=$cquery->row_array();
                  $data[$i]['product_name']=$product['product_name'];
                  $i++;
              }
          }
          $i=0;
          $orders = array();
          foreach ($data as $item) {
              if ($item['user_id']!=='') {
                  $this->db->select('*');
                  $this->db->where('id', $item['user_id']);
                  $cquery = $this->db->get('users');
                  $product=$cquery->row_array();
                //  $data[$i]['name']=$product['name'];
                  $data[$i]['email']=$product['email'];
                  $i++;
              }
          }
          $orders['table']= $data;
          $this->db->select('*');

        //  $this->db->where($con);
          $query = $this->db->get('users_support');
          $orders['rows']= $query->num_rows();
          return $orders;
      }

      public function admin_getproductsupport($page)
          {
              $data = array();
              $filter=$this->input->post('filter');
              $id=$this->input->post('id');
              if ($id) {
                  $this->db->select('*');
                  $this->db->where('id', $id);
                  $query = $this->db->get('product_support_form');
                  $data= $query->result_array();
              } else {
                  $this->db->select('*');
                //  $this->db->where('user_id', $user_id);
                  $this->db->order_by('id', 'DESC');
                  $query = $this->db->get('product_support_form');
                  $data= $query->result_array();
                  if ($data) {
                      $data=array_slice($data, (int)$page, 10);
                  }


              }

              $i=0;
              $orders = array();
              foreach ($data as $item) {
                  if ($item['product_id']!=='') {
                      $this->db->select('product_name');
                      $this->db->where('id', $item['product_id']);
                      $cquery = $this->db->get('product');
                      $product=$cquery->row_array();
                      $data[$i]['product_name']=$product['product_name'];
                      $i++;
                  }
              }

              $orders['table']= $data;

              //count rows
              $this->db->select('id');
            //  $this->db->where('user_id', $user_id);
              $query = $this->db->get('product_support_form');
              $orders['rows']= $query->num_rows();
              return $orders;
          }
          public function admin_get_contactus($page)
          {
              $data = array();
              $filter=$this->input->post('filter');
              $id=$this->input->post('id');
              if ($id) {
                  $this->db->select('*');
                  $this->db->where('id', $id);
                  $query = $this->db->get('contact');
                  $data= $query->result_array();
              } else {
                  $this->db->select('*');
                  $this->db->order_by('id', 'DESC');
                  $query = $this->db->get('contact');
                  $data= $query->result_array();
                  if ($data) {
                      $data=array_slice($data, (int)$page, 10);
                  }
              }

              $orders['table']= $data;

              //count rows
              $this->db->select('id');
              $query = $this->db->get('contact');
              $orders['rows']= $query->num_rows();
              return $orders;
          }
          public function admin_get_offlinerequest($page)
          {
              $data = array();
              $filter=$this->input->post('filter');
              $id=$this->input->post('id');
              if ($id) {
                  $this->db->select('*');
                  $this->db->where('id', $id);
                  $query = $this->db->get('offline_request');
                  $data= $query->result_array();
              } else {
                  $this->db->select('*');
                  $this->db->order_by('id', 'DESC');
                  $query = $this->db->get('offline_request');
                  $data= $query->result_array();
                  if ($data) {
                      $data=array_slice($data, (int)$page, 10);
                  }
              }

              $orders['table']= $data;

              //count rows
              $this->db->select('id');
              $query = $this->db->get('offline_request');
              $orders['rows']= $query->num_rows();
              return $orders;
          }
          public function admin_walletData($page)
              {
                  $data = array();
                  $filter=$this->input->post('filter');
                  $id=$this->input->post('id');
                  if ($id) {
                      $this->db->select('*');
                      $this->db->where('id', $id);
                      $query = $this->db->get('e_wallet');
                      $data= $query->result_array();
                  } else {
                      $this->db->select('*');
                    //  $this->db->where('status', '1');
                      $this->db->order_by('id', 'DESC');
                      $query = $this->db->get('e_wallet');
                      $data= $query->result_array();
                      if ($data) {
                          $data=array_slice($data, (int)$page, 10);
                      }


                  }

                  $i=0;
                  $orders = array();
                  foreach ($data as $item) {
                      if ($item['user_id']!=='') {
                          $this->db->select('name,id');
                          $this->db->where('id', $item['user_id']);
                          $cquery = $this->db->get('users');
                          $company=$cquery->row_array();
                          $data[$i]['name']=$company['name'];
                          $i++;
                      }
                  }
                  $orders['table']= $data;

                  //count rows
                  $this->db->select('*');
                //  $this->db->where('status', '1');
                  $query = $this->db->get('e_wallet');
                  $orders['rows']= $query->num_rows();
                  return $orders;
              }
//  end admin side pagination support, product_support, contact
}
