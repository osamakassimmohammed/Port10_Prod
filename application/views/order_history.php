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


</style>

<div class="breadcrumb-section">
    <div class="container container_detl_wdth">
        <div class="row">
            <div class="col-sm-6">
                <div class="page-title">
                    <h2>My Orders</h2>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- <ul class="nav nav-tabs tab_btn_orders">
<li class="active active_firsttwmp"><a data-toggle="tab" href="#confrm_order">Confirmed Orders</a></li>
<li><a data-toggle="tab" href="#open_order">Open Orders</a></li>
<li><a data-toggle="tab" href="#cancl_order">Cancelled Orders</a></li>
</ul>
<div class="tab-content orders tab_panel_orders">
<div id="confrm_order" class="tab-pane fade in active">
   Confirmed Orders Text
</div>
<div id="open_order" class="tab-pane fade">
   Open Orders Text
</div>
<div id="cancl_order" class="tab-pane fade">
   Cancelled Orders Text
</div>
</div> -->


<section class="cart-section section-b-space wishlist_page order_pagea">
    <div class="container container_detl_wdth">
        <div class="row hide_cart_div">
            <div class="col-sm-12">
                <?php if (!empty($order_items)) { ?>
                    <div class="left_cart_box">
                        <table class="table cart-table table-responsive-xs ">
                            <thead>
                            <tr class="table-head">
                                <th scope="col" class="th_crt2">Items</th>
                                <!-- <th scope="col" class="th_crt3" >product name</th> -->
                                <th scope="col" class="th_crt4">Order Date</th>
                                <th scope="col" class="th_crt4">Unit</th>
                                <th scope="col" class="th_crt4" style="">quantity</th>
                                <th scope="col" class="th_crt5">price</th>
                                <!-- <th scope="col" class="th_crt5">Delivery Date</th> -->
                                <th scope="col" class="th_crt5">Transaction <br>
                                    Reference
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($order_items as $oi_key => $oi_val) { ?>
                                <tr class="remove_prom1m7">
                                    <td class="th_crt2">
                                        <div class="img_sec_lft">
                                            <a href="<?php echo base_url($language . '/home/detail/') . $oi_val['product_id']; ?>"><img
                                                    src="<?php echo base_url('assets/admin/products/') . $oi_val['product_image']; ?>"
                                                    alt=""></a>
                                            <div class="clear"></div>

                                        </div>
                                        <div class="nme_sec_right">
                                            <a class="prdct_name_cart"
                                               href="<?php echo base_url($language . '/home/detail/') . $oi_val['product_id']; ?>">
                                                <span> <?php echo $oi_val['product_name']; ?> </span>
                                            </a>
                                        </div>
                                    </td>

                                    <td class="th_crt4"><h2
                                            class="date_a"><?php echo date('d - M - Y', strtotime($oi_val['created_date'])); ?></h2>
                                    </td>

                                    <td class="th_crt4">
                                        <!-- <h2>liter</h2> -->
                                        <div class="prdct_name_cart">
                                            <?php echo $oi_val['unit_name']; ?>
                                        </div>

                                    </td>
                                    <td class="th_crt4">
                                        <div class="prdct_name_cart">
                                            <?php echo $oi_val['quantity']; ?>
                                        </div>


                                    </td>
                                    <td class="th_crt5">
                                        <h2><?php echo $oi_val['price']; ?><?php echo $oi_val['currency']; ?></h2>
                                    </td>

                                    <td class="th_crt5">
                                        <h2>
                                            <a href="<?php echo base_url('invoice/product/') . $oi_val['item_id']; ?>/order"
                                               class="invoic"> Invoice </a></h2>
                                    </td>
                                </tr>
                            <?php } ?>

                            </tbody>
                        </table>
                    </div>
                <?php } ?>

                <div class="clear"></div>
            </div>
        </div>

    </div>
</section>


<script type="text/javascript">
    $(".tab_btn_orders li").click(function () {
        $(".active_firsttwmp").removeClass("active");
    });

</script>
