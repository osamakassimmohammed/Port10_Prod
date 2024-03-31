<script type="text/javascript">
    var g_seller_id = '';
    var image_gallery_g = '';
    var index_g = 1;

    function initMap2() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: 25.2048,
                lng: 55.2708
            },
            zoom: 15
        });
        var input = /** @type {!HTMLInputElement} */ (
            document.getElementById('searchInput2'));

        var types = document.getElementById('type-selector');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29),
            draggable: true
        });
        google.maps.event.addListener(marker, 'dragend', function () {
            var lat = marker.getPosition().lat();
            var lng = marker.getPosition().lng();

            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('ajax/geolocation_address') ?>",
                data: {lat: lat, lng: lng},

                success: function (response) {
                    $("#searchInput2").val(response);
                }
            });

            $("#latitude").val(marker.getPosition().lat());
            $("#longitude").val(marker.getPosition().lng());
            // alert("ajax latitude "+marker.getPosition().lat());
            // document.getElementsByName('latitude')[0].value = marker.getPosition().lat();
            // document.getElementsByName('longitude')[0].value = marker.getPosition().lng();
        })

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
                map.setZoom(17); // Why 17? Because it looks good.
            }
            marker.setIcon( /** @type {google.maps.Icon} */ ({
                url: 'http://maps.google.com/mapfiles/ms/icons/red.png',
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

            var latitude = place.geometry.location.lat();
            var longitude = place.geometry.location.lng();

            // document.getElementsByName('latitude')[0].value = latitude;
            // document.getElementsByName('longitude')[0].value = longitude;

            $("#latitude").val(latitude);
            $("#longitude").val(longitude);
            // alert("latitude "+latitude);

            infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
            infowindow.open(map, marker);
        });

    }

    // google.maps.event.addDomListener(window, "load", initMap);
</script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDNpNhw8Qyac0n7I7gHsVWtr4uc1VNN7dg&libraries=places"
    async defer></script>
<style>
    .activ_invoic a {
        font-weight: 700 !important;
        color: #004670 !important;
    }

    .btn-info {
        background: #2B2525;
        border-radius: 100px;
        border-color: #2B2525;
        margin-left: 10px;
    }

    .active_btn {
        background: #6CC8C3 !important;
        border-color: #6CC8C3 !important;
    }

    .cancel_req {
        color: #cccccc;
    }

    .req_button {
        text-align: center;
    }

    .req_lab {
        float: right;
        border-radius: 100px;
        border-color: #3f006f;
        margin-right: 50px;
        background: #3f006f !important;
    }

    .name-prod {
        display: block;
        text-align: center;
    }


    body {
        background-color: #f8fbfd;
    }

</style>
<script type="text/javascript">
    var order_typeg = 'Open';
</script>


<article class="container theme-container send_quotn_list">
    <div class="row">
        <!-- Posts Start -->
        <?php //include("my_account_menu.php"); ?>
        <aside class="col-md-12 col-sm-12 space-bottom-20 ">
            <div class="account-details-wrap ">
                <!-- <div class="title-2 sub-title-small"> Quotations  </div> -->
                <div class="req_button">
                    <button class="btn btn-info active_btn status"
                            data-order='Open'><?php echo lang('Open_Orders'); ?></button>
                    <button class="btn btn-info status"
                            data-order='Confirmed'><?php echo lang('Confirmed'); ?></button>
                    <button class="btn btn-info status"
                            data-order='Cancelled'><?php echo lang('Cancelled'); ?></button>
                    <button class="btn btn-info status"
                            data-order='Rejected'><?php echo lang('Rejected'); ?></button>

                    <button
                        class="btn btn-success req_lab login_check"><?php echo lang('Request_Quotations'); ?></button>

                </div>
                <div class="account-box  light-bg default-box-shadow recv_invoicas">
                    <div class="top_pading_sec">
                        <table class="tabl_tr_th"
                               style="margin-top: 0px; margin-bottom: 20px; ">
                            <thead>
                            <tr>
                                <th colspan="1"><?php echo lang('Items'); ?></th>
                                <th><?php echo lang('quantity'); ?></th>
                                <th><?php echo lang('Unit'); ?></th>
                                <th><?php echo lang('PID'); ?></th>
                                <th><?php echo lang('Detail'); ?></th>
                                <th><?php echo lang('Date'); ?></th>
                                <th><?php echo lang('Quotation'); ?></th>
                            </tr>
                            </thead>
                            <tbody id="table_body">
                            <?php if (!empty($quotation_list)) {
                                foreach ($quotation_list as $ql_key => $il_val) { ?>
                                    <tr class="remove<?php echo $il_val['id']; ?>">
                                        <td colspan="1" class="sn1">
                                            <a href="javascript:void(0)"
                                               class="cancel_req"
                                               data-id="<?php echo $il_val['id']; ?>">
                                                <i class="fa fa-times-circle"
                                                   aria-hidden="true"></i>
                                            </a>
                                            <img width="70px" height="70px"
                                                 src="<?php echo $il_val['product_image']; ?>">
                                            <span
                                                class="name-prod"><?php echo $il_val['product_name']; ?></span>
                                        </td>
                                        <td class="sn3"><?php echo $il_val['qty']; ?></td>
                                        <td class="sn3"><?php echo $il_val['unit_name']; ?></td>
                                        <td class="sn5"><?php echo $il_val['pid']; ?></td>
                                        <td class="sn6">
                                            <a href="<?php echo base_url($language . '/my_account/quotation_detail/') . $il_val['id']; ?>"
                                               class="">
                                                <?php echo lang('See_More'); ?>
                                            </a>
                                        </td>
                                        <td class="sndate"><?php echo date('m/d/Y', strtotime($il_val['created_date'])); ?></td>
                                        <td class="sn6">
                                            <a href="<?php echo base_url($language . '/my_account/received_invoice_list/') . $il_val['id']; ?>"
                                               class="detl_info">
                                                <i class="fa fa-info-circle"
                                                   aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td colspan="7"><?php echo lang('No_record_found'); ?></td>
                                </tr>
                            <?php } ?>

                            </tbody>
                        </table>
                        <div id="pagination"
                             class="text-center margin-top-30"><?php echo $pagination; ?>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </aside>
        <!-- Posts Ends -->
    </div>
</article>

<div class="modal fade" id="quotation" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo lang('Request_for_Quotation'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;
                </button>
            </div>
            <div class="modal-body">
                <form id="send_quotation" action="" method="post"
                      enctype="multipart/form-data">
                    <div class="form_wrap_qutn">
                        <div class="signl_form">
                            <div
                                class="singl_label"> <?php echo lang('product_name'); ?> </div>
                            <input type="text" class="singl_input_qutn space"
                                   name="product_name" id="qproduct_name">
                        </div>
                        <div class="signl_form">
                            <div
                                class="singl_label"> <?php echo lang('Product_Group'); ?> </div>
                            <select class="singl_input_qutn" name="category_id"
                                    id="qcategory_id">
                                <option
                                    value="0"><?php echo lang('Please_Select_Group'); ?></option>
                                <?php if (!empty($main_category)) {
                                    foreach ($main_category as $mc_key => $mc_val) { ?>
                                        <option
                                            value="<?php echo $mc_val['id']; ?>"><?php echo $mc_val['display_name']; ?></option>
                                    <?php }
                                } ?>
                            </select>
                        </div>
                        <div class="signl_form">
                            <div class="singl_label"> <?php echo lang('To'); ?> </div>
                            <input type="text" class="singl_input_qutn space" name=""
                                   id="seller_id" autocomplete="off">
                        </div>
                        <div id="hsven_list"
                             style="display: none;margin-left: 510px !important">fadsf
                            dfasdf
                        </div>
                        <div class="signl_form">
                            <div
                                class="singl_label"> <?php echo lang('Purchase_Cycle'); ?> </div>
                            <div class="prch_cycl">
                                <label>
                                    <input name="purchase_cycle" type="radio"
                                           value="one time">
                                    <span> <?php echo lang('One_Time'); ?> </span>
                                </label>
                                <label>
                                    <input name="purchase_cycle" type="radio"
                                           value="continuous">
                                    <span> <?php echo lang('Continuous'); ?> </span>
                                </label>
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="signl_form">
                            <div
                                class="singl_label"> <?php echo lang('Customization'); ?> </div>
                            <div class="prch_cycl">
                                <label>
                                    <input name="customiz" type="radio" value="yes">
                                    <span> <?php echo lang('Yes'); ?> </span>
                                </label>
                                <label>
                                    <input name="customiz" type="radio" value="no">
                                    <span> <?php echo lang('No1'); ?> </span>
                                </label>
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="signl_form">
                            <div
                                class="singl_label"> <?php echo lang('Deadline_for_Submission'); ?> </div>
                            <input type="text" class="singl_input_qutn" id="qdeadline"
                                   name="deadline" autocomplete="off">
                        </div>
                        <div class="signl_form">
                            <div class="singl_label"><?php echo lang('PID'); ?> </div>
                            <input type="text" class="singl_input_qutn" name="pid"
                                   id="qpid" onkeypress="return isNumberKey(event)">
                            <!-- <select class="singl_input_qutn" id="qpid" name="pid" >
                              <option value="0">Please select Product No./SKU</option>
                            </select> -->
                            <!-- <input type="text" class="singl_input_qutn" name="pid" id="qpid"> -->
                        </div>
                        <div class="signl_form">
                            <div
                                class="singl_label"> <?php echo lang('HS_Code'); ?> </div>
                            <input type="text" class="singl_input_qutn space"
                                   name="hscode" id="qhscode">
                        </div>
                        <div class="signl_form">
                            <div class="singl_label"> <?php echo lang('Unit'); ?> </div>
                            <select class="singl_input_qutn" id="qunit" name="unit">
                                <option
                                    value="0"><?php echo lang('Please_Select_Unit'); ?></option>
                                <?php if (!empty($funit_list_data)) {
                                    foreach ($funit_list_data as $fud_key => $fud_val) { ?>
                                        <option
                                            value="<?php echo $fud_val['id']; ?>"><?php echo $fud_val['unit_name']; ?></option>
                                    <?php }
                                } ?>
                            </select>
                        </div>
                        <div class="signl_form">
                            <div
                                class="singl_label"> <?php echo lang('quantity'); ?> </div>
                            <input type="text" class="singl_input_qutn space" name="qty"
                                   id="qqty" onkeypress="return isNumberKey(event)">
                        </div>
                        <div class="signl_form">
                            <div class="singl_label"> <?php echo lang('Destination'); ?>
                                <!-- <a href="javascript:void(0)" class="gps_box_a" data-toggle="tooltip" title="GPS">
                                  <i class="fa fa-location-arrow" aria-hidden="true"></i>
                                </a> -->
                                <div class="clear"></div>
                            </div>
                            <input type="text" class="singl_input_qutn searchInput"
                                   id="paddress" name="address">
                        </div>
                        <!-- <div class="signl_form">
                          <div class="singl_label"> Google Location <i class="fa fa-info-circle" title="In case of delivery to specific destination, enter coordinates."></i> </div>
                          <input type="text" class="singl_input_qutn" id="searchInput2" name="" >
                        </div>  -->
                        <!--  <input type="hidden" name="lat" id="lat2" value="">
                         <input type="hidden" name="lng" id="lng2" value=""> -->
                        <div class="signl_form">
                            <div
                                class="singl_label"> <?php echo lang('Delivery_Date'); ?> </div>
                            <input type="text" class="singl_input_qutn"
                                   id="qdelivery_date" name="delivery_date"
                                   autocomplete="off">
                        </div>
                        <div class="signl_form">
                            <div
                                class="singl_label"> <?php echo lang('Incoterms'); ?> </div>
                            <select class="singl_input_qutn" id="qincoterms"
                                    name="incoterms">
                                <option value="CFR"> CFR</option>
                                <option value="CIF"> CIF</option>
                                <option value="CIP"> CIP</option>
                                <option value="CPT"> CPT</option>
                                <option value="DAT"> DAT</option>
                                <option value="DAP"> DAP</option>
                                <option value="DDP"> DDP</option>
                                <option value="FCA"> FCA</option>
                                <option value="FAS"> FAS</option>
                                <option value="FOB"> FOB</option>
                                <option value="EXW"> EXW</option>
                            </select>
                        </div>
                        <div class="signl_form">
                            <div
                                class="singl_label"> <?php echo lang('Certification'); ?>  </div>
                            <div class="prch_cycl">
                                <label>
                                    <input name="certification" type="radio"
                                           id="qcertification" value="yes">
                                    <span> <?php echo lang('Yes'); ?> </span>
                                </label>
                                <label>
                                    <input name="certification" type="radio"
                                           id="qcertification2" value="no">
                                    <span> <?php echo lang('No1'); ?> </span>
                                </label>
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="signl_form signl_form_full signl_form_full_infor_1">
                            <div
                                class="singl_label"> <?php echo lang('Information'); ?> </div>
                            <textarea class="singl_input_qutn space" rows="5"
                                      id="qinformation" name="information"></textarea>
                        </div>

                        <div class="form-group left_input_a gmap_pop_asa">
                            <!-- <label>Location Detection</label> -->
                            <input type="text" class="form-control" name="location"
                                   id="searchInput2" value=""
                                   placeholder="Location Detection">
                            <div
                                style="padding: 10%; height: 200px; position: relative; overflow: hidden; margin-top: 26px; border-radius: 10px;"
                                id="map"></div>
                            <!-- width: 50%;;border: 1px solid black -->
                            <div class="get-map-val">
                                <input type="hidden" class="form-control"
                                       name="area_latitude" id="latitude"
                                       placeholder="Latitude" value="">
                                <input type="hidden" class="form-control"
                                       name="area_longitude" id="longitude"
                                       placeholder="Longitude" value="">
                            </div>
                            <div id="map2"></div>
                        </div>
                        <div class="clear"></div>
                        <!-- <div class="signl_form signl_form_full">
                          <div class="singl_label" style="text-align: right; padding-right: 82px;" > Attachments </div>

                          <div class="uplod_garg_pics">
                                <div class="thum_view prepend_img"></div>
                                <div class="upld_pic_labl">
                                   <input type="file" id="qimg" class="image_check">
                                   <div class="ad_grg_pic_titl"> Upload</div>
                                </div>
                          </div>  -->
                        <button style="" type="submit"
                                class="btn btn-solid"><?php echo lang('Send'); ?></button>
                    </div>
                    <div class="clear"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).on("click", ".status", function () {
        var order_type = $(this).data('order');

        if (order_type == "Open" || order_type == "Confirmed" || order_type == "Cancelled" || order_type == "Rejected") {
            if (order_typeg == order_type) {
                swal("", "<?php echo lang('You_are_on_same_tab'); ?>", "warning");
                return false;
            }
            $('.status').removeClass("active_btn");
            $(this).addClass("active_btn");
            order_typeg = order_type;
            var ajax = "call";
            $('#loading').show();
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url(); ?>my_account/send_quotation_list/",
                data: {'order_type': order_typeg, ajax: ajax},
                success: function (response) {
                    create_table(order_type, response)
                    //alert(group_by);
                    $('#loading').hide();
                }
            });
        } else {
            swal("", "Invalid order type", "warning");
        }
    });

    $('#pagination').on('click', 'a', function (e) {
        e.preventDefault();
        var ajax = "call";
        var pageno = $(this).attr('data-ci-pagination-page');
        // alert(pageno);
        // return false;
        // data: {'car_make':gcar_make,'car_model':gcar_model,'select_year':gselect_year,'price_start':gprice_start,'price_end':gprice_end,'sort':gsort,ajax:ajax,pageno:pageno},
        if (typeof pageno !== 'undefined') {
            $('#loading').show();
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url(); ?>my_account/send_quotation_list/",
                data: {'order_type': order_typeg, ajax: ajax, pageno: pageno},
                success: function (response) {
                    create_table(order_typeg, response)
                    //alert(group_by);
                    $('#loading').hide();

                }
            });
        } else {
            swal("", "You are already on pageno 1", 'warning');
        }
    });

    function create_table(order_type, response) {
        var trHTML = '';
        var data = $.parseJSON(response);

        if (data.result != '') {
            $("#pagination").html(data.pagination);
            // trHTML+='<thead>';
            // trHTML+='<tr>';
            // trHTML+='<th>Date</th>';
            // trHTML+='<th>Sum duration</th>';
            // trHTML+='<th>Count</th>';
            // trHTML+='<th>Avg revenue</th>';
            // trHTML+='</tr>';
            // trHTML+='</thead>';
            $.each(data.result, function (k, v) {
                trHTML += '<tr class="remove' + v.id + '">';
                trHTML += '<td colspan="1" class="sn1"><a href="javascript:void(0)" class="cancel_req" data-id="' + v.id + '" > <i class="fa fa-times-circle" aria-hidden="true"></i> </a><img width="70px" height="70px" src="' + v.product_image + '"> <span>' + v.product_name + '</span></td>';
                trHTML += '<td class="sn3">' + v.qty + '</td>';
                trHTML += '<td class="sn3">' + v.unit_name + '</td>';
                trHTML += '<td class="sn3">' + v.pid + '</td>';
                trHTML += '<td class="sn6"><a href="<?php echo base_url($language);?>/my_account/quotation_detail/' + v.id + '" class=""  ><?php echo lang('See_More'); ?></a>';
                trHTML += '<td class="sndate">' + v.created_date + '</td>';

                trHTML += '<td class="sn6" ><a href="<?php echo base_url();?>my_account/received_invoice_list/' + v.id + '" class="detl_info"  ><i class="fa fa-info-circle" aria-hidden="true"></i></a></td>';
                trHTML += '</tr>';
            });

            // alert(trHTML);
            // console.log(trHTML);
            $('#table_body').html(trHTML);
            // swal('',"Todo note data added successfully","success");
            // setTimeout(function(){ location.reload(); }, 2000);
        } else {
            trHTML += '<tr><td colspan="7"><?php echo lang('No_record_found'); ?></td></tr>';
            $("#pagination").hide();
            $('#table_body').html(trHTML);
            swal('', "<?php echo lang('No_record_found'); ?>", "warning");
        }
    }
</script>
<script type="text/javascript">
    $(document).on("click", ".cancel_req", function () {
        var req_id = $(this).data('id');
        swal({
                title: "<?php echo lang('Are_you_sure'); ?>",
                text: "<?php echo lang('You_want_to_cancel_this_request'); ?>",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "<?php echo lang('Yes'); ?>",
                cancelButtonText: "<?php echo lang('Cancel'); ?>",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function (inputValue) {
                if (inputValue === true) {
                    $('#loading').show();
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url($language); ?>/ajax/cancel_request",
                        data: {'req_id': req_id},
                        success: function (response) {
                            $('#loading').hide();
                            $response = $.trim(response);
                            var response = $.parseJSON(response);
                            if (response.status == true) {
                                $('.remove' + req_id).remove();
                                swal("", response.message, 'success');
                            } else {
                                swal("", response.message, 'warning');
                            }
                        }
                    });
                }
            });

    });
</script>

<script type="text/javascript">
    $(document).on("click", ".login_check", function () {
        $('#loading').show();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url($language . '/ajax/login_check') ?>',
            data: {is_user: "user"},
            success: function (response) {
                $('#loading').hide();
                response = $.trim(response);
                if (response == 1) {
                    index_g = '';
                    image_gallery_g = '';
                    $(".prepend_img").empty();
                    $('#quotation').modal('show');
                    initMap2();
                } else {
                    swal({
                            title: "",
                            text: "<?php echo lang('Please_login_or_create_account'); ?>",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonText: "<?php echo lang('OK'); ?>",
                            cancelButtonText: "<?php echo lang('Cancel'); ?>",
                            closeOnConfirm: true,
                            closeOnCancel: true
                        },
                        function (inputValue) {
                            if (inputValue === true) {
                                window.location = "<?php echo base_url($language . '/login'); ?>";
                            }
                        });
                }
            }
        });
    });


    // function readURL(input) {
    //   if (input.files && input.files[0]) {
    //       var reader = new FileReader();
    //       reader.onload = function(e) {
    //           $('#img-quotation').attr('src', e.target.result);
    //       };
    //       reader.readAsDataURL(input.files[0]);
    //   }
    // }

    // $("#qimg").change(function() {
    //   readURL(this);
    // });

    $(document).on("submit", "#send_quotation", function (e) {
        e.preventDefault();

        var seller_id = $("#seller_id").val();
        var qproduct_name = $.trim($("#qproduct_name").val());
        var qcategory_id = $("#qcategory_id").val();
        var purchase_cycle = $('input[name=purchase_cycle]:checked').val();
        var customiz = $('input[name=customiz]:checked').val();
        var qdeadline = $("#qdeadline").val();
        var qpid = $.trim($("#qpid").val());
        var qhscode = $.trim($("#qhscode").val());
        var qunit = $("#qunit").val();
        var qqty = $.trim($("#qqty").val());
        var paddress = $("#paddress").val();
        var qdelivery_date = $("#qdelivery_date").val();
        var qincoterms = $("#qincoterms").val();
        var certification = $('input[name=certification]:checked').val();
        var qinformation = $.trim($("#qinformation").val());
        var searchInput2 = $("#searchInput2").val();
        var lat2 = $("#latitude").val();
        var lng2 = $("#longitude").val();
        var error = 1;


        // if(g_seller_id=='')
        // {
        //    error=0;
        //    swal("","Please select/enter vendor name2","warning");
        //    return false;
        // }


        if (qproduct_name == '') {
            error = 0;
            swal("", "<?php echo lang('Please_enter_product_name'); ?>", "warning");
            return false;
        }

        if (qcategory_id == '' || qcategory_id == 0) {
            error = 0;
            swal("", "<?php echo lang('Please_select_product_group'); ?>", "warning");
            return false;
        }
        if (seller_id == '') {
            error = 0;
            swal("", "<?php echo lang('Please_select_enter_vendor_name'); ?>", "warning");
            return false;
        }

        if (typeof purchase_cycle === "undefined") {
            swal("", "<?php echo lang('Please_select_purchase_cycle'); ?>", "warning");
            error = 0;
            return false;
        }

        if (typeof customiz === "undefined") {
            swal("", "<?php echo lang('Please_select_customization'); ?>", "warning");
            error = 0;
            return false;
        }

        if (qdeadline == '') {
            error = 0;
            swal("", "<?php echo lang('Please_enter_deadline_for_submission'); ?>", "warning");
            return false;
        }

        if (qpid == '0' || qpid == '') {
            error = 0;
            swal("", "<?php echo lang('Please_enter_product_id'); ?>", "warning");
            return false;
        }

        if (qunit == '' || qunit == 0) {
            error = 0;
            swal("", "<?php echo lang('Please_Select_Unit'); ?>", "warning");
            return false;
        }

        if (qqty == '') {
            error = 0;
            swal("", "<?php echo lang('Please_enter_quantity'); ?>", "warning");
            return false;
        }

        if (paddress == '') {
            error = 0;
            swal("", "<?php echo lang('Please_enter_destination'); ?>", "warning");
            return false;
        }

        if (searchInput2 != '') {
            if (lat2 == '' || lng2 == '') {
                error = 0;
                swal("", "<?php echo lang('Please_select_perfect_google_address'); ?>", "warning");
                return false;
            }
        }
        if (qdelivery_date == '') {
            error = 0;
            swal("", "<?php echo lang('Please_enter_delivery_date'); ?>", "warning");
            return false;
        }

        if (typeof certification === "undefined") {
            swal("", "<?php echo lang('Please_select_Certification'); ?>", "warning");
            error = 0;
            return false;
        }

        if (qinformation == '') {
            error = 0;
            swal("", "<?php echo lang('Please_enter_Information'); ?>", "warning");
            return false;
        }


        if (error == 1) {
            // alert('success');
            // return false;
            fd = new FormData(this);
            fd.append("seller_id", g_seller_id);
            fd.append("document", image_gallery_g);
            fd.append("google_address", searchInput2);
            fd.append("lat", lat2);
            fd.append("lng", lng2);
            $('#loading').show();
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('ajax/send_quotation'); ?>",
                // data: new FormData(this),
                data: fd,
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    $('#loading').hide();
                    response = $.trim(response);
                    if (response == 1) {
                        index_g = '';
                        image_gallery_g = '';
                        $(".prepend_img").empty();
                        $('#quotation').modal('hide');
                        $('#img-quotation').attr('src', "");
                        $("#send_quotation")[0].reset();
                        swal("<?php echo lang('Quotation_Request_Send_successfully'); ?>", "<?php echo lang('Vender_admin_will_Contact_you_soon'); ?>", "success");
                    } else if (response == "login") {
                        swal("", "<?php echo lang('Please_login_or_create_account'); ?>", "warning");
                    } else if (response == "invalid_pro") {
                        swal("", "<?php echo lang('Please_enter_valid_Product_No_SKU'); ?>", "warning");
                    } else {
                        swal("", "<?php echo lang('Something'); ?>", "warning");
                    }
                }
            });
        }

    });

    $(document).on("keyup", "#seller_id", function () {
        var search_val = $(this).val();
        // if(search_val!='')
        // {
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('ajax/get_vender_name'); ?>",
            data: {'search': search_val},
            success: function (response) {
                response = $.trim(response);
                var response = $.parseJSON(response);
                if (response.status == true) {
                    $('#hsven_list').show();
                    $("#hsven_list").html(response.data);
                } else {
                    $('#hsven_list').hide();
                }
            }
        });
        // }
    });

    $(document).on("click", ".vendor_name", function () {
        var id = $(this).data('id');
        // alert(id);
        g_seller_id = id;
        var name = $(this).text();
        $("#seller_id").val(name);
        $('#hsven_list').hide();
    });
</script>

<script type="text/javascript">
    $(document).on("change", ".image_check", function () {
        var class_name = $(this).data("class");
        // file = this.files[0];
        files = this.files;
        if (files.length > 0) {
            for (i = 0; i < files.length; i++) {
                maxSize = 2048;
                var imagefile = files[i].type;
                file_tp = imagefile.slice(-3);
                var imagesize = files[i].size;
                imagesize = Math.round((imagesize / 1024));
                var match = ["image/jpeg", "image/png", "image/jpg", "application/pdf", "application/vnd.openxmlformats-officedocument.wordprocessingml.document"];
                if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]) || (imagefile == match[3]) || (imagefile == match[4]))) {
                    // swal("",'Please select a valid image file (JPEG/JPG/PNG).');
                    alert("Please select a valid image file (JPEG/JPG/PNG)");
                    // $(".image_check").val('');
                    return false;
                } else if (imagesize > maxSize) {
                    swal("", "File should be less than 2 mb", "warning");
                    return false;
                } else {
                    image_gallery_arr = image_gallery_g.split(',');
                    // alert(image_gallery_arr.length);
                    if (image_gallery_arr.length > 24) {
                        swal("", "You can upload only 24 cars", "warning");
                        return false;
                    }
                    // readURL(this,class_name);
                    // file =jQuery("#file")[0];
                    fd = new FormData();
                    // console.log(this.files.length);
                    // console.log(this.files);
                    // return false;
                    individual_capt = "Quotation image";
                    fd.append("caption", individual_capt);
                    fd.append('action', 'fiu_upload_file');
                    fd.append("file", this.files[i]);
                    fd.append("path", 'admin/inquiry_doc/');
                    fd.append("count", i + 1);
                    $("#loading").show();
                    jQuery.ajax({
                        type: 'POST',
                        url: 'file_handling/uploadFiless',
                        data: fd,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (response) {
                            $("#loading").hide();
                            if (response == "false") {
                                swal("", "Something went wrong, Please try again...", "warning");
                            } else {

                                // jQuery('[data-image]').attr('src', img);
                                // var images = jQuery('#image_gallery').val();
                                // var index = jQuery('#index').val();
                                // alert(response);
                                if (image_gallery_g == '') {
                                    image_gallery_g = response;
                                } else {
                                    image_gallery_g = image_gallery_g + ',' + response;
                                }
                                image_gallery_arr = image_gallery_g.split(',');

                                // alert(image_gallery_arr.length);
                                if (file_tp == 'pdf') {
                                    var path = '<?php echo base_url("assets/frontend/images/"); ?>pdf.png';
                                } else if (file_tp == 'ent') {
                                    var path = '<?php echo base_url("assets/frontend/images/"); ?>doc.png';
                                } else {
                                    var path = '<?php echo base_url("assets/admin/inquiry_doc/"); ?>' + response + '';
                                }
                                jQuery('.prepend_img').append('<div class="singl_img_up" id="pic' + index_g + '" data-name="' + response + '"> <img id="img-quotation"src="' + path + '"> <a onclick="remove_pic(\'' + index_g + '\',\'' + ',' + response + '\')"> <i class="fa fa-times"></i> </a> </div>');
                                // jQuery('#image_gallery').val(image_gallery_g + ',' + response);
                                index_g = parseInt(index_g) + 1;
                            }
                        }
                    });
                }

            }

        }

    });
</script>
