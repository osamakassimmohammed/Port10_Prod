<style type="text/css">
  .detete_pro{
    background: #ff375e!important;
  }
  .pro_create {
    background: #23023b;
    padding: 11px 20px;
    border-radius: 16px;
    border-radius: 3px;
    color: white;
    font-size: 17px;
}
  .pro_create:hover {
    text-decoration: none;
    color: white;
  }
</style>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<div class="">  
</div>

<span>
<?php if ($this->session->flashdata('csv_insert')): ?>
  <h2 id="errorMessage" class="text-danger">
    <?php echo $this->session->flashdata('csv_insert'); ?>
  </h2>

  <script type="text/javascript"> 
    $('#errorMessage').delay(4000).fadeOut('slow');
  </script>
<?php endif; ?>

</span>

<!-- <link href='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.css' rel='stylesheet' media='screen'> -->
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/jquery.dataTables.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/dataTables.buttons.min.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/buttons.flash.min.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/jszip.min.js'></script>
<!-- <script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/pdfmake.min.js'></script> -->
<!-- <script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/buttons.html5.min.js'></script> -->
<!-- <script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/buttons.print.min.js'></script> -->
<!-- <div class="form-group"> -->
  <!-- <a style="" href="<?php //echo base_url('admin/product/csv_dwonload/2') ?>" class="btn bg-light-green waves-effect"><span>Download</span></a>  -->
  <!-- 'admin/brand/csv_upload -->
  <!-- <form method="POST" action='' enctype="multipart/form-data">
    <input type="file" name="file">
    <input type="submit" name="" value="upload file">
  </form> -->
<!-- </div> -->
<!-- <div class="row" style="margin-top: 20px;">
  <div class="col-sm-4">
     <form method="post" action="<?php echo base_url($language.'/admin/product/csv_upload'); ?>" enctype="multipart/form-data">
      <label><?php echo lang('select csv file with image name'); ?></label>
      <input type="file" name="file" accept=".csv"/>
      <input type="submit" class="uploada" name="import" class="btn btn-info" value="<?php echo lang('import'); ?>" style="margin-top:9px"/>
     </form>
     <br />
     <br />
  </div>

  <div class="col-sm-4">
     <form method="post" action="<?php echo base_url($language.'/admin/product/upload_multiple_images'); ?>" enctype="multipart/form-data">
      <label><?php echo lang('upload multiple images for catalogue'); ?> </label>
      <input type="file" name="file[]" multiple="" required accept="image/png, image/gif, image/jpeg" />
      <input style="margin: 9px 0px;" type="submit" class="uploada" name="import" class="btn btn-info" value="<?php echo lang('import'); ?>" />
      <a target="_blank" style="display:table-cell" class="btn btn-info" href="product/uploaded_image"><?php echo lang('see your uploaded Image'); ?></a>
     </form>
     <br />
     <br />
  </div>

  <div class="col-sm-4">
      <label><?php echo lang('download sample CSV file to upload product'); ?></label>
      <div>
      <a target="_blank" href="<?php echo base_url('/assets/admin/port10-csv-sample.csv'); ?>" class="a_download">
        <input style="    width: 40%;    margin-top: 1px;" type="submit" class="uploada" name="import" class="btn btn-info" value="<?php echo lang('click to download'); ?>" />
      </a>
     <a target="_blank" href="<?php echo base_url('admin/product/cat_data'); ?>" class="a_download">
        <input style="    width: 50%;    margin-top: 1px;" type="submit" class="uploada" name="import" class="btn btn-info" value="<?php echo lang('click to see category ids'); ?>" />
      </a>
</div> -->
     <br />
  <!-- </div>
</div> -->
<div class="sraech">
  <!-- <label for="usr">Search:</label> -->
  <!-- <input type="text" class="" id="search_val" style="padding: 3px"> -->
  <a class="btn btn-info craete-specing" style="background:#4f0381 !important" href="<?php echo base_url($language.'/admin/catalogue/create') ?>"><?php echo lang('aCreate_Catalogue'); ?></a>
</div>
<table class="table table-bordered table-striped table-hover dataTable js-exportable">
<thead>
    <tr>
        <th><?php echo lang('SN'); ?></th>
        <th><?php echo lang('Name'); ?></th>
        <th><?php echo lang('Supplier_Name'); ?></th>
        <th><?php echo lang('theme'); ?></th>
        <th><?php echo lang('aStatus'); ?></th>
        <th><?php echo lang('aAction'); ?></th>
    </tr>
</thead>
  <!-- <td><?php //echo date("d - M - Y", strtotime($row['created_date']) );?></td> -->
  <!-- <a href="product/tedit/<?php //echo $row['id'] ?>" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float " role="button"><i class="material-icons">translate</i></a> -->
    <tbody id="table_body">      
    <?php
    if(!empty($product)){
    foreach($product as $key => $row)
    { ?>
     <tr>
      <td><?php echo $key+1; ?></td>
      <td><?php echo $row['catalog_name']?></td>
       <td><?php echo $row['first_name']?></td>
       <td><?php echo $row['theme']?></td>
      <td><?php if($row['is_active'] == 1){  echo "Active";  }  else {    echo "De-active"; } ?></td>
      <td>
         <!-- <a href="product/edit/<?php echo $row['id'] ?>" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float fist_a" role="button"><i class="material-icons">edit</i><span class="material_label"><?php echo lang('aEdit'); ?></</span></a>         
         <div class="clear"></div>
         <a style="    background: #44871b !important;" href="product/tedit/<?php echo $row['id'] ?>" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float fist_a" role="button"><i class="material-icons"></i><span class="material_label"><?php echo lang('aTranslate'); ?></span></a>         
         <div class="clear"></div> -->
         <a href="javascript:void(0)" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float  detete_pro second_a" data-id="<?php echo $row['id']; ?>" role="button" ><i class="material-icons"></i><span class="material_label"><?php if($row['is_active'] == 1){  echo "De-Activate";  }  else {    echo "Activate"; } ?></span></a>
      </td>

      </tr>

    <?php } }else{ ?>
      <tr><td colspan="8"><?php echo lang('No_record_found'); ?></td></tr>
    <?php }?>
    </tbody>

</table>
<div id="pagination"><?php echo @$pagination; ?></div>
<div id="pagination2" style="display:none"></div>
<div id="search_pagination" style="display:none"></div>




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
    .body
    {
    overflow: hidden;
    }
    ul.pagination{
    float: right;
    }
    .sraech {
    width: 100%;
    padding: 10px;
    float: right;
    text-align: right;
    padding-right: 0px;
    }
</style>


<script type="text/javascript">
    $(document).on("keyup","#search_val",function(){      
    var serach=$(this).val();  
    $('#loading').show();     
      $.ajax({
           type: 'POST',
           url: "<?php echo base_url("admin/catalogue/list1"); ?>",
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
       url: "<?php echo base_url("admin/catalogue/list1") ?>",
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
           trHTML+='<td>'+v.catalog_name+'</td>';
           trHTML+='<td>'+v.first_name+'</td>';           
           trHTML+='<td>'+v.theme+'</td>'; 
           
          
         
           if(v.is_active=='1')
           {
            status='Active';
           }else{
            status='De-active';
           }       
           trHTML+='<td>'+status+'</td>';               
       
          trHTML+='<td><a href="javascript:void(0)" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float  detete_pro second_a" data-id="'+v.id+'" role="button" ><i class="material-icons"></i><span class="material_label">'+status+'</span></a></td>';     
          
      trHTML+='</tr>';
      flag_row++;                                 
      });  
      return trHTML;    
     }
    }
</script>
<script type="text/javascript">
  $(document).on('click',".detete_pro",function(){
    var pid=$(this).data('id');
    if(pid!='')
    {
      swal({
            title: "",
            text: "<?php echo lang('aAre_you_sure_you_want_to_change_status'); ?>",
            type:"warning",                                  
            showCancelButton: true,                  
            confirmButtonText: "<?php echo lang('OK'); ?>",
            cancelButtonText: "<?php echo lang('Cancel'); ?>",
            closeOnConfirm: true,
            closeOnCancel: true
          },
          function(inputValue){         
            if (inputValue===true) {                    
              $.ajax({
              type: 'POST',
              url: '<?php echo base_url('admin/catalogue/activate_catalog') ?>',
              data: {pid:pid},
              success: function(response){                               
               if(response)
               {
                swal("","<?php echo lang('status_change_successfully'); ?>",'success');
                setTimeout(function(){ location.reload(); }, 2000);
               }else {
                swal("","<?php echo lang('Something'); ?>","warning");
               }
              }
        });            
            } 
      });
    } else {
      swal("","<?php echo lang('Something'); ?>","warning");
    }
     
  });    
</script>
<script type="text/javascript">
   function isUrl(s) {
   var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
   return regexp.test(s);
}
</script>