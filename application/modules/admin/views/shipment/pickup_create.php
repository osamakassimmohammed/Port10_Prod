<div class="col-md-12" style="float: right;    margin-bottom: 0px;    height: 10px; margin-top: -10px;">
   <a href="<?php echo base_url($language) ?>/admin/product/list1" class="back_button"><?php echo lang('aBack_To_List'); ?></a>
</div>

<br>


<style type="text/css">
   .hsm_price,
   .hss_price {
      display: none;
   }


   .chosen-container-single .chosen-single {

      border-radius: 100px;
      background: #fff;
      box-shadow: 0px 0px 0px;
      border: 1px solid #cdcdcd;
   }
</style>

<?php echo $form->messages();
$product_name = $description = $price = $tax = $status_deactive = $sale_price = $editcategory = $editsellerorders = $tags = $short_description = $transaction_cost = $stock_deactive = $stock = $shipping_cost = $product_image = $image_gallery = $special_menu = $price_select = $brand = $specification = $shipment_by = $min_order_quantity = $is_delivery = $is_sample = $editseller_id = $packaging_type = $weight = $length = $width = $height = $warehouse_location = $city = $lat = $lng = $is_hazardous = $hazardous_specify = $req_loading = $vehical_requirement = $sku_code = $weight_unit = '';
$product_attribute = $unite = array();
$image = array();
if (isset($edit)) {
   $packaging_type = $edit->packaging_type;
   $weight = $edit->weight;
   $length = $edit->length;
   $width = $edit->width;
   $height = $edit->height;
   $warehouse_location = $edit->warehouse_location;
   $city = $edit->city;
   $lat = $edit->lat;
   $lng = $edit->lng;
   $is_hazardous = $edit->is_hazardous;
   $vehical_requirement = $edit->vehical_requirement;
   $weight_unit = $edit->weight_unit;
   $hazardous_specify = $edit->hazardous_specify;
   $req_loading = $edit->req_loading;


   $short_description = $edit->short_description;
   $product_name = $edit->product_name;
   $price = $edit->price;
   // $tax = $edit->tax;
   $description = $edit->description;
   $product_image = $edit->product_image;
   $image_gallery = $edit->image_gallery;
   $sale_price = $edit->sale_price;
   $sku_code = $edit->sku_code;
   $min_order_quantity = $edit->min_order_quantity;
   $is_delivery_available = $edit->is_delivery_available;
   if ($is_delivery_available == 1) {
      $is_delivery = "checked";
   }
   $is_sample_order = $edit->is_sample_order;
   if ($is_sample_order == 1) {
      $is_sample = "checked";
   }
   //
   // $shipping_cost = $edit->shipping_cost;
   $editcategory = $edit->category;
   $editsellerorders = $edit->seller_orders;
   $editsub_category = $edit->subcategory;
   $editseller_id = $edit->seller_id;
   // $editsub_sub_category = $edit->sub_sub_category;
   $stock = $edit->stock;
   $tags = $edit->tags;
   $price_select = $edit->price_select;
   $brand = $edit->brand;
   if (!empty($edit->unite)) {
      $unite = explode(',', $edit->unite);
   }
   $specification = $edit->specification;
   $shipment_by = $edit->shipment_by;


   if ($price_select == 1) {
      $selected_singhle = "selected";
      $selected_multi = "";
      echo "<style> .hss_price{ display:block; } </style>";
   } elseif ($price_select == 2) {
      $selected_singhle = "";
      $selected_multi = "selected";
      echo "<style> .hss_price{ display:block; } </style>";
      echo "<style> .hsm_price{ display:block; } </style>";
      echo "<style> .hs_qty{ display:none; } </style>";
   }
   $price_select_dis = 'disabled';
   $stock_active = $edit->stock_status == 'instock' ? 'checked' : '';
   $disabled = $edit->stock_status == 'instock' ? '' : 'disabled';
   $stock_deactive = $edit->stock_status == 'notinstock' ? 'checked' : '';
   $status_active = $edit->status == '1' ? 'checked' : '';
   $status_deactive = $edit->status == '0' ? 'checked' : '';
   // $special_menu = $edit->special_menu == '1' ? 'checked' : '';
} else {
   $status_active = 'checked';
   $stock_active = 'checked';
   $selected_singhle = "";
   $selected_multi = "";
   $price_select_dis = '';
   $sled_cus_list = array();
}

if ($seller_id == 1) {
   $sel_class = "col-sm-4";
} else {
   $sel_class = "col-sm-6";
}

if ($is_hazardous == "Yes") {
   $is_hazardous_class = "";
} else {
   $is_hazardous_class = "display:none";
}
$required = 'required';
if (empty($stock_deactive) && empty($stock_active))
   $stock_deactive = 'checked';
?>

<div class="row clearfix">
   <div class="col-md-12">
      <div class="demo-masked-input">
         <?php echo $form->open(); ?>

         <?php if (!empty($supplier_data) && $seller_id == 1) { ?>
            <div class="<?php echo $sel_class; ?>" style="">
               <label for="category">Select Supplier</label>
               <select placeholder="" id="seller_id" name="seller_id">
                  <option value="0">Select Supplier</option>
                  <?php
                  foreach ($supplier_data as $sd_key => $sd_val) {
                     $is_supplier = ($editseller_id == $sd_val['id']) ? "selected" : "";
                     ?>
                     <option value="<?php echo $sd_val['id']; ?>" <?php echo $is_supplier; ?>><?php echo $sd_val['first_name']; ?></option>
                  <?php } ?>
               </select>
            </div>
         <?php } ?>

         <?php if (!empty($supplier_data) && $seller_id == 1) { ?>
            <div class="<?php echo $sel_class; ?> col-sm-3">

               <label for="seller_orders">
                  <?php echo lang('aOrders'); ?>
               </label>
               <select id="main_seller_orders_admin" name="seller_orders">

               </select>
            </div>
         <?php } ?>

         <?php if (!empty($supplier_data) && $seller_id != 1) { ?>
            <div class="<?php echo $sel_class; ?> col-sm-3">

               <label for="seller_orders">
                  <?php echo lang('aOrders'); ?>
               </label>
               <select id="main_seller_orders" name="seller_orders" class="get_sub_seller_orders">
                  <?php
                  if (!isset($edit)) { ?>
                     <option value="0">
                        <?php echo lang('Select_Order'); ?>
                     </option>
                  <?php } ?>
                  <?php
                  if (!empty($seller_orders)) {
                     echo "<pre>";
                     print_r($seller_orders);
                     foreach ($seller_orders as $ckey => $cvalue) {
                        $seller_orders = ($editsellerorders == $cvalue['order_no']) ? "selected" : "";
                        ?>
                        <option value="<?php echo $cvalue['order_no']; ?>" <?php echo $seller_orders; ?>><?php echo $cvalue['order_no']; ?></option>
                        <?php
                     }
                  }

                  ?>
               </select>
            </div>
         <?php } ?>
         <div class="col-sm-9">

            <div class="form-group form-float form-group-lg">
               <div class="form-line">
                  <div id="result"></div>
               </div>
            </div>
         </div>




         <div class="clear"></div>

         <div class="col-sm-3">
            <label for="ShippingDateTime">
               <?php echo lang('Please_select_shipping_date_time'); ?>
            </label>
            <input type="datetime-local" id="ShippingDateTime" min="<?php echo gmdate(""); ?>"
               max="<?php echo gmdate("Y-m-d\TH:i:s", strtotime('+7 days')); ?>" name="ShippingDateTime" required>
         </div>
         <div class="col-sm-3">
            <label for="DueDate">
               <?php echo lang('Please_select_due_date'); ?>
            </label><br>
            <input type="datetime-local" id="DueDate" min="" name="DueDate" required>
         </div>
         <div class="col-sm-3">
            <label for="PickupDate">
               <?php echo lang('Please_select_pickup_date'); ?>
            </label><br>
            <input type="datetime-local" id="PickupDate" min="<?php echo gmdate(""); ?>" max="" name="PickupDate"
               required>
         </div>
         <div class="col-sm-3">
            <label for="ReadyTime">
               <?php echo lang('Please_select_ready_time'); ?>
            </label><br>
            <input type="datetime-local" id="ReadyTime" name="ReadyTime" min="" max="" required>
         </div>
         <div class="col-sm-3">
            <label for="LastPickupTime">
               <?php echo lang('Please_select_last_pickup_time'); ?>
            </label><br>
            <input type="datetime-local" id="LastPickupTime" name="LastPickupTime" min="" required>
         </div>
         <div class="col-sm-3">
            <label for="ClosingTime">
               <?php echo lang('Please_select_closing_time'); ?>
            </label><br>
            <input type="datetime-local" id="ClosingTime" name="ClosingTime" min="" required>
         </div>
         <div class="col-sm-4">
            <div class="form-group">
               <label for="groups">
                  <?php echo lang('aStatus'); ?>
               </label>
               <div>
                  <?php echo $form->bs3_radio(lang('aPending'), 'status', 'Pending', array('required' => '', 'id' => "radio1"), $status_active); ?>
                  <?php echo $form->bs3_radio(lang('aReady'), 'status', 'Ready', array('required' => ''), $status_deactive); ?>
               </div>
            </div>
         </div>





         <!-- <div class="col-sm-4">
               <label for="warehouse_location"><?php echo "Pickup location"; ?></label>
               <input type="text" name="pickup_location" value="" placeholder="<?php echo lang('aPickup_location'); ?>" id="searchInput" autocomplete="off" class="form-control space">
            </div>
            <div style="width: 80%;padding: 10%;border: 3px solid black;display:none"  id="map2"></div> -->

         <div class="col-sm-12" style="padding: 5px;">
            <button type="submit" class="btn btn-primary">
               <?php echo lang('aSubmit'); ?>
            </button>
         </div>
         <!-- <?php echo $form->bs3_submit(); ?> -->
         <?php echo $form->close(); ?>
      </div>
   </div>
</div>

<?php if ($product_image): ?>
   <script type="text/javascript">$("#product_image_hide").hide();</script>
<?php endif ?>




<script type="text/javascript">

   $(document).ready(function ($) {
      $("#seller_id").on('change', function () {
         var level = $(this).val();
         var options = '';
         console.log(level);
         if (level) {
            $.ajax({
               type: 'POST',
               url: '<?php echo base_url('admin/shipments/get_seller_orders'); ?>',
               data: {
                  level: level
               },
               success: function (response) {
                  $("#loading").hide();
                  var html = '';
                  if (response == 0) {
                     swal("", "Something went worng", "warning");
                  } else if (response == "not_found") {
                     // alert("yes2");
                     $('#main_seller_orders_admin').prop('disabled', true).trigger("chosen:updated");
                     // $('#shope_sub_category').prop('disabled', false).trigger("chosen:updated"); 
                  } else {
                     var response = $.parseJSON(response);
                     // alert("yes");
                     html += "<option value='0'>Select Oder Number</option>";
                     $.each(response, function (k, v) {
                        html += "<option   value='" + v.order_no + "'>" + v.order_no + "</option>";
                     });
                     $('#main_seller_orders_admin').prop('disabled', false).trigger("chosen:updated");
                     $("#main_seller_orders_admin").html(html);
                     $('#main_seller_orders_admin').trigger('chosen:updated');
                  }
               }
            });
         }
      });
   });

   $(document).ready(function ($) {
      $("#main_seller_orders").on('change', function () {
         var order_no = $(this).val();
         if (order_no) {
            $.ajax({
               type: 'POST',
               url: '<?php echo base_url('admin/shipments/getdataOrder'); ?>',
               data: { order_no: order_no },
               success: function (data) {
                  $('#result').html(data);
                  //   console.log(data);
               }
            });
         }
      });
   });


   var Price_flag;
   var yourArray = [];
   <?php
   if (isset($edit)) {
      foreach ($product_attribute as $key => $value2) { ?>
         value2 = <?php echo $value2; ?>;
         value2 = value2.toString();
         yourArray.push(value2);
      <?php } ?>
   <?php } ?>

   $(document).on('change', '#select_size20', function (event, params) {
      <?php if (!isset($edit)) { ?>
         var val = $(this).val();
         var deselected_val = params.deselected;
         var selected_val = params.selected;
         if (typeof (deselected_val) != "undefined") {

            var deselected_val = deselected_val.split(",");
            var size_id = deselected_val[0];
            var size_name = deselected_val[1];
            if ($.inArray(size_id, yourArray) != -1) {
               for (var i = 0; i < yourArray.length; i++) {
                  if (yourArray[i] === size_id) {
                     yourArray.splice(i, 1);
                  }
               }
               $("#attribute2").val(yourArray);
            }
            $("#" + size_id).remove();
         }
         if (typeof (selected_val) != "undefined") {
            var selected_val = selected_val.split(",");
            var size_id = selected_val[0];
            var size_name = selected_val[1];
            yourArray.push(size_id);
            $("#attribute2").val(yourArray);
            var opt = '<div class="shattbute" id="' + size_id + '"><label class="attribute_p">' + size_name + '</label> <label>Qty<input type="text" name="attribute_qty[]" class="form-control" value="" required="required"></label> <label style="display:none">id size<input type="text" name="attribute_id_size[]" class="form-control" value=""></label>  <label style="display:none">Our Food Price<input type="text" name="attribute_price[]" class="form-control" value=""></label><label style="display:none" class= "attribute_p">Market Price<input type="text" class="form-control" name="attribute_sale_price[]" value=""></label></div>';
            $("#sub_cat_listing").append(opt);
         }

      <?php } else { ?>
         var val = $(this).val();
         // var item_name=$(this).find(':selected').attr('data-id');
         // alert($(this).find(":selected").data("id"));

         var deselected_val = params.deselected;
         var selected_val = params.selected;


         if (typeof (deselected_val) != "undefined") {
            var deselected_val = deselected_val.split(",");
            var size_id = deselected_val[0];
            var size_name = deselected_val[1];
            size_id = size_id.toString();

            if ($.inArray(size_id, yourArray) != -1) {
               for (var i = 0; i < yourArray.length; i++) {
                  if (yourArray[i] === size_id) {
                     yourArray.splice(i, 1);
                  }
               }
               $("#attribute2").val(yourArray);
            }
            $("#" + size_id).remove();
         }
         if (typeof (selected_val) != "undefined") {
            var selected_val = selected_val.split(",");
            var size_id = selected_val[0];
            var size_name = selected_val[1];
            yourArray.push(size_id);
            $("#attribute2").val(yourArray);
            var opt = '<div id="' + size_id + '"><label class="attribute_p">' + size_name + '</label> <label>Qty<input type="text" name="attribute_qty[]" class="form-control" value="" required="required"></label> <label style="display: none">Id size<input type="text" name="attribute_id_size[]" class="form-control" value=""></label> <label style="display: none">Our Price<input type="text" name="attribute_price[]" class="form-control" value=""></label><label style="display: none">Market Price<input type="text" class="form-control" name="attribute_sale_price[]" value=""></label></div>';
            $("#sub_cat_listing").append(opt);
         }
      <?php } ?>

   });
</script>




<style type="text/css">
   .col-sm-6.Color {
      display: none;
   }

   .col-sm-6.Size {
      margin-bottom: 0px !important;
   }

   li.disabled {
      display: none !important;
   }
</style>


<script type="text/javascript">


   $(document).ready(function () {
      $("#ShippingDateTime").change(function () {
         // alert( this.value );
         $("#DueDate").attr({
            'min': this.value
         });
      });
   });

   $(document).ready(function () {
      $("#ShippingDateTime").change(function () {
         // alert( this.value );
         $("#PickupDate").attr({
            'max': this.value
         });
      });
   });

   $(document).ready(function () {
      var date1 = '';
      var maxDate = '';
      $("#PickupDate").change(function () {
         date1 = new Date(Date.parse(this.value));
         maxDate = new Date(date1.setHours(23, 59, 59, 999)).toISOString();

         $("#ReadyTime").attr({
            'min': this.value,
            // 'max':maxDate,
         });
      });
   });

   $(document).ready(function () {
      $("#PickupDate").change(function () {
         // alert( this.value );
         $("#ClosingTime").attr({
            'min': this.value,
         });
      });
   });

   $(document).ready(function () {
      $("#PickupDate").change(function () {
         // alert( this.value );
         $("#LastPickupTime").attr({
            'min': this.value,
         });
      });
   });

   jQuery('body').on({ 'drop dragover dragenter': dropHandler }, '[data-image-uploader]');
   jQuery('body').on({ 'change': regularImageUpload }, '#file');

   function regularImageUpload(e) {
      var file = jQuery(this)[0],
         type = file.files[0].type.toLocaleLowerCase();

      if (type.match(/jpg/) !== null ||
         type.match(/jpeg/) !== null ||
         type.match(/png/) !== null ||
         type.match(/gif/) !== null) {

         readUploadedImage(file.files[0]);
      }
   }

   function dropHandler(e) {
      e.preventDefault();

      if (e.type === 'drop' && e.originalEvent.dataTransfer && e.originalEvent.dataTransfer.files.length) {

         var files = e.originalEvent.dataTransfer.files,
            type = files[0].type.toLocaleLowerCase();

         if (type.match(/jpg/) !== null ||
            type.match(/jpeg/) !== null ||
            type.match(/png/) !== null ||
            type.match(/gif/) !== null) {

            readUploadedImage(files[0]);

         }

      }

      return false;
   }

   function readUploadedImage(img) {
      var reader;

      if (window.FileReader) {
         reader = new FileReader();
         reader.readAsDataURL(img);

         reader.onload = function (file) {
            if (file.target && file.target.result) {
               imageLoader(file.target.result, displayImage);
            }

         };

         reader.onerror = function () {
            throw new Error('Something went wrong!');
         };

      } else {
         throw new Error('FileReader not supported!');
      }

   }

   function imageLoader(src, callback) {
      var img;

      img = new Image();

      img.src = src;

      img.onload = function () {
         imageResizer(img, callback);
      }

   }

   function imageResizer(img, callback) {
      var canvas = document.createElement('canvas');
      canvas.width = 50;
      canvas.height = 50;
      context = canvas.getContext('2d');
      context.drawImage(img, 0, 0, 50, 50);
      callback(canvas.toDataURL());

   }

   function displayImage(img) {

      file = jQuery("#file")[0];
      fd = new FormData();
      // console.log(file.files[0]);
      individual_capt = "My logo";
      fd.append("caption", individual_capt);
      fd.append('action', 'fiu_upload_file');
      fd.append("file", file.files[0]);
      fd.append("path", $('#img_url').val());
      $("#loading").show();
      jQuery.ajax({
         type: 'POST',
         url: $('#photo_url').val(),
         data: fd,
         contentType: false,
         cache: false,
         processData: false,
         success: function (response) {
            file.value = null;
            $("#loading").hide();
            if (response == "false") {
               alert("Something went wrong, Please try again...");
            } else {
               // jQuery('[data-image]').attr('src', img);
               var images = jQuery('#image_gallery').val();
               var index = jQuery('#index').val();
               jQuery('#image_gallery').val(images + ',' + response);
               jQuery('.prepend_img').prepend('<div class="col-sm-2" id="pic' + index + '"><button type="button" class="close" onclick="remove_pic(\'' + index + '\',\'' + ',' + response + '\')" >&times;</button><img src="<?php echo base_url("assets/admin/products/"); ?>' + response + '" class="product_imges" /></div>');
               index = parseInt(index) + 1;
            }
         }
      });
   }

   function remove_pic(id, name) {
      swal({
         title: "Are you sure?",
         text: "You want to remove this product image",
         type: "warning",
         showCancelButton: true,
         closeOnConfirm: false,
      },
         function () {
            var image_gallery = jQuery('#image_gallery').val();
            image_gallery = image_gallery.replace(name, '');
            jQuery('#image_gallery').val(image_gallery);
            jQuery('#pic' + id).remove();
            swal("Deleted!", "Product image removed", "success");
         });
   }

   $(function () {
      //CKEditor
      //CKEDITOR.replace('ckeditor10');
      //CKEDITOR.config.height = 300;

      $("#instock").click(function () {
         $('#stock').val('1');
         $("#stock").prop("disabled", false);
      });

      $("#notinstock").click(function () {
         $('#stock').val('');
         $("#stock").prop("disabled", true);
      });

      $("#stock").change(function () {
         //alert("gfg");
         var num = parseInt($('#stock').val());
         if (num < 1) {
            $('#stock').val('1');
            swal('', 'Stock quantity should be greater than zero.');
         }
      });

      $(".sub_cat11").change(function () {
         var slug = $(this).data('parslug');

         $.ajax({
            type: 'POST',
            url: '<?php echo base_url('admin/product/get_vendor_by_category'); ?>',
            data: { cat_slug: slug },
            success: function (res) {
               if (!res) {
                  swal('', 'No vendors found in this Category.');
               }
               else {
                  var data = jQuery.parseJSON(res);
                  var output = '<option value="" ></option>';
                  $.each(data, function (index, value) {

                     output += '<option value="' + value['id'] + '" >' + value['first_name'] + '</option>';
                  });

                  $('#seller_id').html(output);
                  $("#seller_id").trigger("chosen:updated");
               }
            }
         })
      });
   });
   /* single image*/

   jQuery('body').on({ 'drop dragover dragenter': dropHandler1 }, '[data-image-uploader1]');
   jQuery('body').on({ 'change': regularImageUpload1 }, '#file1');

   function regularImageUpload1(e) {
      var file = jQuery(this)[0],
         type = file.files[0].type.toLocaleLowerCase();

      if (type.match(/jpg/) !== null ||
         type.match(/jpeg/) !== null ||
         type.match(/png/) !== null ||
         type.match(/gif/) !== null) {

         readUploadedImage1(file.files[0]);
      }
   }

   function dropHandler1(e) {
      e.preventDefault();

      if (e.type === 'drop' && e.originalEvent.dataTransfer && e.originalEvent.dataTransfer.files.length) {

         var files = e.originalEvent.dataTransfer.files,
            type = files[0].type.toLocaleLowerCase();

         if (type.match(/jpg/) !== null ||
            type.match(/jpeg/) !== null ||
            type.match(/png/) !== null ||
            type.match(/gif/) !== null) {

            readUploadedImage1(files[0]);

         }

      }

      return false;
   }

   function readUploadedImage1(img) {
      var reader;

      if (window.FileReader) {
         reader = new FileReader();
         reader.readAsDataURL(img);

         reader.onload = function (file) {
            if (file.target && file.target.result) {
               imageLoader1(file.target.result, displayImage1);
            }

         };

         reader.onerror = function () {
            throw new Error('Something went wrong!');
         };

      } else {
         throw new Error('FileReader not supported!');
      }

   }

   function imageLoader1(src, callback) {
      var img;

      img = new Image();

      img.src = src;

      img.onload = function () {
         imageResizer1(img, callback);
      }

   }

   function imageResizer1(img, callback) {
      var canvas = document.createElement('canvas');
      canvas.width = 50;
      canvas.height = 50;
      context = canvas.getContext('2d');
      context.drawImage(img, 0, 0, 50, 50);
      callback(canvas.toDataURL());
   }

   function displayImage1(img) {

      file = jQuery("#file1")[0];
      fd = new FormData();
      // console.log(file.files[0]);
      individual_capt = "My Product";
      fd.append("caption", individual_capt);
      fd.append('action', 'fiu_upload_file');
      fd.append("file", file.files[0]);
      fd.append("path", $('#img_url').val());
      $("#loading").show();
      jQuery.ajax({
         type: 'POST',
         url: $('#photo_url1').val(),
         data: fd,
         contentType: false,
         cache: false,
         processData: false,
         success: function (response) {
            file.value = null;
            $("#loading").hide();
            if (response == "false") {
               alert("Something went wrong, Please try again...");
            }
            else {
               $("#product_image_hide").hide();
               jQuery('[data-image]').attr('src', img);
               jQuery('#file_name').val(response);
            }
         }
      });
   }



</script>




<style type="text/css">
   .wizard>.steps>ul>li {
      width: 25% !important
   }

   .wizard ul>li,
   .tabcontrol ul>li {
      width: auto !important
   }

   #description {
      border-bottom: 1px solid #ccc
   }

   .bootstrap-tagsinput input {
      font-size: 14px;
      color: #777;
   }

   .bootstrap-tagsinput {
      width: 100%
   }

   .product_imges {
      height: 150px;
      width: 170px;
      margin: 0 auto;
      border: 1px solid #cdcdcdcd;
      padding: 2px;
   }

   #file1 {
      display: none;
   }

   button.btn.btn-primary {
      width: 10%;
      padding: 10px;

      font-size: 18px !important;
      letter-spacing: 1px;
      /*background: radial-gradient(#6b2828, #00000096);*/
   }

   .demo-masked-input .content {
      /*border: 1px solid #c0c0c0; */
      outline: none;
      padding: 10px;
   }

   .form-group-lg .form-control {
      font-size: 14px;
   }

   .col-sm-6.Color {
      display: none;
   }

   #product_image_hide {
      display: table;
      color: #696969;
      background: #eee;
      margin: auto;
      padding: 0px 14px;
      margin-top: -43px;
      height: 58px;
      /* background: #5bae3e; */
      /* color: white; */
   }

   .alert-success {
      background-color: #2b982b;
      border-radius: 5px;
   }
</style>

<script type="text/javascript">
   $(document).on("change", "#is_hazardous", function () {
      var is_hazardous = $("#is_hazardous").val();
      if (is_hazardous == "Yes") {
         $("#div_hazardous_specify").show();
      } else {
         $("#div_hazardous_specify").hide();
      }
   });
</script>

<script
   src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcf4oVp2zfW5qBYMtRD54DApyRolch_qE&libraries=places&callback=initMap"
   async defer></script>

<script type="text/javascript">
   function initMap() {
      var map = new google.maps.Map(document.getElementById('map2'), {
         center: { lat: -33.8688, lng: 151.2195 },
         zoom: 13
      });
      var input = document.getElementById('searchInput');
      map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

      var autocomplete = new google.maps.places.Autocomplete(input);
      autocomplete.bindTo('bounds', map);

      var infowindow = new google.maps.InfoWindow();
      var marker = new google.maps.Marker({
         map: map,
         anchorPoint: new google.maps.Point(0, -29)
      });

      autocomplete.addListener('place_changed', function () {
         infowindow.close();
         marker.setVisible(false);
         var place = autocomplete.getPlace();
         if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
         }

         // If the place has a geometry, then present it on a map.
         if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
         } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
         }
         marker.setIcon(({
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(35, 35)
         }));
         marker.setPosition(place.geometry.location);
         marker.setVisible(true);

         var address = '';
         if (place.address_components) {
            address = [
               (place.address_components[0] && place.address_components[0].short_name || ''),
               (place.address_components[1] && place.address_components[1].short_name || ''),
               (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
         }

         infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
         infowindow.open(map, marker);

         //Location details
         for (var i = 0; i < place.address_components.length; i++) {
            $('.inputDisabled').prop("disabled", false);
            // if(place.address_components[i].types[0] == 'postal_code'){
            //     document.getElementById('postal_code').value = place.address_components[i].long_name;
            // }
            // if(place.address_components[i].types[0] == 'country'){
            //     document.getElementById('country').value = place.address_components[i].long_name;
            // }
            // if(place.address_components[i].types[0] == 'administrative_area_level_1'){
            //     document.getElementById('administrative_area_level_1').value = place.address_components[i].long_name;
            // }
            // if(place.address_components[i].types[0] == 'locality'){
            //     document.getElementById('locality').value = place.address_components[i].long_name;
            // }
            // if(place.address_components[i].types[0] == 'route'){
            //     document.getElementById('route').value = place.address_components[i].long_name;
            // }
            // if(place.address_components[i].types[0] == 'street_number'){
            //     document.getElementById('street_number').value = place.address_components[i].long_name;
            // }
         }
         // console.log(place);
         // document.getElementById('location').innerHTML = place.formatted_address;
         document.getElementById('lat').value = place.geometry.location.lat();
         document.getElementById('lng').value = place.geometry.location.lng();
      });
   }
</script>


<style type="text/css">
   .form-group.form-float.form-group-lg {
      width: 100%;
      float: none;
   }

   .form-control {
      border-radius: 20px;
      border: 1px solid #cdcdcd;
      padding: 0px;
      padding-left: 10px;
      height: 40px;
      border-radius: 20px;
   }

   .form-group .form-control {
      border: 1px solid #cdcdcd;
      padding: 0px;
      padding-left: 10px;
      height: 40px;
      border-radius: 20px;
   }

   .form-group .form-line {
      border: none;
   }

   [type="checkbox"]+label {
      padding-left: 4px;
      height: 25px;
      line-height: 21px;
      margin-right: 16px;
      font-size: 13px;
      /* font-weight: normal; */
      margin-bottom: 7px;
      position: relative;
      top: -3px;
   }

   a.chosen-single {
      background: transparent;
   }
</style>