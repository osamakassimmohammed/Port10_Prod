<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link href='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.css' rel='stylesheet' media='screen'>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/jquery.dataTables.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.js'></script>
<link href='<?php echo base_url(); ?>assets/frontend/css/common.css' rel='stylesheet'  media="screen" id="color">

<section class="spacing">
    <div class="row space-get margin_10">
        <div class="col-md-12">
            <div class="panel panel-default main_wrap_form">
                <div class="panel-heading">
                Remitter Details
                </div>
                <div class="panel-body">
                <form> 
                         <div class="form-group" style="width: 30%">
                            <label for="heading">Client ID:<span class="required">*</span></label>
                            <input class="form-control space" id="client" name="client" placeholder="Client ID" type="text" >
                        </div>
                        <div class="form-group" style="width: 30%">
                            <label for="heading">Scheme ID:<span class="required">*</span></label>
                            <input class="form-control space" id="scheme" name="scheme" placeholder="Scheme ID" type="text" >
                        </div>
                        <div class="form-group" style="width: 30%">
                            <label for="heading">Remitter ID:</label>
                            <input class="form-control space" id="remitter" name="remitter" placeholder="Remitter ID" type="text" >
                        </div>
                        <div class="form-group" style="width: 30%">
                            <label for="heading">Remitter A/c:<span class="required">*</span></label>
                            <input class="form-control space" id="remitter" name="remitter" placeholder="Remitter A/c" type="text" >
                        </div>
                        <div class="form-group" style="width: 30%">
                            <label for="heading">Start Date:<span class="required">*</span></label>
                            <input class="form-control space" id="startdate" name="startdate" placeholder="Select Start Date" type="text" >
                        </div>
                        <div class="form-group side_space" style="width: 30%">
                            <label for="heading">Language Code:<span class="required">*</span></label>
                            <select id="Scheme" name="Scheme">
                                <option value="0" >English</option>
                            </select>
                        </div>
                        <div class="form-group" style="width: 30%">
                            <label for="heading">Remitter Name:<span class="required">*</span></label>
                            <input class="form-control space" id="remittername" name="remittername" placeholder="Remitter Name" type="text" >
                        </div>
                        <div class="form-group" style="width: 30%">
                            <label for="heading">Remitter Name (Arabic):<span class="required">*</span></label>
                            <input class="form-control space" id="remitternamearab" name="remitternamearab" placeholder="Remitter Name (Arabic)" type="text" >
                        </div>
                        <div class="form-group" style="width: 30%">
                            <label for="heading">Remitter Address:</label>
                            <input class="form-control space" id="remitteraddress" name="remitteraddress" placeholder="Remitter Address" type="text" >
                        </div>
                        <div class="form-group" style="width: 30%">
                            <label for="heading">Email:<span class="required">*</span></label>
                            <input class="form-control space" id="email" name="email" placeholder="Email" type="text" >
                        </div>
                        <div class="form-group side_space" style="width: 30%">
                            <label for="heading">Status:<span class="required">*</span></label>
                            <select id="status" name="status">
                                <option value="0" >Active</option>
                            </select>
                        </div>
                        <div class="form-group" style="width: 30%">
                            <label for="heading">Mobile No:<span class="required">*</span></label>
                            <input class="form-control space" id="mobile" name="mobile" placeholder="Mobile No" type="text" >
                        </div>
                        <div class="form-group" style="width: 30%">
                            <label style="margin-bottom: 15px;" for="heading1">Invoice Notification:<span class="required">*</span></label>
                            <div class="clear"></div>
                            <label><input style="float: left; margin-top: 1px; margin-left: 2px; margin-right: 5px;" type="radio" name="status" value="all">Email</label>
                            <label><input style="float: left; margin-top: 1px; margin-left: 2px; margin-right: 5px; margin-left: 10px;" type="radio" name="status" value="Paid">SMS</label>
                            <label><input style="float: left; margin-top: 1px; margin-left: 2px; margin-right: 5px; margin-left: 10px;" type="radio" name="status" value="Unpaid">Both</label>
                            <label><input style="float: left; margin-top: 1px; margin-left: 2px; margin-right: 5px; margin-left: 10px;" type="radio" name="status" value="partial">No Notification</label>
                        </div>
                        <div class="form-group" style="width: 30%">
                            <label for="heading">National/Iqamma ID:</label>
                            <input class="form-control space" id="national" name="national" placeholder="National/Iqamma ID" type="text" >
                        </div>
                        <div class="form-group" style="width: 30%">
                            <label for="heading">ID Expiry Date:</label>
                            <input class="form-control space" id="expiry" name="expiry" placeholder="ID Expiry Date" type="text" >
                        </div>
                </form>
                <div class="right">
                        <div class="ml-auto p-2 g-mb-1rem">
                       <button class="search_button">Back</button>
                       <button class="clear_button">Save</button>
                       </div>
                    </div>
       </div>
                </div>
   </div>
</section>


<style type="text/css">
      .required{
        color: red;
    }
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