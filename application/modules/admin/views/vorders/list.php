<style type="text/css">
  .status_active{
    background-color: #6CC8C3 !important;
  }

  table.table-bordered.dataTable tbody th, table.table-bordered.dataTable tbody td {
    border-bottom-width: 0;
    border-color: #ececec !important;
}


table.table.table-striped {
    display: table;
    border: 1px solid #ececec;
    border-collapse: inherit;
    border-radius: 10px;
    overflow: hidden;
}

.vorder_search, .brand_search {
    width: 100%;
    border-radius: 10px;
    border: 1px solid #b8babb;
    padding-left: 30px!important;
    border-radius: 100px;
}
.row.middle_divv {
    width: 100%;
    margin: 0px auto;
    margin-bottom: 20px;
}

</style>
<script type="text/javascript">
  var gorder_status='all';
</script>
<div class="row middle_divv">
    <div class="div1_vorder">
        <button class="btn_vodere status_active" data-id="all"><?php echo lang('aAll'); ?></button>
    </div>
    <div class="div1_vorder">
        <button class="btn_vodere" data-id="new"><?php echo lang('aNew'); ?></button>
    </div>
    <div class="div1_vorder">
        <button class="btn_vodere" data-id="Pending"><?php echo lang('aPending'); ?></button>
    </div>
    <div class="div1_vorder">
        <button class="btn_vodere" data-id="canceled"><?php echo lang('aCancelled'); ?></button>
    </div>
    <div class="div1_vorder">
        <button class="btn_vodere" data-id="Delivered"><?php echo lang('aCompleted'); ?></button>
    </div>
</div>


<style type="text/css">
    #loading {
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    position: fixed;
    display: block;
    opacity: 0.7;
    background-color: #fff;
    z-index: 99;
    text-align: center;
    }

    #loading-image {
    position: absolute;
    top: 250px;
    left: 630px;
    z-index: 100;
    }
    .header {
    display: none;
    }
    ::-webkit-input-placeholder { /* Edge */
  color: #333;
}
.search-position{
  display:flex;
  justify-content:end
}
</style>


<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link href='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.css' rel='stylesheet' media='screen'>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/jquery.dataTables.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.js'></script>


<div class="row">
    <div class="col-sm-8">
        <form id="vexcel_form" method="POST" action="<?php echo base_url($language.'/admin/vorders/bank_excel') ?>">
            <label class="bstart_date"><?php echo lang('aStart_Date'); ?>:</label>
            <input class="vs_date" type="" id="bstart_date" name="start_date" placeholder="<?php echo lang('aSelect_Start_Date'); ?>" type="text" value=""  autocomplete="off">
            <label class="bend_date"><?php echo lang('aEnd_Date'); ?>:</label>
            <input class="ve_date" type="" id="bend_date" name="end_date" placeholder="<?php echo lang('aSelect_End_Date'); ?>" type="text" value=""  autocomplete="off">
            <button type="submit" class="vorder_excel" style="margin-top: 0px;margin-right: 20px" ><?php echo lang('aExcel'); ?></button>
        </form>
    </div>
    
    <!-- <div class="col-sm-4">
        <i class="search_material material-icons"><?php echo lang('asearch'); ?></i>
        <input type="text" class="vorder_search" id="search_val" style="padding: 3px">
    </div> -->
    <div class="col-sm-4 d-flex justify-content-end">
    <div class="search-position">
      <div>
      <label for="usr"><?php echo lang('asearch'); ?>:</label>
      <input type="text" placeholder="<?php echo lang('aOrderId/customer_Info'); ?>" class="" id="search_val" style="padding: 3px">
  <!-- <button class="btn btn-info" id="search_btn">Search</button> -->
</div>
</div>
</div>
</div>

<table class="table table-bordered table-striped table-hover dataTable js-exportable">
<thead>
    <tr>
        <th><?php echo lang('SN'); ?></th>
        <th><?php echo lang('aDisplay_Order_Id'); ?></th>
        <th><?php echo lang('aCustomer_Info'); ?></th>
        <th><?php echo lang('aOrder_date'); ?> </th>
        <th><?php echo lang('aNet_total'); ?></th>
        <th><?php echo lang('aPayment_status'); ?></th>        
        <th><?php echo lang('aOrder_status'); ?></th>
        <th><?php echo lang('aAction'); ?></th>
    </tr>
</thead>

    <tbody id="table_body">      
    <?php
    if(!empty($orders)){
    foreach($orders as $key => $value)
    { 
        $currency = $value['currency'];
            ?>
        <tr>
            <td><?php echo $key+1; ?></td>            
            <td><?php echo @$value['display_order_id']; ?></td>   
            <td><?php echo @$value['first_name'].' '.@$value['last_name']; ?><br><?php echo $value['mobile_no']; ?><br><?php echo $value['email']; ?></td>          
            
            <td><?php $now = date('M-d-Y' ,strtotime($value['order_datetime'])); echo $now;  ?></td>             
            <!-- <td><?php //echo $currency; echo " "; echo @$value['net_total']-$value['coupon_price']; ?></td> -->
            <td><?php echo $currency; echo " "; echo @$value['in_sub_total']; ?></td>           
            <td>
                <span class="vorder_<?php echo @$value['payment_status']; ?>"><?php 
                $language= $this->uri->segment(1);
                  if(@$value['payment_status'] == 'Pending'){
                      echo lang('Pending');
                    } else if(@$value['payment_status'] == 'Canceled'){
                      echo lang('Canceled');
                    } else if(@$value['payment_status'] == 'Delivered'){
                      echo lang('Delivered');
                    } else if(@$value['payment_status'] == 'Completed'){
                      echo lang('Completed');   
                    }    
  ?></span>   
            </td>
            <td>
                <span class="vorder_<?php echo @$value['order_status']; ?>"><?php 
                $language= $this->uri->segment(1);
                  if(@$value['order_status'] == 'Pending'){
                      echo lang('Pending');
                    } else if(@$value['order_status'] == 'Canceled'){
                      echo lang('Canceled');
                    } else if(@$value['order_status'] == 'Delivered'){
                      echo lang('Delivered');
                    } else if(@$value['order_status'] == 'Completed'){
                      echo lang('Completed');   
                    }    
  ?></span>
            </td>
               
            <td style="width: 10%">
                <a href="vorders/view/<?php echo @$value['order_no'] ?>"   class="width100 btn bg-light-green btn-circle waves-effect waves-circle waves-float fist_a" role="button"><i class="material-icons">remove_red_eye</i> <span class="material_label"><?php echo lang('aView'); ?></span></a>
                <div class="clear"></div>
                <a href="invoice/order_invoice/<?php echo @$value['order_no'] ?>/order"  class="width100 btn bg-light-green btn-circle waves-effect waves-circle waves-float second_a" role="button"><i class="material-icons">save_alt</i> <span class="material_label"><?php echo lang('aInvoice'); ?></span></a>
                <!-- <a target="_blank" href="print_file/view/<?php echo @$value['order_no'] ?>" class="width100 btn bg-light-green btn-circle waves-effect waves-circle waves-float third_a" role="button"><i class="material-icons">print</i></a> -->
            </td>
        </tr>

    <?php } }else{ ?>
      <tr><td colspan="8"><?php echo lang('No_record_found'); ?></td></tr>
    <?php }?>
    </tbody>

</table>
<div id="pagination"><?php echo @$pagination; ?></div>
<div id="pagination2" style="display:none;float: right;"></div>
<div id="search_pagination" style="display:none;float: right;"></div>

<div id="loading" style="display: none">
  <img id="loading-image" src="<?php echo base_url('assets/admin/images/loader.gif') ?>" alt="Loading..." />
</div>


<!-- <script type="text/javascript">
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
</script> -->


<style type="text/css">
  .card .body .col-xs-6{
    margin-bottom: 0px;
  }

  .dataTables_wrapper .dt-buttons{
    display: block;
  }
</style>
<script type="text/javascript">
  $(document).on("click",".btn_vodere",function(){
     var order_status=$(this).data('id');     
     $('.btn_vodere').removeClass('status_active');
     $(this).addClass('status_active');
      gorder_status=order_status;
      var ajax="call";
      var pageno = 0;       
       // alert(pageno);
       loadPagination(pageno,ajax);           
  });

    $(document).on("keyup","#search_val",function(){      
    var serach=$(this).val();  
    $('#loading').show();     
      $.ajax({
           type: 'POST',
           url: "<?php echo base_url("admin/vorders/index"); ?>",
           data: {serach:serach,pagno:'0',ajax:'serach',"order_status":gorder_status},   
           dataType: 'json',           
           success: function(response)
           {            
              // alert(response);
              $('#loading').hide();
              var tabledata=response.result;
              var flag_row=response.row; 
              if(tabledata=='')
              {
                $('#table_body').html("<tr><td colspan='11'><?php echo lang('No_record_found'); ?></td></tr>");
                $("#pagination").hide();
                $("#pagination2").hide();
                $('#search_pagination').hide();
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
       // alert(pageno);
       loadPagination(pageno,ajax);
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
       url: "<?php echo base_url("admin/vorders/index") ?>",
        type: 'post',
        data:{pagno:pagno,ajax:ajax,serach:serach,"order_status":gorder_status},
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
      if(tabledata!='')
      {
        var trHTML='';
       
      $.each(tabledata, function( k, v ) { 
      // var total=parseFloat(v.net_total+v.coupon_price); 
      var full_name=v.first_name+' '+v.last_name;  
           trHTML+='<tr><td>'+flag_row+'</td>';
           trHTML+='<td>'+v.display_order_id+'</td>';
           trHTML+='<td>'+full_name+'<br>'+v.mobile_no+'<br>'+v.email+'</td>';
           trHTML+='<td>'+v.order_datetime+'</td>';          
           trHTML+='<td>'+v.currency+' '+v.in_sub_total+'</td>';
           trHTML+='<td><span class="vorder_'+v.payment_status+'" >'+v.payment_status+'</span></td>';
           trHTML+='<td><span class="vorder_'+v.order_status+'" >'+v.order_status+'</span></td>';           
           // trHTML+='<td>'+v.order_status+'</td>';
               
       
          trHTML+='<td style="width:10%"><a href="<?php echo base_url($language);?>/admin/vorders/view/'+v.order_no+'" class="width100 btn bg-light-green btn-circle waves-effect waves-circle waves-float fist_a" role="button"><i class="material-icons">remove_red_eye</i><span class="material_label"><?php echo lang('aView'); ?></span> </a>';

          trHTML+='<a href="<?php echo base_url($language);?>/admin/invoice/order_invoice/'+v.order_no+'/order" class="width100 btn bg-light-green btn-circle waves-effect waves-circle waves-float second_a" role="button"><i class="material-icons">save_alt</i><span class="material_label"><?php echo lang('aInvoice'); ?></span></a>';  

          // trHTML+='<a href="<?php echo base_url();?>admin/print_file/view/'+v.order_no+'" class="width100 btn bg-light-green btn-circle waves-effect waves-circle waves-float third_a" role="button"><i class="material-icons">print</i></a> </td>';  
      trHTML+='</tr>'; 
      flag_row++;                               
      });  
      return trHTML;    
     }else{
      var trHTML='';
      trHTML+='<tr><td>Reord Not found</td></tr>';
      return trHTML;   
     }
    }
</script>

<script type="text/javascript">
  $(function () {    
    $('.js-exportable2').DataTable({
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

    $( "#bstart_date" ).datepicker({
      changeMonth: true,
      changeYear: true,
      maxDate: 0,
      yearRange: '2021:' + new Date().getFullYear().toString(),
       dateFormat: 'dd-mm-yy'
    });

    $( "#bend_date" ).datepicker({
      changeMonth: true,
      changeYear: true,
      maxDate: 0,
      yearRange: '2021:' + new Date().getFullYear().toString(),
       dateFormat: 'dd-mm-yy'
    });
  });
</script> 

<script type="text/javascript">
 $(document).on("submit","#vexcel_form",function(e)
 {
    // e.preventDefault();  
    var bstart_date=$.trim($("#bstart_date").val()); 
    var bend_date=$.trim($("#bend_date").val()); 
    var error=1;
    if(bstart_date=="")
    {
        error==0;
        swal("","<?php echo lang('aStart_Date'); ?>","warning");
        return false;
    }

    if(bend_date=="")
    {
        error==0;
        swal("","<?php echo lang('aSelect_End_Date'); ?>","warning");
        return false;
    }

    var dateOne = new Date(bstart_date);
    var dateTwo  = new Date(bend_date);
    if (dateOne >= dateTwo) 
    {    
      error==0;
      swal("","<?php echo lang('aEnd_Date_Should'); ?>","warning");
      return false;    
    } 
}); 

 <?php if ($this->session->flashdata('error')): ?>
  swal("","<?php echo $this->session->flashdata('error'); ?>","warning");
 <?php endif; ?> 

  <?php if ($this->session->flashdata('success')): ?>
  swal("","<?php echo $this->session->flashdata('success'); ?>","success");
 <?php endif; ?> 
</script> 
