<h1 class="h3 mb-2 text-gray-800">Galéria szerkesztése</h1>
<p class="mb-4">Szerkeszd a galériát</p>

<div class="form-group row">
    <div class="col-sm-12">
        <label for="galleryName">Megnevezés</label>
        <input type="text" class="form-control" value="<?php echo $gallery["name"]; ?>" id="galleryName" placeholder="Galéria megnevezése">
        <small id="galleryNameHelp" class="form-text text-danger"></small>
    </div> 
</div> 
<div class="form-group row">
    <div class="col-sm-12">
        <label for="galleryText">Leírás</label>
        <textarea class="form-control" id="galleryText"><?php echo $gallery["text"]; ?></textarea>
        <small id="galleryTextHelp" class="form-text text-danger"></small>
    </div>
</div> 
<hr/>
<h1 class="h3 mb-2 text-gray-800">Képek hozzáadása a galériához</h1>
<p class="mb-4">Töltsd fel a képeket</p>

<div class="form-group row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <div class="galleryItemsUploadHolder">
                <input onchange="selectNewItems(this);" type="file" multiple class="galleryItemImages" value="" id="galleryItemImageUpload" placeholder="Képek">
                <button disabled="true" onclick="uploadImage(this);" class="btn btn-secondary disabled uploadImageBtn">
                    <i class="fas fa-file-upload"></i>
                    Feltöltés
                </button>
            </div> 
        </div> 
    </div> 
</div> 

<div id="galleryItemsHolderDiv">
    <?php
    if (isset($gallery) && isset($gallery["gallery_items"]) && $gallery["gallery_items"]["count"] > 0) {
        foreach ($gallery["gallery_items"]["data"] as $key => $gallery_item) {
            ?>
            <div style="display: inline-block;" class="card card-body galleryItem-card">
                <div class="form-group text-center">
                    <button onclick="delGalleryItem(this)" class="btn btn-secondary">
                        <i class="fas fa-trash fa-sm"></i>
                    </button>
                </div>
                <div class="form-group row">
                    <img class="galleryItemImg" src="<?php echo IMAGES_URL.$gallery_item["image_path"]; ?>">
                </div>
                <div class="form-group row galleryItem" data-id="<?php echo $gallery_item["idgallery_item"]; ?>" data-status="<?php echo $gallery_item["status"]; ?>">
                    <input class="form-control galleryItemName" type="text" value="<?php echo $gallery_item["name"]; ?>" placeholder="Kép megnevezése">
                    <textarea class="form-control galleryItemText"><?php echo $gallery_item["text"]; ?></textarea>
                    <input class="form-control galleryItemIdImage" type="hidden" value="<?php echo $gallery_item["idimage"]; ?>" placeholder="Kép azon">
                    <input class="form-control galleryItemIdGalleryItem" type="hidden" value="<?php echo $gallery_item["idgallery_item"]; ?>" placeholder="azon">
                </div>
            </div>
            <?php
        }
    }
    ?>
</div>

<div style="display:none;" class="itemTemplate card card-body galleryItem-card">
    <div class="form-group text-center">
        <button onclick="delGalleryItem(this)" class="btn btn-secondary" data-status="1">
            <i class="fas fa-trash fa-sm"></i>
        </button>
    </div>
    <div class="form-group row">
        <img class="galleryItemImg" src="" />
    </div>
    <div class="form-group row galleryItem" data-id="0" data-status="0">
        <input class="form-control galleryItemName" type="text" value="" placeholder="Kép megnevezése" />
        <textarea class="form-control galleryItemText"></textarea>
        <input class="form-control galleryItemIdImage" type="hidden" value="" placeholder="Kép azon" />
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
    <a href="<?php echo FULL_BASE_URL . 'gallery/list'; ?>" class="btn btn-secondary" role="button">
        <i class="fas fa-cancel fa-sm"></i>
        Mégsem
    </a>
</div>

<script>
    jQuery(document).ready(function () {

    });
    
    var actGalleryItemsImageHolder = null;
    
    function selectNewItems(input) {
        var uploadImageBtn = jQuery(input).closest(".galleryItemsUploadHolder").find(".uploadImageBtn");
        uploadImageBtn.removeClass("disabled");
        uploadImageBtn.removeAttr("disabled");
        uploadImageBtn.html("<i class=\"fas fa-file-upload\"></i> Feltöltés");
    }
    
    function uploadImage(uploadbtn) {
        actGalleryItemsImageHolder = jQuery(uploadbtn).closest('.galleryItemsUploadHolder');
        if (!window.File || !window.FileReader || !window.FileList || !window.Blob) {
            alert('The File APIs are not fully supported in this browser.');
            return;
        }
        var files = actGalleryItemsImageHolder.find('.galleryItemImages').prop('files');
        for (var i = 0; i < files.length; i++) {
            var formdata = new FormData();
            formdata.append("file1", files[i]);
            var ajax = new XMLHttpRequest();
            ajax.onreadystatechange = uploadImageCallback;
            ajax.open("POST", '<?php echo ADMIN_API_URL; ?>image/upload');
            ajax.send(formdata);
        }
    }
    
    function delGalleryItem(item) {
        if (jQuery(item).closest('.card').find(".galleryItem").attr("data-status") == 1) {
            jQuery(item).closest('.card').find(".galleryItem").attr("data-status", 0);
            jQuery(item).addClass("text-danger");
        } else {
            jQuery(item).closest('.card').find(".galleryItem").attr("data-status", 1);
            jQuery(item).removeClass("text-danger");
        }
    }

    function uploadImageCallback() {
        // In local files, status is 0 upon success in Mozilla Firefox
        if (this.readyState === XMLHttpRequest.DONE) {
            var status = this.status;
            if (status === 0 || (status >= 200 && status < 400)) {
                var uploadImageBtn = jQuery(".galleryItemsUploadHolder").find(".uploadImageBtn");
                uploadImageBtn.addClass("disabled");
                uploadImageBtn.attr("disabled", "disabled");
                uploadImageBtn.html("<i class=\"fas fa-file-upload\"></i> Feltöltés");
                // The request has been completed successfully
                console.log(this.responseText);
                var res = JSON.parse(this.responseText);
                var newitem = jQuery(".itemTemplate").clone();
                newitem.removeClass('itemTemplate');
                newitem.css('display',"inline-block");
                newitem.find(".galleryItem").attr("data-status", 1);
                newitem.find(".galleryItemIdImage").val(res.data.idimage);
                newitem.find(".galleryItemName").val(res.data.title);
                newitem.find(".galleryItemImg").attr("src", '<?php echo IMAGES_URL; ?>'+res.data.path);
                jQuery("#galleryItemsHolderDiv").append(newitem);
            } else {
                alert("hiba a kép feltöltése közben");
            }
        }
    }

    function save() {
        jQuery("#errorMessage").html('');
        jQuery("#successMessage").html('');
        var data = {
            idgallery: <?php echo $gallery["idgallery"]; ?>,
            name: jQuery("#galleryName").val(),
            text: jQuery("#galleryText").val(),
            idposition: jQuery("#galleryPosition").val()
        };
        jQuery.ajax({
            url: "<?php echo ADMIN_API_URL; ?>gallery",
            type: "POST",
            async: false,
            dataType: 'json',
            data: JSON.stringify(data),
            contentType: 'application/json',
            //headers: ko.toJS(headers)
        }).done(function (response) {
            if (response.errorCode == 0) {
                if (response.data && Number(response.data.idgallery) > 1) {
                    saveGalleryItems();
                }
            } else {
                jQuery("#errorMessage").html(response.msg);
            }
        }).fail(function (response) {
            console.log('error log : ', response);
            jQuery("#errorMessage").html('Hiba a mentés közben!');
        });
    }

    function saveGalleryItems() {
        var gallery_items = [];
        //össze kell szedni a menü itemeket
        jQuery(".galleryItem").each(function (index, item) {
            var new_item = {
                idgallery_item: (Number(jQuery(item).attr("data-id") > 1)) ? jQuery(item).attr("data-id") : null,
                name: jQuery(item).find(".galleryItemName").val(),
                text: jQuery(item).find(".galleryItemText").val(),
                idgallery: <?php echo $gallery["idgallery"];  ?>,
                idimage: jQuery(item).find(".galleryItemIdImage").val(),
                status: jQuery(item).attr("data-status")
            };
            if (Number(new_item.idgallery_item) > 1 || (new_item.status == 1)) {
                gallery_items.push(new_item);
            }
        });
        debugger;
        if (gallery_items.length > 0) {
            jQuery.ajax({
                url: "<?php echo ADMIN_API_URL;  ?>gallery_item",
                type: "POST",
                async: false,
                dataType: 'json',
                data: JSON.stringify(gallery_items),
                contentType: 'application/json'
            }).done(function (response) {
                if (response.errorCode == 0) {
                    if (response.data) {
                        window.location = '<?php echo FULL_BASE_URL . 'gallery/list/';  ?>';
                    }
                } else {
                    jQuery("#errorMessage").html(response.msg);
                }
            }).fail(function (response) {
                console.log('error log : ', response);
                jQuery("#errorMessage").html('Hiba a mentés közben!');
            });
        } else {
            window.location = '<?php echo FULL_BASE_URL . 'gallery/list/';  ?>';
        }
    }
</script>