<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Library to add cart/ add wish list
 */
class Place_order
{

	protected $order_datetime;

	public function __construct()
	{
		// Assign the CodeIgniter super-object
		$this->CI = &get_instance();
		$this->CI->load->model('admin/Custom_model', 'custom_model');
		$this->order_datetime = date('Y-m-d H:i:s');
		date_default_timezone_set('Asia/Kolkata');
	}

	//@ap@
	public function get_order_price($products, $tax_table){
		$order_price = 0;
		//to get the total order price @ap@
		if(isset($tax_table['cap_rate'])) {
		// get the price of the product from the database @ap@
		$get_product = $this->CI->custom_model->my_where('product', 'id,sale_price', array('id' => $products['m53m11']['pid']))[0];
		// get the price of total product excluding estimated vat
		$order_price = (($get_product['sale_price'] * $products['m53m11']['qty']) + $products['m53m11']['shipping_cost']) + $tax_table['cap_rate'];
		// get the amount of estimated vat
		$estimated_vat = ((($get_product['sale_price'] * $products['m53m11']['qty']) + $tax_table['cap_rate']) * $tax_table['vat']) / 100;

		$order_price = $order_price + $estimated_vat;
		}

		return ((float) $order_price);
	}

	//@ap@
	public function get_user_balance($uid){
		// get user va details
		$user_account_details = $this->CI->custom_model->my_where('account_details', 'id,is_active, balance', array('user_id' => $uid))[0];
		//return balance in va
		return ($user_account_details['balance']);
	}

	//@ap@
	public function update_user_va_balance($products, $tax_table, $uid){
		$order_price = $this->get_order_price($products, $tax_table);
		$user_balance = $this->get_user_balance($uid);
		echo($order_price);
		die;

		// return ('hello');
	}

	public function create_order($post_arr, $products, $uid, $source, $currency, $tax_table)
	{

			$data = array();

			if (!empty($post_arr)) {
				if (!empty($products)) {
					$post_arr['delivery_date'] 	= $this->order_datetime;
					$post_arr['net_total'] = "0";
					$post_arr['sub_total'] = "0";

					if (isset($post_arr['single_price'])) {
						// this price for purchase invoice
						$single_price = $post_arr['single_price'];
						unset($post_arr['single_price']);
					}

					// $tax_table = $this->CI->custom_model->my_where('tax','*',array('id'=>'1'));

					// if (!empty($tax_table))
					// {
					// 	$post_arr['shipping_charge'] = $tax_table[0]['shipping_charge'];
					// }
					// else
					// {
					// 	$post_arr['shipping_charge'] = '0';
					// }

					// echo "<pre>";
					// print_r($shipping_charge);
					// die;

					if ($post_arr['payment_mode'] == 'va_transfer') {
						$post_arr['payment_status'] = 'Unpaid';
						$post_arr['is_show'] = '1';
					} else {
						$post_arr['payment_status'] = 'Unpaid';
						$post_arr['is_show'] = 0;
					}

					// insert in order_master



					$post_arr['user_id'] 		= $uid;
					$post_arr['order_datetime'] = $this->order_datetime;

					// echo "<pre>";print_r($post_arr);die;

					$oid = $this->CI->custom_model->my_insert($post_arr, 'order_master');
					// Update display_order_id

					// insert in order_items
					$invoice = $itesmval = $prd_cat  = array();

					$sub_total1 = $net_total1 = $tax1 = $total_commission = 0;

					$tax = $tax_table[0]['vat'];

					// echo "<pre>";
					// print_r($products);
					// die;

					foreach ($products as $key => $value) {
						// print_r($value);
						$item = array();
						$curr = $this->CI->custom_model->my_where('product', 'id,category,product_name,sale_price,price,product_image,seller_id,stock,price_select,is_delivery_available', array('id' => $value['pid']));

						$data['remove_pr'][] = $curr[0]['id'];

						$curr1 = $this->CI->custom_model->my_where('admin_users', 'id,first_name,email', array('id' => $curr[0]['seller_id']));


						$prd_cat[] = $curr[0]['category'];
						if (isset($value['metadata']) && !empty($value['metadata'])) {
							// $price=	$value['metadata']['price'];						
							$item['attribute'] = 'Size-' . $value['metadata']['size'];
						}
						if ($curr[0]['sale_price'] == 0.00) {
							$price = $curr[0]['price'];
						} else {
							$price = $curr[0]['sale_price'];
						}

						if (isset($single_price)) {
							// this for order purchase form quotation invoice
							$price = $single_price;
						}

						if ($currency == 'USD') {
							$price = $price / $tax_table[0]['sar_rate'];
							// $price=round($price);
						}

						// if($currency=='SAR')
						// {                                  
						// $price=$price*$tax_table[0]['sar_rate'];
						// $price=round($price);
						// }else if($currency=='USD'){
						// $price=$price*$tax_table[0]['usd_rate'];
						// $price=round($price);
						// }
						// echo $price;
						// die;

						$item['order_no'] = $oid;
						$item['user_id'] = $uid;
						$item['product_id'] = $value['pid'];
						$item['unit'] = @$value['unit'];
						$item['price'] = decnum($price);
						$item['seller_id'] = $curr[0]['seller_id'];
						$item['is_delivery_available'] = $curr[0]['is_delivery_available'];

						$data['product'][$key]['quantity'] = $item['quantity'] = $value['qty'];
						$data['product'][$key]['name'] = $item['product_name'] = $curr[0]['product_name'];
						$data['product'][$key]['price'] = $price;
						$data['product'][$key]['sale_price'] = $price;
						$data['product'][$key]['product_image'] = $curr[0]['product_image'];


						$pro_total = $price * $value['qty'];
						$commission = $tax_table[0]['commission'];
						$single_commission = ($commission * $pro_total) / 100;
						if ($single_commission > $tax_table[0]['cap_rate']) {
							$single_commission = $tax_table[0]['cap_rate'];
						}
						$total_commission = $single_commission + $total_commission;
						$pro_total = $pro_total + $single_commission;
						$single_vat = ($tax * $pro_total) / 100;

						$item['sub_total'] 		= decnum($price * $value['qty']);
						$item['tax'] 			= $single_vat;
						$item['commision'] 			= $single_commission;
						// $item['shipping_cost'] 	= $post_arr['shipping_charge'];
						$item['shipping_cost'] 	= @$value['shipping_cost'];
						$item['payment_status'] = $post_arr['payment_status'];
						$item['payment_mode'] 	= $post_arr['payment_mode'];
						$item['delivery_date'] 	= $post_arr['delivery_date'];
						$item['order_status'] 	= 'Pending';
						$item['created_date'] = $this->order_datetime;



						$item_id = $this->CI->custom_model->my_insert($item, 'order_items');

						// reduce quantity from stock
						if (isset($value['metadata']) && !empty($value['metadata']) & $curr[0]['price_select'] == 2) {

							$product_attribute = $this->CI->custom_model->my_where('product_attribute', 'qty', array('p_id' => $value['pid'], 'attribute_id' => '20', 'item_id' => $value['metadata']['attribute_item_id']));

							$update2['qty'] = $product_attribute[0]['qty'] - $value['qty'];
							if ($update2['qty'] == 0 || $update2['qty'] < 0) {
								$update2['qty'] 	= '0';
							}

							$this->CI->custom_model->my_update($update2, array('p_id' => $value['pid'], 'attribute_id' => '20', 'item_id' => $value['metadata']['attribute_item_id']), 'product_attribute');
						} else {
							$update['stock'] = $curr[0]['stock'] - $value['qty'];

							if ($update['stock'] == 0 || $update['stock'] < 0) {
								$update['stock_status'] = 'notinstock';
								$update['stock'] 		= '0';
							}

							$this->CI->custom_model->my_update($update, array('id' => $value['pid']), 'product');
							$this->CI->custom_model->my_update($update, array('id' => $value['pid']), 'product_trans');
						}


						$item['product_image'] 	= $curr[0]['product_image'];
						$item['mrp'] 			= $price;
						$item['vender_email'] 	= $curr1[0]['email'];
						$item['category'] 		= $curr[0]['category'];
						$itesmval[$item_id] 	= $item;

						$invoice_seller_id 							= $curr[0]['seller_id'];
						$invoice[$invoice_seller_id]['order_no'] 	= $oid;
						$invoice[$invoice_seller_id]['items'][] 	= $item_id;
						// $invoice[$invoice_seller_id]['commision'] 	= $tax;
						// $invoice[$invoice_seller_id]['commision'] 	= $tax_table[0]['commission'];

						$sub_total1 = decnum($sub_total1 + $item['sub_total']);

						$additional_percentage = $response = array();
						$additional_percentage['trans_ref'] = date('Ymd') . $item_id;
						$item_id = $this->CI->custom_model->my_update($additional_percentage, array("item_id" => $item_id), "order_items");
					}

					$display_order_id = date('YmdHis') . $oid;

					$datasi = array();

					$in_items = '';
					foreach ($invoice as $ikey => $ivalue) {
						// $commision =  $ivalue['commision'];
						$datasi['order_status'] = "Pending";
						$datasi['display_order_id'] = $display_order_id;
						$datasi['payment_status'] = "Pending";
						$datasi['payment_mode'] = $post_arr['payment_mode'];
						$datasi['order_no'] = $ivalue['order_no'];
						$datasi['item_ids'] = implode(",", $ivalue['items']);
						$datasi['seller_id'] = $ikey;

						$sub_total = $transaction_cost = $net_total = 0;
						$itax = $totalcommision = 0;

						// $shipping_charge = $post_arr['shipping_charge'];
						$inv_shipping_charge = 0;
						if ($ivalue['items']) {
							foreach ($ivalue['items'] as $item_id) {
								$in_items = $in_items . '' . $item_id;
								$row = $itesmval[$item_id];
								$product_name = $row["product_name"];
								$quantity = $row["quantity"];
								$price = $row["price"];
								// $tax = 0;
								$vender_email = $row['vender_email'];
								$category = $row['category'];
								$mrp = $row['mrp'];
								$totalcommision = $row["commision"] + $totalcommision;
								$itax = $row["tax"] + $itax;
								// $final_commission = (($mrp * $quantity) + $tax) * ($commision / 100);
								// $final_commission = (($mrp * $quantity)) * ($commision / 100);
								// $totalcommision +=$final_commission;

								// update commission of that product
								// $this->CI->custom_model->my_update(array('commision' => $final_commission), array('item_id' => $item_id), 'order_items');

								$sub_total = decnum($sub_total + ($price * $quantity));
								$inv_shipping_charge = $row['shipping_cost'] + $inv_shipping_charge;
								// $itax = $tax;
								// $final_itax = (($mrp * $quantity)) * ($tax / 100);
								// $itax +=$final_itax;
							}
						}

						$net_total = decnum($sub_total + $inv_shipping_charge + $itax + $totalcommision);

						// echo "<br>";
						// print_r($net_total);
						// echo "<br>";


						$datasi['sub_total'] 		= $sub_total;
						$datasi['shipping_cost'] 	= $inv_shipping_charge;
						$datasi['net_total'] 		= $net_total;
						$datasi['commission'] 		= $totalcommision;
						$datasi['created_date'] 	= $this->order_datetime;
						$datasi['tax'] 				= $itax;
						$datasi['is_show'] 				= $post_arr['is_show'];

						$inv_id = $this->CI->custom_model->my_insert($datasi, 'order_invoice');
						$invoice_ref = date('YmdH') . $in_items . $inv_id;

						$this->CI->custom_model->my_update(array('invoice_ref' => $invoice_ref), array('invoice_id' => $inv_id), 'order_invoice');
					}



					// $final_net_total 	= $sub_total1 + $shipping_charge;
					// $myNumber 			= $sub_total;
					// $percentInDecimal 	= $tax1 / 100;
					// $tax1 				= $percentInDecimal * $myNumber;

					// $commission	=($tax_table[0]['commission']*$sub_total1)/100;	

					if ($post_arr['payment_mode'] == 'va_transfer') {
						if ($currency == 'USD') {
							$bank_fees = $tax_table[0]['bank_fees_cod'] / $tax_table[0]['sar_rate'];
						} else {
							$bank_fees = $tax_table[0]['bank_fees_cod'];
						}
					} else {
						$bank_fees = $tax_table[0]['bank_fees_online'];
						$bank_fees = ($bank_fees * $sub_total1) / 100;
					}
					if ($currency == 'USD') {
						$transfer_fees = $tax_table[0]['transfer_fees'] / $tax_table[0]['sar_rate'];
					} else {
						$transfer_fees = $tax_table[0]['transfer_fees'];
					}

					$all_fees = $total_commission + $bank_fees + $transfer_fees;
					$sub_total2 = $sub_total1 + $all_fees;


					$tax1 = ($tax * $sub_total2) / 100;
					$shipping_charge = $post_arr['shipping_charge'];
					// $tax1 				=decnum($tax1);                
					// $final_net_total 	= decnum( $final_net_total + $tax1 +$commission );
					$final_net_total 	= decnum($sub_total2 + $tax1 + $shipping_charge);


					$this->CI->custom_model->my_update(array('display_order_id' => $display_order_id, "shipping_charge" => $shipping_charge, "sub_total" => $sub_total1, "net_total" => $final_net_total, "tax" => $tax1, "commission" => $total_commission, 'currency' => $currency, 'transfer_fees' => $transfer_fees, 'bank_fees' => $bank_fees), array('order_master_id' => $oid), 'order_master');

					// data to be inserted in the va_transactions table @ap@
					$transaction_id = date('YmdHis') . $oid;
					$va_data = array([
						'user_id' => $uid,
						'order_id' => $oid,
						'recepient_id' => $ikey,
						'amount' => $final_net_total,
						'transaction_type' => 'debit',
						'payment_note' => 'success',
						'status' => 1,
						'created_at' => date("Y-m-d H:i:s"),
						'transaction_id' => $transaction_id,
					]);

					// print_r($va_data);
					// die;
					// exit();

					// insert transaction details in db @ap@
					$va_transaction_id = $this->CI->custom_model->my_insert($va_data[0], 'va_transactions');

					$data['display_order_id'] = $display_order_id;
					$data['order_date'] = date('j F Y, g:i a');
					$data['shipping_add'] = $post_arr['address_1'] . ' , ' . @$post_arr['address_2'] . ' , ' . $post_arr['city'] . ', ' . $post_arr['country'] . ', ' . $post_arr['state'] . ', ' . $post_arr['pincode'];
					$data['sub_total'] = $sub_total1;
					$data['shipping_charge'] = $shipping_charge;
					$data['tax'] = $tax1;
					$data['commission'] = $total_commission;
					$data['email'] = $post_arr['email'];
					$data['net_total'] = $final_net_total;
					$data['customer_name'] = $post_arr['first_name'] . ' ' . $post_arr['last_name'];
					$data['customer_zip'] = $post_arr['pincode'];
					$data['customer_city'] = $post_arr['city'];
					$data['customer_nation'] = $post_arr['country'];
					$data['customer_address'] = $post_arr['address_1'] . ' ' . @$post_arr['address_2'];
					$data['customer_tel'] = $post_arr['mobile_no'];
					return $data;
				} else {
					return false;
				}
			} else {
				return false;
			}
		
	}

	public function create_group_order($post_arr, $products, $uid, $source, $currency, $tax_table)
	{


		$data = array();

		if (!empty($post_arr)) {
			if (!empty($products)) {
				$post_arr['delivery_date'] 	= $this->order_datetime;
				$post_arr['net_total'] = "0";
				$post_arr['sub_total'] = "0";

				if (isset($post_arr['single_price'])) {
					// this price for purchase invoice
					$single_price = $post_arr['single_price'];
					unset($post_arr['single_price']);
				}

				// $tax_table = $this->CI->custom_model->my_where('tax','*',array('id'=>'1'));

				// if (!empty($tax_table))
				// {
				// 	$post_arr['shipping_charge'] = $tax_table[0]['shipping_charge'];
				// }
				// else
				// {
				// 	$post_arr['shipping_charge'] = '0';
				// }

				// echo "<pre>";
				// print_r($shipping_charge);
				// die;

				if ($post_arr['payment_mode'] == 'cash-on-del') {
					$post_arr['payment_status'] = 'Unpaid';
					$post_arr['is_show'] = '1';
				} else {
					$post_arr['payment_status'] = 'Unpaid';
					$post_arr['is_show'] = 0;
				}

				// insert in order_master



				$post_arr['user_id'] 		= $uid;
				$post_arr['order_datetime'] = $this->order_datetime;

				// echo "<pre>";print_r($post_arr);die;

				$oid = $this->CI->custom_model->my_insert($post_arr, 'group_orders');
				// Update display_order_id
				// echo "<pre>";
				// print_r($post_arr);
				// print_r($oid);
				// die;			
				// insert in order_items
				$invoice = $itesmval = $prd_cat  = array();

				$sub_total1 = $net_total1 = $tax1 = $total_commission = 0;

				$tax = $tax_table[0]['vat'];



				foreach ($products as $key => $value) {
					// print_r($value);
					$item = array();
					$curr = $this->CI->custom_model->my_where('product', 'id,category,product_name,sale_price,price,product_image,seller_id,stock,price_select,is_delivery_available', array('id' => $value['pid']));

					$data['remove_pr'][] = $curr[0]['id'];

					$curr1 = $this->CI->custom_model->my_where('admin_users', 'id,first_name,email', array('id' => $curr[0]['seller_id']));


					$prd_cat[] = $curr[0]['category'];
					if (isset($value['metadata']) && !empty($value['metadata'])) {
						// $price=	$value['metadata']['price'];						
						$item['attribute'] = 'Size-' . $value['metadata']['size'];
					}
					if ($curr[0]['sale_price'] == 0.00) {
						$price = $curr[0]['price'];
					} else {
						$price = $curr[0]['sale_price'];
					}

					if (isset($single_price)) {
						// this for order purchase form quotation invoice
						$price = $single_price;
					}

					if ($currency == 'USD') {
						$price = $price / $tax_table[0]['sar_rate'];
						// $price=round($price);
					}

					// if($currency=='SAR')
					// {                                  
					// $price=$price*$tax_table[0]['sar_rate'];
					// $price=round($price);
					// }else if($currency=='USD'){
					// $price=$price*$tax_table[0]['usd_rate'];
					// $price=round($price);
					// }
					// echo $price;
					// die;

					$item['order_no'] = $oid;
					$item['user_id'] = $uid;
					$item['product_id'] = $value['pid'];
					$item['unit'] = @$value['unit'];
					$item['price'] = decnum($price);
					$item['seller_id'] = $curr[0]['seller_id'];
					$item['is_delivery_available'] = $curr[0]['is_delivery_available'];

					$data['product'][$key]['quantity'] = $item['quantity'] = $value['qty'];
					$data['product'][$key]['name'] = $item['product_name'] = $curr[0]['product_name'];
					$data['product'][$key]['price'] = $price;
					$data['product'][$key]['sale_price'] = $price;
					$data['product'][$key]['product_image'] = $curr[0]['product_image'];


					$pro_total = $price * $value['qty'];
					$commission = $tax_table[0]['commission'];
					$single_commission = ($commission * $pro_total) / 100;
					if ($single_commission > $tax_table[0]['cap_rate']) {
						$single_commission = $tax_table[0]['cap_rate'];
					}
					$total_commission = $single_commission + $total_commission;
					$pro_total = $pro_total + $single_commission;
					$single_vat = ($tax * $pro_total) / 100;

					$item['sub_total'] 		= decnum($price * $value['qty']);
					$item['tax'] 			= $single_vat;
					$item['commision'] 			= $single_commission;
					// $item['shipping_cost'] 	= $post_arr['shipping_charge'];
					$item['shipping_cost'] 	= @$value['shipping_cost'];
					$item['payment_status'] = $post_arr['payment_status'];
					$item['payment_mode'] 	= $post_arr['payment_mode'];
					$item['delivery_date'] 	= $post_arr['delivery_date'];
					$item['order_status'] 	= 'Pending';
					$item['created_date'] = $this->order_datetime;



					$item_id = $this->CI->custom_model->my_insert($item, 'group_order_items');

					// reduce quantity from stock
					if (isset($value['metadata']) && !empty($value['metadata']) & $curr[0]['price_select'] == 2) {

						$product_attribute = $this->CI->custom_model->my_where('product_attribute', 'qty', array('p_id' => $value['pid'], 'attribute_id' => '20', 'item_id' => $value['metadata']['attribute_item_id']));

						$update2['qty'] = $product_attribute[0]['qty'] - $value['qty'];
						if ($update2['qty'] == 0 || $update2['qty'] < 0) {
							$update2['qty'] 	= '0';
						}

						$this->CI->custom_model->my_update($update2, array('p_id' => $value['pid'], 'attribute_id' => '20', 'item_id' => $value['metadata']['attribute_item_id']), 'product_attribute');
					} else {
						$update['stock'] = $curr[0]['stock'] - $value['qty'];

						if ($update['stock'] == 0 || $update['stock'] < 0) {
							$update['stock_status'] = 'notinstock';
							$update['stock'] 		= '0';
						}

						$this->CI->custom_model->my_update($update, array('id' => $value['pid']), 'product');
						$this->CI->custom_model->my_update($update, array('id' => $value['pid']), 'product_trans');
					}
					// group omit

					$item['product_image'] 	= $curr[0]['product_image'];
					$item['mrp'] 			= $price;
					$item['vender_email'] 	= $curr1[0]['email'];
					$item['category'] 		= $curr[0]['category'];
					$itesmval[$item_id] 	= $item;

					$invoice_seller_id 							= $curr[0]['seller_id'];
					$invoice[$invoice_seller_id]['order_no'] 	= $oid;
					$invoice[$invoice_seller_id]['items'][] 	= $item_id;
					// $invoice[$invoice_seller_id]['commision'] 	= $tax;
					// $invoice[$invoice_seller_id]['commision'] 	= $tax_table[0]['commission'];

					$sub_total1 = decnum($sub_total1 + $item['sub_total']);

					$additional_percentage = $response = array();
					$additional_percentage['trans_ref'] = date('Ymd') . $item_id;
					$item_id = $this->CI->custom_model->my_update($additional_percentage, array("item_id" => $item_id), "group_order_items");
				}

				$display_order_id = date('YmdHis') . $oid;

				$datasi = array();

				$in_items = '';
				foreach ($invoice as $ikey => $ivalue) {
					// $commision =  $ivalue['commision'];
					$datasi['order_status'] = "Pending";
					$datasi['display_order_id'] = $display_order_id;
					$datasi['payment_status'] = "Pending";
					$datasi['payment_mode'] = $post_arr['payment_mode'];
					$datasi['order_no'] = $ivalue['order_no'];
					$datasi['item_ids'] = implode(",", $ivalue['items']);
					$datasi['seller_id'] = $ikey;

					$sub_total = $transaction_cost = $net_total = 0;
					$itax = $totalcommision = 0;

					// $shipping_charge = $post_arr['shipping_charge'];
					$inv_shipping_charge = 0;
					if ($ivalue['items']) {
						foreach ($ivalue['items'] as $item_id) {
							$in_items = $in_items . '' . $item_id;
							$row = $itesmval[$item_id];
							$product_name = $row["product_name"];
							$quantity = $row["quantity"];
							$price = $row["price"];
							// $tax = 0;
							$vender_email = $row['vender_email'];
							$category = $row['category'];
							$mrp = $row['mrp'];
							$totalcommision = $row["commision"] + $totalcommision;
							$itax = $row["tax"] + $itax;
							// $final_commission = (($mrp * $quantity) + $tax) * ($commision / 100);
							// $final_commission = (($mrp * $quantity)) * ($commision / 100);
							// $totalcommision +=$final_commission;

							// update commission of that product
							// $this->CI->custom_model->my_update(array('commision' => $final_commission), array('item_id' => $item_id), 'order_items');

							$sub_total = decnum($sub_total + ($price * $quantity));
							$inv_shipping_charge = $row['shipping_cost'] + $inv_shipping_charge;
							// $itax = $tax;
							// $final_itax = (($mrp * $quantity)) * ($tax / 100);
							// $itax +=$final_itax;
						}
					}

					$net_total = decnum($sub_total + $inv_shipping_charge + $itax + $totalcommision);


					// echo "<br>";


					$datasi['sub_total'] 		= $sub_total;
					$datasi['shipping_cost'] 	= $inv_shipping_charge;
					$datasi['net_total'] 		= $net_total;
					$datasi['commission'] 		= $totalcommision;
					$datasi['created_date'] 	= $this->order_datetime;
					$datasi['tax'] 				= $itax;
					$datasi['is_show'] 				= $post_arr['is_show'];

					$inv_id = $this->CI->custom_model->my_insert($datasi, 'part_order_invoice');

					// echo "<br>";

					$invoice_ref = date('YmdH') . $in_items . $inv_id;

					$this->CI->custom_model->my_update(array('invoice_ref' => $invoice_ref), array('invoice_id' => $inv_id), 'part_order_invoice');
				}


				// $final_net_total 	= $sub_total1 + $shipping_charge;
				// $myNumber 			= $sub_total;
				// $percentInDecimal 	= $tax1 / 100;
				// $tax1 				= $percentInDecimal * $myNumber;

				// $commission	=($tax_table[0]['commission']*$sub_total1)/100;	

				if ($post_arr['payment_mode'] == 'cash-on-del') {
					if ($currency == 'USD') {
						$bank_fees = $tax_table[0]['bank_fees_cod'] / $tax_table[0]['sar_rate'];
					} else {
						$bank_fees = $tax_table[0]['bank_fees_cod'];
					}
				} else {
					$bank_fees = $tax_table[0]['bank_fees_online'];
					$bank_fees = ($bank_fees * $sub_total1) / 100;
				}
				if ($currency == 'USD') {
					$transfer_fees = $tax_table[0]['transfer_fees'] / $tax_table[0]['sar_rate'];
				} else {
					$transfer_fees = $tax_table[0]['transfer_fees'];
				}

				$all_fees = $total_commission + $bank_fees + $transfer_fees;
				$sub_total2 = $sub_total1 + $all_fees;


				$tax1 = ($tax * $sub_total2) / 100;
				$shipping_charge = $post_arr['shipping_charge'];
				// $tax1 				=decnum($tax1);                
				// $final_net_total 	= decnum( $final_net_total + $tax1 +$commission );
				$final_net_total 	= decnum($sub_total2 + $tax1 + $shipping_charge);


				$this->CI->custom_model->my_update(array('display_order_id' => $display_order_id, "shipping_charge" => $shipping_charge, "sub_total" => $sub_total1, "net_total" => $final_net_total, "tax" => $tax1, "commission" => $total_commission, 'currency' => $currency, 'transfer_fees' => $transfer_fees, 'bank_fees' => $bank_fees), array('id' => $oid), 'group_orders');

				$data['display_order_id'] = $display_order_id;
				$data['order_date'] = date('j F Y, g:i a');
				$data['shipping_add'] = $post_arr['address_1'] . ' , ' . @$post_arr['address_2'] . ' , ' . $post_arr['city'] . ', ' . $post_arr['country'] . ', ' . $post_arr['state'] . ', ' . $post_arr['pincode'];
				$data['sub_total'] = $sub_total1;
				$data['shipping_charge'] = $shipping_charge;
				$data['tax'] = $tax1;
				$data['commission'] = $total_commission;
				$data['email'] = $post_arr['email'];
				$data['net_total'] = $final_net_total;
				$data['customer_name'] = $post_arr['first_name'] . ' ' . $post_arr['last_name'];
				$data['customer_zip'] = $post_arr['pincode'];
				$data['customer_city'] = $post_arr['city'];
				$data['customer_nation'] = $post_arr['country'];
				$data['customer_address'] = $post_arr['address_1'] . ' ' . @$post_arr['address_2'];
				$data['customer_tel'] = $post_arr['mobile_no'];
				// print_r($data);
				// 	exit();
				return $data;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function check_pro_available_or_not()
	{
		$available_cat = $this->CI->custom_model->get_data_array("SELECT * FROM  category  ");
		if (!empty($available_cat)) {
			foreach ($available_cat as $skey => $svalue) {
				$cat_id = $svalue['id'];
				$cat_status = $svalue['status'];

				if ($cat_status == 'deactive') {
					$product_detail = $this->CI->custom_model->my_where("product", "id,category", array('category' => $cat_id, 'product_delete' => '0'));

					if (!empty($product_detail)) {
						foreach ($product_detail as $dkey => $dvalue) {
							$pid = $dvalue['id'];

							$this->CI->custom_model->my_update(array('category_status' => 'deactive'), array('id' => $pid), 'product');
							$this->CI->custom_model->my_update(array('category_status' => 'deactive'), array('id' => $pid), 'product_trans');
						}
					}
				} else {
					$product_detail = $this->CI->custom_model->my_where("product", "id,category", array('category' => $cat_id, 'product_delete' => '0'));

					// echo "<pre>";
					// print_r($product_detail);
					// die;

					if (!empty($product_detail)) {
						foreach ($product_detail as $dkey => $dvalue) {
							$pid = $dvalue['id'];

							$this->CI->custom_model->my_update(array('category_status' => 'active'), array('id' => $pid), 'product');
							$this->CI->custom_model->my_update(array('category_status' => 'active'), array('id' => $pid), 'product_trans');

							$this->CI->custom_model->my_update(array('has_product' => '1'), array('id' => $cat_id), 'category');
							$this->CI->custom_model->my_update(array('has_product' => '1'), array('id' => $cat_id), 'category_trans');
						}
					} else {
						$this->CI->custom_model->my_update(array('has_product' => '0'), array('id' => $cat_id), 'category');
						$this->CI->custom_model->my_update(array('has_product' => '0'), array('id' => $cat_id), 'category_trans');
					}
				}
			}
		}
		// die;

	}


	public function rating($pid)
	{

		$user_review = $this->CI->custom_model->my_where("user_rating", "*", array('pid' => $pid, 'status' => 'active'));
		if (!empty($user_review)) {
			$avg = 0;
			foreach ($user_review as $dkey => $svalue) {
				$avg += $svalue['rating'];
			}
			$response['rating'] = round($avg / count($user_review));
			$response['user_count'] = count($user_review);

			// $product_listing[$dkey]['rating']       =     $response['rating'];
			// $product_listing[$dkey]['user_count']   =     $response['user_count'];

			$response['rating'] 		= $response['rating'];
			$response['user_count'] 	= $response['user_count'];

			return $response;
		} else {
			// $product_listing[$dkey]['rating'] = "0";
			// $product_listing[$dkey]['user_count'] = "0";

			$response['rating'] 		= 0;
			$response['user_count'] 	= 0;
			return $response;
		}
	}
}
