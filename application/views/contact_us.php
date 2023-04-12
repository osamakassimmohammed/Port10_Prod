<style type="text/css">
   .home_active{
   font-weight: 600 !important;
   color: #c09550 !important;
   }
   .contnr_main_headr.hedr_fixed{
   position: static;
   box-shadow: 0px 0px 0px #fff;
   }
   .contact_form_head{
    color: #3F006F;
   }
   .section-b-space i.fa
   {
    float: left;
    text-indent: -20px;
   }

   .con_page p
   {
        line-height: 19px;
        color: black;
        font-size: 13px;
   }
</style>
<!-- breadcrumb start -->
<<!-- div class="breadcrumb-section">
   <div class="container container_detl_wdth">
      <div class="row">
         <div class="col-sm-6">
            <div class="page-title">
               <h2>Contact Us</h2>
            </div>
         </div>         
      </div>
   </div>
</div> -->
<!-- breadcrumb End -->
<!--section start-->
<!-- section start -->



 <!--section start-->
    <section class="contact-page section-b-space">
          <div class="page-title">
             <h2><?php echo lang('Contact_Us'); ?></h2>
          </div>
        <div class="container">
            <div class="row section-b-space">
                <div class="col-lg-6 map">
                    <?php echo @$footer_content[0]['google_map_location']; ?>  
                    <div class="col-lg-12 con_page" style="margin-top: 20px;">
                        <div class="row">
                            <div class="col-sm-8 col-md-8">
                                <div class="contact-icon">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    <p><?php if($language=='en'){ echo @$footer_content[0]['location']; }else{ echo @$footer_content[0]['location_arabic']; } ?></p>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4">
                                <div class="media-body">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                    <p><?php echo @$footer_content[0]['mobile_no']; ?></p>
                                </div>
                                <div class="media-body">
                                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                    <p><?php echo @$footer_content[0]['email_id']; ?></p>
                                    <p><?php echo @$footer_content[0]['email_id2']; ?></p>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <form class="theme-form" id="contact_form" method="post">
                        <h3 class="contact_form_head"><?php echo lang('Get_In_Touch'); ?></h3>
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="name"><?php echo lang('First_Name'); ?></label>
                                <input type="text" class="form-control space" id="cfirst_name" name="first_name" placeholder="<?php echo lang('Enter_Your_First_Name'); ?>"
                                    >
                            </div>
                            <div class="col-md-6">
                                <label for="email"><?php echo lang('Last_Name'); ?></label>
                                <input type="text" class="form-control space" id="clast_name" name="last_name" placeholder="<?php echo lang('Enter_Your_Last_Name'); ?>" >
                            </div>
                            <div class="col-md-6">
                                <label for="review"><?php echo lang('Phone_number'); ?></label>
                                <input maxlength="14"  type="text" class="form-control" id="cphone" name="phone" placeholder="<?php echo lang('Enter_your_number'); ?>" onkeypress="return isNumberKey(event)">
                            </div>
                            <div class="col-md-6">
                                <label for="email"><?php echo lang('Email'); ?></label>
                                <input type="text" class="form-control space" id="cemail" name="email" placeholder="<?php echo lang('Please_enter_your_email'); ?>">
                            </div>
                            <div class="col-md-12">
                                <label for="review"><?php echo lang('Write_Your_Message'); ?></label>
                                <textarea class="form-control space" placeholder="<?php echo lang('Write_Your_Message'); ?>"
                                    id="cmessage" name="message" rows="6"></textarea>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-solid" type="submit"><?php echo lang('Send'); ?> </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </section>
    <!--Section ends-->


<!-- section end -->
<script type="text/javascript">
 $(document).on("submit","#contact_form",function(e)
 {
    e.preventDefault();  
    var cfirst_name=$.trim($("#cfirst_name").val()); 
    var clast_name=$.trim($("#clast_name").val()); 
    var cphone=$.trim($("#cphone").val()); 
    var cemail=$.trim($("#cemail").val()); 
    var cmessage=$.trim($("#cmessage").val()); 
    var error=1;
    if(cfirst_name=="")
    {
        error==0;
        swal("","<?php echo lang('Enter_Your_First_Name'); ?>","warning");
        return false;
    }

    if(clast_name=="")
    {
        error==0;
        swal("","<?php echo lang('Enter_Your_Last_Name'); ?>","warning");
        return false;
    }

    if(cphone=="")
    {
        error==0;
        swal("","<?php echo lang('Enter_your_number'); ?>","warning");
        return false;
    }

    if(cemail=="")
    {
        error==0;
        swal("","<?php echo lang('Please_enter_your_email'); ?>","warning");
        return false;
    }

    if(cemail!='')
    {
        if(!isValidEmailAddress(cemail))
        {             
          error=0;                
          swal("","<?php echo lang('Please_Enter_Valid_Email_Id'); ?>","warning");
          return false;
        }                  
    } 

    

    if(cmessage=="")
    {
        error==0;
        swal("","<?php echo lang('Write_Your_Message'); ?>","warning");
        return false;
    }
    if(error==1)
    {
      $("#loading").show();
      $.ajax({
              type: 'POST',
              url: "<?php echo base_url('contact_us') ?>",
              data: new FormData(this),
              contentType: false,
              cache: false,
              processData:false,
              success: function(response)
              { 
                $("#loading").hide();
                response=$.trim(response);
                if(response==1)
                {
                  swal("","<?php echo lang('Contact_us_req'); ?>","success");
                  $('#contact_form')[0].reset();
                }else if(response=='all_field'){
                  swal("","<?php echo lang('All_field_required'); ?>","warning");
                }else{
                  swal("","<?php echo lang('Something'); ?>","warning");
                }
              }
      });
    }  
}); 
 </script>   