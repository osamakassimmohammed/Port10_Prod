<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attribute extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
		$this->load->model('custom_model');
		$this->load->model('category_model');
		if($this->session->userdata('group_id') != 1)
        {
            redirect('admin');
        }
	}

	// Frontend Category CRUD
	public function index()
	{
		$crud = $this->generate_crud('attribute_item');
		$crud->columns('id','item_name');
		// $crud->display_as('i_priority','Value');

		$crud->display_as('item_name','Color / Size Value');
		$crud->set_theme('datatables');
		//$crud->unset_operations();
		$crud->unset_edit();
		$crud->unset_add();

		$crud->add_action('edit', '', 'admin/attribute/edit', '');
		$crud->add_action('translate', '', 'admin/attribute/tedit', '');
		//$crud->add_action('delete', '', 'admin/attribute/delete', '');

		$this->mPageTitle = 'Attribute item';
		$this->render_crud();
	}

	// Create Frontend Category
	public function create()
	{
		$form = $this->form_builder->create_form();
		$post_data = $this->input->post();
		//print_r($post_data); die;
		if (!empty($post_data)) 
		{
			$aname = $post_data['name'];
			$aitem_priority = $post_data['item_priority'];
			// $id = $post_data['id'];
			foreach ($aname as $key => $aname) 
			{
				// $item_priority= $aitem_priority[$key];
				$result = array('name'=> $aname,'item_priority'=>$item_priority);
				//print_r($result);
				$count = $this->custom_model->record_count('attribute',array('name'=> $aname));
				//print_r($count);
				if ($count)
				{
					// failed
					$this->system_message->set_error('Attribute item Already present<br>Unable to Create Attribute item');
				}
				else
				{
					$response = $this->custom_model->my_insert( $result,'attribute ');
					if ($response)
					{
						// success
						$this->system_message->set_success('Attribute created successfully');
					}
					else
					{
						// failed
						$this->system_message->set_error('Something went wrong');
					}
				}
			}
      	}
		$this->mPageTitle = 'Create Attribute';
		$this->mViewData['form'] = $form;
		$this->render('attribute/create');
	}


	public function attribute_item()
	{   
        $attribute = $this->custom_model->get_data_array("SELECT * FROM attribute_item WHERE `status`='1'");
		$form = $this->form_builder->create_form();
		$post_data = $this->input->post();
		    
		$this->mPageTitle = 'Create Attribute Item';
        $this->mViewData['cate_data'] = $attribute;
		$this->mViewData['form'] = $form;
		$this->render('attribute/attribute_item');
	}


	public function edit($id)
	{
		$form = $this->form_builder->create_form();
		$postdata = $this->input->post();
		//print_r($postdata);
		if ( !empty($postdata) )
		{
				$data = array('item_name' => $postdata['item_name'],'item_value' => $postdata['item_name'],'image' => @$postdata['image']);
				$count = $this->custom_model->record_count('attribute_item',array('item_name' => $postdata['item_name'], 'id !=' => $id));
				//print_r($count);
				if ($count)
				{
					// failed 
					$this->system_message->set_error('Attribute item Already present<br>Unable to Create Attribute item');
				}
				else
				{
					$response = $this->custom_model->update_attribute($id,$data);
					if ($response)
					{
						// success
						$this->system_message->set_success('Attribute item updated successfully');
					}
					else
					{
						// failed
						$this->system_message->set_error('Something went wrong');
					}
				}
			
			refresh();
		}
		$metadata = $this->custom_model->get_attribute_item($id);
		$this->mViewData['edit'] = $metadata[0];
		$this->mPageTitle = 'Attribute item';
		$this->mViewData['form'] = $form;
		$this->render('attribute/edit');
	}

	public function tedit($id)
	{	
		$form = $this->form_builder->create_form();
		ini_set('default_charset', 'UTF-8');
		$postdata = $this->input->post();
		//print_r($postdata);
		if ( !empty($postdata) )
		{
				$data = array('item_name' => $postdata['item_name']);
				$count = $this->custom_model->record_count('attribute_item_trans',array('item_name' => $postdata['item_name'], 'id !=' => $id));
				//print_r($count);
				if ($count)
				{
					// failed 
					$this->system_message->set_error('Attribute item Already present<br>Unable to Create Attribute item');
				}
				else
				{
					$response = $this->custom_model->update_attribute_trans($id,$data);
					if ($response)
					{
						// success
						$this->system_message->set_success('Attribute item updated successfully');
					}
					else
					{
						// failed
						$this->system_message->set_error('Something went wrong');
					}
				}
			
			refresh();
		}
		$metadata = $this->custom_model->get_attribute_item_trans($id);
		$this->mViewData['tedit'] = $metadata[0];
		$this->mPageTitle = 'Attribute item Translate';
		$this->mViewData['form'] = $form;
		$this->render('attribute/tedit');
	}


	function add_attributes()
	{

		$post_data = $this->input->post();

		/*echo "<pre>";
		print_r($post_data);
		die;*/

		if ($post_data['a_id'] == '20')
		{
			/*echo "123"; exit;*/
			$additional_data = array(
				"a_id" 			=> $post_data['a_id'],
				"item_value" 	=> $post_data['item_name'],
				"item_name" 	=> $post_data['item_name'],
				"i_priority"   	=> 1
				);
		  
		  $response = $this->custom_model->my_insert($additional_data,'attribute_item');
		  $is_data = $this->custom_model->my_where('attribute_item','*',array('id' => $response,));		  
		  echo json_encode($is_data);
		  exit;	 

		}
		elseif ($post_data['a_id'] == '19') {

			//$FILES=$_FILES['image'];
		    //$image = $this->uploads($FILES);
		    //$post_data['image'] = $image;


			$additional_data = array(
				"a_id" 				=> $post_data['a_id'],
				"item_name" 		=> $post_data['item_name'],
				"item_value" 		=> $post_data['item_name'],
				"attribute_code" 	=> $post_data['attribute_code'],
				"i_priority" 		=> 1				
				);
				//"image" 			=> $image

			// echo "<pre>";
			// print_r($additional_data);
			// die;

			$response = $this->custom_model->my_insert($additional_data,'attribute_item');			
		  $is_data = $this->custom_model->my_where('attribute_item','*',array('id' => $response,));		  
		  echo json_encode($is_data);
		  exit;			

		}
		elseif ($post_data['a_id'] == '21')
		{
			$additional_data = array(
				"a_id" 			=> $post_data['a_id'],
				"item_value" 	=> $post_data['item_name'],
				"item_name" 	=> $post_data['item_name'],
				"i_priority"   	=> 1
				);
		  
		  $response = $this->custom_model->my_insert($additional_data,'attribute_item');
		  $is_data = $this->custom_model->my_where('attribute_item','*',array('id' => $response,));		  
		  echo json_encode($is_data);
		  exit;
		}
		/*else{

		}*/
	}


	function edit_attributes()
	{
		$post_data = $this->input->post();

		/*echo "<pre>";
		//print_r($_FILES);
		print_r($post_data);
		die;*/

		if ($post_data['id'])
		{
			//$FILES=$_FILES['image'];
		    //$image = $this->uploads($FILES);
		    //$post_data['image'] = $image;
		    $item_name 	= $post_data['item_name'];
		    $id 		= $post_data['id'];
		    if(isset($post_data['attribute_code'])){

            $attribute_code 		= $post_data['attribute_code'];
		    }
            
		    $additional_data = $response = array();

			if(!empty($id)) $additional_data['id'] 					                    	= $id;
	        if(!empty($item_name)) $additional_data['item_name'] 	                    	= $item_name;
	        if(!empty($item_name)) $additional_data['item_value'] 	                    	= $item_name;
	        //if(!empty($image)) $additional_data['image'] 				                    = $image;
	         if(!empty($attribute_code)) $additional_data['attribute_code'] 				= $attribute_code;

	        // echo "<pre>";
	        // print_r($additional_data);
	        // die;

	        $result = $this->custom_model->my_update($additional_data,array("id" => $id),"attribute_item");
	        if($result){
	        	echo "1";
	        	die;
	        } else {
	        	echo  "0";
	        	die;
	        } 
		}
		
	}

	public function uploadss($FILES)
    {
        if (isset($FILES['name'])) {
            $upload_dir = ASSETS_PATH . "/frontend/images/";
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            $file_name    = $FILES['name'];
            $random_digit = rand(0000, 9999);
            $target_file  = $upload_dir . basename($FILES["name"]);
            $ext          = pathinfo($target_file, PATHINFO_EXTENSION);
            
            $new_file_name = $random_digit . "." . $ext;
            $path          = $upload_dir . $new_file_name;
            if (move_uploaded_file($FILES['tmp_name'], $path)) {
                return $new_file_name;
            } else {
                return false;
            }
        } else {
            return false;
            
        }
    }

	public function delete()
	{
		$id = $this->input->post("id");
		$result = $this->custom_model->my_update(array('status'=>0),array("id" => $id),"attribute_item");		
		echo 1;
	}

	public function insert_cat()
	{
		$post_data = $this->input->post();
		// print_r($post_data);
		// die;
		if (!empty($post_data))
		{
			$cat_data = $this->custom_model->my_where('attribute_item','*',array('id' =>$post_data['id']));
			// print_r($post_data['id']);
			echo json_encode($cat_data);
			die;
		}else{
			echo 0;
			die;
		}
	}
}
