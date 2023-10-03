<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vorders extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
		$this->load->model('custom_model');	
		$this->get_access_id();		
	}

	public function index()
    {
		//print_r($this->mUser);die;
		// $udata = $this->custom_model->my_where('admin_users','*',array('id' => $this->mUser->id),array(),"","","","","",array(),"",false);
		$rowno=0;
		$ajax='call';
		$serach='';	
		$seller_id = $this->nmUser_id;
		$sub_query='';
		$this->load->library('pagination');  

   		$post_data = $this->input->post();

		if (!empty($post_data))
		{
			$rowno = $post_data['pagno'];
			$ajax 	= $post_data['ajax'];
			$serach = $post_data['serach'];
			$order_status = $post_data['order_status'];

			if(!empty($order_status))
			{
				if($order_status!='all')
				{
					if($order_status=='new')
					{
						$now = date('Y-m-d' ,strtotime('today'));
						$sub_query.=" AND invoice.created_date LIKE '%$now%' ";
					}else{
						$sub_query.=" AND invoice.order_status='$order_status' ";	
					}
				}				
			}
		}		
		 // Row per page
    	$rowperpage = 10;
    	$page_no=0;

    	// Row position
    	if($rowno != 0){
    		$page_no=$rowno;
      		$rowno = ($rowno-1) * $rowperpage;
    	}
    	if($ajax=='call')
		{   			
			
			$orders = $this->custom_model->get_data_array("SELECT invoice.invoice_id,invoice.order_no,invoice.item_ids,invoice.payment_status,invoice.payment_mode,invoice.created_date,invoice.order_status,invoice.seller_id,invoice.net_total as in_net_total,invoice.sub_total as in_sub_total,master.display_order_id,master.first_name,master.last_name,master.mobile_no,master.email,master.country,master.city,master.state,master.pincode,master.address_1,master.currency,master.order_datetime FROM order_invoice as invoice INNER JOIN order_master as master ON invoice.order_no = master.order_master_id  WHERE invoice.seller_id='$seller_id'  $sub_query ORDER BY invoice.invoice_id DESC limit $rowno,$rowperpage ");

			$orders_count = $this->custom_model->get_data_array("SELECT invoice.invoice_id FROM order_invoice as invoice INNER JOIN order_master as master ON invoice.order_no = master.order_master_id  WHERE invoice.seller_id='$seller_id'  $sub_query ORDER BY invoice.invoice_id DESC  ");
   		}else 
   		{
			if(empty($serach))
			{
				$orders = $this->custom_model->get_data_array("SELECT invoice.invoice_id,invoice.order_no,invoice.item_ids,invoice.payment_status,invoice.payment_mode,invoice.created_date,invoice.order_status,invoice.seller_id,invoice.net_total as in_net_total,invoice.sub_total as in_sub_total,master.display_order_id,master.first_name,master.last_name,master.mobile_no,master.email,master.country,master.city,master.state,master.pincode,master.address_1,master.currency,master.order_datetime FROM order_invoice as invoice INNER JOIN order_master as master ON invoice.order_no = master.order_master_id  WHERE invoice.seller_id='$seller_id'  $sub_query ORDER BY invoice.invoice_id DESC limit $rowno,$rowperpage ");

				$orders_count = $this->custom_model->get_data_array("SELECT invoice.invoice_id FROM order_invoice as invoice INNER JOIN order_master as master ON invoice.order_no = master.order_master_id  WHERE invoice.seller_id='$seller_id'   $sub_query ORDER BY invoice.invoice_id DESC  ");
			}
			else {

				$orders = $this->custom_model->get_data_array("SELECT invoice.invoice_id,invoice.order_no,invoice.item_ids,invoice.payment_status,invoice.payment_mode,invoice.created_date,invoice.order_status,invoice.seller_id,invoice.net_total as in_net_total,invoice.sub_total as in_sub_total,master.display_order_id,master.first_name,master.last_name,master.mobile_no,master.email,master.country,master.city,master.state,master.pincode,master.address_1,master.currency,master.order_datetime FROM order_invoice as invoice INNER JOIN order_master as master ON invoice.order_no = master.order_master_id  WHERE ( invoice.invoice_id LIKE '%$serach%' OR invoice.order_no LIKE '%$serach%' OR invoice.payment_status LIKE '%$serach%' OR invoice.order_status LIKE '%$serach%' OR invoice.net_total LIKE '%$serach%' OR invoice.sub_total LIKE '%$serach%' OR master.first_name LIKE '%$serach%' OR master.last_name LIKE '%$serach%' OR master.mobile_no LIKE '%$serach%' OR master.email LIKE '%$serach%' OR master.display_order_id LIKE '%$serach%') AND invoice.seller_id='$seller_id'  $sub_query ORDER BY invoice.invoice_id DESC limit $rowno,$rowperpage ");

				$orders_count = $this->custom_model->get_data_array("SELECT invoice.invoice_id FROM order_invoice as invoice INNER JOIN order_master as master ON invoice.order_no = master.order_master_id  WHERE ( invoice.invoice_id LIKE '%$serach%' OR invoice.order_no LIKE '%$serach%' OR invoice.payment_status LIKE '%$serach%' OR invoice.order_status LIKE '%$serach%' OR invoice.net_total LIKE '%$serach%' OR invoice.sub_total LIKE '%$serach%' OR master.first_name LIKE '%$serach%' OR master.last_name LIKE '%$serach%' OR master.mobile_no LIKE '%$serach%' OR master.email LIKE '%$serach%' OR master.display_order_id LIKE '%$serach%') AND invoice.seller_id='$seller_id'  $sub_query ORDER BY invoice.invoice_id DESC ");			
			}
		}		


		$config['base_url'] = base_url().'admin/product/index';
	    $config['use_page_numbers'] = TRUE;
	    $config['total_rows'] = count($orders_count);
	    $config['per_page'] = $rowperpage;   
	    $config['page_query_string'] = FALSE;             
	    $config['enable_query_strings'] = FALSE;             
	    $config['reuse_query_string']  = FALSE;             
	    $config['cur_page'] = $page_no;  
	    
	     // Initialize
	    $this->pagination->initialize($config);
	     // Initialize $data Array
	    $data['pagination'] = $this->pagination->create_links();
	    $data['result'] = $orders;
	    $data['row'] = $rowno;
	    $data['total_rows'] = count($orders_count);
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

		// echo "<pre>";
		// print_r($orders);
		// die;
	    $this->mViewData['orders'] = $orders; 	    
	    $this->mPageTitle = ' Order Invoice';	    
	    $this->render('vorders/list');
	}

	public function pending_order()
    {
		//print_r($this->mUser);die;
		// $udata = $this->custom_model->my_where('admin_users','*',array('id' => $this->nmUser_id),array(),"","","","","",array(),"",false);
		$rowno=0;
		$ajax='call';
		$serach='';	
		$seller_id = $this->nmUser_id;

		$this->load->library('pagination');  

   		$post_data = $this->input->post();

		if (!empty($post_data))
		{
			$rowno = $post_data['pagno'];
			$ajax 	= $post_data['ajax'];
			$serach = $post_data['serach'];
		}		
		 // Row per page
    	$rowperpage = 10;
    	$page_no=0;

    	// Row position
    	if($rowno != 0){
    		$page_no=$rowno;
      		$rowno = ($rowno-1) * $rowperpage;
    	}
    	if($ajax=='call')
		{   			
			
			$orders = $this->custom_model->get_data_array("SELECT invoice.invoice_id,invoice.order_no,invoice.item_ids,invoice.payment_status,invoice.payment_mode,invoice.created_date,invoice.order_status,invoice.seller_id,invoice.net_total as in_net_total,invoice.sub_total as in_sub_total,master.display_order_id,master.first_name,master.last_name,master.mobile_no,master.email,master.country,master.city,master.state,master.pincode,master.address_1,master.currency,master.order_datetime FROM order_invoice as invoice INNER JOIN order_master as master ON invoice.order_no = master.order_master_id  WHERE invoice.seller_id='$seller_id'  AND invoice.order_status='Pending' ORDER BY invoice.invoice_id DESC limit $rowno,$rowperpage ");

			$orders_count = $this->custom_model->get_data_array("SELECT invoice.invoice_id FROM order_invoice as invoice INNER JOIN order_master as master ON invoice.order_no = master.order_master_id  WHERE invoice.seller_id='$seller_id'  AND invoice.order_status='Pending' ORDER BY invoice.invoice_id DESC  ");
   		}else 
   		{
			if(empty($serach))
			{
				$orders = $this->custom_model->get_data_array("SELECT invoice.invoice_id,invoice.order_no,invoice.item_ids,invoice.payment_status,invoice.payment_mode,invoice.created_date,invoice.order_status,invoice.seller_id,invoice.net_total as in_net_total,invoice.sub_total as in_sub_total,master.display_order_id,master.first_name,master.last_name,master.mobile_no,master.email,master.country,master.city,master.state,master.pincode,master.address_1,master.currency,master.order_datetime FROM order_invoice as invoice INNER JOIN order_master as master ON invoice.order_no = master.order_master_id  WHERE invoice.seller_id='$seller_id'  AND invoice.order_status='Pending' ORDER BY invoice.invoice_id DESC limit $rowno,$rowperpage ");

				$orders_count = $this->custom_model->get_data_array("SELECT invoice.invoice_id FROM order_invoice as invoice INNER JOIN order_master as master ON invoice.order_no = master.order_master_id  WHERE invoice.seller_id='$seller_id'  AND invoice.order_status='Pending' ORDER BY invoice.invoice_id DESC  ");
			}
			else {

				$orders = $this->custom_model->get_data_array("SELECT invoice.invoice_id,invoice.order_no,invoice.item_ids,invoice.payment_status,invoice.payment_mode,invoice.created_date,invoice.order_status,invoice.seller_id,invoice.net_total as in_net_total,invoice.sub_total as in_sub_total,master.display_order_id,master.first_name,master.last_name,master.mobile_no,master.email,master.country,master.city,master.state,master.pincode,master.address_1,master.currency,master.order_datetime FROM order_invoice as invoice INNER JOIN order_master as master ON invoice.order_no = master.order_master_id  WHERE ( invoice.invoice_id LIKE '%$serach%' OR invoice.order_no LIKE '%$serach%' OR invoice.payment_status LIKE '%$serach%' OR invoice.order_status LIKE '%$serach%' OR invoice.net_total LIKE '%$serach%' OR invoice.sub_total LIKE '%$serach%' OR master.first_name LIKE '%$serach%' OR master.last_name LIKE '%$serach%' OR master.mobile_no LIKE '%$serach%' OR master.email LIKE '%$serach%' OR master.display_order_id LIKE '%$serach%') AND invoice.seller_id='$seller_id'  AND invoice.order_status='Pending' ORDER BY invoice.invoice_id DESC limit $rowno,$rowperpage ");

				$orders_count = $this->custom_model->get_data_array("SELECT invoice.invoice_id FROM order_invoice as invoice INNER JOIN order_master as master ON invoice.order_no = master.order_master_id  WHERE ( invoice.invoice_id LIKE '%$serach%' OR invoice.order_no LIKE '%$serach%' OR invoice.payment_status LIKE '%$serach%' OR invoice.order_status LIKE '%$serach%' OR invoice.net_total LIKE '%$serach%' OR invoice.sub_total LIKE '%$serach%' OR master.first_name LIKE '%$serach%' OR master.last_name LIKE '%$serach%' OR master.mobile_no LIKE '%$serach%' OR master.email LIKE '%$serach%' OR master.display_order_id LIKE '%$serach%') AND invoice.seller_id='$seller_id'  AND invoice.order_status='Pending' ORDER BY invoice.invoice_id DESC ");			
			}
		}		


		$config['base_url'] = base_url().'admin/product/index';
	    $config['use_page_numbers'] = TRUE;
	    $config['total_rows'] = count($orders_count);
	    $config['per_page'] = $rowperpage;   
	    $config['page_query_string'] = FALSE;             
	    $config['enable_query_strings'] = FALSE;             
	    $config['reuse_query_string']  = FALSE;             
	    $config['cur_page'] = $page_no;  
	    
	     // Initialize
	    $this->pagination->initialize($config);
	     // Initialize $data Array
	    $data['pagination'] = $this->pagination->create_links();
	    $data['result'] = $orders;
	    $data['row'] = $rowno;
	    $data['total_rows'] = count($orders_count);
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

		// echo "<pre>";
		// print_r($orders);
		// die;
	    $this->mViewData['orders'] = $orders; 	    
	    $this->mPageTitle = ' Order Invoice';	    
	    $this->render('vorders/pending_order');
	}

	public function completed_order()
    {
		//print_r($this->mUser);die;
		// $udata = $this->custom_model->my_where('admin_users','*',array('id' => $this->nmUser_id),array(),"","","","","",array(),"",false);
		$rowno=0;
		$ajax='call';
		$serach='';	
		$seller_id = $this->nmUser_id;

		$this->load->library('pagination');  

   		$post_data = $this->input->post();

		if (!empty($post_data))
		{
			$rowno = $post_data['pagno'];
			$ajax 	= $post_data['ajax'];
			$serach = $post_data['serach'];
		}		
		 // Row per page
    	$rowperpage = 10;
    	$page_no=0;

    	// Row position
    	if($rowno != 0){
    		$page_no=$rowno;
      		$rowno = ($rowno-1) * $rowperpage;
    	}
    	if($ajax=='call')
		{   			
			
			$orders = $this->custom_model->get_data_array("SELECT invoice.invoice_id,invoice.order_no,invoice.item_ids,invoice.payment_status,invoice.payment_mode,invoice.created_date,invoice.order_status,invoice.seller_id,invoice.net_total as in_net_total,invoice.sub_total as in_sub_total,master.display_order_id,master.first_name,master.last_name,master.mobile_no,master.email,master.country,master.city,master.state,master.pincode,master.address_1,master.currency,master.order_datetime FROM order_invoice as invoice INNER JOIN order_master as master ON invoice.order_no = master.order_master_id  WHERE invoice.seller_id='$seller_id'  AND invoice.order_status='Delivered' ORDER BY invoice.invoice_id DESC limit $rowno,$rowperpage ");

			$orders_count = $this->custom_model->get_data_array("SELECT invoice.invoice_id FROM order_invoice as invoice INNER JOIN order_master as master ON invoice.order_no = master.order_master_id  WHERE invoice.seller_id='$seller_id'  AND invoice.order_status='Delivered' ORDER BY invoice.invoice_id DESC  ");
   		}else 
   		{
			if(empty($serach))
			{
				$orders = $this->custom_model->get_data_array("SELECT invoice.invoice_id,invoice.order_no,invoice.item_ids,invoice.payment_status,invoice.payment_mode,invoice.created_date,invoice.order_status,invoice.seller_id,invoice.net_total as in_net_total,invoice.sub_total as in_sub_total,master.display_order_id,master.first_name,master.last_name,master.mobile_no,master.email,master.country,master.city,master.state,master.pincode,master.address_1,master.currency,master.order_datetime FROM order_invoice as invoice INNER JOIN order_master as master ON invoice.order_no = master.order_master_id  WHERE invoice.seller_id='$seller_id'  AND invoice.order_status='Delivered' ORDER BY invoice.invoice_id DESC limit $rowno,$rowperpage ");

				$orders_count = $this->custom_model->get_data_array("SELECT invoice.invoice_id FROM order_invoice as invoice INNER JOIN order_master as master ON invoice.order_no = master.order_master_id  WHERE invoice.seller_id='$seller_id'  AND invoice.order_status='Delivered' ORDER BY invoice.invoice_id DESC  ");
			}
			else {

				$orders = $this->custom_model->get_data_array("SELECT invoice.invoice_id,invoice.order_no,invoice.item_ids,invoice.payment_status,invoice.payment_mode,invoice.created_date,invoice.order_status,invoice.seller_id,invoice.net_total as in_net_total,invoice.sub_total as in_sub_total,master.display_order_id,master.first_name,master.last_name,master.mobile_no,master.email,master.country,master.city,master.state,master.pincode,master.address_1,master.currency,master.order_datetime FROM order_invoice as invoice INNER JOIN order_master as master ON invoice.order_no = master.order_master_id  WHERE ( invoice.invoice_id LIKE '%$serach%' OR invoice.order_no LIKE '%$serach%' OR invoice.payment_status LIKE '%$serach%' OR invoice.order_status LIKE '%$serach%' OR invoice.net_total LIKE '%$serach%' OR invoice.sub_total LIKE '%$serach%' OR master.first_name LIKE '%$serach%' OR master.last_name LIKE '%$serach%' OR master.mobile_no LIKE '%$serach%' OR master.email LIKE '%$serach%' OR master.display_order_id LIKE '%$serach%') AND invoice.seller_id='$seller_id'  AND invoice.order_status='Delivered' ORDER BY invoice.invoice_id DESC limit $rowno,$rowperpage ");

				$orders_count = $this->custom_model->get_data_array("SELECT invoice.invoice_id FROM order_invoice as invoice INNER JOIN order_master as master ON invoice.order_no = master.order_master_id  WHERE ( invoice.invoice_id LIKE '%$serach%' OR invoice.order_no LIKE '%$serach%' OR invoice.payment_status LIKE '%$serach%' OR invoice.order_status LIKE '%$serach%' OR invoice.net_total LIKE '%$serach%' OR invoice.sub_total LIKE '%$serach%' OR master.first_name LIKE '%$serach%' OR master.last_name LIKE '%$serach%' OR master.mobile_no LIKE '%$serach%' OR master.email LIKE '%$serach%' OR master.display_order_id LIKE '%$serach%') AND invoice.seller_id='$seller_id'  AND invoice.order_status='Delivered' ORDER BY invoice.invoice_id DESC ");			
			}
		}		


		$config['base_url'] = base_url().'admin/product/index';
	    $config['use_page_numbers'] = TRUE;
	    $config['total_rows'] = count($orders_count);
	    $config['per_page'] = $rowperpage;   
	    $config['page_query_string'] = FALSE;             
	    $config['enable_query_strings'] = FALSE;             
	    $config['reuse_query_string']  = FALSE;             
	    $config['cur_page'] = $page_no;  
	    
	     // Initialize
	    $this->pagination->initialize($config);
	     // Initialize $data Array
	    $data['pagination'] = $this->pagination->create_links();
	    $data['result'] = $orders;
	    $data['row'] = $rowno;
	    $data['total_rows'] = count($orders_count);
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

		// echo "<pre>";
		// print_r($orders);
		// die;
	    $this->mViewData['orders'] = $orders; 	    
	    $this->mPageTitle = ' Order Invoice';	    
	    $this->render('vorders/completed_order');
	}

	public function cancel_order()
    {
		//print_r($this->mUser);die;
		// $udata = $this->custom_model->my_where('admin_users','*',array('id' => $this->nmUser_id),array(),"","","","","",array(),"",false);
		$rowno=0;
		$ajax='call';
		$serach='';	
		$seller_id = $this->nmUser_id;

		$this->load->library('pagination');  

   		$post_data = $this->input->post();

		if (!empty($post_data))
		{
			$rowno = $post_data['pagno'];
			$ajax 	= $post_data['ajax'];
			$serach = $post_data['serach'];
		}		
		 // Row per page
    	$rowperpage = 10;
    	$page_no=0;

    	// Row position
    	if($rowno != 0){
    		$page_no=$rowno;
      		$rowno = ($rowno-1) * $rowperpage;
    	}
    	if($ajax=='call')
		{   			
			
			$orders = $this->custom_model->get_data_array("SELECT invoice.invoice_id,invoice.order_no,invoice.item_ids,invoice.payment_status,invoice.payment_mode,invoice.created_date,invoice.order_status,invoice.seller_id,invoice.net_total as in_net_total,invoice.sub_total as in_sub_total,master.display_order_id,master.first_name,master.last_name,master.mobile_no,master.email,master.country,master.city,master.state,master.pincode,master.address_1,master.currency,master.order_datetime FROM order_invoice as invoice INNER JOIN order_master as master ON invoice.order_no = master.order_master_id  WHERE invoice.seller_id='$seller_id'  AND invoice.order_status='canceled' ORDER BY invoice.invoice_id DESC limit $rowno,$rowperpage ");

			$orders_count = $this->custom_model->get_data_array("SELECT invoice.invoice_id FROM order_invoice as invoice INNER JOIN order_master as master ON invoice.order_no = master.order_master_id  WHERE invoice.seller_id='$seller_id'  AND invoice.order_status='canceled' ORDER BY invoice.invoice_id DESC  ");
   		}else 
   		{
			if(empty($serach))
			{
				$orders = $this->custom_model->get_data_array("SELECT invoice.invoice_id,invoice.order_no,invoice.item_ids,invoice.payment_status,invoice.payment_mode,invoice.created_date,invoice.order_status,invoice.seller_id,invoice.net_total as in_net_total,invoice.sub_total as in_sub_total,master.display_order_id,master.first_name,master.last_name,master.mobile_no,master.email,master.country,master.city,master.state,master.pincode,master.address_1,master.currency,master.order_datetime FROM order_invoice as invoice INNER JOIN order_master as master ON invoice.order_no = master.order_master_id  WHERE invoice.seller_id='$seller_id'  AND invoice.order_status='canceled' ORDER BY invoice.invoice_id DESC limit $rowno,$rowperpage ");

				$orders_count = $this->custom_model->get_data_array("SELECT invoice.invoice_id FROM order_invoice as invoice INNER JOIN order_master as master ON invoice.order_no = master.order_master_id  WHERE invoice.seller_id='$seller_id'  AND invoice.order_status='canceled' ORDER BY invoice.invoice_id DESC  ");
			}
			else {

				$orders = $this->custom_model->get_data_array("SELECT invoice.invoice_id,invoice.order_no,invoice.item_ids,invoice.payment_status,invoice.payment_mode,invoice.created_date,invoice.order_status,invoice.seller_id,invoice.net_total as in_net_total,invoice.sub_total as in_sub_total,master.display_order_id,master.first_name,master.last_name,master.mobile_no,master.email,master.country,master.city,master.state,master.pincode,master.address_1,master.currency,master.order_datetime FROM order_invoice as invoice INNER JOIN order_master as master ON invoice.order_no = master.order_master_id  WHERE ( invoice.invoice_id LIKE '%$serach%' OR invoice.order_no LIKE '%$serach%' OR invoice.payment_status LIKE '%$serach%' OR invoice.order_status LIKE '%$serach%' OR invoice.net_total LIKE '%$serach%' OR invoice.sub_total LIKE '%$serach%' OR master.first_name LIKE '%$serach%' OR master.last_name LIKE '%$serach%' OR master.mobile_no LIKE '%$serach%' OR master.email LIKE '%$serach%' OR master.display_order_id LIKE '%$serach%') AND invoice.seller_id='$seller_id'  AND invoice.order_status='canceled' ORDER BY invoice.invoice_id DESC limit $rowno,$rowperpage ");

				$orders_count = $this->custom_model->get_data_array("SELECT invoice.invoice_id FROM order_invoice as invoice INNER JOIN order_master as master ON invoice.order_no = master.order_master_id  WHERE ( invoice.invoice_id LIKE '%$serach%' OR invoice.order_no LIKE '%$serach%' OR invoice.payment_status LIKE '%$serach%' OR invoice.order_status LIKE '%$serach%' OR invoice.net_total LIKE '%$serach%' OR invoice.sub_total LIKE '%$serach%' OR master.first_name LIKE '%$serach%' OR master.last_name LIKE '%$serach%' OR master.mobile_no LIKE '%$serach%' OR master.email LIKE '%$serach%' OR master.display_order_id LIKE '%$serach%') AND invoice.seller_id='$seller_id'  AND invoice.order_status='canceled' ORDER BY invoice.invoice_id DESC ");			
			}
		}		


		$config['base_url'] = base_url().'admin/product/index';
	    $config['use_page_numbers'] = TRUE;
	    $config['total_rows'] = count($orders_count);
	    $config['per_page'] = $rowperpage;   
	    $config['page_query_string'] = FALSE;             
	    $config['enable_query_strings'] = FALSE;             
	    $config['reuse_query_string']  = FALSE;             
	    $config['cur_page'] = $page_no;  
	    
	     // Initialize
	    $this->pagination->initialize($config);
	     // Initialize $data Array
	    $data['pagination'] = $this->pagination->create_links();
	    $data['result'] = $orders;
	    $data['row'] = $rowno;
	    $data['total_rows'] = count($orders_count);
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

		// echo "<pre>";
		// print_r($orders);
		// die;
	    $this->mViewData['orders'] = $orders; 	    
	    $this->mPageTitle = ' Order Invoice';	    
	    $this->render('vorders/cancel_order');
	}

	public function today_order()
    {
		//print_r($this->mUser);die;
		// $udata = $this->custom_model->my_where('admin_users','*',array('id' => $this->nmUser_id),array(),"","","","","",array(),"",false);
		$rowno=0;
		$ajax='call';
		$serach='';	
		$seller_id = $this->nmUser_id;
		$now = date('Y-m-d' ,strtotime('today'));
		$this->load->library('pagination');  

   		$post_data = $this->input->post();

		if (!empty($post_data))
		{
			$rowno = $post_data['pagno'];
			$ajax 	= $post_data['ajax'];
			$serach = $post_data['serach'];
		}		
		 // Row per page
    	$rowperpage = 10;
    	$page_no=0;

    	// Row position
    	if($rowno != 0){
    		$page_no=$rowno;
      		$rowno = ($rowno-1) * $rowperpage;
    	}
    	if($ajax=='call')
		{   			
			
			$orders = $this->custom_model->get_data_array("SELECT invoice.invoice_id,invoice.order_no,invoice.item_ids,invoice.payment_status,invoice.payment_mode,invoice.created_date,invoice.order_status,invoice.seller_id,invoice.net_total as in_net_total,invoice.sub_total as in_sub_total,master.display_order_id,master.first_name,master.last_name,master.mobile_no,master.email,master.country,master.city,master.state,master.pincode,master.address_1,master.currency,master.order_datetime FROM order_invoice as invoice INNER JOIN order_master as master ON invoice.order_no = master.order_master_id  WHERE invoice.seller_id='$seller_id'  AND invoice.created_date LIKE '%$now%' ORDER BY invoice.invoice_id DESC limit $rowno,$rowperpage ");

			$orders_count = $this->custom_model->get_data_array("SELECT invoice.invoice_id FROM order_invoice as invoice INNER JOIN order_master as master ON invoice.order_no = master.order_master_id  WHERE invoice.seller_id='$seller_id'  AND invoice.created_date LIKE '%$now%' ORDER BY invoice.invoice_id DESC  ");
   		}else 
   		{
			if(empty($serach))
			{
				$orders = $this->custom_model->get_data_array("SELECT invoice.invoice_id,invoice.order_no,invoice.item_ids,invoice.payment_status,invoice.payment_mode,invoice.created_date,invoice.order_status,invoice.seller_id,invoice.net_total as in_net_total,invoice.sub_total as in_sub_total,master.display_order_id,master.first_name,master.last_name,master.mobile_no,master.email,master.country,master.city,master.state,master.pincode,master.address_1,master.currency,master.order_datetime FROM order_invoice as invoice INNER JOIN order_master as master ON invoice.order_no = master.order_master_id  WHERE invoice.seller_id='$seller_id'  AND invoice.created_date LIKE '%$now%' ORDER BY invoice.invoice_id DESC limit $rowno,$rowperpage ");

				$orders_count = $this->custom_model->get_data_array("SELECT invoice.invoice_id FROM order_invoice as invoice INNER JOIN order_master as master ON invoice.order_no = master.order_master_id  WHERE invoice.seller_id='$seller_id'  AND invoice.created_date LIKE '%$now%' ORDER BY invoice.invoice_id DESC  ");
			}
			else {

				$orders = $this->custom_model->get_data_array("SELECT invoice.invoice_id,invoice.order_no,invoice.item_ids,invoice.payment_status,invoice.payment_mode,invoice.created_date,invoice.order_status,invoice.seller_id,invoice.net_total as in_net_total,invoice.sub_total as in_sub_total,master.display_order_id,master.first_name,master.last_name,master.mobile_no,master.email,master.country,master.city,master.state,master.pincode,master.address_1,master.currency,master.order_datetime FROM order_invoice as invoice INNER JOIN order_master as master ON invoice.order_no = master.order_master_id  WHERE ( invoice.invoice_id LIKE '%$serach%' OR invoice.order_no LIKE '%$serach%' OR invoice.payment_status LIKE '%$serach%' OR invoice.order_status LIKE '%$serach%' OR invoice.net_total LIKE '%$serach%' OR invoice.sub_total LIKE '%$serach%' OR master.first_name LIKE '%$serach%' OR master.last_name LIKE '%$serach%' OR master.mobile_no LIKE '%$serach%' OR master.email LIKE '%$serach%' OR master.display_order_id LIKE '%$serach%') AND invoice.seller_id='$seller_id'  AND invoice.created_date LIKE '%$now%' ORDER BY invoice.invoice_id DESC limit $rowno,$rowperpage ");

				$orders_count = $this->custom_model->get_data_array("SELECT invoice.invoice_id FROM order_invoice as invoice INNER JOIN order_master as master ON invoice.order_no = master.order_master_id  WHERE ( invoice.invoice_id LIKE '%$serach%' OR invoice.order_no LIKE '%$serach%' OR invoice.payment_status LIKE '%$serach%' OR invoice.order_status LIKE '%$serach%' OR invoice.net_total LIKE '%$serach%' OR invoice.sub_total LIKE '%$serach%' OR master.first_name LIKE '%$serach%' OR master.last_name LIKE '%$serach%' OR master.mobile_no LIKE '%$serach%' OR master.email LIKE '%$serach%' OR master.display_order_id LIKE '%$serach%') AND invoice.seller_id='$seller_id'  AND invoice.created_date LIKE '%$now%' ORDER BY invoice.invoice_id DESC ");			
			}
		}		


		$config['base_url'] = base_url().'admin/product/index';
	    $config['use_page_numbers'] = TRUE;
	    $config['total_rows'] = count($orders_count);
	    $config['per_page'] = $rowperpage;   
	    $config['page_query_string'] = FALSE;             
	    $config['enable_query_strings'] = FALSE;             
	    $config['reuse_query_string']  = FALSE;             
	    $config['cur_page'] = $page_no;  
	    
	     // Initialize
	    $this->pagination->initialize($config);
	     // Initialize $data Array
	    $data['pagination'] = $this->pagination->create_links();
	    $data['result'] = $orders;
	    $data['row'] = $rowno;
	    $data['total_rows'] = count($orders_count);
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

		// echo "<pre>";
		// print_r($orders);
		// die;
	    $this->mViewData['orders'] = $orders; 	    
	    $this->mPageTitle = 'Today Order';	    
	    $this->render('vorders/today_order');
	}

	public function view($order_id)
	{	
		$seller_id = $this->nmUser_id;
		$language= $this->uri->segment(1);
		if($language=='en')
		{
			$por_table="product";
			$unit_list="unit_list";
			$err_msg1='Updated successfully';
			$err_msg2='هناك خطأ ما';
			$err_msg3='Order Details';
		}else{
			$por_table="product_trans";
			$unit_list="unit_list_trans";
			$err_msg1='تحديث  بنجاح';
			$err_msg2='Something went wrong';
			$err_msg3='تفاصيل الطلب';
		}
		if(isset($_POST['submit']) && (!empty($_POST['submit'])))
		{
			// $this->load->library("email_send");
			// echo "<pre>";
			// print_r($_POST);
			// die;
			// $row9 = $this->custom_model->my_where('order_master','*',array('order_master_id' => $order_id));
			$row9 = $this->custom_model->my_where('order_invoice','*',array('order_no' => $order_id,'seller_id'=>$seller_id));
			if(!empty($row9))
			{
			       // $updatedata = array(		  
			       // 	"order_status" => $_POST['order_status'],       
			       //   "delivery_date" => $_POST['delivery_date'],
			       //   "payment_status" => $_POST['payment_status'],
			       //   "order_comment" => $_POST['order_comment'],
			       //   );
			       $order_status = $_POST['order_status'];
			     // $response = $this->custom_model->my_update($updatedata,array('order_master_id' => $order_id),'order_master');
			     $response=$this->custom_model->my_update(array('order_status'=>$order_status),array('order_no' => $order_id),'order_invoice');
			     $this->custom_model->my_update(array('order_status'=>$order_status),array('order_no' => $order_id),'order_items');
			       if($_POST['order_status']=='Dispatched')
			       {
			       		// Email to user 
				       	// $this->load->library("email_send");
				       	// $this->email_send->order_dispatched($row9[0]['display_order_id']);

				       	// FCM Notification msg to user
				       	// $this->load->library("fcmnotification");
				       	// $this->fcmnotification->order_dispatched_msg_to_user($row9[0]['customer_id']);
			       }
			       if($_POST['order_status']=='Delivered')
			       {
				       	// $this->load->library("email_send");
				       	// $this->email_send->order_delivered($row9[0]['display_order_id']);

				       	// FCM Notification msg to user
				       	// $this->load->library("fcmnotification");
				       	// $this->fcmnotification->order_delivered_msg_to_user($row9[0]['customer_id'],$row9[0]['display_order_id']);

			       }

			       if($_POST['order_status']=='canceled')
			       {
				       	// FCM Notification msg to user
				       	// $this->load->library("fcmnotification");
				       	// $this->fcmnotification->order_canceled_msg_to_user($row9[0]['customer_id'],$row9[0]['display_order_id']);

			       }

			     if($response)
			     {
			        $msg= array("msg" => $err_msg1,"response" => "alert-success");
			    	$this->mViewData['msg'] = $msg;
				 }
			}else{
				$msg= array("msg" => $err_msg2,"response" => "alert-danger");
				$this->mViewData['msg'] = $msg;
			}
		}
		$data = $this->custom_model->my_where('order_master','*',array('order_master_id' => $order_id));

		$user_detail=array();
		if(!empty($data))
		{
			$user_detail = $this->custom_model->my_where('admin_users','username,first_name,last_name,phone',array('id' => $data[0]['user_id']));		
		}
		
		$data_items = $this->custom_model->my_where('order_items','*',array('order_no' => $order_id,'seller_id'=>$seller_id));

		$invoice_data = $this->custom_model->my_where('order_invoice','*',array('order_no' => $order_id,'seller_id'=>$seller_id));
		// echo "<pre>";
		// print_r($invoice_data);
		// die;
		if(!empty($data_items))
		{
			foreach ($data_items as $d_key => $d_value)
			{
				// $items_extra_data = $this->custom_model->my_where('items_extra_data','*',array('item_id' => $d_value['item_id']));
				// $data_items[$d_key]['product_cust_data']=$items_extra_data;

				$unit_data = $this->custom_model->my_where($unit_list,'id,unit_name',array('id' => $d_value['unit']));
				if(!empty($unit_data))
				{
					$data_items[$d_key]['unit_name']=$unit_data[0]['unit_name'];
				}
			
				$product = $this->custom_model->my_where($por_table,'product_image,product_name',array('id' => $d_value['product_id']));
				if($language!='en')
				{
					$data_items[$d_key]['product_name']=$product[0]['product_name'];	
				}
				$data_items[$d_key]['pro_image']=$product[0]['product_image'];
			}
		}

		$trans_history=array();
		if(!empty($data))
		{
			$trans_history = $this->custom_model->my_where("payment_details","*",array("display_order_id" => $data[0]['display_order_id']) );			
		}			
		//print_r($order_id);die();
		
		// echo "df<pre>";
		// print_r($user_detail);
		// echo "<pre>";
		// print_r($data);
		// echo "<pre>";
		// print_r($data_items);
		// print_r($trans_history);
		// die;
		
		$this->mPageTitle = $err_msg3;
		$this->mViewData['data'] = $data;
		$this->mViewData['invoice_data'] = $invoice_data;
		// $this->mViewData['data_insur'] = @$data_insur;
		// $this->mViewData['data_pre'] = @$data_pre;
		$this->mViewData['data_items'] = $data_items;
		$this->mViewData['user_detail'] = $user_detail;		
		$this->mViewData['trans_history'] = $trans_history;		
		// $this->mViewData['signatures'] = $signatures;
		$this->mViewData['order_id'] = $order_id;
		$this->render('vorders/details');
	}

	public function create_pickup($order_id)
	{
		$language= $this->uri->segment(1);
		$post_data=$this->input->post();
		if(!empty($post_data))
		{
			if(isset($post_data['ShippingDateTime']) && isset($post_data['DueDate']) )
			{
				// && isset($post_data['ReadyTime']) && isset($post_data['LastPickupTime']) && isset($post_data['ClosingTime']) && isset($post_data['PickupDate']) 
				if(!empty($post_data['ShippingDateTime']) && !empty($post_data['DueDate']) )
				{
					// && !empty($post_data['ReadyTime']) && !empty($post_data['LastPickupTime']) && !empty($post_data['ClosingTime']) && !empty($post_data['PickupDate']) 	

					$seller_id = $this->nmUser_id;					
					$is_order = $this->custom_model->get_data_array("SELECT master.order_master_id,master.display_order_id,master.first_name,master.last_name,master.user_id,master.mobile_no as phone,master.email,master.country,master.city,master.state,master.pincode,master.address_1,master.google_address,master.lat,master.lng,invoice.invoice_ref,invoice.payment_status,invoice.payment_mode,invoice.seller_id,invoice.net_total,invoice.shipping_cost,invoice.sub_total,invoice.shipping_id	 FROM order_invoice as invoice INNER JOIN order_master as master ON invoice.order_no = master.order_master_id  WHERE invoice.seller_id='$seller_id'   AND master.order_master_id='$order_id' ");
					if(!empty($is_order))
					{
						if(!empty($is_order[0]['shipping_id']))
						{
							echo json_encode( array("status" => false,"message" => ($language == 'ar'? "You Can't resend request for shipping":"You Can't resend request for shipping") ) );die;
						}
						$seller_data = $this->custom_model->my_where('admin_users','username,first_name,entity_name,phone,email,street_name,building_no,city,state,postal_code as pincode',array('id' => $is_order[0]['seller_id']));

						if(empty($seller_data))
						{
							echo json_encode( array("status" => false,"message" => ($language == 'ar'? 'Invalid seller id':'Invalid seller id') ) );die;
						}

						$order_items = $this->custom_model->get_data_array("SELECT oitem.trans_ref,oitem.quantity,oitem.product_id,oitem.product_name,pro.city,pro.warehouse_location,pro.lat,pro.lng,pro.weight_unit,pro.weight,pro.length,pro.width,pro.height,pro.packaging_type ,pro.req_loading,pro.vehical_requirement,pro.hazardous_specify,pro.is_hazardous FROM order_items as oitem INNER JOIN product as pro ON oitem.product_id = pro.id  WHERE oitem.seller_id='$seller_id'  AND oitem.order_no='$order_id' AND oitem.is_delivery_available='0'  ORDER BY oitem.item_id   ");
						// AND shipping_id IS NOT NULL;
						if(!empty($order_items))
						{
							$this->load->library('shipping_lib');
							// $rate_info=$this->shipping_lib->create_pickup($order_items,$is_order,$seller_data,$post_data);
							$rate_info=$this->shipping_lib->create_shipments($order_items,$is_order,$seller_data,$post_data);						
							echo json_encode( $rate_info );die;	
						}else{
							echo json_encode( array("status" => false,"message" => ($language == 'ar'? 'Product items not found or product delivered by supplier':'Product items not found or product delivered by supplier') ) );die;
						}						
					}else{
						echo json_encode( array("status" => false,"message" => ($language == 'ar'? 'Invalid request':'Invalid request') ) );die;	
					}
				}else{
					echo json_encode( array("status" => false,"message" => ($language == 'ar'? 'All fields required':'All fields required') ) );die;
				}
			}else{
				echo json_encode( array("status" => false,"message" => ($language == 'ar'? 'All fields required':'All fields required') ) );die;	
			}
		}else{
			echo json_encode( array("status" => false,"message" => ($language == 'ar'? 'Something Went Wrong':'Something Went Wrong') ) );die;
		}
		echo "<pre>";
		print_r($post_data);
		die;
	}

	public function bank_excel()
	{
		$language= $this->uri->segment(1);
		$post_data=$this->input->post();

		if(!empty($post_data))
		{
			if(!empty($post_data['start_date']) && !empty($post_data['end_date']) )
			{
				$start_date= date("Y-m-d", strtotime($post_data['start_date']));
				$end_date= date("Y-m-d", strtotime($post_data['end_date']));
				$seller_id = $this->nmUser_id;
				$orders = $this->custom_model->get_data_array("SELECT invoice.invoice_id,invoice.order_no,invoice.item_ids,invoice.payment_status,invoice.payment_mode,invoice.created_date,invoice.order_status,invoice.seller_id,invoice.net_total as in_net_total,invoice.sub_total as in_sub_total,master.display_order_id,master.first_name,master.last_name,master.mobile_no,master.email,master.country,master.city,master.state,master.pincode,master.address_1,master.currency,master.order_datetime FROM order_invoice as invoice INNER JOIN order_master as master ON invoice.order_no = master.order_master_id  WHERE invoice.seller_id='$seller_id'  AND master.order_datetime BETWEEN '$start_date' AND '$end_date' ORDER BY invoice.invoice_id DESC  ");
				// AND user.id!='1'
				$file_name=date("d-m-Y").'-order_excel.csv';

			if (!empty($orders))
			{
				header('Content-Type:text/csv');
				header("Content-Disposition: attachment; filename=\"$file_name\";");
				// header("Content-Disposition: attachment; filename=" );

				$str = 'Order Id,Order Number,Customer Info,Order datetime,Net total,Payment status,Order status';

				$fp = fopen('php://output', 'wb');
				$i = 0;
				$header = explode(",", $str);
				fputcsv($fp, $header);

				foreach ($orders as $key => $value)
				{
					$DATACSV[] = $key+1;
					$DATACSV[] = $value['display_order_id'];
					$DATACSV[] = $value['first_name'].' '.$value['last_name'].','.$value['mobile_no'].','.$value['email']; 
					$DATACSV[] = date('M-d-Y' ,strtotime($value['order_datetime']));
					$DATACSV[] = $value['in_sub_total'];
					$DATACSV[] = $value['payment_status'];
					$DATACSV[] = $value['order_status'];						 
					fputcsv($fp, $DATACSV);
					$DATACSV = array();
				}

				// $this->session->set_flashdata('success','Excel File Downloaded Successfully');
				// redirect('admin/vorders');
			}else
			{
				// $lang['ALERT'] =" No data found";
				// echo "<script>alert('" . $lang['ALERT'] . "')</script>";
				$this->session->set_flashdata('error','Data Not Found');
				redirect($language.'/admin/vorders');
			}		 
			die;

			}else{
				$this->session->set_flashdata('error','Please Enter Start && End Date');
				redirect($language.'/admin/vorders');	
			}
		}else{
			redirect($language.'/admin/vorders');
		}		 
	}
	public function vaccount()
	{
		$data = [];
		$data['total_customers'] = $this->custom_model->get_data_array('SELECT COUNT(*) FROM admin_users')[0]['COUNT(*)'];
		$data['total_customers'] = (int)$data['total_customers'] - 1;

		$data['total_orders'] = $this->custom_model->count_last_month_record();
		$data['total_amount'] = $this->custom_model->last_month_amount();
		$data['last_month_transaction'] = $this->custom_model->last_month_transaction();

		$data['get_last_month_payout_details'] = $this->custom_model->get_last_month_payout_details();

		$date = $this->input->post('daterange');
		// echo "<pre>";
		// print_r($data['last_month_transaction']);
		// die;
		// exit();

		$this->mViewData['data'] = $data;
		$this->render('vorders/vaccount_demo');
	}
	public function remitters()
	{
		$data = [];
		$data['total_customers'] = $this->custom_model->get_data_array('SELECT COUNT(*) FROM account_details')[0]['COUNT(*)'];
	
		$data['total_customers'] = (int)$data['total_customers'] - 1;
		// print_r($data['total_customers']);
		// exit();

		$data['total_orders'] = $this->custom_model->count_last_month_record();
		$data['total_amount'] = $this->custom_model->last_month_amount();
		$data['last_month_transaction'] = $this->custom_model->va_account_details();
		$data['active_transaction'] = $this->db->get_where('account_details',array('is_active'=>1))->result();
		$data['inactive_transaction'] = $this->db->get_where('account_details',array('is_active'=>0))->result();

		// print_r($data['last_month_transaction']);
		// exit();

		$data['get_last_month_payout_details'] = $this->custom_model->get_last_month_payout_details();

		$date = $this->input->post('daterange');
		// echo "<pre>";
		// print_r($data['last_month_transaction']);
		// die;
		// exit();

		$this->mViewData['data'] = $data;
		$this->render('vorders/remitter_demo');
	}
	function update_approve_decline_remitters() {
		// Process the form data here
       
        $dataId = $this->input->post('dataId');
        $datasType = $this->input->post('datasType');
		// print_r($_POST);
		// exit();
		
		if($datasType == 'approve'){
			$data = [
				'message' => "Your Transaction is Active",
			];
			$account_details_data = [
				'is_active' => 1,
			];
			
			$this->custom_model->my_update($account_details_data, array('id' => $dataId), 'account_details');
			
		}else{
			$data = [
				'message' => "Your Transaction is Inactive",
			];
			$account_details_data = [
				'is_active' => 0,
			];
			$this->custom_model->my_update($account_details_data, array('id' => $dataId), 'account_details');
			
		}

        // Send the response as JSON
        header('Content-Type: application/json');
        echo json_encode($data);
	}
	public function payout($user_id)
	{
		$data = $this->custom_model->my_where('admin_users', "*", array('id' => $user_id));
		$this->mViewData['data'] = $data;
		$this->render('vorders/payout_admin_new');
		// $this->urender('payout_admin', 'udefault');
	}

	public function update_approve_decline_withdrawal() {

		
		// Process the form data here
        $dataUId = $this->input->post('dataUId');
        $dataId = $this->input->post('dataId');
        $amount = (float) $this->input->post('dataAmount');
        $datasType = $this->input->post('datasType');
		// print_r($_POST);
		// exit();
		
		if($datasType == 'approve'){
			$data = [
				'message' => "Your Transaction is Approved",
			];
			$user_account_details = $this->custom_model->my_where('account_details', "*", array('user_id' => $dataUId));
			$user_account_details_admin = $this->custom_model->my_where('account_details', "*", array('user_id' => 1));
			$updated_balance = [
				'balance' => (float) $user_account_details[0]['balance'] - $amount,
			];
			$updated_balance_admin = [
				'balance' => (float) $user_account_details_admin[0]['balance'] + $amount,
			];
			$this->custom_model->my_update($updated_balance, array('user_id' => $dataUId), 'account_details');
			$this->custom_model->my_update($updated_balance_admin, array('user_id' => 1), 'account_details');
			$va_transactions_data = [
				'status' => 2,
			];
			$this->custom_model->my_update($va_transactions_data, array('id' => $dataId), 'va_transactions');
			

			// print_r($updated_balance_admin);
			// print_r($updated_balance);
			
		}else{
			$va_transactions_data = [
				'status' => 3,
			];
			$order_status = "canceled";
			$transactions_data = $this->custom_model->my_where('va_transactions', "*", array('id' => $dataId));

			$this->custom_model->my_update($va_transactions_data, array('id' => $dataId), 'va_transactions');
			$this->custom_model->my_update(array('order_status'=>$order_status),array('order_no' => $transactions_data[0]['order_id']),'order_invoice');
			$this->custom_model->my_update(array('order_status'=>$order_status),array('order_no' => $transactions_data[0]['order_id']),'order_items');
			$this->custom_model->my_update(array('order_status'=>$order_status),array('order_master_id' => $transactions_data[0]['order_id']),'order_master');

			$data = [
				'message' => "Your Transaction is Declined",
			];
		}

        // Send the response as JSON
        header('Content-Type: application/json');
        echo json_encode($data);
	}
	public function update_db_for_withdrawal() {
		// Process the form data here
        $payment_note = $this->input->post('payment_note');
        $amount = (float) $this->input->post('amount');

		$user_account_details = $this->custom_model->my_where('account_details', "*", array('user_id' => 1))[0];

		if ($amount >= (float) $user_account_details['balance']) {
			$data = [
				'message' => "You don't have sufficient balance, Please try with different amount",
			];
		} else {
			$record = [
				'user_id' => 1,
				'amount' => $amount,
				'transaction_type' => 'debit',
				'payment_note' => $payment_note,
				'status' => '1',
			];
			$this->custom_model->my_insert($record, 'va_transactions'); // insert record in the database
			$updated_balance = [
				'balance' => (float) $user_account_details['balance'] - $amount,
			];
			$this->custom_model->my_update($updated_balance, array('user_id' => 1), 'account_details');

			// Prepare the response data
			$data = array(
				'message' => 'The entered amount withdrawn successfully!',
			);
		}


        // Send the response as JSON
        header('Content-Type: application/json');
        echo json_encode($data);
	}

	public function get_data_by_date() {
        // $date = $this->input->post('daterange'); // Assuming the date is passed through POST method
		$date1 =  $this->input->post('start_date');
		$date2 =  $this->input->post('end_date');
		$timestamp1 = strtotime($date1);
		$timestamp2 = strtotime($date2);

// Convert timestamp to desired format
		$formattedDate1 = date('Y-m-d', $timestamp1);
		$formattedDate2 = date('Y-m-d', $timestamp2);

		// $date1 =  "2023-05-01";
		// $date2 =  "2023-07-20";

        // $this->load->model('OrderModel');
        $data = $this->custom_model->get_data_by_daterange($formattedDate1, $formattedDate2);
		// print_r($data);
		// exit();
		// $data = 'HELLO WORLD';
        header('Content-Type: application/json');
        echo json_encode($data);
    }

	// three join
	// $orders = $this->custom_model->get_data_array("SELECT oitems.item_id,oitems.order_no,oitems.product_id,oitems.product_name,oitems.quantity,oitems.price,oitems.order_status as item_order_status,invoice.invoice_id,invoice.item_ids,invoice.payment_status,invoice.payment_mode,invoice.created_date,invoice.order_status,invoice.seller_id,master.display_order_id,master.first_name,master.last_name,master.mobile_no,master.email,master.country,master.city,master.state,master.pincode,master.address_1 FROM order_items as oitems INNER JOIN order_invoice as invoice ON   oitems.order_no=invoice.order_no  INNER JOIN  order_master as master ON oitems.order_no = master.order_master_id WHERE oitems.seller_id='$seller_id' AND invoice.seller_id='$seller_id' ORDER BY invoice.invoice_id DESC ");
}
?>	