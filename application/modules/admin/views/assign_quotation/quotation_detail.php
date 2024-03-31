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
        color: #054f6d;
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
        background: #044e6d;
        margin-top: -81px;
        padding: 9px 17px;
        font-weight: 500;
        font-size: 16px;
        color: #fff;
        border-radius: 5px;
        cursor: pointer;
        z-index: 9;
        position: relative;
    }

    .assign_btn {
        background: #ae2525;;
        padding: 9px 17px;
        font-weight: 500;
        font-size: 16px;
        color: #fff;
        border-radius: 5px;
        cursor: pointer;
    }

    .creat_invoic_btn:hover {
        background: #054157;
        text-decoration: none;
        color: #fff;
    }

    .reject_inv_btn:hover {
        background: #054157;
        text-decoration: none;
        color: #fff;
    }

</style>

<div class="wrap_recv_admin">

    <?php if (!empty($quotation_data)) { ?>
        <div class="singl_label_as">
            <div class="label_input_qut"> Customer Name</div>
            <div
                class="label_input_qut_ans"><?php echo $quotation_data[0]['user_name']; ?> </div>
            <div class="clear"></div>
        </div>

        <div class="singl_label_as">
            <div class="label_input_qut"> Product Name</div>
            <div
                class="label_input_qut_ans">  <?php echo $quotation_data[0]['product_name']; ?> </div>
            <div class="clear"></div>
        </div>

        <div class="singl_label_as">
            <div class="label_input_qut"> Product Group</div>
            <div
                class="label_input_qut_ans"><?php echo $quotation_data[0]['category_name']; ?> </div>
            <div class="clear"></div>
        </div>

        <div class="singl_label_as">
            <div class="label_input_qut"> Quotation Received Date</div>
            <div
                class="label_input_qut_ans"> <?php echo date('d-M-Y', strtotime($quotation_data[0]['created_date'])); ?> </div>
            <div class="clear"></div>
        </div>

        <div class="singl_label_as">
            <div class="label_input_qut"> Purchase Cycle</div>
            <div
                class="label_input_qut_ans"> <?php echo $quotation_data[0]['purchase_cycle']; ?> </div>
            <div class="clear"></div>
        </div>

        <div class="singl_label_as">
            <div class="label_input_qut"> Customization</div>
            <div
                class="label_input_qut_ans"> <?php echo $quotation_data[0]['customiz']; ?> </div>
            <div class="clear"></div>
        </div>

        <div class="singl_label_as">
            <div class="label_input_qut"> Deadline for Submission</div>
            <div
                class="label_input_qut_ans"> <?php echo date('d-M-Y', strtotime($quotation_data[0]['deadline'])); ?> </div>
            <div class="clear"></div>
        </div>

        <div class="singl_label_as">
            <div class="label_input_qut"> Product No.</div>
            <div
                class="label_input_qut_ans"> <?php echo $quotation_data[0]['pid']; ?> </div>
            <div class="clear"></div>
        </div>

        <div class="singl_label_as">
            <div class="label_input_qut"> HS Code</div>
            <div
                class="label_input_qut_ans"> <?php echo $quotation_data[0]['hscode']; ?> </div>
            <div class="clear"></div>
        </div>

        <div class="singl_label_as">
            <div class="label_input_qut"> Unit</div>
            <div
                class="label_input_qut_ans"> <?php echo $quotation_data[0]['unit_name']; ?> </div>
            <div class="clear"></div>
        </div>

        <div class="singl_label_as">
            <div class="label_input_qut"> Quantity</div>
            <div
                class="label_input_qut_ans"> <?php echo $quotation_data[0]['qty']; ?> </div>
            <div class="clear"></div>
        </div>

        <div class="singl_label_as">
            <div class="label_input_qut"> Destination</div>
            <div
                class="label_input_qut_ans"> <?php echo $quotation_data[0]['address']; ?> </div>
            <div class="clear"></div>
        </div>

        <div class="singl_label_as">
            <div class="label_input_qut"> Delivery Date</div>
            <div
                class="label_input_qut_ans"> <?php echo $quotation_data[0]['delivery_date']; ?> </div>
            <div class="clear"></div>
        </div>

        <div class="singl_label_as">
            <div class="label_input_qut"> Incoterms</div>
            <div
                class="label_input_qut_ans"> <?php echo $quotation_data[0]['incoterms']; ?> </div>
            <div class="clear"></div>
        </div>

        <div class="singl_label_as">
            <div class="label_input_qut"> Certification</div>
            <div
                class="label_input_qut_ans"> <?php echo $quotation_data[0]['certification']; ?>  </div>
            <div class="clear"></div>
        </div>

        <div class="singl_label_as inform_singl_label_as">
            <div class="label_input_qut"> Information</div>
            <div class="label_input_qut_ans">
                <?php echo $quotation_data[0]['information']; ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="singl_label_as">
            <div class="label_input_qut"> Assign Quotation To Vender</div>
            <div class="label_input_qut_ans">
                <select multiple name="assign_vender[]" id="assign_vender">
                    <option>Please Select Vender</option>
                    <?php if (!empty($seller_list)) {
                        foreach ($seller_list as $sl_key => $sl_val) {
                            $selected = '';
                            if (in_array($sl_val['id'], $is_invoice)) {
                                $selected = 'selected';
                            }
                            ?>
                            <option
                                value="<?php echo $sl_val['id']; ?>" <?php echo $selected; ?>><?php echo $sl_val['first_name']; ?></option>
                        <?php }
                    } ?>
                </select>
            </div>
            <div class="clear"></div>
        </div>

        <div class="singl_label_as">
            <div class="label_input_qut"></div>
            <div class="label_input_qut_ans">
                <button type="button" class='assign_btn' id="assign_btn">Assign</button>
            </div>
            <div class="clear"></div>
        </div>


    <?php } else { ?>
        <h1>Invalid quatation id</h1>
    <?php } ?>
    <div class="clear"></div>
</div>


<script type="text/javascript">

    $(document).on("click", "#assign_btn", function () {
        var assign_vender = $("#assign_vender").val();

        if (assign_vender == null) {
            swal("", "Please select vender", 'warning');
            return false;
        } else {
            $('#loading').show();
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url($language); ?>/admin/assign_quotation/assign_vender",
                data: {
                    'assign_vender': assign_vender,
                    'req_id': "<?php echo $quotation_data[0]['id']; ?>"
                },
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
