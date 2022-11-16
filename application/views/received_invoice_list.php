
<style>
   .activ_invoic a{
   font-weight: 700 !important;
   color: #004670 !important;
   }
</style>

<article  class="container theme-container">
   <div class="row">
      <!-- Posts Start -->
      
      <aside class="col-md-12 col-sm-12 space-bottom-20 ">
         <div class="account-details-wrap ">
            <div class="title-2 sub-title-small"> <?php echo lang('Quotations'); ?> </div>
            <div class="account-box  light-bg default-box-shadow recv_invoicas">
               <form action="#" class="form-delivery">
                  <div class="row top_pading_sec">
                     
  
                     
                     <table class="tabl_tr_th" style="margin-top: 0px; margin-bottom: 20px; " >
                        <thead>
                           <tr>
                              <th><?php echo lang('No'); ?></th>
                              <th><?php echo lang('Date'); ?></th>
                              <th><?php echo lang('quantity'); ?></th>
                              <th><?php echo lang('Unit'); ?></th>
                              <th><?php echo lang('SKU'); ?></th>
                              <th><?php echo lang('Incoive_Statu'); ?></th>
                              <th><?php echo lang('Price'); ?></th>
                              <th><?php echo lang('Detail'); ?></th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if(!empty($invlice_list)){ 
                              foreach ($invlice_list as $il_key => $il_val) { 
                                 $total=0;
                                 $price=$il_val['in_price'];
                                 $vat_amount=($tax[0]['vat']*$price)/100;
                                 $vat_commission=($tax[0]['commission']*$price)/100;
                                 $total=$price+$vat_amount+$vat_commission;

                                 ?>
                           <tr>
                              <td class="sn1" ><?php echo $il_val['in_id']; ?></td>
                              <td class="sndate" ><?php echo date('M-d-Y' ,strtotime($il_val['created_date'])); ?></td>
                              <td class="sn3" ><?php echo $il_val['in_qty']; ?></td>
                              <td class="sn3" ><?php echo $il_val['in_unit']; ?></td>
                              <td class="sn5" ><?php echo $il_val['in_sku']; ?></td>
                              <td class="sn5" >
                                 <?php if($il_val['invoice_status']=='Confirmed'){ ?>
                                    <span class="label label-success"><?php echo $il_val['invoice_status']; ?></span>
                                   <?php }else if($il_val['invoice_status']=='Cancelled'){ ?>
                                     <span class="label label-danger"><?php echo $il_val['invoice_status']; ?></span>
                                   <?php }else if($il_val['invoice_status']=='Rejected'){ ?>
                                     <span class="label label-warning"><?php echo $il_val['invoice_status']; ?></span>
                                   <?php }else{ ?>
                                       <span class="label label-primary"><?php echo $il_val['invoice_status']; ?></span>
                                   <?php } ?> 
                              </td>
                              <td class="sn6" >
                                 <?php if($currency=="USD")
                                 {
                                    echo $price/$tax[0]['sar_rate'];
                                 }else {
                                  echo $price; } ?> <?php echo $currency_symbol; ?></td>
                                
                              <td class="sn6" >
                                 <a href="<?php echo base_url($language.'/my_account/received_invoice/').$il_val['in_id']; ?>" class="detl_info" >
                                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                                 </a>
                              </td>
                           </tr>
                           <?php } }else{ ?>
                            <tr>
                               <td><?php echo lang('No_record_found'); ?></td>
                            </tr>  
                           <?php } ?>

                        </tbody>
                     </table>
                     <div class="clear"></div>
                    
                     
                  </div>
               </form>
            </div>
         </div>
      </aside>
      <!-- Posts Ends --> 
   </div>
</article>
