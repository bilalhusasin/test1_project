<?php $pager->setSurroundCount(2) ?>

<nav aria-label="<?= lang('Pager.pageNavigation') ?>">
    <ul class="pagination justify-content-center mt-5">
        <?php
        $baseUrl = str_replace('/page/' . $pager->getCurrentPageNumber(), '', current_url());
        ?>

        <?php if ($pager->hasPrevious()) : ?>
            <li class="page-item">
                <a href="<?= $baseUrl . '/page/1' ?>" aria-label="<?= lang('Pager.first') ?>" class="page-link">
                    <i class="fas fa-angle-double-left"></i>
                </a>
            </li>
            <li class="page-item">
                <a href="<?= $baseUrl . '/page/' . ($pager->getCurrentPageNumber() - 1) ?>" aria-label="<?= lang('Pager.previous') ?>" class="page-link">
                    <i class="fas fa-angle-left"></i>
                </a>
            </li>
        <?php endif ?>

        <?php foreach ($pager->links() as $link) : ?>
            <li <?= $link['active'] ? 'class="page-item active"' : 'class="page-item"' ?>>
                <a href="<?= $baseUrl . '/page/' . $link['title'] ?>" class="page-link">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach ?>

        <?php if ($pager->hasNext()) : ?>
            <li class="page-item">
                <a href="<?= $baseUrl . '/page/' . ($pager->getCurrentPageNumber() + 1) ?>" aria-label="<?= lang('Pager.next') ?>" class="page-link">
                    <i class="fas fa-angle-right"></i>
                </a>
            </li>
            <li class="page-item">
                <a href="<?= $baseUrl . '/page/' . $pager->getPageCount() ?>" aria-label="<?= lang('Pager.last') ?>" class="page-link">
                    <i class="fas fa-angle-double-right"></i>
                </a>
            </li>
        <?php endif ?>
    </ul>
</nav>