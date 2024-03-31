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

    .cgree {
        padding: 5px;
        background-color: #2b982b;
        color: white;
    }

    .cred {
        padding: 5px;
        background-color: #ff6262;
        color: white;
    }

    .img_brand {
        width: 40px;
        height: 40px
    }

    .pro_create {
        background: #4f0381;
        padding: 8px 30px;
        border-radius: 16px;
        border-radius: 100px;
        color: white;
    }

    .pro_create:hover {
        text-decoration: none;
        color: white;
    }

    .brand_edit {
        width: 30%;
        margin: 0px;
        margin-top: 0px !important;
        background-color: #4f0381 !important;
    }

    .brand_delete {
        width: 30%;
        margin-right: 2px;
        margin-top: 0px !important;
        background-color: #ff375e !important;
    }
</style>


<!-- <link href='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.css' rel='stylesheet' media='screen'> -->
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
    <!-- <a style="" href="<?php //echo base_url('admin/users/csv_dwonload') ?>" class="btn bg-light-green waves-effect"><span>Download</span></a> -->
</div>
<div class="sraech">
    <!-- <label for="usr">Search:</label>
    <input type="text" class="" id="search_val" style="padding: 3px"> -->
    <a class="pro_create"
       href="<?php echo base_url($language . '/admin/home_data/create_advertise') ?>">Create</a>
</div>
<table class="table table-bordered table-striped table-hover dataTable js-exportable">
    <thead>
    <tr>
        <th style="width: 10%;">SN</th>
        <th style="width: 10%;">Seller Name</th>
        <th>Seller Brand</th>
        <th>Seller Product</th>
        <th style="width: 10%;">Action</th>
    </tr>
    </thead>

    <tbody id="table_body">
    <!-- <td><?php //echo date('M-d-Y' ,strtotime($row['created_date'])); ?></td> -->
    <?php

    //print_r($list);
    if (!empty($advertise_data)) {
        foreach ($advertise_data as $key => $row) { ?>

            <tr>
                <td><?php echo $key + 1; ?></td>
                <td><?php echo $row['first_name'] ?></td>
                <td><?php echo $row['brand_name'] ?></td>
                <td><?php echo $row['product_name'] ?></td>
                <td>
                    <a style="width: 100%;"
                       href="home_data/edit_advertise/<?php echo $row['id'] ?>"
                       class="btn bg-light-green btn-circle waves-effect waves-circle waves-float brand_edit"
                       role="button"><i class="material-icons">edit</i><span
                            class="material_label">Edit</span></a>

                    <a href="javascript:void(0)"
                       class="btn bg-light-green btn-circle waves-effect waves-circle waves-float  detete_pro brand_delete"
                       data-id="<?php echo $row['id']; ?>" role="button"><i
                            class="material-icons">delete</i></a>

                </td>
            </tr>
        <?php }
    } else { ?>
        <tr class="text-center text-danger">
            <td colspan="7"><?php echo lang('No_record_found'); ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<div id="pagination"><?php echo @$pagination; ?></div>
<div id="pagination2" style="display:none"></div>
<div id="search_pagination" style="display:none"></div>
<style type="text/css">
    .img_sa {
        width: 100px;
        height: 100px;
    }
</style>
<script type="text/javascript">
    $(function () {
        $('.js-exportable').DataTable({
            "searching": false,   // Search Box will Be Disabled
            // "ordering": false,    // Ordering (Sorting on Each Column)will Be Disabled
            // "info": true,         // Will show "1 to n of n entries" Text at bottom
            // "lengthChange": false // Will Disabled Record number per page
            dom: 'Bfrtip',
            responsive: true,
            "paging": false,
            "info": false,
            // "order": [[ 0, "desc" ]]
        });
    });
</script>

<script type="text/javascript">
    $(document).on("keyup", "#search_val", function () {
        var serach = $(this).val();
        // alert(serach);
        // return false;
        $('#loading').show();
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url("admin/home_data/product_advertise"); ?>",
            data: {serach: serach, pagno: '0', ajax: 'serach'},
            dataType: 'json',
            success: function (response) {
                // alert(response);
                $('#loading').hide();
                var tabledata = response.result;
                var flag_row = response.row;
                if (tabledata == '') {
                    $('#table_body').html("<tr><td colspan='11'><?php echo lang('No_record_found'); ?></td></tr>");
                } else {
                    var trHTML = creatTable(tabledata, flag_row);
                    $('#table_body').html(trHTML);
                    if (serach == '') {
                        $("#search_pagination").hide();
                        $("#pagination").show();
                        $("#pagination2").hide();
                        $('#pagination').html(response.pagination);
                    } else {
                        $("#search_pagination").show();
                        $("#pagination").hide();
                        $("#pagination2").hide();
                        $('#search_pagination').html(response.pagination);
                    }
                }
            }
        });
    });

</script>
<script type="text/javascript">
    $('#pagination').on('click', 'a', function (e) {
        e.preventDefault();
        var ajax = "call";
        var pageno = $(this).attr('data-ci-pagination-page');
        if (typeof pageno !== 'undefined') {
            loadPagination(pageno, ajax);
        } else {
            swal("", "You are already on pageno 1", 'warning');
        }
    });

    $('#pagination2').on('click', 'a', function (e) {
        e.preventDefault();
        var ajax = "call";
        var pageno = $(this).attr('data-ci-pagination-page');
        if (typeof pageno !== 'undefined') {
            loadPagination(pageno, ajax);
        } else {
            swal("", "You are already on pageno 1", 'warning');
        }

    });
    $('#search_pagination').on('click', 'a', function (e) {
        e.preventDefault();
        var serach = $("#search_val").val();
        // alert("serach pat");
        var ajax = "serach";
        var pageno = $(this).attr('data-ci-pagination-page');
        if (typeof pageno !== 'undefined') {
            loadPagination(pageno, ajax, serach);
        } else {
            swal("", "You are already on pageno 1", 'warning');
        }

    });

    function loadPagination(pagno, ajax, serach = '') {
        // if(pagno==1)
        // {
        //   pagno=0;
        // }
        $('#loading').show();
        $.ajax({
            url: "<?php echo base_url("admin/home_data/product_advertise") ?>",
            type: 'post',
            data: {pagno: pagno, ajax: ajax, serach: serach},
            dataType: 'json',
            success: function (response) {
                $('#loading').hide();
                // alert(response);
                //var response = $.parseJSON(response);
                if (serach == '') {
                    $("#pagination").hide();
                    $("#pagination2").show();
                    $('#pagination2').html(response.pagination);
                } else {
                    $("#pagination").hide();
                    $("#pagination2").hide();
                    $("#search_pagination").show();
                    $('#search_pagination').html(response.pagination);
                }
                var tabledata = response.result;
                var flag_row = response.row;
                // alert(tabledata);
                var trHTML = creatTable(tabledata, flag_row);
                $('#table_body').html(trHTML);
            }
        });
    }
</script>
<script type="text/javascript">
    // trHTML+='<td><img class="img_sa" width="100px" height="100px" src="<?php //echo base_url('assets/admin/products/') ?>'+v.product_image+' "></td>';

    // trHTML+='<td><a href="<?php //echo base_url();?>admin/car_listing/detail/'+v.id+'" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float" role="button"><i class="material-icons">remove_red_eye</i></a></td>';
    function creatTable(tabledata, flag_row) {
        flag_row = parseInt(flag_row);
        flag_row = flag_row + 1;
        if (tabledata != '') {
            var trHTML = '';

            $.each(tabledata, function (k, v) {
                trHTML += '<tr><td>' + flag_row + '</td>';
                trHTML += '<td>' + v.first_name + '</td>';
                trHTML += '<td>' + v.brand_name + '</td>';
                trHTML += '<td>' + v.product_name + '</td>';
                trHTML += '<td>';
                trHTML += '<a href="<?php echo base_url();?>admin/home_data/edit_advertise/' + v.id + '" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float brand_edit" role="button"><i class="material-icons">edit</i><span class="material_label">Edit</span></a>';

                trHTML += '<a href="javascript:void(0)" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float  detete_pro brand_delete" data-id="' + v.id + '" role="button" ><i class="material-icons">delete</i></a>';

                trHTML += '</td>';
                trHTML += '</tr>';
                flag_row++;
            });
            return trHTML;
        }
    }
</script>
<script type="text/javascript">
    $(document).on('click', ".detete_pro", function () {
        var pid = $(this).data('id');
        if (pid != '') {
            swal({
                    title: "",
                    text: "Are you sure you want to delete this!!",
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
                            url: '<?php echo base_url('admin/home_data/detete_advertise') ?>',
                            data: {pid: pid},
                            success: function (response) {
                                if (response) {
                                    swal("", "Delete successfully", 'success');
                                    setTimeout(function () {
                                        location.reload();
                                    }, 2000);
                                } else {
                                    swal("", "Something want worng!!", "warning");
                                }
                            }
                        });
                    }
                });
        } else {
            swal("", "Something want worng!!", "warning");
        }

    });
</script>
