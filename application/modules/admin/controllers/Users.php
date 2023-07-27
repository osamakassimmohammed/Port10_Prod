<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends Admin_Controller
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

	public function index($rowno = 0, $ajax = 'call', $serach = '')
	{
		// $users_data = $this->custom_model->my_where('admin_users','*',array('id!=' =>'1'));		

		$this->load->library('pagination');

		$post_data = $this->input->post();

		if (!empty($post_data)) {
			$rowno = $post_data['pagno'];
			$ajax 	= $post_data['ajax'];
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
			$users_data = $this->custom_model->get_data_array("SELECT id,first_name,created_on,active,is_email_verify,last_name,phone,username,address,email  FROM admin_users WHERE  id!='1' AND type='buyer'  Order BY id ASC limit $rowno,$rowperpage ");
			$users_count = $this->custom_model->get_data_array("SELECT id,first_name,created_on,last_name,phone,username,address,email  FROM admin_users WHERE id!='1' AND type='buyer'  Order BY id ASC ");
		} else {
			if (empty($serach)) {
				$users_data = $this->custom_model->get_data_array("SELECT id,first_name,created_on,last_name,phone,username,address,email  FROM admin_users WHERE  id!='1' AND type='buyer'  Order BY id ASC limit $rowno,$rowperpage ");
				$users_count = $this->custom_model->get_data_array("SELECT id,first_name,created_on,last_name,phone,username,address,email  FROM admin_users WHERE id!='1' AND type='buyer'  Order BY id ASC ");
			} else {

				$users_data = $this->custom_model->get_data_array("SELECT id,first_name,created_on,last_name,phone,username,address,email FROM admin_users WHERE (first_name LIKE '%$serach%' OR `created_on` LIKE '%$serach%' OR last_name LIKE '%$serach%' OR phone LIKE '%$serach%' OR username LIKE '%$serach%' OR address LIKE '%$serach%' ) AND id!='1' AND type='buyer' ORDER BY `id` ASC LIMIT $rowno,$rowperpage ");

				$users_count = $this->custom_model->get_data_array("SELECT id,first_name,created_on,last_name,phone,username,address,email FROM admin_users WHERE (first_name LIKE '%$serach%'  OR created_on LIKE '%$serach%' OR last_name LIKE '%$serach%' OR phone LIKE '%$serach%' OR username LIKE '%$serach%' OR address LIKE '%$serach%') AND  id!='1' AND type='buyer'  ORDER BY `id` ASC ");
			}
		}
		if (!empty($users_data)) {
			foreach ($users_data as $ud_key => $ud_val) {
				$user_id = $ud_val['id'];
				$users_data[$ud_key]['created_on'] = date("Y/m/d", strtotime($ud_val['created_on']));
				$order_count = $this->custom_model->get_data_array("SELECT COUNT(order_master_id) as order_count FROM order_master WHERE user_id='$user_id' ");
				$users_data[$ud_key]['order_count'] = $order_count[0]['order_count'];
			}
		}

		$config['base_url'] = base_url() . 'admin/users/index';
		$config['use_page_numbers'] = TRUE;
		$config['total_rows'] = count($users_count);
		$config['per_page'] = $rowperpage;
		$config['page_query_string'] = FALSE;
		$config['enable_query_strings'] = FALSE;
		$config['reuse_query_string']  = FALSE;
		$config['cur_page'] = $page_no;

		// Initialize
		$this->pagination->initialize($config);
		// Initialize $data Array
		$data['pagination'] = $this->pagination->create_links();
		$data['result'] = $users_data;
		$data['row'] = $rowno;
		$data['total_rows'] = count($users_count);
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
		// $users_data = $this->custom_model->get_data_array("SELECT * FROM admin_users WHERE id!='1' ORDER BY id ASC ");	
		// echo "<pre>";
		// print_r($users_data);
		// die;	
		$this->mPageTitle = 'Customer list';
		$this->mViewData['users_data'] = $users_data;
		$this->render('users/list1');
	}

	public function supplier_list($subs_status = '')
	{
		$rowno = 0;
		$ajax = 'call';
		$serach = '';
		// $users_data = $this->custom_model->my_where('admin_users','*',array('id!=' =>'1'));		

		$this->load->library('pagination');

		$post_data = $this->input->post();

		if (!empty($post_data)) {
			$rowno = $post_data['pagno'];
			$ajax 	= $post_data['ajax'];
			$serach = $post_data['serach'];
			$subs_status = $post_data['subs_status'];
		}
		// Row per page
		$rowperpage = 25;
		$page_no = 0;

		if (empty($subs_status)) {
			$query = " id!='1' AND type='suppler' ";
		} else {
			$query = " id!='1' AND type='suppler' AND subs_status='$subs_status' ";
		}

		// Row position
		if ($rowno != 0) {
			$page_no = $rowno;
			$rowno = ($rowno - 1) * $rowperpage;
		}
		if ($ajax == 'call') {
			$users_data = $this->custom_model->get_data_array("SELECT id,first_name,created_on,last_name,active,is_email_verify,phone,username,address,email,subs_status  FROM admin_users WHERE $query   Order BY id ASC limit $rowno,$rowperpage ");
			$users_count = $this->custom_model->get_data_array("SELECT id FROM admin_users WHERE $query  Order BY id ASC ");
		} else {
			if (empty($serach)) {
				$users_data = $this->custom_model->get_data_array("SELECT id,first_name,created_on,last_name,phone,username,address,email,subs_status  FROM admin_users WHERE  $query  Order BY id ASC limit $rowno,$rowperpage ");
				$users_count = $this->custom_model->get_data_array("SELECT id  FROM admin_users WHERE $query  Order BY id ASC ");
			} else {

				$users_data = $this->custom_model->get_data_array("SELECT id,first_name,created_on,last_name,phone,username,address,email,subs_status FROM admin_users WHERE (first_name LIKE '%$serach%' OR `created_on` LIKE '%$serach%' OR last_name LIKE '%$serach%' OR phone LIKE '%$serach%' OR username LIKE '%$serach%' OR address LIKE '%$serach%' OR email LIKE '%$serach%' OR subs_status LIKE '%$serach%' ) AND $query ORDER BY `id` ASC LIMIT $rowno,$rowperpage ");

				$users_count = $this->custom_model->get_data_array("SELECT id FROM admin_users WHERE (first_name LIKE '%$serach%'  OR created_on LIKE '%$serach%' OR last_name LIKE '%$serach%' OR phone LIKE '%$serach%' OR username LIKE '%$serach%' OR address LIKE '%$serach%' OR email LIKE '%$serach%' OR subs_status LIKE '%$serach%') AND  $query  ORDER BY `id` ASC ");
			}
		}
		if (!empty($users_data)) {
			foreach ($users_data as $ud_key => $ud_val) {
				$user_id = $ud_val['id'];
				$users_data[$ud_key]['created_on'] = date("Y/m/d", strtotime($ud_val['created_on']));
				$order_count = $this->custom_model->get_data_array("SELECT COUNT(item_id) as item_sell FROM order_items WHERE seller_id='$user_id' ");
				$users_data[$ud_key]['order_count'] = $order_count[0]['item_sell'];
			}
		}

		$config['base_url'] = base_url() . 'admin/users/supplier_list';
		$config['use_page_numbers'] = TRUE;
		$config['total_rows'] = count($users_count);
		$config['per_page'] = $rowperpage;
		$config['page_query_string'] = FALSE;
		$config['enable_query_strings'] = FALSE;
		$config['reuse_query_string']  = FALSE;
		$config['cur_page'] = $page_no;

		// Initialize
		$this->pagination->initialize($config);
		// Initialize $data Array
		$data['pagination'] = $this->pagination->create_links();
		$data['result'] = $users_data;
		$data['row'] = $rowno;
		$data['total_rows'] = count($users_count);
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
		// $users_data = $this->custom_model->get_data_array("SELECT * FROM admin_users WHERE id!='1' ORDER BY id ASC ");	
		// echo "<pre>";
		// print_r($users_data);
		// die;	
		$this->mPageTitle = 'Supplier list';
		$this->mViewData['users_data'] = $users_data;
		$this->mViewData['subs_status'] = $subs_status;
		$this->render('users/supplier_list');
	}

	public function active_customers()
	{
		$rowno = 0;
		$ajax = 'call';
		$serach = '';
		// $users_data = $this->custom_model->my_where('admin_users','*',array('id!=' =>'1'));		

		$this->load->library('pagination');

		$post_data = $this->input->post();

		if (!empty($post_data)) {
			$rowno = $post_data['pagno'];
			$ajax 	= $post_data['ajax'];
			$serach = $post_data['serach'];
		}
		// Row per page
		$rowperpage = 25;
		$page_no = 0;

		$query = " id!='1' AND type='buyer' AND active='1' ";

		// Row position
		if ($rowno != 0) {
			$page_no = $rowno;
			$rowno = ($rowno - 1) * $rowperpage;
		}
		if ($ajax == 'call') {
			$users_data = $this->custom_model->get_data_array("SELECT id,first_name,created_on,last_name,phone,username,address,email FROM admin_users WHERE $query   Order BY id ASC limit $rowno,$rowperpage ");
			$users_count = $this->custom_model->get_data_array("SELECT id FROM admin_users WHERE $query  Order BY id ASC ");
		} else {
			if (empty($serach)) {
				$users_data = $this->custom_model->get_data_array("SELECT id,first_name,created_on,last_name,phone,username,address,email FROM admin_users WHERE  $query  Order BY id ASC limit $rowno,$rowperpage ");
				$users_count = $this->custom_model->get_data_array("SELECT id  FROM admin_users WHERE $query  Order BY id ASC ");
			} else {

				$users_data = $this->custom_model->get_data_array("SELECT id,first_name,created_on,last_name,phone,username,address,email FROM admin_users WHERE (first_name LIKE '%$serach%' OR `created_on` LIKE '%$serach%' OR last_name LIKE '%$serach%' OR phone LIKE '%$serach%' OR username LIKE '%$serach%' OR address LIKE '%$serach%' OR email LIKE '%$serach%' OR subs_status LIKE '%$serach%' ) AND $query ORDER BY `id` ASC LIMIT $rowno,$rowperpage ");

				$users_count = $this->custom_model->get_data_array("SELECT id FROM admin_users WHERE (first_name LIKE '%$serach%'  OR created_on LIKE '%$serach%' OR last_name LIKE '%$serach%' OR phone LIKE '%$serach%' OR username LIKE '%$serach%' OR address LIKE '%$serach%' OR email LIKE '%$serach%') AND  $query  ORDER BY `id` ASC ");
			}
		}
		if (!empty($users_data)) {
			foreach ($users_data as $ud_key => $ud_val) {
				$user_id = $ud_val['id'];
				$users_data[$ud_key]['created_on'] = date("Y/m/d", strtotime($ud_val['created_on']));
				$order_count = $this->custom_model->get_data_array("SELECT COUNT(order_master_id) as order_count FROM order_master WHERE user_id='$user_id' ");
				$users_data[$ud_key]['order_count'] = $order_count[0]['order_count'];
			}
		}

		$config['base_url'] = base_url() . 'admin/users/active_customers';
		$config['use_page_numbers'] = TRUE;
		$config['total_rows'] = count($users_count);
		$config['per_page'] = $rowperpage;
		$config['page_query_string'] = FALSE;
		$config['enable_query_strings'] = FALSE;
		$config['reuse_query_string']  = FALSE;
		$config['cur_page'] = $page_no;

		// Initialize
		$this->pagination->initialize($config);
		// Initialize $data Array
		$data['pagination'] = $this->pagination->create_links();
		$data['result'] = $users_data;
		$data['row'] = $rowno;
		$data['total_rows'] = count($users_count);
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
		// $users_data = $this->custom_model->get_data_array("SELECT * FROM admin_users WHERE id!='1' ORDER BY id ASC ");	
		// echo "<pre>";
		// print_r($users_data);
		// die;	
		$this->mPageTitle = 'Active Customers';
		$this->mViewData['users_data'] = $users_data;
		$this->render('users/active_customers');
	}
	public function supplier_detail($user_id, $flag = '')
	{

		$post_data = $this->input->post();
		if (!empty($post_data)) {
			// echo "<pre>";
			// print_r($post_data);
			// die;
			$responce = $this->custom_model->my_update($post_data, array('id' => $user_id), 'admin_users');
			echo 1;
			die;
		}
		$users_data = $this->custom_model->get_data_array("SELECT * FROM admin_users WHERE  id='$user_id' AND type='suppler' ");
		if (!empty($users_data)) {


			if ($users_data[0]['subs_status'] != 'expired') {
				$current_data = date('Y-m-d');
				$date1 = new DateTime($current_data);  //current date or any date
				$date2 = new DateTime($users_data[0]['subs_end_date']);   //Future date
				$diff = $date2->diff($date1)->format("%a");  //find difference
				$days = intval($diff);   //rounding days
				$users_data[0]['days_left'] = $days;
			} else {
				$users_data[0]['days_left'] = 0;
			}

			$order_count = $this->custom_model->get_data_array("SELECT COUNT(item_id) as item_sell FROM order_items WHERE seller_id='$user_id' ");

			$users_data[0]['order_count'] = $order_count[0]['item_sell'];

			$bank_details = $this->custom_model->get_data_array("SELECT bank_name FROM bank_details WHERE id='" . $users_data[0]['bank_name'] . "' ");
			if (!empty($bank_details)) {
				$users_data[0]['bank_name'] = $bank_details[0]['bank_name'];
			}
		}

		// echo "<pre>";
		// print_r($users_data);
		// die;
		$this->mPageTitle = 'Supplier Details';
		$this->mViewData['users_data'] = $users_data;
		$this->mViewData['flag'] = $flag;
		$this->render('users/supplier_detail');
	}

	public function user_detail($user_id, $flag = '')
	{

		$post_data = $this->input->post();
		if (!empty($post_data)) {
			// echo "<pre>";
			// print_r($post_data);
			// die;
			$responce = $this->custom_model->my_update($post_data, array('id' => $user_id), 'admin_users');
			echo 1;
			die;
		}
		$users_data = $this->custom_model->get_data_array("SELECT * FROM admin_users WHERE  id='$user_id' AND type='buyer' ");
		if (!empty($users_data)) {

			$order_count = $this->custom_model->get_data_array("SELECT COUNT(item_id) as item_sell FROM order_items WHERE seller_id='$user_id' ");

			$users_data[0]['order_count'] = $order_count[0]['item_sell'];

			$bank_details = $this->custom_model->get_data_array("SELECT bank_name FROM bank_details WHERE id='" . $users_data[0]['bank_name'] . "' ");
			if (!empty($bank_details)) {
				$users_data[0]['bank_name'] = $bank_details[0]['bank_name'];
			}
		}

		// echo "<pre>";
		// print_r($users_data);
		// die;
		$this->mPageTitle = 'Buyer Details';
		$this->mViewData['users_data'] = $users_data;
		$this->mViewData['flag'] = $flag;
		$this->render('users/user_detail');
	}

	public function order_history($cate_id)
	{
		$this->language = $this->uri->segments[1];
		$uid = $cate_id;
		$post_data = $this->input->post();

		/*echo "<pre>";
		print_r($post_data);
		die;*/

		$data = $this->custom_model->my_where("admin_users", "*", array("id" => $uid), array(), "", "", "", "", array(), "", array(), false);


		/*$tags = json_decode($data[0]['insurance_name']);
		if ($tags)
		{
			foreach ($tags as $key => $value)
			{
				$insurance_name = $this->custom_model->my_where("insurance_name","insurance_name",array("id" => $value),array(),"","","","", array(), "",array(),false  );
				// print_r($insurance_name);
				$ins[] = $insurance_name[0]['insurance_name'];
			}
			$this->mViewData['insurance'] = $ins;
		}*/




		$data_master = $this->custom_model->my_where("order_master", "*", array("user_id" => $uid), array(), "", "", "", "", array(), "", array(), false);
		if (!empty($data_master)) {
			foreach ($data_master as $kcey => $vcalue) {
				$oid = $vcalue['order_master_id'];
				$o_item = $this->custom_model->my_where("order_items", "product_name,quantity,price", array("order_no" => $oid), array(), "", "", "", "", array(), "", array(), false);

				$data_master[$kcey]['order_item'] = $o_item;
			}
		}
		$this->mPageTitle = 'View ' . $data[0]['first_name'] . ' Details';

		// echo "<pre>";
		// print_r($data); die;
		// print_r($data_master); die;

		$this->mViewData['data'] = $data[0];
		$this->mViewData['products'] = $data_master;
		$this->render('admin/users/order_history');
	}

	public function csv_dwonload()
	{
		$data = $this->custom_model->my_where("admin_users", "id,username,email,created_on,phone,first_name,last_name", array('id!=' => 1, 'type' => 'buyer'), array(), "id", "ASC");

		// echo "<pre>";
		// print_r($data);
		// die;


		$file_name = 'Customr_info' . date("d-m-Y") . '.csv';


		if (!empty($data)) {
			header('Content-Type:text/csv');
			header("Content-Disposition: attachment; filename=\"$file_name\";");
			// header("Content-Disposition: attachment; filename=" );


			$str = 'Id,Username,Mobile No,Email,Date';

			$fp = fopen('php://output', 'wb');


			$i = 0;
			$header = explode(",", $str);
			fputcsv($fp, $header);

			foreach ($data as $key => $value) {
				$username  =  @$value['first_name'] . ' , ' . $value['last_name'];
				$date = date('M-d-Y', strtotime($value['created_on']));
				$DATACSV[] = $value['id'];
				$DATACSV[] = $username;
				$DATACSV[] = $value['phone'];
				$DATACSV[] = $value['email'];
				$DATACSV[] = $date;

				fputcsv($fp, $DATACSV);
				$DATACSV = array();
			}
		} else {
			$lang['ALERT'] = " No data found";
			echo "<script>alert('" . $lang['ALERT'] . "')</script>";
		}
		die;
	}

	public function suppl_csv_dwonload()
	{
		$data = $this->custom_model->my_where("admin_users", "id,username,email,created_on,phone,first_name,last_name", array('id!=' => 1, 'type' => 'suppler'), array(), "id", "ASC");

		// echo "<pre>";
		// print_r($data);
		// die;


		$file_name = 'Supplier_info' . date("d-m-Y") . '.csv';


		if (!empty($data)) {
			header('Content-Type:text/csv');
			header("Content-Disposition: attachment; filename=\"$file_name\";");
			// header("Content-Disposition: attachment; filename=" );


			$str = 'Id,Username,Mobile No,Email,Date';

			$fp = fopen('php://output', 'wb');


			$i = 0;
			$header = explode(",", $str);
			fputcsv($fp, $header);

			foreach ($data as $key => $value) {
				$username  =  @$value['first_name'] . ' , ' . $value['last_name'];
				$date = date('M-d-Y', strtotime($value['created_on']));
				$DATACSV[] = $value['id'];
				$DATACSV[] = $username;
				$DATACSV[] = $value['phone'];
				$DATACSV[] = $value['email'];
				$DATACSV[] = $date;

				fputcsv($fp, $DATACSV);
				$DATACSV = array();
			}
		} else {
			$lang['ALERT'] = " No data found";
			echo "<script>alert('" . $lang['ALERT'] . "')</script>";
		}
		die;
	}

	public function active_cus_csv_dwonload()
	{
		$data = $this->custom_model->my_where("admin_users", "id,username,email,created_on,phone,first_name,last_name", array('id!=' => 1, 'type' => 'buyer', 'active' => 1), array(), "id", "ASC");

		// echo "<pre>";
		// print_r($data);
		// die;


		$file_name = 'Active_Customer_info' . date("d-m-Y") . '.csv';


		if (!empty($data)) {
			header('Content-Type:text/csv');
			header("Content-Disposition: attachment; filename=\"$file_name\";");
			// header("Content-Disposition: attachment; filename=" );


			$str = 'Id,Username,Mobile No,Email,Date';

			$fp = fopen('php://output', 'wb');


			$i = 0;
			$header = explode(",", $str);
			fputcsv($fp, $header);

			foreach ($data as $key => $value) {
				$username  =  @$value['first_name'] . ' , ' . $value['last_name'];
				$date = date('M-d-Y', strtotime($value['created_on']));
				$DATACSV[] = $value['id'];
				$DATACSV[] = $username;
				$DATACSV[] = $value['phone'];
				$DATACSV[] = $value['email'];
				$DATACSV[] = $date;

				fputcsv($fp, $DATACSV);
				$DATACSV = array();
			}
		} else {
			$lang['ALERT'] = " No data found";
			echo "<script>alert('" . $lang['ALERT'] . "')</script>";
		}
		die;
	}


	public function supplier_excel()
	{
		$post_data = $this->input->post();
		$language = $this->uri->segment(1);

		if (!empty($post_data)) {
			if (!empty($post_data['stype'])) {
				$query = "WHERE type='suppler' ";
				if ($post_data['stype'] == 'all') {
				} else if ($post_data['stype'] == 'wiban') {
					$query .= " AND is_iban='1' ";
				} else if ($post_data['stype'] == 'wout_iban') {
					$query .= " AND is_iban=0 ";
				}
				// $start_date= date("Y-m-d", strtotime($post_data['start_date']));
				// $end_date= date("Y-m-d", strtotime($post_data['end_date']));
				// oitem.created_date BETWEEN '$start_date' AND '$end_date'
				$is_users = $this->custom_model->get_data_array("SELECT id,first_name,email,phone FROM admin_users  $query ORDER BY id ASC ");
				// AND user.id!='1'
				// echo "<pre>";
				// print_r($is_users);
				// die;
				$now = date("d-m-Y");
				$file_name = $now . '-Remitter Upload.csv';

				if (!empty($is_users)) {
					header('Content-Type:text/csv');
					header("Content-Disposition: attachment; filename=\"$file_name\";");
					// header("Content-Disposition: attachment; filename=" );


					$str = 'Parent ID,START DATE,Language,Parent Name,Email,Mobile,Notification';

					$fp = fopen('php://output', 'wb');


					$i = 0;
					$header = explode(",", $str);
					// echo "<pre>";
					// print_r($header);
					// die;
					fputcsv($fp, $header);

					foreach ($is_users as $key => $value) {
						// $date=date('M-d-Y' ,strtotime($value['order_datetime']));
						$DATACSV[] = $value['id'];
						$DATACSV[] = $now;
						$DATACSV[] = 'English';
						$DATACSV[] = $value['first_name'];
						$DATACSV[] = $value['email'];
						$DATACSV[] = $value['phone'];
						$DATACSV[] = 'B';
						fputcsv($fp, $DATACSV);
						$DATACSV = array();
					}
				} else {
					// $lang['ALERT'] =" No data found";
					// echo "<script>alert('" . $lang['ALERT'] . "')</script>";
					$this->session->set_flashdata('error', 'Data Not Found');
					redirect($language . '/admin/users/supplier_excel');
				}
				die;
			} else {
				$this->session->set_flashdata('error', 'Please Enter Start && End Date');
				redirect('admin/users/supplier_excel');
			}
		} else {
			$form = $this->form_builder->create_form($language . '/admin/users/supplier_excel', '', 'id="wizard_with_validation" class="wizard clearfix"');
			$this->mPageTitle = 'Add Product';
			$this->mViewData['form'] = $form;
			$this->render('users/supplier_excel');
		}
	}

	public function csv_upload()
	{
		$query = array();
		$csvMimes = array('application/vnd.ms-excel', 'text/plain', 'text/csv', 'text/tsv');
		$language = $this->uri->segment(1);
		if (!empty($_FILES)) {
			// echo '<pre>';
			// print_r($_FILES);
			// die;
			if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)) {

				// if(is_uploaded_file($_FILES['file']['tmp_name']))
				// {
				//open uploaded csv file with read only mode
				$csvFile = fopen($_FILES['file']['tmp_name'], 'r');

				// skip first line
				// if your csv file have no heading, just comment the next line

				fgetcsv($csvFile);

				//parse data from csv file line by line
				while (($line = fgetcsv($csvFile)) !== FALSE) {
					// echo "<pre>";
					// print_r($line);
					// die;
					$user_id 				= $line[0];
					$national_id 			= $line[1];
					$scheme_id 				= $line[2];
					$remitter_id 			= $line[3];
					$remitter_account 		= $line[4];
					$language_code 			= $line[5];
					$remitter_name_en 		= $line[6];
					$remitter_name_ar 		= $line[7];
					$remitter_address1 		= $line[8];
					$remitter_address2 		= $line[9];
					$remitter_address3 		= $line[10];
					$remitter_address4 		= $line[11];
					$email 					= $line[12];
					$contact 				= $line[13];
					$start_date 			= $line[14];
					$status 				= $line[15];
					$mobile 				= $line[16];
					$invoice_notification_flag 	= $line[17];
					$iban_account_number 	= $line[18];
					$bban_account_number 	= $line[19];



					$additional_data = $response = array();

					if (!empty($user_id)) $additional_data['user_id'] = $user_id;
					if (!empty($national_id)) $additional_data['national_id'] = $national_id;
					if (!empty($scheme_id)) $additional_data['scheme_id'] = $scheme_id;
					if (!empty($remitter_id)) $additional_data['remitter_id'] = $remitter_id;
					if (!empty($remitter_account)) $additional_data['remitter_account'] = $remitter_account;
					if (!empty($language_code)) $additional_data['language_code'] = $language_code;
					if (!empty($remitter_name_en)) $additional_data['remitter_name_en'] = $remitter_name_en;
					if (!empty($remitter_name_ar)) $additional_data['remitter_name_ar'] = $remitter_name_ar;
					if (!empty($remitter_address1)) $additional_data['remitter_address1'] = $remitter_address1;
					if (!empty($remitter_address2)) $additional_data['remitter_address2'] = $remitter_address2;
					if (!empty($remitter_address3)) $additional_data['remitter_address3'] = $remitter_address3;
					if (!empty($remitter_address4)) $additional_data['remitter_address4'] = $remitter_address4;
					if (!empty($email)) $additional_data['email'] = $email;
					if (!empty($contact)) $additional_data['contact'] = $contact;
					if (!empty($start_date)) $additional_data['start_date'] = $start_date;
					if (!empty($status)) $additional_data['status'] = $status;
					if (!empty($mobile)) $additional_data['mobile'] = $mobile;
					if (!empty($invoice_notification_flag)) $additional_data['invoice_notification_flag'] = $invoice_notification_flag;
					if (!empty($iban_account_number)) $additional_data['iban_account_number'] = $iban_account_number;
					if (!empty($bban_account_number)) $additional_data['bban_account_number'] = $bban_account_number;



					$is_user = $this->custom_model->my_where('admin_users', 'id', array('id' => $user_id, 'type' => 'suppler'));

					if (!empty($is_user)) {

						$is_info = $this->custom_model->my_where('supplier_info', 'id', array('user_id' => $user_id));
						if (empty($is_info)) {

							$id = 	$this->custom_model->my_insert($additional_data, 'supplier_info');
						}
					}
				}

				// die;

				//close opened csv file
				fclose($csvFile);
				$this->session->set_flashdata('csv_insert', 'CSV uploded successfully');
				redirect($language . '/admin/users/supplier_excel');
			}
			//}
			else {
				$this->session->set_flashdata('error', 'Please upload valid csv file !');
			}
		}
		redirect($language . '/admin/users/supplier_excel');
	}

	public function text_download()
	{


		$now = date("d-m-Y");
		$file_name = $now . '-Remitter Upload.csv';


		header('Content-Type:text/csv');
		header("Content-Disposition: attachment; filename=\"$file_name\";");
		// header("Content-Disposition: attachment; filename=" );


		$str = 'Client Id,National Id,Scheme Id,Remitter Id,Remitter Account,Language Code,Remitter Name(Eng),Remitter Name(Arb),Remitter Address-1,Remitter Address-2,Remitter Address-3,Remitter Address-4,Email,Contact,Start Date,Status,Mobile,Invoice_notification_flag,Iban Account Number,Bban Account Number';

		$fp = fopen('php://output', 'wb');


		$i = 0;
		$header = explode(",", $str);
		// echo "<pre>";
		// print_r($header);
		// die;
		fputcsv($fp, $header);

		// foreach ($is_users as $key => $value)
		// {
		// $date=date('M-d-Y' ,strtotime($value['order_datetime']));
		$DATACSV[] = 2;
		$DATACSV[] = 123;
		$DATACSV[] = 'TJARAPORT10';
		$DATACSV[] = '23776';
		$DATACSV[] = 'Remitter Account';
		$DATACSV[] = 'language Code';
		$DATACSV[] = 'TJARA PORT 10';
		$DATACSV[] = 'TJARA PORT 10';
		$DATACSV[] = 'Remitter Address-1';
		$DATACSV[] = 'Remitter Address-2';
		$DATACSV[] = 'Remitter Address-3';
		$DATACSV[] = 'Remitter Address-4';
		$DATACSV[] = 'rajagopal.ashokkumar@gmail.com';
		$DATACSV[] = '8482901476';
		$DATACSV[] = '30-07-2021';
		$DATACSV[] = 'Active';
		$DATACSV[] = '966563915246';
		$DATACSV[] = 'No Notiifcation';
		$DATACSV[] = 'SA9480900023777991345071';
		$DATACSV[] = '000230990007771345071';

		fputcsv($fp, $DATACSV);
		$DATACSV = array();
		// }

		die;
	}

	//to active and inactive supplier and buyer @ap@
	public function delete_user($id){
		$language= $this->uri->segment(1);
		$user = $this->custom_model->my_where('admin_users','*',array('id=' =>$id))[0];

		$this->custom_model->my_delete(array('id' => $id),'admin_users');
		
		redirect($language.'/admin/users');
	}

	//to active and inactive supplier and buyer email verification @ap@
	public function change_verification_status($id)
	{
		$language = $this->uri->segment(1);
		$user = $this->custom_model->my_where('admin_users', '*', array('id=' => $id))[0];
		// print_r($user['active']);
		// die;
		// exit();
		$active_email_verify = array(
			'is_email_verify' => 0
		);
		$inactive_email_verify = array(
			'is_email_verify' => 1
		);

		if ($user['is_email_verify'] == 1) {
			$this->custom_model->my_update($active_email_verify, array('id' => $id), 'admin_users');
		} else {
			$this->custom_model->my_update($inactive_email_verify, array('id' => $id), 'admin_users');
		}

		redirect($language . '/admin/users');
	}
}
