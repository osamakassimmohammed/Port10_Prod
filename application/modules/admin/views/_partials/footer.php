<!-- <script src="<?php //echo base_url('/assets/') ?>frontend/js/vanilla-toast.min.js"></script> -->
<!-- <link href="<?php //echo base_url('/assets/') ?>frontend/css/vanilla-toast.min.css" rel="stylesheet" type="text/css"> -->
<script type="text/javascript">
$(document).ready(function(){
    setTimeout(function(){ $('.loading').hide(); }, 700);
});

function toggleFullScreen(elem) {
    // ## The below if statement seems to work better ## if ((document.fullScreenElement && document.fullScreenElement !== null) || (document.msfullscreenElement && document.msfullscreenElement !== null) || (!document.mozFullScreen && !document.webkitIsFullScreen)) {
    if ((document.fullScreenElement !== undefined && document.fullScreenElement === null) || (document.msFullscreenElement !== undefined && document.msFullscreenElement === null) || (document.mozFullScreen !== undefined && !document.mozFullScreen) || (document.webkitIsFullScreen !== undefined && !document.webkitIsFullScreen)) {
        if (elem.requestFullScreen) {
            elem.requestFullScreen();
        } else if (elem.mozRequestFullScreen) {
            elem.mozRequestFullScreen();
        } else if (elem.webkitRequestFullScreen) {
            elem.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
        } else if (elem.msRequestFullscreen) {
            elem.msRequestFullscreen();
        }
    } else {
        if (document.cancelFullScreen) {
            document.cancelFullScreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitCancelFullScreen) {
            document.webkitCancelFullScreen();
        } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
        }
    }
}
</script>
<script type="text/javascript">
     $(document).on('keydown', '.space', function(e) {
    if (e.which === 32 &&  e.target.selectionStart === 0) {
      return false;
    }  
  });
</script>

<!-- this for notification message for new order start -->
<script>
  // function showToast(toast,id)
  // {
  //   // alert(id);
  //   // alert("AsdAsd");
  //   var type = 'success';
  //   var position = 'top-right';
  //   var timeOutMs = 10000;
  //   toast.showSuccess("New Order Received", " <a target='_blank' href='<?php //echo base_url('admin/orders/view/')?>"+id+"'>View</a>", position, timeOutMs);
  // }

  // var toastParentBody = document.querySelector("body");
  // var toastLoggerBody = new VanillaToast(toastParentBody);

  // var showToastInWindow = document.querySelector("#showToastInWindow");
  // showToastInWindow.addEventListener("pointerdown", function () {
  //   showToast(toastLoggerBody);
  // });
</script>
<script type="text/javascript">
   // setInterval(notification,10000);   
    function notification()   
    {   
       $.ajax({   
             type: 'GET',     
             url: "<?php echo base_url('admin/Dashbord/notification'); ?>",  
             dataType: "json",   
             success: function(response)    
             {                  
               if(response.status==true)   
               {     
                   $.each(response.message, function( k, v )    
                   {
                        // console.log(v.order_master_id); 
                        showToast(toastLoggerBody,v.order_master_id);    
                   });   
               }   
             }   
           });    
      }  
</script>
<!-- this for notification message for new order end -->
<script type="text/javascript">
  $("#list-report-success").fadeOut(10000);
  $(".alert-success").fadeOut(10000);

  $('.en_toggle').click(function() {
    $('#loading').show();        
    url="<?php echo lang_url('ar'); ?>"; 
    window.location=url;
});
 $('.ar_toggle').click(function() {  
    $('#loading').show();      
    url="<?php echo lang_url('en'); ?>"; 
    window.location=url;
});  

setInputFilter(document.getElementById("field-amount"), function(value) {
  return /^-?\d*[.,]?\d{0,2}$/.test(value); }); 
</script> 