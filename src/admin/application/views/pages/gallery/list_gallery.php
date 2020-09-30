<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead class="thead-light">
            <tr>
                <th>Galéria neve</th>
                <th>Publikálva</th>
                <th>Publikálás vége</th>
                <th>Képek száma</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list["data"] as $item) { ?>
                <tr>
                    <td><?php echo $item["name"]; ?></td>
                    <td><?php echo formatted_date_time($item["published_from"]); ?></td>
                    <td><?php echo formatted_date_time($item["published_to"]); ?></td>
                    <td><?php echo $item["gallery_items"]["count"].' db'; ?></td>
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