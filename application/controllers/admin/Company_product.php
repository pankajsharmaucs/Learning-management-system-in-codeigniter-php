<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Company_product extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        Utils::no_cache();
         $this->load->model('Common_model');

    }

   public function index()
   {
    $data['get_product']=$this->Common_model->GetData('product','','','',"");
         $data['session_user']=$this->session->userdata('admin_in');
        if (!($data['session_user']['usergroup']=="ADMIN")) {
            redirect(base_url('admin/dashboard'));
        }
        $data['title'] = 'Admin Product';
        $data['menu'] = 'product';
       $this->load->view('admin/inc/header', $data, false);
        $this->load->view('admin/master/product_list', $data, false);
        $this->load->view('admin/inc/footer', $data, false);
   }
   public function get_value()
  {
    $get_data=$this->Common_model->get_single('product',"id='".$_POST['id']."'");
    $data=array(
      'id'=>$get_data->id,
      'product_name'=>$get_data->product_name,
      'inr_price'=>$get_data->inr_price,
      'usd_price'=>$get_data->usd_price,
    );
    echo json_encode($data);exit;
  }
 public function update_product()
  {
    $id=$_POST['id'];
       $data = array();
        $this->load->model('Crud_model');
        $data['message'] = $this->Crud_model->update('product',$id);
        echo json_encode($data);
  }
  public function delete_product($id)
    {
           $this->Common_model->DeleteData('product',"id='".$id."'");
           redirect(base_url('admin/Company_product'));
    }

    // Add users

    public function add_user()
    {
      $data = array();
      $email=$this->input->post('email');
      $this->load->model('Auth_model');
      $this->load->model('Send_mail');
      $data['message'] = $this->Auth_model->register();
      echo json_encode($data);
      $subject="Registration Form";
      $to=$email;
      $id="1";
      $view='emails/welcome_kreditaid';
     $this->Send_mail->send($id,$to,$view,$subject,$data);
    }
    public function get_uservalue()
   {
     $get_data=$this->Common_model->get_single('users',"id='".$_POST['id']."'");
    // $get_credit=$this->Common_model->get_single('e_wallet',"user_id='".$get_data->id."'");
     $data=array(
       'id'=>$get_data->id,
       'name'=>$get_data->name,
       'email'=>$get_data->email,
       'country_id'=>$get_data->country_id,
       'credit'=>$get_data->credit,
       'password'=>$get_data->password,
     );
     echo json_encode($data);exit;
   }
   public function update_user()
    {
      $id=$_POST['id'];
      $data=array(
        'name'=>$_POST['name'],
        'email'=>$_POST['email'],
        'country_id'=>$_POST['country_id'],
        'credit'=>$_POST['credit'],
        'password'=>$_POST['password'],
        'is_active'=>1,
      );
    $this->Common_model->SaveData('users',$data,"id='".$id."'");

    $data['creditvalue']=$this->admin->getVal('select creditsvalue from creditsvalue where id=1');
 $data['usdcreditvalue']=$this->admin->getVal('select usdcreditsvalue from creditsvalue where id=1');
 if($_POST['country_id']=='101')
 {
   $amount=$_POST['credit']*$data['creditvalue'];
 }
 else{
   $amount=$_POST['credit']*$data['usdcreditvalue'];
 }
    $credit_data=array(
      'user_id'=>$id,
      'transaction_id'=>'admin',
      'amount'=>$amount,
      'coin'=>$_POST['credit'],
      'status'=>1,
    );
      $this->Common_model->SaveData('e_wallet',$credit_data);
    echo "1";
    }
   public function delete_user($id)
     {
            $this->Common_model->DeleteData('users',"id='".$id."'");
            redirect(base_url('admin/Dashboard/users'));
     }
    //end users

}
