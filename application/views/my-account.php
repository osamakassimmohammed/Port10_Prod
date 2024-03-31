<style>
    .activ_my_acnt a {
        font-weight: 700 !important;
        color: #3f006f !important;
    }

    .container.container_detl_wdth, body, .breadcrumb-section {
        background-color: #f8fbfd;
    }

    .container.container_detl_wdth {
        background-color: #fff;
        padding: 0px;
    }
</style>
<!-- breadcrumb start -->
<div class="breadcrumb-section">
    <div class="container container_detl_wdth">
        <div class="row">
            <div class="col-sm-6">
                <div class="page-title">
                    <h2>My Account</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb End -->
<article class="container theme-container my_acnt_info_as">
    <div class="row">
        <!-- Posts Start -->
        <?php include("my_account_menu.php"); ?>
        <aside class="col-md-8 col-sm-8 space-bottom-20">
            <div class="account-details-wrap">
                <div class="title-2 sub-title-small"> Received Invoice</div>
                <div class="account-box  light-bg default-box-shadow">
                    <ul>
                        <li>
                            <a href="<?php echo base_url($language . '/my_account/send_quotation_list'); ?>">
                                Quotations</a>
                        </li>
                    </ul>
                </div>
                <div class="title-2 sub-title-small"> My Account</div>
                <div class="account-box  light-bg default-box-shadow">
                    <ul>
                        <li>
                            <a href="<?php echo base_url($language . '/my_account/account_info'); ?>">Edit
                                your account information</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url($language . '/my_account/cng_pass'); ?>">Change
                                your password</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url($language . '/my_account/orders'); ?>">View
                                your order history</a>
                            <!-- order_history -->
                        </li>
                        <!-- <li>
                           <a href="address-book.php">Modify your address book entries</a>
                           </li> -->
                    </ul>
                </div>
                <div class="title-2 sub-title-small"> Wishlist</div>
                <div class="account-box  light-bg default-box-shadow">
                    <ul>
                        <li>
                            <a href="<?php echo base_url('my_account/wishlist') ?>">My
                                Wishlist</a>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>
        <!-- Posts Ends -->
    </div>
</article>
<!--____ACTIVE_PAGE_CSS____-->
