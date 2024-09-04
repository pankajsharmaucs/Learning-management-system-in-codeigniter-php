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

class Director_info extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    // ===================Auto==search=======
    public function index($din)
    {    

        $data['title'] = ' Director info | KreditAid';
        $this->load->view('home_e/header_b', $data, false);
        $this->load->view('home_e/Director_info', ['din'=>$din], false);
        $this->load->view('home_e/footer_b', $data, false);
    }


       
    



}

