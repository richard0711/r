<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Menü lista</h1>
<p class="mb-4">Rendszerben található menük listája</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="<?php echo FULL_BASE_URL . 'menu/new'; ?>" class="btn btn-primary" role="button">
            <i class="fas fa-file fa-sm"></i>
            Új menü
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Megnevezés</th>
                        <th>Alcím</th>
                        <th>Almenüpontok</th>
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
                            <td><?php echo $item["title"]; ?></td>
                            <td><?php echo $item["sub_title"]; ?></td>
                            <td></td>
                            <td>
                                <div class="btn-group">
                                    <a href="<?php echo FULL_BASE_URL . 'menu/edit/' . $item["idmenu"]; ?>" class="btn-sm btn-secondary" role="button">
                                        <i class="fas fa-pen fa-sm"></i>
                                    </a> 
                                </div>
                                <div class="btn-group">
                                    <a href="<?php echo FULL_BASE_URL . 'menu/del/' . $item["idmenu"]; ?>" class="btn-sm btn-secondary" role="button">
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