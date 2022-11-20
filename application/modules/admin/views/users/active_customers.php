
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
  <a style="" href="<?php echo base_url('admin/users/active_cus_csv_dwonload') ?>" class="btn bg-light-green waves-effect"><span>Download</span></a>
</div>
<div class="sraech">
  <label for="usr">Search:</label>
  <input type="text" class="" id="search_val" style="padding: 3px">
  <!-- <button class="btn btn-info" id="search_btn">Search</button> -->
</div>
<table class="table table-bordered table-striped table-hover dataTable js-exportable">
<thead>
<tr>
  <th>SN</th>
  <th>Full Name</th>
  <th>Phone</th>
  <th>Email</th>    
  <th>Order Count</th>    
  <th>Date</th>  
  <th>Action</th>  
  
</tr>
</thead>

<tbody id="table_body">
<?php

//print_r($list);
  if (!empty($users_data)){ foreach($users_data as $key => $row) {?>

<tr>
<td><?php echo $key+1; ?></td>
<td><?php echo $row['first_name'].' '.$row['last_name']?></td>
<td><?php echo $row['phone']?></td>
<td><?php echo $row['email']?></td>
<!-- <td><?php //echo $row['address']?></td> -->
<td><?php echo $row['order_count']?></td>
<td><?php echo $row['created_on'];?></td>
<td>
  <a style="width: auto; padding: 0px 12px;" href="users/order_history/<?php echo $row['id'] ?>" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float " role="button"><i class="material-icons">remove_red_eye</i> <span style="margin-top: 0px; float: right; margin-left: 4px;" >View</span> </a>
</td>
</tr>
<?php } } else { ?>
  <tr class="text-center text-danger"><td colspan="5" >No Record Found</td></tr>
<?php } ?>
</tbody>
</table>
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
        "ordering": false,    // Ordering (Sorting on Each Column)will Be Disabled
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
           url: "<?php echo base_url("admin/users/active_customers"); ?>",
           data: {serach:serach,pagno:'0',ajax:'serach'},   
           dataType: 'json',           
           success: function(response)
           {            
              // alert(response);
              $('#loading').hide();
              var tabledata=response.result; 
              var flag_row=response.row;

              if(tabledata=='')
              {
                $('#table_body').html("<tr><td colspan='11'>No record found</td></tr>");
              }else{
                var trHTML= creatTable(tabledata,flag_row);              
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
       url: "<?php echo base_url("admin/users/active_customers") ?>",
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
           var flag_row=response.row;
            // alert(tabledata);
            var trHTML= creatTable(tabledata,flag_row);              
          $('#table_body').html(trHTML);            
       }
     });
   }
</script>
<script type="text/javascript">
     function creatTable(tabledata,flag_row) {
       flag_row=parseInt(flag_row);
      flag_row=flag_row+1;
      if(tabledata!=''){
        var trHTML='';
       
      $.each(tabledata, function( k, v ) {   
           trHTML+='<tr><td>'+flag_row+'</td>';
           full_name=v.first_name+' '+v.last_name;
           trHTML+='<td>'+full_name+'</td>';
           trHTML+='<td>'+v.phone+'</td>';
           trHTML+='<td>'+v.email+'</td>';
           // trHTML+='<td>'+v.address+'</td>';
           trHTML+='<td>'+v.order_count+'</td>';
           // trHTML+='<td><img class="img_sa" width="100px" height="100px" src="<?php //echo base_url('assets/admin/products/') ?>'+v.product_image+' "></td>';
           // trHTML+='<td>'+v.country_name+'</td>';
           trHTML+='<td>'+v.created_on+'</td>'; 

       
          trHTML+='<td><a href="<?php echo base_url($language);?>/admin/users/order_history/'+v.id+'" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float" role="button"><i class="material-icons">remove_red_eye</i></a></td>';     
          
      trHTML+='</tr>'; 
      flag_row++;                                
      });  
      return trHTML;    
     }
    }
</script>