<h1 class="h3 mb-2 text-gray-800">Tartalom létrehozása</h1>
<p class="mb-4">Szerkessz saját tartalmat ízlés szerint</p>

<div class="form-group row">
    <div class="col-sm-6 mb-3 mb-sm-0">
        <label for="customCheck">Tartalom címe</label>
        <input type="text" class="form-control form-control-user" id="contentTitle" placeholder="Tartalom címe">
    </div> 
    <div class="col-sm-3">
        <label for="contentPublished">Publikálás kezdete</label>
        <input type="text" class="form-control form-control-user" id="contentPublished" placeholder="Publikálás kezdete">
    </div> 
    <div class="col-sm-3">
        <label for="contentPublishedTo">Publikálás vége</label>
        <input type="text" class="form-control form-control-user" id="contentPublishedTo" placeholder="Publikálás vége">
    </div> 
    <div class="col-sm-12">
        <label for="contentShortDesc">Rövid leírás</label>
        <textarea type="text" class="form-control form-control-user" id="contentShortDesc" placeholder="Rövid leírás"></textarea>
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
                    <option 
                        value="<?php echo $position["idposition"]; ?>">
                        <?php echo $position["name"] ?></option>
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
            <label><input type="checkbox" id="contentContactForm" value="1"> Kapcsolati űrlap megjelenítés a tartalom mellett</label>
        </div>
    </div>
</div>

<div class="form-group">
    <div id="editor"></div>
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

        function save() {
            var content = btoa(unescape(encodeURIComponent(content_editor.getData())));
            var data = {
                content: content,
                title: jQuery("#contentTitle").val(),
                published: jQuery("#contentPublished").val(),
                published_to: jQuery("#contentPublishedTo").val(),
                short_desc: jQuery("#contentShortDesc").val(),
                idposition: jQuery("#contentPosition").val(),
                contactform: (jQuery("#contentContactForm").is(":checked")) ? 1 : 0,
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
                        window.location = '<?php echo FULL_BASE_URL . 'content/edit/'; ?>' + response.data.idcontent;
                    }
                } else {
                    jQuery("#errorMessage").html(response.msg);
                }
            }).fail(function (response) {
                console.log('error log : ', response);
                jQuery("#errorMessage").html('Hiba a mentés közben!');
            });
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