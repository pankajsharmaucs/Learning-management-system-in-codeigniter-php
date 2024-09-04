<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {
    function __construct()
    {
        parent::__construct();
          $this->load->model('Send_mail');
    }

public function index()
  {

 $year = date('Y');

$month = date('m');
$date = date('Y-m-d');

     $data['getdata']=$this->admin->getRows("SELECT count(b.id) as total, sum(b.amount) as totalamount,sum(b.gst) as totalgst,sum(b.total_amount) as gettotal_amount,u.country_id,u.name,u.email,o.user_id,Month(o.date) as month,YEAR(o.date) as year FROM orders o,users u,billing_address b where u.invoice = 'Add hoc' and u.id=o.user_id and b.user_id=o.user_id and b.id=o.billing_id and u.type='postpaid' and date(o.date)='".$date."'  group by  date(o.date), u.id");

// $data['datalist']=$this->admin->getRows("SELECT * FROM prepaidcoin WHERE '".$date."' BETWEEN prepaidcoin .startdate AND prepaidcoin .enddate and status = 1");

//echo $this->db->last_query(); exit;
  //echo $data['getdata'][0]->name;
  // print_r($data['getdata']);

    foreach($data['getdata'] as $data['getdatai']){
       $array = array(
                    'user_id'           =>$data['getdatai']->user_id ,
                    'country_id'        =>$data['getdatai']->country_id,
                    'total_product'     =>$data['getdatai']->total ,
                    'totalamount'       =>$data['getdatai']->totalamount ,
                    'totalgst'          =>$data['getdatai']->totalgst ,
                    'gettotal_amount'   =>$data['getdatai']->gettotal_amount,
                    'name'              =>$data['getdatai']->name,
                    'email'             =>$data['getdatai']->email,
                    'month'             =>$month,
                    'year'              =>$year
                 );


    $insert = $this->admin->insert('postpaid_invoice', $array);
    $subject="Postpaid Invoice";
    $to=$data['getdatai']->email;
    $id="2";
    $view='emails/postpaid_invoice';
    $this->Send_mail->send($id, $to, $view, $subject, $data);
  }
    }

    public function month()
  {

 $year = date('Y');

$month = date('m');


     $data['getdata']=$this->admin->getRows("SELECT count(o.id) as total, sum(o.cost) as totalamount,sum(o.cost) as gettotal_amount,u.country_id,u.name,u.email,o.user_id,Month(o.date) as month,YEAR(o.date) as year FROM orders o,users u where u.invoice = 'Month End' and u.id=o.user_id  and u.type='postpaid' and Month(o.date)='".$month."' and YEAR(o.date)='".$year."'  group by  Month(o.date)='".$month."', u.id");


  //echo $data['getdata'][0]->name;
  // print_r($data['getdata']);

    foreach($data['getdata'] as $data['getdatai']){
       $array = array(
                    'user_id'              =>$data['getdatai']->user_id ,
                    'country_id'          =>$data['getdatai']->country_id,
                    'total_product'          =>$data['getdatai']->total ,
                    'totalamount'          =>$data['getdatai']->totalamount ,
                 //   'totalgst'          =>$data['getdatai']->totalgst ,
                    'gettotal_amount'          =>$data['getdatai']->gettotal_amount,
                    'name'          =>$data['getdatai']->name,
                    'email'          =>$data['getdatai']->email,
                    'month'            =>$data['getdatai']->month,
                    'year'            =>$data['getdatai']->year
                 );


    $insert = $this->admin->insert('postpaid_invoice', $array);
   // echo $this->db->last_query();
    $subject="Postpaid Invoice";
    $to=$data['getdatai']->email;
    $id="2";
    $view='emails/postpaid_invoice';
    $this->Send_mail->send($id, $to, $view, $subject, $data);
  }
    }

    public function year()
  {

 $year = date('Y');
$month = date('m');


 //    $data['getdata']=$this->admin->getRows("SELECT count(b.id) as total, sum(b.amount) as totalamount,sum(b.gst) as totalgst,sum(b.total_amount) as gettotal_amount,u.country_id,u.name,u.email,o.user_id,Month(o.date) as month,YEAR(o.date) as year FROM orders o,users u,billing_address b where u.invoice = 'Year End' and u.id=o.user_id and b.user_id=o.user_id and b.id=o.billing_id and u.type='postpaid'  and YEAR(o.date)='".$year."'  group by  Month(o.date), u.id");
 $data['getdata']=$this->admin->getRows("SELECT count(o.id) as total, sum(o.cost) as totalamount,sum(o.cost) as gettotal_amount,u.country_id,u.name,u.email,o.user_id,Month(o.date) as month,YEAR(o.date) as year FROM orders o,users u where u.invoice = 'Month End' and u.id=o.user_id  and u.type='postpaid' and Month(o.date)='".$month."' and YEAR(o.date)='".$year."'  group by  Month(o.date)='".$month."', u.id");
  // echo $data['getdata'][0]->name;
  // print_r($data['getdata']);

    foreach($data['getdata'] as $data['getdatai']){
       $array = array(
                    'user_id'              =>$data['getdatai']->user_id ,
                    'country_id'          =>$data['getdatai']->country_id,
                    'total_product'          =>$data['getdatai']->total ,
                    'totalamount'          =>$data['getdatai']->totalamount ,
                 //   'totalgst'          =>$data['getdatai']->totalgst ,
                    'gettotal_amount'          =>$data['getdatai']->gettotal_amount,
                    'name'          =>$data['getdatai']->name,
                    'email'          =>$data['getdatai']->email,
                    'month'            =>$data['getdatai']->month,
                    'year'            =>$data['getdatai']->year
                 );


    $insert = $this->admin->insert('postpaid_invoice', $array);
    $subject="Postpaid Invoice";
    $to=$data['getdatai']->email;
    $id="2";
    $view='emails/postpaid_invoice';
    $this->Send_mail->send($id, $to, $view, $subject, $data);
  }
    }
// firsthalfyear
// seconadhalfyear
public function firsthalfyear()
{

$year = date('Y');

$month = date('m');


 //$data['getdata']=$this->admin->getRows("SELECT count(b.id) as total, sum(b.amount) as totalamount,sum(b.gst) as totalgst,sum(b.total_amount) as gettotal_amount,u.country_id,u.name,u.email,o.user_id,Month(o.date) as month,YEAR(o.date) as year FROM orders o,users u,billing_address b where u.invoice = 'Quaterly' and u.id=o.user_id and b.user_id=o.user_id and b.id=o.billing_id and u.type='postpaid'  and YEAR(o.date)='".$year."'  group by  Month(o.date), u.id");

  $data['getdata']=$this->admin->getRows("SELECT count(o.id) as total, sum(o.cost) as totalamount,sum(o.cost) as gettotal_amount,u.country_id,u.name,u.email,o.user_id,Month(o.date) as month,YEAR(o.date) as year FROM orders o,users u where u.invoice = 'Month End' and u.id=o.user_id  and u.type='postpaid' and Month(o.date)='".$month."' and YEAR(o.date)='".$year."'  group by  Month(o.date)='".$month."', u.id");

//echo $data['getdata'][0]->name;
// print_r($data['getdata']);

foreach($data['getdata'] as $data['getdatai']){
   $array = array(
                'user_id'              =>$data['getdatai']->user_id ,
                'country_id'          =>$data['getdatai']->country_id,
                'total_product'          =>$data['getdatai']->total ,
                'totalamount'          =>$data['getdatai']->totalamount ,
              //  'totalgst'          =>$data['getdatai']->totalgst ,
                'gettotal_amount'          =>$data['getdatai']->gettotal_amount,
                'name'          =>$data['getdatai']->name,
                'email'          =>$data['getdatai']->email,
                'month'            =>$data['getdatai']->month,
                'year'            =>$data['getdatai']->year
             );


$insert = $this->admin->insert('postpaid_invoice', $array);
$subject="Postpaid Invoice";
$to=$data['getdatai']->email;
$id="2";
$view='emails/postpaid_invoice';
$this->Send_mail->send($id, $to, $view, $subject, $data);
}
}
    public function seconadhalfyear()
  {

 $year = date('Y');

$month = date('m');


   //  $data['getdata']=$this->admin->getRows("SELECT count(b.id) as total, sum(b.amount) as totalamount,sum(b.gst) as totalgst,sum(b.total_amount) as gettotal_amount,u.country_id,u.name,u.email,o.user_id,Month(o.date) as month,YEAR(o.date) as year FROM orders o,users u,billing_address b where u.invoice = 'Quaterly' and u.id=o.user_id and b.user_id=o.user_id and b.id=o.billing_id and u.type='postpaid'  and YEAR(o.date)='".$year."'  group by  Month(o.date), u.id");

 $data['getdata']=$this->admin->getRows("SELECT count(o.id) as total, sum(o.cost) as totalamount,sum(o.cost) as gettotal_amount,u.country_id,u.name,u.email,o.user_id,Month(o.date) as month,YEAR(o.date) as year FROM orders o,users u where u.invoice = 'Month End' and u.id=o.user_id  and u.type='postpaid' and Month(o.date)='".$month."' and YEAR(o.date)='".$year."'  group by  Month(o.date)='".$month."', u.id");

  //echo $data['getdata'][0]->name;
  // print_r($data['getdata']);

    foreach($data['getdata'] as $data['getdatai']){
       $array = array(
                    'user_id'              =>$data['getdatai']->user_id ,
                    'country_id'          =>$data['getdatai']->country_id,
                    'total_product'          =>$data['getdatai']->total ,
                    'totalamount'          =>$data['getdatai']->totalamount ,
                 //   'totalgst'          =>$data['getdatai']->totalgst ,
                    'gettotal_amount'          =>$data['getdatai']->gettotal_amount,
                    'name'          =>$data['getdatai']->name,
                    'email'          =>$data['getdatai']->email,
                    'month'            =>$data['getdatai']->month,
                    'year'            =>$data['getdatai']->year
                 );


    $insert = $this->admin->insert('postpaid_invoice', $array);
    $subject="Postpaid Invoice";
    $to=$data['getdatai']->email;
    $id="2";
    $view='emails/postpaid_invoice';
    $this->Send_mail->send($id, $to, $view, $subject, $data);
  }
    }

    public function hodhock()
  {

  $year = date('Y');
  $month = date('m');

 // $data['getdata']=$this->admin->getRows("SELECT count(b.id) as total, sum(b.amount) as totalamount,sum(b.gst) as totalgst,sum(b.total_amount) as gettotal_amount,u.country_id,u.name,u.email,o.user_id,Month(o.date) as month,YEAR(o.date) as year FROM orders o,users u,billing_address b where u.id=o.user_id and b.user_id=o.user_id and b.id=o.billing_id and u.type='postpaid' and Month(o.date)='".$month."' and YEAR(o.date)='".$year."'  group by  Month(o.date)='".$month."', u.id");
   $data['getdata']=$this->admin->getRows("SELECT count(o.id) as total, sum(o.cost) as totalamount,sum(o.cost) as gettotal_amount,u.country_id,u.name,u.email,o.user_id,Month(o.date) as month,YEAR(o.date) as year FROM orders o,users u where u.invoice = 'Month End' and u.id=o.user_id  and u.type='postpaid' and Month(o.date)='".$month."' and YEAR(o.date)='".$year."'  group by  Month(o.date)='".$month."', u.id");

  //echo $data['getdata'][0]->name;
  // print_r($data['getdata']);

    foreach($data['getdata'] as $data['getdatai']){
       $array = array(
                    'user_id'             =>$data['getdatai']->user_id ,
                    'country_id'          =>$data['getdatai']->country_id,
                    'total_product'       =>$data['getdatai']->total ,
                    'totalamount'          =>$data['getdatai']->totalamount ,
                  //  'totalgst'            =>$data['getdatai']->totalgst ,
                    'gettotal_amount'     =>$data['getdatai']->gettotal_amount,
                    'name'              =>$data['getdatai']->name,
                    'email'            =>$data['getdatai']->email,
                    'month'            =>$data['getdatai']->month,
                    'year'            =>$data['getdatai']->year
                     );


    $insert = $this->admin->insert('postpaid_invoice', $array);
    $subject="Postpaid Invoice";
    $to=$data['getdatai']->email;
    $id="2";
    $view='emails/postpaid_invoice';
    $this->Send_mail->send($id, $to, $view, $subject, $data);
  }
    }

}
