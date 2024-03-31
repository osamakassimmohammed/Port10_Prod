<style type="text/css">
    .wrap_recv_admin {

    }

    .singl_label_as {
        float: left;
        width: 31.33333%;
        margin-bottom: 10px;
        margin-top: 10px;
        border: 1px solid #f1f1f1;
        margin-left: 1%;
        margin-right: 1%;
        padding: 10px 15px 10px 30px;
        border-radius: 100px;
        background: #f7f7f7;
    }

    .label_input_qut {
        float: left;
        width: 100%;
        font-size: 15px;
        margin-bottom: -2px;
        color: #868686;
    }

    .label_input_qut_ans {
        float: left;
        width: 100%;
        font-size: 18px;
        font-weight: 500;
        color: #23023b;
    }

    .clear {
        clear: both;
    }

    .inform_singl_label_as {
        width: 98%;
        border-radius: 15px;
    }

    .creat_invoic_btn {
        float: right;
        background: #23023b;
        margin-top: -60px;
        padding: 9px 61px;
        font-weight: 400;
        font-size: 16px;
        color: #fff;
        border-radius: 5px;
        cursor: pointer;
        z-index: 9;
        position: relative;
    }

    .reject_inv_btn {
        float: right;
        margin-right: 235px;
        background: #ff375e;
        margin-top: -60px;
        padding: 9px 17px;
        font-weight: 400;
        font-size: 16px;
        color: #fff;
        border-radius: 5px;
        cursor: pointer;
        z-index: 9;
        position: relative;
    }

    .creat_invoic_btn2 {
        float: right;
        background: #ae2525;;
        margin-top: -60px;
        padding: 9px 17px;
        font-weight: 500;
        font-size: 16px;
        color: #fff;
        border-radius: 5px;
        cursor: pointer;
        z-index: 9;
        position: relative;
    }

    .creat_invoic_btn:hover {
        background: #1d052e;
        text-decoration: none;
        color: #fff;
    }

    .reject_inv_btn:hover {
        background: #dd2247;
        text-decoration: none;
        color: #fff;
    }

</style>
<br><br><br>
<?Php if (!empty($quotation_data)) { ?>
    <div class="clear"></div>
    <?php if ($quotation_data[0]['quotation_status'] == 'Cancelled') { ?>
        <a href="javascript:void(0)"
           class="creat_invoic_btn2"> <?php echo lang('aRequest_Cancelled_by_user'); ?> </a>
    <?php } else {
        $disabled = base_url($language . '/admin/receive_quotation/create_invoice/') . $quotation_data[0]['id'];
        if ($quotation_data[0]['quotation_status'] == "Rejected") {
            $disabled = 'javascript:void(0)';
        } ?>
        <a style="color: white" href="<?php echo $disabled; ?>"
           class="creat_invoic_btn"> <?php echo lang('aCreate_Invoice'); ?> </a>
    <?php } ?>
    <div class="clear"></div>
<?php } ?>
<a href="javascript:void(0)"
   class="reject_inv_btn"> <?php echo lang('aRejected'); ?> </a>
<div class="wrap_recv_admin">

    <?php if (!empty($quotation_data)) { ?>
        <div class="singl_label_as">
            <div class="label_input_qut"> <?php echo lang('aCustomer_Name'); ?> </div>
            <div
                class="label_input_qut_ans"><?php echo $quotation_data[0]['user_name']; ?> </div>
            <div class="clear"></div>
        </div>

        <div class="singl_label_as">
            <div class="label_input_qut"> <?php echo lang('product_name'); ?> </div>
            <div
                class="label_input_qut_ans">  <?php echo $quotation_data[0]['product_name']; ?> </div>
            <div class="clear"></div>
        </div>

        <div class="singl_label_as">
            <div class="label_input_qut"> <?php echo lang('Product_Group'); ?> </div>
            <div
                class="label_input_qut_ans"><?php echo $quotation_data[0]['category_name']; ?> </div>
            <div class="clear"></div>
        </div>

        <div class="singl_label_as">
            <div
                class="label_input_qut"> <?php echo lang('aQuotation_Received_Date'); ?> </div>
            <div
                class="label_input_qut_ans"> <?php echo date('d-M-Y', strtotime($quotation_data[0]['created_date'])); ?> </div>
            <div class="clear"></div>
        </div>

        <div class="singl_label_as">
            <div class="label_input_qut"> <?php echo lang('aPurchase_Cycle'); ?> </div>
            <div
                class="label_input_qut_ans"> <?php echo $quotation_data[0]['purchase_cycle']; ?> </div>
            <div class="clear"></div>
        </div>

        <div class="singl_label_as">
            <div class="label_input_qut"> <?php echo lang('Customization'); ?> </div>
            <div
                class="label_input_qut_ans"> <?php echo $quotation_data[0]['customiz']; ?> </div>
            <div class="clear"></div>
        </div>

        <div class="singl_label_as">
            <div
                class="label_input_qut"> <?php echo lang('Deadline_for_Submission'); ?> </div>
            <div
                class="label_input_qut_ans"> <?php echo date('d-M-Y', strtotime($quotation_data[0]['deadline'])); ?> </div>
            <div class="clear"></div>
        </div>

        <div class="singl_label_as">
            <div class="label_input_qut"><?php echo lang('aProduct_No'); ?> </div>
            <div
                class="label_input_qut_ans"> <?php echo $quotation_data[0]['pid']; ?> </div>
            <div class="clear"></div>
        </div>

        <div class="singl_label_as">
            <div class="label_input_qut"> <?php echo lang('HS_Code'); ?> </div>
            <div
                class="label_input_qut_ans"> <?php echo $quotation_data[0]['hscode']; ?> </div>
            <div class="clear"></div>
        </div>

        <div class="singl_label_as">
            <div class="label_input_qut"> <?php echo lang('Unit'); ?> </div>
            <div
                class="label_input_qut_ans"> <?php echo $quotation_data[0]['unit_name']; ?> </div>
            <div class="clear"></div>
        </div>

        <div class="singl_label_as">
            <div class="label_input_qut"> <?php echo lang('quantity'); ?> </div>
            <div
                class="label_input_qut_ans"> <?php echo $quotation_data[0]['qty']; ?> </div>
            <div class="clear"></div>
        </div>

        <div class="singl_label_as">
            <div class="label_input_qut"> <?php echo lang('Destination'); ?> </div>
            <div
                class="label_input_qut_ans"> <?php echo $quotation_data[0]['address']; ?> </div>
            <div class="clear"></div>
        </div>

        <div class="singl_label_as">
            <div class="label_input_qut"> <?php echo lang('Delivery_Date'); ?> </div>
            <div
                class="label_input_qut_ans"> <?php echo $quotation_data[0]['delivery_date']; ?> </div>
            <div class="clear"></div>
        </div>

        <div class="singl_label_as">
            <div class="label_input_qut"> <?php echo lang('Incoterms'); ?> </div>
            <div
                class="label_input_qut_ans"> <?php echo $quotation_data[0]['incoterms']; ?> </div>
            <div class="clear"></div>
        </div>

        <div class="singl_label_as">
            <div class="label_input_qut"> <?php echo lang('Certification'); ?> </div>
            <div
                class="label_input_qut_ans"> <?php echo $quotation_data[0]['certification']; ?>  </div>
            <div class="clear"></div>
        </div>


        <div class="singl_label_as">
            <div class="label_input_qut"> <?php echo lang('Google_address'); ?> </div>
            <div
                class="label_input_qut_ans"> <?php echo $quotation_data[0]['google_address']; ?> </div>
            <div class="clear"></div>
        </div>

        <div class="singl_label_as">
            <div class="label_input_qut"> <?php echo lang('Lat'); ?> </div>
            <div
                class="label_input_qut_ans"> <?php echo $quotation_data[0]['lat']; ?> </div>
            <div class="clear"></div>
        </div>

        <div class="singl_label_as">
            <div class="label_input_qut"> <?php echo lang('Lng'); ?> </div>
            <div
                class="label_input_qut_ans"> <?php echo $quotation_data[0]['lng']; ?>  </div>
            <div class="clear"></div>
        </div>

        <div class="singl_label_as inform_singl_label_as">
            <div class="label_input_qut"> <?php echo lang('Information'); ?> </div>
            <div class="label_input_qut_ans">
                <?php echo $quotation_data[0]['information']; ?>
            </div>
            <div class="clear"></div>
        </div>
        <?Php if (!empty($quotation_data[0]['document'])) {
            $document = explode(',', $quotation_data[0]['document']);
            foreach ($document as $d_key => $d_val) {
                $file_ext = explode('.', $d_val);
                $file_ext = end($file_ext);
                if ($file_ext == 'pdf') { ?>
                    <a target="_blank"
                       href="<?Php echo base_url('assets/admin/inquiry_doc/') . $d_val; ?>">
                        <img
                            src="<?php echo base_url("assets/frontend/images/"); ?>pdf.png"
                            height="150px" width="150px">
                    </a>
                <?php } else if ($file_ext == 'docx') { ?>
                    <a target="_blank"
                       href="<?Php echo base_url('assets/admin/inquiry_doc/') . $d_val; ?>">
                        <img
                            src="<?php echo base_url("assets/frontend/images/"); ?>doc.png"
                            height="150px" width="150px">
                    </a>
                <?php } else { ?>
                    <img
                        src="<?Php echo base_url('assets/admin/inquiry_doc/') . $d_val; ?>"
                        height="150px" width="150px">
                <?php } ?>

            <?Php }
        } ?>

    <?php } else { ?>
        <h1><?php echo lang('aInvalid_quatation_id'); ?></h1>
    <?php } ?>
    <div class="clear"></div>
</div>


<div class="modal fade" id="myModal" role="dialog" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;
                </button>
                <h4 class="modal-title"><?php echo lang('aReject_Invoice'); ?></h4>
            </div>
            <div class="modal-body">
                <div class="">
                    <label><?php echo lang('aReject_Reason'); ?></label>
                    <textarea
                        id="reject_message"><?php echo $quotation_data[0]['reject_message']; ?></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger "
                        id="reject_btn"><?php echo lang('aSubmit'); ?></button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).on("click", ".reject_inv_btn", function () {
        $('#myModal').modal('show');
    });

    $(document).on("click", "#reject_btn", function () {
        var reject_message = $("#reject_message").val();
        reject_message = $.trim(reject_message);
        if (reject_message == '') {
            swal("", "<?php echo lang('aPlease_enter_reject_reason'); ?>", 'warning');
            return false;
        } else {
            $('#loading').show();
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url($language); ?>/admin/receive_quotation/reject_request",
                data: {
                    'req_id':<?php echo $quotation_data[0]['id'] ?>,
                    "reject_message": reject_message
                },
                success: function (response) {
                    $('#loading').hide();
                    $response = $.trim(response);
                    var response = $.parseJSON(response);
                    $('#myModal').modal('hide');
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
