<link
    href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&family=Roboto:wght@300;400;500;700&display=swap"
    rel="stylesheet">
<!-- Icons -->
<link rel="stylesheet" type="text/css"
      href="<?php echo base_url(); ?>assets/frontend/css/fontawesome.css">
<!--Slick slider css-->
<link rel="stylesheet" type="text/css"
      href="<?php echo base_url(); ?>assets/frontend/css/slick.css">
<link rel="stylesheet" type="text/css"
      href="<?php echo base_url(); ?>assets/frontend/css/slick-theme.css">
<!-- Animate icon -->
<link rel="stylesheet" type="text/css"
      href="<?php echo base_url(); ?>assets/frontend/css/animate.css">
<!-- Themify icon -->
<link rel="stylesheet" type="text/css"
      href="<?php echo base_url(); ?>assets/frontend/css/themify-icons.css">
<!-- Bootstrap css -->
<link rel="stylesheet" type="text/css"
      href="<?php echo base_url(); ?>assets/frontend/css/bootstrap.css">
<!-- Theme css -->
<link rel="stylesheet" type="text/css"
      href="<?php echo base_url(); ?>assets/frontend/css/color1.css" media="screen"
      id="color">
<!-- latest jquery-->
<script src="<?php echo base_url(); ?>assets/frontend/js/jquery-3.3.1.min.js"></script>
<style type="text/css">
    #loading {
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        position: fixed;
        display: block;
        opacity: 0.7;
        background-color: #fff;
        z-index: 9999;
        text-align: center;
    }

    #loading-image {
        position: absolute;
        top: 250px;
        left: 630px;
        z-index: 100;
    }
</style>
<div id="loading" style="display: none">
    <img id="loading-image"
         src="<?php echo base_url('assets/admin/images/'); ?>loaders.gif"
         alt="Loading..."/>
</div>
<!-- header start -->

<div class="wrap_quot" data-toggle="modal" data-target="#quotation"
     style="display: none;">
    <!-- Request for Quotation  -->
    <img src="<?php echo base_url(); ?>assets/frontend/images/reqst.png">
</div>

<header>
    <div class="mobile-fix-option"></div>
    <div class="top-header">
        <div class="container top_hedr_contr">
            <div class="row">
                <div class="col-lg-4">
                    <div class="header-contact wow " data-wow-duration="3s"
                         data-wow-delay="0s"
                         style="visibility: visible; animation-duration: 3s; animation-delay: 0s;">
                        <ul>

                            <li>
                                <a style="color:white"
                                   href="tel:<?php echo @$footer_content[0]['mobile_no']; ?>"><img
                                        src="<?php echo base_url(); ?>assets/frontend/images/call.png"
                                        class="num_con_a"><?php echo @$footer_content[0]['mobile_no']; ?>
                                </a></li>

                            <li>
                                <a style="color:white"
                                   href="mailto:<?php echo @$footer_content[0]['email_id']; ?>"><img
                                        src="<?php echo base_url(); ?>assets/frontend/images/mail.png"
                                        class="num_con_a"><?php echo @$footer_content[0]['email_id']; ?>
                                </a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-2">
                    <!-- <div class="serch_hdr">
                       <div class="serch_left_a">
                       <input type="text" name="" placeholder="Search For Product...">
                       <select>
                          <option>Food</option>
                       </select>
                       </div>

                       <a class="serch_btn_right" href="">
                          <i class="fa fa-search" aria-hidden="true"></i>
                       </a>
                       <div class="clear"></div>
                    </div> -->
                </div>
                <div class="col-lg-6 text-right wow " data-wow-duration="3s"
                     data-wow-delay="0s"
                     style="visibility: visible; animation-duration: 3s; animation-delay: 0s;">
                    <ul class="header-dropdown wrap_main_right">
                        <?php $uid = $this->session->userdata('uid'); ?>
                        <?php if (empty($uid)) { ?>
                            <li class=" mobile-account">
                                <a href="<?php echo base_url($language . '/login'); ?>"><span
                                        class="login"> Login </span></a>
                            </li>
                        <?php } else { ?>
                            <li class=" mobile-account">
                                <a href="<?php echo base_url($language . '/login/logout'); ?>"><span
                                        class="login"> Logout </span></a>
                            </li>
                        <?php } ?>


                        <li class="onhover-dropdown mobile-account">
                            <img class="lang_img"
                                 src="<?php echo base_url(); ?>assets/frontend/images/lang.png">
                            <span class="lang_spn"> Language </span>
                            <ul class="onhover-show-div">
                                <?php foreach ($available_languages as $abbr => $item) { ?>
                                    <li class="active"><a
                                            href="<?php echo lang_url($abbr); ?>"><?php echo $item['label']; ?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>

                        <li class="onhover-dropdown mobile-account">
                            <img class="lang_img"
                                 src="<?php echo base_url(); ?>assets/frontend/images/curncy.png">
                            <span class="lang_spn"> Currency </span>
                            <ul class="onhover-show-div">
                                <?php $currency = $this->session->userdata('currency'); ?>
                                <?php if (empty($currency) || $currency == 'SAR') {
                                    $curr_aclass_sar = "active_sar";
                                    $curr_aclass_usd = ""; ?>
                                <?php } else if ($currency == 'USD') {
                                    $curr_aclass_sar = "";
                                    $curr_aclass_usd = "active_usd"; ?>
                                <?php } ?>
                                <li><a href="javascript:void(0)"
                                       class="<?php echo $curr_aclass_sar; ?> currency_change"
                                       data-currencyname='SAR'><?php echo lang('h_sar'); ?></a>
                                </li>
                                <li><a href="javascript:void(0)"
                                       class="<?php echo $curr_aclass_usd; ?> currency_change"
                                       data-currencyname='USD'><?php echo lang('h_usd'); ?></a>
                                </li>
                            </ul>
                        </li>

                        <li class=" mobile-account">
                            <img class="lang_img"
                                 src="<?php echo base_url(); ?>assets/frontend/images/news.png">
                            <span class="lang_spn"> Newsletter </span>

                        </li>

                        <li class="mobile-wishlist">
                            <div class="theme-layout-version ">
                            </div>
                        </li>


                        <!-- <li class="onhover-dropdown mobile-account">
                           <i class="fa fa-user" aria-hidden="true"></i>
                           My Account
                           <ul class="onhover-show-div">
                              <li><a href="#" data-lng="en">Login</a></li>
                              <li><a href="#" data-lng="es">Logout</a></li>
                           </ul>
                           </li> -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container contnr_main_headr">
        <div class="row">
            <div class="col-sm-12 header_right_side">
                <div class="main-menu">
                    <div class="menu-left">
                        <div class="navbar">
                            <a href="javascript:void(0)" onclick="openNav()">
                                <div class="bar-style">
                                    <img
                                        src="<?php echo base_url(); ?>assets/frontend/images/menu.png"
                                        class="wrap_logo_menu">
                                </div>
                            </a>
                            <div id="mySidenav" class="sidenav">
                                <a href="javascript:void(0)" class="sidebar-overlay"
                                   onclick="closeNav()"></a>
                                <nav class="side_left_a">
                                    <div onclick="closeNav()">
                                        <div class="sidebar-back text-left"><i
                                                class="fa fa-angle-left pr-2"
                                                aria-hidden="true"></i> Back
                                        </div>
                                    </div>
                                    <ul id="sub-menu" class="sm pixelstrap sm-vertical">


                                        <li><a href="<?php echo base_url($language) ?>">Home</a>
                                        </li>

                                        <?php if (!empty($main_category)) { ?>
                                            <li><a href="javascript:void(0)">Shop</a>
                                                <ul class="ul_shop_a">
                                                    <?php foreach ($main_category as $mc_key => $mc_val) { ?>
                                                        <li>
                                                            <a href="<?php echo base_url($language . '/home/listing/') . $mc_val['id']; ?>">
                                                                <i class="fa fa-cubes"
                                                                   aria-hidden="true"></i><?php echo $mc_val['display_name']; ?>
                                                            </a>
                                                            <?php if (!empty($mc_val['sub_category'])) { ?>
                                                                <ul>
                                                                    <?php foreach ($mc_val['sub_category'] as $mcs_key => $mcs_val) { ?>
                                                                        <li>
                                                                            <a href="<?php echo base_url($language . '/home/listing/') . $mc_val['id'] . '/' . $mcs_val['id']; ?>"><?php echo $mcs_val['display_name']; ?></a>
                                                                        </li>
                                                                    <?php } ?>
                                                                </ul>
                                                            <?php } ?>
                                                        </li>
                                                    <?php } ?>

                                                </ul>
                                            </li>
                                        <?php } ?>

                                        <li><a href="javascript:void(0)">News &
                                                Social</a></li>

                                        <li><a href="javascript:void(0)">Blog &
                                                Resources</a></li>

                                        <li><a href="javascript:void(0)">Help &
                                                Support</a></li>

                                        <li><a href="javascript:void(0)">Contact Us</a>
                                        </li>


                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="brand-logo wow " data-wow-duration="3.5s"
                             data-wow-delay="0s"
                             style="visibility: visible; animation-duration: 3.5s; animation-delay: 0s;">
                            <a href="<?php echo base_url($language); ?>"><img
                                    src="<?php echo base_url(); ?>assets/frontend/images/icon/logo.png"
                                    class="img-fluid blur-up lazyload logo_white"
                                    alt=""></a>

                            <a href="<?php echo base_url($language); ?>"><img
                                    src="<?php echo base_url(); ?>assets/frontend/images/icon/foot_logo.png"
                                    class="img-fluid blur-up lazyload logo_black"
                                    alt=""></a>
                        </div>
                    </div>
                    <div class="menu-right pull-right wow  header_serc_main_a"
                         data-wow-duration="3.0s" data-wow-delay="0s"
                         style="visibility: visible; animation-duration: 3.0s; animation-delay: 0s;">
                        <div class="right_srch_bar">
                            <nav id="main-nav">
                                <div class="toggle-nav"><i
                                        class="fa fa-bars sidebar-bar"></i></div>
                                <ul id="main-menu" class="sm pixelstrap sm-horizontal">
                                    <li>
                                        <div class="mobile-back text-right">Back<i
                                                class="fa fa-angle-right pl-2"
                                                aria-hidden="true"></i></div>
                                    </li>
                                </ul>
                                <div class="serch_2">
                                    <div class="serch_hdr">
                                        <div class="serch_left_a">
                                            <input type="text" name=""
                                                   placeholder="Search For Product...">
                                            <select>
                                                <option>Select Category</option>
                                                <?php if (!empty($main_category)) {
                                                    foreach ($main_category as $mc_key => $mc_val) { ?>
                                                        <option
                                                            value="<?php echo $mc_val['id']; ?>"><?php echo $mc_val['display_name']; ?></option>
                                                    <?php }
                                                } ?>
                                            </select>
                                        </div>

                                        <a class="serch_btn_right" href="">
                                            <i class="fa fa-search"
                                               aria-hidden="true"></i>
                                            Search
                                        </a>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                            </nav>
                        </div>
                        <div class="headr_sech_right">
                            <div class="icon-nav "
                                 style="display: inline-block;width: 100%;">
                                <ul>
                                    <li class="onhover-div mobile-cart">
                                        <div class="acnt_ri_menu">
                                            <a href="login.php">
                                                <i class="fa fa-user-circle-o"
                                                   aria-hidden="true"></i>
                                                <span> My <br> Account </span>
                                                <div class="clear"></div>
                                            </a>
                                        </div>
                                    </li>

                                    <li class="onhover-div mobile-cart"
                                        style="width: 20%">
                                        <div class="acnt_ri_menu">
                                            <a href="<?php echo base_url($language . '/my_account/wishlist') ?>">
                                                <img
                                                    src="<?php echo base_url(); ?>assets/frontend/images/view.png">
                                                <span>Wish<br>List </span>
                                                <div class="clear"></div>
                                            </a>
                                        </div>

                                    </li>

                                    <li class="onhover-div mobile-cart">
                                        <div class="acnt_ri_menu">
                                            <a href="<?php echo base_url($language . '/my_account/order_history') ?>">
                                                <img
                                                    src="<?php echo base_url(); ?>assets/frontend/images/order.png">
                                                <span> My <br> Orders </span>
                                                <div class="clear"></div>
                                            </a>
                                        </div>
                                    </li>

                                    <li class="onhover-div mobile-cart">
                                        <div class="acnt_ri_menu">
                                            <a href="<?php echo base_url($language . '/home/view_cart') ?>">
                                                <img
                                                    src="<?php echo base_url(); ?>assets/frontend/images/cart.png">
                                                <span> My<br>Cart </span>
                                                <div class="clear"></div>
                                            </a>
                                        </div>
                                    </li>

                                    <li class="onhover-div mobile-cart">
                                        <div class="acnt_ri_menu">
                                            <!-- data-toggle="modal" data-target="#quotation" -->
                                            <a class="login_check">
                                                <img
                                                    src="<?php echo base_url(); ?>assets/frontend/images/reqst_blue.png">
                                                <span> Request <br> Quotation   </span>
                                                <div class="clear"></div>
                                            </a>
                                        </div>
                                    </li>

                                    <li class="onhover-div mobile-cart"
                                        style="display: none;">
                                        <div><img
                                                src="<?php echo base_url(); ?>assets/frontend/images/icon/cart.png"
                                                class="img-fluid blur-up lazyload"
                                                alt=""> <i
                                                class="ti-shopping-cart"></i>
                                        </div>
                                        <ul class="show-div shopping-cart">
                                            <li>
                                                <div class="media">
                                                    <a href="#"><img alt="" class="mr-3"
                                                                     src="<?php echo base_url(); ?>assets/frontend/images/fashion/product/1.jpg"></a>
                                                    <div class="media-body">
                                                        <a href="#">
                                                            <h4>item name</h4>
                                                        </a>
                                                        <h4><span>1 x $ 299.00</span>
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="close-circle"><a href="#"><i
                                                            class="fa fa-times"
                                                            aria-hidden="true"></i></a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="media">
                                                    <a href="#"><img alt="" class="mr-3"
                                                                     src="<?php echo base_url(); ?>assets/frontend/images/fashion/product/2.jpg"></a>
                                                    <div class="media-body">
                                                        <a href="#">
                                                            <h4>item name</h4>
                                                        </a>
                                                        <h4><span>1 x $ 299.00</span>
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="close-circle"><a href="#"><i
                                                            class="fa fa-times"
                                                            aria-hidden="true"></i></a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="total">
                                                    <h5>subtotal : <span>$299.00</span>
                                                    </h5>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="buttons"><a href="#"
                                                                        class="view-cart">view
                                                        cart</a> <a href="#"
                                                                    class="checkout">checkout</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header end -->
