<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home page
 */
class Chat extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
		$this->load->model('custom_model');	
		$this->get_access_id();		
	}

	public function index($compose_id='',$noti_id='')
	{
		$language= $this->uri->segment(1);
		if($language=='en')
		{
			$err_msg1='Messaging Listing';
		}else{			
			$err_msg1='قائمة المراسلة';
		}
		// $uid = $this->session->userdata('uid');
		// echo "<pre>";
		// print_r($this->mUser);
		// die;
		//old $seller_id = $this->mUser->id;
		// if(!empty($this->mUser) && empty($this->mUser->type) )
		// {
		// 	$seller_id=1;
		// }old end
		$seller_id = $this->nmUser_id;
		if(empty($seller_id))
		{
			redirect($language."/admin");
		}
		$user_data=$this->custom_model->get_data_array("SELECT id,active,logo,type FROM `admin_users` WHERE `id`='$seller_id'  ");
		if(!empty($user_data))
		{
			if($user_data[0]['type']=='suppler')
			{
				$user_data[0]['send_by']='seller';
			}else if ($user_data[0]['type']=='buyer')
			{
				$user_data[0]['send_by']='user';
			}else{
				$user_data[0]['send_by']='admin';
			}
			if($user_data[0]['active']==1)
			{
				$sub_query='';
				if(!empty($compose_id) && !empty($noti_id) )
				{
					$this->custom_model->my_update(array('is_seen'=>1),array('qut_msg_id'=>$compose_id,'is_seen'=>'0'),'inv_mesg_notification');
					$sub_query=" AND id='$compose_id' ";
				}
				$user_data[0]['status']=true;
				$compose_data=$this->custom_model->get_data_array("SELECT * FROM `chat_compose` WHERE (`cuser_id`='$seller_id' OR `creceiver_id`='$seller_id') AND `status`='1' $sub_query GROUP BY id ");
				if(!empty($compose_data))
				{
					foreach ($compose_data as $comd_key => $comd_val) 
					{	
						if($seller_id==$comd_val['cuser_id'])
						{
							$usid=$comd_val['creceiver_id'];
							$user_data2=$this->custom_model->get_data_array("SELECT first_name,logo,active,type FROM `admin_users` WHERE `id`='$usid'  ");
						}else{
							$usid=$comd_val['cuser_id'];
							$user_data2=$this->custom_model->get_data_array("SELECT first_name,logo,active,type FROM `admin_users` WHERE `id`='$usid'  ");
						}
						if($user_data2[0]['type']=='suppler')
						{							
							$compose_data[$comd_key]['send_to']='seller';
						}else if ($user_data2[0]['type']=='buyer')
						{							
							$compose_data[$comd_key]['send_to']='user';
						}else{							
							$compose_data[$comd_key]['send_to']='admin';
						}
						$compose_data[$comd_key]['first_name']=$user_data2[0]['first_name'];
						$compose_data[$comd_key]['logo']=$user_data2[0]['logo'];
						$compose_data[$comd_key]['active']=$user_data2[0]['active'];
						$compose_data[$comd_key]['usid']=$usid;
						
						$compose_id=$comd_val['id'];

						$chat_data=$this->custom_model->get_data_array("SELECT * FROM `chat` WHERE (`sender_id`='$seller_id' OR `receiver_id`='$seller_id' ) AND `compose_id`='$compose_id' order by id ASC "); 

						$compose_data[$comd_key]['chat_data']=$chat_data;
					}
				}
				// $compose_data = $this->custom_model->get_data_array("SELECT admin.first_name,admin.logo,admin.active,compose.* FROM admin_users as admin INNER JOIN chat_compose as compose ON admin.id=compose.cuser_id WHERE (compose.cuser_id='$seller_id' OR compose.creceiver_id='$seller_id' ) AND compose.status='1'  ");
			
				$user_data[0]['compose_data']=$compose_data;
			}else{
				$user_data[0]['status']=false;				
				$user_data[0]['compose_data']='';
			}
		}
		$all_user_data=$this->custom_model->get_data_array("SELECT id,first_name,active,type FROM `admin_users` WHERE `id`!='$seller_id' AND `active`='1' ORDER BY first_name ASC  ");

		if(!empty($all_user_data))
		{
			foreach ($all_user_data as $aud_key => $aud_val) 
			{
				if($aud_val['type']=='suppler')
				{
					$all_user_data[$aud_key]['send_to']='seller';
				}else{
					$all_user_data[$aud_key]['send_to']='user';
				}
			}
		}

		$append_option='';
		if($seller_id==1)
		{
			$append_option.='<option send_to="" value="all">All Customer</option>';
			$append_option.='<option send_to="" value="supplier">All Supplier</option>';
			$append_option.='<option send_to="" value="buyer">All Buyer</option>';
		}else{
			$append_option.='<option send_to="" value="1">Admin</option>';			
		}
		// echo "<pre>";
		// print_r($user_data);
		// print_r($all_user_data);
		// die;
		$this->mViewData['user_data']= $user_data;
		$this->mViewData['all_user_data']= $all_user_data;
		$this->mViewData['append_option']= $append_option;
		$this->mViewData['seller_id']= $seller_id;
		$this->mPageTitle = $err_msg1;	    
	    $this->render('chat/chat_listing');
	    // $this->render('chat/oldchat_listing');
        // $this->Urender('chat_listing', 'udefault');
	}

	public function detail($compose_id='',$noti_id='')
	{
		// $uid = $this->session->userdata('uid');
		//old $seller_id = $this->mUser->id;
		$seller_id = $this->nmUser_id;
		if(empty($seller_id))
		{
			redirect("admin");
		}
		$user_data=$this->custom_model->get_data_array("SELECT id,active,type FROM `admin_users` WHERE `id`='$seller_id'  ");
		if(!empty($user_data))
		{
			if($user_data[0]['type']=='suppler')
			{
				$user_data[0]['send_by']='seller';
			}else if ($user_data[0]['type']=='buyer')
			{
				$user_data[0]['send_by']='user';
			}else{
				$user_data[0]['send_by']='admin';
			}
			if($user_data[0]['active']==1)
			{
				$user_data[0]['status']=true;
				$compose_data=$this->custom_model->get_data_array("SELECT * FROM `chat_compose` WHERE (`cuser_id`='$seller_id' OR `creceiver_id`='$seller_id') AND `status`='1' AND `id`='$compose_id' ");

				if(!empty($compose_data))
				{
					if(!empty($compose_id) && !empty($noti_id) )
					{
						$this->custom_model->my_update(array('is_seen'=>1),array('qut_msg_id'=>$compose_id,'is_seen'=>'0'),'inv_mesg_notification');
					}
					foreach ($compose_data as $comd_key => $comd_val) 
					{	
						if($seller_id==$comd_val['cuser_id'])
						{
							$usid=$comd_val['creceiver_id'];
							$user_data2=$this->custom_model->get_data_array("SELECT first_name,logo,active,type FROM `admin_users` WHERE `id`='$usid'  ");
						}else{
							$usid=$comd_val['cuser_id'];
							$user_data2=$this->custom_model->get_data_array("SELECT first_name,logo,active,type FROM `admin_users` WHERE `id`='$usid'  ");
						}
						if($user_data2[0]['type']=='suppler')
						{
							$user_data[0]['send_to']='seller';
						}else if ($user_data2[0]['type']=='buyer')
						{
							$user_data[0]['send_to']='user';
						}else{
							$user_data[0]['send_to']='admin';
						}
						$compose_data[$comd_key]['first_name']=$user_data2[0]['first_name'];
						$compose_data[$comd_key]['logo']=$user_data2[0]['logo'];
						$compose_data[$comd_key]['active']=$user_data2[0]['active'];
					}
				}				
				$user_data[0]['compose_data']=$compose_data;
				if(!empty($compose_data))
				{
					// $chat_data=$this->custom_model->get_data_array("SELECT * FROM `chat` WHERE `user_id`='$uid' AND `compose_id`='$compose_id' AND `is_delete`='0' ORDER BY id DESC  ");

					// $chat_data=$this->custom_model->get_data_array("SELECT * FROM `chat` WHERE (`sender_id`='$seller_id' OR `receiver_id`='$seller_id' ) AND `compose_id`='$compose_id' order by id ASC "); 
					$chat_data=$this->custom_model->get_data_array("SELECT * FROM `chat` WHERE  `compose_id`='$compose_id' order by id ASC "); 

					// 	echo "<pre>";
					// print_r($chat_data);
					// die;
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
        $this->mPageTitle = 'Messaging Detail';	    
	    $this->render('chat/chat_detail');
	}

	public function compose_data()
	{
		$post_data=$this->input->post();
		$language= $this->uri->segment(1);
		// $uid = $this->session->userdata('uid');
		//old $seller_id = $this->mUser->id;
		// if(!empty($this->mUser) && empty($this->mUser->type) )
		// {
		// 	$seller_id=1;
		// }old
		$seller_id = $this->nmUser_id;
		
		if(!empty($seller_id)) 
		{
			if(!empty($post_data))
			{
				if(isset($post_data['user_id']) && isset($post_data['subject']) && isset($post_data['message']) )
				{
					if(!empty($post_data['user_id']) && !empty($post_data['subject']) && !empty($post_data['message']) )
					{
						if($post_data['user_id']=='all' || $post_data['user_id']=='supplier' || $post_data['user_id']=='buyer'  )
						{
							$this->compose_to_all($post_data);
							die;
						}
						$is_seller = $this->custom_model->my_where("admin_users","id,logo,first_name",array('id'=>$post_data['user_id']));
						if(!empty($is_seller))
						{
							$insert_data=array();
							if($seller_id!=$post_data['user_id'])
							{

								$created_date=date("Y-m-d h:i:s");
								$insert_data['cuser_id']=$seller_id;
								$insert_data['csender_id']=$seller_id;
								$insert_data['creceiver_id']=$post_data['user_id'];
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
									$insert_data['user_id']=$seller_id;
									$insert_data['sender_id']=$seller_id;
									$insert_data['receiver_id']=$post_data['user_id'];		
									$insert_data['message']=$post_data['message'];
									$insert_data['created_date']=$created_date;
									$insert_data['message_type']='text';
									$this->custom_model->my_insert($insert_data,'chat');

									$noti_data=array();
									$noti_data['noti_type']='chat';
									$noti_data['message']=$post_data['subject'].'<br>'.trim($post_data['message']);
									$noti_data['created_date']=date("Y-m-d h:i:s");
									$noti_data['qut_msg_id']=$compose_id;

									if($post_data['user_id']==1)
									{
										$noti_data['uid']=$post_data['user_id'];
										$noti_data['sid']=$seller_id;
										$noti_data['send_by']='seller';
										$noti_data['send_to']='admin';					
									}else{
										$noti_data['send_by']='admin';
										$noti_data['send_to']=$post_data['send_to'];
										if($post_data['send_to']=='user')
										{
											$noti_data['uid']=$post_data['user_id'];
											$noti_data['sid']=$seller_id;
										}else{
											$noti_data['uid']=$seller_id;
											$noti_data['sid']=$post_data['user_id'];
										}
									}
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

	public function compose_to_all($post_data)
	{
		//old $seller_id = $this->mUser->id;
		// if(!empty($this->mUser) && empty($this->mUser->type) )
		// {
		// 	$seller_id=1;
		// }old end

		$seller_id = $this->nmUser_id;
		$language= $this->uri->segment(1);
		if($post_data['user_id']=='all')
		{
			$user_data = $this->custom_model->my_where("admin_users","id,type",array('id!='=>$seller_id));
		}else if($post_data['user_id']=='supplier')
		{
			$user_data = $this->custom_model->my_where("admin_users","id,type",array('type'=>"suppler"));
		}else{
			$user_data = $this->custom_model->my_where("admin_users","id,type",array('type'=>"buyer"));
		}

		if(!empty($user_data))
		{
			foreach ($user_data as $ud_key => $ud_val) 
			{
				$insert_data=array();
				$created_date=date("Y-m-d h:i:s");
				$insert_data['cuser_id']=$seller_id;
				$insert_data['csender_id']=$seller_id;
				$insert_data['creceiver_id']=$ud_val['id'];
				$insert_data['subject']=$post_data['subject'];
				$insert_data['compose_message']=$post_data['message'];
				$insert_data['status']=1;
				$insert_data['ccreated_date']=$created_date;
				$compose_id=$this->custom_model->my_insert($insert_data,'chat_compose');

				$insert_data=array();
				$insert_data['compose_id']=$compose_id;
				$insert_data['user_id']=$seller_id;
				$insert_data['sender_id']=$seller_id;
				$insert_data['receiver_id']=$ud_val['id'];		
				$insert_data['message']=$post_data['message'];
				$insert_data['created_date']=$created_date;
				$insert_data['message_type']='text';
				$this->custom_model->my_insert($insert_data,'chat');

				$noti_data=array();
				$noti_data['noti_type']='chat';
				$noti_data['message']=$post_data['subject'].'<br>'.trim($post_data['message']);
				$noti_data['qut_msg_id']=$compose_id;
				$noti_data['send_by']='admin';

				if($ud_val['type']=='suppler')
				{
					$noti_data['uid']=$seller_id;
					$noti_data['sid']=$ud_val['id'];
					$noti_data['send_to']='seller';
				}else{
					$noti_data['uid']=$ud_val['id'];
					$noti_data['sid']=$seller_id;
					$noti_data['send_to']='user';
				}				
				$noti_data['created_date']=date("Y-m-d h:i:s");
				$this->custom_model->my_insert($noti_data,'inv_mesg_notification');					
			}
			echo json_encode(array("status"=>true,"message"=>($language == 'ar'? 'تم إرسال الرسالة بنجاح':'Message sent successfully'),'data'=>'')); die;
		}else{
			echo json_encode(array("status"=>false,"message"=>($language == 'ar'? 'ناك خطأ ما':'Something went wrong'))); die;
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
		// $uid = $this->session->userdata('uid');
		$language= $this->uri->segment(1);
		//old $seller_id = $this->mUser->id;
		// if(!empty($this->mUser) && empty($this->mUser->type) )
		// {
		// 	$seller_id=1;
		// }old end
		$seller_id = $this->nmUser_id;
		if(empty($seller_id))
		{
			echo json_encode(array('status'=>false,'message'=>($language == 'ar'? 'الرجاء تسجيل دخول':'Please login')));
			die;
		}
		$post_data=$this->input->post();
		if(!empty($post_data))
		{
			// echo "<pre>";
			// print_r($post_data);
			// die;
			$id=$post_data['compose_id'];

			$is_compose = $this->custom_model->get_data_array(" SELECT id FROM `chat_compose` WHERE (`cuser_id`='$seller_id' OR `creceiver_id`='$seller_id' ) AND `id`='$id' AND `status`=1  ");
			// echo "<pre>";
			// print_r($is_compose);
			// die;
			// $is_compose = $this->custom_model->my_where('chat_compose','id',array('cuser_id' => $seller_id,'id'=>$post_data['compose_id'],'csender_id'=>$post_data['creceiver'],'status'=>1));

			if(!empty($is_compose))
			{
				$insert_data['compose_id']=$post_data['compose_id'];
				$insert_data['user_id']=$seller_id;
				$insert_data['sender_id']=$seller_id;
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
				$insert_data['created_date']=date("Y-m-d h:i:s");
				$insert_data['message_type']=$post_data['message_type'];
				$last_chat_id=$this->custom_model->my_insert($insert_data,'chat');
				$last_chat_data = $this->custom_model->my_where('chat','id,message,created_date',array('user_id' => $seller_id,'id'=>$last_chat_id));

				$noti_data=array();
				$noti_data['noti_type']='chat';
				$noti_data['message']=$noti_message;
				$noti_data['uid']=$post_data['creceiver'];
				$noti_data['sid']=$seller_id;
				$noti_data['qut_msg_id']=$post_data['compose_id'];
				$noti_data['send_by']=$post_data['send_by'];
				$noti_data['send_to']=$post_data['send_to'];				
				$noti_data['created_date']=date("Y-m-d h:i:s");
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
					echo json_encode(array('status'=>false,'message'=>($language == 'ar'? 'هناك خطأ ما':'Something went wrong')));
					die;	
				}
			}else{
				echo json_encode(array('status'=>false,'message'=>($language == 'ar'? 'Invalid compose data':'Invalid compose data')));
			die;	
			}
		}else{
			echo json_encode(array('status'=>false,'message'=>($language == 'ar'? 'هناك خطأ ما':'Something went wrong')));
			die;
		}
	}

	public function live_message()
	{
		// $uid = $this->session->userdata('uid');
		//old $uid = $this->mUser->id;
		$uid = $this->nmUser_id;
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
			// $chat_data=$this->custom_model->get_data_array("SELECT id,message,created_date FROM `chat` WHERE `compose_id`='$compose_id' order by id DESC limit 15 ");
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

	public function contact_request($rowno=0,$ajax='call',$serach='')
	{
		// $users_data = $this->custom_model->my_where('admin_users','*',array('id!=' =>'1'));		

		$this->load->library('pagination');  

   		$post_data = $this->input->post();

		if (!empty($post_data))
		{
			$rowno = $post_data['pagno'];
			$ajax 	= $post_data['ajax'];
			$serach = $post_data['serach'];
		}		
		 // Row per page
    	$rowperpage = 25;
    	$page_no=0;

    	// Row position
    	if($rowno != 0){
    		$page_no=$rowno;
      		$rowno = ($rowno-1) * $rowperpage;
    	}
    	if($ajax=='call')
		{
			$contact_request = $this->custom_model->get_data_array("SELECT * FROM contact_request Order BY id DESC limit $rowno,$rowperpage ");   

			$contact_request_count = $this->custom_model->get_data_array("SELECT id FROM contact_request Order BY id DESC  ");      				 			

   		}else 
   		{
			if(empty($serach))
			{
				$contact_request = $this->custom_model->get_data_array("SELECT * FROM contact_request Order BY id DESC limit $rowno,$rowperpage ");   
   				
   				$contact_request_count = $this->custom_model->get_data_array("SELECT id FROM contact_request Order BY id DESC  ");	

			}
			else {							

				$contact_request = $this->custom_model->get_data_array("SELECT * FROM contact_request WHERE first_name LIKE '%$serach%' OR last_name LIKE '%$serach%' OR email LIKE '%$serach%' OR phone LIKE '%$serach%' Order BY id DESC limit $rowno,$rowperpage ");   
   				
   				$contact_request_count = $this->custom_model->get_data_array("SELECT id FROM contact_request WHERE first_name LIKE '%$serach%' OR last_name LIKE '%$serach%' OR email LIKE '%$serach%' OR phone LIKE '%$serach%' Order BY id DESC  ");
						
			}
		}

		
		// echo "<pre>";
		// print_r($contact_request);
		// die;
		$config['base_url'] = base_url().'admin/car_listing/dealer';
	    $config['use_page_numbers'] = TRUE;
	    $config['total_rows'] = count($contact_request_count);
	    $config['per_page'] = $rowperpage;   
	    $config['page_query_string'] = FALSE;             
	    $config['enable_query_strings'] = FALSE;             
	    $config['reuse_query_string']  = FALSE;             
	    $config['cur_page'] = $page_no;  
	    
	     // Initialize
	    $this->pagination->initialize($config);
	     // Initialize $data Array
	    $data['pagination'] = $this->pagination->create_links();
	    $data['result'] = $contact_request;
	    $data['row'] = $rowno;
	    $data['total_rows'] = count($contact_request_count);
	    // $this->mViewData['pagination'] = $this->pagination->create_links();	
	    // this for when page load	     				
	    if($ajax =='call' && $rowno==0 && empty($post_data)){			    	
	    	$this->mViewData['pagination'] = $this->pagination->create_links();		     				
		}elseif($serach !='') {  // this for search button pagination
			echo json_encode($data);
 			exit;    				 
		}else { // this for pagination-
 			echo json_encode($data);
 			exit; 	
		}
		
		$this->mPageTitle = 'Contact Request' ;		
		$this->mViewData['contact_request'] = $contact_request;
		$this->render('chat/contact_request/list');
	}
}

?>	