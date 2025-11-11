<?php
$this->extend('templates/admin');

$this->section('page_title');
echo 'Template beheer';
$this->endSection();

$this->section('page_name');
echo 'Templates';
$this->endSection();

$this->section('content');

if (isset($validation)) : ?>
    <div class="alert alert-danger">
        <?= $validation->listErrors() ?>
    </div>
<?php endif; ?>

<?= form_open(route_to('saveTemplate', (isset($data['id']) ? $data['id'] : 0))) ?>
    <div class="form-group">
        <?php
        echo form_label('Naam', 'name');
        $data2 = [
            'name' => 'name',
            'value' => set_value('name', (isset($data['name']) ? $data['name'] : '')),
            'class' => 'form-control'
        ];
        echo form_input($data2);
        ?>
    </div>

    <input type="submit" name="submit" class="btn btn-primary" value="Opslaan">
<?= form_close() ?>

<?php
$this->endSection();
?>