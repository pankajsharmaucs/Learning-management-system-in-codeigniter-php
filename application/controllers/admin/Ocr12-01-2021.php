<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once "/var/www/tools/MTS/EnableMTS.php";
class Ocr extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        Utils::no_cache();
        if (!$this->session->userdata('admin_in')) {
            redirect(base_url('admin/auth/login'));
            exit;
        }
        $this->load->model('Common_model');
        $this->load->model('Send_mail');
        $this->load->model('Crud_model');
        $GLOBALS['a'] = $this->session->userdata('ocr_id');
    }

   public function mgt($id)
    {
        $data['title'] = 'Data Analyst';
        $data['menu'] = 'DA_logs';

        $data['session_user']=$this->session->userdata('admin_in');
        $this->load->model('Cart_model');
        $data['Orders'] = $this->Cart_model->getDetailedReportOrders();
        $data['rolls']= json_decode($data['session_user']['roll']);
        $notify=$this->Common_model->GetData('notification', "", "production_user='0' and type='da'");
        $data['count']=count($notify);
        $session = array(
                           'ocr_id'=>$id,
                        );
                $this->session->set_userdata($session);
        if (in_array("Data Analyst", $data['rolls'])) {
         //   $this->load->view('admin/inc/header', $data, false);
            //$this->load->view('admin/DA/dashboard', $data, false);
            $this->load->view('admin/DA/mgt_detail', $data, false);
          //  $this->load->view('admin/inc/footer', $data, false);
        }
    }

  function action($id)
  {
  //this->load->model("excel_export_model");
    $this->load->library("excel");
    $object = new PHPExcel();

    $object->setActiveSheetIndex(0);

    $table_columns = array("ID", "Name", "Email", 
    "Mobile","Status", "Units", "Date"
    );

    $column = 0;
    foreach($table_columns as $field)
    {
      $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
      $column++;
    }

    $employee_data =$this->admin->getRows('SELECT u.name,u.email,e.* FROM users u,e_wallet e where e.user_id =u.id and e.user_id ="'.$id.'" ');

    $excel_row = 2;
        $i=0;
        $rating_received=0;
        $Rating_gave=0;
    foreach($employee_data as $row)
    { $i++;
    
        
    if($row->status == 2){ $status = "Purchase";}else{$status = "Credit";}
         //Sl. No", "Name", "Mobile", "Email", 
      $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->id);
      $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->name);
      $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->email);

    
      $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $status);
      $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->coin);
      $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->datetime);

         //"Amount Pending to Pay to Passenger ", "Total Amount Already Paid to the Passenger till date", "Current eWallet Balance"   
     $excel_row++;
     }

    $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="eWallet.xls"');
    $object_writer->save('php://output');
  }


      public function ocr1($id)
    {
        $data['title'] = 'Data Analyst';
        $data['menu'] = 'DA_logs';

        $data['session_user']=$this->session->userdata('admin_in');
        $this->load->model('Cart_model');
        $data['Orders'] = $this->Cart_model->getDetailedReportOrders();
        $data['rolls']= json_decode($data['session_user']['roll']);
        $notify=$this->Common_model->GetData('notification', "", "production_user='0' and type='da'");
        $data['count']=count($notify);
        $session = array(
                                 'ocr_id'=>$id,


                                );
                $this->session->set_userdata($session);
        if (in_array("Data Analyst", $data['rolls'])) {
         //   $this->load->view('admin/inc/header', $data, false);
            //$this->load->view('admin/DA/dashboard', $data, false);
            $this->load->view('admin/DA/ocr_detail', $data, false);
          //  $this->load->view('admin/inc/footer', $data, false);
        }
    }

     public function llp8($id)
    {
        $data['title'] = 'Data Analyst';
        $data['menu'] = 'DA_logs';

        $data['session_user']=$this->session->userdata('admin_in');
        $this->load->model('Cart_model');
        $data['Orders'] = $this->Cart_model->getDetailedReportOrders();
        $data['rolls']= json_decode($data['session_user']['roll']);
        $notify=$this->Common_model->GetData('notification', "", "production_user='0' and type='da'");
        $data['count']=count($notify);
                $session = array(
                                 'ocr_id'=>$id,
                                );
                $this->session->set_userdata($session);
        if (in_array("Data Analyst", $data['rolls'])) {
         //   $this->load->view('admin/inc/header', $data, false);
            //$this->load->view('admin/DA/dashboard', $data, false);
            $this->load->view('admin/DA/llp8_detail', $data, false);
          //  $this->load->view('admin/inc/footer', $data, false);
        }
    }


     public function ocr2($id)
    {
        $data['title'] = 'Data Analyst';
        $data['menu'] = 'DA_logs';

        $data['session_user']=$this->session->userdata('admin_in');
        $this->load->model('Cart_model');
        $data['Orders'] = $this->Cart_model->getDetailedReportOrders();
        $data['rolls']= json_decode($data['session_user']['roll']);
        $notify=$this->Common_model->GetData('notification', "", "production_user='0' and type='da'");
        $data['count']=count($notify);
        $session = array(
                                 'ocr_id'=>$id,


                                );
                $this->session->set_userdata($session);
        if (in_array("Data Analyst", $data['rolls'])) {
         //   $this->load->view('admin/inc/header', $data, false);
            //$this->load->view('admin/DA/dashboard', $data, false);
            $this->load->view('admin/DA/ocr_detail1', $data, false);
          //  $this->load->view('admin/inc/footer', $data, false);
        }
    }
       public function aoc($id)
    {
        $data['title'] = 'Data Analyst';
        $data['menu'] = 'DA_logs';



        $data['session_user']=$this->session->userdata('admin_in');
        $this->load->model('Cart_model');
        $data['Orders'] = $this->Cart_model->getDetailedReportOrders();
        $data['rolls']= json_decode($data['session_user']['roll']);
        $notify=$this->Common_model->GetData('notification', "", "production_user='0' and type='da'");
        $data['count']=count($notify);
        $session = array(
                                 'ocr_id'=>$id,


                                );
                $this->session->set_userdata($session);



        if (in_array("Data Analyst", $data['rolls'])) {
         //   $this->load->view('admin/inc/header', $data, false);
            //$this->load->view('admin/DA/dashboard', $data, false);
            $this->load->view('admin/DA/aoc_detail', $data, false);
          //  $this->load->view('admin/inc/footer', $data, false);
        }
    }

     public function llp2($id)
    {
        $data['title'] = 'Data Analyst';
        $data['menu'] = 'DA_logs';

        $data['session_user']=$this->session->userdata('admin_in');
        $this->load->model('Cart_model');
        $data['Orders'] = $this->Cart_model->getDetailedReportOrders();
        $data['rolls']= json_decode($data['session_user']['roll']);
        $notify=$this->Common_model->GetData('notification', "", "production_user='0' and type='da'");
        $data['count']=count($notify);
        $session = array(
                                 'ocr_id'=>$id,


                                );
                $this->session->set_userdata($session);



        if (in_array("Data Analyst", $data['rolls'])) {
         //   $this->load->view('admin/inc/header', $data, false);
            //$this->load->view('admin/DA/dashboard', $data, false);
            $this->load->view('admin/DA/llp2_detail', $data, false);
          //  $this->load->view('admin/inc/footer', $data, false);
        }
    }

     public function pass3($id)
    {
        $data['title'] = 'Data Analyst';
        $data['menu'] = 'DA_logs';

        $data['session_user']=$this->session->userdata('admin_in');
        $this->load->model('Cart_model');
        $data['Orders'] = $this->Cart_model->getDetailedReportOrders();
        $data['rolls']= json_decode($data['session_user']['roll']);
        $notify=$this->Common_model->GetData('notification', "", "production_user='0' and type='da'");
        $data['count']=count($notify);
        $session = array(
                                 'ocr_id'=>$id,


                                );
                $this->session->set_userdata($session);



        if (in_array("Data Analyst", $data['rolls'])) {
         //   $this->load->view('admin/inc/header', $data, false);
            //$this->load->view('admin/DA/dashboard', $data, false);
            $this->load->view('admin/DA/pass3_detail', $data, false);
          //  $this->load->view('admin/inc/footer', $data, false);
        }
    }

     public function llp11($id)
    {
        $data['title'] = 'Data Analyst';
        $data['menu'] = 'DA_logs';

        $data['session_user']=$this->session->userdata('admin_in');
        $this->load->model('Cart_model');
        $data['Orders'] = $this->Cart_model->getDetailedReportOrders();
        $data['rolls']= json_decode($data['session_user']['roll']);
        $notify=$this->Common_model->GetData('notification', "", "production_user='0' and type='da'");
        $data['count']=count($notify);
        $session = array(
                                 'ocr_id'=>$id,


                                );
                $this->session->set_userdata($session);



        if (in_array("Data Analyst", $data['rolls'])) {
         //   $this->load->view('admin/inc/header', $data, false);
            //$this->load->view('admin/DA/dashboard', $data, false);
            $this->load->view('admin/DA/llp11_detail', $data, false);
          //  $this->load->view('admin/inc/footer', $data, false);
        }
    }

 public function add_aoc()
    {   ini_set('max_execution_time', 0);
    $cin=$this->input->post('cinno');
    $id=$this->input->post('id');





    $head=$this->input->post('head');
    $year=$this->input->post('year');
    $head1=$this->input->post('head1');
    $year1=$this->input->post('year1');
    $head2=$this->input->post('head2');
    $year2=$this->input->post('year2');

    $Mapping=$head.'-'.$year.','.$head1.'-'.$year1.','.$head2.'-'.$year2;

//print_r($value3);
//print_r($value4);
//print_r($p_FinancialYear1);
//print_r($p_FinancialYear2);

    $company=$this->admin->getRow("SELECT * FROM company WHERE cin = '".$cin."'");


//$getdatadirectors=$this->admin->getRows("SELECT * FROM comp_director cd, directors d WHERE cd.cid = '".$company->id."' and cd.did=d.id");
$getdatadirectors=$this->admin->getRows("SELECT * FROM scrap_dir WHERE cin = '".$cin."'");
$Directors= array();

   foreach($getdatadirectors as $getdatadirectorsi){
 $Directors[] = array(
          "DirectorName" => $getdatadirectorsi->name,
          "DDesignation" => $getdatadirectorsi->designation,
          "OrderNo" => "",
          "DOB" => '',
          "DOJ" => $getdatadirectorsi->DOA,
          "Qualification" => "",
          "Experience" => "",
          "Mobile" => "",
          "Nationality" => "",
          "EMail" => "",
          "Comments" => "",
          "NationalityNew" => "",
          "BirthPlace" => "",
          "LanguageKnown" => "",
          "ActivelyInvolved" => "",
          "NoofVehicles" =>"",
          "NationalityID" => "",
          "GenderType" => "",
          "IdentificationNumber" => $getdatadirectorsi->din,
        );
}
//$getdatacharge=$this->admin->getRows("SELECT * FROM `charges` WHERE `cin` LIKE 'L00305MH1973PLC174201'");

$getdatacharge=$this->admin->getRows("SELECT * FROM mca_charges WHERE cin = '".$cin."'");

$HypothecationDetails= array();

   foreach($getdatacharge as $getdatachargei){
 $HypothecationDetails[] = array(
          "Banker" => $getdatachargei->Charge_Holder,
          "DateOfAgreement" => $getdatachargei->Closure_Date,
          "HypothecationOf" => $getdatachargei->charge_holder_name,
          "Amount" => $getdatachargei->amount,
          "OrderNo" => "",
          "Modification_Date" => $getdatachargei->date_of_modification,
          "Creation_Date" => $getdatachargei->date_of_creation,
          "ChargeID" => $getdatachargei->chargeid,
          "ChargeStatus" => "",
          "Comment" => ""
);
}


        $type=$this->input->post('type');
    $typecount = count($type);
 for($t=0;$t<$typecount;$t++){


    $b_MainHead=$this->input->post('b_MainHead'.$type[$t]);
    $b_Head=$this->input->post('b_Head'.$type[$t]);
    $b_SubHead=$this->input->post('b_SubHead'.$type[$t]);
    $b_FinancialYear1=$this->input->post('b_FinancialYear1'.$type[$t]);
    $b_FinancialYear2=$this->input->post('b_FinancialYear2'.$type[$t]);
    $p_Head=$this->input->post('p_Head'.$type[$t]);
    $p_SubHead=$this->input->post('p_SubHead'.$type[$t]);
    $p_FinancialYear1=$this->input->post('p_FinancialYear1'.$type[$t]);
    $p_FinancialYear2=$this->input->post('p_FinancialYear2'.$type[$t]);
    $value1=$this->input->post('value1'.$type[$t]);
    $value2=$this->input->post('value2'.$type[$t]);
    $value3=$this->input->post('value3'.$type[$t]);
    $value4=$this->input->post('value4'.$type[$t]);
    $temp = count($b_FinancialYear1);
    $temp1 = count($b_FinancialYear2);
    $temp2 = count($p_FinancialYear1);
    $temp3 = count($p_FinancialYear2);

    //$BasicDetails= array();
   $BasicDetails = array(
          'IncorporationNumber' => $company->cin,
          'NameOfCompany' => $company->name,
          'RegisteredAddress' => $company->address,
          'EmailID'  => $company->email,
          "BusinessType" => $company->category,
          "Country"  => "India",
          "PANNo"    =>  $company->pan,
          "Activity" =>  $company->activity,
          "Mapping"  =>  $Mapping,
          "AuthorisedCapital" => $company->authourisedCapital,
          "DateOfIncorporation" => $company->dateofincorporation,
          "PaidupCapital" => $company->paidUpCaiptal,
          "Phone"    =>  '',
          "Website"  => '',
        );
    $BalanceSheet= array();
 for($i=0;$i<$temp;$i++){
   $BalanceSheet[] = array(
    'MainHead' =>  $b_MainHead[$i],
    'Head' => $b_Head[$i],
    'SubHead' => $b_SubHead[$i],
    'Value'=>str_replace(" ","",$value1[$i]),
      'FinancialYear'=>$b_FinancialYear1[$i],
    );
  }

   for($j=0;$j<$temp1;$j++){
   $BalanceSheet[] = array(
    'MainHead' =>  $b_MainHead[$j],
    'Head' => $b_Head[$j],
    'SubHead' => $b_SubHead[$j],
     'Value'=>str_replace(" ","",$value2[$j]),
     'FinancialYear'=>$b_FinancialYear2[$j],
    );
  }
//print_r($BalanceSheet);

$ProfitAndLoss= array();

 for($k=0;$k<$temp2;$k++){
   $ProfitAndLoss[] = array(
    'Head' => $p_Head[$k],
    'SubHead' => $p_SubHead[$k],
     'Value'=>$value3[$k],
   // 'FinancialYear'=>$p_FinancialYear2[$k],
     'FinancialYear'=>$p_FinancialYear1[$k],


    );
  }
  for($l=0;$l<$temp3;$l++){
   $ProfitAndLoss[] = array(
    'Head' => $p_Head[$l],
    'SubHead' => $p_SubHead[$l],
     'Value'=>$value4[$l],
  'FinancialYear'=>$p_FinancialYear2[$l],

    );
  }


//print_r($ProfitAndLoss);exit;
$Auditors[] = array(
          'AuditorName' =>$this->input->post('AuditorName'.$type[$t]),
          'MembershipNo' => $this->input->post('MembershipNo'.$type[$t]),
          'NameOfAuditFirm' =>$this->input->post('NameOfAuditFirm'.$type[$t]),
          'AddressOfAuditors' => $this->input->post('AddressOfAuditors'.$type[$t]),
          'PANNo' => $this->input->post('PANNo'.$type[$t]),
          'SRNOfADT' =>''
        );


 $dataaaray[] = array(
    'BasicDetails' => $BasicDetails,
    'Directors' => $Directors,
    'HypothecationDetails' => $HypothecationDetails,
    'Auditors' => $Auditors,
    'BalanceSheet' => $BalanceSheet,
    'ProfitAndLoss'=>$ProfitAndLoss,
);

$dataaar= array(
   "json"=>$dataaaray
);
    

$payload = json_encode($dataaar);

    //print_r($payload);  exit;


$url ="http://ec2-15-206-122-169.ap-south-1.compute.amazonaws.com:8080/CentralWebService/ConsumeAOC.asmx/InsertAOCDataINCWS";

$ch = curl_init( $url );
# Setup request to send json via POST.
//$payload = json_encode( array( "customer"=> $data ) );
curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
# Return response instead of printing.
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
# Send request.
$result = curl_exec($ch);
echo $result;
print_r($result);
curl_close($ch);
 
 //redirect(base_url().'admin/dashboard/aoc/'.$id);
}
print_r($payload); 
    }

  public function add_aoc44()
    {   ini_set('max_execution_time', 0);
    $cin=$this->input->post('cinno');
    $id=$this->input->post('id');
    $b_MainHead=$this->input->post('b_MainHead');
    $b_Head=$this->input->post('b_Head');
    $b_SubHead=$this->input->post('b_SubHead');
    $b_FinancialYear1=$this->input->post('b_FinancialYear1');
    $b_FinancialYear2=$this->input->post('b_FinancialYear2');
    $p_Head=$this->input->post('p_Head');
    $p_SubHead=$this->input->post('p_SubHead');
    $p_FinancialYear1=$this->input->post('p_FinancialYear1');
    $p_FinancialYear2=$this->input->post('p_FinancialYear2');
    $value1=$this->input->post('value1');
    $value2=$this->input->post('value2');
    $value3=$this->input->post('value3');
    $value4=$this->input->post('value4');
    $temp = count($b_FinancialYear1);
    $temp1 = count($b_FinancialYear2);
    $temp2 = count($p_FinancialYear1);
    $temp3 = count($p_FinancialYear2);
    $BalanceSheet= array();

        $head=$this->input->post('head');
    $year=$this->input->post('year');
 $head1=$this->input->post('head1');
    $year1=$this->input->post('year1');
     $head2=$this->input->post('head2');
    $year2=$this->input->post('year2');

    $Mapping=$head.'-'.$year.','.$head1.'-'.$year1.','.$head2.'-'.$year2;

//print_r($value3);
//print_r($value4);
//print_r($p_FinancialYear1);
//print_r($p_FinancialYear2);
 for($i=0;$i<$temp;$i++){
   $BalanceSheet[] = array(
    'MainHead' =>  $b_MainHead[$i],
    'Head' => $b_Head[$i],
    'SubHead' => $b_SubHead[$i],
    'Value'=>str_replace(" ","",$value1[$i]),
      'FinancialYear'=>$b_FinancialYear1[$i],
    );
  }

   for($j=0;$j<$temp1;$j++){
   $BalanceSheet[] = array(
    'MainHead' =>  $b_MainHead[$j],
    'Head' => $b_Head[$j],
    'SubHead' => $b_SubHead[$j],
     'Value'=>str_replace(" ","",$value2[$j]),
     'FinancialYear'=>$b_FinancialYear2[$j],
    );
  }
//print_r($BalanceSheet);

$ProfitAndLoss= array();

 for($k=0;$k<$temp2;$k++){
   $ProfitAndLoss[] = array(
    'Head' => $p_Head[$k],
    'SubHead' => $p_SubHead[$k],
     'Value'=>$value3[$k],
   // 'FinancialYear'=>$p_FinancialYear2[$k],
     'FinancialYear'=>$p_FinancialYear1[$k],


    );
  }
  for($l=0;$l<$temp3;$l++){
   $ProfitAndLoss[] = array(
    'Head' => $p_Head[$l],
    'SubHead' => $p_SubHead[$l],
     'Value'=>$value4[$l],
  'FinancialYear'=>$p_FinancialYear2[$l],

    );
  }


//print_r($ProfitAndLoss);exit;
$Auditors[] = array(
          'AuditorName' =>$this->input->post('AuditorName'),
          'MembershipNo' => $this->input->post('MembershipNo'),
          'NameOfAuditFirm' =>$this->input->post('NameOfAuditFirm'),
          'AddressOfAuditors' => $this->input->post('AddressOfAuditors'),
          'PANNo' => $this->input->post('PANNo'),
          'SRNOfADT' =>''
        );
$company=$this->admin->getRow("SELECT * FROM company WHERE cin = '".$cin."'");

   $BasicDetails[] = array(
          'IncorporationNumber' => $company->cin,
          'NameOfCompany' => $company->name,
          'RegisteredAddress' => $company->address,
          'EmailID' => $company->email,
          "BusinessType" => $company->category,
          "Country" => "India",
          "PANNo" =>  $company->pan,
          "Activity" =>  $company->activity,
          "Mapping" =>$Mapping,
          "AuthorisedCapital" => $company->authourisedCapital,
          "DateOfIncorporation" => $company->dateofincorporation,
          "PaidupCapital" => $company->paidUpCaiptal,
          "Phone" =>  '',
          "Website" => '',
        );

//$getdatadirectors=$this->admin->getRows("SELECT * FROM comp_director cd, directors d WHERE cd.cid = '".$company->id."' and cd.did=d.id");
$getdatadirectors=$this->admin->getRows("SELECT * FROM mca_directors WHERE cin = '".$cin."'");
$Directors= array();

   foreach($getdatadirectors as $getdatadirectorsi){
 $Directors[] = array(
          "DirectorName" => $getdatadirectorsi->name,
          "DDesignation" => $getdatadirectorsi->designation,
          "OrderNo" => "",
          "DOB" => '',
          "DOJ" => $getdatadirectorsi->DOA,
          "Qualification" => "",
          "Experience" => "",
          "Mobile" => "",
          "Nationality" => "",
          "EMail" => "",
          "Comments" => "",
          "NationalityNew" => "",
          "BirthPlace" => "",
          "LanguageKnown" => "",
          "ActivelyInvolved" => "",
          "NoofVehicles" =>"",
          "NationalityID" => "",
          "GenderType" => "",
          "IdentificationNumber" => $getdatadirectorsi->din,
        );
}
//$getdatacharge=$this->admin->getRows("SELECT * FROM `charges` WHERE `cin` LIKE 'L00305MH1973PLC174201'");

$getdatacharge=$this->admin->getRows("SELECT * FROM mca_charges WHERE cin = '".$cin."'");

$HypothecationDetails= array();

   foreach($getdatacharge as $getdatachargei){
 $HypothecationDetails[] = array(
          "Banker" => $getdatachargei->Charge_Holder,
          "DateOfAgreement" => $getdatachargei->Closure_Date,
          "HypothecationOf" => $getdatachargei->charge_holder_name,
          "Amount" => $getdatachargei->amount,
          "OrderNo" => "",
          "Modification_Date" => $getdatachargei->date_of_modification,
          "Creation_Date" => $getdatachargei->date_of_creation,
          "ChargeID" => $getdatachargei->chargeid,
          "ChargeStatus" => "",
          "Comment" => ""
);
}


 $dataaaray[] = array(
    'BasicDetails' => $BasicDetails,
    'Directors' => $Directors,
    'HypothecationDetails' => $HypothecationDetails,
    'Auditors' => $Auditors,
    'BalanceSheet' => $BalanceSheet,
    'ProfitAndLoss'=>$ProfitAndLoss,
);

$dataaar= array(
   "json"=>$dataaaray
);
    $payload = json_encode($dataaar);

    //print_r($payload);  exit;



$url ="http://ec2-15-206-122-169.ap-south-1.compute.amazonaws.com:8080/CentralWebService/ConsumeAOC.asmx/InsertAOCDataINCWS";

                     $ch = curl_init( $url );
# Setup request to send json via POST.
//$payload = json_encode( array( "customer"=> $data ) );
curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
# Return response instead of printing.
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
# Send request.
$result = curl_exec($ch);
curl_close($ch);
//print_r($payload);  exit;

 //redirect(base_url().'admin/dashboard/aoc/'.$id);

    }


     public function add_pass3()
    {   ini_set('max_execution_time', 0);
    $cin=$this->input->post('cinno');
    $id=$this->input->post('id');

    $share_type=$this->input->post('share_type');
    $share_category=$this->input->post('share_category');
    $share_category_no=$this->input->post('share_category_no');
    $share_description=$this->input->post('share_description');
    $name_ofshare_holder=$this->input->post('name_ofshare_holder');
    $no_of_share=$this->input->post('no_of_share');
    $percentage=$this->input->post('percentage');

    $temp = count($share_type);

    
    

$ShareHolders= array();
 for($i=0;$i<$temp;$i++){
   $ShareHolders[] = array(
   "ShareType"=> $share_type[$i],
   "ShareCategory"=> $share_category[$i].'-'.$share_category_no[$i],
   "ShareDescription"=> $share_description[$i],
   "NameOfShareHolder"=> $no_of_share[$i],
   "NoOfShares"=>$no_of_share[$i],
   "PercentageHolding"=> $percentage[$i]
    );
  }

  



$company=$this->admin->getRow("SELECT cin FROM company WHERE cin = '".$cin."'");

$BasicDetails = array(
          'IncorporationNumber' => $company->cin,
          'FileType' => "Primary"
        );


 $dataaaray[] = array(
    'BasicDetails' => $BasicDetails,
    'ShareHolders' => $ShareHolders
);

$dataaar= array(
   "json"=>$dataaaray
);
    $payload = json_encode($dataaar);





$url ="http://103.108.220.175/CentralWebService/ConsumePas-3.asmx/InsertPass3DataINCWS";

$ch = curl_init( $url );
# Setup request to send json via POST.
//$payload = json_encode( array( "customer"=> $data ) );
curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
# Return response instead of printing.
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
# Send request.
$result = curl_exec($ch);
print_r($result);
echo $result;
curl_close($ch);
//print_r($payload);  exit;

 //redirect(base_url().'admin/dashboard/aoc/'.$id);
print_r($payload);  exit;
    }

  public function add_llp8()
    {   ini_set('max_execution_time', 0);
    $cin=$this->input->post('cinno');
    $id=$this->input->post('id');

    $main_head=$this->input->post('main_head');
    $head=$this->input->post('Head');
    $sub_head=$this->input->post('MainHead');
    $value=$this->input->post('value');
     $date=$this->input->post('year');

    $main_head2=$this->input->post('main_headpl');
    $head2=$this->input->post('Headpl');
    $sub_head2=$this->input->post('MainHeadpl');

        $value2=$this->input->post('valuepl');
    $datepl=$this->input->post('yearpl');
  

    $temp = count($main_head);
    $temp2 = count($main_head2);
    
    

$BalanceSheet= array();
 for($i=0;$i<$temp;$i++){
   $BalanceSheet[] = array(
   "HeadID"=> $main_head[$i],
   "Value"=> $value[$i],

          "FinancialYear"=>"31-03-".$date[$i],
    );
  }
$ProfitAndLoss= array();
 for($i=0;$i<$temp2;$i++){
   $ProfitAndLoss[] = array(
   "HeadID"=> $main_head2[$i],
  
   "Value"=> $value2[$i],

          "FinancialYear"=>"31-03-".$datepl[$i],
    );
  }
  



 $company=$this->admin->getRow("SELECT cin FROM company WHERE cin = '".$cin."'");

$BasicDetails = array(
          'IncorporationNumber' => $company->cin,
            "Mapping"=>"H1-2019,H2-2018,H3-2017",
          "FileType"=>"Primary",
          "FormType"=>"Form-8",
         
        );

$dataaaray[] = array(
    'BasicDetails'  => $BasicDetails,
    'BalanceSheet'  => $BalanceSheet,
    'ProfitAndLoss' => $ProfitAndLoss
);

$dataaar= array(
   "json"=>$dataaaray
);
    $payload = json_encode($dataaar);





$url ="http://103.108.220.175/CentralWebService/ConsumeLLPForm-8Data.asmx";

                     $ch = curl_init( $url );
# Setup request to send json via POST.
//$payload = json_encode( array( "customer"=> $data ) );
curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
# Return response instead of printing.
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
# Send request.
$result = curl_exec($ch);
curl_close($ch);
echo $result;
print_r($result);
//print_r($payload);  exit;

 //redirect(base_url().'admin/dashboard/aoc/'.$id);
    print_r($payload);  exit;

    }

         public function add_llp11()
    {   ini_set('max_execution_time', 0);
    $cin=$this->input->post('cinno');
    $id=$this->input->post('id');

     $PartnerName=$this->input->post('PartnerName');
    $Designation=$this->input->post('Designation');
    $Contribution=$this->input->post('Contribution');
   

    $temp = count($PartnerName);

    
    

  

$ShareHolders= array();
 for($i=0;$i<$temp;$i++){
   $ShareHolders[] = array(
   "PartnerName" => $PartnerName[$i],
   "Designation" => $Designation[$i],
   "Contribution" => $Contribution[$i],
    );
  }

$company=$this->admin->getRow("SELECT cin FROM company WHERE cin = '".$cin."'");

   $BasicDetails[] = array(
          'IncorporationNumber' => $company->cin,
          "Mapping"=> "H1-2019,H2-2018,H3-2017",
          "FormType"=> "Form-11",
          "FinancialYear"=> "2020"
        );


 $dataaaray = array(
    'BasicDetails' => $BasicDetails,
    'Partners' => $ShareHolders
   );


$dataaar= array(
   "json"=>$dataaaray
);
    $payload = json_encode($dataaar);


    print_r($payload);  exit;


$url ="http://103.108.220.175/CentralWebService/ConsumeLLPData.asmx";

                     $ch = curl_init( $url );
# Setup request to send json via POST.
//$payload = json_encode( array( "customer"=> $data ) );
curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
# Return response instead of printing.
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
# Send request.
$result = curl_exec($ch);
curl_close($ch);
//print_r($payload);  exit;

 //redirect(base_url().'admin/dashboard/aoc/'.$id);
    print_r($payload);  exit;

    }

   public function add_llp2()
    {   
    ini_set('max_execution_time', 0);
    $cin=$this->input->post('cinno');
    $id=$this->input->post('id');

    $PartnerName=$this->input->post('PartnerName');
    $Designation=$this->input->post('Designation');
    $Contribution=$this->input->post('Contribution');
   

    $temp = count($PartnerName);

   $ShareHolders= array();
 for($i=0;$i<$temp;$i++){
   $ShareHolders[] = array(
   "PartnerName" => $PartnerName[$i],
   "Designation" => $Designation[$i],
   "Contribution" => $Contribution[$i],
    );
  }

$company=$this->admin->getRow("SELECT cin FROM company WHERE cin = '".$cin."'");

   $BasicDetails[] = array(
          'IncorporationNumber' => $company->cin,
          "Mapping"=> "H1-2019,H2-2018,H3-2017",
          "FormType"=> "Form-11",
          "FinancialYear"=> "2020",
          "MobileNo"=>"9926527002"
        );


 $dataaaray[] = array(
    'BasicDetails' => $BasicDetails,
    'Partners' => $ShareHolders
   );

$dataaar= array(
   "json"=>$dataaaray
);
    $payload = json_encode($dataaar);


   // print_r($payload);  exit;


$url ="http://103.108.220.175/CentralWebService/ConsumeLLPData.asmx/InsertLLPDataINCWS";
//$url ="http://103.108.220.175/CentralWebService/ConsumePas-3.asmx/InsertPass3DataINCWS";

$ch = curl_init( $url );
# Setup request to send json via POST.
//$payload = json_encode( array( "customer"=> $data ) );
curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
# Return response instead of printing.
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
# Send request.
$result = curl_exec($ch);
curl_close($ch);
echo $result;
//print_r($payload);  exit;

 //redirect(base_url().'admin/dashboard/aoc/'.$id);
    print_r($payload);  exit;

    }

 


     public function add_llp11999()
    {   ini_set('max_execution_time', 0);
    $cin=$this->input->post('cinno');
    $id=$this->input->post('id');
    $b_MainHead=$this->input->post('b_MainHead');
    $b_Head=$this->input->post('b_Head');
    $b_SubHead=$this->input->post('b_SubHead');
    $b_FinancialYear1=$this->input->post('b_FinancialYear1');
    $b_FinancialYear2=$this->input->post('b_FinancialYear2');
    $p_Head=$this->input->post('p_Head');
    $p_SubHead=$this->input->post('p_SubHead');
    $p_FinancialYear1=$this->input->post('p_FinancialYear1');
    $p_FinancialYear2=$this->input->post('p_FinancialYear2');
    $value1=$this->input->post('value1');
    $value2=$this->input->post('value2');
    $value3=$this->input->post('value3');
    $value4=$this->input->post('value4');
    $temp = count($b_FinancialYear1);
    $temp1 = count($b_FinancialYear2);
    $temp2 = count($p_FinancialYear1);
    $temp3 = count($p_FinancialYear2);
    $BalanceSheet= array();

        $head=$this->input->post('head');
    $year=$this->input->post('year');
 $head1=$this->input->post('head1');
    $year1=$this->input->post('year1');
     $head2=$this->input->post('head2');
    $year2=$this->input->post('year2');

    $Mapping=$head.'-'.$year.','.$head1.'-'.$year1.','.$head2.'-'.$year2;

//print_r($value3);
//print_r($value4);
//print_r($p_FinancialYear1);
//print_r($p_FinancialYear2);
 for($i=0;$i<$temp;$i++){
   $BalanceSheet[] = array(
    'MainHead' =>  $b_MainHead[$i],
    'Head' => $b_Head[$i],
    'SubHead' => $b_SubHead[$i],
    'Value'=>str_replace(" ","",$value1[$i]),
      'FinancialYear'=>$b_FinancialYear1[$i],
    );
  }

   for($j=0;$j<$temp1;$j++){
   $BalanceSheet[] = array(
    'MainHead' =>  $b_MainHead[$j],
    'Head' => $b_Head[$j],
    'SubHead' => $b_SubHead[$j],
     'Value'=>str_replace(" ","",$value2[$j]),
     'FinancialYear'=>$b_FinancialYear2[$j],
    );
  }
//print_r($BalanceSheet);

$ProfitAndLoss= array();

 for($k=0;$k<$temp2;$k++){
   $ProfitAndLoss[] = array(
    'Head' => $p_Head[$k],
    'SubHead' => $p_SubHead[$k],
     'Value'=>$value3[$k],
   // 'FinancialYear'=>$p_FinancialYear2[$k],
     'FinancialYear'=>$p_FinancialYear1[$k],


    );
  }
  for($l=0;$l<$temp3;$l++){
   $ProfitAndLoss[] = array(
    'Head' => $p_Head[$l],
    'SubHead' => $p_SubHead[$l],
     'Value'=>$value4[$l],
  'FinancialYear'=>$p_FinancialYear2[$l],

    );
  }


//print_r($ProfitAndLoss);exit;
$Auditors[] = array(
          'AuditorName' =>$this->input->post('AuditorName'),
          'MembershipNo' => $this->input->post('MembershipNo'),
          'NameOfAuditFirm' =>$this->input->post('NameOfAuditFirm'),
          'AddressOfAuditors' => $this->input->post('AddressOfAuditors'),
          'PANNo' => $this->input->post('PANNo'),
          'SRNOfADT' =>''
        );
$company=$this->admin->getRow("SELECT * FROM company WHERE cin = '".$cin."'");

   $BasicDetails[] = array(
          'IncorporationNumber' => $company->cin,
          'NameOfCompany' => $company->name,
          'RegisteredAddress' => $company->address,
          'EmailID' => $company->email,
          "BusinessType" => $company->category,
          "Country" => "India",
          "PANNo" =>  $company->pan,
          "Activity" =>  $company->activity,
          "Mapping" =>$Mapping,
          "AuthorisedCapital" => $company->authourisedCapital,
          "DateOfIncorporation" => $company->dateofincorporation,
          "PaidupCapital" => $company->paidUpCaiptal,
          "Phone" =>  '',
          "Website" => '',
        );

//$getdatadirectors=$this->admin->getRows("SELECT * FROM comp_director cd, directors d WHERE cd.cid = '".$company->id."' and cd.did=d.id");
$getdatadirectors=$this->admin->getRows("SELECT * FROM mca_directors WHERE cin = '".$cin."'");
$Directors= array();

   foreach($getdatadirectors as $getdatadirectorsi){
 $Directors[] = array(
          "DirectorName" => $getdatadirectorsi->name,
          "DDesignation" => $getdatadirectorsi->designation,
          "OrderNo" => "",
          "DOB" => '',
          "DOJ" => $getdatadirectorsi->DOA,
          "Qualification" => "",
          "Experience" => "",
          "Mobile" => "",
          "Nationality" => "",
          "EMail" => "",
          "Comments" => "",
          "NationalityNew" => "",
          "BirthPlace" => "",
          "LanguageKnown" => "",
          "ActivelyInvolved" => "",
          "NoofVehicles" =>"",
          "NationalityID" => "",
          "GenderType" => "",
          "IdentificationNumber" => $getdatadirectorsi->din,
        );
}
//$getdatacharge=$this->admin->getRows("SELECT * FROM `charges` WHERE `cin` LIKE 'L00305MH1973PLC174201'");

$getdatacharge=$this->admin->getRows("SELECT * FROM mca_charges WHERE cin = '".$cin."'");

$HypothecationDetails= array();

   foreach($getdatacharge as $getdatachargei){
 $HypothecationDetails[] = array(
          "Banker" => $getdatachargei->Charge_Holder,
          "DateOfAgreement" => $getdatachargei->Closure_Date,
          "HypothecationOf" => $getdatachargei->charge_holder_name,
          "Amount" => $getdatachargei->amount,
          "OrderNo" => "",
          "Modification_Date" => $getdatachargei->date_of_modification,
          "Creation_Date" => $getdatachargei->date_of_creation,
          "ChargeID" => $getdatachargei->chargeid,
          "ChargeStatus" => "",
          "Comment" => ""
);
}


 $dataaaray[] = array(
    'BasicDetails' => $BasicDetails,
    'Directors' => $Directors,
    'HypothecationDetails' => $HypothecationDetails,
    'Auditors' => $Auditors,
    'BalanceSheet' => $BalanceSheet,
    'ProfitAndLoss'=>$ProfitAndLoss,
);

$dataaar= array(
   "json"=>$dataaaray
);
    $payload = json_encode($dataaar);

    //print_r($payload);  exit;



$url ="http://ec2-15-206-122-169.ap-south-1.compute.amazonaws.com:8080/CentralWebService/ConsumeAOC.asmx/InsertAOCDataINCWS";

                     $ch = curl_init( $url );
# Setup request to send json via POST.
//$payload = json_encode( array( "customer"=> $data ) );
curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
# Return response instead of printing.
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
# Send request.
$result = curl_exec($ch);
curl_close($ch);
//print_r($payload);  exit;

 //redirect(base_url().'admin/dashboard/aoc/'.$id);

    }
    function shareholding_file($id)
    {
      $data['title'] = 'Data Analyst';
      $data['menu'] = 'DA_logs';

      $data['session_user']=$this->session->userdata('admin_in');
        $user_id=$data['session_user']['id'];
      $this->load->model('Cart_model');
      $data['Orders'] = $this->Cart_model->getDetailedReportOrders();
      $data['rolls']= json_decode($data['session_user']['roll']);
      $notify=$this->Common_model->GetData('notification', "", "production_user='0' and type='da'");
      $data['count']=count($notify);

          $this->load->view('admin/inc/header', $data, false);
         $this->load->view('admin/DA/shareholding_file', $data, false);
          $this->load->view('admin/inc/footer', $data, false);

    }
     public function ocrpdf($id)
    {
        $data['title'] = 'Data Analyst';
        $data['menu'] = 'DA_logs';

        $data['session_user']=$this->session->userdata('admin_in');
        $this->load->model('Cart_model');
        $data['Orders'] = $this->Cart_model->getDetailedReportOrders();
        $data['rolls']= json_decode($data['session_user']['roll']);
        $notify=$this->Common_model->GetData('notification', "", "production_user='0' and type='da'");
        $data['count']=count($notify);
        if (in_array("Data Analyst", $data['rolls'])) {
         //   $this->load->view('admin/inc/header', $data, false);
            //$this->load->view('admin/DA/dashboard', $data, false);
            $this->load->view('admin/DA/ocr_detail', $data, false);
          //  $this->load->view('admin/inc/footer', $data, false);
        }
    }
      public function aocpdfupload($id)
    {

       ini_set('max_execution_time', 0);
       //  $id=$id;

          $delete1=$this->admin->deleteAll('aoc4data',array('order_id'=>$id));
          $image = '';
            if($_FILES['attachment']['name'])
             {
                $ext = end((explode(".", $_FILES['attachment']['name'])));
                $imgname = $ext[0].substr(md5(microtime()),0,8).'.'.$ext;
                if(move_uploaded_file($_FILES["attachment"]["tmp_name"],"upload/mgt/".$imgname))
                {
                   copy("uploads/mgt/".$imgname,"upload/mgt/resize/".$imgname);
                   $image = $imgname;
                }
            }




 $pdfurl=base_url().'upload/mgt/'.$image;



$finaldatapdf=$this->admin->getRow("SELECT pdf,mgt FROM shareholding WHERE status = 'pdf' AND o_id = ".$id."");

 $array = array(
                        'aoc4file'=>$pdfurl

                    );





   $update = $this->admin->update('orders',array('id'=>$id), $array);


//print_r($array);

// $pdfurl='https://uat.kreditaid.com/upload/mgt/'.$image1;
 $json = @file_get_contents('https://api.ocr.space/parse/imageurl?apikey=5a64d478-9c89-43d8-88e3-c65de9999580&url='.$pdfurl.'&language=eng&isOverlayRequired=true');
 // $shellObj    = \MTS\Factories::getDevices()->getLocalHost()->getShell('bash', false);
    //  $output[]= $shellObj->exeCmd('python3 /var/www/html/uat/ocr.py upload/report/'.$id.'/'.$pdfurl.' '.$id);
    //   $output[]=$shellObj->exeCmd('mv ./attachment.pdf ./upload/pdf/'.$id.'/attachment.pdf');
      //return $output;
//print_r($output);  exit;

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
           'order_id'=>$id,
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


    }


    public function aocpdfupload4444($id)
    {

   ini_set('max_execution_time', 0);
  //  $id=$id;


          $delete1=$this->admin->deleteAll('aoc4data',array('order_id'=>$id));
          $image = '';
            if($_FILES['attachment']['name'])
             {
                $ext = end((explode(".", $_FILES['attachment']['name'])));
                $imgname = $ext[0].substr(md5(microtime()),0,8).'.'.$ext;
                if(move_uploaded_file($_FILES["attachment"]["tmp_name"],"upload/mgt/".$imgname))
                {
                   copy("uploads/mgt/".$imgname,"upload/mgt/resize/".$imgname);
                   $image = $imgname;
                }
            }




 $pdfurl=base_url().'upload/mgt/'.$image;



$finaldatapdf=$this->admin->getRow("SELECT pdf,mgt FROM shareholding WHERE status = 'pdf' AND o_id = ".$id."");

 $array = array(
                        'aoc4file'=>$pdfurl

                    );





   $update = $this->admin->update('orders',array('id'=>$id), $array);


    }

   public function llp8pdfupload($id)
    {

   ini_set('max_execution_time', 0);
  //  $id=$id;


          $delete1=$this->admin->deleteAll('aoc4data',array('order_id'=>$id));
          $image = '';
            if($_FILES['attachment']['name'])
             {
                $ext = end((explode(".", $_FILES['attachment']['name'])));
                $imgname = $ext[0].substr(md5(microtime()),0,8).'.'.$ext;
                if(move_uploaded_file($_FILES["attachment"]["tmp_name"],"upload/mgt/".$imgname))
                {
                   copy("uploads/mgt/".$imgname,"upload/mgt/resize/".$imgname);
                   $image = $imgname;
                }
            }




 $pdfurl=base_url().'upload/mgt/'.$image;



$finaldatapdf=$this->admin->getRow("SELECT pdf,mgt FROM shareholding WHERE status = 'pdf' AND o_id = ".$id."");

    $array =  array(
                        'llp8file'=>$pdfurl

                    );


 $update = $this->admin->update('orders',array('id'=>$id), $array);

    }
       
   public function pass3pdfupload($id)
    {

       ini_set('max_execution_time', 0);
      //  $id=$id;

          $delete1=$this->admin->deleteAll('aoc4data',array('order_id'=>$id));
          $image = '';
            if($_FILES['attachment']['name'])
             {
                $ext = end((explode(".", $_FILES['attachment']['name'])));
                $imgname = $ext[0].substr(md5(microtime()),0,8).'.'.$ext;
                if(move_uploaded_file($_FILES["attachment"]["tmp_name"],"upload/mgt/".$imgname))
                {
                   copy("uploads/mgt/".$imgname,"upload/mgt/resize/".$imgname);
                   $image = $imgname;
                }
            }


 $pdfurl=base_url().'upload/mgt/'.$image;

//$finaldatapdf=$this->admin->getRow("SELECT pdf,mgt FROM shareholding WHERE status = 'pdf' AND o_id = ".$id."");

 $array = array(
                        'pass3file'=>$pdfurl

                    );





$update = $this->admin->update('orders',array('id'=>$id), $array);


//print_r($array);

// $pdfurl='https://uat.kreditaid.com/upload/mgt/'.$image1;
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
           'order_id'=>$id,
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


    }


     public function llo11pdfupload($id)
    {

   ini_set('max_execution_time', 0);
  //  $id=$id;


          $delete1=$this->admin->deleteAll('aoc4data',array('order_id'=>$id));
          $image = '';
            if($_FILES['attachment']['name'])
             {
                $ext = end((explode(".", $_FILES['attachment']['name'])));
                $imgname = $ext[0].substr(md5(microtime()),0,8).'.'.$ext;
                if(move_uploaded_file($_FILES["attachment"]["tmp_name"],"upload/mgt/".$imgname))
                {
                   copy("uploads/mgt/".$imgname,"upload/mgt/resize/".$imgname);
                   $image = $imgname;
                }
            }




 $pdfurl=base_url().'upload/mgt/'.$image;



//$finaldatapdf=$this->admin->getRow("SELECT pdf,mgt FROM shareholding WHERE status = 'pdf' AND o_id = ".$id."");

 $array = array(
                        'llp11file'=>$pdfurl

                    );





   $update = $this->admin->update('orders',array('id'=>$id), $array);


//print_r($array);

// $pdfurl='https://uat.kreditaid.com/upload/mgt/'.$image1;
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
           'order_id'=>$id,
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


    }

         public function llp2pdfupload($id)
    {

   ini_set('max_execution_time', 0);
  //  $id=$id;


          $delete1=$this->admin->deleteAll('llp2data',array('order_id'=>$id));
       $image = '';
            if($_FILES['attachment']['name'])
             {
                $ext = end((explode(".", $_FILES['attachment']['name'])));
                $imgname = $ext[0].substr(md5(microtime()),0,8).'.'.$ext;
                if(move_uploaded_file($_FILES["attachment"]["tmp_name"],"upload/mgt/".$imgname))
                {
                   copy("uploads/mgt/".$imgname,"upload/mgt/resize/".$imgname);
                   $image = $imgname;
                }
            }


 $pdfurl=base_url().'upload/mgt/'.$image;


$finaldatapdf=$this->admin->getRow("SELECT pdf,mgt FROM shareholding WHERE status = 'pdf' AND o_id = ".$id."");

      $array = array(
                        'llp2file'=>$pdfurl

                    );





   $update = $this->admin->update('orders',array('id'=>$id), $array);


//print_r($array);

// $pdfurl='https://uat.kreditaid.com/upload/mgt/'.$image1;
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
           'order_id'=>$id,
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
    }


   public function test($id)
    {
        $json = @file_get_contents('http://103.108.220.175/CentralWebService/LLPMasters.asmx/GetBSHeads?HeadID='.$id);
   //     $json = @file_get_contents('https://api.ocr.space/parse/imageurl?apikey=5a64d478-9c89-43d8-88e3-c65de9999580&url=http://test.kreditaid.com/test/aocpdf/4.pdf&language=eng&isOverlayRequired=true');
 $obj = json_decode($json,true);

//echo $obj['BSHead'][];
echo $obj['BSHead'][0]['MainHead'].'_'.$obj['BSHead'][0]['Head'];
    }
     public function llp11pdfupload($id)
    {

   ini_set('max_execution_time', 0);
  //  $id=$id;


          $delete1=$this->admin->deleteAll('llp11data',array('order_id'=>$id));
        $image = '';
            if($_FILES['attachment']['name'])
             {
                $ext = end((explode(".", $_FILES['attachment']['name'])));
                $imgname = $ext[0].substr(md5(microtime()),0,8).'.'.$ext;
                if(move_uploaded_file($_FILES["attachment"]["tmp_name"],"upload/mgt/".$imgname))
                {
                   copy("uploads/mgt/".$imgname,"upload/mgt/resize/".$imgname);
                   $image = $imgname;
                }
            }


 $pdfurl=base_url().'upload/mgt/'.$image;




//$finaldatapdf=$this->admin->getRow("SELECT pdf,mgt FROM shareholding WHERE status = 'pdf' AND o_id = ".$id."");

 $array = array(
                        'llp11file'=>$pdfurl

                    );





   $update = $this->admin->update('orders',array('id'=>$id), $array);


//print_r($array);

// $pdfurl='https://uat.kreditaid.com/upload/mgt/'.$image1;
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
          'order_id'=>$id,
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


    }



   public function pdfupload($id)
    {

   ini_set('max_execution_time', 0);
  //  $id=$id;
           $delete=$this->admin->deleteAll('shareholding',array('o_id'=>$id,'status' => 'mgt'));

           $delete1=$this->admin->deleteAll('ocrdata',array('order_id'=>$id));

                $image = '';
            if($_FILES['attachment']['name'])
             {
                $ext = end((explode(".", $_FILES['attachment']['name'])));
                $imgname = $ext[0].substr(md5(microtime()),0,8).'.'.$ext;
                if(move_uploaded_file($_FILES["attachment"]["tmp_name"],"upload/mgt/".$imgname))
                {
                   copy("uploads/mgt/".$imgname,"upload/mgt/resize/".$imgname);
                   $image = $imgname;
                }
            }

                $image1 = '';
            if($_FILES['mgt']['name'])
             {
                $ext1 = end((explode(".", $_FILES['mgt']['name'])));
                $imgname1 = $ext1[0].substr(md5(microtime()),0,8).'.'.$ext1;
                if(move_uploaded_file($_FILES["mgt"]["tmp_name"],"upload/mgt/".$imgname1))
                {
                   copy("uploads/mgt/".$imgname1,"upload/mgt/resize/".$imgname1);
                   $image1 = $imgname1;
                }
            }



 $pdfurl=base_url().'upload/mgt/'.$image;
 $mgturl=base_url().'upload/mgt/'.$image1;


$finaldatapdf=$this->admin->getRow("SELECT pdf,mgt FROM shareholding WHERE status = 'pdf' AND o_id = ".$id."");

 $array = array(
                        'linetext'=>'pdf',
                        'o_id' =>$id,
                        'status'=>'pdf',
                    );

 if(!empty($image))
            {
                $array['pdf']=$pdfurl;
            }
            if(!empty($image1))
            {
                $array['mgt']=$mgturl;
            }
   if($finaldatapdf->pdf != '' || $finaldatapdf->mgt != '')
   {

   $update = $this->admin->update('shareholding',array('o_id'=>$id,'status'=>'pdf'), $array);
   }else{
   $insert = $this->admin->insert('shareholding', $array);
   }

print_r($array);

// $pdfurl='https://uat.kreditaid.com/upload/mgt/'.$image1;
 $json = @file_get_contents('https://api.ocr.space/parse/imageurl?apikey=5a64d478-9c89-43d8-88e3-c65de9999580&url='.$mgturl.'&language=eng&isOverlayRequired=true');
 $obj = json_decode($json,true);
 $temp = count($obj['ParsedResults'][0]['TextOverlay']['Lines']);
 $array1=array();
    for ($i=0; $i<$temp; $i++) {
  $array1[] = array(
           'LineText' =>$obj['ParsedResults'][0]['TextOverlay']['Lines'][$i]['LineText'],
          // 'MaxHeight'=>$obj['ParsedResults'][0]['TextOverlay']['Lines'][$i]['MaxHeight'],
           'MinTop'=>$obj['ParsedResults'][0]['TextOverlay']['Lines'][$i]['MinTop'],
          // 'Words'=>$obj['ParsedResults'][0]['TextOverlay']['Lines'][$i]['Words'],
           //  'cin'=>$obj['ParsedResults'][0]['TextOverlay']['Lines'][23]['LineText'],
            // 'order_id'=>1,

            );


    }
     //echo $obj['ParsedResults'][0]['Overlay']['Lines'][23]['LineText'];

      // $insert = $this->admin->insert_multi('ocrdata', $array1);


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

 $cinmgt=$this->admin->getVal("SELECT items FROM orders WHERE id = ".$id."");


 $finaldatamgt=$this->admin->getRow("SELECT contact,cin FROM shareholding WHERE status = 'mgt' AND o_id = ".$id."");

 $array2 = array(
            'contact' =>$array1[$key1]['LineText'],
            'cin'=>$cinmgt,
            'o_id'=>$id,
             'status'=>'mgt',
            );
   if($finaldatamgt->contact != '' || $finaldatamgt->cin != '')
   {

   $update = $this->admin->update('shareholding',array('o_id'=>$id,'status'=>'mgt'), $array2);
   }else{
   $insert = $this->admin->insert('shareholding', $array2);
   }


    }
  public function add_mgt()
    {   ini_set('max_execution_time', 0);
    $cin=$this->input->post('cinno');
    $id=$this->input->post('id');

    $ename=$this->input->post('ename');
    $eNumber_Of_Shares=$this->input->post('eNumber_Of_Shares');
    $epercentage=$this->input->post('epercentage');

    $pname=$this->input->post('pname');
    $pNumber_Of_Shares=$this->input->post('pNumber_Of_Shares');
    $ppercentage=$this->input->post('ppercentage');

    $temp = count($ename);
    $temp2 = count($pname);
    
    

$Equity_Shareholding= array();
 for($i=0;$i<$temp;$i++){
   $Equity_Shareholding[] = array(
   "SNo"=> $i,
   "TypeOfShareHolder"=> 'Equity Shareholding',
   "Name"=> $ename[$i],
   "NoOfShare"=> $eNumber_Of_Shares[$i],
   "PercentageHolding"=>$epercentage[$i],
    );
  }
$Preference_Shareholding= array();
 for($i=0;$i<$temp2;$i++){
   $Equity_Shareholding[] = array(
   "SNo"=> $i,
   "TypeOfShareHolder"=> 'Preference Shareholding',
   "Name"=> $pname[$i],
   "NoOfShare"=> $pNumber_Of_Shares[$i],
   "PercentageHolding"=>$ppercentage[$i],
    );
  }
  



 $company=$this->admin->getRow("SELECT cin FROM company WHERE cin = '".$cin."'");

$BasicDetails = array(
          "IncorporationNumber" => $company->cin,
          "ContactNo" => "079400832222"
         
        );

$dataaaray[] = array(
    'Equity_Shareholding'  => $Equity_Shareholding,
    'Preference_Shareholding'  => $Preference_Shareholding,
    'ProfitAndLoss' => $ProfitAndLoss
);

$dataaar= array(
   "json"=>$dataaaray
);
$payload = json_encode($dataaar);

$url ="http://103.108.220.175/CentralWebService/ConsumeMGT-7.asmx/InsertSHDataINCWS";

$ch = curl_init( $url );
# Setup request to send json via POST.
//$payload = json_encode( array( "customer"=> $data ) );
curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
# Return response instead of printing.
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
# Send request.
$result = curl_exec($ch);
curl_close($ch);
echo $result;
print_r($result);
//print_r($payload);  exit;
 //redirect(base_url().'admin/dashboard/aoc/'.$id);
print_r($payload);  exit;

    }

     public function add_mgt11(){


      //  sqlQuery('delete from shareholding');

// accept parameters (p is array)
         // $data['search'] = $this->input->get('p');
$arr =$this->input->get('p');
$id =$this->input->post('id');
$totalamount =$this->input->post('totalamount');
$totalpersent =$this->input->post('totalpersent');
$arr1 =$this->input->post('array');

//print_r($arr1); exit;
//  $delete=$this->admin->deleteAll('shareholding',array('order_id'=>$id));
 $delete=$this->admin->deleteAll('shareholding',array('o_id'=>$id,'status' => 'total'));

$i=0;
/*
foreach ($arr as $p) {

  list($sub_id, $tbl, $row, $col) = explode('_', $p);

  // discard clone id part from the sub_id
  $sub_id = substr($sub_id, 0, 2);

 // insert to the database
 // sqlQuery("insert into shareholding (sub_id, tbl_row, tbl_col) values ('$sub_id', $row, $col)");
  $array = array(
           'sub_id'  =>$sub_id,
           'linetext'=> $arr1[$i]['value'],
           'tbl_row' =>$row,
           'tbl_col' =>$col,
           'order_id'=>$id,
            );

   $insert = $this->admin->insert('shareholding', $array);
    $i++;
}*/

  //$data = json_decode($this->input->post('array'), true);
//var_dump($data);

  $array1 = array(

          'linetext' => 'Total',
          'amount' => $totalamount,
          'persent' => $totalpersent,
          'o_id'=>$id,
          'status' => 'total'
            );

   $insert = $this->admin->insert('shareholding', $array1);
 $mgt=$this->admin->getRow("SELECT contact,cin FROM shareholding WHERE status = 'mgt' AND o_id = ".$id."");

 $data=$this->admin->getRows("SELECT * FROM shareholding WHERE order_id = ".$id." ORDER BY tbl_row,tbl_col ASC");

                   // echo $data[0]->linetext; exit;
                  //  print_r($data);

                    $dataaaray= array();
$j=0;
                    for($i=0;$i<sizeof($data);$i+=3){
                      $j++;

                       $dataaaray[] = array(
    'SNo' => $j,
    'Name' => $data[$i+0]->linetext,
    'NoOfShare'=>$data[$i+1]->linetext,
 'PercentageHolding'=>$data[$i+2]->linetext,
  'IncorporationNo'=>$mgt->cin,
  'ContactNo'=>$mgt->contact

);


                    }


$dataaar= array(
   "json"=>$dataaaray
);



//array( "json" : $dataaaray);
                     $payload = json_encode($dataaar);



$url ="http://ec2-15-206-122-169.ap-south-1.compute.amazonaws.com:8080/CentralWebService/ConsumeSHData.asmx/InsertSHDataINCWS";

                     $ch = curl_init( $url );
# Setup request to send json via POST.
//$payload = json_encode( array( "customer"=> $data ) );
curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
# Return response instead of printing.
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
# Send request.
$result = curl_exec($ch);
curl_close($ch);

print_r($payload);exit;
 // redirect('zuba');
      }

         public function savepersent(){


      //  sqlQuery('delete from shareholding');

// accept parameters (p is array)
         // $data['search'] = $this->input->get('p');
$arr =$this->input->get('p');
$id =$this->input->post('id');
$totalamount =$this->input->post('totalamount');
$totalpersent =$this->input->post('totalpersent');
$arr1 =$this->input->post('array');


//  $delete=$this->admin->deleteAll('shareholding',array('order_id'=>$id));
$amount = 0;
$persent = 0;
$i=0;
foreach ($arr as $p) {

  list($sub_id, $tbl, $row, $col) = explode('_', $p);

  $sub_id = substr($sub_id, 0, 2);



  if($col == 2){
$amount+=$arr1[$i]['value'];
 //$arr1[$i]['value']
  }
    if($col == 3){
$persent+= $arr1[$i]['value'];

  }


 //  $insert = $this->admin->insert('shareholding', $array);
    $i++;
}


  echo $amount.'_'.$persent; exit;

      }

         public function clear(){
   $id =$this->input->post('id');

  $delete=$this->admin->deleteAll('shareholding',array('order_id'=>$id));

      }

   public function removedata(){
   $id =$this->input->post('id');
   $rowid =$this->input->post('rowid');
   $delete=$this->admin->deleteAll('shareholding',array('order_id'=>$id,'tbl_row'=>$rowid));

      }

   

  public function getpl()
     {  
$row =$this->input->post('row');
  $month=(int)date("m");
             if($month<4){
               $year=date("Y")-1;
             }else{
               $year=date("Y");
             }
 $year1=$year - 1;
 $year2=$year - 2;
 $year3=$year - 3;
                            $json = @file_get_contents('http://103.108.220.175/CentralWebService/LLPMasters.asmx/GetBSSubHeadMaster');
if(@$json){
$obj = @json_decode($json,true);

      //print_r($obj['MasterDetails']);
       $obj1 =$obj['MasterDetails'];
       $temp = count($obj['MasterDetails']);
        $var='';
       for ($i=0; $i<$temp; $i++) {
     $var.= '<option value="'.$obj1[$i]['HeadID'].'">'.$obj1[$i]['SubHead'].'</option>';
      } }
      $html='<tr class="rows"><td>
                            <select class="form-control" name="main_head[]" onchange="getRow_feedback('.$row.')" id="main_head'.$row.'" style="margin-left:-10px;">'.$var. '</select>
                              </td>
                               <td>
                               <input type="text" name="Head[]" class="form-control" id="Head'.$row.'" style="margin-left:-10px;">
                              </td>
                              <td>
                              <input type="text" name="MainHead[]" class="form-control" id="MainHead'.$row.'" style="margin-left:-10px;">
                              </td>
                             <td>
                               <input type="text" name="value[]" class="form-control" id="value'.$row.'" style="margin-left:-10px;">
                             </td>
                                <td>
                               <select  class="form-control form-control-sm " name="year[]"  id="year'.$row.'">
             <option value=""   selected >Year</option>
             <option value="'.$year.'">'.$year.'</option>
            <option value="'.$year1.'">'.$year1.'</option>
            <option value="'.$year2.'">'.$year2.'</option>
            <option value="'.$year3.'">'.$year3.'</option>
           </select>
                             </td>
                              <td>
                                <button title="Delete row" type="button" onclick="deleteRow_feedback1(this)" class="btn bg-red waves-effect"><b><i class="fa fa-minus"></i></b>
                                </button>
                              </td>
                            </tr>';

     echo $html;exit;
     }

      public function getpldata()
     {     $month=(int)date("m");
             if($month<4){
               $year=date("Y")-1;
             }else{
               $year=date("Y");
             }
 $year1=$year - 1;
 $year2=$year - 2;
 $year3=$year - 3;
$row =$this->input->post('row');

                            $json = @file_get_contents('http://103.108.220.175/CentralWebService/LLPMasters.asmx/GetPLSubHeadMaster');
if(@$json){
$obj = @json_decode($json,true);

      //print_r($obj['MasterDetails']);
       $obj1 =$obj['PLNewHeadMaster'];
       $temp = count($obj['PLNewHeadMaster']);
        $var='';
       for ($i=0; $i<$temp; $i++) {
     $var.= '<option value="'.$obj1[$i]['HeadID'].'">'.$obj1[$i]['SubHead'].'</option>';
      } }
      $html='<tr class="rows"><td>
                            <select class="form-control" name="main_head[]" onchange="getplRow_feedback('.$row.')" id="main_headpl'.$row.'" style="margin-left:-10px;">'.$var. '</select>
                              </td>
                               <td>
                               <input type="text" name="Head[]" class="form-control" id="Headpl'.$row.'" style="margin-left:-10px;">
                              </td>
                              <td>
                              <input type="text" name="MainHead[]" class="form-control" id="MainHeadpl'.$row.'" style="margin-left:-10px;">
                              </td>
                             <td>
                               <input type="text" name="value[]" class="form-control" id="valuepl'.$row.'" style="margin-left:-10px;">
                             </td>
                                 <td>
                                 <select  class="form-control form-control-sm " name="yearpl[]"  id="yearpl'.$row.'">
             <option value=""   selected >Year</option>
             <option value="'.$year.'">'.$year.'</option>
            <option value="'.$year1.'">'.$year1.'</option>
            <option value="'.$year2.'">'.$year2.'</option>
            <option value="'.$year3.'">'.$year3.'</option>
           </select>
                             </td>
                              <td>
                                <button title="Delete row" type="button" onclick="deleteRow_feedback1(this)" class="btn bg-red waves-effect"><b><i class="fa fa-minus"></i></b>
                                </button>
                              </td>
                            </tr>';

     echo $html;exit;
     }

      public function getmgt()
     {  

      $html='<tr class="rows">
                               <td>
                               <input type="text" name="Head[]" class="form-control" id="Head'.$row.'" style="margin-left:-10px;">
                              </td>
                              <td>
                              <input type="text" name="MainHead[]" class="form-control" id="MainHead'.$row.'" style="margin-left:-10px;">
                              </td>
                             <td>
                               <input type="text" name="value[]" class="form-control" id="value'.$row.'" style="margin-left:-10px;">
                             </td>
                               
                              <td>
                                <button title="Delete row" type="button" onclick="deleteRow_feedback1(this)" class="btn bg-red waves-effect"><b><i class="fa fa-minus"></i></b>
                                </button>
                              </td>
                            </tr>';

     echo $html;exit;
     }

      public function getmgtdata()
     {    
      $html='<tr class="rows">
                               <td>
                               <input type="text" name="Head[]" class="form-control" id="Headpl'.$row.'" style="margin-left:-10px;">
                              </td>
                              <td>
                              <input type="text" name="MainHead[]" class="form-control" id="MainHeadpl'.$row.'" style="margin-left:-10px;">
                              </td>
                             <td>
                               <input type="text" name="value[]" class="form-control" id="valuepl'.$row.'" style="margin-left:-10px;">
                             </td>
                                
                              <td>
                                <button title="Delete row" type="button" onclick="deleteRow_feedback1(this)" class="btn bg-red waves-effect"><b><i class="fa fa-minus"></i></b>
                                </button>
                              </td>
                            </tr>';

     echo $html;exit;
     }


    public    function timetable($hour, $row) {


     $CI =& get_instance();
 
    print '<tr class="table-primary" id="r'. $hour .'" >';

    print '<td class="mark dark">' . $hour . '</td>';

    print '<td><div id=\"$id\" class=\"drag green\"><input type=\"text\" name=\"array[]\" style=\"width: 220px\"  value=\"$name\"/></div></td>';

    print '<td><div id=\"$id\" class=\"drag green\"><input type=\"text\" name=\"array[]\" style=\"width: 220px\"  value=\"$name\"/></div></td>';

    print '<td><div id=\"$id\" class=\"drag green\"><input type=\"text\" name=\"array[]\" style=\"width: 220px\"  value=\"$name\"/></div></td>';
  
    print '<td class="mark dark">   <button type="button" onclick="deleterow(tabletbody,' . $hour .')" name="button" class="btn btn-danger pull-right" style="border-radius:20px;margin-right: 20px;">
     <i class="fa fa-minus"></i></button></td>';
    // print_r(' <input type=\"button\" value=\"Clear\" class=\"button\" onclick=\"cleardata()\" title="Save timetable"/>');
    print "</tr>\n";
}
 public    function timetable1($hour, $row) {


     $CI =& get_instance();
 
 // print '<tr class="table-primary">';
 // print '<td class="mark dark">' . $hour . '</td>';

    print '<tr class="table-primary" id="r'. $hour .'" >';
print '<td class="mark dark">' . $hour . '</td>';
  // column loop starts from 1 because column 0 is for hours
  for ($col=1; $col <= 3; $col++) {


    // create table cell
    print '<td>';
    // prepare position key in the same way as the array key looks
    $pos = $row . '_' . $col;
    // if content for the current position exists






        print "<div id=\"$id\" class=\"drag green\"><input type=\"text\" name=\"array[]\" style=\"width: 220px\"  value=\"$name\"/></div>";


    print '</td>';
  }
  print '<td class="mark dark">   <button type="button" onclick="deleterow(tabletbody,' . $hour .')" name="button" class="btn btn-danger pull-right" style="border-radius:20px;margin-right: 20px;">
     <i class="fa fa-minus"></i></button></td>';
  // print_r(' <input type=\"button\" value=\"Clear\" class=\"button\" onclick=\"cleardata()\" title="Save timetable"/>');
  print "</tr>\n";
}


public function testjson(){
       
 $json = @file_get_contents('http://kreditaid.com/uat/json/1.json');

//echo  $json;
 $temp = count($json['totalpages']);
 //$temp = count(['Page 1']);

 //echo $temp;
 $obj = json_decode($json,true);



 $temp = count($obj['totalpages']);
//echo $temp;
$array1=array();
 $obj['totalpages']['Page 0'][0]['Line 0'][0]['text'].'bhu';
 //print_r($obj['totalpages']['Page 0']['Line 0']);
///echo $obj['totalpages']['Page 0']['Line 0']['Text'];
for ($i=0; $i<$temp; $i++) {
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
  
   $temp1 = count($obj['totalpages']['Page '.$i]);
 // echo $temp1.'</br>';
  // echo $i;
  for ($j=0; $j<$temp1; $j++) {
 $pos=$obj['totalpages']['Page '.$i]['Line '.$j]['Position'];
$post= explode(",",$pos);
    $left=$post[0];
    $top=$post[1];
    $width=$post[2];
    $height=$post[3];
   
 $array1[] = array(
     'LineText' =>$obj['totalpages']['Page '.$i]['Line '.$j]['Text'],
     'Left'=>$left,
     'MinTop'=>$top,
     'width'=>$width,
     'MaxHeight'=>$height,
       'Page'=>$var,
           'order_id'=>220,
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

}
echo $this->db->last_query();
 //echo  $obj;
 //print_r($array1);
}
 }