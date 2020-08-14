<h1 class="h3 mb-2 text-gray-800">Tartalom létrehozása</h1>
<p class="mb-4">Szerkessz saját tartalmat ízlés szerint</p>

<div id="editor">a</div>

<script src="<?php echo VIEWS_URL; ?>/vendor/ckeditor5/ckeditor.js"></script>

<script>
    ClassicEditor.create(document.querySelector('#editor'), {
        
        image: {
            toolbar: [
                'imageStyle:full',
                'imageStyle:side',
                '|',
                'imageTextAlternative'
            ]
        },
        language: 'de'
    }).then(editor => {
        window.editor = editor;
    }).catch(err => {
        console.error(err.stack);
    });
</script>