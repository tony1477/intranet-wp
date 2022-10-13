<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu"><?= lang('Files.Menu') ?></li>

                <?php foreach($modules as $module): ?>
                <li>
                    <?php if(has_permission($module->modulecode)):?>
                    <a <?=$module->moduletypeid == 1 ? "href='javascript:void(0);' class='has-arrow'" : "href=".base_url($module->url)?>">
                        <i data-feather="<?=$module->icon?>"></i>
                        <!-- <span data-key="t-dashboard"><?= lang('Files.Dashboard') ?></span> -->
                        <span data-key="t-<?=$module->modulecode?>"><?= $module->modulename?></span>
                    </a>
                    <?php endif;?>
                    <?php if(has_permission($module->modulecode)) :?>
                    <?php if($module->moduletypeid == 1): ?>
                    <ul class="sub-menu" aria-expanded="false">
                        <?php 
                            $menus = getSubmenu($module->moduleid); 
                            foreach($menus as $menu): 
                        ?>
                        <?php if($menu->isheader==1):?>
                            <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <span data-key="<?=$menu->menucode?>"><?= lang('Files.'.$menu->menucode) ?></span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <?php
                                    $submenus = getDetailMenu($menu->idmenu);
                                    foreach($submenus as $submenu): 
                                ?>
                                <li>
                                    <a href="<?=base_url($submenu->url)?>" data-key="t-<?=$submenu->menucode?>"><?= lang('Files.'.$submenu->menucode)?></a>
                                </li>
                                <?php endforeach;?>
                            </ul>
                        </li>
                        <?php else : ?>
                        <li>
                            <a href="<?=base_url($menu->url)?>">
                                <span data-key="t-<?=$menu->menucode?>"><?=lang('Files.'.$menu->menucode)?></span>
                            </a>
                        </li>
                        <?php endif;?>
                        <?php endforeach;?>
                    </ul>
                    <?php endif;?>
                    <?php endif;?>
                </li>

                <?php endforeach;?>
            </ul>

        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->