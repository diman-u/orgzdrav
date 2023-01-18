<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);
?>
<div class="grid grid--xl-3 js-is-container">
    <? foreach ($arResult['ITEMS'] as $arItem) { ?>
        <div class="grid__column js-is-container-item">
            <article class="event-item js-cnt" data-type="iblock" data-id="<?= $arItem["ID"] ?>">
                <div class="event-item__img">
                    <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" alt="<?= htmlspecialchars($arItem["NAME"]) ?>" />
                </div>
                <div class="event-item__content">
                    <a class="event-item__title u-link-holder" href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><?= $arItem["NAME"] ?></a>
                    <p><?= $arItem["PREVIEW_TEXT"] ?></p>

                    <div class="post-meta">
                        <div class="post-meta__tag is-big">Кейсы</div>
                        <div class="post-meta__cnt"></div>
                    </div>
                </div>
            </article>
        </div>
    <? } ?>
</div>
<?=$arResult["NAV_STRING"]?>