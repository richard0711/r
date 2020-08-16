<h1 class="h3 mb-2 text-gray-800">Tartalom létrehozása</h1>
<p class="mb-4">Szerkessz saját tartalmat ízlés szerint</p>

<div id="editor"></div>

<script src="<?php echo VIEWS_URL; ?>/vendor/ckeditor5/ckeditor.js"></script>
<script>
    ClassicEditor.create(document.querySelector('#editor'), {
//        fontFamily: {
//            options: [
//                // ...
//            ],
//            supportAllValues: true
//        },
        toolbar: [
            "alignment:left", "alignment:right", "alignment:center", "alignment:justify", "alignment", "blockQuote", "bold", "ckfinder", "code", "codeBlock", "selectAll", "undo", "redo", "exportPdf", "fontBackgroundColor", "fontColor", "fontFamily", "fontSize", "heading", "highlight:yellowMarker", "highlight:greenMarker", "highlight:pinkMarker", "highlight:blueMarker", "highlight:redPen", "highlight:greenPen", "removeHighlight", "highlight", "horizontalLine", "imageTextAlternative", "imageResize:original", "imageResize:25", "imageResize:50", "imageResize:75", "imageResize", "imageStyle:full", "imageStyle:side", "imageUpload", "indent", "outdent", "italic", "link", "numberedList", "bulletedList", "removeFormat", "specialCharacters", "strikethrough", "insertTable", "tableColumn", "tableRow", "mergeTableCells", "tableCellProperties", "tableProperties", "todoList", "underline"
        ],
        image: {
            toolbar: [
                'imageStyle:full',
                'imageStyle:side',
                '|',
                'imageTextAlternative'
            ]
        }
//        language: 'hu'
    }).then(editor => {
        window.editor = editor;
    }).catch(err => {
        console.error(err.stack);
    });
</script>