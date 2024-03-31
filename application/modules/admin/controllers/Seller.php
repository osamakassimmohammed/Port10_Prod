<?php

use Mpdf\Mpdf;
use Mpdf\Output\Destination;

defined('BASEPATH') or exit('No direct script access allowed');

class Seller extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_builder');
        $this->load->model('custom_model');
        $this->load->model('category_model');

        $this->get_access_id();
    }

    public function orders($uid)
    {
        $language = $this->uri->segment(1);
        $uidd = en_de_crypt($uid, 'd');
        $data = array();
        $data = $this->custom_model->get_data_array("SELECT order_master_id,currency,display_order_id,user_id FROM `order_master` WHERE `user_id` = '$uidd' AND is_show='1' ORDER BY order_master_id desc ");
        foreach ($data as $key => $value) {

            $items = $this->custom_model->my_where("order_items", "item_id,product_id,unit,quantity,trans_ref,price,sub_total,attribute", array("order_no" => $value['order_master_id']));

            foreach ($items as $k => $val) {
                $item_info = $this->custom_model->my_where("product", "product_name,product_image,seller_id,id", array("id" => $val['product_id']));

                $unit_data = $this->custom_model->my_where('unit_list', 'id,unit_name', array('id' => $val['unit']));
                if (!empty($unit_data)) {
                    $item_info[0]['unit_name'] = $unit_data[0]['unit_name'];
                } else {
                    $item_info[0]['unit_name'] = '';
                }
                @$data[$key]['items'][$k] = array_merge($val, $item_info[0]);

            }
            $trans_history = $this->custom_model->my_where("payment_details", "*", array("display_order_id" => $value['display_order_id']));
            if (!empty($trans_history)) {
                $data[$key]['transaction_id'] = $trans_history[0]['display_order_id'];
            }
        }

        // echo "<pre>";
        // print_r($data);
        // die;

        $this->mViewData['data'] = $data;
        $this->render('seller/seller_order_history');
    }

    public function pdf($item_id, $uid)
    {
        $language = $this->uri->segment(1);
        $uidd = en_de_crypt($uid, 'd');
        // $uid=$this->session->userdata('uid');
        if (empty($uidd)) {
            $this->session->set_flashdata('login_message', 'Please Login Or Create Account!!');
            redirect($language . '/admin');
        }
        $order_items = $this->custom_model->get_data_array("SELECT items.*,master.currency,master.first_name,master.last_name,master.mobile_no,master.email,master.country,master.city,master.state,master.pincode,master.address_1 FROM order_items as items INNER JOIN order_master as master ON items.order_no=master.order_master_id WHERE items.user_id='$uidd' AND items.item_id='$item_id' ");

        // echo "<pre>";
        // print_r($order_items);
        // die;
        $seller_address = $buyer_address = array();
        if (!empty($order_items)) {
            foreach ($order_items as $oi_key => $oi_val) {
                $unit_data = $this->custom_model->my_where('unit_list', 'id,unit_name', array('id' => $oi_val['unit']));
                if (!empty($unit_data)) {
                    $order_items[$oi_key]['unit_name'] = $unit_data[0]['unit_name'];
                } else {
                    $order_items[$oi_key]['unit_name'] = '';
                }
                $seller_address = $this->custom_model->my_where('admin_users', 'id,street_name,building_no,city,state,postal_code,country,first_name,vat_number', array('id' => $oi_val['seller_id']));

                $buyer_address = $this->custom_model->my_where('admin_users', 'id,street_name,building_no,city,state,postal_code,country,first_name,vat_number', array('id' => $uidd));

            }
            // echo "<pre>";
            // print_r($order_items);
            // print_r($seller_address);
            // print_r($buyer_address);
            // die;
            $data['order_items'] = $order_items;
            $data['seller_address'] = $seller_address;
            $data['buyer_address'] = $buyer_address;
            $html = $this->load->view('new_invoice', $data, true);

            $file_name = "invoice_.pdf";
            // $file_name = "invoice_1212.pdf";
            require_once(BASE_PATH . 'application/libraries/vendor/autoload.php');

            $mpdf = new Mpdf([
                'mode' => 'utf-8',
                'format' => 'A4',
                // 'orientation' => 'L'
            ]);
            $mpdf->WriteHTML($html);
            $mpdf->Output(date('M') . 'receipt.pdf', Destination::INLINE);
            // $mpdf->Output(date('M').'receipt.pdf','d');

        } else {
            $this->session->set_flashdata('common_message', 'Invalid Item Id.!!');
            redirect($language . '/admin');
        }

    }
}
