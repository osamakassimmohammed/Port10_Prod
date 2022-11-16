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

<?php $first_name=$username=$street_name=$building_no=$city=$state=$postal_code=$phone=$email=$deactive='';
$access_permission=array();
$logo='user_chat.png';
$country='Saudi Arabia';
$active='checked';  
if(!empty($subsupplier_data)){
    $first_name=$subsupplier_data[0]['first_name'];
    $username=$subsupplier_data[0]['username'];
    $street_name=$subsupplier_data[0]['street_name'];
    $building_no=$subsupplier_data[0]['building_no'];
    $city=$subsupplier_data[0]['city'];
    $state=$subsupplier_data[0]['state'];
    $postal_code=$subsupplier_data[0]['postal_code'];
    $phone=$subsupplier_data[0]['phone'];
    $email=$subsupplier_data[0]['email'];
    $access_permission=explode(',',$subsupplier_data[0]['access_permission']);    

    if($subsupplier_data[0]['active']==1)
    {
      $active='checked';  
      $deactive='';
    }else{
      $deactive='checked';
      $active='';  
    }
}
 ?>
<?php if($user->type=='suppler'){ ?>
<div class="see_sub">        
        <a href="<?php echo base_url($language.'/admin/panel/sub_supplier_list') ?>"><?php echo lang('aSub_supplier_List'); ?></a>
</div>
<?php } ?>
<div class="row">
    
    <div class="col-md-12 col-md-8asas">
        <div class="box box-primary">
            <div class="box-header" style="margin-bottom: 23px;">
                <h4 class="box-title"><?php echo lang('aAccount_Info'); ?></h4>
            </div>
            <div class="box-body">
                <form  action="" id="account_pro_update" method="post" enctype="multipart/form-data">
                    
                    <div class="col-sm-4">
                        <div class="form-line focused">
                            <label><?php echo lang('First_Name'); ?></label>
                            <input type="text" name="first_name" value="<?php echo $first_name ?>" placeholder="<?php echo lang('First_Name'); ?>" id="sfirst_name" class="form-control ">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-line focused">
                            <label><?php echo lang('CR_Number'); ?></label>
                            <input type="text" name="username" value="<?php echo $username ?>" placeholder="<?php echo lang('CR_Number'); ?>" id="scr_number" class="form-control " onkeypress="return isNumberKey(event)"> 
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-line focused">
                            <label><?php echo lang('Street_Name'); ?></label>
                            <input type="text" name="street_name" value="<?php echo $street_name ?>" placeholder="<?php echo lang('Street_Name'); ?>" id="sstreet_name" class="form-control ">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-line focused">
                            <label><?php echo lang('Building_Num'); ?></label>
                            <input type="text" name="building_no" value="<?php echo $building_no ?>" placeholder="<?php echo lang('Building_Num'); ?>" id="sbuilding_no" class="form-control ">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-line focused">
                            <label><?php echo lang('Select_City'); ?></label>
                            <select id="scity" name="city">
                                <option value=""><?php echo lang('Select_City'); ?></option>
                                <?php if(!empty($city_list)){
                                    foreach ($city_list as $cl_key => $cl_val) { 
                                        if($cl_val['city_name']==$city)
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
                                    if($sl_val['state_name']==$state)
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
                    <div class="col-sm-3">
                        <div class="form-line focused">
                            <label><?php echo lang('Select_Zip_Or_Postal_Code'); ?></label>

                            <input type="text" name="postal_code" value="<?php echo $postal_code ?>" placeholder="<?php echo lang('Enter_Postal_Code'); ?>" id="spostal_code" class="form-control " onkeypress="return isNumberKey(event)">         
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-line focused">
                            <label><?php echo lang('Country'); ?></label>
                            <input type="text" name="country" value="<?php echo $country ?>" placeholder="<?php echo lang('Country'); ?>" id="scountry" class="form-control " readonly>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-line focused">
                            <label><?php echo lang('Phone'); ?></label>
                            <input type="text" name="phone" value="<?php echo $phone ?>" placeholder="<?php echo lang('Phone'); ?>" id="sphone" class="form-control " onkeypress="return isNumberKey(event)">
                        </div>
                    </div>

                    <div class="col-sm-3">
                       <label for="groups">Status</label>
                        <div>              
                          <input type="radio" name="active" value="1" id="Accept" class="with-gap radio-col-green" <?php echo $active ?> >
                          <label for="Accept">Active</label> 
                          <input type="radio" name="active" value="0" id="Reject" class="with-gap radio-col-green" <?php echo $deactive ?>>
                          <label for="Reject">Deactive</label>         
                        </div>  
                    </div>
                    <div class="clear"></div>
                    <div class="col-sm-3">
                        <div class="form-line focused">
                            <label><?php echo lang('aAccess_Permission'); ?></label>
                            <select class="form-control " id="saccess_permission" name="access_permission[]" multiple>
                            <!-- <option value=""><?php //echo lang('aSelect_Access_Permission'); ?></option> -->
                            <?php if(!empty($permission_arr)){
                                foreach ($permission_arr as $pcl_key => $pcl_val) { 
                                     $bselected='';
                                      if(in_array($pcl_key, $access_permission))
                                      {
                                         $bselected="selected";
                                      }
                                    ?>
                                    <option value="<?php echo $pcl_key; ?>" <?php echo $bselected; ?>><?php echo $pcl_val; ?></option>
                            <?php }} ?>
                            </select> 
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-line focused">
                            <label><?php echo lang('Email'); ?></label>
                            <input type="text" name="email" value="<?php echo $email ?>" placeholder="<?php echo lang('Email'); ?>" id="semail" class="form-control ">
                        </div>
                    </div>                                  

                    <div class="col-sm-3">
                        <div class="form-line focused">
                            <label><?php echo lang('New_Password'); ?></label>
                            <input type="password" id="pro_new_password" name="new_password" value="" placeholder="<?php echo lang('New_Password'); ?>" class="form-control " >
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-line focused">
                            <label><?php echo lang('aRetype_Password'); ?></label>
                            <input type="password" id="pro_retype_password" name="retype_password" value="" placeholder="<?php echo lang('aRetype_Password'); ?>" class="form-control " >
                        </div>
                    </div>

                   

                    

                    <div class="col-sm-4">
                        <div class="form-line">
                            <input type="file" name="logo" value=""  autocomplete="off" class="form-control image_check" accept="image/*" />
                        </div>
                        <img id="blah" class="blah" width="200px" height="200px" src="<?php echo base_url('assets/admin/usersdata/').$logo; ?>" alt="your image" />
                        <div class="clear"></div>                    
                    </div>
                    
                    <div class="clear"></div>
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary"><?php echo lang('Update'); ?></button>
                    </div>
                </form>
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

   function isValidpassword(password) {
    var pattern = new RegExp("^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$");
    return pattern.test(password);
  }
    $(document).on("submit","#account_pro_update",function(e)
    {
        e.preventDefault();  
        var error=1;   
        var stepone=1; 
        var steptwo=1; 
        var stepthree=1;         
        // var stype=$("#stype").val();         
        var sfirst_name=$.trim($("#sfirst_name").val());  
        var scr_number=$.trim($("#scr_number").val());

        var sstreet_name=$.trim($("#sstreet_name").val());          
        var sbuilding_no=$.trim($("#sbuilding_no").val());          
        var scity=$.trim($("#scity").val());          
        var sstate=$.trim($("#sstate").val());          
        var spostal_code=$.trim($("#spostal_code").val());          
        var scountry=$.trim($("#scountry").val());      

        var sphone=$.trim($("#sphone").val());          
        var semail=$.trim($("#semail").val());                                          
                
        var sfirst_name=$.trim($("#sfirst_name").val()); 
        var saccess_permission=$.trim($("#saccess_permission").val()); 

        if(sfirst_name=="")
        {
            error=0;            
            swal("","<?php echo lang('Enter_Your_First_Name'); ?>","warning");
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

        if(saccess_permission=="" || saccess_permission==0)
        {
            error=0;            
            swal("","<?php echo lang('aPlease_Select_Access_Permission'); ?>","warning");
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
        var pro_new_password = $("#pro_new_password").val();
        var pro_retype_password = $("#pro_retype_password").val();
        <?php if(empty($euid)){ ?> 

        if(pro_new_password=="")
        {
            error=0;            
            swal("","<?php echo lang('Please_enter_new_password'); ?>","warning");
            return false;
        }else{
            if(!isValidpassword(pro_new_password))
            {
                error=0;
                swal("","<?php echo lang('password_Minimum'); ?>","warning");
                return false;
            }   
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
        <?Php }else{ ?>
            if(pro_new_password!="")
            {
                if(!isValidpassword(pro_new_password))
                {
                    error=0;
                    swal("","<?php echo lang('password_Minimum'); ?>","warning");
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
            }

        <?php } ?>
        
        if(error==1)
        {
            $("#loading").show();
            $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url('admin/panel/create_sub_seller/').$euid ?>",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(response)
                    { 
                        $("#loading").hide();
                        response=$.trim(response);
                        var response = $.parseJSON(response);
                        if (response.status==true)
                        {
                            swal('',response.message,'success');
                            if(response.flag=="added")
                            {
                                setTimeout(function(){ location.reload(); }, 2000);
                            }
                        }else if(response.status==false)
                        {
                            swal('',response.message,'warning');
                        }else{
                            swal('',"<?php echo lang('Something'); ?>",'warning');   
                        }
                    }
            });        
        }
    });

    
</script>