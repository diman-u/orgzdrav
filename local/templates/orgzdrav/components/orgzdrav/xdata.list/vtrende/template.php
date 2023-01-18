<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

$gridSize = empty($arParams['GRID_SIZE']) ? 3 : (int) $arParams['GRID_SIZE'];
?>
<div class="l-grid l-grid--<?= $gridSize ?> js-is-container js-view-list" data-gridsize="<?= $gridSize ?>">
    <? foreach ($arResult['ITEMS'] as $item): ?>
        <article class="news-item js-cnt" data-type="wcs_news" data-id="<?= $item["id"] ?>">
            <div class="news-item__img">
                <img src="<?= $item['photos']['asis'] ?>" alt="">
            </div>
            <div class="news-item__content">
                <a href="<?= $item['DETAIL_PAGE_URL'] ?>" class="news-item__title u-link-holder"><?= $item['header'] ?></a>
                <p><?= strip_tags($item['annotation']) ?></p>

                <div class="post-meta">
                    <div class="post-meta__tag"><?= isset($item['SECTION']['NAME']) ? $item['SECTION']['NAME'] : 'Новости'; ?></div>
                    <div class="post-meta__txt"><?= $item['idx_key_date'] ?></div>
                    <div class="post-meta__cnt"></div>
                    <? /*<a class="post-meta__bookmark" data-id="<?= $item['id'] ?>" href=""></a>*/ ?>
                </div>
            </div>
        </article>
    <? endforeach; ?>
</div>