<h1 class="h3 mb-2 text-gray-800">Banner szerkesztése</h1>
<p class="mb-4">Szerkeszd a bannert</p>

<div class="form-group row">
    <div class="col-sm-12">
        <label for="bannerName">Megnevezés</label>
        <input type="text" class="form-control" value="<?php echo $banner["name"]; ?>" id="bannerName" placeholder="Banner megnevezése">
        <small id="bannerNameHelp" class="form-text text-danger"></small>
    </div> 
</div> 
<div class="form-group row">
    <div class="col-sm-12">
        <label for="bannerType">Típus</label>
        <select type="text" 
                class="form-control bannerType" 
                value="1" 
                id="bannerType" 
                placeholder="Banner típusa">
            <option value="normal" <?php echo ($banner["type"] == 'normal') ? 'selected="selected"' : ''; ?>>Normál</option>
            <option value="slideshow" <?php echo ($banner["type"] == 'slideshow') ? 'selected="selected"' : ''; ?>>SlideShow</option>
        </select>
        <small id="bannerTypeHelp" class="form-text text-danger"></small>
    </div> 
</div>
<div class="form-group row">
    <div class="col-sm-12">
        <label for="bannerPosition">Pozíció</label>
        <select type="text" 
                class="form-control bannerPosition" 
                value="1" 
                id="bannerPosition" 
                placeholder="Pozíció">
            <option value="1">--nincs kiválasztva--</option>
            <?php
            if (isset($positions) && isset($positions["data"])) {
                foreach ($positions["data"] as $position) {
                    ?>
                    <option <?php echo ($banner["idposition"] == $position["idposition"]) ? 'selected="selected"' : ''; ?>
                        value="<?php echo $position["idposition"]; ?>">
                        <?php echo $position["name"] ?></option>
                    <?php
                }
            }
            ?>
        </select>
    </div>
</div>
<hr/>
<h1 class="h3 mb-2 text-gray-800">Banner elemek hozzáadása a bannerhez</h1>
<p class="mb-4">Add meg a banner elemeit</p>

<div id="bannerItemsHolderDiv">
    <?php
    if (isset($banner) && isset($banner["banner_items"]) && $banner["banner_items"]["count"] > 0) {
        foreach ($banner["banner_items"]["data"] as $key => $banner_item) {
            ?>
            <div data-id="<?php echo $banner_item["idbanner_item"]; ?>" data-status="1" class="card card-body bannerItem">
                <div class="text-center">
                    <button onclick="delBannerItem(this)" class="btn btn-secondary" id="delBannerItem_<?php echo $banner_item["idbanner_item"]; ?>">
                        <i class="fas fa-trash fa-sm"></i>
                    </button>
                </div>
                <div class="form-group row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group ">
                            <div class="">
                                <label for="bannerItemName_<?php echo $banner_item["idbanner_item"]; ?>">Bannerpont neve</label>
                                <input data-id="<?php echo $banner_item["idbanner_item"]; ?>" type="text" class="form-control bannerItemName" value="<?php echo $banner_item["name"]; ?>" id="bannerItemName_<?php echo $banner_item["idbanner_item"]; ?>" placeholder="Banner elem megnevezése">
                            </div> 
                        </div> 
                        <div class="form-group ">
                            <div class="">
                                <label for="bannerItemText_<?php echo $banner_item["idbanner_item"]; ?>">Banner elem szövege</label>
                                <textarea data-id="<?php echo $banner_item["idbanner_item"]; ?>" type="text" class="form-control bannerItemText" id="bannerItemSubTitle_<?php echo $banner_item["idbanner_item"]; ?>" placeholder="Bannerpont alcíme"><?php echo $banner_item["text"]; ?></textarea>
                            </div> 
                        </div> 
                        <div class="form-group ">
                            <div class="">
                                <label for="bannerItemUrl_<?php echo $banner_item["idbanner_item"]; ?>">Hivatkozás</label>
                                <input data-id="<?php echo $banner_item["idbanner_item"]; ?>" type="text" class="form-control bannerItemUrl" value="<?php echo $banner_item["url"]; ?>" id="bannerItemUrl_<?php echo $banner_item["idbanner_item"]; ?>" placeholder="Hivatkozás">
                            </div> 
                        </div> 
                        <div class="form-group ">
                            <div class="">
                                <label for="bannerItemContent_<?php echo $banner_item["idbanner_item"]; ?>">Tartalomra hivatkozás</label>
                                <select data-id="<?php echo $banner_item["idbanner_item"]; ?>" 
                                        type="text" 
                                        class="form-control bannerItemContent" 
                                        value="<?php echo $banner_item["idcontent"]; ?>" 
                                        id="bannerItemContent_<?php echo $banner_item["idbanner_item"]; ?>" 
                                        placeholder="Tartalomra hivatkozás">
                                    <option value="1">--nincs kiválasztva--</option>>
                                    <?php 
                                        if (isset($contents) && isset($contents["data"])) {
                                            foreach ($contents["data"] as $content) {
                                                ?>
                                    <option  <?php echo ($content["idcontent"] == $banner_item["idcontent"]) ? 'selected="selected"' : ''; ?>
                                        value="<?php echo $content["idcontent"]; ?>"><?php echo $content["title"] ?></option>
                                                <?php
                                            }
                                        } 
                                    ?>
                                </select>
                            </div> 
                        </div>  
                        <?php if ($banner_item["idimage"] > 1) { ?>
                        <div class="form-group ">
                            <div class="">
                                <span>Feltöltött kép: 
                                    <a target="blank" href="<?php echo str_replace("admin.php/", "", ADMIN_API_URL).$banner_item["image_path"]; ?>">
                                    <?php echo $banner_item["image_name"]; ?>
                                    </a>
                                </span>
                            </div> 
                        </div> 
                        <?php } ?>
                        <div class="form-group ">
                            <div class="bannerItemImageHolder">
                                <input onchange="selectNewImage(this);" data-id="<?php echo $banner_item["idbanner_item"]; ?>" type="file" class="bannerItemImage" id="bannerItemImage_<?php echo $banner_item["idbanner_item"]; ?>" placeholder="Kép">
                                <input data-id="<?php echo $banner_item["idbanner_item"]; ?>" type="hidden" class="form-control bannerItemIdImage" value="<?php echo $banner_item["idimage"]; ?>" id="bannerItemIdImage_<?php echo $banner_item["idbanner_item"]; ?>" placeholder="Kép azon.">
                                <button disabled="true" onclick="uploadImage(this);" class="btn btn-secondary disabled uploadImageBtn">
                                    <i class="fas fa-file-upload"></i>
                                    Feltöltés
                                </button>
                            </div> 
                        </div> 
                    </div> 
                </div> 
            </div>
            <br/>
            <?php
        }
    }
    ?>
</div>
<br/>
<div class="col-xs-12">
    <button onclick="addNewBannerItem()" class="btn btn-secondary" id="addNewBannerItem">
        Új banner elem hozzáadása
    </button>
</div> 

<div data-id="0" data-status="1" id="newBannerItem" style="display: none;" class="card card-body">
    <div class="text-center">
        <button onclick="delBannerItem(this)" class="btn btn-secondary" id="delBannerItem_0">
            <i class="fas fa-trash fa-sm"></i>
        </button>
    </div>
    <div class="form-group row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group ">
                <div class="">
                    <label for="bannerItemName_0">Banner elem neve</label>
                    <input data-id="0" type="text" class="form-control bannerItemName" value="" id="bannerItemName_0" placeholder="Banner elem megnevezése">
                </div> 
            </div> 
            <div class="form-group ">
                <div class="">
                    <label for="bannerItemText_0">Banner elem szövege</label>
                    <textarea data-id="0" type="text" class="form-control bannerItemText" value="" id="bannerItemText_0" placeholder="Banner elem szövege"></textarea>
                </div> 
            </div> 
            <div class="form-group ">
                <div class="">
                    <label for="bannerItemUrl_0">Hivatkozás</label>
                    <input data-id="0" type="text" class="form-control bannerItemUrl" value="" id="bannerItemUrl_0" placeholder="Hivatkozás">
                </div> 
            </div> 
            <div class="form-group ">
                <div class="">
                    <label for="bannerItemContent_0">Tartalomra hivatkozás</label>
                    <select data-id="0" 
                            type="text" 
                            class="form-control bannerItemContent" 
                            value="1" 
                            id="bannerItemContent_0" 
                            placeholder="Tartalomra hivatkozás">
                        <option value="1">--nincs kiválasztva--</option>>
                        <?php 
                            if (isset($contents) && isset($contents["data"])) {
                                foreach ($contents["data"] as $content) {
                                    ?>
                        <option value="<?php echo $content["idcontent"]; ?>"><?php echo $content["title"] ?></option>
                                    <?php
                                }
                            } 
                        ?>
                    </select>
                </div> 
            </div> 
            <div class="form-group">
                <div class="bannerItemImageHolder">
                    <input onchange="selectNewImage(this);" data-id="0" type="file" class="bannerItemImage" value="" id="bannerItemImage_0" placeholder="Kép">
                    <input data-id="0" type="hidden" class="bannerItemIdImage" value="" id="bannerItemIdImage_0" placeholder="Kép azon.">
                    <button disabled="true" onclick="uploadImage(this);" class="btn btn-secondary disabled uploadImageBtn">
                        <i class="fas fa-file-upload"></i>
                        Feltöltés
                    </button>
                </div> 
            </div> 
        </div> 
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
    <a href="<?php echo FULL_BASE_URL . 'banner/list'; ?>" class="btn btn-secondary" role="button">
        <i class="fas fa-cancel fa-sm"></i>
        Mégsem
    </a>
</div>

<script>
    jQuery(document).ready(function () {

    });
    
    var actBannerItemImageHolder = null;

    function selectNewImage(input) {
        var uploadImageBtn = jQuery(input).closest(".bannerItemImageHolder").find(".uploadImageBtn");
        uploadImageBtn.removeClass("disabled");
        uploadImageBtn.removeAttr("disabled");
        uploadImageBtn.html("<i class=\"fas fa-file-upload\"></i> Feltöltés");
    }

    function uploadImage(uploadbtn) {
        actBannerItemImageHolder = jQuery(uploadbtn).closest('.bannerItemImageHolder');
        if (!window.File || !window.FileReader || !window.FileList || !window.Blob) {
            alert('The File APIs are not fully supported in this browser.');
            return;
        }
        var file = actBannerItemImageHolder.find('.bannerItemImage').prop('files')[0];
        var formdata = new FormData();
        formdata.append("file1", file);
        var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = uploadImageCallback;
        ajax.open("POST", '<?php echo ADMIN_API_URL; ?>image/upload');
        ajax.send(formdata);
    }

    function uploadImageCallback() {
        // In local files, status is 0 upon success in Mozilla Firefox
        if (this.readyState === XMLHttpRequest.DONE) {
            var status = this.status;
            if (status === 0 || (status >= 200 && status < 400)) {
                // The request has been completed successfully
                console.log(this.responseText);
                var res = JSON.parse(this.responseText);
                actBannerItemImageHolder.find(".bannerItemIdImage").val(res.data.idimage);
                actBannerItemImageHolder.find(".uploadImageBtn").attr("disabled", true);
                actBannerItemImageHolder.find(".uploadImageBtn").addClass("disabled");
                actBannerItemImageHolder.find(".uploadImageBtn").html("Feltöltés kész");
            } else {
                alert("hiba a kép feltöltése közben");
            }
        }
    }

    function addNewBannerItem() {
        var newBannerItem = jQuery("#newBannerItem").clone();
        newBannerItem.addClass("bannerItem");
        newBannerItem.css("display", "flex");
        jQuery("#bannerItemsHolderDiv").append(newBannerItem);
        jQuery("#bannerItemsHolderDiv").append("<br/>");
    }

    function delBannerItem(item) {
        if (jQuery(item).closest(".bannerItem").attr("data-status") == 1) {
            jQuery(item).closest(".bannerItem").attr("data-status", 0);
            jQuery(item).addClass("text-danger");
        } else {
            jQuery(item).closest(".bannerItem").attr("data-status", 1);
            jQuery(item).removeClass("text-danger");
        }
    }

    function save() {
        jQuery("#errorMessage").html('');
        jQuery("#successMessage").html('');
        var data = {
            idbanner: <?php echo $banner["idbanner"]; ?>,
            name: jQuery("#bannerName").val(),
            type: jQuery("#bannerType").val(),
            idposition: jQuery("#bannerPosition").val()
        };
        jQuery.ajax({
            url: "<?php echo ADMIN_API_URL; ?>banner",
            type: "POST",
            async: false,
            dataType: 'json',
            data: JSON.stringify(data),
            contentType: 'application/json',
            //headers: ko.toJS(headers)
        }).done(function (response) {
            if (response.errorCode == 0) {
                if (response.data && Number(response.data.idbanner) > 1) {
                    saveBannerItems();
                }
            } else {
                jQuery("#errorMessage").html(response.msg);
            }
        }).fail(function (response) {
            console.log('error log : ', response);
            jQuery("#errorMessage").html('Hiba a mentés közben!');
        });
    }

    function saveBannerItems() {
        var banner_items = [];
        //össze kell szedni a menü itemeket
        jQuery(".bannerItem").each(function (index, item) {
            var new_item = {
                idbanner_item: (Number(jQuery(item).attr("data-id") > 1)) ? jQuery(item).attr("data-id") : null,
                name: jQuery(item).find(".bannerItemName").val(),
                text: jQuery(item).find(".bannerItemText").val(),
                idbanner: <?php echo $banner["idbanner"]; ?>,
                url: jQuery(item).find(".bannerItemUrl").val(),
                idcontent: (jQuery(item).find(".bannerItemContent").val()>1)?jQuery(item).find(".bannerItemContent").val():1,
                idimage: jQuery(item).find(".bannerItemIdImage").val(),
                status: jQuery(item).attr("data-status")
            };
            if (Number(new_item.idbanner_item) > 1 || (new_item.status == 1)) {
                banner_items.push(new_item);
            }
        });
        if (banner_items.length > 0) {
            jQuery.ajax({
                url: "<?php echo ADMIN_API_URL; ?>banner_item",
                type: "POST",
                async: false,
                dataType: 'json',
                data: JSON.stringify(banner_items),
                contentType: 'application/json'
                //headers: ko.toJS(headers)
            }).done(function (response) {
                if (response.errorCode == 0) {
                    if (response.data) {
                        window.location = '<?php echo FULL_BASE_URL . 'banner/list/'; ?>';
                    }
                } else {
                    jQuery("#errorMessage").html(response.msg);
                }
            }).fail(function (response) {
                console.log('error log : ', response);
                jQuery("#errorMessage").html('Hiba a mentés közben!');
            });
        } else {
            window.location = '<?php echo FULL_BASE_URL . 'banner/list/'; ?>';
        }
    }
</script>