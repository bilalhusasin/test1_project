<?php
$this->extend('templates/admin');

$this->section('page_title');
echo 'Template beheer';
$this->endSection();

$this->section('page_name');
echo 'Template verwijderen';
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
        Weet u zeker dat u deze wilt verwijderen? 
        <a href="<?php echo route_to('deleteSureTemplate', $data['id']); ?>" class="btn btn-primary">Ja</a>
        <a href="<?php echo route_to('templates'); ?>" class="btn btn-primary">Nee</a>
    </div>
</div>

<?php
$this->endSection();
?>