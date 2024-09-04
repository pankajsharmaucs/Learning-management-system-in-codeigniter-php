<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once "/var/www/html/tools/MTS/EnableMTS.php";
class Jobs extends CI_Controller
{
  public function __construct()
  {
      parent::__construct();
  }


      public function mca(){

        $this->db->select('*');
        $this->db->where('status','initiated');
        $this->db->where('type','master');
        $this->db->order_by('id',"ASC");
        $this->db->limit(1);
        $query=$this->db->get('jobs');
        $data['MCA_JOBS']=$query->row_array();
        if($query->num_rows()){
          $cin=$data['MCA_JOBS']['cin'];
          $shellObj    = \MTS\Factories::getDevices()->getLocalHost()->getShell('bash', false);
          $url=base_url('api/mcadata/').$cin;
          $cmd='curl  -s "'.$url.'" > /dev/null &';
          shell_exec($cmd);
      }

    }

    public function mca_local(){

      $this->db->select('*');
      $this->db->where('status','initiated');
      $this->db->order_by('id',"ASC");
      $this->db->limit(1);
      $query=$this->db->get('local_mca');
      $data['MCA_JOBS']=$query->row_array();
      if($query->num_rows()){
        $cin=$data['MCA_JOBS']['cin'];
        $shellObj    = \MTS\Factories::getDevices()->getLocalHost()->getShell('bash', false);
        $url=base_url('api/mcadata/').$cin;
        $cmd='curl  -s "'.$url.'" > /dev/null &';
        shell_exec($cmd);

    }



  }


      public function mca_check(){
        $cin='L22210MH1995PLC084781';
        $shellObj    = \MTS\Factories::getDevices()->getLocalHost()->getShell('bash', false);
        $url="http://34.73.235.212//master?cin=".$cin."&pool=20&slack=20";
        $cmd='curl  -s "'.$url.'" > /dev/null &';
        shell_exec($cmd);

        $data['cron']['cin']=$cin;
        $data['cron']['type']='Check';
        $data['cron']['status']='initiated';
        $this->db->insert('jobs',$data['cron']);

      }

}
