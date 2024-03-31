<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Brand extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_builder');
        $this->load->model('custom_model');
        $this->get_access_id();
    }

    public function index($rowno = 0, $ajax = 'call', $serach = '')
    {
        $language = $this->uri->segment(1);
        if ($language == 'en') {
            $err_msg1 = 'Brand List';
        } else {
            $err_msg1 = 'قائمة العلامات التجارية';
        }

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
            if ($this->mUser->type == "suppler" || $this->mUser->type == "subsupplier") {
                $brand_data = $this->custom_model->get_data_array("SELECT * FROM brand WHERE seller_id=" . $this->nmUser_id . " ORDER BY id ASC limit $rowno,$rowperpage ");

                $brand_count = $this->custom_model->get_data_array("SELECT COUNT(id) as brand_count FROM brand WHERE seller_id=" . $this->nmUser_id . " ORDER BY id ASC  ");
            } else {

                $brand_data = $this->custom_model->get_data_array("SELECT brand.*, seller.first_name FROM brand INNER JOIN admin_users as seller ON brand.seller_id=seller.id  ORDER BY brand.id ASC limit $rowno,$rowperpage ");

                $brand_count = $this->custom_model->get_data_array("SELECT COUNT(brand.id) as brand_count FROM brand INNER JOIN admin_users as seller ON brand.seller_id=seller.id ORDER BY brand.id ASC ");
            }
        } else {
            if (empty($serach)) {
                if ($this->mUser->type == "suppler" || $this->mUser->type == "subsupplier") {
                    $brand_data = $this->custom_model->get_data_array("SELECT * FROM brand WHERE seller_id=" . $this->nmUser_id . " ORDER BY id ASC limit $rowno,$rowperpage ");

                    $brand_count = $this->custom_model->get_data_array("SELECT COUNT(id) as brand_count FROM brand WHERE seller_id=" . $this->nmUser_id . " ORDER BY id ASC  ");
                } else {

                    $brand_data = $this->custom_model->get_data_array("SELECT brand.*, seller.first_name FROM brand INNER JOIN admin_users as seller ON brand.seller_id=seller.id  ORDER BY brand.id ASC limit $rowno,$rowperpage ");

                    $brand_count = $this->custom_model->get_data_array("SELECT COUNT(brand.id) as brand_count FROM brand INNER JOIN admin_users as seller ON brand.seller_id=seller.id ORDER BY brand.id ASC ");
                }

            } else {

                if ($this->mUser->type == "suppler" || $this->mUser->type == "subsupplier") {
                    $brand_data = $this->custom_model->get_data_array("SELECT * FROM brand WHERE (brand_name LIKE '%$serach%' OR id LIKE '%$serach%') AND seller_id=" . $this->nmUser_id . " ORDER BY id ASC limit $rowno,$rowperpage ");

                    $brand_count = $this->custom_model->get_data_array("SELECT COUNT(id) as brand_count FROM brand WHERE (brand_name LIKE '%$serach%' OR id LIKE '%$serach%') AND seller_id=" . $this->nmUser_id . " ORDER BY id ASC  ");
                } else {

                    $brand_data = $this->custom_model->get_data_array("SELECT brand.*, seller.first_name FROM brand INNER JOIN admin_users as seller ON brand.seller_id=seller.id WHERE brand.brand_name LIKE '%$serach%' OR brand.id LIKE '%$serach%' ORDER BY brand.id ASC limit $rowno,$rowperpage ");

                    $brand_count = $this->custom_model->get_data_array("SELECT COUNT(brand.id) as brand_count FROM brand INNER JOIN admin_users as seller ON brand.seller_id=seller.id WHERE brand.brand_name LIKE '%$serach%' OR brand.id LIKE '%$serach%' ORDER BY brand.id ASC   ");
                }
            }
        }


        // if(!empty($blog_data))
        // {
        // 	foreach ($blog_data as $bd_key => $bd_val)
        // 	{
        // 		$blog_data[$bd_key]['created_date']=date('M-d-Y' ,strtotime($bd_val['created_date']));
        // 	}
        // }


        // echo "<pre>";
        // print_r($contact_request);
        // die;
        $config['base_url'] = base_url() . 'admin/brand/index';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $brand_count[0]['brand_count'];
        $config['per_page'] = $rowperpage;
        $config['page_query_string'] = FALSE;
        $config['enable_query_strings'] = FALSE;
        $config['reuse_query_string'] = FALSE;
        $config['cur_page'] = $page_no;

        // Initialize
        $this->pagination->initialize($config);
        // Initialize $data Array
        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $brand_data;
        $data['row'] = $rowno;
        $data['total_rows'] = $brand_count[0]['brand_count'];
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
        // print_r($brand_data);
        // die;
        $this->mPageTitle = $err_msg1;
        $this->mViewData['brand_data'] = $brand_data;
        $this->mViewData['seller_id'] = $this->nmUser_id;
        $this->render('brand/list');

    }


    public function create()
    {
        $language = $this->uri->segment(1);
        if ($language == 'en') {
            $err_msg1 = 'Brand created successfully';
            $err_msg2 = 'Something went wrong';
            $err_msg3 = 'Please enter new brand name this brand name already exists';
            $err_msg4 = 'Please enter brand name';
        } else {
            $err_msg1 = 'تم إنشاء العلامة التجارية بنجاح';
            $err_msg2 = 'هناك خطأ ما';
            $err_msg3 = 'الرجاء إدخال اسم علامة تجارية جديدة. هذا الاسم مسجل مسبقاً.';
            $err_msg4 = 'الرجاء إدخال اسم العلامة التجارية';
        }
        $form = $this->form_builder->create_form();
        $post_data = $this->input->post();
        if (!empty($post_data)) {
            // strtolower()
            $post_data['brand_name'] = trim($post_data['brand_name']);
            if (!empty($post_data['brand_name'])) {
                $is_brand = $this->custom_model->my_where('brand', '*', array('brand_name' => $post_data['brand_name'], 'seller_id' => $this->nmUser_id));
                if (empty($is_brand)) {
                    $post_data['seller_id'] = $this->nmUser_id;
                    // if (empty($post_data['image']))
                    // {
                    // 	$this->system_message->set_error('Please upload image');
                    // }
                    // else
                    // {
                    $response = $this->custom_model->my_insert($post_data, 'brand');
                    $response = $this->custom_model->my_insert($post_data, 'brand_trans');

                    if ($response) {
                        // success
                        $this->system_message->set_success($err_msg1);
                    } else {
                        // failed
                        $this->system_message->set_error($err_msg2);
                    }
                    // }
                } else {
                    $this->system_message->set_error($err_msg3);
                }

            } else {
                $this->system_message->set_error($err_msg4);
            }
        }
        $this->mPageTitle = 'Create Brand';
        $this->mViewData['form'] = $form;
        $this->render('brand/create');
    }

    public function edit($cate_id)
    {
        $language = $this->uri->segment(1);
        if ($language == 'en') {
            $err_msg1 = 'Brand edited successfully';
            $err_msg2 = 'Something went wrong';
            $err_msg3 = 'Please enter new brand name this brand name already exists';
            $err_msg4 = 'Please enter brand name';
        } else {
            $err_msg1 = 'تم إنشاء العلامة التجارية بنجاح';
            $err_msg2 = 'هناك خطأ ما';
            $err_msg3 = 'الرجاء إدخال اسم علامة تجارية جديدة. هذا الاسم مسجل مسبقاً.';
            $err_msg4 = 'تم تعديل العلامة التجارية بنجاح';
        }
        $form = $this->form_builder->create_form();
        $post_data = $this->input->post();

        if (!empty($post_data)) {
            //strtolower()
            $post_data['brand_name'] = trim($post_data['brand_name']);
            if (!empty($post_data['brand_name'])) {

                $is_brand = $this->custom_model->my_where('brand', '*', array('id!=' => $cate_id, 'brand_name' => $post_data['brand_name'], 'seller_id' => $this->nmUser_id));
                if (empty($is_brand)) {
                    // proceed to create Category
                    $response = $this->custom_model->my_update($post_data, array('id' => $cate_id), 'brand');

                    if ($response) {
                        // success
                        $this->system_message->set_success($err_msg1);
                    } else {
                        // failed
                        $this->system_message->set_error($err_msg2);
                    }
                } else {
                    $this->system_message->set_error($err_msg3);
                }
            } else {
                $this->system_message->set_error($err_msg4);
            }

            refresh();
        }

        $cate_data = $this->custom_model->my_where('brand', '*', array('id' => $cate_id));
        // echo "<pre>";
        // print_r($cate_data);
        // die;
        $this->mViewData['edit'] = $cate_data[0];
        $this->mPageTitle = 'Edit Brand';
        $this->mViewData['form'] = $form;
        $this->render('brand/create');
    }


    public function tedit($cate_id)
    {
        $language = $this->uri->segment(1);
        if ($language == 'en') {
            $err_msg1 = 'Brand edited successfully';
            $err_msg2 = 'Something went wrong';
            $err_msg3 = 'Please enter new brand name this brand name already exists';
            $err_msg4 = 'Please enter brand name';
        } else {
            $err_msg1 = 'تم إنشاء العلامة التجارية بنجاح';
            $err_msg2 = 'هناك خطأ ما';
            $err_msg3 = 'الرجاء إدخال اسم علامة تجارية جديدة. هذا الاسم مسجل مسبقاً.';
            $err_msg4 = 'تم تعديل العلامة التجارية بنجاح';
        }
        $form = $this->form_builder->create_form();
        $post_data = $this->input->post();

        if (!empty($post_data)) {
            // strtolower()
            $post_data['brand_name'] = trim($post_data['brand_name']);
            if (!empty($post_data['brand_name'])) {

                $is_brand = $this->custom_model->my_where('brand_trans', '*', array('id!=' => $cate_id, 'brand_name' => $post_data['brand_name'], 'seller_id' => $this->nmUser_id));
                if (empty($is_brand)) {
                    // proceed to create Category
                    $response = $this->custom_model->my_update($post_data, array('id' => $cate_id), 'brand_trans');

                    if ($response) {
                        // success
                        $this->system_message->set_success($err_msg1);
                    } else {
                        // failed
                        $this->system_message->set_error($err_msg2);
                    }
                } else {
                    $this->system_message->set_error($err_msg3);
                }
            } else {
                $this->system_message->set_error($err_msg4);
            }

            refresh();
        }

        $cate_data = $this->custom_model->my_where('brand_trans', '*', array('id' => $cate_id));
        $this->mViewData['edit'] = $cate_data[0];
        $this->mPageTitle = 'TEdit Brand';
        $this->mViewData['form'] = $form;
        $this->render('brand/create');
    }

    public function detete_brand()
    {
        $post_data = $this->input->post();
        if (!empty($post_data)) {
            $pid = $post_data['pid'];
            $this->custom_model->my_delete(['id' => $pid], 'brand');
            $this->custom_model->my_delete(['id' => $pid], 'brand_trans');
            echo 1;
            die;
        } else {
            echo 0;
            die;
        }
    }


}

?>
