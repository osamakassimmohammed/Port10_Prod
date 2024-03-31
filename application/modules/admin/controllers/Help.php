<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Help extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_builder');
        $this->load->model('custom_model');
        $this->load->model('category_model');
        $language = $this->uri->segment(1);
        $this->is_admin($language);
    }

    // Frontend Category CRUD
    public function index($rowno = 0, $ajax = 'call', $serach = '')
    {
        // $imge_path='assets/admin/tutorial/';

        $this->load->library('pagination');

        $post_data = $this->input->post();

        if (!empty($post_data)) {
            $rowno = $post_data['pagno'];
            $ajax = $post_data['ajax'];
            $serach = $post_data['serach'];
        }
        // Row per page
        $rowperpage = 15;
        $page_no = 0;

        // Row position
        if ($rowno != 0) {
            $page_no = $rowno;
            $rowno = ($rowno - 1) * $rowperpage;
        }
        if ($ajax == 'call') {
            $faq_data = $this->custom_model->get_data_array("SELECT *  FROM faq  ORDER BY id ASC limit $rowno,$rowperpage ");

            $faq_count = $this->custom_model->get_data_array("SELECT COUNT(id) as faq_count  FROM faq   ORDER BY id ASC ");

        } else {
            if (empty($serach)) {
                $faq_data = $this->custom_model->get_data_array("SELECT *  FROM faq   ORDER BY id ASC limit $rowno,$rowperpage ");

                $faq_count = $this->custom_model->get_data_array("SELECT COUNT(id) as faq_count  FROM faq   ORDER BY id ASC ");

            } else {
                $faq_data = $this->custom_model->get_data_array("SELECT * FROM faq WHERE question LIKE '%$serach%' OR answer LIKE '%$serach%'  ORDER BY id ASC limit $rowno,$rowperpage ");

                $faq_count = $this->custom_model->get_data_array("SELECT  COUNT(id) as faq_count FROM faq WHERE question LIKE '%$serach%' OR answer LIKE '%$serach%' ORDER BY id ASC ");
            }
        }


        // echo "<pre>";
        // print_r($contact_request);
        // die;
        $config['base_url'] = base_url() . 'admin/blog/index';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $faq_count[0]['faq_count'];
        $config['per_page'] = $rowperpage;
        $config['page_query_string'] = FALSE;
        $config['enable_query_strings'] = FALSE;
        $config['reuse_query_string'] = FALSE;
        $config['cur_page'] = $page_no;

        // Initialize
        $this->pagination->initialize($config);
        // Initialize $data Array
        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $faq_data;
        $data['row'] = $rowno;
        $data['total_rows'] = $faq_count[0]['faq_count'];
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
        // print_r($faq_data);
        // die;
        $this->mPageTitle = 'Faq List';
        $this->mViewData['faq_data'] = $faq_data;
        $this->render('help/faq/list');

    }


    public function create()
    {
        $form = $this->form_builder->create_form();
        $post_data = $this->input->post();
        if (!empty($post_data)) {
            // echo "<pre>";
            // print_r($post_data);
            // die;

            if (empty($post_data['question']) && empty($post_data['answer'])) {
                $this->system_message->set_error('All filed required');
            } else {
                $response = $this->custom_model->my_insert($post_data, 'faq');
                $response = $this->custom_model->my_insert($post_data, 'faq_trans');

                if ($response) {
                    // success
                    $this->system_message->set_success('Faq created successfully');
                } else {
                    // failed
                    $this->system_message->set_error('Something went wrong');
                }
            }


        }
        $this->mPageTitle = 'Create FAQ';
        $this->mViewData['form'] = $form;
        $this->render('help/faq/create');
    }

    public function edit($cate_id)
    {
        $form = $this->form_builder->create_form();
        $post_data = $this->input->post();

        if (!empty($post_data)) {
            // $cate_data = $this->custom_model->my_where('faq','*',array('id' => $cate_id));

            // proceed to create Category
            $response = $this->custom_model->my_update($post_data, array('id' => $cate_id), 'faq');

            if ($response) {
                // success
                $this->system_message->set_success('Faq Edited successfully');
            } else {
                // failed
                $this->system_message->set_error('Something went wrong');
            }

            refresh();
        }

        $cate_data = $this->custom_model->my_where('faq', '*', array('id' => $cate_id));
        $this->mViewData['edit'] = $cate_data[0];
        $this->mPageTitle = 'Edit Faq';
        $this->mViewData['form'] = $form;
        $this->render('help/faq/create');
    }


    public function tedit($cate_id)
    {
        $form = $this->form_builder->create_form();
        $post_data = $this->input->post();

        if (!empty($post_data)) {
            $cate_data = $this->custom_model->my_where('faq_trans', '*', array('id' => $cate_id));

            // proceed to create Category
            $response = $this->custom_model->my_update($post_data, array('id' => $cate_id), 'faq_trans');

            if ($response) {
                // success
                $this->system_message->set_success('Faq Edited successfully');
            } else {
                // failed
                $this->system_message->set_error('Something went wrong');
            }

            refresh();
        }

        $cate_data = $this->custom_model->my_where('faq_trans', '*', array('id' => $cate_id));
        $this->mViewData['edit'] = $cate_data[0];
        $this->mPageTitle = 'Edit Faq';
        $this->mViewData['form'] = $form;
        $this->render('help/faq/create');
    }


    public function tutorial($rowno = 0, $ajax = 'call', $serach = '')
    {
        // $imge_path='assets/admin/tutorial/';

        $this->load->library('pagination');

        $post_data = $this->input->post();

        if (!empty($post_data)) {
            $rowno = $post_data['pagno'];
            $ajax = $post_data['ajax'];
            $serach = $post_data['serach'];
        }
        // Row per page
        $rowperpage = 15;
        $page_no = 0;

        // Row position
        if ($rowno != 0) {
            $page_no = $rowno;
            $rowno = ($rowno - 1) * $rowperpage;
        }
        if ($ajax == 'call') {
            $tutorial_data = $this->custom_model->get_data_array("SELECT *  FROM tutorial   ORDER BY id ASC limit $rowno,$rowperpage ");

            $tutorial_count = $this->custom_model->get_data_array("SELECT COUNT(id) as tutorial_count  FROM tutorial   ORDER BY id ASC ");

        } else {
            if (empty($serach)) {
                $tutorial_data = $this->custom_model->get_data_array("SELECT *  FROM tutorial   ORDER BY id ASC limit $rowno,$rowperpage ");

                $tutorial_count = $this->custom_model->get_data_array("SELECT COUNT(id) as tutorial_count  FROM tutorial   ORDER BY id ASC ");

            } else {
                $tutorial_data = $this->custom_model->get_data_array("SELECT * FROM tutorial WHERE heading LIKE '%$serach%' ORDER BY id ASC limit $rowno,$rowperpage ");

                $tutorial_count = $this->custom_model->get_data_array("SELECT  COUNT(id) as tutorial_count FROM tutorial WHERE heading LIKE '%$serach%' ORDER BY id ASC ");
            }
        }


        if (!empty($tutorial_data)) {
            // $description=strip_tags($bd_val['description']);
            // $description = explode(" ", $description);
            // $description = implode(" ", array_splice($description, 0, 4));
            // $blog_data[$bd_key]['description']=$description;
            foreach ($tutorial_data as $td_key => $td_val) {
                $tutorial_data[$td_key]['created_date'] = date('d-m-Y', strtotime($td_val['created_date']));
            }
        }


        // echo "<pre>";
        // print_r($contact_request);
        // die;
        $config['base_url'] = base_url() . 'admin/blog/index';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $tutorial_count[0]['tutorial_count'];
        $config['per_page'] = $rowperpage;
        $config['page_query_string'] = FALSE;
        $config['enable_query_strings'] = FALSE;
        $config['reuse_query_string'] = FALSE;
        $config['cur_page'] = $page_no;

        // Initialize
        $this->pagination->initialize($config);
        // Initialize $data Array
        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $tutorial_data;
        $data['row'] = $rowno;
        $data['total_rows'] = $tutorial_count[0]['tutorial_count'];
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
        // print_r($tutorial_data);
        // die;
        $this->mPageTitle = 'Tutorial List';
        $this->mViewData['tutorial_data'] = $tutorial_data;
        $this->render('help/tutorial/list');

    }


    public function tutorial_create()
    {
        $form = $this->form_builder->create_form($url = '', $multipart = true);
        $post_data = $this->input->post();
        if (!empty($post_data)) {
            // echo "<pre>";
            // print_r($post_data);
            // print_r($_FILES);
            // die;

            // if (empty($_FILES['video']['name']))
            // {
            // 	$this->system_message->set_error('Please upload Video');
            // }else if($_FILES['video']['type']!='video/mp4')
            // {
            // 	$this->system_message->set_error('Please upload Video');
            // }
            if (empty($post_data['heading']) && empty($post_data['description'])) {
                $this->system_message->set_error('Please enter heading or description');
            } else {
                if (isset($_FILES) and $_FILES['video']['name'] != '') {
                    @$FILES = $_FILES["video"];
                    $folder_name = 'admin/banner/';
                    @$image_name = $this->uploads($FILES, $folder_name);
                    $post_data['video'] = $image_name;
                }
                $post_data['created_date'] = date("Y-m-d h:i:s");
                $response = $this->custom_model->my_insert($post_data, 'tutorial');
                $response = $this->custom_model->my_insert($post_data, 'tutorial_trans');

                if ($response) {
                    // success
                    $this->system_message->set_success('Tutorial created successfully');
                } else {
                    // failed
                    $this->system_message->set_error('Something went wrong');
                }
            }


        }
        $this->mPageTitle = 'Create Tutorial';
        $this->mViewData['form'] = $form;
        $this->render('help/tutorial/create');
    }

    public function tutorial_edit($cate_id)
    {
        $form = $this->form_builder->create_form($url = '', $multipart = true);
        $post_data = $this->input->post();

        if (!empty($post_data)) {
            // $cate_data = $this->custom_model->my_where('faq','*',array('id' => $cate_id));
            // echo "<pre>";
            // print_r($post_data);
            // print_r($_FILES);
            // die;
            // proceed to create Category
            if (isset($_FILES) and $_FILES['video']['name'] != '') {
                @$FILES = $_FILES["video"];
                $folder_name = 'admin/banner/';
                @$image_name = $this->uploads($FILES, $folder_name);
                $post_data['video'] = $image_name;
            }
            $response = $this->custom_model->my_update($post_data, array('id' => $cate_id), 'tutorial');
            $update_data = array();
            $update_data['status'] = $post_data['status'];
            $this->custom_model->my_update($update_data, array('id' => $cate_id), 'tutorial_trans');

            if ($response) {
                // success
                $this->system_message->set_success('Tutorial Edited successfully');
            } else {
                // failed
                $this->system_message->set_error('Something went wrong');
            }

            refresh();
        }

        $cate_data = $this->custom_model->my_where('tutorial', '*', array('id' => $cate_id));
        $this->mViewData['edit'] = $cate_data[0];
        $this->mPageTitle = 'Edit Tutorial';
        $this->mViewData['form'] = $form;
        $this->render('help/tutorial/create');
    }


    public function tutorial_tedit($cate_id)
    {
        $form = $this->form_builder->create_form($url = '', $multipart = true);
        $post_data = $this->input->post();

        if (!empty($post_data)) {
            // $cate_data = $this->custom_model->my_where('tutorial','*',array('id' => $cate_id));

            // proceed to create Category
            $response = $this->custom_model->my_update($post_data, array('id' => $cate_id), 'tutorial_trans');
            $update_data = array();
            $update_data['status'] = $post_data['status'];
            $this->custom_model->my_update($update_data, array('id' => $cate_id), 'tutorial');
            if ($response) {
                // success
                $this->system_message->set_success('Tutorial Edited successfully');
            } else {
                // failed
                $this->system_message->set_error('Something went wrong');
            }

            refresh();
        }

        $cate_data = $this->custom_model->my_where('tutorial_trans', '*', array('id' => $cate_id));
        $this->mViewData['edit'] = $cate_data[0];
        $this->mPageTitle = 'Edit Tutorial';
        $this->mViewData['form'] = $form;
        $this->render('help/tutorial/create');
    }

    public function detete_tutorial()
    {
        $post_data = $this->input->post();
        if (!empty($post_data)) {
            $pid = $post_data['pid'];
            $this->custom_model->my_delete(['id' => $pid], 'tutorial');
            $this->custom_model->my_delete(['id' => $pid], 'tutorial_trans');
            echo 1;
            die;
        } else {
            echo 0;
            die;
        }
    }

    public function delete_faq()
    {
        $post_data = $this->input->post();
        if (!empty($post_data)) {
            $pid = $post_data['pid'];
            $this->custom_model->my_delete(['id' => $pid], 'faq');
            $this->custom_model->my_delete(['id' => $pid], 'faq_trans');
            echo 1;
            die;
        } else {
            echo 0;
            die;
        }
    }


}
