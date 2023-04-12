<style type="text/css">
    img#blah {
    margin-top: 20px;
}

button.btn.btn-primary {
    background: #4f0381!important;
    width: 100%;
    border-radius: 7px!important;
    padding: 10px;
}
.form-control {
    border-radius: 10px;
    padding: 20px;
}
a.chosen-single {
    background: transparent!important;
}
input[type="file"] {
    padding: 8px;
    height: 41px;
}

.see_sub {
    float: right;
    border: 1px solid;
    padding: 9px 25px;
    width: auto;
    text-align: center;
    border-radius: 50px;
    position: relative;
    top: -81px;
    margin-right: 18px;
    background: #4f0381;
}


.see_sub a {
    color: white;
}


.form-control, .chosen-single {
    border-radius: 100px !important;
    border: 1px solid #cdcdcd !important;
    box-shadow: 0px 0px 0px red !important;
}

.box-title {
    color: #ff375e;
    font-weight: 500;
    margin-left: 15px;
    font-size: 24px;
    margin-bottom: -10px;
}

.col-sm-6 label{
        margin-left: 20px;
    font-weight: 500;
}

button.btn.btn-primary {
    padding: 10px 17px !important;
    width: 100% !important;
    font-size: 17px !important;
    border-radius: 100px !important;
    font-family: 'Montserrat';
}

.col-md-8asas .col-sm-4{
	    padding: 0px 10px;
}

</style>

<?php echo $form1->messages(); ?>
<?php if($user->type=='suppler'){ ?>
<div class="see_sub">
        <a href="<?php echo base_url($language.'/admin/panel/supplier_sub') ?>"><?php echo lang('aSEE_SUBSCRIPTION_HISTORY'); ?></a>
</div>
<div style="margin-right: 5px" class="see_sub">
    <a  href="<?php echo base_url($language.'/admin/panel/create_sub_seller') ?>"><?php echo lang('aAdd_Sub_Supplier'); ?></a>
</div>
<div style="margin-right: 5px" class="see_sub">
    <a  href="<?php echo base_url($language.'/admin/panel/sub_supplier_list') ?>"><?php echo lang('aSub_supplier_List'); ?></a>
</div>
<?php } ?>
<div class="row">
    
	<div class="col-md-8 col-md-8asas">
		<div class="box box-primary">
			<div class="box-header" style="margin-bottom: 23px;">
				<h4 class="box-title"><?php echo lang('aAccount_Info'); ?></h4>
			</div>
			<div class="box-body">
				<?php
					// echo "<pre>";
					// print_r($user);
					// die;
				?>
				<?php echo $form1->open(); ?>
                        <?php if($user->type=='suppler'){ ?>
						<div class="col-sm-4">
							<div class="form-line focused">
                                <label><?php echo lang('Entity_Name'); ?></label>
								<input type="text" name="entity_name" value="<?php echo $user->entity_name ?>" placeholder="<?php echo lang('Entity_Name'); ?>" id="sestiblishment" class="form-control ">
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-line focused">
                                <label><?php echo lang('CR_Number'); ?></label>
								<input type="text" maxlength="7" name="username" value="<?php echo $user->username ?>" placeholder="<?php echo lang('CR_Number'); ?>" id="scr_number" class="form-control " onkeypress="return isNumberKey(event)">
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-line focused">
                                <label><?php echo lang('Street_Name'); ?></label>
								<input type="text" name="street_name" value="<?php echo $user->street_name ?>" placeholder="<?php echo lang('Street_Name'); ?>" id="sstreet_name" class="form-control ">
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-line focused">
                                <label><?php echo lang('Building_Num'); ?></label>
								<input type="text" name="building_no" value="<?php echo $user->building_no ?>" placeholder="<?php echo lang('Building_Num'); ?>" id="sbuilding_no" class="form-control ">
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-line focused">
                                <label><?php echo lang('Select_City'); ?></label>
								<select id="scity" name="city">
									<option value=""><?php echo lang('Select_City'); ?></option>
		                            <?php if(!empty($city_list)){
		                                foreach ($city_list as $cl_key => $cl_val) { 
		                                    if($cl_val['city_name']==$user->city)
		                                    {
		                                        $bselected='selected';
		                                    }else{
		                                        $bselected='';
		                                    }
		                                    ?>
		                                    <option value="<?php echo $cl_val['city_name']; ?>" <?php echo $bselected; ?>><?php echo $cl_val['city_name']; ?></option>
		                            <?php } } ?>
								</select>
							</div>
						</div>

						<div class="col-sm-4">
							<div class="form-line focused">
                                <label><?php echo lang('Select_State_Province_Region'); ?></label>
								<select  id="sstate" name="state">
	                            <option value=""><?php echo lang('Select_State_Province_Region'); ?></option>
	                            <?php if(!empty($state_list)){
	                                foreach ($state_list as $sl_key => $sl_val) { 
	                                    if($sl_val['state_name']==$user->state)
	                                    {
	                                        $bselected='selected';
	                                    }else{
	                                        $bselected='';
	                                    }
	                                    ?>
	                                    <option value="<?php echo $sl_val['state_name']; ?>" <?php echo $bselected; ?>><?php echo $sl_val['state_name']; ?></option>
	                            <?php }} ?>
	                            </select> 
							</div>
						</div>
						<div class="clear"></div>
						<div class="col-sm-4">
							<div class="form-line focused">
                                <label><?php echo lang('Select_Zip_Or_Postal_Code'); ?></label>
								<input maxlength="5" type="text" name="postal_code" value="<?php echo $user->postal_code ?>" placeholder="<?php echo lang('Enter_Postal_Code'); ?>" id="spostal_code" class="form-control " onkeypress="return isNumberKey(event)"> 
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-line focused">
                                <label><?php echo lang('Country'); ?></label>
								<input type="text" name="country" value="<?php echo $user->country ?>" placeholder="<?php echo lang('Country'); ?>" id="scountry" class="form-control " readonly>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-line focused">
                                <label><?php echo lang('Phone'); ?></label>
								<input maxlength="14" type="text" name="phone" value="<?php echo $user->phone ?>" placeholder="<?php echo lang('Phone'); ?>" id="sphone" class="form-control " onkeypress="return isNumberKey(event)">
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-line focused">
                                <label><?php echo lang('Email'); ?></label>
								<input type="text" name="email" value="<?php echo $user->email ?>" placeholder="<?php echo lang('Email'); ?>" id="semail" class="form-control ">
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-line focused">
                                <label><?php echo lang('VAT_Number'); ?></label>
								<input type="text" name="vat_number" value="<?php echo $user->vat_number ?>" placeholder="<?php echo lang('VAT_Number'); ?>" id="svat_number" class="form-control " onkeypress="return isNumberKey(event)">
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-line focused">
                                <label><?php echo lang('Select_Preferred_Bank_Name'); ?></label>
								<select  id="sbank_name" name="bank_name">
	                            <option value=""><?php echo lang('Select_Preferred_Bank_Name'); ?></option>
	                            <?php if(!empty($bank_details)){
	                                foreach ($bank_details as $bd_key => $bd_val) { 
	                                    if($bd_val['id']==$user->bank_name)
	                                    {
	                                        $bselected='selected';
	                                    }else{
	                                        $bselected='';
	                                    }
	                                    ?>
	                                    <option value="<?php echo $bd_val['id']; ?>" <?php echo $bselected; ?>><?php echo $bd_val['bank_name']; ?></option>
	                            <?php }} ?>
	                            </select> 
							</div>
						</div>
                        <div class="clear"></div>
						<div class="col-sm-4">
							<div class="form-line focused">
                                <label><?php echo lang('IBAN'); ?></label>
								<input type="text" name="iban" value="<?php echo $user->iban ?>" placeholder="<?php echo lang('IBAN'); ?>" id="siban" class="form-control isSpecial">
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-line focused">
                                <label><?php echo lang('User_Name'); ?></label>
								<input type="text" name="first_name" value="<?php echo $user->first_name ?>" placeholder="<?php echo lang('User_Name'); ?>" id="sfirst_name" class="form-control ">
							</div>
						</div>
                        <?php }else if($user->type=='subsupplier'){ ?>

                        <div class="col-sm-4">
							<div class="form-line focused">
                                <label><?php echo lang('User_Name'); ?></label>
								<input type="text" name="first_name" value="<?php echo $user->first_name ?>" placeholder="<?php echo lang('User_Name'); ?>" id="sfirst_name" class="form-control ">
							</div>
						</div>

						<div class="col-sm-4">
							<div class="form-line focused">
                                <label><?php echo lang('CR_Number'); ?></label>
								<input type="text" name="username" value="<?php echo $user->username ?>" placeholder="<?php echo lang('CR_Number'); ?>" id="scr_number" class="form-control " onkeypress="return isNumberKey(event)">
							</div>
						</div>

						<div class="col-sm-4">
							<div class="form-line focused">
                                <label><?php echo lang('Street_Name'); ?></label>
								<input type="text" name="street_name" value="<?php echo $user->street_name ?>" placeholder="<?php echo lang('Street_Name'); ?>" id="sstreet_name" class="form-control ">
							</div>
						</div>

						<div class="col-sm-4">
							<div class="form-line focused">
                                <label><?php echo lang('Building_Num'); ?></label>
								<input type="text" name="building_no" value="<?php echo $user->building_no ?>" placeholder="<?php echo lang('Building_Num'); ?>" id="sbuilding_no" class="form-control ">
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-line focused">
                                <label><?php echo lang('Select_City'); ?></label>
								<select id="scity" name="city">
									<option value=""><?php echo lang('Select_City'); ?></option>
		                            <?php if(!empty($city_list)){
		                                foreach ($city_list as $cl_key => $cl_val) { 
		                                    if($cl_val['city_name']==$user->city)
		                                    {
		                                        $bselected='selected';
		                                    }else{
		                                        $bselected='';
		                                    }
		                                    ?>
		                                    <option value="<?php echo $cl_val['city_name']; ?>" <?php echo $bselected; ?>><?php echo $cl_val['city_name']; ?></option>
		                            <?php } } ?>
								</select>
							</div>
						</div>

						<div class="col-sm-4">
							<div class="form-line focused">
                                <label><?php echo lang('Select_State_Province_Region'); ?></label>
								<select  id="sstate" name="state">
	                            <option value=""><?php echo lang('Select_State_Province_Region'); ?></option>
	                            <?php if(!empty($state_list)){
	                                foreach ($state_list as $sl_key => $sl_val) { 
	                                    if($sl_val['state_name']==$user->state)
	                                    {
	                                        $bselected='selected';
	                                    }else{
	                                        $bselected='';
	                                    }
	                                    ?>
	                                    <option value="<?php echo $sl_val['state_name']; ?>" <?php echo $bselected; ?>><?php echo $sl_val['state_name']; ?></option>
	                            <?php }} ?>
	                            </select> 
							</div>
						</div>
						<div class="clear"></div>
						<div class="col-sm-4">
							<div class="form-line focused">
                                <label><?php echo lang('Select_Zip_Or_Postal_Code'); ?></label>
                                <input type="text" name="postal_code" value="<?php echo $user->postal_code ?>" placeholder="<?php echo lang('Enter_Postal_Code'); ?>" id="spostal_code" class="form-control " onkeypress="return isNumberKey(event)">
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-line focused">
                                <label><?php echo lang('Country'); ?></label>
								<input type="text" name="country" value="<?php echo $user->country ?>" placeholder="<?php echo lang('Country'); ?>" id="scountry" class="form-control " readonly>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-line focused">
                                <label><?php echo lang('Phone'); ?></label>
								<input type="text" name="phone" value="<?php echo $user->phone ?>" placeholder="<?php echo lang('Phone'); ?>" id="sphone" class="form-control " onkeypress="return isNumberKey(event)">
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-line focused">
                                <label><?php echo lang('Email'); ?></label>
								<input type="text" name="email" value="<?php echo $user->email ?>" placeholder="<?php echo lang('Email'); ?>" id="semail" class="form-control ">
							</div>
						</div>
							
                        <?php } else{ ?>
                        <div class="col-sm-4">
                            <div class="form-line focused">
                            	<label>First name</label>
                                <input type="text" name="first_name" value="<?php echo $user->first_name ?>" placeholder="First name" id="sfirst_name" class="form-control ">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-line focused">
                                <label><?php echo lang('Last_Name'); ?></label>
                                <input type="text" name="last_name" value="<?php echo $user->last_name ?>" placeholder="<?php echo lang('Last_Name'); ?>" id="slast_name" class="form-control ">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-line focused">
                                <label><?php echo lang('User_Name'); ?></label>
                                <input type="text" name="username" value="<?php echo $user->username ?>" placeholder="<?php echo lang('User_Name'); ?>" id="susername" class="form-control ">
                            </div>
                        </div>
                        <?php } ?>
                        <div class="clear"></div>
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-primary"><?php echo lang('Update'); ?></button>
                        </div>
				<?php echo $form1->close(); ?>
			</div>
		</div>
	</div>
 
	
	<div class="col-sm-4">

        <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <h4 class="box-title"><?php echo lang('aUpload_Profile'); ?></h4>
            </div>
            <form id="add_profile" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-line">
                        <label for="imagefile"><?php echo lang('choose_profile_image'); ?></label>
                        <input type="file" name="logo" value=""  required=""  autocomplete="off" id="imagefile" class="form-control image_check" >
                    </div>
                    <img id="blah" class="blah" width="200px" height="200px" src="<?php echo base_url('assets/admin/usersdata/').@$user->logo; ?>" alt="your image" />
                    <div class="clear"></div>
                    <div class="col-sm-12" style="margin: 0px;padding: 0px;">
                    <button type="submit"  style="margin-top: 10px" class="btn btn-primary col-sm-12"><?php echo lang('aUpload_Profile'); ?></button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>  


        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h4 style="margin-left: 0px;" class="box-title"><?php echo lang('aChange_Password'); ?></h4>
                </div>
                <br>
                <div class="row">
                    <?php echo $form2->open(); ?>
                        <div class="col-sm-12">
                            <div class="form-line focused">
                                <label><?php echo lang('New_Password'); ?></label>
                                <input  maxlength="10" type="text" id="pro_new_password" name="new_password" value="" placeholder="<?php echo lang('New_Password'); ?>" class="form-control " >
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-line focused">
                                <label><?php echo lang('aRetype_Password'); ?></label>
                                <input  maxlength="10" type="text" id="pro_retype_password" name="retype_password" value="" placeholder="<?php echo lang('aRetype_Password'); ?>" class="form-control " >
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="col-sm-6">
                            <?php echo $form2->bs3_submit(lang('aSubmit')); ?>
                        </div>
                        
                    <?php echo $form2->close(); ?>
                </div>
            </div>
        </div>

    </div>
				
</div>



<script type="text/javascript">
	$(".image_check").change(function() {

        var file = this.files[0];

        var imagefile = file.type;

        var match= ["image/jpeg","image/png","image/jpg"];

        if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
            // swal("",'Please select a valid image file (JPEG/JPG/PNG).');
            alert("Please select a valid image file (JPEG/JPG/PNG)");
            $(".image_check").val('');
            return false;
        } else {
          readURL(this);
        }
    });

   function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();

         reader.onload = function(e) {     

          $('.blah').attr('src', e.target.result);     

         }
         reader.readAsDataURL(input.files[0]);
      }
   }
</script>
<script type="text/javascript">
	$(document).on("submit","#add_profile",function(e) {
    	e.preventDefault();   
    	$.ajax({
                type: 'POST',
                url: "<?php echo base_url('admin/panel/upload_logo'); ?>",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(response)
                {  
                	if(response==1)
                	{
                		swal("","Profile upload successfully",'success');
                		setTimeout(function(){ location.reload(); }, 1500);
                	 }else if(response==2){
                		swal("","<?php echo lang('Something'); ?>",'warning');
                	}else{
                		swal("","Please login",'warning');
                		setTimeout(function(){ window.location = "<?php echo base_url('admin/login'); ?>" }, 1500);
                	}
                }
            });    
    });	
</script>

<script type="text/javascript">
	function isValidEmailAddress(emailAddress) 
   {

      var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);

      return pattern.test(emailAddress);
   }
    $(document).on("submit","#account_pro_update",function(e)
    {
        e.preventDefault();  
        var error=1;   
        var stepone=1; 
        var steptwo=1; 
        var stepthree=1;         
        // var stype=$("#stype").val(); 
        <?php if($user->type=='suppler'){ ?>
        var sestiblishment=$.trim($("#sestiblishment").val());  
        var scr_number=$.trim($("#scr_number").val());

        var sstreet_name=$.trim($("#sstreet_name").val());          
        var sbuilding_no=$.trim($("#sbuilding_no").val());          
        var scity=$.trim($("#scity").val());          
        var sstate=$.trim($("#sstate").val());          
        var spostal_code=$.trim($("#spostal_code").val());          
        var scountry=$.trim($("#scountry").val());      

        var sphone=$.trim($("#sphone").val());          
        var semail=$.trim($("#semail").val());          
        var svat_number=$.trim($("#svat_number").val());          
        var sbank_name=$.trim($("#sbank_name").val());          
        var siban=$.trim($("#siban").val());          
        var sfirst_name=$.trim($("#sfirst_name").val()); 

        if(sestiblishment=="")
        {
            error=0;            
            swal("","<?php echo lang('Please_Enter_Entity_Name'); ?>","warning");
            return false;
        } 

        if(scr_number=="")
        {
            error=0;            
            swal("","<?php echo lang('Please_Enter_CR_Number'); ?>","warning");
            return false;
        }        

        

        if(sstreet_name=="")
        {
            error=0;            
            swal("","<?php echo lang('Please_enter_Street_Name'); ?>","warning");
            return false;
        }

        if(sbuilding_no=="")
        {
            error=0;            
            swal("","<?php echo lang('Please_Enter_Building_Num'); ?>","warning");
            return false;
        }

        if(scity=="")
        {
            error=0;            
            swal("","<?php echo lang('Please_Enter_City'); ?>","warning");
            return false;
        } 

        if(sstate=="")
        {
            error=0;            
            swal("","<?php echo lang('Please_Enter_State'); ?>","warning");
            return false;
        } 

        // if(spostal_code=="")
        // {
        //     error=0;            
        //     swal("","Please Enter Zip Or Postal Code","warning");
        //     return false;
        // } 

        if(scountry=="")
        {
            error=0;            
            swal("","<?php echo lang('Please_Enter_Country'); ?>","warning");
            return false;
        } 

        

        if(sphone=="")
        {
            error=0;            
            swal("","<?php echo lang('Please_Enter_Phone'); ?>","warning");
            return false;
        }

        if(semail=="")
        {
            error=0;            
            swal("","<?php echo lang('Please_enter_email'); ?>","warning");
            return false;
        }

         if(semail!='')
         {
             if(!isValidEmailAddress(semail))
             {             
                error=0;                
                swal("","<?php echo lang('Please_Enter_Valid_Email_Id'); ?>","warning");
                return false;
             }                  
         } 

        if(svat_number=="")
        {
            error=0;            
            swal("","<?php echo lang('Please_Enter_VAT_Number'); ?>","warning");
            return false;
        }
        if(sbank_name=="")
        {
            error=0;            
            swal("","<?php echo lang('Please_Select_Preferred_Bank_Name'); ?>","warning");
            return false;
        } 

        if(siban=="")
        {
            error=0;            
            swal("","<?php echo lang('Please_Enter_IBAN'); ?>","warning");
            return false;
        }

        if(sfirst_name=="")
        {
            error=0;            
            swal("","<?php echo lang('Please_Enter_User_Name'); ?>","warning");
            return false;
        }
    <?php }else if($user->type=='subsupplier'){ ?>
    	var sfirst_name=$.trim($("#sfirst_name").val()); 
    	var scr_number=$.trim($("#scr_number").val()); 
    	var sstreet_name=$.trim($("#sstreet_name").val()); 
    	var sbuilding_no=$.trim($("#sbuilding_no").val()); 
    	var scity=$.trim($("#scity").val()); 
    	var sstate=$.trim($("#sstate").val()); 
    	var spostal_code=$.trim($("#spostal_code").val()); 
    	var sphone=$.trim($("#sphone").val()); 
    	var semail=$.trim($("#semail").val());

    	if(sfirst_name=="")
        {
            error=0;            
            swal("","<?php echo lang('aPlease_Enter_first_Name'); ?>","warning");
            return false;
        }

        if(scr_number=="")
        {
            error=0;            
            swal("","<?php echo lang('Please_Enter_CR_Number'); ?>","warning");
            return false;
        }  

        if(sstreet_name=="")
        {
            error=0;            
            swal("","<?php echo lang('Please_enter_Street_Name'); ?>","warning");
            return false;
        }

        if(sbuilding_no=="")
        {
            error=0;            
            swal("","<?php echo lang('Please_Enter_Building_Num'); ?>","warning");
            return false;
        }

        if(scity=="")
        {
            error=0;            
            swal("","<?php echo lang('Please_Enter_City'); ?>","warning");
            return false;
        } 

        if(sstate=="")
        {
            error=0;            
            swal("","<?php echo lang('Please_Enter_State'); ?>","warning");
            return false;
        }

        if(spostal_code=="")
        {
            error=0;            
            swal("","Please Enter Zip Or Postal Code","warning");
            return false;
        }         

        if(sphone=="")
        {
            error=0;            
            swal("","<?php echo lang('Please_Enter_Phone'); ?>","warning");
            return false;
        }

        if(semail=="")
        {
            error=0;            
            swal("","<?php echo lang('Please_enter_email'); ?>","warning");
            return false;
        }

        if(semail!='')
        {
            if(!isValidEmailAddress(semail))
            {             
                error=0;                
                swal("","<?php echo lang('Please_Enter_Valid_Email_Id'); ?>","warning");
                return false;
            }                  
        } 

    <?php } else{ ?>
        var sfirst_name=$.trim($("#sfirst_name").val()); 
        var slast_name=$.trim($("#slast_name").val()); 
        var susername=$.trim($("#susername").val()); 

        if(sfirst_name=="")
        {
            error=0;            
            swal("","<?php echo lang('aPlease_Enter_first_Name'); ?>","warning");
            return false;
        }

        if(slast_name=="")
        {
            error=0;            
            swal("","<?php echo lang('aPlease_Enter_last_Name'); ?>","warning");
            return false;
        }

        if(susername=="")
        {
            error=0;            
            swal("","<?php echo lang('Please_Enter_User_Name'); ?>","warning");
            return false;
        }
    <?php } ?>
        
        if(error==1)
        {
            $("#loading").show();
            $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url('admin/panel/account_update_info') ?>",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(response)
                    { 
                        $("#loading").hide();
                        response=$.trim(response);
                        if(response=="email")
                        {                                     
                            swal('',"<?php echo lang('Email_already_exist'); ?> ",'warning');
                        }else if(response=="phone")
                        {              
                            swal('',"<?php echo lang('Mobile_number_already_exist'); ?>",'warning');
                        }else if(response=="cr_number")
                        {              
                            swal('',"<?php echo lang('CR_number_already_exist'); ?>",'warning');
                        }
                        else if(response=="username")
                        {              
                            swal('',"<?php echo lang('aUser_Name_already_exist'); ?>",'warning');
                        }
                        else if(response=="success")
                        {                
                            // success for user /buyer    
                            swal('',"<?php echo lang('aProfile_update_successfully'); ?>",'success');
                               // setTimeout(function(){ },2900);                            
                        }else if(response=="success1")
                        {            
                            //this for suppler and both         
                            swal('<?php echo lang('Successfully_Register'); ?>',"Please Login",'success');
                               // setTimeout(function(){ },2900);
                            setTimeout(function(){ window.location = "<?php echo base_url('admin') ?>" }, 3000);
                        }
                        else{
                            swal('',"<?php echo lang('Something'); ?>",'warning');   
                        }
                    }
            });        
        }
    });

	$(document).on("submit","#account_pro_pass",function(){
		 var error=1; 
		 var pro_new_password = $("#pro_new_password").val();
		 var pro_retype_password = $("#pro_retype_password").val();

		  if(pro_new_password=="")
          {
            error=0;            
            swal("","<?php echo lang('Please_enter_new_password'); ?>","warning");
            return false;
          }

          if(pro_retype_password=="")
          {
            error=0;            
            swal("","<?php echo lang('Please_enter_Retype_Password'); ?>","warning");
            return false;
          }

          if(pro_new_password!=pro_retype_password)
          {
          	error=0;            
            swal("","<?php echo lang('Password_does_not_match'); ?>","warning");
            return false;
          }
	});
</script>