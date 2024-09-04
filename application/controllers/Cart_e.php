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

class Cart_e extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('CartModel_e');
    }

    // =====================================Add to cart Start============================
    public function AddToCart()
    {
        $Customer_id='';
        $cin='';
        //=====================Cart Model================
        if(isset($_SESSION['auth_user']))
        {
            $cin = $this->input->get_post('cin');
            $cart_status = $this->input->get_post('cart_status');
            $cart_status = filter_var($cart_status,FILTER_SANITIZE_STRING);
            $companyName = $this->input->get_post('comp_name');
            $cin = filter_var($cin,FILTER_SANITIZE_STRING);
            $companyName = filter_var($companyName,FILTER_SANITIZE_STRING);
            $customerEmail = $_SESSION['auth_user'];
            $res = $this->CartModel_e->addToCart($cin,$companyName,$customerEmail,$cart_status);
            // var_dump($res);
            if($res=='inserted')
            {
                echo "added_in_cart";exit;
            }
            if($res=='not-inserted')
            {
                echo "not_add_to_cart";exit;
            }
            if($res=='already_exist')
            {
                echo "already_exist";exit;
            }
        }
    }

    public function addToCartUrl()
    { 

        if(isset($_SESSION['auth_user']))
        {


            $cin = $this->input->get_post('cin');


            $companyName = $this->input->get_post('name');
            $cart_status = $this->input->get_post('cart_status');
            $cart_status = filter_var($cart_status,FILTER_SANITIZE_STRING);
            $cin = filter_var($cin,FILTER_SANITIZE_STRING);
            $companyName = filter_var($companyName,FILTER_SANITIZE_STRING);
            $customerEmail = $_SESSION['auth_user'];

            $res = $this->CartModel_e->addToCart($cin,$companyName,$customerEmail,$cart_status);

            // var_dump($res); die();

            if($res=='inserted')
            {
                redirect(base_url("User_Dashboard").'?a=3&cart=success');exit();
            }

            if($res=='already_exist')
            {
                redirect(base_url("User_Dashboard").'?a=3&cart=already');exit();
            }
            
            if($res=='not-inserted')
            {
                echo "not_add_to_cart";exit;
            }
        }    
    }
    // =====================================Add to cart End============================
    
    // =====================================checkout All Start=========================
    public function checkOutAllItem()
    {
        if(isset($_SESSION['auth_user']))
        {
            $checkOutData = $this->input->get_post('allCartData');
            // var_dump($checkOutData);exit;
            $res = $this->CartModel_e->checkOutAllItem($checkOutData);
            // var_dump($res);exit;
            if($res=='inserted')
            {
                echo "added_in_cart";exit;
            }
            if($res=='not-inserted')
            {
                echo "not_add_to_cart";exit;
            }
            if($res=='already_exist')
            {
                echo "already_exist";exit;
            }
        }   
    }
    // =====================================checkout All End=========================

}