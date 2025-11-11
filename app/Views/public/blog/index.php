<?= $this->extend('templates/public') ?>

<?= $this->section('page_title') ?>
Blog
<?= $this->endSection() ?>

<?= $this->section('page_description') ?>
Overzicht van onze nieuwste blogartikelen.
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="main-wrapper d-flex flex-column flex-lg-row">
        <div class="main-content">
            <h1 class="mb-4 fw-bold">Onze Laatste Blogartikelen</h1>

            <?php if (empty($blogs)) : ?>
                <p>Er zijn nog geen blogartikelen.</p>
            <?php else : ?>
                <div class="row">
                    <?php foreach ($blogs as $blog) : ?>
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                <?php if (!empty($blog['image'])) : ?>
                                        <img src="<?= base_url('uploads/' . $blog['image']) ?>" alt="<?= esc($blog['title']) ?>" class="img-fluid mb-3">
                                    <?php endif; ?>
                                    <h1 class="card-title"><a href="<?= route_to('blogDetail', $blog['slug']) ?>"><?= esc($blog['title']) ?></a></h1>
                                    <p class="card-text"><?= esc(substr(strip_tags($blog['content']), 0, 150)) ?>...</p>
                                    <p class="card-text"><small class="text-muted">Geplaatst op: <?= \CodeIgniter\I18n\Time::parse($blog['created_at'])->toLocalizedString() ?></small></p>
                                    <a href="<?= route_to('blogDetail', $blog['slug']) ?>" class="btn btn-primary">Lees Meer</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<?= $this->endSection() ?>