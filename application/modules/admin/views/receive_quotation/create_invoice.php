<style type="text/css">
    .main_invoc_a {
        float: left;
        width: 80%;
        border: 1px solid #dbdbdb;
        margin-left: 10%;
        margin-top: 50px;
        margin-bottom: 50px;
        padding: 00px 30px;
        border-radius: 4px;
    }

    .invoic_title {
        text-align: center;
        font-weight: 500;
        font-size: 24px;
        margin-top: 40px;
        margin-bottom: 80px;
        color: #23023b;
        font-weight: 500;
    }

    .clear {
        clear: both;
    }

    .ref_num_invoc {
        display: inline-block;
        float: left;
        width: 47%;
    }


    .ref_num_invoc_date {
        float: right;
        text-align: right;
    }

    .ref_labela {
        display: inline-block;
        font-size: 15px;
        font-weight: 500;
        margin-right: 12px;
        width: 180px;
        border: 0px solid red;
        text-align: left;
        color: #666;
        font-size: 15px !important;
        font-weight: 600 !important;
    }

    .ref_numa {
        font-size: 14px;
        border: 1px solid #a9a9a9;
        border-radius: 3px;
        background: #ffffff;
        line-height: 24px;
        width: 50%;
        padding: 7px 12px;
        font-size: 14px;
        border-radius: 19px;
    }

    .label-success {
        background-color: #2b982b;
        font-size: 14px;
        font-weight: 500;
        padding: 7px 10px;
        float: left;
        margin-top: -5px;
    }

    .cusmr_inf_wrap {
        margin-top: 30px;
        width: 70%;
    }

    .cusmr_inf_wrap .ref_labela {
        width: 180px;
    }

    .custnr_adrea_name {
        margin-bottom: 20px;
    }

    .custnr_adrea_name .ref_labela {
        float: left;
    }

    .custnr_adrea_name .ref_numa {

    }

    .ref_numa_text {

    }

    .seril_num_wrp {
        margin-top: 20px;
        float: left;
        width: 100%;
        border: 1px solid #f1f2f7;
        margin-bottom: 40px;
    }

    .hed_lina_as {
        float: left;
        width: 100%;
        border: 1px solid #f1f2f7;
        font-size: 15px;
        background: #f1f2f7;
        border-bottom: 1px solid #f1f2f7;
    }

    .serlnum1 {
        float: left;
        width: 10%;
        text-align: center;
        border-left: 0px solid red;
        padding: 6px 0px;
    }

    .serlnum2 {
        float: left;
        float: left;
        width: 17%;
        text-align: center;
        border-left: 1px solid #f1f2f7;
        padding: 6px 0px;
    }

    .serlnum3 {
        float: left;
        float: left;
        width: 17%;
        text-align: center;
        border-left: 1px solid #f1f2f7;
        padding: 6px 0px;
    }

    .serlnum4 textarea {
        width: 90% !important;
        background: #fff;
        border: 1px solid #d8d8d8;
        border-radius: 3px;
        font-size: 13px;
    }

    .serlnum4 textarea:focus {
        outline: none;
    }

    .serlnum4 {
        float: left;
        float: left;
        width: 22%;
        text-align: center;
        border-left: 1px solid #f1f2f7;
        padding: 6px 0px;
    }

    .serlnum5 {
        float: left;
        float: left;
        width: 17%;
        text-align: center;
        border-left: 1px solid #f1f2f7;
        padding: 6px 0px;
    }

    .table_form {
        border: 1px solid #f1f2f7;
        margin-bottom: 00px;
        border-top: 0px solid #000;
    }

    .table_form div {

    }

    .table_form input {
        width: 80%;
        margin-top: 0px;
        margin-bottom: 0px;
        font-size: 14px;
        background: #fff;
        border: 1px solid #d8d8d8;
        border-radius: 3px;
        font-size: 13px;
        margin-top: 11px;
        margin-bottom: 10px;
        text-align: center;
    }


    .net_amnt_wrap {
        float: right;
        width: 50%;
        border: 1px solid #f1f2f7;
        margin-bottom: 50px;
        border-radius: 12px;
    }

    .net_amnt_wrap .net_amnt_a {
        margin-top: 15px;
        margin-bottom: 15px;
        padding-right: 20px;
    }

    .net_amnt_wrap .ref_labela {
        padding-left: 10px;
        font-size: 15px;
        margin-top: 9px;
    }

    .net_amnt_wrap .ref_numa {
        width: 50%;
        float: right;
    }

    .stamp_as {

    }

    .stamp_singt_text {
        float: right;
        font-size: 20px;
        margin-bottom: 60px;
    }

    .singt_text {
        float: left;
        font-size: 20px;
        margin-bottom: 60px;
    }

    .ref_numa.ref_numa_text {
        border-radius: 10px;
    }

    .ref_numa.ref_numa_text:focus {
        outline: none;
    }


    .btn.btn-info {
        float: right !important;
        margin-top: -10px !important;
        margin-bottom: 40px !important;
        padding: 9px 24px !important;
        font-size: 18px !important;
        box-shadow: 0px 0px 0px !important;
        text-transform: uppercase !important;
        background-color: #38b24b !important;
    }

    .btn.btn-info:hover {
        background: #289439 !important;
    }


</style>
<?php
$in_iref_no = $in_price = $in_vat = $in_commission = $in_describtion = '';
$in_total = $in_status = $reject_message = '';
$in_date = date('Y-m-d');
if (!empty($is_send)) {
    $in_iref_no = $is_send[0]['in_iref_no'];
    $in_describtion = $is_send[0]['in_describtion'];
    $in_date = $is_send[0]['in_date'];
    $in_status = $is_send[0]['invoice_status'];
    $reject_message = $is_send[0]['reject_message'];
    $in_price = $is_send[0]['in_price'];
    $in_vat = ($in_price * $tax_data[0]['vat']) / 100;
    $in_commission = ($in_price * $tax_data[0]['commission']) / 100;
    $in_total = $in_price + $in_vat + $in_commission;
}
if ($in_date == '0000-00-00') {
    $in_date = date('Y-m-d');
}
?>


<div class="main_invoc_a">
    <?Php if (!empty($quotation_data)) { ?>
        <form id="submit_invoice" method="post">
            <div class="invoic_title"> <?php echo lang('aPro_Forma_Invoice'); ?></div>
            <div class="ref_num_invoc">
                <div class="ref_labela"><?php echo lang('Ref_Number'); ?>:</div>
                <input type="text" class="ref_numa" placeholder="Enter Ref Number"
                       id="in_iref_no" name="in_iref_no"
                       value="<?php echo $in_iref_no; ?>">
                <div class="clear"></div>
            </div>

            <div class="ref_num_invoc ref_num_invoc_date">
                <div class="ref_labela"
                     style="    text-align: right;"> <?php echo lang('Date'); ?>:
                </div>
                <input type="text" class="ref_numa" placeholder="Enter Date"
                       id="in_date" name="in_date" value="<?Php echo $in_date; ?>"
                       disabled>
                <div class="clear"></div>
            </div>


            <div class="clear"></div>

            <div class="cusmr_inf_wrap">
                <div class="custnr_adrea_name">
                    <div class="ref_labela"> <?php echo lang('aCustomer_Name'); ?>:
                    </div>
                    <input type="text" class="ref_numa"
                           placeholder="Enter Customer Name" id="in_user_name"
                           name="in_user_name"
                           value="<?php echo $quotation_data[0]['user_name']; ?>">
                    <input type="hidden" name="uid"
                           value="<?php echo $quotation_data[0]['uid']; ?>">
                    <div class="clear"></div>
                </div>

                <div class="custnr_adrea_name">
                    <div class="ref_labela"> <?php echo lang('Address'); ?>:</div>
                    <textarea class="ref_numa ref_numa_text" placeholder="Enter Address"
                              rows="4" id="in_address"
                              name="in_address"><?php echo $quotation_data[0]['address']; ?></textarea>
                    <div class="clear"></div>
                </div>
                <?php if (!empty($in_status)) { ?>
                    <div class="custnr_adrea_name">
                        <div class="ref_labela"> <?php echo lang('aStatus'); ?>:</div>
                        <?php if ($in_status == 'Confirmed') { ?>
                            <h3><span
                                    class="label label-success"><?php echo lang('aYou_confirmed_quotation_request'); ?></span>
                            </h3>
                        <?php } else if ($in_status == 'Cancelled') { ?>
                            <h3><span class="label label-danger">Buyer cancelled quotation request </span>
                            </h3>
                        <?php } else if ($in_status == 'Rejected') { ?>
                            <h3><span class="label label-warning">You rejected quotation request</span>
                            </h3>
                        <?php } ?>
                        <div class="clear"></div>
                    </div>
                <?php } ?>

                <div class="clear"></div>
            </div>
            <div class="clear"></div>

            <div class="seril_num_wrp">
                <div class="hed_lina_as">
                    <div class="serlnum1"><?php echo lang('SN'); ?></div>
                    <div class="serlnum2"> <?php echo lang('quantity'); ?></div>
                    <div class="serlnum3"> <?php echo lang('Unit'); ?></div>
                    <div class="serlnum4"> <?php echo lang('Item_Description'); ?></div>
                    <div class="serlnum5"> <?php echo lang('PID'); ?></div>
                    <div class="serlnum5"><?php echo lang('Price'); ?><span
                            class="material-icons" aria-hidden="true"
                            data-toggle="tooltip" data-placement="top"
                            title="Quantity is 3 then price sholud be 300">warning</span>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="table_form">
                    <div class="serlnum1">
                        <input type="text" id="in_sn" name="in_sn"
                               value="<?php echo $quotation_data[0]['id']; ?>">
                    </div>
                    <div class="serlnum2">
                        <input type="text" id="in_qty" name="in_qty"
                               value="<?php echo $quotation_data[0]['qty']; ?>">
                    </div>
                    <div class="serlnum3">
                        <input type="text" id="" name=""
                               value="<?php echo $quotation_data[0]['unit_name']; ?>"
                               disabled>
                        <input type="hidden" name="in_unit" id="in_unit"
                               value="<?php echo $quotation_data[0]['unit']; ?>">
                    </div>
                    <div class="serlnum4">
                        <textarea rows="2" id="in_describtion"
                                  name="in_describtion"><?php echo $in_describtion; ?></textarea>
                    </div>
                    <div class="serlnum5">
                        <input type="text" id="in_sku" name="in_sku"
                               value="<?php echo $quotation_data[0]['pid']; ?>">
                    </div>
                    <div class="serlnum5">
                        <input type="text" id="in_price" name="in_price"
                               value="<?php echo $in_price; ?>">
                    </div>

                    <div class="clear"></div>
                </div>
            </div>

            <div class="clear"></div>

            <div class="net_amnt_wrap">
                <div class="net_amnt_a">
                    <div class="ref_labela"><?php echo lang('Net_Amount'); ?>:</div>
                    <input type="text" class="ref_numa" placeholder="Enter Net Amount"
                           id="in_net_total" name="in_net_total"
                           value="<?php echo $in_price; ?>">
                    <div class="clear"></div>
                </div>

                <!-- <div class="net_amnt_a">
			<div class="ref_labela"> //VAT (<?php //echo $tax_data[0]['vat']; ?>) % : </div>
			<input type="text" class="ref_numa" placeholder="Enter VAT" id="in_vat"  value="<?php //echo $in_vat; ?>" disabled>
			<div class="clear"></div>
		</div> -->

                <!-- <div class="net_amnt_a">
			<div class="ref_labela"> Fees/رسوم  (<?php //echo $tax_data[0]['commission']; ?>) %  : </div>
			<input type="text" class="ref_numa" placeholder="Enter Port 10 Fees" id="in_port_fees"  value="<?php //echo $in_commission; ?>" disabled>
			<div class="clear"></div>
		</div>

    <div class="net_amnt_a">
      <div class="ref_labela"> VAT/ضريبة القيمة المضافة </div>
      <input type="text" class="ref_numa" placeholder="VAT" id="in_port_fees" value="0" disabled="">
      <div class="clear"></div>
    </div> -->


                <!-- 	<div class="net_amnt_a">
			<div class="ref_labela"> Total Amount : </div>
			<input type="text" class="ref_numa" placeholder="Enter Total Amount" id="in_port_total_amount" name="in_port_total_amount" value="<?php //echo $in_total; ?>" disabled>
			<div class="clear"></div>
		</div -->

                <div class="clear"></div>
            </div>
            <div class="clear"></div>
            <div>
                <button class="btn btn-info"><?php echo lang('Send'); ?></button>
            </div>
        </form>
        <div class="clear"></div>

        <div class="stamp_as">


            <div class="clear"></div>
        </div>
    <?Php } else { ?>
        <h1>Invalid invoice id</h1>
    <?php } ?>


</div>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function () {
        $("#in_date").datepicker({dateFormat: 'yy-mm-dd'});

    });
</script>

<script type="text/javascript">
    $(document).on('submit', "#submit_invoice", function (e) {
        e.preventDefault();
        var in_iref_no = $("#in_iref_no").val();
        var in_date = $("#in_date").val();
        var in_user_name = $("#in_user_name").val();
        var in_address = $("#in_address").val();
        var in_sn = $("#in_sn").val();
        var in_qty = $("#in_qty").val();
        var in_unit = $("#in_unit").val();
        var in_describtion = $("#in_describtion").val();
        var in_sku = $("#in_sku").val();
        var in_price = $("#in_price").val();
        var in_net_total = $("#in_net_total").val();
        var in_vat = $("#in_vat").val();
        var in_port_fees = $("#in_port_fees").val();
        var in_port_total_amount = $("#in_port_total_amount").val();
        var error = 1;
        // alert(in_price);
        // return false;
        if (in_iref_no == '') {
            error = 0;
            swal("", "<?php echo lang('aPlease_enter_Ref_Number'); ?>", "warning");
            return false;
        }
        if (in_date == '') {
            error = 0;
            swal("", "<?php echo lang('aPlease_Select_Date'); ?>", "warning");
            return false;
        }
        if (in_user_name == '') {
            error = 0;
            swal("", "<?php echo lang('aPlease_Enter_Customer_Name'); ?>", "warning");
            return false;
        }
        if (in_address == '') {
            error = 0;
            swal("", "<?php echo lang('aPlease_Enter_Address'); ?> ", "warning");
            return false;
        }
        if (in_sn == '') {
            error = 0;
            swal("", "<?php echo lang('aPlease_Enter_SN'); ?> ", "warning");
            return false;
        }

        if (in_qty == '') {
            error = 0;
            swal("", "<?php echo lang('aPlease_Enter_Quantity'); ?>", "warning");
            return false;
        }

        // if(in_unit=='')
        // {
        //   error=0;
        //   swal("","Please Enter Unit ","warning");
        //   return false;
        // }

        if (in_describtion == '') {
            error = 0;
            swal("", "<?php echo lang('aPlease_Enter_Item_Description'); ?>", "warning");
            return false;
        }

        if (in_sku == '') {
            error = 0;
            swal("", "<?php echo lang('aPlease_Enter_SKU'); ?>", "warning");
            return false;
        }

        if (in_price == '' || in_price == 0.00) {
            error = 0;
            swal("", "<?php echo lang('aPlease_Enter_Price'); ?> ", "warning");
            return false;
        }

        if (in_net_total == '') {
            error = 0;
            swal("", "<?php echo lang('aPlease_Enter_Net_Amount'); ?>", "warning");
            return false;
        }

        if (in_vat == '') {
            error = 0;
            swal("", "<?php echo lang('aPlease_Enter_Net_Amount'); ?>", "warning");
            return false;
        }

        if (in_port_fees == '') {
            error = 0;
            swal("", "<?php echo lang('aPlease_Enter_Net_Amount'); ?>", "warning");
            return false;
        }
        if (error == 1) {
            // alert('success');
            // return false;
            $('#loading').show();
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url($language . '/admin/receive_quotation/create_invoice/') . $quotation_data[0]['id']; ?>",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    $('#loading').hide();
                    $response = $.trim(response);
                    var response = $.parseJSON(response);
                    if (response.status == true) {
                        swal("", response.message, 'success');
                    } else {
                        swal("", response.message, 'warning');
                    }
                }
            });
        }
    });


</script>

<script type="text/javascript">
    // this for only decimal
    setInputFilter(document.getElementById("in_price"), function (value) {
        return /^-?\d*[.,]?\d{0,2}$/.test(value);
    });
    // this for float point number
    // setInputFilter(document.getElementById("amount"), function(value) {
    //   return /^-?\d*[.,]?\d*$/.test(value); });

</script>

<script type="text/javascript">
    $(document).on("keyup", "#in_price", function () {
        // var serach=$(this).val();
        var in_price = parseFloat($("#in_price").val());
        // alert(in_price);
        // if(isNaN(in_price))
        // {
        //   swal("","Please enter price",'warning');
        //   return false;
        // }
        // var in_vat = $("#in_vat").val();
        // var in_port_fees = $("#in_port_fees").val();
        // var in_port_total_amount = $("#in_port_total_amount").val();
        var commission =<?php echo $tax_data[0]['commission']; ?>;
        var vat =<?php echo $tax_data[0]['vat']; ?>;
        var vat_calulate = (in_price * vat) / 100;
        var vat_commission = (in_price * commission) / 100;

        in_price = numberWithCommas(in_price);
        $("#in_net_total").val(in_price);
        // $("#in_vat").val(vat_calulate);
        // vat_commission=numberWithCommas(vat_commission);
        // $("#in_port_fees").val(vat_commission);
        // $("#in_port_total_amount").val(in_price+vat_calulate+vat_commission);
        // alert("fasdfsdf");
    });

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
</script>
