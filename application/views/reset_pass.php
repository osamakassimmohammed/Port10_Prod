

<div class="container" style="text-align: center;margin-top: 3%;margin-bottom: 12%;">





<div class="change-password section profil_sectn_page change_pass_sectn_wrap">
  
    

    <form id="verify_form1" action="<?php echo base_url($language.'/login/resetpassword/');?><?php echo $uid; ?>/<?php echo $code; ?>" class="form-delivery" method="post">
        
          <?php if (!empty($this->session->flashdata('error1'))) { ?>
        <div class="alert alert-error">
        <a href="#" class="errorr"></a>
        <strong>error !</strong> <?php echo  $this->session->flashdata('error1'); ?> .
        </div>
        <?php } ?>
        
        
        <h2>Change password</h2>
        <!-- form -->
        <!--<div class="form-group">
            <label>Old Password</label>
            <input type="password" class="form-control" placeholder="Enter Old Password" name="password_old" id="old_pw" pattern=".{6,}" title="Minimum 6 characters" >
        </div>-->
        <div class="asd">
            <div class="form-group">
                <p>New Password <i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Password Minimum six characters, at least one uppercase letter, one lowercase letter, one number and one special character"></i> </p>
                <input type="password" class="form-control" placeholder="Enter New Password" name="password" id="new_pw" >
            </div>
            <div class="form-group">
                <p>Confirm password</p>
                <input type="password" class="form-control" placeholder="Confirm New Password" name="confirm_password" id="cfm_pw" >
            </div>

            <div class="form-group">
                 <input type="submit" name="submit" onsubmit="return checkpass();" class="btn vibrate1" value="Update">
            </div>


        </div>
            

       
        <!-- <button style="width: 10%" type="submit" name="submit" onsubmit="return checkpass();" class="btn vibrate"><span class="updatee">Save</span></button> -->
    </form></div>

</div>




<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.min.js"></script>


<script type="text/javascript">
<?php print_r($msgt); ?>
<?php   if(isset($actionmsg['msg']) && !empty($actionmsg['msg'])){
echo 'swal("", "'.$actionmsg['msg'].'", "'.$actionmsg['msgt'].'")';
} ?>
</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<script type="text/javascript">

    jQuery(document).ready(function($){
      $('#verify_form1').submit(function(event)
      {
          // alert("Hello! I am an alert box!!");
          var new_pw = $('#new_pw').val();
          var cfm_pw = $('#cfm_pw').val();
          var old_pw = $('#old_pw').val();
          if(old_pw =="")
          {
            swal("",'Enter Current Password.', 'warning');
            return false;
          }
          if(new_pw == "" || cfm_pw == "")
          {
            swal("",'Enter New Password And Confirm Password.', 'warning');
            return false;
          }

          if(!isValidpassword(new_pw))
          {
              error=0;
              stepthree=0;
              swal("","Password Minimum six characters, at least one uppercase letter, one lowercase letter, one number and one special character","warning");
              return false;
          } 

          if (new_pw == cfm_pw) 
          {
            return true;
          }
          else
          {
            $('#new_pw').val('');
            $('#cfm_pw').val('');
            $('#old_pw').val('');
            swal("",'Confirm password does not match.', 'warning');
            return false;
          }
      });
   });
</script>




<style>

input.btn.vibrate1 {
    margin-top: 10px;
    width: 100%;
}

p {
    margin: 0px;
    margin-top: 10px;
    text-align: left;
}
.form-group {
    width: 100%;
    text-align: left;
}

.asd {
    width: 50%;
    margin: 0px auto;
}
    input {
    width: 100%;
    padding: 7px;
    border: 1px solid #cdcdcd;
    border-radius: 5px;
}

</style>