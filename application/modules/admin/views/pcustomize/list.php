
<style type="text/css">
input.file {
  border: 1px solid #cdcdcd;
  padding: 7px;
    float: left;
    margin-right: 10px;
}
input.btn.btn-primary.csv_upload {
    padding: 7px;
    width: 100px;
    font-size: 16px;
    background-color: #e91e63!important;
}


form#importFrm{

      width: 50%;
    float: left;
}
 
 .aply_post_btn {
    font-size: 14px;
    background: #e91e63;
    border: 1px solid #095d98;
    color: #fff;
    outline: none;
    /*width: 50%;*/
    float: right;
    padding: 7px;
    transition-duration: 0.2s;
}
</style>


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
<table class="table table-bordered table-striped table-hover dataTable js-exportable">

<thead>
<tr>
  <th>Id</th>
  <th>Title</th>
  <th>Type</th>
  <th>Status</th>  
  <th>pcustomize_attr</th>  
  <th>Actions</th>
</tr>
</thead>

<tbody>
<?php

//print_r($list);
  if (!empty($pcustomize)){ 
    foreach($pcustomize as $row) {?>

<tr>
<td><?php echo $row['id']?></td>
<td><?php echo $row['title']?></td>
<td><?php if($row['type'] == '1'){  echo "Radio";  }  else if($row['type'] == '2'){    echo "Checkbox free";    } else{ echo "Checkbox paid"; } ?></td>
<td><?php if($row['status'] == '1'){  echo "Active";  }  else{    echo "De-active";    } ?></td>
<td><?php if( isset($row['pcustomize_attr']) && !empty($row['pcustomize_attr']) ){
          foreach ($row['pcustomize_attr'] as $pcus_attr_key => $pcus_attr_val) { 
            echo $pcus_attr_val['name'];
            echo "<br>";
          }
}else {
      echo "----";
}   ?></td>

<td>
   <a href="pcustomize/edit/<?php echo $row['id'] ?>" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float " role="button"><i class="material-icons">edit</i></a>
   <a href="javascript:void(0)" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float  detete_pro" data-id="<?php echo $row['id']; ?>" role="button" ><i class="material-icons">delete</i></a>
</td>

</tr>
<?php } } ?>
</tbody>
</table>

<!--<div><?php echo $pagination; ?></div>-->

<style type="text/css">
  .img_sa{
    width: 100px;
    height: 100px;
  }
</style>

<script type="text/javascript">
    $(function () {
    $('.js-basic-example').DataTable({
    responsive: true
    });
    //Exportable table
    $('.js-exportable').DataTable({
    dom: 'Bfrtip',
    order:[[0,"DESC"]],
    responsive: true,
    buttons: [
    'copy', 'csv', 'excel', 'pdf', 'print'
    ]
    });
    });
</script>
<script type="text/javascript">
  $(document).on('click',".detete_pro",function(){
    var pid=$(this).data('id');
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
            if (inputValue===true) {                    
              $.ajax({
              type: 'POST',
              url: '<?php echo base_url('admin/pcustomize/detete_pro') ?>',
              data: {pid:pid},
              success: function(response){                               
               if(response)
               {
                swal("","Product Delete successfully",'success');
                setTimeout(function(){ location.reload(); }, 2000);
               }else {
                swal("","Some thing want worng!!","warning");
               }
              }
        });            
            } 
      });
    } else {
      swal("","Some thing want worng!!","warning");
    }
     
  });
    
</script>
