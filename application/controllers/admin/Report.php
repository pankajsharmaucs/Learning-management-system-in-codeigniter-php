<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
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

    public function view_report($id)
    {
        header("Content-Type: text/html; charset=ISO-8859-1");
        $data['title'] = 'Dashboard | Orders';
        $data['menu'] = 'orders';
        $data['id']=$id;
        $data['session_user']=$this->session->userdata('admin_in');
        $this->load->model('Report_model');


        $data['order']=$this->Report_model->getOrderTrackingId($id);
        // $data['Item']=$this->Report_model->getReportByTrackingId($id);
        $data['Note']=$this->Report_model->getNotesByTrackingId($id);
        $data['Chart']=$this->Report_model->getChartByTrackingId($id);
        $this->load->model('Front_model');
        $data['MCA_Directors'] = $this->Front_model->getMCA_DirectorsByCompanytrackingid($id);
        // echo json_encode($data['MCA_Directors']);
        $this->load->library('Pdf2text');
        $a = new PDF2Text();
        $a->setFilename(base_url('upload/pdf/').$id.'/1.pdf');
        $a->decodePDF();
        $pdf_text= wordwrap($a->output(), 40, "<br>\n");
        $data['pdf_file']= str_replace('�', ' ', $pdf_text);
        // echo $data['pdf_file'];
        // $data['pdf_file']="";
        $this->load->view('admin/report/xbrl_final', $data, false);
        $this->load->view('admin/inc/footer', $data, false);
    }

    public function group_by($key, $data) {
    $result = array();

    foreach($data as $val) {
        if(array_key_exists($key, $val)){
            $result[$val[$key]][] = $val;
        }else{
            $result[""][] = $val;
        }
    }
  }

    public function final_report($id)
    {
        // $id='OfpW6mb3rG';
        $data['title']='UAT XBRL';
        $data['id']=$id;
        $data['session_user']=$this->session->userdata('admin_in');
        $this->load->model('Report_model');

        $data['order']=$this->Report_model->getOrderTrackingId($id);
        // $data['Item']=$this->Report_model->getReportByTrackingId($id);
        $data['Note']=$this->Report_model->getNotesByTrackingId($id);

        // echo json_encode($data);
        $this->load->view('admin/report/final_report', $data, false);
        $this->load->view('admin/inc/footer', $data, false);
    }

    public function pdf_report($id)
    {
        // $id='OfpW6mb3rG';
        $data['title']='UAT XBRL';
        $data['id']=$id;
        $data['session_user']=$this->session->userdata('admin_in');
        $this->load->model('Report_model');
        $this->load->model('Company_model');
        $data['order']=$this->Report_model->getOrderTrackingId($id);
        $data['company']=$this->Company_model->getCompanyByCin($data['order']['items']);

        // echo json_encode($data);
        $this->load->view('admin/report/pdf_report', $data, false);
    }

    public function pdf($id)
    {
        $data['title']='UAT XBRL';
        $data['id']=$id;
        $data['session_user']=$this->session->userdata('admin_in');
        $this->load->model('Report_model');
        $this->load->model('Company_model');
        $data['order']=$this->Report_model->getOrderTrackingId($id);
        $data['company']=$this->Company_model->getCompanyByCin($data['order']['items']);
        $this->load->library('Mpdf');
        // echo json_encode($data);

        $report=file_get_contents(base_url('upload/xbrl/'.$id.'/report.html'));
        $report=file_get_contents(base_url('upload/xbrl/'.$id.'/report.html'));


        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($report);
        $mpdf->Output('filename.pdf', 'F');
    }



    public function htmldata($id)
    {
        $local='upload/html/'.$id.'/data.html';
        $this->load->model('Front_model');
        $data['MCA_Directors'] = $this->Front_model->getMCA_DirectorsByCompanytrackingid($id);
        if (!file_exists($local)) {
          $data['id']=$id;
          $this->db->select('*');
          $this->db->where('tracking_id',$id);
          $this->db->limit(1);
          $query=$this->db->get('orders');
          $data['orders']=$query->row_array();
          $this->load->model('Report_model');
          $data['Chart']=$this->Report_model->getChartByTrackingId($id);
          // echo json_encode($data['orders']['items']);
          $source_url='http://103.108.220.175/CentralWebService/ConsumeAPIData.asmx/GetIndianFullReport?InroporationNo='.@$data['orders']['items'];
          // echo $source_url;
          $file=@file_get_contents($source_url);
          $data['company']=json_decode($file);
          $this->load->view('admin/report/Da_full_report', $data, false);
        }else{
          echo  file_get_contents($local);
        }
    }

    // public function htmldata($id)
    // {
    //     $local='upload/html/'.$id.'/data.html';
    //     if (!file_exists($local)) {
    //       $data['id']=$id;
    //       $source_url='https://biucs.com/demo/upload/xbrl/'.$id.'/data.json';
    //       $data['file_check']=false;
    //       $file=@file_get_contents($source_url);
    //       if($file){
    //         $data['file_check']=true;
    //         $result=json_decode($file);
    //         foreach ($result->factList as $fact) {
    //           $name = explode(':', $fact[1]->name);
    //           $name=$name[1];
    //           $value=@$fact[2]->value;
    //           $date=@$fact[2]->endInstant;
    //           $start=@$fact[2]->start;
    //           $dimensions=@$fact[2]->dimensions;
    //
    //           $data[$name]['value'][]=$value;
    //           $data[$name]['end'][]=$date;
    //           $data[$name]['start'][]=$start;
    //           $data[$name]['dimensions'][]=$dimensions;
    //         }
    //       }
    //       //print_r($data);
    //       //  echo json_encode($data); exit;
    //       // $data['load_css']=true;
    //
    //       echo  $this->load->view('report/pdf', $data, true);
    //     }else{
    //       echo  file_get_contents($local);
    //     }
    //
    //
    // }

       public function htmldattest($id)
    {
      //  $local='upload/html/'.$id.'/data.html';
      //  if (!file_exists($local)) {
          $data['id']=$id;
          $source_url='https://biucs.com/demo/upload/xbrl/'.$id.'/data.json';

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
//SSprint_r($data);
          echo json_encode($data); exit;
          // $data['load_css']=true;
        //  echo  $this->load->view('report/pdf', $data, true);
      //  }else{
       //   echo  file_get_contents($local);
      //  }


    }


    public function edit_htmldata($id)
    {
        $data['html']=$this->input->post('html');

        $file_url='./upload/html/'.$id.'/data.html';
        if (!is_dir('upload/html/'.$id.'/')) {
          mkdir('upload/html/'.$id, 0777, true);
        }

        $this->load->helper('file');
        shell_exec('sudo chmod 777 -R upload/html/'.$id);
        shell_exec('sudo chmod 777 '.$file_url);
        if (file_exists($file_url)) {
            shell_exec('sudo rm '.$file_url);
        }
        if (! write_file($file_url, $data['html'])) {
            $return['message']=$data['html'];
            $return['status']='Error';
        } else {
            $return['status']='Success';
        }
        echo json_encode($return);
    }


    public function sendtoDa($id)
    {
        $xbrl=$this->input->get('xbrl');
        $pdf=$this->input->get('pdf');
        $this->load->model('Cart_model');
        $data['message']=$this->Cart_model->updateDA($id);
        echo json_encode($data['message']);
        // redirect(base_url().'/admin/dashboard/downloader?xbrl='.$xbrl.'&pdf='.$pdf);
    }

    public function addnotes($id)
    {
        $data=array();
        $this->load->model('Report_model');
        $data=$this->Report_model->addNotes($id);
        echo json_encode($data);
        // redirect(base_url().'/admin/dashboard/downloader?xbrl='.$xbrl.'&pdf='.$pdf);
    }

    public function print(){
      $id=$this->input->get('id');
      $data['id']=$id;
      $local='upload/html/'.$id.'/data.html';

        if (file_exists($local)) {
          $data['html']=file_get_contents($local);
          $this->load->view('report/pdf2', $data, false);
        }
        // echo json_encode($data);
    }


    public function printpage(){
      $id=$this->input->get('id');
      $data['id']=$id;
      $local='https://uat.kreditaid.com/admin/report/print?id='.$id;
      echo $local;
      $data['html']=file_get_contents($local);
      $this->load->library('m_pdf');
      $mpdf=new mPDF();
      $mpdf->WriteHTML($data['html']);
      $mpdf->Output();

        // echo json_encode($data);
    }

    public function test2(){
      $id=$this->input->get('id');
      $data['id']=$id;
      $source_url='https://biucs.com/demo/upload/xbrl/'.$id.'/data.json';

      $file=file_get_contents($source_url);
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
      // echo json_encode($data);
      $this->load->view('report/pdf2', $data, false);
    }

    public function htmlfiles()
    {

        // echo json_encode($_POST);
        $table=$this->input->post('tables');
        $id=$this->input->post('id');
        // echo json_encode($table);
        // echo "<br>".$id;
        $data['id']=$id;
        $source_url='https://biucs.com/demo/upload/xbrl/'.$id.'/output2/FilingSummary.xml';
        $fileContents= @file_get_contents($source_url);
        $fileContents = str_replace(array("\n", "\r", "\t"), '', $fileContents);
        $fileContents = trim(str_replace('"', "'", $fileContents));
        $simpleXml = simplexml_load_string($fileContents);
        $report=$simpleXml->MyReports;
        //echo sizeof($report[0]->Report);

         for ($i=0; $i < sizeof($report[0]->Report) ; $i++) {
          // $data['Report']['name'][]=$report[0]->Report[$i]->LongName[0];
          $sheet=$report[0]->Report[$i]->LongName[0];
          for ($t=0; $t < sizeof($table); $t++) {

            if (strpos($sheet, $table[$t][0]) !== false) {
              // echo $sheet.":".$table[$t][0];
              $filename=$report[0]->Report[$i]->HtmlFileName[0];
              $file_url='https://biucs.com/demo/upload/xbrl/'.$id."/"."output2/".$filename;
              // echo $file_url;
              $file[$table[$t][1]]=@file_get_contents($file_url);

            }

          }
         }
         echo json_encode($file);

    }

    public function test_api(){
      // $id=$this->input->get('id');
      // $data['id']=$id;
      $source_url=base_url().'/data.json';

      $file=file_get_contents($source_url);
      $data['company']=json_decode($file);
      // echo $data['company']->OrgMaster[0]->CompanyName;
      // echo json_encode($data);
      $this->load->view('report/pdf_api', $data, false);
    }

}
