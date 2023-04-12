<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Faq page
 */
class Landing extends MY_Controller
{

	public function __construct()
	{
		$this->load->model('User_model');
		$this->load->model('admin/Custom_model', 'custom_model');
	}
    public function index()
    {
        $this->Urender('landing_page', 'udefault');
    }
}    