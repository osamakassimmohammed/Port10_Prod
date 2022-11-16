<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashbord extends Admin_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
		$this->load->model('custom_model');		
	}

	public function index()
	{
		$user_session = $this->session->all_userdata();	
		// echo "<pre>";
		// print_r($user_session);
		// die;
		if($this->session->userdata('group_id') == 1 || $this->session->userdata('group_id') == 9)
		{
			$now = date('Y-m-d' ,strtotime('today'));		
			// $now = date('Y-m-d' ,strtotime('-1 days'));		
			$now2 = date('Y/m/d' ,strtotime('today'));	

			
			
			$count_user = $this->custom_model->get_data_array("SELECT COUNT(id) as count_user FROM admin_users WHERE `id`!='1'");

			$product_count = $this->custom_model->get_data_array("SELECT COUNT(id) as product_count FROM product WHERE `product_delete`='0'");

			

			// $profit_total = $this->custom_model->get_data_array("SELECT SUM(net_total) as total FROM order_master WHERE order_status!='Cancelled'   ");
			$profit_total = $this->custom_model->get_data_array("SELECT order_master_id,net_total,coupon_price  FROM order_master WHERE payment_status='Paid' AND is_show='1' order by order_master_id desc ");
			// echo "<pre>";
			// print_r($profit_total);
			// die;
			

			$Cancelled_order = $this->custom_model->get_data_array("SELECT COUNT(order_master_id) as Cancelled FROM order_master WHERE  `order_status`='canceled' AND is_show='1' ");		
			

			$complete_order = $this->custom_model->get_data_array("SELECT COUNT(order_master_id) as complete FROM order_master WHERE `order_status`='Delivered' AND is_show='1'  ");

			$pending_order = $this->custom_model->get_data_array("SELECT COUNT(order_master_id) as pending FROM order_master WHERE `order_status`='Pending' AND is_show='1'  ");			
			// echo "<pre>";
			// print_r($pending_order);
			// die;

			$today_order = $this->custom_model->get_data_array("SELECT * FROM order_master WHERE order_datetime LIKE '%$now%' AND is_show='1' order by order_master_id desc");	

			// $top_selled = $this->custom_model->get_data_array("SELECT item_id,product_id, COUNT(*) as pro_count FROM `order_items` GROUP by product_id HAVING COUNT(*) >1	ORDER BY product_id DESC limit 8 ");			

			$top_selled = $this->custom_model->get_data_array("SELECT orit.item_id,orit.product_id, COUNT(*) as pro_count,pro.product_name,pro.product_image  FROM order_items as orit INNER JOIN product as pro ON orit.product_id=pro.id WHERE pro.product_delete='0' GROUP by orit.product_id HAVING COUNT(*) >1	ORDER BY orit.product_id DESC limit 8   ");


			// echo "<pre>";
			// print_r($top_selled);
			// print_r($top_selled1);
			// die;
			usort($top_selled, function($a, $b) 
			{
				return $a['pro_count'] - $b['pro_count'];
			});		

			
			
        	$day = date("Y-m-d");
        	$day1 = date('Y-m-d',strtotime("-1 days"));
        	$day2 = date('Y-m-d',strtotime("-2 days"));
        	$day3 = date('Y-m-d',strtotime("-3 days"));
        	$day4 = date('Y-m-d',strtotime("-4 days"));
        	$day5 = date('Y-m-d',strtotime("-5 days"));
        	$day6 = date('Y-m-d',strtotime("-6 days"));
        	$day7 = date('Y-m-d',strtotime("-7 days"));
        	$day8 = date('Y-m-d',strtotime("-8 days"));
        	$day9 = date('Y-m-d',strtotime("-9 days"));
        	$day10 = date('Y-m-d',strtotime("-10 days"));
        	$day11 = date('Y-m-d',strtotime("-11 days"));
        	$day12 = date('Y-m-d',strtotime("-12 days"));
        	$day13 = date('Y-m-d',strtotime("-13 days"));
        	$day14 = date('Y-m-d',strtotime("-14 days"));
        	

			$day = $this->custom_model->get_data_array("SELECT SUM(sub_total) as total FROM order_master WHERE order_status='Delivered' AND is_show='1' AND `order_datetime` LIKE '%$day%' ");
			if (empty($day[0]['total'])){$day[0]['total'] = '0';}	
			


			$day1 = $this->custom_model->get_data_array("SELECT SUM(sub_total) as total FROM order_master WHERE order_status='Delivered' AND is_show='1' AND `order_datetime` LIKE '%$day1%' ");
			if (empty($day1[0]['total'])){$day1[0]['total'] = '0';}

			$day2 = $this->custom_model->get_data_array("SELECT SUM(sub_total) as total FROM order_master WHERE order_status='Delivered' AND is_show='1' AND `order_datetime` LIKE '%$day2%' ");
			if (empty($day2[0]['total'])){$day2[0]['total'] = '0';}

			$day3 = $this->custom_model->get_data_array("SELECT SUM(sub_total) as total FROM order_master WHERE order_status='Delivered' AND is_show='1' AND `order_datetime` LIKE '%$day3%' ");
			if (empty($day3[0]['total'])){$day3[0]['total'] = '0';}

			$day4 = $this->custom_model->get_data_array("SELECT SUM(sub_total) as total FROM order_master WHERE order_status='Delivered' AND is_show='1' AND `order_datetime` LIKE '%$day4%' ");
			if (empty($day4[0]['total'])){$day4[0]['total'] = '0';}

			$day5 = $this->custom_model->get_data_array("SELECT SUM(sub_total) as total FROM order_master WHERE order_status='Delivered' AND is_show='1' AND `order_datetime` LIKE '%$day5%' ");
			if (empty($day5[0]['total'])){$day5[0]['total'] = '0';}

			$day6 = $this->custom_model->get_data_array("SELECT SUM(sub_total) as total FROM order_master WHERE order_status='Delivered' AND is_show='1' AND `order_datetime` LIKE '%$day6%' ");
			if (empty($day6[0]['total'])){$day6[0]['total'] = '0';}

			$day7 = $this->custom_model->get_data_array("SELECT SUM(sub_total) as total FROM order_master WHERE order_status='Delivered' AND is_show='1' AND `order_datetime` LIKE '%$day7%' ");
			
			if (empty($day7[0]['total'])){$day7[0]['total'] = '0';}
			

			$day8 = $this->custom_model->get_data_array("SELECT SUM(sub_total) as total FROM order_master WHERE order_status='Delivered' AND is_show='1' AND `order_datetime` LIKE '%$day8%' ");
			if (empty($day8[0]['total'])){$day8[0]['total'] = '0';}

			$day9 = $this->custom_model->get_data_array("SELECT SUM(sub_total) as total FROM order_master WHERE order_status='Delivered' AND is_show='1' AND `order_datetime` LIKE '%$day9%' ");
			if (empty($day9[0]['total'])){$day9[0]['total'] = '0';}

			$day10 = $this->custom_model->get_data_array("SELECT SUM(sub_total) as total FROM order_master WHERE order_status='Delivered' AND is_show='1' AND `order_datetime` LIKE '%$day10%' ");
			if (empty($day10[0]['total'])){$day10[0]['total'] = '0';}

			$day11 = $this->custom_model->get_data_array("SELECT SUM(sub_total) as total FROM order_master WHERE order_status='Delivered' AND is_show='1' AND `order_datetime` LIKE '%$day11%' ");
			if (empty($day11[0]['total'])){$day11[0]['total'] = '0';}

			$day12 = $this->custom_model->get_data_array("SELECT SUM(sub_total) as total FROM order_master WHERE order_status='Delivered' AND is_show='1' AND `order_datetime` LIKE '%$day12%' ");
			if (empty($day12[0]['total'])){$day12[0]['total'] = '0';}

			$day13 = $this->custom_model->get_data_array("SELECT SUM(sub_total) as total FROM order_master WHERE order_status='Delivered' AND is_show='1' AND `order_datetime` LIKE '%$day13%' ");
			if (empty($day13[0]['total'])){$day13[0]['total'] = '0';}

			$day14 = $this->custom_model->get_data_array("SELECT SUM(sub_total) as total FROM order_master WHERE order_status='Delivered' AND is_show='1' AND `order_datetime` LIKE '%$day14%' ");
			if (empty($day14[0]['total'])){$day14[0]['total'] = '0';}

			

			$this->mViewData['day']   = $day[0]['total'];
			$this->mViewData['day1']  = $day1[0]['total'];
			$this->mViewData['day2']  = $day2[0]['total'];
			$this->mViewData['day3']  = $day3[0]['total'];
			$this->mViewData['day4']  = $day4[0]['total'];
			$this->mViewData['day5']  = $day5[0]['total'];
			$this->mViewData['day6']  = $day6[0]['total'];
			$this->mViewData['day7']  = $day7[0]['total'];
			$this->mViewData['day8']  = $day8[0]['total'];
			$this->mViewData['day9']  = $day9[0]['total'];
			$this->mViewData['day10'] = $day10[0]['total'];
			$this->mViewData['day11'] = $day11[0]['total'];
			$this->mViewData['day12'] = $day12[0]['total'];
			$this->mViewData['day13'] = $day13[0]['total'];
			$this->mViewData['day14'] = $day14[0]['total'];

			$dataPoints = array(
	            array("label"=> "Total users", "y"=> $count_user[0]['count_user']),
	            // array("label"=> "Total Sales Abu Dhabi", "y"=> $profit_total[0]['total']),	            

	            array("label"=> "complete order", "y"=> $complete_order[0]['complete']),	            
	            array("label"=> "Cancelled order", "y"=> $Cancelled_order[0]['Cancelled']),	            
	         );

			$this->mViewData['dataPoints'] = $dataPoints;


			//Today order section

			$today_sales = $this->custom_model->get_data_array("SELECT SUM(sub_total) as total FROM order_master WHERE order_status='Delivered' AND is_show='1' AND order_datetime LIKE '%$now%' ");
			
			$today_pending = $this->custom_model->get_data_array("SELECT COUNT(order_master_id) as today_pending FROM order_master WHERE order_status!='Delivered' AND order_status!='Dispatched' AND is_show='1' AND order_datetime LIKE '%$now%' ");

			$today_deliverd = $this->custom_model->get_data_array("SELECT COUNT(order_master_id) as today_deliverd FROM order_master WHERE order_status='Delivered' AND is_show='1' AND order_datetime LIKE '%$now%' ");

			$today_canceled = $this->custom_model->get_data_array("SELECT COUNT(order_master_id) as today_canceled FROM order_master WHERE order_status='canceled' AND is_show='1' AND order_datetime LIKE '%$now%' ");


			$today_user = $this->custom_model->get_data_array("SELECT COUNT(id) as today_user FROM admin_users WHERE created_on LIKE '%$now2%'");

			$this->mViewData['today_sales'] = $today_sales;
			$this->mViewData['today_pending'] = $today_pending;
			$this->mViewData['today_deliverd'] = $today_deliverd;
			$this->mViewData['today_canceled'] = $today_canceled;
			$this->mViewData['today_user'] = $today_user;
			
			//End today order

			// THIS WEEK section start

			$week= date("Y-m-d", strtotime($now. "-6day"));
			$week2= date("Y/m/d", strtotime($now2. "-6day"));
			$plus_oneday = date('Y-m-d' ,strtotime('1day'));
			$plus_oneday2 = date('Y/m/d' ,strtotime('1day'));
			// die;

			$week_order = $this->custom_model->get_data_array("SELECT COUNT(order_master_id) as week_order FROM order_master WHERE `order_datetime` BETWEEN '$week' AND '$plus_oneday' AND is_show='1' ");


			$week_sales = $this->custom_model->get_data_array("SELECT SUM(sub_total) as total FROM order_master WHERE `order_datetime` BETWEEN '$week'  AND '$plus_oneday' AND is_show='1' ");

			$week_pending = $this->custom_model->get_data_array("SELECT COUNT(order_master_id) as week_pending FROM order_master WHERE order_status!='Delivered' AND order_status!='Dispatched' AND `order_datetime` BETWEEN '$week'  AND '$plus_oneday' AND is_show='1' ");

			$week_deliverd = $this->custom_model->get_data_array("SELECT COUNT(order_master_id) as week_deliverd FROM order_master WHERE order_status='Delivered' AND `order_datetime` BETWEEN '$week'  AND '$plus_oneday' AND is_show='1' ");

			$week_canceled = $this->custom_model->get_data_array("SELECT COUNT(order_master_id) as week_canceled FROM order_master WHERE order_status='canceled' AND `order_datetime` BETWEEN '$week'  AND '$plus_oneday' AND is_show='1' ");
			// echo "<pre>";
			// print_r($week_canceled);
			// die;

			$week_users = $this->custom_model->get_data_array("SELECT COUNT(id) as week_users FROM admin_users WHERE `created_on` BETWEEN '$week2'  AND '$plus_oneday2' ");

			$this->mViewData['week_order'] = $week_order;
			$this->mViewData['week_sales'] = $week_sales;
			$this->mViewData['week_pending'] = $week_pending;
			$this->mViewData['week_deliverd'] = $week_deliverd;
			$this->mViewData['week_canceled'] = $week_canceled;
			$this->mViewData['week_users'] = $week_users;


			// echo $this->db->last_query();

			// $response = $this->custom_model->get_data("SELECT * FROM order_master WHERE `order_datetime` BETWEEN '$last_month_diet_listing'  AND '$now'  ORDER BY 'order_master_id' DESC");

			// end this week section
	

			
			

			// $product_full_value=$this->thousandsCurrencyFormat($product_full_value);			

			
			$first_day_this_month = date('Y/m/01');	
			$last_day_this_month  = date('Y/m/t');	

			$first_day_this_month2 = date('Y-m-01');	
			$last_day_this_month2  = date('Y-m-t');

			$this_month_suppler = $this->custom_model->get_data_array("SELECT COUNT(id) as suppler_count FROM admin_users WHERE type='suppler' AND `created_on` BETWEEN '$first_day_this_month' AND '$last_day_this_month' ");

			$this_month_buyer = $this->custom_model->get_data_array("SELECT COUNT(id) as buyer_count FROM admin_users WHERE type='buyer' AND `created_on` BETWEEN '$first_day_this_month' AND '$last_day_this_month' ");

			$this_month_newsletter = $this->custom_model->get_data_array("SELECT COUNT(id) as newsletter_count FROM newsletter WHERE `created_date` BETWEEN '$first_day_this_month2' AND '$last_day_this_month2' ");

			// echo "<pre>";
			// print_r($this_month_suppler);
			// print_r($this_month_buyer);
			// print_r($this_month_newsletter);
			// die;
			
			$this->mViewData['suppler_count'] = $this_month_suppler[0]['suppler_count'];
			$this->mViewData['buyer_count'] = $this_month_buyer[0]['buyer_count'];
			$this->mViewData['newsletter_count'] = $this_month_newsletter[0]['newsletter_count'];
			
			$this->mViewData['count_user'] = $count_user[0]['count_user'];
			$this->mViewData['product_count'] = $product_count[0]['product_count'];
			
			$this->mViewData['profit_total'] = $profit_total;								
			$this->mViewData['Cancelled_order'] = $Cancelled_order;			
					
				
			$this->mViewData['pending_order'] = $pending_order;			
			$this->mViewData['complete_order'] = $complete_order;			
			$this->mViewData['top_selled'] = $top_selled;
			
			
			
			$this->mViewData['today_order'] = $today_order;			
					
					
			// $this->mViewData['product_count'] = $product_count;			
			$this->mPageTitle = 'Dashbord';
			$this->render('admin/dashbord', 'plain');
		}else{

			if($this->session->userdata('group_id') == 10)
			{
				$this->subsupplier_dashboard();
			}else{
				$this->supplier_dashboard();				
			}
		}		
	}

	public function supplier_dashboard()
	{
		$seller_id = $this->mUser->id;
		$now = date('Y-m-d' ,strtotime('today'));
		$now2 = date('Y/m/d' ,strtotime('today'));	

		$pending_order = $this->custom_model->get_data_array("SELECT COUNT(invoice_id) as pending FROM order_invoice WHERE `order_status`='Pending' AND `seller_id`='$seller_id' AND `is_show`=1  ");

		// echo "<pre>";
		// print_r($pending_order);
		// die;

		$complete_order = $this->custom_model->get_data_array("SELECT COUNT(invoice_id) as complete FROM order_invoice WHERE `order_status`='Delivered' AND `seller_id`='$seller_id' AND `is_show`=1  ");

		$product_count = $this->custom_model->get_data_array("SELECT COUNT(id) as product_count FROM product WHERE seller_id='$seller_id' AND product_delete=0 ");



		$this->mViewData['pending_order'] = $pending_order[0]['pending'];	
		$this->mViewData['complete_order'] = $complete_order[0]['complete'];
		$this->mViewData['product_count'] = $product_count[0]['product_count'];


		$today_canceled = $this->custom_model->get_data_array("SELECT COUNT(invoice_id) as today_canceled FROM order_invoice WHERE order_status='canceled' AND `is_show`=1 AND created_date LIKE '%$now%' AND `seller_id`='$seller_id' ");

		$today_complete = $this->custom_model->get_data_array("SELECT COUNT(invoice_id) as today_complete FROM order_invoice WHERE order_status='Delivered' AND `is_show`=1 AND `seller_id`='$seller_id' AND created_date LIKE '%$now%' ");

		$today_pending = $this->custom_model->get_data_array("SELECT COUNT(invoice_id) as today_pending FROM order_invoice WHERE order_status='Pending' AND `is_show`=1 AND `seller_id`='$seller_id' AND created_date LIKE '%$now%' ");

		$today_order = $this->custom_model->get_data_array("SELECT COUNT(invoice_id) as today_order FROM order_invoice WHERE  `seller_id`='$seller_id' AND `is_show`=1 AND created_date LIKE '%$now%' ");


		$this->mViewData['today_canceled'] = $today_canceled[0]['today_canceled'];	
		$this->mViewData['today_complete'] = $today_complete[0]['today_complete'];	
		$this->mViewData['today_pending'] = $today_pending[0]['today_pending'];	
		$this->mViewData['today_order'] = $today_order[0]['today_order'];	

		// THIS WEEK section start

		$week= date("Y-m-d", strtotime($now. "-6day"));
		$week2= date("Y/m/d", strtotime($now2. "-6day"));
		$plus_oneday = date('Y-m-d' ,strtotime('1day'));
		$plus_oneday2 = date('Y/m/d' ,strtotime('1day'));

		$week_order = $this->custom_model->get_data_array("SELECT COUNT(invoice_id) as week_order FROM order_invoice WHERE `created_date` BETWEEN '$week' AND '$plus_oneday'  AND `seller_id`='$seller_id' AND `is_show`=1 ");

		$week_pending = $this->custom_model->get_data_array("SELECT COUNT(invoice_id) as week_pending FROM order_invoice WHERE order_status='Pending'  AND `created_date` BETWEEN '$week'  AND '$plus_oneday'  AND `seller_id`='$seller_id' AND `is_show`=1 ");

		$week_canceled = $this->custom_model->get_data_array("SELECT COUNT(invoice_id) as week_canceled FROM order_invoice WHERE order_status='canceled'  AND `created_date` BETWEEN '$week'  AND '$plus_oneday'  AND `seller_id`='$seller_id' AND `is_show`=1 ");

		$week_complete = $this->custom_model->get_data_array("SELECT COUNT(invoice_id) as week_complete FROM order_invoice WHERE order_status='Delivered'  AND `created_date` BETWEEN '$week'  AND '$plus_oneday'  AND `seller_id`='$seller_id' AND `is_show`=1 ");

		$this->mViewData['week_order'] = $week_order[0]['week_order'];	
		$this->mViewData['week_pending'] = $week_pending[0]['week_pending'];	
		$this->mViewData['week_canceled'] = $week_canceled[0]['week_canceled'];	
		$this->mViewData['week_complete'] = $week_complete[0]['week_complete'];	
		// $now = date('Y-m-d' ,strtotime('-2 days'));	

		$today_new_orders = $this->custom_model->get_data_array("SELECT invoice.invoice_id,invoice.order_no,invoice.item_ids,invoice.payment_status,invoice.payment_mode,invoice.created_date,invoice.order_status,invoice.seller_id,invoice.net_total as in_net_total,invoice.sub_total as in_sub_total,master.display_order_id,master.first_name,master.last_name,master.mobile_no,master.email,master.country,master.city,master.state,master.pincode,master.address_1,master.currency,master.order_datetime FROM order_invoice as invoice INNER JOIN order_master as master ON invoice.order_no = master.order_master_id  WHERE invoice.seller_id='$seller_id' AND master.is_show=1 AND invoice.created_date LIKE '%$now%' ORDER BY invoice.invoice_id DESC ");

		// $top_selled = $this->custom_model->get_data_array("SELECT item_id,product_id,seller_id, COUNT(product_id) as pro_count FROM `order_items`  GROUP by product_id HAVING COUNT(product_id) >1 AND seller_id='$seller_id' ORDER BY product_id DESC ");

		$top_selled = $this->custom_model->get_data_array("SELECT orit.item_id,orit.product_id, COUNT(*) as pro_count,pro.product_name,pro.product_image  FROM order_items as orit INNER JOIN product as pro ON orit.product_id=pro.id WHERE pro.product_delete='0' AND orit.seller_id='$seller_id' GROUP by orit.product_id HAVING COUNT(*) >1	ORDER BY orit.product_id DESC limit 8   ");

		usort($top_selled, function($a, $b) 
		{
			return $a['pro_count'] - $b['pro_count'];
		});			

		
		// echo "<pre>";
		// print_r($top_selled);
		// die;

		$this->mViewData['today_new_orders'] =$today_new_orders;		
		$this->mViewData['top_selled'] = $top_selled;		
		$this->mPageTitle = 'Dashbord';
		$this->render('admin/vender_dashboard', 'plain');
	}

	public function subsupplier_dashboard()
	{
		// echo "<pre>";
		// print_r($this->mUser);
		// die;
		$this->get_access_id();	
		$seller_id = $this->nmUser_id;
		$now = date('Y-m-d' ,strtotime('today'));
		$now2 = date('Y/m/d' ,strtotime('today'));	
		$vorders_arr=array();
		$access_arr=explode(",",$this->mUser->access_permission);
		if(in_array('vorders', $access_arr))
		{
			$pending_order = $this->custom_model->get_data_array("SELECT COUNT(invoice_id) as pending FROM order_invoice WHERE `order_status`='Pending' AND `seller_id`='$seller_id' AND `is_show`=1  ");

			$complete_order = $this->custom_model->get_data_array("SELECT COUNT(invoice_id) as complete FROM order_invoice WHERE `order_status`='Delivered' AND `seller_id`='$seller_id' AND `is_show`=1  ");

			$vorders_arr['pending_order']=$pending_order[0]['pending'];
			$vorders_arr['complete_order']=$complete_order[0]['complete'];

			$today_canceled = $this->custom_model->get_data_array("SELECT COUNT(invoice_id) as today_canceled FROM order_invoice WHERE order_status='canceled' AND created_date LIKE '%$now%' AND `seller_id`='$seller_id' AND `is_show`=1 ");

			$today_complete = $this->custom_model->get_data_array("SELECT COUNT(invoice_id) as today_complete FROM order_invoice WHERE order_status='Delivered' AND `is_show`=1 AND `seller_id`='$seller_id' AND created_date LIKE '%$now%' ");

			$today_pending = $this->custom_model->get_data_array("SELECT COUNT(invoice_id) as today_pending FROM order_invoice WHERE order_status='Pending' AND `is_show`=1 AND `seller_id`='$seller_id' AND created_date LIKE '%$now%' ");

			$today_order = $this->custom_model->get_data_array("SELECT COUNT(invoice_id) as today_order FROM order_invoice WHERE  `seller_id`='$seller_id' AND `is_show`=1 AND created_date LIKE '%$now%' ");

			$vorders_arr['today_canceled']=$today_canceled[0]['today_canceled'];
			$vorders_arr['today_complete']=$today_complete[0]['today_complete'];
			$vorders_arr['today_pending']=$today_pending[0]['today_pending'];
			$vorders_arr['today_order']=$today_order[0]['today_order'];

			$week= date("Y-m-d", strtotime($now. "-6day"));
			$week2= date("Y/m/d", strtotime($now2. "-6day"));
			$plus_oneday = date('Y-m-d' ,strtotime('1day'));
			$plus_oneday2 = date('Y/m/d' ,strtotime('1day'));

			$week_order = $this->custom_model->get_data_array("SELECT COUNT(invoice_id) as week_order FROM order_invoice WHERE `created_date` BETWEEN '$week' AND '$plus_oneday'  AND `seller_id`='$seller_id' AND `is_show`=1 ");

			$week_pending = $this->custom_model->get_data_array("SELECT COUNT(invoice_id) as week_pending FROM order_invoice WHERE order_status='Pending'  AND `created_date` BETWEEN '$week'  AND '$plus_oneday'  AND `seller_id`='$seller_id' AND `is_show`=1 ");

			$week_canceled = $this->custom_model->get_data_array("SELECT COUNT(invoice_id) as week_canceled FROM order_invoice WHERE order_status='canceled'  AND `created_date` BETWEEN '$week'  AND '$plus_oneday'  AND `seller_id`='$seller_id' AND `is_show`=1 ");

			$week_complete = $this->custom_model->get_data_array("SELECT COUNT(invoice_id) as week_complete FROM order_invoice WHERE order_status='Delivered'  AND `created_date` BETWEEN '$week'  AND '$plus_oneday'  AND `seller_id`='$seller_id' AND `is_show`=1 ");
			

			$vorders_arr['week_order']=$week_order[0]['week_order'];
			$vorders_arr['week_pending']=$week_pending[0]['week_pending'];
			$vorders_arr['week_canceled']=$week_canceled[0]['week_canceled'];
			$vorders_arr['week_complete']=$week_complete[0]['week_complete'];


			$today_new_orders = $this->custom_model->get_data_array("SELECT invoice.invoice_id,invoice.order_no,invoice.item_ids,invoice.payment_status,invoice.payment_mode,invoice.created_date,invoice.order_status,invoice.seller_id,invoice.net_total as in_net_total,invoice.sub_total as in_sub_total,master.display_order_id,master.first_name,master.last_name,master.mobile_no,master.email,master.country,master.city,master.state,master.pincode,master.address_1,master.currency,master.order_datetime FROM order_invoice as invoice INNER JOIN order_master as master ON invoice.order_no = master.order_master_id  WHERE invoice.seller_id='$seller_id' AND master.is_show=1 AND invoice.created_date LIKE '%$now%' ORDER BY invoice.invoice_id DESC ");
			

			$vorders_arr['today_new_orders']=$today_new_orders;

		}

		
		$this->mViewData['vorders_arr'] =$vorders_arr;

		$product_arr=array();

		if(in_array('product', $access_arr))
		{
			$product_count = $this->custom_model->get_data_array("SELECT COUNT(id) as product_count FROM product WHERE seller_id='$seller_id' AND product_delete=0 ");			

			$product_arr['product_count']=$product_count[0]['product_count'];

			$top_selled = $this->custom_model->get_data_array("SELECT orit.item_id,orit.product_id, COUNT(*) as pro_count,pro.product_name,pro.product_image  FROM order_items as orit INNER JOIN product as pro ON orit.product_id=pro.id WHERE pro.product_delete='0' AND orit.seller_id='$seller_id' GROUP by orit.product_id HAVING COUNT(*) >1	ORDER BY orit.product_id DESC limit 8   ");

			usort($top_selled, function($a, $b) 
			{
				return $a['pro_count'] - $b['pro_count'];
			});		

			$product_arr['top_selled']=$top_selled;
		}

		// echo "<pre>";
		// print_r($product_arr);
		// die;
		$this->mViewData['product_arr'] =$product_arr;

		$quotation_arr=array();
		if(in_array('receive_quotation', $access_arr))
		{
			$quotation_data = $this->custom_model->get_data_array("SELECT squ.* FROM send_quotation as squ INNER JOIN quotation_invoice as qoin ON squ.id=qoin.quotaion_id  WHERE qoin.seller_id='$seller_id'  ORDER BY squ.id DESC limit 10 ");

			$quotation_arr['quotation_data']=$quotation_data;
		}

		$this->mViewData['quotation_arr'] =$quotation_arr;

		// echo "<pre>";
		// print_r($quotation_arr);
		// die;
			
		$this->mPageTitle = 'Dashbord';
		$this->render('admin/subsupplier_dashboard', 'plain');
	}

	public function thousandsCurrencyFormat($num) 
	{

	  if($num>1000) 
	  {

	        $x = round($num);
	        $x_number_format = number_format($x);
	        $x_array = explode(',', $x_number_format);
	        $x_parts = array('k', 'm', 'b', 't');
	        $x_count_parts = count($x_array) - 1;
	        $x_display = $x;
	        $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
	        $x_display .= $x_parts[$x_count_parts - 1];

	        return $x_display;
	  	}
	  return $num;
	}

	public function notification()
	{
		$is_notification = $this->custom_model->my_where('order_master','order_master_id',array('notification' =>'0'));
		// echo "<pre>";
		// print_r($is_notification);
		// die;
		if(!empty($is_notification))
		{
			foreach ($is_notification as $key => $value) {					
			$this->custom_model->my_update(array('notification' =>'1'),array('order_master_id' =>$value['order_master_id']),'order_master');
			}
			echo json_encode(array('status'=>true,'message'=>$is_notification));	
			die;
		}else{
			echo json_encode(array('status'=>false,'message'=>'no record found'));
			die;
		}		
	}

	public function all_topsold($csv='')
	{	
		$this->mUser->id;
		if($this->session->userdata('group_id') == 1 || $this->session->userdata('group_id') == 2)
        {
        	$sub_query=" ";
        }else{
        	$sub_query="AND orit.seller_id='$seller_id' ";
        }	

        $top_selled = $this->custom_model->get_data_array("SELECT orit.item_id,orit.product_id, COUNT(*) as pro_count,pro.product_name,pro.product_image  FROM order_items as orit INNER JOIN product as pro ON orit.product_id=pro.id WHERE pro.product_delete='0' $sub_query  GROUP by orit.product_id HAVING COUNT(*) >1	ORDER BY orit.product_id DESC    ");

		// $top_selled = $this->custom_model->get_data_array("SELECT item_id,product_id, COUNT(*) as pro_count FROM `order_items` GROUP by product_id HAVING COUNT(*) > 1	ORDER BY product_id DESC ");
			usort($top_selled, function($a, $b) 
			{
		    	return $a['pro_count'] - $b['pro_count'];
			});			
			$url=base_url('admin/dashbord/all_topsold');
			$file_name='top_sold_'.date("d-m-Y").'.csv';
			
			
			if(!empty($csv))
			{
				if (!empty($top_selled))
				{
				 header('Content-Type:text/csv');
				 header("Content-Disposition: attachment; filename=\"$file_name\";");
				 // header("Content-Disposition: attachment; filename=" );

				 
				 $str = 'Product id,Product API Id,Sold Count,Product Name,Product Image,Price';
				 
				 $fp = fopen('php://output', 'wb');


				 $i = 0;
				 $header = explode(",", $str);
				 fputcsv($fp, $header);

				 foreach ($top_selled as $key => $value)
				 {
			 	
			 	// $date=date('M-d-Y' ,strtotime($value['order_datetime']));
					 $DATACSV[] = $value['product_id'];
					 $DATACSV[] = $value['api_pro_id'];
					 $DATACSV[] = $value['pro_count'];
					 $DATACSV[] = $value['product_name'];
					 $DATACSV[] = $value['product_image'];
					 $DATACSV[] = $value['sale_price'];
					 	 
						fputcsv($fp, $DATACSV);
						$DATACSV = array();
					 }
				}
				else
				{ ?>
				 <script>
				 	alert("No data found")		
				 url="<?php echo $url ?>";
				 setTimeout(function(){ window.location=url; }, 2000);
				 </script>

				<?php }		 
				 die;
			}				

			// echo "<pre>";
			// print_r($top_selled);
			// die;
			$this->mViewData['top_selled'] = $top_selled;
			$this->mPageTitle = 'Top Sold';
			$this->render('admin/topsold/all_topsold', 'default');
	}

}