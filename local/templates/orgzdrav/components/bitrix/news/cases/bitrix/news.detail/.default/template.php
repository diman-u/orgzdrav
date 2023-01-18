<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);
?>
<article class="post content" data-type="iblock" data-id="<?= $arResult["ID"] ?>">
    <h1><?= $arResult['NAME'] ?></h1>
    <div class="post-meta">
        <div class="post-meta__tag">Кейсы</div>
        <div class="post-meta__cnt"></div>
    </div>

    <? if (!empty($arResult['PREVIEW_PICTURE']['SRC'])) : ?>
        <figure>
            <img src="<?= $arResult['PREVIEW_PICTURE']['SRC']; ?>" alt="">
        </figure>
    <? endif; ?>
	
	<div class="post-info">
		<div class="post-info__value">Организация: <strong><?= $arResult['PROPERTIES']['ORGANIZATION']['VALUE']; ?></strong></div>
		<div class="post-info__value">Участники проекта: <strong><?= $arResult['PROPERTIES']['LEKTOR']['VALUE']; ?></strong></div>
	</div>

    <div class="mt-32">
        <?= $arResult['DETAIL_TEXT'] ?>
    </div>

    <? if (!empty($arResult['PROPERTIES']['LINK_LEADER']['VALUE'])) : ?>
        <div class="mt-32 mb-32 text-center">
            <a href="<?= $arResult['PROPERTIES']['LINK_LEADER']['VALUE'] ?>"
               class="btn"
               target="_blank"
            >
                Перейти на страницу проекта
            </a>
        </div>
    <? endif; ?>

    <? if (!empty($arResult['PROPERTIES']['LINK']['VALUE'])) : ?>
        <footer>
            <div>Ссылка: <?= $arResult['PROPERTIES']['LINK']['VALUE'] ?></div>
        </footer>
    <? endif; ?>

</article>