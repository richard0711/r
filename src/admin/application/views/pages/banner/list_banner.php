<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Megnevezés</th>
                <th>Típus</th>
                <th>Banner elemek</th>
                <th></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Megnevezés</th>
                <th>Alcím</th>
                <th>Almenüpontok</th>
                <th></th>
            </tr>
        </tfoot>
        <tbody>
            <?php foreach ($list["data"] as $item) { ?>
                <tr>
                    <td><?php echo $item["name"]; ?></td>
                    <td><?php echo $item["type"]; ?></td>
                    <td></td>
                    <td>
                        <div class="btn-group">
                            <a href="<?php echo FULL_BASE_URL . 'banner/edit/' . $item["idbanner"]; ?>" class="btn-sm btn-secondary" role="button">
                                <i class="fas fa-pen fa-sm"></i>
                            </a> 
                        </div>
                        <div class="btn-group">
                            <a href="<?php echo FULL_BASE_URL . 'banner/del/' . $item["idbanner"]; ?>" class="btn-sm btn-secondary" role="button">
                                <i class="fas fa-trash fa-sm"></i>
                            </a> 
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>