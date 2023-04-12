<?php echo $form->messages();
//$email  = $first_name = $editor = '';
echo @$msg;
// echo $form->messages();
//print_r($email);
	$message = $subject = '';
 if (isset($edit)){
    // $heading = $edit['heading'];
    $subject = $edit['subject'];    
    $message = $edit['message'];    
    $id = $edit['id'];    
    // $myimage = $edit['image'];
}
 ?>

 <style type="text/css">
 	button.english_submit {
    background: #ae2020d1;
    color: white;
    border: 1px solid #cdcdcd;
    box-shadow: none;
    padding: 7px;
    float: right;
    border-radius: 5px;
}
.cke_inner{
  display: none !important
}

 </style>
<!-- Email to current people who have registered but not paid for an account -->
<link href="<?php echo base_url();?>assets/admin/js/summernote-master/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="<?php echo base_url();?>assets/admin/js/summernote-master/dist/summernote-bs4.min.js"></script>
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
			<!-- 	<h3 class="box-title">Title</h3> -->
			</div>
			<div class="box-body">
				<?php //echo $form->open(); ?>
         <form id="create_form" action="<?php echo $form_url; ?>" method="post" accept-charset="utf-8">
					<!--<div class="form-group">
					    <label for="groups">To</label>
					</div>---->					
					<div class="form-group">
						<label for="groups">Subject</label>
						<div>
							<input type="subject" id="subject" name="subject" value="<?php echo $subject; ?>" class="subject">
						</div>
					</div>
          <div class="form-group">
            <label for="groups">To</label>
            <div>
              <select id="select_type" name='type'>              
                <option value="10">Select Type</option>
                <option value="newsletter">All Newsletter Subscribers</option>
                <option value="customer_all">All Customer</option>
                <option value="customer">Customer</option>
                <option value="product">Product</option>
                <option></option>
              </select>
            </div>
          </div>

          <div class="form-group" id="customer_show" style="display: none">
            <label for="groups" class="changle_label">Customer</label>
            <div>
              <input type="text" id="customer_search" name="" value="" class="subject">
            </div>
          </div>
          <div class="items"></div>

          <div class="well well-sm empty_wall" style="height: 150px; overflow: auto; display: none">
            
          </div>

          <div class="form-group">
              <label for="groups">Massage</label>
              <div>
            <textarea name="message" id="ckeditor2"><?php echo $message; ?></textarea>
              </div>
          </div>
					<br><br><br>
					<?php echo $form->bs3_submit(); ?>
					<?php if(isset($edit)){ ?>
					<button type="button" id="re_send" data-id="<?php echo $id; ?>" class="btn btn-primary">Re Send</button>
					<?php } ?>
				<?php echo $form->close(); ?>
				
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(function () {
  // CKEDITOR.replace('ckeditor2');CKEDITOR.config.height = 300;
  $('#ckeditor2').summernote({
        height: 300,
        tabsize: 2
      });
});
</script>

<style type="text/css">	
input.subject {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #cdcdcd;
}
</style>

<script type="text/javascript">
  jQuery(document).on("submit","#create_form",function(e) {
      e.preventDefault();    
        var subject = $("#subject").val();
        var message = $("#ckeditor2").val();
        var select_type = $("#select_type").val();

        var error=1;

        if(subject=='')
        {
            swal("","Please Enter Subject","warning");
            error=0;
            return false;
        }

        if(select_type==10)
        {
            swal("","Please Select Type","warning");
            error=0;
            return false;
        }
        if(select_type=='customer' || select_type=='product' )
        {
          if($(".mix_type").length==0)
          {
            swal("","Please search and Select "+select_type,"warning");
            error=0;
            return false;   
          }
        }
        if(message=='')
        {
            swal("","Please Enter Message","warning");
            error=0;
            return false;
        }

        if(error==1){   
            $("#loading").show();
            $.ajax({
                type: 'POST',
                url: "<?php echo $form_url; ?>",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(response)
                { 
                    var response = $.trim(response);
                    $("#loading").hide();
                    // response = response.trim();        
                  // alert(response);
                  // return false;                   
                    if(response=='send')
                    {
                        swal("","Email Successfully","success");
                        url="<?php echo $form_url; ?>";             
                         setTimeout(function(){ window.location=url; }, 2000);
                     $('#create_form')[0].reset();
                    }else if(response=='update'){
                        swal("","Coupon Edit Successfully","success");
                    }
                    else if(response=='already')
                    {
                        swal("","Copoun already exist","warning");
                    }else {
                        swal("","Something Want Wrong","warning");
                    }
                }    
            });
        }             

        



        // var fromdate = new Date($("#start_date").val()); //Year, Month, Date
        // var todate = new Date($("#end_date").val()); //Year, Month, Date
                                
    });
</script>
<script type="text/javascript">
	$(document).on("click","#re_send",function(){
      var id=$(this).attr('data-id');      
      if(id!='')
      {
      	$('#loading').show();      
        $.ajax({
          type: 'POST',
          url: "<?php echo base_url('admin/email_send/re_send'); ?>",
          data: {id:id},
          success:function(response)
          {
          	$('#loading').hide();
          	if(response==1)
          	{
          		swal("","Email Send Successfully","success");
          	}else{
          		swal("","Something Want Wrong","warning");
          	} 
          }
        });  
      }else{
      	swal("","Something Want Wrong","warning");
      }
  });
</script>

<script type="text/javascript">
    $("#customer_search").keyup(function(e){

         // var seller_id  = "0"; 
         var str1 = $("#customer_search").val();
         var type=$('#select_type :selected').val();
         // alert(type);
         // return false;

         $.ajax({
            type: 'POST',
            url: "<?php echo base_url('admin/email_send/customer_search') ?>",
            // data: {category_id:category_id,string:str1,seller_id:seller_id},
            data: {string:str1,type:type},
            success: function(response){
                var data = jQuery.parseJSON(response);
                
                if (typeof data !== 'undefined' && data.length > 0) {
                  var drop_down_optn = '';
                   
                    $.each( data, function( key, value ) {
                      //alert( key + ": " + value );
                      drop_down_optn += value;
                     
                    });
                    $('.items').show();
                    $(".items").html(drop_down_optn);
                    
                }
                else{
                  $('.items').hide();
                }
            }
         });
      });
</script>
<script type="text/javascript">
  $(document).on("click",".customer_list",function(){
    var id=$(this).attr('data-id');
    var type=$(this).attr('data-type');
    var name=$(this).text();    
    $('.customer_list').hide();
    $('#customer_search').val('');
    if($("#customer"+id).length==0)
    {
      var html_data='<div id="'+type+id+'" class="mix_type">';
      html_data+='<span class="material-icons remove_customer" data-id="'+type+id+'">minimize</span>';
      html_data+=name+'<input type="hidden" name="'+type+'[]" value="'+id+'">';
      html_data+='</div>';
      $(".empty_wall").append(html_data);    
    }else{
      swal("","This "+type+ "already added","warning");
    }            
  });
</script>

<script type="text/javascript">
  $('#select_type').change(function() 
  {
      $("#customer_show").hide();
      $(".empty_wall").empty();
      $(".empty_wall").hide();
      var type=$('#select_type :selected').val();
      if(type=='customer' || type=='product' )
      {
        $(".changle_label").text(type)
        $("#customer_show").show();
        $(".empty_wall").empty();
        $(".empty_wall").show();
      }
 });
</script>
<script type="text/javascript">
  $(document).on("click",".remove_customer",function(){
    // alert("sfdasdf");
    var id=$(this).attr('data-id');
    $("#"+id).remove();
  });
</script>