<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cws extends CI_Controller
{
    public function index()
    {
        $data = array();
        $data['status']='200';
        $json_path="http://15.206.122.169:8080/rest/xbrl/https://uat.kreditaid.com/upload/report/WF5InCvuVg/flipkart_ind_as.xml/facts?media=json&factListCols=Name,Label,Value,Period,Dimensions";
        // $json_path="http://15.206.122.169:8080/rest/xbrl/https://uat.kreditaid.com/upload/test.xml/facts?media=html&factListCols=Name,Label,Value,Period,Dimensions";
        $json=file_get_contents($json_path);
        $result=json_decode($json);
        foreach ($result->factList as $fact) {
            if ($fact[1]->name=="ind-as:DisclosureOfTransactionsBetweenRelatedPartiesExplanatory") {
                $data['content']= @$fact[2]->value;
            }
        }
        // echo $data['content'];
        $data['content'] = str_replace('<p>', '', $data['content']);
        $data['content'] = str_replace('</p>', '', $data['content']);
        $data['content'] = str_replace('<span>', '', $data['content']);
        $data['content'] = str_replace('</span>', '', $data['content']);
        // exit;

        $SHOW = array();
        $dom = new domDocument;
        libxml_use_internal_errors(true);
        $dom->loadHTML($data['content']);
        $dom->preserveWhiteSpace = false;
        $tables = $dom->getElementsByTagName('table');
        $i=0;
        for ($i=0; $i < 2; $i++) {
            $rows = $tables->item($i)->getElementsByTagName('tr');
            foreach ($rows as $row) {
                $cols = $row->getElementsByTagName('td');
                $SHOW['name'][]=$cols->item(0)->nodeValue;
                $SHOW['value'][]=$cols->item(1)->nodeValue;
                echo $cols->item(0)->nodeValue.'///////'.$cols->item(1)->nodeValue.'<br>';
            }
            echo "----------------------------------------------";
        }
        // echo json_encode($SHOW);
  exit;


        $data['content']=$this->input->post('data');
        echo json_encode($data);
    }
}
