<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once "/var/www/tools/MTS/EnableMTS.php";
class Ocr extends CI_Controller
{
      // public function index(){
      //   $id=$this->input->get('id');
      //   $pdf=$this->input->get('pdf');
      //   require_once "/var/www/html/tools/MTS/EnableMTS.php";
      //   $shellObj    = \MTS\Factories::getDevices()->getLocalHost()->getShell('bash', false);
      //   return $shellObj->exeCmd('/usr/bin/python3 /var/www/html/main.py '.$id.'/'.$pdf);
      // }

      public function compress(){
        // echo json_encode($_POST);
        // exit;
        echo json_encode($_POST);
        exit;
        $id=$this->input->post('tracking_id');
        $name=$this->input->post('name');
        if (!file_exists("upload/pdf/".$id)) {
            mkdir("upload/pdf/".$id, 0777, true);
        }
        $input="upload/report/".$id."/aoc_".$name;

        $data['status']="200";
        $data['msg']='Success';
        // $input="upload/report/GBXSlUuIHN/test_compressed.pdf";
        // $output="upload/pdf/GBXSlUuIHN/aoc.pdf";

        $this->db->select('*');
        $this->db->where('tracking_id',$id);
        $query=$this->db->get('orders');
        $data['row']=$query->row_array();

        $data['update']['aoc4file']=base_url().$input;
        // $data['update']['aoc4file']=base_url()."upload/pdf/".$id."/aoc_".$name;
        // echo json_encode($data['update']);
        // exit;
        $this->db->where('tracking_id', $id);
        $this->db->update('orders', $data['update']);
          $pdfurl=base_url().$input;
         $ordersaocid=$this->admin->getVal("SELECT id FROM orders WHERE tracking_id='".$id."'");




   $delete1=$this->admin->deleteAll('aoc4data',array('order_id'=>$ordersaocid));
$json = @file_get_contents('https://api.ocr.space/parse/imageurl?apikey=5a64d478-9c89-43d8-88e3-c65de9999580&url='.$pdfurl.'&language=eng&isOverlayRequired=true');
   //     $json = @file_get_contents('https://api.ocr.space/parse/imageurl?apikey=5a64d478-9c89-43d8-88e3-c65de9999580&url=http://test.kreditaid.com/test/aocpdf/4.pdf&language=eng&isOverlayRequired=true');
 $obj = json_decode($json,true);
 $temp = count($obj['ParsedResults']);

 //print_r($obj['ParsedResults'][3]['TextOverlay']['Lines']); exit;
 $array1=array();

    for ($i=0; $i<$temp; $i++) {
$temp1 = count($obj['ParsedResults'][$i]['TextOverlay']['Lines']);

if($i == 0){$var= 'a';}
if($i == 1){$var= 'b';}
if($i == 2){$var= 'c';}
if($i == 3){$var= 'd';}
if($i == 4){$var= 'e';}
if($i == 5){$var= 'f';}
if($i == 6){$var= 'g';}
if($i == 7){$var= 'h';}
if($i == 8){$var= 'i';}
if($i == 9){$var= 'j';}
if($i == 10){$var= 'k';}
if($i == 11){$var= 'l';}
if($i == 12){$var= 'm';}
if($i == 13){$var= 'n';}
if($i == 14){$var= 'o';}
if($i == 15){$var= 'p';}


    for ($j=0; $j<$temp1; $j++) {


 $array1[] = array(
            'LineText' =>$obj['ParsedResults'][$i]['TextOverlay']['Lines'][$j]['LineText'],
           'MaxHeight'=>$obj['ParsedResults'][$i]['TextOverlay']['Lines'][$j]['MaxHeight'],
           'MinTop'=> $obj['ParsedResults'][$i]['TextOverlay']['Lines'][$j]['MinTop'],
            'Left'=> $obj['ParsedResults'][$i]['TextOverlay']['Lines'][$j]['Words'][0]['Left'],
           'Page'=>$var,
           'order_id'=>$ordersaocid,
            );

/*
 $array = array(
           'LineText' =>$obj['ParsedResults'][$i]['TextOverlay']['Lines'][$j]['LineText'],
           'MaxHeight'=>$obj['ParsedResults'][$i]['TextOverlay']['Lines'][$j]['MaxHeight'],
           'MinTop'=> $var.'_'.$obj['ParsedResults'][$i]['TextOverlay']['Lines'][$j]['MinTop'],
           'Page'=>$i+1,
           'order_id'=>1,
            );
 $insert = $this->admin->insert('aoc4data', $array);*/
}

    }
function cmp2($a1, $b1)
{
  if ($a1["MinTop"] == $b1["MinTop"]) {
        return 0;
    }
  return ($a1["MinTop"] < $b1["MinTop"]) ? -1 : 1;
}

usort($array1,"cmp2");
     foreach($array1 as $arrayi){

 $array = array(
            'LineText' =>$arrayi['LineText'],
            'MaxHeight'=>$arrayi['MaxHeight'],
            'MinTop'=>$arrayi['MinTop'],
             'Left'=>$arrayi['Left'],
            'Page'=>$arrayi['Page'],
           'order_id'=>$arrayi['order_id'],
            );
 $insert = $this->admin->insert('aoc4data', $array);
}
        //$this->db->last_query();
        // $shellObj    = \MTS\Factories::getDevices()->getLocalHost()->getShell('bash', false);
        // $output=$shellObj->exeCmd("gs -sDEVICE=pdfwrite -o ".$output." -dCompatibilityLevel='1.4'   -dNOPAUSE -dQUIET -dBATCH ".$input);
        echo json_encode($data);
      }

   public function llp11(){
$id=$this->input->post('tracking_id');
        $name=$this->input->post('name');
        if (!file_exists("upload/pdf/".$id)) {
            mkdir("upload/pdf/".$id, 0777, true);
        }
        $input="upload/report/".$id."/llp11_".$name;

        $data['status']="200";
        $data['msg']='Success';
        // $input="upload/report/GBXSlUuIHN/test_compressed.pdf";
        // $output="upload/pdf/GBXSlUuIHN/aoc.pdf";

        $this->db->select('*');
        $this->db->where('tracking_id',$id);
        $query=$this->db->get('orders');
        $data['row']=$query->row_array();

        $data['update']['llp11file']=base_url().$input;
        // $data['update']['aoc4file']=base_url()."upload/pdf/".$id."/aoc_".$name;
        // echo json_encode($data['update']);
        // exit;
        $this->db->where('tracking_id', $id);
        $this->db->update('orders', $data['update']);
          $pdfurl=base_url().$input;
         $ordersaocid=$this->admin->getVal("SELECT id FROM orders WHERE tracking_id='".$id."'");




   $delete1=$this->admin->deleteAll('llp11data',array('order_id'=>$ordersaocid));
$json = @file_get_contents('https://api.ocr.space/parse/imageurl?apikey=5a64d478-9c89-43d8-88e3-c65de9999580&url='.$pdfurl.'&language=eng&isOverlayRequired=true');
   //     $json = @file_get_contents('https://api.ocr.space/parse/imageurl?apikey=5a64d478-9c89-43d8-88e3-c65de9999580&url=http://test.kreditaid.com/test/aocpdf/4.pdf&language=eng&isOverlayRequired=true');
 $obj = json_decode($json,true);
 $temp = count($obj['ParsedResults']);

 //print_r($obj['ParsedResults'][3]['TextOverlay']['Lines']); exit;
 $array1=array();

    for ($i=0; $i<$temp; $i++) {
$temp1 = count($obj['ParsedResults'][$i]['TextOverlay']['Lines']);

if($i == 0){$var= 'a';}
if($i == 1){$var= 'b';}
if($i == 2){$var= 'c';}
if($i == 3){$var= 'd';}
if($i == 4){$var= 'e';}
if($i == 5){$var= 'f';}
if($i == 6){$var= 'g';}
if($i == 7){$var= 'h';}
if($i == 8){$var= 'i';}
if($i == 9){$var= 'j';}
if($i == 10){$var= 'k';}
if($i == 11){$var= 'l';}
if($i == 12){$var= 'm';}
if($i == 13){$var= 'n';}
if($i == 14){$var= 'o';}
if($i == 15){$var= 'p';}


    for ($j=0; $j<$temp1; $j++) {


 $array1[] = array(
            'LineText' =>$obj['ParsedResults'][$i]['TextOverlay']['Lines'][$j]['LineText'],
           'MaxHeight'=>$obj['ParsedResults'][$i]['TextOverlay']['Lines'][$j]['MaxHeight'],
           'MinTop'=> $obj['ParsedResults'][$i]['TextOverlay']['Lines'][$j]['MinTop'],
            'Left'=> $obj['ParsedResults'][$i]['TextOverlay']['Lines'][$j]['Words'][0]['Left'],
           'Page'=>$var,
           'order_id'=>$ordersaocid,
            );

/*
 $array = array(
           'LineText' =>$obj['ParsedResults'][$i]['TextOverlay']['Lines'][$j]['LineText'],
           'MaxHeight'=>$obj['ParsedResults'][$i]['TextOverlay']['Lines'][$j]['MaxHeight'],
           'MinTop'=> $var.'_'.$obj['ParsedResults'][$i]['TextOverlay']['Lines'][$j]['MinTop'],
           'Page'=>$i+1,
           'order_id'=>1,
            );
 $insert = $this->admin->insert('aoc4data', $array);*/
}

    }
function cmp2($a1, $b1)
{
  if ($a1["MinTop"] == $b1["MinTop"]) {
        return 0;
    }
  return ($a1["MinTop"] < $b1["MinTop"]) ? -1 : 1;
}

usort($array1,"cmp2");
     foreach($array1 as $arrayi){

 $array = array(
            'LineText' =>$arrayi['LineText'],
            'MaxHeight'=>$arrayi['MaxHeight'],
            'MinTop'=>$arrayi['MinTop'],
             'Left'=>$arrayi['Left'],
            'Page'=>$arrayi['Page'],
           'order_id'=>$arrayi['order_id'],
            );

 $insert = $this->admin->insert('llp11data', $array);
}
        //$this->db->last_query();
        // $shellObj    = \MTS\Factories::getDevices()->getLocalHost()->getShell('bash', false);
        // $output=$shellObj->exeCmd("gs -sDEVICE=pdfwrite -o ".$output." -dCompatibilityLevel='1.4'   -dNOPAUSE -dQUIET -dBATCH ".$input);
        echo json_encode($data);

   }

   public function llp2(){
$id=$this->input->post('tracking_id');
        $name=$this->input->post('name');
        if (!file_exists("upload/pdf/".$id)) {
            mkdir("upload/pdf/".$id, 0777, true);
        }
        $input="upload/report/".$id."/llp2_".$name;
        $data['status']="200";
        $data['msg']='Success';
        // $input="upload/report/GBXSlUuIHN/test_compressed.pdf";
        // $output="upload/pdf/GBXSlUuIHN/aoc.pdf";

        $this->db->select('*');
        $this->db->where('tracking_id',$id);
        $query=$this->db->get('orders');
        $data['row']=$query->row_array();

        $data['update']['llp2file']=base_url().$input;
        // $data['update']['aoc4file']=base_url()."upload/pdf/".$id."/aoc_".$name;
        // echo json_encode($data['update']);
        // exit;
        $this->db->where('tracking_id', $id);
        $this->db->update('orders', $data['update']);
          $pdfurl=base_url().$input;
         $ordersaocid=$this->admin->getVal("SELECT id FROM orders WHERE tracking_id='".$id."'");


   $delete1=$this->admin->deleteAll('llp2data',array('order_id'=>$ordersaocid));

$json = @file_get_contents('https://api.ocr.space/parse/imageurl?apikey=5a64d478-9c89-43d8-88e3-c65de9999580&url='.$pdfurl.'&language=eng&isOverlayRequired=true');
   //     $json = @file_get_contents('https://api.ocr.space/parse/imageurl?apikey=5a64d478-9c89-43d8-88e3-c65de9999580&url=http://test.kreditaid.com/test/aocpdf/4.pdf&language=eng&isOverlayRequired=true');
 $obj = json_decode($json,true);
 $temp = count($obj['ParsedResults']);

 //print_r($obj['ParsedResults'][3]['TextOverlay']['Lines']); exit;
 $array1=array();

    for ($i=0; $i<$temp; $i++) {
$temp1 = count($obj['ParsedResults'][$i]['TextOverlay']['Lines']);

if($i == 0){$var= 'a';}
if($i == 1){$var= 'b';}
if($i == 2){$var= 'c';}
if($i == 3){$var= 'd';}
if($i == 4){$var= 'e';}
if($i == 5){$var= 'f';}
if($i == 6){$var= 'g';}
if($i == 7){$var= 'h';}
if($i == 8){$var= 'i';}
if($i == 9){$var= 'j';}
if($i == 10){$var= 'k';}
if($i == 11){$var= 'l';}
if($i == 12){$var= 'm';}
if($i == 13){$var= 'n';}
if($i == 14){$var= 'o';}
if($i == 15){$var= 'p';}


    for ($j=0; $j<$temp1; $j++) {


 $array1[] = array(
            'LineText' =>$obj['ParsedResults'][$i]['TextOverlay']['Lines'][$j]['LineText'],
           'MaxHeight'=>$obj['ParsedResults'][$i]['TextOverlay']['Lines'][$j]['MaxHeight'],
           'MinTop'=> $obj['ParsedResults'][$i]['TextOverlay']['Lines'][$j]['MinTop'],
            'Left'=> $obj['ParsedResults'][$i]['TextOverlay']['Lines'][$j]['Words'][0]['Left'],
           'Page'=>$var,
           'order_id'=>$ordersaocid,
            );

/*
 $array = array(
           'LineText' =>$obj['ParsedResults'][$i]['TextOverlay']['Lines'][$j]['LineText'],
           'MaxHeight'=>$obj['ParsedResults'][$i]['TextOverlay']['Lines'][$j]['MaxHeight'],
           'MinTop'=> $var.'_'.$obj['ParsedResults'][$i]['TextOverlay']['Lines'][$j]['MinTop'],
           'Page'=>$i+1,
           'order_id'=>1,
            );
 $insert = $this->admin->insert('aoc4data', $array);*/
}

    }
function cmp2($a1, $b1)
{
  if ($a1["MinTop"] == $b1["MinTop"]) {
        return 0;
    }
  return ($a1["MinTop"] < $b1["MinTop"]) ? -1 : 1;
}

usort($array1,"cmp2");
     foreach($array1 as $arrayi){

 $array = array(
            'LineText' =>$arrayi['LineText'],
            'MaxHeight'=>$arrayi['MaxHeight'],
            'MinTop'=>$arrayi['MinTop'],
             'Left'=>$arrayi['Left'],
            'Page'=>$arrayi['Page'],
           'order_id'=>$arrayi['order_id'],
            );
 $insert = $this->admin->insert('llp2data', $array);
}
        //$this->db->last_query();
        // $shellObj    = \MTS\Factories::getDevices()->getLocalHost()->getShell('bash', false);
        // $output=$shellObj->exeCmd("gs -sDEVICE=pdfwrite -o ".$output." -dCompatibilityLevel='1.4'   -dNOPAUSE -dQUIET -dBATCH ".$input);
        echo json_encode($data);

   }


public function llp8(){
$id=$this->input->post('tracking_id');
        $name=$this->input->post('name');
        if (!file_exists("upload/pdf/".$id)) {
            mkdir("upload/pdf/".$id, 0777, true);
        }
        $input="upload/report/".$id."/llp8_".$name;

        $data['status']="200";
        $data['msg']='Success';
        // $input="upload/report/GBXSlUuIHN/test_compressed.pdf";
        // $output="upload/pdf/GBXSlUuIHN/aoc.pdf";

        $this->db->select('*');
        $this->db->where('tracking_id',$id);
        $query=$this->db->get('orders');
        $data['row']=$query->row_array();

        $data['update']['llp8file']=base_url().$input;
        // $data['update']['aoc4file']=base_url()."upload/pdf/".$id."/aoc_".$name;
        // echo json_encode($data['update']);
        // exit;
        $this->db->where('tracking_id', $id);
        $this->db->update('orders', $data['update']);

        echo json_encode($data);

   }
   public function pass3(){
$id=$this->input->post('tracking_id');
        $name=$this->input->post('name');
        if (!file_exists("upload/pdf/".$id)) {
            mkdir("upload/pdf/".$id, 0777, true);
        }
        $input="upload/report/".$id."/pass_".$name;

        $data['status']="200";
        $data['msg']='Success';
        // $input="upload/report/GBXSlUuIHN/test_compressed.pdf";
        // $output="upload/pdf/GBXSlUuIHN/aoc.pdf";

        $this->db->select('*');
        $this->db->where('tracking_id',$id);
        $query=$this->db->get('orders');
        $data['row']=$query->row_array();

        $data['update']['pass3file']=base_url().$input;
        // $data['update']['aoc4file']=base_url()."upload/pdf/".$id."/aoc_".$name;
        // echo json_encode($data['update']);
        // exit;
        $this->db->where('tracking_id', $id);
        $this->db->update('orders', $data['update']);

        echo json_encode($data);

   }


      public function extract(){
        // echo json_encode($_POST);
        // exit;
        $id=$this->input->post('tracking_id');
        $name=$this->input->post('name');
        $this->load->model('Ocr_model');
        $data['output']=$this->Ocr_model->extractAttachment($id,$name);
        $data['status']='200';
        $data['msg']='Success';

        $this->db->select('*');
        $this->db->where('tracking_id',$id);
        $query=$this->db->get('orders');
        $data['row']=$query->row_array();

        $data['update']['mgt']=base_url().'upload/report/'.$id.'/'.$name;

        $this->db->select('*');
        $this->db->where('o_id', $data['row']['id']);
        $squery=$this->db->get('shareholding');
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
          $data['insert']['mgt']=base_url().'upload/report/'.$id.'/'.$name;
          $data['insert']['o_id']=$data['row']['id'];
          $data['insert']['status']='pdf';
          $this->db->insert('shareholding', $data['insert']);
        }


   $mgturl=base_url().'upload/report/'.$id.'/'.$name;
 $json = @file_get_contents('https://api.ocr.space/parse/imageurl?apikey=5a64d478-9c89-43d8-88e3-c65de9999580&url='.$mgturl.'&language=eng&isOverlayRequired=true');
 $obj = json_decode($json,true);
 $temp = count($obj['ParsedResults'][0]['TextOverlay']['Lines']);
 $array1=array();
    for ($i=0; $i<$temp; $i++) {
  $array1[] = array(
           'LineText' =>$obj['ParsedResults'][0]['TextOverlay']['Lines'][$i]['LineText'],
           'MinTop'=>$obj['ParsedResults'][0]['TextOverlay']['Lines'][$i]['MinTop'],
            );
    }


         function cmp2($a1, $b1)
{
  if ($a1["MinTop"] == $b1["MinTop"]) {
        return 0;
    }
  return ($a1["MinTop"] < $b1["MinTop"]) ? -1 : 1;
}

usort($array1,"cmp2");

$key = array_search('(d) •Telephone number with STD code', array_column($array1, 'LineText'));
$key1 = $key + 1;
$key2 = array_search('Pre-fill', array_column($array1, 'LineText'));
$key3 = $key2 + 1;

$id2 =$data['row']['id'];
 $cinmgt=$this->admin->getVal("SELECT items FROM orders WHERE id = ".$id2."");

 $finaldatamgt=$this->admin->getRow("SELECT o_id FROM shareholding WHERE status = 'mgt' AND o_id = ".$id2."");

 $array2 = array(
            'contact' =>$array1[$key1]['LineText'],
            'cin'=> $cinmgt,
            'o_id'=>$id2,
             'status'=>'mgt',
            );
   if($finaldatamgt->o_id == $id2 )
   {

   $update = $this->admin->update('shareholding',array('o_id'=>$id2,'status'=>'mgt'), $array2);
   }else{
   $insert = $this->admin->insert('shareholding', $array2);
   }
        echo json_encode($data);
        // $input="upload/report/".$id."/".$name;
        // $output="upload/pdf/".$id."/compressed".$name;

      //   $pdf_path = array();
      //   $this->load->model('Ocr_model');
      //   $this->db->select('*');
      //   $this->db->where('tracking_id', $id);
      //   $query=$this->db->get('orders');
      //   $data['status']="";
      //   $strEnc = array();
      //   if ($query->num_rows()>0) {
      //       $data['row']=$query->row_array();
      //       if ($data['row']['files']) {
      //           $data['files']=json_decode($data['row']['files']);
      //           $i=0;
      //           foreach ($data['files'] as $files) {
      //               $tmp = explode('.', $files);
      //               $file_extension = end($tmp);
      //               if ($file_extension=="pdf") {
      //                   $pdf_path[]=$files;
      //               }
      //           }
      //       }
      // }
      // foreach ($pdf_path as $pdf) {
      //   $PDF[]=$this->Ocr_model->getAttachment($id,$pdf);
      // }
      }


       

}
