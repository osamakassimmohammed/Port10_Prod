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
         <?php if(!empty($quotation_detail)) { ?>
         <div class="account-details-wrap ">
            <div class="title-2 sub-title-small"> <?php echo lang('Quotations'); ?> </div>
            <div class="account-box  light-bg default-box-shadow recv_invoicas">
               <form action="#" class="form-delivery">
                  <div class="row top_pading_sec">
                     <div class="col-md-6 col-sm-6 smal_3">
                        <div class="form-group">
                           <div class="label_new"> <?php echo lang('Quotation_Id'); ?> </div>
                           <div class="ref_num_label">
                              <?php echo $quotation_detail[0]['id']; ?>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-sm-6 smal_3">
                        <div class="form-group">
                           <div class="label_new"> <?php echo lang('aCustomer_Name'); ?> </div>
                           <div class="ref_num_label">
                              <?php echo $quotation_detail[0]['user_name']; ?>
                           </div>
                        </div>
                     </div>                     
                     <div class="col-md-6 col-sm-6 smal_3">
                        <div class="form-group">
                           <div class="label_new"> <?php echo lang('product_name'); ?> </div>
                           <div class="ref_num_label">
                              <?php echo $quotation_detail[0]['product_name']; ?>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-sm-6 smal_3">
                        <div class="form-group">
                           <div class="label_new"> <?php echo lang('Product_Group'); ?> </div>
                           <div class="ref_num_label">
                              <?php echo $quotation_detail[0]['category_name']; ?>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-sm-6 smal_3">
                        <div class="form-group">
                           <div class="label_new"> <?php echo lang('Date'); ?>  </div>
                           <div class="ref_num_label">
                              <?php echo date('M-d-Y' ,strtotime($quotation_detail[0]['created_date'])); ?>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-sm-6 smal_3">
                        <div class="form-group">
                           <div class="label_new"> <?php echo lang('Purchase_Cycle'); ?> </div>
                           <div class="ref_num_label">
                              <?php echo $quotation_detail[0]['purchase_cycle']; ?>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-sm-6 smal_3">
                        <div class="form-group">
                           <div class="label_new"> <?php echo lang('Customization'); ?> </div>
                           <div class="ref_num_label">
                              <?php echo $quotation_detail[0]['customiz']; ?>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-sm-6 smal_3">
                        <div class="form-group">
                           <div class="label_new"> <?php echo lang('Deadline_for_Submission'); ?> </div>
                           <div class="ref_num_label">
                              <?php echo $quotation_detail[0]['deadline']; ?>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-sm-6 smal_3">
                        <div class="form-group">
                           <div class="label_new"> <?php echo lang('Product_No_SKU'); ?> </div>
                           <div class="ref_num_label">
                              <?php echo $quotation_detail[0]['pid']; ?>
                           </div>
                        </div>
                     </div>

                     <div class="col-md-6 col-sm-6 smal_3">
                        <div class="form-group">
                           <div class="label_new"> <?php echo lang('HS_Code'); ?> </div>
                           <div class="ref_num_label">
                              <?php echo $quotation_detail[0]['hscode']; ?>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-sm-6 smal_3">
                        <div class="form-group">
                           <div class="label_new"> <?php echo lang('Unit'); ?> </div>
                           <div class="ref_num_label">
                              <?php echo $quotation_detail[0]['unit_name']; ?>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-sm-6 smal_3">
                        <div class="form-group">
                           <div class="label_new"> <?php echo lang('quantity'); ?> </div>
                           <div class="ref_num_label">
                              <?php echo $quotation_detail[0]['qty']; ?>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-sm-6 smal_3">
                        <div class="form-group">
                           <div class="label_new"> <?php echo lang('Destination'); ?> </div>
                           <div class="ref_num_label">
                              <?php echo $quotation_detail[0]['address']; ?>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-sm-6 smal_3">
                        <div class="form-group">
                           <div class="label_new"> <?php echo lang('Delivery_Date'); ?> </div>
                           <div class="ref_num_label">
                              <?php echo $quotation_detail[0]['delivery_date']; ?>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-sm-6 smal_3">
                        <div class="form-group">
                           <div class="label_new"> <?php echo lang('Incoterms'); ?> </div>
                           <div class="ref_num_label">
                              <?php echo $quotation_detail[0]['incoterms']; ?>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-sm-6 smal_3">
                        <div class="form-group">
                           <div class="label_new"> <?php echo lang('Certification'); ?> </div>
                           <div class="ref_num_label">
                              <?php echo $quotation_detail[0]['certification']; ?>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-sm-6 smal_3">
                        <div class="form-group">
                           <div class="label_new"> <?php echo lang('aSeller_Name'); ?> </div>
                           <div class="ref_num_label">
                              <?php echo $quotation_detail[0]['seller_name']; ?>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-sm-6 smal_3">
                        <div class="form-group">
                           <div class="label_new"> <?php echo lang('Information'); ?>  </div>
                           <div class="ref_num_label">
                               <?php echo $quotation_detail[0]['information']; ?>
                           </div>
                        </div>
                     </div>  
                     <div class="col-md-6 col-sm-6 smal_3">
                        <div class="form-group">
                           <div class="label_new"> <?php echo lang('Address'); ?>  </div>
                           <div class="ref_num_label">
                               <?php echo $quotation_detail[0]['address']; ?>
                           </div>
                        </div>
                     </div>  
                     
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
