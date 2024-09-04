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

class Report_model extends CI_Model {

  public function __construct()
  {
    parent::__construct();
  }

  public function addNotes($id){
        $message = "";

        $data['insert']['note']=$this->input->post('note');
        $data['insert']['tracking_id']=$id;
        $data['update']['note']=$this->input->post('note');
        $this->db->select('*');
        $this->db->where('tracking_id',$id);
        $this->db->limit(1);
        $query = $this->db->get('notes');
        if ($query->num_rows() == 1) {
          $this->db->where('tracking_id',$id);
          $this->db->update('notes', $data['update']);
        }else {
          $this->db->insert('notes', $data['insert']);
        }
        if ($this->db->affected_rows() > 0) {
            $data['message'] = 'Success';
            unset($_POST);
        } else {
            $data['message'] = 'Error';
        }
        return $data;

  }
  public function update($controll,$id){
        $message = "";
        $data['fields'] = $this->db->list_fields('report_'.$controll);
        for ($i = 1; $i < sizeof($data['fields']); $i++) {
            $field = $data['fields'][$i];
            $data['insert'][$field] = $this->input->post($field);
        }
        $data['insert']['tracking_id']=$id;
        $this->db->select('*');
        $this->db->where('tracking_id',$id);
        $this->db->limit(1);
        $query = $this->db->get('report_'.$controll);
        if ($query->num_rows() == 1) {
          $this->db->where('tracking_id',$id);
          $this->db->update('report_'.$controll, $data['insert']);
        }else {
          $this->db->insert('report_'.$controll, $data['insert']);
        }
        if ($this->db->affected_rows() > 0) {
            $message = 'Success';
            unset($_POST);
        } else {
            $message = 'Error';
        }
        return $message;

  }

  public function update_multi($controll,$id){
        $message = "";
        $data['id']=$this->input->post('id[]');
        $data['count']=sizeof($data['id']);
        // $data['count']=2;
        $this->db->select('id');
        $this->db->where('tracking_id',$id);
        $this->db->limit(1);
        $checkquery = $this->db->get('report_'.$controll);
        if ($checkquery->num_rows() > 0) {
          $this->db->where('tracking_id',$id);
          $this->db->delete('report_'.$controll);
        }

        $data['fields'] = $this->db->list_fields('report_'.$controll);
        for ($j=0; $j<$data['count']; $j++) {
          for ($i = 1; $i < sizeof($data['fields']); $i++) {
              $field = $data['fields'][$i];
              $post_field=$field.'['.$j.']';
              $data['insert'][$field] = $this->input->post($post_field);
          }
          $data['insert']['tracking_id']=$id;
          $this->db->select('id');
          $this->db->where('tracking_id',$id);
          $this->db->where('id',$j+1);
          $this->db->limit(1);
          $query = $this->db->get('report_'.$controll);
          if ($query->num_rows() == 0) {
            $this->db->insert('report_'.$controll, $data['insert']);
          }

          // echo json_encode($data['insert']);
        }
        if ($this->db->affected_rows() > 0) {
            $message = 'Success';
            unset($_POST);
        } else {
            $message = 'Error';
        }

        return $message;

  }

  public function getNotesByTrackingId($id){
    $this->db->select('*');
    $this->db->where('tracking_id',$id);
    $this->db->limit(1);
    $query = $this->db->get('notes');
    $data= $query->row_array();
    return $data;
  }
  public function getChartByTrackingId($id){
    $this->db->select('*');
    $this->db->where('tracking_id',$id);
    $this->db->limit(1);
    $query = $this->db->get('charts');
    $data= $query->row_array();
    return $data;
  }


  public function getReportByTrackingId($id){
    $this->db->select('*');
    $this->db->where('tracking_id',$id);
    $query = $this->db->get('report_basic_info');
    $data= $query->row_array();
    return $data;
  }

  public function getOrderTrackingId($id){
    $this->db->select('*');
    $this->db->where('tracking_id',$id);
    $query = $this->db->get('orders');
    $data= $query->row_array();
    return $data;
  }

  public function getfinancial_highlights($id){
    $this->db->select('*');
    $this->db->where('tracking_id',$id);
    $query = $this->db->get('report_financial_highlight');
    $data= $query->row_array();
    return $data;
  }
   public function getexpense_detail($id){
    $this->db->select('*');
    $this->db->where('tracking_id',$id);
    $query = $this->db->get('report_expense_details');
    $data= $query->row_array();
    return $data;
  }
   public function getshare_holder_pattern($id){
    $this->db->select('*');
    $this->db->where('tracking_id',$id);
    $query = $this->db->get('report_share_pattern');
    $data= $query->result_array();
    return $data;
  }
  public function getbalance_sheets($id){
    $this->db->select('*');
    $this->db->where('tracking_id',$id);
    $query = $this->db->get('report_balance_sheets');
    $data= $query->result_array();
    return $data;
  }
   public function getdetail_assets($id){
    $this->db->select('*');
    $this->db->where('tracking_id',$id);
    $query = $this->db->get('report_detail_assets');
    $data= $query->row_array();
    return $data;
  }
   public function getdetail_liabilities($id){
    $this->db->select('*');
    $this->db->where('tracking_id',$id);
    $query = $this->db->get('report_detail_liabilities');
    $data= $query->row_array();
    return $data;
  }
   public function getcontact_form($id){
    $this->db->select('*');
    $this->db->where('tracking_id',$id);
    $query = $this->db->get('report_contact_form');
    $data= $query->row_array();
    return $data;
  }
  public function getproducts_and_services($id){
    $this->db->select('*');
    $this->db->where('tracking_id',$id);
    $query = $this->db->get('report_products_and_services');
    $data= $query->result_array();
    return $data;
  }
   public function getactivity($id){
    $this->db->select('*');
    $this->db->where('tracking_id',$id);
    $query = $this->db->get('report_activity');
    $data= $query->result_array();
    return $data;
  }
  public function getcompany_hierarchy($id){
    $this->db->select('*');
    $this->db->where('tracking_id',$id);
    $query = $this->db->get('report_company_hierarchy');
    $data= $query->result_array();
    return $data;
  }
 public function gethistory($id){
    $this->db->select('*');
    $this->db->where('tracking_id',$id);
    $query = $this->db->get('report_history');
    $data= $query->result_array();
    return $data;
  }
  public function getcurrent_auditor($id){
    $this->db->select('*');
    $this->db->where('tracking_id',$id);
    $query = $this->db->get('report_current_auditor');
    $data= $query->result_array();
    return $data;
  }
   public function getcapital_structure($id){
    $this->db->select('*');
    $this->db->where('tracking_id',$id);
    $query = $this->db->get('report_capital_structure');
    $data= $query->result_array();
    return $data;
  }
  public function getcapital_structure_history($id){
    $this->db->select('*');
    $this->db->where('tracking_id',$id);
    $query = $this->db->get('report_capital_struc_history');
    $data= $query->result_array();
    return $data;
  }
   public function getshare_holder_percetange($id){
    $this->db->select('*');
    $this->db->where('tracking_id',$id);
    $query = $this->db->get('report_share_holder_percetange');
    $data= $query->result_array();
    return $data;
  }
  public function getprofit_and_loss($id){
    $this->db->select('*');
    $this->db->where('tracking_id',$id);
    $query = $this->db->get('report_profit_and_loss');
    $data= $query->result_array();
    return $data;
  }
  public function getcash_flow_direct($id){
    $this->db->select('*');
    $this->db->where('tracking_id',$id);
    $query = $this->db->get('report_cash_flow_direct');
    $data= $query->result_array();
    return $data;
  }
  public function getcash_flow_indirect($id){
    $this->db->select('*');
    $this->db->where('tracking_id',$id);
    $query = $this->db->get('report_cash_flow_indirect');
    $data= $query->result_array();
    return $data;
  }
  public function gettopten_share($id){
    $this->db->select('*');
    $this->db->where('tracking_id',$id);
    $query = $this->db->get('report_topten_share');
    $data= $query->result_array();
    return $data;
  }
   public function getequity_holder($id){
    $this->db->select('*');
    $this->db->where('tracking_id',$id);
    $query = $this->db->get('report_equity_holder');
    $data= $query->result_array();
    return $data;
  }
   public function get_certificate($id){
    $this->db->select('*');
    $this->db->where('tracking_id',$id);
    $query = $this->db->get('report_certificate');
    $data= $query->result_array();
    return $data;
  }
   public function getarticle_association($id){
    $this->db->select('*');
    $this->db->where('tracking_id',$id);
    $query = $this->db->get('report_article_association');
    $data= $query->result_array();
    return $data;
  }
   public function getevent_timeline($id){
    $this->db->select('*');
    $this->db->where('tracking_id',$id);
    $query = $this->db->get('report_event_timeline');
    $data= $query->result_array();
    return $data;
  }
  public function getpost_director_detail($id){
    $this->db->select('*');
    $this->db->where('tracking_id',$id);
    $query = $this->db->get('report_past_director_detail');
    $data= $query->result_array();
    return $data;
  }

}
