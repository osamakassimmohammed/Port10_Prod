<?php echo $form->messages();

if (isset($edit)) {
$item_name = $edit['item_name'];
$myimage = $edit['image'];
}
 ?>
<div class="row">

	<div class="col-md-6">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"></h3>
			</div>
			<div class="box-body">
				<?php echo $form->open(); ?>

                    <div class="form-group">
                        <label for="groups">Attribute Name</label>
                        <div>
                        <?php echo $form->bs3_text('Attribute Name', 'item_name', $item_name, array('required' => '')); ?>
                        </div>
                    </div>

            <?php if (!empty($myimage)) { ?>
                
                <input type="hidden" id="photo_url" value="<?php echo base_url('admin/file_handling/uploadFiless'); ?>" />
              <input type="hidden" id="img_url" value="frontend/images/home/" />
              <input type="hidden" name="image" id="file_name" value="<?php echo $myimage; ?>" <?php if(empty($myimage)) echo "required"; ?>>
               <div class="row" style="margin-left: 0px;">
                     <div class="col-25">
                         <div class="col-inner">
                             
                             <input type="file" id="file"/>

                             <label for="file" class="file__drop" data-image-uploader>
                                 <span class="text">&nbsp;</span>
                                     <div style="position: relative; width: 66px;height: 74px;margin-left: 20px;" id="img_div">
                                 <img data-image src="<?php echo base_url("assets/frontend/images/home/".$myimage); ?>" style="width: 100px;height: 75px;padding: 10px 0;"/>
                                    </div>
                                     <?php if(!isset($edit)) { ?>
                                 <span id="span_hide" class="choose-image"><?php echo "Choose Image"; ?> 
                                    <?php } ?>
                                </span>
                             </label>
                         </div>
                           <p style="margin-top: 15px;">image size must be (width-1900 * height-600) </p>
                     </div>
                 </div>
                 <br>

             <?php } ?>
                    
              
                       <!-- Hidden records -->
              

					<?php echo $form->bs3_submit(); ?>
					
				<?php echo $form->close(); ?>
			</div>
		</div>
	</div>
	
</div>




<script type="text/javascript">

    $( document ).ready(function() {

        <?php if (isset($edit)) { ?>

        $('#img_div').show();
      
      
        <?php    }
        else{ ?>
        $('#img_div').hide();
     
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
      $('#span_hide').hide();
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
    button.btn.btn-primary.vibrate {
    width: 30%;
    margin-top: 30px;
}
</style>