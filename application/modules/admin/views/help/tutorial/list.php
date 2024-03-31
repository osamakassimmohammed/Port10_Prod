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
    <!-- <a style="" href="<?php //echo base_url('admin/users/csv_dwonload') ?>" class="btn bg-light-green waves-effect"><span>Download</span></a> -->
</div>
<div class="sraech">
    <label for="usr">Search:</label>
    <input type="text" class="" id="search_val" style="padding: 3px">
    <!-- <button class="btn btn-info" id="search_btn">Search</button> -->
</div>
<table class="table table-bordered table-striped table-hover dataTable js-exportable">
    <thead>
    <tr>
        <th>SN</th>
        <!-- <th>Image</th> -->
        <th>Video</th>
        <th>Heading</th>
        <th>Status</th>
        <th>Date of publish</th>
        <th>Creation date</th>
        <th>Action</th>
    </tr>
    </thead>

    <tbody id="table_body">
    <!-- <td><?php //echo date('M-d-Y' ,strtotime($row['created_date'])); ?></td> -->
    <!-- <td> -->
    <?php //if(!empty($row['image'])){ ?>
    <!-- <a target="_blank" href="<?php //echo base_url('assets/admin/tutorial/').$row['image']?>" class="image-thumbnail"><img class="image-thumbnail" src="<?php //echo base_url('assets/admin/tutorial/').$row['image']?>" height="50px"></a> -->
    <?php //} ?>
    <!-- </td> -->
    <?php

    //print_r($list);
    if (!empty($tutorial_data)) {
        foreach ($tutorial_data as $key => $row) { ?>

            <tr>
                <td><?php echo $key + 1; ?></td>

                <td><a target="_blank"
                       href="<?php echo base_url('assets/admin/banner/') . $row['video'] ?>">Video</a>
                </td>
                <td><?php echo $row['heading'] ?></td>
                <td><?php echo $row['status'] ?></td>
                <td><?php echo $row['date_of_publish'] ?></td>
                <td><?php echo $row['created_date'] ?></td>
                <td>
                    <a style="width: 100%; background-color: #4f0381 !important;"
                       href="help/tutorial_edit/<?php echo $row['id'] ?>"
                       class="btn bg-light-green btn-circle waves-effect waves-circle waves-float "
                       role="button"><i class="material-icons">edit</i><span
                            class="material_label"><?php echo lang('aEdit'); ?></span></a>

                    <a style="width: 100%; margin: 8px 0px !important; background-color: #44871b !important; "
                       href="help/tutorial_tedit/<?php echo $row['id'] ?>"
                       class="btn bg-light-green btn-circle waves-effect waves-circle waves-float "
                       role="button"> تعديل <i class="material-icons">translate</i></a>

                    <a style="width: 100%; background-color: #ff375e !important;"
                       href="javascript:void(0)"
                       class="btn bg-light-green btn-circle waves-effect waves-circle waves-float  detete_pro"
                       data-id="<?php echo $row['id']; ?>" role="button"><i
                            class="material-icons">delete</i><span
                            class="material_label"><?php echo lang('aDelete'); ?></span></a>
                </td>
            </tr>
        <?php }
    } else { ?>
        <tr class="text-center text-danger">
            <td colspan="7">No Record Found</td>
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
            "ordering": false,    // Ordering (Sorting on Each Column)will Be Disabled
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
            url: "<?php echo base_url("admin/help/tutorial"); ?>",
            data: {serach: serach, pagno: '0', ajax: 'serach'},
            dataType: 'json',
            success: function (response) {
                // alert(response);
                $('#loading').hide();
                var tabledata = response.result;
                var flag_row = response.row;
                if (tabledata == '') {
                    $('#table_body').html("<tr><td colspan='11'>No record found</td></tr>");
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
            url: "<?php echo base_url("admin/help/tutorial") ?>",
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

    // trHTML+='<td>';
    //       if(v.image!='')
    //       {
    //        trHTML+='<a target="_blank" href="<?php //echo base_url('assets/admin/tutorial/') ?>'+v.image+' " class="image-thumbnail"><img class="image-thumbnail" src="<?php //echo base_url('assets/admin/tutorial/') ?>'+v.image+' " height="50px"></a>';
    //       }
    //       trHTML+='</td>';
    function creatTable(tabledata, flag_row) {
        lag_row = parseInt(flag_row);
        flag_row = flag_row + 1;
        if (tabledata != '') {
            var trHTML = '';

            $.each(tabledata, function (k, v) {
                trHTML += '<tr><td>' + flag_row + '</td>';

                trHTML += '<td><a target="_blank" href="<?php echo base_url('assets/admin/banner/') ?>' + v.video + ' " class="image-thumbnail">Video</a></td>';
                trHTML += '<td>' + v.heading + '</td>';
                trHTML += '<td>' + v.status + '</td>';
                trHTML += '<td>' + v.date_of_publish + '</td>';
                trHTML += '<td>' + v.created_date + '</td>';
                trHTML += '<td><a style="width: 100%; background-color: #4f0381 !important;" href="<?php echo base_url($language);?>/admin/help/tutorial_edit/' + v.id + '" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float" role="button"><i class="material-icons">edit</i><span class="material_label"><?php echo lang('aEdit'); ?></span></a> <a style="width: 100%; margin: 8px 0px !important; background-color: #44871b !important; " href="<?php echo base_url($language);?>/admin/help/tutorial_tedit/' + v.id + '" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float" role="button">تعديل  <i class="material-icons">translate</i></a> <a style="width: 100%; background-color: #ff375e !important;" href="javascript:void(0)" href="javascript:void(0)" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float  detete_pro" data-id="' + v.id + '" role="button" ><i class="material-icons">delete</i><span class="material_label"><?php echo lang('aDelete'); ?></span></a></td>';
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
                    text: "Are you sure you want to delete this tutorial!!",
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
                            url: '<?php echo base_url('admin/help/detete_tutorial') ?>',
                            data: {pid: pid},
                            success: function (response) {
                                if (response) {
                                    swal("", "Tutorial Delete successfully", 'success');
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
            swal("", "Some thing want worng!!", "warning");
        }

    });
</script>
