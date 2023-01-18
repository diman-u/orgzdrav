<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponent $component */
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */


if (!empty($arResult['photos']['asis'])) {
	$arResult['og:image'] = $arResult['photos']['asis'];
	$this->__component->setResultCacheKeys(['og:image']);
}

$arResult['META_TAG'] = $arParams['META_TAG'] ?? '';
if (isset($arResult['SECTION']['NAME'])) {
	$arResult['META_TAG'] = $arResult['SECTION']['NAME'];
}

if (false !== strpos($arResult['text'], '&gt;')) {
	$arResult['text'] = html_entity_decode($arResult['text']);
}
if (false !== strpos($arResult['text'], 'iframe')) {
	unset($arResult['photos']);
}

$arResult['figcaption'] = '';

if (!empty($arResult['copyright'])) {
	$arResult['figcaption'] = $arResult['copyright'];
} elseif (!empty($arResult['photo'])) {
	$arResult['figcaption'] = $arResult['photo'];
}

if (
	!empty($arResult['photo']) 
	&& 0 === strpos($arResult['photo'], 'http')
	&& !empty($arResult['copyright']) 
) {
	$arResult['figcaption'] = sprintf(
		'<a href="%s" target="_blank" rel="nofollow">%s</a>', 
		$arResult['photo'],
		$arResult['copyright']
	);
}