<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subs_plans extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_builder');
        $this->load->model('custom_model');
        $this->load->model('category_model');
        $language = $this->uri->segment(1);
        $this->is_admin($language);
    }

    public function index()
    {
        $crud = $this->generate_crud('subs_plans');
        $language = $this->uri->segment(1);
        $crud->columns('id', 'title', 'description', 'plan_title', 'amount', 'duration');

        // $crud->set_field_upload('image', UPLOAD_BLOG_POST);

        // $crud->display_as('newsletter','footer about');
        // $crud->display_as('title','Pages');
        $data = $this->custom_model->my_where('subs_plans', '*', array());
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $data_trans = $this->custom_model->my_where('subs_plans_trans', '*', array('id' => $value['id']));
                if (empty($data_trans)) {
                    $insert_data['id'] = $value['id'];
                    $insert_data['title'] = $value['title'];
                    $insert_data['description'] = $value['description'];
                    $insert_data['plan_title'] = $value['plan_title'];
                    $insert_data['amount'] = $value['amount'];
                    $insert_data['duration'] = $value['duration'];
                    $insert_data['created_date'] = $value['created_date'];
                    $this->custom_model->my_insert($insert_data, 'subs_plans_trans');
                }
            }
        }
        $crud->unset_texteditor('description', 'full_text');

        $crud->set_theme('datatables');
        // disable direct create / delete Category
        $crud->unset_add();
        // $crud->unset_edit();
        $crud->unset_delete();
        $crud->unset_read();
        $crud->unset_back_to_list();

        // $crud->field_type('category','dropdown', array('active' => 'Active', 'deactive' => 'Deactive'));
        // $crud->field_type('contact_no2', 'hidden','');
        $page = array('1' => 'Per Year');

        $crud->field_type('duration', 'dropdown', $page);
        $crud->set_rules('title', 'Please enter title', 'required');
        $crud->set_rules('description', 'Please enter description', 'required');
        $crud->set_rules('plan_title', 'Please enter plan title', 'required');
        $crud->set_rules('amount', 'Please enter amount', 'required');
        $crud->set_rules('duration', 'Please select duration', 'required');


        $crud->add_action('translate', '', $language . '/admin/subs_plans/tedit/edit', '');
        // $crud->add_action('edit', '', 'admin/pages/edit', '');

        $this->mPageTitle = 'Subscription Plan';
        $this->render_crud();
    }

    public function tedit()
    {
        $crud = $this->generate_crud('subs_plans_trans');

        $crud->columns('id', 'title', 'description', 'plan_title', 'amount', 'duration');

        // $crud->set_field_upload('image', UPLOAD_BLOG_POST);

        // $crud->display_as('newsletter','footer about');
        // $crud->display_as('title','Pages');

        $crud->unset_texteditor('description', 'full_text');

        $crud->set_theme('datatables');
        // disable direct create / delete Category
        $crud->unset_add();
        // $crud->unset_edit();
        $crud->unset_delete();
        $crud->unset_read();
        $crud->unset_back_to_list();

        // $crud->field_type('category','dropdown', array('active' => 'Active', 'deactive' => 'Deactive'));
        // $crud->field_type('contact_no2', 'hidden','');
        $page = array('1' => 'Per Year');

        $crud->field_type('duration', 'dropdown', $page);
        $crud->set_rules('title', 'Please enter title', 'required');
        $crud->set_rules('description', 'Please enter description', 'required');
        $crud->set_rules('plan_title', 'Please enter plan title', 'required');
        $crud->set_rules('amount', 'Please enter amount', 'required');
        $crud->set_rules('duration', 'Please select duration', 'required');


        // $crud->add_action('translate', '', 'admin/pages/tedit', '');
        $crud->add_action('edit', '', 'admin/subs_plans/index/tedit', '');
        $this->mPageTitle = 'ADD Subs plans';
        $this->render_crud();
    }

    public function sub_more()
    {
        $language = $this->uri->segment(1);
        $table_name = "sub_more";
        // $page_title='Payment Profile Debtor List';
        $page_title = 'Subscription More List';
        $data = $this->custom_model->my_where($table_name, '*', array());
        $edit_link = base_url($language . '/admin/subs_plans/sub_more_edit/');
        $tedit_link = base_url($language . '/admin/subs_plans/sub_more_tedit/');
        // echo "<pre>";
        // print_r($data);
        // die;

        $this->mPageTitle = $page_title;
        $this->mViewData['data'] = $data;
        $this->mViewData['edit_link'] = $edit_link;
        $this->mViewData['tedit_link'] = $tedit_link;
        $this->render('subs_plans/list');
    }

    public function sub_more_create()
    {
        $form = $this->form_builder->create_form();
        $language = $this->uri->segment(1);
        $post_data = $this->input->post();
        $table_name = "sub_more";
        $table_name_trans = "sub_more_trans";
        $page_title = 'Add Subscription More';
        $back_link = base_url($language . '/admin/subs_plans/sub_more');
        if (!empty($post_data)) {
            // echo "<pre>";
            // print_r($post_data);
            // die;

            if (empty(trim($post_data['description']))) {
                $this->system_message->set_error('Please Enter Description');
            } else {
                $response = $this->custom_model->my_insert($post_data, $table_name);
                $response = $this->custom_model->my_insert($post_data, $table_name_trans);

                if ($response) {
                    // success
                    // $this->system_message->set_success($table_name.' created successfully');
                    $this->system_message->set_success('Record created successfully');
                } else {
                    // failed
                    $this->system_message->set_error('Something went wrong');
                }
            }
        }
        // echo "<pre>";
        // print_r($category_data);
        // die;
        $this->mPageTitle = $page_title;
        $this->mViewData['form'] = $form;
        $this->mViewData['page_title'] = $page_title;
        $this->mViewData['back_link'] = $back_link;
        $this->render('subs_plans/create');
    }

    public function sub_more_edit($cate_id)
    {
        $form = $this->form_builder->create_form();
        $post_data = $this->input->post();
        $language = $this->uri->segment(1);
        $table_name = "sub_more";
        $page_title = 'Edit Subscription More';
        $back_link = base_url($language . '/admin/subs_plans/sub_more');
        if (!empty($post_data)) {
            if (empty(trim($post_data['description']))) {
                $this->system_message->set_error('Please Enter Description');
            } else {

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

        $this->render('subs_plans/create');
    }

    public function sub_more_tedit($cate_id)
    {
        $form = $this->form_builder->create_form();
        $post_data = $this->input->post();
        $language = $this->uri->segment(1);
        $table_name = "sub_more_trans";
        $page_title = 'Edit Subscription More';
        $back_link = base_url($language . '/admin/subs_plans/sub_more');
        if (!empty($post_data)) {
            if (empty(trim($post_data['description']))) {
                $this->system_message->set_error('Please Enter Description');
            } else {

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

        $this->render('subs_plans/create');
    }

    public function sub_more_delete()
    {
        $post_data = $this->input->post();
        if (!empty($post_data)) {
            // echo "<pre>";
            // print_r($post_data);
            // die;
            $pid = $post_data['pid'];
            $this->custom_model->my_delete(array('id' => $pid), 'sub_more');
            $this->custom_model->my_delete(array('id' => $pid), 'sub_more_trans');
            echo 1;
            die;
        } else {
            echo 0;
            die;
        }
    }

    public function sub_more_old()
    {
        $crud = $this->generate_crud('sub_more');

        $crud->columns('id', 'description');

        // $crud->set_field_upload('image', UPLOAD_BLOG_POST);

        // $crud->display_as('newsletter','footer about');
        // $crud->display_as('title','Pages');
        $data = $this->custom_model->my_where('sub_more', '*', array());
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $data_trans = $this->custom_model->my_where('sub_more_trans', '*', array('id' => $value['id']));
                if (empty($data_trans)) {
                    $insert_data['id'] = $value['id'];
                    $insert_data['description'] = $value['description'];
                    $this->custom_model->my_insert($insert_data, 'sub_more_trans');
                }
            }
        }
        // $crud->unset_texteditor('description','full_text');

        $crud->set_theme('datatables');
        // disable direct create / delete Category
        // $crud->unset_add();
        // $crud->unset_edit();
        // $crud->unset_delete();
        $crud->unset_read();
        // $crud->field_type('category','dropdown', array('active' => 'Active', 'deactive' => 'Deactive'));
        // $crud->field_type('contact_no2', 'hidden','');
        // $page= array('1'=>'Per Year');

        // $crud->field_type('duration','dropdown',$page);
        $crud->set_rules('description', 'Please enter description', 'required');


        $crud->add_action('translate', '', 'admin/subs_plans/sub_more_trans/edit', '');
        // $crud->add_action('edit', '', 'admin/pages/edit', '');

        $this->mPageTitle = 'Sub more';
        $this->render_crud();
    }

    public function sub_more_trans()
    {
        $crud = $this->generate_crud('sub_more_trans');

        $crud->columns('id', 'description');

        // $crud->set_field_upload('image', UPLOAD_BLOG_POST);

        // $crud->display_as('newsletter','footer about');
        // $crud->display_as('title','Pages');

        // $crud->unset_texteditor('description','full_text');

        $crud->set_theme('datatables');
        // disable direct create / delete Category
        $crud->unset_add();
        // $crud->unset_edit();
        $crud->unset_delete();

        // $crud->field_type('category','dropdown', array('active' => 'Active', 'deactive' => 'Deactive'));
        // $crud->field_type('contact_no2', 'hidden','');
        // $page= array('1'=>'Per Year');

        // $crud->field_type('duration','dropdown',$page);

        $crud->set_rules('description', 'Please enter description', 'required');

        // $crud->add_action('translate', '', 'admin/pages/tedit', '');
        $crud->add_action('edit', '', 'admin/subs_plans/sub_more/tedit', '');

        $this->mPageTitle = 'Subs More';
        $this->render_crud();
    }
}
