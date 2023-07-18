<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Library to add cart/ add wish list
 */
class Email_cilib {

	protected $order_datetime;

	public function __construct()
	{
		// Assign the CodeIgniter super-object
		$this->CI =& get_instance();
		$this->CI->load->model('admin/Custom_model','custom_model');
		$this->CI->load->library('email');
		date_default_timezone_set('Asia/Kolkata');
		$this->order_datetime = date('Y-m-d H:i:s');
	}

	function send_email_ci($emails,$subject,$message,$includes = true,$attached_file='')
	{
		if(!empty($message)){
			if($includes){
				$header = email_header();
				$footer = email_footer();
				$message = $header.$message.$footer;
			}
		}
		// echo $emails;
		// echo $subject;
		// echo $message;
		// die;			
		
		// $emails.=',info@port10.sa';	this for css	
		$this->CI->email->from('info@port10.sa',"Port10");
		$this->CI->email->to($emails);
		// $this->CI->email->cc('info@port10.sa');
		// $this->email->bcc('them@their-example.com');
		$this->CI->email->subject($subject);
		$this->CI->email->message($message);
		if(!empty($attached_file))
		{
			// 'http://example.com/filename.pdf'
			$this->CI->email->attach($attached_file);
		}

		$this->CI->email->send();
	}

	function send_welcome($emails,$subject,$message,$includes = true,$attached_file='')
	{
		
		// echo $emails;
		// echo $subject;
		// echo $message;
		// die;			
		
		// $emails.=',info@port10.sa';	this for css	
		$this->CI->email->from('info@port10.sa',"Port10");
		$this->CI->email->to($emails);
		// $this->CI->email->cc('info@port10.sa');
		// $this->email->bcc('them@their-example.com');
		$this->CI->email->subject($subject);
		$this->CI->email->message($message);
		if(!empty($attached_file))
		{
			// 'http://example.com/filename.pdf'
			$this->CI->email->attach($attached_file);
		}

		$this->CI->email->send();
	}

	function test_email()
	{
		$message="test email message";
		$subject="Test Subject ";
		// echo "121212";
		// die;

		if(!empty($message))
		{			
				$header = email_header();
				$footer = email_footer();
				$message = $header.$message.$footer;
			
		}
		$emails="quamer313@gmail.com";
		$emails.=',quamer123@gmail.com';
		// echo $emails;
		// die;
		$this->CI->email->from('INFO@BRANDSBOUTIQUE-SA.COM',"Brands Boutique");
		$this->CI->email->to($emails);
		// $this->CI->email->to("quamer123@gmail.com");
		// $this->CI->email->cc('info@port10.sa');
		// $this->email->bcc('them@their-example.com');
		$this->CI->email->subject($subject);
		$this->CI->email->message($message);
		$this->CI->email->send();
	}


	
}
