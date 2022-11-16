<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductAttribute extends Admin_Controller {

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

	
		$udata = $this->custom_model->my_where('admin_users_groups','*',array('user_id' => $this->mUser->id),array(),"","","","","",array(),"",false);
		$this->mViewData['vendor'] = 0;


		// $acategories = $this->custom_model->my_where('category','*',array(),array(),"parent","asc","","",array(),"object");

		// // echo  $this->db->last_query();
		// // die;
		// // echo "<pre>";
		// // print_r($acategories);
		// // die;
		// $acatp = array();
		// if(!empty($acategories)){
		// 	foreach ($acategories as $ckey => $cvalue) {
		// 		$parent = $cvalue->parent;
		// 		$acatp[$parent][] = $cvalue;
		// 	}
		// }
		// asort($acatp);

		// // echo "<pre>";
		// // print_r($actap);
		// // die;

		// // echo "<pre>";
		// // print_r($acategories);
		// // die;
		// $this->mViewData['acatp'] = $acatp;


		$this->mPageTitle = 'Product Attribute';
		$this->render('Product_attribute/view');
	}


	public function create()
	{
        $form = $this->form_builder->create_form();



        $this->mPageTitle = 'Product Attribute';

		$this->mViewData['form'] = $form;
		$this->render('Product_attribute/create');

	}
	

}