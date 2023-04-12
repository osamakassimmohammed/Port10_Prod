
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
<!-- <script src='<?php //echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/dataTables.buttons.min.js'></script> -->
<!-- <script src='<?php //echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/buttons.flash.min.js'></script> -->
<!-- <script src='<?php //echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/jszip.min.js'></script> -->
<!-- <script src='<?php //echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/pdfmake.min.js'></script> -->
<!-- <script src='<?php //echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/buttons.html5.min.js'></script> -->
<!-- <script src='<?php //echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/buttons.print.min.js'></script> -->
<div class="form-group">
  <!-- <a href="<?php //echo base_url(); ?>admin/payment/ppd_create" class="btn bg-light-green waves-effect"><span>Create</span></a> -->
</div>
<table class="table table-bordered table-striped table-hover dataTable js-exportable">
<thead>
<tr>
  <th>Id</th>
  <!-- <th>Image</th> -->
  <th>Vat(%)</th>      
  <th>Port10 Fees(%)</th>      
  <th>SAR Rate</th>         
  <th>Action</th>  
  
</tr>
</thead>

<tbody>
<?php

//print_r($list);
  if (!empty($data)){ foreach($data as $row) {?>

<tr>
<td><?php echo $row['id']?></td>
<!-- <td><img height="70px" width="70px" src="<?php // echo base_url('assets/admin/solution/').$row['image']; ?>"> </td> -->
<td><?php echo $row['vat']?></td>
<td><?php echo $row['commission']?></td>
<td><?php echo $row['sar_rate']?></td>
<td>
  <a style="width: 40%" href="<?php echo $edit_link.$row['id']; ?>" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float " role="button"><i class="material-icons">edit</i></a>

   <!-- <a style="width: 40%" href="<?php echo $tedit_link.$row['id']; ?>" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float " role="button"><i class="material-icons">translate</i></a> -->

   <!-- <a href="javascript:void(0)" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float  detete_pro" data-id="16483" role="button" ><i class="material-icons">delete</i></a> -->
</td>
<!-- <td><?php //echo date("d-M-Y", strtotime($row['created_on']) );?></td> -->
</tr>
<?php } } else { ?>
  <tr class="text-center text-danger"><td colspan="5" >No Record Found</td></tr>
<?php } ?>
</tbody>
</table>
<style type="text/css">
  .img_sa{
    width: 100px;
    height: 100px;
  }
</style>
<script type="text/javascript">
  $(function () {    
    $('.js-exportable').DataTable({
        // "searching": false,   // Search Box will Be Disabled
        "ordering": false,    // Ordering (Sorting on Each Column)will Be Disabled
        // "info": true,         // Will show "1 to n of n entries" Text at bottom
        // "lengthChange": false // Will Disabled Record number per page
        dom: 'Bfrtip',
        responsive: true,
        // "paging":   false,         
         "info":     false,
        // "order": [[ 0, "desc" ]],
        // buttons: [
        //     'copy', 'csv', 'excel', 'pdf', 'print'
        // ]
    });
  });
</script> 