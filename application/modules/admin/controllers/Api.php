<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_builder');
        $this->load->model('custom_model');
        $this->load->model('category_model');
    }


    // Create Frontend Category
    public function index()
    {
        $this->mPageTitle = 'USER API';
        $this->render('admin/api/list');
    }

    // Create Frontend Category
    public function driver()
    {
        $this->mPageTitle = 'DRIVER API';
        $this->render('admin/api/driver');
    }
}
