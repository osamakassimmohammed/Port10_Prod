
<?php //echo "<pre>"; print_r($cate_data); echo "<pre>"; ?>
<div>
  <!-- <button type="button" class="btn btn-success add_services">Add Color</button> -->
  <button type="button" class="btn btn-primary add_about">Add Size</button>
  <!-- <button type="button" class="btn btn-info add_weight">Add Weight</button> -->
</div>

<link href='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.css' rel='stylesheet' media='screen'>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/jquery.dataTables.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/dataTables.buttons.min.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/buttons.flash.min.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/jszip.min.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/pdfmake.min.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/buttons.html5.min.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/buttons.print.min.js'></script>
<div class="form-group">
</div>

<table  class="table table-bordered table-striped table-hover dataTable js-exportable">
<thead>
<tr>
<th>Id</th>
<th>Attribute Item Name</th>
<th>Size</th>
<!-- <th style="width: 50%;">Color</th> -->
<th style="width: 15%;">Actions</th>
</tr>
</thead>

<tbody id="pre">
<?php

//print_r($list);
foreach($cate_data as $row)
{
 ?>

<tr id="remove<?php echo $row['id']; ?>">
<td><?php echo $row['id']?></td>
<td id="<?php echo $row['id']; ?>"><?php echo $row['item_name']?></td>
<td>
  <?php if ($row['a_id']  == '19')
  {
    echo "Color";
  } else if ($row['a_id']  == '21') {
    echo "Weight";
  }
  else{
    echo "Size";
  } ?>
</td>
<!-- <td>
 <?php if ($row['a_id']  == '19')
  { ?>
  <script type="text/javascript">$(document).ready(function(){ options = ['button','navbar','title','toolbar','tooltop','movable','zoomable','rotatable','scalable','transition','fullscreen','keyboard']; $('.images').viewer({url: 'data-original',navbar : false}); });</script>

    <img class="images" src="<?php echo base_url('assets/frontend/images/'); ?><?php echo $row['image']?>" alt="Smiley face" height="50" width="50">
    <h5 id="color<?php echo $row['id']; ?>" style="background-color:<?php echo $row['attribute_code']?>; width: 50px; height: 50px; color: transparent;">Color</h5>

<?php  }  ?>
<?php echo str_replace('#','',$row['attribute_code']) ?>  
</td> -->

<td class="actions" style="width: 8%">
<a data-id="<?php echo $row['id'];?>" class="cat_submit btn bg-light-green btn-circle waves-effect waves-circle waves-float " role="button">
  <i class="material-icons">edit</i>
 </a>

 

 <a data-id="<?php echo $row['id'] ; ?>"  class="btn bg-light-green btn-circle delete-service" style="float: right; color: red;"><i class="material-icons">delete</i></a>

  
</td>

</tr>
<?php } ?>
</tbody>
</table>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" style="display: none;">
    <div class="modal-dialog">
    <!-- <form method="post" action="<?php echo base_url('admin/attribute/add_attributes/');?>"> -->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Size</h4>
        </div>
        <div class="modal-body">

         
          <div class=""> 
            <label>Add Size</label>
            <input type="hidden" class="input_class" id="add_size_id" name="a_id" value="20">
            <input type="text" class="input_class" id="add_size_name" name="item_name" autocomplete="off" required>
          </div>

         
        </div>
        <div class="modal-footer">
         <button type="submit" class="btn btn-success " id="add_size_btn">Submit</button>
        </div>
      </div>
      <!-- </form> -->
    </div>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="myModal1" role="dialog" style="display: none;">
    <div class="modal-dialog">
    <!-- <form method="post" action="<?php //echo base_url('admin/attribute/add_attributes');?>" enctype="multipart/form-data" > -->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Color</h4>
        </div>
        <div class="modal-body">

          <div class=""> 
            <label>Color</label>
            <input type="hidden" class="input_class" id="add_color_id" name="a_id" value="19">
            <input type="text" class="input_class" id="add_color_name" name="item_name" autocomplete="off" required>
          </div>
          
          <div class=""> 
            <label>Select color</label>
            <input type="color" style="height: 40px; padding: 2px;" class="input_class" id="add_color_arrt" name="attribute_code" autocomplete="off" required>
          </div>

          <!-- <div class=""> 
            <label>Image</label>
            <input type="file" class="input_class" id='add_color_image' name="image" >
          </div> -->

        </div>
        <div class="modal-footer">
         <button type="submit" class="btn btn-success" id="add_color_btn">Submit</button>
        </div>
      </div>
      <!-- </form> -->
    </div>
  </div>



<script type="text/javascript">
  $(function () {
    $('.js-basic-example').DataTable({
        responsive: true,
        "order": [[ 0, "desc" ]],
    });

    //Exportable table
    $('.js-exportable').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        "order": [[ 0, "desc" ]],
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
});
</script>
<style type="text/css">
  .card .body .col-xs-6{
    margin-bottom: 0px;
  }
  .modal-header , .modal .modal-footer {
    padding: 15px!important;
    border: 1px solid #e5e5e5!important;
  }

div.dataTables_wrapper div.dataTables_filter {
    text-align: right;
    display: block;
}

</style>


<script type="text/javascript">

   $(".add_about").click(function(){
    $("#myModal").modal('show');
   });
   $(".add_weight").click(function(){
    $("#myModal2").modal('show');
   });

   $(".add_services").click(function(){
    $("#myModal1").modal('show');
   });

</script>

<style type="text/css">
  .input_class
  {
    
    width: 100%;
    padding: 5px;
    border: 1px solid #cdcdcd;
    margin-bottom: 10px;
    margin-top: 0px;

  }
  td .bg-light-green{
    width: 40%;
  }
</style>

<?php if ($this->session->flashdata('add_attribute')): ?> 
  <script> swal(
  { 
    title: "Done", 
    text: "<?php echo $this->session->flashdata('add_attribute'); ?>", 
    timer: 5000, showConfirmButton: true, 
    type: 'success' 
  }); 
  </script> 
<?php endif; ?>


<?php if ($this->session->flashdata('delete_services')): ?> 
  <script> swal(
  { 
    title: "Done", 
    text: "<?php echo $this->session->flashdata('delete_services'); ?>", 
    timer: 5000, showConfirmButton: true, 
    type: 'success' 
  }); 
  </script> 
<?php endif; ?>



<!-- delete functionality using Ajax functionality -->
<script type="text/javascript">
    $(document).on("click",".delete-service",function()
    {
        var id = $(this).data('id');
        delete_requests(id);
    });
    function delete_requests(id)
    {
        swal({
              title: "Are you sure?",
              text: "You want to delete this",
              type: "warning",
              showCancelButton: true,
              closeOnConfirm: false,
              showLoaderOnConfirm: true,
              confirmButtonText: "Yes",
              cancelButtonText: "Cancel",
            },
            function(){
             $.ajax({
                url: "<?php echo base_url('admin/attribute/delete'); ?>",
                type: "POST",
                data: {id:id},
                success:function(response){
                    if (response)
                    {
                         swal({  title: "success!",  text: "Deleted Successfully.",  imageUrl: 'https://qph.fs.quoracdn.net/main-qimg-e1f0859025623850e8dd44300a60a872'});
                         $("#remove"+id).remove();
                    }
                   // setTimeout(function(){ location.reload(); }, 1500);
                }
            });
        });
    }
</script>

<script type="text/javascript">
  $(document).on("click",".cat_submit",function()
    {          
          var id = $(this).attr('data-id');
           //alert (id);

         if(id == '')
         {
          swal('',"Enter");
         }

         else {
               otpt ='';
               $.ajax({
               type: 'POST',
               url: "<?php echo base_url('admin/attribute/insert_cat') ?>",
               data: {id:id},
               success: function(response)
               {
                  // alert ('hh');
                  obj = JSON.parse(response);
                  Object.keys(obj).forEach(function(key)
                  {
                    otpt += '<div class="wid25" id="nav123'+obj[key].id+'">';

                    if (obj[key].a_id == '19')
                    {
                      otpt += '<span class="category-title">Color Name </span> <br>';
                    }                    
                    else
                    {
                      if(obj[key].a_id == '21') {
                        otpt += '<span class="category-title">Weight Name </span> <br>';
                      } else if (obj[key].a_id == '20'){                        
                      otpt += '<span class="category-title">Size Name </span> <br>';
                      }
                      otpt += '<input type="hidden" class="color_name class_id" name="id" value="'+obj[key].id+'">';
                      otpt += '<input type="hidden" class="color_name class_a_id" name="a_id" value="'+obj[key].a_id+'">';
                    }
                    
                    otpt += '<input type="text"  class="color_name class_value" name="item_name" value="'+obj[key].item_name+'">';
                    if (obj[key].a_id == '19')
                    {
                      
                      otpt += '<span class="category-title">Color Code </span> <br>';
                      otpt += '<input type="color" style="height: 40px; padding: 2px;" class="color_name class_attribute_code" name="attribute_code" value="'+obj[key].attribute_code+'">';
                      
                      otpt += '<input type="hidden" class="color_name class_id" name="id" value="'+obj[key].id+'">';
                      otpt += '<input type="hidden" class="color_name class_a_id" name="a_id" value="'+obj[key].a_id+'">';
                      
                      /*otpt += '<input type="hidden" class="color_name" name="id" value="'+obj[key].id+'">';
                      otpt += '<input type="hidden" class="color_name" name="a_id" value="'+obj[key].a_id+'">';
                      otpt += '<span class="category-title">Image </span> <br>';
                      otpt += '<input type="file" class="color_name" name="image" value="">';
                      otpt += '<div class="color-img"><img style="height: 100px" src="<?php echo base_url();?>assets/frontend/images/'+obj[key].image+'" alt="images" class="img-responsive">';*/
                    }
                    

                    otpt += '</div>';
                    otpt += '</div>';
                    console.log(key, obj[key]);
                  });
                  $('#sub_cat_listing').html(otpt);
                  $('#myModal11').modal('show');

               }
              });
           }
      });
</script>

<div class="modal fade "  id="myModal11"  role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <!-- <form method="post" action="<?php //echo base_url('admin/attribute/edit_attributes');?>" enctype="multipart/form-data" > -->
           <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Size</h4>
           </div>
           <div class="clear"></div>
           <div class="modal-body">
              <div class="">
                 <div class="category-item categry_pop_item" id="sub_cat_listing"></div>

                 <div class="serch_pop_btn_wrp" style="clear: both;">
                    <button type="submit" id="search_submit" class="serch_list_btn_a">Update</button>

                 </div>
              </div>
           </div>
         <!-- </form> -->
      </div>
   </div>
</div>
<!-- add weight model start -->
<div class="modal fade" id="myModal2" role="dialog" style="display: none;">
    <div class="modal-dialog">
    <!-- <form method="post" action="<?php //echo base_url('admin/attribute/add_attributes/');?>"> -->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Weight</h4>
        </div>
        <div class="modal-body">

         
          <div class=""> 
            <label>Add weight</label>
            <input type="hidden" class="input_class" id="add_weight_id"  name="a_id" value="21">
            <input type="text" class="input_class" id="add_weight_name" name="item_name" autocomplete="off" required>
          </div>

         
        </div>
        <div class="modal-footer">
         <button type="submit" class="btn btn-success " id="add_weight_btn" >Submit</button>
        </div>
      </div>
      <!-- </form> -->
    </div>
  </div>
<!-- end add weight model  -->

<style type="text/css">
  .color_name{
    width: 100%;
    padding: 7px;
    margin-bottom: 10px;
    margin-top: 5px;
    border-radius: 2px;
    border: 1px solid;
  }
  .color-img{
      width: 50%;
  }
button#search_submit {
    width: 20%;
    margin-top: 10px;
    padding: 5px;
    font-size: 17px;
    overflow: hidden;
    color: pink;
    background: #81699b;
    text-transform: capitalize;
}
</style>
<script type="text/javascript">

    $(document).on("click","#add_size_btn",function()
    {
          //alert();     
      var add_size_id=$("#add_size_id").val();
      var add_size_name=$("#add_size_name").val();
        if(add_size_id!=='' && add_size_name!=='')
        {
          //$('.loading').show();
          $.ajax({
              type: 'POST',
              url: "<?php echo base_url('admin/attribute/add_attributes') ?>",
              data: {a_id:add_size_id,item_name:add_size_name},
              success: function(response){
                var append='';
                var data = $.parseJSON(response);                          
                append='<tr id="remove'+data[0].id +'" role="row" class="even"><td class="sorting_1">'+ data[0].id +'</td><td id="'+data[0].id +'">'+ data[0].item_name +'</td><td>Size</td><td class="actions" style="width: 8%"><a data-id="'+data[0].id +'" class="cat_submit btn bg-light-green btn-circle waves-effect waves-circle waves-float "   role="button"><i class="material-icons">edit</i></a> <a data-id="'+ data[0].id +'"  class="btn bg-light-green btn-circle delete-service" style="float: right; color: red;"><i class="material-icons">delete</i></a></td></tr>';   

                $('#myModal').modal('hide');
                $("#pre").prepend(append);            

                
              }
          });
        }
    }); 

    $(document).on("click","#add_weight_btn",function()
    {
          //alert();     
      var add_weight_id=$("#add_weight_id").val();
      var add_weight_name=$("#add_weight_name").val();
        if(add_weight_id!=='' && add_weight_name!=='')
        {
          //$('.loading').show();
          $.ajax({
              type: 'POST',
              url: "<?php echo base_url('admin/attribute/add_attributes') ?>",
              data: {a_id:add_weight_id,item_name:add_weight_name},
              success: function(response){
               // alert(response)
                var append='';
                var data = $.parseJSON(response);                
                append+='<tr id="remove'+data[0].id +'" role="row" class="even"><td class="sorting_1">'+ data[0].id +'</td>';
                append+='<td id="'+data[0].id +'">'+ data[0].item_name +'</td>';
                append+='<td>Weight</td>';
                append+='<td>'+ data[0].attribute_code +'</td>';
                append+='<td class="actions" style="width: 8%"><a class="cat_submit btn bg-light-green btn-circle waves-effect waves-circle waves-float " data-id="'+data[0].id +'"  role="button"><i class="material-icons">edit</i></a> <a data-id="'+ data[0].id +'"  class="btn bg-light-green btn-circle delete-service" style="float: right; color: red;"><i class="material-icons">delete</i></a></td></tr>';
                
                $('#myModal2').modal('hide');
                $("#pre").prepend(append);  
                
              }
          });
        }else {          
          swal("",'Please Enter Weight');
          return false;          
        }
    });
     
    $(document).on("click","#add_color_btn",function()
    {
               
      var add_color_id=$("#add_color_id").val();
      var add_color_name=$("#add_color_name").val();
      var attribute_code=$("#add_color_arrt").val();
        if(add_color_name!=='' && attribute_code!=='')
        {
          //$('.loading').show();
          $.ajax({
              type: 'POST',
              url: "<?php echo base_url('admin/attribute/add_attributes') ?>",
              data: {a_id:add_color_id,item_name:add_color_name,attribute_code:attribute_code},
              success: function(response){                
                var append='';
                var data = $.parseJSON(response);                
                append+='<tr id="remove'+data[0].id +'" role="row" class="even"><td class="sorting_1">'+ data[0].id +'</td>';
                append+='<td id="'+data[0].id +'">'+ data[0].item_name +'</td>';
                append+='<td>Color</td>';
                append+='<td><h5 id="color'+data[0].id +'" style="background-color:'+ data[0].attribute_code+'; width: 50px; height: 50px; color: transparent;"></h5></td>';
                append+='<td class="actions" style="width: 8%"><a class="cat_submit btn bg-light-green btn-circle waves-effect waves-circle waves-float " data-id="'+data[0].id +'"  role="button"><i class="material-icons">edit</i></a> <a data-id="'+ data[0].id +'"  class="btn bg-light-green btn-circle delete-service" style="float: right; color: red;"><i class="material-icons">delete</i></a></td></tr>';
                $("#myModal1").modal('hide');               
                $("#pre").prepend(append);                  
              }
          });
        }else {          
          swal("",'Please Enter Color Name And Select Color');
        }
    });

    $(document).on("click",".serch_list_btn_a",function()
    {
        var class_id=$(".class_id").val();
        var class_a_id=$(".class_a_id").val();
        var class_value=$(".class_value").val();
        /*var class_value2=class_value;*/
        var class_attribute_code=$(".class_attribute_code").val();
        var class_attribute_code2=class_attribute_code;
       
        if(class_a_id!=='' && class_value !=="" ) {
             $.ajax({
              type: 'POST',
              url: "<?php echo base_url('admin/attribute/edit_attributes') ?>",
              data: {id:class_id,item_name:class_value,attribute_code:class_attribute_code},
              success: function(response){                
                $("#"+class_id).text(class_value);
                if (typeof class_attribute_code === "undefined"){

                } 
                else {                  
                  $("#color"+class_id).css("background-color",class_attribute_code);
                } 
                $("#myModal11").modal('hide');
              }
             }); 
        } else {
          //alert("Please Enter Color value ");
          swal("",'Please Enter Color value');
          return false;
        }
        
    }); 

</script>