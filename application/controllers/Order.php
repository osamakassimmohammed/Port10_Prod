<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home page
 */
class Order extends MY_Controller {

	public function __construct()
	{
		$this->load->model('User_model');
		$this->load->model('admin/Custom_model','custom_model');	
		$uid = $this->session->userdata('uid');
		$language = $this->uri->segments[1];
		if(empty($uid))
		{
			if($language=='en')
			{
				$this->session->set_flashdata('login_message', 'Please Login Or Create Account!!');	
			}else{
				$this->session->set_flashdata('login_message', 'الرجاء الدخول لإنشاء حساب');	
			}		
			redirect($language);
		}	
	}
	
	public function old_reorder($item_id='')
	{	
		// this function for direct reorder
		$language = $this->uri->segments[1];

		if($language=="en")
		{
			$product = "product";			
			$unit_list = "unit_list";
		}else{
			$product = "product_trans";			
			$unit_list = "unit_list_trans";
		}
		$post_arr = $this->input->post();				
		$uid = $this->session->userdata('uid');
		$data = $this->custom_model->get_data_array("SELECT pro.id,pro.product_name,pro.product_image,pro.status,pro.stock,pro.stock_status,pro.price,pro.sale_price,pro.product_delete,items.item_id,items.quantity,items.unit FROM $product as pro INNER JOIN order_items as items ON pro.id=items.product_id WHERE items.item_id='$item_id' AND items.user_id='$uid' AND pro.product_delete=0 AND pro.status=1 ");
		if(!empty($data))
		{
			$unit_data = $this->custom_model->my_where($unit_list,'id,unit_name',array('id' => $data[0]['unit']));
			if(!empty($unit_data))
			{
				$data[0]['unit_name']=$unit_data[0]['unit_name'];
			}
		}
		$this->load->library('user_account');
		$data_res = $this->user_account->product_check($data,$flag=false,$is_other=false,$language);		
		// $data_res=$this->product_check($data);
			
		if(!empty($post_arr) && $data_res['status']==1 )
		{
			$pid=$data_res['data'][0]['id'];
			$qty=$data_res['data'][0]['quantity'];
			$unit=$data_res['data'][0]['unit'];
			$products = array (
  				array("pid"=>$pid,"qty"=>$qty,"metadata"=>"","comment"=>"","unit"=>$unit)  
				);

			if(empty($products))
			{
				redirect($language);
			}
			$this->place_common($post_arr,$products,$language);	
						
		}else{
			// redirect($language);	
			$tax_table = $this->custom_model->my_where('tax','*',array());
			$currency=$this->return_currency_name();
		    $currency_symbol=$this->return_currency_symbol($currency,$language);

			$user_last_add = $this->custom_model->get_data_array("SELECT display_order_id,first_name,last_name,mobile_no,email,country,city,state,pincode,address_1,address_2 FROM  order_master WHERE `user_id`='$uid' order by order_master_id desc limit 0,1 ");
			if(empty($user_last_add))
			{
				$admin_users = $this->custom_model->my_where('admin_users','first_name,last_name,phone,email,city,state,postal_code,country,building_no,street_name',array('id'=>$uid));
				$this->mViewData['admin_users']= $admin_users;
			}
			$this->mViewData['data_res']= $data_res;
			// $this->mViewData['country_name']= $country_name;
			$this->mViewData['user_last_add']= $user_last_add;			
			$this->mViewData['tax_table']= $tax_table;	
			$this->mViewData['currency']= $currency;	
			$this->mViewData['currency_symbol']= $currency_symbol;	
			$this->mViewData['item_id']= $item_id;	
			// $this->mViewData['shipping_charge']= $this->return_shipping_charge($data,$currency,$tax_table);	
			$this->Urender('reorder', 'udefault');
		}
	}

	public function reorder($item_id='')
	{	
		// this function for direct reorder
		$language = $this->uri->segments[1];

		if($language=="en")
		{
			$product = "product";			
			$unit_list = "unit_list";
		}else{
			$product = "product_trans";			
			$unit_list = "unit_list_trans";
		}
		$post_arr = $this->input->post();				
		$uid = $this->session->userdata('uid');
		$data = $this->custom_model->get_data_array("SELECT pro.id,pro.product_name,pro.product_image,pro.status,pro.stock,pro.stock_status,pro.price,pro.sale_price,pro.product_delete,pro.unite,items.item_id,items.quantity,items.unit FROM $product as pro INNER JOIN order_items as items ON pro.id=items.product_id WHERE items.item_id='$item_id' AND items.user_id='$uid' AND pro.product_delete=0 AND pro.status=1 ");

		$tax_table = $this->custom_model->my_where('tax','*',array());
		$currency=$this->return_currency_name();
	    $currency_symbol=$this->return_currency_symbol($currency,$language);


		if(!empty($data))
		{
			$unit_list1 = $this->custom_model->get_data_array("SELECT id,unit_name FROM unit_list WHERE id IN (".$data[0]['unite'].") ");

			$data[0]['unit_list']=$unit_list1;
			
			// $unit_data = $this->custom_model->my_where($unit_list,'id,unit_name',array('id' => $data[0]['unit']));
			// if(!empty($unit_data))
			// {
			// 	$data[0]['unit_name']=$unit_data[0]['unit_name'];
			// }

			if($currency=='USD')
            {  
            	$single_price=$data[0]['sale_price']/$tax_table[0]['sar_rate'];
            	// $single_price=round($single_price);
              	$data[0]['sale_price']=$single_price;
            }
		}
		
			// $data_res=$this->product_check($data,$falg=false,$is_other=false);
			$this->load->library('user_account');
			$data_res = $this->user_account->product_check($data,$falg=false,$is_other=false,$language);
			
		
		// redirect($language);	
		
		
		// $unit_list_data = $this->custom_model->get_data_array("SELECT * FROM $unit_list ORDER BY unit_name ASC ");
		// $this->mViewData['unit_list_data']= $unit_list_data;
		// echo "<pre>";
		// print_r($data_res);
		// die;
		$this->mViewData['data_res']= $data_res;
		// $this->mViewData['country_name']= $country_name;				
		$this->mViewData['tax_table']= $tax_table;	
		$this->mViewData['currency']= $currency;	
		$this->mViewData['currency_symbol']= $currency_symbol;				
		// $this->mViewData['shipping_charge']= $this->return_shipping_charge($data,$currency,$tax_table);	
		$this->Urender('reorder_view_cart', 'udefault');
		
	}

	public function invoice_purchase($in_id='',$payment_option='')
	{	
		// this function for direct reorder
		$language = $this->uri->segments[1];

		if($language=="en")
		{
			$product = "product";			
			$unit_list = "unit_list";
		}else{
			$product = "product_trans";			
			$unit_list = "unit_list_trans";
		}
		$is_calculate_rate=0;
		$post_arr = $this->input->post();				
		$uid = $this->session->userdata('uid');
		$data = $this->custom_model->get_data_array("SELECT pro.id,pro.product_name,pro.product_image,pro.status,pro.stock,pro.stock_status,pro.price,pro.sale_price,pro.product_delete,pro.is_delivery_available,qoin.in_id,qoin.in_qty as quantity,qoin.in_unit,qoin.in_price,qoin.invoice_status FROM $product as pro INNER JOIN quotation_invoice as qoin ON pro.id=qoin.in_sku WHERE qoin.in_id='$in_id' AND qoin.uid='$uid' AND pro.product_delete=0 AND pro.status=1 ");
		if(!empty($data))
		{
			$unit_data = $this->custom_model->my_where($unit_list,'id,unit_name',array('id' => $data[0]['in_unit']));
			if(!empty($unit_data))
			{
				$data[0]['unit_name']=$unit_data[0]['unit_name'];
			}
		}
		
		// $data_res=$this->product_check($data,$flag=true,$is_other=true);
		$this->load->library('user_account');
		$data_res = $this->user_account->product_check($data,$flag=true,$is_other=true,$language);
		// echo "<pre>";
		// print_r($data_res);
		// die;
		if(!empty($post_arr) )
		{
			if($data_res['status']==1)
			{
				$pid=$data_res['data'][0]['id'];
				$qty=$data_res['data'][0]['quantity'];
				$unit=$data_res['data'][0]['in_unit'];
				$products = array (
	  				array("pid"=>$pid,"qty"=>$qty,"metadata"=>"","comment"=>"","unit"=>$unit)  
					);			
				$single_price=$data_res['data'][0]['in_price']/$qty;
				$post_arr['single_price']=$single_price;
				
				$this->place_common($post_arr,$products,$language);
			}else{
				echo json_encode( array("status" => false,"message" => ($language == 'ar'? 'Something went wrong':'Something went wrong'),"flag"=>"" ) );die;	
			}
						
		}else{
			$payment_option=en_de_crypt($payment_option,'d');
			if($payment_option=='cash-on-del' || $payment_option=='online' )
			{

			}else{
				$this->session->set_flashdata('common_message', 'Please Select right Payment Option');
				redirect($language.'/my_account/received_invoice_list/').$in_id;
			}
				
			// redirect($language);	
			$tax_table = $this->custom_model->my_where('tax','*',array());
			$currency=$this->return_currency_name();
		    $currency_symbol=$this->return_currency_symbol($currency,$language);

			$user_last_add = $this->custom_model->get_data_array("SELECT display_order_id,first_name,last_name,mobile_no,email,country,city,state,pincode,address_1,address_2,google_address,lat,lng FROM  order_master WHERE `user_id`='$uid' order by order_master_id desc limit 0,1 ");
			if(empty($user_last_add))
			{
				$admin_users = $this->custom_model->my_where('admin_users','first_name,last_name,phone,email,city,state,postal_code,country,building_no,street_name',array('id'=>$uid));
				$this->mViewData['admin_users']= $admin_users;
			}
			if(!empty($data_res['data']))
			{
				if($data_res['data'][0]['is_delivery_available']==0)
				{
					$is_calculate_rate=1;
				}
				$single_price=$data_res['data'][0]['in_price']/$data_res['data'][0]['quantity'];
				$data_res['data'][0]['sale_price']=$single_price;

				if($currency=='USD')
	            {  
	            	$single_price=$data_res['data'][0]['sale_price']/$tax_table[0]['sar_rate'];
	            	// $single_price=round($single_price);
	              	$data_res['data'][0]['sale_price']=$single_price;
	            }
			}
			// echo "<pre>";
			// print_r($data_res);
			// die;
			$this->mViewData['data_res']= $data_res;
			// $this->mViewData['country_name']= $country_name;
			$this->mViewData['user_last_add']= $user_last_add;			
			$this->mViewData['tax_table']= $tax_table;	
			$this->mViewData['currency']= $currency;	
			$this->mViewData['currency_symbol']= $currency_symbol;	
			$this->mViewData['in_id']= $in_id;	
			$this->mViewData['payment_option']= $payment_option;	
			$this->mViewData['is_calculate_rate']= $is_calculate_rate;	
			$this->mViewData['ajax_url']= base_url($language.'/order/invoice_purchase/').$in_id;
			$this->mViewData['flow_type']='invoice';
			// $this->mViewData['shipping_charge']= $this->return_shipping_charge($data,$currency,$tax_table);	
			$this->Urender('reorder', 'udefault');
		}
	}



	public function buynow()
	{
		$language = $this->uri->segments[1];
		$this->session->unset_userdata('products');
		if($language=="en")
		{
			$product = "product";			
			$unit_list = "unit_list";
		}else{
			$product = "product_trans";			
			$unit_list = "unit_list_trans";
		}
		$post_arr = $this->input->post();
		// echo "<pre>";
		// print_r($post_arr);
		// die;
		$uid = $this->session->userdata('uid');
		if(!empty($post_arr) && !empty($post_arr['unit']) && !empty($post_arr['quantity']) && !empty($post_arr['pid']) && !empty($post_arr['payment_mode']) )
		{
			$payment_option=en_de_crypt($post_arr['payment_mode'],'d');
			if($payment_option=='cash-on-del' || $payment_option=='online' )
			{

			}else{
				$this->session->set_flashdata('common_message', 'Please Select right Payment Option');
				redirect($language.'/order/reorder/').$post_arr['pid'];
			}
			$pid=$post_arr['pid'];
			$data = $this->custom_model->my_where($product,"id,product_name,product_image,status,stock,stock_status,price,sale_price,product_delete,is_delivery_available",array('id' => $pid,'status'=>'1','product_delete'=>0));

			if(!empty($data))
			{
				$unit_data = $this->custom_model->my_where($unit_list,'id,unit_name',array('id' => $post_arr['unit']));
				if(!empty($unit_data))
				{
					$data[0]['unit_name']=$unit_data[0]['unit_name'];
				}

				$tax_table = $this->custom_model->my_where('tax','*',array());
				$currency=$this->return_currency_name();
			    $currency_symbol=$this->return_currency_symbol($currency,$language);

				if($currency=='USD')
	            {  
	            	$single_price=$data[0]['sale_price']/$tax_table[0]['sar_rate'];
	            	// $single_price=round($single_price);
	              	$data[0]['sale_price']=$single_price;
	            }
				$data[0]['unit']=$post_arr['unit'];
				$data[0]['quantity']=$post_arr['quantity'];

				// $data_res=$this->product_check($data,$flag=false,$is_other=false);
				$this->load->library('user_account');
				$data_res = $this->user_account->product_check($data,$flag=false,$is_other=false,$language);
			
				if($data_res['status']==1 )
				{
					$is_calculate_rate=0;
					if($data[0]['is_delivery_available']==0)
					{
						$is_calculate_rate=1;
					}
					$pid=$data_res['data'][0]['id'];
					$qty=$data_res['data'][0]['quantity'];
					$unit=$data_res['data'][0]['unit'];
					$products = array (
		  				array("pid"=>$pid,"qty"=>$qty,"metadata"=>"","comment"=>"","unit"=>$unit)  
						);								
					$this->session->set_userdata('products',$products);
					// redirect($language);	
					

					$user_last_add = $this->custom_model->get_data_array("SELECT display_order_id,first_name,last_name,mobile_no,email,country,city,state,pincode,address_1,address_2,google_address,lat,lng FROM  order_master WHERE `user_id`='$uid' order by order_master_id desc limit 0,1 ");
					if(empty($user_last_add))
					{
						$admin_users = $this->custom_model->my_where('admin_users','first_name,last_name,phone,email,city,state,postal_code,country,building_no,street_name',array('id'=>$uid));
						$this->mViewData['admin_users']= $admin_users;
					}
					$this->mViewData['data_res']= $data_res;
					// $this->mViewData['country_name']= $country_name;
					$this->mViewData['user_last_add']= $user_last_add;			
					$this->mViewData['tax_table']= $tax_table;	
					$this->mViewData['currency']= $currency;	
					$this->mViewData['currency_symbol']= $currency_symbol;	
					$this->mViewData['payment_option']= $payment_option;		
					$this->mViewData['is_calculate_rate']= $is_calculate_rate;		
					$this->mViewData['ajax_url']= base_url($language.'/order/place_buynow');
					$this->mViewData['flow_type']='buynow';		
					// $this->mViewData['shipping_charge']= $this->return_shipping_charge($data,$currency,$tax_table);	
					$this->Urender('reorder', 'udefault');
				}else{
					$this->session->set_flashdata('common_message',$data_res['message']);	
					redirect($language.'/home/detail/'.$pid);		
				}
			}else{
				$this->session->set_flashdata('common_message', 'Invalid product id');	
				redirect($language.'/home/detail/'.$pid);	
			}
		}else{
			redirect($language);
		}

	}

	public function place_buynow()
	{
		$language = $this->uri->segments[1];

		if($language=="en")
		{
			$product = "product";			
			$unit_list = "unit_list";
		}else{
			$product = "product_trans";			
			$unit_list = "unit_list_trans";
		}
		$post_arr = $this->input->post();
		$uid = $this->session->userdata('uid');
		$products=$this->session->userdata('products');
		if(empty($products))
		{
			// redirect($language);
			echo json_encode( array("status" => false,"message" => ($language == 'ar'? 'Your shopping cart is empty':'Your shopping cart is empty'),"flag"=>"redirect","url"=>base_url($language.'/home/view_cart') )); die;
		}
		if(!empty($products) && !empty($post_arr) )
		{
			$this->place_common($post_arr,$products,$language);
		}else{
			// $this->session->set_flashdata('common_message', 'Something went wrong');
			// redirect($language);
			echo json_encode( array("status" => false,"message" => ($language == 'ar'? 'Something went wrong':'Something went wrong'),"flag"=>"" ) );die;	
		}		
	}

	

	public function place_common($post_arr,$products,$language)
	{
		if(isset($post_arr['first_name']) && isset($post_arr['last_name']) && isset($post_arr['payment_mode']) && isset($post_arr['mobile_no']) && isset($post_arr['email']) && isset($post_arr['address_1']) && isset($post_arr['country']) && isset($post_arr['city']) && isset($post_arr['state']) && isset($post_arr['pincode']) && isset($post_arr['google_address']) && isset($post_arr['lat']) && isset($post_arr['lng'])  )
			{
				$send_data=array();
				$send_data['first_name']=trim($post_arr['first_name']);
				$send_data['last_name']=trim($post_arr['last_name']);
				$send_data['payment_mode']=trim($post_arr['payment_mode']);
				$send_data['mobile_no']=trim($post_arr['mobile_no']);
				$send_data['email']=trim($post_arr['email']);
				$send_data['address_1']=trim($post_arr['address_1']);
				$send_data['country']=trim($post_arr['country']);
				$send_data['city']=trim($post_arr['city']);
				$send_data['state']=trim($post_arr['state']);
				$send_data['pincode']=trim($post_arr['pincode']);
				$send_data['google_address']=trim($post_arr['google_address']);
				$send_data['lat']=trim($post_arr['lat']);
				$send_data['lng']=trim($post_arr['lng']);

				if(!empty($send_data['first_name']) && !empty($send_data['last_name']) && !empty($send_data['payment_mode']) && !empty($send_data['mobile_no']) && !empty($send_data['email']) && !empty($send_data['address_1']) && !empty($send_data['country']) && !empty($send_data['city']) && !empty($send_data['state']) && !empty($send_data['pincode']) && !empty($send_data['pincode']) )
				{
					if(isset($post_arr['single_price']))
					{
						$send_data['single_price']=	$post_arr['single_price'];
					}
						
					$shipping_charge=0;
					
					$this->load->library('shipping_lib');
					$rate_info=$this->shipping_lib->get_shipping_rate($products,$send_data);

					if($rate_info['status']==true)
					{
						if($rate_info['is_single_pro_error']==true)
						{
							$html_tag='';
							if(!empty($rate_info['data']))
							{
								foreach ($rate_info['data'] as $ri_key => $ri_val) 
								{
									if($ri_val['error']==1)
									{
										$html_tag.='<p>'.$ri_val['error_message'].'</p>';
									}
								}
							}else{
								echo json_encode( array("status" => false,"message" =>"Something Went Wrong" ,"flag"=>"" )); die;
							}
						 echo json_encode( array("status" => false,"message" =>$html_tag ,"flag"=>"shipping_erro" )); die;	
						}else{
							foreach ($rate_info['data'] as $ri_key => $ri_val) 
							{
								if($ri_val['error']==0)
								{
									$products[$ri_key]['shipping_cost']=$ri_val['amount'];
								}
							}	
							$shipping_charge=$rate_info['TotalAmount'];
						}
					}else{
						echo json_encode( array("status" => false,"message" =>$rate_info['message'] ,"flag"=>"" )); die;
					}

					$send_data['shipping_charge']=$shipping_charge;
					$uid = $this->session->userdata('uid');
					

					$tax_table = $this->custom_model->my_where('tax','*',array('id'=>'1'));		
					$currency=$this->return_currency_name();
			    	$currency_symbol=$this->return_currency_symbol($currency,$language);
					

					$this->load->library('place_order');
					$response = $this->place_order->create_order($send_data, $products, $uid, 'website',$currency,$tax_table);	
					$this->session->unset_userdata('products');

					if (!empty($response))
					{				
						$uid = $this->session->userdata('uid');			

						if($post_arr['payment_mode'] == 'online')
						{
							
							$track_id=$response['display_order_id'];
							$payment_insert['track_id']=$track_id;
							$payment_insert['display_order_id']=$response['display_order_id'];
							$payment_insert['user_id']=$uid;					
							$payment_insert['source']='web';
							$payment_insert['created_date']=date('Y-m-d H:i:s');
							$payment_insert['currency']=$currency;
							$this->custom_model->my_insert($payment_insert,'payment_details');

							if($currency=="SAR")
							{
								$post['currency_code']=682;	
								$post['amount']=$response['net_total'];
								// $post['amount']=$subs_plans[0]['amount']*$tax_table[0]['sar_rate'];	
							}else{
								$post['currency_code']=840;
								$post['amount']=$response['net_total'];
							}
							$post['payment_password']=$this->payment_password;				
							$post['payment_id']=$this->payment_id;				
							$post['track_id']=$track_id;
							$this->load->library('enc_dec_lib');

							$post['response_url']=base_url($language.'/payment/ecom_response');				
							$post['erro_url']=base_url($language.'/payment/ecom_error');								
							$plan_text=$this->enc_dec_lib->get_json_code($post);
							$trandata=$this->enc_dec_lib->encryptAES($plan_text,$this->payment_key);

							$post=array();
							$post['id']=$this->payment_id;				
							$post['trandata']=$trandata;				
							$post['responseURL']=base_url($language.'/payment/ecom_response');;				
							$post['errorURL']=base_url($language.'/payment/ecom_error');				
							$pay_response=$this->enc_dec_lib->get_payment_url($post,$uid,$track_id,$payment_type='ecom');
							if($pay_response['status']==true)
							{						
								// $return_url = base_url($language).'/fort_pay/index/'.$display_order_id;	
								// redirect($pay_response['message']);
								echo json_encode( array("status" => true,"message" => ($language == 'ar'? '':''),"flag"=>"redirect","url"=>$pay_response['message'] ) );die;
							}else{
								// redirect($language.'/home/thankyou/'.en_de_crypt($response['display_order_id']));
								echo json_encode( array("status" => true,"message" => ($language == 'ar'? '':''),"flag"=>"redirect","url"=>base_url($language.'/home/thankyou/'.en_de_crypt($response['display_order_id'])) ) );die;						
							}
						}
						else
						{	
							$this->load->library("email_send");
							if($language=='en')
							{
								$this->email_send->send_invoice_new_en($response['display_order_id']);			
							}else{
								$this->email_send->send_invoice_new_ar($response['display_order_id']);
							}
							echo json_encode( array("status" => true,"message" => ($language == 'ar'? 'Order Place Successfully':'Order Place Successfully'),"flag"=>"redirect","url"=>base_url($language.'/home/thankyou/'.en_de_crypt($response['display_order_id']) ) ));die;		
							// redirect($language.'/home/thankyou/'.en_de_crypt($response['display_order_id']));
						}
					}
					else
					{
						// redirect($language.'/home');
						echo json_encode( array("status" => false,"message" => ($language == 'ar'? 'Something went wrong':'Something went wrong'),"flag"=>"" ) );die;
					}
				}else{
					echo json_encode( array("status" => false,"message" => ($language == 'ar'? 'All Field Required':'All Field Required'),"flag"=>"" ) );die;
				}
			}else{				
				echo json_encode( array("status" => false,"message" => ($language == 'ar'? 'All Field Required':'All Field Required'),"flag"=>"" ) );die;
			}	
	}
}	