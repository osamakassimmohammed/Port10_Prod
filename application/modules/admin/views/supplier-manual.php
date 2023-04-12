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
    margin: 15px 15px 0 15px;
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
    <button class="got_ac"><a style="color:white" href="<?Php echo base_url('admin/manual/ar'); ?>">Arabic</a></button>
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
                <?php echo lang('aSupplier_Manual'); ?>
              </h1>
              <div class="side_space_2">
                <h2 class="manual-headers-blue">
                  <?php echo lang('aContents'); ?>
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
                        Create Brand
                      </h4>
                      <h4 class="bolder">
                        Add Product
                      </h4>
                      <h4 class="bolder">
                        Export Orders List
                      </h4>
                      <h4 class="bolder">
                        Confirm/Cancel Order Status
                      </h4>
                      <h4 class="bolder">
                        View/Download Orders Invoice
                      </h4>
                      <h4 class="bolder">
                        Reject Quotation
                      </h4>
                      <h4 class="bolder">
                        Accept Quotation
                      </h4>
                    </div>
                    <div class="col-md-2" style="text-align:end">
                      <h4>3</h4>
                      <h4>2</h4>
                      <h4>7</h4>
                      <h4>9</h4>
                      <h4>5</h4>
                      <h4>3</h4>
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
                              <h4 class="line-head">To reset the password associated with your account: </h4>
                              <ul>
                                <li>Go to https://www.port10.sa/en/login and login with your current credentials.</li>
                                <li>Click on the top left corner and select <span class="bolder">Account
                                    Settings.</span>
                                </li>
                                <li>In the <span class="bolder">Account Settings</span> go to change password and enter
                                  your
                                  new password then confirm your new password. </li>
                                <li>Submit.</li>
                              </ul>
                            </div>
                            <div class="col-lg-7 col-md-12">
                              <img class="shadow rounded" alt=""
                                src="<?php echo base_url('assets/admin/blog/'); ?>password-change-supplier.gif" />
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
                                <?php echo lang('aUpload_Profile_Image'); ?>
                              </h2>
                              <h4 class="line-head">To upload a profile image associated with your account:</h4>
                              <ul>
                                <li>Go to https://www.port10.sa/en/login and login with your current credentials</li>
                                <li>Click on the top left corner and select <span class="bolder">Account
                                    Settings.</span></li>
                                <li>In the <span class="bolder">Account Settings</span> go to upload profile and
                                  choose your company logo.</li>
                                <li>Click upload profile.</li>
                              </ul>
                            </div>
                            <div class="col-lg-7 col-md-12">
                              <img class="shadow rounded" alt=""
                                src="<?php echo base_url('assets/admin/blog/'); ?>change-profile-supplier.gif" />
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
                                <?php echo lang('aUpdate_Account_Information'); ?>
                              </h2>
                              <h4 class="line-head">To update your profile information:</h4>
                              <ul>
                                <li>Go to https://www.port10.sa/en/login and login with your current credentials
                                </li>
                                <li>Click on the top left corner and select <span class="bolder">Account
                                    Settings.</span></li>
                                <li>In the <span class="bolder">Account Settings</span> under Account Info edit
                                  your account information.</li>
                                <li>Click <span class="bolder">update</span> profile.</li>
                              </ul>
                            </div>
                            <div class="col-lg-7 col-md-12">
                              <img class="shadow rounded" alt=""
                                src="<?php echo base_url('assets/admin/blog/'); ?>account-supplier.gif" />
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
                                <?php echo lang('acreate_Brand'); ?>
                              </h2>
                              <h4 class="line-head">To create a brand associated with your account:</h4>
                              <ul>
                                <li>Go to https://www.port10.sa/en/login and login with your current
                                  credentials.li>
                                <li>Click on the top left corner and select <span class="bolder">Brands.</span></li>
                                <li>In the <span class="bolder">Brands</span> page, go to Create brand.</li>
                                <li>Add the brand name.</li>
                                <li>Upload the brand image.</li>
                                <li>Click <span class="bolder">Create</span> to save the brand.</li>
                              </ul>
                            </div>
                            <div class="col-lg-7 col-md-12">
                              <img class="shadow rounded" alt=""
                                src="<?php echo base_url('assets/admin/blog/'); ?>create-brand-supplier.gif" />
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
                                <?php echo lang('aAdd_Product'); ?>
                              </h2>
                              <h4 class="line-head">To add a product associated with your account:</h4>
                              <ul>
                                <li>Go to https://www.port10.sa/en/login and login with your current
                                  credentials.</li>
                                <li>Click on the top left corner and select <span class="bolder">Product</span>.</li>
                                <li>In the <span class="bolder">Product</span> page, go to <span class="bolder">Create
                                    Product</span>.</li>
                                <li>Create product from this screen, need to provide some details like:
                                  (Name, Search tag, short description, Brand, Category, subcategory,
                                  Description, Specification, Status, Market price, our price, Stock
                                  status, quantity in stock, Ready for shipment by and Product images).
                                </li>
                                <li>Click the <span class="bolder">submit</span> button to store all the
                                  details
                                </li>
                              </ul>
                            </div>
                            <div class="col-lg-7 col-md-12">
                              <img class="shadow rounded" alt=""
                                src="<?php echo base_url('assets/admin/blog/'); ?>create-product-supplier.gif" />
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
                                <?php echo lang('aExport_Orders_List'); ?>
                              </h2>
                              <h4 class="line-head">To export the order list associated with your
                                account in Microsoft Excel format:
                              </h4>
                              <ul>
                                <li>Go to https://www.port10.sa/en/login and login with your current
                                  credentials.li>
                                <li>Click on the top left corner and select <span class="bolder">Orders.</span></li>
                                <li>Set the start and end dates for the orders that you want to
                                  export.</li>
                                <li>Click the Excel button to export the orders list.</li>
                              </ul>
                            </div>
                            <div class="col-lg-7 col-md-12">
                              <img class="shadow rounded" alt=""
                                src="<?php echo base_url('assets/admin/blog/'); ?>export-order-supplier.gif" />
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
                                <?php echo lang('aConfirm/Cancel_Order_Status'); ?>
                              </h2>
                              <h4 class="line-head">To confirm/cancel orders associated with your
                                account:
                              </h4>
                              <ul>
                                <li>Go to https://www.port10.sa/en/login and login with your
                                  current credentials</li>
                                <li>Click on the top left corner and select <span class="bolder">Orders.</span></li>
                                <li>In the <span class="bolder">Orders</span> page, pick the order
                                  you would like to update and click on <span class="bolder">View.</span></li>
                                <li>Under <span class="bolder">update order</span> box, click on
                                  order status and update the order state (Complete/Cancel). </li>
                                <li>Click the <span class="bolder">Update</span> button to save
                                  the updated order status.</li>
                              </ul>
                            </div>
                            <div class="col-lg-7 col-md-12">
                              <img class="shadow rounded" alt=""
                                src="<?php echo base_url('assets/admin/blog/'); ?>conform-cancel-supplier.gif" />
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
                                <?php echo lang('aView/Download_Orders_Invoice'); ?>
                              </h2>
                              <h4 class="line-head">To view or download the order invoice
                                associated with your account:
                              </h4>
                              <ul>
                                <li>Go to https://www.port10.sa/en/login and login with your
                                  current credentials.</li>
                                <li>Click on the top left corner and select <span class="bolder">Orders.</span></li>
                                <li>In the <span class="bolder">Orders</span"> page, pick the
                                    order you would like to view and click on <span class="bolder">Invoice.</span></li>
                                <li>In the <span class="bolder">Invoice</span> page, click on
                                  <span class="bolder">Download Invoice.</span>
                                </li>
                              </ul>
                            </div>
                            <div class="col-lg-7 col-md-12">
                              <img class="shadow rounded" alt=""
                              src="<?php echo base_url('assets/admin/blog/'); ?>request-quotation-supplier.gif" />
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
                                <?php echo lang('aReject_Quotation'); ?>
                              </h2>
                              <h4 class="line-head">To reject quotation orders associated
                                with your account:
                              </h4>
                              <ul>
                                <li>Go to https://www.port10.sa/en/login and login with
                                  your current credentials. </li>
                                <li>Click on the top left corner and select <span class="bolder">Quotation.</span></li>
                                <li>In the <span class="bolder">Quotation</span> page,
                                  pick the request you would like to update and click on
                                  <span class="bolder">Info.</span>
                                </li>
                                <li>In the <span class="bolder">Quotation Detail</span>
                                  page, click on <span class="bolder">rejected</span> to
                                  decline the quotation offer.</li>
                                <li>Write the rejection reason and click the submit button
                                  to send all the details to the buyer.</li>
                              </ul>
                            </div>
                            <div class="col-lg-7 col-md-12">
                              <img class="shadow rounded" alt=""
                                src="<?php echo base_url('assets/admin/blog/'); ?>view-download-supplier.gif" />
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div>
                      <h2 class="manual-headers-red g-mt-3rem">
                        <?php echo lang('aAccept_Quotation'); ?>
                      </h2>
                      <div class="row g-mt-3rem">
                        <div class="col-12">
                          <h4 class="line-head">To accept the quotation offers
                            associated with your account:
                          </h4>
                          <ul>
                            <li>Go to https://www.port10.sa/en/login and login
                              with your current credentials.</li>
                            <li>Click on the top left corner and select <span class="bolder">Quotation.</span></li>
                            <li>In the <span class="bolder">Quotation</span> page,
                              pick the request you would like to update and click
                              on <span class="bolder">Info</span></li>
                            <li>In the <span class="bolder">Quotation
                                Detail</span> page, click on <span class="bolder">Create Invoice</span> to send the
                              quotation offer to the buyer.</li>
                            <li>In the <span class="bolder">Quotation
                                Request</span> page, provide some details like:
                              (Quantity, Item Description and Price).</li>
                            <li>Click on <span class="bolder">Send</span> to send
                              the quotation offer to the buyer.</li>
                          </ul>
                        </div>
                      </div>
                    </div>

                  </div>
                  <div>
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