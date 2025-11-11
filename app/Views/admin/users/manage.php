<?php
$this->extend('templates/admin');

$this->section('page_title');
echo 'Klanten beheer';
$this->endSection();

$this->section('page_name');
echo 'Klanten';
$this->endSection();

$this->section('content');

if(session()->get('success')){
    echo '<div class="alert alert-success" role="alert">
        '.session('success').'
    </div>';
} 
?>


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="<?php echo route_to('registerUser'); ?>" class="btn btn-primary">Nieuwe klant</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>E-mailadres</th>
                        <th>Bewerken</th>
                        <th>Verwijderen</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>E-mailadres</th>
                        <th>Bewerken</th>
                        <th>Verwijderen</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    foreach ($data as $page) {                        
                        echo '
                            <tr>
                                <td><a href="mailto:'.$page['email'].'">'.$page['email'].'</a></td>
                                <td><a href="'.route_to('editUsers', $page['id']).'">Bewerken</a></td>
                                <td><a href="'.route_to('deleteUsers', $page['id']).'">Verwijderen</a></td>
                            </tr>
                        ';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
$this->endSection();
?>