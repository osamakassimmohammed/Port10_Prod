<br><br><br>
<style type="text/css">
.hide_data{
    display: none;
}
.show_data{
    display: block;
  }
</style>
<?php
 if(!empty($product_data)){
  $hide="hide_data";
 }else {
  $hide="show_data";
 } ?>
<section class="compare-section section-b-space ratio_asos">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cmpr_prdct_hdline">
                        Compare Products
                    </div>
                    <h1 class="<?php echo $hide; ?> text-center text-danger show_compare"><?php echo lang('Your_compare_product_is_empty'); ?></h1>
                    <div class="slide-4 no-arrow">
                        <?php if(!empty($product_data)){ 
                            foreach ($product_data as $product_key => $product_value) { ?>
                        <div class="hide_compare<?php echo $product_value['id']; ?>">
                            <div class="compare-part">
                                <button type="button" class="close-btn remove_compare" data-id="<?php echo $product_value['id']; ?>"  >
                                    <span aria-hidden="true">×</span>
                                </button>
                                <div class="img-secton">
                                    <div>
                                        <img src="<?php echo base_url("assets/admin/products/").$product_value['product_image']; ?>" class="img-fluid blur-up lazyload bg-img"
                                            alt="">
                                    </div>
                                    <a href="<?php echo base_url($language.'/home/detail/').$product_value['id']; ?>">
                                        <h5><?php echo $product_value['product_name']; ?></h5>
                                    </a>
                                    <h5 class="pric_cmpr" ><?php echo $currency_symbol; ?> <?php echo $product_value['sale_price']; ?></h5>
                                </div>
                                <div class="detail-part">
                                    <div class="title-detail">
                                        <h5>description</h5>
                                    </div>
                                    <div class="inner-detail">
                                        <p><?php echo $product_value['short_description']; ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="detail-part">
                                    <div class="title-detail">
                                        <h5>Brand Name</h5>
                                    </div>
                                    <div class="inner-detail">
                                        <p><?php echo $product_value['brand_name']; ?></p>
                                    </div>
                                </div>
                                <div class="detail-part">
                                    <div class="title-detail">
                                        <h5>Category</h5>
                                    </div>
                                    <div class="inner-detail">
                                        <p><?php echo $product_value['category_name']; ?></p>
                                    </div>
                                </div>
                                <div class="detail-part">
                                    <div class="title-detail">
                                        <h5>Unit</h5>
                                    </div>
                                    <div class="inner-detail">
                                        <p>Unit type</p>
                                        <?php if(!empty($product_value['unit_list'])) { ?>
                                        <select class="form-control select_unit get_unit<?php echo $product_key; ?>">
                                            <?php
                                            foreach ($product_value['unit_list'] as $uld_key => $uld_value) { ?>
                                            <option data-id="<?php echo $uld_value['id'] ?>" ><?php echo $uld_value['unit_name']; ?></option>
                                            <?php  } ?>
                                        </select>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php if(isset($product_value['meta_data']) && !empty($product_value['meta_data']) ) { ?>
                                <div class="detail-part">
                                    <div class="title-detail">
                                        <h5>Size</h5>
                                    </div>
                                    <div class="inner-detail">
                                        <select class="form-control select_size get_size<?php echo $product_key; ?>">
                                            <option value="0">Select Size</option>
                                            <?php  foreach ($product_value['meta_data'] as $md_key => $md_val) { ?>
                                            <option data-price="<?php echo $md_val['price']; ?>" data-value="<?php echo $md_val['size']; ?>" value="<?php echo $md_val['item_id']; ?>"><?php echo $md_val['size']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="detail-part">
                                    <div class="title-detail">
                                        <h5>Weight</h5>
                                    </div>
                                    <div class="inner-detail">
                                        <p><?php echo $product_value['weight']; ?></p>
                                    </div>
                                </div>
                                <div class="detail-part">
                                    <div class="title-detail">
                                        <h5>Length</h5>
                                    </div>
                                    <div class="inner-detail">
                                        <p><?php echo $product_value['length']; ?></p>
                                    </div>
                                </div>
                                <div class="detail-part">
                                    <div class="title-detail">
                                        <h5>Width</h5>
                                    </div>
                                    <div class="inner-detail">
                                        <p><?php echo $product_value['width']; ?></p>
                                    </div>
                                </div>
                                <div class="detail-part">
                                    <div class="title-detail">
                                        <h5>Height</h5>
                                    </div>
                                    <div class="inner-detail">
                                        <p><?php echo $product_value['height']; ?></p>
                                    </div>
                                </div>
                                <div class="detail-part">
                                    <div class="title-detail">
                                        <h5>availability</h5>
                                    </div>
                                    <div class="inner-detail">
                                        <?php if($product_value['is_stock']==1){ ?>
                                            <p class="">
                                                <?php echo lang('In_Stock'); ?>
                                            </p>
                                        <?php }else{ ?>
                                         <p class="">
                                            <?php echo lang('Out_Stock'); ?>
                                         </p>
                                        <?php } ?>                                        
                                    </div>
                                </div>
                                <div class="btn-part">
                                    <?php if($product_value['price_select']=='1') { ?>
                                        <button title="<?php echo lang('Add_to_cart'); ?>" data-id="<?php echo $product_value['id']; ?>" data-unit="get_unit<?php echo $product_key; ?>" data-detislqty="<?php echo $product_value['min_order_quantity']; ?>" class="add_to_cart2">
                                        <i class="ti-shopping-cart"></i> <?php echo lang('Add_to_cart'); ?>
                                        </button>
                                        <?php }else{ ?>
                                        <button title="<?php echo lang('Add_to_cart'); ?>"data-class="get_size<?php echo $product_key; ?>" data-id="<?php echo $product_value['id']; ?>" data-unit="get_unit<?php echo $product_key; ?>" data-detislqty="<?php echo $product_value['min_order_quantity']; ?>" class="add_to_cart2">
                                        <i class="ti-shopping-cart"></i> <?php echo lang('Add_to_cart'); ?>
                                        </button>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php } } ?>

                         
                    </div>
                </div>
            </div>
        </div>
    </section>
<script type="text/javascript">
    $(document).on("click",".remove_compare",function(){
        var pid=$(this).data('id');
        thisa = $(this);        
        add_remove_compare(pid,'remove',thisa,'compare');
    });
</script>

    <style type="text/css">
        
        .compare-section .compare-part .img-secton a h5 {
    margin-bottom: 0;
    text-transform: capitalize;
    margin-top: 10px;
    font-size: 16px;
    letter-spacing: 0px;
    margin-bottom: 3px;
    text-align: center;
}

.pric_cmpr {
    color: #000;
    font-weight: 500;
    font-size: 17px;
}

.compare-section .compare-part .detail-part .inner-detail p {
    margin-bottom: 0;
    line-height: 1.2;
    letter-spacing: 0;
    text-align: center;
    font-size: 14px;
    color: #444;
    font-weight: 500;
}

.compare-section .compare-part .detail-part .title-detail h5 {
    margin-bottom: 0;
    text-transform: uppercase;
    font-size: 16px;
    font-weight: 500;
    color: #000;
        text-align: center;
}

.compare-section .compare-part .img-secton h5{
    text-align: center;
}

.no-arrow .slick-next, .no-arrow .slick-prev {
    background: #4d4d4d;
    z-index: 99;
}

.cmpr_prdct_hdline{
        width: 100%;
    text-align: center;
    margin-bottom: 20px;
    font-size: 22px;
    text-transform: uppercase;
    font-weight: 500;
    color: #3f006f;
    margin-top: -10px;
}
}


    </style>