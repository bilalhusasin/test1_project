<?php
$this->extend('templates/public');

$this->section('page_title');
echo $data['meta-title'];
$this->endSection();

$this->section('page_description');
echo $data['meta-desc'];
$this->endSection();

$this->section('content');
?>



<?php
$this->endSection();
?>