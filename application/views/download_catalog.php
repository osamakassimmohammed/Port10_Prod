<link href='<?php echo base_url(); ?>assets/frontend/css/catalog.css'
    rel='stylesheet' media="screen">
<link href='<?php echo base_url(); ?>assets/frontend/css/common.css'
    rel='stylesheet' media="screen">
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Adamina" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/html2pdf.js/0.9.1/html2pdf.bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.1/html2pdf.bundle.min.js"></script>
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> -->
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

    body.ar {
        direction: rtl;
        text-align: start;
    }

    .table thead th {
        vertical-align: bottom;
        border-bottom: 1px solid #dee2e6;
        border-top: 0px;
    }

    .light-theme h2,
    h3 {
        color: #4F0381;
        font-family: Adamina;
        font-weight: bold;
        font-size: 17px;
    }

    .light-theme h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: Adamina;
    }

    .light-theme h5 {
        color: #4F0381;
        font-size: 16px;
        font-weight: 600;
    }

    .light-theme span {
        color: #000000;
        font-weight: 520;
        font-size: 18px
    }

    .light-theme .download_prod_details h5 {
        color: #000000;
        font-weight: 520;
        font-size: 18px
    }

    .download_prod_details .btn-primary {
        color: #FFFFFF !important;
        background-color: #4F0381;
        border-radius: 5px;
        font-family: Adamina;
        font-size: 18px;
        font-weight: 530
    }

    .logo-down-line {
        border-width: 2px;
        border-color: #4F0381;
        width: 18rem
    }

    .footer-hr {
        border-width: 2px;
        border-color: #4F0381;
        margin: 0rem 2rem
    }

    .theme-footer h4 {
        color: #4F0381;
        font-weight: 540
    }

    .icon-dimention {
        width: 1.2rem;
        height: 1.2rem;
        margin: -0.1rem 0.5rem 0.2rem 0.5rem;
    }

    .container_detl_wdth {
        padding: 0px !important;
    }

    .arabic-logo {
        width: 16rem;
        height: 4rem
    }

    .card-theme {
        border: 1px solid #efefef;
        background: #ffffff;
        padding: 20px 20px;
        margin-bottom: 30px;
        border-radius: 10px;
        box-shadow: 0px 0px 3px 2px #e7e7e7;
        height: auto;
        margin-top: 1rem;
    }

    .card-theme-cards {
        border: 1px solid #efefef;
        background: #ffffff;
        padding: 20px 20px;
        margin-bottom: 30px;
        border-radius: 10px;
        box-shadow: 0px 0px 3px 2px #e7e7e7;
        height: auto;
        margin-top: 1rem;
        width: 48%;
    }

    .breadcrumb-section {
        background-color: #f4fbff;
        padding: 5px 0;
    }

    @media print {
        .non-printable {
            display: none;
        }
    }
</style>
<div class="d-flex justify-content-end g-margin-3rl mt-3">
    <a class="btn btn-info craete-specing download_option non-printable" class="html2PdfConverter" onclick="createPDF()"
        style="background:#4f0381 !important;color:#FFFFFF">
        <?php echo lang('DownLoad_pdf'); ?></a>
</div>
<div class="breadcrumb-section" id="element-to-print">

    <?php  //print_r($seller_products);?>
    <section class="cart-section section-b-space wishlist_page order_pagea">
        <div class="container container_detl_wdth light-theme">
            <img class="lines-bg"
                src="<?php echo base_url(); ?>assets/frontend/images/icon/square-vector.svg"
                alt="">
            <div class="relative">
                <div class="row justify-content-center">
                    <?php if ($language == 'en') { ?>
                    <img class="g-margin-3t"
                        src="<?php echo base_url(); ?>assets/frontend/images/icon/invoice_logo.png"
                        class="img-fluid blur-up lazyload logo_white" alt="">
                    <?php } else { ?>
                    <img class="g-margin-3t arabic-logo"
                        src="<?php echo base_url(); ?>assets/frontend/images/icon/logo-arabic-croped.png"
                        class="img-fluid blur-up lazyload logo_white" alt="">
                    <?php } ?>
                </div>
                <hr class="logo-down-line" />
                <!-- <div class="d-flex justify-content-end g-margin-3rl">
                    <a class="btn btn-info craete-specing download_option"
                        href="<?php echo base_url($language.'/home/catalog_pdf/').$vendor[0]->id;?>"
                style="background:#4f0381 !important;color:#FFFFFF">
                <?php echo lang('DownLoad_pdf'); ?></a>
            </div> -->

            <div class="g-padding-3rbl">
                <h3>
                    <?php echo lang('Seller_Information:'); ?>
                </h3>
                <div class="card-theme">
                    <div class="row g-padding-tb">
                        <div class="col-md-4 col-sm-12 row d-flex justify-content-center">
                            <div class="g-padding-2lr">
                                <img class="circular--square shadow seller-image"
                                    src="<?php echo base_url('assets/admin/usersdata/') ?><?= $vendor[0]->logo?>"
                                    width="80px" height="80px">
                            </div>
                            <div class="space-resp">
                                <h5>
                                    <?php echo lang('First_Name'); ?>&nbsp;:&nbsp;&nbsp;<span><?= $vendor[0]->first_name?>
                                    </span>
                                </h5>
                                <br />
                                <h5>
                                    <?php echo lang('Last_Name'); ?>&nbsp;:&nbsp;&nbsp;<span><?= $vendor[0]->last_name?></span>
                                </h5>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 d-flex justify-content-center">
                            <div class="space-resp">
                                <h5>
                                    <?php echo lang('Contact_No'); ?>&nbsp;:&nbsp;&nbsp;<span><?= $vendor[0]->phone?></span>
                                </h5>
                                <br />
                                <h5>
                                    <?php echo lang('Email'); ?>&nbsp;:&nbsp;&nbsp;<span><?= $vendor[0]->email?></span>
                                </h5>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 d-flex justify-content-center">
                            <div class="space-resp">
                                <h5>
                                    <?php echo lang('Active_Status'); ?>&nbsp;:&nbsp;&nbsp;<span><?php if($vendor[0]->active == 1) {?>
                                        Active<?php } else {
                                            echo "Inactive";
                                        }?>
                                    </span>
                                </h5>
                                <br />
                                <h5>
                                    <?php echo lang('City'); ?>&nbsp;:&nbsp;&nbsp;<span><?= $vendor[0]->city?></span>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <br />
                <h3>
                    <?php echo lang('aProducts:'); ?>
                </h3>
                <div class="flexWrap d-flex justify-content-between">


                    <?php foreach ($seller_products as $value) { ?>


                    <div class="card-theme-cards">
                        <div class="row">
                            <div class="col-md-4">
                                <img class="product-square shadow"
                                    src="<?php echo base_url("assets/admin/products/") . $value->product_image; ?>"
                                    width="100%" height="100%">
                            </div>
                            <div class="col-md-8">
                                <div class="row justify-content-around space-resp-top">
                                    <div>
                                        <h5>
                                            <?php echo lang('product_name'); ?>&nbsp;&nbsp;:
                                        </h5>
                                        <h5>
                                            <?php echo lang('Brand_Name'); ?>&nbsp;&nbsp;:
                                        </h5>
                                        <h5>
                                            <?php echo lang('aCatagory'); ?>&nbsp;&nbsp;:
                                        </h5>
                                        <h5>
                                            <?php echo lang('aStock_Status'); ?>&nbsp;&nbsp;:
                                        </h5>
                                        <h5>
                                            <?php echo lang('Price'); ?>
                                            &nbsp;&nbsp;:
                                        </h5>
                                    </div>
                                    <div class="download_prod_details">
                                        <h5><?= $value->product_name ?>
                                        </h5>
                                        <h5><?php $brand_data = $this->db->get_where('brand', array('id'=>$value->brand))->result();?>
                                            <?= $brand_data[0]->brand_name ?>
                                        </h5>
                                        <h5><?php $category_data = $this->db->get_where('category', array('id'=>$value->category))->result();?>
                                            <?= $category_data[0]->display_name ?>
                                        </h5>
                                        <h5><?= $value->stock_status ?>
                                        </h5>
                                        <a class="btn btn-primary">SAR
                                            <?= $value->sale_price ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br />
                        <h6 class="text-description">
                            <?= $value->short_description ?>
                        </h6>
                    </div>
                    <?php }?>

                    <!-- <div class="card-theme-cards">
                     <div class="row">
                        <div class="col-md-4">
                           <img class="product-square shadow"
                              src="<?php echo base_url('assets/admin/images/') ?>cargo-red.jpg"
                    width="100%" height="100%">
                </div>
                <div class="col-md-8">
                    <div class="row justify-content-around space-resp-top">
                        <div>
                            <h5>
                                <?php echo lang('product_name'); ?>&nbsp;&nbsp;:
                            </h5>
                            <h5>
                                <?php echo lang('Brand_Name'); ?>&nbsp;&nbsp;:
                            </h5>
                            <h5>
                                <?php echo lang('aCatagory'); ?>&nbsp;&nbsp;:
                            </h5>
                            <h5>
                                <?php echo lang('aStock_Status'); ?>&nbsp;&nbsp;:
                            </h5>
                            <h5>
                                <?php echo lang('Price'); ?>
                                &nbsp;&nbsp;:
                            </h5>
                        </div>
                        <div class="download_prod_details">
                            <h5>Test21</h5>
                            <h5>NIke</h5>
                            <h5>Fashion</h5>
                            <h5>In Stock</h5>
                            <a class="btn btn-primary">SAR 1000</a>
                        </div>
                    </div>
                </div>
            </div>
            <br />
            <h6 class="text-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras at
                maximus
                ante. Cras hendrerit dolor enim, eu posuere massa imperdiet in. Morbi metus lectus, laoreet in
                mauris vel, imperdiet rhoncus tortor. Donec aliquet lectus vel mi vulputate, in gravida tellus
                venenatis. Fusce bibendum mollis risus fringilla egestas.</h6>
        </div>
        <div class="card-theme-cards">
            <div class="row">
                <div class="col-md-4">
                    <img class="product-square shadow"
                        src="<?php echo base_url('assets/admin/images/') ?>cargo-red.jpg"
                        width="100%" height="100%">
                </div>
                <div class="col-md-8">
                    <div class="row justify-content-around space-resp-top">
                        <div>
                            <h5>
                                <?php echo lang('product_name'); ?>&nbsp;&nbsp;:
                            </h5>
                            <h5>
                                <?php echo lang('Brand_Name'); ?>&nbsp;&nbsp;:
                            </h5>
                            <h5>
                                <?php echo lang('aCatagory'); ?>&nbsp;&nbsp;:
                            </h5>
                            <h5>
                                <?php echo lang('aStock_Status'); ?>&nbsp;&nbsp;:
                            </h5>
                            <h5>
                                <?php echo lang('Price'); ?>
                                &nbsp;&nbsp;:
                            </h5>
                        </div>
                        <div class="download_prod_details">
                            <h5>Test21</h5>
                            <h5>NIke</h5>
                            <h5>Fashion</h5>
                            <h5>In Stock</h5>
                            <a class="btn btn-primary">SAR 1000</a>
                        </div>
                    </div>
                </div>
            </div>
            <br />
            <h6 class="text-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras at
                maximus
                ante. Cras hendrerit dolor enim, eu posuere massa imperdiet in. Morbi metus lectus, laoreet in
                mauris vel, imperdiet rhoncus tortor. Donec aliquet lectus vel mi vulputate, in gravida tellus
                venenatis. Fusce bibendum mollis risus fringilla egestas.</h6>
        </div>
        <div class="card-theme-cards">
            <div class="row">
                <div class="col-md-4">
                    <img class="product-square shadow"
                        src="<?php echo base_url('assets/admin/images/') ?>cargo-red.jpg"
                        width="100%" height="100%">
                </div>
                <div class="col-md-8">
                    <div class="row justify-content-around space-resp-top">
                        <div>
                            <h5>
                                <?php echo lang('product_name'); ?>&nbsp;&nbsp;:
                            </h5>
                            <h5>
                                <?php echo lang('Brand_Name'); ?>&nbsp;&nbsp;:
                            </h5>
                            <h5>
                                <?php echo lang('aCatagory'); ?>&nbsp;&nbsp;:
                            </h5>
                            <h5>
                                <?php echo lang('aStock_Status'); ?>&nbsp;&nbsp;:
                            </h5>
                            <h5>
                                <?php echo lang('Price'); ?>
                                &nbsp;&nbsp;:
                            </h5>
                        </div>
                        <div class="download_prod_details">
                            <h5>Test21</h5>
                            <h5>NIke</h5>
                            <h5>Fashion</h5>
                            <h5>In Stock</h5>
                            <a class="btn btn-primary">SAR 1000</a>
                        </div>
                    </div>
                </div>
            </div>
            <br />
            <h6 class="text-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras at
                maximus
                ante. Cras hendrerit dolor enim, eu posuere massa imperdiet in. Morbi metus lectus, laoreet in
                mauris vel, imperdiet rhoncus tortor. Donec aliquet lectus vel mi vulputate, in gravida tellus
                venenatis. Fusce bibendum mollis risus fringilla egestas.</h6>
        </div> -->
</div>
<br />
<div>
    <h2 class="text-center" style="font-size:26px">
        <?php echo lang('Contact_Us'); ?>
    </h2>
</div>
<hr class="footer-hr" />
<br />
<div class="row theme-footer">
    <div class="col-md-4 d-flex justify-content-center">
        <h4 class="text-underline"><span><img class="icon-dimention"
                    src="<?php echo base_url(); ?>assets/frontend/images/icon/phone-icon.svg"
                    alt=""></span>920033769</h4>
    </div>
    <div class="col-md-4 d-flex justify-content-center">
        <h4 class="text-underline"><span><img class="icon-dimention"
                    src="<?php echo base_url(); ?>assets/frontend/images/icon/email-icon.svg"
                    alt=""></span>info@port10.sa</h4>
    </div>
    <div class="col-md-4 d-flex justify-content-center">
        <h4 class="text-underline">port10.sa.com</h4>
    </div>
</div>
</div>
</div>
</div>
</section>
</div>

<div>


    <script>
        function createPDF() {
            var element = document.getElementById('element-to-print');
            html2pdf(element, {
                margin: 1,
                padding: 0,
                filename: 'myfile.pdf',
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                html2canvas: {
                    scale: 2,
                    logging: true
                },
                jsPDF: {
                    unit: 'in',
                    format: 'A2',
                    orientation: 'P'
                },
                class: createPDF
            });
        };
    </script>