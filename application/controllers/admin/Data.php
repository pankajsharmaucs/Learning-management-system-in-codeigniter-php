<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        Utils::no_cache();
        if (!$this->session->userdata('admin_in')) {
            redirect(base_url('admin/auth/login'));
            exit;
        }
    }

    public function master()
    {
      $this->load->model('Data');
      $data['scrappers'] = $this->Data->getItem('master_data');
      echo json_encode($data);
    }
    public function test(){
      $source_url='https://biucs.com/demo/upload/xbrl/HLY08KlgGq/data.json';

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
    }

}
