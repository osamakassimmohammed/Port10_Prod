<?php if (@$this->session->flashdata('select_admin')): ?>
    <script>
        swal({
            title: "Warning",
            text: "Please select Partner to assign order",
            timer: 3000,
            showConfirmButton: true,
            type: 'error'
        });
    </script>
<?php endif; ?>

<?php if (@$this->session->flashdata('success')): ?>
    <script>
        swal({
            title: "Success",
            text: "Order assign to partner successfully",
            timer: 3000,
            showConfirmButton: true,
            type: 'success'
        });
    </script>
<?php endif; ?>
<style type="text/css">
    input#d_date {
        width: 100%;
        padding: 8px;
    }
</style>


<?php
$pro_pending = $pro_accept = $pro_none = '';
if (!empty($users_data)) {
    if ($users_data[0]['active'] == 1) {
        $active = 'checked';
        $deactive = '';
    } else {
        $deactive = 'checked';
        $active = '';
    }

    if ($users_data[0]['is_terminate'] == 1) {
        $terminate = 'checked';
        $not_terminate = '';
    } else {
        $terminate = '';
        $not_terminate = 'checked';
    }
} else {
    $deactive = '';
    $active = '';
    $terminate = '';
    $not_terminate = '';
}

?>
<div style="text-align: right;">
    <a class="service-image"
       href="<?php echo base_url($language . '/admin/users/order_history/') . @$users_data[0]['id']; ?>">
        <button type="submit" class="btn btn-success">Back to list</button>
    </a>
</div>

<div class="x_content row">
    <?php if (!empty(@$msg)) { ?>
        <div class="alert <?php echo @@$msg['response']; ?>">
            <p><?php echo @$msg['msg']; ?></p>
        </div>
    <?php } ?>
    <p class="text-muted font-13 m-b-30"></p>
    <div class="col-md-12">
        <div class="panel panel-default ">
            <div class="panel-footer">User Details</div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <tbody>
                    <?php if (!empty($users_data)) {
                        ?>
                        <tr>
                            <th>Full Name:</th>
                            <td><?php echo $users_data[0]['first_name'] . ' ' . $users_data[0]['last_name']; ?></td>

                            <th>Email:</th>
                            <td><?php echo $users_data[0]['email']; ?></td>
                        </tr>

                        <tr>
                            <th>CR Number:</th>
                            <td><?php echo $users_data[0]['username']; ?></td>

                            <th>Entity Name:</th>
                            <td><?php echo $users_data[0]['entity_name']; ?></td>

                        </tr>

                        <tr>
                            <th>Phone:</th>
                            <td><?php echo $users_data[0]['phone']; ?></td>

                            <th>Date:</th>
                            <td><?php echo $users_data[0]['created_on']; ?></td>
                        </tr>

                        <tr>
                            <th>Street Name:</th>
                            <td><?php echo $users_data[0]['street_name']; ?></td>

                            <th>Building Num / Suite Num / Office Num:</th>
                            <td><?php echo $users_data[0]['building_no']; ?></td>
                        </tr>

                        <tr>
                            <th>City:</th>
                            <td><?php echo $users_data[0]['city']; ?></td>

                            <th>State:</th>
                            <td><?php echo $users_data[0]['state']; ?></td>
                        </tr>


                        <tr>
                            <th>Postal Code:</th>
                            <td><?php echo $users_data[0]['postal_code']; ?></td>

                            <th>Country:</th>
                            <td><?php echo $users_data[0]['country']; ?></td>
                        </tr>

                        <tr>
                            <th>VAT Number:</th>
                            <td><?php echo $users_data[0]['vat_number']; ?></td>

                            <th>Preferred Bank Name:</th>
                            <td><?php echo $users_data[0]['bank_name']; ?></td>
                        </tr>

                        <tr>
                            <th>IBAN:</th>
                            <td><?php echo $users_data[0]['iban']; ?></td>

                            <th>Email Verify</th>
                            <td><?php if ($users_data[0]['is_email_verify'] == 1) { ?>
                                    <button id="is_email_verify"
                                            class="btn btn-success">Verified
                                    </button>
                                <?php } else { ?>
                                    <button id="is_email_verify" class="btn btn-danger">
                                        Pending
                                    </button>
                                <?php } ?>
                            </td>
                        </tr>

                        <tr>
                            <th>Login Type</th>
                            <td><?php echo @$users_data[0]['social']; ?></td>

                            <th>Registration Source</th>
                            <td><?php echo @$users_data[0]['source']; ?></td>
                        </tr>

                        <tr>
                            <th>User Type</th>
                            <td><?php if ($users_data[0]['type'] == 'suppler') {
                                    echo "supplier";
                                } else {
                                    echo $users_data[0]['type'];
                                } ?></td>

                            <th>Status</th>
                            <td><?php if ($users_data[0]['active'] == 1) { ?>
                                    <button id="activede" class="btn btn-success">
                                        Active
                                    </button>
                                <?php } else { ?>
                                    <button id="activede" class="btn btn-danger">
                                        Deactive
                                    </button>
                                <?php } ?>
                            </td>
                        </tr>


                        </tr>

                    <?php } else { ?>
                        <tr>
                            <td>Record Not Found..</td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php if (!empty($users_data)) { ?>
    <div class="x_content row">
        <p class="text-muted font-13 m-b-30"></p>
        <div class="col-md-6">
            <div class="panel panel-default ">
                <form action="" method="POST">
                    <div class="panel-footer">Update Info</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="groups">Status</label>
                            <div>
                                <input type="radio" name="active" value="1" id="Accept"
                                       class="with-gap radio-col-green" <?php echo $active ?> >
                                <label for="Accept">Active</label>
                                <input type="radio" name="active" value="0" id="Reject"
                                       class="with-gap radio-col-green" <?php echo $deactive ?>>
                                <label for="Reject">Deactive</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="groups">Terminate Status</label>
                            <div>
                                <input type="radio" name="is_terminate" value="1"
                                       id="terminate"
                                       class="with-gap radio-col-green" <?php echo $terminate ?> >
                                <label for="terminate">Terminate</label>
                                <input type="radio" name="is_terminate" value="0"
                                       id="not_terminate"
                                       class="with-gap radio-col-green" <?php echo $not_terminate ?>>
                                <label for="not_terminate">Not Terminate</label>
                            </div>
                        </div>

                        <!--  <div class="form-group">
                           <label for="groups">Comment</label>
                           <div>
                             <textarea name="comment" id="comment" rows="2" cols="30"></textarea>
                           </div>
                         </div> -->
                        <div class="form-group">
                            <div>
                                <button id="update_status" class="btn btn-info">Update
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>


<script type="text/javascript">
    //  jQuery('#d_date').bootstrapMaterialDatePicker({
    //   format: 'YYYY-MM-DD',
    //   clearButton: true,
    //   weekStart: 1,
    //   minDate : new Date(),
    //   time: false
    // });
</script>
<style type="text/css">
    .form-group {
        width: 100%;
        margin-bottom: 25px;
        clear: both;
    }

    textarea.textarea {
        width: 100%;
        height: 100px;
        border-radius: 10px;
    }

</style>

<script type="text/javascript">
    $(".alert-success").fadeOut(10000);

    $(document).on("submit", "form", function (e) {
        e.preventDefault();
        var status = $('input[name=active]:checked').val();
        $("#loading").show();
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url($language . '/admin/users/user_detail/') . $users_data[0]['id']; ?>",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                $("#loading").hide();
                response = $.trim(response);
                if (response == 1) {
                    if (status == 1) {
                        // $("#sactive").attr("","gmail");
                        $("#activede").removeClass('btn-danger');
                        $("#activede").addClass('btn-info');
                        $("#activede").text('Active');
                    } else {
                        $("#activede").removeClass('btn-info');
                        $("#activede").addClass('btn-danger');
                        $("#activede").text('Deactive');
                    }
                    swal("", "Record updated", "success");
                } else {
                    swal('', "Something went wrong", 'warning');
                }
            }
        });

    });
</script>
