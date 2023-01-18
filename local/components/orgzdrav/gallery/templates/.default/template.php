<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

foreach ($arResult['COLLECTIONS'] as $collectionId => $collectionName) : ?>
<div class="grid grid--gap-8 grid--xl-3 js-gallery" data-id="<?= $collectionId ?>">
    <? foreach ($arResult['ITEMS'][$collectionId] as $arItem): ?>
    <div class="grid__column">
        <a href="<?= $arItem['PATH'] ?>" class="glightbox" data-gallery="gallery-<?= $collectionId ?>" data-type="image">
            <img src="<?= $arItem['PATH'] ?>" loading="lazy" alt="<?= $arItem['NAME'] ?>" data-collection="<?= $collectionId ?>" width="<?= $arItem['WIDTH'] ?>" height="<?= $arItem['HEIGHT'] ?>" />
        </a>
    </div>
    <? endforeach; ?>
</div>
<? endforeach; ?>