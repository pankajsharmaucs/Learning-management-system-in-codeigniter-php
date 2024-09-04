<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');



class Custom{


	public function __contruct($params =array())
    {

        $this->CI->config->item('base_url');
        $this->CI->load->helper('url');
        $this->CI->load->database();
        $this->CI->library('session');
        $this->CI->library('email');
        $this->CI =& get_instance();
        $this->CI =& get_instance();
       // $this->CI->load->database();
    }

    function sendEmailSmtp($subject,$body_email,$to,$attachment='',$A2Attachment='')
    {
	    $CI =& get_instance();
		$from = "account@worldplanetesolution.com";
		$config['protocol']    = 'smtp';
	    $config['smtp_host']    = 'mail.worldplanetesolution.com';
		$config['smtp_port']    = '587';
		$config['smtp_timeout'] = '7';
		$config['smtp_user']    = $from;
		$config['smtp_pass']    = 'wpes5570';
		$config['charset']    = 'utf-8';
		$config['newline']    = "\r\n";
		$config['mailtype'] = 'html'; // or html
		$config['validation'] = TRUE; // bool whether to validate email or not
		$CI->email->initialize($config);
		$CI->email->from($from,'World Planet e-solution pvt.ltd.');
		$CI->email->to($to);
		$CI->email->subject($subject);
		$CI->email->message($body_email);
		if (!empty($attachment))
		{
			$CI->email->attach($attachment);
		}
		if (!empty($A2Attachment))
		{
		    for($i=0;$i<count($A2Attachment);$i++)
			$CI->email->attach($A2Attachment[$i]);
		}
		$CI->email->send();
	//	echo $CI->email->print_debugger();
   }
   function sendEmailSmtp_web($from,$subject,$body_email,$to,$attachment='',$attachment1='',$A2Attachment='')
    {
	    $CI =& get_instance();
		$from = $from;
		$config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['charset']    = 'utf-8';
	    $config['newline']    = "\r\n";
	    $config['mailtype'] = 'html'; // or html
	    $config['validation'] = TRUE; // bool whether to validate email or not
		$CI->email->initialize($config);
		$CI->email->from($from,'World Planet e-solution pvt.ltd.');
		$CI->email->to($to);
		$CI->email->subject($subject);
		$CI->email->message($body_email);
		if (!empty($attachment))
		{
			$CI->email->attach($attachment);
		}
		if (!empty($attachment1))
		{
			$CI->email->attach($attachment1);
		}
		if (!empty($A2Attachment))
		{
		    for($i=0;$i<count($A2Attachment);$i++)
			$CI->email->attach($A2Attachment[$i]);
		}
		$CI->email->send();
			// echo $CI->email->print_debugger();
   }



}

?>
