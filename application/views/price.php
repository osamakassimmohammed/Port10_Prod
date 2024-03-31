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

    .sub_feature {
        font-size: 15px;
        font-weight: 600;
        padding-left: 30px;
        padding-top: 12px;
        padding-bottom: 12px;
        border: 1px solid #cccccc;
        background-color: #cccccc;
        margin-bottom: 10px;
    }

    .sub_point {
        font-size: 6px;
        position: absolute;
        margin-top: 6px;
        margin-left: -12px;
    }

    .sub_price, .sub_year {
        text-align: center;
    }

    .sub_btn_div {
        text-align: center;
        margin-top: 30px;
    }


</style>


<div class="clear"></div>

<!--section start-->
<section class="login-page section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 sing_in_tn_wrp">

                <div class="cover_panl_reg wow slideInLeft" data-wow-duration="0.8s"
                     data-wow-delay="0s"
                     style="visibility: visible; animation-duration: 0.8s; animation-delay: 0s;">
                    <div class="crt_acnt_a">
                        <?php echo $subs_plans[0]['title']; ?>
                    </div>

                    <div class="crt_acnt_lorm">
                        <?php echo $subs_plans[0]['description']; ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 right-login sing_up_tn_wrp">

                <div class="wow signup_formmn" data-wow-duration="0.7s"
                     data-wow-delay="0.0s"
                     style="visibility: visible; animation-duration: 0.7s; animation-delay: 0.0s;">
                    <h3><?php echo $subs_plans[0]['plan_title']; ?></h3>
                    <div class="theme-card authentication-right registr_form_main">
                        <h2 class="sub_price"><?php echo $currency_symbol; ?> </span><?php echo number_format($subs_plans[0]['amount'], 2); ?></h2>
                        <h4 class="sub_year">PER YEAR</h4>
                    </div>
                    <?php if (!empty($subs_plans[0]['sub_more_data'])) {
                        foreach ($subs_plans[0]['sub_more_data'] as $sup_key => $sup_val) { ?>
                            <div class="sub_feature">
                                <span class="sub_point"> <i class="fa fa-circle"
                                                            aria-hidden="true"></i></span><?php echo $sup_val['description']; ?>
                            </div>
                        <?php }
                    } ?>
                    <div class="sub_btn_div">
                        <button style="width: 200px" id="next1" type="button"
                                class="btn btn-solid dealer_check"
                                data-id="<?php echo en_de_crypt($subs_plans[0]['id']); ?>"><?php echo lang('JOIN'); ?></button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!--Section ends-->

<script type="text/javascript">
    $(document).on("click", ".dealer_check", function () {
        var id = $(this).attr('data-id');
        $("#loading").show();
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url($language . '/payment/index') ?>",
            data: {id: id},
            success: function (response) {
                response = $.trim(response);
                response = $.parseJSON(response);
                // console.log(response.status);
                if (response.status == true) {
                    // url="<?php //echo base_url($language.'/payment/index/'); ?>"+id;
                    setTimeout(function () {
                        window.location = response.message;
                    }, 500);
                } else {
                    $("#loading").hide();
                    if (response.error_type == 'login') {
                        // swal("",response.message,"warning");
                        login_swal();
                    } else {
                        swal("", response.message, "warning");
                    }
                }
            }
        });
    });
</script>


