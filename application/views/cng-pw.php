<style>
    .activ_change_pas a {
        font-weight: 700 !important;
        color: #004670 !important;
    }
</style>
<!-- breadcrumb start -->
<div class="breadcrumb-section">
    <div class="container container_detl_wdth">
        <div class="row">
            <div class="col-sm-6">
                <div class="page-title">
                    <h2>Change Password</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb End -->
<article class="container theme-container">
    <div class="row">
        <?php include("my_account_menu.php"); ?>
        <!-- Posts Start -->
        <aside class="col-md-8 col-sm-8 space-bottom-45">
            <div class="account-details-wrap">
                <div class="title-2 sub-title-small"> Change your password</div>
                <div class="account-box  light-bg default-box-shadow">
                    <form action="" class="form-delivery" id="change_pass"
                          method="post">
                        <div class="row top_pading_sec">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <div class="label_new"> Old Password</div>
                                    <input class="form-control" type="password"
                                           placeholder="Old Password" id="old_password"
                                           name="old_password">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <div class="label_new"> New Password <i
                                            class="fa fa-question-circle"
                                            aria-hidden="true" data-toggle="tooltip"
                                            data-placement="top"
                                            title="Password Minimum six characters, at least one uppercase letter, one lowercase letter, one number and one special character"></i>
                                    </div>
                                    <input class="form-control" type="password"
                                           placeholder="New Password" id="password"
                                           name="password">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <div class="label_new"> Confirm Password <i
                                            class="fa fa-question-circle"
                                            aria-hidden="true" data-toggle="tooltip"
                                            data-placement="top"
                                            title="Password Minimum six characters, at least one uppercase letter, one lowercase letter, one number and one special character"></i>
                                    </div>
                                    <input class="form-control" type="password"
                                           placeholder="Confirm Password"
                                           id="confirm_password"
                                           name="confirm_password">

                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <label class="pink-btn btn_main_updt">
                                    <input type="submit" value="Update">
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </aside>
        <!-- Posts Ends -->
    </div>
    <br/><br/>
</article>
<!--____ACTIVE_PAGE_CSS____-->

<script type="text/javascript">
    $(document).on("submit", "#change_pass", function () {
        var password = $("#password").val();
        var confirm_password = $("#confirm_password").val();
        var old_password = $("#old_password").val();
        var error = 1;

        if (old_password == '') {
            error = 0;
            swal("", "Please enter old password", "warning");
            return false;
        }

        if (password == '') {
            error = 0;
            swal("", "Please enter new password", "warning");
            return false;
        }

        if (!isValidpassword(password)) {
            error = 0;
            swal("", "Password Minimum six characters, at least one uppercase letter, one lowercase letter, one number and one special character", "warning");
            return false;
        }

        if (confirm_password == '') {
            error = 0;
            swal("", "Please enter confirm password", "warning");
            return false;
        }

        if (!isValidpassword(confirm_password)) {
            error = 0;
            swal("", "Confirm Password Minimum six characters, at least one uppercase letter, one lowercase letter, one number and one special character", "warning");
            return false;
        }

        if (password != confirm_password) {
            error = 0;
            swal("", "Password and confirm password not match", "warning");
            return false;
        }

        if (error == 1) {
        } else {
            swal("", "Something went wrong", "warning");
            return false
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        <?php if ($this->session->flashdata('success')): ?>
        swal("", "<?php echo $this->session->flashdata('success'); ?>", "success");
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
        swal("", "<?php echo $this->session->flashdata('error'); ?>", 'warning');
        <?php endif; ?>
    });
</script>
