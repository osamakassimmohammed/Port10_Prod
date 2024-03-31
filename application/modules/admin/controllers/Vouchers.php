<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vouchers extends Admin_Controller
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
        $table_name = "vouchers";
        $page_title = 'Vouchers List';
        $data = $this->custom_model->my_where($table_name, '*', array());
        $edit_link = base_url('admin/vouchers/edit/');
        $tedit_link = base_url('admin/vouchers/tedit/');
        // echo "<pre>";
        // print_r($data);
        // die;

        $this->mViewData['page_title'] = $page_title;
        $this->mViewData['data'] = $data;
        $this->mViewData['edit_link'] = $edit_link;
        $this->mViewData['tedit_link'] = $tedit_link;
        $this->render('vouchers/list');
    }

    public function create()
    {
        $form = $this->form_builder->create_form();
        // echo "<pre>";
        // print_r($form);
        // die;
        $post_data = $this->input->post();
        $table_name = "vouchers";
        $table_name_trans = "vouchers";
        $page_title = 'Add Service';
        $back_link = base_url('admin/vouchers');
        if (!empty($post_data)) {
            // echo "<pre>";
            // print_r($post_data);
            // die;
            $is_data = $this->custom_model->my_where($table_name, '*', array('code' => $post_data['code']));
            if (empty($is_data)) {
                $response = $this->custom_model->my_insert($post_data, $table_name);
                if ($response) {
                    echo 'add';
                    die;
                } else {
                    echo 'someting';
                    die;
                }
            } else {
                echo 'already';
                die;
            }

            // $response = $this->custom_model->my_insert( $post_data,$table_name_trans);


        }

        // echo "<pre>";
        // print_r($category_data);
        // die;
        $this->mViewData['form_url'] = base_url('admin/Vouchers/create');
        $this->mPageTitle = $page_title;
        $this->mViewData['form'] = $form;
        $this->mViewData['page_title'] = $page_title;
        $this->mViewData['back_link'] = $back_link;
        $this->render('vouchers/create');
    }

    public function edit($cate_id)
    {
        $form = $this->form_builder->create_form();
        $post_data = $this->input->post();
        $table_name = "vouchers";
        $page_title = 'Edit vouchers';
        $back_link = base_url('admin/vouchers');
        if (!empty($post_data)) {

            $is_data = $this->custom_model->my_where($table_name, '*', array('code' => $post_data['code'], 'id!=' => $cate_id));
            if (empty($is_data)) {
                // $response = $this->custom_model->my_insert( $post_data,$table_name);
                $response = $this->custom_model->my_update($post_data, array('id' => $cate_id), $table_name);
                if ($response) {
                    echo 'update';
                    die;
                } else {
                    echo 'someting';
                    die;
                }
            } else {
                echo 'already';
                die;
            }
        }


        $cate_data = $this->custom_model->my_where($table_name, '*', array('id' => $cate_id));
        $this->mViewData['form_url'] = base_url('admin/vouchers/edit/') . $cate_id;
        $this->mViewData['edit'] = $cate_data[0];
        $this->mPageTitle = $page_title;
        $this->mViewData['form'] = $form;
        $this->mViewData['page_title'] = $page_title;
        $this->mViewData['back_link'] = $back_link;

        $this->render('vouchers/create');
    }
}

?>
