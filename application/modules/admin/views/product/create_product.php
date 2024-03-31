<div class="col-md-12"
     style="float: right;    margin-bottom: 0px;    height: 10px; margin-top: -10px;">
    <a href="<?php echo base_url($language) ?>/admin/product/list1"
       class="back_button"><?php echo lang('aBack_To_List'); ?></a>
</div>

<br>


<style type="text/css">
    .hsm_price, .hss_price {
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
if (empty($stock_deactive) && empty($stock_active)) $stock_deactive = 'checked';
?>

<div class="row clearfix">
    <div class="col-md-12">
        <div class="demo-masked-input">
            <?php echo $form->open(); ?>
            <div class="row">
                <div class="col-sm-4">
                    <label
                        for="product_name"><?php echo lang('product_name'); ?></label>
                    <?php echo $form->bs3_text(lang('product_name'), 'product_name', $product_name, array("autocomplete" => "off", "class" => "space")); ?>
                </div>
                <div class="col-sm-4">
                    <label for="tags"><?php echo lang('aSearch_Tag'); ?></label>
                    <?php echo $form->bs3_text(lang('aSearch_Tag'), 'tags', $tags, array("autocomplete" => "off", "class" => "space")); ?>
                </div>
                <div class="col-sm-4" style="">
                    <label
                        for="short_description"><?php echo lang('aPlease_enter_short_description'); ?></label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="short_description"
                                   id="short_description" class="form-control space"
                                   value="<?php echo $short_description; ?>"
                                   placeholder="<?php echo lang('aPlease_enter_short_description'); ?>.">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3">
                    <label for="sku_code"><?php echo lang('SKU_Information'); ?></label>
                    <div class="form-group form-float form-group-lg">
                        <div class="form-line"><input type="text" name="sku_code"
                                                      value="<?php echo $sku_code; ?>"
                                                      placeholder="<?php echo lang('SKU_Information'); ?>"
                                                      id="sku_code" autocomplete="off"
                                                      class="form-control space"
                                                      onkeypress="return isNumberKey(event)">
                        </div>
                    </div>
                </div>
                <div class="col-sm-3" style="">
                    <label for="category"><?php echo lang('Brand'); ?></label>
                    <select placeholder="" id="pro_brand" name="brand">

                        <option value="0"><?php echo lang('aSelect_brand'); ?></option>
                        <?php
                        if (!empty($brand_data)) {
                            foreach ($brand_data as $bd_key => $bd_valu) {
                                $barnd_selected = ($brand == $bd_valu['id']) ? "selected" : "";
                                ?>
                                <option
                                    value="<?php echo $bd_valu['id']; ?>" <?php echo $barnd_selected; ?> ><?php echo $bd_valu['brand_name']; ?></option>
                            <?php }
                        } ?>
                    </select>
                </div>

                <div class="<?php echo $sel_class; ?> col-sm-3">
                    <label for="category"><?php echo lang('aCategory'); ?></label>
                    <select id="main_category" name="category" class="get_sub_category">
                        <?php
                        if (!isset($edit)) { ?>
                            <option
                                value="0"><?php echo lang('Select_Category'); ?></option>
                        <?php } ?>
                        <?php
                        if (!empty($category)) {
                            // echo "<pre>";
                            // print_r($category);
                            foreach ($category as $ckey => $cvalue) {
                                $category = ($editcategory == $cvalue['id']) ? "selected" : "";
                                ?>
                                <option
                                    value="<?php echo $cvalue['id']; ?>" <?php echo $category; ?> ><?php echo $cvalue['display_name']; ?></option>
                                <?php
                            }
                        } ?>
                    </select>
                </div>
                <div class="<?php echo $sel_class; ?> col-sm-3" style="">
                    <label for="category"><?php echo lang('Sub_category'); ?></label>
                    <select placeholder="" id="shope_sub_category" name="subcategory">
                        <?php
                        if (!empty($sub_category)) {
                            foreach ($sub_category as $itkey => $itvalue) {
                                $category2 = ($editsub_category == $itvalue['id']) ? "selected" : "";
                                ?>
                                <option
                                    value="<?php echo $itvalue['id']; ?>" <?php echo $category2; ?> ><?php echo $itvalue['display_name']; ?></option>
                            <?php }
                        } ?>
                    </select>
                </div>

                <?php if (!empty($supplier_data) && $seller_id == 1) { ?>
                    <div class="<?php echo $sel_class; ?>" style="">
                        <label for="category">Select Supplier</label>
                        <select placeholder="" id="seller_id" name="seller_id">
                            <option value="0">Select Supplier</option>
                            <?php
                            foreach ($supplier_data as $sd_key => $sd_val) {
                                $is_supplier = ($editseller_id == $sd_val['id']) ? "selected" : "";
                                ?>
                                <option
                                    value="<?php echo $sd_val['id']; ?>" <?php echo $is_supplier; ?> ><?php echo $sd_val['first_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                <?php } ?>

                <!--  this comment for to hide sub sub category -->
                <!-- <div class="col-sm-4" style="">
               <label for="category">Sub sub category</label>
               <select  placeholder="" id="sub_sub_category" name="sub_sub_category" >
                  <?php
                if (!empty($sub_sub_category)) {
                    foreach ($sub_sub_category as $itkey => $itvalue3) {
                        $category3 = ($editsub_sub_category == $itvalue3['id']) ? "selected" : "";
                        ?>
                  <option value="<?php echo $itvalue3['id']; ?>" <?php echo $category3; ?>  ><?php echo $itvalue3['display_name']; ?></option>
                  <?php }
                } ?>
               </select>
            </div> -->


                <div class="clear"></div>
                <?php if (!empty($pcustomize_list)): ?>
                    <?php foreach ($pcustomize_list as $ckey => $cvalue):
                        if ($cvalue['type'] == 3) {
                            $ctype = "Check Box Paid";
                        } elseif ($cvalue['type'] == 2) {
                            $ctype = "Check Box Free";
                        } else {
                            $ctype = "Radio";
                        } ?>
                        <div class="col-sm-6">
                            <p><?php echo $cvalue['title']; ?> (<?php echo $ctype; ?>
                                )</p>
                            <select multiple id="<?php echo $cvalue['id'] ?>"
                                    name="customize_att[]" class="">
                                <?php if (!empty($cvalue['sub_attri'])): ?>
                                    <?php foreach ($cvalue['sub_attri'] as $sckey => $scvalue):
                                        // echo '<pre>';
                                        // print_r($pcu_slced_list[$ckey]['sub_attri']);
                                        if (in_array($scvalue['id'], $sled_cus_list)) {
                                            if ($cvalue['type'] == 3) { ?>
                                                <option
                                                    value="<?php echo $cvalue['id'] ?>,<?php echo $scvalue['id']; ?>"
                                                    selected><?php echo $scvalue['name']; ?>
                                                    (<?php echo "A-" . $scvalue['price_ad'] . ", B-" . $scvalue['price_bh'] ?>
                                                    )
                                                </option>
                                            <?php } else { ?>
                                                <option
                                                    value="<?php echo $cvalue['id'] ?>,<?php echo $scvalue['id']; ?>"
                                                    selected><?php echo $scvalue['name']; ?></option>
                                            <?php } ?>
                                        <?php } else {
                                            if ($cvalue['type'] == 3) { ?>
                                                <option
                                                    value="<?php echo $cvalue['id'] ?>,<?php echo $scvalue['id']; ?>"><?php echo $scvalue['name']; ?>
                                                    (<?php echo "A-" . $scvalue['price_ad'] . ", B-" . $scvalue['price_bh'] ?>
                                                    )
                                                </option>

                                            <?php } else { ?>
                                                <option
                                                    value="<?php echo $cvalue['id'] ?>,<?php echo $scvalue['id']; ?>"><?php echo $scvalue['name']; ?></option>

                                            <?php } ?>
                                        <?php } ?>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </select>

                        </div>
                    <?php endforeach ?>
                <?php endif ?>

                <div class="col-sm-6">
                    <label for="category"><?php echo lang('aDescription'); ?></label>
                    <textarea id="ckeditor10"
                              name="description"><?php echo $description; ?></textarea>
                </div>
                <div class="col-sm-6">
                    <label
                        for="specification"><?php echo lang('aSpecification'); ?></label>
                    <textarea id="specification"
                              name="specification"><?php echo $specification; ?></textarea>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="groups"><?php echo lang('aStatus'); ?></label>
                        <div>
                            <?php echo $form->bs3_radio(lang('aActive'), 'status', '1', array('required' => ''), $status_active); ?>
                            <?php echo $form->bs3_radio(lang('aDeactive'), 'status', '0', array('required' => ''), $status_deactive); ?>
                        </div>
                    </div>
                </div>
                <div style="display: none" class="col-sm-3">
                    <div class="form-group">
                        <label for="groups">Special Menu</label>
                        <div>
                            <input type="checkbox" id="special_menu" name="special_menu"
                                   value="1"
                                   class="with-gap radio-col-green" <?php echo $special_menu; ?> >
                            <label for="special_menu" style="margin-left: -20px">Special
                                Menu</label>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-sm-6" style="">
               <label for="Price">Select Price</label>
               <select  placeholder="" id="price_select" name="price_select" >
                  <option value="0">Select Price</option>
                  <option value="1" <?php //echo $selected_singhle; ?>>Single Size</option>
                  <option value="2" <?php //echo $selected_multi; ?>>Multi Size</option>
               </select>
            </div>    -->
                <div class="col-sm-4 "> <!-- hss_price -->
                    <label for="unite"><?php echo lang('aProduct_Unite'); ?></label>
                    <select placeholder="" id="unite" name="unite"> <!-- multiple -->
                        <?php
                        if (!isset($edit)) { ?>
                            <!-- <option value="0">Select Unit</option> -->
                        <?php } ?>
                        <?php
                        if (!empty($unit_list)) {
                            foreach ($unit_list as $unit_key => $unit_value) {
                                $unit_selected = '';
                                if (in_array($unit_value['id'], $unite)) {
                                    $unit_selected = 'selected';
                                }
                                ?>
                                <option
                                    value="<?php echo $unit_value['id']; ?>" <?php echo $unit_selected; ?> ><?php echo $unit_value['unit_name']; ?></option>
                            <?php }
                        } ?>
                    </select>
                </div>
                <div class="clear"></div>
                <div class="col-sm-4 "> <!-- hss_price -->
                    <label for="category"><?php echo lang('aMarket_Price'); ?></label>
                    <?php echo $form->bs3_text(lang('aMarket_Price'), 'price', $price, array("class" => "space")); ?>
                </div>
                <div class="col-sm-4 " style=""> <!-- hss_price  -->
                    <label for="category"><?php echo lang('aOur_Price'); ?></label>
                    <?php echo $form->bs3_text(lang('aOur_Price'), 'sale_price', $sale_price, array("class" => "space")); ?>
                </div>
                <div class="col-sm-4 " style="">
                    <label
                        for="category"><?php echo lang('aMin_Order_Quantity'); ?></label>
                    <div class="form-group form-float form-group-lg">
                        <div class="form-line">
                            <input type="text" name="min_order_quantity"
                                   value="<?php echo $min_order_quantity; ?>"
                                   placeholder="<?php echo lang('aMin_Order_Quantity'); ?>"
                                   id="min_order_quantity" class="form-control ">
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 hs_qty "> <!-- hss_price -->
                    <div class="form-group">
                        <label for="groups"><?php echo lang('aStock_Status'); ?></label>
                        <div>
                            <?php echo $form->bs3_radio(lang('ain_stock'), 'stock_status', 'instock', array($required => ''), $stock_active); ?>
                            <?php echo $form->bs3_radio(lang('aOut_of_stock'), 'stock_status', 'notinstock', array($required => ''), $stock_deactive); ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 hs_qty "> <!-- hss_price -->
                    <label for="stock"><?php echo lang('aQuantity_in_Stock'); ?></label>
                    <?php echo $form->bs3_text(lang('aQuantity_in_Stock'), 'stock', $stock, array("autocomplete" => "off", 'onkeypress' => "return isNumberKey(event)", "class" => "space")); ?>
                </div>

                <div class="col-sm-4">
                    <label
                        for="shipment_by"><?php echo lang('aReady_for_shipment_by'); ?></label>
                    <?php echo $form->bs3_text('Ex 3-4 Days', 'shipment_by', $shipment_by, array("autocomplete" => "off", "class" => "space")); ?>
                </div>

                <div class="col-sm-2" style="margin-top: 25px;">
                    <div class="form-group">
                        <div>
                            <input type="checkbox" name="is_delivery_available"
                                   id="is_delivery_available" value="1"
                                   class="with-gap radio-col-green" <?php echo $is_delivery; ?>>
                            <label
                                for="is_delivery_available"><?php echo lang('aDelivery_Available'); ?></label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2" style="margin-top: 25px;">
                    <div class="form-group">
                        <div>

                            <input type="checkbox" name="is_sample_order"
                                   id="is_sample_order" value="1"
                                   class="with-gap radio-col-green" <?php echo $is_sample; ?>>
                            <label
                                for="is_sample_order"><?php echo lang('Sample_Order'); ?></label>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <label for="unite"><?php echo lang('aPackaging_Type'); ?></label>
                    <select placeholder="" id="packaging_type" name="packaging_type">
                        <?php
                        if (!isset($edit)) { ?>
                            <option
                                value="0"><?php echo lang('aselect_Packaging_Type'); ?></option>
                        <?php } ?>
                        <?php
                        if (!empty($pack_arr)) {
                            foreach ($pack_arr as $pa_key => $pa_value) {
                                $pk_selected = ($packaging_type == $pa_value) ? "selected" : "";
                                ?>
                                <option
                                    value="<?php echo $pa_value; ?>" <?php echo $pk_selected; ?> ><?php echo $pa_value; ?></option>
                            <?php }
                        } ?>
                    </select>
                </div>

                <div class="col-sm-2">
                    <label for="unite"><?php echo lang('aWeight_Unit'); ?> </label>
                    <select placeholder="" id="weight_unit" name="weight_unit">
                        <?php
                        if (!isset($edit)) { ?>
                            <option
                                value="0"><?php echo lang('aSelect_Weight_Unit'); ?></option>
                        <?php } ?>
                        <?php
                        if (!empty($weight_unit_arr)) {
                            foreach ($weight_unit_arr as $ha_key => $ha_val) {
                                $ha_selected = ($weight_unit == $ha_key) ? "selected" : "";
                                ?>
                                <option
                                    value="<?php echo $ha_key; ?>" <?php echo $ha_selected; ?> ><?php echo $ha_val; ?></option>
                            <?php }
                        } ?>
                    </select>
                </div>
                <div class="col-sm-2">
                    <label for="weight"><?php echo lang('aWeight'); ?></label>
                    <?php echo $form->bs3_text(lang('aWeight'), 'weight', $weight, array("autocomplete" => "off", "class" => "space", "onkeypress" => "return isNumberKey(event)")); ?>
                </div>

                <div class="col-sm-4">
                    <label for="length"><?php echo lang('alength'); ?></label>
                    <?php echo $form->bs3_text(lang('alength'), 'length', $length, array("autocomplete" => "off", "class" => "space")); ?>
                </div>

                <div class="col-sm-4">
                    <label for="width"><?php echo lang('awidth'); ?></label>
                    <?php echo $form->bs3_text(lang('awidth'), 'width', $width, array("autocomplete" => "off", "class" => "space")); ?>
                </div>

                <div class="col-sm-4">
                    <label for="height"><?php echo lang('aheight'); ?></label>
                    <?php echo $form->bs3_text(lang('aheight'), 'height', $height, array("autocomplete" => "off", "class" => "space")); ?>
                </div>

                <div class="col-sm-4">
                    <label for="unite"><?php echo lang('aCity'); ?></label>
                    <select placeholder="" id="city" name="city">
                        <?php
                        if (!isset($edit)) { ?>
                            <option
                                value="0"><?php echo lang('Select_City'); ?></option>
                        <?php } ?>
                        <?php
                        if (!empty($city_list)) {
                            foreach ($city_list as $cl_key => $cl_val) {
                                $city_selected = ($city == $cl_val['city_name']) ? "selected" : "";
                                ?>
                                <option
                                    value="<?php echo $cl_val['city_name']; ?>" <?php echo $city_selected; ?> ><?php echo $cl_val['city_name']; ?></option>
                            <?php }
                        } ?>
                    </select>
                </div>

                <div class="col-sm-4">
                    <label
                        for="warehouse_location"><?php echo lang('aWarehouse_location'); ?></label>
                    <input type="text" name="warehouse_location"
                           value="<?php echo $warehouse_location; ?>"
                           placeholder="<?php echo lang('aWarehouse_location'); ?>"
                           id="searchInput" autocomplete="off"
                           class="form-control space">
                </div>
                <div
                    style="width: 80%;padding: 10%;border: 3px solid black;display:none"
                    id="map2"></div>
                <input type="hidden" name="lat" id="lat" value="<?php echo $lat; ?>">
                <input type="hidden" name="lng" id="lng" value="<?php echo $lng; ?>">
                <!-- <div class="clear"></div> -->
                <div class="col-sm-4">
                    <label
                        for="unite"><?php echo lang('aRequirement_for_Loading'); ?></label>
                    <select placeholder="" id="req_loading" name="req_loading">
                        <?php
                        if (!isset($edit)) { ?>
                            <option
                                value="0"><?php echo lang('aSelect_Loading'); ?></option>
                        <?php } ?>
                        <?php
                        if (!empty($req_loading_arr)) {
                            foreach ($req_loading_arr as $rla_key => $rla_val) {
                                $req_selected = ($req_loading == $rla_val) ? "selected" : "";
                                ?>
                                <option
                                    value="<?php echo $rla_val; ?>" <?php echo $req_selected; ?> ><?php echo $rla_val; ?></option>
                            <?php }
                        } ?>
                    </select>
                </div>

                <div class="col-sm-4">
                    <label
                        for="unite"><?php echo lang('aVehical_Requirement'); ?> </label>
                    <select placeholder="" id="vehical_requirement"
                            name="vehical_requirement">
                        <?php
                        if (!isset($edit)) { ?>
                            <option
                                value="0"><?php echo lang('aSelect_Vehical_Requirement'); ?></option>
                        <?php } ?>
                        <?php
                        if (!empty($vehical_arr)) {
                            foreach ($vehical_arr as $ha_key => $ha_val) {
                                $ha_selected = ($vehical_requirement == $ha_val) ? "selected" : "";
                                ?>
                                <option
                                    value="<?php echo $ha_val; ?>" <?php echo $ha_selected; ?> ><?php echo $ha_val; ?></option>
                            <?php }
                        } ?>
                    </select>
                </div>

                <div class="col-sm-4">
                    <label
                        for="unite"><?php echo lang('aIs_this_Hazardous_material'); ?></label>
                    <select placeholder="" id="is_hazardous" name="is_hazardous">
                        <?php
                        if (!isset($edit)) { ?>
                            <option value="0">Select Hazardous</option>
                        <?php } ?>
                        <?php
                        if (!empty($hazardous_arr)) {
                            foreach ($hazardous_arr as $ha_key => $ha_val) {
                                $ha_selected = ($is_hazardous == $ha_val) ? "selected" : "";
                                ?>
                                <option
                                    value="<?php echo $ha_val; ?>" <?php echo $ha_selected; ?> ><?php echo $ha_val; ?></option>
                            <?php }
                        } ?>
                    </select>
                </div>


                <div class="col-sm-4" style="<?php echo $is_hazardous_class; ?>"
                     id="div_hazardous_specify">
                    <label
                        for="warehouse_location"><?php echo lang('aHazardous_Specify'); ?></label>
                    <input type="text" name="hazardous_specify"
                           value="<?php echo $hazardous_specify; ?>"
                           placeholder="<?php echo lang('aHazardous_Specify'); ?>"
                           id="hazardous_specify" autocomplete="off"
                           class="form-control space">
                </div>


                <!-- <div class="col-sm-6">
               <label for="category">Tax (%)</label>
               <?php //echo $form->bs3_text('Tax (%)', 'tax', $tax, array('required' => '')); ?>
               </div> -->
                <!-- hide client requirement remove product attribute 13-06-19 -->
                <div class="col-sm-12 hsm_price" style="margin: 0px;">
                    <label style=""> Select attribute (if applicable)</label>
                    <div class="row" style="">
                        <?php
                        if (isset($attribute)) {
                            foreach ($attribute as $akey => $avalue) {
                                echo '<div class="col-sm-6 ' . $avalue['name'] . ' ">
                                 <div class="form-group demo-tagsinput-area">
                                     <div class="form-line">
                                       <h6>Select ' . $avalue['name'] . '</h6>
                                         <select multiple placeholder="' . $avalue['name'] . '" name="attribute[]" class="pr_attribute" id="select_size' . $avalue['id'] . '"  >';
                                foreach ($avalue['item'] as $itkey => $itvalue) {
                                    echo '<option data-id="' . $itvalue['item_name'] . '" value="' . $itvalue['id'] . ',' . $itvalue['item_name'] . '" ' . (in_array($itvalue['id'], $product_attribute) ? 'selected' : '') . ' >' . $itvalue['item_name'] . '</option>';
                                }
                                echo '</select>
                                     </div>
                                 </div>
                              </div>';
                            }
                        }

                        ?>
                        <?php
                        if (isset($edit)) {
                            $product_attribute2 = implode(",", $product_attribute);
                            ?>
                            <input type='hidden' id="attribute2" name="attribute2"
                                   value="<?php echo $product_attribute2 ?>">
                        <?php } else { ?>
                            <input type='hidden' id="attribute2" name="attribute2">
                        <?php } ?>
                    </div>
                </div>

                <div class="col-md-6" style="margin-left: 0px" id="sub_cat_listing">
                    <?php
                    if (isset($edit)) {
                        if (!empty($p_attr)) {
                            foreach ($p_attr as $key => $p_attr2) {
                                $size_id[] = $p_attr2['item_id'];

                                ?>
                                <div class="shattbute"
                                     id="<?php echo $p_attr2['item_id']; ?>">
                                    <label><?php echo $p_attr2['item_name']; ?></label>

                                    <label class="attribute_p">Qty<input type="text"
                                                                         class="form-control"
                                                                         name="attribute_qty[]"
                                                                         value="<?php echo $p_attr2['qty']; ?>"
                                                                         required></label>

                                    <label style="display: none" class="attribute_p">Qty<input
                                            type="text" class="form-control"
                                            name="attribute_id_size[]"
                                            value="<?php echo $p_attr2['id_size']; ?>"
                                            required></label>

                                    <label style="display: none" class="attribute_p">Our
                                        Food Price<input type="text"
                                                         class="form-control"
                                                         name="attribute_price[]"
                                                         value="<?php echo $p_attr2['price']; ?>"></label>
                                    <label style="display: none" class="attribute_p">Market
                                        Price<input type="text"
                                                    name="attribute_sale_price[]"
                                                    class="form-control"
                                                    value="<?php echo $p_attr2['sale_price']; ?>"></label>
                                </div>
                            <?php }
                        }
                    }
                    ?>
                    <!-- <div class="" id="sub_cat_listing">fdjsadfksdf</div> -->
                </div>
                <!-- <div class="col-sm-6">
               <?php //echo $form->bs3_text('Transaction cost', 'transaction_cost', $transaction_cost, array('required' => '')); ?>
               </div>
               <div class="col-sm-6">
               <?php //echo $form->bs3_text('Shipping Cost','shipping_cost',$shipping_cost, array('required' => '')); ?>
               </div>-->
                <br><br>


                <div class="col-sm-12">
                    <h5><?php echo lang('aProduct_Images'); ?></h5>
                    <input type="hidden" id="photo_url1" value="<?php echo base_url('admin/file_handling/uploadFiless'); ?>"/>
                    <input type="hidden" id="img_url" value="admin/products/"/>
                    <input type="hidden" name="product_image" id="file_name"
                           value="<?php echo $product_image; ?>" <?php if (empty($product_image)) echo "required"; ?> >
                    <div class="col-25">
                        <div class="col-inner">
                            <input type="file" id="file1"
                                   accept="image/png, image/gif, image/jpeg"/>
                            <label for="file1" class="file__drop" data-image-uploader1>
                                <span class="text">&nbsp;</span>
                                <?php
                                $product_image_temp = explode("/", $product_image);
                                $product_image_temp = count($product_image_temp);
                                if ($product_image_temp == 1) {
                                    $image_url = base_url("assets/admin/products/") . $product_image;
                                } else {
                                    $image_url = $product_image;
                                } ?>
                                <img data-image src="<?php echo $image_url; ?>"
                                     style="width: 100px;height: 100px;padding: 10px 0;"/>
                                <span id="product_image_hide"
                                      class="choose-image"><?php echo "Choose Product Image"; ?></span>
                            </label>
                        </div>
                        <!-- <p>image size must be (width-415 * height-410) </p> -->
                    </div>
                </div>
            </div>
            <h5><?php echo lang('aProduct_Images_Gallery'); ?></h5>
            <input type="hidden" id="photo_url"
                   value="<?php echo base_url('admin/file_handling/uploadFiless'); ?>"/>
            <input type="hidden" id="img_url" value="admin/products/"/>
            <input type="hidden" id="image_gallery" name="image_gallery"
                   value="<?php echo !empty($image_gallery) ? ',' . $image_gallery : ''; ?>"
                   required/>
            <div class="row prepend_img">
                <?php
                $index = 1;
                if (!empty($image_gallery)) {
                    $image = explode(',', $image_gallery);
                    foreach ($image as $key => $value) {
                        $product_imageg = explode("/", $value);
                        $product_imageg = count($product_imageg);
                        if ($product_imageg == 1) {
                            echo '<div class="col-sm-2" id="pic' . $index . '"><button type="button" class="close" onclick="remove_pic(\'' . $index . '\',\'' . ',' . $value . '\')" >&times;</button><img src="' . base_url("assets/admin/products/$value") . '" class="product_imges" /></div>';
                        } else {
                            echo '<div class="col-sm-2" id="pic' . $index . '"><button type="button" class="close" onclick="remove_pic(\'' . $index . '\',\'' . ',' . $value . '\')" >&times;</button><img src="' . $value . '" class="product_imges" /></div>';
                        }
                        $index++;
                    }
                }


                ?>
                <input type="hidden" id="index" value="<?php echo $index; ?>"/>
                <div class="col-sm-3">
                    <div class="col-inner">
                        <input type="file" id="file"
                               value="<?php //echo $product_image; ?>"
                               accept="image/png, image/gif, image/jpeg"/>
                        <label for="file" class="file__drop" data-image-uploader>
                            <span class="text">&nbsp;</span>
                            <!-- <img data-image src="<?php //echo base_url("assets/admin/products/$product_image"); ?>" style="width: 50px;height: 50px;padding: 10px 0;" /> -->
                            <span
                                class="choose-image"><?php echo "Choose Product Image"; ?></span>
                        </label>
                    </div>
                    <!-- <p>image size must be (width-415 * height-410) </p> -->
                </div>
                <br><br>
            </div>
            <div class="col-sm-12" style="padding: 0px;">
                <button type="submit"
                        class="btn btn-primary"><?php echo lang('aSubmit'); ?></button>
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
    var Price_flag;
    var yourArray = [];
    <?php
    if (isset($edit)) {
    foreach ($product_attribute as $key => $value2) { ?>
    value2 =<?php echo $value2; ?>;
    value2 = value2.toString();
    yourArray.push(value2);
    <?php }?>
    <?php } ?>

    $(document).on('change', '#select_size20', function (event, params) {
        <?php if(!isset($edit)){ ?>
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


<script type="text/javascript">

    $(function () {
        //CKEditor
        CKEDITOR.replace('ckeditor10');
        // CKEDITOR.config.height = 300;

        CKEDITOR.replace('specification');
        CKEDITOR.config.height = 200;

        CKEDITOR.config.fillEmptyBlocks = false;
        setInputFilter(document.getElementById("min_order_quantity"), function (value) {
            return /^-?\d*$/.test(value);
        });

        setInputFilter(document.getElementById("sale_price"), function (value) {
            return /^-?\d*[.,]?\d{0,2}$/.test(value);
        });
        setInputFilter(document.getElementById("price"), function (value) {
            return /^-?\d*[.,]?\d{0,2}$/.test(value);
        });

        $(document).ready(function () {
            $("#instock").click(function () {
                $('#stock').val('1');
                $("#stock").prop("disabled", false);
            });

            $("#notinstock").click(function () {
                $('#stock').val('0');
                $("#stock").prop("disabled", true);
            });
        });

        $("#stock").change(function () {
            //alert("gfg");
            var num = parseInt($('#stock').val());
            if (num < 1) {
                $('#stock').val('1');
                swal('', 'Stock quantity should be greater than zero.');
            }
        });

        $(".sub_cat").change(function () {
            var slug = $(this).data('parslug');

            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('admin/product/get_vendor_by_category'); ?>',
                data: {cat_slug: slug},
                success: function (res) {
                    if (!res) {
                        swal('', 'No vendors found in this Category.');
                    } else {
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
</script>


<script type="text/javascript">
    $(document).on("submit", "#wizard_with_validation", function () {
        var product_name = $("#product_name").val();
        var stock = $("#stock").val();
        var tag_name = $("#tag_name").val();
        var short_description = $("#short_description").val();
        var pro_brand = $("#pro_brand").val();
        var main_category = $("#main_category").val();
        var shope_sub_category = $("#shope_sub_category").val();
        var sub_sub_category = $("#sub_sub_category").val();
        var ckeditor10 = $("#ckeditor10").val();
        var specification = $("#specification").val();
        var price_select = $("#price_select").val();
        var min_order_quantity = $("#min_order_quantity").val();
        var unite = $("#unite").val();


        // alert(ckeditor10);
        //  alert(specification);
        //  alert(unite);
        var file_name = $("#file_name").val();
        var error = 1;
        if (product_name == '') {
            invalid('#product_name');
            swal("", "<?php echo lang('Please_enter_product_name'); ?>", 'warning');
            error = 0;
            return false;
        }else{
            valid('#product_name');
        }
        if (tag_name == '') {
            invalid('#tag_name');
            swal("", "<?php echo lang('aPlease_enter_search_tag'); ?>", 'warning');
            error = 0;
            return false;
        }else{
            valid('#tag_name');
        }

        if (short_description == '') {
            invalid('#short_description');
            swal("", "<?php echo lang('aPlease_enter_short_description'); ?>", 'warning');
            error = 0;
            return false;
        }else{
            valid('#short_description');
        }
        if (pro_brand == '0') {
            invalid('#pro_brand'  , 'select');
            swal("", "<?php echo lang('aPlease_select_brand'); ?>", 'warning');
            error = 0;
            return false;
        }else{
            valid('#pro_brand' , 'select');
        }
        if (main_category == '0') {
            invalid('#main_category' , 'select');
            swal("", "<?php echo lang('aPlease_select_category'); ?>", 'warning');
            error = 0;
            return false;
        }else{
            valid('#main_category' , 'select');
        }
        if (shope_sub_category == '0') {
            invalid('#shope_sub_category' , 'select');
            swal("", "<?php echo lang('aPlease_select_sub_category'); ?>", 'warning');
            error = 0;
            return false;
        }else{
            valid('#shope_sub_category' , 'select');
        }
        <?php
        if($seller_id == 1){ ?>
        var seller_id = $("#seller_id").val();
        if (seller_id == '0') {
            invalid('#seller_id');
            swal("", "Please select supplier", 'warning');
            error = 0;
            return false;
        }else{
            valid('#seller_id');
        }
        <?php } ?>


        if (ckeditor10 == '') {
            invalid('#ckeditor10');
            swal("", "<?php echo lang('aPlease_enter_description'); ?>", 'warning');
            error = 0;
            return false;
        }else{
            valid('#ckeditor10');
        }

        if (specification == '') {
            invalid('#specification');
            swal("", "<?php echo lang('aPlease_enter_specification'); ?>", 'warning');
            error = 0;
            return false;
        }else{
            valid('#specification');
        }

        if (unite == null || unite == 0) {
            invalid('#unite' , 'select');
            swal("", "<?php echo lang('aPlease_select_unite'); ?>", 'warning');
            error = 0;
            return false;
        }else{
            valid('#unite' , 'select');
        }


        // if(price_select==0)
        // {
        //    swal("","Please select price",'warning');
        //    error=0;
        //    return false;
        // }
        var price = $("#price").val();
        var sale_price = $("#sale_price").val();
        if (price == '') {
            invalid('#price');
            swal("", "<?php echo lang('aPlease_enter_market_price'); ?>", 'warning');
            error = 0
            return false;
        }else{
            valid('#price');
        }

        if (sale_price == '') {
            invalid('#sale_price');
            swal("", "<?php echo lang('aPlease_enter_our_price'); ?>", 'warning');
            error = 0
            return false;
        }else{
            valid('#sale_price');
        }


        if (sale_price > price) {
            invalid('#sale_price');
            swal("", "<?php echo lang('aMarket_price_should_be_hiigh_than_our_price'); ?>", 'warning');
            error = 0
            return false;
        }else{
            valid('#sale_price');
        }


        if (min_order_quantity == '' || min_order_quantity == 0) {
            invalid('#min_order_quantity');
            swal("", "<?php echo lang('aPlease_minimum_order_quantity'); ?>", 'warning');
            error = 0
            return false;
        }{
            valid('#min_order_quantity');
        }


        if (stock == '') {
            invalid('#stock');
            swal("", "<?php echo lang('aPlease_enter_quantity_in_Stock'); ?>", 'warning');
            error = 0;
            return false;
        }else{
            valid('#stock');
        }

        if (Price_flag == 1) {

        } else if (Price_flag == 2) {
            var select_size20 = $("#select_size20").val();
            if (select_size20 == null) {
                invalid('#select_size20' , "select");
                swal("", "Please Select Size", 'warning');
                error = 0
                return false;
            }else{
                valid('#select_size20' , "select");
            }
        }

        var packaging_type = $("#packaging_type").val();
        var weight = $("#weight").val();
        var weight_unit = $("#weight_unit").val();
        var length = $("#length").val();
        var width = $("#width").val();
        var height = $("#height").val();
        var city = $("#city").val();
        var searchInput = $("#searchInput").val();
        var lat = $("#lat").val();
        var lng = $("#lng").val();
        var req_loading = $("#req_loading").val();
        var is_hazardous = $("#is_hazardous").val();
        var vehical_requirement = $("#vehical_requirement").val();
        var hazardous_specify = $("#hazardous_specify").val();

        if (packaging_type == '0') {
            invalid("#packaging_type" , "select")
            swal("", "<?php echo lang('aPlease_select_Packaging_Type'); ?>", 'warning');
            error = 0;
            return false;
        }else{
            valid('#packaging_type' , "select");
        }

        if (weight == '') {
            invalid("#weight")
            swal("", "<?php echo lang('aPlease_enter_weight'); ?>", 'warning');
            error = 0;
            return false;
        }else{
            valid('#weight');
        }

        if (weight_unit == '0') {
            invalid("#weight_unit" , "select")
            swal("", "<?php echo lang('aSelect_Weight_Unit'); ?>", 'warning');
            error = 0;
            return false;
        }else{
            valid('#weight_unit' , "select");
        }

        if (length == '') {
            invalid("#length")
            swal("", "<?php echo lang('aPlease_enter_length'); ?>", 'warning');
            error = 0;
            return false;
        }else{
            valid('#length');
        }

        if (width == '') {
            invalid("#width")
            swal("", "<?php echo lang('aPlease_enter_width'); ?>", 'warning');
            error = 0;
            return false;
        }else{
            valid('#width');
        }

        if (height == '') {
            invalid("#height")
            swal("", "<?php echo lang('aPlease_enter_height'); ?>", 'warning');
            error = 0;
            return false;
        }else{
            valid('#height');
        }

        if (city == '0') {
            invalid("#city" , "select")
            swal("", "<?php echo lang('aPlease_select_city'); ?>", 'warning');
            error = 0;
            return false;
        }else{
            valid('#city' , "select");
        }

        // if(searchInput=='')
        // {
        //    swal("","<?php echo lang('aPlease_select_perfect_google_address'); ?>",'warning');
        //    error=0;
        //    return false;
        // }

        // if(searchInput!='')
        // {
        //    var lat=$("#lat").val();
        //    var lng=$("#lng").val();
        //    if(lat=='' && lng=='')
        //    {
        //      swal("","<?php echo lang('aPlease_select_perfect_google_address'); ?>","warning");
        //      error=0;
        //      return false;
        //    }
        // }

        if (req_loading == '0') {
            invalid("#req_loading" , "select")
            swal("", "<?php echo lang('aPlease_select_requirement_for_loading'); ?>", 'warning');
            error = 0;
            return false;
        }{
            valid('#req_loading' , "select");
        }

        if (is_hazardous == '0') {
            invalid("#is_hazardous" , "select")
            swal("", "<?php echo lang('aPlease_select_hazardous_material'); ?>", 'warning');
            error = 0;
            return false;
        }{
            valid('#is_hazardous' , "select");
        }

        if (is_hazardous == "Yes") {
            if (hazardous_specify == "") {
                invalid("#hazardous_specify")
                swal("", "<?php echo lang('aPlease_enter_hazardous_specify'); ?>", 'warning');
                error = 0;
                return false;
            }{
                valid('#hazardous_specify');
            }
        }

        if (vehical_requirement == '0') {
            invalid("#vehical_requirement" , "select")
            swal("", "<?php echo lang('aPlease_select_Vehical_Requirement'); ?>", 'warning');
            error = 0;
            return false;
        }{
            valid('#vehical_requirement' , "select");
        }

        if (file_name == '') {
            swal("", "<?php echo lang('aPlease_select_image'); ?>", 'warning');
            error = 0
            return false;
        }
    });
</script>

<script type="text/javascript">
    $(document).on("change", "#main_category", function () {
        var cat_id = $(this).val();
        if (cat_id != 0) {
            $("#loading").show();
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url(); ?>admin/product/get_subcategory_data",
                data: {cat_id: cat_id},
                success: function (response) {
                    $("#loading").hide();
                    var html = '';
                    if (response == 0) {
                        swal("", "Something went worng", "warning");
                    } else if (response == "not_found") {
                        // alert("yes2");
                        $('#shope_sub_category').prop('disabled', true).trigger("chosen:updated");
                        // $('#shope_sub_category').prop('disabled', false).trigger("chosen:updated");
                    } else {
                        var response = $.parseJSON(response);
                        // alert("yes");
                        html += "<option value='0'>Select sub category</option>";
                        $.each(response, function (k, v) {
                            html += "<option   value='" + v.id + "'>" + v.display_name + "</option>";
                        });
                        $('#shope_sub_category').prop('disabled', false).trigger("chosen:updated");
                        $("#shope_sub_category").html(html);
                        $('#shope_sub_category').trigger('chosen:updated');
                    }
                }
            });
        } else {
            $('#shope_sub_category').prop('disabled', true).trigger("chosen:updated");
        }
    });


    //  $(document).on("change","#shope_sub_category",function(){
    //   var cat_id=$(this).val();
    //   if(cat_id!=0){
    //     $.ajax({
    //             type: 'POST',
    //             url: "<?php echo base_url(); ?>admin/product/get_subcategory_data",
    //             data: {cat_id:cat_id},
    //             success:function(response)
    //             {

    //               var html='';
    //               if(response==0) {
    //                 swal("","Something went worng","warning");
    //               }else if(response=="not_found") {
    //                 // alert("yes2");
    //                 $('#sub_sub_category').prop('disabled', true).trigger("chosen:updated");
    //                 // $('#shope_sub_category').prop('disabled', false).trigger("chosen:updated");
    //               }else {
    //                 var response = $.parseJSON(response);
    //                 // alert("yes");
    //                html+="<option value='0'>Select sub sub category</option>";
    //                 $.each(response, function( k, v ) {
    //                   html+="<option   value='"+v.id+"'>"+v.display_name+"</option>";
    //                 });
    //                 $('#sub_sub_category').prop('disabled', false).trigger("chosen:updated");
    //                 $("#sub_sub_category").html(html);
    //                 $('#sub_sub_category').trigger('chosen:updated');
    //               }
    //             }
    //     });
    //   } else {
    //       $('#sub_sub_category').prop('disabled', true).trigger("chosen:updated");
    //   }
    // });

    //    $(document).on('click', 'input[type="checkbox"]', function() {
    //     $('input[type="checkbox"]').not(this).prop('checked', false);
    // });
    $(document).on("change", "#price_select", function () {
        Price_flag = $(this).val();
        if (Price_flag == 2) {
            $(".hss_price").show();
            $(".hsm_price").show();
            $(".shattbute").show();
            $(".hs_qty").hide();
        } else if (Price_flag == 1) {
            $(".hsm_price").hide();
            $(".shattbute").hide();
            $(".hss_price").show();
            $(".hs_qty").show();
        } else {
            $(".shattbute").hide();
            $(".hsm_price").hide();
            $(".hss_price").hide();
            $(".hs_qty").hide();
        }
        // hss_price
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

    // $(function () {
    // //CKEditor
    // CKEDITOR.replace('ckeditor10');
    // CKEDITOR.config.height = 300;
    // });


    jQuery('body').on({'drop dragover dragenter': dropHandler}, '[data-image-uploader]');
    jQuery('body').on({'change': regularImageUpload}, '#file');

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
                data: {cat_slug: slug},
                success: function (res) {
                    if (!res) {
                        swal('', 'No vendors found in this Category.');
                    } else {
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

    jQuery('body').on({'drop dragover dragenter': dropHandler1}, '[data-image-uploader1]');
    jQuery('body').on({'change': regularImageUpload1}, '#file1');

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
                } else {
                    $("#product_image_hide").hide();
                    jQuery('[data-image]').attr('src', img);
                    jQuery('#file_name').val(response);
                }
            }
        });
    }


</script>


<style type="text/css">
    .wizard > .steps > ul > li {
        width: 25% !important
    }

    .wizard ul > li, .tabcontrol ul > li {
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
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDNpNhw8Qyac0n7I7gHsVWtr4uc1VNN7dg&libraries=places&callback=initMap"
    async defer></script>

<script type="text/javascript">

    function invalid(id , select = null){
        if(select){
            selector = id + '_chosen .chosen-single';
        }else{
            selector = id;
        }
        $(selector).css('border-width','1px');
        $(selector).css('border-color','#dc3545');
        $(selector).removeClass('is-valid').addClass('is-invalid')
    }

    function valid(id, select = null){
        if(select){
            selector = id + '_chosen .chosen-single';
        }else{
            selector = id;
        }

        $(selector).css('border-width','');
        $(selector).css('border-color','');
        $(selector).removeClass('is-invalid').addClass('is-valid')
    }


    function initMap() {
        var map = new google.maps.Map(document.getElementById('map2'), {
            center: {lat: -33.8688, lng: 151.2195},
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

    [type="checkbox"] + label {
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
