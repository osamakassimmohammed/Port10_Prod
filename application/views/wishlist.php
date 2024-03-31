<link
    href='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.css'
    rel='stylesheet' media='screen'>
<script
    src='<?php echo base_url(); ?>/assets/grocery_crud/themes/datatables/jquery-datatable/jquery.dataTables.js'></script>
<script
    src='<?php echo base_url(); ?>/assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.js'></script>
<link href="<?php echo base_url(); ?>assets/frontend/fonts/icomoon/icomoon.css"
      rel="stylesheet">
<style type="text/css">
    .hide_data {
        display: none;
    }

    .show_data {
        display: block;
    }

    .container.container_detl_wdth {
        padding: 0px;
        margin-top: 30px;
    }

    body {
        background: #f8fbfd;
    }
</style>
<?php
if (!empty($product_data)) {
    $hide = "hide_data";
} else {
    $hide = "show_data";
} ?>
<section class="cart-section section-b-space wishlist_page wishlist_page_seprt">
    <div class="container container_detl_wdth">
        <div class="row ">
            <div class="col-sm-12">
                <h1 class="<?php echo $hide; ?> text-center text-danger"><?php echo lang('YOUR_WISHLIST_IS_EMPTY'); ?></h1>
                <?Php if (!empty($product_data)) { ?>
                    <div class="left_cart_box hide_cart_div">
                        <table class="table cart-table table-responsive-xs ">
                            <thead>
                            <tr class="table-head">
                                <th scope="col"
                                    class="th_crt2"><?php echo lang('Items'); ?></th>
                                <!-- <th scope="col" class="th_crt3" >product name</th> -->
                                <th scope="col" class="th_crt4"
                                    style="text-align: left; padding-left: 42px;"><?php echo lang('quantity'); ?></th>
                                <th scope="col"
                                    class="th_crt5"><?php echo lang('Price'); ?></th>
                                <th scope="col" class="th_crt6"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            foreach ($product_data as $product_key => $product_value) { ?>
                                <tr class="remove_pro<?php echo $product_value['id']; ?> row_count">
                                    <td class="th_crt2">
                                        <div class="img_sec_lft">

                                            <a data-toggle="tooltip" title=""
                                               href="javascript:void(0)"
                                               class="icon delete_pro"
                                               onclick="remove_cart(<?php echo $product_value['id']; ?>,'wishlist')"
                                               data-original-title="Remove"><i
                                                    class="fa fa-times-circle"></i></a>

                                            <a href="<?php echo base_url($language . '/home/detail/') . $product_value['id']; ?>"><img
                                                    src="<?php echo base_url("assets/admin/products/") . $product_value['product_image']; ?>"
                                                    alt=""></a>
                                            <div class="clear"></div>

                                        </div>
                                        <div class="nme_sec_right">
                                            <a class="prdct_name_cart"
                                               href="<?php echo base_url($language . '/home/detail/') . $product_value['id']; ?>">
                                                <span> <?Php echo $product_value['product_name']; ?></span>
                                            </a>
                                        </div>
                                        <br/>
                                        <?php if (!empty($product_value['unit_list'])) { ?>
                                            <select
                                                class="form-control select_unit get_unit<?php echo $i; ?>">
                                                <?php
                                                foreach ($product_value['unit_list'] as $uld_key => $uld_value) {
                                                    ?>
                                                    <option
                                                        data-id="<?php echo $uld_value['id'] ?>"><?php echo $uld_value['unit_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        <?php } ?>
                                        <?php if (isset($product_value['meta_data']) && !empty($product_value['meta_data'])) { ?>
                                            <select
                                                class="form-control select_size get_size<?php echo $i; ?>">
                                                <option value="0">Select Size</option>
                                                <?php foreach ($product_value['meta_data'] as $md_key => $md_val) { ?>
                                                    <option
                                                        data-price="<?php echo $md_val['price']; ?>"
                                                        data-value="<?php echo $md_val['size']; ?>"
                                                        value="<?php echo $md_val['item_id']; ?>"><?php echo $md_val['size']; ?></option>
                                                <?php } ?>
                                            </select>
                                        <?php } ?>

                                    </td>
                                    <td class="th_crt4">
                                        <div class="qty qty-changer qty-changer_cart">
                                            <fieldset>
                                                <span type="button" value="‒"
                                                      class="decrease"></span>
                                                <input type="text"
                                                       class="qty-input detislqty<?php echo $i ?>"
                                                       value="1" data-min="1"
                                                       data-max="10" id="m1m7"
                                                       data-value="1" disabled="">
                                                <span type="button" value="+"
                                                      class="increase"></span>
                                            </fieldset>
                                        </div>
                                    </td>
                                    <td class="th_crt5">
                                        <h2><?php echo $product_value['sale_price']; ?><?php echo $currency_symbol; ?></h2>
                                    </td>

                                    <td class="th_crt6">
                                        <h2 class="td-color">
                                            <?php if ($product_value['price_select'] == '1') { ?>
                                                <a href="javascript:void(0)"
                                                   class="ad_to_cart add_to_cart2"
                                                   data-id="<?php echo $product_value['id']; ?>"
                                                   data-unit="get_unit<?php echo $i; ?>"
                                                   data-detislqty="detislqty<?php echo $i ?>"
                                                   class="add_to_cart2"> <?php echo lang('Add_to_cart'); ?> </a>
                                            <?php } else { ?>
                                                <a href="javascript:void(0)"
                                                   class="ad_to_cart"
                                                   data-class="get_size<?php echo $i; ?>"
                                                   data-id="<?php echo $product_value['id']; ?>"
                                                   data-unit="get_unit<?php echo $i; ?>"
                                                   data-detislqty="detislqty<?php echo $i ?>"> <?php echo lang('Add_to_cart'); ?> </a>
                                            <?php } ?>
                                        </h2>
                                    </td>
                                </tr>
                                <?php $i++;
                            } ?>
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
    $('.js-exportable').DataTable({
        dom: 'Bfrtip',
        "info": false,
        responsive: true,
        "order": [[0, "desc"]],
        "pageLength": 5,
    });

</script>

<script type="text/javascript">
    $(document).on("click", ".hl_sort", function () {
        sort = $(this).attr('data-sort');
        window.location = '<?php echo base_url($language . '/my_account/wishlist') ?>?sort=' + sort;

    });
</script>
