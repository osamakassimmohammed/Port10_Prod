<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home page
 */
class Chat extends MY_Controller {

	public function __construct()
	{
		$this->load->model('User_model');
		$this->load->model('admin/Custom_model','custom_model');
	}

	public function index($compose_id='',$noti_id='')
	{
		$uid = $this->session->userdata('uid');
		if(empty($uid))
		{
			redirect("home");
		}
		$user_data=$this->custom_model->get_data_array("SELECT id,active,logo,is_terminate FROM `admin_users` WHERE `id`='$uid'  ");
		// date('Y-m-d h:i:s A', time(), date('Y-m-d h:i:s A', time());
		if(!empty($user_data))
		{

			if($user_data[0]['active']==0 || $user_data[0]['is_terminate']==1 )
			{
				$user_data[0]['status']=false;				
				$user_data[0]['compose_data']='';
				
			}else{
				$sub_query='';
				if(!empty($compose_id) && !empty($noti_id) )
				{
					$this->custom_model->my_update(array('is_seen'=>1),array('qut_msg_id'=>$compose_id,'is_seen'=>'0'),'inv_mesg_notification');
					$sub_query=" AND id='$compose_id' ";
				}
				$user_data[0]['status']=true;
				$compose_data=$this->custom_model->get_data_array("SELECT * FROM `chat_compose` WHERE (`cuser_id`='$uid' OR `creceiver_id`='$uid') AND `status`='1' $sub_query GROUP BY id ");
				
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
						$compose_data[$comd_key]['usid']=$usid;

						$compose_id=$comd_val['id'];

						$chat_data=$this->custom_model->get_data_array("SELECT * FROM `chat` WHERE (`sender_id`='$uid' OR `receiver_id`='$uid' ) AND `compose_id`='$compose_id' order by id ASC "); 

						$compose_data[$comd_key]['chat_data']=$chat_data;
					
					}
				}
				// $compose_data = $this->custom_model->get_data_array("SELECT admin.first_name,admin.logo,admin.active,compose.* FROM admin_users as admin INNER JOIN chat_compose as compose ON admin.id=compose.cuser_id WHERE (compose.cuser_id='$uid' OR compose.creceiver_id='$uid' ) AND compose.status='1'  ");

				$user_data[0]['compose_data']=$compose_data;
			}
		}

		$supplier_ids=$this->custom_model->get_data_array("SELECT id,first_name FROM `admin_users` WHERE id!='$uid' AND type='suppler' AND active='1' AND subs_status!='expired' AND is_terminate='0' ");

		// echo "<pre>";
		// print_r($user_data);
		// die;
		

		$this->mViewData['user_data']= $user_data;
		$this->mViewData['supplier_ids']= $supplier_ids;
        $this->Urender('chat/chat_listing', 'udefault');
	}

	public function old_index()
	{
		$uid = $this->session->userdata('uid');
		if(empty($uid))
		{
			redirect("home");
		}
		$user_data=$this->custom_model->get_data_array("SELECT id,active FROM `admin_users` WHERE `id`='$uid'  ");
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
		// print_r($supplier_ids);
		// die;

		$this->mViewData['user_data']= $user_data;
		$this->mViewData['supplier_ids']= $supplier_ids;
        $this->Urender('chat_listing', 'udefault');
	}

	public function detail($compose_id='',$noti_id='')
	{
		$uid = $this->session->userdata('uid');
		if(empty($uid))
		{
			redirect("home");
		}
		$user_data=$this->custom_model->get_data_array("SELECT id,active FROM `admin_users` WHERE `id`='$uid'  ");
		if(!empty($user_data))
		{
			if($user_data[0]['active']==1)
			{
				$user_data[0]['status']=true;
				$compose_data=$this->custom_model->get_data_array("SELECT * FROM `chat_compose` WHERE (`cuser_id`='$uid' OR `creceiver_id`='$uid') AND `status`='1' AND `id`='$compose_id' ");

				if(!empty($compose_data))
				{
					if(!empty($compose_id) && !empty($noti_id) )
					{
						$this->custom_model->my_update(array('is_seen'=>1),array('qut_msg_id'=>$compose_id,'is_seen'=>'0'),'inv_mesg_notification');
					}
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
					}
				}
				// $compose_data = $this->custom_model->get_data_array("SELECT admin.first_name,admin.logo,admin.active,compose.* FROM admin_users as admin INNER JOIN chat_compose as compose ON admin.id=compose.cuser_id WHERE (compose.cuser_id='$uid' OR compose.creceiver_id='$uid' ) AND compose.status='1' AND compose.id='$compose_id'  ");

				$user_data[0]['compose_data']=$compose_data;
				if(!empty($compose_data))
				{
					// $chat_data=$this->custom_model->get_data_array("SELECT * FROM `chat` WHERE `user_id`='$uid' AND `compose_id`='$compose_id' AND `is_delete`='0' ORDER BY id DESC  ");

					$chat_data=$this->custom_model->get_data_array("SELECT * FROM `chat` WHERE (`sender_id`='$uid' OR `receiver_id`='$uid' ) AND `compose_id`='$compose_id' order by id ASC "); 
					// AND user_id!='$uid'
					 // GROUP BY `sender_id`,`receiver_id` 
					$user_data[0]['chat_data']=$chat_data;
				}else{
					$user_data[0]['chat_data']='';
				}
			}else{
				$user_data[0]['status']=false;				
				$user_data[0]['compose_data']='';
			}
		}
		// echo "<pre>";
		// print_r($user_data);
		// die;
		$this->mViewData['user_data']= $user_data;
		$this->mViewData['compose_id']= $compose_id;
        $this->Urender('chat_detail', 'udefault');
	}

	public function compose_data()
	{
		$post_data=$this->input->post();
		$uid = $this->session->userdata('uid');
		$language= $this->uri->segment(1);
		if(!empty($uid)) 
		{
			if(!empty($post_data))
			{
				// echo "<pre>";
				// print_r($post_data);
				// die;
				if(isset($post_data['seller_id']) && isset($post_data['subject']) && isset($post_data['message']) )
				{
					if(!empty($post_data['seller_id']) && !empty($post_data['subject']) && !empty($post_data['message']) )
					{
						$post_data['seller_id']=en_de_crypt($post_data['seller_id'],'d');
						$is_seller = $this->custom_model->my_where("admin_users","id,logo,first_name",array('id'=>$post_data['seller_id'],'type!='=>'buyer'));
						if(!empty($is_seller))
						{
							$insert_data=array();							
							if($uid!=$post_data['seller_id'])
							{
								date_default_timezone_set('Asia/Riyadh');
								
								$created_date = date('Y-m-d h:i:s A', time());
								$insert_data['cuser_id']=$uid;
								$insert_data['csender_id']=$uid;
								$insert_data['creceiver_id']=$post_data['seller_id'];
								$insert_data['subject']=$post_data['subject'];
								$insert_data['compose_message']=$post_data['message'];
								$insert_data['status']=1;
								$insert_data['ccreated_date']=$created_date;
								$compose_id=$this->custom_model->my_insert($insert_data,'chat_compose');
								if($compose_id)
								{
									$insert_data['compose_id']=$compose_id;
									$insert_data['seller_name']=$is_seller[0]['first_name'];
									$html_tag=$this->append_compose($insert_data);
									$insert_data=array();
									$insert_data['compose_id']=$compose_id;
									$insert_data['user_id']=$uid;
									$insert_data['sender_id']=$uid;
									$insert_data['receiver_id']=$post_data['seller_id'];		
									$insert_data['message']=$post_data['message'];
									$insert_data['created_date']=$created_date;
									$insert_data['message_type']='text';
									$this->custom_model->my_insert($insert_data,'chat');

									$noti_data=array();
									$noti_data['noti_type']='chat';
									$noti_data['message']=$post_data['subject'].'<br>'.trim($post_data['message']);
									$noti_data['uid']=$uid;
									$noti_data['sid']=$post_data['seller_id'];
									$noti_data['qut_msg_id']=$compose_id;
									$noti_data['send_by']='user';
									if($post_data['seller_id']==1)
									{
										$noti_data['send_to']='admin';
									}else{
										$noti_data['send_to']='seller';
									}
									date_default_timezone_set('Asia/Riyadh');
									$noti_data['created_date']=date('Y-m-d h:i:s A', time());
									$this->custom_model->my_insert($noti_data,'inv_mesg_notification');	

									echo json_encode(array("status"=>true,"message"=>($language == 'ar'? 'تم إرسال الرسالة بنجاح':'Message sent successfully'),'data'=>$html_tag)); die;
								}else{
									echo json_encode(array("status"=>false,"message"=>($language == 'ar'? 'ناك خطأ ما':'Something went wrong'))); die;
								}
							}else{
								echo json_encode(array("status"=>false,"message"=>($language == 'ar'? "لا يمكنك إنشاء رسالة لنفسك":"You can't compose message to your self"))); die;
							}
						}else{
							echo json_encode(array("status"=>false,"message"=>($language == 'ar'? "معرف البائع غير صحيح":"Invalid seller id"))); die;
						}					
					}else{
						echo json_encode(array("status"=>false,"message"=>($language == 'ar'? "ل الحقول مطلوبة":"All field required"))); die;	
					}
				}else{
					echo json_encode(array("status"=>false,"message"=>($language == 'ar'? "ل الحقول مطلوبة":"All field required"))); die;
				}
			}else{
				echo json_encode(array("status"=>false,"message"=>($language == 'ar'? 'ناك خطأ ما':'Something went wrong'))); die;
			}
		}else{
			echo json_encode(array("status"=>false,"message"=>($language == 'ar'? "الرجاء تسجيل دخول":"Please login"))); die;
		}		
	}

	public function append_compose($insert_data)
	{
		$logo=base_url('assets/admin/usersdata/user-profile.png');
		$html_tag='';
		$html_tag.='<a href="'.base_url('chat/detail/').$insert_data['compose_id'].'" class="chat_list" id="compose'.$insert_data['compose_id'].'">
                        <div class="chat_people">
                           <div class="chat_img"> <img src="'.$logo.'" alt="sunil"> </div>
                           <div class="chat_ib">
                              <h5>'.$insert_data['seller_name'].' <span class="chat_date">'.date('M d' ,strtotime($insert_data['ccreated_date'])).'</span></h5>
                              <div class="subject_wrp">
                                 <div class="subject_titl"> Subject <span>:</span></div>
                                 <div class="subject_text">'.$insert_data['subject'].' 
                                 </div>
                                 <div class="clear"></div>
                              </div>
                              <div class="clear"></div>
                              <div class="subject_wrp">
                                 <div class="subject_titl"> Message <span>:</span> </div>
                                 <div class="subject_text">'.$insert_data['compose_message'].'
                                 </div>
                                 <div class="clear"></div>
                              </div>                              
                           </div>
                        </div>
                     </a>';
        return  $html_tag; 
	}

	public function user_chat()
	{
		$uid = $this->session->userdata('uid');
		$language= $this->uri->segment(1);
		if(empty($uid))
		{
			echo json_encode(array('status'=>false,'message'=>"Please login"));
			die;
		}
		$post_data=$this->input->post();
		if(!empty($post_data))
		{			
			$id=$post_data['compose_id'];
			$is_compose = $this->custom_model->get_data_array(" SELECT id FROM `chat_compose` WHERE (`cuser_id`='$uid' OR `creceiver_id`='$uid' ) AND `id`='$id' AND `status`=1  ");

			// $is_compose = $this->custom_model->my_where('chat_compose','id',array('cuser_id' => $uid,'id'=>$post_data['compose_id'],'creceiver_id'=>$post_data['creceiver'],'status'=>1));
			if(!empty($is_compose))
			{
				$insert_data['compose_id']=$post_data['compose_id'];
				$insert_data['user_id']=$uid;
				$insert_data['sender_id']=$uid;
				$insert_data['receiver_id']=$post_data['creceiver'];	
				if($post_data['message_type']=='text')
				{
					$post_data['message']=strip_tags($post_data['message']);
					$insert_data['message']=trim($post_data['message']);
					$noti_message=$insert_data['message'];
				}else{
					$noti_message="You received image";
					if(isset($_FILES['name']['name']) && $_FILES['name']['name']!='')
					{			
						$folder_name='admin/chat/';
						$logo = $this->uploads($_FILES['name'],$folder_name);
						if($logo!=false)
						{
							$insert_data['message']=$logo;
						}else{
							echo json_encode(array("status"=>false,"message"=>($language == 'ar'? 'يرجى تحديد صورة صالحة':'Please Select Valid Image'))); die;	
						}			
					}else{
						echo json_encode(array("status"=>false,"message"=>($language == 'ar'? 'يرجى تحديد صورة صالحة':'Please Select Valid Image'))); die;
					}
				}
				
				
				$insert_data['created_date']=date('Y-m-d h:i:s A', time());
				$insert_data['message_type']=$post_data['message_type'];
				$last_chat_id=$this->custom_model->my_insert($insert_data,'chat');
				$last_chat_data = $this->custom_model->my_where('chat','id,message,created_date,message_type',array('user_id' => $uid,'id'=>$last_chat_id));

				$noti_data=array();
				$noti_data['noti_type']='chat';
				$noti_data['message']=$noti_message;
				$noti_data['uid']=$uid;
				$noti_data['sid']=$post_data['creceiver'];
				$noti_data['qut_msg_id']=$post_data['compose_id'];
				$noti_data['send_by']='user';
				if($post_data['creceiver']==1)
				{
					$noti_data['send_to']='admin';
				}else{
					$noti_data['send_to']='seller';
				}
				$noti_data['created_date']=date('Y-m-d h:i:s A', time());
				$this->custom_model->my_insert($noti_data,'inv_mesg_notification');	

				if(!empty($last_chat_data))
				{
					$last_chat_data[0]['last_time']=date('h:i A' ,strtotime($last_chat_data[0]['created_date']));
					$last_chat_data[0]['last_mon_day']=date('M d' ,strtotime($last_chat_data[0]['created_date']));
					// echo json_encode($last_chat_data);			
					// die;
					echo json_encode(array('status'=>true,'message'=>$last_chat_data));
					die;
				}else{
					echo json_encode(array('status'=>false,'message'=>($language == 'ar'? 'ناك خطأ ما':'Something went wrong')));
					die;	
				}
			}else{
				echo json_encode(array('status'=>false,'message'=>"Invalid compose data"));
			die;	
			}
		}else{
			echo json_encode(array('status'=>false,'message'=>($language == 'ar'? 'ناك خطأ ما':'Something went wrong')));
			die;
		}
	}

	public function live_message()
	{
		$uid = $this->session->userdata('uid');
		if(empty($uid))
		{
			echo json_encode(array('status'=>false,'message'=>"Please_login"));
			die;
		}
		$post_data=$this->input->post();
		if(!empty($post_data))
		{			
			// $compose_id=$post_data['compose_id'];
			$last_id=$post_data['last_id'];
			// $chat_data=$this->custom_model->get_data_array("SELECT id,message,created_date FROM `chat` WHERE  `compose_id`='$compose_id' AND `id`>$last_id order by id ASC limit 10 ");
			$chat_data=$this->custom_model->get_data_array("SELECT id,message,created_date,compose_id,message_type,sender_id as seid,receiver_id as reid FROM `chat` WHERE  `id`>$last_id order by id ASC limit 15 ");
			// `user_id`='$uid' AND
			if(!empty($chat_data))
			{
				foreach ($chat_data as $key => $value) {
					$chat_data[$key]['last_time']=date('h:i' ,strtotime($value['created_date']));
					$chat_data[$key]['last_mon_day']=date('M d' ,strtotime($value['created_date']));
				}
				echo json_encode(array('status'=>true,'message'=>$chat_data));
				die;			
			}else{
				echo json_encode(array('status'=>false,'message'=>"something"));
				die;
			}				

		}
	}
}

?>	