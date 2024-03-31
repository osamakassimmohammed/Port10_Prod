<div class="page-header-area-2 gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="small-breadcrumb">
                    <div class="breadcrumb-link">
                        <ul>
                            <li><a href="<?php echo base_url($language); ?>">Home</a>
                            </li>
                            <li><a href="javascript:void(0)">Cancel</a></li>
                        </ul>
                    </div>
                    <div class="header-page">
                        <h1>Cancel</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="main-content-area clearfix">

    <!-- =-=-=-=-=-=-= Pricing =-=-=-=-=-=-= -->
    <section class="custom-padding">
        <!-- Main Container -->
        <div class="container">
            <!-- Row -->
            <div class="row">
                <!-- Middle Content Box -->
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <div class="row pricing">
                        <?php if (isset($trans_id)) { ?>
                            <h2>Transaction ID: <?php echo $trans_id; ?></h2>
                        <?php } else { ?>
                            <h2>Message: <?php echo $errorText; ?></h2>
                            <h2>Payment id: <?php echo $paymentId; ?></h2>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <!-- Row End -->
        </div>
        <!-- Main Container End -->
    </section>
    <!-- =-=-=-=-=-=-= Pricing End =-=-=-=-=-=-= -->


</div>
