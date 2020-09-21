<!-- MENU -->
<section class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
            </button>
            <!-- lOGO TEXT HERE -->
            <div class="hidden-xs hidden-sm">
                <a href="<?php echo BASE_URL; ?>" class="navbar-brand">
                    <img class="oroszlan_logo" src="<?php echo VIEWS_URL; ?>images/oroszlan_logo.jpg" />
                </a>
                <span class="logo_text">
                    <span class="logo_text_line1">Nagykőrösi Oroszlán Gyógyszertár</span>
                    <br/>
                    <i style="color: #757575;">2750 Nagykőrös, Kecskeméti út 18.</i>
                </span>
            </div>
        </div>
        <!-- MENU LINKS --> 
        <div class="collapse navbar-collapse">
                    <?php
            $mainitemscount = 4;
            if (isset($top_menu) && count($top_menu["data"]) > 0 &&
                    count($top_menu["data"][0]["menu_items"]["data"]) > $mainitemscount) {
                ?>
                <div class="dropdown more-menu-item-btn hidden-xs">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-left pull-right" aria-labelledby="dropdownMenu1">
                        <?php
                        $mi = 0;
                        foreach ($top_menu["data"][0]["menu_items"]["data"] as $menu_item) {
                            if ($mi >= $mainitemscount) {
                                ?> 
                                <li><a href="<?php echo getMenuItemURL($menu_item); ?>" class="smoothScroll"><?php echo $menu_item["title"]; ?></a></li>
                                <?php
                            } else {
                                $mi++;
                            }
                        }
                        ?>
                    </ul>
                </div>
                <?php
            }
            ?>
            <ul style="margin-right: 0px;" class="nav navbar-nav navbar-right">
                <?php if (isset($top_menu) && count($top_menu["data"]) > 0) { ?>
                    <?php
                    $mi = 0;
                    foreach ($top_menu["data"][0]["menu_items"]["data"] as $menu_item) {
                        if ($mi < $mainitemscount) {
                            ?> 
                            <li><a href="<?php echo getMenuItemURL($menu_item); ?>" class="smoothScroll"><?php echo $menu_item["title"]; ?></a></li>
                            <?php
                        } else {
                            ?>
                            <li class="visible-xs"><a href="<?php echo getMenuItemURL($menu_item); ?>" class="smoothScroll"><?php echo $menu_item["title"]; ?></a></li>
                                <?php
                            }
                            ?>
                            <?php
                            $mi++;
                        }
                        ?>
                    <?php } ?>
            </ul>

        </div>
    </div>
</section>