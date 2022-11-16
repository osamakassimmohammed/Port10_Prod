<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Help page
 */
class Help extends MY_Controller {

	public function __construct()
	{
		$this->load->model('User_model');
		$this->load->model('admin/Custom_model','custom_model');		
	}

	public function index()
	{
		$language= $this->uri->segment(1);		
		if($language=="en")
		{
			$tutorial = "tutorial";			
			$faq = "faq";			
		}else{
			$tutorial = "tutorial_trans";			
			$faq = "faq_trans";			
		}
		
		$tutorial_data = $this->custom_model->get_data_array("SELECT * FROM $tutorial WHERE status='active' Order by id ASC ");
		$faq_data = $this->custom_model->get_data_array("SELECT * FROM $faq Order by id ASC ");

		// echo "<pre>";
		// print_r($tutorial_data);
		// print_r($faq_data);
		// die;

		$this->mViewData['tutorial_data'] =$tutorial_data;
		$this->mViewData['faq_data'] =$faq_data;
		$this->Urender('help', 'udefault');
	}
}

?>		