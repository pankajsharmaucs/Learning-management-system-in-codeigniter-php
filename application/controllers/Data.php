<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Controller Home
 *
 * @package   UCS
 * @category  Frontend
 * @param     ...
 * @return    ...
 *
 */

class Data extends CI_Controller
{
  public function __construct()
  {
      parent::__construct();
      Utils::no_cache();
       $this->load->model('Common_model');
        // $this->load->library(array('session','form_validation','image_lib','upload'));
         $this->load->model('Cart_model');

  }

  public function test2(){
    $start=1;
    $end=100;
    $this->db->select('id,CIN');
    $this->db->where('id>',$start);
    $this->db->where('id<',$end);
    $this->db->where('roc',NULL);
    $query=$this->db->get('mcacomp');
    $data['result']=$query->result_array();
    echo json_encode($data['result']);
    for ($i=0; $i < sizeof($data['result']); $i++) {
      echo $data['result'][$i]['CIN'];
    }
  }

  public function index()
  {
    $data=array();
    $startDate='2016-04-01';
    $endDate='2020-04-30';
    $this->db->select('name,id,dateofincorporation');
    $this->db->where('dateofincorporation BETWEEN "'. date('Y-m-d', strtotime($startDate)). '" and "'. date('Y-m-d', strtotime($endDate)).'"');
    // $this->db->limit(100);
    $query = $this->db->get('company');
    echo $query->num_rows();
    // $data['mca'] = $query->result_array();
    // foreach ($data['mca'] as $item) {
    //   echo "ID : ".$item['id'].' Name : '.$item['name'].' Date : '.$item['dateofincorporation'].'<br>';
    //
    // }

  }
    public function doi()
    {
      $data=array();
      $this->db->select('dateofincorporation,id');
      // $this->db->limit(10);
      $this->db->where("DATE(STR_TO_DATE(`dateofincorporation`, '%d/%m/%Y')) IS  NULL");
      $query = $this->db->get('company');
      $data['mca'] = $query->result_array();

      $i=0;
      $j=0;
      $data['date']['doi']=[];

      foreach ($data['mca'] as $item) {
        $i++;$j++;
        echo $i.'where Date to be converted : '.$item['dateofincorporation'].'<br>';
        // $dateTime = DateTime::createFromFormat('d/m/Y', $item['dateofincorporation']);
        // $data['date']['doi']= $dateTime->format('Y-m-d');
        $data['date']['doi']= $item['dateofincorporation'];
        $this->db->where('id',$item['id']);
        $this->db->update('company',$data['date']);
        if($this->db->affected_rows()>0){
          if($j>10000){
            sleep(5);
            $j=0;
            echo " Proccessed : ".$i.' <br>';
          }
        }
      }

    }

    public function companytracker(){
      $data = array();
      $this->db->select('*');
      $this->db->where('category', 'Track a Company');
      $this->db->where('status', 'paid');
      $this->db->where('count', 0);
      $querymaster = $this->db->get('orders');
      $this->load->model('Common_model');
      $data['track']= $querymaster->result_array();

      foreach ($data['track'] as $item) {
      $data['tracker'][$item['tracking_id']]=$this->trackcompany($item['items']);

      $user_id=$item['user_id'];
      $subject="Track a Company Alert";
      $runconfig=FALSE;
      if($data['tracker'][$item['tracking_id']]['doc']){
        $runconfig=true;
      }
      if($data['tracker'][$item['tracking_id']]['master']['name']){
        $runconfig=true;
      }
      if($data['tracker'][$item['tracking_id']]['master']['paidUpCaiptal']){
        $runconfig=true;
      }
      if($data['tracker'][$item['tracking_id']]['master']['authourisedCapital']){
        $runconfig=true;
      }
      if($data['tracker'][$item['tracking_id']]['master']['address']){
        $runconfig=true;
      }
      if($data['tracker'][$item['tracking_id']]['master']['listedOrUnlisted']){
        $runconfig=true;
      }
      if($runconfig){
        $array1=array(
                //  'page_id' =>'',
                  'name' =>$subject,
                  'title' =>$data['tracker'][$item['tracking_id']]['master']['name'],
                 'url' =>"Data/trackcompany_list/".$item['tracking_id'],
                  'status'       =>'0',
                  'user_id'    =>$user_id,
                  );
              $this->Common_model->SaveData('notification',$array1);

                  $data['alert']=array(
                  'count'=>1,
              );
                  $this->db->where('tracking_id', $item['tracking_id']);
                  $this->db->update('orders', $data['alert']);
              $data_array=array(
            'tracking_id'=>$item['tracking_id'],
            'data'=>json_encode($data['tracker'][$item['tracking_id']]),
          );
            $this->Common_model->SaveData('tracker',$data_array);

        }
      }
    //  echo $data['tracker'];
       echo json_encode($data);

    }

    public function trackcompany($id){
        $CHECK = array();
        $this->load->model('Api_model');
        $data=$this->Api_model->trackcompany($id);
        $CHECK['doc']=[];
        $CHECK['master']=[];
        for ($i=0; $i < sizeof($data['new']) ; $i++) {
          $check=false;
          for ($j=0; $j < sizeof($data['current']) ; $j++) {
            if($data['new'][$i]['title']==$data['current'][$j]['title']){
              $check=true;
            }
          }
          if(!$check){
            $CHECK['doc'][]=$data['new'][$i]['title'];
          }

        }

        $CHECK['master']['name']='';
        $CHECK['master']['authourisedCapital']='';
        $CHECK['master']['paidUpCaiptal']='';
        $CHECK['master']['listedOrUnlisted']='';
        $CHECK['master']['address']='';
        if($this->dataFormatter($data['master_current']['name'])!==$this->dataFormatter($data['master_new'][3])){
          $CHECK['master']['name']=$data['master_new'][3];
        }
        if($this->numberformator($data['master_current']['authourisedCapital'])!==$this->stringFormat($data['master_new'][15])){
          $CHECK['master']['authourisedCapital']=$data['master_new'][15];
        }
        if($this->numberformator($data['master_current']['paidUpCaiptal'])!==$this->stringFormat($data['master_new'][17])){
          $CHECK['master']['paidUpCaiptal']=$data['master_new'][17];
        }
        if($this->dataFormatter($data['master_current']['listedOrUnlisted'])!==$this->dataFormatter($data['master_new'][25])){
          $CHECK['master']['listedOrUnlisted']=$data['master_new'][25];
        }
        if( $this->dataFormatter($data['master_current']['address'])!==$this->dataFormatter($data['master_new'][33])){
          $CHECK['master']['address']=$data['master_new'][33];
        }

        return $CHECK;
    }

    private function dataFormatter($str){
         $str=str_replace(' ', '', $str);
         $str=str_replace('-', '', $str);
         $str=preg_replace('/[^A-Za-z0-9\-]/', '', $str);
         $str=strtolower($str);
         return $str;
    }
    private function numberformator($str){
         $str=number_format((int)$str, 2);
         $str=str_replace(' ', '', $str);
         return $str;
    }

    private function stringFormat($str){
         $str=str_replace(' ', '', $str);
         return $str;
    }
    public function trackcompany_list($id)
    {
      $data['title'] = 'Company Tracker';
      if(@$this->session->userdata('logged_in')){
          $data['session_user']=$this->session->userdata('logged_in');
          $data['Cart']=0;
          $uid=$data['session_user']['id'];
        //  print_r($uid); exit;
          $this->load->model('Cart_model');
          if($this->Cart_model->getUserCartCount($uid)){
             $data['Cart'] =$this->Cart_model->getUserCartCount($uid);
         }
         $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$uid."' and status='0'");
         $data['count']=count($data['notify']);
      }
        $this->db->select('*');
        $this->db->where('tracking_id',$id);
        $this->db->order_by('id',"DESC");
        $this->db->limit(1);
        $querymaster = $this->db->get('tracker');
        $data['get_tacker']= $querymaster->row_array();
          $this->load->model('Crud_model');
          $cond="o.count= 0";
        $data['get_tracker_list']=$this->Crud_model->trackcompany_detail($cond);
      //  print_r($data['get_tracker_list']); exit;
        $this->load->view('inc/header',$data,false);
        $this->load->view('track_data/company_track_list',$data);
        $this->load->view('inc/footer',$data, false);
    }

    public function new_company_alert($id)
    {
      $data['title'] = 'Kreditaid | Home';
      $this->load->model('Common_model');
        if(@$this->session->userdata('logged_in')){
            $data['session_user']=$this->session->userdata('logged_in');
            $data['Cart']=0;
            $uid=$data['session_user']['id'];
            $this->load->model('Cart_model');
            if($this->Cart_model->getUserCartCount($uid)){
               $data['Cart'] =$this->Cart_model->getUserCartCount($uid);
           }
           $data['notify']=$this->Common_model->GetData('notification',"","user_id='".$uid."' and status='0'");
           $data['count']=count($data['notify']);
        }

        $this->db->select('*');
        $this->db->where('cin',$id);
        $this->db->limit(1);

        $querymaster = $this->db->get('test');
        $data['company']= $querymaster->row_array();
        $this->load->view('inc/header', $data, false);
        $this->load->view('track_data/new_company_alert_list',$data);
        $this->load->view('inc/footer', $data, false);
    }

    public function trademarks_count($id){
      $counter='https://safeapi.cf/trade?cin='.$id;
      $counter=@file_get_contents($counter);
      $counter=str_replace(" records found",'',$counter);
      $data['counter']=(int)$counter;
      echo $data['counter'];
    }

    public function trade($id){
            $page=$_GET['page'];
            $counter='https://safeapi.cf/trade?cin='.$id;
            $counter=@file_get_contents($counter);
            $counter=str_replace(" records found",'',$counter);
            $data['counter']=(int)$counter;
            if($data['counter']){

                $source='https://safeapi.cf/gettrade?cin='.$id.'&page='.$page;
                $data['source']=json_decode(@file_get_contents($source),true);
                $data['size']=sizeof($data['source']);
                $data['page']=$page;
                for ($i=0; $i < $data['size']/3; $i+=3) {
                    $data['trademark'][$i]=$data['source'][$i];
                    $detail=$data['source'][$i+2];
                    // $detail=str_replace("[<div class","<div class",$data['source'][$i+2]);
                    // $detail=str_replace("</div>]","</div",$detail);
                    // $detail=str_replace("details: [","",$detail);
                    // $detail=str_replace("]","",$detail);
                    // echo $detail;
                // break;
                    $data['class'][$i]=$data['source'][$i+1];
                    $data['detail'][$i]=$detail;
                }
              $show=  $this->load->view('trademarks',$data,true);
              echo $show;
            }

        }

        public function test(){
          $source_url='https://biucs.com/demo/upload/xbrl/4PIqV3f6MH/data.json';

          $file=@file_get_contents($source_url);
          if($file){
            $result=json_decode($file);
            foreach ($result->factList as $fact) {
              $name = explode(':', $fact[1]->name);
              $name=$name[1];
              $value=@$fact[2]->value;
              $date=@$fact[2]->endInstant;
              $start=@$fact[2]->start;
              $dimensions=@$fact[2]->dimensions;

              $data[$name]['value'][]=$value;
              $data[$name]['end'][]=$date;
              $data[$name]['start'][]=$start;
              $data[$name]['dimensions'][]=$dimensions;
            }
          }
          echo json_encode($data);
        }

        public function api($id){
          $this->load->model('Api_model');
          // $source_url='http://35.231.199.136:34/master?pool=5&slack=5&cin='.$id;
          // $fileContents= @file_get_contents($source_url);
          // $result=json_decode($fileContents);
          $this->db->select('*');
          $this->db->where('cin',$id);
          $query=$this->db->get('mca_directors');
          $result['director']=$query->result_array();


          $this->db->select('*');
          $this->db->where('cin',$id);
          $this->db->where('type','master');
          $query=$this->db->get('mca_scrapper');
          $result['master']=$query->row_array();
          $result['master']=json_decode($result['master']['data']);
          $result['master']=$result['master']->Company;


          $this->db->select('*');
          $this->db->where('cin',$id);
          $query=$this->db->get('mca_charges');
          $result['charges']=$query->result_array();


          $this->db->select('activity');
          $this->db->where('cin',$id);
          $query=$this->db->get('company');
          $result['database']=$query->row_array();
          // $data['charges']=$this->Api_model->charges($id);
          echo json_encode($result);
        }


        public function apimaster($id){
          $this->load->model('Api_model');
          $data['master']=$this->Api_model->master($id);
          // $data['charges']=$this->Api_model->charges($id);
          // echo json_encode($data);
        }




}
