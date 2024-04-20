<h1 class="h3 mb-2 text-gray-800">Menü törlése</h1>
<p class="mb-4 text-warning">Biztos vagy benne, hogy törlöd a <?php echo $menu["title"]; ?> nevű menüt?</p>

<div class="form-group row">
    <div class="col-sm-12">
        <small id="errorMessage" class="form-text text-danger"></small>
    </div> 
</div>

<div class="">
    <a onclick="save()" href="javascript:void(0);" class="btn btn-danger" role="button">
        <i class="fas fa-save fa-sm"></i>
        Törlés
    </a> 
    <a href="<?php echo FULL_BASE_URL . 'menu/list'; ?>" class="btn btn-secondary" role="button">
        <i class="fas fa-cancel fa-sm"></i>
        Mégsem
    </a>
</div> 

<script>

    function save() {
        var data = {
            idmenu: <?php echo $menu["idmenu"]; ?>,
            status: 0
        };
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
                    window.location = '<?php echo FULL_BASE_URL.'menu/list'; ?>';
                }
            } else {
                jQuery("#errorMessage").html(response.msg);
            }
        }).fail(function (response) {
            console.log('error log : ', response);
            jQuery("#errorMessage").html('Hiba a törlés közben!');
        });
    }
</script>