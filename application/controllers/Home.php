<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Home page
 */
class Home extends MY_Controller
{

	public function __construct()
	{
		$this->load->model('User_model');
		$this->load->model('admin/Custom_model', 'custom_model');
	}

	public function index()
	{
		// exit();
		$banner_data = $this->custom_model->get_data_array("SELECT * FROM banner WHERE status='active' ORDER BY id DESC ");
		$language = $this->uri->segment(1);
		if ($language == "en") {
			$product = "product";
			$category = "category";
			$brand = "brand";
			$banner = "banner";
			$unit_list = "unit_list";
		} else {
			$product = "product_trans";
			$category = "category_trans";
			$brand = "brand";
			$banner = "banner_trans";
			$unit_list = "unit_list_trans";
		}
		$banner_data = $this->custom_model->get_data_array("SELECT * FROM $banner WHERE status='active' ORDER BY id DESC ");
		// echo "<pre>";
		// print_r($banner_data);
		// die;
		// $product_data =$this->custom_model->get_data_array("SELECT id,product_name,category,subcategory,description,short_description,price,sale_price,stock_status,stock,product_image,status,price_select,brand,unite FROM `$product` WHERE product_delete!='1' order by id desc ");

		$sub_query = " WHERE pro.product_delete!='1'  AND admin.is_terminate='0' AND pro.status='1'  ";
		$order_by = ' order by pro.id desc limit 12 ';
		$product_data = $this->custom_model->get_data_array("SELECT pro.id,pro.product_name,pro.category,pro.seller_id,pro.subcategory,pro.price,pro.sale_price,pro.stock_status,pro.stock,pro.product_image,pro.status,pro.price_select,pro.brand,pro.unite,pro.min_order_quantity FROM $product as pro INNER JOIN admin_users as admin ON pro.seller_id=admin.id $sub_query $order_by ");

		$product_data = $this->related_menu($product_data, $language);
		$product_data = $this->is_wishlist($product_data);
		$product_data = $this->is_compare($product_data);

		// echo '<pre>';
		// print_r($product_data);
		// die;

		$featured_data = $this->custom_model->get_data_array("SELECT pro.id,pro.product_name,pro.category,pro.subcategory,pro.price,pro.sale_price,pro.stock_status,pro.stock,pro.product_image,pro.status,pro.price_select,pro.brand,pro.unite,pro.min_order_quantity FROM $product as pro INNER JOIN admin_users as admin ON pro.seller_id=admin.id $sub_query GROUP by pro.category ORDER BY RAND() limit 12 ");

		$featured_data = $this->related_menu($featured_data, $language);
		$featured_data = $this->is_wishlist($featured_data);
		$featured_data = $this->is_compare($featured_data);

		// echo "<pre>";
		// print_r($featured_data);
		// die;

		$best_seller = $this->custom_model->get_data_array(" SELECT pro.id,pro.product_name,pro.category,pro.subcategory,pro.price,pro.sale_price,pro.stock_status,pro.stock,pro.product_image,pro.status,pro.price_select,pro.brand,pro.unite,pro.min_order_quantity,COUNT(orderit.item_id) as pro_count FROM $product as pro JOIN admin_users as admin ON pro.seller_id=admin.id  JOIN order_items as orderit   ON orderit.product_id = pro.id $sub_query  GROUP by product_id HAVING COUNT(orderit.item_id) > 1 ORDER BY orderit.product_id DESC limit 12 ");

		if (!empty($best_seller)) {
			usort($best_seller, function ($a, $b) {
				return $a['pro_count'] - $b['pro_count'];
			});

			$best_seller = $this->related_menu($best_seller, $language);
			$best_seller = $this->is_wishlist($best_seller);
			$best_seller = $this->is_compare($best_seller);
		}


		// $unit_list_data = $this->custom_model->get_data_array("SELECT * FROM $unit_list ORDER BY unit_name ASC ");
		// $this->mViewData['unit_list_data'] =$unit_list_data;

		$currency = $this->return_currency_name();
		$currency_symbol = $this->return_currency_symbol($currency, $language);

		$product_advertise = $this->custom_model->get_data_array("SELECT product_id FROM product_advertise Order by id desc ");

		$adds_product = array();
		if (!empty($product_advertise)) {
			$add_ids = '';
			foreach ($product_advertise as $key => $val) {
				$add_ids = $add_ids . ',' . $val['product_id'];
			}
			$add_ids = ltrim($add_ids, ',');

			$sub_query = " WHERE pro.product_delete!='1'  AND admin.is_terminate='0' AND pro.status='1' AND pro.id IN ($add_ids)  ";
			$order_by = ' order by pro.id desc';
			$adds_product = $this->custom_model->get_data_array("SELECT pro.id,pro.product_name,pro.category,pro.subcategory,pro.price,pro.sale_price,pro.stock_status,pro.stock,pro.product_image,pro.status,pro.price_select,pro.brand,pro.unite,pro.min_order_quantity FROM $product as pro INNER JOIN admin_users as admin ON pro.seller_id=admin.id $sub_query $order_by ");

			$adds_product = $this->related_menu($adds_product, $language);
			$adds_product = $this->is_wishlist($adds_product);
			$adds_product = $this->is_compare($adds_product);
		}

		$this->mViewData['banner_data'] = $banner_data;
		$this->mViewData['product_data'] = $product_data;
		$this->mViewData['best_seller'] = $best_seller;
		$this->mViewData['featured_data'] = $featured_data;
		$this->mViewData['currency_symbol'] = $currency_symbol;
		$this->mViewData['product_advertise'] = $product_advertise;
		$this->mViewData['adds_product'] = $adds_product;
		$this->Urender('index', 'udefault');
	}
	// public function landingPage(){
	// 	$this->Urender('landing_page', 'udefault');
	//  }

	public function listing($m_catid = '', $s_catid = '')
	{
		$language = $this->uri->segment(1);
		$order_by = ' order by pro.id desc ';
		$s_cat = '';
		$ajax = '';
		$search = '';
		$rowno = 0;
		$s_catids = array();
		if ($language == "en") {
			$product = "product";
			$category = "category";
			$brand = "brand";
			$unit_list = "unit_list";
		} else {
			$product = "product_trans";
			$category = "category_trans";
			$brand = "brand_trans";
			$unit_list = "unit_list_trans";
		}
		$get_data = $this->input->get();
		if (!empty($get_data)) {
			$m_catid = $get_data['m_catid'];
			$search = $get_data['search'];
		}
		$post_data = $this->input->post();
		if (!empty($post_data)) {
			$m_catid = $post_data['m_catid'];
			$s_catid = $post_data['s_catid'];
			$search = $post_data['search'];
			$ajax = $post_data['ajax'];
			if (isset($post_data['pageno'])) {
				$rowno = $post_data['pageno'];
			}
			$sort = $post_data['sort'];
			if ($sort == 'asc') {
				$order_by = ' order by pro.sale_price ASC ';
			} else if ($sort == 'desc') {
				$order_by = ' order by pro.sale_price DESC ';
			}
			if (isset($post_data['brand_id']) && !empty($post_data['brand_id'])) {
				$brand_id = $post_data['brand_id'];
				$brand_id = $this->return_string_query($brand_id);
				$s_cat .= " AND pro.brand IN($brand_id) ";
			}

			if (isset($post_data['min_order_q']) && !empty($post_data['min_order_q'])) {
				$min_order_q = $post_data['min_order_q'];
				$s_cat .= " AND pro.min_order_quantity='$min_order_q' ";
			}

			if (isset($post_data['min_price']) && !empty($post_data['min_price']) && isset($post_data['max_price']) && !empty($post_data['max_price'])) {
				$min_price = $post_data['min_price'];
				$max_price = $post_data['max_price'];
				$s_cat .= " AND pro.sale_price BETWEEN $min_price AND $max_price ";
			}

			if (isset($post_data['sample_order']) && !empty($post_data['sample_order'])) {
				$s_cat .= " AND pro.is_sample_order!=0 ";
			}

			if (isset($post_data['s_catids']) && !empty($post_data['s_catids'])) {
				$s_catids = $post_data['s_catids'];
				$s_catids_ids = $this->return_string_query($s_catids);
				$s_cat .= " AND pro.subcategory IN($s_catids_ids) ";
			}
			// echo "<pre>";
			// print_r($post_data);
			// die;
		}
		if (!empty($m_catid)) {
			$s_cat .= ' AND pro.category=' . $m_catid;
		}

		if (!empty($s_catid)) {
			$s_cat .= ' AND pro.subcategory=' . $s_catid;
		}

		$single_category = $this->custom_model->my_where($category, "*", array('id' => $m_catid, 'status' => 'active'));

		$subcategory_data = $this->custom_model->my_where($category, "id,display_name", array('parent' => $m_catid, 'status' => 'active'));
		// echo "<pre>";
		// print_r($single_category);
		// die;
		$rowperpage = 6;

		if ($rowno != 0) {
			$page_no = $rowno;
			$rowno = ($rowno - 1) * $rowperpage;
		} else {
			$page_no = $rowno;
			$rowno = 0;
		}
		if (!empty($search)) {
			$s_cat .= " AND  (pro.product_name LIKE '%$search%' OR pro.short_description LIKE '%$search%' OR pro.tags LIKE '%$search%')";
		}

		$sub_query = " WHERE pro.product_delete!='1' AND admin.is_terminate='0' AND pro.status='1'  ";
		// $order_by=' order by pro.id desc ';

		$product_data = $this->custom_model->get_data_array("SELECT pro.id,pro.product_name,pro.category,pro.subcategory,pro.price,pro.sale_price,pro.stock_status,pro.stock,pro.product_image,pro.status,pro.price_select,pro.brand,pro.unite,pro.min_order_quantity FROM $product as pro INNER JOIN admin_users as admin ON pro.seller_id=admin.id $sub_query $s_cat $order_by  limit $rowno,$rowperpage");
		// echo $this->db->last_query();
		// die;
		// limit $rowno,$rowperpage
		$product_count = $this->custom_model->get_data_array("SELECT count(pro.id) as product_count FROM $product as pro INNER JOIN admin_users as admin ON pro.seller_id=admin.id $sub_query $s_cat $order_by");

		$product_data = $this->related_menu($product_data, $language);
		$product_data = $this->is_wishlist($product_data);
		$product_data = $this->is_compare($product_data);

		// echo "<pre>";
		// print_r($product_data);
		// die;

		$this->load->library('pagination');

		$config['base_url'] = base_url('home/listing/');
		$config['total_rows'] = $product_count[0]['product_count'];
		$config['per_page'] = $rowperpage;
		$config['page_query_string'] = FALSE;
		$config['enable_query_strings'] = FALSE;
		$config['reuse_query_string'] = FALSE;
		$config['cur_page'] = $page_no;
		$config['attributes'] = array('class' => 'page-link');
		// echo "<pre>";
		// print_r($config);
		// die;
		$this->pagination->initialize($config);

		//  $unit_list_data = $this->custom_model->get_data_array("SELECT * FROM $unit_list ORDER BY unit_name ASC ");
		// $this->mViewData['unit_list_data'] =$unit_list_data;

		if (!empty($ajax)) {
			$data['pagination'] = $this->pagination->create_links();
			$data['result'] = $this->return_html($product_data, $language, $inc_count = 18);
			// $data['result'] = '';
			$data['row'] = $rowno;
			$data['banner_image'] = base_url('assets/admin/category/') . @$single_category[0]['banner_image'];
			$data['rowperpage'] = $rowperpage;
			$data['total_rows'] = $product_count[0]['product_count'];
			$data['subcat_html'] = $this->get_subcat_html($subcategory_data, $s_catids);
			echo json_encode($data);
			die;
		}
		// echo "1212<pre>";
		// echo $this->pagination->create_links();
		// die;

		$this->mViewData['pagination'] = $this->pagination->create_links();
		$this->mViewData['row'] = $rowno;
		$this->mViewData['rowperpage'] = $rowperpage;
		$this->mViewData['total_rows'] = $product_count[0]['product_count'];

		$this->mViewData['product_data'] = $product_data;

		$currency = $this->return_currency_name();
		$currency_symbol = $this->return_currency_symbol($currency, $language);

		$brand_data = $this->custom_model->get_data_array("SELECT id,brand_name FROM $brand ORDER BY brand_name ASC ");
		// echo "<pre>";
		// print_r($subcategory_data);
		// die;
		// $this->mViewData['product_data'] =$product_data;
		$this->mViewData['single_category'] = $single_category;
		$this->mViewData['m_catid'] = $m_catid;
		$this->mViewData['s_catid'] = $s_catid;
		$this->mViewData['search'] = $search;
		$this->mViewData['currency_symbol'] = $currency_symbol;
		$this->mViewData['brand_data'] = $brand_data;
		$this->mViewData['subcategory_data'] = $subcategory_data;
		$this->Urender('listing', 'udefault');

	}

	public function return_string_query($car_model)
	{
		$stirng = "";
		foreach ($car_model as $key => $cm_val) {
			$stirng .= "'$cm_val',";
		}
		$stirng = rtrim($stirng, ',');
		return $stirng;
	}

	public function get_subcat_html($subcategory_data, $s_catids)
	{
		$return_html = '';
		if (!empty($subcategory_data)) {
			foreach ($subcategory_data as $sscd_key => $sscd_val) {
				$checked = '';
				if (in_array($sscd_val['id'], $s_catids)) {
					$checked = 'checked';
				}
				$return_html .= '<div class="custom-control custom-checkbox collection-filter-checkbox">';
				$return_html .= '<input type="checkbox" class="custom-control-input class_click2" name="s_catids" id="s_catids' . $sscd_key . '" value="' . $sscd_val['id'] . '" ' . $checked . '>';
				$return_html .= '<label class="custom-control-label" for="s_catids' . $sscd_key . '">' . $sscd_val['display_name'] . '</label>';
				$return_html .= '</div>';
			}
		}
		return $return_html;
	}

	public function detail($pid = '')
	{

		$language = $this->uri->segment(1);
		if ($language == "en") {
			$product = "product";
			$category = "category";
			$brand = "brand";
			$unit_list = "unit_list";
		} else {
			$product = "product_trans";
			$category = "category_trans";
			$brand = "brand";
			$unit_list = "unit_list_trans";
		}

		$sub_query = " WHERE pro.product_delete!='1' AND admin.is_terminate='0' AND pro.status='1' AND pro.id='$pid'  ";
		$order_by = ' order by pro.id desc ';
		$product_detail = $this->custom_model->get_data_array("SELECT pro.*,admin.first_name FROM $product as pro INNER JOIN admin_users as admin ON pro.seller_id=admin.id $sub_query $order_by ");

		$product_detail = $this->related_menu($product_detail, $language, true);
		$product_detail = $this->is_wishlist($product_detail);
		$product_detail = $this->is_compare($product_detail);
		$interested_in = $similar_products = array();
		if (empty($product_detail)) {
			redirect($language);
		} else {
			// $seller_details = $this->custom_model->my_where('admin_users',"first_name",array('id' => $product_detail[0]['seller_id']));
			// $product_detail[0]['first_name']=$seller_details[0]['first_name'];
			$sub_query = " WHERE pro.product_delete!='1' AND admin.is_terminate='0' AND pro.status='1' AND pro.subcategory='" . $product_detail[0]['subcategory'] . "' AND pro.id!='$pid'  ";
			$order_by = ' order by pro.id desc LIMIT 10 ';

			$interested_in = $this->custom_model->get_data_array("SELECT pro.id,pro.product_name,pro.category,pro.subcategory,pro.price,pro.sale_price,pro.stock_status,pro.stock,pro.product_image,pro.status,pro.price_select,pro.brand,pro.unite,pro.min_order_quantity FROM $product as pro INNER JOIN admin_users as admin ON pro.seller_id=admin.id $sub_query $order_by ");

			$interested_in = $this->related_menu($interested_in, $language);
			$interested_in = $this->is_wishlist($interested_in);
			$interested_in = $this->is_compare($interested_in);

			$sub_query = " WHERE pro.product_delete!='1' AND admin.is_terminate='0' AND pro.status='1' AND pro.category='" . $product_detail[0]['category'] . "' AND pro.id!='$pid'  ";
			$order_by = ' order by pro.id desc LIMIT 10 ';

			$similar_products = $this->custom_model->get_data_array("SELECT pro.id,pro.product_name,pro.category,pro.subcategory,pro.price,pro.sale_price,pro.stock_status,pro.stock,pro.product_image,pro.status,pro.price_select,pro.brand,pro.unite,pro.min_order_quantity FROM $product as pro INNER JOIN admin_users as admin ON pro.seller_id=admin.id $sub_query $order_by ");

			$similar_products = $this->related_menu($similar_products, $language);
			$similar_products = $this->is_wishlist($similar_products);
			$similar_products = $this->is_compare($similar_products);
		}
		// echo "<pre>";
		// print_r($product_detail);
		// die;
		// $unit_list_data = $this->custom_model->get_data_array("SELECT * FROM $unit_list ORDER BY unit_name ASC ");
		//  $this->mViewData['unit_list_data'] =$unit_list_data;

		$user_review = $this->custom_model->my_where("user_rating", "*", array('pid' => $pid, 'status' => '1'));
		if (!empty($user_review)) {
			foreach ($user_review as $ur_key => $ur_val) {
				$user_review[$ur_key]['rating_element'] = $this->rating_element($ur_val['rating']);
			}
		}
		// echo "<pre>";
		// print_r($user_review);
		// print_r($product_detail);
		// die;
		$this->mViewData['product_detail'] = $product_detail;
		$currency = $this->return_currency_name();
		$currency_symbol = $this->return_currency_symbol($currency, $language);
		$this->mViewData['currency'] = $currency;
		$this->mViewData['currency_symbol'] = $currency_symbol;
		$this->mViewData['user_review'] = $user_review;
		$this->mViewData['interested_in'] = $interested_in;
		$this->mViewData['similar_products'] = $similar_products;
		$this->Urender('detail', 'udefault');
	}

	public function view_cart($ajax = '')
	{

		$language = $this->uri->segment(1);
		if ($language == "en") {
			$product = "product";
			$unit_list = "unit_list";
		} else {
			$product = "product_trans";
			$unit_list = "unit_list_trans";
		}
		$data = $adata = array();

		$uid = $this->session->userdata('uid');
		$attp = array();
		$attc = array();
		$tax_table = $this->custom_model->my_where('tax', '*', array());
		$currency = $this->return_currency_name();
		$currency_symbol = $this->return_currency_symbol($currency, $language);

		if (!empty($uid)) {
			$is_data = $this->custom_model->my_where('my_cart', '*', array('user_id' => $uid, 'meta_key' => 'cart'));
			$this->session->set_userdata('content', ((!empty($is_data)) ? $is_data[0]['content'] : array()));
		} else {
			if ($language == 'en') {
				$this->session->set_flashdata('login_message', 'Please Login Or Create Account!!');
			} else {
				$this->session->set_flashdata('login_message', 'الرجاء الدخول لإنشاء حساب');
			}
			redirect($language);
		}
		// echo "<pre>";

		if (!empty($this->session->userdata('content'))) {
			$this->session->userdata('content');
			$content = unserialize($this->session->userdata('content'));
			// echo '<pre>';
			// print_r($content);
			// die;
			if (!empty($content)) {
				unset($content['cart_qty']);
				foreach ($content as $key => $value) {
					if (empty($value['pid'])) {
						$_POST['pid'] = $value['pid'];
						if (!empty($uid))
							$_POST['uid'] = $uid;
						$this->remove_from_cart(false);
						$_POST[] = array();
						continue;
					}
					// 		echo '<pre>';
					// print_r($content);
					// die;


					$curr = $this->custom_model->my_where($product, 'id,product_name,price,sale_price,stock_status,stock,product_image,status,price_select,unite', array('id' => $value['pid']));

					// echo "<pre>";
					// print_r($curr);
					// die;
					if (isset($value['metadata']) && $curr[0]['price_select'] == 2) {
						if ($curr[0]['status'] == 0) {
							$_POST['pid'] = $key;
							if (!empty($uid))
								$_POST['uid'] = $uid;
							$this->add_to_wish_list(false);
							$this->remove_from_cart(false);
							$adata['error'][$key] = $curr[0]['product_name'];
							continue;
						}
						if (isset($value['metadata'])) {
							if (!empty($value['metadata'])) {

								$product_attribute = $this->custom_model->my_where('product_attribute', '*', array('item_id' => $value['metadata']['attribute_item_id'], 'p_id' => $value['pid']));
								$meta_avil_qty = $product_attribute[0]['qty'];


								if ($meta_avil_qty == 0 || $meta_avil_qty <= 0) {
									$_POST['pid'] = $key;
									if (!empty($uid))
										$_POST['uid'] = $uid;
									$this->add_to_wish_list(false);
									$this->remove_from_cart(false);
									$adata['error'][$key] = $curr[0]['product_name'];
									continue;
								}
								// if cart quantity grather than avalilable quantity then set to avalilable quantity
								if ($value['qty'] > $meta_avil_qty) {
									$value['qty'] = $meta_avil_qty;
									$this->load->library('user_account');
									// $this->user_account->update_catqty($content,$key,$curr[0]['stock']);
									$this->user_account->update_catqty($content, $key, $meta_avil_qty);
								}


							}
						}
					} else {
						if ($curr[0]['stock_status'] == 'notinstock' || $curr[0]['stock'] == 0 || $curr[0]['stock'] <= 0 || $curr[0]['status'] == 0) {
							// $_POST['pid'] = $value['pid'];
							$_POST['pid'] = $key;
							if (!empty($uid))
								$_POST['uid'] = $uid;
							// echo '132';
							// die;
							$this->add_to_wish_list(false);
							$this->remove_from_cart(false);
							$adata['error'][$key] = $curr[0]['product_name'];
							continue;
						}
						// if cart quantity grather than avalilable quantity then set to avalilable quantity
						if ($value['qty'] > $curr[0]['stock']) {
							$value['qty'] = $curr[0]['stock'];
							$this->load->library('user_account');
							$this->user_account->update_catqty($content, $key, $curr[0]['stock']);
						}
					}

					if ($currency == 'USD') {
						$round_price = $curr[0]['sale_price'] / $tax_table[0]['sar_rate'];
						// $round_price=round($round_price);
						$curr[0]['sale_price'] = $round_price;
					}
					$curr = $this->is_wishlist($curr);

					$unit_list1 = $this->custom_model->get_data_array("SELECT id,unit_name FROM $unit_list WHERE id IN (" . $curr[0]['unite'] . ") ");

					$curr[0]['unit_list'] = $unit_list1;

					$data[$key]['p'] = $curr[0];
					$data[$key]['c'] = $value;
					if (isset($value['metadata'])) {
						if (!empty($value['metadata'])) {
							foreach ($value['metadata'] as $dkey => $vadlue) {
								$attid = $dkey;
								if (!isset($attp[$attid])) {
									$attp[$attid] = $this->custom_model->my_where('attribute', '*', array('id' => $attid));
								}
								$itemid = $vadlue;
								if (!isset($attc[$itemid])) {
									$attc[$itemid] = $this->custom_model->my_where('attribute_item', '*', array('id' => $itemid));
								}
							}
						}

					}
					$data[$key]['key'] = $key;
					$data[$key]['uqty'] = $value['qty'];
				}
			}
		}
		$response = array();
		$bill_amt = $dilevery = $total_saved = $totaltax = 0;

		// $unit_list_data = $this->custom_model->get_data_array("SELECT * FROM $unit_list ORDER BY unit_name ASC ");
		// $this->mViewData['unit_list_data']		= $unit_list_data;

		// foreach ($data as $key => $value) {
		// 	$response[] = $value;
		// }


		// echo "<pre>";
		// print_r($tax_table);
		// die;



		// $this->mViewData['country']		= $country;
		$this->mViewData['tax_table'] = $tax_table;
		$this->mViewData['currency'] = $currency;

		$this->mViewData['currency_symbol'] = $currency_symbol;

		$adata['data'] = $data;
		$adata['attp'] = $attp;
		$adata['attc'] = $attc;
		$this->mViewData['data'] = $data;
		if (!empty($ajax)) {
			return $data;
		}
		$this->Urender('view_cart', 'udefault');
	}


	public function car_data()
	{
		$uid = $this->session->userdata('uid');
		$language = $this->uri->segment(1);

		if (!empty($uid)) {
			$data = $this->view_cart('ajax');
			if (!empty($data)) {
				$html_tag = '';
				$grand_total = 0;
				foreach ($data as $d_key => $dvalue) {
					$price = $dvalue['p']['sale_price'];
					$pro_total = $price * $dvalue['c']['qty'];
					$grand_total = $pro_total + $grand_total;
					$html_tag .= '<div class="singl_prodct_slidr remove_pro2' . $dvalue['key'] . '" >';
					$html_tag .= '<img src="' . base_url('assets/admin/products/') . $dvalue['p']['product_image'] . '" class="right_slid_img" >';
					$html_tag .= '<div class="singl_prodct_slidr_right">';

					$html_tag .= '<div class="slide_proodct_name">' . $dvalue['p']['product_name'] . '</div>';
					$html_tag .= '<div class="slide_proodct_qnty">';
					$html_tag .= '<a data-class="decrease" class="nty_slid_1 decrease2" onclick="productQty2(this)" data-target="' . $dvalue['key'] . '"  data-key="' . $dvalue['key'] . '" data-sale-value="' . decnum($price) . '" data-product-id="' . $dvalue['p']['id'] . '"> <i class="fa fa-minus-circle" aria-hidden="true"></i></a>';
					$html_tag .= '<input onkeypress="return /[0-9]/i.test(event.key)" style="margin-top:-1px" type="text" class="nty_slid_input qty-input2" value="' . $dvalue['c']['qty'] . '" id="q' . $dvalue['key'] . '" disabled
					>';
					$html_tag .= '<a data-class="increase" class="nty_slid_2 increase2" onclick="productQty2(this)" data-target="' . $dvalue['key'] . '"  data-key="' . $dvalue['key'] . '" data-sale-value="' . decnum($price) . '" data-product-id="' . $dvalue['p']['id'] . '"> <i class="fa fa-plus-circle" aria-hidden="true"></i> </a>';
					$html_tag .= '<div class="clear"></div>';
					$html_tag .= '</div>'; //slide_proodct_qnty

					$html_tag .= '<div class="slide_proodct_price">';
					$html_tag .= '<span class="slide_proodct_price1" >SAR <span class="ac_singlep">' . $price . '</span> <span style="display:none" id="ac_singlep' . $dvalue['key'] . '">' . $pro_total . '</span> </span>';
					$html_tag .= '<div class="slide_proodct_price2">X <span id="qty' . $dvalue['key'] . '">' . $dvalue['c']['qty'] . '</span></div>';
					$html_tag .= '<div class="clear"></div>';
					$html_tag .= '</div>'; //slide_proodct_price

					$html_tag .= '<div class="deletitem_nav" data-id="' . $dvalue['key'] . '"> <i class="fa fa-times" aria-hidden="true"></i> </div>';

					$html_tag .= '</div>'; //singl_prodct_slidr_right
					$html_tag .= '<div class="clear"></div>';
					$html_tag .= '</div>'; //singl_prodct_slidr
				}
				echo json_encode(array("status" => true, "message" => $html_tag, 'message_flag' => '', 'grand_total' => $grand_total));
				die;
			} else {
				echo json_encode(array("status" => false, "message" => ($language == 'ar' ? '<h3 class="ac_empty">عربة التسوق فارغة</h3><br/><div class="d-flex justify-content-center"><a href=" '.  base_url($language . "/home") .' "><button class="btn btn-solid">إضافة عناصر</button></a></div>' : '<h3 class="ac_empty">YOUR SHOPPING CART IS EMPTY</h3><br/><div class="d-flex justify-content-center"><a href="'.  base_url($language . "/home") .'"><button class="btn btn-solid">ADD ITEMS</button></a></div>'), 'message_flag' => 'cart_empty'));
				die;

			}
		} else {
			echo json_encode(array("status" => false, "message" => ($language == 'ar' ? 'الرجاء تسجيل دخول أو إنشاء حساب' : 'Please Login or create account'), 'message_flag' => 'login'));
			die;
		}
	}

	public function checkout($payment_option = '')
	{
		$data = $adata = array();
		$language = $this->uri->segment(1);
		// print_r('hi');
		// exit();
		if ($language == "en") {
			$product = "product";
			$unit_list = "unit_list";
		} else {
			$product = "product_trans";
			$unit_list = "unit_list_trans";
		}
		// print_r('hi');
		// exit();
		$uid = $this->session->userdata('uid');

		$attp = array();
		$attc = array();
		$is_calculate_rate = 1;

		if (!empty($uid)) {
			$is_data = $this->custom_model->my_where('my_cart', '*', array('user_id' => $uid, 'meta_key' => 'cart'));
			$this->session->set_userdata('content', ((!empty($is_data)) ? $is_data[0]['content'] : array()));
		} else {
			if ($language == 'en') {
				$this->session->set_flashdata('login_message', 'Please Login Or Create Account!!');
			} else {
				$this->session->set_flashdata('login_message', 'الرجاء الدخول لإنشاء حساب');
			}
			// echo
			redirect($language);
		}
		$tax_table = $this->custom_model->my_where('tax', '*', array());
		$currency = $this->return_currency_name();
		$currency_symbol = $this->return_currency_symbol($currency, $language);

		$user_last_add = $this->custom_model->get_data_array("SELECT display_order_id,first_name,last_name,mobile_no,email,country,city,state,pincode,address_1,address_2,google_address,lat,lng FROM  order_master WHERE `user_id`='$uid' order by order_master_id desc limit 0,1 ");
		if (empty($user_last_add)) {
			$admin_users = $this->custom_model->my_where('admin_users', 'first_name,last_name,phone,email,city,state,postal_code,country,building_no,street_name', array('id' => $uid));
			$this->mViewData['admin_users'] = $admin_users;
		}
		// echo "<pre>";

		if (!empty($this->session->userdata('content'))) {
			$content = unserialize($this->session->userdata('content'));

			if (empty($payment_option)) {
				$this->session->set_flashdata('common_message', 'Please Select Payment Option');
				redirect($language . '/home/view_cart');
			} else {
				$payment_option = en_de_crypt($payment_option, 'd');
				if ($payment_option == 'cash-on-del' || $payment_option == 'online') {

				} else {
					$this->session->set_flashdata('common_message', 'Please Select right Payment Option');
					redirect($language . '/home/view_cart');
				}
			}
			// echo "<pre>";
			// print_r($content);
			// die;
			if (!empty($content)) {
				foreach ($content as $key => $value) {
					if (empty($value['pid'])) {
						$_POST['pid'] = $value['pid'];
						if (!empty($uid))
							$_POST['uid'] = $uid;
						$this->remove_from_cart(false);
						$_POST[] = array();
						continue;
					}
					$curr = $this->custom_model->my_where($product, 'id,product_name,price,sale_price,stock_status,stock,product_image,status,price_select,is_delivery_available', array('id' => $value['pid']));
					if (isset($value['metadata']) && $curr[0]['price_select'] == 2) {
						if ($curr[0]['status'] == 0) {
							$_POST['pid'] = $key;
							if (!empty($uid))
								$_POST['uid'] = $uid;
							$this->add_to_wish_list(false);
							$this->remove_from_cart(false);
							$adata['error'][$key] = $curr[0]['product_name'];
							continue;
						}
						if (isset($value['metadata'])) {
							if (!empty($value['metadata'])) {

								$product_attribute = $this->custom_model->my_where('product_attribute', '*', array('item_id' => $value['metadata']['attribute_item_id'], 'p_id' => $value['pid']));
								$meta_avil_qty = $product_attribute[0]['qty'];


								if ($meta_avil_qty == 0 || $meta_avil_qty <= 0) {
									$_POST['pid'] = $key;
									if (!empty($uid))
										$_POST['uid'] = $uid;
									$this->add_to_wish_list(false);
									$this->remove_from_cart(false);
									$adata['error'][$key] = $curr[0]['product_name'];
									continue;
								}
								// if cart quantity grather than avalilable quantity then set to avalilable quantity
								if ($value['qty'] > $meta_avil_qty) {
									$value['qty'] = $meta_avil_qty;
									$this->load->library('user_account');
									$this->user_account->update_catqty($content, $key, $meta_avil_qty);
								}


							}
						}
					} else {
						if ($curr[0]['stock_status'] == 'notinstock' || $curr[0]['stock'] == 0 || $curr[0]['stock'] < 0 || $curr[0]['status'] == 0) {
							// $_POST['pid'] = $value['pid'];
							$_POST['pid'] = $key;
							if (!empty($uid))
								$_POST['uid'] = $uid;
							$this->add_to_wish_list(false);
							$this->remove_from_cart(false);
							$adata['error'][$key] = $curr[0]['product_name'];
							continue;
						}
						// if cart quantity grather than avalilable quantity then set to avalilable quantity
						if ($value['qty'] > $curr[0]['stock']) {
							$value['qty'] = $curr[0]['stock'];
							$this->load->library('user_account');
							$this->user_account->update_catqty($content, $key, $curr[0]['stock']);
						}
					}

					if ($currency == 'USD') {
						$round_price = $curr[0]['sale_price'] / $tax_table[0]['sar_rate'];
						// $round_price=round($round_price);
						$curr[0]['sale_price'] = $round_price;
					}
					if ($curr[0]['is_delivery_available'] == 0) {
						$is_calculate_rate = 0;
					}
					$data[$key]['p'] = $curr[0];
					$data[$key]['c'] = $value;
					if (isset($value['metadata'])) {
						if (!empty($value['metadata'])) {
							foreach ($value['metadata'] as $dkey => $vadlue) {
								$attid = $dkey;
								if (!isset($attp[$attid])) {
									$attp[$attid] = $this->custom_model->my_where('attribute', '*', array('id' => $attid));
								}
								$itemid = $vadlue;
								if (!isset($attc[$itemid])) {
									$attc[$itemid] = $this->custom_model->my_where('attribute_item', '*', array('id' => $itemid));
								}
							}
						}

					}
					$data[$key]['key'] = $key;
					$data[$key]['uqty'] = $value['qty'];
				}
			} else {
				redirect($language . '/home/view_cart');
			}
		} else {
			redirect($language . '/home/view_cart');
		}
		// $country_name=$this->return_country_name();


		$response = array();
		$bill_amt = $dilevery = $total_saved = $totaltax = 0;

		$adata['data'] = $data;
		$adata['attp'] = $attp;
		$adata['attc'] = $attc;
		// echo "<pre>";
		// echo count($data);
		// print_r($data);
		// echo $payment_option;
		// die;

		if (empty($data)) {
			redirect($language . '/home/view_cart');
		}
		$this->mViewData['data'] = $data;
		// $this->mViewData['country_name']= $country_name;
		$this->mViewData['user_last_add'] = $user_last_add;
		$this->mViewData['tax_table'] = $tax_table;
		$this->mViewData['currency'] = $currency;
		$this->mViewData['currency_symbol'] = $currency_symbol;
		$this->mViewData['payment_option'] = $payment_option;
		$this->mViewData['is_calculate_rate'] = $is_calculate_rate;
		$this->mViewData['ajax_url'] = base_url($language . '/home/place_order/');
		$this->mViewData['flow_type'] = 'normal';
		// $this->mViewData['shipping_charge']= $this->return_shipping_charge($data,$currency,$tax_table);
		$this->Urender('checkout', 'udefault');
	}

	public function place_order()
	{
		$language = $this->uri->segments[1];
		$post_arr = $this->input->post();
		$uid = $this->session->userdata('uid');
		if (empty($uid)) {
			echo json_encode(array("status" => false, "message" => ($language == 'ar' ? 'لرجاء الدخول لإنشاء حساب' : 'Please Login Or Create Account!!'), "flag" => "login_message"));
			die;
			// redirect($language);
		}

		if (!empty($post_arr)) {
			if (isset($post_arr['first_name']) && isset($post_arr['last_name']) && isset($post_arr['payment_mode']) && isset($post_arr['mobile_no']) && isset($post_arr['email']) && isset($post_arr['address_1']) && isset($post_arr['country']) && isset($post_arr['city']) && isset($post_arr['state']) && isset($post_arr['pincode']) && isset($post_arr['google_address']) && isset($post_arr['lat']) && isset($post_arr['lng'])) {
				$send_data = array();
				$send_data['first_name'] = trim($post_arr['first_name']);
				$send_data['last_name'] = trim($post_arr['last_name']);
				$send_data['payment_mode'] = trim($post_arr['payment_mode']);
				$send_data['mobile_no'] = trim($post_arr['mobile_no']);
				$send_data['email'] = trim($post_arr['email']);
				$send_data['address_1'] = trim($post_arr['address_1']);
				$send_data['country'] = trim($post_arr['country']);
				$send_data['city'] = trim($post_arr['city']);
				$send_data['state'] = trim($post_arr['state']);
				$send_data['pincode'] = trim($post_arr['pincode']);
				$send_data['google_address'] = trim($post_arr['google_address']);
				$send_data['lat'] = trim($post_arr['lat']);
				$send_data['lng'] = trim($post_arr['lng']);

				if (!empty($send_data['first_name']) && !empty($send_data['last_name']) && !empty($send_data['payment_mode']) && !empty($send_data['mobile_no']) && !empty($send_data['email']) && !empty($send_data['address_1']) && !empty($send_data['country']) && !empty($send_data['city']) && !empty($send_data['state']) && !empty($send_data['pincode']) && !empty($send_data['pincode'])) {
					// echo "<pre>";
					// print_r($send_data);
					// die;
					$shipping_charge = 0;
					$products = unserialize($this->session->userdata('content'));
					if (empty($products)) {
						// redirect($language);
						echo json_encode(array("status" => false, "message" => ($language == 'ar' ? 'Your shopping cart is empty' : 'Your shopping cart is empty'), "flag" => "redirect", "url" => base_url($language . '/home/view_cart')));
						die;
					}
					$this->load->library('shipping_lib');
					$rate_info = $this->shipping_lib->get_shipping_rate($products, $send_data);
					// echo "<pre>";
					// print_r($rate_info);
					// print_r($products);
					// die;
					if ($rate_info['status'] == true) {
						if ($rate_info['is_single_pro_error'] == true) {
							$html_tag = '';
							if (!empty($rate_info['data'])) {
								foreach ($rate_info['data'] as $ri_key => $ri_val) {
									if ($ri_val['error'] == 1) {
										$html_tag .= '<p>' . $ri_val['error_message'] . '</p>';
									}
								}
							} else {
								echo json_encode(array("status" => false, "message" => "Something Went Wrong", "flag" => ""));
								die;
							}
							echo json_encode(array("status" => false, "message" => $html_tag, "flag" => "shipping_erro"));
							die;
						} else {
							foreach ($rate_info['data'] as $ri_key => $ri_val) {
								if ($ri_val['error'] == 0) {
									$products[$ri_key]['shipping_cost'] = $ri_val['amount'];
								}
							}
							$shipping_charge = $rate_info['TotalAmount'];
						}
					} else {
						echo json_encode(array("status" => false, "message" => $rate_info['message'], "flag" => ""));
						die;
					}

					$send_data['shipping_charge'] = $shipping_charge;
					$tax_table = $this->custom_model->my_where('tax', '*', array('id' => '1'));
					$currency = $this->return_currency_name();
					$currency_symbol = $this->return_currency_symbol($currency, $language);
					// if(empty($uid)) $uid = 0;
					//  	$send_data['shipping_charge'] =$this->return_shipping_charge($products,$currency,$tax_table);
					//  	$coupon_code=$this->session->userdata('coupon_code');
					//  	$discount_value=$this->session->userdata('discount_value');
					//  	$shipping_flag=$this->session->userdata('shipping_flag');
					//  	if(!empty($coupon_code) && !empty($discount_value) )
					//  	{
					//  		$this->is_coupon_valid($coupon_code);
					//  		$send_data['coupon_code']=$coupon_code;
					//  		$send_data['coupon_price']=$discount_value;
					//  		// 1 means shipping free 0 means not free
					//  		if($shipping_flag==1)
					//  		{
					//  			$send_data['shipping_charge']=0;
					//  		}
					//  		$this->session->unset_userdata('discount_value');
					// $this->session->unset_userdata('shipping_flag');
					// $this->session->unset_userdata('coupon_code');
					//  	}

					// echo "<pre>";
					// print_r($products);
					// die;

					$this->load->library('place_order');
					$response = $this->place_order->create_order($send_data, $products, $uid, 'website', $currency, $tax_table);

					// echo "<pre>";
					// print_r($response);
					// die;
					if (!empty($response)) {

						$uid = $this->session->userdata('uid');
						$this->session->set_userdata('content', '');

						$this->custom_model->my_delete(array('user_id' => $uid, 'meta_key' => 'cart'), 'my_cart');

						// $this->mViewData['data'] = $response;

						// echo "string";
						if ($send_data['payment_mode'] == 'online') {
							$track_id = $response['display_order_id'];
							$payment_insert['track_id'] = $track_id;
							$payment_insert['display_order_id'] = $response['display_order_id'];
							$payment_insert['user_id'] = $uid;
							$payment_insert['source'] = 'web';
							$payment_insert['created_date'] = date('Y-m-d H:i:s');
							$payment_insert['currency'] = $currency;
							$this->custom_model->my_insert($payment_insert, 'payment_details');

							if ($currency == "SAR") {
								$post['currency_code'] = 682;
								$post['amount'] = $response['net_total'];
								// $post['amount']=$subs_plans[0]['amount']*$tax_table[0]['sar_rate'];
							} else {
								$post['currency_code'] = 840;
								$post['amount'] = $response['net_total'];
							}
							$post['payment_password'] = $this->payment_password;
							$post['payment_id'] = $this->payment_id;
							$post['track_id'] = $track_id;
							$this->load->library('enc_dec_lib');

							$post['response_url'] = base_url($language . '/payment/ecom_response');
							$post['erro_url'] = base_url($language . '/payment/ecom_error');
							$plan_text = $this->enc_dec_lib->get_json_code($post);
							$trandata = $this->enc_dec_lib->encryptAES($plan_text, $this->payment_key);

							$post = array();
							$post['id'] = $this->payment_id;
							$post['trandata'] = $trandata;
							$post['responseURL'] = base_url($language . '/payment/ecom_response');
							;
							$post['errorURL'] = base_url($language . '/payment/ecom_error');
							$pay_response = $this->enc_dec_lib->get_payment_url($post, $uid, $track_id, $payment_type = 'ecom');
							// echo "<pre>";
							// print_r($pay_response);
							// die;
							if ($pay_response['status'] == true) {
								// $return_url = base_url($language).'/fort_pay/index/'.$display_order_id;
								// redirect($pay_response['message']);
								echo json_encode(array("status" => true, "message" => ($language == 'ar' ? '' : ''), "flag" => "redirect", "url" => $pay_response['message']));
								die;
							} else {
								// redirect($language.'/home/thankyou/'.en_de_crypt($response['display_order_id']));
								echo json_encode(array("status" => true, "message" => ($language == 'ar' ? '' : ''), "flag" => "redirect", "url" => base_url($language . '/home/thankyou/' . en_de_crypt($response['display_order_id']))));
								die;
							}

						} else {

							$this->load->library("email_send");
							if ($language == 'en') {
								$this->email_send->send_invoice_new_en($response['display_order_id']);
							} else {
								$this->email_send->send_invoice_new_ar($response['display_order_id']);
							}
							// $this->email_send->send_invoice($response['display_order_id']);
							// redirect($language.'/home/thankyou/'.en_de_crypt($response['display_order_id']));
							echo json_encode(array("status" => true, "message" => ($language == 'ar' ? 'Order Place Successfully' : 'Order Place Successfully'), "flag" => "redirect", "url" => base_url($language . '/home/thankyou/' . en_de_crypt($response['display_order_id']))));
							die;
						}
					} else {
						// redirect($language);
						echo json_encode(array("status" => false, "message" => ($language == 'ar' ? 'Something went wrong' : 'Something went wrong'), "flag" => ""));
						die;
					}
				} else {
					echo json_encode(array("status" => false, "message" => ($language == 'ar' ? 'All Field Required' : 'All Field Required'), "flag" => ""));
					die;
					// $this->session->set_flashdata('common_message', 'All Field Required');
					// redirect($language.'/home/checkout_1');
				}

			} else {
				echo json_encode(array("status" => false, "message" => ($language == 'ar' ? 'All Field Required' : 'All Field Required'), "flag" => ""));
				die;
				// $this->session->set_flashdata('common_message', 'All Field Required');
				// redirect($language.'/home/checkout_1');
			}
		} else {
			// redirect($language);
			echo json_encode(array("status" => false, "message" => ($language == 'ar' ? 'Something went wrong' : 'Something went wrong'), "flag" => ""));
			die;
		}
	}



	public function thankyou($display_order_id = '')
	{
		$language = $this->uri->segments[1];
		if (!empty($display_order_id)) {
			$display_order_id = en_de_crypt($display_order_id, 'd');
			$order_data = $this->custom_model->my_where('order_master', 'display_order_id,order_master_id,order_status,payment_status,payment_mode,net_total,coupon_price,currency,sub_total,tax,order_datetime,address_1,city,state,country,pincode,mobile_no,commission,transfer_fees,bank_fees,shipping_charge', array('display_order_id' => $display_order_id));
			// echo "<pre>";
			// print_r($order_data);
			// die;
			if (!empty($order_data)) {
				if ($order_data[0]['payment_mode'] == 'online') {
					$tran_history = $this->custom_model->my_where('payment_details', 'id,payment_status,errorText,track_id,authRespCode,cardType', array('display_order_id' => $display_order_id));
					if (!empty($tran_history)) {
						$payment_msg = $this->custom_model->my_where('payment_code_msg', 'message', array('code' => $tran_history[0]['authRespCode'], 'card_type' => $tran_history[0]['cardType']));
						if (!empty($payment_msg)) {
							$tran_history[0]['code_msg'] = $payment_msg[0]['message'];
						}
					}

				}

				$order_master_id = $order_data[0]['order_master_id'];
				if ($language == 'en') {
					$order_items = $this->custom_model->get_data_array(" SELECT ois.product_id,ois.product_name,ois.quantity,ois.price,ul.unit_name FROM order_items as ois LEFT JOIN unit_list as ul ON ois.unit=ul.id WHERE ois.order_no='$order_master_id' ");

				} else {
					$order_items = $this->custom_model->get_data_array(" SELECT ois.product_id,ois.product_name,ois.quantity,ois.price,ul.unit_name FROM order_items as ois LEFT JOIN unit_list_trans as ul ON ois.unit=ul.id WHERE ois.order_no='$order_master_id' ");
				}
				// if(!empty($order_items))
				// {
				// 	foreach ($order_items as $key => $value)
				// 	{
				// 		$unit_list=$this->custom_model->my_where('unit_list','unit_name',array('id' => $value['unit']));
				// 		if(!empty($unit_list))
				// 		{
				// 			$order_items[$key]['unit_name']=$unit_list[0]['unit_name'];
				// 		}else{
				// 			$order_items[$key]['unit_name']='';
				// 		}
				// 	}
				// }

				$this->mViewData['order_data'] = $order_data;
				$this->mViewData['tran_history'] = @$tran_history;
				$this->mViewData['order_items'] = $order_items;
				// echo "<pre>";
				// print_r($order_data);
				// print_r($tran_history);
				// die;
				$this->Urender('thank_you', 'udefault');
			} else {
				redirect($language);
			}
		} else {
			redirect($language);
		}
	}


	public function add_to_wish_list($echo = true)
	{
		$pid = $this->input->post('pid');
		$is_wish = $this->input->post('is_wish');
		$uid = $this->session->userdata('uid');
		if (!empty($pid)) {
			$append = 'm' . $pid;
		}
		if (empty($uid)) {
			if ($echo) {
				echo "0";
			}
			// echo 0;
			die;
		}

		if (!empty($uid)) {
			$is_data = $this->custom_model->my_where('my_cart', '*', array('user_id' => $uid, 'meta_key' => 'wish_list'));
			if (empty($is_wish)) {
				$date = date('Y-m-d');

				if (!empty($is_data)) {

					$wish_list = unserialize($is_data[0]['content']);
					$cnt[$append] = array('pid' => $pid, 'add_date' => $date);

					if (!empty($wish_list)) {
						$cnt = array_merge($wish_list, $cnt);
					}
					// echo "<pre>";
					// print_r($cnt);
					// die;
					$this->custom_model->my_update(array('content' => serialize($cnt)), array('id' => $is_data[0]['id']), 'my_cart', true, true);

				} else {
					$cnt[$append] = array('pid' => $pid, 'add_date' => $date);
					$data['user_id'] = $uid;
					$data['meta_key'] = 'wish_list';
					$data['content'] = serialize($cnt);
					$this->custom_model->my_insert($data, 'my_cart');
				}
			} else {
				$wish_list = unserialize($is_data[0]['content']);
				// $my_wish = array_diff($wish_list, array($pid));
				if (array_key_exists($append, $wish_list)) {
					unset($wish_list[$append]);
					$wish_list = array_filter($wish_list);
					$this->custom_model->my_update(array('content' => serialize($wish_list)), array('id' => $is_data[0]['id']), 'my_cart', true, true);
				}
			}
		}
		if ($echo) {
			echo "1";
		}
		// die;
	}

	public function remove_from_cart($echo = true)
	{
		$pid = $this->input->post('pid');
		$uid = $this->session->userdata('uid');
		$this->load->library('user_account');
		$response = $this->user_account->add_remove_cart($pid, $uid, 'remove');

		if ($echo) {
			if ($response != '-1') {
				if (isset($response['cart_qty'])) {
					$cart_qty = $response['cart_qty'];
					$this->session->set_userdata('cart_qty', $response['cart_qty']);
					unset($response['cart_qty']);
				}

				$this->session->set_userdata('content', serialize($response));
				echo "1";
			} else {
				echo "0";
			}
		}
	}

	public function de($id = "135")
	{
		echo substr('min_order_1', 0, 9);
		echo "<br>";
		echo substr('min_order_1', 10);
		die;
		$rating = 0;
		echo en_de_crypt($id);
		$uid = $this->session->userdata('uid');
		$is_data = $this->custom_model->my_where('my_cart', '*', array('user_id' => $uid, 'meta_key' => 'wish_list'));

		echo "<pre>";
		print_r($data = unserialize($is_data[0]['content']));

		usort($data, 'date_compare');
		// rsort($data);
		print_r($data);
		die;
	}

	public function test_map()
	{
		// $this->mViewData['unit_list_data'] =$unit_list_data;
		$this->Urender('test_map', 'udefault');
	}





	public function checkout_1()
	{
		$data = $adata = array();
		$language = $this->uri->segment(1);

		if ($language == "en") {
			$product = "product";
		} else {
			$product = "product_trans";
		}

		$uid = $this->session->userdata('uid');

		$attp = array();
		$attc = array();


		if (!empty($uid)) {
			$is_data = $this->custom_model->my_where('my_cart', '*', array('user_id' => $uid, 'meta_key' => 'cart'));
			$this->session->set_userdata('content', ((!empty($is_data)) ? $is_data[0]['content'] : array()));
		} else {
			if ($language == 'en') {
				$this->session->set_flashdata('login_message', 'Please Login Or Create Account!!');
			} else {
				$this->session->set_flashdata('login_message', 'الرجاء الدخول لإنشاء حساب');
			}
			// echo
			redirect($language);
		}
		$tax_table = $this->custom_model->my_where('tax', '*', array());
		$currency = $this->return_currency_name();
		$currency_symbol = $this->return_currency_symbol($currency, $language);

		$user_last_add = $this->custom_model->get_data_array("SELECT display_order_id,first_name,last_name,mobile_no,email,country,city,state,pincode,address_1,address_2,google_address,lat,lng FROM  order_master WHERE `user_id`='$uid' order by order_master_id desc limit 0,1 ");
		if (empty($user_last_add)) {
			$admin_users = $this->custom_model->my_where('admin_users', 'first_name,last_name,phone,email,city,state,postal_code,country,building_no,street_name', array('id' => $uid));
			$this->mViewData['admin_users'] = $admin_users;
		}
		// echo "<pre>";

		if (!empty($this->session->userdata('content'))) {
			$content = unserialize($this->session->userdata('content'));


			// echo "<pre>";
			// print_r($content);
			// die;
			if (!empty($content)) {
				foreach ($content as $key => $value) {
					if (empty($value['pid'])) {
						$_POST['pid'] = $value['pid'];
						if (!empty($uid))
							$_POST['uid'] = $uid;
						$this->remove_from_cart(false);
						$_POST[] = array();
						continue;
					}
					$curr = $this->custom_model->my_where($product, 'id,product_name,price,sale_price,stock_status,stock,product_image,status,price_select', array('id' => $value['pid']));
					if (isset($value['metadata']) && $curr[0]['price_select'] == 2) {
						if ($curr[0]['status'] == 0) {
							$_POST['pid'] = $key;
							if (!empty($uid))
								$_POST['uid'] = $uid;
							$this->add_to_wish_list(false);
							$this->remove_from_cart(false);
							$adata['error'][$key] = $curr[0]['product_name'];
							continue;
						}
						if (isset($value['metadata'])) {
							if (!empty($value['metadata'])) {

								$product_attribute = $this->custom_model->my_where('product_attribute', '*', array('item_id' => $value['metadata']['attribute_item_id'], 'p_id' => $value['pid']));
								$meta_avil_qty = $product_attribute[0]['qty'];


								if ($meta_avil_qty == 0 || $meta_avil_qty <= 0) {
									$_POST['pid'] = $key;
									if (!empty($uid))
										$_POST['uid'] = $uid;
									$this->add_to_wish_list(false);
									$this->remove_from_cart(false);
									$adata['error'][$key] = $curr[0]['product_name'];
									continue;
								}
								// if cart quantity grather than avalilable quantity then set to avalilable quantity
								if ($value['qty'] > $meta_avil_qty) {
									$value['qty'] = $meta_avil_qty;
									$this->load->library('user_account');
									$this->user_account->update_catqty($content, $key, $meta_avil_qty);
								}


							}
						}
					} else {
						if ($curr[0]['stock_status'] == 'notinstock' || $curr[0]['stock'] == 0 || $curr[0]['stock'] < 0 || $curr[0]['status'] == 0) {
							// $_POST['pid'] = $value['pid'];
							$_POST['pid'] = $key;
							if (!empty($uid))
								$_POST['uid'] = $uid;
							$this->add_to_wish_list(false);
							$this->remove_from_cart(false);
							$adata['error'][$key] = $curr[0]['product_name'];
							continue;
						}
						// if cart quantity grather than avalilable quantity then set to avalilable quantity
						if ($value['qty'] > $curr[0]['stock']) {
							$value['qty'] = $curr[0]['stock'];
							$this->load->library('user_account');
							$this->user_account->update_catqty($content, $key, $curr[0]['stock']);
						}
					}

					if ($currency == 'USD') {
						$round_price = $curr[0]['sale_price'] / $tax_table[0]['sar_rate'];
						// $round_price=round($round_price);
						$curr[0]['sale_price'] = $round_price;
					}

					$data[$key]['p'] = $curr[0];
					$data[$key]['c'] = $value;
					if (isset($value['metadata'])) {
						if (!empty($value['metadata'])) {
							foreach ($value['metadata'] as $dkey => $vadlue) {
								$attid = $dkey;
								if (!isset($attp[$attid])) {
									$attp[$attid] = $this->custom_model->my_where('attribute', '*', array('id' => $attid));
								}
								$itemid = $vadlue;
								if (!isset($attc[$itemid])) {
									$attc[$itemid] = $this->custom_model->my_where('attribute_item', '*', array('id' => $itemid));
								}
							}
						}

					}
					$data[$key]['key'] = $key;
					$data[$key]['uqty'] = $value['qty'];
				}
			} else {
				redirect($language . '/home/view_cart');
			}
		} else {
			redirect($language . '/home/view_cart');
		}
		// $country_name=$this->return_country_name();


		$response = array();
		$bill_amt = $dilevery = $total_saved = $totaltax = 0;

		$adata['data'] = $data;
		$adata['attp'] = $attp;
		$adata['attc'] = $attc;
		// echo "<pre>";
		// echo count($data);
		// print_r($data);
		// die;
		if (empty($data)) {
			redirect($language . '/home/view_cart');
		}
		$this->mViewData['data'] = $data;
		// $this->mViewData['country_name']= $country_name;
		$this->mViewData['user_last_add'] = $user_last_add;
		$this->mViewData['tax_table'] = $tax_table;
		$this->mViewData['currency'] = $currency;
		$this->mViewData['currency_symbol'] = $currency_symbol;
		// $this->mViewData['shipping_charge']= $this->return_shipping_charge($data,$currency,$tax_table);
		$this->Urender('checkout_1', 'udefault');
	}

	public function return_html_new($product_data, $language, $inc_count = '')
	{
		$html_tag = '';
		if ($language == 'en') {
			$add_to_cart_text = "Add To Cart";
		} else {
			$add_to_cart_text = "إضافة إلى سلة الشراء";
		}
		if (!empty($product_data)) {
			$i = 1;
			if (!empty($inc_count)) {
				$i = 101;
			}
			$currency = $this->return_currency_name();
			$currency_symbol = $this->return_currency_symbol($currency, $language);
			foreach ($product_data as $product_key => $product_value) {
				if ($product_value['is_stock'] == 0) {
					$stock_class = "prd-outstock";
					$stock_label_class = "label-outstock";
					$stock_label = "OUT OF STOCK";
					$btn_disabled = 'disabled';
				} else {
					$stock_class = "";
					$stock_label_class = "";
					$stock_label = "";
					$btn_disabled = '';
				}

				$product_image = explode("/", $product_value['product_image']);
				$product_image = count($product_image);
				if ($product_image == 1) {
					$image_url = base_url("assets/admin/products/") . $product_value['product_image'];
				} else {
					$image_url = $product_value['product_image'];
				}

				$html_tag .= '<div class="product-box">';

				$html_tag .= '<div class="img-wrapper">';
				$html_tag .= '<div class="front">';
				$html_tag .= '<a href="#"><img src="' . base_url("assets/admin/products/") . $product_value['product_image'] . '" class="img-fluid blur-up lazyload bg-img" alt=""></a>';
				$html_tag .= '</div>'; //front

				$html_tag .= '<div class="back">';
				$html_tag .= '<a href="' . base_url($language . '/home/detail/') . $product_value['id'] . '"><img src="' . base_url("assets/admin/products/") . $product_value['product_image'] . '" class="img-fluid blur-up lazyload bg-img" alt=""></a>';
				$html_tag .= '</div>'; //back

				$html_tag .= '<div class="cart-info cart-wrap">';
				$html_tag .= '</div>';

				$html_tag .= '</div>'; //img-wrapper

				$html_tag .= '<div class="product-detail">';
				if (!empty($product_value['unit_list'])) {
					$html_tag .= '<select class="form-control select_unit get_unit' . $product_key . '">';
					foreach ($product_value['unit_list'] as $uld_key => $uld_value) {
						$html_tag .= '<option data-id="' . $uld_value['id'] . '" >' . $uld_value['unit_name'] . '</option>';
					}
					$html_tag .= '</select>';
				}

				if (isset($product_value['meta_data']) && !empty($product_value['meta_data'])) {
					$html_tag .= '<select class="form-control select_size get_size' . $product_key . '">';
					$html_tag .= '<option value="0">Select Size</option>';
					foreach ($product_value['meta_data'] as $md_key => $md_val) {
						$html_tag .= '<option data-price="' . $md_val['price'] . '" data-value="' . $md_val['size'] . '" value="' . $md_val['item_id'] . '">' . $md_val['size'] . '</option>';
					}
					$html_tag .= '</select>';
				}

				$html_tag .= '<div>';
				$html_tag .= '<a href="' . base_url($language . '/home/detail/') . $product_value['id'] . '"><h6>' . $product_value['product_name'] . '</h6> </a>';

				$html_tag .= '<span class="wish_l wishlist' . $product_value['id'] . '">';
				if ($product_value['wish_list'] == 1) {
					$html_tag .= '<a href="javascript:void(0)" onclick="remove_cart(' . $product_value['id'] . ')" ><i class="ti-ti-heart-broken" aria-hidden="true"></i></a>';
				} else {
					$html_tag .= '<a href="javascript:void(0)" onclick="move_to_wish_list(' . $product_value['id'] . ')" ><i class="ti-ti-heart-broken" aria-hidden="true"></i></a>';
				}
				$html_tag .= '</span>';

				$html_tag .= '<h4>' . $currency_symbol . '  ' . $product_value['sale_price'] . ' </h4>';
				$html_tag .= '<ul class="color-variant"> <li class="bg-light0"></li> <li class="bg-light1"></li> <li class="bg-light2"></li> </ul>';

				if ($product_value['price_select'] == '1') {
					$html_tag .= '<button title="Add to cart" data-id="' . $product_value['id'] . '" data-unit="get_unit' . $product_key . '" data-detislqty="' . $product_value['min_order_quantity'] . '" class="add_to_cart2"><i class="ti-shopping-cart"></i> Add to cart           </button>';
				} else {

					$html_tag .= '<button title="Add to cart"data-class="get_size' . $product_key . '" data-id="' . $product_value['id'] . '" data-unit="get_unit' . $product_key . '" data-detislqty="' . $product_value['min_order_quantity'] . '" class="add_to_cart2"><i class="ti-shopping-cart"></i> Add to cart</button>';
				}

				$html_tag .= '</div>';

				$html_tag .= '</div>'; //product-detail

				$html_tag .= '</div>'; //product-box
			}
		}
		return $html_tag;
	}


	public function compare()
	{
		$this->Urender('compare', 'udefault');
	}

	public function manual()
	{
		$uid = $this->session->userdata('uid');
		$language = $this->uri->segment(1);
		if (empty($uid)) {
			redirect($language . '/login');
		}
		$this->load->view('customer-manual');
	}

	public function arabic_manual()
	{
		$uid = $this->session->userdata('uid');
		$language = $this->uri->segment(1);
		if (empty($uid)) {
			redirect($language . '/login');
		}
		$this->load->view('arabic-customer-manual');
	}

}