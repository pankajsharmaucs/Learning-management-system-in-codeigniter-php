<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model Authentication

 * @package		UCS
 * @category	Model
 * @param     ...
 * @return    ...
 *
 */

class Cart_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getUserCartCount($id)
    {
        $this->db->select('*');
        $this->db->where('user_id', $id);
        $this->db->where('status', 'cart');
        $query = $this->db->get('orders');
        if ($query->num_rows()>0) {
            return $query->num_rows();
        }
    }

    public function getUserOrdersCount($id)
    {
        $this->db->select('*');
        $this->db->where('user_id', $id);
        $this->db->where('status', 'paid');
        $query = $this->db->get('orders');
        if ($query->num_rows()>0) {
            return $query->num_rows();
        }
    }

    public function getUserCart($con)
    {
        // $this->db->select('*');
        // $this->db->where('user_id', $id);
        // $this->db->where('status', 'cart');
        // $this->db->order_by('id','DESC');
        // $query = $this->db->get('orders');
        //
        // $data= $query->result_array();
        // return $data;
        $this->db->select('o.*,c.name as country_name');
        $this->db->from('orders o');
        $this->db->join('countries c',"c.sortname = o.country_code","left");
       // $this->db->join('company co',"co.cin = o.items","left");
        $this->db->where($con);
        $this->db->order_by('o.id','DESC');
        return $this->db->get()->result_array();
    }

    public function getUserOrders($id)
    {
        $this->db->select('*');
        $this->db->where('user_id', $id);
        $this->db->where('status', 'paid');
         $this->db->order_by('id','DESC');
        $query = $this->db->get('orders');
        $data= $query->result_array();
        return $data;
    }

    public function getOrders()
    {
        $this->db->select('*');
        // $this->db->where('category','Full Company Report');
        $this->db->where('status', 'paid');
        $query = $this->db->get('orders');
        $data= $query->result_array();
        $i=0;
        foreach ($data as $item) {
            // if($item['category']=='Full Company Report'){
            if ($item['items']!=='') {
                $this->db->select('name');
                $this->db->where('cin', $item['items']);
                $cquery = $this->db->get('company');
                $company=$cquery->row_array();
                $data[$i]['company_name']=$company['name'];
                $i++;
            }
            // }
        }
        return $data;
    }
    public function get_orderdetails($con)
    {
        $this->db->select('o.*,u.country_id,c.name as company_name');
        $this->db->from('orders o');
        $this->db->join('users u',"u.id = o.user_id","left");
        $this->db->join('company c',"c.cin = o.items","left");
        $this->db->where($con);
        $this->db->order_by('o.id','DESC');
        return $this->db->get()->result_array();
    }
    public function getDetailedReportOrders()
    {
        $this->db->select('*');
        $this->db->where('category', 'Full Company Report');
        $this->db->where('status', 'paid');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('orders');
        $data= $query->result_array();
        $i=0;
        foreach ($data as $item) {
            // if($item['category']=='Full Company Report'){
            if ($item['items']!=='') {
                $this->db->select('name');
                $this->db->where('cin', $item['items']);
                $cquery = $this->db->get('company');
                $company=$cquery->row_array();
                $data[$i]['company_name']=$company['name'];
                $i++;
            }
            // }
        }
        return $data;
    }

    public function getDetailedReportOrdersForPU($PU)
    {
      $data = array();
      $this->db->select('*');
      $this->db->where('user_id', $PU);
      $this->db->order_by('id', 'DESC');
      $PUquery = $this->db->get('task');
      if($PUquery->num_rows()>0){
        $Tasks=$PUquery->result_array();
        foreach ($Tasks as $item) {
          $this->db->select('*');
          $this->db->where('tracking_id', $item['task_id']);
          $query = $this->db->get('orders');
          if($query->num_rows()>0){
            $data[]=$query->row_array();
          }

        }
      }

      return $data;
    }

    public function getOrderById($id)
    {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('orders');
        $data= $query->row_array();
        return $data;
    }
    function get_invoice($cond)
    {
        $this->db->select('or.*,ba.merchant_order_id,ba.total_amount,ba.country');
        $this->db->from('orders or');
        $this->db->join('billing_address ba',"ba.id = or.billing_id","left");
        $this->db->where($cond);
       // $this->db->order_by('or.id','DESC');
        return $this->db->get()->row_array();
    }
    public function getReportById($id)
    {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('report');
        $data= $query->row_array();
        return $data;
    }

    public function getReportByTrackingId($id)
    {
        $this->db->select('*');
        $this->db->where('tracking_id', $id);
        $query = $this->db->get('report_basic_info');
        $data= $query->row_array();
        return $data;
    }

    public function sendToDa()
    {
        $comment="";
        $data['xbrlfile']=null;
        $data['pdf_file']=null;
        $id=$this->input->post('id');
        $data['id']=$id;
        $data['datatype']=$this->input->post('datatype');
        $datatype=$data['datatype'];
        $filetype=$this->input->post('filetype');
        if ($filetype=="xbrl") {
            if (@($_FILES['xbrl']['name'])) {
                $files = $_FILES;
                $cpt = count($_FILES ['xbrl'] ['name']);

                for ($i = 0; $i < $cpt; $i ++) {
                    $name = urlencode($files ['xbrl'] ['name'] [$i]);
                    $data['xbrlfile'][$i]=$name;
                    $_FILES ['xbrl'] ['name'] = $name;
                    $_FILES ['xbrl'] ['type'] = $files ['xbrl'] ['type'] [$i];
                    $_FILES ['xbrl'] ['tmp_name'] = $files ['xbrl'] ['tmp_name'] [$i];
                    $_FILES ['xbrl'] ['error'] = $files ['xbrl'] ['error'] [$i];
                    $_FILES ['xbrl'] ['size'] = $files ['xbrl'] ['size'] [$i];

                    if (!is_dir('./upload/xbrl/'.$id.'/')) {
                        mkdir('./upload/xbrl/'.$id, 0777, true);
                    }
                    $config['upload_path'] = './upload/xbrl/'.$id.'/';
                    $config['allowed_types'] = 'xml';
                    $config['max_size'] = 10000;
                    $config['overwrite'] = true;
                    //Load upload library

                    $this->load->library('upload', $config);
                    if (!($this->upload->do_upload('xbrl')) || $files ['xbrl'] ['error'] [$i] !=0) {
                        // print_r($this->upload->display_errors());
                        $data['message']['file']="Error";
                    } else {
                        // $this->load->model('uploadModel','um');
                        // $this->um->insertRecord($user,$name);
                        $data['message']['file']="Uploaded";
                    }
                }
            }
        }
        if ($filetype=="pdf") {
            if (@($_FILES['pdf']['name'])) {
                $files = $_FILES;
                $cpt = count($_FILES ['pdf'] ['name']);

                for ($i = 0; $i < $cpt; $i ++) {
                    $data['pdf_file'][$i]=$name;
                    $name = urlencode($files ['pdf'] ['name'] [$i]);
                    $data['pdf_file'][$i]=$name;
                    $_FILES ['pdf'] ['name'] = $name;
                    $_FILES ['pdf'] ['type'] = $files ['pdf'] ['type'] [$i];
                    $_FILES ['pdf'] ['tmp_name'] = $files ['pdf'] ['tmp_name'] [$i];
                    $_FILES ['pdf'] ['error'] = $files ['pdf'] ['error'] [$i];
                    $_FILES ['pdf'] ['size'] = $files ['pdf'] ['size'] [$i];

                    if (!is_dir('./upload/pdf/'.$id.'/')) {
                        mkdir('./upload/pdf/'.$id, 0777, true);
                    }
                    $config['upload_path'] = './upload/pdf/'.$id.'/';
                    $config['allowed_types'] = 'pdf';
                    $config['max_size'] = 10000;
                    $config['overwrite'] = true;
                    //Load upload library

                    $this->load->library('upload', $config);
                    if (!($this->upload->do_upload('pdf')) || $files ['pdf'] ['error'] [$i] !=0) {
                        // print_r($this->upload->display_errors());
                        $data['message']['file']="Error";
                    } else {
                        // $this->load->model('uploadModel','um');
                        // $this->um->insertRecord($user,$name);
                        $data['message']['file']="Uploaded";
                    }
                }
            }
        }


        if (@$datatype=="c") {
            $comment='Request Data Analyst for Manual Report';
        }

        $data['update'] = array(
      'assigned' => 'DA',
      'msg' => $comment,
      'comment'=>'Completed  <p>& Sent to DA</p>',
      'production_status'=>"inprogress",
      'da'=>'new',
      'fa'=>'',
      'downloader'=>'completed',
      'admin'=>'',
      'xbrlfile'=>json_encode($data['xbrlfile']),
      'pdf_file'=>json_encode($data['pdf_file']),
     );
        $this->db->where('tracking_id', $id);
        $this->db->update('orders', $data['update']);
        if ($this->db->affected_rows()) {
            $data['message']['status']='Success';
        } else {
            $data['message']['status']='Error';
        }
        $data['insert'] = array(
      'tracking_id' => $id,
     );
        // $this->db->insert('report', $data['insert']);
        return $data['message'];
    }

    public function sendToFA($id)
    {

      $this->db->select('*');
      $query = $this->db->get('admin');
      $pusers= $query->result_array();
      $rolls=  array();
      $downloaders=array();
      foreach ($pusers as $puser) {
        $rolls=json_decode($puser['assign_to']);
        if (in_array("Downloader", $rolls))
        {

          $this->db->select('*');
          $this->db->where('user_id',$puser['id']);
          $this->db->where('roll','FA');
          $dquery = $this->db->get('task');
          $downloaders[$puser['id']]=$dquery->num_rows();
        }
      }

      $downloader_index = array_search(min($downloaders), $downloaders);
      $insert_Task =array(
        'user_id'=>$downloader_index,
       'task_id'=>$id,
       'type'=>'Full Company Report',
        'status'=>'Active',
        'roll'=>"FA"
       );
       $this->db->insert('task', $insert_Task);
       // echo json_encode($insert_Task);
       // exit;
        $message='';

        $data['update'] = array(
      'assigned' => 'FA',
      'comment'=>'Completed  <p>& Sent to FA</p>',
      'da'=>'completed',
      'fa'=>'new',
      'downloader'=>'completed',
     );
        $this->db->where('tracking_id', $id);
        $this->db->update('orders', $data['update']);
        if ($this->db->affected_rows()) {
            $message='Success';
        } else {
            $message='Error';
        }
        return $message;
    }
    public function sendToUser($id)
    {
      $message='';

      $data['update'] = array(
      'assigned' => 'User',
      'comment'=>'Completed  <p>& Sent to User</p>',
      'da'=>'completed',
      'fa'=>'completed',
      'downloader'=>'completed',
      'product_status'=>'completed',
      'production_status'=>'completed',
     );
        $this->db->where('tracking_id', $id);
        $this->db->update('orders', $data['update']);
        if ($this->db->affected_rows()) {
            $message='Success';
        } else {
            $message='Error';
        }
        return $message;
    }
    public function returnToDL($id)
    {
        $message='';

        $data['update'] = array(
      'assigned' => 'downloader',
      'comment'=>'Returned  <p>From DA</p>',
      'da'=>'',
      'fa'=>'',
      'downloader'=>'returned',
     );
        $this->db->where('tracking_id', $id);
        $this->db->update('orders', $data['update']);
        if ($this->db->affected_rows()) {
            $message='Success';
        } else {
            $message='Error';
        }
        return $message;
    }
    public function returnToDA($id)
    {
        $message='';

        $data['update'] = array(
      'assigned' => 'fa',
      'comment'=>'Returned  <p>From FA</p>',
      'da'=>'returned',
      'fa'=>'',
      'downloader'=>'',
     );
        $this->db->where('tracking_id', $id);
        $this->db->update('orders', $data['update']);
        if ($this->db->affected_rows()) {
            $message='Success';
        } else {
            $message='Error';
        }
        return $message;
    }

    public function getListByOrderId($id)
    {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('orders');
        $data= $query->row_array();
        // echo json_encode($data);
        $items=json_decode($data['items']);

        if ($data['category']=="recent incorporation") {
            $this->db->select('*');
            $this->db->where_in('class', $items->class);
            $this->db->where_in('activity', $items->activity);
            if ($items->cities) {
                $this->db->where_in('roc', $items->cities);
            }

            if ($items->minPUC!='') {
                $this->db->where('paidUpCaiptal >=', (int)$items->minPUC);
            }
            if ($items->maxPUC!='') {
                $this->db->where('paidUpCaiptal <=', (int)$items->maxPUC);
            }
            if (($items->startDate!='')&&($items->endDate!='')) {
                $startDate = DateTime::createFromFormat('m/d/Y', $items->startDate);
                $startDate=$startDate->format('Y-m-d');
                $endDate = DateTime::createFromFormat('m/d/Y', $items->endDate);
                $endDate=$endDate->format('Y-m-d');
                $this->db->where('dateofincorporation BETWEEN "'. date('Y-m-d', strtotime($startDate)). '" and "'. date('Y-m-d', strtotime($endDate)).'"');
            }


            $this->db->limit((int)$data['alerts']);
            $cquery = $this->db->get('company');
            $data['list']=$cquery->result_array();
            // $data['list'][0]['rows']=$cquery->num_rows();
            return $data['list'];
        } else {
            return null;
        }
    }


    public function checkout($user, $id)
        {
          // $get_orders=$this->Common_model->GetData('orders','',"category='Track a Company' or category='recent incorporation'
          // or category='new incorporation'","","","","1");
          //
          // if($get_orders->category=='Track a Company')
          // {
          //   $data['update'] = array(
          //   'status'=>'paid',
          //   'da'=>'',
          //   'fa'=>'',
          //   'downloader'=>'new',
          //   'admin'=>'new',
          //   'assigned' => 'downloader',
          //   'product_status' => 'completed',
          //   );
          // }
          // else{
            $data['update'] = array(
            'status'=>'paid',
            'da'=>'',
            'fa'=>'',
            'downloader'=>'new',
            'admin'=>'new',
            'assigned' => 'downloader',
            //'product_status' => 'In Progress',
            );
          // }


          $this->db->select('*');
          $this->db->where('tracking_id', $id);
          $this->db->where('category', 'Existing Report');
          $query=$this->db->get('orders');
          if ($query->num_rows()>0) {
            $data['update']['assigned'] = 'User';
            $data['update']['comment'] = 'Completed  <p>& Sent to User</p>';
            $data['update']['da'] = 'completed';
            $data['update']['fa'] = 'completed';
            $data['update']['downloader'] = 'completed';
            $data['update']['product_status'] = 'completed';
            $data['update']['production_status'] = 'completed';
          }
          // amit new incor Completed
          // $this->db->select('*');
          // $this->db->where('tracking_id', $id);
          // $this->db->where('category', 'Track a Company');
          // $this->db->or_where('category', 'recent incorporation');
          // $this->db->or_where('category', 'new incorporation');
          // $query=$this->db->get('orders');
          // if ($query->num_rows()>0) {
          //   $data['update']['product_status'] = 'completed';
          // //  $data['update']['production_status'] = 'completed';
          // }

          //end amit

        $this->db->where('tracking_id', $id);
        $this->db->where('user_id', $user);
      //  $this->db->where('category','Track a Company');
        $this->db->update('orders', $data['update']);
      //  print_r($this->db->last_query()); exit();
        if ($this->db->affected_rows()) {
            $message='Success';
        } else {
            $message='Error';
        }
        return $message;
    }

    public function recent_incorppration($id)
    {
        $message = "";
        $data=array();
        $activityCount=(int)$this->input->post('activityCount');
        $classCount=(int)$this->input->post('classCount');
        $citiesCount=(int)$this->input->post('cityCount');
        $minPUC=$this->input->post('minPUC');
        $maxPUC=$this->input->post('maxPUC');
        $startDate=$this->input->post('startDate');
        $category=$this->input->post('category');
        $endDate=$this->input->post('endDate');
        $alerts=(int)$this->input->post('alerts');
        $cost=$alerts*25;
        $data['class']=[];
        $data['cities']=[];
        $data['activity']=[];

        for ($i=1; $i <$activityCount; $i++) {
            $activity= $this->input->post('activity_'.$i);
            if ($activity) {
                $data['activity'][]=$activity;
            }
        }
        for ($i=1; $i <$classCount; $i++) {
            $class= $this->input->post('class_'.$i);
            if ($class) {
                $data['class'][]=$class;
            }
        }


        for ($i=0; $i<=$citiesCount; $i++) {
            $cities= $this->input->post('city_'.$i);
            if ($cities) {
                $data['cities'][]=$cities;
            }
        }

        if ($maxPUC) {
            $data['maxPUC']=$maxPUC;
        } else {
            $data['maxPUC']="";
        }
        if ($minPUC) {
            $data['minPUC']=$minPUC;
        } else {
            $data['minPUC']="";
        }
        if ($startDate) {
            $data['startDate']=$startDate;
        }
        if ($endDate) {
            $data['endDate']=$endDate;
        }

        $this->load->helper('string');
        $tracking_id=random_string('alnum', 10);

        $insert =array(
           'items'=>json_encode($data),
           'tracking_id'=>$tracking_id,
            'country_code'=>'IN',
           'alerts'=>$alerts,
           'user_id'=>$id,
           'cost'=>$cost,
           'category'=>$category,
           'status'=>'cart',
           'production_status'=>'new',
           'product_status'=>'In Progress',
           'date'=>date("Y-m-d H:i:s"),
           'comment'=>'New Order  <p>from User</p>',
         );
        $this->db->insert('orders', $insert);
        if ($this->db->affected_rows()) {
            $message='Success';
        } else {
            $message='Error';
        }

        return $message;
    }


    public function full_report($id, $cin,$name,$get_product,$get_creditvalue,$type)
    {
        $message = "";
        $data=array();
        if($type=='postpaid'){
        $cost=$get_product->inr_price;
        $usd_cost=$get_product->usd_price;
        }else{
        $cost=$get_product->inr_price/$get_creditvalue->creditsvalue;
        $usd_cost=$get_product->usd_price/$get_creditvalue->usdcreditsvalue;
        }
        $this->load->helper('string');
        $tracking_id=random_string('alnum', 10);


        $this->db->select('*');
        $query = $this->db->get('admin');
        $pusers= $query->result_array();
        $rolls=  array();
        $downloaders=array();
        foreach ($pusers as $puser) {
          $rolls=json_decode($puser['assign_to']);
          if (in_array("Downloader", $rolls))
          {

            $this->db->select('*');
            $this->db->where('user_id',$puser['id']);
            $this->db->where('roll','downloader');
            $dquery = $this->db->get('task');
            $downloaders[$puser['id']]=$dquery->num_rows();
          }
        }

        $downloader_index = array_search(min($downloaders), $downloaders);
        $insert_Task =array(
          'user_id'=>$downloader_index,
         'task_id'=>$tracking_id,
         'type'=>'Full Company Report',
          'status'=>'Active',
          'roll'=>"Downloader"
         );
         $this->db->insert('task', $insert_Task);
         // echo json_encode($insert_Task);
         // exit;



        $insert =array(
           'items'=>$cin,
           'name'=>$name,
            'country_code'=>'IN',
           'tracking_id'=>$tracking_id,
           'user_id'=>$id,
           'cost'=>$cost,
           'usd_cost'=>$usd_cost,
           'category'=>'Full Company Report',
           'status'=>'cart',
           'production_status'=>'new',
           'comment'=>'New Order  <p>from User</p>',
           'assigned'=>'downloader',
           'date'=>date("Y-m-d H:i:s"),
           'product_status'=>'In Progress',
         );
        $this->db->insert('orders', $insert);
        if ($this->db->affected_rows()) {
            $message='Success';

        } else {
            $message='Error';
        }

        return $message;
    }

  public function full_report1($id, $cin,$name,$country,$get_product,$get_creditvalue)
    {
        $message = "";
        $data=array();
        $cost=$get_product->inr_price/$get_creditvalue->creditsvalue;
        $usd_cost=$get_product->usd_price/$get_creditvalue->usdcreditsvalue;
        $this->load->helper('string');
        $tracking_id=random_string('alnum', 10);
        $insert =array(
           'items'=>$cin,
           'name'=>$name,
            'country_code'=>$country,
           'tracking_id'=>$tracking_id,
           'user_id'=>$id,
           'cost'=>$cost,
           'usd_cost'=>$usd_cost,
           'category'=>'Full Company Report',
           'status'=>'cart',
           'production_status'=>'new',
           'comment'=>'New Order  <p>from User</p>',
           'assigned'=>'downloader',
           'date'=>date("Y-m-d H:i:s"),
           'product_status'=>'In Progress',
         );
        $this->db->insert('orders', $insert);
       $insert_id= $this->db->insert_id();
        $json = @file_get_contents('https://centralwebservice.azurewebsites.net/ConsumeAPIData.asmx/FreshReportRequest?RequestFrom=2&CountryCode=GB&CompanyID='.$cin);

  $obj = @json_decode($json,true);
        if ($this->db->affected_rows()) {
          $update = array(
      'URN' =>  $obj,
     );
        $this->db->where('tracking_id', $tracking_id);
        $this->db->update('orders', $update);
            $message='Success';
            // $task = array(
            //    'task_id'=>$tracking_id,
            //    'user_id'=>$downloader_index,
            //    'type'=>'Full Company Report',
            //    'roll'=>'Downloader',
            //    'status'=>'active',
            //  );
            //  $this->db->insert('task', $task);
        } else {
            $message='Error';
        }

        return $message;
    }

    public function doc($id, $cin,$name,$date,$get_product,$get_creditvalue)
    {
        $message = "";
        $data=array();
        $cost=$get_product->inr_price/$get_creditvalue->creditsvalue;
        $usd_cost=$get_product->usd_price/$get_creditvalue->usdcreditsvalue;
        $this->load->helper('string');
        $tracking_id=random_string('alnum', 10);
        $insert =array(
          'items'=>$cin,
          'name'=>$name,
          'country_code'=>'IN',
          'tracking_id'=>$tracking_id,
          'user_id'=>$id,
          'cost'=>$cost,
          'usd_cost'=>$usd_cost,
          'category'=>'Documents',
          'status'=>'cart',
          'production_status'=>'new',
          'comment'=>'New Order  <p>from User</p>',
          'assigned'=>'downloader',
          'date'=>date("Y-m-d H:i:s"),
          'document_date'=>date('Y-m-d',strtotime($date)),
          'product_status'=>'In Progress',
         );
        $this->db->insert('orders', $insert);
        if ($this->db->affected_rows()) {
            $message='Success';
        } else {
            $message='Error';
        }

        return $message;
    }

    // all document amit
    public function all_document($id,$cin,$name,$get_product,$get_creditvalue)
    {
        $message = "";
        $data=array();
        $cost=$get_product->inr_price/$get_creditvalue->creditsvalue;
        $usd_cost=$get_product->usd_price/$get_creditvalue->usdcreditsvalue;
        $this->load->helper('string');
        $tracking_id=random_string('alnum', 10);
        $insert =array(
          'items'=>$cin,
          'name'=>$name,
           'country_code'=>'IN',
          'tracking_id'=>$tracking_id,
          'user_id'=>$id,
          'cost'=>$cost,
         'usd_cost'=>$usd_cost,
          'category'=>'All Documents',
          'status'=>'cart',
          'production_status'=>'new',
          'comment'=>'New Order  <p>from User</p>',
          'assigned'=>'downloader',
          'date'=>date("Y-m-d H:i:s"),
          'product_status'=>'In Progress',
         );
        $this->db->insert('orders', $insert);
        if ($this->db->affected_rows()) {
            $message='Success';
        } else {
            $message='Error';
        }

        return $message;
    }
    // end all document amit


    // buy report amit
    public function buy_report($id, $cin,$name,$country,$get_product,$get_creditvalue)
    {
        $message = "";
        $data=array();
        // $name=$this->input->get('name');
       $name= $this->input->get_post('name');
            // $name=$this->input->post('name');
            $country=$this->input->get_post('country');

        $cost=$get_product->inr_price/$get_creditvalue->creditsvalue;
        $usd_cost=$get_product->usd_price/$get_creditvalue->usdcreditsvalue;
        $this->load->helper('string');
        $tracking_id=random_string('alnum', 10);

        $this->db->select('*');
        $query = $this->db->get('admin');
        $pusers= $query->result_array();
        $rolls=  array();
        $downloaders=array();
        foreach ($pusers as $puser) {
          $rolls=json_decode($puser['assign_to']);
          if (in_array("Downloader", $rolls))
          {

            $this->db->select('*');
            $this->db->where('user_id',$puser['id']);
            $this->db->where('roll','downloader');
            $dquery = $this->db->get('task');
            $downloaders[$puser['id']]=$dquery->num_rows();
          }
        }

        $downloader_index = array_search(min($downloaders), $downloaders);
        $insert_Task =array(
          'user_id'=>$downloader_index,
         'task_id'=>$tracking_id,
         'type'=>'Full Company Report',
          'status'=>'Active',
          'roll'=>"downloader"
         );
         $this->db->insert('task', $insert_Task);


        $insert =array(
          'items'=>$cin,
         'name'=>$name,
         'country_code'=>$country,
          'tracking_id'=>$tracking_id,
          'user_id'=>$id,
          'cost'=>$cost,
          'usd_cost'=>$usd_cost,
          'category'=>'Existing Report',
          'status'=>'cart',
          'production_status'=>'new',
          'comment'=>'New Order  <p>from User</p>',
          'assigned'=>'downloader',
          'date'=>date("Y-m-d H:i:s"),
          'product_status'=>'completed',
         );
        $this->db->insert('orders', $insert);
        if ($this->db->affected_rows()) {
            $message='Success';
        } else {
            $message='Error';
        }

        return $message;
    }

      public function buy_report1($id, $cin,$name,$country,$get_product,$get_creditvalue)
    {
        $message = "";
        $data=array();
       // $name=$this->input->get('name');
       $cost=$get_product->inr_price/$get_creditvalue->creditsvalue;
       $usd_cost=$get_product->usd_price/$get_creditvalue->usdcreditsvalue;
        $this->load->helper('string');
        $tracking_id=random_string('alnum', 10);

        $this->db->select('*');
        $query = $this->db->get('admin');
        $pusers= $query->result_array();
        $rolls=  array();
        $downloaders=array();
        foreach ($pusers as $puser) {
          $rolls=json_decode($puser['assign_to']);
          if (in_array("Downloader", $rolls))
          {

            $this->db->select('*');
            $this->db->where('user_id',$puser['id']);
            $this->db->where('roll','downloader');
            $dquery = $this->db->get('task');
            $downloaders[$puser['id']]=$dquery->num_rows();
          }
        }

        $downloader_index = array_search(min($downloaders), $downloaders);
        $insert_Task =array(
          'user_id'=>$downloader_index,
         'task_id'=>$tracking_id,
         'type'=>'Full Company Report',
          'status'=>'Active',
          'roll'=>"downloader"
         );
         $this->db->insert('task', $insert_Task);


        $insert =array(
          'items'=>$cin,
          'name'=>$name,
          'country_code'=>$country,
          'tracking_id'=>$tracking_id,
          'user_id'=>$id,
          'cost'=>$cost,
          'usd_cost'=>$usd_cost,
          'category'=>'Existing Report',
          'status'=>'cart',
          'production_status'=>'new',
          'comment'=>'New Order  <p>from User</p>',
          'assigned'=>'downloader',
          'date'=>date("Y-m-d H:i:s"),
          'product_status'=>'completed',
         );
        $this->db->insert('orders', $insert);
        if ($this->db->affected_rows()) {
            $message='Success';
        } else {
            $message='Error';
        }

        return $message;
    }
    //end buy report amit
    public function track($id, $cin,$name,$get_product,$get_creditvalue)
    {
        $message = "";
        $data=array();
        $cost=$get_product->inr_price/$get_creditvalue->creditsvalue;
        $usd_cost=$get_product->usd_price/$get_creditvalue->usdcreditsvalue;
        $this->load->helper('string');
        $tracking_id=random_string('alnum', 10);
        $insert =array(
           'items'=>$cin,
           'name'=>$name,
           'country_code'=>'IN',
           'tracking_id'=>$tracking_id,
           'user_id'=>$id,
           'cost'=>$cost,
           'usd_cost'=>$usd_cost,
           'category'=>'Track a Company',
           'status'=>'cart',
           'production_status'=>'new',
           'comment'=>'New Order  <p>from User</p>',
           'assigned'=>'downloader',
           'date'=>date("Y-m-d H:i:s"),
           'product_status'=>'In Progress',
         );
        $this->db->insert('orders', $insert);
        if ($this->db->affected_rows()) {
            $message='Success';
        } else {
            $message='Error';
        }

        return $message;
    }

    public function updateInfo($id, $cin)
    {
        $message = "";
        $data=array();
        $insert =array(
           'cin'=>$cin,
           'user_id'=>$id,
           'status'=>'Pending',
           'date'=>date("Y-m-d H:i:s"),
         );
        $this->db->insert('update-info', $insert);
        if ($this->db->affected_rows()) {
            $message='Success';
        } else {
            $message='Error';
        }

        return $message;
    }
    public function estimate()
    {
        $message = "";
        $data=array();
        $activityCount=(int)$this->input->post('activityCount');
        $classCount=(int)$this->input->post('classCount');
        $citiesCount=(int)$this->input->post('cityCount');
        $minPUC=$this->input->post('minPUC');
        $maxPUC=$this->input->post('maxPUC');
        $startDate=$this->input->post('startDate');
        $category=$this->input->post('category');
        $endDate=$this->input->post('endDate');

        $data['cities']=[];
        $data['activity']=[];
        $data['class']=[];

        for ($i=1; $i <$activityCount; $i++) {
            $activity= $this->input->post('activity_'.$i);
            if ($activity) {
                $data['activity'][]=$activity;
            }
        }
        for ($i=1; $i <$classCount; $i++) {
            $class= $this->input->post('class_'.$i);
            if ($class) {
                $data['class'][]=$class;
            }
        }

        for ($i=1; $i <$citiesCount; $i++) {
            $cities= $this->input->post('city_'.$i);
            if ($cities) {
                $data['cities'][]=$cities;
            }
        }





        $this->db->select("id");

        if ($data['activity']) {
            $this->db->where_in('activity', $data['activity']);
        }
        if ($data['class']) {
            $this->db->where_in('class', $data['class']);
        }
        if ($data['cities']) {
            $this->db->where_in('roc', $data['cities']);
        }

        if ($minPUC) {
            $this->db->where('paidUpCaiptal >=', (int)$minPUC);
        }
        if ($maxPUC) {
            $this->db->where('paidUpCaiptal <=', (int)$maxPUC);
        }
        if ($startDate&&$endDate) {
            $startDate = DateTime::createFromFormat('m/d/Y', $startDate);
            $startDate=$startDate->format('Y-m-d');
            $endDate = DateTime::createFromFormat('m/d/Y', $endDate);
            $endDate=$endDate->format('Y-m-d');
            $this->db->where('dateofincorporation BETWEEN "'. date('Y-m-d', strtotime($startDate)). '" and "'. date('Y-m-d', strtotime($endDate)).'"');
        }

        $query = $this->db->get('company');
        return $query->num_rows();
    }


    public function updateDA($id)
    {
      // $this->db->select('*');
      // $query = $this->db->get('admin');
      // $pusers= $query->result_array();
      // $rolls=  array();
      // $downloaders=array();
      // foreach ($pusers as $puser) {
      //   $rolls=json_decode($puser['assign_to']);
      //   if (in_array("DA", $rolls))
      //   {
      //
      //     $this->db->select('*');
      //     $this->db->where('user_id',$puser['id']);
      //     $this->db->where('roll','DA');
      //     $dquery = $this->db->get('task');
      //     $downloaders[$puser['id']]=$dquery->num_rows();
      //   }
      // }
      //
      // $downloader_index = array_search(min($downloaders), $downloaders);
      // $insert_Task =array(
      //   'user_id'=>$downloader_index,
      //  'task_id'=>$tracking_id,
      //  'type'=>'Full Company Report',
      //   'status'=>'Active',
      //   'roll'=>'DA',
      //  );
       // $this->db->insert('task', $insert_Task);
       // echo json_encode($insert_Task);
       // exit;




      $comment="";
      $data['update'] = array(
      'assigned' => 'DA',
      'msg' => $comment,
      'comment'=>'Completed  <p>& Sent to DA</p>',
      'production_status'=>"inprogress",
      'da'=>'new',
      'fa'=>'',
      'downloader'=>'completed',
      'admin'=>'',
     );
        $this->db->where('tracking_id', $id);
        $this->db->update('orders', $data['update']);
        if ($this->db->affected_rows()) {
            $data['message']['status']='Success';
        } else {
            $data['message']['status']='Error';
        }
        // $this->db->insert('report', $data['insert']);
        return $data['message'];
    }

    public function mydocuments($id)
    {   $data = array();
        $this->db->select('*');
        $this->db->where('tracking_id', $id);
        $query = $this->db->get('uploads');
        if ($query->num_rows() == 1) {
            $data['files']=$query->row_array();
            return $data['files'];
        }

    }
}
