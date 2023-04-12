<style>
   .activ_acnt_inf a {
      font-weight: 700 !important;
      color: #004670 !important;
   }

   .account_info {
      background-color: #f8fbfd;
   }

   body {
      background-color: #f8fbfd;
   }

   .file__drop {
      display: block;
      width: 150px;
      height: 150px;
      text-align: center;
      border: 1px solid #C4C4C4;
      background-color: #C4C4C4;
   }

   .cng_title {
      margin-top: 50px;
   }

   .field-icon {
      float: right;
      margin-left: -20px;
      margin-top: -50px;
      position: relative;
      z-index: 2;
   }
</style>
<?php
$logo_url = base_url('assets/frontend/images/camera-plus.jpg');
if (!empty($user_data) && !empty($user_data[0]['logo'])) {
   $logo_url = base_url('assets/admin/usersdata/') . $user_data[0]['logo'];
}
?>

<article class="container theme-container account_info">
   <div class="row">
      <!-- Posts Start -->
      <?php //include("my_account_menu.php"); 
      ?>
      <aside class="col-lg-8 col-md-12 col-sm-12 space-bottom-20 ">
         <div class="account-details-wrap ">
            <div class="title-2 sub-title-small"> <?php echo lang('EDIT_PROFILE'); ?>
               <!-- <button class="btn btn-solid" id="seller_account" type="button">CREATE SELLER ACCOUNT </button> </div> -->
               <div class="account-box  light-bg default-box-shadow">
                  <form action="" class="form-delivery" id="profile_update">
                     <div class="row top_pading_sec">
                        <div class="col-md-6 col-sm-6">
                           <div class="form-group">
                              <div class="label_new"> <?php echo lang('Entity_Name'); ?> </div>
                              <input type="text" class="form-control" placeholder="<?php echo lang('Entity_Name'); ?>" id="sestiblishment" name="entity_name" value="<?php echo $user_data[0]['entity_name']; ?>">
                           </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                           <div class="form-group">
                              <div class="label_new"> <?php echo lang('CR_Number'); ?> </div>
                              <input type="text" class="form-control" placeholder="<?php echo lang('CR_Number'); ?>" id="scr_number" name="username" value="<?php echo $user_data[0]['username']; ?>" onkeypress="return isNumberKey(event)">
                           </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                           <div class="form-group">
                              <div class="label_new"> <?php echo lang('Street_Name'); ?> </div>
                              <input type="text" class="form-control" placeholder="<?php echo lang('Street_Name'); ?>" id="sstreet_name" name="street_name" value="<?php echo $user_data[0]['street_name']; ?>">
                           </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                           <div class="form-group">
                              <div class="label_new"> <?php echo lang('Building_Num'); ?> </div>
                              <input type="text" class="form-control" placeholder="<?php echo lang('Building_Num'); ?>" id="sbuilding_no" name="building_no" value="<?php echo $user_data[0]['building_no']; ?>">
                           </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                           <div class="form-group">
                              <div class="label_new"> <?php echo lang('City'); ?> </div>
                              <select class="form-control " id="scity" name="city">
                                 <option value=""><?php echo lang('Select_City'); ?></option>
                                 <?php if (!empty($city_list)) {
                                    foreach ($city_list as $cl_key => $cl_val) {
                                       if ($cl_val['city_name'] == $user_data[0]['city']) {
                                          $bselected = 'selected';
                                       } else {
                                          $bselected = '';
                                       }
                                 ?>
                                       <option value="<?php echo $cl_val['city_name']; ?>" <?php echo $bselected; ?>><?php echo $cl_val['city_name']; ?></option>
                                 <?php }
                                 } ?>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                           <div class="form-group">
                              <div class="label_new"> <?php echo lang('State_Province_Region'); ?> </div>
                              <select class="form-control " id="sstate" name="state">
                                 <option value=""><?php echo lang('Select_State_Province_Region'); ?></option>
                                 <?php if (!empty($state_list)) {
                                    foreach ($state_list as $sl_key => $sl_val) {
                                       if ($sl_val['state_name'] == $user_data[0]['state']) {
                                          $bselected = 'selected';
                                       } else {
                                          $bselected = '';
                                       }
                                 ?>
                                       <option value="<?php echo $sl_val['state_name']; ?>" <?php echo $bselected; ?>><?php echo $sl_val['state_name']; ?></option>
                                 <?php }
                                 } ?>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                           <div class="form-group">
                              <div class="label_new"> <?php echo lang('Zip_Or_Postal_Code'); ?> </div>
                              <input type="text" class="form-control" placeholder="<?php echo lang('Enter_Postal_Code'); ?>" id="spostal_code" name="postal_code" value="<?php echo $user_data[0]['postal_code']; ?>" onkeypress="return isNumberKey(event)">
                           </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                           <div class="form-group">
                              <div class="label_new"> <?php echo lang('Country'); ?> </div>
                              <input type="text" class="form-control" placeholder="<?php echo lang('Country'); ?>" id="scountry" value="<?php echo $user_data[0]['country']; ?>" readonly>
                           </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                           <div class="form-group">
                              <div class="label_new"> <?php echo lang('Phone'); ?> </div>
                              <input type="text" class="form-control" placeholder="<?php echo lang('Phone_number'); ?>" id="sphone" name="phone" value="<?php echo $user_data[0]['phone']; ?>" onkeypress="return isNumberKey(event)">
                           </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                           <div class="form-group">
                              <div class="label_new"> <?php echo lang('Email'); ?> </div>
                              <input type="text" class="form-control" placeholder="<?php echo lang('Email'); ?>" id="semail" name="email" value="<?php echo $user_data[0]['email']; ?>">
                           </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                           <div class="form-group">
                              <div class="label_new"> <?php echo lang('VAT_Number'); ?> </div>
                              <input type="text" class="form-control" placeholder="<?php echo lang('VAT_Number'); ?>" id="svat_number" name="vat_number" value="<?php echo $user_data[0]['vat_number']; ?>" onkeypress="return isNumberKey(event)">
                           </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                           <div class="form-group">
                              <div class="label_new"> <?php echo lang('Preferred_Bank_Name'); ?> </div>
                              <select class="form-control " id="sbank_name" name="bank_name">
                                 <option value=""><?php echo lang('Select_Preferred_Bank_Name'); ?> </option>
                                 <?php if (!empty($bank_details)) {
                                    foreach ($bank_details as $bd_key => $bd_val) {
                                       if ($bd_val['id'] == $user_data[0]['bank_name']) {
                                          $bselected = 'selected';
                                       } else {
                                          $bselected = '';
                                       }
                                 ?>
                                       <option value="<?php echo $bd_val['id']; ?>" <?php echo $bselected; ?>><?php echo $bd_val['bank_name']; ?></option>
                                 <?php }
                                 } ?>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                           <div class="form-group">
                              <div class="label_new"> <?php echo lang('IBAN'); ?> </div>
                              <input type="text" class="form-control isSpecial" placeholder="<?php echo lang('IBAN'); ?>" id="siban" name="iban" value="<?php echo $user_data[0]['iban']; ?>">
                           </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                           <div class="form-group">
                              <div class="label_new"> <?php echo lang('User_Name'); ?> </div>
                              <input type="text" id="sfirst_name" name="first_name" class="form-control" placeholder="<?php echo lang('User_Name'); ?>" value="<?php echo $user_data[0]['first_name']; ?>">
                           </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                           <label class="pink-btn btn_main_updt">
                              <input class="btn btn-solid" type="submit" value="<?php echo lang('Update'); ?>">
                           </label>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
      </aside>
      <!-- Posts Ends -->

      <aside class="col-lg-4 col-md-12 col-sm-12 space-bottom-45">
         <div class="account-details-wrap">
            <div class="title-2 sub-title-small"> <?php echo lang('UPLOAD_LOGO'); ?> </div>
            <div class="account-box  light-bg default-box-shadow">
               <form action="" class="form-delivery" id="" method="post">
                  <div class="row top_pading_sec">

                     <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                           <input style="display: none" type="file" id="logo1" name="name">

                           <label for="logo1" class="file__drop" data-image-uploader1="">
                              <span class="text">&nbsp;</span>
                              <img id="set_logo" data-image="" src="<?php echo $logo_url; ?>" style="width: 100px;height: 100px;padding: 10px 0;margin-top: 25px;">
                           </label>
                        </div>
                     </div>

                  </div>
               </form>
            </div>
            <div class="title-2 sub-title-small cng_title"> <?php echo lang('Change_your_password'); ?> </div>
            <div class="account-box  light-bg default-box-shadow">
               <form action="<?php echo base_url($language . '/my_account/cng_pass') ?>" class="form-delivery" id="change_pass" method="post">
                  <div class="row top_pading_sec">
                     <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                           <div class="label_new"> <?php echo lang('Old_Password'); ?> </div>
                           <input class="form-control" type="password" placeholder="<?php echo lang('Old_Password'); ?>" id="old_password" name="old_password">
                           <span toggle="#old_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                     </div>
                     <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                           <div class="label_new"> <?php echo lang('New_Password'); ?> <i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Password Minimum six characters, at least one uppercase letter, one lowercase letter, one number and one special character"></i> </div>
                           <input class="form-control" type="password" placeholder="<?php echo lang('New_Password'); ?>" id="password" name="password">
                           <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                     </div>
                     <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                           <div class="label_new"> <?php echo lang('Confirm_Password'); ?> <i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Password Minimum six characters, at least one uppercase letter, one lowercase letter, one number and one special character"></i> </div>
                           <input class="form-control" type="password" placeholder="<?php echo lang('Confirm_Password'); ?>" id="confirm_password" name="confirm_password">
                           <span toggle="#confirm_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>

                        </div>
                     </div>
                     <div class="col-md-12 col-sm-12">
                        <label class="pink-btn btn_main_updt">
                           <input type="submit" value="<?php echo lang('CHANGE'); ?>">
                        </label>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </aside>
   </div>
</article>

<script type="text/javascript">
   $(".toggle-password").click(function() {

      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
      input.attr("type", "text");
      } else {
      input.attr("type", "password");
      }
   });
</script>

<script type="text/javascript">
   $(document).on("submit", "#profile_update", function(e) {
      e.preventDefault();
      var error = 1;
      var stepone = 1;
      var steptwo = 1;
      var stepthree = 1;
      var stype = $("#stype").val();
      var sestiblishment = $.trim($("#sestiblishment").val());
      var scr_number = $.trim($("#scr_number").val());

      var sstreet_name = $.trim($("#sstreet_name").val());
      var sbuilding_no = $.trim($("#sbuilding_no").val());
      var scity = $.trim($("#scity").val());
      var sstate = $.trim($("#sstate").val());
      var spostal_code = $.trim($("#spostal_code").val());
      var scountry = $.trim($("#scountry").val());

      var sphone = $.trim($("#sphone").val());
      var semail = $.trim($("#semail").val());
      var svat_number = $.trim($("#svat_number").val());
      var sbank_name = $.trim($("#sbank_name").val());
      var siban = $.trim($("#siban").val());
      var sfirst_name = $.trim($("#sfirst_name").val());



      if (sestiblishment == "") {
         error = 0;
         swal("", "<?php echo lang('Please_Enter_Entity_Name'); ?>", "warning");
         return false;
      }

      if (scr_number == "") {
         error = 0;
         swal("", "<?php echo lang('Please_Enter_CR_Number'); ?>", "warning");
         return false;
      }



      if (sstreet_name == "") {
         error = 0;
         swal("", "<?php echo lang('Please_enter_Street_Name'); ?>", "warning");
         return false;
      }

      if (sbuilding_no == "") {
         error = 0;
         swal("", "<?php echo lang('Please_Enter_Building_Num'); ?>", "warning");
         return false;
      }

      if (scity == "") {
         error = 0;
         swal("", "<?php echo lang('Please_Enter_City'); ?>", "warning");
         return false;
      }

      if (sstate == "") {
         error = 0;
         swal("", "<?php echo lang('Please_Enter_State'); ?>", "warning");
         return false;
      }

      // if(spostal_code=="")
      // {
      //     error=0;            
      //     swal("","Please Enter Zip Or Postal Code","warning");
      //     return false;
      // } 

      if (scountry == "") {
         error = 0;
         swal("", "<?php echo lang('Please_Enter_Country'); ?>", "warning");
         return false;
      }



      if (sphone == "") {
         error = 0;
         swal("", "<?php echo lang('Please_Enter_Phone'); ?>", "warning");
         return false;
      }

      if (semail == "") {
         error = 0;
         swal("", "<?php echo lang('Please_enter_email'); ?>", "warning");
         return false;
      }

      if (semail != '') {
         if (!isValidEmailAddress(semail)) {
            error = 0;
            swal("", "<?php echo lang('Please_Enter_Valid_Email_Id'); ?>", "warning");
            return false;
         }
      }

      if (svat_number == "") {
         error = 0;
         swal("", "<?php echo lang('Please_Enter_VAT_Number'); ?>", "warning");
         return false;
      }
      if (sbank_name == "") {
         error = 0;
         swal("", "<?php echo lang('Select_Preferred_Bank_Name'); ?>", "warning");
         return false;
      }

      if (siban == "") {
         error = 0;
         swal("", "<?php echo lang('Please_Enter_IBAN'); ?>", "warning");
         return false;
      }

      if (sfirst_name == "") {
         error = 0;
         swal("", "<?php echo lang('Please_Enter_User_Name'); ?>", "warning");
         return false;
      }

      if (error == 1) {
         $("#loading").show();
         $.ajax({
            type: 'POST',
            url: "<?php echo base_url($language . '/my_account/account_info') ?>",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
               $("#loading").hide();
               response = $.trim(response);
               if (response == "email") {
                  swal('', "<?php echo lang('Email_already_exist'); ?> ", 'warning');
               } else if (response == "phone") {
                  swal('', "<?php echo lang('Mobile_number_already_exist'); ?>", 'warning');
               } else if (response == "cr_number") {
                  swal('', "<?php echo lang('CR_number_already_exist'); ?>", 'warning');
               } else if (response == "success") {
                  // success for user /buyer    
                  swal('', "<?php echo lang('Profile_updated_successfully'); ?>", 'success');
                  // setTimeout(function(){ },2900);                            
               } else if (response == "success1") {
                  //this for suppler and both         
                  swal('<?php echo lang('Successfully_Register'); ?>', "<?php echo lang('Please_login'); ?>", 'success');
                  // setTimeout(function(){ },2900);
                  setTimeout(function() {
                     window.location = "<?php echo base_url('admin') ?>"
                  }, 3000);
               } else {
                  swal('', "<?php echo lang('Something'); ?>", 'warning');
               }
            }
         });
      }
   });
</script>

<script type="text/javascript">
   $(document).on("change", "#logo1", function() {
      var class_name = $(this).data("class");
      file = this.files[0];
      // console.log(file);
      // return false;
      // file = this.file;   

      maxSize = 2048;
      var imagefile = file.type;
      file_tp = imagefile.slice(-3);
      var imagesize = file.size;
      imagesize = Math.round((imagesize / 1024));
      var match = ["image/jpeg", "image/png", "image/jpg"];
      // ,"application/pdf","application/vnd.openxmlformats-officedocument.wordprocessingml.document"
      if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
         // || (imagefile==match[3]) || (imagefile==match[4])
         // swal("",'Please select a valid image file (JPEG/JPG/PNG).');
         alert("Please select a valid image file (JPEG/JPG/PNG)");
         // $(".image_check").val('');
         return false;
      } else if (imagesize > maxSize) {
         swal("", "File should be less than 2 mb", "warning");
         return false;
      } else {
         // eadURL(this,class_name);
         // file =jQuery("#file")[0];
         fd = new FormData();
         // console.log(this.file.length);
         // console.log(this.file);
         // return false;
         // individual_capt = "Quotation image";
         // fd.append("caption", individual_capt);  
         // fd.append('action', 'fiu_upload_file'); 
         // fd.append("path", 'admin/usersdata/');              
         fd.append("name", this.files[0]);
         $("#loading").show();
         jQuery.ajax({
            type: 'POST',
            url: '<?php echo base_url('my_account/upload_logo') ?>',
            data: fd,
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
               $("#loading").hide();
               response = $.trim(response);
               var response = $.parseJSON(response);
               if (response.status == true) {
                  jQuery('#set_logo').attr('src', '<?php echo base_url('assets/admin/usersdata/') ?>' + response.logo);
                  swal("", response.message, 'success');
               } else {
                  swal("", response.message, 'warning');
               }
            }
         });
      }
   });
</script>

<script type="text/javascript">
   $(document).on("submit", "#change_pass", function() {
      var password = $("#password").val();
      var confirm_password = $("#confirm_password").val();
      var old_password = $("#old_password").val();
      var error = 1;

      if (old_password == '') {
         error = 0;
         swal("", "<?php echo lang('Please_enter_old_password'); ?>", "warning");
         return false;
      }

      if (password == '') {
         error = 0;
         swal("", "<?php echo lang('Please_enter_new_password'); ?>", "warning");
         return false;
      }

      if (!isValidpassword(password)) {
         error = 0;
         swal("", "<?php echo lang('password_Minimum'); ?>", "warning");
         return false;
      }

      if (confirm_password == '') {
         error = 0;
         swal("", "<?php echo lang('Please_Enter_Confirm_Password'); ?>", "warning");
         return false;
      }

      if (!isValidpassword(confirm_password)) {
         error = 0;
         swal("", "Confirm Password Minimum six characters, at least one uppercase letter, one lowercase letter, one number and one special character", "warning");
         return false;
      }

      if (password != confirm_password) {
         error = 0;
         swal("", "<?php echo lang('Password_and_confirm_password_not_match'); ?>", "warning");
         return false;
      }

      if (error == 1) {} else {
         swal("", "<?php echo lang('Something'); ?>", "warning");
         return false
      }
   });
</script>
<script type="text/javascript">
   $(document).ready(function() {
      <?php if ($this->session->flashdata('success')) : ?>
         swal("", "<?php echo $this->session->flashdata('success'); ?>", "success");
      <?php endif; ?>

      <?php if ($this->session->flashdata('error')) : ?>
         swal("", "<?php echo $this->session->flashdata('error'); ?>", 'warning');
      <?php endif; ?>
   });
</script>

<script type="text/javascript">
   $(document).on("click", "#seller_account", function() {
      $('#loading').show();
      $.ajax({
         type: 'GET',
         url: "<?php echo base_url('ajax/switch_seller'); ?>",
         // data: {'email':sub_email},    
         success: function(response) {
            $('#loading').hide();
            response = $.trim(response);
            var response = $.parseJSON(response);
            if (response.status == true) {
               swal('', response.message, 'success');
               url = "<?php echo base_url($language . '/home'); ?>";
               setTimeout(function() {
                  window.location = url;
               }, 2000);
            } else {
               swal('', response.message, 'warning');
            }
         }
      });
   });
</script>