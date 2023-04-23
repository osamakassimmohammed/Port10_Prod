<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
		$this->load->model('custom_model');
		$this->get_access_id();
	}


	public function list1($rowno = 0, $ajax = 'call', $serach = '')
	{

		$language = $this->uri->segment(1);
		if ($language == 'en') {
			$err_msg1 = 'Product List';
		} else {
			$err_msg1 = 'قائمة المنتجات';
		}

		// $udata = $this->custom_model->my_where('admin_users_groups','*',array('user_id' => $this->mUser->id),array(),"","","","","",array(),"",false);

		//if( $udata[0]['group_id'] == 5 )
		//{
		//$product = $this->custom_model->my_where('product','*',array('seller_id' => $this->mUser->id ),"","id","desc");
		//}else{

		$this->load->library('pagination');

		$post_data = $this->input->post();

		if (!empty($post_data)) {
			$rowno = $post_data['pagno'];
			$ajax 	= $post_data['ajax'];
			$serach = $post_data['serach'];
		}
		// Row per page
		$rowperpage = 10;
		$page_no = 0;

		// Row position
		if ($rowno != 0) {
			$page_no = $rowno;
			$rowno = ($rowno - 1) * $rowperpage;
		}
		if (!empty($this->mUser->id) && ($this->mUser->type == "suppler" || $this->mUser->type == "subsupplier")) {
			$seller_id = $this->nmUser_id;
			$sub_query = " AND pro.seller_id='$seller_id'";
		} else {
			$sub_query = "";
		}
		// echo $sub_query;
		// die;
		if ($ajax == 'call') {

			$product = $this->custom_model->get_data_array("SELECT pro.id,pro.product_name,pro.product_image,pro.status,pro.created_date,pro.sale_price,admin.first_name,cat.display_name FROM product as pro INNER JOIN admin_users as admin ON pro.seller_id=admin.id  INNER JOIN category as cat ON pro.category=cat.id  WHERE  pro.product_delete='0' $sub_query  Order BY pro.id ASC limit $rowno,$rowperpage ");

			$product_count = $this->custom_model->get_data_array("SELECT  COUNT(pro.id) as product_count FROM product as pro INNER JOIN admin_users as admin ON pro.seller_id=admin.id  INNER JOIN category as cat ON pro.category=cat.id  WHERE  pro.product_delete='0' $sub_query  Order BY pro.id  ASC ");
		} else {
			if (empty($serach)) {
				$product = $this->custom_model->get_data_array("SELECT pro.id,pro.product_name,pro.product_image,pro.status,pro.created_date,pro.sale_price,admin.first_name,cat.display_name FROM product as pro INNER JOIN admin_users as admin ON pro.seller_id=admin.id  INNER JOIN category as cat ON pro.category=cat.id  WHERE  pro.product_delete='0' $sub_query  Order BY pro.id  ASC limit $rowno,$rowperpage ");

				$product_count = $this->custom_model->get_data_array("SELECT  COUNT(pro.id) as product_count FROM product as pro INNER JOIN admin_users as admin ON pro.seller_id=admin.id  INNER JOIN category as cat ON pro.category=cat.id  WHERE  pro.product_delete='0' $sub_query  Order BY pro.id  ASC ");
			} else {

				// $product = $this->custom_model->get_data_array("SELECT * FROM product WHERE (product_name LIKE '%$serach%' OR `created_date` LIKE '%$serach%' OR status LIKE '%$serach%' OR id LIKE '%$serach%') AND `product_delete`='0' $sub_query  ORDER BY `id` DESC LIMIT $rowno,$rowperpage ");

				$product = $this->custom_model->get_data_array("SELECT pro.id,pro.product_name,pro.product_image,pro.status,pro.created_date,pro.sale_price,admin.first_name,cat.display_name FROM product as pro INNER JOIN admin_users as admin ON pro.seller_id=admin.id  INNER JOIN category as cat ON pro.category=cat.id  WHERE (pro.product_name LIKE '%$serach%' OR pro.created_date LIKE '%$serach%' OR pro.status LIKE '%$serach%' OR pro.id LIKE '%$serach%' OR cat.display_name LIKE '%$serach%' OR admin.first_name LIKE '%$serach%') AND  pro.product_delete='0' $sub_query  Order BY pro.id  ASC limit $rowno,$rowperpage ");

				$product_count = $this->custom_model->get_data_array("SELECT COUNT(pro.id) as product_count FROM product as pro INNER JOIN admin_users as admin ON pro.seller_id=admin.id  INNER JOIN category as cat ON pro.category=cat.id  WHERE (pro.product_name LIKE '%$serach%' OR pro.created_date LIKE '%$serach%' OR pro.status LIKE '%$serach%' OR pro.id LIKE '%$serach%' OR cat.display_name LIKE '%$serach%' OR admin.first_name LIKE '%$serach%') AND pro.product_delete='0' $sub_query  Order BY pro.id  ASC ");
			}
		}

		if (!empty($product)) {
			foreach ($product as $product_key => $product_val) {
				$pid = $product_val['id'];
				$product_attrs = $this->custom_model->get_data_array("SELECT `item_id`,`price`,`sale_price` FROM product_attribute WHERE `p_id` = '$pid'");

				// this for if product have attribute
				if (!empty($product_attrs)) {
					$product[$product_key]['meta_data'] = $product_attrs;
					foreach ($product[$product_key]['meta_data'] as $key2 => $meta_data) {
						$item_id = $meta_data['item_id'];
						$attribute_item = $this->custom_model->get_data_array("SELECT `item_name` FROM attribute_item WHERE `id` = '$item_id'");
						$product[$product_key]['meta_data'][$key2]['size'] = $attribute_item[0]['item_name'];
					}
				}

				$product_image = explode("/", $product_val['product_image']);
				$product_image = count($product_image);
				if ($product_image == 1) {
					$image_url = base_url("assets/admin/products/") . $product_val['product_image'];
				} else {
					$image_url = $product_val['product_image'];
				}
				$product[$product_key]['image_url'] = $image_url;
				$product[$product_key]['created_date'] = date("d-m-Y", strtotime($product_val['created_date']));
			}
		}

		$config['base_url'] = base_url() . 'admin/product/list1';
		$config['use_page_numbers'] = TRUE;
		$config['total_rows'] = $product_count[0]['product_count'];
		$config['per_page'] = $rowperpage;
		$config['page_query_string'] = FALSE;
		$config['enable_query_strings'] = FALSE;
		$config['reuse_query_string']  = FALSE;
		$config['cur_page'] = $page_no;

		// Initialize
		$this->pagination->initialize($config);
		// Initialize $data Array
		$data['pagination'] = $this->pagination->create_links();
		$data['result'] = $product;
		$data['row'] = $rowno;
		$data['total_rows'] = $product_count[0]['product_count'];
		// $this->mViewData['pagination'] = $this->pagination->create_links();
		// this for when page load
		if ($ajax == 'call' && $rowno == 0 && empty($post_data)) {
			$this->mViewData['pagination'] = $this->pagination->create_links();
		} elseif ($serach != '') {  // this for search button pagination
			echo json_encode($data);
			exit;
		} else { // this for pagination-
			echo json_encode($data);
			exit;
		}

		$this->mPageTitle = $err_msg1;
		$this->mViewData['product'] = $product;
		$this->render('product/list1');
	}




	// Create Product
	public function create()
	{
		// print_r("hi");
		$language = $this->uri->segment(1);
		if ($language == 'en') {
			$err_msg1 = 'Product created successfully';
			$err_msg2 = 'Something went wrong';
			$err_msg3 = 'Add Product';
		} else {
			$err_msg1 = 'تم إنشاء المنتج بنجاح';
			$err_msg2 = 'هناك خطأ ما';
			$err_msg3 = 'أضف منتج';
		}

		$udata = $this->custom_model->my_where('admin_users_groups', '*', array('user_id' => $this->mUser->id), array(), "", "", "", "", "", array(), "", false);

		$user_details = $this->custom_model->my_where('admin_users', '*', array('id' => $this->mUser->id), array(), "", "", "", "", "", array(), "", false);

		// echo "<pre>";
		$this->mViewData['udata'] = $udata;
		$this->mViewData['user_details'] = $user_details;


		$form = $this->form_builder->create_form('', '', 'id="wizard_with_validation" class="wizard clearfix"');
		$post_data = $this->input->post();


		if (!empty($post_data)) {
			if ($this->mUser->id != 1) {
				$post_data['seller_id'] = $this->mUser->id;
			}
			$post_data['price_select'] = 1;
			$post_data['update_date'] = date('Y-m-d');
			// Customize start

			// echo "<pre>";
			// print_r($post_data);
			// die;
			$count = 0;
			// $count = $this->custom_model->record_count('product',array('product_name' => $post_data['product_name'],'country_name'=>'country1' ));
			// product dublicate
			// if ($count)
			// {
			// 	$this->system_message->set_error('Product Already present<br>Unable to Create Product.');
			// }
			// else
			// {

			if (!empty($post_data['seller_id'])) {
				// $attribute = @$post_data['attribute'];
				$attribute = @$post_data['attribute2'];
				if (!empty($attribute)) {
					$attribute = explode(",", $attribute);
				}
				$attribute_price = @$post_data['attribute_price'];
				$attribute_sale_price = @$post_data['attribute_sale_price'];
				$attribute_qty = @$post_data['attribute_qty'];
				unset($post_data['attribute']);
				unset($post_data['attribute_price']);
				unset($post_data['attribute_sale_price']);
				unset($post_data['attribute2']);
				unset($post_data['attribute_id_size']);
				unset($post_data['attribute_qty']);
				if (isset($post_data['is_delivery_available'])) {
					$post_data['is_delivery_available'] = 1;
				} else {
					$post_data['is_delivery_available'] = 0;
				}

				if (isset($post_data['is_sample_order'])) {
					$post_data['is_sample_order'] = 1;
				} else {
					$post_data['is_sample_order'] = 0;
				}
				// if($post_data['price_select']==2)
				// {
				// 	unset($post_data['price']);
				// 	unset($post_data['sale_price']);
				// }
				$post_data['image_gallery'] = trim($post_data['image_gallery'], ',');

				if (isset($post_data['customize_att']) && !empty($post_data['customize_att'])) {
					$customize_att = $post_data['customize_att'];
					unset($post_data['customize_att']);
				}
				// echo "<pre>";
				// print_r($post_data);
				// die;

				$response = $this->custom_model->my_insert($post_data, 'product');
				// echo $this->db->last_query();
				// die;
				$this->custom_model->my_insert($post_data, 'product_trans');

				if (!empty($customize_att)) {
					foreach ($customize_att as $askey => $asvalue) {
						$myArray = explode(',', $asvalue);

						foreach ($myArray as $asdkey => $asdvalue) {
							if ($asdkey == 0) {
								$pcustomize_title_id = $asdvalue;
								unset($asdvalue);
							} else {
								$c_data['pcustomize_title_id'] = $pcustomize_title_id;
								$c_data['pcustomize_attribute_id'] = $asdvalue;
								$c_data['pid'] = $response;
								// print_r($c_data);
								$this->custom_model->my_insert($c_data, 'product_custimze_details');
							}
						}
					}
				}

				//update attribute
				if ($post_data['price_select'] == 2) {
					if (!empty($attribute)) {
						foreach ($attribute as $ak => $aval) {
							$size_id = $this->custom_model->my_where('attribute_item', 'a_id', array('id' => $aval));

							// $this->custom_model->my_insert(['attribute_id' => $size_id[0]['a_id'], 'p_id' => $response, 'item_id' => $aval,'price'=>$attribute_price[$ak],'sale_price'=>$attribute_sale_price[$ak]], 'product_attribute');
							$this->custom_model->my_insert(['attribute_id' => $size_id[0]['a_id'], 'p_id' => $response, 'item_id' => $aval, 'price' => $post_data['price'], 'sale_price' => $post_data['sale_price'], 'qty' => $attribute_qty[$ak]], 'product_attribute');
						}
					}
				}


				if ($response) {
					$this->system_message->set_success($err_msg1);
					redirect($language . '/admin/product/list1');
				} else {
					$this->system_message->set_error($err_msg2);
				}
			} else {
				$this->system_message->set_error($err_msg2);
			}

			refresh();
		}

		// multi vender comment
		// if( $udata[0]['group_id'] == 5 ){
		// 	$usrdata = $this->custom_model->my_where('admin_users','*',array('id' => $this->mUser->id),array(),"","","","",array(),"",false);
		// 	$catdslug = $usrdata[0]['category'];
		// }
		// $acategories = $this->custom_model->my_where('category','*',array('status' => 'active'),array(),"parent","asc","","",array(),"object");

		// $acatp = array();
		// if(!empty($acategories)){
		// 	foreach ($acategories as $ckey => $cvalue) {
		// 		$parent = $cvalue->parent;
		// 		$acatp[$parent][] = $cvalue;
		// 	}
		// }
		// if( $udata[0]['group_id'] == 5 ){
		// 	foreach ($acatp[0] as $ckey => $cvalue) {
		// 		if( $catdslug != $cvalue->slug ){
		// 			unset($acatp[0][$ckey]);
		// 		}
		// 	}
		// }

		// $this->mViewData['acatp'] = $acatp;
		if ($language == 'en') {
			$category = $this->custom_model->my_where('category', '*', array('status' => 'active', 'parent' => '0'), array(), "parent", "asc", "", "", array(), "");
		} else {
			$category = $this->custom_model->my_where('category_trans', '*', array('status' => 'active', 'parent' => '0'), array(), "parent", "asc", "", "", array(), "");
		}
		$this->mViewData['category'] = $category;
		// $sub_cat = $this->custom_model->get_data_array("SELECT * FROM category WHERE `parent` = '1'  ");
		// $this->mViewData['sub_cat'] = $sub_cat;


		//imp $this->mViewData['vendors'] = $this->custom_model->get_data("SELECT a.id,a.first_name FROM admin_users AS a JOIN admin_users_groups AS b ON a.id= b.user_id WHERE a.active= 1 AND b.group_id = 1 ");

		$groups = $this->ion_auth->groups()->result();
		unset($groups[0]);	// disable creation of "webmaster" account
		$this->mViewData['groups'] = $groups;
		$this->mPageTitle = $err_msg3;
		$this->mViewData['form'] = $form;

		// $attribute = $this->custom_model->get_data("SELECT * FROM attribute WHERE id='" );

		$attribute = array();
		//imp $attribute = $this->custom_model->get_data("SELECT * FROM attribute");
		// $attribute = json_decode( json_encode($attribute), true);
		// if (!empty($attribute))
		// {
		// 	foreach ($attribute as $key => $value)
		// 	{
		// 		$attribute_item = $this->custom_model->get_data("SELECT * FROM attribute_item WHERE `status`='1' AND  a_id = ".$value['id']);
		// 		$attribute_item = json_decode( json_encode($attribute_item), true);
		// 		$attribute[$key]['item'] = $attribute_item;
		// 	}

		// }

		$pcustomize_list = array();
		//imp $pcustomize_list = $this->custom_model->my_where('pcustomize_title','*',array('status' => '1','delete_status'=>'0'),array());
		// if (!empty($pcustomize_list)) {
		// 	foreach ($pcustomize_list as $dkey => $dvalue) {
		// 		$cut_id = $dvalue['id'];
		// 		$cus_attribute = $this->custom_model->get_data_array("SELECT name,id,price FROM pcustomize_attribute WHERE `pcus_id`='$cut_id' AND  `delete_status` = '0' ");

		// 		$pcustomize_list[$dkey]['sub_attri'] = $cus_attribute;

		// 	}
		// }
		if ($language == 'en') {
			$brand_data = $this->custom_model->my_where('brand', '*', array('seller_id' => $this->mUser->id), array());
		} else {
			$brand_data = $this->custom_model->my_where('brand_trans', '*', array('seller_id' => $this->mUser->id), array());
		}

		if ($language == 'en') {
			$unit_list = $this->custom_model->get_data_array("SELECT * FROM unit_list ORDER BY unit_name ASC ");
		} else {
			$unit_list = $this->custom_model->get_data_array("SELECT * FROM unit_list_trans ORDER BY unit_name ASC ");
		}
		$supplier_data = $this->custom_model->get_data_array("SELECT id,first_name FROM admin_users WHERE type='suppler' AND is_terminate='0' AND active='1' AND subs_status!='expired' AND is_email_verify='1' ORDER BY id ASC ");

		$city_list = $this->custom_model->get_data_array("SELECT * FROM city_list ORDER BY city_name ASC ");

		// echo "<pre>";
		// print_r($attribute);
		// die;


		$this->mViewData['attribute'] = $attribute;
		$this->mViewData['pcustomize_list'] = $pcustomize_list;
		$this->mViewData['brand_data'] = $brand_data;
		$this->mViewData['unit_list'] = $unit_list;
		$this->mViewData['supplier_data'] = $supplier_data;
		$this->mViewData['seller_id'] = $this->mUser->id;
		$this->mViewData['pack_arr'] = $this->get_packaging_type();
		$this->mViewData['req_loading_arr'] = $this->get_req_loading();
		$this->mViewData['hazardous_arr'] = $this->get_hazardous();
		$this->mViewData['vehical_arr'] = $this->vehical_requirement();
		$this->mViewData['weight_unit_arr'] = $this->get_weight_unit();
		$this->mViewData['city_list'] = $city_list;

		$this->render('product/create_product');
	}

	public function get_packaging_type()
	{
		$pack_arr = array();
		$pack_arr[0] = lang('Boxes');
		$pack_arr[1] = lang('Pallets');
		$pack_arr[2] = lang('Others');
		return $pack_arr;
	}

	public function get_req_loading()
	{
		$req_loading_arr = array();
		$req_loading_arr[0] = lang('Liftgate');
		$req_loading_arr[1] = lang('Ramps');
		return $req_loading_arr;
	}

	public function get_hazardous()
	{
		$hazardous_arr = array();
		$hazardous_arr[0] = lang('Yes');;
		$hazardous_arr[1] = lang('No1');;
		return $hazardous_arr;
	}

	public function vehical_requirement()
	{
		$vehical_arr = array();
		$vehical_arr[0] = lang('Truck');
		$vehical_arr[1] = lang('Refrigerator Truck');
		return $vehical_arr;
	}

	public function get_weight_unit()
	{
		$weight_unit_arr = array();
		$weight_unit_arr['T'] = lang('Tonne');
		$weight_unit_arr['KG'] = lang('Kilogram');
		$weight_unit_arr['G'] = lang('Gram');
		return $weight_unit_arr;
	}

	// Edit Frontend Category
	public function edit($product_id)
	{
		$language = $this->uri->segment(1);
		if ($language == 'en') {
			$err_msg1 = 'Product updated successfully';
			$err_msg2 = 'Something went wrong';
			$err_msg3 = 'Edit Product';
		} else {
			$err_msg1 = 'تم تحديث المنتج بنجاح';
			$err_msg2 = 'هناك خطأ ما';
			$err_msg3 = 'تعديل منتج';
		}
		$udata = $this->custom_model->my_where('admin_users_groups', '*', array('user_id' => $this->mUser->id), array(), "", "", "", "", "", array(), "", false);
		$this->mViewData['vendor'] = 0;
		if ($udata[0]['group_id'] == 5) {
			$this->mViewData['vendor'] = 1;
		}
		$form = $this->form_builder->create_form('', '', 'id="wizard_with_validation" class="wizard clearfix"');
		$post_data = $this->input->post();


		$user_details = $this->custom_model->my_where('admin_users', '*', array('id' => $this->mUser->id), array(), "", "", "", "", "", array(), "", false);

		// echo "<pre>";
		$this->mViewData['udata'] = $udata;
		$this->mViewData['user_details'] = $user_details;



		if (!empty($post_data)) {
			// echo 	"<pre>";
			// print_r($post_data['is_delivery_available']);
			// die;
			$post_data['update_date'] = date('Y-m-d');
			$post_data['price_select'] = 1;

			if (!isset($post_data['special_menu'])) {
				// $post_data['special_menu']='0';
			}
			if (empty($post_data['attribute2'])) {
				unset($post_data['attribute2']);
			}
			// if (!empty($post_data['attribute']))
			// {
			// $attribute2=$post_data['attribute2'];
			// $attribute_price=$post_data['attribute_price'];
			// $attribute_sale_price=$post_data['attribute_sale_price'];
			// $attribute_id_size=$post_data['attribute_id_size'];
			// $attribute_qty=$post_data['attribute_qty'];
			// $attribute2=explode(",",$attribute2);
			// unset($post_data['attribute2']);
			// unset($post_data['attribute_price']);
			// unset($post_data['attribute_sale_price']);
			// unset($post_data['attribute_id_size']);
			// unset($post_data['attribute_qty']);
			if (isset($post_data['is_delivery_available'])) {
				$post_data['is_delivery_available'] = 1;
			} else {
				$post_data['is_delivery_available'] = 0;
			}
			if (isset($post_data['is_sample_order'])) {
				$post_data['is_sample_order'] = 1;
			} else {
				$post_data['is_sample_order'] = 0;
			}


			// foreach ($attribute2 as $ak1 => $aval1)
			// {
			// 	//print_r($colorr);
			// 	///$this->custom_model->my_insert(['p_id' => $product_id, 'item_id' => $aval1], 'product_attribute');

			// 	$colorr = $this->custom_model->my_where('attribute_item','item_name',array('id' => $aval1,'a_id' => '19'));
			// 	foreach ($colorr as $ekey => $evalue) {
			// 		$tags[] = implode(',', $evalue);
			// 		// echo $tags;

			// 	}
			// }


			// if (!empty($tags))
			// {
			// 	$string = implode(', ', $tags);
			// 	$color = $this->custom_model->my_update(array("color" => $string),array('id' => $product_id),'product');
			// }
			// }
			// else{
			// 	$color = $this->custom_model->my_update(array("color" => ''),array('id' => $product_id),'product');
			// }

			$product_data = $this->custom_model->my_where('product', '*', array('id' => $product_id), array(), "", "", "", "", array(), "object");

			if ($udata[0]['group_id'] == 5) {
				// $post_data['seller_id'] = $this->mUser->id;
			}

			unset($post_data['product_show_case']);
			if ($product_data[0]->product_name != $post_data['product_name']) {
				$post_data['slug'] = $this->generate_slug($post_data['product_name'], 'product');
			}
			//$post_data['seller_id'] = $this->mUser->id;
			$count = 0;
			// $count = $this->custom_model->record_count('product',array('product_name' => $post_data['product_name'], 'id !=' => $product_id));
			// product dublicate
			// if ($count)
			// {
			// 	$this->system_message->set_error('Product Already present<br>Unable to Create Product');
			// }
			// else
			// {
			$post_data['image_gallery'] = trim($post_data['image_gallery'], ',');
			$attribute = isset($post_data['attribute']) ? $post_data['attribute'] : [];
			if (!empty($attribute2)) {
				$attribute = $attribute2;
			}
			if (isset($post_data['attribute'])) unset($post_data['attribute']);
			if (isset($post_data['customize_att']) && !empty($post_data['customize_att'])) {
				$customize_att = $post_data['customize_att'];
				unset($post_data['customize_att']);
			}
			// echo "<pre>";
			// print_r($post_data);
			// die;
			// $post_data['unite']=implode(",",$post_data['unite']);
			$response = $this->custom_model->my_update($post_data, array('id' => $product_id), 'product');
			$update_into_trans['sku_code'] = $post_data['sku_code'];
			$update_into_trans['weight_unit'] = $post_data['weight_unit'];
			$update_into_trans['category'] = $post_data['category'];
			$update_into_trans['product_image'] = $post_data['product_image'];
			$update_into_trans['subcategory'] = $post_data['subcategory'];
			// $update_into_trans['sub_sub_category']=$post_data['sub_sub_category'];
			$update_into_trans['status'] = $post_data['status'];
			$update_into_trans['price'] = $post_data['price'];
			$update_into_trans['sale_price'] = $post_data['sale_price'];
			$update_into_trans['stock_status'] = $post_data['stock_status'];
			$update_into_trans['price_select'] = $post_data['price_select'];
			$update_into_trans['brand'] = $post_data['brand'];
			$update_into_trans['unite'] = $post_data['unite'];
			$update_into_trans['min_order_quantity'] = $post_data['min_order_quantity'];
			if (isset($post_data['is_sample_order'])) {
				$update_into_trans['is_sample_order'] = 1;
			} else {
				$update_into_trans['is_sample_order'] = 0;
			}
			if (isset($post_data['stock'])) {
				$update_into_trans['stock'] = $post_data['stock'];
			}
			if (isset($post_data['special_menu'])) {
				$update_into_trans['special_menu'] = $post_data['special_menu'];
			}
			if (isset($post_data['seller_id'])) {
				$update_into_trans['seller_id'] = $post_data['seller_id'];
			}
			// echo "<pre>";
			// print_r($update_into_trans);
			// print_r($post_data);
			// die;
			$this->custom_model->my_update($update_into_trans, array('id' => $product_id), 'product_trans');


			$this->custom_model->my_delete(['pid' => $product_id], 'product_custimze_details');
			if (!empty($customize_att)) {
				foreach ($customize_att as $askey => $asvalue) {
					$myArray = explode(',', $asvalue);

					foreach ($myArray as $asdkey => $asdvalue) {
						if ($asdkey == 0) {
							$pcustomize_title_id = $asdvalue;
							unset($asdvalue);
						} else {
							$c_data['pcustomize_title_id'] = $pcustomize_title_id;
							$c_data['pcustomize_attribute_id'] = $asdvalue;
							$c_data['pid'] = $product_id;
							// print_r($c_data);
							$this->custom_model->my_insert($c_data, 'product_custimze_details');
						}
					}
				}
			}

			$this->custom_model->my_delete(['p_id' => $product_id], 'product_attribute');
			if ($post_data['price_select'] == 2) {

				foreach ($attribute as $ak => $aval) {
					$size_id = $this->custom_model->my_where('attribute_item', 'a_id', array('id' => $aval));

					$this->custom_model->my_insert(['attribute_id' => $size_id[0]['a_id'], 'p_id' => $product_id, 'item_id' => $aval, 'price' => $attribute_price[$ak], 'sale_price' => $attribute_sale_price[$ak], 'id_size' => $attribute_id_size[$ak], 'qty' => $attribute_qty[$ak]], 'product_attribute');
					// $this->custom_model->my_insert(['attribute_id' => $size_id[0]['a_id'], 'p_id' => $product_id, 'item_id' => $aval], 'product_attribute');
				}
			}

			if ($response) {
				$this->system_message->set_success($err_msg1);
			} else {
				$this->system_message->set_error($err_msg2);
			}
			// }
			// refresh();
		}
		// multi vender comment
		// if( $udata[0]['group_id'] == 5 ){
		// 	$usrdata = $this->custom_model->my_where('admin_users','*',array('id' => $this->mUser->id));
		// 	$catdslug = $usrdata[0]['category'];
		// }
		// multi vender comment
		// $acategories = $this->custom_model->my_where('category','*',array('status' => 'active'),array(),"parent","asc","","",array(),"object");
		// $acatp = array();
		// $ieq = $jeq = "";
		// echo 	"<pre>";
		// print_r($post_data);
		// die;
		if ($this->mUser->type == '') {
			$product_data = $this->custom_model->my_where('product', '*', array('id' => $product_id), array(), "", "", "", "", array(), "object");
			if (empty($product_data)) {
				redirect($language . '/admin/product/list1');
			}
		} else {
			$product_data = $this->custom_model->my_where('product', '*', array('id' => $product_id, 'seller_id' => $this->mUser->id), array(), "", "", "", "", array(), "object");
			if (empty($product_data)) {
				redirect($language . '/admin/product/list1');
			}
		}

		// multi vender comment
		// $category = $product_data[0]->category;
		// if(!empty($acategories)){
		// 	foreach ($acategories as $ckey => $cvalue) {
		// 		$id = $cvalue->id;
		// 		if($id == $category){
		// 			$ieq = $cvalue->parent;
		// 		}
		// 		$parent = $cvalue->parent;
		// 		$acatp[$parent][] = $cvalue;
		// 	}
		// }
		// if(!empty($ieq)){
		// 	foreach ($acategories as $ckey => $cvalue) {
		// 		$id = $cvalue->id;
		// 		if($id == $ieq){
		// 			$jeq = $cvalue->parent;
		// 		}
		// 	}
		// }

		// $this->mViewData['jeq'] = $jeq;
		// $this->mViewData['ieq'] = $ieq;
		// //print_r($this->mViewData);die;
		// if( $udata[0]['group_id'] == 5 ){
		// 	foreach ($acatp[0] as $ckey => $cvalue) {
		// 		if( $catdslug != $cvalue->slug ){
		// 			unset($acatp[0][$ckey]);
		// 		}
		// 	}
		// }
		// asort($acatp);
		// $this->mViewData['acatp'] = $acatp;

		// $this->mViewData['vendors'] = $this->custom_model->get_data("SELECT a.id,a.first_name FROM admin_users AS a JOIN admin_users_groups AS b ON a.id= b.user_id WHERE a.active= 1 AND b.group_id = 1 ");

		$groups = $this->ion_auth->groups()->result();
		unset($groups[0]);

		$p_attr = $this->custom_model->my_where('product_attribute', '*', ['p_id' => $product_id]);
		$patr = array();
		foreach ($p_attr as $pakey => $pavalue) {
			$patr[] = $pavalue['item_id'];
		}

		foreach ($p_attr as $pakey2 => $pavalue2) {
			$attribute_item2 = $this->custom_model->get_data_array("SELECT * FROM attribute_item WHERE id = " . $pavalue2['item_id']);
			$p_attr[$pakey2]['item_name'] = $attribute_item2[0]['item_name'];
		}
		$this->mViewData['product_attribute'] = $patr;

		$attribute = $this->custom_model->get_data("SELECT * FROM attribute");
		$attribute = json_decode(json_encode($attribute), true);
		foreach ($attribute as $key => $value) {
			$attribute_item = $this->custom_model->get_data("SELECT * FROM attribute_item WHERE  `status`='1' AND a_id = " . $value['id']);
			$attribute_item = json_decode(json_encode($attribute_item), true);
			$attribute[$key]['item'] = $attribute_item;
		}

		$this->mViewData['attribute'] = $attribute;
		$this->mViewData['p_attr'] = $p_attr;
		// $this->mViewData['p_attr'] = '';
		// echo $product_id;
		// echo "<pre>";
		// print_r($attribute);
		// echo "<pre>";
		// print_r($p_attr);
		// die;
		if ($language == 'en') {
			$category = $this->custom_model->my_where('category', '*', array('status' => 'active', 'parent' => '0'), array(), "parent", "asc", "", "", array(), "");
		} else {
			$category = $this->custom_model->my_where('category_trans', '*', array('status' => 'active', 'parent' => '0'), array(), "parent", "asc", "", "", array(), "");
		}
		// $category = $this->custom_model->my_where('category','*',array('status' => 'active','parent'=>'0'),array(),"parent","asc","","",array(),"");
		$this->mViewData['category'] = $category;
		// $sub_cat = $this->custom_model->get_data_array("SELECT * FROM category WHERE `parent` != '0'  ");
		if ($language == 'en') {
			$sub_category = $this->custom_model->my_where('category', '*', array('status' => 'active', 'parent' => $product_data[0]->category), array(), "id", "asc", "", "", array(), "");
		} else {
			$sub_category = $this->custom_model->my_where('category_trans', '*', array('status' => 'active', 'parent' => $product_data[0]->category), array(), "id", "asc", "", "", array(), "");
		}
		// $sub_sub_category = $this->custom_model->my_where('category','*',array('status' => 'active','parent'=>$product_data[0]->subcategory),array(),"id","asc","","",array(),"");
		//    print_r($this->mUser->id);die;
		$brand_data = $this->custom_model->my_where('brand', '*', array('seller_id' => $this->mUser->id), array());
		// echo "<pre>";
		// print_r($brand_data);
		// die;
		$pcustomize_list = array();
		//imp $pcustomize_list = $this->custom_model->my_where('pcustomize_title','*',array('status' => '1','delete_status'=>'0'),array());
		// if (!empty($pcustomize_list)) {
		// 	foreach ($pcustomize_list as $dkey => $dvalue) {
		// 		$cut_id = $dvalue['id'];
		// 		$cus_attribute = $this->custom_model->get_data_array("SELECT name,id,price FROM pcustomize_attribute WHERE `pcus_id`='$cut_id' AND  `delete_status` = '0' ");
		// 		$pcustomize_list[$dkey]['sub_attri'] = $cus_attribute;
		// 	}
		// }
		$sled_cus_list = array();
		$pcu_slced_list = array();

		//imp $pcu_slced_list = $this->custom_model->get_data_array("SELECT `pcustomize_title_id`,`pcustomize_attribute_id` FROM `product_custimze_details` WHERE `pid` = '$product_id'");
		// if(!empty($pcu_slced_list)){
		// 	foreach ($pcu_slced_list as $psl_key => $psl_val)
		// 	{
		// 		array_push($sled_cus_list,$psl_val['pcustomize_attribute_id']);
		// 	}
		// }

		$unit_list = $this->custom_model->get_data_array("SELECT * FROM unit_list ORDER BY unit_name ASC ");

		$supplier_data = $this->custom_model->get_data_array("SELECT id,first_name FROM admin_users WHERE type='suppler' AND is_email_verify='1' ORDER BY id ASC ");

		$city_list = $this->custom_model->get_data_array("SELECT * FROM city_list ORDER BY city_name ASC ");


		// 	$selcted_subcategory="";
		// if(!empty($sub_category))
		// {
		// 	foreach ($sub_category as $sel_catkey => $sub_category) {

		// 	$selcted_subcategory = $sub_category['id'].','.$selcted_subcategory;
		// 	}
		// 	$selcted_subcategory = rtrim($selcted_subcategory,',');
		// }

		// echo "<pre>";
		// print_r($product_data);
		// print_r($pcu_slced_list);
		// print_r($pcustomize_list);
		// print_r($pcustm_seleted = explode(',',$product_data[0]->customize));
		// die;

		// $this->mViewData['sub_cat'] = $sub_cat;
		$this->mViewData['sub_category'] = $sub_category;
		// $this->mViewData['sub_sub_category'] = $sub_sub_category;
		$this->mViewData['brand_data'] = $brand_data;
		$this->mViewData['unit_list'] = $unit_list;


		$this->mViewData['edit'] = $product_data[0];

		$this->mViewData['groups'] = $groups;
		$this->mViewData['pcustomize_list'] = $pcustomize_list;
		$this->mViewData['sled_cus_list'] = $sled_cus_list;
		$this->mViewData['supplier_data'] = $supplier_data;
		$this->mViewData['seller_id'] = $this->mUser->id;

		$this->mViewData['pack_arr'] = $this->get_packaging_type();
		$this->mViewData['req_loading_arr'] = $this->get_req_loading();
		$this->mViewData['hazardous_arr'] = $this->get_hazardous();
		$this->mViewData['vehical_arr'] = $this->vehical_requirement();
		$this->mViewData['weight_unit_arr'] = $this->get_weight_unit();
		$this->mViewData['city_list'] = $city_list;

		$this->mPageTitle = $err_msg3;
		$this->mViewData['form'] = $form;

		$this->render('product/create_product');
	}




	public function tedit($product_id)
	{

		$language = $this->uri->segment(1);
		if ($language == 'en') {
			$err_msg1 = 'Product updated successfully';
			$err_msg2 = 'Something went wrong';
			$err_msg3 = 'Edit Product';
		} else {
			$err_msg1 = 'Product updated successfully';
			$err_msg2 = 'هناك خطأ ما';
			$err_msg3 = 'تعديل منتج';
		}

		$udata = $this->custom_model->my_where('admin_users_groups', '*', array('user_id' => $this->mUser->id), array(), "", "", "", "", "", array(), "", false);
		$this->mViewData['vendor'] = 0;
		if ($udata[0]['group_id'] == 5) {
			$this->mViewData['vendor'] = 1;
		}
		$form = $this->form_builder->create_form('', '', 'id="wizard_with_validation" class="wizard clearfix"');
		$post_data = $this->input->post();


		$user_details = $this->custom_model->my_where('admin_users', '*', array('id' => $this->mUser->id), array(), "", "", "", "", "", array(), "", false);

		// echo "<pre>";
		$this->mViewData['udata'] = $udata;
		$this->mViewData['user_details'] = $user_details;



		if (!empty($post_data)) {
			// echo 	"<pre>";
			// print_r($post_data);
			// die;
			$post_data['update_date'] = date('Y-m-d');
			$post_data['price_select'] = 1;
			if (!isset($post_data['special_menu'])) {
				// $post_data['special_menu']='0';
			}
			if (empty($post_data['attribute2'])) {
				unset($post_data['attribute2']);
			}
			if (!empty($post_data['attribute'])) {
				$attribute2 = $post_data['attribute2'];
				$attribute_price = $post_data['attribute_price'];
				$attribute_sale_price = $post_data['attribute_sale_price'];
				$attribute_id_size = $post_data['attribute_id_size'];
				$attribute_qty = $post_data['attribute_qty'];
				$attribute2 = explode(",", $attribute2);
				unset($post_data['attribute2']);
				unset($post_data['attribute_price']);
				unset($post_data['attribute_sale_price']);
				unset($post_data['attribute_id_size']);
				unset($post_data['attribute_qty']);
				if (isset($post_data['is_delivery_available'])) {
					$post_data['is_delivery_available'] = 1;
				} else {
					$post_data['is_delivery_available'] = 0;
				}

				if (isset($post_data['is_sample_order'])) {
					$post_data['is_sample_order'] = 1;
				} else {
					$post_data['is_sample_order'] = 0;
				}
				foreach ($attribute2 as $ak1 => $aval1) {
					//print_r($colorr);
					///$this->custom_model->my_insert(['p_id' => $product_id, 'item_id' => $aval1], 'product_attribute');

					$colorr = $this->custom_model->my_where('attribute_item', 'item_name', array('id' => $aval1, 'a_id' => '19'));
					foreach ($colorr as $ekey => $evalue) {
						$tags[] = implode(',', $evalue);
						// echo $tags;

					}
				}
				// if (!empty($tags))
				// {
				// 	$string = implode(', ', $tags);
				// 	$color = $this->custom_model->my_update(array("color" => $string),array('id' => $product_id),'product');
				// }
			}
			// else{
			// 	$color = $this->custom_model->my_update(array("color" => ''),array('id' => $product_id),'product');
			// }

			$product_data = $this->custom_model->my_where('product_trans', '*', array('id' => $product_id), array(), "", "", "", "", array(), "object");

			if ($udata[0]['group_id'] == 5) {
				// $post_data['seller_id'] = $this->mUser->id;
			}

			unset($post_data['product_show_case']);
			if ($product_data[0]->product_name != $post_data['product_name']) {
				$post_data['slug'] = $this->generate_slug($post_data['product_name'], 'product');
			}
			//$post_data['seller_id'] = $this->mUser->id;
			$count = 0;
			$count = $this->custom_model->record_count('product_trans', array('product_name' => $post_data['product_name'], 'id !=' => $product_id));
			// product dublicate
			// if ($count)
			// {
			// 	$this->system_message->set_error('Product Already present<br>Unable to Create Product');
			// }
			// else
			// {
			$post_data['image_gallery'] = trim($post_data['image_gallery'], ',');
			$attribute = isset($post_data['attribute']) ? $post_data['attribute'] : [];
			if (!empty($attribute2)) {
				$attribute = $attribute2;
			}
			if (isset($post_data['attribute'])) unset($post_data['attribute']);
			if (isset($post_data['customize_att']) && !empty($post_data['customize_att'])) {
				$customize_att = $post_data['customize_att'];
				unset($post_data['customize_att']);
			}
			// $post_data['unite']=implode(",",$post_data['unite']);
			$post_data['unite'] = $post_data['unite'];
			$response = $this->custom_model->my_update($post_data, array('id' => $product_id), 'product_trans');
			$update_into_product['sku_code'] = $post_data['sku_code'];
			$update_into_product['weight_unit'] = $post_data['weight_unit'];
			$update_into_product['category'] = $post_data['category'];
			$update_into_product['subcategory'] = $post_data['subcategory'];
			// $update_into_product['sub_sub_category']=$post_data['sub_sub_category'];
			$update_into_product['status'] = $post_data['status'];
			$update_into_product['price'] = $post_data['price'];
			$update_into_product['sale_price'] = $post_data['sale_price'];
			$update_into_product['stock_status'] = $post_data['stock_status'];
			$update_into_product['price_select'] = $post_data['price_select'];
			$update_into_product['brand'] = $post_data['brand'];
			$update_into_product['unite'] = $post_data['unite'];
			$update_into_product['min_order_quantity'] = $post_data['min_order_quantity'];
			if (isset($post_data['is_sample_order'])) {
				$update_into_product['is_sample_order'] = 1;
			} else {
				$update_into_product['is_sample_order'] = 0;
			}
			if (isset($post_data['stock'])) {
				$update_into_product['stock'] = $post_data['stock'];
			}
			if (isset($post_data['special_menu'])) {
				$update_into_product['special_menu'] = $post_data['special_menu'];
			}

			$this->custom_model->my_update($update_into_product, array('id' => $product_id), 'product');


			$this->custom_model->my_delete(['pid' => $product_id], 'product_custimze_details');
			if (!empty($customize_att)) {
				foreach ($customize_att as $askey => $asvalue) {
					$myArray = explode(',', $asvalue);

					foreach ($myArray as $asdkey => $asdvalue) {
						if ($asdkey == 0) {
							$pcustomize_title_id = $asdvalue;
							unset($asdvalue);
						} else {
							$c_data['pcustomize_title_id'] = $pcustomize_title_id;
							$c_data['pcustomize_attribute_id'] = $asdvalue;
							$c_data['pid'] = $product_id;
							// print_r($c_data);
							$this->custom_model->my_insert($c_data, 'product_custimze_details');
						}
					}
				}
			}

			$this->custom_model->my_delete(['p_id' => $product_id], 'product_attribute');
			if ($post_data['price_select'] == 2) {
				foreach ($attribute as $ak => $aval) {
					$size_id = $this->custom_model->my_where('attribute_item', 'a_id', array('id' => $aval));

					$this->custom_model->my_insert(['attribute_id' => $size_id[0]['a_id'], 'p_id' => $product_id, 'item_id' => $aval, 'price' => $attribute_price[$ak], 'sale_price' => $attribute_sale_price[$ak], 'id_size' => $attribute_id_size[$ak], 'qty' => $attribute_qty[$ak]], 'product_attribute');
					// $this->custom_model->my_insert(['attribute_id' => $size_id[0]['a_id'], 'p_id' => $product_id, 'item_id' => $aval], 'product_attribute');
				}
			}

			if ($response) {
				$this->system_message->set_success($err_msg1);
			} else {
				$this->system_message->set_error($err_msg2);
			}
			// }
			// refresh();
		}
		// multi vender comment
		// if( $udata[0]['group_id'] == 5 ){
		// 	$usrdata = $this->custom_model->my_where('admin_users','*',array('id' => $this->mUser->id));
		// 	$catdslug = $usrdata[0]['category'];
		// }
		// $acategories = $this->custom_model->my_where('category','*',array('status' => 'active'),array(),"parent","asc","","",array(),"object");
		// $acatp = array();
		// $ieq = $jeq = "";

		if ($this->mUser->id == 1) {
			$product_data = $this->custom_model->my_where('product_trans', '*', array('id' => $product_id), array(), "", "", "", "", array(), "object");
			if (empty($product_data)) {
				redirect('admin/product/list1');
			}
		} else {
			$product_data = $this->custom_model->my_where('product_trans', '*', array('id' => $product_id, 'seller_id' => $this->mUser->id), array(), "", "", "", "", array(), "object");
			if (empty($product_data)) {
				redirect('admin/product/list1');
			}
		}

		// echo "<pre>";
		// print_r($product_data);
		// die;


		// multi vender comment
		// $category = $product_data[0]->category;
		// if(!empty($acategories)){
		// 	foreach ($acategories as $ckey => $cvalue) {
		// 		$id = $cvalue->id;
		// 		if($id == $category){
		// 			$ieq = $cvalue->parent;
		// 		}
		// 		$parent = $cvalue->parent;
		// 		$acatp[$parent][] = $cvalue;
		// 	}
		// }
		// if(!empty($ieq)){
		// 	foreach ($acategories as $ckey => $cvalue) {
		// 		$id = $cvalue->id;
		// 		if($id == $ieq){
		// 			$jeq = $cvalue->parent;
		// 		}
		// 	}
		// }

		// $this->mViewData['jeq'] = $jeq;
		// $this->mViewData['ieq'] = $ieq;
		// //print_r($this->mViewData);die;
		// if( $udata[0]['group_id'] == 5 ){
		// 	foreach ($acatp[0] as $ckey => $cvalue) {
		// 		if( $catdslug != $cvalue->slug ){
		// 			unset($acatp[0][$ckey]);
		// 		}
		// 	}
		// }
		// asort($acatp);
		// $this->mViewData['acatp'] = $acatp;

		$this->mViewData['vendors'] = $this->custom_model->get_data("SELECT a.id,a.first_name FROM admin_users AS a JOIN admin_users_groups AS b ON a.id= b.user_id WHERE a.active= 1 AND b.group_id = 1 ");

		$groups = $this->ion_auth->groups()->result();
		unset($groups[0]);

		$p_attr = $this->custom_model->my_where('product_attribute', '*', ['p_id' => $product_id]);
		$patr = array();
		foreach ($p_attr as $pakey => $pavalue) {
			$patr[] = $pavalue['item_id'];
		}

		foreach ($p_attr as $pakey2 => $pavalue2) {
			$attribute_item2 = $this->custom_model->get_data_array("SELECT * FROM attribute_item WHERE id = " . $pavalue2['item_id']);
			$p_attr[$pakey2]['item_name'] = $attribute_item2[0]['item_name'];
		}
		$this->mViewData['product_attribute'] = $patr;

		$attribute = $this->custom_model->get_data("SELECT * FROM attribute");
		$attribute = json_decode(json_encode($attribute), true);
		foreach ($attribute as $key => $value) {
			$attribute_item = $this->custom_model->get_data("SELECT * FROM attribute_item WHERE  `status`='1' AND a_id = " . $value['id']);
			$attribute_item = json_decode(json_encode($attribute_item), true);
			$attribute[$key]['item'] = $attribute_item;
		}

		$this->mViewData['attribute'] = $attribute;
		$this->mViewData['p_attr'] = $p_attr;
		// echo $product_id;
		// echo "<pre>";
		// print_r($attribute);
		// echo "<pre>";
		// print_r($p_attr);
		// die;

		$category = $this->custom_model->my_where('category', '*', array('status' => 'active', 'parent' => '0'), array(), "parent", "asc", "", "", array(), "");
		$this->mViewData['category'] = $category;
		// $sub_cat = $this->custom_model->get_data_array("SELECT * FROM category WHERE `parent` != '0'  ");
		$sub_category = $this->custom_model->my_where('category', '*', array('status' => 'active', 'parent' => $product_data[0]->category), array(), "id", "asc", "", "", array(), "");

		// $sub_sub_category = $this->custom_model->my_where('category','*',array('status' => 'active','parent'=>$product_data[0]->subcategory),array(),"id","asc","","",array(),"");
		$brand_data = $this->custom_model->my_where('brand', '*', array(), array());

		$pcustomize_list = $this->custom_model->my_where('pcustomize_title', '*', array('status' => '1', 'delete_status' => '0'), array());

		if (!empty($pcustomize_list)) {
			foreach ($pcustomize_list as $dkey => $dvalue) {
				$cut_id = $dvalue['id'];
				$cus_attribute = $this->custom_model->get_data_array("SELECT name,id,price FROM pcustomize_attribute WHERE `pcus_id`='$cut_id' AND  `delete_status` = '0' ");

				$pcustomize_list[$dkey]['sub_attri'] = $cus_attribute;
			}
		}
		$sled_cus_list = array();
		$pcu_slced_list = $this->custom_model->get_data_array("SELECT `pcustomize_title_id`,`pcustomize_attribute_id` FROM `product_custimze_details` WHERE `pid` = '$product_id'");
		if (!empty($pcu_slced_list)) {
			foreach ($pcu_slced_list as $psl_key => $psl_val) {
				array_push($sled_cus_list, $psl_val['pcustomize_attribute_id']);
			}
		}

		$unit_list = $this->custom_model->get_data_array("SELECT * FROM unit_list_trans ORDER BY unit_name ASC ");

		$supplier_data = $this->custom_model->get_data_array("SELECT id,first_name FROM admin_users WHERE type='suppler' AND is_email_verify='1' ORDER BY id ASC ");

		$city_list = $this->custom_model->get_data_array("SELECT * FROM city_list ORDER BY city_name ASC ");


		// 	$selcted_subcategory="";
		// if(!empty($sub_category))
		// {
		// 	foreach ($sub_category as $sel_catkey => $sub_category) {

		// 	$selcted_subcategory = $sub_category['id'].','.$selcted_subcategory;
		// 	}
		// 	$selcted_subcategory = rtrim($selcted_subcategory,',');
		// }

		// echo "<pre>";
		// print_r($test_array);
		// print_r($pcu_slced_list);
		// print_r($pcustomize_list);
		// print_r($pcustm_seleted = explode(',',$product_data[0]->customize));
		// die;

		// $this->mViewData['sub_cat'] = $sub_cat;
		$this->mViewData['sub_category'] = $sub_category;
		// $this->mViewData['sub_sub_category'] = $sub_sub_category;
		$this->mViewData['brand_data'] = $brand_data;
		$this->mViewData['unit_list'] = $unit_list;


		$this->mViewData['edit'] = $product_data[0];

		$this->mViewData['groups'] = $groups;
		$this->mViewData['pcustomize_list'] = $pcustomize_list;
		$this->mViewData['sled_cus_list'] = $sled_cus_list;
		$this->mViewData['supplier_data'] = $supplier_data;
		$this->mViewData['seller_id'] = $this->mUser->id;

		$this->mViewData['pack_arr'] = $this->get_packaging_type();
		$this->mViewData['req_loading_arr'] = $this->get_req_loading();
		$this->mViewData['hazardous_arr'] = $this->get_hazardous();
		$this->mViewData['vehical_arr'] = $this->vehical_requirement();
		$this->mViewData['weight_unit_arr'] = $this->get_weight_unit();
		$this->mViewData['city_list'] = $city_list;
		$this->mPageTitle = $err_msg3;
		$this->mViewData['form'] = $form;

		$this->render('product/create_product');
	}



	public function csv_upload($user_id = "", $language = "")
	{
		$language = $this->uri->segment(1);
		$query = array();
		$seller_id = $this->mUser->id;
		if (empty($seller_id)) {
			redirect($language . '/admin/login');
		}

		$csvMimes = array('application/vnd.ms-excel', 'text/plain', 'text/csv', 'text/tsv');
		// echo "<pre>";
		// print_r($_FILES);
		// die;
		if (!empty($_FILES)) {
			if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)) {
				if (is_uploaded_file($_FILES['file']['tmp_name'])) {
					//open uploaded csv file with read only mode
					$csvFile = fopen($_FILES['file']['tmp_name'], 'r');

					// skip first line
					// if your csv file have no heading, just comment the next line

					fgetcsv($csvFile);
					$error = array();
					//parse data from csv file line by line
					while (($line = fgetcsv($csvFile)) !== FALSE) {
						$i = 0;
						// echo "<pre>";
						$product_name 			= $line[0];
						$tags 					= $line[1];
						$short_description 		= $line[2];
						$brand 					= $line[3];
						$category 				= $line[4];
						$subcategory 			= $line[5];
						$description 			= $line[6];
						$specification 			= $line[7];
						$unite 					= $line[8];
						$price 					= $line[9];
						$sale_price 			= $line[10];
						$min_order_quantity 	= $line[11];
						$stock 					= $line[12];
						$shipment_by 			= $line[13];
						$is_delivery_available 	= $line[14];
						$is_sample_order 		= $line[15];
						$packaging_type 		= $line[16];
						$weight 				= $line[17];
						$length 				= $line[18];
						$width 					= $line[19];
						$height 				= $line[20];
						$city 					= $line[21];
						$req_loading 			= $line[22];
						$vehical_requirement 	= $line[23];
						$is_hazardous 			= $line[24];
						$product_image 			= $line[25];
						$image_gallery 			= $line[26];

						// $seller_check = $this->custom_model->my_where('admin_users','id',array('id' => $seller_id));

						// if (empty($seller_check))
						// {
						// 	$seller_id = 1;
						// }


						$inc_data = $is_cat = $is_sub = array();

						if (!empty($seller_id)) $inc_data['seller_id'] = $seller_id;

						if (!empty($product_name)) $inc_data['product_name'] = $product_name;

						if (!empty($tags)) $inc_data['tags'] 		  = $tags;

						if (!empty($short_description)) $inc_data['short_description'] = $short_description;

						if (!empty($brand)) {
							$is_brand = $this->custom_model->my_where('brand', 'id', array('id' => $brand));
							if (!empty($is_brand)) {
								$inc_data['brand'] 			= $brand;
							}
						}

						if (!empty($category)) {
							$is_cat = $this->custom_model->my_where('category', 'id', array('id' => $category));

							if (!empty($is_cat)) {
								$inc_data['category'] 	= $category;
							}
						}

						if (!empty($category) && !empty($subcategory)) {
							$is_sub = $this->custom_model->my_where('category', 'id', array('id' => $subcategory, 'parent' => $category));

							if (!empty($is_sub)) {
								$inc_data['subcategory'] 	= $subcategory;
							}
						}

						if (!empty($description)) $inc_data['description'] = $description;
						if (!empty($specification)) $inc_data['specification'] = $specification;

						if (!empty($unite)) {
							$is_unite = $this->custom_model->my_where('unit_list', 'id', array('id' => $unite));
							if (!empty($is_unite)) {
								$inc_data['unite'] = $unite;
							}
						}


						if (!empty($price)) $inc_data['price'] = $price;
						if (!empty($sale_price)) $inc_data['sale_price'] = $sale_price;

						if (!empty($min_order_quantity)) $inc_data['min_order_quantity'] = $min_order_quantity;
						if (!empty($stock)) $inc_data['stock'] 				= $stock;

						$inc_data['stock_status'] = 'instock';
						$inc_data['price_select'] = 1;
						if ($stock == 0) {
							$inc_data['stock_status'] = 'notinstock';
						}

						if (!empty($shipment_by)) $inc_data['shipment_by'] 	= $shipment_by;

						if (!empty($is_delivery_available)) $inc_data['is_delivery_available'] = $is_delivery_available;

						if (!empty($is_sample_order)) $inc_data['is_sample_order'] = $is_sample_order;

						if (!empty($packaging_type)) {
							if (in_array($packaging_type, $this->get_packaging_type())) {
								$inc_data['packaging_type'] = $packaging_type;
							}
						}


						if (!empty($weight)) $inc_data['weight'] = $weight;

						if (!empty($length)) $inc_data['length'] = $length;

						if (!empty($width)) $inc_data['width'] = $width;

						if (!empty($height)) $inc_data['height'] = $height;

						if (!empty($city)) {
							$is_city = $this->custom_model->my_where('city_list', 'id', array('id' => $city));
							if (!empty($is_city)) {
								$inc_data['city'] = $city;
							}
						}



						if (!empty($req_loading)) {
							if (in_array($req_loading, $this->get_req_loading())) {
								$inc_data['req_loading'] = $req_loading;
							}
						}

						if (!empty($vehical_requirement)) {
							if (in_array($vehical_requirement, $this->vehical_requirement())) {
								$inc_data['vehical_requirement'] = $vehical_requirement;
							}
						}

						if (!empty($is_hazardous)) {
							if (in_array($is_hazardous, $this->get_hazardous())) {
								$inc_data['is_hazardous'] = $is_hazardous;
							}
						}

						$inc_data['is_csv'] = 1;
						$inc_data['status'] = 1;
						$inc_data['update_date'] = date('Y-m-d');

						if (!empty($product_image))
						// {
						// 	print_r($product_image);
						// 	exit();	
						// 	$is_image = $this->custom_model->my_where('product','id',array('product_image' => $product_image));

						// if(!empty($is_image))
						{
							$inc_data['product_image'] = $product_image;
						}
						// }

						$get_imags = '';
						if (!empty($image_gallery)) {
							$multiple_image = explode(',', $image_gallery);

							if (!empty($multiple_image)) {

								foreach ($multiple_image as $mkey => $mvalue) {

									// $is_image = $this->custom_model->my_where('upload_images','id',array('image' => $mvalue));

									// if(!empty($is_image))
									// {
									$get_imags = $get_imags . ',' . $mvalue;
									// }
								}

								$get_imags = trim($get_imags, ',');
								if (!empty($get_imags)) $inc_data['image_gallery'] = $get_imags;
							}
						}

						// echo "<pre>";
						// print_r($inc_data['image_gallery']);
						// die;
						// print_r($product_image);
						$image_name = '';

						//if (!empty($product_image))
						//{
						//$content = file_get_contents($product_image);
						//$image_name  = 	date('YmdHis').'.jpeg';
						//$fp = fopen(UPLOAD_BLOG_POST1.$image_name, "w");
						//fwrite($fp, $content);
						//fclose($fp);
						//}


						// if (!empty($image_gallery))
						// {
						// $multiple_image = explode(',', $image_gallery);
						// if (!empty($multiple_image))
						// {
						// $get_imags = '';
						// foreach ($multiple_image as $mkey => $mvalue)
						// {
						// $multiple_image = $mvalue;
						// $content = file_get_contents($multiple_image);

						// $random_no = mt_rand(100000,999999);

						// $multiple_image_name  = $random_no.date('YmdHis').'.jpeg';
						// $fp = fopen(UPLOAD_BLOG_POST1.$multiple_image_name, "w");
						// fwrite($fp, $content);
						//fclose($fp);
						// $get_imags[] = $multiple_image_name;
						// $a =  implode(', ', $multiple_image_name);
						// }
						// $mul_imgs = implode(',', $get_imags);
						// if(!empty($mul_imgs)) $additional_data['image_gallery'] 	= $mul_imgs;
						// }
						// }

						// if(!empty($image_name)) $inc_data['product_image'] 	= $image_name;
						// echo "<pre>";
						// print_r($is_cat);
						// print_r($inc_data);
						// exit();

						if (!empty($is_cat) && !empty($is_sub)) {
							$is_product = $this->custom_model->my_where('product', 'id', array('product_name' => $product_name, 'seller_id' => $seller_id));
							if (empty($is_product)) {
								$product_id 		= 	$this->custom_model->my_insert($inc_data, 'product');
								$product_id_trans	=	$this->custom_model->my_insert($inc_data, 'product_trans');
							} else {
								$error[$i]['error'] = $product_name . ' already into database';
							}
						} else {
							$error[$i]['error'] = 'For ' . $product_name . ' Invalid category or sub caetgory id passsed';
						}

						$i++;
					}
					//close opened csv file
					fclose($csvFile);
					if (empty($error)) {
						$this->session->set_flashdata('csv_insert', 'CSV uploded successfully');
						redirect($language . '/admin/product/list1');
					} else {
						echo "<pre>";
						print_r($error);
						echo '<a href=' . base_url($language . '/admin/product/list1') . ' class="btn btn-ifno">Back to list</a>';
						die;
					}
				}
			} else {
				$this->session->set_flashdata('csv_insert', 'Please upload csv !');
			}
		}

		redirect($language . '/admin/product/list1');
		// $user_info = $this->custom_model->my_where("admin_users","*");
		// $this->mViewData['query'] = $query;
		// $this->mViewData['user_info'] = $user_info;
		// $this->render('product/list1');
	}

	public function upload_multiple_images()
	{
		$language = $this->uri->segment(1);

		$post_data = $this->input->post();
		$seller_id = $this->mUser->id;
		if (empty($seller_id)) {
			redirect($language . '/admin/login');
		}
		// print_r($_FILES);
		// exit();
		if (!empty($_FILES)) {
			$folder_name = 'admin/products/';

			foreach ($_FILES['file']['name'] as $key => $value) {
				if (isset($_FILES['file']['name'][$key]) && $_FILES['file']['name'][$key] != '') {
					$file_name = $_FILES["file"]['name'][$key];
					$newFileName = rand(10,1000).time();
					$imageFileType = pathinfo($file_name,PATHINFO_EXTENSION);
					$newFileName = $newFileName.".".$imageFileType;
					$file_temp = $_FILES["file"]['tmp_name'][$key];
					$image_name = $this->uploads_new($newFileName, $file_temp, $folder_name);
					if ($image_name != false) {
						$inc_data = array();
						$inc_data['seller_id'] = $seller_id;
						$inc_data['image'] = $image_name;
						$response = $this->custom_model->my_insert($inc_data, 'upload_images');
					}
				}
			}
		}
		$this->session->set_flashdata('csv_insert', 'Images upload  successfully');
		redirect($language . '/admin/product/list1');
	}

	public function detete_pro()
	{
		$post_data = $this->input->post();
		if (!empty($post_data)) {
			$pid = $post_data['pid'];
			$this->custom_model->my_update(array("product_delete" => '1', 'status' => '0'), array('id' => $pid), 'product');
			$this->custom_model->my_update(array("product_delete" => '1', 'status' => '0'), array('id' => $pid), 'product_trans');
			echo 1;
			die;
		} else {
			echo 0;
			die;
		}
	}

	public function top_sold_csv_download()
	{
		$data = $this->custom_model->my_where("admin_users", "id,username,email,created_on,phone,first_name,last_name", array('id!=' => 1, 'type' => 'buyer', 'active' => 1), array(), "id", "ASC");

		$file_name = 'Active_Customer_info' . date("d-m-Y") . '.csv';


		if (!empty($data)) {
			header('Content-Type:text/csv');
			header("Content-Disposition: attachment; filename=\"$file_name\";");
			// header("Content-Disposition: attachment; filename=" );


			$str = 'Id,Username,Mobile No,Email,Date';

			$fp = fopen('php://output', 'wb');


			$i = 0;
			$header = explode(",", $str);
			fputcsv($fp, $header);

			foreach ($data as $key => $value) {
				$username  =  @$value['first_name'] . ' , ' . $value['last_name'];
				$date = date('M-d-Y', strtotime($value['created_on']));
				$DATACSV[] = $value['id'];
				$DATACSV[] = $username;
				$DATACSV[] = $value['phone'];
				$DATACSV[] = $value['email'];
				$DATACSV[] = $date;

				fputcsv($fp, $DATACSV);
				$DATACSV = array();
			}
		} else {
			$lang['ALERT'] = " No data found";
			echo "<script>alert('" . $lang['ALERT'] . "')</script>";
		}
		die;
	}

	public function get_subcategory_data()
	{
		$language = $this->uri->segment(1);

		$post_data = $this->input->post();
		if (!empty($post_data)) {
			// echo "<pre>";
			// print_r($language);die;
			if ($language == 'en') {
				$category = $this->custom_model->my_where('category', 'id,display_name', array('parent' => $post_data['cat_id'], 'status' => 'active'));
			} else {
				$category = $this->custom_model->my_where('category_trans', 'id,display_name', array('parent' => $post_data['cat_id'], 'status' => 'active'));
			}
			if (!empty($category)) {
				echo json_encode($category);
				die;
			} else {
				echo "not_found";
				die;
			}
			// echo "<pre>";
			// print_r($category);
			// die;
		} else {
			echo 0;
			die;
		}
	}

	// this for show most user view product
	public function most_pro()
	{
		$most_product_view = $this->custom_model->get_data_array("SELECT id,user_view,api_flag,product_image,product_name FROM `product` WHERE user_view >2 order by user_view desc	 ");
		$this->mViewData['most_product_view'] = $most_product_view;
		// echo "<pre>";
		// print_r($most_product_view);
		// die;
		$this->mPageTitle = 'Most Products View';
		$this->render('product/most_pro');
	}

	public function csv_dwonload($api_flag = '')
	{
		// $api_flag=2;
		$seller_id = $this->mUser->id;
		$query = 'id,product_name,product_image,sale_price';
		if ($api_flag == 2) {
			$url = base_url('admin/product/list1');
			$file_name = 'our_product_' . date("d-m-Y") . '.csv';
			$data = $this->custom_model->my_where("product", $query, array('seller_id=' => $seller_id), array(), "id", "DESC");
		} else {
			// this for show most user view product
			$url = base_url('admin/product/most_pro');
			$file_name = 'most_view_' . date("d-m-Y") . '.csv';
			$data = $this->custom_model->get_data_array("SELECT $query FROM `product` WHERE user_view >2 order by user_view desc ");
		}
		// echo "<pre>";
		// print_r($data);
		// die;


		if (!empty($data)) {
			header('Content-Type:text/csv');
			header("Content-Disposition: attachment; filename=\"$file_name\";");
			// header("Content-Disposition: attachment; filename=" );


			$str = 'Product id,Product Name,Product Image,Price';

			$fp = fopen('php://output', 'wb');


			$i = 0;
			$header = explode(",", $str);
			fputcsv($fp, $header);

			foreach ($data as $key => $value) {

				// $date=date('M-d-Y' ,strtotime($value['order_datetime']));
				$DATACSV[] = $value['id'];
				$DATACSV[] = $value['product_name'];
				$DATACSV[] = $value['product_image'];
				$DATACSV[] = $value['sale_price'];

				fputcsv($fp, $DATACSV);
				$DATACSV = array();
			}
		} else { ?>
			<script>
				alert("No data found")
				url = "<?php echo $url ?>";
				setTimeout(function() {
					window.location = url;
				}, 2000);
			</script>

<?php }
		die;
		// $lang['ALERT'] =" No data found";
	}



	public function cat_data()
	{
		$language = $this->uri->segment(1);
		// echo "<pre>";
		// print_r($_SERVER['HTTP_REFERER']);
		// echo $language; // outputs "en"
		// print_r($language);
		// exit();

		// $url = $_SERVER['HTTP_REFERER'];
		// $path = parse_url($url, PHP_URL_PATH); // gets the path component of the URL
		// $parts = explode('/', $path); // splits the path into an array of parts
		// $language = $parts[1]; // the language code is the second part of the path
		
		if ($language == 'en') {
			$category_listing = $this->custom_model->my_where("category", "id,display_name", array("parent" => '0', 'status' => 'active'));
		} else {
			$category_listing = $this->custom_model->my_where("category_trans", "id,display_name", array("parent" => '0', 'status' => 'active'));
		}
		// $category_listing = $this->custom_model->my_where("category","id,display_name",array("parent" => '0', 'status'=>'active' ) );

		if ($category_listing) {
			foreach ($category_listing as $key => $value) {
				echo "<span class='first' style='margin-left: 3%;display: block;border: 1px solid #4e924edd;margin-bottom: 10px;padding: 10px;'>";
				$data = lang('Main').'-->' . $value['id'] . ' . ' . $value['display_name'];
				echo $data;

				$main_id = $value['id'];
				if (!empty($main_id)) {
					if ($language == 'en') {
						$s_listing = $this->custom_model->my_where("category", "id,display_name", array("parent" => $main_id));
					} else {
						$s_listing = $this->custom_model->my_where("category_trans", "id,display_name", array("parent" => $main_id));
					}	
					if (!empty($s_listing)) {

						echo "<p class='asdasd' style='margin-left: 4%;'>";
						foreach ($s_listing as $skey => $vsalue) {
							$sub_id = $vsalue['id'];
							// $sdata = $vsalue['id'].' :- '.$vsalue['display_name'];
							$sdata = lang('Sub').'-->' . $vsalue['id'] . ' . ' . $vsalue['display_name'];

							echo $sdata;
							echo "<br>";
							echo "<br>";
							if ($language == 'en') {
								$ss_listing = $this->custom_model->my_where("category", "id,display_name", array("parent" => $sub_id));
							} else {
								$ss_listing = $this->custom_model->my_where("category_trans", "id,display_name", array("parent" => $sub_id));
							}	
							// echo "<pre>";
							// print_r($ss_listing);
							// die;

							if (!empty($ss_listing)) {
								echo "<span class='subbbb' style='margin-left: 7%;display: block;'>";
								foreach ($ss_listing as $sskey => $ssvalue) {
									// $sss = $ssvalue['id'].' :- '.$ssvalue['display_name'];
									$sss = 'Sub Sub --> ' . $ssvalue['id'] . ' . ' . $ssvalue['display_name'];
									echo $sss;
									echo "<br>";
								}
								echo "<br>";
								echo "</span>";
							}
						}
						echo "</p>";
					}
				}
				echo "</span>";
			}
		}

		if ($language == 'en') {
			$unit_list = $this->custom_model->get_data_array(" SELECT * FROM unit_list ORDER BY id ASC ");
		} else {
			$unit_list = $this->custom_model->get_data_array(" SELECT * FROM unit_list_trans ORDER BY id ASC ");
		}	
		if (!empty($unit_list)) {
			echo "<span class='first' style='margin-left: 3%;display: block;border: 1px solid #4e924edd;margin-bottom: 10px;padding: 10px;'>". lang('Unit') . '-->' ;
			foreach ($unit_list as $key => $val) {
				echo "<p class='asdasd' style='margin-left: 4%;'>" . $val['id'] . " . " . $val['unit_name'] . "</p>";
			}
			echo "</span>";
		}

		$city_list = $this->custom_model->get_data_array(" SELECT * FROM city_list ORDER BY id ASC ");
		$city_trans = $this->custom_model->get_data_array(" SELECT * FROM city_trans ORDER BY id ASC ");


		if (!empty($city_list)) {
			echo "<span class='first' style='margin-left: 3%;display: block;border: 1px solid #4e924edd;margin-bottom: 10px;padding: 10px;'> City List -->";
			foreach ($city_list as $key => $val) {
				echo "<p class='asdasd' style='margin-left: 4%;'>" . $val['id'] . " . " . $val['city_name'] . " | " . $city_trans[$key]['city_name']. "</p>";
			}
			echo "</span>";
		}

		$pack_arr = $this->get_packaging_type();
		$req_loading_arr = $this->get_req_loading();
		$get_hazardous = $this->get_hazardous();
		$vehical_requirement = $this->vehical_requirement();
		// $vehical_requirement = $this->vehical_requirement();
		// echo "<pre>";
		// print_r($vehical_requirement);
		// die;
		if (!empty($pack_arr)) {
			echo "<span class='first' style='margin-left: 3%;display: block;border: 1px solid #4e924edd;margin-bottom: 10px;padding: 10px;'> Packaging Type -->";
			foreach ($pack_arr as $key => $val) {
				echo "<p class='asdasd' style='margin-left: 4%;'>" . $val . "</p>";
			}
			echo "</span>";
		}

		if (!empty($req_loading_arr)) {
			echo "<span class='first' style='margin-left: 3%;display: block;border: 1px solid #4e924edd;margin-bottom: 10px;padding: 10px;'> Requirement for Loading -->";
			foreach ($req_loading_arr as $key => $val) {
				echo "<p class='asdasd' style='margin-left: 4%;'>" . $val . "</p>";
			}
			echo "</span>";
		}

		if (!empty($get_hazardous)) {
			echo "<span class='first' style='margin-left: 3%;display: block;border: 1px solid #4e924edd;margin-bottom: 10px;padding: 10px;'> Is this Hazardous material -->";
			foreach ($get_hazardous as $key => $val) {
				echo "<p class='asdasd' style='margin-left: 4%;'>" . $val . "</p>";
			}
			echo "</span>";
		}

		if (!empty($vehical_requirement)) {
			echo "<span class='first' style='margin-left: 3%;display: block;border: 1px solid #4e924edd;margin-bottom: 10px;padding: 10px;'> Vehicle Requirement -->";
			foreach ($vehical_requirement as $key => $val) {
				echo "<p class='asdasd' style='margin-left: 4%;'>" . $val . "</p>";
			}
			echo "</span>";
		}
	}


	public function uploads_new($file_name, $file_temp, $folder_name)
	{
		if (isset($file_name)) {
			// $upload_dir = ASSETS_PATH . "/admin/usersdata/";
			$upload_dir = ASSETS_PATH . $folder_name;
			if (!file_exists($upload_dir)) {
				mkdir($upload_dir, 0777, true);
			}
			// $file_name    = $FILES['name'];
			// $random_digit = rand(0000, 999);
			// $random_digit = md5(time()).$random_digit;

			$target_file  = $upload_dir . basename($file_name);
			$ext          = pathinfo($target_file, PATHINFO_EXTENSION);

			// $new_file_name = $random_digit . "." . $ext;
			$file_name_without_ex = basename($file_name, '.' . $ext);
			$file_name_without_ex = $this->get_slug($file_name_without_ex);
			$new_file_name = $this->is_file($upload_dir, $file_name_without_ex, $ext);

			$new_file_name = $new_file_name . "." . $ext;
			$path          = $upload_dir . $new_file_name;
			if (move_uploaded_file($file_temp, $path)) {
				return $new_file_name;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function is_file($upload_dir, $file_name_without_ex, $ext)
	{
		// this funtion is used to check file exists if yes then genrate new file name
		$path = $upload_dir . $file_name_without_ex . "." . $ext;
		if (file_exists($path)) {
			$random_digit = mt_rand(2, 99);
			$file_name_without_ex = $file_name_without_ex . $random_digit;
			$this->is_file($upload_dir, $file_name_without_ex, $ext);
		}
		return $file_name_without_ex;
	}

	public function get_slug($title)
	{
		$slug = preg_replace("/-$/", "", preg_replace('/[^a-z0-9]+/i', "-", strtolower($title)));
		return $slug;
	}

	public function uploaded_image($rowno = 0, $ajax = 'call', $serach = '')
	{
		$language = $this->uri->segment(1);
		if ($language == 'en') {
			$err_msg1 = 'Image List';
		} else {
			$err_msg1 = 'Image List';
		}

		$this->load->library('pagination');

		$post_data = $this->input->post();

		if (!empty($post_data)) {
			$rowno = $post_data['pagno'];
			$ajax 	= $post_data['ajax'];
			$serach = $post_data['serach'];
		}
		// Row per page
		$rowperpage = 25;
		$page_no = 0;

		// Row position
		if ($rowno != 0) {
			$page_no = $rowno;
			$rowno = ($rowno - 1) * $rowperpage;
		}
		if ($ajax == 'call') {
			$image_data = $this->custom_model->get_data_array("SELECT * FROM upload_images WHERE seller_id=" . $this->mUser->id . " ORDER BY id DESC limit $rowno,$rowperpage ");

			$image_count = $this->custom_model->get_data_array("SELECT COUNT(id) as image_count FROM upload_images WHERE seller_id=" . $this->mUser->id . " ORDER BY id DESC  ");
		} else {
			if (empty($serach)) {
				$image_data = $this->custom_model->get_data_array("SELECT * FROM upload_images WHERE seller_id=" . $this->mUser->id . " ORDER BY id DESC limit $rowno,$rowperpage ");

				$image_count = $this->custom_model->get_data_array("SELECT COUNT(id) as image_count FROM upload_images WHERE seller_id=" . $this->mUser->id . " ORDER BY id DESC  ");
			} else {

				$image_data = $this->custom_model->get_data_array("SELECT * FROM upload_images WHERE (image LIKE '%$serach%' OR id LIKE '%$serach%') AND seller_id=" . $this->mUser->id . " ORDER BY id DESC limit $rowno,$rowperpage ");

				$image_count = $this->custom_model->get_data_array("SELECT COUNT(id) as brand_count FROM upload_images WHERE (image LIKE '%$serach%' OR id LIKE '%$serach%') AND seller_id=" . $this->mUser->id . " ORDER BY id DESC  ");
			}
		}


		// if(!empty($blog_data))
		// {
		// 	foreach ($blog_data as $bd_key => $bd_val)
		// 	{
		// 		$blog_data[$bd_key]['created_date']=date('M-d-Y' ,strtotime($bd_val['created_date']));
		// 	}
		// }


		// echo "<pre>";
		// print_r($image_data);
		// die;
		$config['base_url'] = base_url() . 'admin/product/index';
		$config['use_page_numbers'] = TRUE;
		$config['total_rows'] = $image_count[0]['image_count'];
		$config['per_page'] = $rowperpage;
		$config['page_query_string'] = FALSE;
		$config['enable_query_strings'] = FALSE;
		$config['reuse_query_string']  = FALSE;
		$config['cur_page'] = $page_no;

		// Initialize
		$this->pagination->initialize($config);
		// Initialize $data Array
		$data['pagination'] = $this->pagination->create_links();
		$data['result'] = $image_data;
		$data['row'] = $rowno;
		$data['total_rows'] = $image_count[0]['image_count'];
		// $this->mViewData['pagination'] = $this->pagination->create_links();
		// this for when page load
		if ($ajax == 'call' && $rowno == 0 && empty($post_data)) {
			$this->mViewData['pagination'] = $this->pagination->create_links();
		} elseif ($serach != '') {  // this for search button pagination
			echo json_encode($data);
			exit;
		} else { // this for pagination-
			echo json_encode($data);
			exit;
		}

		// echo "<Pre>";
		// print_r($brand_data);
		// die;
		$this->mPageTitle = $err_msg1;
		$this->mViewData['image_data'] = $image_data;
		$this->mViewData['seller_id'] = $this->mUser->id;
		$this->render('product/uploaded_image_list');
	}
}

?>