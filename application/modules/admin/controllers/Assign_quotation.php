<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Assign_quotation extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_builder');
        $this->load->model('custom_model');
        $this->load->model('category_model');
        if ($this->session->userdata('group_id') != 1) {
            redirect('admin');
        }
    }

    public function index($sqid = '', $noti_id = '')
    {
        if (!empty($this->mUser->id) && $this->mUser->id = 1) {
            $seller_id = $this->mUser->id;
            $sub_query = " WHERE seller_id='$seller_id'";
        } else {
            redirect();
        }

        if (!empty($sqid) && !empty($noti_id)) {
            $sub_query .= " AND id='$sqid' ";
            $this->custom_model->my_update(array('is_seen' => 1), array('id' => $noti_id, 'is_seen' => '0'), 'inv_mesg_notification');
        }
        $quotation_data = $this->custom_model->get_data_array("SELECT * FROM send_quotation  WHERE seller_id='0' Order BY id DESC  ");

        $quotation_data = $this->get_quotaion_data($quotation_data);
        // echo "<pre>";
        // print_r($quotation_data);
        // die;
        $this->mPageTitle = 'Receive quotation listing ';
        $this->mViewData['quotation_data'] = $quotation_data;
        $this->render('assign_quotation/list');
    }

    public function get_quotaion_data($quotation_data)
    {
        if (!empty($quotation_data)) {
            foreach ($quotation_data as $qd_key => $qd_val) {
                $category_data = $this->custom_model->my_where('category', "id,display_name", array('id' => $qd_val['category_id']));

                $quotation_data[$qd_key]['category_name'] = $category_data[0]['display_name'];

                $unit_data = $this->custom_model->my_where('unit_list', "id,unit_name", array('id' => $qd_val['unit']));

                $quotation_data[$qd_key]['unit_name'] = $unit_data[0]['unit_name'];
            }
        }
        return $quotation_data;
    }

    public function quotation_detail($id = '')
    {
        if (!empty($this->mUser->id) && $this->mUser->id = 1) {
            $seller_id = $this->mUser->id;
            $sub_query = " WHERE seller_id='$seller_id'";
        } else {
            redirect();
        }

        $quotation_data = $this->custom_model->get_data_array("SELECT * FROM send_quotation WHERE seller_id='0' AND id='$id' ");

        $quotation_data = $this->get_quotaion_data($quotation_data);

        $seller_list = $this->custom_model->get_data_array("SELECT id,first_name FROM admin_users WHERE type='suppler' or id='1' ");

        $is_invoice = $this->custom_model->get_data_array("SELECT seller_id FROM quotation_invoice WHERE quotaion_id='$id' ");
        if (!empty($is_invoice)) {
            $is_invoice = array_column($is_invoice, 'seller_id');
        }
        // echo "<pre>";
        // print_r($is_invoice);
        // die;
        $this->mPageTitle = 'Receive Quotation Detail';
        $this->mViewData['quotation_data'] = $quotation_data;
        $this->mViewData['seller_list'] = $seller_list;
        $this->mViewData['is_invoice'] = $is_invoice;
        $this->render('assign_quotation/quotation_detail');
    }

    public function assign_vender()
    {
        $post_data = $this->input->post();
        if (!empty($post_data)) {
            if (isset($post_data['assign_vender']) && !empty($post_data['assign_vender']) && isset($post_data['req_id'])) {
                $req_id = $post_data['req_id'];
                $is_request = $this->custom_model->get_data_array("SELECT * FROM send_quotation WHERE seller_id='0' AND id='$req_id' ");
                if (!empty($is_request)) {
                    if ($is_request[0]['quotation_status'] == 'Cancelled') {
                        echo json_encode(array('status' => false, "message" => "Request cancelled by buyer so you ca't assign to seller"));
                        die;
                    }

                    foreach ($post_data['assign_vender'] as $key => $seller_id) {
                        $is_invoice = $this->custom_model->get_data_array("SELECT in_id FROM quotation_invoice WHERE seller_id='$seller_id' AND quotaion_id='$req_id' ");
                        if (empty($is_invoice)) {
                            $insert_data = array();
                            $insert_data['quotaion_id'] = $req_id;
                            $insert_data['in_user_name'] = $is_request[0]['user_name'];
                            $insert_data['uid'] = $is_request[0]['uid'];
                            $insert_data['in_address'] = $is_request[0]['address'];
                            $insert_data['in_qty'] = $is_request[0]['qty'];
                            $insert_data['in_unit'] = $is_request[0]['unit'];
                            $insert_data['in_sku'] = $is_request[0]['hscode'];
                            $insert_data['seller_id'] = $seller_id;
                            // $insert_data['created_date']=date("Y-m-d h:i:s");
                            // $insert_data['in_date']=date("Y-m-d");
                            $response = $this->custom_model->my_insert($insert_data, 'quotation_invoice');

                            $noti_data = array();
                            $noti_data['noti_type'] = 'invoice';
                            $noti_data['message'] = 'Admin assigned new request';
                            $noti_data['uid'] = $is_request[0]['uid'];
                            $noti_data['sid'] = $seller_id;
                            $noti_data['qut_msg_id'] = $req_id;
                            $noti_data['send_by'] = 'admin';
                            if ($seller_id == 1) {
                                $noti_data['send_to'] = 'admin';
                            } else {
                                $noti_data['send_to'] = 'seller';
                            }
                            $noti_data['created_date'] = date("Y-m-d h:i:s");
                            $this->custom_model->my_insert($noti_data, 'inv_mesg_notification');

                            if ($response) {
                                $arr = explode(' ', trim($is_request[0]['user_name']));
                                $first_name = $arr[0];
                                $in_iref_no = $first_name . $response;
                                $this->custom_model->my_update(array('in_iref_no' => $in_iref_no), array('quotaion_id' => $req_id, 'seller_id' => $seller_id), 'quotation_invoice');
                            }
                        }
                    }
                    echo json_encode(array("status" => true, "message" => "Request assign successfully"));
                    die;
                } else {
                    echo json_encode(array("status" => false, "message" => "Invalid request id"));
                    die;
                }
            } else {
                echo json_encode(array("status" => false, "message" => "Please pass dealer id"));
                die;
            }
        } else {
            echo json_encode(array("status" => false, "message" => "Something went wrong"));
            die;
        }
    }
}

?>
