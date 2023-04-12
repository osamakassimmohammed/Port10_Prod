<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File_handling extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->load->library('form_builder');
		$this->load->model('custom_model');
	}

	/*file upload code*/
	public function uploadFiless()
	{   
		// echo "a.png";die();

		if(isset($_FILES["file"]["type"]))
		{
			$details = $this->input->post();
			$path = $details['path'];
			// print_r($path);die;
			$FILES = $_FILES["file"];
			// $url =  dirname(__FILE__);
			$upload_dir =  ASSETS_PATH.$path;
			if (!file_exists($upload_dir)) {
				mkdir($upload_dir, 0777, true);
			}
			// echo $upload_dir;
// print_r($_SERVER);die;
			$newFileName = md5(time());
			$target_file = $upload_dir . basename($FILES["name"]);
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			$newFileName = $newFileName.".".$imageFileType;
			$target_file = $upload_dir.$newFileName;
// echo $target_file;
			
			// list($width, $height, $type, $attr)= getimagesize($FILES["tmp_name"]);
			$type1 = $FILES['type'];  			
			if ( ( ($type1 == "image/gif") || ($type1 == "image/jpeg") || ($type1 == "image/jpg") || ($type1 == "image/png") || ($type1 == "image/svg") || ($type1 == "image/svg+xml") ) /*&& ($FILES["size"] < 50939 ) && ($width < 200) && ($height < 200 ) && ($width > 40) && ($height > 40 )*/  )
			{ 

				if (move_uploaded_file($FILES["tmp_name"], $target_file)) 
				{
					$post_data = array('name' => $newFileName,
										'path' => $path,
										'note' => 'admin',
										'user_id' => $this->mUser->id);

					// $img_id = $this->custom_model->my_insert($post_data,'image_master');
					//$this->makeThumbnails($upload_dir.'thumbnails/',$newFileName,$upload_dir.$newFileName);
					// sub category 
					// $this->makeThumbnails($upload_dir.'thumbnails205/',$newFileName,$upload_dir.$newFileName,205,205);
					// sub sub category
					//$this->makeThumbnails($upload_dir.'thumbnails205/',$newFileName,$upload_dir.$newFileName,205,205);
					// Product 
					/*$this->makeThumbnails($upload_dir.'thumbnails205/',$newFileName,$upload_dir.$newFileName,205,205);*/
					echo $newFileName;
				}
				else
				{
					echo 'false';
				}
			}
			else
			{ 
				echo 'false';
			}
		}
	}
}