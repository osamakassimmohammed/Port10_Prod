<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link href='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.css'
  rel='stylesheet' media='screen'>
<script
  src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/jquery.dataTables.js'></script>
<script
  src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.js'></script>
<link href='<?php echo base_url(); ?>assets/frontend/css/common.css' rel='stylesheet' media="screen" id="color">
<link href='<?php echo base_url(); ?>assets/admin/css/style.css' rel='stylesheet' media="screen" id="color">
<link href='<?php echo base_url(); ?>assets/admin/css/bootstrap.css' rel='stylesheet' media="screen" id="color">
<link href='<?php echo base_url(); ?>assets/frontend/css/bootstrap.css' rel='stylesheet' media="screen" id="color">


<style>
  section.content {
    margin: 18px 15px 0 15px;
    -moz-transition: 0.5s;
    -o-transition: 0.5s;
    -webkit-transition: 0.5s;
    transition: 0.5s;
  }

  .card .body {
    font-size: 14px;
    color: #555;
    padding: 20px;
    font-family: sans-serif;
  }

  body {
    background-color: #f1f2f7;
    -moz-transition: all 0.5s;
    -o-transition: all 0.5s;
    -webkit-transition: all 0.5s;
    transition: all 0.5s;
    font-family: Roboto;
  }

  li {
    list-style: disc;
    font-size: 15px;
    color: #000000;
    font-weight: 500
  }

  li:before {
    /* content: "·"; */
    font-size: 60px;
    vertical-align: middle;
    line-height: 20px;
    border-radius: 50%
  }

  .line-head {
    font-size: 15px;
    color: #000000;
    font-weight: 500;
    margin-bottom: 0.9rem;
  }

  img {
    max-width: 100% !important;
    margin-top: 1rem;
    margin-bottom: 1rem;
  }

  .got_ac {
    padding: 13px 29px;
    background: #3f006f;
    color: white !important;
    letter-spacing: 0.05em;
    border-radius: 5rem;
    margin-bottom: 1rem;
    font-family: sans-serif;
    font-size: 14px;
  }
</style>

<div class="content-wrapper">
  <section class="content page_inner_wrapper ">
    <button class="got_ac"><a style="color:white" href="<?Php echo base_url('ar/manual'); ?>">Arabic</a></button>
    <div class="container-fluid">
      <div class="row clearfix ">
        <div class="card">
          <div class="body">
            <div class="d-flex justify-content-between">
              <img style="width: 120px;height: 120px" alt=""
                src="<?php echo base_url('assets/admin/blog/'); ?>logo-english-image.png" />
              <img style="width: 120px;height: 120px" alt=""
                src="<?php echo base_url('assets/admin/blog/'); ?>logo-arabic-image.png" />
            </div>
            <div>
              <h1 class="manual-headers-blue text-center">
                Buyer Manual
              </h1>
              <div class="side_space_2">
                <h2 class="manual-headers-blue">
                  Contents
                </h2>
                <div class="row g-mt-3rem">
                  <div class="col-12">
                    <div class="col-md-10" style="padding-left: 0px;">
                      <h4 class="bolder">
                        Change Password
                      </h4>
                      <h4 class="bolder">
                        Upload Profile Image
                      </h4>
                      <h4 class="bolder">
                        Update Account Information
                      </h4>
                      <h4 class="bolder">
                        View/Download Order Invoice
                      </h4>
                      <h4 class="bolder">
                        Reorder Product(s)
                      </h4>
                      <h4 class="bolder">
                        Request Quotation
                      </h4>
                    </div>
                    <div class="col-md-2" style="text-align:end">
                      <h4>3</h4>
                      <h4>2</h4>
                      <h4>7</h4>
                      <h4>9</h4>
                      <h4>5</h4>
                      <h4>3</h4>
                    </div>
                    <div>
                      <div class="row g-mt-3rem">
                        <div class="col-12">
                          <div class="row d-flex justify-content-between">
                            <div class="col-lg-5 col-md-12">
                              <h2 class="manual-headers-red g-mt-3rem">
                                Change Password
                              </h2>
                              <h4 class="line-head">To reset the password associated with your account:</h4>
                              <ul>
                                <li>Go to https://www.port10.sa/en/login and login with your current credentials.</li>
                                <li>Click on <span class="bolder">Account</span> on the left corner.</li>
                                <li>In the <span class="bolder">Account page,</span> go to change your password and
                                  enter
                                  your old and new password then confirm your new password.</li>
                                <li>Click <span class="bolder">Change</span> to update the password.</li>
                              </ul>
                            </div>
                            <div class="col-lg-7 col-md-12">
                              <img class="shadow rounded" alt=""
                                src="<?php echo base_url('assets/admin/blog/'); ?>password-change.gif" />
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div>

                      <div class="row g-mt-3rem">
                        <div class="col-12">
                          <div class="row d-flex justify-content-between">
                            <div class="col-lg-5 col-md-12">
                              <h2 class="manual-headers-red g-mt-3rem">
                                Upload Profile Image
                              </h2>
                              <h4 class="line-head">To upload a profile image associated with your account:</h4>
                              <ul>
                                <li>Go to https://www.port10.sa/en/login and login with your current credentials.</li>
                                <li>Click on <span class="bolder">Account</span> on the left corner.</li>
                                <li>In the <span class="bolder">Account Settings</span> go to upload logo and choose
                                  your company logo</li>
                              </ul>
                            </div>
                            <div class="col-lg-7 col-md-12">
                              <img class="shadow rounded" alt=""
                                src="<?php echo base_url('assets/admin/blog/'); ?>password-change.gif" />
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div>
                      <div class="row g-mt-3rem">
                        <div class="col-12">
                          <div class="row d-flex justify-content-between">
                            <div class="col-lg-5 col-md-12">
                              <h2 class="manual-headers-red g-mt-3rem">
                                Update Account Information
                              </h2>
                              <h4 class="line-head">To update your profile information:</h4>
                              <ul>
                                <li>Go to https://www.port10.sa/en/login and login with your current credentials.
                                </li>
                                <li>Click on <span class="bolder">Account</span> on the left corner.</li>
                                <li>In the <span class="bolder">Account Settings</span> under Edit Profile, update
                                  your account information.</li>
                                <li>Click <span class="bolder">update</span> profile.</li>
                              </ul>
                            </div>
                            <div class="col-lg-7 col-md-12">
                              <img class="shadow rounded" alt=""
                                src="<?php echo base_url('assets/admin/blog/'); ?>update-profile-buyer.gif" />
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div>
                      <div class="row g-mt-3rem">
                        <div class="col-12">
                          <div class="row d-flex justify-content-between">
                            <div class="col-lg-5 col-md-12">
                              <h2 class="manual-headers-red g-mt-3rem">
                                View/Download Order Invoice
                              </h2>
                              <h4 class="line-head">To view or download order(s) invoice associated with your
                                account:</h4>
                              <ul>
                                <li>Go to https://www.port10.sa/en/login and login with your current
                                  credentials.</li>
                                <li>Click on <span class="bolder">Orders</span>.</li>
                                <li>In the <span class="bolder">Orders</span> page, Click on <span
                                    class="bolder">Download</span> to view the order invoice.</li>
                              </ul>
                            </div>
                            <div class="col-lg-7 col-md-12">
                              <img class="shadow rounded" alt=""
                                src="<?php echo base_url('assets/admin/blog/'); ?>invoice-buyer.gif" />
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div>
                      <div class="row g-mt-3rem">
                        <div class="col-12">
                          <div class="row d-flex justify-content-between">
                            <div class="col-lg-5 col-md-12">
                              <h2 class="manual-headers-red g-mt-3rem">
                                Reorder Product(s)
                              </h2>
                              <h4 class="line-head">To reorder product(s) you already purchased:</h4>
                              <ul>
                                <li>Go to https://www.port10.sa/en/login and login with your current
                                  credentials.</li>
                                <li>Click on <span class="bolder">Orders</span>.</li>
                                <li>In the <span class="bolder">Orders</span> page, Click on <span
                                    class="bolder">Reorder</span> to repurchase the product(s).</li>
                                <li>In the Reorder Page, choose the payment method.</li>
                                <li>Click <span class="bolder">Checkout</span> to open the checkout page.
                                </li>
                                <li>In the Checkout page, edit shipping/Billing address if needed.</li>
                                <li>Click <span class="bolder">Place Order</span> to confirm the purchase.
                                </li>
                              </ul>
                            </div>
                            <div class="col-lg-7 col-md-12">
                             <img src="<?php echo base_url('assets/admin/blog/'); ?>place-order-buyer.gif" />
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div>
                      <div class="row g-mt-3rem">
                        <div class="col-12">
                          <div class="row d-flex justify-content-between">
                            <div class="col-lg-5 col-md-12">
                              <h2 class="manual-headers-red g-mt-3rem">
                                Request Quotation
                              </h2>
                              <h4 class="line-head">To request a quotation of product from supplier:
                              </h4>
                              <ul>
                                <li>Go to https://www.port10.sa/en/login and login with your current
                                  credentials.</li>
                                <li>Click on quotation.</li>
                                <li>In the quotation page, click on <span class="bolder">Request
                                    Quotation</span>.</li>
                                <li>Request a quotation from this screen, aneed to provide some
                                  details like: (Product name, product group, to whom you requesting,
                                  purchase Cycle, customization, deadline for submission, product
                                  number, HS Code, unit(s), quantity, destination, delivery date,
                                  incoterms, Certification and more Information if needed).</li>
                                <li>Click the Send button to send the quotation request.</li>
                              </ul>
                            </div>
                            <div class="col-lg-7 col-md-12">
                             <img src="<?php echo base_url('assets/admin/blog/'); ?>request-quotation-buyer.gif" ></img>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                  <div>
                    <!-- <div> -->
                    <div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>

</div>