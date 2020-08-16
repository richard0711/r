<h1 class="h3 mb-2 text-gray-800">Tartalom létrehozása</h1>
<p class="mb-4">Szerkessz saját tartalmat ízlés szerint</p>

<div class="form-group">
    <div id="editor"></div>
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

        var content_editor;

        function save() {
            var content = btoa(unescape(encodeURIComponent(content_editor.getData())));
            var data = {
                content: content
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
                debugger;
            }).fail(function (response) {
                debugger;
                alert("ERROR");
            });
        }

        jQuery(document).ready(function () {

        });

        ClassicEditor.create(document.querySelector('#editor'), {
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
                    'fontFamily',
                    'fontBackgroundColor',
                    'fontColor',
                    'fontSize',
                    'highlight',
                    'todoList',
                    'bulletedList',
                    'numberedList',
                    'indent',
                    'outdent',
                    'alignment',
                    '|',
                    'insertTable',
                    'horizontalLine',
                    'blockQuote',
                    'codeBlock',
                    '|',
                    'CKFinder',
                    'imageUpload',
                    'link',
                    //'mediaEmbed',
                    'code',
                    'exportPdf',
                    'specialCharacters'
                ]
            },
            ckfinder: {
                uploadUrl: '<?php echo VIEWS_URL; ?>/vendor/ckfinder3511/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
                // Open the file manager in the pop-up window.
                openerMethod: 'popup'
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
        }).then(editor => {
            content_editor = editor;
        }).catch(err => {
            console.error(err.stack);
        });
</script>