<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Library to search from website or app
*/
class Pdf_product {

	public function __construct()
	{
	// Assign the CodeIgniter super-object
	$this->CI =& get_instance();
	$this->CI->load->model('admin/Custom_model','custom_model');
	date_default_timezone_set('Asia/Kolkata');
	$this->order_datetime = date('Y-m-d H:i:s');
	}

	public function get_print_pdf_list($order_items,$order,$item_id)
	{
		ob_start();		
	 	$currency=$order_items[0]['currency'];
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
						
					<img style="  width: 160px;  height: 70px;  background-size: 100% 100%;" src="<?php echo base_url(); ?>assets/frontend/images/icon/logo.png">
					</div>
					<br>
					Order invoice <a style="text-decoration:none" href="<?php echo base_url('invoice/product/').$item_id ?>">Download Invoice</a>
				</caption>
				<thead>
					<tr>
						<th style="text-align: left;" colspan="4">Name : <?php echo $order_items[0]['first_name'].' '.$order_items[0]['last_name']; ?></th>
						<th colspan="2">Transaction Reference: <?php echo $order_items[0]['trans_ref']; ?></th>
					</tr>
					<tr>
					<td style="background-color: #f0f0f0; font-weight: bold;" colspan="3">
						<p>Address</p>							
					</td>
					 
					
					<td colspan="3">
						<p><?php echo $order_items[0]['address_1']; ?></p>
					</td>
					
				</tr>	
				<tr>
					<td style="background-color: #f0f0f0; font-weight: bold;" colspan="3">	
						<p>City</p>							
					</td>						 
					
					<td colspan="3">							
						<p><?php echo $order_items[0]['city']; ?></p>
					</td>
					
				</tr>
				<tr>
					<td style="background-color: #f0f0f0; font-weight: bold;" colspan="3">	
						<p>Country</p>							
					</td>						 
					
					<td colspan="3">							
						<p><?php echo $order_items[0]['country']; ?></p>
					</td>
					
				</tr>
				<tr>
					<td style="background-color: #f0f0f0; font-weight: bold;" colspan="3">	
						<p>Mobile no</p>							
					</td>						 
					
					<td colspan="3">							
						<p><?php echo $order_items[0]['mobile_no']; ?></p>
					</td>
					
				</tr>

				<tr>
					<td style="background-color: #f0f0f0; font-weight: bold;" colspan="3">	
						<p>Email</p>							
					</td>						 
					
					<td colspan="3">												<p><?php echo $order_items[0]['email']; ?></p>
					</td>
					
				</tr>				
				
					
				</thead>
				<tbody>


					<tr>
						<th colspan="4">Product Name </th>
						<th>Qty</th>
						<th>Sub Total</th>
					</tr>									
		                                              
					<tr>
						<td colspan="4"><?php echo $order_items[0]['product_name']; ?>(<?php echo $order_items[0]['unit_name']; ?>)</td>
						<td><?php echo $order_items[0]['quantity']; ?></td>
						<td><?php echo $currency; ?> <?php echo $order_items[0]['price']; ?></td>
					</tr>
					
					<tr>
						<th colspan="6"> Order Invoice<p style="font-size: 15px;"></p></th>							
					</tr>
					<tr> 
						<th style="text-align: left;line-height: 1;color: #5b5b5b;" colspan="4">Total Amount</th>
						<td colspan="2"><?php echo $currency; ?> <?php echo $order_items[0]['price']; ?></td>	
					</tr>
					
					<tr>
	                  <th style="text-align: left;line-height: 1;color: #5b5b5b;" colspan="4">Commission</th>
	                  <td colspan="2"><?php echo $currency; ?> <?php echo $order_items[0]['commision']; ?>
	                  </td>
	                </tr>
	                
	                   <tr>
	                      <th style="text-align: left;line-height: 1;color: #5b5b5b;" colspan="4">Tax</th>
	                      <td colspan="2"><?php echo $currency; ?> <?php echo $order_items[0]['tax']; ?></td>
	                    </tr>                      
	                	<?php $gtotal=$order_items[0]['price']+$order_items[0]['tax']+$order_items[0]['commision'];   ?>
	                    <tr>
	                      <th style="text-align: left;line-height: 1;color: #5b5b5b;" colspan="4">Grand total</th>
	                      <td colspan="2"><?php echo $currency; ?> <?php echo $gtotal; ?></td>
	                    </tr>
	                

				</tbody>
				
			</table>
		</div>
		    

		</body>
		<style type="text/css">
		body{
			/*background-color:#333;*/
			font-family:'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
			color:#333;
			text-align:left;
			font-size:18px;
			margin:0;
		}
		.container{
			margin:0 auto;
			margin-top:35px;
			padding:10px;
			width:750px;
			height:auto;
			background-color:#fff;
		}
		caption{
			font-size:28px;
			margin-bottom:15px;
		}
		table{
			border:1px solid #333;
			border-collapse:collapse;
			margin:0 auto;
			width:740px;
		}
		td, tr, th{
			padding:12px;
			border:1px solid #333;
			width:185px;
		}
		th{
			background-color: #f0f0f0;
		}
		h4, p{
			margin:0px;
		}

		</html>

		</style>				
		<?php
	    	$html = ob_get_clean();   
	    	if(!empty($order))
	    	{
	        	// echo "<pre>";
	        	print_r($html);
	        	die;
	    	}
	         $file_name = "invoice_".$order_items[0]['item_id'].".pdf";
	         // $file_name = "invoice_1212.pdf";
	        require_once('vendor/autoload.php');
		  	$mpdf = new \Mpdf\Mpdf();
	        $mpdf->WriteHTML($html);
		    $mpdf->Output($file_name, 'D');
		    // ob_end_flush(); 	    		    
	}

	public function get_print_pdf_new($order_items,$order,$item_id)
	{
		// this funciton for single product invoice
		// echo "<pre>";
		// print_r($order_items);
		// die;
		$currency=$order_items[0]['currency'];
		$total=$order_items[0]['sub_total']+$order_items[0]['tax']+$order_items[0]['commision'];
		$address='';		
		if(!empty($order_items[0]['address_1']))
		{
			$address.=$order_items[0]['address_1'].' ';
		}
		if(!empty($order_items[0]['city']))
		{
			$address.=$order_items[0]['city'].' ';
		}
		if(!empty($order_items[0]['state']))
		{
			$address.=$order_items[0]['state'].' ';
		}
		if(!empty($order_items[0]['country']))
		{
			$address.=$order_items[0]['country'].' ';
		}
		if(!empty($order_items[0]['pincode']))
		{
			$address.=$order_items[0]['pincode'].' ';
		}		
		                    
		$pro_row='';     
		$i=1;             
		foreach ($order_items as $oi_key => $oi_val) 
		{
			$pro_row.='<tr class="row_padng" >';
			$pro_row.='<td>'.$i.'</td>';
			$pro_row.='<td>'.$oi_val['trans_ref'].'</td>';
			$pro_row.='<td>'.$oi_val['quantity'].'</td>';
			$pro_row.='<td>'.$oi_val['unit_name'].'</td>';
			$pro_row.='<td>'.$oi_val['product_name'].'</td>';
			$pro_row.='<td>'.$currency.' '.$oi_val['price'].'</td>';
			$pro_row.='</tr>';
			$i++;
		}
		ob_start();		
	 	
	 	?>
	 	<!DOCTYPE html>
		<html>
		   <head>		      
		      <meta http-equiv="content-type" content="text/html; charset=utf-8" />
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
		   </style>
		   <body>
		      <div style="text-align: center; background: #f3f3f3; " >
		         <div style="width: 100%; background: #fff; box-shadow: 0px 0px 4px 1px #cccccc25; display: inline-block; margin: 20px 0px; padding: 0px 15px 10px 15px; border-radius: 8px; border-top: 5px solid #3f006f; border-bottom: 5px solid #3f006f; " >
		            <div style="padding:10px 0px;">
		               <img src="<?php echo base_url(); ?>assets/frontend/images/icon/invoice_logo.png" style="width: 180px; margin-top: 10px; margin-bottom: 30px; " >
		            </div>
		            <div style="float: left;width: 45%; text-align: left;  " >
		               <div style="width: 100%;">
		                  <div style="float: left; width:100%; text-align: left; font-weight: 600; line-height: 20px; " >
		                     INVOICE NUMBER
		                     <br>
		                     <!--  رقم الفاتورة -->
		                  </div>
		                  <div style="float: left; width: 100%; text-align:left; padding-left: 00px; line-height:18px; " > <?php echo $order_items[0]['item_id']; ?> </div>
		               </div>
		            </div>
		            <div style="float: right;width: 25%; text-align: left;  " >
		               <div style="width: 100%;">
		                  <div style="float: left; width:100%; text-align: left; font-weight: 600; line-height: 20px;" >
		                     DATE
		                     <br>
		                     <!-- التاريخ  -->
		                  </div>
		                  <div style="float: left; width: 100%; text-align:left; padding-left: 00px; line-height:18px; " > <?php echo date('M-d-Y' ,strtotime($order_items[0]['created_date'])); ?> </div>
		               </div>
		            </div>
		            <div style="clear:both;"></div>
		            <div style="width: 100%;">
		               <div style="width: 100%; font-weight: 600; margin-top: 30px;" >  INVOICE  </div>
		               <div style="width: 100%; font-weight: 600; margin-top: 5px;" ><!-- فاتورة   --> </div>
		            </div>
		            <div style="clear:both;"></div>
		            <div style="margin-top: 40px;" >
		               <div style="float: left;width: 45%; text-align: left;  " >
		                  <div style="width: 100%;">
		                     <div style="float: left; width:100%; text-align: left; font-weight: 600; " >
		                        BUYER NAME
		                        <br>
		                        <!-- أسم المشتري -->
		                     </div>
		                     <div style="float: left; width: 100%; text-align:left; padding-left: 00px; line-height:18px; " > 
		                        <?php echo $order_items[0]['first_name'].' '.$order_items[0]['last_name']; ?>
		                     </div>
		                     <div style="clear:both;"></div>
		                  </div>
		                  <div style="width: 100%; margin-top: 25px; ">
		                     <div style="float: left; width:100%; text-align: left; font-weight: 600; " >
		                        ADDRESS: 
		                        <br>
		                        <!-- عنوان -->
		                     </div>
		                     <div style="float: left; width: 100%; text-align:left; padding-left: 00px; line-height:18px; " > 
		                        <?php echo $address; ?>
		                     </div>
		                     <div style="clear:both;"></div>
		                  </div>
		               </div>
		               <div style="float: right;width: 45%; text-align: left;  " >
		                  <div style="width: 100%;">
		                     <div style="float: left; width:100%; text-align: left; font-weight: 600; " >
		                        SELLER NAME
		                        <br>
		                        <!-- أسم البائع -->
		                     </div>
		                     <div style="float: left; width: 100%; text-align:left; padding-left: 00px; line-height:18px; " > 
		                        <?php echo $order_items[0]['seller_name']; ?>
		                     </div>
		                     <div style="clear:both;"></div>
		                  </div>
		                  <div style="width: 100%; margin-top: 25px; ">
		                     <div style="float: left; width:100%; text-align: left; font-weight: 600; " >
		                        ADDRESS: 
		                        <br>
		                        <!-- عنوان -->
		                     </div>
		                     <div style="float: left; width: 100%; text-align:left; padding-left: 00px; line-height:18px; " > 
		                        <?php echo $order_items[0]['seller_address']; ?>
		                     </div>
		                     <div style="clear:both;"></div>
		                  </div>
		               </div>
		            </div>
		            <div style="clear:both;"></div>
		            <div style="width:100%; margin-top: 20px; ">
		               <table style="border: 2px solid #ccc; width: 100%; font-size: 14px; " cellpadding="0" cellspacing="0" >
		                  <tr style="font-weight: 600; background:#ccc;  " >
		                     <td style="padding:6px 00px; width: 100px; " >
		                        Serial Number
		                        <br>
		                        <!-- رقم التسلسلي -->
		                     </td>
		                     <td style="width: 110px;" >
		                        Item Code
		                        <br>
		                        <!-- رمز المنتج -->
		                     </td>
		                     <td style="width: 90px;" >
		                        Quantity
		                        <br>
		                        <!-- الكمية -->
		                     </td>
		                     <td style="width: 80px;" >
		                        Unit
		                        <br>
		                        <!-- وحدة القياس -->
		                     </td>
		                     <td style="width: 190px;" >
		                        Item Description
		                        <br>
		                        <!-- وصف المنتج -->
		                     </td>
		                     <td style="width: 110px;" >
		                        Currency / Price
		                        <br>
		                        <!-- العملة / السعر  -->
		                     </td>
		                  </tr>
		                  <?php echo $pro_row; ?>
		                  
		                  
		               </table>
		            </div>
		            <div style="margin-top: 20px; margin-bottom: 30px; " >
		               <div style="float: left;width: 45%; text-align: left;  " >
		                  <div style="width: 100%;">
		                     <div style="float: left; width:100%; text-align: left; font-weight: 600; line-height: 20px; " >
		                        Delivery Term
		                        <br>
		                        <!-- شروط الشحن -->
		                     </div>
		                     <div style="float: left; width: 100%; text-align:left; padding-left: 00px; line-height:18px; " > 
		                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
		                     </div>
		                  </div>
		               </div>
		               <div style="float: right;width: 45%; text-align: left;  " >
		                  <div style="width: 100%;">
		                     <div style="float: left; width:100%; text-align: left; font-weight: 600; line-height: 20px;" >
		                        Net Amount
		                        <br>
		                       <!--  المبلغ الصافي -->
		                     </div>
		                     <div style="float: left; width: 100%; text-align:left; padding-left: 00px; line-height:18px; font-weight: 600; " ><?php echo $currency; ?> <?php echo $order_items[0]['sub_total']; ?> </div>
		                  </div>
		               </div>
		               <div style="clear: both;"></div>
		            </div>
		            <div style="margin-top: 20px; margin-bottom: 40px; " >
		               <div style="float: left;width: 45%; text-align: left;  " >
		                  <div style="width: 100%;">
		                     <div style="float: left; width:100%; text-align: left; font-weight: 600; line-height: 20px; " >
		                        Payment Terms
		                        <br>
		                        <!-- شروط الدفع -->
		                     </div>
		                     <div style="float: left; width: 100%; text-align:left; padding-left: 00px; line-height:18px; " > 
		                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
		                     </div>
		                  </div>
		               </div>
		               <div style="float: right;width: 45%; text-align: left;  " >
		                  <div style="width: 100%;">
		                     <div style="float: left; width:40%; text-align: left; font-weight: 600; line-height: 20px;" >
		                        VAT
		                     </div>
		                     <div style="float: left; width: 60%; text-align:left; padding-left: 00px; line-height:18px; font-weight: 600; " > <?php echo $currency; ?> <?php echo $order_items[0]['tax']; ?> </div>
		                  </div>
		                  <div style="clear:both;"></div>
		                   <div style="width: 100%;">
		                     <div style="float: left; width:40%; text-align: left; font-weight: 600; line-height: 20px;" >
		                        Commission
		                     </div>
		                     <div style="float: left; width: 60%; text-align:left; padding-left: 00px; line-height:18px; font-weight: 600; " > <?php echo $currency; ?> <?php echo $order_items[0]['commision']; ?> </div>
		                  </div>
		                  <div style="clear:both;"></div>
		                  <div style="width: 100%; margin-top: 10px; ">
		                     <div style="float: left; width:40%; text-align: left; font-weight: 600; line-height: 20px;" >
		                        Total Amount:
		                        <br>
		                        <!-- المبلغ الإجمالي -->
		                     </div>
		                     <div style="float: left; width: 60%; text-align:left; padding-left: 00px; line-height:18px; font-weight: 600; font-size: 16px; " ><?php echo $currency; ?> <?php echo $total; ?> </div>
		                  </div>
		               </div>
		               <div style="clear: both;"></div>
		               <?php if(!empty($order))
	    					{ ?>
		               <a href="<?php echo base_url('invoice/product/').$item_id ?>" style="display: inline-block; background: #dadada; margin-top: 30px; text-decoration: none; padding: 12px 18px; font-size: 14px; font-weight: 600; border-radius: 3px; color: #353535; " > Download Invoice </a>
               			<div style="clear: both;"></div>
               		<?php  } ?>
		            </div>
		         </div>
		      </div>
		   </body>
		</html>

		<?php
	    	$html = ob_get_clean();   
	    	if(!empty($order))
	    	{
	        	// ec0ho "<pre>";
	        	print_r($html);
	        	die;
	    	}
	         $file_name = "invoice_".$order_items[0]['item_id'].".pdf";
	         // $file_name = "invoice_1212.pdf";
	        require_once('vendor/autoload.php');
		  	$mpdf = new \Mpdf\Mpdf();
	        $mpdf->WriteHTML($html);
		    $mpdf->Output($file_name, 'D');
		
	}	

	public function get_print_pdf_all($order_items,$order,$item_id)
	{
		
		// echo "<pre>";
		// print_r($order_items);
		// die;
		$footer_content=$this->CI->custom_model->my_where("footer_content","mobile_no,email_id",array('id' => '1'));
		$currency=$order_items[0]['currency'];
		
		$Commission=$order_items[0]['commission']+$order_items[0]['transfer_fees']+$order_items[0]['bank_fees'];
		$address='';		
		if(!empty($order_items[0]['address_1']))
		{
			$address.=$order_items[0]['address_1'].' ';
		}
		if(!empty($order_items[0]['city']))
		{
			$address.=$order_items[0]['city'].' ';
		}
		if(!empty($order_items[0]['state']))
		{
			$address.=$order_items[0]['state'].' ';
		}
		if(!empty($order_items[0]['country']))
		{
			$address.=$order_items[0]['country'].' ';
		}
		if(!empty($order_items[0]['pincode']))
		{
			$address.=$order_items[0]['pincode'].' ';
		}		
		                    
		$pro_row='';     
		$i=1;             
		foreach ($order_items[0]['order_items'] as $oi_key => $oi_val) 
		{
			$pro_row.='<tr class="row_padng" >';
			$pro_row.='<td>'.$i.'</td>';
			$pro_row.='<td>'.$oi_val['trans_ref'].'</td>';
			$pro_row.='<td>'.$oi_val['quantity'].'</td>';
			$pro_row.='<td>'.$oi_val['unit_name'].'</td>';
			$pro_row.='<td>'.$oi_val['product_name'].'</td>';
			$pro_row.='<td>'.$currency.' '.$oi_val['price'].'</td>';
			$pro_row.='</tr>';
			$i++;
		}
		ob_start();		
	 	
	 	?>
	 	<!DOCTYPE html>
		<html>
		   <head>		      
		      <meta http-equiv="content-type" content="text/html; charset=utf-8" />
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
		   </style>
		   <body>
		      <div style="text-align: center; background: #f3f3f3; " >
		         <div style="width: 100%; background: #fff; box-shadow: 0px 0px 4px 1px #cccccc25; display: inline-block; margin: 20px 0px; padding: 0px 15px 10px 15px; border-radius: 8px; border-top: 5px solid #3f006f; border-bottom: 5px solid #3f006f; " >
		            <div style="padding:10px 0px;">
		               <img src="<?php echo base_url(); ?>assets/frontend/images/icon/invoice_logo.png" style="width: 180px; margin-top: 10px; margin-bottom: 30px; " >
		            </div>
		            <div style="float: left;width: 45%; text-align: left;  " >
		               <div style="width: 100%;">
		                  <div style="float: left; width:100%; text-align: left; font-weight: 600; line-height: 20px; font-size: 18px; " >
		                     INVOICE NUMBER /رقم فاتورة
		                     <br>
		                     <!--  رقم الفاتورة -->
		                  </div>
		                  <div style="float: left; width: 100%; text-align:left; padding-left: 00px; line-height:18px; " > <?php echo $order_items[0]['display_order_id'] ?> </div>
		               </div>
		            </div>
		            <div style="float: right;width: 25%; text-align: left;  " >
		               <div style="width: 100%;">
		                  <div style="float: left; width:100%; text-align: left; font-weight: 600; line-height: 20px; font-size: 18px; " >
		                     DATE /تاريخ
		                     <br>
		                     <!-- التاريخ  -->
		                  </div>
		                  <div style="float: left; width: 100%; text-align:left; padding-left: 00px; line-height:18px; " > <?php echo date('M-d-Y' ,strtotime($order_items[0]['order_datetime'])); ?> </div>
		               </div>
		            </div>
		            <div style="clear:both;"></div>
		            <div style="width: 100%;">
		               <div style="width: 100%; font-weight: 600; margin-top: 30px; font-size: 20px; " >  INVOICE/فاتورة   </div>
		               <div style="width: 100%; font-weight: 600; margin-top: 5px;" ><!-- فاتورة   --> </div>
		            </div>
		            <div style="clear:both;"></div>
		            <div style="margin-top: 40px;" >
		               <div style="float: left;width: 45%; text-align: left;  " >
		                  <div style="width: 100%;">
		                     <div style="float: left; width:100%; font-size: 18px; text-align: left; font-weight: 600; " >
		                        BUYER NAME /أسم المشتري
		                        <br>
		                        <!-- أسم المشتري -->
		                     </div>
		                     <div style="float: left; width: 100%; text-align:left; padding-left: 00px; line-height:18px;  font-weight: 400 " > 
		                        <?php echo $order_items[0]['first_name'].' '.$order_items[0]['last_name']; ?>
		                     </div>
		                     <div style="clear:both;"></div>
		                  </div>
		                  <div style="width: 100%; margin-top: 25px; ">
		                     <div style="float: left; width:100%; text-align: left; font-weight: 600; font-size: 18px; " >
		                        ADDRESS /عنوان 
		                        <br>
		                        <!-- عنوان -->
		                     </div>
		                     <div style="float: left; width: 100%; text-align:left; padding-left: 00px; line-height:18px; " > 
		                        <?php echo $address; ?>
		                     </div>
		                     <div style="clear:both;"></div>
		                  </div>
		               </div>
		               <div style="float: right;width: 45%; text-align: left;  " >
		                  <!-- <div style="width: 100%;">
		                     <div style="float: left; width:100%; text-align: left; font-weight: 600; " >
		                        SELLER NAME
		                        <br>
		                        
		                     </div>
		                     <div style="float: left; width: 100%; text-align:left; padding-left: 00px; line-height:18px; " > 
		                        seller_name
		                     </div>
		                     <div style="clear:both;"></div>
		                  </div> -->
		                  <!-- <div style="width: 100%; margin-top: 25px; ">
		                     <div style="float: left; width:100%; text-align: left; font-weight: 600; " >
		                        ADDRESS: 
		                        <br>
		                        
		                     </div>
		                     <div style="float: left; width: 100%; text-align:left; padding-left: 00px; line-height:18px; " > 
		                        seller_address
		                     </div>
		                     <div style="clear:both;"></div>
		                  </div> -->
		               </div>
		            </div>
		            <div style="clear:both;"></div>
		            <div style="width:100%; margin-top: 20px; ">
		               <table style="border: 2px solid #ccc; width: 100%; font-size: 14px; text-align: center; " cellpadding="0" cellspacing="0" >
		                  <tr style="font-weight: 600; background:#ccc;  " >
		                     <td style="padding:6px 00px; width: 100px; " >
		                        Serial Number <br>رقم التسلسلي
		                         
		                        <!-- رقم التسلسلي -->
		                     </td>
		                     <td style="width: 110px;" >
		                        Item Code <br>رمز الصنف
		                         
		                        <!-- رمز المنتج -->
		                     </td>
		                     <td style="width: 90px;" >
		                        Quantity <br>كمية
		                        
		                        <!-- الكمية -->
		                     </td>
		                     <td style="width: 80px;" >
		                        Unit <br>وحدة
		                         
		                        <!-- وحدة القياس -->
		                     </td>
		                     <td style="width: 190px;" >
		                        Item Description  <br>وصف السلعة
		                       
		                        <!-- وصف المنتج -->
		                     </td>
		                     <td style="width: 110px;" >
		                        Currency / Price  <br> السعر / العملة
		                        
		                        <!-- العملة / السعر  -->
		                     </td>
		                  </tr>
		                  <?php echo $pro_row; ?>
		                  
		                  
		               </table>
		            </div>
		            <div style="margin-top: 20px; margin-bottom: 30px; " >
		               <!-- <div style="float: left;width: 45%; text-align: left;  " >
		                  <div style="width: 100%;">
		                     <div style="float: left; width:100%; text-align: left; font-weight: 600; line-height: 20px; " >
		                        Delivery Term
		                        <br>
		                     </div>
		                     <div style="float: left; width: 100%; text-align:left; padding-left: 00px; line-height:18px; " > 
		                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
		                     </div>
		                  </div>
		               </div> -->
		               <div style="float: right;width: 45%; text-align: left;  " >
		                 <div style="width: 100%;">
		                     <div style="float: left; width:40%; text-align: left; font-weight: 600; line-height: 20px;" >
		                        Sub Total /المجموع الفرعي
		                     </div>
		                     <div style="float: left; width: 60%; text-align:left; padding-left: 00px; line-height:18px; font-weight: 600; " > <?php echo $currency; ?> <?php echo $order_items[0]['sub_total']; ?> </div>
		                  </div>
		               </div>
		               <div style="clear: both;"></div>
		            </div>
		            <div style="margin-top: 20px; margin-bottom: 40px; " >
		               <div style="float: left;width: 45%; text-align: left;  " >
		                  <div style="width: 100%;">
		                     <div style="float: left; width:100%; text-align: left; font-weight: 600; line-height: 20px; " >
		                        Payment Mechanism /طريقة الدفع
		                        <br>
		                        <!-- شروط الدفع -->
		                     </div>
		                     <div style="float: left; width: 100%; text-align:left; padding-left: 00px; line-height:18px; " > 
		                       <?php if($order_items[0]['payment_mode']=='cash-on-del'){
		                       	echo "Virtual Account Transfer";
		                       }else{
		                       	echo "Credit Card ";
		                       } ?>
		                     </div>
		                  </div>
		               </div>
		               <div style="float: right;width: 45%; text-align: left;  " >
		                  <div style="width: 100%;">
		                     <div style="float: left; width:40%; text-align: left; font-weight: 600; line-height: 20px;" >
		                         Fees /رسوم
		                     </div>
		                     <div style="float: left; width: 60%; text-align:left; padding-left: 00px; line-height:18px; font-weight: 600; " ><?php echo $currency; ?> <?php echo $Commission; ?>  </div>
		                  </div>
		                  <div style="clear:both;"></div>
		                   <div style="width: 100%;">
		                     <div style="float: left; width:40%; text-align: left; font-weight: 600; line-height: 20px;" >
		                        VAT /ضريبة القيمة المضافة
		                     </div>
		                     <div style="float: left; width: 60%; text-align:left; padding-left: 00px; line-height:18px; font-weight: 600; " > <?php echo $currency; ?> <?php echo $order_items[0]['tax']; ?> </div>
		                  </div>
		                  <div style="clear:both;"></div>
		                  <div style="width: 100%; margin-top: 10px; ">
		                     <div style="float: left; width:40%; text-align: left; font-weight: 600; line-height: 20px;" >
		                        Total Amount /المبلغ الإجمالي
		                        <br>
		                        <!-- المبلغ الإجمالي -->
		                     </div>
		                     <div style="float: left; width: 60%; text-align:left; padding-left: 00px; line-height:18px; font-weight: 600; font-size: 16px; " ><?php echo $currency; ?> <?php echo $order_items[0]['net_total']; ?> </div>
		                  </div>
		               </div>
		               <div style="clear: both;"></div>
		               <?php if(!empty($order))
	    					{ ?>
		               <a href="<?php echo base_url('invoice/order/').$item_id ?>" style="display: inline-block; background: #dadada; margin-top: 30px; text-decoration: none; padding: 12px 18px; font-size: 14px; font-weight: 600; border-radius: 3px; color: #353535; " > Download Invoice </a>
               			<div style="clear: both;"></div>
               		<?php  } ?>
               		<div style="float: left;width: 45%; text-align: left;  " >
	                  <div style="width: 100%;">
	                     <div style="float: left; width:100%; text-align: left; font-weight: 600; line-height: 20px; " >
	                        <a style="text-decoration: none; color:black" href="tel:<?php echo @$footer_content[0]['mobile_no']; ?>"><?php echo @$footer_content[0]['mobile_no']; ?></a> -  www.port10.sa –  <a style="text-decoration: none; color:black" href="mailto:<?php echo @$footer_content[0]['email_id']; ?>"><?php echo @$footer_content[0]['email_id']; ?></a>
	                     </div>		                    
	                  </div>
		            </div>
               		
		            </div>
		         </div>
		      </div>
		   </body>
		</html>

		<?php
	    	$html = ob_get_clean();   
	    	if(!empty($order))
	    	{
	        	// echo "<pre>";
	        	print_r($html);
	        	die;
	    	}
	         $file_name = "invoice_".$order_items[0]['item_id'].".pdf";
	         // $file_name = "invoice_1212.pdf";
	        require_once('vendor/autoload.php');
		  	$mpdf = new \Mpdf\Mpdf();
	        $mpdf->WriteHTML($html);
		    $mpdf->Output($file_name, 'D');
		
	}

	public function get_print_pdf_all_new($order_items,$order,$item_id)
	{
		
		// echo "<pre>";
		// print_r($order_items);
		// die;
		$footer_content=$this->CI->custom_model->my_where("footer_content","mobile_no,email_id",array('id' => '1'));
		$currency=$order_items[0]['currency'];
		
		$Commission=$order_items[0]['commission']+$order_items[0]['transfer_fees']+$order_items[0]['bank_fees'];
		$address='';		
		if(!empty($order_items[0]['address_1']))
		{
			$address.=$order_items[0]['address_1'].' ';
		}
		if(!empty($order_items[0]['city']))
		{
			$address.=$order_items[0]['city'].' ';
		}
		if(!empty($order_items[0]['state']))
		{
			$address.=$order_items[0]['state'].' ';
		}
		if(!empty($order_items[0]['country']))
		{
			$address.=$order_items[0]['country'].' ';
		}
		if(!empty($order_items[0]['pincode']))
		{
			$address.=$order_items[0]['pincode'].' ';
		}		
		                    
		$pro_row='';     
		$i=1;             
		foreach ($order_items[0]['order_items'] as $oi_key => $oi_val) 
		{
			$pro_row.='<tr class="row_padng" >';
			$pro_row.='<td>'.$i.'</td>';
			$pro_row.='<td>'.$oi_val['trans_ref'].'</td>';
			$pro_row.='<td>'.$oi_val['quantity'].'</td>';
			$pro_row.='<td>'.$oi_val['unit_name'].'</td>';
			$pro_row.='<td>'.$oi_val['product_name'].'</td>';
			$pro_row.='<td>'.$currency.' '.$oi_val['price'].'</td>';
			$pro_row.='</tr>';
			$i++;
		}
		ob_start();		
	 	
	 	?>
	 	<!DOCTYPE html>
		<html>
		   <head>		      
		      <meta http-equiv="content-type" content="text/html; charset=utf-8" />
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
		   </style>
		   <body>
		      <div style="text-align: center; background: #f3f3f3; " >
		         <div style="width: 100%; background: #fff; box-shadow: 0px 0px 4px 1px #cccccc25; display: inline-block; margin: 20px 0px; padding: 0px 15px 10px 15px; border-radius: 8px; border-top: 5px solid #3f006f; border-bottom: 5px solid #3f006f; " >
		            <div style="padding:10px 0px;">
		               <img src="<?php echo base_url(); ?>assets/frontend/images/icon/invoice_logo.png" style="width: 180px; margin-top: 10px; margin-bottom: 30px; " >
		            </div>
		            
		            <div style="float: right;width: 25%; text-align: left;  " >
		               <div style="width: 100%;">
		                  <div style="float: left; width:100%; text-align: left; font-weight: 600; line-height: 20px; font-size: 18px; " >
		                     Tax Invoice/ فاتورة ضريبية
		                     <br>
		                     <!-- التاريخ  -->
		                  </div>		                  
		               </div>
		            </div>
		            <div style="clear:both;"></div>
		            <div style="width: 100%;">
		               <div style="width: 100%; font-weight: 600; margin-top: 30px; font-size: 20px; " >  INVOICE/فاتورة   </div>
		               <div style="width: 100%; font-weight: 600; margin-top: 5px;" ><!-- فاتورة   --> </div>
		            </div>
		            <div style="clear:both;"></div>
		            
		            <div style="clear:both;"></div>
		            
		            <div style="width:50%; margin-top: 20px; float: right; ">
		               <div style="float: left; width:100%; text-align: left; font-weight: 600; font-size: 18px; " >
		                        ADDRESS /عنوان 
		                        <br>
		                        <!-- عنوان -->
		                     </div>
                     	<div style="float: left; width: 100%; text-align:left; padding-left: 00px; line-height:18px; " > 
                        	<?php echo $address; ?>
                     	</div>	
                     	<div style="clear:both;"></div>
		            </div>
		            <div style="width:50%; margin-top: 20px; ">
		               <table style="border: 2px solid #ccc; width: 100%; font-size: 14px; text-align: center; " cellpadding="0" cellspacing="0" >
		                  
		                   <tr class="row_padng" >
		                     <td>
		                        Invoice Number /رقم الفاتورة
		                         
		                     </td>
		                     <td>                      
		                         110
		                     </td>
		                  </tr>

		                  <tr class="row_padng" >
		                     <td>
		                        InvoiceOrder Number /رقم الطلب
		                         
		                     </td>
		                     <td>                      
		                        111 
		                     </td>
		                  </tr>

		                  <tr class="row_padng" >
		                     <td  >
		                        Invoice Issue Date /تاريخ اصدار الفاتورة
		                         
		                     </td>
		                     <td>                      
		                         07-01-2022
		                     </td>
		                  </tr>

		                  <tr class="row_padng" >
		                     <td  >
		                        Supply Date /تاريخ التوريد
		                         
		                     </td>
		                     <td>                      
		                         09-01-2022
		                     </td>
		                  </tr>

		                  
		               </table>
		            </div>
		            <div style="clear:both;"></div>

		            <div style="width:50%; margin-top: 20px; float: right; ">
		               <table style="border: 2px solid #ccc; width: 100%; font-size: 14px; text-align: center; " cellpadding="0" cellspacing="0" >
		                 <tr class="row_padng" >
		                     <td  >
		                        Buyer/ االعميل
		                         
		                     </td>
		                     <td>	                       
		                         
		                     </td>
		                  </tr>

		                   <tr class="row_padng" >
		                     <td  >
		                        Name:/ الإسم: 
		                         
		                     </td>
		                     <td>
		                        Siddiqui
		                         
		                     </td>
		                  </tr>
		                   <tr class="row_padng" >
		                     <td  >
		                        Building No:/ رقم المبنى:
		                         
		                     </td>
		                     <td>
		                        167
		                         
		                     </td>
		                  </tr>
		                  <tr class="row_padng" >
		                     <td  >
		                        Street Name:/ اسم الشارع: 
		                         
		                     </td>
		                     <td>
		                       Iqbal nagar
		                         
		                     </td>
		                  </tr>
		                  <tr class="row_padng" >
		                     <td >
		                        District:/ الحي:
		                     </td>
		                     <td>		                       
		                         Parbhani	
		                     </td>
		                  </tr>
		                  <tr class="row_padng" >
		                     <td >
		                        City: /المدينة:
		                     </td>
		                     <td>		                       
		                         Parbhani
		                     </td>
		                  </tr>

		                  <tr class="row_padng" >
		                     <td >
		                        Country: /البلد:
		                     </td>
		                     <td>		                       
		                        India 
		                     </td>
		                  </tr>

		                  <tr class="row_padng" >
		                     <td >
		                        Postal Code:/ الرمز البريدي:
		                     </td>
		                     <td>		                       
		                         431401
		                     </td>
		                  </tr>

		                  <tr class="row_padng" >
		                     <td >
		                        Additional No: /الرقم الإضافي للعنوان:
		                     </td>
		                     <td>		                       
		                         
		                     </td>
		                  </tr>

		                  <tr class="row_padng" >
		                     <td >
		                        VAT No:رقم تسجيل ضريبة القيمة المضافة:
		                     </td>
		                     <td>		                       
		                         12313123
		                     </td>
		                  </tr>

		                  <tr class="row_padng" >
		                     <td >
		                       Other Additional ID: /معرف آخر:
		                     </td>
		                     <td>		                       
		                         
		                     </td>
		                  </tr> 		                  
		                  
		               </table>
		            </div>
		            <div style="width:50%; margin-top: 20px; ">
		                <table style="border: 2px solid #ccc; width: 100%; font-size: 14px; text-align: center; " cellpadding="0" cellspacing="0" >
		                  
		                   <tr class="row_padng" >
		                     <td  >
		                        Seller/ المورد
		                         
		                     </td>
		                     <td>
		                       
		                         
		                     </td>
		                  </tr>

		                   <tr class="row_padng" >
		                     <td  >
		                        Name:/ الإسم: 
		                         
		                     </td>
		                     <td>
		                        Irfan shaik
		                         
		                     </td>
		                  </tr>
		                   <tr class="row_padng" >
		                     <td  >
		                        Building No:/ رقم المبنى:
		                         
		                     </td>
		                     <td>
		                        189
		                         
		                     </td>
		                  </tr>
		                  <tr class="row_padng" >
		                     <td  >
		                        Street Name:/ اسم الشارع: 
		                         
		                     </td>
		                     <td>
		                       Mumtaz nagar
		                         
		                     </td>
		                  </tr>
		                  <tr class="row_padng" >
		                     <td >
		                        District:/ الحي:
		                     </td>
		                     <td>		                       
		                         Pune
		                     </td>
		                  </tr>
		                  <tr class="row_padng" >
		                     <td >
		                        City:
		                     </td>
		                     <td>		                       
		                        Pune
		                     </td>
		                  </tr>

		                  <tr class="row_padng" >
		                     <td >
		                        Country:
		                     </td>
		                     <td>		                       
		                         Indian
		                     </td>
		                  </tr>

		                  <tr class="row_padng" >
		                     <td >
		                        Postal Code:/ الرمز البريدي:
		                     </td>
		                     <td>		                       
		                         411048
		                     </td>
		                  </tr>

		                  <tr class="row_padng" >
		                     <td >
		                        Additional No: /الرقم الإضافي للعنوان:
		                     </td>
		                     <td>		                       
		                         
		                     </td>
		                  </tr>

		                  <tr class="row_padng" >
		                     <td >
		                        VAT No:رقم تسجيل ضريبة القيمة المضافة:
		                     </td>
		                     <td>		                       
		                         
		                     </td>
		                  </tr>

		                  <tr class="row_padng" >
		                     <td >
		                       Other Additional ID: /معرف آخر:
		                     </td>
		                     <td>		                       
		                         
		                     </td>
		                  </tr>
		                 
		                  <?php //echo $pro_row; ?>            
		                  
		               </table>
		            </div>
		            <div style="clear:both;"></div>

		            <div style="width:100%; margin-top: 20px; ">
		               <table style="border: 2px solid #ccc; width: 100%; font-size: 14px; text-align: center; " cellpadding="0" cellspacing="0" >
		                  <tr style="font-weight: 600; background:#ccc;  " >
		                     <td style="padding:6px 00px; width: 100px; " >
		                        Nature of Goods/Services 
		                         
		                        <!-- رقم التسلسلي -->
		                     </td>
		                     <td style="width: 110px;" >
		                        Unit Price
		                         
		                        <!-- رمز المنتج -->
		                     </td>
		                     <td style="width: 90px;" >
		                        Quantity
		                        
		                        <!-- الكمية -->
		                     </td>
		                     <td style="width: 190px;" >
		                        Taxable Amount
		                       
		                        <!-- وصف المنتج -->
		                     </td>
		                     <td style="width: 110px;" >
		                        Discount		
		                     </td>
		                     <td style="width: 110px;" >
		                        Tax Rate		
		                     </td>
		                     <td style="width: 110px;" >
		                        Tax Amount		
		                     </td>
		                     <td style="width: 110px;" >
		                        Item Subtotal (Including VAT)		
		                     </td>
		                  </tr>

		                  <tr class="row_padng" >
		                  	<td>Item A</td>
		                  	<td>50</td>
		                  	<td>1</td>
		                  	<td>50</td>
		                  	<td>00</td>
		                  	<td>5%</td>
		                  	<td>5</td>
		                  	<td>155</td>
		                  </tr>
		                  <?php //echo $pro_row; ?>
		                  
		                  
		               </table>
		            </div>
		            <div style="clear:both;"></div>



		            <div style="margin-top: 20px; margin-bottom: 30px; " >
		               <!-- <div style="float: left;width: 45%; text-align: left;  " >
		                  <div style="width: 100%;">
		                     <div style="float: left; width:100%; text-align: left; font-weight: 600; line-height: 20px; " >
		                        Delivery Term
		                        <br>
		                     </div>
		                     <div style="float: left; width: 100%; text-align:left; padding-left: 00px; line-height:18px; " > 
		                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
		                     </div>
		                  </div>
		               </div> -->
		               <div style="float: right;width: 45%; text-align: left;  " >
		                 <div style="width: 100%;">
		                     <div style="float: left; width:40%; text-align: left; font-weight: 600; line-height: 20px;" >
		                        Total Amounts: /إجمالي المبلغ:
		                     </div>
		                     <div style="float: left; width: 60%; text-align:left; padding-left: 00px; line-height:18px; font-weight: 600; " > <?php echo $currency; ?> <?php echo $order_items[0]['sub_total']; ?> </div>
		                  </div>
		               </div>
		               <div style="clear: both;"></div>
		            </div>
		            <div style="margin-top: 20px; margin-bottom: 40px; " >
		               
		               <div style="float: right;width: 45%; text-align: left;  " >
		                  <div style="width: 100%;">
		                     <div style="float: left; width:40%; text-align: left; font-weight: 600; line-height: 20px;" >
		                         Total (Excluding VAT) /الإجمالي (غير شاملة ضريبة القيمة المضافة)
		                     </div>
		                     <div style="float: left; width: 60%; text-align:left; padding-left: 00px; line-height:18px; font-weight: 600; " ><?php echo $currency; ?> <?php echo $Commission; ?>  </div>
		                  </div>
		                  <div style="clear:both;"></div>
		                   <div style="width: 100%;">
		                     <div style="float: left; width:40%; text-align: left; font-weight: 600; line-height: 20px;" >
		                        Discount /  خصومات
		                     </div>
		                     <div style="float: left; width: 60%; text-align:left; padding-left: 00px; line-height:18px; font-weight: 600; " > <?php echo $currency; ?> <?php echo $order_items[0]['tax']; ?> </div>
		                  </div>
		                  <div style="clear:both;"></div>
		                  <div style="width: 100%; margin-top: 10px; ">
		                     <div style="float: left; width:40%; text-align: left; font-weight: 600; line-height: 20px;" >
		                        Total Taxable Amount (Excluding VAT) / الإجمالي الخاضع الضريبة (غير شاملة ضريبة القيمة المضافة)
		                        <br>
		                        <!-- المبلغ الإجمالي -->
		                     </div>
		                     <div style="float: left; width: 60%; text-align:left; padding-left: 00px; line-height:18px; font-weight: 600; font-size: 16px; " ><?php echo $currency; ?> <?php echo $order_items[0]['net_total']; ?> </div>
		                  </div>
		                  <div style="clear:both;"></div>
		                  <div style="width: 100%; margin-top: 10px; ">
		                     <div style="float: left; width:40%; text-align: left; font-weight: 600; line-height: 20px;" >
		                        Total VAT / مجموع ضريبة القيمة المضافة
		                        <br>
		                        <!-- المبلغ الإجمالي -->
		                     </div>
		                     <div style="float: left; width: 60%; text-align:left; padding-left: 00px; line-height:18px; font-weight: 600; font-size: 16px; " ><?php echo $currency; ?> <?php echo $order_items[0]['net_total']; ?> </div>
		                  </div>
		                  <div style="clear:both;"></div>
		                   <div style="width: 100%; margin-top: 10px; ">
		                     <div style="float: left; width:40%; text-align: left; font-weight: 600; line-height: 20px;" >
		                        Total Amount Due / إجمالي المبلغ المستحق
		                        <br>
		                        <!-- المبلغ الإجمالي -->
		                     </div>
		                     <div style="float: left; width: 60%; text-align:left; padding-left: 00px; line-height:18px; font-weight: 600; font-size: 16px; " ><?php echo $currency; ?> <?php echo $order_items[0]['net_total']; ?> </div>
		                  </div>
		                  <div style="clear:both;"></div>
		               </div>
		               <div style="clear: both;"></div>
		               <?php if(!empty($order))
	    					{ ?>
		               <a href="<?php echo base_url('invoice/order_new/').$item_id ?>" style="display: inline-block; background: #dadada; margin-top: 30px; text-decoration: none; padding: 12px 18px; font-size: 14px; font-weight: 600; border-radius: 3px; color: #353535; " > Download Invoice </a>
               			<div style="clear: both;"></div>
               		<?php  } ?>
               		<div style="float: left;width: 45%; text-align: left;  " >
	                  <div style="width: 100%;">
	                     <div style="float: left; width:100%; text-align: left; font-weight: 600; line-height: 20px; " >
	                        <a style="text-decoration: none; color:black" href="tel:<?php echo @$footer_content[0]['mobile_no']; ?>"><?php echo @$footer_content[0]['mobile_no']; ?></a> -  www.port10.sa –  <a style="text-decoration: none; color:black" href="mailto:<?php echo @$footer_content[0]['email_id']; ?>"><?php echo @$footer_content[0]['email_id']; ?></a>
	                     </div>		                    
	                  </div>
		            </div>
               		
		            </div>
		         </div>
		      </div>
		   </body>
		</html>

		<?php
	    	$html = ob_get_clean();   
	    	if(!empty($order))
	    	{
	        	// echo "<pre>";
	        	print_r($html);
	        	die;
	    	}
	         $file_name = "invoice_".$order_items[0]['item_id'].".pdf";
	         // $file_name = "invoice_1212.pdf";
	        require_once('vendor/autoload.php');
		  	$mpdf = new \Mpdf\Mpdf();
	        $mpdf->WriteHTML($html);
		    $mpdf->Output($file_name, 'D');
		
	}

	public function check_pdf()
	{ 
		// ob_start();
		?>
	<?php 
		// $html = ob_get_clean();
		$html = $this->CI->load->view('new_invoice',$data=array(), true); 
		// print_r($html);
	 //    die;
	      $file_name = "invoice_.pdf";
	         // $file_name = "invoice_1212.pdf";
	        require_once('vendor/autoload.php');
		  	// $mpdf = new \Mpdf\Mpdf();
	    //     $mpdf->WriteHTML($html);
		   //  $mpdf->Output($file_name, 'D');
		    // Create an instance of the class:
            $mpdf = new \Mpdf\Mpdf([
                    'mode' => 'utf-8',
            'format' => 'A4-L',
                    'orientation' => 'L'
            ]);
            $mpdf->WriteHTML($html);
            // $mpdf->Output(date('M').'receipt.pdf', \Mpdf\Output\Destination::INLINE);
            $mpdf->Output(date('M').'receipt.pdf','d');	

		}	

}

			

