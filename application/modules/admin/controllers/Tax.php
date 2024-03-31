<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tax extends Admin_Controller
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

    // Frontend Category CRUD
    public function index()
    {
        $language = $this->uri->segment(1);
        $table_name = "tax";
        // $page_title='Payment Profile Debtor List';
        $page_title = 'Tax List';
        $data = $this->custom_model->my_where($table_name, '*', array());
        $edit_link = base_url($language . '/admin/tax/edit/');
        $tedit_link = base_url($language . '/admin/tax/tedit/');
        // echo "<pre>";
        // print_r($data);
        // die;

        $this->mViewData['page_title'] = $page_title;
        $this->mViewData['data'] = $data;
        $this->mViewData['edit_link'] = $edit_link;
        $this->mViewData['tedit_link'] = $tedit_link;
        $this->render('tax/list');
    }

    public function edit($cate_id)
    {
        $form = $this->form_builder->create_form();
        $post_data = $this->input->post();
        $language = $this->uri->segment(1);
        $table_name = "tax";
        $page_title = 'Edit Tax';
        $back_link = base_url($language . '/admin/tax');
        if (!empty($post_data)) {
            if (empty(trim($post_data['vat']))) {
                $this->system_message->set_error('Please Enter Vat Rate');
            } else if (empty(trim($post_data['sar_rate']))) {
                $this->system_message->set_error('Please Enter SAR Rate');
            } else if (empty(trim($post_data['commission']))) {
                $this->system_message->set_error('Please Enter commission');
            } else {
                $post_data['transfer_fees'] = $post_data['sarie_transfer_fees'] + $post_data['rajhi_bank_fees'];
                // echo "<pre>";
                // print_r($post_data);
                // die;
                $response = $this->custom_model->my_update($post_data, array('id' => $cate_id), $table_name);
                if ($response) {
                    // success
                    $this->system_message->set_success('Edited successfully');
                } else {
                    // failed
                    $this->system_message->set_error('Something went wrong');
                }
            }

            refresh();
        }


        $cate_data = $this->custom_model->my_where($table_name, '*', array('id' => $cate_id));
        $this->mViewData['edit'] = $cate_data[0];
        $this->mPageTitle = $page_title;
        $this->mViewData['form'] = $form;
        $this->mViewData['page_title'] = $page_title;
        $this->mViewData['back_link'] = $back_link;

        $this->render('tax/create');
    }


}
