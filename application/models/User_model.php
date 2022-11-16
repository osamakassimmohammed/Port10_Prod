<?php 

class User_model extends MY_Model {


	function validate_user($user_name, $password,$table='admin_users',$group_id="9")
	{
		$this->db->select('id,username,password,first_name,last_name,email,phone,group_id,social,active,type,is_email_verify,subs_start_date,subs_end_date,subs_status,is_terminate,access_permission');
		$this->db->where('username', $user_name);
		$this->db->where('type !=','');
		// $this->db->where('group_id !=','');
		// if(!empty($group_id)) $this->db->where('group_id', $group_id);
		// $this->db->or_where('phone', $user_name);
		$re = $this->db->get($table)->result_array();
		// print_r($re);
		// die;
		// echo $this->db->last_query();
		// die;
		
		$data = 0;
		foreach ($re as $krey => $userdata) {
			if(!empty($userdata))
			{
				
				$pass_word = $userdata['password'];
				if ($userdata['active'] == 0) {
					$data = 11;
				}else if ($userdata['is_email_verify'] == 0) {
					$data = 12;
				}else if ($userdata['is_terminate'] == 1) {
					$data = 13;
				}
				elseif(password_verify ( $password ,$pass_word ))
				{
					// $data = array('firstname' => $firstname, 'uid' => $id, 'email' => $username, 'phone' => $phone,"last_name" => $last_name, "group_id" => $group_id);
					$userdata['uid'] = $userdata['id'];
				//	$userdata['logo_url'] = base_url("assets/admin/seller_img/").$userdata['logo'];
				//$userdata['banner_url'] = base_url("assets/admin/seller_img/").$userdata['banner'];
					unset($userdata['password']);
					unset($userdata['id']);
					return $userdata;
				}
				else{
					$data = 1;
				}
			}
			else{
				$data = 0;
			}	
		}	
		return $data;
	}	
	
	function create_member($new_member_insert_data)
	{
		$this->db->where('username', $new_member_insert_data['username']);
		$query = $this->db->get('admin_users')->result();

		if (!empty($new_member_insert_data['invite_code']))
		{
			$check = $this->custom_model->record_count('admin_users', ['own_refere_id' => $new_member_insert_data['invite_code']]);
			// print_r($check); die;
			if (empty($check))
			{
				return 'invite_code';
			}
		}

        if(!empty($query)){ 
        	return 'username';
		}else{
  			
			$this->db->where('phone', $new_member_insert_data['phone']);
			$query = $this->db->get('admin_users')->result();

	        if(!empty($query))
	        {
	        	return 'phone';
			}else
			{
				$this->db->where('email', $new_member_insert_data['email']);
				$query = $this->db->get('admin_users')->result();
				if(!empty($query))
				{
		        	return 'email';
				}else{
				$insert = $this->db->insert('admin_users', $new_member_insert_data);
				return $this->db->insert_id();
				}
			}
		}	      
	}

	function forget_password($username,$cr_number=''){
		$this->db->select('id,password,first_name,email,username,email');
		$this->db->where('username', $cr_number);
		$this->db->where('email', $username);
		// $this->db->or_where('phone', $username);
		// $this->db->or_where('email', $username);
		$q = $this->db->get('admin_users');
		$userdata = $q->row();
		if(!empty($userdata))
		{	$forgotten_password_code = uniqid();
			
			$this->db->where("id", $userdata->id);
			$this->db->update("admin_users",array("forgotten_password_code" => $forgotten_password_code));
			$userdata->forgotten_password_code = $forgotten_password_code;			
			return $userdata;
		}else{
			return false;
		}
	}
}