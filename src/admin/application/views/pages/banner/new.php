<h1 class="h3 mb-2 text-gray-800">Banner létrehozása</h1>
<p class="mb-4">Hozd létre a kívánt bannert</p>

<div class="form-group row">
    <div class="col-sm-12">
        <label for="bannerName">Megnevezés</label>
        <input type="text" class="form-control" id="bannerName" placeholder="Banner megnevezése">
        <small id="bannerNameHelp" class="form-text text-danger"></small>
    </div> 
</div>
<div class="form-group row">
    <div class="col-sm-12">
        <label for="bannerType">Típus</label>
        <select type="text" 
                class="form-control bannerType" 
                value="1" 
                id="bannerType" 
                placeholder="Banner típusa">
            <option value="normal">Normál</option>
            <option value="slideshow">SlideShow</option>
        </select>
        <small id="bannerTypeHelp" class="form-text text-danger"></small>
    </div> 
</div>
<div class="form-group row">
    <div class="col-sm-12">
        <label for="bannerPosition">Pozíció</label>
        <select type="text" 
                class="form-control bannerPosition" 
                value="1" 
                id="bannerPosition" 
                placeholder="Pozíció">
            <option value="1">--nincs kiválasztva--</option>
            <?php
            if (isset($positions) && isset($positions["data"])) {
                foreach ($positions["data"] as $position) {
                    ?>
                    <option value="<?php echo $position["idposition"]; ?>">
                        <?php echo $position["name"] ?></option>
                    <?php
                }
            }
            ?>
        </select>
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
    <a href="<?php echo FULL_BASE_URL . 'banner/list'; ?>" class="btn btn-secondary" role="button">
        <i class="fas fa-cancel fa-sm"></i>
        Mégsem
    </a>
</div>

<script>
    jQuery(document).ready(function () {

    });

    function save() {
        var data = {
            idposition: jQuery("#bannerPosition").val(),
            name: jQuery("#bannerName").val(),
            type: jQuery("#bannerType").val(),
            status: 1
        };

        //validation:
        if (data.name == null | data.name == '') {
            jQuery("#bannerNameHelp").html('A megnevezés kitöltése kötelező!');
            return;
        }

        jQuery.ajax({
            url: "<?php echo ADMIN_API_URL; ?>banner",
            type: "POST",
            async: false,
            dataType: 'json',
            data: JSON.stringify(data),
            contentType: 'application/json',
            //headers: ko.toJS(headers)
        }).done(function (response) {
            if (response.errorCode == 0) {
                if (response.data && Number(response.data.idbanner) > 1) {
                    window.location = '<?php echo FULL_BASE_URL . 'banner/edit/'; ?>' + response.data.idbanner;
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