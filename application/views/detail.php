<style type="text/css">
   .home_active{
   font-weight: 600 !important;
   color: #c09550 !important;
   }
   .contnr_main_headr.hedr_fixed{
   position: static;
   box-shadow: 0px 0px 0px #fff;
   }
   
   .vendor_name_a a:hover {
    color: #000 !important;
   }
   .vendor_name_a a {
      color: #000 !important;
   }
   .outstock_labl {
    display: inline-block;
    margin-top: -1px;
    margin-bottom: 0px;
    font-weight: 600;
    font-size: 17px;
    color: #e23737;
    float: right;
    margin-top: -10px;
    margin-bottom: 16px;
}

   .green{
      color:#45b955;
   }
   .get_star{
      margin-right:1px; 
   }
  

   body{
      background:#f8fbfd;
   }

header {
    margin-bottom: 0px;
}
   
button.add_to_cart12 {
    margin-top: 15px;
    text-align: center;
    width: 70%;
    padding: 8px 7px;
    border-radius: 5px;
    background: #3f006f;
    color: white;
    margin-left: 15%;
    border-radius: 100px;
    font-size: 16px;
    display: inline-block;
    white-space: nowrap;
    vertical-align: middle;
    user-select: none;
    line-height: 20px;
    text-transform: uppercase;
    /* font-weight: 500; */
    letter-spacing: 0.05em;
    border: 2px solid var(--theme-deafult);
    background-image: linear-gradient(30deg, var(--theme-deafult) 50%, transparent 50%);
    background-size: 850px;
    background-repeat: no-repeat;
    background-position: 0;
    transition: background 300ms ease-in-out;
}
button.add_to_cart12:hover {
    text-decoration: none;
    transition: 0.3s ease-in-out;
    background-position: 100%;
    color: #000000 !important;
    background-color: #ffffff;
    cursor: pointer;
    border-radius: 100px;
}
.product-buttons .buy_crt_b {
    border-radius: 100px;
    background: #fff;
    border-color: #fd4c68;
    width: 48%;
    margin-left: 3px !important;
    color: #fd4c68;
}
.product-buttons .buy_crt_b:hover {
    background-color: #fd4c68 !important;
    color: #fff;
}
a.btn.btn-solid.add_crt_a.add_to_cart12 {
    color: #fff;
}
</style>

      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/frontend/css/xzoom.css" media="all" />
      <link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url(); ?>assets/frontend/css/magnific-popup.css" />
      <script src="<?php echo base_url(); ?>assets/frontend/js/jquery.js"></script> 
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/xzoom.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/magnific-popup.js"></script>




<!-- section start -->
<section class="detl_page_wrap" >
   <div class="collection-wrapper">

      <div class="clear"></div>
            <div class="nav_main">
               <a href="<?php echo base_url($language); ?>" class="nav_a" > <?php echo lang('Home'); ?> </a>
               <i class="fa fa-angle-right" aria-hidden="true"></i>
               <a href="<?Php echo base_url($language . '/home/listing/') . @$product_detail[0]['category']; ?>" class="nav_a" > <?php echo @$product_detail[0]['category_name']; ?> </a>
               <i class="fa fa-angle-right" aria-hidden="true"></i>
               <a class="nav_a" > <?php echo @$product_detail[0]['product_name']; ?> </a>
               <div class="clear"></div>
            </div>
      <div class="clear"></div>

      <div class="container container_detl_wdth">

         <div class="row">



            <?php if (!empty($product_detail)) { ?>
                       <div class="col-lg-4"  >
                           <div class="large-5 column">
                              <div class="xzoom-container">

                     
                                 <img class="xzoom5 zoom_right_main" id="xzoom-magnific" src="<?php echo base_url("assets/admin/products/") . $product_detail[0]['product_image']; ?>" xoriginal="<?php echo base_url("assets/admin/products/") . $product_detail[0]['product_image']; ?>" />
                                 <div class="xzoom-thumbs zoomleft_main">
                                    <a href="<?php echo base_url("assets/admin/products/") . $product_detail[0]['product_image']; ?>"><img class="xzoom-gallery5" width="80" src="<?php echo base_url("assets/admin/products/") . $product_detail[0]['product_image']; ?>"  xpreview="<?php echo base_url("assets/admin/products/") . $product_detail[0]['product_image']; ?>" title="<?php echo $product_detail[0]['product_name']; ?>"></a>
                                    <?php if (!empty($product_detail[0]['image_gallery'])) { ?>
                                                <?php $product_image = explode(",", $product_detail[0]['image_gallery']);
                                                foreach ($product_image as $key => $value) { ?>
                                                            <a href="<?php echo base_url("assets/admin/products/") . $value; ?>"><img class="xzoom-gallery5" width="80" src="<?php echo base_url("assets/admin/products/") . $value; ?>"  xpreview="<?php echo base_url("assets/admin/products/") . $value; ?>" title="<?php echo $product_detail[0]['product_name']; ?>"></a>                    
                                                <?php }
                                    } ?>
                                 </div> 

                     
                              </div>
                           </div>
                        </div>


                        <div class="col-lg-4">
                           <div class="product-right product-description-box">
                              <h2><?php echo $product_detail[0]['product_name']; ?></h2>
                                 <div class="vendor_name_a">
                                    <a href="<?php echo base_url($language.'/home/vendor_info/').$product_detail[0]['seller_id']; ?>">
                                       <img class="vendor_name_a_img" src="<?php echo base_url(); ?>assets/frontend/images/vendor.png">
                                       <?php echo $product_detail[0]['first_name']; ?>
                                    </a>
                                    
                                </div>
                             <div class="3three-star new_rating">
                              <?php echo $product_detail[0]['rating_element']; ?>
                           </div>
                              <div class="product-icon mb-3 wishlist<?php echo $product_detail[0]['id']; ?>">                     
                                    <?php if ($product_detail[0]['wish_list'] == 1) { ?>
                                                <button class="wishlist-btn" onclick="remove_cart(<?php echo $product_detail[0]['id']; ?>,'detail')">
                                                   <img class="wisl_icn_as" src="<?php echo base_url(); ?>assets/frontend/images/like.svg">
                                                   <span class="title-font"><?php echo lang('Added_To_WishList'); ?></span></button>
                                 <?php } else { ?>
                                                <button class="wishlist-btn" onclick="move_to_wish_list(<?php echo $product_detail[0]['id']; ?>,'detail')">
                                                   <img class="wisl_icn_as" src="<?php echo base_url(); ?>assets/frontend/images/wish_icon.png">
                                                   <span class="title-font"><?php echo lang('Added_To_WishList'); ?></span></button>
                                 <?php } ?>
                                 <!-- <span class="wish_l wishlist<?php echo $product_value['id']; ?>">
                                             <?php if ($product_value['wish_list'] == 1) { ?>
                                                <a href="javascript:void(0)"
                                                   onclick="remove_cart(<?php echo $product_value['id']; ?>)"><i class="ti-heart"
                                                      aria-hidden="true"></i></a>
                                             <?php } else { ?>
                                                <a href="javascript:void(0)"
                                                   onclick="move_to_wish_list(<?php echo $product_value['id']; ?>)">
                                                   <i class="ti-heart" aria-hidden="true"></i></a>
                                             <?php } ?>
                                          </span> -->
                              </div>
                              <div class="wrp_cmpr_2">
                                <label>
                                  <input type="checkbox" class="add_check2 compare_ck" value="<?php echo $product_detail[0]['id']; ?>" <?php echo $product_detail[0]['is_compare']; ?> >
                                  <div class="ad_cmpr_tex2"> <?php echo lang('add_To_Compare'); ?>  </div>
                                </label>
                              </div>                     
                              <div class="row product-accordion">
                                 <div class="col-sm-12">
                                    <div class="accordion theme-accordion" id="accordionExample">
                                       <div class="card">
                                          <div class="card-header" id="headingOne" style="display: none;" >
                                             <h5 class="mb-0"><button class="btn btn-link" type="button"
                                                data-toggle="collapse" data-target="#collapseOne"
                                                aria-expanded="true" aria-controls="collapseOne">
                                                Product Details
                                             </button>
                                             </h5>
                                          </div>
                                          <div id="collapseOne1" class="collapse show" aria-labelledby="headingOne"
                                             data-parent="#accordionExample">
                                             <div class="card-body">
                                                <div class="single-product-tables detail-section">
                                                   <table style="display: none;" >
                                                      <tbody>
                                                         <tr>
                                                            <td>Categories :</td>
                                                            <td>
                                                               <?php echo $product_detail[0]['category_name']; ?>
                                                            </td>
                                                         </tr>
                                                         <tr>
                                                            <td>SubCategories :</td>
                                                            <td><?php echo $product_detail[0]['subcategory_name']; ?></td>
                                                         </tr>
                                                         <tr>
                                                            <td>Material :</td>
                                                            <td>Crepe printed</td>
                                                         </tr>
                                                      </tbody>
                                                   </table>

                                                   <ul class="specfctn_ul" >
                                                     <?php echo $product_detail[0]['specification']; ?>
                                                   </ul>

                                                </div>
                                                <p class="descrp_detl_pfg" >
                                                   <?php echo $product_detail[0]['short_description']; ?>
                                                </p>
                                                <p class="descrp_detl_pfg" >
                                                   <?php echo lang('Minimum_Order_Requirement'); ?> : <?php echo $product_detail[0]['min_order_quantity']; ?>
                                                </p>
                                                <p class="descrp_detl_pfg" >
                                                   <?php echo lang('PID'); ?> : <?php echo $product_detail[0]['id']; ?>
                                                </p>
                                                <?php if (!empty($product_detail[0]['sku_code'])) { ?>
                                                            <p class="descrp_detl_pfg" >
                                                               <?php echo lang('SKU_Information'); ?> : <?php echo $product_detail[0]['sku_code']; ?>
                                                            </p>
                                                <?php } ?>
                                                <?php if (!empty($product_detail[0]['shipment_by'])) { ?>
                                                            <div class="lead_time_dlc">
                                                               <?php echo lang('READY_FOR_SHIPMENT_IN'); ?>                         <?php echo $product_detail[0]['shipment_by']; ?>                         <?php echo lang('DAYS'); ?>
                                                            </div>
                                                <?php } ?>
                                                <div class="clear"></div>
                                                <?php if ($product_detail[0]['is_delivery_available'] == 0) { ?>
                                                            <div style="margin-top: 10px;font-size: 15px;font-weight: 500;color: #7a7a7a;padding-left: 15px;"><?php echo lang('Delivery_not'); ?></div>
                                                <?php } else { ?>
                                                            <div style="margin-top: 10px;font-size: 15px;font-weight: 500;color: #7a7a7a;padding-left: 15px;"><?php echo lang('Delivery_to'); ?></div>
                                                <?php } ?>
                                             </div>
                                    
                                          </div>
                                       </div>
                                       <div class="card" style="display: none;" >
                                          <div class="card-header" id="headingTwo">
                                             <h5 class="mb-0"><button class="btn btn-link collapsed" type="button"
                                                data-toggle="collapse" data-target="#collapseTwo"
                                                aria-expanded="false"
                                                aria-controls="collapseTwo">details</button></h5>
                                          </div>
                                          <div id="collapseTwo1" class="collapse" aria-labelledby="headingTwo"
                                             data-parent="#accordionExample">
                                             <div class="card-body">
                                                <div>
                                                   <?php echo $product_detail[0]['description']; ?>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="card" style="display: none;" >
                                          <div class="card-header" id="headingThree">
                                             <h5 class="mb-0"><button class="btn btn-link collapsed" type="button"
                                                data-toggle="collapse" data-target="#collapseThree"
                                                aria-expanded="false"
                                                aria-controls="collapseThree">review</button></h5>
                                          </div>
                                          <div id="collapseThree" class="collapse show" aria-labelledby="headingThree"
                                             data-parent="#accordionExample">
                                             <div class="card-body">
                                                <p>no reviews yet</p>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="product-right product-form-box">
                           <div style="display: none;" > 
                              <h4><del><?php echo $product_detail[0]['price']; ?>             <?php echo $currency_symbol; ?></del><span>55% off</span></h4>
                           </div>
                              <h3 style="margin-bottom: 20px;" ><?php echo $currency_symbol; ?>             <?php echo $product_detail[0]['sale_price']; ?> </h3>                       
                              <?Php if ($product_detail[0]['is_stock'] == 1) { ?>

                                             <!-- <div class="get_lat_price" data-toggle="modal" data-target="#get_lat_pric" >
                        Get Latest Price
                     </div> -->
                 
                              <?php } else { ?>
                                           <div class="outstock_labl">
                                                   <?php echo lang('aOut_of_stock'); ?>
                                          </div>  
                              <?php } ?>
                   
                              <div class="clear"></div>


                              <form id="buynow_form" action="<?php echo base_url($language . '/order/buynow'); ?>" method="POST">
                              <div class="product-description border-product">
                                 <!-- <h6 class="product-title">Unit</h6> -->
                                 <?php if (!empty($product_detail[0]['unit_list'])) { ?>
                                             <select name="unit" class="form-control get_unit<?php echo 1; ?>">
                                             <?php
                                             foreach ($product_detail[0]['unit_list'] as $uld_key => $uld_value) {
                                                ?>
                                                             <option data-id="<?php echo $uld_value['id'] ?>"  value="<?php echo $uld_value['id'] ?>" ><?php echo $uld_value['unit_name']; ?></option>                            
                                             <?php } ?>
                                             </select> 
                                 <?php } ?>
                                 <?php if (isset($product_detail[0]['meta_data']) && !empty($product_detail[0]['meta_data'])) { ?>

                       

                                             <select class="form-control select_size get_size<?php echo 1; ?>">
                                                <option value="0">Select Size</option>
                                               <?php foreach ($product_detail[0]['meta_data'] as $md_key => $md_val) { ?>
                                                            <option data-price="<?php echo $md_val['price']; ?>" data-value="<?php echo $md_val['size']; ?>" value="<?php echo $md_val['item_id']; ?>"><?php echo $md_val['size']; ?></option>
                                               <?php } ?>  
                                             </select>
                                 <?php } ?>

                      

                                 <!-- <div class="size-box">
                        <ul>
                           <li class="active"><a href="#">s</a></li>
                           <li><a href="#">m</a></li>
                           <li><a href="#">l</a></li>
                           <li><a href="#">xl</a></li>
                        </ul>
                     </div> -->
                                 <!-- <h6 class="product-title">quantity</h6> -->
                                 <div class="qty-box">
                                    <div class="input-group input-group_wrp_a">
                                       <span class="input-group-prepend left_prpnd"><button type="button"
                                          class="btn quantity-left-minus" data-type="minus" data-field=""><i
                                          class="ti-angle-left"></i></button> </span>
                                       <input type="text" name="quantity" class="form-control input-number detislqty" value="<?php echo $product_detail[0]['min_order_quantity']; ?>">
                                       <span class="input-group-prepend right_prpnd"><button type="button"
                                          class="btn quantity-right-plus" data-type="plus" data-field=""><i
                                          class="ti-angle-right"></i></button></span>
                                    </div>
                                 </div>
                                 <input type="hidden" name="pid" value="<?php echo $product_detail[0]['id']; ?>">
                           <div class="clear"></div>
                              <?php if ($product_detail[0]['is_stock'] == 1) { ?>
                                             <div class="instock_labl">
                                                <?php echo lang('In_Stock'); ?>
                                             </div>
                              <?php } else { ?>
                                             <div class="outstock_labl">
                                                <?php echo lang('Out_Stock'); ?>
                                             </div>
                              <?php } ?>
                              <div class="min_qty_label"><?php echo lang('Minimum_order_quantity'); ?>:<?php echo $product_detail[0]['min_order_quantity']; ?> </div>
                           <div class="clear"></div>

                              </div>
                              <div class="product-buttons">
                              <?php  if( $product_detail[0]['seller_id'] != $uid){ ?>
                                 <?php if ($product_detail[0]['price_select'] == '1') { ?>
                                             <a href="javascript:void(0)" data-detislqty="detislqty" data-id="<?php echo $product_detail[0]['id']; ?>" data-unit="get_unit<?php echo 1; ?>" class="btn btn-solid add_crt_a add_to_cart2"><?php echo lang('Add_to_cart'); ?></a>
                                 <?php } else { ?>
                                             <a href="javascript:void(0)" data-detislqty="detislqty" data-class="get_size<?php echo 1; ?>" data-unit="get_unit<?php echo 1; ?>" data-id="<?php echo $product_detail[0]['id']; ?>"  class="btn btn-solid add_crt_a add_to_cart2"><?php echo lang('Add_to_cart'); ?></a>
                                 <?php } ?>   
                                 <?php }else{ ?>
                                    <a title="<?php echo lang('Add_to_cart'); ?>" onclick="fireSweetAlert()"
                                                      class="btn btn-solid add_crt_a add_to_cart12">
                                                      <i class="ti-shopping-cart"></i>
                                                      <?php echo lang('Add_to_cart'); ?>
                                                   </a>
                                 <?php } ?>   
                                 <input type="hidden" id="payment_mode" name="payment_mode" value="">
                                 <?php  if( $product_detail[0]['seller_id'] != $uid){ ?>
                                 <button type="button" id="detail_buynow" class="btn btn-solid buy_crt_a"><?php echo lang('buy_now'); ?></button>
                                 <?php }else{ ?>
                                    <button type="button" id="detail_buynow_new" onclick="fireSweetAlert()" class="btn btn-solid buy_crt_b"><?php echo lang('buy_now'); ?></button>
                                    
                                 <?php } ?>   
                              </div>
                           </div>
                           </form>

                           <div class="contsuplrctnr">
                              <div class="cont_spl_text">
                                 <?php echo lang('for_product'); ?>
                             </div>
                             <div class="contsuplrbtn">
                              <?php echo lang('Contact_Supplier'); ?> 
                              </div>
                           </div>



                        </div>
            <?php } else { ?>
                           <h2 class="test-danger test-center"><?php echo lang('Product_Not_Found'); ?></h2>
            <?php } ?>
         </div>
      </div>
   </div>
</section>
<!-- Section ends -->
<!-- product-tab starts -->
<?php if (!empty($product_detail)) { ?>
            <section class="tab-product m-0 revewsectiona">
               <div class="container container_detl_wdth">
                  <div class="row">
                     <div class="col-sm-12 col-lg-12">
                        <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                           <li class="nav-item">
                              <a class="nav-link active" id="top-home-tab" data-toggle="tab"
                                 href="#top-home" role="tab" aria-selected="true">
                                 <?php echo lang('Product_Information'); ?>
                             </a>
                              <div class="material-border"></div>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" id="review-top-tab" data-toggle="tab"
                                 href="#top-review" role="tab" aria-selected="false"><?php echo lang('Details'); ?></a>
                              <div class="material-border"></div>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" id="rating-top-tab" data-toggle="tab"
                                 href="#top-rating" role="tab" aria-selected="false"> <div class="3three-star new_rating">
                                 <?php echo $product_detail[0]['rating_element']; ?>
                                 </div></a>
                              <div class="material-border"></div>
                           </li>               

                        </ul>
                        <div class="tab-content nav-material" id="top-tabContent">
                           <div class="tab-pane fade show active" id="top-home" role="tabpanel"
                              aria-labelledby="top-home-tab">
                              <div><?php echo $product_detail[0]['description']; ?>
                              </div>
                           </div>
                           <div class="tab-pane fade" id="top-profile" role="tabpanel" aria-labelledby="profile-top-tab">
                              <p><?php echo $product_detail[0]['short_description']; ?>
                              </p>
                           </div>

                           <div class="tab-pane fade top_review_panel" id="top-review" role="tabpanel" aria-labelledby="review-top-tab">
                              <form class="theme-form">                     
                                <div class="wrap_review_a">    
                                    <?php if (!empty($user_review)) {
                                       foreach ($user_review as $ur_key => $ur_val) { ?>
                                                            <div class="singl_review_as">                            
                                                               <div class="right_review">
                                                               <div class="revir_name">  <?php echo $ur_val['name']; ?> </div>

                                                                  <div class="new_rating"> 
                                                                     <?php echo $ur_val['rating_element']; ?>
                                                                  </div>
                                                                  <div class="review_detil"> 
                                                                     <?php echo $ur_val['comment']; ?>
                                                                  </div>
                                                               </div>
                                                               <div class="clear"></div>
                                                            </div>
                                             <?php }
                                    } else { ?>
                                                <div class="review_detil"> 
                                                         <?php echo lang('No_review_yet'); ?>
                                                </div>
                                 <?php } ?>

                                 <div class="clear"></div>

                              </div>

                              </form>
                           </div>  

                             <div class="tab-pane fade" id="top-rating" role="tabpanel" aria-labelledby="rating-top-tab">
                           <div class="review_rat_giv" id="rating_div">
                              <div class="form-row">
                                 <div class="col-md-12">
                                    <div class="media rating_medi">
                                       <label><?php echo lang('Give_Rating'); ?></label>
                           
                                       <div class="media-body ml-3">
                                          <div class="3three-star">
                                             <i id="one" class="fa fa-star get_star" data-id="1" ></i> 
                                             <i id="two" class="fa fa-star get_star" data-id="2"></i> 
                                             <i id="three" class="fa fa-star get_star" data-id="3"></i> 
                                             <i id="four" class="fa fa-star get_star" data-id="4"></i> 
                                             <i id="five" class="fa fa-star get_star" data-id="5"></i>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                     
                                 <div class="col-md-6">
                                    <label for="name"><?php echo lang('Name'); ?></label>
                                    <input type="text" class="form-control" id="rating_name" placeholder="<?php echo lang('Enter_your_name'); ?>" name="name">
                                 </div>
                                 <div class="col-md-6">
                                    <label for="email"><?php echo lang('Email'); ?></label>
                                    <input type="text" class="form-control" id="rating_email" placeholder="<?php echo lang('Email'); ?>" name="email" >
                                 </div>
                                 <div class="col-md-12">
                                    <label for="review"><?php echo lang('Enter_Review'); ?></label>
                                    <input type="text" class="form-control" id="rating_review"
                                       placeholder="<?php echo lang('Enter_your_Review'); ?>" name="review">
                                 </div>
                      
                                 <div class="col-md-12">
                                    <button class="btn btn-solid" id="btn_rating" type="button"><?php echo lang('Submit_your_Review'); ?></button>
                                 </div>
                           
                              </div>
                           </div>
                        </div>             


                           <div class="tab-pane fade" id="cat-top-review" role="tabpanel" aria-labelledby="review-top-tab">
                              <form class="theme-form">
                                 <div class="form-row">
                        
                                    <div class="col-md-6">
                                       <label for="name">To</label>
                                       <input type="text" class="form-control" id="" name="name" placeholder="To">
                                       <input type="hidden" class="form-control" id="" name="product_id" value="<?php echo @$product_detail[0]['id']; ?>" >
                                    </div>
                                    <div class="col-md-6">
                                       <label for="email">Subject</label>
                                       <input type="text" class="form-control" id="" placeholder="Subject" name="email">
                                    </div>
                        
                                    <div class="col-md-12">
                                       <label for="message">Message</label>
                                       <textarea class="form-control" placeholder="Wrire Your Message" id="" rows="6" name="message"></textarea>
                                    </div>

                                    <div class="col-md-12 ">
                                       <label for="review">Attachments</label>
                                       <div class="">

                                          <div class="uplod_garg_pics">
                                 

                                             <div class="thum_view">
                                                <div class="singl_img_up">
                                                   <img src="https://i.insider.com/5cbf50dfd1a2f8074406a8b2?width=1100&format=jpeg&auto=webp">
                                                   <a href=""> <i class="fa fa-times"></i> </a>
                                                </div>
                                             </div>

                                             <div class="upld_pic_labl">
                                                <input type="file" name="document">
                                                <div class="ad_grg_pic_titl"> Upload Pics </div>
                                             </div>

                                       </div>


                                       </div>
                                    </div>


                                    <div class="col-md-12">
                                       <button class="btn btn-solid" type="submit">Send</button>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>

             



                     </div>
                  </div>
               </div>
            </section>
<?php } ?>
<!-- product-tab ends -->


<?php $i = 2;
if (!empty($interested_in)) { ?>
            <section class="tab-product m-0 revewsectiona">
               <div class="container container_detl_wdth">
               <div class="row">
                  <div class="col-sm-12 col-lg-12">
                     <div class="hdline_prodct">
                        You might be interested in
                     </div>
         
                     <div class="ratio_asos ">
                        <div class="product-4 product-m no-arrow">
                           <?php foreach ($interested_in as $product_key => $product_value) { ?>
                                       <div class="product-box">
                                          <div class="img-wrapper">
                                             <div class="front">
                                                <a href="#"><img src="<?php echo base_url("assets/admin/products/") . $product_value['product_image']; ?>" class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                             </div>
                                             <div class="back">
                                                <a href="<?php echo base_url($language . '/home/detail/') . $product_value['id']; ?>"><img src="<?php echo base_url("assets/admin/products/") . $product_value['product_image']; ?>" class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                             </div>
                                             <div class="cart-info cart-wrap">
                        
                          
                                             </div>
                                          </div>
                                          <div class="product-detail">
                                            <?php if (!empty($product_value['unit_list'])) { ?>
                                                         <select class="form-control select_unit get_unit<?php echo $i; ?>">
                                                         <?php
                                                         foreach ($product_value['unit_list'] as $uld_key => $uld_value) { ?>
                                                                         <option data-id="<?php echo $uld_value['id'] ?>" ><?php echo $uld_value['unit_name']; ?></option>                            
                                                         <?php } ?>
                                                         </select> 
                                             <?php } ?>
                                           <?php if (isset($product_value['meta_data']) && !empty($product_value['meta_data'])) { ?>
                                                         <select class="form-control select_size get_size<?php echo $i; ?>">
                                                          <option value="0">Select Size</option>
                                                           <?php foreach ($product_value['meta_data'] as $md_key => $md_val) { ?>
                                                                        <option data-price="<?php echo $md_val['price']; ?>" data-value="<?php echo $md_val['size']; ?>" value="<?php echo $md_val['item_id']; ?>"><?php echo $md_val['size']; ?></option>
                                                           <?php } ?>  
                                                         </select>
                                             <?php } ?>
                                             <div>
                                                <a href="<?php echo base_url($language . '/home/detail/') . $product_value['id']; ?>">
                                                   <h6><?php echo $product_value['product_name']; ?></h6>
                                                </a>
                                                <span class="wish_l wishlist<?php echo $product_value['id']; ?>">
                                                  <?php if ($product_value['wish_list'] == 1) { ?>
                                                              <a  href="javascript:void(0)" onclick="remove_cart(<?php echo $product_value['id']; ?>)" ><i
                                                                       class="ti-heart" aria-hidden="true"></i></a> 
                                                  <?php } else { ?>
                                                              <a href="javascript:void(0)" onclick="move_to_wish_list(<?php echo $product_value['id']; ?>)" >
                                                                <i class="ti-heart" aria-hidden="true"></i></a> 
                                                  <?php } ?>  
                                                 </span>

                                                <h4><?php echo $currency_symbol; ?>                         <?php echo $product_value['sale_price']; ?> </h4>
                                                <ul class="color-variant">
                                                   <li class="bg-light0"></li>
                                                   <li class="bg-light1"></li>
                                                   <li class="bg-light2"></li>
                                                </ul>

                                                <?php if ($product_value['price_select'] == '1') { ?>
                                                            <button title="<?php echo lang('Add_to_cart'); ?>" data-id="<?php echo $product_value['id']; ?>" data-unit="get_unit<?php echo $i; ?>" data-detislqty="<?php echo $product_value['min_order_quantity']; ?>" class="add_to_cart2">
                                                             <i class="ti-shopping-cart"></i> <?php echo lang('Add_to_cart'); ?>
                                                            </button> 
                                                <?php } else { ?>
                                                             <button title="<?php echo lang('Add_to_cart'); ?>"data-class="get_size<?php echo $i; ?>" data-id="<?php echo $product_value['id']; ?>" data-unit="get_unit<?php echo $i; ?>" data-detislqty="<?php echo $product_value['min_order_quantity']; ?>" class="add_to_cart2">
                                                             <i class="ti-shopping-cart"></i> <?php echo lang('Add_to_cart'); ?>
                                                            </button> 
                                                <?php } ?>
                                                <div class="wrp_cmpr_2">
                                                    <label>
                                                      <input type="checkbox" class="add_check2 compare_ck" value="<?php echo $product_value['id']; ?>" <?php echo $product_value['is_compare']; ?>>
                                                      <div class="ad_cmpr_tex2"> <?php echo lang('add_To_Compare'); ?> </div>
                                                    </label>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <?php $i++;
                           } ?>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
<?php } ?>

<?php if (!empty($similar_products)) { ?>
            <section class="tab-product m-0 revewsectiona">
               <div class="container container_detl_wdth">
               <div class="row">
                  <div class="col-sm-12 col-lg-12">
                     <div class="hdline_prodct">
                        Similar products
                     </div>
                     <div class="ratio_asos ">
                        <div class="product-4 product-m no-arrow">               
                           <?php foreach ($similar_products as $product_key => $product_value) { ?>
                                       <div class="product-box">
                                          <div class="img-wrapper">
                                             <div class="front">
                                                <a href="#"><img src="<?php echo base_url("assets/admin/products/") . $product_value['product_image']; ?>" class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                             </div>
                                             <div class="back">
                                                <a href="<?php echo base_url($language . '/home/detail/') . $product_value['id']; ?>"><img src="<?php echo base_url("assets/admin/products/") . $product_value['product_image']; ?>" class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                             </div>
                                             <div class="cart-info cart-wrap">
                        
                          
                                             </div>
                                          </div>
                                          <div class="product-detail">
                                            <?php if (!empty($product_value['unit_list'])) { ?>
                                                         <select class="form-control select_unit get_unit<?php echo $i; ?>">
                                                         <?php
                                                         foreach ($product_value['unit_list'] as $uld_key => $uld_value) { ?>
                                                                         <option data-id="<?php echo $uld_value['id'] ?>" ><?php echo $uld_value['unit_name']; ?></option>                            
                                                         <?php } ?>
                                                         </select> 
                                             <?php } ?>
                                           <?php if (isset($product_value['meta_data']) && !empty($product_value['meta_data'])) { ?>
                                                         <select class="form-control select_size get_size<?php echo $i; ?>">
                                                          <option value="0">Select Size</option>
                                                           <?php foreach ($product_value['meta_data'] as $md_key => $md_val) { ?>
                                                                        <option data-price="<?php echo $md_val['price']; ?>" data-value="<?php echo $md_val['size']; ?>" value="<?php echo $md_val['item_id']; ?>"><?php echo $md_val['size']; ?></option>
                                                           <?php } ?>  
                                                         </select>
                                             <?php } ?>
                                             <div>
                                                <a href="<?php echo base_url($language . '/home/detail/') . $product_value['id']; ?>">
                                                   <h6><?php echo $product_value['product_name']; ?></h6>
                                                </a>
                                                <span class="wish_l wishlist<?php echo $product_value['id']; ?>">
                                                  <?php if ($product_value['wish_list'] == 1) { ?>
                                                              <a  href="javascript:void(0)" onclick="remove_cart(<?php echo $product_value['id']; ?>)" ><i
                                                                       class="ti-heart" aria-hidden="true"></i></a> 
                                                  <?php } else { ?>
                                                              <a href="javascript:void(0)" onclick="move_to_wish_list(<?php echo $product_value['id']; ?>)" >
                                                                <i class="ti-heart" aria-hidden="true"></i></a> 
                                                  <?php } ?>  
                                                 </span>

                                                <h4><?php echo $currency_symbol; ?>                         <?php echo $product_value['sale_price']; ?> </h4>
                                                <ul class="color-variant">
                                                   <li class="bg-light0"></li>
                                                   <li class="bg-light1"></li>
                                                   <li class="bg-light2"></li>
                                                </ul>

                                                <?php if ($product_value['price_select'] == '1') { ?>
                                                            <button title="<?php echo lang('Add_to_cart'); ?>" data-id="<?php echo $product_value['id']; ?>" data-unit="get_unit<?php echo $i; ?>" data-detislqty="<?php echo $product_value['min_order_quantity']; ?>" class="add_to_cart2">
                                                             <i class="ti-shopping-cart"></i> <?php echo lang('Add_to_cart'); ?>
                                                            </button> 
                                                <?php } else { ?>
                                                             <button title="<?php echo lang('Add_to_cart'); ?>"data-class="get_size<?php echo $i; ?>" data-id="<?php echo $product_value['id']; ?>" data-unit="get_unit<?php echo $i; ?>" data-detislqty="<?php echo $product_value['min_order_quantity']; ?>" class="add_to_cart2">
                                                             <i class="ti-shopping-cart"></i> <?php echo lang('Add_to_cart'); ?>
                                                            </button> 
                                                <?php } ?>
                                                <div class="wrp_cmpr_2">
                                                    <label>
                                                      <input type="checkbox" class="add_check2 compare_ck" value="<?php echo $product_value['id']; ?>" <?php echo $product_value['is_compare']; ?>>
                                                      <div class="ad_cmpr_tex2"><?php echo lang('add_To_Compare'); ?> </div>
                                                    </label>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <?php $i++;
                           } ?>               
                        </div>
                     </div>
                  </div>
               </div>
            </section>
<?php } ?>
<br><br><br>


<div class="modal fade" id="get_lat_pric" role="dialog">  
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
           <h4 class="modal-title">
              Fill the quantity required to get the latest price!
           </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
             
             <div class="to_label_a">
                <div class="singl_label_pop">
                   To &nbsp; :
               </div>
               <div class="singl_input_right">
                  Anna Mull
              </div>
              <div class="clear"></div>
            </div>

            <div class="to_label_a">
                <div class="singl_label_pop">
                   <span class="qnty_red" > *Quantity Needed &nbsp; : </span>
               </div>
               <div class="singl_input_right">
                  <input type="text" value="20.0" name="" class="input_tex_as" >
                  <select class="seclt_drop_need" >
                        <option>Ampere/Amperes</option>
                            <option>Bag/Bags</option>
                            <option>Barrel/Barrels</option>
                            <option>Blade/Blades</option>
                            <option>Box/Boxes</option>
                            <option>Bushel/Bushels</option>

                  </select>
              </div>
              <div class="clear"></div>
            </div>

            <div class="to_label_a">
                <div class="singl_label_pop">
                   Details &nbsp; :
               </div>
               <div class="singl_input_right">
                  <textarea placeholder="Enter more requirements here" class="detl_msg_te" rows="3" ></textarea>
              </div>
              <div class="clear"></div>
            </div>

            <div class="to_label_a">
                <div class="singl_label_pop">
                    &nbsp;  
               </div>
               <div class="singl_input_right">
                  <button class="brnget_pric_a" >Get Latest Price</button>
              </div>
              <div class="clear"></div>
            </div>




 


        </div>
        
      </div>
      
    </div>
</div>

<div class="modal fade" id="cont_suuplr_tb" role="dialog">  
   <div class="modal-dialog">    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
           <h4 class="modal-title">
              <?php echo lang('Contact_Supplier'); ?>
           </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">  	
         <form class="theme-form" id="send_inquiry" method="post" enctype="multipart/form-data">
            <div class="form-row">
               
               <div class="col-md-6">
                  <label for="name"><?php echo lang('To'); ?></label>
                  <input type="text" class="form-control" id="inq_name" name="vender_name" value="<?php echo $product_detail[0]['first_name']; ?>" readonly >
                  <input type="hidden" name="seller_id" id="inq_seller_id" value="<?php echo en_de_crypt($product_detail[0]['seller_id']); ?>">
                  <input type="hidden" name="pid" value="<?php echo en_de_crypt($product_detail[0]['id']); ?>">
               </div>
               <div class="col-md-6">
                  <label for="email"><?php echo lang('Subject'); ?></label>
                  <input type="text" class="form-control space" id="inq_subject" placeholder="<?php echo lang('Subject'); ?>" name="subject" >
               </div>
               
               <div class="col-md-12">
                  <label for="inq_message"><?php echo lang('Message'); ?></label>
                  <textarea class="form-control message_text_are space" placeholder="<?php echo lang('Write_Your_Message'); ?>" id="inq_message" name="message" rows="6"></textarea>
               </div>
<!-- 
               <div class="col-md-12">
                  <label for="review">Attachments</label>
                  <div class="">
                     <div class="uplod_garg_pics">         

                        <div class="thum_view">
                           <div class="singl_img_up">
                              <img id="img-upload" src="">
                              https://i.insider.com/5cbf50dfd1a2f8074406a8b2?width=1100&format=jpeg&auto=webp
                              <a href=""> <i class="fa fa-times"></i> </a>
                           </div>
                        </div>

                        <div class="upld_pic_labl">
                           <input type="file" id="imgInp" name="document">
                           <div class="ad_grg_pic_titl"> Upload Pics </div>
                        </div>
                  </div>
                  </div>
               </div> -->


               <div class="col-md-12">
                  <button class="btn btn-solid" type="submit"><?php echo lang('Send'); ?></button>
               </div>
            </div>
         </form>
        </div>        
      </div>      
   </div>
</div>


<div class="modal fade detl_popup_as" id="detail_modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
         <h5 class="modal-title"><?php echo lang('Payment_Method'); ?></h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
         
           <label class="radio-inline">
             <input type="radio" name="modal_payment" value="<?php echo en_de_crypt('cash-on-del'); ?>"><?php echo lang('Virtual_Account_Transfer'); ?>
            </label>
           <label class="radio-inline">
            <input type="radio" name='modal_payment' value="<?php echo en_de_crypt('online'); ?>"><?php echo lang('Card'); ?>
           </label>
        </div>
         <div class="modal-footer">
            <button type="button" id="submit_model_btn" class="btn btn-default submt_btn_po_dt" data-dismiss="modal"><?php echo lang('aSubmit'); ?></button>
          <button type="button" class="btn btn-default clos_btn_pop_del" data-dismiss="modal"><?php echo lang('Close'); ?></button>
          
        </div> 
      </div>      
    </div>
  </div>






<script>
   function openSearch() {
       document.getElementById("search-overlay").style.display = "block";
   }
   
   function closeSearch() {
       document.getElementById("search-overlay").style.display = "none";
   }
</script>



<script src="<?php echo base_url(); ?>assets/frontend/js/setup.js"></script>

<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#img-upload').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imgInp").change(function() {
        readURL(this);
    });
</script>

<script type="text/javascript">
   $(document).on("submit","#send_inquiry",function(e){
      e.preventDefault();
      var inq_name = $("#inq_name").val();
      var inq_subject = $.trim($("#inq_subject").val());
      var inq_message = $.trim($("#inq_message").val());
      var inq_seller_id = $.trim($("#inq_seller_id").val());
      var error=1;

      if(inq_seller_id=='')
      {
         error=0;
         swal("","Please enter your subject","warning");
         return false;
      }

      if(inq_subject=='')
      {
         error=0;
         swal("","<?php echo lang('aPlease_enter_subject'); ?>","warning");
         return false;
      }

      if(inq_message=='')
      {
         error=0;
         swal("","<?php echo lang('aPlease_enter_message'); ?>","warning");
         return false;
      }

      if(error==1)
      {
          //alert('success');
         $('#loading').show();
         $.ajax({
            type: 'POST',
            url: "<?php echo base_url($language . '/chat/compose_data'); ?>",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(response)
            {
               $('#loading').hide();
               response=$.trim(response);
               var response = $.parseJSON(response);
               if(response.status==true)
               {
                // $("#hsc_error").hide();
                $("#send_inquiry")[0].reset();
                $('#cont_suuplr_tb').modal('hide');
                swal("",response.message,'success');
                // $("#append_compose").append(response.data)
               }else{
                swal("",response.message,'warning');
               }
            }
         });
      }      

   });
</script>

<script type="text/javascript">
   var g_rating=0;
   $(document).on("click",".get_star",function(){
      var id=$(this).data('id');
      g_rating=id;
      $(".get_star").removeClass("green");
      if(id==1)
      {
         $("#one").addClass('green');   
      }else if(id==2)
      {
         $("#one").addClass('green');   
         $("#two").addClass('green');   
      }else if(id==3)
      {
         $("#one").addClass('green');   
         $("#two").addClass('green');   
         $("#three").addClass('green');   
      }else if(id==4)
      {
         $("#one").addClass('green');   
         $("#two").addClass('green');   
         $("#three").addClass('green');   
         $("#four").addClass('green');   
      }else if(id==5)
      {
         $("#one").addClass('green');   
         $("#two").addClass('green');   
         $("#three").addClass('green');   
         $("#four").addClass('green');   
         $("#five").addClass('green');   
      }else{
         swal("","Something Went wrong","warning");
      }      
   });

   $(document).on("click","#btn_rating",function(){
      var rating_name=$.trim($("#rating_name").val());
      var rating_email=$.trim($("#rating_email").val());
      var rating_review=$.trim($("#rating_review").val());
      var error=1;
      if(g_rating==0)
      {
         error=0;
         swal("","<?php echo lang('Please_click_on_star'); ?>","warning");
         return false;
      }
      if(rating_name=='')
      {
         error=0;
         swal("","<?php echo lang('Please_enter_your_name'); ?>","warning");
         return false;
      }

      if(rating_email=='')
      {
         error=0;
         swal("","<?php echo lang('Please_enter_your_email'); ?>","warning");
         return false;
      }
      if(rating_email!='')
      {
         if(!isValidEmailAddress(rating_email))
         {             
            error=0;                
            swal("","<?php echo lang('Please_Enter_Valid_Email_Id'); ?>","warning");
            return false;
         }                  
      }

      if(rating_review=='')
      {
         error=0;
         swal("","<?php echo lang('Please_enter_your_review'); ?>","warning");
         return false;
      }

      if(error==1)
      {
         $('#loading').show(); 
         $.ajax({
            type: 'POST',
            url: "<?php echo base_url($language . '/ajax/rating_insert') ?>",
            data: {"name":rating_name,"email":rating_email,"comment":rating_review,"rating":g_rating,"pid":"<?php echo en_de_crypt($product_detail[0]['id']); ?>"},  
            success: function(response)
            {       
               $('#loading').hide(); 
               response=$.trim(response);
               if(response==1)
               {
                  swal("","<?php echo lang('Rating_submit_successfully'); ?>","success");
                  setTimeout(function(){ location.reload(); }, 1500);
               }else if(response=="pleas_login")
               {
                  swal("","<?php echo lang('Please_login'); ?>","warning")
               }
               else if(response=="please_buy")
               {
                  swal("<?php echo lang('You_cant_give'); ?>","<?php echo lang('look_like'); ?>","warning");
               }else if(response=="already")
               {
                  swal("","<?php echo lang('you_already'); ?>","warning");
               }else{
                  swal("","<?php echo lang('Something'); ?>","warning");
               }
            }
         });      
      }

   });   

   $(document).on("click","#detail_buynow",function(){
      $("#payment_mode").val('');
      $('input[name=modal_payment]').prop('checked', false);
      $('#detail_modal').modal('show');
   });

   $(document).on("click","#submit_model_btn",function(){
       var modal_payment=$('input[name=modal_payment]:checked').val();
       var error=1;    
       if(typeof modal_payment === "undefined" ) 
       {
           swal("","<?php echo lang('Select_Payment_Option'); ?>","warning");
           error=0;
           return false;
       }else{
         $("#payment_mode").val(modal_payment);
         $('form#buynow_form').submit();
       }
   });

   
</script>

<script type="text/javascript">
  $(document).on("click",".contsuplrbtn",function(){    
    $('#loading').show();
    $.ajax({
        type: 'POST',  
        url: '<?php echo base_url($language . '/ajax/login_check') ?>',
        data: {is_user:"user"},
        success: function(response)
        { 
          $('#loading').hide();
          response=$.trim(response);
          if(response==1)
          {
            $('#cont_suuplr_tb').modal('show');
          }else{
            $('#cont_suuplr_tb').modal('hide');
            login_swal();
          }
        }
   });
});    
</script>    



<style type="text/css">
      .revewsectiona{
         margin-bottom: 10px !important;

      }

      .detl_page_wrap .collection-wrapper .container_detl_wdth, .container_detl_wdth{
         padding: 20px !important;
      }

      .no-arrow .slick-next, .no-arrow .slick-prev {
    background: #4d4d4d;
    z-index: 9999;
}

.hdline_prodct {
    font-size: 22px;
    font-weight: 500;
    text-transform: uppercase;
    margin-left: 6px;
    margin-bottom: 14px;
    margin-top: 7px;
    color: #3f006f;
}


</style>