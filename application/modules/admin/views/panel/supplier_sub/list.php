
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
  .sub_btn{
    background: #4f0381;
    padding: 8px 30px;
    border-radius: 16px;
    border-radius: 100px;
    color: white;
  }
  .sub_btn:hover {
    text-decoration: none;
    color:white;
  }
  .btn_success{    
    text-align: center;    
    border-radius: 10px;    
    background-color: #27C88E;
    border: 1px solid #27C88E;
    padding: 5px 25px 5px 25px;
    color: white;
  }
  .btn_warning{
    text-align: center;    
    border-radius: 10px;    
    background-color: #FFC93E;
    border: 1px solid #FFC93E;
    padding: 5px 25px 5px 25px;
    color: white;
  }
  .btn_danger{
    text-align: center;    
    border-radius: 10px;    
    background-color: #FD5D3A;
    border: 1px solid #FD5D3A;
    padding: 5px 25px 5px 25px;
    color: white;
  }
  .td_center{
    text-align: center;
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

 <!--  <a style="" href="<?php //echo base_url('en/price') ?>" class="btn bg-light-green waves-effect"><span>Purches Plan</span></a> -->
 <?php if(!empty($subq)){ ?>
  <?php if($users_data[0]['subs_status']=='expired'){ ?>
  <span><?php echo lang('aYour_Plan_Status'); ?>:<span class="label label-danger"><?php echo lang('aExpired'); ?></span></span>
  <?php }else if($users_data[0]['subs_status']=='trial'){ ?>
    <span><?php echo lang('aYour_Plan_Status'); ?>:<span class="label label-primary"><?php echo lang('aTrial'); ?></span></span>
  <?php }else{ ?>
    <span><?php echo lang('aYour_Plan_Status'); ?>:<span class="label label-success"><?php echo lang('aActive'); ?></span></span>
  <?php } ?>
<?php } ?>
</div>
<div style="display: none" class="sraech">
  <label for="usr"><?php echo lang('asearch'); ?>:</label>
  <input type="text" class="" id="search_val" style="padding: 3px">
  <!-- <button class="btn btn-info" id="search_btn">Search</button> -->
</div>
<table class="table table-bordered table-striped table-hover dataTable js-exportable">
<thead>
<tr>
  <th><?php echo lang('aAmount'); ?></th>    
  <th><?php echo lang('Payment_Status'); ?></th>    
  <th><?php echo lang('aDate_of_Payment'); ?></th>    
  <th><?php echo lang('aStart_Date'); ?></th>  
  <th><?php echo lang('aEnd_Date'); ?></th>  
  <!-- <th>Error</th>       -->
  
</tr>
</thead>
<!-- <td>
  <a href="users/supplier_detail/<?php //echo $row['id'] ?>" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float " role="button"><i class="material-icons">remove_red_eye</i></a>
</td> -->
<tbody id="table_body">
<?php

//print_r($list);
  if (!empty($trans_data)){ foreach($trans_data as $row) { ?>

<td><?php echo $row['currency'].' '.number_format($row['amount'],2); ?></td> 
<td class="td_center">
  <?php if($row['payment_status']=='')
  { ?>
    <button class="btn_warning" >None</button>
  <?php }else if($row['payment_status']=='paid'){ ?>
    <button class="btn_success" >Paid</button>
  <?php }else{ ?>
    <button class="btn_danger" >Unpaid</button>
  <?php } ?>    
</td>
<td><?php echo $row['created_date'];?></td>
<td><?php echo $row['subs_start_date'];?></td>
<td><?php echo $row['subs_end_date'];?></td>
<!-- <td><?php //echo $row['errorText']?></td> -->

</tr>
<?php } } else { ?>
  <tr class="text-center text-danger"><td colspan="8" ><?php echo lang('No_record_found'); ?></td></tr>
<?php } ?>
</tbody>
</table>
<?php if(!empty($subq)){ ?>
<a class="sub_btn" style="float: right;margin-bottom: 10px;" href="<?php echo base_url($language.'/price') ?>" class="btn bg-light-green waves-effect"><span><?php echo lang('aRenew_Subscription'); ?></span></a>
<?php } ?>
<div id="pagination"><?php echo @$pagination; ?></div>
<div id="pagination2" style="display:none"></div>
<div id="search_pagination" style="display:none"></div>
<style type="text/css">
  .img_sa{
    width: 100px;
    height: 100px;
  }
</style>
<script type="text/javascript">
  $(function () {    
    $('.js-exportable').DataTable({
        "searching": false,   // Search Box will Be Disabled
        // "ordering": false,    // Ordering (Sorting on Each Column)will Be Disabled
        // "info": true,         // Will show "1 to n of n entries" Text at bottom
        // "lengthChange": false // Will Disabled Record number per page
        dom: 'Bfrtip',
        responsive: true,
        "paging":   false,         
         "info":     false,
        "order": [[ 0, "desc" ]]       
    });
  });
</script> 

<script type="text/javascript">
    $(document).on("keyup","#search_val",function(){      
    var serach=$(this).val(); 
    // alert(serach);
    // return false; 
    $('#loading').show();     
      $.ajax({
           type: 'POST',
           url: "<?php echo base_url("admin/panel/supplier_sub"); ?>",
           data: {serach:serach,pagno:'0',ajax:'serach'},   
           dataType: 'json',           
           success: function(response)
           {            
              // alert(response);
              $('#loading').hide();
              var tabledata=response.result; 
              if(tabledata=='')
              {
                $('#table_body').html("<tr><td colspan='11'><?php echo lang('No_record_found'); ?></td></tr>");
              }else{
                var trHTML= creatTable(tabledata);              
                $('#table_body').html(trHTML); 
                if(serach=='')
                {
                  $("#search_pagination").hide(); 
                  $("#pagination").show();
                  $("#pagination2").hide();
                  $('#pagination').html(response.pagination);
                }else{
                  $("#search_pagination").show(); 
                  $("#pagination").hide();
                  $("#pagination2").hide();
                  $('#search_pagination').html(response.pagination);                  
                }
              }             
          }
      });      
  });

</script>
<script type="text/javascript">
  $('#pagination').on('click','a',function(e){
    e.preventDefault();        
    var ajax="call";
    var pageno = $(this).attr('data-ci-pagination-page');   
    if (typeof pageno !== 'undefined'){       
       loadPagination(pageno,ajax);      
    }else{
      swal("","You are already on pageno 1",'warning');
    }    
  });

  $('#pagination2').on('click','a',function(e){
      e.preventDefault();      
      var ajax="call";
      var pageno = $(this).attr('data-ci-pagination-page');  
       if (typeof pageno !== 'undefined')
      {       
       loadPagination(pageno,ajax);
      }else{
        swal("","You are already on pageno 1",'warning');
      }      
       
    });
  $('#search_pagination').on('click','a',function(e){
      e.preventDefault();
      var serach=$("#search_val").val();
      // alert("serach pat");
      var ajax="serach";
      var pageno = $(this).attr('data-ci-pagination-page');    
      if (typeof pageno !== 'undefined')
      {       
       loadPagination(pageno,ajax,serach);
      }else{
        swal("","You are already on pageno 1",'warning');
      }
       
    });

  function loadPagination(pagno,ajax,serach=''){
  // if(pagno==1)
  // {
  //   pagno=0;
  // }      
    $('#loading').show();
     $.ajax({        
       url: "<?php echo base_url("admin/panel/supplier_sub") ?>",
        type: 'post',
        data:{pagno:pagno,ajax:ajax,serach:serach},
       dataType: 'json',       
       success: function(response){  
       $('#loading').hide(); 
       // alert(response);       
        //var response = $.parseJSON(response);         
        if(serach=='')
        {
          $("#pagination").hide();
          $("#pagination2").show();                   
          $('#pagination2').html(response.pagination);            
        }else {
          $("#pagination").hide();
          $("#pagination2").hide();                   
          $("#search_pagination").show();                   
          $('#search_pagination').html(response.pagination);
        }
           var tabledata=response.result;
            // alert(tabledata);
            var trHTML= creatTable(tabledata);              
          $('#table_body').html(trHTML);            
       }
     });
   }
</script>
<script type="text/javascript">
     function creatTable(tabledata) {
      if(tabledata!=''){
        var trHTML='';
       
      $.each(tabledata, function( k, v ) {   
           trHTML+='<tr><td>'+v.id+'</td>';
           full_name=v.first_name+' '+v.last_name;
           trHTML+='<td>'+full_name+'</td>';
           trHTML+='<td>'+v.phone+'</td>';
           trHTML+='<td>'+v.email+'</td>';
           trHTML+='<td>'+v.order_count+'</td>';
           trHTML+='<td>';
           if(v.subs_status=="active")
           {
            trHTML+='<button class="btn btn-info" >Active</button>';
           }else if(v.subs_status=="trial"){
            trHTML+='<button class="btn btn-success" >Trial</button>';
           }else{
            trHTML+='<button class="btn btn-danger" >Expired</button>';
           }
           trHTML+='</td>';
           // trHTML+='<td><img class="img_sa" width="100px" height="100px" src="<?php //echo base_url('assets/admin/products/') ?>'+v.product_image+' "></td>';
           // trHTML+='<td>'+v.country_name+'</td>';
           trHTML+='<td>'+v.created_on+'</td>'; 

       
          trHTML+='<td><a href="<?php echo base_url();?>admin/users/supplier_detail/'+v.id+'" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float" role="button"><i class="material-icons">remove_red_eye</i></a></td>';     
          
      trHTML+='</tr>';                                
      });  
      return trHTML;    
     }
    }
</script>