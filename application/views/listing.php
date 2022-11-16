<style type="text/css">
   .home_active{
   font-weight: 600 !important;
   color: #c09550 !important;
   }

   .breadcrumb-item + .breadcrumb-item::before {
    display: inline-block;
    padding-right: 0.5rem;
    color: #fff;
    content: "/";
}

header{
   margin-bottom: 0px;
}

</style>
<script type="text/javascript">
   gm_catid=null;
   gs_catid=null;
   gsort=null;
   gsearch=null;
   gbrand_id=null;
   gmin_price=null;
   gmax_price=null;
   gmin_order_q=null;
   gs_catids=null;
   gsample_order=null;
  <?php if(!empty($m_catid)){ ?>
    gm_catid="<?Php echo $m_catid; ?>";
  <?php } ?>

  <?php if(!empty($s_catid)){ ?>
    gs_catid="<?Php echo $s_catid; ?>";
  <?php } ?>
  <?php if(!empty($search)){ ?>
    gsearch="<?Php echo $search; ?>";
  <?php } ?>
   
</script>
<!-- breadcrumb start -->

<!-- breadcrumb End -->
<!-- section start -->
<section class="section-b-space ratio_asos listing_wrap">
   <div class="collection-wrapper">
      <div class="container">
         <div class="row">                              

            <div class="col-sm-3 collection-filter"  >
               <!-- side-bar colleps block stat -->
               <div class="collection-filter-block">
                  <!-- brand filter start -->

                  <div class="filtr_titla">
                     <?php echo lang('Filters'); ?>
                  </div>
                  <div class="clear"></div>

                  <div class="min_ord_nty"> 
                     <div class="min_ordr_titl">
                        <?php echo lang('Minimum_Order_Quantity'); ?>
                     </div>
                     <div class="minmord_wrppls">

                        
                        <a class="minm_add minm_add_mins" data-type="minus" href="javascript:void(0)">-</a>
                        <input class="minmord_input" type="text" readonly onkeydown="return false" >
                        <a class="minm_add" data-type="plus" href="javascript:void(0)">+</a>

                        <div class="clear"></div>
                     </div>
                     <div class="clear"></div>
                  </div>
                  <div class="clear"></div>
 
                  <div class="collection-mobile-back"><span class="filter-back"><i class="fa fa-angle-left"
                     aria-hidden="true"></i> back</span>
                  </div>                  
                     
                  <div class="clear"></div> 

                  <div class="collection-collapse-block open singl_checkbox_lst">
                     <div class="custom-control custom-checkbox collection-filter-checkbox">
                        <input type="checkbox" class="custom-control-input class_click" value="1" name="sample_order" id="sample_order">
                        <label class="custom-control-label" for="sample_order">
                           <span> <?php echo lang('Sample_Order'); ?> </span>
                        </label>
                     </div>
                  </div>
                  <div class="clear"></div> 


                  <div class="collection-collapse-block border-0 ">
                     <!-- <h3 class="collapse-block-title">Sub category</h3> -->
                     <!-- <div class="collection-collapse-block-content" style="display: none;"> -->
                        <div class="filter_cat_search">
                        <input type="text" placeholder="<?php echo lang('Sub_category'); ?>" class="filter_cat_input">
                        <i class="fa fa-search filter_cat_icon"></i>
                        </div>
                        <div class="collection-brand-filter" id="append_subcat_html">
                           <?php if(!empty($subcategory_data)){ 
                              foreach ($subcategory_data as $sscd_key => $sscd_val) 
                              { ?>
                                <div class="custom-control custom-checkbox collection-filter-checkbox">
                              <input type="checkbox" class="custom-control-input class_click2" name="s_catids" id="s_catids<?php echo $sscd_key+1; ?>" value="<?php echo $sscd_val['id']; ?>">
                              <label class="custom-control-label" for="s_catids<?php echo $sscd_key+1; ?>"><?php echo $sscd_val['display_name']; ?></label>
                           </div>
                            <?php } } ?>
                          
                        </div>
                     <!-- </div> -->
                  </div>
                 
                  <div class="collection-collapse-block border-0 " >
                     <!-- <h3 class="collapse-block-title">Brand</h3> -->
                     <!-- <div class="collection-collapse-block-content" style="display: none;"> -->
                        <div class="filter_brand_search">
                        <input type="text" placeholder="<?php echo lang('Brand'); ?>" class="filter_brand_input">
                        <i class="fa fa-search filter_cat_icon"></i>
                        </div>
                        <div class="collection-brand-filter" id="append_brand_html">
                           <?php if(!empty($brand_data)){ 
                              foreach ($brand_data as $bd_key => $bd_val) { ?>
                           <div class="custom-control custom-checkbox collection-filter-checkbox">
                              <input type="checkbox" class="custom-control-input class_click" name="brand_id" id="brand<?php echo $bd_key+1; ?>" value="<?php echo $bd_val['id']; ?>">
                              <label class="custom-control-label" for="brand<?php echo $bd_key+1; ?>"><?php echo $bd_val['brand_name']; ?></label>
                           </div>
                          <?php } }else{ ?>
                            <div class="custom-control custom-checkbox collection-filter-checkbox">
                              <label class="custom-control-label" for="hundred"> Brand not found will update soon.!!</label>
                            </div>
                          <?php } ?>                      
                          
                        </div>
                     <!-- </div> -->
                  </div>                  

                  <div class="collection-collapse-block border-0 price_tb_as">
                    <h3 class="collapse-block-title"><?php echo lang('Price'); ?> </h3>
                    <div class="collection-collapse-block-content " style="display: none;">
                        <input class="space2" type="text" id="min_price" style="" placeholder="<?php echo lang('Min_Price'); ?>" onkeypress="return isNumberKey(event)">
                        <input class="space2" type="text" id="max_price" style="" placeholder="<?php echo lang('Max_Price'); ?>" onkeypress="return isNumberKey(event)">
                        <div class="clear"></div>
                        <button type="button" class="btn btn-info" id="price_btn" style=""><?php echo lang('Apply_Price'); ?></button>
                        <div class="clear"></div>
                    </div>
                  </div>
               </div>
               <!-- silde-bar colleps block end here -->
               <!-- side-bar banner start here -->
               <div class="collection-sidebar-banner">
                  <a href="#"><img src="" class="img-fluid blur-up lazyload" alt=""></a>
               </div>
               <!-- side-bar banner end here -->
            </div>

            <div class="collection-content col">
               <div class="page-main-content">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="collection-product-wrapper">
                           <div class="product-top-filter"  >
                                <div class="row roe_list_as">
                                 <div class="col-xl-12">
                                    <div class="filter-main-btn"><span class="filter-btn btn btn-theme"><i class="fa fa-filter"
                                       aria-hidden="true"></i> Filter</span></div>
                                 </div>
                              </div> 
                              <div class="row">                      


                                 <div class="col-12 wrap_reslt_as">

                                 <div class="wrap_main_right_slct" >


                                    <div class="product-filter-content serch_wrp_a">
                                        

                                      
                                       <div class="product-page-per-view">
                                          <select id="fselect_main_cat">
                                             <option value="0"><?php echo lang('Select_Category'); ?></option>
                                             <?php if(!empty($main_category)){
                                               foreach ($main_category as $mc_key => $mc_val) 
                                               {  
                                                  $lis_selected='';
                                                if($mc_val['id']==$single_category[0]['id']){
                                                    $lis_selected="selected";
                                               }     ?>
                                              <option value="<?php echo $mc_val['id']; ?>" <?php echo $lis_selected; ?>><?php echo $mc_val['display_name']; ?></option><?php } }  ?> 
                                           </select>
                                       </div>

                                       <div class="serch_prodct_wrp">
                                          <input type="text" placeholder="<?php echo lang('Search_Product'); ?>" class="searchproduct_inpt" >
                                          <i class="fa fa-search"></i>
                                          <div class="clear"></div>
                                       </div>

                                       <div class="product-page-filter">
                                          <select id="sort_product">
                                             <option value="0"><?php echo lang('Sorting_items'); ?></option>
                                             <option value="asc"><?php echo lang('Price_Lower_to_Higher'); ?></option>
                                             <option value="desc"><?php echo lang('Price_Higher_to_Lower'); ?></option>                                             
                                          </select>
                                       </div>
                                    </div>
                                  </div>

                                 </div>
                              </div>
                           </div>
                           <div class="product-wrapper-grid listing_page_pad new_list_pg_as">
                              <div class="no-slider row" id="append_search_data">   
                                <?php if(!empty($product_data)) { 
                                  $i=1;
                                  foreach ($product_data as $product_key => $product_value){ ?>

                                <div class="product-box">
                                    <div class="img-wrapper">
                                        <div class="front">
                                            <a href="#"><img src="<?php echo base_url("assets/admin/products/").$product_value['product_image']; ?>" class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                        </div>
                                        <div class="back">
                                            <a href="<?php echo base_url($language.'/home/detail/').$product_value['id']; ?>"><img src="<?php echo base_url("assets/admin/products/").$product_value['product_image']; ?>" class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                        </div>
                                        <div class="cart-info cart-wrap">
                                            
                                            
                                        </div>
                                    </div>
                                    <div class="product-detail">
                                        <?php if(!empty($product_value['unit_list'])) { ?>
                                        <select class="form-control select_unit get_unit<?php echo $product_key; ?>">
                                            <?php
                                            foreach ($product_value['unit_list'] as $uld_key => $uld_value) { ?>
                                            <option data-id="<?php echo $uld_value['id'] ?>" ><?php echo $uld_value['unit_name']; ?></option>
                                            <?php  } ?>
                                        </select>
                                        <?php } ?>
                                        <?php if(isset($product_value['meta_data']) && !empty($product_value['meta_data']) ) { ?>
                                        <select class="form-control select_size get_size<?php echo $product_key; ?>">
                                            <option value="0">Select Size</option>
                                            <?php  foreach ($product_value['meta_data'] as $md_key => $md_val) { ?>
                                            <option data-price="<?php echo $md_val['price']; ?>" data-value="<?php echo $md_val['size']; ?>" value="<?php echo $md_val['item_id']; ?>"><?php echo $md_val['size']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php } ?>
                                        <div>
                                            <a href="<?php echo base_url($language.'/home/detail/').$product_value['id']; ?>">
                                                <h6><?php echo $product_value['product_name']; ?></h6>
                                            </a>
                                            <span class="wish_l wishlist<?php echo $product_value['id']; ?>">
                                                <?php if($product_value['wish_list']==1){  ?>
                                                <a  href="javascript:void(0)" onclick="remove_cart(<?php echo $product_value['id']; ?>)" ><i
                                                class="ti-heart" aria-hidden="true"></i></a>
                                                <?php }else{ ?>
                                                <a href="javascript:void(0)" onclick="move_to_wish_list(<?php echo $product_value['id']; ?>)" >
                                                <i class="ti-heart" aria-hidden="true"></i></a>
                                                <?php } ?>
                                            </span>
                                            <h4><?php echo $currency_symbol; ?> <?php echo $product_value['sale_price']; ?> </h4>
                                            <ul class="color-variant">
                                                <li class="bg-light0"></li>
                                                <li class="bg-light1"></li>
                                                <li class="bg-light2"></li>
                                            </ul>
                                            <?php if($product_value['price_select']=='1') { ?>
                                            <button title="<?php echo lang('Add_to_cart'); ?>" data-id="<?php echo $product_value['id']; ?>" data-unit="get_unit<?php echo $product_key; ?>" data-detislqty="<?php echo $product_value['min_order_quantity']; ?>" class="add_to_cart2">
                                            <i class="ti-shopping-cart"></i> <?php echo lang('Add_to_cart'); ?>
                                            </button>
                                            <?php }else{ ?>
                                            <button title="<?php echo lang('Add_to_cart'); ?>"data-class="get_size<?php echo $product_key; ?>" data-id="<?php echo $product_value['id']; ?>" data-unit="get_unit<?php echo $product_key; ?>" data-detislqty="<?php echo $product_value['min_order_quantity']; ?>" class="add_to_cart2">
                                            <i class="ti-shopping-cart"></i> <?php echo lang('Add_to_cart'); ?>
                                            </button>
                                            <?php } ?>

                                            <div class="wrp_cmpr_2">
                                             <label>
                                                <input type="checkbox"  class="add_check2 compare_ck" value="<?php echo $product_value['id']; ?>" <?php echo $product_value['is_compare']; ?> >
                                                <div class="ad_cmpr_tex2">
                                                <?php echo lang('Add_To_Compare'); ?> 
                                                </div>
                                             </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php } $i++;  }else{ ?>
                                  <h2 class="text-danger text-center"><?php echo lang('Product_Not_Found'); ?></h2>
                                <?php } ?>

                              </div>
                           </div>

                           <div class="product-pagination" id="hspagination_div">
                              <div class="theme-paggination-block">
                                 <div class="row">
                                    <div class="col-xl-6 col-md-6 col-sm-12">
                                       <nav aria-label="Page navigation" id="pagination">
                                          <?php echo $pagination; ?>
                                       </nav>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-sm-12">
                                       <div class="product-search-count-bottom">
                                          <h5><?php echo lang('Showing_Products'); ?> <span id="start"><?php echo (!empty($product_data)) ? $row+1 : '0'; ?></span>-<span id="total_record"><?php echo $total_rows; ?></span> of <span id="per_page"><?php  echo (!empty($product_data)) ? $rowperpage : '0'; ?></span> <?php echo lang('Result'); ?></h5>
                                       </div>
                                    </div>
                                 </div>
                              </div>
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
<!-- section End -->



<script> 
$(document).ready(function(){
  $(".click_are_hfltr").click(function(){
    $(".collection-filter").slideToggle("fast");
  });
});
</script>

<script type="text/javascript">
  $(document).on("click",".minm_add",function(){
    var type=$(this).data('type');
    var qty = $('.minmord_input').val();
    var qty = parseInt(qty);
     if (isNaN(qty)) 
     {
        qty=1;
     }else{
      if(type=='plus')
      {
        qty=1+qty;
      }else{
        if(qty==1)
        {
          qty=1;
        }else{
          qty=qty-1;
        }
      }
     }
     $('.minmord_input').val(qty);
     gmin_order_q=qty;
     all_product_listing();
    // alert(qty);
    // alert(type);
  });

   $(".filter_cat_input").on("keyup", function() {
    // console.log('123')
    var value = $(this).val().toLowerCase();
    $("#append_subcat_html .collection-filter-checkbox").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

   $(".filter_brand_input").on("keyup", function() {
    // console.log('123')
    var value = $(this).val().toLowerCase();
    $("#append_brand_html .collection-filter-checkbox").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

  $(document).on("change","#fselect_main_cat",function(){
      var car_id=$(this).val();
    if(car_id==0)
    {
      swal("","<?php echo lang('aPlease_select_category'); ?>",'warning');
      return false;
    }
      gm_catid=car_id;
      all_product_listing('select_flag');
  });

  $(document).on("change","#sort_product",function(){
    var sort=$("#sort_product").val();    
    if(sort==0)
    {
      swal("","<?php echo lang('Please_select_sort'); ?>",'warning');
      return false;
    }
    if(sort=='asc' || sort =='desc')
    {
      gsort=sort;
      all_product_listing();
    }
    
  });

  $(document).on('click',".class_click",function(){  
      var brand_id = $("input:checkbox[name=brand_id]:checked").map(function(_, el) {
          return $(el).val();
      }).get();  
      gbrand_id=brand_id;

      var sample_order = $("input:checkbox[name=sample_order]:checked").map(function(_, el) {
          return $(el).val();
      }).get();  
      gsample_order=sample_order;
      
      all_product_listing();

    });
   $(document).on('click',".class_click2",function(){ 

        var s_catids = $("input:checkbox[name=s_catids]:checked").map(function(_, el) {
          return $(el).val();
      }).get();  
      gs_catids=s_catids;
      gs_catid=null;
      all_product_listing();
   }); 

  $(document).on('click',"#price_btn",function(){ 
      var min_price=$.trim($("#min_price").val()); 
      var max_price=$.trim($("#max_price").val()); 
      if(min_price=='')
      {
        swal("","<?php echo lang('Please_enter_min_price'); ?>","warning");
        return false;
      }else if(max_price=='')
      {
        swal("","<?php echo lang('Please_enter_max_price'); ?>","warning");
        return false;
      }else{
        gmin_price=min_price;
        gmax_price=max_price;
        all_product_listing();
      }      
    });

      

    

   function all_product_listing(flag='')
   {      

    var ajax="call";      
      $('#loading').show();      
      $.ajax({
        type: 'POST',
        url: "<?php echo base_url($language.'/home/listing') ?>",
        data: {'m_catid':gm_catid,'s_catid':gs_catid,'sort':gsort,'search':gsearch,ajax:ajax,'brand_id':gbrand_id,'min_price':gmin_price,'max_price':gmax_price,'min_order_q':gmin_order_q,'s_catids':gs_catids,'sample_order':gsample_order},
        success:function(response)
        {
          $('#loading').hide();   
          var response = $.parseJSON(response);
          if(response.result!='')
          {
            if(flag=='select_flag')
            {              
              $("#banner_image").attr("style",'background-image:url(' + response.banner_image + ')');              
            }
            $("#append_search_data").html(response.result); 
            $("#append_subcat_html").html(response.subcat_html); 
            $("#pagination").html(response.pagination);
            $("#start").text(response.row+1);
            $("#total_record").text(response.total_rows);
            $("#per_page").text(response.rowperpage);
          }else{
             swal("","<?php echo lang('Product_Not_Found'); ?>","warning");
             $("#append_subcat_html").html(response.subcat_html);
            $("#append_search_data").html('<h2 class="text-center text-danger"><?php echo lang('Product_Not_Found'); ?></h2>'); 
            $("#pagination").hide();
            $("#hspagination_div").hide();
            $("#pro_count").text('0');
          }
        }
      });   
   }
    $('#pagination').on('click','a',function(e){
    e.preventDefault();        
    var ajax="call";
    var pageno = $(this).attr('data-ci-pagination-page');   
   
    // alert(pageno);
    // return false;
     // data: {'car_make':gcar_make,'car_model':gcar_model,'select_year':gselect_year,'price_start':gprice_start,'price_end':gprice_end,'sort':gsort,ajax:ajax,pageno:pageno}, 
    if (typeof pageno !== 'undefined')
    {     
      // $('#loading').show();      
      $.ajax({
        type: 'POST',
        url: "<?php echo base_url($language); ?>/home/listing",
        data: {'m_catid':gm_catid,'s_catid':gs_catid,'sort':gsort,'search':gsearch,ajax:ajax,pageno:pageno,'brand_id':gbrand_id,'min_price':gmin_price,'max_price':gmax_price,'min_order_q':gmin_order_q,'s_catids':gs_catids,'sample_order':gsample_order},        
        success:function(response)
        {
          // alert(response);
          $('#loading').hide();   
          var response = $.parseJSON(response);
          if(response.result!='')
          {
            $("#append_search_data").html(response.result); 
            $("#append_subcat_html").html(response.subcat_html); 
            $("#pagination").html(response.pagination);
            $("#start").text(response.row+1);
            $("#total_record").text(response.total_rows);
            $("#per_page").text(response.rowperpage);
          }else{
            swal("","<?php echo lang('Product_Not_Found'); ?>","warning");
            $("#append_subcat_html").html(response.subcat_html);
            $("#append_search_data").html('<h2 class="text-center text-danger"><?php echo lang('Product_Not_Found'); ?></h2>'); 
            $("#pagination").hide();
            $("#hspagination_div").hide();
            // $("#pro_count").text('0');
          }
        }
      });  

    }else{
      swal("","You are already on pageno 1",'warning');
    }    
  });

</script>


<style type="text/css">
   

   .compr_div {
    position: absolute;
    z-index: 9999;
    background: #a11a2fab;
    width: 100%;
    padding: 5px 6px;
    display: none;
}

.compr_div label{
   margin-bottom: 0px;
   cursor: pointer;
}


   .compr_icon {
    float: left;
    width: 35px;
    height: 35px;
    background: #3f006f;
    color: #fff;
    font-size: 18px;
    line-height: 35px;
    padding-left: 7px;
    border-radius: 100px;
}


   .compr_icon i{

   }

   .ad_cmpr_tex {
    float: left;
    margin-top: 7px;
    margin-left: 5px;
    font-weight: 500;
    color: #fff;
}

.add_check {
    float: left;
    margin-left: 4px;
    margin-top: 11px;
}

.wrp_cmpr_2 {
    float: left;
    width: 100%;
    margin-top: -3px;
    margin-bottom: -2px;
}

.wrp_cmpr_2 label {
    float: left;
    width: 100%;
    text-align: center;
    margin-top: 10px;
    margin-bottom: 10px;
    cursor: pointer;
}

.add_check2{
   margin-left: -5px;
}

.ad_cmpr_tex2 {
    display: inline-block;
    font-size: 14px;
    margin-left: 3px;
    font-weight: 500;
    color: #3f006f;
}

</style>