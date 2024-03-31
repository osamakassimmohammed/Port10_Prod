<div style="text-align: right;">
    <a class="service-image" href="<?php echo $back_link; ?>">
        <button type="submit" class="btn btn-success">Back to list</button>
    </a>
</div>

<br>

<?php echo $form->messages();
$code = $code_name = $start_date = $end_date = $status = $type = $amount = $id = '';
$percentage_selected = $fiexd_amount_selected = '';

if (isset($edit)) {
    $id = $edit['id'];
    // $description = $edit['description'];
    // $percentage = $edit['percentage'];
    $code = $edit['code'];
    $code_name = $edit['code_name'];
    $start_date = $edit['start_date'];
    $end_date = $edit['end_date'];
    $status = $edit['status'];
    $type = $edit['type'];
    $amount = $edit['amount'];
    $free_shipping = $edit['free_shipping'];

    if ($status == 1) {
        $active = 'checked';
        $deactive = '';
    } else {
        $active = '';
        $deactive = 'checked';
    }

    if ($free_shipping == 1) {
        $fre_ship_yes = 'checked';
        $fre_ship_no = '';
    } else {
        $fre_ship_yes = '';
        $fre_ship_no = 'checked';
    }

    if ($type == 1) {
        $percentage_selected = 'selected';
        $fiexd_amount_selected = '';
    } else {
        $percentage_selected = '';
        $fiexd_amount_selected = 'selected';
    }


} else {
    $active = 'checked';
    $deactive = '';

    $fre_ship_yes = '';
    $fre_ship_no = 'checked';
}
?>

<div class="row">

    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <!-- <h3 class="box-title">User Info</h3> -->
            </div>
            <div class="box-body">
                <?php //echo $form->open(); ?>
                <form id="create_form" action="<?php echo $form_url; ?>" method="post"
                      accept-charset="utf-8">

                    <div class="form-group">
                        <label for="groups">Code Name</label>
                        <div class="form-line">
                            <input autocomplete="off" id="code_name"
                                   class="form-control"
                                   value="<?php echo $code_name; ?>" name="code_name"
                                   type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="groups">Code</label>
                        <div class="form-line">
                            <input autocomplete="off" id="code" class="form-control"
                                   value="<?php echo $code; ?>" name="code" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="groups">Select type</label>
                        <div class="slct_drop_down">
                            <select id="select_type" name="type">
                                <option value="5">Select Type</option>
                                <option value="1" <?php echo $percentage_selected; ?>>
                                    Percentage
                                </option>
                                <option value="0" <?php echo $fiexd_amount_selected; ?>>
                                    Fixed Amount
                                </option>
                            </select>
                        </div>
                    </div>

                    <div id="limited_pay" class="colors">
                        <div class="form-group">
                            <label for="groups">Amount</label>
                            <div class="form-line">
                                <input autocomplete="off" id="amount"
                                       class="form-control"
                                       value="<?php echo $amount; ?>" name="amount"
                                       type="text">
                            </div>
                        </div>
                    </div>

                    <div id="limited" class="colors">
                        <div class="form-group">
                            <label for="groups">Start Date</label>
                            <div class="form-line">
                                <input autocomplete="off"
                                       class="startdatepicker form-control"
                                       value="<?php echo @$start_date; ?>"
                                       name="start_date" id="start_date" type="text">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="groups">End Date</label>
                            <div class="form-line">
                                <input autocomplete="off"
                                       class="enddatepicker form-control"
                                       value="<?php echo @$end_date; ?>" name="end_date"
                                       type="text" id="end_date">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="groups">Status</label>
                        <div>
                            <input type="radio" name="status"
                                   value="1" <?php echo $active; ?> id="active"
                                   class="with-gap radio-col-green" required="">
                            <label for="active">Active</label>
                            <input type="radio" name="status" value="0" id="deactive"
                                   class="with-gap radio-col-green"
                                   required="" <?php echo $deactive; ?>>
                            <label for="deactive">Deactive</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="groups">Free Shipping</label>
                        <div>
                            <input type="radio" name="free_shipping"
                                   value="1" <?php echo $fre_ship_yes; ?>
                                   id="fre_ship_yes" class="with-gap radio-col-green"
                                   required="">
                            <label for="fre_ship_yes">YES</label>
                            <input type="radio" name="free_shipping" value="0"
                                   id="fre_ship_no" class="with-gap radio-col-green"
                                   required="" <?php echo $fre_ship_no; ?>>
                            <label for="fre_ship_no">No</label>
                        </div>
                    </div>

                    <div class="col-sm-12 submit">
                        <?php echo $form->bs3_submit(); ?>
                        <?php echo $form->close(); ?>
                    </div>
            </div>
        </div>
    </div>

</div>


<script type="text/javascript">
    $('#colorselector').change(function () {


    });
</script>

<style type="text/css">
    .box.box-primary {
        width: 60%;
        margin: 0px auto;
        padding: 20px;
        border: 1px solid #cdcdcc;
    }

    .form-group .form-line:after {
        border-bottom: 1px solid #5f6fc8;
    }


    .header {
        display: none;
    }


    .submit button {
        padding: 10px;
        font-size: 15px;
        width: 14%;
        margin-top: 10px;
    }

    .slct_drop_down {
        margin-top: 10px;
    }
</style>

<script type="text/javascript">
    jQuery(document).ready(function ($) {
        jQuery('.startdatepicker').bootstrapMaterialDatePicker({
            format: 'YYYY-MM-DD',
            clearButton: true,
            weekStart: 1,
            minDate: new Date(),
            time: false
        });

        var date = new Date();
        var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());


        jQuery('.enddatepicker').bootstrapMaterialDatePicker({
            format: 'YYYY-MM-DD',
            clearButton: true,
            weekStart: 1,
            minDate: today,
            time: false
        });
    });
</script>


<script type="text/javascript">
    jQuery(document).on("submit", "#create_form", function (e) {
        e.preventDefault();
        var code_name = $("#code_name").val();
        var code = $("#code").val();
        var select_type = $("#select_type").val();

        var amount = $("#amount").val();
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();
        var status = $('input[name="status"]:checked').val();
        var error = 1;

        if (code_name == '') {
            swal("", "Please Enter Code Name", "warning");
            error = 0;
            return false;
        }

        if (code == '') {
            swal("", "Please Enter Code", "warning");
            error = 0;
            return false;
        }

        if (select_type == 5) {
            swal("", "Please Select Type", "warning");
            error = 0;
            return false;
        }

        if (amount == '') {
            swal("", "Please Enter Amount", "warning");
            error = 0;
            return false;
        }

        if (start_date == '') {
            swal("", "Please Enter Start Date", "warning");
            error = 0;
            return false;
        }

        if (end_date == '') {
            swal("", "Please Enter End Date", "warning");
            error = 0;
            return false;
        }

        if (error == 1) {
            $.ajax({
                type: 'POST',
                url: "<?php echo $form_url; ?>",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    var response = $.trim(response);
                    // response = response.trim();
                    // alert(response);
                    // return false;
                    if (response == 'add') {
                        swal("", "Coupon Added Successfully", "success");
                        $('#create_form')[0].reset();
                    } else if (response == 'update') {
                        swal("", "Coupon Edit Successfully", "success");
                    } else if (response == 'already') {
                        swal("", "Copoun already exist", "warning");
                    } else {
                        swal("", "Something Want Wrong", "warning");
                    }
                }
            });
        }


        // var fromdate = new Date($("#start_date").val()); //Year, Month, Date
        // var todate = new Date($("#end_date").val()); //Year, Month, Date

    });
</script>


<script type="text/javascript">
    // this for only decimal
    setInputFilter(document.getElementById("amount"), function (value) {
        return /^-?\d*[.,]?\d{0,2}$/.test(value);
    });
    // this for float point number
    // setInputFilter(document.getElementById("amount"), function(value) {
    //   return /^-?\d*[.,]?\d*$/.test(value); });

</script>
