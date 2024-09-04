<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Triggers extends CI_Controller
{
      public function test($id){
        $content='okddds';
        if (!is_dir('multiple/'.$id.'/')) {
            mkdir('multiple/'.$id, 0777, true);
        }
        $fp = fopen('multiple'.'/'.$id.'/'.'data.json', 'w');
        fwrite($fp, $content);
        fclose($fp);
        // $TRIGGERS_ID=1;
        // $CRON='*/1 * * * * curl -s "http://uat.kreditaid.com/triggers/multi_first/'.$TRIGGERS_ID.'" > /dev/null';
        // echo $strEnc[0];
        // exec($CRON);
        // $output = shell_exec('whoami');
        // echo $output."<br>";
        // $output = shell_exec('crontab -l');
        // file_put_contents('/tmp/crontab.txt', $output.$CRON.PHP_EOL);
        // echo exec('crontab /tmp/crontab.txt');
        // echo $output;
      }


      public function apicheck(){
        $src="http://35.231.54.194:34/master?cin=L22210MH1995PLC084781&pool=10&slack=10";
        $json = file_get_contents($src);
        $data = json_decode($data);
        echo $data['Company'];
      }

      public function multixbrl($id){
        $output='';
        file_put_contents('/tmp/crontab.txt', $output.PHP_EOL);
        echo exec('crontab /tmp/crontab.txt');
        $this->db->select('*');
        $this->db->where('id',$id);
        $query=$this->db->get('triggers');
        $Triggers=$query->row_array();
        $Triggers= json_decode($Triggers['data'],true);
        // echo $Triggers['id'];
        // $xbrl_first=file_get_contents($Triggers['path1']);
        // $xbrl_second=file_get_contents($Triggers['path2']);
        // $result_first=json_decode($xbrl_first);
        // $result_second=json_decode($xbrl_second);
        // $result_first->factList= array_merge($result_first->factList,$result_second->factList);
        if (!is_dir('multiple/'.$id.'/')) {
            mkdir('multiple/'.$id, 0777, true);
        }
        $fp = fopen('multiple'.'/'.$id.'/'.'data.json', 'w');
        fwrite($fp, json_encode($Triggers));
        fclose($fp);
        $multistrPath=urlencode(base_url().'multiple'.'/'.$id.'/'.'data.json');
        $cws="http://ec2-52-66-255-58.ap-south-1.compute.amazonaws.com:8080/ConsumeKAData.asmx/InsertDataINCWS?isChargeDetails=false&strURL=".$multistrPath;
        $ch = curl_init($cws);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data['result'] = curl_exec($ch);
        curl_close($ch);
        $data['cws']=$cws;
        if($data['result']=="\"true\""){
          $masterapi = $cws="http://ec2-52-66-255-58.ap-south-1.compute.amazonaws.com:8080/CentralWebService/ConsumeAPIData.asmx/InsertDataINCWS?isChargeDetails=true&strURL=".urlencode(base_url('data/api/'.$data['row']['items']));
          $data['masterapi']=  $masterapi ;
          $ms=curl_init($masterapi);
          curl_setopt($ms, CURLOPT_RETURNTRANSFER, true);
          $data['master_result'] = curl_exec($ms);
          curl_close($ms);
        }
        $data['status']='Success';

      }

}
