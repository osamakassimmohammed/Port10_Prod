<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home page
 */
class Print_file extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
		$this->load->model('custom_model');		
	}
	
	
	public function view($order_id='')
	{	
		$data = $this->custom_model->my_where('order_master','*',array('order_master_id' => $order_id));

		if(!empty($data))
		{
			foreach ($data as $d_key => $d_val) 
			{
				$order_items = $this->custom_model->my_where('order_items','*',array('order_no' => $order_id));

				$data[$d_key]['order_items']=$order_items;

				if(!empty($data[$d_key]['order_items']))
				{
					foreach ($data[$d_key]['order_items'] as $item_key => $item_val) 
					{
						$items_extra = $this->custom_model->my_where('items_extra_data','*',array('item_id' => $item_val['item_id']));
						
							$data[$d_key]['order_items'][$item_key]['items_extra_data']=$items_extra;
						
					}
				}

				$trans_history = $this->custom_model->my_where("payment_details","*",array("display_order_id" => $data[0]['display_order_id']) );
				if(!empty($trans_history))
				{
					$data[0]['track_id']=$trans_history[0]['track_id'];
				}
			}

			// echo "<pre>";
			// print_r($data);
			// die;
			$this->mViewData['data'] = $data;		
			$this->render('print_file/print','empty');
		}else{
			redirect('/admin');
		}        
	}	

}