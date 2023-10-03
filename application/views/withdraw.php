<link href='<?php echo base_url(); ?>assets/frontend/css/virtual.css' rel='stylesheet' media="screen">
<link href='<?php echo base_url(); ?>assets/frontend/css/color1.css' rel='stylesheet' media="screen">
<style>
  .nav-btn-va a {
    color: white;
    text-decoration: none;
    background-color: black;
    -webkit-text-decoration-skip: objects;
    border-radius:20px !important
}
.nav-btn-va .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
    color: #fff;
    background-color: #6CC8C3;
    border-radius:20px
}
.chosen-container-single .chosen-single {

border-radius: 100px;
background: #fff;
box-shadow: 0px 0px 0px;
border: 1px solid #cdcdcd;
}

.required {
color: red;
padding: 2px
}
.form-control {
    border-radius: 20px !important;
}
label {
    display: inline-block;
    max-width: 100%;
    margin-bottom: 5px;
    font-weight: bold;
}
body.ar label{
  text-align:right;
  float:right
}
body.ar .arabic {
    text-align: right;
}
.row {
    margin-right: 0px;
    margin-left: 0px;
}
.back_button {
    /* float: right; */
    font-weight: 500;
    font-size: 15px !important;
    padding: 9px 20px;
    margin-top: 20px;
    border-radius: 3px !important;
    margin-bottom: 30px;
    border: 1px solid #14a988 !important;
    color: black;
    background-color: white !important;
    transition-duration: 0.2s;
}
.back_button:hover{
   color:black !important
}
.back_button .back_button{
   float: left;
}
</style>
   <div class="col-md-12 row justify-content-end">
         <a href="<?php echo  base_url($language.'/my_account/transaction'); ?>" class="back_button"><?php echo lang('Back'); ?></a>
   </div>
<div class="row justify-content-center nav-btn-va arabic">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item mx-2">
    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><?php echo lang('aRegistered_Account'); ?></a>
  </li>
  <li class="nav-item mx-2">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><?php echo lang('aAnother_Account'); ?></a>
  </li>
</ul>
</div>

<div class="tab-content" id="pills-tabContent">
    <!-- registered-account -->
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
    <div class="sm-space-lr data-text">
    <form id="ajaxForm">
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
            <!-- <div class="col-md-4 d-flex row justify-content-between">
            <div>
               <label for="product_name"><?php echo lang('aAccount_Number'); ?></label>
               </div>
               <div >
               <h6>432345467656564</h6>
               </div>
            </div> -->
         </div>
   </div>
   <div class="col-md-12">
   <div class="row justify-content-around py-4">
            <div class="col-md-4 d-flex row justify-content-between">
                <div>
               <label for="product_name"><?php echo lang('aIFSC_Code'); ?></label>
               </div>
               <div >
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
               <h6><?= $data[0]['iban']?></h6>
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
      <button type="submit" class="product-item-price btn btn-solid float-right"><?php echo lang('awithdraw'); ?></button>
    </div>
  </div>
</diV>
</form>
</div>
  </div>
  <!-- registered-account -->
  <!-- Anoter-Account -->
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
  <!-- <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"> -->
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
               <input type="text" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"  class="form-control space"
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
               <input type="text" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"  class="form-control space"
                        placeholder="<?php echo lang('aEnter_IFSC_Code'); ?>">
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
               <input type="text" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"  class="form-control space"
                        placeholder="<?php echo lang('aEnter_IBAN'); ?>">
            </div>
            <div class="col-md-4">
               <label><?php echo lang('account_type'); ?><span class="required">*</span></label>
               <input type="text"  class="form-control space"
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
               <label><?php echo lang('aReason_Of_Withdrawal'); ?><span class="required">*</span></label>
               <input type="text" class="form-control space"
                        placeholder="<?php echo lang('aEnter_Reason_Of_Withdrawal'); ?>">
            </div>
            <div class="col-md-4">
               <label><?php echo lang('aEnter_Amount'); ?><span class="required">*</span></label>
               <input type="text" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"  class="form-control space"
                        placeholder="<?php echo lang('aEnter_Amount'); ?>">
            </div>
         </div>
      </div>
   </div>
</div>
<div class="row mb-4">
   <div class="col-md-12">
   <!-- <div class="row justify-content-center my-4">
       <button class="mx-2 send-otp-btn"><?php echo lang('aSend_OTP'); ?></button>
       <button class="mx-2 resend-otp-btn"><?php echo lang('aResend_OTP'); ?></button>
    </div> -->
    <!-- <hr class="dashed-line my-5"> 
    <div class="row mb-4">
   <div class="col-md-12">
   <div class="row justify-content-center">
      <h2>ENTER OTP</h2>
    </div>
    <div class="row justify-content-center my-4">
    <div class="otp-form-wrapper">
	<form>
		<div class="code-inputs">
			<input type="number" maxlength="1" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control">
			<input type="number" maxlength="1" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control">
			<input type="number" maxlength="1" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control">
			<input type="number" maxlength="1" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control">
		</div>
    </form>
     </div>
    </div>
   </div>
</div> -->
<div class="row col-12 justify-content-center mb-2">
      <button type="submit" class="product-item-price btn btn-solid"><?php echo lang('awithdraw'); ?></button>
    </div>
</diV>
</form>




  </div>
  </div>
  <!-- </div> -->
    <!-- Anoter-Account -->
</div>
<script type="text/javascript">
    function auto_tab_input() {
	$(".code-inputs .form-control").keyup(function () {
		if (this.value.length == this.maxLength) {
			$(this).nextAll(".code-inputs .form-control:enabled:first").focus();
		}
	});
}
function auto_backspace() {
	$(".code-inputs .form-control").keyup(function (e) {
		if (e.keyCode == 8) {
			if ($(this).prev().length > 0) {
				$(this).prev("input").focus();
			}
		}
	});
}

$(document).ready(function () {
	auto_tab_input();
	auto_backspace();
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
                url: '<?php echo base_url('my_account/update_db_for_withdrawal'); ?>',
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


