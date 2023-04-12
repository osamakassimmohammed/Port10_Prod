<style type="text/css">
   .home_active {
      font-weight: 600 !important;
      color: #c09550 !important;
   }

   .reorder_btn {
      background: #004670;
      padding: 10px 15px;
      border-radius: 100px;
      color: #fff !important;
   }

   .writec {
      /*font-size: 36px;*/
      color: #222222;
      text-transform: uppercase;
      font-weight: 600;
      line-height: 1;
      letter-spacing: 0.02em;
   }

   .or_unit {
      margin-left: 00px;
      margin-top: -30px;
      font-weight: 600;
      line-height: 23px;
      width: 100%;
      text-align: center;
      display: inline-block;
      margin-left: 0px;
   }

   .or_pro {
      margin-left: 00px;
      width: 100%;
      text-align: center;
      display: inline-block;
      margin-top: 7px;
   }

   td {
      vertical-align: middle !important;
   }

   .or_qty {
      text-align: center;
   }

   body {
      background: #f8fbfd;
   }

   .table thead th {
      vertical-align: bottom;
      border-bottom: 1px solid #dee2e6;
      border-top: 0px;
   }
</style>

<div class="holder mt-0">
   <?php if (!empty($data)) { ?>
      <div class="container">
         <div class="row">
            <div class="col-lg-12 wrap_old_histry">

               <?php foreach ($data as $data_key => $data_val) {
                  $currency = $data_val['currency'];
                  ?>
                  <div class="table-responsive">
                     <table class="table check-tbl">
                        <thead>
                           <tr>
                              <th colspan="1">
                                 <?php echo lang('ITEMS_u'); ?>
                              </th>
                              <th>
                                 <?php echo lang('QUANTITY_u'); ?>
                              </th>
                              <th>
                                 <?php echo lang('PRODUCT_REF'); ?>
                              </th>
                              <th>
                                 <?php echo lang('PRICE_u'); ?>
                              </th>
                              <th>
                                 <?php echo lang('WRITE_REVIEW'); ?>
                              </th>
                              <th>
                                 <?php echo lang('INVOICE'); ?>
                              </th>
                              <th>
                                 <?php echo lang('TOTAL_u'); ?>
                              </th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php foreach ($data_val['items'] as $items_key => $items_val) { ?>

                              <tr class="alert">
                                 <?php
                                 if (filter_var($items_val['product_image'], FILTER_VALIDATE_URL)) {
                                    $image_url = $items_val['product_image'];
                                 } else {
                                    $image_url = base_url("assets/admin/products/") . $items_val['product_image'];
                                 }
                                 ?>
                                 <td colspan="1" class="product-item-img">
                                    <a href="<?php echo base_url($language . '/home/detail/') . $items_val['id']; ?>"><img
                                          height="100px" src="<?php echo $image_url; ?>" alt=""></a>
                                    <div class="clear"></div>
                                    <a class="or_pro"
                                       href="<?php echo base_url($language . '/home/detail/') . $items_val['id']; ?>"><?php echo $items_val['product_name']; ?></a>
                                    <?php if (!empty($items_val['attribute'])) { ?>
                                       <div class="clear"></div>
                                       <p style="color:black">
                                          <?php echo $items_val['attribute']; ?>
                                       </p>
                                    <?php } ?>
                                    <div class="clear"></div>
                                    <p class="or_unit">
                                       <?php echo $items_val['unit_name']; ?>
                                    </p>
                                 </td>

                                 <td class="product-item-price or_qty" style="color:black">
                                    <?php echo $items_val['quantity']; ?>
                                 </td>
                                 <td class="product-item-price" style="color:black">
                                    <?php echo $items_val['trans_ref']; ?>
                                 </td>
                                 <td class="product-item-price pric_bld_a" style="color:black">
                                    <?php echo $currency . '  ' . number_format($items_val['price'], 2); ?>
                                 </td>
                                 <td class="product-item-price" style="color:black"> <a
                                       href="<?php echo base_url($language . '/home/detail/') . $items_val['product_id']; ?>/#rating_div"
                                       class="writec"> Write Review </a> </td>

                                 <td class="product-item-price pric_bld_a" style="color:black">
                                    <?php echo $currency . '  ' . number_format($items_val['sub_total'], 2); ?>
                                 </td>

                                 <td class="product-item-price" style="color:black"> <a target="_blank"
                                       href="<?php echo base_url($language . '/admin/seller/pdf/') . $items_val['item_id'] . '/' . en_de_crypt($data_val['user_id']) ?>"
                                       class="rerd_as"> <?php echo lang('DOWNLOAD'); ?> </a></td>
                              </tr>


                           <?php } ?>

                        </tbody>
                     </table>
                  </div>
               <?php } ?>
            </div>
         </div>

      </div>
   <?php } else { ?>
      <p class="" style="color: #ef5b28; text-align:center; font-size: 25px;">
         <?php echo lang('Order_History_is_Empty'); ?>
      </p>
   <?php } ?>
</div>