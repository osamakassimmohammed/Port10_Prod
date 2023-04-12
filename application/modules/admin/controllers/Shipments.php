<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shipments extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
		$this->load->model('custom_model');
		$this->get_access_id();
	}

	public function index($rowno=0,$ajax='call',$serach='')
	{
		$language= $this->uri->segment(1);
		if($language=='en')
		{
			$err_msg1='Shipment List';
		}else{
			$err_msg1='قائمة العلامات التجارية';
		}

		$this->load->library('pagination');

   		$post_data = $this->input->post();

		if (!empty($post_data))
		{
			$rowno = $post_data['pagno'];
			$ajax 	= $post_data['ajax'];
			$serach = $post_data['serach'];
		}
		 // Row per page
    	$rowperpage = 25;
    	$page_no=0;

    	// Row position
    	if($rowno != 0){
    		$page_no=$rowno;
      		$rowno = ($rowno-1) * $rowperpage;
    	}

    	if($ajax=='call')
		{
			if($this->mUser->type=="suppler" || $this->mUser->type=="subsupplier")
			{
				$shipment_data = $this->custom_model->get_data_array("SELECT * FROM shipments WHERE seller_id=".$this->nmUser_id." ORDER BY id ASC limit $rowno,$rowperpage ");

				$shipment_count = $this->custom_model->get_data_array("SELECT COUNT(id) as shipment_count FROM shipments WHERE seller_id=".$this->nmUser_id." ORDER BY id ASC  ");
			}else{

				$shipment_data = $this->custom_model->get_data_array("SELECT shipments.*, seller.first_name FROM shipments INNER JOIN admin_users as seller ON shipments.seller_id=seller.id  ORDER BY shipments.id ASC limit $rowno,$rowperpage ");

				$shipment_count = $this->custom_model->get_data_array("SELECT COUNT(shipments.id) as shipment_count FROM shipments INNER JOIN admin_users as seller ON shipments.seller_id=seller.id ORDER BY shipments.id ASC ");
			}
   		}else
   		{
			if(empty($serach))
			{
				if($this->mUser->type=="suppler" || $this->mUser->type=="subsupplier")
				{
					$shipment_data = $this->custom_model->get_data_array("SELECT * FROM shipments WHERE seller_id=".$this->nmUser_id." ORDER BY id ASC limit $rowno,$rowperpage ");

					$shipment_count = $this->custom_model->get_data_array("SELECT COUNT(id) as shipment_count FROM shipments WHERE seller_id=".$this->nmUser_id." ORDER BY id ASC  ");
				}else{

					$shipment_data = $this->custom_model->get_data_array("SELECT shipments.*, seller.first_name FROM shipments INNER JOIN admin_users as seller ON shipments.seller_id=seller.id  ORDER BY shipments.id ASC limit $rowno,$rowperpage ");

					$shipment_count = $this->custom_model->get_data_array("SELECT COUNT(shipments.id) as shipment_count FROM shipments INNER JOIN admin_users as seller ON shipments.seller_id=seller.id ORDER BY shipments.id ASC ");
				}

			}
			else {

				if($this->mUser->type=="suppler" || $this->mUser->type=="subsupplier")
				{
					$shipment_data = $this->custom_model->get_data_array("SELECT * FROM shipments WHERE (brand_name LIKE '%$serach%' OR id LIKE '%$serach%') AND seller_id=".$this->nmUser_id." ORDER BY id ASC limit $rowno,$rowperpage ");

					$shipment_count = $this->custom_model->get_data_array("SELECT COUNT(id) as shipment_count FROM shipments WHERE (brand_name LIKE '%$serach%' OR id LIKE '%$serach%') AND seller_id=".$this->nmUser_id." ORDER BY id ASC  ");
				}else{

					$shipment_data = $this->custom_model->get_data_array("SELECT shipments.*, seller.first_name FROM shipments INNER JOIN admin_users as seller ON shipments.seller_id=seller.id WHERE shipments.brand_name LIKE '%$serach%' OR shipments.id LIKE '%$serach%' ORDER BY shipments.id ASC limit $rowno,$rowperpage ");

					$shipment_count = $this->custom_model->get_data_array("SELECT COUNT(shipments.id) as shipment_count FROM shipments INNER JOIN admin_users as seller ON shipments.seller_id=seller.id WHERE shipments.brand_name LIKE '%$serach%' OR shipments.id LIKE '%$serach%' ORDER BY shipments.id ASC   ");
				}
			}
		}

		// $shipment_data = $this->custom_model->get_data_array("SELECT * FROM shipments WHERE seller_id=".$this->nmUser_id." ORDER BY id ASC limit $rowno,$rowperpage ");

		// $shipment_count = $this->custom_model->get_data_array("SELECT COUNT(id) as shipment_count FROM shipments WHERE seller_id=".$this->nmUser_id." ORDER BY id ASC  ");

		// print_r($shipment_data);
		// exit();


		// if(!empty($blog_data))
		// {
		// 	foreach ($blog_data as $bd_key => $bd_val)
		// 	{
		// 		$blog_data[$bd_key]['created_date']=date('M-d-Y' ,strtotime($bd_val['created_date']));
		// 	}
		// }


		// echo "<pre>";
		// print_r($contact_request);
		// die;
		$config['base_url'] = base_url().'admin/shipment/index';
	    $config['use_page_numbers'] = TRUE;
	    $config['total_rows'] = $shipment_count[0]['shipment_count'];
	    $config['per_page'] = $rowperpage;
	    $config['page_query_string'] = FALSE;
	    $config['enable_query_strings'] = FALSE;
	    $config['reuse_query_string']  = FALSE;
	    $config['cur_page'] = $page_no;

	     // Initialize
	    $this->pagination->initialize($config);
	     // Initialize $data Array
	    $data['pagination'] = $this->pagination->create_links();
	    $data['result'] = $shipment_data;
	    $data['row'] = $rowno;
	    $data['total_rows'] = $shipment_count[0]['shipment_count'];
	    // $this->mViewData['pagination'] = $this->pagination->create_links();
	    // this for when page load
	    if($ajax =='call' && $rowno==0 && empty($post_data)){
	    	$this->mViewData['pagination'] = $this->pagination->create_links();
		}elseif($serach !='') {  // this for search button pagination
			echo json_encode($data);
 			exit;
		}else { // this for pagination-
 			echo json_encode($data);
 			exit;
		}

		// echo "<Pre>";
		// print_r($shipment_data);
		// die;
		$this->mPageTitle = $err_msg1;
		$this->mViewData['shipment_data'] = $shipment_data;
		$this->mViewData['seller_id'] = $this->nmUser_id;
		$this->render('shipment/shipment_list');

	}

	public function shipmentLabelIndex($rowno=0,$ajax='call',$serach='')
	{
		$language= $this->uri->segment(1);
		if($language=='en')
		{
			$err_msg1='Label List';
		}else{
			$err_msg1='قائمة العلامات التجارية';
		}

		$this->load->library('pagination');

   		$post_data = $this->input->post();

		if (!empty($post_data))
		{
			$rowno = $post_data['pagno'];
			$ajax 	= $post_data['ajax'];
			$serach = $post_data['serach'];
		}
		 // Row per page
    	$rowperpage = 25;
    	$page_no=0;

    	// Row position
    	if($rowno != 0){
    		$page_no=$rowno;
      		$rowno = ($rowno-1) * $rowperpage;
    	}

    	if($ajax=='call')
		{
			if($this->mUser->type=="suppler" || $this->mUser->type=="subsupplier")
			{
				$label_data = $this->custom_model->get_data_array("SELECT * FROM labels WHERE seller_id=".$this->nmUser_id." ORDER BY id ASC limit $rowno,$rowperpage ");

				$label_count = $this->custom_model->get_data_array("SELECT COUNT(id) as label_count FROM labels WHERE seller_id=".$this->nmUser_id." ORDER BY id ASC  ");
			}else{

				$label_data = $this->custom_model->get_data_array("SELECT labels.*, seller.first_name FROM labels INNER JOIN admin_users as seller ON labels.seller_id=seller.id  ORDER BY labels.id ASC limit $rowno,$rowperpage ");

				$label_count = $this->custom_model->get_data_array("SELECT COUNT(labels.id) as label_count FROM labels INNER JOIN admin_users as seller ON labels.seller_id=seller.id ORDER BY labels.id ASC ");
			}
   		}else
   		{
			if(empty($serach))
			{
				if($this->mUser->type=="suppler" || $this->mUser->type=="subsupplier")
				{
					$label_data = $this->custom_model->get_data_array("SELECT * FROM labels WHERE seller_id=".$this->nmUser_id." ORDER BY id ASC limit $rowno,$rowperpage ");

					$label_count = $this->custom_model->get_data_array("SELECT COUNT(id) as label_count FROM labels WHERE seller_id=".$this->nmUser_id." ORDER BY id ASC  ");
				}else{

					$label_data = $this->custom_model->get_data_array("SELECT labels.*, seller.first_name FROM labels INNER JOIN admin_users as seller ON labels.seller_id=seller.id  ORDER BY labels.id ASC limit $rowno,$rowperpage ");

					$label_count = $this->custom_model->get_data_array("SELECT COUNT(labels.id) as label_count FROM labels INNER JOIN admin_users as seller ON labels.seller_id=seller.id ORDER BY labels.id ASC ");
				}

			}
			else {

				if($this->mUser->type=="suppler" || $this->mUser->type=="subsupplier")
				{
					$label_data = $this->custom_model->get_data_array("SELECT * FROM labels WHERE (brand_name LIKE '%$serach%' OR id LIKE '%$serach%') AND seller_id=".$this->nmUser_id." ORDER BY id ASC limit $rowno,$rowperpage ");

					$label_count = $this->custom_model->get_data_array("SELECT COUNT(id) as label_count FROM labels WHERE (brand_name LIKE '%$serach%' OR id LIKE '%$serach%') AND seller_id=".$this->nmUser_id." ORDER BY id ASC  ");
				}else{

					$label_data = $this->custom_model->get_data_array("SELECT labels.*, seller.first_name FROM labels INNER JOIN admin_users as seller ON labels.seller_id=seller.id WHERE labels.brand_name LIKE '%$serach%' OR labels.id LIKE '%$serach%' ORDER BY labels.id ASC limit $rowno,$rowperpage ");

					$label_count = $this->custom_model->get_data_array("SELECT COUNT(labels.id) as label_count FROM labels INNER JOIN admin_users as seller ON labels.seller_id=seller.id WHERE labels.brand_name LIKE '%$serach%' OR labels.id LIKE '%$serach%' ORDER BY labels.id ASC   ");
				}
			}
		}

		// print_r($label_count);
		// die;
		// if(!empty($blog_data))
		// {
		// 	foreach ($blog_data as $bd_key => $bd_val)
		// 	{
		// 		$blog_data[$bd_key]['created_date']=date('M-d-Y' ,strtotime($bd_val['created_date']));
		// 	}
		// }


		// echo "<pre>";
		// print_r($contact_request);
		// die;
		$config['base_url'] = base_url().'admin/shipment/shipmentLabelIndex';
	    $config['use_page_numbers'] = TRUE;
	    $config['total_rows'] = $label_count[0]['label_count'];
	    $config['per_page'] = $rowperpage;
	    $config['page_query_string'] = FALSE;
	    $config['enable_query_strings'] = FALSE;
	    $config['reuse_query_string']  = FALSE;
	    $config['cur_page'] = $page_no;

	     // Initialize
	    $this->pagination->initialize($config);
	     // Initialize $data Array
	    $data['pagination'] = $this->pagination->create_links();
	    $data['result'] = $label_data;
	    $data['row'] = $rowno;
	    $data['total_rows'] = $label_count[0]['label_count'];
	    // $this->mViewData['pagination'] = $this->pagination->create_links();
	    // this for when page load
	    if($ajax =='call' && $rowno==0 && empty($post_data)){
	    	$this->mViewData['pagination'] = $this->pagination->create_links();
		}elseif($serach !='') {  // this for search button pagination
			echo json_encode($data);
 			exit;
		}else { // this for pagination-
 			echo json_encode($data);
 			exit;
		}

		// echo "<Pre>";
		// print_r($label_data);
		// die;
		$this->mPageTitle = $err_msg1;
		$this->mViewData['label_data'] = $label_data;
		$this->mViewData['seller_id'] = $this->nmUser_id;
		$this->render('shipment/shipment_label_list');

	}

	public function shipmentPickupIndex($rowno=0,$ajax='call',$serach='')
	{
		$language= $this->uri->segment(1);
		if($language=='en')
		{
			$err_msg1='Pickup List';
		}else{
			$err_msg1='قائمة العلامات التجارية';
		}

		$this->load->library('pagination');

   		$post_data = $this->input->post();

		if (!empty($post_data))
		{
			$rowno = $post_data['pagno'];
			$ajax 	= $post_data['ajax'];
			$serach = $post_data['serach'];
		}
		 // Row per page
    	$rowperpage = 25;
    	$page_no=0;

    	// Row position
    	if($rowno != 0){
    		$page_no=$rowno;
      		$rowno = ($rowno-1) * $rowperpage;
    	}

    	if($ajax=='call')
		{
			if($this->mUser->type=="suppler" || $this->mUser->type=="subsupplier")
			{
				$shipment_pickup_data = $this->custom_model->get_data_array("SELECT * FROM pickups WHERE seller_id=".$this->nmUser_id." ORDER BY id ASC limit $rowno,$rowperpage ");

				$shipment_pickup_count = $this->custom_model->get_data_array("SELECT COUNT(id) as shipment_pickup_count FROM pickups WHERE seller_id=".$this->nmUser_id." ORDER BY id ASC  ");
			}else{

				$shipment_pickup_data = $this->custom_model->get_data_array("SELECT pickups.*, seller.first_name FROM pickups INNER JOIN admin_users as seller ON pickups.seller_id=seller.id  ORDER BY pickups.id ASC limit $rowno,$rowperpage ");

				$shipment_pickup_count = $this->custom_model->get_data_array("SELECT COUNT(pickups.id) as shipment_pickup_count FROM pickups INNER JOIN admin_users as seller ON pickups.seller_id=seller.id ORDER BY pickups.id ASC ");
			}
   		}else
   		{
			if(empty($serach))
			{
				if($this->mUser->type=="suppler" || $this->mUser->type=="subsupplier")
				{
					$shipment_pickup_data = $this->custom_model->get_data_array("SELECT * FROM pickups WHERE seller_id=".$this->nmUser_id." ORDER BY id ASC limit $rowno,$rowperpage ");

					$shipment_pickup_count = $this->custom_model->get_data_array("SELECT COUNT(id) as shipment_pickup_count FROM pickups WHERE seller_id=".$this->nmUser_id." ORDER BY id ASC  ");
				}else{

					$shipment_pickup_data = $this->custom_model->get_data_array("SELECT pickups.*, seller.first_name FROM pickups INNER JOIN admin_users as seller ON pickups.seller_id=seller.id  ORDER BY pickups.id ASC limit $rowno,$rowperpage ");

					$shipment_pickup_count = $this->custom_model->get_data_array("SELECT COUNT(pickups.id) as shipment_pickup_count FROM pickups INNER JOIN admin_users as seller ON pickups.seller_id=seller.id ORDER BY pickups.id ASC ");
				}

			}
			else {

				if($this->mUser->type=="suppler" || $this->mUser->type=="subsupplier")
				{
					$shipment_pickup_data = $this->custom_model->get_data_array("SELECT * FROM pickups WHERE (pickups_name LIKE '%$serach%' OR id LIKE '%$serach%') AND seller_id=".$this->nmUser_id." ORDER BY id ASC limit $rowno,$rowperpage ");

					$shipment_pickup_count = $this->custom_model->get_data_array("SELECT COUNT(id) as shipment_pickup_count FROM pickups WHERE (pickups_name LIKE '%$serach%' OR id LIKE '%$serach%') AND seller_id=".$this->nmUser_id." ORDER BY id ASC  ");
				}else{

					$shipment_pickup_data = $this->custom_model->get_data_array("SELECT pickups.*, seller.first_name FROM pickups INNER JOIN admin_users as seller ON pickups.seller_id=seller.id WHERE pickups.pickups_name LIKE '%$serach%' OR pickups.id LIKE '%$serach%' ORDER BY pickups.id ASC limit $rowno,$rowperpage ");

					$shipment_pickup_count = $this->custom_model->get_data_array("SELECT COUNT(pickups.id) as shipment_pickup_count FROM pickups INNER JOIN admin_users as seller ON pickups.seller_id=seller.id WHERE pickups.pickups_name LIKE '%$serach%' OR pickups.id LIKE '%$serach%' ORDER BY pickups.id ASC   ");
				}
			}
		}


		// if(!empty($blog_data))
		// {
		// 	foreach ($blog_data as $bd_key => $bd_val)
		// 	{
		// 		$blog_data[$bd_key]['created_date']=date('M-d-Y' ,strtotime($bd_val['created_date']));
		// 	}
		// }


		// echo "<pre>";
		// print_r($contact_request);
		// die;
		$config['base_url'] = base_url().'admin/shipment/shipmentPickupIndex';
	    $config['use_page_numbers'] = TRUE;
	    $config['total_rows'] = $shipment_pickup_count[0]['shipment_pickup_count'];
	    $config['per_page'] = $rowperpage;
	    $config['page_query_string'] = FALSE;
	    $config['enable_query_strings'] = FALSE;
	    $config['reuse_query_string']  = FALSE;
	    $config['cur_page'] = $page_no;

	     // Initialize
	    $this->pagination->initialize($config);
	     // Initialize $data Array
	    $data['pagination'] = $this->pagination->create_links();
	    $data['result'] = $shipment_pickup_data;
	    $data['row'] = $rowno;
	    $data['total_rows'] = $shipment_pickup_count[0]['shipment_pickup_count'];
	    // $this->mViewData['pagination'] = $this->pagination->create_links();
	    // this for when page load
	    if($ajax =='call' && $rowno==0 && empty($post_data)){
	    	$this->mViewData['pagination'] = $this->pagination->create_links();
		}elseif($serach !='') {  // this for search button pagination
			echo json_encode($data);
 			exit;
		}else { // this for pagination-
 			echo json_encode($data);
 			exit;
		}

		// echo "<Pre>";
		// print_r($shipment_pickup_data);
		// die;
		$this->mPageTitle = $err_msg1;
		$this->mViewData['shipment_pickup_data'] = $shipment_pickup_data;
		$this->mViewData['seller_id'] = $this->nmUser_id;
		$this->render('shipment/shipment_pickup_list');

	}

	public function shipmentCreate()
	{

		$shipment_data = [];
		$language= $this->uri->segment(1);
		if($language=='en')
		{
			$err_msg1='Shipment created successfully';
			$err_msg2='Something went wrong';
			$err_msg3='Add Shipment';
		}else{
			$err_msg1='تم إنشاء المنتج بنجاح';
			$err_msg2='هناك خطأ ما';
			$err_msg3='أضف منتج';
		}

		$udata = $this->custom_model->my_where('admin_users_groups','*',array('user_id' => $this->mUser->id),array(),"","","","","",array(),"",false);

	     $user_details = $this->custom_model->my_where('admin_users','*',array('id' => $this->mUser->id),array(),"","","","","",array(),"",false);



		// echo "<pre>";
		$this->mViewData['udata'] = $udata;
		$this->mViewData['user_details'] = $user_details;


		$form = $this->form_builder->create_form('','','id="wizard_with_validation" class="wizard clearfix"');
		$post_data = $this->input->post();

		// print_r($post_data);die;
		if (!empty($post_data))
		{
			if($this->mUser->id!=1)
			{
				$post_data['seller_id'] = $this->mUser->id;
			}
			$post_data['price_select'] = 1;
			$post_data['update_date'] = date('Y-m-d');
			// Customize start


			$count = 0;
			// $count = $this->custom_model->record_count('product',array('product_name' => $post_data['product_name'],'country_name'=>'country1' ));
			// product dublicate
			// if ($count)
			// {
			// 	$this->system_message->set_error('Product Already present<br>Unable to Create Product.');
			// }
			// else
			// {

				if(!empty($post_data['seller_id']))
				{
					// $attribute = @$post_data['attribute'];
					// $attribute = @$post_data['attribute2'];
					// if(!empty($attribute))
					// {
					// 	$attribute=explode(",",$attribute);
					// }
					// $attribute_price = @$post_data['attribute_price'];
					// $attribute_sale_price = @$post_data['attribute_sale_price'];
					// $attribute_qty = @$post_data['attribute_qty'];
					// unset($post_data['attribute']);
					// unset($post_data['attribute_price']);
					// unset($post_data['attribute_sale_price']);
					// unset($post_data['attribute2']);
					// unset($post_data['attribute_id_size']);
					// unset($post_data['attribute_qty']);
					// if(isset($post_data['is_delivery_available']))
					// {
					// 	$post_data['is_delivery_available']=1;
					// }else{
					// 	$post_data['is_delivery_available']=0;
					// }

					// if(isset($post_data['is_sample_order']))
					// {
					// 	$post_data['is_sample_order']=1;
					// }else{
					// 	$post_data['is_sample_order']=0;
					// }
					// // if($post_data['price_select']==2)
					// // {
					// // 	unset($post_data['price']);
					// // 	unset($post_data['sale_price']);
					// // }
					// $post_data['image_gallery'] = trim($post_data['image_gallery'],',');

					// if(isset($post_data['customize_att']) && !empty($post_data['customize_att']))
					// {
					// 	$customize_att = $post_data['customize_att'];
					// 	unset($post_data['customize_att']);
					// }
					// // echo "<pre>";
					// // print_r($post_data);
					// // die;

					// $response = $this->custom_model->my_insert($post_data,'product');
					// // echo $this->db->last_query();
					// // die;
					// $this->custom_model->my_insert($post_data,'product_trans');

					// if (!empty($customize_att))
					// {
					// 	foreach ($customize_att as $askey => $asvalue)
					// 	{
					// 		$myArray = explode(',', $asvalue);

					// 		foreach ($myArray as $asdkey => $asdvalue)
					// 		{
					// 			if ($asdkey == 0)
					// 			{
					// 				$pcustomize_title_id = $asdvalue;
					// 				unset($asdvalue);
					// 			}
					// 			else
					// 			{
					// 				$c_data['pcustomize_title_id'] = $pcustomize_title_id;
					// 				$c_data['pcustomize_attribute_id'] = $asdvalue;
					// 				$c_data['pid'] = $response;
					// 				// print_r($c_data);
					// 				$this->custom_model->my_insert($c_data,'product_custimze_details');
					// 			}
					// 		}
					// 	}
					// }

					// //update attribute
					// if($post_data['price_select']==2){
					// 	if (!empty($attribute))
					// 	{
					// 		foreach ($attribute as $ak => $aval)
					// 		{
					// 			$size_id = $this->custom_model->my_where('attribute_item','a_id',array('id' => $aval));

					// 			// $this->custom_model->my_insert(['attribute_id' => $size_id[0]['a_id'], 'p_id' => $response, 'item_id' => $aval,'price'=>$attribute_price[$ak],'sale_price'=>$attribute_sale_price[$ak]], 'product_attribute');
					// 			$this->custom_model->my_insert(['attribute_id' => $size_id[0]['a_id'], 'p_id' => $response, 'item_id' => $aval,'price'=>$post_data['price'],'sale_price'=>$post_data['sale_price'],'qty'=>$attribute_qty[$ak]], 'product_attribute');
					// 		}
					// 	}
					// }


					// if ($response)
					// {
					// 	$this->system_message->set_success($err_msg1);
					// }
					// else
					// {
					// 	$this->system_message->set_error($err_msg2);
					// }
				}
				else{
					$this->system_message->set_error($err_msg2);
				}
				$shipment_data = $post_data;
				// echo "<pre>";
				// print_r($post_data);
				// exit();
				$this->getAWB($post_data);

				redirect($language.'/admin/shipments');
		}
		// echo "<pre>";
		// 		print_r($shipment_data);
		// 		exit();


		$category = $this->custom_model->my_where('category','*',array('status' => 'active','parent'=>'0'),array(),"parent","asc","","",array(),"");
		$this->mViewData['category'] = $category;

		$seller_orders = $this->custom_model->get_data_array("SELECT order_items.* FROM order_items WHERE seller_id=".$this->nmUser_id."");
		$this->mViewData['seller_orders'] = $seller_orders;


		//imp $this->mViewData['vendors'] = $this->custom_model->get_data("SELECT a.id,a.first_name FROM admin_users AS a JOIN admin_users_groups AS b ON a.id= b.user_id WHERE a.active= 1 AND b.group_id = 1 ");

		$groups = $this->ion_auth->groups()->result();
		unset($groups[0]);	// disable creation of "webmaster" account
		$this->mViewData['groups'] = $groups;
		$this->mPageTitle = $err_msg3;
		$this->mViewData['form'] = $form;

		// $attribute = $this->custom_model->get_data("SELECT * FROM attribute WHERE id='" );

		$attribute=array();
		//imp $attribute = $this->custom_model->get_data("SELECT * FROM attribute");
		// $attribute = json_decode( json_encode($attribute), true);
		// if (!empty($attribute))
		// {
		// 	foreach ($attribute as $key => $value)
		// 	{
		// 		$attribute_item = $this->custom_model->get_data("SELECT * FROM attribute_item WHERE `status`='1' AND  a_id = ".$value['id']);
		// 		$attribute_item = json_decode( json_encode($attribute_item), true);
		// 		$attribute[$key]['item'] = $attribute_item;
		// 	}

		// }

		$pcustomize_list=array();

		$brand_data = $this->custom_model->my_where('brand','*',array(),array());
		$unit_list = $this->custom_model->get_data_array("SELECT * FROM unit_list ORDER BY unit_name ASC ");

		$supplier_data = $this->custom_model->get_data_array("SELECT id,first_name FROM admin_users WHERE type='suppler' AND is_terminate='0' AND active='1' AND subs_status!='expired' AND is_email_verify='1' ORDER BY id ASC ");

		$city_list = $this->custom_model->get_data_array("SELECT * FROM city_list ORDER BY city_name ASC ");

		// echo "<pre>";
		// print_r($attribute);
		// die;


		$this->mViewData['attribute'] = $attribute;
		$this->mViewData['pcustomize_list'] = $pcustomize_list;
		$this->mViewData['brand_data'] = $brand_data;
		$this->mViewData['unit_list'] = $unit_list;
		$this->mViewData['supplier_data'] = $supplier_data;
		$this->mViewData['seller_id'] = $this->mUser->id;
		$this->mViewData['pack_arr'] = $this->get_packaging_type();
		$this->mViewData['req_loading_arr'] = $this->get_req_loading();
		// $this->mViewData['hazardous_arr'] = $this->get_hazardous();
		$this->mViewData['vehical_arr'] = $this->vehical_requirement();
		$this->mViewData['weight_unit_arr'] = $this->get_weight_unit();
		$this->mViewData['city_list'] = $city_list;

		$this->render('shipment/shipment_create');
	}

	public function getdataOrder($var = null)
	{

		$order_data=$this->db->get_where('order_items', array('order_no ' => $_POST['order_no']))->row_array();
		?>
		<div class="row">
			<div class="col-md-4"><ul>
			<li>Order no : <?= $order_data['order_no'] ?></li>
			<li>Trans_ref : <?= $order_data['trans_ref'] ?></li>
			<li>Product_name : <?= $order_data['product_name'] ?></li>
			<li>Quantity : <?= $order_data['quantity'] ?></li>
			<li>Price : <?= $order_data['price'] ?></li>
			</ul>
		</div>
			<div class="col-md-4">
			<ul>
			<li>Shipping cost : <?= $order_data['shipping_cost'] ?></li>
			<li>Sub total : <?= $order_data['sub_total'] ?></li>
			<li>Tax : <?= $order_data['tax'] ?></li>
			<li>Commision : <?= $order_data['commision'] ?></li>
			<li>Unit : <?= $order_data['unit'] ?></li>
		</ul>
			</div>
		</div>



		<?php
	}

	public function get_packaging_type()
	{
		$pack_arr=array();
		$pack_arr[0]="Boxes";
		$pack_arr[1]="Pallets";
		$pack_arr[2]="Others";
		return $pack_arr;
	}

	public function get_req_loading()
	{
		$req_loading_arr=array();
		$req_loading_arr[0]="Liftgate";
		$req_loading_arr[1]="Ramps";
		return $req_loading_arr;
	}

	public function vehical_requirement()
	{
		$vehical_arr=array();
		$vehical_arr[0]="Truck";
		$vehical_arr[1]="Refrigerator Truck";
		return $vehical_arr;
	}

	public function get_weight_unit()
	{
		$weight_unit_arr=array();
		$weight_unit_arr['T']="Tonne";
		$weight_unit_arr['KG']="Kilogram";
		$weight_unit_arr['G']="Gram";
		return $weight_unit_arr;
	}

	public function pickupCreate()
	{

		$language= $this->uri->segment(1);
		if($language=='en')
		{
			$err_msg1='Product created successfully';
			$err_msg2='Something went wrong';
			$err_msg3='Add Product';
		}else{
			$err_msg1='تم إنشاء المنتج بنجاح';
			$err_msg2='هناك خطأ ما';
			$err_msg3='أضف منتج';
		}

		$udata = $this->custom_model->my_where('admin_users_groups','*',array('user_id' => $this->mUser->id),array(),"","","","","",array(),"",false);

	     $user_details = $this->custom_model->my_where('admin_users','*',array('id' => $this->mUser->id),array(),"","","","","",array(),"",false);


		$this->mViewData['udata'] = $udata;
		$this->mViewData['user_details'] = $user_details;


		$form = $this->form_builder->create_form('','','id="wizard_with_validation" class="wizard clearfix"');
		$post_data = $this->input->post();


		if (!empty($post_data))
		{
			if($this->mUser->id!=1)
			{
				$post_data['seller_id'] = $this->mUser->id;
			}
			$post_data['price_select'] = 1;
			$post_data['update_date'] = date('Y-m-d');
			// Customize start

			// echo "<pre>";
			// print_r($post_data);
			// die;
			$count = 0;


				// if(!empty($post_data['seller_id']))
				// {
				// 	// $attribute = @$post_data['attribute'];
				// 	$attribute = @$post_data['attribute2'];
				// 	if(!empty($attribute))
				// 	{
				// 		$attribute=explode(",",$attribute);
				// 	}
				// 	$attribute_price = @$post_data['attribute_price'];
				// 	$attribute_sale_price = @$post_data['attribute_sale_price'];
				// 	$attribute_qty = @$post_data['attribute_qty'];
				// 	unset($post_data['attribute']);
				// 	unset($post_data['attribute_price']);
				// 	unset($post_data['attribute_sale_price']);
				// 	unset($post_data['attribute2']);
				// 	unset($post_data['attribute_id_size']);
				// 	unset($post_data['attribute_qty']);
				// 	if(isset($post_data['is_delivery_available']))
				// 	{
				// 		$post_data['is_delivery_available']=1;
				// 	}else{
				// 		$post_data['is_delivery_available']=0;
				// 	}

				// 	if(isset($post_data['is_sample_order']))
				// 	{
				// 		$post_data['is_sample_order']=1;
				// 	}else{
				// 		$post_data['is_sample_order']=0;
				// 	}
					// if($post_data['price_select']==2)
					// {
					// 	unset($post_data['price']);
					// 	unset($post_data['sale_price']);
					// }
					// $post_data['image_gallery'] = trim($post_data['image_gallery'],',');

					// if(isset($post_data['customize_att']) && !empty($post_data['customize_att']))
					// {
					// 	$customize_att = $post_data['customize_att'];
					// 	unset($post_data['customize_att']);
					// }
					// echo "<pre>";
					// print_r($post_data);
					// die;

					// $response = $this->custom_model->my_insert($post_data,'product');
					// echo $this->db->last_query();
					// die;
					// $this->custom_model->my_insert($post_data,'product_trans');

					// if (!empty($customize_att))
					// {
					// 	foreach ($customize_att as $askey => $asvalue)
					// 	{
					// 		$myArray = explode(',', $asvalue);

					// 		foreach ($myArray as $asdkey => $asdvalue)
					// 		{
					// 			if ($asdkey == 0)
					// 			{
					// 				$pcustomize_title_id = $asdvalue;
					// 				unset($asdvalue);
					// 			}
					// 			else
					// 			{
					// 				$c_data['pcustomize_title_id'] = $pcustomize_title_id;
					// 				$c_data['pcustomize_attribute_id'] = $asdvalue;
					// 				$c_data['pid'] = $response;
					// 				// print_r($c_data);
					// 				$this->custom_model->my_insert($c_data,'product_custimze_details');
					// 			}
					// 		}
					// 	}
					// }

					//update attribute
					// if($post_data['price_select']==2){
					// 	if (!empty($attribute))
					// 	{
					// 		foreach ($attribute as $ak => $aval)
					// 		{
					// 			$size_id = $this->custom_model->my_where('attribute_item','a_id',array('id' => $aval));

					// 			// $this->custom_model->my_insert(['attribute_id' => $size_id[0]['a_id'], 'p_id' => $response, 'item_id' => $aval,'price'=>$attribute_price[$ak],'sale_price'=>$attribute_sale_price[$ak]], 'product_attribute');
					// 			$this->custom_model->my_insert(['attribute_id' => $size_id[0]['a_id'], 'p_id' => $response, 'item_id' => $aval,'price'=>$post_data['price'],'sale_price'=>$post_data['sale_price'],'qty'=>$attribute_qty[$ak]], 'product_attribute');
					// 		}
					// 	}
					// }


				// 	if ($response)
				// 	{
				// 		$this->system_message->set_success($err_msg1);
				// 	}
				// 	else
				// 	{
				// 		$this->system_message->set_error($err_msg2);
				// 	}
				// }
				// else{
				// 	$this->system_message->set_error($err_msg2);
				// }

				$this->schedulePickUp($post_data);

			redirect($language.'/admin/shipments/shipmentPickupIndex');
		}

		$category = $this->custom_model->my_where('category','*',array('status' => 'active','parent'=>'0'),array(),"parent","asc","","",array(),"");
		$this->mViewData['category'] = $category;
		$seller_orders = $this->custom_model->get_data_array("SELECT order_items.* FROM order_items WHERE seller_id=".$this->nmUser_id."");

		$groups = $this->ion_auth->groups()->result();
		unset($groups[0]);	// disable creation of "webmaster" account
		$this->mViewData['groups'] = $groups;
		$this->mPageTitle = $err_msg3;
		$this->mViewData['form'] = $form;


		$attribute=array();


		$pcustomize_list=array();

		$brand_data = $this->custom_model->my_where('brand','*',array(),array());
		$unit_list = $this->custom_model->get_data_array("SELECT * FROM unit_list ORDER BY unit_name ASC ");

		$supplier_data = $this->custom_model->get_data_array("SELECT id,first_name FROM admin_users WHERE type='suppler' AND is_terminate='0' AND active='1' AND subs_status!='expired' AND is_email_verify='1' ORDER BY id ASC ");

		$city_list = $this->custom_model->get_data_array("SELECT * FROM city_list ORDER BY city_name ASC ");



		// $shipments = $this->db->get('shipments')->result_array();
		$this->mViewData['attribute'] = $attribute;
		$this->mViewData['pcustomize_list'] = $pcustomize_list;
		$this->mViewData['brand_data'] = $brand_data;
		$this->mViewData['unit_list'] = $unit_list;
		$this->mViewData['supplier_data'] = $supplier_data;
		$this->mViewData['seller_id'] = $this->mUser->id;
		$this->mViewData['vehical_arr'] = $this->vehical_requirement();
		$this->mViewData['seller_orders'] = $seller_orders;

		$this->mViewData['city_list'] = $city_list;

		$this->render('shipment/pickup_create');
	}

	public function getPickupOrder($var = null)
	{

		$order_data=$this->db->get_where('shipments', array('id  ' => $_POST['order_no']))->row_array();
		?>
		<div class="row">
			<div class="col-md-4"><ul>
			<li>Order no : <?= $order_data['order_id'] ?></li>
			<li>Air waybill number : <?= $order_data['air_waybill_number'] ?></li>
			<li>weight : <?= $order_data['weight'] ?></li>

			</ul>
		</div>

		</div>



		<?php
	}

	public function labelCreate()
	{

		$language= $this->uri->segment(1);
		if($language=='en')
		{
			$err_msg1='Product created successfully';
			$err_msg2='Something went wrong';
			$err_msg3='Add Product';
		}else{
			$err_msg1='تم إنشاء المنتج بنجاح';
			$err_msg2='هناك خطأ ما';
			$err_msg3='أضف منتج';
		}

		$udata = $this->custom_model->my_where('admin_users_groups','*',array('user_id' => $this->mUser->id),array(),"","","","","",array(),"",false);

	     $user_details = $this->custom_model->my_where('admin_users','*',array('id' => $this->mUser->id),array(),"","","","","",array(),"",false);

		// echo "<pre>";
		$this->mViewData['udata'] = $udata;
		$this->mViewData['user_details'] = $user_details;


		$form = $this->form_builder->create_form('','','id="wizard_with_validation" class="wizard clearfix"');
		$post_data = $this->input->post();


		if (!empty($post_data))
		{
			if($this->mUser->id!=1)
			{
				$post_data['seller_id'] = $this->mUser->id;
			}
			$post_data['price_select'] = 1;
			$post_data['update_date'] = date('Y-m-d');
			// Customize start

			// echo "<pre>";
			// print_r($post_data);
			// die;
			$count = 0;
			// $count = $this->custom_model->record_count('product',array('product_name' => $post_data['product_name'],'country_name'=>'country1' ));
			// product dublicate
			// if ($count)
			// {
			// 	$this->system_message->set_error('Product Already present<br>Unable to Create Product.');
			// }
			// else
			// {

				if(!empty($post_data['seller_id']))
				{
					// $attribute = @$post_data['attribute'];
					$attribute = @$post_data['attribute2'];
					if(!empty($attribute))
					{
						$attribute=explode(",",$attribute);
					}
					$attribute_price = @$post_data['attribute_price'];
					$attribute_sale_price = @$post_data['attribute_sale_price'];
					$attribute_qty = @$post_data['attribute_qty'];
					unset($post_data['attribute']);
					unset($post_data['attribute_price']);
					unset($post_data['attribute_sale_price']);
					unset($post_data['attribute2']);
					unset($post_data['attribute_id_size']);
					unset($post_data['attribute_qty']);
					if(isset($post_data['is_delivery_available']))
					{
						$post_data['is_delivery_available']=1;
					}else{
						$post_data['is_delivery_available']=0;
					}

					if(isset($post_data['is_sample_order']))
					{
						$post_data['is_sample_order']=1;
					}else{
						$post_data['is_sample_order']=0;
					}
					// if($post_data['price_select']==2)
					// {
					// 	unset($post_data['price']);
					// 	unset($post_data['sale_price']);
					// }
					$post_data['image_gallery'] = trim($post_data['image_gallery'],',');

					if(isset($post_data['customize_att']) && !empty($post_data['customize_att']))
					{
						$customize_att = $post_data['customize_att'];
						unset($post_data['customize_att']);
					}
					// echo "<pre>";
					// print_r($post_data);
					// die;

					$response = $this->custom_model->my_insert($post_data,'product');
					// echo $this->db->last_query();
					// die;
					$this->custom_model->my_insert($post_data,'product_trans');

					if (!empty($customize_att))
					{
						foreach ($customize_att as $askey => $asvalue)
						{
							$myArray = explode(',', $asvalue);

							foreach ($myArray as $asdkey => $asdvalue)
							{
								if ($asdkey == 0)
								{
									$pcustomize_title_id = $asdvalue;
									unset($asdvalue);
								}
								else
								{
									$c_data['pcustomize_title_id'] = $pcustomize_title_id;
									$c_data['pcustomize_attribute_id'] = $asdvalue;
									$c_data['pid'] = $response;
									// print_r($c_data);
									$this->custom_model->my_insert($c_data,'product_custimze_details');
								}
							}
						}
					}

					//update attribute
					if($post_data['price_select']==2){
						if (!empty($attribute))
						{
							foreach ($attribute as $ak => $aval)
							{
								$size_id = $this->custom_model->my_where('attribute_item','a_id',array('id' => $aval));

								// $this->custom_model->my_insert(['attribute_id' => $size_id[0]['a_id'], 'p_id' => $response, 'item_id' => $aval,'price'=>$attribute_price[$ak],'sale_price'=>$attribute_sale_price[$ak]], 'product_attribute');
								$this->custom_model->my_insert(['attribute_id' => $size_id[0]['a_id'], 'p_id' => $response, 'item_id' => $aval,'price'=>$post_data['price'],'sale_price'=>$post_data['sale_price'],'qty'=>$attribute_qty[$ak]], 'product_attribute');
							}
						}
					}


					if ($response)
					{
						$this->system_message->set_success($err_msg1);
					}
					else
					{
						$this->system_message->set_error($err_msg2);
					}
				}
				else{
					$this->system_message->set_error($err_msg2);
				}
			// }
			refresh();
		}

		// multi vender comment
		// if( $udata[0]['group_id'] == 5 ){
		// 	$usrdata = $this->custom_model->my_where('admin_users','*',array('id' => $this->mUser->id),array(),"","","","",array(),"",false);
		// 	$catdslug = $usrdata[0]['category'];
		// }
		// $acategories = $this->custom_model->my_where('category','*',array('status' => 'active'),array(),"parent","asc","","",array(),"object");

		// $acatp = array();
		// if(!empty($acategories)){
		// 	foreach ($acategories as $ckey => $cvalue) {
		// 		$parent = $cvalue->parent;
		// 		$acatp[$parent][] = $cvalue;
		// 	}
		// }
		// if( $udata[0]['group_id'] == 5 ){
		// 	foreach ($acatp[0] as $ckey => $cvalue) {
		// 		if( $catdslug != $cvalue->slug ){
		// 			unset($acatp[0][$ckey]);
		// 		}
		// 	}
		// }

		// $this->mViewData['acatp'] = $acatp;

		$category = $this->custom_model->my_where('category','*',array('status' => 'active','parent'=>'0'),array(),"parent","asc","","",array(),"");
		$this->mViewData['category'] = $category;
		// $sub_cat = $this->custom_model->get_data_array("SELECT * FROM category WHERE `parent` = '1'  ");
		// $this->mViewData['sub_cat'] = $sub_cat;


		//imp $this->mViewData['vendors'] = $this->custom_model->get_data("SELECT a.id,a.first_name FROM admin_users AS a JOIN admin_users_groups AS b ON a.id= b.user_id WHERE a.active= 1 AND b.group_id = 1 ");

		$groups = $this->ion_auth->groups()->result();
		unset($groups[0]);	// disable creation of "webmaster" account
		$this->mViewData['groups'] = $groups;
		$this->mPageTitle = $err_msg3;
		$this->mViewData['form'] = $form;

		// $attribute = $this->custom_model->get_data("SELECT * FROM attribute WHERE id='" );

		$attribute=array();
		//imp $attribute = $this->custom_model->get_data("SELECT * FROM attribute");
		// $attribute = json_decode( json_encode($attribute), true);
		// if (!empty($attribute))
		// {
		// 	foreach ($attribute as $key => $value)
		// 	{
		// 		$attribute_item = $this->custom_model->get_data("SELECT * FROM attribute_item WHERE `status`='1' AND  a_id = ".$value['id']);
		// 		$attribute_item = json_decode( json_encode($attribute_item), true);
		// 		$attribute[$key]['item'] = $attribute_item;
		// 	}

		// }

		$pcustomize_list=array();
		//imp $pcustomize_list = $this->custom_model->my_where('pcustomize_title','*',array('status' => '1','delete_status'=>'0'),array());
		// if (!empty($pcustomize_list)) {
		// 	foreach ($pcustomize_list as $dkey => $dvalue) {
		// 		$cut_id = $dvalue['id'];
		// 		$cus_attribute = $this->custom_model->get_data_array("SELECT name,id,price FROM pcustomize_attribute WHERE `pcus_id`='$cut_id' AND  `delete_status` = '0' ");

		// 		$pcustomize_list[$dkey]['sub_attri'] = $cus_attribute;

		// 	}
		// }
		$brand_data = $this->custom_model->my_where('brand','*',array(),array());
		$unit_list = $this->custom_model->get_data_array("SELECT * FROM unit_list ORDER BY unit_name ASC ");

		$supplier_data = $this->custom_model->get_data_array("SELECT id,first_name FROM admin_users WHERE type='suppler' AND is_terminate='0' AND active='1' AND subs_status!='expired' AND is_email_verify='1' ORDER BY id ASC ");

		$city_list = $this->custom_model->get_data_array("SELECT * FROM city_list ORDER BY city_name ASC ");

		// echo "<pre>";
		// print_r($attribute);
		// die;


		$this->mViewData['attribute'] = $attribute;
		$this->mViewData['pcustomize_list'] = $pcustomize_list;
		$this->mViewData['brand_data'] = $brand_data;
		$this->mViewData['unit_list'] = $unit_list;
		$this->mViewData['supplier_data'] = $supplier_data;
		$this->mViewData['seller_id'] = $this->mUser->id;
		// $this->mViewData['pack_arr'] = $this->get_packaging_type();
		// $this->mViewData['req_loading_arr'] = $this->get_req_loading();
		// $this->mViewData['hazardous_arr'] = $this->get_hazardous();
		// $this->mViewData['vehical_arr'] = $this->vehical_requirement();
		// $this->mViewData['weight_unit_arr'] = $this->get_weight_unit();
		$this->mViewData['city_list'] = $city_list;

		$this->render('shipment/label_create');
	}

	public function edit($cate_id)
	{
		$language= $this->uri->segment(1);
		if($language=='en')
		{
			$err_msg1='Brand edited successfully';
			$err_msg2='Something went wrong';
			$err_msg3='Please enter new brand name this brand name already exists';
			$err_msg4='Please enter brand name';
		}else{
			$err_msg1='تم إنشاء العلامة التجارية بنجاح';
			$err_msg2='هناك خطأ ما';
			$err_msg3='الرجاء إدخال اسم علامة تجارية جديدة. هذا الاسم مسجل مسبقاً.';
			$err_msg4='تم تعديل العلامة التجارية بنجاح';
		}
		$form = $this->form_builder->create_form();
		$post_data = $this->input->post();

		if ( !empty($post_data) )
		{
			//strtolower()
			$post_data['brand_name']=trim($post_data['brand_name']);
			if(!empty($post_data['brand_name']))
			{

				$is_brand = $this->custom_model->my_where('brand','*',array('id!=' => $cate_id,'brand_name' => $post_data['brand_name'],'seller_id'=>$this->nmUser_id));
				if(empty($is_brand))
				{
					// proceed to create Category
					$response = $this->custom_model->my_update($post_data,array('id' => $cate_id),'brand');

					if ($response)
					{
						// success
						$this->system_message->set_success($err_msg1);
					}
					else
					{
						// failed
						$this->system_message->set_error($err_msg2);
					}
				}else{
					$this->system_message->set_error($err_msg3);
				}
			}else{
				$this->system_message->set_error($err_msg4);
			}

			refresh();
		}

		$cate_data = $this->custom_model->my_where('brand','*',array('id' => $cate_id));
		// echo "<pre>";
		// print_r($cate_data);
		// die;
		$this->mViewData['edit'] = $cate_data[0];
		$this->mPageTitle = 'Edit Brand';
		$this->mViewData['form'] = $form;
		$this->render('brand/create');
	}


	public function tedit($cate_id)
	{
		$language= $this->uri->segment(1);
		if($language=='en')
		{
			$err_msg1='Brand edited successfully';
			$err_msg2='Something went wrong';
			$err_msg3='Please enter new brand name this brand name already exists';
			$err_msg4='Please enter brand name';
		}else{
			$err_msg1='تم إنشاء العلامة التجارية بنجاح';
			$err_msg2='هناك خطأ ما';
			$err_msg3='الرجاء إدخال اسم علامة تجارية جديدة. هذا الاسم مسجل مسبقاً.';
			$err_msg4='تم تعديل العلامة التجارية بنجاح';
		}
		$form = $this->form_builder->create_form();
		$post_data = $this->input->post();

		if ( !empty($post_data) )
		{
			// strtolower()
			$post_data['brand_name']=trim($post_data['brand_name']);
			if(!empty($post_data['brand_name']))
			{

				$is_brand = $this->custom_model->my_where('brand_trans','*',array('id!=' => $cate_id,'brand_name' => $post_data['brand_name'],'seller_id'=>$this->nmUser_id));
				if(empty($is_brand))
				{
					// proceed to create Category
					$response = $this->custom_model->my_update($post_data,array('id' => $cate_id),'brand_trans');

					if ($response)
					{
						// success
						$this->system_message->set_success($err_msg1);
					}
					else
					{
						// failed
						$this->system_message->set_error($err_msg2);
					}
				}else{
					$this->system_message->set_error($err_msg3);
				}
			}else{
				$this->system_message->set_error($err_msg4);
			}

			refresh();
		}

		$cate_data = $this->custom_model->my_where('brand_trans','*',array('id' => $cate_id));
		$this->mViewData['edit'] = $cate_data[0];
		$this->mPageTitle = 'TEdit Brand';
		$this->mViewData['form'] = $form;
		$this->render('brand/create');
	}
	public function detete_brand()
    {
    	$post_data=$this->input->post();
    	if(!empty($post_data))
    	{
    		$pid=$post_data['pid'];
    		$this->custom_model->my_delete(['id' => $pid], 'brand');
    		$this->custom_model->my_delete(['id' => $pid], 'brand_trans');
    		echo 1;
    		die;
    	}else {
    		echo 0;
    		die;
    	}
    }

	public function getAWB(array $orders)
	{
		// echo "<pre>";
		// print_r($orders);
		$order_id = $orders['seller_orders'];
    //    print_r($order_id);die;
		$order_data = $this->custom_model->get_data_array("SELECT order_master.*  FROM order_master WHERE order_master_id= $order_id  Order BY order_master_id ");

		$seller_id = $this->custom_model->get_data_array("SELECT order_items.* FROM order_items WHERE order_no= $order_id");
		// print_r($seller_id);die;
		$admin_user_id = ($seller_id[0]['seller_id']);


		$pickupDetails = $this->custom_model->get_data_array("SELECT admin_users.* FROM admin_users WHERE id = $admin_user_id");

		$seller_data = $pickupDetails;

		$shipping_date_time = date('y-m-d H:i:s', strtotime($orders['ShippingDateTime']));
		$due_date = date('y-m-d H:i:s', strtotime($orders['DueDate']));
		// print_r($shipping_date_time);
		// exit();
		$is_order = $order_data;
		$order_items = $seller_id;
		$post_data = [
			'ShippingDateTime' => $shipping_date_time,
			'DueDate' => $due_date,
			'seller_order' => $orders['seller_orders'],
			'status' => $orders['status'],
			'created_by' => $this->nmUser_id,
			'Shipment_Reference_Note' => $orders['Shipment_Reference_Note'],
			'Transaction_Reference_Note' => $orders['Transaction_Reference_Note'],
		];

		$this->load->library('shipping_lib');
		$rate_info=$this->shipping_lib->create_shipments($order_items,$is_order,$seller_data,$post_data);
		$shipmentDetails = json_encode( $rate_info );
	}

	public function schedulePickUp(array $orders)
	{
		$order_id = $orders['seller_orders'];

		$order_data = $this->custom_model->get_data_array("SELECT order_master.*  FROM order_master WHERE order_master_id= $order_id  Order BY order_master_id ");

		$seller_id = $this->custom_model->get_data_array("SELECT order_items.* FROM order_items WHERE order_no= $order_id");
		$admin_user_id = ($seller_id[0]['seller_id']);

		$pickupDetails = $this->custom_model->get_data_array("SELECT admin_users.* FROM admin_users WHERE id = $admin_user_id");

		$seller_data = $pickupDetails;

		// $shipping_date_time = date('d-m-y H:i:s', strtotime($orders['ShippingDateTime']));
		// $due_date = date('d-m-y H:i:s', strtotime($orders['DueDate']));
		$shipping_date_time = date('y-m-d H:i:s', strtotime($orders['ShippingDateTime']));
		$due_date = date('y-m-d H:i:s', strtotime($orders['DueDate']));
		$pickup_date = date('y-m-d H:i:s', strtotime($orders['PickupDate']));
		$ready_time = date('y-m-d H:i:s', strtotime($orders['ReadyTime']));
		$last_pickup_time = date('y-m-d H:i:s', strtotime($orders['LastPickupTime']));
		$closing_time = date('y-m-d H:i:s', strtotime($orders['ClosingTime']));


		$is_order = $order_data;
		$order_items = $seller_id;
		$post_data = [
			'ShippingDateTime' => $shipping_date_time,
			'DueDate' => $due_date,
			'PickupDate' => $pickup_date,
			'ReadyTime' => $ready_time,
			'LastPickupTime' => $last_pickup_time,
			'ClosingTime' => $closing_time,
			'seller_order' => $orders['seller_orders'],
			'status' => $orders['status'],
			'created_by' => $this->nmUser_id,
			// 'Shipment_Reference_Note' => $orders['Shipment_Reference_Note'],
			// 'Transaction_Reference_Note' => $orders['Transaction_Reference_Note'],
		];

		// print_r($post_data);
		// exit();

		$this->load->library('shipping_lib');
		$rate_info=$this->shipping_lib->create_pickup($order_items,$is_order,$seller_data,$post_data);
		$shipmentDetails = json_encode( $rate_info );
	}
	// shipments/get_seller_orders
	public function get_seller_orders()
    {

		$level = $this->input->post('level');


        $post_data = $this->input->post();
		if(!empty($post_data))
		{
			// echo "<pre>";
			// print_r($post_data);die;
			$seller_orders = $this->custom_model->get_data_array("SELECT order_items.* FROM order_items WHERE seller_id=".$level."");
			if(!empty($seller_orders))
			{
				echo json_encode($seller_orders);
				die;
			}else {
				echo "not_found";
				die;
			}
			// echo "<pre>";
			// print_r($category);
			// die;
		}else {
			echo 0;
			die;
		}

    }
}
?>
