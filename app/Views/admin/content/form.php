<?php
$this->extend('templates/admin');

$this->section('page_title');
echo 'Content beheer';
$this->endSection();

$this->section('page_name');
echo 'Content';
$this->endSection();

$this->section('content');

if (isset($validation)) : ?>
    <div class="alert alert-danger">
        <?= $validation->listErrors() ?>
    </div>
<?php endif; ?>

<?php
if($type == 'edit'){
    echo form_open(route_to('saveContent_edit', $page_id, $data['id']));
}else if($type == 'create'){
    echo form_open(route_to('saveContent_new', $page_id));
}
?>

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

    <?= form_hidden('page_id', $page_id); ?>

    <input type="submit" name="submit" class="btn btn-primary" value="Opslaan">
<?= form_close() ?>

<?php
$this->endSection();
?>