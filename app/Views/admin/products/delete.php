<?php
$this->extend('templates/admin');

$this->section('page_title');
echo 'Products beheer';
$this->endSection();

$this->section('page_name');
echo 'Products';
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
        <a href="<?php echo route_to('deleteSureProduct', $data['id']); ?>" class="btn btn-primary">Ja</a>
        <a href="<?php echo route_to('products'); ?>" class="btn btn-primary">Nee</a>
    </div>
</div>

<?php
$this->endSection();
?>