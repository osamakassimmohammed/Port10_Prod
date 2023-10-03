<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
<!-- Icons -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/frontend/css/fontawesome.css">
<!--Slick slider css-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/frontend/css/slick.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/frontend/css/slick-theme.css">
<!-- Animate icon -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/frontend/css/animate.css">
<!-- Themify icon -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/frontend/css/themify-icons.css">
<!-- Bootstrap css -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/frontend/css/bootstrap.css">
<!-- Theme css -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/frontend/css/color1.css" media="screen" id="color">
<!-- latest jquery-->
<script src="<?php echo base_url(); ?>assets/frontend/js/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/frontend/css/main.css">


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

    .logout_clas_as {
        float: right;
        /*margin-top: 14px;*/
    }

    .menu_active_nav {
        background-color: #fd3a58;
    }

    .info_sub_menu {
        background-color: #f1f2f7;
    }
</style>
<div id="loading" style="display: none">
    <img id="loading-image" src="<?php echo base_url('assets/admin/images/'); ?>loaders.gif" alt="Loading..." />
</div>
<!-- header start -->
<div class="wrap_quot" data-toggle="modal" data-target="#quotation" style="display: none;">
    <!-- Request for Quotation  -->
    <img src="<?php echo base_url(); ?>assets/frontend/images/reqst.png">
</div>
<header>
    <div class="mobile-fix-option"></div>
    <div class="top-header">
        <div class="container top_hedr_contr">
            <div class="row">
                <div class="col-lg-4">
                    <div class="header-contact wow " data-wow-duration="3s" data-wow-delay="0s" style="visibility: visible; animation-duration: 3s; animation-delay: 0s;">
                        <ul>

                            <li>
                                <a style="color:white" href="tel:<?php echo @$footer_content[0]['mobile_no']; ?>"><img src="<?php echo base_url(); ?>assets/frontend/images/call.png" class="num_con_a"><?php echo @$footer_content[0]['mobile_no']; ?></a>
                            </li>
                            <li>
                                <a style="color:white" href="mailto:<?php echo @$footer_content[0]['email_id']; ?>">
                                    <img src="<?php echo base_url(); ?>assets/frontend/images/mail_hdr.png" class="num_con_a">
                                    <!-- <i class="fa fa-envelope-o"></i> -->
                                    <?php echo @$footer_content[0]['email_id']; ?></a>
                            </li>
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
                <div class="col-lg-6 text-right wow " data-wow-duration="3s" data-wow-delay="0s" style="visibility: visible; animation-duration: 3s; animation-delay: 0s;">
                    <ul class="header-dropdown wrap_main_right">
                        <?php $uid = $this->session->userdata('uid');
                        $type = $this->session->userdata('type'); ?>
                        <?php if (empty($uid)) {
                            $login_class = "with_logout";
                        ?>
                            <li class=" mobile-account">
                                <a href="<?php echo base_url($language . '/login'); ?>"><span class="login">
                                        <?php echo lang('Login'); ?>
                                    </span></a>
                            </li>
                        <?php } else {
                            $login_class = "with_login";
                        ?>
                            <li>
                                <div class="">
                                    <a href="<?php echo base_url($language . '/admin'); ?>">
                                        <?php echo lang('Go_to_Seller_Account'); ?>
                                    </a>
                                </div>
                            </li>
                            <li class=" mobile-account logout_clas_as">
                                <a href="<?php echo base_url($language . '/login/logout'); ?>"><span class="login">
                                        <?php echo lang('Logout'); ?>
                                    </span></a>
                            </li>
                        <?php } ?>
                        <!-- language comment  <li class="onhover-dropdown mobile-account">
                                    <img class="lang_img" src="<?php //echo base_url();
                                                                ?>assets/frontend/images/lang.png">
                                    <span class="lang_spn"  > Language </span>
                                    <ul class="onhover-show-div">
                                        <?php //foreach ($available_languages as $abbr => $item){
                                        ?>
                                        <li class="active"><a href="<?php //echo lang_url($abbr);
                                                                    ?>"><?php //echo $item['label'];
                                                                        ?></a></li>
                                        <?php // }
                                        ?>
                                    </ul>
                                </li> -->
                        <li class="active"><a href="<?php echo base_url($language . '/price') ?>"><?php echo lang('Subscription'); ?></a>
                        </li>
                        <!-- currency comment <li class="onhover-dropdown mobile-account">
                                    <img class="lang_img" src="<?php //echo base_url();
                                                                ?>assets/frontend/images/curncy.png">
                                    <span class="lang_spn"  > Currency </span>
                                    <ul class="onhover-show-div">
                                        <?php //$currency = $this->session->userdata('currency');
                                        ?>
                                        <?php //if(empty($currency) || $currency=='SAR' ){
                                        //$curr_aclass_sar="active_sar";
                                        //$curr_aclass_usd="";
                                        ?>
                                        <?php //}else if($currency=='USD'){
                                        //$curr_aclass_sar="";
                                        //$curr_aclass_usd="active_usd";
                                        ?>
                                        <?php // }
                                        ?>
                                        <li><a href="javascript:void(0)" class="<?php //echo $curr_aclass_sar;
                                                                                ?> currency_change" data-currencyname='SAR'><?php //echo lang('h_sar');
                                                                                                                            ?></a></li>
                                        <li><a href="javascript:void(0)" class="<?php //echo $curr_aclass_usd;
                                                                                ?> currency_change" data-currencyname='USD'><?php //echo lang('h_usd');
                                                                                                                            ?></a></li>
                                    </ul>
                                </li> -->
                        <li class="mobile-wishlist dark_mode_icon">
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
    <div class="container contnr_main_headr <?php echo $login_class; ?>">
        <div class="">
            <div class="col-sm-12 header_right_side">
                <div class="main-menu">
                    <div class="menu-left">
                        <div class="navbar">
                            <!-- <a href="javascript:void(0)" onclick="openNav()"  >
                                        <div class="bar-style">
                                            <img src="<?php echo base_url(); ?>assets/frontend/images/menu.png" class="wrap_logo_menu" >
                                        </div>
                                    </a> -->
                            <div id="mySidenav" class="sidenav">
                                <a href="javascript:void(0)" class="sidebar-overlay" onclick="closeNav()"></a>
                                <nav class="side_left_a">
                                    <div onclick="closeNav()">
                                        <div class="sidebar-back text-left"><i class="fa fa-angle-left pr-2" aria-hidden="true"></i> Back</div>
                                    </div>
                                    <ul id="sub-menu" class="sm pixelstrap sm-vertical">
                                        <li><a href="<?php echo base_url($language . '/home') ?>"><?php echo lang('Home'); ?></a>
                                        </li>
                                        <?php if (!empty($main_category)) { ?>
                                            <li> <a href="<?php echo base_url($language . '/home') ?>">
                                                    <?php echo lang('Shop'); ?>
                                                </a>
                                                <ul class="ul_shop_a">
                                                    <?php foreach ($main_category as $mc_key => $mc_val) { ?>
                                                        <li>
                                                            <a href="<?php echo base_url($language . '/home/listing/') . $mc_val['id']; ?>">
                                                                <img height="20px" width="20px" src="<?php echo base_url('assets/admin/category/') . $mc_val['image']; ?>"><?php
                                                                                                                                                                            echo $mc_val['display_name']; ?></a>
                                                            <?php if (!empty($mc_val['sub_category'])) { ?>
                                                                <ul>
                                                                    <?php foreach ($mc_val['sub_category'] as $mcs_key => $mcs_val) { ?>
                                                                        <li><a href="<?php echo base_url($language . '/home/listing/') . $mc_val['id'] . '/' . $mcs_val['id']; ?>"><?php
                                                                                                                                                                                    echo $mcs_val['display_name']; ?></a>
                                                                        </li>
                                                                    <?php } ?>
                                                                </ul>
                                                            <?php } ?>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </li>
                                        <?php } ?>
                                        <li><a href="<?Php echo base_url($language . '/blog'); ?>"><?php echo lang('Media'); ?></a>
                                        </li>
                                        <li><a href="<?Php echo base_url($language . '/blog'); ?>"><?php echo lang('Resources'); ?></a>
                                        </li>
                                        <li><a href="<?Php echo base_url($language . '/help'); ?>"><?php echo lang('Help'); ?></a>
                                        </li>
                                        <li><a href="<?Php echo base_url($language . '/contact_us'); ?>"><?php echo lang('Contact_Us'); ?></a>
                                        </li>


                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="brand-logo wow " data-wow-duration="3.5s" data-wow-delay="0s" style="visibility: visible; animation-duration: 3.5s; animation-delay: 0s;">
                            <!-- <a href="<?php echo base_url($language); ?>"><img
                                    src="<?php echo base_url(); ?>assets/frontend/images/icon/logo-04.png"
                                    class="img-fluid blur-up lazyload logo_white" alt=""></a> -->
                            <a href=" <?php if ($language == 'en') { ?>">
                                <img src="<?php echo base_url(); ?>assets/frontend/images/icon/logo-04.png" class="img-fluid blur-up lazyload logo_white" alt=""></a>
                            <a href="<?php } else { ?>">
                                <img src="<?php echo base_url(); ?>assets/frontend/images/icon/arabic-logo.png" class="img-fluid blur-up lazyload logo_white" alt=""></a>
                        <?php } ?>
                        <a href="<?php echo base_url($language); ?>"><img src="<?php echo base_url(); ?>assets/frontend/images/icon/foot_logo.png" class="img-fluid blur-up lazyload logo_black" alt=""></a>
                        </div>
                    </div>

                    <div class="menu_1_mob">
                        <div class="open_menu_mb">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                        </div>
                        <div class="close_menu_mb">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </div>
                    </div>

                    <script>
                        $(document).ready(function() {

                            $(".open_menu_mb").click(function() {
                                $(".header_serc_main_a").show();
                            });

                            $(".open_menu_mb").click(function() {
                                $(".open_menu_mb").hide();
                            });

                            $(".open_menu_mb").click(function() {
                                $(".close_menu_mb").show();
                            });

                            $(".close_menu_mb").click(function() {
                                $(".header_serc_main_a").hide();
                            });

                            $(".close_menu_mb").click(function() {
                                $(".close_menu_mb").hide();
                            });

                            $(".close_menu_mb").click(function() {
                                $(".open_menu_mb").show();
                            });




                        });
                    </script>

                    <div class="menu-right pull-right wow  header_serc_main_a" data-wow-duration="3.0s" data-wow-delay="0s" style="visibility: visible; animation-duration: 3.0s; animation-delay: 0s;">
                        <div class="col-sm-12 ">
                            <nav class="main-nav ">
                                <ul class="menu">
                                    <li class="<?php if (substr(strrchr($_SERVER['REQUEST_URI'], '/'), 1) == '') {
                                                    echo 'menu_active_nav';
                                                } ?>">
                                        <!-- <li class="home"> -->
                                        <!-- <a href="">
                                            <?php echo lang('Home'); ?>
                                        </a> -->
                                        <!-- </li> -->
                                        <a class="home" href="">
                                            <?php echo lang('Home'); ?>
                                        </a>
                                    </li>
                                    <?php if (!empty($main_category)) { ?>
                                        <li class="shop shop_menu <?php if (substr(strrchr($_SERVER['REQUEST_URI'], '/'), 1) == 'home') {
                                                                        echo 'menu_active_nav';
                                                                    } ?>"><a href="<?php echo base_url($language . '/home') ?>">
                                                <?php echo lang('Shop'); ?>
                                            </a>
                                            <div class="shop_menu_show">
                                                <?php foreach ($main_category as $mc_key => $mc_val) { ?>
                                                    <a href="<?php echo base_url($language . '/home/listing/') . $mc_val['id']; ?>"><?php
                                                                                                                                    echo $mc_val['display_name']; ?></a>
                                                <?php } ?>
                                            </div>
                                        </li>
                                    <?php } ?>
                                    <li class="<?php if (substr(strrchr($_SERVER['REQUEST_URI'], '/'), 1) == 'blog') {
                                                    echo 'menu_active_nav';
                                                } ?>">
                                        <a class="mediaa" href="<?Php echo base_url($language . '/blog'); ?>"><?php echo lang('Media'); ?>
                                        </a>
                                    </li>
                                    <li class="<?php if (substr(strrchr($_SERVER['REQUEST_URI'], '/'), 1) == 'blog') {
                                                    echo 'menu_active_nav';
                                                } ?>">
                                        <a class="resourcess" href="<?Php echo base_url($language . '/blog'); ?>"><?php
                                                                                                                    echo lang('Resources'); ?></a>
                                    </li>
                                    <li class="<?php if (substr(strrchr($_SERVER['REQUEST_URI'], '/'), 1) == 'help') {
                                                    echo 'menu_active_nav';
                                                } ?>">
                                        <a class="help" href="<?Php echo base_url($language . '/help'); ?>"><?php echo lang('Help'); ?>
                                        </a>
                                    </li>
                                    <li class="<?php if (substr(strrchr($_SERVER['REQUEST_URI'], '/'), 1) == 'contact_us') {
                                                    echo 'menu_active_nav';
                                                } ?>">
                                        <a class="c_us" href="<?Php echo base_url($language . '/contact_us'); ?>"><?php
                                                                                                                    echo lang('Contact_Us'); ?>
                                        </a>
                                    </li>

                                    <?php if (!empty($uid)) { ?>
                                        <li class="cart_icon">
                                            <a>
                                                <i class="fa fa-shopping-cart"></i>
                                                <?php echo lang('Cart'); ?>
                                            </a>
                                        </li>
                                    <?php } ?>

                                    <?php if (!empty($uid)) { ?>
                                        <li class="<?php if (substr(strrchr($_SERVER['REQUEST_URI'], '/'), 1) == 'manual') {
                                                        echo 'menu_active_nav';
                                                    } ?>">
                                            <a class="mediaa" href="<?Php echo base_url($language . '/manual'); ?>"><?php
                                                                                                                    echo lang('aManual'); ?></a>
                                        </li>
                                    <?php } ?>

                                    <?php if ($type == 'buyer') { ?>
                                        <li class="dropdown dropdown_notfctn">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="fa fa-bell-o"></i><span class="badge">
                                                    <?php echo (count($noti_data) == 0) ? "" : count($noti_data); ?>
                                                </span>
                                            </a>
                                            <?php if (!empty($noti_data)) { ?>
                                                <ul class="dropdown-menu menu_admin_right notifctn_panel_as">
                                                    <?php foreach ($noti_data as $inn_key => $inn_val) { ?>
                                                        <li>
                                                            <a href="<?php echo $inn_val['link']; ?>">
                                                                <span class="notfct_titl">
                                                                    <?php echo $inn_val['message']; ?>
                                                                </span>
                                                                <div class="clear"></div>
                                                            </a>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            <?php } ?>
                                        </li>
                                    <?php } ?>

                                    <?php if ($language == 'en') { ?>
                                        <img style="float: right; cursor:pointer" class="en_toggle toggle_cls" src="<?php echo base_url('assets/admin/images/') ?>arabic_btn.png">
                                    <?php } else { ?>
                                        <li class="toggle_menu">
                                            <input class="radio_switch ar_toggle radio_on" type="checkbox">
                                        </li>
                                    <?php } ?>

                                    <a href="<?php echo base_url($language . '/compare') ?>" class="compr_btn_a">
                                        <div class="compr_tex">
                                            <?php echo lang('Compare'); ?>
                                        </div>
                                        <div class="compr_count">
                                            <?php echo $compare_count; ?>
                                        </div>
                                        <div class="clear"></div>
                                    </a>
                                </ul>
                            </nav>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
</header>



<div class="wrpa_slide_togl">
    <div class="wrpa_slide_toglright">
        <div class="wrpa_slide_toglright_1">
            <div class="cart_titl_righ">
                <?php echo lang('Cart'); ?>
            </div>
            <div class="clos_cart">
                <i class="fa fa-close" aria-hidden="true"></i>
            </div>
            <div class="clear"></div>
        </div>
        <div class="wrpa_slide_toglright_2">


        </div>

        <div class="wrpa_slide_toglright_3">
            <div class="sub_totl_wrp">
                <div class="sb_totl_ttil">
                    <?php echo lang('SUBTOTAL'); ?> :
                </div>
                <div class="sb_totl_amont">
                    SAR <span class="ac_totalp">900.00</span>
                </div>
                <div class="clear"></div>
            </div>
            <div class="slid_bot_btn">
                <a class="slid_bot_btn1" href="<?php echo base_url($language . '/home/checkout_1'); ?>">
                    <?php echo lang('CHECKOUT'); ?>
                </a>
                <a href="<?Php echo base_url($language . '/home/view_cart'); ?>" class="slid_bot_btn2">
                    <?php echo lang('VIEW_CART'); ?>
                </a>
                <div class="clear"></div>
            </div>


            <div class="clear"></div>
        </div>

        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>




<div class="clear"></div>
<?php if (!empty($uid)) { ?>
    <div class="headr_sech_right headr_sech_right_main" style="line-height:0.5">
        <div class="icon-nav " style="display: inline-block;width: 100%;">
            <ul>
                <?php if ($type == 'suppler' || $type == 'subsupplier') { ?>
                    <li class="onhover-div mobile-cart acount_option">
                        <div class="acnt_ri_menu">
                            <a href="javascript:void(0)">
                                <span>
                                    <?php echo lang('Account'); ?>
                                </span>
                                <i class="fa fa-user-circle-o" aria-hidden="true"></i>

                                <div class="clear"></div>
                            </a>
                        </div>
                        <!-- <div class="acount_optn_panel">
                            <a href="<?php echo base_url($language . '/admin'); ?>"> <?php echo lang('Go_to_Seller_Account'); ?>
                            </a>
                        </div> -->
                    </li>
                <?php } else { ?>
                    <li class="onhover-div mobile-cart <?php if (substr(strrchr($_SERVER['REQUEST_URI'], '/'), 1) == 'account_info') {
                                                            echo 'info_sub_menu';
                                                        } ?>">
                        <div class="acnt_ri_menu">
                            <a href="<?php echo base_url($language . '/my_account/account_info'); ?>">
                                <span>
                                    <?php echo lang('Account'); ?>
                                </span>
                                <i class="fa fa-user-o" aria-hidden="true"></i>

                                <div class="clear"></div>
                            </a>
                        </div>
                    </li>
                <?php } ?>

                <li class="onhover-div mobile-cart <?php if (substr(strrchr($_SERVER['REQUEST_URI'], '/'), 1) == 'wishlist') {
                                                        echo 'info_sub_menu';
                                                    } ?>">
                    <div class="acnt_ri_menu">
                        <a href="<?php echo base_url($language . '/my_account/wishlist') ?>">
                            <span>
                                <?php echo lang('Wish_List'); ?>
                            </span>
                            <i class="fa fa-heart-o not-active" aria-hidden="true"></i> <i class="fa fa-heart active"></i>
                            <div class="clear"></div>
                        </a>
                    </div>

                </li>
                <li class="onhover-div mobile-cart <?php if (substr(strrchr($_SERVER['REQUEST_URI'], '/'), 1) == 'orders') {
                                                        echo 'info_sub_menu';
                                                    } ?>">
                    <div class="acnt_ri_menu">
                        <a href="<?php echo base_url($language . '/my_account/orders') ?>">
                            <span>
                                <?php echo lang('Orders'); ?>
                            </span>
                            <i class="fa fa-file-o not-active" aria-hidden="true"></i><i class="fa fa-file"></i>
                            <div class="clear"></div>
                        </a>
                    </div>
                </li>
                <li class="onhover-div mobile-cart <?php if (substr(strrchr($_SERVER['REQUEST_URI'], '/'), 1) == 'send_quotation_list') {
                                                        echo 'info_sub_menu';
                                                    } ?>">
                    <div class="acnt_ri_menu">
                        <a href="<?php echo base_url($language . '/my_account/send_quotation_list') ?>">
                            <span>
                                <?php echo lang('Quotation'); ?>
                            </span>
                            <i class="fa fa-file-text-o not-active" aria-hidden="true"></i> <i class="fa fa-file-text"></i>
                            <div class="clear"></div>
                        </a>
                    </div>
                </li>
                <li class="onhover-div mobile-cart <?php if (substr(strrchr($_SERVER['REQUEST_URI'], '/'), 1) == 'chat') {
                                                        echo 'info_sub_menu';
                                                    } ?>">
                    <div class="acnt_ri_menu">
                        <!-- data-toggle="modal" data-target="#quotation" -->
                        <a href="<?php echo base_url($language . '/chat') ?>">
                            <span>
                                <?php echo lang('Messaging'); ?>
                            </span>
                            <i class="fa fa-commenting-o not-active" aria-hidden="true"></i> <i class="fa fa-commenting"></i>
                            <div class="clear"></div>
                        </a>
                    </div>
                </li>

                <!-- transaction  -->
                <li class="onhover-div mobile-cart <?php if (substr(strrchr($_SERVER['REQUEST_URI'], '/'), 1) == 'transaction') {
                                                        echo 'info_sub_menu';
                                                    } ?>">
                    <div class="acnt_ri_menu">
                        <!-- data-toggle="modal" data-target="#quotation" -->
                        <a href="<?php echo base_url($language . '/my_account/transaction') ?>">
                            <span>
                                <!-- <?php echo lang('Transactions'); ?> -->
                                <?php echo ('Transactions'); ?>
                            </span>
                            <i class="fa fa-credit-card not-active" aria-hidden="true"></i> <i class="fa fa-credit-card-alt"></i>
                            <div class="clear"></div>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
<?php } ?>


<div class="clear"></div>

<script type="text/javascript">
    $('.en_toggle').click(function() {
        $(this).toggleClass("radio_on");
        url = "<?php echo lang_url('ar'); ?>";
        window.location = url;
    });
    $('.ar_toggle').click(function() {
        $(this).toggleClass("radio_on");
        url = "<?php echo lang_url('en'); ?>";
        window.location = url;
    });
</script>

<style type="text/css">
    a.compr_btn_a {
        position: fixed;
        z-index: 999;
        bottom: 0;
        left: 0;
        margin-bottom: 30px;
        margin-left: 30px;
        background: #3f006f;
        text-transform: uppercase;
        padding: 10px 20px;
        font-weight: 600;
        box-shadow: 0px 0px 4px 1px #3f006fc2;
        border-radius: 3px;
        cursor: pointer;
    }

    .compr_btn_a:hover {
        box-shadow: 0px 0px 8px 1px #3f006fc2;
    }

    .compr_tex {
        color: #fff;
        display: inline-block;
    }

    .compr_count {
        color: #fff;
        display: inline-block;
        background: #801ecb;
        width: 21px;
        text-align: center;
        height: 21px;
        margin-left: 5px;
    }

    body.ar a.compr_btn_a {
        position: fixed;
        z-index: 999;
        height: 40.99px;
        width: 144.6px;
        bottom: 0;
        right: 0;
        margin-bottom: 30px;
        margin-right: 30px;
        background: #3f006f;
        text-transform: uppercase;
        padding: 10px 20px;
        font-weight: 600;
        box-shadow: 0px 0px 4px 1px #3f006fc2;
        border-radius: 3px;
        cursor: pointer;
    }
</style>