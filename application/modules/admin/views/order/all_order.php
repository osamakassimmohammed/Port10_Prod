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
</style>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<div class="">  
</div>

<link href='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.css' rel='stylesheet' media='screen'>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/jquery.dataTables.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/dataTables.buttons.min.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/buttons.flash.min.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/jszip.min.js'></script>
<!-- <script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/pdfmake.min.js'></script> -->
<!-- <script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/buttons.html5.min.js'></script> -->
<!-- <script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/buttons.print.min.js'></script> -->
<div style="float: right">
    <label for="usr">Search:</label>
    <input type="text" class="" id="search_val" style="padding: 3px">
    <!-- <button class="btn btn-info" id="search_btn">Search</button> -->
</div>
<table class="table table-bordered table-striped table-hover dataTable js-exportable">
<thead>
    <tr>
        <th>SN</th>
        <th>Transaction Reference</th>
        <th>Customer name</th>
        <th>Order datetime </th>
        <th>Net total</th>
        <th>Payment status</th>
        <th>Payment Mode</th>
        <th>Order status</th>                       
        <th>Action</th>
    </tr>
</thead>

    <tbody id="table_body">      
    <?php
    if(!empty($orders)){
    foreach($orders as $key => $value)
    {      
      $currency = 'AED'; ?>
        <tr>
            <td><?php echo @$value['order_master_id']; ?></td>
            
            <td><?php echo @$value['display_order_id']; ?></td>           
            <td><?php echo @$value['first_name'].' '.@$value['last_name']; ?></td>           
            
            <td><?php $now = date('M-d-Y' ,strtotime($value['order_datetime'])); echo $now;  ?></td>             
            <td><?php echo $currency; echo " "; echo @$value['net_total']-$value['coupon_price']; ?></td>           
            <td><?php echo @$value['payment_status']; ?></td>           
            <td><?php echo @$value['payment_mode']; ?></td>           
            <td><?php echo @$value['order_status']; ?></td>           
            <td style="width: 10%">
                <a href="orders/view/<?php echo @$value['order_master_id'] ?>"   class="width100 btn bg-light-green btn-circle waves-effect waves-circle waves-float fist_a" role="button"><i class="material-icons">remove_red_eye</i></a>
                <a href="invoice/pdf/<?php echo @$value['order_master_id'] ?>"  class="width100 btn bg-light-green btn-circle waves-effect waves-circle waves-float second_a" role="button"><i class="material-icons">save_alt</i></a>
                <a href="print_file/view/<?php echo @$value['order_master_id'] ?>" class="width100 btn bg-light-green btn-circle waves-effect waves-circle waves-float third_a" role="button"><i class="material-icons">print</i></a>
            </td>
        </tr>

    <?php } }else{ ?>
      <tr><td colspan="8">No Record found</td></tr>
    <?php }?>
    </tbody>

</table>
<div id="pagination"><?php echo @$pagination; ?></div>
<div id="pagination2" style="display:none"></div>
<div id="search_pagination" style="display:none"></div>

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
    $(document).on("keyup","#search_val",function(){      
    var serach=$(this).val();  
    $('#loading').show();     
      $.ajax({
           type: 'POST',
           url: "<?php echo base_url("admin/orders/index"); ?>",
           data: {serach:serach,pagno:'0',ajax:'serach'},   
           dataType: 'json',           
           success: function(response)
           {            
              // alert(response);
              $('#loading').hide();
              var tabledata=response.result; 
              if(tabledata=='')
              {
                $('#table_body').html("<tr><td colspan='11'>No record found</td></tr>");
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
       url: "<?php echo base_url("admin/orders/all_order") ?>",
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
        var total=parseFloat(v.net_total+v.coupon_price);
        var full_name=v.first_name+' '+v.last_name;
           trHTML+='<tr><td>'+v.order_master_id+'</td>';
           trHTML+='<td>'+v.display_order_id+'</td>';
           trHTML+='<td>'+full_name+'</td>';
           trHTML+='<td>'+v.order_datetime+'</td>';
            currency='AED';           
           trHTML+='<td>'+currency+' '+total+'</td>';
           trHTML+='<td>'+v.payment_status+'</td>';
           trHTML+='<td>'+v.payment_mode+'</td>';           
           trHTML+='<td>'+v.order_status+'</td>';                
       
           trHTML+='<td style="width:10%"><a href="<?php echo base_url();?>admin/orders/view/'+v.order_master_id+'" class="width100 btn bg-light-green btn-circle waves-effect waves-circle waves-float fist_a" role="button"><i class="material-icons">remove_red_eye</i></a>';

            trHTML+='<a href="<?php echo base_url();?>admin/invoice/pdf/'+v.order_master_id+'" class="width100 btn bg-light-green btn-circle waves-effect waves-circle waves-float second_a" role="button"><i class="material-icons">save_alt</i></a>';  

            trHTML+='<a href="<?php echo base_url();?>admin/print_file/view/'+v.order_master_id+'" class="width100 btn bg-light-green btn-circle waves-effect waves-circle waves-float third_a" role="button"><i class="material-icons">remove_red_eye</i></a> </td>';  
      trHTML+='</tr>';                                
      });  
      return trHTML;    
     }
    }
</script>
