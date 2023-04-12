<style type="text/css">
	.form-group.form-float.form-group-lg {
		width: 100%;
	}
</style>

<?php echo $form->messages();
$btn_nm = 'Sign_In';
?>

<div>
	<div class="login_box_inner">

		<div class="login-box login_box_back">

			<div class="login-logo img-circular"><b>
					<?php if ($language == 'en') { ?>
						<?php
						echo '<img src="' . base_url() . 'assets/frontend/images/logo-2.png" alt="Login-header-logo" style="width: 50px;">';
						?>
					<?php } else { ?>
						<?php
						echo '<img src="' . base_url() . 'assets/frontend/images/icon/arabic-logo.png" alt="Login-header-logo" style="width: 50px;">';
						?>
					<?php } ?>
					<!-- <?php
					echo '<img src="' . base_url() . 'assets/frontend/images/logo-2.png" alt="Login-header-logo" style="width: 50px;">';
					?> -->
				</b></div>

			<div class="login-box-body">
				<p class="login-box-msg">
					<?php echo lang('aSign_in_to_start_your_session'); ?>
				</p>
				<?php //echo $form->open('name'); ?>
				<form action="<?php echo base_url($language . '/admin/login'); ?>" method="post" accept-charset="utf-8"
					id="admin_login">
					<?php echo $form->messages(); ?>
					<?php echo $form->bs3_text('Username', 'username', $remember_arr['remember_user_name'], ['class' => 'text_user_form', 'autocomplete' => 'foo']); ?>
					<?php echo $form->bs3_password('Password', 'password', $remember_arr['remember_password'], ['class' => 'text_pass_form']); ?>
					<div class="row">
						<div class="col-xs-12 remembr_me_div">
							<div class="checkbox d-flex">
								<label><input style="margin-top:0.5rem !important" type="checkbox" name="remember" <?php echo $remember_c; ?>>
									<h6 style="margin-right: 3rem;">
										<?php echo lang('aRemember_Me'); ?>
									</h6>
								</label>
							</div>
						</div>
						<div class="col-xs-12 btn_login_submt">
							<!-- <?php echo $form->bs3_submit('Sign In', 'btn btn-primary btn-block btn-flat login_class'); ?> -->
							<?php echo $form->bs3_submit($label = lang($btn_nm), 'btn btn-primary btn-block btn-flat login_class'); ?>
						</div>
					</div>
					<?php echo $form->close(); ?>
			</div>

		</div>



	</div>
	<div class="float-right">
		<?php if ($language == 'en') { ?>
			<img style="float: right;cursor:pointer;margin-right:2rem" class="en_toggle toggle_cls"
				src="<?php echo base_url('assets/admin/images/') ?>arabic_btn.png">
		<?php } else { ?>
			<li class="toggle_menu">
				<img class="ar_toggle toggle_cls" src="<?php echo base_url('assets/admin/images/') ?>ar_load.png">
			</li>
		<?php } ?>

	</div>
	<div id="loading" style="display: none">
		<img id="loading-image" src="<?php echo base_url('assets/admin/images/') ?>loaders.gif" alt="Loading..." />
	</div>
</div>

<style type="text/css">
	.login_box_back {
		float: left;
	}


	.login-box {
		background-color: #fff;
		width: 100%;
		padding: 10px 13%;
		box-shadow: 0 0 30px 0 rgba(0, 0, 0, 0.4), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
		width: 70%;
		padding-top: 60px;
		text-align: left;
		box-shadow: 6px 4px 16px #0000006e !important;
	}

	.login-logo {
		text-align: center;
		width: 100%;
		box-sizing: border-box;
	}

	.login-box-msg {
		font-size: 17px;
		color: #fff;
		text-align: center;
		margin-bottom: 20px;
	}

	body.ar .toggle_cls {
		height: auto;
		margin-top: 27px;
		cursor: pointer;
		float: left;
		margin-left: 2rem;
	}

	.img-circular {
		width: 200px;
		height: 200px;
		/*background-color:black;*/
		background-size: cover;
		display: block;
		border-radius: 100px;
		-webkit-border-radius: 100px;
		-moz-border-radius: 100px;
	}

	.img-circular {
		width: 60px;
		height: 60px;
		/*background-color: black;*/
		display: block;
		border-radius: 100px;
		-webkit-border-radius: 100px;
		-moz-border-radius: 100px;
		vertical-align: center;
		margin-left: 30%;
		margin-bottom: 5%;
	}

	.login_box_inner {

		width: 100%;
		/* left: 0; */
		float: left;
		position: absolute;
		top: 0;
		padding: 10px 20%;
		height: 100%;
	}

	body.ar .toggle_cls {
		height: auto;
		margin-top: 0px !important;
		cursor: pointer;
		float: left;
	}



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
</style>
<script type="text/javascript">
	$(document).on('submit', '#admin_login', function () {

		var username = $("#username").val();
		var password = $("#password").val();
		if (username == '') {
			swal("", "Please enter username", 'warning');
			return false;
		}
		if (password == '') {
			swal("", "Please enter password", 'warning');
			return false;
		}
		$('#loading').show();
	});
</script>
<script type="text/javascript">
	$('.en_toggle').click(function () {
		$(this).toggleClass("radio_on");
		url = "<?php echo lang_url('ar'); ?>";
		window.location = url;
	});
	$('.ar_toggle').click(function () {
		$(this).toggleClass("radio_on");
		url = "<?php echo lang_url('en'); ?>";
		window.location = url;
	});
</script>