<?php
defined('BASEPATH') or exit('No direct script access allowed');
// require_once "/var/www/html/tools/MTS/EnableMTS.php";
class Mca extends CI_Controller
{
  public function __construct()
  {
      parent::__construct();
      $this->load->library(array('session','Custom','email'));
      $this->load->model('Send_mail');
  }
      public function mcadata($cin){
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
        }


        $this->db->select('*');
        $this->db->where('cin',$cin);
        $this->db->where('status','Pending');
        $this->db->where('type','director');
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
            $data['Directors'][$d]['DOA']=$directors['Date_of_Appointment'];
            $data['Directors'][$d]['Expiry_Date_of_DSC']=$directors['Expiry_Date_of_DSC'];
            $data['Directors'][$d]['Surrendered_DIN']=$directors['Surrendered_DIN'];
            $data['Directors'][$d]['cin']=$cin;
            $data['Directors'][$d]['mca_status']='Done';
            $d++;
          }
          if($data['Directors']){
            $this->db->where('cin',$cin);
            $this->db->delete('mca_directors');

            foreach ($data['Directors'] as $dir) {
                $this->db->insert('mca_directors', $dir);
            }

            $MCA_DIR=true;
          }





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
            $this->db->where('cin',$cin);
            $this->db->delete('mca_charges');

            foreach ($data['Charges'] as $dir) {
                $this->db->insert('mca_charges', $dir);
            }

            $MCA_CHARGES=true;
          }





        }

        if($MCA_DIR||$MCA_BASIC||$MCA_CHARGES){
          $data['scrappers']['status']="DONE";
          $this->db->where('cin',$cin);
          $this->db->where('type','master');
          $this->db->where('status','initiated');
          $this->db->update('mca_scrapper',$data['scrappers']);

          $data['local']['status']="DONE";
          $this->db->where('cin',$cin);
          $this->db->where('status','initiated');
          $this->db->update('local_mca',$data['local']);


          $data['cron']['status']='done';
          $this->db->update('jobs',$data['cron']);
        }





      }






      public function basic($cin){
          $url="http://35.202.89.18/master?cin=".$cin."&pool=10&slack=10";
          $cmd='curl  -s "'.$url.'" > /dev/null &';
          shell_exec($cmd);

          $url="http://35.202.89.18/dir?cin=".$cin."&pool=10&slack=10";
          $cmd='curl  -s "'.$url.'" > /dev/null &';
          shell_exec($cmd);

          $url="http://35.202.89.18/charges?cin=".$cin."&pool=10&slack=10";
          $cmd='curl  -s "'.$url.'" > /dev/null &';
          shell_exec($cmd);

          $data['cron']['cin']=$cin;
          $data['cron']['type']='master';
          $data['cron']['status']='initiated';
          $this->db->insert('jobs',$data['cron']);

          $data['local']['cin']=$cin;
          $data['local']['status']='initiated';
          $this->db->insert('local_mca',$data['local']);

          // $shellObj->exeCmd($cmd);
          // echo $cmd;
          //
          // $url="http://35.202.89.18/dir?cin=".$cin."&pool=10&slack=10";
          // $cmd='curl  -s "'.$url.'" > /dev/null &';
          // shell_exec($cmd);
          //
          // $url2='http://uat.kreditaid.com/api/mcadata/'.$cin;
          //
          // $cmd2='curl  -s "'.$url2.'" > /dev/null &';
          // $output = shell_exec('crontab -l');
          // file_put_contents('/tmp/crontab.txt', $output.'*/2 * * * * '.$cmd2.PHP_EOL);
          // exec('crontab /tmp/crontab.txt');
          $data['update']['mca_status']="Pending";
          $this->db->where('cin',$cin);
          $this->db->update('company',$data['update']);

      }

      public function testlocal(){
        $this->db->select('*');
        $this->db->where('status','initiated');
        $this->db->order_by('id',"DESC");
        $this->db->limit(1);
        $query=$this->db->get('local_mca');
        $row=$query->row_array();
        if($query->num_rows()){
          $data['status']='ok';
          $data['cin']=$row['cin'];
          echo json_encode($data);
        }

      }

}
