<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pcustomize extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
		$this->load->model('custom_model');
		$this->load->model('category_model');
	}

	public function index()
	{
		
		$post_data=$this->input->post();
		if(!empty($post_data))
		{
			// echo "<pre>";
			// print_r($post_data);
			// die;
			$pcustomize_title['title']=$post_data['title'];
			$pcustomize_title['type']=$post_data['type'];
			$pcustomize_title['status']=$post_data['status'];
			if(isset($post_data['add_limit']))
			{
				$pcustomize_title['add_limit']=$post_data['add_limit'];
			}

			$is_data = $this->custom_model->my_where('pcustomize_title','*',array('title' => $post_data['title'],'delete_status'=>'0','type'=>$pcustomize_title['type']));
			if(empty($is_data))
			{
				$last_id=$this->custom_model->my_insert($pcustomize_title,'pcustomize_title');				
				if(!empty($post_data['name']))
				{
					foreach ($post_data['name'] as $key => $value) 
					{					
						$pcustomize_att['pcus_id']=$last_id;
						$pcustomize_att['name']=$post_data['name'][$key];
						// this for only checkbox paid
						if($pcustomize_title['type']==3)
						{
							$pcustomize_att['price']=$post_data['price'][$key];
							// $pcustomize_att['price_ad']=$post_data['price_ad'][$key];	
						}
						$this->custom_model->my_insert($pcustomize_att,'pcustomize_attribute');
					}
				}else{
					// please select attribute
					$this->custom_model->my_delete(array('id' => $last_id),'pcustomize_title');
					echo "att_error";
					die;
				}
		}else{
			// already exist
			echo 'already';
			die;
		}
			echo 1;
			die;	
		}
		// die;
		// $this->mViewData['edit'] = $metadata[0];
		$this->mPageTitle = 'Customize Prouct';		
		$this->render('pcustomize/create');
	}

	public function list()
	{
		$pcustomize = $this->custom_model->my_where('pcustomize_title','*',array('delete_status'=>'0'));
		if(!empty($pcustomize))
		{
			foreach ($pcustomize as $pcus_key => $pcus_val)
			 {
				$pcustomize_attr = $this->custom_model->my_where('pcustomize_attribute','*',array('pcus_id'=>$pcus_val['id'],'delete_status'=>'0'));
				if(!empty($pcustomize_attr))
				{
					$pcustomize[$pcus_key]['pcustomize_attr']=$pcustomize_attr;
				}
			}
		}
		// echo '<pre>';
		// print_r($pcustomize);
		// die;
		$this->mViewData['pcustomize']= $pcustomize;
		$this->mPageTitle = 'Customize list Prouct';		
		$this->render('pcustomize/list');	
	}

	public function edit($id='')
	{
		$post_data=$this->input->post();
		if(!empty($post_data))
		{					
			$pcustomize_title['title']=$post_data['title'];
			// $pcustomize_title['type']=$post_data['type'];
			$pcustomize_title['status']=$post_data['status'];
			if(isset($post_data['add_limit']))
			{
				$pcustomize_title['add_limit']=$post_data['add_limit'];
			}
			// echo "<pre>";
			// print_r($post_data);
			// die;

			$is_data = $this->custom_model->my_where('pcustomize_title','*',array('title' => $post_data['title'],'id!='=>$id,'delete_status'=>'0'));
			if(empty($is_data))
			{			
				$this->custom_model->my_update($pcustomize_title,array('id' => $id),'pcustomize_title');			

				if(!empty($post_data['name']))
				{
					$att_id_count=count($post_data['a_id'])-1;
					// print_r($att_id_count);

					// $this->custom_model->my_delete(array('pcus_id' => $id),'pcustomize_attribute');
					$i=1;
					foreach ($post_data['name'] as $key => $value) 
					{					
						// $pcustomize_att['pcus_id']=$id;
						$pcustomize_att['name']=$post_data['name'][$key];
						if($post_data['type']=='3')
						{
							$pcustomize_att['price']=$post_data['price'][$key];
							// $pcustomize_att['price_ad']=$post_data['price_ad'][$key];
						}
						if($key<=$att_id_count)
						{
							$a_id=$post_data['a_id'][$key];
							// echo "<pre>";
							// echo $a_id;
							// print_r($pcustomize_att);
							// die;

							$this->custom_model->my_update($pcustomize_att,array('id' => $a_id),'pcustomize_attribute');
							// echo $this->db->last_query();
							// die;

						}else{
							$pcustomize_att['pcus_id']=$id;

							$this->custom_model->my_insert($pcustomize_att,'pcustomize_attribute');							
						}						
					}
				}else{
					// 					
					echo ltrim('att_error');
					die;
				}
			}else{
				// already exist
				echo 'already';
				die;
			}
			echo 1;
			die;
		}

		if(!empty($id))
		{
			$pcustomize_data = $this->custom_model->my_where('pcustomize_title','*',array('id'=>$id,'delete_status'=>'0'));
			if(!empty($pcustomize_data))
			{
				$pcustomize_attr = $this->custom_model->my_where('pcustomize_attribute','*',array('pcus_id'=>$pcustomize_data[0]['id'],'delete_status'=>'0'));
				if(!empty($pcustomize_attr))
				{
					$pcustomize_data[0]['pcustomize_attr']=$pcustomize_attr;
				}
				// echo '<pre>';
				// print_r($pcustomize_data);
				// die;
				$this->mViewData['pcustomize_data']= $pcustomize_data;				
				$this->mPageTitle = 'Customize Edit Prouct';		
				$this->render('pcustomize/edit');	

			}else{
				// no record found
				redirect('/admin/pcustomize/list');
			}
		}else{
			// direct access not allow
			redirect('/admin');
		}
	}

	 public function detete_pro()
    {
    	$post_data=$this->input->post();
    	if(!empty($post_data))
    	{
    		$pid=$post_data['pid'];
    		$this->custom_model->my_update(array("delete_status" => '1','status'=>'0'),array('id' => $pid),'pcustomize_title');
    		$this->custom_model->my_update(array('delete_status'=>'1'),array('pcus_id' => $pid),'pcustomize_attribute');
    		echo 1;
    		die;
    	}else {
    		echo 0;
    		die;
    	}
    }

     public function detete_pcustomize()
    {
    	$post_data=$this->input->post();
    	if(!empty($post_data))
    	{
    		$pid=$post_data['pid'];    		    		
    		$this->custom_model->my_update(array("delete_status" => '1'),array('id' => $pid),'pcustomize_attribute');	
    		echo 1;
    		die;
    	}else {
    		echo 0;
    		die;
    	}
    }


    public function edit2($id='')
	{
		$post_data=$this->input->post();
		if(!empty($post_data))
		{					
			$pcustomize_title['title']=$post_data['title'];
			// $pcustomize_title['type']=$post_data['type'];
			$pcustomize_title['status']=$post_data['status'];
			if(isset($post_data['add_limit']))
			{
				$pcustomize_title['add_limit']=$post_data['add_limit'];
			}
			// echo "<pre>";
			// print_r($post_data);
			// die;

			$is_data = $this->custom_model->my_where('pcustomize_title','*',array('title' => $post_data['title'],'id!='=>$id,'delete_status'=>'0'));
			if(empty($is_data))
			{			
				$this->custom_model->my_update($pcustomize_title,array('id' => $id),'pcustomize_title');			

				if(!empty($post_data['name']) && !empty($post_data['price_bh']) && !empty($post_data['price']) && isset($post_data['price']) )
				{
					$att_id_count=count($post_data['a_id'])-1;
					// $this->custom_model->my_delete(array('pcus_id' => $id),'pcustomize_attribute');
					$i=1;
					foreach ($post_data['price_bh'] as $key => $value) 
					{					
						// $pcustomize_att['pcus_id']=$id;
						$pcustomize_att['name']=$post_data['name'][$key];
						$pcustomize_att['price']=$post_data['price'][$key];
						if($key<=$att_id_count)
						{
							$a_id=$post_data['a_id'][$key];
						$this->custom_model->my_update($pcustomize_att,array('id' => $a_id),'pcustomize_attribute');

						}else{
							$pcustomize_att['pcus_id']=$id;
						$this->custom_model->my_insert($pcustomize_att,'pcustomize_attribute');							
						}						
					}
				}else{
					// 					
					echo ltrim('att_error');
					die;
				}
			}else{
				// already exist
				echo 'already';
				die;
			}
			echo 1;
			die;
		}

		if(!empty($id))
		{
			$pcustomize_data = $this->custom_model->my_where('pcustomize_title','*',array('id'=>$id));
			if(!empty($pcustomize_data))
			{
				$pcustomize_attr = $this->custom_model->my_where('pcustomize_attribute','*',array('pcus_id'=>$pcustomize_data[0]['id'],'delete_status'=>'0'));
				if(!empty($pcustomize_attr))
				{
					$pcustomize_data[0]['pcustomize_attr']=$pcustomize_attr;
				}
				// echo '<pre>';
				// print_r($pcustomize_data);
				// die;
				$this->mViewData['pcustomize_data']= $pcustomize_data;				
				$this->mPageTitle = 'Customize Edit Prouct';		
				$this->render('pcustomize/edit');	

			}else{
				// no record found
				redirect('/admin');
			}
		}else{
			// direct access not allow
			redirect('/admin');
		}
	}

}
?>	