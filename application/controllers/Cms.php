<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Faq page
 */
class Cms extends MY_Controller
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

        // $product_data = $this->custom_model->get_data_array("SELECT * FROM $banner Order by id desc ");

        // $this->mViewData['product_data'] =$product_data;
        $this->Urender('cms', 'udefault');
    }

}

?>
