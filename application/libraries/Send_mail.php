<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Library to Send mail
**/
class Send_mail {

	protected $order_datetime;

	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->model('admin/Custom_model','custom_model');
		date_default_timezone_set('Asia/Kolkata');
		$this->order_datetime = date('Y-m-d H:i:s');
		$this->CI->load->library('email_cilib');
	}

	public function send_register_succ_msg($user_id = '')
  	{
  		if (!empty($user_id))
  		{
			$data = $this->CI->custom_model->my_where('admin_users','*',array('id' => $user_id));

			$emails = $data[0]['email'];
			// $emails = 'girishbhumkar5@gmail.com';

				$subject = "Registration Confirmation";
				$message = '<!DOCTYPE html>
							<html>
							<head>
							<title> Welcome to ADZ </title>
							</head>
							<body style="text-align: center; font-family: auto; " >

								<style type="text/css">
									.footer_socal a img{
										filter: grayscale(100%);
									}

									.footer_socal a img:hover{
										filter: grayscale(0%);
									}
								</style>

								<div style="display: inline-block; border:0px solid red; width: 70%; margin-top: 15px; ">
									<img src="'.base_url().'/assets/frontend/black_logo.png" style="float: left; width: 80px; " >
									<img src="'.base_url().'/assets/frontend/logo1.png" style="float: right; width:240px; margin-top: 12px; " >

									<div style="clear: both;"></div>

									<div style="font-weight: 600; font-size: 26px; margin-top: 32px; border-top: 1px solid #adadad; border-bottom: 1px solid #adadad; padding:25px 0px; color:#222; ">
										Welcome to ADZ
									</div>

									<div style="padding:0px 5px;" >
										<span style="display: inline-block; margin-top: 20px; font-size: 18px; line-height: 26px; color:#444; " >
										Thank you for creating an account. You’re one step closer to enjoying hundreds of fantastic 2 for 1 offers in Food and Drink, Leisure and Attractions and Health and Beauty. All our offers are available to view on our website www.mi2por1.com <br><br>
										</span>

										<span style="font-size: 18px; text-align: left; display: inline-block; line-height: 23px;  " >
										The ADZ app offers incredible value, for only €25 you will have access to offers which have the potential to save you thousands during your 1 year membership. Or equally, if you are not in the area for 1 year, our app is just as beneficial for holiday makers, we guarantee the app can pay for itself in the first few uses, some vouchers alone will save you more than the €25 membership fee. <br><br>

										The app is incredibly simple to use, with our handy map feature you can easily locate offers, or filter by location, offer type etc. We have a wide range of places to suit everyone, from famous names to some hidden gems. Create a profile, track your savings, and enjoy discovering new places.<br><br>

										</span> 

										<span style="font-size: 14px; color: #333; " >
										You can make your payment directly through the app or via our website and gain instant access to the vouchers. <br><br>
										</span>

										<span style="font-size: 19px; color:#444; " >
										Start saving today.
										</span>

										<div style="margin-top: 25px; border-top:1px solid #adadad; " class="footer_socal" >
											<a style="display: inline-block;" href="https://www.instagram.com/" target="_blank" > <img src="'.base_url().'/assets/frontend/insta.png" style="width: 22px!important; margin-bottom: 40px; margin-top: 25px; margin-left: 7px; margin-right: 7px; " > </a>
											<a style="display: inline-block;" href="https://www.facebook.com" target="_blank" > <img src="'.base_url().'/assets/frontend/facebook.png" style="width: 22px!important; margin-bottom: 40px; margin-top: 25px; margin-left: 7px; margin-right: 7px; " > </a>
											<a style="display: inline-block;" href="https://twitter.com" target="_blank" > <img src="'.base_url().'/assets/frontend/twitter.png" style="width: 22px!important; margin-bottom: 40px; margin-top: 25px; margin-left: 7px; margin-right: 7px; " > </a>
											<a style="display: inline-block;" href="https://www.youtube.com/" target="_blank" > <img src="'.base_url().'/assets/frontend/youtube.png" style="width: 22px!important; margin-bottom: 40px; margin-top: 25px; margin-left: 7px; margin-right: 7px; " > </a>
										</div>
									</div>
								</div>
							</body>
							</html>
			';
			 
			// echo $emails;
			// echo $subject;
			// echo $message;
			// die;

			
			$this->CI->email_cilib->send_email_ci($emails,$subject,$message);
  		}
  	}  	

  	public function email_backend_to_user($user_id,$subject,$message_dynamic)
  	{
  		// echo $subject;
  		// die;
  		// <div style="clear: both;"></div> below this one
  		// <div style="font-weight: 600; font-size: 26px; margin-top: 32px; border-top: 1px solid #adadad; border-bottom: 1px solid #adadad; padding:25px 0px; color:#222; ">'.$subject.'</div>
  		if (!empty($user_id))
  		{
			$data = $this->CI->custom_model->my_where('admin_users','id,email',array('id' => $user_id));

			$emails = $data[0]['email'];
			// $emails = 'girishbhumkar5@gmail.com';
			// $language = $data[0]['language'];
			// $language = 'es';

			
			$message = '<!DOCTYPE html>
							<html>
							<head>
							<title> Welcome to mi 2 por 1 </title>
							</head>
							<body style="text-align: center; font-family: auto; " >

								<style type="text/css">
									.footer_socal a img{
										filter: grayscale(100%);
									}

									.footer_socal a img:hover{
										filter: grayscale(0%);
									}
								</style>

								<div style="display: inline-block; border:0px solid red; width: 100%; margin-top: 15px; ">
									

									<div style="clear: both;"></div>

									

									<div style="padding:0px 5px; text-align: justify;display: inline-block; margin-top: 20px; font-size: 18px; line-height: 26px; color:#444; margin-bottom: 20px; " >										
										'.$message_dynamic.'

										<div style="clear: both;"></div>

										<div style="width: 100%; text-align: center; margin-top: 25px; border-top:1px solid #adadad; " class="footer_socal" >
											<a style="display: inline-block;" href="https://www.instagram.com/" target="_blank" > <img src="'.base_url().'/assets/frontend/images/insta.png" style="width: 22px!important; margin-bottom: 40px; margin-top: 25px; margin-left: 7px; margin-right: 7px; " > </a>								
											<a style="display: inline-block;" href="https://twitter.com" target="_blank" > <img src="'.base_url().'/assets/frontend/images/twitter.png" style="width: 22px!important; margin-bottom: 40px; margin-top: 25px; margin-left: 7px; margin-right: 7px; " > </a>			
										</div>

									</div>

								</div>


							</body>
							</html>

							';			
			// echo "<pre>";
			// print_r($row9);
			// die;

			
			 
			// echo $emails;
			// echo $subject;
			// echo $message;
			// die;

			// send_email_using_postmark($emails,$subject,$message);
			$this->CI->email_cilib->send_email_ci($emails,$subject,$message);
  		}
  	}

}
