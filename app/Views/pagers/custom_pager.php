<?php

$pager->setSurroundCount(2);
?>

<div class="row justify-content-center mb-4 mt-3">
                    <div class="col-md-3">
                        <nav aria-label="<?= lang('Pager.pageNavigation') ?>">
                            <ul class="pagination mb-sm-0">
                            <?php if ($pager->hasPrevious()) : ?>
                                <li class="page-item">
                                    <a href="<?= $pager->getFirst() ?>" class="page-link" aria-label="<?= lang('Pager.first') ?>"><i class="mdi mdi-chevron-double-left"></i><span aria-hidden="true"><?= lang('Pager.first') ?></span>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a href="<?= $pager->getPrevious() ?>" class="page-link" aria-label="<?= lang('Pager.previous') ?>"><i class="mdi mdi-chevron-left"></i> <span aria-hidden="true"><?= lang('Pager.previous') ?></span></a>
                                </li>
                            <?php endif ?>

                            <?php foreach ($pager->links() as $link) : ?>
                                <li class="page-item <?= $link['active'] ? 'active' : '' ?>" >
                                    <a href="<?= $link['uri'] ?>" class="page-link">
                                        <?= $link['title'] ?>
                                    </a>
                                </li>
                            <?php endforeach ?>
                            <?php if ($pager->hasNext()) : ?>
                                <li class="page-item">
                                    <a href="<?= $pager->getNext() ?>" class="page-link" aria-label="<?= lang('Pager.next') ?>"><span aria-hidden="true"><?= lang('Pager.next') ?></span><i class="mdi mdi-chevron-right"></i></a>
                                </li>
                                <li class="page-item">
                                    <a href="<?= $pager->getLast() ?>" class="page-link" aria-label="<?= lang('Pager.last') ?>">
                                        <span aria-hidden="true"><?= lang('Pager.last') ?></span><i class="mdi mdi-chevron-double-right"></i></a>
                                </li>
                            <?php endif ?>
                            </ul>
                        </nav>
                    </div>
</div>