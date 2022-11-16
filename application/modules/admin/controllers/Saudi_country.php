<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Saudi_country extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
		$this->load->model('custom_model');
		$this->load->model('category_model');		
	}

	// Frontend Category CRUD
	public function index()
	{
		$crud = $this->generate_crud('state_list');
		$crud->columns('id','state_name');
		
		// $crud->set_field_upload('image', BANNER_PATH);


		// $crud->display_as('editor','editor');
		// $crud->display_as('title','Pages');
		
		$crud->set_theme('datatables');
		// $crud->unset_add();
		// $crud->unset_delete();
		// $crud->unset_edit();

		$crud->set_rules('state_name','Please enter state name','required');

		// $crud->add_action('translate', '', 'admin/home_data/banner_tedit', '');
		// $crud->add_action('edit', '', 'admin/home_data/banner_edit', '');

		$this->mPageTitle = 'Add State';
		$this->render_crud();
	}

	public function city_list()
	{
		$crud = $this->generate_crud('city_list');
		$crud->columns('id','city_name');
		
		// $crud->set_field_upload('image', BANNER_PATH);


		// $crud->display_as('editor','editor');
		// $crud->display_as('title','Pages');
		
		$crud->set_theme('datatables');
		// $crud->unset_add();
		// $crud->unset_delete();
		// $crud->unset_edit();

		$crud->set_rules('city_name','Please enter city name','required');

		// $crud->add_action('translate', '', 'admin/home_data/banner_tedit', '');
		// $crud->add_action('edit', '', 'admin/home_data/banner_edit', '');

		$this->mPageTitle = 'Add City';
		$this->render_crud();
	}

	public function postal_code_list()
	{
		$crud = $this->generate_crud('postal_code_list');
		$crud->columns('id','postal_code');
		
		// $crud->set_field_upload('image', BANNER_PATH);


		// $crud->display_as('editor','editor');
		// $crud->display_as('title','Pages');
		
		$crud->set_theme('datatables');
		// $crud->unset_add();
		// $crud->unset_delete();
		// $crud->unset_edit();

		$crud->set_rules('postal_code','Please enter postal code','required');

		// $crud->add_action('translate', '', 'admin/home_data/banner_tedit', '');
		// $crud->add_action('edit', '', 'admin/home_data/banner_edit', '');

		$this->mPageTitle = 'Add Postal Code';
		$this->render_crud();
	}

}

?>
