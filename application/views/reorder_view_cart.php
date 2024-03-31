<style type="text/css">

    .form-control.select_unit {
        width: 100%;
    }

    .home_active {
        font-weight: 600 !important;
        color: #c09550 !important;
    }

    .contnr_main_headr.hedr_fixed {
        position: static;
        box-shadow: 0px 0px 0px #fff;
    }

    .hide_data {
        display: none;
    }

    .show_data {
        display: block;
    }

    .left_cart_box {
        width: 98%;
        margin-left: 1%;
    }

    .right_cart_box {
        margin-right: 1%;
        margin-top: 20px;
        width: 25%;
    }

    .th_crt6 {
        border-left: 1px solid;
    }


    .th_crt4 .qty-changer_cart {
        margin-top: 30px !important;
    }

    .cart-section tbody tr td h2 {
        margin-top: 20px;
    }

    body {
        background: #f8fbfd;
    }

    .cart_pg_titl h2 {
        font-weight: 600;
        text-transform: uppercase;
    }

    .container.container_detl_wdth {
        padding: 0px;
    }

    /*.row.hide_cart_div{
          float: left;
      width: 100%;
      margin-top: -30px;
    }*/
    .payment_div {
        margin-left: 40px;
        margin-bottom: 15px;
    }

    }
</style>
<?php
if (!empty($data_res) && $data_res['status'] == 1) {
    $hide = "hide_data";
} else {
    $hide = "show_data";
} ?>

<!--section start-->
<section class="cart-section section-b-space" style="padding-top: 20px;">
    <?php if (!empty($data_res) && $data_res['status'] == 1){ ?>
    <form method="post" id="re_order"
          action="<?php echo base_url($language . '/order/buynow') ?>">
        <div class="radio-option payment_div">
            <input type="radio" value="<?php echo en_de_crypt('cash-on-del'); ?>"
                   name="payment_mode" id="ck_cod">
            <label for="ck_cod"><?php echo lang('Virtual_Account_Transfer'); ?></label>
            <input type="radio" value="<?php echo en_de_crypt('online'); ?>"
                   name="payment_mode" id="ck_online">
            <label for="ck_online"><?php echo lang('Card'); ?><span class="image">
      </span></label>
        </div>
        <?php } ?>
        <div class="container container_detl_wdth">
            <h1 class="<?php echo $hide; ?> text-center text-danger"><?php echo $data_res['message']; ?></h1>
            <!-- <h1 class="<?php //echo $hide; ?> text-center text-danger"><?php //echo lang('YOUR_SHOPPING_CART_IS_EMPTY'); ?></h1> -->
            <!-- <div class="col-6 <?php //echo $hide; ?>"><a href="<?php //echo base_url($language.'/home/listing/1'); ?>" class="btn btn-solid pull-left"><?php //echo lang('continue_shopping'); ?></a></div> -->
            <?php if (!empty($data_res) && $data_res['status'] == 1) { ?>
                <div class="row hide_cart_div">
                    <div class="col-sm-12">

                        <div class="left_cart_box">
                            <table class="table cart-table table-responsive-xs ">
                                <thead>
                                <tr class="table-head">

                                    <th scope="col" class="th_crt2"
                                        style="padding-left: 60px; text-align: left;"><?php echo lang('Items'); ?></th>
                                    <!-- <th scope="col" class="th_crt3" >product name</th> -->
                                    <!-- <th scope="col" class="th_crt4" style="padding-right: 60px;" >Unit</th> -->
                                    <th scope="col" class="th_crt4"
                                        style="padding-right: 0px; text-align: left; padding-left: 45px;"><?php echo lang('quantity'); ?></th>
                                    <th scope="col"
                                        class="th_crt5"><?php echo lang('Price'); ?></th>
                                    <th scope="col"
                                        class="th_crt5"><?php echo lang('fees'); ?> </th>
                                    <th scope="col"
                                        class="th_crt5"><?php echo lang('VAT'); ?> </th>
                                    <th scope="col"
                                        class="th_crt6"><?php echo lang('total'); ?></th>
                                </tr>
                                </thead>
                                <?php
                                $grand_total = $grand_total_inc = 0;
                                foreach ($data_res['data'] as $d_key => $dvalue) {
                                    // echo "<pre>";
                                    // print_r($data);
                                    // die;
                                    $pid = $dvalue['id'];
                                    $qty = $dvalue['quantity'];
                                    $unit = $dvalue['unit'];
                                    $price = $dvalue['sale_price'];
                                    $pro_total = $price * $qty;
                                    $vat = $tax_table[0]['vat'];
                                    // $grand_total=$pro_total+$grand_total;

                                    $commission = $tax_table[0]['commission'];
                                    $single_commission = ($commission * $pro_total) / 100;
                                    $single_commission = ($commission * $pro_total) / 100;
                                    if ($single_commission > $tax_table[0]['cap_rate']) {
                                        $single_commission = $tax_table[0]['cap_rate'];
                                    }
                                    $pro_total = $pro_total + $single_commission;
                                    $single_vat = ($vat * $pro_total) / 100;
                                    $pro_total = $pro_total + $single_vat;

                                    $product_image = explode("/", $dvalue['product_image']);
                                    $product_image = count($product_image);
                                    if ($product_image == 1) {
                                        $image_url = base_url("assets/admin/products/") . $dvalue['product_image'];
                                    } else {
                                        $image_url = $dvalue['product_image'];
                                    }

                                    $grand_total_inc = $pro_total + $grand_total_inc;
                                    ?>

                                    <tr class="remove_pro<?php echo $dvalue['id']; ?>">


                                        <td class="th_crt2">

                                            <div class="img_sec_lft">
                                                <a href="<?php echo base_url($language . '/home/detail/') . $dvalue['id']; ?>"><img
                                                        src="<?php echo base_url('assets/admin/products/') . $dvalue['product_image']; ?>"
                                                        alt=""></a>
                                                <div class="clear"></div>

                                                <div style="margin-top: 10px;">
                      <span style="display: none" class="wishlist<?php echo $pid; ?>">
                      <?php if (@$dvalue['p']['wish_list'] == 1) { ?>
                          <a style="margin-right: 7px;" data-toggle="tooltip"
                             title="Move To Wishlist" href="javascript:void(0)"
                             class="icon" data-id=""
                             onclick="remove_cart('<?php echo $pid; ?>','view_cart')">
                        <img
                            src="<?php echo base_url(); ?>assets/frontend/images/wish_icon.png"
                            class="wishl_a_crt">
                      </a>
                      <?php } else { ?>
                          <a style="margin-right: 7px;" data-toggle="tooltip"
                             title="Move To Wishlist" href="javascript:void(0)"
                             class="icon" data-id=""
                             onclick="move_to_wish_list('<?php echo $pid; ?>','view_cart')">
                        <img
                            src="<?php echo base_url(); ?>assets/frontend/images/wish_icon.png"
                            class="wishl_a_crt">
                      </a>
                      <?php } ?>
                      </span>

                                                </div>

                                            </div>

                                            <div class="nme_sec_right">
                                                <a class="prdct_name_cart"
                                                   href="<?php echo base_url($language . '/home/detail/') . $dvalue['id']; ?>">
                                                    <span> <?php echo $dvalue['product_name']; ?> </span>
                                                </a>
                                                <?php if (isset($dvalue['c']['metadata']) && !empty($dvalue['c']['metadata'])) { ?>
                                                    <br>
                                                    <span
                                                        class="size_cart_m">Size:<?php echo $dvalue['c']['metadata']['size']; ?></span>
                                                <?php } ?>

                                                <?php if (!empty($dvalue['unit_list'])) { ?>
                                                    <select
                                                        class="form-control select_unit  unite1 change_unit"
                                                        name="unit">
                                                        <?php
                                                        foreach ($dvalue['unit_list'] as $uld_key => $uld_value) {
                                                            $unit_selected = ($unit == $uld_value['id']) ? "selected" : "";
                                                            ?>
                                                            <option
                                                                data-pid="<?php echo $pid; ?>"
                                                                data-unitid="<?php echo $uld_value['id'] ?>"
                                                                data-key="<?php echo $dvalue['id']; ?>" <?php echo $unit_selected; ?>><?php echo $uld_value['unit_name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                <?php } ?>

                                            </div>

                                        </td>
                                        <!--  <td class="th_crt3" > </td> -->
                                        <!-- <h2>liter</h2> -->
                                        <!-- <td class="th_crt4" > </td> -->

                                        <td class="th_crt4">
                                            <div
                                                class="qty qty-changer qty-changer_cart">
                                                <fieldset>
                                                    <span type="button" value="‒"
                                                          class="decrease"
                                                          onclick="productQty(this)"
                                                          data-target="<?php echo $dvalue['id']; ?>"
                                                          data-key="<?php echo $dvalue['id']; ?>"
                                                          data-sale-value="<?php echo decnum($price); ?>"
                                                          data-product-id="<?php echo $pid; ?>"></span>
                                                    <input type="text" class="qty-input"
                                                           value="<?php echo $qty; ?>"
                                                           data-min="1" data-max="10"
                                                           id="<?php echo $dvalue['id']; ?>"
                                                           data-value="<?php echo $qty ?>"
                                                           name="quantity" readonly>
                                                    <span type="button" value="+"
                                                          class="increase"
                                                          onclick="productQty(this)"
                                                          data-target="<?php echo $dvalue['id']; ?>"
                                                          data-key="<?php echo $dvalue['id']; ?>"
                                                          data-sale-value="<?php echo decnum($price); ?>"
                                                          data-product-id="<?php echo $pid; ?>"></span>
                                                </fieldset>
                                                <input type="hidden" name="pid"
                                                       value="<?php echo $dvalue['id']; ?>">
                                            </div>
                                        </td>
                                        <td class="th_crt5">
                                            <h2><?php echo $currency_symbol; ?> <span
                                                    id="qp<?php echo $dvalue['id']; ?>"><?php echo decnum($price * $qty); ?></span>
                                            </h2>

                                        </td>

                                        <td class="th_crt5">
                                            <h2 id="c<?php echo $dvalue['id']; ?>">
                                                <?php echo decnum($single_commission); ?>
                                            </h2>

                                        </td>

                                        <td class="th_crt5">
                                            <h2>
                                                <?php echo $vat; ?>%
                                            </h2>

                                        </td>

                                        <td class="th_crt6">
                                            <h2 class="td-color"><?php echo $currency_symbol; ?>
                                                <span
                                                    id="p<?php echo $dvalue['id']; ?>"><?php echo decnum($pro_total); ?></span>
                                            </h2>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>

                        <div
                            style="float: left; margin-right: 0px; padding: 0px; font-size: 13px; font-weight: 600; margin-top: -31px; padding-top: 30px; width: 100%;">


                            <span
                                style="margin-left: 0px; padding-top: 21px; font-size: 20px; text-transform: uppercase; display: inline-block; float: right; width: 13.9%; text-align: center;"><?php echo $currency_symbol; ?> <span
                                    class="total_sale_price"><?php echo decnum($grand_total_inc); ?></span></span>
                            <span
                                style="border-right: 1px solid #e7e7e7; height: 74px; position: static; margin-left: 0px; float: right;"></span>

                            <span
                                style="margin-right: 17px; padding-top: 21px; font-size: 20px; text-transform: uppercase; display: inline-block; float: right;"><?php echo lang('Sub_total'); ?></span>

                        </div>

                        <!-- <div class="product-right product-form-box right_cart_box">
               <div class="subtotl_labl_tb" >Subtotal Price :</div>
               <div>
                        <h2><?php //echo $currency_symbol; ?> <span class="total_sale_price"><?php //echo decnum($grand_total_inc); ?></span> </h2>
               </div>
            </div> -->


                        <div class="clear"></div>

                    </div>
                </div>
                <div class="clear"></div>

                <div class="row cart-buttons hide_cart_div">
                    <!-- <div class="col-6"><a href="<?php //echo base_url($language.'/home/listing/1'); ?>" class="btn btn-solid pull-left">continue shopping</a></div> -->
                    <!-- <div class="col-12"> -->
                    <button
                        style="margin-right: 4%; position: absolute; margin-top: 6px; float: right; right: 0; "
                        class="btn btn-solid"><?php echo lang('CHECKOUT'); ?></button>
                    <!-- </div> -->

                </div>
            <?php } ?>

        </div>
    </form>
</section>
<!--section end-->

<script type="text/javascript">
    $(document).on('click', '.decrease, .increase', function (e) {
        var $this = $(e.target),
            input = $this.parent().find('.qty-input'),
            v = $this.hasClass('decrease') ? input.val() - 1 : input.val() * 1 + 1,
            min = input.attr('data-min') ? input.attr('data-min') : 1,
            max = input.attr('data-max') ? input.attr('data-max') : false;
        if (v >= min) {
            if (!max == false && v > max) {
                return false
            } else input.val(v);
        }
        e.preventDefault();
    });
</script>
<script type="text/javascript">
    $(document).on("submit", "#re_order", function () {
        var payment_mode = $('input[name=payment_mode]:checked').val();
        var error = 1;
        if (typeof payment_mode === "undefined") {
            swal("", "<?php echo lang('Select_Payment_Option'); ?>", "warning");
            error = 0;
            return false;
        }
    });
</script>
<script type="text/javascript">
    // var qty = -1;
    var shipping_charg =<?php echo $tax_table[0]['shipping_charge'] ?>;
    var vat =<?php echo $tax_table[0]['vat'] ?>;
    var commission =<?php echo $tax_table[0]['vat'] ?>;
    var cap_rate =<?php echo $tax_table[0]['cap_rate'] ?>;

    function productQty(e) {
        // alert(vat);
        // return false;

        var op = jQuery(e).attr("class");
        // alert(op);
        var target = jQuery(e).attr("data-target");
        //alert(target);
        var key = jQuery(e).attr("data-key");
        var pid = jQuery(e).attr("data-product-id");
        qty = jQuery('#' + target).attr('data-value');
        //alert(qty);
        var old_qty = qty;
        var newqty = qty;
        // var sv = jQuery('#sv'+target).val();
        // var pv = jQuery('#pv'+target).val();
        // var tax_rate = jQuery('#tax'+target).val();
        // var save_amt = parseFloat( jQuery('#save_amt').text() );
        var sale_price = parseFloat(jQuery(e).attr('data-sale-value'));
        var sale_prices = sale_price;
        // var price4= parseFloat (jQuery('.total_sale_price2').text());
        var price4 = parseFloat(jQuery('.total_sale_price').text());
        // alert(Number.isInteger(shipping_charg));
        // return false;
        // alert(price4);
        var status = true;
        if (op == 'decrease') {
            if (qty > 1) {
                qty--;
                newqty = -1;
            } else {
                status = false;
            }
        } else {
            qty++;
            newqty = qty;
        }
        // cqty:qty
        if (status) {

            var res = qty - old_qty;
            // var save = pv - sv;
            var trans_amt = 0;

            jQuery('#' + target).attr('data-value', qty);
            jQuery('#' + target).text(qty);
            jQuery('#qty' + target).text(qty);

            var total_sale_price = parseFloat(qty * sale_prices);
            var qty_into_price = parseFloat(qty * sale_prices);
            single_commission = (commission * total_sale_price) / 100;
            single_commission = (commission * total_sale_price) / 100;
            if (single_commission > cap_rate) {
                single_commission = cap_rate;
                // alert(single_commission);
            }
            single_vat = (vat * (total_sale_price + single_commission)) / 100;
            total_sale_price = total_sale_price + single_vat + single_commission;
            // alert(Number.isInteger(total_sale_price));
            jQuery('#p' + target).text(total_sale_price.toFixed(2));
            jQuery('#c' + target).text(single_commission.toFixed(2));
            jQuery('#qp' + target).text(qty_into_price.toFixed(2));
            if (op == 'decrease') {
                sppc = ((commission * sale_prices) / 100);
                sppc = sale_prices + sppc;
                sppv = ((vat * sppc) / 100);
                tsppvc = sppv + sppc;

                value8 = price4 - tsppvc;


                // jQuery('.total_sale_price').text(value8.toFixed(2));
                jQuery('.total_sale_price').text(total_sale_price.toFixed(2));

            } else {

                sppc = ((commission * sale_prices) / 100);
                sppc = sale_prices + sppc;
                sppv = ((vat * sppc) / 100);
                tsppvc = sppv + sppc;
                value8 = tsppvc + price4;


                // jQuery('.total_sale_price').text(value8.toFixed(2));
                jQuery('.total_sale_price').text(total_sale_price.toFixed(2));

            }

        }
    }
</script>

<script type="text/javascript">
    function remove_me(pid) {
        swal({
                title: "",
                text: "Do You Want To Delete This Product From Cart",
                type: "warning",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
                confirmButtonText: "Yes",
                cancelButtonText: "CANCEL",
            },
            function () {
                $('#loading').show();
                remove_ok(pid);
            });
    }

    $(document).on("click", ".delete_pro", function () {
        var pid = $(this).data("id");
        // alert(pid);
        remove_me(pid);
    });

    function remove_ok(pid) {
        if (pid != '') {
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('my_cart/remove_from_cart'); ?>',
                data: {pid: pid},
                success: function (response) {
                    $('#loading').hide();
                    if (response == 'some') {
                        swal("", "Something went wrong");
                    } else {
                        var data = $.parseJSON(response);
                        var pro_count = data['pro_count'];
                        // var total_price=data['total_price'];
                        pro_price = parseFloat($('#p' + pid).text());
                        // total_price= parseFloat (jQuery('.total_sale_price2').text());
                        total_price = parseFloat(jQuery('.total_sale_price').text());
                        // alert(total_price);
                        // alert(pro_price);
                        total_price = total_price - pro_price;
                        // alert(total_price);
                        // vat_cal=(total_price*vat)/100;
                        // alltotal_price=total_price+vat_cal+shipping_charg;
                        view_cart_count();
                        total_price = total_price.toFixed(2);
                        // alert(total_price);
                        alltotal_price = total_price;
                        if (pro_count == 0) {
                            $(".hide_data").show();
                            $(".hide_cart_div").hide();
                            swal("Deleted", "Product Deleted Successfully", "success");
                            $(".remove_pro" + pid).remove();
                            $(".cart_show").text(pro_count);
                        } else {
                            swal("Deleted", "Product Deleted Successfully", "success");
                            $(".remove_pro" + pid).remove();
                            // $('.total_sale_price2').text(total_price);
                            // $('.total_sale_price').text(total_price+shipping_charg);
                            // $('.total_sale_price2').text(total_price);
                            // $('#vat_add').text(vat_cal);
                            $('.total_sale_price').text(alltotal_price);
                            // $('.total_sale_price_new').text(alltotal_price);
                            $(".cart_show").text(pro_count);
                        }
                    }
                }
            });
        } else {
            swal("", "Something went wrong", 'warning');
        }
    }
</script>
