<?php
$this->extend('templates/admin');

$this->section('page_title');
echo 'Pagina beheer';
$this->endSection();

$this->section('page_name');
echo 'Pagina\'s';
$this->endSection();

$this->section('content');

if (isset($validation)) : ?>
    <div class="alert alert-danger">
        <?= $validation->listErrors() ?>
    </div>
<?php endif; ?>

<?= form_open(route_to('savePages', (isset($data['id']) ? $data['id'] : 0))) ?>
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

    <div class="form-group">
        <?php
            echo form_label('Template', 'template');
            echo form_dropdown('template', $options, set_value('template',(isset($data['template']) ? $data['template'] : '')), 'class="form-control"');
        ?>
    </div>

    <div class="form-group">
        <?php
        echo form_label('Content', 'content');
        $data2 = [
            'name' => 'content',
            'id' => 'editor1',
            'value' => set_value('content', (isset($data['content']) ? $data['content'] : ''), false),
            'class' => 'form-control'
        ];
        echo form_textarea($data2);
        ?>
    </div>

    <input type="submit" name="submit" class="btn btn-primary" value="Opslaan">
<?= form_close() ?>

<?php
$this->endSection();
?>