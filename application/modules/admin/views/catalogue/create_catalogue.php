<link href='<?php echo base_url(); ?>assets/frontend/css/common.css'
   rel='stylesheet' media="screen">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<div class="col-md-12" style="float: right;    margin-bottom: 0px;    height: 10px; margin-top: -10px;">
   <a href="<?php echo base_url($language) ?>/admin/catalogue/list1"
      class="back_button"><?php echo lang('aBack_To_List'); ?></a>
</div>

<br>


<style type="text/css">
   .hsm_price,
   .hss_price {
      display: none;
   }

   .product_imges {
      height: 150px;
      width: 170px;
      margin: 0 auto;
      border: 1px solid #cdcdcdcd;
      padding: 2px;
   }

   .chosen-container-single .chosen-single {

      border-radius: 100px;
      background: #fff;
      box-shadow: 0px 0px 0px;
      border: 1px solid #cdcdcd;
   }

   .required {
      color: red;
      padding: 2px
   }

   .width_fix {
      width: 15rem !important;
   }

   #main-container {
      background-color: #fff;
      width: 80%;
      padding: 15px 40px;
      margin-top: 25px;
      margin-bottom: 25px;
   }

   .form-group {
      width: 100%;
      margin-bottom: 20px;
   }

   .form-group .form-control {
      border: 1px solid #cdcdcd;
      padding: 0px;
      padding-left: 10px;
      height: 40px;
      border-radius: 20px;
   }

   .form-group .form-line {
      border-bottom: 0px solid #ddd;
   }

   .chosen-container-multi .chosen-choices {
      border-radius: 2rem
   }

   .chosen-container-multi .chosen-choices li.search-field input[type="text"] {
      height: 35px
   }

   .chosen-container-multi .chosen-choices li.search-choice {
      margin: 8px 5px 3px 5px;
   }
</style>

<?php echo $form->messages();
$product_name = $description = $price = $tax = $status_deactive = $sale_price = $editcategory = $tags = $short_description = $transaction_cost = $stock_deactive = $stock = $shipping_cost = $product_image = $image_gallery = $special_menu = $price_select = $brand = $specification = $shipment_by = $min_order_quantity = $is_delivery = $is_sample = $editseller_id = $packaging_type = $weight = $length = $width = $height = $warehouse_location = $city = $lat = $lng = $is_hazardous = $hazardous_specify = $req_loading = $vehical_requirement = $sku_code = $weight_unit = '';
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
if (empty($stock_deactive) && empty($stock_active)) {
    $stock_deactive = 'checked';
}
?>

<div class="row clearfix g-mt-2rem">
   <div class="col-md-12">
      <div class="demo-masked-input ">
         <?php echo $form->open(); ?>
         <div class="row">
            <div class="<?php echo $sel_class; ?> col-md-4">
               <label for="seller_products">
                  <?php echo lang('aSelect_products'); ?><span
                     class="required">*</span>
               </label>
               <select id="main_seller_products" name="seller_products[]"
                  class="get_sub_seller_products form-control space" multiple>

                  <?php
                  if (!isset($edit)) { ?>
                  <option value="">
                     <?php echo lang('aSelect_products'); ?>
                  </option>
                  <?php } ?>
                  <?php
                  if (!empty($seller_products)) {
                      foreach ($seller_products as $ckey => $cvalue) {
                          $seller_products = ($seller_products == $cvalue['id']) ? "selected" : "";
                          ?>
                  <option
                     value="<?php echo $cvalue['id']; ?>"
                     <?php echo $seller_products; ?>><?php echo $cvalue['product_name']; ?>
                  </option>
                  <?php
                      }
                  } ?>
               </select>
            </div>
            <div class="col-sm-4">



               <label for="catalog_name">
                  <?php echo lang('Catalog_name'); ?><span
                     class="required" aria-required="true">*</span>
               </label>
               <div class="form-group">
                  <div class="form-line">
                     <input type="text" name="catalog_name" id="catalog_name" class="form-control space" value=""
                        placeholder="<?php echo lang('Catalog_name'); ?>">
                  </div>
               </div>

            </div>
            <div class="col-sm-4">

               <div class="container-fluid">
                  <label
                     for="product_name"><?php echo lang('aSelect_theme:'); ?><span
                        class="required">*</span></label>
                  <select id="theme_switcher" name="select_catalog_theme">

                     <option value="default">
                        <?php echo lang('aDefault'); ?>
                     </option>
                     <!-- <option value="crazy">
                        <?php echo lang('aDark_Theme'); ?>
                     </option>
                     <option value="blue">
                        <?php echo lang('aBlue_Theme'); ?>
                     </option> -->
                     <option value="red">
                        <?php echo lang('aRed_Theme'); ?>
                     </option>
                  </select>

                  <!-- Content -->
               </div>
            </div>
         </div>
         <div class="row">

         </div>

         <div class="row">

            <div class="col-sm-6">
               <label for="category">
                  <?php echo lang('aDescription'); ?><span
                     class="required">*</span>
               </label>
               <textarea id="ckeditor10"
                  name="description"><?php echo $description; ?></textarea>
            </div>

            <div style="display: none" class="col-sm-3">
               <div class="form-group">
                  <label for="groups">Special Menu<span class="required">*</span></label>
                  <div>
                     <input type="checkbox" id="special_menu" name="special_menu" value="1"
                        class="with-gap radio-col-green"
                        <?php echo $special_menu; ?>>
                     <label for="special_menu" style="margin-left: -20px">Special Menu<span
                           class="required">*</span></label>
                  </div>
               </div>
            </div>

            <div class="col-sm-12">
               <h5>
                  <?php echo lang('aCatalog_Images_Gallery'); ?><span
                     class="required">*</span>
               </h5>
               <input type="hidden" id="photo_url"
                  value="<?php echo base_url('admin/file_handling/uploadFiless'); ?>" />
               <input type="hidden" id="img_url" value="admin/products/" />
               <input type="hidden" id="image_gallery" name="image_gallery"
                  value="<?php echo !empty($image_gallery) ? ',' . $image_gallery : ''; ?>"
                  required />
               <div class="row prepend_img">
                  <?php
                  $index = 1;
if (!empty($image_gallery)) {
    $image = explode(',', $image_gallery);
    foreach ($image as $key => $value) {
        $product_imageg = explode("/", $value);
        $product_imageg = count($product_imageg);
        if ($product_imageg == 1) {
            echo '<div id="pic' . $index . '"><button type="button" class="close" onclick="remove_pic(\'' . $index . '\',\'' . ',' . $value . '\')" >&times;</button><img  src="' . base_url("assets/admin/products/$value") . '" class="product_imges" /></div>';
        } else {
            echo '<div style="margibn-left:2rem" id="pic' . $index . '"><button type="button" class="close" onclick="remove_pic(\'' . $index . '\',\'' . ',' . $value . '\')" >&times;</button><img src="' . $value . '" class="product_imges"/></div>';
        }
        $index++;
    }
}
?>
                  <input type="hidden" id="index"
                     value="<?php echo $index; ?>" />
                  <div class="col-sm-3">
                     <div class="col-inner">
                        <input type="file" id="file"
                           value="<?php //echo $product_image;?>"
                           accept="image/png, image/gif, image/jpeg" />
                        <label for="file" class="file__drop" data-image-uploader>
                           <span class="text">&nbsp;</span>
                           <!-- <img data-image src="<?php //echo base_url("assets/admin/products/$product_image");?>"
                           style="width: 50px;height: 50px;padding: 10px 0;" /> -->
                           <span class="choose-image">
                              <?php echo lang('aCatalog_Images_Gallery'); ?>
                           </span>
                        </label>
                     </div>
                     <!-- <p>image size must be (width-415 * height-410) </p> -->
                  </div>
                  <br><br>
               </div>
               <div class="col-sm-12 padding-none">
                  <button type="submit" class="btn btn-primary width_fix">
                     <?php echo lang('aSubmit'); ?>
                  </button>
               </div>
               <?php echo $form->close(); ?>
            </div>
         </div>
      </div>


      <?php if ($product_image): ?>
      <script type="text/javascript">
         $("#product_image_hide").hide();
      </script>
      <?php endif ?>

      <script type="text/javascript">
         $(document).on("submit", "#wizard_with_validation", function() {
            // alert('ckeditor10');
            var catalog_name = $("#catalog_name").val();
            var theme_switcher = $("#catalog_name").val();
            if (catalog_name == '') {
               swal("", "Please Enter catalog name", "warning");
               return false;
            }
            if (theme_switcher == '') {
               error = 0;
               swal("", "Please Enter theme", "warning");
               return false;
            }
            // var main_seller_products = $("#main_seller_products").val();




            // // alert(ckeditor10);
            // //  alert(specification);
            // //  alert(unite);
            // var file_name = $("#file_name").val();
            // var error = 1;
            // if (main_seller_products == '') {
            //    swal("",
            //       "<?php echo lang('Please_enter_product_name'); ?>",
            //       'warning');
            //    error = 0;
            //    return false;
            // }
            // if(theme_switcher=='')
            //    {
            //       error=0;
            //       swal("","Please Enter Heading","warning");
            //       return false;
            //    }
            // if(catalog_name=='')
            //    {
            //       error=0;
            //       swal("","Please Enter Heading","warning");
            //       return false;
            //    }

         });
      </script>
      <script>
         function alpha(e) {
            var k;
            document.all ? k = e.keyCode : k = e.which;
            return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || (k >= 48 && k <= 57));
         }
      </script>

      <script type="text/javascript">
         $(function() {
            //CKEditor
            CKEDITOR.replace('ckeditor10');
            // CKEDITOR.config.height = 300;

            CKEDITOR.replace('specification');
            CKEDITOR.config.height = 200;

            CKEDITOR.config.fillEmptyBlocks = false;
            CKEDITOR.config.removePlugins = 'scayt,wsc';
            setInputFilter(document.getElementById("min_order_quantity"), function(value) {
               return /^-?\d*$/.test(value);
            });

            setInputFilter(document.getElementById("sale_price"), function(value) {
               return /^-?\d*[.,]?\d{0,2}$/.test(value);
            });
            setInputFilter(document.getElementById("price"), function(value) {
               return /^-?\d*[.,]?\d{0,2}$/.test(value);
            });

            $(document).ready(function() {
               $("#instock").click(function() {
                  $('#stock').val('1');
                  $("#stock").prop("disabled", false);
               });

               $("#notinstock").click(function() {
                  $('#stock').val('0');
                  $("#stock").prop("disabled", true);
               });
            });


         });
      </script>









      <script type="text/javascript">
         // $(function () {
         // //CKEditor
         // CKEDITOR.replace('ckeditor10');
         // CKEDITOR.config.height = 300;
         // });



         jQuery('body').on({
            'drop dragover dragenter': dropHandler
         }, '[data-image-uploader]');
         jQuery('body').on({
            'change': regularImageUpload
         }, '#file');

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

               reader.onload = function(file) {
                  if (file.target && file.target.result) {
                     imageLoader(file.target.result, displayImage);
                  }

               };

               reader.onerror = function() {
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

            img.onload = function() {
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
               success: function(response) {
                  file.value = null;
                  $("#loading").hide();
                  if (response == "false") {
                     alert("Something went wrong, Please try again...");
                  } else {
                     // jQuery('[data-image]').attr('src', img);
                     var images = jQuery('#image_gallery').val();
                     var index = jQuery('#index').val();
                     jQuery('#image_gallery').val(images + ',' + response);
                     jQuery('.prepend_img').prepend('<div class="col-sm-2" id="pic' + index +
                        '"><button type="button" class="close" onclick="remove_pic(\'' + index + '\',\'' +
                        ',' + response +
                        '\')" >&times;</button><img src="<?php echo base_url("assets/admin/products/"); ?>' +
                        response + '" class="product_imges" /></div>');
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
               function() {
                  var image_gallery = jQuery('#image_gallery').val();
                  image_gallery = image_gallery.replace(name, '');
                  jQuery('#image_gallery').val(image_gallery);
                  jQuery('#pic' + id).remove();
                  swal("Deleted!", "Product image removed", "success");
               });
         }



         jQuery('body').on({
            'drop dragover dragenter': dropHandler1
         }, '[data-image-uploader1]');
         jQuery('body').on({
            'change': regularImageUpload1
         }, '#file1');

         // function regularImageUpload1(e) {
         //    var file = jQuery(this)[0],
         //       type = file.files[0].type.toLocaleLowerCase();

         //    if (type.match(/jpg/) !== null ||
         //       type.match(/jpeg/) !== null ||
         //       type.match(/png/) !== null ||
         //       type.match(/gif/) !== null) {

         //       readUploadedImage1(file.files[0]);
         //    }
         // }

         // function dropHandler1(e) {
         //    e.preventDefault();

         //    if (e.type === 'drop' && e.originalEvent.dataTransfer && e.originalEvent.dataTransfer.files.length) {

         //       var files = e.originalEvent.dataTransfer.files,
         //          type = files[0].type.toLocaleLowerCase();

         //       if (type.match(/jpg/) !== null ||
         //          type.match(/jpeg/) !== null ||
         //          type.match(/png/) !== null ||
         //          type.match(/gif/) !== null) {

         //          readUploadedImage1(files[0]);

         //       }

         //    }

         //    return false;
         // }

         // function readUploadedImage1(img) {
         //    var reader;

         //    if (window.FileReader) {
         //       reader = new FileReader();
         //       reader.readAsDataURL(img);

         //       reader.onload = function(file) {
         //          if (file.target && file.target.result) {
         //             imageLoader1(file.target.result, displayImage1);
         //          }

         //       };

         //       reader.onerror = function() {
         //          throw new Error('Something went wrong!');
         //       };

         //    } else {
         //       throw new Error('FileReader not supported!');
         //    }

         // }

         // function imageLoader1(src, callback) {
         //    var img;

         //    img = new Image();

         //    img.src = src;

         //    img.onload = function() {
         //       imageResizer1(img, callback);
         //    }

         // }

         // function imageResizer1(img, callback) {
         //    var canvas = document.createElement('canvas');
         //    canvas.width = 50;
         //    canvas.height = 50;
         //    context = canvas.getContext('2d');
         //    context.drawImage(img, 0, 0, 50, 50);
         //    callback(canvas.toDataURL());
         // }

         // function displayImage1(img) {

         //    file = jQuery("#file1")[0];
         //    fd = new FormData();
         //    // console.log(file.files[0]);
         //    individual_capt = "My Product";
         //    fd.append("caption", individual_capt);
         //    fd.append('action', 'fiu_upload_file');
         //    fd.append("file", file.files[0]);
         //    fd.append("path", $('#img_url').val());
         //    $("#loading").show();
         //    jQuery.ajax({
         //       type: 'POST',
         //       url: $('#photo_url1').val(),
         //       data: fd,
         //       contentType: false,
         //       cache: false,
         //       processData: false,
         //       success: function(response) {
         //          file.value = null;
         //          $("#loading").hide();
         //          if (response == "false") {
         //             alert("Something went wrong, Please try again...");
         //          } else {
         //             $("#product_image_hide").hide();
         //             jQuery('[data-image]').attr('src', img);
         //             jQuery('#file_name').val(response);
         //          }
         //       }
         //    });
         // }
      </script>