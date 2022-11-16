
<div class="col-md-12" style="float: right;">
    <div class="button  ">
      <a href="<?php echo  $back_link; ?>" class=" back_to_list btn btn-primary">Back to list</a>
    </div>
</div>


<?php echo $form->messages();
$description = $interest_rate_per = $main_category  = $myimage  =  '' ;
$image_folder_name='solution';

if (isset($edit)){
    $description = $edit['description'];
    // $interest_rate_per = $edit['interest_rate_per'];    
    // $myimage = $edit['image'];
}
?>

<section class="content">
    <div class="row space-get margin_20">
        <div class="col-md-12">
            <div class="panel panel-default main_wrap_form">
                <div class="panel-heading">
                    <?php echo $page_title; ?>
                </div>
                <div class="panel-body">
                    <?php echo $form->open(); ?> 
                       <div class="col-md-12" > 
                            <div class="form-group">
                                <label for="description"> Description</label>
                                <input class="form-control space" id="description" name="description" placeholder="Enter description" type="text" value="<?php echo $description ?>" required="" autocomplete="off" >
                            </div>
                        </div>
                        <!-- <div class="col-md-12" >

                            <div class="form-group">
                                <label for="exampleInputEmail1"> Interest Rate </label>
                                <input class="form-control" id="interest_rate_per" name="interest_rate_per" placeholder="Enter Interest Rate" type="text" value="<?php //echo $interest_rate_per ?>" required="" autocomplete="off" >                       
                                
                            </div>  
                        </div>   -->                       

                     

                        <!-- <div class="form-group"> -->
                            <!-- <label for="exampleInputPassword1"> Image </label> -->
                            
                            <!-- Hidden records -->
                           <!--  <input type="hidden" id="photo_url" value="<?php //echo base_url('admin/file_handling/uploadFiless'); ?>" />
                            <input type="hidden" id="img_url" value="admin/<?php //echo $image_folder_name; ?>/" />
                            <input type="hidden" name="image" id="file_name" value="<?php //echo $myimage; ?>" required="required"> -->
                               
                            <!-- <br> -->
                            <!-- <div class="col-inner">
                                
                                <input type="file" id="file" value="<?php //echo $myimage; ?>" />
                                <label for="file" class="file__drop" data-image-uploader>
                                    <span class="text">&nbsp;</span>
                                    <div style="position: relative; width: 66px;height: 74px;margin-left: 20px;" id="img_div">
                                        <img data-image  src="<?php //echo base_url("assets/admin/$image_folder_name/$myimage"); ?>" style=" width: 100px;height: 70px; " id="dis_image" />
                                        <div class="preloader pl-size-l" style="position: absolute;margin-top: 14px;margin-left: 19px;" id="img_loader">
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
                                    // if (!isset($edit))
                                    { ?>
                                        <span class="choose-image "><?php //echo "Choose Image for <br> banner"; ?>
                                        </span>
                                    <?php } ?>
                                    
                                </label>
                            </div> -->

                        <!-- </div> -->
                            <!-- <p>Image size must be ( width-211px * height-209px ) </p> -->

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

    $( document ).ready(function() {
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
        var file =jQuery(this)[0],
            type = file.files[0].type.toLocaleLowerCase();

        if(type.match(/jpg/) !== null ||
            type.match(/jpeg/) !== null ||
            type.match(/png/) !== null ||
            type.match(/gif/) !== null) {

            readUploadedImage(file.files[0]);
        }
    }

    function dropHandler(e) {
        e.preventDefault();

        if(e.type === 'drop' && e.originalEvent.dataTransfer && e.originalEvent.dataTransfer.files.length) {

            var files = e.originalEvent.dataTransfer.files,
                type = files[0].type.toLocaleLowerCase();

            if(type.match(/jpg/) !== null ||
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

        if(window.FileReader) {
            reader = new FileReader();
            reader.readAsDataURL(img);

            reader.onload = function (file) {
                if(file.target && file.target.result) {
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

        img.onload = function() {
            imageResizer(img, callback);
        }

    }

    function imageResizer(img, callback) {
        var canvas = document.createElement('canvas');
        canvas.width = 50;
        canvas.height = 50;
        context = canvas.getContext('2d');
        context.drawImage( img, 0, 0, 50, 50 );
        callback(canvas.toDataURL());

    }

    function displayImage(img) {
        
        $('#img_div').show();
        $('#img_loader').show();
        $('#dis_image').hide();
        $('.choose-image').hide();

        file =jQuery("#file")[0];
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
           success: function(response){
            $('#img_loader').hide();
            $('#dis_image').show();
            if(response == "false"){
                alert("Something went wrong, Please try again...");
            }else{
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

    .margin_20{
    margin-top: 14px;
    }
    .main_wrap_form .panel-heading{
    font-weight: 500;
    font-size: 16px;
    }
    .main_wrap_form .form-group label{
    font-weight: 500;
    font-size: 15px;
    }
    .main_wrap_form .form-control {
    box-shadow: 0px 0px 0px #fff;
    border-radius: 3px;
    font-size: 13px;
    padding: 6px 12px;
    border: 1px solid #e0e0e0;
    }
    .main_wrap_form .form-control:focus{
    border: 1px solid #bdbcbc;
    }

    .btn-primary {
    float: right;
    font-weight: 500;
    font-size: 15px!important;
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
    .alert.alert-success{
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
    // $(function () 
    // {
    //     //CKEditor
    //     CKEDITOR.replace('description');
    //     CKEDITOR.config.height = 300;
    //     CKEDITOR.config.width = 600;
    // });
</script>
<script type="text/javascript">
    // this for only decimal
// setInputFilter(document.getElementById("interest_rate_per"), function(value) {
//   return /^-?\d*[.,]?\d{0,2}$/.test(value); });
// this for float point number
// setInputFilter(document.getElementById("interest_rate_per"), function(value) {
//   return /^-?\d*[.,]?\d*$/.test(value); });

$(document).on("submit","form",function(){
     var description= $("#description").val();
      var error=1;

      if(description=='')
      {
         error=0;
         swal("","Please enter description","warning");
         return false;
      }
});
</script>