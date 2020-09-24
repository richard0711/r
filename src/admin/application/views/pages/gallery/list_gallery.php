<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Galéria neve</th>
                <th>Utoljára szerkesztve</th>
                <th>Képek száma</th>
                <th></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Galéria neve</th>
                <th>Utoljára szerkesztve</th>
                <th>Képek száma</th>
                <th></th>
            </tr>
        </tfoot>
        <tbody>
            <?php foreach ($list["data"] as $item) { ?>
                <tr>
                    <td><?php echo $item["name"]; ?></td>
                    <td></td>
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