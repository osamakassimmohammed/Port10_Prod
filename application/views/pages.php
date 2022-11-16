<style type="text/css">
   .home_active{
   font-weight: 600 !important;
   color: #c09550 !important;
   }
   .contnr_main_headr.hedr_fixed{
   position: static;
   box-shadow: 0px 0px 0px #fff;
   }
</style>
<!-- breadcrumb start -->
<div class="breadcrumb-section">
   <div class="container container_detl_wdth">
      <div class="row">
         <div class="col-sm-6">
            <div class="page-title">
               <h2><?php echo @$page_data[0]['title']; ?></h2>
            </div>
         </div>
         
      </div>
   </div>
</div>
<!-- breadcrumb End -->
<!--section start-->
<!-- section start -->


<!-- about section start -->
    <section class="about-page section-b-space">
        <div class="container">
            <div class="row">
                <!-- <div class="col-lg-12">
                    <div class="banner-section"><img src="<?php //echo base_url('assets/frontend/images') ?>/privacy.jpg"  class="img-fluid blur-up lazyload" alt=""></div>
                </div> -->
                <div class="col-sm-12">
                   <?php echo @$page_data[0]['editor']; ?>
                </div>
            </div>
        </div>
    </section>
    <!-- about section end -->


<!-- section end -->
