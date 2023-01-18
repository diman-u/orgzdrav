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

$arResult['META_TAG'] = $arParams['META_TAG'] ?? '';
if (isset($arResult['SECTION']['NAME'])) {
	$arResult['META_TAG'] = $arResult['SECTION']['NAME'];
}