<h1 class="h3 mb-2 text-gray-800">Tartalom létrehozása</h1>
<p class="mb-4">Szerkessz saját tartalmat ízlés szerint</p>

<div id="editor">a</div>

<script src="<?php echo VIEWS_URL; ?>/vendor/ckeditor5/ckeditor.js"></script>
<script src="<?php echo VIEWS_URL; ?>/vendor/ckeditor5/ckeditor5-font/src/font.js"></script>
<script src="<?php echo VIEWS_URL; ?>/vendor/ckeditor5/translations/hu.js"></script>
<script>
    ClassicEditor.create(document.querySelector('#editor'), {
        fontFamily: {
            options: [
                // ...
            ],
            supportAllValues: true
        },
        toolbar: [
            'heading', 'bulletedList', 'numberedList', 'fontFamily', 'undo', 'redo'
        ],
        image: {
            toolbar: [
                'imageStyle:full',
                'imageStyle:side',
                '|',
                'imageTextAlternative'
            ]
        },
        language: 'hu'
    }).then(editor => {
        window.editor = editor;
    }).catch(err => {
        console.error(err.stack);
    });
</script>