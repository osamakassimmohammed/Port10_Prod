<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_send extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
		$this->load->model('custom_model');
		$this->load->model('category_model');	
		$language= $this->uri->segment(1);
        $this->is_admin($language);	
	}


	// public function index()
	// {
	// 	$crud = $this->generate_crud('email_info_offer');
	// 	$crud->columns('id', 'subject', 'message' , 'created_date');
		
	// 	// $crud->set_field_upload('image', UPLOAD_BLOG_POST);

	// 	// $crud->display_as('editor','editor');
	// 	// $crud->display_as('title','Pages');
		
	// 	$crud->set_theme('datatables');
	// 	$crud->unset_add();
	// 	// $crud->unset_delete();
	// 	// $crud->unset_edit();

	// 	// $date = date('Y-m-d h:i:s');
	// 	// $crud->field_type('created_date', 'hidden', $date);

	// 	// $crud->field_type('category','dropdown', array('active' => 'Active', 'deactive' => 'Deactive'));

	// 	// $crud->set_rules('image','Image ','required');
	// 	// $crud->set_rules('title','title','required');		
	// 	// $crud->set_rules('description','description','required');

	// 	// $crud->add_action('translate', '', 'admin/pages/tedit', '');
	// 	// $crud->add_action('edit', '', 'admin/pages/edit', '');

	// 	$this->mPageTitle = 'Email Listing';
	// 	$this->render_crud();
	// }

	public function index()
	{
		$table_name="email_info_offer";		
		$page_title='Email List';
		$data = $this->custom_model->my_where($table_name,'*',array());
		$edit_link=base_url('admin/email_send/edit/');
		$tedit_link=base_url('admin/email_send/tedit/');
		// echo "<pre>";
		// print_r($data);
		// die; 

		$this->mViewData['page_title'] = $page_title;		
		$this->mViewData['data'] = $data;		
		$this->mViewData['edit_link'] = $edit_link;		
		$this->mViewData['tedit_link'] = $tedit_link;		
		$this->render('email_send/list');
	}



	// Frontend Category CRUD

	public function create()
	{
		$form = $this->form_builder->create_form();      	
        
        $post_data =  $this->input->post();
        if ($post_data)
        {
	        
	        $data['subject'] 		= trim($post_data['subject']);
	        $data['message'] 		= trim($post_data['message']);
	        $data['type'] 		= trim($post_data['type']);
	        $data['created_date'] 	= date("Y-m-d h:i:s");
			$this->custom_model->my_insert($data,'email_info_offer');
			$this->mViewData['msg'] = '<p style="    width: 100%;    padding: 10px;    border: 1px solid #cdcdcd;    border-radius: 5px;    text-align: center;    background: #f5eee5;    color: black;"> Email send successfully to all  users </p>';
			
        	if($post_data['type']=='newsletter')
        	{
				// echo "12212";
				// die;
        		$u_data = $this->custom_model->get_data_array("SELECT id FROM admin_users WHERE newsletter='1' ");
        	}else if($post_data['type']=='customer_all')
        	{
        		//echo "12212";
				//die;
        		$u_data = $this->custom_model->get_data_array("SELECT id FROM admin_users ");
        	}else{
        		
				$u_data=array();
				if(isset($post_data['customer']))
				{
					$u_data=$post_data['customer'];
				}else{
					$u_data=$post_data['product'];
				}	
				// echo "<pre>";
				// print_r($u_data);
				// die;
        	}
        	if(!empty($u_data))
        	{
		        foreach($u_data as $row)
		        {
		        	if($post_data['type']=='newsletter' || $post_data['type']=='customer_all')
		        	{
						$uid = $row['id'];
		        	}else{
		        		$uid=$row;
		        	}
		        	// echo $uid;
		        	// die;
					// $email = $row['email'];
					// $email = 'girishbhumkar5@gmail.com';
					$this->load->library('send_mail');					

					if(!empty($post_data['subject']) && !empty($post_data['message']) )
					{
						$response = $this->send_mail->email_backend_to_user($uid,$post_data['subject'],$post_data['message']);
					}
		        }
		        echo "send";
		        die;	        		
        	}else{
        		echo 0;
        		die;
        	}
		}        

	    $this->mPageTitle = 'Send Email';
	    $this->mViewData['form'] = $form;
	    $this->mViewData['form_url'] =base_url('admin/email_send/create');
		$this->render('email_send/create');
  	}  

  	public function edit($cate_id)
	{
		$form = $this->form_builder->create_form();
		$post_data = $this->input->post();
		$table_name="email_info_offer";
		$page_title='Edit Email';
		$back_link=base_url('admin/service');
		if ( !empty($post_data) )
		{
			// $cate_data = $this->custom_model->my_where('banner','*',array('id' => $cate_id));
			
			// proceed to create Category
			$response = $this->custom_model->my_update($post_data,array('id' => $cate_id),$table_name);
			
			if ($response)
			{
				// success
				$this->system_message->set_success('Email Edited successfully');
			}
			else
			{
				// failed
				$this->system_message->set_error('Something went wrong');
			}
			
			refresh();
		}
		

		$cate_data = $this->custom_model->my_where($table_name,'*',array('id' => $cate_id));
		$this->mViewData['edit'] = $cate_data[0];
		$this->mPageTitle = $page_title;
		$this->mViewData['form'] = $form;
		$this->mViewData['page_title'] = $page_title;
		$this->mViewData['back_link'] = $back_link;
		
		$this->render('email_send/create');
	}

	public function re_send()
	{
		$post_data=$this->input->post();
		if(!empty($post_data['id']))
		{
			$id=$post_data['id'];
			$cate_data = $this->custom_model->my_where('email_info_offer','*',array('id' => $id));

			$u_data = $this->custom_model->my_where("admin_users","id,email",array('id!='=>'1'));
        	if(!empty($u_data))
        	{
		        foreach($u_data as $row)
		        {
					$uid = $row['id'];
					$email = $row['email'];
					$message=@$cate_data[0]['message'];
					$subject=@$cate_data[0]['subject'];
					// $email = 'girishbhumkar5@gmail.com';

					$this->load->library('send_mail');
					

					if(!empty($subject) && !empty($message) && !empty($email))
					{
						$response = $this->send_mail->email_backend_to_user($uid,$subject,$message);
					}
		        }   
		        echo 1;
		        die;     		
        	}else{
        		echo 0;
        		die;
        	}
		}else{
			echo 0;
			die;
		}		
	}

	public function customer_search()
	{
		$language= $this->uri->segment(1);
		$admin_users='admin_users';
		$post_data = $this->input->post();
		
		$search_name = $post_data['string'];
		$type = $post_data['type'];
		// $category_id = $post_data['category_id'];
		$response = $sub_cat_id = array();

		if (!empty($post_data))
		{	
			if($type=='customer')
			{

				if(!empty($search_name)) 
				{				

					$get_data =  $this->custom_model->get_data_array("SELECT * FROM `$admin_users` WHERE `first_name` LIKE '%$search_name%' OR `last_name` LIKE '%$search_name%'"); 
					// $cars_data = $this->custom_model->get_data_array("SELECT * FROM $car_data_table WHERE `vendor_id` != '$vid'   $sub_query $order_by limit $rowno,$rowperpage");
				}

				if(!empty($get_data)) {
					foreach ($get_data as $key => $gvalue)
					{
						$full_name=$gvalue['first_name'].' '.$gvalue['last_name'];
						$response[] = '<a href="javascript:void(0)" class="point_me search_drop_down customer_list" data-id="'.$gvalue['id'].'" data-type="'.$type.'">'.$full_name.'</a><br>';
					}
				}	
				echo json_encode($response);
			}else
			{
				if(!empty($search_name)) 
				{				

					$get_data =  $this->custom_model->get_data_array("SELECT * FROM `order_items` WHERE `product_name` LIKE '%$search_name%' "); 
					// $cars_data = $this->custom_model->get_data_array("SELECT * FROM $car_data_table WHERE `vendor_id` != '$vid'   $sub_query $order_by limit $rowno,$rowperpage");
				}

				if(!empty($get_data)) {
					foreach ($get_data as $key => $gvalue)
					{
						$full_name=$gvalue['product_name'];
						$response[] = '<a href="javascript:void(0)" class="point_me search_drop_down customer_list" data-id="'.$gvalue['user_id'].'" data-type="'.$type.'" >'.$full_name.'</a><br>';
					}
				}	
				echo json_encode($response);
			}		
		}
		else{
			echo 0;
		}
	}

	public function detete_pro()
    {
    	$post_data=$this->input->post();
    	if(!empty($post_data))
    	{
    		$pid=$post_data['pid'];    		
    		$this->custom_model->my_delete(array('id'=>$pid),'email_info_offer');   		
    		echo 1;
    		die;
    	}else {
    		echo 0;
    		die;
    	}
    }

}