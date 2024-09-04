<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model Front_model

 * @package		UCS
 * @category	Model
 * @param     ...
 * @return    ...
 *
 */
class Api_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // create search indexing company names
    public function documents($id)
    {
        $source_url='http://kreditaid.com:9000/doc?cin='.$id;
        $this->db->select('*');
        $this->db->where('cin', $id);
        $inser=array();
        $query = $this->db->get('documents');
        if ($query->num_rows()==0) {
            $fileContents= @file_get_contents($source_url);
            if ($fileContents) {
                $result=json_decode($fileContents);
                $counter=0;
                if (@$result) {
                    foreach ($result as $item) {
                        for ($i=1; $i <sizeof($item); $i++) {
                            if (!($i%2)) {
                                $data[$item[0]][$counter][]['date']=@$item[$i];
                                $data[$item[0]][$counter][]['name']=@$item[$i+1];
                                $insert[] = array(
                  'cin' => $id,
                  'title'=>$item[$i],
                  'date'=>@$item[$i+1],
                 'category'=>$item[0]
                 );
                                $insert_data=array(
                   'cin' => $id,
                   'title'=>$item[$i],
                   'date'=>@$item[$i+1],
                  'category'=>$item[0]
                  );

                                $this->db->insert('documents', $insert_data);
                            }
                        }
                    }
                    return $insert;
                }
            }
        } else {
            return $query->result_array();
            // return "DAta";
        }
    }


    public function charges($id)
    {
        //  $source_url='http://kreditaid.com:9000/doc?cin='.$id;
        $source_url = 'http://kreditaid.com:9000/charges?cin=' . $id;
        $this->db->select('*');
        $this->db->where('cin', $id);
        $inser = array();
        $query = $this->db->get('charges');
        if ($query->num_rows() == 0) {
            $fileContents = @file_get_contents($source_url);
            //    echo $fileContents;
            if ($fileContents) {
                $result = json_decode($fileContents, true);
                $counter = 0;
                //  echo json_encode($result);

                if (@$result) {
                    for ($i = 7; $i < @sizeof($result); $i += 7) {
                        $result[$i]['Charge ID'];

                        $insert[] = array(
                            'cin' => $id,
                            'charge_id' => $result[$i]['Charge ID'],
                            'Creation_Date' => $result[$i + 1]['Creation Date'],
                            'Modification_Date' => $result[$i + 2]['Modification Date'],
                            'Closure_Date' => $result[$i + 3]['Closure Date'],
                            'Assets_Under_Charge' => $result[$i + 4]['Assets Under Charge'],
                            'Amount' => $result[$i + 5]['Amount'],
                            'Charge_Holder' => $result[$i + 6]['Charge Holder'],
                        );
                        $insert_data = array(
                            'cin' => $id,
                            'charge_id' => $result[$i]['Charge ID'],
                            'Creation_Date' => $result[$i + 1]['Creation Date'],
                            'Modification_Date' => $result[$i + 2]['Modification Date'],
                            'Closure_Date' => $result[$i + 3]['Closure Date'],
                            'Assets_Under_Charge' => $result[$i + 4]['Assets Under Charge'],
                            'Amount' => $result[$i + 5]['Amount'],
                            'Charge_Holder' => $result[$i + 6]['Charge Holder']);

                        $this->db->insert('charges', $insert_data);
                    }
                    return @$insert;
                    echo json_encode(@$insert);
                }
            }
        } else {
            return $query->result_array();
        }
    }
    // ------------------------------------------------------------------------

    public function trackcompany($id)
    {
        $source_url='http://kreditaid.com:9000/doc?cin='.$id;
        $this->db->select('title,date');
        $this->db->where('cin', $id);
        $inser=array();
        $query = $this->db->get('documents');
        $data['current']= $query->result_array();

        $fileContents= @file_get_contents($source_url);
        if ($fileContents) {
            $result=json_decode($fileContents);
            $counter=0;
            if (@$result) {
                foreach ($result as $item) {
                    for ($i=1; $i <sizeof($item); $i++) {
                        if (!($i%2)) {
                            $data[$item[0]][$counter][]['date']=@$item[$i];
                            $data[$item[0]][$counter][]['name']=@$item[$i+1];
                            $insert[] = array(
                                             'title'=>$item[$i],
                                             'date'=>@$item[$i+1],
                                            );
                        }
                    }
                }
                $data['new'] =$insert;
            }
        }

        $master_url='http://kreditaid.com:9000/master?cin='.$id;
        $masterContents= @file_get_contents($master_url);
        if ($masterContents) {
            $data['master_new']=json_decode($masterContents);
        }

        $this->db->select('*');
        $this->db->where('cin', $id);
        $this->db->limit(1);
        $querymaster = $this->db->get('company');
        $data['master_current']= $querymaster->row_array();
        return $data;

    }
    public function trademarks($id)
    {
        $resultData = array();
        $source_url='http://kreditaid.com:9000/trade?cin='.$id;
        $dataurl='http://kreditaid.com:9000/gettrade?cin='.id.'&page=';
        $fileContents= @file_get_contents($source_url);

        if($fileContents){
          echo $fileContents;
          $result=json_decode($fileContents,false);
          echo $result['status'];
          if(@$result['status']==='no trade'){
            $data="No Data Found";
            // return $data;
          }else{
            $page=@$result['status'];
            $page = str_replace(' records found', '', $page);
            $page=(int)$page;
            if($page){
              for ($i=1; $i <= $page; $i++) {
                $dataContents= @file_get_contents($dataurl.$page);
                if($dataContents){
                  $resultData[]=json_decode($dataContents);
                }
              }
            }
            return $resultData;
          }



        }
    }

    public function trademarks_count($id){
      $counter='http://kreditaid.com:9000/trade?cin='.$id;
      $counter=@file_get_contents($counter);
    //   echo $counter;
      $counter=str_replace(" records found",'',$counter);
    //   echo $counter;
      $data['counter'] = preg_replace('/[^0-9]/', '', $counter);
      $data['counter']=(int)$data['counter'];
    //   echo $data['counter'];
      return $data['counter'];
    }

    public function master($id){
      $source_url='http://kreditaid.com:9000/master?cin='.$id;
      $fileContents= @file_get_contents($source_url);
      $result=json_decode($fileContents);
      for ($i=0; $i < sizeof($result); $i+=2) {
        $title=str_replace(' ', '', $result[$i]);
        $data[$title]=$result[$i+1];
      }
      // echo json_encode($data);
      // echo json_encode($data);

      return $data;
    }


}
