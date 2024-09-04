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

class Director_search extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }


        // ===================Auto==search=======
        public function index($keyword)
        {        
            $data['title'] = ' Director search | KreditAid';
            $this->load->view('home_e/header_b', $data, false);
            $this->load->view('home_e/Director_search', ['keyword'=>$keyword], false);
            $this->load->view('home_e/footer_b', $data, false);
        }


}

