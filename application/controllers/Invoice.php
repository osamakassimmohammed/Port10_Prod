<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home page
 */
class Invoice extends MY_Controller {

	public function __construct()
	{
		$this->load->model('User_model');
		$this->load->model('admin/Custom_model','custom_model');
	}
	
	
	public function pdf($order_id)
	{	
	   $this->load->library('pdf_create');
	    $response = $this->pdf_create->get_print_pdf_list($order_id);        
	}

	public function product($item_id,$order='')
	{
		$uid=$this->session->userdata('uid');
		if (empty($uid)) 
		{
			$this->session->set_flashdata('login_message', 'Please Login Or Create Account!!');			
			redirect($language);
		}
		$order_items = $this->custom_model->get_data_array("SELECT items.*,master.currency,master.first_name,master.last_name,master.mobile_no,master.email,master.country,master.city,master.state,master.pincode,master.address_1 FROM order_items as items INNER JOIN order_master as master ON items.order_no=master.order_master_id WHERE items.user_id='$uid' AND items.item_id='$item_id' ");
		if(!empty($order_items))
		{
			foreach ($order_items as $oi_key => $oi_val) 
			{
				$unit_data = $this->custom_model->my_where('unit_list','id,unit_name',array('id' => $oi_val['unit']));
				if(!empty($unit_data))
				{
					$order_items[$oi_key]['unit_name']=$unit_data[0]['unit_name'];
				}else{
					$order_items[$oi_key]['unit_name']='';
				}
				$seller_address = $this->custom_model->my_where('admin_users','id,street_name,building_no,city,state,postal_code,country,first_name',array('id' => $oi_val['seller_id']));
				if(!empty($seller_address))
				{
					$address='';		
					if(!empty($seller_address[0]['street_name']))
					{
						$address.=$seller_address[0]['street_name'].' ';
					}
					if(!empty($seller_address[0]['building_no']))
					{
						$address.=$seller_address[0]['building_no'].' ';
					}
					if(!empty($seller_address[0]['city']))
					{
						$address.=$seller_address[0]['city'].' ';
					}
					if(!empty($seller_address[0]['state']))
					{
						$address.=$seller_address[0]['state'].' ';
					}
					if(!empty($seller_address[0]['country']))
					{
						$address.=$seller_address[0]['country'].' ';
					}
					if(!empty($seller_address[0]['pincode']))
					{
						$address.=$seller_address[0]['pincode'].' ';
					}
					$order_items[$oi_key]['seller_address']=$address;
					$order_items[$oi_key]['seller_name']=$seller_address[0]['first_name'];
				}else{
					$order_items[$oi_key]['seller_address']='';
					$order_items[$oi_key]['seller_name']='';
				}

			}			
			$this->load->library('pdf_product');
		    // $response = $this->pdf_product->get_print_pdf_list($order_items,$order,$item_id);
		    $response = $this->pdf_product->get_print_pdf_new($order_items,$order,$item_id);
		}else{
			$this->session->set_flashdata('common_message', 'Invalid Item Id.!!');	
			redirect($language);
		}
	}


	public function order($order_id,$order='')
	{
		$uid=$this->session->userdata('uid');
		if (empty($uid)) 
		{
			$this->session->set_flashdata('login_message', 'Please Login Or Create Account!!');			
			redirect($language);
		}

		$data = $this->custom_model->my_where('order_master','*',array('order_master_id' => $order_id,'user_id'=>$uid));

		if(!empty($data))
		{

			$order_items = $this->custom_model->get_data_array("SELECT items.* FROM order_items as items  INNER JOIN product as pro  ON  items.product_id=pro.id WHERE items.user_id='$uid' AND items.order_no='$order_id' ");
			if(!empty($order_items))
			{
				foreach ($order_items as $oi_key => $oi_val) 
				{
					$unit_data = $this->custom_model->my_where('unit_list','id,unit_name',array('id' => $oi_val['unit']));
					if(!empty($unit_data))
					{
						$order_items[$oi_key]['unit_name']=$unit_data[0]['unit_name'];
					}else{
						$order_items[$oi_key]['unit_name']='';
					}
				}
			}
			$data[0]['order_items']=$order_items;
		}

		
		// echo "<pre>";
		// print_r($data);
		// print_r($order_items);
		// die;
		// echo "1212121";
		if(!empty($data) && !empty($order_items))
		{						
			// $this->load->library('pdf_create');
			$this->load->library('pdf_product');
		    // $response = $this->pdf_product->get_print_pdf_list($order_items,$order,$item_id);
		    $response = $this->pdf_product->get_print_pdf_all($data,$order,$order_id);
		}else{
			$this->session->set_flashdata('common_message', 'Invalid Item Id.!!');	
			redirect($language);
		}
	}

	public function order_new($order_id,$order='')
	{
		$uid=$this->session->userdata('uid');
		if (empty($uid)) 
		{
			$this->session->set_flashdata('login_message', 'Please Login Or Create Account!!');			
			redirect($language);
		}

		$data = $this->custom_model->my_where('order_master','*',array('order_master_id' => $order_id,'user_id'=>$uid));

		if(!empty($data))
		{

			$order_items = $this->custom_model->get_data_array("SELECT items.* FROM order_items as items  INNER JOIN product as pro  ON  items.product_id=pro.id WHERE items.user_id='$uid' AND items.order_no='$order_id' ");
			if(!empty($order_items))
			{
				foreach ($order_items as $oi_key => $oi_val) 
				{
					$unit_data = $this->custom_model->my_where('unit_list','id,unit_name',array('id' => $oi_val['unit']));
					if(!empty($unit_data))
					{
						$order_items[$oi_key]['unit_name']=$unit_data[0]['unit_name'];
					}else{
						$order_items[$oi_key]['unit_name']='';
					}
				}
			}
			$data[0]['order_items']=$order_items;
		}

		
		// echo "<pre>";
		// print_r($data);
		// print_r($order_items);
		// die;
		// echo "1212121";
		if(!empty($data) && !empty($order_items))
		{						
			// $this->load->library('pdf_create');
			$this->load->library('pdf_product');
		    // $response = $this->pdf_product->get_print_pdf_list($order_items,$order,$item_id);
		    $response = $this->pdf_product->get_print_pdf_all_new($data,$order,$order_id);
		}else{
			$this->session->set_flashdata('common_message', 'Invalid Item Id.!!');	
			redirect($language);
		}
	}

	public function index($item_id,$order='')
	{
		$uid=$this->session->userdata('uid');
		if (empty($uid)) 
		{
			$this->session->set_flashdata('login_message', 'Please Login Or Create Account!!');			
			redirect($language);
		}
		$order_items = $this->custom_model->get_data_array("SELECT items.*,master.currency,master.first_name,master.last_name,master.mobile_no,master.email,master.country,master.city,master.state,master.pincode,master.address_1 FROM order_items as items INNER JOIN order_master as master ON items.order_no=master.order_master_id WHERE items.user_id='$uid' AND items.item_id='$item_id' ");

		// echo "<pre>";
		// print_r($order_items);
		// die;
		$seller_address=$buyer_address=array();
		if(!empty($order_items))
		{
			foreach ($order_items as $oi_key => $oi_val) 
			{
				$unit_data = $this->custom_model->my_where('unit_list','id,unit_name',array('id' => $oi_val['unit']));
				if(!empty($unit_data))
				{
					$order_items[$oi_key]['unit_name']=$unit_data[0]['unit_name'];
				}else{
					$order_items[$oi_key]['unit_name']='';
				}
				$seller_address = $this->custom_model->my_where('admin_users','id,street_name,building_no,city,state,postal_code,country,first_name,vat_number',array('id' => $oi_val['seller_id']));

				$buyer_address = $this->custom_model->my_where('admin_users','id,street_name,building_no,city,state,postal_code,country,first_name,vat_number',array('id' => $uid));
				
			}			
			// echo "<pre>";
			// print_r($order_items);
			// print_r($seller_address);
			// print_r($buyer_address);
			// die;
			$data['order_items'] = $order_items; 
			$data['seller_address'] = $seller_address; 
			$data['buyer_address'] = $buyer_address; 
			$html = $this->load->view('new_invoice',$data, true); 
			
	     	$file_name = "invoice_.pdf";
	         // $file_name = "invoice_1212.pdf";
	        require_once(BASE_PATH.'application/libraries/vendor/autoload.php');
		    
            $mpdf = new \Mpdf\Mpdf([
                    'mode' => 'utf-8',
            'format' => 'A4',
                    // 'orientation' => 'L'
            ]);
            $mpdf->WriteHTML($html);
            $mpdf->Output(date('M').'receipt.pdf', \Mpdf\Output\Destination::INLINE);
            // $mpdf->Output(date('M').'receipt.pdf','d');	

		}else{
			$this->session->set_flashdata('common_message', 'Invalid Item Id.!!');	
			redirect($language);
		}
		
	}
}