<h1 class="h3 mb-2 text-gray-800">Tartalom létrehozása</h1>
<p class="mb-4">Szerkessz saját tartalmat ízlés szerint</p>

<div class="form-group row">
    <div class="col-sm-6 mb-3 mb-sm-0">
        <label for="customCheck">Tartalom címe</label>
        <input type="text" class="form-control form-control-user" value="<?php echo $content["title"]; ?>" id="contentTitle" placeholder="Tartalom címe">
    </div> 
    <div class="col-sm-3">
        <label for="contentPublished">Publikálás kezdete</label>
        <input type="text" class="form-control form-control-user" value="<?php echo str_replace(array(" 00:00:00", "-"), array("", "."), $content["published"]); ?>" id="contentPublished" placeholder="Publikálás kezdete">
    </div> 
    <div class="col-sm-3">
        <label for="contentPublishedTo">Publikálás vége</label>
        <input type="text" class="form-control form-control-user" value="<?php echo str_replace(array(" 00:00:00", "-"), array("", "."), $content["published_to"]); ?>" id="contentPublishedTo" placeholder="Publikálás vége">
    </div> 
    <div class="col-sm-12">
        <label for="contentShortDesc">Rövid leírás</label>
        <textarea type="text" class="form-control form-control-user" id="contentShortDesc" placeholder="Rövid leírás"><?php echo $content["short_desc"]; ?></textarea>
    </div> 
</div>
<div class="form-group row">
    <div class="col-sm-6">
        <label for="contentPosition">Pozíció</label>
        <select type="text" 
                class="form-control contentPosition" 
                value="1" 
                id="contentPosition" 
                placeholder="Pozíció">
            <option value="1">--nincs kiválasztva--</option>>
            <?php
            if (isset($positions) && isset($positions["data"])) {
                foreach ($positions["data"] as $position) {
                    ?>
                    <option <?php echo ($content["idposition"] == $position["idposition"]) ? 'selected="selected"' : ''; ?>
                        value="<?php echo $position["idposition"]; ?>">
                            <?php echo $position["name"] ?>
                    </option>
                    <?php
                }
            }
            ?>
        </select>
    </div> 
    <div class="col-sm-6">
        <label for="contentGallery">Galériára hivatkozás</label>
        <select data-id="<?php echo $content["idgallery"]; ?>" 
                type="text" 
                class="form-control menuItemGallery" 
                value="<?php echo $content["idgallery"]; ?>" 
                id="contentGallery" 
                placeholder="Galériára hivatkozás">
            <option value="1">--nincs kiválasztva--</option>>
            <?php
            if (isset($gallery) && isset($gallery["data"])) {
                foreach ($gallery["data"] as $galleryi) {
                    ?>
                    <option  <?php echo ($galleryi["idgallery"] == $content["idgallery"]) ? 'selected="selected"' : ''; ?>
                        value="<?php echo $galleryi["idgallery"]; ?>"><?php echo $galleryi["name"] ?></option>
                        <?php
                    }
                }
                ?>
        </select>
    </div> 
</div>

<div class="form-group row">
    <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
        <div class="checkbox">
            <label><input <?php echo ($content["contactform"] == 1) ? ' checked="checked" ' : '' ?> type="checkbox" id="contentContactForm" value="1"> Kapcsolati űrlap megjelenítés a tartalom mellett</label>
        </div>
    </div>
</div>

<div class="form-group">
    <div id="editor"><?php echo $content["content"] ?></div>
</div>

<div id="contentItemsHolderDiv">
    <?php
    if (isset($content) && isset($content["content_items"]) && $content["content_items"]["count"] > 0) {
        foreach ($content["content_items"]["data"] as $key => $content_item) {
            ?>
            <div data-id="<?php echo $content_item["idcontent_item"]; ?>" data-status="1" class="card card-body contentItem">
                <div class="text-center">
                    <button onclick="delContentItem(this)" class="btn btn-secondary" id="delContentItem_<?php echo $content_item["idcontent_item"]; ?>">
                        <i class="fas fa-trash fa-sm"></i>
                    </button>
                </div>
                <div class="form-group row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="">
                                <label for="contentItemTitle_<?php echo $content_item["idcontent_item"]; ?>">Kép szövege</label>
                                <input data-id="<?php echo $content_item["idcontent_item"]; ?>" type="text" class="form-control contentItemTitle" value="<?php echo $content_item["title"]; ?>" id="contentItemTitle_<?php echo $content_item["idcontent_item"]; ?>" placeholder="Kép szövege">
                            </div> 
                        </div> 
                        <?php if ($content_item["item_id"] > 1) { ?>
                            <div class="form-group ">
                                <div class="">
                                    <span>Feltöltött kép: 
                                        <a target="blank" href="<?php echo str_replace("admin.php/", "", ADMIN_API_URL) . $content_item["image_path"]; ?>">
                                            <?php echo $content_item["image_name"]; ?>
                                        </a>
                                    </span>
                                </div> 
                            </div> 
                        <?php } ?>
                        <div class="form-group ">
                            <div class="contentItemImageHolder">
                                <input onchange="selectNewImage(this);" data-id="<?php echo $content_item["idcontent_item"]; ?>" type="file" class="contentItemImage" id="contentItemImage_<?php echo $content_item["idcontent_item"]; ?>" placeholder="Kép">
                                <input data-id="<?php echo $content_item["idcontent_item"]; ?>" type="hidden" class="form-control contentItemIdImage" value="<?php echo $content_item["item_id"]; ?>" id="contentItemIdImage_<?php echo $content_item["idcontent_item"]; ?>" placeholder="Kép azon.">
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

<div data-id="0" data-status="1" id="newContentItem" style="display: none;" class="card card-body">
    <div class="text-center">
        <button onclick="delContentItem(this)" class="btn btn-secondary" id="delContentItem_0">
            <i class="fas fa-trash fa-sm"></i>
        </button>
    </div>
    <div class="form-group row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <div class="">
                    <label for="contentItemTitle_0">Kép szövege</label>
                    <input data-id="0" type="text" class="form-control contentItemTitle" value="" id="contentItemTitle_0" placeholder="Kép szövege">
                </div> 
            </div> 
            <div class="form-group">
                <div class="contentItemImageHolder">
                    <input onchange="selectNewImage(this);" data-id="0" type="file" class="contentItemImage" value="" id="contentItemImage_0" placeholder="Kép">
                    <input data-id="0" type="hidden" class="contentItemIdImage" value="" id="contentItemIdImage_0" placeholder="Kép azon.">
                    <button disabled="true" onclick="uploadImage(this);" class="btn btn-secondary disabled uploadImageBtn">
                        <i class="fas fa-file-upload"></i>
                        Feltöltés
                    </button>
                </div> 
            </div> 
        </div> 
    </div> 
</div>

<div class="col-xs-12">
    <button onclick="addNewContentItem()" class="btn btn-secondary" id="addNewContentItem">
        Új kép hozzáadása
    </button>
</div> 

<div class="form-group row">
    <div class="col-sm-12 text-right">
        <small id="errorMessage" class="form-text text-danger"></small>
    </div> 
</div>

<div class="text-right">
    <a onclick="save()" href="javascript:void(0);" class="btn btn-primary" role="button">
        <i class="fas fa-save fa-sm"></i>
        Mentés
    </a>
    <a href="<?php echo FULL_BASE_URL . 'content/list'; ?>" class="btn btn-secondary" role="button">
        <i class="fas fa-cancel fa-sm"></i>
        Mégsem
    </a>
</div>


<script src="<?php echo VIEWS_URL; ?>/vendor/ckfinder3511/ckfinder.js"></script>
<script src="<?php echo VIEWS_URL; ?>/vendor/ckeditor5/ckeditor.js"></script>

<script>

        jQuery(document).ready(function () {
            jQuery("#contentPublished").datepicker();
            jQuery("#contentPublishedTo").datepicker();
        });

        var content_editor;

        var actContentItemImageHolder = null;

        function selectNewImage(input) {
            var uploadImageBtn = jQuery(input).closest(".contentItemImageHolder").find(".uploadImageBtn");
            uploadImageBtn.removeClass("disabled");
            uploadImageBtn.removeAttr("disabled");
            uploadImageBtn.html("<i class=\"fas fa-file-upload\"></i> Feltöltés");
        }

        function uploadImage(uploadbtn) {
            actContentItemImageHolder = jQuery(uploadbtn).closest('.contentItemImageHolder');
            if (!window.File || !window.FileReader || !window.FileList || !window.Blob) {
                alert('The File APIs are not fully supported in this browser.');
                return;
            }
            var file = actContentItemImageHolder.find('.contentItemImage').prop('files')[0];
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
                    actContentItemImageHolder.find(".contentItemIdImage").val(res.data.idimage);
                    actContentItemImageHolder.find(".uploadImageBtn").attr("disabled", true);
                    actContentItemImageHolder.find(".uploadImageBtn").addClass("disabled");
                    actContentItemImageHolder.find(".uploadImageBtn").html("Feltöltés kész");
                } else {
                    alert("hiba a kép feltöltése közben");
                }
            }
        }

        function addNewContentItem() {
            var newContentItem = jQuery("#newContentItem").clone();
            newContentItem.addClass("contentItem");
            newContentItem.css("display", "flex");
            jQuery("#contentItemsHolderDiv").append(newContentItem);
            jQuery("#contentItemsHolderDiv").append("<br/>");
        }

        function delContentItem(item) {
            if (jQuery(item).closest(".contentItem").attr("data-status") == 1) {
                jQuery(item).closest(".contentItem").attr("data-status", 0);
                jQuery(item).addClass("text-danger");
            } else {
                jQuery(item).closest(".contentItem").attr("data-status", 1);
                jQuery(item).removeClass("text-danger");
            }
        }

        function save() {
            var content = btoa(unescape(encodeURIComponent(content_editor.getData())));
            var data = {
                idcontent: <?php echo $content["idcontent"]; ?>,
                content: content,
                title: jQuery("#contentTitle").val(),
                published: jQuery("#contentPublished").val(),
                idgallery: (jQuery("#contentGallery").val() > 1) ? jQuery("#contentGallery").val() : 1,
                published_to: jQuery("#contentPublishedTo").val(),
                short_desc: jQuery("#contentShortDesc").val(),
                contactform: (jQuery("#contentContactForm").is(":checked")) ? 1 : 0,
                idposition: jQuery("#contentPosition").val(),
                status: 1
            };
            jQuery.ajax({
                url: "<?php echo ADMIN_API_URL; ?>content",
                type: "POST",
                async: false,
                dataType: 'json',
                data: JSON.stringify(data),
                contentType: 'application/json',
                //headers: ko.toJS(headers)
            }).done(function (response) {
                if (response.errorCode == 0) {
                    if (response.data && Number(response.data.idcontent) > 1) {
                        saveContentItems();
                    }
                } else {
                    jQuery("#errorMessage").html(response.msg);
                }
            }).fail(function (response) {
                console.log('error log : ', response);
                jQuery("#errorMessage").html('Hiba a mentés közben!');
            });
        }

        function saveContentItems() {
            var content_items = [];
            //össze kell szedni a menü itemeket
            jQuery(".contentItem").each(function (index, item) {
                var c_item = {
                    idcontent_item: (Number(jQuery(item).attr("data-id") > 1)) ? jQuery(item).attr("data-id") : null,
                    title: jQuery(item).find(".contentItemTitle").val(),
                    type: 'image',
                    idcontent: <?php echo $content["idcontent"]; ?>,
                    item_id: jQuery(item).find(".contentItemIdImage").val(),
                    status: jQuery(item).attr("data-status")
                };
                if (Number(c_item.idcontent_item) > 1 || (c_item.status == 1)) {
                    content_items.push(c_item);
                }
            });
            if (content_items.length > 0) {
                jQuery.ajax({
                    url: "<?php echo ADMIN_API_URL; ?>content_item",
                    type: "POST",
                    async: false,
                    dataType: 'json',
                    data: JSON.stringify(content_items),
                    contentType: 'application/json'
                            //headers: ko.toJS(headers)
                }).done(function (response) {
                    if (response.errorCode == 0) {
                        if (response.data) {
                            window.location = '<?php echo FULL_BASE_URL . 'content/list/'; ?>';
                        }
                    } else {
                        jQuery("#errorMessage").html(response.msg);
                    }
                }).fail(function (response) {
                    console.log('error log : ', response);
                    jQuery("#errorMessage").html('Hiba a mentés közben!');
                });
            } else {
                window.location = '<?php echo FULL_BASE_URL . 'content/list/'; ?>';
            }
        }

        ClassicEditor.create(document.querySelector('#editor'), {
            toolbar: {
                items: [
                    'heading',
                    '|',
                    'undo',
                    'redo',
                    'removeFormat',
                    'bold',
                    'italic',
                    'underline',
                    'strikethrough',
                    'fontColor',
                    'fontSize',
                    'fontBackgroundColor',
                    'fontFamily',
                    'link',
                    'highlight',
                    '|',
                    'alignment',
                    'bulletedList',
                    'numberedList',
                    'indent',
                    'outdent',
                    'horizontalLine',
                    'insertTable',
                    '|',
                    'CKFinder',
                    'imageUpload',
                    'imageInsert',
                    'mediaEmbed',
                    'blockQuote',
                    'code',
                    'codeBlock',
                    'exportPdf',
                    'exportWord',
                    'MathType',
                    'ChemType',
                    'specialCharacters',
                    'subscript',
                    'superscript'
                ]
            },
            language: 'hu',
            image: {
                toolbar: [
                    'imageTextAlternative',
                    'imageStyle:full',
                    'imageStyle:side'
                ]
            },
            table: {
                contentToolbar: [
                    'tableColumn',
                    'tableRow',
                    'mergeTableCells',
                    'tableCellProperties',
                    'tableProperties'
                ]
            },
            ckfinder: {
                uploadUrl: '<?php echo VIEWS_URL; ?>/vendor/ckfinder3511/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
                // Open the file manager in the pop-up window.
                openerMethod: 'popup'
            },
            licenseKey: ''
        })
        .then(editor => {
            content_editor = editor;
        })
        .catch(error => {
            console.error(error);
        });

</script>