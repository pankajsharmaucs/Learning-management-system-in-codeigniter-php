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

class Advance_search extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }


        // ===================Auto==search=======
        public function index($keyword)
        {  
            $data['title'] = 'Advance search | KreditAid';
            $this->load->view('home_e/header_b', $data, false);
            $this->load->view('home_e/Advance_search', ['keyword'=>$keyword], false);
            // $this->load->view('home_e/adv_search_b', ['keyword'=>$keyword], false);
            
            $this->load->view('home_e/footer_b', $data, false);
        }


}

