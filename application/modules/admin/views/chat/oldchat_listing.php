<style type="text/css">
    .home_active {
        font-weight: 600 !important;
        color: #c09550 !important;
    }

    .contnr_main_headr.hedr_fixed {
        position: static;
        box-shadow: 0px 0px 0px #fff;
    }

    /*______________CHAT_UI________________*/
    .container {
        max-width: 1170px;
        margin: auto;
    }

    img {
        max-width: 100%;
    }

    .inbox_people {
        background: #f8f8f8 none repeat scroll 0 0;
        float: left;
        overflow: hidden;
        width: 100%;
        border-right: 1px solid #c4c4c4;
    }

    .inbox_msg {
        border: 1px solid #c4c4c4;
        clear: both;
        overflow: hidden;
    }

    .top_spac {
        margin: 20px 0 0;
    }

    .recent_heading {
        float: left;
        width: 40%;
    }

    .srch_bar {
        display: inline-block;
        text-align: right;
        width: 60%;
        padding:
    }

    .headind_srch {
        padding: 10px 29px 10px 20px;
        overflow: hidden;
        border-bottom: 1px solid #c4c4c4;
    }

    .recent_heading h4 {
        color: #004670;
        font-size: 21px;
        margin: 5px 0px;
        font-size: 24px;
        font-weight: 500;
        letter-spacing: 0px;
        line-height: 26px;
    }

    .srch_bar input {
        border: 1px solid #cdcdcd;
        border-width: 0 0 1px 0;
        width: 80%;
        padding: 2px 0 4px 6px;
        background: none;
    }

    .srch_bar .input-group-addon button {
        background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
        border: medium none;
        padding: 0;
        color: #707070;
        font-size: 18px;
    }

    .srch_bar .input-group-addon {
        margin: 0 0 0 -27px;
    }

    .chat_ib h5 {
        font-size: 18px;
        color: #004670;
        margin: 0 0 8px 0;
        font-weight: 600;
        letter-spacing: 0px;
        margin-bottom: 3px;
    }

    .chat_ib h5 span {
        font-size: 13px;
        float: right;
    }

    .chat_ib p {
        font-size: 14px;
        color: #565656;
        margin: auto;
        display: inline-block;
        width: 100%;
        line-height: 19px;
        font-weight: 500;
    }

    .chat_img {
        float: left;
        width: 7%;
    }

    .chat_ib {
        float: left;
        padding: 0 0 0 15px;
        width: 93%;
    }

    .chat_people {
        overflow: hidden;
        clear: both;
    }

    .chat_list {
        border-bottom: 1px solid #c4c4c4;
        margin: 0;
        padding: 15px 16px 13px;
    }

    .inbox_chat {
        height: 550px;
        overflow-y: scroll;
    }

    .active_chat {
        background: #ebebeb;
    }

    .incoming_msg_img {
        display: inline-block;
        width: 6%;
    }

    .received_msg {
        display: inline-block;
        padding: 0 0 0 10px;
        vertical-align: top;
        width: 92%;
    }

    .received_withd_msg p {
        background: #ebebeb none repeat scroll 0 0;
        border-radius: 3px;
        color: #646464;
        font-size: 14px;
        margin: 0;
        padding: 10px 10px 10px 12px;
        width: 100%;
        font-weight: 500;
        line-height: 18px;
    }

    .time_date {
        color: #747474;
        display: block;
        font-size: 12px;
        margin: 8px 0 0;
    }

    .received_withd_msg {
        width: 57%;
    }

    .mesgs {
        float: left;
        padding: 30px 15px 0 25px;
        width: 60%;
    }

    .sent_msg p {
        background: #05728f none repeat scroll 0 0;
        border-radius: 3px;
        font-size: 14px;
        margin: 0;
        color: #fff;
        padding: 10px 10px 10px 12px;
        width: 100%;
        font-weight: 500;
        line-height: 18px;
    }

    .outgoing_msg {
        overflow: hidden;
        margin: 26px 0 26px;
    }

    .sent_msg {
        float: right;
        width: 46%;
    }

    .input_msg_write input {
        background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
        border: medium none;
        color: #4c4c4c;
        font-size: 15px;
        min-height: 48px;
        width: 100%;
        background: #f8f8f8;
        padding: 0px;
        margin-top: 5px;
        border-radius: 100px;
        padding: 0px 19px;
        font-weight: 500;
        margin-bottom: 00px;
        outline: none !important;
    }

    .type_msg {
        border-top: 0px solid #c4c4c4;
        position: relative;
    }

    .msg_send_btn {
        background: #45b955 none repeat scroll 0 0;
        border: medium none;
        border-radius: 50%;
        color: #fff;
        cursor: pointer;
        font-size: 17px;
        height: 33px;
        position: absolute;
        right: 0;
        top: 11px;
        width: 33px;
        margin-right: 12px;
    }

    .messaging {
        padding: 0 0 50px 0;
    }

    .msg_history {
        height: 516px;
        overflow-y: auto;
    }

    .messaging {
        padding: 0px 150px;
    }

    .chat_list {
        display: inline-block;
        width: 100%;
    }

    .wrap_btns_newmsg {
        float: left;
        width: 100%;
        margin-top: -30px;
        margin-bottom: 20px;
    }

    .contc_suplier .modal-dialog {
        max-width: none;
        width: 700px;
    }

    .contc_suplier .modal-content {
        border: 0px;
        border-radius: 0px;
    }

    .contc_suplier .modal-header {
        background: #004670;
        border-radius: 0px;
        color: #fff;
    }

    .contc_suplier .close {
        opacity: 1;
        text-shadow: 0px 0px;
        color: #ff7676;
        float: right;
        margin-top: -20px;
        margin-bottom: 19px;
    }

    .contc_suplier label {
        margin-bottom: 2px;
        margin-left: 5px;
        font-weight: 600;
    }

    .contc_suplier .form-control {
        font-size: 14px;
        font-weight: 500;
        border-radius: 100px;
        box-shadow: 0px 0px 0px;
    }

    .contc_suplier .message_text_are {
        border-radius: 12px !important;
    }


    .chosen-single {
        border: 1px solid #cccccc !important;
        height: 34px !important;
        line-height: 32px !important;
        background: #fff !important;
        border-radius: 100px !important;
        box-shadow: 0px 0px 0px !important;
        padding: 00px 14px !important;
        font-size: 13px;
    }

    .chosen-container-single .chosen-single div b {
        background-position: 1px 6px !important;
    }

    .contc_suplier .col-md-12 .btn {
        padding: 9px 40px;
        border-radius: 100px;
        font-size: 17px;
        margin-top: 20px;
        box-shadow: 0px 0px 0px;
        font-weight: 500;
        text-transform: uppercase;
        background: #004670;
        float: right;
        margin-top: -2px;
        color: #fff;
    }

    .contc_suplier .col-md-12 .btn:hover {
        background: #043a5a;
    }

    .mesg_lablas {
        margin-top: 10px;
    }

    .cont_supl_btn {
        float: left;
        background: #004670;
        padding: 10px 20px;
        border-radius: 100px;
        font-weight: 600;
        font-size: 17px;
        cursor: pointer;
        color: #fff;
        margin-right: 12px;
        margin-top: 10px;
    }

    .cont_supl_btn:hover {
        background: #03324e;
    }

    .subject_wrp {
        margin-top: 0px;
        float: left;
        width: 100%;
        margin-bottom: 4px;
    }

    .subject_titl {
        float: left;
        font-size: 14px;
        font-weight: 600;
        color: #004670;
        width: 80px;
    }

    .subject_text {
        float: left;
        font-size: 14px;
        margin-left: 5px;
        font-size: 14px;
        color: #9e9e9e;
        font-weight: 500;
        width: 80%;
        padding-left: 12px;
        line-height: 20px;
    }

    .clear {
        clear: both;
    }

    .subject_titl span {
        float: right;
    }


    .chosen-container-single .chosen-drop {
        margin-top: 0px;
        border-radius: 0 0 4px 4px;
        background-clip: padding-box;
        border: 0px solid #cccccc;
        background: #f7f7f7;
    }

    .chosen-container-single .chosen-search input[type="text"] {
        background-color: #fff;
        margin-top: 10px;
    }

</style>
<!-- breadcrumb start -->
<!-- breadcrumb End -->
<!--section start-->
<!-- section start -->
<?Php
// echo "<pre>";
//   print_r($vender_info);
//   die;

?>
<div class="modal fade contc_suplier" id="contc_id" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Contact Supplier
                </h4>
                <button type="button" class="close" data-dismiss="modal">×</button>

            </div>
            <div class="modal-body">
                <form class="theme-form" id="compose_form" method="post"
                      enctype="multipart/form-data">
                    <div class="form-row">

                        <div class="col-md-6">
                            <label for="name">To</label>
                            <!-- <input type="text" class="form-control" placeholder="To"> -->
                            <select class="singl_input_qutn" name="user_id"
                                    id="cseller_id">
                                <option value="0">Please Select Vendor</option>
                                <?php if (!empty($all_user_data))
                                    echo $append_option;
                                {
                                    if ($seller_id == 1) {
                                        foreach ($all_user_data as $aud_key => $aud_val) { ?>
                                            <option
                                                send_to="<?php echo $aud_val['send_to']; ?>"
                                                value="<?php echo $aud_val['id']; ?>"><?php echo $aud_val['first_name']; ?></option>

                                        <?php }
                                    }
                                } ?>
                            </select>

                        </div>
                        <div class="col-md-6">
                            <label for="email">Subject</label>
                            <input type="text" class="form-control space" name="subject"
                                   id="csubject" placeholder="Subject">
                        </div>

                        <div class="col-md-12 mesg_lablas">
                            <label for="inq_message">Message</label>
                            <textarea class="form-control message_text_are space"
                                      placeholder="Wrire Your Message" rows="6"
                                      id="cmessage" name="message"></textarea>
                        </div>


                        <div class="col-md-12">
                            <button class="btn btn-solid" type="submit">Send</button>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </form>
            </div>
        </div>

    </div>
</div>


<section class="section-b-space">
    <div class="container container_detl_wdth container_detl_wdth_checkOut">
        <div class="containera">
            <div class="messaging">
                <div class="wrap_btns_newmsg">
                    <div class="cont_supl_btn" data-toggle="modal"
                         data-target="#contc_id">
                        <i class="fa fa-plus" aria-hidden="true"></i> Compose
                    </div>
                </div>
                <div class="inbox_msg">
                    <div class="inbox_people">
                        <div class="headind_srch">
                            <div class="recent_heading">
                                <h4>Inbox</h4>
                            </div>
                        </div>
                        <div class="inbox_chat" id="append_compose">
                            <?php if (!empty($user_data)) {
                                if ($user_data[0]['status'] == true) {
                                    if (!empty($user_data[0]['compose_data'])) {
                                        foreach ($user_data[0]['compose_data'] as $cd_key => $cd_val) { ?>

                                            <a href="<?php echo base_url('admin/chat/detail/') . $cd_val['id']; ?>"
                                               class="chat_list"
                                               id="compose<?php echo $cd_val['id']; ?>">
                                                <div class="chat_people">
                                                    <div class="chat_img"><img
                                                            src="https://ptetutorials.com/images/user-profile.png"
                                                            alt="sunil"></div>
                                                    <div class="chat_ib">
                                                        <h5><?php echo $cd_val['first_name']; ?>
                                                            <span
                                                                class="chat_date"><?php echo date('M d', strtotime($cd_val['ccreated_date'])); ?></span>
                                                        </h5>
                                                        <div class="subject_wrp">
                                                            <div class="subject_titl">
                                                                Subject <span>:</span>
                                                            </div>
                                                            <div
                                                                class="subject_text"><?php echo $cd_val['subject']; ?>
                                                            </div>
                                                            <div class="clear"></div>
                                                        </div>
                                                        <div class="clear"></div>
                                                        <div class="subject_wrp">
                                                            <div class="subject_titl">
                                                                Message <span>:</span>
                                                            </div>
                                                            <div
                                                                class="subject_text"><?php echo $cd_val['compose_message']; ?>
                                                            </div>
                                                            <div class="clear"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        <?Php }
                                    } else { ?>
                                        <a href="javascript:void(0)"
                                           class="chat_list text-center text-danger"
                                           id="hsc_error"> No message found</a>
                                    <?php }
                                } else { ?>
                                    <a href="javascript:void(0)"
                                       class="chat_list text-center text-danger"
                                       id="hsc_error"> Your account is deactive please
                                        contact to admin</a>
                                <?php }
                            } else { ?>
                                <a href="javascript:void(0)"
                                   class="chat_list text-center text-danger"
                                   id="hsc_error"> No message found</a>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- section end -->

<script type="text/javascript">
    $(document).on("submit", "#compose_form", function (e) {
        e.preventDefault();
        var cseller_id = $("#cseller_id").val();
        var csubject = $.trim($("#csubject").val());
        var cmessage = $.trim($("#cmessage").val());
        var error = 1;
        var send_to = $('option:selected').attr('send_to');
        // $(this).find(':selected').data('id')

        if (cseller_id == '0') {
            error = 0;
            swal("", "Please select vendor", "warning");
            return false;
        }

        if (csubject == '') {
            error = 0;
            swal("", "Please enter subject", "warning");
            return false;
        }

        if (cmessage == '') {
            error = 0;
            swal("", "Please enter message", "warning");
            return false;
        }
        fd = new FormData(this);
        fd.append("send_to", send_to);
        // alert("fasdfa");
        // return false;
        if (error == 1) {
            $('#loading').show();
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('admin/chat/compose_data'); ?>",
                data: fd,
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    $('#loading').hide();
                    response = $.trim(response);
                    var response = $.parseJSON(response);
                    if (response.status == true) {
                        $("#hsc_error").hide();
                        $("#compose_form")[0].reset();
                        $('#contc_id').modal('hide');
                        swal("", response.message, 'success');
                        if (response.data == '') {
                            url = "<?php echo base_url('admin/chat'); ?>";
                            setTimeout(function () {
                                window.location = url;
                            }, 2000);
                        } else {
                            $("#append_compose").append(response.data);
                        }
                    } else {
                        swal("", response.message, 'warning');
                    }
                }
            });
        }
    });
</script>
