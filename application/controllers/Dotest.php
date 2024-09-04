<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Dotest extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Common_model');
        $this->load->model('Send_mail');
    }

    public function server(){
      echo "Free Space :".disk_free_space('/root');
      echo "<br>";
      echo "Total Space :".disk_total_space('/root');
    }
    public function index(){
    $source_url='https://centralwebservice.azurewebsites.net/ConsumeAPIData.asmx/GetIndianFullReport?InroporationNo=L17110MH1973PLC019786';
    $file=@file_get_contents($source_url);
    $data['company']=json_decode($file);
    $html=$this->load->view('report/pdf_api2', $data, true);

    $this->load->library('Mpdf');

    ///////////////////////////WATERMARK CODE//////////////////////////////////////////////////
    $mpdf=new mPDF('c');

      // $mpdf->SetDisplayMode('fullpage');
      // $mpdf->SetWatermarkText('Kredit Aid');
      // $mpdf->watermark_font = 'DejaVuSansCondensed';
      // $mpdf->watermarkTextAlpha = 0.1;
      // $mpdf->showWatermarkText = true;
    ///////////////////////WATERMARK CODE//////////////////////////////////////////////////////
    ///////////////////////PAGE NUMBER///////////////////////////////////////////////////
          // $mpdf->mirrorMargins = 1;

          // $mpdf->defaultPageNumStyle = '1';
//
          // $mpdf->SetDisplayMode('fullpage','two');
        ///////////////////////PAGE NUMBER///////////////////////////////////////////////////

        // $mpdf->defaultfooterfontsize = 12;  /* in pts */
        // $mpdf->defaultfooterfontstyle = B;  /* blank, B, I, or BI */
        // $mpdf->defaultfooterline = 0;   /* 1 to include line below header/above footer */
        // $mpdf->SetHTMLFooter('<div style="text-align: center;">{PAGENO}</div>','O');    /* defines footer for Odd and Even Pages - placed at Outer margin */
        // $mpdf->SetHTMLFooter('<div style="text-align: center;">{PAGENO}</div>','E');    /* defines footer for Odd and Even Pages - placed at Outer margin */
        $body =  $mpdf->WriteHTML($html);
        // $mpdf->SetDisplayMode('fullpage');
        //download it D save F.
        // fopen($pdfFilePath,'wb');
        $mpdf->Output($pdfFilePath, "D");
        // $mpdf->Output($pdfFilePath, "F");
    }




}
