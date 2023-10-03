<link href='<?php echo base_url(); ?>assets/frontend/css/virtual.css' rel='stylesheet' media="screen">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.css'
    rel='stylesheet' media='screen'>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/jquery.dataTables.js'>
</script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.js'>
</script>
<!-- <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script> -->
<!-- calender -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link href='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.css'
    rel='stylesheet' media='screen'>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/jquery.dataTables.js'>
</script>
<!-- calender -->
<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
<script type="text/javascript">
$(function() {
    $('input[name="daterange"]').daterangepicker();
});
</script>

<style type="text/css">
#loading {
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    position: fixed;
    display: block;
    opacity: 0.7;
    background-color: #fff;
    z-index: 99;
    text-align: center;
}

#loading-image {
    position: absolute;
    top: 250px;
    left: 630px;
    z-index: 100;
}

.btn:not(.btn-link):not(.btn-circle) {
    background: #4F0381 !important
}

.btn:not(.btn-link):not(.btn-circle).default {
    background: white !important
}

.div1_vorder {
    width: 30%;
    margin: 0 !important
}

.search-btn {
    margin-right: 2rem;
    background: #4F0381;
    color: white;
    border-radius: 3px
}

.daterangepicker {
    top: 27rem !important;
    left: 4rem !important;
}

.search-btn:hover {
    margin-right: 2rem;
    background: #4F0381;
    color: white;
    border-radius: 3px;
}

.brand_delete {
    color: white;
    background-color: #FF2650 !important;
}

.card .body .col-xs-9,
.card .body .col-sm-9,
.card .body .col-md-9,
.card .body .col-lg-9 {
    margin-bottom: 0px !important;
}
</style>

<div class="main dashboard">
    <!-- <div class="date-range">
  <span><?php echo lang('aSelect_Date_Range:'); ?></span>
<input  type="text" name="daterange" value="01/01/2023 - 01/31/2023" />
</div> -->
    <h2><?php echo lang('aRemitters'); ?></h2>


    <div class="center">
        <div class="row card_main">
            <!--cards-->
            <div class="col-md-4 col-sm-6">
                <a href="<?php echo base_url($language . '/admin/vorders/pending_order'); ?>">
                    <div class="card two">
                        <div class="card-content">
                            <p class="title">
                                <?php echo lang('aTotal_remitters'); ?>
                            </p>
                            <p style="color: #ae60e4;" class="count">
                                <?php echo count($data['last_month_transaction']) ?>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="<?php echo base_url($language . '/admin/vorders/completed_order'); ?>">
                    <div class="card one">
                        <div class="card-content">
                            <p class="title">
                                <?php echo lang('aActive_remitters'); ?>
                            </p>
                            <p style="color: #ff3f64;" class="count">
                            <?php echo count($data['active_transaction']) ?>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <!-- <div class="col-md-3 col-sm-6">
                        <a href="<?php echo base_url($language . '/admin/vorders/completed_order'); ?>">
                            <div class="card one">
                                <div class="card-content">
                                    <p class="title">
                                        <?php echo lang('aToday_Collected_Amount'); ?>
                                    </p>
                                    <p style="color: #24d0d9;" class="count">
                                      93
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div> -->

            <div class="col-md-4 col-sm-6">
                <a href="<?php echo base_url($language . '/admin/vorders/today_order'); ?>">
                    <div class="card three">
                        <div class="card-content">
                            <p class="title">
                                <?php echo lang('aInactive_remitters'); ?>
                            </p>
                            <p style="color: #444a51;" class="count">
                            <?php echo count($data['inactive_transaction']) ?>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <!--cards-->
    </div>

    <!-- transaction-table -->

    <div class="row">
        <div class="col-12 col-md-9">
            <form>
                <div class="row" style="margin-top:1rem">
                    <div class="date-range" style="float:left;margin-left:2rem;margin-bottom:2rem">
                        <span><?php echo lang('aSelect_Date_Range:'); ?></span>
                        <input type="text" name="start-date" id="start-date" placeholder="<?php echo lang('aStart_Date'); ?>" />
                        <input type="text" name="end-date" id="end-date" placeholder="<?php echo lang('aEnd_Date'); ?>" />
                        <button class="search-btn" id="get_datewise_data"><?php echo lang('asearch'); ?></button>
                    </div>

                </div>

            </form>
        </div>
        <div class="col-6 col-md-3 float-right" style="display: flex;justify-content: end;">
            <label style="padding:5px" for="usr"><?php echo lang('asearch'); ?>:</label>
            <input type="text" placeholder="<?php echo lang('aOrderId/customer_Info'); ?>" class="" id="search_val"
                style="padding: 3px">
        </div>
    </div>

    <div class="dashboard row" style="overflow-x:auto;margin:0rem">
        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
            <thead>
                <tr>
                    <th>
                        <?php echo lang('SN'); ?>
                    </th>
                    <th><?php echo lang('User_Name'); ?></th>
                    <th><?php echo lang('aRemitterId'); ?></th>
                    <th><?php echo lang('aBban'); ?> </th>
                    <th><?php echo lang('IBAN'); ?></th>
                    <!-- <th><?php echo lang('Brand'); ?></th> -->
                    <th><?php echo lang('aMax_Amount'); ?></th>
                    <th><?php echo lang('abalance'); ?></th>
                    <th><?php echo lang('aControlls'); ?></th>
                </tr>
            </thead>
            <?php $count=1;
                    foreach($data['last_month_transaction'] as $lmt){ ?>
            <tbody>
                <tr>
                    <td>
                       <?= $lmt->id?>
                    </td>
                    <td>
                    <?php $user = $this->db->get_where('admin_users',array('id'=>$lmt->user_id))->result(); echo $user[0]->first_name . $user[0]->last_name; ?>
                    </td>
                    <td>
                    <?= $lmt->remitter_id?> 
                    </td>
                    <td>
                    <?= $lmt->bban;?>
                    </td>
                    <td>
                    <?= $lmt->viban;?>  
                    </td>

                    <td>
                    <?= $lmt->max_amount;?>   
                    </td>
                    <td>
                    <?= $lmt->balance;?>   
                    </td>
                    <td>
                    <?php  if($lmt->is_active == 0 ){?>
                        <a style="width: 100%;"
                            class="btn bg-light-green btn-circle waves-effect waves-circle waves-float brand_edit"
                            role="button"><i class="material-icons">check</i><span class="material_label "
                                data-id="<?php echo $lmt->id; ?>"
                               
                                data-type="approve">
                                <?php echo lang('aActive_remitters'); ?>
                            </span></a>
                            <?php 
                            }
                          ?>
                            <?php  if($lmt->is_active == 1 ){?>
                        <a style="width: 100%;" href="javascript:void(0)"
                            class="btn bg-light-green btn-circle waves-effect waves-circle waves-float  detete_pro brand_delete"
                            role="button"> <i class="material-icons">close</i><span class="material_label"
                                data-id="<?php echo $lmt->id; ?>"
                               
                                data-type="decline">
                                <?php echo lang('aInactive_remitters'); ?>
                            </span></a>
                            <?php 
                            }
                          ?>
                    </td>
                </tr>
            </tbody>


            <?php } ?>
        </table>
        <!-- transaction-table -->
    </div>
</div>
<!-- customers-payout -->
<div class="test" style="display:none">
    <div class="row">
        <div class="date-range" style="float:left;margin-left:2rem;margin-bottom:2rem">
            <span><?php echo lang('aSelect_Date_Range:'); ?></span>
            <input type="text" name="start-date" id="start-date" placeholder="Start date" />
            <input type="text" name="end-date" id="end-date" placeholder="End date" />
            <button class="search-btn" id="get_datewise_data">Search</button>
        </div>

    </div>
    <!-- <div class="col-12 col-md-9">
  <form >
            <label class="bstart_date"><?php echo lang('aStart_Date'); ?>:</label>
            <input class="vs_date" type="" id="bstart_date" name="start_date" placeholder="<?php echo lang('aSelect_Start_Date'); ?>" type="text" value=""  autocomplete="off">
            <label class="bend_date"><?php echo lang('aEnd_Date'); ?>:</label>
            <input class="ve_date" type="" id="bend_date" name="end_date" placeholder="<?php echo lang('aSelect_End_Date'); ?>" type="text" value=""  autocomplete="off">
           
        </form>
      
  </div>
  <div class="col-6 col-md-3 float-right" style="display: flex;justify-content: end;">
  <label style="padding:5px" for="usr"><?php echo lang('asearch'); ?>:</label>
      <input type="text" placeholder="<?php echo lang('aOrderId/customer_Info'); ?>" class="" id="search_val" style="padding: 3px">
  </div> -->


    <div class="dashboard row" style="overflow-x:auto;margin:0rem">
        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
            <thead>
                <tr>
                    <th>
                        <?php echo lang('SN'); ?>
                    </th>
                    <th><?php echo lang('Date_range'); ?></th>
                    <th><?php echo lang('aCustomer_Name'); ?></th>
                    <!-- <th><?php echo lang('Supplier_Name'); ?> </th> -->
                    <th><?php echo lang('aAmount'); ?></th>
                </tr>
            </thead>
            <?php $count=1;
                    foreach($data['get_last_month_payout_details'] as $payment_details){ ?>
            <tbody id="search_daterange_table">
                <tr>
                    <td>
                        <?php echo $count++; ?>
                    </td>
                    <td>
                        <?php echo date('d/m/Y') .' - '.date('d/m/Y', strtotime('-30 days')) ?>
                    </td>
                    <td>
                        <?php 
                                          $sql ="SELECT first_name, last_name FROM admin_users where id = '$payment_details->recepient_id'";
                                          $query = $this->db->query($sql);
                                          $query = $query->result();
                                          print_r($query[0]->first_name . ' '. $query[0]->last_name);
                                        ?>
                    </td>
                    <!-- <td>
                                        abdullaha
                                    </td> -->
                    <td>
                        <?php echo $payment_details->total_ordered_amount ?>
                        <a style="padding:3px 7px" class="search-btn float_right"
                            href="<?php echo base_url($language . '/admin/vorders/payout/') ?><?= $payment_details->recepient_id?>"><?php echo lang('aPayout'); ?></a>
                    </td>
                </tr>
            </tbody>
            <?php } ?>
        </table>
        <!-- transaction-table -->
    </div>
</div>
<!-- customers-payout -->

<script>
document.getElementById('get_datewise_data').addEventListener('click', function() {
    var start_date = document.getElementById('start-date').value;
    var end_date = document.getElementById('end-date').value;
    // alert(start_date);
    $.ajax({
        url: 'vorders/get_data_by_date',
        method: 'POST',
        data: {
            start_date: start_date,
            end_date: end_date
        },
        dataType: 'json',
        success: function(response) {
            console.log(response);
            if (response.length > 0) {
                var search_daterange_table = document.getElementById('search_daterange_table');
                search_daterange_table.innerHTML = '';
                var k = 1;
                for (var i = 0; i < response.length; i++) {
                    var row = document.createElement('tr');

                    var sn = document.createElement('td');
                    sn.textContent = k;

                    var date_range = document.createElement('td');
                    date_range.textContent = start_date + ' - ' + end_date;



                    var nameCell = document.createElement('td');
                    nameCell.textContent = response[i].first_name;
                    var amountCell = document.createElement('td');
                    amountCell.textContent = '$' + response[i].total_ordered_amount;
                    row.appendChild(sn);
                    row.appendChild(date_range);

                    row.appendChild(nameCell);
                    row.appendChild(amountCell);
                    search_daterange_table.appendChild(row);
                    k++;
                }
            } else {
                console.log('error');
            }
        },
        error: function(error) {
            alert('error', error);
        }
    });
});
// $("#get_datewise_data").click(function(){

//   var start_date = $('start-date').val();
//   var end_date = $('end-date').val();
//   alert(start_date);
//   alert(end_date);
// });
</script>
<script type="text/javascript">
var start_date = null,
    end_date = null;
var timestamp_start_date = null,
    timestamp_end_date = null;
var $input_start_date = null,
    $input_end_date = null;

function getDateClass(date, start, end) {
    if (end != null && start != null) {
        if (date > start && date < end)
            return [true, "sejour", "Séjour"];
    }

    if (date == start)
        return [true, "start", "Début de votre séjour"];
    if (date == end)
        return [true, "end", "Fin de votre séjour"];

    return false;
}

function datepicker_draw_nb_nights() {
    var $datepicker = jQuery("#ui-datepicker-div");
    setTimeout(function() {
        if (start_date != null && end_date != null) {
            var $qty_days_stay = jQuery("<div />", {
                class: "ui-datepicker-stay-duration"
            });
            var qty_nights_stay = get_days_difference(timestamp_start_date, timestamp_end_date);
            $qty_days_stay.text(qty_nights_stay + " nights stay");
            $qty_days_stay.appendTo($datepicker);
        }
    });
}

var options_start_date = {
    showAnim: false,
    constrainInput: true,
    numberOfMonths: 2,
    showOtherMonths: true,
    beforeShow: function(input, datepicker) {
        datepicker_draw_nb_nights();
    },
    beforeShowDay: function(date) {
        // 0: published
        // 1: class
        // 2: tooltip
        var timestamp_date = date.getTime();
        var result = getDateClass(timestamp_date, timestamp_start_date, timestamp_end_date);
        if (result != false)
            return result;

        return [true, "", ""];
        // return [ true, "chocolate", "Chocolate! " ];
    },
    onSelect: function(date_string, datepicker) {
        // this => input
        start_date = $input_start_date.datepicker("getDate");
        timestamp_start_date = start_date.getTime();
    },
    onClose: function() {
        if (end_date != null) {
            if (timestamp_start_date >= timestamp_end_date || end_date == null) {
                $input_end_date.datepicker("setDate", null);
                end_date = null;
                timestamp_end_date = null;
                $input_end_date.datepicker("show");
                return;
            }
        }
        if (start_date != null && end_date == null)
            $input_end_date.datepicker("show");
    }
};
var options_end_date = {
    showAnim: false,
    constrainInput: true,
    numberOfMonths: 2,
    showOtherMonths: true,
    beforeShow: function(input, datepicker) {
        datepicker_draw_nb_nights();
    },
    beforeShowDay: function(date) {
        var timestamp_date = date.getTime();
        var result = getDateClass(timestamp_date, timestamp_start_date, timestamp_end_date);
        if (result != false)
            return result;

        return [true, "", "Chocolate !"];
    },
    onSelect: function(date_string, datepicker) {
        // this => input
        end_date = $input_end_date.datepicker("getDate");
        timestamp_end_date = end_date.getTime();
    },
    onClose: function() {
        if (end_date == null)
            return;

        if (timestamp_end_date <= timestamp_start_date || start_date == null) {
            $input_start_date.datepicker("setDate", null);
            start_date = null;
            timestamp_start_date = null;
            $input_start_date.datepicker("show");
        }
    }
};

$input_start_date = jQuery("#start-date");
$input_end_date = jQuery("#end-date");

$input_start_date.datepicker(options_start_date);
$input_end_date.datepicker(options_end_date);

function get_days_difference(start_date, end_date) {
    return Math.floor(end_date - start_date) / (1000 * 60 * 60 * 24);
}
</script>

<script type="text/javascript">
$(document).on("keyup", "#search_val", function() {
    var serach = $(this).val();
    $('#loading').show();
    $.ajax({
        type: 'POST',
        url: "<?php echo base_url("admin/vorders/today_order"); ?>",
        data: {
            serach: serach,
            pagno: '0',
            ajax: 'serach'
        },
        dataType: 'json',
        success: function(response) {
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
<script>
$(document).ready(function() {
    $(".transt-btn").click(function() {
        $(".main").show();
        $(".test").hide();
        $(".transt-btn").css({
            "background-color": "#6CC8C3"
        });
        $(".cost-btn").css({
            "background-color": "black"
        });
    });
});
</script>
<script>
$(document).ready(function() {
    $(".cost-btn").click(function() {
        $(".test").show();
        $(".main").hide();
        $(".transt-btn").css({
            "background-color": "black"
        });
        $(".cost-btn").css({
            "background-color": "#6CC8C3"
        });
    });
});
</script>

<script>
$(document).ready(function() {
    $(".material_label").on("click", function() {
        var dataId = $(this).attr("data-id");
        var dataUId = $(this).attr("data-uid");
        var dataAmount = $(this).attr("data-amount");
        var datasType = $(this).attr("data-type");
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url("/admin/vorders/update_approve_decline_remitters"); ?>",
            data: {
                dataId: dataId,
                dataUId: dataUId,
                dataAmount: dataAmount,
                datasType: datasType
            },
            dataType: 'json',
            success: function(response) {
                alert(response.message);
                location.reload(true);

            },
            error: function(xhr, status, error) {
                //   console.log(error);
                alert("There is some issue, please try again later");
            }
        });
    });
});
</script>