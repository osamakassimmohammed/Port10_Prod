<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Faq page
 */
class Page extends MY_Controller
{

    public function __construct()
    {
        $this->load->model('User_model');
        $this->load->model('admin/Custom_model', 'custom_model');
    }

    public function index($slug)
    {
        $language = $this->uri->segment(1);
        if ($language == "en") {
            $pages = "pages";
        } else {
            $pages = "pages_trans";
        }

        $page_data = $this->custom_model->get_data_array("SELECT * FROM $pages WHERE slug='$slug' ");
        // echo "<pre>";
        // print_r($page_data);
        // die;
        $this->mViewData['page_data'] = $page_data;
        $this->Urender('pages', 'udefault');
    }

}

?>
