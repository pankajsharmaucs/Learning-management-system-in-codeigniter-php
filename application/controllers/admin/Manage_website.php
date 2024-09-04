  <?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manage_website extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        Utils::no_cache();
         $this->load->model('Common_model');
         $this->load->model('Custom_model');
        //  $this->load->library(array('session','form_validation','image_lib'));
    }
    public function index()
    {
    $data['get_membership']=$this->Common_model->GetData('membership');
      $data['session_user']=$this->session->userdata('admin_in');
     if (!($data['session_user']['usergroup']=="ADMIN")) {
         redirect(base_url('admin/dashboard'));
     }
     $data['title'] = 'Admin Dashboard';
     $data['menu'] = 'membership';
     $notify=$this->Common_model->GetData('notification', "", "admin_status='0'");
     $data['count']=count($notify);
    $this->load->view('admin/inc/header', $data, false);
     $this->load->view('admin/manage_website/membership', $data, false);
     $this->load->view('admin/inc/footer', $data, false);
    }
    public function save_membership()
   {
     $create_data=$this->Common_model->get_single('membership',"type='".$_POST['type']."'");
      if(empty($create_data))
      {
        $data=array(
        'type'=>$_POST['type'],
        'cost'=>$_POST['cost'],
        );
        $this->Common_model->SaveData('membership',$data);
        echo "1";exit;
      }
      else
      {
        echo "0";exit;
      }
   }
   public function get_value()
  {
    $get_data=$this->Common_model->get_single('membership',"id='".$_POST['id']."'");
    $data=array(
      'id'=>$get_data->id,
      'type'=>$get_data->type,
      'cost'=>$get_data->cost,
    );
    echo json_encode($data);exit;
  }
  public function update_membership()
 {
   $update_data=$this->Common_model->get_single_record('membership',"type='".$_POST['type']."' and id!='".$_POST['id']."'");
     if(empty($update_data))
     {
       $data=array(
       'type'=>$_POST['type'],
       'cost'=>$_POST['cost'],
       );
       $this->Common_model->SaveData('membership',$data,"id='".$_POST['id']."'");
       echo "1";exit;
     }
     else
     {
       echo "0";exit;
     }
 }
  public function delete($id)
   {
          $this->Common_model->DeleteData('membership',"id='".$id."'");
          redirect(base_url('admin/Manage_website'));
   }

   // add postpaid users
   public function postpaid_list()
   {
     $cond="u.type='postpaid'";
     $data['get_users']=$this->Custom_model->postpaid_users($cond);
     $data['get_membership']=$this->Common_model->GetData('membership');
       $data['get_country']=$this->Common_model->GetData('countries');
       $data['session_user']=$this->session->userdata('admin_in');
      if (!($data['session_user']['usergroup']=="ADMIN")) {
          redirect(base_url('admin/dashboard'));
      }
      $data['title'] = 'Admin Dashboard';
      $data['menu'] = 'postpaid';
      $notify=$this->Common_model->GetData('notification', "", "admin_status='0'");
      $data['count']=count($notify);
     $this->load->view('admin/inc/header', $data, false);
      $this->load->view('admin/manage_website/postpaid_user', $data, false);
      $this->load->view('admin/inc/footer', $data, false);
   }
   public function create()
       {
        $data['session_user']=$this->session->userdata('admin_in');
       if (!($data['session_user']['usergroup']=="ADMIN")) {
           redirect(base_url('admin/dashboard'));
       }
        $data['get_country']=$this->Common_model->GetData('countries');
       $data['title'] = 'Admin | Postpaid Users';
         $data['data'] = array('sub_heading'=>'Add Postpaid Users',
                 'button'=>"Create Postpaid User",
                   //'action'=>base_url('admin/Manage_website/save_postpaid'),
                   'name' =>set_value('name'),
                   'email' =>set_value('email'),
                   'start_date' =>set_value('start_date'),
                   'end_date' =>set_value('end_date'),
                   'no_of_report' =>set_value('no_of_report'),
                   'invoice' =>set_value('invoice'),
                   'company' =>set_value('company'),
                   'country_id' =>set_value('country_id'),
                   'password' =>set_value('password'),
                   'id' =>set_value('id'),
         );

        $this->load->view('admin/inc/header',$data);
       $this->load->view('admin/manage_website/postpaid_form', $data);
       $this->load->view('admin/inc/footer');
   }
   public function save_postpaid()
   {
       $password = Utils::hash('sha1', $this->input->post('password'), AUTH_SALT);
     $data=array(
     'name'=>$_POST['name'],
     'email'=>$_POST['email'],
     'country_id'=>$_POST['country_id'],
     'start_date'=>date('Y-m-d',strtotime($_POST['start_date'])),
     'end_date'=>date('Y-m-d',strtotime($_POST['end_date'])),
     'no_of_report'=>$_POST['no_of_report'],
     'invoice'=>$_POST['invoice'],
     'purchase_status'=>$_POST['purchase_status'],
     'company'=>$_POST['company'],
     'max_status'=>$_POST['max_status'],
     'password'=>$password,
     'type'=>'postpaid',
     );
     $this->Common_model->SaveData('users',$data);

    //  $email=$this->input->post('email');
    //  $this->load->model('Send_mail');
    //  $subject="Registration Form";
    //  $to=$email;
    //  $id="1";
    //  $view='emails/welcome_kreditaid';
    // $this->Send_mail->send($id,$to,$view,$subject,$data);
     echo "1";exit;
   }
   public function update($id)
   {
      $data['update_user']=$this->Common_model->GetData('users','',"id='".$id."'",'',"",'','1');
      //print_r($update_blog->name); exit;
      $data['get_country']=$this->Common_model->GetData('countries');
     $data['session_user']=$this->session->userdata('admin_in');
       if (!($data['session_user']['usergroup']=="ADMIN")) {
           redirect(base_url('admin/dashboard'));
       }
       $data['title'] = 'Admin| Postpaid Users';
         $data['data'] = array('sub_heading'=>'Update Postpaid Users',
               'button'=>'Update Postpaid Users',
                   //'action'=>base_url('admin/Blog/update_action'),
                   'name' =>$data['update_user']->name,
                   'email' =>$data['update_user']->email,
                   'start_date' =>date('d-m-Y',strtotime($data['update_user']->start_date)),
                   'end_date' =>date('d-m-Y',strtotime($data['update_user']->end_date)),
                   'no_of_report' =>$data['update_user']->no_of_report,
                   'invoice' =>$data['update_user']->invoice,
                   'purchase_status'=>$data['update_user']->purchase_status,
                     'max_status'=>$data['update_user']->max_status,
                   'company' =>$data['update_user']->company,
                   'country_id' =>$data['update_user']->country_id,
                   'password' =>$data['update_user']->password,
                   'confirm_password' =>$data['update_user']->password,
                   'id' =>$id,
         );

        $this->load->view('admin/inc/header',$data);
       $this->load->view('admin/manage_website/update_postpaid_form', $data);
       $this->load->view('admin/inc/footer');
   }
  public function update_postpaid()
 {
    $password = Utils::hash('sha1', $this->input->post('password'), AUTH_SALT);
       $data=array(
         'name'=>$_POST['name'],
         'email'=>$_POST['email'],
         'country_id'=>$_POST['country_id'],
         'start_date'=>date('Y-m-d',strtotime($_POST['start_date'])),
         'end_date'=>date('Y-m-d',strtotime($_POST['end_date'])),
         'no_of_report'=>$_POST['no_of_report'],
         'invoice'=>$_POST['invoice'],
          'purchase_status'=>$_POST['purchase_status'],
            'max_status'=>$_POST['max_status'],

         'company'=>$_POST['company'],
        //'password'=>$password,
         'type'=>'postpaid',
       );
      $this->Common_model->SaveData('users',$data,"id='".$_POST['id']."'");
       // $update = $this->admin->update('users', array('id'=>$id), $data);
       // echo   $this->db->last_query();
       echo "1";exit;
 }
   public function delete_postpaid($id)
    {
           $this->Common_model->DeleteData('users',"id='".$id."'");
           redirect(base_url('admin/Manage_website/postpaid_list'));
    }
   // end postpaid

   // start 90 days
   public function existing_reportvalidating_list()
  {
  $data['get_report']=$this->Common_model->GetData('report_validation_days','','','',"");
       $data['session_user']=$this->session->userdata('admin_in');
      if (!($data['session_user']['usergroup']=="ADMIN")) {
          redirect(base_url('admin/dashboard'));
      }
      $data['title'] = 'Admin Existing Report Validating';
      $data['menu'] = 'existing_report';
      //  $data['submenu'] = 'manage_web';
     $this->load->view('admin/inc/header', $data, false);
      $this->load->view('admin/social_media/existing_report_list', $data, false);
      $this->load->view('admin/inc/footer', $data, false);
  }

public function add_report()
{
  $data = array();
     $this->load->model('Crud_model');
     $data['message'] = $this->Crud_model->add('report_validation_days');
     echo json_encode($data);
}
public function get_value_data()
{
 $get_data=$this->Common_model->get_single('report_validation_days',"id='".$_POST['id']."'");
 $data=array(
   'id'=>$get_data->id,
   'report_days'=>$get_data->report_days,
 );
 echo json_encode($data);exit;
}
public function update_report()
{
 $id=$_POST['id'];
    $data = array();
     $this->load->model('Crud_model');
     $data['message'] = $this->Crud_model->update('report_validation_days',$id);
     echo json_encode($data);
}
public function delete_report($id)
 {
        $this->Common_model->DeleteData('report_validation_days',"id='".$id."'");
        redirect(base_url('admin/Manage_website/existing_reportvalidating_list'));
 }
   // end 90 days
  }
