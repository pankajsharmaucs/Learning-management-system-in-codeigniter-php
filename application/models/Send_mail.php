<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Send_mail extends CI_Model {
	var $session_user;

    function __construct() {
        parent::__construct();
				  $this->load->library(array('session','Custom','email'));
    }

		public function send($id,$to,$view,$subject,$data)
    {
      $this->load->library('email');
			$from_email = "250-103-211-217-27.webhostbox.net";
			$fromName="kreditaid - Unified Credit Solution PVT LTD";
			//$data=array();
			//$data['id']=$id;
			$message = $this->load->view($view,$data,true);

			$config = Array(
							'protocol' => 'smtp',
							'smtp_host' => 'ssl://smtp.googlemail.com',
							'smtp_port' => 465,
							'smtp_user' => 'kreditaid900@gmail.com',
							'smtp_pass' => 'Rishinhr5',
							'mailtype'  => 'html',
							'charset'   => 'utf-8'
					);

			$this->email->initialize($config);
      $this->email->set_newline("\r\n");
			$this->email->from($from_email, $fromName);
			$this->email->to($to);
			$this->email->subject($subject);
			$this->email->message($message);

			if($msg=$this->email->send()){
					 return $msg;
				 }
				 $fp = fopen('mail.txt', 'w');
	 			fwrite($fp,  $this->email->print_debugger());
	 			fclose($fp);
				 return 0;
    }





}
