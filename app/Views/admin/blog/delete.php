<?= $this->extend('templates/admin') ?>

<?= $this->section('content') ?>

<h1>Blogartikel Verwijderen</h1>

<p>Weet je zeker dat je het blogartikel "<?= esc($blog['title']) ?>" wilt verwijderen?</p>

<div class="mt-3">
    <a href="<?= route_to('adminBlogDeleteSure', $blog['id']) ?>" class="btn btn-danger">Ja, definitief verwijderen</a>
    <a href="<?= route_to('adminBlog') ?>" class="btn btn-secondary">Nee, annuleren</a>
</div>

<?= $this->endSection() ?>