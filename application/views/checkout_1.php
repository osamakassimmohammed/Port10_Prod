<style type="text/css">
    .home_active {
        font-weight: 600 !important;
        color: #c09550 !important;
    }

    .contnr_main_headr.hedr_fixed {
        position: static;
        box-shadow: 0px 0px 0px #fff;
    }
</style>


<!-- breadcrumb End -->
<!--section start-->
<!-- section start -->
<section class="section-b-space">
    <div class="page-title">
        <h2><?php echo lang('CHECKOUT'); ?></h2>
    </div>
    <div class="container container_detl_wdth container_detl_wdth_checkOut">
        <div class="checkout-page">
            <div class="checkout-form">
                <form id="form_place_order" action="<?php echo base_url($language . '/home/place_order') ?>" method="POST">
                    <div class="row">
                        <?php if (!empty($data)) {  ?>
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <div class="checkout-title">
                                    <!-- <h3>Shipping/Billing Address</h3> -->
                                    <span class="ck_pay_step"><?php echo lang('Payment_Method'); ?></span>
                                    <span><?php echo lang('CHECKOUT'); ?></span>
                                    <div class="clear"></div>
                                    <hr style="width: 60%; margin-left: 17%;" size="3" , color=black>
                                    <span class="ch_pay_one"> <i class="fa fa-circle" aria-hidden="true"></i></span>
                                    <span class="ch_pay_two"><i class="fa fa-circle-o" aria-hidden="true"></i></span>
                                </div>
                                <div class="radio-option hide_cart_div viewcrt_optn_pymnt">

                                    <div class="cliclb_pymnt">
                                        <input type="radio" value="<?php echo en_de_crypt('va_transfer'); ?>" name="payment_mode" id="ck_cod">
                                        <label for="ck_cod"><?php echo lang('Virtual_Account_Transfer'); ?></label>
                                        <img class="ck_radio_img" src="<?php echo base_url('assets/frontend/images/brands_logo_sarie.png') ?>">

                                    </div>
                                    <div class="cliclb_pymnt">
                                        <input type="radio" value="<?php echo en_de_crypt('online'); ?>" name="payment_mode" id="ck_online">
                                        <label for="ck_online"><?php echo lang('Card'); ?><span class="image">
                                            </span></label> <img class="ck_radio_img" src="<?php echo base_url('assets/frontend/images/logo-mada.png') ?>"> <img class="ck_radio_img" src="<?php echo base_url('assets/frontend/images/logo-mastercard.png') ?>"> <img class="ck_radio_img" src="<?php echo base_url('assets/frontend/images/logo-visa.png') ?>">
                                    </div>
                                    <div class="clear"></div>
                                </div>

                            </div>

                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <div class="checkout-details">
                                    <div class="order-box chck_bx">

                                        <div class="title-box">
                                            <div><?php echo lang('Product'); ?> <span><?php echo lang('total'); ?></span>
                                            </div>
                                        </div>
                                        <ul class="qty">
                                            <?php
                                            $grand_total = $all_prodcut_total = $total_commission = 0;
                                            foreach ($data as $d_key => $dvalue) {
                                                $pid = $dvalue['p']['id'];
                                                $qty = $dvalue['c']['qty'];
                                                $price = $dvalue['p']['sale_price'];
                                                $pro_total = $price * $qty;
                                                $all_prodcut_total = $all_prodcut_total + $pro_total;

                                                $commission = $tax_table[0]['commission'];
                                                $single_commission = ($commission * $pro_total) / 100;
                                                if ($single_commission > $tax_table[0]['cap_rate']) {
                                                    $single_commission = $tax_table[0]['cap_rate'];
                                                }
                                                $total_commission = $single_commission + $total_commission;
                                            }
                                            // $commission=$tax_table[0]['commission'];                    
                                            // $commission=($commission*$all_prodcut_total)/100;

                                            $bank_fees = 0;
                                            if ($currency == 'USD') {
                                                $transfer_fees = $tax_table[0]['transfer_fees'] / $tax_table[0]['sar_rate'];
                                            } else {
                                                $transfer_fees = $tax_table[0]['transfer_fees'];
                                            }
                                            $all_fees = $total_commission + $bank_fees + $transfer_fees;
                                            $product_fees_without_vat = $all_prodcut_total + $all_fees;
                                            $vat = $tax_table[0]['vat'];
                                            $vat_calulated = ($vat * $product_fees_without_vat) / 100;
                                            $grand_total = $product_fees_without_vat + $vat_calulated;
                                            ?>
                                            <?php foreach ($data as $d_key => $dvalue) { ?>
                                                <li><img class="ck_img" src="<?php echo base_url('assets/admin/products/') . $dvalue['p']['product_image'] ?>">
                                                    <label class="ck_test ch_pro"><?php echo $dvalue['p']['product_name'] ?></label>
                                                    <p class="ck_test ck_pri_qty">
                                                        <?php echo $currency_symbol;
                                                        echo " ";
                                                        echo $dvalue['p']['sale_price'];
                                                        echo ' <i class="fa fa-times" aria-hidden="true"></i> ';
                                                        echo $dvalue['c']['qty'] ?>
                                                    </p> <span><?php echo $currency_symbol ?>
                                                        <?php echo number_format($dvalue['p']['sale_price'] * $dvalue['c']['qty']); ?>
                                                    </span>
                                                </li>
                                            <?php } ?>


                                            <li><label class="ck_test ch_fee"><?php echo lang('fees'); ?></label>
                                                <span><?php echo $currency_symbol ?>
                                                    <?php echo number_format($all_fees, 2); ?> </span>
                                            </li>
                                        </ul>
                                        <ul class="sub-total">
                                            <li><?php echo lang('Total_before_VAT'); ?> <span class="count"><?php echo $currency_symbol ?>
                                                    <?php echo number_format($product_fees_without_vat, 2); ?> </span></li>
                                            <li><?php echo lang('Estimated_VAT_to_be_collected'); ?> <span class="count"><?php echo $currency_symbol ?>
                                                    <?php echo number_format($vat_calulated, 2); ?> </span></li>
                                            <!-- <li>Shipping
                                 <div class="shipping">
                                     <div class="shopping-option">
                                         <input type="checkbox" name="free-shipping" id="free-shipping">
                                         <label for="free-shipping">Free Shipping</label>
                                     </div>
                                     <div class="shopping-option">
                                         <input type="checkbox" name="local-pickup" id="local-pickup">
                                         <label for="local-pickup">Local Pickup</label>
                                     </div>
                                 </div>
                                 </li> -->
                                        </ul>
                                        <ul class="total">
                                            <li><?php echo lang('Subtotal_s'); ?> <span class="count"><?php echo $currency_symbol ?>
                                                    <?php echo number_format($grand_total, 2); ?> </span></li>
                                        </ul>
                                    </div>
                                    <div class="payment-box">
                                        <!--  <div class="upper-box">
                              <div class="payment-options">
                                 <ul>
                                    <li>
                                       <div class="radio-option">
                                          <input type="radio" value="cash-on-del" name="payment_mode" id="ck_cod">
                                          <label for="ck_cod">Cash On Delivery</label>
                                       </div>
                                    </li>
                                    <li>
                                       <div class="radio-option paypal">
                                          <input type="radio" value="online" name="payment_mode" id="ck_online">
                                          <label for="ck_online">Online Payment<span class="image">
                                          </span></label>
                                       </div>
                                    </li>
                                 </ul>
                              </div>
                           </div> -->
                                        <div class="text-right">
                                            <div class="col-6" style="display: none"><a id="vc_addlink" href="<?php echo base_url($language . '/home/checkout'); ?>" class="btn btn-solid">check out</a></div>
                                            <button type="button" class="btn btn-solid pl_ordr_chckbtn"><?php echo lang('Place_Order'); ?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <h1 class="text-center text-danger">Your Cart Is Empty</h1>
                        <?php } ?>

                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- section end -->

<script type="text/javascript">
    $(document).on("click", ".pl_ordr_chckbtn", function() {
        var payment_mode = $('input[name=payment_mode]:checked').val();
        var error = 1;
        if (typeof payment_mode === "undefined") {
            swal("", "<?php echo lang('Select_Payment_Option'); ?>", "warning");
            error = 0;
            return false;
        } else {
            var ck_link = "<?php echo base_url($language . '/home/checkout/'); ?>" + payment_mode;
            $("#vc_addlink").attr("href", ck_link);
            $("#vc_addlink")[0].click()
        }

    });
</script>