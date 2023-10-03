<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Aladin" />
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Adamina" />
<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
* Library to search from website or app
*/
class Pdf_create
{
    public function __construct()
    {
        // Assign the CodeIgniter super-object
        $this->CI =& get_instance();
        $this->CI->load->model('admin/Custom_model', 'custom_model');
        date_default_timezone_set('Asia/Kolkata');
        $this->order_datetime = date('Y-m-d H:i:s');
    }

        public function get_print_pdf_list($order_id)
        {
            ob_start();

            $data = $this->CI->custom_model->my_where('order_master', '*', array('order_master_id' => $order_id));

            $country_name = $data[0]['country'];
            $currency=$data[0]['currency'];

            if(!empty($data)) {
                $trans_history = $this->CI->custom_model->my_where("payment_details", "*", array("display_order_id" => $data[0]['display_order_id']));
                if(!empty($trans_history)) {
                    $data[0]['track_id']=$trans_history[0]['track_id'];
                }
            }

            // print_r($currency);
            // die;


            $data_items = $this->CI->custom_model->my_where('order_items', '*', array('order_no' => $order_id));
            $data_invoice = $this->CI->custom_model->my_where('order_invoice', '*', array('order_no' => $order_id));

            // echo "<pre>";print_r($data);

            $g_total =  $data[0]['net_total']-$data[0]['coupon_price'];

            // echo "<pre>";
            // print_r($data_invoice);
            // die;


            $customer_id = $data[0]['user_id'];
            $users_details = $this->CI->custom_model->my_where('admin_users', '*', array('id' => $customer_id));

            if (!empty($data_invoice)) {
                foreach ($data_invoice as $key => $value) {
                    $vendor  = $this->CI->custom_model->my_where('admin_users', 'first_name,email,phone', array('id' => $value['seller_id']));
                    if (!empty($vendor)) {
                        $data_invoice[$key]['vendor_name'] = $vendor[0]['first_name'];
                        $data_invoice[$key]['vendor_email'] = $vendor[0]['email'];
                        $data_invoice[$key]['vendor_address'] = '';
                        $data_invoice[$key]['vendor_phone'] = $vendor[0]['phone'];

                    }
                }
            }

            $item_data = array();

            foreach ($data_items as $key => $value) {
                $items_extra_data = $this->CI->custom_model->my_where('items_extra_data', '*', array('item_id' => $value['item_id']));
                $data_items[$key]['items_extra_data']=$items_extra_data;
                $item_data[$value['item_id']] = $value;
            }


            extract($data);
            $transaction = $shipp = 0;
            $item_vendor = $payment_mode = '';
            $product = $vendor = array();
            $info = array();

            // echo "<pre>";
            // print_r($data_items);
            // die;

            foreach ($data_invoice as $key => $value) {
                //echo "<pre>";print_r($value);
                /*echo ">>".$value['vendor_name'];*/
                $vendor[$value['seller_id']]['name'] = $value['vendor_name'];
                // $vendor[$value['seller_id']]['total'] = ($value['shipping_cost'] - $value['transaction_cost']);
                $vendor[$value['seller_id']]['total'] = $value['shipping_cost'];

                $transaction =0;
                $shipp += $value['shipping_cost'];
                $index = 1;
                $str = explode(',', $value['item_ids']);
                foreach ($str as $k => $val) {
                    $info = $item_data[$val];
                    $p_info =  $this->CI->custom_model->my_where('product', '*', array('id' => $info['product_id']));

                    // echo "<pre>";print_r($p_info);
                    // $info['sku'] = $p_info[0]['tags'];

                    if ($index == 1) {
                        $info['rowspan'] = count($str);
                        // $info['tran'] = $value['transaction_cost'];
                        $info['tran'] = 0;
                        $info['ship'] = $value['shipping_cost'];
                    } else {
                        $info['rowspan'] = 0;
                    }
                    $index++;
                    $product[$val] = $info;
                    //print_r($product);
                }
            }

            if (@$data['payment_mode'] == 'pay-insurance' || !empty(@$data['insurance'])) {
                $payment_mode = 'Pay with insurance';
            } elseif(@$data['payment_mode'] == 'online' || !empty(@$data['card_type'])) {
                $payment_mode = 'Online / '.$data['card_type'];
            } else {
                $payment_mode = 'Cash on delivery';
            }


            // echo "<pre>";
            // print_r($product);
            // die;


            ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>

<body>
	<div class="container">
		<table>
			<caption style="line-height: 1;color: #5b5b5b;">
				<div style="">

					<img style="  width: 160px;  height: 70px;  background-size: 100% 100%;"
						src="<?php echo base_url(); ?>assets/frontend/images/icon/logo.png">
				</div>
				<br>
				Order invoice
			</caption>
			<thead>
				<tr>
					<?php

                                        foreach ($data as $datas) {
                                            $name = $datas['first_name'].' '.$datas['last_name'];
                                            $mobile_no = $datas['mobile_no'];
                                            $address_1 = $datas['address_1'];
                                            $address_2 = $datas['address_2'];
                                            $country = $datas['country'];
                                            $city = $datas['city'];
                                        }
            ?>
					<th style="text-align: left;" colspan="5">Name :
						<?php echo $name; ?>
					</th>
					<th>Invoice id
						#<?php echo $value['invoice_id']; ?>
					</th>
				</tr>
				<tr>
					<td style="background-color: #f0f0f0; font-weight: bold;" colspan="3">
						<p>Address</p>
					</td>


					<td colspan="3">
						<p><?php echo $data[0]['address_1']  ?>
							,
							<?php echo $data[0]['address_1']  ?>,
							<?php echo $data[0]['address_2']  ?>,
							<?php echo $data[0]['state']  ?>,
							<?php echo $data[0]['pincode']  ?>
						</p>
					</td>

				</tr>
				<tr>
					<td style="background-color: #f0f0f0; font-weight: bold;" colspan="3">
						<p>City</p>
					</td>

					<td colspan="3">
						<p><?php echo $data[0]['city'];  ?>
						</p>
					</td>

				</tr>
				<tr>
					<td style="background-color: #f0f0f0; font-weight: bold;" colspan="3">
						<p>Country</p>
					</td>

					<td colspan="3">
						<p><?php echo $data[0]['country'];  ?>
						</p>
					</td>

				</tr>
				<tr>
					<td style="background-color: #f0f0f0; font-weight: bold;" colspan="3">
						<p>Mobile no</p>
					</td>

					<td colspan="3">
						<p><?php echo $data[0]['mobile_no']  ?>
						</p>
					</td>

				</tr>

				<tr>
					<td style="background-color: #f0f0f0; font-weight: bold;" colspan="3">
						<p>Email</p>
					</td>

					<td colspan="3">
						<p><?php echo $data[0]['email']  ?>
						</p>
					</td>

				</tr>


			</thead>
			<tbody>


				<tr>
					<th colspan="4">Product Name </th>
					<!-- <th colspan="">Customize Product </th> -->

					<th>Qty</th>
					<th>Sub Total</th>
				</tr>

				<?php

                        if ($data_items) {
                            $total = $ptax = $pcom = $vendor_total = $grand_total = 0;
                            $i=1;
                            $oids='';
                            foreach($data_items as $key1 => $row) {


                                $attribute = $row["attribute"];
                                if (!empty($attribute)) {
                                    $product_name = $row["product_name"].' ('. $attribute .')';
                                } else {
                                    $product_name = $row["product_name"];
                                }

                                $product_cust_data = '';

                                if (!empty($row['items_extra_data'])) {
                                    foreach ($row['items_extra_data'] as $pkey => $pvalue) {
                                        if ($pvalue['price'] == '0') {
                                            $c_price = 'Free';
                                        } else {
                                            $c_price = $currency.' '.$pvalue['price'];
                                        }
                                        $product_cust_data.='<p>'.$pvalue['name'].' :- '.$c_price.'</p>';
                                    }
                                }


                                $product_price = ($row["price"] * $row['quantity']);
                                $total = $total + $product_price;
                                // $ptax += $row['tax'];
                                // $pcom += $row['commission'];
                                $pcom =0;
                                $sid = $row['seller_id'];
                                // $vendor[$sid]['total'] = $vendor[$sid]['total'] + $product_price - $row['commission'];
                                $vendor[$sid]['total'] = $vendor[$sid]['total'] + $product_price-0;

                                // echo "<pre>";
                                // print_r($row);
                                // die;

                                ?>


				<tr>
					<td colspan="4"><?php echo $product_name; ?></td>
					<!-- <td style="display: none"><?php //echo $product_cust_data;?>
					</td> -->

					<td><?php echo $row["quantity"]; ?>
					</td>
					<td><?php echo $currency; ?>
						<?php echo($row["price"] * $row['quantity']); ?>
					</td>
				</tr>

				<?php }

                            $grand_total = $total + $shipp + $transaction + $pcom;
                            $vendor_total = $total + $shipp - $transaction - $pcom;


                        } ?>

				<tr>
					<th colspan="6">Billing Details</th>
					<!-- <td>110.00</td> -->
				</tr>
				<tr>
					<th style="text-align: left;line-height: 1;color: #5b5b5b;" colspan="4">Order id </th>
					<td colspan="2">
						<?php echo $data[0]['display_order_id']; ?>
					</td>
				</tr>
				<!-- <?php if($data[0]['payment_mode']=='online') { ?>
				<tr>
					<th style="text-align: left;line-height: 1;color: #5b5b5b;" colspan="4">Transaction id </th>
					<td colspan="2">
						<?php echo $data[0]['track_id']; ?>
					</td>
				</tr>
				<?php } ?>
				<tr>
					<th style="text-align: left;line-height: 1;color: #5b5b5b;" colspan="4">Payment Mode</th>
					<td colspan="2" style="text-transform: capitalize;">
						<?php echo $data[0]['payment_mode']; ?>
					</td>
				</tr>
				<tr>
					<th style="text-align: left;line-height: 1;color: #5b5b5b;" colspan="4">payment Status</th>
					<td colspan="2">
						<?php echo $data[0]['payment_status']; ?>
					</td>
				</tr> -->
				<tr>
					<th colspan="6"> Order Invoice<p style="font-size: 15px;"></p>
					</th>
					<!-- <td>110.00</td> -->
				</tr>
				<tr>
					<th style="text-align: left;line-height: 1;color: #5b5b5b;" colspan="4">Total Amount</th>
					<td colspan="2"><?php echo $currency; ?>
						<?php echo number_format($data[0]['sub_total'], 2); ?>
					</td>
				</tr>

				<tr>
					<th style="text-align: left;line-height: 1;color: #5b5b5b;" colspan="4">Fees</th>
					<td colspan="2">
						<?php echo $currency; ?>

						<?php if (!empty($data_invoice)) {

						    /*$sum = 0;
						    foreach($data_invoice as $key=>$value)
						    {
						    $sum+= $value['commission'];
						    }*/
						    echo $data[0]['commission']+$data[0]['transfer_fees']+$data[0]['bank_fees'];

						} ?>

					</td>
				</tr>

				<tr>
					<th style="text-align: left;line-height: 1;color: #5b5b5b;" colspan="4">VAT</th>
					<td colspan="2"><?php echo $currency; ?>
						<?php echo $data[0]['tax'] ; ?>
					</td>
				</tr>
				<?php
						    if(!empty($data[0]['coupon_code'])) { ?>
				<tr>
					<th style="text-align: left;line-height: 1;color: #5b5b5b;" colspan="4">Coupon Code</th>
					<td colspan="2">
						<?php echo $data[0]['coupon_code']; ?>
					</td>
				</tr>
				<tr>
					<th style="text-align: left;line-height: 1;color: #5b5b5b;" colspan="4">Coupon Price</th>
					<td colspan="2">
						<?php echo $currency;
						        echo " ";
						        echo $data[0]['coupon_price']; ?>
					</td>
				</tr>
				<?php  } ?>

				<tr>
					<th style="text-align: left;line-height: 1;color: #5b5b5b;" colspan="4">Grand total</th>
					<td colspan="2"><?php echo $currency; ?>
						<?php echo $g_total ; ?>
					</td>
				</tr>


			</tbody>

		</table>
	</div>


</body>
<style type="text/css">
	body {
		/*background-color:#333;*/
		font-family: 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
		color: #333;
		text-align: left;
		font-size: 18px;
		margin: 0;
	}

	html {
		-webkit-print-color-adjust: exact;
		-webkit-filter: opacity(1);
	}

	.container {
		margin: 0 auto;
		margin-top: 35px;
		padding: 10px;
		width: 750px;
		height: auto;
		background-color: #fff;
	}

	caption {
		font-size: 28px;
		margin-bottom: 15px;
	}

	table {
		border: 1px solid #333;
		border-collapse: collapse;
		margin: 0 auto;
		width: 740px;
	}

	td,
	tr,
	th {
		padding: 12px;
		border: 1px solid #333;
		width: 185px;
	}

	th {
		background-color: #f0f0f0;
	}

	h4,
	p {
		margin: 0px;
	}

	</html>
</style>
<?php
                $html = ob_get_clean();
            $file_name = "invoice_".$value['invoice_id'].".pdf";
            require_once('vendor/autoload.php');
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML($html);
            $mpdf->Output($file_name, 'D');
            // ob_end_flush();

        }

    public function get_print_pdf_new($orders_invoice, $order, $language='')
    {
        // echo "<pre>";
        // print_r($order_items);
        // die;
        $currency=$orders_invoice[0]['currency'];
        $total=$orders_invoice[0]['in_sub_total']+$orders_invoice[0]['tax']+$orders_invoice[0]['commission'];
        $address='';
        if(!empty($orders_invoice[0]['address_1'])) {
            $address.=$orders_invoice[0]['address_1'].' ';
        }
        if(!empty($orders_invoice[0]['city'])) {
            $address.=$orders_invoice[0]['city'].' ';
        }
        if(!empty($orders_invoice[0]['state'])) {
            $address.=$orders_invoice[0]['state'].' ';
        }
        if(!empty($orders_invoice[0]['country'])) {
            $address.=$orders_invoice[0]['country'].' ';
        }
        if(!empty($orders_invoice[0]['pincode'])) {
            $address.=$orders_invoice[0]['pincode'].' ';
        }

        $pro_row='';
        $i=1;

        foreach ($orders_invoice[0]['order_items'] as $oi_key => $oi_val) {
            $pro_row.='<tr class="row_padng" >';
            $pro_row.='<td>'.$i.'</td>';
            $pro_row.='<td>'.$oi_val['trans_ref'].'</td>';
            $pro_row.='<td>'.$oi_val['quantity'].'</td>';
            $pro_row.='<td>'.$oi_val['unit_name'].'</td>';
            $pro_row.='<td>'.$oi_val['product_name'].'</td>';
            $pro_row.='<td>'.$currency.' '.$oi_val['price']*$oi_val['quantity'].'</td>';
            $pro_row.='</tr>';
            $i++;
        }
        ob_start();

        ?>

<html>

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<style>
	html,
	body {
		padding: 0px;
		margin: 0px;
		font-family: arial;
		font-size: 14px;
	}

	div {
		box-sizing: border-box;
	}

	.row_padng td {
		padding: 10px 0px;
	}
</style>

<body>
	<div style="text-align: center; background: #f3f3f3; ">
		<div
			style="width: 96%;; background: #fff; box-shadow: 0px 0px 4px 1px #cccccc25; display: inline-block; margin: 20px 0px; padding: 0px 15px 10px 15px; border-radius: 8px; border-top: 5px solid #3f006f; border-bottom: 5px solid #3f006f; ">
			<div style="padding:10px 0px;">
				<img src="<?php echo base_url(); ?>assets/frontend/images/icon/invoice_logo.png"
					style="width: 180px; margin-top: 10px; margin-bottom: 30px; ">
			</div>
			<div style="float: left;width: 45%; text-align: left;  ">
				<div style="width: 100%;">
					<div style="float: left; width:100%; text-align: left; font-weight: 600; line-height: 20px; ">
						<?php echo lang('aINVOICE_NUMBER'); ?>
						<br>
						<!--  رقم الفاتورة -->
					</div>
					<div style="float: left; width: 100%; text-align:left; padding-left: 00px; line-height:18px; ">
						<?php echo $orders_invoice[0]['order_no']; ?>
					</div>
				</div>
			</div>
			<div style="float: right;width: 25%; text-align: left;  ">
				<div style="width: 100%;">
					<div style="float: left; width:100%; text-align: left; font-weight: 600; line-height: 20px;">
						<?php echo lang('Date'); ?>
						<br>
						<!-- التاريخ  -->
					</div>
					<div style="float: left; width: 100%; text-align:left; padding-left: 00px; line-height:18px; ">
						<?php echo date('M-d-Y', strtotime($orders_invoice[0]['created_date'])); ?>
					</div>
				</div>
			</div>
			<div style="clear:both;"></div>
			<div style="width: 100%;">
				<div style="width: 100%; font-weight: 600; margin-top: 30px;">
					<?php echo lang('INVOICE'); ?>
				</div>
				<div style="width: 100%; font-weight: 600; margin-top: 5px;">
					<!-- فاتورة   -->
				</div>
			</div>
			<div style="clear:both;"></div>
			<div style="margin-top: 40px;">
				<div style="float: left;width: 45%; text-align: left;  ">
					<div style="width: 100%;">
						<div style="float: left; width:100%; text-align: left; font-weight: 600; ">
							<?php echo lang('aBUYER_NAME'); ?>
							<br>
							<!-- أسم المشتري -->
						</div>
						<div style="float: left; width: 100%; text-align:left; padding-left: 00px; line-height:18px; ">
							<?php echo $orders_invoice[0]['first_name'].' '.$orders_invoice[0]['last_name']; ?>
						</div>
						<div style="clear:both;"></div>
					</div>
					<div style="width: 100%; margin-top: 25px; ">
						<div style="float: left; width:100%; text-align: left; font-weight: 600; ">
							<?php echo lang('Address'); ?>:
							<br>
							<!-- عنوان -->
						</div>
						<div style="float: left; width: 100%; text-align:left; padding-left: 00px; line-height:18px; ">
							<?php echo $address; ?>
						</div>
						<div style="clear:both;"></div>
					</div>
				</div>
				<div style="float: right;width: 45%; text-align: left;  ">
					<div style="width: 100%;">
						<div style="float: left; width:100%; text-align: left; font-weight: 600; ">
							<?php echo lang('aSELLER_NAME'); ?>
							<br>
							<!-- أسم البائع -->
						</div>
						<div style="float: left; width: 100%; text-align:left; padding-left: 00px; line-height:18px; ">
							<?php echo $orders_invoice[0]['seller_name']; ?>
						</div>
						<div style="clear:both;"></div>
					</div>
					<div style="width: 100%; margin-top: 25px; ">
						<div style="float: left; width:100%; text-align: left; font-weight: 600; ">
							<?php echo lang('Address'); ?>:
							<br>
							<!-- عنوان -->
						</div>
						<div style="float: left; width: 100%; text-align:left; padding-left: 00px; line-height:18px; ">
							<?php echo $orders_invoice[0]['seller_address']; ?>
						</div>
						<div style="clear:both;"></div>
					</div>
				</div>
			</div>
			<div style="clear:both;"></div>
			<div style="width:100%; margin-top: 20px; ">
				<table style="border: 2px solid #ccc; width: 100%; font-size: 14px; " cellpadding="0" cellspacing="0">
					<tr style="font-weight: 600; background:#ccc;  ">
						<td style="padding:6px 00px; width: 100px; ">
							<?php echo lang('aSerial_Number'); ?>
							<br>
							<!-- رقم التسلسلي -->
						</td>
						<td style="width: 110px;">
							<?php echo lang('Item_Code'); ?>
							<br>
							<!-- رمز المنتج -->
						</td>
						<td style="width: 90px;">
							<?php echo lang('quantity'); ?>
							<br>
							<!-- الكمية -->
						</td>
						<td style="width: 80px;">
							<?php echo lang('Unit'); ?>
							<br>
							<!-- وحدة القياس -->
						</td>
						<td style="width: 190px;">
							<?php echo lang('Item_Description'); ?>
							<br>
							<!-- وصف المنتج -->
						</td>
						<td style="width: 110px;">
							<?php echo lang('Currency_Price'); ?>
							<br>
							<!-- العملة / السعر  -->
						</td>
					</tr>
					<?php echo $pro_row; ?>


				</table>
			</div>
			<div style="margin-top: 20px; margin-bottom: 30px; ">
				<div style="float: left;width: 45%; text-align: left;  ">
					<div style="width: 100%;">
						<div style="float: left; width:100%; text-align: left; font-weight: 600; line-height: 20px; ">
							<?php echo lang('aPayment_Terms'); ?>
							<br>
						</div>
						<div style="float: left; width: 100%; text-align:left; padding-left: 00px; line-height:18px; ">
							<div
								style="float: left; width: 60%; text-align:left; padding-left: 00px; line-height:18px; font-weight: 600; ">
								<?php echo $orders_invoice[0]['payment_mode']; ?>
							</div>
						</div>
					</div>
				</div>
				<div style="float: right;width: 45%; text-align: left;  ">
					<div style="width: 100%;">
						<div style="float: left; width:40%; text-align: left; font-weight: 600; line-height: 20px;">
							<?php echo lang('total'); ?>
						</div>
						<div
							style="float: left; width: 60%; text-align:left; padding-left: 00px; line-height:18px; font-weight: 600; ">
							<?php echo $currency; ?>
							<?php echo $orders_invoice[0]['in_sub_total']; ?>
						</div>
					</div>
				</div>
				<div style="clear: both;"></div>
			</div>
			<div style="margin-top: 20px; margin-bottom: 40px; ">
				<!-- <div style="float: left;width: 45%; text-align: left;  " >
									<div style="width: 100%;">
										<div style="float: left; width:100%; text-align: left; font-weight: 600; line-height: 20px; " >
											<?php echo lang('aPayment_Terms'); ?>
				<br>
				شروط الدفع
			</div>
			<div style="float: left; width: 100%; text-align:left; padding-left: 00px; line-height:18px; ">
				<?php echo lang('aPayment_Terms_desc'); ?>
			</div>
		</div>
	</div> -->

	<div style="clear: both;"></div>
	<?php if(!empty($order)) { ?>
	<a href="<?php echo base_url($language.'/admin/invoice/order_invoice/').$orders_invoice[0]['order_no'] ?>"
		style="display: inline-block; background: #dadada; margin-top: 30px; text-decoration: none; padding: 12px 18px; font-size: 14px; font-weight: 600; border-radius: 3px; color: #353535; ">
		<?php echo lang('aDownload_Invoice'); ?>
	</a>
	<div style="clear: both;"></div>
	<?php  } ?>
	</div>
	</div>
	</div>
</body>

</html>

<?php
            $html = ob_get_clean();
        if(!empty($order)) {
            // ec0ho "<pre>";
            print_r($html);
            die;
        }
        $file_name = "invoice_".$orders_invoice[0]['order_no'].".pdf";
        // $file_name = "invoice_1212.pdf";
        require_once('vendor/autoload.php');
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output($file_name, 'D');

    }
    public function get_catalog_pdf($pdf_data, $language='')
    {

		$pdf_theme =$pdf_data['catalog'][0]->theme;
        ob_start();
        $CI =& get_instance();
        $CI->load->database();
		if($pdf_theme == 'default'){
?>
		<!DOCTYPE html>

		<html>

				<head>
					<meta http-equiv="content-type" content="text/html; charset=utf-8" />
				</head>
				<style>
					table {
						width: 100%;
						background: #fff;
						padding: 0px !important;
						border-radius: 10px;
						box-shadow: 0px 0px 5px 3px #e3e3e394;
					}

					footer {
						text-align: center;
						font-style: italic;
					}

					tr {
						max-width: 100% !important;
					}
				</style>

				<body>
					<div style="text-align: center;">
						<?php if ($language == 'en') { ?>
						<img src="<?php echo base_url(); ?>assets/frontend/images/icon/invoice_logo.png"
							alt="" style="width: 180px;">
						<?php } else { ?>
						<img style="width: 180px"
							src="<?php echo base_url(); ?>assets/frontend/images/icon/logo-arabic-croped.png"
							alt="">
						<?php } ?>
						<hr style="border-width: 3px;border-color: #4F0381;width: 18rem;" />
						<!-- <img src="<?php echo base_url(); ?>assets/frontend/images/icon/invoice_logo.png"
						style="width: 180px; margin-top: 10px; margin-bottom: 30px; "> -->
					</div>

					<h4 style="color: #4F0381;font-family: Aladin;font-weight: bold;">
						Seller Information:
					</h4>
					<table style="border-radius: 10%;border: 1px solid #ccc; padding: 10px 10px;    border-radius: 10px;
					box-shadow: 0px 0px 3px 2px #e7e7e7;">
						<tr>
							<td>
								<div>
									<img style="border-radius: 50%; box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;margin: 0rem 1rem;"
										src="<?php echo base_url('assets/admin/usersdata/') ?><?= $pdf_data['vendor'][0]->logo?>"
										width="40px" height="40px">
								</div>
							</td>
							<td>
								<div>
									<h5 style="color: #4F0381;font-size: 12px;font-family: Aladin;margin-top: 0; margin-bottom: 10px;">
										First Name:&nbsp;&nbsp;<span
											style="color: #000000;font-weight: 520;font-size: 14px;font-family: Aladin;"><?= $pdf_data['vendor'][0]->first_name?></span>
									</h5>
									<br />
									<h5 style="color: #4F0381;font-size: 12px;font-family: Aladin;margin-top: 0;margin-bottom: 10px;">
										Last Name:&nbsp;&nbsp;<span
											style="color: #000000;font-weight: 520;font-size: 14px;font-family: Aladin;"><?= $pdf_data['vendor'][0]->last_name?></span>
									</h5>
								</div>
							</td>
							<td>
								<div>
									<h5 style="color: #4F0381;font-size: 12px;font-family: Aladin;margin-top: 0;margin-bottom: 10px;">
										Contact No:&nbsp;&nbsp;<span
											style="color: #000000;font-weight: 520;font-size: 14px;font-family: Aladin;"><?= $pdf_data['vendor'][0]->phone?></span>
									</h5>
									<br />
									<h5 style="color: #4F0381;font-size: 12px;font-family: Aladin;margin-top: 0;margin-bottom: 10px;">
										Email:&nbsp;&nbsp;<span
											style="color: #000000;font-weight: 520;font-size: 14px;font-family: Aladin;margin-top: 0;margin-bottom: 10px;"><?= $pdf_data['vendor'][0]->email?></span>
									</h5>
								</div>
							</td>
							<td>
								<div>
									<h5 style="color: #4F0381;font-size: 12px;font-family: Aladin;margin-top: 0;margin-bottom: 10px;">
										Active Status:&nbsp;&nbsp;<span
											style="color: #000000;font-weight: 520;font-size: 14px;font-family: Aladin;margin-top: 0;margin-bottom: 10px;"><?php if($pdf_data['vendor'][0]->active == 1) {?>
											Active<?php } else {
												echo "Inactive";
											}?>
										</span>
									</h5>
									<br />
									<h5 style="color: #4F0381;font-size: 12px;font-family: Aladin;margin-top: 0;margin-bottom: 10px;">
										City:&nbsp;&nbsp;<span
											style="color: #000000;font-weight: 520;font-size: 14px;font-family: Aladin;"><?= $pdf_data['vendor'][0]->city?></span>
									</h5>
								</div>
							</td>

						</tr>
					</table>
					<br />
					<h4 style="color: #4F0381;font-family: Aladin;font-weight: bold;">
						Products:
					</h4>
					<div style="flex-wrap:no-wrap">
						<table>
							<tr>

								<td style="width:100%">
									<div>
										<?php foreach ($pdf_data['seller_products'] as $value) { ?>
										<table
											style="border-radius: 10%;border: 1px solid #ccc; padding: 10px 10px;padding:10px;margin-bottom:20px">
											<tr>
												<td style="width:35%">
													<img style="border-radius: 10%;box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;margin: 0rem 1rem;"
														src="<?php echo base_url("assets/admin/products/") . $value->product_image; ?>"
														width="27%" height="20%">
												</td>
												<td style="width:35%">
													<h5
														style="color: #4F0381;font-size: 12px;font-family: Aladin;line-height: 24px;letter-spacing: 0.05em;margin-top: 0;margin-bottom: 10px;">
														product name&nbsp;&nbsp;:
													</h5>
													<br />
													<h5
														style="color: #4F0381;font-size: 12px;font-family: Aladin;line-height: 24px;letter-spacing: 0.05em;margin-top: 0;margin-bottom: 10px;">
														Brand Name&nbsp;&nbsp;:
													</h5>
													<br />
													<h5
														style="color: #4F0381;font-size: 12px;font-family: Aladin;line-height: 24px;letter-spacing: 0.05em;margin-top: 0;margin-bottom: 10px;">
														Catagory&nbsp;&nbsp;:
													</h5>
													<br />
													<h5
														style="color: #4F0381;font-size: 12px;font-family: Aladin;line-height: 24px;letter-spacing: 0.05em;margin-top: 0;margin-bottom: 10px;">
														Stock Status&nbsp;&nbsp;:
													</h5>
													<br />
													<h5
														style="color: #4F0381;font-size: 12px;font-family: Aladin;line-height: 24px;letter-spacing: 0.05em;margin-top: 0;margin-bottom: 10px;">
														Price
														&nbsp;&nbsp;:
													</h5>

												</td>
												<td style="width:30%">
													<h5
														style="color: #000000;font-weight: bold;font-size: 13px;    line-height: 24px;letter-spacing: 0.05em; font-family: Aladin;margin-top: 0;margin-bottom: 10px;">
														<?= $value->product_name ?>
													</h5>
													<br />
													<h5
														style="color: #000000;font-weight: bold;font-size: 13px;    line-height: 24px;letter-spacing: 0.05em; font-family: Aladin;margin-top: 0;margin-bottom: 10px;">
														<?php $brand_data = $CI->db->get_where('brand', array('id'=>$value->brand))->result();?>
														<?= $brand_data[0]->brand_name ?>
													</h5>
													<br />
													<h5 style=" color: #000000; font-weight: bold; font-size: 13px; line-height: 24px; letter-spacing: 0.05em;
																							font-family: Aladin;margin-top: 0;margin-bottom: 10px;">
														<?php $category_data = $CI->db->get_where('category', array('id'=>$value->category))->result();?>
														<?= $category_data[0]->display_name ?>
													</h5>
													<br />
													<h5
														style="color: #000000;font-weight: bold;font-size: 13px;    line-height: 24px;letter-spacing: 0.05em; font-family: Aladin;margin-top: 0;margin-bottom: 10px;">
														<?= $value->stock_status ?>
													</h5>
													<br />
													<span
														style="color: #FFFFFF !important;background-color: #4F0381;border-color: #4F0381;border-radius: 5px;font-family: Aladin;font-size: 16px;font-weight: bold;display: inline-block;font-weight: 550;text-align: center;white-space: nowrap;vertical-align: middle;user-select: none;border: 1px solid transparent;padding: 0.375rem 0.75rem;">
														SAR
														<?= $value->sale_price ?>
													</span>
												</td>
											</tr>
											<tr>
												<td style="padding-left:16px;">
													<h6
														style="font-size: 8px !important;line-height: 1.2rem !important;font-weight: 400;color: #888888;letter-spacing: 0.5px;font-family: Aladin;margin-bottom: 0.5rem;margin-top: 10px;">
														<?= $value->short_description ?>
													</h6>
												</td>
											</tr>
										</table>

										<?php }?>
									</div>
								</td>
							</tr>
						</table>
					</div>
					<br />
					<div>
						<h2
							style="text-align: center;font-family: Aladin;color: #4F0381;font-weight: bold;line-height: 1;letter-spacing: 0.02em;font-size: 18px;">
							Contact Us
						</h2>
						<hr style="border-width: 3px;border-color: #4F0381;margin: 0rem 2rem;" />
					</div>
					<table>
						<tr>
							<td style="padding-top:20px;width:33%;text-align:center;justify-content:center">
								<h4
									style="color: #000000;font-weight: 550;text-decoration: underline;font-family: Aladin;letter-spacing: 0.03em;line-height: 1;font-size: 16px;text-transform: capitalize;">
									<span><img style="width: 1.2rem;height: 1.2rem;margin: -1rem 0.5rem -0.3rem 0.5rem;"
											src="<?php echo base_url(); ?>assets/frontend/images/icon/phone-icon.svg"
											alt=""></span>920033769
								</h4>
							</td>
							<td style="padding-top:20px;width:33%;text-align:center;justify-content:center">
								<h4
									style="color: #000000;font-weight: 550;text-decoration: underline;font-family: Aladin;letter-spacing: 0.03em;line-height: 1;font-size: 16px;text-transform: capitalize;">
									<span><img style="width: 1.2rem;height: 1.2rem;margin: -1rem 0.5rem -0.3rem 0.5rem"
											src="<?php echo base_url(); ?>assets/frontend/images/icon/email-icon.svg"
											alt=""></span>info@port10.sa
								</h4>
							</td>
							<td style="padding-top:20px;width:33%;text-align:center;justify-content:center">
								<h4
									style="color: #000000;font-weight: 550;text-decoration: underline;font-family: Aladin;letter-spacing: 0.03em;line-height: 1;font-size: 16px;text-transform: capitalize;">
									port10.sa.com</h4>
							</td>
						</tr>
					</table>


				</body>

		</html>

<?php }elseif($pdf_theme == 'red'){ ?>
		<html>

				<head>
					<meta http-equiv="content-type" content="text/html; charset=utf-8" />
				</head>
				<style>
					table {
						width: 100%;
						background: #fff;
						padding: 0px !important;
						border-radius: 10px;
						box-shadow: 0px 0px 5px 3px #e3e3e394;
					}

					footer {
						text-align: center;
						font-style: italic;
					}

					tr {
						max-width: 100% !important;
					}
				</style>

				<body>
					<div style="text-align: center;">
						<?php if ($language == 'en') { ?>
						<img src="<?php echo base_url(); ?>assets/frontend/images/icon/invoice_logo.png"
							alt="" style="width: 180px;">
						<?php } else { ?>
						<img style="width: 180px"
							src="<?php echo base_url(); ?>assets/frontend/images/icon/logo-arabic-croped.png"
							alt="">
						<?php } ?>
						<hr style="border-width: 3px;border-color: #4F0381;width: 18rem;" />
						<!-- <img src="<?php echo base_url(); ?>assets/frontend/images/icon/invoice_logo.png"
						style="width: 180px; margin-top: 10px; margin-bottom: 30px; "> -->
					</div>

					<h4 style="color: #4F0381;font-family: Aladin;font-weight: bold;">
						Seller Information:
					</h4>
					<table style="border-radius: 10%;border: 1px solid #ccc; padding: 10px 10px;">
						<tr>
							<td>
								<div>
									<img style="border-radius: 50%; box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;margin: 0rem 1rem;"
										src="<?php echo base_url('assets/admin/usersdata/') ?><?= $pdf_data['vendor'][0]->logo?>"
										width="40px" height="40px">
								</div>
							</td>
							<td>
								<div>
									<h5 style="color: #4F0381;font-size: 12px;font-family: Aladin;margin-top: 0; margin-bottom: 10px;">
										First Name:&nbsp;&nbsp;<span
											style="color: #000000;font-weight: 520;font-size: 14px;font-family: Aladin;"><?= $pdf_data['vendor'][0]->first_name?></span>
									</h5>
									<br />
									<h5 style="color: #4F0381;font-size: 12px;font-family: Aladin;margin-top: 0;margin-bottom: 10px;">
										Last Name:&nbsp;&nbsp;<span
											style="color: #000000;font-weight: 520;font-size: 14px;font-family: Aladin;"><?= $pdf_data['vendor'][0]->last_name?></span>
									</h5>
								</div>
							</td>
							<td>
								<div>
									<h5 style="color: #4F0381;font-size: 12px;font-family: Aladin;margin-top: 0;margin-bottom: 10px;">
										Contact No:&nbsp;&nbsp;<span
											style="color: #000000;font-weight: 520;font-size: 14px;font-family: Aladin;"><?= $pdf_data['vendor'][0]->phone?></span>
									</h5>
									<br />
									<h5 style="color: #4F0381;font-size: 12px;font-family: Aladin;margin-top: 0;margin-bottom: 10px;">
										Email:&nbsp;&nbsp;<span
											style="color: #000000;font-weight: 520;font-size: 14px;font-family: Aladin;margin-top: 0;margin-bottom: 10px;"><?= $pdf_data['vendor'][0]->email?></span>
									</h5>
								</div>
							</td>
							<td>
								<div>
									<h5 style="color: #4F0381;font-size: 12px;font-family: Aladin;margin-top: 0;margin-bottom: 10px;">
										Active Status:&nbsp;&nbsp;<span
											style="color: #000000;font-weight: 520;font-size: 14px;font-family: Aladin;margin-top: 0;margin-bottom: 10px;"><?php if($pdf_data['vendor'][0]->active == 1) {?>
											Active<?php } else {
												echo "Inactive";
											}?>
										</span>
									</h5>
									<br />
									<h5 style="color: #4F0381;font-size: 12px;font-family: Aladin;margin-top: 0;margin-bottom: 10px;">
										City:&nbsp;&nbsp;<span
											style="color: #000000;font-weight: 520;font-size: 14px;font-family: Aladin;"><?= $pdf_data['vendor'][0]->city?></span>
									</h5>
								</div>
							</td>

						</tr>
					</table>
					<br />
					<h4 style="color: #4F0381;font-family: Aladin;font-weight: bold;">
						Products:
					</h4>
					<div style="flex-wrap:no-wrap">
						<table>
							<tr>

								<td style="width:100%">
									<div>
										<?php foreach ($pdf_data['seller_products'] as $value) { ?>
										<table
											style="border-radius: 10%;border: 1px solid #ccc; padding: 10px 10px;padding:10px;margin-bottom:20px">
											<tr>
												<td style="width:35%">
													<img style="border-radius: 10%;box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;margin: 0rem 1rem;"
														src="<?php echo base_url("assets/admin/products/") . $value->product_image; ?>"
														width="27%" height="20%">
												</td>
												<td style="width:35%">
													<h5
														style="color: #4F0381;font-size: 12px;font-family: Aladin;line-height: 24px;letter-spacing: 0.05em;margin-top: 0;margin-bottom: 10px;">
														product name&nbsp;&nbsp;:
													</h5>
													<br />
													<h5
														style="color: #4F0381;font-size: 12px;font-family: Aladin;line-height: 24px;letter-spacing: 0.05em;margin-top: 0;margin-bottom: 10px;">
														Brand Name&nbsp;&nbsp;:
													</h5>
													<br />
													<h5
														style="color: #4F0381;font-size: 12px;font-family: Aladin;line-height: 24px;letter-spacing: 0.05em;margin-top: 0;margin-bottom: 10px;">
														Catagory&nbsp;&nbsp;:
													</h5>
													<br />
													<h5
														style="color: #4F0381;font-size: 12px;font-family: Aladin;line-height: 24px;letter-spacing: 0.05em;margin-top: 0;margin-bottom: 10px;">
														Stock Status&nbsp;&nbsp;:
													</h5>
													<br />
													<h5
														style="color: #4F0381;font-size: 12px;font-family: Aladin;line-height: 24px;letter-spacing: 0.05em;margin-top: 0;margin-bottom: 10px;">
														Price
														&nbsp;&nbsp;:
													</h5>

												</td>
												<td style="width:30%">
													<h5
														style="color: #000000;font-weight: bold;font-size: 13px;    line-height: 24px;letter-spacing: 0.05em; font-family: Aladin;margin-top: 0;margin-bottom: 10px;">
														<?= $value->product_name ?>
													</h5>
													<br />
													<h5
														style="color: #000000;font-weight: bold;font-size: 13px;    line-height: 24px;letter-spacing: 0.05em; font-family: Aladin;margin-top: 0;margin-bottom: 10px;">
														<?php $brand_data = $CI->db->get_where('brand', array('id'=>$value->brand))->result();?>
														<?= $brand_data[0]->brand_name ?>
													</h5>
													<br />
													<h5 style=" color: #000000; font-weight: bold; font-size: 13px; line-height: 24px; letter-spacing: 0.05em;
																							font-family: Aladin;margin-top: 0;margin-bottom: 10px;">
														<?php $category_data = $CI->db->get_where('category', array('id'=>$value->category))->result();?>
														<?= $category_data[0]->display_name ?>
													</h5>
													<br />
													<h5
														style="color: #000000;font-weight: bold;font-size: 13px;    line-height: 24px;letter-spacing: 0.05em; font-family: Aladin;margin-top: 0;margin-bottom: 10px;">
														<?= $value->stock_status ?>
													</h5>
													<br />
													<span
														style="color: #FFFFFF !important;background-color: #4F0381;border-color: #4F0381;border-radius: 5px;font-family: Aladin;font-size: 16px;font-weight: bold;display: inline-block;font-weight: 550;text-align: center;white-space: nowrap;vertical-align: middle;user-select: none;border: 1px solid transparent;padding: 0.375rem 0.75rem;">
														SAR
														<?= $value->sale_price ?>
													</span>
												</td>
											</tr>
											<tr>
												<td style="padding-left:16px;">
													<h6
														style="font-size: 8px !important;line-height: 1.2rem !important;font-weight: 400;color: #888888;letter-spacing: 0.5px;font-family: Aladin;margin-bottom: 0.5rem;margin-top: 10px;">
														<?= $value->short_description ?>
													</h6>
												</td>
											</tr>
										</table>

										<?php }?>
									</div>
								</td>
							</tr>
						</table>
					</div>
					<br />
					<div>
						<h2
							style="text-align: center;font-family: Aladin;color: #4F0381;font-weight: bold;line-height: 1;letter-spacing: 0.02em;font-size: 18px;">
							Contact Us
						</h2>
						<hr style="border-width: 3px;border-color: #4F0381;margin: 0rem 2rem;" />
					</div>
					<table>
						<tr>
							<td style="padding-top:20px;width:33%;text-align:center;justify-content:center">
								<h4
									style="color: #000000;font-weight: 550;text-decoration: underline;font-family: Aladin;letter-spacing: 0.03em;line-height: 1;font-size: 16px;text-transform: capitalize;">
									<span><img style="width: 1.2rem;height: 1.2rem;margin: -1rem 0.5rem -0.3rem 0.5rem;"
											src="<?php echo base_url(); ?>assets/frontend/images/icon/phone-icon-red.svg"
											alt=""></span>920033769
								</h4>
							</td>
							<td style="padding-top:20px;width:33%;text-align:center;justify-content:center">
								<h4
									style="color: #000000;font-weight: 550;text-decoration: underline;font-family: Aladin;letter-spacing: 0.03em;line-height: 1;font-size: 16px;text-transform: capitalize;">
									<span><img style="width: 1.2rem;height: 1.2rem;margin: -1rem 0.5rem -0.3rem 0.5rem"
											src="<?php echo base_url(); ?>assets/frontend/images/icon/email-icon-red.svg"
											alt=""></span>info@port10.sa
								</h4>
							</td>
							<td style="padding-top:20px;width:33%;text-align:center;justify-content:center">
								<h4
									style="color: #000000;font-weight: 550;text-decoration: underline;font-family: Aladin;letter-spacing: 0.03em;line-height: 1;font-size: 16px;text-transform: capitalize;">
									port10.sa.com</h4>
							</td>
						</tr>
					</table>


				</body>

		</html>
<?php }?>											
<?php
        $html = ob_get_clean();
        $file_name = "catalog.pdf";
        require_once('vendor/autoload.php');
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output($file_name, 'D');

    }

}



?>