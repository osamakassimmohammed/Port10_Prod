<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home page
 */
class New_chat extends MY_Controller {

	public function __construct()
	{
		$this->load->model('User_model');
		$this->load->model('admin/Custom_model','custom_model');
	}

	public function index()
	{
		$uid = $this->session->userdata('uid');
		if(empty($uid))
		{
			redirect("home");
		}
		$user_data=$this->custom_model->get_data_array("SELECT id,active,logo FROM `admin_users` WHERE `id`='$uid'  ");
		if(!empty($user_data))
		{
			if($user_data[0]['active']==1)
			{
				$user_data[0]['status']=true;
				$compose_data=$this->custom_model->get_data_array("SELECT * FROM `chat_compose` WHERE (`cuser_id`='$uid' OR `creceiver_id`='$uid') AND `status`='1' GROUP BY id ");
				if(!empty($compose_data))
				{
					foreach ($compose_data as $comd_key => $comd_val) 
					{	
						if($uid==$comd_val['cuser_id'])
						{
							$usid=$comd_val['creceiver_id'];
							$user_data2=$this->custom_model->get_data_array("SELECT first_name,logo,active FROM `admin_users` WHERE `id`='$usid'  ");
						}else{
							$usid=$comd_val['cuser_id'];
							$user_data2=$this->custom_model->get_data_array("SELECT first_name,logo,active FROM `admin_users` WHERE `id`='$usid'  ");
						}
						$compose_data[$comd_key]['first_name']=$user_data2[0]['first_name'];
						$compose_data[$comd_key]['logo']=$user_data2[0]['logo'];
						$compose_data[$comd_key]['active']=$user_data2[0]['active'];

						$compose_id=$comd_val['id'];

						$chat_data=$this->custom_model->get_data_array("SELECT * FROM `chat` WHERE (`sender_id`='$uid' OR `receiver_id`='$uid' ) AND `compose_id`='$compose_id' order by id ASC "); 

						$compose_data[$comd_key]['chat_data']=$chat_data;
					
					}
				}
				// $compose_data = $this->custom_model->get_data_array("SELECT admin.first_name,admin.logo,admin.active,compose.* FROM admin_users as admin INNER JOIN chat_compose as compose ON admin.id=compose.cuser_id WHERE (compose.cuser_id='$uid' OR compose.creceiver_id='$uid' ) AND compose.status='1'  ");

				$user_data[0]['compose_data']=$compose_data;
			}else{
				$user_data[0]['status']=false;				
				$user_data[0]['compose_data']='';
			}
		}

		$supplier_ids=$this->custom_model->get_data_array("SELECT id,first_name FROM `admin_users` WHERE id!='$uid' AND type='suppler' AND active='1' ");

		// echo "<pre>";
		// print_r($user_data);
		// die;
		

		$this->mViewData['user_data']= $user_data;
		$this->mViewData['supplier_ids']= $supplier_ids;
        $this->Urender('chat/chat_listing', 'udefault');
	}
}

?>	