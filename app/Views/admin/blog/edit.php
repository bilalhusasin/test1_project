<?= $this->extend('templates/admin') ?>

<?= $this->section('content') ?>

<h1>Blogartikel Bewerken</h1>

<?php if (isset($validation)) : ?>
    <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
<?php endif; ?>

<form action="<?= route_to('adminBlogUpdate', $blog['id']) ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <input type="hidden" name="_method" value="PUT">

    <div class="mb-3">
        <label for="title" class="form-label">Titel</label>
        <input type="text" class="form-control" id="title" name="title" value="<?= old('title', $blog['title']) ?>">
    </div>
    <div class="mb-3">
        <label for="cat" class="form-label">Categorie</label>
        <select name="cat" id="cat" class="form-control">
            <option value="-1">-- Geen categorie --</option>
            <?php foreach ($cats as $cat): ?>
                <option value="<?= esc($cat['id']) ?>"
                    <?= old('cat', $blog['cat'] ?? '') == $cat['id'] ? 'selected' : '' ?>>
                    <?= esc($cat['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">Inhoud</label>
        <textarea id="editor1" name="content"><?= old('content', $blog['content']) ?></textarea>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Afbeelding</label>
        <input type="file" class="form-control" id="image" name="image">
        <?php if (isset($blog['image'])) : ?>
            <img src="<?= base_url('uploads/' . $blog['image']) ?>" alt="Huidige afbeelding" style="max-width: 200px; margin-top: 10px;">
        <?php endif; ?>
    </div>

    <button type="submit" class="btn btn-primary">Opslaan</button>
    <a href="<?= route_to('adminBlog') ?>" class="btn btn-secondary">Annuleren</a>
</form>

<?= $this->endSection() ?>

<?= $this->section('jsscript') ?>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<script type="text/javascript">   
    ClassicEditor
        .create(document.querySelector('#editor1'), {
            toolbar: [
            'heading', // Voor koppen (H1, H2, etc.)
            '|',
            'bold', 'italic', 'underline', 'strikethrough', 'subscript', 'superscript', 'removeFormat',
            '|',
            'fontSize', 'fontColor', 'fontBackgroundColor', // Lettertypes en kleuren
            '|',
            'alignment', // Tekstuitlijning
            'bulletedList', 'numberedList', '|', 'outdent', 'indent', // Lijsten en inspringing
            '|',
            'undo', 'redo', // Ongedaan maken/herhalen
        ]
    })
    .catch(error => {
        console.error('Er is een fout opgetreden:', error);
    });
</script>

<?= $this->endSection() ?>