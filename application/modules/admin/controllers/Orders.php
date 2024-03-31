<?php

use Mpdf\Mpdf;
use Mpdf\Output\Destination;

defined('BASEPATH') or exit('No direct script access allowed');

class Orders extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_builder');
        $this->load->model('custom_model');
        $language = $this->uri->segment(1);
        $this->is_admin($language);
    }

    public function test()
    {
        $orders = $this->custom_model->get_data_array("SELECT orm.order_master_id,orm.display_order_id,orm.order_datetime,orm.net_total,orm.payment_mode,orm.payment_status,orm.order_status,orm.currency,orm.coupon_price,orm.first_name,orm.last_name,ori.price FROM order_items as ori LEFT JOIN order_master as orm ON ori.order_no=orm.order_master_id   Order BY order_master_id DESC LIMIT 10 ");


        // FROM order_master as orm LEFT JOIN order_items as ori ON orm.order_master_id=ori.order_no
        // echo "<pre>";
        // print_r($orders);
        // die;
    }

    // Orders CRUD
    public function index($rowno = 0, $ajax = 'call', $serach = '')
    {
        //print_r($this->mUser);die;
        $udata = $this->custom_model->my_where('admin_users', '*', array('id' => $this->mUser->id), array(), "", "", "", "", "", array(), "", false);

        $user_id = $this->mUser->id;

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
            $orders = $this->custom_model->get_data_array("SELECT order_master_id,display_order_id,order_datetime,net_total,payment_mode,payment_status,order_status,currency,coupon_price,first_name,last_name  FROM order_master WHERE is_show='1'  Order BY order_master_id DESC limit $rowno,$rowperpage ");
            // $orders = $this->custom_model->get_data_array("SELECT order_master_id,display_order_id,order_datetime,net_total,payment_mode,payment_status,order_status  FROM order_master WHERE  `order_status` =  'delivered'  Order BY order_master_id DESC limit $rowno,$rowperpage ");
            $orders_count = $this->custom_model->get_data_array("SELECT order_master_id,display_order_id,order_datetime,net_total,payment_mode,payment_status,order_status  FROM order_master WHERE is_show='1'  Order BY order_master_id DESC  ");

        } else {
            if (empty($serach)) {
                $orders = $this->custom_model->get_data_array("SELECT order_master_id,display_order_id,order_datetime,net_total,payment_mode,payment_status,order_status,currency,first_name,last_name  FROM order_master  Order BY order_master_id DESC limit $rowno,$rowperpage ");
                $orders_count = $this->custom_model->get_data_array("SELECT order_master_id,display_order_id,order_datetime,net_total,payment_mode,payment_status,order_status  FROM order_master WHERE is_show='1'  Order BY order_master_id DESC ");
            } else {

                $orders = $this->custom_model->get_data_array("SELECT * FROM order_master WHERE (display_order_id LIKE '%$serach%' OR order_datetime LIKE '%$serach%' OR net_total LIKE '%$serach%' OR payment_status LIKE '%$serach%' OR payment_mode LIKE '%$serach%' OR order_status LIKE '%$serach%')  ORDER BY `order_master_id` DESC LIMIT $rowno,$rowperpage ");
                $orders_count = $this->custom_model->get_data_array("SELECT * FROM order_master WHERE ( display_order_id LIKE '%$serach%' OR order_datetime LIKE '%$serach%' OR net_total LIKE '%$serach%' OR payment_status LIKE '%$serach%' OR payment_mode LIKE '%$serach%' OR order_status LIKE '%$serach%')  ORDER BY `order_master_id` DESC ");
            }
        }

        $orders = $this->name_price($orders);


        // echo "<pre>";
        // print_r($orders);
        // die;

        $config['base_url'] = base_url() . 'admin/product/index';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = count($orders_count);
        $config['per_page'] = $rowperpage;
        $config['page_query_string'] = FALSE;
        $config['enable_query_strings'] = FALSE;
        $config['reuse_query_string'] = FALSE;
        $config['cur_page'] = $page_no;

        // Initialize
        $this->pagination->initialize($config);
        // Initialize $data Array
        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $orders;
        $data['row'] = $rowno;
        $data['total_rows'] = count($orders_count);
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
        // print_r($orders);
        // die;
        $this->mViewData['orders'] = $orders;
        $this->mPageTitle = ' Order Invoice';
        $this->render('order/list');
    }

    public function name_price($orders, $br = '<br>')
    {
        if (!empty($orders)) {
            foreach ($orders as $or_key => $or_val) {
                $order_master_id = $or_val['order_master_id'];
                $is_data = $this->custom_model->get_data_array("SELECT ori.order_status,admin.first_name,ori.sub_total FROM order_items as ori LEFT JOIN admin_users as admin ON ori.seller_id=admin.id WHERE  ori.order_no='$order_master_id' ");
                if (!empty($is_data)) {
                    $price_name = '';
                    $ori_order_status = '';
                    foreach ($is_data as $dkey => $dval) {
                        $price_name .= $dval['first_name'] . '-' . $dval['sub_total'] . ',' . $br;
                        $ori_order_status .= $dval['order_status'] . ',' . $br;
                    }
                    $orders[$or_key]['price_name'] = rtrim($price_name, ",<br>");
                    $orders[$or_key]['ori_order_status'] = rtrim($ori_order_status, ",<br>");
                }

                if ($or_val['payment_mode'] == 'cash-on-del') {
                    $orders[$or_key]['payment_mode'] = 'Virtual Account';
                } else {
                    $orders[$or_key]['payment_mode'] = 'Credit Card';
                }
            }
        }
        return $orders;
    }

    public function change_payment_status()
    {
        $post_data = $this->input->post();
        if (!empty($post_data) && isset($post_data['payment_status']) && isset($post_data['order_master_id'])) {
            $is_order = $this->custom_model->my_where("order_master", "order_master_id,payment_status", array("order_master_id" => $post_data['order_master_id']));
            if (!empty($is_order)) {
                if ($post_data['payment_status'] == 'Paid' || $post_data['payment_status'] == 'Unpaid') {
                    $response = $this->custom_model->my_update(array('payment_status' => $post_data['payment_status']), array('order_master_id' => $post_data['order_master_id']), 'order_master');
                    echo json_encode(array("status" => true, "message" => "Payment Status Change Successfully"));
                    die;
                } else {
                    echo json_encode(array("status" => false, "message" => "Invalid Payment Status Passed"));
                    die;
                }
            } else {
                echo json_encode(array("status" => false, "message" => "Something Went Wrong"));
                die;
            }
        } else {
            echo json_encode(array("status" => false, "message" => "Something Went Wrong"));
            die;
        }
    }

    public function cancel_order($rowno = 0, $ajax = 'call', $serach = '')
    {
        //print_r($this->mUser);die;
        $udata = $this->custom_model->my_where('admin_users', '*', array('id' => $this->mUser->id), array(), "", "", "", "", "", array(), "", false);

        $user_id = $this->mUser->id;

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
            $orders = $this->custom_model->get_data_array("SELECT order_master_id,display_order_id,order_datetime,net_total,payment_mode,payment_status,order_status,currency,coupon_price,first_name,last_name  FROM order_master WHERE  `order_status`='canceled'  Order BY order_master_id DESC limit $rowno,$rowperpage ");
            // $orders = $this->custom_model->get_data_array("SELECT order_master_id,display_order_id,order_datetime,net_total,payment_mode,payment_status,order_status  FROM order_master WHERE  `order_status` =  'delivered'  Order BY order_master_id DESC limit $rowno,$rowperpage ");
            $orders_count = $this->custom_model->get_data_array("SELECT order_master_id,display_order_id,order_datetime,net_total,payment_mode,payment_status,order_status  FROM order_master WHERE  `order_status`='canceled'  ");

        } else {
            if (empty($serach)) {
                $orders = $this->custom_model->get_data_array("SELECT order_master_id,display_order_id,order_datetime,net_total,payment_mode,payment_status,order_status,currency,coupon_price,first_name,last_name  FROM order_master WHERE  `order_status`='canceled'  Order BY order_master_id DESC limit $rowno,$rowperpage ");
                $orders_count = $this->custom_model->get_data_array("SELECT order_master_id,display_order_id,order_datetime,net_total,payment_mode,payment_status,order_status  FROM order_master WHERE  `order_status`='canceled' ");
            } else {

                $orders = $this->custom_model->get_data_array("SELECT * FROM order_master WHERE (display_order_id LIKE '%$serach%' OR order_datetime LIKE '%$serach%' OR net_total LIKE '%$serach%' OR payment_status LIKE '%$serach%' OR payment_mode LIKE '%$serach%' OR order_status LIKE '%$serach%') AND `order_status`='canceled' ORDER BY `order_master_id` DESC LIMIT $rowno,$rowperpage ");
                $orders_count = $this->custom_model->get_data_array("SELECT * FROM order_master WHERE (display_order_id LIKE '%$serach%' OR order_datetime LIKE '%$serach%' OR net_total LIKE '%$serach%' OR payment_status LIKE '%$serach%' OR payment_mode LIKE '%$serach%' OR order_status LIKE '%$serach%') AND `order_status`='canceled'  ORDER BY `order_master_id` ");
            }
        }

        $orders = $this->name_price($orders);

        $config['base_url'] = base_url() . 'admin/orders/cancel_order';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = count($orders_count);
        $config['per_page'] = $rowperpage;
        $config['page_query_string'] = FALSE;
        $config['enable_query_strings'] = FALSE;
        $config['reuse_query_string'] = FALSE;
        $config['cur_page'] = $page_no;

        // Initialize
        $this->pagination->initialize($config);
        // Initialize $data Array
        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $orders;
        $data['row'] = $rowno;
        $data['total_rows'] = count($orders_count);
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
        // print_r($orders);
        // die;
        $this->mViewData['orders'] = $orders;
        $this->mPageTitle = ' Cancel Order';
        $this->render('order/cancel_list');
    }

    public function completed_order($rowno = 0, $ajax = 'call', $serach = '')
    {
        //print_r($this->mUser);die;
        $udata = $this->custom_model->my_where('admin_users', '*', array('id' => $this->mUser->id), array(), "", "", "", "", "", array(), "", false);

        $user_id = $this->mUser->id;

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
            $orders = $this->custom_model->get_data_array("SELECT order_master_id,display_order_id,order_datetime,net_total,payment_mode,payment_status,order_status,currency,coupon_price,first_name,last_name  FROM order_master WHERE  `order_status`='Delivered'  Order BY order_master_id DESC limit $rowno,$rowperpage ");
            $orders_count = $this->custom_model->get_data_array("SELECT order_master_id,display_order_id,order_datetime,net_total,payment_mode,payment_status,order_status  FROM order_master WHERE  `order_status`='Delivered' ");

        } else {
            if (empty($serach)) {
                $orders = $this->custom_model->get_data_array("SELECT order_master_id,display_order_id,order_datetime,net_total,payment_mode,payment_status,order_status,currency,coupon_price,first_name,last_name  FROM order_master WHERE  `order_status`='Delivered'  Order BY order_master_id DESC limit $rowno,$rowperpage ");
                $orders_count = $this->custom_model->get_data_array("SELECT order_master_id,display_order_id,order_datetime,net_total,payment_mode,payment_status,order_status  FROM order_master WHERE  `order_status`='Delivered' ");
            } else {

                $orders = $this->custom_model->get_data_array("SELECT * FROM order_master WHERE (display_order_id LIKE '%$serach%' OR order_datetime LIKE '%$serach%' OR net_total LIKE '%$serach%' OR payment_status LIKE '%$serach%' OR payment_mode LIKE '%$serach%' OR order_status LIKE '%$serach%') AND `order_status`='Delivered'  ORDER BY `order_master_id` DESC LIMIT $rowno,$rowperpage ");
                $orders_count = $this->custom_model->get_data_array("SELECT * FROM order_master WHERE (display_order_id LIKE '%$serach%' OR order_datetime LIKE '%$serach%' OR net_total LIKE '%$serach%' OR payment_status LIKE '%$serach%' OR payment_mode LIKE '%$serach%' OR order_status LIKE '%$serach%') AND `order_status`='Delivered' ORDER BY `order_master_id` ");
            }
        }

        $orders = $this->name_price($orders);

        $config['base_url'] = base_url() . 'admin/orders/completed_order';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = count($orders_count);
        $config['per_page'] = $rowperpage;
        $config['page_query_string'] = FALSE;
        $config['enable_query_strings'] = FALSE;
        $config['reuse_query_string'] = FALSE;
        $config['cur_page'] = $page_no;

        // Initialize
        $this->pagination->initialize($config);
        // Initialize $data Array
        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $orders;
        $data['row'] = $rowno;
        $data['total_rows'] = count($orders_count);
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
        // print_r($orders);
        // die;
        $this->mViewData['orders'] = $orders;
        $this->mPageTitle = " Completed Order";
        $this->render('order/complete_order');
    }

    public function pending_order($rowno = 0, $ajax = 'call', $serach = '')
    {
        //print_r($this->mUser);die;
        $udata = $this->custom_model->my_where('admin_users', '*', array('id' => $this->mUser->id), array(), "", "", "", "", "", array(), "", false);

        $user_id = $this->mUser->id;

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
            $orders = $this->custom_model->get_data_array("SELECT order_master_id,display_order_id,order_datetime,net_total,payment_mode,payment_status,order_status,currency,coupon_price,first_name,last_name  FROM order_master WHERE  `order_status`='Pending'  Order BY order_master_id DESC limit $rowno,$rowperpage ");
            // $orders = $this->custom_model->get_data_array("SELECT order_master_id,display_order_id,order_datetime,net_total,payment_mode,payment_status,order_status  FROM order_master WHERE  `order_status` =  'delivered'  Order BY order_master_id DESC limit $rowno,$rowperpage ");
            $orders_count = $this->custom_model->get_data_array("SELECT order_master_id,display_order_id,order_datetime,net_total,payment_mode,payment_status,order_status  FROM order_master WHERE  `order_status`='Pending'  ");

        } else {
            if (empty($serach)) {
                $orders = $this->custom_model->get_data_array("SELECT order_master_id,display_order_id,order_datetime,net_total,payment_mode,payment_status,order_status,currency,coupon_price,first_name,last_name  FROM order_master WHERE  `order_status`='Pending'  Order BY order_master_id DESC limit $rowno,$rowperpage ");
                $orders_count = $this->custom_model->get_data_array("SELECT order_master_id,display_order_id,order_datetime,net_total,payment_mode,payment_status,order_status  FROM order_master WHERE  `order_status`='Pending'  ");
            } else {

                $orders = $this->custom_model->get_data_array("SELECT * FROM order_master WHERE (display_order_id LIKE '%$serach%' OR order_datetime LIKE '%$serach%' OR net_total LIKE '%$serach%' OR payment_status LIKE '%$serach%' OR payment_mode LIKE '%$serach%' OR order_status LIKE '%$serach%') AND `order_status`='Pending'  ORDER BY `order_master_id` DESC LIMIT $rowno,$rowperpage ");
                $orders_count = $this->custom_model->get_data_array("SELECT * FROM order_master WHERE (display_order_id LIKE '%$serach%' OR order_datetime LIKE '%$serach%' OR net_total LIKE '%$serach%' OR payment_status LIKE '%$serach%' OR payment_mode LIKE '%$serach%' OR order_status LIKE '%$serach%') AND `order_status`='Pending'  ORDER BY `order_master_id` ");
            }
        }

        $orders = $this->name_price($orders);

        $config['base_url'] = base_url() . 'admin/orders/pending_order';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = count($orders_count);
        $config['per_page'] = $rowperpage;
        $config['page_query_string'] = FALSE;
        $config['enable_query_strings'] = FALSE;
        $config['reuse_query_string'] = FALSE;
        $config['cur_page'] = $page_no;

        // Initialize
        $this->pagination->initialize($config);
        // Initialize $data Array
        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $orders;
        $data['row'] = $rowno;
        $data['total_rows'] = count($orders_count);
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
        // print_r($orders);
        // die;
        $this->mViewData['orders'] = $orders;
        $this->mPageTitle = " Pending Order";
        $this->render('order/pending_order');
    }

    public function all_order($rowno = 0, $ajax = 'call', $serach = '')
    {
        //print_r($this->mUser);die;
        $udata = $this->custom_model->my_where('admin_users', '*', array('id' => $this->mUser->id), array(), "", "", "", "", "", array(), "", false);

        $user_id = $this->mUser->id;

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
            $orders = $this->custom_model->get_data_array("SELECT order_master_id,display_order_id,order_datetime,net_total,payment_mode,payment_status,order_status,currency,coupon_price,first_name,last_name  FROM order_master  Order BY order_master_id DESC limit $rowno,$rowperpage ");
            // $orders = $this->custom_model->get_data_array("SELECT order_master_id,display_order_id,order_datetime,net_total,payment_mode,payment_status,order_status  FROM order_master WHERE  `order_status` =  'delivered'  Order BY order_master_id DESC limit $rowno,$rowperpage ");
            $orders_count = $this->custom_model->get_data_array("SELECT order_master_id,display_order_id,order_datetime,net_total,payment_mode,payment_status,order_status  FROM order_master ");

        } else {
            if (empty($serach)) {
                $orders = $this->custom_model->get_data_array("SELECT order_master_id,display_order_id,order_datetime,net_total,payment_mode,payment_status,order_status,currency,coupon_price,first_name,last_name  FROM order_master  Order BY order_master_id DESC limit $rowno,$rowperpage ");
                $orders_count = $this->custom_model->get_data_array("SELECT order_master_id,display_order_id,order_datetime,net_total,payment_mode,payment_status,order_status  FROM order_master ");
            } else {

                $orders = $this->custom_model->get_data_array("SELECT * FROM order_master WHERE display_order_id LIKE '%$serach%' OR order_datetime LIKE '%$serach%' OR net_total LIKE '%$serach%' OR payment_status LIKE '%$serach%' OR payment_mode LIKE '%$serach%' OR order_status LIKE '%$serach%'  ORDER BY `order_master_id` DESC LIMIT $rowno,$rowperpage ");
                $orders_count = $this->custom_model->get_data_array("SELECT * FROM order_master WHERE display_order_id LIKE '%$serach%' OR order_datetime LIKE '%$serach%' OR net_total LIKE '%$serach%' OR payment_status LIKE '%$serach%' OR payment_mode LIKE '%$serach%' OR order_status LIKE '%$serach%'  ORDER BY `order_master_id` ");
            }
        }

        $orders = $this->name_price($orders);

        $config['base_url'] = base_url() . 'admin/orders/all_order';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = count($orders_count);
        $config['per_page'] = $rowperpage;
        $config['page_query_string'] = FALSE;
        $config['enable_query_strings'] = FALSE;
        $config['reuse_query_string'] = FALSE;
        $config['cur_page'] = $page_no;

        // Initialize
        $this->pagination->initialize($config);
        // Initialize $data Array
        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $orders;
        $data['row'] = $rowno;
        $data['total_rows'] = count($orders_count);
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
        // print_r($orders);
        // die;
        $this->mViewData['orders'] = $orders;
        $this->mPageTitle = 'All Order Invoice';
        $this->render('order/all_order');
    }

    public function paid_order($rowno = 0, $ajax = 'call', $serach = '')
    {
        //print_r($this->mUser);die;
        $udata = $this->custom_model->my_where('admin_users', '*', array('id' => $this->mUser->id), array(), "", "", "", "", "", array(), "", false);

        $user_id = $this->mUser->id;

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
            $orders = $this->custom_model->get_data_array("SELECT order_master_id,display_order_id,order_datetime,net_total,payment_mode,payment_status,order_status,currency,coupon_price,first_name,last_name  FROM order_master WHERE  `payment_status`='Paid' AND is_show='1'  Order BY order_master_id DESC limit $rowno,$rowperpage ");
            // $orders = $this->custom_model->get_data_array("SELECT order_master_id,display_order_id,order_datetime,net_total,payment_mode,payment_status,order_status  FROM order_master WHERE  `order_status` =  'delivered'  Order BY order_master_id DESC limit $rowno,$rowperpage ");
            $orders_count = $this->custom_model->get_data_array("SELECT order_master_id,display_order_id,order_datetime,net_total,payment_mode,payment_status,order_status  FROM order_master WHERE  `payment_status`='Paid' AND is_show='1'  Order BY order_master_id DESC  ");

        } else {
            if (empty($serach)) {
                $orders = $this->custom_model->get_data_array("SELECT order_master_id,display_order_id,order_datetime,net_total,payment_mode,payment_status,order_status,currency,coupon_price,first_name,last_name  FROM order_master WHERE  `payment_status`='Paid'  Order BY order_master_id DESC limit $rowno,$rowperpage ");
                $orders_count = $this->custom_model->get_data_array("SELECT order_master_id,display_order_id,order_datetime,net_total,payment_mode,payment_status,order_status  FROM order_master WHERE  `payment_status`='Paid' AND is_show='1'  Order BY order_master_id DESC  ");
            } else {

                $orders = $this->custom_model->get_data_array("SELECT * FROM order_master WHERE (display_order_id LIKE '%$serach%' OR order_datetime LIKE '%$serach%' OR net_total LIKE '%$serach%' OR payment_status LIKE '%$serach%' OR payment_mode LIKE '%$serach%' OR order_status LIKE '%$serach%') AND `payment_status`='Paid'  ORDER BY `order_master_id` DESC LIMIT $rowno,$rowperpage ");
                $orders_count = $this->custom_model->get_data_array("SELECT * FROM order_master WHERE (display_order_id LIKE '%$serach%' OR order_datetime LIKE '%$serach%' OR net_total LIKE '%$serach%' OR payment_status LIKE '%$serach%' OR payment_mode LIKE '%$serach%' OR order_status LIKE '%$serach%') AND `payment_status`='Paid'  AND is_show='1'  Order BY order_master_id DESC ");
            }
        }

        $orders = $this->name_price($orders);

        $config['base_url'] = base_url() . 'admin/orders/paid_order';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = count($orders_count);
        $config['per_page'] = $rowperpage;
        $config['page_query_string'] = FALSE;
        $config['enable_query_strings'] = FALSE;
        $config['reuse_query_string'] = FALSE;
        $config['cur_page'] = $page_no;

        // Initialize
        $this->pagination->initialize($config);
        // Initialize $data Array
        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $orders;
        $data['row'] = $rowno;
        $data['total_rows'] = count($orders_count);
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
        // print_r($orders);
        // die;
        $this->mViewData['orders'] = $orders;
        $this->mPageTitle = " Paid Order";
        $this->render('order/paid_order');
    }

    public function unpaid_order($rowno = 0, $ajax = 'call', $serach = '')
    {
        //print_r($this->mUser);die;
        $udata = $this->custom_model->my_where('admin_users', '*', array('id' => $this->mUser->id), array(), "", "", "", "", "", array(), "", false);

        $user_id = $this->mUser->id;

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
            $orders = $this->custom_model->get_data_array("SELECT order_master_id,display_order_id,order_datetime,net_total,payment_mode,payment_status,order_status,currency,coupon_price,first_name,last_name  FROM order_master WHERE  `payment_status`='Unpaid' AND is_show='1'  Order BY order_master_id DESC limit $rowno,$rowperpage ");
            // $orders = $this->custom_model->get_data_array("SELECT order_master_id,display_order_id,order_datetime,net_total,payment_mode,payment_status,order_status  FROM order_master WHERE  `order_status` =  'delivered'  Order BY order_master_id DESC limit $rowno,$rowperpage ");
            $orders_count = $this->custom_model->get_data_array("SELECT order_master_id,display_order_id,order_datetime,net_total,payment_mode,payment_status,order_status  FROM order_master WHERE  `payment_status`='Unpaid' AND is_show='1'  Order BY order_master_id DESC  ");

        } else {
            if (empty($serach)) {
                $orders = $this->custom_model->get_data_array("SELECT order_master_id,display_order_id,order_datetime,net_total,payment_mode,payment_status,order_status,currency,coupon_price,first_name,last_name  FROM order_master WHERE  `payment_status`='Unpaid' AND is_show='1'  Order BY order_master_id DESC limit $rowno,$rowperpage ");

                $orders_count = $this->custom_model->get_data_array("SELECT order_master_id,display_order_id,order_datetime,net_total,payment_mode,payment_status,order_status  FROM order_master WHERE  `payment_status`='Unpaid' AND is_show='1'  Order BY order_master_id DESC  ");
            } else {

                $orders = $this->custom_model->get_data_array("SELECT * FROM order_master WHERE (display_order_id LIKE '%$serach%' OR order_datetime LIKE '%$serach%' OR net_total LIKE '%$serach%' OR payment_status LIKE '%$serach%' OR payment_mode LIKE '%$serach%' OR order_status LIKE '%$serach%') AND `payment_status`='Unpaid' AND is_show='1' ORDER BY `order_master_id` DESC LIMIT $rowno,$rowperpage ");

                $orders_count = $this->custom_model->get_data_array("SELECT * FROM order_master WHERE (display_order_id LIKE '%$serach%' OR order_datetime LIKE '%$serach%' OR net_total LIKE '%$serach%' OR payment_status LIKE '%$serach%' OR payment_mode LIKE '%$serach%' OR order_status LIKE '%$serach%') AND `payment_status`='Unpaid' AND is_show='1'  ORDER BY `order_master_id` DESC ");
            }
        }

        $orders = $this->name_price($orders);

        $config['base_url'] = base_url() . 'admin/orders/unpaid_order';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = count($orders_count);
        $config['per_page'] = $rowperpage;
        $config['page_query_string'] = FALSE;
        $config['enable_query_strings'] = FALSE;
        $config['reuse_query_string'] = FALSE;
        $config['cur_page'] = $page_no;

        // Initialize
        $this->pagination->initialize($config);
        // Initialize $data Array
        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $orders;
        $data['row'] = $rowno;
        $data['total_rows'] = count($orders_count);
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
        // print_r($orders);
        // die;
        $this->mViewData['orders'] = $orders;
        $this->mPageTitle = " Unpaid Order";
        $this->render('order/unpaid_order');
    }

    public function new_api_order($rowno = 0, $ajax = 'call', $serach = '')
    {
        // today api order list
        $now = date('Y-m-d', strtotime('today'));
        // $now = date('Y-m-d' ,strtotime('-1 days'));
        $udata = $this->custom_model->my_where('admin_users', '*', array('id' => $this->mUser->id), array(), "", "", "", "", "", array(), "", false);

        $user_id = $this->mUser->id;

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
            $orders = $this->custom_model->get_data_array("SELECT order_master_id,display_order_id,order_datetime,net_total,payment_mode,payment_status,order_status,currency,coupon_price,first_name,last_name FROM order_master WHERE  is_show='1' AND order_datetime LIKE '%$now%'Order BY order_master_id DESC limit $rowno,$rowperpage ");

            $orders_count = $this->custom_model->get_data_array("SELECT order_master_id,display_order_id,order_datetime,net_total,payment_mode,payment_status,order_status,currency,coupon_price,first_name,last_name FROM order_master WHERE is_show='1' AND order_datetime LIKE '%$now%'  ");


        } else {
            if (empty($serach)) {
                $orders = $this->custom_model->get_data_array("SELECT order_master_id,display_order_id,order_datetime,net_total,payment_mode,payment_status,order_status,currency,coupon_price,first_name,last_name FROM order_master WHERE is_show='1' AND order_datetime LIKE '%$now%'  Order BY order_master_id DESC limit $rowno,$rowperpage ");

                $orders_count = $this->custom_model->get_data_array("SELECT order_master_id,display_order_id,order_datetime,net_total,payment_mode,payment_status,order_status,currency,coupon_price,first_name,last_name FROM order_master WHERE is_show='1' AND order_datetime LIKE '%$now%' ");
            } else {

                $orders = $this->custom_model->get_data_array("SELECT * FROM order_master WHERE (display_order_id LIKE '%$serach%' OR order_datetime LIKE '%$serach%' OR net_total LIKE '%$serach%' OR payment_status LIKE '%$serach%' OR payment_mode LIKE '%$serach%' OR order_status LIKE '%$serach%') AND is_show='1'  AND order_datetime LIKE '%$now%'  ORDER BY `order_master_id` DESC LIMIT $rowno,$rowperpage ");
                $orders_count = $this->custom_model->get_data_array("SELECT * FROM order_master WHERE (display_order_id LIKE '%$serach%' OR order_datetime LIKE '%$serach%' OR net_total LIKE '%$serach%' OR payment_status LIKE '%$serach%' OR payment_mode LIKE '%$serach%' OR order_status LIKE '%$serach%') AND is_show='1' AND order_datetime LIKE '%$now%' ORDER BY `order_master_id` ");
            }
        }

        $orders = $this->name_price($orders);
        $config['base_url'] = base_url() . 'admin/orders/completed_order';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = count($orders_count);
        $config['per_page'] = $rowperpage;
        $config['page_query_string'] = FALSE;
        $config['enable_query_strings'] = FALSE;
        $config['reuse_query_string'] = FALSE;
        $config['cur_page'] = $page_no;

        // Initialize
        $this->pagination->initialize($config);
        // Initialize $data Array
        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $orders;
        $data['row'] = $rowno;
        $data['total_rows'] = count($orders_count);
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
        // print_r($orders);
        // die;
        $this->mViewData['orders'] = $orders;
        $this->mPageTitle = " New Order";
        $this->render('order/new_api_order');
    }

    public function csv_dwonload($order_status = '')
    {
        if (empty($order_status)) {
            $data = $this->custom_model->my_where("order_master", "*", array('is_show' => '1'), array(), "order_master_id", "DESC");
        } else {
            if ($order_status == "Paid") {
                $data = $this->custom_model->my_where("order_master", "*", array('payment_status' => $order_status, 'is_show' => '1'), array(), "order_master_id", "DESC");
            } else if ($order_status == "Unpaid") {
                $data = $this->custom_model->my_where("order_master", "*", array('payment_status' => $order_status, 'is_show' => '1'), array(), "order_master_id", "DESC");
            } else if ($order_status == "api_today") {
                $now = date('Y-m-d', strtotime('today'));
                // $now = date('Y-m-d' ,strtotime('-1 days'));
                $data = $this->custom_model->get_data_array("SELECT * FROM order_master WHERE order_datetime LIKE '%$now%' AND 'is_show'='1'  ");
            } else {
                $data = $this->custom_model->my_where("order_master", "*", array('order_status' => $order_status, 'is_show' => '1'), array(), "order_master_id", "DESC");
            }
        }

        $data = $this->name_price($data, $br = '');
        // echo "<pre>";
        // print_r($data);
        // die;

        if (empty($order_status)) {
            $file_name = 'all_' . date("d-m-Y") . '.csv';
        } else {
            $file_name = $order_status . '_' . date("d-m-Y") . '.csv';
        }

        if (!empty($data)) {
            header('Content-Type:text/csv');
            header("Content-Disposition: attachment; filename=\"$file_name\";");
            // header("Content-Disposition: attachment; filename=" );


            $str = 'Order Id,Display Order Id,Date,Customer Name,Supplier Name,Phone,Email,Address,Payment Mode,Payment Status,Sub Total,Vat,Delivery Charges,Coupon Price,Total';

            $fp = fopen('php://output', 'wb');


            $i = 0;
            $header = explode(",", $str);
            fputcsv($fp, $header);

            foreach ($data as $key => $value) {
                $address = @$value['address_1'] . ' , ' . $value['address_2'] . ' , ' . $value['country'] . ' , ' . $value['state'] . ' , ' . $value['city'] . ' , ' . $value['pincode'];
                $full_name = $value['first_name'] . ' , ' . $value['last_name'];
                $date = date('M-d-Y', strtotime($value['order_datetime']));
                $DATACSV[] = $value['order_master_id'];
                $DATACSV[] = $value['display_order_id'];
                $DATACSV[] = $date;
                $DATACSV[] = $full_name;
                $DATACSV[] = $value['price_name'];
                $DATACSV[] = $value['mobile_no'];
                $DATACSV[] = $value['email'];
                $DATACSV[] = $address;
                // $DATACSV[] = $value['order_status'];
                $DATACSV[] = $value['payment_mode'];
                $DATACSV[] = $value['payment_status'];
                $DATACSV[] = $value['sub_total'];
                $DATACSV[] = $value['tax'];
                $DATACSV[] = $value['shipping_charge'];
                $DATACSV[] = $value['coupon_price'];
                $DATACSV[] = $value['net_total'] - $value['coupon_price'];
                fputcsv($fp, $DATACSV);
                $DATACSV = array();
            }
        } else {
            $lang['ALERT'] = " No data found";
            echo "<script>alert('" . $lang['ALERT'] . "')</script>";
        }
        die;
    }

    public function bank_excel()
    {
        $post_data = $this->input->post();
        $language = $this->uri->segment(1);

        if (!empty($post_data)) {
            if (!empty($post_data['start_date']) && !empty($post_data['end_date'])) {
                $start_date = date("Y-m-d", strtotime($post_data['start_date']));
                $end_date = date("Y-m-d", strtotime($post_data['end_date']));
                $bank_data = $this->custom_model->get_data_array("SELECT oitem.sub_total,oitem.trans_ref,oitem.created_date,user.first_name,user.iban,user.username,bankd.bank_name as real_bank_name  FROM order_items as oitem INNER JOIN admin_users as user ON oitem.seller_id=user.id INNER JOIN bank_details as bankd ON bankd.id=user.bank_name WHERE oitem.created_date BETWEEN '$start_date' AND '$end_date' ");
                // AND user.id!='1'
                // echo "<pre>";
                // print_r($bank_data);
                // die;
                $now = date("d-m-Y");
                $file_name = $now . '-bank_excel.csv';

                if (!empty($bank_data)) {
                    header('Content-Type:text/csv');
                    header("Content-Disposition: attachment; filename=\"$file_name\";");
                    // header("Content-Disposition: attachment; filename=" );


                    $str = 'Bank Name,Account Number,Benificiary Name,Amount,Civilian Id,Beneficiaries Remarks,Payment Purpose,Beneficiaries Reference';

                    $fp = fopen('php://output', 'wb');


                    $i = 0;
                    $header = explode(",", $str);
                    fputcsv($fp, $header);

                    foreach ($bank_data as $key => $value) {
                        // $date=date('M-d-Y' ,strtotime($value['order_datetime']));
                        $DATACSV[] = $value['real_bank_name'];
                        $DATACSV[] = $value['iban'];
                        $DATACSV[] = $value['first_name'];
                        $DATACSV[] = $value['sub_total'];
                        $DATACSV[] = $value['username'];
                        $DATACSV[] = 'Port10Payout-' . $now;
                        $DATACSV[] = 'Purchasing Goods';
                        $DATACSV[] = $value['trans_ref'];
                        fputcsv($fp, $DATACSV);
                        $DATACSV = array();
                    }
                } else {
                    // $lang['ALERT'] =" No data found";
                    // echo "<script>alert('" . $lang['ALERT'] . "')</script>";
                    $this->session->set_flashdata('error', 'Data Not Found');
                    redirect($language . '/admin/orders/bank_excel');
                }
                die;

            } else {
                $this->session->set_flashdata('error', 'Please Enter Start && End Date');
                redirect($language . '/admin/orders/bank_excel');
            }
        } else {
            $form = $this->form_builder->create_form($language . '/admin/orders/bank_excel', '', 'id="wizard_with_validation" class="wizard clearfix"');
            $this->mPageTitle = 'Add Product';
            $this->mViewData['form'] = $form;
            $this->render('bank_excel/create');
        }
    }

    public function admin_fees()
    {
        $post_data = $this->input->post();
        $language = $this->uri->segment(1);
        if (!empty($post_data)) {

            if (!empty($post_data['start_date']) && !empty($post_data['end_date']) && !empty($post_data['seller_id'])) {
                $start_date = date("Y-m-d", strtotime($post_data['start_date']));
                $end_date = date("Y-m-d", strtotime($post_data['end_date']));
                // $bank_data = $this->custom_model->get_data_array("SELECT oitem.sub_total,oitem.trans_ref,oitem.created_date,user.first_name,user.iban,user.username,bankd.bank_name as real_bank_name  FROM order_items as oitem INNER JOIN admin_users as user ON oitem.seller_id=user.id INNER JOIN bank_details as bankd ON bankd.id=user.bank_name WHERE oitem.created_date BETWEEN '$start_date' AND '$end_date' ");

                $commission_data = $this->custom_model->get_data_array(" SELECT display_order_id,commission FROM order_invoice WHERE created_date BETWEEN '$start_date' AND '$end_date' AND seller_id='" . $post_data['seller_id'] . "' ");
                if (!empty($commission_data)) {
                    $buyer_address = $this->custom_model->my_where('admin_users', 'id,street_name,building_no,city,state,postal_code,country,first_name,vat_number', array('id' => $post_data['seller_id']));

                    $seller_address = $this->custom_model->my_where('admin_users', 'id,street_name,building_no,city,state,postal_code,country,first_name,vat_number', array('id' => '1'));

                    $data['buyer_address'] = $buyer_address;
                    $data['seller_address'] = $seller_address;
                    $data['commission_data'] = $commission_data;
                    $html = $this->load->view('admin_invoice/admin_fees', $data, true);
                    // echo $html;
                    // die;

                    require_once(BASE_PATH . 'application/libraries/vendor/autoload.php');

                    $mpdf = new Mpdf([
                        'mode' => 'utf-8',
                        'format' => 'A4',
                        // 'orientation' => 'L'
                    ]);
                    $mpdf->WriteHTML($html);
                    $mpdf->Output(date('M') . 'receipt.pdf', Destination::INLINE);
                    // // $mpdf->Output(date('M').'receipt.pdf','d');

                } else {
                    $this->session->set_flashdata('error', 'Data Not Found');
                    redirect($language . '/admin/orders/admin_fees');
                }
                die;

            } else {
                $this->session->set_flashdata('error', 'Please Enter Start && End Date');
                redirect($language . '/admin/orders/admin_fees');
            }
        }
        $supplier_data = $this->custom_model->get_data_array("SELECT id,first_name FROM admin_users WHERE type!='buyer' AND id!='1' ORDER BY id ASC ");
        // echo "<pre>";
        // print_r($supplier_data);
        // die;

        $form = $this->form_builder->create_form($language . '/admin/orders/admin_fees', '', 'id="wizard_with_validation" class="wizard clearfix"');
        $this->mPageTitle = 'Add Product';
        $this->mViewData['form'] = $form;
        $this->mViewData['supplier_data'] = $supplier_data;
        $this->render('admin_fees/create');
    }

    public function view($order_id)
    {
        if (isset($_POST['submit']) && (!empty($_POST['submit']))) {
            $this->load->library("email_send");
            // echo "<pre>";
            // print_r($_POST);
            // die;
            $row9 = $this->custom_model->my_where('order_master', '*', array('order_master_id' => $order_id));
            $updatedata = array(
                "order_status" => $_POST['order_status'],
                "delivery_date" => $_POST['delivery_date'],
                "payment_status" => $_POST['payment_status'],
                "order_comment" => $_POST['order_comment'],
            );
            $order_status = $_POST['order_status'];
            $response = $this->custom_model->my_update($updatedata, array('order_master_id' => $order_id), 'order_master');
            $this->custom_model->my_update(array('order_status' => $order_status), array('order_no' => $order_id, 'id_size' => 0), 'order_items');
            if ($_POST['order_status'] == 'Dispatched') {
                // Email to user
                // $this->load->library("email_send");
                // $this->email_send->order_dispatched($row9[0]['display_order_id']);

                // FCM Notification msg to user
                // $this->load->library("fcmnotification");
                // $this->fcmnotification->order_dispatched_msg_to_user($row9[0]['customer_id']);
            }
            if ($_POST['order_status'] == 'Delivered') {
                // $this->load->library("email_send");
                // $this->email_send->order_delivered($row9[0]['display_order_id']);

                // FCM Notification msg to user
                // $this->load->library("fcmnotification");
                // $this->fcmnotification->order_delivered_msg_to_user($row9[0]['customer_id'],$row9[0]['display_order_id']);

            }

            if ($_POST['order_status'] == 'canceled') {
                // FCM Notification msg to user
                // $this->load->library("fcmnotification");
                // $this->fcmnotification->order_canceled_msg_to_user($row9[0]['customer_id'],$row9[0]['display_order_id']);

            }

            if ($response) {
                $msg = array("msg" => "Data updated successfully...", "response" => "alert-success");
                if ($_POST['submit'] == 'Update') {
                    $email_id = $mobile_no = $address = $country = $state = $city = $pin_code = $sub_total = $tax = $net_total = $order_status = $payment_status = $payment_mode = $customer_comment = $a_id = "";

                }
                $this->mViewData['msg'] = $msg;
            }
        }
        $data = $this->custom_model->my_where('order_master', '*', array('order_master_id' => $order_id));

        $user_detail = $this->custom_model->my_where('admin_users', 'username,first_name,last_name,phone', array('id' => $data[0]['user_id']));

        $data_items = $this->custom_model->my_where('order_items', '*', array('order_no' => $order_id));
        if (!empty($data_items)) {
            foreach ($data_items as $d_key => $d_value) {
                $items_extra_data = $this->custom_model->my_where('items_extra_data', '*', array('item_id' => $d_value['item_id']));
                $data_items[$d_key]['product_cust_data'] = $items_extra_data;

                $product = $this->custom_model->my_where('product', '*', array('id' => $d_value['product_id']));
                $data_items[$d_key]['pro_image'] = $product[0]['product_image'];
            }
        }

        if (!empty($data)) {
            $trans_history = $this->custom_model->my_where("payment_details", "*", array("display_order_id" => $data[0]['display_order_id']));
        }
        //print_r($order_id);die();

        // echo "df<pre>";
        // print_r($user_detail);
        // echo "<pre>";
        // print_r($data);
        // echo "<pre>";
        // print_r($data_items);
        // print_r($trans_history);
        // die;

        $this->mPageTitle = ' Order Details';
        $this->mViewData['data'] = $data[0];
        $payment_status_arr = array();
        $payment_status_arr[0] = "Paid";
        $payment_status_arr[1] = "Unpaid";
        // $this->mViewData['data_insur'] = @$data_insur;
        // $this->mViewData['data_pre'] = @$data_pre;
        $this->mViewData['data_items'] = $data_items;
        $this->mViewData['user_detail'] = $user_detail;
        $this->mViewData['trans_history'] = $trans_history;
        $this->mViewData['payment_status_arr'] = $payment_status_arr;
        // $this->mViewData['signatures'] = $signatures;
        $this->render('order/details');
    }
}
