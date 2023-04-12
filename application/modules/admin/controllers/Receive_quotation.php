<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Receive_quotation extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
		$this->load->model('custom_model');
		$this->load->model('category_model');
		$this->get_access_id();	
	}



	// Create Frontend Category
	public function create_invoice($id='')
	{
		$language= $this->uri->segment(1);
		if($language=='en')
		{
			$err_msg1='Quotation Request';
		}else{			
			$err_msg1='طلب تسعيرة';
		}

		//old if(!empty($this->mUser->id) && $this->mUser->id!=1)
		// {
		// 	$seller_id=$this->mUser->id;
		// 	$sub_query=" WHERE id='$id' AND seller_id='$seller_id' ";
		// }else if($this->mUser->id){	
		// 	$seller_id=$this->mUser->id;
		// 	$sub_query=" WHERE id='$id' AND seller_id='$seller_id' ";
		// }else{
		// 	redirect();
		// }old end
		if(!empty($this->nmUser_id))
		{
			$seller_id=$this->nmUser_id;
			$sub_query=" WHERE id='$id' AND seller_id='$seller_id' ";
		}else{
			redirect();
		}
		$tax_data = $this->custom_model->get_data_array("SELECT * FROM tax WHERE id='1' ");
		$post_data=$this->input->post();
		if(!empty($post_data))
		{	
			// echo "<pre>";
			// print_r($this->nmUser_id);
			// exit();
			// $is_request = $this->custom_model->get_data_array("SELECT id,quotation_status FROM `send_quotation` WHERE seller_id='$seller_id'  AND id='$id'");
			// $seller_id = str_replace('<pre>', '', $seller_id);
			$is_request = $this->custom_model->get_data_array("SELECT squ.id,squ.quotation_status,qoin.invoice_status,squ.uid FROM send_quotation as squ INNER JOIN quotation_invoice as qoin ON squ.id=qoin.quotaion_id  WHERE qoin.seller_id='$seller_id' AND qoin.quotaion_id='$id' ");
			if($is_request[0]['quotation_status']=='Cancelled')
			{
				echo json_encode(array('status'=>false,"message"=>($language == 'ar'? 'تم إلغاء الطلب من قبل المستخدم':'Request Cancelled By user'))); die;
			}
			$in_sku=$post_data['in_sku'];
			// echo "<pre>";
			// print_r($post_data['in_sku']);
			// exit();
			// $is_product= $this->custom_model->get_data_array("SELECT id FROM `product` WHERE seller_id='$seller_id'  AND id='$in_sku'");
			$is_product= $this->db->get_where('product', array('id'=>$in_sku,'seller_id'=>$seller_id))->result_array();
			// print_r($is_product);
			// exit();
			if(empty($is_product))
			{
				echo json_encode(array('status'=>false,"message"=>($language == 'ar'? 'معرف المنتج غير صحيح أو هذا المنتج لا ينتمي لك':'Invalid product id or this product not belongs to you'))); die;	
			}
			if(!empty($is_request))
			{
				// $is_send = $this->custom_model->get_data_array("SELECT * FROM quotation_invoice WHERE quotaion_id='$id' AND seller_id='$seller_id' ");
				
				if($is_request[0]['invoice_status']=='Cancelled')
				{
					echo json_encode(array('status'=>false,"message"=>($language == 'ar'? ' المستخدم الغى الطلب':'User Cancelled Request'))); die;
				}else if($is_request[0]['invoice_status']=='Rejected')
				{
					echo json_encode(array('status'=>false,"message"=>($language == 'ar'? 'You Rejected Request':'You Rejected Request'))); die;
				}else if($is_request[0]['invoice_status']=='Confirmed'){
					echo json_encode(array('status'=>false,"message"=>($language == 'ar'? 'تم ارسال الفاتورة من قبل':"You've already sent the invoice"))); die;	
				}else{

					$update_data=array();
					// $update_data['quotaion_id']=$id;
					// $update_data['in_iref_no']=$post_data['in_iref_no'];
					// $update_data['in_user_name']=$post_data['in_user_name'];
					// $update_data['uid']=$post_data['uid'];
					// $update_data['in_address']=$post_data['in_address'];
					$update_data['in_sn']=$post_data['in_sn'];
					$update_data['in_qty']=$post_data['in_qty'];
					$update_data['in_unit']=$post_data['in_unit'];
					$update_data['in_describtion']=$post_data['in_describtion'];
					$update_data['in_sku']=$post_data['in_sku'];
					$update_data['in_price']=$post_data['in_price'];
					$update_data['in_net_total']=$post_data['in_net_total'];
					$total=$post_data['in_price']+$tax_data[0]['commission']+$tax_data[0]['vat'];
					$update_data['in_port_total_amount']=$total;					
					$update_data['invoice_status']='Confirmed';
					$update_data['created_date']=date("Y-m-d h:i:s");
					$update_data['in_date']=date("Y-m-d");
					// $response=$this->custom_model->my_insert($insert_data,'quotation_invoice');
					$response=$this->custom_model->my_update($update_data,array('seller_id'=>$seller_id,'quotaion_id'=>$id),'quotation_invoice');

					$noti_data=array();
					$noti_data['noti_type']='invoice';
					$noti_data['message']='Your invoice request confirmed by seller';
					$noti_data['uid']=$is_request[0]['uid'];
					$noti_data['sid']=$seller_id;
					$noti_data['qut_msg_id']=$is_request[0]['id'];
					$noti_data['send_by']='seller';
					$noti_data['send_to']='user';
					$noti_data['created_date']=date("Y-m-d h:i:s");
					$this->custom_model->my_insert($noti_data,'inv_mesg_notification');

					if($response)
					{						
						$this->custom_model->my_update(array('quotation_status'=>'Confirmed'),array('id'=>$id),'send_quotation');
						echo json_encode(array('status'=>true,"message"=>($language == 'ar'? 'م إرسال طلب التسعيرة بنجاح':'Request send successfully'))); die;
					}else{
						echo json_encode(array('status'=>false,"message"=>($language == 'ar'? 'هناك خطأ ما':'Something wnet wrong'))); die;
					}
				}					
			}else{
				echo json_encode(array('status'=>false,"message"=>($language == 'ar'? 'معرف طلب غير صحيح':'Invalid request id'))); die;
			}			
		}
		
		$quotation_data = $this->custom_model->get_data_array("SELECT squ.* FROM send_quotation as squ INNER JOIN quotation_invoice as qoin ON squ.id=qoin.quotaion_id  WHERE qoin.seller_id='$seller_id' AND qoin.quotaion_id='$id'   ");
		

		$quotation_data=$this->get_quotaion_data($quotation_data);	

		$is_send = $this->custom_model->get_data_array("SELECT * FROM quotation_invoice WHERE quotaion_id='$id' AND seller_id='$seller_id' ");

		$unit_list_data = $this->custom_model->get_data_array("SELECT * FROM unit_list ORDER BY unit_name ASC ");
		// echo "<pre>";
		// print_r($quotation_data);
		// print_r($is_send);
		// die;	
		$this->mPageTitle = $err_msg1;
		$this->mViewData['quotation_data'] = $quotation_data;
		$this->mViewData['is_send'] = $is_send;
		$this->mViewData['tax_data'] = $tax_data;
		$this->mViewData['unit_list_data'] = $unit_list_data;
		$this->render('receive_quotation/create_invoice');
	}

	public function index($sqid='',$noti_id='')
	{	
		$language= $this->uri->segment(1);
		if($language=='en')
		{
			$err_msg1='Receive quotation listing';
		}else{			
			$err_msg1='تفاصيل الطلب';
		}
		// echo "<pre>";
		// print_r($this->mUser);
		// die;
		//old $seller_id=$this->mUser->id;
		$seller_id=$this->nmUser_id;


		// if(!empty($this->mUser->id) && $this->mUser->id!=1)
		// {
		// 	$seller_id=$this->mUser->id;
		// 	$sub_query=" WHERE seller_id='$seller_id'";
		// }else if($this->mUser->id){							
		// 	$seller_id=$this->mUser->id;
		// 	$sub_query=" WHERE seller_id='$seller_id'";
		// }else{
		// 	redirect();
		// }
		$sub_query="";
		if(!empty($sqid))
		{
			$sub_query=" AND squ.id='$sqid' ";
			$this->custom_model->my_update(array('is_seen'=>1),array('id'=>$noti_id,'is_seen'=>'0'),'inv_mesg_notification');
		}
		
		// $quotation_data = $this->custom_model->get_data_array("SELECT * FROM send_quotation  $sub_query Order BY id DESC  ");

		$quotation_data = $this->custom_model->get_data_array("SELECT squ.* FROM send_quotation as squ INNER JOIN quotation_invoice as qoin ON squ.id=qoin.quotaion_id  WHERE qoin.seller_id='$seller_id' $sub_query  ORDER BY squ.id DESC ");
		// echo $this->db->last_query();
		// die;

		$quotation_data=$this->get_quotaion_data($quotation_data);   
		// echo "<pre>";
		// print_r($quotation_data);
		// die;
		$this->mPageTitle = $err_msg1;
		$this->mViewData['quotation_data'] = $quotation_data;
		$this->render('receive_quotation/receive_quotation_listing');
	}

	public function receive_quotation_detail($id='')
	{
		$language= $this->uri->segment(1);
		if($language=='en')
		{
			$err_msg1='Receive Quotation Detail';			
		}else{
			$err_msg1='تلقي تفاصيل التسعيرة';			
		}

		//old if(!empty($this->mUser->id) && $this->mUser->id!=1)
		// {
		// 	$seller_id=$this->mUser->id;
		// 	$sub_query=" WHERE id='$id' AND seller_id='$seller_id'  ";
		// }else if($this->mUser->id){							
		// 	$seller_id=$this->mUser->id;
		// 	$sub_query=" WHERE id='$id' AND seller_id='$seller_id'  ";
		// }else{
		// 	redirect();
		// }old end

		if(!empty($this->nmUser_id))
		{
			$seller_id=$this->nmUser_id;
			$sub_query=" WHERE id='$id' AND seller_id='$seller_id' ";
		}else{
			redirect();
		}

		$quotation_data = $this->custom_model->get_data_array("SELECT squ.*,qoin.invoice_status,qoin.reject_message,qoin.in_id,qoin.is_view FROM send_quotation as squ INNER JOIN quotation_invoice as qoin ON squ.id=qoin.quotaion_id  WHERE qoin.seller_id='$seller_id' AND qoin.quotaion_id='$id'   ");

		// $quotation_data = $this->custom_model->get_data_array("SELECT * FROM send_quotation  $sub_query ");

		// echo $this->db->last_query();
		// die;

		if(!empty($quotation_data))
		{
			// $invoice_status = $this->custom_model->get_data_array("SELECT invoice_status,reject_message FROM quotation_invoice WHERE quotaion_id='$id' AND seller_id='$seller_id'  ");
			// if(!empty($invoice_status))
			// {
			// 	$quotation_data[0]['reject_message']=$invoice_status[0]['reject_message'];
			// }else{
			// 	$quotation_data[0]['reject_message']='';
			// }
			if($quotation_data[0]['is_view']==2)
			{
				$this->custom_model->my_update(array('is_view'=>'1'),array('in_id' => $quotation_data[0]['in_id']),'quotation_invoice');	
			}
		}

		$quotation_data=$this->get_quotaion_data($quotation_data); 
		// echo "<pre>";
		// print_r($quotation_data);
		// die; 		
		$this->mPageTitle = $err_msg1;
		$this->mViewData['quotation_data'] = $quotation_data;
		$this->render('receive_quotation/receive_quotation_detail');
	}

	public function get_quotaion_data($quotation_data)
	{
		if(!empty($quotation_data))
		{
			foreach ($quotation_data as $qd_key => $qd_val) 
			{
				$category_data = $this->custom_model->my_where('category',"id,display_name",array('id' =>$qd_val['category_id']));	

				$quotation_data[$qd_key]['category_name']=$category_data[0]['display_name'];
			
				$unit_data = $this->custom_model->my_where('unit_list',"id,unit_name",array('id' =>$qd_val['unit']));	

				$quotation_data[$qd_key]['unit_name']=$unit_data[0]['unit_name'];
			}
		}
		return $quotation_data;
	}

	public function reject_request()
	{
		$post_data=$this->input->post();
		$language= $this->uri->segment(1);
		if(!empty($post_data))
		{
			// echo "<pre>";
			// print_r($post_data);
			// die;
			if(isset($post_data['req_id']))
			{
				$req_id=$post_data['req_id'];
				$reject_message=$post_data['reject_message'];
				//old $seller_id=$this->mUser->id;
				$seller_id=$this->nmUser_id;
				// $is_request = $this->custom_model->get_data_array("SELECT * FROM `send_quotation` WHERE seller_id = '$seller_id'  AND id='$req_id'");
				$is_request = $this->custom_model->get_data_array("SELECT squ.id,squ.quotation_status,qoin.invoice_status,squ.uid FROM send_quotation as squ INNER JOIN quotation_invoice as qoin ON squ.id=qoin.quotaion_id  WHERE qoin.seller_id='$seller_id' AND qoin.quotaion_id='$req_id'   ");
				// echo '<pre>';
				// print_r($is_request);
				// die;
				if(!empty($is_request))
				{
					if($is_request[0]['quotation_status']=='Cancelled')
					{
						echo json_encode(array('status'=>false,"message"=>"You Can't Reject Request already cancelled")); die;
					}
					if($is_request[0]['invoice_status']=='Rejected')
					{
						echo json_encode(array('status'=>false,"message"=>"You already Rejected Request")); die;
					}

					$response=$this->custom_model->my_update(array('quotation_status'=>'Rejected'),array('id'=>$req_id),'send_quotation');

					if($response)
					{
						$noti_data=array();
						$noti_data['noti_type']='invoice';
						$noti_data['message']='Your invoice request rejected by seller';
						$noti_data['uid']=$is_request[0]['uid'];
						$noti_data['sid']=$seller_id;
						$noti_data['qut_msg_id']=$is_request[0]['id'];
						$noti_data['send_by']='seller';
						$noti_data['send_to']='user';
						$noti_data['created_date']=date("Y-m-d h:i:s");
						$this->custom_model->my_insert($noti_data,'inv_mesg_notification');

						$is_invoice = $this->custom_model->get_data_array("SELECT * FROM `quotation_invoice` WHERE seller_id = '$seller_id'  AND quotaion_id='$req_id'");
						
						$response=$this->custom_model->my_update(array('invoice_status'=>'Rejected','reject_message'=>$reject_message),array('quotaion_id'=>$req_id,'seller_id'=>$seller_id),'quotation_invoice');
												
						echo json_encode(array('status'=>true,"message"=>"Request Rejected successfully")); die;
					}else{
						echo json_encode(array('status'=>false,"message"=>($language == 'ar'? 'هناك خطأ ما':'Something went wrong'))); die;
					}
				}else{
					echo json_encode(array('status'=>false,"message"=>($language == 'ar'? 'معرّف الطلب غير صحيح':'Invalid request id'))); die;		
				}
			}else{
				echo json_encode(array('status'=>false,"message"=>($language == 'ar'? 'هناك خطأ ما':'Something went wrong'))); die;	
			}			
		}else{
			echo json_encode(array('status'=>false,"message"=>($language == 'ar'? 'هناك خطأ ما':'Something went wrong'))); die;
		}
	}
	
}
