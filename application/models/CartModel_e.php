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

class CartModel_e extends CI_Model {

  public function __construct()
  {
    parent::__construct();
    

  }

  public function addToCart($cin,$companyName,$customerEmail,$cart_status)
  {

    $companyName = str_replace('-',' ',$companyName);
    $this->db->select('items,user_id');
    $this->db->where('items',$cin);
    $this->db->where('category',$cart_status);
    $this->db->where('status','cart');
    $this->db->where('user_id',$_SESSION['auth_user']);
    $query = $this->db->get('orders');
    $rowCount = $query->num_rows();
    if(!$rowCount)
    {

    $all_cost=$this->admin->getProductByName($cart_status);

    // var_dump($all_cost);die();

    $inrCost=$all_cost[0]['inr_price'];
    $ucsCost=$all_cost[0]['usd_price'];
    // return ($cin.','.$cart_status.','.$companyName.','.$inrCost.','.$ucsCost.'nananan');exit;
 
      $insertData =array(
        'items'=>$cin,
        // 'tracking_id'=>$tracking_id,
        'country_code'=>'IN',
        // 'alerts'=>$alerts,
        'user_id'=>$customerEmail,
        'cost'=>$inrCost,
        'usd_cost'=>$ucsCost,
        'category'=>$cart_status,
        'name'=>$companyName,
        'status'=>'cart',
        'production_status'=>'In Progress',
        'product_status'=>'In Progress',
        'date'=>date("Y-m-d H:i:s"),
        'comment'=>'New Order',
      );
      $res = $this->db->insert('orders', $insertData);


      if($res)
      {
        return 'inserted';
      }
      else
      {
        return 'not-inserted';
      }
    }
    else
    {
      return 'already_exist';
    }
    
  }

  public function cart_item()
  {
    $this->db->select('name');
    $this->db->where('user_id',$_SESSION['auth_user']);
    $this->db->where('status','cart');
    $this->db->or_where('status','track_company');
    
    $query = $this->db->get('orders');
    return $query->num_rows();
  }

  public function checkOutAllItem($checkOutData)
  {

    $res = '';
    foreach($checkOutData  as $key=>$val)
    {
      $cin = filter_var($val['cin'],FILTER_SANITIZE_STRING);
      $cart_status = filter_var($val['category'],FILTER_SANITIZE_STRING);
      $companyName = filter_var($val['name'],FILTER_SANITIZE_STRING);
      $companyName = str_replace('-',' ',$companyName);
      $this->db->select('items,user_id');
      $this->db->where('items',$cin);
      $this->db->where('category',$cart_status);
      $this->db->where('user_id',$_SESSION['auth_user']);
      $query = $this->db->get('orders');
      $rowCount = $query->num_rows();
      if(!$rowCount)
      {
        $all_cost=$this->admin->getProductByName($cart_status);

        // var_dump($all_cost);die();

        $inrCost=$all_cost[0]['inr_price'];
        $ucsCost=$all_cost[0]['usd_price'];
        // return ($cin.','.$cart_status.','.$companyName.','.$inrCost.','.$ucsCost);exit;
        $insertData =array(
          'items'=>$cin,
          // 'tracking_id'=>$tracking_id,
          'country_code'=>'IN',
          // 'alerts'=>$alerts,
          'user_id'=>$_SESSION['auth_user'],
          'cost'=>$inrCost,
          'usd_cost'=>$ucsCost,
          'category'=>$cart_status,
          'name'=>$companyName,
          'status'=>'cart',
          'production_status'=>'In Progress',
          'product_status'=>'In Progress',
          'date'=>date("Y-m-d H:i:s"),
          'comment'=>'New Order',
        );
        $res = $this->db->insert('orders', $insertData);
        
      }
          
    }
    if($res)
    {
      return 'inserted';
    }
    else
    {
      return 'not-inserted';
    }
  }
}