<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Testserver extends CI_Controller
{
    public function index(){
      $URN="KREGGB20081700044";
      $url="https://centralwebservice.azurewebsites.net/ConsumeAPIData.asmx/GetReportRequestStatus?URN=";
      $this->db->select('*');
      $this->db->where('status','paid' );
      $this->db->where('category','Full Company Report');
      $this->db->where('product_status','In Progress' );
      $query=$this->db->get('orders');
      if($query->num_rows()){
        $orders=$query->result_array();
        foreach ($orders as $order) {
          if(($order['country_code']!=='IN')||($order['country_code']!=='')||($order['country_code']!==null)){
            if($order['URN']){
              $file=@file_get_contents($url.$order['URN']);
              $json=json_decode($file);
              if(@$json){
                if($json[0]->Status=="1"){
                  $data['update']=array(
                    'assigned' => 'User',
                    'comment'=>'Completed  <p>& Sent to User</p>',
                    'da'=>'completed',
                    'fa'=>'completed',
                    'downloader'=>'completed',
                    'product_status'=>'completed',
                    'production_status'=>'completed',
                  );
                  $this->db->where('id', $order['id']);
                  $this->db->update('orders', $data['update']);
                }
              }

            }
          }
        }
      }
    }

    public function testrun($id)
      {
          $source_url='https://biucs.com/demo/upload/xbrl/'.$id.'/data.json';
          // echo $source_url;
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_URL, $source_url);
          $file = curl_exec($ch);
          curl_close($ch);
          // echo $file;
          // exit;

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
            echo json_encode($data);
          }
      }

}
