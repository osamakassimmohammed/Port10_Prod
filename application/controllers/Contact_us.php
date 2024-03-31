<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Faq page
 */
class Contact_us extends MY_Controller
{

    public function __construct()
    {
        $this->load->model('User_model');
        $this->load->model('admin/Custom_model', 'custom_model');
    }

    public function index()
    {
        $language = $this->uri->segment(1);
        if ($language == "en") {
            $product = "product";
            $category = "category";
            $brand = "brand";
            $banner = "banner";
            $unit_list = "unit_list";
        } else {
            $product = "product_trans";
            $category = "category_trans";
            $brand = "brand";
            $banner = "banner_trans";
            $unit_list = "unit_list_trans";
        }

        $post_data = $this->input->post();
        if (!empty($post_data)) {
            if (!empty($post_data['first_name']) && !empty($post_data['last_name']) && !empty($post_data['phone']) && !empty($post_data['email']) && !empty($post_data['message'])) {
                $insert_data = array();
                $insert_data['first_name'] = $post_data['first_name'];
                $insert_data['last_name'] = $post_data['last_name'];
                $insert_data['phone'] = $post_data['phone'];
                $insert_data['email'] = $post_data['email'];
                $insert_data['message'] = $post_data['message'];
                $insert_data['created_date'] = date("Y-m-d h:i:s");
                $responce = $this->custom_model->my_insert($insert_data, 'contact_request');
                if ($responce) {
                    echo 1;
                    die;
                } else {
                    echo 0;
                    die;
                }
            } else {
                echo "all_field";
                die;
            }
        }

        // $product_data = $this->custom_model->get_data_array("SELECT * FROM $banner Order by id desc ");

        // $this->mViewData['product_data'] =$product_data;
        $this->Urender('contact_us', 'udefault');
    }

}

?>
