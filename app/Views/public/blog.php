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
            <?= ((isset($merkenblog)) ? '<h1 class="mb-4 fw-bold">Laatste blogartikelen van onze merken</h1>' : '<h1 class="mb-4 fw-bold">Laatste blogartikelen</h1>') ?>

            <?php if (empty($blogs)) : ?>
                <p>Er zijn nog geen blogartikelen.</p>
            <?php else : ?>
                <div class="news-list">
                    <?php foreach ($blogs as $blog) : ?>
                        <div class="news-item mb-4">
                            <div class="news-thumb overflow-hidden">
                                <?php if (!empty($blog['image'])) : ?>
                                    <img src="<?= base_url('uploads/' . $blog['image']) ?>" alt="<?= esc($blog['title']) ?>" class="w-100">
                                <?php else : ?>
                                    <img src="/webAssets/img/news/news-thumb-placeholder.png" alt="Placeholder" class="w-100">
                                <?php endif; ?>
                            </div>

                            <div class="news-content">
                                <h3 class="news-title fw-normal"><a href="<?= route_to('blogDetail', $blog['slug']) ?>"><?= esc($blog['title']) ?></a></h3>

                                <div class="news-info d-flex align-items-center">
                                    <span>Door Kantoortapijt.nl</span>
                                    <span class="news-date position-relative"><?= \CodeIgniter\I18n\Time::parse($blog['created_at'])->format('F j, Y') ?></span>
                                </div>

                                <p class="news-desc"><?= esc(substr(strip_tags($blog['content']), 0, 150)) ?>...</p>

                                <a href="<?= route_to('blogDetail', $blog['slug']) ?>" class="readmore-btn text-decoration-underline fw-medium text-uppercase">Lees meer</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<?= $this->endSection() ?>