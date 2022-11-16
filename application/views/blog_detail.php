<style type="text/css">
   .home_active{
   font-weight: 600 !important;
   color: #c09550 !important;
   }
   .contnr_main_headr.hedr_fixed{
   position: static;
   box-shadow: 0px 0px 0px #fff;
   }

   .blog-page .blog-media .blog-right{
          display: inline-block;
   }
</style>
<!-- breadcrumb start -->

<!-- breadcrumb End -->
<!--section start-->
<!-- section start -->
<!-- section start -->
<section class="section-b-space blog-page ratio2_3 page_detil_blog">
   <div class="container">
      <div class="row">
         <div class="col-xl-10 col-lg-10 col-md-10 offset-md-1">
            <?Php if(!empty($blog_data)){ ?>
            <div class="row blog-media">
               <div class="col-xl-12">
                  <div class="blog-left">
                     <a href="javascript:void(0)"><img src="<?php echo base_url('assets/admin/blog/').$blog_data[0]['image'];?>"
                        class="img-fluid blur-up lazyload bg-img" alt=""></a>
                  </div>
               </div>
               <div class="col-xl-12">
                  <div class="blog-right">
                     <div>
                        <h6><?php echo date('d M Y' ,strtotime($blog_data[0]['created_date'])); ?></h6>
                        <a href="javascript:void(0)">
                           <h4><?php echo $blog_data[0]['heading'];  ?> 
                           </h4>
                        </a>
                        <div><?php echo $blog_data[0]['description'];  ?></div>
                     </div>
                  </div>
               </div>
            </div>
             <?php }else{ ?>
            <h2 class="text-danger text-center">Blog not found. Will update soon.!!!</h2>
            <?php } ?>
         </div>
         
      </div>
   </div>
</section>
<!-- Section ends -->
<!-- section end -->
