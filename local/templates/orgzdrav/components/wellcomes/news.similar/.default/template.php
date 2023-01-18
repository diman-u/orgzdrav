<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);
?>

<h2>Смотрите также</h2>

<?php
foreach ($arResult['ITEMS'] as $item): ?>
    <article class="news-item" data-id="<?= $item["id"] ?>">
        <? if(!empty($item['photos'])): ?>
            <div class="news-item__img">
                <img src="<?= $item['photos']['asis'] ?>" alt="">
            </div>
        <? endif; ?>

        <div class="news-item__content">
            <a href="<?= $item['DETAIL_PAGE_URL'] ?>" class="news-item__title u-link-holder"><?= $item['header'] ?></a>
            <p><?= strip_tags($item['annotation']) ?></p>

            <div class="post-meta">
                <div class="post-meta__tag"><?= isset($item['SECTION']['NAME']) ? $item['SECTION']['NAME'] : $arParams['META_TAG']; ?></div>
                <div class="post-meta__txt"><?= $item['idx_key_date'] ?></div>
                <div class="post-meta__cnt"></div>
            </div>
        </div>
    </article>
<? endforeach; ?>