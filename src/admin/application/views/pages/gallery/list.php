<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Galéria lista</h1>
<p class="mb-4">Rendszerben található galériák listája</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="<?php echo FULL_BASE_URL . 'gallery/new'; ?>" class="btn btn-primary" role="button">
            <i class="fas fa-file fa-sm"></i>
            Új galéria
        </a>
    </div>
    <div class="card-body">
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
    </div>
</div>