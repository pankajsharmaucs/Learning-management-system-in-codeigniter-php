<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Api extends CI_Controller
{
  public function __construct()
  {
      parent::__construct();
      $this->load->library(array('session','Custom','email'));
      $this->load->model('Send_mail');
  }
      public function mcadata1($cin){
        $this->db->select('*');
        $this->db->where('cin',$cin);
        $this->db->where('status','Pending');
        $this->db->where('type','master');
        $this->db->order_by('id',"DESC");
        $query=$this->db->get('mca_scrapper');
        $data['row']=$query->row_array();
        if($query->num_rows()){
          $data['mca']=json_decode($data['row']['data'],true);
          $roc = explode('-',$data['mca']['Company']['roc_code']);
          if(@$data['mca']['Company']['company_name']){
            $data['update']['name']=$data['mca']['Company']['company_name'];
            $data['update']['mca_status']='Done';
          }
          if(@$data['mca']['Company']['date_of_incorporation']){
            $data['update']['dateofincorporation']=$data['mca']['Company']['date_of_incorporation'];
            $data['update']['mca_status']='Done';
          }

          if($roc[1]){
            $data['update']['roc']= $roc[1];
            $data['update']['mca_status']='Done';
          }
          if(@$data['mca']['Company']['company_category']){
            $data['update']['category']=$data['mca']['Company']['company_category'];
            $data['update']['mca_status']='Done';
          }
          if(@$data['mca']['Company']['company_subcategory']){
              $data['update']['subCategory']=$data['mca']['Company']['company_subcategory'];
              $data['update']['mca_status']='Done';
          }
          if(@$data['mca']['Company']['class_of_company']){
            $data['update']['class']=$data['mca']['Company']['class_of_company'];
            $data['update']['mca_status']='Done';
          }
          if(@$data['mca']['Company']['authorised_capital']){
            $data['update']['authourisedCapital']=$data['mca']['Company']['authorised_capital'];
            $data['update']['mca_status']='Done';
          }
          if(@$data['mca']['Company']['paid_up_capital']){
            $data['update']['paidUpCaiptal']=$data['mca']['Company']['paid_up_capital'];
            $data['update']['mca_status']='Done';
          }

          if(@$data['mca']['Company']['registered_address']){
            $data['update']['address']=$data['mca']['Company']['registered_address'];
            $data['update']['mca_status']='Done';
          }
        if(@$data['mca']['Company']['email']){
          $data['update']['email']=$data['mca']['Company']['email'];
          $data['update']['mca_status']='Done';
        }

          if(@$data['mca']['Company']['listed']){
            $data['update']['listedOrUnlisted']=$data['mca']['Company']['listed'];
            $data['update']['mca_status']='Done';
          }
          if(@$data['mca']['Company']['com_status']){
            $data['update']['status']=$data['mca']['Company']['com_status'];
            $data['update']['mca_status']='Done';
          }

          if(@$data['mca']['Company']['date_of_last_agm']){
            $data['update']['annual_filing']=$data['mca']['Company']['date_of_last_agm'];
          }
          if(@$data['mca']['Company']['date_of_balance_sheet']){
            $data['update']['balance_filing']=$data['mca']['Company']['date_of_balance_sheet'];
            $data['update']['mca_status']='Done';
          }

          if(@$data['mca']['Company']['com_status']){
            $data['update']['status2']=$data['mca']['Company']['com_status'];
            $data['update']['mca_status']='Done';
          }

          $i=0;
          foreach (@$data['mca']['Charges'] as $item) {
            $data['charges'][$i]['Assets_Under_Charge']=$item['assets_under_charge'];
            $data['charges'][$i]['Amount']=$item['charge_amount'];
            $data['charges'][$i]['Creation_Date']=$item['date_of_creation'];
            $data['charges'][$i]['Modification_Date']=$item['date_of_modification'];
            $data['charges'][$i]['status']=$item['status'];
            $data['charges'][$i]['cin']=$cin;
            $data['charges'][$i]['mca_status']='Done';
            $i++;
          }
          if($data['charges']){
            $this->db->where('cin',$cin);
            $this->db->delete('mca_charges');
            foreach ($data['charges'] as $charges) {
                $this->db->insert('mca_charges', $charges);
            }
          }
          $this->db->where('cin',$cin);
          $this->db->update('company',$data['update']);

          $MCA_BASIC=true;
          $data['scrappers']['status']="DONE";
          $this->db->where('cin',$cin);
          $this->db->where('type','company');
          $this->db->where('status','Pending');
          $this->db->update('mca_scrapper',$data['scrappers']);
        }
        $this->db->select('*');
        $this->db->where('cin',$cin);
        $this->db->where('status','Pending');
        $this->db->where('type','master');
        $this->db->order_by('id',"DESC");
        $query=$this->db->get('mca_scrapper');
        if($query->num_rows()){
          $data['row2']=$query->row_array();
          $data['DIR']=json_decode($data['row2']['data'],true);
          $d=0;
          foreach ($data['DIR']['Director'] as $directors) {
            $data['Directors'][$d]['din']=$directors['DIN/DPIN/PAN'];
            $data['Directors'][$d]['name']=$directors['Full_Name'];
            $data['Directors'][$d]['designation']=$directors['Designation'];
            $data['Directors'][$d]['date_of_joining']=$directors['Date_of_Appointment'];
          //  $data['Directors'][$d]['Expiry_Date_of_DSC']=$directors['Expiry_Date_of_DSC'];
            //$data['Directors'][$d]['Surrendered_DIN']=$directors['Surrendered_DIN'];
            $data['Directors'][$d]['cin']=$cin;
            $data['Directors'][$d]['mca_status']='Done';
            $d++;
          }
          if($data['Directors']){
            $this->db->where('din',$directors['DIN/DPIN/PAN']);
            $this->db->delete('scrap_dir');

            foreach ($data['Directors'] as $dir) {
                $this->db->insert('scrap_dir', $dir);
            }
            $MCA_DIR=true;
          }
          $data['scrappers']['status']="DONE";
          $this->db->where('cin',$cin);
          $this->db->where('type','director');
          $this->db->where('status','Pending');
          $this->db->update('mca_scrapper',$data['scrappers']);
        }


        $this->db->select('*');
        $this->db->where('cin',$cin);
        $this->db->where('status','Pending');
        $this->db->where('type','charges');
        $this->db->order_by('id',"DESC");
        $query=$this->db->get('mca_scrapper');

        if($query->num_rows()){
          $data['row3']=$query->row_array();

          $data['CHARGES']=json_decode($data['row3']['data'],true);
          $c=0;
          foreach ($data['CHARGES']['Charges'] as $charges) {
            $data['Charges'][$c]['chargeid']=$charges['id'];

            $data['Charges'][$c]['charge_holder_name']=$charges['charge_holder_name'];
            $data['Charges'][$c]['date_of_creation']=$charges['date_of_creation'];
            $data['Charges'][$c]['date_of_modification']=$charges['date_of_modification'];
            $data['Charges'][$c]['date_of_satisfaction']=$charges['date_of_satisfaction'];
            $data['Charges'][$c]['amount']=$charges['date_of_amount'];
            $data['Charges'][$c]['srn']=$charges['srn'];

            $data['Charges'][$c]['cin']=$cin;
            $data['Charges'][$c]['mca_status']='Done';
            $c++;
          }
          if($data['Charges']){
            $this->db->where('chargeid',$charges['id']);
            $this->db->delete('mca_charges');
            foreach ($data['Charges'] as $dir) {
                $this->db->insert('mca_charges', $dir);
            }
            $data['scrappers']['status']="DONE";
            $this->db->where('cin',$cin);
            $this->db->where('type','charges');
            $this->db->where('status','Pending');
            $this->db->update('mca_scrapper',$data['scrappers']);


          }
        }
      }
  public function mcadata444(){

   ini_set('max_execution_time', 0);
  //  $id=$id;
  $getdatacharge=$this->admin->getRows("SELECT cin FROM `mca_scrapper` WHERE `status`= 'Pending' GROUP by cin ");

//print_r($getdatacharge);
foreach($getdatacharge as $getdatachargei){

  $cin =$getdatachargei->cin;


$company=$this->admin->getRow('SELECT * FROM `mca_scrapper` WHERE cin ="'.$cin.'" and  status="Pending" and type ="master"');

//print_r($company->data);
//echo $company->status; exit;
   $obj = json_decode($company->data,true);


 $companydata = $obj['Company'];
 //print_r($obj['Company']);

 //echo $companydata;exit;
 if($company->data != 'mca not responding try again'){
 $roc = explode('-',$companydata['roc_code']);
 $carray = array(

    'name' => $companydata['company_name'],
    'roc' =>  $roc[1],
   //'registration_number' => $companydata['registration_number'],
    'category' =>$companydata['company_category'],
    'subCategory' => $companydata['company_subcategory'],
    'class' => $companydata['class_of_company'],
    'authourisedCapital' => $companydata['authorised_capital'],
    'paidUpCaiptal' => $companydata['paid_up_capital'],
    'NUMBER_OF_MEMBERS' => $companydata['number_of_members'],
    'dateofincorporation' => $companydata['date_of_incorporation'],
    'address' => $companydata['registered_address'],
    'address2' => $companydata['address'],
    'email' => $companydata['email'],
    'listedOrUnlisted' => $companydata['listed'],
   // 'active' => $companydata[0]['active']
   // 'suspended' => $companydata[0]['suspended']
   // 'annual_filing' => $companydata[0]['date_of_last_agm']
    'balance_filing' => $companydata['date_of_balance_sheet'],
    'status' => $companydata['com_status']
                        );
    $cwhere = array('cin'=>$cin);
    $update = $this->admin->update('company',$cwhere, $carray);

    $sql1=  $this->db->last_query();
    //  echo $sql1;

   $directors = $obj['Director'];

    $dwhere = array('cin'=>$cin);
            $delete=$this->admin->deleteAll('scrap_dir',$dwhere);

   $temp = count($obj['Director']);
       for ($i=0; $i<$temp; $i++) {
           $darray = array(
                            'cin'                 =>$cin,
                            'din'                 =>$directors[$i]['din_pan'] ,
                            'date_of_joining'     =>$directors[$i]['begin_date'] ,
                            'name'                =>$directors[$i]['name'] ,
                            'designation'         =>'Director',
                            'mca_status'          =>'Done',
                        );

          $insert = $this->admin->insert('scrap_dir', $darray);
           }

 $sql2=  $this->db->last_query();
//echo $sql2;
          $array1 = array(

                            'status'  =>"Done"
                        );
          $where = array('cin'=>$cin,  'status' =>"Pending",  'type' =>"master");
          $update = $this->admin->update('mca_scrapper',$where, $array1);
 $sql3=  $this->db->last_query();
// echo $sql3;
}
    $charge=$this->admin->getRow('SELECT * FROM `mca_scrapper` WHERE cin ="'.$cin.'" and  status="Pending" and type ="charges"');
    $charges = json_decode($charge->data,true);
  if($charge->status == 'Pending'){
  if($charges['Charges'] != NULL){

          $chargess = $charges['Charges'];
        $chwhere = array('cin'=>$cin);


   $delete=$this->admin->deleteAll('mca_charges',$chwhere);
   $temp1 = count($charges['Charges']);
       for ($i=0; $i<$temp1; $i++) {
           $array = array(
                            'cin'                 =>$cin,
                            'chargeid'                 =>$chargess[$i]['id'] ,
                            'charge_holder_name'     =>$chargess[$i]['charge_holder_name'] ,
                            'date_of_creation'                =>$chargess[$i]['date_of_creation'] ,
                            'date_of_modification'        =>$chargess[$i]['date_of_modification'] ,
                            'amount'     =>$chargess[$i]['date_of_amount'] ,
                            'date_of_satisfaction'                =>$chargess[$i]['date_of_satisfaction'] ,
                            'srn'         =>$chargess[$i]['srn'] ,
                            'address'                =>$chargess[$i]['address'] ,
                            'mca_status'          =>'Done',
                        );

          $insert = $this->admin->insert('mca_charges', $array);
           }

          $array2 = array(

                            'status'  =>"Done"
                        );
          $where1 = array('cin'=>$cin,  'status' =>"Pending",  'type' =>"charges");
          $update = $this->admin->update('mca_scrapper',$where1, $array2);
      }}
    }

  //  echo $sql1; echo $sql2; echo $sql3;
  }

  public function test($cin){
    echo "Success";
     exit;
  $log=$this->admin->getVal('SELECT cin FROM `scrappers_log` WHERE cin ="'.$cin.'" ');

  $company=$this->admin->getRow('SELECT * FROM `mca_scrapper` WHERE cin ="'.$cin.'" and  status="Pending" and type ="master"');
  echo  $this->db->last_query();
 $obj = json_decode($company->data,true);
 $companydata = $obj['Company'];
 //print_r($obj);
 //echo $companydata;exit;
 if($company->status == 'Pending'){
 $roc = explode('-',$companydata['roc_code']);
 $carray = array(

    'name' => $companydata['company_name'],
    'roc' =>  $roc[1],
   //'registration_number' => $companydata['registration_number'],
    'category' =>$companydata['company_category'],
    'subCategory' => $companydata['company_subcategory'],
    'class' => $companydata['class_of_company'],
    'authourisedCapital' => $companydata['authorised_capital'],
    'paidUpCaiptal' => $companydata['paid_up_capital'],
    'NUMBER_OF_MEMBERS' => $companydata['number_of_members'],
    'dateofincorporation' => $companydata['date_of_incorporation'],
    'address' => $companydata['registered_address'],
    'address2' => $companydata['address'],
    'email' => $companydata['email'],
    'listedOrUnlisted' => $companydata['listed'],
   // 'active' => $companydata[0]['active']
   // 'suspended' => $companydata[0]['suspended']
   // 'annual_filing' => $companydata[0]['date_of_last_agm']
    'balance_filing' => $companydata['date_of_balance_sheet'],
    'status' => $companydata['com_status']
                        );
    $cwhere = array('cin'=>$cin);
    $update = $this->admin->update('company',$cwhere, $carray);

    // echo  $this->db->last_query();

    $directors = $obj['Director'];

    $dwhere = array('cin'=>$cin);
    $delete=$this->admin->deleteAll('scrap_dir',$dwhere);

    $temp = count($obj['Director']);
       for ($i=0; $i<$temp; $i++) {
           $darray = array(
                            'cin'                 =>$cin,
                            'din'                 =>$directors[$i]['din_pan'] ,
                            'date_of_joining'     =>$directors[$i]['begin_date'] ,
                            'name'                =>$directors[$i]['name'] ,
                            'designation'         =>'Director',
                            'mca_status'          =>'Done',
                        );

    $insert = $this->admin->insert('scrap_dir', $darray);
           }

          $array1 = array(

                            'status'  =>"Done"
                        );
          $where = array('cin'=>$cin,  'status' =>"Pending",  'type' =>"master");
          $update = $this->admin->update('mca_scrapper',$where, $array1);

}
    $charge=$this->admin->getRow('SELECT * FROM `mca_scrapper` WHERE cin ="'.$cin.'" and  status="Done" and type ="charges"');
    $charges = json_decode($charge->data,true);
 if($charge->status == 'Pending'){
          $chargess = $charges['Charges'];
        $chwhere = array('cin'=>$cin);
            $delete=$this->admin->deleteAll('mca_charges',$chwhere);
   $temp1 = count($charges['Charges']);
       for ($i=0; $i<$temp1; $i++) {
           $array = array(
                            'cin'                 =>$cin,
                            'chargeid'                 =>$chargess[$i]['id'] ,
                            'charge_holder_name'     =>$chargess[$i]['charge_holder_name'] ,
                            'date_of_creation'                =>$chargess[$i]['date_of_creation'] ,
                            'date_of_modification'        =>$chargess[$i]['date_of_modification'] ,
                            'amount'     =>$chargess[$i]['date_of_amount'] ,
                            'date_of_satisfaction'                =>$chargess[$i]['date_of_satisfaction'] ,
                            'srn'         =>$chargess[$i]['srn'] ,
                            'address'                =>$chargess[$i]['address'] ,
                            'mca_status'          =>'Done',
                        );

          $insert = $this->admin->insert('mca_charges', $array);
           }
    // echo  $this->db->last_query();
          $array2 = array(

                            'status'  =>"Done"
                        );
          $where1 = array('cin'=>$cin,  'status' =>"Pending",  'type' =>"charges");
          $update = $this->admin->update('mca_scrapper',$where1, $array2);
      }
      echo "Success";

  }

   public function mcadata(){


   ini_set('max_execution_time', 0);
  //  $id=$id;
  $getdatacharge=$this->admin->getRows("SELECT cin FROM `mca_scrapper` WHERE `status`= 'Pending' GROUP by cin ");

//print_r($getdatacharge);
foreach($getdatacharge as $getdatachargei){

  $cin =$getdatachargei->cin;


 $log=$this->admin->getVal('SELECT cin FROM `scrappers_log` WHERE cin ="'.$cin.'" ');

       if($log == $cin){
      $company=$this->admin->getRow('SELECT * FROM `mca_scrapper` WHERE cin ="'.$cin.'" and  status="Pending" and type ="master"');


   $obj = json_decode($company->data,true);


 $companydata = $obj['Company'];
 //print_r($obj['Company']);

 //echo $companydata;exit;
 if($company->status == 'Pending'){
 $roc = explode('-',$companydata['roc_code']);
 $carray = array(

    'name' => $companydata['company_name'],
    'roc' =>  $roc[1],
   // 'registration_number' => $companydata['registration_number'],
    'category' =>$companydata['company_category'],
    'subCategory' => $companydata['company_subcategory'],
    'class' => $companydata['class_of_company'],
    'authourisedCapital' => $companydata['authorised_capital'],
    'paidUpCaiptal' => $companydata['paid_up_capital'],
    'NUMBER_OF_MEMBERS' => $companydata['number_of_members'],
    'dateofincorporation' => $companydata['date_of_incorporation'],
    'address' => $companydata['registered_address'],
    'address2' => $companydata['address'],
    'email' => $companydata['email'],
    'listedOrUnlisted' => $companydata['listed'],
   // 'active' => $companydata[0]['active']
   // 'suspended' => $companydata[0]['suspended']
   // 'annual_filing' => $companydata[0]['date_of_last_agm']
    'balance_filing' => $companydata['date_of_balance_sheet'],
    'status' => $companydata['com_status']
                        );
     $cwhere = array('cin'=>$cin);
          $update = $this->admin->update('company',$cwhere, $carray);

      //  echo  $this->db->last_query();

   $directors = $obj['Director'];

    $dwhere = array('cin'=>$cin);
            $delete=$this->admin->deleteAll('scrap_dir',$dwhere);

   $temp = count($obj['Director']);
       for ($i=0; $i<$temp; $i++) {
           $darray = array(
                            'cin'                 =>$cin,
                            'din'                 =>$directors[$i]['din_pan'] ,
                            'date_of_joining'     =>$directors[$i]['begin_date'] ,
                            'name'                =>$directors[$i]['name'] ,
                            'designation'         =>'Director',
                            'mca_status'          =>'Done',
                        );

          $insert = $this->admin->insert('scrap_dir', $darray);
           }

          $array1 = array(

                            'status'  =>"Done"
                        );
          $where = array('cin'=>$cin,  'status' =>"Pending",  'type' =>"master");
          $update = $this->admin->update('mca_scrapper',$where, $array1);

}
    $charge=$this->admin->getRow('SELECT * FROM `mca_scrapper` WHERE cin ="'.$cin.'" and  status="Pending" and type ="charges"');
    $charges = json_decode($charge->data,true);
 if($charge->status == 'Pending'){
          $chargess = $charges['Charges'];
        $chwhere = array('cin'=>$cin);
            $delete=$this->admin->deleteAll('mca_charges',$chwhere);
   $temp1 = count($charges['Charges']);
       for ($i=0; $i<$temp1; $i++) {

        if($chargess[$i]['date_of_satisfaction'] == null || $chargess[$i]['date_of_satisfaction'] == '-'){
           $array = array(
                            'cin'                 =>$cin,
                            'chargeid'                 =>$chargess[$i]['id'] ,
                            'charge_holder_name'     =>$chargess[$i]['charge_holder_name'] ,
                            'date_of_creation'                =>$chargess[$i]['date_of_creation'] ,
                            'date_of_modification'        =>$chargess[$i]['date_of_modification'] ,
                            'amount'     =>$chargess[$i]['date_of_amount'] ,
                            'date_of_satisfaction'                =>$chargess[$i]['date_of_satisfaction'] ,
                            'srn'         =>$chargess[$i]['srn'] ,
                            'address'                =>$chargess[$i]['address'] ,
                            'mca_status'          =>'Done',
                        );

          $insert = $this->admin->insert('mca_charges', $array);
        }
           }

          $array2 = array(

                            'status'  =>"Done"
                        );
          $where1 = array('cin'=>$cin,  'status' =>"Pending",  'type' =>"charges");
          $update = $this->admin->update('mca_scrapper',$where1, $array2);
      }
      echo "Success";
  }else{

    //echo "Success";
  }
  }    }

  //  echo $sql1; echo $sql2; echo $sql3;
  }
