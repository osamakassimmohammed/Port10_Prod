<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_data extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
		$this->load->model('custom_model');
		$this->load->model('category_model');	
		$language= $this->uri->segment(1);
        $this->is_admin($language);
	}

	// Frontend Category CRUD

	public function index($rowno=0,$ajax='call',$serach='')
	{

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
			$banner_data = $this->custom_model->get_data_array("SELECT banner.*,category.display_name  FROM banner  INNER JOIN category  ON banner.main_cat=category.id ORDER BY banner.id ASC limit $rowno,$rowperpage ");	 

			$banner_count = $this->custom_model->get_data_array("SELECT COUNT(banner.id) as banner_count   FROM banner  INNER JOIN category  ON banner.main_cat=category.id ORDER BY banner.id ASC ");	  				 			

   		}else 
   		{
			if(empty($serach))
			{
				$banner_data = $this->custom_model->get_data_array("SELECT banner.*,category.display_name  FROM banner  INNER JOIN category  ON banner.main_cat=category.id ORDER BY banner.id ASC limit $rowno,$rowperpage ");	 

				$banner_count = $this->custom_model->get_data_array("SELECT COUNT(banner.id) as banner_count   FROM banner  INNER JOIN category  ON banner.main_cat=category.id ORDER BY banner.id ASC ");		

			}
			else {							

				$banner_data = $this->custom_model->get_data_array("SELECT banner.*,category.display_name  FROM banner  INNER JOIN category  ON banner.main_cat=category.id  WHERE banner.heading1 LIKE '%$serach%' OR banner.heading2 LIKE '%$serach%' OR category.display_name LIKE '%$serach%' ORDER BY banner.id ASC limit $rowno,$rowperpage ");

				$banner_count = $this->custom_model->get_data_array("SELECT COUNT(banner.id) as banner_count  FROM banner  INNER JOIN category  ON banner.main_cat=category.id  WHERE banner.heading1 LIKE '%$serach%' OR banner.heading2 LIKE '%$serach%' OR category.display_name LIKE '%$serach%' ORDER BY banner.id ASC limit $rowno,$rowperpage ");
			}
		}
		
		// echo "<pre>";
		// print_r($contact_request);
		// die;
		$config['base_url'] = base_url().'admin/blog/index';
	    $config['use_page_numbers'] = TRUE;
	    $config['total_rows'] = $banner_count[0]['banner_count'];
	    $config['per_page'] = $rowperpage;   
	    $config['page_query_string'] = FALSE;             
	    $config['enable_query_strings'] = FALSE;             
	    $config['reuse_query_string']  = FALSE;             
	    $config['cur_page'] = $page_no;  
	    
	     // Initialize
	    $this->pagination->initialize($config);
	     // Initialize $data Array
	    $data['pagination'] = $this->pagination->create_links();
	    $data['result'] = $banner_data;
	    $data['row'] = $rowno;
	    $data['total_rows'] = $banner_count[0]['banner_count'];
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
		// print_r($banner_data);
		// die;
		$this->mPageTitle = 'Banner List' ;		
		$this->mViewData['banner_data'] = $banner_data;
		$this->render('home_data/banner/list');

	}
	public function index2()
	{
		$crud = $this->generate_crud('banner');
		$crud->columns('id','heading1','heading2','image');
		
		$crud->set_field_upload('image', BANNER_PATH);


		// $crud->display_as('editor','editor');
		// $crud->display_as('title','Pages');
		
		$crud->set_theme('datatables');
		$crud->unset_add();
		// $crud->unset_delete();
		$crud->unset_edit();



		// $crud->add_action('translate', '', 'admin/home_data/banner_tedit', '');
		$crud->add_action('edit', '', 'admin/home_data/banner_edit', '');

		$this->mPageTitle = 'Add Banner';
		$this->render_crud();
	}


	public function banner_create()
	{
		$form = $this->form_builder->create_form();
		$post_data = $this->input->post();
		if (!empty($post_data)) 
		{
			// echo "<pre>";
			// print_r($post_data);
			// die;

			if (empty($post_data['image']))
			{
				$this->system_message->set_error('Please upload image');
			}
			else
			{
				$response = $this->custom_model->my_insert( $post_data,'banner');
				$response = $this->custom_model->my_insert( $post_data,'banner_trans');

				if ($response)
				{
					// success
					$this->system_message->set_success('Banner created successfully');
				}
				else
				{
					// failed
					$this->system_message->set_error('Something went wrong');
				}
			}
				
			
      	}

      	$category_data = $this->custom_model->my_where('category','id,display_name',array('parent' => 0,'status'=>'active'));
      	// echo "<pre>";
      	// print_r($category_data);
      	// die;
		$this->mPageTitle = 'Create Banner';
		$this->mViewData['form'] = $form;
		$this->mViewData['category_data'] = $category_data;
		$this->render('home_data/banner/create');
	}

	public function banner_edit($cate_id)
	{
		$form = $this->form_builder->create_form();
		$post_data = $this->input->post();
		
		if ( !empty($post_data) )
		{
			// $cate_data = $this->custom_model->my_where('banner','*',array('id' => $cate_id));
			
			// proceed to create Category
			$response = $this->custom_model->my_update($post_data,array('id' => $cate_id),'banner');
			
			if ($response)
			{
				// success
				$this->system_message->set_success('Banner Edited successfully');
			}
			else
			{
				// failed
				$this->system_message->set_error('Something went wrong');
			}
			
			refresh();
		}

		$cate_data = $this->custom_model->my_where('banner','*',array('id' => $cate_id));

		$category_data = $this->custom_model->my_where('category','id,display_name',array('parent' => 0,'status'=>'active'));
		$this->mViewData['edit'] = $cate_data[0];
		$this->mPageTitle = 'Edit Banner';
		$this->mViewData['form'] = $form;
		$this->mViewData['category_data'] = $category_data;
		$this->render('home_data/banner/create');
	}


	public function banner_tedit($cate_id)
	{
		$form = $this->form_builder->create_form();
		$post_data = $this->input->post();
		
		if ( !empty($post_data) )
		{
			// $cate_data = $this->custom_model->my_where('banner_trans','*',array('id' => $cate_id));
			
			// proceed to create Category
			$response = $this->custom_model->my_update($post_data,array('id' => $cate_id),'banner_trans');
			
			if ($response)
			{
				// success
				$this->system_message->set_success(' Banner Edited successfully ');
			}
			else
			{
				// failed
				$this->system_message->set_error('Something went wrong');
			}
			
			refresh();
		}

		$cate_data = $this->custom_model->my_where('banner_trans','*',array('id' => $cate_id));

		$category_data = $this->custom_model->my_where('category','id,display_name',array('parent' => 0,'status'=>'active'));
		$this->mViewData['edit'] = $cate_data[0];
		$this->mPageTitle = 'Edit Banner';
		$this->mViewData['form'] = $form;
		$this->mViewData['category_data'] = $category_data;
		$this->render('home_data/banner/create');
	}

	public function detete_banner()
    {
    	$post_data=$this->input->post();
    	if(!empty($post_data))
    	{
    		$pid=$post_data['pid'];
    		$this->custom_model->my_delete(['id' => $pid], 'banner');
    		$this->custom_model->my_delete(['id' => $pid], 'banner_trans');
    		echo 1;
    		die;
    	}else {
    		echo 0;
    		die;
    	}
    }

	public function section_one()
	{
		$crud = $this->generate_crud('section_one');
		$crud->columns('id','heading1','heading2', 'main_category' , 'image');
		
		$crud->set_field_upload('image', BANNER_PATH);


		// $crud->display_as('editor','editor');
		// $crud->display_as('title','Pages');
		
		$crud->set_theme('datatables');
		$crud->unset_add();
		$crud->unset_delete();
		$crud->unset_edit();



		$crud->add_action('translate', '', 'admin/home_data/section_one_tedit', '');
		$crud->add_action('edit', '', 'admin/home_data/section_one_edit', '');

		$this->mPageTitle = 'Add Banner';
		$this->render_crud();
	}

	public function section_one_create()
	{
		$form = $this->form_builder->create_form();
		$post_data = $this->input->post();
		if (!empty($post_data)) 
		{
			// echo "<pre>";
			// print_r($post_data);
			// die;

			if (empty($post_data['image']))
			{
				$this->system_message->set_error('Please upload image');
			}
			else
			{
				$response = $this->custom_model->my_insert( $post_data,'section_one ');
				$response = $this->custom_model->my_insert( $post_data,'section_one_trans ');

				if ($response)
				{
					// success
					$this->system_message->set_success('section_one created successfully');
				}
				else
				{
					// failed
					$this->system_message->set_error('Something went wrong');
				}
			}
				
			
      	}
      	$category_data=$this->custom_model->my_where("category","id,display_name",array('status' => 'active','parent'=>'0'));	
      	// echo "<pre>";
      	// print_r($category_data);
      	// die;

		$this->mPageTitle = 'Create Section One';
		$this->mViewData['form'] = $form;
		$this->mViewData['category_data'] = $category_data;
		$this->render('home_data/section_one/create');
	}

	public function section_one_edit($cate_id)
	{
		$form = $this->form_builder->create_form();
		$post_data = $this->input->post();
		
		if ( !empty($post_data) )
		{
			// $cate_data = $this->custom_model->my_where('banner','*',array('id' => $cate_id));
			
			// proceed to create Category
			$response = $this->custom_model->my_update($post_data,array('id' => $cate_id),'section_one');
			
			if ($response)
			{
				// success
				$this->system_message->set_success('Banner Edited successfully');
			}
			else
			{
				// failed
				$this->system_message->set_error('Something went wrong');
			}
			
			refresh();
		}
		$category_data=$this->custom_model->my_where("category","id,display_name",array('status' => 'active','parent'=>'0'));	

		$cate_data = $this->custom_model->my_where('section_one','*',array('id' => $cate_id));
		$this->mViewData['edit'] = $cate_data[0];
		$this->mPageTitle = 'Edit Section One';
		$this->mViewData['form'] = $form;
		$this->mViewData['category_data'] = $category_data;
		$this->render('home_data/section_one/create');
	}

	public function section_one_tedit($cate_id)
	{
		$form = $this->form_builder->create_form();
		$post_data = $this->input->post();
		
		if ( !empty($post_data) )
		{
			// $cate_data = $this->custom_model->my_where('banner_trans','*',array('id' => $cate_id));
			
			// proceed to create Category
			$response = $this->custom_model->my_update($post_data,array('id' => $cate_id),'section_one_trans');
			
			if ($response)
			{
				// success
				$this->system_message->set_success('تم تعديل البانر بنجاح');
			}
			else
			{
				// failed
				$this->system_message->set_error('هناك خطأ ما');
			}
			
			refresh();
		}
		$category_data=$this->custom_model->my_where("category","id,display_name",array('status' => 'active','parent'=>'0'));	

		$cate_data = $this->custom_model->my_where('section_one_trans','*',array('id' => $cate_id));
		$this->mViewData['edit'] = $cate_data[0];
		$this->mPageTitle = 'Edit Section One';
		$this->mViewData['form'] = $form;
		$this->mViewData['category_data'] = $category_data;
		$this->render('home_data/section_one/create');
	}

	
	
	public function testimonial()
	{
		$crud = $this->generate_crud('testimonial');
		$crud->columns('id','description', 'image');
		
		$crud->set_field_upload('image', BANNER_PATH);


		// $crud->display_as('editor','editor');
		// $crud->display_as('title','Pages');
		
		$crud->set_theme('datatables');
		$crud->unset_add();
		$crud->unset_delete();
		$crud->unset_edit();



		$crud->add_action('translate', '', 'admin/home_data/testimonial_tedit', '');
		$crud->add_action('edit', '', 'admin/home_data/testimonial_edit', '');

		$this->mPageTitle = 'Add Banner';
		$this->render_crud();
	}

	public function testimonial_create()
	{
		$form = $this->form_builder->create_form();
		$post_data = $this->input->post();
		if (!empty($post_data)) 
		{
			// echo "<pre>";
			// print_r($post_data);
			// die;

			if (empty($post_data['image']))
			{
				$this->system_message->set_error('Please upload image');
			}
			else
			{
				$response = $this->custom_model->my_insert( $post_data,'testimonial ');
				$response = $this->custom_model->my_insert( $post_data,'testimonial_trans ');

				if ($response)
				{
					// success
					$this->system_message->set_success('Testimonial created successfully');
				}
				else
				{
					// failed
					$this->system_message->set_error('Something went wrong');
				}
			}
				
			
      	}
      	
      	// echo "<pre>";
      	// print_r($category_data);
      	// die;

		$this->mPageTitle = 'Create Testimonial';
		$this->mViewData['form'] = $form;		
		$this->render('home_data/testimonial/create');
	}

	public function testimonial_edit($cate_id)
	{
		$form = $this->form_builder->create_form();
		$post_data = $this->input->post();
		
		if ( !empty($post_data) )
		{
			// $cate_data = $this->custom_model->my_where('banner','*',array('id' => $cate_id));
			
			// proceed to create Category
			$response = $this->custom_model->my_update($post_data,array('id' => $cate_id),'testimonial');
			
			if ($response)
			{
				// success
				$this->system_message->set_success('Testimonial Edited successfully');
			}
			else
			{
				// failed
				$this->system_message->set_error('Something went wrong');
			}
			
			refresh();
		}
			

		$cate_data = $this->custom_model->my_where('testimonial','*',array('id' => $cate_id));
		$this->mViewData['edit'] = $cate_data[0];
		$this->mPageTitle = 'Edit Section One';
		$this->mViewData['form'] = $form;		
		$this->render('home_data/testimonial/create');
	}

	public function testimonial_tedit($cate_id)
	{
		$form = $this->form_builder->create_form();
		$post_data = $this->input->post();
		
		if ( !empty($post_data) )
		{
			// $cate_data = $this->custom_model->my_where('banner','*',array('id' => $cate_id));
			
			// proceed to create Category
			$response = $this->custom_model->my_update($post_data,array('id' => $cate_id),'testimonial_trans');
			
			if ($response)
			{
				// success
				$this->system_message->set_success('Testimonial Edited successfully');
			}
			else
			{
				// failed
				$this->system_message->set_error('Something went wrong');
			}
			
			refresh();
		}
			

		$cate_data = $this->custom_model->my_where('testimonial_trans','*',array('id' => $cate_id));
		$this->mViewData['edit'] = $cate_data[0];
		$this->mPageTitle = 'Edit Section One';
		$this->mViewData['form'] = $form;		
		$this->render('home_data/testimonial/create');
	}

	public function footer_data()
	{
		$crud = $this->generate_crud('footer_content');

		$crud->columns('id','mobile_no','email_id','location','facebook','twitter','youtube');
		
		// $crud->set_field_upload('image', UPLOAD_BLOG_POST);

		// $crud->display_as('newsletter','footer about');
		$crud->field_type('newsletter', 'hidden');
		$crud->field_type('email_id2', 'hidden');
		$crud->field_type('mobile_no2', 'hidden');
		$crud->field_type('fax', 'hidden');
		// $crud->display_as('title','Pages');
		 $crud->unset_texteditor('google_map_location','full_text');
		
		$crud->set_theme('datatables');
		// disable direct create / delete Category
		$crud->unset_add();
		// $crud->unset_edit();
			$crud->unset_delete();

		// $crud->field_type('category','dropdown', array('active' => 'Active', 'deactive' => 'Deactive'));
		// $crud->field_type('contact_no2', 'hidden','');	
		// $page= array('Abu Dhabi'=>'Abu Dhabi','Bahrain'=>'Bahrain');
		
         // $crud->field_type('country','dropdown',$page);

		$page= array('1 month'=>'1 month','2 month'=>'2 month','3 month'=>'3 month','4 month'=>'4 month','5 month'=>'5 month','6 month'=>'6 month','7 month'=>'7 month','8 month'=>'8 month','9 month'=>'9 month','10 month'=>'10 month','11 month'=>'11 month','12 month'=>'12 month');
		
         $crud->field_type('default_period','dropdown',$page);
         	
         $crud->set_rules('email_id','Email','required');
         $crud->set_rules('location','location','required');
         $crud->set_rules('mobile_no','Mobile No','required');     
         $crud->set_rules('facebook','Facebook','required');     
         $crud->set_rules('twitter','Twitter','required');     
         $crud->set_rules('instagram','Instagram','required');     
         $crud->set_rules('youtube','Youtube Plus','required');   
         $crud->set_rules('default_period','Please select default subscription','required');  

		// $crud->add_action('translate', '', 'admin/pages/tedit', '');
		// $crud->add_action('edit', '', 'admin/pages/edit', '');
		
		$this->mPageTitle = 'Footer Content';
		$this->render_crud();
	}



	public function create_advertise()
	{
		$form = $this->form_builder->create_form();
		$language= $this->uri->segment(1);
		$post_data = $this->input->post();
		$table_name="product_advertise";
		// $table_name_trans="sub_more_trans";
		$page_title='Add Advertise';
		$back_link=base_url($language.'/admin/home_data/product_advertise');
		if (!empty($post_data)) 
		{
			// echo "<pre>";
			// print_r($post_data);
			// die;
			if(!empty($post_data['seller_id']) && !empty($post_data['brand_id']) && !empty($post_data['product_id']) )
			{
				$is_data = $this->custom_model->my_where($table_name,'id',array('product_id' => $post_data['product_id'],'brand_id'=>$post_data['brand_id'],'seller_id'=>$post_data['seller_id']));
				if(empty($is_data))
				{
					$response = $this->custom_model->my_insert($post_data,$table_name);
					echo json_encode(array("status"=>true,"message"=>"Record added successfully")); die;					
				}else{
					echo json_encode(array("status"=>false,"message"=>"This product already added, please select another product")); die;
				}

			}else{
				echo json_encode(array("status"=>false,"message"=>"All fields required")); die;
			}		
      	} 

      	$users_data = $this->custom_model->get_data_array("SELECT id,first_name FROM admin_users WHERE  id!='1' AND type='suppler'  Order BY id ASC  ");       	
      	// echo "<pre>";
      	// print_r($users_data);
      	// die;
		$this->mPageTitle = $page_title;
		$this->mViewData['form'] = $form;		
		$this->mViewData['page_title'] = $page_title;		
		$this->mViewData['back_link'] = $back_link;		
		$this->mViewData['users_data'] = $users_data;		
		$this->mViewData['ajax_url'] = base_url('admin/home_data/create_advertise');		
		$this->render('home_data/advertise/create');					
	}

	public function edit_advertise($edit='')
	{
		$form = $this->form_builder->create_form();
		$language= $this->uri->segment(1);
		$post_data = $this->input->post();
		$table_name="product_advertise";
		// $table_name_trans="sub_more_trans";
		$page_title='Add Advertise';
		$back_link=base_url($language.'/admin/home_data/product_advertise');
		if (!empty($post_data)) 
		{
			// echo "<pre>";
			// print_r($post_data);
			// die;
			if(!empty($post_data['seller_id']) && !empty($post_data['brand_id']) && !empty($post_data['product_id']) )
			{
				$is_data = $this->custom_model->my_where($table_name,'id',array('product_id' => $post_data['product_id'],'brand_id'=>$post_data['brand_id'],'seller_id'=>$post_data['seller_id'],'id!='=>$edit));
				if(empty($is_data))
				{					
					$response = $this->custom_model->my_update($post_data,array('id' => $edit),$table_name);
					echo json_encode(array("status"=>true,"message"=>"Record updated successfully")); die;					
				}else{
					echo json_encode(array("status"=>false,"message"=>"This product already added, please select another product")); die;
				}

			}else{
				echo json_encode(array("status"=>false,"message"=>"All fields required")); die;
			}		
      	} 

      	$advertise_data = $this->custom_model->my_where('product_advertise','*',array('id'=>$edit));
      	$users_data = $brand_data = $product_data = array();
      	if(!empty($advertise_data))
      	{
      		$users_data = $this->custom_model->get_data_array("SELECT id,first_name FROM admin_users WHERE  id!='1' AND type='suppler'  Order BY id ASC  ");   

      		$brand_data = $this->custom_model->my_where('brand','id,brand_name',array('seller_id'=>$advertise_data[0]['seller_id']));   

      		$product_data = $this->custom_model->my_where('product','id,product_name',array('seller_id'=>$advertise_data[0]['seller_id'],'product_delete'=>0));   	
      	}

      	
      	// echo "<pre>";
      	// print_r($users_data);
      	// die;
		$this->mPageTitle = $page_title;
		$this->mViewData['form'] = $form;		
		$this->mViewData['page_title'] = $page_title;		
		$this->mViewData['back_link'] = $back_link;		
		$this->mViewData['users_data'] = $users_data;		
		$this->mViewData['brand_data'] = $brand_data;		
		$this->mViewData['product_data'] = $product_data;		
		$this->mViewData['edit'] = $advertise_data;		
		$this->mViewData['ajax_url'] = base_url('admin/home_data/edit_advertise/').$edit;		
		$this->render('home_data/advertise/create');					
	}

	public function detete_advertise()
    {
    	$post_data=$this->input->post();
    	if(!empty($post_data))
    	{
    		$pid=$post_data['pid'];
    		$this->custom_model->my_delete(['id' => $pid], 'product_advertise');    		
    		echo 1;
    		die;
    	}else {
    		echo 0;
    		die;
    	}
    }

	public function seller_brand()
	{
		$post_data = $this->input->post();			
		if(!empty($post_data))
		{			
			// echo "<pre>";
			// print_r($post_data);die;	
			$brand_data = $this->custom_model->my_where('brand','id,brand_name',array('seller_id'=>$post_data['seller_id']));
			if(!empty($brand_data))
			{
				echo json_encode($brand_data);			
				die;
			}else {
				echo "not_found";
				die;
			}						
		}else {
			echo 0;
			die;
		}			
	}

	public function seller_product()
	{
		$post_data = $this->input->post();			
		if(!empty($post_data))
		{			
			// echo "<pre>";
			// print_r($post_data);die;	
			$product_data = $this->custom_model->my_where('product','id,product_name',array('seller_id'=>$post_data['seller_id'],'product_delete'=>0));
			if(!empty($product_data))
			{
				echo json_encode($product_data);			
				die;
			}else {
				echo "not_found";
				die;
			}						
		}else {
			echo 0;
			die;
		}			
	}

	public function product_advertise($rowno=0,$ajax='call',$serach='')
	{
		$language= $this->uri->segment(1);

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
			
				$advertise_data = $this->custom_model->get_data_array("SELECT padv.id , seller.first_name, pro.product_name, brand.brand_name FROM product_advertise as padv INNER JOIN admin_users as seller ON padv.seller_id=seller.id  INNER JOIN brand as brand ON padv.brand_id=brand.id  INNER JOIN product as pro ON padv.product_id=pro.id  ORDER BY padv.id ASC limit $rowno,$rowperpage "); 

				$advertise_count = $this->custom_model->get_data_array("SELECT COUNT(padv.id) as advertise_count FROM product_advertise as padv INNER JOIN admin_users as seller ON padv.seller_id=seller.id  INNER JOIN brand as brand ON padv.brand_id=brand.id  INNER JOIN product as pro ON padv.product_id=pro.id  ORDER BY padv.id ASC  "); 
			
   		}else 
   		{
			if(empty($serach))
			{

				$advertise_data = $this->custom_model->get_data_array("SELECT padv.id , seller.first_name, pro.product_name, brand.brand_name FROM product_advertise as padv INNER JOIN admin_users as seller ON padv.seller_id=seller.id  INNER JOIN brand as brand ON padv.brand_id=brand.id  INNER JOIN product as pro ON padv.product_id=pro.id  ORDER BY padv.id ASC limit $rowno,$rowperpage "); 

				$advertise_count = $this->custom_model->get_data_array("SELECT COUNT(padv.id) as advertise_count FROM product_advertise as padv INNER JOIN admin_users as seller ON padv.seller_id=seller.id  INNER JOIN brand as brand ON padv.brand_id=brand.id  INNER JOIN product as pro ON padv.product_id=pro.id  ORDER BY padv.id ASC  "); 
					

			}
			else {	

					$advertise_data = $this->custom_model->get_data_array("SELECT padv.id , seller.first_name, pro.product_name, brand.brand_name FROM product_advertise as padv INNER JOIN admin_users as seller ON padv.seller_id=seller.id  INNER JOIN brand as brand ON padv.brand_id=brand.id  INNER JOIN product as pro ON padv.product_id=pro.id WHERE seller.first_name LIKE '%$serach%'  OR pro.product_name LIKE '%$serach%' OR brand.brand_name LIKE '%$serach%'  ORDER BY padv.id ASC limit $rowno,$rowperpage ");

					$advertise_count = $this->custom_model->get_data_array("SELECT COUNT(padv.id) as advertise_count FROM product_advertise as padv INNER JOIN admin_users as seller ON padv.seller_id=seller.id  INNER JOIN brand as brand ON padv.brand_id=brand.id  INNER JOIN product as pro ON padv.product_id=pro.id WHERE seller.first_name LIKE '%$serach%'  OR pro.product_name LIKE '%$serach%' OR brand.brand_name LIKE '%$serach%' ORDER BY padv.id ASC ");
					
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
		$config['base_url'] = base_url().'admin/brand/index';
	    $config['use_page_numbers'] = TRUE;
	    $config['total_rows'] = $advertise_count[0]['advertise_count'];
	    $config['per_page'] = $rowperpage;   
	    $config['page_query_string'] = FALSE;             
	    $config['enable_query_strings'] = FALSE;             
	    $config['reuse_query_string']  = FALSE;             
	    $config['cur_page'] = $page_no;  
	    
	     // Initialize
	    $this->pagination->initialize($config);
	     // Initialize $data Array
	    $data['pagination'] = $this->pagination->create_links();
	    $data['result'] = $advertise_data;
	    $data['row'] = $rowno;
	    $data['total_rows'] = $advertise_count[0]['advertise_count'];
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
		// print_r($brand_data);
		// die;
		$this->mPageTitle = 'Advertis List';		
		$this->mViewData['advertise_data'] = $advertise_data;
		$this->mViewData['seller_id'] = $this->mUser->id;
		$this->render('home_data/advertise/list');		

	}


	public function single_image()
	{
		$crud = $this->generate_crud('single_image');
		$crud->columns('id','heading', 'image');
		
		$crud->set_field_upload('image', BANNER_PATH);

		// $page= array('active'=>'Active','deactive'=>'Deactive');
		
         // $crud->field_type('status','dropdown',$page);
		// $crud->display_as('editor','editor');
		// $crud->display_as('title','Pages');
		
		$crud->set_theme('datatables');
		$crud->unset_add();
		$crud->unset_delete();
		// $crud->unset_edit();

		 $crud->set_rules('heading','Please enter heading','required');
		 $crud->set_rules('image','Please select image','required');		 

		// $crud->add_action('translate', '', 'admin/home_data/testimonial_tedit', '');
		// $crud->add_action('edit', '', 'admin/home_data/testimonial_edit', '');

		$this->mPageTitle = 'Single Image';
		$this->render_crud();
	}

}
