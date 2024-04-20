<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead class="thead-light">
            <tr>
                <th>Megnevezés</th>
                <th>Alcím</th>
                <th>Almenüpontok</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list["data"] as $item) { ?>
                <tr>
                    <td><?php echo $item["title"]; ?></td>
                    <td><?php echo $item["sub_title"]; ?></td>
                    <td></td>
                    <td>
                        <div class="btn-group">
                            <a href="javascript:void(null);" onclick="showmenustruct(<?php echo $item["idmenu"]; ?>);" data-toggle="tooltip" title="Menüpontok mutatása" class="btn-sm btn-secondary" role="button">
                                <i class="fas fa-bars fa-sm"></i>
                            </a> 
                        </div>
                        <div class="btn-group">
                            <a href="<?php echo FULL_BASE_URL . 'menu/edit/' . $item["idmenu"]; ?>"  data-toggle="tooltip" title="Szerkesztés" class="btn-sm btn-secondary" role="button">
                                <i class="fas fa-pen fa-sm"></i>
                            </a> 
                        </div>
                        <div class="btn-group">
                            <a href="<?php echo FULL_BASE_URL . 'menu/del/' . $item["idmenu"]; ?>"  data-toggle="tooltip" title="Törlés" class="btn-sm btn-secondary" role="button">
                                <i class="fas fa-trash fa-sm"></i>
                            </a> 
                        </div>
                    </td>
                </tr>
                <tr class="menu_<?php echo $item["idmenu"]; ?>" style="display:none;">
                    <td colspan="4">
                        <?php 
                            $this->load->view('pages/menu/menu_struct', 
                                array(
                                    'menu_items' => $item["menu_items"]
                                )
                            );
                        ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script>
    
    function showmenustruct(num) {
        jQuery(".menu_"+num).toggle();
    }
    
</script>