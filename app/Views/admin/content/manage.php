<?php
$this->extend('templates/admin');

$this->section('page_title');
echo 'Content beheer';
$this->endSection();

$this->section('page_name');
echo 'Content';
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
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Naam</th>
                        <th>Bewerken</th>
                        <th>Verwijderen</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Naam</th>
                        <th>Bewerken</th>
                        <th>Verwijderen</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    foreach ($data as $page) {                        
                        echo '
                            <tr>
                                <td>'.$page['name'].'</td>
                                <td><a href="'.route_to('editContent', $page_id, $page['id']).'">Bewerken</a></td>
                                <td><a href="'.route_to('deleteContent', $page_id, $page['id']).'">Verwijderen</a></td>
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