<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Hírek</h1>
<p class="mb-4">Rendszerben található tartalmak listája</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="<?php echo FULL_BASE_URL.'news/new'; ?>" class="btn btn-primary" role="button">
            <i class="fas fa-file fa-sm"></i>
            Új hír
        </a>
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
                <tfoot>
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
                            <td><?php echo $item["published"]; ?></td>
                            <td><?php echo $item["published_to"]; ?></td>
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