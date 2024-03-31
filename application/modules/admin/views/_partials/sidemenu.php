<?php //echo "<pre>"; print_r($menu); echo "</pre>";  ?>
<?php //echo "<pre>"; print_r($sub_seller_menu); echo "</pre>";  ?>
<div class="menu">
    <ul class="list">
        <?php
        if ($user->type != 'subsupplier') {
            foreach ($menu as $parent => $parent_params): ?>

                <?php if (empty($page_auth[$parent_params['url']]) || $this->ion_auth->in_group($page_auth[$parent_params['url']])): ?>
                    <?php if (empty($parent_params['children'])): ?>

                        <?php $active = ($current_uri == $parent_params['url'] || $ctrler == $parent); ?>
                        <li class='<?php if ($active) echo 'active'; ?>'>
                            <a href='<?php echo $parent_params['url']; ?>'>
                                <i class='material-icons'><?php echo $parent_params['icon']; ?></i>
                                <span><?php echo lang($parent_params['name']); ?></span>
                            </a>
                        </li>

                    <?php else: ?>

                        <?php $parent_active = ($ctrler == $parent); ?>
                        <li class='<?php if ($parent_active) echo 'active'; ?>'>
                            <a href='javascript:void(0);' class="menu-toggle">
                                <i class='material-icons'><?php echo $parent_params['icon']; ?></i>
                                <span><?php echo $parent_params['name']; ?></span>
                            </a>
                            <ul class='ml-menu'>
                                <?php foreach ($parent_params['children'] as $name => $url): ?>
                                    <?php if (empty($page_auth[$url]) || $this->ion_auth->in_group($page_auth[$url])): ?>
                                        <?php $child_active = ($current_uri == $url); ?>
                                        <li <?php if ($child_active) echo 'class="active"'; ?>>
                                            <a href='<?php echo $url; ?>'>
                                                <!-- <i class='material-icons'>
										<?php if ($child_active) {
                                                    echo 'label';
                                                } else {
                                                    echo "label_outline";
                                                } ?></i> -->
                                                <span><?php echo $name; ?></span>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </li>

                    <?php endif; ?>
                <?php endif; ?>

            <?php endforeach; ?>
        <?php } else {
            $is_access = array();
            $access_permission = $user->access_permission;
            if (!empty($access_permission)) {
                $is_access = explode(",", $access_permission);
            }
            array_push($is_access, "panel", "dashbord");
            foreach ($sub_seller_menu as $parent => $parent_params): ?>

                <?php
                if (in_array($parent_params['flag'], $is_access)) {
                    if (empty($parent_params['children'])) { ?>

                        <?php $active = ($current_uri == $parent_params['url'] || $ctrler == $parent); ?>
                        <li class='<?php if ($active) echo 'active'; ?>'>
                            <a href='<?php echo $parent_params['url']; ?>'>
                                <i class='material-icons'><?php echo $parent_params['icon']; ?></i>
                                <span><?php echo lang($parent_params['name']); ?></span>
                            </a>
                        </li>

                    <?php }
                } ?>
            <?php endforeach;
        } ?>
        <br>
        <br>
        <br>
        <!-- <li class="header"></li> -->
        <li>
            <a style=" color: white;"
               href="<?php echo base_url($language . '/admin/panel/logout') ?>">
                <i class="material-icons">input</i> <i
                    style="margin-left: 10px;margin-top: 7px;"
                    class="material-icons-o text-aqua"><?php echo lang('Sign_Out'); ?></i>
            </a>
        </li>
        <li style="">
            <a style="    color: white;" href="<?php echo base_url($language) ?>"
               target='_blank'>
                <i class="material-icons">web</i> <i
                    style="   margin-top: 7px; margin-left: 10px;"
                    class="material-icons-o text-aqua"><?php echo lang('Back_To_Website'); ?></i>
            </a>
        </li>

    </ul>
</div>
