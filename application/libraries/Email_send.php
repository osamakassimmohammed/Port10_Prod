<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Library to add cart/ add wish list
 */
class Email_send
{

	protected $order_datetime;

	public function __construct()
	{
		// Assign the CodeIgniter super-object
		$this->CI = &get_instance();
		$this->CI->load->model('admin/Custom_model', 'custom_model');
		date_default_timezone_set("Asia/Riyadh");
		$this->order_datetime = date('Y-m-d H:i:s');
		$this->CI->load->library('email_cilib');
	}

	public function send_invoice($display_order_id = '')
	{

		// $display_order_id = '201905021611181';


		$row9 = $this->CI->custom_model->my_where('order_master', '*', array('display_order_id' => $display_order_id));

		// echo "<pre>";
		// print_r($row9);
		// die;

		$currency = $row9[0]['currency'];

		$order_master_id     		= $row9[0]['order_master_id'];
		$payment_status     		= $row9[0]['payment_status'];
		$payment_mode       		= $row9[0]['payment_mode'];
		$customer_id        		= $row9[0]['user_id'];
		$sub_total          		= $row9[0]['sub_total'];
		$shipping_charge    		= $row9[0]['shipping_charge'];
		$net_total    				= $row9[0]['net_total'] - $row9[0]['coupon_price'];
		$tax    					= $row9[0]['tax'];
		$all_fees    				= $row9[0]['transfer_fees'] + $row9[0]['bank_fees'] + $row9[0]['commission'];

		$users_details   = $this->CI->custom_model->my_where('admin_users', 'email,phone', array('id' => $customer_id));
		$users_name     =    $row9[0]['first_name'];
		$users_address  =  @$row9[0]['address_1'] . ' ,' . $row9[0]['address_2'] . ' , ' . $row9[0]['country'] . ' , ' . $row9[0]['state'] . ' , ' . $row9[0]['city'] . ' , ' . $row9[0]['pincode'];

		// echo "<pre>";
		// print_r($users_details);
		// die;

		$users_phone    =    $row9[0]['mobile_no'];
		$users_email    =    $row9[0]['email'];
		$u_email   		=    $row9[0]['email'];

		$order_id =     $row9[0]['order_master_id'];
		// $u_data = $this->CI->custom_model->my_where('users','*',array('id' => $row9[0]['customer_id']));

		$product_detail = $this->CI->custom_model->my_where('order_items', '*', array('order_no' => $order_id));
		if ($product_detail) {
			foreach ($product_detail as $d_key => $row) {
				$items_extra_data = $this->CI->custom_model->my_where('items_extra_data', '*', array('item_id' => $row['item_id']));
				$product_detail[$d_key]['product_cust_data'] = $items_extra_data;

				$attribute = $row["attribute"];
				if (!empty($attribute)) {
					$product_name = $row["product_name"] . ' (' . $attribute . ')';
				} else {
					$product_name = $row["product_name"];
				}

				$quantity = $row["quantity"];
				$paym = '<tr><td>' . $product_name . '</td><td>' . $quantity . '</td></td><td></td></tr>';
			}
		}

		// echo "<pre>";
		// print_r($product_detail);
		// die;

		$new_html_loop = '';
		foreach ($product_detail as $key1 => $value1) {
			$attribute = $value1["attribute"];
			if (!empty($attribute)) {
				$product_name = $value1["product_name"] . ' (' . $attribute . ')';
			} else {
				$product_name = $value1["product_name"];
			}

			$product_cust_data = '';

			// if (!empty($value1['product_cust_data']))
			// {
			// 	foreach ($value1['product_cust_data'] as $pkey => $pvalue)
			// 	{
			// 		if ($pvalue['price'] == '0')
			// 		{
			// 			$c_price = 'Free';
			// 		}
			// 		else
			// 		{
			// 			$c_price = $pvalue['price'].' '.$currency;
			// 		}
			// 		$product_cust_data.='<p>'.$pvalue['name'].' :- '.$c_price.'</p>';
			// 	}
			// }

			$p_info =  $this->CI->custom_model->my_where('product', '*', array('id' => $value1['product_id']));

			// echo "<pre>";print_r($p_info);
			// $sku = $p_info[0]['tags'];
			$sku = "123123";

			$new_html_loop .= '<tr style="padding:12px;border:1px solid #333;width:185px;">';

			$new_html_loop .= '<td style="padding:12px;border:1px solid #333;width:185px;" colspan="4">
		             ' . $product_name . '';
			$new_html_loop .= '</td>';

			// $new_html_loop.='<td style="padding:12px;border:1px solid #333;width:185px;" colspan="3">
			//          '.$product_cust_data.'';
			// $new_html_loop.='</td>'; 


			$new_html_loop .= '<td style="padding:12px;border:1px solid #333;width:185px;">
		              ' . $value1['quantity'] . '';
			$new_html_loop .= '</td>';
			$new_html_loop .= '<td colspan="2" style="padding:12px;border:1px solid #333;width:185px;">
		             ' . $currency . ' ' . $value1['price'];
			$new_html_loop .= '</td>';
			$new_html_loop .= '</tr>';
		}
		$couon_row = '';
		if (!empty($row9[0]['coupon_code'])) {
			$couon_row = ' <tr style="padding:12px;border:1px solid #333;width:185px;">


		                  <td style="padding:12px;border:1px solid #333;width:185px;" colspan="4">
		                      <p style="margin:0px;">Coupon Price</p>		                      
		                  </td> 
		                  <td style="padding:12px;border:1px solid #333;width:185px;" colspan="4">
		                      <p style="margin:0px;">' . $currency . ' ' . $row9[0]['coupon_price'] . '</p>
		                  </td>

		                  
		              </tr>';
		}
		// echo $new_html_loop;
		// die;

		//  $message = '<div class="container" style=" margin:0 auto;padding-top:0px; padding:40px;width:750px; height:auto; background-color:#fff;">
		$message = '<div class="container" style=" background-color:#fff;">
		      <table style="border:1px solid #333;border-collapse:collapse;margin:0 auto; 
		      width:1000px;">
		          <caption style="text-align: center;font-weight: bold; font-size:28px;margin-bottom:15px; font-family: "Open Sans", sans-serif;line-height: 1;color: #5b5b5b;">
		              Order invoice : - <a href=" ' . base_url('/invoice/pdf/') . $order_master_id . ' "> Download PDF </a> 
		          </caption>

		          <thead>
		              <tr style="padding:12px;border:1px solid #333;">
		                  <th style=" padding: 10px;   background-color: #f0f0f0; text-align: left;" colspan="5" >Name : &nbsp;' . $users_name . '</th>
		                  <th colspan="1"style="padding: 10px;  border: 1px solid;background-color: #f0f0f0; text-align: left;">
		                      Invoice id:#' . $order_master_id . '
		                  </th>
		                  <th colspan="1"style="padding: 10px;  border: 1px solid;background-color: #f0f0f0; text-align: left;">
		                      Invoice number: #123456456
		                  </th>

		              </tr>
		              <tr style="padding:12px;border:1px solid #333;width:185px;">
		              <td style="padding:12px;border:1px solid #333;width:185px; background-color: #f0f0f0; font-weight: bold;" colspan="4">
		                  <p style="margin:0px;">Address:</p>
		                  <p style="margin:0px;">Mobile no:</p>
		                  <p style="margin:0px;">Email:</p>		                  
		              </td>
		               
		              
		              <td style="padding:12px;border:1px solid #333;width:185px;" colspan="4">
		                  <p style="margin:0px;">' . $users_address . ' </p>
		                  <p style="margin:0px;">' . $users_phone . ' </p>
		                  <p style="margin:0px;">' . $users_email . ' </p>	                  
		              </td>
		              
		          </tr>
		              
		          </thead>
		          <tbody>
		              <tr style="padding:12px;border:1px solid #333;width:185px;">
		                  <th style="border-bottom: 1px solid; padding: 10px; border: 1px solid; background-color: #f0f0f0;" colspan="4">Product Name</th>		                  
		                  

		                  <th style=" border-bottom: 1px solid; padding: 10px; border: 1px solid;background-color: #f0f0f0;">Qty</th>
		                  <th colspan="2" style="padding: 10px; border: 1px solid;background-color: #f0f0f0;">Sub Total</th>
		              </tr>' . $new_html_loop . '
		              <tr>
		                  <th style="padding: 10px;background-color: #f0f0f0;font-weight: bold;text-align: center;font-size: 14px;border: 1px solid;" colspan="8">Billing Details </th>
		              </tr>
		              <tr> 
		                  <th  colspan="4" style="border-bottom: 1px solid;padding:12px; background-color: #f0f0f0;border:1px solid #333;width:185px; text-align: left;font-family: "Open Sans", sans-serif;line-height: 1;color: #5b5b5b;border: 1px solid #333;" >Order id 
		                  </th>
		                  <td style="padding:12px;border:1px solid #333;width:185px;" colspan="4">
		                       ' . $display_order_id . '
		                  </td>    
		              </tr>
		              <tr>
		                  <th colspan="4" style="border-bottom: 1px solid; background-color: #f0f0f0; padding:12px;border:1px solid #333;width:185px;text-align: left;font-family: "Open Sans", sans-serif;line-height: 1;color: #5b5b5b;" colspan="4">Payment Mode</th>
		                  <td  colspan="4" style=" padding:12px;border:1px solid #333;width:185px; text-transform: capitalize;" >
		                      ' . $payment_mode . '
		                  </td>   
		              </tr>
		              <tr>
		                  <th colspan="4" style="border-bottom: 1px solid!important; padding:12px;background-color: #f0f0f0;border:1px solid #333;width:185px; text-align: left;font-family: "Open Sans", sans-serif;line-height: 1;color: #5b5b5b;" colspan="4">payment Status</th>
		                  <td style="padding:12px;border:1px solid #333;width:185px;" colspan="4">
		                      ' . $payment_status . '
		                  </td>  
		              </tr>
		              <tr style="padding:12px;border:1px solid #333;width:185px;">
		                  <th colspan="4" style="padding:12px;background-color: #f0f0f0;border:1px solid #333;width:185px; text-align: left;font-family: "Open Sans", sans-serif;line-height: 1;color: #5b5b5b;" colspan="4">Total Amount</th>
		                  <td colspan="4" style="padding:12px;border:1px solid #333;width:185px;" colspan="4">
		                      ' . $currency . ' ' . $net_total . ' 
		                  </td>   
		              </tr>
		              <tr style="padding:12px;border:1px solid #333;width:185px;">
		                  <th style="padding: 10px;background-color: #f0f0f0;font-weight: bold;text-align: center;font-size: 14px;" colspan="8"> Order Invoice <p style="margin:0px; font-size: 15px;"></p></th>
		                  <!-- <td>110.00</td> -->
		              </tr>
		          </tbody>
		          <tfoot>
		              <tr style="padding:12px;border:1px solid #333;width:185px;">

		                  <td style="padding:12px;border:1px solid #333;width:185px;" colspan="4">
		                      <p style="margin:0px;">Subtotal</p>		                      
		                  </td>                           
		                  <td style="padding:12px;border:1px solid #333;width:185px;" colspan="4">
		                      <p style="margin:0px;">' . $currency . ' ' . $sub_total . ' </p>
		                  </td>
		              </tr>	

		              <tr style="padding:12px;border:1px solid #333;width:185px;">

		                  <td style="padding:12px;border:1px solid #333;width:185px;" colspan="4">
		                      <p style="margin:0px;">Fees</p>		                      
		                  </td>                           
		                  <td style="padding:12px;border:1px solid #333;width:185px;" colspan="4">
		                      <p style="margin:0px;">' . $currency . ' ' . $all_fees . ' </p>
		                  </td>
		              </tr>	

		              <tr style="padding:12px;border:1px solid #333;width:185px;">

		                  <td style="padding:12px;border:1px solid #333;width:185px;" colspan="4">
		                      <p style="margin:0px;">Vat</p>		                      
		                  </td>                           
		                  <td style="padding:12px;border:1px solid #333;width:185px;" colspan="4">
		                      <p style="margin:0px;">' . $currency . ' ' . $tax . ' </p>
		                  </td>
		              </tr>		             
		              
		              ' . $couon_row . '
		              <tr style="padding:12px;border:1px solid #333;width:185px;">

		                  <td style="padding:12px;border:1px solid #333;width:185px;" colspan="4">
		                      <p style="margin:0px;">Grand Total</p>
		                  </td>                           
		                  <td style="padding:12px;border:1px solid #333;width:185px;" colspan="4">
		                      <p style="margin:0px;"> ' . $currency . ' ' . $net_total . ' </p>
		                  </td>
		              </tr>

		          </tfoot>
		      </table>
		  </div>';

		// echo "<pre>";
		// print_r($message);
		// die;

		// $users_email = 'girishbhumkar5@gmail.com';		  

		$subject = "Order Confirmation & Invoice";

		// send_email_using_postmark($users_email,$subject,$message);
		// send_email($users_email,$subject,$message);
		$this->CI->email_cilib->send_email_ci($users_email, $subject, $message);
		// send_email_using_sendinblue($users_email,$subject,$message);

	}

	public function send_invoice_new_en($display_order_id = '')
	{
		$order_master = $this->CI->custom_model->my_where('order_master', 'order_master_id,display_order_id,first_name,last_name,net_total,user_id,currency,payment_mode,email', array('display_order_id' => $display_order_id));
		if (!empty($order_master)) {
			if ($order_master[0]['payment_mode'] == 'cash-on-del') {
				$payment_mode = 'Virtual Account Transfer';
			} else {
				$payment_mode = 'Credit Card';
			}
			$product_name = '';
			$order_items = $this->CI->custom_model->my_where('order_items', 'product_name', array('order_no' => $order_master[0]['order_master_id']));
			if (!empty($order_items)) {
				foreach ($order_items as $oi_key => $oi_val) {
					$product_name .= $oi_val['product_name'] . ',';
				}
				$product_name = rtrim($product_name, ",");
			}
			// echo "<pre>";
			// print_r($order_items);  		
			// print_r($product_name);  		
			$html_tag = '';
			$html_tag .= '<!DOCTYPE html>
			<html>
			   <head>
			      <title>Index</title>
			   </head>
			   <style>
			      html, body{
			      padding:0px;
			      margin:0px;
			      font-family: arial;
			      font-size: 14px;
			      }
			      div{
			      box-sizing: border-box;
			      }
			      .row_padng td{
			      padding:10px 0px;
			      }
			   </style>';
			$html_tag .= '<body>
			      <div style="text-align: center; background: #f3f3f3; " >
			         <div style="width: 750px; background: #fff; box-shadow: 0px 0px 4px 1px #cccccc25; display: inline-block; margin: 20px 0px; padding: 0px 15px 10px 15px; border-radius: 8px; border-top: 5px solid #3db74e; border-bottom: 5px solid #3db74e; " >
			            <div style="padding:10px 0px;">
			               <img src="' . base_url('assets/frontend/images/icon/logo.png') . '" style="width: 130px; margin-top: 10px; margin-bottom: 30px; " >
			            </div>
			            <div style="clear:both;"></div>
			            <div style="width: 100%;">
			               <div style="width: 100%; font-weight: 600; font-size: 20px; margin-top: 00px;" > 
			                  Hello ' . $order_master[0]['first_name'] . ' ' . $order_master[0]['last_name'] . ' 
			               </div>
			               <div style="width: 100%; font-weight: 500; margin-top:15px; font-size: 18px; line-height: 24px; " >
			                  Thank you for ordering for Port10.sa. <br> Here’s a summary of your order :
			               </div>
			            </div>
			            <div style="clear:both;"></div>
			               <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
			                  <div style="display: inline-block;">
			                     Reference Number :
			                  </div>
			                  <div style="display: inline-block; font-weight: 600; ">
			                     ' . $order_master[0]['display_order_id'] . '
			                  </div>
			                  <div style="clear:both;"></div>
			               </div>

			               <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
			                  <div style="display: inline-block;">
			                     Product :
			                  </div>
			                  <div style="display: inline-block; font-weight: 600; ">
			                     ' . $product_name . '
			                  </div>
			                  <div style="clear:both;"></div>
			               </div>

			               <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
			                  <div style="display: inline-block;">
			                     Invoice amount :
			                  </div>
			                  <div style="display: inline-block; font-weight: 600; ">
			                     ' . number_format($order_master[0]['net_total'], 2) . ' ' . $order_master[0]['currency'] . '
			                  </div>
			                  <div style="clear:both;"></div>
			               </div>

			               <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
			                  <div style="display: inline-block;">
			                     Payment Method :
			                  </div>
			                  <div style="display: inline-block; font-weight: 600; ">
			                     ' . $payment_mode . '
			                  </div>
			                  <div style="clear:both;"></div>
			               </div>
			            <div style="clear:both;"></div>
			            

			            <div  style="width: 100%; font-weight: 500; margin-top: 15px; font-size: 17px; line-height: 22px; padding: 0px 00px; margin-top: 20px;" >
			               If paying by Virtual Account Transfer, your order will be processed once we receive payment and a copy of the invoice will be available at the ‘’Orders’’ section of your account.
			            </div>
			            <div style="clear:both;"></div>
			            <div style="font-weight: 600; font-size: 22px; margin-top: 40px; margin-bottom: 10px; color: #004670;">
			               Thanks,
			               Team Port10
			            </div>
			            <div style="clear:both;"></div>
			         </div>
			         
			      </div>
			   </body>
			</html>';
			// echo $html_tag;
			// die;
			$subject = "Order Confirmation & Invoice";
			// $this->CI->email_cilib->send_email_ci($order_master[0]['email'],$subject,$html_tag);
			$this->CI->email_cilib->send_welcome('itsmesayan06@gmail.com', $subject, $html_tag);
		}
	}

	public function send_invoice_new_ar($display_order_id = '')
	{
		$order_master = $this->CI->custom_model->my_where('order_master', 'order_master_id,display_order_id,first_name,last_name,net_total,user_id,currency,payment_mode,email', array('display_order_id' => $display_order_id));
		if (!empty($order_master)) {
			if ($order_master[0]['payment_mode'] == 'cash-on-del') {
				$payment_mode = 'Virtual Account Transfer';
			} else {
				$payment_mode = 'Credit Card';
			}
			$product_name = '';
			$order_items = $this->CI->custom_model->my_where('order_items', 'product_name', array('order_no' => $order_master[0]['order_master_id']));
			if (!empty($order_items)) {
				foreach ($order_items as $oi_key => $oi_val) {
					$product_name .= $oi_val['product_name'] . ',';
				}
				$product_name = rtrim($product_name, ",");
			}
			// echo "<pre>";
			// print_r($order_items);  		
			// print_r($product_name);  		
			$html_tag = '';
			$html_tag .= '<!DOCTYPE html>
			<html>
			   <head>
			      <title>Index</title>
			   </head>
			   <style>
			      html, body{
			      padding:0px;
			      margin:0px;
			      font-family: arial;
			      font-size: 14px;
			      }
			      div{
			      box-sizing: border-box;
			      }
			      .row_padng td{
			      padding:10px 0px;
			      }
			   </style>';
			$html_tag .= '<body>
			      <div style="text-align: center; background: #f3f3f3; " >
			          <div style="width: 750px; background: #fff; box-shadow: 0px 0px 4px 1px #cccccc25; display: inline-block; margin: 20px 0px; padding: 0px 15px 10px 15px; border-radius: 8px; border-top: 5px solid #3db74e; border-bottom: 5px solid #3db74e; " >
			            <div style="padding:10px 0px;">
			               <img src="' . base_url('assets/frontend/images/icon/logo.png') . '" style="width: 130px; margin-top: 10px; margin-bottom: 30px; " >
			            </div>
			            <div style="clear:both;"></div>
			            <div style="width: 100%;">
			               <div style="width: 100%; font-weight: 600; font-size: 20px; margin-top: 00px;" > 
			                   ' . $order_master[0]['first_name'] . ' ' . $order_master[0]['last_name'] . ' مرحبًا 
			               </div>
			               <div style="width: 100%; font-weight: 500; margin-top:15px; font-size: 18px; line-height: 24px; " >
			                  شكرا للطلب من Port10.sa. فيما يلي ملخص لطلبك:
			               </div>
			            </div>
			            <div style="clear:both;"></div>
			               <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
			                 
			                  <div style="display: inline-block; font-weight: 600; ">
			                     ' . $order_master[0]['display_order_id'] . '
			                  </div>
			                   <div style="display: inline-block;">
			                     رقم المرجع:
			                  </div>
			                  <div style="clear:both;"></div>
			               </div>

			               <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
			                  
			                  <div style="display: inline-block; font-weight: 600; ">
			                    ' . $product_name . '
			                  </div>
			                  <div style="display: inline-block;">
			                        المنتج
			                  </div>
			                  <div style="clear:both;"></div>
			               </div>

			               <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
			                  
			                  <div style="display: inline-block; font-weight: 600; ">
			                      ' . number_format($order_master[0]['net_total'], 2) . ' ' . $order_master[0]['currency'] . '
			                  </div>
			                  <div style="display: inline-block;">
			                     قيمة الفاتورة:
			                  </div>
			                  <div style="clear:both;"></div>
			               </div>

			               <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
			                  
			                  <div style="display: inline-block; font-weight: 600; ">
			                     ' . $payment_mode . '
			                  </div>
			                  <div style="display: inline-block;">
			                    طريقة الدفع:
			                  </div>
			                  <div style="clear:both;"></div>
			               </div>
			            <div style="clear:both;"></div>
			            

			            <div  style="width: 100%; font-weight: 500; margin-top: 15px; font-size: 17px; line-height: 22px; padding: 0px 00px; margin-top: 20px;" >
			               في حالة الدفع عن طريق حوالة على حسابك الافتراضي، ستتم معالجة طلبك بمجرد استلامنا للدفع وستتوفر نسخة من الفاتورة في قسم "الطلبات" بحسابك.
			            </div>
			            <div style="clear:both;"></div>
			            <div style="font-weight: 600; font-size: 22px; margin-top: 40px; margin-bottom: 10px; color: #004670;">
			               شكرا،
			               فريق بورت١٠
			            </div>
			            <div style="clear:both;"></div>
			         </div>
			         
			      </div>
			   </body>
			</html>';
			// echo $html_tag;
			// die;
			$subject = "Order Confirmation & Invoice";
			// $this->CI->email_cilib->send_email_ci($order_master[0]['email'],$subject,$html_tag);
			$this->CI->email_cilib->send_welcome($order_master[0]['email'], $subject, $html_tag);
		}
	}
	public function send_group_invoice_new_en($display_order_id = '')
	{
		$order_master = $this->CI->custom_model->my_where('group_orders', 'id,display_order_id,first_name,last_name,net_total,user_id,currency,payment_mode,email', array('display_order_id' => $display_order_id));
		if (!empty($order_master)) {
			if ($order_master[0]['payment_mode'] == 'cash-on-del') {
				$payment_mode = 'Virtual Account Transfer';
			} else {
				$payment_mode = 'Credit Card';
			}
			$product_name = '';
			$order_items = $this->CI->custom_model->my_where('group_order_items', 'product_name', array('order_no' => $order_master[0]['id']));
			if (!empty($order_items)) {
				foreach ($order_items as $oi_key => $oi_val) {
					$product_name .= $oi_val['product_name'] . ',';
				}
				$product_name = rtrim($product_name, ",");
			}
			// echo "<pre>";
			// print_r($order_items);  		
			// print_r($product_name);  		
			$html_tag = '';
			$html_tag .= '<!DOCTYPE html>
			<html>
			   <head>
			      <title>Index</title>
			   </head>
			   <style>
			      html, body{
			      padding:0px;
			      margin:0px;
			      font-family: arial;
			      font-size: 14px;
			      }
			      div{
			      box-sizing: border-box;
			      }
			      .row_padng td{
			      padding:10px 0px;
			      }
			   </style>';
			$html_tag .= '<body>
			      <div style="text-align: center; background: #f3f3f3; " >
			         <div style="width: 750px; background: #fff; box-shadow: 0px 0px 4px 1px #cccccc25; display: inline-block; margin: 20px 0px; padding: 0px 15px 10px 15px; border-radius: 8px; border-top: 5px solid #3db74e; border-bottom: 5px solid #3db74e; " >
			            <div style="padding:10px 0px;">
			               <img src="' . base_url('assets/frontend/images/icon/logo.png') . '" style="width: 130px; margin-top: 10px; margin-bottom: 30px; " >
			            </div>
			            <div style="clear:both;"></div>
			            <div style="width: 100%;">
			               <div style="width: 100%; font-weight: 600; font-size: 20px; margin-top: 00px;" > 
			                  Hello ' . $order_master[0]['first_name'] . ' ' . $order_master[0]['last_name'] . ' 
			               </div>
			               <div style="width: 100%; font-weight: 500; margin-top:15px; font-size: 18px; line-height: 24px; " >
			                  Thank you for ordering for Port10.sa. <br> Your Order is up for Group Purchase :
			               </div>
			            </div>
			            <div style="clear:both;"></div>
			               <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
			                  <div style="display: inline-block;">
			                     Reference Number :
			                  </div>
			                  <div style="display: inline-block; font-weight: 600; ">
			                     ' . $order_master[0]['display_order_id'] . '
			                  </div>
			                  <div style="clear:both;"></div>
			               </div>

			               <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
			                  <div style="display: inline-block;">
			                     Product :
			                  </div>
			                  <div style="display: inline-block; font-weight: 600; ">
			                     ' . $product_name . '
			                  </div>
			                  <div style="clear:both;"></div>
			               </div>

			               <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
			                  <div style="display: inline-block;">
			                     Invoice amount :
			                  </div>
			                  <div style="display: inline-block; font-weight: 600; ">
			                     ' . number_format($order_master[0]['net_total'], 2) . ' ' . $order_master[0]['currency'] . '
			                  </div>
			                  <div style="clear:both;"></div>
			               </div>

			               <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
			                  <div style="display: inline-block;">
			                     Payment Method :
			                  </div>
			                  <div style="display: inline-block; font-weight: 600; ">
			                     ' . $payment_mode . '
			                  </div>
			                  <div style="clear:both;"></div>
			               </div>
			            <div style="clear:both;"></div>
			            

			            <div  style="width: 100%; font-weight: 500; margin-top: 15px; font-size: 17px; line-height: 22px; padding: 0px 00px; margin-top: 20px;" >
			               If paying by Virtual Account Transfer, your order will be processed once we receive payment and a copy of the invoice will be available at the ‘’Orders’’ section of your account.
			            </div>
			            <div style="clear:both;"></div>
			            <div style="font-weight: 600; font-size: 22px; margin-top: 40px; margin-bottom: 10px; color: #004670;">
			               Thanks,
			               Team Port10
			            </div>
			            <div style="clear:both;"></div>
			         </div>
			         
			      </div>
			   </body>
			</html>';
			// echo $html_tag;
			// die;
			$subject = "Order Confirmation & Invoice";
			// $this->CI->email_cilib->send_email_ci($order_master[0]['email'],$subject,$html_tag);
			$this->CI->email_cilib->send_welcome($order_master[0]['email'], $subject, $html_tag);
		}
	}

	public function send_group_invoice_new_ar($display_order_id = '')
	{
		$order_master = $this->CI->custom_model->my_where('group_orders', 'id,display_order_id,first_name,last_name,net_total,user_id,currency,payment_mode,email', array('display_order_id' => $display_order_id));
		if (!empty($order_master)) {
			if ($order_master[0]['payment_mode'] == 'cash-on-del') {
				$payment_mode = 'Virtual Account Transfer';
			} else {
				$payment_mode = 'Credit Card';
			}
			$product_name = '';
			$order_items = $this->CI->custom_model->my_where('order_items', 'product_name', array('order_no' => $order_master[0]['id']));
			if (!empty($order_items)) {
				foreach ($order_items as $oi_key => $oi_val) {
					$product_name .= $oi_val['product_name'] . ',';
				}
				$product_name = rtrim($product_name, ",");
			}
			// echo "<pre>";
			// print_r($order_items);  		
			// print_r($product_name);  		
			$html_tag = '';
			$html_tag .= '<!DOCTYPE html>
			<html>
			   <head>
			      <title>Index</title>
			   </head>
			   <style>
			      html, body{
			      padding:0px;
			      margin:0px;
			      font-family: arial;
			      font-size: 14px;
			      }
			      div{
			      box-sizing: border-box;
			      }
			      .row_padng td{
			      padding:10px 0px;
			      }
			   </style>';
			$html_tag .= '<body>
			      <div style="text-align: center; background: #f3f3f3; " >
			          <div style="width: 750px; background: #fff; box-shadow: 0px 0px 4px 1px #cccccc25; display: inline-block; margin: 20px 0px; padding: 0px 15px 10px 15px; border-radius: 8px; border-top: 5px solid #3db74e; border-bottom: 5px solid #3db74e; " >
			            <div style="padding:10px 0px;">
			               <img src="' . base_url('assets/frontend/images/icon/logo.png') . '" style="width: 130px; margin-top: 10px; margin-bottom: 30px; " >
			            </div>
			            <div style="clear:both;"></div>
			            <div style="width: 100%;">
			               <div style="width: 100%; font-weight: 600; font-size: 20px; margin-top: 00px;" > 
			                   ' . $order_master[0]['first_name'] . ' ' . $order_master[0]['last_name'] . ' مرحبًا 
			               </div>
			               <div style="width: 100%; font-weight: 500; margin-top:15px; font-size: 18px; line-height: 24px; " >
			                  شكرا للطلب من Port10.sa. فيما يلي ملخص لطلبك:
			               </div>
			            </div>
			            <div style="clear:both;"></div>
			               <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
			                 
			                  <div style="display: inline-block; font-weight: 600; ">
			                     ' . $order_master[0]['display_order_id'] . '
			                  </div>
			                   <div style="display: inline-block;">
			                     رقم المرجع:
			                  </div>
			                  <div style="clear:both;"></div>
			               </div>

			               <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
			                  
			                  <div style="display: inline-block; font-weight: 600; ">
			                    ' . $product_name . '
			                  </div>
			                  <div style="display: inline-block;">
			                        المنتج
			                  </div>
			                  <div style="clear:both;"></div>
			               </div>

			               <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
			                  
			                  <div style="display: inline-block; font-weight: 600; ">
			                      ' . number_format($order_master[0]['net_total'], 2) . ' ' . $order_master[0]['currency'] . '
			                  </div>
			                  <div style="display: inline-block;">
			                     قيمة الفاتورة:
			                  </div>
			                  <div style="clear:both;"></div>
			               </div>

			               <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
			                  
			                  <div style="display: inline-block; font-weight: 600; ">
			                     ' . $payment_mode . '
			                  </div>
			                  <div style="display: inline-block;">
			                    طريقة الدفع:
			                  </div>
			                  <div style="clear:both;"></div>
			               </div>
			            <div style="clear:both;"></div>
			            

			            <div  style="width: 100%; font-weight: 500; margin-top: 15px; font-size: 17px; line-height: 22px; padding: 0px 00px; margin-top: 20px;" >
			               في حالة الدفع عن طريق حوالة على حسابك الافتراضي، ستتم معالجة طلبك بمجرد استلامنا للدفع وستتوفر نسخة من الفاتورة في قسم "الطلبات" بحسابك.
			            </div>
			            <div style="clear:both;"></div>
			            <div style="font-weight: 600; font-size: 22px; margin-top: 40px; margin-bottom: 10px; color: #004670;">
			               شكرا،
			               فريق بورت١٠
			            </div>
			            <div style="clear:both;"></div>
			         </div>
			         
			      </div>
			   </body>
			</html>';
			// echo $html_tag;
			// die;
			$subject = "Order Confirmation & Invoice";
			// $this->CI->email_cilib->send_email_ci($order_master[0]['email'],$subject,$html_tag);
			$this->CI->email_cilib->send_welcome($order_master[0]['email'], $subject, $html_tag);
		}
	}



	public function order_dispatched($display_order_id = '')
	{

		// $display_order_id = '201905021611181';

		$row9 = $this->CI->custom_model->my_where('order_master', '*', array('display_order_id' => $display_order_id));

		// echo "<pre>";
		// print_r($row9);
		// die;

		$currency = $row9[0]['currency'];


		$order_master_id     = $row9[0]['order_master_id'];
		$payment_status     = $row9[0]['payment_status'];
		$payment_mode       = $row9[0]['payment_mode'];
		$customer_id        = $row9[0]['user_id'];
		$sub_total          = $row9[0]['sub_total'];
		$shipping_charge    = $row9[0]['shipping_charge'];
		$net_total_sipping_add    = $row9[0]['net_total'];
		$tax    					= $row9[0]['tax'];

		$u_email    =    $row9[0]['email'];

		// $users_details   = $this->CI->custom_model->my_where('admin_users','*',array('id' => $customer_id));
		$users_name     =    $row9[0]['first_name'];
		$users_address  =  @$row9[0]['address_1'] . ' ' . $row9[0]['address_2'] . ' , ' . $row9[0]['country'] . ' , ' . $row9[0]['state'] . ' , ' . $row9[0]['city'] . ' , ' . $row9[0]['pincode'];
		// $users_phone    =    $users_details[0]['phone'];
		// $users_email    =    $users_details[0]['email'];

		$users_phone    =    $row9[0]['mobile_no'];
		$users_email    =    $row9[0]['email'];

		$order_id =     $row9[0]['order_master_id'];
		// $u_data = $this->CI->custom_model->my_where('admin_users','*',array('id' => $row9[0]['customer_id']));

		$product_detail = $this->CI->custom_model->my_where('order_items', '*', array('order_no' => $order_id));
		if ($product_detail) {
			foreach ($product_detail as $row) {
				$attribute = $row["attribute"];
				if (!empty($attribute)) {
					$product_name = $row["product_name"] . ' (' . $attribute . ')';
				} else {
					$product_name = $row["product_name"];
				}
				$quantity = $row["quantity"];
				// $paym = '<tr><td>'.$product_name.'</td><td>'.$quantity.'</td></td><td></td></tr>';
			}
		}

		// echo "<pre>";
		// print_r($product_detail);
		$new_html_loop = '';
		foreach ($product_detail as $key1 => $value1) {

			$attribute = $value1["attribute"];
			if (!empty($attribute)) {
				$product_name = $value1["product_name"] . ' (' . $attribute . ')';
			} else {
				$product_name = $value1["product_name"];
			}

			$new_html_loop .= '<tr style="padding:12px;border:1px solid #333;width:185px;">';
			$new_html_loop .= '<td style="padding:12px;border:1px solid #333;width:185px;" colspan="2">
                         ' . $product_name . '';
			$new_html_loop .= '</td>';

			$new_html_loop .= '<td style="padding:12px;border:1px solid #333;width:185px;">
                          ' . $value1['quantity'] . '';
			$new_html_loop .= '</td>';
			$new_html_loop .= '<td style="padding:12px;border:1px solid #333;width:185px;">
                         ' . $currency . ' ' . $value1['price'] . '';
			$new_html_loop .= '</td>';
			$new_html_loop .= '</tr>';
		}



		// print_r($url);
		// die;


		//  $message = '<div class="container" style=" margin:0 auto;padding-top:0px; padding:40px;width:750px; height:auto; background-color:#fff;">
		$message = '<div class="container" style=" background-color:#fff;">
                  <table style="margin-top: 15px;">
                  <tr style="padding:12px;width:185px;">
                      <caption style="text-align: center;font-weight: bold; font-size:28px;margin-bottom:15px; font-family: "Open Sans", sans-serif;line-height: 1;color: #5b5b5b;">
                        
                      </caption>

                      <h6 style=" margin-top: -10px; font-family: Georgia,Times New Roman,Times,serif;  font-style: italic;   font-size: 22px;     margin: 0px;"> Dear ' . $users_email . ' , </h6><br/>


                      <p style="color: #696969; padding-top: 10px; text-align: justify;   font-family: Verdana,Geneva,sans-serif;   font-size: 14px;  line-height: 20px;">We just wanted to let you know that items in your Order No. ' . $display_order_id . ' has been dispatched and should reach you soon!  </p>                                         
                      
                     </tr>


                      <thead>
                          
                      </thead>
                      <tbody>
                          <tr style="padding:12px;width:185px;">
                              <th style="    color: #696969;    font-family: Georgia,Times New Roman,Times,serif;    font-style: italic;    font-size: 21px; padding: 10px; border: 1px solid; background-color: #f0f0f0;" colspan="2">Product Name</th>
                              <th style="    color: #696969;    font-family: Georgia,Times New Roman,Times,serif;    font-style: italic;    font-size: 21px; padding: 10px; border: 1px solid;background-color: #f0f0f0;">Qty.</th>
                              <th style="    color: #696969;    font-family: Georgia,Times New Roman,Times,serif;    font-style: italic;    font-size: 21px; padding: 10px; border: 1px solid;background-color: #f0f0f0;">Sub Total</th>
                          </tr>' . $new_html_loop . '
                      </tbody>

                      <tfoot>
                          <tr style="padding:12px;border:1px solid #333;width:185px;">
                              <td style="padding:12px;border:1px solid #333;width:185px;" colspan="2">
                                  <p style="margin:0px;">Subtotal</p>                   
                                  <p style="margin:0px;">Vat</p>
                                  <p style="margin:0px;">Shipping Charge</p>
                                  <p style="margin:0px;">Grand Total</p>
                              </td>                           
                              <td style="padding:12px;border:1px solid #333;width:185px;" colspan="2">
                                  <p style="margin:0px;">' . $currency . ' ' . $sub_total . ' </p>                                  
                                  <p style="margin:0px;">' . $currency . ' ' . $tax . ' </p>                                  
                                  <p style="margin:0px;">' . $currency . ' ' . $shipping_charge . '</p>
                                  <p style="margin:0px;"> ' . $currency . ' ' . $net_total_sipping_add . '</p>
                              </td>
                          </tr>
                      </tfoot>
                  </table>
              </div>';
		//   echo "<pre>";
		// print_r($message); 
		// die;
		//print_r($message);die;
		// $emails = $users_email;


		// $row9[0]['email'] = 'girishbhumkar5@gmail.com';
		$subject = "Your Order $display_order_id  has been dispatched ! ";
		// send_email_using_postmark($row9[0]['email'],$subject,$message);
		// send_email_using_sendinblue($row9[0]['email'],$subject,$message);
		$this->CI->email_cilib->send_email_ci($row9[0]['email'], $subject, $message);
	}


	public function order_delivered($display_order_id = '')
	{

		// $display_order_id = '201905021611181';

		$row9 = $this->CI->custom_model->my_where('order_master', '*', array('display_order_id' => $display_order_id));

		// echo "<pre>";
		// print_r($row9);
		// die;

		$currency = $row9[0]['currency'];


		$order_master_id     = $row9[0]['order_master_id'];
		$payment_status     = $row9[0]['payment_status'];
		$payment_mode       = $row9[0]['payment_mode'];
		$customer_id        = $row9[0]['user_id'];
		$sub_total          = $row9[0]['sub_total'];
		$shipping_charge    = $row9[0]['shipping_charge'];
		$net_total_sipping_add    = $row9[0]['net_total'];
		$tax    					= $row9[0]['tax'];

		$u_email    =    $row9[0]['email'];

		// $users_details   = $this->CI->custom_model->my_where('admin_users','*',array('id' => $customer_id));
		$users_name     =    $row9[0]['first_name'];
		$users_address  =  @$row9[0]['address_1'] . ' ' . $row9[0]['address_2'] . ' , ' . $row9[0]['country'] . ' , ' . $row9[0]['state'] . ' , ' . $row9[0]['city'] . ' , ' . $row9[0]['pincode'];
		$users_phone    =    $row9[0]['mobile_no'];
		$users_email    =    $row9[0]['email'];

		$order_id =     $row9[0]['order_master_id'];
		// $u_data = $this->CI->custom_model->my_where('admin_users','*',array('id' => $row9[0]['customer_id']));

		$product_detail = $this->CI->custom_model->my_where('order_items', '*', array('order_no' => $order_id));
		if ($product_detail) {
			foreach ($product_detail as $row) {
				$attribute = $row["attribute"];
				if (!empty($attribute)) {
					$product_name = $row["product_name"] . ' (' . $attribute . ')';
				} else {
					$product_name = $row["product_name"];
				}
				$quantity = $row["quantity"];
				$paym = '<tr><td>' . $product_name . '</td><td>' . $quantity . '</td></td><td></td></tr>';
			}
		}

		// echo "<pre>";
		// print_r($product_detail);
		$new_html_loop = '';
		foreach ($product_detail as $key1 => $value1) {

			$attribute = $value1["attribute"];
			if (!empty($attribute)) {
				$product_name = $value1["product_name"] . ' (' . $attribute . ')';
			} else {
				$product_name = $value1["product_name"];
			}

			$new_html_loop .= '<tr style="padding:12px;border:1px solid #333;width:185px;">';
			$new_html_loop .= '<td style="padding:12px;border:1px solid #333;width:185px;" colspan="2">
                         ' . $product_name . '';
			$new_html_loop .= '</td>';

			$new_html_loop .= '<td style="padding:12px;border:1px solid #333;width:185px;">
                          ' . $value1['quantity'] . '';
			$new_html_loop .= '</td>';
			$new_html_loop .= '<td style="padding:12px;border:1px solid #333;width:185px;">
                         ' . $currency . ' ' . $value1['price'] . '';
			$new_html_loop .= '</td>';
			$new_html_loop .= '</tr>';
		}



		// print_r($url);
		// die;


		//  $message = '<div class="container" style=" margin:0 auto;padding-top:0px; padding:40px;width:750px; height:auto; background-color:#fff;">
		$message = '<div class="container" style=" background-color:#fff;">
                  <table style="margin-top: 15px;">
                  <tr style="padding:12px;width:185px;">
                      <caption style="text-align: center;font-weight: bold; font-size:28px;margin-bottom:15px; font-family: "Open Sans", sans-serif;line-height: 1;color: #5b5b5b;">
                        
                      </caption>

                      <h6 style=" margin-top: -10px; font-family: Georgia,Times New Roman,Times,serif;  font-style: italic;   font-size: 22px;     margin: 0px;"> Dear ' . $users_email . ' , </h6><br/>


                      <p style="color: #696969; padding-top: 10px; text-align: justify;   font-family: Verdana,Geneva,sans-serif;   font-size: 14px;  line-height: 20px;">We just wanted to let you know that items in your Order No. ' . $display_order_id . '  has been delivered !  </p>

                      
                     </tr>


                      <thead>
                          
                      </thead>
                      <tbody>
                          <tr style="padding:12px;width:185px;">
                              <th style="    color: #696969;    font-family: Georgia,Times New Roman,Times,serif;    font-style: italic;    font-size: 21px; padding: 10px; border: 1px solid; background-color: #f0f0f0;" colspan="2">Product Name</th>
                              <th style="    color: #696969;    font-family: Georgia,Times New Roman,Times,serif;    font-style: italic;    font-size: 21px; padding: 10px; border: 1px solid;background-color: #f0f0f0;">Qty.</th>
                              <th style="    color: #696969;    font-family: Georgia,Times New Roman,Times,serif;    font-style: italic;    font-size: 21px; padding: 10px; border: 1px solid;background-color: #f0f0f0;">Sub Total</th>
                          </tr>' . $new_html_loop . '
                      </tbody>

                      <tfoot>
                          <tr style="padding:12px;border:1px solid #333;width:185px;">
                              <td style="padding:12px;border:1px solid #333;width:185px;" colspan="2">                                  
                                  <p style="margin:0px;">Subtotal</p>
                                  <p style="margin:0px;">Vat</p>
                                  <p style="margin:0px;">Shipping Charge</p>
                                  <p style="margin:0px;">Grand Total</p>
                              </td>                           
                              <td style="padding:12px;border:1px solid #333;width:185px;" colspan="2">                                  
                                  <p style="margin:0px;">' . $currency . ' ' . $sub_total . '</p>
                                  <p style="margin:0px;">' . $currency . ' ' . $tax . '</p>
                                  <p style="margin:0px;">' . $currency . ' ' . $shipping_charge . '</p>
                                  <p style="margin:0px;"> ' . $currency . ' ' . $net_total_sipping_add . '</p>
                              </td>
                          </tr>
                      </tfoot>
                  </table>
              </div>';

		// echo "<pre>";
		// print_r($message);
		// die;

		// $row9[0]['email'] = 'girishbhumkar5@gmail.com';

		$subject = "Your Order $display_order_id  has been delivered ! ";
		// send_email_using_postmark($row9[0]['email'],$subject,$message);
		// send_email_using_sendinblue($row9[0]['email'],$subject,$message);
		$this->CI->email_cilib->send_email_ci($users_email, $subject, $message);

		// print_r($emails); 
		// print_r($message); 

		// die;
		//print_r($message);die;
		// $emails = $users_email;

	}

	public function forget_pass($emails, $subject, $message)
	{
		// echo $emails;
		// echo $subject;
		// echo $message;
		// // die;
		$this->CI->email_cilib->send_email_ci($emails, $subject, $message);
	}

	public function send_group_invoice_merge_en($pin_order_email = '', $display_order_id = '', $pin_order_ids = '')
	{
		// print_r($display_order_id);
		// exit();
		$order_master = $this->CI->custom_model->my_where('group_orders', 'id,display_order_id,first_name,last_name,net_total,user_id,currency,payment_mode,email,mobile_no,address_1,city,pincode, state,country', array('id' => $display_order_id));
		$group_purchase = $this->CI->custom_model->my_where('group_orders', 'first_name, last_name', array('email' => $pin_order_email));

		if ($order_master[0]['payment_mode'] == 'cash-on-del') {
			$payment_mode = 'Virtual Account Transfer';
		} else {
			$payment_mode = 'Credit Card';
		}
		$product_name = '';
		$order_items = $this->CI->custom_model->my_where('group_order_items', 'product_name', array('order_no' => $order_master[0]['id']));
		if (!empty($order_items)) {
			foreach ($order_items as $oi_key => $oi_val) {
				$product_name .= $oi_val['product_name'] . ',';
			}
			$product_name = rtrim($product_name, ",");
		}
		$language = 'en';
		$link =  base_url($language . '/home/group_order_merge_request') . '?display_order_id=' . $display_order_id . '&pin_order_ids=' . $pin_order_ids;
		$no_link = base_url($language . '/home/no_group_order_merge_request') . '?display_order_id=' . $display_order_id . '&pin_order_ids=' . $pin_order_ids;
		$html_tag = '';
		$html_tag .= '<!DOCTYPE html>
		<html>
		   <head>
			  <title>Index</title>
		   </head>
		   <style>
			  html, body{
			  padding:0px;
			  margin:0px;
			  font-family: arial;
			  font-size: 14px;
			  }
			  div{
			  box-sizing: border-box;
			  }
			  .row_padng td{
			  padding:10px 0px;
			  }
		   </style>';
		$html_tag .= '<body>
			  <div style="text-align: center; background: #f3f3f3; " >
				 <div style="width: 750px; background: #fff; box-shadow: 0px 0px 4px 1px #cccccc25; display: inline-block; margin: 20px 0px; padding: 0px 15px 10px 15px; border-radius: 8px; border-top: 5px solid #3db74e; border-bottom: 5px solid #3db74e; " >
					<div style="padding:10px 0px;">
					   <img src="' . base_url('assets/frontend/images/icon/logo.png') . '" style="width: 130px; margin-top: 10px; margin-bottom: 30px; " >
					</div>
					<div style="clear:both;"></div>
					<div style="width: 100%;">
					   <div style="width: 100%; font-weight: 600; font-size: 20px; margin-top: 00px;" > 
						  Hello ' . $group_purchase[0]['first_name'] . ' ' . $group_purchase[0]['last_name'] . ' 
					   </div>
					   <div style="width: 100%; font-weight: 500; margin-top:15px; font-size: 18px; line-height: 24px; " >
						  There is a new merge request from: ' . $order_master[0]['first_name'] . ' ' . $order_master[0]['last_name'] . '
					   </div>
					</div>
					<div style="clear:both;"></div>
					   <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
						  <div style="display: inline-block;">
							 Email :
						  </div>
						  <div style="display: inline-block; font-weight: 600; ">
							 ' . $order_master[0]['email'] . '
						  </div>
						  <div style="clear:both;"></div>
					   </div>
					   <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
						  <div style="display: inline-block;">
							 Mobile Number :
						  </div>
						  <div style="display: inline-block; font-weight: 600; ">
							 ' . $order_master[0]['mobile_no'] . '
						  </div>
						  <div style="clear:both;"></div>
					   </div>
					   <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
						  <div style="display: inline-block;">
							 Reference Number :
						  </div>
						  <div style="display: inline-block; font-weight: 600; ">
							 ' . $order_master[0]['display_order_id'] . '
						  </div>
						  <div style="clear:both;"></div>
					   </div>

					   <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
						  <div style="display: inline-block;">
							 Product :
						  </div>
						  <div style="display: inline-block; font-weight: 600; ">
							 ' . $product_name . '
						  </div>
						  <div style="clear:both;"></div>
					   </div>

					   <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
						  <div style="display: inline-block;">
							 Invoice amount :
						  </div>
						  <div style="display: inline-block; font-weight: 600; ">
							 ' . number_format($order_master[0]['net_total'], 2) . ' ' . $order_master[0]['currency'] . '
						  </div>
						  <div style="clear:both;"></div>
					   </div>

					   <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
						  <div style="display: inline-block;">
							 Address :
						  </div>
						  <div style="display: inline-block; font-weight: 600; ">
						  ' . $order_master[0]['address_1'] . ' , ' . $order_master[0]['city'] . ' , ' . $order_master[0]['state'] . ' , ' . $order_master[0]['country'] . ' , ' . $order_master[0]['pincode'] . '
						  </div>
						  <div style="clear:both;"></div>
					   </div>

					   <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
						  <div style="display: inline-block; font-weight: 600; ">
							Do you want to merge this order request?
						  </div>
						  <a href="' . $link . '">Yes</a>
						  <a href="' . $no_link . '">No</a>
						  <div style="clear:both;"></div>
					   </div>
					<div style="clear:both;"></div>
					

					<div  style="width: 100%; font-weight: 500; margin-top: 15px; font-size: 17px; line-height: 22px; padding: 0px 00px; margin-top: 20px;" >
					   If paying by Virtual Account Transfer, your order will be processed once we receive payment and a copy of the invoice will be available at the ‘’Orders’’ section of your account.
					</div>
					<div style="clear:both;"></div>
					<div style="font-weight: 600; font-size: 22px; margin-top: 40px; margin-bottom: 10px; color: #004670;">
					   Thanks,
					   Team Port10
					</div>
					<div style="clear:both;"></div>
				 </div>
				 
			  </div>
		   </body>
		</html>';
		// echo $html_tag;
		// die;
		$subject = "Order Confirmation & Invoice";
		// $this->CI->email_cilib->send_email_ci($order_master[0]['email'],$subject,$html_tag);
		$this->CI->email_cilib->send_welcome($pin_order_email, $subject, $html_tag);
	}
	public function send_group_invoice_merge_ar($pin_order_email = '', $display_order_id = '', $pin_order_ids = '')
	{
		$order_master = $this->CI->custom_model->my_where('group_orders', 'id,display_order_id,first_name,last_name,net_total,user_id,currency,payment_mode,email', array('display_order_id' => $display_order_id));

		if ($order_master[0]['payment_mode'] == 'cash-on-del') {
			$payment_mode = 'Virtual Account Transfer';
		} else {
			$payment_mode = 'Credit Card';
		}
		$product_name = '';
		$order_items = $this->CI->custom_model->my_where('group_order_items', 'product_name', array('order_no' => $order_master[0]['id']));
		if (!empty($order_items)) {
			foreach ($order_items as $oi_key => $oi_val) {
				$product_name .= $oi_val['product_name'] . ',';
			}
			$product_name = rtrim($product_name, ",");
		}
		$link =  base_url($language . '/home/group_order_merge_request') . '?display_order_id=' . $display_order_id . '&pin_order_ids=' . $pin_order_ids;
		$no_link = base_url($language . '/home/no_group_order_merge_request') . '?display_order_id=' . $display_order_id . '&pin_order_ids=' . $pin_order_ids;
		$html_tag = '';
		$html_tag .= '<!DOCTYPE html>
		<html>
		   <head>
			  <title>Index</title>
		   </head>
		   <style>
			  html, body{
			  padding:0px;
			  margin:0px;
			  font-family: arial;
			  font-size: 14px;
			  }
			  div{
			  box-sizing: border-box;
			  }
			  .row_padng td{
			  padding:10px 0px;
			  }
		   </style>';
		$html_tag .= '<body>
			  <div style="text-align: center; background: #f3f3f3; " >
				 <div style="width: 750px; background: #fff; box-shadow: 0px 0px 4px 1px #cccccc25; display: inline-block; margin: 20px 0px; padding: 0px 15px 10px 15px; border-radius: 8px; border-top: 5px solid #3db74e; border-bottom: 5px solid #3db74e; " >
					<div style="padding:10px 0px;">
					   <img src="' . base_url('assets/frontend/images/icon/logo.png') . '" style="width: 130px; margin-top: 10px; margin-bottom: 30px; " >
					</div>
					<div style="clear:both;"></div>
					<div style="width: 100%;">
					   <div style="width: 100%; font-weight: 600; font-size: 20px; margin-top: 00px;" > 
						  Hello ' . $order_master[0]['first_name'] . ' ' . $order_master[0]['last_name'] . ' 
					   </div>
					   <div style="width: 100%; font-weight: 500; margin-top:15px; font-size: 18px; line-height: 24px; " >
						  Thank you for ordering for Port10.sa. <br> Your Order is up for Group Purchase :
					   </div>
					</div>
					<div style="clear:both;"></div>
					   <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
						  <div style="display: inline-block;">
							 Email :
						  </div>
						  <div style="display: inline-block; font-weight: 600; ">
							 ' . $order_master[0]['email'] . '
						  </div>
						  <div style="clear:both;"></div>
					   </div>
					   <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
						  <div style="display: inline-block;">
							 Mobile Number :
						  </div>
						  <div style="display: inline-block; font-weight: 600; ">
							 ' . $order_master[0]['mobile_no'] . '
						  </div>
						  <div style="clear:both;"></div>
					   </div>
					   <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
						  <div style="display: inline-block;">
							 Reference Number :
						  </div>
						  <div style="display: inline-block; font-weight: 600; ">
							 ' . $order_master[0]['display_order_id'] . '
						  </div>
						  <div style="clear:both;"></div>
					   </div>

					   <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
						  <div style="display: inline-block;">
							 Product :
						  </div>
						  <div style="display: inline-block; font-weight: 600; ">
							 ' . $product_name . '
						  </div>
						  <div style="clear:both;"></div>
					   </div>

					   <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
						  <div style="display: inline-block;">
							 Invoice amount :
						  </div>
						  <div style="display: inline-block; font-weight: 600; ">
							 ' . number_format($order_master[0]['net_total'], 2) . ' ' . $order_master[0]['currency'] . '
						  </div>
						  <div style="clear:both;"></div>
					   </div>

					   <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
						  <div style="display: inline-block;">
							 Payment Method :
						  </div>
						  <div style="display: inline-block; font-weight: 600; ">
							 ' . $payment_mode . '
						  </div>
						  <a href="' . $link . '">Yes</a>
						  <a href="' . $no_link . '">No</a>
						  <div style="clear:both;"></div>
					   </div>
					<div style="clear:both;"></div>
					

					<div  style="width: 100%; font-weight: 500; margin-top: 15px; font-size: 17px; line-height: 22px; padding: 0px 00px; margin-top: 20px;" >
					   If paying by Virtual Account Transfer, your order will be processed once we receive payment and a copy of the invoice will be available at the ‘’Orders’’ section of your account.
					</div>
					<div style="clear:both;"></div>
					<div style="font-weight: 600; font-size: 22px; margin-top: 40px; margin-bottom: 10px; color: #004670;">
					   Thanks,
					   Team Port10
					</div>
					<div style="clear:both;"></div>
				 </div>
				 
			  </div>
		   </body>
		</html>';
		// echo $html_tag;
		// die;
		$subject = "Order Confirmation & Invoice";
		// $this->CI->email_cilib->send_email_ci($order_master[0]['email'],$subject,$html_tag);
		$this->CI->email_cilib->send_welcome($pin_order_email, $subject, $html_tag);
	}


	// -----------------------------------------
	public function send_group_order_merge_request_yes_en($display_order_id = '', $pin_order_id = '')
	{
		$order_master = $this->CI->custom_model->my_where('group_orders', 'id,display_order_id,first_name,last_name,net_total,user_id,currency,payment_mode,email', array('display_order_id' => $display_order_id));
		$group_purchase = $this->CI->custom_model->my_where('group_orders', 'first_name,last_name,mobile_no,email,address_1,state,city,country,pincode', array('id' => $pin_order_id));
		// print_r($group_purchase);
		// exit();
		if (!empty($order_master)) {
			if ($order_master[0]['payment_mode'] == 'cash-on-del') {
				$payment_mode = 'Virtual Account Transfer';
			} else {
				$payment_mode = 'Credit Card';
			}
			$product_name = '';
			$order_items = $this->CI->custom_model->my_where('group_order_items', 'product_name', array('order_no' => $order_master[0]['id']));
			if (!empty($order_items)) {
				foreach ($order_items as $oi_key => $oi_val) {
					$product_name .= $oi_val['product_name'] . ',';
				}
				$product_name = rtrim($product_name, ",");
			}
			// echo "<pre>";
			// print_r($order_items);  		
			// print_r($order_master[0]['email']);  		
			$html_tag = '';
			$html_tag .= '<!DOCTYPE html>
			<html>
			   <head>
			      <title>Index</title>
			   </head>
			   <style>
			      html, body{
			      padding:0px;
			      margin:0px;
			      font-family: arial;
			      font-size: 14px;
			      }
			      div{
			      box-sizing: border-box;
			      }
			      .row_padng td{
			      padding:10px 0px;
			      }
			   </style>';
			$html_tag .= '<body>
			      <div style="text-align: center; background: #f3f3f3; " >
			         <div style="width: 750px; background: #fff; box-shadow: 0px 0px 4px 1px #cccccc25; display: inline-block; margin: 20px 0px; padding: 0px 15px 10px 15px; border-radius: 8px; border-top: 5px solid #3db74e; border-bottom: 5px solid #3db74e; " >
			            <div style="padding:10px 0px;">
			               <img src="' . base_url('assets/frontend/images/icon/logo.png') . '" style="width: 130px; margin-top: 10px; margin-bottom: 30px; " >
			            </div>
			            <div style="clear:both;"></div>
			            <div style="width: 100%;">
			               <div style="width: 100%; font-weight: 600; font-size: 20px; margin-top: 00px;" > 
			                  Hello ' . $order_master[0]['first_name'] . ' ' . $order_master[0]['last_name'] . ' 
			               </div>
			               <div style="width: 100%; font-weight: 500; margin-top:15px; font-size: 18px; line-height: 24px; " >
			                  Thank you for ordering for Port10.sa. <br> Your merge request is accepted by: <strong>' . $group_purchase[0]['first_name'] . ' ' . $group_purchase[0]['last_name'] . '</strong>
			               </div>
			            </div>

						<div style="clear:both;"></div>
			               <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
			                  <div style="display: inline-block;">
			                     Contact Number :
			                  </div>
			                  <div style="display: inline-block; font-weight: 600; ">
			                     ' . $group_purchase[0]['mobile_no'] . '
			                  </div>
			                  <div style="clear:both;"></div>
			               </div>

						   <div style="clear:both;"></div>
			               <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
			                  <div style="display: inline-block;">
			                     Email Address :
			                  </div>
			                  <div style="display: inline-block; font-weight: 600; ">
			                     ' . $group_purchase[0]['email'] . '
			                  </div>
			                  <div style="clear:both;"></div>
			               </div>

						   <div style="clear:both;"></div>
			               <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
			                  <div style="display: inline-block;">
			                    Address :
			                  </div>
			                  <div style="display: inline-block; font-weight: 600; ">
						  ' . $group_purchase[0]['address_1'] . ' , ' . $group_purchase[0]['city'] . ' , ' . $group_purchase[0]['state'] . ' , ' . $group_purchase[0]['country'] . ' , ' . $group_purchase[0]['pincode'] . '
						  </div>
			                  <div style="clear:both;"></div>
			               </div>

			            <div style="clear:both;"></div>
			               <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
			                  <div style="display: inline-block;">
			                     Reference Number :
			                  </div>
			                  <div style="display: inline-block; font-weight: 600; ">
			                     ' . $order_master[0]['display_order_id'] . '
			                  </div>
			                  <div style="clear:both;"></div>
			               </div>

			               <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
			                  <div style="display: inline-block;">
			                     Product :
			                  </div>
			                  <div style="display: inline-block; font-weight: 600; ">
			                     ' . $product_name . '
			                  </div>
			                  <div style="clear:both;"></div>
			               </div>

			               <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
			                  <div style="display: inline-block;">
			                     Invoice amount :
			                  </div>
			                  <div style="display: inline-block; font-weight: 600; ">
			                     ' . number_format($order_master[0]['net_total'], 2) . ' ' . $order_master[0]['currency'] . '
			                  </div>
			                  <div style="clear:both;"></div>
			               </div>

			               <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
			                  <div style="display: inline-block;">
			                     Payment Method :
			                  </div>
			                  <div style="display: inline-block; font-weight: 600; ">
			                     ' . $payment_mode . '
			                  </div>
			                  <div style="clear:both;"></div>
			               </div>
			            <div style="clear:both;"></div>
			            

			            <div  style="width: 100%; font-weight: 500; margin-top: 15px; font-size: 17px; line-height: 22px; padding: 0px 00px; margin-top: 20px;" >
			               If paying by Virtual Account Transfer, your order will be processed once we receive payment and a copy of the invoice will be available at the ‘’Orders’’ section of your account.
			            </div>
			            <div style="clear:both;"></div>
			            <div style="font-weight: 600; font-size: 22px; margin-top: 40px; margin-bottom: 10px; color: #004670;">
			               Thanks,
			               Team Port10
			            </div>
			            <div style="clear:both;"></div>
			         </div>
			         
			      </div>
			   </body>
			</html>';
			// echo $html_tag;
			// die;
			$subject = "Order Confirmation & Invoice";
			// $this->CI->email_cilib->send_email_ci($order_master[0]['email'],$subject,$html_tag);
			$this->CI->email_cilib->send_welcome($order_master[0]['email'], $subject, $html_tag);
		}
	}
	public function send_group_order_merge_request_yes_ar($display_order_id = '', $pin_order_id = '')
	{
		$order_master = $this->CI->custom_model->my_where('group_orders', 'id,display_order_id,first_name,last_name,net_total,user_id,currency,payment_mode,email', array('display_order_id' => $display_order_id));
		if (!empty($order_master)) {
			if ($order_master[0]['payment_mode'] == 'cash-on-del') {
				$payment_mode = 'Virtual Account Transfer';
			} else {
				$payment_mode = 'Credit Card';
			}
			$product_name = '';
			$order_items = $this->CI->custom_model->my_where('group_order_items', 'product_name', array('order_no' => $order_master[0]['id']));
			if (!empty($order_items)) {
				foreach ($order_items as $oi_key => $oi_val) {
					$product_name .= $oi_val['product_name'] . ',';
				}
				$product_name = rtrim($product_name, ",");
			}
			// echo "<pre>";
			// print_r($order_items);  		
			// print_r($product_name);  		
			$html_tag = '';
			$html_tag .= '<!DOCTYPE html>
			<html>
			   <head>
			      <title>Index</title>
			   </head>
			   <style>
			      html, body{
			      padding:0px;
			      margin:0px;
			      font-family: arial;
			      font-size: 14px;
			      }
			      div{
			      box-sizing: border-box;
			      }
			      .row_padng td{
			      padding:10px 0px;
			      }
			   </style>';
			$html_tag .= '<body>
			      <div style="text-align: center; background: #f3f3f3; " >
			         <div style="width: 750px; background: #fff; box-shadow: 0px 0px 4px 1px #cccccc25; display: inline-block; margin: 20px 0px; padding: 0px 15px 10px 15px; border-radius: 8px; border-top: 5px solid #3db74e; border-bottom: 5px solid #3db74e; " >
			            <div style="padding:10px 0px;">
			               <img src="' . base_url('assets/frontend/images/icon/logo.png') . '" style="width: 130px; margin-top: 10px; margin-bottom: 30px; " >
			            </div>
			            <div style="clear:both;"></div>
			            <div style="width: 100%;">
			               <div style="width: 100%; font-weight: 600; font-size: 20px; margin-top: 00px;" > 
			                  Hello ' . $order_master[0]['first_name'] . ' ' . $order_master[0]['last_name'] . ' 
			               </div>
			               <div style="width: 100%; font-weight: 500; margin-top:15px; font-size: 18px; line-height: 24px; " >
			                  Thank you for ordering for Port10.sa. <br> Your Order is up for Group Purchase :
			               </div>
			            </div>
			            <div style="clear:both;"></div>
			               <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
			                  <div style="display: inline-block;">
			                     Reference Number :
			                  </div>
			                  <div style="display: inline-block; font-weight: 600; ">
			                     ' . $order_master[0]['display_order_id'] . '
			                  </div>
			                  <div style="clear:both;"></div>
			               </div>

			               <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
			                  <div style="display: inline-block;">
			                     Product :
			                  </div>
			                  <div style="display: inline-block; font-weight: 600; ">
			                     ' . $product_name . '
			                  </div>
			                  <div style="clear:both;"></div>
			               </div>

			               <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
			                  <div style="display: inline-block;">
			                     Invoice amount :
			                  </div>
			                  <div style="display: inline-block; font-weight: 600; ">
			                     ' . number_format($order_master[0]['net_total'], 2) . ' ' . $order_master[0]['currency'] . '
			                  </div>
			                  <div style="clear:both;"></div>
			               </div>

			               <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
			                  <div style="display: inline-block;">
			                     Payment Method :
			                  </div>
			                  <div style="display: inline-block; font-weight: 600; ">
			                     ' . $payment_mode . '
			                  </div>
			                  <div style="clear:both;"></div>
			               </div>
			            <div style="clear:both;"></div>
			            

			            <div  style="width: 100%; font-weight: 500; margin-top: 15px; font-size: 17px; line-height: 22px; padding: 0px 00px; margin-top: 20px;" >
			               If paying by Virtual Account Transfer, your order will be processed once we receive payment and a copy of the invoice will be available at the ‘’Orders’’ section of your account.
			            </div>
			            <div style="clear:both;"></div>
			            <div style="font-weight: 600; font-size: 22px; margin-top: 40px; margin-bottom: 10px; color: #004670;">
			               Thanks,
			               Team Port10
			            </div>
			            <div style="clear:both;"></div>
			         </div>
			         
			      </div>
			   </body>
			</html>';
			// echo $html_tag;
			// die;
			$subject = "Order Confirmation & Invoice";
			// $this->CI->email_cilib->send_email_ci($order_master[0]['email'],$subject,$html_tag);
			$this->CI->email_cilib->send_welcome($order_master[0]['email'], $subject, $html_tag);
		}
	}



	public function send_group_order_merge_request_no_en($display_order_id = '', $pin_order_id = '')
	{
		$order_master = $this->CI->custom_model->my_where('group_orders', 'id,display_order_id,first_name,last_name,net_total,user_id,currency,payment_mode,email', array('display_order_id' => $display_order_id));
		if (!empty($order_master)) {
			if ($order_master[0]['payment_mode'] == 'cash-on-del') {
				$payment_mode = 'Virtual Account Transfer';
			} else {
				$payment_mode = 'Credit Card';
			}
			$product_name = '';
			$order_items = $this->CI->custom_model->my_where('group_order_items', 'product_name', array('order_no' => $order_master[0]['id']));
			if (!empty($order_items)) {
				foreach ($order_items as $oi_key => $oi_val) {
					$product_name .= $oi_val['product_name'] . ',';
				}
				$product_name = rtrim($product_name, ",");
			}
			// echo "<pre>";
			// print_r($order_items);  		
			// print_r($order_master[0]['email']);  		
			$html_tag = '';
			$html_tag .= '<!DOCTYPE html>
			<html>
			   <head>
			      <title>Index</title>
			   </head>
			   <style>
			      html, body{
			      padding:0px;
			      margin:0px;
			      font-family: arial;
			      font-size: 14px;
			      }
			      div{
			      box-sizing: border-box;
			      }
			      .row_padng td{
			      padding:10px 0px;
			      }
			   </style>';
			$html_tag .= '<body>
			      <div style="text-align: center; background: #f3f3f3; " >
			         <div style="width: 750px; background: #fff; box-shadow: 0px 0px 4px 1px #cccccc25; display: inline-block; margin: 20px 0px; padding: 0px 15px 10px 15px; border-radius: 8px; border-top: 5px solid #3db74e; border-bottom: 5px solid #3db74e; " >
			            <div style="padding:10px 0px;">
			               <img src="' . base_url('assets/frontend/images/icon/logo.png') . '" style="width: 130px; margin-top: 10px; margin-bottom: 30px; " >
			            </div>
			            <div style="clear:both;"></div>
			            <div style="width: 100%;">
			               <div style="width: 100%; font-weight: 600; font-size: 20px; margin-top: 00px;" > 
			                  Hello ' . $order_master[0]['first_name'] . ' ' . $order_master[0]['last_name'] . ' 
			               </div>
			               <div style="width: 100%; font-weight: 500; margin-top:15px; font-size: 18px; line-height: 24px; " >
						   ' . $order_master[0]['first_name'] . ', <br> Your request for order is not merged :
			               </div>
			            </div>
			            <div style="clear:both;"></div>
			               <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
			                  <div style="display: inline-block;">
			                     Reference Number :
			                  </div>
			                  <div style="display: inline-block; font-weight: 600; ">
			                     ' . $order_master[0]['display_order_id'] . '
			                  </div>
			                  <div style="clear:both;"></div>
			               </div>

			               <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
			                  <div style="display: inline-block;">
			                     Product :
			                  </div>
			                  <div style="display: inline-block; font-weight: 600; ">
			                     ' . $product_name . '
			                  </div>
			                  <div style="clear:both;"></div>
			               </div>

			               <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
			                  <div style="display: inline-block;">
			                     Invoice amount :
			                  </div>
			                  <div style="display: inline-block; font-weight: 600; ">
			                     ' . number_format($order_master[0]['net_total'], 2) . ' ' . $order_master[0]['currency'] . '
			                  </div>
			                  <div style="clear:both;"></div>
			               </div>

			               <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
			                  <div style="display: inline-block;">
			                     Payment Method :
			                  </div>
			                  <div style="display: inline-block; font-weight: 600; ">
			                     ' . $payment_mode . '
			                  </div>
			                  <div style="clear:both;"></div>
			               </div>
			            <div style="clear:both;"></div>
			            

			            <div  style="width: 100%; font-weight: 500; margin-top: 15px; font-size: 17px; line-height: 22px; padding: 0px 00px; margin-top: 20px;" >
			               If paying by Virtual Account Transfer, your order will be processed once we receive payment and a copy of the invoice will be available at the ‘’Orders’’ section of your account.
			            </div>
			            <div style="clear:both;"></div>
			            <div style="font-weight: 600; font-size: 22px; margin-top: 40px; margin-bottom: 10px; color: #004670;">
			               Thanks,
			               Team Port10
			            </div>
			            <div style="clear:both;"></div>
			         </div>
			         
			      </div>
			   </body>
			</html>';
			// echo $html_tag;
			// die;
			$subject = "Order Not merge";
			// $this->CI->email_cilib->send_email_ci($order_master[0]['email'],$subject,$html_tag);
			$this->CI->email_cilib->send_welcome($order_master[0]['email'], $subject, $html_tag);
		}
	}

	public function send_group_order_merge_request_no_ar($display_order_id = '', $pin_order_id = '')
	{
		$order_master = $this->CI->custom_model->my_where('group_orders', 'id,display_order_id,first_name,last_name,net_total,user_id,currency,payment_mode,email', array('display_order_id' => $display_order_id));
		if (!empty($order_master)) {
			if ($order_master[0]['payment_mode'] == 'cash-on-del') {
				$payment_mode = 'Virtual Account Transfer';
			} else {
				$payment_mode = 'Credit Card';
			}
			$product_name = '';
			$order_items = $this->CI->custom_model->my_where('group_order_items', 'product_name', array('order_no' => $order_master[0]['id']));
			if (!empty($order_items)) {
				foreach ($order_items as $oi_key => $oi_val) {
					$product_name .= $oi_val['product_name'] . ',';
				}
				$product_name = rtrim($product_name, ",");
			}
			// echo "<pre>";
			// print_r($order_items);  		
			// print_r($product_name);  		
			$html_tag = '';
			$html_tag .= '<!DOCTYPE html>
			<html>
			   <head>
			      <title>Index</title>
			   </head>
			   <style>
			      html, body{
			      padding:0px;
			      margin:0px;
			      font-family: arial;
			      font-size: 14px;
			      }
			      div{
			      box-sizing: border-box;
			      }
			      .row_padng td{
			      padding:10px 0px;
			      }
			   </style>';
			$html_tag .= '<body>
			      <div style="text-align: center; background: #f3f3f3; " >
			         <div style="width: 750px; background: #fff; box-shadow: 0px 0px 4px 1px #cccccc25; display: inline-block; margin: 20px 0px; padding: 0px 15px 10px 15px; border-radius: 8px; border-top: 5px solid #3db74e; border-bottom: 5px solid #3db74e; " >
			            <div style="padding:10px 0px;">
			               <img src="' . base_url('assets/frontend/images/icon/logo.png') . '" style="width: 130px; margin-top: 10px; margin-bottom: 30px; " >
			            </div>
			            <div style="clear:both;"></div>
			            <div style="width: 100%;">
			               <div style="width: 100%; font-weight: 600; font-size: 20px; margin-top: 00px;" > 
			                  Hello ' . $order_master[0]['first_name'] . ' ' . $order_master[0]['last_name'] . ' 
			               </div>
			               <div style="width: 100%; font-weight: 500; margin-top:15px; font-size: 18px; line-height: 24px; " >
			                  Thank you for ordering for Port10.sa. <br> Your Order is up for Group Purchase :
			               </div>
			            </div>
			            <div style="clear:both;"></div>
			               <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
			                  <div style="display: inline-block;">
			                     Reference Number :
			                  </div>
			                  <div style="display: inline-block; font-weight: 600; ">
			                     ' . $order_master[0]['display_order_id'] . '
			                  </div>
			                  <div style="clear:both;"></div>
			               </div>

			               <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
			                  <div style="display: inline-block;">
			                     Product :
			                  </div>
			                  <div style="display: inline-block; font-weight: 600; ">
			                     ' . $product_name . '
			                  </div>
			                  <div style="clear:both;"></div>
			               </div>

			               <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
			                  <div style="display: inline-block;">
			                     Invoice amount :
			                  </div>
			                  <div style="display: inline-block; font-weight: 600; ">
			                     ' . number_format($order_master[0]['net_total'], 2) . ' ' . $order_master[0]['currency'] . '
			                  </div>
			                  <div style="clear:both;"></div>
			               </div>

			               <div style="font-size: 16px; font-weight: 500; margin-top: 10px; ">
			                  <div style="display: inline-block;">
			                     Payment Method :
			                  </div>
			                  <div style="display: inline-block; font-weight: 600; ">
			                     ' . $payment_mode . '
			                  </div>
			                  <div style="clear:both;"></div>
			               </div>
			            <div style="clear:both;"></div>
			            

			            <div  style="width: 100%; font-weight: 500; margin-top: 15px; font-size: 17px; line-height: 22px; padding: 0px 00px; margin-top: 20px;" >
			               If paying by Virtual Account Transfer, your order will be processed once we receive payment and a copy of the invoice will be available at the ‘’Orders’’ section of your account.
			            </div>
			            <div style="clear:both;"></div>
			            <div style="font-weight: 600; font-size: 22px; margin-top: 40px; margin-bottom: 10px; color: #004670;">
			               Thanks,
			               Team Port10
			            </div>
			            <div style="clear:both;"></div>
			         </div>
			         
			      </div>
			   </body>
			</html>';
			// echo $html_tag;
			// die;
			$subject = "Order Not merge";
			// $this->CI->email_cilib->send_email_ci($order_master[0]['email'],$subject,$html_tag);
			$this->CI->email_cilib->send_welcome($order_master[0]['email'], $subject, $html_tag);
		}
	}
}