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

class Dashboard_2 extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    // ===================Auto==search=======
    public function index()
    {    
        $data['title'] = ' User Dashboard  | KreditAid';
        $this->load->view('user_dashboard_e/user_header_b', $data, false);
        $this->load->view('user_dashboard_e/dashboard');
        $this->load->view('home_e/footer_b', $data, false);
    }
   


}

