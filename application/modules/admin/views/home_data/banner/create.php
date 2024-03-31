<div class="col-md-12" style="float: right;">
    <div class="button  ">
        <a href="<?php echo base_url($language . '/admin/home_data'); ?>"
           class=" back_to_list btn btn-primary">Back to list</a>
    </div>
</div>


<?php echo $form->messages();
$heading1 = $heading2 = $myimage = $main_cat = $status = '';

if (isset($edit)) {
    $heading1 = $edit['heading1'];
    // $heading2 = $edit['heading2'];
    $myimage = $edit['image'];
    $main_cat = $edit['main_cat'];
    $status = $edit['status'];
}
if (empty($status)) {
    $active = 'checked';
    $deactive = '';
} else if ($status == 'active') {
    $active = 'checked';
    $deactive = '';
} else {
    $active = '';
    $deactive = 'checked';
}
?>

<section class="content">
    <div class="row space-get margin_20">
        <div class="col-md-12">
            <div class="panel panel-default main_wrap_form">
                <div class="panel-heading">
                    Add Banner
                </div>
                <div class="panel-body">
                    <?php echo $form->open(); ?>

                    <div class="form-group">
                        <label for="heading1"> Heading</label>
                        <input class="form-control space" id="heading1" name="heading1"
                               placeholder="Enter First heading" type="text"
                               value="<?php echo $heading1 ?>" autocomplete="off">
                    </div>

                    <!-- <div class="form-group">
                            <label for="exampleInputEmail1"> Heading second</label>
                            <input class="form-control" name="heading2" value="<?php //echo $heading2 ?>"  placeholder="Enter second heading" type="text" required="" autocomplete="off" >
                        </div>  -->

                    <div class="form-group">
                        <label for="exampleInputEmail1"> Select Category</label>
                        <select id="select_main" name="main_cat">
                            <option value='0'>Select Category</option>
                            <?php if (!empty($category_data)) {
                                foreach ($category_data as $cd_key => $cd_val) {
                                    $selected = ($main_cat == $cd_val['id']) ? "selected" : "";
                                    ?>
                                    <option
                                        value='<?php echo $cd_val['id']; ?>' <?php echo $selected; ?>><?php echo $cd_val['display_name']; ?></option>
                                <?php }
                            } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label style="margin-bottom: 15px;"> Status</label>
                        <div class="clear"></div>
                        <label><input
                                style="float: left; margin-top: 1px; margin-left: 2px; margin-right: 5px;"
                                type="radio" name="status"
                                value="active" <?php echo $active; ?>>Active</label>
                        <label><input
                                style="float: left; margin-top: 1px; margin-left: 2px; margin-right: 5px; margin-left: 10px;"
                                type="radio" name="status"
                                value="deactive" <?php echo $deactive; ?>>Deactive</label>
                    </div>
                    <div class="clear"></div>

                    <div class="form-group">
                        <label for="exampleInputPassword1"> Image </label>

                        <!-- Hidden records -->
                        <input type="hidden" id="photo_url"
                               value="<?php echo base_url('admin/file_handling/uploadFiless'); ?>"/>
                        <input type="hidden" id="img_url" value="admin/banner/"/>
                        <input type="hidden" name="image" id="file_name"
                               value="<?php echo $myimage; ?>" required="required">

                        <br>
                        <div class="col-inner">
                            <?php //print_r($myimage); ?>
                            <input type="file" id="file"
                                   value="<?php echo $myimage; ?>"/>
                            <label for="file" class="file__drop" data-image-uploader>
                                <span class="text">&nbsp;</span>
                                <div
                                    style="position: relative; width: 66px;height: 74px;margin-left: 20px;"
                                    id="img_div">
                                    <img data-image
                                         src="<?php echo base_url("assets/admin/banner/$myimage"); ?>"
                                         style=" width: 100px;height: 70px; "
                                         id="dis_image"/>
                                    <div class="preloader pl-size-l"
                                         style="position: absolute;margin-top: 14px;margin-left: 19px;"
                                         id="img_loader">
                                        <div class="spinner-layer pl-light-green">
                                            <div class="circle-clipper left">
                                                <div class="circle"></div>
                                            </div>
                                            <div class="circle-clipper right">
                                                <div class="circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                if (!isset($edit)) { ?>
                                    <span
                                        class="choose-image "><?php echo "Choose Image for <br> banner"; ?>
                                        </span>
                                <?php } ?>

                            </label>
                        </div>
                        <!-- <p>Image size must be ( width-211px * height-209px ) </p> -->

                    </div>

                    <?php echo $form->bs3_submit(); ?>

                    <?php echo $form->close(); ?>

                    <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<script type="text/javascript">

    $(document).ready(function () {
        $('#img_loader').hide();


        <?php if (isset($edit)) { ?>

        $('#img_div').show();
        $('#dis_image').show();
        <?php    }
        else{ ?>
        $('#img_div').hide();
        $('#dis_image').hide();
        <?php   } ?>
    });

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

        $('#img_div').show();
        $('#img_loader').show();
        $('#dis_image').hide();
        $('.choose-image').hide();

        file = jQuery("#file")[0];
        fd = new FormData();
        console.log(file.files[0]);
        individual_capt = "My logo";
        fd.append("caption", individual_capt);
        fd.append('action', 'fiu_upload_file');
        fd.append("file", file.files[0]);
        fd.append("path", $('#img_url').val());

        jQuery.ajax({
            type: 'POST',
            url: $('#photo_url').val(),
            data: fd,
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                $('#img_loader').hide();
                $('#dis_image').show();
                if (response == "false") {
                    alert("Something went wrong, Please try again...");
                } else {
                    jQuery('[data-image]').attr('src', img);
                    jQuery('#file_name').val(response);
                }
            }
        });
    }
</script>


<style type="text/css">
    button.btn.btn-primary {
        clear: both;
        float: left;
        margin-left: 10px;
    }

    .alert-danger {
        background-color: #fb483a !important;
        clear: both;
        margin-bottom: -73px;
    }

    .main_wrap_form .form-group label {
        font-weight: 500;
        font-size: 15px;
    }

    .margin_20 {
        margin-top: 14px;
    }

    .main_wrap_form .panel-heading {
        font-weight: 500;
        font-size: 16px;
    }

    .main_wrap_form .form-group label {
        font-weight: 500;
        font-size: 15px;
    }

    .main_wrap_form .form-control {
        box-shadow: 0px 0px 0px #fff;
        border-radius: 3px;
        font-size: 13px;
        padding: 6px 12px;
        border: 1px solid #aaaaaa;
        height: 40px;
        line-height: 40px;
        border-radius: 100px;
    }

    .chosen-container-single .chosen-single {
        border-radius: 100px;
        background: #fff;
    }


    .main_wrap_form .form-control:focus {
        border: 1px solid #bdbcbc;
    }

    .btn-primary {
        float: right;
        font-weight: 500;
        font-size: 15px !important;
        padding: 9px 20px;
        margin-top: 10px;
        border-radius: 3px !important;
        margin-bottom: 30px;
        border: 1px solid #14a988 !important;
        color: #14a988;
        background-color: white !important;
        transition-duration: 0.2s;
    }


    /* button.btn.btn-primary:hover {
     background-color: #2c3741!important;
     border: 1px solid #2c3741!important;
     color: #fff;
     padding: 9px 20px;
     float: right;
     font-weight: 500;
     font-size: 15px!important;
     margin-top: 10px;
     border-radius: 3px !important;
     margin-bottom: 30px;
     }
     .btn:not(.btn-link):not(.btn-circle):hover {
     outline: none;
     background-color: #2c3741!important;
     border: 1px solid #2c3741!important;
     }*/
    .alert.alert-success {
        clear: both;
    }

    .header {
        display: none;
    }

    .form-group {
        width: 49%;
        margin-bottom: 20px;
        float: left;
        margin-left: 10px;
    }


</style>

<script type="text/javascript">
    $(document).on("submit", 'form', function (e) {
        // e.preventDefault();
        var heading1 = $.trim($("#heading1").val());
        var select_main = $.trim($("#select_main").val());
        var file_name = $.trim($("#file_name").val());

        var error = 1;
        if (heading1 == '') {
            $error = 0;
            swal('', "Please enter heading", 'warning');
            return false;
        }

        if (select_main == 0) {
            $error = 0;
            swal('', "Please select category", 'warning');
            return false;
        }

        if (file_name == '') {
            $error = 0;
            swal('', "Please select image", 'warning');
            return false;
        }
    });
</script>
