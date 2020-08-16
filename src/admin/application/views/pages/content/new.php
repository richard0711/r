<h1 class="h3 mb-2 text-gray-800">Tartalom létrehozása</h1>
<p class="mb-4">Szerkessz saját tartalmat ízlés szerint</p>

<div id="editor"></div>

<script src="<?php echo VIEWS_URL; ?>/vendor/ckfinder3511/ckfinder.js"></script>
<script src="<?php echo VIEWS_URL; ?>/vendor/ckeditor5/ckeditor.js"></script>

<script>
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
        window.editor = editor;
    }).catch(err => {
        console.error(err.stack);
    });
</script>