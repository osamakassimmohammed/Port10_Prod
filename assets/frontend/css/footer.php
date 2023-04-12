<script type="text/javascript">
  var g_seller_id = '';
  var image_gallery_g = '';
  var index_g = 1;
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
                <h4>KNOW IT ALL FIRST!</h4>
                <p>Never Miss Anything From Port10 By Signing Up To Our Newsletter.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <form action="" class="form-inline subscribe-form auth-form needs-validation" method="post"
              id="subscribe_form">
              <div class="form-group mx-sm-3">
                <input type="text" class="form-control" name="EMAIL" id="sub_email" placeholder="Enter your email">
              </div>
              <button type="submit" class="btn btn-solid" id="">subscribe</button>
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
          <div class="sub-title">
            <div class="footer-title">
              <h4>About Port10</h4>
            </div>
            <div class="footer-contant">
              <ul>
                <li><a href="<?php echo base_url($language . '/page/index/about') ?>">About</a></li>
                <li><a href="<?php echo base_url($language . '/page/index/privacy-policy') ?>">Privacy Policy</a></li>
                <li><a href="<?php echo base_url($language . '/page/index/terms-of-service') ?>">Terms Of Service</a>
                </li>
                <li><a href="<?Php echo base_url($language . '/contact_us'); ?>">contacts</a></li>
              </ul>
            </div>
          </div>
          <br><br>
          <div class="sub-title">
            <div class="footer-title">
              <h4>Support</h4>
            </div>
            <div class="footer-contant">
              <ul>
                <li><a href="<?php echo base_url($language . '/blog') ?>">Resources / Help</a></li>
              </ul>
            </div>
          </div>
          <br><br>
          <div class="sub-title">
            <div class="footer-title">
              <h4>Signup on Port10</h4>
            </div>
            <div class="footer-contant">
              <ul>
                <li><a href="<?php echo base_url($language . '/register') ?>">Register</a></li>
              </ul>
            </div>
          </div>

        </div>
        <div class="col">
          <div class="sub-title">
            <div class="footer-title">
              <h4>Buy On Port10</h4>
            </div>
            <div class="footer-contant">
              <ul>
                <li><a href="<?php echo base_url($language . '/home/listing/1') ?>">Food & Beverage</a></li>
                <li><a href="<?php echo base_url($language . '/home/listing/40') ?>">Electronics</a></li>
                <li><a href="<?php echo base_url($language . '/home/listing/49') ?>">Toys & Gifts</a></li>
                <li><a href="<?php echo base_url($language . '/home/listing/63') ?>">Body & Beauty</a></li>
                <li><a href="<?php echo base_url($language . '/home/listing/70') ?>">Construction & Commercial
                    Equipment</a></li>
                <li><a href="<?php echo base_url($language . '/home/listing/82') ?>"> Metals, Chemicals & Raw
                    Materials</a></li>
                <li><a href="<?php echo base_url($language . '/home/listing/99') ?>"> Paper and Packaging</a></li>
                <li><a href="<?php echo base_url($language . '/home/listing/110') ?>"> Automotive - Support
                    Resources</a>
                </li>
                <li><a href="<?php echo base_url($language . '/help') ?>"> Help</a></li>

              </ul>
            </div>
          </div>
        </div>
        <div class="col">



          <div class="sub-title">
            <div class="footer-title">
              <h4>our address</h4>
            </div>
            <div class="footer-contant">
              <ul class="contact-list">
                <li><i class="fa fa-map-marker"></i>
                  <?php echo @$footer_content[0]['location']; ?>
                </li>
                <li><i class="fa fa-phone"></i>Call Us: <a
                    href="tel:<?php echo @$footer_content[0]['mobile_no']; ?>"><?php echo @$footer_content[0]['mobile_no']; ?></a></li>
                <li><i class="fa fa-envelope-o"></i>Email Us: <a
                    href="mailto:<?php echo @$footer_content[0]['email_id']; ?>"><?php echo @$footer_content[0]['email_id']; ?></a></li>
              </ul>
            </div>
          </div>
        </div>

        <div class="col">

          <div class=" footer_socl_logo">
            <div class="footer-title footer-mobile-title">
              <h4>about</h4>
            </div>
            <div class="footer-contant">
              <div class="footer-logo"><img src="http://port10.persausive.in/assets/frontend/images/icon/foot_logo.png"
                  alt=""></div>
              <p> </p>
              <div class="footer-social">
                <ul>
                  <li><a href="https://www.facebook.com"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                  <li><a href="https://www.youtube.com/"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                  <li><a href="https://twitter.com"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                  <li><a href="https://www.linkedin.com/"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                </ul>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
  <div class="sub-footer">
    <div class="container">
      <div class="row">
        <div class="col-xl-6 col-md-6 col-sm-12">
          <div class="footer-end">
            <p><i class="fa fa-copyright" aria-hidden="true"></i> 2021 All rights reserved <a
                href="<?php echo base_url($language . '/page/index/privacy-policy') ?>">Privacy Policy</a> <a
                href="<?php echo base_url($language . '/page/index/terms-of-service') ?>">Terms and Conditions</a>
            </p>
          </div>
        </div>
        <div class="col-xl-6 col-md-6 col-sm-12">
          <div class="payment-card-bottom">
            <p><span>CR Number :
                <?php echo @$footer_content[0]['cr_number']; ?>
              </span> <span>VAT Number :
                <?php echo @$footer_content[0]['vat_number']; ?>
              </span></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- footer end -->
<!--modal popup start-->
<div class="modal fade bd-example-modal-lg theme-modal" id="exampleModal" tabindex="-1" role="dialog"
  aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body modal1">
        <div class="container-fluid p-0">
          <div class="row">
            <div class="col-12">
              <div class="modal-bg">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
                <div class="offer-content">
                  <img src="<?php echo base_url(); ?>assets/frontend/images/Offer-banner.png"
                    class="img-fluid blur-up lazyload" alt="">
                  <h2>newsletter</h2>
                  <form action="" class="auth-form needs-validation" method="post" id="">
                    <div class="form-group mx-sm-3">
                      <input type="text" class="form-control" name="EMAIL" id="" placeholder="Enter your email">
                      <button type="submit" class="btn btn-solid" id="">subscribe</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--modal popup end-->
<!-- Quick-view modal popup start-->
<div class="modal fade bd-example-modal-lg theme-modal" id="quick-view" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content quick-view-modal">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
        <div class="row">
          <div class="col-lg-6 col-xs-12">
            <div class="quick-view-img"><img src="<?php echo base_url(); ?>assets/frontend/images/pro3/1.jpg" alt=""
                class="img-fluid blur-up lazyload"></div>
          </div>
          <div class="col-lg-6 rtl-text">
            <div class="product-right">
              <h2>Women Pink Shirt</h2>
              <h3>$32.96</h3>
              <ul class="color-variant">
                <li class="bg-light0"></li>
                <li class="bg-light1"></li>
                <li class="bg-light2"></li>
              </ul>
              <div class="border-product">
                <h6 class="product-title">product details</h6>
                <p>Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium
                  doloremque laudantium
                </p>
              </div>
              <div class="product-description border-product">
                <div class="size-box">
                  <ul>
                    <li class="active"><a href="#">s</a></li>
                    <li><a href="#">m</a></li>
                    <li><a href="#">l</a></li>
                    <li><a href="#">xl</a></li>
                  </ul>
                </div>
                <h6 class="product-title">quantity</h6>
                <div class="qty-box">
                  <div class="input-group"><span class="input-group-prepend"><button type="button"
                        class="btn quantity-left-minus" data-type="minus" data-field=""><i
                          class="ti-angle-left"></i></button> </span>
                    <input type="text" name="quantity" class="form-control input-number" value="1"> <span
                      class="input-group-prepend"><button type="button" class="btn quantity-right-plus" data-type="plus"
                        data-field=""><i class="ti-angle-right"></i></button></span>
                  </div>
                </div>
              </div>
              <div class="product-buttons"><a href="#" class="btn btn-solid">add to cart</a> <a href="#"
                  class="btn btn-solid">view detail</a></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Quick-view modal popup end-->
<!-- theme setting -->

<div class="modal fade" id="quotation" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title">Request for Quotation</h4>

        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form id="send_quotation" action="" method="post" enctype="multipart/form-data">
          <div class="form_wrap_qutn">

            <div class="signl_form">
              <div class="singl_label"> Product Name </div>
              <input type="text" class="singl_input_qutn" name="product_name" id="qproduct_name">
            </div>

            <div class="signl_form">
              <div class="singl_label"> Product Group </div>
              <select class="singl_input_qutn" name="category_id" id="qcategory_id">
                <option value="0">Please Select Group</option>
                <?php if (!empty($main_category)) {
                  foreach ($main_category as $mc_key => $mc_val) { ?>
                    <option value="<?php echo $mc_val['id']; ?>"><?php echo $mc_val['display_name']; ?></option>
                  <?php }
                } ?>
              </select>
            </div>
            <div class="signl_form">
              <div class="singl_label"> To </div>
              <input type="text" class="singl_input_qutn" name="" id="seller_id" autocomplete="off">
            </div>
            <div id="hsven_list" style="display: none;margin-left: 510px !important">fadsf dfasdf</div>

            <div class="signl_form">
              <div class="singl_label"> Purchase Cycle </div>
              <div class="prch_cycl">

                <label>
                  <input name="purchase_cycle" type="radio" value="one time"> <span> One Time </span>
                </label>

                <label>
                  <input name="purchase_cycle" type="radio" value="continuous"> <span> Continuous </span>
                </label>

                <div class="clear"></div>
              </div>
            </div>

            <div class="signl_form">
              <div class="singl_label"> Customization </div>
              <div class="prch_cycl">

                <label>
                  <input name="customiz" type="radio" value="yes"> <span> Yes </span>
                </label>

                <label>
                  <input name="customiz" type="radio" value="no"> <span> No </span>
                </label>

                <div class="clear"></div>
              </div>
            </div>

            <div class="clear"></div>

            <div class="signl_form">
              <div class="singl_label"> Deadline for Submission </div>
              <input type="text" class="singl_input_qutn" id="qdeadline" name="deadline" autocomplete="off">
            </div>

            <div class="signl_form">
              <div class="singl_label"> Product No./SKU </div>
              <input type="text" class="singl_input_qutn" name="pid" id="qpid">
              <!-- <select class="singl_input_qutn" id="qpid" name="pid" >                    
                    <option value="0">Please select Product No./SKU</option>
                  </select> -->
              <!-- <input type="text" class="singl_input_qutn" name="pid" id="qpid"> -->
            </div>

            <div class="signl_form">
              <div class="singl_label"> HS Code </div>
              <input type="text" class="singl_input_qutn" name="hscode" id="qhscode">
            </div>

            <div class="signl_form">
              <div class="singl_label"> Unit </div>
              <select class="singl_input_qutn" id="qunit" name="unit">
                <option value="0">Please Select Unit</option>
                <?php if (!empty($funit_list_data)) {
                  foreach ($funit_list_data as $fud_key => $fud_val) { ?>
                    <option value="<?php echo $fud_val['id']; ?>"><?php echo $fud_val['unit_name']; ?></option>
                  <?php }
                } ?>
              </select>
            </div>

            <div class="signl_form">
              <div class="singl_label"> Quantity </div>
              <input type="text" class="singl_input_qutn" name="qty" id="qqty">
            </div>


            <div class="signl_form">
              <div class="singl_label"> Destination
                <a href="javascript:void(0)" class="gps_box_a" data-toggle="tooltip" title="GPS">
                  <i class="fa fa-location-arrow" aria-hidden="true"></i>
                </a>
                <div class="clear"></div>
              </div>
              <input type="text" class="singl_input_qutn searchInput" id="paddress" name="address">
            </div>
            <div class="signl_form">
              <div class="singl_label"> Google location <i class="fa fa-info-circle" aria-hidden="true"
                  data-toggle="tooltip" data-placement="top"
                  title="In case of delivery to specific destination, enter coordinates."></i> </div>
              <input type="text" class="singl_input_qutn" id="searchInput2" name="delivery_date">
            </div>
            <input type="hidden" name="lat" id="lat2" value="">
            <input type="hidden" name="lng" id="lng2" value="">
            <div class="signl_form">
              <div class="singl_label"> Delivery Date </div>
              <input type="text" class="singl_input_qutn" id="qdelivery_date" name="delivery_date" autocomplete="off">
            </div>

            <div class="signl_form">
              <div class="singl_label"> Incoterms </div>
              <select class="singl_input_qutn" id="qincoterms" name="incoterms">
                <option> CFR </option>
                <option> CIF </option>
                <option> CIP </option>
                <option> CPT </option>
                <option> DAT </option>
                <option> DAP </option>
                <option> DDP </option>
                <option> FCA </option>
                <option> FAS </option>
                <option> FOB </option>
                <option> EXW </option>
              </select>
            </div>

            <div class="signl_form">
              <div class="singl_label"> Certification </div>

              <div class="prch_cycl">

                <label>
                  <input name="certification" type="radio" id="qcertification" value="yes"> <span> Yes </span>
                </label>

                <label>
                  <input name="certification" type="radio" id="qcertification2" value="no"> <span> No </span>
                </label>

                <div class="clear"></div>
              </div>

            </div>

            <div class="signl_form signl_form_full">
              <div class="singl_label"> Information </div>
              <textarea class="singl_input_qutn" rows="5" style="height: auto;" id="qinformation"
                name="information"></textarea>
            </div>

            <div class="signl_form signl_form_full">
              <div class="singl_label" style="text-align: right; padding-right: 85px;"> Attachments </div>


              <div class="uplod_garg_pics">


                <div class="thum_view prepend_img">
                </div>

                <div class="upld_pic_labl">
                  <input type="file" id="qimg" class="image_check">
                  <div class="ad_grg_pic_titl"> Upload</div>
                </div>

              </div>
              <button type="submit" class="btn btn-solid">Send</button>
            </div>





            <div class="clear"></div>
          </div>
        </form>

      </div>

    </div>

  </div>
</div>




<div id="setting_box" class="setting-box" style="display: none !important;">
  <div class="setting_box_body">
    <div class="setting-body">
      <div class="setting-contant">
        <ul class="color-box">
          <li>
            <input id="ColorPicker1" type="color" value="#ff4c3b" name="Background">
            <span>theme deafult color</span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

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
<script src="<?php echo base_url(); ?>assets/frontend/js/bootstrap-notify.min.js"></script>
<!-- Fly cart js-->
<script src="<?php echo base_url(); ?>assets/frontend/js/fly-cart.js"></script>
<!-- Theme js-->


<!-- Zoom js-->
<script src="<?php echo base_url(); ?>assets/frontend/js/jquery.elevatezoom.js"></script>
<script src="<?php echo base_url(); ?>assets/frontend/js/sweetalert.min.js"></script>
<link href="<?php echo base_url(); ?>assets/frontend/css/sweetalert.css" rel="stylesheet">


<script src="<?php echo base_url(); ?>assets/frontend/js/script.js"></script>
<script src="<?php echo base_url(); ?>assets/frontend/js/wow.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $(function () {
    $("#qdeadline").datepicker({ dateFormat: 'dd-mm-yy' });
    $("#qdelivery_date").datepicker({ dateFormat: 'dd-mm-yy' });
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
          data: { currency_name: currency_name },
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
      swal("", "Please Enter Email Id", "warning");
      error = 0;
      return false;
    }

    if (sub_email != '') {
      if (!isValidEmailAddress(sub_email)) {
        error = 0;
        swal("", "Please Enter Valid Email Id", "warning");
        return false;
      }
    }

    if (error == 1) {
      $('#loading').show();
      $.ajax({
        type: 'POST',
        url: "<?php echo base_url('/ajax/newsletter_insert') ?>",
        data: { sub_email: sub_email },
        success: function (response) {
          response = $.trim(response);
          $('#loading').hide();
          if (response == 'success') {
            swal("", "Request Send Successfully", 'success');
            $('#subscribe_form')[0].reset();
          } else if (response == 'email') {
            swal("", "You already Subscribed with Us.!!", 'warning');
          }
          else {
            swal("", "Something Went Wrong", 'warning');
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
      size_value_g = null; size_price_g = null;
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
    if (size_value_g === null && size_price_g === null) { } else {

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
      if (size_value_g === null && size_price_g === null) { } else {
        pexid = m + size_value_g + pexid;
      }
      pid2 = pexid;
    } else {
      pid2 = '';
      if (size_value_g === null && size_price_g === null) { } else {
        pid2 = m + size_value_g;
      }
    }
    if (pid !== '' && qty !== '') {

      $.ajax({
        type: 'POST',
        url: "<?php echo base_url("my_cart/add_to_cart") ?>",
        // data: {'pid':pid,'qty':qty,'metadata':metadata,'product_check':'product_check',append:append,pid2:pid2,pcxdata:pcxdata},
        data: { 'pid': pid, 'qty': qty, 'metadata': metadata, pcxdata: pcxdata, 'unit': unit_id },
        success: function (response) {

          $('#loading').hide();
          var response = $.parseJSON(response);
          if (response.status == true) {
            view_cart_count();
            swal("", "Product Added Successfully", 'success');
          } else if (response.message == 'founded') {
            valss = swal("", "Already Added To Cart", "success");
            url = "<?php echo base_url('home/view_cart'); ?>";
            setTimeout(function () { window.location = url; }, 2000);
          } else if (response.message == 'product_not_found') {
            swal("", "Product not found", 'warning');
          } else if (response.message == 'quantity_not_avilable') {
            swal("", "Not Enough Stock To Add Quantity", 'warning');
          } else if (response.message == 'invalid_customize_id') {
            swal("", "Something went wrong", 'warning');
            // setTimeout(function(){ location.reload(); }, 2000);
          } else if (response.message == 'invalid_size') {
            swal("", "Something went wrong", 'warning');
            // setTimeout(function(){ location.reload(); }, 2000);
          } else if (response.message == 'min_order') {
            swal("", response.message2, 'warning');
            // setTimeout(function(){ location.reload(); }, 2000);
          }
          else if (response.message == 'time_limit') {
            swal("", "Shope close please order between Sun-Thu... 11.30AM -11.30PM Fri-Sat....... 8:30AM – 11:30PM ", 'warning');
          } else if (response.message == 'quantity_notinstock') {
            swal("", "Not Enough Stock To Add Quantity", 'warning');
          }
          else {
            swal("", "Something went wrong", 'warning');
          }
        }
      });
    } else {
      swal("", "Something went wrong", 'warning');
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
      data: { pid: pid, is_wish: "1" },
      success: function (response) {
        if (response == '0') {
          $('#loading').hide();
          swal('', 'Please log in to add the product to Wishlist!', 'warning');
          // alert('login please');
        }
        else {
          $.ajax({
            type: 'POST',
            url: '<?php echo base_url('/my_cart/add_to_wish_list') ?>',
            data: { pid: pid },
            success: function (response) {
              $('#loading').hide();
              if (response == '0') {
                swal("", "Error");
              }
              else if (response == '1') {

                swal("", "Successfully added", "success");

                $(".wishlist" + pid).empty();
                if (flag == '') {
                  // app2='<a href="javascript:void(0)" id="add_wishlist" class="icon flaticon-favorite-heart-button" style="color:#ceaa4e;" onclick="remove_cart('+pid+')" ></a>';  
                  app2 = '<a href="javascript:void(0)" onclick="remove_cart(' + pid + ')" ><i class="ti-heart" aria-hidden="true"></i></a>';

                } else {
                  if (flag == 'view_cart') {
                    app2 = '<a style="margin-right: 7px;" data-toggle="tooltip" title="Move To Wishlist" href="javascript:void(0)" class="icon" data-id="" onclick="remove_cart(' + pid + ',view_cart)"><img src="<?php echo base_url(); ?>assets/frontend/images/wish_icon.png" class="wishl_a_crt" ></a>';

                  } else {
                    app2 = '<button class="wishlist-btn" onclick="remove_cart(' + pid + ',detail)"> <img class="wisl_icn_as" src="<?php echo base_url(); ?>assets/frontend/images/wish_icon.png"> <span class="title-font">Added To WishList</span></button>';
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
      data: { pid: pid, is_wish: '1' },
      success: function (response) {
        $('#loading').hide();
        swal("", 'Product removed', 'success');
        if (flag == '') {
          $(".wishlist" + pid).empty();
          app = '<a style="background:#343a40 !important"  href="javascript:void(0)" onclick="move_to_wish_list(' + pid + ')" ><i class="ti-heart" aria-hidden="true"></i></a>';
          $(".wishlist" + pid).append(app);
        } else if (flag == 'detail') {
          $(".wishlist" + pid).empty();
          app = '<button class="wishlist-btn" onclick="move_to_wish_list(' + pid + ',detail)" > <img class="wisl_icn_as" src="<?php echo base_url(); ?>assets/frontend/images/wish_icon.png"> <span class="title-font">Add To WishList</span></button>';
          $(".wishlist" + pid).append(app);
        } else if (flag == 'view_cart') {
          $(".wishlist" + pid).empty();
          app = '<a style="margin-right: 7px;" data-toggle="tooltip" title="Move To Wishlist" href="javascript:void(0)" class="icon" data-id="" onclick="move_to_wish_list(' + pid + ',view_cart)"><img src="<?php echo base_url(); ?>assets/frontend/images/wish_icon.png" class="wishl_a_crt" ></a>';
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
      confirmButtonText: "OK",
      ancelButtonText: "Cancel",
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
  $(document).on("click", ".login_check", function () {
    $('#loading').show();
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url($language . '/ajax/login_check') ?>',
      data: { is_user: "user" },
      success: function (response) {
        $('#loading').hide();
        response = $.trim(response);
        if (response == 1) {
          index_g = '';
          image_gallery_g = '';
          $(".prepend_img").empty();
          $('#quotation').modal('show');
          initMap2();
        } else {
          swal({
            title: "",
            text: "Please Login Or Create Account!!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "OK",
            ancelButtonText: "Cancel",
            closeOnConfirm: true,
            closeOnCancel: true
          },
            function (inputValue) {
              if (inputValue === true) {
                window.location = "<?php echo base_url($language . '/login'); ?>";
              }
            });
        }
      }
    });
  });


  // function readURL(input) {
  //   if (input.files && input.files[0]) {
  //       var reader = new FileReader();
  //       reader.onload = function(e) {
  //           $('#img-quotation').attr('src', e.target.result);
  //       };
  //       reader.readAsDataURL(input.files[0]);
  //   }
  // }

  // $("#qimg").change(function() {
  //   readURL(this);
  // });

  $(document).on("submit", "#send_quotation", function (e) {
    e.preventDefault();

    var seller_id = $("#seller_id").val();
    var qproduct_name = $("#qproduct_name").val();
    var qcategory_id = $("#qcategory_id").val();
    var purchase_cycle = $('input[name=purchase_cycle]:checked').val();
    var customiz = $('input[name=customiz]:checked').val();
    var qdeadline = $("#qdeadline").val();
    var qpid = $("#qpid").val();
    var qhscode = $("#qhscode").val();
    var qunit = $("#qunit").val();
    var qqty = $("#qqty").val();
    var paddress = $("#paddress").val();
    var qdelivery_date = $("#qdelivery_date").val();
    var qincoterms = $("#qincoterms").val();
    var certification = $('input[name=certification]:checked').val();
    var qinformation = $("#qinformation").val();
    var searchInput2 = $("#searchInput2").val();
    var lat2 = $("#lat2").val();
    var lng2 = $("#lng2").val();
    var error = 1;


    if (seller_id == '') {
      error = 0;
      swal("", "Please select/enter vendor name", "warning");
      return false;
    }

    if (g_seller_id == '') {
      error = 0;
      swal("", "Please select/enter vendor name", "warning");
      return false;
    }


    if (qproduct_name == '') {
      error = 0;
      swal("", "Please enter product name", "warning");
      return false;
    }

    if (qcategory_id == '' || qcategory_id == 0) {
      error = 0;
      swal("", "Please select product group", "warning");
      return false;
    }

    if (typeof purchase_cycle === "undefined") {
      swal("", "Please select purchase cycle", "warning");
      error = 0;
      return false;
    }

    if (typeof customiz === "undefined") {
      swal("", "Please select customization", "warning");
      error = 0;
      return false;
    }

    if (qdeadline == '') {
      error = 0;
      swal("", "Please enter deadline for submission", "warning");
      return false;
    }

    if (qpid == '0') {
      error = 0;
      swal("", "Please select product No./ SKU", "warning");
      return false;
    }

    if (qunit == '' || qunit == 0) {
      error = 0;
      swal("", "Please select unit", "warning");
      return false;
    }

    if (qqty == '') {
      error = 0;
      swal("", "Please enter quantity", "warning");
      return false;
    }

    if (paddress == '') {
      error = 0;
      swal("", "Please enter destination", "warning");
      return false;
    }

    if (searchInput2 != '') {
      if (lat2 == '' || lng2 == '') {
        error = 0;
        swal("", "Please select perfect google address", "warning");
        return false;
      }
    }
    if (qdelivery_date == '') {
      error = 0;
      swal("", "Please enter delivery date", "warning");
      return false;
    }

    if (typeof certification === "undefined") {
      swal("", "Please select Certification", "warning");
      error = 0;
      return false;
    }

    if (qinformation == '') {
      error = 0;
      swal("", "Please enter Information", "warning");
      return false;
    }


    if (error == 1) {
      // alert('success');
      // return false;
      fd = new FormData(this);
      fd.append("seller_id", g_seller_id);
      fd.append("document", image_gallery_g);
      fd.append("google_address", searchInput2);
      fd.append("lat", lat2);
      fd.append("lng", lng2);
      $('#loading').show();
      $.ajax({
        type: 'POST',
        url: "<?php echo base_url('ajax/send_quotation'); ?>",
        // data: new FormData(this),
        data: fd,
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {
          $('#loading').hide();
          response = $.trim(response);
          if (response == 1) {
            index_g = '';
            image_gallery_g = '';
            $(".prepend_img").empty();
            $('#quotation').modal('hide');
            $('#img-quotation').attr('src', "");
            $("#send_quotation")[0].reset();
            swal("Quotation Request Send successfully", "Vender/admin will Contact you soon.", "success");
          } else if (response == "login") {
            swal("", "Please login or create account.!!", "warning");
          } else if (response == "invalid_pro") {
            swal("", "Please enter valid Product No./SKU", "warning");
          } else {
            swal("", "Something went wrong", "warning");
          }
        }
      });
    }

  });

  $(document).on("keyup", "#seller_id", function () {
    var search_val = $(this).val();
    if (search_val != '') {
      $.ajax({
        type: 'POST',
        url: "<?php echo base_url('ajax/get_vender_name'); ?>",
        data: { 'search': search_val },
        success: function (response) {
          response = $.trim(response);
          var response = $.parseJSON(response);
          if (response.status == true) {
            $('#hsven_list').show();
            $("#hsven_list").html(response.data);
          } else {
            $('#hsven_list').hide();
          }
        }
      });
    }
  });

  $(document).on("click", ".vendor_name", function () {
    var id = $(this).data('id');
    g_seller_id = id;
    var name = $(this).text();
    $("#seller_id").val(name);
    $('#hsven_list').hide();
  });
</script>

<script type="text/javascript">
  $(document).on("change", "#seller_id2", function () {
    var vendor_id = $(this).val();
    if (vendor_id == 'abc') {

    } else {
      $('#loading').show();
      $.ajax({
        type: 'POST',
        url: "<?php echo base_url('ajax/get_product_id'); ?>",
        data: { vendor_id: vendor_id },
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
  $(document).on("submit", "#form_search", function () {
    var search = $("#form_search_val").val();
    var form_catid = $("#form_catid").val();

    if (search == '') {
      swal("", "Please enter search value", "warning");
      return false;
    }

  });

  $(document).on("keyup", "#form_search_val", function () {
    var search_val = $(this).val();
    if (search_val != '') {
      $.ajax({
        type: 'POST',
        url: "<?php echo base_url('ajax/get_product_name'); ?>",
        data: { 'search': search_val },
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
      text: "Please login or create account",
      type: "warning",
      showCancelButton: true,
      confirmButtonText: "Ok",
      ancelButtonText: "Cancel",
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

  $(document).on("change", ".image_check", function () {
    var class_name = $(this).data("class");
    // file = this.files[0];
    files = this.files;
    if (files.length > 0) {
      for (i = 0; i < files.length; i++) {
        maxSize = 2048;
        var imagefile = files[i].type;
        file_tp = imagefile.slice(-3);
        var imagesize = files[i].size;
        imagesize = Math.round((imagesize / 1024));
        var match = ["image/jpeg", "image/png", "image/jpg", "application/pdf", "application/vnd.openxmlformats-officedocument.wordprocessingml.document"];
        if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]) || (imagefile == match[3]) || (imagefile == match[4]))) {
          // swal("",'Please select a valid image file (JPEG/JPG/PNG).');
          alert("Please select a valid image file (JPEG/JPG/PNG)");
          // $(".image_check").val('');
          return false;
        } else if (imagesize > maxSize) {
          swal("", "File should be less than 2 mb", "warning");
          return false;
        } else {
          image_gallery_arr = image_gallery_g.split(',');
          // alert(image_gallery_arr.length);
          if (image_gallery_arr.length > 24) {
            swal("", "You can upload only 24 cars", "warning");
            return false;
          }
          // readURL(this,class_name);
          // file =jQuery("#file")[0];
          fd = new FormData();
          // console.log(this.files.length);
          // console.log(this.files);
          // return false;
          individual_capt = "Quotation image";
          fd.append("caption", individual_capt);
          fd.append('action', 'fiu_upload_file');
          fd.append("file", this.files[i]);
          fd.append("path", 'admin/inquiry_doc/');
          fd.append("count", i + 1);
          $("#loading").show();
          jQuery.ajax({
            type: 'POST',
            url: 'file_handling/uploadFiless',
            data: fd,
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
              $("#loading").hide();
              if (response == "false") {
                swal("", "Something went wrong, Please try again...", "warning");
              } else {

                // jQuery('[data-image]').attr('src', img);
                // var images = jQuery('#image_gallery').val();
                // var index = jQuery('#index').val();
                // alert(response);
                if (image_gallery_g == '') {
                  image_gallery_g = response;
                } else {
                  image_gallery_g = image_gallery_g + ',' + response;
                }
                image_gallery_arr = image_gallery_g.split(',');

                // alert(image_gallery_arr.length);
                if (file_tp == 'pdf') {
                  var path = '<?php echo base_url("assets/frontend/images/"); ?>pdf.png';
                } else if (file_tp == 'ent') {
                  var path = '<?php echo base_url("assets/frontend/images/"); ?>doc.png';
                }
                else {
                  var path = '<?php echo base_url("assets/admin/inquiry_doc/"); ?>' + response + '';
                }
                jQuery('.prepend_img').append('<div class="singl_img_up" id="pic' + index_g + '" data-name="' + response + '"> <img id="img-quotation"src="' + path + '"> <a onclick="remove_pic(\'' + index_g + '\',\'' + ',' + response + '\')"> <i class="fa fa-times"></i> </a> </div>');
                // jQuery('#image_gallery').val(image_gallery_g + ',' + response);
                index_g = parseInt(index_g) + 1;
              }
            }
          });
        }

      }

    }

  });

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
        swal("Deleted!", "Doc removed", "success");
      });
  }
</script>



</body>

</html>