
<?php $pager->setSurroundCount(2); ?>

<nav aria-label="Customer pagination" class="pagination-nav">
    <ul class="pagination-list">

        <?php if ($pager->hasPreviousPage()): ?>
            <li>
                <a href="<?= $pager->getFirst() ?>">First</a>
            </li>
            <li>
                <a href="<?= $pager->getPreviousPage() ?>">Previous</a>
            </li>
        <?php endif; ?>

        <?php foreach ($pager->links() as $link): ?>
            <li>
                <a
                    href="<?= esc($link['uri']) ?>"
                    class="<?= $link['active'] ? 'active' : '' ?>"
                    <?= $link['active'] ? 'aria-current="page"' : '' ?>
                >
                    <?= esc($link['title']) ?>
                </a>
            </li>
        <?php endforeach; ?>

        <?php if ($pager->hasNextPage()): ?>
            <li>
                <a href="<?= $pager->getNextPage() ?>">Next</a>
            </li>
            <li>
                <a href="<?= $pager->getLast() ?>">Last</a>
            </li>
        <?php endif; ?>

    </ul>
</nav>
