<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Home page
 */
class Invoice extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('admin/Custom_model', 'custom_model');
    }

    public function pdf($order_id)
    {
        $this->load->library('pdf_create');
        $response = $this->pdf_create->get_print_pdf_list($order_id);
    }

    public function order_invoice($order_no, $order = '')
    {
        $this->get_access_id();
        $seller_id = $this->nmUser_id;
        $language = $this->uri->segment(1);

        if (empty($seller_id)) {
            $this->session->set_flashdata('login_message', 'Please Login Or Create Account!!');
            redirect($language);
        }

        $orders_invoice = $this->custom_model->get_data_array("SELECT invoice.invoice_id,invoice.order_no,invoice.item_ids,invoice.payment_status,invoice.payment_mode,invoice.created_date,invoice.order_status,invoice.seller_id,invoice.net_total as in_net_total,invoice.sub_total as in_sub_total,invoice.tax,invoice.commission,master.display_order_id,master.first_name,master.last_name,master.mobile_no,master.email,master.country,master.city,master.state,master.pincode,master.address_1,master.currency,master.order_datetime FROM order_invoice as invoice INNER JOIN order_master as master ON invoice.order_no = master.order_master_id  WHERE invoice.seller_id='$seller_id' AND invoice.order_no='$order_no' ");

        // $orders_invoice = $this->custom_model->get_data_array("SELECT items.*,master.currency,master.first_name,master.last_name,master.mobile_no,master.email,master.country,master.city,master.state,master.pincode,master.address_1 FROM orders_invoice as items INNER JOIN order_master as master ON items.order_no=master.order_master_id WHERE items.seller_id='$seller_id' AND items.item_id='$item_id' ");
        // echo "<pre>";
        // print_r($orders_invoice);
        // die;

        if (!empty($orders_invoice)) {
            foreach ($orders_invoice as $oi_key => $oi_val) {
                $order_items = $this->custom_model->my_where('order_items', 'item_id,product_name,quantity,price,unit,trans_ref', array('order_no' => $oi_val['order_no'], 'seller_id' => $oi_val['seller_id']));

                if (!empty($order_items)) {
                    foreach ($order_items as $item_key => $item_val) {
                        $unit_data = $this->custom_model->my_where('unit_list', 'id,unit_name', array('id' => $item_val['unit']));
                        if (!empty($unit_data)) {
                            $order_items[$item_key]['unit_name'] = $unit_data[0]['unit_name'];
                        } else {
                            $order_items[$item_key]['unit_name'] = '';
                        }
                    }
                }

                $orders_invoice[$oi_key]['order_items'] = $order_items;


                $seller_address = $this->custom_model->my_where('admin_users', 'id,street_name,building_no,city,state,postal_code,country,first_name', array('id' => $oi_val['seller_id']));

                if (!empty($seller_address)) {
                    $address = '';

                    if (!empty($seller_address[0]['street_name'])) {
                        $address .= $seller_address[0]['street_name'] . ' ';
                    }

                    if (!empty($seller_address[0]['building_no'])) {
                        $address .= $seller_address[0]['building_no'] . ' ';
                    }

                    if (!empty($seller_address[0]['city'])) {
                        $address .= $seller_address[0]['city'] . ' ';
                    }

                    if (!empty($seller_address[0]['state'])) {
                        $address .= $seller_address[0]['state'] . ' ';
                    }

                    if (!empty($seller_address[0]['country'])) {
                        $address .= $seller_address[0]['country'] . ' ';
                    }

                    if (!empty($seller_address[0]['pincode'])) {
                        $address .= $seller_address[0]['pincode'] . ' ';
                    }

                    $orders_invoice[$oi_key]['seller_address'] = $address;
                    $orders_invoice[$oi_key]['seller_name'] = $seller_address[0]['first_name'];
                } else {
                    $orders_invoice[$oi_key]['seller_address'] = '';
                    $orders_invoice[$oi_key]['seller_name'] = '';
                }
            }

            $this->load->library('pdf_create');

            // 	echo "<pre>";
            // print_r($orders_invoice);
            // die;
            // $response = $this->pdf_product->get_print_pdf_list($orders_invoice,$order,$item_id);
            $response = $this->pdf_create->get_print_pdf_new($orders_invoice, $order, $language);
        } else {
            $this->session->set_flashdata('common_message', 'Invalid Item Id.!!');
            redirect($language . '/admin/vorders');
        }
    }
}
