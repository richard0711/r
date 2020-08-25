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
            <ul class="nav navbar-nav navbar-right">
                <?php if(isset($top_menu)) { ?>
                    <?php 
                        foreach ($top_menu["data"] as $menu) { 
                            foreach ($menu["menu_items"]["data"] as $menu_item) { 
                    ?>
                        <li><a href="<?php echo getMenuItemURL($menu_item); ?>" class="smoothScroll"><?php echo $menu_item["title"]; ?></a></li>
                    <?php 
                            }
                       } 
                    ?>
                <?php } ?>
                <!--                
                <li><a href="#top" class="smoothScroll">Főoldal</a></li>
                <li><a href="#about" class="smoothScroll">Rólunk</a></li>
                <li><a href="#team" class="smoothScroll">Szolgáltatásaink</a></li>
                <li><a href="#news" class="smoothScroll">Aktualitások</a></li>
                <li><a href="#appointment" class="smoothScroll">Elérhetőségeink</a></li>
                -->
            </ul>
        </div>
    </div>
</section>