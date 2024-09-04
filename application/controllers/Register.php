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

class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    // ===================Auto==search=======
    public function index()
    {    

        $data['title'] = ' Register  | KreditAid';
        $this->load->view('home_e/header_b', $data, false);
        $this->load->view('home_e/Register');
        // $this->load->view('home_e/footer_b', $data, false);
    }


       
    



}

