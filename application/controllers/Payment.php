<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Ajax
 */
class Payment extends MY_Controller {

	public function __construct()
	{
		$this->load->model('admin/Custom_model','custom_model');
		
	}

	public function index()
	{	
		// 121212
		$post_data=$this->input->post();
		$uid = $this->session->userdata('uid');
		$type = $this->session->userdata('type');
		if(!empty($post_data))
		{
			if (empty($uid)|| empty($type))
			{			
				echo json_encode(array("status"=>false,"message"=>"Something went wrong","error_type"=>"login")); die;
			}else if($type=="buyer")
			{			
				echo json_encode(array('status'=>false,"message"=>"Buyer not allowed here  ",'error_type'=>"not_allowed")); die;
			}else if($type=="suppler")
			{
				$tax_table = $this->custom_model->my_where('tax','*',array());				
				$s_id=en_de_crypt($post_data['id'],'d');					
				// $dealer_data = $this->custom_model->my_where('admin_users','id',array('id'=>$uid,'type'=>'suppler'));	
				$subs_plans = $this->custom_model->my_where('subs_plans','*',array('id'=>$s_id));
				if(!empty($subs_plans))
				{
					$this->load->library('enc_dec_lib');	
					$currency=$this->return_currency_name();
					$post=array();
					$track_id=date('YmdHis').$uid;
					$payment_insert['track_id']=$track_id;
					$payment_insert['user_id']=$uid;
					$payment_insert['subscription_id']=$s_id;
					$payment_insert['source']='web';
					$payment_insert['created_date']=date('Y-m-d H:i:s');
					$payment_insert['currency']=$currency;
					// echo "<pre>";
					// print_r($payment_insert);
					// die;
					$this->custom_model->my_insert($payment_insert,'transaction_details');

					if($currency=="USD")
					{
						$post['currency_code']=840;	
						$post['amount']=$subs_plans[0]['amount']/$tax_table[0]['sar_rate'];	
					}else{
						$post['currency_code']=682; 
						$post['amount']=$subs_plans[0]['amount'];
					}

					// if($currency=="SAR")
					// {
					// 	$post['currency_code']=682;	
					// 	$post['amount']=$subs_plans[0]['amount']*$tax_table[0]['sar_rate'];	
					// }else{
					// 	$post['currency_code']=840;
					// 	$post['amount']=$subs_plans[0]['amount'];
					// }
					$post['payment_password']=$this->payment_password;				
					$post['payment_id']=$this->payment_id;				
					$post['track_id']=$track_id;				
									
					$post['response_url']=base_url('payment/response');				
					$post['erro_url']=base_url('payment/error');								
					$plan_text=$this->enc_dec_lib->get_json_code($post);
					$trandata=$this->enc_dec_lib->encryptAES($plan_text,$this->payment_key);
					$post=array();
					$post['id']=$this->payment_id;				
					$post['trandata']=$trandata;				
					$post['responseURL']=base_url('payment/response');;				
					$post['errorURL']=base_url('payment/error');				
					$response=$this->enc_dec_lib->get_payment_url($post,$uid,$track_id);
					// echo "<pre>";
					// print_r($response);
					// die;
					echo json_encode($response); die;
				}else{
					echo json_encode(array('status'=>false,"message"=>"Invalid plan selected",'error_type'=>"")); die;
				}				
			}else{
				echo json_encode(array('status'=>false,"message"=>"Something wnet wrong",'error_type'=>"")); die;
			}			
		}else{
			echo json_encode(array("status"=>false,"message"=>"Something wnet wrong","error_type"=>"")); die;
		}			
	}

	public function response()
	{
		$post_data=$this->input->post();	
		if(!empty($post_data))
		{
			$this->load->library('enc_dec_lib');
			if(isset($post_data['paymentid']) && isset($post_data['trackid']) && isset($post_data['trandata']) )
			{
				$response=$this->enc_dec_lib->decryptData($post_data['trandata'],$this->payment_key);
				$response=json_decode($response,true);
				$trackId=$response[0]['trackId'];
				$paymentId=$response[0]['paymentId'];
				// $is_transaction = $this->custom_model->my_where('transaction_details','id,user_id,payment_status,subscription_id',array('track_id' =>$response[0]['trackId'],'paymentId' => $response[0]['paymentId']));
				$is_transaction = $this->custom_model->get_data_array("SELECT tran.id,tran.user_id,tran.payment_status,tran.subscription_id,admin.subs_end_date FROM transaction_details as tran INNER JOIN admin_users as admin ON tran.user_id=admin.id WHERE  tran.track_id='$trackId' AND tran.paymentId='$paymentId' ");
				if(!empty($is_transaction))
				{
					$update_data=array();
					if(isset($response[0]['error']) && !empty($response[0]['error']))
					{
						$update_data['error']=$response[0]['error'];
						$update_data['errorText']=$response[0]['errorText'];
						$update_data['payment_status']='Unpaid';
					}else{
						if($response[0]['result']=='CAPTURED')
						{
							$subs_plans = $this->custom_model->my_where('subs_plans','*',array('id'=>$is_transaction[0]['subscription_id']));
							$duration=$subs_plans[0]['duration'];

							$old_end_date=strtotime($is_transaction[0]['subs_end_date']);
							$current_data=strtotime(date("Y-m-d"));

							if($old_end_date>$current_data)
							{
								$subs_start_date = date("Y-m-d",$old_end_date);
								$subs_end_date = date("Y-m-d", strtotime("+$duration year", $old_end_date));
							}else{
								$subs_start_date=date("Y-m-d");
								$subs_end_date = date("Y-m-d", strtotime($subs_start_date. "+$duration year"));
							}
							// $subs_start_date=date("Y-m-d");
					 		// 	$subs_end_date = date("Y-m-d", strtotime($subs_start_date. "+$duration year"));
					 		$update_data['subs_start_date']=$subs_start_date;
					 		$update_data['subs_end_date']=$subs_end_date;
							$update_data['payment_status']="Paid";

							$user_data['subs_start_date']=$subs_start_date;
			 				$user_data['subs_end_date']=$subs_end_date;
			 				$user_data['subs_status']='active';
			 				if($is_transaction[0]['payment_status']=='')
							{
								// update only first time							
			 					$this->custom_model->my_update($user_data,array('id'=>$is_transaction[0]['user_id']),'admin_users');
			 				}
						}else{
							$update_data['payment_status']="Unpaid";
						}
						$update_data['transId']=$response[0]['transId'];
						$update_data['amount']=$response[0]['amt'];

					}
					if(isset($response[0]['authCode']))
					{
						$update_data['authCode']=$response[0]['authCode'];
					}
					if(isset($response[0]['authRespCode']))
					{						
						$update_data['authRespCode']=$response[0]['authRespCode'];
					}
					if(isset($response[0]['cardType']))
					{						
						$update_data['cardType']=strtolower($response[0]['cardType']);
					}
					if($is_transaction[0]['payment_status']=='')
					{
						// update only first time
						$this->custom_model->my_update($update_data,array('track_id' =>$response[0]['trackId'],'paymentId' => $response[0]['paymentId']),'transaction_details');
					}
					$this->set_userdata($is_transaction[0]['user_id']);
					if(isset($response[0]['error']) && !empty($response[0]['error']))
					{	
						$this->mViewData['errorText'] = $response[0]['errorText'];
						$this->mViewData['paymentId'] = $response[0]['paymentId'];
						$this->Urender('payment/cancel', 'udefault');

					}else{		
						if($response[0]['result']=='CAPTURED')
						{
							$this->mViewData['trans_id'] = $response[0]['transId'];
							$this->mViewData['amount'] =$response[0]['amt'];			 	
						 	$this->mViewData['subs_start_date'] =$subs_start_date;			 	
						 	$this->mViewData['subs_end_date'] = $subs_end_date;
							$this->Urender('payment/thank_you', 'udefault');
						}else{
							$this->mViewData['trans_id'] = $response[0]['transId'];
							if(isset($response[0]['authRespCode']))
							{								
								$payment_msg=$this->custom_model->my_where('payment_code_msg','message',array('code' => $response[0]['authRespCode'],'card_type'=>strtolower($response[0]['cardType']) ));
								if(!empty($payment_msg))
								{
									$this->mViewData['errorText']=$payment_msg[0]['message'];
								}
							}
							$this->Urender('payment/cancel', 'udefault');
						}					
					}
					// echo "<pre>";		
					// print_r($post_data);
					// print_r($response);

				}else{
					echo json_encode(array("status"=>false,"message"=>"Invalid transaction id")); die;
				}
			}else{
				echo json_encode(array("status"=>false,"message"=>"Something went wrong")); die;
			}
		}else{
			echo json_encode(array("status"=>false,"message"=>"Something went wrong")); die;
		}	
	}

	public function error()
	{
		$post_data=$this->input->post();
		$get_data=$this->input->get();
		echo "<pre>";
		print_r($get_data);
		print_r($post_data);
	}

	public function ecom_response()
	{
		$post_data=$this->input->post();	
		$language = $this->uri->segments[1];
		// echo "<pre>";
		// print_r($post_data);
		// die;
		if(!empty($post_data))
		{
			$this->load->library('enc_dec_lib');
			// $response=$this->enc_dec_lib->decryptData($post_data['trandata'],$this->payment_key);
			// $response=json_decode($response,true);
			// echo "<pre>";
			// print_r($response);
			// exit();
			// if(isset($post_data['paymentid']) && isset($post_data['track_id']) && isset($post_data['trandata']) )
			if(isset($post_data['paymentid']) && isset($post_data['trandata']) )
			{
				$response=$this->enc_dec_lib->decryptData($post_data['trandata'],$this->payment_key);
				$response=json_decode($response,true);
				echo '<pre>';
				print_r($response);
				// die;
				$is_transaction = $this->custom_model->my_where('payment_details','id,user_id,payment_status,display_order_id,user_id',array('track_id' =>$response[0]['trackId'],'paymentId' => $response[0]['paymentId']));
				// echo '<pre>';
				// print_r($is_transaction);
				// die;
				if(!empty($is_transaction))
				{
					$update_data=array();
					if(isset($response[0]['error']) && !empty($response[0]['error']))
					{
						$update_data['error']=$response[0]['error'];
						$update_data['errorText']=$response[0]['errorText'];
						$update_data['payment_status']='Unpaid';
						$this->custom_model->my_update(array('payment_status'=>"Unpaid"),array('display_order_id' =>$is_transaction[0]['display_order_id']),'order_master');
					}else{	
						if($response[0]['result']=='CAPTURED')
						{
							$update_data['payment_status']="Paid";
							$this->custom_model->my_update(array('payment_status'=>"Paid",'is_show'=>'1'),array('display_order_id' =>$is_transaction[0]['display_order_id']),'order_master');							
							$this->custom_model->my_update(array('payment_status'=>"Paid",'is_show'=>'1'),array('display_order_id' =>$is_transaction[0]['display_order_id']),'order_invoice');							
						}else{
							$update_data['payment_status']="Unpaid";
							$this->custom_model->my_update(array('payment_status'=>"Unpaid",'is_show'=>'1'),array('display_order_id' =>$is_transaction[0]['display_order_id']),'order_master');	
							
							$this->custom_model->my_update(array('payment_status'=>"Unpaid",'is_show'=>'1'),array('display_order_id' =>$is_transaction[0]['display_order_id']),'order_invoice');	
						}			 		
						$update_data['transId']=$response[0]['transId'];
						$update_data['amount']=$response[0]['amt'];
					}
					if(isset($response[0]['authCode']))
					{
						$update_data['authCode']=$response[0]['authCode'];
					}
					if(isset($response[0]['authRespCode']))
					{						
						$update_data['authRespCode']=$response[0]['authRespCode'];
					}
					if(isset($response[0]['cardType']))
					{						
						$update_data['cardType']=strtolower($response[0]['cardType']);
					}
					if($is_transaction[0]['payment_status']=='')
					{
						$this->custom_model->my_update($update_data,array('track_id' =>$response[0]['trackId'],'paymentId' => $response[0]['paymentId']),'payment_details');
					}
					if(isset($response[0]['error']) && !empty($response[0]['error']))
					{	
						$this->set_userdata($is_transaction[0]['user_id']);
						redirect('en/home/thankyou/'.en_de_crypt($is_transaction[0]['display_order_id']));	
						// $this->mViewData['errorText'] = $response[0]['errorText'];
						// $this->mViewData['paymentId'] = $response[0]['paymentId'];
						// $this->Urender('payment/ecom_cancel', 'udefault');

					}else{
						// $this->mViewData['trans_id'] = $response[0]['transId'];
						// $this->mViewData['amount'] =$response[0]['amt'];
						$this->set_userdata($is_transaction[0]['user_id']);
						$this->load->library("email_send");
						if($language=='en')
						{
							$this->email_send->send_invoice_new_en($is_transaction[0]['display_order_id']);			
						}else{
							$this->email_send->send_invoice_new_ar($is_transaction[0]['display_order_id']);
						}
						// $this->email_send->send_invoice($is_transaction[0]['display_order_id']);	
						// $language.
						redirect('en/home/thankyou/'.en_de_crypt($is_transaction[0]['display_order_id']));		 			 	
						// $this->Urender('payment/ecom_thank_you', 'udefault');					
					}
					// echo "<pre>";		
					// print_r($post_data);
					// print_r($response);

				}else{
					echo json_encode(array("status"=>false,"message"=>"Invalid transaction id")); die;
				}
			}else{
				echo json_encode(array("status"=>false,"message"=>"Something went wrong")); die;
			}
		}else{
			echo json_encode(array("status"=>false,"message"=>"Something went wrong")); die;
		}	
	}

	public function ecom_error()
	{
		$post_data=$this->input->post();
		$get_data=$this->input->get();
		echo "<pre>";
		print_r($get_data);
		print_r($post_data);
	}

	public function set_userdata($user_id)
	{
		// when request come form payment some time it will automatically logout 
		// this funtion is used to re login
		$uid = $this->session->userdata('uid');
		if(empty($uid))
		{
			$is_user = $this->custom_model->my_where('admin_users',"id,first_name,email,phone",array('id' =>$user_id));
			if(!empty($is_user))
			{
				$data = array(
							'user_name' 	=> $is_user[0]['first_name'],
							'uid' 			=> $is_user[0]['id'],
							'email' 		=> $is_user[0]['email'],
							'phone' 		=> $is_user[0]['phone'],
							'is_logged_in'	=> true
						);
				$this->session->set_userdata($data);			
			}			
		}
	}	
}

?>

