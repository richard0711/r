<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Bannerek listája</h1>
<p class="mb-4">Rendszerben található bannerek listája</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="<?php echo FULL_BASE_URL . 'banner/new'; ?>" class="btn btn-primary" role="button">
            <i class="fas fa-file fa-sm"></i>
            Új banner
        </a>
    </div>
    <div class="card-body">
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
    </div>
</div>