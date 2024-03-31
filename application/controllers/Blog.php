<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Faq page
 */
class Blog extends MY_Controller
{

    public function __construct()
    {
        $this->load->model('User_model');
        $this->load->model('admin/Custom_model', 'custom_model');
    }

    public function index($blog_type_id = '')
    {
        $language = $this->uri->segment(1);
        if ($language == "en") {
            $blog = "blog";
            $blog_type_sel = "id, name";
        } else {
            $blog = "blog_trans";
            $blog_type_sel = "id, name_trans as name";
        }
        $blog_type = 'blog_type';

        if (empty($blog_type_id)) {
            $sub_query = " ";
        } else {
            $sub_query = " AND blog_type_id='$blog_type_id' ";
        }
        $blog_data = $this->custom_model->get_data_array("SELECT * FROM $blog WHERE status='active' $sub_query  Order by id desc limit 1 ");

        $blog_type_data = $this->custom_model->get_data_array("SELECT $blog_type_sel FROM $blog_type  Order by id desc ");
        if (!empty($blog_data)) {
            $blog_id = $blog_data[0]['id'];
            $blog_data2 = $this->custom_model->get_data_array("SELECT * FROM $blog WHERE status='active' AND id!='$blog_id' $sub_query  Order by id desc limit 10 ");
        } else {
            $blog_data2 = array();
        }

        // echo "<pre>";
        // print_r($blog_type_data);
        // die;

        $this->mViewData['blog_data'] = $blog_data;
        $this->mViewData['blog_data2'] = $blog_data2;
        $this->mViewData['blog_type_data'] = $blog_type_data;
        $this->mViewData['blog_type_id'] = $blog_type_id;
        $this->Urender('blog_listing', 'udefault');
    }

    public function detail($blog_id = '')
    {
        $language = $this->uri->segment(1);
        if ($language == "en") {
            $blog = "blog";
        } else {
            $blog = "blog_trans";
        }
        $blog_data = $this->custom_model->my_where($blog, "*", array('id' => $blog_id, 'status' => 'active'));
        // $product_data = $this->custom_model->get_data_array("SELECT * FROM $banner Order by id desc ");
        // echo "<pre>";
        // print_r($blog_data);
        // die;

        $this->mViewData['blog_data'] = $blog_data;
        $this->Urender('blog_detail', 'udefault');
    }
}

?>
