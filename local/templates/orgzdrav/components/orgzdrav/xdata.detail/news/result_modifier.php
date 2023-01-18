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

use \Orgzdrav\Helper\Format;

$format = new Format();
if($_GET['dev'] == 'Y') {
    dd($arResult['idx_key_date']);
}

$dateTime = \Bitrix\Main\Type\DateTime::createFromPhp(new DateTime($arResult['idx_key_date']));
$arResult['idx_key_date'] = $format->getFormatDate($dateTime->getTimestamp());

if (false !== strpos($arResult['text'], '&gt;')) {
	$arResult['text'] = html_entity_decode($arResult['text']);
}
if (false !== strpos($arResult['text'], 'iframe')) {
	unset($arResult['photos']);
}