<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * My_account page
 */
class My_account extends MY_Controller {

	protected $language = '';
	protected $myaccount = '';
	protected $uid = '';

	public function __construct()
	{
		$language = $this->uri->segments[1];
		$this->uid = $this->session->userdata('uid');
		if (empty($this->uid)) {
			$this->session->set_flashdata('login_message', 'Please Login Or Create Account!!');
			redirect($language);
		}
		parent::__construct();
		$this->myaccount = lang('myaccount');
		$this->load->model('admin/Custom_model','custom_model');
		$this->load->model('Default_model','default_model');
		date_default_timezone_set("Asia/Riyadh");
	}

	public function index()
	{
		$uid = $this->session->userdata('uid');

		$data = $this->custom_model->my_where("admin_users","*",array("id" => $uid),array(),"","","","", array(), "",array(),false  );

		$post_data = $this->input->post();

		if (!empty($post_data))
		{
			// echo "<pre>";
			// print_r($post_data);
			// die;

			$email = $this->input->post('email');
			$phone = $this->input->post('phone');


			if ($email)
			{
				$email_check = $this->custom_model->my_where("admin_users","*",array("id !=" => $uid,'email' => $email),array(),"","","","", array(), "",array(),false  );
				if ($email_check) {
					// $this->session->set_flashdata('email','Email already exist !');
					echo 'email';
					die;
				}
			}

			if ($phone)
			{
				$phone_check = $this->custom_model->my_where("admin_users","*",array("id !=" => $uid,'phone' => $phone),array(),"","","","", array(), "",array(),false  );
				if ($phone_check) {
					$this->session->set_flashdata('phone',' Phone already exist !');
					echo 'phone';
					die;
				}

			}

			if ( empty($phone_check) && empty($email_check))
			{
				$additional_data = array(
					'first_name'			=> $this->input->post('first_name'),
					'last_name'				=> $this->input->post('last_name'),
					'address'				=> $this->input->post('address'),
					'username' 				=> $this->input->post('email'),
					'email'					=> $this->input->post('email'),
					'phone'					=> $this->input->post('phone'),
				);

				$users_check = $this->custom_model->my_where("admin_users","*",array("id" => $uid),array(),"","","","", array(), "",array(),false  );

	            $this->custom_model->my_update($additional_data,array('id' => $uid),'admin_users');
				// $this->session->set_flashdata('success','Profile Updated successfully !');
				echo 'success';
				die;
			}

			// echo "<pre>";
			// print_r($additional_data);
			// print_r($phone_check);
			// die;
		}

		// echo "<pre>";
		// print_r($data);
		// die;

		$data = $this->custom_model->my_where("admin_users","*",array("id" => $uid),array(),"","","","", array(), "",array(),false  );

		$this->mViewData['data']= $data[0];

		$this->Urender('profile_info','udefault');
	}


	public function account()
	{
		$this->Urender('my-account','udefault');
	}

	public function cng_pass()
	{
		$language= $this->uri->segment(1);
		$uid = $this->session->userdata('uid');

		$post_data = $this->input->post();
		$data = $this->custom_model->my_where("admin_users","*",array("id" => $uid),array(),"","","","", array(), "",array(),false  );

		if ( !empty($post_data) )
		{

			$password =  $this->input->post('password',true);
			$old_password =  $this->input->post('old_password',true);
			$confirm_password =  $this->input->post('confirm_password',true);
			$hpassword =password_hash($this->input->post('password'), PASSWORD_BCRYPT);

			// print_r($password);
			if(password_verify ( $old_password ,$data[0]['password'] ))
			{
				if($password == $confirm_password )
				{
					$updata["password"] = $hpassword;
					$this->custom_model->my_update($updata,array('id' => $uid),'admin_users');
					if($language=='en')
					{
						$this->session->set_flashdata('success','Password Updated successfully !');
					}else{
						$this->session->set_flashdata('success','تم تحديث كلمة السر بنجاح');
					}
					// print_r($post_data);die();
				}
				else{
					if($language=='en')
					{
						$this->session->set_flashdata('error','Password & Confirm Password Not Matched');
					}else{
						$this->session->set_flashdata('error','كلمة المرور وتأكيد كلمة المرور غير متطابقتين ');
					}
				}
			}else{
				$this->session->set_flashdata('error','Invalid old password');
			}
		}

		// $user_data = $this->custom_model->my_where('admin_users',"*",array('id' =>$this->uid));
		$bank_details = $this->custom_model->get_data_array("SELECT * FROM bank_details Order by bank_name asc ");
		$city_list = $this->custom_model->get_data_array("SELECT * FROM city_list Order by city_name asc ");
		$state_list = $this->custom_model->get_data_array("SELECT * FROM state_list Order by state_name asc ");
		$postal_code_list = $this->custom_model->get_data_array("SELECT * FROM postal_code_list Order by id desc ");

		$this->mViewData['user_data']= $data;
		$this->mViewData['bank_details']= $bank_details;
		$this->mViewData['city_list']= $city_list;
		$this->mViewData['state_list']= $state_list;
		$this->mViewData['postal_code_list']= $postal_code_list;


		// print_r($data);
		// $this->Urender('cng-pw', 'udefault',"",$data);
		$this->Urender('account-info', 'udefault');
	}


	public function newsletter()
	{
		$uid = $this->session->userdata('uid');

		$post_data = $this->input->post();

		if ( !empty($post_data) )
		{
			//print_r($post_data);die;
			if (empty($uid))
			{
				$uid =0;
			}

			$additional_data = array(

				'newsletter'			=> $this->input->post('newsletter')

				);

			$data = $this->custom_model->my_where("admin_users","*",array("id" => $uid),array(),"","","","", array(), "",array(),false  );

			if ( !empty($data) ){

                $this->custom_model->my_update($additional_data,array('id' => $uid),'admin_users');
                $this->session->set_flashdata('success','Newsletter updated successfully !');
			}
			else{
					$this->custom_model->my_insert($additional_data,'admin_users');
					$this->session->set_flashdata('success','Newsletter updated successfully !');

				}
		}

		$data = $this->custom_model->my_where("admin_users","*",array("id" => $uid),array(),"","","","", array(), "",array(),false  );
		// echo "<pre>";
		// print_r($data);
		// die;
		$this->mViewData['data']= $data;
		$this -> Urender('newsletter','udefault');
	}

	public function wishlist()
	{
		$language= $this->uri->segment(1);
		$product_data = array();
		$uid=$this->session->userdata('uid');
		$get_data=$this->input->get();
		if(!empty($get_data) && $get_data['sort']=='desc' )
		{
			$flag=false;
		}else{
			$flag=true;
		}
		if($language=="en")
		{
			$product = "product";
			$category = "category";
			$brand = "brand";
			$unit_list = "unit_list";
		}else{
			$product = "product_trans";
			$category = "category_trans";
			$brand = "brand";
			$unit_list = "unit_list_trans";
		}
		$my_data = $this->custom_model->my_where('my_cart','*',array('user_id' => $uid,'meta_key' => 'wish_list'));
		if (!empty($my_data))
		{
			// $this->session->set_userdata('my_wish',unserialize($my_data[0]['content']));
			$my_wish=unserialize($my_data[0]['content']);
			// echo "<pre>";
			// print_r($my_wish);
			// die;
			if (!empty($my_wish)) {
				foreach ($my_wish as $key => $value)
				{
					$curr = $this->custom_model->my_where($product,'id,product_name,brand,category,subcategory,description,short_description,price,sale_price,stock_status,stock,product_image,status,min_order_quantity,price_select,unite',array('id'=>$value['pid'],'status'=>'1'));
					if (!empty($curr))
					{
						$curr[0]['add_date']=$value['add_date'];
						$product_data[$key] = $curr[0];
					}
				}
			}
		}

		if($flag==true)
		{
			if(!empty($product_data))
			{
				usort($product_data, 'date_compare');
				$columns = array_column($product_data, 'add_date');
				array_multisort($columns, SORT_DESC, $product_data);

			}
		}
		$product_data=$this->related_menu($product_data,$language);
		// echo "<pre>";
		// print_r($product_data);
		// die;
		$unit_list_data = $this->custom_model->get_data_array("SELECT * FROM $unit_list ORDER BY unit_name ASC ");

		// $country=$this->return_country_name();


		$currency=$this->return_currency_name();
	    $currency_symbol=$this->return_currency_symbol($currency,$language);

		$this->mViewData['product_data'] = $product_data;
		$this->mViewData['unit_list_data'] = $unit_list_data;
		$this->mViewData['currency_symbol'] = $currency_symbol;
		// $this->mViewData['country'] = $country;
		// $this -> Urender('wishlist','udefault');
		$this -> Urender('wishlist','udefault');
	}

	public function old_order_history()
	{
		// $language = $this->uri->segments(1);
		$language= $this->uri->segment(1);
		if($language=="en")
		{
			$product = "product";
			$category = "category";
			$brand = "brand";
			$banner = "banner";
			$unit_list = "unit_list";
		}else{
			$product = "product_trans";
			$category = "category_trans";
			$brand = "brand";
			$banner = "banner_trans";
			$unit_list = "unit_list_trans";
		}
		if (!empty($this->uid))
		{
			$uid=$this->uid;
			$order_items = $this->custom_model->get_data_array("SELECT items.*,master.currency FROM order_items as items INNER JOIN order_master as master ON items.order_no=master.order_master_id WHERE items.user_id='$uid' ORDER By items.item_id DESC ");

			if(!empty($order_items))
			{
				foreach ($order_items as $oi_key => $oi_val)
				{
					$product_data = $this->custom_model->my_where($product,'id,product_image',array('id' => $oi_val['product_id']));
					if(!empty($product_data))
					{
						$order_items[$oi_key]['product_image']=$product_data[0]['product_image'];
					}else{
						$order_items[$oi_key]['product_image']='';
					}

					$unit_data = $this->custom_model->my_where($unit_list,'id,unit_name',array('id' => $oi_val['unit']));
					if(!empty($unit_data))
					{
						$order_items[$oi_key]['unit_name']=$unit_data[0]['unit_name'];
					}else{
						$order_items[$oi_key]['unit_name']='';
					}
				}
			}


			// $sub_query $order_by limit $rowno,$rowperpage
			// echo "<pre>";
			// print_r($order_items);
			// die;

			$this->mViewData['order_items']= $order_items;
			$this->Urender('order_history', 'udefault');

		}
	}

	public function old_orders()
	{
		// $language = $this->uri->segments(1);
		$language= $this->uri->segment(1);
		if($language=="en")
		{
			$product = "product";
			$category = "category";
			$brand = "brand";
			$banner = "banner";
			$unit_list = "unit_list";
		}else{
			$product = "product_trans";
			$category = "category_trans";
			$brand = "brand";
			$banner = "banner_trans";
			$unit_list = "unit_list_trans";
		}
		if (!empty($this->uid))
		{
			$uid=$this->uid;
			$order_items = $this->custom_model->get_data_array("SELECT items.*,master.currency FROM order_items as items INNER JOIN order_master as master ON items.order_no=master.order_master_id WHERE items.user_id='$uid' ORDER By items.item_id DESC ");

			if(!empty($order_items))
			{
				foreach ($order_items as $oi_key => $oi_val)
				{
					$product_data = $this->custom_model->my_where($product,'id,product_image',array('id' => $oi_val['product_id']));
					if(!empty($product_data))
					{
						$order_items[$oi_key]['product_image']=$product_data[0]['product_image'];
					}else{
						$order_items[$oi_key]['product_image']='';
					}

					$unit_data = $this->custom_model->my_where($unit_list,'id,unit_name',array('id' => $oi_val['unit']));
					if(!empty($unit_data))
					{
						$order_items[$oi_key]['unit_name']=$unit_data[0]['unit_name'];
					}else{
						$order_items[$oi_key]['unit_name']='';
					}
				}
			}


			// $sub_query $order_by limit $rowno,$rowperpage
			// echo "<pre>";
			// print_r($order_items);
			// die;

			$this->mViewData['order_items']= $order_items;
			$this->Urender('orders', 'udefault');

		}
	}

	public function orders()
	{
		// $language = $this->uri->segments(1);
		$language= $this->uri->segment(1);
		if (!empty($this->uid))
		{
			$data = array();
			$data = $this->custom_model->get_data_array("SELECT *, order_invoice.net_total as net FROM `order_master` join `order_invoice` on order_master.order_master_id = order_invoice.order_no WHERE `user_id` = '$this->uid'  ORDER BY order_master.order_master_id desc ");
			foreach ($data as $key => $value)
			{

				$items = $this->custom_model->my_where("order_items","*",array("order_no" => $value['order_master_id']) );

				foreach ($items as $k => $val)
				{
					$item_info = $this->custom_model->my_where("product","product_name,product_image,seller_id,id",array("id" => $val['product_id']) );
					if($language=="en")
					{
						$unit_data = $this->custom_model->my_where('unit_list','id,unit_name',array('id' => $val['unit']));
					} else{
						$unit_data = $this->custom_model->my_where('unit_list','id,unit_name',array('id' => $val['unit']));
					}
					if(!empty($unit_data))
					{
						$item_info[0]['unit_name']=$unit_data[0]['unit_name'];
					}else{
						$item_info[0]['unit_name']='';
					}
					@$data[$key]['items'][$k] = array_merge($val,$item_info[0]);

				}
				$trans_history = $this->custom_model->my_where("payment_details","*",array("display_order_id" => $value['display_order_id']) );
				if(!empty($trans_history))
				{
					$data[$key]['transaction_id']=$trans_history[0]['display_order_id'];
				}
			}

				// echo "<pre>";
				// print_r($data);
				// die;


			$this->mViewData['data']= $data;
			$this->Urender('old_order_history', 'udefault');
			// $this->Urender('order_history_new', 'udefault');
			// $this->Urender('order-history', 'udefault', lang('orders'), $data, $parent);

		}
	}

	public function send_quotation_list($sqid='',$noti_id='')
	{
		$language= $this->uri->segment(1);
		$rowno=0;
		$ajax='';
		$order_type="Open";
		$post_data=$this->input->post();
		if(!empty($post_data))
		{
			$ajax=$post_data['ajax'];
			if(isset($post_data['pageno']))
			{
				$rowno=$post_data['pageno'];
			}
			if(isset($post_data['order_type']))
			{
				$order_type=$post_data['order_type'];
			}
		}

		$rowperpage=9;

		if($rowno != 0){
    		$page_no=$rowno;
      		$rowno = ($rowno-1) * $rowperpage;
    	}else{
    		$page_no=$rowno;
    		$rowno=0;
    	}

    	if(empty($sqid) && empty($noti_id) )
    	{
	    	if($order_type=='Rejected')
	    	{
	    		$quotation_list = $this->custom_model->get_data_array("SELECT id,quotation_status,product_name,purchase_cycle,unit,qty,created_date,pid FROM `send_quotation` WHERE uid = '$this->uid' AND quotation_status='$order_type' ORDER BY id desc limit $rowno,$rowperpage ");

				$quotation_count = $this->custom_model->get_data_array("SELECT id FROM `send_quotation` WHERE uid = '$this->uid' AND quotation_status='$order_type' ORDER BY id desc ");
	    	}else{
				$quotation_list = $this->custom_model->get_data_array("SELECT id,quotation_status,product_name,purchase_cycle,unit,qty,created_date,pid FROM `send_quotation` WHERE uid = '$this->uid' AND quotation_status='$order_type' ORDER BY id desc limit $rowno,$rowperpage ");

				$quotation_count = $this->custom_model->get_data_array("SELECT id FROM `send_quotation` WHERE uid = '$this->uid' AND quotation_status='$order_type' ORDER BY id desc ");
	    	}
    	}else{
    		$quotation_list = $this->custom_model->get_data_array("SELECT id,quotation_status,product_name,purchase_cycle,unit,qty,created_date,pid FROM `send_quotation` WHERE uid = '$this->uid' AND id='$sqid' ORDER BY id desc limit $rowno,$rowperpage ");

			$quotation_count = $this->custom_model->get_data_array("SELECT id FROM `send_quotation` WHERE uid = '$this->uid' AND id='$sqid' ORDER BY id desc ");

			$this->custom_model->my_update(array('is_seen'=>1),array('id'=>$noti_id,'is_seen'=>'0'),'inv_mesg_notification');
    	}

		if(!empty($quotation_list))
		{
			$quotation_list=$this->get_quotaion_data($quotation_list);

			foreach ($quotation_list as $ql_key => $val)
			{
				$is_data = $this->custom_model->my_where('product',"product_image",array('id' =>$val['pid']));
				if(!empty($is_data))
				{
					$quotation_list[$ql_key]['product_image']=base_url('assets/admin/products/').$is_data[0]['product_image'];
				}else{
					$quotation_list[$ql_key]['product_image']=base_url('assets/frontend/images/icon/logo-04.png');
				}

			}
		}

		$this->load->library('pagination');

		$config['base_url'] = base_url('my_account/send_quotation_list');
	    $config['total_rows'] = count($quotation_count);
	    $config['per_page'] = $rowperpage;
	    $config['page_query_string'] = FALSE;
	    $config['enable_query_strings'] = FALSE;
	    $config['reuse_query_string']  = FALSE;
	    $config['cur_page'] = $page_no;

	    $this->pagination->initialize($config);

	    if(!empty($ajax))
	    {
	    	$data['pagination'] = $this->pagination->create_links();
	    	// $data['result'] = $this->return_html($add_car_data);
	    	$data['result'] =$quotation_list;
	    	$data['row'] = $rowno;
	    	$data['total_rows'] = count($quotation_count);
	    	echo json_encode($data);
 			die;
	    }

	    $this->mViewData['pagination']= $this->pagination->create_links();
	    $this->mViewData['row']= $rowno;;
	    $this->mViewData['quotation_count']= count($quotation_count);

	    if($language=='en')
		{
			$unit_list = "unit_list";
		}else{
			$unit_list = "unit_list_trans";
		}
	    $funit_list_data = $this->custom_model->get_data_array("SELECT * FROM $unit_list ORDER BY unit_name ASC ");
		// echo "<pre>";
		// print_r($quotation_list);
		// die;

		$this->mViewData['quotation_list']= $quotation_list;
		$this->mViewData['funit_list_data']= $funit_list_data;
		$this->Urender('send_quotation_list', 'udefault');
	}

	public function quotation_detail($qid='')
	{
		$language= $this->uri->segment(1);

		$quotation_detail = $this->custom_model->get_data_array("SELECT * FROM `send_quotation` WHERE uid = '$this->uid'  AND id='$qid'");

		// echo "<pre>";
		// print_r($quotation_detail);
		// die;
		if(!empty($quotation_detail))
		{
			$quotation_detail=$this->get_quotaion_data($quotation_detail,$is_vender=true);
		}
		$this->mViewData['quotation_detail']= $quotation_detail;
		$this->Urender('quotation_detail', 'udefault');
	}

	public function received_invoice_list($qid='')
	{
		$language= $this->uri->segment(1);

		// $invlice_list = $this->custom_model->get_data_array("SELECT * FROM `quotation_invoice` WHERE uid = '$this->uid' AND quotaion_id='$qid' ORDER BY in_id desc ");

		$invlice_list = $this->custom_model->get_data_array("SELECT quo_i.* FROM send_quotation as send_q RIGHT JOIN quotation_invoice as quo_i ON send_q.id=quo_i.quotaion_id WHERE send_q.uid='$this->uid' AND send_q.quotation_status!='Cancelled' AND quo_i.invoice_status!='' AND quo_i.quotaion_id='$qid' ORDER BY quo_i.in_id DESC ");

		$tax = $this->custom_model->my_where('tax',"*",array('id' =>1));
		// echo "<pre>";
		// print_r($invlice_list);
		// print_r($tax);
		// die;
		$currency=$this->return_currency_name();
		$currency_symbol=$this->return_currency_symbol($currency,$language);
		$this->mViewData['invlice_list']= $invlice_list;
		$this->mViewData['tax']= $tax;
		$this->mViewData['currency']= $currency;
		$this->mViewData['currency_symbol']= $currency_symbol;
		$this->Urender('received_invoice_list', 'udefault');
	}

	public function received_invoice($id='')
	{
		$language= $this->uri->segment(1);

		$invlice_list = $this->custom_model->get_data_array("SELECT * FROM `quotation_invoice` WHERE uid = '$this->uid' AND in_id='$id' ");
		// $invlice_list = $this->custom_model->get_data_array("SELECT quo_i.* FROM send_quotation as send_q RIGHT JOIN quotation_invoice as quo_i ON send_q.id=quo_i.quotaion_id WHERE send_q.uid='$this->uid'  AND quo_i.quotaion_id='$qid' ORDER BY quo_i.in_id DESC ");

		if(!empty($invlice_list))
		{
			$seller_info = $this->custom_model->my_where('admin_users',"first_name",array('id' =>$invlice_list[0]['seller_id']));
			$invlice_list[0]['seller_name']=$seller_info[0]['first_name'];
		}

		$tax = $this->custom_model->my_where('tax',"*",array('id' =>1));
		// echo "<pre>";
		// print_r($invlice_list);
		// print_r($tax);
		// die;
		$currency=$this->return_currency_name();
		$currency_symbol=$this->return_currency_symbol($currency,$language);
		$this->mViewData['invlice_list']= $invlice_list;
		$this->mViewData['tax']= $tax;
		$this->mViewData['currency']= $currency;
		$this->mViewData['currency_symbol']= $currency_symbol;
		// $this->mViewData['data']= $data;
		$this->Urender('received_invoice', 'udefault');
	}

	public function account_info()
	{
		$post_data=$this->input->post();

		if(!empty($post_data))
		{
			$update_data=array();

			$is_phone=$this->custom_model->my_where('admin_users',"*",array("phone"=>$post_data['phone'],'id!='=>$this->uid));
			if(!empty($is_phone))
			{
				echo "phone"; die;
			}

			$is_email=$this->custom_model->my_where('admin_users',"*",array("email"=>$post_data['email'],'id!='=>$this->uid));
			if(!empty($is_email))
			{
				echo "email"; die;
			}

			$is_username=$this->custom_model->my_where('admin_users',"*",array("username"=>$post_data['username'],'id!='=>$this->uid));
			if(!empty($is_username))
			{
				echo "cr_number"; die;
			}

			if(!empty($post_data['first_name'])) $update_data['first_name'] 	= $post_data['first_name'];
			if(!empty($post_data['entity_name'])) $update_data['entity_name'] 	= $post_data['entity_name'];

			if(!empty($post_data['username'])) $update_data['username'] 	= $post_data['username'];

			if(!empty($post_data['street_name'])) $update_data['street_name'] 	= $post_data['street_name'];

			if(!empty($post_data['building_no'])) $update_data['building_no'] 	= $post_data['building_no'];

			if(!empty($post_data['city'])) $update_data['city'] 	= $post_data['city'];

			if(!empty($post_data['state'])) $update_data['state'] 	= $post_data['state'];

			if(!empty($post_data['postal_code'])) $update_data['postal_code'] 	= $post_data['postal_code'];

			// if(!empty($post_data['country'])) $update_data['country'] 	= $post_data['country'];

			if(!empty($post_data['phone'])) $update_data['phone'] 	= $post_data['phone'];

			if(!empty($post_data['email'])) $update_data['email'] 	= $post_data['email'];

			if(!empty($post_data['vat_number'])) $update_data['vat_number'] 	= $post_data['vat_number'];

			if(!empty($post_data['bank_name'])) $update_data['bank_name'] 	= $post_data['bank_name'];

			if(!empty($post_data['iban'])) $update_data['iban'] 	= $post_data['iban'];

			$response=$this->custom_model->my_update($update_data,array('id' => $this->uid),'admin_users');
			if($response)
			{
				echo "success"; die;
			}else{
				echo "something"; die;
			}
		}
		$user_data = $this->custom_model->my_where('admin_users',"*",array('id' =>$this->uid));
		$bank_details = $this->custom_model->get_data_array("SELECT * FROM bank_details Order by bank_name asc ");
		$city_list = $this->custom_model->get_data_array("SELECT * FROM city_list Order by city_name asc ");
		$state_list = $this->custom_model->get_data_array("SELECT * FROM state_list Order by state_name asc ");
		$postal_code_list = $this->custom_model->get_data_array("SELECT * FROM postal_code_list Order by id desc ");

		$this->mViewData['user_data']= $user_data;
		$this->mViewData['bank_details']= $bank_details;
		$this->mViewData['city_list']= $city_list;
		$this->mViewData['state_list']= $state_list;
		$this->mViewData['postal_code_list']= $postal_code_list;
		$this->Urender('account-info', 'udefault');
	}


	public function get_quotaion_data($quotation_list,$is_vender=false)
	{
		if(!empty($quotation_list))
		{
			$language= $this->uri->segment(1);
			if($language=='en')
			{
				$unit_list='unit_list';
				$category='category';
			}else{
				$unit_list='unit_list_trans';
				$category='category_trans';
			}

			foreach ($quotation_list as $ql_key => $qd_val)
			{

				$unit_data = $this->custom_model->my_where($unit_list,"id,unit_name",array('id' =>$qd_val['unit']));
				$quotation_list[$ql_key]['unit_name']=$unit_data[0]['unit_name'];

				$quotation_list[$ql_key]['created_date']=date('M-d-Y' ,strtotime($qd_val['created_date']));

				if($is_vender==true)
				{
					if($qd_val['seller_id']==0)
					{
						$quotation_list[$ql_key]['seller_id']=1;
					}
					$is_seller = $this->custom_model->my_where('admin_users',"id,first_name",array('id' =>$quotation_list[$ql_key]['seller_id']));
					$quotation_list[$ql_key]['seller_name']=$is_seller[0]['first_name'];

					$category_data = $this->custom_model->my_where($category,"id,display_name",array('id' =>$qd_val['category_id']));
					if(!empty($category_data))
					{
						$quotation_list[$ql_key]['category_name']=$category_data[0]['display_name'];
					}else{
						$quotation_list[$ql_key]['category_name']='';
					}
				}
			}
		}
		return $quotation_list;
	}


	public function upload_logo()
	{
		$post_data=$this->input->post();
		// echo "<pre>";
		// print_r($_FILES['name']);
		// die;
		if(isset($_FILES['name']['name']) && $_FILES['name']['name']!='')
		{
			$folder_name='admin/usersdata/';
			$logo = $this->uploads($_FILES['name'],$folder_name);
			if($logo!=false)
			{
				 $this->custom_model->my_update(array('logo'=>$logo),array('id' => $this->uid),'admin_users');
				echo json_encode(array("status"=>true,"message"=>"Image Upload Successfully","logo"=>$logo)); die;
			}else{
				echo json_encode(array("status"=>false,"message"=>"Please Select Valid Image")); die;
			}
		}else{
			echo json_encode(array("status"=>false,"message"=>"Please Select Valid Image")); die;
		}
	}

}
