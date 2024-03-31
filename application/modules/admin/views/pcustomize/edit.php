<style type="text/css">
    span.remove_att {
        border-radius: 10px;
        position: relative;
        margin-bottom: 11px;
        overflow: hidden;
        padding: 10px !important;
        color: white;
        top: -4px;
        left: 10px;
        font-size: 12px;
        cursor: pointer;
    }
</style>
<?php

if ($pcustomize_data[0]['type'] == '1' || $pcustomize_data[0]['type'] == '2') {

    $radio_selected = 'selected';

    $check_selected = '';

    $limit_flag = 0;

    // this flage for radio or check free

    $type_flat = 1;

} else {

    $check_selected = 'selected';

    $radio_selected = '';

    $limit_flag = 1;

    $type_flat = 0;

}

$select_val = $pcustomize_data[0]['type'];

if ($pcustomize_data[0]['status'] == '1') {

    $status_active = 'checked';

    $status_deactive = '';

} else {

    $status_deactive = 'checked';

    $status_active = '';

}

?>

<div class="row clearfix">

    <div class="col-md-12">

        <div class="demo-masked-input">

            <form action="" method="post" id="Pcustomize">

                <div class="row">

                    <div class="col-sm-4">

                        <label for="category">Customize</label>

                        <div class="form-group form-float form-group-lg">

                            <div class="form-line">

                                <input type="text" name="title"
                                       value="<?php echo $pcustomize_data[0]['title']; ?>"
                                       placeholder="Product Name" id="title"
                                       autocomplete="off" class="form-control space ">

                            </div>

                        </div>

                    </div>

                    <div class="col-sm-4">

                        <label for="category">Type</label>

                        <select placeholder="" id="cus_type" name="type" disabled>

                            <option value="">Select Type</option>

                            <?php if ($type_flat == '1') {

                                if ($select_val == 1) { ?>

                                    <option value="1" selected>Radio</option>

                                <?php } else { ?>

                                    <option value="2" selected>>check box free</option>

                                <?php }
                            } else { ?>

                                <option value="3" selected>check box paid</option>

                            <?php } ?>

                        </select>

                    </div>

                    <input type="hidden" name="type" value="<?php echo $select_val; ?>">

                    <?php

                    if ($pcustomize_data[0]['type'] == '3') { ?>

                        <div class="col-sm-2" id="check_paid">

                            <label for="category">Limit</label>

                            <div class="form-group form-float form-group-lg">

                                <div class="form-line">

                                    <input type="text" name="add_limit"
                                           value="<?php echo $pcustomize_data[0]['add_limit'] ?>"
                                           placeholder="Limit" id="add_limit"
                                           autocomplete="off" class="form-control"
                                           onkeypress="return isNumberKey(event)">

                                </div>

                            </div>

                        </div>

                    <?php } ?>

                    <div class="col-sm-2">

                        <div class="form-group">

                            <label for="groups">Status</label>

                            <div>

                                <input type="radio" name="status" value="1" id="active"
                                       class="with-gap radio-col-green" <?php echo $status_active; ?> >

                                <label for="active">Active</label>

                                <input type="radio" name="status" value="0"
                                       id="deactive"
                                       class="with-gap radio-col-green" <?php echo $status_deactive; ?>>

                                <label for="deactive">Deactive</label>

                            </div>

                        </div>

                    </div>

                </div>

                <?php if (!empty($pcustomize_data[0]['pcustomize_attr'])) {

                $att_count = count($pcustomize_data[0]['pcustomize_attr']);

                $i = 1;

                if ($type_flat == '1') { ?>

                <div class="row" class="append_custom">

                    <?php } ?>

                    <?php foreach ($pcustomize_data[0]['pcustomize_attr'] as $pcus_key => $pcus_val) {

                        ?>

                        <!-- this for to get customize id -->

                        <div style="display:none"
                             class="col-sm-4 remove<?php echo $pcus_val['id']; ?>">

                            <label for="category">Name</label>

                            <div class="form-group form-float form-group-lg">

                                <div class="form-line">

                                    <input type="hidden" name="a_id[]"
                                           value="<?php echo $pcus_val['id']; ?>"
                                           placeholder="Product Name" id=""
                                           autocomplete="off" class="form-control">

                                </div>

                            </div>

                        </div>


                        <?php if ($type_flat == '1') { ?>

                            <div class="col-sm-6 remove<?php echo $pcus_val['id']; ?>">

                                <label for="category">Name</label>

                                <span class="remove_att" data-value=""
                                      data-id="<?php echo $pcus_val['id']; ?>"
                                      style="padding: 10px; background-color: #e46767;">Remove</span>

                                <div class="form-group form-float form-group-lg">

                                    <div class="form-line">

                                        <input type="text" name="name[]"
                                               value="<?php echo $pcus_val['name']; ?>"
                                               placeholder="Product Name" id="title"
                                               autocomplete="off"
                                               class="form-control att_name space">

                                    </div>

                                </div>

                            </div>

                        <?php } else { ?>


                            <div class="row" class="append_custom">


                                <div
                                    class="col-sm-6 remove<?php echo $pcus_val['id']; ?>">

                                    <label for="category">Name</label>

                                    <div class="form-group form-float form-group-lg">

                                        <div class="form-line">

                                            <input type="text" name="name[]"
                                                   value="<?php echo $pcus_val['name']; ?>"
                                                   placeholder="Product Name" id="title"
                                                   autocomplete="off"
                                                   class="form-control att_name space">

                                        </div>

                                    </div>

                                </div>


                                <!-- <div class="col-sm-4 remove<?php echo $pcus_val['id']; ?>">

               <label for="category">Price Bahrain</label>

               <div class="form-group form-float form-group-lg">

                  <div class="form-line">

                     <input type="text" name="price_bh[]" value="<?php echo $pcus_val['price_bh']; ?>" placeholder="Product Name" id="title" autocomplete="off" class="form-control att_priceb ">

                  </div>

               </div>

            </div> -->

                                <div
                                    class="col-sm-6 remove<?php echo $pcus_val['id']; ?>">

                                    <label for="category">Price</label>

                                    <span class="remove_att" data-value=""
                                          data-id="<?php echo $pcus_val['id']; ?>"
                                          style="padding: 10px; background-color: #e46767;">Remove</span>

                                    <div class="form-group form-float form-group-lg">

                                        <div class="form-line">

                                            <input type="text" name="price[]"
                                                   value="<?php echo $pcus_val['price']; ?>"
                                                   placeholder="Product Name" id="title"
                                                   autocomplete="off"
                                                   class="form-control att_price ">

                                        </div>

                                    </div>

                                </div>


                            </div>

                        <?php } ?>

                        <?php $i++;
                    }
                    if ($type_flat == '1') {
                        echo "</div>";
                    } ?>

                    <?php } else {
                        $att_count = 0;
                    } ?>

                    <div class="row" id="append_custom">

                    </div>

                    <button type="button" id="add_att" class="btn btn-primary">Add
                    </button>

                    <button type="submit" class="btn btn-primary">Submit</button>

            </form>

        </div>

    </div>

</div>

<script type="text/javascript">

    var check_flag = 0;

    var count =<?php echo $att_count ?>;

    var limit_flag =<?php echo $limit_flag ?>;

    var select_val =<?php echo $select_val ?>;

    $(document).on("click", "#add_att", function () {

        // alert("fasdf");

        var error = 1;

        if (select_val == 1) {

            var att_name = $(".att_name").val();

            if (att_name == '') {

                swal("", "Plese Enrer name ", "warning");

                error = 0;

                return false;

            }

            if (error == 1) {

                count++;

                $("#append_custom").append('<div class="col-sm-4 remove_radioall remove' + count + '"> <label for="category">Name</label><span class="remove_att" data-value="jquery" data-id="' + count + '" style="padding: 10px; background-color: #e46767;">Remove</span> <div class="form-group form-float form-group-lg"> <div class="form-line"> <input type="text" name="name[]"  value="" placeholder="Name" id="title" autocomplete="off" class="form-control att_name space" required> </div> </div> </div>');

            }

        } else if (select_val == 2) {

            var att_name = $(".att_name").val();

            if (att_name == '') {

                swal("", "Plese Enrer name ", "warning");

                error = 0;

                return false;

            }

            if (error == 1) {

                count++;

                $("#append_custom").append('<div class="col-sm-4 remove_freeall remove' + count + '"> <label for="category">Name</label> <span class="remove_att" data-value="jquery" data-id="' + count + '" style="padding: 10px; background-color: #e46767;">Remove</span> <div class="form-group form-float form-group-lg"> <div class="form-line"> <input type="text" name="name[]"  value="" placeholder="Name" id="title" autocomplete="off" class="form-control att_name space" required> </div> </div> </div>');

            }

        } else if (select_val == 3) {


            // var att_priceb=$(".att_priceb").val();

            var att_pricea = $(".att_price").val();

            if (att_pricea == '') {

                swal("", "Plese Enter price  ", "warning");

                error = 0;

                return false;

            }

            if (att_pricea == '') {

                swal("", "Plese Enrer price ", "warning");

                error = 0;

                return false;

            }

            if (error == 1) {

                count++;


                var chebox_paid = '';

                chebox_paid += '<div class="col-sm-6 remove_paidall remove' + count + '"> <label for="category">Name</label> <div class="form-group form-float form-group-lg"> <div class="form-line"> <input type="text" name="name[]"  value="" placeholder="Name" id="title" autocomplete="off" class="form-control att_name space" required> </div> </div> </div> ';


                // chebox_paid+='<div class="col-sm-4 remove_paidall remove'+count+'" > <label for="category">Price Bahrain</label> <div class="form-group form-float form-group-lg"> <div class="form-line"> <input type="text" name="price_bh[]"  value="" placeholder="Price Bahrain" id="title" autocomplete="off" class="form-control att_priceb att_p" onkeypress="return isNumberKey(event)" required> </div> </div> </div> ';


                chebox_paid += '<div class="col-sm-6 remove_paidall remove' + count + '"> <label for="category">Price </label> <span class="remove_att" data-value="jquery" data-id="' + count + '" style="padding: 10px; background-color: #e46767;">Remove</span> <div class="form-group form-float form-group-lg"> <div class="form-line"> <input type="text" name="price[]"  value="" placeholder="Price " id="title" autocomplete="off" class="form-control att_price att_p" onkeypress="return isNumberKey(event)" required> </div> </div> ';

                $("#append_custom").append(chebox_paid);

            }

        } else {

            alert("else");

        }

    });

    $(document).on("submit", "#Pcustomize", function (e) {

        e.preventDefault();

        var title = $("#title").val();

        var type = $("#cus_type").val();

        var error = 1;

        if (title == '') {

            swal("", "Plese Enrer Customize Title", "warning");

            error = 0;

            return false;

        }

        if (type == '') {

            swal("", "Plese Select type", "warning");

            error = 0;

            return false;

        }

        if (limit_flag == 1) {

            var add_limit = $("#add_limit").val();

            if (add_limit == '') {

                swal("", "Plese Enrer Limit", "warning");

                error = 0;

                return false;

            }

            if (add_limit <= 0) {

                swal("", "Please Enter Limit Value Grater Than Zero", "warning");

                error = 0;

                return false;

            }

        }

        if (error == 1) {

            $("#loading").show();

            $.ajax({

                type: 'POST',

                url: "<?php echo base_url('admin/pcustomize/edit/') . $pcustomize_data[0]['id']; ?>",

                data: new FormData(this),

                contentType: false,

                cache: false,

                processData: false,

                success: function (response) {

                    // response);

                    $("#loading").hide();

                    response = response.replace(/\s/g, '')

                    if (response == 'att_error') {

                        swal("", "Please Add Attribute", "warning");

                    } else if (response == 'already') {

                        swal("", "Customize title already added", "warning");

                    } else if (response == 1) {

                        swal("", "Customize added successfully", "success");

                        setTimeout(function () {
                            location.reload();
                        }, 1500);

                    } else {

                        swal("", "something went wrong", "warning");

                    }


                }

            });

        }

        // alert("fasdf");

    });


</script>

<script type="text/javascript">

    // $(document).on("click",".remove_att",function(){

    //    id=$(this).attr("data-id");

    //    $(".remove"+id).remove();

    // });

</script>


<script type="text/javascript">

    $(document).on('click', ".remove_att", function () {

        var pid = $(this).data('id');

        var value = $(this).data('value');


        if (pid != '') {

            swal({

                    title: "",

                    text: "Are you sure you want to delete this product!!",

                    type: "warning",

                    showCancelButton: true,

                    confirmButtonText: "OK",

                    cancelButtonText: "CANCEL",

                    closeOnConfirm: true,

                    closeOnCancel: true

                },

                function (inputValue) {

                    if (inputValue === true) {

                        if (value == '') {

                            $.ajax({

                                type: 'POST',

                                url: '<?php echo base_url('admin/pcustomize/detete_pcustomize'); ?>',

                                data: {pid: pid},

                                success: function (response) {

                                    if (response) {

                                        swal("", "Product Delete successfully", 'success');

                                        $(".remove" + pid).remove();

                                        // setTimeout(function(){ location.reload(); }, 2000);

                                    } else {

                                        swal("", "Some thing want worng!!", "warning");

                                    }

                                }

                            });

                        } else {

                            swal("", "Product Delete successfully", 'success');

                            $(".remove" + pid).remove();

                        }

                    }

                });

        } else {

            swal("", "Some thing want worng!!", "warning");

        }


    });

</script>
