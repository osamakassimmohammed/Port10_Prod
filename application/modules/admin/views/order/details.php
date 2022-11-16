<div class="col-md-12" style="float: right;    margin-bottom: 0px;    height: 10px; margin-top: -10px;">
      <a href="<?php echo base_url('') ?>/admin/orders" class="back_button">Back to list</a>
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
</style>


<?php
$order_status=$data['order_status'];
$payment_status=$data['payment_status'];
$payment_mode=$data['payment_mode'];
$order_comment=$data['order_comment'];
$currency = @$data['currency'];
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
      <div class="panel-footer">Order Details</div>
      <div class="panel-body">
        <table class="table table-bordered">
          <tbody>
           <?php if (!empty($data)) {
           ?>
            <tr>
              <th>Transaction Reference</th>
              <td><?php echo $data['display_order_id'];?></td>
            </tr>

            <tr>
              <th>Order Date</th>
              <td><?php echo  date('M-d-Y' ,strtotime($data['order_datetime']));  ?></td>
            </tr>

            <tr>
              <th>Payment Mode</th>
              <td><?php if($data['payment_mode']=='cash-on-del'){
                echo "Virtual Account";
              }else{
                echo "Credit Card";
              }?></td>
            </tr>          

            <tr>
              <th>Order Status:</th>
              <td><?php echo $data['order_status'];?></td>
            </tr>

            <tr>
              <th>Payment Status</th>
              <td><?php if($data['payment_mode']=='cash-on-del'){ ?>
                <select id="chage_payment_status">
                  <?php foreach ($payment_status_arr as $psa_key => $psa_val) { 
                          $Selected='';
                          if($psa_val==$data['payment_status'])
                          {
                            $Selected='Selected';
                          }
                    ?>
                    <option value="<?php echo $psa_val; ?>" <?php echo $Selected; ?>><?php echo $psa_val; ?></option>          
                  <?php } ?>                  
                </select>
                <button id="btn_payment" class="btn btn-success">Submit</button>
              <?php }else{
                echo $data['payment_status'];
              }?></td>
            </tr> 

            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
   <div class="col-md-6">
    <div class="panel panel-default ">
      <div class="panel-footer">User Details</div>
      <div class="panel-body">
        <table class="table table-bordered">
          <tbody>
           <?php if (!empty($user_detail)) {
           ?>
            <tr>
              <th>Establishment Name</th>
              <td><?php echo $user_detail[0]['first_name'];?></td>
            </tr>
            <tr>
              <th>Email</th>
              <td><?php echo $user_detail[0]['username'];?></td>
            </tr>
            <tr>
              <th>Mobile No</th>
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
      <div class="panel-footer">Shipping Details</div>
        <div class="panel-body">


          <div class="row">
             <div class="col-sm-4 orderfiled_name">
                Name : 
             </div>
             <div class="col-sm-8 orderfiled_content">
                <?php echo $data['first_name'].' '.$data['last_name']; ?>                          
              </div>
          </div>
           <div class="row">
             <div class="col-sm-4 orderfiled_name">
                Email : 
             </div>
             <div class="col-sm-8 orderfiled_content">
                <?php echo $data['email']; ?>                          
              </div>
          </div>
           <div class="row">
             <div class="col-sm-4 orderfiled_name">
                Mobile : 
             </div>
             <div class="col-sm-8 orderfiled_content">
                <?php echo $data['mobile_no']; ?>                          
              </div>
          </div>
          

          <div class="row">
             <div class="col-sm-4 orderfiled_name">
                Country : 
             </div>
             <div class="col-sm-8 orderfiled_content">
                <?php echo $data['country']; ?>                         
              </div>
          </div>

           <div class="row">
             <div class="col-sm-4 orderfiled_name">
                State  : 
             </div>
             <div class="col-sm-8 orderfiled_content">
                <?php echo $data['state']; ?>                          
              </div>
          </div>


          <div class="row">
             <div class="col-sm-4 orderfiled_name">
                City   : 
             </div>
             <div class="col-sm-8 orderfiled_content">
                <?php echo $data['city']; ?>                          
              </div>
          </div>

          <div class="row">
             <div class="col-sm-4 orderfiled_name">
                Pincode   : 
             </div>
             <div class="col-sm-8 orderfiled_content">
                <?php echo $data['pincode']; ?>                          
              </div>
          </div>

           <div class="row">
             <div class="col-sm-4 orderfiled_name">
                Address   : 
             </div>
             <div class="col-sm-8 orderfiled_content">
                <?php echo $data['address_1'].' '.$data['address_2']; ?>                          
              </div>
          </div>

        </div>
        
        </div>
        <?php if($data['payment_mode']=='online') { ?>
        <div class="panel panel-default ">
          <div class="panel-footer">Payment Details</div>
            <div class="panel-body">              
              <div class="row">
               <div class="col-sm-4 orderfiled_name">
                  Transaction Id   : 
               </div>
               <div class="col-sm-8 orderfiled_content">
                  <?php echo @$trans_history[0]['track_id']; ?>                          
                </div>
              </div>              
              <div class="row">
               <div class="col-sm-4 orderfiled_name">
                  Message   : 
               </div>
               <div class="col-sm-8 orderfiled_content">
                  <?php echo @$trans_history[0]['errorText']; ?>                          
                </div>
              </div>
            </div> 
          </div>
        <?php } ?>        

      </div>

      <!-- <div class="col-md-6" style="display: none">
           <div class="panel panel-default " >
            <form  action="" method="POST">
              <div class="panel-footer">Update Order</div>
              <div class="panel-body">
                 <div class="form-group">
                    <label class="control-label col-sm-5 "> Order Date :
                    </label>
                    <div class="col-sm-7" style="padding-top: 7px;">
                       <?php echo date("D d F Y, H:i",strtotime($data['order_datetime'])); ?>
                    </div>
                 </div>
                 <div class="form-group">
                    <label class="control-label col-sm-5 ">Estimate Delivery Date :
                    </label>
                    <div class="col-sm-7" style="padding-top: 7px;">

                       <input class="ha-input1" type="text" id="d_date" value="<?php echo $data['delivery_date']; ?>" class="form-control" name="delivery_date" placeholder="Order Date"required>

                       
                    </div>
                 </div>
                 <div class="form-group">
                    <label for="" class="col-sm-5 control-label">Order Status :</label>
                    <div class="col-sm-7">
                       <?php // echo $order_status; ?>
                       <select  class="form-control"  name="order_status" >
                          <option value="" disabled="">Select Order Status :</option>
                          <?php  if( isset($order_status) && $order_status == "Pending" ) { ?>
                          <option value="Pending" <?php if( isset($order_status) && $order_status == "Pending" ) echo "Selected"; ?> >Pending</option>
                          <option value="Dispatched">Dispatched</option>
                          <option value="Delivered">Delivered</option>
                          <option value="canceled">Canceled</option>
                          <?php }else if(isset($order_status) && $order_status == "Dispatched") { ?>
                            <option value="Dispatched" <?php if( isset($order_status) && $order_status == "Dispatched" ) echo "Selected"; ?> >Dispatched</option>
                            <option value="Delivered">Delivered</option>
                            <option value="canceled">Canceled</option>
                          <?php }else if(isset($order_status) && $order_status == "Delivered"){ ?>
                            <option value="Delivered" <?php if( isset($order_status) && $order_status == "Delivered" ) echo "Selected"; ?> >Delivered</option>
                          <?php }else if(isset($order_status) && $order_status == "canceled"){ ?>
                           <option value="canceled" <?php if( isset($order_status) && $order_status == "canceled" ) echo "Selected"; ?> >canceled</option> 
                          <?php }  ?>
                       </select>
                    </div>
                 </div>
                 <div class="form-group">
                    <label for="" class="col-sm-5 control-label">Payment Status :</label>
                    <input type="hidden" name="payment_status" value="<?php echo $data['payment_status'] ; ?>">
                    
                    <?php if($data['payment_mode'] == 'online' && $data['payment_status'] == 'Paid')
                    { ?>
                        <div class="col-sm-7">
                         <select  class="form-control">
                          <option value="Paid" <?php if( isset($payment_status) && $payment_status == "Paid" ) echo "Selected"; ?> >Paid</option>
                         </select>
                         </div>
                    <?php }
                    else
                    { ?>

                    <div class="col-sm-7">
                       <select  class="form-control"  name="payment_status" >
                        <option value="" disabled="">Select Payment Status :</option>
                        <?php  if(isset($payment_status) && $payment_status == "Unpaid"){ ?>

                        <option value="Paid" <?php if( isset($payment_status) && $payment_status == "Paid" ) echo "Selected"; ?> >Paid</option>
                        <option value="Unpaid" <?php if( isset($payment_status) && $payment_status == "Unpaid" ) echo "Selected"; ?> >Unpaid</option>
                      <?php }else{ ?>
                        <option value="Paid" <?php if( isset($payment_status) && $payment_status == "Paid" ) echo "Selected"; ?> >Paid</option>
                      <?php } ?>
                       </select>
                       </div>

                    <?php } ?>
                 </div>
                 <div class="form-group">
                    <label  class="col-sm-5 control-label">Payment Mode :</label>
                    <div class="col-sm-7" style="padding-top: 6px;">
                       <?php echo $payment_mode; ?>
                       <input type="hidden" name="payment_mode" value="<?php echo $payment_mode; ?>">
                    </div>
                 </div>
                 <div class="form-group">
                    <label for="" class="col-sm-5 control-label">Order comment :</label>
                    <div class="col-sm-7">
                       <?php // echo $order_comment; ?>
                       <textarea name="order_comment" class="textarea"><?php echo $order_comment; ?></textarea>
                    </div>
                 </div>
                 <div class="form-group" style="margin-top: 10px;">
                    <div class="col-sm-12">
                       <input type="submit" value="Update" name="submit" class="btn btn-success pull-right">
                    </div>
                 </div>
              </div>
            </form>
           </div>
      </div> -->

    </div>


        


<?php  if(!empty($data_items)) { ?>
<div class="x_content row">
  <div class="col-md-12">
         <div class="panel panel-default">
            <div class="panel-footer">Product Details</div>
            <div class="panel-body">
               <table id="datatable-checkbox mytable" class="table table-striped table-bordered bulk_action" style="border-bottom: 0px;border-left: 0px;  border-right: 0px;">
                  <thead>
                     <tr>
                        <th>Sr No.</th>
                        <th>Image</th>
                        <th>Product Name</th>
                        <!-- <th>Product Customize</th> -->
                        <th>Pro Ref</th>
                        <th>Quantity</th>                        
                        <th>price</th>
                        <th>Sub total</th>                        
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
                        <td style="display: none">
                        <?php if (!empty($di_value['product_cust_data'])): ?>
                          <?php foreach ($di_value['product_cust_data'] as $dskey => $cdvalue): ?>
                            <p>
                              <?php echo $cdvalue['name']; ?> :- 
                                <?php if ($cdvalue['price'] == '0'): ?>
                                  Free
                                <?php endif ?>
                                <?php if ($cdvalue['price'] != '0'): ?>
                                  <?php echo $currency.' '.$cdvalue['price']; ?>
                                <?php endif ?>
                            </p>
                          <?php endforeach ?>
                        <?php endif ?>
                        </td>

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
                  <td colspan="6">Total Price</td>
                  <td colspan=""><?php echo $currency; echo " "; echo $data['sub_total'];?></td>
                </tr>
                <tr>
                  <td colspan="6">Fees</td>
                  <td colspan=""><?php echo $currency; echo " "; echo $data['commission']+$data['transfer_fees']+$data['bank_fees']; ?></td>
                </tr>
                <tr>
                  <td colspan="6">Vat</td>
                  <td colspan=""><?php echo $currency; echo " "; echo $data['tax']; ?></td>
                </tr>
                <?php
                if(!empty($data['coupon_code'])){ ?>
                  <tr>
                    <td colspan="6">Coupon Code</td>
                    <td colspan=""><?php echo $data['coupon_code']; ?></td>
                  </tr>
                  <tr>
                    <td colspan="6">Coupon Price</td>
                    <td colspan=""><?php echo $currency; echo " "; echo $data['coupon_price']; ?></td>
                  </tr>
                <?php  } ?>
                <tr>
                  <td colspan="6">Grand Total</td>
                  <td colspan=""><?php echo $currency; echo " "; echo $data['net_total']-$data['coupon_price']; ?></td>
                </tr>
               <!--  <tr>
                  <td colspan="2">Special Instructions</td>
                  <td colspan="5"><?php //echo ($data['user_comments']!='' ?$data['user_comments'] :"----" )  ; ?>
                  </td>
                </tr> -->
                 <!-- <tr>
                  <td colspan="2">Delivery  Option</td>
                  <td colspan="5"><?php //if($data['delivery_option']=='delivery'){ echo  "Admin Will  Deliver Order"; }else{  echo  "Customer will Pick-Up Form  Hotel"; }  ?></td>
                </tr> -->
                <!-- <tr>
                  <td colspan="2">Cutlery  Option</td>
                  <td colspan="5"><?php// echo ($data['cutlery_option']=='yes' ?$data['cutlery_option'] :"no" )  ; ?></td>
                </tr> -->
               
            </tbody>
         </table>
      </div>
   </div>
</div>
</div>
<?php } ?>

<script type="text/javascript">
   jQuery('#d_date').bootstrapMaterialDatePicker({
    format: 'YYYY-MM-DD',
    clearButton: true,
    weekStart: 1,
    minDate : new Date(),
    time: false
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
  $(document).on("click","#btn_payment",function(){
    var payment_status=$("#chage_payment_status").val();
    if(payment_status=='Paid' || payment_status=='Unpaid')
    {
      $('#loading').show(); 
        $.ajax({
           type: 'POST',
           url: "<?php echo base_url('admin/orders/change_payment_status'); ?>",
           data: {'payment_status':payment_status,'order_master_id':'<?php echo @$data['order_master_id']; ?>'},    
           success: function(response)
           {       
              $('#loading').hide();  
              response=$.trim(response);
               var response = $.parseJSON(response);
              if (response.status==true)
              {                                     
                swal("",response.message,'success');                                
              }else{
                swal("",response.message,'warning');
              }
           }
        });      
    }else{
      swal("","Invalid Payment status Selected","warning");
    }
  });
</script>
