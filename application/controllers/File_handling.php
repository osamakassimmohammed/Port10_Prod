<?php
defined('BASEPATH') or exit('No direct script access allowed');

class File_handling extends MY_Controller
{

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

        if (isset($_FILES["file"]["type"])) {
            $details = $this->input->post();
            $path = $details['path'];
            $count = $details['count'];
            // print_r($path);die;
            $FILES = $_FILES["file"];
            // $url =  dirname(__FILE__);
            $upload_dir = ASSETS_PATH . $path;
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            // echo $upload_dir;
// print_r($_SERVER);die;
            $newFileName = md5(time()) . $count;
            $target_file = $upload_dir . basename($FILES["name"]);
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
            $newFileName = $newFileName . "." . $imageFileType;
            $target_file = $upload_dir . $newFileName;
// echo $target_file;

            // list($width, $height, $type, $attr)= getimagesize($FILES["tmp_name"]);
            $type1 = $FILES['type'];

            if ((($type1 == "image/gif") || ($type1 == "image/jpeg") || ($type1 == "image/jpg") || ($type1 == "image/png") || ($type1 == "application/pdf") || ($type1 == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")) /*&& ($FILES["size"] < 50939 ) && ($width < 200) && ($height < 200 ) && ($width > 40) && ($height > 40 )*/) {

                if (move_uploaded_file($FILES["tmp_name"], $target_file)) {
                    // $post_data = array('name' => $newFileName,
                    // 					'path' => $path,
                    // 					'note' => 'admin',
                    // 					'user_id' => $this->mUser->id);

                    // $img_id = $this->custom_model->my_insert($post_data,'image_master');
                    //$this->makeThumbnails($upload_dir.'thumbnails/',$newFileName,$upload_dir.$newFileName);
                    // sub category
                    // $this->makeThumbnails($upload_dir.'thumbnails205/',$newFileName,$upload_dir.$newFileName,205,205);
                    // sub sub category
                    //$this->makeThumbnails($upload_dir.'thumbnails205/',$newFileName,$upload_dir.$newFileName,205,205);
                    // Product
                    /*$this->makeThumbnails($upload_dir.'thumbnails205/',$newFileName,$upload_dir.$newFileName,205,205);*/
                    $uid = $this->session->userdata('uid');
                    $type = $this->session->userdata('type');
                    if (isset($details['car_id']) && !empty($details['car_id'])) {
                        if (!empty($uid)) {
                            if ($type == 'sub_dealer' || $type == 'dealer') {
                                $array_con['id'] = $details['car_id'];
                                if ($type == 'sub_dealer') {
                                    $array_con['sub_dealer_id'] = $uid;
                                } else {
                                    $array_con['dealer_id'] = $uid;
                                }
                                $is_car = $this->custom_model->my_where('add_car_new', "id,image_gallery", $array_con);

                                if (!empty($is_car)) {
                                    if (empty($is_car[0]['image_gallery'])) {
                                        $update['image_gallery'] = $newFileName;
                                    } else {
                                        $update['image_gallery'] = $is_car[0]['image_gallery'] . ',' . $newFileName;
                                    }
                                    $this->custom_model->my_update($update, $array_con, 'add_car_new', true, true);
                                }
                            }
                        }
                    }
                    echo $newFileName;
                } else {
                    echo 'false';
                }
            } else {
                echo 'false';
            }
        }
    }
}
