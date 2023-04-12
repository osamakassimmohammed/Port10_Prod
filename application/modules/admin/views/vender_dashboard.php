<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.css'
    rel='stylesheet' media='screen'>
<script
    src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/jquery.dataTables.js'></script>
<script
    src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.js'></script>
<style>
    .clasdd table#today,
    .clasdd table#week {
        border: none;
    }

    .row.todayas {
        margin-top: 5%;
    }

    table#today.table-bordered tbody tr td,
    table#today.table-bordered tbody tr th {
        border: none;
        border-bottom: 1px solid;
    }

    table#week.table-bordered tbody tr td,
    table#week.table-bordered tbody tr th {
        border: none;
        border-bottom: 1px solid;
    }

    p.p_name {
        width: 100%;
    }

    .wrap_dash_brd {
        padding: 20px;
        border-radius: 2px;
    }

    .img_lft_a {
        float: left;
        width: 25%;
    }

    .img_lft_a img {
        width: 100%;
    }

    .clear {
        clear: both;
    }

    .cellgrid {
        list-style-type: none;
        margin: 0px;
        padding: 0px;
    }

    .cellgrid li {
        float: left;
        width: 25%;
        border: 0px solid red;
    }

    .right_panl_info {
        float: left;
        width: 75%;
        padding-left: 4%;
    }

    .buyr_text {
        margin-top: 6px;
        font-size: 14px;
        color: #8a8a8a;
    }

    .buy_numbr_cont {
        font-size: 21px;
        font-weight: 600;
        float: left;
        width: 100%;
        margin-top: -2px;
    }

    .li_singl_wrap {
        background: #fff;
        width: 96%;
        border: 1px solid #efefef;
        border-radius: 2px;
        padding: 10px 10px;
        margin-bottom: 20px;
        box-shadow: 2px 2px 4px 2px #00000008;
        padding-top: 14px;
        padding-bottom: 15px;
        display: inline-block;
        margin-left: 1%;
    }

    .report_li {
        background: #3e96f3 !important;
        padding: 5px 10px;
        display: inline-block;
        color: #fff;
        font-size: 13px;
        border-radius: 3px;
        float: left;
        margin-top: 1px;
    }

    .report_li:hover {
        background: #2b85e4;
        cursor: pointer;
    }

    #records_table_hide,
    #error,
    #error_dme,
    #search_dme_table_hide {
        display: none;
    }

    .notf_error,
    #latest_product_tberr,
    #latest_product_t {
        display: none;
    }

    .nofoundrecord {
        text-align: center;
        padding: 7px;
        font-size: 14px;
    }

    .vieworderid {
        background-color: #39b9a5;
        padding: 8px 10px 8px 10px;
        width: 10%;
        color: #fff;
    }

    .vieworderid1 {
        background-color: #39b9a5;
        padding: 8px 10px 8px 10px;
        width: 10%;
        color: #fff;
    }

    .badge {
        background-color: #fb483a;
    }

    .subdate_search,
    .latestpro_date {
        background-color: #39b9a5 !important;
        padding: 8px 23px !important;
        font-size: 14px !important;
    }

    .font_iconcss {
        font-size: 21px;
        cursor: pointer;
        color: #279887;
    }

    .latest_order {
        border: 1px solid #dcdcdc;
        border-radius: 5px;
        padding: 2px;
        position: relative;
        width: 13%;
        text-align: center;
        margin-bottom: 16px;
    }

    .latest_order h5 {
        font-size: 16px;
    }

    .card i.material-icons {
        float: left;
        margin-right: 15px;
    }

    button.add_to_carts {
        margin-top: 5px;
        text-align: center;
        width: 70%;
        padding: 8px 7px;
        border-radius: 5px;
        border: 1px solid;
        background: #3f006f;
        color: white;
        margin-left: 15%;
        border-radius: 100px;
        font-size: 16px;
        margin-bottom: 20px;
    }


    .card-content p.title {
        font-weight: 500;
        color: #666;
        font-family: 'Montserrat';
        text-transform: uppercase;
        text-align: left;
        float: left;
        width: 100%;
        margin-top: -20px;
        margin-bottom: 0px;
    }

    .card .material-icons {
        color: #fff;
    }

    .table-bordered tbody tr td,
    .table-bordered tbody tr th {
        color: #666;
        border-color: #ffffff !important;
        font-family: 'Montserrat';
        font-weight: 400;
        font-size: 14px;
        line-height: 19px;
    }

    .top_action h5 {
        color: #58595b;
        font-family: 'Montserrat';
        font-weight: 500;
    }


    div#DataTables_Table_0_wrapper {
        overflow: visible;
    }

    .table-responsive .table.table-striped.table-bordered tr td {
        border-color: #ddd !important;
    }
</style>

<div class="main dashboard">
    <div class="center">
        <div class="container">
            <div class="box_container full">
                <h2>
                    <?php echo lang('aTOTAL_SUMMARY'); ?>
                </h2>

                <div class="row card_main">

                    <div class="col-xs-3">
                        <a href="<?php echo base_url($language . '/admin/vorders/pending_order'); ?>">
                            <div class="card two">
                                <i class="material-icons">watch_later</i>
                                <div class="card-content">
                                    <p class="title">
                                        <?php echo lang('aPending_Order'); ?>
                                    </p>
                                    <p style="color: #ae60e4;" class="count">
                                        <?php echo @$pending_order; ?>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div><!-- col-xs-3 -->

                    <div class="col-xs-3">
                        <a href="<?php echo base_url($language . '/admin/vorders/completed_order'); ?>">
                            <div class="card one">
                                <i class="material-icons">add_shopping_cart</i>
                                <div class="card-content">
                                    <p class="title">
                                        <?php echo lang('aComplere_Order'); ?>
                                    </p>
                                    <p style="color: #ff3f64;" class="count">
                                        <?php echo @$complete_order; ?>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div><!-- col-xs-2 -->

                    <div class="col-xs-3">
                        <a href="<?php echo base_url($language . '/admin/vorders/today_order'); ?>">
                            <div class="card three">
                                <i class="material-icons">bookmark_border</i>
                                <div class="card-content">
                                    <p class="title">
                                        <?php echo lang('aToday_Order'); ?>
                                    </p>
                                    <p style="color: #24d0d9;" class="count">
                                        <?php echo @$today_order; ?>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div><!-- col-xs-2 -->

                    <div class="col-xs-3">
                        <a href="<?php echo base_url($language . '/admin/product/list1'); ?>">
                            <div class="card four">
                                <i class="material-icons">attach_money</i>
                                <div class="card-content">
                                    <p class="title">
                                        <?php echo lang('aTotal_Product'); ?>
                                    </p>

                                    <p style="color: #444a51;" class="count">
                                        <?php echo $product_count; ?>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div><!-- col-xs-2 -->
                </div> <!--form_header-->





            </div>

            <div class="dashboard">
                <h2 class="">
                    <?php echo lang('aToday_Order'); ?>
                </h2>
                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                    <thead>
                        <tr>
                            <th>
                                <?php echo lang('aOrder_Id'); ?>
                            </th>
                            <th><?php echo lang('aDisplay_Order_Id'); ?></th>
                            <th><?php echo lang('aCustomer_Info'); ?></th>
                            <th><?php echo lang('aOrder_datetime'); ?> </th>
                            <th><?php echo lang('aNet_total'); ?></th>
                            <th><?php echo lang('aPayment_status'); ?></th>
                            <th><?php echo lang('aOrder_status'); ?></th>
                            <th><?php echo lang('aAction'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($today_new_orders)) {
                            foreach ($today_new_orders as $key => $value) {
                                $currency = $value['currency'];
                                ?>
                                <tr>
                                    <td>
                                        <?php echo @$value['order_no']; ?>
                                    </td>

                                    <td>
                                        <?php echo @$value['display_order_id']; ?>
                                    </td>
                                    <td>
                                        <?php echo @$value['first_name'] . ' ' . @$value['last_name']; ?><br>
                                        <?php echo $value['mobile_no']; ?><br>
                                        <?php echo $value['email']; ?>
                                    </td>

                                    <td>
                                        <?php $now = date('M-d-Y', strtotime($value['order_datetime']));
                                        echo $now; ?>
                                    </td>

                                    <td>
                                        <?php echo $currency;
                                        echo " ";
                                        echo @$value['in_net_total']; ?>
                                    </td>
                                    <td><span class="vorder_<?php echo @$value['payment_status']; ?>"><?php echo @$value['payment_status']; ?></span></td>
                                    <td><span class="vorder_<?php echo @$value['order_status']; ?>"><?php echo @$value['order_status']; ?></span></td>

                                    <td style="width: 10%">
                                        <a href="vorders/view/<?php echo @$value['order_no'] ?>" class="">view</a>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr class="text-center text-danger">
                                <td colspan="8">
                                    <?php echo lang('aNo_Order_Found'); ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>


            <div class="row todayas">
                <div class="col-sm-6 col-xs-12">

                    <div class="top_action">
                        <div class="col-xs-12 col pull-left">
                            <h2>
                                <?php echo lang('aTODAY'); ?>
                            </h2>
                            <h5>
                                <?php echo date("d-m-Y"); ?>
                            </h5>
                        </div><!--col-xs-12-->
                    </div><!--top_action-->

                    <div class="table-responsive clasdd">
                        <table id="today" class="table table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <td>
                                        <?php echo lang('aTotal_Orders'); ?>
                                    </td>
                                    <td>
                                        <?php echo $today_order; ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <?php echo lang('aPending_Orders'); ?>
                                    </td>
                                    <td>
                                        <?php echo @$today_pending; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php echo lang('aDelivered_Orders'); ?>
                                    </td>
                                    <td>
                                        <?php echo @$today_complete; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: none;">
                                        <?php echo lang('aCanceled_Orders'); ?>
                                    </td>
                                    <td style="border: none;">
                                        <?php echo @$today_canceled; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div> <!--table-responsive-->
                </div><!-- col-sm-6 col-xs-12 -->

                <div class="col-sm-6 col-xs-12">
                    <div class="top_action">
                        <div class="col-xs-12 col pull-left">
                            <h2>
                                <?php echo lang('aTHIS_WEEK'); ?>
                            </h2>
                            <?php $now = date('Y-m-d', strtotime('today')); ?>
                            <h5><span>
                                    <?php echo lang('from') . ":"; ?>
                                </span>&nbsp;&nbsp;
                                <?php echo date("d-m-Y", strtotime($now . "-6day")); ?>&nbsp;&nbsp;&nbsp;&nbsp; <span>
                                    <?php echo lang('to') . ":"; ?>
                                </span>&nbsp;&nbsp;
                                <?php echo date("d-m-Y"); ?>
                            </h5>
                            <h5></h5>
                        </div><!--col-xs-12-->
                    </div><!--top_action-->

                    <div class="table-responsive">
                        <table id="week" class="table table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <td>
                                        <?php echo lang('aTotal_Orders'); ?>
                                    </td>
                                    <td>
                                        <?php echo @$week_order; ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <?php echo lang('aPending_Orders'); ?>
                                    </td>
                                    <td>
                                        <?php echo @$week_pending; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php echo lang('aDelivered_Orders'); ?>
                                    </td>
                                    <td>
                                        <?php echo @$week_canceled; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: none;">
                                        <?php echo lang('aCanceled_Orders'); ?>
                                    </td>
                                    <td style="border: none;">
                                        <?php echo @$week_complete; ?>
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div> <!--table-responsive-->
                </div><!-- col-sm-6 col-xs-12 -->

            </div><!-- row -->

        </div> <!--box_container-->

    </div>
</div>

</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<style type="text/css">
    table.table.table-striped {
        border: none;
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0px 0px 8px rgb(0 0 0 / 30%);
    }

    .box_container {
        margin: 0 auto;
        max-width: 650px;
        width: 100%;
        padding: 25px;
        background: #fff;
        border-radius: 6px;
        margin-top: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        position: relative;
        display: inline-block;
        text-align: left !important;
    }

    .box_container.full {
        max-width: 100%;
    }


    .dashboard h2 {
        margin-top: 0px;
        opacity: 1;
        text-transform: uppercase;
        font-size: 20px;
        font-weight: 100;
        color: #ff375e;
        font-family: 'Montserrat';
        font-weight: 500;
    }


    .dashboard .card_main {
        margin-bottom: 30px
    }

    .dashboard .table {
        margin: 0px;
        font-size: 15px
    }

    .dashboard .table td:last-child {
        text-align: center;
        font-family: 'Montserrat';
    }

    .dashboard .table-responsive {
        background: #fff;
        border-radius: 4px;
        padding: 1px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.18);
    }

    .dashboard .box_container {
        background: none;
        padding: 0px;
        box-shadow: none;
    }

    .dashboard .card {
        float: left;
        width: 100%;
        margin-top: 15px;
        padding: 25px 20px;
        border-radius: 6px;
        box-shadow: 0px 0px 8px rgb(0 0 0 / 30%);
        color: black;
        position: relative;
        overflow: hidden;
        font-size: 17px;
        border-bottom: 0px solid rgba(0, 0, 0, 0.25);
        background: #fff !important;
    }


    .dashboard .card .fa {
        float: left;
        margin-right: 12px;
        margin-top: 2px;
    }

    .dashboard .card.four .fa {
        bottom: -15px
    }

    .dashboard .card p.count {
        font-weight: 400;
        margin-bottom: 0px;
        font-family: 'Montserrat';
        font-size: 50px;
        position: relative;
        margin-left: 5px;
    }

    .dashboard .card.one {
        background: transparent;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#3bd1bf', endColorstr='#119bd2', GradientType=1);
    }

    .dashboard .card.two {
        background: transparent;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff875e', endColorstr='#fc629d', GradientType=1);
    }

    .dashboard .card.three {
        background: transparent;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ee70e9', endColorstr='#8363f9', GradientType=1);
    }

    .dashboard .card.four {
        background: transparent;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f7cd13', endColorstr='#39ce86', GradientType=1);
    }

    .container {
        width: 100%;
    }


    .row.asd {
        margin-top: 5%;
        margin-left: 0px;
        margin-right: 0px;
    }
</style>






<div class="row asd">
    <h3 class="abu">
        <?php echo lang('aTOP_SOLD_PRODUCTS_WEEK'); ?>
    </h3>
    <?php if (count($top_selled) > 8) { ?>
        <a class="btn btn-info top_view" href="<?php echo base_url($language . '/admin/dashbord/all_topsold'); ?>"><?php echo lang('aView_All'); ?></a>
        <div class="clear"></div>
    <?php } ?>
    <?php if (!empty(@$top_selled)) {
        $top = 0;
        for ($i = count($top_selled) - 1; $i >= 0; $i--) {

            $product_image = explode("/", $top_selled[$i]['product_image']);
            $product_image = count($product_image);
            if ($product_image == 1) {
                $image_url = base_url("assets/admin/products/") . $top_selled[$i]['product_image'];
            } else {
                $image_url = $top_selled[$i]['product_image'];
            }

            $pro_url = $language . '/admin/product/edit/';

            if (@$top_selled[$i]['product_name']) {
                ?>

                <div class="col-sm-3">
                    <div class="thumbnail card top_seling_sectn">
                        <div class="header pading_top_header header_with_desrctpn">
                            <a href="<?Php echo base_url() . $pro_url . $top_selled[$i]['product_id']; ?>"><img
                                    class="images top_seling_img" src="<?php echo $image_url; ?>"></a>

                            <!-- <h3 class="p_name_h3">Product <?php echo ' Sold ' . $top_selled[$i]['pro_count'] . ' times .'; ?> </h3>  -->
                            <h3 class="p_name_h3">
                                <?php echo $top_selled[$i]['product_name']; ?>
                            </h3>
                            <span class="top_country"></span>
                            <div>
                                <button title="<?php echo lang('Add_to_cart'); ?>" data-id="4" data-unit="get_unit0"
                                    data-detislqty="3" class="add_to_carts">
                                    <i style="margin-left: 32px;margin-right: -20px;" class="material-icons">shopping_cart</i>
                                    <?php echo lang('Add_to_cart'); ?>
                                </button>
                            </div>
                            <div class="clear"></div>
                        </div>

                    </div>
                </div>
            <?php }
            if ($top == 8) {
                break;
            }
            $top++;
        }
    } else {
        echo "<h3 class='abu'>" . lang('aNo_Order_Found') . "</h3>";
    } ?>
</div>



<style type="text/css">
    .canvasjs-chart-toolbar {
        display: none;
    }

    .card .body .col-xs-6,
    .card .body .col-sm-6,
    .card .body .col-md-6,
    .card .body .col-lg-6 {
        margin-bottom: 0px !important;
    }

    h3.bh,
    h3.abu {
        clear: both;
        overflow: hidden;
        width: 100%;
        margin-left: 20px;
        font-family: initial;
        font-size: 18px;
        opacity: 1;
        font-weight: 500;
        text-transform: uppercase;
        font-size: 20px;
        color: #ff375e;
        font-family: 'Montserrat';
    }

    img.images.top_seling_img {
        width: 100%;
        padding: 0px;
        margin-top: 10px;
    }

    p.p_name {
        height: 32px;
    }

    .thumbnail p:not(button) {
        color: #999999;
        font-size: 14px;
        padding: 0px;
        margin: 0px;
    }

    .header.pading_top_header.header_with_desrctpn {
        padding: 0px 10px 0px !important;
        margin: 0px;
    }

    .p_name_h3 {
        clear: both;
        text-transform: capitalize;
        overflow: hidden;
        width: 100%;
        font-family: 'Montserrat';
        font-size: 18px;
    }

    .top_view {
        float: right;
        margin-top: -31px;
        margin-bottom: 22px;
        margin-right: 17px;
    }

    .top_country {
        float: right;
        margin-top: -28px;
        margin-bottom: 22px;
        margin-right: 17px;
        color: #b70527;
    }

    body {
        background-color: #f1f2f700;
        /*font-family: initial;*/
    }

    g {
        /*display: none;*/
    }
</style>
<script type="text/javascript">
    $('.js-exportable').DataTable({
        dom: 'Bfrtip',
        "info": false,
        responsive: true,
        "order": [[0, "desc"]],
        "pageLength": 5,
    });

</script>