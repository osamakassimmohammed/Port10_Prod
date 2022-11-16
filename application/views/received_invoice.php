<style>
   .activ_invoic a{
   font-weight: 700 !important;
   color: #004670 !important;
   }

   .recv_invoicas .col-md-6.smal_3, .recv_invoicas .col-md-6.smal_12{
      padding: 0px;
   }

   .sub-title-small{
      margin-left: 25px;
   }
</style>

 

<article  class="container theme-container">
   <div class="row">
      <!-- Posts Start -->
      
      <aside class="col-md-12 col-sm-12 space-bottom-20 ">
         <?php if(!empty($invlice_list)) { ?>
         <div class="account-details-wrap ">
            <div class="title-2 sub-title-small"> <?php echo lang('Quotations'); ?> </div>
            <div class="account-box  light-bg default-box-shadow recv_invoicas">
               <form action="#" class="form-delivery">
                  <div class="row top_pading_sec">
                     <div class="col-md-6 col-sm-6 smal_3">
                        <div class="form-group">
                           <div class="label_new"> <?php echo lang('Ref_Number'); ?></div>
                           <div class="ref_num_label">
                              <?php echo $invlice_list[0]['in_iref_no']; ?>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-sm-6 smal_3">
                        <div class="form-group">
                           <div class="label_new"> <?php echo lang('Date'); ?></div>
                           <div class="ref_num_label">
                              <?php echo date('M-d-Y' ,strtotime($invlice_list[0]['created_date'])); ?>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-sm-6 smal_3">
                        <div class="form-group">
                           <div class="label_new"> <?php echo lang('Supplier_Name'); ?></div>
                           <div class="ref_num_label">
                              <?php echo $invlice_list[0]['seller_name']; ?>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-sm-6 smal_12">
                        <div class="form-group">
                           <div class="label_new"> <?php echo lang('Address'); ?></div>
                           <div class="ref_num_label">
                               <?php echo $invlice_list[0]['in_address']; ?>
                           </div>
                        </div>
                     </div>
                     <table class="tabl_tr_th" >
                        <thead>
                           <tr>
                              <th><?php echo lang('SN'); ?></th> 
                              <th><?php echo lang('quantity'); ?></th>
                              <th><?php echo lang('Unit'); ?></th>
                              <th><?php echo lang('Item_Description'); ?></th>
                              <th><?php echo lang('Item_Code'); ?></th>
                              <th><?php echo lang('Currency_Price'); ?></th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td class="sn1" ><?php echo $invlice_list[0]['in_id']; ?></td>
                              <td class="sn2" ><?php echo $invlice_list[0]['in_qty']; ?></td>
                              <td class="sn3" ><?php echo $invlice_list[0]['in_unit']; ?></td>
                              <td class="sn4" >
                                <?php echo $invlice_list[0]['in_describtion']; ?>
                              </td>
                              <td class="sn5" ><?php echo $invlice_list[0]['in_sku']; ?></td>
                              <?php
                                 $total=0;
                                 $price=$invlice_list[0]['in_price'];
                                 if($currency=="USD")
                                 {
                                    $price=$price/$tax[0]['sar_rate'];
                                 }
                                 $commission=$tax[0]['commission'];
                                 $single_commission=($commission*$price)/100;
                                 if($single_commission>$tax[0]['cap_rate'])
                                 {
                                    $single_commission=$tax[0]['cap_rate'];
                                 }                                 

                                 // $commission=($tax[0]['commission']*$price)/100;
                                 if($currency=='USD')
                                  {
                                    $bank_fees_cod=$tax[0]['bank_fees_cod']/$tax[0]['sar_rate'];
                                    $transfer_fees=$tax[0]['transfer_fees']/$tax[0]['sar_rate'];
                                  }else{
                                    $bank_fees_cod=$tax[0]['bank_fees_cod'];
                                    $transfer_fees=$tax[0]['transfer_fees'];
                                  }
                                  $bank_fees_online=$tax[0]['bank_fees_online'];
                                  $bank_fees_online=($bank_fees_online*$price)/100;

                                  $all_feescod=$single_commission+$bank_fees_cod+$transfer_fees;
                                  $product_fees_without_vat_cod=$price+$all_feescod;
                                  $vat=$tax[0]['vat'];
                                  $vat_calulated_cod=($vat*$product_fees_without_vat_cod)/100;
                                  $grand_total_cod=$product_fees_without_vat_cod+$vat_calulated_cod;

                                  $all_fees_online=$single_commission+$bank_fees_online+$transfer_fees;
                                  $product_fees_without_vat_online=$price+$all_fees_online;       
                                  $vat_calulated_online=($vat*$product_fees_without_vat_online)/100;
                                  $grand_total_online=$product_fees_without_vat_online+$vat_calulated_online;


                              ?>
                              <td class="sn6" ><?php echo decnum($price); ?> <?php echo $currency_symbol; ?></td>
                           </tr>                           
                        </tbody>
                     </table>
                     <div class="clear"></div>
                     <div class="radio-option hide_cart_div hide_cart_div1">
                        <p class="paymnt_methd_a" ><?php echo lang('Payment_Method'); ?></p>

                        <input type="radio" class="com_mode" value="<?php echo en_de_crypt('cash-on-del'); ?>" name="payment_mode" id="ck_cod">
                        <label for="ck_cod"><?php echo lang('Virtual_Account_Transfer'); ?></label>
                        <input type="radio" class="com_mode" value="<?php echo en_de_crypt('online'); ?>" name="payment_mode" id="ck_online">
                        <label for="ck_online"><?php echo lang('Card'); ?><span class="image">
                        </span></label>

                        <div class="clear"></div>

                     </div>
                     <table class="tabl_vat_as" id="cod_table" style="display: none" >
                        <tr>
                           <td class="lbl_tr_tb" > <?php echo lang('Sub_total'); ?>: </td>
                           <td class="ans_lbl_tr_tb" > <?php echo decnum($price); ?> </td>
                        </tr>
                        <tr>
                           <td class="lbl_tr_tb" > <?php echo lang('fees'); ?>: </td>
                           <td class="ans_lbl_tr_tb" > <?php echo decnum($all_feescod); ?> </td>
                        </tr>
                        <tr>
                           <td class="lbl_tr_tb" > <?php echo lang('VAT'); ?>: </td>
                           <td class="ans_lbl_tr_tb" > <?php echo decnum($vat_calulated_cod); ?> </td>
                        </tr>
                        <tr>
                           <td class="lbl_tr_tb" > <?php echo lang('Total_Amount'); ?> : </td>
                           <td class="ans_lbl_tr_tb" > <?php echo decnum($grand_total_cod); ?> </td>
                        </tr>
                     </table>
                     <table class="tabl_vat_as" id="onlie_table" style="display: none" >
                        <tr>
                           <td class="lbl_tr_tb" ><?php echo lang('Net_Amount'); ?>: </td>
                           <td class="ans_lbl_tr_tb" > <?php echo decnum($price); ?> </td>
                        </tr>
                        <tr>
                           <td class="lbl_tr_tb" ><?php echo lang('fees'); ?> : </td>
                           <td class="ans_lbl_tr_tb" > <?php echo decnum($all_fees_online); ?> </td>
                        </tr>
                        <tr>
                           <td class="lbl_tr_tb" > <?php echo lang('VAT'); ?>  : </td>
                           <td class="ans_lbl_tr_tb" > <?php echo decnum($vat_calulated_online); ?> </td>
                        </tr>
                        <tr>
                           <td class="lbl_tr_tb" > <?php echo lang('Total_Amount'); ?> : </td>
                           <td class="ans_lbl_tr_tb" > <?php echo decnum($grand_total_online); ?> </td>
                        </tr>
                     </table>
                     <div class="clear"></div>
                     <?php if(empty($invlice_list[0]['invoice_status'])) { ?>
                        <a class="purh_btn_as"  href="javascript:void()"><?php echo lang('You_quotation_status_is_Pending'); ?> </a>
                     <?php }else if($invlice_list[0]['invoice_status']=='Rejected'){ ?>
                        <a class="purh_btn_as" style="background:#ea0b2a" href="javascript:void()"><?php echo lang('You_quotation_Rejected_By_seller'); ?> </a>
                     <?php }else if($invlice_list[0]['invoice_status']=='Cancelled'){ ?>
                        <a class="purh_btn_as" style="background:#ea0b2a" href="javascript:void()"><?php echo lang('You_Cancelled_You_Request'); ?> </a>
                     <?php }else{ ?>
                     <a class="purh_btn_as" id="vc_addlink" style="display: none"  href="<?php echo base_url($language.'/order/invoice_purchase/').$invlice_list[0]['in_id']; ?>"><?php echo lang('Purchase'); ?> </a>
                     <a class="purh_btn_as" id="vc_out" href="javascript:void(0)"><?php echo lang('Purchase'); ?> </a>
                     <?php } ?>
                     <div class="clear"></div>
                  </div>
               </form>
            </div>
         </div>
         <?php }else{ ?>
         <h2><?php echo lang('No_record_found'); ?></h2>
         <?php } ?>
      </aside>
      <!-- Posts Ends --> 
   </div>
</article>
<script type="text/javascript">
    
  $(document).on("click","#vc_out",function()
  {
    var payment_mode=$('input[name=payment_mode]:checked').val();
    var error=1;    
    if(typeof payment_mode === "undefined" ) 
    {
        swal("","<?php echo lang('Select_Payment_Option'); ?>","warning");
        error=0;
        return false;
    }else{      
      var ck_link="<?php echo base_url($language.'/order/invoice_purchase/').@$invlice_list[0]['in_id']; ?>/"+payment_mode;      
      $("#vc_addlink").attr("href",ck_link);
      $("#vc_addlink")[0].click()      
    }

  });

  $(document).on("click",".com_mode",function()
  {
      var payment_mode=$('input[name=payment_mode]:checked').val();
      var error=1;    
    
      if(payment_mode=='TEhtdm1jNHYzak1kdGx6K20vd0QxQT09')
      {
         $("#onlie_table").hide();
         $("#cod_table").show();
      }else if(payment_mode=='ZHNPNlRsVE40WUpEQnRnSlhtU0Zpdz09'){
         $("#cod_table").hide();
         $("#onlie_table").show();
      }else{
         swal("","Please select right payment ",'warning');
         error=0;
        return false;
      }   
  });
  
</script>

