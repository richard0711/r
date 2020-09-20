<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Indítópult</h1>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        Utolsó 5 tartalom
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Cím</th>
                        <th>Publikálva</th>
                        <th>Publikálás vége</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($last_contents["data"] as $item) { ?>
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


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        Utolsó 5 hír
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Cím</th>
                        <th>Publikálva</th>
                        <th>Publikálás vége</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($last_news["data"] as $item) { ?>
                        <tr>
                            <td><?php echo $item["title"]; ?></td>
                            <td><?php echo formatted_date_time($item["published"]); ?></td>
                            <td><?php echo formatted_date_time($item["published_to"]); ?></td>
                            <td>
                                <div class="btn-group">
                                    <a href="<?php echo FULL_BASE_URL . 'news/edit/' . $item["idnew"]; ?>" class="btn-sm btn-secondary" role="button">
                                        <i class="fas fa-pen fa-sm"></i>
                                    </a> 
                                </div>
                                <div class="btn-group">
                                    <a href="<?php echo FULL_BASE_URL . 'news/del/' . $item["idnew"]; ?>" class="btn-sm btn-secondary" role="button">
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
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        Utolsó 5 galéria
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Galéria neve</th>
                        <th>Képek száma</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($last_gallery["data"] as $item) { ?>
                        <tr>
                            <td><?php echo $item["name"]; ?></td>
                            <td></td>
                            <td>
                                <div class="btn-group">
                                    <a href="<?php echo FULL_BASE_URL . 'gallery/edit/' . $item["idgallery"]; ?>" class="btn-sm btn-secondary" role="button">
                                        <i class="fas fa-pen fa-sm"></i>
                                    </a> 
                                </div>
                                <div class="btn-group">
                                    <a href="<?php echo FULL_BASE_URL . 'gallery/del/' . $item["idgallery"]; ?>" class="btn-sm btn-secondary" role="button">
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



