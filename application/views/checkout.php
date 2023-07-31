<script type="text/javascript">
   var g_is_calculate_rate=<?php echo $is_calculate_rate; ?>;
   var g_flow_type="<?php echo $flow_type; ?>";
   var g_in_id=null;
</script>
<style type="text/css">
   .home_active{
   font-weight: 600 !important;
   color: #c09550 !important;
   }
   .contnr_main_headr.hedr_fixed{
   position: static;
   box-shadow: 0px 0px 0px #fff;
   }
   .required {
    color: red !important;
    padding:2px
  }
   <?php  $disabled='disabled';

   if($is_calculate_rate == 0){ ?>
      .shipping_rate_li{
         display: none;
      }
   <?php $disabled='';  } ?>
</style>
<?php
  $first_name = $last_name = $mobile_no = $email = $country = $city = $state = $pincode = $address_1 = $address_2 =$google_address=$lat=$lng='';
  if(!empty($user_last_add))
  {
       $first_name=$user_last_add[0]['first_name'];
       $last_name=$user_last_add[0]['last_name'];
       
       $mobile_no=$user_last_add[0]['mobile_no'];
       $email=$user_last_add[0]['email'];
       $address_1=$user_last_add[0]['address_1'];
       $google_address=$user_last_add[0]['google_address'];
       $lat=$user_last_add[0]['lat'];
       $lng=$user_last_add[0]['lng'];
       $country=$user_last_add[0]['country'];
       $state=$user_last_add[0]['state'];
       $city=$user_last_add[0]['city'];
       $pincode=$user_last_add[0]['pincode'];            
  }else if(isset($admin_users) && !empty($admin_users) )
  {
    $full_name=explode(' ',$admin_users[0]['first_name']);
      if(count($full_name)>=2)
      {
        $first_name=$full_name[0];
        $last_name=$full_name[1];
      }else{
        $first_name=$admin_users[0]['first_name'];           
      }
     $mobile_no=$admin_users[0]['phone'];
     $email=$admin_users[0]['email']; 
     $city=$admin_users[0]['city']; 
     $state=$admin_users[0]['state']; 
     $pincode=$admin_users[0]['postal_code']; 
     $country=$admin_users[0]['country']; 
     $country=$admin_users[0]['country']; 
     $address_1=$admin_users[0]['building_no'].' '.$admin_users[0]['street_name']; 
  }
?>        

<div style="width: 80%;padding: 10%;border: 3px solid black;display:none"  id="map2"></div>
<!-- breadcrumb End -->
<!--section start-->
<!-- section start -->
<section class="section-b-space">
  <div class="page-title">
    <h2><?php echo lang('CHECKOUT'); ?></h2>
  </div>
   <div class="container container_detl_wdth container_detl_wdth_checkOut">
      <div class="checkout-page">
         <div class="checkout-form">
            <form id="form_place_order" action="<?php echo base_url($language.'/home/place_order') ?>" method="POST">
               <div class="row">
                <?php if(!empty($data)){  ?>
                  <div class="col-lg-6 col-sm-12 col-xs-12">
                     <div class="checkout-title">                    
                        <span class="ck_pay_step"><?php echo lang('Payment_Method'); ?></span>
                        <span><?php echo lang('CHECKOUT'); ?></span>
                        <div class="clear"></div>
                        <hr style="width: 53%; margin-left: 20%;" size="3", color=black> 
                        <span class="ch_pay_one"> <i class="fa fa-circle" aria-hidden="true"></i></span>
                        <span class="ch_pay_two"><i class="fa fa-circle" aria-hidden="true"></i></span>

                        <h3><?php echo lang('Shipping_Billing_Address'); ?></h3>
                     </div>
                     <div class="row check-out">
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                           <div class="field-label"><?php echo lang('First_Name'); ?><span class="required">*</span></div>
                           <input class="space" type="text" id="ck_first_name" name="first_name" value="<?php echo $first_name; ?>" placeholder="<?php echo lang('Enter_Your_First_Name'); ?>">
                           <input type="hidden" id="payment_mode" name="payment_mode" value="<?php echo $payment_option; ?>">
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                           <div class="field-label"><?php echo lang('Last_Name'); ?><span class="required">*</span></div>
                           <input type="text" id="ck_last_name" name="last_name" value="<?php echo $last_name; ?>" placeholder="<?php echo lang('Enter_Your_Last_Name'); ?>">
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                           <div class="field-label"><?php echo lang('Phone'); ?><span class="required">*</span></div>
                           <input maxlength="14" type="text" id="ck_phone" name="mobile_no" value="<?php echo $mobile_no; ?>" placeholder="<?php echo lang('Please_Enter_Phone'); ?>">
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                           <div class="field-label"><?php echo lang('Email'); ?><span class="required">*</span></div>
                           <input type="text" id="ck_email" name="email" value="<?php echo $email; ?>" placeholder="<?php echo lang('Please_enter_your_email'); ?>">
                        </div>
                        <div class="form-group col-md-12 col-sm-6 col-xs-12">
                           <div class="field-label"><?php echo lang('Address'); ?><span class="required">*</span></div>
                           <input type="text" id="ck_address_1" name="address_1" value="<?php echo $address_1; ?>" placeholder="<?php echo lang('Enter_Your_Address'); ?>">
                        </div>
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                           <div class="field-label"><?php echo lang('Country'); ?><span class="required">*</span></div>
                           <input type="text" id="ck_country" name="country" value="<?php echo $country; ?>" placeholder="Enter Country Name" readonly>
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                           <div class="field-label"><?php echo lang('Town_City'); ?><span class="required">*</span></div>
                           <input type="text" id="ck_city" name="city" value="<?php echo $city; ?>" placeholder="<?php echo lang('Enter_Town_City_Name'); ?>">
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                           <div class="field-label"><?php echo lang('State'); ?><span class="required">*</span></div>
                           <input type="text" id="ck_state" name="state" value="<?php echo $state; ?>" placeholder="<?php echo lang('Enter_State_Name'); ?>">
                        </div>
                        <div class="form-group col-md-12 col-sm-6 col-xs-12">
                           <div class="field-label"><?php echo lang('Postal_Code'); ?><span class="required">*</span></div>
                           <input type="text" id="ck_pincode" name="pincode" value="<?php echo $pincode; ?>" placeholder="<?php echo lang('Enter_Postal_Code'); ?>">
                        </div>
                         <div class="form-group col-md-12 col-sm-6 col-xs-12">
                           <div class="field-label"><?php echo lang('Googe_address'); ?> <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="<?php echo lang('Googe_title'); ?>"></i><span class="required">*</span></div>
                           <input type="text" id="searchInput" name="google_address" value="<?php echo $google_address; ?>" placeholder="<?php echo lang('Googe_address'); ?>">
                        </div> 
                        <div style="width: 80%;padding: 10%;border: 3px solid black;display:none"  id="map"></div>
                        <input type="hidden" name="lat" id="lat" value="<?php echo $lat; ?>">
                        <input type="hidden" name="lng" id="lng" value="<?php echo $lng; ?>">                     
                     </div>
                  </div>

                  <div class="col-lg-6 col-sm-12 col-xs-12">
                     <div class="checkout-details">
                        <div class="order-box chck_bx">
                          
                           <div class="title-box">                             
                              <div><?php echo lang('Product'); ?> <span><?php echo lang('total'); ?></span></div>
                           </div>
                           <ul class="qty">
                             <?php
                             $grand_total=$all_prodcut_total=$total_commission =0;                               
                             foreach ($data as $d_key => $dvalue) {
                                $pid=$dvalue['p']['id'];
                                $qty=$dvalue['c']['qty'];
                                $price=$dvalue['p']['sale_price'];
                                $pro_total=$price*$qty;
                                $all_prodcut_total=$all_prodcut_total+$pro_total;

                                $commission=$tax_table[0]['commission'];
                                 $single_commission=($commission*$pro_total)/100;
                                 if($single_commission>$tax_table[0]['cap_rate'])
                                 {
                                    $single_commission=$tax_table[0]['cap_rate'];
                                 }
                                 $total_commission=$single_commission+$total_commission;    
                               }
                                 // $commission=$tax_table[0]['commission'];                    
                                 // $commission=($commission*$all_prodcut_total)/100;
                                if($payment_option=='cash-on-del')
                                {
                                  if($currency=='USD')
                                  {
                                    $bank_fees=$tax_table[0]['bank_fees_cod']/$tax_table[0]['sar_rate'];
                                  }else{
                                    $bank_fees=$tax_table[0]['bank_fees_cod'];
                                  }
                                }else{
                                  $bank_fees=$tax_table[0]['bank_fees_online'];
                                  $bank_fees=($bank_fees*$all_prodcut_total)/100;
                                }
                                if($currency=='USD')
                                {
                                  $transfer_fees=$tax_table[0]['transfer_fees']/$tax_table[0]['sar_rate'];
                                }else{
                                  $transfer_fees=$tax_table[0]['transfer_fees'];
                                }
                                $all_fees=$total_commission+$bank_fees+$transfer_fees;
                                $product_fees_without_vat=$all_prodcut_total+$all_fees;
                                $vat=$tax_table[0]['vat'];
                                $vat_calulated=($vat*$product_fees_without_vat)/100;
                                $grand_total=$product_fees_without_vat+$vat_calulated;
                               ?>     
                              <?php foreach ($data as $d_key => $dvalue) { ?>     
                              <li><img class="ck_img" src="<?php echo base_url('assets/admin/products/').$dvalue['p']['product_image'] ?>" > <label class="ck_test ch_pro"><?php echo $dvalue['p']['product_name'] ?></label> <p class="ck_test ck_pri_qty" ><?php echo $currency_symbol; echo " ";  echo $dvalue['p']['sale_price']; echo ' <i class="fa fa-times" aria-hidden="true"></i> '; echo $dvalue['c']['qty'] ?></p> <span><?php echo $currency_symbol ?> <?php echo number_format($dvalue['p']['sale_price']*$dvalue['c']['qty'] ); ?> </span></li>
                              <?php } ?>
                             

                              <li><label class="ck_test ch_fee"><?php echo lang('fees'); ?></label> <span><?php echo $currency_symbol ?> <?php echo number_format($all_fees,2); ?> </span></li>
                           </ul>
                           <ul class="sub-total">
                              <li><?php echo lang('Total_before_VAT'); ?> <span class="count"><?php echo $currency_symbol ?> <?php echo number_format($product_fees_without_vat,2); ?> </span></li>
                              <li><?php echo lang('Estimated_VAT_to_be_collected'); ?> <span class="count"><?php echo $currency_symbol ?> <?php echo number_format($vat_calulated,2); ?> </span></li>

                              <li id="ship_li" style="display: none"><?php echo lang('Shipping_Cost'); ?> <span class="count"><?php echo $currency_symbol ?> <span id="ship_cost"></span> </span></li>
                              
                              <li id="shipping_rate_li">
                                 <label for="shipping_rate"><?php echo lang('Calculate_Shipping_Rate'); ?>:</label>
                                 <input type="checkbox" class="" id="shipping_rate" <?php echo $disabled; ?> >
                              </li>
                           </ul>
                           <ul class="total">
                              <li><?php echo lang('total'); ?> <span class="count"><?php echo $currency_symbol ?> <label id="total_cost"><?php echo number_format($grand_total,2); ?></label> </span></li>
                           </ul>
                        </div>
                        <div class="payment-box">
                          <!--  <div class="upper-box">
                              <div class="payment-options">
                                 <ul>
                                    <li>
                                       <div class="radio-option">
                                          <input type="radio" value="cash-on-del" name="payment_mode" id="ck_cod">
                                          <label for="ck_cod">Cash On Delivery</label>
                                       </div>
                                    </li>
                                    <li>
                                       <div class="radio-option paypal">
                                          <input type="radio" value="online" name="payment_mode" id="ck_online">
                                          <label for="ck_online">Online Payment<span class="image">
                                          </span></label>
                                       </div>
                                    </li>
                                 </ul>
                              </div>
                           </div> -->
                           <div class="text-right">
                              <!-- <button id="shipping_rate" type="button" class="btn-solid btn pl_ordr_chckbtn"><?php //echo lang('Calculate_Shipping_Rate'); ?></button> -->
                              
                              <button type="submit" class="pl_ordr_chckbtn btn btn-solid"><?php echo lang('Place_Order'); ?></button>
                           </div>
                        </div>
                        <div id="shipping_error" class="text-danger" style="display: none;"></div>
                     </div>
                  </div>
                <?php }else{ ?>
                  <h1 class="text-center text-danger">Your Cart Is Empty</h1>
                <?php } ?>

               </div>
            </form>
         </div>
      </div>
   </div>
</section>
<!-- section end -->

<?php  include('checkout_common.php'); ?>