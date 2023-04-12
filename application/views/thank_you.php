<style type="text/css">
   .home_active{
   font-weight: 600 !important;
   color: #c09550 !important;
   }
   .contnr_main_headr.hedr_fixed{
   position: static;
   box-shadow: 0px 0px 0px #fff;
   }
   .fa-times-circle{
    font-size: 50px !important;
    color: #ea1f29 !important;
    }
</style>



<!-- thank-you section start -->
    <section class="section-b-space light-layout">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php if($order_data[0]['payment_status']=='Paid' || $order_data[0]['payment_mode']=='cash-on-del'){ ?>
                    <div class="success-text"><i class="fa fa-check-circle" aria-hidden="true"></i>
                        <h2><?php echo lang('Done'); ?></h2>
                    <?php }else{ ?>
                        <div class="success-text"><i class="fa fa-times-circle" aria-hidden="true"></i>
                        <h2><?php echo lang('Failed'); ?></h2>
                    <?php } ?>    
                        <?php if(@$order_data[0]['payment_mode']=='cash-on-del'){ ?>
                        <p><?php echo lang('Transfer_Amount'); ?> <?php echo number_format($order_data[0]['net_total'],2); ?> <?php echo lang($order_data[0]['currency']); ?> <?php echo lang('To_Port10'); ?> ,<?php echo lang('Account_Number'); ?> SA30 8000 0131 6080 1056 6331 <?php echo lang('With_AlRajhi_Bank'); ?> <?php echo $order_data[0]['display_order_id']; ?></p>
                        <?php } ?>
                        <?php if(!empty($tran_history)){ ?>
                        <?php if($tran_history[0]['payment_status']=='Paid'){ ?>
                        <p><?php echo lang('Your_order_is_processed'); ?>.</p>   
                        <?php }else{ ?>
                        <p> <?php echo lang('Payment_for_this_order'); ?></p>   
                        <p><?php if(isset($tran_history[0]['code_msg'])){
                            echo $tran_history[0]['code_msg'];
                        }else{
                         echo $tran_history[0]['errorText'];   
                        } ?></p>         
                        <?php } ?>
                        <p><?php echo lang('Transaction_ID'); ?>:<?php echo $tran_history[0]['track_id']; ?></p>
                        <?php  }?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section ends -->


    <!-- order-detail section start -->
    <section class="section-b-space">
        <div class="container container_detl_wdth">
            <div class="row">
                 

                <div class="container">
                    <div class="row">
                        <!-- <h3>your order details</h3> -->
                <div class="col-lg-6 thnkyou_order6">
                    <div class="product-order">
                        
                        <div class="row product-order-detail" style="margin-top: 0px;" >
                            
                            <div class="col-3 order_detail">
                                <div>
                                    <h4><?php echo lang('product_name'); ?></h4>                                    
                                </div>
                            </div>
                            <div class="col-3 order_detail">
                                <div>
                                    <h4><?php echo lang('Unit'); ?></h4>                                    
                                </div>
                            </div>
                            <div class="col-3 order_detail">
                                <div>
                                    <h4><?php echo lang('quantity'); ?></h4>
                                </div>
                            </div>
                            <div class="col-3 order_detail">
                                <div>
                                    <h4><?php echo lang('Price'); ?></h4>                                    
                                </div>
                            </div>
                        </div>
                        <?php if(!empty($order_items)){ 
                            foreach ($order_items as $oi_key => $oi_val) { ?>
                        <div class="row product-order-detail">                            
                            <div class="col-3 order_detail">
                                <div>                                    
                                    <h5><?php echo $oi_val['product_name']; ?></h5>
                                </div>
                            </div>
                            <div class="col-3 order_detail">
                                <div>                                    
                                    <h5><?php echo $oi_val['unit_name']; ?></h5>
                                </div>
                            </div>
                            <div class="col-3 order_detail">
                                <div>                                    
                                    <h5><?php echo $oi_val['quantity']; ?></h5>
                                </div>
                            </div>
                            <div class="col-3 order_detail">
                                <div>                                    
                                    <h5><?php echo $oi_val['price']; ?> <?php echo lang($order_data[0]['currency']); ?></h5>
                                </div>
                            </div>
                        </div>
                        <?php }  ?>
                        <!-- number_format($order_data[0]['net_total'],2) -->
                        <div class="total-sec">
                            <ul>
                                <li><?php echo lang('Subtotal_s'); ?> <span><?php echo number_format($order_data[0]['sub_total'],2); ?> <?php echo lang($order_data[0]['currency']); ?></span></li>
                                <li><?php echo lang('fees'); ?> <span><?php $fees=$order_data[0]['commission']+$order_data[0]['transfer_fees']+$order_data[0]['bank_fees']; echo number_format($fees,2);  ?> <?php echo lang($order_data[0]['currency']); ?></span></li>
                                <li><?php echo lang('VAT'); ?><span><?php echo number_format($order_data[0]['tax'],2); ?> <?php echo lang($order_data[0]['currency']); ?></span></li>
                                <li><?php echo lang('Shipping'); ?><span><?php echo number_format($order_data[0]['shipping_charge'],2); ?> <?php echo lang($order_data[0]['currency']); ?></span></li>
                            </ul>
                        </div>
                        <div class="final-total">
                            <h3><?php echo lang('total'); ?> <span><?php echo number_format($order_data[0]['net_total'],2); ?> <?php echo lang($order_data[0]['currency']); ?></span></h3>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-lg-6 thnkyou_order6">
                    <div class="row order-success-sec">
                        <div class="col-sm-6">
                            <h4><?php echo lang('Summary'); ?></h4>
                            <ul class="order-detail">
                                <li><?php echo lang('Transaction_Reference'); ?>: <?php echo $order_data[0]['display_order_id']; ?></li>
                                <li><?php echo lang('aOrder_date'); ?>: <?php echo date('d-m-Y' ,strtotime($order_data[0]['order_datetime'])); ?> </li>
                                <li><?php echo lang('Order_Total'); ?> <?php echo number_format($order_data[0]['net_total'],2); ?> <?php echo lang($order_data[0]['currency']); ?></li>
                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <h4><?php echo lang('Shipping_Billing_Address'); ?></h4>
                            <ul class="order-detail">
                                <li><?php echo $order_data[0]['address_1']; ?> </li>
                                <li><?php echo $order_data[0]['city']; ?>, <?php echo $order_data[0]['pincode']; ?></li>
                                <li><?php echo $order_data[0]['state']; ?>, <?php echo $order_data[0]['country']; ?></li>
                                <li><?php echo lang('contact_no'); ?>: <?php echo $order_data[0]['mobile_no']; ?></li>
                            </ul>
                        </div>
                        <div class="col-sm-12 payment-mode" style="margin-top: 20px;" >
                            <h4><?php echo lang('Payment_Method'); ?></h4>
                            <?php if($order_data[0]['payment_mode']=='cash-on-del'){ ?>
                                <p><?php echo lang('Virtual_Account_Transfer'); ?></p>
                            <?php }else{ ?>
                                <p><?php echo lang('Card'); ?></p>
                            <?php } ?>
                        </div>
                        <br>
                        <div class="col-sm-12 payment-mode" style="margin-top: 20px;" >
                            <h4><?php echo lang('Payment_Status'); ?></h4>
                            <?php if($order_data[0]['payment_mode']=='cash-on-del'){ 
                                echo lang('Unpaid');
                             }else if($order_data[0]['payment_status']=='Paid'){ ?>
                            <p><?php echo lang('Paid'); ?> </p>
                            <?php }else{ ?>
                            <p>Failed</p>    
                            <?php }?>
                        </div>
                        
                    </div>
                </div>
                </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section ends -->