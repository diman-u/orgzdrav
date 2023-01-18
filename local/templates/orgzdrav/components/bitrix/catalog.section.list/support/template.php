<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
?>
<? foreach ($arResult['SECTIONS'] as $arSection): 
	if (!empty($arParams['PARENT_SECTION_CODE']) && $arParams['PARENT_SECTION_CODE'] != $arSection['CODE']) {
		continue;
	}
?>
	<h3 id="sec-<?= $arSection['ID'] ?>"><?= $arSection['NAME'] ?></h3>
	
	<? if (!empty($arResult['ITEMS_BY_SECTION'][$arSection['ID']])) : ?>
		<ul class="list-deep">
		<? foreach ($arResult['ITEMS_BY_SECTION'][$arSection['ID']] as $arItem): ?>
			<li><a class="h5 link-text js-support-item" href="<?= $arItem['DETAIL_PAGE_URL'] ?>" data-docid="<?= $arItem['PROPERTY_XDATA_ID_VALUE'] ?>"><?= $arItem['NAME'] ?></a></li>
		<? endforeach; ?>
		</ul>
	<? endif; ?>
	
<? endforeach; ?>
<template id="loading-tpl">
	<div class="spinner-block mt-12 mb-12">
		<strong>Загрузка...</strong>
		<div class="spinner" role="status"></div>
	</div>
</template>