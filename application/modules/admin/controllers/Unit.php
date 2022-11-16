<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
		$this->load->model('custom_model');
		$this->load->model('category_model');
	}


	public function index()
	{
		$crud = $this->generate_crud('unit_list');
		$crud->columns('id', 'unit_name');	

		// $crud->set_field_upload('brand_image', UPLOAD_BLOG_POST);
		// $crud->display_as('editor','editor');
		// $crud->display_as('title','Pages');	

		$unit_list = $this->custom_model->my_where('unit_list','*',array());
		if(!empty($unit_list))
		{
			foreach ($unit_list as $bd_key => $bd_value) 
			{
				$unit_list_trans = $this->custom_model->my_where('unit_list_trans','*',array('id'=>$bd_value['id']));
				if(empty($unit_list_trans))
				{
					$insert_data['id']=$bd_value['id'];
					$insert_data['unit_name']=$bd_value['unit_name'];
					// $insert_data['brand_name']=$bd_value['brand_name'];
					$this->custom_model->my_insert($insert_data,'unit_list_trans');
				}
			}
		}
			
		$crud->set_theme('datatables');

		$crud->set_rules('unit_name','Please Enter Unit Name','required');

		// $crud->set_rules('brand_name','brand name','required');

		// $crud->unset_add();
		// $crud->unset_delete();
		// $crud->unset_edit();
		// $date = date('Y-m-d h:i:s');
		// $crud->field_type('created_date', 'hidden', $date);

		$crud->add_action('translate', '', 'admin/unit/unit_trans/edit', '');
		// $crud->add_action('edit', '', 'admin/pages/edit', '');

		$this->mPageTitle = 'Add Units';
		$this->render_crud();
	}

	public function unit_trans()
	{
		$crud = $this->generate_crud('unit_list_trans');
		$crud->columns('id', 'unit_name');	

		// $crud->set_field_upload('brand_image', UPLOAD_BLOG_POST);
		// $crud->display_as('editor','editor');
		// $crud->display_as('title','Pages');	

		$crud->set_theme('datatables');

		$crud->set_rules('unit_name','Please Enter Unit Name','required');

		// $crud->set_rules('brand_name','brand name','required');

		// $crud->unset_add();
		// $crud->unset_delete();
		// $crud->unset_edit();
		// $date = date('Y-m-d h:i:s');
		// $crud->field_type('created_date', 'hidden', $date);

		// $crud->add_action('translate', '', 'admin/pages/tedit', '');
		// $crud->add_action('edit', '', 'admin/pages/edit', '');

		$this->mPageTitle = 'Add Units';
		$this->render_crud();
	}
}

?>