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
        <tbody>
            <?php foreach ($list["data"] as $item) { ?>
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