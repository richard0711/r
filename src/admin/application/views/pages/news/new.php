<h1 class="h3 mb-2 text-gray-800">Hír létrehozása</h1>
<p class="mb-4">Szerkeszd meg a hírt ízlés szerint</p>

<div class="form-group row">
    <div class="col-sm-6 mb-3 mb-sm-0">
        <label for="newsTitle">Hír címe</label>
        <input type="text" class="form-control form-control-user" id="newsTitle" placeholder="Hír címe">
        <small id="newsTitleHelp" class="form-text text-danger"></small>
    </div> 
    <div class="col-sm-3">
        <label for="newsPublished">Publikálás kezdete</label>
        <input type="text" class="form-control form-control-user" id="newsPublished" placeholder="Publikálás kezdete">
    </div> 
    <div class="col-sm-3">
        <label for="newsPublishedTo">Publikálás vége</label>
        <input type="text" class="form-control form-control-user" id="newsPublishedTo" placeholder="Publikálás vége">
    </div> 
    <div class="col-sm-12">
        <label for="newsShortDesc">Rövid leírás</label>
        <textarea type="text" class="form-control form-control-user" id="newsShortDesc" placeholder="Rövid leírás"></textarea>
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
        var news_editor;
        function save() {
            var content = btoa(unescape(encodeURIComponent(news_editor.getData())));
            var data = {
                title: jQuery("#newsTitle").val(),
                content: content,
                published: jQuery("#newsPublished").val(),
                published_to: jQuery("#newsPublishedTo").val(),
                short_desc: jQuery("#newsShortDesc").val(),
                status: 1
            };
            //validation:
            if (data.title == null | data.title == '') {
                jQuery("#newsTitleHelp").html('A hír címének kitöltése kötelező!');
                return;
            }
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
                        window.location = '<?php echo FULL_BASE_URL.'news/edit/'; ?>' + response.data.idnew;
                    }
                } else {
                    jQuery("#errorMessage").html(response.msg);
                }
            }).fail(function (response) {
                console.log('error log : ', response);
                jQuery("#errorMessage").html('Hiba a mentés közben!');
            });
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
            ckfinder: {
                uploadUrl: '<?php echo VIEWS_URL; ?>/vendor/ckfinder3511/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
                // Open the file manager in the pop-up window.
                openerMethod: 'popup'
            },
            licenseKey: ''
        } )
        .then( editor => {
            content_editor = editor;
        })
        .catch( error => {
            console.error( 'Oops, something went wrong!' );
            console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
            console.warn( 'Build id: m1r7oj2ao0fm-avyfabil7oss' );
            console.error( error );
        } );
</script>