<script type="text/javascript">
    var ghcat_id = '';
</script>
<!-- footer -->
<footer class="footer-light">
    <div class="light-layout">
        <div class="container">
            <section class="small-section border-section border-top-0">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="subscribe">
                            <div>
                                <h4><?php echo lang('fsub_1'); ?></h4>
                                <p><?php echo lang('fsub_2'); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <form action=""
                              class="form-inline subscribe-form auth-form needs-validation"
                              method="post" id="subscribe_form">
                            <div class="form-group mx-sm-3">
                                <input type="text" class="form-control" name="EMAIL"
                                       id="sub_email"
                                       placeholder="<?php echo lang('Enter_Your_Email'); ?>">
                                <button type="submit" class="btn btn-solid"
                                        id=""><?php echo lang('subscribe'); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <section class="section-b-space light-layout footer_background_navy">
        <div class="container">
            <div class="row footer-theme partition-f">

                <div class="col ">
                    <div class=" footer_socl_logo responsiv_height">
                        <div class="footer-title footer-mobile-title">
                            <h4><?php echo lang('ABOUT_PORT10'); ?></h4>
                        </div>
                        <div class="footer-contant">
                            <div class="footer-logo"><img
                                    src="<?php echo base_url('assets/frontend/images/icon/foot_logo.png'); ?>"
                                    alt=""></div>
                            <p><?php echo lang('Follow_Us'); ?></p>
                            <div class="footer-social">
                                <ul>
                                    <li><a href="https://www.facebook.com"><i
                                                class="fa fa-facebook"
                                                aria-hidden="true"></i></a></li>
                                    <li><a href="https://www.youtube.com/"><i
                                                class="fa fa-youtube"
                                                aria-hidden="true"></i></a></li>
                                    <li><a href="https://twitter.com"><i
                                                class="fa fa-twitter"
                                                aria-hidden="true"></i></a></li>
                                    <li><a href="https://www.linkedin.com/"><i
                                                class="fa fa-linkedin"
                                                aria-hidden="true"></i></a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col ">

                    <div class="sub-title responsiv_height">
                        <div class="footer-title">
                            <h4><?php echo lang('Our_address'); ?></h4>
                        </div>
                        <div class="footer-contant">
                            <ul class="contact-list">
                                <li>
                                    <i class="fa fa-map-marker"></i><?php if ($language == 'en') {
                                        echo @$footer_content[0]['location'];
                                    } else {
                                        echo @$footer_content[0]['location_arabic'];
                                    } ?>
                                </li>
                                <li>
                                    <i class="fa fa-phone"></i><?php echo lang('Call_Us'); ?>
                                    : <a
                                        href="tel:<?php echo @$footer_content[0]['mobile_no']; ?>"><?php echo @$footer_content[0]['mobile_no']; ?></a>
                                </li>
                                <li>
                                    <i class="fa fa-envelope-o"></i><?php echo lang('Email_Us'); ?>
                                    : <a
                                        href="mailto:<?php echo @$footer_content[0]['email_id']; ?>"><?php echo @$footer_content[0]['email_id']; ?></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php if (!empty($main_category)) { ?>
                    <div class="col ">
                        <div class="sub-title responsiv_height">
                            <div class="footer-title">
                                <h4><?php echo lang('BUY_ON_PORT10'); ?></h4>
                            </div>
                            <div class="footer-contant">
                                <ul>
                                    <?php foreach ($main_category as $key => $val) { ?>
                                        <li>
                                            <a href="<?php echo base_url($language . '/home/listing/') . $val['id']; ?>"><?php echo $val['display_name']; ?></a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="col ">
                    <div class="sub-title responsiv_height">
                        <div class="footer-title ">
                            <h4><?php echo lang('ABOUT_PORT10'); ?></h4>
                        </div>
                        <div class="footer-contant">
                            <ul>
                                <li>
                                    <a href="<?php echo base_url($language . '/page/index/about') ?>"><?php echo lang('About_Us'); ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url($language . '/page/index/privacy-policy') ?>"><?php echo lang('Privacy_Policy'); ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url($language . '/page/index/terms-of-service') ?>"><?php echo lang('Terms_Of_Service'); ?></a>
                                </li>
                                <li>
                                    <a href="<?Php echo base_url($language . '/contact_us'); ?>"><?php echo lang('Contact_Us'); ?></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <br><br>
                    <div class="sub-title responsiv_height">
                        <div class="footer-title">
                            <h4><?php echo lang('Support'); ?></h4>
                        </div>
                        <div class="footer-contant">
                            <ul>
                                <li>
                                    <a href="<?php echo base_url($language . '/blog') ?>"><?php echo lang('Resources'); ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url($language . '/help') ?>"><?php echo lang('Help'); ?></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <br><br>
                    <div class="sub-title responsiv_height">
                        <div class="footer-title">
                            <h4><?php echo lang('Signup_on_Port10'); ?></h4>
                        </div>
                        <div class="footer-contant">
                            <ul>
                                <li>
                                    <a href="<?php echo base_url($language . '/login') ?>"><?php echo lang('Register'); ?></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
    <div class="sub-footer" style="display: none;">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-md-6 col-sm-12">
                    <div class="footer-end">
                        <p><i class="fa fa-copyright" aria-hidden="true"></i> 2021 All
                            rights reserved <a
                                href="<?php echo base_url($language . '/page/index/privacy-policy') ?>">Privacy
                                Policy</a> <a
                                href="<?php echo base_url($language . '/page/index/terms-of-service') ?>">Terms
                                and Conditions</a>
                        </p>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 col-sm-12">
                    <div class="payment-card-bottom">
                        <p>
                            <?php if (!empty(@$footer_content[0]['cr_number'])) { ?>
                                <span>CR Number :<?php echo @$footer_content[0]['cr_number']; ?></span>
                                &nbsp; &nbsp;
                            <?php } ?>
                            <?php if (!empty(@$footer_content[0]['vat_number'])){ ?>
                            <span>VAT Number :<?php echo @$footer_content[0]['vat_number']; ?></span>
                        </p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</footer>
<!-- footer end -->

<!-- theme setting -->
<!-- </div> -->

<!-- Add to cart modal popup end-->
<!-- cart start -->
<div class="addcart_btm_popup" id="fixed_cart_icon">
    <a href="<?php echo base_url($language . '/home/view_cart') ?>" class="fixed_cart">
        <i class="ti-shopping-cart"></i>
    </a>
</div>
<!-- cart end -->
<!-- tap to top -->
<div class="tap-top top-cls">
    <div>
        <i class="fa fa-angle-double-up"></i>
    </div>
</div>
<!-- tap to top end -->

<!-- fly cart ui jquery-->
<script src="<?php echo base_url(); ?>assets/frontend/js/jquery-ui.min.js"></script>
<!-- exitintent jquery-->
<script src="<?php echo base_url(); ?>assets/frontend/js/jquery.exitintent.js"></script>
<!-- <script src="<?php //echo base_url();?>assets/frontend/js/exit.js"></script> -->
<!-- popper js-->
<script src="<?php echo base_url(); ?>assets/frontend/js/popper.min.js"></script>
<!-- slick js-->
<script src="<?php echo base_url(); ?>assets/frontend/js/slick.js"></script>
<!-- menu js-->
<script src="<?php echo base_url(); ?>assets/frontend/js/menu.js"></script>
<!-- lazyload js-->
<script src="<?php echo base_url(); ?>assets/frontend/js/lazysizes.min.js"></script>
<!-- Bootstrap js-->
<script src="<?php echo base_url(); ?>assets/frontend/js/bootstrap.js"></script>
<!-- Bootstrap Notification js-->
<script
    src="<?php echo base_url(); ?>assets/frontend/js/bootstrap-notify.min.js"></script>
<!-- Fly cart js-->
<script src="<?php echo base_url(); ?>assets/frontend/js/fly-cart.js"></script>
<!-- Theme js-->


<!-- Zoom js-->
<script
    src="<?php echo base_url(); ?>assets/frontend/js/jquery.elevatezoom.js"></script>
<script src="<?php echo base_url(); ?>assets/frontend/js/sweetalert.min.js"></script>
<link href="<?php echo base_url(); ?>assets/frontend/css/sweetalert.css"
      rel="stylesheet">


<script src="<?php echo base_url(); ?>assets/frontend/js/script.js"></script>
<script src="<?php echo base_url(); ?>assets/frontend/js/wow.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function () {
        $("#qdeadline").datepicker({dateFormat: 'dd-mm-yy'});
        $("#qdelivery_date").datepicker({dateFormat: 'dd-mm-yy'});
    });
</script>


<script type="text/javascript">
    function isValidEmailAddress(emailAddress) {

        var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);

        return pattern.test(emailAddress);
    }

    /* event for dont allow to enter white space */

    $(document).on('keydown', '.space', function (e) {
        if (e.which === 32 && e.target.selectionStart === 0) {
            return false;
        }
    });


    $(document).on('keydown', '.space2', function (e) {
        // var phone=$("#contact_phone").val();
        // console.log(e.keyCode);
        var phone = $(this).val();
        if (e.keyCode == 8 || e.keyCode == 46 || e.keyCode == 36 || e.keyCode == 9 || e.keyCode == 13) {
            return true;
        }
        if (phone.length <= 9) {
            return true;
        } else {
            return false;
        }
    });

    function setInputFilter(textbox, inputFilter) {
        ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function (event) {
            textbox.addEventListener(event, function () {
                if (inputFilter(this.value)) {
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                } else if (this.hasOwnProperty("oldValue")) {
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                } else {
                    this.value = "";
                }
            });
        });
    }

    function isValidpassword(password) {
        var pattern = new RegExp("^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$");
        return pattern.test(password);
    }

    // Password Minimum six characters, at least one uppercase letter, one lowercase letter, one number and one special character
    // https://stackoverflow.com/questions/19605150/regex-for-password-must-contain-at-least-eight-characters-at-least-one-number-a

</script>
<script>
    /*$(window).on('load', function () {
        setTimeout(function () {
            $('#exampleModal').modal('show');
        }, 2500);
    });*/
    function openSearch() {
        document.getElementById("search-overlay").style.display = "block";
    }

    function closeSearch() {
        document.getElementById("search-overlay").style.display = "none";
    }
</script>


<script type="text/javascript">

    $(window).scroll(function () {
        var sticky = $('.contnr_main_headr'),
            scroll = $(window).scrollTop();

        if (scroll >= 100) sticky.addClass('hedr_fixed');
        else sticky.removeClass('hedr_fixed');
    });
</script>

<script type="text/javascript">
    $(document).on("click", ".currency_change", function () {
        var currency_name = $(this).attr('data-currencyname');
        if (currency_name == 'SAR' || currency_name == 'USD') {
            if (currency_name != '') {
                $('#loading').show();
                $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url('ajax/currency_change'); ?>",
                    data: {currency_name: currency_name},
                    success: function (response) {
                        $('#loading').hide();
                        if (response != 0) {
                            window.location = "<?php echo current_url(); ?>";
                            // setTimeout(function(){ location.reload(); }, 2000)
                        }
                    }
                });
            }
        } else {
            swal("", "Please Select Currency", "warning");
        }

    });
</script>
<script type="text/javascript">
    $(document).on("submit", "#subscribe_form", function (e) {
        e.preventDefault();

        var sub_email = $("#sub_email").val();
        // alert(sub_email);
        var error = 1;

        if (sub_email == "") {
            swal("", "<?php echo lang('Please_enter_email'); ?>", "warning");
            error = 0;
            return false;
        }

        if (sub_email != '') {
            if (!isValidEmailAddress(sub_email)) {
                error = 0;
                swal("", "<?php echo lang('Please_Enter_Valid_Email_Id'); ?>", "warning");
                return false;
            }
        }

        if (error == 1) {
            $('#loading').show();
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('/ajax/newsletter_insert') ?>",
                data: {sub_email: sub_email},
                success: function (response) {
                    response = $.trim(response);
                    $('#loading').hide();
                    if (response == 'success') {
                        swal("", "<?php echo lang('Request_Send_Successfully'); ?>", 'success');
                        $('#subscribe_form')[0].reset();
                    } else if (response == 'email') {
                        swal("", "<?php echo lang('You_already_Subscribed_with_Us'); ?>", 'warning');
                    } else {
                        swal("", "<?php echo lang('Something'); ?>", 'warning');
                    }
                }
            });
        }
    });
</script>

<script type="text/javascript">
    $(document).on("click", ".add_to_cart2", function () {

        // $('#loading').show();
        var size_class = $(this).data('class');
        var unit_class = $(this).data('unit');
        var detail_qty = $(this).data('detislqty');
        // alert(detail_qty);
        // alert(size_class);
        // alert(unit_class);
        size_value = $('.' + size_class + '').val();
        var size_price = $('.' + size_class + '').find(':selected').attr('data-price');
        var unit_id = $('.' + unit_class + '').find(':selected').attr('data-id');
        // alert(unit_id);
        // return false;

        if (size_value == 0) {
            swal("", "Please Select Size", "warning");
            return false;
        }


        // var detail_qty=$(this).data('detislqty');
        // return false;
        if (typeof size_value !== 'undefined' && typeof size_price !== 'undefined') {
            size_value = size_value.split(' ').join('');
            size_value_g = size_value;
            size_price_g = parseFloat(size_price);
        } else {
            size_value_g = null;
            size_price_g = null;
        }
        // clear_data();
        var pid = $(this).data('id');
        if (detail_qty == 'detislqty') {
            qty_g = $('.' + detail_qty + '').val();
        } else {
            qty_g = detail_qty;
        }
        // alert(qty_g);
        // return false;
        add_to_cart(pid, qty_g, size_value_g, size_price_g, unit_id);
    });

    function add_to_cart(pid, qty, size_value_g, size_price_g, unit_id, pexid = '', pcxdata = '') {
        // alert(qty);
        $('#loading').show();
        var metadata = {};
        if (size_value_g === null && size_price_g === null) {
        } else {

            metadata[20] = size_value_g;
            metadata['price'] = size_price_g;
        }

        var m = 'm';
        var comment = '';
        var pid = $.trim(pid);
        if (pid != '') {
            append = m + pid;
        }
        if (pexid != '') {
            // append=append+pexdata;
            if (size_value_g === null && size_price_g === null) {
            } else {
                pexid = m + size_value_g + pexid;
            }
            pid2 = pexid;
        } else {
            pid2 = '';
            if (size_value_g === null && size_price_g === null) {
            } else {
                pid2 = m + size_value_g;
            }
        }
        if (pid !== '' && qty !== '') {

            $.ajax({
                type: 'POST',
                url: "<?php echo base_url($language . "/my_cart/add_to_cart") ?>",
                // data: {'pid':pid,'qty':qty,'metadata':metadata,'product_check':'product_check',append:append,pid2:pid2,pcxdata:pcxdata},
                data: {
                    'pid': pid,
                    'qty': qty,
                    'metadata': metadata,
                    pcxdata: pcxdata,
                    'unit': unit_id
                },
                success: function (response) {

                    $('#loading').hide();
                    var response = $.parseJSON(response);
                    if (response.status == true) {
                        view_cart_count();
                        swal("", "<?php echo lang('Product_Added_Successfully'); ?>", 'success');
                    } else if (response.message == 'login_message') {
                        login_swal();
                    } else if (response.message == 'founded') {
                        valss = swal("", "<?php echo lang('Already_Added_To_Cart'); ?>", "success");
                        url = "<?php echo base_url($language . '/home/view_cart'); ?>";
                        setTimeout(function () {
                            window.location = url;
                        }, 2000);
                    } else if (response.message == 'product_not_found') {
                        swal("", "<?php echo lang('Product_Not_Found'); ?>", 'warning');
                    } else if (response.message == 'quantity_not_avilable') {
                        swal("", "<?php echo lang('Not_Enough_Stock'); ?>", 'warning');
                    } else if (response.message == 'invalid_customize_id') {
                        swal("", "<?php echo lang('Something'); ?>", 'warning');
                        // setTimeout(function(){ location.reload(); }, 2000);
                    } else if (response.message == 'invalid_size') {
                        swal("", "<?php echo lang('Something'); ?>", 'warning');
                        // setTimeout(function(){ location.reload(); }, 2000);
                    } else if (response.message == 'min_order') {
                        swal("", response.message2, 'warning');
                        // setTimeout(function(){ location.reload(); }, 2000);
                    } else if (response.message == 'time_limit') {
                        swal("", "Shope close please order between Sun-Thu... 11.30AM -11.30PM Fri-Sat....... 8:30AM – 11:30PM ", 'warning');
                    } else if (response.message == 'quantity_notinstock') {
                        swal("", "<?php echo lang('Not_Enough_Stock'); ?>", 'warning');
                    } else {
                        swal("", "<?php echo lang('Something'); ?>", 'warning');
                    }
                }
            });
        } else {
            swal("", "<?php echo lang('Something'); ?>", 'warning');
        }
    }
</script>
<script type="text/javascript">
    function view_cart_count() {
        var count = '';
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url("my_cart/view_cart_count"); ?>",
            dataType: "json",
            success: function (response) {
                // alert(response);
                //return response;
                $(".minicart-qty").text(response.cart_count);
                $(".cart_price").text(response.cart_total);
            }
        });
    }
</script>

<script type="text/javascript">
    function move_to_wish_list(pid, flag = '') {
        $('#loading').show();
        // alert(pid);
        // return false;
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('/my_cart/add_to_wish_list') ?>",
            data: {pid: pid, is_wish: "1"},
            success: function (response) {
                if (response == '0') {
                    $('#loading').hide();
                    swal('', '<?php echo lang('Please_login_to_add_the_product_to_Wishlist'); ?>', 'warning');
                    // alert('login please');
                } else {
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('/my_cart/add_to_wish_list') ?>',
                        data: {pid: pid},
                        success: function (response) {
                            $('#loading').hide();
                            if (response == '0') {
                                swal("", "Error");
                            } else if (response == '1') {

                                swal("", "<?php echo lang('Successfully_added'); ?>", "success");

                                $(".wishlist" + pid).empty();
                                if (flag == '') {
                                    // app2='<a href="javascript:void(0)" id="add_wishlist" class="icon flaticon-favorite-heart-button" style="color:#ceaa4e;" onclick="remove_cart('+pid+')" ></a>';
                                    app2 = '<a href="javascript:void(0)" onclick="remove_cart(' + pid + ')" ><i class="ti-heart" aria-hidden="true"></i></a>';

                                } else {
                                    if (flag == 'view_cart') {
                                        app2 = '<a style="margin-right: 7px;" data-toggle="tooltip" title="Move To Wishlist" href="javascript:void(0)" class="icon" data-id="" onclick="remove_cart(' + pid + ',view_cart)"><img src="<?php echo base_url();?>assets/frontend/images/wish_icon.png" class="wishl_a_crt" ></a>';

                                    } else {
                                        app2 = '<button class="wishlist-btn" onclick="remove_cart(' + pid + ',detail)"> <img class="wisl_icn_as" src="<?php echo base_url();?>assets/frontend/images/wish_icon.png"> <span class="title-font">Added To WishList</span></button>';
                                    }
                                }
                                $(".wishlist" + pid).append(app2);
                                //setTimeout(function(){ /*location.reload();*/ }, 1300);
                            }
                        }
                    });
                }
            }
        });
    }

    function remove_cart(pid, flag = '') {
        $('#loading').show();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('/my_cart/add_to_wish_list') ?>',
            data: {pid: pid, is_wish: '1'},
            success: function (response) {
                $('#loading').hide();
                swal("", '<?php echo lang('Product_removed'); ?>', 'success');
                if (flag == '') {
                    $(".wishlist" + pid).empty();
                    app = '<a style="background:#343a40 !important"  href="javascript:void(0)" onclick="move_to_wish_list(' + pid + ')" ><i class="ti-heart" aria-hidden="true"></i></a>';
                    $(".wishlist" + pid).append(app);
                } else if (flag == 'detail') {
                    $(".wishlist" + pid).empty();
                    app = '<button class="wishlist-btn" onclick="move_to_wish_list(' + pid + ',detail)" > <img class="wisl_icn_as" src="<?php echo base_url();?>assets/frontend/images/wish_icon.png"> <span class="title-font">Add To WishList</span></button>';
                    $(".wishlist" + pid).append(app);
                } else if (flag == 'view_cart') {
                    $(".wishlist" + pid).empty();
                    app = '<a style="margin-right: 7px;" data-toggle="tooltip" title="Move To Wishlist" href="javascript:void(0)" class="icon" data-id="" onclick="move_to_wish_list(' + pid + ',view_cart)"><img src="<?php echo base_url();?>assets/frontend/images/wish_icon.png" class="wishl_a_crt" ></a>';
                    $(".wishlist" + pid).append(app);
                } else {
                    var row_count = $('.row_count').length;
                    if (row_count == 1) {
                        $(".hide_data").show();
                        $(".hide_cart_div").hide();
                    }
                    $(".remove_pro" + pid).remove();
                }
            }
        });
    }
</script>

<!-- witho out loign accessing checkout page  -->

<?php if ($this->session->flashdata('login_message')): ?>
    <script>
        swal({
                title: "",
                text: "<?php echo $this->session->flashdata('login_message'); ?>",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "<?php echo lang('OK'); ?>",
                cancelButtonText: "<?php echo lang('Cancel'); ?>",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function (inputValue) {
                if (inputValue === true) {
                    window.location = "<?php echo base_url($language . '/login'); ?>";
                }
            });
    </script>
<?php endif; ?>


<script type="text/javascript">
    $(document).on("change", "#seller_id2", function () {
        var vendor_id = $(this).val();
        if (vendor_id == 'abc') {

        } else {
            $('#loading').show();
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('ajax/get_product_id'); ?>",
                data: {vendor_id: vendor_id},
                success: function (response) {
                    $('#loading').hide();
                    response = $.trim(response);
                    var response = $.parseJSON(response);
                    if (response.status == true) {
                        g_seller_id = '';
                        $("#qpid").html(response.data);
                    } else {
                        swal("", response.message, "warning")
                    }
                }
            });
        }
    });
</script>

<script type="text/javascript">

    $(document).on("click", ".hselect_cat", function (e) {
        var cat_name = $(this).data('name');
        var cat_id = $(this).data('id');
        $("#hsearch_name").text(cat_name);
        ghcat_id = cat_id
        // m_catid
    });
    $(document).on("submit", "#form_search", function (e) {
        e.preventDefault();
        var search = $("#form_search_val").val();
        // var form_catid=$("#form_catid").val();
        // alert(form_catid);
        window.location.href = "<?php echo base_url($language . '/home/listing/?m_catid=')  ?>" + ghcat_id + '&search=' + search;

        // if(ghcat_id==0 ||ghcat_id=='')
        // {
        //   swal("","Please select category id","warning");
        //   return false;
        // }else{
        //   window.location.href = "<?php //echo base_url($language.'/home/listing/?m_catid=')  ?>"+ghcat_id+'&search='+search;
        // }

        // return false;
        // if(search=='')
        // {
        //   swal("","Please enter search value","warning");
        //   return false;
        // }

    });

    $(document).on("keyup", "#form_search_val", function () {
        var search_val = $(this).val();
        if (search_val != '') {
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('ajax/get_product_name'); ?>",
                data: {'search': search_val},
                success: function (response) {
                    response = $.trim(response);
                    var response = $.parseJSON(response);
                    if (response.status == true) {
                        $('#hspro_list').show();
                        $("#hspro_list").html(response.data);
                    } else {
                        $('#hspro_list').hide();
                    }
                }
            });
        }
    });

    $(document).on("click", ".search_name", function () {
        var product_name = $(this).data('name');
        $("#form_search_val").val(product_name);
        $('#hspro_list').hide();

    });
</script>

<script type="text/javascript">
    <?php if ($this->session->flashdata('common_message')): ?>
    swal("", "<?php echo $this->session->flashdata('common_message'); ?>", 'warning');
    <?php endif; ?>
</script>

<script type="text/javascript">
    <?php if ($this->session->flashdata('common_message_success')): ?>
    swal("", "<?php echo $this->session->flashdata('common_message_success'); ?>", 'success');
    <?php endif; ?>
</script>
<script type="text/javascript">
    function login_swal() {
        swal({
                title: "",
                text: "<?php echo lang('Please_login_or_create_account'); ?>",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "<?php echo lang('OK'); ?>",
                cancelButtonText: "<?php echo lang('Cancel'); ?>",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function (inputValue) {
                if (inputValue === true) {
                    window.location = "<?php echo base_url($language . '/login'); ?>";
                }
            });
    }
</script>

<script type="text/javascript">

    function remove_pic(id, name) {
        swal({
                title: "Are you sure?",
                text: "You want to remove this doc",
                type: "warning",
                showCancelButton: true,
                closeOnConfirm: false,
            },
            function () {
                // var image_gallery = jQuery('#image_gallery').val();
                image_gallery_g = image_gallery_g.replace(name, '');
                // jQuery('#image_gallery').val(image_gallery);
                jQuery('#pic' + id).remove();
                swal("<?php echo lang('Deleted'); ?>!", "Doc removed", "success");
            });
    }

</script>

<script>
    $(document).ready(function () {
        $(".cart_icon").click(function () {
            $('#loading').show();
            $.ajax({
                type: 'GET',
                url: "<?php echo base_url($language . '/home/car_data'); ?>",
                // data: {'data':search_val},
                success: function (response) {
                    $('#loading').hide();
                    response = $.trim(response);
                    var response = $.parseJSON(response);
                    if (response.status == true) {
                        $(".wrpa_slide_togl").addClass("wrpa_slide_togl_show");
                        $(".home-page").addClass("body_fix");
                        $('.wrpa_slide_toglright_3').show();
                        $(".wrpa_slide_toglright_2").html(response.message);
                        $('.ac_totalp').text(response.grand_total)
                    } else {
                        if (response.message_flag == 'cart_empty') {
                            $(".wrpa_slide_togl").addClass("wrpa_slide_togl_show");
                            $(".home-page").addClass("body_fix");
                            $('.wrpa_slide_toglright_3').hide();
                            $(".wrpa_slide_toglright_2").html(response.message);
                        } else if (response.message_flag == 'login') {
                            login_swal();
                        } else {
                            swal("", response.message, 'warning');
                        }
                    }
                }
            });
        });
    });

    $(document).ready(function () {
        $(".clos_cart").click(function () {
            $(".wrpa_slide_togl").removeClass("wrpa_slide_togl_show");
            $(".home-page").removeClass("body_fix");
        });
    });

    $(document).on('click', '.decrease2, .increase2', function (e) {
        var $this = $(e.target),
            input = $this.parent().find('.qty-input2'),
            v = $this.hasClass('decrease2') ? input.val() - 1 : input.val() * 1 + 1,
            min = input.attr('data-min') ? input.attr('data-min') : 1,
            max = input.attr('data-max') ? input.attr('data-max') : false;
        if (v >= min) {
            if (!max == false && v > max) {
                return false
            } else input.val(v);
        }
        e.preventDefault();
    });

    function productQty2(e) {
        var op = jQuery(e).attr("data-class");
        var target = jQuery(e).attr("data-target");
        //alert(target);
        var pid = jQuery(e).attr("data-product-id");
        qty = jQuery('#q' + target).val();

        var old_qty = qty;
        var newqty = qty;
        var sale_price = parseFloat(jQuery(e).attr('data-sale-value'));
        var status = true;
        var old_total = parseFloat(jQuery('.ac_totalp').text());
        if (op == 'decrease') {
            if (qty > 1) {
                qty--;
                newqty = -1;
            } else {
                status = false;
            }
        } else {
            qty++;
            newqty = qty;
        }
        if (status) {
            $('#loading').show();
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('my_cart/updat_cart') ?>",
                data: {pid: pid, qty: newqty, append: target},
                success: function (response) {
                    $('#loading').hide();
                    // alert(response);
                    // return false;
                    var response = $.parseJSON(response);
                    if (response.message == 'quantity_not_avilable') {
                        swal("", "<?php echo lang('Not_Enough_Stock'); ?>", 'warning');
                        if (newqty == -1) {
                            $("#q" + target).val(qty - newqty);
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        } else {
                            $("#q" + target).val(newqty - 1);
                        }

                    } else if (response.message == 'time_limit') {
                        swal("", "Shope close please order between Sun-Thu... 11.30AM -11.30PM Fri-Sat....... 8:30AM – 11:30PM ", 'warning');
                    } else if (response.message == 'not_added_tocart') {
                        swal("", "Product not found", 'warning');
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    } else if (response.message == 'product_deactive') {
                        swal("", "This product is deactivated by admin it will remove form cart", 'warning');
                        setTimeout(function () {
                            remove_ok(target);
                        }, 2000);
                    } else if (response.message == 'min_order') {
                        $("#q" + target).val(old_qty);
                        swal("", response.message2, 'warning');
                        // setTimeout(function(){ location.reload(); }, 2000);
                    } else {
                        jQuery('#q' + target).val(qty);
                        jQuery('#qty' + target).text(qty);
                        single_total = qty * sale_price;
                        jQuery('#ac_singlep' + target).text(single_total.toFixed(2));

                        if (op == 'decrease') {
                            total = old_total - sale_price;
                            jQuery('.ac_totalp').text(total.toFixed(2));
                        } else {
                            total = old_total + sale_price;
                            jQuery('.ac_totalp').text(total.toFixed(2));
                        }
                    }
                }
            });
        }
    }


    $(document).on("click", ".deletitem_nav", function () {
        var pid = $(this).data("id");
        swal({
                title: "",
                text: "<?php echo lang('Do_You_Want_To_Delete_This_Product_From_Car'); ?>",
                type: "warning",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
                confirmButtonText: "<?php echo lang('Yes'); ?>",
                cancelButtonText: "<?php echo lang('Cancel'); ?>",
            },
            function () {
                $('#loading').show();
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url('my_cart/remove_from_cart'); ?>',
                    data: {pid: pid},
                    success: function (response) {
                        $('#loading').hide();
                        if (response == 'some') {
                            swal("", "<?php echo lang('Something'); ?>");
                        } else {
                            var data = $.parseJSON(response);
                            var pro_count = data['pro_count'];
                            product_price = parseFloat(jQuery('#ac_singlep' + pid).text());
                            total = parseFloat(jQuery('.ac_totalp').text());

                            if (pro_count == 0) {
                                swal("<?php echo lang('Deleted'); ?>", "<?php echo lang('Product_Deleted_Successfully'); ?>", "success");
                                $(".remove_pro2" + pid).remove();
                                $(".wrpa_slide_togl").addClass("wrpa_slide_togl_show");
                                $(".home-page").addClass("body_fix");
                                $('.wrpa_slide_toglright_3').hide();
                                $(".wrpa_slide_toglright_2").html('<h2 class="ac_empty"><?php echo lang('YOUR_SHOPPING_CART_IS_EMPTY'); ?></h2>');
                            } else {
                                total = total - product_price;
                                jQuery('.ac_totalp').text(total.toFixed(2));
                                swal("<?php echo lang('Deleted'); ?>", "<?php echo lang('Product_Deleted_Successfully'); ?>", "success");
                                $(".remove_pro2" + pid).remove();
                            }
                        }
                    }
                });

            });
    });

    $(document).on("click", ".compare_ck", function () {
        var pid = $(this).val();
        thisa = $(this);
        // console.log(thisa);
        if ($(this).prop('checked') == true) {
            add_remove_compare(pid, 'add', thisa);
        } else {
            add_remove_compare(pid, 'remove', thisa);
        }
    });

    function add_remove_compare(pid, type, thisa, page = '') {
        $('#loading').show();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url($language . '/my_cart/add_to_compere') ?>',
            data: {pid: pid, type: type},
            success: function (response) {
                $('#loading').hide();
                response = $.trim(response);
                var response = $.parseJSON(response);
                if (response.status == true) {
                    if (page == 'compare' && type == 'remove') {
                        $(".hide_compare" + pid).remove();
                        if (response.compare_count == 0) {
                            $(".show_compare").show();
                        }
                    }
                    $('.compr_count').text(response.compare_count);
                    swal("", response.message, "success");
                } else if (response.status == false) {
                    if (page == '') {
                        thisa.prop('checked', false);
                    }
                    swal("", response.message, "warning");
                } else {
                    swal("", "<?php echo lang('Something'); ?>", "warning");
                }
            }
        });
    }
</script>


</body>
</html>
