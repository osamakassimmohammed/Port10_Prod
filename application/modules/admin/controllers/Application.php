<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Application extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
		$this->load->model('custom_model');
		$this->load->model('category_model');
		date_default_timezone_set("Asia/Riyadh");
	}

	// Frontend Category CRUD
	public function banner()
	{
		$crud = $this->generate_crud('banner');
		$crud->columns('id','image' , 'category');
		
		$crud->set_field_upload('image', UPLOAD_BLOG_POST);

		// $crud->display_as('editor','editor');
		// $crud->display_as('title','Pages');
		
		$crud->set_theme('datatables');


		$category = $this->custom_model->my_where("category","id,display_name",array("status" => 'active'));
		if(!empty($category))
		{
			$cat = array();
			foreach ($category as $ckey => $cvalue) 
			{
				$cat[$cvalue['id']]= $cvalue['display_name'];
			}
		}

		$crud->field_type('category','dropdown', $cat);
		$crud->set_rules('category','category','required');		
		$crud->set_rules('image','image','required');
		$this->mPageTitle = 'Add Banner for english';
		$this->render_crud();
	}
}
