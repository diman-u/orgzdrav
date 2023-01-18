<article class="news-item js-cnt" data-type="wcs_news" data-id="<?= $arResult['id'] ?>">
    <div class="news-item__img news-item__img--small">
        <img src="<?= $arResult['photos']['asis'] ?>" alt="">
    </div>
    <div class="news-item__content">
        <a href="<?= $arResult['DETAIL_PAGE_URL'] ?>" class="news-item__title u-link-holder"><?= $arResult['header'] ?></a>
        <p><?= strip_tags($arResult['annotation']) ?></p>

        <div class="post-meta">
            <div class="post-meta__tag"><?= isset($arResult['SECTION']['NAME']) ? $arResult['SECTION']['NAME'] : 'Фокус дня'; ?></div>
            <div class="post-meta__txt"><?= $arResult['DISPLAY_CREATED'] ?></div>
            <div class="post-meta__cnt"></div>
        </div>
    </div>
</article>