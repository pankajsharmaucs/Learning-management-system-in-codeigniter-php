<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        Utils::no_cache();
  $this->load->model('Send_mail');
  $this->load->model('Common_model');
    }

    public function recent_incorporation()
    {
        $data = array();
        if(@$this->session->userdata('logged_in')){
            $data['session_user']=$this->session->userdata('logged_in');
        }
        $id=$data['session_user']['id'];
        $this->load->model('Cart_model');
        $data['message'] = $this->Cart_model->recent_incorppration($id);
        echo json_encode($data);
    }
    public function new_incorporation()
    {
        $data = array();
        if(@$this->session->userdata('logged_in')){
            $data['session_user']=$this->session->userdata('logged_in');
        }
        $id=$data['session_user']['id'];
        $this->load->model('Cart_model');
        $data['message'] = $this->Cart_model->recent_incorppration($id);
        echo json_encode($data);
    }
    public function estimate()
    {
        $data = array();
        $this->load->model('Cart_model');
        $data['message'] = $this->Cart_model->estimate();
        echo json_encode($data);
    }
    public function full_report()
    {
      $cin=$this->input->get('cin');
     $name=$this->input->get('name');
     $this->load->model('Cart_model');
        $data = array();
        if(@$this->session->userdata('logged_in')){
            $data['session_user']=$this->session->userdata('logged_in');
        }
        $id=$data['session_user']['id'];
        $type=$data['session_user']['type'];

        $get_product=$this->Common_model->GetData('product','',"id='2'",'','','','1');
        $get_creditvalue=$this->Common_model->GetData('creditsvalue','',"id='1'",'','','','1');
       $get_fullreport=$this->Common_model->get_single('orders',"user_id='".$id."' and name='".$name."' and status='cart' and category='Full Company Report'");
        if(!empty($get_fullreport))
        {
        $data['message']='full_report';
      }
      else{
      $data['message'] = $this->Cart_model->full_report($id,$cin,$name,$get_product,$get_creditvalue,$type);
      }
        if($this->Cart_model->getUserCartCount($id)){
           $data['Cart'] =$this->Cart_model->getUserCartCount($id);
       }
        echo json_encode($data);
    }


      public function full_report222()
    {
      // $data=array();
      $cin=$this->input->get('cin');
     $name=$this->input->get('name');
    $this->load->model('Cart_model');
        $data = array();
        if(@$this->session->userdata('logged_in')){
            $data['session_user']=$this->session->userdata('logged_in');
        }
        $id=$data['session_user']['id'];
       $get_product=$this->Common_model->GetData('product','',"id='2'",'','','','1');
        $get_creditvalue=$this->Common_model->GetData('creditsvalue','',"id='1'",'','','','1');
      $get_fullreport=$this->Common_model->get_single('orders',"user_id='".$id."' and name='".$name."' and status='cart' and category='Full Company Report'");
       /*   if(!empty($get_fullreport))
        {
        $data['message']='full_report';
      }
      else{
      $data['message'] = $this->Cart_model->full_report($id,$cin,$name,$get_product,$get_creditvalue);
      }
        if($this->Cart_model->getUserCartCount($id)){
           $data['Cart'] =$this->Cart_model->getUserCartCount($id);
       }*/
$this->load->helper('string');
   $cost=$get_product->inr_price/$get_creditvalue->creditsvalue;
        $usd_cost=$get_product->usd_price/$get_creditvalue->usdcreditsvalue;
//$cost=225;
  // $usd_cost=125;
     $get_fullreport=$this->Common_model->get_single('orders',"user_id='".$id."' and name='".$name."' and status='cart' and category='Full Company Report'");
        if(!empty($get_fullreport))
        {
        $data['message']='full_report';
      }
      else{
 $tracking_id=random_string('alnum', 10);

         $array =array(
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
         $data['message']='Success';

        $insert = $this->admin->insert('orders', $array);
         $data['Cart'] = $this->admin->getVal('SELECT count(id) FROM `orders` WHERE status ="cart" and user_id="'.$id.'"');
        }
 //echo $this->db->last_query(); exit;
        echo json_encode($data);
    }
    public function full_report1()
    {
      $cin=$this->input->post('cin');
     $name=$this->input->post('name');
     $country=$this->input->post('country');
        $data = array();
        if(@$this->session->userdata('logged_in')){
            $data['session_user']=$this->session->userdata('logged_in');
        }
        $id=$data['session_user']['id'];
        $get_product=$this->Common_model->GetData('product','',"id='2'",'','','','1');
        $get_creditvalue=$this->Common_model->GetData('creditsvalue','',"id='1'",'','','','1');
        $this->load->model('Cart_model');
        $data['message'] = $this->Cart_model->full_report1($id,$cin,$name,$country,$get_product,$get_creditvalue);
        if($this->Cart_model->getUserCartCount($id)){
           $data['Cart'] =$this->Cart_model->getUserCartCount($id);
       }
        echo json_encode($data);
    }
    public function doc()
    {
      $this->load->model('Cart_model');
      $cin=$this->input->get('cin');
      $name=$this->input->get('name');
      $date=$this->input->get('date');
    //  print_r($date); exit;
        $data = array();
        if(@$this->session->userdata('logged_in')){
            $data['session_user']=$this->session->userdata('logged_in');
            $id=$data['session_user']['id'];
        }
        $get_product=$this->Common_model->GetData('product','',"id='5'",'','','','1');
        $get_creditvalue=$this->Common_model->GetData('creditsvalue','',"id='1'",'','','','1');
        $get_doc=$this->Common_model->get_single('orders',"user_id='".$id."' and name='".$name."' and status='cart' and category='Documents'");
         if(!empty($get_doc))
         {
         $data['message']='document';
       }
       else{
      $data['message'] = $this->Cart_model->doc($id,$cin,$name,$date,$get_product,$get_creditvalue);
       }

        if($this->Cart_model->getUserCartCount($id)){
           $data['Cart'] =$this->Cart_model->getUserCartCount($id);
       }
        echo json_encode($data);
    }

    //all doc amit
    public function buy_alldocument()
    {
        $this->load->model('Cart_model');
       $cin=$this->input->get('cin');
      $name=$this->input->get('name');
      $data = array();
      if(@$this->session->userdata('logged_in')){
          $data['session_user']=$this->session->userdata('logged_in');
            $id=$data['session_user']['id'];
      }

      $get_product=$this->Common_model->GetData('product','',"id='6'",'','','','1');
      $get_alldoc1=$this->Common_model->get_single('orders',"user_id='".$id."' and name='".$name."' and status='cart' and category='All Documents'");
        $get_creditvalue=$this->Common_model->GetData('creditsvalue','',"id='1'",'','','','1');
       if(!empty($get_alldoc1))
       {
       $data['message'] = 'all_document';
     }
     else{
    $data['message'] = $this->Cart_model->all_document($id,$cin,$name,$get_product,$get_creditvalue);
       }
      if($this->Cart_model->getUserCartCount($id)){
         $data['Cart'] =$this->Cart_model->getUserCartCount($id);
     }
      echo json_encode($data);
    }
    // end all doc amit

    // buy old report
    public function buy_report()
    {
      //$id=$this->input->post('cin');
    $cin=$this->input->get('cin');
     $name=$this->input->get('name');
     $country=$this->input->get('country');
        $data = array();
        if(@$this->session->userdata('logged_in')){
            $data['session_user']=$this->session->userdata('logged_in');
            $id=$data['session_user']['id'];
        }
        $priority=0;
            $prioritys=$priority + 1;
 $darray = array(

                            'company_status'      =>'pending',
                            'charges_status'      =>'pending',
                            'company_counter'      =>0,
                            'charges_counter'      =>0,
                            'scrap_type'          =>3,
                            'priority'            =>$prioritys,
                        );

          $where = array('cin'=>$cin);
          $update = $this->admin->update('scrappers_log',$where, $darray);
        $get_product=$this->Common_model->GetData('product','',"id='2'",'','','','1');
      $get_creditvalue=$this->Common_model->GetData('creditsvalue','',"id='1'",'','','','1');
        $this->load->model('Cart_model');
        $get_buyreport=$this->Common_model->get_single('orders',"user_id='".$id."' and name='".$name."' and status='cart' and category='Existing Report'");
        //$data['message'] = $this->Cart_model->buy_report($id,$cin,$name,$country,$get_product,$get_creditvalue);
        if(!empty($get_buyreport))
        {
        $data['message']='buy_report';
      }
      else{
      $data['message'] = $this->Cart_model->buy_report($id,$cin,$name,$country,$get_product,$get_creditvalue);
      }
        if($this->Cart_model->getUserCartCount($id)){
           $data['Cart'] =$this->Cart_model->getUserCartCount($id);
       }
        echo json_encode($data);
    }

      public function buy_report1($cin)
    {
         $cin=$this->input->post('cin');
     $name=$this->input->post('name');
     $country=$this->input->post('country');
        $data = array();
        if(@$this->session->userdata('logged_in')){
            $data['session_user']=$this->session->userdata('logged_in');
            $id=$data['session_user']['id'];
        }
        $get_product=$this->Common_model->GetData('product','',"id='2'",'','','','1');
        $get_creditvalue=$this->Common_model->GetData('creditsvalue','',"id='1'",'','','','1');
        $this->load->model('Cart_model');
        $data['message'] = $this->Cart_model->buy_report($id,$cin,$name,$country,$get_product,$get_creditvalue);
        if($this->Cart_model->getUserCartCount($id)){
           $data['Cart'] =$this->Cart_model->getUserCartCount($id);
       }
        echo json_encode($data);
    }
    //end buy old report
      public function tracker()
    {
        $this->load->model('Cart_model');
      $cin=$this->input->get('cin');
     $name=$this->input->get('name');
        $data = array();
        if(@$this->session->userdata('logged_in')){
            $data['session_user']=$this->session->userdata('logged_in');
            $id=$data['session_user']['id'];
        $get_product=$this->Common_model->GetData('product','',"id='1'",'','','','1');
      $get_creditvalue=$this->Common_model->GetData('creditsvalue','',"id='1'",'','','','1');
        $get_track=$this->Common_model->get_single('orders',"user_id='".$id."' and name='".$name."' and status='cart' and category='Track a Company'");
         if(!empty($get_track))
         {
         $data['message']='track_report';
       }
       else{
        $data['message'] = $this->Cart_model->track($id,$cin,$name,$get_product,$get_creditvalue);
       }

            if($this->Cart_model->getUserCartCount($id)){
               $data['Cart'] =$this->Cart_model->getUserCartCount($id);
           }
        }
        else{
          $data['message']='Login Error';
        }

        echo json_encode($data);
    }
    public function updateInfo($cin)
  {
      $data = array();
      if(@$this->session->userdata('logged_in')){
          $data['session_user']=$this->session->userdata('logged_in');
          $id=$data['session_user']['id'];
          $this->load->model('Cart_model');
          $data['message'] = $this->Cart_model->updateInfo($id,$cin);
          $last_id=$this->db->insert_id();
          $update=$this->Common_model->GetData('update-info',"","id='".$last_id."'","","","","1");
          $get_company=$this->Common_model->GetData('company',"name","cin='".$update->cin."'","","","","1");
          $data1=array(
            'get_company'=>$get_company,
          );
          $subject="Update Information";
          $array1=array(
                    'page_id' =>'1',
                    'name' =>$subject,
                    'url' =>'company/'.$cin,
                    'status'       =>'0',
                    'user_id'    =>$id,
                    );
                $this->Common_model->SaveData('notification',$array1);
          $to=$_SESSION['logged_in']['email'];
          $view='emails/update_info';
         $this->Send_mail->send($id,$to,$view,$subject,$data1);
      }
      else{
        $data['message']='Login Error';
      }
      echo json_encode($data);
  }



}
