<h2 class="">Receive Quotation</h2>
<table class="table table-bordered table-striped table-hover dataTable js-exportable">
    <thead>
    <tr>
        <th>SN</th>
        <th>Request Id</th>
        <th>Quotation Received Date</th>
        <th>Customer Name</th>
        <th>Product Name</th>
        <th>Purchase Cycle</th>
        <th>Certification</th>
        <th>Quotation Detail</th>
    </tr>
    </thead>
    <tbody>
    <?Php if (!empty($quotation_data)) {
        foreach ($quotation_data as $qd_key => $qd_val) { ?>
            <tr>
                <td> <?php echo $qd_key + 1; ?></td>
                <td> <?php echo $qd_val['id']; ?></td>
                <td> <?php echo date('d-M-Y', strtotime($qd_val['created_date'])); ?></td>
                <td> <?php echo $qd_val['user_name']; ?></td>
                <td> <?php echo $qd_val['product_name']; ?> </td>
                <td> <?php echo $qd_val['purchase_cycle']; ?> </td>
                <td> <?php echo $qd_val['certification']; ?> </td>
                <td class="detail_icona">
                    <a target="_blank"
                       href="<?php echo base_url($language . '/admin/assign_quotation/quotation_detail/') . $qd_val['id']; ?>">
                        <i class="material-icons">info</i> </a>
                </td>
            </tr>
        <?php }
    } else { ?>
        <tr>
            <td colspan="7">Record not found.!!</td>
        </tr>
    <?php } ?>

    </tbody>
</table>
