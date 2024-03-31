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
        <th>Id</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Message</th>
        <th>Date</th>
    </tr>
    </thead>

    <tbody id="table_body">
    <?php

    //print_r($list);
    if (!empty($contact_request)) {
        foreach ($contact_request as $row) { ?>

            <tr>
                <td><?php echo $row['id'] ?></td>
                <td><?php echo $row['first_name'] ?></td>
                <td><?php echo $row['last_name'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td><?php echo $row['phone'] ?></td>
                <td><?php echo $row['message'] ?></td>
                <td><?php echo date('M-d-Y', strtotime($row['created_date'])); ?></td>
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
            // "ordering": false,    // Ordering (Sorting on Each Column)will Be Disabled
            // "info": true,         // Will show "1 to n of n entries" Text at bottom
            // "lengthChange": false // Will Disabled Record number per page
            dom: 'Bfrtip',
            responsive: true,
            "paging": false,
            "info": false,
            "order": [[0, "desc"]]
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
            url: "<?php echo base_url("admin/chat/contact_request"); ?>",
            data: {serach: serach, pagno: '0', ajax: 'serach'},
            dataType: 'json',
            success: function (response) {
                // alert(response);
                $('#loading').hide();
                var tabledata = response.result;
                if (tabledata == '') {
                    $('#table_body').html("<tr><td colspan='11'>No record found</td></tr>");
                } else {
                    var trHTML = creatTable(tabledata);
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
            url: "<?php echo base_url("admin/chat/contact_request") ?>",
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
                // alert(tabledata);
                var trHTML = creatTable(tabledata);
                $('#table_body').html(trHTML);
            }
        });
    }
</script>
<script type="text/javascript">
    // trHTML+='<td><img class="img_sa" width="100px" height="100px" src="<?php //echo base_url('assets/admin/products/') ?>'+v.product_image+' "></td>';

    // trHTML+='<td><a href="<?php //echo base_url();?>admin/car_listing/detail/'+v.id+'" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float" role="button"><i class="material-icons">remove_red_eye</i></a></td>';
    function creatTable(tabledata) {
        if (tabledata != '') {
            var trHTML = '';

            $.each(tabledata, function (k, v) {
                trHTML += '<tr><td>' + v.id + '</td>';
                trHTML += '<td>' + v.first_name + '</td>';
                trHTML += '<td>' + v.last_name + '</td>';
                trHTML += '<td>' + v.email + '</td>';
                trHTML += '<td>' + v.phone + '</td>';
                trHTML += '<td>' + v.message + '</td>';
                trHTML += '<td>' + v.created_date + '</td>';
                trHTML += '</tr>';
            });
            return trHTML;
        }
    }
</script>

<script type="text/javascript">
    $(document).on("click", ".check", function () {
        var id = $(this).data('id');
        var value = $(this).val();
        if ($(this).is(':checked')) {
            status = 'active';
            change_status(status, id);
            // $("#che"+id).removeAttr("checked");
            // $("#che"+id).attr("checked","checked");
            //activate
        } else {
            status = 'deactive';
            change_status(status, id);
            //deactivate
        }
    });

    function change_status(status, id) {
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url("admin/reviews/change_status") ?>",
            data: {status: status, id: id},
            success: function (response) {
                if (response == 1) {
                    if (status == 'active') {
                        $("#stest" + id).removeClass("cred");
                        $("#stest" + id).addClass("cgree");
                        $("#stest" + id).text("Active");
                    } else if (status == 'deactive') {
                        $("#stest" + id).removeClass("cgree");
                        $("#stest" + id).addClass("cred");
                        $("#stest" + id).text("Deactive");
                    }
                } else {
                    swal('', "Some thing want worng", 'warning');
                    setTimeout(function () {
                        location.reload();
                    }, 1500);
                }
            }
        });
    }
</script>
