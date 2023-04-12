<div class="col-md-12" style="float: right;    margin-bottom: 0px;    height: 10px; margin-top: -10px;">
      <a href="<?php echo base_url($language) ?>/admin/vorders" class="back_button"><?php echo lang('aBack_To_List'); ?></a>
</div>

<br>
<?php if ($this->session->flashdata('select_admin')): ?>
<script>
    swal({
        title: "Warning",
        text: "Please select Partner to assign order",
        timer: 3000,
        showConfirmButton: true,
        type: 'error'
    });
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('success')): ?>
<script>
    swal({
        title: "Success",
        text: "Order assign to partner successfully",
        timer: 3000,
        showConfirmButton: true,
        type: 'success'
    });
</script>
<?php endif; ?>
<style type="text/css">
    input#d_date {
    width: 100%;
    padding: 8px;
    }

    .table-bordered tbody tr td, .table-bordered tbody tr th {
    padding: 10px;
    border: none;
    border-bottom: 1px solid #cdcdcd;
    }

    .table-bordered {
    border: none;
    }
    .panel.panel-default {
    border: none;
    background: transparent;
    }
    .panel-footer {
    background: transparent;
    border: navajowhite;
    font-size: 18px;
    }
    .panel-body {
    box-shadow: 2px 1px 8px;
    border-radius: 10px;
    }
    .chosen-container-single .chosen-single
    {
    background: transparent!important;
    }
    table.table.table-striped {
    border: 1px solid #8e9aa0!important;
    }
    input.btn.btn-success.pull-right {
    background: #4f0381!important;
    width: 25%;
    padding: 9px;
    border-radius: 15px;
    }
</style>


<?php
if(!empty($data)) {
// $order_status=$data['order_status'];
$order_status=$invoice_data[0]['order_status'];
$payment_status=$data[0]['payment_status'];
$payment_mode=$data[0]['payment_mode'];
$order_comment=$data[0]['order_comment'];
$currency = $data[0]['currency'];
?>


<!-- <div style="text-align: right;">
    <a class="service-image" href="<?php echo base_url('admin/orders/list');?>"> <button type="submit" class="btn btn-success">Back to list </button>    </a>
</div> -->



<div class="x_content row">
  <?php if (!empty($msg)) { ?>
         <div class="alert <?php echo $msg['response']; ?>">
            <p><?php echo $msg['msg']; ?></p>
         </div>
         <?php } ?>
  <p class="text-muted font-13 m-b-30"></p>
  <div class="col-md-6">
    <div class="panel panel-default ">
      <div class="panel-footer"><?php echo lang('aOrder_Details'); ?></div>
      <div class="panel-body">
        <table class="table table-bordered">
          <tbody>
           <?php if (!empty($data)) {
           ?>
            <tr>
              <th><?php echo lang('aOrder_No'); ?></th>
              <td><?php echo $data[0]['display_order_id'];?></td>
            </tr>

            <tr>
              <th><?php echo lang('aOrder_date'); ?></th>
              <td><?php echo  date('M-d-Y' ,strtotime($data[0]['order_datetime']));  ?></td>
            </tr>

            <tr>
              <th><?php echo lang('aPayment_Mode'); ?></th>
              <td><?php if($data[0]['payment_mode']=='cash-on-del'){
                echo lang('Virtual_Account_Transfer');
              }else{
               echo  lang('Card');
              }?></td>
            </tr>

            <tr>
              <th><?php echo lang('aOrder_status'); ?>:</th>
              <td><?php echo $data[0]['order_status'];?></td>
            </tr>            
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
   <div class="col-md-6">
    <div class="panel panel-default ">
      <div class="panel-footer"><?php echo lang('aUser_Details'); ?></div>
      <div class="panel-body">
        <table class="table table-bordered">
          <tbody>
           <?php if (!empty($user_detail)) {
           ?>
            <tr>
              <th><?php echo lang('aEstablishment_Name'); ?></th>
              <td><?php echo $user_detail[0]['first_name'];?></td>
            </tr>
            <tr>
              <th><?php echo lang('Email'); ?></th>
              <td><?php echo $user_detail[0]['username'];?></td>
            </tr>
            <tr>
              <th><?php echo lang('aMobile_No'); ?></th>
              <td><?php echo $user_detail[0]['phone'];?></td>
            </tr>            
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>  
</div>

<div class="x_content row">
  <p class="text-muted font-13 m-b-30"></p>
  <div class="col-md-6">
    <div class="panel panel-default ">
      <div class="panel-footer"><?php echo lang('aShipping_Details'); ?></div>
        <div class="panel-body">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th><?php echo lang('Name'); ?></th>
                        <td><?php echo $data[0]['first_name'].' '.$data[0]['last_name']; ?>     </td>
                    </tr>
                    <tr>
                        <th><?php echo lang('Email'); ?></th>
                        <td><?php echo $data[0]['email']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo lang('aMobile'); ?></th>
                        <td><?php echo $data[0]['mobile_no']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo lang('Country'); ?>:</th>
                        <td><?php echo $data[0]['country']; ?>  </td>
                    </tr>
                    <tr>
                        <th><?php echo lang('State'); ?>:</th>
                        <td><?php echo $data[0]['state']; ?>  </td>
                    </tr>
                    <tr>
                        <th><?php echo lang('aPincode'); ?>:</th>
                        <td><?php echo $data[0]['pincode']; ?>  </td>
                    </tr>
                    <tr>
                        <th><?php echo lang('Address'); ?>:</th>
                        <td><?php echo $data[0]['address_1'].' '.$data[0]['address_2']; ?>  </td>
                    </tr>
                </tbody>
            </table>
        </div>        
    </div>
        <?php if($data[0]['payment_mode']=='online') { ?>
        <div class="panel panel-default ">
          <div class="panel-footer"><?php echo lang('aPayment_Details'); ?></div>
            <div class="panel-body">              
              <div class="row">
               <div class="col-sm-4 orderfiled_name">
                  <?php echo lang('Transaction_ID'); ?>   : 
               </div>
               <div class="col-sm-8 orderfiled_content">
                  <?php echo @$trans_history[0]['track_id']; ?>                          
                </div>
              </div>              
              <div class="row">
               <div class="col-sm-4 orderfiled_name">
                  <?php echo lang('Message'); ?>   : 
               </div>
               <div class="col-sm-8 orderfiled_content">
                  <?php echo @$trans_history[0]['errorText']; ?>                          
                </div>
              </div>
            </div>
          </div>
        <?php } ?>       

  </div>

  <div class="col-md-6" style="">
       <div class="panel panel-default " >
        <form  action="" method="POST">
          <div class="panel-footer"><?php echo lang('aUpdate_Order'); ?></div>
          <div class="panel-body">
             <div class="form-group">
                <label class="control-label col-sm-5 "> <?php echo lang('aOrder_date'); ?> :
                </label>
                <div class="col-sm-7" style="padding-top: 7px;">
                   <?php echo date("D d F Y, H:i",strtotime($data[0]['order_datetime'])); ?>
                </div>
             </div>
             <hr>
           <!--   <div class="form-group">
                <label class="control-label col-sm-5 ">Estimate Delivery Date :
                </label>
                <div class="col-sm-7" style="padding-top: 7px;">
                   <input class="ha-input1" type="text" id="d_date" value="<?php //echo $data[0]['delivery_date']; ?>" class="form-control" name="delivery_date" placeholder="Order Date"required>
                </div>
             </div> -->
             <div class="form-group">
                <label for="" class="col-sm-5 control-label"><?php echo lang('aOrder_status'); ?> :</label>
                <div class="col-sm-7">
                   <?php // echo $order_status; ?>
                   <select  class="form-control"  name="order_status" >
                      <option value="" disabled="">Select Order Status :</option>
                      <?php  if( isset($order_status) && $order_status == "Pending" ) { ?>
                      <option value="Pending" <?php if( isset($order_status) && $order_status == "Pending" ) echo "Selected"; ?> ><?php echo lang('aPending'); ?></option>
                      <!-- <option value="Dispatched">Dispatched</option> -->
                      <option value="Delivered"><?php echo lang('aCompleted'); ?></option>
                      <option value="canceled"><?php echo lang('aCancelled'); ?></option>
                      <?php }else if(isset($order_status) && $order_status == "Dispatched") { ?>
                        <option value="Dispatched" <?php if( isset($order_status) && $order_status == "Dispatched" ) echo "Selected"; ?> >Dispatched</option>
                        <option value="Delivered"><?php echo lang('aCompleted'); ?></option>
                        <option value="canceled"><?php echo lang('aCompleted'); ?></option>
                      <?php }else if(isset($order_status) && $order_status == "Delivered"){ ?>
                        <option value="Delivered" <?php if( isset($order_status) && $order_status == "Delivered" ) echo "Selected"; ?> ><?php echo lang('aCompleted'); ?></option>
                      <?php }else if(isset($order_status) && $order_status == "canceled"){ ?>
                       <option value="canceled" <?php if( isset($order_status) && $order_status == "canceled" ) echo "Selected"; ?> ><?php echo lang('aCancelled'); ?></option> 
                      <?php }  ?>
                   </select>
                </div>
             </div>
             
             <div class="form-group">
                <label  class="col-sm-5 control-label"><?php echo lang('aPayment_Mode'); ?> :</label>
                <div class="col-sm-7" style="padding-top: 6px;">
                   <?php if($data[0]['payment_mode']=='cash-on-del'){
                      echo lang('Virtual_Account_Transfer');
                    }else{
                     echo  lang('Card');
                    } ?>
                   <input type="hidden" name="payment_mode" value="<?php echo $payment_mode; ?>">
                </div>
             </div>
            <!--  <div class="form-group">
                <label for="" class="col-sm-5 control-label">Order comment :</label>
                <div class="col-sm-7">
                   <textarea name="order_comment" class="textarea"><?php //echo $order_comment; ?></textarea>
                </div>
             </div> -->
             <div class="form-group" style="margin-top: 10px;">
                <div class="col-sm-12">
                   <input type="submit" value="<?php  echo lang('Update'); ?>" <?php if( isset($order_status) && $order_status == "canceled" ) { ?> disabled <?php } ?> name="submit" class="btn btn-success pull-right">
                </div>
             </div>
          </div>
        </form>
       </div>
  </div>
</div>
    <!-- <div class="x_content row">
      <div class="col-md-6" style="">
           <div class="panel panel-default " >
            <form id="create_pickup_form"  action="" method="POST">
              <div class="panel-footer"><?php echo lang('aUpdate_Order'); ?></div>
              <div class="panel-body">                 
                 <hr> -->
                <!-- <div class="form-group">
                    <label for="PickupDate" class="col-sm-5 control-label">Pickup Date :</label>
                    <div class="col-sm-7">
                       <input type="text" name="PickupDate" id="PickupDate">
                    </div>
                </div> 
                <div class="form-group">
                    <label for="ReadyTime" class="col-sm-5 control-label">Ready Time :</label>
                    <div class="col-sm-7">
                       <input type="text" name="ReadyTime" id="ReadyTime">
                    </div>
                </div>
                <div class="form-group">
                    <label for="LastPickupTime" class="col-sm-5 control-label">Last Pickup Time :</label>
                    <div class="col-sm-7">
                       <input type="text" name="LastPickupTime" id="LastPickupTime">
                    </div>
                </div> 
                <div class="form-group">
                    <label for="ClosingTime" class="col-sm-5 control-label">ClosingTime :</label>
                    <div class="col-sm-7">
                       <input type="text" name="ClosingTime" id="ClosingTime">
                    </div>
                </div> --> 
                <!-- <div class="form-group">
                    <label for="ShippingDateTime" class="col-sm-5 control-label">Shipping Date Time :</label>
                    <div class="col-sm-7">
                       <input type="text" name="ShippingDateTime" id="ShippingDateTime" value="<?Php echo $invoice_data[0]['shipping_date_time']; ?>">
                    </div>
                </div> 
                <div class="form-group">
                    <label for="DueDate" class="col-sm-5 control-label">Due Date :</label>
                    <div class="col-sm-7">
                       <input type="text" name="DueDate" id="DueDate" value="<?Php echo $invoice_data[0]['shipping_dub_date']; ?>">
                    </div>
                </div> 
                <div class="form-group">
                    <label for="DueDate" class="col-sm-5 control-label">Shipping Id :</label>
                    <div class="col-sm-7" id="shipping_id">
                       <?Php echo $invoice_data[0]['shipping_id']; ?>
                    </div>
                </div> 
                 <div class="form-group" style="margin-top: 10px;">
                    <div class="col-sm-12">
                       <input type="submit" value="Create Shipments" name="submit" class="btn btn-success pull-right">
                    </div>
                 </div>
              </div>
            </form>
           </div>
      </div> 
    </div> -->

        


<?php  if(!empty($data_items)) { ?>
<div class="x_content row">
  <div class="col-md-12">
         <div class="panel panel-default">
            <!-- <div class="panel-footer">Product Details</div> -->
            <div class="">
               <table id="datatable-checkbox mytable" class="table table-striped table-bordered bulk_action" style="border-bottom: 0px;border-left: 0px;  border-right: 0px;">
                  <thead>
                     <tr>
                        <th><?php echo lang('aSr_No'); ?></th>
                        <th><?php echo lang('aImage'); ?></th>
                        <th><?php echo lang('product_name'); ?></th>
                        <th><?php echo lang('Unit'); ?></th>
                        <!-- <th>Product Customize</th> -->
                        <th><?php echo lang('aPro_Ref'); ?></th>
                        <th><?php echo lang('quantity'); ?></th>                        
                        <th><?php echo lang('Price'); ?></th>
                        <th><?php echo lang('Sub_total'); ?></th>                        
                     </tr>
                  </thead>
                  <tbody>
                     <?php 
                        $i=1;
                      foreach ($data_items as $di_key => $di_value) { ?>            
                     <tr>
                        <td ><?php echo $i; ?></td>
                        <td >
                          <?php  
                           
                            $product_image=explode("/",$di_value['pro_image']);
                            $product_image=count($product_image);
                            if ($product_image==1) 
                            {
                             $image_url=base_url("assets/admin/products/").$di_value['pro_image'];
                            }else{
                             $image_url=$di_value['pro_image'];  
                            }
                          ?>
                          <img width="70px" height="70px" src="<?php echo $image_url; ?>">
                        </td>
                        <td ><?php echo $di_value['product_name']; ?></td>
                        <td ><?php echo @$di_value['unit_name']; ?></td>
                       
                        <!-- <td ><?php //echo ($di_value['product_comment']!='' ?$di_value['product_comment'] :"----" )  ; ?></td> -->

                        <td ><?php echo $di_value['trans_ref']; ?></td>
                        <td ><?php echo $di_value['quantity']; ?></td>                        
                        <td ><?php echo $di_value['price']; ?></td>
                        <td ><?php echo $di_value['sub_total']; ?></td>
                        
                    </tr>
                  <?php 
                  $i++;
                } ?>
                 <tr>
                  <td colspan="7"><?php echo lang('Total_Amount'); ?></td>
                  <td colspan=""><?php echo lang($currency); echo " "; echo $invoice_data[0]['sub_total'];?></td>
                </tr>
                
               <!--  <tr>
                  <td colspan="2">Special Instructions</td>
                  <td colspan="5"><?php //echo ($data[0]['user_comments']!='' ?$data[0]['user_comments'] :"----" )  ; ?>
                  </td>
                </tr> -->
               
            </tbody>
         </table>
      </div>
   </div>
</div>
</div>
<?php } ?>

<?Php }else{ ?>
<h2 class="text-center text-danger"><?php echo lang('No_record_found'); ?></h2>
<?php } ?>

<script type="text/javascript">
  //  jQuery('#PickupDate').bootstrapMaterialDatePicker({
  //   format: 'DD-MM-YYYY',
  //   clearButton: true,
  //   // weekStart: 1,
  //   minDate : new Date(),
  //   time: false
  // });
  //  jQuery('#ReadyTime').bootstrapMaterialDatePicker({
  //   date: false,
  //   format: 'HH:mm'
  // });
  //  jQuery('#LastPickupTime').bootstrapMaterialDatePicker({
  //   date: false,
  //   format: 'HH:mm'
  // });

  // jQuery('#ClosingTime').bootstrapMaterialDatePicker({
  //   date: false,
  //   format: 'HH:mm'
  // });
  
  jQuery('#ShippingDateTime').bootstrapMaterialDatePicker({
    format: 'DD-MM-YYYY HH:mm',
    clearButton: true,    
    minDate : new Date(),    
  }); 
  jQuery('#DueDate').bootstrapMaterialDatePicker({
    format: 'DD-MM-YYYY HH:mm',
    clearButton: true,
    // weekStart: 1,
    minDate : new Date(),
    // time: false
  });

  $(document).on("submit","#create_pickup_form",function(e){
    e.preventDefault();
    var PickupDate=$("#PickupDate").val();
    var ReadyTime=$("#ReadyTime").val();
    var LastPickupTime=$("#LastPickupTime").val();
    var ClosingTime=$("#ClosingTime").val();
    var ShippingDateTime=$("#ShippingDateTime").val();
    var DueDate=$("#DueDate").val();
    var error=1;
    // if(PickupDate=='')
    // {
    //    swal("","<?php //echo lang('Please_select_pickup_date'); ?>","warning");        
    //    error=0;        
    //    return false;
    // }

    // if(ReadyTime=='')
    // {
    //    swal("","<?php //echo lang('Please_select_ready_time'); ?>","warning");        
    //    error=0;        
    //    return false;
    // }

    // if(LastPickupTime=='')
    // {
    //    swal("","<?php //echo lang('Please_select_last_pickup_time'); ?>","warning");        
    //    error=0;        
    //    return false;
    // }

    // if(ClosingTime=='')
    // {
    //    swal("","<?php echo lang('Please_select_closing_time'); ?>","warning");        
    //    error=0;        
    //    return false;
    // }

    if(ShippingDateTime=='')
    {
       swal("","<?php echo lang('Please_select_shipping_date_time'); ?>","warning");        
       error=0;        
       return false;
    }

    if(DueDate=='')
    {
       swal("","<?php echo lang('Please_select_due_date'); ?>","warning");        
       error=0;        
       return false;
    }

    if(error==1)
    {
        $('#loading').show(); 
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url($language.'/admin/vorders/create_pickup/').$order_id; ?>",
            data: {PickupDate:PickupDate,ReadyTime:ReadyTime,LastPickupTime:LastPickupTime,ClosingTime:ClosingTime,ShippingDateTime:ShippingDateTime,DueDate:DueDate}, 
            success: function(response)
            {
              $('#loading').hide(); 
              var response = $.parseJSON(response);
              if (response.status==true)
              {
                swal("",response.message,'success');
                $("#shipping_id").text(response.shipping_id);
              }else if(response.status==false){
                swal("",response.message,'warning');
              }else{
                swal("","Something went wrong",'warning');
              }
            }   
        });
    }

    // alert(PickupDate);
  });
</script>
<style type="text/css">
  .form-group {
      width: 100%;
      margin-bottom: 25px;
      clear: both;
  }
  textarea.textarea {
    width: 100%;
    height: 100px;
    border-radius: 10px;
}

</style>

<script type="text/javascript">
  $(".alert-success").fadeOut(10000);
</script>