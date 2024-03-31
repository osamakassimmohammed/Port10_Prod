<style type="text/css">
    input.file {
        border: 1px solid #cdcdcd;
        padding: 7px;
        float: left;
        margin-right: 10px;
    }

    input.btn.btn-primary.csv_upload {
        padding: 7px;
        width: 100px;
        font-size: 16px;
        background-color: #e91e63 !important;
    }


    form#importFrm {

        width: 50%;
        float: left;
    }

    .aply_post_btn {
        font-size: 14px;
        background: #e91e63;
        border: 1px solid #095d98;
        color: #fff;
        outline: none;
        /*width: 50%;*/
        float: right;
        padding: 7px;
        transition-duration: 0.2s;
    }
</style>


<link
    href='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.css'
    rel='stylesheet' media='screen'>
<script
    src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/jquery.dataTables.js'></script>
<script
    src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.js'></script>
<!-- <script src='<?php //echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/dataTables.buttons.min.js'></script> -->
<!-- <script src='<?php //echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/buttons.flash.min.js'></script> -->
<!-- <script src='<?php //echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/jszip.min.js'></script> -->
<!-- <script src='<?php //echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/pdfmake.min.js'></script> -->
<!-- <script src='<?php //echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/buttons.html5.min.js'></script> -->
<!-- <script src='<?php //echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/buttons.print.min.js'></script> -->
<div class="form-group">
</div>
<table class="table table-bordered table-striped table-hover dataTable js-exportable">
    <thead>
    <tr>
        <th>Id</th>
        <!-- <th>Image</th> -->
        <th>Subject</th>
        <th>Message</th>
        <!-- <th>Action</th>   -->

    </tr>
    </thead>

    <tbody>
    <?php

    //print_r($list);
    if (!empty($data)) {
        foreach ($data as $row) { ?>

            <tr>
                <td><?php echo $row['id'] ?></td>
                <!-- <td><img height="70px" width="70px" src="<?php //echo base_url('assets/admin/solution/').$row['image']; ?>"> </td> -->
                <td><?php echo $row['subject'] ?></td>
                <td><?php echo $row['message'] ?></td>
                <!-- <td>
   <a href="<?php echo $edit_link . $row['id']; ?>" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float " role="button"><i class="material-icons">edit</i></a>

    <a href="javascript:void(0)" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float  detete_pro" data-id="<?php echo $row['id']; ?>" role="button" ><i class="material-icons">delete</i></a>
    <a href="<?php //echo base_url('admin/solution/solution_tedit/').$row['id']; ?>" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float " role="button"><i class="material-icons">translate</i></a>
</td> -->
                <!-- <td><?php //echo date("d-M-Y", strtotime($row['created_on']) );?></td> -->
            </tr>
        <?php }
    } else { ?>
        <tr class="text-center text-danger">
            <td colspan="5">No Record Found</td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<style type="text/css">
    .img_sa {
        width: 100px;
        height: 100px;
    }
</style>
<script type="text/javascript">
    $(function () {
        $('.js-exportable').DataTable({
            // "searching": false,   // Search Box will Be Disabled
            // "ordering": false,    // Ordering (Sorting on Each Column)will Be Disabled
            // "info": true,         // Will show "1 to n of n entries" Text at bottom
            // "lengthChange": false // Will Disabled Record number per page
            dom: 'Bfrtip',
            responsive: true,
            // "paging":   false,
            "info": false,
            "order": [[0, "desc"]],
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>

<script type="text/javascript">
    $(document).on('click', ".detete_pro", function () {
        var pid = $(this).data('id');
        if (pid != '') {
            swal({
                    title: "",
                    text: "Are you sure you want to delete this Email!!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "OK",
                    cancelButtonText: "CANCEL",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                function (inputValue) {
                    if (inputValue === true) {
                        $.ajax({
                            type: 'POST',
                            url: '<?php echo base_url('admin/email_send/detete_pro') ?>',
                            data: {pid: pid},
                            success: function (response) {
                                if (response) {
                                    swal("", "Email Delete successfully", 'success');
                                    setTimeout(function () {
                                        location.reload();
                                    }, 2000);
                                } else {
                                    swal("", "Some thing want worng!!", "warning");
                                }
                            }
                        });
                    }
                });
        } else {
            swal("", "Some thing want worng!!", "warning");
        }

    });
</script>
