<h1 class="h3 mb-2 text-gray-800">Menüpont létrehozása</h1>
<p class="mb-4">Hozd létre a kívánt menüpontokat</p>

<div class="form-group row">
    <div class="col-sm-12">
        <label for="menuTitle">Megnevezés</label>
        <input type="text" class="form-control" id="contentTitle" placeholder="Menüpont megnevezése">
    </div> 
    <div class="col-sm-12">
        <label for="menuSubTitle">Alcím</label>
        <input type="text" class="form-control" id="contentPublished" placeholder="Alcím">
    </div>
</div>

<div class="form-group">
    
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
                subt_title: jQuery("#menuSubTitle").val()
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
                debugger;
            }).fail(function (response) {
                debugger;
                alert("ERROR");
            });
        }
</script>