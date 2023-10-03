<link href='<?php echo base_url(); ?>assets/frontend/css/virtual.css' rel='stylesheet' media="screen">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.css'
    rel='stylesheet' media='screen'>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/jquery.dataTables.js'>
</script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.js'>
</script>
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>



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

.row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}

.col-1,
.col-2,
.col-3,
.col-4,
.col-5,
.col-6,
.col-7,
.col-8,
.col-9,
.col-10,
.col-11,
.col-12,
.col,
.col-auto,
.col-sm-1,
.col-sm-2,
.col-sm-3,
.col-sm-4,
.col-sm-5,
.col-sm-6,
.col-sm-7,
.col-sm-8,
.col-sm-9,
.col-sm-10,
.col-sm-11,
.col-sm-12,
.col-sm,
.col-sm-auto,
.col-md-1,
.col-md-2,
.col-md-3,
.col-md-4,
.col-md-5,
.col-md-6,
.col-md-7,
.col-md-8,
.col-md-9,
.col-md-10,
.col-md-11,
.col-md-12,
.col-md,
.col-md-auto,
.col-lg-1,
.col-lg-2,
.col-lg-3,
.col-lg-4,
.col-lg-5,
.col-lg-6,
.col-lg-7,
.col-lg-8,
.col-lg-9,
.col-lg-10,
.col-lg-11,
.col-lg-12,
.col-lg,
.col-lg-auto,
.col-xl-1,
.col-xl-2,
.col-xl-3,
.col-xl-4,
.col-xl-5,
.col-xl-6,
.col-xl-7,
.col-xl-8,
.col-xl-9,
.col-xl-10,
.col-xl-11,
.col-xl-12,
.col-xl,
.col-xl-auto {
    position: relative;
    width: 100%;
    min-height: 1px;
    padding-right: 15px;
    padding-left: 15px;
}

.pb-4,
.py-4 {
    padding-bottom: 1.5rem !important;
}

.pt-4,
.py-4 {
    padding-top: 1.5rem !important;
}

.justify-content-around {
    justify-content: space-around !important;
}

.justify-content-between {
    display: flex;
    justify-content: space-between;
}

.justify-content-center {
    justify-content: center !important;
}

.justify-content-end {
    justify-content: flex-end !important;
}

.d-flex {
    display: flex !important;
}

@media (min-width: 768px) {
    .col-md-4 {
        flex: 0 0 33.3333333333%;
        max-width: 33.3333333333%;
    }
}

label {
    display: inline-block;
    max-width: 100%;
    margin-bottom: 5px;
    font-weight: bold;
}

.data-text h6 {
    color: #887777;
    font-weight: 500;
}

.row {
    margin-right: 0px;
    margin-left: 0px;
}

.required {
    color: red;
    padding: 2px;
}

.form-control {
    border-radius: 20px !important;
}

.form-control {
    display: block;
    width: 100%;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.back_button {
    margin-top: 0px !important;
    margin-bottom: 0px !important;
}
@media only screen and (max-width: 1050px) {
   .row.middle_divv {
    width: 100% !important;
}
}
@media only screen and (max-width: 768px) {
.div1_vorder {
    width: 100%;
    margin: 0 !important;
}
.col-md-4,.col-sm-12,.col-md-12{
   padding-right: 0px !important;
   padding-left: 0px !important;
}
}
</style>

<div class="col-md-12 row justify-content-end">
    <a href="<?php echo  base_url($language.'/admin/vorders/vaccount'); ?>"
        class="back_button"><?php echo lang('Back'); ?></a>
</div>

<div class="row middle_divv" style="margin: 0 auto;display: flex;margin-bottom:3rem;justify-content: center;">
    <div class="div1_vorder">
        <button style="background-color:#6CC8C3" class="btn_vodere transt_active transt-btn"
            data-id="all"><?php echo lang('aRegistered_Account'); ?></button>
    </div>
    <div class="div1_vorder">
        <button class="btn_vodere cost-active cost-btn" data-id="new"><?php echo lang('aAnother_Account'); ?></button>
    </div>
</div>
<form id="ajaxForm">
<div class="main dashboard">
    <!-- registered-account -->
    <div class="sm-space-lr data-text">
    
  <div class="row my-4">
   <div class="col-md-12">
   <div class="row justify-content-around py-4">
            <div class="col-md-4 d-flex row justify-content-between">
                <div >
               <label for="product_name"><?php echo lang('aBank_Name'); ?></label>
               </div>
               <div >
               <h6><?php $bank_data = $this->db->get_where('bank_details', array('id' => $data[0]['bank_name']))->row_array(); ?><?= $bank_data['bank_name']?></h6>
               </div>
            </div>
            <div class="col-md-4 d-flex row justify-content-between">
                <div>
               <label for="product_name"><?php echo lang('IBAN'); ?></label>
               </div>
               <div>
               <h6><?= $data[0]['iban']?></h6>
               </div>
            </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row justify-content-around py-4">
                        <div class="col-md-4 d-flex row justify-content-between">
                            <div>
                                <label for="product_name"><?php echo lang('aIFSC_Code'); ?></label>
                            </div>
                            <div>
                                <h6>Al65633</h6>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex row justify-content-between">
                            <div>
                                <label for="product_name"><?php echo lang('aBranch_Name'); ?></label>
                            </div>
                            <div>
                                <h6>Riyadh</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row justify-content-around py-4">
                        <div class="col-md-4 d-flex row justify-content-between">
                            <div>
                                <label for="product_name"><?php echo lang('IBAN'); ?></label>
                            </div>
                            <div>
                                <h6>I6545</h6>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex row justify-content-between">
                            <div>
                                <label for="product_name"><?php echo lang('account_type'); ?></label>
                            </div>
                            <div>
                                <h6>Saving</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </div>
   </div>

</div> 
  <div class="row mb-4">
   <div class="col-md-12">
      <div class="demo-masked-input">
         <div class="row justify-content-around">
            <div class="col-md-4">
               <label><?php echo lang('aReason_Of_Withdrawal'); ?><span class="required">*</span></label>
               <input type="text" name="payment_note" id="payment_note" class="form-control space"
                        placeholder="<?php echo lang('aEnter_Reason_Of_Withdrawal'); ?>" required>
            </div>
            <div class="col-md-4">
               <label><?php echo lang('aEnter_Amount'); ?><span class="required">*</span></label>
               <input type="text" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" name="amount" id="amount" class="form-control space"
                        placeholder="<?php echo lang('aEnter_Amount'); ?>" required>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="row mb-4">
   <div class="col-md-12">
   <div class="row justify-content-center mb-2">
      <button type="submit" class="product-item-price btn btn-solid float-right"><?php echo lang('aPayout'); ?></button>
    </div>
    <!-- registered-account -->
</div>
</form>
<!-- customers-payout -->
<div class="test" style="display:none">
    <!-- Anoter-Account -->
    <div class="sm-space-lr">
        <form>
            <div class="row my-4">
                <div class="col-md-12">
                    <div class="demo-masked-input">
                        <div class="row justify-content-around">
                            <div class="col-md-4">
                                <label><?php echo lang('aBank_Name'); ?><span class="required">*</span></label>
                                <input type="text" class="form-control space"
                                    placeholder="<?php echo lang('aEnter_Bank_Name'); ?>">
                            </div>
                            <div class="col-md-4">
                                <label><?php echo lang('aAccount_Number'); ?><span class="required">*</span></label>
                                <input type="text"
                                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                    class="form-control space"
                                    placeholder="<?php echo lang('aEnter_Account_Number'); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="demo-masked-input">
                        <div class="row justify-content-around">
                            <div class="col-md-4">
                                <label><?php echo lang('aBranch_Name'); ?><span class="required">*</span></label>
                                <input type="text" class="form-control space"
                                    placeholder="<?php echo lang('aEnter_Branch_Name'); ?>">
                            </div>
                            <div class="col-md-4">
                                <label><?php echo lang('aIFSC_Code'); ?><span class="required">*</span></label>
                                <input type="text"
                                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                    class="form-control space" placeholder="<?php echo lang('aEnter_IFSC_Code'); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="demo-masked-input">
                        <div class="row justify-content-around">
                            <div class="col-md-4">
                                <label><?php echo lang('IBAN'); ?><span class="required">*</span></label>
                                <input type="text"
                                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                    class="form-control space" placeholder="<?php echo lang('aEnter_IBAN'); ?>">
                            </div>
                            <div class="col-md-4">
                                <label><?php echo lang('account_type'); ?><span class="required">*</span></label>
                                <input type="text" class="form-control space"
                                    placeholder="<?php echo lang('account_type'); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="demo-masked-input">
                        <div class="row justify-content-around">
                            <div class="col-md-4">
                                <label><?php echo lang('aReason_Of_Withdrawal'); ?><span
                                        class="required">*</span></label>
                                <input type="text" class="form-control space"
                                    placeholder="<?php echo lang('aEnter_Reason_Of_Withdrawal'); ?>">
                            </div>
                            <div class="col-md-4">
                                <label><?php echo lang('aEnter_Amount'); ?><span class="required">*</span></label>
                                <input type="text"
                                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                    class="form-control space" placeholder="<?php echo lang('aEnter_Amount'); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-12">

                    <div class="row col-12 justify-content-center mb-2">
                        <button type="submit"
                            class="product-item-price btn btn-solid"><?php echo lang('awithdraw'); ?></button>
                    </div>
                </diV>
        </form>




<div class="row col-12 justify-content-center mb-2">
      <button type="submit" class="product-item-price btn btn-solid"><?php echo lang('aPayout'); ?></button>
    </div>
    <!-- </div> -->
    <!-- Anoter-Account -->
</div>
<!-- customers-payout -->


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
<!-- @ap@  -->
<script>
    $(document).ready(function () {
        // Attach form submission event
        $('#ajaxForm').submit(function (event) {
            event.preventDefault(); // Prevent default form submission

            let form = document.getElementById('ajaxForm');

            // Serialize the form data
            var formData = $(this).serialize();

            // Make the AJAX POST call
            $.ajax({
                url: '<?php echo base_url('/admin/vorders/update_db_for_withdrawal'); ?>',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function (response) {
                  alert(response.message);
                  // console.log('response', response);
                  form.reset();
                },
                error: function (xhr, status, error) {
                  //   console.log(error);
                  alert("There is some issue, please try again later");
                }
            });
        });
    });
</script>