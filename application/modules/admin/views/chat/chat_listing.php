 

<style type="text/css">

  .input-group-prepend div.btn-file.btn{
          background: #b3b3b3 !important;
    padding: 7px 26px;
    border-radius: 100px;
    margin-top: 12px;
  }

  .input-group-prepend div.btn-file.btn:hover{
    background-color:#999595 !important;
    cursor: pointer !important;
  }

  .chat-cont-right .chat-footer .input-group .input-group-append .btn.msg-send-btn{
    font-weight: 500;
  }


 .chat-cont-right .chat-body .media .media-body {
    margin-left: 20px;
    border: 0px solid red;
    float: left;
    width: 57%;
}

.chat-cont-right .chat-body .media .avatar {
    height: 30px;
    width: 30px;
    float: left;
    margin-right: 4px;
}

.chat-cont-left .chat-users-list a.media {
    border-bottom: 1px solid #f0f0f0;
    padding: 10px 15px;
    transition: all .2s ease 0s;
    display: inline-block;
    width: 100%;
    margin-bottom: 0px;
    margin-top: 0px;
    float: left;
}

.chat-cont-left .chat-users-list a.media .media-img-wrap {
    margin-right: 15px;
    position: static;
    float: left;
}

.media .media-body {
    color: #777;
    font-size: 13px;
    float: left;
    display: inline-block !important;
    width: auto;
}


.chat-cont-left .chat-search .input-group .input-group-prepend {
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    bottom: 0;
    color: #666;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    left: 15px;
    pointer-events: none;
    position: relative;
    top: 0;
    z-index: 4;
    margin-top: 0px !important;
    margin-bottom: 0px;
}

.chat-cont-left .chat-search .input-group .form-control{
  width: 75%;
  float: left;
}

.btn.msg-send-btn{
    float: left;
    width: 23%;
    margin-left: 2%;
    text-transform: uppercase;
    font-weight: 600;
}






</style>



<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/frontend/css/fontawesome.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/')?>chat_style.css">   
  <div class="chat-page">
    <div class="main-wrapper">
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <?php $last_id=1; if(!empty($user_data)) { 
              if($user_data[0]['status']==true){ 
                if(!empty($user_data[0]['compose_data'])){
                ?>
            <div class="col-xl-12">
              <div class="chat-window">
                <div class="chat-cont-left">
                  <form class="chat-search">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <i class="fa fa-search"></i>
                      </div>
                      <input type="text" class="form-control search_input" placeholder="<?php echo lang('asearch'); ?>">
                      <button type="button" id="com_btn"  class="btn msg-send-btn"><?php echo lang('aCompose'); ?></button> <!-- data-toggle="modal//" data-target="#contc_id//" -->
                    </div>                    
                    
                  </form>
                  <div class="chat-users-list">
                    <div class="chat-scroll">                      
                      <?php 
                      foreach ($user_data[0]['compose_data'] as $cd_key => $cd_val) { 
                          ($cd_key=='0' ?  $user_active='user_active' : $user_active="");
                        ?>
                      <a href="javascript:void(0);" class="media chat_list user_click <?php echo $user_active; ?>" data-id="<?php echo $cd_val['id']; ?>">
                        <div class="media-img-wrap">
                          <div class="avatar avatar-away">
                            <img src="<?php echo base_url('assets/admin/usersdata/').$cd_val['logo']; ?>" alt="<?php echo $cd_val['first_name']; ?>" class="avatar-img rounded-circle">
                          </div>
                        </div>
                        <div class="media-body">
                          <div>
                            <div class="user-name"><?php echo $cd_val['first_name']; ?></div>
                            <div class="user-last-chat"><?php echo $cd_val['subject']; ?></div>
                          </div>
                          <div>
                            <!-- <div class="last-chat-time block">7:30 PM</div> -->
                            <!-- <div class="badge badge-success badge-pill">3</div> -->
                          </div>
                        </div>
                      </a>
                      <?php } ?>
                      
                    </div>
                  </div>
                </div>

                <div class="chat-cont-right">
                  <?php
                 foreach ($user_data[0]['compose_data'] as $cd_key => $cd_val) { 
                      if($cd_key==0)
                      {
                        $show_message_div='';
                        $seen_class="seen_class";
                      }else {
                        // this for first show one message active
                        $show_message_div='show_message_div';
                        $seen_class='';
                      }
                  ?>
                  <div class="chat-body mesgs <?php echo $show_message_div; echo $seen_class; ?>" data-id="<?php echo $cd_val['id']; ?>" id="sh_chat<?php echo  $cd_val['id']; ?>">
                    <div class="chat-scroll" id="chat_scroll<?php echo $cd_val['id']; ?>">
                      <ul class="list-unstyled" id="app_message<?php echo  $cd_val['id']; ?>">
                        <li class="media sent">
                          <div class="media-body"></div>
                        </li>
                        
                        <?php if(!empty($cd_val['chat_data'])){  
                            foreach ($cd_val['chat_data'] as $chd_key => $chd_val) { 
                              if($chd_val['id']>$last_id)
                              {
                                $last_id=$chd_val['id'];
                              }
                              if($user_data[0]['id']==$chd_val['user_id']){   ?>
                        <li class="media sent" id="single_msg<?php echo $chd_val['id']; ?>">
                          <div class="avatar">
                            <img src="<?php echo base_url('assets/admin/usersdata/').$user_data[0]['logo']; ?>" alt="User Image" class="avatar-img rounded-circle">
                          </div>
                          <div class="media-body">

                            <div class="msg-box">
                              <div>
                                <?php if($chd_val['message_type']=='text'){ ?>
                                  <p><?php echo $chd_val['message']; ?></p>
                                  <?php }else{ ?>
                                  <img class="chat_img" src="<?php echo base_url('assets/admin/chat/').$chd_val['message']; ?>">  
                                <?php } ?>
                                <ul class="chat-msg-info">
                                  <li>
                                    <div class="chat-time">
                                      <span><?php echo  date('h:i A' ,strtotime($chd_val['created_date'])); ?> </span>
                                    </div>
                                  </li>
                                </ul>
                              </div>
                            </div>
                            
                          </div>
                        </li>         
                      <?php  }else{ ?>
                        <li class="media received" id="single_msg<?php echo $chd_val['id']; ?>">
                          <div class="avatar">
                            <img src="<?php echo base_url('assets/admin/usersdata/').$cd_val['logo']; ?>" alt="User Image" class="avatar-img rounded-circle">
                          </div>
                          <div class="media-body">
                            <div class="msg-box">
                              <div>
                                 <?php if($chd_val['message_type']=='text'){ ?>
                                  <p><?php echo $chd_val['message']; ?></p>
                                  <?php }else{ ?>
                                  <img class="chat_img" src="<?php echo base_url('assets/admin/chat/').$chd_val['message']; ?>">  
                                <?php } ?>                            
                                <ul class="chat-msg-info">
                                  <li>
                                    <div class="chat-time">
                                      <span><?php echo  date('h:i A' ,strtotime($chd_val['created_date'])); ?></span>
                                    </div>
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </li>
                      <?php } } } ?>                                           
                      </ul>
                    </div>
                  </div>
                  <div class="chat-footer mesgs <?php echo $show_message_div; echo $seen_class; ?>" id="sh_chat2<?php echo  $cd_val['id']; ?>">
                    <form class="msg_form" data-id="<?php echo  $cd_val['id']; ?>" data-creceiver="<?php echo  $cd_val['usid']; ?>" data-send_to="<?php echo $cd_val['send_to']; ?>" data-send_by="<?php echo $user_data[0]['send_by']; ?>">
                      <textarea class="space" name="" id="type_text<?php echo $cd_val['id']; ?>" cols="30" rows="5" style="height: 100px; width: 100%; border-color: #e3e3e3;" data-id="<?php echo $cd_val['id']; ?>" ></textarea>
                      <div class="input-group sent-msg-btn">
                        <div class="input-group-prepend">
                          <div class="btn-file btn">
                            <img src="<?php echo base_url('assets/frontend/images/paper-clip.png'); ?>" alt="" style="width: 20px;">
                            <input type="file" class="chat_pic" data-id="<?php echo  $cd_val['id']; ?>" data-creceiver="<?php echo  $cd_val['usid']; ?>" accept="image/*" data-send_to="<?php echo $cd_val['send_to']; ?>" data-send_by="<?php echo $user_data[0]['send_by']; ?>">
                          </div>
                        </div>
                        <div class="input-group-append">
                          <button type="button" class="btn msg-send-btn send_btn" id="send_btnhs<?php echo $cd_val['id']; ?>"  data-id="<?php echo  $cd_val['id']; ?>" data-creceiver="<?php echo  $cd_val['usid']; ?>" data-send_to="<?php echo $cd_val['send_to']; ?>" data-send_by="<?php echo $user_data[0]['send_by']; ?>" ><?php echo lang('Send'); ?></button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <?php } ?>
                </div>
                 <script type="text/javascript">
                    // last_idg='<?php //echo @$chd_val['id']; ?>';
                    last_idg='<?php echo $last_id; ?>';
                </script>
              </div>
            </div>
            <?php }else{ ?>
              <button type="button" id="com_btn" class="btn msg-send-btn"><?php echo lang('aCompose'); ?></button>
              <a href="javascript:void(0)" class="chat_list text-center text-danger row align-items-center pl-4" id="hsc_error"> <?php echo lang('No_message_found'); ?></a>
            
            <?php } }else{ ?>
              <a href="javascript:void(0)" class="chat_list text-center text-danger" id="hsc_error"> Your account is deactive please contact to admin</a>           

            <?php } }else{ ?>
              <a href="javascript:void(0)" class="chat_list text-center text-danger" id="hsc_error"> No message found</a>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<audio controls id="my_audio" style="display: none;">  
  <source src="https://media.geeksforgeeks.org/wp-content/uploads/20190531135120/beep.mp3" type="audio/mpeg">
  Your browser does not support the audio element.
</audio>
  <div class="modal fade contc_suplier" id="contc_id" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
       <div class="modal-content">
        <div class="modal-header">
         <h4 class="modal-title">
            <?php echo lang('aMessage_Compose'); ?>
         </h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
          
        </div>
        <div class="modal-body">    
         <form class="theme-form" id="compose_form" method="post" enctype="multipart/form-data">
            <div class="form-row">
               
               <div class="col-md-6">
                  <label for="name"><?php echo lang('to'); ?></label>
                  <!-- <input type="text" class="form-control" placeholder="To"> -->
                  <select name="user_id">
                    <option value="0"><?php echo lang('aPlease_select_vendor'); ?></option>   
                    <?php if(!empty($all_user_data))
                      // echo lang('aPlease_select_vendor'); 
                      echo $append_option;
                    {
                      if($seller_id==1){
                      foreach ($all_user_data as $aud_key => $aud_val) { ?>             
                      <option send_to="<?php echo $aud_val['send_to']; ?>" value="<?php echo $aud_val['id']; ?>"><?php echo $aud_val['first_name']; ?></option>

                      <?php } } } ?>                      
                  </select>
                 
               </div>
               <div class="col-md-6">
                  <label for="email"><?php echo lang('Subject'); ?></label>
                  <input type="text" class="form-control space" name="subject" id="csubject" placeholder="<?php echo lang('Subject'); ?>">
               </div>
               
               <div class="col-md-12 mesg_lablas">
                  <label for="inq_message"><?php echo lang('Message'); ?></label>
                  <textarea class="form-control message_text_are space" placeholder="<?php echo lang('Write_Your_Message'); ?>"  rows="6" id="cmessage" name="message"></textarea>
               </div>

            


               <div class="col-md-12">
                  <button class="btn btn-solid" type="submit"><?php echo lang('Send'); ?></button>
               </div>
               <div class="clear"></div>
            </div>
            <div class="clear"></div>
         </form>
        </div>        
      </div>
      
    </div>
  </div>


<script type="text/javascript">
  var img_array=[];
  <?php if(!empty($user_data) && !empty($user_data[0]['compose_data'])){
    foreach ($user_data[0]['compose_data'] as $cd_key => $cd_val) { ?>
        img_array[<?php echo $cd_val['usid'] ?>]='<?php echo $cd_val['logo']; ?>';
  <?php  } } ?>
  $(document).on("click",".user_click",function(){         
    $(".mesgs").hide();
     $(".mesgs").removeClass("seen_class");
     $('.chat_list').removeClass("user_active");
    var id =$(this).attr("data-id");
    $(this).addClass('user_active');
    $("#sh_chat"+id).show();
    $("#sh_chat"+id).addClass('seen_class');
    $("#sh_chat2"+id).show();
    $("#sh_chat2"+id).addClass('seen_class');
    var out=$("#chat_scroll"+id);
    // const out = document.getElementById("#app_message"+id);
    // console.log(out[0].scrollHeight);
    // const isScrolledToBottom = out[0].scrollHeight - out[0].clientHeight <= out[0].scrollTop + 1
    // console.log(out[0].scrollHeight);
    // console.log(out[0].clientHeight);
    // console.log(out[0].scrollTop);
    if (1) {      
      out[0].scrollTop = out[0].scrollHeight - out[0].clientHeight
    }  
    // console.log(out[0].scrollTop);    
    // seen_update(id);
  });



  $(document).on("click",".send_btn",function(e){              
    var id =$(this).attr("data-id");    
    var creceiver =$(this).attr("data-creceiver"); 
    var send_to =$(this).attr("data-send_to"); 
    var send_by =$(this).attr("data-send_by");    
    var message=$("#type_text"+id).val();
    if(message=='')
    {
      swal("","<?php echo lang('aPlease_Type_message'); ?>",'warning');
    }else {
      message_send(message,id,creceiver,send_to,send_by);
    }    
  });

  $(document).on("submit",".msg_form",function(e){
    e.preventDefault();
    var id =$(this).attr("data-id"); 
    var creceiver =$(this).attr("data-creceiver"); 
    var send_to =$(this).attr("data-send_to"); 
    var send_by =$(this).attr("data-send_by"); 
    var message=$("#type_text"+id).val();
    if(message=='')
    {
      swal("","<?php echo lang('aPlease_Type_message'); ?>",'warning');
    }else{
      message_send(message,id,creceiver,send_to,send_by);
    }    
  });

  function message_send(message,id,creceiver,send_to,send_by)
  {
     $.ajax({
           type: 'POST',
           url: "<?php echo base_url($language.'/admin/chat/user_chat'); ?>",
           data: {message:message,'compose_id':id,'creceiver':creceiver,'message_type':'text',send_to:send_to,send_by:send_by},            
           success: function(response)
           {            
              var html='';
              var response = $.parseJSON(response);                
              if(response.status==true)
              {
                // alert('fasdf');
                // swal('','success','success');
                $("#type_text"+id).val('');

                html+='<li class="media sent" id="single_msg'+response.message[0].id+'">';

                  html+='<div class="avatar">';
                    html+='<img src="<?php echo base_url('assets/admin/usersdata/').$user_data[0]['logo']; ?>" alt="User Image" class="avatar-img rounded-circle">';
                  html+='</div>';
                  html+='<div class="media-body">';
                    html+='<div class="msg-box">';
                      html+='<div>';
                        html+='<p>'+response.message[0].message+'</p>';
                        html+='<ul class="chat-msg-info">';
                          html+=' <li> <div class="chat-time"> <span>'+response.message[0].last_time+'</span> </div> </li>';
                        html+='</ul>'
                      html+='</div>';
                    html+='</div>';
                  html+='</div>';
                html+='</li>';

                
                $("#app_message"+id).append(html);
                var out=$("#chat_scroll"+id);                
                 if (1) {      
                    out[0].scrollTop = out[0].scrollHeight - out[0].clientHeight;                    
                    // out[0].scrollTop;
                  }       
            
               } else {
                swal("",response.message,'warning');                
              }             
           }
      });
  }

    setInterval(live_message,5000);

    function live_message()
    {        
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('admin/chat/live_message'); ?>",
            data: {'last_id':last_idg},            
            success: function(response) 
            {                  
                var html='';
                var response = $.parseJSON(response); 
                if(response.status==true)
                {
                    var chat_data=response.message; 
                     // var last_idl=chat_data.message[0]['id'];            
                     last_idg=chat_data[0].id;           
                    $.each(chat_data, function( k, v )
                    {
                        if($("#single_msg"+v.id).length==0)
                        {  
                        
                            html+='<li class="media received" id="single_msg'+v.id+'">';

                            html+='<div class="avatar">';
                              html+='<img src="<?php echo base_url('assets/admin/usersdata/'); ?>'+img_array[v.seid]+'" alt="User Image" class="avatar-img rounded-circle">';
                            html+='</div>';
                            html+='<div class="media-body">';
                              html+='<div class="msg-box">';
                                html+='<div>';
                                  if(v.message_type=='text')
                                  {
                                    html+='<p>'+v.message+'</p>';
                                  }else{
                                    html+='<img class="chat_img" src="<?php echo base_url('assets/admin/chat/'); ?>'+v.message+'"> ';
                                  }
                                  html+='<ul class="chat-msg-info">';
                                    html+=' <li> <div class="chat-time"> <span>'+v.last_time+'</span> </div> </li>';
                                  html+='</ul>'
                                html+='</div>';
                              html+='</div>';
                            html+='</div>';
                          html+='</li>';
                        if($("#single_msg"+v.id).length==0)
                        {                    
                           // $("#my_audio").get(0).play();       
                          $("#app_message"+v.compose_id).append(html);
                        }   
                            var out=$("#chat_scroll"+v.compose_id);                        
                            if (1) {      
                                out[0].scrollTop = out[0].scrollHeight - out[0].clientHeight;
                            } 
                        }
                        
                    });                                
                }
            }            
        });
    }   
</script>





<script type="text/javascript">
  $(document).on("click","#com_btn",function(){    
    $('#cseller_id').val('').trigger('chosen:updated');    
    $("#compose_form")[0].reset();
    $('#contc_id').modal('show');
  });
  $(document).on("submit","#compose_form",function(e){
      e.preventDefault();
      var cseller_id = $("#cseller_id").val();
      var csubject = $.trim($("#csubject").val());
      var cmessage = $.trim($("#cmessage").val());
      var error=1;
      var send_to = $('option:selected').attr('send_to');
      
      if(cseller_id=='0')
      {
         error=0;
         swal("","<?php echo lang('aPlease_select_vendor'); ?>","warning");
         return false;
      }

      if(csubject=='')
      {
         error=0;
         swal("","<?php echo lang('aPlease_enter_subject'); ?>","warning");
         return false;
      }

      if(cmessage=='')
      {
         error=0;
         swal("","<?php echo lang('aPlease_enter_message'); ?>","warning");
         return false;
      }
      fd = new FormData(this);
      fd.append("send_to", send_to);
      // alert("fasdfa");
      // return false;
      if(error==1)
      {
         $('#loading').show();
         $.ajax({
            type: 'POST',
            url: "<?php echo base_url($language.'/admin/chat/compose_data'); ?>",
            data: fd,
            contentType: false,
            cache: false,
            processData:false,
            success: function(response)
            {
               $('#loading').hide();
               response=$.trim(response);
               var response = $.parseJSON(response);
               if(response.status==true)
               {
                swal("",response.message,'success');
                // $("#hsc_error").hide();
                $('#cseller_id').val('').trigger('chosen:updated'); 
                $("#compose_form")[0].reset();
                // $('#contc_id').modal('hide');
                // $("#append_compose").append(response.data)
                url="<?php echo base_url($language.'/admin/chat'); ?>";             
                setTimeout(function(){ window.location=url; }, 1500);
               }else{
                swal("",response.message,'warning');
               }
            }
        });
      }          
  });    
</script>

<script type="text/javascript">
  $(".search_input").on("keyup", function() {
    // console.log('123')
    var value = $(this).val().toLowerCase();
    $(".user_click").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
</script>

<script type="text/javascript">
  $(document).on("change",".chat_pic",function()
  {     
      // var class_name=$(this).data("class");      
      var id=$(this).data("id");      
      var creceiver=$(this).data("creceiver");  
      var send_to =$(this).attr("data-send_to"); 
      var send_by =$(this).attr("data-send_by");    
         file = this.files[0];
         // console.log(file);
         // return false;
         // file = this.file;   
         
            maxSize=2048;      
            var imagefile = file.type;            
            file_tp=imagefile.slice(-3);  
            var imagesize = file.size;
            imagesize=Math.round((imagesize / 1024));                   
            var match= ["image/jpeg","image/png","image/jpg"];
            // ,"application/pdf","application/vnd.openxmlformats-officedocument.wordprocessingml.document"
            if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])  )) {
                // || (imagefile==match[3]) || (imagefile==match[4])
                // swal("",'Please select a valid image file (JPEG/JPG/PNG).');
                swal("","<?php echo lang('Please_select_a_valid_image_file'); ?>","warning");
                // $(".image_check").val('');
                return false;
            }else if(imagesize>maxSize)
            {
                swal("","File should be less than 2 mb","warning");
                return false;
            }else 
            {
              // eadURL(this,class_name);
              // file =jQuery("#file")[0];
              fd = new FormData();
              // console.log(this.file.length);
              // console.log(this.file);
              // return false;
              // individual_capt = "Quotation image";
              // fd.append("caption", individual_capt);  
              // fd.append('action', 'fiu_upload_file'); 
              // fd.append("path", 'admin/usersdata/');              
              fd.append("name", this.files[0]);
              fd.append("compose_id", id);
              fd.append("creceiver", creceiver);
              fd.append("send_to", send_to);
              fd.append("send_by", send_by);
              fd.append("message_type", 'image');
              $("#loading").show();
              jQuery.ajax({
                  type: 'POST',
                  url: '<?php echo base_url('admin/chat/user_chat') ?>',
                  data: fd,
                  contentType: false,
                  cache: false,
                  processData: false,
                  success: function(response)
                  {
                    $("#loading").hide();
                    response=$.trim(response);
                    var response = $.parseJSON(response);
                    var html='';
                    if(response.status==true)
                    {
                      // alert('fasdf');
                      // swal('','success','success');
                      $("#type_text"+id).val('');

                      html+='<li class="media sent" id="single_msg'+response.message[0].id+'">';

                        html+='<div class="avatar">';
                          html+='<img src="<?php echo base_url('assets/admin/usersdata/').$user_data[0]['logo']; ?>" alt="User Image" class="avatar-img rounded-circle">';
                        html+='</div>';
                        html+='<div class="media-body">';
                          html+='<div class="msg-box">';
                            html+='<div>';
                              html+='<img class="chat_img" src="<?php echo base_url('assets/admin/chat/'); ?>'+response.message[0].message+'"> ';
                              html+='<ul class="chat-msg-info">';
                                html+=' <li> <div class="chat-time"> <span>'+response.message[0].last_time+'</span> </div> </li>';
                              html+='</ul>'
                            html+='</div>';
                          html+='</div>';
                        html+='</div>';
                      html+='</li>';
                      
                      $("#app_message"+id).append(html);
                      var out=$("#chat_scroll"+id);                
                       if (1) {      
                          out[0].scrollTop = out[0].scrollHeight - out[0].clientHeight;
                          // out[0].scrollTop;
                        }   
                  
                     } else {
                      swal("",response.message,'warning');                
                    } 
                  }
              });
            } 
  });
</script>