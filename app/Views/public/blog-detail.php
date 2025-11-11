<?= $this->extend('templates/public') ?>

<?= $this->section('page_title') ?>
<?= esc($blog['title']) ?>
<?= $this->endSection() ?>

<?= $this->section('page_description') ?>
<?= esc(substr(strip_tags($blog['content']), 0, 150)) ?>...
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="main-wrapper d-flex flex-column flex-lg-row">
        <div class="main-content blog-detail">
            <h1 class="mb-4 fw-bold text-center"><?= esc($blog['title']) ?></h1>
            <p class="text-muted mb-3 text-center">Geplaatst op: <?= \CodeIgniter\I18n\Time::parse($blog['created_at'])->format('F j, Y') ?></p>

            <div class="blog-content-layout clearfix">
                <?php if (!empty($blog['image'])) : ?>
                    <img src="<?= base_url('uploads/' . $blog['image']) ?>" alt="<?= esc($blog['title']) ?>" class="blog-detail-image-left">
                <?php endif; ?>
                <?= $blog['content'] ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>