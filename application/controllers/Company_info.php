<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Controller Search
 *
 * @package   UCS
 * @category  Search
 *
 */

class Company_info extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Company_info_model');
        $this->load->library('session');    
        
    }

    // ===================Auto==search=======
    public function index($cin)
    { 
        // $cart_data = '';
        $data['title'] = 'Company Info | KreditAid';
        $data['cin'] = $cin;
        

        if(isset($_SESSION['auth_user']))
        {
          $this->load->model('CartModel_e');
          $cart_data = $this->CartModel_e->cart_item();
          $_SESSION['cart_item'] = $cart_data; 
        }
        
       

        $this->load->view('home_e/header_b', $data, false);
        $this->load->view('home_e/Company_info', ['cin'=>$cin], false);
        $this->load->view('home_e/footer_b', $data, false);
    }

// ========================Pankaj===============

    // public function add($cin)
    // {   

    //     $data=explode('.', $cin);

    //     $cin=$data[0];
    //     $name=$data[1];
    //     $name=str_replace('-', ' ', $name);

    //     // session_destroy();die();
      

    //     if($_SESSION['auth_user'])
    //     {

    //         redirect(base_url("Company_info/").$cin);exit();

    //     }
    //     else{

    //         $sid='cin'.$cin;


    //         @$data = $_SESSION[$sid];

    //         // $_SESSION[$sid]=1;

    //         // var_dump($_SESSION);
    //         // die();

    //         if($data){ 

    //             redirect(base_url("Company_info/").$cin);exit();
                
                
    //         }
    //         else
    //         {
    //             $data2=array(['cin'=>$cin,'name'=>$name ]);
    //             // array_replace($data,$data2);

    //             $_SESSION[$sid]=$data2;

    //             // var_dump($_SESSION);die;
    //             redirect(base_url("Company_info/").$cin);exit();
    //         }

    //     }

    // }

    public function addToCartAjax()
    {
        $cin=$this->input->get_post('cin');
        $name=$this->input->get_post('comp_name');
        
        $name=str_replace('-', ' ', $name);
        // echo $cin.",".$name;exit;
        if($_SESSION['auth_user'])
        {

            echo '';exit();

        }
        else{

            $sid='cin'.$cin;


            @$data = $_SESSION[$sid];

            // $_SESSION[$sid]=1;

            // var_dump($_SESSION);
            // die();

            if($data){ 

                redirect(base_url("Company_info/").$cin);exit();
                
                
            }
            else
            {
                $data2=array(['cin'=>$cin,'name'=>$name ]);
                // array_replace($data,$data2);
                        
                $_SESSION[$sid]=$data2;

                // var_dump($_SESSION);die;

                echo 'added-in-cart';exit;
                redirect(base_url("Company_info/").$cin);exit();
            }



        }
    }

    public function remove($cin)
    {   
        $sid='cin'.$cin;
        if($_SESSION[$sid])
        {
            unset($_SESSION[$sid]);
            redirect(base_url("Company_info/").$cin);exit();
                
        }

        // $this->load->view('home_e/Company_info', ['cin'=>$cin], false);
    }

    // ==========================pankaj====================


    // =======================Get-===conpany===data===

    public function get_all_company_data($cin)
    {
        $name=$this->input->get_post($cin); 
        $dbc=$this->load->model('Search_home_e');
    }
    
    // ============update compInfo Aquib start===========
    public function updateComInfoFunc()
    {
        // var_dump($_REQUEST);exit;
        $cin = trim($this->input->get_post('cin'));
        $cin = filter_var($cin,FILTER_SANITIZE_STRING);
        if(isset($_SESSION['auth_user']))
        {
            $res = $this->Company_info_model->updateComInfo($cin);
            // var_dump($res);exit;
            if($res=='Success')
            {
                echo 'QueryAdded';exit;
            }
            if($res=='Error')
            {
                echo 'QueryNotAdded';exit;
            }
            if($res == 'already_exist')
            {
                echo $res;exit;
            }
            
        }
    }
    // ============update compInfo Aquib start===========
}

