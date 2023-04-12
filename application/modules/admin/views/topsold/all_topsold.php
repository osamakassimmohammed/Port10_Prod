<div class="row">
  <a style="" href="<?php echo base_url('admin/all_topsold/yes') ?>" class="btn bg-light-green waves-effect"><span>Download</span></a>
   <h3 class="abu">Top Sold Products</h3>
   <?php if(!empty(@$top_selled))
   {      
      for($i = count($top_selled) - 1; $i >= 0; $i--)
      { 
        $product_image=explode("/",$top_selled[$i]['product_image']);
        $product_image=count($product_image);
        if ($product_image==1) 
        {
         $image_url=base_url("assets/admin/products/").$top_selled[$i]['product_image'];
        }else{
         $image_url=$top_selled[$i]['product_image'];  
        }
        
          $pro_url='en/admin/product/edit/';

         ?>

      <div class="col-sm-3">
         <div class="thumbnail card top_seling_sectn">
            <div class="header pading_top_header header_with_desrctpn">
               <h3 class="p_name_h3">Product <?php echo ' Sold '.$top_selled[$i]['pro_count'].' times .'; ?> </h3>
               <p class="p_name"><?php echo $top_selled[$i]['product_name']; ?></p>
               <div class="clear"></div>
            </div>            
            <a href="<?php echo base_url().$pro_url.$top_selled[$i]['product_id']; ?>"><img class="images top_seling_img" src="<?php echo $image_url; ?>"></a>
         </div>
      </div>
   <?php } }else{
      echo "<h3 class='abu'>No Order Found yet</h3>";
      
      }  ?>
</div>

<style type="text/css">
   .card .body .col-xs-6, .card .body .col-sm-6, .card .body .col-md-6, .card .body .col-lg-6 {
   margin-bottom: 0px!important;
   }
   h3.bh , h3.abu{
   clear: both;
   overflow: hidden;
   width: 100%;
   margin-left: 20px;
   font-family: initial;
   font-size: 18px;
   }

   img.images.top_seling_img {
   width: 100%;
   padding: 10px;

   margin: 0px;
   }
   p.p_name {
   height: 32px;
   }

   .thumbnail p:not(button) {
   color: #999999;
   font-size: 14px;
   padding: 0px;
   margin: 0px;
   }
   .header.pading_top_header.header_with_desrctpn {
   padding: 0px 10px 0px!important;
   margin: 0px;
   }
   .p_name_h3{
   clear: both;
   overflow: hidden;
   width: 100%;
   font-family: initial;
   font-size: 18px;
   }
</style>