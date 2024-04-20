
<ul class="menu-stuct-ul">
    <?php foreach ($menu_items["data"] as $menu_item) { ?> 
            <li class="">
                <a href="<?php echo FULL_BASE_URL . 'menu/edit/' . $menu_item["idmenu"] . '/' . $menu_item["idmenu_item"]; ?>" 
                   class=""
                   data-toggle="tooltip" title="Menüpont szerkesztése">
                    <?php echo $menu_item["title"]; ?>
                </a>
                <?php if ($menu_item["childs"]["count"] == 0 && $menu_item["idcontent"] > 1) { ?>
                        <div class="btn-group">
                            <a href="<?php echo FULL_BASE_URL . 'content/edit/' . $menu_item["idcontent"]; ?>" 
                               data-toggle="tooltip" title="Hivatkozott tartalom szerkesztése" class="" role="button">
                                <i class="fas fa-file fa-sm"></i>
                            </a> 
                        </div>
                <?php } else if ($menu_item["childs"]["count"] == 0 && $menu_item["idgallery"] > 1) { ?>
                        <div class="btn-group">
                            <a href="<?php echo FULL_BASE_URL . 'gallery/edit/' . $menu_item["idgallery"]; ?>" 
                               data-toggle="tooltip" title="Hivatkozott galéria szerkesztése" class="" role="button">
                                <i class="fas fa-fw fa-images"></i>
                            </a> 
                        </div>
                <?php } else if ($menu_item["childs"]["count"] == 0 && $menu_item["idnews"] > 1) { ?>
                        <div class="btn-group">
                            <a href="<?php echo FULL_BASE_URL . 'news/edit/' . $menu_item["idnews"]; ?>" 
                               data-toggle="tooltip" title="Hivatkozott hír szerkesztése" class="" role="button">
                                <i class="fas fa-fw fa-newspaper"></i>
                            </a> 
                        </div>
                <?php } ?>
                <?php if ($menu_item["childs"]["count"] > 0) { ?>
                    <?php 
                        $this->load->view('pages/menu/menu_struct', 
                            array(
                                'menu_items' => $menu_item["childs"]
                            )
                        );
                    ?>
                <?php } ?>
            </li>
    <?php } ?>
</ul>