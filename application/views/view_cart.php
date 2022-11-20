<style type="text/css">
   
    .form-control.select_unit{
      width: 100%;
    }

   .home_active{
   font-weight: 600 !important;
   color: #c09550 !important;
   }
   .contnr_main_headr.hedr_fixed{
   position: static;
   box-shadow: 0px 0px 0px #fff;
   }
   .hide_data{
    display: none;
  }
  .show_data{
    display: block;
  }

  .left_cart_box{
    width: 98%;
    margin-left: 1%;
  }

  .right_cart_box{
    margin-right: 1%;
    margin-top: 20px;
    width: 25%;
  }
  .th_crt6{
    border-left: 1px solid;
  }


  .th_crt4 .qty-changer_cart {
    margin-top: 30px !important;
  }
  .cart-section tbody tr td h2{
    margin-top: 20px;
  }

  body{
    background:#f8fbfd;
  }

  .cart_pg_titl h2{
        font-weight: 800 !important;
    text-transform: uppercase;
  }

  .container.container_detl_wdth{
    padding:0px;
  }

  .row.hide_cart_div{
        float: left;
    width: 100%;
    margin-top: -30px;
  }

</style>
<?php
 if(!empty($data)){
  $hide="hide_data";
 }else {
  $hide="show_data";
 } ?>


<!--section start-->
<section class="cart-section section-b-space" style="padding-top: 20px;" >
    <div class="page-title cart_pg_titl">
       <h2><?php echo lang('VIEW_CART'); ?></h2>
    </div>
    <?php if(!empty($data)){ ?>
    <div class="radio-option hide_cart_div viewcrt_optn_pymnt">
      <!-- <div class="slct_pynt_ethd">
        Select Payment Method
      </div> -->
      <div class="clear"></div>
      <!-- <div class="cliclb_pymnt" >
      <input type="radio" value="<?php //echo en_de_crypt('cash-on-del'); ?>" name="payment_mode" id="ck_cod">
      <label for="ck_cod">Virtual Account Transfer</label>
      </div>
      <div class="cliclb_pymnt" >
      <input type="radio" value="<?php //echo en_de_crypt('online'); ?>" name="payment_mode" id="ck_online">
      <label for="ck_online">Credit Card<span class="image">
      </span></label>
      </div> -->
      <div class="clear"></div>
   </div>
   <?php } ?>
                                       
   <div class="container container_detl_wdth">
       <h1 class="<?php echo $hide; ?> text-center text-danger"><?php echo lang('YOUR_SHOPPING_CART_IS_EMPTY'); ?></h1>
        <div class="col-6 <?php echo $hide; ?>"><a href="<?php echo base_url($language.'/home/listing/1'); ?>" class="btn btn-solid pull-left"><?php echo lang('continue_shopping'); ?></a></div>
      <?php if(!empty($data)){ ?>
      <div class="row hide_cart_div">
         <div class="col-sm-12">

            <div class="left_cart_box" >
            <table class="table cart-table table-responsive-xs ">
               <thead>
                  <tr class="table-head">
                     
                     <th scope="col" class="th_crt2" style="padding-left: 60px; text-align: left;" ><?php echo lang('Items'); ?></th>
                     <!-- <th scope="col" class="th_crt3" >product name</th> -->
                     <!-- <th scope="col" class="th_crt4" style="padding-right: 60px;" >Unit</th> -->
                     <th scope="col" class="th_crt4" style="padding-right: 0px; text-align: left; padding-left: 45px;" ><?php echo lang('quantity'); ?></th>
                     <th scope="col" class="th_crt5" ><?php echo lang('Price'); ?></th>
                     <th scope="col" class="th_crt5" ><?php echo lang('fees'); ?> </th>
                     <th scope="col" class="th_crt5" ><?php echo lang('VAT'); ?> </th>
                     <th scope="col" class="th_crt6" ><?php echo lang('total'); ?></th>
                  </tr>
               </thead>
                <?php
                 $grand_total=$grand_total_inc=0;                               
                 foreach ($data as $d_key => $dvalue) {                              
                  // echo "<pre>";
                  // print_r($data);
                  // die;
                    $pid=$dvalue['p']['id'];
                    $qty=$dvalue['c']['qty'];
                    $unit=$dvalue['c']['unit'];
                    $price=$dvalue['p']['sale_price'];
                    $pro_total=$price*$qty;
                    $vat=$tax_table[0]['vat'];
                    // $grand_total=$pro_total+$grand_total;                              

                    $commission=$tax_table[0]['commission'];
                    $single_commission=($commission*$pro_total)/100;
                    if($single_commission>$tax_table[0]['cap_rate'])
                    {
                      $single_commission=$tax_table[0]['cap_rate'];
                    }
                    $pro_total=$pro_total+$single_commission;
                    $single_vat=($vat*$pro_total)/100;
                    $pro_total=$pro_total+$single_vat;

                  $product_image=explode("/",$dvalue['p']['product_image']);
                  $product_image=count($product_image);
                  if ($product_image==1) 
                  {
                   $image_url=base_url("assets/admin/products/").$dvalue['p']['product_image'];
                  }else{
                   $image_url=$dvalue['p']['product_image'];  
                  }                               
                         
                         $grand_total_inc=$pro_total+$grand_total_inc;
                         // $shipping_charge=$tax_table[0]['shipping_charge'];
                         // $commission_calulated=($commission*$grand_total)/100;
                         // $grand_total=$grand_total+$commission_calulated;  
                         // $vat_calulated=($vat*($grand_total))/100;  
                         // $grand_total_inc=$grand_total+$vat_calulated+$commission_calulated;
                         // +$shipping_charge   
               ?>
               
               <tr class="remove_pro<?php echo $dvalue['key']; ?>">
                

                  <td class="th_crt2" >

                    <div class="img_sec_lft" >
                      <a data-toggle="tooltip" title="<?php echo lang('Remove'); ?>" href="javascript:void(0)" class="icon delete_pro" data-id="<?php echo $dvalue['key']; ?>"><i class="fa fa-times-circle"></i></a>
                     <a href="<?php echo base_url($language.'/home/detail/').$dvalue['p']['id']; ?>"><img src="<?php echo base_url('assets/admin/products/').$dvalue['p']['product_image']; ?>" alt=""></a>   
                     <div class="clear"></div>
                      
                      <div style="margin-top: 10px;">
                      <span style="display: none" class="wishlist<?php echo $pid; ?>">
                      <?php if(@$dvalue['p']['wish_list']==1){  ?>
                      <a style="margin-right: 7px;" data-toggle="tooltip" title="Move To Wishlist" href="javascript:void(0)" class="icon" data-id="" onclick="remove_cart('<?php echo $pid; ?>','view_cart')">                 
                        <img src="<?php echo base_url();?>assets/frontend/images/wish_icon.png" class="wishl_a_crt" >
                      </a>
                      <?php }else{ ?>
                       <a style="margin-right: 7px;" data-toggle="tooltip" title="Move To Wishlist" href="javascript:void(0)" class="icon" data-id="" onclick="move_to_wish_list('<?php echo $pid; ?>','view_cart')">
                        <img src="<?php echo base_url();?>assets/frontend/images/wish_icon.png" class="wishl_a_crt" >             
                      </a> 
                      <?php } ?>
                      </span>                    
                       
                    </div>

                  </div>

                  <div class="nme_sec_right" >
                    <a class="prdct_name_cart" href="<?php echo base_url($language.'/home/detail/').$dvalue['p']['id']; ?>"> <span> <?php echo $dvalue['p']['product_name']; ?> </span> </a>
                     <?php  if( isset($dvalue['c']['metadata']) && !empty($dvalue['c']['metadata']) ) {  ?>
                        <br>
                        <span class="size_cart_m" >Size:<?php echo $dvalue['c']['metadata']['size']; ?></span>
                    <?php } ?> 

                    <?php if(!empty($dvalue['p']['unit_list'])){ ?>
                     <select class="form-control select_unit  unite1 change_unit" >
                     <?php 
                        foreach ($dvalue['p']['unit_list'] as $uld_key => $uld_value) { 
                           $unit_selected = ($unit == $uld_value['id'] ) ? "selected" : "";
                          ?>
                         <option data-pid="<?php echo $pid; ?>" data-unitid="<?php echo $uld_value['id'] ?>" data-key="<?php echo $dvalue['key']; ?>" <?php echo $unit_selected; ?>><?php echo $uld_value['unit_name']; ?></option>                            
                     <?php  } ?>
                     </select> 
                     <?php } ?>   

                  </div>

                  </td>
                 <!--  <td class="th_crt3" > </td> -->
                    <!-- <h2>liter</h2> -->
                  <!-- <td class="th_crt4" > </td> -->
                 
                  <td class="th_crt4" > 
                    <div class="qty qty-changer qty-changer_cart">
                        <fieldset>
                           <span type="button" value="‒"  class="decrease" onclick="productQty(this)" data-target="<?php echo $dvalue['key']; ?>" data-key="<?php echo $dvalue['key']; ?>" data-sale-value="<?php echo decnum($price); ?>" data-product-id="<?php echo $pid; ?>"></span> 
                           <input type="text" class="qty-input" value="<?php echo $qty; ?>" data-min="1" data-max="10" id="<?php echo $dvalue['key']; ?>" data-value="<?php echo $qty ?>" disabled> 
                           <span type="button" value="+" class="increase" onclick="productQty(this)" data-target="<?php echo $dvalue['key']; ?>" data-key="<?php echo $dvalue['key']; ?>" data-sale-value="<?php echo decnum($price); ?>" data-product-id="<?php echo $pid; ?>"></span>
                       </fieldset>
                     </div>
                  </td>
                  <td class="th_crt5" >
                     <h2><?php echo $currency_symbol; ?> <span  id="qp<?php echo $dvalue['key']; ?>"><?php echo decnum($price*$qty); ?></span> </h2>
                      
                  </td>

                  <td class="th_crt5" >
                     <h2 id="c<?php echo $dvalue['key']; ?>">
                      <?php echo decnum($single_commission); ?>
                     </h2>
                      
                  </td>

                   <td class="th_crt5" >
                     <h2>
                      <?php echo $vat; ?>%
                     </h2>
                      
                  </td>
                  
                  <td class="th_crt6" >   
                     <h2 class="td-color"><?php echo $currency_symbol; ?> <span id="p<?php echo $dvalue['key']; ?>"><?php echo decnum($pro_total); ?></span> </h2>
                  </td>   
               </tr>                          
              <?php } ?>
            </table>
            </div>
            
            <div style="float: left; margin-right: 0px; padding: 0px; font-size: 13px; font-weight: 600; margin-top: -31px; padding-top: 30px; width: 100%;">

              
              
              <span  style="margin-left: 0px; padding-top: 21px; font-size: 20px; text-transform: uppercase; display: inline-block; float: right; width: 13.9%; text-align: center;"><?php echo $currency_symbol; ?> <span class="total_sale_price"><?php echo decnum($grand_total_inc); ?></span></span>
              <span style="border-right: 1px solid #e7e7e7; height: 74px; position: static; margin-left: 0px; float: right;"></span>

              <span style="margin-right: 17px; padding-top: 21px; font-size: 20px; text-transform: uppercase; display: inline-block; float: right;"><?php echo lang('Sub_total'); ?></span>

            </div>
          
            <!-- <div class="product-right product-form-box right_cart_box">
               <div class="subtotl_labl_tb" >Subtotal Price :</div>
               <div>
                        <h2><?php //echo $currency_symbol; ?> <span class="total_sale_price"><?php //echo decnum($grand_total_inc); ?></span> </h2>
               </div>
            </div> -->


               <div class="clear"></div>
            
         </div>
      </div>
      <div class="clear"></div>

      <div class="row cart-buttons hide_cart_div">
         <!-- <div class="col-6"><a href="<?php //echo base_url($language.'/home/listing/1'); ?>" class="btn btn-solid pull-left">continue shopping</a></div> -->



         <div class="col-6" style="display: none"><a id="vc_addlink" href="<?php echo base_url($language.'/home/checkout'); ?>" class="btn btn-solid"><?php echo lang('CHECKOUT'); ?></a></div>
         <!-- <div class="col-12"> -->
          <a style="margin-right: 4%; position: absolute; margin-top: 6px; float: right; right: 0; " href="<?php echo base_url($language.'/home/checkout_1/'); ?>" id="vc_out" class="btn btn-solid"><?php echo lang('CHECKOUT'); ?></a>
         <!-- </div> -->
        
      </div>
      <?php } ?>

   </div>
</section>
<!--section end-->

<script type="text/javascript">
   $(document).on('click', '.decrease, .increase', function (e) {
            var $this = $(e.target),
               input = $this.parent().find('.qty-input'),
               v = $this.hasClass('decrease') ? input.val() - 1 : input.val() * 1 + 1,
               min = input.attr('data-min') ? input.attr('data-min') : 1,
               max = input.attr('data-max') ? input.attr('data-max') : false;
            if (v >= min) {
               if (!max == false && v > max) {
                  return false
               } else input.val(v);
            }
            e.preventDefault();
         });
</script>
<script type="text/javascript">
  $(document).on("click","#vc_out1",function()
  {
    var payment_mode=$('input[name=payment_mode]:checked').val();
    var error=1;    
    if(typeof payment_mode === "undefined" ) 
    {
        swal("","Select Payment Option","warning");
        error=0;
        return false;
    }else{
      var ck_link="<?php echo base_url($language.'/home/checkout/'); ?>"+payment_mode;
      $("#vc_addlink").attr("href",ck_link);
      $("#vc_addlink")[0].click()      
    }

  });
</script>
<script type="text/javascript">
    // var qty = -1;
    var shipping_charg=<?php echo $tax_table[0]['shipping_charge'] ?>;
    var vat=<?php echo $tax_table[0]['vat'] ?>;
    var commission=<?php echo $tax_table[0]['commission'] ?>;
    var cap_rate=<?php echo $tax_table[0]['cap_rate'] ?>;
    function productQty(e)
    {
        // alert(vat);
        // return false;
            
        var op = jQuery(e).attr("class");
        // alert(op);
        var target = jQuery(e).attr("data-target"); 
        //alert(target);    
        var key = jQuery(e).attr("data-key");
        var pid = jQuery(e).attr("data-product-id");
        qty = jQuery('#'+target).attr('data-value');      
        //alert(qty);
        var old_qty = qty;
        var newqty = qty;        
        // var sv = jQuery('#sv'+target).val();
        // var pv = jQuery('#pv'+target).val();      
        // var tax_rate = jQuery('#tax'+target).val();
        // var save_amt = parseFloat( jQuery('#save_amt').text() );      
        var sale_price = parseFloat(jQuery(e).attr('data-sale-value'));
        var sale_prices=sale_price;  
        // var price4= parseFloat (jQuery('.total_sale_price2').text());                     
        var price4= parseFloat (jQuery('.total_sale_price').text());                     
        // alert(Number.isInteger(shipping_charg));    
        // return false;
         // alert(price4);           
        var status = true;
          if(op == 'decrease'){
              if(qty>1){
                  qty--;
                  newqty = -1;
              }
              else{
                status = false;
              }
          }
          else{
              qty++;
              newqty = qty;
          }
          // cqty:qty                   
        if (status) {
          $('#loading').show();
          $.ajax({
              type: 'POST',
              url: "<?php echo base_url('my_cart/updat_cart') ?>",
              data: {pid:pid,qty:newqty,append:target},
              success: function(response){
                $('#loading').hide(); 
                // alert(response);
                // return false;               
                var response = $.parseJSON(response);                
                  if (response.message == 'quantity_not_avilable')
                  {    
                    // alert('current'+qty);  
                    swal("","<?php echo lang('Not_Enough_Stock'); ?>",'warning');                
                    if(newqty==-1)
                    {                      
                      $("#"+target).val(qty-newqty);                      
                      setTimeout(function(){ location.reload(); }, 2000);
                    }else{                      
                    $("#"+target).val(newqty-1);
                    }                    

                  }else if (response.message=='time_limit'){                  
                  swal("","Shope close please order between Sun-Thu... 11.30AM -11.30PM Fri-Sat....... 8:30AM – 11:30PM ",'warning');
                }else if(response.message=='not_added_tocart'){
                  swal("","<?php echo lang('Product_Not_Found'); ?>",'warning');
                  setTimeout(function(){ location.reload(); }, 2000);
                }else if(response.message=='product_deactive'){
                  swal("","<?php echo lang('This_product_is_deactivated_by_admin'); ?>",'warning');
                  setTimeout(function(){ remove_ok(target); }, 2000);                   
                }else if(response.message=='min_order'){
                  $("#"+target).val(old_qty);
                  swal("",response.message2,'warning');
                  // setTimeout(function(){ location.reload(); }, 2000);
                }
                else
                  {
                    // view_cart_count(); 
                     //alert(response);
                      // jQuery('#s'+target).text(sv*qty);
                      // jQuery('#p'+target).text(pv*qty);
                      var res = qty - old_qty;
                      // var save = pv - sv;
                      var trans_amt = 0;                      
                      
                      jQuery('#'+target).attr('data-value',qty);
                      // jQuery('#'+target).text(qty);
                      jQuery('#'+target).val(qty);
                      jQuery('#qty'+target).text(qty);

                      var total_sale_price=parseFloat(qty*sale_prices);
                      
                      var qty_into_price=parseFloat(qty*sale_prices);
                      single_commission=(commission*total_sale_price)/100;                      
                      if(single_commission>cap_rate)
                      {                        
                        single_commission=cap_rate;
                        // alert(single_commission);
                      }
                      single_vat=(vat*(total_sale_price+single_commission))/100;
                      total_sale_price=total_sale_price+single_vat+single_commission;
                      // alert(Number.isInteger(total_sale_price));
                      jQuery('#p'+target).text(total_sale_price.toFixed(2));
                      jQuery('#c'+target).text(single_commission.toFixed(2));
                      jQuery('#qp'+target).text(qty_into_price.toFixed(2));
                      if(op == 'decrease') {                        
                        // sppc=((commission*sale_prices)/100);            
                        // sppc=sale_prices+sppc;
                        // sppv=((vat*sppc)/100);
                        // tsppvc=sppv+sppc;                        
                        // value8=price4-tsppvc;
                        
                        // vat_calulated=(vat*value8)/100;                      
                        // value8=price4-sale_prices;
                        // jQuery('.total_sale_price2').text(parseFloat(value8.toFixed(2)));
                        // jQuery('#vat_add').text(parseFloat(vat_calulated.toFixed(2)));
                        // var ship_pprice=value8+shipping_charg+vat_calulated;
                        // var ship_pprice=value8+vat_calulated;
                        jQuery('.total_sale_price').text(response.cart_sub_total);                     
                        // jQuery('.total_sale_price_new').text(parseFloat(value8.toFixed(2)));                     
                        // jQuery('.total_sale_price_inc').text(parseFloat(ship_pprice.toFixed(2)));                     
                      } else {
                        // value8=price4+sale_prices;
                        // value8=price4+sale_prices;
                        // vat_calulated=(vat*value8)/100;                                          sppc=((commission*sale_prices)/100);                                        
                        // sppc=sale_prices+sppc;                        
                        // sppv=((vat*sppc)/100);                        
                        // tsppvc=sppv+sppc;          
                        // value8=tsppvc+price4;
                        // jQuery('.total_sale_price2').text(parseFloat(value8.toFixed(2)));
                        // jQuery('#vat_add').text(parseFloat(vat_calulated.toFixed(2)));
                        // var ship_pprice=value8+shipping_charg+vat_calulated;
                        // var ship_pprice=value8+vat_calulated;
                        jQuery('.total_sale_price').text(response.cart_sub_total);
                        // jQuery('.total_sale_price_new').text(parseFloat(value8.toFixed(2)));
                        // jQuery('.total_sale_price_inc').text(parseFloat(ship_pprice.toFixed(2)));
                      }
                  }
              }
          });
        }        
    } 
</script>   

<script type="text/javascript">
    function remove_me(pid)
    {
        swal({
          title: "",
          text: "<?php echo lang('Do_You_Want_To_Delete_This_Product_From_Car'); ?>",
          type: "warning",
          showCancelButton: true,
          closeOnConfirm: false,
          showLoaderOnConfirm: true,
          confirmButtonText: "<?php echo lang('Yes'); ?>",
           cancelButtonText: "<?php echo lang('Cancel'); ?>",
        },
        function(){  
        $('#loading').show();    
         remove_ok(pid);
        });
    }

    $(document).on("click",".delete_pro",function()
    {        
      var pid=$(this).data("id");     
      // alert(pid);         
      remove_me(pid);
    }); 
  function remove_ok(pid)
  {
    if(pid!=''){
      $.ajax({
              type: 'POST',
              url: '<?php echo base_url('my_cart/remove_from_cart'); ?>',
              data: {pid:pid},
              success: function(response)
              {              
                $('#loading').hide();
                  if (response == 'some'){                    
                      swal("","<?php echo lang('Something'); ?>");
                  }else{
                    var data = $.parseJSON(response);   
                    var pro_count=data['pro_count'];
                    // var total_price=data['total_price'];
                    pro_price=parseFloat($('#p'+pid).text());
                    // total_price= parseFloat (jQuery('.total_sale_price2').text());
                    total_price= parseFloat (jQuery('.total_sale_price').text());
                    // alert(total_price);
                    // alert(pro_price);
                    total_price=total_price-pro_price;
                    // alert(total_price);
                    // vat_cal=(total_price*vat)/100;                    
                    // alltotal_price=total_price+vat_cal+shipping_charg;
                    // view_cart_count();   
                    total_price=total_price.toFixed(2);
                    // alert(total_price);
                    alltotal_price=total_price;
                    if(pro_count==0)
                    {
                      $(".hide_data").show();
                      $(".hide_cart_div").hide();
                      swal("<?php echo lang('Deleted'); ?>", "<?php echo lang('Product_Deleted_Successfully'); ?>", "success");
                      $(".remove_pro"+pid).remove();
                      $(".cart_show").text(pro_count);
                    }else {
                      swal("<?php echo lang('Deleted'); ?>", "<?php echo lang('Product_Deleted_Successfully'); ?>", "success");
                      $(".remove_pro"+pid).remove();                         
                      // $('.total_sale_price2').text(total_price);
                      // $('.total_sale_price').text(total_price+shipping_charg);
                      // $('.total_sale_price2').text(total_price);
                      // $('#vat_add').text(vat_cal);
                      $('.total_sale_price').text(alltotal_price);
                      // $('.total_sale_price_new').text(alltotal_price);
                      $(".cart_show").text(pro_count);
                    }                     
                  }
              }
        });      
    }else{
      swal("","<?php echo lang('Something'); ?>",'warning');
    }
  }  
</script>    


<script type="text/javascript">
  $(document).on("change",".change_unit",function(){
    // var pid=$(this).attr("data-pid"); 
    // var append=$(this).attr("data-key"); 
    // var unitid=$(this).attr("data-unitid"); 
    // var price=$(this).attr("data-price"); 
    var pid=$(this).find(':selected').attr('data-pid');
    var append=$(this).find(':selected').attr('data-key');
    var unit=$(this).find(':selected').attr('data-unitid');
    var qty=$('#'+append).val();      
    
    // alert(pid);
    // alert(append);
    // alert(unitid);
    // alert(qty);
    // alert(price);
    // return false

    $('#loading').show();
    $.ajax({
        type: 'POST',        
        url: '<?php echo base_url('my_cart/updat_cart'); ?>',
        data: {pid:pid,qty:qty,append:append,'unit':unit},
        success: function(response)
        {
          var response = $.parseJSON(response);            
          if(response.status==true)
          {
            swal("","Unit chagne successfully","success");
            setTimeout(function(){ location.reload(); }, 1500);
          }else if(response.message=='invalid_unit_id')
          {
            $('#loading').hide();
            swal("","Please select valid uint id","warning");
          }else{
            $('#loading').hide();
            swal("","Something went wrong","warning");
          }
        }
    });
});        
</script>
