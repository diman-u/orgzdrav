<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);
?>

<div class="grid grid--xl-3 js-is-container">
    <? foreach ($arResult['ITEMS'] as $arItem): ?>
        <div class="grid__column js-is-container-item">
            <article class="event-item js-bookmark js-cnt" data-type="<?= $arItem['TYPE'] ?>" data-id="<?= $arItem['ID'] ?>">
                <div class="event-item__img">
                    <img src="<?= $arItem['IMG']['SRC']; ?>" alt="<?= htmlspecialchars($arItem['NAME']) ?>" />
                </div>
                <div class="event-item__content">
                    <a class="event-item__title u-link-holder" href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><?= $arItem['NAME'] ?></a>
                    <p><?= $arItem['PREVIEW_TEXT'] ?></p>

                    <div class="post-meta">
                        <div class="post-meta__tag is-big"><?= $arItem['ENTITY_CATEGORY'] ?></div>
                        <div class="post-meta__txt"><?= $arItem['ACTIVE_FROM'] ?></div>
                        <div class="post-meta__cnt"></div>
                        <div class="post-meta__bookmark"></div>
                    </div>
                </div>
            </article>
        </div>
    <? endforeach; ?>
</div>
