<style type="text/css">
   .home_active{
   font-weight: 600 !important;
   color: #c09550 !important;
   }
   .contnr_main_headr.hedr_fixed{
   position: static;
   box-shadow: 0px 0px 0px #fff;
   }
   .blog_type_list{
      display: block !important;
   }
   .active_btype{
      color: #45b955;
   }


   .blog-page .blog-media .blog-right{
        text-align: left;
    display: inline-block;
   }
   .ratio2_3{
    margin-top: 30px;
   }
</style>
<!-- breadcrumb start -->
<!-- <div class="breadcrumb-section">
   <div class="container container_detl_wdth">
      <div class="row">
         <div class="col-sm-6">
            <div class="page-title">
               <h2>Blog</h2>
            </div>
         </div>         
      </div>
   </div>
</div> -->
<!-- breadcrumb End -->
<!--section start-->
<!-- section start -->
<!-- section start -->
<section class="section-b-space blog-page ratio2_3">
   <div class="container">
      <div class="row">
         <div class="col-xl-9 col-lg-8 col-md-7">
         <?php if(!empty($blog_data)) { ?>
            <?php foreach ($blog_data as $bd_key => $bd_val) { ?>
            <div class="row blog-media">
               <div class="col-xl-6">
                  <div class="blog-left">
                     <a href="<?php echo base_url($language.'/blog/detail/').$bd_val['id']; ?>"><img src="<?php echo base_url('assets/admin/blog/').$bd_val['image'];?>"
                        class="img-fluid blur-up lazyload bg-img" alt=""></a>
                  </div>
               </div>
               <div class="col-xl-6">
                  <div class="blog-right">
                     <div>
                        <h6><?php echo date('d M Y' ,strtotime($bd_val['created_date'])); ?></h6>
                        <a href="<?php echo base_url($language.'/blog/detail/').$bd_val['id']; ?>">
                           <h4><?Php echo $bd_val['heading']; ?> </h4>
                        </a>
                        <div><?Php echo $bd_val['description']; ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <?php break; }  }else{ ?>
            <h2 class="text-danger text-center"><?php echo lang('blog_not_found'); ?>!!!</h2>
         <?php } ?>                       
         </div>
         <?Php if(!empty($blog_type_data)){ ?>
         <div class="col-xl-3 col-lg-4 col-md-5">
            <form id="blog_search_form" >
            <div class="serch_blg_right">
               <h4><?php echo lang('Search_Blog'); ?></h4>
               <input type="text" id="blog_search" placeholder="<?php echo lang('Search_Blog'); ?>" > 
               <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
               <div class="clear"></div>
            </div>
               <div id="hsblog_list" style="display: none;" >fadsf dfasdf</div>
            </form>
            <br>
            

          
            <div class="blog-sidebar">
               <div class="theme-card">
                  <h4><?php echo lang('Recent_Blog'); ?></h4>
                  <ul class="recent-blog">
                     <?Php  foreach ($blog_data2 as $bd_key => $bd_val) { ?>
                     <li>
                        <a href="<?php echo base_url($language.'/blog/detail/').$bd_val['id']; ?>" class="media">
                           <img class="img-fluid blur-up lazyload"
                              src="<?php echo base_url('assets/admin/blog/').$bd_val['image'];?>" alt="Generic placeholder image">
                           <div class="media-body align-self-center">
                              <h6><?php echo date('d M Y' ,strtotime($bd_val['created_date'])); ?></h6>
                           </div>
                        </a>  
                     </li>
                     <?Php  } ?>                     
                  </ul>
               </div>
            </div>
                <br>

            <div class="blog-sidebar">
               <div class="theme-card">
                  <ul class="recent-blog">
                     <?Php foreach ($blog_type_data as $btd_key => $btd_val) { 
                        $active="";
                        if($blog_type_id==$btd_val['id'])
                        {
                           $active="active_btype";
                        }
                        ?>
                     <li class="blog_type_list">
                        <a href="<?php echo base_url($language.'/blog/index/').$btd_val['id']; ?>" class="media <?php echo $active; ?>"><?php echo $btd_val['name']; ?></a>
                     </li>   
                     <?php } ?>
                  </ul>
               </div>
            </div>
            
            
            

         </div>   
         <?php } ?>  
          
         <?php if(!empty($blog_data2)) { ?>      
         
         <?php } ?>  

      </div>
   </div>
</section>
<!-- Section ends -->
<!-- section end -->

<style type="text/css">
   .theme-card li{
      margin-top:15px ​!important;
   }

   .blog-page .blog-sidebar .theme-card {
    border: 1px solid #dddddd;
    padding: 20px 15px;
    background-color: #ffffff;
}

.blog_type_list a {
    font-weight: 500;
    color: #666;
}

.blog_type_list a:hover{
    color: #333;
}

.blog-page .blog-sidebar .theme-card .recent-blog li + li {
    margin-top: 16px !important;
}

</style>

<script type="text/javascript">
   $(document).on("submit","#blog_search_form",function(e){
      e.preventDefault();  
      var blog_search=$.trim($("#blog_search").val());
      // alert(blog_search);

      if(blog_search!='')
      {
        $('#loading').show();
         $.ajax({
               type: 'POST',
               url: "<?php echo base_url($language.'/ajax/get_blog_heading'); ?>",
               data: {'search':blog_search},            
               success: function(response)
               {
                 $('#loading').hide();
                  response=$.trim(response);
                 var response = $.parseJSON(response);
                 if(response.status==true)
                 {
                   $('#hsblog_list').show();
                   $("#hsblog_list").html(response.data);
                 }else{
                   $('#hsblog_list').hide();
                   swal("",response.message,'warning');
                 }
               }
         });      
      }else{
         swal("","<?php echo lang('Please_Enter_Search_Value'); ?>","warning");
      }
   });
</script>
