<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Custom_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function group_by($key, $data) {
    $result = array();

    foreach($data as $val) {
        if(array_key_exists($key, $val)){
            $result[$val[$key]][] = $val;
        }else{
            $result[""][] = $val;
        }
    }
  }


    public function insert_product_support()
    {
        $message='';
        if (isset($_FILES['attachment']['name'])!='') {
            $data['file_name']= rand(0000, 9999)."_".$_FILES['attachment']['name'];

            $target_path = "./upload/product_support/";
            $target_path = $target_path.basename($data['file_name']);
            if (move_uploaded_file($_FILES['attachment']['tmp_name'], $target_path)) {
              //  $data['message']['file']="Uploaded";
                $attachment  = $data['file_name'];
                // echo json_encode($data['message']);
            } else {
                $data['message']['file']="system_error";
                // echo json_encode($data['message']);
            }
        } else {
            $attachment='';
        }
        $data=array(
        'name'=>$_POST['name'],
        'email'=>$_POST['email'],
        'phone'=>$_POST['phone'],
        'message'=>$_POST['message'],
        'product_id'=>$_POST['product_id'],
        'attachment'=>$attachment,
       );
        $insert= $this->db->insert('product_support_form', $data);
        if ($insert) {
            $message = 'Success';
        } else {
            $message = 'Error';
        }
        return $message;
    }
    public function insert_support()
    {
        $message='';
        if (isset($_FILES['attachment']['name'])!='') {
            $data['file_name']= rand(0000, 9999)."_".$_FILES['attachment']['name'];

            $target_path = "./upload/product_support/";
            $target_path = $target_path.basename($data['file_name']);
            if (move_uploaded_file($_FILES['attachment']['tmp_name'], $target_path)) {
              //  $data['message']['file']="Uploaded";
                $attachment  = $data['file_name'];
                // echo json_encode($data['message']);
            } else {
                $data['message']['file']="system_error";
                // echo json_encode($data['message']);
            }
        } else {
            $attachment='';
        }
        $data=array(
        'user_id'=>$_POST['user_id'],
        'name'=>$_POST['name'],
        'phone'=>$_POST['phone'],
        'message'=>$_POST['message'],
        'product_id'=>$_POST['product_id'],
        'subject'=>$_POST['subject'],
        'attachment'=>$attachment,
       );
       if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response']))
     {
           $secret = '6LfN68sZAAAAAGb2-_Oq9bg0jIXnUTGM5VGrQFSI';
           $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
           $responseData = json_decode($verifyResponse);
           if($responseData->success)
           {
               $succMsg = 'Your contact request have submitted successfully.';
           }
           else
           {
               $errMsg = 'Robot verification failed, please try again.';
           }
      }
        $insert= $this->db->insert('users_support', $data);
        if ($insert) {
            $message = 'Success';
        } else {
            $message = 'Error';
        }
        return $message;
    }
    function product_support($cond)
    {
        $this->db->select('ps.*,p.product_name');
        $this->db->from('product_support_form ps');
        $this->db->join('product p',"p.id = ps.product_id","left");
        $this->db->where($cond);
        return $this->db->get()->row_array();
    }
    function postpaid_users($cond)
    {
        $this->db->select('u.*,c.name as country,m.type as plan,m.cost');
        $this->db->order_by('id', 'DESC');
        $this->db->from('users u');
        $this->db->join('countries c',"c.id = u.country_id","left");
        $this->db->join('membership m',"m.id = u.membership_id","left");
        $this->db->where($cond);
        return $this->db->get()->result_array();
    }
    function postpaiduserslist($cond)
    {
        $this->db->select('ba.*,u.type');
        $this->db->from('billing_address ba');
        $this->db->join('users u',"u.id = ba.user_id","left");
        $this->db->where($cond);
        return $this->db->get()->result_array();
    }
    function orders_datefilter($cond)
    {
        $this->db->select('o.*,b.merchant_order_id,c.name as country_name,u.country_id');
        $this->db->from('orders o');
        $this->db->join('billing_address b',"b.id = o.billing_id","left");
        $this->db->join('countries c',"c.sortname = o.country_code","left");
        $this->db->join('users u',"u.id = o.user_id","left");
        $this->db->where($cond);
        return $this->db->get()->result_array();
    }
}
