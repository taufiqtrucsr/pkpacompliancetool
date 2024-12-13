<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CronController extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('DonorModel');
	}
	
	public function send_email(){
		$config = array(
            'protocol' => 'mail', // 'mail', 'sendmail', or 'smtp'
            'smtp_host' => 'trucsr.in',
            'smtp_port' => 587,
            'smtp_user' => 'trucsljv',
            'smtp_pass' => 'W7#4#9L1u1*2VrEj',
            'mailtype' => 'html', //plaintext 'text' mails or 'html'
            // 'smtp_crypto' => 'ssl', //can be 'ssl' or 'tls' for example
            // 'smtp_timeout' => '7', //in seconds
            // 'charset' => 'utf-8',
            //'validation' => TRUE,
            // 'wordwrap' => TRUE
            );

        // $config['mailtype'] = 'html';
        // $this->email->initialize($config);
		$this->load->library('email');
		//echo "<pre>";print_r($this->email);echo "</pre>";
		$this->email->set_newline("\r\n");
		$this->email->from("hemang@bcod.co.in"); // change it to yours
		$this->email->to("deepak@bcod.co.in");// change it to yours
		$this->email->subject("Test Email is working or not");
		$this->email->message("Testing email is going through or notmmmmmmmmmmmmmmmmmmmmmmm");
		echo "<pre>";print_r($this->email);echo "</pre>";
		if($this->email->send()){
			echo "email send";
		}else{
			
			echo "email not send";
		}
	}


	
}
	