<style type="text/css">
    .home_active {
        font-weight: 600 !important;
        color: #c09550 !important;
    }

    .contnr_main_headr.hedr_fixed {
        position: static;
        box-shadow: 0px 0px 0px #fff;
    }
</style>


<!-- breadcrumb End -->
<!--section start-->
<!-- section start -->
<!--section start-->
<section class="faq-section section-b-space new_help_sectn">
    <div class="container contr_width">
        <div class="row">
            <div class="col-sm-6">
                <?Php if ($faq_data) { ?>
                    <div class="title1 section-t-sspace">
                        <!-- <h4>exclusive products</h4>   class="collapse show"  aria-labelledby-->
                        <h2 class="title-inner1"><?php echo lang('Frequently_Asked_Questions'); ?></h2>
                    </div>
                    <div class="accordion theme-accordion" id="accordionExample">

                        <?php foreach ($faq_data as $fad_key => $fad_val) { ?>
                            <div class="card">
                                <div class="card-header"
                                     id="heading<?php echo $fad_val['id']; ?>">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" type="button"
                                                data-toggle="collapse"
                                                data-target="#collapse<?php echo $fad_val['id']; ?>"
                                                aria-expanded="true"
                                                aria-controls="collapse<?php echo $fad_val['id']; ?>"><?php echo $fad_val['question']; ?></button>
                                    </h5>
                                </div>
                                <div id="collapse<?php echo $fad_val['id']; ?>"
                                     class="collapse"
                                     aria-labelledby="heading<?php echo $fad_val['id']; ?>"
                                     data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p><?php echo $fad_val['answer']; ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                <?php } else { ?>
                    <h2 class="text-danger text-center"><?php echo lang('faq_not_found'); ?></h2>
                <?php } ?>
            </div>


            <div class="col-sm-6">
                <?php if (!empty($tutorial_data)) { ?>
                    <div class="title1 section-t-sspace">
                        <!-- <h4>exclusive products</h4> -->
                        <h2 class="title-inner1"><?php echo lang('TUTORIALS'); ?></h2>
                    </div>
                    <div class="sectn_tutorial_as">
                        <?php foreach ($tutorial_data as $tud_key => $tud_val) { ?>
                            <div class="singl_tutorl_wrap">
                                <div class="singl_img_tutrl">
                                    <div class="tutorl_title">
                                        <?php echo $tud_val['heading']; ?>
                                    </div>
                                    <video class="tutoril_img" controls>
                                        <source
                                            src="<?php echo base_url('assets/admin/banner/') . $tud_val['video']; ?>"
                                            type="video/mp4">
                                    </video>
                                    <div class="tutorl_text">
                                        <?php echo $tud_val['description']; ?>
                                    </div>

                                </div>
                            </div>
                        <?php } ?>

                    </div>

                <?Php } else { ?>
                    <h2 class="text-danger text-center"><?php echo lang('Tutorials_not_found'); ?></h2>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<!--Section ends-->
