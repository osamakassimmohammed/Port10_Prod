<!-- <link href='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.css'
    rel='stylesheet' media='screen'>
<script
    src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.js'></script> -->
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
<link href='<?php echo base_url(); ?>assets/frontend/css/landing_page.css' rel='stylesheet' media="screen">
<link href='<?php echo base_url(); ?>assets/frontend/css/common.css' rel='stylesheet' media="screen">
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.js"></script>
<script>
    new WOW().init();
</script>
<div style="overflow-x:hidden;overflow-y:hidden">
    <div class="overall-bg">
        <!-- Top-section -->
        <!-- <div class="container"> -->
        <?php if ($language == 'en') { ?>
        <div class="row">
            <div class="col-md-12 top-section texts-sm-center">
                <div class="lines-bg">
                    <div class="col-lg-10 col-md-11 col-sm-12  ml-auto mr-auto">
                        <div class="row justify-content-between">
                            <div class="col-lg-6 col-md-6 col-sm-12 row align-items-center position">
                                <div class="wow slideInLeft data-wow-delay=" 5s"">
                                    <h3 class="text-white">Port10</h3>
                                    <h2 class="text-white header-line-height">The Smarter Way of <br />Workflow For your
                                        <br />Business
                                    </h2>
                                    <div class="align-items-center">
                                        <a href="<?php echo base_url($language . '/home') ?>"><img
                                                class="get-started-btn"
                                                src="<?php echo base_url('assets/admin/images/') ?>get-started-btn.png"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-md-6 col-sm-12 row align-items-center d-flex justify-content-center wow slideInRight data-wow-delay="
                                5s"">
                                <img class="laptop-image"
                                    src="<?php echo base_url('assets/admin/images/') ?>laptop.svg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } else { ?>
            <div class="row">
                <div class="col-md-12 top-section-arabic texts-sm-center">
                    <div class="lines-bg-arabic">
                        <div class="col-lg-10 col-md-11 col-sm-12  ml-auto mr-auto">
                            <div class="row justify-content-between">
                                <div class="col-lg-6 col-md-6 col-sm-12 row align-items-center position">
                                    <div class="wow slideInRight data-wow-delay=" 5s"">
                                        <h3 class="text-white">المنفذ 10</h3>
                                        <h2 class="text-white header-line-height">الطريقة الأكثر ذكاءً لـ <br />سير العمل الخاص بك
                                            <br />عمل
                                        </h2>
                                        <div class="align-items-center">
                                            <a href="<?php echo base_url($language . '/home') ?>"><img
                                                    class="get-started-btn"
                                                    src="<?php echo base_url('assets/admin/images/') ?>get_started_ar.png"></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-md-6 col-sm-12 row align-items-center d-flex justify-content-center wow slideInLeft data-wow-delay="
                                    5s"">
                                    <img class="laptop-image"
                                        src="<?php echo base_url('assets/admin/images/') ?>laptop.svg">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <!-- </div> -->
        <!-- Top-section -->
        <!-- Help-section -->
        <div class="d-flex justify-content-center mt-2 text-center grow-section">
            <h2 class="grow-para"><?php echo lang('We_helps_you'); ?> <br /> <span class="oragne-text"><?php echo lang('faster'); ?></span>
                <?php echo lang('and'); ?>
                <span class="oragne-text"><?php echo lang('easier'); ?></span>
            </h2>
        </div>
    </div>
    <div class="bottom-bg">
        <!-- <div class="container"> -->
        <?php if ($language == 'en') { ?>
        <div class="row">
            <div class="col-md-12 about-section texts-sm-center">
                <div class="col-lg-10 col-md-12 col-sm-12  ml-auto mr-auto">
                    <div class="row justify-content-between">
                        <div class="col-md-6">
                            <div class="wow slideInLeft data-wow-delay=" 5s""">
                                <h3 class="sub-heading style=" color:#1D1D1D">
                                    About
                                    <span style="color:#FD3A58">Port10</span>
                                </h3>
                                <div class="purchase-bg">
                                    <h5 class="purchase-content">we purchase and sale the products which are <br />
                                        genuine and
                                        of
                                        high quality. </h5>
                                </div>
                                <h6 class="mt-2 description mb-5">Port10 is an online e-commerce site that connects
                                    sellers with buyers. It's often known as an end-to-end marketplace and all
                                    transactions are managed by the website owner. Companies use online marketplaces to
                                    reach customers who want to purchase their products and services.</h6>
                            </div>
                        </div>

                        <div class="col-md-6 wow slideInRight data-wow-delay=" 5s"">
                            <img class="container-image"
                                src="<?php echo base_url('assets/admin/images/') ?>container-goods.svg">
                        </div>
                    </div>
                </div>
            </div>
            <!-- </div> -->
        </div>
        <?php } else { ?>
            <div class="row" style="overflow-x:hidden;overflow-y:hidden">
            <div class="col-md-12 about-section-arabic texts-sm-center">
                <div class="col-lg-10 col-md-12 col-sm-12  ml-auto mr-auto">
                    <div class="row justify-content-between">
                        <div class="col-md-6">
                            <div class="wow slideInRight data-wow-delay=" 5s""">
                                <h3 class="sub-heading style=" color:#1D1D1D">
                                عن
                                    <span style="color:#FD3A58">المنفذ 10</span>
                                </h3>
                                <div class="purchase-bg">
                                    <h5 class="purchase-content">نحن نشتري ونبيع المنتجات التي هي <br />
                                    حقيقية وذات جودة عالية. </h5>
                                </div>
                                <h6 class="mt-2 description mb-5">Port10 هو موقع للتجارة الإلكترونية عبر الإنترنت متصل
                                    البائعين مع المشترين. غالبًا ما يُعرف باسم السوق الشامل وكل شيء
                                    تتم إدارة المعاملات من قبل مالك الموقع. تستخدم الشركات الأسواق عبر الإنترنت لـ
                                    الوصول إلى العملاء الذين يرغبون في شراء منتجاتهم وخدماتهم.</h6>
                            </div>
                        </div>

                        <div class="col-md-6 wow slideInLeft data-wow-delay=" 5s"">
                            <img class="container-image"
                                src="<?php echo base_url('assets/admin/images/') ?>container-goods.svg">
                        </div>
                    </div>
                </div>
            </div>
            <!-- </div> -->
        </div>
        <?php } ?>
        <!-- Help-section -->
        <!-- About-section -->


        <!-- Why-Us-section -->
        <div class="row texts-sm-center texts-md-center">
            <div class="col-md-12 mb-5">
                <div class="col-lg-10 col-md-12 col-sm-12 ml-auto mr-auto">
                    <div class="row justify-content-between">
                        <!-- <div class="row justify-content-around"> -->
                        <div class="col-lg-4 col-md-12 col-sm-12 row align-items-center">
                            <!-- <div class="row justify-content-around"> -->
                            <div>
                                <h3 class="heading sub-heading wow fadeInUp data-wow-delay=" 5s"" style="#5A5454"><?php echo lang('Why_Us?'); ?></span>
                                </h3>
                                <h5><?php echo lang('We_Provide_Best_Quality_Service'); ?></h5>
                                <h6 class="mt-2 description"><?php echo lang('Today_there'); ?>
                                </h6>
                                <br />
                                <h6 class="description"><?php echo lang('transaction_or_business'); ?></h6>
                            </div>
                            <!-- </div> -->
                        </div>
                        <div class="col-lg-8 col-md-12 col-sm-12 justify-content-center">
                            <div class="d-flex justify-content-center flex-wrap">
                                <div class="col-md-6">
                                    <div class="card text-center">
                                        <div class="m-3">
                                            <div class="circle ml-auto mr-auto row align-items-center">
                                                <img class="icon-specification"
                                                    src="<?php echo base_url('assets/admin/images/') ?>entrepreneurship.svg">
                                            </div>
                                            <h5 class="mt-4 heading"><?php echo lang('Your_Dream'); ?><br /><?php echo lang('Entrepreneurship'); ?> </h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card text-center">
                                        <div class="m-3">
                                            <div class="circle ml-auto mr-auto row align-items-center">
                                                <img class="icon-specification"
                                                    src="<?php echo base_url('assets/admin/images/') ?>selling-simpler.svg">
                                            </div>
                                            <h5 class="mt-4 heading"><?php echo lang('We_Make_Buying/Selling'); ?> <br /><?php echo lang('simpler'); ?></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card text-center">
                                        <div class="m-3">
                                            <div class="circle ml-auto mr-auto row align-items-center">
                                                <img class="icon-specification"
                                                    src="<?php echo base_url('assets/admin/images/') ?>sellers-globally.svg">
                                            </div>
                                            <h5 class="mt-4 heading"><?php echo lang('Connect_with_Buyers/Sellers'); ?><br /><?php echo lang('Globally'); ?></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card text-center">
                                        <div class="m-3">
                                            <div class="circle ml-auto mr-auto row align-items-center">
                                                <img class="icon-specification"
                                                    src="<?php echo base_url('assets/admin/images/') ?>increase-sales.svg">
                                            </div>
                                            <h5 class="mt-4 heading"><?php echo lang('Rapid_Increase_in_Sellers'); ?> <br /><?php echo lang('Globally'); ?></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- </div> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Why-Us-section -->
        <!-- globe-section -->
        <div class="globe-section">
            <div class="text-center pt-5 pb-5 col-lg-10 col-md-12 col-sm-12 ml-auto mr-auto">
                <h3 class=" sub-heading wow fadeInUp data-wow-delay=" 5s"" style="font-weight:600"><?php echo lang('Easy_way_to_grow_your'); ?>
                    <span style="color:#3F006F"><?php echo lang('B2B_Business'); ?></span>
                </h3>
                <h6 class="description"><?php echo lang('trying_to_grow'); ?> </h6>
                <div class="row justify-content-center mt-4">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item mr-5">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                role="tab" aria-controls="pills-home" aria-selected="true"><?php echo lang('Seller'); ?></a>
                        </li>
                        <li class="nav-item ml-5">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                role="tab" aria-controls="pills-profile" aria-selected="false"><?php echo lang('Buyer'); ?></a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab">
                            <!-- Seller-section -->
                            <div id="gform_7">
                                <div class="d-flex justify-content-center flex-wrap mt-4">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="card text-left">
                                            <div class="m-4">
                                                <div class="row">
                                                    <h1 class="numbers-specification">1</h1>
                                                    <div class="col-md-4 col-sm-12 row align-items-center">
                                                        <img class="icon-specification ml-auto mr-auto row align-items-center"
                                                            src="<?php echo base_url('assets/admin/images/') ?>create-acount-icon.svg">
                                                    </div>
                                                    <div class="col-md-8 col-sm-12 texts-sm-center">
                                                        <h3 class="header"><?php echo lang('Create_your_Account'); ?></h3>
                                                        <h6 class="card-description"><?php echo lang('To_sign_up_for_Port10'); ?></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card text-left">
                                            <div class="m-4">
                                                <div class="row">
                                                    <h1 class="numbers-specification">2</h1>
                                                    <div class="col-md-4 col-sm-12 row align-items-center">
                                                        <img class="icon-specification ml-auto mr-auto row align-items-center"
                                                            src="<?php echo base_url('assets/admin/images/') ?>business-solution-icon.svg">
                                                    </div>
                                                    <div class="col-md-8 col-sm-12 texts-sm-center">
                                                        <h3 class="header"><?php echo lang('Business_Wi-Fi_Solution'); ?></h3>
                                                        <h6 class="card-description"><?php echo lang('Keep_your_business_connected'); ?></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card text-left">
                                            <div class="m-4">
                                                <div class="row">
                                                    <h1 class="numbers-specification">3</h1>
                                                    <div class="col-md-4 col-sm-12 row align-items-center">
                                                        <img class="icon-specification ml-auto mr-auto row align-items-center"
                                                            src="<?php echo base_url('assets/admin/images/') ?>add-products-icon.svg">
                                                    </div>
                                                    <div class="col-md-8 col-sm-12 texts-sm-center">
                                                        <h3 class="header"><?php echo lang('Add_products'); ?></h3>
                                                        <h6 class="card-description"><?php echo lang('Add_product_category'); ?></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card text-left">
                                            <div class="m-4">
                                                <div class="row">
                                                    <h1 class="numbers-specification">4</h1>
                                                    <div class="col-md-4 col-sm-12 row align-items-center">
                                                        <img class="icon-specification ml-auto mr-auto row align-items-center"
                                                            src="<?php echo base_url('assets/admin/images/') ?>manage-orders-icon.svg">
                                                    </div>
                                                    <div class="col-md-8 col-sm-12 texts-sm-center">
                                                        <h3 class="header"><?php echo lang('Manage_Orders'); ?></h3>
                                                        <h6 class="card-description"><?php echo lang('manage_your_orders'); ?></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Seller-section -->
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                            aria-labelledby="pills-profile-tab">
                            <!-- Buyer-section -->
                            <div id="gform_63">
                                <div class="d-flex justify-content-center flex-wrap mt-4">
                                    <div class="col-md-6">
                                        <div class="card text-left">
                                            <div class="m-4">
                                                <div class="row">
                                                    <h1 class="numbers-specification">1</h1>
                                                    <div class="col-md-4 col-sm-12 row align-items-center">
                                                        <img class="icon-specification ml-auto mr-auto row align-items-center"
                                                            src="<?php echo base_url('assets/admin/images/') ?>create-acount-icon.svg">
                                                    </div>
                                                    <div class="col-md-8 col-sm-12 texts-sm-center">
                                                        <h3 class="header"><?php echo lang('Create_your_Account'); ?></h3>
                                                        <h6 class="card-description"><?php echo lang('To_sign_up_for_Port10'); ?></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card text-left">
                                            <div class="m-4">
                                                <div class="row">
                                                    <h1 class="numbers-specification">2</h1>
                                                    <div class="col-md-4 col-sm-12 row align-items-center">
                                                        <img class="icon-specification ml-auto mr-auto row align-items-center"
                                                            src="<?php echo base_url('assets/admin/images/') ?>select-product.svg">
                                                    </div>
                                                    <div class="col-md-8 col-sm-12 texts-sm-center">
                                                        <h3 class="header"><?php echo lang('Select_product'); ?></h3>
                                                        <h6 class="card-description"><?php echo lang('Goods_and_services'); ?></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card text-left">
                                            <div class="m-4">
                                                <div class="row">
                                                    <h1 class="numbers-specification">3</h1>
                                                    <div class="col-md-4 col-sm-12 row align-items-center">
                                                        <img class="icon-specification ml-auto mr-auto row align-items-center"
                                                            src="<?php echo base_url('assets/admin/images/') ?>place-order.svg">
                                                    </div>
                                                    <div class="col-md-8 col-sm-12 texts-sm-center">
                                                        <h3 class="header"><?php echo lang('Place_order'); ?></h3>
                                                        <h6 class="card-description"><?php echo lang('Place_order_content'); ?></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card text-left">
                                            <div class="m-4">
                                                <div class="row">
                                                    <h1 class="numbers-specification">4</h1>
                                                    <div class="col-md-4 col-sm-12 row align-items-center">
                                                        <img class="vanicon ml-auto mr-auto row align-items-center"
                                                            src="<?php echo base_url('assets/admin/images/') ?>delivery-van.svg">
                                                    </div>
                                                    <div class="col-md-8 col-sm-12">
                                                        <h3 class="header"><?php echo lang('Recieve_your_order'); ?></h3>
                                                        <h6 class="card-description"><?php echo lang('Recieve_your_order_content'); ?></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Buyer-section -->
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <!-- globe-section -->
        <!-- Get-started-section -->
        <div class="get-started-section">
            <div class="text-center pt-5 pb-5 col-10 ml-auto mr-auto">
                <h2 class="sub-heading wow fadeInUp data-wow-delay=" 5s"">
                <?php echo lang('Get_Started'); ?>
                </h2>
                <h6 class="mt-4 description">  <?php echo lang('Get_Started_content'); ?>
                </h6>
                <?php if ($language == 'en') { ?>
                <div class="row align-items-center d-flex justify-content-center">
                    <a href="<?php echo base_url($language . '/home') ?>"><img class="get-started-btn"
                            src="<?php echo base_url('assets/admin/images/') ?>get-started-btn.png"></a>
                </div>
                <?php } else { ?>
                    <div class="row align-items-center d-flex justify-content-center">
                    <a href="<?php echo base_url($language . '/home') ?>"><img
                                                    class="get-started-btn"
                                                    src="<?php echo base_url('assets/admin/images/') ?>get_started_ar.png"></a>
                </div>
                    <?php } ?>
            </div>
        </div>
        <!-- Get-started-section -->
    </div>