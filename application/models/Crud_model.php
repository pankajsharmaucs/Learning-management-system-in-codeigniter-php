<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Crud_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }


    function getItems($controll)
    {
        $this->db->select('*');
        $query = $this->db->get($controll);
        return $query->result_array();
    }

    function getCategory($controll)
    {
        $this->db->select('*');
        $this->db->where('parentCategory', $controll);
        $query = $this->db->get('category');
        return $query->result_array();
    }

    function getItem($controll,$id)
    {
        $this->db->select('*');
        $this->db->where('id',$id);
        $this->db->limit(1);
        $query = $this->db->get($controll);
        return $query->row_array();
    }

    public function add($controll)
    {
        $message = "";
        $data['insert'] = array();
        $data['fields'] = $this->db->list_fields($controll);
        for ($i = 1; $i < sizeof($data['fields']); $i++) {
            $field = $data['fields'][$i];
            $data['insert'][$field] = $this->input->post($field);
        }
        //$data['insert']['images']=$this->input->post('image');
        $this->db->insert($controll, $data['insert']);
        if ($this->db->affected_rows() > 0) {
            $message = 'Success';
            unset($_POST);
        } else {
            $message = 'Error';
        }
        return $message;
    }


    function delete($controll,$id)
    {
        $message = "";
        $this->db->where('id', $id);
        $this->db->delete($controll);
        $message = "Success";
        return $message;
    }

    public function update($controll,$id)
    {
        $message = "";
        $data['update'] = array();
        $data['fields'] = $this->db->list_fields($controll);
        for ($i = 1; $i < sizeof($data['fields']); $i++) {
            $field = $data['fields'][$i];
            $data['update'][$field] = $this->input->post($field);
        }

        $this->db->where('id', $id);
        $this->db->update($controll, $data['update']);
        if ($this->db->affected_rows() > 0) {
            $message = 'Success';
            unset($_POST);
        } else {
            $message = 'Error';
        }
        //$message = $controll;
        return $message;
    }

    public function doUpload()
    {
        $data = array();
        if ($_FILES['file']['name'] != "") {
            if (!file_exists('./assets/media/')) {
                mkdir('.assets/media/', 0777, true);
            }
            $config['upload_path'] = './assets/media/';
            $config['allowed_types'] = 'jpg|png|jpeg|gif';
            $config['max_size'] = 2000;
            $config['file_name'] = $this->input->post('title');
            $config['overwrite'] = TRUE;
            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $s = $this->upload->initialize($config);
            if ($this->upload->do_upload('file')) {
                $uploadData = $this->upload->data();
                $data['msg'] = 'Success';
                $data['upload'] = array(
                    'title' => $uploadData['file_name'],
                    'url'=> $this->input->post('url'),
                    'alt_text' => $this->input->post('alt_text'),
                );
                $this->db->insert('media', $data['upload']);
            } else {
                $data['msg'] = 'Error';
            }
        }
        return $data['msg'];
    }

    function searchItems($id){
        $this->db->like('title', $id);
        $this->db->or_like('alt_text', $id);
        $query=$this->db->get('media');
        return $query->result_array();
    }

    function list_notification($con)
   {
       $this->db->select('no.*,u.name as full_name');
       $this->db->from('notification no');
       $this->db->join('users u',"u.id = no.user_id","left");
       $this->db->where($con);
       $this->db->order_by('id','DESC');
       return $this->db->get()->result_array();
   }
   function wallet_user($cond)
       {
           $this->db->select('e.*,u.name');
           $this->db->from('e_wallet e');
           $this->db->join('users u',"u.id = e.user_id","left");
           $this->db->where($cond);
           $this->db->order_by('e.id','DESC');
           //$this->db->group_by('e.user_id');
           return $this->db->get()->result_array();
       }
       function orders_detail($cond)
       {
           $this->db->select('or.*,u.name');
           $this->db->from('orders or');
           $this->db->join('users u',"u.id = or.user_id","left");
           $this->db->where($cond);
           $this->db->order_by('or.id','DESC');
           return $this->db->get()->result_array();
       }
       function payment_detail()
    {
        $this->db->select('b.*,u.name');
        $this->db->from('billing_address b');
        $this->db->join('users u',"u.id = b.user_id","left");
        //$this->db->where($cond);
        $this->db->order_by('b.id','DESC');
        return $this->db->get()->result_array();
    }
    /*amit*/
       function country_detail($cond)
    {
        $this->db->select('u.*,c.name,c.phonecode');
        $this->db->from('users u');
        $this->db->join('countries c',"c.id = u.country_id","left");
        $this->db->where($cond);
        //$this->db->order_by('or.id','DESC');
        return $this->db->get()->row_array();
    }
    function trackcompany_detail($cond)
    {
        $this->db->select('t.*,o.category,o.count,o.user_id,o.status');
        $this->db->from('tracker t');
        $this->db->join('orders o',"o.tracking_id = t.tracking_id","left");
        $this->db->where($cond);
        $this->db->order_by('t.id','DESC');
        return $this->db->get()->result_array();
    }
    function users_support($cond)
    {
        $this->db->select('s.*,p.product_name,u.email,u.name');
        $this->db->from('users_support s');
        $this->db->join('product p',"p.id = s.product_id","left");
        $this->db->join('users u',"u.id = s.user_id","left");
        $this->db->where($cond);
        $this->db->order_by('s.id','DESC');
        return $this->db->get()->result_array();
    }
    function users_support_mail($cond)
    {
        $this->db->select('s.*,p.product_name,u.email,u.name');
        $this->db->from('users_support s');
        $this->db->join('product p',"p.id = s.product_id","left");
        $this->db->join('users u',"u.id = s.user_id","left");
        $this->db->where($cond);
        return $this->db->get()->row_array();
    }
    /*end amit*/
    /* admin side show data*/
    function support_list($con)
   {
       $this->db->select('us.*,p.product_name,u.name,u.email');
       $this->db->from('users_support us');
       $this->db->join('product p',"p.id = us.product_id","left");
       $this->db->join('users u',"u.id = us.user_id","left");
       $this->db->where($con);
       $this->db->order_by('us.id','DESC');
       return $this->db->get()->result_array();
   }
    function support_list1($con)
   {
       $this->db->select('us.*,p.product_name,u.name,u.email');
       $this->db->from('users_support us');
       $this->db->join('product p',"p.id = us.product_id","left");
       $this->db->join('users u',"u.id = us.user_id","left");
       $this->db->where($con);
         $this->db->where('assign', 1);
       $this->db->order_by('us.id','DESC');

       return $this->db->get()->result_array();
   }
    function support_list2($con)
   {
       $this->db->select('us.*,p.product_name,u.name,u.email');
       $this->db->from('users_support us');
       $this->db->join('product p',"p.id = us.product_id","left");
       $this->db->join('users u',"u.id = us.user_id","left");
       $this->db->where($con);
         $this->db->where('assign', 2);
       $this->db->order_by('us.id','DESC');
       return $this->db->get()->result_array();
   }
    function support_list3($con)
   {
       $this->db->select('us.*,p.product_name,u.name,u.email');
       $this->db->from('users_support us');
       $this->db->join('product p',"p.id = us.product_id","left");
       $this->db->join('users u',"u.id = us.user_id","left");
       $this->db->where($con);
         $this->db->where('assign', 3);
       $this->db->order_by('us.id','DESC');
       return $this->db->get()->result_array();
   }
   /*end admin */
}
