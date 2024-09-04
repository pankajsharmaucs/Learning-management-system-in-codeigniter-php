<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Aoc extends CI_Controller
{
    // public function index(){
    //   $id=$this->input->get('id');
    //   $pdf=$this->input->get('pdf');
    //   require_once "/var/www/html/tools/MTS/EnableMTS.php";
    //   $shellObj    = \MTS\Factories::getDevices()->getLocalHost()->getShell('bash', false);
    //   return $shellObj->exeCmd('/usr/bin/python3 /var/www/html/main.py '.$id.'/'.$pdf);
    // }

    public function compress()
    {
        $data['tracking_id']=$this->input->post('tracking_id');
        $data['id']=$this->input->post('id');
        $data['name']=$this->input->post('aoc');
        $data['head']= $this->input->post('head');
        $data['year']= $this->input->post('year');
        $data['type']= $this->input->post('type');
        $data['Category']= $this->input->post('category');
        // echo json_encode($_POST);
        // exit;

        $data['input']="upload/report/".$data['tracking_id']."/".$data['name'];
        if($data['type']==['Primary']){
          $data['type']=1;
        }else{
          $data['type']=2;
        }

        $heads="";


        for ($h=0; $h < sizeof($data['head']); $h++) {
          $headyear[$data['head'][$h]]=$data['year'][$h];
        }
        foreach ($headyear as $itemhead => $itemyear) {
          if((!empty($itemhead))&&(!empty($itemyear))){
            $heads=$heads.$itemhead.'-'.$itemyear.',';
          }
        }

        $data['heads']=$heads;
        $this->load->model('Ocr_model');
        $data['output']=$this->Ocr_model->do_ocr($data['id'],$data['tracking_id'],$data['input'],$data['type'],$data['heads'],$data['Category']);
        $data['status']="200";
        $data['msg']='Success';
        echo json_encode($data);
        exit;
    }

    public function pass3(){
      $data['tracking_id']=$this->input->post('tracking_id');
      $data['id']=$this->input->post('id');
      $data['name']=$this->input->post('name');
      $data['head']= $this->input->post('head');
      $data['year']= $this->input->post('year');
      $data['type']= $this->input->post('type');
      $data['filetype']= $this->input->post('filetype');

      $data['input']=base_url()."upload/report/".$data['tracking_id']."/".$data['name'];
      if($data['type']==['Primary']){
        $data['type']=1;
      }else{
        $data['type']=2;
      }

      $heads="";


      for ($h=0; $h < sizeof($data['head']); $h++) {
        $headyear[$data['head'][$h]]=$data['year'][$h];
      }
      foreach ($headyear as $itemhead => $itemyear) {
        if((!empty($itemhead))&&(!empty($itemyear))){
          $heads=$heads.$itemhead.'-'.$itemyear.',';
        }
      }

      $data['heads']=$heads;

      $array = array(
                 'order_id'=>$data['id'],
                 'type'=>$data['type'],
                 'year1'=>$data['heads'],
                'file' => $data['input'],
                'filetype'=>$data['filetype']
      );
      $where= array('order_id'=>$data['id'],'filetype'=>$data['filetype'],'type'=>$data['type']);
      $data['delete']=$this->admin->deleteAll('llp8pass3',$where);
      $data['Query'][]=$this->db->last_query();
      $data['insert'] = $this->admin->insert('llp8pass3', $array);

      $data['status']='200';
      $data['msg']='Success';
      $data['Query'][]=$this->db->last_query();
      echo json_encode($data);
      exit;
    }


    public function extract()
    {
        // echo json_encode($_POST);
        // exit;
        $id=$this->input->post('tracking_id');
        $name=$this->input->post('name');
        $this->load->model('Ocr_model');
        $data['output']=$this->Ocr_model->extractAttachment($id, $name);
        $data['status']='200';
        $data['msg']='Success';

        $this->db->select('*');
        $this->db->where('tracking_id', $id);
        $query=$this->db->get('orders');
        $data['row']=$query->row_array();

        $data['update']['mgt']=base_url().'upload/report/'.$id.'/'.$name;

        $this->db->select('*');
        $this->db->where('o_id', $data['row']['id']);
        $squery=$this->db->get('shareholding');
        if ($squery->num_rows()>0) {
            $this->db->where('o_id', $data['row']['id']);
            $this->db->where('status', 'pdf');
            $this->db->update('shareholding', $data['update']);
            if ($this->db->affected_rows() > 0) {
                $data['dbmsg'] = 'Success';
                unset($_POST);
            } else {
                $data['dbmsg'] = 'Error';
            }
        } else {
            $data['insert']['mgt']=base_url().'upload/report/'.$id.'/'.$name;
            $data['insert']['o_id']=$data['row']['id'];
            $data['insert']['status']='pdf';
            $this->db->insert('shareholding', $data['insert']);
        }


        $mgturl=base_url().'upload/report/'.$id.'/'.$name;
        $json = @file_get_contents('https://api.ocr.space/parse/imageurl?apikey=5a64d478-9c89-43d8-88e3-c65de9999580&url='.$mgturl.'&language=eng&isOverlayRequired=true');
        $obj = json_decode($json, true);
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

        usort($array1, "cmp2");

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
        if ($finaldatamgt->o_id == $id2) {
            $update = $this->admin->update('shareholding', array('o_id'=>$id2,'status'=>'mgt'), $array2);
        } else {
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
    public function mgtjson()
    {

      $order_id=$_POST['id'];
      $tracking_id=$_POST['tracking_id'];
      $pdf=base_url().$_POST['file'];
      $data['mgt']=base_url().$_POST['json_file'];

    }

    public function aocjson()
    {

      $type=$_POST['type'];
      $heads=$_POST['heads'];
      $order_id=$_POST['id'];
      $tracking_id=$_POST['tracking_id'];
      $pdf=base_url().$_POST['file'];
      $data['aoc_json']=base_url().$_POST['json_file'];
      // $aoc_json='ocr/ZjGbmMPtCT/1/data.json';
      // echo json_encode($aoc_json);




      // file_put_contents("/var/www/html/uat/test.json", $aoc_json, FILE_APPEND);
      // exit;
      // exit;
        $json = @file_get_contents($data['aoc_json']);

        $temp = count($json['totalpages']);

        $obj = json_decode($json, true);

        $temp = count($obj['totalpages']);
        $array1=array();
        // $obj['totalpages']['Page 0'][0]['Line 0'][0]['text'].'bhu';

        for ($i=0; $i<$temp; $i++) {
            if ($i == 0) { $var= 'a';}
            if ($i == 1) {  $var= 'b'; }
            if ($i == 2) {  $var= 'c'; }
            if ($i == 3) { $var= 'd'; }
            if ($i == 4) {$var= 'e';}
            if ($i == 5) { $var= 'f'; }
            if ($i == 6) {  $var= 'g'; }
            if ($i == 7) {$var= 'h';}
            if ($i == 8) {   $var= 'i'; }
            if ($i == 9) { $var= 'j';  }
            if ($i == 10) {   $var= 'k';}
            if ($i == 11) {  $var= 'l';  }
            if ($i == 12) {$var= 'm'; }
            if ($i == 13) {  $var= 'n';}
            if ($i == 14) {  $var= 'o'; }
            if ($i == 15) {  $var= 'p';   }
             if ($i == 16) {  $var= 'q'; }
            if ($i == 17) {$var= 'u';}
            if ($i == 18) {   $var= 'r'; }
            if ($i == 19) { $var= 's';  }
            if ($i == 20) {   $var= 't';}
            if ($i == 21) {  $var= 'u';  }
            if ($i == 22) {$var= 'v'; }
            if ($i == 23) {  $var= 'w';}
            if ($i == 24) {  $var= 'x'; }
            if ($i == 25) {  $var= 'y';   }
              if ($i == 26) {  $var= 'z';   }
               if ($i == 27) {  $var= 'za';   }

            $temp1 = count($obj['totalpages']['Page '.$i]);
            // echo $temp1.'</br>';
            // echo $i;
            for ($j=0; $j<$temp1; $j++) {
                $pos=$obj['totalpages']['Page '.$i]['Line '.$j]['Position'];
                $post= explode(",", $pos);
                $left=$post[0];
                $top=$post[1];
                $width=$post[2];
                $height=$post[3];

                if($obj['totalpages']['Page '.$i]['Line '.$j]['Text'] != ''){

                $array1[] = array(
                         'LineText' =>$obj['totalpages']['Page '.$i]['Line '.$j]['Text'],
                         'Left'=>$left,
                         'MinTop'=>$top,
                         'width'=>$width,
                         'MaxHeight'=>$height,
                         'Page'=>$var,
                         'order_id'=>220,
                  );}
            }
        }
        function cmp2($a1, $b1)
        {
            if ($a1["MinTop"] == $b1["MinTop"]) {
                return 0;
            }
            return ($a1["MinTop"] < $b1["MinTop"]) ? -1 : 1;
        }
        usort($array1, "cmp2");

                $where= array('order_id'=>$order_id);
            $delete=$this->admin->deleteAll('aoc4data',$where);
        foreach ($array1 as $arrayi) {
            $array = array(
                        'LineText' =>$arrayi['LineText'],
                        'MaxHeight'=>$arrayi['MaxHeight'],
                        'MinTop'=>$arrayi['MinTop'],
                         'Left'=>$arrayi['Left'],
                        'Page'=>$arrayi['Page'],
                       'order_id'=>$order_id,
                       'type'=>$type,
                       'year1'=>$heads,
                      'aoc4file' => $pdf
            );
            $insert = $this->admin->insert('aoc4data', $array);
            echo $this->db->last_query(); 
        }
        echo $this->db->last_query();

    }






  public function llp11json(){


    // $data['status']="200";
    // $data['msg']='DSFSDF';
    // echo json_encode($data);
    // exit;
    $type=$_POST['type'];
    $heads=$_POST['heads'];
    $order_id=$_POST['id'];
    $tracking_id=$_POST['tracking_id'];
    $pdf=base_url().$_POST['file'];
    $data['aoc_json']=base_url().$_POST['json_file'];

      // $aoc_json='ocr/ZjGbmMPtCT/1/data.json';
      // echo json_encode($aoc_json);




      // file_put_contents("/var/www/html/uat/test.json", $aoc_json, FILE_APPEND);
      // exit;
      // exit;
        $json = @file_get_contents($data['aoc_json']);

        $temp = count($json['totalpages']);

        $obj = json_decode($json, true);

        $temp = count($obj['totalpages']);
        $array1=array();
        // $obj['totalpages']['Page 0'][0]['Line 0'][0]['text'].'bhu';

        for ($i=0; $i<$temp; $i++) {
            if ($i == 0) { $var= 'a';}
            if ($i == 1) {  $var= 'b'; }
            if ($i == 2) {  $var= 'c'; }
            if ($i == 3) { $var= 'd'; }
            if ($i == 4) {$var= 'e';}
            if ($i == 5) { $var= 'f'; }
            if ($i == 6) {  $var= 'g'; }
            if ($i == 7) {$var= 'h';}
            if ($i == 8) {   $var= 'i'; }
            if ($i == 9) { $var= 'j';  }
            if ($i == 10) {   $var= 'k';}
            if ($i == 11) {  $var= 'l';  }
            if ($i == 12) {$var= 'm'; }
            if ($i == 13) {  $var= 'n';}
            if ($i == 14) {  $var= 'o'; }
            if ($i == 15) {  $var= 'p';   }
             if ($i == 16) {  $var= 'q'; }
            if ($i == 17) {$var= 'u';}
            if ($i == 18) {   $var= 'r'; }
            if ($i == 19) { $var= 's';  }
            if ($i == 20) {   $var= 't';}
            if ($i == 21) {  $var= 'u';  }
            if ($i == 22) {$var= 'v'; }
            if ($i == 23) {  $var= 'w';}
            if ($i == 24) {  $var= 'x'; }
            if ($i == 25) {  $var= 'y';   }
              if ($i == 26) {  $var= 'z';   }
               if ($i == 27) {  $var= 'za';   }

            $temp1 = count($obj['totalpages']['Page '.$i]);
            // echo $temp1.'</br>';
            // echo $i;
            for ($j=0; $j<$temp1; $j++) {
                $pos=$obj['totalpages']['Page '.$i]['Line '.$j]['Position'];
                $post= explode(",", $pos);
                $left=$post[0];
                $top=$post[1];
                $width=$post[2];
                $height=$post[3];

                if($obj['totalpages']['Page '.$i]['Line '.$j]['Text'] != ''){

                $array1[] = array(
                         'LineText' =>$obj['totalpages']['Page '.$i]['Line '.$j]['Text'],
                         'Left'=>$left,
                         'MinTop'=>$top,
                         'width'=>$width,
                         'MaxHeight'=>$height,
                         'Page'=>$var,
                         'order_id'=>220,
                  );}
            }
        }
        function cmp2($a1, $b1)
        {
            if ($a1["MinTop"] == $b1["MinTop"]) {
                return 0;
            }
            return ($a1["MinTop"] < $b1["MinTop"]) ? -1 : 1;
        }
        usort($array1, "cmp2");
           $where= array('order_id'=>$order_id);
            $delete=$this->admin->deleteAll('llp11data',$where);
        foreach ($array1 as $arrayi) {
            $array = array(
                        'LineText' =>$arrayi['LineText'],
                        'MaxHeight'=>$arrayi['MaxHeight'],
                        'MinTop'=>$arrayi['MinTop'],
                         'Left'=>$arrayi['Left'],
                        'Page'=>$arrayi['Page'],
                       'order_id'=>$order_id,
                       'type'=>$type,
                       'year1'=>$heads,
                      'file' => $pdf
            );
            $insert = $this->admin->insert('llp11data', $array);
        }
        echo $this->db->last_query();

    }

        public function llp2json()
    {

      $type=$_POST['type'];
      $heads=$_POST['heads'];
      $order_id=$_POST['id'];
      $tracking_id=$_POST['tracking_id'];
      $pdf=base_url().$_POST['file'];
      $data['aoc_json']=base_url().$_POST['json_file'];


        $json = @file_get_contents($data['aoc_json']);

        $temp = count($json['totalpages']);

        $obj = json_decode($json, true);

        $temp = count($obj['totalpages']);
        $array1=array();
        // $obj['totalpages']['Page 0'][0]['Line 0'][0]['text'].'bhu';

        for ($i=0; $i<$temp; $i++) {
            if ($i == 0) { $var= 'a';}
            if ($i == 1) {  $var= 'b'; }
            if ($i == 2) {  $var= 'c'; }
            if ($i == 3) { $var= 'd'; }
            if ($i == 4) {$var= 'e';}
            if ($i == 5) { $var= 'f'; }
            if ($i == 6) {  $var= 'g'; }
            if ($i == 7) {$var= 'h';}
            if ($i == 8) {   $var= 'i'; }
            if ($i == 9) { $var= 'j';  }
            if ($i == 10) {   $var= 'k';}
            if ($i == 11) {  $var= 'l';  }
            if ($i == 12) {$var= 'm'; }
            if ($i == 13) {  $var= 'n';}
            if ($i == 14) {  $var= 'o'; }
            if ($i == 15) {  $var= 'p';   }
             if ($i == 16) {  $var= 'q'; }
            if ($i == 17) {$var= 'u';}
            if ($i == 18) {   $var= 'r'; }
            if ($i == 19) { $var= 's';  }
            if ($i == 20) {   $var= 't';}
            if ($i == 21) {  $var= 'u';  }
            if ($i == 22) {$var= 'v'; }
            if ($i == 23) {  $var= 'w';}
            if ($i == 24) {  $var= 'x'; }
            if ($i == 25) {  $var= 'y';   }
              if ($i == 26) {  $var= 'z';   }
               if ($i == 27) {  $var= 'za';   }
            $temp1 = count($obj['totalpages']['Page '.$i]);
            // echo $temp1.'</br>';
            // echo $i;
            for ($j=0; $j<$temp1; $j++) {
                $pos=$obj['totalpages']['Page '.$i]['Line '.$j]['Position'];
                $post= explode(",", $pos);
                $left=$post[0];
                $top=$post[1];
                $width=$post[2];
                $height=$post[3];

                if($obj['totalpages']['Page '.$i]['Line '.$j]['Text'] != ''){

                $array1[] = array(
                         'LineText' =>$obj['totalpages']['Page '.$i]['Line '.$j]['Text'],
                         'Left'=>$left,
                         'MinTop'=>$top,
                         'width'=>$width,
                         'MaxHeight'=>$height,
                         'Page'=>$var,
                         'order_id'=>220,
                  );}
            }
        }
        function cmp2($a1, $b1)
        {
            if ($a1["MinTop"] == $b1["MinTop"]) {
                return 0;
            }
            return ($a1["MinTop"] < $b1["MinTop"]) ? -1 : 1;
        }
        usort($array1, "cmp2");
           $where= array('order_id'=>$order_id);
            $delete=$this->admin->deleteAll('llp2data',$where);
        foreach ($array1 as $arrayi) {
            $array = array(
                        'LineText' =>$arrayi['LineText'],
                        'MaxHeight'=>$arrayi['MaxHeight'],
                        'MinTop'=>$arrayi['MinTop'],
                         'Left'=>$arrayi['Left'],
                        'Page'=>$arrayi['Page'],
                       'order_id'=>$order_id,
                       'type'=>$type,
                       'year1'=>$heads,
                      'file' => $pdf
            );
            $insert = $this->admin->insert('llp2data', $array);
        }
        //echo $this->db->last_query();

    }


        public function llp8json()
    {

      $type=$_POST['type'];
      $heads=$_POST['heads'];
      $order_id=$_POST['id'];
      $tracking_id=$_POST['tracking_id'];
      $pdf=base_url().$_POST['file'];
      $data['aoc_json']=base_url().$_POST['json_file'];
      // $aoc_json='ocr/ZjGbmMPtCT/1/data.json';
      //echo json_encode($aoc_json);




      // file_put_contents("/var/www/html/uat/test.json", $aoc_json, FILE_APPEND);
      // exit;
      // exit;
        $json = @file_get_contents($data['aoc_json']);

        $temp = count($json['totalpages']);

        $obj = json_decode($json, true);

        $temp = count($obj['totalpages']);
        $array1=array();
        // $obj['totalpages']['Page 0'][0]['Line 0'][0]['text'].'bhu';

        for ($i=0; $i<$temp; $i++) {
           if ($i == 0) { $var= 'a';}
            if ($i == 1) {  $var= 'b'; }
            if ($i == 2) {  $var= 'c'; }
            if ($i == 3) { $var= 'd'; }
            if ($i == 4) {$var= 'e';}
            if ($i == 5) { $var= 'f'; }
            if ($i == 6) {  $var= 'g'; }
            if ($i == 7) {$var= 'h';}
            if ($i == 8) {   $var= 'i'; }
            if ($i == 9) { $var= 'j';  }
            if ($i == 10) {   $var= 'k';}
            if ($i == 11) {  $var= 'l';  }
            if ($i == 12) {$var= 'm'; }
            if ($i == 13) {  $var= 'n';}
            if ($i == 14) {  $var= 'o'; }
            if ($i == 15) {  $var= 'p';   }
             if ($i == 16) {  $var= 'q'; }
            if ($i == 17) {$var= 'u';}
            if ($i == 18) {   $var= 'r'; }
            if ($i == 19) { $var= 's';  }
            if ($i == 20) {   $var= 't';}
            if ($i == 21) {  $var= 'u';  }
            if ($i == 22) {$var= 'v'; }
            if ($i == 23) {  $var= 'w';}
            if ($i == 24) {  $var= 'x'; }
            if ($i == 25) {  $var= 'y';   }
              if ($i == 26) {  $var= 'z';   }
               if ($i == 27) {  $var= 'za';   }

            $temp1 = count($obj['totalpages']['Page '.$i]);
            // echo $temp1.'</br>';
            // echo $i;
            for ($j=0; $j<$temp1; $j++) {
                $pos=$obj['totalpages']['Page '.$i]['Line '.$j]['Position'];
                $post= explode(",", $pos);
                $left=$post[0];
                $top=$post[1];
                $width=$post[2];
                $height=$post[3];

                if($obj['totalpages']['Page '.$i]['Line '.$j]['Text'] != ''){

                $array1[] = array(
                         'LineText' =>$obj['totalpages']['Page '.$i]['Line '.$j]['Text'],
                         'Left'=>$left,
                         'MinTop'=>$top,
                         'width'=>$width,
                         'MaxHeight'=>$height,
                         'Page'=>$var,
                         'order_id'=>220,
                  );}
            }
        }
        function cmp2($a1, $b1)
        {
            if ($a1["MinTop"] == $b1["MinTop"]) {
                return 0;
            }
            return ($a1["MinTop"] < $b1["MinTop"]) ? -1 : 1;
        }
        usort($array1, "cmp2");
        foreach ($array1 as $arrayi) {
            $array = array(
                        'LineText' =>$arrayi['LineText'],
                        'MaxHeight'=>$arrayi['MaxHeight'],
                        'MinTop'=>$arrayi['MinTop'],
                         'Left'=>$arrayi['Left'],
                        'Page'=>$arrayi['Page'],
                       'order_id'=>$order_id,
                       'type'=>$type,
                       'year1'=>$heads,
                      'file' => $pdf
            );
            $insert = $this->admin->insert('llp8data', $array);
        }
        echo $this->db->last_query();

    }

    public function aocjsontest()
    {
        $json = @file_get_contents('http://kreditaid.com/uat/json/9.json');

        $temp = count($json['totalpages']);

        $obj = json_decode($json, true);

        $temp = count($obj['totalpages']);
        $array1=array();
        $obj['totalpages']['Page 0'][0]['Line 0'][0]['text'].'bhu';

        for ($i=0; $i<$temp; $i++) {
           if ($i == 0) { $var= 'a';}
            if ($i == 1) {  $var= 'b'; }
            if ($i == 2) {  $var= 'c'; }
            if ($i == 3) { $var= 'd'; }
            if ($i == 4) {$var= 'e';}
            if ($i == 5) { $var= 'f'; }
            if ($i == 6) {  $var= 'g'; }
            if ($i == 7) {$var= 'h';}
            if ($i == 8) {   $var= 'i'; }
            if ($i == 9) { $var= 'j';  }
            if ($i == 10) {   $var= 'k';}
            if ($i == 11) {  $var= 'l';  }
            if ($i == 12) {$var= 'm'; }
            if ($i == 13) {  $var= 'n';}
            if ($i == 14) {  $var= 'o'; }
            if ($i == 15) {  $var= 'p';   }
            if ($i == 16) {  $var= 'q'; }
            if ($i == 17) {$var= 'u';}
            if ($i == 18) {   $var= 'r'; }
            if ($i == 19) { $var= 's';  }
            if ($i == 20) {   $var= 't';}
            if ($i == 21) {  $var= 'u';  }
            if ($i == 22) {$var= 'v'; }
            if ($i == 23) {  $var= 'w';}
            if ($i == 24) {  $var= 'x'; }
            if ($i == 25) {  $var= 'y';   }
            if ($i == 26) {  $var= 'z';   }
            if ($i == 27) {  $var= 'za';   }

            $temp1 = count($obj['totalpages']['Page '.$i]);
            // echo $temp1.'</br>';
            // echo $i;
            for ($j=0; $j<$temp1; $j++) {
                $pos=$obj['totalpages']['Page '.$i]['Line '.$j]['Position'];
                $post= explode(",", $pos);
                $left=$post[0];
                $top=$post[1];
                $width=$post[2];
                $height=$post[3];

                if($obj['totalpages']['Page '.$i]['Line '.$j]['Text'] != ''){

                $array1[] = array(
                         'LineText' =>$obj['totalpages']['Page '.$i]['Line '.$j]['Text'],
                         'Left'=>$left,
                         'MinTop'=>$top,
                         'width'=>$width,
                         'MaxHeight'=>$height,
                         'Page'=>$var,
                         'order_id'=>220,
                  );}
            }
        }
        function cmp2($a1, $b1)
        {
            if ($a1["MinTop"] == $b1["MinTop"]) {
                return 0;
            }
            return ($a1["MinTop"] < $b1["MinTop"]) ? -1 : 1;
        }
        usort($array1, "cmp2");
          //$this->db->where('order_id',$order_id);
           // $this->db->deleteAll('llp11data');
            $where= array('order_id'=>$order_id);
            $delete=$this->admin->deleteAll('llp2data',$where);
        foreach ($array1 as $arrayi) {
            $array = array(
                      'LineText' =>$arrayi['LineText'],
                      'MaxHeight'=>$arrayi['MaxHeight'],
                      'MinTop'=>$arrayi['MinTop'],
                      'Left'=>$arrayi['Left'],
                      'Page'=>$arrayi['Page'],
                      'order_id'=>$arrayi['order_id'],
                      'type'=>2,
                      'year1'=>'H1-2020',
                      'file' => 'http://kreditaid.com/uat/upload/mgt/p4728ec6a.pdf'
                    );
            $insert = $this->admin->insert('llp2data', $array);
        }
        echo $this->db->last_query();

    }

    public function testjson1()
    {


$month = date('m');

if($month == 4){

}
$year = date('Y');

$year = date("Y");
$year1 = $year -1;
$year2 = $year -2;
$year3 = $year -3;

echo $year;echo $year1;echo $year2;echo $year3;

if($year == 2020){
   echo "<br />December is the year :)";
} else {
   echo "<br /> The month is probably not December";
}
exit;


                $json = @file_get_contents('https://api.ocr.space/parse/imageurl?apikey=5a64d478-9c89-43d8-88e3-c65de9999580&url=http://kreditaid.com/uat/upload/mgt/p054718ba.pdf&language=eng&isOverlayRequired=true');



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
           'order_id'=>223,
            );
//print_r($array1); exit;
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

//print_r($array1); exit;
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

        echo $this->db->last_query();
    }



}
