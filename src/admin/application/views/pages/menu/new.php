<h1 class="h3 mb-2 text-gray-800">Menü létrehozása</h1>
<p class="mb-4">Hozd létre a kívánt menüt</p>

<div class="form-group row">
    <div class="col-sm-12">
        <label for="menuTitle">Megnevezés</label>
        <input type="text" class="form-control" id="menuTitle" placeholder="Menü megnevezése">
        <small id="menuTitleHelp" class="form-text text-danger"></small>
    </div> 
</div> 
<div class="form-group row">
    <div class="col-sm-12">
        <label for="menuSubTitle">Alcím</label>
        <input type="text" class="form-control" id="menuSubTitle" placeholder="Alcím">
        <small id="menuSubTitleHelp" class="form-text text-danger"></small>
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
    <a href="<?php echo FULL_BASE_URL . 'menu/list'; ?>" class="btn btn-secondary" role="button">
        <i class="fas fa-cancel fa-sm"></i>
        Mégsem
    </a>
</div>

<script>
    jQuery(document).ready(function () {

    });

    function save() {
        var data = {
            title: jQuery("#menuTitle").val(),
            sub_title: jQuery("#menuSubTitle").val(),
            idimage: 1,
            status: 1
        };
        
        //validation:
        if (data.title == null | data.title == '') {
            jQuery("#menuTitleHelp").html('A megnevezés kitöltése kötelező!');
            return;
        }
        
        jQuery.ajax({
            url: "<?php echo ADMIN_API_URL; ?>menu",
            type: "POST",
            async: false,
            dataType: 'json',
            data: JSON.stringify(data),
            contentType: 'application/json',
            //headers: ko.toJS(headers)
        }).done(function (response) {
            if (response.errorCode == 0) {
                if (response.data && Number(response.data.idmenu) > 1) {
                    window.location = '<?php echo FULL_BASE_URL.'menu/edit/'; ?>' + response.data.idmenu;
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