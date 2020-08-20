<h1 class="h3 mb-2 text-gray-800">Menü szerkesztése</h1>
<p class="mb-4">Szerkeszd a menüt</p>

<div class="form-group row">
    <div class="col-sm-12">
        <label for="menuTitle">Megnevezés</label>
        <input type="text" class="form-control" value="<?php echo $menu["title"]; ?>" id="menuTitle" placeholder="Menü megnevezése">
        <small id="menuTitleHelp" class="form-text text-danger"></small>
    </div> 
</div> 
<div class="form-group row">
    <div class="col-sm-12">
        <label for="menuSubTitle">Alcím</label>
        <input type="text" class="form-control" value="<?php echo $menu["sub_title"]; ?>" id="menuSubTitle" placeholder="Alcím">
        <small id="menuSubTitleHelp" class="form-text text-danger"></small>
    </div>
</div>
<hr/>
<h1 class="h3 mb-2 text-gray-800">Menüpontok hozzáadása a menühöz</h1>
<p class="mb-4">Add meg a menüben elérhető pontokat</p>

<div id="menuItemsHolderDiv">
    <?php
    if (isset($menu) && isset($menu["menu_items"]) && $menu["menu_items"]["count"] > 0) {
        foreach ($menu["menu_items"]["data"] as $key => $menu_item) {
            ?>
            <div data-id="<?php echo $menu_item["idmenu_item"]; ?>" data-status="1" class="form-group row menuItem">
                <div class="col-sm-5 col-xs-12">
                    <input data-id="<?php echo $menu_item["idmenu_item"]; ?>" type="text" class="form-control menuItemTitle" value="<?php echo $menu_item["title"]; ?>" id="menuItemTitle_<?php echo $menu_item["idmenu_item"]; ?>" placeholder="Menüpont megnevezése">
                </div> 
                <div class="col-sm-5 col-xs-10">
                    <input data-id="<?php echo $menu_item["idmenu_item"]; ?>" type="text" class="form-control menuItemSubTitle" value="<?php echo $menu_item["sub_title"]; ?>" id="menuItemSubTitle_<?php echo $menu_item["idmenu_item"]; ?>" placeholder="Menüpont alcíme">
                </div> 
                <div class="col-sm-2 col-xs-2">
                    <button onclick="delMenuItem(this)" class="btn btn-secondary" id="delMenuItem_<?php echo $menu_item["idmenu_item"]; ?>">
                        <i class="fas fa-trash fa-sm"></i>
                    </button>
                </div> 
            </div>
            <?php
        }
    }
    ?>
</div>

<div class="col-xs-12">
    <button onclick="addNewMenuItem()" class="btn btn-secondary" id="addNewMenuItem">
        Új menüpont hozzáadása
    </button>
</div> 

<div id="newMenuItem" style="display: none;" data-status="1" class="form-group row">
    <div class="col-sm-5 col-xs-12">
        <input data-id="0" type="text" class="form-control menuItemTitle" id="newMenuItemTitle_0" placeholder="Menüpont megnevezése">
    </div> 
    <div class="col-sm-5 col-xs-10">
        <input data-id="0" type="text" class="form-control menuItemSubTitle" id="newMenuItemSubTitle_0" placeholder="Menüpont alcíme">
    </div> 
    <div class="col-sm-2 col-xs-2">
        <button onclick="delMenuItem(this)" class="btn btn-secondary" id="delMenuItem_0">
            <i class="fas fa-trash fa-sm"></i>
        </button>
    </div> 
</div>

<div class="form-group row">
    <div class="col-sm-12 text-right">
        <small id="errorMessage" class="form-text text-danger"></small>
        <small id="successMessage" class="form-text text-success"></small>
    </div> 
</div>

<div class="text-right">
    <a onclick="save()" href="javascript:void(0);" class="btn btn-primary" role="button">
        <i class="fas fa-save fa-sm"></i>
        Mentés
    </a>
    <a href="<?php echo FULL_BASE_URL . 'menu/list'; ?>" class="btn btn-secondary" role="button">
        <i class="fas fa-cancel fa-sm"></i>
        Mégsem
    </a>
</div>

<script>
    jQuery(document).ready(function () {
        
    });
    
    function addNewMenuItem() {
        var newMenuItem = jQuery("#newMenuItem").clone();
        newMenuItem.addClass("menuItem");
        newMenuItem.css("display", "flex");
        jQuery("#menuItemsHolderDiv").append(newMenuItem);
    }
    
    function delMenuItem(item) {
        if (jQuery(item).closest(".menuItem").attr("data-status") == 1) {
            jQuery(item).closest(".menuItem").attr("data-status", 0);
            jQuery(item).addClass("text-danger");
        } else {
            jQuery(item).closest(".menuItem").attr("data-status", 1);
            jQuery(item).removeClass("text-danger");
        }
    }

    function save() {
        jQuery("#errorMessage").html('');
        jQuery("#successMessage").html('');
        var data = {
            idmenu: <?php echo $menu["idmenu"]; ?>,
            title: jQuery("#menuTitle").val(),
            sub_title: jQuery("#menuSubTitle").val()
        };
        jQuery.ajax({
            url: "<?php echo ADMIN_API_URL; ?>menu",
            type: "POST",
            async: false,
            dataType: 'json',
            data: JSON.stringify(data),
            contentType: 'application/json',
            //headers: ko.toJS(headers)
        }).done(function (response) {
            if (response.errorCode == 0) {
                if (response.data && Number(response.data.idmenu) > 1) {
                    saveMenuItems();
                }
            } else {
                jQuery("#errorMessage").html(response.msg);
            }
        }).fail(function (response) {
            console.log('error log : ', response);
            jQuery("#errorMessage").html('Hiba a mentés közben!');
        });
    }
    
    function saveMenuItems() {
        var menu_items = [];
        //össze kell szedni a menü itemeket
        jQuery(".menuItem").each(function(index, item) {
            var new_item = {
                idmenu_item: (Number(jQuery(item).attr("data-id") > 1)) ? jQuery(item).attr("data-id") : null,
                title: jQuery(item).find(".menuItemTitle").val(),
                sub_title: jQuery(item).find(".menuItemSubTitle").val(),
                idmenu: <?php echo $menu["idmenu"]; ?>,
                status: jQuery(item).attr("data-status")
            };
            menu_items.push(new_item);
        });
        if (menu_items.length > 0) {
            jQuery.ajax({
                url: "<?php echo ADMIN_API_URL; ?>menu_item",
                type: "POST",
                async: false,
                dataType: 'json',
                data: JSON.stringify(menu_items),
                contentType: 'application/json',
                //headers: ko.toJS(headers)
            }).done(function (response) {
                if (response.errorCode == 0) {
                    if (response.data) {
                        window.location = '<?php echo FULL_BASE_URL.'menu/list/'; ?>';
                    }
                } else {
                    jQuery("#errorMessage").html(response.msg);
                }
            }).fail(function (response) {
                console.log('error log : ', response);
                jQuery("#errorMessage").html('Hiba a mentés közben!');
            });
        } else {
            window.location = '<?php echo FULL_BASE_URL.'menu/list/'; ?>';
        }
    }
</script>