<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link href='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.css' rel='stylesheet' media='screen'>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/jquery.dataTables.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.js'></script>
<link href='<?php echo base_url(); ?>assets/frontend/css/common.css' rel='stylesheet'  media="screen" id="color">


      <!-- <div class="g-padding-2rem"> -->
      <section class="spacing">
    <div class="row space-get margin_10">
        <div class="col-md-12">
            <div class="panel panel-default main_wrap_form">
                <div class="panel-heading">
                <?php echo lang('Collection_Inquiry'); ?>
                </div>
                <div class="panel-body">
                  <div>
                <form> 
                         <div class="form-group" style="width: 30%">
                            <label for="heading"><?php echo lang('Client_ID'); ?></label>
                            <input class="form-control space" id="client" name="client" placeholder="<?php echo lang('Enter_Client_ID'); ?>" type="text" >
                        </div>
                        <div class="form-group side_space_field" style="width: 30%">
                            <label for="heading"><?php echo lang('Scheme_ID'); ?></label>
                            <select id="Scheme" name="Scheme">
                                <option value="0" ><?php echo lang('Select_Scheme_ID'); ?></option>
                            </select>
                        </div>
                        <div class="form-group" style="width: 30%">
                            <label for="heading"><?php echo lang('Date_range'); ?></label>
                            <input class="form-control space"  placeholder="<?php echo lang('Select_Date_range'); ?>" type="text" >
                        </div>
                        <div class="form-group" style="width: 30%">
                            <label for="date_of_publish"><?php echo lang('Remitter_ID'); ?></label>
                            <input class="form-control" id="remitter" name="remitter" placeholder="<?php echo lang('Enter_Remitter_ID'); ?>" type="text">
                        </div>
                        <div class="form-group" style="width: 30%">
                            <label for="date_of_publish"><?php echo lang('Invoice_No'); ?>.</label>
                            <input class="form-control" id="remitter" name="remitter" placeholder="<?php echo lang('Enter_Invoice_No'); ?>" type="text">
                        </div>
                        <div class="form-group" style="width: 30%">
                            <label for="date_of_publish"><?php echo lang('Virtual_Acc_No'); ?>.</label>
                            <input class="form-control" id="remitter" name="remitter" placeholder="<?php echo lang('Enter_Virtual_Acc_No'); ?>" type="text">
                        </div>
                        <div class="form-group">
                            <label style="margin-bottom: 15px;" for="heading1"><?php echo lang('Payment_Status'); ?></label>
                            <div class="clear"></div>
                            <label><input style="float: left; margin-top: 1px; margin-left: 2px; margin-right: 5px;" type="radio" name="status" value="all"><?php echo lang('aAll'); ?></label>
                            <label><input style="float: left; margin-top: 1px; margin-left: 2px; margin-right: 5px; margin-left: 10px;" type="radio" name="status" value="Paid"><?php echo lang('Paid'); ?></label>
                            <label><input style="float: left; margin-top: 1px; margin-left: 2px; margin-right: 5px; margin-left: 10px;" type="radio" name="status" value="Unpaid"><?php echo lang('Unpaid'); ?></label>
                            <label><input style="float: left; margin-top: 1px; margin-left: 2px; margin-right: 5px; margin-left: 10px;" type="radio" name="status" value="partial"><?php echo lang('Partial'); ?></label>
                            <label><input style="float: left; margin-top: 1px; margin-left: 2px; margin-right: 5px; margin-left: 10px;" type="radio" name="status" value="pending deletion"><?php echo lang('Pending_deletion'); ?></label>
                        </div>
                        </form>
                        </div>
                        <div class="right">
                        <div class="ml-auto p-2 g-mb-1rem">
                       <button class="search_button"><?php echo lang('asearch'); ?></button>
                       <button class="clear_button"><?php echo lang('aclear'); ?></button>
                       </div>
                    </div>
                </div>
           </div>
       </div>
   </div>
</section>
<section class="spacing">
    <div class="row space-get margin_10">
        <div class="col-md-12">
            <div class="panel panel-default main_wrap_form">
                <div class="panel-heading">
                <?php echo lang('Collection_Inquiry'); ?>
                </div>
                <div class="panel-body">
                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
              <thead>
              <tr>
                   <th><?php echo lang('aREMITTER_ID'); ?></th>
                <th><?php echo lang('aREMITTER_NAME'); ?></th>
                <th><?php echo lang('aINVOICE_NAME'); ?></th>
                <th><?php echo lang('aINVOICE_DESCRIPTION'); ?></th>
                <th><?php echo lang('aINVOICE_NO.'); ?></th>
                <th><?php echo lang('aDUE_AMOUNT'); ?></th>
                <th><?php echo lang('aDUE_DATE'); ?></th>
                <th><?php echo lang('aCOLLECTED_AMOUNT'); ?></th>
                <th><?php echo lang('aPAYMENT_CHANNEL'); ?></th> 
  
             </tr>
             </thead>

           <tbody id="table_body">
           <tr>
                <th scope="row" class="d-flex">
                      <span id="wrap">
                        <span id="outer-circle">
                        <span class="icon"> <span id="plus"></span></span>
                        </span>
                      </span>
                      <span class="remitter_Id">766</span></th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                <td>655632</td>
                <td>3444</td>
                <td>05-05-2022</td>
                <td>6656</td>
                <td>phone pay</td>
              </tr>

          </tbody>
          </table>
               </div>
               </div>
       </div>
   </div>
</section>


  <style type="text/css">
    .search_button{
        font-weight: 500;
        background-color: #4f0381;
        color:white;
        border:none;
        border-radius:5px;
        padding:6px 12px
    }
    .clear_button{
        background-color: #44871b;
        color:white;
        font-weight: 500;
        border:none;
        border-radius:5px;
        padding:6px 12px;
        margin-right:5rem
    }
    .circle{
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: #CF6520;
    }
    #outer-circle {
   background:white;
   box-shadow: 1px 1px 4px 3px #2f2e2e25;
   border-radius: 50%;
   height: 23px;
   width: 23px;
   position: absolute;
 }
 .remitter_Id{
    padding-left: 2.5rem;
    color: #666;
    font-weight:400;
 }
 #wrap {
  display: flex;
  align-items: center;
  margin: 5px;
  cursor: pointer;
}
.icon:before {
  content: '';
  display: flex;
  justify-content: center;
  align-items: center;
  background: #385a94;
   border-radius: 50%;
   height: 19px;
   width: 19px;
  font-size: 30px;
  color: white;
  transform: translate(10%, 10%);
}
#plus:before {
  content: '+';
  font-weight: 500;
  position: absolute;
  transform: translate(97%, -87%);
  color: white;
}
.float-left-payment{
  margin-left: -1rem;
}
form select{
        width: 26.3vw;
        border:1px solid #b7b2b0;
        height: 2rem;
        border-radius: 3px;
    }
    .button {
        color: #FFFFFF;
        padding: 10px;
        border-radius: 10px;
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
    }
    
    .small-btn {
        height: 30px;
        padding: 2px 10px 2px 10px;
    }

    button.btn.btn-primary {
    clear: both;
    float: left;
    margin-left: 10px;
    }

    .alert-danger {
    background-color: #fb483a !important;
    clear: both;
    margin-bottom: -73px;
    }

    .main_wrap_form .form-group label {
    font-weight: 500;
    font-size: 15px;
    }

    .margin_20{
    margin-top: 14px;
    }
    .main_wrap_form .panel-heading{
    font-weight: 500;
    font-size: 16px;
    }
    .main_wrap_form .form-group label{
    font-weight: 500;
    font-size: 15px;
    }
    .main_wrap_form .form-control {
    box-shadow: 0px 0px 0px #fff;
    border-radius: 3px;
    font-size: 13px;
    padding: 6px 12px;
    border: 1px solid #aaaaaa;
    height: 40px;
    line-height: 40px;
    border-radius: 100px;
}
    .main_wrap_form .form-control:focus{
    border: 1px solid #bdbcbc;
    }

    .btn-primary {
    float: right;
    font-weight: 500;
    font-size: 15px!important;
    padding: 9px 20px;
    margin-top: 10px;
    border-radius: 3px !important;
    margin-bottom: 30px;
    border: 1px solid #14a988 !important;
    color: #14a988;
    background-color: white !important;
    transition-duration: 0.2s;
    }

    .alert.alert-success{
    clear: both;
    }
    .header {
    display: none;
    }

    .form-group {
    /*width: 49%;*/
    margin-bottom: 20px;
    float: left;
    margin-left: 10px;
    margin-right:2%
}
.chosen-container-single .chosen-single {
border-radius: 100px;
    background: #fff;
    box-shadow: 0px 0px 0px;
}

   </style>
