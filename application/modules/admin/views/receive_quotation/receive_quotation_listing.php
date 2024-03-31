<style type="text/css">
    .req_btn {
        display: inline-block;
        padding: 6px 12px;
        /*border: 1px solid #23023b;*/
        background-color: #23023b;
        color: white;
        border-radius: 5px;
    }

    .info_label {
        /*margin-top: 6px;*/
        font-size: 13px;
        position: relative;
        /*top: -6px;*/
        margin-left: 5px;
    }

    .req_btn:hover {
        text-decoration: none;
        background-color: #23023b;
        color: white;
    }
</style>
<!-- <h2 class="">Receive Quotation</h2> -->
<table class="table table-bordered table-striped table-hover dataTable js-exportable">
    <thead>
    <tr>
        <th><?php echo lang('SN'); ?></th>
        <th><?php echo lang('aQuotation_Received_Date'); ?></th>
        <th><?php echo lang('Deadline_Submission_Date'); ?></th>
        <th><?php echo lang('aCustomer_Name'); ?></th>
        <th><?php echo lang('product_name'); ?> </th>
        <th><?php echo lang('aPurchase_Cycle'); ?></th>
        <th><?php echo lang('RFQ_Status'); ?></th>
        <th><?php echo lang('aQuotation_Detail'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?Php if (!empty($quotation_data)) {
        foreach ($quotation_data as $qd_key => $qd_val) { ?>
            <tr>
                <td> <?php echo $qd_key + 1; ?></td>
                <td> <?php echo date('d-M-Y', strtotime($qd_val['created_date'])); ?></td>
                <td> <?php echo date('d-M-Y', strtotime($qd_val['deadline'])); ?></td>
                <td> <?php echo $qd_val['user_name']; ?></td>
                <td> <?php echo $qd_val['product_name']; ?> </td>
                <td> <?php echo $qd_val['purchase_cycle']; ?> </td>
                <td> <?php echo $qd_val['quotation_status']; ?> </td>
                <td class="detail_icona">
                    <a class="req_btn"
                       href="<?php echo base_url($language . '/admin/receive_quotation/receive_quotation_detail/') . $qd_val['id']; ?>"><span
                            class="info_label"><?php echo lang('aInfo'); ?></span> </a>
                </td>
            </tr>
        <?php }
    } else { ?>
        <tr>
            <td colspan="6"><?php echo lang('No_record_found'); ?></td>
        </tr>
    <?php } ?>

    </tbody>
</table>
