<h1 class="h3 mb-2 text-gray-800">Galéria létrehozása</h1>
<p class="mb-4">Hozd létre a kívánt galériát</p>

<div class="form-group row">
    <div class="col-sm-12">
        <label for="galleryName">Galéria neve</label>
        <input type="text" class="form-control" id="galleryName" placeholder="Galéria neve">
        <small id="galleryNameHelp" class="form-text text-danger"></small>
    </div> 
</div> 
<div class="form-group row">
    <div class="col-sm-12">
        <label for="galleryText">Leírás</label>
        <textarea class="form-control" id="galleryText"></textarea>
        <small id="galleryTextHelp" class="form-text text-danger"></small>
    </div>
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
    <a href="<?php echo FULL_BASE_URL . 'gallery/list'; ?>" class="btn btn-secondary" role="button">
        <i class="fas fa-cancel fa-sm"></i>
        Mégsem
    </a>
</div>

<script>
    jQuery(document).ready(function () {

    });

    function save() {
        var data = {
            name: jQuery("#galleryName").val(),
            text: jQuery("#galleryText").val(),
            status: 1
        };
        //validation:
        if (data.name == null | data.name == '') {
            jQuery("#galleryNameHelp").html('A megnevezés kitöltése kötelező!');
            return;
        }
        jQuery.ajax({
            url: "<?php echo ADMIN_API_URL; ?>gallery",
            type: "POST",
            async: false,
            dataType: 'json',
            data: JSON.stringify(data),
            contentType: 'application/json'
        }).done(function (response) {
            if (response.errorCode == 0) {
                if (response.data && Number(response.data.idgallery) > 1) {
                    window.location = '<?php echo FULL_BASE_URL.'gallery/edit/'; ?>' + response.data.idgallery;
                }
            } else {
                jQuery("#errorMessage").html(response.msg);
            }
        }).fail(function (response) {
            console.log('error log : ', response);
            jQuery("#errorMessage").html('Hiba a mentés közben!');
        });
    }
</script>