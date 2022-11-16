<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		@page 
		{
		size:  auto;   /* auto is the initial value */
		margin:0mm;  /* this affects the margin in the printer settings */
		}
		@media print {
		title, footer{
		display: none;
		}
		}

		table {
		width: 100%;
		}
		td, th {
		padding: 5px;
		border: 1px solid #cdcdcd;
		}

		td {
		text-transform: capitalize;
		}

	</style>
</head>
<body>
	<?php
		$full_address=$data[0]['address_1'].' , '.$data[0]['address_2'].' , '.$data[0]['country'].' , '.$data[0]['state'].' , '.$data[0]['city'].' , '.$data[0]['pincode'];
		$currency = $data[0]['currency'];		
	?>
	<h3 style="
    text-align: center;">Order invoice</h3>
	<table>
		<tr>
			<td colspan="3"><span>Name: </span><span><?php echo $data[0]['first_name']; ?></span></td>
			<td><span>Invoice id: </span><span> <?php echo $data[0]['order_master_id']; ?></span></td>
		</tr>

		<tr>
			<td>
				Address
			</td>
			<td colspan="3">
				<?php echo $full_address; ?>
			</td>
		</tr>
		<tr>
			<td>
				Mobile no
			</td>
			<td colspan="3">
				<?php echo $data[0]['mobile_no']; ?>
			</td>
		</tr>
		<tr>
			<td>
				Email
			</td>
			<td colspan="3">
				<?php echo $data[0]['email']; ?>
			</td>
		</tr>

		<tr>
			<td>Product Name</td>
			<!-- <td>Customize Product</td> -->
			<td>Qty</td>
			<td colspan="2">Sub Total</td>
		</tr>
		<!-- no of time -->
		<?php foreach ($data[0]['order_items'] as $item_key => $item_val) 
		{ 
			$product_cust_data = '';
			if (!empty($item_val['items_extra_data']))
			{
				foreach ($item_val['items_extra_data'] as $pkey => $pvalue)
				{
					if ($pvalue['price'] == '0')
					{
						$c_price = 'Free';
					}
					else
					{
						$c_price = $currency.' '.$pvalue['price'];
					}
					$product_cust_data.='<p>'.$pvalue['name'].' :- '.$c_price.'</p>';
				}
			}	
			?>
			
		<tr>
			<td>
				<?php if(!empty($item_val['attribute'])) { ?>
				<?php echo $item_key + 1 ; ?>. <?php echo $item_val['product_name'].' ('.$item_val['attribute'].')'; ?>
				<?php }else{ ?>
				<?php echo $item_key + 1 ; ?>. <?php echo $item_val['product_name']; ?>	
				<?php }  ?>	
				</td>
			<!-- <td><?php //echo $product_cust_data; ?></td> -->
			<td><?php echo $item_val['quantity']; ?></td>
			<td colspan="2"><?php echo $currency.' '.$item_val['sub_total']; ?></td>
		</tr>
		<?php } ?>

		<tr>
			<td colspan="4">Billing Details </td>
		</tr>

		<tr>
			<td colspan="2">Order id</td>
			<td colspan="2"><?php echo $data[0]['display_order_id']; ?></td>
		</tr>
		<?php if($data[0]['payment_mode']=='online'){ ?>
		<tr>
			<td colspan="2">Track id</td>
			<td colspan="2"><?php echo $data[0]['track_id']; ?></td>
		</tr>
		<?php } ?>	
		<tr>
			<td colspan="2">Payment Mode</td>
			<td colspan="2"><?php echo $data[0]['payment_mode']; ?></td>
		</tr>

		<tr>
			<td colspan="2">payment Status</td>
			<td colspan="2"><?php echo $data[0]['payment_status']; ?></td>
		</tr>

		<tr>
			<td colspan="2">Total Amount</td>
			<td colspan="2"><?php echo $currency.' '.$data[0]['sub_total']; ?></td>
		</tr>

		<tr>
			<td colspan="4">Order Invoice</td>
		</tr>

		<tr>
			<td colspan="2">Fees</td>
			<td colspan="2"><?php echo $currency.' '; echo $data[0]['commission']+$data[0]['transfer_fees']+$data[0]['bank_fees']; ?></td>
		</tr>

		<tr>
			<td colspan="2">VAT</td>
			<td colspan="2"><?php echo $currency.' '.$data[0]['tax']; ?></td>
		</tr> 
		 <?php
        	if(!empty($data[0]['coupon_code'])){ ?>
          <tr>
            <td colspan="2">Coupon Code</td>
            <td colspan="2"><?php echo $data[0]['coupon_code']; ?></td>
          </tr>
          <tr>
            <td colspan="2">Coupon Price</td>
            <td colspan="2"><?php echo $currency; echo " "; echo $data[0]['coupon_price']; ?></td>
          </tr>
        <?php  } ?>
		<tr>
			<td colspan="2">Grand total</td>
			<?php $total=$data[0]['net_total']-$data[0]['coupon_price']; ?>
			<td colspan="2"><?php echo $currency.' '.$total; ?></td>
		</tr>
	</table>
</body>
</html>

<script type="text/javascript">
   $(document).ready(function(){
      window.print();
   });
</script>