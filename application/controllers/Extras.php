<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Extras extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        Utils::no_cache();
        $this->load->library(array('session','Custom','email','upload'));
        $this->load->model('Send_mail');
        $this->load->model('Common_model');
        $this->load->model('Extras_model');
        $this->load->model('Front_model');
         $this->load->model('Api_model');
             $this->load->model('Cart_model');

    }

    public function getCities()
    {
        $data = array();
        $state=$this->input->post('state');
        $this->load->model('Extras_model');
        $data['cities'] = $this->Extras_model->getCities($state);
        $this->load->view('components/cities', $data, false);
    }

        public function getdirectordata()
    {
        $data = array();
        $id=$this->input->post('id');
        $cid=$this->input->post('cid');

        $this->load->model('Extras_model');
           $data['MCA_Directors']=$this->admin->getRows('SELECT * FROM `scrap_dir` WHERE cin ="'.$id.'"');

       // $data['MCA_Directors'] = $this->Front_model->getMCA_DirectorsByCompanyId($id);
       $data['sql']= $this->db->last_query();


      //  $data['Directors'] = $this->Front_model->getDirectorsByCompanyId($cid);
        $this->load->view('components/directordata', $data, false);
    }


    public function getCharges()
    {
        $data = array();
        $id=$this->input->post('id');


        $data['charges']=$this->Api_model->charges($id);
        $data['MCA_Charges'] = $this->Front_model->getMCA_ChargesByCompanyId($id);
      $data['sql']= $this->db->last_query();



        $this->load->view('components/chargedata', $data, false);
    }

     public function getsavetolater()
    {
        $data = array();
        $id=$this->input->post('id');

     // $data['charges']=$this->Api_model->charges($id);
     // $data['MCA_Charges'] = $this->Front_model->getMCA_ChargesByCompanyId($id);
     // $data['sql']= $this->db->last_query();
        //$data['session_user']=$this->session->userdata('logged_in');
       
        $data['session_user']=$this->session->userdata('logged_in');
      
        $id=$data['session_user']['id'];
         $data['type']=$data['session_user']['type'];
        $data['get_user']=$this->Common_model->GetData('users',"","id='".$id."' and is_active='1'",'','','','1');

        $this->load->view('components/savetolater', $data, false);
    }
     public function getmovetocart()
    {
        $data = array();
        $id=$_SESSION['logged_in']['id'];

        $con=" o.user_id='".$id."' and o.status='cart'";
        $data['Items'] = $this->Cart_model->getUserCart($con);




        $this->load->view('components/movetocart', $data, false);
    }

   public function similarcompany()
    {
        $data = array();
        $id=$this->input->post('id');
        $data['Similar'] = $this->Front_model->getSimilarCompany($id);

         $data['sql']= $this->db->last_query();
        $this->load->view('components/similarcompany', $data, false);
    }

     public function trademarkdetails()
    {
        $data = array();
        $id=$this->input->get_post('id');
        $data['name']= $this->input->get_post('name');
      //  $data['Similar'] = $this->Front_model->getSimilarCompany($id);
        $data['trademarks_count']=$this->Api_model->trademarks_count($id);
        // echo $data['trademarks_count'];


        $this->load->view('components/trademarkdetails', $data, false);
    }


    public function subscribe()
    {
        $data = array();
        $email=$this->input->post('email');
        $this->load->model('Extras_model');
        $data['message'] = $this->Extras_model->subscribe($email);
        echo json_encode($data);
    }
    public function test_fn(){
      // echo phpinfo();
      echo 'Curl: ', function_exists('curl_version') ? 'Enabled' . "\xA" : 'Disabled' . "\xA";
    }

    public function primary()
    {
        $data = array();
        $data['post']=$_POST;
        $heads="";

        $rowIndex=$data['post']['rowIndex'];
        $data['heads']='';
        if($data['post']['head1'][$rowIndex]){
        $data['heads']=$data['heads'].$data['post']['head1'][$rowIndex]."-".$data['post']['year1'][$rowIndex].',';
        }
        if($data['post']['head2'][$rowIndex]){
        $data['heads']=$data['heads'].$data['post']['head2'][$rowIndex]."-".$data['post']['year2'][$rowIndex].',';
        }
        if($data['post']['head3'][$rowIndex]){
        $data['heads']=$data['heads'].$data['post']['head3'][$rowIndex]."-".$data['post']['year3'][$rowIndex];
        }
        $heads=$data['heads'];
        // echo json_encode($data);
        // exit;

        $this->db->select('*');
        $this->db->where('tracking_id', $data['post']['tracking_id']);
        $query=$this->db->get('orders');
        $data['status']="Success";
        $strEnc = array();
        if ($query->num_rows()>0) {
            $data['row']=$query->row_array();
        }
        $activity='';

        $xbrl_path=base_url().'upload/report/'.$data['post']['tracking_id'].'/'.$data['post']['xbrl_file'];
        // $strPath="http://localhost:9000/rest/xbrl/".$xbrl_path."/facts?media=json&factListCols=Name,Label,Value,Period,Dimensions";
        $strPath="http://localhost:9000/xbrl?input=".$xbrl_path;
        $strEnc=urlencode($strPath);
        // $strEnc=$strPath;
        $cws="http://103.108.220.175/CentralWebService/ConsumeKAData.asmx/InsertDataINCWS?isChargeDetails=false&activity=".$activity."&mapping=".$heads."&fileType=".$data['post']['fileType']."&strURL=".$strEnc;
        $data['cws']=$cws;

        // echo $cws;
        // exit;
        $ch = curl_init($cws);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data['result'] = curl_exec($ch);
        curl_close($ch);
        $data['cws']=$cws;
        $data['result']=json_decode($data['result'],true);
        $data['msg']=$data['result'][0]['ResponseCode'];
        $data['ResponseCode']=$data['result'][0]['ResponseCode'];
        $data['ResponseMessage']=$data['result'][0]['ResponseMessage'];

        if($data['ResponseCode']=='true'){
          if($data['post']['fileType']=="Primary"){
            $masterapi = $cws="http://103.108.220.175/CentralWebService/ConsumeKAData.asmx/InsertDataINCWS?isChargeDetails=true&activity=".$activity."&mapping=nodata&fileType=".$data['post']['fileType']."&strURL=".base_url('newdata/api/'.$data['row']['items']);
            $data['masterapi']=  $masterapi ;
            $ms=curl_init($masterapi);
            curl_setopt($ms, CURLOPT_RETURNTRANSFER, true);
            $data['master_result'] = curl_exec($ms);
            curl_close($ms);
          }
        }
        echo json_encode($data);
    }

    public function showmgt($id)
    {
        $data = array();
        // $data['tracking_id']=$this->input->post('tracking_id');
        $data['tracking_id']=$id;
        // echo json_encode($data['tracking_id']);

        $dir = "upload/pdf/".$data['tracking_id']."/";
        // echo $dir;
        $target_dir = "./upload/pdf/".$data['tracking_id']."/";
        $data['fileList'] = glob('upload/pdf/'.$data['tracking_id'].'/*');
        $data['counts']=sizeof(@$data['fileList']);
        // echo json_encode($data['fileList']);
        // exit;
        $html='';
        foreach ($data['fileList'] as $item) {
          $url=base_url().$item;
          $html=$html.'<div class="col-md-4">
            <iframe src="'.$url.'" width="400" height="600"></iframe>
            <button onclick="setMGT(this.value,`'.$item.'`)" type="button" class="btn-primary  " value="'.$url.'" name="button">Select </button>
          </div>';
        }
        $data['html']=$html;
        $this->load->view('selectfiles', $data, false);

    }

    public function setMGT()
    {
        $data = array();
        $data['tracking_id']=$this->input->post('tracking_id');
        $data['pdf']=$this->input->post('pdf');
        $data['path']=$this->input->post('path');
        $this->db->select('*');
        $this->db->where('tracking_id',$data['tracking_id']);
        $query=$this->db->get('orders');
        $data['row']=$query->row_array();

        $data['update']['pdf']=$data['pdf'];

        $this->db->select('*');
        $this->db->where('o_id', $data['row']['id']);
        $squery=$this->db->get('shareholding');
        $data['squery']=$squery->row_array();
        if($squery->num_rows()>0){
          $this->db->where('o_id', $data['row']['id']);
          $this->db->where('status', 'pdf');
          $this->db->update('shareholding', $data['update']);
          if ($this->db->affected_rows() > 0) {
              $data['dbmsg'] = 'Success';
              unset($_POST);
          } else {
              $data['dbmsg'] = 'Error';
          }
        }else {
          $data['insert']['pdf']=$data['pdf'];
          $data['insert']['o_id']=$data['row']['id'];
          $data['insert']['status']='pdf';
          $this->db->insert('shareholding', $data['insert']);
        }

        $this->load->model('Ocr_model');
      $data['output']=$this->Ocr_model->mgt_ocr( $data['row']['id'],$data['tracking_id'], $data['path']);

     $delete=$this->admin->deleteAll('ocrdata',array('order_id'=>$data['row']['id']));


        echo json_encode($data);
    }

    public function contact()
    {
        $data = array();
        //  $email=$_POST['email'];
        $this->load->model('Crud_model');
        if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
            $secret = '6LfN68sZAAAAAGb2-_Oq9bg0jIXnUTGM5VGrQFSI';
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
            $responseData = json_decode($verifyResponse);
            if ($responseData->success) {
                $succMsg = 'Your contact request have submitted successfully.';
            } else {
                $errMsg = 'Robot verification failed, please try again.';
            }
        }
        $data['message'] = $this->Crud_model->add('contact');
     $this->session->set_flashdata('message', 'Message Sent Successfully!!');
        $last_id=$this->db->insert_id();
        $data['get_contact']=$this->Common_model->get_single('contact', "id='".$last_id."'");
        $subject="Contact Details for Client Information";
        $to='info@ucs-mail.com';  //info@ucs-mail.com
        $id="1";
        $view='emails/client_info';
        $this->Send_mail->send($id, $to, $view, $subject, $data);
        $subject1="Contact Form";
        $to1=$data['get_contact']->email;
        $id1="2";
        $view1='emails/contact_form';
        $this->Send_mail->send($id1, $to1, $view1, $subject1, $data);
        echo json_encode($data);
    }
    public function add_product_support()
    {
        $data=array();
        $this->load->model('Custom_model');
        $data['message'] = $this->Custom_model->insert_product_support();
          $this->session->set_flashdata('message', 'Product Support Sent Successfully!!');
        $last_id=$this->db->insert_id();
        $cond="ps.id='".$last_id."'";
        $data['get_product_support']=$this->Custom_model->product_support($cond);
        //  print_r($data['get_product_support']['email']); exit;
        $subject="Product Support Details for Client Information";
        $to='info@ucs-mail.com';
        $id="1";
        $view='emails/product_support';
        $this->Send_mail->send($id, $to, $view, $subject, $data);
        $subject1="Product Support";
        $to1=$data['get_product_support']['email'];
        $id1="2";
        $view1='emails/contact_form';
        $this->Send_mail->send($id1, $to1, $view1, $subject1, $data);
        echo json_encode($data);
    }
    public function add_offlinerequest()
    {
      //  $data = array();
        $this->load->model('Crud_model');
        $email = $_POST['email'];
    $get_email = $this->Common_model->GetData('users','',"email='".$email."'",'','','','1');

    if(!empty($get_email))
    {
      $data=array(
        'name'=>$_POST['name'],
        'email'=>$_POST['email'],
        'phone'=>$_POST['phone'],
        'company_name'=>$_POST['company_name'],
        'address'=>$_POST['address'],
      );
      $this->Common_model->SaveData('offline_request',$data);
      echo "1"; exit;
        // $data['message'] = $this->Crud_model->add('offline_request');
        // echo json_encode($data);
      }
      else{
        echo "0"; exit;
      }

    }

    function forget_password()
   {
     $email = $_POST['email'];
    $get_email = $this->Common_model->GetData('users','',"email='".$email."'",'','','','1');
        if(!empty($get_email))
        {
            $id=$get_email->id;
          $array1=array(
                    'name' =>'Forget Password',
                    'url' =>'reset_password',
                    'status' =>'0',
                    'user_id' =>$id,
                    );
                $this->Common_model->SaveData('notification',$array1);

   $to=$email;
   $subject='Forgot Password';
   $data['get_email']=$get_email;
   $view='emails/forgot_password';

$error_data=  $this->Send_mail->send($id,$to,$view,$subject,$data);
  echo $error_data;
  exit();
  }

}
    public function upload($id)
    {
        if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {
            if (!is_dir('upload/pdf/'.$id.'/')) {
                mkdir('upload/pdf/'.$id, 0777, true);
            }

            $file_id 		= strip_tags($_POST['upload_file_ids']);

            $counter 		= strip_tags($_POST['counter']);
            $counter=(int)$counter+1;


            $config['file_name'] = $counter.'.pdf';

            $target_path = "./upload/pdf/".$id.'/';
            $target_path = $target_path.basename($config['file_name']);

            if (move_uploaded_file($_FILES['upload_file']['tmp_name'], $target_path)) {
                $data['update'] = array('pdf_file' => $counter, );

                $this->db->where('tracking_id', $id);
                $this->db->update('orders', $data['update']);

                $data['message']['file']="Uploaded";

                $return['type']='pdf';
                $return['response']=$file_id;
                echo json_encode($return);
            } else {
                $return['response']='system_error';
                echo json_encode($return);
            }
        }
    }

    public function getfile($id)
    {
        $source_url='https://biucs.com/demo/upload/xbrl/'.$id.'/output/Rall.htm';
        $local='upload/xbrl/'.$id.'/report.html';
        if (!is_dir('upload/xbrl/'.$id.'/')) {
            mkdir('upload/xbrl/'.$id, 0777, true);
        }
        $data['wget']=shell_exec('wget '.$source_url);
        $data['move']=shell_exec('mv Rall.htm '.$local);
        echo json_encode($data);
    }

    // public function newcompany(){
    //
    //   if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST")
    //   {
    //     if (!is_dir('upload/xls/'.'/')) {
    //         mkdir('upload/xls/', 0777, true);
    //     }
    //
    //
    //     $target_path = "./upload/xls/";
    //     $target_path = $target_path.basename($_FILES['upload_file']['name']);
    //
    //     if(move_uploaded_file($_FILES['upload_file']['tmp_name'], $target_path)) {
    //
    //
    //       $data['message']['file']="Uploaded";
    //
    //       $return['type']='xls';
    //       echo json_encode($return);
    //     } else{
    //       $return['response']='system_error';
    //       echo json_encode($return);
    //     }
    //
    //   }
    //
    //
    //
    //
    // }
    public function documents($id)
    {
        $this->load->model('Api_model');
        $data=$this->Api_model->documents($id);
        // echo $data;
        echo json_encode($data);
    }

    public function trademarks($id)
    {
        $this->load->model('Api_model');
        $data=$this->Api_model->trademarks($id);
        // echo $data;
        echo json_encode($data);
    }

    public function newcompany()
    {
        ini_set('max_execution_time', 0);
        if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {
            if (!is_dir('upload/xls/'.'/')) {
                mkdir('upload/xls/', 0777, true);
            }


            $target_path = "./upload/xls/";
            $target_path = $target_path.basename($_FILES['upload_file']['name']);

            if (move_uploaded_file($_FILES['upload_file']['tmp_name'], $target_path)) {
                $data['message']['file']="Uploaded";
                echo "Uploaded";
                // fastcgi_finish_request();
                $return['type']='xls';
                $this->load->library('SimpleXLSX');
                // $file_name='CompReg_13JULY2020.xlsx';
                // $file='./upload/xls/'.$file_name;
                if ($xlsx = SimpleXLSX::parse($target_path)) {
                    $sheet1=$xlsx->rows(0);
                    $company_found=sizeof($sheet1);
                    //   $company_found=10;
                    for ($i=2; $i <99; $i++) {
                        $roc=str_replace("RoC - ", "", $sheet1[$i][4]);
                        $data['insert']=array(
                      'cin'=>$sheet1[$i][0],
                      'name'=>$sheet1[$i][1],
                      'dateofincorporation'=>$sheet1[$i][2],
                      'state'=>$sheet1[$i][3],
                      'roc'=>$roc,
                      'category'=>$sheet1[$i][5],
                      'subCategory'=>$sheet1[$i][6],
                      'class'=>$sheet1[$i][7],
                      'authourisedCapital'=>$sheet1[$i][8],
                      'paidUpCaiptal'=>$sheet1[$i][9],
                      'NUMBER_OF_MEMBERS'=>$sheet1[$i][10],
                      'activity'=>$sheet1[$i][11],
                      'address'=>$sheet1[$i][12],
                      'status'=>'Active'

                  );
                        $this->db->insert('test', $data['insert']);
                        $this->newcompanyalert($data['insert']);
                    }
                    //   echo json_encode($data['insert']);
                } else {
                    echo SimpleXLSX::parseError();
                }

                redirect(base_url()."admin/dashboard/newcompany/?status=success");
            } else {
                $return['response']='system_error';
                echo json_encode($return);
            }
        }
    }

    public function newcompanyalert($inserted=null)
    {
        $this->db->select('*');
        $this->db->where('category', 'new incorporation');
        $this->db->where('status', 'paid');
        $orders=$this->db->get('orders');
        $data['orders']=$orders->result_array();

        foreach ($data['orders'] as $item) {
            if ($item['count']<=$item['alerts']) {
                $ALERT=false;

                $comparedata= json_decode($item['items'], true);
                // echo json_encode($comparedata['activity']);
                if ($comparedata['class']) {
                    if (array_search($inserted['class'], $comparedata['class'])) {
                        $ALERT=true;
                    }
                }

                if ($comparedata['cities']) {
                    if (array_search($inserted['roc'], $comparedata['cities'])) {
                        $ALERT=true;
                    }
                }
                if ($comparedata['activity']) {
                    if (array_search($inserted['activity'], $comparedata['activity'])) {
                        $ALERT=true;
                    }
                }
                if ($ALERT) {
                    $data['alert']=array(
                    'count'=>(int)$item['count']+1
                );
                    $this->db->where('tracking_id', $item['tracking_id']);
                    $this->db->update('orders', $data['alert']);

                    #
                    #DO notification and Mail here
                    #

                    $this->load->model('Common_model');
                    $array1=array(
                          'name' =>'New Company Alert',
                          'url' =>"Data/new_company_alert/".$inserted['cin'],
                          'status'       =>'0',
                          'user_id'    =>$item['user_id'],
                          );
                    $this->Common_model->SaveData('notification', $array1);
                }
            }
        }
    }

    // File upload
    public function upload_downloader($id)
    {
        $request = 1;
        if (isset($_POST['request'])) {
            $request = $_POST['request'];
        }
        if ($request == 1) {
            if (!empty($_FILES['file']['name'])) {
                if (!is_dir('upload/report/'.$id.'/')) {
                    mkdir('upload/report/'.$id, 0777, true);
                }
                $target_path = "./upload/report/".$id."/";
                $tmp = explode('.', $_FILES['file']['name']);
                $file_extension = end($tmp);
                $file_name=preg_replace("/\.[^.]+$/", "", $_FILES['file']['name']);
                $file_name=strtolower(trim(preg_replace('#\W+#', '_', $file_name), '_'));
                $file_name = $file_name.'.'.$file_extension;
                $target_path = $target_path.$file_name;
                $file_exists = file_exists ( $target_path );
                if($file_exists ) //If file does not exists then upload
                {
                echo 'Error: Duplicate file name, please change it!';
                  http_response_code(404);
                }

                $upload=move_uploaded_file($_FILES['file']['tmp_name'], $target_path);
                $data['files'] = array();
                if ($upload) {
                    $this->db->select('*');
                    $this->db->where('tracking_id', $id);
                    $query=$this->db->get('orders');
                    if ($query->num_rows()>0) {
                        $data['row']=$query->row_array();
                        if ($data['row']['files']) {
                            $data['files']=json_decode($data['row']['files']);
                            array_push($data['files'], $file_name);
                            $data['update'] = array('files' => json_encode($data['files']) );
                            $this->db->where('tracking_id', $id);
                            $this->db->update('orders', $data['update']);
                        } else {
                            array_push($data['files'], $file_name);
                            $data['update'] = array('files' => json_encode($data['files']) );
                            $this->db->where('tracking_id', $id);
                            $this->db->update('orders', $data['update']);
                        }
                    }
                }else{
                    echo 'Error: Upload Error--';
                    http_response_code(404);
                }
            }
            exit;
        }

        if (@$_POST['request']==2) {
            $file_list = array();

            // Target directory
            $dir = "./upload/report/".$id."/";
            $target_dir = "./upload/report/".$id."/";
            if (is_dir($dir)) {
                if ($dh = opendir($dir)) {

     // Read files
                    while (($file = readdir($dh)) !== false) {
                        if ($file != '' && $file != '.' && $file != '..') {

         // File path
                            $file_path = $target_dir.$file;

                            // Check its not folder
                            if (!is_dir($file_path)) {
                                $size = filesize($file_path);

                                $file_list[] = array('name'=>$file,'size'=>$size,'path'=>$file_path);
                            }
                        }
                    }
                    closedir($dh);
                }
            }

            echo json_encode($file_list);
            exit;
        }

        // Remove file
        if (@$_POST['request']==3) {
            $target_dir = "./upload/report/".$id."/";
            $tmp = explode('.', $_POST['file']);
            $file_extension = end($tmp);
            $file_name=preg_replace("/\.[^.]+$/", "", $_POST['file']);
            $file_name=strtolower(trim(preg_replace('#\W+#', '_', $file_name), '_'));
            $file_name = $file_name.'.'.$file_extension;

            $filename = $target_dir.$file_name;
            unlink($filename);

            $this->db->select('*');
            $this->db->where('tracking_id', $id);
            $query=$this->db->get('orders');
            if ($query->num_rows()>0) {
                $data['row']=$query->row_array();
                if ($data['row']['files']) {
                    $data['files']=json_decode($data['row']['files']);
                    $data['files']=array_diff($data['files'], [$file_name]);
                    $data['update'] = array('files' => json_encode(array_values($data['files'])) );
                    $this->db->where('tracking_id', $id);
                    $this->db->update('orders', $data['update']);
                }
            }
            exit;
        }
    }

    public function upload_documents($id)
    {
        $request = 1;
        if (isset($_POST['request'])) {
            $request = $_POST['request'];
        }
        if ($request == 1) {
            if (!empty($_FILES['file']['name'])) {
                if (!is_dir('upload/documents/'.$id.'/')) {
                    mkdir('upload/documents/'.$id, 0777, true);
                }
                $target_path = "./upload/documents/".$id."/";
                $tmp = explode('.', $_FILES['file']['name']);
                $file_extension = end($tmp);
                $file_name=preg_replace("/\.[^.]+$/", "", $_FILES['file']['name']);
                $file_name=strtolower(trim(preg_replace('#\W+#', '_', $file_name), '_'));
                $file_name = $file_name.'.'.$file_extension;
                $target_path = $target_path.$file_name;
                $upload=move_uploaded_file($_FILES['file']['tmp_name'], $target_path);
                $data['files'] = array();
                if ($upload) {
                    $this->db->select('*');
                    $this->db->where('tracking_id', $id);
                    $query=$this->db->get('orders');
                    if ($query->num_rows()>0) {
                        $data['row']=$query->row_array();
                        if ($data['row']['files']) {
                            $data['files']=json_decode($data['row']['files']);
                            array_push($data['files'], $file_name);
                            $data['update'] = array('files' => json_encode($data['files']) );
                            $this->db->where('tracking_id', $id);
                            $this->db->update('orders', $data['update']);
                        } else {
                            array_push($data['files'], $file_name);
                            $data['update'] = array('files' => json_encode($data['files']) );
                            $this->db->where('tracking_id', $id);
                            $this->db->update('orders', $data['update']);
                        }
                    }
                }
            }
            exit;
        }

        if (@$_POST['request']==2) {
            $file_list = array();

            // Target directory
            $dir = "./upload/documents/".$id."/";
            $target_dir = "./upload/documents/".$id."/";
            if (is_dir($dir)) {
                if ($dh = opendir($dir)) {

     // Read files
                    while (($file = readdir($dh)) !== false) {
                        if ($file != '' && $file != '.' && $file != '..') {

         // File path
                            $file_path = $target_dir.$file;
                            // Check its not folder
                            if (!is_dir($file_path)) {
                                $size = filesize($file_path);
                                $file_list[] = array('name'=>$file,'size'=>$size,'path'=>$file_path);
                            }
                        }
                    }
                    closedir($dh);
                }
            }

            echo json_encode($file_list);
            exit;
        }

        // Remove file
        if (@$_POST['request']==3) {
            $target_dir = "./upload/documents/".$id."/";
            $tmp = explode('.', $_POST['file']);
            $file_extension = end($tmp);
            $file_name=preg_replace("/\.[^.]+$/", "", $_POST['file']);
            $file_name=strtolower(trim(preg_replace('#\W+#', '_', $file_name), '_'));
            $file_name = $file_name.'.'.$file_extension;

            $filename = $target_dir.$file_name;
            unlink($filename);

            $this->db->select('*');
            $this->db->where('tracking_id', $id);
            $query=$this->db->get('orders');
            if ($query->num_rows()>0) {
                $data['row']=$query->row_array();
                if ($data['row']['files']) {
                    $data['files']=json_decode($data['row']['files']);
                    $data['files']=array_diff($data['files'], [$file_name]);
                    $data['update'] = array('files' => json_encode(array_values($data['files'])) );
                    $this->db->where('tracking_id', $id);
                    $this->db->update('orders', $data['update']);
                }
            }
            exit;
        }
    }


    public function generateXbrlDocuments($id)
    {
        $this->db->select('*');
        $this->db->where('tracking_id', $id);
        $query=$this->db->get('orders');
        $data['status']="";
        $strEnc = array();
        if ($query->num_rows()>0) {
            $data['row']=$query->row_array();
            if ($data['row']['files']) {
                $data['files']=json_decode($data['row']['files']);
                $i=0;
                foreach ($data['files'] as $files) {
                    $tmp = explode('.', $files);
                    $file_extension = end($tmp);
                    if ($file_extension=="xml") {
                        $xbrl_path[]=base_url().'upload/report/'.$id.'/'.$files;
                    }
                }
            }

            if(sizeof(@$xbrl_path)==1){
              $data['system']="single";
              $strPath="http://103.108.220.175/rest/xbrl/".$xbrl_path[0]."/facts?media=json&factListCols=Name,Label,Value,Period,Dimensions";
              $strEnc=urlencode($strPath);
              $cws="http://ec2-15-206-122-169.ap-south-1.compute.amazonaws.com:8080/CentralWebService/ConsumeAPIData.asmx/InsertDataINCWS?activity=menufacturing&isChargeDetails=false&strURL=".$strEnc;
              $ch = curl_init($cws);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
              $data['result'] = curl_exec($ch);
              curl_close($ch);
              $data['cws']=$cws;
              if($data['result']=="\"true\""){
                $masterapi = $cws="http://ec2-15-206-122-169.ap-south-1.compute.amazonaws.com:8080/CentralWebService/ConsumeAPIData.asmx/InsertDataINCWS?isChargeDetails=true&strURL=".urlencode(base_url('data/api/'.$data['row']['items']));
                $data['masterapi']=  $masterapi ;
                $ms=curl_init($masterapi);
                curl_setopt($ms, CURLOPT_RETURNTRANSFER, true);
                $data['master_result'] = curl_exec($ms);
                curl_close($ms);
              }
              $data['status']='Success';
              // break;
            }elseif (sizeof(@$xbrl_path)==2) {
              $data['system']="multiple";
              $path1="http://103.108.220.175/rest/xbrl/".$xbrl_path[0]."/facts?media=json&factListCols=Name,Label,Value,Period,Dimensions";
              $path2="http://103.108.220.175/rest/xbrl/".$xbrl_path[1]."/facts?media=json&factListCols=Name,Label,Value,Period,Dimensions";
              $TRIGGERS['path1']=$path1;
              $TRIGGERS['path2']=$path2;
              $TRIGGERS['id']=$id;
              $TRIGGERS['cin']=$data['row']['items'];
              $TRIGGERS_JSON=json_encode($TRIGGERS);
              $insert_data['data']=$TRIGGERS_JSON;
              $this->db->insert('triggers',$insert_data);
              $TRIGGERS_ID=$this->db->insert_id();
              // $CRON='0 * * * * curl -s "http://uat.kreditaid.com/triggers/apicheck" > /dev/null';
              $CRON='*/1 * * * * curl -s "http://uat.kreditaid.com/triggers/multixbrl/'.$TRIGGERS_ID.'" > /dev/null';
              // echo $strEnc[0];
              // exec($CRON);
              file_put_contents('/tmp/crontab.txt', $CRON.PHP_EOL);
              exec('crontab /tmp/crontab.txt');
              $data['status']='Success';
            }
        }
        echo json_encode($data);
    }


    public function changeReportMethod()
    {
        // echo json_encode($_POST);
        $data = array();
        $data['update']['user_id']=$_POST['to'];
        $this->db->where('task_id', $_POST['tracking_id']);
        $this->db->where('roll', $_POST['roll']);
        $this->db->update('task', $data['update']);
        if ($this->db->affected_rows()) {
            $data['message']['status']='Success';
            $array1=array(
                'name' =>'Report For Downloader',
                'type'=>'downloader',
                'production_user'=>'0',
                );
            $this->Common_model->SaveData('notification', $array1);
        } else {
            $data['message']['status']='Error';
        }
        echo json_encode($data);
    }




    public function assign_to_data_analyst()
    {
        $data = array();
        $this->db->select('*');
        $this->db->where('tracking_id', $_POST['tracking_id']);
        $query = $this->db->get('orders');
        $order= $query->row_array();
        $insert = array(
        'user_id' => $_POST['to'],
        'task_id' => $_POST['tracking_id'],
        'roll' => $_POST['roll'],
        'type' => $order['category'],
        'status' => "Active",
       );
        $this->db->insert('task', $insert);
        if ($this->db->affected_rows()) {
            $data['message']['status']='Success';
            $array1=array(
                'name' =>'Report For DA',
                'type'=>'da',
                'url'=>'admin/dashboard/downloader',
                'production_user'=>'0',
                );
            $this->Common_model->SaveData('notification', $array1);
        } else {
            $data['message']['status']='Error';
        }
        echo json_encode($data);
    }

    public function assign_to_FA()
    {
        $data = array();
        $this->db->select('*');
        $this->db->where('tracking_id', $_POST['tracking_id']);
        $query = $this->db->get('orders');
        $order= $query->row_array();
        $data['session_user']=$this->session->userdata('admin_in');
          $user_id=$data['session_user']['id'];
        $insert = array(
        'user_id' => $_POST['to'],
        'task_id' => $_POST['tracking_id'],
        'roll' => $_POST['roll'],
        'type' => $order['category'],
        'status' => "Active",
       );
        // echo json_encode($insert);
        // exit;
        $this->db->insert('task', $insert);
        if ($this->db->affected_rows()) {
            $data['message']['status']='Success';
            $array1=array(
                'name' =>'Report For FA',
                'type'=>'fa',
                'url'=>'admin/dashboard/financial_analyst',
                'production_user'=>'0',
                'user_id'=>$user_id,
                'order_id'=>$_POST['tracking_id'],
                );
            $this->Common_model->SaveData('notification', $array1);
        } else {
            $data['message']['status']='Error';
        }
        echo json_encode($data);
    }


    public function showProUsers()
    {
        $data = array();
        $data['user_roll']=$_POST['roll'];
        $data['Proll']="";
        $data['tracking_id']=$_POST['tracking_id'];

        if ($_POST['roll']=='FA') {
            $data['Proll']='Financial Analyst';
        }
        if ($_POST['roll']=='DA') {
            $data['Proll']='Data Analyst';
        }
        if ($_POST['roll']=='downloader') {
            $data['Proll']='Downloader';
        }
        $this->db->select('*');
        $query = $this->db->get('admin');
        $data['Pro']= $query->result_array();
        $this->load->view('admin/components/showProUsers', $data);
    }
    public function showDaUSers()
    {
        $data = array();
        $data['user_roll']='DA';
        $data['Proll']="";
        $data['tracking_id']=$_POST['tracking_id'];
        $data['Proll']='Data Analyst';
        $this->db->select('*');
        $query = $this->db->get('admin');
        $data['Pro']= $query->result_array();
        $this->load->view('admin/Downloader/showPro', $data);
    }

    public function showUserBackFromFA()
    {
        $data = array();
        $data['user_roll']='DA';
        $data['Proll']="";
        $data['tracking_id']=$_POST['tracking_id'];
        $data['Proll']='Data Analyst';
        $this->db->select('*');
        $query = $this->db->get('admin');
        $data['Pro']= $query->result_array();
        $this->load->view('admin/FA/returntoDA', $data);
    }



    public function showFAUSers()
    {
        $data = array();
        $data['user_roll']='FA';
        $data['Proll']="";
        $data['tracking_id']=$_POST['tracking_id'];
        $data['Proll']='Financial Analyst';
        $this->db->select('*');
        $query = $this->db->get('admin');
        $data['Pro']= $query->result_array();
        $this->load->view('admin/DA/showFAUSers', $data);
    }

    public function showFAUsersBack()
    {
        $data = array();
        $data['user_roll']='Downloader';
        $data['Proll']="";
        $data['tracking_id']=$_POST['tracking_id'];
        $data['Proll']='Data Analyst';
        $this->db->select('*');
        $query = $this->db->get('admin');
        $data['Pro']= $query->result_array();
        $this->load->view('admin/FA/returntoDA', $data);
    }
    public function showDAUsersBack()
    {
        $data = array();
        $data['user_roll']='Downloader';
        // $data['Proll']="";
        $data['tracking_id']=$_POST['tracking_id'];
        $data['Proll']='Downloader';
        $this->db->select('*');
        $query = $this->db->get('admin');
        $data['Pro']= $query->result_array();
        $this->load->view('admin/DA/returntoDownloader', $data);
    }

    public function assign_back_to_downloader()
    {
        $data = array();
        $this->db->select('*');
        $this->db->where('tracking_id', $_POST['tracking_id']);
        $query = $this->db->get('orders');
        $order= $query->row_array();
        $insert = array(
        'user_id' => $_POST['to'],
        'task_id' => $_POST['tracking_id'],
        'roll' => $_POST['roll'],
        'type' => $order['category'],
        'status' => "Active",
       );
        // echo json_encode($insert);
        // exit;
        $this->db->insert('task', $insert);
                $data['session_user']=$this->session->userdata('admin_in');
          $user_id=$data['session_user']['id'];
        if ($this->db->affected_rows()) {
            $data['message']['status']='Success';
            $array1=array(
                'name' =>'Returned From FA',
                'type'=>'downloader',
                'url'=>'admin/dashboard/downloader',
                'production_user'=>'0',
                 'user_id'=>$user_id,
                'order_id'=>$_POST['tracking_id'],
                );
            $this->Common_model->SaveData('notification', $array1);
        } else {
            $data['message']['status']='Error';
        }
        echo json_encode($data);
    }

    public function assign_back_to_DA()
    {
        $data = array();
        $this->db->select('*');
        $this->db->where('tracking_id', $_POST['tracking_id']);
        $query = $this->db->get('orders');
        $order= $query->row_array();
        $insert = array(
        'user_id' => $_POST['to'],
        'task_id' => $_POST['tracking_id'],
        'roll' => $_POST['roll'],
        'type' => $order['category'],
        'status' => "Active",
       );
        // echo json_encode($insert);
        // exit;
        $this->db->insert('task', $insert);
                $data['session_user']=$this->session->userdata('admin_in');
          $user_id=$data['session_user']['id'];
        if ($this->db->affected_rows()) {
            $data['message']['status']='Success';
            $array1=array(
                'name' =>'Returned From FA',
                'type'=>'downloader',
                'url'=>'admin/report/final_report/'.$task_id,
                'production_user'=>'0',
                 'user_id'=>$user_id,
                'order_id'=>$_POST['tracking_id'],
                );
            $this->Common_model->SaveData('notification', $array1);
        } else {
            $data['message']['status']='Error';
        }
        echo json_encode($data);
    }


    public function getPUTask()
    {
        // $data = array();
      // $data['user_roll']='FA';
      // $data['Proll']="";
      // $data['tracking_id']=$_POST['tracking_id'];
      // $data['Proll']='Financial Analyst';
      // $this->db->select('*');
      // $query = $this->db->get('admin');
      // $data['Pro']= $query->result_array();
      // $this->load->view('admin/DA/showFAUSers', $data);
    }
    public function sendDocToUsers()
    {
        $message='';
        $data['tracking_id']=$_POST['tracking_id'];
        $data['update'] = array(
        'assigned' => 'User',
        'comment'=>'Completed  <p>& Sent to User</p>',
        'da'=>'completed',
        'fa'=>'completed',
        'downloader'=>'completed',
        'product_status'=>'completed',
        'production_status'=>'completed',
      );
        $this->db->where('tracking_id', $data['tracking_id']);
        $this->db->update('orders', $data['update']);
        if ($this->db->affected_rows()) {
            $message='Success';
        } else {
            $message='Error';
        }
        return $message;
    }

    public function createChart($id)
    {
        $data = array();
        $message = "";
        $data['update'] = array(
        'tracking_id' => $id,
        'dataname'=>json_encode($this->input->post('dataname')),
        'datavalue'=>json_encode($this->input->post('datavalue')),
       );
        $this->db->select('*');
        $this->db->where('tracking_id', $id);
        $this->db->limit(1);
        $query = $this->db->get('charts');
        if ($query->num_rows() == 1) {
            $this->db->where('tracking_id', $id);
            $this->db->update('charts', $data['update']);
        } else {
            $this->db->insert('charts', $data['update']);
        }
        if ($this->db->affected_rows() > 0) {
            $data['status'] = 'Success';
            unset($_POST);
        } else {
            $data['status'] = 'Error';
        }
        echo json_encode($data);
    }
    public function getDocuments()
    {
        $data = array();
        $id=$_POST['tracking_id'];

        $file_list = array();

        // Target directory
        $dir = "./upload/documents/".$id."/";
        $target_dir = "./upload/documents/".$id."/";
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    if ($file != '' && $file != '.' && $file != '..') {
                        $file_path = $target_dir.$file;
                        if (!is_dir($file_path)) {
                            $size = filesize($file_path);
                            $file_list[] = array('name'=>$file,'size'=>$size,'path'=>$file_path);
                        }
                    }
                }
                closedir($dh);
            }
        }

        echo json_encode($file_list);
    }

    public function getXbrls()
    {
        $data = array();
        $id=$_POST['tracking_id'];

        $file_list = array();

        // Target directory
        $dir = "./upload/report/".$id."/";
        $target_dir = "./upload/report/".$id."/";
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    if ($file != '' && $file != '.' && $file != '..') {
                        $file_path = $target_dir.$file;
                        if (!is_dir($file_path)) {
                            $size = filesize($file_path);
                            $file_list[] = array('name'=>$file,'size'=>$size,'path'=>$file_path);
                        }
                    }
                }
                closedir($dh);
            }
        }

        echo json_encode($file_list);
    }


    public function documentsData(){
      $id=$this->input->post('tracking_id');
      $data = array();
      $message = "";
      $data['update'] = array(
      'tracking_id' => $id,
      'name'=>json_encode($this->input->post('name')),
      'path'=>json_encode($this->input->post('path')),
      'filename'=>json_encode($this->input->post('file')),
      'category'=>json_encode($this->input->post('category')),
      'date'=>json_encode($this->input->post('date')),
     );
      $this->db->select('*');
      $this->db->where('tracking_id', $id);
      $this->db->limit(1);
      $query = $this->db->get('uploads');
      if ($query->num_rows() == 1) {
          $this->db->where('tracking_id', $id);
          $this->db->update('uploads', $data['update']);
      } else {
          $this->db->insert('uploads', $data['update']);
      }
      $data['get_files']=$this->Common_model->get_single('orders',"tracking_id='".$id."'");
      //print_r($data['get_files']->user_id); exit;
    $get_users=$this->Common_model->get_single('users',"id='".$data['get_files']->user_id."'");
    $array1=array(
              'name' =>'Completed Document',
              'status'=>'0',
              'url'=>'dashboard',
              'user_id'=>$data['get_files']->user_id,
                'order_id'=>$id,
              );
          $this->Common_model->SaveData('notification',$array1);
       $subject="Completed Document";
       $to=$get_users->email;
       $id="1";
       $view='emails/production_user_document';
      $this->Send_mail->send($id,$to,$view,$subject,$data);
      if ($this->db->affected_rows() > 0) {
          $data['status'] = 'Success';
          unset($_POST);
      } else {
          $data['status'] = 'Error';
      }
      echo json_encode($data);
    }

    public function xbrlData(){
      $id=$this->input->post('tracking_id');
      $data = array();
      $message = "";
      $data['update'] = array(
      'tracking_id' => $id,
      'h1'=>json_encode($this->input->post('name')),
      'h2'=>json_encode($this->input->post('path')),
      'h3'=>json_encode($this->input->post('file')),
      'category'=>json_encode($this->input->post('category')),
     );
      $this->db->select('*');
      $this->db->where('tracking_id', $id);
      $this->db->limit(1);
      $query = $this->db->get('uploads');
      if ($query->num_rows() == 1) {
          $this->db->where('tracking_id', $id);
          $this->db->update('uploads', $data['update']);
      } else {
          $this->db->insert('uploads', $data['update']);
      }
      $get_files=$this->Common_model->get_single('orders',"tracking_id='".$id."'");
    $get_users=$this->Common_model->get_single('users',"id='".$get_files->user_id."'");
    $array1=array(
              'name' =>'Completed Document',
              'status'=>'0',
              'url'=>'dashboard',
              'user_id'=>$get_files->user_id,
              'order_id'=>$id,
              );
          $this->Common_model->SaveData('notification',$array1);
       $subject="Completed Document";
       $to=$get_users->email;
       $id="1";
       $view='emails/contact_form';
      $this->Send_mail->send($id,$to,$view,$subject,$data);
      if ($this->db->affected_rows() > 0) {
          $data['status'] = 'Success';
          unset($_POST);
      } else {
          $data['status'] = 'Error';
      }
      echo json_encode($data);
    }

    public function scrappers(){
      $data=array();
      // echo json_encode($_POST);
      // exit;
      $data['cin']=$this->input->post('cin');
      $type=$this->input->post('type');
      if(@$type=='basic'){
        $url='https://safeapi.cf/master?cin=';
        $json=@file_get_contents($url.$data['cin']);
        $data['json'] = json_decode($json);
        $data['status']=200;
      }
      if(@$type=='Charges'){
        $url='https://safeapi.cf/charges?cin=';
        $json=@file_get_contents($url.$data['cin']);
        $data['json'] = json_decode($json);
        $data['status']=200;
      }
      if(@$type=='Documents'){
        $url='https://safeapi.cf/doc?cin=';
        $json=@file_get_contents($url.$data['cin']);
        $data['json'] = json_decode($json);
        $data['status']=200;
      }
      if(@$type=='Trademarks'){
        $url='https://safeapi.cf/trade?cin=';
        $json=@file_get_contents($url.$data['cin']);
        $data['json'] = json_decode($json);
        $data['status']=200;
      }
      if(@$type=='Directors'){
        $url='https://safeapi.cf/getdir?cin=';
        $json=@file_get_contents($url.$data['cin']);
        $data['json'] = json_decode($json);
        $data['status']=200;
      }


      echo json_encode($data);
    }

    public function taxanomy(){
      // echo "ok";
      // exit;
      $xbrl_path="http://103.108.220.175/rest/xbrl/https://uat.kreditaid.com/upload/report/WF5InCvuVg/flipkart_ind_as.xml/facts?media=json&factListCols=Name,Label,Value,Period,Dimensions";

      $taxanomy=file_get_contents($xbrl_path);
      echo $taxanomy;
      exit;
      $result=json_decode($taxanomy);
      foreach ( $result->factList as $fact) {
        $name = explode(':', $fact[1]->name);
        $name=$name[1];
        $value=@$fact[2]->value;
        if($name=="EquityShareCapital"){
          echo "IND-AS";
          exit;
        }elseif ($name=="ShareCapital") {
          echo "CI";
          exit;
        }
      }
    }
    public function exportdata(){
      $sql = "SELECT DISTINCT (activity) from company";
      $query=$this->db->query($sql);
      $data=$query->result_array();
      // echo json_encode($data);
      foreach ($data as $item) {
        echo $item['activity'].'<br>';
      }
    }

    public function multitest(){
      $path_first="http://103.108.220.175/rest/xbrl/https://uat.kreditaid.com/upload/ad1.xml/facts?media=json&factListCols=Name,Label,Value,Period,Dimensions";
      $path_seconad="http://103.108.220.175/rest/xbrl/https://uat.kreditaid.com/upload/ad2.xml/facts?media=json&factListCols=Name,Label,Value,Period,Dimensions";
      $xbrl_first=file_get_contents($path_first);
      $xbrl_second=file_get_contents($path_seconad);
      $result_first=json_decode($xbrl_first);
      $result_second=json_decode($xbrl_second);

    }

    public function testmulti(){
      $data=['hello','Amit'];
      $this->multitest2($data);
    }

    public function multitest2($path = array()){
      $path_first=$path[0];
      $xbrl_first=file_get_contents($path_first);
      for ($i=1; $i < sizeof($path); $i++) {
        // code...
      }
      $result_first->factList= array_merge($result_first->factList,$result_second->factList);
      echo json_encode($result_first);
    }
}
