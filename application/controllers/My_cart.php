<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * My_cart page
 */
class My_cart extends MY_Controller {

	public function __construct()
	{
		$this->load->model('default_model');
		$this->load->model('admin/Custom_model','custom_model');		
	}

	public function not_found()
	{
		$this->Urender('404','udefault');
	}

	public function add_to_cart()
	{
		$uid = $this->session->userdata('uid');
		$pid = $this->input->post('pid');
		$qty = $this->input->post('qty');
		$unit = $this->input->post('unit');
		$metadata = @$this->input->post('metadata');
		$pcxdata_arr = @$this->input->post('pcxdata');				
		$type='add';		
		// echo $qty;
		// echo "<br>".$qty;
		// echo "<pre>";
		// print_r($metadata);
		// print_r($pcxdata_arr);
		// die;
		if(empty($uid))
		{
			echo json_encode(array('status'=>false,'message'=>'login_message'));
			die;
		}
		$country=$this->return_currency_name();	

		$this->load->library('user_account');	

		$response = $this->user_account->add_remove_cart($pid,$uid,$type,$qty,$metadata,$pcxdata_arr,$append='',$unit,$country);
		
		$response=json_decode($response,true);
		if($response['status']==1 && is_array($response['message']))
		{			
			$this->session->set_userdata('content', serialize($response['message']));
			$response['message']='success';
		}
		echo json_encode($response);
		die;		
	}

	public function updat_cart()
	{
		$uid = $this->session->userdata('uid');
		$pid = $this->input->post('pid');
		$qty = $this->input->post('qty');
		$append = $this->input->post('append');
		$unit = @$this->input->post('unit');
		$type = 'update';
		$pcxdata='';
		$metadata='';
		
		// $new_arr=explode("m",$append);
		// echo "<pre>";
		// print_r($new_arr);
		// echo end($new_arr);
		// echo "<br>";
		// echo $return_key=array_search(end($new_arr), $new_arr);

		// echo "<br>";
		// unset($new_arr[$return_key]);
		// print_r($new_arr);
		// echo "<pre>";
		// echo $pid.'<br>';
		// echo $qty.'<br>';
		// echo $append.'<br>';
		// echo $unit.'<br>';
		// die;
		$this->load->library('user_account');
		$response = $this->user_account->add_remove_cart($pid,$uid,$type,$qty,$metadata,$pcxdata,$append,$unit);
		$response=json_decode($response,true);		
		if($response['status']==true)
		{
			$response['cart_sub_total']=$this->return_cart_price();	
		}
		$response=json_encode($response);
		echo $response;		
	}

	public function add_to_wish_list($echo=true)
	{
		$pid = $this->input->post('pid');
		$is_wish = $this->input->post('is_wish');
		$uid = $this->session->userdata('uid');
		if(!empty($pid))
		{
			$append='m'.$pid;
		}
		if (empty($uid))
		{
			if ($echo)
			{
				echo "0";
			}
			// echo 0;
			die;
		}

		if (!empty($uid))
		{
			$is_data = $this->custom_model->my_where('my_cart','*',array('user_id' => $uid,'meta_key' => 'wish_list'));
			if(empty($is_wish))
			{
				$date=date('Y-m-d');

				if(!empty($is_data) )
				{
					
					$wish_list=unserialize($is_data[0]['content']);
					$cnt[$append] = array('pid' => $pid, 'add_date' => $date);

					if(!empty($wish_list))
					{						
	            		$cnt=array_merge($wish_list,$cnt);							
					}
					// echo "<pre>";
					// print_r($cnt);
					// die;
            		$this->custom_model->my_update(array('content' => serialize($cnt)),array('id' => $is_data[0]['id']),'my_cart',true,true);
					
				}else{
					$cnt[$append] = array('pid' => $pid, 'add_date' => $date);
					$data['user_id'] = $uid;
					$data['meta_key'] = 'wish_list';
					$data['content'] = serialize($cnt);
					$this->custom_model->my_insert($data,'my_cart');
				}				
			}else{
				$wish_list=unserialize($is_data[0]['content']);
				// $my_wish = array_diff($wish_list, array($pid));
				if (array_key_exists($append, $wish_list))
				{
					unset($wish_list[$append]);
					$wish_list = array_filter($wish_list);	
					$this->custom_model->my_update(array('content' => serialize($wish_list)),array('id' => $is_data[0]['id']),'my_cart',true,true);				
				}	
			}
		}		
		if ($echo)
		{
			echo "1";
		}
		// die;
	}

	public function add_to_compere()
	{
		$language= $this->uri->segment(1);
		$post_data = $this->input->post();

		if(!empty($post_data))
		{
			if(isset($post_data['pid']) && isset($post_data['type']) )
			{
				$pid = $post_data['pid'];
				$type = $post_data['type'];
				$uid = $this->session->userdata('uid');
				if(!empty($pid))
				{
					$append='m'.$pid;
				}
				
				if (!empty($uid))
				{
					$is_data = $this->custom_model->my_where('my_cart','*',array('user_id' => $uid,'meta_key' => 'compare'));
					
					if(!empty($is_data) && !empty($is_data[0]['content']))
					{
						$cnt=unserialize($is_data[0]['content']);
						if(!empty($cnt))
						{
							$this->session->set_userdata('compare',serialize($cnt));
						}
					}
				}

				if (!empty($this->session->userdata('compare')) )
				{			
					$compare = unserialize($this->session->userdata('compare'));
					
					if (!empty($compare)) 
					{
						// $compare=unserialize($is_data[0]['content']);
						if($type=='add')
						{
							$cnt[$append] = array('pid' => $pid);												
		            		$cnt=array_merge($compare,$cnt);
							if(count($cnt)>3)
							{
								echo json_encode( array("status" => false, "message" => ($language == 'ar'? "You can't add more than 3":"You can't add more than 3") ) );die;	
							}
							$compare_count=count($cnt);
		            		$cnt=serialize($cnt);							
														
							$this->session->set_userdata('compare',$cnt);
							if(!empty($uid))
							{
			        			$this->custom_model->my_update(array('content' => $cnt),array('id' => $is_data[0]['id']),'my_cart',true,true);					
							}
							echo json_encode( array("status" => true, "message" => ($language == 'ar'? 'Added to compare successfully':'Added to compare successfully'),"compare_count"=>$compare_count ) );die;	
						}else{
							$compare_count=0;
							if (array_key_exists($append, $compare))
							{
								unset($compare[$append]);
								$compare = array_filter($compare);	
								$compare_count=count($compare);
								$this->session->set_userdata('compare',serialize($compare));		
								if(!empty($uid))
								{
									$this->custom_model->my_update(array('content' => serialize($compare)),array('id' => $is_data[0]['id']),'my_cart',true,true);
								}	
							}
							echo json_encode( array("status" => true, "message" => ($language == 'ar'? 'Removed from compare successfully':'Removed from compare successfully'),"compare_count"=>$compare_count ) );die;	
						}
					}else{
						$cnt[$append] = array('pid' => $pid);
						$compare_count=count($cnt);
						$data['user_id'] = $uid;
						$data['meta_key'] = 'compare';
						$data['content'] = serialize($cnt);
						$this->session->set_userdata('compare',$data['content']);
						if(!empty($uid))
						{
							if(isset($is_data) && !empty($is_data))
							{
								$this->custom_model->my_update(array('content' => serialize($cnt)),array('id' => $is_data[0]['id']),'my_cart',true,true);
							}else{
								$this->custom_model->my_insert($data,'my_cart');
							}
						}
						echo json_encode( array("status" => true, "message" => ($language == 'ar'? 'Added to compare successfully':'Added to compare successfully'),"compare_count"=>$compare_count ) );die;
					}
				}else{
					$cnt[$append] = array('pid' => $pid);
					$compare_count=count($cnt);
					$data['user_id'] = $uid;
					$data['meta_key'] = 'compare';
					$data['content'] = serialize($cnt);
					$this->session->set_userdata('compare',$data['content']);
					if(!empty($uid))
					{
						if(isset($is_data) && !empty($is_data))
						{
							$this->custom_model->my_update(array('content' => serialize($cnt)),array('id' => $is_data[0]['id']),'my_cart',true,true);
						}else{
							$this->custom_model->my_insert($data,'my_cart');
						}						
					}
					echo json_encode( array("status" => true, "message" => ($language == 'ar'? 'Added to compare successfully':'Added to compare successfully'),"compare_count"=>$compare_count ) );die;	
				}				
			}else{
				echo json_encode( array("status" => false, "message" => ($language == 'ar'? 'Something went wrong':'Something went wrong') ) );die;	
			}
		}else{
			echo json_encode( array("status" => false, "message" => ($language == 'ar'? 'Something went wrong':'Something went wrong') ) );die;
		}
	}

	public function old_add_to_wish_list($echo=true)
	{
		$pid = $this->input->post('pid');
		$is_wish = $this->input->post('is_wish');
		$uid = $this->session->userdata('uid');
		if (empty($uid))
		{
			if ($echo)
			{
				echo "0";
			}
			// echo 0;
			die;
		}
		$my_wish = array();
		$my_wish = $this->session->userdata('my_wish');
		if (empty($my_wish))
		{
			$my_wish[] = $pid;
			$this->session->set_userdata('my_wish',$my_wish);
		}
		elseif (!in_array($pid, $my_wish))
		{
			$my_wish[] = $pid;
			$this->session->set_userdata('my_wish',$my_wish);
		}
		elseif ($is_wish == '1')
		{
			$my_wish = array_diff($my_wish, array($pid));
			$this->session->set_userdata('my_wish',$my_wish);
		}

		if (!empty($uid))
		{
			$is_data = $this->custom_model->my_where('my_cart','*',array('user_id' => $uid,'meta_key' => 'wish_list'));

			if (!empty($is_data)) {
				$this->custom_model->my_update(array('content' => serialize($my_wish)),array('id' => $is_data[0]['id']),'my_cart',true,true);
			}
			else{
				$data['user_id'] = $uid;
				$data['meta_key'] = 'wish_list';
				$data['content'] = serialize($my_wish);
				$this->custom_model->my_insert($data,'my_cart');
			}
		}
		if ($echo)
		{
			echo "1";
		}
		// die;
	}

	public function check_qty()
	{
		$pid = $this->input->post('pid');
		$qty = $this->input->post('qty');

		$res = $this->custom_model->my_where('product','*',array('id' => $pid));
		if (isset($res[0]))
		{
			if ($qty > $res[0]['stock'])
			{
				echo "0";
			}
		}
	}

	public function view_cart_count() {
	
		$uid = $this->session->userdata('uid');
		if(!empty($uid)) {
			$is_data = $this->custom_model->my_where('my_cart','*',array('user_id' => $uid,'meta_key' => 'cart'));
			if(!empty($is_data)) {
				$content=$is_data[0]['content'];
				$content=unserialize($content);				
				$count= count($content);
				$cart_total=$this->return_cart_price();
				echo json_encode(array('cart_count'=>$count,'cart_total'=>$cart_total));
				// echo "$count";
				exit;
			}
			else {				
				// echo "1";
				echo json_encode(array('cart_count'=>1,'cart_total'=>0.00));
				exit;
			}
		}
		else {
			$content=$this->session->userdata('content');
			if(!empty($content))
				{
					$session_cart=unserialize($content);
					$count= count($session_cart);
					$cart_total=$this->return_cart_price();
					echo json_encode(array('cart_count'=>$count,'cart_total'=>$cart_total));
					// echo "$count";
					exit;
				} else {
					// echo "1";
					echo json_encode(array('cart_count'=>1,'cart_total'=>0.00));
					exit;
				}	
		}
	}

	public function remove_from_cart($echo=true)
	{
		$pid = $this->input->post('pid');
		$uid = $this->session->userdata('uid');
		
		$this->load->library('user_account');
		$response = $this->user_account->add_remove_cart($pid,$uid,'remove');
		
		if ($echo)
		{
			if ($response != '-1')
			{
				$content=$this->session->userdata('content');
				$content=unserialize($content);

				// echo "<pre>";
				// print_r($content);die;
					$total_price=0;
				if(!empty($content))
				{
					$price=0;
					foreach ($content as $c_key => $c_value) {
						$qty=$c_value['qty'];
						if( isset($c_value['metadata']) && !empty($c_value['metadata']) ) {
		                      $price=$c_value['metadata']['price'];
		                      $price=$price*$qty;
		                  } else {
		                  	$product = $this->custom_model->my_where('product','*',array('id' => $c_value['pid']));
		                       $price=$product[0]['price'];
		                       $price=$price*$qty;
		                  }
		                  $total_price=$price+$total_price;
					}
				}
				// echo "total_price ".$total_price;
				$pro_count=count($response);
				echo json_encode(array("pro_count"=>$pro_count,"total_price"=>$total_price));
				// echo "1";
			}
			else{
				echo "0";
			}
		}
	}

	public function remove_all()
	{
		// $pid = $this->input->post('pid');
		$uid = $this->session->userdata('uid');
		
		if(!empty($uid))
		{
			$this->custom_model->my_update(array('content' =>''),array('user_id' => $uid,"meta_key"=>"cart"),'my_cart');
			$this->session->set_userdata('content','');
		}else{
			$this->session->set_userdata('content','');	
		}
		echo 1;
		die;
	}

	public function product_comment()
	{
		$uid=$this->session->userdata('uid');		
		$post_data=$this->input->post();
		if(!empty($post_data))
		{
			if(!empty($uid))
			{
				$is_data = $this->custom_model->my_where('my_cart','*',array('user_id' => $uid,'meta_key' => 'cart'));
				$content=unserialize($is_data[0]['content']);								
			}else {
				$content=$this->session->userdata('content');
				$content=unserialize($content);
			}				
			if(!empty($content))
			{
				if (array_key_exists($post_data['pid'],$content))
				{
					$pid=$post_data['pid'];
					$content[$pid]['comment']=$post_data['comment'];
					if(!empty($uid))
					{					
						$this->custom_model->my_update(array('content' => serialize($content)),array('user_id' => $uid),'my_cart',true,true);	
					}
					$this->session->set_userdata('content',serialize($content));
					echo "update";
					die;
				}else {
					echo "no_record";
					die;
				}				
			}else {
				echo "no_record";
				die;
			}
		} else {
			echo 0;
			die;
		}
	}

	public function check_hotel_time()
	{		
		$date=date('d-m-Y'); //Thu  Sun Fri ,Sat
		$day= date("D",strtotime($date));	

		if($day=='Fri' ||$day=='Sat' )
		{
			$shop_timing = $this->custom_model->my_where('shop_timing','*',array('id' =>'2'));
			$open_time=$shop_timing[0]['open_time'];
			$close_time=$shop_timing[0]['close_time'];
			if(strtotime(date('H:i:s')) > strtotime(date($open_time)) && strtotime(date('H:i:s')) < strtotime(date($close_time))){
				return 'yes';
			}
			else{
			  return 'no';
			}			
		} else {			
			$shop_timing = $this->custom_model->my_where('shop_timing','*',array('id' =>'1'));
				$open_time=$shop_timing[0]['open_time'];
				$close_time=$shop_timing[0]['close_time'];		
			if(strtotime(date('H:i:s')) > strtotime(date($open_time)) && strtotime(date('H:i:s')) < strtotime(date($close_time)))
			{	
			  return 'yes';
			}
			else
			{
			  return 'no';
			}
		}
		
	}	

	public function get_customize()
	{
		$post_data=$this->input->post();
		if(!empty($post_data['pid']))
		{
			$pid=$post_data['pid'];
			$is_product = $this->custom_model->my_where('product','id,customize,product_name',array('id' =>$pid));
			if(!empty($is_product))
			{
				$customize=explode(',',$is_product[0]['customize']); 
				if(!empty($customize))
				{
					foreach ($customize as $cust_key => $cust_val) 
					{
						$pcustomize_title = $this->custom_model->my_where('pcustomize_title','*',array('id' =>$cust_val,'delete_status'=>'0','status'=>'1'));
						if(!empty($pcustomize_title))
						{							
							if($cust_key==0)
							{
								$is_product[0]['customize_detail']=$pcustomize_title;
								
							}else{
								// $pcustomize_title
								$is_product[0]['customize_detail'][$cust_key]['id']=$pcustomize_title[0]['id'];
								$is_product[0]['customize_detail'][$cust_key]['title']=$pcustomize_title[0]['title'];
								$is_product[0]['customize_detail'][$cust_key]['add_limit']=$pcustomize_title[0]['add_limit'];
								$is_product[0]['customize_detail'][$cust_key]['type']=$pcustomize_title[0]['type'];
								$is_product[0]['customize_detail'][$cust_key]['status']=$pcustomize_title[0]['status'];
								$is_product[0]['customize_detail'][$cust_key]['delete_status']=$pcustomize_title[0]['delete_status'];
							}
							$pcustomize_attribute = $this->custom_model->my_where('pcustomize_attribute','*',array('pcus_id' =>$pcustomize_title[0]['id'],'delete_status'=>'0'));
							if(!empty($pcustomize_attribute))
							{
								$is_product[0]['customize_detail'][$cust_key]['customize_attr']=$pcustomize_attribute;
							}else{
								$is_product[0]['customize_detail'][$cust_key]['customize_attr']='no_record';
							}
						}else{
							$is_product[0]['customize_detail']='no_record';
						}
					}
					echo json_encode(array('status'=>true,'message'=>$is_product));		
					die;			
				}else{
					// procut don't have customize
					echo json_encode(array('status'=>false,'message'=>'not_customize'));
					die;
				}				
			}else{
				// procut not exist
				echo json_encode(array('status'=>false,'message'=>'not_exist'));		
				die;			
			}
		}else{
			// pass prodcut id
			echo json_encode(array('status'=>false,'message'=>'invlid_request'));		
			die;
		}
	}


	public function get_customize2()
	{
		$post_data=$this->input->post();
		$country=$this->return_currency_name();
		if(!empty($post_data['pid']))
		{
			$pid=$post_data['pid'];
			$is_product = $this->custom_model->my_where('product','id,customize,product_name,price',array('id' =>$pid));
			if(!empty($is_product))
			{				
				if($country=='Abu Dhabi'){	$is_product[0]['currancy']='AED'; } else { $is_product[0]['currancy']='BHD'; }
				$pc_detatils = $this->custom_model->get_data_array(" SELECT `pcustomize_title_id` FROM product_custimze_details WHERE pid='$pid' GROUP BY `pcustomize_title_id` ");
				
				// echo "<pre>";
				// print_r($pc_detatils);
				// die;

				if(!empty($pc_detatils))
				{

					$is_product[0]['pc_detatils']=$pc_detatils;
					foreach ($is_product[0]['pc_detatils'] as $pcd_key => $pcd_val) 
					{

						$pcustomize_title = $this->custom_model->my_where('pcustomize_title`','*',array('id' =>$pcd_val['pcustomize_title_id'],'delete_status'=>'0','status'=>'1'));

						if(!empty($pcustomize_title))
						{
							$is_product[0]['pc_detatils'][$pcd_key]['title']=$pcustomize_title[0]['title'];
							$is_product[0]['pc_detatils'][$pcd_key]['add_limit']=$pcustomize_title[0]['add_limit'];
							$is_product[0]['pc_detatils'][$pcd_key]['type']=$pcustomize_title[0]['type'];
							$is_product[0]['pc_detatils'][$pcd_key]['status']=$pcustomize_title[0]['status'];

							$pc_detatils2 = $this->custom_model->my_where('product_custimze_details','*',array('pcustomize_title_id' =>$pcd_val['pcustomize_title_id'],'pid'=>$pid));

							$is_product[0]['pc_detatils'][$pcd_key]['pcus_attr']=$pc_detatils2;

							if(!empty($is_product[0]['pc_detatils'][$pcd_key]['pcus_attr']))
							{
								foreach ($is_product[0]['pc_detatils'][$pcd_key]['pcus_attr'] as $pcus_key => $pcus_val) 
								{


									$pcustomize_attribute = $this->custom_model->my_where('pcustomize_attribute','name,price_bh,price_ad,delete_status',array('id' =>$pcus_val['pcustomize_attribute_id'],'delete_status'=>'0'));
									if(!empty($pcustomize_attribute))
									{

									$is_product[0]['pc_detatils'][$pcd_key]['pcus_attr'][$pcus_key]['name']=$pcustomize_attribute[0]['name'];
																	
									if($country=='Abu Dhabi')
									{
										$is_product[0]['pc_detatils'][$pcd_key]['pcus_attr'][$pcus_key]['price']=$pcustomize_attribute[0]['price_ad'];
										$is_product[0]['pc_detatils'][$pcd_key]['pcus_attr'][$pcus_key]['currancy']='AED';
									}else{

									$is_product[0]['pc_detatils'][$pcd_key]['pcus_attr'][$pcus_key]['price']=$pcustomize_attribute[0]['price_bh'];
									$is_product[0]['pc_detatils'][$pcd_key]['pcus_attr'][$pcus_key]['currancy']='BHD';
									}									

									$is_product[0]['pc_detatils'][$pcd_key]['pcus_attr'][$pcus_key]['delete_status']=$pcustomize_attribute[0]['delete_status'];
									}else{
										unset($is_product[0]['pc_detatils'][$pcd_key]['pcus_attr'][$pcus_key]);
									}

									if(empty($is_product[0]['pc_detatils'][$pcd_key]['pcus_attr']))
									{
										// admin delete pcustomize_attribute 
										echo json_encode(array('status'=>false,'message'=>'not_customize_found'));	
										die;
									}									
								}
							}
						}else{
							// unset main attribure when customize title deactive or delteted
							unset($is_product[0]['pc_detatils'][$pcd_key]);
							// unset($pc_detatils[$pcd_key]);

						}
					}
						// this conditon for when admin deactive customize and deleted attribue	
					if(empty($is_product[0]['pc_detatils']))
					{
						// $is_product[0]['pc_detatils']='not_customize_found';
						echo json_encode(array('status'=>false,'message'=>'not_customize_found'));	
						die;
					}
				}
				// echo "<pre>";
				// print_r($is_product);
				echo json_encode(array('status'=>true,'message'=>$is_product));	
				die;	

			}else{
				// prodcut not exsit
				echo json_encode(array('status'=>false,'message'=>'record_found'));	
				die;
			}
			// echo "<pre>";
			// print_r($is_product);
			die;
			
		}else{
			// pass prodcut id
			echo json_encode(array('status'=>false,'message'=>'invlid_request'));		
			die;
		}
	}
}
