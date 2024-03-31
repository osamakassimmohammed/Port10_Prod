<style type="text/css">
    .well.well-sm {
        height: 60px;
    }


    .actions .btn.bg-light-green {
        width: auto;
        border-radius: 6px;
    }


    .englsedit {

    }

    .englsedit span {
        float: left;
        font-size: 15px;
        margin-top: -2px;
        margin-left: 3px;
    }

    .englsedit i {
        float: left;
        margin-top: 6px;
    }


    .arbic_btn_a i {

    }

    .arbic_btn_a span {

    }

    .englsedit {

    }

    .bg-light-green.englsedit1 {
        background-color: #4f0381 !important;
    }

    .bg-light-green.englsedit2 {
        background-color: #ff375e !important;
    }

    .bg-light-green.englsedit3 {
        background-color: #44871b !important;
    }
</style>

<div>
    <?php if ($vendor != 1) { ?>
        <!-- <a href="<?php //echo base_url(); ?>admin/category/create" class="btn bg-light-green waves-effect"><span>Add Category </span></a> -->
    <?php } ?>
    <?php $div = $li = '';

    if (!empty($acatp) && !empty($acatp[0])) {
        $parent = $acatp[0];
        if (!empty($parent)) {
            $j = 0;
            foreach ($parent as $pkey => $pvalue) {
                // echo "<pre>";
                // print_r($pvalue);
                // echo "</pre>";
                $j++;
                $id = $pvalue->id;
                $status = $pvalue->status;
                $image = $pvalue->image;
                $display_name = $pvalue->display_name;
                $slug = $pvalue->slug;
                if (isset($jeq) && !empty($jeq)) {
                    $active = ($id == $jeq) ? "active" : "";
                } else {
                    $active = ($j == 1) ? "active" : "";
                }
                $li .= '<li role="presentation" class="' . $active . '"><a href="#f' . $slug . $id . '" data-toggle="tab">' . $display_name . '</a></li>';
                $div .= '<div role="tabpanel" class="tab-pane fade in ' . $active . '" id="f' . $slug . $id . '">';
                if ($vendor != 1) {

                    $div .= '<div class="well well-sm" >' . $display_name . '    (' . $status . ') <span class="actions">

					<a style="" href="' . base_url($language) . '/admin/category/create/category/' . $id . '" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float englsedit englsedit1" role="button"><i class="material-icons">add</i> <span> Add Category </span> </a>

					<a href="' . base_url($language) . '/admin/category/edit/' . $id . '" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float englsedit englsedit2" role="button"><i class="material-icons">edit</i> <span> Edit </span> </a>

					<a  style="" href="' . base_url($language) . '/admin/category/tedit/' . $id . '" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float arbic_btn_a englsedit3" role="button"><span>  تعديل  </span><i class="material-icons">translate</i></a>

					<a style="display:none" data-url="' . base_url($language) . '/admin/category/delete/' . $id . '" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float delete_row_re" role="button" data-type="cancel"><i class="material-icons">delete</i></a></span>


					</div>';
                }
                // <img src=" '.base_url().'/assets/admin/category/'.$image.' " alt="Smiley face" height="100" width="100">
                @$sparent = $acatp[$id];
                $sdiv = $sli = "";
                if (!empty($sparent)) {
                    $i = 0;
                    $div .= '<div class="body"><ul class="nav nav-tabs tab-nav-right" role="tablist">';
                    foreach ($sparent as $skey => $svalue) {
                        $i++;
                        $sid = $svalue->id;
                        $sdisplay_name = $svalue->display_name;
                        $slug = $svalue->slug;
                        if (isset($ieq) && !empty($ieq)) {
                            $sactive = ($sid == $ieq) ? "active" : "";
                        } else {
                            $sactive = ($i == 1) ? "active" : "";
                        }

                        $sli .= '<li role="presentation" class="' . $sactive . '"><a href="#s' . $slug . $sid . '" data-toggle="tab">' . $sdisplay_name . '</a></li>';
                        $sdiv .= '<div role="tabpanel" class="tab-pane fade in ' . $sactive . '" id="s' . $slug . $sid . '">';
                        // <a style="" href="'.base_url().'admin/category/create/category/'.$sid.'" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float " role="button"><i class="material-icons">add</i></a> to add third category
                        if ($vendor != 1) {
                            $sdiv .= '<div class="well well-sm" >' . $sdisplay_name . ' <span class="actions">


						<a href="' . base_url($language) . '/admin/category/edit/' . $sid . '" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float englsedit englsedit2" role="button"><i class="material-icons">edit</i><span> Edit </span></a>
						<a style="" href="' . base_url($language) . '/admin/category/tedit/' . $sid . '" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float arbic_btn_a englsedit3" role="button"><span> تعديل </span> <i class="material-icons">translate</i></a>

						<a style="display:none" data-url="' . base_url($language) . '/admin/category/delete/' . $sid . '" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float delete_row_re" role="button" data-type="cancel"><i class="material-icons">delete</i></a></span></div>';
                        }
                        if (isset($acatp[$sid])) {
                            $tparent = $acatp[$sid];
                            if (!empty($tparent)) {
                                $sdiv .= '<ul class="list-group" style="margin-left: 5%;">';
                                foreach ($tparent as $tkey => $tvalue) {
                                    $sdiv .= '<li class="list-group-item" >' . $tvalue->display_name;
                                    if ($vendor != 1) {
                                        $sdiv .= ' <span class="actions"> <a href="' . base_url() . 'admin/category/edit/' . $tvalue->id . '" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float " role="button"><i class="material-icons">edit</i></a><a style="display:none" href="' . base_url() . 'admin/category/tedit/' . $tvalue->id . '" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float " role="button"><i class="material-icons">translate</i></a> <a style="display:none" data-url="' . base_url() . 'admin/category/delete/' . $tvalue->id . '" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float delete_row_re" role="button" data-type="cancel"><i class="material-icons">delete</i></a></span>';
                                    }
                                    $sdiv .= '</li>';
                                }
                                $sdiv .= "</ul>";
                            }
                        }
                        $sdiv .= '</div>';
                    }
                    $div .= $sli . '</ul><div class="tab-content">' . $sdiv;
                    $div .= '</div></div>';
                }
                $div .= '</div>';
            }
        }
        ?>
        <div class="body">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <?php echo $li; ?>
            </ul>
            <div class="tab-content">
                <?php echo $div; ?>
            </div>
        </div>
    <?php } ?>
</div>

<style type="text/css">
    span.actions {
        display: inline-block;
        float: right;
    }

    .list-group-item {
        display: block;
        width: 100%;
        padding: 5px 10px 25px;
    }

    .bg-light-green {
        background-color: #ad0425 !important;
    }

    .card {
        width: 100%;
    }
</style>
