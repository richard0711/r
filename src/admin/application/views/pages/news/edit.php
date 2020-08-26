<h1 class="h3 mb-2 text-gray-800">Hír szerkesztése</h1>
<p class="mb-4">Szerkeszd meg a hírt ízlés szerint</p>

<div class="form-group row">
    <div class="col-sm-6 mb-3 mb-sm-0">
        <label for="newsTitle">Hír címe</label>
        <input type="text" class="form-control form-control-user" value="<?php echo $news["title"]; ?>" id="newsTitle" placeholder="Hír címe">
    </div> 
    <div class="col-sm-3">
        <label for="newsPublished">Publikálás kezdete</label>
        <input type="text" class="form-control form-control-user" value="<?php echo str_replace(array(" 00:00:00", "-"), array("", "."), $news["published"]); ?>" id="newsPublished" placeholder="Publikálás kezdete">
    </div> 
    <div class="col-sm-3">
        <label for="newsPublishedTo">Publikálás vége</label>
        <input type="text" class="form-control form-control-user" value="<?php echo str_replace(array(" 00:00:00", "-"), array("", "."), $news["published_to"]); ?>" id="newsPublishedTo" placeholder="Publikálás vége">
    </div> 
    <div class="col-sm-12">
        <label for="newsShortDesc">Rövid leírás</label>
        <textarea type="text" class="form-control form-control-user" id="newsShortDesc" placeholder="Rövid leírás"><?php echo $news["short_desc"]; ?></textarea>
    </div> 
</div>

<div class="form-group">
    <div id="editor"><?php echo $news["content"] ?></div>
</div>

<div id="newsItemsHolderDiv">
    <?php
    if (isset($news) && isset($news["news_items"]) && $news["news_items"]["count"] > 0) {
        foreach ($news["news_items"]["data"] as $key => $news_item) {
            ?>
            <div data-id="<?php echo $news_item["idnew_item"]; ?>" data-status="1" class="card card-body newsItem">
                <div class="text-center">
                    <button onclick="delNewsItem(this)" class="btn btn-secondary" id="delNewsItem_<?php echo $news_item["idnew_item"]; ?>">
                        <i class="fas fa-trash fa-sm"></i>
                    </button>
                </div>
                <div class="form-group row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="">
                                <label for="newsItemTitle_<?php echo $news_item["idnew_item"]; ?>">Kép szövege</label>
                                <input data-id="<?php echo $news_item["idnew_item"]; ?>" type="text" class="form-control newsItemTitle" value="<?php echo $news_item["title"]; ?>" id="newsItemTitle_<?php echo $news_item["idnew_item"]; ?>" placeholder="Kép szövege">
                            </div> 
                        </div> 
                        <?php if ($news_item["item_id"] > 1) { ?>
                            <div class="form-group ">
                                <div class="">
                                    <span>Feltöltött kép: 
                                        <a target="blank" href="<?php echo str_replace("admin.php/", "", ADMIN_API_URL) . $news_item["image_path"]; ?>">
                                            <?php echo $news_item["image_name"]; ?>
                                        </a>
                                    </span>
                                </div> 
                            </div> 
                        <?php } ?>
                        <div class="form-group ">
                            <div class="newsItemImageHolder">
                                <input onchange="selectNewImage(this);" data-id="<?php echo $news_item["idnew_item"]; ?>" type="file" class="newsItemImage" id="newsItemImage_<?php echo $news_item["idnew_item"]; ?>" placeholder="Kép">
                                <input data-id="<?php echo $news_item["idnew_item"]; ?>" type="hidden" class="form-control newsItemIdImage" value="<?php echo $news_item["item_id"]; ?>" id="newsItemIdImage_<?php echo $news_item["idnew_item"]; ?>" placeholder="Kép azon.">
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

<div data-id="0" data-status="1" id="newNewsItem" style="display: none;" class="card card-body">
    <div class="text-center">
        <button onclick="delNewsItem(this)" class="btn btn-secondary" id="delNewsItem_0">
            <i class="fas fa-trash fa-sm"></i>
        </button>
    </div>
    <div class="form-group row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <div class="">
                    <label for="newsItemTitle_0">Kép szövege</label>
                    <input data-id="0" type="text" class="form-control newsItemTitle" value="" id="newsItemTitle_0" placeholder="Kép szövege">
                </div> 
            </div> 
            <div class="form-group">
                <div class="newsItemImageHolder">
                    <input onchange="selectNewImage(this);" data-id="0" type="file" class="newsItemImage" value="" id="newsItemImage_0" placeholder="Kép">
                    <input data-id="0" type="hidden" class="newsItemIdImage" value="" id="newsItemIdImage_0" placeholder="Kép azon.">
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
    <button onclick="addNewNewsItem()" class="btn btn-secondary" id="addNewNewsItem">
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
    <a href="<?php echo FULL_BASE_URL . 'news/list'; ?>" class="btn btn-secondary" role="button">
        <i class="fas fa-cancel fa-sm"></i>
        Mégsem
    </a>
</div>


<script src="<?php echo VIEWS_URL; ?>/vendor/ckfinder3511/ckfinder.js"></script>
<script src="<?php echo VIEWS_URL; ?>/vendor/ckeditor5/ckeditor.js"></script>

<script>

        jQuery(document).ready(function () {
            jQuery("#newsPublished").datepicker();
            jQuery("#newsPublishedTo").datepicker();
        });

        var actNewsItemImageHolder = null;

        function selectNewImage(input) {
            var uploadImageBtn = jQuery(input).closest(".newsItemImageHolder").find(".uploadImageBtn");
            uploadImageBtn.removeClass("disabled");
            uploadImageBtn.removeAttr("disabled");
            uploadImageBtn.html("<i class=\"fas fa-file-upload\"></i> Feltöltés");
        }

        function uploadImage(uploadbtn) {
            actNewsItemImageHolder = jQuery(uploadbtn).closest('.newsItemImageHolder');
            if (!window.File || !window.FileReader || !window.FileList || !window.Blob) {
                alert('The File APIs are not fully supported in this browser.');
                return;
            }
            var file = actNewsItemImageHolder.find('.newsItemImage').prop('files')[0];
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
                    actNewsItemImageHolder.find(".newsItemIdImage").val(res.data.idimage);
                    actNewsItemImageHolder.find(".uploadImageBtn").attr("disabled", true);
                    actNewsItemImageHolder.find(".uploadImageBtn").addClass("disabled");
                    actNewsItemImageHolder.find(".uploadImageBtn").html("Feltöltés kész");
                } else {
                    alert("hiba a kép feltöltése közben");
                }
            }
        }

        function addNewNewsItem() {
            var newNewsItem = jQuery("#newNewsItem").clone();
            newNewsItem.addClass("newsItem");
            newNewsItem.css("display", "flex");
            jQuery("#newsItemsHolderDiv").append(newNewsItem);
            jQuery("#newsItemsHolderDiv").append("<br/>");
        }

        function delNewsItem(item) {
            if (jQuery(item).closest(".newsItem").attr("data-status") == 1) {
                jQuery(item).closest(".newsItem").attr("data-status", 0);
                jQuery(item).addClass("text-danger");
            } else {
                jQuery(item).closest(".newsItem").attr("data-status", 1);
                jQuery(item).removeClass("text-danger");
            }
        }

        var news_editor;

        function save() {
            var content = btoa(unescape(encodeURIComponent(news_editor.getData())));
            var data = {
                idnew: <?php echo $news["idnew"]; ?>,
                content: content,
                title: jQuery("#newsTitle").val(),
                published: jQuery("#newsPublished").val(),
                published_to: jQuery("#newsPublishedTo").val(),
                short_desc: jQuery("#newsShortDesc").val(),
                idposition: jQuery("#newsPosition").val(),
                status: 1
            };
            jQuery.ajax({
                url: "<?php echo ADMIN_API_URL; ?>news",
                type: "POST",
                async: false,
                dataType: 'json',
                data: JSON.stringify(data),
                newsType: 'application/json',
                //headers: ko.toJS(headers)
            }).done(function (response) {
                if (response.errorCode == 0) {
                    if (response.data && Number(response.data.idnew) > 1) {
                        saveNewsItems();
                    }
                } else {
                    jQuery("#errorMessage").html(response.msg);
                }
            }).fail(function (response) {
                console.log('error log : ', response);
                jQuery("#errorMessage").html('Hiba a mentés közben!');
            });
        }

        function saveNewsItems() {
            var news_items = [];
            //össze kell szedni a menü itemeket
            jQuery(".newsItem").each(function (index, item) {
                var new_item = {
                    idnew_item: (Number(jQuery(item).attr("data-id") > 1)) ? jQuery(item).attr("data-id") : null,
                    title: jQuery(item).find(".newsItemTitle").val(),
                    type: 'image',
                    idnew: <?php echo $news["idnew"]; ?>,
                    item_id: jQuery(item).find(".newsItemIdImage").val(),
                    status: jQuery(item).attr("data-status")
                };
                if (Number(new_item.idnew_item) > 1 || (new_item.status == 1)) {
                    news_items.push(new_item);
                }
            });
            if (news_items.length > 0) {
                jQuery.ajax({
                    url: "<?php echo ADMIN_API_URL; ?>news_item",
                    type: "POST",
                    async: false,
                    dataType: 'json',
                    data: JSON.stringify(news_items),
                    contentType: 'application/json'
                            //headers: ko.toJS(headers)
                }).done(function (response) {
                    if (response.errorCode == 0) {
                        if (response.data) {
                            window.location = '<?php echo FULL_BASE_URL . 'news/list/'; ?>';
                        }
                    } else {
                        jQuery("#errorMessage").html(response.msg);
                    }
                }).fail(function (response) {
                    console.log('error log : ', response);
                    jQuery("#errorMessage").html('Hiba a mentés közben!');
                });
            } else {
                window.location = '<?php echo FULL_BASE_URL . 'news/list/'; ?>';
            }
        }

        ClassicEditor.create( document.querySelector( '#editor' ), {
            toolbar: {
                items: [
                        'undo',
                        'redo',
                        'heading',
                        '|',
                        'removeFormat',
                        'bold',
                        'italic',
                        'underline',
                        'strikethrough',
                        'bulletedList',
                        'numberedList',
                        'todoList',
                        'fontFamily',
                        'fontSize',
                        'fontColor',
                        'highlight',
                        'fontBackgroundColor',
                        'alignment',
                        'indent',
                        'outdent',
                        'subscript',
                        'superscript',
                        'specialCharacters',
                        '|',
                        'insertTable',
                        'blockQuote',
                        'horizontalLine',
                        'code',
                        '|',
                        'link',
                        'imageUpload',
                        'CKFinder',
                        'codeBlock',
                        'exportPdf'
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
            licenseKey: ''
        } )
        .then( editor => {
            news_editor = editor;
        })
        .catch( error => {
            console.error( 'Oops, something went wrong!' );
            console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
            console.warn( 'Build id: m1r7oj2ao0fm-avyfabil7oss' );
            console.error( error );
        } );
</script>