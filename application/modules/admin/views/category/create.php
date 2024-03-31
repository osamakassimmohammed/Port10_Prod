<div class="col-md-12"
     style="float: right;    margin-bottom: 0px;    height: 10px; margin-top: -10px;">
    <a href="<?php echo base_url($language) ?>/admin/category" class="back_button">Back
        to list</a>
</div>

<br>


<?php echo $form->messages();
$display_name = $myparent = $active = $myimage = $banner_image = '';
if (isset($catid) && !empty($catid)) {
    $myparent = $catid;
}
if (isset($edit)) {
    $display_name = $edit['display_name'];
    $myparent = $edit['parent'];
    $myimage = $edit['image'];
    $banner_image = $edit['banner_image'];
    $active = $edit['status'] == 'active' ? 'checked' : '';
    $deactive = $edit['status'] == 'deactive' ? 'checked' : '';
} else {

    $deactive = '';
    $active = 'checked';
}

if (empty($type)) {
    $type = 'category';
}
?>


<div class="row">

    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header">
                <!-- <h3 class="box-title">User Info</h3> -->
            </div>
            <div class="box-body">
                <?php echo $form->open(); ?>

                <?php $cn = "Category Name";
                if ($type == "vendor") $cn = "Category Name";
                echo $form->bs3_text($cn, 'display_name', $display_name, array('required' => '', "class" => "space")); ?>
                <div class="form-group">
                    <label for="groups">Status</label>
                    <div>
                        <?php echo $form->bs3_radio('Active', 'status', 'active', array('required' => ''), $active); ?>
                        <?php echo $form->bs3_radio('Deactive', 'status', 'deactive', array('required' => ''), $deactive); ?>
                    </div>
                </div>


                <!-- Hidden records -->
                <input type="hidden" id="photo_url"
                       value="<?php echo base_url('admin/file_handling/uploadFiless'); ?>"/>
                <input type="hidden" id="img_url" value="admin/category/"/>
                <input type="hidden" name="image" id="file_name"
                       value="<?php echo $myimage; ?>" required="required">

                <select class="form-control show-tick " name="parent"
                        data-placeholder="Choose Parent Category" <?php if ($vendor == 1) {
                    echo "required";
                } ?>>
                    <option/>
                    <?php
                    foreach ($parent as $key => $value) {
                        $selected = ($myparent == $key) ? "selected='selected'" : "";
                        echo "<option value='$key' " . $selected . " >" . $value . "</option>";
                    }
                    ?>
                </select>

                <div class="row" style="margin-left: 0px; display: none;">

                    <div class="col-25">
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
                                         src="<?php echo base_url("assets/admin/category/$myimage"); ?>"
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
                                    class="choose-image"><?php echo "Choose Category Image"; ?>
                                    <?php } ?>
                                    </span>
                            </label>
                        </div>
                        <!-- <p>Image size must be ( width - 211px * height - 209px ) </p> -->
                    </div>
                </div>

                <div class="row" style="margin-left: 0px;display: none;">

                    <div class="col-25">
                        <div class="col-inner">
                            <?php //print_r($myimage); ?>
                            <input type="file" style="display: none" id="file2"
                                   name="banner_image" class="image_check"
                                   data-class="dis_image2" value=""/>
                            <label for="file2" class="file__drop">
                                <span class="text">&nbsp;</span>
                                <div
                                    style="position: relative; width: 66px;height: 74px;margin-left: 20px;"
                                    id="img_div2">
                                    <img data-image
                                         src="<?php echo base_url("assets/admin/category/$banner_image"); ?>"
                                         style=" width: 100px;height: 70px; "
                                         id="dis_image2"/>
                                    <!-- <div class="preloader pl-size-l" style="position: absolute;margin-top: 14px;margin-left: 19px;" id="img_loader"> -->
                                    <!-- <div class="spinner-layer pl-light-green">
                                        <div class="circle-clipper left">
                                            <div class="circle"></div>
                                        </div>
                                        <div class="circle-clipper right">
                                            <div class="circle"></div>
                                        </div>
                                    </div> -->
                                    <!-- </div> -->
                                </div>
                                <?php
                                if (!isset($edit)) { ?>
                                <span class="choose-image" id="hide_show_tag"
                                      style="margin-top: 45px"><?php echo "Choose Category Banner"; ?>
                                    <?php } ?>
                                    </span>
                            </label>
                        </div>
                        <!-- <p>Image size must be ( width - 211px * height - 209px ) </p> -->
                    </div>
                </div>

                <br>
                <?php echo $form->bs3_submit(); ?>

                <?php echo $form->close(); ?>
            </div>
        </div>
    </div>

</div>


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
        $('#img_div2').hide();
        $('#dis_image2').hide();
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
            type.match(/gif/) !== null ||
            type.match(/svg/) !== null) {

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
                type.match(/gif/) !== null ||
                type.match(/svg/) !== null) {

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

<script type="text/javascript">
    $(document).on("change", ".image_check", function () {
        var class_name = $(this).data("class");
        var file = this.files[0];
        var imagefile = file.type;
        var match = ["image/jpeg", "image/png", "image/jpg"];
        if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
            // swal("",'Please select a valid image file (JPEG/JPG/PNG).');
            alert("Please select a valid image file (JPEG/JPG/PNG)");
            $(".image_check").val('');
            return false;
        } else {
            readURL(this, class_name);
        }
    });

    function readURL(input, class_name) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#hide_show_tag").hide();
                $("#img_div2").show();
                $('#' + class_name).show();
                $('#' + class_name).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<script type="text/javascript">
    $(".alert-success").fadeOut(10000);
</script>


<style type="text/css">
    .card {
        width: 100%;
    }

    .chosen-container {
        margin-bottom: 10px;
    }
</style>
