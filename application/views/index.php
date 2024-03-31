<style type="text/css">
    li.home {
        background: #fd3a58;

        border-radius: 100px;
    }


    .contnr_main_headr {

        height: 70px;
        margin-bottom: -1px;
    }


</style>

<div class="row" style="margin: 0px;">
    <!-- <nav id="main-nav"> -->
    <!-- <div class="toggle-nav"><i class="fa fa-bars sidebar-bar"></i></div>
    <ul id="main-menu" class="sm pixelstrap sm-horizontal">
        <li>
            <div class="mobile-back text-right">Back<i class="fa fa-angle-right pl-2"
            aria-hidden="true"></i></div>
        </li>
    </ul> -->
    <div class="col-sm-3"></div>
    <div class="col-sm-7 serch_2">
        <div class="serch_hdr">
            <form action="" method="GET" id="form_search" style="">
                <?php
                if (isset($search)) {
                    $search = $search;
                } else {
                    $search = '';
                } ?>
                <div class="serch_left_a">
                    <input type="text" id="form_search_val" name="search" placeholder=""
                           value="<?php echo $search; ?>" autocomplete="off">
                    <?php $form_catid = isset($_GET['m_catid']) ? $_GET['m_catid'] : 0; ?>
                    <div class="dropdown dropdown_new_as">
                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                id="dropdownMenuButton" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                            <span
                                id='hsearch_name'><?php echo lang('Select_Category'); ?> </span>
                        </button>
                        <?php if (!empty($main_category)) { ?>

                            <div class="dropdown-menu"
                                 aria-labelledby="dropdownMenuButton">
                                <?php foreach ($main_category as $mc_key => $mc_val) {
                                    $lis_selected1 = '';
                                    if ($mc_val['id'] == $form_catid) {
                                        $lis_selected1 = "selected";
                                    } ?>
                                    <a class="dropdown-item hselect_cat"
                                       href="javascript:void(0)"
                                       data-name="<?php echo $mc_val['display_name']; ?>"
                                       data-id="<?php echo $mc_val['id']; ?>"><?php echo $mc_val['display_name']; ?></a>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>

                </div>
                <button class="serch_btn_right"><i class="fa fa-search"
                                                   aria-hidden="true"></i></button>
                <div class="clear"></div>
            </form>
        </div>
        <!-- <div id="hspro_list" style="display: none;margin-left: 215px" >fadsf dfasdf</div> -->
    </div>
    <div class="col-sm-2"></div>
    <!-- </nav> -->
</div>


<style type="text/css">
    .home_active {
        font-weight: 600 !important;
        color: #c09550 !important;
    }
</style>


<!-- Home slider -->
<section class="p-0 home_slider_a">
    <div class=" ">
        <div class="header_wrap_main_sld" style="padding:0px;">
            <div class="slide-1 home-slider">
                <?php if (!empty($banner_data)) {
                    foreach ($banner_data as $bd_key => $bd_val) { ?>
                        <div>
                            <div class="home  text-center">
                                <img
                                    src="<?php echo base_url('assets/admin/banner/') . $bd_val['image']; ?>"
                                    alt="" class="bg-img blur-up lazyload">
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            <div class="slider-contain">

                                                <div class="wrp_shop_nw">

                                                    <div class="welc_po1">
                                                        <?php echo $bd_val['heading1']; ?>
                                                    </div>
                                                    <a href="<?php echo base_url($language . '/home/listing/') . $bd_val['main_cat']; ?>"
                                                       class="btn btn-solid"><?php echo lang('shop_now'); ?></a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                } else { ?>
                    <h2 class="text-center text-danger">Will Update Banner</h2>
                <?php } ?>

            </div>

            <div class="specl_prdct_a">
                <div class="title1 section-t-space">
                    <!-- <h4>exclusive products</h4> -->
                    <h2 class="title-inner1"><?php echo lang('Best_Sellers'); ?></h2>
                </div>
                <section class="section-b-space p-t-0 ratio_asos section_tw_home">

                    <div class="wrap_slider_4">
                        <div class="row">
                            <div class="col">
                                <div class="tab-content-cls">
                                    <div class="tab-content active default">
                                        <div class="no-slider row">
                                            <?php $i = 1;
                                            if (!empty($adds_product)) {
                                                foreach ($adds_product as $product_key => $product_value) { ?>
                                                    <div class="product-box">
                                                        <div class="img-wrapper">
                                                            <div class="front">
                                                                <a href="#"><img
                                                                        src="<?php echo base_url("assets/admin/products/") . $product_value['product_image']; ?>"
                                                                        class="img-fluid blur-up lazyload bg-img"
                                                                        alt=""></a>
                                                            </div>
                                                            <div class="back">
                                                                <a href="<?php echo base_url($language . '/home/detail/') . $product_value['id']; ?>"><img
                                                                        src="<?php echo base_url("assets/admin/products/") . $product_value['product_image']; ?>"
                                                                        class="img-fluid blur-up lazyload bg-img"
                                                                        alt=""></a>
                                                            </div>
                                                            <div
                                                                class="cart-info cart-wrap">


                                                            </div>
                                                        </div>
                                                        <div class="product-detail">
                                                            <?php if (!empty($product_value['unit_list'])) { ?>
                                                                <select
                                                                    class="form-control select_unit get_unit<?php echo $i; ?>">
                                                                    <?php
                                                                    foreach ($product_value['unit_list'] as $uld_key => $uld_value) { ?>
                                                                        <option
                                                                            data-id="<?php echo $uld_value['id'] ?>"><?php echo $uld_value['unit_name']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            <?php } ?>
                                                            <?php if (isset($product_value['meta_data']) && !empty($product_value['meta_data'])) { ?>
                                                                <select
                                                                    class="form-control select_size get_size<?php echo $i; ?>">
                                                                    <option value="0">
                                                                        Select Size
                                                                    </option>
                                                                    <?php foreach ($product_value['meta_data'] as $md_key => $md_val) { ?>
                                                                        <option
                                                                            data-price="<?php echo $md_val['price']; ?>"
                                                                            data-value="<?php echo $md_val['size']; ?>"
                                                                            value="<?php echo $md_val['item_id']; ?>"><?php echo $md_val['size']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            <?php } ?>
                                                            <div>
                                                                <!-- <div class="new_rating">
                                      <?php echo $product_value['rating_element']; ?>
                                    </div> -->
                                                                <a href="<?php echo base_url($language . '/home/detail/') . $product_value['id']; ?>">
                                                                    <h6><?php echo $product_value['product_name']; ?></h6>
                                                                </a>
                                                                <span
                                                                    class="wish_l wishlist<?php echo $product_value['id']; ?>">
                                      <?php if ($product_value['wish_list'] == 1) { ?>
                                          <a href="javascript:void(0)"
                                             onclick="remove_cart(<?php echo $product_value['id']; ?>)"><i
                                                  class="ti-heart"
                                                  aria-hidden="true"></i></a>
                                      <?php } else { ?>
                                          <a href="javascript:void(0)"
                                             onclick="move_to_wish_list(<?php echo $product_value['id']; ?>)">
                                        <i class="ti-heart" aria-hidden="true"></i></a>
                                      <?php } ?>
                                     </span>

                                                                <h4><?php echo $currency_symbol; ?><?php echo $product_value['sale_price']; ?> </h4>
                                                                <ul class="color-variant">
                                                                    <li class="bg-light0"></li>
                                                                    <li class="bg-light1"></li>
                                                                    <li class="bg-light2"></li>
                                                                </ul>

                                                                <?php if ($product_value['price_select'] == '1') { ?>
                                                                    <button
                                                                        title="<?php echo lang('Add_to_cart'); ?>"
                                                                        data-id="<?php echo $product_value['id']; ?>"
                                                                        data-unit="get_unit<?php echo $i; ?>"
                                                                        data-detislqty="<?php echo $product_value['min_order_quantity']; ?>"
                                                                        class="add_to_cart2">
                                                                        <i class="ti-shopping-cart"></i> <?php echo lang('Add_to_cart'); ?>
                                                                    </button>
                                                                <?php } else { ?>
                                                                    <button
                                                                        title="<?php echo lang('Add_to_cart'); ?>"
                                                                        data-class="get_size<?php echo $i; ?>"
                                                                        data-id="<?php echo $product_value['id']; ?>"
                                                                        data-unit="get_unit<?php echo $i; ?>"
                                                                        data-detislqty="<?php echo $product_value['min_order_quantity']; ?>"
                                                                        class="add_to_cart2">
                                                                        <i class="ti-shopping-cart"></i> <?php echo lang('Add_to_cart'); ?>
                                                                    </button>
                                                                <?php } ?>
                                                                <div class="wrp_cmpr_2">
                                                                    <label>
                                                                        <input
                                                                            type="checkbox"
                                                                            class="add_check2 compare_ck"
                                                                            value="<?php echo $product_value['id']; ?>" <?php echo $product_value['is_compare']; ?>>
                                                                        <div
                                                                            class="ad_cmpr_tex2"> <?php echo lang('Add_To_Compare'); ?> </div>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php }
                                                $i++;
                                            } else { ?>
                                                <h2 class="text-danger text-center"><?php echo lang('Product_Not_Found'); ?></h2>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Tab product end -->
            </div>

        </div>
</section>
<!-- Home slider end -->
<!-- collection banner -->
<!-- Tab product -->
<div class="specl_prdct_a specl_prdct_a1">
    <div class="title1 section-t-space">
        <!-- <h4>exclusive products</h4> -->
        <h2 class="title-inner1"><?php echo lang('LISTED_PRODUCTS'); ?></h2>
    </div>
    <section class="section-b-space p-t-0 ratio_asos section_tw_home">

        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="theme-tab">
                        <ul class="tabs tab-title">
                            <li class="current"><a
                                    href="tab-4"><?php echo lang('New_Products'); ?></a>
                            </li>
                            <li class=""><a
                                    href="tab-5"><?php echo lang('Featured_Products'); ?></a>
                            </li>
                            <li class=""><a
                                    href="tab-6"><?php echo lang('Best_Sellers'); ?></a>
                            </li>
                        </ul>
                        <div class="tab-content-cls">

                            <div id="tab-4" class="tab-content active default">
                                <div class="no-slider row">
                                    <?php
                                    $i = 100;
                                    if (!empty($product_data)) {
                                        foreach ($product_data as $product_key => $product_value) { ?>
                                            <div class="product-box">
                                                <div class="img-wrapper">
                                                    <div class="front">
                                                        <a href="#"><img
                                                                src="<?php echo base_url("assets/admin/products/") . $product_value['product_image']; ?>"
                                                                class="img-fluid blur-up lazyload bg-img"
                                                                alt=""></a>
                                                    </div>
                                                    <div class="back">
                                                        <a href="<?php echo base_url($language . '/home/detail/') . $product_value['id']; ?>"><img
                                                                src="<?php echo base_url("assets/admin/products/") . $product_value['product_image']; ?>"
                                                                class="img-fluid blur-up lazyload bg-img"
                                                                alt=""></a>
                                                    </div>
                                                    <div class="cart-info cart-wrap">


                                                    </div>
                                                </div>
                                                <div class="product-detail">
                                                    <?php if (!empty($product_value['unit_list'])) { ?>
                                                        <select
                                                            class="form-control select_unit get_unit<?php echo $i; ?>">
                                                            <?php
                                                            foreach ($product_value['unit_list'] as $uld_key => $uld_value) { ?>
                                                                <option
                                                                    data-id="<?php echo $uld_value['id'] ?>"><?php echo $uld_value['unit_name']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    <?php } ?>
                                                    <?php if (isset($product_value['meta_data']) && !empty($product_value['meta_data'])) { ?>
                                                        <select
                                                            class="form-control select_size get_size<?php echo $i; ?>">
                                                            <option value="0">Select
                                                                Size
                                                            </option>
                                                            <?php foreach ($product_value['meta_data'] as $md_key => $md_val) { ?>
                                                                <option
                                                                    data-price="<?php echo $md_val['price']; ?>"
                                                                    data-value="<?php echo $md_val['size']; ?>"
                                                                    value="<?php echo $md_val['item_id']; ?>"><?php echo $md_val['size']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    <?php } ?>
                                                    <div>
                                                        <!-- <div class="new_rating">
                                      <?php echo $product_value['rating_element']; ?>
                                    </div> -->
                                                        <a href="<?php echo base_url($language . '/home/detail/') . $product_value['id']; ?>">
                                                            <h6><?php echo $product_value['product_name']; ?></h6>
                                                        </a>
                                                        <span
                                                            class="wish_l wishlist<?php echo $product_value['id']; ?>">
                                      <?php if ($product_value['wish_list'] == 1) { ?>
                                          <a href="javascript:void(0)"
                                             onclick="remove_cart(<?php echo $product_value['id']; ?>)"><i
                                                  class="ti-heart"
                                                  aria-hidden="true"></i></a>
                                      <?php } else { ?>
                                          <a href="javascript:void(0)"
                                             onclick="move_to_wish_list(<?php echo $product_value['id']; ?>)">
                                        <i class="ti-heart" aria-hidden="true"></i></a>
                                      <?php } ?>
                                     </span>

                                                        <h4><?php echo $currency_symbol; ?><?php echo $product_value['sale_price']; ?> </h4>
                                                        <ul class="color-variant">
                                                            <li class="bg-light0"></li>
                                                            <li class="bg-light1"></li>
                                                            <li class="bg-light2"></li>
                                                        </ul>

                                                        <?php if ($product_value['price_select'] == '1') { ?>
                                                            <button
                                                                title="<?php echo lang('Add_to_cart'); ?>"
                                                                data-id="<?php echo $product_value['id']; ?>"
                                                                data-unit="get_unit<?php echo $i; ?>"
                                                                data-detislqty="<?php echo $product_value['min_order_quantity']; ?>"
                                                                class="add_to_cart2">
                                                                <i class="ti-shopping-cart"></i> <?php echo lang('Add_to_cart'); ?>
                                                            </button>
                                                        <?php } else { ?>
                                                            <button
                                                                title="<?php echo lang('Add_to_cart'); ?>"
                                                                data-class="get_size<?php echo $i; ?>"
                                                                data-id="<?php echo $product_value['id']; ?>"
                                                                data-unit="get_unit<?php echo $i; ?>"
                                                                data-detislqty="<?php echo $product_value['min_order_quantity']; ?>"
                                                                class="add_to_cart2">
                                                                <i class="ti-shopping-cart"></i> <?php echo lang('Add_to_cart'); ?>
                                                            </button>
                                                        <?php } ?>
                                                        <div class="wrp_cmpr_2">
                                                            <label>
                                                                <input type="checkbox"
                                                                       class="add_check2 compare_ck"
                                                                       value="<?php echo $product_value['id']; ?>" <?php echo $product_value['is_compare']; ?>>
                                                                <div
                                                                    class="ad_cmpr_tex2"> <?php echo lang('Add_To_Compare'); ?> </div>
                                                            </label>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        <?php }
                                        $i++;
                                    } else { ?>
                                        <h2 class="text-danger text-center"><?php echo lang('Product_Not_Found'); ?></h2>
                                    <?php } ?>
                                </div>
                            </div>

                            <div id="tab-5" class="tab-content">
                                <div class="no-slider row">
                                    <?php
                                    if (!empty($featured_data)) {
                                        foreach ($featured_data as $product_key => $product_value) { ?>
                                            <div class="product-box">
                                                <div class="img-wrapper">
                                                    <div class="front">
                                                        <a href="#"><img
                                                                src="<?php echo base_url("assets/admin/products/") . $product_value['product_image']; ?>"
                                                                class="img-fluid blur-up lazyload bg-img"
                                                                alt=""></a>
                                                    </div>
                                                    <div class="back">
                                                        <a href="<?php echo base_url($language . '/home/detail/') . $product_value['id']; ?>"><img
                                                                src="<?php echo base_url("assets/admin/products/") . $product_value['product_image']; ?>"
                                                                class="img-fluid blur-up lazyload bg-img"
                                                                alt=""></a>
                                                    </div>
                                                    <div class="cart-info cart-wrap">


                                                    </div>
                                                </div>
                                                <div class="product-detail">
                                                    <?php if (!empty($product_value['unit_list'])) { ?>
                                                        <select
                                                            class="form-control select_unit get_unit<?php echo $i; ?>">
                                                            <?php
                                                            foreach ($product_value['unit_list'] as $uld_key => $uld_value) { ?>
                                                                <option
                                                                    data-id="<?php echo $uld_value['id'] ?>"><?php echo $uld_value['unit_name']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    <?php } ?>
                                                    <?php if (isset($product_value['meta_data']) && !empty($product_value['meta_data'])) { ?>
                                                        <select
                                                            class="form-control select_size get_size<?php echo $i; ?>">
                                                            <option value="0">Select
                                                                Size
                                                            </option>
                                                            <?php foreach ($product_value['meta_data'] as $md_key => $md_val) { ?>
                                                                <option
                                                                    data-price="<?php echo $md_val['price']; ?>"
                                                                    data-value="<?php echo $md_val['size']; ?>"
                                                                    value="<?php echo $md_val['item_id']; ?>"><?php echo $md_val['size']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    <?php } ?>
                                                    <div>
                                                        <!-- <div class="new_rating">
                                      <?php echo $product_value['rating_element']; ?>
                                    </div> -->
                                                        <a href="<?php echo base_url($language . '/home/detail/') . $product_value['id']; ?>">
                                                            <h6><?php echo $product_value['product_name']; ?></h6>
                                                        </a>

                                                        <span
                                                            class="wish_l wishlist<?php echo $product_value['id']; ?>">
                                      <?php if ($product_value['wish_list'] == 1) { ?>
                                          <a href="javascript:void(0)"
                                             onclick="remove_cart(<?php echo $product_value['id']; ?>, 1)"><i
                                                  class="ti-heart"
                                                  aria-hidden="true"></i></a>
                                      <?php } else { ?>
                                          <a href="javascript:void(0)"
                                             onclick="move_to_wish_list(<?php echo $product_value['id']; ?>, 1)"><i
                                                  class="ti-heart"
                                                  aria-hidden="true"></i></a>
                                      <?php } ?>
                                     </span>

                                                        <h4><?php echo $currency_symbol; ?><?php echo $product_value['sale_price']; ?></h4>

                                                        <?php if ($product_value['price_select'] == '1') { ?>
                                                            <button
                                                                title="<?php echo lang('Add_to_cart'); ?>"
                                                                data-id="<?php echo $product_value['id']; ?>"
                                                                data-unit="get_unit<?php echo $i; ?>"
                                                                data-detislqty="<?php echo $product_value['min_order_quantity']; ?>"
                                                                class="add_to_cart2">
                                                                <i class="ti-shopping-cart"></i> <?php echo lang('Add_to_cart'); ?>
                                                            </button>
                                                        <?php } else { ?>
                                                            <button
                                                                title="<?php echo lang('Add_to_cart'); ?>"
                                                                data-class="get_size<?php echo $i; ?>"
                                                                data-id="<?php echo $product_value['id']; ?>"
                                                                data-unit="get_unit<?php echo $i; ?>"
                                                                data-detislqty="<?php echo $product_value['min_order_quantity']; ?>"
                                                                class="add_to_cart2">
                                                                <i class="ti-shopping-cart"></i> <?php echo lang('Add_to_cart'); ?>
                                                            </button>
                                                        <?php } ?>
                                                        <div class="wrp_cmpr_2">
                                                            <label>
                                                                <input type="checkbox"
                                                                       class="add_check2 compare_ck"
                                                                       value="<?php echo $product_value['id']; ?>" <?php echo $product_value['is_compare']; ?>>
                                                                <div
                                                                    class="ad_cmpr_tex2"> <?php echo lang('Add_To_Compare'); ?> </div>
                                                            </label>
                                                        </div>
                                                        <ul class="color-variant">
                                                            <li class="bg-light0"></li>
                                                            <li class="bg-light1"></li>
                                                            <li class="bg-light2"></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }
                                        $i++;
                                    } else { ?>
                                        <h2 class="text-danger text-center"><?php echo lang('Product_Not_Found'); ?></h2>
                                    <?php } ?>
                                </div>
                            </div>
                            <div id="tab-6" class="tab-content">
                                <div class="no-slider row">
                                    <?php
                                    if (!empty($best_seller)) {
                                        foreach ($best_seller as $product_key => $product_value) { ?>
                                            <div class="product-box">
                                                <div class="img-wrapper">
                                                    <div class="front">
                                                        <a href="#"><img
                                                                src="<?php echo base_url("assets/admin/products/") . $product_value['product_image']; ?>"
                                                                class="img-fluid blur-up lazyload bg-img"
                                                                alt=""></a>
                                                    </div>
                                                    <div class="back">
                                                        <a href="<?php echo base_url($language . '/home/detail/') . $product_value['id']; ?>"><img
                                                                src="<?php echo base_url("assets/admin/products/") . $product_value['product_image']; ?>"
                                                                class="img-fluid blur-up lazyload bg-img"
                                                                alt=""></a>
                                                    </div>
                                                    <div class="cart-info cart-wrap">


                                                    </div>
                                                </div>
                                                <div class="product-detail">
                                                    <?php if (!empty($product_value['unit_list'])) { ?>
                                                        <select
                                                            class="form-control select_unit get_unit<?php echo $i; ?>">
                                                            <?php
                                                            foreach ($product_value['unit_list'] as $uld_key => $uld_value) { ?>
                                                                <option
                                                                    data-id="<?php echo $uld_value['id'] ?>"><?php echo $uld_value['unit_name']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    <?php } ?>
                                                    <?php if (isset($product_value['meta_data']) && !empty($product_value['meta_data'])) { ?>
                                                        <select
                                                            class="form-control select_size get_size<?php echo $i; ?>">
                                                            <option value="0">Select
                                                                Size
                                                            </option>
                                                            <?php foreach ($product_value['meta_data'] as $md_key => $md_val) { ?>
                                                                <option
                                                                    data-price="<?php echo $md_val['price']; ?>"
                                                                    data-value="<?php echo $md_val['size']; ?>"
                                                                    value="<?php echo $md_val['item_id']; ?>"><?php echo $md_val['size']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    <?php } ?>
                                                    <div>
                                                        <!-- <div class="new_rating">
                                      <?php echo $product_value['rating_element']; ?>
                                    </div> -->
                                                        <a href="<?php echo base_url($language . '/home/detail/') . $product_value['id']; ?>">
                                                            <h6><?php echo $product_value['product_name']; ?></h6>
                                                        </a>

                                                        <span
                                                            class="wish_l wishlist<?php echo $product_value['id']; ?>">
                                      <?php if ($product_value['wish_list'] == 1) { ?>
                                          <a href="javascript:void(0)"
                                             onclick="remove_cart(<?php echo $product_value['id']; ?>, 1)"><i
                                                  class="ti-heart"
                                                  aria-hidden="true"></i></a>
                                      <?php } else { ?>
                                          <a href="javascript:void(0)"
                                             onclick="move_to_wish_list(<?php echo $product_value['id']; ?>, 1)"><i
                                                  class="ti-heart"
                                                  aria-hidden="true"></i></a>
                                      <?php } ?>
                                     </span>

                                                        <h4><?php echo $currency_symbol; ?><?php echo $product_value['sale_price']; ?></h4>

                                                        <?php if ($product_value['price_select'] == '1') { ?>
                                                            <button
                                                                title="<?php echo lang('Add_to_cart'); ?>"
                                                                data-id="<?php echo $product_value['id']; ?>"
                                                                data-unit="get_unit<?php echo $i; ?>"
                                                                data-detislqty="<?php echo $product_value['min_order_quantity']; ?>"
                                                                class="add_to_cart2">
                                                                <i class="ti-shopping-cart"></i> <?php echo lang('Add_to_cart'); ?>
                                                            </button>
                                                        <?php } else { ?>
                                                            <button
                                                                title="<?php echo lang('Add_to_cart'); ?>"
                                                                data-class="get_size<?php echo $i; ?>"
                                                                data-id="<?php echo $product_value['id']; ?>"
                                                                data-unit="get_unit<?php echo $i; ?>"
                                                                data-detislqty="<?php echo $product_value['min_order_quantity']; ?>"
                                                                class="add_to_cart2">
                                                                <i class="ti-shopping-cart"></i> <?php echo lang('Add_to_cart'); ?>
                                                            </button>
                                                        <?php } ?>
                                                        <div class="wrp_cmpr_2">
                                                            <label>
                                                                <input type="checkbox"
                                                                       class="add_check2 compare_ck"
                                                                       value="<?php echo $product_value['id']; ?>" <?php echo $product_value['is_compare']; ?>>
                                                                <div
                                                                    class="ad_cmpr_tex2"> <?php echo lang('Add_To_Compare'); ?> </div>
                                                            </label>
                                                        </div>

                                                        <ul class="color-variant">
                                                            <li class="bg-light0"></li>
                                                            <li class="bg-light1"></li>
                                                            <li class="bg-light2"></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }
                                        $i++;
                                    } else { ?>
                                        <h2 class="text-danger text-center"><?php echo lang('Product_Not_Found'); ?></h2>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Tab product end -->
</div>
<!-- Product slider end -->

