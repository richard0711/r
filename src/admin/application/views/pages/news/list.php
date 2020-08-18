<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Hírek</h1>
<p class="mb-4">Rendszerben található hírek listája</p>

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
                        <th>Alcím</th>
                        <th>Publikálva</th>
                        <th>Utoljára szerkesztve</th>
                        <th>Szerkesztette</th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Cím</th>
                        <th>Alcím</th>
                        <th>Publikálva</th>
                        <th>Utoljára szerkesztve</th>
                        <th>Szerkesztette</th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                    <tr>
                        <td>Tiger Nixon</td>
                        <td>System Architect</td>
                        <td>Edinburgh</td>
                        <td>61</td>
                        <td>2011/04/25</td>
                        <td>$320,800</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>