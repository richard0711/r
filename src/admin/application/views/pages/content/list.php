<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Tartalmak</h1>
<p class="mb-4">Rendszerben található tartalmak listája</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="<?php echo FULL_BASE_URL . 'content/new'; ?>" class="btn btn-primary" role="button">
            <i class="fas fa-file fa-sm"></i>
            Új tartalom
        </a>
    </div>
    <div class="card-body">
        <div class="form-group row list-nav-bar">
            <div class="col-xs-12 col-lg-6 col-md-6 list-pager-info text-right">
                <span class="list-pager-info-fromto"> 1 - 10 </span>
                / 
                <span class="list-pager-info-sum"><?php echo $list["count"]; ?></span>
            </div>
            <div class="col-xs-12 col-lg-6 col-md-6">
                <div class="input-group">
                    <input onchange="search(this);" type="text" class="form-control search-string" placeholder="Keresés">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-outline-secondary">
                            <i class="fas fa-sync fa-sm"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-12 col-lg-12 col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th>Cím</th>
                                <th>Publikálva</th>
                                <th>Publikálás vége</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tfoot class="thead-light">
                            <tr>
                                <th>Cím</th>
                                <th>Publikálva</th>
                                <th>Publikálás vége</th>
                                <th></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($list["data"] as $item) { ?>
                                <tr>
                                    <td><?php echo $item["title"]; ?></td>
                                    <td><?php echo formatted_date_time($item["published"]); ?></td>
                                    <td><?php echo formatted_date_time($item["published_to"]); ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="<?php echo FULL_BASE_URL . 'content/edit/' . $item["idcontent"]; ?>" class="btn-sm btn-secondary" role="button">
                                                <i class="fas fa-pen fa-sm"></i>
                                            </a> 
                                        </div>
                                        <div class="btn-group">
                                            <a href="<?php echo FULL_BASE_URL . 'content/del/' . $item["idcontent"]; ?>" class="btn-sm btn-secondary" role="button">
                                                <i class="fas fa-trash fa-sm"></i>
                                            </a> 
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="form-group row list-pager">
            <div class="col-xs-12 col-lg-12 col-sm-12 text-center">
                <input class="list-pager-offset" type="hidden" value="0"/>
                <input class="list-pager-limit" type="hidden" value="10"/>
                <input class="list-pager-active-page" type="hidden" value="1"/>
               <?php
                $limit = 10;
                $offset = 0;
                $max_btn_count = 6;
                for ($i = 0; $i < (ceil($list["count"]/$limit)); $i++) {
                    if ($i == 0) {
                        echo '<input class="list-pager-active list-pager-btn" onclick="selectPage(this);" type="button" value="'.($i+1).'">';
                    } else if ($max_btn_count > $i) {
                        echo '<input class="list-pager-btn" onclick="selectPage(this);" type="button" value="'.($i+1).'">';
                    } else if ($max_btn_count == $i) {
                        echo '...';
                    } else if ($i == ($list["count"]-1)) {
                        echo '<input class="list-pager-btn" onclick="selectPage(this);" type="button" value="'.($i+1).'">';
                    }
                }
               ?>
            </div>
        </div>
    </div>
</div>

<script>
    
    function selectPage(input) {
        jQuery(".list-pager-btn").removeClass('list-pager-active');
        jQuery(input).addClass('list-pager-active');
        jQuery(".list-pager-offset").val((jQuery(input).val()-1)*jQuery(".list-pager-limit").val());
        getList();
    }
    
    function search(input) {
        getList();
    }
    
    function getList() {
        var data = {
            "string": jQuery(".search-string").val(),
            "limit": jQuery(".list-pager-limit").val(),
            "offset": jQuery(".list-pager-offset").val()
        };
        jQuery.ajax({
            url: "<?php echo ADMIN_API_URL; ?>contents",
            type: "GET",
            async: false,
            dataType: 'json',
            data: data,
            contentType: 'application/json'
        }).done(function (response) {
            debugger;
            if (response.errorCode == 0) {
               
            } else {
                
            }
        }).fail(function (response) {
            console.log('error log : ', response);
            jQuery("#errorMessage").html('Hiba a mentés közben!');
        });
    }
    
    jQuery(document).ready(function() {
        
    });
</script>