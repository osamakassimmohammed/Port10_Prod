<!doctype html>
<html>
   <head>
      <meta charset="utf-8">
      <title>sofa</title>
      <style>
         .invoice-box table tr td:nth-child(2) {
         text-align: right;
         }
         .invoice-box table tr.top table td {
         padding-bottom: 00px;
         }
         .invoice-box table tr.top table td.title {
         }
         .invoice-box table tr.information table td {
         padding-bottom: 40px;
         }
         .invoice-box table tr.heading td {
         font-size:12px;
         border-bottom: 1px solid #000;
         font-weight: bold;
         text-align:left;
         }
         .invoice-box table tr.details td {
         padding-bottom: 20px;
         }
         .invoice-box table tr.item td{
         border-bottom: 1px solid #000;
         }
         .invoice-box table tr.item.last td {
         border-bottom: none;
         }
         .invoice-box table tr.total td:nth-child(2) {
         border-top: 2px solid #000;
         font-weight: bold;
         }
         @media only screen and (max-width: 600px) {
         .invoice-box table tr.top table td {
         width: 100%;
         display: block;
         text-align: left;
         }
         .invoice-box table tr.information table td {
         width: 100%;
         display: block;
         text-align: left;
         }
         }
           @page 
    {
        size:  auto;   /* auto is the initial value */
        margin:0mm;  /* this affects the margin in the printer settings */
    }

         @media print {
            title, footer{
  display: none;
}
}

div, table, tr, td{
        font-weight:600 !important;
        color:#000;
        text-align:left;
}
      </style>

   </head>
   <body>

      <!-- <div class="invoice-box" style="max-width: 800px; margin: auto; padding: 30px; border: 1px solid #000; box-shadow: 0 0 10px rgba(0, 0, 0, .15); font-size: 16px; line-height: 24px; font-family:  'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; color: #000; margin-top: 50px; margin-bottom: 70px;" > -->
         <div class="invoice-box" style="max-width: 100%; margin: auto; padding: 5px; border: 0px solid #000; font-size: 12px; line-height: 24px; font-family:  'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; color: #000; margin-top: 00px; margin-bottom: 00px;" >
         <table style="width: 100%; line-height: inherit; text-align: left;  "  cellpadding="0" cellspacing="0">
            <tr class="top">
               <td style="padding: 5px; vertical-align: top;"  colspan="5">
                  <table style="width: 100%; line-height: inherit; text-align: left;" >
                     <tr style="    " >
                        <td style="    padding-bottom: 00px; text-align:center;"  class="title">
                           <img src="<?php echo base_url("assets/admin/images/print.png") ?>" style="width:100px; display:inline-block;  ">
                        </td>
                        
                         
                        </tr>
                        
                        <tr style="font-size: 8px; text-align:center; " >
                            <td style=" text-align:center; line-height:10px; " >
                                Shop No. G-59, Destination Centre, Nanded City, Pune
                                <span style="font-size: 10px; display:inline-block; width:100%;  text-align:center; line-height:10px;  " > Customer Care : +91 965 708 5708 </span>
                            </td>    
                        </tr>
                        <tr style="" >
                            
                        <td style="padding: 0px; float: left; text-align: left;  border-top:1px solid #000; width:100%; line-height:20px; display: inline-block; padding-top: 20px; vertical-align: top; " >
                           Invoice #: <?php  echo $order_data[0]['display_order_id'];  ?><br>
                           Created: <?php  echo date('d M Y H:i:s' ,strtotime($order_data[0]['order_datetime']));  ?><br>
                          <!-- Order Status: <?php  echo $order_data[0]['order_status'];  ?><br>-->
                           Order Payment: <?php  echo $order_data[0]['payment_status'];  ?>
                        </td>
                    

                     <!-- <tr style="" >
                        <td style="padding-top: 40px; font-weight: 600; color:#8533a2; font-size: 22px; " >
                           Invoice For Order <?php echo $order_data[0]['order_master_id']; ?>
                           <br/>
                           <span style="font-size: 12px; color:#000; font-weight: 600; " > Order Date : <?php  echo date('d M Y' ,strtotime($order_data[0]['order_datetime']));  ?> </span>

                        </td>
                     </tr> -->
                     <tr style="" >
                        <td style="padding-top: 5px; font-weight: 600; color:#000; font-size: 16px;     line-height: 16px; " >
                           Billing Address
                           <br/>
                           <span style="font-size: 12px; color:#000; font-weight: 600; display: inline-block; line-height: 15px; margin-top: 0px; width: 100%; " ><?php echo $order_data[0]['building_name']; ?>
                            <?php echo $order_data[0]['landmark']; ?>
                           </span>
                            
                           <span style="font-size: 12px; color:#000; font-weight: 600; display: inline-block; line-height: 15px; margin-top: 0px; width: 100%; " ><?php echo $order_data[0]['address']; ?>
                           </span>
                           
                           <span style="font-size: 12px; color:#000; font-weight: 600; display: inline-block; line-height: 15px; margin-top: 0px; width: 100%; " >
                           <b> Phone : </b><?php echo $order_data[0]['mobile_no']; ?>
                           </span>
                        </td>
                     </tr>
                     </tr>
                  </table>
               </td>
            </tr>
            <!-- <tr class="information">
               <td style="padding: 5px; vertical-align: top;"  colspan="2">
                    
               </td>
               </tr> -->
            <tr class="heading" style="text-align:left; " >
               <td style="padding: 5px; vertical-align: top; border-top:1px solid #000;" >
                  PRODUCT
               </td>
               <td style="padding: 5px; vertical-align: top;border-top:1px solid #000; " >
                  SIZE
               </td>
               <td style="padding: 5px; vertical-align: top; border-top:1px solid #000;" >
                  QTY
               </td>
               <td style="padding: 5px; vertical-align: top; border-top:1px solid #000;" >
                  PRICE
               </td>
               <td style="padding: 5px; vertical-align: top; border-top:1px solid #000;" >
                  AMT
               </td>
            </tr>

            <?php if (!empty($data_items)): ?>
               <?php foreach ($data_items as $key => $row): ?>
                  <tr class="details">
                     <td style="padding:2px 5px; vertical-align: top; border-bottom: 1px solid #000; padding-right:10px;" ><?php echo @$row["product_name"]; ?> <?php if (!empty($row['add_your_cut'])): ?>( <?php echo @$row["add_your_cut"]; ?> )<?php endif ?>
                     </td>
                     <td style="padding:2px 5px; vertical-align: top; border-bottom: 1px solid #000; padding-right:10px;" ><?php echo @$row["size"]; ?>
                     </td>
                     <td style="padding:2px 5px; vertical-align: top; border-bottom: 1px solid #000; padding-right:10px;" >
                        <?php echo @$row["quantity"]; ?>
                     </td>
                     <td style="padding:2px 5px; vertical-align: top; border-bottom: 1px solid #000; padding-right:10px;" >
                        <?php echo @$row["price"]; ?>
                     </td>
                     <td style="padding:2px 5px; vertical-align: top; border-bottom: 1px solid #000; padding-right:10px;" >
                        <?php echo @$row["sub_total"]; ?>
                     </td>
                  </tr>

               <?php endforeach ?>
            <?php endif ?>


                     
             
            
         </table>
         
         <table style="width:100%; font-size: 10px; " >
                 <tr class="details">
                
             
               <td style="padding: 2px 5px; vertical-align: top; font-weight: 600; color:#000; border-bottom: 1px solid #000;" >
                  Subtotal :
               </td>
               <td style="padding:2px 5px; vertical-align: top; border-bottom: 1px solid #000; padding-right:10px;" >
                  <?php echo $order_data[0]['sub_total']; ?>
               </td>
            </tr>
            <tr class="details">
                
               <td style="padding: 2px 5px; vertical-align: top; font-weight: 600; color:#000; border-bottom: 1px solid #000;" >
                  Shipping Charge :
               </td>
               <td style="padding:2px 5px; vertical-align: top; border-bottom: 1px solid #000; padding-right:10px;" >
                  10
               </td>
            </tr>
            <tr class="details"  >
                
               <td style="padding: 2px 5px; vertical-align: top; font-weight: 600; color:#000; border-bottom: 1px solid #000;" >
                  Discount Charge :
               </td>
               <td style="padding:2px 5px; vertical-align: top; border-bottom: 1px solid #000; padding-right:10px;" >
                  10
               </td>
            </tr>
            <tr class="details"  >
                
               <td style="padding: 2px 5px; vertical-align: top; font-weight: 600; color:#000; border-bottom: 1px solid #000; font-size:16px; " >
                  Total Amount :
               </td>
               <td style="padding: 2px 5px; vertical-align: top; font-weight: 600; color:#000; border-bottom: 1px solid #000; font-size:16px; " >
                  <?php echo @$order_data[0]['sub_total']; ?>
               </td>
            </tr> 
         </table>
         
         <div style="font-size:15px; text-align:center; display:inline-block; width:100%; ">
            Thank you for Ordering
            <br>
            <span style="font-size:17px;" > Order Again !!! </span>
         </div>
         
      </div>
   </body>
</html>
<script type="text/javascript">
   $(document).ready(function(){
      window.print();
   });
</script>