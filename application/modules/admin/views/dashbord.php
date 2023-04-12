<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.css' rel='stylesheet' media='screen'>
<script src='<?php echo base_url(); ?>/assets/grocery_crud/themes/datatables/jquery-datatable/jquery.dataTables.js'></script>
<script src='<?php echo base_url(); ?>/assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.js'></script>
<style>
   p.p_name {
    width: 100%;
   }
   .wrap_dash_brd{
   padding: 20px;
   border-radius: 2px;
   }
   .img_lft_a {
   float: left;
   width: 25%;
   }
   .img_lft_a img {
   width: 100%;
   }
   .clear{
   clear:both;
   }
   .cellgrid {
   list-style-type: none;
   margin: 0px;
   padding: 0px;
   }
   .cellgrid li {
   float: left;
   width: 25%;
   border: 0px solid red;
   }
   .right_panl_info {
   float: left;
   width: 75%;
   padding-left: 4%;
   }
   .buyr_text {
   margin-top: 6px;
   font-size: 14px;
   color: #8a8a8a;
   }
   .buy_numbr_cont {
   font-size: 21px;
   font-weight: 600;
   float: left;
   width: 100%;
   margin-top: -2px;
   }
   .li_singl_wrap {
   background: #fff;
   width: 96%;
   border: 1px solid #efefef;
   border-radius: 2px;
   padding: 10px 10px;
   margin-bottom: 20px;
   box-shadow: 2px 2px 4px 2px #00000008;
   padding-top: 14px;
   padding-bottom: 15px;
   display: inline-block;
   margin-left: 1%;
   }
   .report_li {
   background: #3e96f3!important;
   padding: 5px 10px;
   display: inline-block;
   color: #fff;
   font-size: 13px;
   border-radius: 3px;
   float: left;
   margin-top: 1px;
   }
   .report_li:hover{
   background: #2b85e4;
   cursor: pointer;
   }
   #records_table_hide, #error, #error_dme, #search_dme_table_hide{
   display: none;
   }
   .notf_error, #latest_product_tberr,#latest_product_t {
   display: none;
   }
   .nofoundrecord
   {
   text-align: center;
   padding: 7px;
   font-size: 14px;
   }
   .vieworderid 
   {
   background-color: #39b9a5;
   padding: 8px 10px 8px 10px;
   width: 10%;
   color:#fff;
   }
   .vieworderid1
   {
   background-color: #39b9a5;
   padding: 8px 10px 8px 10px;
   width: 10%;
   color: #fff;
   }
   .badge{
   background-color: #fb483a;
   }
   .subdate_search,.latestpro_date
   {
   background-color: #39b9a5 !important; 
   padding: 8px 23px !important;
   font-size: 14px !important;
   }
   .font_iconcss
   {
   font-size: 21px;
   cursor: pointer;
   color: #279887;
   }
   .latest_order
   {
   border: 1px solid #dcdcdc;
   border-radius: 5px;
   padding: 2px;
   position: relative;
   width: 13%;
   text-align: center;
   margin-bottom: 16px;
   }
   .latest_order h5
   {
   font-size: 16px;
   }
</style>

<div class="main dashboard">
    <div class="center">
        <div class="container">
            <div class="box_container full">
            <h2>Total Summary</h2>
            
            <div class="row card_main">




                <div class="col-xs-3">
                  <a href="users/active_customers">
                    <div class="card two">
                        <i class="fa fa-users"></i>
                        <div class="card-content">
                            <p class="title">Total Active Customers</p>
                            <p class="count"><?php echo $count_customer; ?></p>
                        </div>
                    </div>
                    </a>
                </div><!-- col-xs-3 -->

                <div class="col-xs-3">                 
                    <a href="orders/new_api_order"> 
                    <div class="card one">                 
                      <i class="fa fa-shopping-cart"></i>
                      <div class="card-content">
                         <p class="title">New Order</p>
                         <p class="count"><?php echo count($today_order); ?></p>
                      </div>
                   </div>
                 </a>
                </div><!-- col-xs-2 -->
                
                <div class="col-xs-3">
                  <?php if(!empty($profit_total)){ ?>
                    <a href="orders/paid_order">
                  <?php }else{ ?>
                    <a href="javascript:void(0)">
                  <?php } ?>
                   <div class="card three">
                      <i class="fa fa-building"></i>
                      <div class="card-content">
                         <p class="title">Total Sale</p>
                         <p class="count"><?php echo $total_sale[0]['sale'] ?></p>
                      </div>
                   </div>
                  </a> 
                </div><!-- col-->

                 <div class="col-xs-3">
                  <a href="dashbord/all_topsold">
                    <div class="card four">
                      <i class="fa fa-money"></i>
                      <div class="card-content">
                         <p class="title">Top Sold Product</p>
                        
                         <p class="count"> <?php echo count($top_selled); ?></p>
                      </div>
                    </div>
                  </a>  
                  </div><!-- col-xs-2 -->

            </div> <!--form_header-->

            <div class="row card_main">                                   
                
                <div class="col-xs-3">
                  <a href="orders/pending_order">
                    <div class="card two">
                        <i class="fa fa-users"></i>
                        <div class="card-content">
                            <p class="title">Pending Order</p>
                            <p class="count"><?php echo $pending_order[0]['pending']; ?></p>
                        </div>
                    </div>
                    </a>
                </div><!-- col-xs-3 -->

                <div class="col-xs-3">                 
                    <a href="orders/cancel_order"> 
                    <div class="card one">                 
                      <i class="fa fa-shopping-cart"></i>
                      <div class="card-content">
                         <p class="title">Canceled Order</p>
                         <p class="count"><?php echo $Cancelled_order[0]['Cancelled']; ?></p>
                      </div>
                   </div>
                 </a>
                </div><!-- col-xs-2 -->

                <div class="col-xs-3">                  
                  <a href="orders/completed_order">                  
                  <div class="card three">
                      <i class="fa fa-building"></i>
                      <div class="card-content">
                         <p class="title">Complete Order</p>
                         <p class="count"><?php echo $complete_order[0]['complete']; ?></p>
                      </div>
                   </div>
                  </a> 
                </div><!-- col-xs-2 -->

                <div class="col-xs-3">
                <a href="product/list1">
                  <div class="card four">
                    <i class="fa fa-money"></i>
                    <div class="card-content">
                       <p class="title">Total Our Product</p>
                      
                       <p class="count"> <?php echo $product_count; ?></p>
                    </div>
                  </div>
                </a>  
              </div><!-- col-xs-2 -->

            </div> <!--form_header-->   

            <div class="row card_main">                                   
                
                <div class="col-xs-3">
                  <a href="users">
                    <div class="card two">
                        <i class="fa fa-users"></i>
                        <div class="card-content">
                            <p class="title">Total New Buyers</p>
                            <p class="count"><?php echo $month_buyer_count;?></p>
                        </div>
                    </div>
                    </a>
                </div><!-- col-xs-3 -->

                <div class="col-xs-3">                 
                    <a href="users/supplier_list"> 
                    <div class="card one">                 
                      <i class="fa fa-shopping-cart"></i>
                      <div class="card-content">
                         <p class="title">Total New Supplier</p>
                         <p class="count"><?php echo $month_suppler_count; ?></p>
                      </div>
                   </div>
                 </a>
                </div><!-- col-xs-2 -->

                <div class="col-xs-3">                  
                  <a href="javascript:void(0)">                  
                  <div class="card three">
                      <i class="fa fa-building"></i>
                      <div class="card-content">
                         <p class="title">Total New Susbcribers</p>
                         <p class="count"><?php echo $newsletter_count; ?></p>
                      </div>
                   </div>
                  </a> 
                </div><!-- col-xs-2 -->
                

            </div> <!--form_header-->         

             
              

             
            </div>  
            
            <div class="row">
            <div class="col-sm-6 col-xs-12">
            
            <div class="top_action">
                <div class="col-xs-12 col pull-left">
                    <h2>Today</h2>                    
                    <h5><?php echo date("l jS \of F Y"); ?></h5>
                </div><!--col-xs-12-->
            </div><!--top_action-->
            
            <div class="table-responsive">
                <table id="today" class="table table-striped table-bordered">
                    <tbody>
                        <tr>
                            <td>Total Orders</td>
                            <td><?php echo count($today_order); ?></td>
                        </tr>
                        <tr>
                            <td>Sales</td>
                            <td>
                              <?php if(empty($today_sales[0]['total'])){
                                echo "0";
                              }else{
                                echo $today_sales[0]['total'];
                              }  ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Pending Orders</td>
                            <td><?php echo $today_pending[0]['today_pending']; ?></td>
                        </tr>
                        <tr>
                            <td>Delivered Orders</td>
                            <td><?php echo $today_deliverd[0]['today_deliverd']; ?></td>
                        </tr>
                        <tr>
                            <td>Canceled Orders</td>
                            <td><?php echo $today_canceled[0]['today_canceled']; ?></td>
                        </tr>
                        <tr>
                            <td>New customers</td>
                            <td><?php echo $today_user[0]['today_user']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div> <!--table-responsive-->
            </div><!-- col-sm-6 col-xs-12 -->
            
            <div class="col-sm-6 col-xs-12">
            <div class="top_action">
                <div class="col-xs-12 col pull-left">
                    <h2>This Week</h2>
                    <?php $now = date('Y-m-d' ,strtotime('today'));  ?>
                    <h5><span>Form:</span><?php echo date("l jS \of F Y", strtotime($now. "-6day")); ?> <span>To:</span><?php echo date("l jS \of F Y"); ?></h5>
                    <h5></h5>
                </div><!--col-xs-12-->
            </div><!--top_action-->
            
            <div class="table-responsive">
                <table id="week" class="table table-striped table-bordered">
                    <tbody>
                        <tr>
                        <td>Total Orders</td>
                            <td><?php echo $week_order[0]['week_order']; ?></td>
                        </tr>
                        <tr>
                            <td>Total Sales</td>
                            <td>
                              <?php if(empty($week_sales[0]['total'])){
                                echo "0";
                              }else{
                                echo $week_sales[0]['total'];
                              }  ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Pending Orders</td>
                            <td><?php echo $week_pending[0]['week_pending']; ?></td>
                        </tr>
                        <tr>
                            <td>Delivered Orders</td>
                            <td><?php echo $week_deliverd[0]['week_deliverd']; ?></td>
                        </tr>
                        <tr>
                            <td>Canceled Orders</td>
                            <td><?php echo $week_canceled[0]['week_canceled']; ?></td>
                        </tr>
                        <tr>
                            <td>New customers</td>
                            <td><?php echo $week_users[0]['week_users']; ?></td>
                        </tr>
                    </tbody>
                    
                </table>
            </div> <!--table-responsive-->
            </div><!-- col-sm-6 col-xs-12 -->
            
            </div><!-- row -->
            
        </div> <!--box_container-->

        </div>
    </div>

</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<style type="text/css"> 
   .box_container { margin: 0 auto; max-width: 650px; width: 100%; padding: 25px; background: #fff; border-radius: 6px; margin-top: 10px; margin-bottom: 70px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2); position: relative; display: inline-block; text-align: left !important; }
   .box_container.full { max-width: 100%; }
   .dashboard h2 { opacity: 1; text-transform: uppercase; font-size: 20px }
   .dashboard .card_main { margin-bottom: 30px }
   .dashboard .table { margin: 0px; font-size: 15px }
   .dashboard .table td:last-child { text-align: center; font-family: 'Roboto'; }
   .dashboard .table-responsive { background: #fff; border-radius: 4px; padding: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.18); }
   .dashboard .box_container { background: none; padding: 0px; box-shadow: none; }
   .dashboard .card { float: left; width: 100%; margin-top: 15px; padding: 25px 20px; border-radius: 6px; box-shadow: 0px 1px 12px rgba(0, 0, 0, 0.30); color: #23023b; position: relative; overflow: hidden; font-size: 17px; border-bottom: 4px solid rgba(0, 0, 0, 0.25) }
   .dashboard .card .fa { position: absolute; right: -10px; bottom: -10px; font-size: 80px; opacity: 0.4; }
   .dashboard .card.four .fa { bottom: -15px }
   .dashboard .card p.count { margin-bottom: 0px; font-family: 'Roboto'; font-size: 28px; margin-top: 20px }
   .dashboard .card.one { background: #119BD2; background: -moz-linear-gradient(-45deg, #3bd1bf 0%, #119bd2 100%); background: -webkit-linear-gradient(-45deg, #3bd1bf 0%, #119bd2 100%); background: linear-gradient(135deg, #3bd1bf 0%, #119bd2 100%); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#3bd1bf', endColorstr='#119bd2', GradientType=1); }
   .dashboard .card.two { background: #ff875e; background: -moz-linear-gradient(-45deg, #ff875e 1%, #fc629d 100%); background: -webkit-linear-gradient(-45deg, #ff875e 1%, #fc629d 100%); background: linear-gradient(135deg, #ff875e 1%, #fc629d 100%); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff875e', endColorstr='#fc629d', GradientType=1); }
   .dashboard .card.three { background: #8363f9; background: -moz-linear-gradient(-45deg, #ee70e9 0%, #8363f9 100%); background: -webkit-linear-gradient(-45deg, #ee70e9 0%, #8363f9 100%); background: linear-gradient(135deg, #ee70e9 0%, #8363f9 100%); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ee70e9', endColorstr='#8363f9', GradientType=1); }
   .dashboard .card.four { background: #39ce86; background: -moz-linear-gradient(-45deg, #f7cd13 1%, #39ce86 100%); background: -webkit-linear-gradient(-45deg, #f7cd13 1%, #39ce86 100%); background: linear-gradient(135deg, #f7cd13 1%, #39ce86 100%); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f7cd13', endColorstr='#39ce86', GradientType=1); }

   .container {
   width: 100%;
   }
</style>




<div class="container dashboard">
   <h2 class="">Today Order</h2> 
   <table class="table table-bordered table-striped table-hover dataTable js-exportable">
      <thead>
      <tr>
      <th>Id</th>
      <th>Order id</th>
      <th>Date time </th>
      <th>Amount</th>
      <th>Order status</th>
      <th>Action</th>
      </tr>
      </thead>

      <tbody>
         <?php  
         if(!empty($today_order))
         {    
            foreach($today_order as $row)
            { ?>

            <tr>
             <td><?php echo $row['order_master_id']?></td>
             <td><?php echo $row['display_order_id']?></td>
             <td>
               <?php $now = date('l dS \o\f F Y ,  h:i:s' ,strtotime($row['order_datetime'])); echo $now;  ?>
               
             </td>
             <td><?php echo $row['net_total']?></td>
             <td><?php echo $row['order_status']?></td>

             <td class="actions">


             <a href="<?php echo base_url();?>en/admin/orders/view/<?php echo $row['order_master_id']?>" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float " role="button">
               <i class="glyphicon glyphicon-eye-open"></i>
              </a>
             </td>
            </tr>
         <?php } }else{ ?>
            <tr class="text-center text-danger"><td colspan="6">No Order Found</td></tr>
         <?php } ?>
      </tbody>
   </table>
</div>

<hr>

<div class="">
   <h3 class="abu">Top Sold Products</h3> 
   <?php if(count($top_selled)>8){ ?>
   <a class="btn btn-info top_view" href="<?php echo base_url('admin/dashbord/all_topsold'); ?>">View All</a>
   <div class="clear"></div>
   <?php } ?>
   <?php if(!empty(@$top_selled))
   {  
      $top=0;    
      for($i = count($top_selled) - 1; $i >= 0; $i--)
      { 
        
        $product_image=explode("/",$top_selled[$i]['product_image']);
        $product_image=count($product_image);
        if ($product_image==1) 
        {
         $image_url=base_url("assets/admin/products/").$top_selled[$i]['product_image'];
        }else{
         $image_url=$top_selled[$i]['product_image'];  
        }
        
          $pro_url=$language.'/admin/product/edit/';
              
          if (@$top_selled[$i]['product_name'])
          {
         ?>

      <div class="col-sm-3">
         <div class="thumbnail card top_seling_sectn">
            <div class="header pading_top_header header_with_desrctpn">
               <h3 class="p_name_h3">Product <?php echo ' Sold '.$top_selled[$i]['pro_count'].' times .'; ?> </h3> 
               <span class="top_country"></span>
               <p class="p_name"><?php echo $top_selled[$i]['product_name']; ?></p>
               <div class="clear"></div>
            </div>            
            <a href="<?Php echo base_url().$pro_url.$top_selled[$i]['product_id']; ?>"><img class="images top_seling_img" src="<?php echo $image_url; ?>"></a>
         </div>
      </div>
   <?php }
      if($top==8)
      {
        break;
      }
      $top++;
    } }else{
      echo "<h3 class='abu'>No Order Found yet</h3>";      
      }  ?>
</div>

<!-- <hr> -->
<div class="" >
   <div class="col-lg-12">
      <h3 class="abu">Weekly Total payment</h3> 
         <!-- Styles -->
         <style>
         #chartdiv {
           width: 100%;
           height: 500px;
         }
         </style>
         <!-- Resources -->
         <script src="https://www.amcharts.com/lib/4/core.js"></script>
         <script src="https://www.amcharts.com/lib/4/charts.js"></script>
         <script src="https://www.amcharts.com/lib/4/themes/material.js"></script>
         <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
         <!-- Chart code -->
         <script>
         am4core.ready(function()
         {
         // Themes begin
         am4core.useTheme(am4themes_material);
         am4core.useTheme(am4themes_animated);
         // Themes end
         // Create chart instance
         var chart = am4core.create("chartdiv", am4charts.XYChart);
         chart.scrollbarX = new am4core.Scrollbar();
         // Add data
         chart.data = [{
           "country": "<?php echo date('Y-m-d',strtotime("-14 days")) ?>",
           "visits": <?php echo $day14; ?>
         }, {
           "country": "<?php echo date('Y-m-d',strtotime("-13 days")) ?>",
           "visits": <?php echo $day13; ?>
         }, {
           "country": "<?php echo date('Y-m-d',strtotime("-12 days")) ?>",
           "visits": <?php echo $day12; ?>
         }, {
           "country": "<?php echo date('Y-m-d',strtotime("-11 days")) ?>",
           "visits": <?php echo $day11; ?>
         }, {
           "country": "<?php echo date('Y-m-d',strtotime("-10 days")) ?>",
           "visits": <?php echo $day10; ?>
         }, {
           "country": "<?php echo date('Y-m-d',strtotime("-9 days")) ?>",
           "visits": <?php echo $day9; ?>
         }, {
           "country": "<?php echo date('Y-m-d',strtotime("-8 days")) ?>",
           "visits": <?php echo $day8; ?>
         }, {
           "country": "<?php echo date('Y-m-d',strtotime("-7 days")) ?>",
           "visits": <?php echo $day7; ?>
         }, {
           "country": "<?php echo date('Y-m-d',strtotime("-6 days")) ?>",
           "visits": <?php echo $day6; ?>
         }, {
           "country": "<?php echo date('Y-m-d',strtotime("-5 days")) ?>",
           "visits": <?php echo $day5; ?>
         }, {
           "country": "<?php echo date('Y-m-d',strtotime("-4 days")) ?>",
           "visits": <?php echo $day4; ?>
         }, {
           "country": "<?php echo date('Y-m-d',strtotime("-3 days")) ?>",
           "visits": <?php echo $day3; ?>
         }, {
           "country": "<?php echo date('Y-m-d',strtotime("-2 days")) ?>",
           "visits": <?php echo $day2; ?>
         }, {
           "country": "<?php echo date('Y-m-d',strtotime("-1 days")) ?>",
           "visits": <?php echo $day1; ?>
         }, {
           "country": "<?php echo date("Y-m-d"); ?>",
           "visits": <?php echo $day; ?>
         }];
         // Create axes
         var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
         categoryAxis.dataFields.category = "country";
         categoryAxis.renderer.grid.template.location = 0;
         categoryAxis.renderer.minGridDistance = 30;
         categoryAxis.renderer.labels.template.horizontalCenter = "right";
         categoryAxis.renderer.labels.template.verticalCenter = "middle";
         categoryAxis.renderer.labels.template.rotation = 270;
         categoryAxis.tooltip.disabled = true;
         categoryAxis.renderer.minHeight = 110;
         var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
         valueAxis.renderer.minWidth = 50;
         // Create series
         var series = chart.series.push(new am4charts.ColumnSeries());
         series.sequencedInterpolation = true;
         series.dataFields.valueY = "visits";
         series.dataFields.categoryX = "country";
         series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
         series.columns.template.strokeWidth = 0;
         series.tooltip.pointerOrientation = "vertical";
         series.columns.template.column.cornerRadiusTopLeft = 10;
         series.columns.template.column.cornerRadiusTopRight = 10;
         series.columns.template.column.fillOpacity = 0.8;
         // on hover, make corner radiuses bigger
         var hoverState = series.columns.template.column.states.create("hover");
         hoverState.properties.cornerRadiusTopLeft = 0;
         hoverState.properties.cornerRadiusTopRight = 0;
         hoverState.properties.fillOpacity = 1;
         series.columns.template.adapter.add("fill", function(fill, target) {
           return chart.colors.getIndex(target.dataItem.index);
         });
         // Cursor
         chart.cursor = new am4charts.XYCursor();
         }); // end am4core.ready()
         </script>
         <!-- HTML -->
         <div id="chartdiv"></div>                                      

   </div>    
</div>

<!-- <hr> -->
<div class="" >
   <div class="col-lg-12">
      <h3 class="abu">All orders and users statistics </h3> 
         <!-- Styles -->
         <?php
          
         // $dataPoints = array(
         //    array("label"=> "Food + Drinks", "y"=> 590),
         //    array("label"=> "Activities and Entertainments", "y"=> 261),
         //    array("label"=> "Health and Fitness", "y"=> 158),
         //    array("label"=> "Shopping & Misc", "y"=> 72),
         //    array("label"=> "Transportation", "y"=> 191),
         //    array("label"=> "Rent", "y"=> 573),
         //    array("label"=> "Travel Insurance", "y"=> 126)
         // );
            
         ?>
         <script>
         window.onload = function () {
          
         var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            exportEnabled: true,
            title:{
               text: ""
            },
            subtitles: [{
               text: ""
            }],
            data: [{
               type: "pie",
               showInLegend: "true",
               legendText: "{label}",
               indexLabelFontSize: 16,
               indexLabel: "{label} - #percent%",
               // yValueFormatString: "฿#,##0",
               yValueFormatString: "#,##0",
               dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
         });
         chart.render();
          
         }
         </script>
         <div id="chartContainer" style="height: 370px; width: 100%;"></div>
         <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
      </div>
   </div>


<style type="text/css">
   .canvasjs-chart-toolbar {
   display: none;
   }
   .card .body .col-xs-6, .card .body .col-sm-6, .card .body .col-md-6, .card .body .col-lg-6 {
   margin-bottom: 0px!important;
   }
   h3.bh , h3.abu{
   clear: both;
   overflow: hidden;
   width: 100%;
   margin-left: 20px; 
   font-size: 18px;
    
    text-transform: uppercase;
    font-size: 20px;
   }
   img.images.top_seling_img {
   width: 100%;
   padding: 10px;
   margin: 0px;
   }
   p.p_name {
   height: 32px;
   }
   .thumbnail p:not(button) {
   color: #999999;
   font-size: 14px;
   padding: 0px;
   margin: 0px;
   }
   .header.pading_top_header.header_with_desrctpn {
   padding: 0px 10px 0px!important;
   margin: 0px;
   }
   .p_name_h3{
   clear: both;
   overflow: hidden;
   width: 100%;
   font-family: initial;
   font-size: 18px;
   }
   .top_view{
    float: right;
    margin-top: -31px;
    margin-bottom: 22px;
    margin-right: 17px;
   }
   .top_country{
    float: right;
    margin-top: -28px;
    margin-bottom: 22px;
    margin-right: 17px;
    color:#b70527;
   }
   body {
    background-color: #f1f2f700;
    /*font-family: initial;*/
}
g{
  /*display: none;*/
}

</style>
<script type="text/javascript">
     $('.js-exportable').DataTable({
        dom: 'Bfrtip',               
         "info":     false,   
        responsive: true,
        "order": [[ 0, "desc" ]],   
        "pageLength":5,
    });

</script>
<script type="text/javascript">
  $(document).ready(function(){
  $('[aria-labelledby="id-66-title"]').hide();   
});
setTimeout(function(){ 
    $('[href="https://canvasjs.com/"]').hide(); 
  }, 1000);  
</script>
