<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);
?>
<div class="grid">
	<? foreach ($arResult['ITEMS'] as $i => $arItem): ?>
		<div class="grid__column">
            <article class="event-item">
                <div class="event-item__img">
                    <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" alt="<?= htmlspecialchars($arItem["NAME"]) ?>" />
                    <div class="event-item__img-badge <?= $arItem['DISPLAY_PROPERTIES']['type']['CLASS'] ?>"><?= $arItem['DISPLAY_PROPERTIES']['type']['VALUE'] ?></div>
                </div>
                <div class="event-item__content">
                    <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="event-item__title u-link-holder"><?= $arItem["NAME"] ?></a>
                    <p><?= $arItem["PREVIEW_TEXT"] ?></p>
                    <div class="event-item__value">Проводим: <span><?= $arItem['DISPLAY_PROPERTIES']['place']['VALUE'] ?></span></div>

                    <div class="post-meta">
                        <div class="post-meta__tag is-big">Вебинар</div>
                        <div class="post-meta__txt"><?= $arItem["DISPLAY_ACTIVE_FROM"] ?></div>
                        <div class="post-meta__cnt">189</div>
<!--                        <a class="post-meta__bookmark" href="#"></a> -->
                    </div>
                </div>
            </article>
		</div>
	<? endforeach; ?>
</div>