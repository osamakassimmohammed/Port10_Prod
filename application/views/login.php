<style type="text/css">
    .home_active {
        font-weight: 600 !important;
        color: #c09550 !important;
    }

    .serch_2 {
        display: none;
    }

    .onhover-div.mobile-cart {
        display: none;
    }

    .contnr_main_headr.hedr_fixed {
        position: static;
        box-shadow: 0px 0px 0px #fff;
    }

    .first_fld_top .acount_typ_as {
        border-color: #adadad;
        border-radius: 100px;
        font-size: 14px;
        padding: 10px 16px;
        margin-bottom: 30px;
        height: inherit;
        font-weight: 500;
    }

    .strict {
        color: red;
    }

    .log_pg_title {
        color: #FC5670;
    }

    .login_ck_spn {
        margin-left: 10px;
    }

    .sign_in {
        margin-left: 105px;
        width: 200px;
    }

    .forgt_pass {
        margin-left: 140px;
        margin-top: 35px;
        color: #6BC9FF;
    }

    .form-control {
        background-color: #e4e4e4 !important;
    }

    .login-page.section-b-space {
        margin-top: 120px;
    }

    .field-icon {
        float: right;
        margin-left: 320px;
        margin-top: -55px;
        position: relative;
        z-index: 2;
    }
</style>


<div class="clear"></div>

<!--section start-->
<section class="login-page section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 sing_in_tn_wrp">

                <div class="cover_panl_login cove_panel_hide wow slideInRight" data-wow-duration="0.8s" data-wow-delay="0s" style="visibility: visible; animation-duration: 0.8s; animation-delay: 0s;">
                    <div class="crt_acnt_a welcm_back_title">
                        <?php echo lang('Welcome_Back'); ?>
                    </div>

                    <div class="crt_acnt_lorm">
                        <?php echo lang('Log_in_&_get_access_to_your_account'); ?>
                    </div>

                    <div class="signin_covr_btn"> <?php echo lang('Sign_In'); ?> </div>

                </div>

                <div class="wow signin_formmn" data-wow-duration="0.7s" data-wow-delay="0.0s" style="visibility: visible; animation-duration: 0.7s; animation-delay: 0.0s;">
                    <h3 class="log_pg_title"> <?php echo lang('Sign_In'); ?></h3>
                    <div class="theme-card">
                        <form class="theme-form" method="POST" id="login_form">
                            <div class="form-group first_fld_top">
                                <label for="lcr_number"><?php echo lang('Enter_CR'); ?></label>
                                <input type="text" class="form-control" id="lcr_number" placeholder="<?php echo lang('Enter_CR'); ?>" name="cr_number" value="<?php echo $remember_arr['remember_user_name']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="lpass"><?php echo lang('Enter_Your_Password'); ?></label>
                                <input type="password" class="form-control" id="lpass" placeholder="<?php echo lang('Enter_Your_Password'); ?>" name="pass" value="<?php echo $remember_arr['remember_password']; ?>">
                                <label class="">
                                    <span toggle="#lpass" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                    <input type="checkbox" name="remember_me" <?php echo $remember_c; ?>>
                                    <span class="login_ck_spn"><?php echo lang('Keep_Me_Signed_In'); ?></span> </label>
                            </div>
                            <button class="btn btn-solid sign_in"> <?php echo lang('Sign_In'); ?></button><br />

                            <a id="forget_pss_link" href="javascript:void(0)" class="forgt_pass"> <?php echo lang('Forgot_Password'); ?>? </a>
                            <div class="clear"></div>
                        </form>
                    </div>

                </div>

                <div class="forget_form" style="display: none;">
                    <h3><?php echo lang('FORGOT_YOUR_PASSWORD'); ?></h3>
                    <div class="theme-card">
                        <form class="theme-form" method="POST" id="forget_form">
                            <div class="form-group first_fld_top">
                                <label for="lcr_number"><?php echo lang('Email_Id'); ?></label>
                                <input type="text" class="form-control" id="forget_email" placeholder="<?php echo lang('Enter_email_id'); ?>" name="username">
                            </div>
                            <div class="form-group first_fld_top">
                                <label for="lcr_number"><?php echo lang('CR_Number'); ?></label>
                                <input type="text" class="form-control" id="forget_cr_number" placeholder="<?php echo lang('Enter_CR_Number'); ?>" name="cr_number">
                            </div>
                            <button class="btn btn-solid"><?php echo lang('Send'); ?></button>

                            <a id="sign_in_link" href="javascript:void(0)" class="forgt_pass"> <?php echo lang('Sign_In'); ?> </a>
                            <div class="clear"></div>
                        </form>
                    </div>

                </div>
            </div>
            <div class="col-lg-6 right-login sing_up_tn_wrp">

                <div class="cover_panl_reg wow slideInLeft" data-wow-duration="0.8s" data-wow-delay="0s" style="visibility: visible; animation-duration: 0.8s; animation-delay: 0s;">
                    <div class="crt_acnt_a">
                        <?php echo lang('Join_Port10'); ?>
                    </div>

                    <div class="crt_acnt_lorm">
                        <?php echo lang('Become_part_of_our'); ?>
                    </div>

                    <div class="signup_covr_btn"><?php echo lang('Sign_Up'); ?></div>
                </div>

                <div class="wow signup_formmn" data-wow-duration="0.7s" data-wow-delay="0.0s" style="visibility: visible; animation-duration: 0.7s; animation-delay: 0.0s;">
                    <h3><?php echo lang('Sign_Up'); ?></h3>
                    <div class="theme-card authentication-right registr_form_main">
                        <form class="theme-form" id="signup_form" method="POST">
                            <div class="register_panl_1">

                                <div class="form-group first_fld_top ">
                                    <label for="stype"><?php echo lang('Select_Account_Type'); ?> <span class="strict">*</span></label>
                                    <select class="form-control acount_typ_as" id="stype" name="type">
                                        <option value=""><?php echo lang('Select_Account_Type'); ?></option>
                                        <option value="suppler">Supplier</option>
                                        <option value="buyer">Buyer</option>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="sestiblishment"><?php echo lang('Entity_Name'); ?> <span class="strict">*</span><i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="<?php echo lang('Name_of_the_Manufacturer_or_Wholesaler'); ?>"></i></label>
                                    <input type="text" class="form-control space isSpecial" id="sestiblishment" placeholder="<?php echo lang('Entity_Name'); ?>" name="entity_name">
                                </div>
                                <div class="form-group">
                                    <label for="scr_number"><?php echo lang('CR_Number'); ?> <span class="strict">*</span></label>
                                    <input type="text" class="form-control space" id="scr_number" placeholder="<?php echo lang('CR_Number'); ?>" name="cr_number" onkeypress="return isNumberKey(event)">

                                </div>



                                <div class="clear"></div>
                                <label class="">
                                    <input type="checkbox" name="remember_me">
                                    <span class="login_ck_spn"><?php echo lang('Keep_Me_Signed_In'); ?></span>
                                </label>
                                <button style="margin-right: 95px;width: 200px" id="next1" type="button" class="btn btn-solid regist_nex next_registr1"><?php echo lang('Next'); ?></button>

                                <div class="clear"></div>
                            </div>

                            <div class="register_panl_2">
                                <div class="form-group">
                                    <label for="sstreet_name"><?php echo lang('Street_Name'); ?> </label>
                                    <input type="text" class="form-control space" id="sstreet_name" placeholder="<?php echo lang('Street_Name'); ?>" name="street_name">
                                </div>
                                <div class="form-group">
                                    <label for="sbuilding_no"><?php echo lang('Building_Num'); ?> </label>
                                    <input type="text" class="form-control space" id="sbuilding_no" placeholder="<?php echo lang('Building_Num'); ?>" name="building_no">
                                </div>

                                <div class="form-group hlf_fld_lft">
                                    <label for="scity"><?php echo lang('City'); ?> <span class="strict">*</span></label>
                                    <select class="form-control " id="scity" name="city">
                                        <option value=""><?php echo lang('Select_City'); ?></option>
                                        <?php if (!empty($city_list)) {
                                            foreach ($city_list as $cl_key => $cl_val) { ?>
                                                <option value="<?php echo $cl_val['city_name']; ?>"><?php echo $cl_val['city_name']; ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                    <!-- <input type="text" class="form-control space" id="scity" placeholder="City" name="city"> -->
                                </div>

                                <div class="form-group hlf_fld_right">
                                    <label for="sstate"><?php echo lang('State_Province_Region'); ?> <span class="strict">*</span></label>
                                    <select class="form-control " id="sstate" name="state">
                                        <option value=""><?php echo lang('Select_State_Province_Region'); ?></option>
                                        <?php if (!empty($state_list)) {
                                            foreach ($state_list as $sl_key => $sl_val) { ?>
                                                <option value="<?php echo $sl_val['state_name']; ?>"><?php echo $sl_val['state_name']; ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>

                                <!-- <div style="display: none;" class="form-group hlf_fld_lft">
                                    <label for="spostal_code"><?php //echo lang('Zip_Or_Postal_Code'); 
                                                                ?> </label>
                                    <select class="form-control " id="spostal_code1" name="postal_code1">
                                        <option value=""><?php //echo lang('Select_Zip_Or_Postal_Code'); 
                                                            ?></option>
                                        <?php if (!empty($postal_code_list)) {
                                            foreach ($postal_code_list as $pcl_key => $pcl_val) { ?>
                                                <option value="<?php //echo $pcl_val['postal_code']; 
                                                                ?>"><?php// echo $pcl_val['postal_code']; ?></option>
                                        <?php }
                                        } ?>
                                    </select>                                       
                                </div> -->

                                <div class="form-group hlf_fld_lft">
                                    <label for="scountry"><?php echo lang('Zip_Or_Postal_Code'); ?></label>
                                    <input type="text" class="form-control space" id="spostal_code" placeholder="<?php echo lang('Enter_Postal_Code'); ?>" value="" name="postal_code" onkeypress="return isNumberKey(event)">
                                </div>

                                <div class="form-group hlf_fld_right">
                                    <label for="scountry"><?php echo lang('Country'); ?></label>
                                    <input type="text" class="form-control space" id="scountry" placeholder="<?php echo lang('Country'); ?>" value="Saudi Arabia" name="country" readonly>
                                </div>

                                <div class="clear"></div>

                                <a class="btn btn-solid regstr_new_a_bck back_reg_2"><?php echo lang('Back'); ?></a>
                                <button type="button" id="next2" class="btn btn-solid regist_nex next_registr2"><?php echo lang('Next'); ?></button>

                                <div class="clear"></div>
                            </div>

                            <div class="register_panl_3">
                                <div class="form-group hlf_fld_lft">
                                    <label for="sphone"><?php echo lang('Phone'); ?> <span class="strict">*</span></label>
                                    <input type="text" class="form-control space2 ccp" id="sphone" placeholder="<?php echo lang('Phone'); ?>" name="phone" onkeypress="return isNumberKey(event)">
                                </div>
                                <div class="form-group hlf_fld_right">
                                    <label for="semail"><?php echo lang('Email'); ?> <span class="strict">*</span></label>
                                    <input type="text" class="form-control space" id="semail" placeholder="<?php echo lang('Email'); ?>" name="email">
                                </div>

                                <div class="form-group hlf_fld_lft">
                                    <label for="svat_number"><?php echo lang('VAT_Number'); ?> <span class="strict">*</span></label>
                                    <input type="text" class="form-control" id="svat_number" placeholder="<?php echo lang('VAT_Number'); ?>" name="vat_number" onkeypress="return isNumberKey(event)">
                                </div>
                                <div class="form-group hlf_fld_right">
                                    <label for="sbank_name"><?php echo lang('Preferred_Bank_Name'); ?><span class="strict">*</span></label>
                                    <select class="form-control " id="sbank_name" name="bank_name">
                                        <option value=""><?php echo lang('Select_Preferred_Bank_Name'); ?></option>
                                        <?php if (!empty($bank_details)) {
                                            foreach ($bank_details as $bd_key => $bd_val) { ?>
                                                <option value="<?php echo $bd_val['id']; ?>"><?php echo $bd_val['bank_name']; ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                                <div class="clear"></div>
                                <div class="form-group hlf_fld_lft">
                                    <label for="siban"><?php echo lang('IBAN'); ?> <span class="strict">*</span></label>
                                    <input type="text" class="form-control isSpecial" id="siban" placeholder="<?php echo lang('IBAN'); ?>" name="iban">
                                </div>

                                <div class="form-group hlf_fld_right">
                                    <label for="sbank_name"><?php echo lang('User_Name'); ?> <span class="strict">*</span><i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="<?php echo lang('Name_of_the_individual'); ?>"></i></label>
                                    <input type="text" class="form-control space" id="sfirst_name" placeholder="<?php echo lang('User_Name'); ?>" name="first_name">
                                </div>

                                <div class="clear"></div>
                                <div class="form-group hlf_fld_lft">
                                    <label for="spass"> <?php echo lang('Password'); ?> <span class="strict">*</span><i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="<?php echo lang('password_Minimum'); ?>"></i></label>
                                    <input type="password" class="form-control" id="spass" placeholder="<?php echo lang('Password'); ?>" name="password">
                                    <span toggle="#spass" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>

                                <div class="form-group hlf_fld_right">
                                    <label for="scpass"><?php echo lang('Confirm_Password'); ?> <span class="strict">*</span></label>
                                    <input type="password" class="form-control" id="scpass" placeholder="<?php echo lang('Confirm_Password'); ?>" name="scpass">
                                    <span toggle="#scpass" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>

                                <div class="clear"></div>

                                <a class="btn btn-solid regstr_new_a_bck back_reg_3"><?php echo lang('Back'); ?></a>
                                <button class="btn btn-solid regist_nex next_registr3"><?php echo lang('Sign_Up'); ?></button>

                                <div class="clear"></div>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!--Section ends-->

<script type="text/javascript">
    // $(".next_registr1").click(function(){
    // $(".register_panl_1").addClass("hide_pn_reg");
    // $(".register_panl_2").addClass("show_pn_reg");
    // });

    $(".back_reg_2").click(function() {
        $(".register_panl_1").removeClass("hide_pn_reg");
        $(".register_panl_2").removeClass("show_pn_reg");
    });

    // $(".next_registr2").click(function(){
    // $(".register_panl_2").removeClass("show_pn_reg");
    // $(".register_panl_3").addClass("show_pn_reg");
    // });

    $(".back_reg_3").click(function() {
        $(".register_panl_2").addClass("show_pn_reg");
        $(".register_panl_3").removeClass("show_pn_reg");
    });

    $(".signup_covr_btn").click(function() {
        $(".cover_panl_reg").addClass("cove_panel_hide");
        $(".cover_panl_login").addClass("cove_panel_show");
    });

    $(".signin_covr_btn").click(function() {
        $(".cover_panl_reg").removeClass("cove_panel_hide");
        $(".cover_panl_login").removeClass("cove_panel_show");
    });

    $(".signup_covr_btn").click(function() {
        $(".signup_formmn").addClass("fadeInLeft");
        $(".signin_formmn").addClass("fadeOut");

    });

    $(".signin_covr_btn").click(function() {

        $(".signup_formmn").removeClass("fadeInLeft");
        $(".signup_formmn").addClass("fadeOut");

    });

    $(".signup_covr_btn").click(function() {
        $(".signup_formmn").removeClass("fadeOut");
        $(".signup_formmn").addClass("fadeInLeft");
        $(".signin_formmn ").addClass("fadeOut");
        $(".signin_formmn").addClass("fadeOut");

    });


    $(".signin_covr_btn").click(function() {
        $(".signin_formmn").removeClass("fadeOut");
        $(".signin_formmn").addClass("fadeInRight");


    });
</script>

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
    $(document).on("click", "#next1", function() {
        var error = 1;
        var stepone = 1;
        var stype = $("#stype").val();
        var sestiblishment = $.trim($("#sestiblishment").val());

        // var regEx = /^[0-9a-zA-Z]+$/;
        //   if(sestiblishment.value.match(regEx))
        //     {
        //      alert('Please enter letters and numbers only.')
        //     }
        //     return false;





        var scr_number = $.trim($("#scr_number").val());

        if (stype == "" || stype == 0) {
            error = 0;
            stepone = 0;
            swal("", "<?php echo lang('Please_Select_Account_Type'); ?>", "warning");
            return false;
        }

        if (stype == "suppler" || stype == "buyer") {} else {
            error = 0;
            stepone = 0;
            swal("", "Please Select Valid Type", "warning");
            return false;
        }

        if (sestiblishment == "") {
            error = 0;
            stepone = 0;
            swal("", "<?php echo lang('Please_Enter_Entity_Name'); ?>", "warning");
            return false;
        }

        if (scr_number == "") {
            error = 0;
            stepone = 0;
            swal("", "<?php echo lang('Please_Enter_CR_Number'); ?>", "warning");
            return false;
        }
        if (error == 1) {
            $(".register_panl_1").addClass("hide_pn_reg");
            $(".register_panl_2").addClass("show_pn_reg");
        }
    });

    $(document).on("click", "#next2", function() {
        var sstreet_name = $.trim($("#sstreet_name").val());
        var sbuilding_no = $.trim($("#sbuilding_no").val());
        var scity = $.trim($("#scity").val());
        var sstate = $.trim($("#sstate").val());
        var spostal_code = $.trim($("#spostal_code").val());
        var scountry = $.trim($("#scountry").val());
        var error = 1;
        var steptwo = 1;
        //  if(sstreet_name=="")
        // {
        //     error=0;
        //     steptwo=0;
        //     swal("","Please enter Street Name","warning");
        //     return false;
        // }

        // if(sbuilding_no=="")
        // {
        //     error=0;
        //     steptwo=0;
        //     swal("","Please Enter Building Num / Suite Num / Office Num","warning");
        //     return false;
        // }

        if (scity == "") {
            error = 0;
            steptwo = 0;
            swal("", "<?php echo lang('Please_Select_City'); ?>", "warning");
            return false;
        }

        if (sstate == "") {
            error = 0;
            steptwo = 0;
            swal("", "<?php echo lang('Select_State_Province_Region'); ?>", "warning");
            return false;
        }

        // if(spostal_code=="")
        // {
        //     error=0;
        //     steptwo=0;
        //     swal("","Please Select Zip Or Postal Code","warning");
        //     return false;
        // } 

        if (scountry != 'Saudi Arabia') {
            error = 0;
            steptwo = 0;
            swal("", "<?php echo lang('Invalid_Country'); ?>", "warning");
            return false;
        }

        if (steptwo == 1) {
            $(".register_panl_2").removeClass("show_pn_reg");
            $(".register_panl_3").addClass("show_pn_reg");
        }
    });
</script>


<script type="text/javascript">
    $(document).on("submit", "#signup_form", function(e) {
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
        var spass = $.trim($("#spass").val());
        var scpass = $.trim($("#scpass").val());


        if (sphone == "") {
            error = 0;
            stepthree = 0;
            swal("", "<?php echo lang('Please_Enter_Phone'); ?>", "warning");
            return false;
        }

        if (semail == "") {
            error = 0;
            stepthree = 0;
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
            stepthree = 0;
            swal("", "<?php echo lang('Please_Enter_VAT_Number'); ?>", "warning");
            return false;
        }
        if (sbank_name == "") {
            error = 0;
            stepthree = 0;
            swal("", "<?php echo lang('Please_Select_Preferred_Bank_Name'); ?>", "warning");
            return false;
        }

        if (siban == "") {
            error = 0;
            stepthree = 0;
            swal("", "<?php echo lang('Please_Enter_IBAN'); ?>", "warning");
            return false;
        }

        var letterNumber = /^[0-9a-zA-Z]+$/;
        if (!sestiblishment.match(letterNumber)) {
            error = 0;
            stepthree = 0;
            swal("", "<?php echo lang('IBNA_Must_Be_Alpha_Number_Value'); ?>", "warning");
            return false;
        }

        if (sfirst_name == "") {
            error = 0;
            stepthree = 0;
            swal("", "<?php echo lang('Please_Enter_User_Name'); ?>", "warning");
            return false;
        }

        if (spass == "") {
            error = 0;
            stepthree = 0;
            swal("", "<?php echo lang('Please_Enter_Password'); ?>", "warning");
            return false;
        } else {
            if (!isValidpassword(spass)) {
                error = 0;
                stepthree = 0;
                swal("", "<?php echo lang('password_Minimum'); ?>", "warning");
                return false;
            }
        }

        if (scpass == "") {
            error = 0;
            stepthree = 0;
            swal("", "<?php echo lang('Please_Enter_Confirm_Password'); ?>", "warning");
            return false;
        }

        if (scpass != spass) {
            error = 0;
            stepthree = 0;
            swal("", "<?php echo lang('Password_&_confirm_password_not_matched'); ?>", "warning");
            return false;
        }

        if (error == 1) {
            $("#loading").show();
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url($language . '/register') ?>",
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
                    } else if (response == "invalid_crnumber") {
                        swal('', "Please Enter Valid CR Number", 'warning');
                    } else if (response == "success") {
                        // success for user /buyer    
                        swal('<?php echo lang('Successfully_Register'); ?>', "<?php echo lang('Please_verify_your_email'); ?>", 'success');
                        // setTimeout(function(){ },2900);
                        setTimeout(function() {
                            window.location = "<?php echo base_url($language . '/home') ?>"
                        }, 3500);
                    } else if (response == "success1") {
                        //this for suppler and both         
                        swal('<?php echo lang('Successfully_Register'); ?>', "<?php echo lang('Please_verify_your_email'); ?>", 'success');
                        // setTimeout(function(){ },2900);
                        setTimeout(function() {
                            window.location = "<?php echo base_url($language . '/home') ?>"
                        }, 3500);
                    } else {
                        swal('', "<?php echo lang('Something'); ?>", 'warning');
                    }
                }
            });
        }
    });
</script>

<script type="text/javascript">
    $(document).on("submit", "#login_form", function(e) {
        e.preventDefault();
        var lcr_number = $("#lcr_number").val();
        var lpass = $("#lpass").val();
        var error = 1;

        if (lcr_number == '') {
            $error = 0;
            swal('', "<?php echo lang('Please_Enter_CR_Number'); ?>", 'warning');
            return false;
        }

        if (lpass == '') {
            $error = 0;
            swal('', "<?php echo lang('Please_Enter_Password'); ?>", 'warning');
            return false;
        }

        if (error == 1) {
            //alert('success');
            $('#loading').show();
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url($language . '/login') ?>",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    $('#loading').hide();
                    switch (response) {
                        case 'email':
                            swal('', "<?php echo lang('Invalid_Login_Details'); ?>", 'warning');
                            break;

                        case 'deactivate':
                            swal("Error!", "<?php echo lang('Account_is_deactivate'); ?>", "warning")
                            break;

                        case 'verify_email':
                            swal("Error!", "<?php echo lang('Please_verify_your_email2'); ?>", "warning")
                            break;

                        case 'pass':
                            $("#login_password").val('');
                            swal('', "<?php echo lang('Invalid_Login_Details'); ?>", 'warning');
                            break;
                        case 'account_terminate':
                            swal('', "<?php echo lang('Your_account_is_terminated'); ?>", 'warning');
                            break;

                        case 'logged_user':
                            setTimeout(function() {
                                window.location = "<?php echo base_url($language) ?>"
                            }, 1500);
                            break;

                        case 'success':
                            swal('', "<?php echo lang('Login_Successfully'); ?>", 'success');
                            // setTimeout(function(){ },2900);
                            setTimeout(function() {
                                window.location = "<?php echo base_url($language . '/home') ?>"
                            }, 1500);
                            break;

                        case 'success1':
                            swal('', "<?php echo lang('Login_Successfully'); ?>", 'success');
                            // setTimeout(function(){ },2900);
                            setTimeout(function() {
                                window.location = "<?php echo base_url($language . '/admin') ?>"
                            }, 1500);
                            break;
                        case 'expired':
                            plan_swal();
                            break;
                    }

                }
            });
        }
    });
</script>

<script type="text/javascript">
    $(document).on("click", "#forget_pss_link", function() {
        $(".signin_formmn").hide();
        $(".forget_form").show();
    });

    $(document).on("click", "#sign_in_link", function() {
        $(".forget_form").hide();
        $(".signin_formmn").show();
    });

    $(document).on("submit", "#forget_form", function(e) {
        e.preventDefault();
        var forget_email = $.trim($("#forget_email").val());
        var forget_cr_number = $.trim($("#forget_cr_number").val());
        var error = 1;

        if (forget_email == "") {
            error = 0;
            stepthree = 0;
            swal("", "<?php echo lang('Please_enter_email'); ?>", "warning");
            return false;
        }

        if (forget_email != '') {
            if (!isValidEmailAddress(forget_email)) {
                error = 0;
                swal("", "<?php echo lang('Please_Enter_Valid_Email_Id'); ?>", "warning");
                return false;
            }
        }

        if (forget_cr_number == "") {
            error = 0;
            stepthree = 0;
            swal("", "<?php echo lang('Please_Enter_CR_Number'); ?>", "warning");
            return false;
        }
        if (error == 1) {
            //alert('success');
            $('#loading').show();
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url($language . '/login/forgetpassword') ?>",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    $('#loading').hide();
                    response = $.trim(response);
                    if (response == "empty") {
                        swal("", "<?php echo lang('Please_enter_email'); ?>", "warning");
                    } else if (response == "empty2") {
                        swal("", "<?php echo lang('Please_Enter_CR_Number'); ?>", "warning");
                    } else if (response == "success") {
                        $(".forget_form").hide();
                        $(".signin_formmn").show();
                        swal("", "<?php echo lang('Password_reset_link_send_Successfully'); ?>", "success");
                    } else if (response == "notexist") {
                        swal("", "<?php echo lang('Please_enter_valid_email_id_cr_number'); ?>", "warning");
                    } else {
                        swal("", "<?php echo lang('Something'); ?>", "warning");
                    }
                }
            });
        }


    });

    function plan_swal() {
        swal({
                title: "<?php echo lang('Login_Successfully'); ?>",
                text: "<?php echo lang('Your_plan_expired'); ?>",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Ok",
                ancelButtonText: "Cancel",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function(inputValue) {
                if (inputValue === true) {
                    window.location = "<?php echo base_url($language . '/price'); ?>";
                } else {
                    setTimeout(function() {
                        window.location = "<?php echo base_url('admin') ?>"
                    }, 500);
                }
            });
    }
</script>