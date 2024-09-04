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

class Scrappers extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function fn_check_company($id)
    {
        $status = array();
        $scrapper['cin']=$id;
        $scrapper['priority']=1;


        $this->db->select('*');
        $this->db->where('cin', $id);
        $query = $this->db->get('scrappers_log');

        if ($query->num_rows()) {
            $data['logs']=$query->row_array();
            $scrapper_update['priority']=(int)$data['logs']['priority']+1;

            if($data['logs']['scrap_type']!==2){
              $scrapper['scrap_type']=(int)$_GET['scrap_type'];
            }



            $this->db->where('cin', $id);
            $this->db->update('scrappers_log', $scrapper_update);
            $status['msg']='Update Job Priority';
        } else {
          $scrapper['company_status']="pending";
          $scrapper['director_status']="pending";
          $scrapper['charges_status']="pending";
          $this->db->insert('scrappers_log', $scrapper);
          $status['msg']='Inserted Job';
        }
        echo json_encode($status);
    }

    public function fn_status_scrappers()
    {
        $status = array();
        $data=$_GET;
        $this->db->select('*');
        $this->db->where('cin', $data['cin']);
        $this->db->limit(1);
        $query = $this->db->get('scrappers_log');

        if ($query->num_rows()) {
            $data['logs']=$query->row_array();

            if ($data['type']=='master') {
                $scrapper_update['company_status']='Done';
                $scrapper_update['scrap_type']=$data['scrap_type'];
            }
            if ($data['type']=='charges') {
                $scrapper_update['charges_status']='Done';
                $scrapper_update['scrap_type']=$data['scrap_type'];
            }
            $this->db->where('cin', $data['cin']);
            $this->db->update('scrappers_log', $scrapper_update);
            $status['data']=$scrapper_update;
            $status['msg']='Update Job Priority';
        }
        echo json_encode($status);
    }


    public function fn_set_scrappers()
    {
        $status = array();
        $data=$_GET;
        $this->db->select('*');
        $this->db->where('cin', $data['cin']);
        $this->db->limit(1);
        $query = $this->db->get('scrappers_log');
        // echo $this->db->last_query();
        if ($query->num_rows()) {
            $data['logs']=$query->row_array();

            if ($data['type']=='master') {
                $scrapper_update['company_counter']=(int)$data['logs']['company_counter']+1;
            }

            if ($data['type']=='director') {
                $scrapper_update['director_counter']=(int)$data['logs']['director_counter']+1;
            }

            if ($data['type']=='charges') {
                $scrapper_update['charges_counter']=(int)$data['logs']['charges_counter']+1;
            }
            $this->db->where('cin', $data['cin']);
            $this->db->update('scrappers_log', $scrapper_update);
            $status['data']=$scrapper_update;
            $status['msg']='Update Job Priority';
        }
        echo json_encode($status);
    }

    public function fn_get_company_master()
    {
        ini_set('max_execution_time', 0);
        $status = array();
        $this->db->select('cin');
        // $this->db->where('company_counter <=', 1);
        // $this->db->where('scrap_type <', 1);
        // $this->db->where('company_status', 'pending');
        $this->db->limit(1);
        $this->db->order_by('priority DESC');
        //$this->db->order_by('company_counter ASC', 'priority DESC');
        $query = $this->db->get('scrappers_log');
       // echo $this->db->last_query();
        echo json_encode($query->row_array());
    }

    public function fn_get_company_master_manual()
    {
        ini_set('max_execution_time', 0);
        $status = array();
        $this->db->select('cin');
        $this->db->where('company_counter <=', 1);
        $this->db->where('scrap_type =', 2);
        $this->db->where('company_status', 'pending');
        $this->db->limit(1);
        $this->db->order_by('priority DESC');
        //$this->db->order_by('company_counter ASC', 'priority DESC');
        $query = $this->db->get('scrappers_log');
        //echo $this->db->last_query();
        echo json_encode($query->row_array());
    }

    public function fn_get_company_master_report()
    {
        ini_set('max_execution_time', 0);
        $status = array();
        $this->db->select('cin');
        $this->db->where('scrap_type =', 2);
        $this->db->where('company_status', 'pending');
        $this->db->limit(1);
        $this->db->order_by('priority DESC');
        //$this->db->order_by('company_counter ASC', 'priority DESC');
        $query = $this->db->get('scrappers_log');
        //echo $this->db->last_query();
        echo json_encode($query->row_array());
    }

    public function fn_get_company_charges()
    {
        ini_set('max_execution_time', 0);
        $status = array();
        $this->db->select('cin');
        // $SQLMATCH = "MATCH (` `cin`) AGAINST ('".$data['search']."*"."' IN BOOLEAN MODE)";
        // $this->db->where($SQLMATCH);
        $this->db->where('charges_counter <=', 1);
        $this->db->where('scrap_type <', 1);
        $this->db->where('charges_status', 'pending');
        $this->db->limit(1);
        $this->db->order_by('priority DESC');
        // $this->db->order_by('charges_counter ASC', 'priority DESC');
        $query = $this->db->get('scrappers_log');
        // echo $this->db->last_query();
        echo json_encode($query->row_array());
    }


    public function fn_get_company_charges_manual()
    {
        ini_set('max_execution_time', 0);
        $status = array();
        $this->db->select('cin');
        // $SQLMATCH = "MATCH (` `cin`) AGAINST ('".$data['search']."*"."' IN BOOLEAN MODE)";
        // $this->db->where($SQLMATCH);
        $this->db->where('charges_counter <=', 1);
        $this->db->where('scrap_type =', 2);
        $this->db->where('charges_status', 'pending');
        $this->db->limit(1);
        $this->db->order_by('priority DESC');
        // $this->db->order_by('charges_counter ASC', 'priority DESC');
        $query = $this->db->get('scrappers_log');
        // echo $this->db->last_query();
        echo json_encode($query->row_array());
    }

    public function fn_get_company_charges_report()
    {
        ini_set('max_execution_time', 0);
        $status = array();
        $this->db->select('cin');
        $this->db->where('scrap_type =', 3);
        $this->db->where('charges_status', 'pending');
        $this->db->limit(1);
        $this->db->order_by('priority DESC');
        $query = $this->db->get('scrappers_log');
        echo json_encode($query->row_array());
    }




    public function fn_get_company_master1()
    {
        ini_set('max_execution_time', 0);
        $priority=$this->admin->getRow('SELECT cin, max(priority) FROM `scrappers_log` where `company_status` = "pending" and scrap_type=1 and company_counter <= 1');

        $darray = array(
                            'cin'            =>$priority->cin,
                        );
        echo json_encode($darray);
    }
    public function fn_get_company_master2()
    {
        ini_set('max_execution_time', 0);
        $priority=$this->admin->getRow('SELECT cin, max(priority) FROM `scrappers_log` where `company_status` = "pending" and scrap_type=2  and company_counter <= 1');

        $darray = array(
                            'cin'            =>$priority->cin,
                        );
        echo json_encode($darray);
    }
    public function fn_get_company_master3()
    {
        ini_set('max_execution_time', 0);
        $priority=$this->admin->getRow('SELECT cin, max(priority) FROM `scrappers_log` where `company_status` = "pending" and scrap_type=3  and company_counter <= 1');

        $darray = array(
                            'cin'            =>$priority->cin,
                        );
        echo json_encode($darray);
    }



    public function fn_get_company_charges1()
    {
        ini_set('max_execution_time', 0);
        $priority=$this->admin->getRow('SELECT cin, max(priority) FROM `scrappers_log` where `charges_status` = "pending" and scrap_type=1 and charges_counter <= 1');

        $darray = array(
                            'cin'            =>$priority->cin,
                        );
        echo json_encode($darray);
    }
    public function fn_get_company_charges2()
    {
        ini_set('max_execution_time', 0);
        $priority=$this->admin->getRow('SELECT cin, max(priority) FROM `scrappers_log` where `charges_status` = "pending" and scrap_type=2 and charges_counter <= 1');

        $darray = array(
                            'cin'            =>$priority->cin,
                        );
        echo json_encode($darray);
    }
    public function fn_get_company_charges3()
    {
        ini_set('max_execution_time', 0);
        $priority=$this->admin->getRow('SELECT cin, max(priority) FROM `scrappers_log` where `charges_status` = "pending" and scrap_type=3 and charges_counter <= 1');

        $darray = array(
                       'cin'            =>$priority->cin,
                        );
        echo json_encode($darray);
    }
}
