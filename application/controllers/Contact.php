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

class Contact extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    // ===================Support=======
    public function index()
    {    

        $data['title'] = ' Contact  | KreditAid';
        $this->load->view('home_e/header_b', $data, false);
        $this->load->view('home_e/contact_b');
        $this->load->view('home_e/footer_b', $data, false);
    }


 // ===================Privacy policy=======
    public function privacy()
    {    

        $data['title'] = ' Privacy Policy  | KreditAid';
        $this->load->view('home_e/header_b', $data, false);
        $this->load->view('home_e/policy_b');
        $this->load->view('home_e/footer_b', $data, false);
    }


// ===================FAQs=======
    public function faq()
    {    

        $data['title'] = ' FAQs  | KreditAid';
        $this->load->view('home_e/header_b', $data, false);
        $this->load->view('home_e/faq_b');
        $this->load->view('home_e/footer_b', $data, false);
    }


       
    



}

