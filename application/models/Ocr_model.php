
<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once "/var/www/tools/MTS/EnableMTS.php";


class Ocr_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAttachment($id,$pdf)
    {
      $shellObj    = \MTS\Factories::getDevices()->getLocalHost()->getShell('bash', false);
      $output[]= $shellObj->exeCmd('python3 /var/www/html/dev/main.py upload/report/'.$id.'/'.$pdf.' '.$id);
      return $output;

    }
    public function extractAttachment($id,$name)
    {
      $shellObj    = \MTS\Factories::getDevices()->getLocalHost()->getShell('bash', false);
      $output= $shellObj->exeCmd('python3 /var/www/html/dev/main.py upload/report/'.$id.'/'.$name.' '.$id);
      // $output[]=$shellObj->exeCmd('mv ./attachment.pdf ./upload/pdf/'.$id.'/attachment.pdf');
      return $output;
    }
    public function do_ocr($id,$tracking_id,$name,$type,$heads,$Category)
    {
      $shellObj    = \MTS\Factories::getDevices()->getLocalHost()->getShell('bash', false);
      $data['cmd']='nohup python3 /var/www/html/dev/new_ocr.py '.$id.' '.$tracking_id.' '.$name.' '.$type.' "'.$heads.'" '.$Category.' &';
      if (!is_dir('ocr/'.$tracking_id.'/'.$Category."/".$type.'/')) {
          mkdir('ocr/'.$tracking_id.'/'.$Category."/".$type, 0777, true);
      }
      if (!is_dir('img/'.$tracking_id.'/'.$Category."/".$type.'/')) {
          mkdir('img/'.$tracking_id.'/'.$Category."/".$type, 0777, true);
      }
      // echo $cmd;
      $data['output']= $shellObj->exeCmd($data['cmd']);
      return $data;
    }
    public function mgt_ocr($id,$tracking_id,$name)
    {
      $shellObj    = \MTS\Factories::getDevices()->getLocalHost()->getShell('bash', false);
      $cmd='nohup python /var/www/html/dev/mgt_ocr.py '.$id.' '.$tracking_id.' '.$name.'  &';
      if (!is_dir('ocr/'.$tracking_id.'/'.'mgt/')) {
          mkdir('ocr/'.$tracking_id.'/'.'mgt/', 0777, true);
      }
      if (!is_dir('img/'.$tracking_id.'/'.'mgt/'.'/')) {
          mkdir('img/'.$tracking_id.'/'.'mgt/', 0777, true);
      }
      // echo $cmd;
      $output= $shellObj->exeCmd($cmd);
      return $output;
    }




}
