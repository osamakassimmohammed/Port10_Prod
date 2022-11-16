<?php
   if($pcustomize_data[0]['type']=='1')
   {
      $radio_selected='selected';
      $check_selected='';
      $limit_flag=0;
   }else{
      $check_selected='selected';
      $radio_selected='';
      $limit_flag=1;
   }
   if($pcustomize_data[0]['status']=='1')
   {
      $status_active='checked';
      $status_deactive='';
   }else{
      $status_deactive='checked';
      $status_active='';
   }
?>
<div class="row clearfix">
   <div class="col-md-12">
      <div class="demo-masked-input">
         <form action="" method="post" id="Pcustomize">
      	<div class="row">
            <div class="col-sm-4">
               <label for="category">Customize</label>
               <div class="form-group form-float form-group-lg">
                  <div class="form-line">
                     <input type="text" name="title" value="<?php echo $pcustomize_data[0]['title']; ?>" placeholder="Product Name" id="title" autocomplete="off"  class="form-control space ">
                  </div>
               </div>            
            </div>                     
            <div class="col-sm-4">
               <label for="category">Type</label>
               <select  placeholder="" id="cus_type" name="type" disabled>        
                  <option value="">Select Type</option>   
                  <option value="1" <?php echo $radio_selected; ?> >Radio</option>   
                  <option value="2" <?php echo $check_selected; ?>>check box</option>   
               </select>
            </div>
            <?php
               if($pcustomize_data[0]['type']=='2')
               { ?>
               <div class="col-sm-2" id="check_paid"> 
                  <label for="category">Limit</label> 
                  <div class="form-group form-float form-group-lg"> 
                     <div class="form-line"> 
                        <input type="text" name="add_limit" value="<?php echo $pcustomize_data[0]['add_limit'] ?>" placeholder="Limit" id="add_limit" autocomplete="off" class="form-control" onkeypress="return isNumberKey(event)"> 
                     </div> 
                  </div> 
               </div>   
            <?php } ?>
            <div class="col-sm-2">
               <div class="form-group">
                  <label for="groups">Status</label>
                  <div>
                     <input type="radio" name="status" value="1" id="active" class="with-gap radio-col-green" <?php echo $status_active; ?> >
                     <label for="active">Active</label>                     
                     <input type="radio" name="status" value="0" id="deactive" class="with-gap radio-col-green" <?php echo $status_deactive; ?>>
                     <label for="deactive">Deactive</label>                  
                  </div>
               </div>
            </div>
         </div>
         <?php if(!empty($pcustomize_data[0]['pcustomize_attr'])) {
                  $att_count=count($pcustomize_data[0]['pcustomize_attr']); 
               $i=1;
                  foreach ($pcustomize_data[0]['pcustomize_attr'] as $pcus_key => $pcus_val) {          
            ?>
         <div class="row" class="append_custom">
            <div class="col-sm-4 remove<?php echo $pcus_val['id']; ?>">
               <label for="category">Name</label>
               <div class="form-group form-float form-group-lg">
                  <div class="form-line">
                     <input type="text" name="name[]"  value="<?php echo $pcus_val['name']; ?>" placeholder="Product Name" id="title" autocomplete="off"  class="form-control att_name space">
                  </div>
               </div>            
            </div>
            <div style="display:none" class="col-sm-4 remove<?php echo $pcus_val['id']; ?>">
               <label for="category">Name</label>
               <div class="form-group form-float form-group-lg">
                  <div class="form-line">
                     <input type="hidden" name="a_id[]"  value="<?php echo $pcus_val['id']; ?>" placeholder="Product Name" id="" autocomplete="off"  class="form-control">
                  </div>
               </div>            
            </div> 
            <div class="col-sm-4 remove<?php echo $pcus_val['id']; ?>">
               <label for="category">Price Bahrain</label>
               <div class="form-group form-float form-group-lg">
                  <div class="form-line">
                     <input type="text" name="price_bh[]" value="<?php echo $pcus_val['price_bh']; ?>" placeholder="Product Name" id="title" autocomplete="off" class="form-control att_priceb ">
                  </div>
               </div>            
            </div>  
            <div class="col-sm-4 remove<?php echo $pcus_val['id']; ?>">
               <label for="category">Price Abu Dhabi</label>
               <span class="remove_att" data-value="" data-id="<?php echo $pcus_val['id']; ?>" style="padding: 10px; background-color: #e46767;">Remove</span>
               <div class="form-group form-float form-group-lg">
                  <div class="form-line">
                     <input type="text" name="price_ad[]" value="<?php echo $pcus_val['price_ad']; ?>" placeholder="Product Name" id="title" autocomplete="off"  class="form-control att_pricea " >
                  </div>
               </div>            
            </div>   
         </div> 
         <?php $i++; } } else{  $att_count=0; } ?>
         <div class="row" id="append_custom">
         </div>        
         <button type="button" id="add_att" class="btn btn-primary">Add</button>
         <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      </div>
    </div>
</div>   
<script type="text/javascript">
      var check_flag=0;
      var count=<?php echo $att_count ?>;
      var limit_flag=<?php echo $limit_flag ?>;
   $(document).on("click","#add_att",function()
   {
      // alert("fasdf");
      var error=1;
      var att_name=$(".att_name").val();   
      var att_priceb=$(".att_priceb").val();   
      var att_pricea=$(".att_pricea").val();
      // alert(att_name);

      if(att_name=='')
      {
         swal("","Plese Enrer name ","warning");
         error=0;
         return false;
      }
      if(att_priceb=='')
      {
         swal("","Plese Enrer price aahrain ","warning");
         error=0;
         return false;
      }
      if(att_pricea=='')
      {
         swal("","Plese Enrer price abu dhabi ","warning");
         error=0;
         return false;
      }  
      if(error==1)
      {         
         count++;
         append='';
         // append+='<div class="row" id="remove'+count+'">';
         append+='<div class="col-sm-4 remove'+count+'"> <label for="category">Name</label> <div class="form-group form-float form-group-lg"> <div class="form-line"> <input type="text" name="name[]"  value="" placeholder="Name" id="title" autocomplete="off" class="form-control att_name space" required> </div> </div> </div> ';

         append+='<div class="col-sm-4 remove'+count+'" > <label for="category">Price Bahrain</label> <div class="form-group form-float form-group-lg"> <div class="form-line"> <input type="text" name="price_bh[]"  value="" placeholder="Price Bahrain" id="title" autocomplete="off" class="form-control att_priceb" onkeypress="return isNumberKey(event)" required> </div> </div> </div> ';

         append+='<div class="col-sm-4 remove'+count+'"> <label for="category">Price Abu Dhabi</label> <span class="remove_att" data-value="jquery" data-id="'+count+'" style="padding: 10px; background-color: #e46767;">Remove</span> <div class="form-group form-float form-group-lg"> <div class="form-line"> <input type="text" name="price_ad[]"  value="" placeholder="Price Abu Dhabi" id="title" autocomplete="off" class="form-control att_pricea" onkeypress="return isNumberKey(event)" required> </div> </div> ';

         // $("#append_custom").after(append);
         // $("#append_custom").prepend(append);
         $("#append_custom").append(append);    

      }else{
         alert("else");
      }
   });
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
               url: "<?php echo base_url('admin/pcustomize/edit2/').$pcustomize_data[0]['id']; ?>",
               data: new FormData(this),
               contentType: false,
               cache: false,
               processData:false,
               success: function(response)
               { 
                  // response);
                  $("#loading").hide();
                  response=response.replace(/\s/g, '')         
                  if(response=='att_error')
                  {
                     swal("","Please Add Attribute","warning");
                  }else if(response=='already')
                  {
                     swal("","Customize title already added","warning");
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
   // $(document).on("click",".remove_att",function(){
   //    id=$(this).attr("data-id"); 
   //    $(".remove"+id).remove();
   // });
</script>

<script type="text/javascript">
  $(document).on('click',".remove_att",function(){
    var pid=$(this).data('id');
    var value=$(this).data('value');

    
    if(pid!='')
    {
      swal({
            title: "",
            text: "Are you sure you want to delete this product!!",
            type:"warning",                                  
            showCancelButton: true,                  
            confirmButtonText: "OK",
            cancelButtonText: "CANCEL",
            closeOnConfirm: true,
            closeOnCancel: true
          },
          function(inputValue){         
            if (inputValue===true) 
            { 
               if(value=='')
               {                  
                 $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url('admin/pcustomize/detete_pcustomize'); ?>',
                    data: {pid:pid},
                    success: function(response)
                    {                               
                     if(response)
                     {
                      swal("","Product Delete successfully",'success');
                         $(".remove"+pid).remove();
                      // setTimeout(function(){ location.reload(); }, 2000);
                     }else {
                      swal("","Some thing want worng!!","warning");
                     }
                    }
                  });
               }else{
                  swal("","Product Delete successfully",'success');
                  $(".remove"+pid).remove();
               }               
            } 
      });
    } else {
      swal("","Some thing want worng!!","warning");
    }
     
  });    
</script>