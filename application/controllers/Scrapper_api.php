<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Controller Search
 *
 * @package   UCS
 * @category  Search
 *
 */

class Scrapper_api extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
      public function fn_scrapper($cin)
      {

              $priority=$this->admin->getVal('SELECT priority FROM `scrappers_log` WHERE cin ="'.$cin.'"');

              $prioritys=$priority + 1;
 $darray = array(
            
                            'company_status'      =>'pending',
                            'charges_status'      =>'pending',
                            'company_counter'     =>0,
                            'charges_counter'     =>0,
                            'scrape_type'         =>1,
                            'priority'            =>$prioritys,
                        );
     
          $where = array('cin'=>$cin);
          $update = $this->admin->update('scrappers_log',$where, $darray);
// echo $cin; exit;

      }
      public function fn_scrapper_api()
      {
       // $data['STATUS']=200;
       // echo json_encode($data);
       // exit;

        //bhoopendra


   ini_set('max_execution_time', 0);
  //  $id=$id;
  $getdatacharge=$this->admin->getRows("SELECT cin FROM `mca_scrapper` WHERE `status`= 'Pending' GROUP by cin ");

//print_r($getdatacharge);
foreach($getdatacharge as $getdatachargei){

  $cin =$getdatachargei->cin;


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
    'status' => $companydata['com_status'],
    'mca_status' => 1
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
 }
  }  

   public function test()
      {
       // $data['STATUS']=200;
       // echo json_encode($data);
       // exit;

        //bhoopendra


   ini_set('max_execution_time', 0);
  //  $id=$id;
  $getdatacharge=$this->admin->getRows("SELECT cin FROM `mca_scrapper` WHERE `status`= 'Pending' GROUP by cin ");

//print_r($getdatacharge);
foreach($getdatacharge as $getdatachargei){

  $cin =$getdatachargei->cin;


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
   $temp4 = count($charges['Charges']);
echo $temp4; 
       for ($j=0; $j<$temp4; $j++) {

        if($chargess[$j]['date_of_satisfaction'] == null || $chargess[$j]['date_of_satisfaction'] == '-'){
           $array = array(
                            'cin'                 =>$cin,
                            'chargeid'                 =>$chargess[$j]['id'] ,
                            'charge_holder_name'     =>$chargess[$j]['charge_holder_name'] ,
                            'date_of_creation'                =>$chargess[$j]['date_of_creation'] ,
                            'date_of_modification'        =>$chargess[$j]['date_of_modification'] ,
                            'amount'     =>$chargess[$j]['date_of_amount'] ,
                            'date_of_satisfaction'                =>$chargess[$j]['date_of_satisfaction'] ,
                            'srn'         =>$chargess[$j]['srn'] ,
                            'address'                =>$chargess[$j]['address'] ,
                            'mca_status'          =>'Done',
                        );

          $insert = $this->admin->insert('mca_charges', $array);
        }
           }
print_r($charges['Charges'][3]);
          $array2 = array(

                            'status'  =>"Done"
                        );
          $where1 = array('cin'=>$cin,  'status' =>"Pending",  'type' =>"charges");
          $update = $this->admin->update('mca_scrapper',$where1, $array2);
      }
      echo "Success";
 }
  }  
}
