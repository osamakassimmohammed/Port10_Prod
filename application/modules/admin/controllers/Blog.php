<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends Admin_Controller
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

    // Frontend Category CRUD
    public function index($rowno = 0, $ajax = 'call', $serach = '')
    {

        $this->load->library('pagination');

        $post_data = $this->input->post();

        if (!empty($post_data)) {
            $rowno = $post_data['pagno'];
            $ajax = $post_data['ajax'];
            $serach = $post_data['serach'];
        }
        // Row per page
        $rowperpage = 10;
        $page_no = 0;

        // Row position
        if ($rowno != 0) {
            $page_no = $rowno;
            $rowno = ($rowno - 1) * $rowperpage;
        }
        if ($ajax == 'call') {
            $blog_data = $this->custom_model->get_data_array("SELECT blog.id,blog.image,blog.heading,blog.description,blog.status,blog.created_date,blog.date_of_publish,blog_type.name  FROM blog  INNER JOIN blog_type  ON blog.blog_type_id=blog_type.id ORDER BY blog.id ASC limit $rowno,$rowperpage ");

            $blog_count = $this->custom_model->get_data_array("SELECT COUNT(blog.id) as blog_count   FROM blog  INNER JOIN blog_type  ON blog.blog_type_id=blog_type.id ORDER BY blog.id ASC ");

        } else {
            if (empty($serach)) {
                $blog_data = $this->custom_model->get_data_array("SELECT blog.id,blog.image,blog.heading,blog.description,blog.status,blog.created_date,blog.date_of_publish,blog_type.name  FROM blog  INNER JOIN blog_type  ON blog.blog_type_id=blog_type.id ORDER BY blog.id ASC limit $rowno,$rowperpage ");

                $blog_count = $this->custom_model->get_data_array("SELECT COUNT(blog.id) as blog_count   FROM blog  INNER JOIN blog_type  ON blog.blog_type_id=blog_type.id ORDER BY blog.id ASC ");

            } else {

                $blog_data = $this->custom_model->get_data_array("SELECT blog.id,blog.image,blog.heading,blog.description,blog.status,blog.created_date,blog.date_of_publish,blog_type.name  FROM blog  INNER JOIN blog_type  ON blog.blog_type_id=blog_type.id WHERE blog.heading LIKE '%$serach%' OR blog.status LIKE '%$serach%' OR blog.created_date LIKE '%$serach%' OR blog_type.name LIKE '%$serach%'  ORDER BY blog.id ASC limit $rowno,$rowperpage ");

                $blog_count = $this->custom_model->get_data_array("SELECT COUNT(blog.id) as blog_count  FROM blog  INNER JOIN blog_type  ON blog.blog_type_id=blog_type.id WHERE blog.heading LIKE '%$serach%' OR blog.status LIKE '%$serach%' OR blog.created_date LIKE '%$serach%' OR blog_type.name LIKE '%$serach%'  ORDER BY blog.id ASC ");
            }
        }


        if (!empty($blog_data)) {
            // $description=strip_tags($bd_val['description']);
            // $description = explode(" ", $description);
            // $description = implode(" ", array_splice($description, 0, 4));
            // $blog_data[$bd_key]['description']=$description;
            foreach ($blog_data as $bd_key => $bd_val) {
                $blog_data[$bd_key]['created_date'] = date('d-m-Y', strtotime($bd_val['created_date']));
            }
        }


        // echo "<pre>";
        // print_r($contact_request);
        // die;
        $config['base_url'] = base_url() . 'admin/blog/index';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $blog_count[0]['blog_count'];
        $config['per_page'] = $rowperpage;
        $config['page_query_string'] = FALSE;
        $config['enable_query_strings'] = FALSE;
        $config['reuse_query_string'] = FALSE;
        $config['cur_page'] = $page_no;

        // Initialize
        $this->pagination->initialize($config);
        // Initialize $data Array
        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $blog_data;
        $data['row'] = $rowno;
        $data['total_rows'] = $blog_count[0]['blog_count'];
        // $this->mViewData['pagination'] = $this->pagination->create_links();
        // this for when page load
        if ($ajax == 'call' && $rowno == 0 && empty($post_data)) {
            $this->mViewData['pagination'] = $this->pagination->create_links();
        } elseif ($serach != '') {  // this for search button pagination
            echo json_encode($data);
            exit;
        } else { // this for pagination-
            echo json_encode($data);
            exit;
        }

        // echo "<Pre>";
        // print_r($blog_data);
        // die;
        $this->mPageTitle = 'Blog List';
        $this->mViewData['blog_data'] = $blog_data;
        $this->render('blog/list');

    }


    public function create()
    {
        $form = $this->form_builder->create_form();
        $post_data = $this->input->post();
        if (!empty($post_data)) {
            // echo "<pre>";
            // print_r($post_data);
            // die;

            if (empty($post_data['image'])) {
                $this->system_message->set_error('Please upload image');
            } else {
                $post_data['created_date'] = date("Y-m-d h:i:s");
                $response = $this->custom_model->my_insert($post_data, 'blog');
                $response = $this->custom_model->my_insert($post_data, 'blog_trans');

                if ($response) {
                    // success
                    $this->system_message->set_success('Blog created successfully');
                } else {
                    // failed
                    $this->system_message->set_error('Something went wrong');
                }
            }
        }
        $blog_type = $this->custom_model->get_data_array("SELECT * FROM blog_type Order by id desc ");
        $this->mPageTitle = 'Create Blog';
        $this->mViewData['form'] = $form;
        $this->mViewData['blog_type'] = $blog_type;
        $this->render('blog/create');
    }

    public function edit($cate_id)
    {
        $form = $this->form_builder->create_form();
        $post_data = $this->input->post();

        if (!empty($post_data)) {
            // echo "<pre>";
            // print_r($post_data);
            // die;
            // $cate_data = $this->custom_model->my_where('blog','*',array('id' => $cate_id));
            $update = array();
            $update['blog_type_id'] = $post_data['blog_type_id'];
            // proceed to create Category
            $response = $this->custom_model->my_update($post_data, array('id' => $cate_id), 'blog');
            $this->custom_model->my_update($update, array('id' => $cate_id), 'blog_trans');

            if ($response) {
                // success
                $this->system_message->set_success('Blog Edited successfully');
            } else {
                // failed
                $this->system_message->set_error('Something went wrong');
            }

            refresh();
        }

        $cate_data = $this->custom_model->my_where('blog', '*', array('id' => $cate_id));
        $blog_type = $this->custom_model->get_data_array("SELECT * FROM blog_type Order by id desc ");
        $this->mViewData['edit'] = $cate_data[0];
        $this->mPageTitle = 'Edit Blog';
        $this->mViewData['form'] = $form;
        $this->mViewData['blog_type'] = $blog_type;
        $this->render('blog/create');
    }


    public function tedit($cate_id)
    {
        $form = $this->form_builder->create_form();
        $post_data = $this->input->post();

        if (!empty($post_data)) {
            // echo "<pre>";
            // print_r($post_data);
            // die;
            // $cate_data = $this->custom_model->my_where('banner_trans','*',array('id' => $cate_id));
            $update = array();
            $update['blog_type_id'] = $post_data['blog_type_id'];

            // proceed to create Category
            $response = $this->custom_model->my_update($post_data, array('id' => $cate_id), 'blog_trans');
            $response = $this->custom_model->my_update($update, array('id' => $cate_id), 'blog');

            if ($response) {
                // success
                $this->system_message->set_success('تم تعديل البانر بنجاح');
            } else {
                // failed
                $this->system_message->set_error('هناك خطأ ما');
            }

            refresh();
        }
        $blog_type = $this->custom_model->get_data_array("SELECT id,name_trans as name FROM blog_type Order by id desc ");
        $cate_data = $this->custom_model->my_where('blog_trans', '*', array('id' => $cate_id));
        $this->mViewData['edit'] = $cate_data[0];
        $this->mPageTitle = 'Edit Banner';
        $this->mViewData['form'] = $form;
        $this->mViewData['blog_type'] = $blog_type;
        $this->render('blog/create');
    }

    public function detete_blog()
    {
        $post_data = $this->input->post();
        if (!empty($post_data)) {
            $pid = $post_data['pid'];
            $this->custom_model->my_delete(['id' => $pid], 'blog');
            $this->custom_model->my_delete(['id' => $pid], 'blog_trans');
            echo 1;
            die;
        } else {
            echo 0;
            die;
        }
    }


}
