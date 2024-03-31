<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Email extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_builder');
        $this->load->model('custom_model');
        $this->load->model('category_model');
        if ($this->session->userdata('group_id') != 1) {
            redirect('admin');
        }
    }

    public function index()
    {
        $crud = $this->generate_crud('newsletter');
        $crud->columns('id', 'email', 'created_date', 'status');
        $crud->where('email!=', '');
        // $_SERVER['DOCUMENT_ROOT'].'/port10/assets/';
        // $crud->set_field_upload('image', 'assets/admin/blog/');
        $page = array('active' => 'Active', 'deactive' => 'Deactive');

        $crud->field_type('status', 'dropdown', $page);
        $crud->field_type('email', 'readonly');
        $crud->field_type('created_date', 'readonly');

        $crud->display_as('created_date', 'Date Subscribed');
        // $crud->display_as('title','Pages');

        $crud->set_theme('datatables');
        $crud->unset_add();
        $crud->unset_read();
        $crud->unset_delete();
        // $crud->unset_edit();


        // $crud->add_action('translate', '', 'admin/blog/tedit', '');
        // $crud->add_action('edit', '', 'admin/blog/edit', '');

        $this->mPageTitle = 'newsletter';
        $this->render_crud();
    }


}

?>

