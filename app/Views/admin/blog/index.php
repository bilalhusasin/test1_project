<?= $this->extend('templates/admin') ?>

<?= $this->section('content') ?>

<h1>Blog Overzicht</h1>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<p><a href="<?= route_to('adminBlogCreate') ?>" class="btn btn-primary">Nieuw Blogartikel</a></p>

<?php if (empty($blogs)) : ?>
    <p>Er zijn nog geen blogartikelen.</p>
<?php else : ?>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Titel</th>
                <th>Slug</th>
                <th>Geplaatst op</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($blogs as $blog) : ?>
                <tr>
                    <td><?= $blog['id'] ?></td>
                    <td><?= esc($blog['title']) ?></td>
                    <td><?= esc($blog['slug']) ?></td>
                    <td><?= \CodeIgniter\I18n\Time::parse($blog['created_at'])->toLocalizedString() ?></td>
                    <td>
                        <a href="<?= route_to('adminBlogEdit', $blog['id']) ?>" class="btn btn-sm btn-primary">Bewerken</a>
                        <a href="<?= route_to('adminBlogDelete', $blog['id']) ?>" class="btn btn-sm btn-danger">Verwijderen</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?= $this->endSection() ?>