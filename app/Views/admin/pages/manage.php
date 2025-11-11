<?php
$this->extend('templates/admin');

$this->section('page_title');
echo 'Pagina beheer';
$this->endSection();

$this->section('page_name');
echo 'Pagina\'s';
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
        <!--<a href="<?php echo route_to('createPages'); ?>" class="btn btn-primary">Nieuwe pagina</a>-->
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Naam</th>
                        <th>Content</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Naam</th>
                        <th>Content</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    foreach ($data as $page) {     
                        if($page['url'] != '/'){
                            echo '
                                <tr>
                                    <td>'.$page['name'].'</td>
                                    <td><a href="'.route_to('content', $page['id']).'">Content</a></td>
                                </tr>
                            ';
                        }
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