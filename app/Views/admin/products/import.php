<?php
$this->extend('templates/admin');

$this->section('page_title');
echo 'Importeren / updaten aanbod';
$this->endSection();

$this->section('content');
?>

<main class="main__area">
    <div class="container-fluid">
        <div class="dashboard__data__lists">
            <div class="page__title mb-3">
                <div class="row align-items-center">
                    <?php
                    if(session()->get('success')){
                        echo '<div class="alert alert-success w-100" role="alert">
                            '.session('success').'
                        </div>';
                    }
                    
                    if(session()->get('danger')){
                        echo '
                            <div class="alert alert-danger w-100">' . session()->get('danger') . '</div>
                        ';
                    }
                    ?>
                    <div class="col-md-8 col-sm-7">
                        <div class="page__title__left">
                            <h3>Importeren / updaten aanbod</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <form action="<?= route_to('importAanbodSave') ?>" method="post" id="formFile" enctype="multipart/form-data">
                        <input type="file" class="common-btn" id="userfile" name="userfile" /> <br/><br/>
                        <input type="submit" class="common-btn" value="+ Importeren">
                    </form> 
                </div>
            </div>
        </div>
    </div>
</main>

<?php
$this->endSection();
?>