<?php

/**
 * Base Controller for Admin module
 */
class Admin_Controller extends MY_Controller {

	protected $mUsefulLinks = array();

	// Grocery CRUD or Image CRUD
	protected $mCrud;
	protected $mCrudUnsetFields;
	protected $nmUser_id = NULL;

	// Constructor
	public function __construct()
	{
		parent::__construct();

		// only login users can access Admin Panel
		$group_id_n = $this->session->userdata('group_id');
		// change_admin
		if(!empty($group_id_n) && $group_id_n==9)
		{
			// redirect('home');
			$this->ion_auth->trigger_events('logout');			 
			$this->session->sess_destroy();
		}
		
		$this->verify_login();
		$this->is_subscribtion_expire();
		$this->is_sub_subsupplier();
		// store site config values
		// $this->mUsefulLinks = $this->mConfig['useful_links'];
		date_default_timezone_set('Asia/Kolkata');
	}	

	// Render template (override parent)
	protected function render($view_file, $layout = 'default')
	{
		// load skin according to user role
		$config = @$this->mConfig['adminlte'];
		$this->mBodyClass = $config['body_class'][$this->mUserMainGroup];

		// additional view data
		$this->mViewData['useful_links'] = $this->mUsefulLinks;

		$this->load->model('custom_model');
		// $admin_logo = $this->custom_model->my_where('admin_users','id,logo',array('id' => $this->mUser->id));
		$seller_id=$this->mUser->id;
		// $invlice_noti = $this->custom_model->get_data_array("SELECT squ.created_date,squ.id FROM send_quotation as squ INNER JOIN quotation_invoice as qoin ON squ.id=qoin.quotaion_id  WHERE qoin.is_view='2' AND qoin.seller_id='$seller_id'  ORDER BY squ.id ASC ");
		
		$noti_data=array();
	    if(!empty($this->mUser) )
	    {
	    	if($this->mUser->type=='suppler')
	    	{	    		
	    		$noti_data=$this->custom_model->get_data_array(" SELECT id,noti_type,message,qut_msg_id,noti_type,send_by,send_to FROM inv_mesg_notification WHERE send_to='seller' AND sid='$seller_id' AND is_seen='0' ORDER BY id DESC ");  			    		
	    	}else if($this->mUser->type=='subsupplier'){
	    		$seller_id=$this->mUser->seller_id;
	    		$noti_data=$this->custom_model->get_data_array(" SELECT id,noti_type,message,qut_msg_id,noti_type,send_by,send_to FROM inv_mesg_notification WHERE send_to='seller' AND sid='$seller_id' AND is_seen='0' ORDER BY id DESC ");  
	    	}else{
	    		$noti_data=$this->custom_model->get_data_array(" SELECT id,noti_type,message,qut_msg_id,noti_type,send_by,send_to FROM inv_mesg_notification WHERE send_to='admin' AND is_seen='0' ORDER BY id DESC ");  		 

	    	}
	    	if(!empty($noti_data))
    		{
    			foreach ($noti_data as $key => $val) 
    			{
    				if($val['noti_type']=='invoice')
    				{
    					if($val['send_by']=='user' && $val['send_to']=='admin')
    					{
    						$noti_data[$key]['link']=base_url($this->mLanguage.'/admin/assign_quotation/index/').$val['qut_msg_id'].'/'.$val['id'];
    					}else{
    						$noti_data[$key]['link']=base_url($this->mLanguage.'/admin/receive_quotation/index/').$val['qut_msg_id'].'/'.$val['id'];
    					}
    				}else{
    					$noti_data[$key]['link']=base_url($this->mLanguage.'/admin/chat/index/').$val['qut_msg_id'].'/'.$val['id'];
    				}
    			}
    		} 
	    }

		// $invlice_noti = $this->custom_model->my_where('quotation_invoice','in_id',array('seller_id' => $this->mUser->id));
		// echo "<pre>";
		// print_r($noti_data);
		// die;
		// $this->mViewData['admin_logo'] = $admin_logo;
		$this->mViewData['noti_data'] = $noti_data;


		parent::render($view_file, $layout);
	}

	// Initialize CRUD table via Grocery CRUD library
	// Reference: http://www.grocerycrud.com/
	protected function generate_crud($table, $subject = '')
	{
		// create CRUD object
		$this->load->library('Grocery_CRUD');
		$crud = new grocery_CRUD();
		$crud->set_table($table);
	 //	$crud->where("$table.store_type",STORE_TYPE);
		// auto-generate subject
		if ( empty($subject) )
		{
			$crud->set_subject(humanize(singular($table)));
		}

		// load settings from: application/config/grocery_crud.php
		$this->load->config('grocery_crud');
		$this->mCrudUnsetFields = $this->config->item('grocery_crud_unset_fields');

		if ($this->config->item('grocery_crud_unset_jquery'))
			$crud->unset_jquery();

		if ($this->config->item('grocery_crud_unset_jquery_ui'))
			$crud->unset_jquery_ui();

		if ($this->config->item('grocery_crud_unset_print'))
			$crud->unset_print();

		if ($this->config->item('grocery_crud_unset_export'))
			$crud->unset_export();

		if ($this->config->item('grocery_crud_unset_read'))
			$crud->unset_read();

		foreach ($this->config->item('grocery_crud_display_as') as $key => $value)
			$crud->display_as($key, $value);

		// other custom logic to be done outside
		$this->mCrud = $crud;
		return $crud;
	}
	
	// Set field(s) to color picker
	protected function set_crud_color_picker()
	{
		$args = func_get_args();
		if(isset($args[0]) && is_array($args[0]))
		{
			$args = $args[0];
		}
		foreach ($args as $field)
		{
			$this->mCrud->callback_field($field, array($this, 'callback_color_picker'));
		}
	}

	public function callback_color_picker($value = '', $primary_key = NULL, $field = NULL)
	{
		$name = $field->name;
		return "<input type='color' name='$name' value='$value' style='width:80px' />";
	}

	// Append additional fields to unset from CRUD
	protected function unset_crud_fields()
	{
		$args = func_get_args();
		if(isset($args[0]) && is_array($args[0]))
		{
			$args = $args[0];
		}
		$this->mCrudUnsetFields = array_merge($this->mCrudUnsetFields, $args);
	}

	// Initialize CRUD album via Image CRUD library
	// Reference: http://www.grocerycrud.com/image-crud
	protected function generate_image_crud($table, $url_field, $upload_path, $order_field = 'pos', $title_field = '')
	{
		// create CRUD object
		$this->load->library('Image_crud');
		$crud = new image_CRUD();
		$crud->set_table($table);
		$crud->set_url_field($url_field);
		$crud->set_image_path($upload_path);

		// [Optional] field name of image order (e.g. "pos")
		if ( !empty($order_field) )
		{
			$crud->set_ordering_field($order_field);
		}

		// [Optional] field name of image caption (e.g. "caption")
		if ( !empty($title_field) )
		{
			$crud->set_title_field($title_field);
		}

		// other custom logic to be done outside
		$this->mCrud = $crud;
		return $crud;
	}

	// Render CRUD
	protected function render_crud()
	{
		// logic specific for Grocery CRUD only
		$crud_obj_name = strtolower(get_class($this->mCrud));
		if ($crud_obj_name==='grocery_crud')
		{
			$this->mCrud->unset_fields($this->mCrudUnsetFields);	
		}

		// render CRUD
		$crud_data = $this->mCrud->render();

		// append scripts
		$this->add_stylesheet($crud_data->css_files, FALSE);
		$this->add_script($crud_data->js_files, TRUE, 'head');

		// display view
		$this->mViewData['crud_output'] = $crud_data->output;
		$this->render('crud');
	}

	// Render CRUD
	protected function render_img_crud()
	{
		// logic specific for Grocery CRUD only
		$crud_obj_name = strtolower(get_class($this->mCrud));
		
		// render CRUD
		$crud_data = $this->mCrud->render();

		// append scripts
		$this->add_stylesheet($crud_data->css_files, FALSE);
		$this->add_script($crud_data->js_files, TRUE, 'head');

		// display view
		return $crud_data->output;
		
	}

	protected function generate_slug($title,$table)
	{
		$this->load->model('custom_model');

		$slug = preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i', "-", strtolower($title)));

		$numHits = $this->custom_model->get_pre_slug($table,$slug);
		
		return ($numHits > 0) ? ($slug . '-' . $numHits) : $slug;
	}

	protected function is_admin($language)
	{
		if($this->session->userdata('group_id') == 1 || $this->session->userdata('group_id') == 2)
        {   
        }else{        	
        	redirect($language.'/admin');
        }
	}

	protected function is_sub_subsupplier()
	{
		$language= $this->uri->segment(1);
		
		if(!empty($this->mUser))
		{
			if($this->mUser->type=="subsupplier")
			{
				$is_access=array();
				$access_permission=$this->mUser->access_permission;
				if(!empty($access_permission))
				{
					$is_access=explode(",",$access_permission);								
				}
				array_push($is_access,"panel","dashbord",'invoice');

				if(!in_array($this->mCtrler, $is_access))
				{
					redirect($language.'/admin');
				}
			}
		}		
	}

	public function get_access_permission()
	{
		$permission_arr=array();
		$permission_arr['vorders']="Orders";
		$permission_arr['receive_quotation']="Quotation";
		$permission_arr['product']="Product";
		$permission_arr['chat']="Messages";
		$permission_arr['brand']="Brand";
		$permission_arr['buyer_account']="Buyer Account";
		return $permission_arr;
	}

	public function get_access_id()
	{
		// this function is used for to get main suer id
		if(!empty($this->mUser))
		{
			if($this->mUser->type=="suppler")
			{
				$this->nmUser_id =$this->mUser->id;
			}else if($this->mUser->type=="subsupplier")
			{
				$this->nmUser_id =$this->mUser->seller_id;	
			}else{
				if($this->mUser->id==1)
				{
					$this->nmUser_id =$this->mUser->id;					
				}else{
					$this->nmUser_id=1;
				}
			}			
		}
	}
}
