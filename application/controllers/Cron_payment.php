<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home page
 */
class Cron_payment extends MY_Controller {

	public function __construct()
	{
		$this->load->model('User_model');
		$this->load->model('admin/Custom_model','custom_model');
	}

	public function index()
	{
		$this->check_sub_status();
		$this->trial_email();		
	}

	public function check_sub_status()
	{
		// $cron_test = $this->custom_model->my_where("cron_test",'id,cron_id',array('id'=>1));
		// 		$cron_id=$cron_test[0]['cron_id']+1;
		// 		$this->custom_model->my_update(array('cron_id'=>$cron_id),array('id' =>1),'cron_test');		
				
		$subs_data = $this->custom_model->get_data_array("SELECT id,subs_start_date,subs_end_date,subs_status FROM `admin_users` WHERE `subs_status`!='expired' AND `type`='suppler'   ");

		// echo "<pre>";
		// print_r($subs_data);
		// die;

		$current_data=strtotime(date("Y-m-d"));			
		if(!empty($subs_data))
		{
			foreach ($subs_data as $key => $value) 
			{
				$subs_end_date=strtotime( date ( $value['subs_end_date'] ) );					
				if($current_data > $subs_end_date)
				{										
					$update=$this->custom_model->my_update(array('subs_status' => 'expired','token'=> ''),array('id' => $value['id']),'admin_users');				
				}
			}		
		}
	}

	public function supplier_view()
	{
		$quotation_data = $this->custom_model->get_data_array("SELECT squ.deadline,qoin.in_id FROM send_quotation as squ INNER JOIN quotation_invoice as qoin ON squ.id=qoin.quotaion_id  WHERE qoin.is_view='0' AND qoin.invoice_status=''  ORDER BY squ.id DESC ");
		if(!empty($quotation_data))
		{
			foreach ($quotation_data as $qud_key => $qud_val) 
			{
				$deadline= date('Y-m-d', strtotime($qud_val['deadline'].'-1 day'));
				$deadline=strtotime($deadline);
				$current_data=strtotime(date('Y-m-d'));
				if($current_data>=$deadline)
				{
					$this->custom_model->my_update(array('is_view'=>'2'),array('in_id' => $qud_val['in_id']),'quotation_invoice');
				}
			}
		}
	}

	public function trial_email()
	{
		$subs_data = $this->custom_model->get_data_array("SELECT id,subs_start_date,subs_end_date,first_name,email FROM `admin_users` WHERE is_trial_email_send='0' AND type='suppler' AND  subs_status='trial' ");
		if(!empty($subs_data))
		{
			$this->load->library("email_template");
			$this->load->library("email_cilib");
			foreach ($subs_data as $sd_key => $sd_val) 
			{
				$end_date=date('Y-m-d', strtotime($sd_val['subs_end_date'].'-3 day'));
				$end_date=strtotime($end_date);
				$current_data=strtotime(date('Y-m-d'));
				if($current_data>=$end_date)
				{
					$subject = "Your free trial is ending in 3 days";					
					$message=$this->email_template->send_trial_email_en($sd_val['first_name']);
					$this->email_cilib->send_welcome($subs_data[0]['email'],$subject,$message);
					$this->custom_model->my_update(array('is_trial_email_send' =>1),array('id' => $sd_val['id']),'admin_users');	

				}
			}
		}
	}

}

?>

