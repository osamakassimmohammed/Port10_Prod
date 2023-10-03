<style type="text/css">
    .home_active {
        font-weight: 600 !important;
        color: #c09550 !important;
    }

    .reorder_btn {
        background: #004670;
        padding: 10px 15px;
        border-radius: 100px;
        color: #fff !important;
    }

    .writec {
        /*font-size: 36px;*/
        color: #222222;
        text-transform: uppercase;
        font-weight: 600;
        line-height: 1;
        letter-spacing: 0.02em;
    }

    .or_unit {
        margin-left: 00px;
        margin-top: -30px;
        font-weight: 600;
        line-height: 23px;
        width: 100%;
        /* text-align: center; */
        display: inline-block;
        margin-left: 0px;
    }

    .or_pro {
        margin-left: 00px;
        width: 100%;
        /* th_crt6 */
        display: inline-block;
        margin-top: 7px;
    }

    td {
        vertical-align: middle !important;
    }

    .or_qty {
        text-align: center;
    }

    body {
        background: #f8fbfd;
    }

    .table thead th {
        vertical-align: bottom;
        border-bottom: 1px solid #dee2e6;
        border-top: 0px;
    }

    .btn-solid {
        padding: 10px 10px !important;
    }
</style>
<style type="text/css">
    .home_active {
        font-weight: 600 !important;
        color: #c09550 !important;
    }

    .modal-content {
        width: 120%;
    }

    .contnr_main_headr.hedr_fixed {
        position: static;
        box-shadow: 0px 0px 0px #fff;
    }

    .required {
        color: red !important;
        padding: 2px
    }

    .checkout-page .checkout-form .form-group {
        position: relative;
        margin-bottom: 25px;
        color: #333333;
        font-weight: 700;
    }

    .viewcrt_optn_pymnt {
        padding-left: 0px;
        padding-top: 0px;
        padding-bottom: 0px;
    }



    .modal-title {
        font-weight: 550
    }

    .slid_bot_btn2 {
        color: #fd3a58;
        width: 7rem;
    }

    <?php $disabled = '';

    if ($is_calculate_rate == 0) {
    ?>.shipping_rate_li {
        display: none;
    }

    <?php $disabled = 'disabled';
    }

    ?>
</style>
<div class="holder mt-0">
    <div class="container">
        <ul class="breadcrumbs">
            <li><a href="<?php echo base_url($language); ?>"><?php echo lang('h_home'); ?></a></li>
            <li><span>
                    <?php echo lang('order_history'); ?>
                </span></li>
        </ul>


    </div>
</div>

<div class="holder mt-0">

    <div class="container">
        <div class="row">
            <div class="col-lg-12 wrap_old_histry">
                <a href="<?php echo base_url($language . '/my_account/orders/'); ?>" class="product-item-price btn btn-solid mb-3"> Order List</a>

                <?php if (!empty($orders)) {
                    foreach ($orders as $key => $orders_value) { ?>
                        <div class="table-responsive">
                            <h3>Remove</h3>
                            <table class="table check-tbl">
                                <thead>
                                    <tr>
                                        <th colspan="1">
                                            Order id
                                        </th>
                                        <th>
                                            Name
                                        </th>
                                        <th>
                                            Email
                                        </th>
                                        <th>
                                            Mobile
                                        </th>
                                        <th>
                                            Pincode
                                        </th>
                                        <th>
                                            Address
                                        </th>
                                        <th>
                                            Merged
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>


                                    <tr class="alert">



                                        <td class="" style="color:black">
                                            <?php echo $orders_value['id']; ?>
                                        </td>
                                        <td class="" style="color:black">
                                            <?php echo $orders_value['first_name']; ?>
                                        </td>
                                        <td class="" style="color:black">
                                            <?php echo $orders_value['email']; ?>
                                        </td>
                                        <td class="" style="color:black">
                                            <?php echo $orders_value['mobile_no']; ?>
                                        </td>
                                        <td class="" style="color:black">
                                            <?php echo $orders_value['pincode']; ?>
                                        </td>
                                        <td class="" style="color:black">
                                            <?php echo $orders_value['address_1']; ?>
                                        </td>
                                        <td class="" style="color:black">
                                            <div class="row check-out">
                                                <div class="pin-code-check form-group col-md-6 mb-4">
                                                    <input type="hidden" placeholder="Check Pin Code" value="<?php echo $orders_value['id']; ?>" id="unmerged_order_ids">
                                                    <input type="hidden" placeholder="Check Pin Code" value="<?php echo $orders_value['child']; ?>" id="unmerged_order_id_check">
                                                    <a class="btn btn-solid pl_ordr_chckbtn mt-4" id="unmerged_check_btn" style="color:#ffff">Unmerged Order</a>
                                                </div>
                                            </div>

                                        </td>

                                    </tr>




                                </tbody>
                            </table>
                        </div>
                    <?php }
                } else { ?>


                    <p class="alert alert-primary" style="color: #ef5b28; text-align:center; font-size: 20px;" role="alert">
                        Admin Order Group History Empty
                    </p>
                <?php } ?>
                <hr>
                <hr>
                <?php if (!empty($childorders)) {
                    foreach ($childorders as $key => $childorders_value) { ?>
                        <div class="table-responsive">
                            <h3>ADD</h3>
                            <table class="table check-tbl">
                                <thead>
                                    <tr>
                                        <th colspan="1">
                                            Order id
                                        </th>
                                        <th>
                                            Name
                                        </th>
                                        <th>
                                            Email
                                        </th>
                                        <th>
                                            Mobile
                                        </th>
                                        <th>
                                            Pincode
                                        </th>
                                        <th>
                                            Address
                                        </th>
                                        <th>
                                            Merged
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>


                                    <tr class="alert">

                                        <td class="" style="color:black">
                                            <?php echo $childorders_value['id']; ?>
                                        </td>
                                        <td class="" style="color:black">
                                            <?php echo $childorders_value['first_name']; ?>
                                        </td>
                                        <td class="" style="color:black">
                                            <?php echo $childorders_value['email']; ?>
                                        </td>
                                        <td class="" style="color:black">
                                            <?php echo $childorders_value['mobile_no']; ?>
                                        </td>
                                        <td class="" style="color:black">
                                            <?php echo $childorders_value['pincode']; ?>
                                        </td>
                                        <td class="" style="color:black">
                                            <?php echo $childorders_value['address_1']; ?>
                                        </td>
                                        <td class="" style="color:black">
                                            <div class="row check-out">
                                                <div class="pin-code-check form-group col-md-6 mb-4">
                                                    <input type="hidden" placeholder="Check Pin Code" value="<?php echo $childorders_value['id']; ?>" id="pin_order_ids">
                                                    <input type="hidden" placeholder="Check Pin Code" value="<?php echo $childorders_value['pincode']; ?>" id="pin_check">
                                                    <a class="btn btn-solid pl_ordr_chckbtn mt-4" id="pin_check_btn" style="color:#ffff">Check Merged Order</a>
                                                </div>
                                            </div>

                                        </td>

                                    </tr>




                                </tbody>
                            </table>
                        </div>
                    <?php }
                } else { ?>


                    <p class="alert alert-primary" style="color: #ef5b28; text-align:center; font-size: 20px;" role="alert">
                        Order Group History Empty
                    </p>
                <?php } ?>
            </div>
        </div>

    </div>

</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Request Group Purchasing</h5>
                <button type="button" class="close modal_close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url($language . '/home/group_purchasing_submit') ?>" method="POST">
                <input type="hidden" placeholder="Check Pin Code" value="" name='new_order_ids' id="new_order_ids">
                <div class="modal-body">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="table_data_table">
                        <thead>
                            <tr>
                                <th>Order id</th>
                                <th>Pincode</th>
                                <th>Email</th>
                                <th>Phone</th>
                            </tr>
                        </thead>

                        <tbody id="table_data">

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" id="modal_close" class="slid_bot_btn2 modal_close" data-dismiss="modal">Close</button>
                    <button style="padding: 7px 22px;" type="submit" class="btn btn-solid">Submit</button>

                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Remove Group Purchasing</h5>
                <button type="button" class="close modal_close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url($language . '/home/place_order_remove') ?>" method="POST">
                <input type="hidden" placeholder="Check Pin Code" value="" name='parent_order_id' id="parent_order_id">

                <div class="modal-body">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="table_data_table">
                        <thead>
                            <tr>
                                <th>Order id</th>
                                <th>Pincode</th>
                                <th>Email</th>
                                <th>Phone</th>
                            </tr>
                        </thead>

                        <tbody id="table_data1">

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" id="modal_close" class="slid_bot_btn2 modal_close" data-dismiss="modal">Close</button>
                    <button style="padding: 7px 22px;" type="submit" class="btn btn-solid">Submit</button>

                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<script type="text/javascript">
    $(document).ready(function() {

        $('input[type=radio][name=purchasing_mode]').change(function() {
            if (this.value == 'Group purchasing') {
                $('.pin-code-check').show();
            } else if (this.value == 'Single purchasing') {
                $('.pin-code-check').hide();
            }
        });



        $('#unmerged_check_btn').click(function() {

            var order_id_check = $('#unmerged_order_id_check').val();
            var unmerged_order_ids = $('#unmerged_order_ids').val();
            $('#parent_order_id').val(unmerged_order_ids);

            $.ajax({
                url: '<?php echo base_url($language . '/home/get_unmerged_check_group_orders') ?>',
                method: 'POST',
                data: {
                    "order_id_check": order_id_check
                },
                success: function(response) {
                    var relatedOrders = JSON.parse(response);

                    var result = [];

                    // Loop through relatedOrders and create the resultant array
                    for (var i = 0; i < relatedOrders.length; i++) {
                        if (Array.isArray(relatedOrders[i])) {
                            var nestedResult = [];
                            var nestedorderid = [];
                            var nestedorderemail = [];
                            var nestedordermobile = [];
                            for (var j = 0; j < relatedOrders[i].length; j++) {
                                var order = relatedOrders[i][j];
                                nestedResult.push('Order ID ' + order[i].id + '<br>');
                                nestedorderemail.push(order[i].email + '<br>');
                                nestedordermobile.push(order[i].mobile_no + '<br>');
                                nestedorderid.push(order[i].id);

                            }
                            var html = '<tr>';
                            html +=
                                '<td> <input class="mr-1" type="radio" id="javascript" name="orderid_group_by" value="' +
                                nestedorderid + '">' + nestedResult + '</td>';
                            html += '<td>' + order[i].pincode + '</td>';
                            html += '<td>' + nestedorderemail[0] + '</td>';
                            html += '<td>' + nestedordermobile[0] + '</td></tr>';

                            $('#table_data1').append(html);
                            // result.push(nestedResult);
                        } else {
                            var order = relatedOrders[i];
                            result.push('Order ID ' + order.id);
                            var html = '<tr>';
                            html +=
                                '<td> <input class="mr-1" type="radio" id="javascript" name="orderid_group_by" value="' +
                                order.id + '"> Order ID ' + order.id + '</td>';
                            html += '<td>' + order.pincode + '</td>';
                            html += '<td>' + order.email + '</td>';
                            html += '<td>' + order.mobile_no + '</td></tr>';
                            $('#table_data1').append(html);
                        }
                    }

                    //  console.log(result);
                    $("#exampleModal1").modal('show');


                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
        $('#pin_check_btn').click(function() {

            var pin_check = $('#pin_check').val();
            var new_order_ids = $('#pin_order_ids').val();
            $('#new_order_ids').val(new_order_ids);


            $.ajax({
                url: '<?php echo base_url($language . '/home/get_pin_check_group_orders') ?>',
                method: 'POST',
                data: {
                    "pin_check": pin_check
                },
                success: function(response) {
                    var relatedOrders = JSON.parse(response);

                    var result = [];

                    // Loop through relatedOrders and create the resultant array
                    for (var i = 0; i < relatedOrders.length; i++) {
                        if (Array.isArray(relatedOrders[i])) {
                            var nestedResult = [];
                            var nestedorderid = [];
                            var nestedorderemail = [];
                            var nestedordermobile = [];
                            for (var j = 0; j < relatedOrders[i].length; j++) {
                                var order = relatedOrders[i][j];
                                nestedResult.push('Order ID ' + order[i].id + '<br>');
                                nestedorderemail.push(order[i].email + '<br>');
                                nestedordermobile.push(order[i].mobile_no + '<br>');
                                nestedorderid.push(order[i].id);

                            }
                            var html = '<tr>';
                            html +=
                                '<td> <input class="mr-1" type="radio" id="javascript" name="orderid_group_by" value="' +
                                nestedorderid + '">' + nestedResult + '</td>';
                            html += '<td> ' + order[i].pincode + '</td>';
                            html += '<td>' + nestedorderemail[0] + '</td>';
                            html += '<td>' + nestedordermobile[0] + '</td></tr>';

                            $('#table_data').append(html);
                            // result.push(nestedResult);
                        } else {
                            var order = relatedOrders[i];
                            result.push('Order ID ' + order.id);
                            var html = '<tr>';
                            html +=
                                '<td> <input class="mr-1" type="radio" id="javascript" name="orderid_group_by" value="' +
                                order.id + '"> Order ID ' + order.id + '</td>';
                            html += '<td>' + order.pincode + '</td>';
                            html += '<td>' + order.email + '</td>';
                            html += '<td>' + order.mobile_no + '</td></tr>';
                            $('#table_data').append(html);
                        }
                    }

                    //  console.log(result);
                    $("#exampleModal").modal('show');

                    $('input[type=radio][name=orderid_group_by]').change(function() {
                        $('#pin_order_ids').val(this.value);
                        $('#pin_order_ids').prop('readonly', true);
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });





    });
    $(".modal_close").click(function() {
        var html = '';
        $('#table_data_table  > tbody > tr').remove();
    });
    $(".data-save").click(function() {
        var html = '';
        $('#table_data_table  > tbody > tr').remove();
    });
</script>