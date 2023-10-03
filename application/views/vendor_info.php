<link href='<?php echo base_url(); ?>assets/frontend/css/catalog.css'
   rel='stylesheet' media="screen">
<link href='<?php echo base_url(); ?>assets/frontend/css/common.css'
   rel='stylesheet' media="screen">
<style type="text/css">
   .reorder_btn {
      background: #004670;
      padding: 10px 15px;
      border-radius: 100px;
      color: #fff !important;
   }

   .reorder_btn:hover {
      background: #043755;
      cursor: pointer;
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

<div class="breadcrumb-section">
   <div class="container container_detl_wdth">
      <div class="flexBetween product_section">
         <div>
            <span></span>
         </div>
         <div>
        <?php  $catalog = $this->db->get_where('catalog',array('seller_id'=>$vendor_data[0]['id']))->result(); if($catalog ){?>
            <a class="btn btn-info craete-specing download_option" style="background:#4f0381 !important"
               href="<?php echo base_url($language.'/home/download_catalog/').$vendor_data[0]['id'];?>">DownLoad
               Catalog</a>
               <?php }?>
         </div>
      </div>
      <div class="row">
         <!-- seller-details -->
         <div class="col-lg-4 col-md-5">
            <div class="card-section g-margin-10px" style="margin-top: 3rem;">
               <div class="g-margin-1rem">
                  <div class="d-flex">
                     <img class="circular--square shadow"
                        src="<?php echo base_url('assets/admin/usersdata/') ?><?= $vendor_data[0]['logo']?>"
                        width="70px" height="70px">
                     <h3 class="flexColumn g-padding-1rem">
                        <?= $vendor_data[0]['first_name']?>
                     </h3>
                  </div>
               </div>
               <hr />
               <div class="g-padding-1rem seller-details-text">
                  <div class="d-flex">
                     <h6>
                        <?php echo lang('First_Name:'); ?>
                        </h5>&nbsp;&nbsp;&nbsp;
                        <h5>
                           <?= $vendor_data[0]['first_name']?>
                        </h5>
                  </div>
                  <div class="d-flex">
                     <h6>
                        <?php echo lang('Last_Name:'); ?>
                        </h5>&nbsp;&nbsp;&nbsp;
                        <h5>
                           <?= $vendor_data[0]['last_name']?>
                        </h5>
                  </div>
                  <div class="d-flex">
                     <h6>
                        <?php echo lang('Contact_No:'); ?>
                        </h5>&nbsp;&nbsp;&nbsp;
                        <h5>
                           <?= $vendor_data[0]['phone']?>
                        </h5>
                  </div>
                  <div class="d-flex">
                     <h6>
                        <?php echo lang('Email:'); ?>
                        </h5>&nbsp;&nbsp;
                        <h5>
                           <?= $vendor_data[0]['email']?>
                        </h5>
                  </div>
                  <div class="d-flex">
                     <h6>
                        <?php echo lang('Active_Status:'); ?>
                        </h5>&nbsp;&nbsp;&nbsp;
                        <?php if ($vendor_data[0]['active'] == 1) {?>
                        <h5>Active</h5>
                        <?php } else {?>
                        <h5>InActive</h5>
                        <?php } ?>
                  </div>
                  <div class="d-flex">
                     <h6>
                        <?php echo lang('City:'); ?>
                        </h5>&nbsp;&nbsp;&nbsp;
                        <h5>
                           <?= $vendor_data[0]['city']?>
                        </h5>
                  </div>
               </div>
            </div>
         </div>
         <!-- seller-details -->
         <!-- cards -->
         <div class="col-lg-8 col-md-7">
            <div class="cards_section">

               <div>
                  <h4 class="g-padding-10px">
                     <?php echo lang('Seller_Products:'); ?>
                  </h4>
                  <div class="flexWrap cards_headers">
                     <?php $seller_pro = $this->db->get_where('product', array('seller_id'=>$vendor_data[0]['id'],'status'=>1,'product_delete'=>0))->result_array();
foreach ($seller_pro as $product_value) {
    ?>
                     <div class="col-lg-4 col-sm-6">
                        <div class="card-section">
                           <a
                              href="<?php echo base_url($language . '/home/detail/') . $product_value['id']; ?>">
                              <img class="rounded cards-img"
                                 src="<?php echo base_url("assets/admin/products/") . $product_value['product_image']; ?>"></a>
                           <div class="g-padding-10px">
                              <div class=" flexBetween">
                                 <a
                                    href="<?php echo base_url($language . '/home/detail/') . $product_value['id']; ?>">
                                    <h6>
                                       <?php echo $product_value['product_name']; ?>
                                    </h6>
                                 </a>
                                 <h5><?php echo $currency_symbol; ?>
                                    <?php echo $product_value['sale_price']; ?>
                                 </h5>
                              </div>

                           </div>
                        </div>
                     </div>
                     <?php  }?>

                  </div>
               </div>
            </div>
            <!-- cards -->
         </div>
      </div>
   </div>
   <?php //print_r($vendor_data);?>
   <!-- <section class="cart-section section-b-space wishlist_page order_pagea">
   <div class="container container_detl_wdth">
      <div class="row hide_cart_div">
         <div class="col-sm-12">
            
            <div class="left_cart_box">
               
            </div>
            

            <div class="clear"></div>
         </div>
      </div>
      
   </div>
</section> -->