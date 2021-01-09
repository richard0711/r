<!-- MENU -->
<section class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
            </button>
        </div>
        <!-- MENU LINKS --> 
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul style="margin-right: 0px;" class="nav navbar-nav navbar-right">
                <?php if (isset($top_menu) && count($top_menu["data"]) > 0) { ?>
                    <?php
                    foreach ($top_menu["data"][0]["menu_items"]["data"] as $menu_item) {
                        if ($menu_item["childs"]["count"] > 0) {
                            ?>
                            <li class="nav-item dropdown">
                                <a href="javascript:void(0);" 
                                   class="smoothScroll nav-link dropdown-toggle" 
                                   data-toggle="dropdown" 
                                   role="button" 
                                   aria-haspopup="true" 
                                   aria-expanded="false"><?php echo $menu_item["title"]; ?></a>
                                <ul style="right: auto !important;" class="dropdown-menu">
                                    <?php
                                    foreach ($menu_item["childs"]["data"] as $smenu_item) {
                                        if ($smenu_item["childs"]["count"] > 0) {
                                            ?>
                                            <li>
                                                <a href="javascript:void(0);" class="smoothScroll dropdown-item" data-toggle="dropdown"><?php echo $smenu_item["title"]; ?></a>
                                                <ul class="submenu dropdown-menu">
                                                    <?php foreach ($smenu_item["childs"]["data"] as $tmenu_item) { ?>
                                                        <li><a href="<?php echo getMenuItemURL($tmenu_item); ?>" class="smoothScroll dropdown-item"><?php echo $tmenu_item["title"]; ?></a></li>
                                                    <?php } ?>
                                                </ul>
                                            </li>
                                        <?php } else { ?>
                                            <li><a href="<?php echo getMenuItemURL($smenu_item); ?>" class="smoothScroll dropdown-item"><?php echo $smenu_item["title"]; ?></a></li>
                                        <?php } ?>
                                    <?php } ?>
                                </ul>
                            </li>
                            <?php
                        } else {
                            ?> 
                            <li class="nav-item"><a href="<?php echo getMenuItemURL($menu_item); ?>" class="smoothScroll nav-link"><?php echo $menu_item["title"]; ?></a></li>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
            </ul>

        </div>
    </div>
</section>