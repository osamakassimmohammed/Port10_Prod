<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Send_inquiry extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_builder');
        $this->load->model('custom_model');
        $this->load->model('category_model');
    }


    public function index($rowno = 0, $ajax = 'call', $serach = '')
    {
        // $users_data = $this->custom_model->my_where('admin_users','*',array('id!=' =>'1'));
        $seller_id = $this->mUser->id;
        $this->load->library('pagination');

        $post_data = $this->input->post();

        if (!empty($post_data)) {
            $rowno = $post_data['pagno'];
            $ajax = $post_data['ajax'];
            $serach = $post_data['serach'];
        }
        // Row per page
        $rowperpage = 25;
        $page_no = 0;

        // Row position
        if ($rowno != 0) {
            $page_no = $rowno;
            $rowno = ($rowno - 1) * $rowperpage;
        }
        if ($ajax == 'call') {
            $send_inquiry = $this->custom_model->get_data_array("SELECT * FROM send_inquiry WHERE vender_id='$seller_id' Order BY id DESC limit $rowno,$rowperpage ");

            $send_inquiry_count = $this->custom_model->get_data_array("SELECT id FROM send_inquiry WHERE vender_id='$seller_id' Order BY id DESC  ");

        } else {
            if (empty($serach)) {
                $send_inquiry = $this->custom_model->get_data_array("SELECT * FROM send_inquiry WHERE vender_id='$seller_id' Order BY id DESC limit $rowno,$rowperpage ");

                $send_inquiry_count = $this->custom_model->get_data_array("SELECT id FROM send_inquiry WHERE vender_id='$seller_id' Order BY id DESC  ");

            } else {

                // $send_inquiry = $this->custom_model->get_data_array("SELECT * FROM send_inquiry WHERE first_name LIKE '%$serach%' OR last_name LIKE '%$serach%' OR email LIKE '%$serach%' OR phone LIKE '%$serach%' Order BY id DESC limit $rowno,$rowperpage ");

                $send_inquiry = $this->custom_model->get_data_array("SELECT * FROM send_inquiry WHERE vender_id='$seller_id' Order BY id DESC limit $rowno,$rowperpage ");

                $send_inquiry_count = $this->custom_model->get_data_array("SELECT id FROM send_inquiry WHERE vender_id='$seller_id' Order BY id DESC  ");

            }
        }


        // echo "<pre>";
        // print_r($send_inquiry);
        // die;
        $config['base_url'] = base_url() . 'admin/car_listing/dealer';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = count($send_inquiry_count);
        $config['per_page'] = $rowperpage;
        $config['page_query_string'] = FALSE;
        $config['enable_query_strings'] = FALSE;
        $config['reuse_query_string'] = FALSE;
        $config['cur_page'] = $page_no;

        // Initialize
        $this->pagination->initialize($config);
        // Initialize $data Array
        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $send_inquiry;
        $data['row'] = $rowno;
        $data['total_rows'] = count($send_inquiry_count);
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
        // echo "<pre>";
        // print_r($send_inquiry);
        // die;
        $this->mPageTitle = 'Inquery Request';
        $this->mViewData['send_inquiry'] = $send_inquiry;
        $this->render('send_inquiry/list');
    }


}

?>

