<div class="row clearfix">

   <div class="col-md-12">

      <div class="demo-masked-input">

         <form action="" method="post" id="Pcustomize">

      	<div class="row">

            <div class="col-sm-4">

               <label for="category">Customize</label>

               <div class="form-group form-float form-group-lg">

                  <div class="form-line">

                     <input type="text" name="title" value="" placeholder="Customize Title" id="title" autocomplete="off" class="form-control space">

                  </div>

               </div>            

            </div>                     

            <div class="col-sm-4" id="checkbox_afer">

               <label for="category">Type</label>

               <select  placeholder="" id="cus_type" name="type">        

                  <option value="">Select Type</option>   

                  <option value="1">Radio</option>   

                  <option value="2">check box free</option>   

                  <option value="3">check box paid</option>   

               </select>

            </div>

             <div class="col-sm-2">

               <div class="form-group">

                  <label for="groups">Status</label>

                  <div>

                     <input type="radio" name="status" value="1" id="active" class="with-gap radio-col-green" checked>

                     <label for="active">Active</label>                     

                     <input type="radio" name="status" value="0" id="deactive" class="with-gap radio-col-green">

                     <label for="deactive">Deactive</label>                  

                  </div>

               </div>

            </div>            

         </div>

         <div class="row" id="append_custom">   

        

         </div>         

         <button type="button" id="add_att" class="btn btn-primary">Add</button>

         <button type="submit" class="btn btn-primary">Submit</button>

      </form>

      </div>

    </div>

</div>  

<script type="text/javascript">

   var count=1; 



</script> 

<script type="text/javascript">

      var check_flag=0;

      //this for to identify slected val

      var select_val=0;

      

      var limit_flag=0;

   $(document).on("click","#add_att",function()

   {

      // alert("fasdf");

      var error=1;      

      if(select_val==1)

      {

         var att_name=$(".att_name").val(); 

         if(att_name=='')

         {

            swal("","Plese Enrer name ","warning");

            error=0;

            return false;

         }

         if(error==1)

         {

            

            count++;                        

            $("#append_custom").append('<div class="col-sm-6 remove_radioall remove'+count+'"> <label for="category">Name</label><span class="remove_att" data-id="'+count+'" style="padding: 10px; background-color: #e46767;">Remove</span> <div class="form-group form-float form-group-lg"> <div class="form-line"> <input type="text" name="name[]"  value="" placeholder="Name" id="title" autocomplete="off" class="form-control att_name space" required> </div> </div> </div>');

         }

      }else if(select_val==2)

      {

         var att_name=$(".att_name").val(); 

         if(att_name=='')

         {

            swal("","Plese Enrer name ","warning");

            error=0;

            return false;

         }

         if(error==1)

         {

            count++;            

            $("#append_custom").append('<div class="col-sm-6 remove_freeall remove'+count+'"> <label for="category">Name</label> <span class="remove_att" data-id="'+count+'" style="padding: 10px; background-color: #e46767;">Remove</span> <div class="form-group form-float form-group-lg"> <div class="form-line"> <input type="text" name="name[]"  value="" placeholder="Name" id="title" autocomplete="off" class="form-control att_name space" required> </div> </div> </div>');

         }

      }

      else if(select_val==3)

      {

         

         var att_priceb=$(".att_price").val();   

         // var att_pricea=$(".att_pricea").val();    

         if(att_priceb=='')

         {

            swal("","Plese Enter price ","warning");

            error=0;

            return false;

         }

         // if(att_pricea=='')

         // {

         //    swal("","Plese Enrer price abu dhabi ","warning");

         //    error=0;

         //    return false;

         // }

         if(error==1)

         {

            count++;  



            var chebox_paid='';

            chebox_paid+='<div class="col-sm-6 remove_paidall remove'+count+'"> <label for="category">Name</label> <div class="form-group form-float form-group-lg"> <div class="form-line"> <input type="text" name="name[]"  value="" placeholder="Name" id="title" autocomplete="off" class="form-control att_name space" required> </div> </div> </div> ';



            // chebox_paid+='<div class="col-sm-6 remove_paidall remove'+count+'" > <label for="category">Price</label> <div class="form-group form-float form-group-lg"> <div class="form-line"> <input type="text" name="price[]"  value="" placeholder="Price" id="title" autocomplete="off" class="form-control att_price att_p" onkeypress="return isNumberdotKey(event)" required> </div> </div> </div> ';



            chebox_paid+='<div class="col-sm-4 remove_paidall remove'+count+'"> <label for="category">Price</label> <span class="remove_att" data-id="'+count+'" style="padding: 10px; background-color: #e46767;">Remove</span> <div class="form-group form-float form-group-lg"> <div class="form-line"> <input type="text" name="price[]"  value="" placeholder="Price" id="title" autocomplete="off" class="form-control att_pricea att_p" onkeypress="return isNumberdotKey(event)" required> </div> </div> ';           

            $("#append_custom").append(chebox_paid);

         }

      }else{

         swal("","Please Select type","warning");

      }  

   });

</script>

<script type="text/javascript"> 

      

 

</script>   

<script type="text/javascript">   

   $(document).on("submit","#Pcustomize",function(e)

    {

      e.preventDefault(); 

      var title=$("#title").val();

      var type=$("#cus_type").val();

      var error=1;

      if(title=='')

      {

         swal("","Plese Enrer Customize Title","warning");

         error=0;

         return false;

      }

      if(type=='')

      {

         swal("","Plese Select type","warning");

         error=0;

         return false;

      }

      if(limit_flag==1)

      {

         var add_limit=$("#add_limit").val();

         if(add_limit=='')

         {

            swal("","Plese Enrer Limit","warning");

            error=0;

            return false;

         }

         if(add_limit<=0)

         {

            swal("","Please Enter Limit Value Grater Than Zero","warning");

            error=0;

            return false;  

         }

      }

      if(error==1){

         $("#loading").show();

         $.ajax({

               type: 'POST',

               url: "<?php echo base_url('admin/pcustomize/index'); ?>",

               data: new FormData(this),

               contentType: false,

               cache: false,

               processData:false,

               success: function(response)

               { 

                  $("#loading").hide();

                  response = response.replace(/\s/g, '');

                  if(response=='att_error')

                  {

                     swal("","Please Select Attribute","warning");

                  }else if(response=='already')

                  {

                     swal("","Customize title already added for this type","warning");

                  }else if(response==1)

                  {

                     swal("","Customize added successfully","success");

                     setTimeout(function(){ location.reload(); }, 1500);

                  }else{

                     swal("","something went wrong","warning");

                  }

                  

               }  

         });

      }             

      // alert("fasdf");

    });  



</script>   

<script type="text/javascript">

   $(document).on("click",".remove_att",function(){

      id=$(this).attr("data-id"); 

      $(".remove"+id).remove();

   });

</script>

<script type="text/javascript">

   $(document).on("change","#cus_type",function(){

      var val=$(this).val();       

      select_val=val;    

      if(val=='1')

      {

         limit_flag=0;

         $(".att_p").val(0);

         $("#check_paid").remove(); 

         $(".remove_freeall").remove(); 

         $(".remove_paidall").remove();                 

         $("#append_custom").append('<div class="col-sm-4 remove_radioall remove'+count+'"> <label for="category">Name</label><span class="remove_att" data-id="'+count+'" style="padding: 10px; background-color: #e46767;">Remove</span> <div class="form-group form-float form-group-lg"> <div class="form-line"> <input type="text" name="name[]"  value="" placeholder="Name" id="title" autocomplete="off" class="form-control att_name space" required> </div> </div> </div>');

      }else if(val=='2')

      {

         limit_flag=0;

         $(".att_p").val(0);

         $("#check_paid").remove(); 

         $(".remove_radioall").remove();

         $(".remove_paidall").remove();                        

         $("#append_custom").append('<div class="col-sm-4 remove_freeall remove'+count+'"> <label for="category">Name</label> <span class="remove_att" data-id="'+count+'" style="padding: 10px; background-color: #e46767;">Remove</span> <div class="form-group form-float form-group-lg"> <div class="form-line"> <input type="text" name="name[]"  value="" placeholder="Name" id="title" autocomplete="off" class="form-control att_name space" required> </div> </div> </div>');

      }else if(val=='3'){

          limit_flag=1;

         $(".att_p").val('');

         $(".remove_radioall").remove();

         $(".remove_freeall").remove();

         append='';

         append='<div class="col-sm-2" id="check_paid"> <label for="category">Limit</label> <div class="form-group form-float form-group-lg"> <div class="form-line"> <input type="text" name="add_limit" value="1" placeholder="Limit" id="add_limit" autocomplete="off" class="form-control" onkeypress="return isNumberdotKey(event)"> </div> </div> </div>';  

         $( "#checkbox_afer" ).after(append);

          var chebox_paid='';

          chebox_paid+='<div class="col-sm-6 remove_paidall remove'+count+'"> <label for="category">Name</label> <div class="form-group form-float form-group-lg"> <div class="form-line"> <input type="text" name="name[]"  value="" placeholder="Name" id="title" autocomplete="off" class="form-control att_name space" required> </div> </div> </div> ';



         // chebox_paid+='<div class="col-sm-4 remove_paidall remove'+count+'" > <label for="category">Price Bahrain</label> <div class="form-group form-float form-group-lg"> <div class="form-line"> <input type="text" name="price_bh[]"  value="" placeholder="Price Bahrain" id="title" autocomplete="off" class="form-control att_priceb att_p" onkeypress="return isNumberdotKey(event)" required> </div> </div> </div> ';



         chebox_paid+='<div class="col-sm-6 remove_paidall remove'+count+'"> <label for="category">Price </label> <span class="remove_att" data-id="'+count+'" style="padding: 10px; background-color: #e46767;">Remove</span> <div class="form-group form-float form-group-lg"> <div class="form-line"> <input type="text" name="price[]"  value="" placeholder="Price" id="title" autocomplete="off" class="form-control att_price att_p" onkeypress="return isNumberdotKey(event)" required> </div> </div> ';         

         $("#append_custom").append(chebox_paid);    

      }

      else{

         limit_flag=0;

         $(".att_p").val('');

         $("#check_paid").remove();

      }

      

   });

</script>



<style type="text/css">
   span.remove_att {
    border-radius: 10px;
    position: relative;
    margin-bottom: 11px;
    overflow: hidden;
    padding: 10px!important;
    color: white;
    top: -4px;
    left: 10px;
    font-size: 12px;
    cursor: pointer;
}
</style>